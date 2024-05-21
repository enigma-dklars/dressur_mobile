// ignore_for_file: prefer_const_constructors, use_build_context_synchronously

import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/5_autre/support_assistance.dart';
import 'package:dressur/components/bottomBar.dart';
import 'package:dressur/components/delayed_animation.dart';
import 'package:dressur/components/constant.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;
import 'package:dressur/components/sql_helper.dart';
import 'package:dressur/components/noti.dart';

class CodeMailConfirmePage extends StatelessWidget {
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
            color: Colors.white,
            size: 30,
          ),
        ),
        title: Text(
          (langUserPhone == "fr")
              ? "Confirmation du Mail"
              : "Email Confirmation",
          style: GoogleFonts.poppins(
            fontWeight: FontWeight.w600,
            color: Colors.white,
          ),
        ),
        actions: [
          PopupMenuButton<int>(
            itemBuilder: (context) => [
              PopupMenuItem(
                value: 1,
                child: Row(
                  children: [
                    Text(
                      (langUserPhone == "fr") ? "Actualiser" : "Refresh",
                    ),
                  ],
                ),
              ),
              PopupMenuItem(
                value: 2,
                child: Row(
                  children: [
                    Text(
                      (langUserPhone == "fr") ? "Aide" : "Help",
                    ),
                  ],
                ),
              ),
            ],
            offset: const Offset(0, 60),
            color: primaryColor,
            elevation: 2,
            onSelected: (value) {
              if (value == 2) {
                Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => SupportPage()),
                );
              }
            },
          ),
        ],
      ),
      body: SingleChildScrollView(
        child: Column(
          children: [
            Container(
              margin: const EdgeInsets.symmetric(vertical: 0, horizontal: 15),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.center,
                children: [
                  ConfirmeForme(),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class ConfirmeForme extends StatefulWidget {
  ConfirmeForme({Key? key}) : super(key: key);

  @override
  State<ConfirmeForme> createState() => _ConfirmeFormeState();
}

class _ConfirmeFormeState extends State<ConfirmeForme> {
  bool _desactive = false;
  var data;
  final _codeMailVerifyController = TextEditingController();
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
      var request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/sendMailVerification'));
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
          if (langUserPhone != "fr") {
            successNoti(
                "Code Send!",
                "A code has been sent to your email address.\nEnter it and validate the form to confirm your email address.",
                context);
          } else {
            successNoti(
                "Code Envoyer !",
                "Un code a été envoyer a votre adresse mail.\nSaisisez le et validez le formulaire pour confirmer votre adresse mail.",
                context);
          }

          setState(() {
            _desactive = false;
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

  void codeVerif(String codeForVerifMail) async {
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
          'POST', Uri.parse('$generalRouteForApi/mailVerification'));
      request.fields.addAll({
        'uid': uidUser,
        'langUserPhone': langUserPhone.toString(),
        'codeForVerifMail': codeForVerifMail
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
            mailIsVerified = true;
            _desactive = false;
            initUserInformations(data['user']);

            Future.delayed(const Duration(seconds: 5), () {});

            Navigator.of(context).push(
                MaterialPageRoute(builder: (context) => const BottomBar()));
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
  void initState() {
    super.initState();
  }

  Widget build(BuildContext context) {
    return Container(
      child: Column(
        children: [
          const SizedBox(height: 20),
          DelayedAnimation(
            delay: 0, // 500,
            child: SizedBox(
              height: MediaQuery.of(context).size.height * 0.20,
              child: Image.asset("images/ds_img_6.png"),
            ),
          ),
          const SizedBox(height: 20),
          DelayedAnimation(
            delay: 500, // 3500,
            child: ElevatedButton(
              style: ElevatedButton.styleFrom(
                backgroundColor: secondaryColor,
                shape: const StadiumBorder(),
                padding: const EdgeInsets.symmetric(
                  horizontal: 20,
                  // vertical: 13,
                ),
              ),
              child: Text(
                  _desactive
                      ? (langUserPhone == "fr")
                          ? "Patientez..."
                          : "Wait..."
                      : (langUserPhone == "fr")
                          ? "Renvoyer le code"
                          : "Return the code",
                  style: GoogleFonts.poppins(
                    fontWeight: FontWeight.w600,
                    color: Colors.white,
                  )),
              onPressed: () {
                _desactive ? null : sendMail();
              },
            ),
          ),
          const SizedBox(height: 20),
          DelayedAnimation(
            delay: 0, // 1000,
            child: Text(
              (langUserPhone == "fr")
                  ? "Vous n'avez pas reçu le code par mail ? Cliquez sur le bouton bleu ci-dessus pour recevoir un nouveau code de confirmation de votre adresse mail ($mail). Contactez simplement l'Assistance Dressur après 2H d'attente..."
                  : "Didn't receive the code by email? Click on the blue button above to receive a new confirmation code from your email address ($mail). Simply contact Dressur Assistance after 2 hours of waiting...",
              style: GoogleFonts.poppins(
                fontSize: 16,
              ),
              textAlign: TextAlign.justify,
            ),
          ),
          const SizedBox(height: 20),
          DelayedAnimation(
            delay: 0, // 1000,
            child: Text(
              (langUserPhone == "fr")
                  ? "Renseignez le code de confirmation reçu par mail."
                  : "Enter the confirmation code received by email.",
              style: GoogleFonts.poppins(
                color: secondaryColor,
                fontSize: 16,
                fontWeight: FontWeight.w600,
              ),
              textAlign: TextAlign.center,
            ),
          ),
          const SizedBox(height: 20),
          DelayedAnimation(
            delay: 0, // 2000,
            child: TextField(
              controller: _codeMailVerifyController,
              decoration: InputDecoration(
                labelStyle: TextStyle(color: secondaryColor),
                border: const OutlineInputBorder(),
                labelText: (langUserPhone == "fr")
                    ? 'Code verification mail'
                    : 'Mail verification code',
              ),
            ),
          ),
          const SizedBox(height: 20),
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
                        ? (langUserPhone == "fr")
                            ? "Patientez..."
                            : "Wait..."
                        : (langUserPhone == "fr")
                            ? "CONFIRMER"
                            : "CONFIRM",
                    style: GoogleFonts.poppins(
                      fontWeight: FontWeight.w600,
                      color: Colors.white,
                    )),
                onPressed: () {
                  _desactive ? null : codeVerif(_codeMailVerifyController.text);
                },
              ),
            ),
          ),
          const SizedBox(height: 20),
        ],
      ),
    );
  }
}
