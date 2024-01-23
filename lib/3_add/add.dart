// ignore_for_file: prefer_const_constructors

import 'dart:async';
import 'dart:convert';
import 'dart:io';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/5_autre/confirme_mail_user.dart';
import 'package:dressur/6_notification/liste_notification.dart';
import 'package:dressur/components/advertisements.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/noti.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;
import 'package:flutter_contacts/flutter_contacts.dart';
import 'package:share_plus/share_plus.dart';
import 'package:dressur/components/sociaux.dart';
import 'package:dressur/components/sql_helper.dart';
import 'package:dressur/5_autre/support_assistance.dart';
import 'liste_contact_add_disponible.dart';

class ActuPage extends StatefulWidget {
  ActuPage({Key? key}) : super(key: key);

  @override
  State<ActuPage> createState() => _ActuPageState();
}

class _ActuPageState extends State<ActuPage> {
  bool _loading = false;
  List<Map<String, dynamic>> historiqueContactsAdd = [];
  bool _isExpanded = true;
  Timer? _timer;

  @override
  void dispose() {
    // Arrête le timer lors de la suppression du widget
    _stopTimer();
    super.dispose();
  }

  void _startTimer() {
    // Crée un nouveau timer qui exécute la fonction everySecond toutes les secondes
    _timer = Timer.periodic(Duration(seconds: 1), (timer) {
      everySecond();
    });
  }

  void _stopTimer() {
    // Arrête et annule le timer
    _timer?.cancel();
    _timer = null;
  }

  void everySecond() {
    // Code à exécuter toutes les secondes
    setState(() {
      nombreContactDispo = nombreContactDispo;
    });
  }

  void actualise() async {
    setState(() {
      _loading = true;
    });
    dynamic youHaveNetWork = "";
    youHaveConnexion();
    youHaveNetWork = await SQLHelper.getYouHaveConnexion();
    while (youHaveNetWork.length == 0) {
      youHaveNetWork = await SQLHelper.getYouHaveConnexion();
    }
    var request = http.MultipartRequest(
        'POST', Uri.parse('$generalRouteForApi/getUserInfo'));
    request.fields
        .addAll({'uid': uidUser, 'langUserPhone': langUserPhone.toString()});

    http.StreamedResponse response = await request.send();

    if (response.statusCode == 200) {
      var data1 = await response.stream.bytesToString();
      var data = convert.jsonDecode(data1);
      if (data["error"] == false) {
        setState(() {
          initUserInformations(data['user']);
          _loading = false;
        });
      } else {
        setState(() {
          _loading = false;
        });
      }
    } else {
      setState(() {
        _loading = false;
      });
    }
  }

  void _showMessagePasPermiAdd(message, context) async {
    showModalBottomSheet(
      context: context,
      shape: const RoundedRectangleBorder(
        borderRadius: BorderRadius.only(
          topLeft: Radius.circular(20.0),
          topRight: Radius.circular(20.0),
        ),
      ),
      elevation: 5,
      isScrollControlled: true,
      builder: (_) => Container(
        decoration: const BoxDecoration(
          gradient: LinearGradient(
            begin: Alignment.topCenter,
            end: Alignment.bottomCenter,
            colors: [
              Colors.red,
              Colors.redAccent,
            ],
          ),
        ),
        padding: EdgeInsets.only(
          top: 0,
          left: 0,
          right: 0,
          // this will prevent the soft keyboard from covering the text fields
          bottom: MediaQuery.of(context).viewInsets.bottom + 0,
        ),
        child: Container(
          padding: const EdgeInsets.fromLTRB(16, 16, 16, 16),
          child: Text(
            message,
            style: GoogleFonts.poppins(
              fontSize: 14,
              color: Colors.white,
            ),
            textAlign: TextAlign.justify,
          ),
        ),
      ),
    );
  }

  void addTousLesContacts() async {
    setState(() {
      _loading = true;
    });
    var request = http.MultipartRequest(
        'POST', Uri.parse('$generalRouteForApi/addTousUserContact'));
    request.fields.addAll({
      'uid': uidUser,
      'langUserPhone': langUserPhone.toString(),
    });

    http.StreamedResponse response = await request.send();

    if (response.statusCode == 200) {
      var data1 = await response.stream.bytesToString();
      var data = jsonDecode(data1);
      if (data["error"] == true) {
        if (data["permissionAdd"] == false) {
          setState(() {
            permissionAdd = false;
            messageErreurPermissionAdd = data["messageErreurPermissionAdd"];
          });
          await saveContactsAddsIfExiste(data);
          // tu a deja depasser
          _showMessagePasPermiAdd(messageErreurPermissionAdd, context);
        }
      } else if (data["error"] == false) {
        await saveContactsAddsIfExiste(data);
      } else {
        // erreur server heinnn
      }

      setState(() {
        _loading = false;
      });
    } else {
      setState(() {
        _loading = false;
      });
    }
  }

