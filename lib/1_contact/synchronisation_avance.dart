import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:permission_handler/permission_handler.dart';
import 'package:whatsperson/components/delayed_animation.dart';
import 'package:whatsperson/components/constant.dart';
import 'package:whatsperson/components/sql_helper.dart';
import 'package:whatsperson/components/noti.dart';
import 'package:http/http.dart' as http;
import 'package:flutter_contacts/flutter_contacts.dart';

class SynchroAvance extends StatelessWidget {
  const SynchroAvance({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return const Scaffold(
      backgroundColor: Colors.white,
      body: PageDepart(),
    );
  }
}

class PageDepart extends StatefulWidget {
  const PageDepart({Key? key}) : super(key: key);

  @override
  State<PageDepart> createState() => _PageDepartState();
}

class _PageDepartState extends State<PageDepart> {
  bool _enCour = false;

  Future<void> synchroAvanceFunction() async {
    setState(() {
      _enCour = true;
      if (langUserPhone != "fr") {
        textChargementEvolution = "Finding your WP Contacts.";
      } else {
        textChargementEvolution = "Recherche de vos Contacts WP.";
      }
    });

    final url =
        Uri.parse('$generalRouteForApi/listContactWP/$uidUser/$langUserPhone');
    final response = await http.get(url);
    if (response.statusCode == 200) {
      final jsonData = jsonDecode(response.body) as List<dynamic>;
      if (jsonData.isNotEmpty) {
        setState(() {
          _enCour = true;
          if (langUserPhone != "fr") {
            textChargementEvolution =
                "Removal of previous recognition of existing contacts ...";
          } else {
            textChargementEvolution =
                "Suppression de la précédente reconnaissance des contacts existants ...";
          }
        });

        await SQLHelper.viderLaBaseDeDonneeLocalTelUser();

        setState(() {
          if (langUserPhone != "fr") {
            textChargementEvolution = "Recognition of existing contacts ...";
          } else {
            textChargementEvolution =
                "Reconnaissance des contacts existants ...";
          }
        });

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
            var numberTel =
                (phone.number).replaceAll(" ", "").replaceAll("-", "");
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

        setState(() {
          countContacts == 0;
          if (langUserPhone != "fr") {
            textChargementEvolution = "Missing WP contact record ...";
          } else {
            textChargementEvolution =
                "Enregistrement des contacts WP manquant ...";
          }
        });

        int contactsWPExistant = 0;
        for (var contact in jsonData) {
          if ((await SQLHelper.getOneNumsTelUser(contact['tel'])).isEmpty) {
            final newContact = Contact()
              ..name.first = contact["pseudo"] + " #WP"
              ..phones = [Phone(contact["tel"])];
            await newContact.insert();
            await insertNumTelUserIntoDataBase(contact["tel"]);
          }
          setState(() {
            contactsWPExistant++;
            if (langUserPhone != "fr") {
              textChargementEvolution =
                  "Missing WP contact record ...\n$contactsWPExistant / ${jsonData.length}";
            } else {
              textChargementEvolution =
                  "Enregistrement des contacts WP manquant ...\n$contactsWPExistant / ${jsonData.length}";
            }
          });
        }

        setState(() {
          _enCour = false;
          if (langUserPhone != "fr") {
            textChargementEvolution = "Ended ...";
          } else {
            textChargementEvolution = "Terminé ...";
          }
        });
      } else {
        setState(() {
          _enCour = false;
          if (langUserPhone != "fr") {
            textChargementEvolution =
                "You don't have any WP contacts, so an advanced synchronization cannot be done.";
          } else {
            textChargementEvolution =
                "Vous n'avez aucun contact WP, une synchronisation avancée ne peut donc pas se faire.";
          }
        });
      }
    }
  }

  Future<void> _askPermissions([String? routeName]) async {
    PermissionStatus permissionStatus = await _getContactPermission();
    if (permissionStatus == PermissionStatus.granted) {
      insertWhatsPersonContact();
    } else {
      _handleInvalidPermissions(permissionStatus);
    }
  }

  Future<PermissionStatus> _getContactPermission() async {
    PermissionStatus permission = await Permission.contacts.status;
    // permission != PermissionStatus.granted && permission != PermissionStatus.permanentlyDenied
    if (permission != PermissionStatus.granted) {
      PermissionStatus permissionStatus = await Permission.contacts.request();
      return permissionStatus;
    } else {
      return permission;
    }
  }

  void _handleInvalidPermissions(PermissionStatus permissionStatus) {
    if (permissionStatus != PermissionStatus.granted) {
      if (langUserPhone != "fr") {
        warningNoti(
            "Attention !",
            "Please allow WhatsPerson to automatically save contacts to your phone.\nThis authorization is necessary to take full advantage of our features.",
            context);
      } else {
        warningNoti(
            "Attention !",
            "Veuillez autoriser WhatsPerson a enregistrer automatiquement les contacts dans votre téléphone.\nCette autorisation est nécéssaire pour profiter pleinement de nos fonctionnalités.",
            context);
      }
    }
  }

  @override
  void initState() {
    super.initState();
    _askPermissions();
    setState(() {
      textChargementEvolution = "";
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        elevation: 0,
        backgroundColor: primaryColor,
        title: Text(
          (langUserPhone == "fr")
              ? "Synchronisation avancé"
              : "Advanced synchronization",
          style: GoogleFonts.poppins(
            fontWeight: FontWeight.w600,
          ),
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
            DelayedAnimation(
              delay: 800,
              child: Text(
                (langUserPhone == "fr")
                    ? "Synchronisation avancé"
                    : "Advanced synchronization",
                style: GoogleFonts.poppins(
                  fontWeight: FontWeight.bold,
                  fontSize: 25,
                ),
                textAlign: TextAlign.center,
              ),
            ),
            const SizedBox(height: 30),
            DelayedAnimation(
              delay: 800,
              child: Text(
                (langUserPhone == "fr")
                    ? "Cette opération peut prendre plusieurs secondes ou minutes en fonction du nombre de contacts que vous avez actuellement.\nVous devez patienter tous le long du processus et surtout ne pas quitter l'application.\nCliquez sur Démarrer pour lancer l'opération."
                    : "This operation can take several seconds or minutes depending on the number of contacts you currently have.\nYou must wait all along the process and above all do not quit the application.\nClick on Start to launch the operation.",
                style: GoogleFonts.poppins(
                  fontWeight: FontWeight.w400,
                  fontSize: 15,
                  color: Colors.red,
                ),
                textAlign: TextAlign.center,
              ),
            ),
            const SizedBox(height: 30),
            DelayedAnimation(
              delay: 1800,
              child: ElevatedButton.icon(
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
                onPressed: () async {
                  _enCour ? '' : await synchroAvanceFunction();
                },
              ),
            ),
            const SizedBox(height: 30),
            DelayedAnimation(
              delay: 1800,
              child: Text(
                textChargementEvolution,
                style: GoogleFonts.poppins(
                  fontWeight: FontWeight.w400,
                  fontSize: 16,
                ),
                textAlign: TextAlign.center,
              ),
            ),
          ],
        ),
      )),
    );
  }
}
