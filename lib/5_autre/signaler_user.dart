// ignore_for_file: use_build_context_synchronously

import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/components/delayed_animation.dart';
import 'package:dressur/components/constant.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;
import 'package:dressur/components/sql_helper.dart';
import 'package:dressur/components/noti.dart';

class SignalerPage extends StatelessWidget {
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
          (langUserPhone == "fr") ? "Signaler un utilisateur" : "Report a user",
          style: GoogleFonts.poppins(
            color: Colors.white,
            fontWeight: FontWeight.w400,
          ),
        ),
      ),
      body: SingleChildScrollView(
        child: Column(
          children: [
            const SizedBox(height: 30),
            const Icon(
              Icons.dangerous,
              size: 120,
              color: Colors.redAccent,
            ),
            const SizedBox(height: 30),
            Container(
              margin: const EdgeInsets.symmetric(vertical: 0, horizontal: 15),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.center,
                children: [
                  DelayedAnimation(
                    delay: 0, // 500,
                    child: Container(
                      padding: const EdgeInsets.all(5.0),
                      child: Text(
                        (langUserPhone == "fr")
                            ? "Signaler un utilisateur en remplissant le formulaire ci-dessous. Votre plainte sera étudier et des mesures seront prises conformément à nos conditions d'utilisations."
                            : "Report a user by filling out the form below. Your complaint will be investigated and action will be taken in accordance with our Terms of Use.",
                        style: GoogleFonts.poppins(
                          fontSize: 16,
                        ),
                        textAlign: TextAlign.center,
                      ),
                    ),
                  ),
                  const SizedBox(height: 30),
                  SignalerForm(),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class SignalerForm extends StatefulWidget {
  @override
  State<SignalerForm> createState() => _SignalerFormState();
}

class _SignalerFormState extends State<SignalerForm> {
  bool _desactive = false;
  var data;
  final telController = TextEditingController();
  final motifController = TextEditingController();

  //HTTP REQUEST REGISTER
  void signaleUser(String tel, String motif) async {
    dynamic youHaveNetWork = "";
    youHaveConnexion();
    youHaveNetWork = await SQLHelper.getYouHaveConnexion();
    while (youHaveNetWork.length == 0) {
      youHaveNetWork = await SQLHelper.getYouHaveConnexion();
    }
    if (youHaveNetWork[0]['youHaveConnexion'] == "oui") {
      setState(() {
        _desactive = true;
        // UserClass.getItem('userInfos', 0);
      });

      var request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/addSignalement'));
      request.fields.addAll({
        'uid': uidUser,
        'langUserPhone': langUserPhone.toString(),
        'telSignaler': tel,
        'motifSignaler': motif
      });

      http.StreamedResponse response = await request.send();

      if (response.statusCode == 200) {
        var data1 = await response.stream.bytesToString();
        print(data1);
        data = convert.jsonDecode(data1);
        if (data["error"] == true) {
          dangerNoti(data["titre"], data["message"], context);
          setState(() {
            _desactive = false;
          });
        } else {
          setState(() {
            _desactive = false;
            Navigator.pop(context);
            ScaffoldMessenger.of(context).showSnackBar(SnackBar(
              backgroundColor: Colors.green,
              behavior: SnackBarBehavior.floating,
              content: Text(
                (langUserPhone == "fr")
                    ? 'Utilisateur signaler avec succès…'
                    : 'User report successfully…',
                style: GoogleFonts.poppins(
                  color: Colors.white,
                ),
              ),
            ));
          });
        }
      } else {
        setState(() {
          _desactive = false;
        });
        if (langUserPhone != "fr") {
          dangerNoti("Mistake!",
              "We encountered a problem, contact the administrators.", context);
        } else {
          dangerNoti(
              "Erreur!",
              "Nous avons rencontré un problème, contacter les administrateurs.",
              context);
        }
      }
    } else {
      setState(() {
        _desactive = false;
      });
      if (langUserPhone != "fr") {
        dangerNoti(
            "Mistake!", "You are not connected to the internet.", context);
      } else {
        dangerNoti("Erreur!", "Vous n'ètes pas connecté a internet.", context);
      }
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
              controller: telController,
              decoration: InputDecoration(
                border: const OutlineInputBorder(),
                labelText: (langUserPhone == "fr")
                    ? 'Numéro Whatsapp'
                    : 'Whatsapp number',
              ),
            ),
          ),
          const SizedBox(height: 10),
          DelayedAnimation(
            delay: 0, // 2250,
            child: TextField(
              maxLines: null,
              controller: motifController,
              decoration: InputDecoration(
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
                      ? "Wait..."
                      : (langUserPhone == "fr")
                          ? "SIGNALER"
                          : "REPORT",
                  style: GoogleFonts.poppins(
                    color: Colors.white,
                    fontWeight: FontWeight.w400,
                  ),
                ),
                onPressed: () {
                  _desactive
                      ? null
                      : signaleUser(telController.text, motifController.text);
                },
              ),
            ),
          ),
        ],
      ),
    );
  }
}
