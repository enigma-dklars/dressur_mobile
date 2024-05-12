import 'dart:async';
import 'dart:convert';
import 'package:dressur/1_reception/reception.dart';
import 'package:dressur/components/noti_sys.dart';
import 'package:http/http.dart' as http;
import 'package:flutter/material.dart';
import 'package:flutter_contacts/flutter_contacts.dart';
import 'package:dressur/2_promo/promo.dart';
import 'package:dressur/3_actu/actu.dart';
import 'package:dressur/4_preference/preference.dart';
import 'package:dressur/5_autre/menu_autre_page.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/sql_helper.dart';
import 'dart:convert' as convert;

class BottomBar extends StatefulWidget {
  const BottomBar({Key? key}) : super(key: key);

  @override
  State<BottomBar> createState() => _BottomBarState();
}

class _BottomBarState extends State<BottomBar> {
  int _selectedIndex = 2;
  dynamic screens = [];
  bool _swipeInProgress = false;
  final Duration _swipeCooldown = const Duration(milliseconds: 300);

  @override
  void initState() {
    super.initState();
    initNavigationTitle();
    fetchContactDSs();
    if (modeReconnaissanceContactArrierePlan == true) {
      synchroAvanceFunction();
      setState(() {
        modeReconnaissanceContactArrierePlan = false;
      });
    }

    // Exécute la fonction toutes les 5 heures
    Timer.periodic(const Duration(hours: 5), (timer) {
      showNotification("Cc $pseudo du nouveau ?",
          "Consultez votre compte dès maintenant pour découvrir les dernières promotions, actualités et préférences disponibles sur Dressur.");
    });

// Exécute la fonction toutes les 1 heures
    Timer.periodic(const Duration(hours: 1), (timer) {
      actualise();
    });
  }

