// ignore_for_file: use_build_context_synchronously, non_constant_identifier_names

import 'dart:convert';
import 'dart:convert' as convert;
import 'dart:io';
import 'dart:async';
import 'package:dressur/components/delayed_animation.dart';
import 'package:dressur/components/padding_and_divider.dart';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:image_picker/image_picker.dart';
import 'package:http/http.dart' as http;
import 'package:path_provider/path_provider.dart';
import 'package:image/image.dart' as img;
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/noti.dart';
import 'package:select_form_field/select_form_field.dart';

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
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
          (langUserPhone == "fr")
              ? 'Nouvelle Promotion Affaire'
              : 'New Business Promotion',
          style: GoogleFonts.poppins(
            fontWeight: FontWeight.w400,
            color: Colors.white,
          ),
        ),
        leading: IconButton(
          onPressed: () {
            Navigator.pop(context);
          },
          icon: const Icon(
            Icons.arrow_back,
            size: 30,
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
            const SizedBox(height: 5),
            Card(
              margin:
                  const EdgeInsets.only(left: 0, top: 0, right: 0, bottom: 5),
              child: Container(
                decoration: BoxDecoration(
                  borderRadius: BorderRadius.circular(5),
                  gradient: const LinearGradient(
                    begin: Alignment.topCenter,
                    end: Alignment.bottomCenter,
                    colors: [
                      Colors.red,
                      Color.fromARGB(255, 85, 3, 3),
                    ],
                  ),
                ),
                padding: const EdgeInsets.fromLTRB(10, 0, 10, 0),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.stretch,
                  children: [
                    const SizedBox(height: 10),
                    Text(
                      (langUserPhone == "fr")
                          ? "NB : Après avoir rempli et valider votre promotion, elle sera analysée par les administrateurs de Dressur. Si votre promotion est acceptée, elle sera visible par des milliers d'utilisateurs correspondants à vos préférences pays. Si la promotion est rejetée, vous aurez la possibilité de la modifier."
                          : "NB : After completing and validating your promotion, it will be analyzed by Dressur administrators. If your promotion is accepted, it will be visible to thousands of users corresponding to your country preferences. If the promotion is rejected, you will have the opportunity to modify it.",
                      style: GoogleFonts.poppins(
                        fontWeight: FontWeight.w600,
                        color: Colors.white,
                        fontSize: 10,
                      ),
                      textAlign: TextAlign.justify,
                    ),
                    const SizedBox(height: 15),
                  ],
                ),
              ),
            ),
            const SizedBox(height: 10),
            DelayedAnimation(
              delay: 0, // 1500,
              child: SelectFormField(
                decoration: const InputDecoration(
                  labelText: 'Type Promotion Affaire',
                  border: OutlineInputBorder(),
                ),
                type: SelectFormFieldType.dropdown,
                initialValue: 'produit_service',
                labelText: 'Type Promotion Affaire',
                items: listeTypePromoAffaire,
                onChanged: (val) => onChangeTypePromoAffaire(val),
                onSaved: (val) => print(val),
              ),
            ),
            const SizedBox(height: 5),
            DressurDivider(),
            const SizedBox(height: 5),
            if (type_promo_affaire == "produit_service") ...[
              ProduitsServices()
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
  TextEditingController _textEditingController = TextEditingController();
  bool _isSending = false;

  bool isImageSquare(File imageFile) {
    final image = img.decodeImage(File(imageFile.path).readAsBytesSync());
    if (image == null) {
      return false;
    }

    final width = image.width;
    final height = image.height;
    final aspectRatio = width / height;

    return aspectRatio >= 0.8 && aspectRatio <= 1.2;
  }

  Future<void> _selectImage() async {
    final picker = ImagePicker();
    final pickedImage = await picker.pickImage(source: ImageSource.gallery);

    if (pickedImage != null) {
      final imageFile = File(pickedImage.path);

      final fileSize = await imageFile.length();
      final fileSizeInMB = fileSize / (1024 * 1024);

      if (fileSizeInMB > 1) {
        dangerNoti(
            "Attention !!!",
            (langUserPhone == "fr")
                ? "La taille de l'image ne peut pas dépasser 1 Mo."
                : "Image size cannot exceed 1 MB.",
            context);
        return;
      }

      if (isImageSquare(imageFile)) {
        setState(() {
          _imageFile = imageFile;
        });
      } else {
        dangerNoti(
            "Attention !!!",
            (langUserPhone == "fr")
                ? "L'image doit être proche d'un carré."
                : "The image should be close to a square.",
            context);
      }
    }
  }

  Future<void> _sendData() async {
    if (!telIsVerified) {
      showConfNumeroWhatsapp(context);
      return;
    }

    if (_textEditingController.text.isEmpty || _imageFile == null) {
      dangerNoti(
          "Attention !!!",
          (langUserPhone == "fr")
              ? 'Veuillez entrer un texte et sélectionner une image.'
              : 'Please enter a text and select an image.',
          context);
      return;
    }

    setState(() {
      _isSending = true;
    });

    final url = Uri.parse('$generalRouteForApi/newPromotion');

    final request = http.MultipartRequest('POST', url);
    request.fields['text'] = _textEditingController.text;
    request.fields['uid'] = uidUser;
    request.fields['langUserPhone'] = langUserPhone.toString();

    final tempDir = await getTemporaryDirectory();
    final filePath = '${tempDir.path}/temp_image.jpg';
    final image = img.decodeImage(_imageFile!.readAsBytesSync());
    final compressedImage = img.encodeJpg(image!, quality: 85);
    File(filePath).writeAsBytesSync(compressedImage);

    final imageStream =
        http.ByteStream(Stream.castFrom(File(filePath).openRead()));
    final imageLength = await File(filePath).length();

    final multipartFile = http.MultipartFile(
      'image',
      imageStream,
      imageLength,
      filename: _imageFile!.path,
    );

    request.files.add(multipartFile);

    final response = await request.send();

    if (response.statusCode == 200) {
      var data1 = await response.stream.bytesToString();
      var data = jsonDecode(data1);
      if (data["error"] == true) {
        dangerNoti(data["titre"], data["message"], context);
      } else {
        successNoti(
            "Good",
            (langUserPhone == "fr")
                ? 'Votre demande de promotion a été enregistrée, vous passerez au paiement si elle est acceptée.'
                : 'Your promotion request has been registered, you will proceed to payment if it is accepted.',
            context);
      }
      setState(() {
        _textEditingController.clear();
        _imageFile = null;
        _isSending = false;
      });
    } else {
      dangerNoti("Attention !!!", 'Erreur : ${response.statusCode}', context);
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
        crossAxisAlignment: CrossAxisAlignment.stretch,
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              Text(
                (langUserPhone == "fr") ? 'Gratuit' : 'Free',
                style: GoogleFonts.poppins(
                  fontSize: 20,
                  fontWeight: FontWeight.w800,
                  color: Colors.green,
                ),
                textAlign: TextAlign.center,
              ),
              const SizedBox(width: 10),
              Switch(
                trackOutlineColor:
                    MaterialStateColor.resolveWith((states) => primaryColor),
                activeColor: Colors.red,
                activeTrackColor: primaryColor,
                inactiveThumbColor: Colors.green,
                inactiveTrackColor: primaryColor,
                value: load,
                onChanged: (bool? newValue) {
                  setState(() {
                    if (newValue == true) {
                      load = true;
                    } else {
                      load = false;
                    }
                  });
                },
              ),
              const SizedBox(width: 10),
              Text(
                (langUserPhone == "fr") ? 'Payant' : 'Paid',
                style: GoogleFonts.poppins(
                  fontSize: 20,
                  fontWeight: FontWeight.w800,
                  color: Colors.red,
                ),
                textAlign: TextAlign.center,
              ),
            ],
          ),
          const SizedBox(height: 5),
          load ? FormulePayante() : FormuleGratuite(),
          const SizedBox(height: 10),
          ElevatedButton(
            onPressed: _isSending ? null : _selectImage,
            style: ElevatedButton.styleFrom(
              backgroundColor: primaryColor,
              shape: const StadiumBorder(),
              padding: const EdgeInsets.symmetric(
                vertical: 13,
              ),
            ),
            child: Text(
              (langUserPhone == "fr")
                  ? 'Sélectionner une image'
                  : 'Select an image',
              style: GoogleFonts.poppins(
                color: Colors.white,
                fontWeight: FontWeight.w600,
              ),
            ),
          ),
          if (_imageFile != null)
            Container(
              margin: const EdgeInsets.only(top: 16.0),
              child: Image.file(
                _imageFile!,
                fit: BoxFit.contain,
              ),
            ),
          const SizedBox(height: 16.0),
          TextField(
            controller: _textEditingController,
            maxLines: null,
            decoration: InputDecoration(
              labelText: (langUserPhone == "fr")
                  ? 'Description de la promotion'
                  : 'Description of the promotion',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 16.0),
          ElevatedButton(
            onPressed: _isSending ? null : _sendData,
            style: ElevatedButton.styleFrom(
              backgroundColor: primaryColor,
              shape: const StadiumBorder(),
              padding: const EdgeInsets.symmetric(
                vertical: 13,
              ),
            ),
            child: _isSending
                ? const Text('Wait ...')
                : Text(
                    (langUserPhone == "fr") ? 'Envoyer' : 'Send',
                    style: GoogleFonts.poppins(
                      color: Colors.white,
                    ),
                  ),
          ),
        ],
      ),
    );
  }
}

