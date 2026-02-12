// ignore_for_file: prefer_const_constructors, use_build_context_synchronously

import 'dart:async';
import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:animated_bottom_navigation_bar/animated_bottom_navigation_bar.dart';

// --- Importez vos pages et constantes ---
import 'package:dressur/1_reception/reception.dart';
import 'package:dressur/2_promo/promo.dart';
import 'package:dressur/3_actu/actu.dart';
import 'package:dressur/4_preference/preference.dart';
import 'package:dressur/5_autre/autre.dart';
import 'package:dressur/components/constant.dart';
// ... et le reste de vos imports

class BottomBar extends StatefulWidget {
  const BottomBar({Key? key}) : super(key: key);

  @override
  State<BottomBar> createState() => _BottomBarState();
}

class _BottomBarState extends State<BottomBar> with WidgetsBindingObserver {
  // L'index 2 correspond maintenant à la page "Actu"
  int _selectedIndex = 2;
  final PageController _pageController = PageController(initialPage: 2);

  // --- Listes pour la barre de navigation ---
  // "ActuPage" est maintenant au centre de la liste des écrans
  final List<Widget> _screens = [
    ReceptionPage(),
    BoostPage(),
    ActuPage(), // <--- PAGE "ACTU" INTÉGRÉE
    PreferencePage(),
    SettingPage(),
  ];

  // Icônes pour chaque onglet, y compris "Actu"
  final List<IconData> _iconList = [
    Icons.home_outlined,
    Icons.query_stats_outlined,
    Icons.dynamic_feed_outlined, // Icône pour "Actu"
    Icons.favorite_border_outlined,
    Icons.settings_outlined,
  ];

  final List<IconData> _iconListSelected = [
    Icons.home,
    Icons.query_stats,
    Icons.dynamic_feed, // Icône sélectionnée pour "Actu"
    Icons.favorite,
    Icons.settings,
  ];

  // ... (Toute votre logique initState, dispose, etc. reste la même)
  @override
  void initState() {
    super.initState();
    // ...
  }

  @override
  void dispose() {
    _pageController.dispose();
    WidgetsBinding.instance.removeObserver(this);
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      // Le corps utilise un PageView pour permettre le swipe
      body: PageView(
        controller: _pageController,
        physics: BouncingScrollPhysics(),
        onPageChanged: (index) {
          setState(() => _selectedIndex = index);
        },
        children: _screens,
      ),
      // La barre de navigation n'a plus de bouton flottant ni d'encoche
      bottomNavigationBar: AnimatedBottomNavigationBar.builder(
        itemCount: _iconList.length,
        tabBuilder: (int index, bool isActive) {
          // Style spécial pour le bouton central "Actu"
          bool isCenterButton = index == 2;

          return isCenterButton
              ? _buildCenterButton(isActive)
              : _buildNormalButton(index, isActive);
        },
        activeIndex: _selectedIndex,
        gapLocation: GapLocation.none, // Plus d'encoche
        notchSmoothness: NotchSmoothness.softEdge,
        leftCornerRadius: 0, // Bords droits pour un look classique
        rightCornerRadius: 0,
        onTap: (index) {
          setState(() => _selectedIndex = index);
          _pageController.animateToPage(
            index,
            duration: Duration(milliseconds: 300),
            curve: Curves.easeInOut,
          );
        },
      ),
    );
  }

  // --- WIDGETS HELPERS POUR LA BARRE DE NAVIGATION ---

  // Bouton normal pour les onglets standards
  Widget _buildNormalButton(int index, bool isActive) {
    return Column(
      mainAxisSize: MainAxisSize.min,
      mainAxisAlignment: MainAxisAlignment.center,
      children: [
        Icon(
          isActive ? _iconListSelected[index] : _iconList[index],
          size: 24,
          color: isActive ? primaryColor : Colors.grey[600],
        ),
        SizedBox(height: 4),
        Text(
          _getLabel(index),
          maxLines: 1,
          style: GoogleFonts.poppins(
            fontSize: 11,
            fontWeight: isActive ? FontWeight.bold : FontWeight.normal,
            color: isActive ? primaryColor : Colors.grey[600],
          ),
        )
      ],
    );
  }

  // Bouton spécial pour l'onglet central "Actu"
  Widget _buildCenterButton(bool isActive) {
    return Container(
      width: 60,
      height: 60,
      margin: EdgeInsets.only(bottom: 15), // Remonte le bouton
      decoration: BoxDecoration(
        shape: BoxShape.circle,
        color: primaryColor,
        boxShadow: [
          BoxShadow(
            color: primaryColor.withOpacity(0.4),
            blurRadius: 8,
            offset: Offset(0, 4),
          ),
        ],
      ),
      child: Icon(
        isActive ? Icons.dynamic_feed : Icons.dynamic_feed_outlined,
        color: Colors.white,
        size: 30,
      ),
    );
  }

  // Helper pour obtenir le label en fonction de la langue
  String _getLabel(int index) {
    final bool isFrench = langUserPhone == "fr";
    switch (index) {
      case 0:
        return isFrench ? "Réception" : "Home";
      case 1:
        return isFrench ? "Promo" : "Promo";
      case 2:
        return isFrench ? "Actu" : "News"; // Label pour l'onglet central
      case 3:
        return isFrench ? "Préférences" : "Preferences";
      case 4:
        return isFrench ? "Autre" : "Other";
      default:
        return "";
    }
  }
}
