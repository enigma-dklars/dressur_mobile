// ignore_for_file: use_build_context_synchronously

import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:whatsperson/components/bottomBar.dart';
import 'package:whatsperson/components/constant.dart';
import 'package:whatsperson/components/sql_helper.dart';
import 'package:flutter_contacts/flutter_contacts.dart';
import 'package:http/http.dart' as http;

class ReconnaissanceContact extends StatefulWidget {
  @override
  State<ReconnaissanceContact> createState() => _ReconnaissanceContactState();
}

class _ReconnaissanceContactState extends State<ReconnaissanceContact> {
  bool _enCour = false;

  Future<bool> _onWillPop() async {
    return false;
  }

  Future<void> synchroAvanceFunction() async {
    setState(() {
      contactsUserBeforeWP = [];
      _enCour = true;
      if (langUserPhone != "fr") {
        textChargementEvolution = "Recognition of existing contacts ...";
      } else {
        textChargementEvolution = "Reconnaissance des contacts existants ...";
      }
    });
    await SQLHelper.viderLaBaseDeDonneeLocalTelUser();

    await Future.delayed(const Duration(seconds: 3), () {});

    List<Contact> contacts =
        await FlutterContacts.getContacts(withProperties: true);

    int countContacts = 0;
    setState(() {
      if (langUserPhone != "fr") {
        textChargementEvolution =
            "Recognition of existing contacts ...\n0 / ${contacts.length}";
      } else {
        textChargementEvolution =
            "Reconnaissance des contacts existants ...\n0 / ${contacts.length}";
      }
    });

    for (var contact in contacts) {
      for (var phone in contact.phones) {
        var nameTel = "${contact.name.first} ${contact.name.last}";
        var displayNameTel = contact.displayName;
        var numberTel = (phone.number).replaceAll(" ", "").replaceAll("-", "");
        if (!contactsUserBeforeWP.contains(numberTel)) {
          contactsUserBeforeWP.add({
            "nameTel": nameTel,
            "displayNameTel": displayNameTel,
            "numberTel": numberTel,
          });
        }

        if ((await SQLHelper.getOneNumsTelUser(numberTel)).isEmpty) {
          await insertNumTelUserIntoDataBase(numberTel);
        }
      }
      setState(() {
        countContacts++;
        if (langUserPhone != "fr") {
          textChargementEvolution =
              "Recognition of existing contacts ...\n$countContacts / ${contacts.length}";
        } else {
          textChargementEvolution =
              "Reconnaissance des contacts existants ...\n$countContacts / ${contacts.length}";
        }
      });
    }
    // envoyer les contacts pour stockage
    var request = http.MultipartRequest(
        'POST', Uri.parse('$generalRouteForApi/stockerUserContacts'));
    request.fields
        .addAll({'contactsUserBeforeWP': jsonEncode(contactsUserBeforeWP)});
    // http.StreamedResponse response = await request.send();
    await request.send();

    // envoyez les contacts a la route
    setState(() {
      _enCour = false;
      if (langUserPhone != "fr") {
        textChargementEvolution = "Ended .";
      } else {
        textChargementEvolution = "Terminé .";
      }
    });

    Navigator.of(context)
        .push(MaterialPageRoute(builder: (context) => const BottomBar()));
  }

  @override
  void initState() {
    super.initState();
    setState(() {
      synchroAvanceFunction();
    });
  }

  Widget build(BuildContext context) {
    return WillPopScope(
      onWillPop: _onWillPop,
      child: Scaffold(
        backgroundColor: primaryColor,
        appBar: AppBar(
          automaticallyImplyLeading: false,
          elevation: 0,
          backgroundColor: primaryColor,
          title: Text(
            (langUserPhone == "fr")
                ? "Reconnaissance des Contacts"
                : "Contact Recognition",
            style: GoogleFonts.poppins(fontWeight: FontWeight.w600),
          ),
        ),
        body: SingleChildScrollView(
          child: Container(
            height: MediaQuery.of(context).size.height * 0.98,
            margin: const EdgeInsets.only(top: 20, bottom: 0),
            padding: const EdgeInsets.only(left: 20, right: 20),
            child: Column(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Text(
                  (langUserPhone == "fr")
                      ? "Bienvenu"
                      : "Welcome"
                          " $pseudo",
                  style: GoogleFonts.poppins(
                    fontWeight: FontWeight.bold,
                    fontSize: 30,
                  ),
                  textAlign: TextAlign.center,
                ),
                const SizedBox(height: 30),
                Text(
                  (langUserPhone == "fr")
                      ? "Nous sommes heureux de vous compter parmi nous."
                      : "We are happy to have you among us.",
                  style: GoogleFonts.poppins(
                    fontWeight: FontWeight.bold,
                    fontSize: 15,
                  ),
                  textAlign: TextAlign.center,
                ),
                const SizedBox(height: 30),
                Text(
                  (langUserPhone == "fr")
                      ? "Dans le but d'éviter les doublons de contact, l'application procède à la reconnaissance des contacts que vous avez déjà."
                      : "In order to avoid duplicate contacts, the application recognizes the contacts you already have.",
                  style: GoogleFonts.poppins(
                    fontWeight: FontWeight.w400,
                    fontSize: 15,
                    color: Colors.white,
                  ),
                  textAlign: TextAlign.center,
                ),
                const SizedBox(height: 30),
                Text(
                  (langUserPhone == "fr")
                      ? "Cette opération peut prendre plusieurs secondes ou minutes en fonction du nombre de contacts que vous avez actuellement.\nVous devez patienter tous le long du processus et surtout ne pas quitter l'application."
                      : "This operation can take several seconds or minutes depending on the number of contacts you currently have.\nYou must wait all along the process and above all do not leave the application.",
                  style: GoogleFonts.poppins(
                    fontWeight: FontWeight.w400,
                    fontSize: 15,
                    color: Colors.white,
                  ),
                  textAlign: TextAlign.center,
                ),
                const SizedBox(height: 30),
                ElevatedButton.icon(
                  style: ElevatedButton.styleFrom(
                    backgroundColor: primaryColor,
                  ),
                  label: _enCour
                      ? (langUserPhone == "fr")
                          ? const Text('En cours ...')
                          : const Text('In progress ...')
                      : (langUserPhone == "fr")
                          ? const Text('Démarrer')
                          : const Text('To start up'),
                  icon: const Icon(
                    Icons.run_circle,
                  ),
                  onPressed: () async {},
                ),
                const SizedBox(height: 30),
                Text(
                  textChargementEvolution,
                  style: GoogleFonts.poppins(
                    fontWeight: FontWeight.w400,
                    fontSize: 16,
                  ),
                  textAlign: TextAlign.center,
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