class DemandesEmploi extends StatefulWidget {
  @override
  State<DemandesEmploi> createState() => _DemandesEmploiState();
}

class _DemandesEmploiState extends State<DemandesEmploi> {
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
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? 'Titre de la demande ou poste recherché '
                  : 'WhatsApp number',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: description_profil_demandeur_controller,
            minLines: 1,
            maxLines: 5,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? 'Description du profil du demandeur'
                  : 'WhatsApp number',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: competence_qualification_controller,
            minLines: 1,
            maxLines: 3,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? 'Compétences et qualification (listes)'
                  : 'WhatsApp number',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: niveau_experience_controller,
            minLines: 1,
            maxLines: 2,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Niveau d'experience (Nombres d'année d'expérience)"
                  : 'WhatsApp number',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: secteur_activite_rechercher_controller,
            minLines: 1,
            maxLines: 2,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Secteur d'activté rechercher"
                  : 'WhatsApp number',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: type_contrat_rechercher_controller,
            minLines: 1,
            maxLines: 3,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Type de contrat rechercher"
                  : 'WhatsApp number',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: localisation_souhaite_controller,
            minLines: 1,
            maxLines: 3,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Localisation souhaité"
                  : 'WhatsApp number',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: salaire_souhaite_controller,
            minLines: 1,
            maxLines: 1,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Salaire souhaité"
                  : 'WhatsApp number',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: langues_parle_controller,
            minLines: 1,
            maxLines: 3,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Langues parlées"
                  : 'WhatsApp number',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: lien_portfolio_controller,
            minLines: 1,
            maxLines: 1,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Lien vers votre portfolio ou cv"
                  : 'WhatsApp number',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: coordonne_demandeur_controller,
            minLines: 1,
            maxLines: 2,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Coordonnées du demandeur"
                  : 'WhatsApp number',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
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
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Titre du poste"
                  : 'WhatsApp number',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: description_poste_controller,
            minLines: 1,
            maxLines: 5,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Description du poste "
                  : 'WhatsApp number',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: competences_requises_controller,
            minLines: 1,
            maxLines: 5,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Compétences requises"
                  : 'WhatsApp number',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: type_contrat_controller,
            minLines: 1,
            maxLines: 3,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Type de contrat"
                  : 'WhatsApp number',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: lieu_travail_controller,
            minLines: 1,
            maxLines: 2,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Lieu de travail"
                  : 'WhatsApp number',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: salaire_controller,
            minLines: 1,
            maxLines: 2,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText:
                  (langUserPhone == "fr") ? "Salaire" : 'WhatsApp number',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: niveau_experience_controller,
            minLines: 1,
            maxLines: 2,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Niveau d'expérience"
                  : 'WhatsApp number',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: horaire_travail_controller,
            minLines: 1,
            maxLines: 3,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Horaire de travail"
                  : 'WhatsApp number',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: avantages_controller,
            minLines: 1,
            maxLines: 4,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText:
                  (langUserPhone == "fr") ? "Avantages" : 'WhatsApp number',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: dure_contrat_not_cdi_controller,
            minLines: 1,
            maxLines: 2,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Durée du contrat si ce n'est pas CDI"
                  : 'WhatsApp number',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: contact_emploiyeur_controller,
            minLines: 1,
            maxLines: 3,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Contact de l'emploiyeur"
                  : 'WhatsApp number',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: date_limite_candidature_controller,
            minLines: 1,
            maxLines: 2,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Date limite de la candidature"
                  : 'WhatsApp number',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: Lien_information_otionel_controller,
            minLines: 1,
            maxLines: 2,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? "Lien vers plus d'information (optionel)"
                  : 'WhatsApp number',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
        ],
      ),
    );
  }
}

