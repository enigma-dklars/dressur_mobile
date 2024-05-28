// ignore_for_file: use_build_context_synchronously, non_constant_identifier_names

import 'package:dressur/2_promo/liste_campagne_mail.dart';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/components/delayed_animation.dart';
import 'package:dressur/components/constant.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;
import 'package:dressur/components/noti.dart';
import 'package:select_form_field/select_form_field.dart';

class NewCampagneMailPage extends StatefulWidget {
  @override
  State<NewCampagneMailPage> createState() => _NewCampagneMailPageState();
}

class _NewCampagneMailPageState extends State<NewCampagneMailPage> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        elevation: 0,
        backgroundColor: primaryColor,
        title: Text(
          (langUserPhone == "fr")
              ? "Nouvelle Campagne Mail"
              : "New Email Campaign",
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
      ),
      body: SingleChildScrollView(
        child: Column(
          children: [
            const SizedBox(height: 5),
            Card(
              margin:
                  const EdgeInsets.only(left: 10, top: 5, right: 10, bottom: 5),
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
                          ? "NB: Après avoir rempli et envoyer votre campagne, elle sera analysée par les administrateurs de Dressur.\nSi votre campagne est acceptée, vous passerez au paiement et ainsi votre campagne sera effectuée."
                          : "NB: After completing and sending your campaign, it will be analyzed by the Dressur administrators.\nIf your campaign is accepted, you will proceed to payment and thus your campaign will be carried out.",
                      style: GoogleFonts.poppins(
                        fontWeight: FontWeight.w600,
                        fontSize: 10,
                        color: Colors.white,
                      ),
                      textAlign: TextAlign.justify,
                    ),
                    const SizedBox(height: 15),
                  ],
                ),
              ),
            ),
            Container(
              margin: const EdgeInsets.symmetric(vertical: 10, horizontal: 15),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.center,
                children: [
                  Text(
                    (langUserPhone == "fr")
                        ? "Nouvelle Campagne"
                        : "New Campaign",
                    style: GoogleFonts.poppins(
                      fontSize: 25,
                      fontWeight: FontWeight.w600,
                    ),
                    textAlign: TextAlign.center,
                  ),
                  const SizedBox(height: 15),

                  // Formulaire
                  RegisterForm2(),

                  const SizedBox(height: 10),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class RegisterForm2 extends StatefulWidget {
  @override
  State<RegisterForm2> createState() => _RegisterForm2State();
}

class _RegisterForm2State extends State<RegisterForm2> {
  var nombreAdresseMailForm = 0;
  bool _desactive2 = false;
  dynamic data;
  String? boostId;
  dynamic idFormuleCampagneMail = 1;
  var _message = "";
  final telController = TextEditingController(text: tel);
  final replytoController = TextEditingController(text: mail);
  final titreController = TextEditingController();
  final sujetController = TextEditingController();
  final sendtoController = TextEditingController();
  final contentmailController = TextEditingController();

  List<Map<String, dynamic>> listeDesFormules = [];
  int value = 0;
  var label = "";
  int prix = 0;
  int nombre_mail = 0;

  String extraireAdressesEmail(String texte) {
    RegExp regex =
        RegExp(r'\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}\b');
    Iterable<Match> matches = regex.allMatches(texte);
    nombreAdresseMailForm = 0;
    List<String> adressesEmail = [];
    for (Match match in matches) {
      String? email = match.group(0);
      if (email != null) {
        adressesEmail.add(email);
        nombreAdresseMailForm++;
      }
    }
    return adressesEmail.join(',');
  }

  void listeFormuleBoost() async {
    bool isConnected = await isConnectedToInternet();
    if (isConnected) {
      setState(() {
        _desactive2 = true;
      });

      var request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/listeFormuleCampagneMail'));
      request.fields.addAll({});

      http.StreamedResponse response = await request.send();

      if (response.statusCode == 200) {
        var data1 = await response.stream.bytesToString();
        var data = convert.jsonDecode(data1);
        if (data["error"] == false) {
          setState(() {
            _desactive2 = false;
            listeDesFormules =
                (data["listeFormuleCampagneMail"] as List<dynamic>)
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
        _desactive2 = false;
      });
    }
  }

  void newCampagneMail() async {
    // ignore: unused_local_variable
    final vmail = extraireAdressesEmail(sendtoController.text);
    if (nombreAdresseMailForm > nombre_mail) {
      if (langUserPhone != "fr") {
        dangerNoti(
            "Error !",
            "Maximum $nombre_mail recipients for the plan you have chosen.",
            context);
      } else {
        dangerNoti(
            "Erreur !",
            "Maximum $nombre_mail destinataires pour le plan que vous avez choisi.",
            context);
      }
    } else if (nombreAdresseMailForm < 10) {
      if (langUserPhone != "fr") {
        dangerNoti("Error !", "At least 10 recipients are required.", context);
      } else {
        dangerNoti("Erreur !", "Il faut au minimum 10 destinataires.", context);
      }
    } else if (telIsVerified == true) {
      bool isConnected = await isConnectedToInternet();
      if (isConnected) {
        setState(() {
          _desactive2 = true;
        });
        var request = http.MultipartRequest(
            'POST', Uri.parse('$generalRouteForApi/newCampagneMail'));
        request.fields.addAll({
          'uid': uidUser,
          'langUserPhone': langUserPhone.toString(),
          'idFormuleCampagneMail': idFormuleCampagneMail.toString(),
          'titre': titreController.text,
          'sujet': sujetController.text,
          'replyto': replytoController.text,
          'sendto': extraireAdressesEmail(sendtoController.text),
          'contentmail': contentmailController.text,
        });

        http.StreamedResponse response = await request.send();

        if (response.statusCode == 200) {
          var data1 = await response.stream.bytesToString();
          var data = convert.jsonDecode(data1);
          if (data["error"] == false) {
            setState(() {
              _desactive2 = false;
              ScaffoldMessenger.of(context).showSnackBar(SnackBar(
                backgroundColor: Colors.green,
                behavior: SnackBarBehavior.floating,
                duration: const Duration(seconds: 15),
                content: Text(
                  (langUserPhone == "fr")
                      ? 'Votre campagne a été enregistrée, vous passerez au paiement si elle est acceptée.'
                      : 'Your campaign has been saved, you will proceed to payment if it is accepted.',
                  style: GoogleFonts.poppins(
                    color: Colors.white,
                  ),
                ),
              ));
              Navigator.pop(context);
              Navigator.push(
                context,
                MaterialPageRoute(
                  builder: (context) => CampagneMailListePage(),
                ),
              );
            });
          } else {
            dangerNoti(data["titre"], data["message"], context);
            setState(() {
              _desactive2 = false;
            });
          }
        }
      } else {
        if (langUserPhone != "fr") {
          dangerNoti(
              "Mistake!", "You are not connected to the internet.", context);
        } else {
          dangerNoti(
              "Erreur!", "Vous n'ètes pas connecté a internet.", context);
        }
        setState(() {
          _desactive2 = false;
        });
      }
    } else {
      if (langUserPhone != "fr") {
        dangerNoti("Access denied !",
            "Please confirm your WhatsApp number first.", context);
      } else {
        dangerNoti("Accès Refusé !",
            "Veuillez d'abord confirmer votre numéro WhatsApp.", context);
      }
      setState(() {
        _desactive2 = false;
      });
    }
  }

  void onChangeFormulBoost(val) async {
    for (var service in listeDesFormules) {
      if ("$val" == "${service['value']}") {
        setState(() {
          value = service['value'];
          label = service['label'];
          prix = service['prix'];
          nombre_mail = service['nombre_mail'];
        });
      }
    }
    setState(() {
      idFormuleCampagneMail = val;
      _message = (langUserPhone == "fr")
          ? "Cette formule vous offre une Campagne Mail vers 10 à $nombre_mail adresses mails au maximum à $prix FCFA."
          : "This formula offers you an Email Campaign to 10 at $nombre_mail email addresses at maximum at FCFA $prix.";
    });
  }

  @override
  void initState() {
    super.initState();
    listeFormuleBoost();
  }

  @override
  Widget build(BuildContext context) {
    return Container(
      child: Column(
        children: [
          DelayedAnimation(
            delay: 0, // 1500,
            child: SelectFormField(
              decoration: const InputDecoration(
                labelText: 'Formules de Campagne Mail Payante',
                border: OutlineInputBorder(),
              ),
              type: SelectFormFieldType.dropdown,
              initialValue: '0',
              labelText: 'Formules de Campagne Mail Payante',
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
          const SizedBox(height: 10),
          DelayedAnimation(
            delay: 0, // 1500,
            child: TextField(
              controller: titreController,
              decoration: InputDecoration(
                labelText: (langUserPhone == "fr") ? "Titre" : "Title",
                border: const OutlineInputBorder(),
              ),
            ),
          ),
          const SizedBox(height: 10),
          DelayedAnimation(
            delay: 0, // 1500,
            child: TextField(
              controller: sujetController,
              decoration: InputDecoration(
                labelText: (langUserPhone == "fr") ? "Sujet" : "Subject",
                border: const OutlineInputBorder(),
              ),
            ),
          ),
          const SizedBox(height: 10),
          DelayedAnimation(
            delay: 0, // 1500,
            child: TextField(
              readOnly: true,
              controller: replytoController,
              decoration: InputDecoration(
                labelText: (langUserPhone == "fr") ? "Réponde à" : "Reply to",
                border: const OutlineInputBorder(),
              ),
            ),
          ),
          const SizedBox(height: 10),
          DelayedAnimation(
            delay: 0, // 1500,
            child: TextField(
              maxLines: 3,
              minLines: 1,
              controller: sendtoController,
              decoration: InputDecoration(
                labelText:
                    (langUserPhone == "fr") ? "Destinataires" : "Recipients",
                helperText: (langUserPhone == "fr")
                    ? "Séparez les adresses par des virgules"
                    : "Separate addresses with commas",
                border: const OutlineInputBorder(),
              ),
            ),
          ),
          const SizedBox(height: 10),
          DelayedAnimation(
            delay: 0, // 1500,
            child: TextField(
              maxLines: 50,
              minLines: 1,
              controller: contentmailController,
              decoration: InputDecoration(
                labelText: (langUserPhone == "fr")
                    ? "Contenu du mail"
                    : "Content of the email",
                border: const OutlineInputBorder(),
              ),
            ),
          ),
          const SizedBox(height: 10),
          DelayedAnimation(
            delay: 0,
            child: SizedBox(
              width: MediaQuery.of(context).size.width * 0.95,
              child: ElevatedButton(
                style: ElevatedButton.styleFrom(
                  backgroundColor: primaryColor,
                  shape: const StadiumBorder(),
                  padding: const EdgeInsets.symmetric(
                    vertical: 13,
                  ),
                ),
                child: Text(
                  _desactive2
                      ? (langUserPhone == "fr")
                          ? "Patientez..."
                          : "Wait..."
                      : (langUserPhone == "fr")
                          ? "Envoyer"
                          : "Send",
                  style: GoogleFonts.poppins(
                    color: Colors.white,
                  ),
                ),
                onPressed: () {
                  if (!telIsVerified) {
                    warningNoti(
                        "Configuration du compte",
                        "Patientez encore svp. Votre numéro WhatsApp n'a pas encore été confirmé par un administrateur. Il le sera dans les plus brefs délais.",
                        context);
                  } else if (!mailIsVerified) {
                    warningNoti(
                        "Configuration du compte",
                        "Veuillez d'abord confirmer votre adresse mail...\n\nVous trouverez sur notre chaine YouTube des vidéos qui peuvent vous aider...",
                        context);
                  } else {
                    _desactive2 ? null : newCampagneMail();
                  }
                },
              ),
            ),
          ),
          const SizedBox(height: 10),
        ],
      ),
    );
  }
}
