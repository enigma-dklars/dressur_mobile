// ignore_for_file: use_build_context_synchronously

import 'package:dressur/2_promo/liste_boost_contact.dart';
import 'package:dressur/components/noti_sys.dart';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/components/delayed_animation.dart';
import 'package:dressur/components/constant.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;
import 'package:select_form_field/select_form_field.dart';
import 'package:dressur/components/noti.dart';

class NewBoostContactPage extends StatefulWidget {
  @override
  State<NewBoostContactPage> createState() => _NewBoostContactPageState();
}

class _NewBoostContactPageState extends State<NewBoostContactPage> {
  bool load = false;
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        elevation: 0,
        backgroundColor: primaryColor,
        title: Text(
          (langUserPhone == "fr")
              ? "Nouveau Boost Contact"
              : "New Boost Contact",
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
                          ? "NB: Les Boosts Gratuit sont beaucoup plus mis en avant! Il est donc conseillé de faire des Boosts Gratuit plutôt que Payant. Il n'est pas possible de connaitre à l'avance le nombre de contacts après boost ni la tranche rapproché. Vous pouvez programmer plusieurs Boosts Gratuit contrairement au Payant. Parrainé des utilisateurs pour avoir des bonus et ainsi faire des Boosts Gratuit."
                          : "NB: The Free Boosts are much more highlighted! It is therefore advisable to make Boosts Free rather than Paid. It is not possible to know in advance the number of contacts after boost nor the close range. You can schedule several Free Boosts unlike the Paid. Sponsored users to have bonuses and thus make Free Boosts.",
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
            Container(
              margin: const EdgeInsets.symmetric(vertical: 10, horizontal: 15),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.center,
                children: [
                  const SizedBox(height: 20),
                  DelayedAnimation(
                    delay: 0, // 1000,
                    child: Text(
                      (langUserPhone == "fr")
                          ? "Après BOOST, votre numéro sera visible dans les pays que vous avez choisie au niveau de vos préférences pendant un certain temps."
                          : "After BOOST, your number will be visible in the countries you have chosen in your preferences for a certain time.",
                      style: GoogleFonts.poppins(
                        fontSize: 16,
                      ),
                      textAlign: TextAlign.center,
                    ),
                  ),

                  const SizedBox(height: 20),

                  Row(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      Text(
                        (langUserPhone == "fr") ? 'Gratuit' : 'Free',
                        style: GoogleFonts.poppins(
                          fontSize: 20,
                          fontWeight: FontWeight.w800,
                          color: Colors.green,
                        ),
                        textAlign: TextAlign.center,
                      ),
                      const SizedBox(width: 10),
                      Switch(
                        trackOutlineColor: MaterialStateColor.resolveWith(
                            (states) => primaryColor),
                        activeColor: Colors.red,
                        activeTrackColor: primaryColor,
                        inactiveThumbColor: Colors.green,
                        inactiveTrackColor: primaryColor,
                        value: load,
                        onChanged: (bool? newValue) {
                          setState(() {
                            if (newValue == true) {
                              load = true;
                            } else {
                              load = false;
                            }
                          });
                        },
                      ),
                      const SizedBox(width: 10),
                      Text(
                        (langUserPhone == "fr") ? 'Payant' : 'Paid',
                        style: GoogleFonts.poppins(
                          fontSize: 20,
                          fontWeight: FontWeight.w800,
                          color: Colors.red,
                        ),
                        textAlign: TextAlign.center,
                      ),
                    ],
                  ),

                  const SizedBox(height: 20),
                  // Formulaire
                  load ? RegisterForm2() : RegisterForm(),

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

class RegisterForm extends StatefulWidget {
  @override
  State<RegisterForm> createState() => _RegisterFormState();
}

class _RegisterFormState extends State<RegisterForm> {
  bool _desactive = false;
  bool loading_formule_gratuit = false;
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
    bool isConnected = await isConnectedToInternet();
    if (isConnected) {
      setState(() {
        _desactive = true;
        loading_formule_gratuit = true;
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
            loading_formule_gratuit = false;
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
        loading_formule_gratuit = false;
      });
    }
  }

  void newBoost() async {
    if (telIsVerified == true) {
      bool isConnected = await isConnectedToInternet();
      if (isConnected) {
        setState(() {
          _desactive = true;
        });

        var request = http.MultipartRequest(
            'POST', Uri.parse('$generalRouteForApi/newBoost'));
        request.fields.addAll({
          'uid': uidUser,
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
                duration: const Duration(seconds: 15),
                content: Text(
                  data["message"],
                  style: GoogleFonts.poppins(
                    color: Colors.white,
                  ),
                ),
              ));
              Navigator.pop(context);
              Navigator.push(
                context,
                MaterialPageRoute(
                    builder: (context) => ListeBoostContactPage()),
              );
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
      if (langUserPhone != "fr") {
        dangerNoti("Access denied !",
            "Please confirm your WhatsApp number first.", context);
      } else {
        dangerNoti("Accès Refusé !",
            "Veuillez d'abord confirmer votre numéro WhatsApp.", context);
      }
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
          ? "Cette formule vous offre un boost de $jours jour(s) pour $prix Bonus."
          : "This formula offers you a boost of $jours day(s) for $prix Bonus.";
    });
  }

  @override
  void initState() {
    super.initState();
    listeFormuleBoost(); // Loading the diary when the app starts
  }

  @override
  Widget build(BuildContext context) {
    return Container(
      child: Column(
        children: [
          loading_formule_gratuit
              ? const Center(
                  child: CircularProgressIndicator(),
                )
              : DelayedAnimation(
                  delay: 0, // 1500,
                  child: SelectFormField(
                    decoration: const InputDecoration(
                      labelText: 'Formules de Boost',
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
                      showConfNumeroWhatsapp(context);
                    } else {
                      _desactive ? null : newBoost();
                    }
                  },
                ),
              )),
        ],
      ),
    );
  }
}

