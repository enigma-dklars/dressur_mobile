// ignore_for_file: prefer_const_constructors, prefer_const_literals_to_create_immutables

import 'dart:async';
import 'dart:convert';
import 'package:dressur/components/noti.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;
import 'package:dressur/1_reception/business_promotions_page.dart';
import 'package:dressur/1_reception/recompense_start.dart';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/components/constant.dart';

class ProgrammeRecompenseDashboard extends StatefulWidget {
  @override
  State<ProgrammeRecompenseDashboard> createState() =>
      _ProgrammeRecompenseDashboardState();
}

class _ProgrammeRecompenseDashboardState
    extends State<ProgrammeRecompenseDashboard> {
  var vuesTotales = 0;
  var gainsTotales = 0;
  partageInProgrammeRecompense() async {
    try {
      var request = http.MultipartRequest(
          'POST',
          Uri.parse(
              '$generalRouteForApi/getMyProgrammeRecompenseInformations'));
      request.fields.addAll({
        'uid': uidUser,
        'langUserPhone': langUserPhone.toString(),
      });

      http.StreamedResponse response = await request.send();

      if (response.statusCode == 200) {
        var data1 = await response.stream.bytesToString();
        var data = convert.jsonDecode(data1);

        if (data["error"] == true) {
          dangerNoti(data["titre"], data["message"], context);
        } else {
          vuesTotales = data["vuesTotales"];
          gainsTotales = data["gainsTotales"];
          soldeProgrammeRecompense = data["soldeDisponible"];
        }
      }
    } catch (e) {
      print("Erreur: $e");
    }
  }

  @override
  void initState() {
    super.initState();
    partageInProgrammeRecompense();
  }

  @override
  Widget build(BuildContext context) {
    final theme = Theme.of(context);

    return Scaffold(
      appBar: AppBar(
        backgroundColor: primaryColor,
        elevation: 0,
        centerTitle: true,
        title: Text(
          "Mon Programme",
          style: GoogleFonts.poppins(
            color: Colors.white,
            fontWeight: FontWeight.w600,
            fontSize: 18,
          ),
        ),
        leading: IconButton(
          icon: Icon(Icons.arrow_back_ios, color: Colors.white, size: 20),
          onPressed: () => Navigator.pop(context),
        ),
        actions: [],
      ),
      body: SingleChildScrollView(
        physics: BouncingScrollPhysics(),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            // 1. CARTE PORTEFEUILLE (WALLET)
            _buildWalletCard(context),
            SizedBox(height: 13),

            Padding(
              padding: const EdgeInsets.symmetric(horizontal: 10),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  // 1. BOUTON ACCÈS PROGRAMME
                  _buildAccessProgramButton(context, theme),

                  SizedBox(height: 10),

                  // 2. BOUTON PROMOTIONS AFFAIRES (DÉPLACÉ ICI)
                  _buildBusinessPromotionsButton(context),

                  SizedBox(height: 10),

                  // 3. STATISTIQUES RAPIDES
                  _sectionTitle(context, "Mes Statistiques"),
                  Row(
                    children: [
                      _statItem(context, "Vues Totales", "$vuesTotales",
                          Icons.visibility, Colors.blue, theme),
                      SizedBox(width: 15),
                      _statItem(context, "Gains Totales", "$gainsTotales F",
                          Icons.account_balance_wallet, Colors.green, theme),
                    ],
                  ),

                  SizedBox(height: 10),

                  // 4. PROMOTIONS EN COURS
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      _sectionTitle(context, "Historique de participation…"),
                      TextButton(
                        onPressed: () {
                          // Action pour voir toutes les promotions en cours
                        },
                        child: Text("Voir tout",
                            style: GoogleFonts.poppins(
                                color: primaryColor, fontSize: 12)),
                      )
                    ],
                  ),
                  _promotionItem(
                    context,
                    "Vente Flash Chaussures",
                    "0 FCFA",
                    "01/01/2026",
                    "0 vues",
                    "https://images.unsplash.com/photo-1542291026-7eec264c27ff",
                    "en_cours",
                  ),

                  _promotionItem(
                    context,
                    "Promo Restaurant Le Gourmet",
                    "0 FCFA",
                    "05/01/2026",
                    "0 vues",
                    "https://images.unsplash.com/photo-1504674900247-0877df9cc836",
                    "en_attente",
                  ),

                  _promotionItem(
                    context,
                    "Lancement App Dressur",
                    "0 FCFA",
                    "10/01/2026",
                    "0 vues",
                    "https://images.unsplash.com/photo-1503023345310-bd7c1de61c7d",
                    "echouer",
                  ),
                  _promotionItem(
                    context,
                    "Il a voler pipo en live",
                    "1000 FCFA",
                    "12/01/2026",
                    "2000 vues",
                    "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSe2hdyqq3znwzVGlkW8wPfcUiuw491RqXU7PRohH9ZLMjfmdfrz_H47K20Jks1MwvMi0sQoVM4Gdrsq5_oodpK28sxG7__sDx1zcbi9w&s=10",
                    "refuser",
                  ),

                  _promotionItem(
                    context,
                    "App Dressur Boost Contact",
                    "0 FCFA",
                    "15/01/2026",
                    "0 vues",
                    "https://dressur.site/assets/img/hero.jpg",
                    "terminer",
                  ),

                  _promotionItem(
                    context,
                    "App Dressur Bot",
                    "2500 FCFA",
                    "20/01/2026",
                    "4500 vues",
                    "https://dressur.site/assets/img/dressur-bot.jpg",
                    "approuver",
                  ),
                  SizedBox(height: 10),
                ],
              ),
            ),
          ],
        ),
      ),
      // BOUTON FLOTTANT POUR AJOUTER UNE PROMO
    );
  }

  // ---------------------------------------------------------------------------
  // COMPOSANTS
  // ---------------------------------------------------------------------------

  // Bouton pour accéder à ProgrammeRecompensePage
  Widget _buildAccessProgramButton(BuildContext context, ThemeData theme) {
    return InkWell(
      onTap: () {
        // Navigation vers ProgrammeRecompensePage
        Navigator.push(
            context,
            MaterialPageRoute(
                builder: (context) =>
                    ProgrammeRecompensePage(optionPage: true)));
      },
      child: Container(
        padding: EdgeInsets.all(16),
        decoration: BoxDecoration(
          color: primaryColor.withOpacity(0.1),
          borderRadius: BorderRadius.circular(15),
          border: Border.all(color: primaryColor.withOpacity(0.3)),
        ),
        child: Row(
          children: [
            Icon(Icons.info_outline, color: primaryColor),
            SizedBox(width: 15),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    "Conditions du programme",
                    style: GoogleFonts.poppins(
                      fontWeight: FontWeight.bold,
                      fontSize: 14,
                      color: theme.textTheme.bodyLarge?.color,
                    ),
                  ),
                  SizedBox(height: 2),
                  Text(
                    "Relire les conditions ou quitter le programme",
                    style: GoogleFonts.poppins(
                      fontSize: 11,
                      color: Colors.grey[600],
                    ),
                  ),
                ],
              ),
            ),
            Icon(Icons.arrow_forward_ios, size: 14, color: primaryColor),
          ],
        ),
      ),
    );
  }

  // Bouton pour voir les promotions affaire
  Widget _buildBusinessPromotionsButton(BuildContext context) {
    return SizedBox(
      width: double.infinity,
      child: OutlinedButton.icon(
        onPressed: () {
          Navigator.push(
            context,
            MaterialPageRoute(
              builder: (context) => BusinessPromotionsPage(),
            ),
          );
        },
        icon: Icon(Icons.business_center_outlined, size: 18),
        label: Text(
          "Voir les promotions affaire disponibles",
          style: GoogleFonts.poppins(fontWeight: FontWeight.w600),
        ),
        style: OutlinedButton.styleFrom(
          foregroundColor: primaryColor,
          side: BorderSide(color: primaryColor),
          padding: EdgeInsets.symmetric(vertical: 12),
          shape:
              RoundedRectangleBorder(borderRadius: BorderRadius.circular(15)),
        ),
      ),
    );
  }

  Widget _buildWalletCard(BuildContext context) {
    return Container(
      width: double.infinity,
      margin: EdgeInsets.fromLTRB(10, 15, 10, 0),
      padding: EdgeInsets.all(24),
      decoration: BoxDecoration(
        gradient: LinearGradient(
          colors: [primaryColor, primaryColor.withOpacity(0.8)],
          begin: Alignment.topLeft,
          end: Alignment.bottomRight,
        ),
        borderRadius: BorderRadius.circular(15),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(
            "Solde disponible",
            style: GoogleFonts.poppins(
                color: Colors.white.withOpacity(0.8), fontSize: 14),
          ),
          SizedBox(height: 8),
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Text(
                "$soldeProgrammeRecompense FCFA",
                style: GoogleFonts.poppins(
                  color: Colors.white,
                  fontSize: 32,
                  fontWeight: FontWeight.bold,
                ),
              ),
              ElevatedButton(
                onPressed: () {
                  // Action de retrait
                },
                style: ElevatedButton.styleFrom(
                  backgroundColor: Colors.white,
                  foregroundColor: primaryColor,
                  elevation: 0,
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(13),
                  ),
                  padding:
                      const EdgeInsets.symmetric(horizontal: 15, vertical: 5),
                ),
                child: Row(
                  mainAxisSize: MainAxisSize.min,
                  children: [
                    Icon(Icons.account_balance_wallet_outlined, size: 20),
                    const SizedBox(width: 8),
                    Text(
                      "Retirer",
                      style: GoogleFonts.poppins(
                        fontWeight: FontWeight.bold,
                        fontSize: 15,
                      ),
                    ),
                  ],
                ),
              ),
            ],
          ),
          SizedBox(height: 8),
          Divider(color: Colors.white.withOpacity(0.2)),
          SizedBox(height: 10),
          Text(
            "Prochain retrait possible à partir de 1 000 FCFA",
            style: GoogleFonts.poppins(
                color: Colors.white.withOpacity(0.7), fontSize: 11),
          ),
        ],
      ),
    );
  }

  Widget _statItem(BuildContext context, String label, String value,
      IconData icon, Color color, theme) {
    final isDark = Theme.of(context).brightness == Brightness.dark;
    return Expanded(
      child: Container(
        padding: EdgeInsets.all(16),
        decoration: BoxDecoration(
          color: isDark ? Colors.white.withOpacity(0.05) : Colors.grey[50],
          borderRadius: BorderRadius.circular(15),
          border: Border.all(color: theme.dividerColor.withOpacity(0.1)),
        ),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Icon(icon, color: color, size: 24),
            SizedBox(height: 12),
            Text(
              value,
              style: GoogleFonts.poppins(
                fontSize: 20,
                fontWeight: FontWeight.bold,
                color: theme.textTheme.bodyLarge?.color,
              ),
            ),
            Text(
              label,
              style: GoogleFonts.poppins(
                fontSize: 12,
                color: isDark ? Colors.grey[400] : Colors.grey[600],
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _sectionTitle(BuildContext context, String title) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 15),
      child: Text(
        title,
        style: GoogleFonts.poppins(
          fontSize: 16,
          fontWeight: FontWeight.bold,
          color: Theme.of(context).textTheme.bodyLarge?.color,
        ),
      ),
    );
  }

  Widget _promotionItem(
    BuildContext context,
    String title,
    String amount,
    String date,
    String views,
    String imageUrl,
    String status,
  ) {
    final isDark = Theme.of(context).brightness == Brightness.dark;
    final statusConfig = getStatusBadgeConfig(status);

    return Padding(
      padding: const EdgeInsets.only(bottom: 15),
      child: Container(
        padding: const EdgeInsets.all(12),
        decoration: BoxDecoration(
          color: isDark ? Colors.white.withOpacity(0.05) : Colors.white,
          borderRadius: BorderRadius.circular(15),
          border: Border.all(
              color: Theme.of(context).dividerColor.withOpacity(0.1)),
        ),
        child: Row(
          children: [
            // --- L'IMAGE DE LA PROMOTION (Fusion de l'icône et de l'image) ---
            Container(
              width: 55,
              height: 55,
              decoration: BoxDecoration(
                borderRadius: BorderRadius.circular(12),
                image: DecorationImage(
                  image: NetworkImage(imageUrl),
                  fit: BoxFit.cover,
                ),
              ),
              // Petit indicateur de statut sur l'image
              child: Align(
                alignment: Alignment.bottomRight,
                child: Container(
                  padding: const EdgeInsets.all(2),
                  decoration: BoxDecoration(
                    color: (status == "approuver")
                        ? Colors.green
                        : (status == "echouer" || status == "refuser")
                            ? Colors.red
                            : (status == "en_attente")
                                ? Colors.orange
                                : Colors.black,
                    shape: BoxShape.circle,
                    border: Border.all(color: Colors.white, width: 1.5),
                  ),
                  child: Icon(
                    (status == "approuver")
                        ? Icons.check_circle
                        : (status == "echouer" || status == "refuser")
                            ? Icons.cancel
                            : (status == "en_attente")
                                ? Icons.access_time
                                : Icons.help_outline,
                    color: Colors.white,
                    size: 10,
                  ),
                ),
              ),
            ),
            const SizedBox(width: 15),

            // --- INFOS CENTRALES ---
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    title,
                    style: GoogleFonts.poppins(
                      fontWeight: FontWeight.w600,
                      fontSize: 14,
                    ),
                    maxLines: 1,
                    overflow: TextOverflow.ellipsis,
                  ),
                  Row(
                    children: [
                      Text(date,
                          style: GoogleFonts.poppins(
                              fontSize: 12, color: Colors.grey)),
                      const SizedBox(width: 8),
                      Container(
                          width: 3,
                          height: 3,
                          decoration: const BoxDecoration(
                              color: Colors.grey, shape: BoxShape.circle)),
                      const SizedBox(width: 8),
                      const Icon(Icons.visibility_outlined,
                          size: 12, color: Colors.grey),
                      const SizedBox(width: 4),
                      Text(views,
                          style: GoogleFonts.poppins(
                              fontSize: 12, color: Colors.grey)),
                    ],
                  ),
                ],
              ),
            ),

            // --- MONTANT & BOUTON PARTAGE ---
            Column(
              crossAxisAlignment: CrossAxisAlignment.end,
              children: [
                Text(
                  amount,
                  style: GoogleFonts.poppins(
                    fontWeight: FontWeight.bold,
                    fontSize: 14,
                    color: (status == "approuver")
                        ? Colors.green
                        : (status == "echouer" || status == "refuser")
                            ? Colors.red
                            : (status == "en_attente")
                                ? Colors.orange
                                : null,
                  ),
                ),
                const SizedBox(height: 5),
                // Bouton de partage compact avec Spinner

                Container(
                  padding:
                      const EdgeInsets.symmetric(horizontal: 8, vertical: 4),
                  decoration: BoxDecoration(
                    color: statusConfig["color"].withOpacity(0.15),
                    borderRadius: BorderRadius.circular(8),
                  ),
                  child: Row(
                    mainAxisSize: MainAxisSize.min,
                    children: [
                      Icon(
                        statusConfig["icon"],
                        size: 12,
                        color: statusConfig["color"],
                      ),
                      const SizedBox(width: 4),
                      Text(
                        statusConfig["label"],
                        style: GoogleFonts.poppins(
                          fontSize: 10,
                          fontWeight: FontWeight.bold,
                          color: statusConfig["color"],
                        ),
                      ),
                    ],
                  ),
                ),
              ],
            ),
          ],
        ),
      ),
    );
  }

  Map<String, dynamic> getStatusBadgeConfig(String status) {
    switch (status) {
      case "en_attente":
        return {
          "label": "Attente validation",
          "icon": Icons.access_time,
          "color": Colors.orange,
        };
      case "terminer":
        return {
          "label": "Preuves requises",
          "icon": Icons.check_circle,
          "color": Colors.green,
        };
      case "echouer":
        return {
          "label": "Échoué",
          "icon": Icons.cancel,
          "color": Colors.red,
        };
      case "refuser":
        return {
          "label": "Refusé",
          "icon": Icons.cancel,
          "color": Colors.red,
        };
      case "approuver":
        return {
          "label": "Approuvé",
          "icon": Icons.verified,
          "color": Colors.green,
        };
      case "en_cours":
        return {
          "label": "En cours",
          "icon": Icons.sync,
          "color": Colors.blue,
        };
      default:
        return {
          "label": "Inconnu",
          "icon": Icons.help_outline,
          "color": Colors.grey,
        };
    }
  }
}
