import 'dart:io';
import 'dart:async';
import 'package:dressur/2_boost/liste_campagne_mail.dart';
import 'package:dressur/2_boost/new_campagne_mail.dart';
import 'package:dressur/components/noti.dart';
import 'package:dressur/components/pub_smt_2024.dart';
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

class BoostPage extends StatefulWidget {
  @override
  State<BoostPage> createState() => _BoostPageState();
}

class _BoostPageState extends State<BoostPage> {
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
            (langUserPhone == "fr") ? "Promotions" : "Promotions",
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
              const SizedBox(height: 5),
              SpecialPub(),
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
                  padding: const EdgeInsets.fromLTRB(10, 5, 10, 5),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.stretch,
                    children: [
                      Text(
                        "Boost Contact",
                        style: GoogleFonts.poppins(
                          fontWeight: FontWeight.w600,
                          fontSize: 24,
                          color: Colors.white,
                        ),
                      ),
                      Text(
                        (langUserPhone == "fr")
                            ? "Rendez visible le ($tel) aux contacts correspondant à vos préférences pays."
                            : "Make the ($tel) visible to contacts corresponding to your country preferences.",
                        style: GoogleFonts.poppins(
                          fontWeight: FontWeight.w600,
                          fontSize: 14,
                        ),
                      ),
                      Row(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [
                          Column(
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
                                    child: Text(
                                      (langUserPhone == "fr")
                                          ? "Faire un Boost"
                                          : "Boost",
                                    ),
                                    onPressed: () {
                                      Navigator.push(
                                        context,
                                        MaterialPageRoute(
                                            builder: (context) =>
                                                NewBoostContactPage()),
                                      );
                                    }),
                              )
                            ],
                          ),
                          Column(
                            children: [
                              SizedBox(
                                width: MediaQuery.of(context).size.width * 0.35,
                                child: ElevatedButton(
                                    style: ElevatedButton.styleFrom(
                                      backgroundColor: secondaryColor,
                                      shape: const StadiumBorder(),
                                      padding: const EdgeInsets.symmetric(
                                        vertical: 10,
                                      ),
                                    ),
                                    child: (langUserPhone == "fr")
                                        ? const Text("Voir la liste")
                                        : const Text("See the list"),
                                    onPressed: () {
                                      Navigator.push(
                                        context,
                                        MaterialPageRoute(
                                            builder: (context) =>
                                                ListeBoostContactPage()),
                                      );
                                    }),
                              )
                            ],
                          ),
                        ],
                      )
                    ],
                  ),
                ),
              ),
              const Padding(
                padding:
                    EdgeInsets.only(left: 50, top: 2, right: 50, bottom: 2),
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
                  padding: const EdgeInsets.fromLTRB(10, 5, 10, 5),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.stretch,
                    children: [
                      Text(
                        (langUserPhone == "fr")
                            ? "Promotion Affaire"
                            : "Business Promotion",
                        style: GoogleFonts.poppins(
                          fontWeight: FontWeight.w600,
                          fontSize: 24,
                          color: Colors.white,
                        ),
                      ),
                      Text(
                        (langUserPhone == "fr")
                            ? "Faite la promotion de vos produits et services. Les utilisateurs intéressés vous contacterons sur WhatsApp."
                            : "Promote your products and services. Interested users will contact you on WhatsApp.",
                        style: GoogleFonts.poppins(
                          fontWeight: FontWeight.w600,
                          fontSize: 14,
                        ),
                      ),
                      Row(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [
                          Column(
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
                                    child: Text((langUserPhone == "fr")
                                        ? "Faire une Promo"
                                        : "Make a Promo"),
                                    onPressed: () {
                                      Navigator.push(
                                        context,
                                        MaterialPageRoute(
                                            builder: (context) =>
                                                PromotionFormPage()),
                                      );
                                    }),
                              )
                            ],
                          ),
                          Column(
                            children: [
                              SizedBox(
                                width: MediaQuery.of(context).size.width * 0.35,
                                child: ElevatedButton(
                                    style: ElevatedButton.styleFrom(
                                      backgroundColor: secondaryColor,
                                      shape: const StadiumBorder(),
                                      padding: const EdgeInsets.symmetric(
                                        vertical: 10,
                                      ),
                                    ),
                                    child: (langUserPhone == "fr")
                                        ? const Text("Voir la liste")
                                        : const Text("See the list"),
                                    onPressed: () {
                                      Navigator.push(
                                        context,
                                        MaterialPageRoute(
                                            builder: (context) =>
                                                PromotionListPage()),
                                      );
                                    }),
                              )
                            ],
                          ),
                        ],
                      )
                    ],
                  ),
                ),
              ),
              const Padding(
                padding:
                    EdgeInsets.only(left: 50, top: 2, right: 50, bottom: 2),
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
                  padding: const EdgeInsets.fromLTRB(10, 5, 10, 5),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.stretch,
                    children: [
                      Text(
                        (langUserPhone == "fr")
                            ? "Campagne Mail"
                            : "Email Campaign",
                        style: GoogleFonts.poppins(
                          fontWeight: FontWeight.w600,
                          fontSize: 24,
                          color: Colors.white,
                        ),
                      ),
                      Text(
                        (langUserPhone == "fr")
                            ? "Faites la promotion de vos produits et services grâce à notre Campagne Mail."
                            : "Promote your products and services with our Mail Campaign.",
                        style: GoogleFonts.poppins(
                          fontWeight: FontWeight.w600,
                          fontSize: 14,
                        ),
                      ),
                      Row(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [
                          Column(
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
                                    child: Text(
                                      (langUserPhone == "fr")
                                          ? "Démarrer"
                                          : "To start up",
                                    ),
                                    onPressed: () {
                                      Navigator.push(
                                        context,
                                        MaterialPageRoute(
                                          builder: (context) =>
                                              NewCampagneMailPage(),
                                        ),
                                      );
                                    }),
                              )
                            ],
                          ),
                          Column(
                            children: [
                              SizedBox(
                                width: MediaQuery.of(context).size.width * 0.35,
                                child: ElevatedButton(
                                    style: ElevatedButton.styleFrom(
                                      backgroundColor: secondaryColor,
                                      shape: const StadiumBorder(),
                                      padding: const EdgeInsets.symmetric(
                                        vertical: 10,
                                      ),
                                    ),
                                    child: (langUserPhone == "fr")
                                        ? const Text("Voir la liste")
                                        : const Text("See the list"),
                                    onPressed: () {
                                      Navigator.push(
                                        context,
                                        MaterialPageRoute(
                                            builder: (context) =>
                                                CampagneMailListePage()),
                                      );
                                    }),
                              )
                            ],
                          ),
                        ],
                      )
                    ],
                  ),
                ),
              ),
              const Padding(
                padding:
                    EdgeInsets.only(left: 50, top: 2, right: 50, bottom: 2),
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
                  padding: const EdgeInsets.fromLTRB(10, 5, 10, 5),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.stretch,
                    children: [
                      Text(
                        (langUserPhone == "fr")
                            ? "Campagne SMS"
                            : "SMS Campaign",
                        style: GoogleFonts.poppins(
                          fontWeight: FontWeight.w600,
                          fontSize: 24,
                          color: Colors.white,
                        ),
                      ),
                      Text(
                        (langUserPhone == "fr")
                            ? "Grâce à notre Campagne SMS, Faites la promotion de vos produits et services."
                            : "Thanks to our SMS Campaign, promote your products and services.",
                        style: GoogleFonts.poppins(
                          fontWeight: FontWeight.w600,
                          fontSize: 14,
                        ),
                      ),
                      Row(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [
                          Column(
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
                                    child: Text(
                                      (langUserPhone == "fr")
                                          ? "Démarrer"
                                          : "To start up",
                                    ),
                                    onPressed: () {
                                      warningNoti(
                                          (langUserPhone == "fr")
                                              ? "Désoler"
                                              : "Sorry",
                                          (langUserPhone == "fr")
                                              ? "Ce service est momentanément indisponible"
                                              : "This service is temporarily unavailable",
                                          context);
                                      // Navigator.push(
                                      //   context,
                                      //   MaterialPageRoute(
                                      //       builder: (context) =>
                                      //           NewBoostContactPage()),
                                      // );
                                    }),
                              )
                            ],
                          ),
                          Column(
                            children: [
                              SizedBox(
                                width: MediaQuery.of(context).size.width * 0.35,
                                child: ElevatedButton(
                                    style: ElevatedButton.styleFrom(
                                      backgroundColor: secondaryColor,
                                      shape: const StadiumBorder(),
                                      padding: const EdgeInsets.symmetric(
                                        vertical: 10,
                                      ),
                                    ),
                                    child: (langUserPhone == "fr")
                                        ? const Text("Voir la liste")
                                        : const Text("See the list"),
                                    onPressed: () {
                                      warningNoti(
                                          (langUserPhone == "fr")
                                              ? "Désoler"
                                              : "Sorry",
                                          (langUserPhone == "fr")
                                              ? "Ce service est momentanément indisponible"
                                              : "This service is temporarily unavailable",
                                          context);
                                      // Navigator.push(
                                      //   context,
                                      //   MaterialPageRoute(
                                      //       builder: (context) =>
                                      //           ListeBoostContactPage()),
                                      // );
                                    }),
                              )
                            ],
                          ),
                        ],
                      )
                    ],
                  ),
                ),
              ),
              const Padding(
                padding:
                    EdgeInsets.only(left: 50, top: 2, right: 50, bottom: 2),
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
    );
  }
}
