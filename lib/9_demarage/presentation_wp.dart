import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:url_launcher/url_launcher.dart';
import 'package:whatsperson/7_login/connexion.dart';
import 'package:whatsperson/8_register/inscription.dart';
import 'package:whatsperson/components/constant.dart';

class PresentationPage extends StatefulWidget {
  @override
  _PresentationPageState createState() => _PresentationPageState();
}

class _PresentationPageState extends State<PresentationPage> {
  final PageController _pageController = PageController();
  int _currentPage = 0;
  int _totalPages = 5; // Nombre total de pages

  Future<bool> _onWillPop() async {
    return false;
  }

  @override
  Widget build(BuildContext context) {
    return WillPopScope(
      onWillPop: _onWillPop,
      child: Scaffold(
        body: Column(
          children: [
            Expanded(
              child: PageView.builder(
                controller: _pageController,
                onPageChanged: (int page) {
                  setState(() {
                    _currentPage = page;
                  });
                },
                itemCount: _totalPages,
                itemBuilder: (BuildContext context, int index) {
                  return buildPage(index);
                },
              ),
            ),
            buildIndicator(),
            const SizedBox(height: 16.0),
            Padding(
              padding: const EdgeInsets.only(right: 16.0),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.end,
                children: [
                  buildButton(),
                ],
              ),
            ),
            const SizedBox(height: 16.0),
          ],
        ),
      ),
    );
  }

  Widget buildPage(int index) {
    // Liste de textes et d'images pour chaque page
    List<String> imagesFr = [
      'presentation_1_fr.png',
      'presentation_2_fr.png',
      'presentation_3_fr.png',
      'presentation_4_fr.png',
      'presentation_5_fr.png',
    ];
    List<String> imagesEn = [
      'presentation_1_en.png',
      'presentation_2_en.png',
      'presentation_3_en.png',
      'presentation_4_en.png',
      'presentation_5_en.png',
    ];

    return Padding(
      padding: const EdgeInsets.fromLTRB(2, 16, 2, 16),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          if (langUserPhone != "fr")
            Image.asset('images/${imagesEn[index]}')
          else
            Image.asset('images/${imagesFr[index]}'),
          const SizedBox(height: 16.0),
          // Text(
          //   texts[index],
          //   style: const TextStyle(fontSize: 20.0),
          //   textAlign: TextAlign.center,
          // ),
        ],
      ),
    );
  }

  Widget buildIndicator() {
    return Row(
      mainAxisAlignment: MainAxisAlignment.center,
      children: List.generate(
        _totalPages,
        (index) => buildIndicatorItem(index),
      ),
    );
  }

  Widget buildIndicatorItem(int index) {
    Color color = _currentPage == index ? Colors.blue : Colors.blue.shade200;
    double size = _currentPage == index ? 12.0 : 8.0;

    return Container(
      margin: const EdgeInsets.symmetric(horizontal: 4.0),
      width: size,
      height: size,
      decoration: BoxDecoration(
        shape: BoxShape.circle,
        color: color,
      ),
    );
  }

  Widget buildButton() {
    bool isLastPage = _currentPage == _totalPages - 1;

    if (isLastPage) {
      return ElevatedButton(
        onPressed: () {
          // Naviguer vers une autre page
          Navigator.push(
            context,
            MaterialPageRoute(
              builder: (context) => AutrePage(),
            ),
          );
        },
        child: Text((langUserPhone == "fr") ? 'Démarrer' : "To start up"),
      );
    } else {
      return ElevatedButton(
        onPressed: () {
          _pageController.nextPage(
            duration: const Duration(milliseconds: 500),
            curve: Curves.ease,
          );
        },
        child: Text((langUserPhone == "fr") ? 'Suivant' : 'Next'),
      );
    }
  }
}

class AutrePage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text(' '),
      ),
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Image.asset(
                'images/welcome.png'), // Remplacez "other_image.png" par le chemin de votre image
            const SizedBox(height: 16.0),
            Text(
              (langUserPhone == "fr")
                  ? 'Avez-vous un compte ?'
                  : 'Do you have an account?',
              style: const TextStyle(fontSize: 20.0),
            ),
            const SizedBox(height: 16.0),
            Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                ElevatedButton(
                  onPressed: () {
                    // Naviguer vers la page d'inscription
                    Navigator.push(
                      context,
                      MaterialPageRoute(
                          builder: (context) => InscriptionPage()),
                    );
                  },
                  child: Text(
                    (langUserPhone == "fr") ? 'Inscription' : 'Registration',
                  ),
                ),
                const SizedBox(width: 16.0),
                ElevatedButton(
                  onPressed: () {
                    // Naviguer vers la page de connexion
                    Navigator.push(
                      context,
                      MaterialPageRoute(builder: (context) => LoginPage()),
                    );
                  },
                  child: Text(
                    (langUserPhone == "fr") ? 'Connexion' : 'Login',
                  ),
                ),
              ],
            ),
            Container(
              margin: const EdgeInsets.all(10),
              child: Column(
                children: [
                  GestureDetector(
                    onTap: () async {
                      final Uri _url =
                          Uri.parse(whatsPersonConditionUtilisation);
                      if (!await launchUrl(_url,
                          mode: LaunchMode.externalApplication)) {
                        throw 'Could not launch $_url';
                      }
                    },
                    child: Text(
                      (langUserPhone == "fr")
                          ? "Conditions d'utilisation"
                          : "Terms of use",
                      style: GoogleFonts.poppins(
                        color: secondaryColor,
                        fontSize: 12,
                      ),
                      textAlign: TextAlign.center,
                    ),
                  ),
                  const SizedBox(height: 5),
                  GestureDetector(
                    onTap: () async {
                      final Uri _url =
                          Uri.parse(whatsPersonPolitiqueConfidentialite);
                      if (!await launchUrl(_url,
                          mode: LaunchMode.externalApplication)) {
                        throw 'Could not launch $_url';
                      }
                    },
                    child: Text(
                      (langUserPhone == "fr")
                          ? 'Politiques de confidentialité'
                          : "Privacy policies",
                      style: GoogleFonts.poppins(
                        color: secondaryColor,
                        fontSize: 12,
                      ),
                      textAlign: TextAlign.center,
                    ),
                  ),
                  const SizedBox(height: 10),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}
