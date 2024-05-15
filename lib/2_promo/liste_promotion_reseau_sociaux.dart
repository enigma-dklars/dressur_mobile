// ignore_for_file: use_key_in_widget_constructors
import 'dart:convert';

import 'package:dressur/5_autre/support_assistance.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:http/http.dart' as http;
import 'package:dressur/components/constant.dart';
import 'package:flutter/material.dart';

class PromotionReseauSociaux {
  final String id;
  final String titre;
  final String qteDemander;
  final String prixFixer;
  final String url;
  final String reference;
  final String status;
  final String compteurDebut;
  final String compteurRestant;
  final String createdAt;
  final String updatedAt;

  PromotionReseauSociaux({
    required this.id,
    required this.titre,
    required this.qteDemander,
    required this.prixFixer,
    required this.url,
    required this.reference,
    required this.status,
    required this.compteurDebut,
    required this.compteurRestant,
    required this.createdAt,
    required this.updatedAt,
  });
}

class PromotionReseauSociauxListePage extends StatefulWidget {
  @override
  State<PromotionReseauSociauxListePage> createState() => _PromotionReseauSociauxListePageState();
}

class _PromotionReseauSociauxListePageState extends State<PromotionReseauSociauxListePage> {
  bool _loading = false;
  List<PromotionReseauSociaux> _promotionReseauSociaux = [];

  Future<void> fetchPromotionReseauSociaux() async{
    setState(() {
      _loading = true;
    });
        final url = Uri.parse(
        '$generalRouteForApi/listPromoReseau/$uidUser/$langUserPhone');

        final response = await http.get(url);

        if (response.statusCode == 200) {
          final jsonData = jsonDecode(response.body) as List<dynamic>;

          final promotionReseauSociaux = jsonData.map((data) {
            return PromotionReseauSociaux(
              id: data['id'],
              titre: data['titre'],
              qteDemander: data['qteDemander'],
              prixFixer: data['prixFixer'],
              url: data['url'],
              reference: data['reference'],
              status: data['status'],
              compteurDebut: data['compteurDebut'],
              compteurRestant: data['compteurRestant'],
              createdAt: data['createdAt'],
              updatedAt: data['updatedAt'],
            );
          }).toList();

          setState(() {
            _promotionReseauSociaux = promotionReseauSociaux;
            _loading = false;
          });
        } else {
          showDialog(
            context: context,
            builder: (BuildContext context) {
              return AlertDialog(
                title: const Text('Erreur'),
                content: Text((langUserPhone == "fr")
                    ? "Échec de récupération des promotionReseauSociaux. Code d'erreur:"
                    : "Failed to retrieve promotionReseauSociaux. Error code:"
                        "${response.statusCode}"),
                actions: <Widget>[
                  TextButton(
                    child: const Text('OK'),
                    onPressed: () {
                      Navigator.of(context).pop();
                    },
                  ),
                ],
              );
            },
          );
       }
  }


  @override
  void initState() {
    super.initState();
    fetchPromotionReseauSociaux(); // Loading the diary when the app starts
  }

