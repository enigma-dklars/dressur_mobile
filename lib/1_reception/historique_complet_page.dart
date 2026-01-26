import 'package:cached_network_image/cached_network_image.dart';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/components/constant.dart';

class HistoriqueRecompense {
  final String title;
  final String amount;
  final String date;
  final String views;
  final String imageUrl;
  final String status;
  final String description;

  HistoriqueRecompense({
    required this.title,
    required this.amount,
    required this.date,
    required this.views,
    required this.imageUrl,
    required this.status,
    required this.description,
  });
}

class HistoriqueCompletPage extends StatefulWidget {
  final List<dynamic> allHistorique;

  const HistoriqueCompletPage({
    super.key,
    required this.allHistorique,
  });

  @override
  State<HistoriqueCompletPage> createState() => _HistoriqueCompletPageState();
}

class _HistoriqueCompletPageState extends State<HistoriqueCompletPage> {
  late List<dynamic> historique;
  late Future<List<HistoriqueRecompense>> _futureHistoriqueRecompense;

  Future<List<HistoriqueRecompense>> partageInProgrammeRecompense() async {
    try {
      final List<dynamic> historique = widget.allHistorique;
      return historique.map((data) {
        return HistoriqueRecompense(
          imageUrl: generalRouteForPromotionImage + data['imageUrl'],
          title: data['title'] ?? "",
          amount: data['amount'].toString(),
          date: data['date'] ?? "",
          views: data['views'].toString(),
          status: data['status'] ?? "",
          description: data['description'] ?? "",
        );
      }).toList();
    } catch (e) {
      print("Erreur: $e");
      return [];
    }
  }

