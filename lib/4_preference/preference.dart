// ignore_for_file: use_build_context_synchronously

import 'package:dressur/components/padding_and_divider.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/4_preference/choix_pays.dart';
import 'package:dressur/1_reception/liste_notification.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/sociaux.dart';
import 'package:dressur/5_autre/support_assistance.dart';
import 'dart:async';
import 'package:http/http.dart' as http;

class PreferencePage extends StatefulWidget {
  PreferencePage({Key? key}) : super(key: key);

  @override
  State<PreferencePage> createState() => _PreferencePageState();
}

class _PreferencePageState extends State<PreferencePage> {
  var data;
  Timer? _timer;
  bool _addPageActuLocal = addPageActu;
  bool _updatingAddPageActu = false;

  @override
  void dispose() {
    // Arrête le timer lors de la suppression du widget
    _stopTimer();
    super.dispose();
  }

  void _startTimer() {
    // Crée un nouveau timer qui exécute la fonction everySecond toutes les secondes
    _timer = Timer.periodic(const Duration(seconds: 1), (timer) {
      everySecond();
    });
  }

  void _stopTimer() {
    // Arrête et annule le timer
    _timer?.cancel();
    _timer = null;
  }

  void everySecond() {
    // Code à exécuter toutes les secondes
    setState(() {
      preferencePaysText = preferencePaysText;
    });
  }

  Future<void> _updateAddPageActu(bool value) async {
    setState(() {
      _updatingAddPageActu = true;
      _addPageActuLocal = value;
      addPageActu = value;
    });

    final valueParam = value ? '1' : '0';
    await http.get(Uri.parse(
        '$generalRouteForApi/updateAddPageActu/$uidUser/$valueParam'));

    setState(() {
      _updatingAddPageActu = false;
    });
  }

