// ignore_for_file: use_build_context_synchronously, prefer_const_constructors

import 'dart:convert';
import 'dart:convert' as convert;
import 'package:dressur/components/delayed_animation.dart';
import 'package:dressur/components/noti.dart';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:http/http.dart' as http;
import 'package:select_form_field/select_form_field.dart';
import 'package:dressur/5_autre/support_assistance.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/sql_helper.dart';

class CampagneMail {
  final String id;
  final String idFormuleCampagneMail;
  final String prixFormuleCampagneMail;
  final String titre;
  final String sujet;
  final String replyto;
  final String sendto;
  final String contentmail;
  final String status;
  final String createdAt;
  final bool peutPayer;

  CampagneMail({
    required this.id,
    required this.idFormuleCampagneMail,
    required this.prixFormuleCampagneMail,
    required this.titre,
    required this.sujet,
    required this.replyto,
    required this.sendto,
    required this.contentmail,
    required this.status,
    required this.createdAt,
    required this.peutPayer,
  });
}

class AdminCampagneMailListePage extends StatefulWidget {
  @override
  _AdminCampagneMailListePageState createState() =>
      _AdminCampagneMailListePageState();
}

class _AdminCampagneMailListePageState
    extends State<AdminCampagneMailListePage> {
  bool _loading = false;
  List<CampagneMail> _campagneMails = [];

  @override
  void initState() {
    super.initState();
    fetchCampagneMails();
  }

  Future<void> refuser(String id) async {
    setState(() {
      _loading = true;
    });
    final url =
        Uri.parse('$generalRouteForApi/adminListCampagneMail/refuser/$id');

    try {
      final response = await http.get(url);
      if (response.statusCode == 200) {
        setState(() {
          _campagneMails.removeWhere((campagneMail) => campagneMail.id == id);
          _loading = false;
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
        Uri.parse('$generalRouteForApi/adminListCampagneMail/accepter/$id');

    try {
      final response = await http.get(url);
      if (response.statusCode == 200) {
        setState(() {
          _campagneMails.removeWhere((campagneMail) => campagneMail.id == id);
          _loading = false;
        });
      } else {
        showErrorDialog(response.statusCode);
      }
    } catch (e) {
      showErrorDialog(-1); // Handle network errors
    }
  }

  Future<void> fetchCampagneMails() async {
    setState(() {
      _loading = true;
    });
    final url = Uri.parse('$generalRouteForApi/adminListCampagneMail');

    try {
      final response = await http.get(url);
      if (response.statusCode == 200) {
        final jsonData = jsonDecode(response.body) as List<dynamic>;
        final campagneMails = jsonData.map((data) {
          return CampagneMail(
            id: data['id'],
            idFormuleCampagneMail: data['idFormuleCampagneMail'],
            prixFormuleCampagneMail: data['prixFormuleCampagneMail'],
            titre: data['titre'],
            sujet: data['sujet'],
            replyto: data['replyto'],
            sendto: data['sendto'],
            contentmail: data['contentmail'],
            status: data['status'],
            createdAt: data['createdAt'],
            peutPayer: data['peutPayer'],
          );
        }).toList();
        setState(() {
          _campagneMails = campagneMails;
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
                ? "Échec de récupération des campagneMails. Code d'erreur: $statusCode"
                : "Failed to retrieve campagneMails. Error code: $statusCode",
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

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Colors.red,
        title: Text(
          "Admin Campagne Mail",
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
        actions: [
          PopupMenuButton<dynamic>(
            itemBuilder: (context) => [
              PopupMenuItem(
                value: 1,
                onTap: () {
                  fetchCampagneMails();
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
          : _campagneMails.isEmpty
              ? Center(
                  child: Text(
                    (langUserPhone == "fr")
                        ? "Aucune campagne email trouvé."
                        : "No email campaigns found.",
                    style: const TextStyle(fontSize: 16),
                  ),
                )
              : ListView.builder(
                  itemCount: _campagneMails.length,
                  itemBuilder: (BuildContext context, int index) {
                    final campagneMail = _campagneMails[index];

                    return Card(
                      margin: const EdgeInsets.only(
                          left: 10, top: 10, right: 10, bottom: 0),
                      child: Container(
                        decoration: BoxDecoration(
                          borderRadius: BorderRadius.circular(5),
                        ),
                        padding: const EdgeInsets.fromLTRB(10, 10, 10, 6),
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Container(
                              padding: EdgeInsets.fromLTRB(8, 1, 8, 1),
                              decoration: BoxDecoration(
                                color: ([
                                  "Completed",
                                  "Terminé",
                                  "Accept and in progress",
                                  "Accepter et en cours"
                                ].contains(campagneMail.status))
                                    ? Colors.green
                                    : ([
                                        "Waiting for validation",
                                        "En Attente de validation",
                                        "Accept and pending payment",
                                        "Accepter et en attente de paiement"
                                      ].contains(campagneMail.status))
                                        ? Colors.orange
                                        : Colors.red,
                                borderRadius: BorderRadius.circular(10.0),
                              ),
                              child: Text(
                                campagneMail.status,
                                style: const TextStyle(
                                  fontSize: 14,
                                  fontWeight: FontWeight.bold,
                                  color: Colors.white,
                                ),
                              ),
                            ),
                            const SizedBox(height: 5),
                            Text(
                              campagneMail.sujet,
                              style: const TextStyle(
                                fontSize: 14,
                                fontWeight: FontWeight.bold,
                              ),
                              maxLines: 1,
                              overflow: TextOverflow.ellipsis,
                            ),
                            const SizedBox(height: 5),
                            Text(
                              campagneMail.contentmail,
                              style: const TextStyle(
                                fontSize: 14,
                              ),
                              maxLines: 3,
                              overflow: TextOverflow.ellipsis,
                            ),
                            const SizedBox(height: 5),
                            Row(
                              mainAxisAlignment: (campagneMail.peutPayer)
                                  ? MainAxisAlignment.spaceBetween
                                  : MainAxisAlignment.end,
                              children: [
                                if (campagneMail.peutPayer)
                                  ElevatedButton.icon(
                                    style: ElevatedButton.styleFrom(
                                      backgroundColor: Colors.orange,
                                      padding: const EdgeInsets.symmetric(
                                        vertical: 0,
                                        horizontal: 15,
                                      ),
                                    ),
                                    onPressed: () {
                                      Navigator.push(
                                        context,
                                        MaterialPageRoute(
                                          builder: (context) =>
                                              PaymentPayantPage(
                                                  campagneMail: campagneMail),
                                        ),
                                      );
                                    },
                                    label: Text(
                                      (langUserPhone == "fr") ? 'Payer' : "Pay",
                                      style: GoogleFonts.poppins(
                                        color: Colors.white,
                                        fontWeight: FontWeight.w400,
                                        fontSize: 13,
                                      ),
                                    ),
                                    icon: const Icon(
                                      Icons.payment,
                                      color: Colors.white,
                                      size: 13,
                                    ),
                                  ),
                                Column(
                                  children: [
                                    SizedBox(
                                      child: ElevatedButton.icon(
                                        style: ElevatedButton.styleFrom(
                                          backgroundColor: secondaryColor,
                                          padding: const EdgeInsets.symmetric(
                                              vertical: 0, horizontal: 15),
                                        ),
                                        label: Text(
                                          (langUserPhone == "fr")
                                              ? 'Autres Informations'
                                              : 'Other information',
                                          style: GoogleFonts.poppins(
                                            color: Colors.white,
                                            fontWeight: FontWeight.w400,
                                            fontSize: 13,
                                          ),
                                        ),
                                        icon: const Icon(
                                          Icons.info,
                                          color: Colors.white,
                                          size: 13,
                                        ),
                                        onPressed: () {
                                          Navigator.push(
                                            context,
                                            MaterialPageRoute(
                                              builder: (context) =>
                                                  CampagneMailDetailPage(
                                                campagneMail: campagneMail,
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
                            const SizedBox(height: 5),
                            Row(
                              mainAxisAlignment: MainAxisAlignment.spaceBetween,
                              children: [
                                SizedBox(
                                  width:
                                      MediaQuery.of(context).size.width * 0.42,
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
                                      accepter(campagneMail.id);
                                    },
                                  ),
                                ),
                                SizedBox(
                                  width:
                                      MediaQuery.of(context).size.width * 0.42,
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
                                      refuser(campagneMail.id);
                                    },
                                  ),
                                ),
                              ],
                            ),
                          ],
                        ),
                      ),
                    );
                  },
                ),
    );
  }
}

class CampagneMailDetailPage extends StatelessWidget {
  final CampagneMail campagneMail;

  CampagneMailDetailPage({required this.campagneMail});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
          (langUserPhone == "fr")
              ? 'Détails de la campagne Mail'
              : 'Details of the campagne Mail',
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
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            if (campagneMail.peutPayer)
              Column(
                children: [
                  Text(
                    (langUserPhone == "fr")
                        ? 'Votre demande de campagne Mail a été acceptée. Vous pouvez démarrer la campagne Mail payante.'
                        : "Your Mail campaign request has been accepted. You can start the paid Mail campaign.",
                    style: GoogleFonts.poppins(
                      fontSize: 16,
                      fontWeight: FontWeight.w600,
                    ),
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
                                  PaymentPayantPage(campagneMail: campagneMail),
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
                  ? 'Prix : ${campagneMail.prixFormuleCampagneMail} FCFA'
                  : 'Price: : ${campagneMail.prixFormuleCampagneMail} FCFA',
            ),
            const SizedBox(height: 16.0),
            Text(
              (langUserPhone == "fr")
                  ? 'Titre : ${campagneMail.titre}'
                  : 'Title: : ${campagneMail.titre}',
            ),
            const SizedBox(height: 16.0),
            Text(
              (langUserPhone == "fr")
                  ? 'Sujet : ${campagneMail.sujet}'
                  : 'Subject: : ${campagneMail.sujet}',
            ),
            const SizedBox(height: 16.0),
            Text(
              (langUserPhone == "fr")
                  ? 'Répondre à : ${campagneMail.replyto}'
                  : 'Reply to : ${campagneMail.replyto}',
            ),
            const SizedBox(height: 16.0),
            Text(
              (langUserPhone == "fr")
                  ? 'Destinataires : ${campagneMail.sendto}'
                  : 'Recipients: : ${campagneMail.sendto}',
            ),
            const SizedBox(height: 16.0),
            Text(
              (langUserPhone == "fr")
                  ? 'Contenu du mail : ${campagneMail.contentmail}'
                  : 'Content of the email : ${campagneMail.contentmail}',
            ),
            const SizedBox(height: 16.0),
          ],
        ),
      ),
    );
  }
}

class PaymentPayantPage extends StatefulWidget {
  final CampagneMail campagneMail;

  PaymentPayantPage({required this.campagneMail});

  @override
  _PaymentPayantPageState createState() => _PaymentPayantPageState();
}

class _PaymentPayantPageState extends State<PaymentPayantPage> {
  late CampagneMail campagneMail;

  bool _desactive2 = false;
  dynamic data;
  dynamic valueMethodePaiement = "mtn";
  String? boostId;
  final telController = TextEditingController(text: tel);

  onChangeMethodePaiement(val) async {
    setState(() {
      valueMethodePaiement = val;
    });
  }

  void newCampageMailPayant() async {
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

        var request = http.MultipartRequest('POST',
            Uri.parse('$generalRouteForApi/newCampageMailPayant/paiement'));
        request.fields.addAll({
          'uid': uidUser,
          'idCampagneMail': widget.campagneMail.id,
          'langUserPhone': langUserPhone.toString(),
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
                      ? "Après confirmation du paiement, veuillez consulter la liste de vos campagnes mails."
                      : "After confirmation of payment, please consult the list of your email campaigns.",
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
    super.initState();
    campagneMail = widget.campagneMail;
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
              child: Text(
                (langUserPhone == "fr")
                    ? 'Prix : ${campagneMail.prixFormuleCampagneMail} FCFA'
                    : 'Price: : ${campagneMail.prixFormuleCampagneMail} FCFA',
                style: GoogleFonts.poppins(
                  fontWeight: FontWeight.w600,
                  fontSize: 20,
                ),
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
                  border: OutlineInputBorder(),
                  labelStyle: TextStyle(color: Colors.grey[400]),
                  labelText: 'Indicatif + Numéro du paiement',
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
                            ? "Patientez ..."
                            : "Wait ..."
                        : (langUserPhone == "fr")
                            ? "Payer"
                            : "Pay",
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
                      _desactive2 ? null : newCampageMailPayant();
                    }
                  },
                ),
              ),
            ),
            const SizedBox(height: 20),
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
