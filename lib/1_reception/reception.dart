import 'dart:convert';
import 'dart:math';

import 'package:dressur/1_reception/liste_contact.dart';
import 'package:dressur/1_reception/synchronisation_avance.dart';
import 'package:dressur/1_reception/recompense_dashboard.dart';
import 'package:dressur/1_reception/recompense_start.dart';
import 'package:dressur/components/sociaux.dart';
import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/5_autre/support_assistance.dart';
import 'package:dressur/6_assistant/assistant_page.dart';
import 'package:dressur/1_reception/liste_notification.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/notification_bell.dart';
import 'package:dressur/8_admin/admin.dart';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';

class ReceptionPage extends StatefulWidget {
  @override
  State<ReceptionPage> createState() => _ReceptionPageState();
}

class _ReceptionPageState extends State<ReceptionPage> {
  int _notifCount = 0;   // nombre de notifs non vues
  int _totalNotifs = 0;  // total actuel renvoyé par l'API

  static const _prefKey = 'notif_last_seen_total';

  @override
  void initState() {
    super.initState();
    _loadNotifCount();
  }

  // ── Récupère le total de notifs et calcule le badge ──────────────────────
  Future<void> _loadNotifCount() async {
    try {
      final response = await http.post(
        Uri.parse('$generalRouteForApi/getNotifications'),
        body: {'uid': '$uidUser'},
      ).timeout(const Duration(seconds: 10));

      final body = jsonDecode(response.body) as Map<String, dynamic>;
      if (body['error'] == true) return;

      final List<dynamic> raw = body['notifications'] ?? [];
      final total = raw.length;

      final prefs = await SharedPreferences.getInstance();
      final lastSeen = prefs.getInt(_prefKey) ?? 0;
      final unseen = max(0, total - lastSeen);

      if (!mounted) return;
      setState(() {
        _totalNotifs = total;
        _notifCount = unseen;
      });
    } catch (_) {}
  }

  // ── Marque toutes les notifs comme vues ──────────────────────────────────
  Future<void> _markAsSeen() async {
    try {
      final prefs = await SharedPreferences.getInstance();
      await prefs.setInt(_prefKey, _totalNotifs);
    } catch (_) {}
    if (!mounted) return;
    setState(() => _notifCount = 0);
  }

  // ── Ouvre la page notifs puis remet le badge à 0 ─────────────────────────
  void _openNotifications(BuildContext context) {
    Navigator.push(
      context,
      MaterialPageRoute(builder: (_) => ListeNotification()),
    ).then((_) => _markAsSeen());
  }

  @override
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
            if (admin) ...[
              IconButton(
                icon: const FaIcon(FontAwesomeIcons.userShield,
                    size: 20, color: Colors.amber),
                onPressed: () => Navigator.push(context,
                    MaterialPageRoute(builder: (_) => AdministrationPage())),
              ),
              const Padding(
                padding: EdgeInsets.fromLTRB(0, 10, 0, 10),
                child: VerticalDivider(
                    width: 0, color: Colors.white, thickness: 1),
              ),
            ],
            // ── Cloche avec badge ─────────────────────────────────────────
            const NotificationBellAction(),
            const Padding(
              padding: EdgeInsets.fromLTRB(0, 10, 0, 10),
              child: VerticalDivider(
                width: 0,
                color: Colors.white,
                thickness: 1,
              ),
            ),
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
                PopupMenuItem(
                  value: 2,
                  child: Row(
                    children: [
                      Text(
                        (langUserPhone == "fr") ? "Assistant IA" : "AI Assistant",
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
                } else if (value == 2) {
                  Navigator.push(
                    context,
                    MaterialPageRoute(builder: (_) => const AssistantPage()),
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
                icon: FontAwesomeIcons.solidAddressBook,
                title: "Contacts",
                subtitle: (langUserPhone == "fr")
                    ? "Gérez vos contacts ajoutés"
                    : "Manage your added contacts",
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
                icon: FontAwesomeIcons.trophy,
                title: (langUserPhone == "fr") ? "Récompenses" : "Rewards",
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
                icon: FontAwesomeIcons.arrowsRotate,
                title: (langUserPhone == "fr")
                    ? "Synchronisation avancée"
                    : "Advanced synchronization",
                subtitle: (langUserPhone == "fr")
                    ? "Synchronisez vos contacts avec votre téléphone"
                    : "Sync your contacts with your phone",
                onTap: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(
                        builder: (context) => const SynchroAvance()),
                  );
                },
              ),
              const SizedBox(height: 10),
              // ── Item Notifications avec badge ─────────────────────────
              _buildNavigationItem(
                context: context,
                icon: FontAwesomeIcons.solidBell,
                title: "Notifications",
                subtitle: (langUserPhone == "fr")
                    ? "Cadeaux, astuces, recommandations..."
                    : "Gifts, tips, recommendations...",
                badge: _notifCount,
                onTap: () => _openNotifications(context),
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
    int badge = 0,
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
            // ── Icône avec badge optionnel ──────────────────────────────
            Stack(
              clipBehavior: Clip.none,
              children: [
                Container(
                  padding: EdgeInsets.all(12),
                  decoration: BoxDecoration(
                    color: primaryColor.withOpacity(0.1),
                    borderRadius: BorderRadius.circular(14),
                  ),
                  child: FaIcon(icon, color: primaryColor, size: 26),
                ),
                if (badge > 0)
                  Positioned(
                    top: -4,
                    right: -4,
                    child: Container(
                      padding: const EdgeInsets.symmetric(horizontal: 3),
                      constraints:
                          const BoxConstraints(minWidth: 18, minHeight: 18),
                      decoration: const BoxDecoration(
                        color: Colors.red,
                        shape: BoxShape.circle,
                      ),
                      alignment: Alignment.center,
                      child: Text(
                        badge > 99 ? '99+' : '$badge',
                        style: const TextStyle(
                          color: Colors.white,
                          fontSize: 10,
                          fontWeight: FontWeight.bold,
                          height: 1,
                        ),
                        textAlign: TextAlign.center,
                      ),
                    ),
                  ),
              ],
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
