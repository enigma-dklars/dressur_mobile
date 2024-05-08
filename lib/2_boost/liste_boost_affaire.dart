// ignore_for_file: use_build_context_synchronously

import 'dart:convert';
import 'dart:convert' as convert;
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:http/http.dart' as http;
import 'package:select_form_field/select_form_field.dart';
import 'package:dressur/5_autre/support_assistance.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/delayed_animation.dart';
import 'package:dressur/components/noti.dart';
import 'package:dressur/components/sql_helper.dart';

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
    final url =
        Uri.parse('$generalRouteForApi/listPromotion/$uidUser/$langUserPhone');

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
        _loading = false;
      });
    } else {
      showDialog(
        context: context,
        builder: (BuildContext context) {
          return AlertDialog(
            title: const Text('Erreur'),
            content: Text((langUserPhone == "fr")
                ? "Échec de récupération des promotions. Code d'erreur:"
                : "Failed to retrieve promotions. Error code:"
                    "${response.statusCode}"),
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
  }

  @override
  void initState() {
    super.initState();
    fetchPromotions();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
          (langUserPhone == "fr")
              ? 'Liste Promotion Affaire'
              : "Business Promotion List",
          style: GoogleFonts.poppins(
            fontWeight: FontWeight.w600,
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
        actions: [
          PopupMenuButton<dynamic>(
            itemBuilder: (context) => [
              PopupMenuItem(
                value: 1,
                onTap: () {
                  fetchPromotions();
                },
                child: Row(
                  children: [
                    Text(
                      (langUserPhone == "fr") ? "Actualiser" : "Refresh",
                      style: GoogleFonts.poppins(
                        color: Colors.white,
                        fontWeight: FontWeight.w600,
                      ),
                    ),
                  ],
                ),
              ),
              PopupMenuItem(
                value: 2,
                child: Row(
                  children: [
                    Text(
                      (langUserPhone == "fr") ? "Aide" : "Help",
                      style: GoogleFonts.poppins(
                        color: Colors.white,
                        fontWeight: FontWeight.w600,
                      ),
                    ),
                  ],
                ),
              ),
            ],
            offset: const Offset(0, 60),
            color: primaryColor,
            icon: const Icon(
              Icons.menu,
              color: Colors.white,
            ),
            elevation: 2,
            onSelected: (value) {
              if (value == 2) {
                Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => SupportPage()),
                );
              }
            },
          ),
        ],
      ),
      body: _loading
          ? const Center(
              child: CircularProgressIndicator(),
            )
          : _promotions.isEmpty
              ? Center(
                  child: Text(
                    (langUserPhone == "fr")
                        ? "Aucune promotion affaire trouvée."
                        : "No deal promotions found.",
                    style: const TextStyle(fontSize: 16),
                  ),
                )
              : Expanded(
                  child: ListView.builder(
                    itemCount: _promotions.length,
                    itemBuilder: (BuildContext context, int index) {
                      final promotion = _promotions[index];

                      return Card(
                        margin: const EdgeInsets.only(
                            left: 10, top: 10, right: 10, bottom: 0),
                        child: Row(
                          children: [
                            Container(
                              height: 100,
                              width: 70,
                              decoration: BoxDecoration(
                                gradient: const LinearGradient(
                                  begin: Alignment.topCenter,
                                  end: Alignment.bottomCenter,
                                  colors: [
                                    primaryColor,
                                    secondaryColor,
                                  ],
                                ),
                                borderRadius: BorderRadius.circular(5),
                              ),
                              child: Image.network(
                                promotion.image,
                                fit: BoxFit.cover,
                              ),
                            ),
                            const SizedBox(width: 5),
                            Expanded(
                              child: Container(
                                // width: 80,
                                height: 100,
                                decoration: BoxDecoration(
                                  gradient: const LinearGradient(
                                    begin: Alignment.topCenter,
                                    end: Alignment.bottomCenter,
                                    colors: [
                                      primaryColor,
                                      secondaryColor,
                                    ],
                                  ),
                                  borderRadius: BorderRadius.circular(5),
                                ),
                                padding:
                                    const EdgeInsets.fromLTRB(15, 5, 15, 0),
                                child: Column(
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  children: [
                                    Text(
                                      'Status: ${promotion.status}',
                                      style: const TextStyle(
                                        fontSize: 12.0,
                                        fontWeight: FontWeight.bold,
                                        color: Colors.white,
                                      ),
                                    ),
                                    Text(
                                      'Impressions: ${promotion.nombreImpression}',
                                      style: const TextStyle(
                                        fontSize: 12.0,
                                        fontWeight: FontWeight.bold,
                                        color: Colors.white,
                                      ),
                                    ),
                                    Text(
                                      (langUserPhone == "fr")
                                          ? 'Vues: ${promotion.nombreDeVues}'
                                          : 'Views: ${promotion.nombreDeVues}',
                                      style: const TextStyle(
                                        fontSize: 12.0,
                                        fontWeight: FontWeight.bold,
                                        color: Colors.white,
                                      ),
                                    ),
                                    Row(
                                      mainAxisAlignment: MainAxisAlignment.end,
                                      children: [
                                        Column(
                                          children: [
                                            SizedBox(
                                              child: ElevatedButton.icon(
                                                style: ElevatedButton.styleFrom(
                                                  backgroundColor: Colors.green,
                                                ),
                                                label: Text(
                                                  (langUserPhone == "fr")
                                                      ? 'Autres Informations'
                                                      : 'Other information',
                                                  style: GoogleFonts.poppins(
                                                    color: Colors.white,
                                                    fontWeight: FontWeight.w400,
                                                  ),
                                                ),
                                                icon: const Icon(
                                                  Icons.info,
                                                  color: Colors.white,
                                                ),
                                                onPressed: () {
                                                  Navigator.push(
                                                    context,
                                                    MaterialPageRoute(
                                                      builder: (context) =>
                                                          PromotionDetailPage(
                                                        promotion: promotion,
                                                      ),
                                                    ),
                                                  );
                                                },
                                              ),
                                            ),
                                          ],
                                        ),
                                      ],
                                    ),
                                  ],
                                ),
                              ),
                            ),
                          ],
                        ),
                      );
                    },
                  ),
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
            fontWeight: FontWeight.w600,
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
                  const Padding(
                    padding:
                        EdgeInsets.only(left: 50, top: 5, right: 50, bottom: 5),
                    child: Divider(
                      height: 1,
                      thickness: 1,
                      color: Colors.grey,
                    ),
                  ),
                  const SizedBox(height: 5),
                  Text(
                    (langUserPhone == "fr")
                        ? 'Votre demande de promotion a été acceptée. Vous pouvez démarrer la promotion à titre gratuite ou payante.'
                        : "Your promotion request has been accepted. You can start the promotion for free or paid.",
                    style: GoogleFonts.poppins(
                      fontSize: 16,
                      fontWeight: FontWeight.w600,
                    ),
                    textAlign: TextAlign.center,
                  ),
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
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
                        child: Text(
                          (langUserPhone == "fr") ? 'Gratuite' : "Free",
                        ),
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
                        child: Text(
                          (langUserPhone == "fr") ? 'Payante' : "Paid",
                        ),
                      ),
                    ],
                  ),
                  const Padding(
                    padding:
                        EdgeInsets.only(left: 50, top: 5, right: 50, bottom: 5),
                    child: Divider(
                      height: 1,
                      thickness: 1,
                      color: Colors.grey,
                    ),
                  ),
                ],
              ),
            const SizedBox(height: 16.0),
            Text(
              (langUserPhone == "fr")
                  ? 'Formule de promotion : ${promotion.formulePromotion}'
                  : 'Promo formula: : ${promotion.formulePromotion}',
            ),
            const SizedBox(height: 16.0),
            Text(
              (langUserPhone == "fr")
                  ? 'Nombre de vues : ${promotion.nombreDeVues}'
                  : 'Number of views : ${promotion.nombreDeVues}',
            ),
            const SizedBox(height: 16.0),
            Text('Status : ${promotion.status}'),
            const SizedBox(height: 16.0),
            Text(
              (langUserPhone == "fr")
                  ? 'Date de début : ${promotion.dateDebut}'
                  : 'Start date : ${promotion.dateDebut}',
            ),
            const SizedBox(height: 16.0),
            Text((langUserPhone == "fr")
                ? "Date d'expiration : ${promotion.dateExp}"
                : "Expiration date : ${promotion.dateExp}"),
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
  List<Map<String, dynamic>> listeFormulBoost = [];
  String? boostId;

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
          SQLHelper.delete('listeFormulBoost');
          for (var listeFormulBoost in data["listeFormulBoost"]) {
            SQLHelper.insert({
              'tableName': "listeFormulBoost",
              'value': listeFormulBoost['id'],
              'label': listeFormulBoost['label'],
              'prix': listeFormulBoost['prix'],
              'jours': listeFormulBoost['jours']
            });
          }
          final dataElements = await SQLHelper.getAll("listeFormulBoost");
          setState(() {
            _desactive = false;
            listeFormulBoost = dataElements;
            onChangeFormulBoost(1);
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
              ScaffoldMessenger.of(context).showSnackBar(const SnackBar(
                content: Text('Votre Promo a déja démarer.'),
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
    var prix = (await SQLHelper.getFormulBoostWhithId(val))[0]['prix'];
    var jours = (await SQLHelper.getFormulBoostWhithId(val))[0]['jours'];
    setState(() {
      idFormulBoost = val;
      _message = (langUserPhone == "fr")
          ? "Cette formule vous offre une promotion de $jours jour(s) pour $prix Points qui seront déduit de votre solde bonus."
          : "This formula offers you a promotion of $jours day(s) for $prix Points which will be deducted from your bonus balance.";
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
            fontWeight: FontWeight.w600,
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
                initialValue: '1',
                labelText: 'Formules de Boost',
                items: listeFormulBoost,
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
                      _desactive ? "Wait..." : "BOOSTER",
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
  List<Map<String, dynamic>> listeFormulBoost = [];
  String? boostId;
  final telController = TextEditingController(text: tel);

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
          SQLHelper.delete('listeFormulBoost');
          for (var listeFormulBoost in data["listeFormulBoost"]) {
            SQLHelper.insert({
              'tableName': "listeFormulBoost",
              'value': listeFormulBoost['id'],
              'label': listeFormulBoost['label'] +
                  " à " +
                  (listeFormulBoost['prix']).toString() +
                  " FCFA",
              'prix': listeFormulBoost['prix'],
              'jours': listeFormulBoost['jours']
            });
          }
          final dataElements = await SQLHelper.getAll("listeFormulBoost");
          setState(() {
            _desactive2 = false;
            listeFormulBoost = dataElements;
            onChangeFormulBoost(1);
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
    var prix = (await SQLHelper.getFormulBoostWhithId(val))[0]['prix'];
    var jours = (await SQLHelper.getFormulBoostWhithId(val))[0]['jours'];
    setState(() {
      idFormulBoost = val;
      _message =
          "Cette formule vous offre une promotion de $jours jour(s) pour $prix FCFA.";
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
            fontWeight: FontWeight.w600,
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
                initialValue: '1',
                labelText: 'Formules de Promotion Payante',
                items: listeFormulBoost,
                onChanged: (val) => onChangeFormulBoost(val),
                onSaved: (val) => print(val),
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
                decoration: InputDecoration(
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
                    _desactive2 ? "Wait..." : "PAYER & BOOSTER",
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
            const SizedBox(height: 20),
            DelayedAnimation(
              delay: 0, // 1000,
              child: Text(
                _message,
                style: GoogleFonts.poppins(
                  color: Colors.blue[400],
                  fontWeight: FontWeight.w600,
                  fontSize: 12,
                ),
                textAlign: TextAlign.center,
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
