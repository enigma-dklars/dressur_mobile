// ignore_for_file: prefer_const_constructors, prefer_const_literals_to_create_immutables

import 'package:dressur/components/constant.dart';
import 'package:dressur/components/noti.dart';
import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;

// Classe modèle pour représenter un réseau de paiement
class ReseauPaiement {
  final String id; // Ex: 'mtn_benin'
  final String nom; // Ex: 'MTN Mobile Money (Bénin )'

  ReseauPaiement({required this.id, required this.nom});
}

class ConfigurationRetraitPage extends StatefulWidget {
  const ConfigurationRetraitPage({super.key});

  @override
  State<ConfigurationRetraitPage> createState() =>
      _ConfigurationRetraitPageState();
}

class _ConfigurationRetraitPageState extends State<ConfigurationRetraitPage> {
  final _formKey = GlobalKey<FormState>();
  final _numeroController = TextEditingController();

  // Liste des réseaux disponibles
  final List<ReseauPaiement> _reseauxDisponibles = [
    ReseauPaiement(id: 'mtn_open', nom: 'MTN Mobile Money (Bénin)'),
    ReseauPaiement(id: 'moov', nom: 'Moov Money (Bénin)'),
    ReseauPaiement(id: 'mtn_ci', nom: 'MTN Mobile Money (Côte d’Ivoire)'),
    ReseauPaiement(id: 'moov_tg', nom: 'Moov Money (Togo)'),
    ReseauPaiement(id: 'togocel', nom: 'T-Money (Togo)')
  ];

  ReseauPaiement? _reseauSelectionne;
  bool _isLoading = true;
  bool _isSaving = false;

  @override
  void initState() {
    super.initState();
    _fetchConfiguration();
  }

  @override
  void dispose() {
    _numeroController.dispose();
    super.dispose();
  }

  Future<void> _fetchConfiguration() async {
    setState(() => _isLoading = true);
    try {
      var request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/getRetraitConfiguration'));
      request.fields.addAll({
        'uid': uidUser,
        
      });

      http.StreamedResponse response = await request.send();

      if (response.statusCode == 200) {
        var dataStr = await response.stream.bytesToString();
        var data = convert.jsonDecode(dataStr);

        if (data['error'] == false) {
          _numeroController.text =
              (data['numeroRetrait'] ?? '').toString().replaceAll('+', '');

          String? reseauId = data['reseauRetrait'];

          if (reseauId != null) {
            final match = _reseauxDisponibles.where((r) => r.id == reseauId);

            if (match.isNotEmpty) {
              _reseauSelectionne = match.first;
            } else {
              _reseauSelectionne = null;
            }
          }
        } else {
          print("Aucune configuration trouvée ou erreur serveur.");
        }
      }
    } catch (e) {
      dangerNoti(
          "Erreur", "Impossible de charger votre configuration.", context);
    } finally {
      setState(() => _isLoading = false);
    }
  }

