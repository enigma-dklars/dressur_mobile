// ignore_for_file: use_build_context_synchronously

import 'dart:io';
import 'package:dressur/4_preference/choix_centre_interet_loisir.dart';
import 'package:dressur/components/padding_and_divider.dart';
import 'package:dressur/components/pub_smt_2024.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/4_preference/choix_pays.dart';
import 'package:dressur/1_reception/liste_notification.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/sociaux.dart';
import 'package:dressur/5_autre/support_assistance.dart';
import 'dart:async';

class PreferencePage extends StatefulWidget {
  PreferencePage({Key? key}) : super(key: key);

  @override
  State<PreferencePage> createState() => _PreferencePageState();
}

class _PreferencePageState extends State<PreferencePage> {
  var data;
  Timer? _timer;

  @override
  void dispose() {
    // Arrête le timer lors de la suppression du widget
    _stopTimer();
    super.dispose();
  }

  void _startTimer() {
    // Crée un nouveau timer qui exécute la fonction everySecond toutes les secondes
    _timer = Timer.periodic(const Duration(seconds: 1), (timer) {
      everySecond();
    });
  }

  void _stopTimer() {
    // Arrête et annule le timer
    _timer?.cancel();
    _timer = null;
  }

  void everySecond() {
    // Code à exécuter toutes les secondes
    setState(() {
      preferencePaysText = preferencePaysText;
    });
  }

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
    // Démarre le timer lors de l'initialisation du widget
    _startTimer();
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
            (langUserPhone == "fr") ? "Préférences" : "Preferences",
            style: GoogleFonts.poppins(
              color: Colors.white,
              fontWeight: FontWeight.w400,
            ),
          ),
          actions: [
            IconButton(
              icon: const Icon(
                Icons.notifications,
                color: Colors.white,
              ),
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
            PopupMenuButton<int>(
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
          child: Container(
            child: Column(
              children: [
                const SizedBox(height: 5),
                Card(
                  margin: const EdgeInsets.only(
                      left: 10, top: 5, right: 10, bottom: 5),
                  child: Container(
                    padding: const EdgeInsets.fromLTRB(10, 5, 10, 2),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.stretch,
                      children: [
                        Text(
                          (langUserPhone == "fr") ? "Pays" : "Country",
                          style: GoogleFonts.poppins(
                            fontWeight: FontWeight.w400,
                            color: primaryColor,
                            fontSize: 22,
                          ),
                          textAlign: TextAlign.left,
                        ),
                        const SizedBox(height: 3),
                        Text(
                          (langUserPhone == "fr")
                              ? "NB : Sélectionnez parmi les pays disponibles. Ces pays sélectionnés seront ceux à partir desquels vous recevrez des propositions de contacts et d'actualités, ainsi que vers lesquels seront orientées vos promotions commerciales et vos boosts contacts."
                              : "NB : Select from the available countries. These selected countries will be those from which you will receive contact and news proposals, as well as towards which your commercial promotions and contact boosts will be directed.",
                          style: GoogleFonts.poppins(
                            fontSize: 10,
                            fontWeight: FontWeight.w500,
                          ),
                          textAlign: TextAlign.left,
                        ),
                        const SizedBox(height: 5),
                        Text(
                          (langUserPhone == "fr")
                              ? "Vous avez choisi le(s) pays suivant :"
                              : "You have chosen the following country(ies) :",
                          style: GoogleFonts.poppins(
                            fontWeight: FontWeight.w500,
                            color: primaryColor,
                            fontSize: 14,
                          ),
                          textAlign: TextAlign.left,
                        ),
                        const SizedBox(height: 5),
                        Text(
                          (preferencePaysText.toString() != "")
                              ? preferencePaysText.toString()
                              : (langUserPhone == 'fr')
                                  ? 'Aucun Pays Choisi'
                                  : 'No Country Chosen',
                          style: GoogleFonts.poppins(
                            fontSize: 16,
                            fontWeight: FontWeight.w400,
                          ),
                          textAlign: TextAlign.left,
                          maxLines: 3,
                          overflow: TextOverflow.ellipsis,
                        ),
                        Row(
                          mainAxisAlignment: MainAxisAlignment.end,
                          children: [
                            SizedBox(
                              width: MediaQuery.of(context).size.width * 0.35,
                              child: ElevatedButton(
                                style: ElevatedButton.styleFrom(
                                  backgroundColor: primaryColor,
                                  shape: const StadiumBorder(),
                                  padding: const EdgeInsets.symmetric(
                                    vertical: 10,
                                  ),
                                ),
                                onPressed: () {
                                  Navigator.push(
                                    context,
                                    MaterialPageRoute(
                                        builder: (context) => ChoixDesPays()),
                                  );
                                },
                                child: Text(
                                  (langUserPhone == "fr") ? 'Modifier' : 'Edit',
                                  style: GoogleFonts.poppins(
                                    color: Colors.white,
                                  ),
                                ),
                              ),
                            )
                          ],
                        ),
                        const SizedBox(height: 3),
                      ],
                    ),
                  ),
                ),
                DressurDivider(),
                Card(
                  margin: const EdgeInsets.only(
                      left: 10, top: 5, right: 10, bottom: 5),
                  child: Container(
                    padding: const EdgeInsets.fromLTRB(10, 5, 10, 2),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.stretch,
                      children: [
                        Text(
                          (langUserPhone == "fr")
                              ? "Centres d'intérêt, Loisirs, etc."
                              : "Center of interest, Leisure, etc.",
                          style: GoogleFonts.poppins(
                            fontWeight: FontWeight.w400,
                            color: primaryColor,
                            fontSize: 22,
                          ),
                          textAlign: TextAlign.left,
                        ),
                        const SizedBox(height: 3),
                        Text(
                          (langUserPhone == "fr")
                              ? "NB : Choisissez parmi les options disponibles. Les centres d'intérêt que vous sélectionnerez seront utilisés pour vous proposer des services, des opportunités, des recommandations personnalisées, etc."
                              : "NB: Choose from the available options. The interests you select will be used to offer you services, opportunities, personalized recommendations, etc.",
                          style: GoogleFonts.poppins(
                            fontSize: 10,
                            fontWeight: FontWeight.w500,
                          ),
                          textAlign: TextAlign.left,
                        ),
                        const SizedBox(height: 5),
                        Text(
                          (langUserPhone == "fr")
                              ? "Vos choix sont les suivants :"
                              : "Your choices are :",
                          style: GoogleFonts.poppins(
                            fontWeight: FontWeight.w500,
                            color: primaryColor,
                            fontSize: 14,
                          ),
                          textAlign: TextAlign.left,
                        ),
                        const SizedBox(height: 5),
                        Text(
                          (preferencePaysText.toString() != "")
                              ? preferenceCentreInteretLoisirText.toString()
                              : (langUserPhone == 'fr')
                                  ? 'Aucun Pays Choisi'
                                  : 'No Country Chosen',
                          style: GoogleFonts.poppins(
                            fontSize: 16,
                            fontWeight: FontWeight.w400,
                          ),
                          textAlign: TextAlign.left,
                          maxLines: 3,
                          overflow: TextOverflow.ellipsis,
                        ),
                        Row(
                          mainAxisAlignment: MainAxisAlignment.end,
                          children: [
                            SizedBox(
                              width: MediaQuery.of(context).size.width * 0.35,
                              child: ElevatedButton(
                                style: ElevatedButton.styleFrom(
                                  backgroundColor: primaryColor,
                                  shape: const StadiumBorder(),
                                  padding: const EdgeInsets.symmetric(
                                    vertical: 10,
                                  ),
                                ),
                                onPressed: () {
                                  Navigator.push(
                                    context,
                                    MaterialPageRoute(
                                        builder: (context) =>
                                            ChoixDesCentreInteretLoisir()),
                                  );
                                },
                                child: Text(
                                  (langUserPhone == "fr") ? 'Modifier' : 'Edit',
                                  style: GoogleFonts.poppins(
                                    color: Colors.white,
                                  ),
                                ),
                              ),
                            )
                          ],
                        ),
                        const SizedBox(height: 3),
                      ],
                    ),
                  ),
                ),
                DressurDivider(),
                SpecialPub(),
                DressurDivider(),
                const SizedBox(height: 5),
                SociauxPage(),
                const SizedBox(height: 5),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
