// ignore_for_file: prefer_const_constructors, use_build_context_synchronously

import 'dart:async';
import 'dart:convert';
import 'package:cached_network_image/cached_network_image.dart';
import 'package:dressur/components/noti.dart';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;
import 'package:dressur/components/constant.dart';
import 'package:url_launcher/url_launcher.dart';

// --- RÉUTILISATION DU BADGE ANIMÉ ---
class AnimatedRewardBadge extends StatefulWidget {
  final VoidCallback onTap;
  const AnimatedRewardBadge({Key? key, required this.onTap}) : super(key: key);

  @override
  State<AnimatedRewardBadge> createState() => _AnimatedRewardBadgeState();
}

class _AnimatedRewardBadgeState extends State<AnimatedRewardBadge>
    with SingleTickerProviderStateMixin {
  late AnimationController _controller;
  late Animation<double> _scaleAnimation;
  late Animation<Color?> _colorAnimation;

  @override
  void initState() {
    super.initState();
    _controller = AnimationController(
      vsync: this,
      duration: const Duration(milliseconds: 2000),
    )..repeat(reverse: true);

    _scaleAnimation = Tween<double>(begin: 1.0, end: 1.1).animate(
      CurvedAnimation(parent: _controller, curve: Curves.easeInOut),
    );

    _colorAnimation = ColorTween(
      begin: primaryColor,
      end: Colors.orangeAccent,
    ).animate(CurvedAnimation(parent: _controller, curve: Curves.linear));
  }

  @override
  void dispose() {
    _controller.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return AnimatedBuilder(
      animation: _controller,
      builder: (context, child) {
        final currentColor = _colorAnimation.value ?? primaryColor;
        return Transform.scale(
          scale: _scaleAnimation.value,
          child: GestureDetector(
            onTap: widget.onTap,
            child: Container(
              padding: const EdgeInsets.all(8),
              decoration: BoxDecoration(
                shape: BoxShape.circle,
                color: currentColor,
                border: Border.all(color: Colors.white, width: 2),
                boxShadow: [
                  BoxShadow(
                    color: currentColor.withOpacity(0.5),
                    blurRadius: 10,
                    spreadRadius: 2,
                  ),
                ],
              ),
              child: const Icon(Icons.stars, color: Colors.white, size: 20),
            ),
          ),
        );
      },
    );
  }
}

class Advertisement {
  final String uidUser;
  final int id;
  final String image;
  final String imageName;
  final String description;
  final String whatsappNumber;
  final String pseudoAnnonceur;
  final String nombreDeVues;
  final String nombreImpression;
  final String typePromotionAffaire;
  final String annotherInfo;
  final bool inProgrammeRecompense;

  Advertisement({
    required this.uidUser,
    required this.id,
    required this.image,
    required this.imageName,
    required this.description,
    required this.whatsappNumber,
    required this.pseudoAnnonceur,
    required this.nombreDeVues,
    required this.nombreImpression,
    required this.typePromotionAffaire,
    required this.annotherInfo,
    required this.inProgrammeRecompense,
  });
}

class BusinessPromotionsPage extends StatefulWidget {
  const BusinessPromotionsPage({Key? key}) : super(key: key);

  @override
  State<BusinessPromotionsPage> createState() => _BusinessPromotionsPageState();
}

class _BusinessPromotionsPageState extends State<BusinessPromotionsPage> {
  late Future<List<Advertisement>> _futurePromotions;

  bool _desactive = false;
  var data;

  @override
  void initState() {
    super.initState();
    _futurePromotions = getPromotionAffaireInProgrammeRecompense();
  }

  Future<List<Advertisement>> getPromotionAffaireInProgrammeRecompense() async {
    // Remplacez par votre route API réelle pour les promotions affaires
    var request = http.MultipartRequest(
        'POST',
        Uri.parse(
            '$generalRouteForApi/getPromotionAffaireInProgrammeRecompense'));
    request.fields.addAll({
      'uid': uidUser,
      'langUserPhone': langUserPhone.toString(),
    });

    http.StreamedResponse response = await request.send();

    if (response.statusCode == 200) {
      var data1 = await response.stream.bytesToString();
      data = convert.jsonDecode(data1);
      if (data["error"] == true) {
        dangerNoti(data["titre"], data["message"], context);
        _desactive = false;
        return [];
      } else {
        _desactive = false;
        // 1. On récupère d'abord la liste des promotions depuis le JSON
        final List<dynamic> promoList = data["promotions"];
        print(data["promotions"]);

        return promoList.map((data) {
          return Advertisement(
            uidUser: data['uidUser'] ?? "",
            id: data['id'],
            imageName: data['image'],
            image: generalRouteForPromotionImage + data['image'],
            description: data['description'] ?? "",
            whatsappNumber: data['whatsappNumber'] ?? "",
            pseudoAnnonceur: data['pseudoAnnonceur'] ?? "",
            nombreDeVues: data['nombreDeVues']?.toString() ?? "0",
            nombreImpression: data['nombreImpression']?.toString() ?? "0",
            typePromotionAffaire: data['typePromotionAffaire'] ?? "",
            annotherInfo: data['annotherInfo'] != null
                ? jsonEncode(data['annotherInfo'])
                : "",
            inProgrammeRecompense: data['inProgrammeRecompense'] == 1,
          );
        }).toList();
      }
    } else {
      _desactive = false;
      return [];
    }
  }

