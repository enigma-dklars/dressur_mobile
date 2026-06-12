// ignore_for_file: use_build_context_synchronously, prefer_const_constructors

import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:animate_do/animate_do.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;
import 'dart:async';
import 'package:app_links/app_links.dart';
import 'package:url_launcher/url_launcher.dart';

import 'package:dressur/6_login_register/mot_de_passe_oublier.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/noti.dart';
import 'package:dressur/components/bottomBar.dart';
import 'package:dressur/5_autre/support_assistance.dart';


class LoginPage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    final isDark = Theme.of(context).brightness == Brightness.dark;
    return Scaffold(
      backgroundColor: isDark ? Color(0xFF121212) : Colors.white,
      appBar: AppBar(
        elevation: 0,
        backgroundColor: Colors.transparent,
        foregroundColor: isDark ? Colors.white : Colors.black,
        actions: [
          IconButton(
            onPressed: () => Navigator.push(context,
                MaterialPageRoute(builder: (context) => SupportPage())),
            icon: FaIcon(FontAwesomeIcons.circleQuestion),
          ),
        ],
      ),
      body: SingleChildScrollView(
        physics: BouncingScrollPhysics(),
        child: Padding(
          padding: const EdgeInsets.symmetric(horizontal: 20.0),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              SizedBox(height: 20),
              FadeInDown(
                duration: Duration(milliseconds: 500),
                child: Text(
                  (langUserPhone == "fr")
                      ? "Ravi de vous revoir !"
                      : "Welcome Back!",
                  style: GoogleFonts.poppins(
                      fontSize: 32, fontWeight: FontWeight.bold),
                ),
              ),
              SizedBox(height: 10),
              FadeInDown(
                duration: Duration(milliseconds: 500),
                delay: Duration(milliseconds: 200),
                child: Text(
                  (langUserPhone == "fr")
                      ? "Connectez-vous pour continuer votre aventure."
                      : "Log in to continue your adventure.",
                  style: GoogleFonts.poppins(
                      fontSize: 16, color: Colors.grey[600]),
                ),
              ),
              SizedBox(height: 50),
              LoginForm(),
            ],
          ),
        ),
      ),
    );
  }
}

class LoginForm extends StatefulWidget {
  @override
  State<LoginForm> createState() => _LoginFormState();
}

class _LoginFormState extends State<LoginForm> {
  final _formKey = GlobalKey<FormState>();
  bool _isLoading = false;
  bool _isGoogleLoading = false;
  bool _isPasswordObscured = true;
  final _emailController = TextEditingController(text: mailConnexion);
  final _passwordController = TextEditingController();

  @override
  void dispose() {
    _emailController.dispose();
    _passwordController.dispose();
    super.dispose();
  }

  Future<void> _login() async {
    if (!_formKey.currentState!.validate()) return;

    setState(() => _isLoading = true);
    try {
      bool isConnected = await isConnectedToInternet();
      if (!isConnected) {
        throw Exception((langUserPhone == "fr")
            ? "Pas de connexion internet."
            : "No internet connection.");
      }

      var request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/connect'));
      request.fields.addAll({
        'mail': _emailController.text,
        'password': _passwordController.text,
        'langUserPhone': langUserPhone.toString()
      });

      http.StreamedResponse response = await request.send();
      var responseBody = await response.stream.bytesToString();
      var data = convert.jsonDecode(responseBody);

      if (response.statusCode == 200 && data["error"] == false) {
        initUserInformations(data["user"]);
        Navigator.of(context).pushReplacement(
            MaterialPageRoute(builder: (context) => const BottomBar()));
      } else {
        throw Exception(data["message"] ?? "Une erreur est survenue.");
      }
    } catch (e) {
      dangerNoti((langUserPhone == "fr") ? "Erreur" : "Error",
          e.toString().replaceAll("Exception: ", ""), context);
    } finally {
      if (mounted) setState(() => _isLoading = false);
    }
  }

