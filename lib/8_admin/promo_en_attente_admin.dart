// ignore_for_file: unnecessary_brace_in_string_interps

import 'dart:convert';
import 'package:cached_network_image/cached_network_image.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:http/http.dart' as http;
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/noti.dart';

class AdminPromoEnAttentePage extends StatefulWidget {
  const AdminPromoEnAttentePage({Key? key}) : super(key: key);

  @override
  State<AdminPromoEnAttentePage> createState() =>
      _AdminPromoEnAttentePageState();
}

class _AdminPromoEnAttentePageState extends State<AdminPromoEnAttentePage> {
  bool _loading = true;
  String? _errorMessage;
  List<dynamic> _promotions = [];
  final Set<int> _processing = {};

  @override
  void initState() {
    super.initState();
    _fetchPromos();
  }

  Future<void> _fetchPromos() async {
    if (mounted) {
      setState(() {
        _loading = true;
        _errorMessage = null;
      });
    }

    try {
      final response = await http.get(
        Uri.parse('$generalRouteForApi/admin/promos-en-attente?uid=$uidUser'),
      );
      if (response.statusCode != 200) {
        throw Exception('HTTP ${response.statusCode}');
      }

      final data = jsonDecode(response.body) as Map<String, dynamic>;
      if (data['error'] == true) {
        throw Exception(data['message'] ?? 'Unable to load pending promotions.');
      }

      if (mounted) {
        setState(() {
          _promotions = (data['promotions'] as List<dynamic>? ?? [])
              .whereType<Map<String, dynamic>>()
              .toList();
        });
      }
    } catch (_) {
      if (mounted) {
        setState(() {
          _errorMessage = (langUserPhone == "fr")
              ? 'Impossible de charger les promotions en attente.'
              : 'Unable to load pending promotions.';
        });
      }
    } finally {
      if (mounted) setState(() => _loading = false);
    }
  }

  Future<void> _accepter(int id) async {
    if (!mounted) return;
    setState(() => _processing.add(id));
    try {
      final response = await http.post(
        Uri.parse('$generalRouteForApi/admin/promos/$id/accepter'),
        body: {'uid': '$uidUser'},
      );
      if (response.statusCode != 200) {
        throw Exception('HTTP ${response.statusCode}');
      }

      final data = jsonDecode(response.body) as Map<String, dynamic>;
      final bool success = data['error'] == false;
      _showSnack(
        data['message']?.toString() ?? ((langUserPhone == "fr") ? 'Fait' : 'Done'),
        success,
      );
      if (success && mounted) {
        setState(() => _promotions.removeWhere((p) => _promotionId(p) == id));
      }
    } catch (_) {
      _showSnack((langUserPhone == "fr") ? 'Erreur réseau' : 'Network error', false);
    } finally {
      if (mounted) setState(() => _processing.remove(id));
    }
  }

  Future<void> _refuser(int id, String motif) async {
    if (motif.trim().isEmpty || !mounted) return;
    setState(() => _processing.add(id));
    try {
      final response = await http.post(
        Uri.parse('$generalRouteForApi/admin/promos/$id/refuser'),
        body: {'uid': '$uidUser', 'motif': motif.trim()},
      );
      if (response.statusCode != 200) {
        throw Exception('HTTP ${response.statusCode}');
      }

      final data = jsonDecode(response.body) as Map<String, dynamic>;
      final bool success = data['error'] == false;
      _showSnack(
        data['message']?.toString() ?? ((langUserPhone == "fr") ? 'Fait' : 'Done'),
        success,
      );
      if (success && mounted) {
        setState(() => _promotions.removeWhere((p) => _promotionId(p) == id));
      }
    } catch (_) {
      _showSnack((langUserPhone == "fr") ? 'Erreur réseau' : 'Network error', false);
    } finally {
      if (mounted) setState(() => _processing.remove(id));
    }
  }