  void _showRewardInfo(BuildContext context) {
    showModalBottomSheet(
      context: context,
      shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.vertical(top: Radius.circular(25))),
      builder: (context) => Container(
        padding: EdgeInsets.all(24),
        child: Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            Icon(Icons.stars, color: primaryColor, size: 50),
            SizedBox(height: 15),
            Text("Promotion Éligible",
                style: GoogleFonts.poppins(
                    fontSize: 20, fontWeight: FontWeight.bold)),
            SizedBox(height: 10),
            Text(
              "Cette promotion affaire vous permet de gagner des récompenses en la partageant.",
              textAlign: TextAlign.center,
              style: GoogleFonts.poppins(color: Colors.grey[600]),
            ),
            SizedBox(height: 20),
            ElevatedButton(
              onPressed: () => Navigator.pop(context),
              style: ElevatedButton.styleFrom(backgroundColor: primaryColor),
              child:
                  Text("J'ai compris", style: TextStyle(color: Colors.white)),
            )
          ],
        ),
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: primaryColor,
        elevation: 0,
        title: Text(
          (langUserPhone == "fr")
              ? "Promotions Affaires"
              : "Business Promotions",
          style: GoogleFonts.poppins(
              color: Colors.white, fontWeight: FontWeight.w500),
        ),
        leading: IconButton(
          icon: Icon(Icons.arrow_back_ios, color: Colors.white),
          onPressed: () => Navigator.pop(context),
        ),
      ),
      body: FutureBuilder<List<Advertisement>>(
        future: _futurePromotions,
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return const Center(
              child: CircularProgressIndicator(),
            );
          } else if (snapshot.hasError) {
            return Center(
              child: Text('Erreur: ${snapshot.error}'),
            );
          } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
            return const Center(
              child: null,
            );
          } else {
            return ListView.builder(
              itemCount: snapshot.data!.length,
              itemBuilder: (context, index) {
                Advertisement advertisement = snapshot.data![index];
                return Container(
                  margin: const EdgeInsets.only(
                      left: 7, top: 0, right: 7, bottom: 0),
                  child: Column(
                    children: [
                      const SizedBox(height: 1),
                      Card(
                        child: Column(
                          children: [
                            GestureDetector(
                              onTap: () {
                                Navigator.push(
                                  context,
                                  MaterialPageRoute(
                                    builder: (context) =>
                                        AdvertisementDetailPage(
                                      advertisement: advertisement,
                                    ),
                                  ),
                                );
                              },
                              child: Column(
                                children: [
                                  Stack(
                                    children: [
                                      ClipRRect(
                                        borderRadius: BorderRadius.circular(3),
                                        child: CachedNetworkImage(
                                          imageUrl: advertisement.image,
                                          placeholder: (context, url) =>
                                              Image.asset(
                                                  'images/placeholder.png'),
                                          errorWidget: (context, url, error) =>
                                              Image.asset(
                                                  'images/error_image.png'),
                                          fit: BoxFit.cover,
                                        ),
                                      ),

                                      // BADGE ÉLIGIBILITÉ (Affiche si inProgrammeRecompense est vrai)
                                      if (advertisement.inProgrammeRecompense)
                                        Positioned(
                                          top: 10,
                                          right: 10,
                                          child: AnimatedRewardBadge(
                                            onTap: () =>
                                                _showRewardInfo(context),
                                          ),
                                        ),
                                    ],
                                  ),
                                  const SizedBox(height: 10),
                                  Padding(
                                    padding: const EdgeInsets.fromLTRB(
                                        10, 0, 10, 10),
                                    child: Column(
                                      children: [
                                        Text(
                                          advertisement.description
                                              .replaceAll('\n', ' '),
                                          maxLines: 4,
                                          overflow: TextOverflow.ellipsis,
                                          style: const TextStyle(
                                            fontWeight: FontWeight.w400,
                                            fontSize: 16,
                                          ),
                                        ),
                                      ],
                                    ),
                                  ),
                                ],
                              ),
                            ),
                            // les icons
                            const SizedBox(height: 5),
                            Padding(
                              padding: const EdgeInsets.fromLTRB(10, 0, 10, 10),
                              child: Row(
                                mainAxisAlignment:
                                    MainAxisAlignment.spaceBetween,
                                children: [
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
                                  ),
                                  Row(
                                    children: [
                                      GestureDetector(
                                        child: Row(
                                          children: [
                                            Icon(Icons.share),
                                            const SizedBox(width: 5),
                                            Text(
                                              (langUserPhone == "fr")
                                                  ? "Partager"
                                                  : "Share",
                                              style: GoogleFonts.poppins(
                                                fontSize: 15,
                                              ),
                                            ),
                                          ],
                                        ),
                                        onTap: (() {
                                          sharePromotion(
                                              context,
                                              advertisement.image,
                                              advertisement.imageName,
                                              advertisement.description);
                                        }),
                                      ),
                                    ],
                                  ),
                                ],
                              ),
                            ),
                          ],
                        ),
                      ),
                      const SizedBox(height: 1),
                    ],
                  ),
                );
              },
            );
          }
        },
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

  void _showRewardInfo(BuildContext context) {
    showModalBottomSheet(
      context: context,
      shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.vertical(top: Radius.circular(25))),
      builder: (context) => Container(
        padding: EdgeInsets.all(20),
        child: Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            Icon(Icons.stars, color: primaryColor, size: 40),
            SizedBox(height: 10),
            Text("Promotion Éligible",
                style: TextStyle(fontWeight: FontWeight.bold, fontSize: 18)),
            SizedBox(height: 10),
            Text("Partagez cette promotion pour gagner des récompenses !"),
            SizedBox(height: 20),
          ],
        ),
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    final Map<String, dynamic> infoMap = (advertisement.annotherInfo != "")
        ? jsonDecode(advertisement.annotherInfo)
        : {};
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
            Icons.arrow_back_ios,
            color: Colors.white,
          ),
        ),
      ),
      body: SingleChildScrollView(
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.stretch,
          children: [
            Stack(
              children: [
                // L'image de la promotion
                ClipRRect(
                  borderRadius: BorderRadius.circular(3),
                  child: CachedNetworkImage(
                    imageUrl: advertisement.image,
                    placeholder: (context, url) =>
                        Image.asset('images/placeholder.png'),
                    errorWidget: (context, url, error) =>
                        Image.asset('images/error_image.png'),
                    fit: BoxFit.cover,
                  ),
                ),

                // LE BADGE (Doit être un enfant direct du Stack pour être visible)
                if (advertisement.inProgrammeRecompense)
                  Positioned(
                    top: 10,
                    right: 10,
                    child: AnimatedRewardBadge(
                      onTap: () => _showRewardInfo(context),
                    ),
                  ),
              ],
            ),
            const SizedBox(height: 5),
            Container(
              margin:
                  const EdgeInsets.only(left: 10, top: 0, right: 10, bottom: 0),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  const Icon(Icons.visibility),
                  Text(advertisement.nombreImpression.toString()),
                  const SizedBox(width: 10),
                  const Icon(Icons.touch_app),
                  Text(advertisement.nombreDeVues.toString()),
                  const SizedBox(width: 10),
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
                ],
              ),
            ),
            Container(
              margin: const EdgeInsets.only(
                  left: 10, top: 0, right: 10, bottom: 20),
              child: Column(
                children: [
                  const SizedBox(height: 5),
                  Text(
                    advertisement.description,
                    style: GoogleFonts.poppins(
                      fontSize: 16,
                    ),
                  ),
                ],
              ),
            ),
            Container(
              margin: const EdgeInsets.only(
                  left: 10, top: 0, right: 10, bottom: 20),
              child: Column(
                children: infoMap.entries.map((entry) {
                  final key = entry.key.replaceAll('_', ' ').capitalize();
                  final value = entry.value;

                  return Padding(
                    padding: const EdgeInsets.only(bottom: 8.0),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(
                          '$key :',
                          style: const TextStyle(
                            fontWeight: FontWeight.bold,
                            color: Colors
                                .blue, // Replace with your theme's primary color if needed
                            fontSize: 16,
                          ),
                        ),
                        const SizedBox(height: 4),
                        Text(
                          value,
                          style: const TextStyle(
                            fontSize: 14,
                          ),
                          softWrap: true, // Wraps text within the container
                        ),
                        const Divider(),
                      ],
                    ),
                  );
                }).toList(),
              ),
            ),
          ],
        ),
      ),
    );
  }
}