class FormulePayante extends StatefulWidget {
  @override
  State<FormulePayante> createState() => _FormulePayanteState();
}

class _FormulePayanteState extends State<FormulePayante> {
  bool loading_formule_payant = false;
  var _message = "";
  dynamic data;
  dynamic idFormulBoost = 1;
  dynamic valueMethodePaiement = "mtn";
  String? boostId;
  final telController = TextEditingController(text: tel);

  List<Map<String, dynamic>> listeDesFormules = [];
  int value = 0;
  var label = "";
  int prix = 0;
  int jours = 0;

  void listeFormulePromoAffaire() async {
    bool isConnected = await isConnectedToInternet();
    if (isConnected) {
      setState(() {
        loading_formule_payant = true;
      });

      var request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/listeFormulePromoAffaire'));
      request.fields.addAll({});

      http.StreamedResponse response = await request.send();

      if (response.statusCode == 200) {
        var data1 = await response.stream.bytesToString();
        var data = convert.jsonDecode(data1);
        if (data["error"] == false) {
          setState(() {
            loading_formule_payant = false;
            listeDesFormules = (data["listeFormulBoost"] as List<dynamic>)
                .map((item) => item as Map<String, dynamic>)
                .toList();
            _message = (langUserPhone == "fr")
                ? "Veuillez choisir une formule."
                : "Please choose a plan.";
          });
        }
      }
    } else {
      if (langUserPhone != "fr") {
        dangerNoti(
            "Mistake!", "You are not connected to the internet.", context);
      } else {
        dangerNoti("Erreur!", "Vous n'ètes pas connecté a internet.", context);
      }
      setState(() {
        loading_formule_payant = false;
      });
    }
  }

