// ignore_for_file: use_build_context_synchronously

import 'package:art_sweetalert/art_sweetalert.dart';
import 'package:flutter/material.dart';
import 'package:whatsperson/7_login/connexion.dart';
import 'package:whatsperson/components/constant.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:whatsperson/components/delayed_animation.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;
import 'package:whatsperson/components/sql_helper.dart';
import 'package:whatsperson/components/noti.dart';
import 'package:whatsperson/5_autre/support_assistance.dart';

class RecuperationPage extends StatefulWidget {
  @override
  State<RecuperationPage> createState() => _RecuperationPageState();
}

class _RecuperationPageState extends State<RecuperationPage> {
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
          ),
        ),
        actions: [
          Padding(
            padding: const EdgeInsets.only(right: 20.0),
            child: Row(
              children: [
                GestureDetector(
                  onTap: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(builder: (context) => SupportPage()),
                    );
                  },
                  child: const Icon(
                    Icons.help,
                    size: 30.0,
                  ),
                )
              ],
            ),
          ),
        ],
      ),
      body: SingleChildScrollView(
        child: Column(
          children: [
            Container(
              margin: const EdgeInsets.symmetric(vertical: 15, horizontal: 15),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.center,
                children: [
                  DelayedAnimation(
                    delay: 0, // 500,
                    child: SizedBox(
                      height: 250,
                      child: Image.asset("images/passe_oublier.png"),
                    ),
                  ),

                  SizedBox(
                    width: MediaQuery.of(context).size.width * 0.90,
                    child: DelayedAnimation(
                      delay: 0, // 750,
                      child: Container(
                        margin: const EdgeInsets.symmetric(
                          vertical: 15,
                        ),
                        child: Column(
                          children: [
                            Text(
                              (langUserPhone == "fr")
                                  ? "Récupération du mot de passe"
                                  : "Password Recovery",
                              style: GoogleFonts.poppins(
                                  color: primaryColor,
                                  fontSize: 30,
                                  fontWeight: FontWeight.w600),
                              textAlign: TextAlign.center,
                            ),
                            const SizedBox(height: 10),
                            Text(
                              (langUserPhone == "fr")
                                  ? "Renseigner votre adresse email.\nUn nouveau mot de passe sera envoyer à cette adresse.\nUtiliser votre adresse et ce nouveau mot de passe pour vous connecter."
                                  : "Fill in your email address.\nA new password will be sent to this address.\nUse your address and this new password to connect.",
                              style: GoogleFonts.poppins(
                                fontSize: 16,
                              ),
                              textAlign: TextAlign.center,
                            ),
                          ],
                        ),
                      ),
                    ),
                  ),

                  // Formulaire
                  RecuperationForm(),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class RecuperationForm extends StatefulWidget {
  @override
  State<RecuperationForm> createState() => _RecuperationFormState();
}

class _RecuperationFormState extends State<RecuperationForm> {
  final emailController = TextEditingController();
  bool _desactive = false;
  var data;

  //HTTP REQUEST
  void sendMail(String email) async {
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
          'POST', Uri.parse('$generalRouteForApi/sendMailPassForgot'));
      request.fields
          .addAll({'mail': email, 'langUserPhone': langUserPhone.toString()});

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
            modeMotDePasseOublier = true;
            mailConnexion = email;
          });
          ArtDialogResponse response = await ArtSweetAlert.show(
              barrierDismissible: false,
              context: context,
              artDialogArgs: ArtDialogArgs(
                  title:
                      (langUserPhone == "fr") ? "Mail Envoyé!" : "E-mail sent!",
                  text: (langUserPhone == "fr")
                      ? "Nous vous avons envoyé un nouveau mot de passe par mail. Utilisez-le pour vous connecter, n'oubliez pas de le changer une fois connecter."
                      : "We have sent you a new password by email. Use it to log in, don't forget to change it once logged in.",
                  confirmButtonText: (langUserPhone == "fr")
                      ? "Allez sur la page Connexion"
                      : "Go to the Login page",
                  type: ArtSweetAlertType.success));

          if (response.isTapConfirmButton) {
            Navigator.push(
              context,
              MaterialPageRoute(builder: (context) => LoginPage()),
            );
          }
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
            delay: 0,
            child: TextField(
              controller: emailController,
              decoration: InputDecoration(
                labelStyle: TextStyle(color: Colors.grey[400]),
                border: const OutlineInputBorder(),
                labelText: 'Email',
              ),
            ),
          ),
          const SizedBox(height: 10),
          DelayedAnimation(
            delay: 0, // 1500,
            child: SizedBox(
              width: MediaQuery.of(context).size.width * 0.90,
              child: ElevatedButton(
                  style: ElevatedButton.styleFrom(
                    backgroundColor: primaryColor,
                    shape: const StadiumBorder(),
                    padding: const EdgeInsets.symmetric(
                      vertical: 13,
                    ),
                    minimumSize: const Size.fromHeight(50),
                  ),
                  child: _desactive
                      ? const Text("Wait...")
                      : Text((langUserPhone == "fr") ? "CONFIRMER" : "CONFIRM"),
                  onPressed: () {
                    _desactive ? null : sendMail(emailController.text);
                  }),
            ),
          ),
        ],
      ),
    );
  }
}
