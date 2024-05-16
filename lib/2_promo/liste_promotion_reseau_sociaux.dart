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

  factory PromotionReseauSociaux.fromJson(Map<String, dynamic> json) {
    return PromotionReseauSociaux(
      id: json['id'],
      titre: json['titre'],
      qteDemander: json['qteDemander'],
      prixFixer: json['prixFixer'],
      url: json['url'],
      reference: json['reference'],
      status: json['status'],
      compteurDebut: json['compteurDebut'],
      compteurRestant: json['compteurRestant'],
      createdAt: json['createdAt'],
      updatedAt: json['updatedAt'],
    );
  }
}

class PromotionReseauSociauxListePage extends StatefulWidget {
  @override
  State<PromotionReseauSociauxListePage> createState() =>
      _PromotionReseauSociauxListePageState();
}

class _PromotionReseauSociauxListePageState
    extends State<PromotionReseauSociauxListePage> {
  bool _loading = false;
  List<Item> _data = [];

  Future<void> fetchPromotionReseauSociaux() async {
    setState(() {
      _loading = true;
    });
    final url = Uri.parse(
        '$generalRouteForApi/listPromoReseau/$uidUser/$langUserPhone');

    final response = await http.get(url);

    if (response.statusCode == 200) {
      final jsonData = jsonDecode(response.body) as List<dynamic>;

      final promotionReseauSociaux = jsonData.map((data) {
        return PromotionReseauSociaux.fromJson(data);
      }).toList();

      setState(() {
        _data = generateItems(promotionReseauSociaux);
        _loading = false;
      });
    } else {
      showDialog(
        context: context,
        builder: (BuildContext context) {
          return AlertDialog(
            title: const Text('Erreur'),
            content: Text((langUserPhone == "fr")
                ? "Échec de récupération des promotions réseau sociaux. Code d'erreur: ${response.statusCode}"
                : "Failed to retrieve social network promotions. Error code: ${response.statusCode}"),
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

  Future<void> fetchPromotionDetails(Item item) async {
    final url = Uri.parse('$generalRouteForApi/promoDetails/${item.expandedValue.id}');

    final response = await http.get(url);

    if (response.statusCode == 200) {
      final jsonData = jsonDecode(response.body);

      setState(() {
        item.expandedValue = PromotionReseauSociaux.fromJson(jsonData);
      });
    } else {
      showDialog(
        context: context,
        builder: (BuildContext context) {
          return AlertDialog(
            title: const Text('Erreur'),
            content: Text((langUserPhone == "fr")
                ? "Échec de récupération des détails de la promotion. Code d'erreur: ${response.statusCode}"
                : "Failed to retrieve promotion details. Error code: ${response.statusCode}"),
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

  List<Item> generateItems(List<PromotionReseauSociaux> promotions) {
    return List<Item>.generate(promotions.length, (index) {
      final promotion = promotions[index];
      return Item(
        headerValue: promotion.titre,
        expandedValue: promotion,
        isExpanded: false,
      );
    });
  }

  @override
  void initState() {
    super.initState();
    fetchPromotionReseauSociaux();
  }

  @override
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
          : _data.isEmpty
              ? Center(
                  child: Text(
                    (langUserPhone == "fr")
                        ? "Aucun promotion réseau sociaux trouvé."
                        : "No social network promotions found.",
                    style: const TextStyle(fontSize: 16),
                  ),
                )
              : SingleChildScrollView(
                  child: ExpansionPanelList(
                    expansionCallback: (int index, bool isExpanded) async {
                      setState(() {
                        _data[index].isExpanded = !isExpanded;
                      });

                      if (!_data[index].isExpanded) {
                        await fetchPromotionDetails(_data[index]);
                      }
                    },
                    children: _data.map<ExpansionPanel>((Item item) {
                      return ExpansionPanel(
                        headerBuilder:
                            (BuildContext context, bool isExpanded) {
                          return ListTile(
                            title: Text(
                              item.headerValue,
                              style: GoogleFonts.poppins(
                                fontSize: 18,
                                fontWeight: FontWeight.bold,
                              ),
                            ),
                          );
                        },
                        body: Padding(
                          padding: const EdgeInsets.symmetric(
                              horizontal: 15, vertical: 10),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Row(
                                mainAxisAlignment:
                                    MainAxisAlignment.spaceBetween,
                                children: [
                                  InfoColumn(
                                    label: "Compteur Début",
                                    value: item.expandedValue.compteurDebut,
                                  ),
                                  InfoColumn(
                                    label: "Compteur Restant",
                                    value: item.expandedValue.compteurRestant,
                                  ),
                                ],
                              ),
                              const Divider(color: Colors.black),
                              Row(
                                mainAxisAlignment:
                                    MainAxisAlignment.spaceBetween,
                                children: [
                                  InfoColumn(
                                    label: "Statut",
                                    value: item.expandedValue.status,
                                  ),
                                  InfoColumn(
                                    label: "Référence",
                                    value: item.expandedValue.reference,
                                  ),
                                ],
                              ),
                              const Divider(color: Colors.black),
                              Row(
                                mainAxisAlignment:
                                    MainAxisAlignment.spaceBetween,
                                children: [
                                  InfoColumn(
                                    label: "Quantité Demandée",
                                    value: item.expandedValue.qteDemander,
                                  ),
                                  InfoColumn(
                                    label: "Prix Fixé",
                                    value: item.expandedValue.prixFixer,
                                  ),
                                ],
                              ),
                              const Divider(color: Colors.black),
                              Row(
                                mainAxisAlignment:
                                    MainAxisAlignment.spaceBetween,
                                children: [
                                  Flexible(
                                    child: InfoColumn(
                                      label: "URL",
                                      value: item.expandedValue.url,
                                    ),
                                  ),
                                ],
                              ),
                              const Divider(color: Colors.black),
                              Text(
                                "Créé le: ${item.expandedValue.createdAt}",
                                style: GoogleFonts.poppins(
                                  fontSize: 12,
                                ),
                              ),
                              Text(
                                "Mis à jour le: ${item.expandedValue.updatedAt}",
                                style: GoogleFonts.poppins(
                                  fontSize: 12,
                                ),
                              ),
                            ],
                          ),
                        ),
                        isExpanded: item.isExpanded,
                      );
                    }).toList(),
                  ),
                ),
    );
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
            color: Colors.black54,
            fontWeight: FontWeight.w600,
          ),
        ),
        const SizedBox(height: 4),
        Text(
          value,
          style: GoogleFonts.poppins(
            fontSize: 14,
          ),
        ),
      ],
    );
  }
}

class Item {
  Item({
    required this.expandedValue,
    required this.headerValue,
    this.isExpanded = false,
  });

  PromotionReseauSociaux expandedValue;
  String headerValue;
  bool isExpanded;
}