  Future<void> saveContactsAddsIfExiste(data) async {
    int nombreAddNow = 0;
    if ((data["contactsAdd"]).length >= 1) {
      for (var contactAdd in data["contactsAdd"]) {
        if ((await SQLHelper.getOneNumsTelUser(contactAdd['tel'])).isEmpty) {
          final newContact = Contact()
            ..name.first = contactAdd["pseudo"] + " #DS"
            ..phones = [Phone(contactAdd["tel"])];
          await newContact.insert();
          await insertNumTelUserIntoDataBase(contactAdd["tel"]);
        }
      }
      setState(() {
        nombreAddNow = (data["contactsAdd"]).length;
        nombreContactDispo = nombreContactDispo - nombreAddNow;
      });
      ScaffoldMessenger.of(context).showSnackBar(SnackBar(
        content: (langUserPhone == "fr")
            ? Text('ADD  de  $nombreAddNow contact(s) avec succès.')
            : Text('ADD of $nombreAddNow contacts successfully.'),
        duration: const Duration(milliseconds: 15000),
      ));
    }
  }

  Future<bool> _onWillPop() async {
    return (await showDialog(
          context: context,
          builder: (context) => AlertDialog(
            title: (langUserPhone == "fr")
                ? const Text('Êtes-vous sûr?')
                : const Text('Are you sure?'),
            content: (langUserPhone == "fr")
                ? const Text("Voulez-vous quitter l'application ?")
                : const Text("Do you want to quit the application ?"),
            actions: <Widget>[
              TextButton(
                onPressed: () =>
                    Navigator.of(context).pop(false), //<-- SEE HERE
                child: (langUserPhone == "fr")
                    ? const Text('Non')
                    : const Text('No'),
              ),
              TextButton(
                onPressed: () {
                  if (Platform.isAndroid) {
                    SystemNavigator.pop();
                  } else if (Platform.isIOS) {
                    exit(0);
                  }
                }, // <-- SEE HERE
                child: (langUserPhone == "fr")
                    ? const Text('Oui')
                    : const Text('Yes'),
              ),
            ],
          ),
        )) ??
        false;
  }

  void _showPasDeContactAdd(context) async {
    showModalBottomSheet(
      context: context,
      elevation: 5,
      isScrollControlled: true,
      builder: (_) => Container(
        padding: EdgeInsets.only(
          top: 0,
          left: 0,
          right: 0,
          // this will prevent the soft keyboard from covering the text fields
          bottom: MediaQuery.of(context).viewInsets.bottom + 0,
        ),
        child: PasDeContactAdd(),
      ),
    );
  }

  Future<void> executeAfterDelay() async {
    await Future.delayed(const Duration(seconds: 5));
    // Code à exécuter après le délai de 10 secondes
    setState(() {
      _isExpanded = false;
    });
  }

  @override
  void initState() {
    super.initState();
    executeAfterDelay();
    // Démarre le timer lors de l'initialisation du widget
    _startTimer();
  }

