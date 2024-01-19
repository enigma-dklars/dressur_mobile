import 'dart:io';
import 'dart:async';
import 'package:dressur/1_contact/liste_contact.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/2_boost/liste_boost_affaire.dart';
import 'package:dressur/2_boost/liste_boost_contact.dart';
import 'package:dressur/2_boost/new_boost_contact.dart';
import 'package:dressur/2_boost/new_boost_affaire.dart';
import 'package:dressur/5_autre/support_assistance.dart';
import 'package:dressur/6_notification/liste_notification.dart';
import 'package:dressur/components/advertisements.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/sociaux.dart';

class ReceptionPage extends StatefulWidget {
  @override
  State<ReceptionPage> createState() => _ReceptionPageState();
}

class _ReceptionPageState extends State<ReceptionPage> {
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
  void initState() {
    super.initState();
  }

  Widget build(BuildContext context) {
    return WillPopScope(
      onWillPop: _onWillPop,
      child: Scaffold(
        appBar: AppBar(
          automaticallyImplyLeading: false,
          elevation: 0,
          backgroundColor: primaryColor,
          title: Text(
            (langUserPhone == "fr") ? "Boîte de Réception" : "Inbox",
            style: GoogleFonts.poppins(fontWeight: FontWeight.w600),
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
            const Padding(
              padding: EdgeInsets.fromLTRB(0, 10, 0, 10),
              child: VerticalDivider(
                width: 0,
                color: Colors.white,
                thickness: 1,
              ),
            ),
            PopupMenuButton<dynamic>(
              itemBuilder: (context) => [
                PopupMenuItem(
                  value: 1,
                  child: Row(
                    children: [
                      Text(
                        (langUserPhone == "fr") ? "Aide" : "Help",
                        style: GoogleFonts.poppins(
                          color: Colors.white,
                          fontWeight: FontWeight.w600,
                        ),
                      ),
                    ],
                  ),
                ),
              ],
              offset: const Offset(0, 60),
              color: primaryColor,
              icon: const Icon(
                Icons.menu,
                color: Colors.white,
              ),
              elevation: 2,
              onSelected: (value) {
                if (value == 1) {
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
              GestureDetector(
                onTap: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(
                      builder: (context) => ContactPage(),
                    ),
                  );
                },
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    // Première colonne avec une icône centrée dans un cercle vert
                    Container(
                      padding: const EdgeInsets.all(10.0),
                      margin: const EdgeInsets.all(10.0),
                      decoration: const BoxDecoration(
                        shape: BoxShape.circle,
                        color: Colors.green,
                      ),
                      child: const Icon(
                        Icons.contacts,
                        color: Colors.white,
                        size: 20,
                      ),
                    ),
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: [
                          Text(
                            (langUserPhone == "fr")
                                ? "Nouveaux Contacts Dressur"
                                : "New Contacts Dressur",
                            style: const TextStyle(fontSize: 20),
                          ),
                          const SizedBox(height: 5),
                          Text(
                            (langUserPhone == "fr")
                                ? "Contacts ajouter et scanner"
                                : "Contacts add and scan",
                            style: const TextStyle(fontSize: 12),
                            maxLines: 1,
                            overflow: TextOverflow.ellipsis,
                          ),
                        ],
                      ),
                    ),

                    Container(
                      padding: const EdgeInsets.all(5),
                      margin: const EdgeInsets.all(5),
                      child: const Icon(
                        Icons.chevron_right,
                        size: 20,
                      ),
                    ),
                  ],
                ),
              ),
              const Padding(
                padding:
                    EdgeInsets.only(left: 40, top: 0, right: 40, bottom: 0),
                child: Divider(
                  height: 1,
                  thickness: 2,
                  color: Colors.green,
                ),
              ),
              GestureDetector(
                onTap: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(
                      builder: (context) => ContactPage(),
                    ),
                  );
                },
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    Container(
                      padding: const EdgeInsets.all(0),
                      margin: const EdgeInsets.all(10),
                      child: CircleAvatar(
                        radius:
                            20, // Définissez le rayon du cercle selon votre besoin
                        backgroundColor: Colors.white,
                        child: Image.asset(
                          "images/dressur_logo_centrer_sans_fond.png",
                          width: 90, // Définissez la largeur de l'image
                          height: 90, // Définissez la hauteur de l'image
                          fit: BoxFit
                              .cover, // Ajustez le comportement de l'ajustement d'image si nécessaire
                        ),
                      ),
                    ),
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: [
                          const Text(
                            "Dressur Notifications",
                            style: TextStyle(fontSize: 20),
                          ),
                          const SizedBox(height: 5),
                          Text(
                            (langUserPhone == "fr")
                                ? "Cadeaux, Astuces, Recommandations, Informations, Avertissements, "
                                : "Gifts, Tips, Recommendations, Information, Warnings, ",
                            style: const TextStyle(fontSize: 12),
                            maxLines: 1,
                            overflow: TextOverflow.ellipsis,
                          ),
                        ],
                      ),
                    ),
                    Container(
                      padding: const EdgeInsets.all(5),
                      margin: const EdgeInsets.all(5),
                      child: const Icon(
                        Icons.chevron_right,
                        size: 20,
                      ),
                    ),
                  ],
                ),
              ),
              const Padding(
                padding:
                    EdgeInsets.only(left: 40, top: 0, right: 40, bottom: 0),
                child: Divider(
                  height: 1,
                  thickness: 2,
                  color: primaryColor,
                ),
              ),
              const SizedBox(height: 5),
              const SizedBox(height: 5),
            ],
          ),
        ),
      ),
    );
  }
}
