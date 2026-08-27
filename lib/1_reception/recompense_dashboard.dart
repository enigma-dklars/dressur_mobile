// ignore_for_file: prefer_const_constructors, prefer_const_literals_to_create_immutables

import 'dart:async';
import 'dart:convert';
import 'dart:io';
import 'package:cached_network_image/cached_network_image.dart';
import 'package:dressur/1_reception/historique_recompense_complet.dart';
import 'package:dressur/components/app_theme.dart';
import 'package:dressur/components/feature_sections.dart';
import 'package:dressur/components/noti.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;
import 'package:dressur/1_reception/business_promotions_page.dart';
import 'package:dressur/1_reception/recompense_start.dart';
import 'package:flutter/material.dart';
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
        Uri.parse('$generalRouteForApi/getMyProgrammeRecompenseInformations'),
      );
      request.fields.addAll({'uid': uidUser});

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
            soldeDressur = data["soldeDisponible"];
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
    final bool isFr = langUserPhone == "fr";

    return Scaffold(
      appBar: AppBar(
        backgroundColor: primaryColor,
        elevation: 0,
        title: Text(
          isFr ? "Mon Programme" : "My Program",
          style: theme.textTheme.titleMedium?.copyWith(
            color: Colors.white,
            fontWeight: FontWeight.w400,
          ),
        ),
        leading: IconButton(
          icon: FaIcon(
            FontAwesomeIcons.chevronLeft,
            color: Colors.white,
            size: 20,
          ),
          onPressed: () => Navigator.pop(context),
        ),
      ),
      body: SingleChildScrollView(
        physics: BouncingScrollPhysics(),
        padding: const EdgeInsets.symmetric(
          horizontal: AppSpacing.xLarge,
          vertical: AppSpacing.xLarge,
        ),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            // ── Statistiques ─────────────────────────────────────────────
            _sectionTitle(
              context,
              isFr ? "Mes Statistiques" : "My Statistics",
              12,
            ),
            Row(
              children: [
                _statItem(
                  context,
                  isFr ? "Vues Totales" : "Total Views",
                  "$vuesTotales",
                  FontAwesomeIcons.eye,
                  Colors.blue,
                  theme,
                ),
                SizedBox(width: AppSpacing.medium),
                _statItem(
                  context,
                  isFr ? "Gains Totaux" : "Total Earnings",
                  "$gainsTotales F",
                  FontAwesomeIcons.wallet,
                  Colors.green,
                  theme,
                ),
              ],
            ),

            SizedBox(height: AppSpacing.section),

            // ── Historique de participation ───────────────────────────────
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                _sectionTitle(
                  context,
                  isFr
                      ? "Historique de participation"
                      : "Participation history",
                  0,
                ),
                TextButton(
                  onPressed: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(
                        builder: (context) =>
                            HistoriqueCompletPage(allHistorique: allHistorique),
                      ),
                    );
                  },
                  child: Text(
                    isFr ? "Voir tout" : "See all",
                    style: theme.textTheme.labelMedium?.copyWith(
                      color: primaryColor,
                    ),
                  ),
                ),
              ],
            ),
            Padding(
              padding: const EdgeInsets.only(bottom: AppSpacing.medium),
              child: Text(
                isFr
                    ? "Sélectionnez un historique pour voir les options possibles…"
                    : "Select a history entry to see available options…",
                style: theme.textTheme.bodySmall?.copyWith(
                  color: theme.colorScheme.onSurfaceVariant,
                ),
              ),
            ),
            FutureBuilder<List<HistoriqueRecompense>>(
              future: _futureHistoriqueRecompense,
              builder: (context, snapshot) {
                if (snapshot.connectionState == ConnectionState.waiting) {
                  return const Padding(
                    padding: EdgeInsets.symmetric(vertical: AppSpacing.section),
                    child: Center(
                      child: CircularProgressIndicator(color: primaryColor),
                    ),
                  );
                }

                if (snapshot.hasError) {
                  return FeatureInfoCard(
                    margin: EdgeInsets.zero,
                    padding: const EdgeInsets.all(AppSpacing.medium),
                    child: FeatureBulletRow(
                      text: isFr ? "Erreur de chargement" : "Loading error",
                      icon: FontAwesomeIcons.triangleExclamation,
                      color: theme.colorScheme.error,
                      padding: EdgeInsets.zero,
                    ),
                  );
                }

                if (!snapshot.hasData || snapshot.data!.isEmpty) {
                  return FeatureInfoCard(
                    margin: EdgeInsets.zero,
                    padding: const EdgeInsets.all(AppSpacing.medium),
                    child: Center(
                      child: Text(
                        isFr
                            ? "Aucun historique disponible"
                            : "No history available",
                        textAlign: TextAlign.center,
                        style: theme.textTheme.bodySmall?.copyWith(
                          color: theme.colorScheme.onSurfaceVariant,
                        ),
                      ),
                    ),
                  );
                }

                return ListView.builder(
                  itemCount: snapshot.data!.length,
                  shrinkWrap: true,
                  physics: const NeverScrollableScrollPhysics(),
                  itemBuilder: (context, index) {
                    final item = snapshot.data![index];
                    return _promotionItem(context, item, isFr);
                  },
                );
              },
            ),

            SizedBox(height: AppSpacing.section),

            // ── Actions secondaires ───────────────────────────────────────
            _sectionTitle(context, isFr ? "Programme" : "Program", 12),
            _buildBusinessPromotionsButton(context, theme, isFr),
            SizedBox(height: AppSpacing.small),
            _buildAccessProgramButton(context, theme, isFr),

            SizedBox(height: AppSpacing.large),
          ],
        ),
      ),
    );
  }

  // ---------------------------------------------------------------------------
  // COMPOSANTS
  // ---------------------------------------------------------------------------

  Widget _buildAccessProgramButton(
    BuildContext context,
    ThemeData theme,
    bool isFr,
  ) {
    return InkWell(
      onTap: () {
        Navigator.push(
          context,
          MaterialPageRoute(
            builder: (context) => ProgrammeRecompensePage(optionPage: true),
          ),
        );
      },
      child: FeatureInfoCard(
        margin: EdgeInsets.zero,
        padding: const EdgeInsets.all(AppSpacing.medium),
        child: Row(
          children: [
            FaIcon(FontAwesomeIcons.circleInfo, color: primaryColor),
            SizedBox(width: AppSpacing.small),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    isFr ? "Conditions du programme" : "Program conditions",
                    style: theme.textTheme.titleSmall?.copyWith(
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  SizedBox(height: AppSpacing.xSmall),
                  Text(
                    isFr
                        ? "Relire les conditions ou quitter le programme"
                        : "Review conditions or leave the program",
                    style: theme.textTheme.bodySmall?.copyWith(
                      color: theme.colorScheme.onSurfaceVariant,
                    ),
                  ),
                ],
              ),
            ),
            FaIcon(
              FontAwesomeIcons.chevronRight,
              size: 14,
              color: theme.colorScheme.primary,
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildBusinessPromotionsButton(
    BuildContext context,
    theme,
    bool isFr,
  ) {
    return InkWell(
      onTap: () {
        Navigator.push(
          context,
          MaterialPageRoute(builder: (context) => BusinessPromotionsPage()),
        );
      },
      child: FeatureInfoCard(
        margin: EdgeInsets.zero,
        padding: const EdgeInsets.all(AppSpacing.medium),
        child: Row(
          children: [
            FaIcon(FontAwesomeIcons.briefcase, color: primaryColor),
            SizedBox(width: AppSpacing.small),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    isFr
                        ? "Explorer les promotions affaires"
                        : "Explore business promotions",
                    style: theme.textTheme.titleSmall?.copyWith(
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  SizedBox(height: AppSpacing.xSmall),
                  Text(
                    isFr
                        ? "Découvrez les offres du programme de récompenses"
                        : "Discover the rewards program offers",
                    style: theme.textTheme.bodySmall?.copyWith(
                      color: theme.colorScheme.onSurfaceVariant,
                    ),
                  ),
                ],
              ),
            ),
            FaIcon(
              FontAwesomeIcons.chevronRight,
              size: 14,
              color: theme.colorScheme.primary,
            ),
          ],
        ),
      ),
    );
  }

  Widget _statItem(
    BuildContext context,
    String label,
    String value,
    IconData icon,
    Color color,
    ThemeData theme,
  ) {
    return Expanded(
      child: FeatureInfoCard(
        margin: EdgeInsets.zero,
        padding: const EdgeInsets.all(AppSpacing.large),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            FaIcon(icon, color: color, size: 24),
            SizedBox(height: AppSpacing.medium),
            Text(
              value,
              style: theme.textTheme.headlineSmall?.copyWith(
                fontWeight: FontWeight.bold,
              ),
            ),
            Text(
              label,
              style: theme.textTheme.bodySmall?.copyWith(
                color: theme.colorScheme.onSurfaceVariant,
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _sectionTitle(
    BuildContext context,
    String title,
    double padingBottom,
  ) {
    return FeatureSectionTitle(
      title: title,
      padding: EdgeInsets.only(top: AppSpacing.small, bottom: padingBottom),
    );
  }

  Widget _promotionItem(
    BuildContext context,
    HistoriqueRecompense item,
    bool isFr,
  ) {
    final theme = Theme.of(context);
    final statusConfig = getStatusBadgeConfig(item.status);
    final statusColor = statusConfig["color"] as Color;
    final statusIcon = statusConfig["icon"] as IconData;
    final statusLabel = statusConfig["label"] as String;

    return InkWell(
      onTap: () => _showStatusDetailsBottomSheet(context, item),
      onDoubleTap: () => _showStatusDetailsBottomSheet(context, item),
      onLongPress: () => _showStatusDetailsBottomSheet(context, item),
      child: FeatureInfoCard(
        padding: const EdgeInsets.all(AppSpacing.medium),
        margin: const EdgeInsets.only(bottom: AppSpacing.small),
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
                  ClipRRect(
                    borderRadius: BorderRadius.circular(12),
                    child: CachedNetworkImage(
                      imageUrl: item.imageUrl,
                      width: 55,
                      height: 55,
                      fit: BoxFit.cover,
                      placeholder: (context, url) => Image.asset(
                        'images/placeholder.png',
                        fit: BoxFit.cover,
                      ),
                      errorWidget: (context, url, error) => Image.asset(
                        'images/error_image.png',
                        fit: BoxFit.cover,
                      ),
                    ),
                  ),
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
                      child: FaIcon(
                        (item.status == "approuver")
                            ? FontAwesomeIcons.solidCircleCheck
                            : (item.status == "echouer" ||
                                  item.status == "refuser")
                            ? FontAwesomeIcons.xmark
                            : (item.status == "en_attente")
                            ? FontAwesomeIcons.clock
                            : FontAwesomeIcons.circleQuestion,
                        color: Colors.white,
                        size: 10,
                      ),
                    ),
                  ),
                ],
              ),
            ),
            const SizedBox(width: 10),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    item.title,
                    style: theme.textTheme.bodyLarge?.copyWith(
                      fontWeight: FontWeight.w600,
                    ),
                    maxLines: 1,
                    overflow: TextOverflow.ellipsis,
                  ),
                  const SizedBox(height: 10),
                  Row(
                    children: [
                      Flexible(
                        child: Text(
                          item.date,
                          maxLines: 1,
                          overflow: TextOverflow.ellipsis,
                          style: theme.textTheme.bodySmall?.copyWith(
                            color: theme.colorScheme.onSurfaceVariant,
                          ),
                        ),
                      ),
                      const SizedBox(width: AppSpacing.small),
                      Container(
                        width: 3,
                        height: 3,
                        decoration: const BoxDecoration(
                          color: Colors.grey,
                          shape: BoxShape.circle,
                        ),
                      ),
                      const SizedBox(width: AppSpacing.small),
                      const FaIcon(
                        FontAwesomeIcons.eye,
                        size: 12,
                        color: Colors.grey,
                      ),
                      const SizedBox(width: AppSpacing.xSmall),
                      Flexible(
                        child: Text(
                          item.views,
                          maxLines: 1,
                          overflow: TextOverflow.ellipsis,
                          style: theme.textTheme.bodySmall?.copyWith(
                            color: theme.colorScheme.onSurfaceVariant,
                          ),
                        ),
                      ),
                    ],
                  ),
                ],
              ),
            ),
            Flexible(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.end,
                children: [
                  Text(
                    item.amount,
                    maxLines: 1,
                    overflow: TextOverflow.ellipsis,
                    style: theme.textTheme.bodyMedium?.copyWith(
                      fontWeight: FontWeight.bold,
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
                  Chip(
                    avatar: Icon(statusIcon, size: 12, color: statusColor),
                    label: Text(
                      statusLabel,
                      maxLines: 1,
                      overflow: TextOverflow.ellipsis,
                      style: theme.textTheme.labelSmall?.copyWith(
                        fontWeight: FontWeight.bold,
                        color: statusColor,
                      ),
                    ),
                    backgroundColor: statusColor.withOpacity(0.15),
                    side: BorderSide.none,
                    visualDensity: VisualDensity.compact,
                    padding: EdgeInsets.zero,
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }

  void _showStatusDetailsBottomSheet(
    BuildContext context,
    HistoriqueRecompense item,
  ) {
    final bool isFr = langUserPhone == "fr";
    setState(() {
      _proofImage1 = null;
      _proofImage2 = null;
    });
    showModalBottomSheet(
      context: context,
      isScrollControlled: true,
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.vertical(
          top: Radius.circular(AppRadii.extraLarge),
        ),
      ),
      builder: (context) {
        return StatefulBuilder(
          builder: (context, setModalState) {
            return DraggableScrollableSheet(
              initialChildSize: 0.7,
              minChildSize: 0.4,
              maxChildSize: 0.95,
              expand: false,
              builder: (context, scrollController) {
                return SingleChildScrollView(
                  controller: scrollController,
                  padding: const EdgeInsets.all(AppSpacing.xLarge),
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
                      const SizedBox(height: AppSpacing.xLarge),
                      Text(
                        item.title,
                        style: Theme.of(context).textTheme.titleLarge?.copyWith(
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                      Text(
                        isFr
                            ? "Récompense : ${item.amount} FCFA"
                            : "Reward: ${item.amount} FCFA",
                        style: Theme.of(context).textTheme.bodyMedium?.copyWith(
                          color: primaryColor,
                          fontWeight: FontWeight.w500,
                        ),
                      ),
                      const Divider(height: AppSpacing.section),
                      _buildStatusContent(item, setModalState, isFr),
                      const SizedBox(height: AppSpacing.section),
                      if (item.status == "terminer" ||
                          item.status == "en_cours" ||
                          item.status == "en_attente")
                        _buildWhatsAppButton(isFr),
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
    HistoriqueRecompense item,
    StateSetter setModalState,
    bool isFr,
  ) {
    switch (item.status) {
      case "en_attente":
        return _statusInfo(
          FontAwesomeIcons.hourglassEmpty,
          Colors.orange,
          isFr ? "En attente d'approbation" : "Awaiting approval",
          isFr
              ? "Vous avez soumis vos preuves de participation. Notre équipe examine actuellement votre demande.\n\nSi vous ne l'avez pas encore fait, veuillez envoyer la capture vidéo comme dernière preuve par WhatsApp au numéro d'assistance de Dressur."
              : "You have submitted your participation proofs. Our team is currently reviewing your request.\n\nIf you haven't done so yet, please send the video capture as final proof via WhatsApp to Dressur's support number.",
        );
      case "terminer":
        return Column(
          children: [
            _statusInfo(
              FontAwesomeIcons.clock,
              Colors.green,
              isFr
                  ? "Temps écoulé - Soumission requise"
                  : "Time elapsed - Submission required",
              isFr
                  ? "Le temps de participation est terminé. Vous devez maintenant soumettre vos preuves (les deux captures d'écran) via le formulaire ci-dessous.\n\nNote : La capture vidéo doit être envoyée séparément par WhatsApp."
                  : "The participation time has ended. You must now submit your proofs (both screenshots) via the form below.\n\nNote: The video capture must be sent separately via WhatsApp.",
            ),
            const SizedBox(height: 20),
            _buildSubmissionForm(item, setModalState, isFr),
          ],
        );
      case "echouer":
        return _statusInfo(
          FontAwesomeIcons.circleExclamation,
          Colors.red,
          isFr ? "Participation échouée" : "Participation failed",
          isFr
              ? "Malheureusement, vous n'avez pas soumis vos preuves de participation dans les délais impartis. Il est désormais trop tard pour le faire pour cette promotion."
              : "Unfortunately, you did not submit your participation proofs within the required time. It is now too late to do so for this promotion.",
        );
      case "refuser":
        return _statusInfo(
          FontAwesomeIcons.slash,
          Colors.red,
          isFr ? "Preuves refusées" : "Proofs rejected",
          isFr
              ? "Les preuves que vous avez fournies n'ont pas été jugées recevables par notre équipe de modération. En conséquence, la récompense ne peut pas être accordée."
              : "The proofs you provided were not deemed acceptable by our moderation team. As a result, the reward cannot be granted.",
        );
      case "approuver":
        return _statusInfo(
          FontAwesomeIcons.solidCircleCheck,
          Colors.green,
          isFr ? "Félicitations ! Approuvé" : "Congratulations! Approved",
          isFr
              ? "Vos preuves de participation ont été vérifiées et validées. La récompense a été créditée sur votre solde Dressur."
              : "Your participation proofs have been verified and validated. The reward has been credited to your Dressur balance.",
        );
      case "en_cours":
        return Column(
          children: [
            _statusInfo(
              FontAwesomeIcons.arrowsRotate,
              Colors.blue,
              isFr ? "Participation en cours" : "Participation in progress",
              isFr
                  ? "Le temps de soumission n'est pas encore arrivé. Cependant, si vous estimez avoir déjà atteint votre objectif, vous pouvez soumettre vos preuves dès maintenant."
                  : "The submission time has not yet arrived. However, if you believe you have already reached your goal, you can submit your proofs now.",
            ),
            const SizedBox(height: 20),
            _buildSubmissionForm(item, setModalState, isFr),
          ],
        );
      default:
        return Text(isFr ? "Statut inconnu" : "Unknown status");
    }
  }

  Widget _statusInfo(
    IconData icon,
    Color color,
    String title,
    String description,
  ) {
    final theme = Theme.of(context);
    return FeatureInfoCard(
      color: color,
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              FaIcon(icon, color: color, size: 28),
              const SizedBox(width: AppSpacing.medium),
              Expanded(
                child: Text(
                  title,
                  style: theme.textTheme.titleMedium?.copyWith(
                    fontWeight: FontWeight.bold,
                    color: color,
                  ),
                ),
              ),
            ],
          ),
          const SizedBox(height: AppSpacing.large),
          Text(
            description,
            style: theme.textTheme.bodyMedium?.copyWith(
              color: theme.colorScheme.onSurfaceVariant,
              height: 1.5,
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildSubmissionForm(
    HistoriqueRecompense item,
    StateSetter setModalState,
    bool isFr,
  ) {
    return FeatureInfoCard(
      title: isFr ? "Formulaire de soumission" : "Submission form",
      padding: const EdgeInsets.all(AppSpacing.large),
      child: Column(
        children: [
          _proofCard(
            "1",
            isFr ? "Capture – Liste des statuts" : "Screenshot – Status list",
            isFr
                ? "• Affiche la liste des statuts WhatsApp\n• Le statut de la promotion doit être visible"
                : "• Shows the WhatsApp status list\n• The promotion status must be visible",
            _proofImage1,
            () => _pickImage(1, setModalState),
            isFr,
          ),
          const SizedBox(height: AppSpacing.large),
          _proofCard(
            "2",
            isFr ? "Capture – Statut ouvert" : "Screenshot – Open status",
            isFr
                ? "• Image complète\n• Texte descriptif complet\n• Nombre de vues, date et heure visibles"
                : "• Full image\n• Complete descriptive text\n• Number of views, date and time visible",
            _proofImage2,
            () => _pickImage(2, setModalState),
            isFr,
          ),
          const SizedBox(height: AppSpacing.xLarge),
          FeaturePrimaryButton(
            label: isFr ? "Soumettre les preuves" : "Submit proofs",
            isLoading: _isSubmitting,
            onPressed: _isSubmitting
                ? null
                : () => _submitProofs(item, setModalState, isFr),
          ),
        ],
      ),
    );
  }

  Widget _proofCard(
    String number,
    String title,
    String instructions,
    File? image,
    VoidCallback onTap,
    bool isFr,
  ) {
    final theme = Theme.of(context);
    return FeatureInfoCard(
      margin: const EdgeInsets.only(bottom: AppSpacing.medium),
      padding: const EdgeInsets.all(AppSpacing.medium),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              CircleAvatar(
                radius: 10,
                backgroundColor: primaryColor,
                child: Text(
                  number,
                  style: theme.textTheme.labelSmall?.copyWith(
                    color: Colors.white,
                  ),
                ),
              ),
              const SizedBox(width: AppSpacing.small),
              Expanded(
                child: Text(
                  title,
                  style: theme.textTheme.bodyMedium?.copyWith(
                    fontWeight: FontWeight.w600,
                  ),
                ),
              ),
            ],
          ),
          const SizedBox(height: AppSpacing.xSmall),
          Text(
            instructions,
            style: theme.textTheme.bodySmall?.copyWith(
              color: theme.colorScheme.onSurfaceVariant,
            ),
          ),
          const SizedBox(height: AppSpacing.small),
          InkWell(
            onTap: onTap,
            borderRadius: BorderRadius.circular(AppRadii.small),
            child: Container(
              height: 120,
              width: double.infinity,
              decoration: BoxDecoration(
                color: theme.colorScheme.surfaceContainerHighest.withOpacity(
                  0.35,
                ),
                borderRadius: BorderRadius.circular(AppRadii.small),
                border: Border.all(color: theme.colorScheme.outlineVariant),
                image: image != null
                    ? DecorationImage(
                        image: FileImage(image),
                        fit: BoxFit.cover,
                      )
                    : null,
              ),
              child: image == null
                  ? Column(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        FaIcon(
                          FontAwesomeIcons.camera,
                          color: primaryColor,
                          size: 30,
                        ),
                        const SizedBox(height: AppSpacing.xSmall),
                        Text(
                          isFr ? "Cliquez pour choisir" : "Tap to choose",
                          style: theme.textTheme.bodySmall?.copyWith(
                            color: theme.colorScheme.onSurfaceVariant,
                          ),
                        ),
                      ],
                    )
                  : Stack(
                      children: [
                        Positioned(
                          top: AppSpacing.xSmall,
                          right: AppSpacing.xSmall,
                          child: CircleAvatar(
                            radius: 12,
                            backgroundColor: Colors.black54,
                            child: FaIcon(
                              FontAwesomeIcons.pen,
                              size: 14,
                              color: Colors.white,
                            ),
                          ),
                        ),
                      ],
                    ),
            ),
          ),
        ],
      ),
    );
  }

  Future<void> _pickImage(int index, StateSetter setModalState) async {
    if (!mounted) return;
    final XFile? pickedFile = await _picker.pickImage(
      source: ImageSource.gallery,
      imageQuality: 80,
    );
    if (pickedFile != null) {
      setState(() {
        if (index == 1)
          _proofImage1 = File(pickedFile.path);
        else
          _proofImage2 = File(pickedFile.path);
      });
      setModalState(() {});
    }
  }

  Future<void> _submitProofs(
    HistoriqueRecompense item,
    StateSetter setModalState,
    bool isFr,
  ) async {
    if (_proofImage1 == null || _proofImage2 == null) {
      dangerNoti(
        isFr ? "Attention" : "Warning",
        isFr
            ? "Veuillez sélectionner les deux captures d'écran."
            : "Please select both screenshots.",
        context,
      );
      return;
    }

    setModalState(() => _isSubmitting = true);
    setState(() => _isSubmitting = true);

    try {
      var request = http.MultipartRequest(
        'POST',
        Uri.parse('$generalRouteForApi/submitProgrammeRecompenseProofs'),
      );

      request.fields['uid'] = uidUser;
      request.fields['idHistorique'] = item.id.toString();

      request.files.add(
        await http.MultipartFile.fromPath('capture1', _proofImage1!.path),
      );
      request.files.add(
        await http.MultipartFile.fromPath('capture2', _proofImage2!.path),
      );

      var response = await request.send();
      var responseData = await response.stream.bytesToString();
      var data = jsonDecode(responseData);

      if (response.statusCode == 200 && data['error'] == false) {
        Navigator.pop(context);
        successNoti(
          isFr ? "Succès" : "Success",
          data['message'] ??
              (isFr
                  ? "Preuves soumises avec succès !"
                  : "Proofs submitted successfully!"),
          context,
        );
        setState(() {
          _futureHistoriqueRecompense = partageInProgrammeRecompense();
        });
      } else {
        dangerNoti(
          isFr ? "Erreur" : "Error",
          data['message'] ??
              (isFr
                  ? "Une erreur est survenue lors de l'envoi."
                  : "An error occurred while sending."),
          context,
        );
      }
    } catch (e) {
      dangerNoti(
        isFr ? "Erreur" : "Error",
        isFr
            ? "Impossible de contacter le serveur."
            : "Unable to contact the server.",
        context,
      );
    } finally {
      setModalState(() => _isSubmitting = false);
      setState(() => _isSubmitting = false);
    }
  }

  Widget _buildWhatsAppButton(bool isFr) {
    final theme = Theme.of(context);
    return SizedBox(
      width: double.infinity,
      child: OutlinedButton.icon(
        onPressed: () async {
          final Uri _url = Uri.parse(whatsappDSURL);
          if (!await launchUrl(_url, mode: LaunchMode.externalApplication)) {}
        },
        icon: FaIcon(FontAwesomeIcons.solidComment, size: 18),
        label: Text(
          isFr ? "Envoyer la vidéo sur WhatsApp" : "Send video on WhatsApp",
        ),
        style: OutlinedButton.styleFrom(
          foregroundColor: Colors.green.shade700,
          side: BorderSide(color: Colors.green.shade600),
          padding: const EdgeInsets.symmetric(vertical: AppSpacing.medium),
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(AppRadii.large),
          ),
          textStyle: theme.textTheme.labelLarge?.copyWith(
            fontWeight: FontWeight.w600,
          ),
        ),
      ),
    );
  }

  Map<String, dynamic> getStatusBadgeConfig(String status) {
    final bool isFr = langUserPhone == "fr";
    switch (status) {
      case "en_attente":
        return {
          "label": isFr ? "Attente validation" : "Awaiting validation",
          "icon": FontAwesomeIcons.clock,
          "color": Colors.orange,
        };
      case "terminer":
        return {
          "label": isFr ? "Preuves requises" : "Proofs required",
          "icon": FontAwesomeIcons.solidCircleCheck,
          "color": Colors.green,
        };
      case "echouer":
        return {
          "label": isFr ? "Échoué" : "Failed",
          "icon": FontAwesomeIcons.xmark,
          "color": Colors.red,
        };
      case "refuser":
        return {
          "label": isFr ? "Refusé" : "Rejected",
          "icon": FontAwesomeIcons.xmark,
          "color": Colors.red,
        };
      case "approuver":
        return {
          "label": isFr ? "Approuvé" : "Approved",
          "icon": FontAwesomeIcons.solidCircleCheck,
          "color": Colors.green,
        };
      case "en_cours":
        return {
          "label": isFr ? "En cours" : "In progress",
          "icon": FontAwesomeIcons.arrowsRotate,
          "color": Colors.blue,
        };
      default:
        return {
          "label": isFr ? "Inconnu" : "Unknown",
          "icon": FontAwesomeIcons.circleQuestion,
          "color": Colors.grey,
        };
    }
  }
}