  @override
  Widget build(BuildContext context) {
    return WillPopScope(
      onWillPop: _onWillPop,
      child: Scaffold(
        appBar: AppBar(
          automaticallyImplyLeading: false,
          elevation: 0,
          backgroundColor: primaryColor,
          title: Text(
            (langUserPhone == "fr") ? "Actu" : "News",
            style: GoogleFonts.poppins(
              fontWeight: FontWeight.w600,
            ),
          ),
          actions: [
            IconButton(
              icon: const Icon(Icons.notifications),
              onPressed: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(
                    builder: (context) => ListeNotification(),
                  ),
                );
              },
            ),
            const Padding(
              padding: EdgeInsets.fromLTRB(0, 10, 0, 10),
              child: VerticalDivider(
                width: 0,
                color: Colors.white,
                thickness: 1,
              ),
            ),
            PopupMenuButton<int>(
              itemBuilder: (context) => [
                PopupMenuItem(
                  value: 1,
                  onTap: () {
                    _loading ? '' : actualise();
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
        body: SingleChildScrollView(
          child: Column(
            children: [
              const SizedBox(height: 10),
              Container(
                padding: const EdgeInsets.only(
                    left: 10, top: 0, right: 10, bottom: 0),
                child: ExpansionPanelList(
                  elevation: 1,
                  expandedHeaderPadding: EdgeInsets.zero,
                  animationDuration: const Duration(seconds: 1),
                  children: <ExpansionPanel>[
                    ExpansionPanel(
                      backgroundColor: Colors.red,
                      headerBuilder: (BuildContext context, bool isExpanded) {
                        return ListTile(
                          title: Text(
                            (langUserPhone == "fr")
                                ? "Message Très Important"
                                : "Very Important Message",
                            style: GoogleFonts.poppins(
                              fontWeight: FontWeight.w600,
                              color: Colors.white,
                            ),
                          ),
                          onTap: () {
                            setState(() {
                              _isExpanded = !isExpanded;
                            });
                          },
                        );
                      },
                      body: Card(
                        child: Container(
                          decoration: BoxDecoration(
                            borderRadius: BorderRadius.circular(3),
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
                                    ? "NB: Dressur ne peut garantir la bonne volonté et l'intégrité de tous ses utilisateurs, nous souhaitons attirer votre attention sur la question importante de la sécurité en ligne.\nMalheureusement, il existe des individus malveillants qui cherchent à arnaquer les utilisateurs innocents. Ensemble, nous pouvons prévenir les arnaques. Soyez vigilants, restez en sécurité. Signalez tous comportements que vous trouvez suspect."
                                    : "NB: Dressur cannot guarantee the goodwill and integrity of all of its users, we would like to draw your attention to the important issue of online security.\nUnfortunately, there are malicious individuals out there who seek to scam innocent users. Together we can prevent scams. Be vigilant, stay safe. Report any behavior you find suspicious.",
                                style: GoogleFonts.poppins(
                                  fontWeight: FontWeight.w600,
                                  fontSize: 16,
                                  color: Colors.white,
                                ),
                                textAlign: TextAlign.justify,
                              ),
                              const SizedBox(height: 10),
                            ],
                          ),
                        ),
                      ),
                      isExpanded: _isExpanded,
                    ),
                  ],
                  expansionCallback: (int index, bool isExpanded) {
                    setState(() {
                      _isExpanded = !isExpanded;
                    });
                  },
                ),
              ),
              const SizedBox(height: 5),
              const Padding(
                padding:
                    EdgeInsets.only(left: 50, top: 2, right: 50, bottom: 2),
                child: Divider(
                  height: 1,
                  thickness: 1,
                  color: Colors.grey,
                ),
              ),
              !mailIsVerified
                  ? Card(
                      margin: const EdgeInsets.only(
                          left: 10, top: 5, right: 10, bottom: 5),
                      child: Container(
                        decoration: BoxDecoration(
                          borderRadius: BorderRadius.circular(5),
                          gradient: const LinearGradient(
                            begin: Alignment.topCenter,
                            end: Alignment.bottomCenter,
                            colors: [
                              Colors.red,
                              Colors.white60,
                            ],
                          ),
                        ),
                        padding: const EdgeInsets.fromLTRB(10, 3, 10, 3),
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.stretch,
                          children: [
                            Text(
                              (langUserPhone == "fr")
                                  ? "Configurer votre compte"
                                  : "Configure your account",
                              style: GoogleFonts.poppins(
                                fontWeight: FontWeight.w600,
                                fontSize: 26,
                                color: Colors.white,
                              ),
                            ),
                            Text(
                              (langUserPhone == "fr")
                                  ? "Veuillez confirmer votre adresse mail pour pouvoir récupérer votre compte lorsque vous oubliez votre mot de passe..."
                                  : "Please confirm your email address so that you can recover your account when you forget your password...",
                              style: GoogleFonts.poppins(
                                fontWeight: FontWeight.w600,
                                fontSize: 16,
                              ),
                            ),
                            Row(
                              mainAxisAlignment: MainAxisAlignment.end,
                              children: [
                                Column(
                                  children: [
                                    SizedBox(
                                      width: MediaQuery.of(context).size.width *
                                          0.45,
                                      child: ElevatedButton(
                                          style: ElevatedButton.styleFrom(
                                            backgroundColor: primaryColor,
                                            shape: const StadiumBorder(),
                                            padding: const EdgeInsets.symmetric(
                                              vertical: 10,
                                            ),
                                          ),
                                          child: (langUserPhone == "fr")
                                              ? const Text("Confirmer mon Mail")
                                              : const Text("Confirm my email"),
                                          onPressed: () {
                                            Navigator.push(
                                              context,
                                              MaterialPageRoute(
                                                  builder: (context) =>
                                                      CodeMailConfirmePage()),
                                            );
                                          }),
                                    )
                                  ],
                                ),
                              ],
                            )
                          ],
                        ),
                      ),
                    )
                  : const SizedBox(height: 0),
              !mailIsVerified
                  ? const Padding(
                      padding: EdgeInsets.only(
                          left: 50, top: 2, right: 50, bottom: 2),
                      child: Divider(
                        height: 1,
                        thickness: 1,
                        color: Colors.grey,
                      ),
                    )
                  : const SizedBox(height: 0),
              !telIsVerified
                  ? Card(
                      margin: const EdgeInsets.only(
                          left: 10, top: 5, right: 10, bottom: 5),
                      child: Container(
                        decoration: BoxDecoration(
                          borderRadius: BorderRadius.circular(5),
                          gradient: const LinearGradient(
                            begin: Alignment.topCenter,
                            end: Alignment.bottomCenter,
                            colors: [
                              Colors.red,
                              Colors.white60,
                            ],
                          ),
                        ),
                        padding: const EdgeInsets.fromLTRB(10, 3, 10, 0),
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.stretch,
                          children: [
                            Text(
                              (langUserPhone == "fr")
                                  ? "Confirmation du numéro WhatsApp"
                                  : "WhatsApp Number Confirmation",
                              style: GoogleFonts.poppins(
                                fontWeight: FontWeight.w600,
                                fontSize: 20,
                                color: Colors.white,
                              ),
                            ),
                            const SizedBox(height: 10),
                            Text(
                              (langUserPhone == "fr")
                                  ? "Patientez quelques heures qu'un des administrateurs vérifie si le $tel est bien inscrit sur WhatsApp Messenger ou WhatsApp Business."
                                  : "Wait a few hours for one of the administrators to check if the $tel is registered on WhatsApp Messenger or WhatsApp Business.",
                              style: GoogleFonts.poppins(
                                fontWeight: FontWeight.w600,
                                fontSize: 16,
                              ),
                            ),
                            const SizedBox(height: 15),
                          ],
                        ),
                      ),
                    )
                  : const SizedBox(height: 0),
              !telIsVerified
                  ? const Padding(
                      padding: EdgeInsets.only(
                          left: 50, top: 2, right: 50, bottom: 2),
                      child: Divider(
                        height: 1,
                        thickness: 1,
                        color: Colors.grey,
                      ),
                    )
                  : const SizedBox(height: 0),
              Card(
                margin: const EdgeInsets.only(
                    left: 10, top: 5, right: 10, bottom: 5),
                child: Container(
                  decoration: BoxDecoration(
                    borderRadius: BorderRadius.circular(5),
                    gradient: const LinearGradient(
                      begin: Alignment.topCenter,
                      end: Alignment.bottomCenter,
                      colors: [
                        primaryColor,
                        secondaryColor,
                        Colors.white,
                      ],
                    ),
                  ),
                  padding: const EdgeInsets.fromLTRB(10, 0, 10, 3),
                  child: Column(
                    children: [
                      Row(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [
                          if (nombreContactDispo > 0)
                            Text(
                              (langUserPhone == "fr")
                                  ? "ADD DS Disponible"
                                  : "ADD DS Available",
                              style: GoogleFonts.poppins(
                                fontWeight: FontWeight.w600,
                                fontSize: 24,
                                color: Colors.white,
                              ),
                            ),
                          if (nombreContactDispo <= 0)
                            Text(
                              (langUserPhone == "fr")
                                  ? "ADD DS Indisponible"
                                  : "ADD DS Unavailable",
                              style: GoogleFonts.poppins(
                                fontWeight: FontWeight.w600,
                                fontSize: 24,
                                color: Colors.white,
                              ),
                            ),
                          IconButton(
                            onPressed: () {
                              _loading ? '' : actualise();
                            },
                            icon: const Icon(
                              Icons.refresh,
                              size: 25,
                            ),
                          ),
                        ],
                      ),
                      Text(
                        (langUserPhone == "fr")
                            ? "$nombreContactDispo contact(s) disponible(s) selon vos préférences pays."
                            : "$nombreContactDispo contact available according to your country preferences.",
                        style: GoogleFonts.poppins(
                          fontWeight: FontWeight.w600,
                          fontSize: 14,
                        ),
                      ),
                      Row(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [
                          Column(
                            children: [
                              SizedBox(
                                width: MediaQuery.of(context).size.width * 0.35,
                                child: ElevatedButton(
                                    style: ElevatedButton.styleFrom(
                                      backgroundColor:
                                          _loading ? Colors.red : primaryColor,
                                      shape: const StadiumBorder(),
                                      padding: const EdgeInsets.symmetric(
                                        vertical: 10,
                                      ),
                                    ),
                                    child: _loading
                                        ? const Text("Wait...")
                                        : (langUserPhone == "fr")
                                            ? const Text("Enregistrer tous")
                                            : const Text("Save all"),
                                    onPressed: () {
                                      if (!telIsVerified) {
                                        warningNoti(
                                            (langUserPhone == "fr")
                                                ? "Configurer votre compte"
                                                : "Configure your account",
                                            (langUserPhone == "fr")
                                                ? "Patientez encore svp. Votre numéro WhatsApp n'a pas encore été confirmé par un administrateur. Il le sera dans les plus brefs délais."
                                                : "Please wait again. Your WhatsApp number has not yet been confirmed by an administrator. It will be as soon as possible.",
                                            context);
                                      } else if (!mailIsVerified) {
                                        warningNoti(
                                            (langUserPhone == "fr")
                                                ? "Configurer votre compte"
                                                : "Configure your account",
                                            (langUserPhone == "fr")
                                                ? "Veuillez d'abord confirmer votre adresse mail...\n\nVous trouverez sur notre chaine YouTube des vidéos qui peuvent vous aider..."
                                                : "Please confirm your email address first...\n\nYou will find videos on our YouTube channel that can help you...",
                                            context);
                                      } else {
                                        if (nombreContactDispo > 0) {
                                          _loading ? '' : addTousLesContacts();
                                        } else {
                                          _showPasDeContactAdd(context);
                                        }
                                      }
                                    }),
                              )
                            ],
                          ),
                          Column(
                            children: [
                              SizedBox(
                                width: MediaQuery.of(context).size.width * 0.35,
                                child: ElevatedButton(
                                    style: ElevatedButton.styleFrom(
                                      backgroundColor: secondaryColor,
                                      shape: const StadiumBorder(),
                                      padding: const EdgeInsets.symmetric(
                                        vertical: 10,
                                      ),
                                    ),
                                    child: (langUserPhone == "fr")
                                        ? const Text("Voir la liste")
                                        : const Text("See the list"),
                                    onPressed: () {
                                      if (nombreContactDispo > 0) {
                                        Navigator.push(
                                          context,
                                          MaterialPageRoute(
                                              builder: (context) =>
                                                  ListeContactAAddPage()),
                                        );
                                      } else {
                                        _showPasDeContactAdd(context);
                                      }
                                    }),
                              )
                            ],
                          ),
                        ],
                      )
                    ],
                  ),
                ),
              ),
              const Padding(
                padding:
                    EdgeInsets.only(left: 50, top: 2, right: 50, bottom: 2),
                child: Divider(
                  height: 1,
                  thickness: 1,
                  color: Colors.grey,
                ),
              ),
              const SizedBox(height: 5),
              if (havePublicites == true)
                Column(
                  children: [
                    AdvertisementListPage(),
                    const SizedBox(height: 5),
                    const Padding(
                      padding: EdgeInsets.only(
                          left: 50, top: 2, right: 50, bottom: 2),
                      child: Divider(
                        height: 1,
                        thickness: 1,
                        color: Colors.grey,
                      ),
                    ),
                    const SizedBox(height: 5),
                  ],
                ),
              SociauxPage(),
              const SizedBox(height: 5),
            ],
          ),
        ),
      ),
    );
  }
}

