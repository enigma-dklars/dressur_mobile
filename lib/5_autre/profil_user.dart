// ignore_for_file: use_build_context_synchronously, prefer_const_constructors

import 'package:dressur/5_autre/autre_profil.dart';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/components/constant.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;
import 'package:dressur/components/noti.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart'; // Pour les icônes des réseaux sociaux

class ProfilPage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    final isDark = Theme.of(context).brightness == Brightness.dark;
    return Scaffold(
      appBar: AppBar(
        elevation: 0,
        backgroundColor: primaryColor,
        leading: IconButton(
          onPressed: () {
            Navigator.pop(context);
          },
          icon: const Icon(
            Icons.arrow_back_ios,
            color: Colors.white,
          ),
        ),
        title: Text(
          (langUserPhone == "fr") ? "Mon Profil" : "My profile",
          style: GoogleFonts.poppins(
            fontWeight: FontWeight.w400,
            color: Colors.white,
          ),
        ),
        actions: [
          Padding(
            padding: const EdgeInsets.only(right: 10.0),
            child: Row(
              children: [
                GestureDetector(
                  onTap: () {
                    uidAutreUser = uidUser;
                    addUserOnAutreProfilPage = "non";
                    Navigator.of(context).push(
                      MaterialPageRoute(
                        builder: (context) => AutreProfilPage(),
                      ),
                    );
                  },
                  child: const Icon(
                    Icons.info,
                    size: 30.0,
                    color: Colors.white,
                  ),
                )
              ],
            ),
          ),
        ],
      ),
      body: SingleChildScrollView(
        physics: BouncingScrollPhysics(),
        child: Padding(
          padding: const EdgeInsets.all(15.0),
          child: Column(
            children: [
              // --- EN-TÊTE VISUELLE ---
              Icon(Icons.person_pin_circle_outlined,
                  size: 60, color: primaryColor),
              SizedBox(height: 10),
              Text(
                (langUserPhone == "fr")
                    ? "Complétez vos informations"
                    : "Complete your information",
                style: GoogleFonts.poppins(
                    fontSize: 18, fontWeight: FontWeight.w500),
              ),
              SizedBox(height: 5),
              Text(
                (langUserPhone == "fr")
                    ? "Un profil complet inspire confiance."
                    : "A complete profile inspires trust.",
                style:
                    GoogleFonts.poppins(fontSize: 14, color: Colors.grey[600]),
              ),
              SizedBox(height: 25),
              // --- FORMULAIRE ---
              RegisterForm(),
            ],
          ),
        ),
      ),
    );
  }
}

class RegisterForm extends StatefulWidget {
  @override
  State<RegisterForm> createState() => _RegisterFormState();
}

class _RegisterFormState extends State<RegisterForm> {
  bool _isLoading = false;
  final _formKey = GlobalKey<FormState>();

  final telController = TextEditingController(text: tel);
  final emailController = TextEditingController(text: mail);
  final nameController = TextEditingController(text: nom);
  final pseudoController = TextEditingController(text: pseudo);
  final aproposController = TextEditingController(text: apropos);
  final tiktokController = TextEditingController(text: tiktok);
  final instagramController = TextEditingController(text: instagram);
  final facebookController = TextEditingController(text: facebook);
  final youtubeController = TextEditingController(text: youtube);

  Future<void> _updateProfile() async {
    if (!_formKey.currentState!.validate()) return;
    setState(() => _isLoading = true);

    try {
      var request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/updateUserInfo'));
      request.fields.addAll({
        'uid': uidUser,
        'langUserPhone': langUserPhone.toString(),
        'tel': telController.text,
        'mail': emailController.text,
        'nom': nameController.text,
        'pseudo': pseudoController.text,
        'apropos': aproposController.text,
        'tiktok': tiktokController.text,
        'instagram': instagramController.text,
        'facebook': facebookController.text,
        'youtube': youtubeController.text,
      });
      http.StreamedResponse response = await request.send();
      if (response.statusCode == 200) {
        var data = convert.jsonDecode(await response.stream.bytesToString());
        if (data["error"] == true) {
          dangerNoti(data["titre"], data["message"], context);
        } else {
          initUserInformations(data['user']);
          Navigator.pop(context);
          ScaffoldMessenger.of(context).showSnackBar(SnackBar(
            backgroundColor: Colors.green,
            behavior: SnackBarBehavior.floating,
            content: Text(
                (langUserPhone == "fr")
                    ? 'Profil mis à jour !'
                    : 'Profile updated!',
                style: GoogleFonts.poppins(color: Colors.white)),
          ));
        }
      } else {
        dangerNoti("Erreur", "Un problème est survenu.", context);
      }
    } catch (e) {
      dangerNoti("Erreur", "Impossible de se connecter au serveur.", context);
    }

    setState(() => _isLoading = false);
  }

