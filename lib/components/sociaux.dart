import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:url_launcher/url_launcher.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/profile_menu_reseau_blanc.dart';

class SociauxPage extends StatefulWidget {
  @override
  _SociauxPageState createState() => _SociauxPageState();
}

class _SociauxPageState extends State<SociauxPage> {
  @override
  void initState() {
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Container(
      margin: const EdgeInsets.only(left: 10, top: 0, right: 10, bottom: 5),
      padding: const EdgeInsets.only(left: 10, top: 5, right: 10, bottom: 15),
      decoration: BoxDecoration(
        gradient: const LinearGradient(
          begin: Alignment.topCenter,
          end: Alignment.bottomCenter,
          colors: [
            primaryColor,
            primaryColor,
          ],
        ),
        borderRadius: BorderRadius.circular(5),
      ),
      child: Column(
        children: [
          Text(
            (langUserPhone == "fr")
                ? "Suivez-nous sur les réseaux sociaux !"
                : "Follow us on social networks!",
            style: GoogleFonts.poppins(
              color: Colors.white,
              fontSize: 16,
              fontWeight: FontWeight.w600,
            ),
            textAlign: TextAlign.center,
          ),
          const SizedBox(height: 10),
          Text(
            (langUserPhone == "fr")
                ? "Vous serez donc informé de toutes les opportunités, astuces, bourses de formations, promotions, etc. que vous ne devez pas manquer. Vos réactions aux postes sont également les bienvenus. Merci. 🙏🙏🙏"
                : "You will therefore be informed of all the opportunities, tips, training grants, promotions, etc. that you should not miss. Your reactions to the posts are also welcome. THANKS. 🙏🙏🙏",
            style: GoogleFonts.poppins(
              color: Colors.white,
              fontSize: 12,
              fontWeight: FontWeight.w400,
            ),
            textAlign: TextAlign.justify,
          ),
          const SizedBox(height: 10),
          Column(
            children: [
              ProfileMenuReseauBlanc(
                text: "Facebook Dressur",
                press: () async {
                  final Uri url3 = Uri.parse(facebookDS);
                  if (!await launchUrl(url3,
                      mode: LaunchMode.externalApplication)) {
                    throw 'Could not launch $url3';
                  }
                },
              ),
              Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  SizedBox(
                    child: ProfileMenuReseauBlanc(
                      text: "TikTok BLT",
                      press: () async {
                        final Uri url2 = Uri.parse(tiktokBLT);
                        if (!await launchUrl(url2,
                            mode: LaunchMode.externalApplication)) {
                          throw 'Could not launch $url2';
                        }
                      },
                    ),
                  ),
                  ProfileMenuReseauBlanc(
                    text: "TikTok ELTCS",
                    press: () async {
                      final Uri url2 = Uri.parse(tiktokELTCS);
                      if (!await launchUrl(url2,
                          mode: LaunchMode.externalApplication)) {
                        throw 'Could not launch $url2';
                      }
                    },
                  ),
                ],
              ),
              Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  ProfileMenuReseauBlanc(
                    text: "Facebook BLT",
                    press: () async {
                      final Uri url2 = Uri.parse(facebookBLT);
                      if (!await launchUrl(url2,
                          mode: LaunchMode.externalApplication)) {
                        throw 'Could not launch $url2';
                      }
                    },
                  ),
                  ProfileMenuReseauBlanc(
                    text: "Facebook ELTCS",
                    press: () async {
                      final Uri url2 = Uri.parse(facebookELTCS);
                      if (!await launchUrl(url2,
                          mode: LaunchMode.externalApplication)) {
                        throw 'Could not launch $url2';
                      }
                    },
                  ),
                ],
              ),
              Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  ProfileMenuReseauBlanc(
                    text: "Instagram BLT",
                    press: () async {
                      final Uri url2 = Uri.parse(instagramBLT);
                      if (!await launchUrl(url2,
                          mode: LaunchMode.externalApplication)) {
                        throw 'Could not launch $url2';
                      }
                    },
                  ),
                  ProfileMenuReseauBlanc(
                    text: "Instagram ELTCS",
                    press: () async {
                      final Uri url2 = Uri.parse(instagramELTCS);
                      if (!await launchUrl(url2,
                          mode: LaunchMode.externalApplication)) {
                        throw 'Could not launch $url2';
                      }
                    },
                  ),
                ],
              ),
            ],
          ),
        ],
      ),
    );
  }
}
