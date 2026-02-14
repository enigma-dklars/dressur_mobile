// ignore_for_file: non_constant_identifier_names, use_build_context_synchronously

import 'dart:convert';
import 'dart:convert' as convert;
import 'package:cached_network_image/cached_network_image.dart';
import 'package:dressur/2_promo/edit_promo_affaire_produit_service.dart';
import 'package:dressur/components/noti.dart';
import 'package:dressur/components/noti_sys.dart';
import 'package:flutter/material.dart';
import 'package:flutter_linkify/flutter_linkify.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:http/http.dart' as http;
import 'package:dressur/5_autre/support_assistance.dart';
import 'package:dressur/components/constant.dart';
import 'package:select_form_field/select_form_field.dart';
import 'package:url_launcher/url_launcher.dart';

class Promotion {
  final String id;
  final String image;
  final String nombreDeVues;
  final String nombreImpression;
  final String description;
  final String status;
  final String dateDebut;
  final String dateExp;
  final String formulePromotion;
  final bool peutPayer;
  final String motif;
  final String typePromotionAffaire;
  final String annotherInfo;
  final bool inProgrammeRecompense;
  final bool publishOnDressurStatus;

  Promotion({
    required this.id,
    required this.image,
    required this.nombreDeVues,
    required this.nombreImpression,
    required this.description,
    required this.status,
    required this.dateDebut,
    required this.dateExp,
    required this.formulePromotion,
    required this.peutPayer,
    required this.motif,
    required this.typePromotionAffaire,
    required this.annotherInfo,
    required this.inProgrammeRecompense,
    required this.publishOnDressurStatus,
  });
}

class PromotionListPage extends StatefulWidget {
  @override
  _PromotionListPageState createState() => _PromotionListPageState();
}

class _PromotionListPageState extends State<PromotionListPage> {
  bool _loading = false;
  List<Promotion> _promotions = [];

  Future<void> fetchPromotions() async {
    setState(() {
      _loading = true;
    });
    try {
      final url = Uri.parse(
          '$generalRouteForApi/listPromotion/$uidUser/$langUserPhone');
      final response = await http.get(url);

      if (response.statusCode == 200) {
        final jsonData = jsonDecode(response.body) as List<dynamic>;
        final promotions = jsonData.map((data) {
          return Promotion(
            id: data['id'],
            image: generalRouteForPromotionImage + data['image'],
            nombreDeVues: data['nombreDeVues'],
            nombreImpression: data['nombreImpression'],
            description: data['description'],
            status: data['status'],
            dateDebut: data['dateDebut'],
            dateExp: data['dateExp'],
            formulePromotion: data['formulePromotion'],
            peutPayer: data['peutPayer'],
            motif: data['motif'],
            typePromotionAffaire: data['typePromotionAffaire'],
            annotherInfo: data['annotherInfo'] != null
                ? jsonEncode(data['annotherInfo'])
                : "",
            inProgrammeRecompense: data['inProgrammeRecompense'] == 1,
            publishOnDressurStatus: data['publishOnDressurStatus'] == 1,
          );
        }).toList();

        setState(() {
          _promotions = promotions;
        });
      } else {
        _showErrorDialog(
            'Failed to retrieve promotions. Error code: ${response.statusCode}');
      }
    } catch (e) {
      _showErrorDialog(
          'An error occurred while fetching promotions. Please try again. ::: ' +
              e.toString());
    } finally {
      setState(() {
        _loading = false;
      });
    }
  }

  void _showErrorDialog(String message) {
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          title: const Text('Erreur'),
          content: Text(message),
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

  @override
  void initState() {
    super.initState();
    fetchPromotions();
  }

  Widget _buildStatusLabel(String status) {
    Color backgroundColor;
    if ([
      "Completed",
      "Terminé",
      "Accept and in progress",
      "Accepter et en cours"
    ].contains(status)) {
      backgroundColor = Colors.green;
    } else if ([
      "Waiting for validation",
      "En Attente de validation",
      "Accept and pending payment",
      "Accepter et en attente de paiement"
    ].contains(status)) {
      backgroundColor = Colors.orange;
    } else {
      backgroundColor = Colors.red;
    }
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 1),
      decoration: BoxDecoration(
        color: backgroundColor,
        borderRadius: BorderRadius.circular(10.0),
      ),
      child: Text(
        status,
        style: GoogleFonts.poppins(
            fontSize: 12, color: Colors.white, fontWeight: FontWeight.bold),
      ),
    );
  }

  Widget _buildTypePromoAffaire(String type) {
    Color backgroundColor;
    String typeLabel;
    if (type == "produit_service") {
      backgroundColor = Colors.green;
      typeLabel = "Produit Service";
    } else if (type == "offre_emploi") {
      backgroundColor = Colors.orange;
      typeLabel = "Offre Emploi";
    } else {
      backgroundColor = Colors.red;
      typeLabel = "Demande Emploi";
    }
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 1),
      decoration: BoxDecoration(
        color: backgroundColor,
        borderRadius: BorderRadius.circular(10.0),
      ),
      child: Text(
        typeLabel,
        style: GoogleFonts.poppins(
            fontSize: 12, color: Colors.white, fontWeight: FontWeight.bold),
      ),
    );
  }

  // ignore_for_file: prefer_const_constructors

