// ignore_for_file: use_build_context_synchronously

import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/7_login/connexion.dart';
import 'package:dressur/components/delayed_animation.dart';
import 'package:dressur/components/constant.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;
import 'package:dressur/components/sql_helper.dart';
import 'package:dressur/components/noti.dart';

class ModifierMdpPage extends StatelessWidget {
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
          (langUserPhone == "fr") ? "Modifier Mot de Passe" : "Change Password",
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
                  DelayedAnimation(
                    delay: 0, // 500,
                    child: Text(
                      "",
                      style: GoogleFonts.poppins(
                          color: primaryColor,
                          fontSize: 25,
                          fontWeight: FontWeight.w600),
                      textAlign: TextAlign.center,
                    ),
                  ),
                  DelayedAnimation(
                    delay: 0, // 500,
                    child: SizedBox(
                      height: MediaQuery.of(context).size.height * 0.30,
                      child: Image.asset("images/passe_oublier.png"),
                    ),
                  ),
                  DelayedAnimation(
                    delay: 0, // 1000,
                    child: Text(
                      (langUserPhone == "fr")
                          ? "Renseignez l'ancien et le nouveau mot de passe."
                          : "Fill in the old and new password.",
                      style: GoogleFonts.poppins(
                        fontSize: 16,
                      ),
                      textAlign: TextAlign.center,
                    ),
                  ),
                  const SizedBox(height: 10),
                  SizedBox(
                    width: MediaQuery.of(context).size.width * 0.90,
                    child: RegisterForm(),
                  ),
                  const SizedBox(height: 80),
                ],
              ),
            )
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
  bool _desactivePasseForgetButton = false;
  var _obscureText = true;
  bool _obscureText_1 = false;
  bool _obscureText_2 = false;
  var data;
  final ancienPasswordController = TextEditingController();
  final passwordController = TextEditingController();
  final passwordVerifController = TextEditingController();

  //HTTP REQUEST REGISTER
  void registerIn(
    String ancienPassword,
    String password,
    String passwordVerif,
  ) async {
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
          'POST', Uri.parse('$generalRouteForApi/updateUserPassword'));
      request.fields.addAll({
        'uid': uidUser,
        'langUserPhone': langUserPhone.toString(),
        'currentPassword': ancienPassword,
        'newPassword': password,
        'confirmNewPassword': passwordVerif
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
            ancienPasswordController.text = "";
            passwordController.text = "";
            passwordVerifController.text = "";
            ScaffoldMessenger.of(context).showSnackBar(SnackBar(
              content: Text((langUserPhone == "fr")
                  ? 'Mot de passe modifier'
                  : 'Change password'),
            ));
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

  //HTTP REQUEST send MAIL CODE
  void sendMail() async {
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

      var request = http.MultipartRequest('POST',
          Uri.parse('$generalRouteForApi/sendMailPassForgotWithConnecte'));
      request.fields
          .addAll({'uid': uidUser, 'langUserPhone': langUserPhone.toString()});

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
          Navigator.push(
            context,
            MaterialPageRoute(builder: (context) => LoginPage()),
          );
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
            delay: 0, // 1500,
            child: TextField(
              controller: ancienPasswordController,
              obscureText: _obscureText,
              decoration: InputDecoration(
                border: const OutlineInputBorder(),
                labelText: (langUserPhone == "fr")
                    ? 'Ancien mot de passe'
                    : 'Old Password',
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
              controller: passwordController,
              obscureText: _obscureText_1,
              decoration: InputDecoration(
                border: const OutlineInputBorder(),
                labelText: (langUserPhone == "fr")
                    ? 'Nouveau mot de passe'
                    : 'New Password',
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
            delay: 0, // 3000,
            child: TextField(
              controller: passwordVerifController,
              obscureText: _obscureText_2,
              decoration: InputDecoration(
                border: const OutlineInputBorder(),
                labelText: (langUserPhone == "fr")
                    ? 'Confirmer le nouveau mot de passe'
                    : 'Confirm the new password',
                suffixIcon: IconButton(
                  icon: _obscureText_2
                      ? const Icon(
                          Icons.visibility,
                        )
                      : const Icon(
                          Icons.visibility_off,
                        ),
                  onPressed: () {
                    setState(() {
                      _obscureText_2 = !_obscureText_2;
                    });
                  },
                ),
              ),
            ),
          ),
          const SizedBox(height: 10),
          DelayedAnimation(
            delay: 0, // 3500,
            child: SizedBox(
              width: MediaQuery.of(context).size.width * 0.90,
              child: ElevatedButton(
                style: ElevatedButton.styleFrom(
                  backgroundColor: primaryColor,
                  shape: const StadiumBorder(),
                  padding: const EdgeInsets.symmetric(
                    vertical: 13,
                  ),
                ),
                child: Text(
                  _desactive
                      ? "Wait..."
                      : (langUserPhone == "fr")
                          ? "MODIFIER"
                          : "EDIT",
                  style: GoogleFonts.poppins(
                    color: Colors.white,
                    fontWeight: FontWeight.w400,
                  ),
                ),
                onPressed: () {
                  _desactive
                      ? null
                      : registerIn(
                          ancienPasswordController.text,
                          passwordController.text,
                          passwordVerifController.text,
                        );
                },
              ),
            ),
          ),
          const SizedBox(height: 20),
          DelayedAnimation(
            delay: 0, // 3500,
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
                  _desactivePasseForgetButton
                      ? "Wait..."
                      : (langUserPhone == "fr")
                          ? "Mot de passe oublié ?"
                          : "Forgot your password ?",
                  style: GoogleFonts.poppins(
                    color: Colors.white,
                    fontWeight: FontWeight.w400,
                  ),
                ),
                onPressed: () {
                  _desactivePasseForgetButton ? null : sendMail();
                },
              ),
            ),
          ),
        ],
      ),
    );
  }
}
