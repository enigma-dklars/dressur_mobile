// ignore_for_file: use_build_context_synchronously
import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:http/http.dart' as http;
import 'package:url_launcher/url_launcher.dart';
import 'package:dressur/components/app_theme.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/feature_hero.dart';
import 'package:dressur/components/feature_sections.dart';

class EspacePartenairePage extends StatefulWidget {
  const EspacePartenairePage({super.key});
  @override
  State<EspacePartenairePage> createState() => _EspacePartenairePageState();
}

class _EspacePartenairePageState extends State<EspacePartenairePage> {
  bool _loading = true;
  List<dynamic> _accompagnes = [];

  @override
  void initState() {
    super.initState();
    _chargerEspacePartenaire();
  }

  Future<void> _chargerEspacePartenaire() async {
    try {
      final response = await http.post(
        Uri.parse('$generalRouteForApi/espacePartenaire'),
        body: {'uid': '$uidUser'},
      );
      if (response.statusCode == 200) {
        final body = jsonDecode(response.body);
        if (body['success'] == true) {
          final code = body['codePartenaire']?.toString();
          setState(() {
            if (code != null && code.isNotEmpty) {
              monCodePartenaire = code;
            }
            _accompagnes = body['accompagnes'] ?? [];
          });
        }
      }
    } catch (_) {}
    if (mounted) setState(() => _loading = false);
  }

