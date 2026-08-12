// ignore_for_file: non_constant_identifier_names, use_build_context_synchronously

import 'dart:convert';
import 'dart:convert' as convert;
import 'package:cached_network_image/cached_network_image.dart';
import 'package:dressur/2_promo/edit_promo_affaire_produit_service.dart';
import 'package:dressur/components/noti.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:flutter_linkify/flutter_linkify.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:http/http.dart' as http;
import 'package:dressur/5_autre/support_assistance.dart';
import 'package:dressur/components/constant.dart';
import 'package:select_form_field/select_form_field.dart';
import 'package:url_launcher/url_launcher.dart';

class MotifRefus {
  final String motif;
  final String dateRefus;
  MotifRefus({required this.motif, required this.dateRefus});
  factory MotifRefus.fromJson(Map<String, dynamic> json) => MotifRefus(
        motif: json['motif'] ?? '',
        dateRefus: json['dateRefus'] ?? '',
      );
}

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
  final String whatsappContact;
  final List<MotifRefus> motifsRefus;

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
    this.whatsappContact = '',
    this.motifsRefus = const [],
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
      final url = Uri.parse('$generalRouteForApi/listPromotion/$uidUser/fr');
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
            whatsappContact: data['whatsappContact'] ?? '',
            motifsRefus: (data['motifsRefus'] as List<dynamic>? ?? [])
                .map((e) => MotifRefus.fromJson(e as Map<String, dynamic>))
                .toList(),
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
      typeLabel = (langUserPhone == "fr") ? "Produit Service" : "Product / Service";
    } else if (type == "offre_emploi") {
      backgroundColor = Colors.orange;
      typeLabel = (langUserPhone == "fr") ? "Offre Emploi" : "Job Offer";
    } else if (type == "sites_applications") {
      backgroundColor = Colors.indigo;
      typeLabel = "Sites & Apps";
    } else {
      backgroundColor = Colors.red;
      typeLabel = (langUserPhone == "fr") ? "Demande Emploi" : "Job Application";
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
              Center(child: FaIcon(FontAwesomeIcons.circleExclamation)),
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
                  icon: FontAwesomeIcons.star,
                  text: (langUserPhone == "fr") ? "Programme Récompense" : "Reward Program",
                  gradient: LinearGradient(
                      colors: [Colors.orange[700]!, Colors.orange[400]!]),
                ),
              if (promotion.publishOnDressurStatus)
                _buildSpecialBadge(
                  icon: FontAwesomeIcons.solidCircleCheck,
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
    // Contenu spécifique pour Sites & Applications
    if (promotion.typePromotionAffaire == "sites_applications") {
      return _buildSiteAppActiveContent(promotion);
    }
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
            _buildStatItem(FontAwesomeIcons.eye, promotion.nombreImpression,
                "Impressions"),
            SizedBox(width: 20),
            _buildStatItem(
                FontAwesomeIcons.handPointer, promotion.nombreDeVues, "Vues"),
          ],
        ),
        if (promotion.motifsRefus.isNotEmpty) ...[
          SizedBox(height: 4),
          TextButton(
            style: TextButton.styleFrom(
                padding: EdgeInsets.zero,
                tapTargetSize: MaterialTapTargetSize.shrinkWrap),
            onPressed: () =>
                _showHistoriqueModal(context, promotion.motifsRefus),
            child: Text(
              (langUserPhone == "fr")
                  ? "Historique des refus"
                  : "Rejection history",
              style: GoogleFonts.poppins(
                  fontSize: 12, color: Colors.grey[500]),
            ),
          ),
        ],
      ],
    );
  }

  Widget _buildSiteAppActiveContent(Promotion promotion) {
    final Map<String, dynamic> info = promotion.annotherInfo.isNotEmpty
        ? jsonDecode(promotion.annotherInfo) as Map<String, dynamic>
        : {};
    final String nom = info['nom'] ?? info['nomSiteApp'] ?? "";
    final String sousType =
        info['sousType'] ?? info['sousTypeSiteApp'] ?? "site_web";
    final String url = info['url'] ?? info['urlSiteApp'] ?? "";

    String sousTypeLabel;
    if (sousType == "app_mobile") {
      sousTypeLabel = langUserPhone == "fr" ? "App mobile" : "Mobile app";
    } else if (sousType == "logiciel_desktop") {
      sousTypeLabel = langUserPhone == "fr" ? "Logiciel" : "Software";
    } else {
      sousTypeLabel = langUserPhone == "fr" ? "Site web" : "Website";
    }

    return Column(
      key: const ValueKey('site_app_active'),
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        const SizedBox(height: 8),
        if (nom.isNotEmpty)
          Text(
            nom,
            style: GoogleFonts.poppins(
                fontWeight: FontWeight.bold, fontSize: 15),
          ),
        const SizedBox(height: 6),
        Container(
          padding:
              const EdgeInsets.symmetric(horizontal: 8, vertical: 2),
          decoration: BoxDecoration(
              color: Colors.indigo.withOpacity(0.12),
              borderRadius: BorderRadius.circular(10)),
          child: Text(
            sousTypeLabel,
            style: GoogleFonts.poppins(
                fontSize: 11,
                color: Colors.indigo,
                fontWeight: FontWeight.w600),
          ),
        ),
        if (url.isNotEmpty) ...[
          const SizedBox(height: 8),
          GestureDetector(
            onTap: () async {
              final uri = Uri.parse(url);
              await launchUrl(uri, mode: LaunchMode.externalApplication);
            },
            child: Text(
              url,
              style: GoogleFonts.poppins(
                  fontSize: 13,
                  color: Colors.blue,
                  decoration: TextDecoration.underline),
              maxLines: 1,
              overflow: TextOverflow.ellipsis,
            ),
          ),
        ],
        const SizedBox(height: 10),
        Row(
          children: [
            _buildStatItem(FontAwesomeIcons.eye,
                promotion.nombreImpression, "Impressions"),
            const SizedBox(width: 20),
            _buildStatItem(FontAwesomeIcons.handPointer,
                promotion.nombreDeVues, "Vues"),
          ],
        ),
      ],
    );
  }

  void _showHistoriqueModal(BuildContext context, List<MotifRefus> motifs) {
    showModalBottomSheet(
      context: context,
      shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.vertical(top: Radius.circular(16))),
      builder: (ctx) => Column(
        mainAxisSize: MainAxisSize.min,
        children: [
          Padding(
            padding: const EdgeInsets.all(16.0),
            child: Text(
              (langUserPhone == "fr") ? "Historique des refus" : "Rejection history",
              style: GoogleFonts.poppins(
                  fontSize: 16, fontWeight: FontWeight.bold),
            ),
          ),
          Divider(height: 1),
          Flexible(
            child: ListView.builder(
              shrinkWrap: true,
              itemCount: motifs.length,
              itemBuilder: (_, i) => ListTile(
                title: Text(
                  motifs[i].dateRefus,
                  style: GoogleFonts.poppins(fontWeight: FontWeight.bold, fontSize: 13),
                ),
                subtitle: Text(
                  motifs[i].motif,
                  style: GoogleFonts.poppins(fontSize: 13),
                ),
              ),
            ),
          ),
          SizedBox(height: 12),
        ],
      ),
    );
  }

  Widget _buildRejectedContent(Promotion promotion) {
    bool canEdit = promotion.typePromotionAffaire == "produit_service";
    String infoText = canEdit
        ? (langUserPhone == "fr")
            ? "Tenez compte du motif de refus pour modifier votre promotion. Merci..."
            : "Please take the rejection reason into account when modifying your promotion. Thank you..."
        : (langUserPhone == "fr")
            ? "Tenez compte du motif de refus pour soumettre une nouvelle promotion. Merci..."
            : "Please take the rejection reason into account when submitting a new promotion. Thank you...";

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
              FaIcon(FontAwesomeIcons.triangleExclamation,
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
          if (promotion.motifsRefus.length > 1) ...[
            SizedBox(height: 4),
            TextButton(
              style: TextButton.styleFrom(
                  padding: EdgeInsets.zero,
                  tapTargetSize: MaterialTapTargetSize.shrinkWrap),
              onPressed: () => _showHistoriqueModal(
                  context,
                  promotion.motifsRefus.sublist(1)),
              child: Text(
                (langUserPhone == "fr")
                    ? "Voir les refus précédents (${promotion.motifsRefus.length - 1})"
                    : "See previous rejections (${promotion.motifsRefus.length - 1})",
                style: GoogleFonts.poppins(
                    fontSize: 12, color: Colors.red[400]),
              ),
            ),
          ],
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

    // Renouvellement pour sites_applications expirées
    final bool isExpired = promotion.status.toLowerCase().contains("expir");
    final bool canRenew = promotion.typePromotionAffaire == "sites_applications" &&
        isExpired;

    return Row(
      mainAxisAlignment: MainAxisAlignment.end,
      children: [
        if (canRenew) ...[
          ElevatedButton.icon(
            onPressed: () => _showRenewSiteAppModal(context, promotion),
            icon: const FaIcon(FontAwesomeIcons.rotateRight, size: 16),
            label: Text(
                (langUserPhone == "fr") ? 'Renouveler' : 'Renew'),
            style: ElevatedButton.styleFrom(
                backgroundColor: Colors.indigo,
                foregroundColor: Colors.white,
                shape: const StadiumBorder()),
          ),
          const SizedBox(width: 8),
        ],
        if (canPay) ...[
          ElevatedButton.icon(
            onPressed: () => Navigator.push(
                context,
                MaterialPageRoute(
                    builder: (context) =>
                        PaymentPayantPage(promotion: promotion))),
            icon: FaIcon(FontAwesomeIcons.moneyCheckDollar, size: 16),
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
            icon: FaIcon(FontAwesomeIcons.pen, size: 16),
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

  void _showRenewSiteAppModal(BuildContext context, Promotion promotion) {
    final Map<String, dynamic> info = promotion.annotherInfo.isNotEmpty
        ? jsonDecode(promotion.annotherInfo) as Map<String, dynamic>
        : {};
    final String nom = info['nom'] ?? info['nomSiteApp'] ?? "";
    final String sousType =
        info['sousType'] ?? info['sousTypeSiteApp'] ?? "site_web";
    final String url = info['url'] ?? info['urlSiteApp'] ?? "";

    String sousTypeLabel;
    if (sousType == "app_mobile") {
      sousTypeLabel = langUserPhone == "fr" ? "App mobile" : "Mobile app";
    } else if (sousType == "logiciel_desktop") {
      sousTypeLabel = langUserPhone == "fr" ? "Logiciel" : "Software";
    } else {
      sousTypeLabel = langUserPhone == "fr" ? "Site web" : "Website";
    }

    showModalBottomSheet(
      context: context,
      isScrollControlled: true,
      shape: const RoundedRectangleBorder(
          borderRadius: BorderRadius.vertical(top: Radius.circular(20))),
      builder: (ctx) => _RenewSiteAppSheet(
        promotion: promotion,
        nom: nom,
        sousTypeLabel: sousTypeLabel,
        url: url,
        description: promotion.description,
      ),
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
          FaIcon(icon, color: Colors.white, size: 10),
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
        FaIcon(icon, color: Colors.grey[600], size: 18),
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
            color: Colors.white,
            fontWeight: FontWeight.w400,
            fontSize: 18,
          ),
        ),
        leading: IconButton(
          onPressed: () {
            Navigator.pop(context);
          },
          icon: const FaIcon(FontAwesomeIcons.chevronLeft, color: Colors.white),
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
            icon: const FaIcon(
              FontAwesomeIcons.bars,
              color: Colors.white,
              size: 20,
            ),
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
          ? const Center(child: CircularProgressIndicator(color: primaryColor))
          : _promotions.isEmpty
              ? Center(
                  child: Text(
                    (langUserPhone == "fr")
                        ? "Aucune promotion affaire trouvée."
                        : "No deal promotions found.",
                    style: GoogleFonts.poppins(fontSize: 16),
                  ),
                )
              : RefreshIndicator(
                  onRefresh: fetchPromotions,
                  color: primaryColor,
                  child: ListView.builder(
                    physics: const BouncingScrollPhysics(
                        parent: AlwaysScrollableScrollPhysics()),
                    cacheExtent: 500,
                    padding:
                        const EdgeInsets.symmetric(horizontal: 10, vertical: 4),
                    itemCount: _promotions.length,
                    itemBuilder: (BuildContext context, int index) {
                      return RepaintBoundary(
                          child: _buildPromotionCard(_promotions[index]));
                    },
                  ),
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
    final Map<String, dynamic> infoMap = (promotion.annotherInfo != "")
        ? jsonDecode(promotion.annotherInfo)
        : {};

    return Scaffold(
      appBar: AppBar(
        backgroundColor: primaryColor,
        foregroundColor: Colors.white,
        title: Text(
          (langUserPhone == "fr") ? 'Détails' : 'Details',
          style: GoogleFonts.poppins(
            color: Colors.white,
            fontWeight: FontWeight.w400,
            fontSize: 18,
          ),
        ),
        leading: IconButton(
          onPressed: () {
            Navigator.pop(context);
          },
          icon: const FaIcon(
            FontAwesomeIcons.chevronLeft,
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
              errorWidget: (context, url, error) => AspectRatio(
                  aspectRatio: 16 / 9,
                  child: FaIcon(FontAwesomeIcons.circleExclamation)),
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
                      icon: FontAwesomeIcons.calendar,
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
                      icon: FontAwesomeIcons.chartSimple,
                      title: (langUserPhone == "fr")
                          ? "Statistiques"
                          : "Statistics"),
                  _buildDetailRow("Impressions", promotion.nombreImpression),
                  _buildDetailRow((langUserPhone == "fr") ? "Vues" : "Views",
                      promotion.nombreDeVues),
                  SizedBox(height: 25),

                  // Section Description
                  _buildSectionTitle(
                      icon: FontAwesomeIcons.solidFileLines,
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
                        icon: FontAwesomeIcons.circleInfo,
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
          FaIcon(icon, color: primaryColor, size: 20),
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
  int _rewardBudget = 0;
  bool _isCustomRewardBudget = false;
  String? _rewardBudgetError;
  final _customRewardBudgetController = TextEditingController();

  bool _publishOnDressurStatus = false;
  final int _dressurStatusPricePer7Days = 5000;

  bool _boostFacebook = false;
  final _boostFacebookAmountController = TextEditingController(text: '700');

  // --- CALCULS DYNAMIQUES ---
  double get _rewardProgramAmount {
    if (!_participateInReward || _rewardBudget == 0) return 0.0;
    return _rewardBudget.toDouble();
  }

  String get _rewardBudgetRequiredMessage => langUserPhone == "fr"
      ? "Veuillez saisir un montant personnalisé."
      : "Please enter a custom amount.";

  String get _rewardBudgetIntegerMessage => langUserPhone == "fr"
      ? "Veuillez saisir uniquement un nombre entier."
      : "Please enter a whole number only.";

  String get _rewardBudgetMinimumMessage => langUserPhone == "fr"
      ? "Le montant doit être supérieur à 5 000 FCFA."
      : "The amount must be greater than 5,000 FCFA.";

  String get _rewardBudgetSelectionMessage => langUserPhone == "fr"
      ? "Veuillez choisir un budget de récompense valide."
      : "Please choose a valid reward budget.";

  void _onCustomRewardBudgetChanged(String value) {
    final amountText = value.trim();
    int? amount;
    String? error;

    if (amountText.isEmpty) {
      error = _rewardBudgetRequiredMessage;
    } else if (!RegExp(r'^\d+$').hasMatch(amountText)) {
      error = _rewardBudgetIntegerMessage;
    } else {
      amount = int.tryParse(amountText);
      if (amount == null) {
        error = _rewardBudgetIntegerMessage;
      } else if (amount <= 5000) {
        error = _rewardBudgetMinimumMessage;
      }
    }

    setState(() {
      _rewardBudget = error == null ? amount! : 0;
      _rewardBudgetError = error;
    });
  }

  bool _validateRewardBudget() {
    if (!_participateInReward) {
      _rewardBudget = 0;
      _rewardBudgetError = null;
      return true;
    }

    if (_isCustomRewardBudget) {
      final amountText = _customRewardBudgetController.text.trim();
      final amount = int.tryParse(amountText);
      String? error;

      if (amountText.isEmpty) {
        error = _rewardBudgetRequiredMessage;
      } else if (!RegExp(r'^\d+$').hasMatch(amountText) || amount == null) {
        error = _rewardBudgetIntegerMessage;
      } else if (amount <= 5000) {
        error = _rewardBudgetMinimumMessage;
      }

      if (error != null) {
        setState(() {
          _rewardBudget = 0;
          _rewardBudgetError = error;
        });
        dangerNoti("Attention !!!", error, context);
        return false;
      }

      setState(() {
        _rewardBudget = amount!;
        _rewardBudgetError = null;
      });
      return true;
    }

    const predefinedBudgets = [500, 1000, 2000, 5000];
    if (!predefinedBudgets.contains(_rewardBudget)) {
      setState(() => _rewardBudgetError = _rewardBudgetSelectionMessage);
      dangerNoti("Attention !!!", _rewardBudgetSelectionMessage, context);
      return false;
    }

    return true;
  }

  double get _dressurStatusAmount {
    if (!_publishOnDressurStatus || jours == 0) return 0.0;
    return (jours * _dressurStatusPricePer7Days) / 7;
  }

  double get _boostFacebookAmount {
    if (!_boostFacebook) return 0.0;
    return (int.tryParse(_boostFacebookAmountController.text) ?? 0).toDouble();
  }

  double get _subTotal =>
      prix.toDouble() + _rewardProgramAmount + _dressurStatusAmount + _boostFacebookAmount;
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

      if (!_validateRewardBudget()) {
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

          'idFormulBoost': idFormulBoost.toString(),
          'valueMethodePaiement': valueMethodePaiement,
          'tel': telController.text,
          // Nouvelles options
          'inProgrammeRecompense': _participateInReward ? "1" : "0",
          'rewardBudget': _participateInReward ? _rewardBudget.toString() : "0",
          'rewardBudgetType': _isCustomRewardBudget ? "custom" : "predefined",
          'publishOnDressurStatus': _publishOnDressurStatus ? "1" : "0",
          'boostFacebook': _boostFacebook ? "1" : "0",
          'montantBoostFacebook': _boostFacebookAmountController.text,
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
              _customRewardBudgetController.clear();
              // telController.text = tel;    // Optionnel : remettre le tel par défaut si besoin

              // 4. Réinitialisation des messages et labels
              _message = (langUserPhone == "fr")
                  ? "Veuillez choisir une formule."
                  : "Please choose a plan.";
              label = "";

              // 5. Réinitialisation des options spécifiques (Reward & Status & Boost Facebook)
              _participateInReward = false;
              _rewardBudget = 0;
              _isCustomRewardBudget = false;
              _rewardBudgetError = null;
              _publishOnDressurStatus = false;
              _boostFacebook = false;
              _boostFacebookAmountController.text = '700';

              // 6. Réinitialisation du mode de paiement par défaut
              valueMethodePaiement = "mtn";
            });

            if (data["solde_used"] == true) {
              successNoti(
                  (langUserPhone == "fr") ? "Succès" : "Success",
                  data["message"] ?? ((langUserPhone == "fr") ? "Solde débité. Votre Promotion Affaire est en attente de validation." : "Balance debited. Your Business Promotion is pending validation."),
                  context);
            } else if (data["direct"] == true) {
              successNoti(
                  (langUserPhone == "fr") ? "Succès" : "Success",
                  (langUserPhone == "fr")
                      ? "Veuillez confirmer le paiement. Votre promotion sera soumise à validation après confirmation."
                      : "Please confirm payment. Your promotion will be submitted for validation after confirmation.",
                  context);
            } else {
              launchPaiement(data["url"]);
              successNoti(
                  (langUserPhone == "fr") ? "Succès" : "Success",
                  (langUserPhone == "fr")
                      ? "Veuillez confirmer le paiement. Votre promotion sera soumise à validation après confirmation."
                      : "Please confirm payment. Your promotion will be submitted for validation after confirmation.",
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
  }

  @override
  void dispose() {
    telController.dispose();
    _customRewardBudgetController.dispose();
    _boostFacebookAmountController.dispose();
    super.dispose();
  }

  Widget _buildOptionHeader(IconData icon, String title, bool isActive) {
    return Row(
      children: [
        FaIcon(icon, color: isActive ? primaryColor : Colors.grey, size: 20),
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
        title: Text(
          (langUserPhone == "fr") ? 'Relancer la Promotion' : 'Relaunch Promotion',
          style: GoogleFonts.poppins(
            color: Colors.white,
            fontWeight: FontWeight.w400,
            fontSize: 18,
          ),
        ),
        leading: IconButton(
            onPressed: () => Navigator.pop(context),
            icon: const FaIcon(FontAwesomeIcons.chevronLeft,
                color: Colors.white)),
        backgroundColor: primaryColor,
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.stretch,
          children: [
            loading_formule_payant
                ? const Center(
                    child: CircularProgressIndicator(color: primaryColor))
                : SelectFormField(
                    decoration: InputDecoration(
                        labelText: (langUserPhone == "fr") ? 'Formule de Boost' : 'Boost Plan',
                        border: const OutlineInputBorder()),
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
            _buildOptionHeader(FontAwesomeIcons.star, (langUserPhone == "fr") ? "Programme de Récompense" : "Reward Program",
                _participateInReward),
            SwitchListTile(
              title: Text((langUserPhone == "fr") ? "Ajouter au programme" : "Add to program",
                  style: GoogleFonts.poppins(
                      fontSize: 14, fontWeight: FontWeight.w500)),
              subtitle: Text((langUserPhone == "fr") ? "Récompensez les partages statut WhatsApp." : "Reward WhatsApp status shares.",
                  style: GoogleFonts.poppins(fontSize: 11)),
              value: _participateInReward,
              activeColor: primaryColor,
              onChanged: (val) => setState(() {
                _participateInReward = val;
                _isCustomRewardBudget = false;
                _rewardBudget = val ? 500 : 0;
                _rewardBudgetError = null;
                _customRewardBudgetController.clear();
              }),
            ),
            if (_participateInReward) ...[
              Padding(
                padding: const EdgeInsets.symmetric(horizontal: 16),
                child: Column(
                  children: [
                    Text(
                      (langUserPhone == "fr")
                          ? "Choisissez votre budget récompenses"
                          : "Choose your reward budget",
                      style: GoogleFonts.poppins(
                          fontSize: 13, fontWeight: FontWeight.w500),
                    ),
                    const SizedBox(height: 10),
                    Wrap(
                      spacing: 8,
                      runSpacing: 8,
                      children: [
                        ...[500, 1000, 2000, 5000].map((budget) {
                          final selected =
                              !_isCustomRewardBudget && _rewardBudget == budget;
                          return GestureDetector(
                            onTap: () => setState(() {
                              _isCustomRewardBudget = false;
                              _rewardBudget = budget;
                              _rewardBudgetError = null;
                              _customRewardBudgetController.clear();
                            }),
                            child: Container(
                              padding: const EdgeInsets.symmetric(
                                  horizontal: 18, vertical: 10),
                              decoration: BoxDecoration(
                                color: selected
                                    ? primaryColor
                                    : Colors.transparent,
                                borderRadius: BorderRadius.circular(20),
                                border: Border.all(color: primaryColor),
                              ),
                              child: Text(
                                "${budget == 1000 ? '1 000' : budget == 2000 ? '2 000' : budget == 5000 ? '5 000' : budget} F",
                                style: GoogleFonts.poppins(
                                  fontSize: 13,
                                  fontWeight: FontWeight.w600,
                                  color: selected
                                      ? Colors.white
                                      : primaryColor,
                                ),
                              ),
                            ),
                          );
                        }),
                        GestureDetector(
                          onTap: () => setState(() {
                            _isCustomRewardBudget = true;
                            _rewardBudget = 0;
                            _rewardBudgetError =
                                _customRewardBudgetController.text.trim().isEmpty
                                    ? _rewardBudgetRequiredMessage
                                    : null;
                          }),
                          child: Container(
                            padding: const EdgeInsets.symmetric(
                                horizontal: 18, vertical: 10),
                            decoration: BoxDecoration(
                              color: _isCustomRewardBudget
                                  ? primaryColor
                                  : Colors.transparent,
                              borderRadius: BorderRadius.circular(20),
                              border: Border.all(color: primaryColor),
                            ),
                            child: Text(
                              langUserPhone == "fr" ? "Autre" : "Other",
                              style: GoogleFonts.poppins(
                                fontSize: 13,
                                fontWeight: FontWeight.w600,
                                color: _isCustomRewardBudget
                                    ? Colors.white
                                    : primaryColor,
                              ),
                            ),
                          ),
                        ),
                      ],
                    ),
                    if (_isCustomRewardBudget) ...[
                      const SizedBox(height: 12),
                      TextField(
                        controller: _customRewardBudgetController,
                        keyboardType: TextInputType.number,
                        inputFormatters: [
                          FilteringTextInputFormatter.digitsOnly,
                        ],
                        onChanged: _onCustomRewardBudgetChanged,
                        decoration: InputDecoration(
                          labelText: langUserPhone == "fr"
                              ? "Montant personnalisé"
                              : "Custom amount",
                          hintText: "Supérieur à 5 000 FCFA",
                          suffixText: "FCFA",
                          errorText: _rewardBudgetError,
                          border: const OutlineInputBorder(),
                        ),
                      ),
                    ],
                  ],
                ),
              ),
            ],

            const SizedBox(height: 15),

            // --- SECTION STATUT DRESSUR ---
            _buildOptionHeader(FontAwesomeIcons.solidCircleCheck,
                "Statut Dressur", _publishOnDressurStatus),
            SwitchListTile(
              title: Text((langUserPhone == "fr") ? "Publier sur le statut Dressur" : "Publish on Dressur status",
                  style: GoogleFonts.poppins(
                      fontSize: 14, fontWeight: FontWeight.w500)),
              subtitle: Text((langUserPhone == "fr") ? "Visibilité maximale sur notre statut officiel." : "Maximum visibility on our official status.",
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

            const SizedBox(height: 15),

            // --- SECTION BOOST PAGE FACEBOOK ---
            _buildOptionHeader(
                FontAwesomeIcons.facebookF,
                (langUserPhone == "fr")
                    ? "Boost Page Facebook Dressur"
                    : "Dressur Facebook Page Boost",
                _boostFacebook),
            SwitchListTile(
              title: Text(
                  (langUserPhone == "fr")
                      ? "Publier et booster sur la page Facebook de Dressur"
                      : "Post and boost on Dressur's Facebook page",
                  style: GoogleFonts.poppins(
                      fontSize: 14, fontWeight: FontWeight.w500)),
              subtitle: Text(
                  (langUserPhone == "fr")
                      ? "Votre promotion sera publiée sur la page Facebook officielle de Dressur et boostée auprès d'une audience ciblée. Budget minimum 700 FCFA."
                      : "Your promotion will be posted on Dressur's official Facebook page and boosted to a targeted audience. Minimum budget 700 FCFA.",
                  style: GoogleFonts.poppins(fontSize: 11)),
              value: _boostFacebook,
              activeColor: primaryColor,
              onChanged: (val) => setState(() => _boostFacebook = val),
            ),
            if (_boostFacebook) ...[
              Padding(
                padding: const EdgeInsets.symmetric(horizontal: 16),
                child: TextField(
                  controller: _boostFacebookAmountController,
                  keyboardType: TextInputType.number,
                  onChanged: (_) => setState(() {}),
                  decoration: InputDecoration(
                    labelText: (langUserPhone == "fr")
                        ? "Budget boost (min. 700 FCFA)"
                        : "Boost budget (min. 700 FCFA)",
                    border: const OutlineInputBorder(),
                    suffixText: "FCFA",
                  ),
                ),
              ),
            ],

            const SizedBox(height: 20),

            // --- RÉCAPITULATIF ---
            Container(
              padding: const EdgeInsets.all(15),
              decoration: BoxDecoration(
                  borderRadius: BorderRadius.circular(10),
                  border: Border.all(color: Colors.grey[300]!)),
              child: Column(
                children: [
                  _recapRow((langUserPhone == "fr") ? "Formule Boost" : "Boost Plan", prix.toDouble()),
                  if (_participateInReward)
                    _recapRow((langUserPhone == "fr") ? "Programme Récompense" : "Reward Program", _rewardProgramAmount),
                  if (_publishOnDressurStatus)
                    _recapRow("Statut Dressur", _dressurStatusAmount),
                  if (_boostFacebook)
                    _recapRow(
                        (langUserPhone == "fr") ? "Boost Facebook" : "Facebook Boost",
                        _boostFacebookAmount),
                  const Divider(height: 20),
                  _recapRow((langUserPhone == "fr") ? "TOTAL ESTIMÉ" : "ESTIMATED TOTAL", _totalWithMaxCommission,
                      isBold: true),
                ],
              ),
            ),

            const SizedBox(height: 20),
            SelectFormField(
              decoration: InputDecoration(
                  labelText: (langUserPhone == "fr") ? 'Moyen de paiement' : 'Payment method',
                  border: const OutlineInputBorder()),
              type: SelectFormFieldType.dropdown,
              initialValue: 'mtn',
              items: listeMethodePaiements,
              onChanged: (val) => setState(() => valueMethodePaiement = val),
            ),
            const SizedBox(height: 10),
            TextField(
                controller: telController,
                decoration: InputDecoration(
                    labelText: (langUserPhone == "fr") ? 'Numéro du paiement' : 'Payment number',
                    border: const OutlineInputBorder())),

            const SizedBox(height: 20),
            ElevatedButton(
              style: ElevatedButton.styleFrom(
                  backgroundColor: primaryColor,
                  shape: const StadiumBorder(),
                  padding: const EdgeInsets.symmetric(vertical: 15)),
              onPressed: _desactive2 ? null : newPromoPayant,
              child: Text(_desactive2 ? (langUserPhone == "fr" ? "Patientez..." : "Please wait...") : (langUserPhone == "fr" ? "Payer et Relancer" : "Pay and Relaunch"),
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

// ─────────────────────────────────────────────────────────────────────────────
// Modal renouvellement Sites & Applications
// ─────────────────────────────────────────────────────────────────────────────

class _RenewSiteAppSheet extends StatefulWidget {
  final Promotion promotion;
  final String nom;
  final String sousTypeLabel;
  final String url;
  final String description;

  const _RenewSiteAppSheet({
    required this.promotion,
    required this.nom,
    required this.sousTypeLabel,
    required this.url,
    required this.description,
  });

  @override
  State<_RenewSiteAppSheet> createState() => _RenewSiteAppSheetState();
}

class _RenewSiteAppSheetState extends State<_RenewSiteAppSheet> {
  bool _isSending = false;
  String _valueMethodePaiement = 'mtn';
  bool _loadingPaiements = false;
  final _telController = TextEditingController(text: tel);

  @override
  void initState() {
    super.initState();
    _loadMethodesPaiement();
  }

  @override
  void dispose() {
    _telController.dispose();
    super.dispose();
  }

  Future<void> _loadMethodesPaiement() async {
    if (listeMethodePaiements.isNotEmpty) {
      setState(() => _valueMethodePaiement = listeMethodePaiements[0]['value']);
      return;
    }
    setState(() => _loadingPaiements = true);
    try {
      final response = await http
          .post(Uri.parse('$generalRouteForApi/listeFormulePromoAffaire'));
      if (response.statusCode == 200) {
        final data = jsonDecode(response.body);
        if (data["error"] == false) {
          setState(() {
            listeMethodePaiements = List<Map<String, dynamic>>.from(
                data["listeMethodePaiements"]);
            if (listeMethodePaiements.isNotEmpty) {
              _valueMethodePaiement = listeMethodePaiements[0]['value'];
            }
          });
        }
      }
    } catch (_) {}
    if (mounted) setState(() => _loadingPaiements = false);
  }

  Future<void> _submit() async {
    if (!telIsVerified) {
      showConfNumeroWhatsapp(context);
      return;
    }
    setState(() => _isSending = true);

    try {
      final request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/newPromoPayant'));
      request.fields.addAll({
        'uid': uidUser,
        'idPromotion': widget.promotion.id,
        'totalAmount': '7750',
        'valueMethodePaiement': _valueMethodePaiement,
        'tel': _telController.text,
        'typeRelance': 'renouv_site_app',
      });

      final response = await request.send();
      if (!mounted) return;

      if (response.statusCode == 200) {
        final data = jsonDecode(await response.stream.bytesToString());
        if (!mounted) return;
        if (data["error"] == false) {
          Navigator.pop(context);
          if (data["solde_used"] == true) {
            successNoti(
                (langUserPhone == "fr") ? "Succès" : "Success",
                data["message"] ??
                    ((langUserPhone == "fr")
                        ? "Renouvellement en attente de validation par notre équipe."
                        : "Renewal pending validation by our team."),
                context);
          } else if (data["direct"] == true) {
            successNoti(
                (langUserPhone == "fr") ? "Succès" : "Success",
                (langUserPhone == "fr")
                    ? "Renouvellement en attente de validation par notre équipe."
                    : "Renewal pending validation by our team.",
                context);
          } else {
            launchPaiement(data["url"]);
            successNoti(
                (langUserPhone == "fr") ? "Succès" : "Success",
                (langUserPhone == "fr")
                    ? "Renouvellement en attente de validation par notre équipe."
                    : "Renewal pending validation by our team.",
                context);
          }
        } else {
          dangerNoti(data["titre"], data["message"], context);
          setState(() => _isSending = false);
        }
      } else {
        dangerNoti(
            (langUserPhone == "fr") ? "Erreur" : "Error",
            'Code : ${response.statusCode}',
            context);
        setState(() => _isSending = false);
      }
    } catch (e) {
      dangerNoti("Erreur", e.toString(), context);
      setState(() => _isSending = false);
    }
  }

  @override
  Widget build(BuildContext context) {
    final isFr = langUserPhone == "fr";
    return Padding(
      padding:
          EdgeInsets.only(bottom: MediaQuery.of(context).viewInsets.bottom),
      child: SingleChildScrollView(
        padding: const EdgeInsets.fromLTRB(20, 20, 20, 30),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.stretch,
          mainAxisSize: MainAxisSize.min,
          children: [
            // Barre de drag
            Center(
              child: Container(
                width: 40,
                height: 5,
                decoration: BoxDecoration(
                    color: Colors.grey[300],
                    borderRadius: BorderRadius.circular(10)),
              ),
            ),
            const SizedBox(height: 16),
            Text(
              isFr ? "Renouveler la promotion" : "Renew promotion",
              style: GoogleFonts.poppins(
                  fontSize: 18, fontWeight: FontWeight.bold),
              textAlign: TextAlign.center,
            ),
            const SizedBox(height: 16),

            // Aperçu des infos actuelles (non modifiables)
            Container(
              padding: const EdgeInsets.all(14),
              decoration: BoxDecoration(
                color: Colors.grey[100],
                borderRadius: BorderRadius.circular(10),
                border: Border.all(color: Colors.grey[300]!),
              ),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  // Image de la promotion
                  ClipRRect(
                    borderRadius: BorderRadius.circular(8),
                    child: CachedNetworkImage(
                      imageUrl: widget.promotion.image,
                      height: 120,
                      width: double.infinity,
                      fit: BoxFit.cover,
                      placeholder: (ctx, u) =>
                          Container(height: 120, color: Colors.grey[200]),
                      errorWidget: (ctx, u, e) =>
                          Container(height: 120, color: Colors.grey[200]),
                    ),
                  ),
                  const SizedBox(height: 10),
                  if (widget.nom.isNotEmpty)
                    Text(widget.nom,
                        style: GoogleFonts.poppins(
                            fontWeight: FontWeight.bold, fontSize: 15)),
                  const SizedBox(height: 6),
                  Container(
                    padding: const EdgeInsets.symmetric(
                        horizontal: 8, vertical: 2),
                    decoration: BoxDecoration(
                        color: Colors.indigo.withOpacity(0.12),
                        borderRadius: BorderRadius.circular(10)),
                    child: Text(widget.sousTypeLabel,
                        style: GoogleFonts.poppins(
                            fontSize: 11,
                            color: Colors.indigo,
                            fontWeight: FontWeight.w600)),
                  ),
                  const SizedBox(height: 6),
                  if (widget.url.isNotEmpty)
                    Text(widget.url,
                        style: GoogleFonts.poppins(
                            fontSize: 12, color: Colors.grey[600]),
                        maxLines: 1,
                        overflow: TextOverflow.ellipsis),
                  if (widget.description.isNotEmpty) ...[
                    const SizedBox(height: 6),
                    Text(widget.description,
                        style: GoogleFonts.poppins(
                            fontSize: 13, color: Colors.grey[700]),
                        maxLines: 3,
                        overflow: TextOverflow.ellipsis),
                  ],
                ],
              ),
            ),
            const SizedBox(height: 16),

            // Prix fixe
            Container(
              padding: const EdgeInsets.all(12),
              decoration: BoxDecoration(
                color: primaryColor.withOpacity(0.08),
                borderRadius: BorderRadius.circular(8),
                border: Border.all(color: primaryColor.withOpacity(0.3)),
              ),
              child: Text(
                isFr ? "Prix : 7 750 FCFA / an" : "Price: 7,750 FCFA / year",
                style: GoogleFonts.poppins(
                    color: primaryColor,
                    fontWeight: FontWeight.bold,
                    fontSize: 15),
                textAlign: TextAlign.center,
              ),
            ),
            const SizedBox(height: 14),

            // Méthode de paiement
            _loadingPaiements
                ? const Center(
                    child: CircularProgressIndicator(color: primaryColor))
                : listeMethodePaiements.isNotEmpty
                    ? SelectFormField(
                        decoration: InputDecoration(
                            labelText:
                                isFr ? 'Moyen de paiement' : 'Payment method',
                            border: const OutlineInputBorder()),
                        type: SelectFormFieldType.dropdown,
                        initialValue: _valueMethodePaiement,
                        items: listeMethodePaiements,
                        onChanged: (val) =>
                            setState(() => _valueMethodePaiement = val),
                      )
                    : const SizedBox.shrink(),
            const SizedBox(height: 10),

            // Numéro de paiement
            TextField(
              controller: _telController,
              keyboardType: TextInputType.phone,
              decoration: InputDecoration(
                  labelText: isFr ? 'Numéro du paiement' : 'Payment number',
                  border: const OutlineInputBorder()),
            ),
            const SizedBox(height: 16),

            // Bouton soumettre
            ElevatedButton(
              onPressed: _isSending ? null : _submit,
              style: ElevatedButton.styleFrom(
                  backgroundColor: primaryColor,
                  shape: const StadiumBorder(),
                  padding: const EdgeInsets.symmetric(vertical: 15)),
              child: _isSending
                  ? const CircularProgressIndicator(color: Colors.white)
                  : Text(
                      isFr ? 'Renouveler et Payer' : 'Renew & Pay',
                      style: GoogleFonts.poppins(
                          color: Colors.white, fontWeight: FontWeight.bold)),
            ),
          ],
        ),
      ),
    );
  }
}