  onChangeFormulBoost(val) async {
    for (var service in listeDesFormules) {
      if ("$val" == "${service['value']}") {
        setState(() {
          value = service['value'];
          label = service['label'];
          prix = service['prix'];
          jours = service['jours'];
        });
      }
    }
    setState(() {
      idFormulBoost = val;
      _message = (langUserPhone == "fr")
          ? "Cette formule vous offre une promotion affaire de $jours jour(s) pour $prix FCFA."
          : "This formula offers you a business promotion of $jours day(s) for $prix FCFA.";
    });
  }

  onChangeMethodePaiement(val) async {
    setState(() {
      valueMethodePaiement = val;
    });
  }

  @override
  void initState() {
    super.initState(); // Loading the diary when the app starts
    listeFormulePromoAffaire();
  }

  @override
  Widget build(BuildContext context) {
    return Container(
      child: Column(
        children: [
          loading_formule_payant
              ? const Center(
                  child: CircularProgressIndicator(),
                )
              : DelayedAnimation(
                  delay: 0, // 1500,
                  child: SelectFormField(
                    decoration: const InputDecoration(
                      labelText: 'Formules de Promotion Affaire Payant',
                      border: OutlineInputBorder(),
                    ),
                    type: SelectFormFieldType.dropdown,
                    initialValue: '0',
                    labelText: 'Formules de Promotion Affaire Payant',
                    items: listeDesFormules,
                    onChanged: (val) => onChangeFormulBoost(val),
                    onSaved: (val) => print(val),
                  ),
                ),
          const SizedBox(height: 10),
          DelayedAnimation(
            delay: 0, // 1000,
            child: Text(
              _message,
              style: GoogleFonts.poppins(
                fontSize: 16,
              ),
              textAlign: TextAlign.center,
            ),
          ),
        ],
      ),
    );
  }
}

