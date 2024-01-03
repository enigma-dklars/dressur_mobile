import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:url_launcher/url_launcher.dart';
import 'package:dressur/components/delayed_animation.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/profile_menu_web.dart';

class AproposPage extends StatelessWidget {
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
          ),
        ),
        title: Text(
          (langUserPhone == "fr") ? "À Propos" : "About Us",
          style: GoogleFonts.poppins(fontWeight: FontWeight.w600),
        ),
      ),
      body: SingleChildScrollView(
        child: Column(
          children: [
            Container(
              margin: const EdgeInsets.all(0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.center,
                children: [
                  const SizedBox(height: 20),
                  DelayedAnimation(
                    delay: 0, // 500,
                    child: SizedBox(
                      height: 200,
                      child: Image.asset("images/dressur_logo.png"),
                    ),
                  ),
                  DelayedAnimation(
                    delay: 0, // 500,
                    child: Text(
                      "Dressur",
                      style: GoogleFonts.poppins(
                          color: primaryColor,
                          fontSize: 30,
                          fontWeight: FontWeight.w600),
                      textAlign: TextAlign.center,
                    ),
                  ),
                  const SizedBox(height: 10),
                  DelayedAnimation(
                    delay: 0, // 500,
                    child: Container(
                      margin: const EdgeInsets.fromLTRB(10, 0, 10, 0),
                      padding: const EdgeInsets.all(5.0),
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.circular(15),
                      ),
                      child: Text(
                        (langUserPhone == "fr")
                            ? "Nous simplifions votre quête de visibilité sur vos différents réseaux sociaux et surtout sur vos statuts WhatsApp. \nGrâce à Dressur, faite la promotion de vos produits et services qui seront visibles par des milliers d'utilisateurs en seulement 24H. \nNous vous permettons d'avoir plus facilement des contacts WhatsApp selon les pays de votre choix. De plus, ses contacts sont automatiquement enregistrés dans votre téléphone et votre contact dans les leurs. \nNous vous permettons également de récupérer ses contacts en cas de perte. Rejoignez la communauté Dressur."
                            : "We simplify your quest for visibility on your various social networks and especially on your WhatsApp statuses. \nThanks to Dressur, promote your products and services that will be visible to thousands of users in just 24 hours. \nWe make it easier for you to have WhatsApp contacts according to the countries of your choice. In addition, their contacts are automatically saved in your phone and your contact in theirs. \nWe also allow you to recover their contacts in case of loss. Join the Dressur community.",
                        style: GoogleFonts.poppins(
                          fontSize: 16,
                        ),
                        textAlign: TextAlign.left,
                      ),
                    ),
                  ),
                  const SizedBox(height: 20),
                  Text(
                    (langUserPhone == "fr")
                        ? "Version actuellement installée : $versionApp"
                        : "Currently installed version: $versionApp",
                    style: GoogleFonts.poppins(
                      color: Colors.grey,
                      fontSize: 16,
                      fontWeight: FontWeight.w500,
                    ),
                    textAlign: TextAlign.center,
                  ),
                  const SizedBox(height: 20),
                  ProfileMenuWeb(
                    text: (langUserPhone == "fr")
                        ? "Conditions d'utilisation"
                        : "Terms of use",
                    Myicon: const Icon(Icons.abc),
                    press: () async {
                      final Uri _url = Uri.parse(dressurConditionUtilisation);
                      if (!await launchUrl(_url,
                          mode: LaunchMode.externalApplication)) {
                        throw 'Could not launch $_url';
                      }
                    },
                  ),
                  ProfileMenuWeb(
                    text: (langUserPhone == "fr")
                        ? "Politique de confidentialité"
                        : "Privacy Policy",
                    Myicon: const Icon(Icons.abc),
                    press: () async {
                      final Uri _url =
                          Uri.parse(dressurPolitiqueConfidentialite);
                      if (!await launchUrl(_url,
                          mode: LaunchMode.externalApplication)) {
                        throw 'Could not launch $_url';
                      }
                    },
                  ),
                  const SizedBox(height: 20),
                  DelayedAnimation(
                    delay: 0, // 500,
                    child: Text(
                      "2022 - ${getCurrentYear()}",
                      style: GoogleFonts.poppins(
                        color: Colors.grey,
                        fontSize: 16,
                        fontWeight: FontWeight.w600,
                      ),
                      textAlign: TextAlign.center,
                    ),
                  ),
                  DelayedAnimation(
                    delay: 0, // 500,
                    child: Text(
                      (langUserPhone == "fr")
                          ? "© Tous droits réservés"
                          : "© All rights reserved",
                      style: GoogleFonts.poppins(
                          color: Colors.grey,
                          fontSize: 16,
                          fontWeight: FontWeight.w600),
                      textAlign: TextAlign.center,
                    ),
                  ),
                  DelayedAnimation(
                    delay: 0, // 500,
                    child: Text(
                      "www.blue-life.tech",
                      style: GoogleFonts.poppins(
                          color: Colors.grey,
                          fontSize: 16,
                          fontWeight: FontWeight.w600),
                      textAlign: TextAlign.center,
                    ),
                  ),
                  const SizedBox(height: 20),
                  DelayedAnimation(
                    delay: 0, // 500,
                    child: Text(
                      (langUserPhone == "fr") ? "conçu par" : "conceived by",
                      style: GoogleFonts.poppins(
                          color: Colors.grey,
                          fontSize: 16,
                          fontWeight: FontWeight.w600),
                      textAlign: TextAlign.center,
                    ),
                  ),
                  Row(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      Column(
                        children: [
                          DelayedAnimation(
                            delay: 0, // 500,
                            child: SizedBox(
                              height: 45,
                              child: Image.asset("images/blt.png"),
                            ),
                          ),
                        ],
                      ),
                      Column(
                        children: [
                          DelayedAnimation(
                            delay: 0, // 500,
                            child: Text(
                              "Blue Life Tech",
                              style: GoogleFonts.poppins(
                                fontSize: 27,
                                fontWeight: FontWeight.w600,
                              ),
                              textAlign: TextAlign.center,
                            ),
                          ),
                        ],
                      ),
                    ],
                  ),
                  DelayedAnimation(
                    delay: 0, // 500,
                    child: Text(
                      "&",
                      style: GoogleFonts.poppins(
                          color: Colors.grey,
                          fontSize: 16,
                          fontWeight: FontWeight.w600),
                      textAlign: TextAlign.center,
                    ),
                  ),
                  Row(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      Column(
                        children: [
                          DelayedAnimation(
                            delay: 0, // 500,
                            child: SizedBox(
                              height: 45,
                              child: Image.asset("images/eltc_dark.png"),
                            ),
                          ),
                        ],
                      ),
                      Column(
                        children: [
                          DelayedAnimation(
                            delay: 0, // 500,
                            child: Text(
                              "Elitics Core",
                              style: GoogleFonts.poppins(
                                fontSize: 27,
                                fontWeight: FontWeight.w600,
                              ),
                              textAlign: TextAlign.center,
                            ),
                          ),
                        ],
                      ),
                    ],
                  ),
                  const SizedBox(height: 20),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}
