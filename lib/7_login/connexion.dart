// ignore_for_file: use_build_context_synchronously

import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/7_login/mot_de_passe_oublier.dart';
import 'package:dressur/components/delayed_animation.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/sql_helper.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;
import 'package:dressur/components/noti.dart';
import 'package:dressur/components/bottomBar.dart';
import 'package:dressur/5_autre/support_assistance.dart';

class LoginPage extends StatelessWidget {
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
                      height: 200,
                      child: Image.asset("images/login.png"),
                    ),
                  ),

                  DelayedAnimation(
                    delay: 0, // 750,
                    child: Container(
                      margin: const EdgeInsets.symmetric(
                        vertical: 20,
                        horizontal: 0,
                      ),
                      child: Column(
                        children: [
                          Text(
                            (langUserPhone == "fr") ? "Connexion" : "Login",
                            style: GoogleFonts.poppins(
                                color: primaryColor,
                                fontSize: 30,
                                fontWeight: FontWeight.w600),
                            textAlign: TextAlign.center,
                          ),
                          const SizedBox(height: 10),
                          Text(
                            (langUserPhone == "fr")
                                ? "Renseigner votre adresse email et mot de passe pour accéder à votre compte."
                                : "Enter your email address and password to access your account.",
                            style: GoogleFonts.poppins(
                              fontSize: 16,
                            ),
                            textAlign: TextAlign.center,
                          ),
                        ],
                      ),
                    ),
                  ),

                  // Formulaire
                  LoginForm(),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class LoginForm extends StatefulWidget {
  @override
  State<LoginForm> createState() => _LoginFormState();
}

class _LoginFormState extends State<LoginForm> {
  bool _desactive = false;
  var _obscureText = true;
  var data;
  final emailController = TextEditingController(text: mailConnexion);
  final passwordController = TextEditingController();

  //HTTP REQUEST
  void loginIn(String email, String pass) async {
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
          'POST', Uri.parse('$generalRouteForApi/connect'));
      request.fields.addAll({
        'mail': email,
        'password': pass,
        'langUserPhone': langUserPhone.toString()
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
            initUserInformations(data["user"]);
            _desactive = false;
          });

          Navigator.of(context)
              .push(MaterialPageRoute(builder: (context) => BottomBar()));
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
            delay: 0, // 1000,
            child: TextField(
              controller: emailController,
              decoration: InputDecoration(
                labelStyle: TextStyle(color: Colors.grey[400]),
                border: const OutlineInputBorder(),
                labelText: 'E-Mail',
              ),
            ),
          ),
          const SizedBox(height: 10),
          DelayedAnimation(
            delay: 0, // 1250,
            child: TextField(
              controller: passwordController,
              obscureText: _obscureText,
              decoration: InputDecoration(
                labelStyle: TextStyle(color: Colors.grey[400]),
                border: const OutlineInputBorder(),
                labelText:
                    (langUserPhone == "fr") ? 'Mot de passe' : 'Password',
                suffixIcon: IconButton(
                  icon: _obscureText
                      ? const Icon(
                          Icons.visibility,
                        )
                      : const Icon(
                          Icons.visibility_off,
                        ),
                  onPressed: () {
                    setState(() {
                      _obscureText = !_obscureText;
                    });
                  },
                ),
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
                    ), //impossible button
                  ),
                  child: _desactive
                      ? const Text("Wait...")
                      : Text((langUserPhone == "fr") ? "CONNEXION" : "LOGIN"),
                  onPressed: () {
                    _desactive
                        ? null
                        : loginIn(
                            emailController.text, passwordController.text);
                  }),
            ),
          ),
          const SizedBox(height: 20),
          DelayedAnimation(
            delay: 0, // 1500,
            child: SizedBox(
              width: MediaQuery.of(context).size.width * 0.60,
              child: ElevatedButton(
                  style: ElevatedButton.styleFrom(
                    backgroundColor: secondaryColor,
                    shape: const StadiumBorder(),
                    padding: const EdgeInsets.symmetric(
                      vertical: 13,
                    ),
                  ),
                  child: Text(
                    (langUserPhone == "fr")
                        ? "Mot de passe oublié ?"
                        : "Forgot your password ?",
                  ),
                  onPressed: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(
                          builder: (context) => RecuperationPage()),
                    );
                  }),
            ),
          ),
        ],
      ),
    );
  }
}
