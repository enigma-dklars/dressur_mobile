// ignore_for_file: unnecessary_null_comparison, prefer_const_constructors

import 'dart:async';

import 'package:flutter/material.dart';
import 'package:flutter/rendering.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/5_autre/support_assistance.dart';
import 'package:dressur/components/constant.dart';

class ListeNotification extends StatefulWidget {
  @override
  State<ListeNotification> createState() => _ListeNotificationState();
}

class _ListeNotificationState extends State<ListeNotification> {
  final ValueNotifier<bool> _showFabText = ValueNotifier(true);
  final ScrollController _scrollController = ScrollController();
  List<Map<String, dynamic>> historiqueContactsAdd = [];
  Timer? _timer;

  @override
  void initState() {
    super.initState();
  }

  Future<void> _refreshData() async {
    setState(() {
      // actualise();
    });
  }

  void dispose() {
    _scrollController.removeListener(_scrollListener);
    _scrollController.dispose();

    _showFabText.dispose();
    // Arrête le timer lors de la suppression du widget
    _stopTimer();
    super.dispose();
  }

  void _scrollListener() {
    if (_scrollController.position.userScrollDirection ==
        ScrollDirection.reverse) {
      _showFabText.value = false;
    } else if (_scrollController.position.atEdge &&
        _scrollController.position.pixels == 0) {
      _showFabText.value = true;
    }
  }

  void _startTimer() {
    // Crée un nouveau timer qui exécute la fonction everySecond toutes les secondes
    _timer = Timer.periodic(Duration(seconds: 1), (timer) {
      everySecond();
    });
  }

  void _stopTimer() {
    // Arrête et annule le timer
    _timer?.cancel();
    _timer = null;
  }

  void everySecond() {
    // Code à exécuter toutes les secondes
    setState(() {
      nombreContactDispo = nombreContactDispo;
    });
  }

