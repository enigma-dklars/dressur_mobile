// ignore_for_file: use_build_context_synchronously, prefer_const_constructors

import 'package:dressur/5_autre/suggestions.dart';
import 'package:dressur/5_autre/supprimer_contacts_ds.dart';
import 'package:dressur/components/sociaux.dart';
import 'package:flutter/material.dart';
import 'package:dressur/8_admin/admin.dart';
import 'package:dressur/5_autre/a_propos_ds.dart';
import 'package:dressur/5_autre/delete_compte_user.dart';
import 'package:dressur/5_autre/modifier_mot_de_passe.dart';
import 'package:dressur/5_autre/profil_user.dart';
import 'package:dressur/5_autre/signaler_user.dart';
import 'package:dressur/1_reception/liste_notification.dart';
import 'package:dressur/7_demarage/presentation_ds.dart';
import 'package:dressur/5_autre/support_assistance.dart';
import 'package:dressur/6_assistant/assistant_page.dart';
import 'package:art_sweetalert/art_sweetalert.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/sql_helper.dart';
import 'package:dressur/main.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';

class SettingPage extends StatefulWidget {
  SettingPage({Key? key}) : super(key: key);

  @override
  State<SettingPage> createState() => _SettingPageState();
}

class _SettingPageState extends State<SettingPage> {
  Future<void> _setTheme(ThemeMode mode) async {
    MyApp.themeNotifier.value = mode;
    final prefs = await SharedPreferences.getInstance();
    final key = mode == ThemeMode.light
        ? 'light'
        : mode == ThemeMode.dark
            ? 'dark'
            : 'system';
    await prefs.setString('themeMode', key);
    setState(() {});
  }

  Future<void> _setLang(String lang) async {
    setState(() {
      langUserPhone = lang;
    });
    try {
      final request = http.MultipartRequest(
        'POST',
        Uri.parse('$generalRouteForApi/updateUserLang'),
      );
      request.fields['uid'] = uidUser ?? '';
      request.fields['lang'] = lang;
      final streamedResponse = await request.send();
      final response = await http.Response.fromStream(streamedResponse);
      if (response.statusCode == 200) {
        // if (body.contains('"error":false')) {
        //   setState(() {
        //     langUserPhone = lang;
        //   });
        // }
      }
    } catch (_) {}
  }