  void actualise() async {
    setState(() {
      // _loading = true;
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
          // _loading = false;
        });
      } else {
        setState(() {
          // _loading = false;
        });
      }
    } else {
      setState(() {
        // _loading = false;
      });
    }
  }

  void synchroAvanceFunction() async {
    setState(() {
      contactsUserBeforeDS = [];
      if (langUserPhone != "fr") {
        textChargementEvolution = "Recognition of existing contacts ...";
      } else {
        textChargementEvolution = "Reconnaissance des contacts existants ...";
      }
    });
    await SQLHelper.viderLaBaseDeDonneeLocalTelUser();

    await Future.delayed(const Duration(seconds: 3), () {});

    List<Contact> contacts =
        await FlutterContacts.getContacts(withProperties: true);

    int countContacts = 0;
    setState(() {
      if (langUserPhone != "fr") {
        textChargementEvolution =
            "Recognition of existing contacts ...\n0 / ${contacts.length}";
      } else {
        textChargementEvolution =
            "Reconnaissance des contacts existants ...\n0 / ${contacts.length}";
      }
    });

    for (var contact in contacts) {
      for (var phone in contact.phones) {
        var nameTel = "${contact.name.first} ${contact.name.last}";
        var displayNameTel = contact.displayName;
        var numberTel = (phone.number).replaceAll(" ", "").replaceAll("-", "");
        if (!contactsUserBeforeDS.contains(numberTel)) {
          contactsUserBeforeDS.add({
            "nameTel": nameTel,
            "displayNameTel": displayNameTel,
            "numberTel": numberTel,
          });
        }

        if ((await SQLHelper.getOneNumsTelUser(numberTel)).isEmpty) {
          await insertNumTelUserIntoDataBase(numberTel);
        }
      }
      setState(() {
        countContacts++;
        if (langUserPhone != "fr") {
          textChargementEvolution =
              "Recognition of existing contacts ...\n$countContacts / ${contacts.length}";
        } else {
          textChargementEvolution =
              "Reconnaissance des contacts existants ...\n$countContacts / ${contacts.length}";
        }
      });
    }
    // envoyer les contacts pour stockage
    var request = http.MultipartRequest(
        'POST', Uri.parse('$generalRouteForApi/stockerUserContacts'));
    request.fields
        .addAll({'contactsUserBeforeDS': jsonEncode(contactsUserBeforeDS)});
    // http.StreamedResponse response = await request.send();
    await request.send();

    // envoyez les contacts a la route
    setState(() {
      if (langUserPhone != "fr") {
        textChargementEvolution = "Ended .";
      } else {
        textChargementEvolution = "Terminé .";
      }
    });
  }

  Future<void> fetchContactDSs() async {
    setState(() {
      contactsEnregistrer = [];
    });
    final url =
        Uri.parse('$generalRouteForApi/listContactDS/$uidUser/$langUserPhone');
    final response = await http.get(url);
    if (response.statusCode == 200) {
      final jsonData = jsonDecode(response.body) as List<dynamic>;
      if (jsonData.isNotEmpty) {
        for (var contact in jsonData) {
          if (contact['tel'] != "+22964044294" &&
              contact['tel'] != "22964044294" &&
              contact['tel'] != "64044294" &&
              !contactsEnregistrer.contains(contact['tel'])) {
            contactsEnregistrer.add(contact['tel']);
          }
          if ((await SQLHelper.getOneNumsTelUser(contact['tel'])).isEmpty) {
            final newContact = Contact()
              ..name.first = contact["pseudo"] + " #DS"
              ..phones = [Phone(contact["tel"])];
            await newContact.insert();
            await insertNumTelUserIntoDataBase(contact["tel"]);
          }
        }
      }
    }
  }

  void initNavigationTitle() {
    screens = [
      ReceptionPage(),
      BoostPage(),
      ActuPage(),
      PreferencePage(),
      SettingPage(),
    ];
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        bottomNavigationBar: buildBottomNavigationBar(),
        body: GestureDetector(
          onHorizontalDragUpdate: (details) {
            if (!_swipeInProgress) {
              // Si le swipe n'est pas en cours, permettre la détection
              _swipeInProgress = true;

              // Si le geste de balayage est vers la droite
              if (details.delta.dx > 0) {
                // Si l'indice est supérieur à 0, cela signifie qu'il y a un écran précédent
                if (_selectedIndex > 0) {
                  setState(() {
                    _selectedIndex--;
                  });
                }
              }
              // Si le geste de balayage est vers la gauche
              else if (details.delta.dx < 0) {
                // Si l'indice est inférieur au nombre total d'écrans moins un, cela signifie qu'il y a un écran suivant
                if (_selectedIndex < screens.length - 1) {
                  setState(() {
                    _selectedIndex++;
                  });
                }
              }

              // Attendre la durée de pause avant de réactiver la détection de swipe
              Future.delayed(_swipeCooldown, () {
                setState(() {
                  _swipeInProgress = false;
                });
              });
            }
          },
          child: screens[_selectedIndex],
        ));
  }

  buildBottomNavigationBar() {
    return (langUserPhone != "fr")
        ? ClipRRect(
            borderRadius: const BorderRadius.only(
              topLeft: Radius.circular(10),
              topRight: Radius.circular(10),
            ),
            child: BottomNavigationBar(
              type: BottomNavigationBarType.fixed,
              backgroundColor: primaryColor,
              unselectedItemColor: Colors.white70,
              selectedItemColor: Colors.white,
              selectedFontSize: 16,
              currentIndex: _selectedIndex,
              onTap: (value) {
                setState(() {
                  _selectedIndex = value;
                });
              },
              items: const [
                BottomNavigationBarItem(
                  icon: Icon(Icons.indeterminate_check_box),
                  label: "Reception",
                  backgroundColor: Colors.brown,
                ),
                BottomNavigationBarItem(
                  icon: Icon(Icons.query_stats),
                  label: "Promo",
                  backgroundColor: primaryColor,
                ),
                BottomNavigationBarItem(
                  icon: Icon(Icons.add_box),
                  label: "News",
                  backgroundColor: Colors.blue,
                ),
                BottomNavigationBarItem(
                  icon: Icon(Icons.favorite),
                  label: "Preferences",
                  backgroundColor: Colors.teal,
                ),
                BottomNavigationBarItem(
                  icon: Icon(Icons.settings_applications),
                  label: "Other...",
                  backgroundColor: Colors.grey,
                ),
              ],
            ),
          )
        : ClipRRect(
            borderRadius: const BorderRadius.only(
              topLeft: Radius.circular(10),
              topRight: Radius.circular(10),
            ),
            child: BottomNavigationBar(
              type: BottomNavigationBarType.fixed,
              backgroundColor: primaryColor,
              unselectedItemColor: Colors.white70,
              selectedItemColor: Colors.white,
              selectedFontSize: 16,
              currentIndex: _selectedIndex,
              onTap: (value) {
                setState(() {
                  _selectedIndex = value;
                });
              },
              items: const [
                BottomNavigationBarItem(
                  icon: Icon(Icons.indeterminate_check_box),
                  label: "Réception",
                  backgroundColor: Colors.brown,
                ),
                BottomNavigationBarItem(
                  icon: Icon(Icons.query_stats),
                  label: "Promo",
                  backgroundColor: primaryColor,
                ),
                BottomNavigationBarItem(
                  icon: Icon(Icons.add_box),
                  label: "Actu",
                  backgroundColor: Colors.blue,
                ),
                BottomNavigationBarItem(
                  icon: Icon(Icons.favorite),
                  label: "Préférences",
                  backgroundColor: Colors.teal,
                ),
                BottomNavigationBarItem(
                  icon: Icon(Icons.settings_applications),
                  label: "Autre...",
                  backgroundColor: Colors.grey,
                ),
              ],
            ),
          );
  }
}