  @override
  void initState() {
    super.initState();
    // Démarre le timer lors de l'initialisation du widget
    _startTimer();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        appBar: AppBar(
          automaticallyImplyLeading: false,
          elevation: 0,
          backgroundColor: primaryColor,
          title: Text(
            (langUserPhone == "fr") ? "Préférences" : "Preferences",
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
          child: Container(
            child: Column(
              children: [
                const SizedBox(height: 10),
                _buildAddPageActuCard(context: context),
                const SizedBox(height: 10),
                _buildCountryPreferenceCard(
                  context: context,
                  selectedCountriesText: preferencePaysText.toString(),
                  onEdit: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(builder: (context) => ChoixDesPays()),
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

  Widget _buildAddPageActuCard({required BuildContext context}) {
    final theme = Theme.of(context);
    final isDark = theme.brightness == Brightness.dark;

    return Container(
      margin: const EdgeInsets.symmetric(horizontal: 10, vertical: 0),
      child: Ink(
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
        child: Padding(
          padding: const EdgeInsets.all(20.0),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Row(
                children: [
                  FaIcon(FontAwesomeIcons.addressCard,
                      color: primaryColor, size: 28),
                  SizedBox(width: 12),
                  Expanded(
                    child: Text(
                      (langUserPhone == "fr")
                          ? "Suggestion des contacts disponibles"
                          : "Available contact suggestions",
                      style: GoogleFonts.poppins(
                        color: isDark ? Colors.white : Colors.black87,
                        fontWeight: FontWeight.w600,
                        fontSize: 18,
                      ),
                    ),
                  ),
                  _updatingAddPageActu
                      ? SizedBox(
                          width: 24,
                          height: 24,
                          child: CircularProgressIndicator(
                              strokeWidth: 2.5, color: primaryColor),
                        )
                      : Switch(
                          trackOutlineColor: MaterialStateColor.resolveWith(
                              (states) => primaryColor),
                          activeColor: Colors.green,
                          activeTrackColor: primaryColor,
                          inactiveThumbColor: Colors.white,
                          inactiveTrackColor: Colors.grey,
                          value: _addPageActuLocal,
                          onChanged: _updateAddPageActu,
                        ),
                ],
              ),
              SizedBox(height: 15),
              Container(
                padding: EdgeInsets.symmetric(horizontal: 12, vertical: 10),
                decoration: BoxDecoration(
                  color: primaryColor.withOpacity(0.05),
                  borderRadius: BorderRadius.circular(12),
                ),
                child: Text(
                  (langUserPhone == "fr")
                      ? "Affiche le nombre de contacts disponibles, ainsi qu'un rappel pour booster vos contacts."
                      : "Shows the number of available contacts, along with a reminder to boost your contacts.",
                  style: GoogleFonts.poppins(
                    color: isDark ? Colors.grey[300] : Colors.grey[700],
                    fontSize: 13,
                    height: 1.5,
                  ),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildCountryPreferenceCard({
    required BuildContext context,
    required String selectedCountriesText,
    required VoidCallback onEdit,
  }) {
    final theme = Theme.of(context);
    final isDark = theme.brightness == Brightness.dark;

    return Container(
      margin: const EdgeInsets.symmetric(horizontal: 10, vertical: 0),
      // Utilisation d'un `Ink` pour l'effet de surbrillance sur toute la carte
      child: Ink(
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
        // Utilisation d'un `InkWell` pour rendre toute la carte cliquable
        child: InkWell(
          onTap: onEdit,
          borderRadius: BorderRadius.circular(20),
          splashColor: primaryColor.withOpacity(0.1),
          highlightColor: primaryColor.withOpacity(0.05),
          child: Padding(
            padding: const EdgeInsets.all(20.0),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                // --- EN-TÊTE ---
                Row(
                  children: [
                    FaIcon(FontAwesomeIcons.globe,
                        color: primaryColor, size: 28),
                    SizedBox(width: 12),
                    Text(
                      (langUserPhone == "fr")
                          ? "Vos Pays Cibles"
                          : "Your Target Countries",
                      style: GoogleFonts.poppins(
                        color: isDark ? Colors.white : Colors.black87,
                        fontWeight: FontWeight.w600,
                        fontSize: 18,
                      ),
                    ),
                  ],
                ),
                SizedBox(height: 15),

                // --- EXPLICATION IMPORTANTE (le "NB") ---
                Container(
                  padding: EdgeInsets.symmetric(horizontal: 12, vertical: 10),
                  decoration: BoxDecoration(
                    color: primaryColor.withOpacity(0.05),
                    borderRadius: BorderRadius.circular(12),
                  ),
                  child: Text(
                    (langUserPhone == "fr")
                        ? "Ce choix détermine les contacts proposés, la cible de vos promotions affaires et programmes de récompenses ainsi que l’actualité affichée."
                        : "This choice determines the contacts offered, the target of your business promotions and reward programs, as well as the news displayed.",
                    style: GoogleFonts.poppins(
                      color: isDark ? Colors.grey[300] : Colors.grey[700],
                      fontSize: 13,
                      height: 1.5,
                    ),
                  ),
                ),
                SizedBox(height: 20),

                // --- AFFICHAGE DES PAYS SÉLECTIONNÉS ---
                Text(
                  (langUserPhone == "fr")
                      ? "Sélection actuelle :"
                      : "Current selection:",
                  style: GoogleFonts.poppins(
                    color: isDark ? Colors.grey[400] : Colors.grey[600],
                    fontSize: 14,
                    fontWeight: FontWeight.w400,
                  ),
                ),
                SizedBox(height: 5),
                Text(
                  // Affiche un texte par défaut si la sélection est vide
                  selectedCountriesText.isEmpty
                      ? (langUserPhone == "fr"
                          ? "Aucun pays sélectionné"
                          : "No country selected")
                      : selectedCountriesText,
                  style: GoogleFonts.poppins(
                    color: isDark ? Colors.white : Colors.black,
                    fontSize: 16,
                    fontWeight: FontWeight.w500,
                  ),
                  maxLines: 2,
                  overflow: TextOverflow.ellipsis,
                ),
                SizedBox(height: 15),

                // --- BOUTON D'ACTION ---
                Align(
                  alignment: Alignment.centerRight,
                  child: ElevatedButton.icon(
                    onPressed: onEdit,
                    icon: FaIcon(FontAwesomeIcons.pen, size: 18),
                    label: Text(
                      (langUserPhone == "fr") ? 'Modifier' : 'Edit',
                      style: GoogleFonts.poppins(fontWeight: FontWeight.w600),
                    ),
                    style: ElevatedButton.styleFrom(
                      backgroundColor: primaryColor,
                      foregroundColor: Colors.white,
                      padding:
                          EdgeInsets.symmetric(horizontal: 20, vertical: 12),
                      shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(12)),
                    ),
                  ),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
