import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:url_launcher/url_launcher.dart';
import 'package:whatsperson/components/constant.dart';
import 'package:whatsperson/components/delayed_animation.dart';

class ImportantUpdate extends StatelessWidget {
  const ImportantUpdate({Key? key}) : super(key: key);

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
  @override
  Widget build(BuildContext context) {
    return SingleChildScrollView(
      child: Container(
        margin: const EdgeInsets.only(top: 20, bottom: 0),
        child: Column(
          children: [
            SizedBox(
              height: MediaQuery.of(context).size.height * 0.10,
            ),
            DelayedAnimation(
              delay: 500,
              child: SizedBox(
                height: MediaQuery.of(context).size.height * 0.25,
                child: Image.asset("images/giphy_2.gif"),
              ),
            ),
            DelayedAnimation(
              delay: 3000,
              child: SizedBox(
                height: MediaQuery.of(context).size.height * 0.25,
                child: Image.asset("images/wp_img_12.png"),
              ),
            ),
            const SizedBox(
              height: 20,
            ),
            DelayedAnimation(
              delay: 3000,
              child: SizedBox(
                width: MediaQuery.of(context).size.width * 0.90,
                child: Text(
                  (langUserPhone == "fr") ? "Une nouvelle version de WhatsPerson est disponible.\nFaite sa mise à jour pour continuer à profiter de ses merveilleux avantages.\n\n\nCliquer sur le bouton ci-dessous pour télécharger la nouvel version." : "A new version of WhatsPerson is available.\nUpdate to continue enjoying its wonderful benefits.\n\n\nClick the button below to download the new version.",
                  style: GoogleFonts.poppins(
                    fontWeight: FontWeight.w600,
                  ),
                  textAlign: TextAlign.center,
                ),
              ),
            ),
            const SizedBox(
              height: 20,
            ),
            DelayedAnimation(
                delay: 5000, // 2500,
                child: SizedBox(
                  width: MediaQuery.of(context).size.width * 0.90,
                  child: ElevatedButton(
                    style: ElevatedButton.styleFrom(
                      backgroundColor: const Color.fromARGB(255, 6, 58, 230),
                      shape: const StadiumBorder(),
                      minimumSize: const Size.fromHeight(50),
                    ),
                    child: Text(
                      (langUserPhone == "fr") ? "Télécharger" : "Download",
                      style: GoogleFonts.poppins(
                        fontSize: 16,
                        fontWeight: FontWeight.w600,
                      ),
                    ),
                    onPressed: () async {
                      final Uri _url =
                          Uri.parse(whatsPersonUrlPlaystore);
                      if (!await launchUrl(_url,
                          mode: LaunchMode.externalApplication)) {
                        throw 'Could not launch $_url';
                      }
                    },
                  ),
                )),
            DelayedAnimation(
              delay: 1000,
              child: Container(
                margin: const EdgeInsets.all(20),
              ),
            ),
            const SizedBox(height: 20),
          ],
        ),
      ),
    );
  }
}
