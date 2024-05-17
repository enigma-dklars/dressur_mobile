// ignore_for_file: prefer_const_constructors, use_build_context_synchronously, deprecated_member_use

import 'dart:async';
import 'dart:convert';
import 'dart:io';
import 'package:dressur/2_promo/new_boost_contact.dart';
import 'package:dressur/5_autre/cart_visite.dart';
import 'package:dressur/components/padding_and_divider.dart';
import 'package:dressur/components/pub_smt_2024.dart';
import 'package:flutter/material.dart';
import 'package:flutter/rendering.dart';
import 'package:flutter/services.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/5_autre/confirme_mail_user.dart';
import 'package:dressur/1_reception/liste_notification.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/noti.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;
import 'package:flutter_contacts/flutter_contacts.dart';
import 'package:dressur/components/sociaux.dart';
import 'package:dressur/components/sql_helper.dart';
import 'package:dressur/5_autre/support_assistance.dart';
import 'package:url_launcher/url_launcher.dart';
import 'liste_contact_add_disponible.dart';
import 'package:share_plus/share_plus.dart';

class Advertisement {
  final String uidUser;
  final int id;
  final String image;
  final String description;
  final String whatsappNumber;
  final String pseudoAnnonceur;
  final String nombreDeVues;
  final String nombreImpression;

  Advertisement({
    required this.uidUser,
    required this.id,
    required this.image,
    required this.description,
    required this.whatsappNumber,
    required this.pseudoAnnonceur,
    required this.nombreDeVues,
    required this.nombreImpression,
  });
}

class ActuPage extends StatefulWidget {
  ActuPage({Key? key}) : super(key: key);

  @override
  State<ActuPage> createState() => _ActuPageState();
}

class _ActuPageState extends State<ActuPage> {
  final ScrollController _scrollController = ScrollController();

  final ValueNotifier<bool> _showFabText = ValueNotifier(true);
  bool _loading = false;
  List<Map<String, dynamic>> historiqueContactsAdd = [];
  Timer? _timer;

  bool havePublicites = false;
  bool rechercheEnCours = true;
  late Future<List<Advertisement>> _futureAdvertisements;
  bool _firstLoad = true;

  @override
  void initState() {
    super.initState();
    _scrollController.addListener(_scrollListener);
    // Démarre le timer lors de l'initialisation du widget
    _startTimer();
  }

  @override
  void dispose() {
    _scrollController.removeListener(_scrollListener);
    _scrollController.dispose();
    _showFabText.dispose();
    // Arrête le timer lors de la suppression du widget
    _stopTimer();
    super.dispose();
  }

  void _scrollListener() {
    if (_scrollController.position.userScrollDirection ==
        ScrollDirection.reverse) {
      _showFabText.value = false;
    } else if (_scrollController.position.atEdge &&
        _scrollController.position.pixels == 0) {
      _showFabText.value = true;
    }
  }