  Future<void> _signInWithGoogle() async {
    setState(() => _isGoogleLoading = true);
    try {
      bool isConnected = await isConnectedToInternet();
      if (!isConnected) {
        throw Exception((langUserPhone == "fr")
            ? "Pas de connexion internet."
            : "No internet connection.");
      }

      // Récupérer l'URL OAuth générée par le serveur (client_id géré côté serveur)
      final urlResp = await http.get(
        Uri.parse('$generalRouteForApi/auth/google/mobile-url'),
      );
      if (urlResp.statusCode != 200) {
        throw Exception((langUserPhone == "fr")
            ? "Impossible de contacter le serveur."
            : "Unable to reach server.");
      }
      final authUrl = Uri.parse(
        (convert.jsonDecode(urlResp.body) as Map<String, dynamic>)['url'] as String,
      );

      final completer = Completer<Uri>();
      final appLinks = AppLinks();
      StreamSubscription<Uri>? sub;

      sub = appLinks.uriLinkStream.listen((uri) {
        if (uri.scheme == 'com.dressur.ds' && !completer.isCompleted) {
          completer.complete(uri);
        }
      });

      await launchUrl(authUrl, mode: LaunchMode.externalApplication);

      Uri resultUri;
      try {
        resultUri = await completer.future.timeout(const Duration(minutes: 5));
      } finally {
        sub.cancel();
      }

      final error = resultUri.queryParameters['error'];
      if (error != null) {
        throw Exception((langUserPhone == "fr")
            ? "Erreur Google : $error"
            : "Google error: $error");
      }

      final signedToken = resultUri.queryParameters['t'];
      if (signedToken == null) {
        throw Exception((langUserPhone == "fr")
            ? "Autorisation Google annulée."
            : "Google authorization cancelled.");
      }

      // Échanger le token signé contre les données utilisateur
      final response = await http.post(
        Uri.parse('$generalRouteForApi/auth/google/mobile-finalize'),
        body: {
          't': signedToken,
          'langUserPhone': langUserPhone.toString(),
        },
      );

      final data = convert.jsonDecode(response.body);

      if (response.statusCode == 200 && data["error"] == false) {
        await initUserInformations(data["user"]);
        Navigator.of(context).pushReplacement(
            MaterialPageRoute(builder: (context) => const BottomBar()));
      } else {
        throw Exception(data["message"] ?? "Erreur de connexion Google.");
      }
    } catch (e) {
      if (mounted) {
        dangerNoti(
          (langUserPhone == "fr") ? "Erreur Google" : "Google Error",
          e.toString().replaceAll("Exception: ", ""),
          context,
        );
      }
    } finally {
      if (mounted) setState(() => _isGoogleLoading = false);
    }
  }

