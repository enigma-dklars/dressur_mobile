// ignore_for_file: use_build_context_synchronously

import 'dart:io';

import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:flutter_contacts/flutter_contacts.dart';
import 'package:dressur/5_autre/admin.dart';
import 'package:dressur/5_autre/a_propos_wp.dart';
import 'package:dressur/5_autre/liste_bonus_recu.dart';
import 'package:dressur/5_autre/delete_compte_user.dart';
import 'package:dressur/5_autre/invitez_vos_amis.dart';
import 'package:dressur/5_autre/modifier_mot_de_passe.dart';
import 'package:dressur/5_autre/profil_user.dart';
import 'package:dressur/5_autre/signaler_user.dart';
import 'package:dressur/6_notification/liste_notification.dart';
import 'package:dressur/7_login/connexion.dart';
import 'package:dressur/components/profile_menu.dart';
import 'package:dressur/5_autre/support_assistance.dart';
import 'package:art_sweetalert/art_sweetalert.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/sql_helper.dart';
import 'package:google_fonts/google_fonts.dart';

class SettingPage extends StatefulWidget {
  SettingPage({Key? key}) : super(key: key);

  @override
  State<SettingPage> createState() => _SettingPageState();
}

class _SettingPageState extends State<SettingPage> {
  var data;

  Future<bool> _onWillPop() async {
    return (await showDialog(
          context: context,
          builder: (context) => AlertDialog(
            title: (langUserPhone == "fr")
                ? const Text('Êtes-vous sûr?')
                : const Text('Are you sure?'),
            content: (langUserPhone == "fr")
                ? const Text("Voulez-vous quitter l'application ?")
                : const Text("Do you want to quit the application?"),
            actions: <Widget>[
              TextButton(
                onPressed: () =>
                    Navigator.of(context).pop(false), //<-- SEE HERE
                child: (langUserPhone == "fr")
                    ? const Text('Non')
                    : const Text('No'),
              ),
              TextButton(
                onPressed: () {
                  if (Platform.isAndroid) {
                    SystemNavigator.pop();
                  } else if (Platform.isIOS) {
                    exit(0);
                  }
                }, // <-- SEE HERE
                child: (langUserPhone == "fr")
                    ? const Text('Oui')
                    : const Text('Yes'),
              ),
            ],
          ),
        )) ??
        false;
  }

