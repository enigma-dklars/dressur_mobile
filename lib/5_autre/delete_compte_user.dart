// ignore_for_file: use_build_context_synchronously

import 'package:art_sweetalert/art_sweetalert.dart';
import 'package:flutter/material.dart';
import 'package:flutter_contacts/flutter_contacts.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/6_login_register/connexion.dart';
import 'package:dressur/components/delayed_animation.dart';
import 'package:dressur/components/constant.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;
import 'package:dressur/components/sql_helper.dart';
import 'package:dressur/components/noti.dart';

class DeletecomptePage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        elevation: 0,
        backgroundColor: primaryColor,
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
        title: Text(
          (langUserPhone == "fr")
              ? "Suppression de compte"
              : "Account deletion",
          style: GoogleFonts.poppins(
            color: Colors.white,
            fontWeight: FontWeight.w400,
          ),
        ),
      ),
      body: SingleChildScrollView(
        child: Column(
          children: [
            Container(
              margin: const EdgeInsets.symmetric(vertical: 0, horizontal: 15),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.center,
                children: [
                  const SizedBox(height: 30),
                  const Icon(
                    Icons.dangerous,
                    size: 120,
                    color: Colors.redAccent,
                  ),
                  const SizedBox(height: 30),
                  DelayedAnimation(
                    delay: 0, // 500,
                    child: Container(
                      padding: const EdgeInsets.all(5.0),
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.circular(10),
                      ),
                      child: Text(
                        (langUserPhone == "fr")
                            ? "Dressur s'éfforce de garantir la sécurité et l'intégrité de ses services. Nous nous appuyons sur des principes de sécurité et de confidentialité solides."
                            : "Dressur strives to ensure the security and integrity of its services. We rely on strong security and privacy principles.",
                        style: GoogleFonts.poppins(
                          fontSize: 16,
                        ),
                        textAlign: TextAlign.center,
                      ),
                    ),
                  ),
                  const SizedBox(height: 30),
                  DeletecompteForm(),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class DeletecompteForm extends StatefulWidget {
  @override
  State<DeletecompteForm> createState() => _DeletecompteFormState();
}

class _DeletecompteFormState extends State<DeletecompteForm> {
  bool _desactive = false;
  var data;
  final motifController = TextEditingController();

  //HTTP REQUEST REGISTER
  void deletecompteUser(String motif) async {
    dynamic youHaveNetWork = "";
    youHaveConnexion();
    youHaveNetWork = await SQLHelper.getYouHaveConnexion();
    while (youHaveNetWork.length == 0) {
      youHaveNetWork = await SQLHelper.getYouHaveConnexion();
    }
    if (youHaveNetWork[0]['youHaveConnexion'] == "oui") {
      setState(() {
        _desactive = true;
      });

      var request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/deleteCompteDS'));
      request.fields.addAll({
        'uid': uidUser,
        'langUserPhone': langUserPhone.toString(),
        'motifDeleted': motif
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
          setState(() async {
            if (contactsEnregistrer.isNotEmpty) {
              List<Contact> contacts =
                  await FlutterContacts.getContacts(withProperties: true);
              for (var contact in contacts) {
                for (var phone in contact.phones) {
                  var numberTel =
                      (phone.number).replaceAll(" ", "").replaceAll("-", "");
                  if (contactsEnregistrer.contains(numberTel)) {
                    await contact.delete();
                  }
                }
              }
            }
            _desactive = false;
            SQLHelper.viderLaBaseDeDonneeLocal();
            ScaffoldMessenger.of(context).showSnackBar(const SnackBar(
              content: Text('Compte supprimer avec succès ...'),
            ));
            Navigator.pushReplacement(
              context,
              MaterialPageRoute(builder: (context) => LoginPage()),
            );
          });
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
  Widget build(BuildContext context) {
    return Container(
      child: Column(
        children: [
          DelayedAnimation(
            delay: 0, // 2250,
            child: TextField(
              maxLines: null,
              controller: motifController,
              decoration: InputDecoration(
                labelStyle: TextStyle(color: Colors.grey[400]),
                border: const OutlineInputBorder(),
                labelText: (langUserPhone == "fr") ? 'Motif' : 'Pattern',
              ),
            ),
          ),
          const SizedBox(height: 10),
          DelayedAnimation(
            delay: 0, // 2500,
            child: SizedBox(
              width: MediaQuery.of(context).size.width * 0.90,
              child: ElevatedButton(
                style: ElevatedButton.styleFrom(
                  backgroundColor: Colors.redAccent,
                  shape: const StadiumBorder(),
                  padding: const EdgeInsets.symmetric(
                    vertical: 13,
                  ),
                  minimumSize: const Size.fromHeight(50),
                ),
                child: Text(
                  _desactive
                      ? (langUserPhone == "fr")
                            ? "Patientez..."
                            : "Wait..."
                      : (langUserPhone == "fr")
                          ? "SUPPRIMER"
                          : "DELETE",
                  style: GoogleFonts.poppins(
                    color: Colors.white,
                    fontWeight: FontWeight.w400,
                  ),
                ),
                onPressed: () async {
                  if (_desactive) {
                  } else {
                    ArtDialogResponse response = await ArtSweetAlert.show(
                      barrierDismissible: false,
                      context: context,
                      artDialogArgs: ArtDialogArgs(
                          title: (langUserPhone == "fr")
                              ? "Suppression ?"
                              : "Delete?",
                          text: (langUserPhone == "fr")
                              ? "Voulez vous vraiment supprimer votre compte ?"
                              : "Are you sure you want to delete your account?",
                          confirmButtonText:
                              (langUserPhone == "fr") ? "Oui" : "Yes",
                          denyButtonText:
                              (langUserPhone == "fr") ? "Non" : "No",
                          type: ArtSweetAlertType.warning),
                    );
                    if (response.isTapConfirmButton) {
                      deletecompteUser(motifController.text);
                    }
                  }
                },
              ),
            ),
          ),
        ],
      ),
    );
  }
}
