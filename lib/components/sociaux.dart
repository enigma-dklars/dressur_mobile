// ignore_for_file: prefer_const_constructors

import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:url_launcher/url_launcher.dart';
import 'package:dressur/components/constant.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart'; // Import du package d'icônes

class SociauxPage extends StatelessWidget {
  const SociauxPage({super.key});

  // Fonction helper pour lancer les URLs de manière sécurisée
  void _launchURL(String url) async {
    final Uri uri = Uri.parse(url);
    if (!await launchUrl(uri, mode: LaunchMode.externalApplication)) {
      print('Could not launch $url');
    }
  }

  @override
  Widget build(BuildContext context) {
    return Container(
      margin: const EdgeInsets.symmetric(horizontal: 10, vertical: 0),
      padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 12),
      decoration: BoxDecoration(
        gradient: LinearGradient(
          colors: [primaryColor, primaryColor.withOpacity(0.9)],
          begin: Alignment.topLeft,
          end: Alignment.bottomRight,
        ),
        borderRadius: BorderRadius.circular(15),
      ),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.center,
        children: [
          // --- PARTIE TEXTE (à gauche) ---
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                // --- NOUVEAU TITRE : L'APPEL À L'ACTION DIRECT ---
                Text(
                  (langUserPhone == "fr") ? "Abonnez-vous !" : "Follow us!",
                  style: GoogleFonts.poppins(
                    color: Colors.white,
                    fontSize: 16, // Légèrement plus grand pour plus d'impact
                    fontWeight: FontWeight.bold,
                  ),
                ),
                SizedBox(height: 3),

                // --- NOUVEAU SOUS-TITRE : LA RAISON (LE "POURQUOI") ---
                Text(
                  (langUserPhone == "fr")
                      ? "Pour ne rien manquer de nos offres."
                      : "To never miss our offers.",
                  style: GoogleFonts.poppins(
                    color: Colors.white.withOpacity(0.85),
                    fontSize: 12,
                  ),
                ),
              ],
            ),
          ),
          SizedBox(width: 16),

          // --- PARTIE ICÔNES (à droite) ---
          Row(
            children: [
              _buildSocialIconButton(
                icon: FontAwesomeIcons.tiktok,
                onTap: () => _launchURL(tiktokDS),
              ),
              SizedBox(width: 14), // Espacement ajusté
              _buildSocialIconButton(
                icon: FontAwesomeIcons.facebook,
                onTap: () => _launchURL(facebookDS),
              ),
              SizedBox(width: 14),
              _buildSocialIconButton(
                icon: FontAwesomeIcons.instagram,
                onTap: () => _launchURL(instagramDS),
              ),
              SizedBox(width: 14),
              _buildSocialIconButton(
                icon: FontAwesomeIcons.whatsapp,
                onTap: () => _launchURL(chaineWhatsApp),
              ),
            ],
          ),
        ],
      ),
    );
  }

  // Widget pour un bouton d'icône de réseau social
  Widget _buildSocialIconButton({
    required IconData icon,
    required VoidCallback onTap,
  }) {
    // Utilisation de Tooltip pour afficher le nom du réseau au survol (utile sur le web)
    return Tooltip(
      message: icon == FontAwesomeIcons.tiktok
          ? 'TikTok'
          : icon == FontAwesomeIcons.facebook
              ? 'Facebook'
              : icon == FontAwesomeIcons.instagram
                  ? 'Instagram'
                  : 'WhatsApp',
      child: InkWell(
        onTap: onTap,
        borderRadius: BorderRadius.circular(20),
        child: Padding(
          padding: const EdgeInsets.all(
              4.0), // Petite zone de clic autour de l'icône
          child: FaIcon(
            icon,
            color: Colors.white,
            size: 24, // Icônes légèrement plus grandes
          ),
        ),
      ),
    );
  }
}
