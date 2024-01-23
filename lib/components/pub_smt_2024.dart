import 'package:flutter/material.dart';

Widget SpecialPub() {
  String imageUrl =
      "https://www.bluelife.tech/assets/summer_tech_2024/summer_tech_2024.png";
  String targetUrl = "https://www.bluelife.tech/summer-tech-2024";
  return Padding(
    padding: const EdgeInsets.only(left: 10, top: 5, right: 10, bottom: 5),
    child: Center(
      child: GestureDetector(
        onTap: () async {
          final Uri _url = Uri.parse(targetUrl);
          if (!await launchUrl(_url, mode: LaunchMode.externalApplication)) {
            throw 'Could not launch $_url';
          }
        },
        child: ClipRRect(
          borderRadius: BorderRadius.circular(5),
          child: Image.network(
            imageUrl,
            fit: BoxFit.cover,
          ),
        ),
      ),
    ),
  );
}

Future<bool> launchUrl(Uri url, {LaunchMode mode = LaunchMode.browser}) async {
  // Simule la logique de lancement d'URL
  // Remplacez cela par votre propre logique de lancement d'URL
  print('Lancement de l\'URL : $url');
  return true;
}

enum LaunchMode {
  browser,
  externalApplication,
}
