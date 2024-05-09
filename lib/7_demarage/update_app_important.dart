import 'dart:io';

import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:url_launcher/url_launcher.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/delayed_animation.dart';

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
  Future<bool> _onWillPop() async {
    return (await showDialog(
          context: context,
          builder: (context) => AlertDialog(
            title: (langUserPhone == "fr")
                ? const Text('Êtes-vous sûr?')
                : const Text('Are you sure?'),
            content: (langUserPhone == "fr")
                ? const Text("Voulez-vous quitter l'application ?")
                : const Text("Do you want to quit the application ?"),
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
          backgroundColor: Colors.white,
        ),
        body: SingleChildScrollView(
          child: Container(
            height: MediaQuery.of(context).size.height * 1,
            color: Colors.white,
            child: Column(
              children: [
                DelayedAnimation(
                  delay: 500,
                  child: SizedBox(
                    height: MediaQuery.of(context).size.height * 0.25,
                    child: Image.asset("images/giphy_2.gif"),
                  ),
                ),
                DelayedAnimation(
                  delay: 1000,
                  child: SizedBox(
                    height: MediaQuery.of(context).size.height * 0.25,
                    child: Image.asset("images/ds_img_12.png"),
                  ),
                ),
                const SizedBox(
                  height: 20,
                ),
                DelayedAnimation(
                  delay: 1000,
                  child: SizedBox(
                    width: MediaQuery.of(context).size.width * 0.90,
                    child: Text(
                      (langUserPhone == "fr")
                          ? "Une nouvelle version de Dressur est disponible.\nFaite sa mise à jour pour continuer à profiter de ses merveilleux avantages.\n\n\nCliquer sur le bouton ci-dessous pour télécharger la nouvel version."
                          : "A new version of Dressur is available.\nUpdate to continue enjoying its wonderful benefits.\n\n\nClick the button below to download the new version.",
                      style: GoogleFonts.poppins(
                        fontWeight: FontWeight.w600,
                        color: Colors.black,
                      ),
                      textAlign: TextAlign.center,
                    ),
                  ),
                ),
                const SizedBox(
                  height: 20,
                ),
                DelayedAnimation(
                  delay: 1000, // 2500,
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
                          color: Colors.white,
                        ),
                      ),
                      onPressed: () async {
                        final Uri _url = Uri.parse(dressurUrlPlaystore);
                        if (!await launchUrl(_url,
                            mode: LaunchMode.externalApplication)) {
                          throw 'Could not launch $_url';
                        }
                      },
                    ),
                  ),
                ),
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
        ),
      ),
    );
  }
}