// --- WIDGET PRINCIPAL DE LA CARTE ---
  Widget _buildPromotionCard(Promotion promotion) {
    // Détermine si la promotion est dans un état "actif" ou "refusé/en attente d'action"
    final bool isActiveOrPending = [
      "Completed",
      "Terminé",
      "Accept and in progress",
      "Accepter et en cours",
      "Waiting for validation",
      "En Attente de validation",
      "Accept and pending payment",
      "Accepter et en attente de paiement"
    ].contains(promotion.status);

    return Card(
      elevation: 0.8,
      margin: const EdgeInsets.symmetric(horizontal: 10, vertical: 8),
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(10)),
      clipBehavior:
          Clip.antiAlias, // Important pour que le ClipRRect fonctionne
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          // --- 1. EN-TÊTE AVEC IMAGE ET BADGES ---
          _buildCardHeader(promotion),

          // --- 2. CONTENU PRINCIPAL (ACTIF OU REFUSÉ) ---
          Padding(
            padding: const EdgeInsets.all(15.0),
            child: AnimatedSwitcher(
              duration: Duration(milliseconds: 300),
              child: isActiveOrPending
                  ? _buildActiveContent(promotion)
                  : _buildRejectedContent(promotion),
            ),
          ),

          // --- 3. PIED DE PAGE AVEC BOUTONS D'ACTION ---
          Padding(
            padding: const EdgeInsets.fromLTRB(10, 0, 10, 15),
            child: _buildActionButtons(promotion),
          ),
        ],
      ),
    );
  }

