// ignore_for_file: use_build_context_synchronously, non_constant_identifier_names, prefer_typing_uninitialized_variables

import 'dart:convert';
import 'dart:convert' as convert;
import 'dart:math' as math;
import 'dart:typed_data';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:http/http.dart' as http;
import 'dart:io';
import 'dart:async';
import 'package:dressur/components/padding_and_divider.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:image_picker/image_picker.dart';
import 'package:path_provider/path_provider.dart';
import 'package:image/image.dart' as img;
import 'package:dressur/components/constant.dart';
import 'package:dressur/2_promo/boost_billing.dart';
import 'package:dressur/components/noti.dart';
import 'package:dressur/components/noti_sys.dart';
import 'package:dressur/components/permission_manager.dart';
import 'package:permission_handler/permission_handler.dart';
import 'package:select_form_field/select_form_field.dart';
import 'package:dressur/components/info_service_bottom_sheet.dart';

const _supportedPromotionImageRatios = <double>[1, 4 / 3, 3 / 4];

bool _hasSupportedPromotionImageRatio(img.Image image) {
  final aspectRatio = image.width / image.height;
  const tolerance = 0.01;
  return _supportedPromotionImageRatios.any(
    (ratio) => (aspectRatio - ratio).abs() <= tolerance,
  );
}

Future<File?> _preparePromotionImage({
  required BuildContext context,
  required File imageFile,
  required bool isFrench,
}) async {
  try {
    final fileSize = await imageFile.length();
    if (fileSize / (1024 * 1024) > 1) {
      if (context.mounted) {
        dangerNoti(
          "Attention !!!",
          isFrench
              ? "L'image ne peut pas dépasser 1 Mo."
              : "Image size cannot exceed 1 MB.",
          context,
        );
      }
      return null;
    }

    final bytes = await imageFile.readAsBytes();
    final decodedImage = img.decodeImage(bytes);
    if (decodedImage == null) {
      if (context.mounted) {
        dangerNoti(
          "Attention !!!",
          isFrench
              ? "Cette image ne peut pas être décodée."
              : "This image cannot be decoded.",
          context,
        );
      }
      return null;
    }

    final orientedImage = img.bakeOrientation(decodedImage);
    if (_hasSupportedPromotionImageRatio(orientedImage)) {
      return imageFile;
    }

    if (!context.mounted) return null;
    return showDialog<File>(
      context: context,
      barrierDismissible: false,
      builder: (_) => _PromotionImageCropper(
        imageFile: imageFile,
        isFrench: isFrench,
      ),
    );
  } on FileSystemException {
    if (context.mounted) {
      dangerNoti(
        "Attention !!!",
        isFrench
            ? "Impossible de lire temporairement cette image. Veuillez réessayer."
            : "This image could not be read temporarily. Please try again.",
        context,
      );
    }
    return null;
  } catch (_) {
    if (context.mounted) {
      dangerNoti(
        "Attention !!!",
        isFrench
            ? "Impossible de préparer cette image. Veuillez réessayer."
            : "Unable to prepare this image. Please try again.",
        context,
      );
    }
    return null;
  }
}

Future<File> _createPromotionUploadFile({
  required File imageFile,
  required String fileName,
}) async {
  final imageBytes = await imageFile.readAsBytes();
  final decodedImage = img.decodeImage(imageBytes);
  if (decodedImage == null) {
    throw const FormatException('The selected image cannot be decoded.');
  }

  final orientedImage = img.bakeOrientation(decodedImage);
  if (!_hasSupportedPromotionImageRatio(orientedImage)) {
    throw const FormatException('The selected image has an unsupported ratio.');
  }

  final tempDirectory = await getTemporaryDirectory();
  final uploadFile = File('${tempDirectory.path}/$fileName');

  // Preserve the legacy Promotion Affaire upload contract: JPEG encoding,
  // multipart field "image", and no extra compression pass.
  final encodedImage = img.encodeJpg(orientedImage, quality: 85);
  await uploadFile.writeAsBytes(encodedImage, flush: true);
  if (await uploadFile.length() > 1024 * 1024) {
    throw const FormatException('The selected image is larger than 1 MB.');
  }

  return uploadFile;
}

Map<String, dynamic>? _decodePromotionApiResponse(String body) {
  try {
    final decoded = jsonDecode(body);
    if (decoded is Map) {
      return Map<String, dynamic>.from(decoded);
    }
  } catch (_) {
    // The caller displays a generic error when the API does not return JSON.
  }
  return null;
}

void _showPromotionApiError({
  required BuildContext context,
  required bool isFrench,
  required int statusCode,
  Map<String, dynamic>? data,
}) {
  final fallbackTitle = isFrench ? "Erreur" : "Error";
  final fallbackMessage = isFrench
      ? "Une erreur est survenue lors de l'envoi. Veuillez réessayer."
      : "An error occurred while sending. Please try again.";
  final title = data?['titre']?.toString() ?? fallbackTitle;
  final message = data?['message']?.toString() ??
      (statusCode > 0 ? '$fallbackMessage (Code : $statusCode)' : fallbackMessage);
  dangerNoti(title, message, context);
}

class PromotionFormPage extends StatefulWidget {
  @override
  _PromotionFormPageState createState() => _PromotionFormPageState();
}

class _PromotionFormPageState extends State<PromotionFormPage> {
  dynamic type_promo_affaire = "produit_service";
  onChangeTypePromoAffaire(val) async {
    setState(() {
      type_promo_affaire = val;
    });
  }

  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      if (mounted) _showInfoModal();
    });
  }

  void _showInfoModal({int countdown = 2}) {
    showServiceInfoModal(
      context,
      countdownSeconds: countdown,
      titleFr: "Informations Promotion Affaire",
      titleEn: "Business Promotion Information",
      items: const [
        ServiceInfoItem(
          icon: FontAwesomeIcons.magnifyingGlass,
          textFr:
              "Après envoi, votre promotion sera analysée par les administrateurs de Dressur.",
          textEn:
              "After submission, your promotion will be reviewed by Dressur administrators.",
        ),
        ServiceInfoItem(
          icon: FontAwesomeIcons.eye,
          textFr:
              "Si acceptée, elle sera visible par des milliers d'utilisateurs correspondant à vos préférences pays.",
          textEn:
              "If accepted, it will be visible to thousands of users matching your country preferences.",
        ),
        ServiceInfoItem(
          icon: FontAwesomeIcons.penToSquare,
          textFr: "Si rejetée, vous aurez la possibilité de la modifier.",
          textEn: "If rejected, you will have the option to modify it.",
        ),
        ServiceInfoItem(
          icon: FontAwesomeIcons.whatsapp,
          textFr:
              "Les utilisateurs intéressés vous contacteront sur votre numéro WhatsApp.",
          textEn: "Interested users will contact you on your WhatsApp number.",
        ),
        ServiceInfoItem(
          icon: FontAwesomeIcons.gift,
          textFr:
              "Les Promotions Affaires (Offre d'emploi et Demande d'emploi) sont gratuites.",
          textEn:
              "Business Promotions (Job Offer and Job Application) are free.",
        ),
      ],
    );
  }

  Widget _buildInfoButton() {
    final bool isFr = langUserPhone == "fr";
    return OutlinedButton.icon(
      onPressed: () => _showInfoModal(countdown: 0),
      icon: const FaIcon(FontAwesomeIcons.circleInfo, size: 14),
      label: Text(
        isFr
            ? "Voir les informations sur le service"
            : "View service information",
        style: GoogleFonts.poppins(fontSize: 13, fontWeight: FontWeight.w500),
      ),
      style: OutlinedButton.styleFrom(
        foregroundColor: primaryColor,
        side: BorderSide(color: primaryColor.withOpacity(0.5)),
        minimumSize: const Size(double.infinity, 48),
        padding: const EdgeInsets.symmetric(vertical: 10, horizontal: 16),
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(10)),
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
          (langUserPhone == "fr")
              ? 'Nouvelle Promotion Affaire'
              : 'New Business Promotion',
          style: GoogleFonts.poppins(
            color: Colors.white,
            fontWeight: FontWeight.w400,
            fontSize: 18,
          ),
        ),
        leading: IconButton(
          onPressed: () {
            Navigator.pop(context);
          },
          icon: const FaIcon(
            FontAwesomeIcons.chevronLeft,
            color: Colors.white,
          ),
        ),
        backgroundColor: primaryColor,
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.only(left: 10, top: 5, right: 10, bottom: 5),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.stretch,
          children: [
            const SizedBox(height: 10),
            _buildInfoButton(),
            const SizedBox(height: 16),
            Text(
              (langUserPhone == "fr")
                  ? "Nouvelle Promotion Affaire"
                  : "New Business Promotion",
              style: GoogleFonts.poppins(
                fontSize: 20,
                fontWeight: FontWeight.w600,
              ),
              textAlign: TextAlign.center,
            ),
            const SizedBox(height: 8),
            SelectFormField(
              decoration: InputDecoration(
                labelText: (langUserPhone == "fr")
                    ? 'Type Promotion Affaire'
                    : 'Business Promotion Type',
                border: const OutlineInputBorder(),
              ),
              type: SelectFormFieldType.dropdown,
              initialValue: 'produit_service',
              labelText: (langUserPhone == "fr")
                  ? 'Type Promotion Affaire'
                  : 'Business Promotion Type',
              items: listeTypePromoAffaire(),
              onChanged: (val) => onChangeTypePromoAffaire(val),
              onSaved: (val) => print(val),
            ),
            const SizedBox(height: 5),
            DressurDivider(),
            const SizedBox(height: 5),
            if (type_promo_affaire == "produit_service") ...[
              ProduitsServices()
            ],
            if (type_promo_affaire == "sites_applications") ...[
              SitesApplications()
            ],
            if (type_promo_affaire == "dmd_emploi") ...[DemandesEmploi()],
            if (type_promo_affaire == "offre_emploi") ...[OffresEmploi()],
            const SizedBox(height: 15),
          ],
        ),
      ),
    );
  }
}

