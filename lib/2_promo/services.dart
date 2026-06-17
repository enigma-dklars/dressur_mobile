// ignore_for_file: unused_import

import 'dart:async';
import 'dart:convert';
import 'package:dressur/2_promo/liste_promo_reseau_sociaux.dart';
import 'package:dressur/2_promo/new_promo_reseau_sociaux.dart';
import 'package:dressur/components/noti.dart';
import 'package:dressur/components/padding_and_divider.dart';
import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/2_promo/liste_promo_affaire.dart';
import 'package:dressur/2_promo/liste_boost_contact.dart';
import 'package:dressur/2_promo/new_boost_contact.dart';
import 'package:dressur/2_promo/new_promo_affaire.dart';
import 'package:dressur/5_autre/support_assistance.dart';
import 'package:dressur/1_reception/liste_notification.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/sociaux.dart';
import 'package:http/http.dart' as http;

class BoostPage extends StatefulWidget {
  @override
  State<BoostPage> createState() => _BoostPageState();
}

class _BoostPageState extends State<BoostPage> {

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
          final d = jsonDecode(results[0].body);
          if (d is List) nbrBoostContact = d.length;
        }
        if (results[1].statusCode == 200) {
          final d = jsonDecode(results[1].body);
          if (d is List) nbrPromoAffaire = d.length;
        }
        if (results[2].statusCode == 200) {
          final d = jsonDecode(results[2].body);
          if (d is List) nbrPromoReseau = d.length;
        }
      });
    } catch (_) {}
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        automaticallyImplyLeading: false,
        elevation: 0,
        backgroundColor: primaryColor,
        title: Text(
          "Services",
          style: GoogleFonts.poppins(
            color: Colors.white,
            fontWeight: FontWeight.w400,
            fontSize: 18,
          ),
        ),
        actions: [
          IconButton(
            icon: const FaIcon(FontAwesomeIcons.solidBell, size: 20),
            color: Colors.white,
            onPressed: () => Navigator.push(context,
                MaterialPageRoute(builder: (_) => ListeNotification())),
          ),
          const Padding(
            padding: EdgeInsets.fromLTRB(0, 10, 0, 10),
            child: VerticalDivider(width: 0, color: Colors.white, thickness: 1),
          ),
          PopupMenuButton<dynamic>(
            itemBuilder: (context) => [
              PopupMenuItem(
                value: 1,
                child: Text(
                  (langUserPhone == "fr") ? "Aide" : "Help",
                  style: GoogleFonts.poppins(
                      color: Colors.white, fontWeight: FontWeight.w600),
                ),
              ),
            ],
            offset: const Offset(0, 60),
            color: primaryColor,
            icon: const FaIcon(FontAwesomeIcons.bars, color: Colors.white, size: 20),
            elevation: 2,
            onSelected: (value) {
              if (value == 1) {
                Navigator.push(context,
                    MaterialPageRoute(builder: (_) => SupportPage()));
              }
            },
          ),
        ],
      ),
      body: RefreshIndicator(
        onRefresh: _fetchCounts,
        color: primaryColor,
        child: SingleChildScrollView(
          physics: const AlwaysScrollableScrollPhysics(),
          child: Column(
            children: [
              const SizedBox(height: 10),
              _buildStatsBanner(),
              const SizedBox(height: 14),
              if (addPageActu)
                _buildServiceTile(
                  context: context,
                  icon: FontAwesomeIcons.addressBook,
                  title: "Boost Contact",
                  count: nbrBoostContact,
                  accentColor: const Color(0xFF1565C0),
                  newLabel: (langUserPhone == "fr") ? "Nouveau boost" : "New boost",
                  listLabel: (langUserPhone == "fr") ? "Voir la liste" : "See list",
                  onNew: () => Navigator.push(context,
                      MaterialPageRoute(builder: (_) => NewBoostContactPage())),
                  onList: () => Navigator.push(context,
                      MaterialPageRoute(builder: (_) => ListeBoostContactPage())),
                ),
              if (addPageActu) const SizedBox(height: 10),
              _buildServiceTile(
                context: context,
                icon: FontAwesomeIcons.store,
                title: (langUserPhone == "fr") ? "Promo Affaire" : "Business Promo",
                count: nbrPromoAffaire,
                accentColor: const Color(0xFF2E7D32),
                newLabel: (langUserPhone == "fr") ? "Nouvelle promo" : "New promo",
                listLabel: (langUserPhone == "fr") ? "Voir la liste" : "See list",
                onNew: () => Navigator.push(context,
                    MaterialPageRoute(builder: (_) => PromotionFormPage())),
                onList: () => Navigator.push(context,
                    MaterialPageRoute(builder: (_) => PromotionListPage())),
              ),
              if (mailIsMaxxFire == false) ...[
                const SizedBox(height: 10),
                _buildServiceTile(
                  context: context,
                  icon: FontAwesomeIcons.chartLine,
                  title: (langUserPhone == "fr")
                      ? "Promo Réseau Sociaux"
                      : "Social Network Promo",
                  count: nbrPromoReseau,
                  accentColor: const Color(0xFF6A1B9A),
                  newLabel: (langUserPhone == "fr") ? "Démarrer" : "Start",
                  listLabel: (langUserPhone == "fr") ? "Voir la liste" : "See list",
                  onNew: () => Navigator.push(
                      context,
                      MaterialPageRoute(
                          builder: (_) => PromotionReseauSociauxFormPage())),
                  onList: () => Navigator.push(
                      context,
                      MaterialPageRoute(
                          builder: (_) => PromotionReseauSociauxListePage())),
                ),
              ],
              if (!addPageActu) ...[
                const SizedBox(height: 10),
                _buildServiceTile(
                  context: context,
                  icon: FontAwesomeIcons.addressBook,
                  title: "Boost Contact",
                  count: nbrBoostContact,
                  accentColor: const Color(0xFF1565C0),
                  newLabel: (langUserPhone == "fr") ? "Nouveau boost" : "New boost",
                  listLabel: (langUserPhone == "fr") ? "Voir la liste" : "See list",
                  onNew: () => Navigator.push(context,
                      MaterialPageRoute(builder: (_) => NewBoostContactPage())),
                  onList: () => Navigator.push(context,
                      MaterialPageRoute(builder: (_) => ListeBoostContactPage())),
                ),
              ],
              const SizedBox(height: 14),
              SociauxPage(),
              const SizedBox(height: 10),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildStatsBanner() {
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
      child: Row(
        children: [
          Expanded(
            child: _buildStatCell(
              icon: FontAwesomeIcons.addressBook,
              label: "Boost Contact",
              value: "$nbrBoostContact",
            ),
          ),
          Container(height: 50, width: 1, color: Colors.white24,
              margin: const EdgeInsets.symmetric(horizontal: 4)),
          Expanded(
            child: _buildStatCell(
              icon: FontAwesomeIcons.store,
              label: (langUserPhone == "fr") ? "Promo Affaire" : "Biz Promo",
              value: "$nbrPromoAffaire",
            ),
          ),
          Container(height: 50, width: 1, color: Colors.white24,
              margin: const EdgeInsets.symmetric(horizontal: 4)),
          Expanded(
            child: _buildStatCell(
              icon: FontAwesomeIcons.chartLine,
              label: (langUserPhone == "fr") ? "Promo Réseau" : "Social Promo",
              value: "$nbrPromoReseau",
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildStatCell({
    required IconData icon,
    required String label,
    required String value,
  }) {
    return Column(
      mainAxisSize: MainAxisSize.min,
      children: [
        FaIcon(icon, color: Colors.white70, size: 18),
        const SizedBox(height: 6),
        Text(
          value,
          style: GoogleFonts.poppins(
            color: Colors.white,
            fontWeight: FontWeight.w700,
            fontSize: 14,
          ),
          textAlign: TextAlign.center,
        ),
        const SizedBox(height: 2),
        Text(
          label,
          style: GoogleFonts.poppins(color: Colors.white60, fontSize: 11),
          textAlign: TextAlign.center,
          maxLines: 1,
          overflow: TextOverflow.ellipsis,
        ),
      ],
    );
  }

  Widget _buildServiceTile({
    required BuildContext context,
    required IconData icon,
    required String title,
    required int count,
    required Color accentColor,
    required String newLabel,
    required String listLabel,
    required VoidCallback onNew,
    required VoidCallback onList,
  }) {
    final isDark = Theme.of(context).brightness == Brightness.dark;

    return Container(
      margin: const EdgeInsets.symmetric(horizontal: 10),
      padding: const EdgeInsets.fromLTRB(14, 14, 14, 14),
      decoration: BoxDecoration(
        color: isDark ? const Color(0xFF1E1E1E) : Colors.white,
        borderRadius: BorderRadius.circular(15),
        border: Border.all(
            color: isDark ? Colors.grey[800]! : Colors.grey[200]!, width: 1),
        boxShadow: [
          BoxShadow(
            color: isDark
                ? Colors.black.withOpacity(0.15)
                : Colors.grey.withOpacity(0.08),
            blurRadius: 8,
            offset: const Offset(0, 3),
          ),
        ],
      ),
      child: Column(
        children: [
          Row(
            children: [
              Container(
                padding: const EdgeInsets.all(10),
                decoration: BoxDecoration(
                  color: accentColor.withOpacity(0.1),
                  borderRadius: BorderRadius.circular(12),
                ),
                child: FaIcon(icon, color: accentColor, size: 22),
              ),
              const SizedBox(width: 12),
              Expanded(
                child: Text(
                  title,
                  style: GoogleFonts.poppins(
                    color: isDark ? Colors.white : Colors.black87,
                    fontWeight: FontWeight.w600,
                    fontSize: 16,
                  ),
                ),
              ),
              Container(
                padding:
                    const EdgeInsets.symmetric(horizontal: 10, vertical: 4),
                decoration: BoxDecoration(
                  color: accentColor.withOpacity(0.12),
                  borderRadius: BorderRadius.circular(20),
                ),
                child: Text(
                  "$count",
                  style: GoogleFonts.poppins(
                    color: accentColor,
                    fontWeight: FontWeight.w700,
                    fontSize: 13,
                  ),
                ),
              ),
            ],
          ),
          const SizedBox(height: 12),
          Row(
            children: [
              Expanded(
                child: ElevatedButton.icon(
                  onPressed: onNew,
                  icon: const FaIcon(FontAwesomeIcons.plus, size: 13),
                  label: Text(
                    newLabel,
                    style: GoogleFonts.poppins(
                        fontWeight: FontWeight.w600, fontSize: 13),
                  ),
                  style: ElevatedButton.styleFrom(
                    backgroundColor: accentColor,
                    foregroundColor: Colors.white,
                    padding: const EdgeInsets.symmetric(vertical: 11),
                    shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(10)),
                    elevation: 1,
                  ),
                ),
              ),
              const SizedBox(width: 10),
              Expanded(
                child: OutlinedButton.icon(
                  onPressed: onList,
                  icon: FaIcon(FontAwesomeIcons.listUl,
                      size: 13, color: accentColor),
                  label: Text(
                    listLabel,
                    style: GoogleFonts.poppins(
                        fontWeight: FontWeight.w600,
                        fontSize: 13,
                        color: accentColor),
                  ),
                  style: OutlinedButton.styleFrom(
                    side: BorderSide(color: accentColor.withOpacity(0.5)),
                    padding: const EdgeInsets.symmetric(vertical: 11),
                    shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(10)),
                  ),
                ),
              ),
            ],
          ),
        ],
      ),
    );
  }
}
