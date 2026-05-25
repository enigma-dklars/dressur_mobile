// ignore_for_file: use_build_context_synchronously, prefer_const_constructors

import 'dart:io';
import 'package:dressur/5_autre/suggestions.dart';
import 'package:dressur/components/sociaux.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:flutter_contacts/flutter_contacts.dart';
import 'package:dressur/8_admin/admin.dart';
import 'package:dressur/5_autre/a_propos_ds.dart';
import 'package:dressur/5_autre/delete_compte_user.dart';
import 'package:dressur/5_autre/modifier_mot_de_passe.dart';
import 'package:dressur/5_autre/profil_user.dart';
import 'package:dressur/5_autre/signaler_user.dart';
import 'package:dressur/1_reception/liste_notification.dart';
import 'package:dressur/6_login_register/connexion.dart';
import 'package:dressur/5_autre/support_assistance.dart';
import 'package:art_sweetalert/art_sweetalert.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/sql_helper.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:google_fonts/google_fonts.dart';

class SettingPage extends StatefulWidget {
  SettingPage({Key? key}) : super(key: key);

  @override
  State<SettingPage> createState() => _SettingPageState();
}

class _SettingPageState extends State<SettingPage> {
  Future<bool> _onWillPop() async {
    // ... (votre code _onWillPop existant)
    return (await showDialog(
          context: context,
          builder: (context) => AlertDialog(
            title: Text(
                (langUserPhone == "fr") ? 'Êtes-vous sûr?' : 'Are you sure?'),
            content: Text((langUserPhone == "fr")
                ? "Voulez-vous quitter l'application ?"
                : "Do you want to quit the application?"),
            actions: <Widget>[
              TextButton(
                  onPressed: () => Navigator.of(context).pop(false),
                  child: Text((langUserPhone == "fr") ? 'Non' : 'No')),
              TextButton(
                  onPressed: () => SystemNavigator.pop(),
                  child: Text((langUserPhone == "fr") ? 'Oui' : 'Yes')),
            ],
          ),
        )) ??
        false;
  }