// --- HELPERS POUR CONSTRUIRE LA CARTE ---

  Widget _buildCardHeader(Promotion promotion) {
    return Stack(
      children: [
        // Image de fond
        CachedNetworkImage(
          imageUrl: promotion.image,
          height: 150,
          width: double.infinity,
          fit: BoxFit.cover,
          placeholder: (context, url) => Container(color: Colors.grey[200]),
          errorWidget: (context, url, error) =>
              Center(child: Icon(Icons.error)),
        ),
        // Dégradé pour la lisibilité des badges
        Container(
          height: 150,
          decoration: BoxDecoration(
            gradient: LinearGradient(
              begin: Alignment.bottomCenter,
              end: Alignment.topCenter,
              colors: [Colors.black.withOpacity(0.9), Colors.transparent],
              stops: [0.0, 1],
            ),
          ),
        ),
        // Badges superposés
        Positioned(
          bottom: 10,
          left: 10,
          right: 10,
          child: Wrap(
            spacing: 6,
            runSpacing: 4,
            children: [
              _buildStatusLabel(promotion.status),
              _buildTypePromoAffaire(promotion.typePromotionAffaire),
              if (promotion.inProgrammeRecompense)
                _buildSpecialBadge(
                  icon: Icons.stars,
                  text: "Programme Récompense",
                  gradient: LinearGradient(
                      colors: [Colors.orange[700]!, Colors.orange[400]!]),
                ),
              if (promotion.publishOnDressurStatus)
                _buildSpecialBadge(
                  icon: Icons.verified_user,
                  text: "Statut Dressur",
                  gradient: LinearGradient(
                      colors: [primaryColor, primaryColor.withOpacity(0.7)]),
                ),
            ],
          ),
        ),
      ],
    );
  }

  Widget _buildActiveContent(Promotion promotion) {
    return Column(
      key: ValueKey('active'),
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        SizedBox(height: 8),
        Text(
          promotion.description,
          style: GoogleFonts.poppins(fontSize: 14, color: Colors.grey[600]),
          maxLines: 2,
          overflow: TextOverflow.ellipsis,
        ),
        SizedBox(height: 12),
        Row(
          children: [
            _buildStatItem(Icons.visibility_outlined,
                promotion.nombreImpression, "Impressions"),
            SizedBox(width: 20),
            _buildStatItem(
                Icons.touch_app_outlined, promotion.nombreDeVues, "Vues"),
          ],
        ),
      ],
    );
  }

  Widget _buildRejectedContent(Promotion promotion) {
    bool canEdit = promotion.typePromotionAffaire == "produit_service";
    String infoText = canEdit
        ? "Tenez compte du motif de refus pour modifier votre promotion. Merci..."
        : "Tenez compte du motif de refus pour soumettre une nouvelle promotion. Merci...";

    return Container(
      key: ValueKey('rejected'),
      padding: EdgeInsets.all(12),
      decoration: BoxDecoration(
        color: Colors.red.withOpacity(0.05),
        borderRadius: BorderRadius.circular(10),
        border: Border.all(color: Colors.red.withOpacity(0.2)),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              Icon(Icons.warning_amber_rounded,
                  color: Colors.red[700], size: 20),
              SizedBox(width: 8),
              Text(
                (langUserPhone == "fr") ? "Action requise" : "Action Required",
                style: GoogleFonts.poppins(
                    fontSize: 16,
                    fontWeight: FontWeight.bold,
                    color: Colors.red[700]),
              ),
            ],
          ),
          SizedBox(height: 8),
          Text(
            "${(langUserPhone == "fr") ? "Motif" : "Reason"}: ${promotion.motif}",
            style: GoogleFonts.poppins(
                color: Colors.red[700], fontWeight: FontWeight.w500),
          ),
          SizedBox(height: 4),
          Text(
            infoText,
            style: GoogleFonts.poppins(fontSize: 13, color: Colors.grey[600]),
          ),
        ],
      ),
    );
  }

  Widget _buildActionButtons(Promotion promotion) {
    bool canPay = promotion.peutPayer &&
        promotion.typePromotionAffaire == "produit_service";
    bool canEdit = ![
          "Completed",
          "Terminé",
          "Accept and in progress",
          "Accepter et en cours",
          "Waiting for validation",
          "En Attente de validation",
          "Accept and pending payment",
          "Accepter et en attente de paiement"
        ].contains(promotion.status) &&
        promotion.typePromotionAffaire == "produit_service";

    return Row(
      mainAxisAlignment: MainAxisAlignment.end,
      children: [
        if (canPay) ...[
          ElevatedButton.icon(
            onPressed: () => Navigator.push(
                context,
                MaterialPageRoute(
                    builder: (context) =>
                        PaymentPayantPage(promotion: promotion))),
            icon: Icon(Icons.payment, size: 16),
            label: Text((langUserPhone == "fr") ? 'Payer' : 'Pay'),
            style: ElevatedButton.styleFrom(
                backgroundColor: Colors.orange,
                foregroundColor: Colors.white,
                shape: StadiumBorder()),
          ),
          SizedBox(width: 8),
        ],
        if (canEdit) ...[
          ElevatedButton.icon(
            onPressed: () => Navigator.push(
                context,
                MaterialPageRoute(
                    builder: (context) =>
                        ModificationProduitServicesPage(promotion: promotion))),
            icon: Icon(Icons.edit, size: 16),
            label: Text((langUserPhone == "fr") ? 'Modifier' : 'Edit'),
            style: ElevatedButton.styleFrom(
                backgroundColor: Colors.green,
                foregroundColor: Colors.white,
                shape: StadiumBorder()),
          ),
          SizedBox(width: 8),
        ],
        OutlinedButton(
          onPressed: () => Navigator.push(
              context,
              MaterialPageRoute(
                  builder: (context) =>
                      PromotionDetailPage(promotion: promotion))),
          style: OutlinedButton.styleFrom(shape: StadiumBorder()),
          child: Text((langUserPhone == "fr") ? 'Détails' : 'Details'),
        ),
      ],
    );
  }

