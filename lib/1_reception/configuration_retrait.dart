// ignore_for_file: prefer_const_constructors, prefer_const_literals_to_create_immutables

import 'package:dressur/components/constant.dart';
import 'package:dressur/components/noti.dart';
import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;

class ReseauPaiement {
  final String id;
  final String nom;

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

  final List<ReseauPaiement> _reseauxDisponibles = [
    ReseauPaiement(id: 'mtn_open', nom: 'MTN Mobile Money (Bénin)'),
    ReseauPaiement(id: 'moov', nom: 'Moov Money (Bénin)'),
    ReseauPaiement(id: 'mtn_ci', nom: "MTN Mobile Money (Côte d'Ivoire)"),
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
        (langUserPhone == "fr") ? "Erreur" : "Error",
        (langUserPhone == "fr")
            ? "Impossible de charger votre configuration."
            : "Unable to load your configuration.",
        context,
      );
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
              (langUserPhone == "fr")
                  ? 'Votre configuration de retrait a été mise à jour.'
                  : 'Your withdrawal configuration has been updated.',
              style: GoogleFonts.poppins(color: Colors.white),
            ),
            backgroundColor: Colors.green[600],
            behavior: SnackBarBehavior.floating,
            shape: RoundedRectangleBorder(
              borderRadius: BorderRadius.circular(10),
            ),
            margin: EdgeInsets.all(10),
          ),
        );
        Navigator.pop(context);
      } else {
        dangerNoti(
          (langUserPhone == "fr") ? "Erreur" : "Error",
          data['message'] ??
              ((langUserPhone == "fr")
                  ? "Une erreur est survenue."
                  : "An error occurred."),
          context,
        );
      }
    } catch (e) {
      dangerNoti(
        (langUserPhone == "fr") ? "Erreur" : "Error",
        (langUserPhone == "fr")
            ? "Impossible de contacter le serveur."
            : "Unable to contact the server.",
        context,
      );
    } finally {
      setState(() => _isSaving = false);
    }
  }

  @override
  Widget build(BuildContext context) {
    final theme = Theme.of(context);
    final isDark = theme.brightness == Brightness.dark;
    final bool isFr = langUserPhone == "fr";

    return Scaffold(
      backgroundColor: theme.scaffoldBackgroundColor,
      appBar: AppBar(
        backgroundColor: primaryColor,
        elevation: 0,
        title: Text(
          isFr ? "Configuration du Retrait" : "Withdrawal Configuration",
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
                    _buildInfoCard(isDark, isFr),
                    SizedBox(height: 30),

                    _sectionTitle(isFr
                        ? "Votre réseau de paiement"
                        : "Your payment network"),
                    SizedBox(height: 10),

                    _buildReseauDropdown(theme, isFr),
                    SizedBox(height: 15),

                    _sectionTitle(isFr
                        ? "Numéro de téléphone associé"
                        : "Associated phone number"),
                    SizedBox(height: 10),

                    _buildNumeroInput(theme, isFr),
                    SizedBox(height: 5),

                    _buildFormatHint(isFr),
                    SizedBox(height: 15),

                    _buildWarningBox(isFr),
                    SizedBox(height: 15),

                    _buildSaveButton(isFr),
                  ],
                ),
              ),
            ),
    );
  }

  Widget _buildInfoCard(bool isDark, bool isFr) {
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
              isFr
                  ? "Ce numéro sera utilisé pour tous les retraits automatiques de vos gains."
                  : "This number will be used for all automatic withdrawals of your earnings.",
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

  Widget _buildReseauDropdown(ThemeData theme, bool isFr) {
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
          return isFr
              ? 'Veuillez sélectionner un réseau.'
              : 'Please select a network.';
        }
        return null;
      },
      decoration: InputDecoration(
        hintText: isFr ? 'Choisissez un réseau' : 'Choose a network',
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

  Widget _buildNumeroInput(ThemeData theme, bool isFr) {
    return TextFormField(
      controller: _numeroController,
      keyboardType: TextInputType.phone,
      style: GoogleFonts.poppins(fontWeight: FontWeight.w500),
      decoration: InputDecoration(
        hintText: 'Ex: 2290199000000',
        prefixIcon: Padding(
          padding: const EdgeInsets.only(left: 20, right: 13, top: 14),
          child: FaIcon(FontAwesomeIcons.mobileScreen,
              color: primaryColor, size: 20),
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
          return isFr
              ? 'Veuillez entrer votre numéro.'
              : 'Please enter your number.';
        }
        if (!RegExp(r'^[0-9]{10,15}$').hasMatch(value)) {
          return isFr ? 'Format de numéro invalide.' : 'Invalid number format.';
        }
        return null;
      },
    );
  }

  Widget _buildFormatHint(bool isFr) {
    return Padding(
      padding: const EdgeInsets.only(left: 12.0),
      child: Text(
        isFr
            ? "Saisissez le numéro au format international, sans le '+' (ex: 229XXXXXXXX)."
            : "Enter the number in international format, without '+' (e.g. 229XXXXXXXX).",
        style: GoogleFonts.poppins(
          fontSize: 12,
          color: Colors.grey[600],
        ),
      ),
    );
  }

  Widget _buildWarningBox(bool isFr) {
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
                  isFr
                      ? "Vérifiez attentivement vos informations"
                      : "Please verify your information carefully",
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
          _warningListItem(isFr
              ? "Assurez-vous que le numéro saisi est correct et vous appartient."
              : "Make sure the number you entered is correct and belongs to you."),
          SizedBox(height: 8),
          _warningListItem(isFr
              ? "Vérifiez que le numéro correspond bien au réseau de paiement sélectionné."
              : "Verify that the number matches the selected payment network."),
          SizedBox(height: 12),
          Text(
            isFr
                ? "Dressur ne pourra être tenu responsable en cas de perte de fonds due à un numéro erroné ou non conforme."
                : "Dressur cannot be held responsible for any loss of funds due to an incorrect or non-compliant number.",
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

  Widget _buildSaveButton(bool isFr) {
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
                isFr ? "Enregistrer et Confirmer" : "Save and Confirm",
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
