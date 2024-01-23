import 'package:flutter/material.dart';
import 'package:url_launcher/url_launcher.dart';

Widget SpecialPub() {
  String targetUrl = "https://www.bluelife.tech/summer-tech-2024";
  return Padding(
    padding: const EdgeInsets.only(left: 10, top: 5, right: 10, bottom: 5),
    child: GestureDetector(
      onTap: () async {
        final Uri _url = Uri.parse(targetUrl);
        if (!await launchUrl(_url, mode: LaunchMode.externalApplication)) {
          throw 'Could not launch $_url';
        }
      },
      child: ClipRRect(
        borderRadius: BorderRadius.circular(5),
        child: Image.asset(
          "images/summer_tech_2024.webp",
          fit: BoxFit.cover,
        ),
      ),
    ),
  );
}