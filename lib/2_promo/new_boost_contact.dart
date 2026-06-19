// ignore_for_file: use_build_context_synchronously

import 'package:dressur/2_promo/liste_boost_contact.dart';
import 'package:dressur/components/noti_sys.dart';
import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:google_fonts/google_fonts.dart';
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
  String _typeBoost = 'date';
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
            color: Colors.white,
            fontWeight: FontWeight.w400,
            fontSize: 18,
          ),
        ),
        leading: IconButton(
          onPressed: () {
            Navigator.pop(context);
          },
          icon: const FaIcon(
            FontAwesomeIcons.chevronLeft,
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
                          ? "Informations : \n- Les Boosts Payant sont beaucoup plus mis en avant ! Il est donc conseillé de faire des Boosts Payant plutôt que Gratuit.\n- Il n'est pas possible de connaitre à l'avance le nombre de contacts après boost ni la tranche rapproché. \n- Vous pouvez programmer plusieurs Boosts Contact Payant. \n-Votre Boost Contact Devient Inactif si votre dernière connexion remonte à plus de 48H. Connectez-vous donc au minimum une fois par jour pour récupérer les contacts obtenus. \n- Après un Boost Contact Gratuit, vous etès obligé de faire au moins un Boost Conatct Payant avant de pouvoir faire encore un Boost Contact Gratuit. \n- Après un Boost Contact, vous vous connectez chaque jour pour que les nouveaux contacts soient enregistrés directement dans votre téléphone."
                          : "Information: \n- Paid Boosts are much more prominently featured! It is therefore advisable to use Paid Boosts rather than Free ones. \n- It is not possible to know in advance the number of contacts after a boost or the next contact period. \n- You can schedule several Paid Contact Boosts. \n- Your Contact Boost becomes inactive if your last login was more than 48 hours ago. Therefore, log in at least once a day to retrieve the contacts obtained. \n- After a Free Contact Boost, you must complete at least one Paid Contact Boost before you can perform another Free Contact Boost. \n- After a Contact Boost, you log in every day so that new contacts are saved directly to your phone.",
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
                  Text(
                    (langUserPhone == "fr")
                        ? "Après BOOST, votre numéro sera visible dans les pays que vous avez choisie au niveau de vos préférences pendant un certain temps."
                        : "After BOOST, your number will be visible in the countries you have chosen in your preferences for a certain time.",
                    style: GoogleFonts.poppins(
                      fontSize: 16,
                    ),
                    textAlign: TextAlign.center,
                  ),

                  const SizedBox(height: 20),
                  // --- Sélecteur de type ---
                  Row(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      Expanded(
                        child: GestureDetector(
                          onTap: () => setState(() => _typeBoost = 'date'),
                          child: Container(
                            padding: const EdgeInsets.symmetric(vertical: 12),
                            decoration: BoxDecoration(
                              color: _typeBoost == 'date' ? primaryColor : Colors.grey[200],
                              borderRadius: const BorderRadius.only(
                                topLeft: Radius.circular(25),
                                bottomLeft: Radius.circular(25),
                              ),
                            ),
                            child: Text(
                              langUserPhone == "fr" ? "Par durée" : "By duration",
                              textAlign: TextAlign.center,
                              style: GoogleFonts.poppins(
                                fontWeight: FontWeight.w600,
                                color: _typeBoost == 'date' ? Colors.white : Colors.black54,
                              ),
                            ),
                          ),
                        ),
                      ),
                      Expanded(
                        child: GestureDetector(
                          onTap: () => setState(() => _typeBoost = 'quota'),
                          child: Container(
                            padding: const EdgeInsets.symmetric(vertical: 12),
                            decoration: BoxDecoration(
                              color: _typeBoost == 'quota' ? primaryColor : Colors.grey[200],
                              borderRadius: const BorderRadius.only(
                                topRight: Radius.circular(25),
                                bottomRight: Radius.circular(25),
                              ),
                            ),
                            child: Text(
                              langUserPhone == "fr" ? "Par contacts" : "By contacts",
                              textAlign: TextAlign.center,
                              style: GoogleFonts.poppins(
                                fontWeight: FontWeight.w600,
                                color: _typeBoost == 'quota' ? Colors.white : Colors.black54,
                              ),
                            ),
                          ),
                        ),
                      ),
                    ],
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
                  load ? RegisterForm2(typeBoost: _typeBoost) : RegisterForm(typeBoost: _typeBoost),

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
  final String typeBoost;
  const RegisterForm({super.key, required this.typeBoost});
  @override
  State<RegisterForm> createState() => _RegisterFormState();
}

class _RegisterFormState extends State<RegisterForm> {
  bool _desactive = false;
  bool loading_formule_gratuit = false;
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
            listeMethodePaiements =
                (data["listeMethodePaiements"] as List<dynamic>)
                    .map((item) => item as Map<String, dynamic>)
                    .toList();
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
          'typeBoost': widget.typeBoost,
        });

        http.StreamedResponse response = await request.send();

        if (response.statusCode == 200) {
          var data1 = await response.stream.bytesToString();
          var data = convert.jsonDecode(data1);
          if (data["error"] == false) {
            cancelBoostReminderNotification();
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
    });
  }

  @override
  void initState() {
    super.initState();
    // listeFormuleBoost(); // Loading the diary when the app starts
  }

  @override
  Widget build(BuildContext context) {
    return Container(
      child: Column(
        children: [
          const SizedBox(height: 20),
          Text(
            widget.typeBoost == 'quota'
                ? (langUserPhone == "fr")
                    ? "Demander un Boost Contact Gratuit limité à 20 contacts"
                    : "Request a Free Contact Boost limited to 20 contacts"
                : (langUserPhone == "fr")
                    ? "Demander un Boost Contact Gratuit de 05 jours"
                    : "Request a Free 5-Day Contact Boost",
            style: GoogleFonts.poppins(fontSize: 16),
            textAlign: TextAlign.center,
          ),
          const SizedBox(height: 20),
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
                _desactive
                    ? (langUserPhone == "fr")
                        ? "Patientez..."
                        : "Wait..."
                    : (langUserPhone == "fr")
                        ? "Demander un Boost Gratuit"
                        : "Request a Free Boost",
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
          ),
        ],
      ),
    );
  }
}