  void _showSnack(String msg, bool ok) {
    if (!mounted) return;
    if (ok) {
      successNoti(
        (langUserPhone == "fr") ? 'Succès' : 'Success',
        msg,
        context,
      );
    } else {
      dangerNoti(
        (langUserPhone == "fr") ? 'Erreur' : 'Error',
        msg,
        context,
      );
    }
  }

  void _showRefuserDialog(int id) {
    final controller = TextEditingController();
    final formKey = GlobalKey<FormState>();

    showDialog(
      context: context,
      builder: (dialogContext) => AlertDialog(
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
        title: Text(
          (langUserPhone == "fr") ? 'Motif de refus' : 'Reason for rejection',
          style: GoogleFonts.poppins(fontWeight: FontWeight.bold),
        ),
        content: Form(
          key: formKey,
          child: TextFormField(
            controller: controller,
            maxLines: 4,
            maxLength: 500,
            validator: (value) {
              if ((value ?? '').trim().isEmpty) {
                return (langUserPhone == "fr")
                    ? 'Le motif est obligatoire.'
                    : 'A reason is required.';
              }
              return null;
            },
            decoration: InputDecoration(
              hintText: (langUserPhone == "fr")
                  ? 'Expliquer pourquoi cette promotion est refusée...'
                  : 'Explain why this promotion is rejected...',
              border: const OutlineInputBorder(),
            ),
          ),
        ),
        actions: [
          TextButton(
            onPressed: () => Navigator.pop(dialogContext),
            child: Text(
              (langUserPhone == "fr") ? 'Annuler' : 'Cancel',
              style: GoogleFonts.poppins(),
            ),
          ),
          ElevatedButton(
            onPressed: () {
              if (!(formKey.currentState?.validate() ?? false)) return;
              final motif = controller.text.trim();
              Navigator.pop(dialogContext);
              _refuser(id, motif);
            },
            style: ElevatedButton.styleFrom(backgroundColor: Colors.red),
            child: Text(
              (langUserPhone == "fr") ? 'Refuser' : 'Reject',
              style: GoogleFonts.poppins(
                color: Colors.white,
                fontWeight: FontWeight.bold,
              ),
            ),
          ),
        ],
      ),
    ).then((_) => controller.dispose());
  }

  String _labelType(String? type) {
    switch (type) {
      case 'dmd_emploi':
        return (langUserPhone == "fr") ? "Demande d'emploi" : "Job Application";
      case 'offre_emploi':
        return (langUserPhone == "fr") ? "Offre d'emploi" : "Job Offer";
      case 'sites_applications':
        return (langUserPhone == "fr") ? 'Sites & Applications' : 'Websites & Apps';
      default:
        return (langUserPhone == "fr") ? 'Produit / Service' : 'Product / Service';
    }
  }

  int? _promotionId(Map<String, dynamic> promotion) {
    final value = promotion['id'];
    return value is int ? value : int.tryParse('$value');
  }

  String _statusLabel(dynamic value, dynamic fallback) {
    final status = value is int ? value : int.tryParse('$value');
    if (langUserPhone == "fr") {
      return switch (status) {
        0 => 'Rejetée',
        1 => 'En attente',
        2 => 'En attente de paiement',
        3 => 'En cours',
        4 => 'Terminée',
        _ => _displayValue(fallback),
      };
    }
    return switch (status) {
      0 => 'Rejected',
      1 => 'Pending',
      2 => 'Awaiting payment',
      3 => 'Active',
      4 => 'Completed',
      _ => _displayValue(fallback),
    };
  }

  String _displayValue(dynamic value) {
    if (value == null) return '—';
    if (value is bool) return value
        ? ((langUserPhone == "fr") ? 'Oui' : 'Yes')
        : ((langUserPhone == "fr") ? 'Non' : 'No');
    if (value is Map || value is List) return jsonEncode(value);
    final text = value.toString().trim();
    return text.isEmpty ? '—' : text;
  }