  Widget build(BuildContext context) {
     return Scaffold(
      appBar: AppBar(
        elevation: 0,
        backgroundColor: primaryColor,
        title: Text(
          (langUserPhone == "fr")
              ? "Liste Promotion Réseau Sociaux"
              : "Social Network Promotion List",
          style: GoogleFonts.poppins(
            fontWeight: FontWeight.w600,
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
          PopupMenuButton<dynamic>(
            itemBuilder: (context) => [
              PopupMenuItem(
                value: 1,
                onTap: () {
                  fetchPromotionReseauSociaux();
                },
                child: Row(
                  children: [
                    Text(
                      (langUserPhone == "fr") ? "Actualiser" : "Refresh",
                      style: GoogleFonts.poppins(
                        color: Colors.white,
                        fontWeight: FontWeight.w600,
                      ),
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
      body: _loading
          ? const Center(
              child: CircularProgressIndicator(),
            )
          : _promotionReseauSociaux.isEmpty
                  ? Center(
                      child: Text(
                        (langUserPhone == "fr")
                            ? "Aucun promotion réseau sociaux trouvé."
                            : "No social network promotions found.",
                        style: const TextStyle(fontSize: 16),
                      ),
                    )
                  : Expanded(
                      child: ListView.builder(
              itemCount: _promotionReseauSociaux.length,
              itemBuilder: (BuildContext context, int index) {
                final promotionReseauSociaux = _promotionReseauSociaux[index];

                return Card(
                  margin: const EdgeInsets.only(
                      left: 10, top: 10, right: 10, bottom: 0),
                  child: Container(
                    width: MediaQuery.of(context).size.width * 0.95,
                    decoration: BoxDecoration(
                      gradient: const LinearGradient(
                        begin: Alignment.topCenter,
                        end: Alignment.bottomCenter,
                        colors: [
                          secondaryColor,
                          primaryColor,
                        ],
                      ),
                      borderRadius: BorderRadius.circular(5),
                    ),
                    padding: const EdgeInsets.fromLTRB(15, 10, 15, 10),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.stretch,
                      children: [
                        Row(
                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                          children: [
                            Column(
                              children: [
                                Text(
                                  promotionReseauSociaux.titre,
                                  style: GoogleFonts.poppins(
                                    fontSize: 14,
                                    color: Colors.white,
                                    fontWeight: FontWeight.w800,
                                  ),
                                  textAlign: TextAlign.end,
                                ),
                              ],
                            ),
                            Column(
                              children: [
                                Text(
                                  promotionReseauSociaux.qteDemander,
                                  style: GoogleFonts.poppins(
                                    fontSize: 14,
                                    color: Colors.white,
                                  ),
                                  textAlign: TextAlign.end,
                                ),
                              ],
                            ),
                             Column(
                              children: [
                                Text(
                                  promotionReseauSociaux.prixFixer,
                                  style: GoogleFonts.poppins(
                                    fontSize: 14,
                                    color: Colors.white,
                                  ),
                                  textAlign: TextAlign.end,
                                ),
                              ],
                            ),
                            Column(
                              children: [
                                Text(
                                  promotionReseauSociaux.url,
                                  style: GoogleFonts.poppins(
                                    fontSize: 14,
                                    color: Colors.white,
                                  ),
                                  textAlign: TextAlign.end,
                                ),
                              ],
                            ),
                            Column(
                              children: [
                                Text(
                                  promotionReseauSociaux.reference,
                                  style: GoogleFonts.poppins(
                                    fontSize: 14,
                                    color: Colors.white,
                                  ),
                                  textAlign: TextAlign.end,
                                ),
                              ],
                            ),
                            Column(
                              children: [
                                Text(
                                  promotionReseauSociaux.status,
                                  style: GoogleFonts.poppins(
                                    fontSize: 14,
                                    color: Colors.white,
                                  ),
                                  textAlign: TextAlign.end,
                                ),
                              ],
                            ),
                            Column(
                              children: [
                                Text(
                                  promotionReseauSociaux.compteurDebut,
                                  style: GoogleFonts.poppins(
                                    fontSize: 14,
                                    color: Colors.white,
                                  ),
                                  textAlign: TextAlign.end,
                                ),
                              ],
                            ),
                            Column(
                              children: [
                                Text(
                                  promotionReseauSociaux.compteurRestant,
                                  style: GoogleFonts.poppins(
                                    fontSize: 14,
                                    color: Colors.white,
                                  ),
                                  textAlign: TextAlign.end,
                                ),
                              ],
                            ),
                          ],
                        ),
                        const SizedBox(height: 5),
                        Text(
                          promotionReseauSociaux.createdAt,
                          style: GoogleFonts.poppins(
                            fontWeight: FontWeight.w600,
                            fontSize: 18,
                            color: Colors.white,
                          ),
                        ),
                        const SizedBox(height: 5),
                        Text(
                          promotionReseauSociaux.updatedAt,
                          style: const TextStyle(
                            fontSize: 12,
                            color: Colors.white,
                          ),
                        ),
                      ],
                    ),
                  ),
                );
              },
            ),
            ),
    );
  }
}