// --- HELPERS POUR LES PETITS COMPOSANTS (BADGES, STATS) ---

  Widget _buildSpecialBadge(
      {required IconData icon,
      required String text,
      required Gradient gradient}) {
    return Container(
      padding: EdgeInsets.symmetric(horizontal: 8, vertical: 3),
      decoration: BoxDecoration(
          gradient: gradient, borderRadius: BorderRadius.circular(20)),
      child: Row(
        mainAxisSize: MainAxisSize.min,
        children: [
          Icon(icon, color: Colors.white, size: 10),
          SizedBox(width: 4),
          Text(text,
              style: GoogleFonts.poppins(
                  color: Colors.white,
                  fontSize: 10,
                  fontWeight: FontWeight.bold)),
        ],
      ),
    );
  }

  Widget _buildStatItem(IconData icon, String value, String label) {
    return Row(
      children: [
        Icon(icon, color: Colors.grey[600], size: 18),
        SizedBox(width: 6),
        Text(value,
            style:
                GoogleFonts.poppins(fontWeight: FontWeight.bold, fontSize: 15)),
        SizedBox(width: 4),
        Text(label,
            style: GoogleFonts.poppins(color: Colors.grey[600], fontSize: 13)),
      ],
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
          (langUserPhone == "fr")
              ? 'Liste Promotion Affaire'
              : 'Business Promotion List',
          style: GoogleFonts.poppins(
              fontWeight: FontWeight.w400, color: Colors.white),
        ),
        leading: IconButton(
          onPressed: () {
            Navigator.pop(context);
          },
          icon: const Icon(Icons.arrow_back_ios, color: Colors.white),
        ),
        backgroundColor: primaryColor,
        actions: [
          PopupMenuButton<dynamic>(
            itemBuilder: (context) => [
              PopupMenuItem(
                value: 1,
                child: Text(
                  (langUserPhone == "fr") ? "Actualiser" : "Refresh",
                  style: GoogleFonts.poppins(
                      color: Colors.white, fontWeight: FontWeight.w600),
                ),
              ),
              PopupMenuItem(
                value: 2,
                child: Text(
                  (langUserPhone == "fr") ? "Aide" : "Help",
                  style: GoogleFonts.poppins(
                      color: Colors.white, fontWeight: FontWeight.w600),
                ),
              ),
            ],
            offset: const Offset(0, 60),
            color: primaryColor,
            icon: const Icon(Icons.menu, color: Colors.white),
            elevation: 2,
            onSelected: (value) {
              if (value == 1) {
                fetchPromotions();
              } else if (value == 2) {
                Navigator.push(context,
                    MaterialPageRoute(builder: (context) => SupportPage()));
              }
            },
          ),
        ],
      ),
      body: _loading
          ? const Center(child: CircularProgressIndicator())
          : _promotions.isEmpty
              ? Center(
                  child: Text(
                    (langUserPhone == "fr")
                        ? "Aucune promotion affaire trouvée."
                        : "No deal promotions found.",
                    style: GoogleFonts.poppins(fontSize: 16),
                  ),
                )
              : ListView.builder(
                  itemCount: _promotions.length,
                  itemBuilder: (BuildContext context, int index) {
                    return _buildPromotionCard(_promotions[index]);
                  },
                ),
    );
  }
}

class PromotionDetailPage extends StatelessWidget {
  final Promotion promotion;

  PromotionDetailPage({required this.promotion});

  Future<void> _launchURL(String url) async {
    final Uri uri = Uri.parse(url);
    if (!await launchUrl(uri, mode: LaunchMode.externalApplication)) {
      print('Could not launch $url');
    }
  }

