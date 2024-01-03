// ignore_for_file: use_build_context_synchronously

import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/1_contact/reconnaissance_contact.dart';
import 'package:dressur/components/delayed_animation.dart';
import 'package:dressur/components/constant.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;
import 'package:dressur/components/sql_helper.dart';
import 'package:dressur/components/noti.dart';
import 'package:dressur/5_autre/support_assistance.dart';

class InscriptionPage extends StatelessWidget {
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
              margin: const EdgeInsets.symmetric(vertical: 20, horizontal: 15),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.center,
                children: [
                  DelayedAnimation(
                    delay: 0, // 500,
                    child: SizedBox(
                      height: 200,
                      child: Image.asset("images/register.png"),
                    ),
                  ),
                  const SizedBox(height: 10),
                  DelayedAnimation(
                    delay: 0, // 500,
                    child: Text(
                      (langUserPhone == "fr") ? "Inscription" : "Registration",
                      style: GoogleFonts.poppins(
                          color: primaryColor,
                          fontSize: 30,
                          fontWeight: FontWeight.w600),
                      textAlign: TextAlign.center,
                    ),
                  ),
                  const SizedBox(height: 10),
                  DelayedAnimation(
                    delay: 0, // 750,
                    child: Text(
                      (langUserPhone == "fr")
                          ? "Entrer vos informations primordiales"
                          : "Enter your essential information",
                      style: GoogleFonts.poppins(
                        fontSize: 16,
                      ),
                      textAlign: TextAlign.center,
                    ),
                  ),

                  const SizedBox(height: 10),
                  // Formulaire
                  RegisterForm(),

                  const SizedBox(height: 20),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class RegisterForm extends StatefulWidget {
  @override
  State<RegisterForm> createState() => _RegisterFormState();
}

class _RegisterFormState extends State<RegisterForm> {
  bool _desactive = false;
  var _obscureText = true;
  var _obscureText_1 = true;
  var data;
  final pseudoController = TextEditingController();
  final telController = TextEditingController();
  final emailController = TextEditingController();
  final passwordController = TextEditingController();
  final passwordVerifController = TextEditingController();

  //HTTP REQUEST REGISTER
  void registerIn(String pseudo, String tel, String mail, String password,
      String passwordVerif) async {
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
          'POST', Uri.parse('$generalRouteForApi/inscriptionDS'));
      request.fields.addAll({
        'langUserPhone': langUserPhone.toString(),
        'pseudo': pseudo,
        'tel': tel,
        'mail': mail,
        'password': password,
        'confirmPassword': passwordVerif,
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
            initUserInformations(data['user']);
          });
          Navigator.of(context).push(
              MaterialPageRoute(builder: (context) => ReconnaissanceContact()));
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

  // REGISTER ERROR

  @override
  Widget build(BuildContext context) {
    return Container(
      child: Column(
        children: [
          DelayedAnimation(
            delay: 0, // 1000,
            child: TextField(
              controller: pseudoController,
              decoration: InputDecoration(
                labelStyle: TextStyle(color: Colors.grey[400]),
                border: const OutlineInputBorder(),
                labelText: 'Pseudo',
              ),
            ),
          ),
          const SizedBox(height: 10),
          DelayedAnimation(
            delay: 0, // 1500,
            child: TextField(
              controller: telController,
              decoration: InputDecoration(
                labelStyle: TextStyle(color: Colors.grey[400]),
                border: const OutlineInputBorder(),
                labelText: (langUserPhone == "fr")
                    ? 'Numéro Whatsapp'
                    : 'WhatsApp number',
              ),
            ),
          ),
          const SizedBox(height: 10),
          DelayedAnimation(
            delay: 0, // 1500,
            child: TextField(
              controller: emailController,
              decoration: InputDecoration(
                labelStyle: TextStyle(color: Colors.grey[400]),
                border: const OutlineInputBorder(),
                labelText: 'E-mail',
              ),
            ),
          ),
          const SizedBox(height: 10),
          DelayedAnimation(
            delay: 0, // 1750,
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
            delay: 0, // 2000,
            child: TextField(
              controller: passwordVerifController,
              obscureText: _obscureText_1,
              decoration: InputDecoration(
                labelStyle: TextStyle(color: Colors.grey[400]),
                border: const OutlineInputBorder(),
                labelText: (langUserPhone == "fr")
                    ? 'Confirmer le mot de passe'
                    : 'Confirm password',
                suffixIcon: IconButton(
                  icon: _obscureText_1
                      ? const Icon(
                          Icons.visibility,
                        )
                      : const Icon(
                          Icons.visibility_off,
                        ),
                  onPressed: () {
                    setState(() {
                      _obscureText_1 = !_obscureText_1;
                    });
                  },
                ),
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
                  backgroundColor: primaryColor,
                  shape: const StadiumBorder(),
                  padding: const EdgeInsets.symmetric(
                    vertical: 13,
                  ),
                  minimumSize: const Size.fromHeight(50),
                ),
                child: _desactive
                    ? const Text("Wait...")
                    : Text((langUserPhone == "fr")
                        ? "INSCRIPTION"
                        : "REGISTRATION"),
                onPressed: () {
                  _desactive
                      ? null
                      : registerIn(
                          pseudoController.text,
                          telController.text,
                          emailController.text,
                          passwordController.text,
                          passwordVerifController.text,
                        );
                },
              ),
            ),
          ),
        ],
      ),
    );
  }
}
