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
                ? "Sur les pages ci-dessous, seront dissimulés des codes promos dans les postes, abonnez-vous pour ne rien manquer. Vous serez également informé de toutes les opportunités, astuces, formations, promotions, etc. que vous ne devez pas manquer. Vos réactions aux postes sont aussi les bienvenus et sont récompensé chaque fin de semaine. Merci. 🙏🙏🙏"
                : "On the pages below, promo codes will be hidden in the posts, so subscribe to stay up-to-date. You'll also be informed of all the opportunities, tips, training, promotions, and more that you shouldn't miss. Your feedback on the posts is also welcome and will be rewarded every weekend. Thank you. 🙏🙏🙏",
            style: GoogleFonts.poppins(
              color: Colors.white,
              fontSize: 12,
              fontWeight: FontWeight.w500,
            ),
            textAlign: TextAlign.justify,
          ),
          const SizedBox(height: 10),
          Column(
            children: [
              ProfileMenuReseauBlanc(
                text: "TikTok Dressur",
                press: () async {
                  final Uri url3 = Uri.parse(tiktokDS);
                  if (!await launchUrl(url3,
                      mode: LaunchMode.externalApplication)) {
                    throw 'Could not launch $url3';
                  }
                },
              ),
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
              ProfileMenuReseauBlanc(
                text: "Instagram Dressur",
                press: () async {
                  final Uri url3 = Uri.parse(instagramDS);
                  if (!await launchUrl(url3,
                      mode: LaunchMode.externalApplication)) {
                    throw 'Could not launch $url3';
                  }
                },
              ),
              // Row(
              //   mainAxisAlignment: MainAxisAlignment.spaceBetween,
              //   children: [
              //     SizedBox(
              //       width: MediaQuery.of(context).size.width * 0.44,
              //       child: ProfileMenuReseauBlanc(
              //         text: "TikTok BLT",
              //         press: () async {
              //           final Uri url2 = Uri.parse(tiktokBLT);
              //           if (!await launchUrl(url2,
              //               mode: LaunchMode.externalApplication)) {
              //             throw 'Could not launch $url2';
              //           }
              //         },
              //       ),
              //     ),
              //     SizedBox(
              //       width: MediaQuery.of(context).size.width * 0.44,
              //       child: ProfileMenuReseauBlanc(
              //         text: "TikTok ELTCS",
              //         press: () async {
              //           final Uri url2 = Uri.parse(tiktokELTCS);
              //           if (!await launchUrl(url2,
              //               mode: LaunchMode.externalApplication)) {
              //             throw 'Could not launch $url2';
              //           }
              //         },
              //       ),
              //     ),
              //   ],
              // ),
              // Row(
              //   mainAxisAlignment: MainAxisAlignment.spaceBetween,
              //   children: [
              //     SizedBox(
              //       width: MediaQuery.of(context).size.width * 0.44,
              //       child: ProfileMenuReseauBlanc(
              //         text: "Facebook BLT",
              //         press: () async {
              //           final Uri url2 = Uri.parse(facebookBLT);
              //           if (!await launchUrl(url2,
              //               mode: LaunchMode.externalApplication)) {
              //             throw 'Could not launch $url2';
              //           }
              //         },
              //       ),
              //     ),
              //     SizedBox(
              //       width: MediaQuery.of(context).size.width * 0.44,
              //       child: ProfileMenuReseauBlanc(
              //         text: "Facebook ELTCS",
              //         press: () async {
              //           final Uri url2 = Uri.parse(facebookELTCS);
              //           if (!await launchUrl(url2,
              //               mode: LaunchMode.externalApplication)) {
              //             throw 'Could not launch $url2';
              //           }
              //         },
              //       ),
              //     ),
              //   ],
              // ),
              // Row(
              //   mainAxisAlignment: MainAxisAlignment.spaceBetween,
              //   children: [
              //     SizedBox(
              //       width: MediaQuery.of(context).size.width * 0.44,
              //       child: ProfileMenuReseauBlanc(
              //         text: "Instagram BLT",
              //         press: () async {
              //           final Uri url2 = Uri.parse(instagramBLT);
              //           if (!await launchUrl(url2,
              //               mode: LaunchMode.externalApplication)) {
              //             throw 'Could not launch $url2';
              //           }
              //         },
              //       ),
              //     ),
              //     SizedBox(
              //       width: MediaQuery.of(context).size.width * 0.44,
              //       child: ProfileMenuReseauBlanc(
              //         text: "Instagram ELTCS",
              //         press: () async {
              //           final Uri url2 = Uri.parse(instagramELTCS);
              //           if (!await launchUrl(url2,
              //               mode: LaunchMode.externalApplication)) {
              //             throw 'Could not launch $url2';
              //           }
              //         },
              //       ),
              //     ),
              //   ],
              // ),
            ],
          ),
        ],
      ),
    );
  }
}
