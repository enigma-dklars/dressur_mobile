// ignore_for_file: use_build_context_synchronously

import 'package:art_sweetalert/art_sweetalert.dart';
import 'package:flutter/material.dart';
import 'package:dressur/7_login/connexion.dart';
import 'package:dressur/components/constant.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/components/delayed_animation.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;
import 'package:dressur/components/sql_helper.dart';
import 'package:dressur/components/noti.dart';
import 'package:dressur/5_autre/support_assistance.dart';

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
        child: RecuperationForm(),
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
            // Navigator.push(
            //   context,
            //   MaterialPageRoute(builder: (context) => LoginPage()),
            // );
            Navigator.pop(context);
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
      child: Stack(
        children: [
          Container(
            height: MediaQuery.of(context).size.height / 3.5,
            width: MediaQuery.of(context).size.width,
            decoration: BoxDecoration(
              gradient: const LinearGradient(
                colors: [
                  primaryColor,
                  Color(0xFF6380fb),
                ],
                begin: Alignment.topCenter,
                end: Alignment.bottomCenter,
              ),
              borderRadius: BorderRadius.vertical(
                bottom:
                    Radius.elliptical(MediaQuery.of(context).size.width, 105.0),
              ),
            ),
          ),
          Padding(
            padding: const EdgeInsets.only(top: 40),
            child: Column(
              children: [
                Padding(
                  padding: const EdgeInsets.fromLTRB(20, 0, 20, 0),
                  child: Center(
                    child: Text(
                      (langUserPhone == "fr")
                          ? "Récupération du mot de passe"
                          : "Password Recovery",
                      style: const TextStyle(
                        color: Colors.white,
                        fontSize: 30,
                        fontWeight: FontWeight.bold,
                      ),
                      textAlign: TextAlign.center,
                    ),
                  ),
                ),
                const SizedBox(height: 5),
                Padding(
                  padding: const EdgeInsets.fromLTRB(20, 0, 20, 0),
                  child: Center(
                      child: Text(
                    (langUserPhone == "fr")
                        ? "Renseigner votre adresse email."
                        : "Fill in your email address.",
                    style: const TextStyle(
                      color: Color(0xFFbbb0ff),
                      fontSize: 16.0,
                      fontWeight: FontWeight.w500,
                    ),
                    textAlign: TextAlign.center,
                  )),
                ),
                const SizedBox(height: 10),
                Container(
                  margin: const EdgeInsets.symmetric(
                      vertical: 15.0, horizontal: 15.0),
                  child: Material(
                    borderRadius: BorderRadius.circular(10),
                    child: Container(
                      padding: const EdgeInsets.symmetric(
                          vertical: 30.0, horizontal: 15.0),
                      width: MediaQuery.of(context).size.width,
                      decoration: BoxDecoration(
                          color: Colors.white,
                          borderRadius: BorderRadius.circular(10)),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            (langUserPhone == "fr")
                                ? "Un nouveau mot de passe sera envoyer à cette adresse."
                                : "A new password will be sent to this address.",
                            style: const TextStyle(
                              color: Colors.black,
                              fontSize: 18.0,
                              fontWeight: FontWeight.w500,
                            ),
                            textAlign: TextAlign.center,
                          ),
                          const SizedBox(height: 10),
                          Text(
                            (langUserPhone == "fr")
                                ? "Utiliser votre adresse et ce nouveau mot de passe pour vous connecter."
                                : "Use your address and this new password to connect.",
                            style: const TextStyle(
                              color: Colors.black,
                              fontSize: 18.0,
                              fontWeight: FontWeight.w500,
                            ),
                            textAlign: TextAlign.center,
                          ),
                          const SizedBox(height: 20),
                          const Text(
                            "E-mail",
                            style: TextStyle(
                                color: Colors.black,
                                fontSize: 18.0,
                                fontWeight: FontWeight.w500),
                          ),
                          const SizedBox(height: 5),
                          Container(
                            decoration: BoxDecoration(
                                border: Border.all(
                                    width: 1.0, color: Colors.black38),
                                borderRadius: BorderRadius.circular(10)),
                            child: TextFormField(
                              style: const TextStyle(
                                color: Colors.black,
                                fontSize: 20,
                              ),
                              controller: emailController,
                              decoration: const InputDecoration(
                                  border: InputBorder.none,
                                  prefixIcon: Icon(
                                    Icons.mail_outline,
                                    color: primaryColor,
                                  )),
                            ),
                          ),
                          const SizedBox(height: 15),
                          SizedBox(
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
                                  : Text(
                                      (langUserPhone == "fr")
                                          ? "CONFIRMER"
                                          : "CONFIRM",
                                      style: const TextStyle(
                                          color: Colors.white,
                                          fontSize: 18,
                                          fontWeight: FontWeight.bold),
                                    ),
                              onPressed: () {
                                _desactive
                                    ? null
                                    : sendMail(emailController.text);
                              },
                            ),
                          ),
                        ],
                      ),
                    ),
                  ),
                ),
                const SizedBox(height: 40),
              ],
            ),
          )
        ],
      ),
    );
  }
}