  @override
  Widget build(BuildContext context) {
    final isDark = Theme.of(context).brightness == Brightness.dark;

    return Form(
      key: _formKey,
      child: Column(
        children: [
          // --- CHAMP E-MAIL ---
          FadeInUp(
            duration: Duration(milliseconds: 500),
            delay: Duration(milliseconds: 400),
            child: TextFormField(
              controller: _emailController,
              keyboardType: TextInputType.emailAddress,
              decoration: _buildInputDecoration(
                label: "E-mail",
                icon: FontAwesomeIcons.at,
              ),
              validator: (value) {
                if (value == null || value.isEmpty || !value.contains('@')) {
                  return (langUserPhone == "fr")
                      ? 'Veuillez entrer un email valide.'
                      : 'Please enter a valid email.';
                }
                return null;
              },
            ),
          ),
          SizedBox(height: 20),

          // --- CHAMP MOT DE PASSE ---
          FadeInUp(
            duration: Duration(milliseconds: 500),
            delay: Duration(milliseconds: 600),
            child: TextFormField(
              controller: _passwordController,
              obscureText: _isPasswordObscured,
              decoration: _buildInputDecoration(
                label:
                    (langUserPhone == "fr") ? 'Mot de passe' : 'Password',
                icon: FontAwesomeIcons.lock,
                suffixIcon: IconButton(
                  icon: FaIcon(
                    _isPasswordObscured
                        ? FontAwesomeIcons.eyeSlash
                        : FontAwesomeIcons.eye,
                    size: 18,
                  ),
                  onPressed: () => setState(
                      () => _isPasswordObscured = !_isPasswordObscured),
                ),
              ),
              validator: (value) {
                if (value == null || value.isEmpty) {
                  return (langUserPhone == "fr")
                      ? 'Le mot de passe est requis.'
                      : 'Password is required.';
                }
                return null;
              },
            ),
          ),
          SizedBox(height: 15),

          // --- LIEN MOT DE PASSE OUBLIÉ ---
          FadeInUp(
            duration: Duration(milliseconds: 500),
            delay: Duration(milliseconds: 700),
            child: Align(
              alignment: Alignment.centerRight,
              child: TextButton(
                onPressed: () => Navigator.push(
                    context,
                    MaterialPageRoute(
                        builder: (context) => RecuperationPage())),
                child: Text(
                  (langUserPhone == "fr")
                      ? "Mot de passe oublié ?"
                      : "Forgot password?",
                  style: GoogleFonts.poppins(
                      color: primaryColor, fontWeight: FontWeight.w600),
                ),
              ),
            ),
          ),
          SizedBox(height: 30),

          // --- BOUTON DE CONNEXION CLASSIQUE ---
          FadeInUp(
            duration: Duration(milliseconds: 500),
            delay: Duration(milliseconds: 800),
            child: SizedBox(
              width: double.infinity,
              child: ElevatedButton(
                onPressed: _isLoading ? null : _login,
                child: _isLoading
                    ? SizedBox(
                        width: 24,
                        height: 24,
                        child: CircularProgressIndicator(
                            color: Colors.white, strokeWidth: 2))
                    : Text(
                        (langUserPhone == "fr") ? "Se Connecter" : "Log In"),
                style: ElevatedButton.styleFrom(
                  backgroundColor: primaryColor,
                  foregroundColor: Colors.white,
                  padding: EdgeInsets.symmetric(vertical: 16),
                  textStyle: GoogleFonts.poppins(
                      fontSize: 16, fontWeight: FontWeight.bold),
                  shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(12)),
                ),
              ),
            ),
          ),
          SizedBox(height: 16),

          // --- SÉPARATEUR ---
          FadeInUp(
            duration: Duration(milliseconds: 500),
            delay: Duration(milliseconds: 850),
            child: Row(
              children: [
                Expanded(
                    child: Divider(
                        color: isDark ? Colors.grey[700] : Colors.grey[300])),
                Padding(
                  padding: const EdgeInsets.symmetric(horizontal: 12),
                  child: Text(
                    (langUserPhone == "fr") ? "ou" : "or",
                    style: GoogleFonts.poppins(
                        fontSize: 13,
                        color: isDark ? Colors.grey[400] : Colors.grey[500]),
                  ),
                ),
                Expanded(
                    child: Divider(
                        color: isDark ? Colors.grey[700] : Colors.grey[300])),
              ],
            ),
          ),
          SizedBox(height: 16),

          // --- BOUTON GOOGLE ---
          FadeInUp(
            duration: Duration(milliseconds: 500),
            delay: Duration(milliseconds: 900),
            child: SizedBox(
              width: double.infinity,
              child: OutlinedButton(
                onPressed: _isGoogleLoading ? null : _signInWithGoogle,
                style: OutlinedButton.styleFrom(
                  padding: EdgeInsets.symmetric(vertical: 14),
                  side: BorderSide(
                      color:
                          isDark ? Colors.grey[600]! : Colors.grey[300]!),
                  shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(12)),
                  backgroundColor:
                      isDark ? Color(0xFF1E1E1E) : Colors.white,
                ),
                child: _isGoogleLoading
                    ? SizedBox(
                        width: 22,
                        height: 22,
                        child: CircularProgressIndicator(
                            strokeWidth: 2, color: primaryColor))
                    : Row(
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: [
                          // Logo Google (SVG-like avec texte coloré)
                          Text(
                            'G',
                            style: TextStyle(
                              fontSize: 20,
                              fontWeight: FontWeight.bold,
                              color: Color(0xFF4285F4),
                            ),
                          ),
                          SizedBox(width: 10),
                          Text(
                            (langUserPhone == "fr")
                                ? "Continuer avec Google"
                                : "Continue with Google",
                            style: GoogleFonts.poppins(
                              fontSize: 15,
                              fontWeight: FontWeight.w500,
                              color:
                                  isDark ? Colors.white : Colors.black87,
                            ),
                          ),
                        ],
                      ),
              ),
            ),
          ),
          SizedBox(height: 30),
        ],
      ),
    );
  }

  InputDecoration _buildInputDecoration(
      {required String label, required IconData icon, Widget? suffixIcon}) {
    return InputDecoration(
      labelText: label,
      prefixIcon: Padding(
        padding: const EdgeInsets.only(left: 20, right: 13, top: 14),
        child: FaIcon(
          icon,
          color: primaryColor,
          size: 18,
        ),
      ),
      suffixIcon: suffixIcon,
      border: OutlineInputBorder(borderRadius: BorderRadius.circular(12)),
      focusedBorder: OutlineInputBorder(
        borderRadius: BorderRadius.circular(12),
        borderSide: BorderSide(color: primaryColor, width: 2),
      ),
    );
  }
}