  @override
  Widget build(BuildContext context) {
    return Form(
      key: _formKey,
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          // --- SECTION INFORMATIONS DE BASE ---
          _buildSectionTitle((langUserPhone == "fr")
              ? "Informations de base"
              : "Basic Information"),
          _buildTextField(
              controller: nameController,
              label: (langUserPhone == "fr")
                  ? 'Nom & Prénom(s)'
                  : "Last & First Name",
              icon: Icons.person_outline_rounded),
          SizedBox(height: 12),
          _buildTextField(
              controller: pseudoController,
              label: 'Pseudo',
              icon: Icons.alternate_email_rounded),
          SizedBox(height: 12),
          _buildTextField(
              controller: emailController,
              label: 'E-mail',
              icon: Icons.mail_outline_rounded,
              keyboardType: TextInputType.emailAddress),
          SizedBox(height: 12),
          if (telIsVerified == false) ...[
            _buildTextField(
                controller: telController,
                label: (langUserPhone == "fr")
                    ? 'Numéro WhatsApp'
                    : 'WhatsApp Number',
                icon: Icons.phone_outlined,
                keyboardType: TextInputType.phone),
            SizedBox(height: 12),
          ],

          // --- SECTION RÉSEAUX SOCIAUX ---
          _buildSectionTitle((langUserPhone == "fr")
              ? "Réseaux Sociaux (Optionnel)"
              : "Social Media (Optional)"),
          _buildTextField(
              controller: tiktokController,
              label: 'Lien TikTok',
              icon: FontAwesomeIcons.tiktok),
          SizedBox(height: 12),
          _buildTextField(
              controller: instagramController,
              label: 'Lien Instagram',
              icon: FontAwesomeIcons.instagram),
          SizedBox(height: 12),
          _buildTextField(
              controller: facebookController,
              label: 'Lien Facebook',
              icon: FontAwesomeIcons.facebook),
          SizedBox(height: 12),
          _buildTextField(
              controller: youtubeController,
              label: 'Lien YouTube',
              icon: FontAwesomeIcons.youtube),
          SizedBox(height: 12),

          // --- SECTION BIOGRAPHIE ---
          _buildSectionTitle(
              (langUserPhone == "fr") ? "Biographie" : "About You"),
          _buildTextField(
              controller: aproposController,
              label: (langUserPhone == "fr")
                  ? 'Parlez un peu de vous...'
                  : 'Tell us a bit about yourself...',
              icon: Icons.edit_note_rounded,
              maxLines: 4),
          SizedBox(height: 30),

          // --- BOUTON D'ENREGISTREMENT ---
          SizedBox(
            width: double.infinity,
            child: ElevatedButton.icon(
              onPressed: _isLoading ? null : _updateProfile,
              icon: _isLoading
                  ? Container()
                  : Icon(Icons.save, color: Colors.white),
              label: _isLoading
                  ? SizedBox(
                      height: 24,
                      width: 24,
                      child: CircularProgressIndicator(
                          color: Colors.white, strokeWidth: 3))
                  : Text(
                      (langUserPhone == "fr") ? "ENREGISTRER" : "SAVE",
                      style: GoogleFonts.poppins(
                          fontWeight: FontWeight.bold,
                          fontSize: 16,
                          color: Colors.white),
                    ),
              style: ElevatedButton.styleFrom(
                backgroundColor: primaryColor,
                padding: EdgeInsets.symmetric(vertical: 16),
                shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(12)),
              ),
            ),
          ),
        ],
      ),
    );
  }

  // --- WIDGETS HELPERS POUR LE DESIGN ---

  Widget _buildSectionTitle(String title) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 10, top: 15),
      child: Text(
        title,
        style: GoogleFonts.poppins(
            fontSize: 14, fontWeight: FontWeight.bold, color: primaryColor),
      ),
    );
  }

  Widget _buildTextField({
    required TextEditingController controller,
    required String label,
    required IconData icon,
    int maxLines = 1,
    TextInputType? keyboardType,
  }) {
    final isDark = Theme.of(context).brightness == Brightness.dark;
    return TextFormField(
      controller: controller,
      maxLines: maxLines,
      keyboardType: keyboardType,
      style: GoogleFonts.poppins(fontWeight: FontWeight.w500),
      decoration: InputDecoration(
        labelText: label,
        labelStyle: GoogleFonts.poppins(color: Colors.grey[600]),
        prefixIcon: Icon(icon, color: Colors.grey[500], size: 20),
        filled: true,
        fillColor: isDark ? Colors.grey[850] : Colors.grey[100],
        border: OutlineInputBorder(
          borderRadius: BorderRadius.circular(12),
          borderSide: BorderSide.none,
        ),
        focusedBorder: OutlineInputBorder(
          borderRadius: BorderRadius.circular(12),
          borderSide: BorderSide(color: primaryColor, width: 2),
        ),
      ),
      validator: (value) {
        if (label.contains('Nom') && (value == null || value.trim().isEmpty)) {
          return (langUserPhone == "fr")
              ? 'Le nom est requis.'
              : 'Name is required.';
        }
        return null;
      },
    );
  }
}
