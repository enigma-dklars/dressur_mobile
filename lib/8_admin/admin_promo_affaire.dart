import 'dart:convert';
import 'dart:convert' as convert;
import 'package:dressur/components/delayed_animation.dart';
import 'package:dressur/components/noti.dart';
import 'package:dressur/components/sql_helper.dart';
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
  });
}

class AdminPromotionListPage extends StatefulWidget {
  @override
  _AdminPromotionListPageState createState() => _AdminPromotionListPageState();
}

class _AdminPromotionListPageState extends State<AdminPromotionListPage> {
  bool _loading = false;
  List<Promotion> _promotions = [];
  var motifRefusController = TextEditingController();

  void _showModalRefuser(String id, BuildContext context) async {
    setState(() {
      motifRefusController.text = "";
    });

    showModalBottomSheet(
      context: context,
      elevation: 5,
      isScrollControlled: true,
      builder: (BuildContext context) {
        return Padding(
          padding: EdgeInsets.only(
            top: 15,
            left: 15,
            right: 15,
            bottom: MediaQuery.of(context).viewInsets.bottom + 15,
          ),
          child: SingleChildScrollView(
            child: Column(
              mainAxisSize: MainAxisSize.min,
              crossAxisAlignment: CrossAxisAlignment.end,
              children: [
                const SizedBox(height: 20),
                Text(
                  "Motif Refus",
                  style: GoogleFonts.poppins(
                    fontWeight: FontWeight.w400,
                    fontSize: 16,
                  ),
                ),
                const SizedBox(height: 10),
                TextField(
                  controller: motifRefusController,
                  decoration: const InputDecoration(
                    border: OutlineInputBorder(),
                  ),
                ),
                const SizedBox(height: 10),
                ElevatedButton(
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.red,
                    padding: const EdgeInsets.symmetric(
                      horizontal: 55,
                      vertical: 13,
                    ),
                  ),
                  onPressed: () async {
                    _loading ? null : refuser(id, motifRefusController.text);
                  },
                  child: Text(
                    "Envoyer",
                    style: GoogleFonts.poppins(
                      fontWeight: FontWeight.w400,
                      color: Colors.white,
                    ),
                  ),
                ),
                const SizedBox(
                    height: 10), // Added bottom padding to avoid overlap
              ],
            ),
          ),
        );
      },
    );
  }

  Future<void> refuser(String id, String motif) async {
    print(motif);
    setState(() {
      _loading = true;
    });
    final url =
        Uri.parse('$generalRouteForApi/adminListPromotion/refuser/$id/$motif');

    try {
      final response = await http.get(url);
      if (response.statusCode == 200) {
        setState(() {
          _promotions.removeWhere((promotion) => promotion.id == id);
          _loading = false;
          Navigator.of(context).pop();
        });
      } else {
        showErrorDialog(response.statusCode);
      }
    } catch (e) {
      showErrorDialog(-1); // Handle network errors
    }
  }

  Future<void> accepter(String id) async {
    setState(() {
      _loading = true;
    });
    final url =
        Uri.parse('$generalRouteForApi/adminListPromotion/accepter/$id');

    try {
      final response = await http.get(url);
      if (response.statusCode == 200) {
        setState(() {
          _promotions.removeWhere((promotion) => promotion.id == id);
          _loading = false;
        });
      } else {
        showErrorDialog(response.statusCode);
      }
    } catch (e) {
      showErrorDialog(-1); // Handle network errors
    }
  }

  void showErrorDialog(int statusCode) {
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          title: Text('Erreur'),
          content: Text(
            (langUserPhone == "fr")
                ? "Échec de récupération des promotions. Code d'erreur: $statusCode"
                : "Failed to retrieve promotions. Error code: $statusCode",
          ),
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

  Future<void> fetchPromotions() async {
    setState(() {
      _loading = true;
    });
    try {
      final url = Uri.parse('$generalRouteForApi/adminListPromotion');
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
          'An error occurred while fetching promotions. Please try again.');
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

  Widget _buildPromotionCard(Promotion promotion) {
    return Card(
      margin: const EdgeInsets.symmetric(horizontal: 10, vertical: 5),
      child: Padding(
        padding: const EdgeInsets.all(15.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            _buildStatusLabel(promotion.status),
            const SizedBox(height: 5),
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
              promotion.description,
              style: GoogleFonts.poppins(fontSize: 14),
              maxLines: 3,
              overflow: TextOverflow.ellipsis,
            ),
            const SizedBox(height: 5),
            Row(
              mainAxisAlignment: promotion.peutPayer
                  ? MainAxisAlignment.spaceBetween
                  : MainAxisAlignment.end,
              children: [
                if (promotion.peutPayer)
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
                ElevatedButton.icon(
                  style: ElevatedButton.styleFrom(
                    backgroundColor: secondaryColor,
                    padding:
                        const EdgeInsets.symmetric(vertical: 0, horizontal: 15),
                  ),
                  label: Text(
                    (langUserPhone == "fr")
                        ? 'Autres Informations'
                        : 'Other information',
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
            const SizedBox(height: 5),
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                SizedBox(
                  width: MediaQuery.of(context).size.width * 0.42,
                  child: ElevatedButton.icon(
                    style: ElevatedButton.styleFrom(
                      backgroundColor: secondaryColor,
                      padding: const EdgeInsets.symmetric(
                          vertical: 0, horizontal: 15),
                    ),
                    label: Text(
                      "Accepter",
                      style: GoogleFonts.poppins(
                        color: Colors.white,
                        fontWeight: FontWeight.w400,
                        fontSize: 13,
                      ),
                    ),
                    icon: const Icon(
                      Icons.check,
                      color: Colors.white,
                      size: 13,
                    ),
                    onPressed: () {
                      accepter(promotion.id);
                    },
                  ),
                ),
                SizedBox(
                  width: MediaQuery.of(context).size.width * 0.42,
                  child: ElevatedButton.icon(
                    style: ElevatedButton.styleFrom(
                      backgroundColor: Colors.red,
                      padding: const EdgeInsets.symmetric(
                          vertical: 0, horizontal: 15),
                    ),
                    label: Text(
                      "Refuser",
                      style: GoogleFonts.poppins(
                        color: Colors.white,
                        fontWeight: FontWeight.w400,
                        fontSize: 13,
                      ),
                    ),
                    icon: const Icon(
                      Icons.delete,
                      color: Colors.white,
                      size: 13,
                    ),
                    onPressed: () {
                      _showModalRefuser(promotion.id, context);
                    },
                  ),
                ),
              ],
            ),
          ],
        ),
      ),
    );
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
            fontSize: 14, color: Colors.white, fontWeight: FontWeight.bold),
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Colors.red,
        title: Text(
          "Admin Promo. Affaire",
          style: GoogleFonts.poppins(
              fontWeight: FontWeight.w400, color: Colors.white),
        ),
        leading: IconButton(
          onPressed: () {
            Navigator.pop(context);
          },
          icon: const Icon(Icons.arrow_back, size: 30, color: Colors.white),
        ),
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
            Image.network(promotion.image),
            if (promotion.peutPayer)
              Column(
                children: [
                  const SizedBox(height: 5),
                  const Divider(height: 1, thickness: 1, color: Colors.grey),
                  const SizedBox(height: 5),
                  Text(
                    (langUserPhone == "fr")
                        ? 'Votre demande de promotion a été acceptée. Vous pouvez démarrer la promotion à titre gratuite ou payante.'
                        : 'Your promotion request has been accepted. You can start the promotion for free or paid.',
                    style: GoogleFonts.poppins(
                        fontSize: 16, fontWeight: FontWeight.w600),
                    textAlign: TextAlign.center,
                  ),
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceAround,
                    children: [
                      ElevatedButton(
                        onPressed: () {
                          Navigator.push(
                            context,
                            MaterialPageRoute(
                              builder: (context) =>
                                  PaymentGratuitPage(promotion: promotion),
                            ),
                          );
                        },
                        child:
                            Text((langUserPhone == "fr") ? 'Gratuite' : 'Free'),
                      ),
                      ElevatedButton(
                        onPressed: () {
                          Navigator.push(
                            context,
                            MaterialPageRoute(
                              builder: (context) =>
                                  PaymentPayantPage(promotion: promotion),
                            ),
                          );
                        },
                        child:
                            Text((langUserPhone == "fr") ? 'Payante' : 'Paid'),
                      ),
                    ],
                  ),
                  const Divider(height: 1, thickness: 1, color: Colors.grey),
                ],
              ),
            const SizedBox(height: 16.0),
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
          ],
        ),
      ),
    );
  }
}

