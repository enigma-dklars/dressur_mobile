// ignore_for_file: use_build_context_synchronously
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/app_theme.dart';
import 'package:dressur/components/feature_hero.dart';
import 'package:dressur/components/feature_sections.dart';
import 'package:dressur/components/noti.dart';
import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;
import 'package:select_form_field/select_form_field.dart';

class VendeurAdhesionPage extends StatefulWidget {
  const VendeurAdhesionPage({super.key});

  @override
  State<VendeurAdhesionPage> createState() => _VendeurAdhesionPageState();
}

class _VendeurAdhesionPageState extends State<VendeurAdhesionPage> {
  bool _desactive = false;
  bool _loadingMethods = false;
  dynamic _valueMethodePaiement;
  final TextEditingController _montantRechargeController =
      TextEditingController(text: '500');
  final TextEditingController _telController = TextEditingController(text: tel);
  String? _erreurMontant;

  @override
  void initState() {
    super.initState();
    _chargerMethodesPaiement();
  }

  Future<void> _chargerMethodesPaiement() async {
    setState(() => _loadingMethods = true);
    try {
      var request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/listeFormuleBoost'));
      request.fields.addAll({'typeBoost': 'date'});
      http.StreamedResponse response = await request.send();
      if (response.statusCode == 200) {
        var data1 = await response.stream.bytesToString();
        var data = convert.jsonDecode(data1);
        if (!mounted) return;
        if (data["error"] == false) {
          setState(() {
            listeMethodePaiements =
                (data["listeMethodePaiements"] as List<dynamic>)
                    .map((item) => item as Map<String, dynamic>)
                    .toList();
            fraisAdhesionVendeur =
                (data["fraisAdhesionVendeur"] as num?)?.toInt() ??
                    fraisAdhesionVendeur;
          });
        }
      }
    } catch (_) {
      // Garde le sélecteur vide en cas d'erreur réseau
    } finally {
      if (mounted) setState(() => _loadingMethods = false);
    }
  }

  Future<void> _payerAdhesion() async {
    bool isConnected = await isConnectedToInternet();
    if (!mounted) return;
    if (!isConnected) {
      dangerNoti(
        langUserPhone != "fr" ? "Mistake!" : "Erreur!",
        langUserPhone != "fr"
            ? "You are not connected to the internet."
            : "Vous n'êtes pas connecté à internet.",
        context,
      );
      return;
    }

    if (_valueMethodePaiement == null) {
      dangerNoti(
        langUserPhone != "fr" ? "Attention!" : "Attention !",
        langUserPhone != "fr"
            ? "Please choose a payment method."
            : "Veuillez choisir une méthode de paiement.",
        context,
      );
      return;
    }

    // Validation montant recharge (obligatoire, min 500 FCFA)
    final int montantRecharge =
        int.tryParse(_montantRechargeController.text.trim()) ?? 0;
    if (montantRecharge < 500) {
      setState(() => _erreurMontant = langUserPhone != "fr"
          ? "An initial recharge of at least 500 FCFA is required"
          : "Une recharge initiale d'au moins 500 FCFA est obligatoire");
      return;
    }
    setState(() => _erreurMontant = null);

    setState(() => _desactive = true);

    try {
      var request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/vendeur/adhesion'));
      request.fields.addAll({
        'uid': uidUser,
        'methodePaiementId': _valueMethodePaiement.toString(),
        'montantRecharge': montantRecharge.toString(),
        'tel': _telController.text.trim(),
      });
      http.StreamedResponse response = await request.send();
      if (response.statusCode == 200) {
        var data1 = await response.stream.bytesToString();
        if (!mounted) return;
        var data = convert.jsonDecode(data1);
        if (data["error"] == true) {
          dangerNoti(data["titre"], data["message"], context);
          setState(() => _desactive = false);
        } else if (data["direct"] == true) {
          successNoti(
            langUserPhone != "fr" ? "Success" : "Succès",
            langUserPhone != "fr"
                ? "Payment confirmed. You are now a vendor!"
                : "Paiement confirmé. Vous êtes maintenant vendeur !",
            context,
          );
          setState(() {
            isVendeur = true;
            if (montantRecharge > 0) {
              soldeProgrammeRecompense =
                  (soldeProgrammeRecompense) + montantRecharge;
            }
            _desactive = false;
          });
          Navigator.pop(context);
        } else if (data["url"] != null && data["url"] != "none") {
          launchPaiement(data["url"]);
          setState(() {
            isVendeur = true;
            _desactive = false;
          });
          Navigator.pop(context);
        } else {
          setState(() => _desactive = false);
        }
      } else {
        setState(() => _desactive = false);
      }
    } catch (e) {
      if (!mounted) return;
      dangerNoti(
        langUserPhone != "fr" ? "Error!" : "Erreur!",
        langUserPhone != "fr"
            ? "A network error occurred. Please try again."
            : "Une erreur réseau s'est produite. Veuillez réessayer.",
        context,
      );
      setState(() => _desactive = false);
    }
  }