  @override
  void initState() {
    super.initState();
    _futureHistoriqueRecompense = partageInProgrammeRecompense();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        appBar: AppBar(
          backgroundColor: primaryColor,
          title: Text(
            "Historique complet",
            style: GoogleFonts.poppins(fontWeight: FontWeight.w600),
          ),
          leading: IconButton(
            icon: Icon(Icons.arrow_back_ios, color: Colors.white, size: 20),
            onPressed: () => Navigator.pop(context),
          ),
        ),
        body: Padding(
          padding: EdgeInsetsGeometry.fromLTRB(10, 10, 10, 0),
          child: FutureBuilder<List<HistoriqueRecompense>>(
            future: _futureHistoriqueRecompense,
            builder: (context, snapshot) {
              if (snapshot.connectionState == ConnectionState.waiting) {
                return const Padding(
                  padding: EdgeInsets.all(20),
                  child: Center(child: CircularProgressIndicator()),
                );
              }

              if (snapshot.hasError) {
                return Center(child: Text("Erreur de chargement"));
              }

              if (!snapshot.hasData || snapshot.data!.isEmpty) {
                return Center(
                  child: Text(
                    "Aucun historique disponible",
                    style: GoogleFonts.poppins(fontSize: 12),
                  ),
                );
              }

              return ListView.builder(
                itemCount: snapshot.data!.length,
                itemBuilder: (context, index) {
                  final item = snapshot.data![index];

                  return _promotionItem(
                    context,
                    item.title,
                    "${item.amount} FCFA",
                    item.date,
                    "${item.views} vues",
                    item.imageUrl,
                    item.status,
                  );
                },
              );
            },
          ),
        ));
  }

  Widget _promotionItem(
    BuildContext context,
    String title,
    String amount,
    String date,
    String views,
    String imageUrl,
    String status,
  ) {
    final isDark = Theme.of(context).brightness == Brightness.dark;
    final statusConfig = getStatusBadgeConfig(status);

    return Padding(
      padding: const EdgeInsets.only(bottom: 10),
      child: Container(
        padding: const EdgeInsets.all(10),
        decoration: BoxDecoration(
          color: isDark ? Colors.white.withOpacity(0.05) : Colors.white,
          borderRadius: BorderRadius.circular(15),
          border: Border.all(
              color: Theme.of(context).dividerColor.withOpacity(0.1)),
        ),
        child: Row(
          children: [
            Container(
              width: 55,
              height: 55,
              decoration: BoxDecoration(
                borderRadius: BorderRadius.circular(12),
              ),
              child: Stack(
                children: [
                  // ✅ Image avec cache
                  ClipRRect(
                    borderRadius: BorderRadius.circular(12),
                    child: CachedNetworkImage(
                      imageUrl: imageUrl,
                      width: 55,
                      height: 55,
                      fit: BoxFit.cover,
                      placeholder: (context, url) => Image.asset(
                          'images/placeholder.png',
                          fit: BoxFit.cover),
                      errorWidget: (context, url, error) => Image.asset(
                          'images/error_image.png',
                          fit: BoxFit.cover),
                    ),
                  ),

                  // ✅ Badge de statut
                  Positioned(
                    bottom: 2,
                    right: 2,
                    child: Container(
                      padding: const EdgeInsets.all(2),
                      decoration: BoxDecoration(
                        color: (status == "approuver")
                            ? Colors.green
                            : (status == "echouer" || status == "refuser")
                                ? Colors.red
                                : (status == "en_attente")
                                    ? Colors.orange
                                    : Colors.black,
                        shape: BoxShape.circle,
                        border: Border.all(color: Colors.white, width: 1.5),
                      ),
                      child: Icon(
                        (status == "approuver")
                            ? Icons.check_circle
                            : (status == "echouer" || status == "refuser")
                                ? Icons.cancel
                                : (status == "en_attente")
                                    ? Icons.access_time
                                    : Icons.help_outline,
                        color: Colors.white,
                        size: 10,
                      ),
                    ),
                  ),
                ],
              ),
            ),
            const SizedBox(width: 10),

            // --- INFOS CENTRALES ---
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    title,
                    style: GoogleFonts.poppins(
                      fontWeight: FontWeight.w600,
                      fontSize: 14,
                    ),
                    maxLines: 1,
                    overflow: TextOverflow.ellipsis,
                  ),
                  const SizedBox(height: 10),
                  Row(
                    children: [
                      Text(date,
                          style: GoogleFonts.poppins(
                              fontSize: 12, color: Colors.grey)),
                      const SizedBox(width: 8),
                      Container(
                        width: 3,
                        height: 3,
                        decoration: const BoxDecoration(
                          color: Colors.grey,
                          shape: BoxShape.circle,
                        ),
                      ),
                      const SizedBox(width: 8),
                      const Icon(Icons.visibility_outlined,
                          size: 12, color: Colors.grey),
                      const SizedBox(width: 4),
                      Text(views,
                          style: GoogleFonts.poppins(
                              fontSize: 12, color: Colors.grey)),
                    ],
                  ),
                ],
              ),
            ),

            // --- MONTANT & BOUTON PARTAGE ---
            Column(
              crossAxisAlignment: CrossAxisAlignment.end,
              children: [
                Text(
                  amount,
                  style: GoogleFonts.poppins(
                    fontWeight: FontWeight.bold,
                    fontSize: 14,
                    color: (status == "approuver")
                        ? Colors.green
                        : (status == "echouer" || status == "refuser")
                            ? Colors.red
                            : (status == "en_attente")
                                ? Colors.orange
                                : null,
                  ),
                ),
                const SizedBox(height: 5),
                // Bouton de partage compact avec Spinner

                Container(
                  padding:
                      const EdgeInsets.symmetric(horizontal: 8, vertical: 4),
                  decoration: BoxDecoration(
                    color: statusConfig["color"].withOpacity(0.15),
                    borderRadius: BorderRadius.circular(8),
                  ),
                  child: Row(
                    mainAxisSize: MainAxisSize.min,
                    children: [
                      Icon(
                        statusConfig["icon"],
                        size: 12,
                        color: statusConfig["color"],
                      ),
                      const SizedBox(width: 4),
                      Text(
                        statusConfig["label"],
                        style: GoogleFonts.poppins(
                          fontSize: 10,
                          fontWeight: FontWeight.bold,
                          color: statusConfig["color"],
                        ),
                      ),
                    ],
                  ),
                ),
              ],
            ),
          ],
        ),
      ),
    );
  }

  Map<String, dynamic> getStatusBadgeConfig(String status) {
    switch (status) {
      case "en_attente":
        return {
          "label": "Attente validation",
          "icon": Icons.access_time,
          "color": Colors.orange,
        };
      case "terminer":
        return {
          "label": "Preuves requises",
          "icon": Icons.check_circle,
          "color": Colors.green,
        };
      case "echouer":
        return {
          "label": "Échoué",
          "icon": Icons.cancel,
          "color": Colors.red,
        };
      case "refuser":
        return {
          "label": "Refusé",
          "icon": Icons.cancel,
          "color": Colors.red,
        };
      case "approuver":
        return {
          "label": "Approuvé",
          "icon": Icons.verified,
          "color": Colors.green,
        };
      case "en_cours":
        return {
          "label": "En cours",
          "icon": Icons.sync,
          "color": Colors.blue,
        };
      default:
        return {
          "label": "Inconnu",
          "icon": Icons.help_outline,
          "color": Colors.grey,
        };
    }
  }
}
