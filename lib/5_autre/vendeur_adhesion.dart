// ignore_for_file: use_build_context_synchronously
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/noti.dart';
import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;
import 'package:select_form_field/select_form_field.dart';

class VendeurAdhesionPage extends StatefulWidget {
  @override
  State<VendeurAdhesionPage> createState() => _VendeurAdhesionPageState();
}

class _VendeurAdhesionPageState extends State<VendeurAdhesionPage> {
  bool _desactive = false;
  bool _loadingMethods = false;
  dynamic _valueMethodePaiement;
  final TextEditingController _montantRechargeController = TextEditingController(text: '500');
  String? _erreurMontant;

  @override
  void initState() {
    super.initState();
    if (listeMethodePaiements.isEmpty) {
      _chargerMethodesPaiement();
    }
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
        if (data["error"] == false) {
          setState(() {
            listeMethodePaiements = (data["listeMethodePaiements"] as List<dynamic>)
                .map((item) => item as Map<String, dynamic>)
                .toList();
          });
        }
      }
    } catch (_) {
      // Garde le sélecteur vide en cas d'erreur réseau
    } finally {
      setState(() => _loadingMethods = false);
    }
  }

  Future<void> _payerAdhesion() async {
    bool isConnected = await isConnectedToInternet();
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
    final int montantRecharge = int.tryParse(_montantRechargeController.text.trim()) ?? 0;
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
      });
      http.StreamedResponse response = await request.send();
      if (response.statusCode == 200) {
        var data1 = await response.stream.bytesToString();
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
              soldeProgrammeRecompense = (soldeProgrammeRecompense) + montantRecharge;
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
    final bool isDark = Theme.of(context).brightness == Brightness.dark;

    return Scaffold(
      appBar: AppBar(
        elevation: 0,
        backgroundColor: primaryColor,
        title: Text(
          isFr ? "Devenir Vendeur" : "Become a Vendor",
          style: GoogleFonts.poppins(
              color: Colors.white, fontWeight: FontWeight.w400, fontSize: 18),
        ),
        leading: IconButton(
          onPressed: () => Navigator.pop(context),
          icon: const FaIcon(FontAwesomeIcons.chevronLeft, color: Colors.white),
        ),
      ),
      body: SingleChildScrollView(
        child: Padding(
          padding: const EdgeInsets.all(16.0),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.stretch,
            children: [
              const SizedBox(height: 10),
              // Montant
              Container(
                padding: const EdgeInsets.symmetric(vertical: 24, horizontal: 16),
                decoration: BoxDecoration(
                  color: primaryColor.withOpacity(0.08),
                  borderRadius: BorderRadius.circular(14),
                  border: Border.all(color: primaryColor.withOpacity(0.2)),
                ),
                child: Column(
                  children: [
                    FaIcon(FontAwesomeIcons.store, color: primaryColor, size: 36),
                    const SizedBox(height: 12),
                    Text(
                      isFr ? "Frais d'adhésion" : "Membership fee",
                      style: GoogleFonts.poppins(
                          fontSize: 16, fontWeight: FontWeight.w600),
                      textAlign: TextAlign.center,
                    ),
                    const SizedBox(height: 6),
                    Text(
                      "2 000 FCFA",
                      style: GoogleFonts.poppins(
                          fontSize: 28,
                          fontWeight: FontWeight.w700,
                          color: primaryColor),
                      textAlign: TextAlign.center,
                    ),
                    const SizedBox(height: 6),
                    Text(
                      isFr ? "Paiement unique, non répétable." : "One-time payment, non-repeatable.",
                      style: GoogleFonts.poppins(
                          fontSize: 12, color: Colors.grey[500]),
                      textAlign: TextAlign.center,
                    ),
                  ],
                ),
              ),
              const SizedBox(height: 16),
              // Description avantages
              Container(
                padding: const EdgeInsets.all(14),
                decoration: BoxDecoration(
                  color: isDark ? Colors.grey[850] : Colors.grey[50],
                  borderRadius: BorderRadius.circular(12),
                  border: Border.all(
                      color: isDark ? Colors.grey[700]! : Colors.grey[200]!),
                ),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      isFr ? "Avantages vendeur :" : "Vendor benefits:",
                      style: GoogleFonts.poppins(
                          fontWeight: FontWeight.w600, fontSize: 14),
                    ),
                    const SizedBox(height: 10),
                    _buildAvantage(
                      FontAwesomeIcons.tag,
                      isFr
                          ? "10% de réduction sur toutes les formules de promotion réseau"
                          : "10% discount on all network promotion packages",
                    ),
                    const SizedBox(height: 8),
                    _buildAvantage(
                      FontAwesomeIcons.wallet,
                      isFr
                          ? "Solde rechargeable utilisable à tout moment"
                          : "Rechargeable balance usable at any time",
                    ),
                    const SizedBox(height: 8),
                    _buildAvantage(
                      FontAwesomeIcons.chartLine,
                      isFr
                          ? "Tableau de bord vendeur avec suivi de vos performances"
                          : "Vendor dashboard with performance tracking",
                    ),
                    const SizedBox(height: 8),
                    _buildAvantage(
                      FontAwesomeIcons.star,
                      isFr
                          ? "Badge vendeur visible sur votre profil"
                          : "Vendor badge visible on your profile",
                    ),
                    const SizedBox(height: 8),
                    _buildAvantage(
                      FontAwesomeIcons.headset,
                      isFr
                          ? "Assistance prioritaire réservée aux vendeurs"
                          : "Priority support reserved for vendors",
                    ),
                  ],
                ),
              ),
              const SizedBox(height: 24),
              // Sélecteur méthode de paiement
              Text(
                isFr
                    ? "Méthode de paiement"
                    : "Payment method",
                style: GoogleFonts.poppins(
                    fontWeight: FontWeight.w600,
                    fontSize: 13,
                    color: Colors.grey[600]),
              ),
              const SizedBox(height: 8),
              _loadingMethods
                  ? const Center(
                      child: CircularProgressIndicator(color: primaryColor))
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
              const SizedBox(height: 20),
              // Recharge initiale (obligatoire)
              Text(
                isFr
                    ? "Recharge initiale (obligatoire, min 500 FCFA)"
                    : "Initial recharge (required, min 500 FCFA)",
                style: GoogleFonts.poppins(
                    fontWeight: FontWeight.w600,
                    fontSize: 13,
                    color: Colors.grey[600]),
              ),
              const SizedBox(height: 8),
              TextField(
                controller: _montantRechargeController,
                keyboardType: TextInputType.number,
                onChanged: (_) {
                  if (_erreurMontant != null) setState(() => _erreurMontant = null);
                },
                decoration: InputDecoration(
                  hintText: isFr ? "Ex : 5000" : "e.g. 5000",
                  border: const OutlineInputBorder(),
                  suffixText: "FCFA",
                  errorText: _erreurMontant,
                ),
              ),
              const SizedBox(height: 24),
              // Bouton payer
              ValueListenableBuilder<TextEditingValue>(
                valueListenable: _montantRechargeController,
                builder: (context, value, _) {
                  final int recharge = int.tryParse(value.text.trim()) ?? 0;
                  final int total = 2000 + (recharge > 0 ? recharge : 0);
                  final String totalStr = total.toString().replaceAllMapped(
                    RegExp(r'(\d)(?=(\d{3})+$)'),
                    (m) => '${m[1]} ',
                  );
                  return SizedBox(
                    width: double.infinity,
                    child: ElevatedButton(
                      style: ElevatedButton.styleFrom(
                        backgroundColor: primaryColor,
                        shape: const StadiumBorder(),
                        padding: const EdgeInsets.symmetric(vertical: 14),
                      ),
                      onPressed: _desactive ? null : _payerAdhesion,
                      child: Text(
                        _desactive
                            ? (isFr ? "Patientez..." : "Wait...")
                            : (isFr ? "Payer $totalStr FCFA" : "Pay $totalStr FCFA"),
                        style: GoogleFonts.poppins(
                            color: Colors.white, fontWeight: FontWeight.w600),
                      ),
                    ),
                  );
                },
              ),
              const SizedBox(height: 16),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildAvantage(IconData icon, String text) {
    return Row(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        FaIcon(icon, size: 14, color: primaryColor),
        const SizedBox(width: 10),
        Expanded(
          child: Text(
            text,
            style: GoogleFonts.poppins(fontSize: 13, color: Colors.grey[700]),
          ),
        ),
      ],
    );
  }
}
