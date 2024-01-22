// ignore_for_file: use_build_context_synchronously

import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/components/delayed_animation.dart';
import 'package:dressur/components/constant.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;
import 'package:dressur/components/sql_helper.dart';
import 'package:select_form_field/select_form_field.dart';
import 'package:dressur/components/noti.dart';

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
          style: GoogleFonts.poppins(fontWeight: FontWeight.w600),
        ),
        leading: IconButton(
          onPressed: () {
            Navigator.pop(context);
          },
          icon: const Icon(
            Icons.arrow_back,
            size: 30,
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
  bool _desactive2 = false;
  var _message = "";
  dynamic data;
  dynamic idFormulBoost = 1;
  dynamic valueMethodePaiement = "mtn";
  List<Map<String, dynamic>> listeFormulBoost = [];
  String? boostId;
  final telController = TextEditingController(text: tel);
  final replytoController = TextEditingController(text: mail);
  final titreController = TextEditingController();
  final sujetController = TextEditingController();
  final sendtoController = TextEditingController();

  void listeFormuleBoost() async {
    dynamic youHaveNetWork = "";
    youHaveConnexion();
    youHaveNetWork = await SQLHelper.getYouHaveConnexion();
    while (youHaveNetWork.length == 0) {
      youHaveNetWork = await SQLHelper.getYouHaveConnexion();
    }
    if (youHaveNetWork[0]['youHaveConnexion'] == "oui") {
      setState(() {
        _desactive2 = true;
      });

      var request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/listeFormuleBoost'));
      request.fields.addAll({});

      http.StreamedResponse response = await request.send();

      if (response.statusCode == 200) {
        var data1 = await response.stream.bytesToString();
        var data = convert.jsonDecode(data1);
        if (data["error"] == false) {
          SQLHelper.delete('listeFormulBoost');
          for (var listeFormulBoost in data["listeFormulBoost"]) {
            SQLHelper.insert({
              'tableName': "listeFormulBoost",
              'value': listeFormulBoost['id'],
              'label': listeFormulBoost['label'] +
                  " à " +
                  (listeFormulBoost['prix']).toString() +
                  " FCFA",
              'prix': listeFormulBoost['prix'],
              'jours': listeFormulBoost['jours']
            });
          }
          final dataElements = await SQLHelper.getAll("listeFormulBoost");
          setState(() {
            _desactive2 = false;
            listeFormulBoost = dataElements;
            onChangeFormulBoost(1);
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

  onChangeFormulBoost(val) async {
    var prix = (await SQLHelper.getFormulBoostWhithId(val))[0]['prix'];
    var jours = (await SQLHelper.getFormulBoostWhithId(val))[0]['jours'];
    setState(() {
      idFormulBoost = val;
      _message = (langUserPhone == "fr")
          ? "Cette formule vous offre un boost de $jours jour(s) pour $prix FCFA."
          : "This formula offers you a boost of $jours day(s) for $prix FCFA.";
    });
  }

  onChangeMethodePaiement(val) async {
    setState(() {
      valueMethodePaiement = val;
    });
  }

  void newBoostPayant() async {
    if (telIsVerified == true) {
      dynamic youHaveNetWork = "";
      youHaveConnexion();
      youHaveNetWork = await SQLHelper.getYouHaveConnexion();
      while (youHaveNetWork.length == 0) {
        youHaveNetWork = await SQLHelper.getYouHaveConnexion();
      }
      if (youHaveNetWork[0]['youHaveConnexion'] == "oui") {
        setState(() {
          _desactive2 = true;
        });

        var request = http.MultipartRequest(
            'POST', Uri.parse('$generalRouteForApi/newBoostPayant'));
        request.fields.addAll({
          'uid': uidUser,
          'langUserPhone': langUserPhone.toString(),
          'idFormulBoost': idFormulBoost.toString(),
          'valueMethodePaiement': valueMethodePaiement,
          'tel': telController.text
        });

        http.StreamedResponse response = await request.send();

        if (response.statusCode == 200) {
          var data1 = await response.stream.bytesToString();
          var data = convert.jsonDecode(data1);
          if (data["error"] == false) {
            // var idTransaction = data["idTransaction"];
            setState(() {
              _desactive2 = false;
              ScaffoldMessenger.of(context).showSnackBar(SnackBar(
                content: Text(
                  (langUserPhone == "fr")
                      ? 'Actualiser la liste de vos boosts...'
                      : 'Refresh the list of your boosts...',
                ),
              ));
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

  void checkTransaction(idTransaction) async {
    if (telIsVerified == true) {
      dynamic youHaveNetWork = "";
      youHaveConnexion();
      youHaveNetWork = await SQLHelper.getYouHaveConnexion();
      while (youHaveNetWork.length == 0) {
        youHaveNetWork = await SQLHelper.getYouHaveConnexion();
      }
      if (youHaveNetWork[0]['youHaveConnexion'] == "oui") {
        setState(() {
          _desactive2 = true;
        });

        var request = http.MultipartRequest(
            'POST', Uri.parse('$generalRouteForApi/checkTransaction'));
        request.fields.addAll({
          'uid': uidUser,
          'langUserPhone': langUserPhone.toString(),
          'idTransaction': idTransaction.toString()
        });

        http.StreamedResponse response = await request.send();

        if (response.statusCode == 200) {
          var data1 = await response.stream.bytesToString();
          var data = convert.jsonDecode(data1);
          if (data["error"] == false) {
            if (data["transaction"] == false) {
              dangerNoti(data["titre"], data["message"], context);

              setState(() {
                _desactive2 = false;
              });
            } else if (data["transaction"] == true) {
              successNoti(data["titre"], data["message"], context);

              ScaffoldMessenger.of(context).showSnackBar(SnackBar(
                content: Text(data["message"]),
              ));

              setState(() {
                _desactive2 = false;
              });
            }
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

  @override
  void initState() {
    super.initState(); // Loading the diary when the app starts
    listeFormuleBoost();
  }

  @override
  Widget build(BuildContext context) {
    return Container(
      child: Column(
        children: [
          DelayedAnimation(
            delay: 0, // 1500,
            child: TextField(
              controller: titreController,
              decoration: InputDecoration(
                labelStyle: TextStyle(color: Colors.grey[400]),
                labelText: (langUserPhone == "fr") ? "Titre" : "Title",
                border: const OutlineInputBorder(),
              ),
            ),
          ),
          const SizedBox(height: 10),
          DelayedAnimation(
            delay: 0, // 1500,
            child: TextField(
              controller: titreController,
              decoration: InputDecoration(
                labelStyle: TextStyle(color: Colors.grey[400]),
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
                labelStyle: TextStyle(color: Colors.grey[400]),
                labelText: (langUserPhone == "fr") ? "Réponde à" : "Reply to",
                border: const OutlineInputBorder(),
              ),
            ),
          ),
          const SizedBox(height: 10),
          DelayedAnimation(
            delay: 0, // 1500,
            child: TextField(
              controller: sendtoController,
              decoration: InputDecoration(
                labelStyle: TextStyle(color: Colors.grey[400]),
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
            child: SelectFormField(
              decoration: const InputDecoration(
                labelText: 'Methode de paiement mobile',
                border: OutlineInputBorder(),
              ),
              type: SelectFormFieldType.dropdown,
              initialValue: 'mtn',
              labelText: 'Methode de paiement mobile',
              items: listeMethodePaiement,
              onChanged: (val) => onChangeMethodePaiement(val),
              onSaved: (val) => print(val),
            ),
          ),
          const SizedBox(height: 10),
          DelayedAnimation(
            delay: 0, // 1500,
            child: TextField(
              controller: telController,
              decoration: InputDecoration(
                labelStyle: TextStyle(color: Colors.grey[400]),
                labelText: 'Indicatif + Numéro du paiement',
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
                child: _desactive2
                    ? const Text("Wait...")
                    : const Text("PAYER & BOOSTER"),
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
                    _desactive2 ? null : newBoostPayant();
                  }
                },
              ),
            ),
          ),
          const SizedBox(height: 20),
          DelayedAnimation(
            delay: 0, // 1000,
            child: Text(
              _message,
              style: GoogleFonts.poppins(
                color: Colors.blue[400],
                fontWeight: FontWeight.w600,
                fontSize: 12,
              ),
              textAlign: TextAlign.center,
            ),
          ),
          const SizedBox(height: 10),
          DelayedAnimation(
            delay: 0, // 1500,
            child: Text(
              (langUserPhone == "fr")
                  ? "Pour payer par Wave ou Carte Bancaire, veuillez contacter l'Assistance Dressur par WhatsApp. Merci..."
                  : "To pay by Wave or Credit Card, please contact Dressur Support by WhatsApp. THANKS...",
              style: GoogleFonts.poppins(
                fontWeight: FontWeight.w600,
                fontSize: 12,
                color: Colors.red[400],
              ),
              textAlign: TextAlign.center,
            ),
          ),
        ],
      ),
    );
  }
}
