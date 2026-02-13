// ignore_for_file: prefer_const_constructors, use_build_context_synchronously

import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:smooth_page_indicator/smooth_page_indicator.dart';
import 'package:animate_do/animate_do.dart';

// --- Importez vos pages et constantes ---
import 'package:dressur/6_login_register/connexion.dart';
import 'package:dressur/6_login_register/inscription.dart';
import 'package:dressur/components/constant.dart';
import 'package:url_launcher/url_launcher.dart';

class PresentationPage extends StatefulWidget {
  @override
  _PresentationPageState createState() => _PresentationPageState();
}

class _PresentationPageState extends State<PresentationPage> {
  final PageController _pageController = PageController();
  int _currentPage = 0;
  final int _totalPages = 6;

  // On empêche le retour en arrière depuis cette page
  Future<bool> _onWillPop() async => false;

  @override
  Widget build(BuildContext context) {
    return WillPopScope(
      onWillPop: _onWillPop,
      child: Scaffold(
        // Fond dégradé pour un look plus premium
        body: Container(
          decoration: BoxDecoration(
            gradient: LinearGradient(
              begin: Alignment.topLeft,
              end: Alignment.bottomRight,
              colors: [Color(0xFF1A237E), Colors.black], // Bleu nuit vers noir
            ),
          ),
          child: Stack(
            children: [
              // Le PageView avec les images
              PageView.builder(
                controller: _pageController,
                onPageChanged: (int page) =>
                    setState(() => _currentPage = page),
                itemCount: _totalPages,
                itemBuilder: (context, index) => _buildPageContent(index),
              ),
              // Le bouton "Passer"
              _buildSkipButton(),
              // Les contrôles en bas (indicateur + bouton)
              _buildBottomControls(),
            ],
          ),
        ),
      ),
    );
  }

  // --- WIDGETS DE CONSTRUCTION ---

