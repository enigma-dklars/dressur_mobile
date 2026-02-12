import 'package:flutter/material.dart';
import 'package:url_launcher/url_launcher.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart'; // Pour l'icône Play Store
import 'package:dressur/components/constant.dart'; // Pour accéder à primaryColor

Widget SpecialPub(BuildContext context) {
  // Ajout du BuildContext pour le thème
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
    } else {
      // Optionnel : Gérer l'erreur si le lien ne peut pas être ouvert
      print('Could not launch $url');
    }
  }

  final theme = Theme.of(context);
  final isDark = theme.brightness == Brightness.dark;

  return Padding(
    padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 0),
    child: Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        // --- TITRE MIEUX INTÉGRÉ ---
        Padding(
          padding: const EdgeInsets.only(left: 5, bottom: 12),
          child: Text(
            "Découvrez nos autres applications",
            style: GoogleFonts.poppins(
              fontSize: 18,
              fontWeight: FontWeight.w600,
              color: isDark ? Colors.white.withOpacity(0.9) : Colors.black87,
            ),
          ),
        ),

        // --- LISTE HORIZONTALE ---
        SizedBox(
          height: 180, // Hauteur légèrement augmentée pour plus d'aisance
          child: ListView.separated(
            physics: BouncingScrollPhysics(), // Effet de rebond plus moderne
            scrollDirection: Axis.horizontal,
            itemCount: apps.length,
            separatorBuilder: (context, index) => const SizedBox(width: 15),
            itemBuilder: (context, index) {
              final app = apps[index];

              return Container(
                width: 290,
                decoration: BoxDecoration(
                  borderRadius:
                      BorderRadius.circular(15), // Coins plus arrondis
                  boxShadow: [
                    BoxShadow(
                      color: Colors.black.withOpacity(0.1),
                      blurRadius: 12,
                      offset: const Offset(0, 4),
                    ),
                  ],
                ),
                // ClipRRect pour appliquer le radius à l'image
                child: ClipRRect(
                  borderRadius: BorderRadius.circular(15),
                  child: Stack(
                    children: [
                      // --- IMAGE DE FOND ---
                      Image.asset(
                        app["image"]!,
                        width: double.infinity,
                        height: double.infinity,
                        fit: BoxFit.cover,
                      ),

                      // --- DÉGRADÉ POUR LA LISIBILITÉ DU TEXTE ---
                      Container(
                        decoration: BoxDecoration(
                          gradient: LinearGradient(
                            begin: Alignment.topCenter,
                            end: Alignment.bottomCenter,
                            colors: [
                              Colors.transparent,
                              Colors.black.withOpacity(0.2),
                              Colors.black.withOpacity(0.9),
                            ],
                            stops: const [
                              0.3,
                              0.6,
                              1.0
                            ], // Dégradé plus progressif
                          ),
                        ),
                      ),

                      // --- CONTENU SUPERPOSÉ ---
                      Positioned(
                        bottom: 16,
                        left: 16,
                        right: 16,
                        child: Row(
                          crossAxisAlignment: CrossAxisAlignment.center,
                          children: [
                            // --- NOM DE L'APP ---
                            Expanded(
                              child: Text(
                                app["name"]!,
                                style: GoogleFonts.poppins(
                                  // Utilisation de Poppins
                                  color: Colors.white,
                                  fontSize: 20,
                                  fontWeight: FontWeight.bold,
                                  shadows: [
                                    Shadow(
                                      blurRadius: 8,
                                      color: Colors.black.withOpacity(0.7),
                                      offset: Offset(0, 2),
                                    ),
                                  ],
                                ),
                              ),
                            ),
                            SizedBox(width: 10),
                            // --- BOUTON D'INSTALLATION AMÉLIORÉ ---
                            Container(
                              padding: const EdgeInsets.symmetric(
                                horizontal: 14,
                                vertical: 8,
                              ),
                              decoration: BoxDecoration(
                                color: Colors
                                    .white, // Fond blanc pour un meilleur contraste
                                borderRadius: BorderRadius.circular(30),
                              ),
                              child: Row(
                                children: [
                                  FaIcon(FontAwesomeIcons.googlePlay,
                                      color: primaryColor, size: 16),
                                  SizedBox(width: 8),
                                  Text(
                                    "Installer",
                                    style: GoogleFonts.poppins(
                                      color:
                                          primaryColor, // Texte avec la couleur primaire
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

                      // --- EFFET DE CLIC (INKWELL) ---
                      // Placé en dernier pour être au-dessus de tout
                      Material(
                        color: Colors.transparent,
                        child: InkWell(
                          onTap: () => _openPlayStore(app["playstore"]!),
                          splashColor: primaryColor.withOpacity(0.2),
                          highlightColor: primaryColor.withOpacity(0.1),
                        ),
                      ),
                    ],
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