  @override
  Widget build(BuildContext context) {
    final isDark = Theme.of(context).brightness == Brightness.dark;
    final Map<String, dynamic> infoMap = (promotion.annotherInfo != "")
        ? jsonDecode(promotion.annotherInfo)
        : {};

    return Scaffold(
      appBar: AppBar(
        backgroundColor: primaryColor,
        foregroundColor: Colors.white,
        title: Text(
          (langUserPhone == "fr") ? 'Détails' : 'Details',
          style: GoogleFonts.poppins(fontWeight: FontWeight.w600),
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
        physics: BouncingScrollPhysics(),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            // --- IMAGE ---
            CachedNetworkImage(
              imageUrl: promotion.image,
              width: double.infinity,
              fit: BoxFit.fitWidth,
              placeholder: (context, url) => AspectRatio(
                  aspectRatio: 16 / 9,
                  child: Container(color: Colors.grey[200])),
              errorWidget: (context, url, error) =>
                  AspectRatio(aspectRatio: 16 / 9, child: Icon(Icons.error)),
            ),

            // --- BANDEAU D'ACTION "PAYER" ---
            if (promotion.peutPayer) _buildPaymentBanner(context),

            // --- CONTENU PRINCIPAL ---
            Padding(
              padding: const EdgeInsets.all(15.0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  SizedBox(height: 10),
                  // Statut
                  _buildStatusLabel(promotion.status),
                  SizedBox(height: 25),

                  // Section Détails
                  _buildSectionTitle(
                      icon: Icons.calendar_today_outlined,
                      title: (langUserPhone == "fr")
                          ? "Détails de la promotion"
                          : "Promotion Details"),
                  _buildDetailRow("Formule", promotion.formulePromotion),
                  _buildDetailRow(
                      (langUserPhone == "fr") ? "Date de début" : "Start Date",
                      promotion.dateDebut),
                  _buildDetailRow(
                      (langUserPhone == "fr")
                          ? "Date d'expiration"
                          : "Expiration Date",
                      promotion.dateExp),
                  SizedBox(height: 25),

                  // Section Statistiques
                  _buildSectionTitle(
                      icon: Icons.bar_chart_outlined,
                      title: (langUserPhone == "fr")
                          ? "Statistiques"
                          : "Statistics"),
                  _buildDetailRow("Impressions", promotion.nombreImpression),
                  _buildDetailRow((langUserPhone == "fr") ? "Vues" : "Views",
                      promotion.nombreDeVues),
                  SizedBox(height: 25),

                  // Section Description
                  _buildSectionTitle(
                      icon: Icons.description_outlined,
                      title: (langUserPhone == "fr")
                          ? "Description"
                          : "Description"),
                  SelectableLinkify(
                    onOpen: (link) => _launchURL(link.url),
                    text: promotion.description,
                    style: GoogleFonts.poppins(fontSize: 14, height: 1.6),
                    linkStyle: GoogleFonts.poppins(
                        color: Colors.blue, decoration: TextDecoration.none),
                  ),
                  SizedBox(height: 30),

                  // Section Infos Supplémentaires
                  if (infoMap.isNotEmpty) ...[
                    _buildSectionTitle(
                        icon: Icons.info_outline_rounded,
                        title: (langUserPhone == "fr")
                            ? "Informations supplémentaires"
                            : "Additional Information"),
                    ...infoMap.entries.map((entry) {
                      final key =
                          StringExtension(entry.key.replaceAll('_', ' '))
                              .capitalize();
                      final value = entry.value;
                      return _buildInfoRow(key, value);
                    }).toList(),
                  ],
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }

  // --- WIDGETS HELPERS ---

  Widget _buildPaymentBanner(BuildContext context) {
    return Container(
      width: double.infinity,
      color: Colors.orange[100],
      padding: EdgeInsets.symmetric(horizontal: 15, vertical: 12),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  (langUserPhone == "fr")
                      ? "Promotion acceptée !"
                      : "Promotion accepted!",
                  style: GoogleFonts.poppins(
                      fontWeight: FontWeight.bold, color: Colors.orange[800]),
                ),
                SizedBox(height: 2),
                Text(
                  (langUserPhone == "fr")
                      ? "Finalisez en procédant au paiement."
                      : "Finalize by making the payment.",
                  style: GoogleFonts.poppins(
                      fontSize: 12, color: Colors.orange[700]),
                ),
              ],
            ),
          ),
          SizedBox(width: 10),
          ElevatedButton(
            onPressed: () => Navigator.push(
                context,
                MaterialPageRoute(
                    builder: (context) =>
                        PaymentPayantPage(promotion: promotion))),
            child: Text((langUserPhone == "fr") ? "Payer" : "Pay"),
            style: ElevatedButton.styleFrom(
              backgroundColor: Colors.orange[800],
              foregroundColor: Colors.white,
              shape: StadiumBorder(),
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildSectionTitle({required IconData icon, required String title}) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 12.0),
      child: Row(
        children: [
          Icon(icon, color: primaryColor, size: 20),
          SizedBox(width: 10),
          Text(title,
              style: GoogleFonts.poppins(
                  fontSize: 18, fontWeight: FontWeight.bold)),
        ],
      ),
    );
  }

  Widget _buildDetailRow(String label, String value) {
    return Padding(
      padding: const EdgeInsets.only(top: 8.0, left: 30),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text("$label :",
              style: GoogleFonts.poppins(
                  color: Colors.grey[600], fontWeight: FontWeight.w500)),
          SizedBox(width: 8),
          Expanded(
              child: Text(value,
                  style: GoogleFonts.poppins(fontWeight: FontWeight.w600))),
        ],
      ),
    );
  }

  Widget _buildInfoRow(String key, String value) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 12.0, left: 30),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(key,
              style: GoogleFonts.poppins(
                  fontSize: 14,
                  color: Colors.grey[600],
                  fontWeight: FontWeight.w500)),
          SizedBox(height: 4),
          SelectableLinkify(
            onOpen: (link) => _launchURL(link.url),
            text: value,
            style:
                GoogleFonts.poppins(fontSize: 16, fontWeight: FontWeight.w500),
            linkStyle: GoogleFonts.poppins(
                color: Colors.blue, decoration: TextDecoration.none),
          ),
          Divider(height: 12),
        ],
      ),
    );
  }

  Widget _buildStatusLabel(String status) {
    Color backgroundColor = Colors.grey;
    if ([
      "Completed",
      "Terminé",
      "Accept and in progress",
      "Accepter et en cours"
    ].contains(status)) backgroundColor = Colors.green;
    if ([
      "Waiting for validation",
      "En Attente de validation",
      "Accept and pending payment",
      "Accepter et en attente de paiement"
    ].contains(status)) backgroundColor = Colors.orange;
    if (["Refused", "Refusé"].contains(status)) backgroundColor = Colors.red;

    return Align(
      alignment: Alignment.centerLeft,
      child: Container(
        padding: EdgeInsets.symmetric(horizontal: 12, vertical: 5),
        decoration: BoxDecoration(
            color: backgroundColor, borderRadius: BorderRadius.circular(20)),
        child: Text(status,
            style: GoogleFonts.poppins(
                color: Colors.white,
                fontSize: 12,
                fontWeight: FontWeight.bold)),
      ),
    );
  }
}

