// ignore_for_file: use_build_context_synchronously

import 'package:flutter/material.dart';
import 'package:dressur/6_login_register/mot_de_passe_oublier.dart';
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
            color: Colors.white,
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
                    color: Colors.white,
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
            LoginForm(),
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
  bool isPasswordObscured = true;
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
              .push(MaterialPageRoute(builder: (context) => const BottomBar()));
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
                Center(
                    child: Text(
                  (langUserPhone == "fr") ? "Connexion" : "Login",
                  style: const TextStyle(
                      color: Colors.white,
                      fontSize: 30,
                      fontWeight: FontWeight.bold),
                )),
                const SizedBox(height: 5),
                Padding(
                  padding: const EdgeInsets.fromLTRB(20, 0, 20, 0),
                  child: Center(
                      child: Text(
                    (langUserPhone == "fr")
                        ? "Renseigner votre adresse email et mot de passe pour accéder à votre compte."
                        : "Enter your email address and password to access your account.",
                    style: const TextStyle(
                      color: Colors.white,
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
                          Text(
                            (langUserPhone == "fr")
                                ? 'Mot de passe'
                                : 'Password',
                            style: const TextStyle(
                                color: Colors.black,
                                fontSize: 18.0,
                                fontWeight: FontWeight.w500),
                          ),
                          const SizedBox(height: 5),
                          Container(
                            decoration: BoxDecoration(
                              border: Border.all(
                                width: 1.0,
                                color: Colors.black38,
                              ),
                              borderRadius: BorderRadius.circular(10),
                            ),
                            child: TextFormField(
                              style: const TextStyle(
                                color: Colors.black,
                                fontSize: 20,
                              ),
                              controller: passwordController,
                              decoration: InputDecoration(
                                border: InputBorder.none,
                                prefixIcon: const Icon(
                                  Icons.password,
                                  color: primaryColor,
                                ),
                                suffixIcon: IconButton(
                                  icon: Icon(
                                    isPasswordObscured
                                        ? Icons.visibility
                                        : Icons.visibility_off,
                                    color: primaryColor,
                                  ),
                                  onPressed: () {
                                    setState(() {
                                      isPasswordObscured = !isPasswordObscured;
                                    });
                                  },
                                ),
                              ),
                              obscureText: isPasswordObscured,
                            ),
                          ),
                          const SizedBox(height: 10.0),
                          GestureDetector(
                            onTap: () {
                              Navigator.push(
                                context,
                                MaterialPageRoute(
                                    builder: (context) => RecuperationPage()),
                              );
                            },
                            child: Container(
                              alignment: Alignment.bottomRight,
                              child: Text(
                                (langUserPhone == "fr")
                                    ? "Mot de passe oublié ?"
                                    : "Forgot your password ?",
                                style: const TextStyle(
                                  color: Colors.black,
                                  fontSize: 16.0,
                                  fontWeight: FontWeight.w500,
                                  decoration: TextDecoration
                                      .underline, // Ajoutez un soulignement pour indiquer que c'est cliquable
                                ),
                              ),
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
                                          ? "CONNEXION"
                                          : "LOGIN",
                                      style: const TextStyle(
                                          color: Colors.white,
                                          fontSize: 18,
                                          fontWeight: FontWeight.bold),
                                    ),
                              onPressed: () {
                                _desactive
                                    ? null
                                    : loginIn(emailController.text,
                                        passwordController.text);
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
