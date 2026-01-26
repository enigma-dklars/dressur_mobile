// ignore_for_file: non_constant_identifier_names, use_build_context_synchronously

import 'dart:convert';
import 'dart:convert' as convert;
import 'package:cached_network_image/cached_network_image.dart';
import 'package:dressur/2_promo/edit_promo_affaire_produit_service.dart';
import 'package:dressur/components/noti.dart';
import 'package:dressur/components/noti_sys.dart';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:http/http.dart' as http;
import 'package:dressur/5_autre/support_assistance.dart';
import 'package:dressur/components/constant.dart';
import 'package:select_form_field/select_form_field.dart';

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

  Widget _buildPromotionCard(Promotion promotion) {
    return Card(
      margin: const EdgeInsets.symmetric(horizontal: 10, vertical: 5),
      child: Padding(
        padding: const EdgeInsets.all(15.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            SingleChildScrollView(
              scrollDirection: Axis.horizontal,
              child: Row(
                children: [
                  _buildTypePromoAffaire(promotion.typePromotionAffaire),
                  SizedBox(width: 5),
                  _buildStatusLabel(promotion.status),
                ],
              ),
            ),
            const SizedBox(height: 5),
            if ([
              "Completed",
              "Terminé",
              "Accept and in progress",
              "Accepter et en cours",
              "Waiting for validation",
              "En Attente de validation",
              "Accept and pending payment",
              "Accepter et en attente de paiement"
            ].contains(promotion.status)) ...[
              Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  Text(
                    'Impressions: ${promotion.nombreImpression}',
                    style: const TextStyle(
                        fontSize: 14, fontWeight: FontWeight.bold),
                  ),
                  Text(
                    (langUserPhone == "fr")
                        ? 'Vues: ${promotion.nombreDeVues}'
                        : 'Views: ${promotion.nombreDeVues}',
                    style: const TextStyle(
                        fontSize: 14, fontWeight: FontWeight.bold),
                  ),
                ],
              ),
              const SizedBox(height: 5),
              Text(
                promotion.description.replaceAll('\n', ' '),
                style: GoogleFonts.poppins(fontSize: 14),
                maxLines: 3,
                overflow: TextOverflow.ellipsis,
              ),
            ] else ...[
              Text(
                (langUserPhone == "fr")
                    ? "Motif : ${promotion.motif}"
                    : "Pattern : ${promotion.motif}",
                style: const TextStyle(
                  color: Colors.red,
                  fontWeight: FontWeight.w500,
                  fontSize: 16,
                ),
              ),
              const SizedBox(height: 5),
              if (promotion.typePromotionAffaire != "produit_service") ...[
                Text(
                  (langUserPhone == "fr")
                      ? "Tenez compte du motif de refus pour soumettre une nouvelle promotion. Merci..."
                      : "Please consider the reason for refusal to submit a new promotion. Thank you...",
                  style: const TextStyle(
                    color: Colors.green,
                    fontWeight: FontWeight.w500,
                    fontSize: 16,
                  ),
                ),
              ] else ...[
                Text(
                  (langUserPhone == "fr")
                      ? "Tenez compte du motif de refus pour modifier votre promotion. Merci..."
                      : "Please consider the reason for refusal to modify your promotion. Thank you...",
                  style: const TextStyle(
                    color: Colors.green,
                    fontWeight: FontWeight.w500,
                    fontSize: 16,
                  ),
                ),
              ]
            ],
            const SizedBox(height: 5),
            Row(
              mainAxisAlignment: (promotion.peutPayer ||
                      ![
                            "Completed",
                            "Terminé",
                            "Accept and in progress",
                            "Accepter et en cours",
                            "Waiting for validation",
                            "En Attente de validation",
                            "Accept and pending payment",
                            "Accepter et en attente de paiement"
                          ].contains(promotion.status) &&
                          promotion.typePromotionAffaire == "produit_service")
                  ? MainAxisAlignment.spaceBetween
                  : MainAxisAlignment.end,
              children: [
                if (promotion.peutPayer &&
                    promotion.typePromotionAffaire == "produit_service")
                  ElevatedButton.icon(
                    style: ElevatedButton.styleFrom(
                      backgroundColor: Colors.orange,
                      padding: const EdgeInsets.symmetric(
                          vertical: 0, horizontal: 15),
                    ),
                    onPressed: () {
                      Navigator.push(
                        context,
                        MaterialPageRoute(
                          builder: (context) =>
                              PaymentPayantPage(promotion: promotion),
                        ),
                      );
                    },
                    label: Text(
                      (langUserPhone == "fr") ? 'Payer' : 'Pay',
                      style: GoogleFonts.poppins(
                          color: Colors.white,
                          fontWeight: FontWeight.w400,
                          fontSize: 13),
                    ),
                    icon: const Icon(Icons.payment,
                        color: Colors.white, size: 13),
                  ),
                if (![
                      "Completed",
                      "Terminé",
                      "Accept and in progress",
                      "Accepter et en cours",
                      "Waiting for validation",
                      "En Attente de validation",
                      "Accept and pending payment",
                      "Accepter et en attente de paiement"
                    ].contains(promotion.status) &&
                    promotion.typePromotionAffaire == "produit_service")
                  ElevatedButton.icon(
                    style: ElevatedButton.styleFrom(
                      backgroundColor: Colors.green,
                      padding: const EdgeInsets.symmetric(
                          vertical: 0, horizontal: 15),
                    ),
                    onPressed: () {
                      Navigator.push(
                        context,
                        MaterialPageRoute(
                          builder: (context) => ModificationProduitServicesPage(
                              promotion: promotion),
                        ),
                      );
                    },
                    label: Text(
                      (langUserPhone == "fr") ? 'Modifier' : 'Edit',
                      style: GoogleFonts.poppins(
                          color: Colors.white,
                          fontWeight: FontWeight.w400,
                          fontSize: 13),
                    ),
                    icon: const Icon(Icons.edit, color: Colors.white, size: 13),
                  ),
                ElevatedButton.icon(
                  style: ElevatedButton.styleFrom(
                    backgroundColor: secondaryColor,
                    padding:
                        const EdgeInsets.symmetric(vertical: 0, horizontal: 15),
                  ),
                  label: Text(
                    (langUserPhone == "fr") ? 'Autres ' : 'Other ',
                    style: GoogleFonts.poppins(
                        color: Colors.white,
                        fontWeight: FontWeight.w400,
                        fontSize: 13),
                  ),
                  icon: const Icon(Icons.info, color: Colors.white, size: 13),
                  onPressed: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(
                        builder: (context) =>
                            PromotionDetailPage(promotion: promotion),
                      ),
                    );
                  },
                ),
              ],
            ),
          ],
        ),
      ),
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
                    style: const TextStyle(fontSize: 16),
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

  @override
  Widget build(BuildContext context) {
    final Map<String, dynamic> infoMap = (promotion.annotherInfo != "")
        ? jsonDecode(promotion.annotherInfo)
        : {};
    return Scaffold(
      appBar: AppBar(
        title: Text(
          (langUserPhone == "fr")
              ? 'Détails de la promotion'
              : 'Details of the promotion',
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
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            ClipRRect(
              borderRadius: BorderRadius.circular(3),
              child: CachedNetworkImage(
                imageUrl: promotion.image,
                placeholder: (context, url) =>
                    Image.asset('images/placeholder.png'),
                errorWidget: (context, url, error) =>
                    Image.asset('images/error_image.png'),
                fit: BoxFit.cover,
              ),
            ),
            if (promotion.peutPayer)
              Column(
                children: [
                  const SizedBox(height: 10),
                  const Divider(height: 1, thickness: 1, color: Colors.grey),
                  const SizedBox(height: 5),
                  Text(
                    (langUserPhone == "fr")
                        ? 'Votre demande de promotion a été acceptée.'
                        : 'Your promotion request has been accepted.',
                    style: GoogleFonts.poppins(
                        fontSize: 16, fontWeight: FontWeight.w600),
                    textAlign: TextAlign.center,
                  ),
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceAround,
                    children: [
                      ElevatedButton.icon(
                        style: ElevatedButton.styleFrom(
                          backgroundColor: Colors.orange,
                          padding: const EdgeInsets.symmetric(
                              vertical: 0, horizontal: 15),
                        ),
                        icon: const Icon(Icons.payment,
                            color: Colors.white, size: 13),
                        onPressed: () {
                          Navigator.push(
                            context,
                            MaterialPageRoute(
                              builder: (context) =>
                                  PaymentPayantPage(promotion: promotion),
                            ),
                          );
                        },
                        label: Text(
                          (langUserPhone == "fr") ? 'Payer' : 'Pay',
                          style: GoogleFonts.poppins(
                              color: Colors.white,
                              fontWeight: FontWeight.w400,
                              fontSize: 13),
                        ),
                      ),
                    ],
                  ),
                  const SizedBox(height: 5),
                  const Divider(height: 1, thickness: 1, color: Colors.grey),
                ],
              ),
            const SizedBox(height: 10),
            Text(
              (langUserPhone == "fr")
                  ? 'Formule de promotion : ${promotion.formulePromotion}'
                  : 'Promo formula: ${promotion.formulePromotion}',
            ),
            const SizedBox(height: 16.0),
            Text(
              (langUserPhone == "fr")
                  ? 'Nombre de vues : ${promotion.nombreDeVues}'
                  : 'Number of views: ${promotion.nombreDeVues}',
            ),
            const SizedBox(height: 16.0),
            Text('Status: ${promotion.status}'),
            const SizedBox(height: 16.0),
            Text(
              (langUserPhone == "fr")
                  ? 'Date de début : ${promotion.dateDebut}'
                  : 'Start date: ${promotion.dateDebut}',
            ),
            const SizedBox(height: 16.0),
            Text(
              (langUserPhone == "fr")
                  ? "Date d'expiration : ${promotion.dateExp}"
                  : "Expiration date: ${promotion.dateExp}",
            ),
            const SizedBox(height: 16.0),
            Text(promotion.description),
            const SizedBox(height: 16.0),
            Column(
              children: infoMap.entries.map((entry) {
                final key = entry.key.replaceAll('_', ' ').capitalize();
                final value = entry.value;

                return Padding(
                  padding: const EdgeInsets.only(bottom: 8.0),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        '$key :',
                        style: const TextStyle(
                          fontWeight: FontWeight.bold,
                          color: Colors
                              .blue, // Replace with your theme's primary color if needed
                          fontSize: 16,
                        ),
                      ),
                      const SizedBox(height: 4),
                      Text(
                        value,
                        style: const TextStyle(
                          fontSize: 14,
                        ),
                        softWrap: true, // Wraps text within the container
                      ),
                      const Divider(),
                    ],
                  ),
                );
              }).toList(),
            ),
          ],
        ),
      ),
    );
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
          style: TextStyle(
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
              style: TextStyle(
                  fontSize: isSmall ? 11 : 13,
                  fontWeight: isBold ? FontWeight.bold : FontWeight.normal)),
          Text("${amount.toStringAsFixed(0)} F",
              style: TextStyle(
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
              subtitle: const Text("Récompensez les partages statut WhatsApp.",
                  style: TextStyle(fontSize: 11)),
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
                        const Expanded(
                            child: Text("Objectif de vues (min. 2500)",
                                style: TextStyle(fontSize: 13))),
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
              subtitle: const Text(
                  "Visibilité maximale sur notre statut officiel.",
                  style: TextStyle(fontSize: 11)),
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