class FormuleGratuite extends StatefulWidget {
  @override
  State<FormuleGratuite> createState() => _FormuleGratuiteState();
}

class _FormuleGratuiteState extends State<FormuleGratuite> {
  bool loading_formule_gratuit = false;
  var _message = "";
  dynamic data;
  dynamic idFormulBoost = 1;
  String? boostId;

  List<Map<String, dynamic>> listeDesFormules = [];
  int value = 0;
  var label = "";
  int prix = 0;
  int jours = 0;

  void listeFormulePromoAffaire() async {
    bool isConnected = await isConnectedToInternet();
    if (isConnected) {
      setState(() {
        loading_formule_gratuit = true;
      });

      var request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/listeFormulePromoAffaire'));
      request.fields.addAll({});

      http.StreamedResponse response = await request.send();

      if (response.statusCode == 200) {
        var data1 = await response.stream.bytesToString();
        var data = convert.jsonDecode(data1);
        if (data["error"] == false) {
          setState(() {
            loading_formule_gratuit = false;
            listeDesFormules = (data["listeFormulBoost"] as List<dynamic>)
                .map((item) => item as Map<String, dynamic>)
                .toList();
            _message = (langUserPhone == "fr")
                ? "Veuillez choisir une formule."
                : "Please choose a plan.";
          });
        }
      }
    } else {
      if (langUserPhone != "fr") {
        dangerNoti(
            "Mistake!", "You are not connected to the internet.", context);
      } else {
        dangerNoti("Erreur!", "Vous n'ètes pas connecté a internet.", context);
      }
      setState(() {
        loading_formule_gratuit = false;
      });
    }
  }

  onChangeFormulBoost(val) async {
    for (var service in listeDesFormules) {
      if ("$val" == "${service['value']}") {
        setState(() {
          value = service['value'];
          label = service['label'];
          prix = service['prix'];
          jours = service['jours'];
        });
      }
    }
    setState(() {
      idFormulBoost = val;
      _message = (langUserPhone == "fr")
          ? "Cette formule vous offre une promotion affaire de $jours jour(s) pour $prix Bonus."
          : "This formula offers you a business promotion of $jours day(s) for $prix Bonus.";
    });
  }

  @override
  void initState() {
    super.initState();
    listeFormulePromoAffaire(); // Loading the diary when the app starts
  }

  @override
  Widget build(BuildContext context) {
    return Container(
      child: Column(
        children: [
          loading_formule_gratuit
              ? const Center(
                  child: CircularProgressIndicator(),
                )
              : DelayedAnimation(
                  delay: 0, // 1500,
                  child: SelectFormField(
                    decoration: const InputDecoration(
                      labelText: 'Formules de Promotion Affaire',
                      border: OutlineInputBorder(),
                    ),
                    type: SelectFormFieldType.dropdown,
                    initialValue: '0',
                    labelText: 'Formules de Promotion Affaire',
                    items: listeDesFormules,
                    onChanged: (val) => onChangeFormulBoost(val),
                    onSaved: (val) => print(val),
                  ),
                ),
          const SizedBox(height: 20),
          DelayedAnimation(
            delay: 0, // 1000,
            child: Text(
              _message,
              style: GoogleFonts.poppins(
                fontSize: 16,
              ),
              textAlign: TextAlign.center,
            ),
          ),
        ],
      ),
    );
  }
}