class ProduitsServices extends StatefulWidget {
  @override
  State<ProduitsServices> createState() => _ProduitsServicesState();
}

class _ProduitsServicesState extends State<ProduitsServices> {
  bool load = false;
  File? _imageFile;
  final TextEditingController _textEditingController = TextEditingController();
  bool _isSending = false;
  var _message = "";
  dynamic idFormulBoost = 0;
  dynamic valueMethodePaiement = "mtn";
  bool loading_formule_gratuit = false;
  List<Map<String, dynamic>> listeDesFormules = [];
  int value = 0;
  var label = "";
  int prix = 0;
  int jours = 0;
  final telController = TextEditingController(text: tel);
  final whatsappContactController = TextEditingController(text: tel);

  int prixBoost = 0;
  bool _participateInReward = false;
  int _rewardBudget = 0;
  bool _isCustomRewardBudget = false;
  String? _rewardBudgetError;
  final _customRewardBudgetController = TextEditingController();
  bool _boostFacebook = false;
  final _boostFacebookAmountController = TextEditingController(text: '700');

  int joursBoost = 0;
  double get _boostFacebookAmount {
    if (!_boostFacebook) return 0.0;
    return (int.tryParse(_boostFacebookAmountController.text) ?? 0).toDouble();
  }

  double get _subTotal =>
      BoostBilling.calculateTotal(
        formulaAmount: prixBoost,
        rewardEnabled: _participateInReward,
        rewardBudget: _rewardBudget,
        facebookEnabled: _boostFacebook,
        facebookAmount: int.tryParse(_boostFacebookAmountController.text) ?? 0,
        publishOnDressurStatus: _publishOnDressurStatus,
        formulaDays: joursBoost,
      );

  bool _publishOnDressurStatus = false;

  // --- CALCULS DES MONTANTS ---
  double get _rewardProgramAmount {
    if (!_participateInReward || _rewardBudget == 0) return 0.0;
    // Budget choisi par le promoteur (inclut 20% commission Dressur)
    return _rewardBudget.toDouble();
  }

  double get _rewardPoolAmount =>
      _participateInReward ? _rewardBudget * 0.8 : 0.0;
  double get _rewardCommissionAmount =>
      _participateInReward ? _rewardBudget * 0.2 : 0.0;

  String get _rewardBudgetRequiredMessage => langUserPhone == "fr"
      ? "Veuillez saisir un montant personnalisé."
      : "Please enter a custom amount.";

  String get _rewardBudgetIntegerMessage => langUserPhone == "fr"
      ? "Veuillez saisir uniquement un nombre entier."
      : "Please enter a whole number only.";

  String get _rewardBudgetMinimumMessage => langUserPhone == "fr"
      ? "Le montant doit être supérieur à 5 000 FCFA."
      : "The amount must be greater than 5,000 FCFA.";

  String get _rewardBudgetSelectionMessage => langUserPhone == "fr"
      ? "Veuillez choisir un budget de récompense valide."
      : "Please choose a valid reward budget.";

  void _onCustomRewardBudgetChanged(String value) {
    final amountText = value.trim();
    int? amount;
    String? error;

    if (amountText.isEmpty) {
      error = _rewardBudgetRequiredMessage;
    } else if (!RegExp(r'^\d+$').hasMatch(amountText)) {
      error = _rewardBudgetIntegerMessage;
    } else {
      amount = int.tryParse(amountText);
      if (amount == null) {
        error = _rewardBudgetIntegerMessage;
      } else if (amount <= 5000) {
        error = _rewardBudgetMinimumMessage;
      }
    }

    setState(() {
      _rewardBudget = error == null ? amount! : 0;
      _rewardBudgetError = error;
    });
  }

  bool _validateRewardBudget() {
    if (!_participateInReward) {
      _rewardBudget = 0;
      _rewardBudgetError = null;
      return true;
    }

    if (_isCustomRewardBudget) {
      final amountText = _customRewardBudgetController.text.trim();
      final amount = int.tryParse(amountText);
      String? error;

      if (amountText.isEmpty) {
        error = _rewardBudgetRequiredMessage;
      } else if (!RegExp(r'^\d+$').hasMatch(amountText) || amount == null) {
        error = _rewardBudgetIntegerMessage;
      } else if (amount <= 5000) {
        error = _rewardBudgetMinimumMessage;
      }

      if (error != null) {
        setState(() {
          _rewardBudget = 0;
          _rewardBudgetError = error;
        });
        dangerNoti("Attention !!!", error, context);
        return false;
      }

      setState(() {
        _rewardBudget = amount!;
        _rewardBudgetError = null;
      });
      return true;
    }

    const predefinedBudgets = [500, 1000, 2000, 5000];
    if (!predefinedBudgets.contains(_rewardBudget)) {
      setState(() => _rewardBudgetError = _rewardBudgetSelectionMessage);
      dangerNoti("Attention !!!", _rewardBudgetSelectionMessage, context);
      return false;
    }

    return true;
  }

  void _debugValidatePromotionRequest(http.MultipartRequest request) {
    assert(() {
      final fields = request.fields;
      debugPrint(
        '[DEV] addProduitService options: '
        'inProgrammeRecompense=${fields['inProgrammeRecompense']}, '
        'rewardBudget=${fields['rewardBudget']}, '
        'publishOnDressurStatus=${fields['publishOnDressurStatus']}, '
        'boostFacebook=${fields['boostFacebook']}, '
        'montantBoostFacebook=${fields['montantBoostFacebook']}',
      );

      if (prixBoost == 100 &&
          _participateInReward &&
          _rewardBudget == 500 &&
          _boostFacebook &&
          _boostFacebookAmountController.text == '700') {
        assert(fields['inProgrammeRecompense'] == '1');
        assert(fields['rewardBudget'] == '500');
        assert(fields['boostFacebook'] == '1');
        assert(fields['montantBoostFacebook'] == '700');
      }
      return true;
    }());
  }

  double get _dressurStatusAmount {
    if (!_publishOnDressurStatus || prixBoost < 1000 || joursBoost <= 0) {
      return 0.0;
    }

    // Même formule que l'API : round((nombreDeJours * 5000) / 7).
    return ((joursBoost * 5000) / 7).roundToDouble();
  }

  Future<void> _selectImage() async {
    await PermissionManager.instance.runWithPermissionRecovery(
      context,
      actionKey: 'new_promo_affaire:select_image',
      permission: Permission.photos,
      isFrench: langUserPhone == "fr",
      action: () async {
        if (!mounted) return;
        final picker = ImagePicker();
        final pickedImage = await picker.pickImage(source: ImageSource.gallery);
        if (pickedImage != null) {
          final imageFile = File(pickedImage.path);
          final preparedImage = await _preparePromotionImage(
            context: context,
            imageFile: imageFile,
            isFrench: langUserPhone == "fr",
          );
          if (preparedImage != null && mounted) {
            setState(() => _imageFile = preparedImage);
          }
        }
      }
    );
  }

  Future<void> _sendData() async {
    if (!telIsVerified) {
      showConfNumeroWhatsapp(context);
      return;
    }
    if (idFormulBoost == 0 ||
        idFormulBoost.toString().isEmpty ||
        _textEditingController.text.isEmpty ||
        _imageFile == null) {
      dangerNoti(
          "Attention !!!",
          (langUserPhone == "fr")
              ? 'Veuillez choisir une formule, entrer un texte et sélectionner une image.'
              : 'Please choose a formula, enter some text and select an image.',
          context);
      return;
    }
    if (!_validateRewardBudget()) {
      return;
    }
    if (_boostFacebook) {
      final amount = int.tryParse(_boostFacebookAmountController.text) ?? 0;
      if (amount < 700) {
        dangerNoti(
            "Attention !!!",
            (langUserPhone == "fr")
                ? "Le montant minimum pour le boost Facebook est de 700 FCFA."
                : "The minimum amount for the Facebook boost is 700 FCFA.",
            context);
        return;
      }
    }
    final waRegex = RegExp(r'^\+\d{11,}$');
    if (!waRegex.hasMatch(whatsappContactController.text.trim())) {
      dangerNoti(
          "Attention !!!",
          (langUserPhone == "fr")
              ? "Le numéro WhatsApp de contact doit commencer par + suivi d'au moins 11 chiffres."
              : "WhatsApp contact number must start with + followed by at least 11 digits.",
          context);
      return;
    }
    setState(() => _isSending = true);
    final url = Uri.parse('$generalRouteForApi/addProduitService');
    final request = http.MultipartRequest('POST', url);
    request.fields['idFormulePromoAffaire'] = idFormulBoost.toString();
    request.fields['text'] = _textEditingController.text;
    request.fields['uid'] = uidUser;
    request.fields['mode'] = "payant";
    request.fields['paymentMethod'] = valueMethodePaiement;
    request.fields['tel'] = telController.text;

    request.fields.addAll(BoostBilling.buildOptionFields(
      formulaAmount: prixBoost,
      rewardEnabled: _participateInReward,
      rewardBudget: _rewardBudget,
      customRewardBudget: _isCustomRewardBudget,
      publishOnDressurStatus: _publishOnDressurStatus,
      facebookEnabled: _boostFacebook,
      facebookAmount: _boostFacebookAmountController.text,
      includeSource: false,
      formulaDays: joursBoost,
    ));
    request.fields['whatsappContact'] = whatsappContactController.text.trim();
    _debugValidatePromotionRequest(request);

    try {
      final uploadFile = await _createPromotionUploadFile(
        imageFile: _imageFile!,
        fileName: 'temp_image.jpg',
      );
      request.files.add(
        await http.MultipartFile.fromPath('image', uploadFile.path),
      );

      final response = await request.send();
      final responseBody = await response.stream.bytesToString();
      if (!mounted) return;
      final data = _decodePromotionApiResponse(responseBody);
      if (response.statusCode < 200 ||
          response.statusCode >= 300 ||
          data == null ||
          data['error'] == true) {
        _showPromotionApiError(
          context: context,
          isFrench: langUserPhone == "fr",
          statusCode: response.statusCode,
          data: data,
        );
        setState(() => _isSending = false);
        return;
      }

      setState(() {
        // 1. Réinitialisation des états de chargement et financiers
        _isSending = false;
        prixBoost = 0;
        joursBoost = 0;
        prix = 0;
        jours = 0;
        value = 0;
        idFormulBoost = 0;

        // 2. Réinitialisation des médias
        _imageFile = null;

        // 3. Réinitialisation des contrôleurs de texte
        _textEditingController.clear(); // Description
        whatsappContactController.text = tel; // Remettre le numéro utilisateur

        // 4. Réinitialisation des messages et labels
        _message = (langUserPhone == "fr")
            ? "Veuillez choisir une formule."
            : "Please choose a plan.";
        label = "";

        // 5. Réinitialisation des options spécifiques (Reward & Status & Boost Facebook)
        _participateInReward = false;
        _rewardBudget = 0;
        _isCustomRewardBudget = false;
        _rewardBudgetError = null;
        _customRewardBudgetController.clear();
        _publishOnDressurStatus = false;
        _boostFacebook = false;
        _boostFacebookAmountController.text = '700';

        // 6. Réinitialisation du mode de paiement par défaut
        valueMethodePaiement = "mtn";
      });

      cancelPromoReminderNotification();
      if (data["solde_used"] == true) {
        successNoti(
            (langUserPhone == "fr") ? "Succès" : "Success",
            data["message"] ??
                ((langUserPhone == "fr")
                    ? "Solde débité. Promotion Affaire enregistrée."
                    : "Balance debited. Promotion registered."),
            context);
      } else if (data["direct"] == true) {
        successNoti(
            (langUserPhone == "fr") ? "Succès" : "Success",
            (langUserPhone == "fr")
                ? "Veuillez confirmer le paiement pour finaliser l'enregistrement de votre promotion."
                : "Please confirm payment to finalize the registration of your promotion.",
            context);
      } else {
        launchPaiement(data["url"]);
        successNoti(
            (langUserPhone == "fr") ? "Succès" : "Success",
            (langUserPhone == "fr")
                ? "Veuillez confirmer le paiement pour finaliser l'enregistrement de votre promotion."
                : "Please confirm payment to finalize the registration of your promotion.",
            context);
      }
    } catch (_) {
      if (!mounted) return;
      setState(() => _isSending = false);
      _showPromotionApiError(
        context: context,
        isFrench: langUserPhone == "fr",
        statusCode: 0,
      );
    }
  }

