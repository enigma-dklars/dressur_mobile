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
  String? _errorMessage;
  List<dynamic> _accompagnes = [];

  bool get _isFrench => langUserPhone == 'fr';

  @override
  void initState() {
    super.initState();
    _chargerEspacePartenaire();
  }

  Future<void> _chargerEspacePartenaire() async {
    if (mounted) {
      setState(() => _errorMessage = null);
    }
    try {
      final response = await http.post(
        Uri.parse('$generalRouteForApi/espacePartenaire'),
        body: {'uid': '$uidUser'},
      );
      if (response.statusCode == 200) {
        final body = jsonDecode(response.body);
        if (body['success'] == true) {
          final code = body['codePartenaire']?.toString();
          if (!mounted) return;
          setState(() {
            if (code != null && code.isNotEmpty) {
              monCodePartenaire = code;
            }
            _accompagnes = body['accompagnes'] ?? [];
          });
        } else if (mounted) {
          setState(() {
            _errorMessage = _isFrench
                ? 'Impossible de charger votre espace partenaire.'
                : 'Unable to load your partner space.';
          });
        }
      } else if (mounted) {
        setState(() {
          _errorMessage = _isFrench
              ? 'Le serveur est momentanément indisponible.'
              : 'The server is temporarily unavailable.';
        });
      }
    } catch (_) {
      if (mounted) {
        setState(() {
          _errorMessage = _isFrench
              ? 'Une erreur réseau est survenue. Veuillez réessayer.'
              : 'A network error occurred. Please try again.';
        });
      }
    } finally {
      if (mounted) setState(() => _loading = false);
    }
  }

  @override
  Widget build(BuildContext context) {
    final isDark = Theme.of(context).brightness == Brightness.dark;
    final isFr = _isFrench;
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
          isFr ? 'Espace Partenaire' : 'Partner Space',
          style: GoogleFonts.poppins(
              color: Colors.white, fontWeight: FontWeight.w500, fontSize: 18),
        ),
      ),
      body: _loading
          ? const Center(child: CircularProgressIndicator())
          : _errorMessage != null
              ? _buildErrorState(context, isFr)
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
                      title: isFr
                          ? 'Votre Espace Partenaire'
                          : 'Your Partner Space',
                      subtitle: isFr
                          ? 'Gérez votre code partenaire et suivez vos accompagnés.'
                          : 'Manage your partner code and follow your referrals.',
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
                        isFr
                            ? '▼  Présentation de l\'Espace Partenaire'
                            : '▼  Partner Space overview',
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
                  FeatureInfoCard(
                    icon: FontAwesomeIcons.handshake,
                    title: isFr
                        ? 'Qu\'est-ce que l\'Espace Partenaire ?'
                        : 'What is the Partner Space?',
                    child: Text(
                      isFr
                          ? 'Le Partenaire Dressur est un utilisateur confirmé qui maîtrise la plateforme et s\'engage à accompagner, aider et expliquer Dressur aux personnes qui utilisent son code d\'affiliation. C\'est un rôle actif, pas seulement un statut.'
                          : 'A Dressur Partner is a trusted user who understands the platform and commits to guiding, helping, and explaining Dressur to people who use their referral code. It is an active role, not just a status.',
                      style: Theme.of(context).textTheme.bodyMedium?.copyWith(
                            color: Theme.of(context).colorScheme.onSurfaceVariant,
                            height: 1.5,
                          ),
                    ),
                  ),
                  const SizedBox(height: 12),
                  FeatureInfoCard(
                    icon: FontAwesomeIcons.gift,
                    title: isFr ? 'Vos avantages' : 'Your benefits',
                    child: Column(
                      children: [
                        _buildBenefit(
                          context,
                          isFr
                              ? '2% de commission sur chaque transaction payante de vos accompagnés, crédités sur votre solde Dressur'
                              : '2% commission on every paid transaction made by your referrals, credited to your Dressur balance',
                        ),
                        _buildBenefit(
                          context,
                          isFr
                              ? 'Le solde est utilisable sur tous les services payants (boosts, promos…)'
                              : 'Your balance can be used for all paid services (boosts, promotions, and more)',
                        ),
                        _buildBenefit(
                          context,
                          isFr
                              ? 'Tableau de bord dédié avec la liste de vos accompagnés'
                              : 'A dedicated dashboard with your referral list',
                        ),
                      ],
                    ),
                  ),
                  const SizedBox(height: 12),
                  // ── Conditions ─────────────────────────────────────────────
                  FeatureInfoCard(
                    icon: FontAwesomeIcons.listCheck,
                    title: isFr
                        ? 'Conditions pour devenir Partenaire'
                        : 'Requirements to become a Partner',
                    child: Column(
                      children: [
                        _buildCondition(
                          context,
                          condNom,
                          isFr
                              ? 'Nom complet renseigné dans le profil'
                              : 'Full name added to your profile',
                          isFr,
                        ),
                        _buildCondition(
                          context,
                          condTel,
                          isFr
                              ? 'Numéro WhatsApp confirmé'
                              : 'WhatsApp number confirmed',
                          isFr,
                        ),
                        _buildCondition(
                          context,
                          condMail,
                          isFr
                              ? 'Adresse e-mail confirmée'
                              : 'Email address confirmed',
                          isFr,
                        ),
                        _buildCondition(
                          context,
                          condAnciennete,
                          isFr
                              ? 'Inscrit depuis au moins 7 jours ($joursInscrit j / 7 j)'
                              : 'Registered for at least 7 days ($joursInscrit days / 7 days)',
                          isFr,
                        ),
                        _buildCondition(
                          context,
                          condCumul,
                          isFr
                              ? 'Au moins 2 000 FCFA cumulés en services payants ($cumulFcfa FCFA / 2 000 FCFA)'
                              : 'At least 2,000 FCFA spent on paid services ($cumulFcfa FCFA / 2,000 FCFA)',
                          isFr,
                        ),
                        FeatureBulletRow(
                          text: isFr
                              ? 'Entretien de validation avec l\'équipe Dressur sur WhatsApp (dernière étape)'
                              : 'Validation interview with the Dressur team on WhatsApp (final step)',
                          icon: FontAwesomeIcons.shield,
                          color: Colors.orange.shade600,
                          padding: const EdgeInsets.symmetric(
                              vertical: AppSpacing.small),
                        ),
                        if (!estPartenaire) ...[
                          const SizedBox(height: AppSpacing.medium),
                          FeaturePrimaryButton(
                            label: isFr
                                ? 'Demander l\'entretien WhatsApp'
                                : 'Request WhatsApp interview',
                            icon: FontAwesomeIcons.whatsapp,
                            onPressed: toutesConditions
                                ? () async {
                                    final message = isFr
                                        ? 'Bonjour, j\'aimerais passer l\'entretien pour devenir Partenaire Dressur. Mon pseudo est : $pseudo'
                                        : 'Hello, I would like to take the interview to become a Dressur Partner. My username is: $pseudo';
                                    final uri = Uri.parse(
                                        'https://wa.me/22964044294?text=${Uri.encodeComponent(message)}');
                                    if (!await launchUrl(uri,
                                        mode: LaunchMode.externalApplication)) {
                                      if (!context.mounted) return;
                                      ScaffoldMessenger.of(context)
                                          .showSnackBar(SnackBar(
                                        content: Text(
                                          isFr
                                              ? 'Impossible d\'ouvrir WhatsApp.'
                                              : 'Unable to open WhatsApp.',
                                        ),
                                      ));
                                    }
                                  }
                                : null,
                          ),
                          if (!toutesConditions)
                            Padding(
                              padding: const EdgeInsets.only(
                                  top: AppSpacing.small),
                              child: Text(
                                isFr
                                    ? 'Complétez toutes les conditions ci-dessus pour débloquer l\'entretien.'
                                    : 'Complete all the requirements above to unlock the interview.',
                                textAlign: TextAlign.center,
                                style: Theme.of(context)
                                    .textTheme
                                    .bodySmall
                                    ?.copyWith(
                                      color:
                                          Theme.of(context).colorScheme.error,
                                    ),
                              ),
                            ),
                        ],
                      ],
                    ),
                  ),
                  const SizedBox(height: 30),
                ],
              ),
            ),
    );
  }

  Widget _buildActivePartnerCodeCard(BuildContext context) {
    final theme = Theme.of(context);
    final accentColor = Colors.amber.shade700;
    final isFr = _isFrench;

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
                  title: isFr ? 'Votre Espace Partenaire' : 'Your Partner Space',
                  icon: FontAwesomeIcons.star,
                  color: accentColor,
                  padding: EdgeInsets.zero,
                ),
              ),
              Chip(
                label: Text(
                   isFr ? 'Actif' : 'Active',
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
             isFr ? 'Votre code partenaire' : 'Your partner code',
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
             label: isFr ? 'Copier' : 'Copy',
            icon: FontAwesomeIcons.copy,
            onPressed: () {
              Clipboard.setData(
                ClipboardData(text: monCodePartenaire ?? ''),
              );
              ScaffoldMessenger.of(context).showSnackBar(
                SnackBar(
                   content: Text(isFr ? 'Code copié !' : 'Code copied!'),
                  backgroundColor: Colors.green.shade700,
                  duration: const Duration(seconds: 2),
                ),
              );
            },
          ),
          const SizedBox(height: AppSpacing.small),
          Text(
             isFr
                 ? 'Ce code change automatiquement après chaque utilisation.'
                 : 'This code changes automatically after each use.',
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
    final isFr = _isFrench;

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
                   title: isFr ? 'Mes accompagnés' : 'My referrals',
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
                   isFr
                       ? 'Aucun accompagné pour l\'instant.\nPartagez votre code !'
                       : 'No referrals yet.\nShare your code!',
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
    final isFr = _isFrench;

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
             isFr
                 ? 'Affilié le ${acc['dateAffiliation'] ?? '—'}'
                 : 'Joined on ${acc['dateAffiliation'] ?? '—'}',
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

  Widget _buildErrorState(BuildContext context, bool isFr) {
    return Center(
      child: Padding(
        padding: const EdgeInsets.all(AppSpacing.xLarge),
        child: FeatureInfoCard(
          icon: FontAwesomeIcons.triangleExclamation,
          title: isFr ? 'Espace partenaire indisponible' : 'Partner space unavailable',
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.stretch,
            children: [
              Text(
                _errorMessage ??
                    (isFr
                        ? 'Impossible de charger les données.'
                        : 'Unable to load the data.'),
                style: Theme.of(context).textTheme.bodyMedium?.copyWith(
                      color: Theme.of(context).colorScheme.onSurfaceVariant,
                    ),
              ),
              const SizedBox(height: AppSpacing.large),
              FeaturePrimaryButton(
                label: isFr ? 'Réessayer' : 'Retry',
                icon: FontAwesomeIcons.arrowsRotate,
                onPressed: () {
                  setState(() {
                    _loading = true;
                    _errorMessage = null;
                  });
                  _chargerEspacePartenaire();
                },
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildCondition(
      BuildContext context, bool isValid, String label, bool isFr) {
    return FeatureCondition(
      label: label,
      isValid: isValid,
      description: isFr
          ? (isValid ? 'Validée' : 'Non validée')
          : (isValid ? 'Validated' : 'Not validated'),
      padding: const EdgeInsets.symmetric(vertical: AppSpacing.small),
    );
  }

  Widget _buildBenefit(BuildContext context, String text) {
    return FeatureBulletRow(
      text: text,
      icon: FontAwesomeIcons.circleCheck,
      color: Colors.green.shade600,
      padding: const EdgeInsets.symmetric(vertical: AppSpacing.small),
    );
  }
}