class PasDeContactAdd extends StatefulWidget {
  PasDeContactAdd({Key? key}) : super(key: key);

  @override
  State<PasDeContactAdd> createState() => _PasDeContactAddState();
}

class _PasDeContactAddState extends State<PasDeContactAdd> {
  @override
  Widget build(BuildContext context) {
    return Column(
      mainAxisSize: MainAxisSize.min,
      crossAxisAlignment: CrossAxisAlignment.end,
      children: [
        Container(
          padding: const EdgeInsets.fromLTRB(10, 5, 10, 5),
          decoration: BoxDecoration(
            borderRadius: BorderRadius.circular(5),
            gradient: const LinearGradient(
              begin: Alignment.topCenter,
              end: Alignment.bottomCenter,
              colors: [
                Colors.indigoAccent,
                Colors.indigo,
              ],
            ),
          ),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(
                (langUserPhone == "fr")
                    ? 'ADD DS Indisponible'
                    : 'ADD DS Unavailable',
                style: TextStyle(
                  color: Colors.white,
                  fontSize: 25,
                  fontWeight: FontWeight.bold,
                ),
              ),
              const SizedBox(height: 10),
              Text(
                (langUserPhone == "fr")
                    ? "Pour le moment, aucun des contacts correspondant à vos préférences pays n'a fait de boost. Vous pouvez faire un boost pour qu'ils puissent vous enregistrer.\n\nLorsque vous faites un boost, vous avez accès à plus de contact, dans le cas contraire, vous êtes limités aux utilisateurs qui ont fait un boost."
                    : "For the moment, none of the contacts corresponding to your country preferences have been boosted. You can boost so they can check you in.\n\nWhen you boost you have access to more contacts, otherwise you are limited to users who have boosted.",
                style: const TextStyle(
                  color: Colors.white,
                  fontSize: 17,
                ),
              ),
              const SizedBox(height: 10),
              Text(
                (langUserPhone == "fr")
                    ? "Partager votre code de parrainage pour avoir plus de filleuls et surtout accompagner ses derniers durant tout le long du processus. Assurez-vous que vos filleuls ont utilisé votre code de parrainage et qu'ils ont compris comment fonctionne l'application Dressur."
                    : "Share your sponsorship code to have more referrals and above all to accompany them throughout the process. Make sure your referrals have used your referral code and understood how the Dressur app works.",
                style: const TextStyle(
                  color: Colors.white,
                  fontSize: 16,
                  fontWeight: FontWeight.w200,
                ),
              ),
              const SizedBox(height: 10),
              ElevatedButton(
                style: ElevatedButton.styleFrom(
                  backgroundColor: Colors.orange,
                  shape: const StadiumBorder(),
                  padding: const EdgeInsets.symmetric(
                    vertical: 13,
                    horizontal: 23,
                  ),
                ),
                child: Text((langUserPhone == "fr") ? "PARTAGER" : "SHARE",
                    style: GoogleFonts.poppins(
                      fontWeight: FontWeight.w600,
                      color: Colors.white,
                    )),
                onPressed: () async {
                  var messageShare = (langUserPhone == "fr")
                      ? "Utilise Dressur, une application simple, sûr et fiable pour avoir de la visibilité sur tes différents réseaux sociaux et surtout sur tes statuts WhatsApp.\nGrâce à Dressur, fait la promotion de tes produits et services qui seront visibles par des milliers d'utilisateurs en seulement 24H.\nElle te permet d'avoir plus facilement des contacts WhatsApp selon les pays de ton choix. De plus, ses contacts sont automatiquement enregistrés dans ton téléphone et ton contact dans les leurs, etc.\n\nA télécharger gratuitement sur Play Store : https://play.google.com/store/apps/details?id=com.ds.dressur \n\nVoici mon code parrainage : $codeBonus\n\nIl te donnera $commissionBonus Points Bonus pour tester les services de l'application."
                      : "Use Dressur, a simple, safe and reliable application to have visibility on your various social networks and especially on your WhatsApp statuses.\nThanks to Dressur, promote your products and services which will be visible to thousands of users online. only 24H.\nIt allows you to have WhatsApp contacts more easily according to the countries of your choice. In addition, his contacts are automatically saved in your phone and your contact in theirs, etc.\n\nA download for free on Play Store: https://play.google.com/store/apps/details?id=com.ds.dressur \n\nHere is my referral code: $codeBonus\n\nIt will give you $commissionBonus Points Bonus to test the services of the application.";
                  await Share.share(messageShare, subject: 'Partager Dressur!');
                },
              ),
            ],
          ),
        ),
      ],
    );
  }
}