class PaymentGratuitPage extends StatefulWidget {
  final Promotion promotion;

  PaymentGratuitPage({required this.promotion});

  @override
  _PaymentGratuitPageState createState() => _PaymentGratuitPageState();
}

class _PaymentGratuitPageState extends State<PaymentGratuitPage> {
  bool _desactive = false;
  var _message = "";
  dynamic data;
  dynamic idFormulBoost = 1;
  String? boostId;

  List<Map<String, dynamic>> listeDesFormules = [];
  int value = 0;
  var label = "";
  int prix = 0;
  int jours = 0;

  void listeFormuleBoost() async {
    dynamic youHaveNetWork = "";
    youHaveConnexion();
    youHaveNetWork = await SQLHelper.getYouHaveConnexion();
    while (youHaveNetWork.length == 0) {
      youHaveNetWork = await SQLHelper.getYouHaveConnexion();
    }
    if (youHaveNetWork[0]['youHaveConnexion'] == "oui") {
      setState(() {
        _desactive = true;
      });

      var request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/listeFormuleBoost'));
      request.fields.addAll({});

      http.StreamedResponse response = await request.send();

      if (response.statusCode == 200) {
        var data1 = await response.stream.bytesToString();
        var data = convert.jsonDecode(data1);
        if (data["error"] == false) {
          setState(() {
            _desactive = false;
            listeDesFormules = (data["listeFormulBoost"] as List<dynamic>)
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
        _desactive = false;
      });
    }
  }

  void newPromo() async {
    if (telIsVerified == true) {
      dynamic youHaveNetWork = "";
      youHaveConnexion();
      youHaveNetWork = await SQLHelper.getYouHaveConnexion();
      while (youHaveNetWork.length == 0) {
        youHaveNetWork = await SQLHelper.getYouHaveConnexion();
      }
      if (youHaveNetWork[0]['youHaveConnexion'] == "oui") {
        setState(() {
          _desactive = true;
        });

        var request = http.MultipartRequest(
            'POST', Uri.parse('$generalRouteForApi/newPromo'));
        request.fields.addAll({
          'uid': uidUser,
          'idPromotion': widget.promotion.id,
          'langUserPhone': langUserPhone.toString(),
          'idFormulBoost': idFormulBoost.toString()
        });

        http.StreamedResponse response = await request.send();

        if (response.statusCode == 200) {
          var data1 = await response.stream.bytesToString();
          var data = convert.jsonDecode(data1);
          if (data["error"] == false) {
            setState(() {
              _desactive = false;
              ScaffoldMessenger.of(context).showSnackBar(SnackBar(
                backgroundColor: Colors.green,
                behavior: SnackBarBehavior.floating,
                content: Text(
                  'Votre Promo a déja démarer.',
                  style: GoogleFonts.poppins(
                    color: Colors.white,
                  ),
                ),
              ));
            });
          } else {
            dangerNoti(data["titre"], data["message"], context);
            setState(() {
              _desactive = false;
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
          _desactive = false;
        });
      }
    } else {
      dangerNoti("Accès Refusé !",
          "Veuillez d'abord confirmer votre numéro WhatsApp.", context);
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
          ? "Cette formule vous offre un boost de $jours jour(s) pour $prix FCFA."
          : "This formula offers you a boost of $jours day(s) for $prix FCFA.";
    });
  }

  @override
  void initState() {
    super.initState();
    listeFormuleBoost(); // Loading the diary when the app starts
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
          'Page de Démarrage Gratuit',
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
            DelayedAnimation(
              delay: 0, // 1500,
              child: SelectFormField(
                decoration: const InputDecoration(
                  labelText: 'Formules de Boost Payant',
                  border: OutlineInputBorder(),
                ),
                type: SelectFormFieldType.dropdown,
                initialValue: '0',
                labelText: 'Formules de Boost',
                items: listeDesFormules,
                onChanged: (val) => onChangeFormulBoost(val),
                onSaved: (val) => print(val),
              ),
            ),
            const SizedBox(height: 20),
            DelayedAnimation(
              delay: 0, // 1000,
              child: Text(
                _message,
                style: GoogleFonts.poppins(
                  fontSize: 16,
                ),
                textAlign: TextAlign.center,
              ),
            ),
            const SizedBox(height: 20),
            DelayedAnimation(
                delay: 0,
                child: SizedBox(
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
                      _desactive
                          ? (langUserPhone == "fr")
                              ? "Patientez..."
                              : "Wait..."
                          : "BOOSTER",
                      style: GoogleFonts.poppins(
                        color: Colors.white,
                      ),
                    ),
                    onPressed: () {
                      if (!telIsVerified) {
                        warningNoti(
                            "Configuration du compte",
                            "Patientez encore svp. Votre numéro WhatsApp n'a pas encore été confirmé par un administrateur. Il le sera dans les plus brefs délais.",
                            context);
                      } else if (!mailIsVerified) {
                        warningNoti(
                            "Configuration du compte",
                            "Veuillez d'abord confirmer votre adresse mail...\n\nVous trouverez sur notre chaine YouTube des vidéos qui peuvent vous aider...",
                            context);
                      } else {
                        _desactive ? null : newPromo();
                      }
                    },
                  ),
                )),
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

  void listeFormuleBoost() async {
    dynamic youHaveNetWork = "";
    youHaveConnexion();
    youHaveNetWork = await SQLHelper.getYouHaveConnexion();
    while (youHaveNetWork.length == 0) {
      youHaveNetWork = await SQLHelper.getYouHaveConnexion();
    }
    if (youHaveNetWork[0]['youHaveConnexion'] == "oui") {
      setState(() {
        _desactive2 = true;
      });

      var request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/listeFormuleBoost'));
      request.fields.addAll({});

      http.StreamedResponse response = await request.send();

      if (response.statusCode == 200) {
        var data1 = await response.stream.bytesToString();
        var data = convert.jsonDecode(data1);
        if (data["error"] == false) {
          setState(() {
            _desactive2 = false;
            listeDesFormules = (data["listeFormulBoost"] as List<dynamic>)
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
          ? "Cette formule vous offre un boost de $jours jour(s) pour $prix FCFA."
          : "This formula offers you a boost of $jours day(s) for $prix FCFA.";
    });
  }

  onChangeMethodePaiement(val) async {
    setState(() {
      valueMethodePaiement = val;
    });
  }

  void newPromoPayant() async {
    if (telIsVerified == true) {
      dynamic youHaveNetWork = "";
      youHaveConnexion();
      youHaveNetWork = await SQLHelper.getYouHaveConnexion();
      while (youHaveNetWork.length == 0) {
        youHaveNetWork = await SQLHelper.getYouHaveConnexion();
      }
      if (youHaveNetWork[0]['youHaveConnexion'] == "oui") {
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
            // var idTransaction = data["idTransaction"];
            setState(() {
              _desactive2 = false;
              dangerNoti(
                  (langUserPhone == "fr") ? "Attention !!!" : "Attention !!!",
                  (langUserPhone == "fr")
                      ? "Après confirmation du paiement, veuillez consulter la liste de vos promotions affaires."
                      : "After confirmation of payment, please consult the list of your business promotions.",
                  context);
            });
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
    listeFormuleBoost();
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
            DelayedAnimation(
              delay: 0, // 1500,
              child: SelectFormField(
                decoration: const InputDecoration(
                  labelText: 'Formules de Boost Payant',
                  border: OutlineInputBorder(),
                ),
                type: SelectFormFieldType.dropdown,
                initialValue: '0',
                labelText: 'Formules de Promotion Payante',
                items: listeDesFormules,
                onChanged: (val) => onChangeFormulBoost(val),
                onSaved: (val) => print(val),
              ),
            ),
            const SizedBox(height: 20),
            DelayedAnimation(
              delay: 0, // 1000,
              child: Text(
                _message,
                style: GoogleFonts.poppins(
                  fontSize: 16,
                ),
                textAlign: TextAlign.center,
              ),
            ),
            const SizedBox(height: 20),
            DelayedAnimation(
              delay: 0, // 1500,
              child: SelectFormField(
                decoration: const InputDecoration(
                  labelText: 'Formules de Boost Payant',
                  border: OutlineInputBorder(),
                ),
                type: SelectFormFieldType.dropdown,
                initialValue: 'mtn',
                labelText: 'Methode de paiement mobile',
                items: listeMethodePaiement,
                onChanged: (val) => onChangeMethodePaiement(val),
                onSaved: (val) => print(val),
              ),
            ),
            const SizedBox(height: 20),
            DelayedAnimation(
              delay: 0, // 1500,
              child: TextField(
                controller: telController,
                decoration: const InputDecoration(
                  labelText: 'Indicatif + Numéro du paiement',
                  border: OutlineInputBorder(),
                ),
              ),
            ),
            const SizedBox(height: 10),
            DelayedAnimation(
              delay: 0,
              child: SizedBox(
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
                      warningNoti(
                          "Configuration du compte",
                          "Patientez encore svp. Votre numéro WhatsApp n'a pas encore été confirmé par un administrateur. Il le sera dans les plus brefs délais.",
                          context);
                    } else if (!mailIsVerified) {
                      warningNoti(
                          "Configuration du compte",
                          "Veuillez d'abord confirmer votre adresse mail...\n\nVous trouverez sur notre chaine YouTube des vidéos qui peuvent vous aider...",
                          context);
                    } else {
                      _desactive2 ? null : newPromoPayant();
                    }
                  },
                ),
              ),
            ),
            const SizedBox(height: 10),
            DelayedAnimation(
              delay: 0, // 1500,
              child: Text(
                "Pour payer par Wave ou Carte Bancaire, veuillez contactez l'Assistance Dressur par WhatsApp. Merci...",
                style: GoogleFonts.poppins(
                  fontWeight: FontWeight.w600,
                  fontSize: 12,
                  color: Colors.red[400],
                ),
                textAlign: TextAlign.center,
              ),
            ),
          ],
        ),
      ),
    );
  }
}
