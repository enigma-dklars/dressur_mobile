// ignore_for_file: unused_import

import 'dart:io';
import 'dart:async';
import 'package:dressur/2_promo/liste_promo_reseau_sociaux.dart';
import 'package:dressur/2_promo/new_promo_reseau_sociaux.dart';
import 'package:dressur/components/noti.dart';
import 'package:dressur/components/padding_and_divider.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
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

class BoostPage extends StatefulWidget {
  @override
  State<BoostPage> createState() => _BoostPageState();
}

class _BoostPageState extends State<BoostPage> {
  Future<bool> _onWillPop() async {
    return (await showDialog(
          context: context,
          builder: (context) => AlertDialog(
            title: (langUserPhone == "fr")
                ? const Text('Êtes-vous sûr?')
                : const Text('Are you sure?'),
            content: (langUserPhone == "fr")
                ? const Text("Voulez-vous quitter l'application ?")
                : const Text("Do you want to quit the application?"),
            actions: <Widget>[
              TextButton(
                onPressed: () =>
                    Navigator.of(context).pop(false), //<-- SEE HERE
                child: (langUserPhone == "fr")
                    ? const Text('Non')
                    : const Text('No'),
              ),
              TextButton(
                onPressed: () {
                  if (Platform.isAndroid) {
                    // Android : minimise l'app (comportement attendu)
                    SystemNavigator.pop();
                  } else {
                    // iOS : exit(0) est interdit par Apple (rejet App Store).
                    // On ferme simplement le dialogue — l'utilisateur utilise
                    // le bouton Home pour passer en arrière-plan.
                    Navigator.of(context).pop(false);
                  }
                }, // <-- SEE HERE
                child: (langUserPhone == "fr")
                    ? const Text('Oui')
                    : const Text('Yes'),
              ),
            ],
          ),
        )) ??
        false;
  }

  @override
  void initState() {
    super.initState();
  }

