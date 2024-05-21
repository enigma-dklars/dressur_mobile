// ignore_for_file: use_build_context_synchronously

import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/components/delayed_animation.dart';
import 'package:dressur/components/constant.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;
import 'package:dressur/components/sql_helper.dart';
import 'package:dressur/components/noti.dart';

class SuggestionsPage extends StatelessWidget {
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
          "Suggestions",
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
              Icons.lightbulb,
              size: 120,
              color: Colors.amber,
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
                      padding: const EdgeInsets.all(0),
                      child: Text(
                        (langUserPhone == "fr")
                            ? "Nous cherchons constamment à améliorer notre application pour vous. Votre opinion est précieuse ! Que vous ayez une idée, une suggestion de fonctionnalité ou des commentaires, faites-nous en part."
                            : "We are constantly looking to improve our app for you. Your opinion is valuable! Whether you have an idea, feature suggestion, or feedback, let us know.",
                        style: GoogleFonts.poppins(
                          fontSize: 16,
                        ),
                        textAlign: TextAlign.center,
                      ),
                    ),
                  ),
                  const SizedBox(height: 30),
                  SuggestionsForm(),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class SuggestionsForm extends StatefulWidget {
  @override
  State<SuggestionsForm> createState() => _SuggestionsFormState();
}

class _SuggestionsFormState extends State<SuggestionsForm> {
  bool _desactive = false;
  var data;
  final telController = TextEditingController();
  final motifController = TextEditingController();

  //HTTP REQUEST REGISTER
  void addSuggestion(String suggestion) async {
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
          'POST', Uri.parse('$generalRouteForApi/addSuggestion'));
      request.fields.addAll({
        'uid': uidUser,
        'langUserPhone': langUserPhone.toString(),
        'suggestion': suggestion
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
            Navigator.pop(context);
            ScaffoldMessenger.of(context).showSnackBar(SnackBar(
              backgroundColor: Colors.green,
              behavior: SnackBarBehavior.floating,
              content: Text(
                (langUserPhone == "fr")
                    ? 'Merci pour votre suggestion ! Nous apprécions votre contribution pour améliorer notre application.'
                    : 'Thanks for your suggestion! We appreciate your contribution to improve our app.',
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
          const SizedBox(height: 10),
          DelayedAnimation(
            delay: 0, // 1000,
            child: Text(
              (langUserPhone == "fr")
                  ? 'Votre ou vos suggestions ci-dessous'
                  : 'Your suggestion(s) below',
              style: GoogleFonts.poppins(
                fontSize: 16,
              ),
            ),
          ),
          const SizedBox(height: 10),
          DelayedAnimation(
            delay: 0, // 2250,
            child: TextField(
              maxLines: 100,
              minLines: 8,
              controller: motifController,
              decoration: const InputDecoration(
                border: OutlineInputBorder(),
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
                  backgroundColor: Colors.amber,
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
                          ? "SUGGÉRER"
                          : "SUGGEST",
                  style: GoogleFonts.poppins(
                    color: Colors.white,
                    fontWeight: FontWeight.w400,
                  ),
                ),
                onPressed: () {
                  _desactive ? null : addSuggestion(motifController.text);
                },
              ),
            ),
          ),
        ],
      ),
    );
  }
}
