import 'package:flutter/material.dart';
import 'package:url_launcher/url_launcher.dart';

Widget SpecialPub() {
  final List<Map<String, String>> apps = [
    {
      "name": "MyScroll",
      "image": "images/my_scroll_ban.png",
      "playstore":
          "https://play.google.com/store/apps/details?id=com.bluelifetech.myscroll",
    },
    {
      "name": "Mon Budget",
      "image": "images/mon_budget_ban.png",
      "playstore":
          "https://play.google.com/store/apps/details?id=com.blt.mon_budget_new",
    },
  ];

  Future<void> _openPlayStore(String url) async {
    final Uri uri = Uri.parse(url);
    if (await canLaunchUrl(uri)) {
      await launchUrl(uri, mode: LaunchMode.externalApplication);
    }
  }

  return Padding(
    padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 10),
    child: Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        // Titre discret
        const Padding(
          padding: EdgeInsets.only(left: 8, bottom: 10),
          child: Text(
            "Découvrez aussi nos applications",
            style: TextStyle(
              fontSize: 17,
              fontWeight: FontWeight.w600,
              color: Colors.black87,
            ),
          ),
        ),

        // Deux cartes en horizontal (défile si écran petit)
        SizedBox(
          height: 155,
          child: ListView.separated(
            scrollDirection: Axis.horizontal,
            itemCount: apps.length,
            separatorBuilder: (context, index) => const SizedBox(width: 12),
            itemBuilder: (context, index) {
              final app = apps[index];

              return GestureDetector(
                onTap: () => _openPlayStore(app["playstore"]!),
                child: Container(
                  width: 290,
                  decoration: BoxDecoration(
                    borderRadius: BorderRadius.circular(16),
                    boxShadow: [
                      BoxShadow(
                        color: Colors.black.withOpacity(0.08),
                        blurRadius: 10,
                        offset: const Offset(0, 5),
                      ),
                    ],
                  ),
                  child: ClipRRect(
                    borderRadius: BorderRadius.circular(16),
                    child: Stack(
                      children: [
                        // Image de fond
                        Image.asset(
                          app["image"]!,
                          width: double.infinity,
                          height: double.infinity,
                          fit: BoxFit.cover,
                        ),

                        // Dégradé + texte
                        Container(
                          decoration: BoxDecoration(
                            gradient: LinearGradient(
                              begin: Alignment.topCenter,
                              end: Alignment.bottomCenter,
                              colors: [
                                Colors.transparent,
                                Colors.black.withOpacity(0.8),
                              ],
                              stops: const [0.4, 1.0],
                            ),
                          ),
                        ),

                        // Nom de l'app + badge "Play Store"
                        Positioned(
                          bottom: 14,
                          left: 16,
                          right: 16,
                          child: Row(
                            children: [
                              Expanded(
                                child: Text(
                                  app["name"]!,
                                  style: const TextStyle(
                                    color: Colors.white,
                                    fontSize: 19,
                                    fontWeight: FontWeight.bold,
                                    shadows: [
                                      Shadow(
                                        blurRadius: 10,
                                        color: Colors.black54,
                                        offset: Offset(0, 2),
                                      ),
                                    ],
                                  ),
                                ),
                              ),
                              Container(
                                padding: const EdgeInsets.symmetric(
                                  horizontal: 12,
                                  vertical: 8,
                                ),
                                decoration: BoxDecoration(
                                  color: const Color(
                                      0xFF00D09C), // Vert Play Store
                                  borderRadius: BorderRadius.circular(30),
                                ),
                                child: const Row(
                                  children: [
                                    Icon(Icons.play_arrow,
                                        color: Colors.white, size: 20),
                                    SizedBox(width: 6),
                                    Text(
                                      "Installer",
                                      style: TextStyle(
                                        color: Colors.white,
                                        fontWeight: FontWeight.bold,
                                        fontSize: 14,
                                      ),
                                    ),
                                  ],
                                ),
                              ),
                            ],
                          ),
                        ),
                      ],
                    ),
                  ),
                ),
              );
            },
          ),
        ),
      ],
    ),
  );
}
