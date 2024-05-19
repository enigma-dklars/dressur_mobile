// ignore_for_file: unnecessary_brace_in_string_interps

import 'package:dressur/8_admin/admin_campagne_mail.dart';
import 'package:dressur/8_admin/admin_liste_user.dart';
import 'package:dressur/8_admin/admin_num_whatsapp.dart';
import 'package:dressur/8_admin/admin_promo_affaire.dart';
import 'package:flutter/material.dart';
import 'package:flutter_contacts/flutter_contacts.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/components/constant.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;
import 'package:dressur/components/sql_helper.dart';
import 'package:dressur/components/noti.dart';

class AdministrationPage extends StatefulWidget {
  AdministrationPage({Key? key}) : super(key: key);
  @override
  State<AdministrationPage> createState() => _AdministrationPageState();
}

class _AdministrationPageState extends State<AdministrationPage> {
  bool _desactive = false;

  void importAllContacts() async {
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
          'POST', Uri.parse('$generalRouteForApi/getAllContactAdmin'));
      request.fields
          .addAll({'uid': uidUser, 'langUserPhone': langUserPhone.toString()});

      http.StreamedResponse response = await request.send();
      if (response.statusCode == 200) {
        var data1 = await response.stream.bytesToString();
        var data = convert.jsonDecode(data1);
        if (data["error"] == true) {
          dangerNoti(data["titre"], data["message"], context);
          setState(() {
            _desactive = false;
          });
        } else {
          var resultat = data['contactAddsAdmain'];
          var countContacts = 0;
          if (resultat.length >= 1) {
            // List<Contact> contacts =
            //     await FlutterContacts.getContacts(withProperties: true);
            // for (var contact in contacts) {
            //   for (var phone in contact.phones) {
            //     var numberTel =
            //         (phone.number).replaceAll(" ", "").replaceAll("-", "");
            //     if ((await SQLHelper.getOneNumsTelUser(numberTel)).isEmpty) {
            //       await insertNumTelUserIntoDataBase(numberTel);
            //     }
            //   }
            // }

            for (var contactAdd in resultat) {
              if ((await SQLHelper.getOneNumsTelUser(contactAdd["telAdd"]))
                  .isEmpty) {
                final newContact = Contact()
                  ..name.first = contactAdd["nomAdd"] + " #DS"
                  ..phones = [Phone(contactAdd["telAdd"])];
                await newContact.insert();
                await insertNumTelUserIntoDataBase(contactAdd["telAdd"]);
                countContacts++;
              }
            }

            setState(() {
              _desactive = false;
              ScaffoldMessenger.of(context).showSnackBar(SnackBar(
                behavior: SnackBarBehavior.floating,
                content: Text('${countContacts} Contact(s) Enregistré(s)'),
              ));
            });
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
    return Scaffold(
      appBar: AppBar(
        elevation: 0,
        backgroundColor: Colors.red,
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
          "Administration",
          style: GoogleFonts.poppins(
            color: Colors.white,
            fontWeight: FontWeight.w400,
          ),
        ),
      ),
      body: SingleChildScrollView(
        child: Container(
          padding: const EdgeInsets.fromLTRB(10, 0, 10, 5),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.stretch,
            children: [
              const SizedBox(height: 8),
              GestureDetector(
                child: ElevatedButton(
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.red,
                    shape: const StadiumBorder(),
                    padding: const EdgeInsets.symmetric(
                      vertical: 15,
                    ),
                  ),
                  child: Text(
                    _desactive ? "Patientez" : "Importer tous les contacts DS",
                    style: GoogleFonts.poppins(
                      color: Colors.white,
                      fontSize: 15,
                    ),
                  ),
                  onPressed: () {
                    _desactive ? null : importAllContacts();
                  },
                ),
              ),
              const SizedBox(height: 5),
              GestureDetector(
                child: ElevatedButton(
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.red,
                    shape: const StadiumBorder(),
                    padding: const EdgeInsets.symmetric(
                      vertical: 13,
                    ),
                  ),
                  child: Text(
                    "Liste des users DS",
                    style: GoogleFonts.poppins(
                      color: Colors.white,
                      fontSize: 15,
                    ),
                  ),
                  onPressed: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(builder: (context) => AdminListeUser()),
                    );
                  },
                ),
              ),
              const SizedBox(height: 5),
              GestureDetector(
                child: ElevatedButton(
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.red,
                    shape: const StadiumBorder(),
                    padding: const EdgeInsets.symmetric(
                      vertical: 13,
                    ),
                  ),
                  child: Text(
                    "Conf. Num. WhatsApp",
                    style: GoogleFonts.poppins(
                      color: Colors.white,
                      fontSize: 15,
                    ),
                  ),
                  onPressed: () async {
                    Navigator.push(
                      context,
                      MaterialPageRoute(
                          builder: (context) => AdminNumWhatsApp()),
                    );
                  },
                ),
              ),
              const SizedBox(height: 5),
              GestureDetector(
                child: ElevatedButton(
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.red,
                    shape: const StadiumBorder(),
                    padding: const EdgeInsets.symmetric(
                      vertical: 13,
                    ),
                  ),
                  child: Text(
                    "Conf. Promo. Affaire",
                    style: GoogleFonts.poppins(
                      color: Colors.white,
                      fontSize: 15,
                    ),
                  ),
                  onPressed: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(
                          builder: (context) => AdminPromotionListPage()),
                    );
                  },
                ),
              ),
              const SizedBox(height: 5),
              GestureDetector(
                child: ElevatedButton(
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.red,
                    shape: const StadiumBorder(),
                    padding: const EdgeInsets.symmetric(
                      vertical: 13,
                    ),
                  ),
                  child: Text(
                    "Conf. Camp. Mail",
                    style: GoogleFonts.poppins(
                      color: Colors.white,
                      fontSize: 15,
                    ),
                  ),
                  onPressed: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(
                          builder: (context) => AdminCampagneMailListePage()),
                    );
                  },
                ),
              ),
              const SizedBox(height: 5),
            ],
          ),
        ),
      ),
    );
  }
}