  // --- LOGIQUE DES ACTIONS (pour garder le build() propre) ---
  void _handleDeleteDSContacts() async {
    ArtDialogResponse response = await ArtSweetAlert.show(
      barrierDismissible: false,
      context: context,
      artDialogArgs: ArtDialogArgs(
          title: (langUserPhone == "fr")
              ? "Action irréversible"
              : "Irreversible action",
          text: (langUserPhone == "fr")
              ? "Voulez-vous vraiment supprimer tous vos contacts DS ?"
              : "Are you sure you want to delete all your DS contacts?",
          confirmButtonText:
              (langUserPhone == "fr") ? "Oui, Supprimer" : "Yes, Delete",
          denyButtonText: (langUserPhone == "fr") ? "Annuler" : "Cancel",
          type: ArtSweetAlertType.warning),
    );

    if (response.isTapConfirmButton) {
      if (contactsEnregistrer.isNotEmpty) {
        ScaffoldMessenger.of(context).showSnackBar(SnackBar(
          behavior: SnackBarBehavior.floating,
          duration: const Duration(minutes: 1),
          content: Text(
            (langUserPhone == "fr")
                ? "Dressur vas parcourir vos contacts un a un et supprimer les contacts DS.\n\nPatientez tous le long du processus.\n\nCe processus peut durée plusieurs minutes."
                : "Dressur will go through your contacts one by one and delete DS contacts.\n\nWait all the way through the process.\n\nThis process may take several minutes.",
          ),
        ));
        List<Contact> contacts =
            await FlutterContacts.getContacts(withProperties: true);
        var nombreContact = contacts.length;
        for (var contact in contacts) {
          for (var phone in contact.phones) {
            var numberTel =
                (phone.number).replaceAll(" ", "").replaceAll("-", "");
            if (contactsEnregistrer.contains(numberTel)) {
              await contact.delete();
            }
          }
          nombreContact--;
          ScaffoldMessenger.of(context).showSnackBar(SnackBar(
            behavior: SnackBarBehavior.floating,
            content: Text((langUserPhone == "fr")
                ? "$nombreContact contact(s) restant à parcourir."
                : "$nombreContact contact(s) remaining to be scanned."),
          ));
        }
        ScaffoldMessenger.of(context).showSnackBar(SnackBar(
          behavior: SnackBarBehavior.floating,
          content: Text(
            (langUserPhone == "fr")
                ? "${contactsEnregistrer.length} contact(s) DS supprimer."
                : "${contactsEnregistrer.length} DS contact(s) delete.",
          ),
        ));
      } else {
        ScaffoldMessenger.of(context).showSnackBar(SnackBar(
          behavior: SnackBarBehavior.floating,
          content: Text(
            (langUserPhone == "fr")
                ? "Vous n'avez aucun contact DS actuellement. Faite un boost pour en avoir."
                : "You don't currently have any DS Contacts. Boost to get some.",
          ),
        ));
      }
    }
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
        MaterialPageRoute(builder: (context) => LoginPage()),
        (Route<dynamic> route) => false,
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    final theme = Theme.of(context);
    final isDark = theme.brightness == Brightness.dark;

    return WillPopScope(
      onWillPop: _onWillPop,
      child: Scaffold(
        backgroundColor: isDark ? Color(0xFF121212) : Color(0xFFF8F9FA),
        appBar: AppBar(
          automaticallyImplyLeading: false,
          elevation: 0,
          backgroundColor: primaryColor,
          title: Text(
            (langUserPhone == "fr") ? "Autres Pages" : "Other Pages",
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
          ],
        ),
        body: SingleChildScrollView(
          physics: BouncingScrollPhysics(),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
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
                    FontAwesomeIcons.headset,
                    (langUserPhone == "fr")
                        ? "Support Technique"
                        : "Technical Support",
                    () => Navigator.push(
                        context,
                        MaterialPageRoute(
                            builder: (context) => SupportPage()))),
                _buildMenuRow(
                    FontAwesomeIcons.lightbulb,
                    "Suggestions",
                    () => Navigator.push(
                        context,
                        MaterialPageRoute(
                            builder: (context) => SuggestionsPage()))),
                _buildMenuRow(
                    FontAwesomeIcons.triangleExclamation,
                    (langUserPhone == "fr")
                        ? "Signaler un utilisateur"
                        : "Report a User",
                    () => Navigator.push(
                        context,
                        MaterialPageRoute(
                            builder: (context) => SignalerPage()))),
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
                  _handleDeleteDSContacts,
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
              _buildSectionTitle("Application"),
              _buildMenuContainer(isDark, [
                _buildMenuRow(
                    FontAwesomeIcons.circleInfo,
                    (langUserPhone == "fr") ? "À Propos" : "About Us",
                    () => Navigator.push(
                        context,
                        MaterialPageRoute(
                            builder: (context) => AproposPage()))),
                _buildMenuRow(
                    FontAwesomeIcons.rightFromBracket,
                    (langUserPhone == "fr") ? "Se déconnecter" : "Sign Out",
                    _handleLogout),
              ]),

              _buildSectionTitle("Abonnement et Partage"),
              SociauxPage(),

              if (admin) ...[
                _buildSectionTitle("Administration"),
                _buildMenuContainer(isDark, [
                  _buildMenuRow(
                      FontAwesomeIcons.userShield,
                      "Panneau Administrateur",
                      () => Navigator.push(
                          context,
                          MaterialPageRoute(
                              builder: (context) => AdministrationPage()))),
                ]),
              ],

              SizedBox(height: 20),
            ],
          ),
        ),
      ),
    );
  }

  // --- WIDGETS HELPERS POUR UN DESIGN PROPRE ET RÉUTILISABLE ---

  Widget _buildStatCard(BuildContext context,
      {required IconData icon,
      required String value,
      required String label,
      required bool hasIncreased}) {
    final isDark = Theme.of(context).brightness == Brightness.dark;
    return Expanded(
      child: Container(
        padding: EdgeInsets.all(16),
        decoration: BoxDecoration(
          color: isDark ? Color(0xFF1E1E1E) : Colors.white,
          borderRadius: BorderRadius.circular(15),
        ),
        child: Column(
          children: [
            FaIcon(icon, color: primaryColor, size: 24),
            SizedBox(height: 10),
            Text(label,
                style: GoogleFonts.poppins(
                    fontSize: 14,
                    fontWeight: FontWeight.w500,
                    color: isDark ? Colors.grey[300] : Colors.grey[700])),
            SizedBox(height: 8),
            Text(value,
                style: GoogleFonts.poppins(
                    fontSize: 24,
                    fontWeight: FontWeight.bold,
                    color: isDark ? Colors.white : Colors.black87)),
          ],
        ),
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

  Widget _buildMenuRow(IconData icon, String text, VoidCallback onTap,
      {Color? color}) {
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
            if (color == null)
              FaIcon(FontAwesomeIcons.chevronRight,
                  size: 16, color: Colors.grey[400]),
          ],
        ),
      ),
    );
  }
}
