// ignore_for_file: unnecessary_null_comparison, non_constant_identifier_names, prefer_final_fields, unused_field, use_build_context_synchronously
import 'dart:ui';

import 'package:dressur/components/noti_sys.dart';
import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/components/constant.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;
import 'package:dressur/components/noti.dart';
import 'package:select_form_field/select_form_field.dart';
import 'package:dressur/components/info_service_bottom_sheet.dart';
import 'package:dressur/components/payment_summary.dart';

class PromotionReseauSociauxFormPage extends StatefulWidget {
  @override
  State<PromotionReseauSociauxFormPage> createState() =>
      _PromotionReseauSociauxFormPageState();
}

class _PromotionReseauSociauxFormPageState
    extends State<PromotionReseauSociauxFormPage> {
  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      if (mounted) _showInfoModal();
    });
  }

  void _showInfoModal({int countdown = 2}) {
    showServiceInfoModal(
      context,
      countdownSeconds: countdown,
      titleFr: "Informations Promotion Réseaux Sociaux",
      titleEn: "Social Network Promotion Information",
      items: const [
        ServiceInfoItem(
          icon: FontAwesomeIcons.sliders,
          textFr:
              "Vos préférences sur Dressur ne s'appliquent pas aux promotions sur les réseaux sociaux.",
          textEn:
              "Your Dressur preferences do not apply to social media promotions.",
        ),
        ServiceInfoItem(
          icon: FontAwesomeIcons.shareNodes,
          textFr:
              "Les comptes qui interagiront avec votre promotion seront sélectionnés directement par le réseau social.",
          textEn:
              "The accounts that will interact with your promotion will be selected directly by the social network.",
        ),
        ServiceInfoItem(
          icon: FontAwesomeIcons.thumbsUp,
          textFr:
              "Ce service peut vous aider à obtenir des votes, likes, commentaires et partages.",
          textEn:
              "This service can help you get votes, likes, comments and shares.",
        ),
        ServiceInfoItem(
          icon: FontAwesomeIcons.userGroup,
          textFr:
              "Ce service vous permet d'attirer davantage l'attention sur vos réseaux sociaux.",
          textEn:
              "This service allows you to attract more attention on your social media.",
        ),
        ServiceInfoItem(
          icon: FontAwesomeIcons.fileLines,
          textFr:
              "Lisez correctement la description du service réseau auquel vous voulez souscrire.",
          textEn:
              "Read carefully the description of the network service you want to subscribe to.",
        ),
      ],
    );
  }

  Widget _buildInfoButton() {
    final bool isFr = langUserPhone == "fr";
    return OutlinedButton.icon(
      onPressed: () => _showInfoModal(countdown: 0),
      icon: const FaIcon(FontAwesomeIcons.circleInfo, size: 14),
      label: Text(
        isFr
            ? "Voir les informations sur le service"
            : "View service information",
        style: GoogleFonts.poppins(fontSize: 13, fontWeight: FontWeight.w500),
      ),
      style: OutlinedButton.styleFrom(
        foregroundColor: primaryColor,
        side: BorderSide(color: primaryColor.withOpacity(0.5)),
        minimumSize: const Size(double.infinity, 48),
        padding: const EdgeInsets.symmetric(vertical: 10, horizontal: 16),
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(10)),
      ),
    );
  }

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
            color: Colors.white,
            fontWeight: FontWeight.w400,
            fontSize: 18,
          ),
        ),
        leading: IconButton(
          onPressed: () {
            Navigator.pop(context);
          },
          icon: const FaIcon(FontAwesomeIcons.chevronLeft, color: Colors.white),
        ),
      ),
      body: SingleChildScrollView(
        child: Column(
          children: [
            const SizedBox(height: 10),
            Padding(
              padding: const EdgeInsets.symmetric(horizontal: 10),
              child: _buildInfoButton(),
            ),
            const SizedBox(height: 16),
            Container(
              margin: const EdgeInsets.only(bottom: 10, left: 15, right: 15),
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
                  const SizedBox(height: 8),

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
  bool commentairesRequis = false;
  String description = (langUserPhone == "fr")
      ? "Veuillez choisir un réseau social puis un service."
      : "Please choose a social network then a service.";

  final descriptionController = TextEditingController();
  final linkController = TextEditingController();
  final quantityController = TextEditingController(text: "0");
  final priceController = TextEditingController();
  final telController = TextEditingController(text: tel);
  final commentairesController = TextEditingController();

  List<String> _lignesCommentaires() {
    return commentairesController.text
        .split(RegExp(r'\r?\n'))
        .map((ligne) => ligne.trim())
        .where((ligne) => ligne.isNotEmpty)
        .toList();
  }

  void _limiterCommentaires() {
    if (!commentairesRequis) return;
    final lignes = _lignesCommentaires();
    final quantiteDemandee = int.tryParse(quantityController.text) ?? 0;
    if (lignes.length <= quantiteDemandee) return;
    final texte = lignes.take(quantiteDemandee).join('\n');
    commentairesController.value = TextEditingValue(
      text: texte,
      selection: TextSelection.collapsed(offset: texte.length),
    );
  }

  bool _validerCommentaires() {
    if (!commentairesRequis) return true;
    _limiterCommentaires();
    final lignes = _lignesCommentaires();
    if (lignes.isEmpty) {
      dangerNoti(
        (langUserPhone == "fr") ? "Commentaires requis" : "Comments required",
        (langUserPhone == "fr")
            ? "Veuillez renseigner au moins un commentaire."
            : "Please enter at least one comment.",
        context,
      );
      return false;
    }
    final quantiteDemandee = int.tryParse(quantityController.text) ?? 0;
    if (lignes.length > quantiteDemandee) {
      dangerNoti(
        (langUserPhone == "fr") ? "Attention" : "Attention",
        (langUserPhone == "fr")
            ? "Le nombre de commentaires ne peut pas dépasser la quantité demandée."
            : "The number of comments cannot exceed the requested quantity.",
        context,
      );
      return false;
    }
    return true;
  }

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
          commentairesRequis = service['commentairesRequis'] == true;
          commentairesController.clear();
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
    var nextMessage = "";
    var nextPrice = "";

    if (qte != 0) {
      int qteDemander = int.tryParse(quantityController.text) ?? 0;
      if (qteDemander >= qteMin && qteDemander <= qteMax) {
        int prixQteDemander = ((prix * qteDemander) / qte).round();
        nextPrice = "$prixQteDemander";
        if (prixQteDemander < 100) {
          nextMessage = (langUserPhone == "fr")
              ? "Le prix minimum pour une transaction est de 100 FCFA."
              : "The minimum price for a transaction is 100 FCFA.";
        }
      } else {
        nextMessage = (langUserPhone == "fr")
            ? "La quantité doit être comprise entre $qteMin et $qteMax"
            : "The quantity must be between $qteMin and $qteMax";
      }
    } else {
      nextMessage = (langUserPhone == "fr")
          ? "Veuillez choisir un réseau social puis un service."
          : "Please choose a social network then a service.";
    }

    if (!mounted) return;
    setState(() {
      _message = nextMessage;
      if (nextPrice.isEmpty) {
        priceController.clear();
      } else {
        priceController.text = nextPrice;
      }
    });
  }

  void listeFormPromoReseau() async {
    bool isConnected = await isConnectedToInternet();
    if (isConnected) {
      setState(() {
        _loading_liste_formule = true;
      });

      var request = http.MultipartRequest(
        'POST',
        Uri.parse('$generalRouteForApi/listeFormulePromoReseau'),
      );
      request.fields.addAll({});

      http.StreamedResponse response = await request.send();

      if (response.statusCode == 200) {
        var data1 = await response.stream.bytesToString();
        var data = convert.jsonDecode(data1);
        if (data["error"] == false) {
          listSocialNetworks = data["listeFormulePromoReseau"];
          listeMethodePaiements =
              (data["listeMethodePaiements"] as List<dynamic>)
                  .map((item) => item as Map<String, dynamic>)
                  .toList();
          setState(() {
            _loading_liste_formule = false;
          });
        }
      }
    } else {
      if (langUserPhone != "fr") {
        dangerNoti(
          "Mistake!",
          "You are not connected to the internet.",
          context,
        );
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
      dangerNoti(
        (langUserPhone == "fr") ? "Attention !!!" : "Attention !!!",
        _message,
        context,
      );
    } else if (!_validerCommentaires()) {
      return;
    } else {
      setState(() {
        _desactive3 = true;
      });

      bool isConnected = await isConnectedToInternet();
      if (isConnected) {
        var request = http.MultipartRequest(
          'POST',
          Uri.parse('$generalRouteForApi/newPromoReseau'),
        );
        request.fields.addAll({
          'uid': uidUser,
          'idFormulePromoReseau': idFormulePromoReseau.toString(),
          'qteDemander': quantityController.text,
          'prixQteDemander': priceController.text,
          'lien': linkController.text,
          'valueMethodePaiement': valueMethodePaiement,
          'tel': telController.text,
          'commentaires': commentairesRequis ? commentairesController.text : '',
        });

        http.StreamedResponse response = await request.send();

        if (response.statusCode == 200) {
          var data1 = await response.stream.bytesToString();
          var data = convert.jsonDecode(data1);
          if (data["error"] == false) {
            cancelPromoReminderNotification();
            setState(() {
              _desactive3 = false;
            });
            if (data["solde_used"] == true) {
              successNoti(
                (langUserPhone == "fr") ? "Succès" : "Success",
                data["message"] ??
                    ((langUserPhone == "fr")
                        ? "Solde débité. Promotion Réseau enregistrée."
                        : "Balance debited. Social media promotion registered."),
                context,
              );
            } else if (data["direct"] == true) {
              dangerNoti(
                (langUserPhone == "fr") ? "Attention !!!" : "Attention !!!",
                (langUserPhone == "fr")
                    ? "Après confirmation du paiement, veuillez consulter la liste de vos promotions réseaux sociaux."
                    : "After payment confirmation, please view the list of your social media promotions.",
                context,
              );
            } else {
              launchPaiement(data["url"]);
              await showNotification(
                (langUserPhone == "fr")
                    ? "Paiement en cours !"
                    : "Payment in progress !",
                (langUserPhone == "fr")
                    ? "Après confirmation du paiement, veuillez consulter la liste de vos promotions réseaux sociaux."
                    : "After payment confirmation, please view the list of your social media promotions.",
                context: context,
              );
              if (mounted) Navigator.pop(context);
            }
          } else {
            dangerNoti(data["titre"], data["message"], context);
            setState(() {
              _desactive3 = false;
            });
          }
        } else {
          String errorTitle = (langUserPhone == "fr") ? "Erreur" : "Error";
          String errorMessage = (langUserPhone == "fr")
              ? "La promotion n'a pas pu être enregistrée. Vérifiez les informations saisies puis réessayez."
              : "The promotion could not be registered. Check the entered information and try again.";

          try {
            final errorBody = await response.stream.bytesToString();
            final decodedError = convert.jsonDecode(errorBody);
            if (decodedError is Map<String, dynamic> &&
                decodedError['error'] == true &&
                decodedError['message'] is String &&
                (decodedError['message'] as String).trim().isNotEmpty) {
              final apiMessage = (decodedError['message'] as String).trim();
              if (apiMessage.length <= 500) {
                errorMessage = apiMessage;
              }
              if (decodedError['titre'] is String &&
                  (decodedError['titre'] as String).trim().isNotEmpty &&
                  (decodedError['titre'] as String).length <= 80) {
                errorTitle = (decodedError['titre'] as String).trim();
              }
            }
          } catch (_) {
            // Ne jamais exposer le contenu brut d'une réponse invalide ou technique.
          }

          dangerNoti(errorTitle, errorMessage, context);
          setState(() {
            _desactive3 = false;
          });
        }
      } else {
        if (langUserPhone != "fr") {
          dangerNoti(
            "Mistake!",
            "You are not connected to the internet.",
            context,
          );
        } else {
          dangerNoti(
            "Erreur!",
            "Vous n'ètes pas connecté a internet.",
            context,
          );
        }
        setState(() {
          _desactive3 = false;
        });
      }
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
    commentairesController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Container(
      child: Column(
        children: [
          _loading_liste_formule
              ? const Center(
                  child: CircularProgressIndicator(color: primaryColor),
                )
              : listSocialNetworks.isEmpty
              ? Center(
                  child: Text(
                    (langUserPhone == "fr")
                        ? "Erreur lors du chargement des formules de promotion réseau sociaux. Veuillez Contacter l'assistance Dressur."
                        : "Error loading social network promotion formulas. Please Contact Dressur Support.",
                    style: GoogleFonts.poppins(fontSize: 16),
                  ),
                )
              : SizedBox(
                  height: 60,
                  child: Scrollbar(
                    controller: _scrollController,
                    thumbVisibility: true,
                    thickness: 5,
                    radius: const Radius.circular(5),
                    child: SingleChildScrollView(
                      controller:
                          _scrollController, // Attach the ScrollController here
                      scrollDirection: Axis.horizontal,
                      child: Row(
                        spacing: 10,
                        children: List.generate(
                          listSocialNetworks.length,
                          (index) => ActionChip(
                            label: Row(
                              children: [
                                FaIcon(
                                  selectedSocialNetwork ==
                                          listSocialNetworks[index]['titre']
                                      ? FontAwesomeIcons.solidCircleCheck
                                      : FontAwesomeIcons.circle,
                                  size: 15,
                                ),
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
                                titre = "";
                                prix = 0;
                                qte = 0;
                                qteMin = 0;
                                qteMax = 0;
                                commentairesRequis = false;
                                commentairesController.clear();
                                quantityController.text = "0";
                                priceController.clear();
                                description = (langUserPhone == "fr")
                                    ? "Veuillez choisir un réseau social puis un service."
                                    : "Please choose a social network then a service.";
                                _message = description;
                                selectedSocialNetwork =
                                    listSocialNetworks[index]['titre'];
                                listServices =
                                    (listSocialNetworks[index]['lesFormulesFils']
                                            as List<dynamic>)
                                        .map(
                                          (item) =>
                                              item as Map<String, dynamic>,
                                        )
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
              ),
            ),
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
                    labelText: (langUserPhone == "fr")
                        ? "Quantité"
                        : "Quantity",
                    helperText: "Min : $qteMin - Max : $qteMax",
                    border: const OutlineInputBorder(),
                  ),
                  onChanged: (val) {
                    calculerPrixTotal();
                    _limiterCommentaires();
                  },
                ),
              ),
              SizedBox(
                width: MediaQuery.of(context).size.width * 0.55,
                child: TextField(
                  controller: priceController,
                  maxLines: 3,
                  minLines: 1,
                  keyboardType: const TextInputType.numberWithOptions(
                    decimal: true,
                  ),
                  decoration: InputDecoration(
                    labelText: (langUserPhone == "fr") ? "Prix" : "Price",
                    helperText: "FCFA",
                    border: const OutlineInputBorder(),
                    // Définir la couleur du texte lorsque le champ est désactivé
                    labelStyle: GoogleFonts.poppins(color: primaryColor),
                  ),
                  style: GoogleFonts.poppins(color: primaryColor),
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
                  : (langUserPhone == "fr")
                  ? "Veuillez saisir un lien valide."
                  : "Please enter a valid link.",
            ),
            onChanged: (text) {
              setState(() {
                // Basic URL validation using a regular expression
                final RegExp urlRegex = RegExp(
                  r"^(?:(?:https?|ftp)://)?\S+$",
                  caseSensitive: false,
                );
                _isValidLink = urlRegex.hasMatch(text);
              });
            },
          ),
          if (commentairesRequis) ...[
            const SizedBox(height: 15),
            TextField(
              controller: commentairesController,
              minLines: 4,
              maxLines: 8,
              decoration: InputDecoration(
                labelText: (langUserPhone == "fr") ? "Commentaires" : "Comments",
                hintText: (langUserPhone == "fr")
                    ? "Un commentaire par ligne"
                    : "One comment per line",
                helperText: (langUserPhone == "fr")
                    ? "Vous pouvez en saisir moins que la quantité demandée. Dressur complétera automatiquement."
                    : "You may enter fewer than the requested quantity. Dressur will complete them automatically.",
                border: const OutlineInputBorder(),
              ),
              onChanged: (_) => _limiterCommentaires(),
            ),
          ],
          const SizedBox(height: 15),
          _buildPaymentSummary(context),
          const SizedBox(height: 15),
          SelectFormField(
            decoration: InputDecoration(
              labelText: (langUserPhone == "fr")
                  ? 'Moyen de paiement mobile ou par carte'
                  : 'Mobile or card payment method',
              border: const OutlineInputBorder(),
            ),
            type: SelectFormFieldType.dropdown,
            initialValue: 'mtn',
            labelText: (langUserPhone == "fr")
                ? 'Moyen de paiement mobile ou par carte'
                : 'Mobile or card payment method',
            items: listeMethodePaiements,
            onChanged: (val) => onChangeMethodePaiement(val),
            onSaved: (val) => print(val),
          ),
          const SizedBox(height: 15),
          TextField(
            controller: telController,
            decoration: InputDecoration(
              labelStyle: GoogleFonts.poppins(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? 'Indicatif + Numéro du paiement'
                  : 'Country code + Payment number',
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
                padding: const EdgeInsets.symmetric(vertical: 13),
              ),
              child: Text(
                _desactive3
                    ? (langUserPhone == "fr")
                          ? "Patientez..."
                          : "Wait..."
                    : (langUserPhone == "fr")
                    ? "Payer et Démarrer"
                    : "Pay and Get Started",
                style: GoogleFonts.poppins(color: Colors.white),
              ),
              onPressed: () {
                _desactive3 ? null : newPromoReseau();
              },
            ),
          ),
          const SizedBox(height: 15),
        ],
      ),
    );
  }

  Widget _buildPaymentSummary(BuildContext context) {
    final bool isFrench = langUserPhone == "fr";
    final int calculatedAmount = int.tryParse(priceController.text) ?? 0;
    final String quantity =
        int.tryParse(quantityController.text)?.toString() ?? "0";

    return Card(
      margin: EdgeInsets.zero,
      child: Padding(
        padding: const EdgeInsets.all(12),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.stretch,
          children: [
            Text(
              isFrench ? "Récapitulatif du paiement" : "Payment summary",
              style: GoogleFonts.poppins(
                fontSize: 16,
                fontWeight: FontWeight.w600,
              ),
            ),
            const SizedBox(height: 10),
            _summaryValueRow(
              isFrench ? "Réseau social" : "Social network",
              selectedSocialNetwork?.isNotEmpty == true
                  ? selectedSocialNetwork!
                  : "—",
            ),
            _summaryValueRow(
              isFrench ? "Service choisi" : "Selected service",
              titre.isNotEmpty ? titre : "—",
            ),
            _summaryValueRow(
              isFrench ? "Quantité" : "Quantity",
              quantity == "0" ? "—" : quantity,
            ),
            const SizedBox(height: 10),
            PaymentSummary(
              lines: [
                PaymentSummaryLine(
                  labelFr: "Prix calculé",
                  labelEn: "Calculated price",
                  amount: calculatedAmount,
                ),
              ],
              total: calculatedAmount,
              languageCode: isFrench ? "fr" : "en",
              totalLabelFr: "Total à payer",
              totalLabelEn: "Total to pay",
              padding: EdgeInsets.zero,
            ),
          ],
        ),
      ),
    );
  }

  Widget _summaryValueRow(String label, String value) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 3),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Expanded(
            child: Text(label, style: GoogleFonts.poppins(fontSize: 13)),
          ),
          const SizedBox(width: 12),
          Flexible(
            child: Text(
              value,
              textAlign: TextAlign.end,
              softWrap: true,
              style: GoogleFonts.poppins(
                fontSize: 13,
                fontWeight: FontWeight.w600,
              ),
            ),
          ),
        ],
      ),
    );
  }
}