class RegisterForm2 extends StatefulWidget {
  final String typeBoost;
  const RegisterForm2({super.key, required this.typeBoost});
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
  int? nbContactsMax;

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
            final toutes = (data["listeFormulBoost"] as List<dynamic>)
                .map((item) => item as Map<String, dynamic>)
                .toList();
            listeDesFormules = toutes
                .where((f) => f['typeBoost'] == widget.typeBoost && f['prix'] > 0)
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
          nbContactsMax = service['nbContactsMax'];
        });
      }
    }
    setState(() {
      idFormulBoost = val;
      if (widget.typeBoost == 'quota') {
        _message = (langUserPhone == "fr")
            ? "Cette formule vous offre un boost de $nbContactsMax contact(s) pour $prix FCFA."
            : "This plan offers a boost of $nbContactsMax contact(s) for $prix FCFA.";
      } else {
        _message = (langUserPhone == "fr")
            ? "Cette formule vous offre un boost de $jours jour(s) pour $prix FCFA."
            : "This formula offers you a boost of $jours day(s) for $prix FCFA.";
      }
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
          'tel': telController.text,
          'typeBoost': widget.typeBoost,
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
                  child: CircularProgressIndicator(color: primaryColor),
                )
              : SelectFormField(
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
          const SizedBox(height: 10),
          Text(
            _message,
            style: GoogleFonts.poppins(
              fontSize: 16,
            ),
            textAlign: TextAlign.center,
          ),
          const SizedBox(height: 10),
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
          const SizedBox(height: 10),
          TextField(
            controller: telController,
            decoration: InputDecoration(
              labelStyle: GoogleFonts.poppins(color: Colors.grey[400]),
              labelText: 'Indicatif + Numéro du paiement',
              border: const OutlineInputBorder(),
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
                } else {
                  _desactive2 ? null : newBoostPayant();
                }
              },
            ),
          ),
          const SizedBox(height: 10),
        ],
      ),
    );
  }
}
