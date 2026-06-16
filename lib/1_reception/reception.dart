import 'dart:async';
import 'dart:convert';
import 'package:dressur/1_reception/liste_contact.dart';
import 'package:dressur/1_reception/recompense_dashboard.dart';
import 'package:dressur/1_reception/recompense_start.dart';
import 'package:dressur/components/padding_and_divider.dart';
import 'package:dressur/components/sociaux.dart';
import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/5_autre/support_assistance.dart';
import 'package:dressur/1_reception/liste_notification.dart';
import 'package:dressur/components/constant.dart';
import 'package:http/http.dart' as http;

class ReceptionPage extends StatefulWidget {
  @override
  State<ReceptionPage> createState() => _ReceptionPageState();
}

class _ReceptionPageState extends State<ReceptionPage> {

  @override
  void initState() {
    super.initState();
    _fetchCounts();
  }

  Future<void> _fetchCounts() async {
    try {
      final results = await Future.wait([
        http.get(Uri.parse('$generalRouteForApi/listBoost/$uidUser/$langUserPhone')),
        http.get(Uri.parse('$generalRouteForApi/listPromotion/$uidUser/$langUserPhone')),
        http.get(Uri.parse('$generalRouteForApi/listPromoReseau/$uidUser/$langUserPhone')),
      ]);

      if (!mounted) return;

      setState(() {
        if (results[0].statusCode == 200) {
          final data = jsonDecode(results[0].body);
          if (data is List) nbrBoostContact = data.length;
        }
        if (results[1].statusCode == 200) {
          final data = jsonDecode(results[1].body);
          if (data is List) nbrPromoAffaire = data.length;
        }
        if (results[2].statusCode == 200) {
          final data = jsonDecode(results[2].body);
          if (data is List) nbrPromoReseau = data.length;
        }
      });
    } catch (_) {}
  }