  void _handleLogout() async {
    ArtDialogResponse response = await ArtSweetAlert.show(
        barrierDismissible: false,
        context: context,
        artDialogArgs: ArtDialogArgs(
            title: (langUserPhone == "fr") ? "Déconnexion ?" : "Sign out?",
            text: (langUserPhone == "fr")
                ? "Voulez-vous vraiment vous déconnecter ?"
                : "Do you really want to sign out?",
            confirmButtonText: (langUserPhone == "fr") ? "Oui" : "Yes",
            denyButtonText: (langUserPhone == "fr") ? "Non" : "No",
            type: ArtSweetAlertType.question));

    if (response.isTapConfirmButton) {
      SQLHelper.viderLaBaseDeDonneeLocal();
      Navigator.pushAndRemoveUntil(
        context,
        MaterialPageRoute(builder: (context) => WelcomePage()),
        (Route<dynamic> route) => false,
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    final theme = Theme.of(context);
    final isDark = theme.brightness == Brightness.dark;

    return Scaffold(
      backgroundColor: isDark ? Color(0xFF121212) : Color(0xFFF8F9FA),
      appBar: AppBar(
        automaticallyImplyLeading: false,
        elevation: 0,
        backgroundColor: primaryColor,
        title: Text(
          (langUserPhone == "fr") ? "Paramètres" : "Settings",
          style: GoogleFonts.poppins(
            color: Colors.white,
            fontWeight: FontWeight.w400,
            fontSize: 18,
          ),
        ),
        actions: [
          IconButton(
            icon: const FaIcon(
              FontAwesomeIcons.solidBell,
              size: 20,
              color: Colors.white,
            ),
            onPressed: () {
              Navigator.push(
                context,
                MaterialPageRoute(
                  builder: (context) => ListeNotification(),
                ),
              );
            },
          ),
          const Padding(
            padding: EdgeInsets.fromLTRB(0, 10, 0, 10),
            child: VerticalDivider(
              width: 0,
              color: Colors.white,
              thickness: 1,
            ),
          ),
          PopupMenuButton<int>(
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
        physics: BouncingScrollPhysics(),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            // --- SECTION ADMINISTRATION (admins uniquement) ---
            if (admin) ...[
              _buildSectionTitle((langUserPhone == "fr") ? "Administration" : "Administration"),
              _buildMenuContainer(isDark, [
                _buildMenuRow(
                    FontAwesomeIcons.userShield,
                    (langUserPhone == "fr")
                        ? "Panneau Administrateur"
                        : "Admin Panel",
                    () => Navigator.push(
                        context,
                        MaterialPageRoute(
                            builder: (context) => AdministrationPage()))),
              ]),
            ],

            // --- SECTION COMPTE ---
            _buildSectionTitle(
                (langUserPhone == "fr") ? "Mon Compte" : "My Account"),
            _buildMenuContainer(isDark, [
              _buildMenuRow(
                  FontAwesomeIcons.user,
                  (langUserPhone == "fr") ? "Profil" : "Profile",
                  () => Navigator.push(context,
                      MaterialPageRoute(builder: (context) => ProfilPage()))),
              _buildMenuRow(
                  FontAwesomeIcons.lock,
                  (langUserPhone == "fr")
                      ? "Modifier le mot de passe"
                      : "Change Password",
                  () => Navigator.push(
                      context,
                      MaterialPageRoute(
                          builder: (context) => ModifierMdpPage()))),
            ]),

            // --- SECTION ASSISTANCE & FEEDBACK ---
            _buildSectionTitle((langUserPhone == "fr")
                ? "Assistance & Avis"
                : "Support & Feedback"),
            _buildMenuContainer(isDark, [
              _buildMenuRow(
                  FontAwesomeIcons.robot,
                  (langUserPhone == "fr")
                      ? "Assistant IA"
                      : "AI Assistant",
                  () => Navigator.push(context,
                      MaterialPageRoute(builder: (context) => const AssistantPage()))),
              _buildMenuRow(
                  FontAwesomeIcons.headset,
                  (langUserPhone == "fr")
                      ? "Support Technique"
                      : "Technical Support",
                  () => Navigator.push(context,
                      MaterialPageRoute(builder: (context) => SupportPage()))),
              _buildMenuRow(
                  FontAwesomeIcons.lightbulb,
                  (langUserPhone == "fr") ? "Suggestions" : "Suggestions",
                  () => Navigator.push(
                      context,
                      MaterialPageRoute(
                          builder: (context) => SuggestionsPage()))),
              _buildMenuRow(
                  FontAwesomeIcons.triangleExclamation,
                  (langUserPhone == "fr")
                      ? "Signaler un utilisateur"
                      : "Report a User",
                  () => Navigator.push(context,
                      MaterialPageRoute(builder: (context) => SignalerPage()))),
            ]),

            // --- SECTION ACTIONS AVANCÉES ---
            _buildSectionTitle((langUserPhone == "fr")
                ? "Actions Avancées"
                : "Advanced Actions"),
            _buildMenuContainer(isDark, [
              _buildMenuRow(
                FontAwesomeIcons.broom,
                (langUserPhone == "fr")
                    ? "Supprimer les contacts DS"
                    : "Delete DS Contacts",
                () => Navigator.push(
                    context,
                    MaterialPageRoute(
                        builder: (context) => const SupprimerContactsDSPage())),
                color: Colors.orange[700],
              ),
              _buildMenuRow(
                FontAwesomeIcons.trash,
                (langUserPhone == "fr")
                    ? "Supprimer mon compte"
                    : "Delete My Account",
                () => Navigator.push(
                    context,
                    MaterialPageRoute(
                        builder: (context) => DeletecomptePage())),
                color: Colors.red,
              ),
            ]),

            // --- SECTION APPLICATION ---
            _buildSectionTitle((langUserPhone == "fr") ? "Application" : "Application"),
            _buildMenuContainer(isDark, [
              _buildLanguageSelector(isDark),
              _buildThemeSelector(isDark),
              _buildMenuRow(
                  FontAwesomeIcons.circleInfo,
                  (langUserPhone == "fr") ? "À Propos" : "About Us",
                  () => Navigator.push(context,
                      MaterialPageRoute(builder: (context) => AproposPage()))),
              _buildMenuRow(
                  FontAwesomeIcons.rightFromBracket,
                  (langUserPhone == "fr") ? "Se déconnecter" : "Sign Out",
                  _handleLogout,
                  showChevron: false),
            ]),

            // --- SECTION ABONNEMENT & PARTAGE ---
            _buildSectionTitle((langUserPhone == "fr")
                ? "Abonnement et Partage"
                : "Subscription & Sharing"),
            SociauxPage(),

            SizedBox(height: 20),
          ],
        ),
      ),
    );
  }

  // --- WIDGETS HELPERS POUR UN DESIGN PROPRE ET RÉUTILISABLE ---

  Widget _buildLanguageSelector(bool isDark) {
    final options = [
      (
        'fr',
        FontAwesomeIcons.f,
        'Français',
      ),
      (
        'en',
        FontAwesomeIcons.e,
        'English',
      ),
    ];

    return Padding(
      padding: const EdgeInsets.fromLTRB(16, 14, 16, 14),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              FaIcon(FontAwesomeIcons.language, color: primaryColor, size: 18),
              SizedBox(width: 16),
              Text(
                (langUserPhone == "fr") ? "Langue" : "Language",
                style: GoogleFonts.poppins(
                  fontSize: 15,
                  fontWeight: FontWeight.w500,
                ),
              ),
            ],
          ),
          SizedBox(height: 12),
          Container(
            margin: EdgeInsets.only(left: 34),
            decoration: BoxDecoration(
              color: isDark ? Color(0xFF2C2C2C) : Color(0xFFF0F0F0),
              borderRadius: BorderRadius.circular(10),
            ),
            child: Row(
              children: options.map((opt) {
                final isSelected = langUserPhone == opt.$1;
                return Expanded(
                  child: GestureDetector(
                    onTap: () => _setLang(opt.$1),
                    child: AnimatedContainer(
                      duration: Duration(milliseconds: 200),
                      padding: EdgeInsets.symmetric(vertical: 9),
                      decoration: BoxDecoration(
                        color: isSelected ? primaryColor : Colors.transparent,
                        borderRadius: BorderRadius.circular(10),
                      ),
                      child: Column(
                        mainAxisSize: MainAxisSize.min,
                        children: [
                          FaIcon(
                            opt.$2,
                            size: 14,
                            color: isSelected
                                ? Colors.white
                                : (isDark
                                    ? Colors.grey[400]
                                    : Colors.grey[600]),
                          ),
                          SizedBox(height: 4),
                          Text(
                            opt.$3,
                            style: GoogleFonts.poppins(
                              fontSize: 11,
                              fontWeight: FontWeight.w600,
                              color: isSelected
                                  ? Colors.white
                                  : (isDark
                                      ? Colors.grey[400]
                                      : Colors.grey[600]),
                            ),
                          ),
                        ],
                      ),
                    ),
                  ),
                );
              }).toList(),
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildThemeSelector(bool isDark) {
    final currentMode = MyApp.themeNotifier.value;

    final options = [
      (
        ThemeMode.system,
        FontAwesomeIcons.circleHalfStroke,
        (langUserPhone == "fr") ? "Système" : "System",
      ),
      (
        ThemeMode.light,
        FontAwesomeIcons.sun,
        (langUserPhone == "fr") ? "Clair" : "Light",
      ),
      (
        ThemeMode.dark,
        FontAwesomeIcons.moon,
        (langUserPhone == "fr") ? "Sombre" : "Dark",
      ),
    ];

    return Padding(
      padding: const EdgeInsets.fromLTRB(16, 14, 16, 14),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              FaIcon(FontAwesomeIcons.palette, color: primaryColor, size: 18),
              SizedBox(width: 16),
              Text(
                (langUserPhone == "fr") ? "Thème" : "Theme",
                style: GoogleFonts.poppins(
                  fontSize: 15,
                  fontWeight: FontWeight.w500,
                ),
              ),
            ],
          ),
          SizedBox(height: 12),
          Container(
            margin: EdgeInsets.only(left: 34),
            decoration: BoxDecoration(
              color: isDark ? Color(0xFF2C2C2C) : Color(0xFFF0F0F0),
              borderRadius: BorderRadius.circular(10),
            ),
            child: Row(
              children: options.map((opt) {
                final isSelected = currentMode == opt.$1;
                return Expanded(
                  child: GestureDetector(
                    onTap: () => _setTheme(opt.$1),
                    child: AnimatedContainer(
                      duration: Duration(milliseconds: 200),
                      padding: EdgeInsets.symmetric(vertical: 9),
                      decoration: BoxDecoration(
                        color: isSelected ? primaryColor : Colors.transparent,
                        borderRadius: BorderRadius.circular(10),
                      ),
                      child: Column(
                        mainAxisSize: MainAxisSize.min,
                        children: [
                          FaIcon(
                            opt.$2,
                            size: 14,
                            color: isSelected
                                ? Colors.white
                                : (isDark
                                    ? Colors.grey[400]
                                    : Colors.grey[600]),
                          ),
                          SizedBox(height: 4),
                          Text(
                            opt.$3,
                            style: GoogleFonts.poppins(
                              fontSize: 11,
                              fontWeight: FontWeight.w600,
                              color: isSelected
                                  ? Colors.white
                                  : (isDark
                                      ? Colors.grey[400]
                                      : Colors.grey[600]),
                            ),
                          ),
                        ],
                      ),
                    ),
                  ),
                );
              }).toList(),
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildSectionTitle(String title) {
    return Padding(
      padding: const EdgeInsets.fromLTRB(20, 20, 20, 10),
      child: Text(
        title.toUpperCase(),
        style: GoogleFonts.poppins(
          fontSize: 12,
          fontWeight: FontWeight.bold,
          color: Colors.grey[500],
          letterSpacing: 0.8,
        ),
      ),
    );
  }

  Widget _buildMenuContainer(bool isDark, List<Widget> children) {
    return Container(
      margin: EdgeInsets.symmetric(horizontal: 10),
      decoration: BoxDecoration(
        color: isDark ? Color(0xFF1E1E1E) : Colors.white,
        borderRadius: BorderRadius.circular(15),
      ),
      child: Column(children: children),
    );
  }

  Widget _buildMenuRow(IconData icon, String text, VoidCallback? onTap,
      {Color? color, bool showChevron = true}) {
    return InkWell(
      onTap: onTap,
      borderRadius: BorderRadius.circular(15),
      child: Padding(
        padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 14),
        child: Row(
          children: [
            FaIcon(icon, color: color ?? primaryColor, size: 18),
            SizedBox(width: 16),
            Expanded(
                child: Text(text,
                    style: GoogleFonts.poppins(
                        fontSize: 15,
                        fontWeight: FontWeight.w500,
                        color: color))),
            if (showChevron)
              FaIcon(FontAwesomeIcons.chevronRight,
                  size: 16, color: Colors.grey[400]),
          ],
        ),
      ),
    );
  }
}
