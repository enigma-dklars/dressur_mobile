// ignore_for_file: use_key_in_widget_constructors, prefer_const_constructors
import 'dart:convert';

import 'package:dressur/5_autre/support_assistance.dart';
import 'package:flutter_linkify/flutter_linkify.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:http/http.dart' as http;
import 'package:dressur/components/constant.dart';
import 'package:flutter/material.dart';
import 'package:url_launcher/url_launcher.dart';

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
  State<PromotionReseauSociauxListePage> createState() =>
      _PromotionReseauSociauxListePageState();
}

class _PromotionReseauSociauxListePageState
    extends State<PromotionReseauSociauxListePage> {
  bool _isLoading = false;
  List<PromotionReseauSociaux> _promotionReseauSociaux = [];

  Future<void> fetchPromotionReseauSociaux() async {
    setState(() {
      _isLoading = true;
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
        _isLoading = false;
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
            Icons.arrow_back_ios,
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
      body: _isLoading
          ? _buildShimmerList()
          : _promotionReseauSociaux.isEmpty
              ? _buildEmptyState()
              : RefreshIndicator(
                  onRefresh: fetchPromotionReseauSociaux,
                  color: primaryColor,
                  child: ListView.builder(
                    physics: BouncingScrollPhysics(),
                    padding: EdgeInsets.all(10),
                    itemCount: _promotionReseauSociaux.length,
                    itemBuilder: (context, index) {
                      return _buildPromotionCard(
                          _promotionReseauSociaux[index]);
                    },
                  ),
                ),
    );
  }

  Widget _buildPromotionCard(PromotionReseauSociaux promo) {
    final statusInfo = _getStatusInfo(promo.status);

    return Card(
      elevation: 0.5,
      margin: EdgeInsets.only(bottom: 12),
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(15)),
      child: Padding(
        padding: const EdgeInsets.fromLTRB(16, 16, 16, 8),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            // --- EN-TÊTE : TITRE ET STATUT ---
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Expanded(
                  child: Text(
                    promo.titre,
                    style: GoogleFonts.poppins(
                        fontSize: 18, fontWeight: FontWeight.bold),
                  ),
                ),
                SizedBox(width: 10),
                _buildBadge(statusInfo['label']!, statusInfo['color']!),
              ],
            ),
            SizedBox(height: 15),

            // --- BLOC 1 : COMPTEURS ---
            _buildDetailRow(
              item1: _buildDetailItem(
                  icon: Icons.flag_outlined,
                  label: "Compteur Début",
                  value: promo.compteurDebut),
              item2: _buildDetailItem(
                  icon: Icons.hourglass_bottom_rounded,
                  label: "Compteur Restant",
                  value: promo.compteurRestant),
            ),
            Divider(height: 20),

            // --- BLOC 2 : COMMANDE ---
            _buildDetailRow(
              item1: _buildDetailItem(
                  icon: Icons.inventory_2_outlined,
                  label: "Quantité Demandée",
                  value: promo.qteDemander),
              item2: _buildDetailItem(
                  icon: Icons.monetization_on_outlined,
                  label: "Prix Fixé",
                  value: promo.prixFixer),
            ),
            Divider(height: 20),

            // --- BLOC 3 : INFORMATIONS TECHNIQUES ---
            _buildDetailItem(
                icon: Icons.tag, label: "Référence", value: promo.reference),
            SizedBox(height: 10),
            _buildUrlItem(promo.url), // Widget spécifique pour l'URL cliquable

            // --- PIED DE PAGE : DATES ---
            Divider(height: 20),
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                _buildDateText("Créé le", promo.createdAt),
                _buildDateText("Modifié le", promo.updatedAt),
              ],
            ),
          ],
        ),
      ),
    );
  }

  // --- WIDGETS HELPERS ---

  Widget _buildDetailRow({required Widget item1, required Widget item2}) {
    return Row(
      children: [
        Expanded(child: item1),
        SizedBox(width: 10),
        Expanded(child: item2),
      ],
    );
  }

  Widget _buildDetailItem(
      {required IconData icon, required String label, required String value}) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          label,
          style: GoogleFonts.poppins(fontSize: 12, color: Colors.grey[600]),
          maxLines: 1,
          overflow: TextOverflow.ellipsis,
        ),
        SizedBox(height: 2),
        Row(
          children: [
            Icon(icon, color: primaryColor, size: 16),
            SizedBox(width: 6),
            Expanded(
              child: Text(
                value,
                style: GoogleFonts.poppins(
                    fontWeight: FontWeight.w600, fontSize: 15),
                maxLines: 1,
                overflow: TextOverflow.ellipsis,
              ),
            ),
          ],
        ),
      ],
    );
  }

  Widget _buildUrlItem(String url) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          "URL",
          style: GoogleFonts.poppins(fontSize: 12, color: Colors.grey[600]),
        ),
        SizedBox(height: 2),
        Row(
          children: [
            Icon(Icons.link, color: primaryColor, size: 16),
            SizedBox(width: 6),
            Expanded(
              child: Linkify(
                onOpen: (link) async {
                  if (!await launchUrl(Uri.parse(link.url))) {
                    print('Could not launch ${link.url}');
                  }
                },
                text: url,
                style: GoogleFonts.poppins(
                    fontWeight: FontWeight.w600, fontSize: 15),
                linkStyle: TextStyle(
                    color: Colors.blue, decoration: TextDecoration.none),
                maxLines: 1,
                overflow: TextOverflow.ellipsis,
              ),
            ),
          ],
        ),
      ],
    );
  }

  Widget _buildDateText(String label, String date) {
    return Text(
      "$label: $date",
      style: GoogleFonts.poppins(fontSize: 11, color: Colors.grey[500]),
    );
  }

  Map<String, dynamic> _getStatusInfo(String status) {
    // ... (votre logique de statut)
    if (["Completed", "Terminé", "In progress", "En cours"].contains(status)) {
      return {'label': status, 'color': Colors.green};
    } else if (["On hold", "En attente"].contains(status)) {
      return {'label': status, 'color': Colors.orange};
    } else {
      return {'label': status, 'color': Colors.red};
    }
  }

  Widget _buildBadge(String text, Color color) {
    return Container(
      padding: EdgeInsets.symmetric(horizontal: 10, vertical: 4),
      decoration:
          BoxDecoration(color: color, borderRadius: BorderRadius.circular(20)),
      child: Text(text,
          style: GoogleFonts.poppins(
              color: Colors.white, fontSize: 11, fontWeight: FontWeight.bold)),
    );
  }

  Widget _buildEmptyState() {
    /* ... */ return Center(child: Text("Aucune promotion"));
  }

  Widget _buildShimmerList() {
    /* ... */ return Center(child: CircularProgressIndicator());
  }
}

class InfoColumn extends StatelessWidget {
  final String label;
  final String value;

  const InfoColumn({
    required this.label,
    required this.value,
  });

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          label,
          style: GoogleFonts.poppins(
            fontSize: 14,
            fontWeight: FontWeight.w600,
          ),
          maxLines: 1,
          overflow: TextOverflow.ellipsis,
        ),
        const SizedBox(height: 1),
        Text(
          value,
          style: GoogleFonts.poppins(
            fontSize: 14,
          ),
          maxLines: 1,
          overflow: TextOverflow.ellipsis,
        ),
      ],
    );
  }
}
