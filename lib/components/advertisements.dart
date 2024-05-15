import 'dart:async';
import 'dart:convert';
import 'package:dressur/components/padding_and_divider.dart';
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
  final String nombreDeVues;
  final String nombreImpression;

  Advertisement({
    required this.uidUser,
    required this.id,
    required this.image,
    required this.description,
    required this.whatsappNumber,
    required this.pseudoAnnonceur,
    required this.nombreDeVues,
    required this.nombreImpression,
  });
}

class AdvertisementListPage extends StatefulWidget {
  @override
  _AdvertisementListPageState createState() => _AdvertisementListPageState();
}

class _AdvertisementListPageState extends State<AdvertisementListPage> {
  bool rechercheEnCours = true;
  late Future<List<Advertisement>> _futureAdvertisements;

  @override
  void initState() {
    super.initState();
    setState(() {
      _futureAdvertisements = fetchAdvertisements();
    });
  }

  @override
  void dispose() {
    super.dispose();
  }

  Future<List<Advertisement>> fetchAdvertisements() async {
    // Votre logique pour récupérer les annonces
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
          nombreDeVues: data['nombreDeVues'],
          nombreImpression: data['nombreImpression'],
        );
      }).toList();

      return advertisements;
    } else {
      return []; // Retourne une liste vide si aucune annonce n'est disponible
    }
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
    return FutureBuilder<List<Advertisement>>(
      future: _futureAdvertisements,
      builder: (context, snapshot) {
        if (snapshot.connectionState == ConnectionState.waiting) {
          return const Center(
            child:
                CircularProgressIndicator(), // Affichez un indicateur de chargement pendant que les données sont chargées
          );
        } else if (snapshot.hasError) {
          return Center(
            child: Text('Erreur: ${snapshot.error}'),
          );
        } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
          return const Center(
            child: Text('Aucune annonce trouvée'),
          );
        } else {
          return ListView.builder(
            shrinkWrap: true,
            physics: const NeverScrollableScrollPhysics(),
            itemCount: snapshot.data!.length,
            itemBuilder: (context, index) {
              Advertisement advertisement = snapshot.data![index];
              return Container(
                margin:
                    const EdgeInsets.only(left: 7, top: 0, right: 7, bottom: 0),
                child: GestureDetector(
                  onTap: () {
                    setPromotionToWatch(advertisement);
                    // Ouvrir la page de détails au clic sur l'image ou la description
                    Navigator.push(
                      context,
                      MaterialPageRoute(
                        builder: (context) => AdvertisementDetailPage(
                          advertisement: advertisement,
                        ),
                      ),
                    );
                  },
                  child: Column(
                    children: [
                      const SizedBox(height: 1),
                      Card(
                        child: Column(
                          children: [
                            ClipRRect(
                              borderRadius: BorderRadius.circular(3),
                              child: Image.network(
                                advertisement.image,
                                // height: 300,
                                // width: double.infinity,
                                // fit: BoxFit.cover,
                              ),
                            ),
                            const SizedBox(height: 10),
                            Padding(
                                padding:
                                    const EdgeInsets.fromLTRB(10, 0, 10, 10),
                                child: Column(
                                  children: [
                                    Text(
                                      advertisement.description,
                                      maxLines: 5,
                                      overflow: TextOverflow.ellipsis,
                                      style: const TextStyle(
                                        fontWeight: FontWeight.w400,
                                        fontSize: 16,
                                      ),
                                    ),
                                    const SizedBox(height: 5),
                                    Row(
                                      children: [
                                        const Icon(Icons.visibility),
                                        const SizedBox(width: 4),
                                        Text(advertisement.nombreImpression
                                            .toString()),
                                        const SizedBox(width: 16),
                                        const Icon(Icons.touch_app),
                                        const SizedBox(width: 4),
                                        Text(advertisement.nombreDeVues
                                            .toString()),
                                      ],
                                    )
                                  ],
                                ))
                          ],
                        ),
                      ),
                      const SizedBox(height: 1),
                      DressurDivider(),
                    ],
                  ),
                ),
              );
            },
          );
        }
      },
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
        backgroundColor: primaryColor,
        title: Text(
          (langUserPhone == "fr")
              ? 'Détails de la promotion'
              : 'Details of the promotion',
          style: GoogleFonts.poppins(
            color: Colors.white,
            fontWeight: FontWeight.w400,
          ),
        ),
        leading: IconButton(
          onPressed: () {
            Navigator.pop(context);
          },
          icon: const Icon(
            Icons.arrow_back,
            size: 30,
            color: Colors.white,
          ),
        ),
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
                    child: Text(
                      (langUserPhone == "fr")
                          ? "Contacter l'annonceur"
                          : "Contact the announcer",
                      style: GoogleFonts.poppins(
                        fontWeight: FontWeight.w400,
                        color: Colors.white,
                      ),
                    ),
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