  Widget _buildPageContent(int index) {
    final images = (langUserPhone == "fr")
        ? [
            'presentation_1_fr.png',
            'presentation_2_fr.png',
            'presentation_3_fr.png',
            'presentation_4_fr.png',
            'presentation_7_fr.png',
            'presentation_8_fr.png',
          ]
        : [
            'presentation_1_en.png',
            'presentation_2_en.png',
            'presentation_3_en.png',
            'presentation_4_en.png',
            'presentation_7_en.png',
            'presentation_8_en.png',
          ];

    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 20.0),
      child: Center(
        child: FadeInUp(
          // Animation d'apparition
          duration: Duration(milliseconds: 500),
          child: Image.asset('images/${images[index]}'),
        ),
      ),
    );
  }

  Widget _buildSkipButton() {
    return Align(
      alignment: Alignment.topRight,
      child: Padding(
        padding: const EdgeInsets.only(top: 50.0, right: 20.0),
        child: TextButton(
          onPressed: () => Navigator.pushReplacement(
              context, MaterialPageRoute(builder: (context) => WelcomePage())),
          child: Text(
            langUserPhone == "fr" ? "Passer" : "Skip",
            style: GoogleFonts.poppins(color: Colors.white70, fontSize: 16),
          ),
        ),
      ),
    );
  }

  Widget _buildBottomControls() {
    bool isLastPage = _currentPage == _totalPages - 1;

    return Align(
      alignment: Alignment.bottomCenter,
      child: Padding(
        padding: const EdgeInsets.symmetric(horizontal: 20.0, vertical: 30.0),
        child: Row(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: [
            // Indicateur de page animé
            SmoothPageIndicator(
              controller: _pageController,
              count: _totalPages,
              effect: WormEffect(
                dotHeight: 10,
                dotWidth: 10,
                activeDotColor: primaryColor,
                dotColor: Colors.white24,
              ),
            ),
            // Bouton "Suivant" ou "Démarrer"
            ElevatedButton(
              onPressed: () {
                if (isLastPage) {
                  Navigator.pushReplacement(context,
                      MaterialPageRoute(builder: (context) => WelcomePage()));
                } else {
                  _pageController.nextPage(
                      duration: Duration(milliseconds: 400),
                      curve: Curves.easeInOut);
                }
              },
              child: Text(isLastPage
                  ? (langUserPhone == "fr" ? 'Démarrer' : "Get Started")
                  : (langUserPhone == "fr" ? 'Suivant' : 'Next')),
              style: ElevatedButton.styleFrom(
                backgroundColor: primaryColor,
                foregroundColor: Colors.white,
                shape: StadiumBorder(),
                padding: EdgeInsets.symmetric(horizontal: 30, vertical: 12),
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class WelcomePage extends StatelessWidget {
  Future<void> _launchURL(String url) async {
    if (!await launchUrl(Uri.parse(url),
        mode: LaunchMode.externalApplication)) {
      print('Could not launch $url');
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SafeArea(
        child: Padding(
          padding: const EdgeInsets.symmetric(horizontal: 20.0),
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              Spacer(),
              // Image avec animation
              FadeInDown(
                duration: Duration(milliseconds: 800),
                child: Image.asset('images/welcome.png', height: 250),
              ),
              SizedBox(height: 30),
              // Titre
              FadeInUp(
                duration: Duration(milliseconds: 800),
                delay: Duration(milliseconds: 200),
                child: Text(
                  (langUserPhone == "fr")
                      ? 'Bienvenue sur Dressur'
                      : 'Welcome to Dressur',
                  style: GoogleFonts.poppins(
                      fontSize: 26, fontWeight: FontWeight.bold),
                ),
              ),
              SizedBox(height: 10),
              // Sous-titre
              FadeInUp(
                duration: Duration(milliseconds: 800),
                delay: Duration(milliseconds: 400),
                child: Text(
                  (langUserPhone == "fr")
                      ? 'Connectez-vous ou créez un compte pour commencer.'
                      : 'Log in or create an account to get started.',
                  textAlign: TextAlign.center,
                  style: GoogleFonts.poppins(
                      fontSize: 16, color: Colors.grey[600]),
                ),
              ),
              SizedBox(height: 40),
              // Boutons
              FadeInUp(
                duration: Duration(milliseconds: 800),
                delay: Duration(milliseconds: 600),
                child: Row(
                  children: [
                    Expanded(
                      child: ElevatedButton(
                        onPressed: () => Navigator.push(
                            context,
                            MaterialPageRoute(
                                builder: (context) => LoginPage())),
                        child: Text(
                            (langUserPhone == "fr") ? 'Connexion' : 'Login'),
                        style: ElevatedButton.styleFrom(
                          backgroundColor: primaryColor,
                          foregroundColor: Colors.white,
                          padding: EdgeInsets.symmetric(vertical: 16),
                          shape: RoundedRectangleBorder(
                              borderRadius: BorderRadius.circular(12)),
                        ),
                      ),
                    ),
                    SizedBox(width: 15),
                    Expanded(
                      child: OutlinedButton(
                        onPressed: () => Navigator.push(
                            context,
                            MaterialPageRoute(
                                builder: (context) => InscriptionPage())),
                        child: Text((langUserPhone == "fr")
                            ? 'Inscription'
                            : 'Sign Up'),
                        style: OutlinedButton.styleFrom(
                          foregroundColor: primaryColor,
                          side: BorderSide(color: primaryColor),
                          padding: EdgeInsets.symmetric(vertical: 16),
                          shape: RoundedRectangleBorder(
                              borderRadius: BorderRadius.circular(12)),
                        ),
                      ),
                    ),
                  ],
                ),
              ),
              Spacer(),
              // Liens légaux
              _buildLegalLinks(),
              SizedBox(height: 20),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildLegalLinks() {
    return FadeInUp(
      duration: Duration(milliseconds: 800),
      delay: Duration(milliseconds: 800),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          TextButton(
            onPressed: () => _launchURL(dressurConditionUtilisation),
            child: Text(
              (langUserPhone == "fr")
                  ? "Conditions d'utilisation"
                  : "Terms of Use",
              style: GoogleFonts.poppins(color: Colors.grey[500], fontSize: 12),
            ),
          ),
          Text("•", style: GoogleFonts.poppins(color: Colors.grey[400])),
          TextButton(
            onPressed: () => _launchURL(dressurPolitiqueConfidentialite),
            child: Text(
              (langUserPhone == "fr")
                  ? 'Politique de confidentialité'
                  : "Privacy Policy",
              style: GoogleFonts.poppins(color: Colors.grey[500], fontSize: 12),
            ),
          ),
        ],
      ),
    );
  }
}
