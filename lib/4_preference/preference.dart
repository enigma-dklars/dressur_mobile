// ignore_for_file: use_build_context_synchronously

import 'dart:io';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:whatsperson/4_preference/choix_pays_preference.dart';
import 'package:whatsperson/6_notification/liste_notification.dart';
import 'package:whatsperson/components/advertisements.dart';
import 'package:whatsperson/components/constant.dart';
import 'package:http/http.dart' as http;
import 'package:whatsperson/components/sociaux.dart';
import 'dart:convert' as convert;
import 'package:whatsperson/components/sql_helper.dart';
import 'package:whatsperson/components/noti.dart';
import 'package:whatsperson/5_autre/support_assistance.dart';
import 'dart:async';

class PreferencePage extends StatefulWidget {
  PreferencePage({Key? key}) : super(key: key);

  @override
  State<PreferencePage> createState() => _PreferencePageState();
}

class _PreferencePageState extends State<PreferencePage> {
  var data;
  bool _loading = false;
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

  void updateUserPreferenceNom(String valNom) async {
    dynamic youHaveNetWork = "";
    youHaveConnexion();
    youHaveNetWork = await SQLHelper.getYouHaveConnexion();
    while (youHaveNetWork.length == 0) {
      youHaveNetWork = await SQLHelper.getYouHaveConnexion();
    }
    if (youHaveNetWork[0]['youHaveConnexion'] == "oui") {
      var request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/updateUserPreferenceNom'));
      request.fields.addAll({
        'uid': uidUser,
        'langUserPhone': langUserPhone.toString(),
        'valNom': valNom
      });

      http.StreamedResponse response = await request.send();

      if (response.statusCode == 200) {
        var data1 = await response.stream.bytesToString();
        data = convert.jsonDecode(data1);
        if (data["error"] == true) {
          dangerNoti(data["titre"], data["message"], context);
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
      }
    } else {
      if (langUserPhone != "fr") {
        dangerNoti(
            "Mistake!", "You are not connected to the internet.", context);
      } else {
        dangerNoti("Erreur!", "Vous n'ètes pas connecté a internet.", context);
      }
      setState(() {
        _loading = false;
      });
    }
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
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(5),
                      gradient: const LinearGradient(
                        begin: Alignment.topCenter,
                        end: Alignment.bottomCenter,
                        colors: [
                          primaryColor,
                          secondaryColor,
                          Colors.white,
                        ],
                      ),
                    ),
                    padding: const EdgeInsets.fromLTRB(15, 10, 15, 10),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.stretch,
                      children: [
                        Text(
                          (langUserPhone == "fr")
                              ? "Souhaitez-vous que votre nom et prénom(s) soit visible des autres utilisateurs ?"
                              : "Would you like your first and last name(s) to be visible to other users?",
                          style: GoogleFonts.poppins(
                            fontSize: 16,
                            color: Colors.white,
                            fontWeight: FontWeight.w600,
                          ),
                          textAlign: TextAlign.left,
                        ),
                        const SizedBox(height: 5),
                        Row(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: [
                            Text(
                              (langUserPhone == "fr") ? 'Non' : 'No',
                              style: GoogleFonts.poppins(
                                fontSize: 20,
                                fontWeight: FontWeight.w800,
                                color: Colors.black,
                              ),
                              textAlign: TextAlign.center,
                            ),
                            _loading
                                ? const Icon(
                                    Icons.pause,
                                    size: 48.0,
                                    color: primaryColor,
                                  )
                                : Switch(
                                    activeColor: Colors.red,
                                    activeTrackColor: primaryColor,
                                    inactiveThumbColor: Colors.black,
                                    inactiveTrackColor: primaryColor,
                                    value: affUserName,
                                    onChanged: (bool? newValue) {
                                      setState(() {
                                        _loading = false;
                                        // affUserName = newValue!;
                                        if (newValue == true) {
                                          affUserName = true;
                                          updateUserPreferenceNom("true");
                                        } else {
                                          affUserName = false;
                                          updateUserPreferenceNom("false");
                                        }
                                      });
                                    }),
                            Text(
                              (langUserPhone == "fr") ? 'Oui' : 'Yes',
                              style: GoogleFonts.poppins(
                                fontSize: 20,
                                fontWeight: FontWeight.w800,
                                color: Colors.red,
                              ),
                              textAlign: TextAlign.center,
                            ),
                          ],
                        ),
                      ],
                    ),
                  ),
                ),
                const Padding(
                  padding:
                      EdgeInsets.only(left: 50, top: 5, right: 50, bottom: 5),
                  child: Divider(
                    height: 1,
                    thickness: 1,
                    color: Colors.grey,
                  ),
                ),
                Card(
                  margin: const EdgeInsets.only(
                      left: 10, top: 5, right: 10, bottom: 5),
                  child: Container(
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(5),
                      gradient: const LinearGradient(
                        begin: Alignment.topCenter,
                        end: Alignment.bottomCenter,
                        colors: [
                          primaryColor,
                          secondaryColor,
                          Colors.white,
                        ],
                      ),
                    ),
                    padding: const EdgeInsets.fromLTRB(15, 10, 15, 10),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.stretch,
                      children: [
                        Text(
                          (langUserPhone == "fr")
                              ? "Préférence Pays :"
                              : "Country Preference:",
                          style: GoogleFonts.poppins(
                            fontSize: 16,
                            color: Colors.white,
                            fontWeight: FontWeight.w600,
                          ),
                          textAlign: TextAlign.left,
                        ),
                        const SizedBox(height: 10),
                        Text(
                          preferencePaysText.toString(),
                          style: GoogleFonts.poppins(
                            fontSize: 10,
                            color: Colors.white,
                            fontWeight: FontWeight.w600,
                          ),
                          textAlign: TextAlign.left,
                        ),
                        const SizedBox(height: 10),
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
                                child: Text((langUserPhone == "fr")
                                    ? 'Modifier'
                                    : 'Edit'),
                              ),
                            )
                          ],
                        ),
                      ],
                    ),
                  ),
                ),
                const Padding(
                  padding:
                      EdgeInsets.only(left: 50, top: 5, right: 50, bottom: 5),
                  child: Divider(
                    height: 1,
                    thickness: 1,
                    color: Colors.grey,
                  ),
                ),
                const SizedBox(height: 5),
                if (havePublicites == true)
                  Column(
                    children: [
                      AdvertisementListPage(),
                      const SizedBox(height: 5),
                      const Padding(
                        padding: EdgeInsets.only(
                            left: 50, top: 5, right: 50, bottom: 5),
                        child: Divider(
                          height: 1,
                          thickness: 1,
                          color: Colors.grey,
                        ),
                      ),
                      const SizedBox(height: 5),
                    ],
                  ),
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