  void listeFormulePromoAffaire() async {
    if (await isConnectedToInternet()) {
      setState(() => loading_formule_gratuit = true);
      var response = await http
          .post(Uri.parse('$generalRouteForApi/listeFormulePromoAffaire'));
      if (response.statusCode == 200) {
        var data = jsonDecode(response.body);
        if (data["error"] == false) {
          setState(() {
            loading_formule_gratuit = false;
            listeDesFormules =
                List<Map<String, dynamic>>.from(data["listeFormulBoost"]);
            listeMethodePaiements =
                List<Map<String, dynamic>>.from(data["listeMethodePaiements"]);
            _message = (langUserPhone == "fr")
                ? "Veuillez choisir une formule."
                : "Please choose a plan.";
          });
        }
      }
    } else {
      dangerNoti(
          "Erreur",
          (langUserPhone == "fr")
              ? "Pas de connexion internet."
              : "No internet connection.",
          context);
      setState(() => loading_formule_gratuit = false);
    }
  }

  onChangeFormulBoost(val) {
    final selected = listeDesFormules
        .firstWhere((e) => e['value'].toString() == val.toString());
    setState(() {
      idFormulBoost = int.parse(val.toString());
      prixBoost = selected['prix'];
      joursBoost = selected['jours'];

      value = selected['value'];
      label = selected['label'];
      prix = selected['prix'];
      jours = selected['jours'];
      idFormulBoost = val;
      _message = (langUserPhone == "fr")
          ? "Formule de $jours jour(s) pour $prix FCFA."
          : "Plan of $jours day(s) for $prix FCFA.";

      // Désactiver le Statut WhatsApp si la formule est < 1000 FCFA
      if (prixBoost < 1000) {
        _publishOnDressurStatus = false;
      }
    });
  }

  @override
  void initState() {
    super.initState();
    listeFormulePromoAffaire();
  }

  @override
  void dispose() {
    _boostFacebookAmountController.dispose();
    _customRewardBudgetController.dispose();
    whatsappContactController.dispose();
    super.dispose();
  }

  Widget _buildNumberInput(String label, TextEditingController controller) {
    return Row(
      children: [
        Expanded(child: Text(label, style: GoogleFonts.poppins(fontSize: 13))),
        SizedBox(
          width: 100,
          child: TextField(
            controller: controller,
            keyboardType: TextInputType.number,
            decoration:
                InputDecoration(isDense: true, border: OutlineInputBorder()),
          ),
        ),
      ],
    );
  }

  Widget _infoBox(String text, Color color) {
    return Container(
      width: double.infinity,
      padding: EdgeInsets.all(10),
      decoration: BoxDecoration(
          color: color.withOpacity(0.1),
          borderRadius: BorderRadius.circular(8),
          border: Border.all(color: color.withOpacity(0.3))),
      child: Text(text,
          style: GoogleFonts.poppins(
              color: color, fontWeight: FontWeight.bold, fontSize: 13),
          textAlign: TextAlign.center),
    );
  }

