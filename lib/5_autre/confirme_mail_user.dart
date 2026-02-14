// ignore_for_file: prefer_const_constructors, use_build_context_synchronously

import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/5_autre/support_assistance.dart';
import 'package:dressur/components/bottomBar.dart';
import 'package:dressur/components/constant.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;
import 'package:dressur/components/noti.dart';
import 'package:pinput/pinput.dart'; // Import du package Pinput

class CodeMailConfirmePage extends StatefulWidget {
  @override
  State<CodeMailConfirmePage> createState() => _CodeMailConfirmePageState();
}

class _CodeMailConfirmePageState extends State<CodeMailConfirmePage> {
  final _pinController = TextEditingController();
  final _formKey = GlobalKey<FormState>();
  bool _isConfirming = false;
  bool _isResending = false;

  // --- LOGIQUE API (regroupée pour la clarté) ---

  Future<void> _resendCode() async {
    if (_isResending) return;
    setState(() => _isResending = true);

    try {
      var request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/sendMailVerification'));
      request.fields
          .addAll({'uid': uidUser, 'langUserPhone': langUserPhone.toString()});
      http.StreamedResponse response = await request.send();

      if (response.statusCode == 200) {
        var data = convert.jsonDecode(await response.stream.bytesToString());
        if (data["error"] == true) {
          dangerNoti(data["titre"], data["message"], context);
        } else {
          successNoti(
            (langUserPhone == "fr") ? "Code Renvoyé !" : "Code Resent!",
            (langUserPhone == "fr")
                ? "Un nouveau code a été envoyé à votre adresse e-mail."
                : "A new code has been sent to your email address.",
            context,
          );
        }
      } else {
        dangerNoti("Erreur", "Impossible de renvoyer le code.", context);
      }
    } catch (e) {
      dangerNoti("Erreur", "Problème de connexion.", context);
    }

    setState(() => _isResending = false);
  }

  Future<void> _verifyCode(String pin) async {
    if (pin.length < 4) return; // Assurez-vous que le code est complet
    setState(() => _isConfirming = true);

    try {
      var request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/mailVerification'));
      request.fields.addAll({
        'uid': uidUser,
        'langUserPhone': langUserPhone.toString(),
        'codeForVerifMail': pin
      });
      http.StreamedResponse response = await request.send();

      if (response.statusCode == 200) {
        var data = convert.jsonDecode(await response.stream.bytesToString());
        if (data["error"] == true) {
          dangerNoti(data["titre"], data["message"], context);
        } else {
          setState(() => mailIsVerified = true);
          initUserInformations(data['user']);
          // Afficher un message de succès avant de naviguer
          successNoti("Succès !", "Votre e-mail a été confirmé.", context);
          await Future.delayed(Duration(seconds: 2));
          Navigator.pushAndRemoveUntil(
            context,
            MaterialPageRoute(builder: (context) => const BottomBar()),
            (route) => false,
          );
        }
      } else {
        dangerNoti("Erreur", "Impossible de vérifier le code.", context);
      }
    } catch (e) {
      dangerNoti("Erreur", "Problème de connexion.", context);
    }

    setState(() => _isConfirming = false);
  }

  @override
  Widget build(BuildContext context) {
    final isDark = Theme.of(context).brightness == Brightness.dark;

    // Thème pour Pinput
    final defaultPinTheme = PinTheme(
      width: 56,
      height: 60,
      textStyle: GoogleFonts.poppins(fontSize: 22, fontWeight: FontWeight.w600),
      decoration: BoxDecoration(
        color: isDark ? Colors.grey[800] : Colors.grey[100],
        borderRadius: BorderRadius.circular(12),
      ),
    );

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
          (langUserPhone == "fr")
              ? "Confirmation du Mail"
              : "Email Confirmation",
          style: GoogleFonts.poppins(
            color: Colors.white,
            fontWeight: FontWeight.w400,
            fontSize: 18,
          ),
        ),
        actions: [
          PopupMenuButton<int>(
            itemBuilder: (context) => [
              PopupMenuItem(
                value: 1,
                child: Row(
                  children: [
                    Text(
                      (langUserPhone == "fr") ? "Actualiser" : "Refresh",
                    ),
                  ],
                ),
              ),
              PopupMenuItem(
                value: 2,
                child: Row(
                  children: [
                    Text(
                      (langUserPhone == "fr") ? "Aide" : "Help",
                    ),
                  ],
                ),
              ),
            ],
            offset: const Offset(0, 60),
            color: primaryColor,
            elevation: 2,
            onSelected: (value) {
              if (value == 2) {
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
        padding: const EdgeInsets.all(20.0),
        child: Form(
          key: _formKey,
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.center,
            children: [
              SizedBox(height: 20),
              Icon(Icons.mark_email_read_outlined,
                  color: primaryColor, size: 80),
              SizedBox(height: 20),
              Text(
                (langUserPhone == "fr")
                    ? "Vérifiez vos e-mails"
                    : "Check Your Email",
                style: GoogleFonts.poppins(
                    fontSize: 24, fontWeight: FontWeight.bold),
              ),
              SizedBox(height: 10),
              Text(
                (langUserPhone == "fr")
                    ? "Nous avons envoyé un code de confirmation à votre adresse : $mail"
                    : "We've sent a confirmation code to your address: $mail",
                textAlign: TextAlign.center,
                style: GoogleFonts.poppins(
                    fontSize: 15, color: Colors.grey[600], height: 1.5),
              ),
              SizedBox(height: 40),

              // --- CHAMP DE SAISIE PINPUT ---
              Pinput(
                length: 6, // Ajustez selon la longueur de votre code
                controller: _pinController,
                defaultPinTheme: defaultPinTheme,
                focusedPinTheme: defaultPinTheme.copyWith(
                  decoration: defaultPinTheme.decoration!.copyWith(
                    border: Border.all(color: primaryColor, width: 2),
                  ),
                ),
                onCompleted: (pin) => _verifyCode(pin),
              ),
              SizedBox(height: 40),

              // --- BOUTON DE CONFIRMATION ---
              SizedBox(
                width: double.infinity,
                child: ElevatedButton(
                  onPressed: _isConfirming
                      ? null
                      : () => _verifyCode(_pinController.text),
                  style: ElevatedButton.styleFrom(
                    backgroundColor: primaryColor,
                    foregroundColor: Colors.white,
                    padding: EdgeInsets.symmetric(vertical: 16),
                    shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(12)),
                  ),
                  child: _isConfirming
                      ? SizedBox(
                          height: 24,
                          width: 24,
                          child: CircularProgressIndicator(
                              color: Colors.white, strokeWidth: 3))
                      : Text(
                          (langUserPhone == "fr") ? "CONFIRMER" : "CONFIRM",
                          style: GoogleFonts.poppins(
                              fontWeight: FontWeight.bold, fontSize: 16),
                        ),
                ),
              ),
              SizedBox(height: 20),

              // --- BOUTON POUR RENVOYER LE CODE ---
              TextButton(
                onPressed: _isResending ? null : _resendCode,
                child: _isResending
                    ? Text(
                        (langUserPhone == "fr")
                            ? "Envoi en cours..."
                            : "Sending...",
                        style: GoogleFonts.poppins(color: Colors.grey),
                      )
                    : Text(
                        (langUserPhone == "fr")
                            ? "Renvoyer le code"
                            : "Resend Code",
                        style: GoogleFonts.poppins(
                            fontWeight: FontWeight.w600, color: primaryColor),
                      ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
