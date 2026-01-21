// ignore_for_file: use_build_context_synchronously, non_constant_identifier_names, prefer_typing_uninitialized_variables

import 'dart:convert';
import 'dart:convert' as convert;
import 'package:http/http.dart' as http;
import 'dart:io';
import 'dart:async';
import 'package:dressur/components/padding_and_divider.dart';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:image_picker/image_picker.dart';
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
            Icons.arrow_back_ios,
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
                          ? "Informations : \n- Après avoir rempli et envoyer votre promotion, elle sera analysée par les administrateurs de Dressur. Si votre promotion est acceptée, elle sera visible par des milliers d'utilisateurs correspondants à vos préférences pays. \n- Si la promotion est rejetée, vous aurez la possibilité de la modifier. \n- Les utilisateurs intéressés par votre Promotion Affaire vous contacterons sur votre numéro WhatsApp. \n- Les Promotions Affaires (Offre d'emploi et Demande d'emploi) sont gratuites."
                          : "Information: \n- After completing and submitting your promotion, it will be reviewed by Dressur administrators. If your promotion is accepted, it will be visible to thousands of users matching your country preferences. \n- If the promotion is rejected, you will have the option to modify it. \n- Users interested in your Business Promotion will contact you on your WhatsApp number. \n- Business Promotions (Job Offer and Job Application) are free.",
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
            SelectFormField(
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
  var _message = "";
  dynamic idFormulBoost = 1;
  dynamic valueMethodePaiement = "mtn";
  bool loading_formule_gratuit = false;
  List<Map<String, dynamic>> listeDesFormules = [];
  int value = 0;
  var label = "";
  int prix = 0;
  int jours = 0;
  final telController = TextEditingController(text: tel);

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

    final url = Uri.parse('$generalRouteForApi/addProduitService');

    final request = http.MultipartRequest('POST', url);
    request.fields['idFormulePromoAffaire'] = idFormulBoost;
    request.fields['text'] = _textEditingController.text;
    request.fields['uid'] = uidUser;
    request.fields['langUserPhone'] = langUserPhone.toString();
    request.fields['mode'] = "payant";
    request.fields['paymentMethod'] = valueMethodePaiement;
    request.fields['tel'] = telController.text;

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
                ? 'Good. Votre demande de promotion a été enregistrée. Elle sera diffusée si elle est acceptée par un administrateur. Dans le cas contraire, vous devrez la modifier en tenant compte des remarques.'
                : 'Good. Your promotion request has been saved. It will be released if it is accepted by an administrator. Otherwise, you will need to modify it taking into account the comments.',
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
            listeMethodePaiements =
                (data["listeMethodePaiements"] as List<dynamic>)
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
    super.initState();
    listeFormulePromoAffaire();
  }

  @override
  Widget build(BuildContext context) {
    return Container(
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.stretch,
        children: [
          const SizedBox(height: 5),
          loading_formule_gratuit
              ? const Center(
                  child: CircularProgressIndicator(),
                )
              : SelectFormField(
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
          const SizedBox(height: 16.0),
          Text(
            _message,
            style: GoogleFonts.poppins(
              fontSize: 16,
            ),
            textAlign: TextAlign.center,
          ),
          const SizedBox(height: 16.0),
          SelectFormField(
            decoration: const InputDecoration(
              labelText: 'Moyen de paiement mobile ou par carte',
              border: OutlineInputBorder(),
            ),
            type: SelectFormFieldType.dropdown,
            initialValue: 'mtn',
            labelText: 'Moyen de paiement mobile ou par carte',
            items: listeMethodePaiements,
            onChanged: (val) => onChangeMethodePaiement(val),
            onSaved: (val) => print(val),
          ),
          const SizedBox(height: 16.0),
          TextField(
            controller: telController,
            decoration: const InputDecoration(
              labelText: 'Indicatif + Numéro du paiement',
              border: OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 16.0),
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
                  ? "Sélectionner l'image de la promotion"
                  : 'Select the promotional image',
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
        'langUserPhone': langUserPhone.toString(),
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
              labelStyle: TextStyle(color: Colors.grey[400]),
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
              labelStyle: TextStyle(color: Colors.grey[400]),
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
              labelStyle: TextStyle(color: Colors.grey[400]),
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
              labelStyle: TextStyle(color: Colors.grey[400]),
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
              labelStyle: TextStyle(color: Colors.grey[400]),
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
              labelStyle: TextStyle(color: Colors.grey[400]),
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
              labelStyle: TextStyle(color: Colors.grey[400]),
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
              labelStyle: TextStyle(color: Colors.grey[400]),
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
              labelStyle: TextStyle(color: Colors.grey[400]),
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
              labelStyle: TextStyle(color: Colors.grey[400]),
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
              labelStyle: TextStyle(color: Colors.grey[400]),
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
        'langUserPhone': langUserPhone.toString(),
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
              labelStyle: TextStyle(color: Colors.grey[400]),
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
              labelStyle: TextStyle(color: Colors.grey[400]),
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
              labelStyle: TextStyle(color: Colors.grey[400]),
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
              labelStyle: TextStyle(color: Colors.grey[400]),
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
              labelStyle: TextStyle(color: Colors.grey[400]),
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
              labelStyle: TextStyle(color: Colors.grey[400]),
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
              labelStyle: TextStyle(color: Colors.grey[400]),
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
              labelStyle: TextStyle(color: Colors.grey[400]),
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
              labelStyle: TextStyle(color: Colors.grey[400]),
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
              labelStyle: TextStyle(color: Colors.grey[400]),
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
              labelStyle: TextStyle(color: Colors.grey[400]),
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
              labelStyle: TextStyle(color: Colors.grey[400]),
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
              labelStyle: TextStyle(color: Colors.grey[400]),
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
