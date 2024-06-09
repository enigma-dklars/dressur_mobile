import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:url_launcher/url_launcher.dart';
import 'package:dressur/components/delayed_animation.dart';
import 'package:dressur/components/constant.dart';

class SupportPage extends StatelessWidget {
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
            color: Colors.white,
          ),
        ),
        title: Text(
          (langUserPhone == "fr") ? "Support" : "Support",
          style: GoogleFonts.poppins(
            fontWeight: FontWeight.w400,
            color: Colors.white,
          ),
        ),
      ),
      body: SingleChildScrollView(
        child: Column(
          children: [
            Container(
              margin: const EdgeInsets.symmetric(vertical: 0, horizontal: 15),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.center,
                children: [
                  const SizedBox(height: 30),
                  DelayedAnimation(
                    delay: 0, // 500,
                    child: Text(
                      (langUserPhone == "fr")
                          ? "Support & Assistance Technique"
                          : "Support & Technical Assistance",
                      style: GoogleFonts.poppins(
                          fontSize: 22, fontWeight: FontWeight.w600),
                      textAlign: TextAlign.center,
                    ),
                  ),
                  const SizedBox(height: 40),
                  DelayedAnimation(
                    delay: 0, // 500,
                    child: SizedBox(
                      height: 200,
                      child: Image.asset("images/ds_img_10.png"),
                    ),
                  ),
                  const SizedBox(height: 30),
                  DelayedAnimation(
                    delay: 0, // 500,
                    child: SizedBox(
                      width: MediaQuery.of(context).size.width * 0.90,
                      child: Container(
                        padding: const EdgeInsets.all(5.0),
                        child: Text(
                          (langUserPhone == "fr")
                              ? "Nous simplifions votre quête de visibilité sur vos différents réseaux sociaux et surtout sur vos statuts WhatsApp. Grâce à Dressur, faite la promotion de vos produits et services qui seront visibles par des milliers d'utilisateurs en seulement 24H.\n\nAvez-vous des questions ?"
                              : "We simplify your quest for visibility on your various social networks and especially on your WhatsApp statuses. Thanks to Dressur, promote your products and services which will be visible to thousands of users in just 24 hours.\n\nHave you questions ?",
                          style: GoogleFonts.poppins(
                            fontSize: 16,
                          ),
                          textAlign: TextAlign.center,
                        ),
                      ),
                    ),
                  ),
                  const SizedBox(height: 30),
                  ElevatedButton(
                      style: ElevatedButton.styleFrom(
                        backgroundColor: Colors.green,
                        shape: const StadiumBorder(),
                        padding: const EdgeInsets.symmetric(
                          vertical: 13,
                          horizontal: 40,
                        ),
                      ),
                      child: Text(
                        (langUserPhone == "fr")
                            ? "Contactez nous sur WhatsApp"
                            : "Contact us on WhatsApp",
                        style: GoogleFonts.poppins(
                          fontWeight: FontWeight.w600,
                          color: Colors.white,
                        ),
                      ),
                      onPressed: () async {
                        final Uri _url = Uri.parse(whatsappDSURL);
                        if (!await launchUrl(_url,
                            mode: LaunchMode.externalApplication)) {
                          throw 'Could not launch $_url';
                        }
                      }),
                  const SizedBox(height: 30),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}