  Widget _buildRecap() {
    return Container(
      padding: EdgeInsets.all(15),
      decoration: BoxDecoration(
          borderRadius: BorderRadius.circular(10),
          border: Border.all(color: Colors.grey[300]!)),
      child: Column(
        children: [
          _recapRow((langUserPhone == "fr") ? "Formule Boost" : "Boost Plan",
              prixBoost.toDouble()),
          if (_participateInReward)
            _recapRow(
                (langUserPhone == "fr")
                    ? "Programme Récompense"
                    : "Reward Program",
                _rewardProgramAmount),
          if (_publishOnDressurStatus)
            _recapRow(
                (langUserPhone == "fr")
                    ? "Statut WhatsApp & Story Dressur"
                    : "WhatsApp Status & Story Dressur",
                _dressurStatusAmount),
          if (_boostFacebook)
            _recapRow(
                (langUserPhone == "fr")
                    ? "Boost Facebook"
                    : "Facebook Boost",
                _boostFacebookAmount),
          Divider(height: 20),
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Text((langUserPhone == "fr") ? "TOTAL" : "TOTAL",
                  style: GoogleFonts.poppins(
                    fontWeight: FontWeight.bold,
                    fontSize: 18,
                  )),
              Text("${_subTotal.toStringAsFixed(0)} FCFA",
                  style: GoogleFonts.poppins(
                    fontWeight: FontWeight.bold,
                    fontSize: 18,
                    color: primaryColor,
                  )),
            ],
          ),
        ],
      ),
    );
  }

  Widget _recapRow(String label, double amount,
      {bool isBold = false, bool isSmall = false}) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 2),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          Text(label,
              style: GoogleFonts.poppins(
                  fontSize: isSmall ? 11 : 13,
                  fontWeight: isBold ? FontWeight.bold : FontWeight.normal)),
          Text("${amount.toStringAsFixed(0)} F",
              style: GoogleFonts.poppins(
                  fontSize: isSmall ? 11 : 13,
                  fontWeight: isBold ? FontWeight.bold : FontWeight.normal)),
        ],
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    Theme.of(context);
    return Container(
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.stretch,
        children: [
          const SizedBox(height: 5),
          loading_formule_gratuit
              ? const Center(
                  child: CircularProgressIndicator(color: primaryColor))
              : SelectFormField(
                  decoration: InputDecoration(
                      labelText: (langUserPhone == "fr")
                          ? 'Formule de Boost'
                          : 'Boost Plan',
                      border: const OutlineInputBorder()),
                  type: SelectFormFieldType.dropdown,
                  initialValue: '0',
                  items: listeDesFormules,
                  onChanged: (val) => onChangeFormulBoost(val),
                ),
          const SizedBox(height: 10),
          if (_message.isNotEmpty)
            Text(_message,
                style: GoogleFonts.poppins(fontSize: 14, color: primaryColor),
                textAlign: TextAlign.center),
          const SizedBox(height: 15),

          ElevatedButton(
            onPressed: _isSending ? null : _selectImage,
            style: ElevatedButton.styleFrom(
                backgroundColor: primaryColor,
                shape: const StadiumBorder(),
                padding: const EdgeInsets.symmetric(vertical: 13)),
            child: Text(
                (langUserPhone == "fr")
                    ? "Sélectionner l'image"
                    : 'Select image',
                style: GoogleFonts.poppins(
                    color: Colors.white, fontWeight: FontWeight.w600)),
          ),
          if (_imageFile != null)
            Container(
                margin: const EdgeInsets.only(top: 10),
                child: Image.file(_imageFile!, fit: BoxFit.contain)),
          const SizedBox(height: 10),
          TextField(
              controller: _textEditingController,
              minLines: 1,
              maxLines: 10,
              decoration: InputDecoration(
                  labelText: 'Description',
                  border: const OutlineInputBorder())),

          const SizedBox(height: 10),

          // --- WHATSAPP CONTACT ---
          TextFormField(
            controller: whatsappContactController,
            keyboardType: TextInputType.phone,
            decoration: InputDecoration(
              labelText: (langUserPhone == "fr")
                  ? 'Numéro WhatsApp de contact'
                  : 'WhatsApp contact number',
              hintText: '+22890000000',
              prefixIcon: Icon(FontAwesomeIcons.whatsapp, color: Colors.green),
              border: const OutlineInputBorder(),
            ),
            validator: (value) {
              final waRegex = RegExp(r'^\+\d{11,}$');
              if (value == null || !waRegex.hasMatch(value.trim())) {
                return (langUserPhone == "fr")
                    ? 'Format invalide : + suivi d\'au moins 11 chiffres'
                    : 'Invalid format: + followed by at least 11 digits';
              }
              return null;
            },
          ),

          const SizedBox(height: 10),

          // --- SECTION PROGRAMME DE RÉCOMPENSE ---
          _buildOptionHeader(
              FontAwesomeIcons.star,
              (langUserPhone == "fr")
                  ? "Programme de Récompense"
                  : "Reward Program",
              _participateInReward),
          SwitchListTile(
            title: Text(
                (langUserPhone == "fr")
                    ? "Ajouter votre promotion au programme"
                    : "Add your promotion to the program",
                style: GoogleFonts.poppins(
                    fontSize: 14, fontWeight: FontWeight.w500)),
            subtitle: Text(
                (langUserPhone == "fr")
                    ? "Attirez plus de vues en récompensant les utilisateurs qui le publieront sur leur statut WhatsApp. Dressur se charge de la mise en application et de la vérification."
                    : "Get more views by rewarding users who share it on their WhatsApp status. Dressur handles the implementation and verification.",
                style: GoogleFonts.poppins(fontSize: 11)),
            value: _participateInReward,
            activeColor: primaryColor,
             onChanged: (val) => setState(() {
               _participateInReward = val;
               _isCustomRewardBudget = false;
               _rewardBudget = val ? 500 : 0;
               _rewardBudgetError = null;
               _customRewardBudgetController.clear();
             }),
          ),
          if (_participateInReward) ...[
            Padding(
              padding: const EdgeInsets.symmetric(horizontal: 16),
              child: Column(
                children: [
                  Text(
                    (langUserPhone == "fr")
                        ? "Choisissez votre budget récompenses"
                        : "Choose your reward budget",
                    style: GoogleFonts.poppins(fontSize: 13, fontWeight: FontWeight.w500),
                  ),
                  const SizedBox(height: 10),
                  Wrap(
                    spacing: 8,
                    runSpacing: 8,
                    children: [
                      ...[500, 1000, 2000, 5000].map((budget) {
                        final selected =
                            !_isCustomRewardBudget && _rewardBudget == budget;
                      return GestureDetector(
                        onTap: () => setState(() {
                          _isCustomRewardBudget = false;
                          _rewardBudget = budget;
                          _rewardBudgetError = null;
                          _customRewardBudgetController.clear();
                        }),
                        child: Container(
                          padding: const EdgeInsets.symmetric(horizontal: 18, vertical: 10),
                          decoration: BoxDecoration(
                            color: selected ? primaryColor : Colors.transparent,
                            borderRadius: BorderRadius.circular(20),
                            border: Border.all(color: primaryColor),
                          ),
                          child: Text(
                            "${budget == 1000 ? '1 000' : budget == 2000 ? '2 000' : budget == 5000 ? '5 000' : budget} F",
                            style: GoogleFonts.poppins(
                              fontSize: 13,
                              fontWeight: FontWeight.w600,
                              color: selected ? Colors.white : primaryColor,
                            ),
                          ),
                        ),
                      );
                      }),
                      GestureDetector(
                        onTap: () => setState(() {
                          _isCustomRewardBudget = true;
                          _rewardBudget = 0;
                          _rewardBudgetError =
                              _customRewardBudgetController.text.trim().isEmpty
                                  ? _rewardBudgetRequiredMessage
                                  : null;
                        }),
                        child: Container(
                          padding: const EdgeInsets.symmetric(
                              horizontal: 18, vertical: 10),
                          decoration: BoxDecoration(
                            color: _isCustomRewardBudget
                                ? primaryColor
                                : Colors.transparent,
                            borderRadius: BorderRadius.circular(20),
                            border: Border.all(color: primaryColor),
                          ),
                          child: Text(
                            langUserPhone == "fr" ? "Autre" : "Other",
                            style: GoogleFonts.poppins(
                              fontSize: 13,
                              fontWeight: FontWeight.w600,
                              color: _isCustomRewardBudget
                                  ? Colors.white
                                  : primaryColor,
                            ),
                          ),
                        ),
                      ),
                    ],
                  ),
                  if (_isCustomRewardBudget) ...[
                    const SizedBox(height: 12),
                    TextField(
                      controller: _customRewardBudgetController,
                      keyboardType: TextInputType.number,
                      inputFormatters: [
                        FilteringTextInputFormatter.digitsOnly,
                      ],
                      onChanged: _onCustomRewardBudgetChanged,
                      decoration: InputDecoration(
                        labelText: langUserPhone == "fr"
                            ? "Montant personnalisé"
                            : "Custom amount",
                        hintText: "Supérieur à 5 000 FCFA",
                        suffixText: "FCFA",
                        errorText: _rewardBudgetError,
                        border: const OutlineInputBorder(),
                      ),
                    ),
                  ],
                ],
              ),
            ),
          ],

          const SizedBox(height: 15),

          // --- SECTION STATUT WHATSAPP & STORY DRESSUR (formule >= 1000 FCFA) ---
          if (prixBoost >= 1000) ...[
          _buildOptionHeader(
            FontAwesomeIcons.solidCircleCheck,
            (langUserPhone == "fr")
                ? "Statut WhatsApp de Dressur et Story"
                : "Dressur WhatsApp Status & Story",
            _publishOnDressurStatus,
          ),
          SwitchListTile(
            title: Text(
              (langUserPhone == "fr")
                  ? "Ajouter au statut WhatsApp de Dressur et à la Story sur Dressur"
                  : "Add to Dressur WhatsApp status and Dressur Story",
              style: GoogleFonts.poppins(
                  fontSize: 14, fontWeight: FontWeight.w500),
            ),
            subtitle: Text(
              (langUserPhone == "fr")
                  ? "Bénéficiez d'une visibilité maximale : votre promotion sera publiée sur le statut WhatsApp de Dressur et apparaîtra dans les Stories sur l'application pendant toute la durée de votre promotion."
                  : "Get maximum visibility: your promotion will be published on Dressur's WhatsApp status and appear in Stories on the app for the entire duration of your promotion.",
              style: GoogleFonts.poppins(fontSize: 11),
            ),
            value: _publishOnDressurStatus,
            activeColor: primaryColor,
            onChanged: (val) => setState(() => _publishOnDressurStatus = val),
          ),
          if (_publishOnDressurStatus)
            Padding(
              padding: const EdgeInsets.symmetric(horizontal: 10),
              child: Column(
                children: [
                  _infoBox(
                      (langUserPhone == "fr")
                          ? "Frais Statut WhatsApp & Story Dressur : ${_dressurStatusAmount.toStringAsFixed(0)} FCFA"
                          : "WhatsApp Status & Story Dressur fee: ${_dressurStatusAmount.toStringAsFixed(0)} FCFA",
                      Colors.blue),
                ],
              ),
            ),
          ], // fin if (prixBoost >= 1000)

          const SizedBox(height: 15),

          // --- SECTION BOOST PAGE FACEBOOK ---
          _buildOptionHeader(
              FontAwesomeIcons.facebookF,
              (langUserPhone == "fr")
                  ? "Boost Page Facebook Dressur"
                  : "Dressur Facebook Page Boost",
              _boostFacebook),
          SwitchListTile(
            title: Text(
                (langUserPhone == "fr")
                    ? "Publier et booster sur la page Facebook de Dressur"
                    : "Post and boost on Dressur's Facebook page",
                style: GoogleFonts.poppins(
                    fontSize: 14, fontWeight: FontWeight.w500)),
            subtitle: Text(
                (langUserPhone == "fr")
                    ? "Votre promotion sera publiée sur la page Facebook officielle de Dressur et boostée auprès d'une audience ciblée. Budget minimum 700 FCFA."
                    : "Your promotion will be posted on Dressur's official Facebook page and boosted to a targeted audience. Minimum budget 700 FCFA.",
                style: GoogleFonts.poppins(fontSize: 11)),
            value: _boostFacebook,
            activeColor: primaryColor,
            onChanged: (val) => setState(() => _boostFacebook = val),
          ),
          if (_boostFacebook) ...[
            Padding(
              padding: const EdgeInsets.symmetric(horizontal: 16),
              child: TextField(
                controller: _boostFacebookAmountController,
                keyboardType: TextInputType.number,
                onChanged: (_) => setState(() {}),
                decoration: InputDecoration(
                  labelText: (langUserPhone == "fr")
                      ? "Budget boost (min. 700 FCFA)"
                      : "Boost budget (min. 700 FCFA)",
                  border: const OutlineInputBorder(),
                  suffixText: "FCFA",
                ),
              ),
            ),
          ],

          const SizedBox(height: 15),
          _buildRecap(),
          const SizedBox(height: 15),

          SelectFormField(
            decoration: const InputDecoration(
                labelText: 'Moyen de paiement', border: OutlineInputBorder()),
            type: SelectFormFieldType.dropdown,
            initialValue: 'mtn',
            items: listeMethodePaiements,
            onChanged: (val) => setState(() => valueMethodePaiement = val),
          ),
          const SizedBox(height: 10),
          TextField(
              controller: telController,
              decoration: InputDecoration(
                  labelText: (langUserPhone == "fr")
                      ? 'Numéro du paiement'
                      : 'Payment number',
                  border: const OutlineInputBorder())),

          const SizedBox(height: 15),
          ElevatedButton(
            onPressed: _isSending ? null : _sendData,
            style: ElevatedButton.styleFrom(
                backgroundColor: primaryColor,
                shape: const StadiumBorder(),
                padding: const EdgeInsets.symmetric(vertical: 15)),
            child: _isSending
                ? const CircularProgressIndicator(color: Colors.white)
                : Text(
                    (langUserPhone == "fr")
                        ? 'VALIDER ET PAYER'
                        : 'VALIDATE AND PAY',
                    style: GoogleFonts.poppins(
                        color: Colors.white, fontWeight: FontWeight.bold)),
          ),
        ],
      ),
    );
  }

  Widget _buildOptionHeader(IconData icon, String title, bool isActive) {
    return Row(
      children: [
        FaIcon(icon, color: isActive ? primaryColor : Colors.grey, size: 20),
        SizedBox(width: 10),
        Text(title,
            style: GoogleFonts.poppins(
                fontWeight: FontWeight.bold,
                fontSize: 15,
                color: isActive ? primaryColor : Colors.grey[700])),
      ],
    );
  }
}

