// ignore_for_file: unnecessary_null_comparison, non_constant_identifier_names, prefer_final_fields, unused_field, use_build_context_synchronously
import 'dart:ui';

import 'package:dressur/components/noti_sys.dart';
import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/components/constant.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;
import 'package:dressur/components/noti.dart';
import 'package:select_form_field/select_form_field.dart';

class PromotionReseauSociauxFormPage extends StatefulWidget {
  @override
  State<PromotionReseauSociauxFormPage> createState() =>
      _PromotionReseauSociauxFormPageState();
}

class _PromotionReseauSociauxFormPageState
    extends State<PromotionReseauSociauxFormPage> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        elevation: 0,
        backgroundColor: primaryColor,
        title: Text(
          (langUserPhone == "fr")
              ? "Nouvelle Promotion Réseau Sociaux"
              : "New Social Network Promotion",
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
      ),
      body: SingleChildScrollView(
        child: Column(
          children: [
            const SizedBox(height: 5),
            Card(
              margin:
                  const EdgeInsets.only(left: 10, top: 5, right: 10, bottom: 5),
              child: Container(
                decoration: BoxDecoration(
                  borderRadius: BorderRadius.circular(5),
                  gradient: const LinearGradient(
                    begin: Alignment.topCenter,
                    end: Alignment.bottomCenter,
                    colors: [
                      Colors.red,
                      Color.fromARGB(255, 85, 3, 3),
                    ],
                  ),
                ),
                padding: const EdgeInsets.fromLTRB(10, 0, 10, 0),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.stretch,
                  children: [
                    const SizedBox(height: 10),
                    Text(
                      (langUserPhone == "fr")
                          ? "NB: Vos préférences sur Dressur ne s'appliquent pas aux Promotions Réseau Sociaux. Les comptes qui interagiront avec votre promotion seront sélectionnés par le réseau social, sans que Dressur puisse intervenir."
                          : "NB: Your preferences on Dressur do not apply to Social Network Promotions. The accounts that will interact with your promotion will be selected by the social network, without Dressur being able to intervene.",
                      style: GoogleFonts.poppins(
                        fontWeight: FontWeight.w600,
                        fontSize: 10,
                        color: Colors.white,
                      ),
                      textAlign: TextAlign.justify,
                    ),
                    const SizedBox(height: 15),
                  ],
                ),
              ),
            ),
            const SizedBox(height: 5),
            Container(
              margin: const EdgeInsets.symmetric(vertical: 10, horizontal: 15),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.center,
                children: [
                  Text(
                    (langUserPhone == "fr")
                        ? "Promotion Réseau Sociaux"
                        : "Social Network Promotion",
                    style: GoogleFonts.poppins(
                      fontSize: 20,
                      fontWeight: FontWeight.w600,
                    ),
                    textAlign: TextAlign.center,
                  ),
                  const SizedBox(height: 10),

                  // Formulaire
                  RegisterForm3(),

                  const SizedBox(height: 10),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class RegisterForm3 extends StatefulWidget {
  @override
  State<RegisterForm3> createState() => _RegisterForm3State();
}

class _RegisterForm3State extends State<RegisterForm3> {
  final ScrollController _scrollController = ScrollController();
  String? selectedSocialNetwork = "";
  var nombreAdresseMailForm = 0;
  int? initialService;
  bool _loading_liste_formule = false;
  bool _desactive2 = false;
  bool _desactive3 = false;
  bool _isValidLink = true;
  dynamic data;
  List<dynamic> listSocialNetworks = [];
  List<Map<String, dynamic>> listServices = [];
  dynamic valueMethodePaiement = "mtn";
  String? titreFormuleFils;
  dynamic idFormulePromoReseau = 0;
  var _message = "";

  String titre = "";
  int prix = 0;
  int id = 0;
  int qte = 0;
  int qteMin = 0;
  int qteMax = 0;
  String description = (langUserPhone == "fr")
      ? "Veuillez choisir un réseau social puis un service."
      : "Please choose a social network then a service.";

  final descriptionController = TextEditingController();
  final linkController = TextEditingController();
  final quantityController = TextEditingController(text: "0");
  final priceController = TextEditingController();
  final telController = TextEditingController(text: tel);

  void onChangeService(val) async {
    for (var service in listServices) {
      if ("$val" == "${service['id']}") {
        setState(() {
          idFormulePromoReseau = service['id'];
          id = service['id'];
          titre = service['titre'];
          prix = service['prix'];
          qte = service['qte'];
          qteMin = service['qteMin'];
          qteMax = service['qteMax'];
          description = service['description'];

          if (quantityController.text == "0" ||
              int.parse(quantityController.text) < qteMin) {
            quantityController.text = qteMin.toString();
          }
        });
      }
    }
    calculerPrixTotal();
  }

  void calculerPrixTotal() {
    _message = "";
    if (qte != 0) {
      int qteDemander = int.tryParse(quantityController.text) ?? 0;
      if (qteDemander >= qteMin && qteDemander <= qteMax) {
        int prixQteDemander = ((prix * qteDemander) / qte).round();
        quantityController.text = "$qteDemander";
        priceController.text = "$prixQteDemander";
        if (prixQteDemander < 100) {
          _message = (langUserPhone == "fr")
              ? "Le prix minimum pour une transaction est de 100 FCFA."
              : "The minimum price for a transaction is 100 FCFA.";
        }
      } else {
        _message = (langUserPhone == "fr")
            ? "La quantité doit être comprise entre $qteMin et $qteMax"
            : "The quantity must be between $qteMin and $qteMax";
      }
    } else {
      _message = (langUserPhone == "fr")
          ? "Veuillez choisir un réseau social puis un service."
          : "Please choose a social network then a service.";
    }
  }

  void listeFormPromoReseau() async {
    bool isConnected = await isConnectedToInternet();
    if (isConnected) {
      setState(() {
        _loading_liste_formule = true;
      });

      var request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/listeFormulePromoReseau'));
      request.fields.addAll({
        'langUserPhone': langUserPhone.toString(),
      });

      http.StreamedResponse response = await request.send();

      if (response.statusCode == 200) {
        var data1 = await response.stream.bytesToString();
        var data = convert.jsonDecode(data1);
        if (data["error"] == false) {
          listSocialNetworks = data["listeFormulePromoReseau"];
          setState(() {
            _loading_liste_formule = false;
          });
        }
      }
    } else {
      if (langUserPhone != "fr") {
        dangerNoti(
            "Mistake!", "You are not connected to the internet.", context);
      } else {
        dangerNoti("Erreur!", "Vous n'êtes pas connecté à internet.", context);
      }
      setState(() {
        _loading_liste_formule = false;
      });
    }
  }

  void newPromoReseau() async {
    if (_message != "") {
      dangerNoti((langUserPhone == "fr") ? "Attention !!!" : "Attention !!!",
          _message, context);
    } else {
      setState(() {
        _desactive3 = true;
      });

      bool isConnected = await isConnectedToInternet();
      if (isConnected) {
        var request = http.MultipartRequest(
            'POST', Uri.parse('$generalRouteForApi/newPromoReseau'));
        request.fields.addAll({
          'langUserPhone': langUserPhone.toString(),
          'uid': uidUser,
          'idFormulePromoReseau': idFormulePromoReseau.toString(),
          'qteDemander': quantityController.text,
          'prixQteDemander': priceController.text,
          'lien': linkController.text,
          'valueMethodePaiement': valueMethodePaiement,
          'tel': telController.text,
        });

        http.StreamedResponse response = await request.send();

        if (response.statusCode == 200) {
          var data1 = await response.stream.bytesToString();
          var data = convert.jsonDecode(data1);
          if (data["error"] == false) {
            setState(() {
              _desactive3 = false;
            });
            if (data["direct"] == true) {
              dangerNoti(
                  (langUserPhone == "fr") ? "Attention !!!" : "Attention !!!",
                  (langUserPhone == "fr")
                      ? "Après confirmation du paiement, veuillez consulter la liste de vos promotions réseaux sociaux."
                      : "After payment confirmation, please view the list of your social media promotions.",
                  context);
            } else {
              launchPaiement(data["url"]);
              Navigator.pop(context);
              showNotification(
                  (langUserPhone == "fr")
                      ? "Paiement en cours !"
                      : "Payment in progress !",
                  (langUserPhone == "fr")
                      ? "Après confirmation du paiement, veuillez consulter la liste de vos promotions réseaux sociaux."
                      : "After payment confirmation, please view the list of your social media promotions.");
            }
          } else {
            dangerNoti(data["titre"], data["message"], context);
            setState(() {
              _desactive3 = false;
            });
          }
        } else {
          dangerNoti("ERROR", "ERROR", context);
          setState(() {
            _desactive3 = false;
          });
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
          _desactive3 = false;
        });
      }
    }
  }

  void checkTransaction(idTransaction) async {
    if (telIsVerified == true) {
      bool isConnected = await isConnectedToInternet();
      if (isConnected) {
        setState(() {
          _desactive3 = true;
        });

        var request = http.MultipartRequest(
            'POST', Uri.parse('$generalRouteForApi/checkTransaction'));
        request.fields.addAll({
          'uid': uidUser,
          'langUserPhone': langUserPhone.toString(),
          'idTransaction': idTransaction.toString()
        });

        http.StreamedResponse response = await request.send();

        if (response.statusCode == 200) {
          var data1 = await response.stream.bytesToString();
          var data = convert.jsonDecode(data1);
          if (data["error"] == false) {
            if (data["transaction"] == false) {
              dangerNoti(data["titre"], data["message"], context);

              setState(() {
                _desactive3 = false;
              });
            } else if (data["transaction"] == true) {
              successNoti(data["titre"], data["message"], context);

              ScaffoldMessenger.of(context).showSnackBar(SnackBar(
                behavior: SnackBarBehavior.floating,
                content: Text(data["message"]),
              ));

              setState(() {
                _desactive3 = false;
              });
            }
          } else {
            dangerNoti(data["titre"], data["message"], context);
            setState(() {
              _desactive3 = false;
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
          _desactive3 = false;
        });
      }
    } else {
      if (langUserPhone != "fr") {
        dangerNoti("Access denied !",
            "Please confirm your WhatsApp number first.", context);
      } else {
        dangerNoti("Accès Refusé !",
            "Veuillez d'abord confirmer votre numéro WhatsApp.", context);
      }
      setState(() {
        _desactive3 = false;
      });
    }
  }

  onChangeMethodePaiement(val) async {
    setState(() {
      valueMethodePaiement = val;
    });
  }

  @override
  void initState() {
    super.initState();

    // S'assurer que le ScrollController est attaché après le rendu initial
    WidgetsBinding.instance.addPostFrameCallback((_) {
      if (mounted) {
        setState(() {
          listeFormPromoReseau();
        }); // Rafraîchir pour s'assurer que tout est prêt
      }
    });
  }

  @override
  void dispose() {
    _scrollController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Container(
      child: Column(
        children: [
          _loading_liste_formule
              ? const Center(
                  child: CircularProgressIndicator(),
                )
              : listSocialNetworks.isEmpty
                  ? Center(
                      child: Text(
                        (langUserPhone == "fr")
                            ? "Erreur lors du chargement des formules de promotion réseau sociaux. Veuillez Contacter l'assistance Dressur."
                            : "Error loading social network promotion formulas. Please Contact Dressur Support.",
                        style: const TextStyle(fontSize: 16),
                      ),
                    )
                  : SizedBox(
                      height: 70,
                      child: Scrollbar(
                        controller: _scrollController,
                        thumbVisibility: true,
                        thickness: 5,
                        radius: const Radius.circular(5),
                        child: SingleChildScrollView(
                          controller:
                              _scrollController, // Attach the ScrollController here
                          padding: const EdgeInsets.fromLTRB(0, 0, 0, 0),
                          scrollDirection: Axis.horizontal,
                          child: Padding(
                            padding:
                                const EdgeInsets.symmetric(horizontal: 0.0),
                            child: Row(
                              children: List.generate(
                                listSocialNetworks.length,
                                (index) => Padding(
                                  padding: const EdgeInsets.only(right: 10),
                                  child: ActionChip(
                                    label: Row(
                                      children: [
                                        Icon(selectedSocialNetwork ==
                                                listSocialNetworks[index]
                                                    ['titre']
                                            ? Icons.check_circle
                                            : Icons.radio_button_unchecked),
                                        const SizedBox(width: 10),
                                        Text(
                                          listSocialNetworks[index]['titre'],
                                          style: GoogleFonts.poppins(
                                            fontSize: 15,
                                            fontWeight: FontWeight.w400,
                                          ),
                                        ),
                                      ],
                                    ),
                                    onPressed: () {
                                      setState(() {
                                        idFormulePromoReseau = 0;
                                        description = (langUserPhone == "fr")
                                            ? "Veuillez choisir un réseau social puis un service."
                                            : "Please choose a social network then a service.";
                                        _message = description;
                                        selectedSocialNetwork =
                                            listSocialNetworks[index]['titre'];
                                        listServices =
                                            (listSocialNetworks[index]
                                                        ['lesFormulesFils']
                                                    as List<dynamic>)
                                                .map((item) => item
                                                    as Map<String, dynamic>)
                                                .toList();
                                        initialService = listServices.isNotEmpty
                                            ? listServices.first['id']
                                            : null;
                                      });
                                    },
                                  ),
                                ),
                              ),
                            ),
                          ),
                        ),
                      ),
                    ),
          const SizedBox(height: 20),
          SelectFormField(
            decoration: InputDecoration(
              labelText: 'Services $selectedSocialNetwork',
              border: const OutlineInputBorder(),
            ),
            type: SelectFormFieldType.dropdown,
            initialValue: "1",
            labelText: 'Services $selectedSocialNetwork',
            items: listServices,
            onChanged: (val) => onChangeService(val),
            onSaved: (val) => print(val),
          ),
          const SizedBox(height: 10),
          Card(
            child: Container(
                width: MediaQuery.of(context).size.width * 1,
                padding: const EdgeInsets.fromLTRB(10, 10, 10, 10),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      description,
                      style: GoogleFonts.poppins(
                        fontWeight: FontWeight.w400,
                        fontSize: 16,
                      ),
                    ),
                  ],
                )),
          ),
          const SizedBox(height: 15),
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              SizedBox(
                width: MediaQuery.of(context).size.width * 0.35,
                child: TextField(
                  controller: quantityController,
                  keyboardType: TextInputType.number,
                  decoration: InputDecoration(
                    labelText:
                        (langUserPhone == "fr") ? "Quantité" : "Quantity",
                    helperText: "Min : $qteMin - Max : $qteMax",
                    border: const OutlineInputBorder(),
                  ),
                  onChanged: (val) => calculerPrixTotal(),
                ),
              ),
              SizedBox(
                width: MediaQuery.of(context).size.width * 0.55,
                child: TextField(
                  controller: priceController,
                  maxLines: 3,
                  minLines: 1,
                  keyboardType:
                      const TextInputType.numberWithOptions(decimal: true),
                  decoration: const InputDecoration(
                    labelText: "Prix",
                    helperText: "FCFA",
                    border: OutlineInputBorder(),
                    // Définir la couleur du texte lorsque le champ est désactivé
                    labelStyle: TextStyle(color: primaryColor),
                  ),
                  style: const TextStyle(color: primaryColor),
                  enabled: false,
                ),
              ),
            ],
          ),
          const SizedBox(height: 10),
          TextField(
            controller: linkController,
            decoration: InputDecoration(
              labelText: (langUserPhone == "fr") ? "Lien" : "Link",
              border: const OutlineInputBorder(),
              errorText: _isValidLink
                  ? null
                  : "Veuillez saisir un lien valide.", // Set error text if link is invalid
            ),
            onChanged: (text) {
              setState(() {
                // Basic URL validation using a regular expression
                final RegExp urlRegex = RegExp(r"^(?:(?:https?|ftp)://)?\S+$",
                    caseSensitive: false);
                _isValidLink = urlRegex.hasMatch(text);
              });
            },
          ),
          const SizedBox(height: 15),
          SelectFormField(
            decoration: const InputDecoration(
              labelText: 'Methode de paiement mobile',
              border: OutlineInputBorder(),
            ),
            type: SelectFormFieldType.dropdown,
            initialValue: 'mtn',
            labelText: 'Methode de paiement mobile',
            items: listeMethodePaiement,
            onChanged: (val) => onChangeMethodePaiement(val),
            onSaved: (val) => print(val),
          ),
          const SizedBox(height: 15),
          TextField(
            controller: telController,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText: 'Indicatif + Numéro du paiement',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 15),
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
                _desactive3
                    ? (langUserPhone == "fr")
                        ? "Patientez..."
                        : "Wait..."
                    : (langUserPhone == "fr")
                        ? "Payer et Démarrer"
                        : "Pay and Get Started",
                style: GoogleFonts.poppins(
                  color: Colors.white,
                ),
              ),
              onPressed: () {
                if (!telIsVerified) {
                  showConfNumeroWhatsapp(context);
                } else {
                  _desactive3 ? null : newPromoReseau();
                }
              },
            ),
          ),
          const SizedBox(height: 15),
          Text(
            (langUserPhone == "fr")
                ? "Pour payer par Wave ou Carte Bancaire, veuillez contacter l'Assistance Dressur par WhatsApp. Merci..."
                : "To pay by Wave or Credit Card, please contact Dressur Support by WhatsApp. THANKS...",
            style: GoogleFonts.poppins(
              fontWeight: FontWeight.w600,
              fontSize: 12,
              color: Colors.red,
            ),
            textAlign: TextAlign.center,
          ),
        ],
      ),
    );
  }
}
