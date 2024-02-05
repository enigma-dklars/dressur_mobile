import 'dart:async';
import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:http/http.dart' as http;
import 'package:url_launcher/url_launcher.dart';
import 'package:dressur/components/constant.dart';

class Advertisement {
  final String uidUser;
  final int id;
  final String image;
  final String description;
  final String whatsappNumber;
  final String pseudoAnnonceur;

  Advertisement({
    required this.uidUser,
    required this.id,
    required this.image,
    required this.description,
    required this.whatsappNumber,
    required this.pseudoAnnonceur,
  });
}

class AdvertisementListPage extends StatefulWidget {
  @override
  _AdvertisementListPageState createState() => _AdvertisementListPageState();
}

class _AdvertisementListPageState extends State<AdvertisementListPage> {
  bool rechercheEnCours = true;
  List<Advertisement> _advertisements = [];
  int _currentIndex = 0;
  Timer? _timer;

  @override
  void initState() {
    super.initState();
    fetchAdvertisements();
    startTimer();
  }

  @override
  void dispose() {
    _timer?.cancel();
    super.dispose();
  }

  Future<void> fetchAdvertisements() async {
    if (lesPublicites.toString().isNotEmpty) {
      final jsonData = jsonDecode(lesPublicites) as List<dynamic>;

      final advertisements = jsonData.map((data) {
        return Advertisement(
          uidUser: data['uidUser'],
          id: data['id'],
          image: generalRouteForPromotionImage + data['image'],
          description: data['description'],
          whatsappNumber: data['whatsappNumber'],
          pseudoAnnonceur: data['pseudoAnnonceur'],
        );
      }).toList();

      setState(() {
        _advertisements = advertisements;
        rechercheEnCours = false;
      });
    }
  }

  void startTimer() {
    _timer = Timer.periodic(const Duration(seconds: 5), (_) {
      if (_advertisements.isNotEmpty) {
        setState(() {
          _currentIndex = (_currentIndex + 1) % _advertisements.length;
        });
      }
    });
  }

  Future<void> setPromotionToWatch(Advertisement advertisement) async {
    // Faites votre requête HTTP ici
    if (advertisement.uidUser != uidUser) {
      final response = await http.get(Uri.parse(
          '$generalRouteForApi/setPromotionToWatch/${advertisement.id}'));
      if (response.statusCode == 200) {
        // print(advertisement.id);
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    return rechercheEnCours
        ? const SizedBox(height: 0)
        : Container(
            margin:
                const EdgeInsets.only(left: 10, top: 0, right: 10, bottom: 0),
            padding:
                const EdgeInsets.only(left: 5, top: 5, right: 5, bottom: 15),
            decoration: BoxDecoration(
              gradient: const LinearGradient(
                begin: Alignment.topCenter,
                end: Alignment.bottomCenter,
                colors: [
                  primaryColor,
                  primaryColor,
                ],
              ),
              borderRadius: BorderRadius.circular(5),
            ),
            child: Column(
              children: [
                Text(
                  (langUserPhone == "fr") ? "Promotions" : "Specials",
                  style: GoogleFonts.poppins(
                    color: Colors.white,
                    fontSize: 16,
                    fontWeight: FontWeight.w600,
                  ),
                  textAlign: TextAlign.center,
                ),
                const SizedBox(height: 5),
                GestureDetector(
                  onTap: () {
                    setPromotionToWatch(_advertisements[_currentIndex]);
                    // Ouvrir la page de détails au clic sur l'image ou la description
                    Navigator.push(
                      context,
                      MaterialPageRoute(
                        builder: (context) => AdvertisementDetailPage(
                          advertisement: _advertisements[_currentIndex],
                        ),
                      ),
                    );
                  },
                  child: ClipRRect(
                    borderRadius: BorderRadius.circular(
                        5), // Définissez le rayon souhaité ici
                    child: Image.network(
                      _advertisements[_currentIndex].image,
                      height: 300,
                      width: double.infinity,
                      fit: BoxFit.cover,
                    ),
                  ),
                ),
                const SizedBox(height: 10),
                Text(
                  _advertisements[_currentIndex].description,
                  maxLines: 3,
                  overflow: TextOverflow.ellipsis,
                  style: const TextStyle(
                    fontWeight: FontWeight.w300,
                    fontSize: 16,
                    color: Colors.white,
                  ),
                ),
              ],
            ),
          );
  }
}

class AdvertisementDetailPage extends StatelessWidget {
  final Advertisement advertisement;

  AdvertisementDetailPage({required this.advertisement});

  void openWhatsAppChat() async {
    String text;
    if (langUserPhone == "fr") {
      text =
          "Bonjour/Bonsoir *${advertisement.pseudoAnnonceur}*, j'ai une question concernant la promotion ci-dessous: \n\n";
    } else {
      text =
          "Good morning or Good evening *${advertisement.pseudoAnnonceur}*, I have a question regarding the promotion below: \n\n";
    }

    // Vérification de la longueur de la description
    if (advertisement.description.length >= 100) {
      text +=
          "<<${advertisement.description.substring(0, 100)}...>>\n\n*Depuis Dressur.*";
    } else {
      text += "<<${advertisement.description}>>\n\n*Depuis Dressur.*";
    }

    String encodedText = Uri.encodeComponent(text);

    String url =
        'https://wa.me/${advertisement.whatsappNumber}?text=$encodedText';

    final Uri _url = Uri.parse(url);
    if (!await launchUrl(_url, mode: LaunchMode.externalApplication)) {
      throw 'Could not launch $_url';
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
          (langUserPhone == "fr")
              ? 'Détails de la promotion'
              : 'Details of the promotion',
          style: GoogleFonts.poppins(fontWeight: FontWeight.w600),
        ),
        backgroundColor: primaryColor,
      ),
      body: SingleChildScrollView(
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.stretch,
          children: [
            Image.network(
              advertisement.image,
            ),
            const SizedBox(height: 5),
            Container(
              margin: const EdgeInsets.only(
                  left: 10, top: 0, right: 10, bottom: 20),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.end,
                children: [
                  ElevatedButton(
                    style: ElevatedButton.styleFrom(
                      backgroundColor: primaryColor,
                    ),
                    onPressed: () {
                      openWhatsAppChat();
                    },
                    child: Text((langUserPhone == "fr")
                        ? "Contacter l'annonceur"
                        : "Contact the announcer"),
                  ),
                  const SizedBox(height: 5),
                  Text(
                    advertisement.description,
                    style: GoogleFonts.poppins(
                      fontSize: 16,
                      fontWeight: FontWeight.w600,
                    ),
                  ),
                ],
              ),
            )
          ],
        ),
      ),
    );
  }
}