  Widget build(BuildContext context) {
    return WillPopScope(
      onWillPop: _onWillPop,
      child: Scaffold(
        appBar: AppBar(
          automaticallyImplyLeading: false,
          elevation: 0,
          backgroundColor: primaryColor,
          title: Text(
            (langUserPhone == "fr") ? "Promotions" : "Promotions",
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
              ),
              color: Colors.white,
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
              SizedBox(height: 10),
              _buildServiceCard(
                context: context,
                icon: FontAwesomeIcons.addressBook,
                title: "Boost Contact",
                description: (langUserPhone == "fr")
                    ? "Rendez visible le ($tel) aux contacts correspondant à vos préférences pays."
                    : "Make the ($tel) visible to contacts corresponding to your country preferences.",
                primaryActionText:
                    (langUserPhone == "fr") ? "Faire un Boost" : "Boost",
                onPrimaryAction: () => Navigator.push(
                    context,
                    MaterialPageRoute(
                        builder: (context) => NewBoostContactPage())),
                secondaryActionText:
                    (langUserPhone == "fr") ? "Voir la liste" : "See the list",
                onSecondaryAction: () => Navigator.push(
                    context,
                    MaterialPageRoute(
                        builder: (context) => ListeBoostContactPage())),
              ),
              SizedBox(height: 10),
              _buildServiceCard(
                context: context,
                icon: FontAwesomeIcons.store,
                title: (langUserPhone == "fr")
                    ? "Promotion Affaire"
                    : "Business Promotion",
                description: (langUserPhone == "fr")
                    ? "Faite la promotion de vos produits et services. Les utilisateurs intéressés vous contacterons."
                    : "Promote your products and services. Interested users will contact you.",
                primaryActionText: (langUserPhone == "fr")
                    ? "Faire une Promo"
                    : "Make a Promo",
                onPrimaryAction: () => Navigator.push(
                    context,
                    MaterialPageRoute(
                        builder: (context) => PromotionFormPage())),
                secondaryActionText:
                    (langUserPhone == "fr") ? "Voir la liste" : "See the list",
                onSecondaryAction: () => Navigator.push(
                    context,
                    MaterialPageRoute(
                        builder: (context) => PromotionListPage())),
              ),
              SizedBox(height: 10),
              if (mailIsMaxxFire == false) ...[
                _buildServiceCard(
                  context: context,
                  icon: FontAwesomeIcons.chartLine,
                  title: (langUserPhone == "fr")
                      ? "Promotion Réseau Sociaux"
                      : "Social Network Promotion",
                  description: (langUserPhone == "fr")
                      ? "Payer pour des abonnés, des vues, des likes, etc. sur TikTok, Instagram, Telegram, YouTube, etc."
                      : "Pay for subscribers, views, likes, etc. on TikTok, Instagram, Telegram, YouTube, etc.",
                  primaryActionText:
                      (langUserPhone == "fr") ? "Démarrer" : "To start up",
                  onPrimaryAction: () => Navigator.push(
                      context,
                      MaterialPageRoute(
                          builder: (context) =>
                              PromotionReseauSociauxFormPage())),
                  secondaryActionText: (langUserPhone == "fr")
                      ? "Voir la liste"
                      : "See the list",
                  onSecondaryAction: () => Navigator.push(
                      context,
                      MaterialPageRoute(
                          builder: (context) =>
                              PromotionReseauSociauxListePage())),
                ),
              ],
              const SizedBox(height: 10),
              SociauxPage(),
              const SizedBox(height: 10),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildServiceCard({
    required BuildContext context,
    required IconData icon,
    required String title,
    required String description,
    required String primaryActionText,
    required VoidCallback onPrimaryAction,
    required String secondaryActionText,
    required VoidCallback onSecondaryAction,
  }) {
    final theme = Theme.of(context);
    final isDark = theme.brightness == Brightness.dark;

    return Container(
      margin: const EdgeInsets.symmetric(horizontal: 10, vertical: 0),
      padding: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        color: isDark ? Color(0xFF1E1E1E) : Colors.white,
        borderRadius: BorderRadius.circular(15),
        border: Border.all(
            color: isDark ? Colors.grey[800]! : Colors.grey[200]!, width: 1),
        boxShadow: [
          BoxShadow(
            color: isDark
                ? Colors.black.withOpacity(0.2)
                : Colors.grey.withOpacity(0.1),
            blurRadius: 10,
            offset: Offset(0, 4),
          ),
        ],
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              Container(
                padding: EdgeInsets.all(10),
                decoration: BoxDecoration(
                  color: primaryColor.withOpacity(0.1),
                  borderRadius: BorderRadius.circular(12),
                ),
                child: FaIcon(icon, color: primaryColor, size: 28),
              ),
              SizedBox(width: 15),
              Expanded(
                child: Text(
                  title,
                  style: GoogleFonts.poppins(
                    color: isDark ? Colors.white : Colors.black87,
                    fontWeight: FontWeight.w600,
                    fontSize: 18,
                  ),
                ),
              ),
            ],
          ),
          SizedBox(height: 15),
          Text(
            description,
            style: GoogleFonts.poppins(
              color: isDark ? Colors.grey[400] : Colors.grey[700],
              fontSize: 14,
              height: 1.5,
            ),
          ),
          SizedBox(height: 20),
          Row(
            children: [
              Expanded(
                child: ElevatedButton(
                  onPressed: onPrimaryAction,
                  style: ElevatedButton.styleFrom(
                    backgroundColor: primaryColor,
                    foregroundColor: Colors.white,
                    padding: EdgeInsets.symmetric(vertical: 14),
                    shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(12)),
                    elevation: 2,
                  ),
                  child: Text(
                    primaryActionText,
                    style: GoogleFonts.poppins(
                        fontWeight: FontWeight.w600, fontSize: 14),
                  ),
                ),
              ),
              SizedBox(width: 12),
              Expanded(
                child: OutlinedButton(
                  onPressed: onSecondaryAction,
                  style: OutlinedButton.styleFrom(
                    side: BorderSide(color: secondaryColor.withOpacity(0.7)),
                    foregroundColor: secondaryColor,
                    padding: EdgeInsets.symmetric(vertical: 14),
                    shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(12)),
                  ),
                  child: Text(
                    secondaryActionText,
                    style: GoogleFonts.poppins(
                        fontWeight: FontWeight.w600, fontSize: 14),
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