  @override
  Widget build(BuildContext context) {
    final bool isFr = langUserPhone == "fr";
    final theme = Theme.of(context);
    final String fraisAdhesionText =
        fraisAdhesionVendeur.toString().replaceAllMapped(
              RegExp(r'(\d)(?=(\d{3})+$)'),
              (m) => '${m[1]} ',
            );

    return Scaffold(
      appBar: AppBar(
        elevation: 0,
        backgroundColor: primaryColor,
        title: Text(
          isFr ? "Devenir Vendeur" : "Become a Vendor",
          style: theme.textTheme.titleMedium?.copyWith(
            color: Colors.white,
            fontWeight: FontWeight.w400,
          ),
        ),
        leading: IconButton(
          onPressed: () => Navigator.pop(context),
          icon: const FaIcon(FontAwesomeIcons.chevronLeft, color: Colors.white),
        ),
      ),
      body: SingleChildScrollView(
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.stretch,
          children: [
            FeatureHero(
              icon: FontAwesomeIcons.store,
              title:
                  isFr ? "Devenez Vendeur Dressur" : "Become a Dressur Vendor",
              subtitle: isFr
                  ? "Accédez à des avantages exclusifs et développez votre activité avec Dressur."
                  : "Access exclusive benefits and grow your business with Dressur.",
            ),
            Padding(
              padding: const EdgeInsets.all(AppSpacing.xLarge),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  // ── Présentation ─────────────────────────────────────────
                  _sectionTitle(context, isFr ? "Présentation" : "Overview"),
                  _paragraph(
                    context,
                    isFr
                        ? "Le statut Vendeur Dressur est réservé aux utilisateurs qui souhaitent bénéficier d'avantages commerciaux sur la plateforme. Il s'obtient via un paiement unique d'adhésion et donne accès à des fonctionnalités et tarifs privilégiés."
                        : "The Dressur Vendor status is reserved for users who want to benefit from commercial advantages on the platform. It is obtained through a one-time membership payment and gives access to privileged features and rates.",
                  ),

                  _divider(context),

                  // ── Avantages ────────────────────────────────────────────
                  _sectionTitle(
                      context, isFr ? "Avantages vendeur" : "Vendor benefits"),
                  _bulletItem(
                    context,
                    FontAwesomeIcons.tag,
                    isFr
                        ? "10% de réduction sur toutes les promotions réseau sociaux"
                        : "10% discount on all social network promotions",
                  ),
                  _bulletItem(
                    context,
                    FontAwesomeIcons.wallet,
                    isFr
                        ? "Solde rechargeable utilisable pour vos achats sur Dressur"
                        : "Rechargeable balance usable for your purchases on Dressur",
                  ),
                  _bulletItem(
                    context,
                    FontAwesomeIcons.headset,
                    isFr
                        ? "Support prioritaire réservé aux vendeurs"
                        : "Priority support reserved for vendors",
                  ),

                  _divider(context),

                  // ── Comment ça marche ────────────────────────────────────
                  _sectionTitle(
                      context, isFr ? "Comment ça marche" : "How it works"),
                  _stepItem(
                    context,
                    "1",
                    isFr
                        ? "Choisissez votre méthode de paiement (Mobile Money ou carte)."
                        : "Choose your payment method (Mobile Money or card).",
                  ),
                  _stepItem(
                    context,
                    "2",
                    isFr
                        ? "Payez les frais d'adhésion de $fraisAdhesionText FCFA (paiement unique)."
                        : "Pay the $fraisAdhesionText FCFA membership fee (one-time payment).",
                  ),
                  _stepItem(
                    context,
                    "3",
                    isFr
                        ? "Effectuez une recharge initiale de votre solde (minimum 500 FCFA)."
                        : "Make an initial top-up of your balance (minimum 500 FCFA).",
                  ),
                  _stepItem(
                    context,
                    "4",
                    isFr
                        ? "Votre statut vendeur est activé immédiatement après confirmation du paiement."
                        : "Your vendor status is activated immediately after payment confirmation.",
                  ),

                  _divider(context),

                  // ── Frais d'adhésion ─────────────────────────────────────
                  _sectionTitle(
                      context, isFr ? "Frais d'adhésion" : "Membership fee"),
                  FeatureInfoCard(
                    color: primaryColor,
                    padding: const EdgeInsets.symmetric(
                      vertical: AppSpacing.xLarge,
                      horizontal: AppSpacing.large,
                    ),
                    child: Column(
                      children: [
                        Text(
                          "$fraisAdhesionText FCFA",
                          style: theme.textTheme.displaySmall?.copyWith(
                              fontWeight: FontWeight.w700, color: primaryColor),
                          textAlign: TextAlign.center,
                        ),
                        const SizedBox(height: AppSpacing.xSmall),
                        Text(
                          isFr
                              ? "Paiement unique, non répétable."
                              : "One-time payment, non-repeatable.",
                          style: theme.textTheme.bodySmall?.copyWith(
                            color: theme.colorScheme.onSurfaceVariant,
                          ),
                          textAlign: TextAlign.center,
                        ),
                      ],
                    ),
                  ),

                  _divider(context),

                  // ── Formulaire de paiement ───────────────────────────────
                  _sectionTitle(context, isFr ? "Paiement" : "Payment"),

                  FeatureInfoCard(
                    padding: const EdgeInsets.all(AppSpacing.large),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        // ── Méthode de paiement ────────────────────────────
                        Text(
                          isFr ? "Méthode de paiement" : "Payment method",
                          style: theme.textTheme.titleSmall?.copyWith(
                            fontWeight: FontWeight.w600,
                            color: theme.colorScheme.onSurfaceVariant,
                          ),
                        ),
                        const SizedBox(height: AppSpacing.small),
                        _loadingMethods
                            ? const Center(
                                child: CircularProgressIndicator(
                                    color: primaryColor))
                            : SelectFormField(
                                decoration: InputDecoration(
                                  labelText: isFr
                                      ? 'Moyen de paiement mobile ou par carte'
                                      : 'Mobile or card payment method',
                                  border: const OutlineInputBorder(),
                                ),
                                type: SelectFormFieldType.dropdown,
                                initialValue: _valueMethodePaiement?.toString(),
                                labelText: isFr
                                    ? 'Moyen de paiement mobile ou par carte'
                                    : 'Mobile or card payment method',
                                items: listeMethodePaiements,
                                onChanged: (val) =>
                                    setState(() => _valueMethodePaiement = val),
                                onSaved: (val) {},
                              ),

                        const SizedBox(height: AppSpacing.xLarge),

                        // ── Numéro de téléphone ───────────────────────────────────
                        Text(
                          isFr
                              ? "Indicatif + Numéro du paiement"
                              : "Country code + Payment number",
                          style: theme.textTheme.titleSmall?.copyWith(
                            fontWeight: FontWeight.w600,
                            color: theme.colorScheme.onSurfaceVariant,
                          ),
                        ),
                        const SizedBox(height: AppSpacing.small),
                        TextField(
                          controller: _telController,
                          keyboardType: TextInputType.phone,
                          decoration: InputDecoration(
                            labelStyle: theme.textTheme.bodyMedium,
                            labelText: isFr
                                ? 'Indicatif + Numéro du paiement'
                                : 'Country code + Payment number',
                            border: const OutlineInputBorder(),
                          ),
                        ),

                        const SizedBox(height: AppSpacing.xLarge),

                        // ── Recharge initiale ────────────────────────────────────
                        Text(
                          isFr
                              ? "Recharge initiale (obligatoire, min 500 FCFA)"
                              : "Initial recharge (required, min 500 FCFA)",
                          style: theme.textTheme.titleSmall?.copyWith(
                            fontWeight: FontWeight.w600,
                            color: theme.colorScheme.onSurfaceVariant,
                          ),
                        ),
                        const SizedBox(height: AppSpacing.small),
                        TextField(
                          controller: _montantRechargeController,
                          keyboardType: TextInputType.number,
                          onChanged: (_) {
                            if (_erreurMontant != null) {
                              setState(() => _erreurMontant = null);
                            }
                          },
                          decoration: InputDecoration(
                            hintText: isFr ? "Ex : 5000" : "e.g. 5000",
                            border: const OutlineInputBorder(),
                            suffixText: "FCFA",
                            errorText: _erreurMontant,
                          ),
                        ),

                        const SizedBox(height: AppSpacing.xLarge),

                        // ── Bouton payer ─────────────────────────────────────────
                        ValueListenableBuilder<TextEditingValue>(
                          valueListenable: _montantRechargeController,
                          builder: (context, value, _) {
                            final int recharge =
                                int.tryParse(value.text.trim()) ?? 0;
                            final int total = fraisAdhesionVendeur +
                                (recharge > 0 ? recharge : 0);
                            final String totalStr =
                                total.toString().replaceAllMapped(
                                      RegExp(r'(\d)(?=(\d{3})+$)'),
                                      (m) => '${m[1]} ',
                                    );
                            return FeaturePrimaryButton(
                              isLoading: _desactive,
                              onPressed: _desactive ? null : _payerAdhesion,
                              label: _desactive
                                  ? (isFr ? "Patientez..." : "Wait...")
                                  : (isFr
                                      ? "Payer $totalStr FCFA"
                                      : "Pay $totalStr FCFA"),
                            );
                          },
                        ),

                        const SizedBox(height: AppSpacing.xLarge),
                      ],
                    ),
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }

  // ── Helpers présentation ────────────────────────────────────────────────────

  Widget _sectionTitle(BuildContext context, String title) {
    return FeatureSectionTitle(
      title: title,
      padding: const EdgeInsets.only(
        top: AppSpacing.small,
        bottom: AppSpacing.small,
      ),
    );
  }

  Widget _paragraph(BuildContext context, String text) {
    final theme = Theme.of(context);
    return Padding(
      padding: const EdgeInsets.only(bottom: AppSpacing.small),
      child: Text(
        text,
        style: theme.textTheme.bodyMedium?.copyWith(
          color: theme.colorScheme.onSurfaceVariant,
          height: 1.5,
        ),
      ),
    );
  }

  Widget _bulletItem(BuildContext context, IconData icon, String text) {
    return FeatureBulletRow(
      icon: icon,
      text: text,
      padding: const EdgeInsets.only(bottom: AppSpacing.small),
    );
  }

  Widget _stepItem(BuildContext context, String number, String text) {
    return FeatureNumberedStep(
      number: int.tryParse(number) ?? 0,
      title: text,
      margin: const EdgeInsets.only(bottom: AppSpacing.small),
    );
  }

  Widget _divider(BuildContext context) {
    final theme = Theme.of(context);
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: AppSpacing.medium),
      child: Divider(
        color: theme.dividerColor,
        height: 1,
      ),
    );
  }
}