class _PromotionImageCropper extends StatefulWidget {
  const _PromotionImageCropper({
    required this.imageFile,
    required this.isFrench,
  });

  final File imageFile;
  final bool isFrench;

  @override
  State<_PromotionImageCropper> createState() => _PromotionImageCropperState();
}

class _PromotionImageCropperState extends State<_PromotionImageCropper> {
  static const _ratios = <_PromotionCropRatio>[
    _PromotionCropRatio(label: '1:1', value: 1),
    _PromotionCropRatio(label: '4:3', value: 4 / 3),
    _PromotionCropRatio(label: '3:4', value: 3 / 4),
  ];

  img.Image? _decodedImage;
  Uint8List? _imageBytes;
  _PromotionCropRatio _selectedRatio = _ratios.first;
  double _zoom = 1;
  Offset _offset = Offset.zero;
  double _gestureZoom = 1;
  Offset _gestureOffset = Offset.zero;
  Offset _gestureFocalPoint = Offset.zero;
  bool _isSaving = false;
  String? _errorMessage;

  @override
  void initState() {
    super.initState();
    _loadImage();
  }

  Future<void> _loadImage() async {
    try {
      final bytes = await widget.imageFile.readAsBytes();
      final decoded = img.decodeImage(bytes);
      if (decoded == null) {
        throw const FormatException('Unsupported image format');
      }
      final orientedImage = img.bakeOrientation(decoded);
      if (!mounted) return;
      setState(() {
        _imageBytes = Uint8List.fromList(img.encodePng(orientedImage));
        _decodedImage = orientedImage;
      });
    } catch (_) {
      if (!mounted) return;
      setState(() {
        _errorMessage = widget.isFrench
            ? "Cette image ne peut pas être recadrée."
            : "This image cannot be cropped.";
      });
    }
  }

  double _baseScale(Size frameSize) {
    final image = _decodedImage!;
    return math.max(
      frameSize.width / image.width,
      frameSize.height / image.height,
    ).toDouble();
  }

  Offset _clampOffset({
    required Offset offset,
    required Size frameSize,
    required double baseScale,
    required double zoom,
  }) {
    final image = _decodedImage!;
    final renderedWidth = image.width * baseScale * zoom;
    final renderedHeight = image.height * baseScale * zoom;
    final maxX =
        math.max(0.0, (renderedWidth - frameSize.width) / 2).toDouble();
    final maxY =
        math.max(0.0, (renderedHeight - frameSize.height) / 2).toDouble();
    return Offset(
      offset.dx.clamp(-maxX, maxX).toDouble(),
      offset.dy.clamp(-maxY, maxY).toDouble(),
    );
  }

  void _onScaleStart(ScaleStartDetails details) {
    _gestureZoom = _zoom;
    _gestureOffset = _offset;
    _gestureFocalPoint = details.localFocalPoint;
  }

  void _onScaleUpdate(
    ScaleUpdateDetails details,
    Size frameSize,
    double baseScale,
  ) {
    final nextZoom = (details.scale * _gestureZoom).clamp(1.0, 4.0).toDouble();
    final frameCenter = Offset(frameSize.width / 2, frameSize.height / 2);
    final zoomOffset =
        (_gestureFocalPoint - frameCenter) * (_gestureZoom - nextZoom);
    final panOffset = details.localFocalPoint - _gestureFocalPoint;
    final nextOffset = _clampOffset(
      offset: _gestureOffset + zoomOffset + panOffset,
      frameSize: frameSize,
      baseScale: baseScale,
      zoom: nextZoom,
    );
    setState(() {
      _zoom = nextZoom;
      _offset = nextOffset;
    });
  }

  Future<void> _confirmCrop(Size frameSize, double baseScale) async {
    if (_decodedImage == null || _isSaving) return;
    setState(() => _isSaving = true);

    try {
      final image = _decodedImage!;
      final displayScale = baseScale * _zoom;
      final renderedWidth = image.width * displayScale;
      final renderedHeight = image.height * displayScale;
      final sourceX =
          ((renderedWidth - frameSize.width) / 2 - _offset.dx) / displayScale;
      final sourceY =
          ((renderedHeight - frameSize.height) / 2 - _offset.dy) / displayScale;
      final sourceWidth = frameSize.width / displayScale;
      final sourceHeight = frameSize.height / displayScale;

      final cropX =
          sourceX.round().clamp(0, image.width - 1).toInt();
      final cropY =
          sourceY.round().clamp(0, image.height - 1).toInt();
      final cropWidth =
          sourceWidth.round().clamp(1, image.width - cropX).toInt();
      final cropHeight =
          sourceHeight.round().clamp(1, image.height - cropY).toInt();
      final cropped = img.copyCrop(
        image,
        x: cropX,
        y: cropY,
        width: cropWidth,
        height: cropHeight,
      );

      // PNG keeps the crop lossless. The existing upload pipeline remains
      // unchanged and no additional compression is introduced here.
      final encodedCrop = img.encodePng(cropped);
      final tempDirectory = await getTemporaryDirectory();
      final outputFile = File(
        '${tempDirectory.path}/promotion_crop_${DateTime.now().microsecondsSinceEpoch}.png',
      );
      await outputFile.writeAsBytes(encodedCrop, flush: true);

      if (!mounted) return;
      Navigator.of(context).pop(outputFile);
    } catch (_) {
      if (!mounted) return;
      setState(() => _isSaving = false);
      dangerNoti(
        widget.isFrench ? "Attention !!!" : "Warning !!!",
        widget.isFrench
            ? "Impossible de recadrer cette image."
            : "Unable to crop this image.",
        context,
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Dialog(
      insetPadding: const EdgeInsets.symmetric(horizontal: 16, vertical: 24),
      backgroundColor: const Color(0xff101114),
      child: ConstrainedBox(
        constraints: BoxConstraints(
          maxWidth: 620,
          maxHeight: MediaQuery.sizeOf(context).height * 0.9,
        ),
        child: SafeArea(
          child: Padding(
            padding: const EdgeInsets.fromLTRB(16, 16, 16, 12),
            child: _buildContent(context),
          ),
        ),
      ),
    );
  }

  Widget _buildContent(BuildContext context) {
    if (_errorMessage != null) {
      return Column(
        mainAxisSize: MainAxisSize.min,
        children: [
          Text(
            _errorMessage!,
            style: const TextStyle(color: Colors.white),
            textAlign: TextAlign.center,
          ),
          const SizedBox(height: 16),
          TextButton(
            onPressed: () => Navigator.of(context).pop(),
            child: Text(widget.isFrench ? "Fermer" : "Close"),
          ),
        ],
      );
    }

    if (_decodedImage == null || _imageBytes == null) {
      return const SizedBox(
        height: 260,
        child: Center(
          child: CircularProgressIndicator(color: Colors.white),
        ),
      );
    }

    return LayoutBuilder(
      builder: (context, constraints) {
        final ratio = _selectedRatio.value;
        final availableWidth = constraints.maxWidth;
        final availableHeight = math.max(180.0, constraints.maxHeight - 190);
        final frameWidth =
            math.min(availableWidth, availableHeight * ratio).toDouble();
        final frameSize = Size(frameWidth, frameWidth / ratio);
        final baseScale = _baseScale(frameSize);
        final image = _decodedImage!;
        final renderedWidth = (image.width * baseScale).toDouble();
        final renderedHeight = (image.height * baseScale).toDouble();

        return Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            Row(
              children: [
                Expanded(
                  child: Text(
                    widget.isFrench ? "Recadrer l'image" : "Crop image",
                    style: const TextStyle(
                      color: Colors.white,
                      fontSize: 18,
                      fontWeight: FontWeight.w700,
                    ),
                  ),
                ),
                IconButton(
                  tooltip: widget.isFrench ? "Annuler" : "Cancel",
                  onPressed:
                      _isSaving ? null : () => Navigator.of(context).pop(),
                  icon: const Icon(Icons.close, color: Colors.white),
                ),
              ],
            ),
            const SizedBox(height: 8),
            SizedBox(
              width: frameSize.width,
              height: frameSize.height,
              child: ClipRect(
                child: GestureDetector(
                  behavior: HitTestBehavior.opaque,
                  onScaleStart: _onScaleStart,
                  onScaleUpdate: (details) =>
                      _onScaleUpdate(details, frameSize, baseScale),
                  child: Stack(
                    fit: StackFit.expand,
                    children: [
                      Container(color: Colors.black),
                      Center(
                        child: Transform.translate(
                          offset: _offset,
                          child: Transform.scale(
                            scale: _zoom,
                            child: SizedBox(
                              width: renderedWidth,
                              height: renderedHeight,
                              child: Image.memory(
                                _imageBytes!,
                                fit: BoxFit.cover,
                                filterQuality: FilterQuality.high,
                              ),
                            ),
                          ),
                        ),
                      ),
                      IgnorePointer(
                        child: CustomPaint(
                          painter: _PromotionCropOverlayPainter(),
                        ),
                      ),
                    ],
                  ),
                ),
              ),
            ),
            const SizedBox(height: 12),
            Text(
              widget.isFrench
                  ? "Déplacez l'image et pincez pour zoomer"
                  : "Move the image and pinch to zoom",
              style: TextStyle(color: Colors.white.withOpacity(0.72)),
              textAlign: TextAlign.center,
            ),
            const SizedBox(height: 10),
            Wrap(
              alignment: WrapAlignment.center,
              spacing: 8,
              children: _ratios.map((ratioOption) {
                final selected = ratioOption == _selectedRatio;
                return ChoiceChip(
                  label: Text(ratioOption.label),
                  selected: selected,
                  onSelected: _isSaving
                      ? null
                      : (_) => setState(() {
                            _selectedRatio = ratioOption;
                            _zoom = 1;
                            _offset = Offset.zero;
                          }),
                  selectedColor: Colors.white,
                  backgroundColor: Colors.white.withOpacity(0.12),
                  labelStyle: TextStyle(
                    color: selected ? Colors.black : Colors.white,
                    fontWeight: FontWeight.w700,
                  ),
                );
              }).toList(),
            ),
            const SizedBox(height: 14),
            Row(
              children: [
                Expanded(
                  child: OutlinedButton(
                    onPressed:
                        _isSaving ? null : () => Navigator.of(context).pop(),
                    style: OutlinedButton.styleFrom(
                      foregroundColor: Colors.white,
                      side: BorderSide(color: Colors.white.withOpacity(0.5)),
                    ),
                    child: Text(widget.isFrench ? "Annuler" : "Cancel"),
                  ),
                ),
                const SizedBox(width: 10),
                Expanded(
                  child: ElevatedButton(
                    onPressed: _isSaving
                        ? null
                        : () => _confirmCrop(frameSize, baseScale),
                    style: ElevatedButton.styleFrom(
                      backgroundColor: Colors.white,
                      foregroundColor: Colors.black,
                    ),
                    child: _isSaving
                        ? const SizedBox(
                            height: 18,
                            width: 18,
                            child: CircularProgressIndicator(
                              strokeWidth: 2,
                              color: Colors.black,
                            ),
                          )
                        : Text(widget.isFrench ? "Utiliser l'image" : "Use image"),
                  ),
                ),
              ],
            ),
          ],
        );
      },
    );
  }
}