  Widget build(BuildContext context) {
    return Scaffold(
        appBar: AppBar(
          automaticallyImplyLeading: false,
          elevation: 0,
          backgroundColor: primaryColor,
          title: Text(
            (langUserPhone == "fr") ? "Boîte de Réception" : "Inbox",
            style: GoogleFonts.poppins(
              color: Colors.white,
              fontWeight: FontWeight.w400,
              fontSize: 18,
            ),
          ),
          actions: [
            PopupMenuButton<dynamic>(
              itemBuilder: (context) => [
                PopupMenuItem(
                  value: 1,
                  child: Row(
                    children: [
                      Text(
                        (langUserPhone == "fr") ? "Aide" : "Help",
                        style: GoogleFonts.poppins(
                          color: Colors.white,
                          fontWeight: FontWeight.w600,
                        ),
                      ),
                    ],
                  ),
                ),
              ],
              offset: const Offset(0, 60),
              color: primaryColor,
              icon: const FaIcon(
                FontAwesomeIcons.bars,
                color: Colors.white,
                size: 20,
              ),
              elevation: 2,
              onSelected: (value) {
                if (value == 1) {
                  Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) => SupportPage()),
                  );
                }
              },
            ),
          ],
        ),
        body: SingleChildScrollView(
          child: Column(
            children: [
              const SizedBox(height: 10),
              _buildSummaryBanner(context),
              const SizedBox(height: 10),
              _buildNavigationItem(
                context: context,
                icon: FontAwesomeIcons.trophy,
                title: "Récompenses",
                subtitle: (langUserPhone == "fr")
                    ? "Gagnez et suivez vos récompenses"
                    : "Earn and track your rewards",
                onTap: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(
                      builder: (context) => isInscritProgrammeRecompense
                          ? ProgrammeRecompenseDashboard()
                          : ProgrammeRecompensePage(optionPage: false),
                    ),
                  );
                },
              ),
              const SizedBox(height: 10),
              _buildNavigationItem(
                context: context,
                icon: FontAwesomeIcons.solidAddressBook,
                title: "Contacts",
                subtitle: (langUserPhone == "fr")
                    ? "Gérez vos contacts ajoutés et scannés"
                    : "Manage your added and scanned contacts",
                onTap: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) => ContactPage()),
                  );
                },
              ),
              const SizedBox(height: 10),
              _buildNavigationItem(
                context: context,
                icon: FontAwesomeIcons.solidBell,
                title: "Notifications",
                subtitle: (langUserPhone == "fr")
                    ? "Cadeaux, astuces, recommandations..."
                    : "Gifts, tips, recommendations...",
                onTap: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(
                        builder: (context) => ListeNotification()),
                  );
                },
              ),
              const SizedBox(height: 10),
              SociauxPage(),
              const SizedBox(height: 10),
            ],
          ),
        ),
    );
  }

  Widget _buildSummaryBanner(BuildContext context) {
    return Container(
      margin: const EdgeInsets.symmetric(horizontal: 10),
      padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 14),
      decoration: BoxDecoration(
        gradient: LinearGradient(
          colors: [primaryColor, primaryColor.withOpacity(0.75)],
          begin: Alignment.topLeft,
          end: Alignment.bottomRight,
        ),
        borderRadius: BorderRadius.circular(16),
        boxShadow: [
          BoxShadow(
            color: primaryColor.withOpacity(0.35),
            blurRadius: 12,
            offset: const Offset(0, 4),
          ),
        ],
      ),
      child: Column(
        children: [
          // ── Ligne 1 : Solde FCFA · Contacts · Boost ──
          Row(
            children: [
              Expanded(
                child: _buildSummaryCell(
                  icon: FontAwesomeIcons.trophy,
                  label: (langUserPhone == "fr") ? "Solde FCFA" : "Balance",
                  value: isInscritProgrammeRecompense
                      ? "${soldeProgrammeRecompense ?? 0} FCFA"
                      : (langUserPhone == "fr") ? "Non inscrit" : "Not enrolled",
                ),
              ),
              _buildVerticalDivider(),
              Expanded(
                child: _buildSummaryCell(
                  icon: FontAwesomeIcons.solidAddressBook,
                  label: (langUserPhone == "fr") ? "Contacts" : "Contacts",
                  value: "$nombreContacts",
                ),
              ),
              _buildVerticalDivider(),
              Expanded(
                child: _buildSummaryCell(
                  icon: boostEnCours
                      ? FontAwesomeIcons.rocket
                      : FontAwesomeIcons.circleStop,
                  label: "Boost",
                  value: boostEnCours
                      ? (langUserPhone == "fr") ? "En cours" : "Active"
                      : (langUserPhone == "fr") ? "Inactif" : "Inactive",
                  valueColor: boostEnCours ? Colors.greenAccent : Colors.white60,
                ),
              ),
            ],
          ),
          const SizedBox(height: 12),
          Container(height: 1, color: Colors.white24),
          const SizedBox(height: 12),
          // ── Ligne 2 : Boost Contact · Promo Affaire · Promo Réseau ──
          Row(
            children: [
              Expanded(
                child: _buildSummaryCell(
                  icon: FontAwesomeIcons.userPlus,
                  label: (langUserPhone == "fr") ? "Boost contact" : "Boost contact",
                  value: "$nbrBoostContact",
                ),
              ),
              _buildVerticalDivider(),
              Expanded(
                child: _buildSummaryCell(
                  icon: FontAwesomeIcons.briefcase,
                  label: (langUserPhone == "fr") ? "Promo affaire" : "Business promo",
                  value: "$nbrPromoAffaire",
                ),
              ),
              _buildVerticalDivider(),
              Expanded(
                child: _buildSummaryCell(
                  icon: FontAwesomeIcons.shareNodes,
                  label: (langUserPhone == "fr") ? "Promo réseau" : "Network promo",
                  value: "$nbrPromoReseau",
                ),
              ),
            ],
          ),
        ],
      ),
    );
  }

  Widget _buildSummaryCell({
    required IconData icon,
    required String label,
    required String value,
    Color? valueColor,
  }) {
    return Column(
      mainAxisSize: MainAxisSize.min,
      children: [
        FaIcon(icon, color: Colors.white70, size: 18),
        const SizedBox(height: 6),
        Text(
          value,
          style: GoogleFonts.poppins(
            color: valueColor ?? Colors.white,
            fontWeight: FontWeight.w700,
            fontSize: 14,
          ),
          textAlign: TextAlign.center,
          maxLines: 1,
          overflow: TextOverflow.ellipsis,
        ),
        const SizedBox(height: 2),
        Text(
          label,
          style: GoogleFonts.poppins(
            color: Colors.white60,
            fontSize: 11,
          ),
          textAlign: TextAlign.center,
          maxLines: 1,
          overflow: TextOverflow.ellipsis,
        ),
      ],
    );
  }

  Widget _buildVerticalDivider() {
    return Container(
      height: 50,
      width: 1,
      color: Colors.white24,
      margin: const EdgeInsets.symmetric(horizontal: 4),
    );
  }

  Widget _buildNavigationItem({
    required BuildContext context,
    required IconData icon,
    required String title,
    required String subtitle,
    required VoidCallback onTap,
  }) {
    final theme = Theme.of(context);
    final isDark = theme.brightness == Brightness.dark;

    return GestureDetector(
      onTap: onTap,
      child: Container(
        margin: const EdgeInsets.symmetric(horizontal: 10, vertical: 0),
        padding: const EdgeInsets.symmetric(horizontal: 15, vertical: 12),
        decoration: BoxDecoration(
          color: isDark ? Color(0xFF1E1E1E) : Colors.white,
          borderRadius: BorderRadius.circular(15),
          border: Border.all(
              color: isDark ? Colors.grey[800]! : Colors.grey[200]!, width: 1),
          boxShadow: [
            BoxShadow(
              color: isDark
                  ? Colors.black.withOpacity(0.15)
                  : Colors.grey.withOpacity(0.08),
              blurRadius: 8,
              offset: Offset(0, 3),
            ),
          ],
        ),
        child: Row(
          children: [
            Container(
              padding: EdgeInsets.all(12),
              decoration: BoxDecoration(
                color: primaryColor.withOpacity(0.1),
                borderRadius: BorderRadius.circular(14),
              ),
              child: FaIcon(icon, color: primaryColor, size: 26),
            ),
            SizedBox(width: 16),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    title,
                    style: GoogleFonts.poppins(
                      color: isDark ? Colors.white : Colors.black87,
                      fontWeight: FontWeight.w600,
                      fontSize: 17,
                    ),
                  ),
                  SizedBox(height: 3),
                  Text(
                    subtitle,
                    style: GoogleFonts.poppins(
                      color: isDark ? Colors.grey[400] : Colors.grey[600],
                      fontSize: 13,
                    ),
                    maxLines: 1,
                    overflow: TextOverflow.ellipsis,
                  ),
                ],
              ),
            ),
            SizedBox(width: 8),
            FaIcon(
              FontAwesomeIcons.chevronRight,
              color: isDark ? Colors.grey[600] : Colors.grey[400],
              size: 18,
            ),
          ],
        ),
      ),
    );
  }
}