class RegisterForm2 extends StatefulWidget {
  @override
  State<RegisterForm2> createState() => _RegisterForm2State();
}

class _RegisterForm2State extends State<RegisterForm2> {
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

  void listeFormuleBoost() async {
    bool isConnected = await isConnectedToInternet();
    if (isConnected) {
      setState(() {
        _desactive2 = true;
        loading_formule_payant = true;
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
            loading_formule_payant = false;
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
          ? "Cette formule vous offre un boost de $jours jour(s) pour $prix FCFA."
          : "This formula offers you a boost of $jours day(s) for $prix FCFA.";
    });
  }

  onChangeMethodePaiement(val) async {
    setState(() {
      valueMethodePaiement = val;
    });
  }

  void newBoostPayant() async {
    if (telIsVerified == true) {
      bool isConnected = await isConnectedToInternet();
      if (isConnected) {
        setState(() {
          _desactive2 = true;
        });

        var request = http.MultipartRequest(
            'POST', Uri.parse('$generalRouteForApi/newBoostPayant'));
        request.fields.addAll({
          'uid': uidUser,
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
                      ? "Après confirmation du paiement, veuillez consulter la liste de vos boosts."
                      : "After payment confirmation, please view the list of your boosts.",
                  context);
            } else {
              launchPaiement(data["url"]);
              Navigator.pop(context);
              showNotification(
                  (langUserPhone == "fr")
                      ? "Paiement en cours !"
                      : "Payment in progress !",
                  (langUserPhone == "fr")
                      ? "Après confirmation du paiement, veuillez consulter la liste de vos boosts."
                      : "After payment confirmation, please view the list of your boosts.");
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
      if (langUserPhone != "fr") {
        dangerNoti("Access denied !",
            "Please confirm your WhatsApp number first.", context);
      } else {
        dangerNoti("Accès Refusé !",
            "Veuillez d'abord confirmer votre numéro WhatsApp.", context);
      }
      setState(() {
        _desactive2 = false;
      });
    }
  }

  void checkTransaction(idTransaction) async {
    if (telIsVerified == true) {
      bool isConnected = await isConnectedToInternet();
      if (isConnected) {
        setState(() {
          _desactive2 = true;
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
                _desactive2 = false;
              });
            } else if (data["transaction"] == true) {
              successNoti(data["titre"], data["message"], context);

              ScaffoldMessenger.of(context).showSnackBar(SnackBar(
                behavior: SnackBarBehavior.floating,
                content: Text(data["message"]),
              ));

              setState(() {
                _desactive2 = false;
              });
            }
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
      if (langUserPhone != "fr") {
        dangerNoti("Access denied !",
            "Please confirm your WhatsApp number first.", context);
      } else {
        dangerNoti("Accès Refusé !",
            "Veuillez d'abord confirmer votre numéro WhatsApp.", context);
      }
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
    return Container(
      child: Column(
        children: [
          loading_formule_payant
              ? const Center(
                  child: CircularProgressIndicator(),
                )
              : DelayedAnimation(
                  delay: 0, // 1500,
                  child: SelectFormField(
                    decoration: const InputDecoration(
                      labelText: 'Formules de Boost Payant',
                      border: OutlineInputBorder(),
                    ),
                    type: SelectFormFieldType.dropdown,
                    initialValue: '0',
                    labelText: 'Formules de Boost Payant',
                    items: listeDesFormules,
                    onChanged: (val) => onChangeFormulBoost(val),
                    onSaved: (val) => print(val),
                  ),
                ),
          const SizedBox(height: 10),
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
          const SizedBox(height: 10),
          DelayedAnimation(
            delay: 0, // 1500,
            child: SelectFormField(
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
          ),
          const SizedBox(height: 10),
          DelayedAnimation(
            delay: 0, // 1500,
            child: TextField(
              controller: telController,
              decoration: InputDecoration(
                labelStyle: TextStyle(color: Colors.grey[400]),
                labelText: 'Indicatif + Numéro du paiement',
                border: const OutlineInputBorder(),
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
                    showConfNumeroWhatsapp(context);
                  } else {
                    _desactive2 ? null : newBoostPayant();
                  }
                },
              ),
            ),
          ),
          const SizedBox(height: 10),
          DelayedAnimation(
            delay: 0, // 1500,
            child: Text(
              (langUserPhone == "fr")
                  ? "Pour payer par Wave ou Carte Bancaire, veuillez contacter l'Assistance Dressur par WhatsApp. Merci..."
                  : "To pay by Wave or Credit Card, please contact Dressur Support by WhatsApp. THANKS...",
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
    );
  }
}