extension StringExtension on String {
  String capitalize() {
    if (this.isEmpty) return "";
    return "${this[0].toUpperCase()}${this.substring(1)}";
  }
}

class PaymentPayantPage extends StatefulWidget {
  final Promotion promotion;

  PaymentPayantPage({required this.promotion});

  @override
  _PaymentPayantPageState createState() => _PaymentPayantPageState();
}

class _PaymentPayantPageState extends State<PaymentPayantPage> {
  bool _desactive2 = false;
  bool loading_formule_payant = false;
  var _message = "";
  dynamic data;
  dynamic idFormulBoost = 0;
  dynamic valueMethodePaiement = "mtn";
  final telController = TextEditingController(text: tel);

  List<Map<String, dynamic>> listeDesFormules = [];
  int value = 0;
  var label = "";
  int prix = 0;
  int jours = 0;

  // --- NOUVELLES VARIABLES POUR LES OPTIONS ---
  bool _participateInReward = false;
  int _totalViewsGoal = 2500;
  final TextEditingController _viewsController =
      TextEditingController(text: "2500");

  bool _publishOnDressurStatus = false;
  final int _dressurStatusPricePer7Days = 5000;

  // --- CALCULS DYNAMIQUES ---
  double get _rewardProgramAmount {
    if (!_participateInReward) return 0.0;
    int effectiveViews = _totalViewsGoal < 2500 ? 2500 : _totalViewsGoal;
    double baseReward = (effectiveViews * 2500) / 4000;
    return baseReward * 1.2; // + 20% commission
  }

  double get _dressurStatusAmount {
    if (!_publishOnDressurStatus || jours == 0) return 0.0;
    return (jours * _dressurStatusPricePer7Days) / 7;
  }

  double get _subTotal =>
      prix.toDouble() + _rewardProgramAmount + _dressurStatusAmount;
  double get _fedapayMax => _subTotal * 0.04;
  double get _totalWithMaxCommission => _subTotal + _fedapayMax;

  void listeFormulePromoAffaire() async {
    bool isConnected = await isConnectedToInternet();
    if (isConnected) {
      setState(() {
        _desactive2 = true;
        loading_formule_payant = true;
      });

      var response = await http
          .post(Uri.parse('$generalRouteForApi/listeFormulePromoAffaire'));
      if (response.statusCode == 200) {
        var data = convert.jsonDecode(response.body);
        if (data["error"] == false) {
          setState(() {
            _desactive2 = false;
            loading_formule_payant = false;
            listeDesFormules = (data["listeFormulBoost"] as List<dynamic>)
                .map((item) => item as Map<String, dynamic>)
                .toList();
            listeMethodePaiements =
                (data["listeMethodePaiements"] as List<dynamic>)
                    .map((item) => item as Map<String, dynamic>)
                    .toList();
            _message = (langUserPhone == "fr")
                ? "Veuillez choisir une formule."
                : "Please choose a plan.";
          });
        }
      }
    } else {
      dangerNoti(
          "Erreur!",
          (langUserPhone == "fr")
              ? "Pas de connexion internet."
              : "No internet connection.",
          context);
      setState(() {
        _desactive2 = false;
        loading_formule_payant = false;
      });
    }
  }

  onChangeFormulBoost(val) {
    final selected = listeDesFormules
        .firstWhere((e) => e['value'].toString() == val.toString());
    setState(() {
      idFormulBoost = val;
      value = selected['value'];
      label = selected['label'];
      prix = selected['prix'];
      jours = selected['jours'];
      _message = (langUserPhone == "fr")
          ? "Formule de $jours jour(s) pour $prix FCFA."
          : "Plan of $jours day(s) for $prix FCFA.";
    });
  }