  Widget build(BuildContext context) {
    return Scaffold(
        appBar: AppBar(
          elevation: 0,
          backgroundColor: primaryColor,
          title: Text(
            "Notifications",
            style: GoogleFonts.poppins(
              fontWeight: FontWeight.w400,
              color: Colors.white,
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
          actions: [
            PopupMenuButton<int>(
              itemBuilder: (context) => [
                PopupMenuItem(
                  value: 4,
                  child: Row(
                    children: [
                      Text(
                        (langUserPhone == "fr") ? "Aide" : "Help",
                        style: GoogleFonts.poppins(
                          color: Colors.white,
                          fontWeight: FontWeight.w600,
                        ),
                      ),
                    ],
                  ),
                ),
              ],
              offset: const Offset(0, 60),
              color: primaryColor,
              icon: const Icon(
                Icons.menu,
                color: Colors.white,
              ),
              elevation: 2,
              onSelected: (value) {
                if (value == 4) {
                  Navigator.push(
                    context,
                    MaterialPageRoute(
                      builder: (context) => SupportPage(),
                    ),
                  );
                }
              },
            ),
          ],
        ),
        body: Column(
          children: [
            Expanded(
              child: RefreshIndicator(
                onRefresh: _refreshData,
                child: ListView(
                  controller: _scrollController,
                  children: [
                    const SizedBox(height: 5),
                    Card(
                      margin: const EdgeInsets.only(
                          left: 10, top: 5, right: 10, bottom: 5),
                      child: Container(
                        padding: const EdgeInsets.fromLTRB(10, 0, 10, 3),
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            const SizedBox(height: 10),
                            Center(
                              child: Text(
                                (langUserPhone == "fr")
                                    ? "Bienvenue sur Dressur"
                                    : "Welcome to Dressur",
                                style: GoogleFonts.poppins(
                                  fontWeight: FontWeight.w700,
                                  fontSize: 22,
                                ),
                              ),
                            ),
                            const SizedBox(height: 10),
                            Text(
                              (langUserPhone == "fr")
                                  ? "Dressur a été conçu pour être bien plus qu'une simple application mobile. C'est votre allié pour gérer votre visibilité en ligne, communiquer avec style, et optimiser votre présence numérique. Voici un aperçu rapide de ce que vous pouvez faire avec Dressur :"
                                  : "Dressur was designed to be much more than just a mobile app. It is your ally to manage your online visibility, communicate with style, and optimize your digital presence. Here's a quick overview of what you can do with Dressur:",
                              style: GoogleFonts.poppins(
                                fontWeight: FontWeight.w300,
                                fontSize: 15,
                              ),
                            ),
                            const SizedBox(height: 25),
                            Text(
                              (langUserPhone == "fr")
                                  ? "1 - ADD WhatsApp "
                                  : "1 - ADD WhatsApp ",
                              style: GoogleFonts.poppins(
                                fontWeight: FontWeight.w500,
                                fontSize: 18,
                              ),
                            ),
                            const SizedBox(height: 5),
                            Text(
                              (langUserPhone == "fr")
                                  ? "Avec Dressur, vous pouvez aisément avoir un large éventail de contacts WhatsApp qui correspondent à vos choix de pays. L'application enregistre automatiquement ces contacts à la fois dans votre téléphone et dans celui des personnes que vous ajoutez. Vous pouvez également synchroniser les contacts en cas de perte pour retrouver vos contacts Dressur manquant."
                                  : "With Dressur, you can easily have a wide range of WhatsApp contacts that match your country choices. The app automatically saves these contacts to both your phone and the phones of the people you add. You can also sync contacts if lost to find your missing Dressur contacts.",
                              style: GoogleFonts.poppins(
                                fontWeight: FontWeight.w300,
                                fontSize: 15,
                              ),
                            ),
                            const SizedBox(height: 15),
                            Text(
                              (langUserPhone == "fr")
                                  ? "2 - Promotion des Produits et Services"
                                  : "2 - Promotion of Products and Services",
                              style: GoogleFonts.poppins(
                                fontWeight: FontWeight.w500,
                                fontSize: 18,
                              ),
                            ),
                            const SizedBox(height: 5),
                            Text(
                              (langUserPhone == "fr")
                                  ? "Avec Dressur, vous pouvez faire la promotion de vos produits et services (une affiche + un texte), votre annonce est proposée à tous les utilisateurs correspondants à vos préférences pays."
                                  : "With Dressur, you can promote your products and services (a poster + a text), your ad is offered to all users corresponding to your country preferences.",
                              style: GoogleFonts.poppins(
                                fontWeight: FontWeight.w300,
                                fontSize: 15,
                              ),
                            ),
                            const SizedBox(height: 15),
                            Text(
                              (langUserPhone == "fr")
                                  ? "3 - Campagnes Mail et SMS"
                                  : "3 - Mail and SMS campaigns",
                              style: GoogleFonts.poppins(
                                fontWeight: FontWeight.w500,
                                fontSize: 18,
                              ),
                            ),
                            const SizedBox(height: 5),
                            Text(
                              (langUserPhone == "fr")
                                  ? "Nous vous offrons la possibilité de proposer vos produits et services a d'autres potentiels clients hors Dressur par des campagnes Mail et SMS. Envoyez Jusqu'à 10.000 Mails et SMS."
                                  : "We offer you the possibility of offering your products and services to other potential customers outside Dressur through Mail and SMS campaigns. Send Up to 10,000 Emails and SMS.",
                              style: GoogleFonts.poppins(
                                fontWeight: FontWeight.w300,
                                fontSize: 15,
                              ),
                            ),
                            const SizedBox(height: 15),
                            Text(
                              (langUserPhone == "fr")
                                  ? "4 - Carte de Visite Numérique"
                                  : "4 - Digital Business Card",
                              style: GoogleFonts.poppins(
                                fontWeight: FontWeight.w500,
                                fontSize: 18,
                              ),
                            ),
                            const SizedBox(height: 5),
                            Text(
                              (langUserPhone == "fr")
                                  ? "Votre profil Dressur comprend une carte de visite numérique munie d'un code QR personnalisé. Lorsque ce code est scanné par un autre utilisateur, toutes vos informations enregistrées dans Dressur sont instantanément transférées dans son téléphone, et réciproquement. Cette fonctionnalité facilite grandement l'échange d'informations professionnelles et renforce les liens avec vos contacts, éliminant ainsi le besoin d'imprimer des centaines de cartes de visite."
                                  : "Your Dressur profile includes a digital business card with a personalized QR code. When this code is scanned by another user, all your information stored in Dressur is instantly transferred to their phone, and vice versa. This feature makes exchanging professional information much easier and strengthens connections with your contacts, eliminating the need to print hundreds of business cards.",
                              style: GoogleFonts.poppins(
                                fontWeight: FontWeight.w300,
                                fontSize: 15,
                              ),
                            ),
                            const SizedBox(height: 30),
                            Text(
                              (langUserPhone == "fr")
                                  ? "À quoi servent les points bonus sur Dressur ?"
                                  : "What are bonus points used for on Dressur ?",
                              style: GoogleFonts.poppins(
                                fontWeight: FontWeight.w600,
                                fontSize: 15,
                              ),
                            ),
                            const SizedBox(height: 10),
                            Text(
                              (langUserPhone == "fr")
                                  ? "L'utilisation des points bonus dans l'application permet à l'équipe de Dressur d'assurer à ses utilisateurs une augmentation continue du nombre d'utilisateurs à travers le monde, ce qui se traduit par une audience croissante pour leurs contacts et leurs promotions de produits ou services. Etc."
                                  : "The use of bonus points in the application allows the Dressur team to ensure its users a continuous increase in the number of users around the world, which translates into a growing audience for their contacts and promotions of products or services. Etc.",
                              style: GoogleFonts.poppins(
                                fontWeight: FontWeight.w300,
                                fontSize: 15,
                              ),
                            ),
                            const SizedBox(height: 30),
                            Text(
                              (langUserPhone == "fr")
                                  ? "Pour toutes questions, veuillez contacter l'assistance technique de Dressur sur WhatsApp. MERCI."
                                  : "For any questions, please contact Dressur Technical Support on WhatsApp. THANK YOU.",
                              style: GoogleFonts.poppins(
                                fontWeight: FontWeight.w400,
                                fontSize: 18,
                              ),
                            ),
                            const SizedBox(height: 10),
                          ],
                        ),
                      ),
                    ),
                    const SizedBox(height: 5),
                  ],
                ),
              ),
            ),
          ],
        ));
  }
}
