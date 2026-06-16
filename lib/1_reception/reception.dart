import 'dart:async';
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

class ReceptionPage extends StatefulWidget {
  @override
  State<ReceptionPage> createState() => _ReceptionPageState();
}

class _ReceptionPageState extends State<ReceptionPage> {

  @override
  void initState() {
    super.initState();
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
      ),
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
            // --- Icône stylisée ---
            Container(
              padding: EdgeInsets.all(12),
              decoration: BoxDecoration(
                color: primaryColor.withOpacity(0.1),
                borderRadius: BorderRadius.circular(14),
              ),
              child: FaIcon(icon, color: primaryColor, size: 26),
            ),
            SizedBox(width: 16),

            // --- Textes ---
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

            // --- Flèche de navigation ---
            FaIcon(
              FontAwesomeIcons.chevronRight,
              color: isDark ? Colors.grey[600] : Colors.grey[400],
              size: 18,
            ),
          ],
        ),
    );
  }
}