  void newPromoPayant() async {
    if (telIsVerified) {
      if (idFormulBoost == 0) {
        dangerNoti(
            "Attention", "Veuillez choisir une formule de boost.", context);
        return;
      }

      bool isConnected = await isConnectedToInternet();
      if (isConnected) {
        setState(() => _desactive2 = true);

        var request = http.MultipartRequest(
            'POST', Uri.parse('$generalRouteForApi/newPromoPayant'));
        request.fields.addAll({
          'uid': uidUser,
          'idPromotion': widget.promotion.id,
          'langUserPhone': langUserPhone.toString(),
          'idFormulBoost': idFormulBoost.toString(),
          'valueMethodePaiement': valueMethodePaiement,
          'tel': telController.text,
          // Nouvelles options
          'inProgrammeRecompense': _participateInReward ? "1" : "0",
          'totalViewsGoal': _totalViewsGoal.toString(),
          'publishOnDressurStatus': _publishOnDressurStatus ? "1" : "0",
          'totalAmount': _totalWithMaxCommission.toStringAsFixed(0),
        });

        http.StreamedResponse response = await request.send();
        if (response.statusCode == 200) {
          var data = convert.jsonDecode(await response.stream.bytesToString());
          if (data["error"] == false) {
            setState(() {
              // 1. Réinitialisation des états de chargement et financiers
              _desactive2 = false;
              prix = 0;
              jours = 0;
              value = 0;
              idFormulBoost = 0;

              // 3. Réinitialisation des contrôleurs de texte
              _viewsController.text = "2500"; // Vues par défaut
              // telController.text = tel;    // Optionnel : remettre le tel par défaut si besoin

              // 4. Réinitialisation des messages et labels
              _message = (langUserPhone == "fr")
                  ? "Veuillez choisir une formule."
                  : "Please choose a plan.";
              label = "";

              // 5. Réinitialisation des options spécifiques (Reward & Status)
              _participateInReward = false;
              _totalViewsGoal = 2500;
              _publishOnDressurStatus = false;

              // 6. Réinitialisation du mode de paiement par défaut
              valueMethodePaiement = "mtn";
            });

            if (data["direct"] == true) {
              successNoti(
                  "Succès",
                  (langUserPhone == "fr")
                      ? "Veuillez confirmer le paiement pour relancer la promotion."
                      : "Please confirm payment to restart the promotion.",
                  context);
            } else {
              launchPaiement(data["url"]);
              successNoti(
                  "Succès",
                  (langUserPhone == "fr")
                      ? "Veuillez confirmer le paiement pour finaliser l'enregistrement de votre promotion."
                      : "Please confirm payment to finalize the registration of your promotion.",
                  context);
            }
          } else {
            dangerNoti(data["titre"], data["message"], context);
            setState(() => _desactive2 = false);
          }
        }
      }
    } else {
      showConfNumeroWhatsapp(context);
    }
  }

  @override
  void initState() {
    super.initState();
    listeFormulePromoAffaire();
    _viewsController.addListener(() {
      final val = int.tryParse(_viewsController.text) ?? 0;
      setState(() => _totalViewsGoal = val);
    });
  }

  @override
  void dispose() {
    telController.dispose();
    _viewsController.dispose();
    super.dispose();
  }

  Widget _buildOptionHeader(IconData icon, String title, bool isActive) {
    return Row(
      children: [
        Icon(icon, color: isActive ? primaryColor : Colors.grey, size: 20),
        const SizedBox(width: 10),
        Text(title,
            style: GoogleFonts.poppins(
                fontWeight: FontWeight.bold,
                fontSize: 14,
                color: isActive ? primaryColor : Colors.grey[700])),
      ],
    );
  }

  Widget _infoBox(String text, Color color) {
    return Container(
      width: double.infinity,
      padding: const EdgeInsets.all(10),
      decoration: BoxDecoration(
          color: color.withOpacity(0.1),
          borderRadius: BorderRadius.circular(8),
          border: Border.all(color: color.withOpacity(0.3))),
      child: Text(text,
          style: GoogleFonts.poppins(
              color: color, fontWeight: FontWeight.bold, fontSize: 12),
          textAlign: TextAlign.center),
    );
  }