  Future<void> _refreshData() async {
    setState(() {
      actualise(true);
    });
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

  void actualise(affMessage) async {
    if (affMessage == true) {
      ScaffoldMessenger.of(context).showSnackBar(SnackBar(
        backgroundColor: Colors.red,
        behavior: SnackBarBehavior.floating,
        content: Text(
          (langUserPhone == "fr")
              ? 'Actualisation en cours…'
              : 'Update in progress…',
          style: GoogleFonts.poppins(
            color: Colors.white,
          ),
        ),
      ));
    }
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
          havePublicites = data['user']["havePublicites"];
          _futureAdvertisements =
              fetchAdvertisements(data['user']["lesPublicites"]);
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
    if (affMessage == true) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          backgroundColor: Colors.green,
          behavior: SnackBarBehavior.floating,
          content: Text(
            (langUserPhone == "fr")
                ? 'Actualisation terminée.'
                : 'Refresh complete.',
            style: GoogleFonts.poppins(
              color: Colors.white,
            ),
          ),
        ),
      );
    }
  }

  Future<List<Advertisement>> fetchAdvertisements(lesPublicites) async {
    if (lesPublicites.toString().isNotEmpty) {
      final jsonData = jsonDecode(lesPublicites) as List<dynamic>;

      final advertisements = jsonData.map((data) {
        return Advertisement(
          uidUser: data['uidUser'],
          id: data['id'],
          image: generalRouteForPromotionImage + data['image'],
          description: data['description'],
          whatsappNumber: data['whatsappNumber'],
          pseudoAnnonceur: data['pseudoAnnonceur'],
          nombreDeVues: data['nombreDeVues'],
          nombreImpression: data['nombreImpression'],
        );
      }).toList();

      return advertisements;
    } else {
      return []; // Retourne une liste vide si aucune annonce n'est disponible
    }
  }

  Future<void> setPromotionToWatch(Advertisement advertisement) async {
    // Faites votre requête HTTP ici
    if (advertisement.uidUser != uidUser) {
      final response = await http.get(Uri.parse(
          '$generalRouteForApi/setPromotionToWatch/${advertisement.id}/$uidUser'));
      if (response.statusCode == 200) {
        // print(advertisement.id);
      }
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
        'POST',
        Uri.parse(
            '$generalRouteForApi/addTousUserContact/$uidUser/${langUserPhone.toString()}'));
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
            ..name.first = contactAdd["nom"] + " #DS"
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
        behavior: SnackBarBehavior.floating,
        content: (langUserPhone == "fr")
            ? Text('ADD de $nombreAddNow contact(s) avec succès.')
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

  void _showConfNumeroWhatsapp(context) async {
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
        child: ConfNumeroWhatsapp(),
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    if (_firstLoad) {
      WidgetsBinding.instance.addPostFrameCallback((_) {
        actualise(false);
      });
      setState(() {
        _firstLoad = false;
      });
    }
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
              color: Colors.white,
              fontWeight: FontWeight.w400,
            ),
          ),
          actions: [
            IconButton(
              icon: const Icon(
                Icons.qr_code_scanner,
                color: Colors.white,
              ),
              onPressed: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(
                    builder: (context) => CarteDeVisite(),
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
            IconButton(
              icon: const Icon(
                Icons.notifications,
                color: Colors.white,
              ),
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
                    _loading ? '' : actualise(true);
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
        body: Column(
          children: [
            Expanded(
              child: RefreshIndicator(
                onRefresh: _refreshData,
                child: ListView(
                  controller: _scrollController,
                  children: [
                    const SizedBox(height: 5),
                    if (nombreContactDispo <= 0 ||
                        telIsVerified == false ||
                        mailIsVerified == false)
                      Container(
                        padding: const EdgeInsets.fromLTRB(10, 5, 10, 5),
                        child: Text(
                          (langUserPhone == "fr") ? "À faire :" : "To do :",
                          style: GoogleFonts.poppins(
                            fontWeight: FontWeight.w300,
                            fontSize: 20,
                          ),
                        ),
                      ),
                    !telIsVerified
                        ? ListTile(
                            dense: true,
                            contentPadding: EdgeInsets.symmetric(
                                vertical: 0, horizontal: 10),
                            leading: Icon(
                              Icons.fiber_manual_record,
                              color: Colors.red,
                            ),
                            title: Text(
                              (langUserPhone == "fr")
                                  ? "Confirmation du numéro WhatsApp"
                                  : "WhatsApp Number Confirmation",
                              style: GoogleFonts.poppins(),
                            ),
                            onTap: () {
                              _showConfNumeroWhatsapp(context);
                            },
                          )
                        : const SizedBox(height: 0),
                    !mailIsVerified
                        ? ListTile(
                            dense: true,
                            contentPadding: EdgeInsets.symmetric(
                                vertical: 0, horizontal: 10),
                            leading: Icon(
                              Icons.fiber_manual_record,
                              color: Colors.red,
                            ),
                            title: Text(
                              (langUserPhone == "fr")
                                  ? "Confirmation de l'Email"
                                  : "Email Confirmation",
                              style: GoogleFonts.poppins(),
                            ),
                            onTap: () {
                              Navigator.push(
                                context,
                                MaterialPageRoute(
                                    builder: (context) =>
                                        CodeMailConfirmePage()),
                              );
                            },
                          )
                        : const SizedBox(height: 0),
                    (nombreContactDispo <= 0)
                        ? ListTile(
                            dense: true,
                            contentPadding: EdgeInsets.symmetric(
                                vertical: 0, horizontal: 10),
                            leading: Icon(
                              Icons.fiber_manual_record,
                              color: Colors.red,
                            ),
                            title: Text(
                              (langUserPhone == "fr")
                                  ? "Boost Contact"
                                  : "Boost Contact",
                              style: GoogleFonts.poppins(),
                            ),
                            onTap: () {
                              _showPasDeContactAdd(context);
                            },
                          )
                        : const SizedBox(height: 0),
                    if (nombreContactDispo > 0)
                      Card(
                        margin: const EdgeInsets.only(
                            left: 10, top: 5, right: 10, bottom: 5),
                        child: Container(
                          padding: const EdgeInsets.fromLTRB(10, 0, 10, 3),
                          child: Column(
                            children: [
                              Row(
                                mainAxisAlignment:
                                    MainAxisAlignment.spaceBetween,
                                children: [
                                  Text(
                                    (langUserPhone == "fr")
                                        ? "ADD DS Disponible"
                                        : "ADD DS Available",
                                    style: GoogleFonts.poppins(
                                      fontWeight: FontWeight.w500,
                                      color: primaryColor,
                                      fontSize: 24,
                                    ),
                                  ),
                                  IconButton(
                                    onPressed: () {
                                      _loading ? '' : actualise(true);
                                    },
                                    icon: const Icon(
                                      color: primaryColor,
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
                                  fontWeight: FontWeight.w300,
                                  fontSize: 14,
                                ),
                              ),
                              const SizedBox(height: 5),
                              Row(
                                mainAxisAlignment:
                                    MainAxisAlignment.spaceBetween,
                                children: [
                                  Column(
                                    children: [
                                      SizedBox(
                                        width:
                                            MediaQuery.of(context).size.width *
                                                0.42,
                                        child: ElevatedButton(
                                            style: ElevatedButton.styleFrom(
                                              backgroundColor: _loading
                                                  ? Colors.red
                                                  : primaryColor,
                                              shape: const StadiumBorder(),
                                              padding:
                                                  const EdgeInsets.symmetric(
                                                vertical: 10,
                                              ),
                                            ),
                                            child: Text(
                                              (_loading == true)
                                                  ? "Wait..."
                                                  : (langUserPhone == "fr")
                                                      ? "Enregistrer Tous"
                                                      : "Save All",
                                              style: GoogleFonts.poppins(
                                                color: Colors.white,
                                              ),
                                            ),
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
                                                _loading
                                                    ? ''
                                                    : addTousLesContacts();
                                              }
                                            }),
                                      )
                                    ],
                                  ),
                                  Column(
                                    children: [
                                      SizedBox(
                                        width:
                                            MediaQuery.of(context).size.width *
                                                0.42,
                                        child: ElevatedButton(
                                            style: ElevatedButton.styleFrom(
                                              backgroundColor: secondaryColor,
                                              shape: const StadiumBorder(),
                                              padding:
                                                  const EdgeInsets.symmetric(
                                                vertical: 10,
                                              ),
                                            ),
                                            child: Text(
                                              (langUserPhone == "fr")
                                                  ? "Voir la liste"
                                                  : "See the list",
                                              style: GoogleFonts.poppins(
                                                color: Colors.white,
                                              ),
                                            ),
                                            onPressed: () {
                                              Navigator.push(
                                                context,
                                                MaterialPageRoute(
                                                    builder: (context) =>
                                                        ListeContactAAddPage()),
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
                      ),
                    DressurDivider(),
                    SpecialPub(),
                    DressurDivider(),
                    if (havePublicites == true)
                      FutureBuilder<List<Advertisement>>(
                        future: _futureAdvertisements,
                        builder: (context, snapshot) {
                          if (snapshot.connectionState ==
                              ConnectionState.waiting) {
                            return const Center(
                              child:
                                  CircularProgressIndicator(), // Affichez un indicateur de chargement pendant que les données sont chargées
                            );
                          } else if (snapshot.hasError) {
                            return Center(
                              child: Text('Erreur: ${snapshot.error}'),
                            );
                          } else if (!snapshot.hasData ||
                              snapshot.data!.isEmpty) {
                            return const Center(
                              child: Text('Aucune annonce trouvée'),
                            );
                          } else {
                            return ListView.builder(
                              shrinkWrap: true,
                              physics: const NeverScrollableScrollPhysics(),
                              itemCount: snapshot.data!.length,
                              itemBuilder: (context, index) {
                                Advertisement advertisement =
                                    snapshot.data![index];
                                return Container(
                                  margin: const EdgeInsets.only(
                                      left: 7, top: 0, right: 7, bottom: 0),
                                  child: GestureDetector(
                                    onTap: () {
                                      setPromotionToWatch(advertisement);
                                      // Ouvrir la page de détails au clic sur l'image ou la description
                                      Navigator.push(
                                        context,
                                        MaterialPageRoute(
                                          builder: (context) =>
                                              AdvertisementDetailPage(
                                            advertisement: advertisement,
                                          ),
                                        ),
                                      );
                                    },
                                    child: Column(
                                      children: [
                                        const SizedBox(height: 1),
                                        Card(
                                          child: Column(
                                            children: [
                                              ClipRRect(
                                                borderRadius:
                                                    BorderRadius.circular(3),
                                                child: Image.network(
                                                  advertisement.image,
                                                  // height: 300,
                                                  // width: double.infinity,
                                                  // fit: BoxFit.cover,
                                                ),
                                              ),
                                              const SizedBox(height: 10),
                                              Padding(
                                                  padding:
                                                      const EdgeInsets.fromLTRB(
                                                          10, 0, 10, 10),
                                                  child: Column(
                                                    children: [
                                                      Text(
                                                        advertisement
                                                            .description,
                                                        maxLines: 5,
                                                        overflow: TextOverflow
                                                            .ellipsis,
                                                        style: const TextStyle(
                                                          fontWeight:
                                                              FontWeight.w400,
                                                          fontSize: 16,
                                                        ),
                                                      ),
                                                      const SizedBox(height: 5),
                                                      Row(
                                                        children: [
                                                          const Icon(
                                                              Icons.visibility),
                                                          const SizedBox(
                                                              width: 4),
                                                          Text(advertisement
                                                              .nombreImpression
                                                              .toString()),
                                                          const SizedBox(
                                                              width: 16),
                                                          const Icon(
                                                              Icons.touch_app),
                                                          const SizedBox(
                                                              width: 4),
                                                          Text(advertisement
                                                              .nombreDeVues
                                                              .toString()),
                                                        ],
                                                      )
                                                    ],
                                                  ))
                                            ],
                                          ),
                                        ),
                                        const SizedBox(height: 1),
                                        DressurDivider(),
                                      ],
                                    ),
                                  ),
                                );
                              },
                            );
                          }
                        },
                      ),
                    const SizedBox(height: 5),
                    SociauxPage(),
                    const SizedBox(height: 5),
                    // essai notification
                  ],
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class AdvertisementDetailPage extends StatelessWidget {
  final Advertisement advertisement;

  AdvertisementDetailPage({required this.advertisement});

  void openWhatsAppChat() async {
    String text;
    if (langUserPhone == "fr") {
      text =
          "Bonjour/Bonsoir *${advertisement.pseudoAnnonceur}*, j'ai une question concernant la promotion ci-dessous: \n\n";
    } else {
      text =
          "Good morning or Good evening *${advertisement.pseudoAnnonceur}*, I have a question regarding the promotion below: \n\n";
    }

    // Vérification de la longueur de la description
    if (advertisement.description.length >= 100) {
      text +=
          "<<${advertisement.description.substring(0, 100)}...>>\n\n*Depuis Dressur.*";
    } else {
      text += "<<${advertisement.description}>>\n\n*Depuis Dressur.*";
    }

    String encodedText = Uri.encodeComponent(text);

    String url =
        'https://wa.me/${advertisement.whatsappNumber}?text=$encodedText';

    final Uri _url = Uri.parse(url);
    if (!await launchUrl(_url, mode: LaunchMode.externalApplication)) {
      throw 'Could not launch $_url';
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: primaryColor,
        title: Text(
          (langUserPhone == "fr")
              ? 'Détails de la promotion'
              : 'Details of the promotion',
          style: GoogleFonts.poppins(
            color: Colors.white,
            fontWeight: FontWeight.w400,
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
          crossAxisAlignment: CrossAxisAlignment.stretch,
          children: [
            Image.network(
              advertisement.image,
            ),
            const SizedBox(height: 5),
            Container(
              margin: const EdgeInsets.only(
                  left: 10, top: 0, right: 10, bottom: 20),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.end,
                children: [
                  ElevatedButton(
                    style: ElevatedButton.styleFrom(
                      backgroundColor: primaryColor,
                    ),
                    onPressed: () {
                      openWhatsAppChat();
                    },
                    child: Text(
                      (langUserPhone == "fr")
                          ? "Contacter l'annonceur"
                          : "Contact the announcer",
                      style: GoogleFonts.poppins(
                        fontWeight: FontWeight.w400,
                        color: Colors.white,
                      ),
                    ),
                  ),
                  const SizedBox(height: 5),
                  Text(
                    advertisement.description,
                    style: GoogleFonts.poppins(
                      fontSize: 16,
                      fontWeight: FontWeight.w600,
                    ),
                  ),
                ],
              ),
            )
          ],
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
              const SizedBox(height: 10),
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
                    ? "Pour le moment, aucun des contacts correspondant à vos préférences pays n'a fait de boost. Vous pouvez faire un boost pour qu'ils puissent vous enregistrer."
                    : "For the moment, none of the contacts corresponding to your country preferences have been boosted. You can boost so they can check you in.",
                style: const TextStyle(
                  color: Colors.white,
                  fontSize: 17,
                ),
              ),
              const SizedBox(height: 10),
              Text(
                (langUserPhone == "fr")
                    ? "Lorsque vous faites un boost, vous avez accès à plusieurs contacts, dans le cas contraire, vous êtes limités aux utilisateurs qui ont fait un boost."
                    : "When you boost, you have access to several contacts, otherwise, you are limited to users who have boosted.",
                style: const TextStyle(
                  color: Colors.white,
                  fontSize: 17,
                ),
              ),
              const SizedBox(height: 10),
              Text(
                (langUserPhone == "fr")
                    ? "Partager votre code de parrainage pour avoir plus de filleuls et surtout, gagnez des points bonus et faites ainsi des boosts gratuitement et continuellement. Contactez-nous pour d'éventuelles questions, nous y répondrons avec plaisir."
                    : "Share your sponsorship code to have more referrals and above all, earn bonus points and thus boost for free and continuously. Contact us for any questions, we will be happy to answer them.",
                style: const TextStyle(
                  color: Colors.white,
                  fontSize: 17,
                ),
              ),
              const SizedBox(height: 10),
              Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  ElevatedButton(
                    style: ElevatedButton.styleFrom(
                      backgroundColor: Colors.orange,
                      shape: const StadiumBorder(),
                      padding: const EdgeInsets.symmetric(
                        vertical: 13,
                        horizontal: 40,
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
                      await Share.share(messageShare,
                          subject: 'Partager Dressur!');
                    },
                  ),
                  ElevatedButton(
                      style: ElevatedButton.styleFrom(
                        backgroundColor: Colors.white,
                        shape: const StadiumBorder(),
                        padding: const EdgeInsets.symmetric(
                          vertical: 13,
                          horizontal: 40,
                        ),
                      ),
                      child: Text(
                        (langUserPhone == "fr") ? "Faire un Boost" : "Boost",
                        style: GoogleFonts.poppins(
                          fontWeight: FontWeight.w600,
                          color: primaryColor,
                        ),
                      ),
                      onPressed: () {
                        Navigator.push(
                          context,
                          MaterialPageRoute(
                              builder: (context) => NewBoostContactPage()),
                        );
                      }),
                ],
              ),
            ],
          ),
        ),
      ],
    );
  }
}

class ConfNumeroWhatsapp extends StatefulWidget {
  ConfNumeroWhatsapp({Key? key}) : super(key: key);

  @override
  State<ConfNumeroWhatsapp> createState() => _ConfNumeroWhatsappState();
}

class _ConfNumeroWhatsappState extends State<ConfNumeroWhatsapp> {
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
                Color.fromARGB(255, 1, 156, 81),
                Color.fromARGB(255, 1, 156, 81),
                Colors.green,
              ],
            ),
          ),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(
                (langUserPhone == "fr")
                    ? "Confirmation du numéro WhatsApp"
                    : "WhatsApp Number Confirmation",
                style: TextStyle(
                  color: Colors.white,
                  fontSize: 25,
                  fontWeight: FontWeight.bold,
                ),
              ),
              const SizedBox(height: 10),
              Text(
                (langUserPhone == "fr")
                    ? "Assurez-vous de nous envoyer <<WhatsApp Confirmation>> avec le numéro WhatsApp utiliser pour créer votre compte Dressur."
                    : "Make sure to send us <<WhatsApp Confirmation>> with the WhatsApp number you use to create your Dressur account.",
                style: const TextStyle(
                  color: Colors.white,
                  fontSize: 17,
                ),
              ),
              const SizedBox(height: 10),
              Text(
                (langUserPhone == "fr")
                    ? "Cliquez juste sur Demander ci-dessous pour demander la confirmation de votre numéro WhatsApp."
                    : "Just click Request below to request confirmation of your WhatsApp number.",
                style: const TextStyle(
                  color: Colors.white,
                  fontSize: 17,
                ),
              ),
              const SizedBox(height: 10),
              Text(
                (langUserPhone == "fr")
                    ? "Les demandes sont traitées le plus tôt possible, ne vous inquiétez pas."
                    : "Requests are processed as soon as possible, don't worry.",
                style: const TextStyle(
                  color: Colors.white,
                  fontSize: 17,
                ),
              ),
              const SizedBox(height: 10),
              ElevatedButton(
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.white,
                    shape: const StadiumBorder(),
                    padding: const EdgeInsets.symmetric(
                      vertical: 13,
                      horizontal: 40,
                    ),
                  ),
                  child: Text(
                    (langUserPhone == "fr") ? "Demander" : "Ask",
                    style: GoogleFonts.poppins(
                      fontWeight: FontWeight.w600,
                      color: Color.fromARGB(255, 1, 156, 81),
                    ),
                  ),
                  onPressed: () async {
                    final Uri _url =
                        Uri.parse("$whatsappDSURL?text=WhatsApp Confirmation");
                    if (!await launchUrl(_url,
                        mode: LaunchMode.externalApplication)) {
                      throw 'Could not launch $_url';
                    }
                  }),
            ],
          ),
        ),
      ],
    );
  }
}
