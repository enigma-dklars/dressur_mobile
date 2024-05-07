import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:permission_handler/permission_handler.dart';
import 'package:dressur/components/delayed_animation.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/sql_helper.dart';
import 'package:dressur/components/noti.dart';
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
        textChargementEvolution = "Finding your DS Contacts.";
      } else {
        textChargementEvolution = "Recherche de vos Contacts DS.";
      }
    });

    final url =
        Uri.parse('$generalRouteForApi/listContactDS/$uidUser/$langUserPhone');
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
            textChargementEvolution = "Missing DS contact record ...";
          } else {
            textChargementEvolution =
                "Enregistrement des contacts DS manquant ...";
          }
        });

        int contactsDSExistant = 0;
        for (var contact in jsonData) {
          if ((await SQLHelper.getOneNumsTelUser(contact['tel'])).isEmpty) {
            final newContact = Contact()
              ..name.first = contact["pseudo"] + " #DS"
              ..phones = [Phone(contact["tel"])];
            await newContact.insert();
            await insertNumTelUserIntoDataBase(contact["tel"]);
          }
          setState(() {
            contactsDSExistant++;
            if (langUserPhone != "fr") {
              textChargementEvolution =
                  "Missing DS contact record ...\n$contactsDSExistant / ${jsonData.length}";
            } else {
              textChargementEvolution =
                  "Enregistrement des contacts DS manquant ...\n$contactsDSExistant / ${jsonData.length}";
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
                "You don't have any DS contacts, so an advanced synchronization cannot be done.";
          } else {
            textChargementEvolution =
                "Vous n'avez aucun contact DS, une synchronisation avancée ne peut donc pas se faire.";
          }
        });
      }
    }
  }

  Future<void> _askPermissions([String? routeName]) async {
    PermissionStatus permissionStatus = await _getContactPermission();
    if (permissionStatus == PermissionStatus.granted) {
      insertDressurContact();
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
            "Please allow Dressur to automatically save contacts to your phone.\nThis authorization is necessary to take full advantage of our features.",
            context);
      } else {
        warningNoti(
            "Attention !",
            "Veuillez autoriser Dressur a enregistrer automatiquement les contacts dans votre téléphone.\nCette autorisation est nécéssaire pour profiter pleinement de nos fonctionnalités.",
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
            color: Colors.white,
            fontWeight: FontWeight.w400,
          ),
        ),
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
      ),
      body: Align(
        alignment: Alignment.topCenter,
        child: SizedBox(
          width: MediaQuery.of(context).size.width * 0.80,
          child: ConstrainedBox(
            constraints: const BoxConstraints(
              maxWidth: 1024,
            ),
            child: LayoutBuilder(
              builder: (context, constraints) {
                return Column(
                  mainAxisAlignment: MainAxisAlignment.center,
                  crossAxisAlignment: CrossAxisAlignment.center,
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
                    SizedBox(
                      width: MediaQuery.of(context).size.width * 0.90,
                      child: DelayedAnimation(
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
                    ),
                    const SizedBox(height: 30),
                    DelayedAnimation(
                      delay: 1800,
                      child: ElevatedButton.icon(
                        style: ElevatedButton.styleFrom(
                          backgroundColor: primaryColor,
                        ),
                        label: _enCour
                            ? Text(
                                (langUserPhone == "fr")
                                    ? 'En cours ...'
                                    : 'In progress ...',
                                style: GoogleFonts.poppins(
                                  color: Colors.white,
                                ),
                              )
                            : Text(
                                (langUserPhone == "fr")
                                    ? 'Démarrer'
                                    : 'To start up',
                                style: GoogleFonts.poppins(
                                  color: Colors.white,
                                ),
                              ),
                        icon: const Icon(
                          Icons.run_circle,
                          color: Colors.white,
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
                );
              },
            ),
          ),
        ),
      ),
    );
  }
}