  Widget _recapRow(String label, double amount,
      {bool isBold = false, bool isSmall = false}) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 2),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          Text(label,
              style: GoogleFonts.poppins(
                  fontSize: isSmall ? 11 : 13,
                  fontWeight: isBold ? FontWeight.bold : FontWeight.normal)),
          Text("${amount.toStringAsFixed(0)} F",
              style: GoogleFonts.poppins(
                  fontSize: isSmall ? 11 : 13,
                  fontWeight: isBold ? FontWeight.bold : FontWeight.normal)),
        ],
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Relancer la Promotion',
            style: GoogleFonts.poppins(
                fontWeight: FontWeight.w400, color: Colors.white)),
        leading: IconButton(
            onPressed: () => Navigator.pop(context),
            icon: const Icon(Icons.arrow_back_ios, color: Colors.white)),
        backgroundColor: primaryColor,
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.stretch,
          children: [
            loading_formule_payant
                ? const Center(child: CircularProgressIndicator())
                : SelectFormField(
                    decoration: const InputDecoration(
                        labelText: 'Formule de Boost',
                        border: OutlineInputBorder()),
                    type: SelectFormFieldType.dropdown,
                    initialValue: '0',
                    items: listeDesFormules,
                    onChanged: (val) => onChangeFormulBoost(val),
                  ),
            if (_message.isNotEmpty) ...[
              const SizedBox(height: 10),
              Text(_message,
                  style: GoogleFonts.poppins(fontSize: 14, color: primaryColor),
                  textAlign: TextAlign.center),
            ],
            const SizedBox(height: 20),

            // --- SECTION PROGRAMME DE RÉCOMPENSE ---
            _buildOptionHeader(
                Icons.stars, "Programme de Récompense", _participateInReward),
            SwitchListTile(
              title: Text("Ajouter au programme",
                  style: GoogleFonts.poppins(
                      fontSize: 14, fontWeight: FontWeight.w500)),
              subtitle: Text("Récompensez les partages statut WhatsApp.",
                  style: GoogleFonts.poppins(fontSize: 11)),
              value: _participateInReward,
              activeColor: primaryColor,
              onChanged: (val) => setState(() => _participateInReward = val),
            ),
            if (_participateInReward) ...[
              Padding(
                padding: const EdgeInsets.symmetric(horizontal: 16),
                child: Column(
                  children: [
                    Row(
                      children: [
                        Expanded(
                            child: Text("Objectif de vues (min. 2500)",
                                style: GoogleFonts.poppins(fontSize: 13))),
                        SizedBox(
                            width: 100,
                            child: TextField(
                                controller: _viewsController,
                                keyboardType: TextInputType.number,
                                decoration: const InputDecoration(
                                    isDense: true,
                                    border: OutlineInputBorder()))),
                      ],
                    ),
                    const SizedBox(height: 10),
                    _infoBox(
                        "Montant Récompense : ${_rewardProgramAmount.toStringAsFixed(0)} FCFA",
                        Colors.orange),
                  ],
                ),
              ),
            ],

            const SizedBox(height: 15),

            // --- SECTION STATUT DRESSUR ---
            _buildOptionHeader(
                Icons.verified_user, "Statut Dressur", _publishOnDressurStatus),
            SwitchListTile(
              title: Text("Publier sur le statut Dressur",
                  style: GoogleFonts.poppins(
                      fontSize: 14, fontWeight: FontWeight.w500)),
              subtitle: Text(
                  "Visibilité maximale sur notre statut officiel.",
                  style: GoogleFonts.poppins(fontSize: 11)),
              value: _publishOnDressurStatus,
              activeColor: primaryColor,
              onChanged: (val) => setState(() => _publishOnDressurStatus = val),
            ),
            if (_publishOnDressurStatus)
              Padding(
                  padding: const EdgeInsets.symmetric(horizontal: 16),
                  child: _infoBox(
                      "Frais Statut : ${_dressurStatusAmount.toStringAsFixed(0)} FCFA",
                      Colors.blue)),

            const SizedBox(height: 20),

            // --- RÉCAPITULATIF ---
            Container(
              padding: const EdgeInsets.all(15),
              decoration: BoxDecoration(
                  borderRadius: BorderRadius.circular(10),
                  border: Border.all(color: Colors.grey[300]!)),
              child: Column(
                children: [
                  _recapRow("Formule Boost", prix.toDouble()),
                  if (_participateInReward)
                    _recapRow("Programme Récompense", _rewardProgramAmount),
                  if (_publishOnDressurStatus)
                    _recapRow("Statut Dressur", _dressurStatusAmount),
                  const Divider(height: 20),
                  _recapRow("TOTAL ESTIMÉ", _totalWithMaxCommission,
                      isBold: true),
                ],
              ),
            ),

            const SizedBox(height: 20),
            SelectFormField(
              decoration: const InputDecoration(
                  labelText: 'Moyen de paiement', border: OutlineInputBorder()),
              type: SelectFormFieldType.dropdown,
              initialValue: 'mtn',
              items: listeMethodePaiements,
              onChanged: (val) => setState(() => valueMethodePaiement = val),
            ),
            const SizedBox(height: 10),
            TextField(
                controller: telController,
                decoration: const InputDecoration(
                    labelText: 'Numéro du paiement',
                    border: OutlineInputBorder())),

            const SizedBox(height: 20),
            ElevatedButton(
              style: ElevatedButton.styleFrom(
                  backgroundColor: primaryColor,
                  shape: const StadiumBorder(),
                  padding: const EdgeInsets.symmetric(vertical: 15)),
              onPressed: _desactive2 ? null : newPromoPayant,
              child: Text(_desactive2 ? "Patientez..." : "Payer et Relancer",
                  style: GoogleFonts.poppins(
                      color: Colors.white, fontWeight: FontWeight.bold)),
            ),
            const SizedBox(height: 20),
          ],
        ),
      ),
    );
  }
}
