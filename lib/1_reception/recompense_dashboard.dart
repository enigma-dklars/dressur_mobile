// ignore_for_file: prefer_const_constructors, prefer_const_literals_to_create_immutables

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
  @override
  Widget build(BuildContext context) {
    final theme = Theme.of(context);
    final isDark = theme.brightness == Brightness.dark;

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
                      _statItem(context, "Vues Totales", "12.5K",
                          Icons.visibility, Colors.blue, theme),
                      SizedBox(width: 15),
                      _statItem(context, "Gains retirés", "8 500 F",
                          Icons.account_balance_wallet, Colors.green, theme),
                    ],
                  ),

                  SizedBox(height: 10),

                  // 4. PROMOTIONS EN COURS
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      _sectionTitle(context, "Promotions en cours"),
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
                  // On affiche une seule promotion comme demandé
                  _activePromotionCard(context, "Promotion iPhone 15 Pro",
                      "Soumission dans 04h 22m", 0.8, Colors.orange, theme),

                  SizedBox(height: 10),

                  // 5. HISTORIQUE RÉCENT
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      _sectionTitle(context, "Historique récent"),
                      TextButton(
                        onPressed: () {
                          // Action pour voir tout l'historique
                        },
                        child: Text("Voir tout",
                            style: GoogleFonts.poppins(
                                color: primaryColor, fontSize: 12)),
                      )
                    ],
                  ),
                  // On affiche trois éléments d'historique comme demandé
                  _historyItem(context, "Vente Flash Chaussures", "500 FCFA",
                      "12 Janv", "1.2K vues", true),
                  _historyItem(context, "Promo Restaurant Le Gourmet",
                      "200 FCFA", "10 Janv", "850 vues", true),
                  _historyItem(context, "Lancement App Dressur", "En attente",
                      "Hier", "420 vues", false),

                  SizedBox(height: 40),
                ],
              ),
            ),
          ],
        ),
      ),
      // BOUTON FLOTTANT POUR AJOUTER UNE PROMO
      floatingActionButton: FloatingActionButton.extended(
        onPressed: () {
          // Navigation vers la liste des promotions éligibles
        },
        backgroundColor: primaryColor,
        icon: Icon(Icons.add, color: Colors.white),
        label: Text("Nouvelle Promo",
            style: GoogleFonts.poppins(
                color: Colors.white, fontWeight: FontWeight.w600)),
      ),
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
          // Action pour voir les promotions affaire
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
                "3 450 FCFA",
                style: GoogleFonts.poppins(
                  color: Colors.white,
                  fontSize: 32,
                  fontWeight: FontWeight.bold,
                ),
              ),
              ElevatedButton(
                style: ElevatedButton.styleFrom(
                  backgroundColor: Colors.white,
                  foregroundColor: primaryColor,
                  elevation: 0,
                  shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(15)),
                  padding: EdgeInsets.symmetric(horizontal: 20, vertical: 10),
                ),
                onPressed: () {
                  // Action de retrait
                },
                child: Text("Retirer",
                    style: GoogleFonts.poppins(fontWeight: FontWeight.bold)),
              ),
            ],
          ),
          SizedBox(height: 20),
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

  Widget _activePromotionCard(BuildContext context, String title,
      String timeLeft, double progress, Color color, theme) {
    final isDark = Theme.of(context).brightness == Brightness.dark;
    return Container(
      padding: EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: isDark ? Colors.white.withOpacity(0.05) : Colors.white,
        borderRadius: BorderRadius.circular(15),
        boxShadow: isDark
            ? []
            : [
                BoxShadow(
                    color: Colors.black.withOpacity(0.05),
                    blurRadius: 10,
                    offset: Offset(0, 4))
              ],
        border: Border.all(color: theme.dividerColor.withOpacity(0.1)),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              Container(
                padding: EdgeInsets.all(10),
                decoration: BoxDecoration(
                    color: color.withOpacity(0.1),
                    borderRadius: BorderRadius.circular(10)),
                child: Icon(Icons.campaign, color: color),
              ),
              SizedBox(width: 15),
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(title,
                        style: GoogleFonts.poppins(
                            fontWeight: FontWeight.bold, fontSize: 14)),
                    Text(timeLeft,
                        style: GoogleFonts.poppins(
                            fontSize: 12,
                            color: color,
                            fontWeight: FontWeight.w500)),
                  ],
                ),
              ),
            ],
          ),
        ],
      ),
    );
  }

  Widget _historyItem(BuildContext context, String title, String amount,
      String date, String views, bool isValidated) {
    final isDark = Theme.of(context).brightness == Brightness.dark;
    return Padding(
      padding: const EdgeInsets.only(bottom: 15),
      child: Row(
        children: [
          Container(
            width: 45,
            height: 45,
            decoration: BoxDecoration(
              color: isValidated
                  ? Colors.green.withOpacity(0.1)
                  : Colors.orange.withOpacity(0.1),
              shape: BoxShape.circle,
            ),
            child: Icon(
              isValidated ? Icons.check : Icons.access_time,
              color: isValidated ? Colors.green : Colors.orange,
              size: 20,
            ),
          ),
          SizedBox(width: 15),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(title,
                    style: GoogleFonts.poppins(
                        fontWeight: FontWeight.w600, fontSize: 14)),
                Row(
                  children: [
                    Text(date,
                        style: GoogleFonts.poppins(
                            fontSize: 12, color: Colors.grey)),
                    SizedBox(width: 8),
                    Container(
                      width: 3,
                      height: 3,
                      decoration: BoxDecoration(
                          color: Colors.grey, shape: BoxShape.circle),
                    ),
                    SizedBox(width: 8),
                    Icon(Icons.visibility_outlined,
                        size: 12, color: Colors.grey),
                    SizedBox(width: 4),
                    Text(views,
                        style: GoogleFonts.poppins(
                            fontSize: 12, color: Colors.grey)),
                  ],
                ),
              ],
            ),
          ),
          Text(
            amount,
            style: GoogleFonts.poppins(
              fontWeight: FontWeight.bold,
              fontSize: 14,
              color: isValidated ? Colors.green : Colors.orange,
            ),
          ),
        ],
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
}