  @override
  Widget build(BuildContext context) {
    return WillPopScope(
      onWillPop: _onWillPop,
      child: Scaffold(
        appBar: AppBar(
          automaticallyImplyLeading: false,
          elevation: 0,
          backgroundColor: primaryColor,
          title: Text(
            (langUserPhone == "fr") ? "Autres Pages" : "Other Pages",
            style: GoogleFonts.poppins(
              fontWeight: FontWeight.w600,
            ),
          ),
          actions: [
            IconButton(
              icon: const Icon(Icons.notifications),
              onPressed: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(
                    builder: (context) => ListeNotification(),
                  ),
                );
              },
            ),
          ],
        ),
        body: SingleChildScrollView(
          child: Column(
            children: [
              const SizedBox(height: 5),
              admin
                  ? ProfileMenu(
                      text: "Administration",
                      Myicon: const Icon(Icons.stop),
                      press: () {
                        Navigator.push(
                          context,
                          MaterialPageRoute(
                              builder: (context) => AdministrationPage()),
                        );
                      },
                    )
                  : const SizedBox(height: 0),
              ProfileMenu(
                text: (langUserPhone == "fr") ? "À Propos" : "About Us",
                Myicon: const Icon(Icons.bookmark),
                press: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) => AproposPage()),
                  );
                },
              ),
              ProfileMenu(
                text: (langUserPhone == "fr")
                    ? "Support, Assistance Technique"
                    : "Support, Technical Assistance",
                Myicon: const Icon(Icons.headset_mic),
                press: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) => SupportPage()),
                  );
                },
              ),
              ProfileMenu(
                text: (langUserPhone == "fr") ? "Profil" : "Profile",
                Myicon: const Icon(Icons.person),
                press: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) => ProfilPage()),
                  );
                },
              ),
              ProfileMenu(
                text: (langUserPhone == "fr")
                    ? "Invitez vos amis (Parrainage & Promo)"
                    : "Invite your friends (Sponsorship & Promo)",
                Myicon: const Icon(Icons.group_add),
                press: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) => AddFriendPage()),
                  );
                },
              ),
              ProfileMenu(
                text: (langUserPhone == "fr")
                    ? "Liste des Bonus Reçu"
                    : "List of Bonuses Received",
                Myicon: const Icon(Icons.list),
                press: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) => ListeBonusPage()),
                  );
                },
              ),
              ProfileMenu(
                text: (langUserPhone == "fr")
                    ? "Modifier le mot de passe"
                    : "Change the password",
                Myicon: const Icon(Icons.password_outlined),
                press: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) => ModifierMdpPage()),
                  );
                },
              ),
              ProfileMenu(
                text: (langUserPhone == "fr")
                    ? "Signaler un utilisateur"
                    : "Report a user",
                Myicon: const Icon(Icons.warning),
                press: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) => SignalerPage()),
                  );
                },
              ),
              ProfileMenu(
                text: (langUserPhone == "fr")
                    ? "Supprimer tous vos contacts DS"
                    : "Delete all your DS contacts",
                Myicon: const Icon(Icons.contacts),
                press: () async {
                  ArtDialogResponse response = await ArtSweetAlert.show(
                    barrierDismissible: false,
                    context: context,
                    artDialogArgs: ArtDialogArgs(
                        title: (langUserPhone == "fr")
                            ? "Cette action est irréversible"
                            : "This action is irreversible",
                        text: (langUserPhone == "fr")
                            ? "Voulez vous vraiment supprimer tous vos contacts DS ?"
                            : "Are you sure you want to delete all your DS contacts?",
                        confirmButtonText:
                            (langUserPhone == "fr") ? "Oui" : "Yes",
                        denyButtonText: (langUserPhone == "fr") ? "Non" : "No",
                        type: ArtSweetAlertType.warning),
                  );

                  if (response.isTapConfirmButton) {
                    if (contactsEnregistrer.isNotEmpty) {
                      ScaffoldMessenger.of(context).showSnackBar(SnackBar(
                        content: Text(
                          (langUserPhone == "fr")
                              ? "Dressur vas parcourir vos contacts un a un et supprimer les contacts DS.\n\nPatientez tous le long du processus.\n\nCe processus peut durée plusieurs minutes."
                              : "Dressur will go through your contacts one by one and delete DS contacts.\n\nWait all the way through the process.\n\nThis process may take several minutes.",
                        ),
                        duration: const Duration(minutes: 1),
                      ));
                      List<Contact> contacts =
                          await FlutterContacts.getContacts(
                              withProperties: true);
                      var nombreContact = contacts.length;
                      for (var contact in contacts) {
                        for (var phone in contact.phones) {
                          var numberTel = (phone.number)
                              .replaceAll(" ", "")
                              .replaceAll("-", "");
                          if (contactsEnregistrer.contains(numberTel)) {
                            await contact.delete();
                          }
                        }
                        nombreContact--;
                        ScaffoldMessenger.of(context).showSnackBar(SnackBar(
                          content: Text((langUserPhone == "fr")
                              ? "$nombreContact contact(s) restant à parcourir."
                              : "$nombreContact contact(s) remaining to be scanned."),
                        ));
                      }
                      ScaffoldMessenger.of(context).showSnackBar(SnackBar(
                        content: Text(
                          (langUserPhone == "fr")
                              ? "${contactsEnregistrer.length} contact(s) DS supprimer."
                              : "${contactsEnregistrer.length} DS contact(s) delete.",
                        ),
                      ));
                    } else {
                      ScaffoldMessenger.of(context).showSnackBar(SnackBar(
                        content: Text(
                          (langUserPhone == "fr")
                              ? "Vous n'avez aucun contact DS actuellement. Faite un boost pour en avoir."
                              : "You don't currently have any DS Contacts. Boost to get some.",
                        ),
                      ));
                    }
                  }
                },
              ),
              ProfileMenu(
                text: (langUserPhone == "fr")
                    ? "Supprimer mon compte"
                    : "Delete my account",
                Myicon: const Icon(Icons.delete_forever),
                press: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) => DeletecomptePage()),
                  );
                },
              ),
              ProfileMenu(
                text: (langUserPhone == "fr") ? "Se déconnecter" : "Sign out",
                Myicon: const Icon(Icons.offline_bolt),
                press: () async {
                  ArtDialogResponse response = await ArtSweetAlert.show(
                      barrierDismissible: false,
                      context: context,
                      artDialogArgs: ArtDialogArgs(
                          title: (langUserPhone == "fr")
                              ? "Déconnexion ?"
                              : "Disconnect?",
                          text: (langUserPhone == "fr")
                              ? "Voulez vous vraiment vous déconnecter ?"
                              : "Do you really want to disconnect?",
                          confirmButtonText:
                              (langUserPhone == "fr") ? "Oui" : "Yes",
                          denyButtonText:
                              (langUserPhone == "fr") ? "Non" : "No",
                          type: ArtSweetAlertType.warning));

                  if (response.isTapConfirmButton) {
                    SQLHelper.viderLaBaseDeDonneeLocal();
                    Navigator.pushReplacement(
                      context,
                      MaterialPageRoute(builder: (context) => LoginPage()),
                    );
                  }
                },
              ),
              const SizedBox(height: 5),
            ],
          ),
        ),
      ),
    );
  }
}