class _PromotionCropRatio {
  const _PromotionCropRatio({
    required this.label,
    required this.value,
  });

  final String label;
  final double value;
}

class _PromotionCropOverlayPainter extends CustomPainter {
  @override
  void paint(Canvas canvas, Size size) {
    final borderPaint = Paint()
      ..color = Colors.white
      ..style = PaintingStyle.stroke
      ..strokeWidth = 2;
    final gridPaint = Paint()
      ..color = Colors.white.withOpacity(0.5)
      ..style = PaintingStyle.stroke
      ..strokeWidth = 1;

    canvas.drawRect(
      Rect.fromLTWH(1, 1, size.width - 2, size.height - 2),
      borderPaint,
    );
    final thirdWidth = size.width / 3;
    final thirdHeight = size.height / 3;
    for (var index = 1; index < 3; index++) {
      canvas.drawLine(
        Offset(thirdWidth * index, 0),
        Offset(thirdWidth * index, size.height),
        gridPaint,
      );
      canvas.drawLine(
        Offset(0, thirdHeight * index),
        Offset(size.width, thirdHeight * index),
        gridPaint,
      );
    }
  }

  @override
  bool shouldRepaint(covariant CustomPainter oldDelegate) => false;
}

class DemandesEmploi extends StatefulWidget {
  @override
  State<DemandesEmploi> createState() => _DemandesEmploiState();
}

class _DemandesEmploiState extends State<DemandesEmploi> {
  bool _desactive = false;
  var data;
  final titre_demande_poste_rechercher_controller = TextEditingController();
  final description_profil_demandeur_controller = TextEditingController();
  final competence_qualification_controller = TextEditingController();
  final niveau_experience_controller = TextEditingController();
  final secteur_activite_rechercher_controller = TextEditingController();
  final type_contrat_rechercher_controller = TextEditingController();
  final localisation_souhaite_controller = TextEditingController();
  final salaire_souhaite_controller = TextEditingController();
  final langues_parle_controller = TextEditingController();
  final lien_portfolio_controller = TextEditingController();
  final coordonne_demandeur_controller = TextEditingController();

  void add_dmd_emploi(
      String titre_demande_poste_rechercher,
      String description_profil_demandeur,
      String competence_qualification,
      String niveau_experience,
      String secteur_activite_rechercher,
      String type_contrat_rechercher,
      String localisation_souhaite,
      String salaire_souhaite,
      String langues_parle,
      String lien_portfolio,
      String coordonne_demandeur) async {
    bool isConnected = await isConnectedToInternet();
    if (isConnected) {
      setState(() {
        _desactive = true;
      });

      var request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/newDmdEmploi'));
      request.fields.addAll({
        'uid': uidUser,
        'titre_demande_poste_rechercher': titre_demande_poste_rechercher,
        'description_profil_demandeur': description_profil_demandeur,
        'competence_qualification': competence_qualification,
        'niveau_experience': niveau_experience,
        'secteur_activite_rechercher': secteur_activite_rechercher,
        'type_contrat_rechercher': type_contrat_rechercher,
        'localisation_souhaite': localisation_souhaite,
        'salaire_souhaite': salaire_souhaite,
        'langues_parle': langues_parle,
        'lien_portfolio': lien_portfolio,
        'coordonne_demandeur': coordonne_demandeur,
      });

      http.StreamedResponse response = await request.send();

      if (response.statusCode == 200) {
        var data1 = await response.stream.bytesToString();
        data = convert.jsonDecode(data1);
        if (data["error"] == true) {
          dangerNoti(data["titre"], data["message"], context);
          setState(() {
            _desactive = false;
          });
        } else {
          setState(() {
            _desactive = false;
          });
          cancelPromoReminderNotification();
          successNoti(
              "Good",
              (langUserPhone == "fr")
                  ? "Votre demande d'emploi a été enregistrée et sera publiée après accord d'un des administrateurs de Dressur."
                  : "Your job application has been registered and will be published after approval by one of Dressur's administrators.",
              context);
          titre_demande_poste_rechercher_controller.clear();
          description_profil_demandeur_controller.clear();
          competence_qualification_controller.clear();
          niveau_experience_controller.clear();
          secteur_activite_rechercher_controller.clear();
          type_contrat_rechercher_controller.clear();
          localisation_souhaite_controller.clear();
          salaire_souhaite_controller.clear();
          langues_parle_controller.clear();
          lien_portfolio_controller.clear();
          coordonne_demandeur_controller.clear();
        }
      } else {
        if (langUserPhone != "fr") {
          dangerNoti("Mistake!",
              "We encountered a problem, contact the administrators.", context);
        } else {
          dangerNoti(
              "Erreur!",
              "Nous avons rencontré un problème, contacter les administrateurs.",
              context);
        }
        setState(() {
          _desactive = false;
        });
      }
    } else {
      if (langUserPhone != "fr") {
        dangerNoti(
            "Mistake!", "You are not connected to the internet.", context);
      } else {
        dangerNoti("Erreur!", "Vous n'ètes pas connecté a internet.", context);
      }
      setState(() {
        _desactive = false;
      });
    }
  }

  @override
  void initState() {
    super.initState();
    // listeFormulePromoAffaire(); // Loading the diary when the app starts
  }

