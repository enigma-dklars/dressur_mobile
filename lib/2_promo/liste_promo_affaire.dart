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
          icon: const Icon(Icons.arrow_back, size: 30, color: Colors.white),
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
          icon: const Icon(Icons.arrow_back, size: 30, color: Colors.white),
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
  dynamic idFormulBoost = 1;
  dynamic valueMethodePaiement = "mtn";
  String? boostId;
  final telController = TextEditingController(text: tel);

  List<Map<String, dynamic>> listeDesFormules = [];
  int value = 0;
  var label = "";
  int prix = 0;
  int jours = 0;

  void listeFormulePromoAffaire() async {
    bool isConnected = await isConnectedToInternet();

    if (isConnected) {
      setState(() {
        _desactive2 = true;
        loading_formule_payant = true;
      });

      var request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/listeFormulePromoAffaire'));
      request.fields.addAll({});

      http.StreamedResponse response = await request.send();

      if (response.statusCode == 200) {
        var data1 = await response.stream.bytesToString();

        var data = convert.jsonDecode(data1);
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
      if (langUserPhone != "fr") {
        dangerNoti(
            "Mistake!", "You are not connected to the internet.", context);
      } else {
        dangerNoti("Erreur!", "Vous n'ètes pas connecté a internet.", context);
      }

      setState(() {
        _desactive2 = false;
        loading_formule_payant = false;
      });
    }
  }

  onChangeFormulBoost(val) async {
    for (var service in listeDesFormules) {
      if ("$val" == "${service['value']}") {
        setState(() {
          value = service['value'];
          label = service['label'];
          prix = service['prix'];
          jours = service['jours'];
        });
      }
    }

    setState(() {
      idFormulBoost = val;
      _message = (langUserPhone == "fr")
          ? "Cette formule vous offre une promotion affaire de $jours jour(s) pour $prix FCFA."
          : "This formula offers you a business promotion of $jours day(s) for $prix FCFA.";
    });
  }

  onChangeMethodePaiement(val) async {
    setState(() {
      valueMethodePaiement = val;
    });
  }

  void newPromoPayant() async {
    if (telIsVerified == true) {
      bool isConnected = await isConnectedToInternet();

      if (isConnected) {
        setState(() {
          _desactive2 = true;
        });

        var request = http.MultipartRequest(
            'POST', Uri.parse('$generalRouteForApi/newPromoPayant'));
        request.fields.addAll({
          'uid': uidUser,
          'idPromotion': widget.promotion.id,
          'langUserPhone': langUserPhone.toString(),
          'idFormulBoost': idFormulBoost.toString(),
          'valueMethodePaiement': valueMethodePaiement,
          'tel': telController.text
        });

        http.StreamedResponse response = await request.send();

        if (response.statusCode == 200) {
          var data1 = await response.stream.bytesToString();

          var data = convert.jsonDecode(data1);
          if (data["error"] == false) {
            setState(() {
              _desactive2 = false;
            });
            if (data["direct"] == true) {
              dangerNoti(
                  (langUserPhone == "fr") ? "Attention !!!" : "Attention !!!",
                  (langUserPhone == "fr")
                      ? "Après confirmation du paiement, veuillez consulter la liste de vos promotions affaires."
                      : "After confirmation of payment, please consult the list of your business promotions.",
                  context);
            } else {
              launchPaiement(data["url"]);
              Navigator.pop(context);
              showNotification(
                  (langUserPhone == "fr")
                      ? "Paiement en cours !"
                      : "Payment in progress !",
                  (langUserPhone == "fr")
                      ? "Après confirmation du paiement, veuillez consulter la liste de vos promotions affaires."
                      : "After confirmation of payment, please consult the list of your business promotions.");
            }
            // var idTransaction = data["idTransaction"];
          } else {
            dangerNoti(data["titre"], data["message"], context);

            setState(() {
              _desactive2 = false;
            });
          }
        }
      } else {
        if (langUserPhone != "fr") {
          dangerNoti(
              "Mistake!", "You are not connected to the internet.", context);
        } else {
          dangerNoti(
              "Erreur!", "Vous n'ètes pas connecté a internet.", context);
        }

        setState(() {
          _desactive2 = false;
        });
      }
    } else {
      dangerNoti("Accès Refusé !",
          "Veuillez d'abord confirmer votre numéro WhatsApp.", context);

      setState(() {
        _desactive2 = false;
      });
    }
  }

  @override
  void initState() {
    super.initState(); // Loading the diary when the app starts
    listeFormulePromoAffaire();
  }

  @override
  void dispose() {
    telController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
          'Page de Démarrage Payant',
          style: GoogleFonts.poppins(
            fontWeight: FontWeight.w400,
            color: Colors.white,
          ),
        ),
        leading: IconButton(
          onPressed: () {
            Navigator.pop(context);
          },
          icon: const Icon(
            Icons.arrow_back,
            size: 30,
            color: Colors.white,
          ),
        ),
        backgroundColor: primaryColor,
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          children: [
            loading_formule_payant
                ? const Center(
                    child: CircularProgressIndicator(),
                  )
                : SelectFormField(
                    decoration: const InputDecoration(
                      labelText: 'Formules de Promotion Affaire Payant',
                      border: OutlineInputBorder(),
                    ),
                    type: SelectFormFieldType.dropdown,
                    initialValue: '0',
                    labelText: 'Formules de Promotion Payante',
                    items: listeDesFormules,
                    onChanged: (val) => onChangeFormulBoost(val),
                    onSaved: (val) => print(val),
                  ),
            const SizedBox(height: 20),
            Text(
              _message,
              style: GoogleFonts.poppins(
                fontSize: 16,
              ),
              textAlign: TextAlign.center,
            ),
            const SizedBox(height: 20),
            SelectFormField(
              decoration: const InputDecoration(
                labelText: 'Moyen de paiement mobile ou par carte',
                border: OutlineInputBorder(),
              ),
              type: SelectFormFieldType.dropdown,
              initialValue: 'mtn',
              labelText: 'Moyen de paiement mobile ou par carte',
              items: listeMethodePaiements,
              onChanged: (val) => onChangeMethodePaiement(val),
              onSaved: (val) => print(val),
            ),
            const SizedBox(height: 20),
            TextField(
              controller: telController,
              decoration: const InputDecoration(
                labelText: 'Indicatif + Numéro du paiement',
                border: OutlineInputBorder(),
              ),
            ),
            const SizedBox(height: 10),
            SizedBox(
              width: MediaQuery.of(context).size.width * 0.95,
              child: ElevatedButton(
                style: ElevatedButton.styleFrom(
                  backgroundColor: primaryColor,
                  shape: const StadiumBorder(),
                  padding: const EdgeInsets.symmetric(
                    vertical: 13,
                  ),
                ),
                child: Text(
                  _desactive2
                      ? (langUserPhone == "fr")
                          ? "Patientez..."
                          : "Wait..."
                      : (langUserPhone == "fr")
                          ? "Payer et Booster"
                          : "Pay and Boost",
                  style: GoogleFonts.poppins(
                    color: Colors.white,
                  ),
                ),
                onPressed: () {
                  if (!telIsVerified) {
                    showConfNumeroWhatsapp(context);
                  } else if (!mailIsVerified) {
                    warningNoti(
                        "Configuration du compte",
                        "Veuillez d'abord confirmer votre adresse mail...",
                        context);
                  } else {
                    _desactive2 ? null : newPromoPayant();
                  }
                },
              ),
            ),
            const SizedBox(height: 10),
          ],
        ),
      ),
    );
  }
}