  Map<String, dynamic>? _asMap(dynamic value) {
    if (value is Map<String, dynamic>) return value;
    if (value is Map) return Map<String, dynamic>.from(value);
    return null;
  }

  Widget _buildCard(Map<String, dynamic> p, bool isDark) {
    final int? id = _promotionId(p);
    if (id == null) return const SizedBox.shrink();
    final bool isProcessing = _processing.contains(id);
    final user = _asMap(p['user']);
    final imageName = p['image']?.toString().trim();

    return Card(
      color: isDark ? const Color(0xFF1E1E1E) : Colors.white,
      margin: const EdgeInsets.symmetric(horizontal: 12, vertical: 6),
      elevation: 2,
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(14)),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          // ── Image complète sans recadrage ──
          if (imageName != null && imageName.isNotEmpty)
            ClipRRect(
              borderRadius: const BorderRadius.vertical(top: Radius.circular(14)),
              child: CachedNetworkImage(
                imageUrl: '$generalRouteForPromotionImage$imageName',
                width: double.infinity,
                fit: BoxFit.contain,
                placeholder: (_, __) => AspectRatio(
                  aspectRatio: 4 / 3,
                  child: Container(
                    color: isDark ? Colors.grey[850] : Colors.grey[200],
                    child: const Center(child: CircularProgressIndicator(color: primaryColor)),
                  ),
                ),
                errorWidget: (_, __, ___) => AspectRatio(
                  aspectRatio: 4 / 3,
                  child: Container(
                    color: isDark ? Colors.grey[850] : Colors.grey[200],
                    child: Icon(
                      Icons.image_not_supported,
                      size: 48,
                      color: Colors.grey[500],
                    ),
                  ),
                ),
              ),
            ),

          Padding(
            padding: const EdgeInsets.all(12),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                // ── Badges ──
                Row(
                  children: [
                    _badge('#$id', Colors.orange),
                    const SizedBox(width: 6),
                    _badge(_labelType(p['type'] as String?), Colors.blue),
                    const Spacer(),
                    if ((p['source'] ?? '').toString().isNotEmpty)
                      Text(
                        '${p['source']}',
                        style: GoogleFonts.poppins(
                            fontSize: 10,
                            color:
                                isDark ? Colors.grey[400] : Colors.grey[600]),
                      ),
                  ],
                ),
                const SizedBox(height: 8),

                // ── Description complète ──
                Text(
                  '${p['description'] ?? ''}',
                  style: GoogleFonts.poppins(
                    fontSize: 13,
                    color: isDark ? Colors.grey[300] : Colors.grey[800],
                  ),
                ),
                const SizedBox(height: 8),

                // ── Infos utilisateur ──
                if (user != null) ...[
                  _userInfoRow(
                      FontAwesomeIcons.user,
                      '${user['pseudo'] ?? ''} ${user['nom'] ?? ''}',
                      isDark),
                  const SizedBox(height: 2),
                  _userInfoRow(FontAwesomeIcons.envelope,
                      '${user['mail'] ?? ''}', isDark),
                  const SizedBox(height: 2),
                  _userInfoRow(
                      FontAwesomeIcons.phone, '${user['tel'] ?? ''}', isDark),
                  const SizedBox(height: 4),
                ],

                // ── Date ──
                Text(
                  '${(langUserPhone == "fr") ? "Soumis le" : "Submitted on"} ${p['createdAt'] ?? ''}',
                  style: GoogleFonts.poppins(
                      fontSize: 10,
                      color: isDark ? Colors.grey[600] : Colors.grey[400]),
                ),
                const SizedBox(height: 8),
                OutlinedButton.icon(
                  onPressed: () => _showPromotionDetails(p, isDark),
                  icon: const FaIcon(FontAwesomeIcons.circleInfo, size: 14),
                  label: Text(
                    (langUserPhone == "fr") ? 'Voir toutes les informations' : 'View all information',
                    style: GoogleFonts.poppins(fontSize: 12, fontWeight: FontWeight.w600),
                  ),
                  style: OutlinedButton.styleFrom(
                    foregroundColor: isDark ? Colors.blue[200] : Colors.blue[700],
                    side: BorderSide(color: isDark ? Colors.blue[200]! : Colors.blue[700]! ),
                    shape: const StadiumBorder(),
                  ),
                ),
                const SizedBox(height: 12),

                // ── Boutons ──
                if (isProcessing)
                  const Center(child: CircularProgressIndicator(color: primaryColor))
                else
                  Row(
                    children: [
                      Expanded(
                        child: ElevatedButton.icon(
                          onPressed: () => _accepter(id),
                          icon: const FaIcon(FontAwesomeIcons.check, size: 14),
                          label: Text(
                            (langUserPhone == "fr") ? 'Accepter' : 'Accept',
                            style: GoogleFonts.poppins(
                                fontWeight: FontWeight.bold),
                          ),
                          style: ElevatedButton.styleFrom(
                            backgroundColor: Colors.green,
                            foregroundColor: Colors.white,
                            shape: const StadiumBorder(),
                            padding:
                                const EdgeInsets.symmetric(vertical: 12),
                          ),
                        ),
                      ),
                      const SizedBox(width: 8),
                      Expanded(
                        child: ElevatedButton.icon(
                          onPressed: () => _showRefuserDialog(id),
                          icon:
                              const FaIcon(FontAwesomeIcons.xmark, size: 14),
                          label: Text(
                            (langUserPhone == "fr") ? 'Refuser' : 'Reject',
                            style: GoogleFonts.poppins(
                                fontWeight: FontWeight.bold),
                          ),
                          style: ElevatedButton.styleFrom(
                            backgroundColor: Colors.red,
                            foregroundColor: Colors.white,
                            shape: const StadiumBorder(),
                            padding:
                                const EdgeInsets.symmetric(vertical: 12),
                          ),
                        ),
                      ),
                    ],
                  ),
              ],
            ),
          ),
        ],
      ),
    );
  }

  Widget _detailRow(String label, dynamic value, bool isDark) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 8),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          SizedBox(
            width: 132,
            child: Text(
              label,
              style: GoogleFonts.poppins(
                fontSize: 11,
                fontWeight: FontWeight.w600,
                color: isDark ? Colors.grey[400] : Colors.grey[600],
              ),
            ),
          ),
          Expanded(
            child: SelectableText(
              _displayValue(value),
              style: GoogleFonts.poppins(
                fontSize: 12,
                color: isDark ? Colors.grey[200] : Colors.grey[800],
              ),
            ),
          ),
        ],
      ),
    );
  }

  Widget _detailSection(String title, List<Widget> children, bool isDark) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 16),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(
            title,
            style: GoogleFonts.poppins(
              fontSize: 14,
              fontWeight: FontWeight.bold,
              color: isDark ? Colors.blue[200] : Colors.blue[700],
            ),
          ),
          const SizedBox(height: 8),
          ...children,
        ],
      ),
    );
  }

  Future<void> _copyPublicUrl(String url) async {
    await Clipboard.setData(ClipboardData(text: url));
    _showSnack(
      (langUserPhone == "fr") ? 'Lien public copié.' : 'Public link copied.',
      true,
    );
  }

  void _showPromotionDetails(Map<String, dynamic> p, bool isDark) {
    final user = _asMap(p['user']);
    final formule = _asMap(p['formule']);
    final additionalInfo = _asMap(p['annotherInfo']) ?? {};
    final refusals = (p['motifsRefus'] as List<dynamic>? ?? [])
        .map(_asMap)
        .whereType<Map<String, dynamic>>()
        .toList();
    final image = p['image']?.toString().trim() ?? '';
    final publicUrl = p['publicUrl']?.toString() ?? '';
    final promotionId = _promotionId(p);

    showModalBottomSheet(
      context: context,
      isScrollControlled: true,
      useSafeArea: true,
      backgroundColor: Colors.transparent,
      builder: (sheetContext) => DraggableScrollableSheet(
        initialChildSize: 0.88,
        minChildSize: 0.55,
        maxChildSize: 0.96,
        expand: false,
        builder: (_, scrollController) => Container(
          decoration: BoxDecoration(
            color: isDark ? const Color(0xFF1E1E1E) : Colors.white,
            borderRadius: const BorderRadius.vertical(top: Radius.circular(24)),
          ),
          child: Column(
            children: [
              Padding(
                padding: const EdgeInsets.fromLTRB(16, 12, 8, 8),
                child: Row(
                  children: [
                    Expanded(
                      child: Text(
                        (langUserPhone == "fr")
                            ? 'Détails de la promotion #${_promotionId(p)}'
                            : 'Promotion #${_promotionId(p)} details',
                        style: GoogleFonts.poppins(
                          fontSize: 17,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                    ),
                    IconButton(
                      onPressed: () => Navigator.pop(sheetContext),
                      icon: const Icon(Icons.close),
                    ),
                  ],
                ),
              ),
              Expanded(
                child: ListView(
                  controller: scrollController,
                  padding: const EdgeInsets.fromLTRB(16, 0, 16, 24),
                  children: [
                    if (image.isNotEmpty)
                      Padding(
                        padding: const EdgeInsets.only(bottom: 16),
                        child: ClipRRect(
                          borderRadius: BorderRadius.circular(12),
                          child: CachedNetworkImage(
                            imageUrl: '$generalRouteForPromotionImage$image',
                            fit: BoxFit.contain,
                            placeholder: (_, __) => const SizedBox(
                              height: 180,
                              child: Center(child: CircularProgressIndicator()),
                            ),
                            errorWidget: (_, __, ___) => const SizedBox(
                              height: 120,
                              child: Center(child: Icon(Icons.broken_image)),
                            ),
                          ),
                        ),
                      ),
                    _detailSection(
                      (langUserPhone == "fr") ? 'Identification' : 'Identification',
                      [
                        _detailRow('ID', p['id'], isDark),
                        _detailRow(
                          (langUserPhone == "fr") ? 'Type' : 'Type',
                          _labelType(p['type']?.toString()),
                          isDark,
                        ),
                        _detailRow(
                          (langUserPhone == "fr") ? 'Statut' : 'Status',
                          _statusLabel(p['status'], p['statusLabel']),
                          isDark,
                        ),
                        _detailRow('Source', p['source'], isDark),
                        _detailRow('Mode', p['mode'], isDark),
                        _detailRow(
                          (langUserPhone == "fr") ? 'Soumis le' : 'Submitted on',
                          p['createdAt'],
                          isDark,
                        ),
                      ],
                      isDark,
                    ),
                    _detailSection(
                      (langUserPhone == "fr") ? 'Contenu' : 'Content',
                      [
                        _detailRow(
                          (langUserPhone == "fr") ? 'Description' : 'Description',
                          p['description'],
                          isDark,
                        ),
                        _detailRow('Motif actuel', p['motif'], isDark),
                        _detailRow('WhatsApp', p['whatsappContact'], isDark),
                        _detailRow('Nom du site/app', p['nomSiteApp'], isDark),
                        _detailRow('Sous-type', p['sousTypeSiteApp'], isDark),
                        _detailRow('URL site/app', p['urlSiteApp'], isDark),
                      ],
                      isDark,
                    ),
                    _detailSection(
                      (langUserPhone == "fr") ? 'Dates et formule' : 'Dates and plan',
                      [
                        _detailRow('Début', p['dateDebut'], isDark),
                        _detailRow('Expiration', p['dateExp'], isDark),
                        _detailRow('Formule', formule?['titre'], isDark),
                        _detailRow('Prix', formule?['prix'], isDark),
                        _detailRow('Durée (jours)', formule?['nbrJour'], isDark),
                      ],
                      isDark,
                    ),
                    _detailSection(
                      (langUserPhone == "fr") ? 'Diffusion et statistiques' : 'Distribution and statistics',
                      [
                        _detailRow('Publication Dressur', p['publishOnDressurStatus'], isDark),
                        _detailRow('Boost Facebook', p['boostFacebook'], isDark),
                        _detailRow('Montant Boost Facebook', p['montantBoostFacebook'], isDark),
                        _detailRow('Référencement', p['referencement'], isDark),
                        _detailRow('Programme récompense', p['inProgrammeRecompense'], isDark),
                        _detailRow('Budget récompense', additionalInfo['rewardBudget'], isDark),
                        _detailRow('Limitée', p['limited'], isDark),
                        _detailRow('Vues', p['nombreDeVue'], isDark),
                        _detailRow('Impressions', p['nombreImpression'], isDark),
                        _detailRow('Utilisateurs vus', p['whoSawCount'], isDark),
                        _detailRow('Vues simulées', p['isFakeVue'], isDark),
                      ],
                      isDark,
                    ),
                    if (user != null)
                      _detailSection(
                        (langUserPhone == "fr") ? 'Utilisateur' : 'User',
                        [
                          _detailRow('Pseudo', user['pseudo'], isDark),
                          _detailRow('Nom', user['nom'], isDark),
                          _detailRow('E-mail', user['mail'], isDark),
                          _detailRow('Téléphone', user['tel'], isDark),
                        ],
                        isDark,
                      ),
                    if (additionalInfo.isNotEmpty)
                      _detailSection(
                        (langUserPhone == "fr") ? 'Informations complémentaires' : 'Additional information',
                        additionalInfo.entries
                            .map((entry) => _detailRow(entry.key, entry.value, isDark))
                            .toList(),
                        isDark,
                      ),
                    if (refusals.isNotEmpty)
                      _detailSection(
                        (langUserPhone == "fr") ? 'Historique des refus' : 'Rejection history',
                        refusals
                            .map(
                              (refusal) => _detailRow(
                                refusal['dateRefus']?.toString() ?? 'Date',
                                refusal['motif'],
                                isDark,
                              ),
                            )
                            .toList(),
                        isDark,
                      ),
                    if (publicUrl.isNotEmpty)
                      OutlinedButton.icon(
                        onPressed: () => _copyPublicUrl(publicUrl),
                        icon: const FaIcon(FontAwesomeIcons.copy, size: 14),
                        label: Text(
                          (langUserPhone == "fr")
                              ? 'Copier le lien public'
                              : 'Copy public link',
                          style: GoogleFonts.poppins(fontWeight: FontWeight.w600),
                        ),
                      ),
                    if (promotionId != null) ...[
                      const SizedBox(height: 10),
                      Row(
                        children: [
                          Expanded(
                            child: ElevatedButton.icon(
                              onPressed: () {
                                Navigator.pop(sheetContext);
                                _accepter(promotionId);
                              },
                              icon: const FaIcon(FontAwesomeIcons.check, size: 14),
                              label: Text(
                                (langUserPhone == "fr") ? 'Accepter' : 'Accept',
                                style: GoogleFonts.poppins(fontWeight: FontWeight.w600),
                              ),
                              style: ElevatedButton.styleFrom(
                                backgroundColor: Colors.green,
                                foregroundColor: Colors.white,
                                shape: const StadiumBorder(),
                              ),
                            ),
                          ),
                          const SizedBox(width: 8),
                          Expanded(
                            child: ElevatedButton.icon(
                              onPressed: () {
                                Navigator.pop(sheetContext);
                                _showRefuserDialog(promotionId);
                              },
                              icon: const FaIcon(FontAwesomeIcons.xmark, size: 14),
                              label: Text(
                                (langUserPhone == "fr") ? 'Refuser' : 'Reject',
                                style: GoogleFonts.poppins(fontWeight: FontWeight.w600),
                              ),
                              style: ElevatedButton.styleFrom(
                                backgroundColor: Colors.red,
                                foregroundColor: Colors.white,
                                shape: const StadiumBorder(),
                              ),
                            ),
                          ),
                        ],
                      ),
                    ],
                  ],
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildErrorState(bool isDark) {
    return Center(
      child: Padding(
        padding: const EdgeInsets.all(24),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Icon(Icons.cloud_off, size: 52, color: isDark ? Colors.orange[200] : Colors.orange[700]),
            const SizedBox(height: 16),
            Text(
              _errorMessage ?? '',
              textAlign: TextAlign.center,
              style: GoogleFonts.poppins(fontSize: 14),
            ),
            const SizedBox(height: 16),
            ElevatedButton.icon(
              onPressed: _fetchPromos,
              icon: const FaIcon(FontAwesomeIcons.arrowsRotate, size: 14),
              label: Text(
                (langUserPhone == "fr") ? 'Réessayer' : 'Try again',
                style: GoogleFonts.poppins(fontWeight: FontWeight.w600),
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _badge(String label, MaterialColor color) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 3),
      decoration: BoxDecoration(
        color: color[100],
        borderRadius: BorderRadius.circular(20),
      ),
      child: Text(
        label,
        style: GoogleFonts.poppins(
            fontSize: 10,
            fontWeight: FontWeight.bold,
            color: color[800]),
      ),
    );
  }

  Widget _userInfoRow(IconData icon, String text, bool isDark) {
    return Row(
      children: [
        FaIcon(icon, size: 11, color: Colors.grey),
        const SizedBox(width: 6),
        Expanded(
          child: Text(
            text,
            style: GoogleFonts.poppins(
                fontSize: 11,
                color: isDark ? Colors.grey[400] : Colors.grey[600]),
          ),
        ),
      ],
    );
  }

  @override
  Widget build(BuildContext context) {
    final isDark = Theme.of(context).brightness == Brightness.dark;

    return Scaffold(
      backgroundColor:
          isDark ? const Color(0xFF121212) : const Color(0xFFF8F9FA),
      appBar: AppBar(
        elevation: 0,
        backgroundColor: Colors.red,
        leading: IconButton(
          onPressed: () => Navigator.pop(context),
          icon: const FaIcon(FontAwesomeIcons.chevronLeft, color: Colors.white),
        ),
        title: Text(
          (langUserPhone == "fr") ? 'Promotions en attente' : 'Pending Promotions',
          style: GoogleFonts.poppins(
              color: Colors.white, fontWeight: FontWeight.w400, fontSize: 18),
        ),
        actions: [
          IconButton(
            onPressed: _fetchPromos,
            tooltip: (langUserPhone == "fr") ? 'Actualiser' : 'Refresh',
            icon: const FaIcon(FontAwesomeIcons.arrowsRotate,
                color: Colors.white, size: 18),
          ),
        ],
      ),
      body: _loading
          ? const Center(child: CircularProgressIndicator(color: primaryColor))
          : _errorMessage != null
              ? _buildErrorState(isDark)
              : _promotions.isEmpty
              ? Center(
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      const FaIcon(FontAwesomeIcons.circleCheck,
                          size: 52, color: Colors.green),
                      const SizedBox(height: 16),
                      Text(
                        (langUserPhone == "fr") ? 'Aucune promotion en attente' : 'No pending promotions',
                        style: GoogleFonts.poppins(
                            fontSize: 16,
                            color: isDark
                                ? Colors.grey[400]
                                : Colors.grey[600]),
                      ),
                    ],
                  ),
                )
              : RefreshIndicator(
                  onRefresh: _fetchPromos,
                  child: ListView.builder(
                    padding: const EdgeInsets.symmetric(vertical: 8),
                    itemCount: _promotions.length,
                    itemBuilder: (_, i) => _buildCard(
                        _promotions[i] as Map<String, dynamic>, isDark),
                  ),
                ),
    );
  }
}