  @override
  Widget build(BuildContext context) {
    return Container(
      child: Column(
        children: [
          TextField(
            controller: titre_demande_poste_rechercher_controller,
            decoration: InputDecoration(
              labelStyle: GoogleFonts.poppins(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? 'Titre de la demande ou poste recherché'
                  : 'Title of application or position sought',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: description_profil_demandeur_controller,
            minLines: 1,
            maxLines: 5,
            decoration: InputDecoration(
              labelStyle: GoogleFonts.poppins(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? 'Description du profil du demandeur'
                  : "Description of the applicant's profile",
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: competence_qualification_controller,
            minLines: 1,
            maxLines: 3,
            decoration: InputDecoration(
              labelStyle: GoogleFonts.poppins(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? 'Compétences et qualification (listes)'
                  : 'Skills and qualification (lists)',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: niveau_experience_controller,
            minLines: 1,
            maxLines: 2,
            decoration: InputDecoration(
              labelStyle: GoogleFonts.poppins(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Niveau d'experience (Nombres d'année d'expérience)"
                  : 'Level of experience (Number of years of experience)',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: secteur_activite_rechercher_controller,
            minLines: 1,
            maxLines: 2,
            decoration: InputDecoration(
              labelStyle: GoogleFonts.poppins(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Secteur d'activté rechercher"
                  : 'Sector of activity search',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: type_contrat_rechercher_controller,
            minLines: 1,
            maxLines: 3,
            decoration: InputDecoration(
              labelStyle: GoogleFonts.poppins(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Type de contrat rechercher"
                  : 'Type of contract search',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: localisation_souhaite_controller,
            minLines: 1,
            maxLines: 3,
            decoration: InputDecoration(
              labelStyle: GoogleFonts.poppins(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Localisation souhaité"
                  : 'Desired location',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: salaire_souhaite_controller,
            minLines: 1,
            maxLines: 1,
            decoration: InputDecoration(
              labelStyle: GoogleFonts.poppins(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Salaire souhaité"
                  : 'Desired salary',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: langues_parle_controller,
            minLines: 1,
            maxLines: 3,
            decoration: InputDecoration(
              labelStyle: GoogleFonts.poppins(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Langues parlées"
                  : 'Languages spoken',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: lien_portfolio_controller,
            minLines: 1,
            maxLines: 1,
            decoration: InputDecoration(
              labelStyle: GoogleFonts.poppins(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Lien vers votre portfolio ou cv"
                  : 'Link to your portfolio or CV',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: coordonne_demandeur_controller,
            minLines: 1,
            maxLines: 2,
            decoration: InputDecoration(
              labelStyle: GoogleFonts.poppins(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Coordonnées du demandeur"
                  : 'Applicant contact details',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          SizedBox(
            width: MediaQuery.of(context).size.width * 0.90,
            child: ElevatedButton(
              style: ElevatedButton.styleFrom(
                backgroundColor: primaryColor,
                shape: const StadiumBorder(),
                padding: const EdgeInsets.symmetric(
                  vertical: 16,
                ),
              ),
              child: Text(
                _desactive
                    ? (langUserPhone == "fr")
                        ? "Patientez..."
                        : "Wait..."
                    : (langUserPhone == "fr")
                        ? "ENREGISTRER"
                        : "SAVED",
                style: GoogleFonts.poppins(
                  fontWeight: FontWeight.w400,
                  color: Colors.white,
                ),
              ),
              onPressed: () {
                _desactive
                    ? null
                    : add_dmd_emploi(
                        titre_demande_poste_rechercher_controller.text,
                        description_profil_demandeur_controller.text,
                        competence_qualification_controller.text,
                        niveau_experience_controller.text,
                        secteur_activite_rechercher_controller.text,
                        type_contrat_rechercher_controller.text,
                        localisation_souhaite_controller.text,
                        salaire_souhaite_controller.text,
                        langues_parle_controller.text,
                        lien_portfolio_controller.text,
                        coordonne_demandeur_controller.text,
                      );
              },
            ),
          ),
        ],
      ),
    );
  }
}

class OffresEmploi extends StatefulWidget {
  @override
  State<OffresEmploi> createState() => _OffresEmploiState();
}

class _OffresEmploiState extends State<OffresEmploi> {
  bool _desactive = false;
  var data;
  final titre_poste_controller = TextEditingController();
  final description_poste_controller = TextEditingController();
  final competences_requises_controller = TextEditingController();
  final type_contrat_controller = TextEditingController();
  final lieu_travail_controller = TextEditingController();
  final salaire_controller = TextEditingController();
  final niveau_experience_controller = TextEditingController();
  final horaire_travail_controller = TextEditingController();
  final avantages_controller = TextEditingController();
  final dure_contrat_not_cdi_controller = TextEditingController();
  final contact_emploiyeur_controller = TextEditingController();
  final date_limite_candidature_controller = TextEditingController();
  final Lien_information_otionel_controller = TextEditingController();

  void add_offre_emploi(
      String titre_poste,
      String description_poste,
      String competences_requises,
      String type_contrat,
      String lieu_travail,
      String salaire,
      String niveau_experience,
      String horaire_travail,
      String avantages,
      String dure_contrat_not_cdi,
      String contact_emploiyeur,
      String date_limite_candidature,
      String Lien_information_otionel) async {
    bool isConnected = await isConnectedToInternet();
    if (isConnected) {
      setState(() {
        _desactive = true;
      });

      var request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/newOffreEmploi'));
      request.fields.addAll({
        'uid': uidUser,
        'titre_poste': titre_poste,
        'description_poste': description_poste,
        'competences_requises': competences_requises,
        'type_contrat': type_contrat,
        'lieu_travail': lieu_travail,
        'salaire': salaire,
        'niveau_experience': niveau_experience,
        'horaire_travail': horaire_travail,
        'avantages': avantages,
        'dure_contrat_not_cdi': dure_contrat_not_cdi,
        'contact_emploiyeur': contact_emploiyeur,
        'date_limite_candidature': date_limite_candidature,
        'lien_information_otionel': Lien_information_otionel,
      });

      http.StreamedResponse response = await request.send();

      if (response.statusCode == 200) {
        var data1 = await response.stream.bytesToString();
        print(data1);
        data = convert.jsonDecode(data1);
        if (data["error"] == true) {
          dangerNoti(data["titre"], data["message"], context);
          setState(() {
            _desactive = false;
          });
        } else {
          setState(() {
            _desactive = false;
          });
          cancelPromoReminderNotification();
          successNoti(
              "Good",
              (langUserPhone == "fr")
                  ? "Votre offre d'emploi a été enregistrée et sera publiée après accord d'un des administrateurs de Dressur."
                  : "Your job offer has been recorded and will be published after approval from one of the Dressur administrators.",
              context);
          titre_poste_controller.clear();
          description_poste_controller.clear();
          competences_requises_controller.clear();
          type_contrat_controller.clear();
          lieu_travail_controller.clear();
          salaire_controller.clear();
          niveau_experience_controller.clear();
          horaire_travail_controller.clear();
          avantages_controller.clear();
          dure_contrat_not_cdi_controller.clear();
          contact_emploiyeur_controller.clear();
          date_limite_candidature_controller.clear();
          Lien_information_otionel_controller.clear();
        }
      } else {
        if (langUserPhone != "fr") {
          dangerNoti("Mistake!",
              "We encountered a problem, contact the administrators.", context);
        } else {
          dangerNoti(
              "Erreur!",
              "Nous avons rencontré un problème, contacter les administrateurs.",
              context);
        }
        setState(() {
          _desactive = false;
        });
      }
    } else {
      if (langUserPhone != "fr") {
        dangerNoti(
            "Mistake!", "You are not connected to the internet.", context);
      } else {
        dangerNoti("Erreur!", "Vous n'ètes pas connecté a internet.", context);
      }
      setState(() {
        _desactive = false;
      });
    }
  }

  @override
  void initState() {
    super.initState();
    // listeFormulePromoAffaire(); // Loading the diary when the app starts
  }

  @override
  Widget build(BuildContext context) {
    return Container(
      child: Column(
        children: [
          TextField(
            controller: titre_poste_controller,
            minLines: 1,
            maxLines: 1,
            decoration: InputDecoration(
              labelStyle: GoogleFonts.poppins(color: Colors.grey[400]),
              labelText:
                  (langUserPhone == "fr") ? "Titre du poste" : 'Job title',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: description_poste_controller,
            minLines: 1,
            maxLines: 5,
            decoration: InputDecoration(
              labelStyle: GoogleFonts.poppins(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Description du poste"
                  : 'Job Description',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: competences_requises_controller,
            minLines: 1,
            maxLines: 5,
            decoration: InputDecoration(
              labelStyle: GoogleFonts.poppins(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Compétences requises"
                  : 'Required skills',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: type_contrat_controller,
            minLines: 1,
            maxLines: 3,
            decoration: InputDecoration(
              labelStyle: GoogleFonts.poppins(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Type de contrat"
                  : 'Type of contract',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: lieu_travail_controller,
            minLines: 1,
            maxLines: 2,
            decoration: InputDecoration(
              labelStyle: GoogleFonts.poppins(color: Colors.grey[400]),
              labelText:
                  (langUserPhone == "fr") ? "Lieu de travail" : 'Workplace',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: salaire_controller,
            minLines: 1,
            maxLines: 2,
            decoration: InputDecoration(
              labelStyle: GoogleFonts.poppins(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr") ? "Salaire" : 'Salary',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: niveau_experience_controller,
            minLines: 1,
            maxLines: 2,
            decoration: InputDecoration(
              labelStyle: GoogleFonts.poppins(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Niveau d'expériences"
                  : 'Level of experience',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: horaire_travail_controller,
            minLines: 1,
            maxLines: 3,
            decoration: InputDecoration(
              labelStyle: GoogleFonts.poppins(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Horaire de travail"
                  : 'Work schedule',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: avantages_controller,
            minLines: 1,
            maxLines: 4,
            decoration: InputDecoration(
              labelStyle: GoogleFonts.poppins(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr") ? "Avantages" : 'Benefits',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: dure_contrat_not_cdi_controller,
            minLines: 1,
            maxLines: 2,
            decoration: InputDecoration(
              labelStyle: GoogleFonts.poppins(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Durée du contrat si ce n'est pas CDI"
                  : 'Duration of the contract if it is not permanent',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: contact_emploiyeur_controller,
            minLines: 1,
            maxLines: 3,
            decoration: InputDecoration(
              labelStyle: GoogleFonts.poppins(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Contact de l'emploiyeur"
                  : 'Employer contact',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: date_limite_candidature_controller,
            minLines: 1,
            maxLines: 2,
            decoration: InputDecoration(
              labelStyle: GoogleFonts.poppins(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Date limite de la candidature"
                  : 'Application deadline',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: Lien_information_otionel_controller,
            minLines: 1,
            maxLines: 2,
            decoration: InputDecoration(
              labelStyle: GoogleFonts.poppins(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Lien vers plus d'information (optionel)"
                  : 'Link to more information (optional)',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          SizedBox(
            width: MediaQuery.of(context).size.width * 0.90,
            child: ElevatedButton(
              style: ElevatedButton.styleFrom(
                backgroundColor: primaryColor,
                shape: const StadiumBorder(),
                padding: const EdgeInsets.symmetric(
                  vertical: 16,
                ),
              ),
              child: Text(
                _desactive
                    ? (langUserPhone == "fr")
                        ? "Patientez..."
                        : "Wait..."
                    : (langUserPhone == "fr")
                        ? "ENREGISTRER"
                        : "SAVED",
                style: GoogleFonts.poppins(
                  fontWeight: FontWeight.w400,
                  color: Colors.white,
                ),
              ),
              onPressed: () {
                _desactive
                    ? null
                    : add_offre_emploi(
                        titre_poste_controller.text,
                        description_poste_controller.text,
                        competences_requises_controller.text,
                        type_contrat_controller.text,
                        lieu_travail_controller.text,
                        salaire_controller.text,
                        niveau_experience_controller.text,
                        horaire_travail_controller.text,
                        avantages_controller.text,
                        dure_contrat_not_cdi_controller.text,
                        contact_emploiyeur_controller.text,
                        date_limite_candidature_controller.text,
                        Lien_information_otionel_controller.text,
                      );
              },
            ),
          ),
        ],
      ),
    );
  }
}

// ─────────────────────────────────────────────────────────────────────────────
// SITES & APPLICATIONS
// ─────────────────────────────────────────────────────────────────────────────

class SitesApplications extends StatefulWidget {
  @override
  State<SitesApplications> createState() => _SitesApplicationsState();
}

class _SitesApplicationsState extends State<SitesApplications> {
  bool _isSending = false;
  File? _imageFile;
  String _sousType = 'site_web';
  final _nomController = TextEditingController();
  final _urlController = TextEditingController();
  final _descriptionController = TextEditingController();
  final _telController = TextEditingController(text: tel);
  String _valueMethodePaiement = 'mtn';
  bool _loadingPaiements = false;

  Future<void> _selectImage() async {
    await PermissionManager.instance.runWithPermissionRecovery(
      context,
      actionKey: 'sites_applications:select_image',
      permission: Permission.photos,
      isFrench: langUserPhone == "fr",
      action: () async {
        if (!mounted) return;
        final picker = ImagePicker();
        final pickedImage = await picker.pickImage(source: ImageSource.gallery);
        if (pickedImage != null) {
          final imageFile = File(pickedImage.path);
          final preparedImage = await _preparePromotionImage(
            context: context,
            imageFile: imageFile,
            isFrench: langUserPhone == "fr",
          );
          if (preparedImage != null && mounted) {
            setState(() => _imageFile = preparedImage);
          }
        }
      }
    );
  }

  Future<void> _loadMethodesPaiement() async {
    if (listeMethodePaiements.isNotEmpty) return;
    setState(() => _loadingPaiements = true);
    try {
      final response = await http
          .post(Uri.parse('$generalRouteForApi/listeFormulePromoAffaire'));
      if (response.statusCode == 200) {
        final data = jsonDecode(response.body);
        if (data["error"] == false) {
          setState(() {
            listeMethodePaiements = List<Map<String, dynamic>>.from(
                data["listeMethodePaiements"]);
            if (listeMethodePaiements.isNotEmpty) {
              _valueMethodePaiement = listeMethodePaiements[0]['value'];
            }
          });
        }
      }
    } catch (_) {}
    if (mounted) setState(() => _loadingPaiements = false);
  }

  @override
  void initState() {
    super.initState();
    _loadMethodesPaiement();
  }

  @override
  void dispose() {
    _nomController.dispose();
    _urlController.dispose();
    _descriptionController.dispose();
    _telController.dispose();
    super.dispose();
  }

  String _urlPlaceholder() {
    switch (_sousType) {
      case 'app_mobile':
        return 'https://play.google.com/... ou https://apps.apple.com/...';
      case 'logiciel_desktop':
        return 'https://monlogiciel.com/telecharger';
      default:
        return 'https://monsite.com';
    }
  }

  Future<void> _sendData() async {
    if (!telIsVerified) {
      showConfNumeroWhatsapp(context);
      return;
    }
    final nom = _nomController.text.trim();
    final url = _urlController.text.trim();

    if (nom.isEmpty || url.isEmpty || _imageFile == null) {
      dangerNoti(
          "Attention !!!",
          (langUserPhone == "fr")
              ? "Veuillez remplir tous les champs obligatoires et sélectionner une image."
              : "Please fill in all required fields and select an image.",
          context);
      return;
    }
    if (!url.startsWith('http://') && !url.startsWith('https://')) {
      dangerNoti(
          "Attention !!!",
          (langUserPhone == "fr")
              ? "L'URL doit commencer par http:// ou https://"
              : "The URL must start with http:// or https://",
          context);
      return;
    }

    setState(() => _isSending = true);

    final uri = Uri.parse('$generalRouteForApi/addSiteApplication');
    final request = http.MultipartRequest('POST', uri);
    request.fields['uid'] = uidUser;
    request.fields['sousType'] = _sousType;
    request.fields['nom'] = nom;
    request.fields['description'] = _descriptionController.text.trim();
    request.fields['url'] = url;
    request.fields['methodePaiement'] = _valueMethodePaiement;
    request.fields['tel'] = _telController.text;

    try {
      final uploadFile = await _createPromotionUploadFile(
        imageFile: _imageFile!,
        fileName: 'temp_image_site.jpg',
      );
      request.files.add(
        await http.MultipartFile.fromPath('image', uploadFile.path),
      );

      final response = await request.send();
      final responseBody = await response.stream.bytesToString();
      if (!mounted) return;
      final data = _decodePromotionApiResponse(responseBody);
      if (response.statusCode < 200 ||
          response.statusCode >= 300 ||
          data == null ||
          data['error'] == true) {
        _showPromotionApiError(
          context: context,
          isFrench: langUserPhone == "fr",
          statusCode: response.statusCode,
          data: data,
        );
        setState(() => _isSending = false);
        return;
      }

      setState(() {
        _isSending = false;
        _imageFile = null;
        _sousType = 'site_web';
        _valueMethodePaiement = 'mtn';
      });
      _nomController.clear();
      _urlController.clear();
      _descriptionController.clear();
      cancelPromoReminderNotification();
      successNoti(
          (langUserPhone == "fr") ? "Succès" : "Success",
          (langUserPhone == "fr")
              ? "Votre promotion est en attente de validation par notre équipe."
              : "Your promotion is pending validation by our team.",
          context);
    } catch (_) {
      if (!mounted) return;
      setState(() => _isSending = false);
      _showPromotionApiError(
        context: context,
        isFrench: langUserPhone == "fr",
        statusCode: 0,
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    final isFr = langUserPhone == "fr";
    return Column(
      crossAxisAlignment: CrossAxisAlignment.stretch,
      children: [
        const SizedBox(height: 5),

        // Sous-type
        DropdownButtonFormField<String>(
          value: _sousType,
          decoration: InputDecoration(
            labelText: isFr ? 'Sous-type' : 'Sub-type',
            border: const OutlineInputBorder(),
          ),
          items: [
            DropdownMenuItem(
              value: 'site_web',
              child: Text(isFr ? 'Site web' : 'Website',
                  style: GoogleFonts.poppins(fontSize: 14)),
            ),
            DropdownMenuItem(
              value: 'app_mobile',
              child: Text(isFr ? 'Application mobile' : 'Mobile app',
                  style: GoogleFonts.poppins(fontSize: 14)),
            ),
            DropdownMenuItem(
              value: 'logiciel_desktop',
              child: Text(
                  isFr
                      ? 'Logiciel / Application desktop'
                      : 'Desktop software',
                  style: GoogleFonts.poppins(fontSize: 14)),
            ),
          ],
          onChanged: (val) {
            if (val != null) setState(() => _sousType = val);
          },
        ),
        const SizedBox(height: 10),

        // Nom
        TextField(
          controller: _nomController,
          maxLength: 150,
          decoration: InputDecoration(
            labelText: isFr ? 'Nom' : 'Name',
            hintText: isFr
                ? "Nom du site / de l'application"
                : 'Site / app name',
            border: const OutlineInputBorder(),
          ),
        ),
        const SizedBox(height: 10),

        // URL
        TextField(
          controller: _urlController,
          keyboardType: TextInputType.url,
          onChanged: (_) => setState(() {}),
          decoration: InputDecoration(
            labelText: 'URL',
            hintText: _urlPlaceholder(),
            border: const OutlineInputBorder(),
          ),
        ),
        const SizedBox(height: 10),

        // Description courte avec compteur
        ValueListenableBuilder<TextEditingValue>(
          valueListenable: _descriptionController,
          builder: (context, value, _) {
            return TextField(
              controller: _descriptionController,
              maxLength: 120,
              maxLines: 3,
              decoration: InputDecoration(
                labelText: isFr ? 'Description courte' : 'Short description',
                border: const OutlineInputBorder(),
                counterText: '${value.text.length}/120',
              ),
            );
          },
        ),
        const SizedBox(height: 10),

        // Upload image
        ElevatedButton(
          onPressed: _isSending ? null : _selectImage,
          style: ElevatedButton.styleFrom(
              backgroundColor: primaryColor,
              shape: const StadiumBorder(),
              padding: const EdgeInsets.symmetric(vertical: 13)),
          child: Text(
              isFr ? "Sélectionner l'image" : 'Select image',
              style: GoogleFonts.poppins(
                  color: Colors.white, fontWeight: FontWeight.w600)),
        ),
        Padding(
          padding: const EdgeInsets.symmetric(vertical: 4),
          child: Text(
            isFr
                ? "Formats acceptés : 1:1, 4:3 ou 3:4"
                : "Accepted formats: 1:1, 4:3 or 3:4",
            style:
                GoogleFonts.poppins(fontSize: 12, color: Colors.grey[600]),
            textAlign: TextAlign.center,
          ),
        ),
        if (_imageFile != null)
          Container(
              margin: const EdgeInsets.only(top: 10),
              child: Image.file(_imageFile!, fit: BoxFit.contain)),
        const SizedBox(height: 15),

        // Prix fixe
        Container(
          width: double.infinity,
          padding: const EdgeInsets.all(12),
          decoration: BoxDecoration(
            color: primaryColor.withOpacity(0.08),
            borderRadius: BorderRadius.circular(8),
            border: Border.all(color: primaryColor.withOpacity(0.3)),
          ),
          child: Text(
            isFr ? "Prix : 7 750 FCFA / an" : "Price: 7,750 FCFA / year",
            style: GoogleFonts.poppins(
                color: primaryColor,
                fontWeight: FontWeight.bold,
                fontSize: 15),
            textAlign: TextAlign.center,
          ),
        ),
        const SizedBox(height: 15),

        // Méthode de paiement
        _loadingPaiements
            ? const Center(
                child: CircularProgressIndicator(color: primaryColor))
            : listeMethodePaiements.isNotEmpty
                ? SelectFormField(
                    decoration: InputDecoration(
                        labelText:
                            isFr ? 'Moyen de paiement' : 'Payment method',
                        border: const OutlineInputBorder()),
                    type: SelectFormFieldType.dropdown,
                    initialValue: _valueMethodePaiement,
                    items: listeMethodePaiements,
                    onChanged: (val) =>
                        setState(() => _valueMethodePaiement = val),
                  )
                : const SizedBox.shrink(),
        const SizedBox(height: 10),

        // Numéro de paiement
        TextField(
            controller: _telController,
            keyboardType: TextInputType.phone,
            decoration: InputDecoration(
                labelText:
                    isFr ? 'Numéro du paiement' : 'Payment number',
                border: const OutlineInputBorder())),
        const SizedBox(height: 15),

        // Bouton soumettre
        ElevatedButton(
          onPressed: _isSending ? null : _sendData,
          style: ElevatedButton.styleFrom(
              backgroundColor: primaryColor,
              shape: const StadiumBorder(),
              padding: const EdgeInsets.symmetric(vertical: 15)),
          child: _isSending
              ? const CircularProgressIndicator(color: Colors.white)
              : Text(
                  isFr ? 'Publier et Payer' : 'Publish & Pay',
                  style: GoogleFonts.poppins(
                      color: Colors.white, fontWeight: FontWeight.bold)),
        ),
        const SizedBox(height: 10),
      ],
    );
  }
}