  @override
  Widget build(BuildContext context) {
    final isDark = Theme.of(context).brightness == Brightness.dark;
    final bool toutesConditions =
        condNom && condTel && condMail && condAnciennete && condCumul;
    return Scaffold(
      backgroundColor:
          isDark ? const Color(0xFF121212) : const Color(0xFFF8F9FA),
      appBar: AppBar(
        elevation: 0,
        backgroundColor: primaryColor,
        leading: IconButton(
          onPressed: () => Navigator.pop(context),
          icon: const FaIcon(FontAwesomeIcons.chevronLeft, color: Colors.white),
        ),
        title: Text(
          'Espace Partenaire',
          style: GoogleFonts.poppins(
              color: Colors.white, fontWeight: FontWeight.w500, fontSize: 18),
        ),
      ),
      body: _loading
          ? const Center(child: CircularProgressIndicator())
          : SingleChildScrollView(
              physics: const BouncingScrollPhysics(),
              padding: const EdgeInsets.symmetric(horizontal: 15, vertical: 16),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  // ── VUE PARTENAIRE ACTIF ───────────────────────────────────
                  if (estPartenaire) ...[
                    FeatureHero(
                      icon: FontAwesomeIcons.handshake,
                      title: 'Votre Espace Partenaire',
                      subtitle:
                          'Gérez votre code partenaire et suivez vos accompagnés.',
                      margin: EdgeInsets.zero,
                    ),
                    const SizedBox(height: AppSpacing.medium),
                    _buildActivePartnerCodeCard(context),
                    const SizedBox(height: AppSpacing.medium),
                    // ── Liste des accompagnés ──────────────────────────────
                    _buildActiveAccompagnesCard(context),
                    const SizedBox(height: AppSpacing.medium),
                    Padding(
                      padding: const EdgeInsets.only(bottom: AppSpacing.xSmall),
                      child: Text(
                        '▼  Présentation de l\'Espace Partenaire',
                        style: Theme.of(context).textTheme.bodySmall?.copyWith(
                              color: Theme.of(context)
                                  .colorScheme
                                  .onSurfaceVariant,
                            ),
                      ),
                    ),
                    const SizedBox(height: AppSpacing.xSmall),
                  ],
                  // ── PRÉSENTATION (toujours visible) ────────────────────────
                  _buildCard(isDark,
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Row(children: [
                            FaIcon(FontAwesomeIcons.handshake,
                                color: primaryColor, size: 18),
                            const SizedBox(width: 8),
                            Expanded(
                                child: Text(
                                    'Qu\'est-ce que l\'Espace Partenaire ?',
                                    style: GoogleFonts.poppins(
                                        fontWeight: FontWeight.bold,
                                        fontSize: 15))),
                          ]),
                          const SizedBox(height: 10),
                          Text(
                            'Le Partenaire Dressur est un utilisateur confirmé qui maîtrise la plateforme et s\'engage à accompagner, aider et expliquer Dressur aux personnes qui utilisent son code d\'affiliation. C\'est un rôle actif, pas seulement un statut.',
                            style: GoogleFonts.poppins(
                                fontSize: 13,
                                height: 1.6,
                                color: Colors.grey[700]),
                          ),
                        ],
                      )),
                  const SizedBox(height: 12),
                  _buildCard(isDark,
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Row(children: [
                            FaIcon(FontAwesomeIcons.gift,
                                color: Colors.green[600], size: 18),
                            const SizedBox(width: 8),
                            Text('Vos Avantages',
                                style: GoogleFonts.poppins(
                                    fontWeight: FontWeight.bold, fontSize: 15)),
                          ]),
                          const SizedBox(height: 10),
                          _buildAvantage(
                              '2% de commission sur chaque transaction payante de vos accompagnés, crédités sur votre solde Dressur'),
                          _buildAvantage(
                              'Le solde est utilisable sur tous les services payants (boosts, promos…)'),
                          _buildAvantage(
                              'Tableau de bord dédié avec la liste de vos accompagnés'),
                        ],
                      )),
                  const SizedBox(height: 12),
                  // ── Conditions ─────────────────────────────────────────────
                  _buildCard(isDark,
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Row(children: [
                            FaIcon(FontAwesomeIcons.listCheck,
                                color: Colors.orange[600], size: 18),
                            const SizedBox(width: 8),
                            Text('Conditions pour devenir Partenaire',
                                style: GoogleFonts.poppins(
                                    fontWeight: FontWeight.bold, fontSize: 15)),
                          ]),
                          const SizedBox(height: 12),
                          _buildCondition(isDark, condNom,
                              'Nom complet renseigné dans le profil'),
                          _buildCondition(
                              isDark, condTel, 'Numéro WhatsApp confirmé'),
                          _buildCondition(
                              isDark, condMail, 'Adresse e-mail confirmée'),
                          _buildCondition(isDark, condAnciennete,
                              'Inscrit depuis au moins 7 jours ($joursInscrit j / 7 j)'),
                          _buildCondition(isDark, condCumul,
                              'Au moins 2 000 FCFA cumulés en services payants ($cumulFcfa FCFA / 2 000 FCFA)'),
                          _buildConditionInfo(isDark,
                              'Entretien de validation avec l\'équipe Dressur sur WhatsApp (dernière étape)'),
                          if (!estPartenaire) ...[
                            const SizedBox(height: 16),
                            SizedBox(
                              width: double.infinity,
                              child: ElevatedButton.icon(
                                onPressed: toutesConditions
                                    ? () async {
                                        final message =
                                            'Bonjour, j\'aimerais passer l\'entretien pour devenir Partenaire Dressur. Mon pseudo est : $pseudo';
                                        final uri = Uri.parse(
                                            'https://wa.me/22964044294?text=${Uri.encodeComponent(message)}');
                                        if (!await launchUrl(uri,
                                            mode: LaunchMode
                                                .externalApplication)) {
                                          ScaffoldMessenger.of(context)
                                              .showSnackBar(SnackBar(
                                                  content: Text(
                                                      'Impossible d\'ouvrir WhatsApp',
                                                      style: GoogleFonts
                                                          .poppins())));
                                        }
                                      }
                                    : null,
                                style: ElevatedButton.styleFrom(
                                  backgroundColor: Colors.green[700],
                                  disabledBackgroundColor: Colors.grey[400],
                                  padding:
                                      const EdgeInsets.symmetric(vertical: 14),
                                  shape: RoundedRectangleBorder(
                                      borderRadius: BorderRadius.circular(12)),
                                ),
                                icon: const FaIcon(FontAwesomeIcons.whatsapp,
                                    color: Colors.white, size: 18),
                                label: Text('Demander l\'entretien WhatsApp',
                                    style: GoogleFonts.poppins(
                                        color: Colors.white,
                                        fontWeight: FontWeight.w600,
                                        fontSize: 15)),
                              ),
                            ),
                            if (!toutesConditions)
                              Padding(
                                padding: const EdgeInsets.only(top: 8),
                                child: Text(
                                  'Complétez toutes les conditions ci-dessus pour débloquer l\'entretien.',
                                  textAlign: TextAlign.center,
                                  style: GoogleFonts.poppins(
                                      fontSize: 12, color: Colors.red[400]),
                                ),
                              ),
                          ],
                        ],
                      )),
                  const SizedBox(height: 30),
                ],
              ),
            ),
    );
  }

  Widget _buildActivePartnerCodeCard(BuildContext context) {
    final theme = Theme.of(context);
    final accentColor = Colors.amber.shade700;

    return FeatureInfoCard(
      margin: EdgeInsets.zero,
      padding: const EdgeInsets.all(AppSpacing.large),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              Expanded(
                child: FeatureSectionTitle(
                  title: 'Votre Espace Partenaire',
                  icon: FontAwesomeIcons.star,
                  color: accentColor,
                  padding: EdgeInsets.zero,
                ),
              ),
              Chip(
                label: Text(
                  'Actif',
                  style: theme.textTheme.labelSmall?.copyWith(
                    color: theme.colorScheme.primary,
                    fontWeight: FontWeight.w700,
                  ),
                ),
                backgroundColor:
                    theme.colorScheme.primary.withValues(alpha: 0.12),
                side: BorderSide.none,
                visualDensity: VisualDensity.compact,
                padding: EdgeInsets.zero,
              ),
            ],
          ),
          const SizedBox(height: AppSpacing.large),
          Text(
            'Votre Code Partenaire',
            style: theme.textTheme.labelLarge?.copyWith(
              color: theme.colorScheme.onSurfaceVariant,
              fontWeight: FontWeight.w700,
              letterSpacing: 0.8,
            ),
          ),
          const SizedBox(height: AppSpacing.small),
          Container(
            width: double.infinity,
            padding: const EdgeInsets.symmetric(
              horizontal: AppSpacing.large,
              vertical: AppSpacing.medium,
            ),
            decoration: BoxDecoration(
              color: theme.colorScheme.primaryContainer.withValues(alpha: 0.45),
              borderRadius: BorderRadius.circular(AppRadii.medium),
              border: Border.all(
                color: theme.colorScheme.primary.withValues(alpha: 0.2),
              ),
            ),
            child: Text(
              monCodePartenaire ?? '—',
              style: theme.textTheme.headlineSmall?.copyWith(
                fontFamily: 'monospace',
                fontWeight: FontWeight.bold,
                letterSpacing: 4,
              ),
              textAlign: TextAlign.center,
            ),
          ),
          const SizedBox(height: AppSpacing.medium),
          FeaturePrimaryButton(
            label: 'Copier',
            icon: FontAwesomeIcons.copy,
            onPressed: () {
              Clipboard.setData(
                ClipboardData(text: monCodePartenaire ?? ''),
              );
              ScaffoldMessenger.of(context).showSnackBar(
                SnackBar(
                  content: const Text('Code copié !'),
                  backgroundColor: Colors.green.shade700,
                  duration: const Duration(seconds: 2),
                ),
              );
            },
          ),
          const SizedBox(height: AppSpacing.small),
          Text(
            'Ce code change automatiquement après chaque utilisation.',
            style: theme.textTheme.bodySmall?.copyWith(
              color: theme.colorScheme.onSurfaceVariant,
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildActiveAccompagnesCard(BuildContext context) {
    final theme = Theme.of(context);

    return FeatureInfoCard(
      margin: EdgeInsets.zero,
      padding: const EdgeInsets.all(AppSpacing.large),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              Expanded(
                child: FeatureSectionTitle(
                  title: 'Mes Accompagnés',
                  icon: FontAwesomeIcons.users,
                  padding: EdgeInsets.zero,
                ),
              ),
              Chip(
                label: Text(
                  '${_accompagnes.length}',
                  style: theme.textTheme.labelMedium?.copyWith(
                    color: theme.colorScheme.onPrimary,
                    fontWeight: FontWeight.bold,
                  ),
                ),
                backgroundColor: theme.colorScheme.primary,
                side: BorderSide.none,
                visualDensity: VisualDensity.compact,
                padding: EdgeInsets.zero,
              ),
            ],
          ),
          const SizedBox(height: AppSpacing.large),
          if (_accompagnes.isEmpty)
            Padding(
              padding: const EdgeInsets.symmetric(vertical: AppSpacing.medium),
              child: Center(
                child: Text(
                  'Aucun accompagné pour l\'instant.\nPartagez votre code !',
                  textAlign: TextAlign.center,
                  style: theme.textTheme.bodyMedium?.copyWith(
                    color: theme.colorScheme.onSurfaceVariant,
                  ),
                ),
              ),
            )
          else
            ..._accompagnes.map(
              (acc) => _buildActiveAccompagneCard(context, acc),
            ),
        ],
      ),
    );
  }

  Widget _buildActiveAccompagneCard(
      BuildContext context, Map<String, dynamic> acc) {
    final theme = Theme.of(context);

    return FeatureInfoCard(
      margin: const EdgeInsets.only(bottom: AppSpacing.small),
      padding: const EdgeInsets.all(AppSpacing.medium),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              Expanded(
                child: Text(
                  '${acc['nom'] ?? '—'}',
                  style: theme.textTheme.bodyLarge?.copyWith(
                    fontWeight: FontWeight.w600,
                  ),
                ),
              ),
              Text(
                '@${acc['pseudo'] ?? '—'}',
                style: theme.textTheme.bodySmall?.copyWith(
                  color: theme.colorScheme.onSurfaceVariant,
                ),
              ),
            ],
          ),
          const SizedBox(height: AppSpacing.small),
          _buildActiveAccInfo(
            FontAwesomeIcons.whatsapp,
            '${acc['tel'] ?? '—'}',
            Colors.green.shade600,
          ),
          const SizedBox(height: AppSpacing.xSmall),
          _buildActiveAccInfo(
            FontAwesomeIcons.envelope,
            '${acc['mail'] ?? '—'}',
            theme.colorScheme.onSurfaceVariant,
          ),
          const SizedBox(height: AppSpacing.xSmall),
          _buildActiveAccInfo(
            FontAwesomeIcons.calendarDay,
            'Affilié le ${acc['dateAffiliation'] ?? '—'}',
            theme.colorScheme.onSurfaceVariant,
          ),
        ],
      ),
    );
  }

  Widget _buildActiveAccInfo(IconData icon, String text, Color color) {
    final theme = Theme.of(context);

    return Row(
      children: [
        FaIcon(icon, size: 12, color: color),
        const SizedBox(width: AppSpacing.small),
        Expanded(
          child: Text(
            text,
            style: theme.textTheme.bodySmall?.copyWith(color: color),
          ),
        ),
      ],
    );
  }

  Widget _buildCard(bool isDark, {required Widget child}) {
    return Container(
      width: double.infinity,
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: isDark ? const Color(0xFF1E1E1E) : Colors.white,
        borderRadius: BorderRadius.circular(15),
        border:
            Border.all(color: isDark ? Colors.grey[800]! : Colors.grey[200]!),
      ),
      child: child,
    );
  }

  Widget _buildCondition(bool isDark, bool ok, String label) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 6),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          FaIcon(
            ok ? FontAwesomeIcons.circleCheck : FontAwesomeIcons.circleXmark,
            color: ok ? Colors.green[600] : Colors.red[400],
            size: 16,
          ),
          const SizedBox(width: 10),
          Expanded(
              child: Text(label, style: GoogleFonts.poppins(fontSize: 13))),
        ],
      ),
    );
  }

  Widget _buildConditionInfo(bool isDark, String label) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 6),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          FaIcon(FontAwesomeIcons.shield, color: Colors.orange[600], size: 16),
          const SizedBox(width: 10),
          Expanded(
              child: Text(label, style: GoogleFonts.poppins(fontSize: 13))),
        ],
      ),
    );
  }

  Widget _buildAvantage(String text) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 4),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          FaIcon(FontAwesomeIcons.circleCheck,
              color: Colors.green[500], size: 14),
          const SizedBox(width: 8),
          Expanded(
              child: Text(text,
                  style: GoogleFonts.poppins(fontSize: 13, height: 1.5))),
        ],
      ),
    );
  }
}
