// ignore_for_file: prefer_const_constructors, prefer_const_literals_to_create_immutables

import 'dart:async';
import 'dart:convert';
import 'dart:io';
import 'package:cached_network_image/cached_network_image.dart';
import 'package:dressur/1_reception/historique_complet_page.dart';
import 'package:dressur/components/noti.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;
import 'package:dressur/1_reception/business_promotions_page.dart';
import 'package:dressur/1_reception/recompense_start.dart';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/components/constant.dart';
import 'package:url_launcher/url_launcher.dart';
import 'package:image_picker/image_picker.dart';

class HistoriqueRecompense {
  final int id;
  final String title;
  final String amount;
  final String date;
  final String views;
  final String imageUrl;
  final String status;
  final String description;

  HistoriqueRecompense({
    required this.id,
    required this.title,
    required this.amount,
    required this.date,
    required this.views,
    required this.imageUrl,
    required this.status,
    required this.description,
  });
}

class ProgrammeRecompenseDashboard extends StatefulWidget {
  @override
  State<ProgrammeRecompenseDashboard> createState() =>
      _ProgrammeRecompenseDashboardState();
}

class _ProgrammeRecompenseDashboardState
    extends State<ProgrammeRecompenseDashboard> {
  late List<dynamic> allHistorique = [];
  late Future<List<HistoriqueRecompense>> _futureHistoriqueRecompense;
  var vuesTotales = 0;
  var gainsTotales = 0;

  File? _proofImage1;
  File? _proofImage2;
  bool _isSubmitting = false;
  final ImagePicker _picker = ImagePicker();

  Future<List<HistoriqueRecompense>> partageInProgrammeRecompense() async {
    try {
      var request = http.MultipartRequest(
          'POST',
          Uri.parse(
              '$generalRouteForApi/getMyProgrammeRecompenseInformations'));
      request.fields.addAll({
        'uid': uidUser,
        'langUserPhone': langUserPhone.toString(),
      });

      http.StreamedResponse response = await request.send();

      if (response.statusCode == 200) {
        var data1 = await response.stream.bytesToString();
        var data = convert.jsonDecode(data1);

        if (data["error"] == true) {
          dangerNoti(data["titre"], data["message"], context);
          return [];
        } else {
          setState(() {
            vuesTotales = data["vuesTotales"];
            gainsTotales = data["gainsTotales"];
            soldeProgrammeRecompense = data["soldeDisponible"];
          });

          allHistorique = data["allHistorique"];
          final List<dynamic> sixLastHistorique = data["sixLastHistorique"];

          return sixLastHistorique.map((data) {
            return HistoriqueRecompense(
              imageUrl: generalRouteForPromotionImage + data['imageUrl'],
              id: data['id'] ?? 0,
              title: data['title'] ?? "",
              amount: data['amount'].toString(),
              date: data['date'] ?? "",
              views: data['views'].toString(),
              status: data['status'] ?? "",
              description: data['description'] ?? "",
            );
          }).toList();
        }
      }
      return [];
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
    final theme = Theme.of(context);

    return Scaffold(
      appBar: AppBar(
        backgroundColor: primaryColor,
        elevation: 0,
        centerTitle: true,
        title: Text(
          "Mon Programme",
          style: GoogleFonts.poppins(
            color: Colors.white,
            fontWeight: FontWeight.w600,
            fontSize: 18,
          ),
        ),
        leading: IconButton(
          icon: Icon(Icons.arrow_back_ios, color: Colors.white, size: 20),
          onPressed: () => Navigator.pop(context),
        ),
        actions: [],
      ),
      body: SingleChildScrollView(
        physics: BouncingScrollPhysics(),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            // 1. CARTE PORTEFEUILLE (WALLET)
            _buildWalletCard(context),
            SizedBox(height: 13),

            Padding(
              padding: const EdgeInsets.symmetric(horizontal: 10),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  // 1. BOUTON ACCÈS PROGRAMME
                  _buildAccessProgramButton(context, theme),

                  SizedBox(height: 10),

                  // 2. BOUTON PROMOTIONS AFFAIRES (DÉPLACÉ ICI)
                  _buildBusinessPromotionsButton(context),

                  SizedBox(height: 10),

                  // 3. STATISTIQUES RAPIDES
                  _sectionTitle(context, "Mes Statistiques", 15),
                  Row(
                    children: [
                      _statItem(context, "Vues Totales", "$vuesTotales",
                          Icons.visibility, Colors.blue, theme),
                      SizedBox(width: 15),
                      _statItem(context, "Gains Totales", "$gainsTotales F",
                          Icons.account_balance_wallet, Colors.green, theme),
                    ],
                  ),

                  SizedBox(height: 10),

                  // 4. PROMOTIONS EN COURS
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      _sectionTitle(context, "Historique de participation…", 0),
                      TextButton(
                        onPressed: () {
                          Navigator.push(
                            context,
                            MaterialPageRoute(
                              builder: (context) => HistoriqueCompletPage(
                                allHistorique: allHistorique,
                              ),
                            ),
                          );
                        },
                        child: Text(
                          "Voir tout",
                          style: GoogleFonts.poppins(
                            color: primaryColor,
                            fontSize: 12,
                          ),
                        ),
                      )
                    ],
                  ),
                  Padding(
                    padding: const EdgeInsets.only(bottom: 10),
                    child: Text(
                      "Sélectionnez un historique pour voir les options possibles…",
                      style: GoogleFonts.poppins(
                        fontSize: 12,
                        fontWeight: FontWeight.w400,
                      ),
                    ),
                  ),
                  FutureBuilder<List<HistoriqueRecompense>>(
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
                        shrinkWrap: true, // 🔑 IMPORTANT
                        physics:
                            const NeverScrollableScrollPhysics(), // 🔑 IMPORTANT
                        itemBuilder: (context, index) {
                          final item = snapshot.data![index];

                          return _promotionItem(context, item);
                        },
                      );
                    },
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
      // BOUTON FLOTTANT POUR AJOUTER UNE PROMO
    );
  }

  // ---------------------------------------------------------------------------
  // COMPOSANTS
  // ---------------------------------------------------------------------------

  // Bouton pour accéder à ProgrammeRecompensePage
  Widget _buildAccessProgramButton(BuildContext context, ThemeData theme) {
    return InkWell(
      onTap: () {
        // Navigation vers ProgrammeRecompensePage
        Navigator.push(
            context,
            MaterialPageRoute(
                builder: (context) =>
                    ProgrammeRecompensePage(optionPage: true)));
      },
      child: Container(
        padding: EdgeInsets.all(16),
        decoration: BoxDecoration(
          color: primaryColor.withOpacity(0.1),
          borderRadius: BorderRadius.circular(15),
          border: Border.all(color: primaryColor.withOpacity(0.3)),
        ),
        child: Row(
          children: [
            Icon(Icons.info_outline, color: primaryColor),
            SizedBox(width: 15),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    "Conditions du programme",
                    style: GoogleFonts.poppins(
                      fontWeight: FontWeight.bold,
                      fontSize: 14,
                      color: theme.textTheme.bodyLarge?.color,
                    ),
                  ),
                  SizedBox(height: 2),
                  Text(
                    "Relire les conditions ou quitter le programme",
                    style: GoogleFonts.poppins(
                      fontSize: 11,
                      color: Colors.grey[600],
                    ),
                  ),
                ],
              ),
            ),
            Icon(Icons.arrow_forward_ios, size: 14, color: primaryColor),
          ],
        ),
      ),
    );
  }

  // Bouton pour voir les promotions affaire
  Widget _buildBusinessPromotionsButton(BuildContext context) {
    return SizedBox(
      width: double.infinity,
      child: OutlinedButton.icon(
        onPressed: () {
          Navigator.push(
            context,
            MaterialPageRoute(
              builder: (context) => BusinessPromotionsPage(),
            ),
          );
        },
        icon: Icon(Icons.business_center_outlined, size: 18),
        label: Text(
          "Voir les promotions affaire disponibles",
          style: GoogleFonts.poppins(fontWeight: FontWeight.w600),
        ),
        style: OutlinedButton.styleFrom(
          foregroundColor: primaryColor,
          side: BorderSide(color: primaryColor),
          padding: EdgeInsets.symmetric(vertical: 12),
          shape:
              RoundedRectangleBorder(borderRadius: BorderRadius.circular(15)),
        ),
      ),
    );
  }

  Widget _buildWalletCard(BuildContext context) {
    return Container(
      width: double.infinity,
      margin: EdgeInsets.fromLTRB(10, 15, 10, 0),
      padding: EdgeInsets.all(24),
      decoration: BoxDecoration(
        gradient: LinearGradient(
          colors: [primaryColor, primaryColor.withOpacity(0.8)],
          begin: Alignment.topLeft,
          end: Alignment.bottomRight,
        ),
        borderRadius: BorderRadius.circular(15),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(
            "Solde disponible",
            style: GoogleFonts.poppins(
                color: Colors.white.withOpacity(0.8), fontSize: 14),
          ),
          SizedBox(height: 8),
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Text(
                "$soldeProgrammeRecompense FCFA",
                style: GoogleFonts.poppins(
                  color: Colors.white,
                  fontSize: 32,
                  fontWeight: FontWeight.bold,
                ),
              ),
              ElevatedButton(
                onPressed: () {
                  // Action de retrait
                },
                style: ElevatedButton.styleFrom(
                  backgroundColor: Colors.white,
                  foregroundColor: primaryColor,
                  elevation: 0,
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(13),
                  ),
                  padding:
                      const EdgeInsets.symmetric(horizontal: 15, vertical: 5),
                ),
                child: Row(
                  mainAxisSize: MainAxisSize.min,
                  children: [
                    Icon(Icons.account_balance_wallet_outlined, size: 20),
                    const SizedBox(width: 8),
                    Text(
                      "Retirer",
                      style: GoogleFonts.poppins(
                        fontWeight: FontWeight.bold,
                        fontSize: 15,
                      ),
                    ),
                  ],
                ),
              ),
            ],
          ),
          SizedBox(height: 8),
          Divider(color: Colors.white.withOpacity(0.2)),
          SizedBox(height: 10),
          Text(
            "Prochain retrait possible à partir de 1 000 FCFA",
            style: GoogleFonts.poppins(
                color: Colors.white.withOpacity(0.7), fontSize: 11),
          ),
        ],
      ),
    );
  }

  Widget _statItem(BuildContext context, String label, String value,
      IconData icon, Color color, theme) {
    final isDark = Theme.of(context).brightness == Brightness.dark;
    return Expanded(
      child: Container(
        padding: EdgeInsets.all(16),
        decoration: BoxDecoration(
          color: isDark ? Colors.white.withOpacity(0.05) : Colors.grey[50],
          borderRadius: BorderRadius.circular(15),
          border: Border.all(color: theme.dividerColor.withOpacity(0.1)),
        ),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Icon(icon, color: color, size: 24),
            SizedBox(height: 12),
            Text(
              value,
              style: GoogleFonts.poppins(
                fontSize: 20,
                fontWeight: FontWeight.bold,
                color: theme.textTheme.bodyLarge?.color,
              ),
            ),
            Text(
              label,
              style: GoogleFonts.poppins(
                fontSize: 12,
                color: isDark ? Colors.grey[400] : Colors.grey[600],
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _sectionTitle(
      BuildContext context, String title, double padingBottom) {
    return Padding(
      padding: EdgeInsets.only(bottom: padingBottom),
      child: Text(
        title,
        style: GoogleFonts.poppins(
          fontSize: 16,
          fontWeight: FontWeight.bold,
          color: Theme.of(context).textTheme.bodyLarge?.color,
        ),
      ),
    );
  }

  Widget _promotionItem(BuildContext context, HistoriqueRecompense item) {
    final isDark = Theme.of(context).brightness == Brightness.dark;
    final statusConfig = getStatusBadgeConfig(item.status);

    return InkWell(
      onTap: () => _showStatusDetailsBottomSheet(context, item),
      onDoubleTap: () => _showStatusDetailsBottomSheet(context, item),
      onLongPress: () => _showStatusDetailsBottomSheet(context, item),
      child: Padding(
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
                        imageUrl: item.imageUrl,
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
                          color: (item.status == "approuver")
                              ? Colors.green
                              : (item.status == "echouer" ||
                                      item.status == "refuser")
                                  ? Colors.red
                                  : (item.status == "en_attente")
                                      ? Colors.orange
                                      : Colors.black,
                          shape: BoxShape.circle,
                          border: Border.all(color: Colors.white, width: 1.5),
                        ),
                        child: Icon(
                          (item.status == "approuver")
                              ? Icons.check_circle
                              : (item.status == "echouer" ||
                                      item.status == "refuser")
                                  ? Icons.cancel
                                  : (item.status == "en_attente")
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
                      item.title,
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
                        Text(item.date,
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
                        Text(item.views,
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
                    item.amount,
                    style: GoogleFonts.poppins(
                      fontWeight: FontWeight.bold,
                      fontSize: 14,
                      color: (item.status == "approuver")
                          ? Colors.green
                          : (item.status == "echouer" ||
                                  item.status == "refuser")
                              ? Colors.red
                              : (item.status == "en_attente")
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
      ),
    );
  }

  void _showStatusDetailsBottomSheet(
      BuildContext context, HistoriqueRecompense item) {
    setState(() {
      _proofImage1 = null;
      _proofImage2 = null;
    });
    showModalBottomSheet(
      context: context,
      isScrollControlled: true,
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.vertical(top: Radius.circular(25)),
      ),
      builder: (context) {
        return StatefulBuilder(
          // Utiliser StatefulBuilder pour mettre à jour le BottomSheet
          builder: (context, setModalState) {
            return DraggableScrollableSheet(
              initialChildSize: 0.7,
              minChildSize: 0.4,
              maxChildSize: 0.95,
              expand: false,
              builder: (context, scrollController) {
                return SingleChildScrollView(
                  controller: scrollController,
                  padding: const EdgeInsets.all(20),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Center(
                        child: Container(
                          width: 40,
                          height: 5,
                          decoration: BoxDecoration(
                            color: Colors.grey[300],
                            borderRadius: BorderRadius.circular(10),
                          ),
                        ),
                      ),
                      const SizedBox(height: 20),
                      Text(
                        item.title,
                        style: GoogleFonts.poppins(
                          fontSize: 18,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                      Text(
                        "Récompense : ${item.amount} FCFA",
                        style: GoogleFonts.poppins(
                          fontSize: 14,
                          color: primaryColor,
                          fontWeight: FontWeight.w500,
                        ),
                      ),
                      const Divider(height: 30),
                      _buildStatusContent(item, setModalState),
                      const SizedBox(height: 30),
                      if (item.status == "terminer" ||
                          item.status == "en_cours" ||
                          item.status == "en_attente")
                        _buildWhatsAppButton(),
                    ],
                  ),
                );
              },
            );
          },
        );
      },
    );
  }

  Widget _buildStatusContent(
      HistoriqueRecompense item, StateSetter setModalState) {
    switch (item.status) {
      case "en_attente":
        return _statusInfo(
          Icons.hourglass_empty,
          Colors.orange,
          "En attente d'approbation",
          "Vous avez soumis vos preuves de participation. Notre équipe examine actuellement votre demande.\n\nSi vous ne l'avez pas encore fait, veuillez envoyer la capture vidéo comme dernière preuve par WhatsApp au numéro d'assistance de Dressur.",
        );
      case "terminer":
        return Column(
          children: [
            _statusInfo(
              Icons.timer_off,
              Colors.green,
              "Temps écoulé - Soumission requise",
              "Le temps de participation est terminé. Vous devez maintenant soumettre vos preuves (les deux captures d'écran) via le formulaire ci-dessous.\n\nNote : La capture vidéo doit être envoyée séparément par WhatsApp.",
            ),
            const SizedBox(height: 20),
            _buildSubmissionForm(item, setModalState),
          ],
        );
      case "echouer":
        return _statusInfo(
          Icons.error_outline,
          Colors.red,
          "Participation échouée",
          "Malheureusement, vous n'avez pas soumis vos preuves de participation dans les délais impartis. Il est désormais trop tard pour le faire pour cette promotion.",
        );
      case "refuser":
        return _statusInfo(
          Icons.block,
          Colors.red,
          "Preuves refusées",
          "Les preuves que vous avez fournies n'ont pas été jugées recevables par notre équipe de modération. En conséquence, la récompense ne peut pas être accordée.",
        );
      case "approuver":
        return _statusInfo(
          Icons.verified,
          Colors.green,
          "Félicitations ! Approuvé",
          "Vos preuves de participation ont été vérifiées et validées. La récompense a été créditée sur votre solde Dressur.",
        );
      case "en_cours":
        return Column(
          children: [
            _statusInfo(
              Icons.sync,
              Colors.blue,
              "Participation en cours",
              "Le temps de soumission n'est pas encore arrivé. Cependant, si vous estimez avoir déjà atteint votre objectif, vous pouvez soumettre vos preuves dès maintenant.",
            ),
            const SizedBox(height: 20),
            _buildSubmissionForm(item, setModalState),
          ],
        );
      default:
        return Text("Statut inconnu");
    }
  }

  Widget _statusInfo(
      IconData icon, Color color, String title, String description) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Row(
          children: [
            Icon(icon, color: color, size: 28),
            const SizedBox(width: 12),
            Expanded(
              child: Text(
                title,
                style: GoogleFonts.poppins(
                  fontSize: 16,
                  fontWeight: FontWeight.bold,
                  color: color,
                ),
              ),
            ),
          ],
        ),
        const SizedBox(height: 15),
        Text(
          description,
          style: GoogleFonts.poppins(
            fontSize: 14,
            color: Colors.grey[700],
            height: 1.5,
          ),
        ),
      ],
    );
  }

  Widget _buildSubmissionForm(
      HistoriqueRecompense item, StateSetter setModalState) {
    return Container(
      padding: const EdgeInsets.all(15),
      decoration: BoxDecoration(
        borderRadius: BorderRadius.circular(15),
        border: Border.all(color: Colors.grey[300]!),
      ),
      child: Column(
        children: [
          Text(
            "Formulaire de soumission",
            style: GoogleFonts.poppins(fontWeight: FontWeight.bold),
          ),
          const SizedBox(height: 15),

          // Capture 1
          _proofCard(
              "1",
              "Capture – Liste des statuts",
              "• Affiche la liste des statuts WhatsApp\n• Le statut de la promotion doit être visible",
              _proofImage1,
              () => _pickImage(1, setModalState)),

          const SizedBox(height: 15),

          // Capture 2
          _proofCard(
              "2",
              "Capture – Statut ouvert",
              "• Image complète\n• Texte descriptif complet\n• Nombre de vues, date et heure visibles",
              _proofImage2,
              () => _pickImage(2, setModalState)),

          const SizedBox(height: 20),

          SizedBox(
            width: double.infinity,
            child: ElevatedButton(
              onPressed: _isSubmitting
                  ? null
                  : () => _submitProofs(item, setModalState),
              style: ElevatedButton.styleFrom(
                backgroundColor: primaryColor,
                shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(10)),
                padding: EdgeInsets.symmetric(vertical: 12),
              ),
              child: _isSubmitting
                  ? SizedBox(
                      width: 20,
                      height: 20,
                      child: CircularProgressIndicator(
                          color: Colors.white, strokeWidth: 2))
                  : Text("Soumettre les preuves",
                      style: TextStyle(
                          color: Colors.white, fontWeight: FontWeight.bold)),
            ),
          ),
        ],
      ),
    );
  }

  Widget _proofCard(String number, String title, String instructions,
      File? image, VoidCallback onTap) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Row(
          children: [
            CircleAvatar(
                radius: 10,
                backgroundColor: primaryColor,
                child: Text(number,
                    style: TextStyle(color: Colors.white, fontSize: 10))),
            const SizedBox(width: 8),
            Text(title,
                style: GoogleFonts.poppins(
                    fontSize: 13, fontWeight: FontWeight.w600)),
          ],
        ),
        const SizedBox(height: 5),
        Text(instructions,
            style: TextStyle(fontSize: 11, color: Colors.grey[600])),
        const SizedBox(height: 10),
        InkWell(
          onTap: onTap,
          child: Container(
            height: 120,
            width: double.infinity,
            decoration: BoxDecoration(
              borderRadius: BorderRadius.circular(10),
              border: Border.all(color: Colors.grey[300]!),
              image: image != null
                  ? DecorationImage(image: FileImage(image), fit: BoxFit.cover)
                  : null,
            ),
            child: image == null
                ? Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      Icon(Icons.add_a_photo, color: primaryColor, size: 30),
                      const SizedBox(height: 5),
                      Text("Cliquez pour choisir",
                          style: TextStyle(fontSize: 12, color: Colors.grey)),
                    ],
                  )
                : Stack(
                    children: [
                      Positioned(
                        top: 5,
                        right: 5,
                        child: CircleAvatar(
                            radius: 12,
                            backgroundColor: Colors.black54,
                            child: Icon(Icons.edit,
                                size: 14, color: Colors.white)),
                      )
                    ],
                  ),
          ),
        ),
      ],
    );
  }

  Future<void> _pickImage(int index, StateSetter setModalState) async {
    final XFile? pickedFile =
        await _picker.pickImage(source: ImageSource.gallery, imageQuality: 80);
    if (pickedFile != null) {
      setState(() {
        if (index == 1)
          _proofImage1 = File(pickedFile.path);
        else
          _proofImage2 = File(pickedFile.path);
      });
      setModalState(() {}); // Mettre à jour le BottomSheet
    }
  }

  Future<void> _submitProofs(
      HistoriqueRecompense item, StateSetter setModalState) async {
    if (_proofImage1 == null || _proofImage2 == null) {
      dangerNoti("Attention",
          "Veuillez sélectionner les deux captures d'écran.", context);
      return;
    }

    setModalState(() => _isSubmitting = true);
    setState(() => _isSubmitting = true);

    try {
      var request = http.MultipartRequest('POST',
          Uri.parse('$generalRouteForApi/submitProgrammeRecompenseProofs'));

      request.fields['uid'] = uidUser;
      request.fields['langUserPhone'] = langUserPhone.toString();
      request.fields['idHistorique'] = item.id.toString();

      request.files.add(
          await http.MultipartFile.fromPath('capture1', _proofImage1!.path));
      request.files.add(
          await http.MultipartFile.fromPath('capture2', _proofImage2!.path));

      var response = await request.send();
      var responseData = await response.stream.bytesToString();
      var data = jsonDecode(responseData);

      if (response.statusCode == 200 && data['error'] == false) {
        Navigator.pop(context); // Fermer le BottomSheet
        successNoti("Succès",
            data['message'] ?? "Preuves soumises avec succès !", context);
        // Rafraîchir l'historique
        setState(() {
          _futureHistoriqueRecompense = partageInProgrammeRecompense();
        });
      } else {
        dangerNoti(
            "Erreur",
            data['message'] ?? "Une erreur est survenue lors de l'envoi.",
            context);
      }
    } catch (e) {
      dangerNoti("Erreur", "Impossible de contacter le serveur.", context);
    } finally {
      setModalState(() => _isSubmitting = false);
      setState(() => _isSubmitting = false);
    }
  }

  Widget _buildWhatsAppButton() {
    return SizedBox(
      width: double.infinity,
      child: OutlinedButton.icon(
        onPressed: () async {
          final whatsappUrl =
              "https://wa.me/229XXXXXXXX"; // Remplacer par le vrai numéro
          if (await canLaunchUrl(Uri.parse(whatsappUrl))) {
            await launchUrl(Uri.parse(whatsappUrl));
          }
        },
        icon: Icon(Icons.chat, size: 18),
        label: Text("Envoyer la vidéo sur WhatsApp"),
        style: OutlinedButton.styleFrom(
          foregroundColor: Colors.green,
          side: BorderSide(color: Colors.green),
          padding: EdgeInsets.symmetric(vertical: 12),
          shape:
              RoundedRectangleBorder(borderRadius: BorderRadius.circular(15)),
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