  Future<void> _saveConfiguration() async {
    if (!_formKey.currentState!.validate()) {
      return;
    }

    setState(() => _isSaving = true);

    try {
      var request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/saveRetraitConfiguration'));
      request.fields.addAll({
        'uid': uidUser,
        
        'reseauRetrait': _reseauSelectionne!.id,
        'numeroRetrait': "+${_numeroController.text}",
      });

      http.StreamedResponse response = await request.send();
      var dataStr = await response.stream.bytesToString();
      var data = convert.jsonDecode(dataStr);

      if (response.statusCode == 200 && data['error'] == false) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text(
              'Votre configuration de retrait a été mise à jour.',
              style: GoogleFonts.poppins(color: Colors.white),
            ),
            backgroundColor: Colors.green[600], // Une couleur de succès
            behavior: SnackBarBehavior.floating, // Style moderne
            shape: RoundedRectangleBorder(
              borderRadius: BorderRadius.circular(10),
            ),
            margin: EdgeInsets.all(10),
          ),
        );
        Navigator.pop(context);
      } else {
        dangerNoti(
            "Erreur", data['message'] ?? "Une erreur est survenue.", context);
      }
    } catch (e) {
      dangerNoti("Erreur", "Impossible de contacter le serveur.", context);
    } finally {
      setState(() => _isSaving = false);
    }
  }

  // --- INTERFACE UTILISATEUR ---

  @override
  Widget build(BuildContext context) {
    final theme = Theme.of(context);
    final isDark = theme.brightness == Brightness.dark;

    return Scaffold(
      backgroundColor: theme.scaffoldBackgroundColor,
      appBar: AppBar(
        backgroundColor: primaryColor,
        elevation: 0,
        title: Text(
          "Configuration du Retrait",
          style: GoogleFonts.poppins(
            color: Colors.white,
            fontWeight: FontWeight.w400,
            fontSize: 18,
          ),
        ),
        leading: IconButton(
          icon: FaIcon(FontAwesomeIcons.chevronLeft,
              color: Colors.white, size: 20),
          onPressed: () => Navigator.pop(context),
        ),
      ),
      body: _isLoading
          ? Center(child: CircularProgressIndicator(color: primaryColor))
          : SingleChildScrollView(
              physics: BouncingScrollPhysics(),
              padding: const EdgeInsets.all(15.0),
              child: Form(
                key: _formKey,
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    _buildInfoCard(isDark),
                    SizedBox(height: 30),

                    _sectionTitle("Votre réseau de paiement"),
                    SizedBox(height: 10),

                    _buildReseauDropdown(theme),
                    SizedBox(height: 15),

                    _sectionTitle("Numéro de téléphone associé"),
                    SizedBox(height: 10),

                    _buildNumeroInput(theme),
                    SizedBox(height: 5), // Espace réduit

                    // NOUVEAU : Indication du format
                    _buildFormatHint(),
                    SizedBox(height: 15),

                    // NOUVEAU : Boîte d'avertissement
                    _buildWarningBox(),
                    SizedBox(height: 15),

                    _buildSaveButton(),
                  ],
                ),
              ),
            ),
    );
  }

  Widget _buildInfoCard(bool isDark) {
    return Container(
      padding: EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: primaryColor.withOpacity(0.1),
        borderRadius: BorderRadius.circular(15),
        border: Border.all(color: primaryColor.withOpacity(0.2)),
      ),
      child: Row(
        children: [
          FaIcon(FontAwesomeIcons.circleInfo, color: primaryColor, size: 28),
          SizedBox(width: 15),
          Expanded(
            child: Text(
              "Ce numéro sera utilisé pour tous les retraits automatiques de vos gains.",
              style: GoogleFonts.poppins(
                fontSize: 13,
                color: isDark ? Colors.white70 : Colors.black87,
                height: 1.5,
              ),
            ),
          ),
        ],
      ),
    );
  }

  Widget _sectionTitle(String title) {
    return Text(
      title,
      style: GoogleFonts.poppins(
        fontSize: 16,
        fontWeight: FontWeight.w600,
        color: Theme.of(context).textTheme.bodyLarge?.color,
      ),
    );
  }

  Widget _buildReseauDropdown(ThemeData theme) {
    return DropdownButtonFormField<ReseauPaiement>(
      value: _reseauSelectionne,
      items: _reseauxDisponibles.map((ReseauPaiement reseau) {
        return DropdownMenuItem<ReseauPaiement>(
          value: reseau,
          child: Text(reseau.nom, style: GoogleFonts.poppins(fontSize: 14)),
        );
      }).toList(),
      onChanged: (ReseauPaiement? newValue) {
        setState(() {
          _reseauSelectionne = newValue;
        });
      },
      validator: (value) {
        if (value == null) {
          return 'Veuillez sélectionner un réseau.';
        }
        return null;
      },
      decoration: InputDecoration(
        hintText: 'Choisissez un réseau',
        prefixIcon: Padding(
          padding: const EdgeInsets.only(left: 20, right: 13, top: 14),
          child: FaIcon(FontAwesomeIcons.wallet, color: primaryColor, size: 20),
        ),
        filled: true,
        fillColor: theme.dividerColor.withOpacity(0.05),
        border: OutlineInputBorder(
          borderRadius: BorderRadius.circular(12),
          borderSide: BorderSide.none,
        ),
        contentPadding: EdgeInsets.symmetric(vertical: 16, horizontal: 12),
      ),
      style: GoogleFonts.poppins(color: theme.textTheme.bodyLarge?.color),
      dropdownColor: theme.cardColor,
    );
  }

  Widget _buildNumeroInput(ThemeData theme) {
    return TextFormField(
      controller: _numeroController,
      keyboardType: TextInputType.phone,
      style: GoogleFonts.poppins(fontWeight: FontWeight.w500),
      decoration: InputDecoration(
        hintText: 'Ex: 2290199000000',
        // Utilisez `prefix` au lieu de `prefixIcon`
        prefixIcon: Padding(
          padding: const EdgeInsets.only(left: 20, right: 13, top: 14),
          child: FaIcon(FontAwesomeIcons.mobileScreen,
              color: primaryColor, size: 20), // Ajustez la taille au besoin
        ),
        filled: true,
        fillColor: Theme.of(context).dividerColor.withOpacity(0.05),
        border: OutlineInputBorder(
          borderRadius: BorderRadius.circular(12),
          borderSide: BorderSide.none,
        ),
        contentPadding: EdgeInsets.symmetric(vertical: 16, horizontal: 12),
      ),
      validator: (value) {
        if (value == null || value.trim().isEmpty) {
          return 'Veuillez entrer votre numéro.';
        }
        if (!RegExp(r'^[0-9]{10,15}$').hasMatch(value)) {
          return 'Format de numéro invalide.';
        }
        return null;
      },
    );
  }

  // NOUVEAU WIDGET
  Widget _buildFormatHint() {
    return Padding(
      padding: const EdgeInsets.only(left: 12.0),
      child: Text(
        "Saisissez le numéro au format international, sans le '+' (ex: 229XXXXXXXX).",
        style: GoogleFonts.poppins(
          fontSize: 12,
          color: Colors.grey[600],
        ),
      ),
    );
  }

  // NOUVEAU WIDGET
  Widget _buildWarningBox() {
    return Container(
      padding: EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: Colors.orange.withOpacity(0.1),
        borderRadius: BorderRadius.circular(15),
        border: Border.all(color: Colors.orange.withOpacity(0.3)),
      ),
      child: Column(
        children: [
          Row(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              FaIcon(FontAwesomeIcons.triangleExclamation,
                  color: Colors.orange[700], size: 18),
              SizedBox(width: 12),
              Expanded(
                child: Text(
                  "Vérifiez attentivement vos informations",
                  style: GoogleFonts.poppins(
                    fontWeight: FontWeight.bold,
                    fontSize: 14,
                    color: Colors.orange[800],
                  ),
                ),
              ),
            ],
          ),
          SizedBox(height: 12),
          _warningListItem(
              "Assurez-vous que le numéro saisi est correct et vous appartient."),
          SizedBox(height: 8),
          _warningListItem(
              "Vérifiez que le numéro correspond bien au réseau de paiement sélectionné."),
          SizedBox(height: 12),
          Text(
            "Dressur ne pourra être tenu responsable en cas de perte de fonds due à un numéro erroné ou non conforme.",
            style: GoogleFonts.poppins(
              fontSize: 12,
              fontWeight: FontWeight.w500,
              fontStyle: FontStyle.italic,
              color: Colors.grey[700],
            ),
          ),
        ],
      ),
    );
  }

  // Helper pour la liste dans la boîte d'avertissement
  Widget _warningListItem(String text) {
    return Row(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text("• ",
            style: GoogleFonts.poppins(color: Colors.grey[700], fontSize: 14)),
        Expanded(
          child: Text(
            text,
            style: GoogleFonts.poppins(
              fontSize: 13,
              color: Colors.grey[700],
              height: 1.4,
            ),
          ),
        ),
      ],
    );
  }

  Widget _buildSaveButton() {
    return SizedBox(
      width: double.infinity,
      height: 55,
      child: ElevatedButton.icon(
        onPressed: _isSaving ? null : _saveConfiguration,
        icon: _isSaving
            ? Container()
            : FaIcon(FontAwesomeIcons.floppyDisk, color: Colors.white),
        label: _isSaving
            ? SizedBox(
                width: 25,
                height: 25,
                child: CircularProgressIndicator(
                  strokeWidth: 3,
                  valueColor: AlwaysStoppedAnimation(Colors.white),
                ),
              )
            : Text(
                "Enregistrer et Confirmer", // Texte du bouton modifié pour plus d'impact
                style: GoogleFonts.poppins(
                  fontSize: 16,
                  fontWeight: FontWeight.w600,
                  color: Colors.white,
                ),
              ),
        style: ElevatedButton.styleFrom(
          backgroundColor: primaryColor,
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(15),
          ),
          elevation: 2,
        ),
      ),
    );
  }
}
