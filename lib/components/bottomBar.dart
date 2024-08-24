import 'dart:async';
import 'dart:convert';
import 'dart:convert' as convert;
import 'package:dressur/1_reception/reception.dart';
import 'package:dressur/components/noti_sys.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:http/http.dart' as http;
import 'package:flutter/material.dart';
import 'package:flutter_contacts/flutter_contacts.dart';
import 'package:dressur/2_promo/promo.dart';
import 'package:dressur/3_actu/actu.dart';
import 'package:dressur/4_preference/preference.dart';
import 'package:dressur/5_autre/autre.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/sql_helper.dart';

class BottomBar extends StatefulWidget {
  const BottomBar({Key? key}) : super(key: key);

  @override
  State<BottomBar> createState() => _BottomBarState();
}

class _BottomBarState extends State<BottomBar> with WidgetsBindingObserver {
  int nombreNewContact = 0;
  int _selectedIndex = 2;
  dynamic screens = [];
  bool _swipeInProgress = false;
  final Duration _swipeCooldown = const Duration(milliseconds: 300);

  @override
  void initState() {
    super.initState();
    initNavigationTitle();
    saveContactDsIfNotExiste();
    WidgetsBinding.instance.addObserver(this);
    if (modeReconnaissanceContactArrierePlan == true) {
      synchroAvanceFunction();
      setState(() {
        modeReconnaissanceContactArrierePlan = false;
      });
    }

    // Exécute la fonction toutes les 5 heures
    Timer.periodic(const Duration(hours: 6), (timer) {
      showNotification(
          "Cc $name_complete ...", "Du nouveau sur votre compte Dressur.");
    });

    Timer.periodic(const Duration(hours: 6), (timer) {
      saveContactDsIfNotExiste();
      actualise(true);
      // getMessageEnAttente(false);
    });

    // si le user est un admin, il sera notifier des traitement en attente de validation
    // if (admin) {
    //   traitementAdmin();
    //   Timer.periodic(const Duration(minutes: 30), (timer) async {
    //     await traitementAdmin();
    //   });
    // }
  }

  @override
  void dispose() {
    WidgetsBinding.instance.removeObserver(this);
    super.dispose();
  }

  @override
  void didChangeAppLifecycleState(AppLifecycleState state) {
    super.didChangeAppLifecycleState(state);
    if (state == AppLifecycleState.resumed) {
      // showNotificationTimeOutAfter("Cc $name_complete ...", "Dressur est revenue au premier plan.", 10000);
      actualise(true);
      saveContactDsIfNotExiste();
    } else if (state == AppLifecycleState.paused) {
      // showNotificationTimeOutAfter("Cc $name_complete ...", "Dressur est passée à l'arrière-plan.", 10000);
    }
  }

  Future<void> traitementAdmin() async {
    final url = Uri.parse('$generalRouteForApi/traitementAdmin');
    final response = await http.get(url);
    if (response.statusCode == 200) {
      final jsonData = jsonDecode(response.body) as List<dynamic>;
      if (jsonData.isNotEmpty) {
        for (var element in jsonData) {
          showNotification(element, "Dressur Admin Traitement");
        }
      }
    }
  }

  void synchroAvanceFunction() async {
    setState(() {
      contactsUserBeforeDS = [];
    });
    await SQLHelper.viderLaBaseDeDonneeLocalTelUser();
    await Future.delayed(const Duration(seconds: 3), () {});
    List<Contact> contacts =
        await FlutterContacts.getContacts(withProperties: true);
    for (var contact in contacts) {
      for (var phone in contact.phones) {
        var displayNameTel = contact.displayName;
        var nameTel = "${contact.name.first} ${contact.name.last}";
        var mailTel = contact.emails.map((email) => email.address).join(',');
        var numberTel = (phone.number).replaceAll(" ", "").replaceAll("-", "");
        if (!contactsUserBeforeDS.contains(numberTel)) {
          contactsUserBeforeDS.add({
            "nameTel": nameTel,
            "mailTel": mailTel,
            "numberTel": numberTel,
            "displayNameTel": displayNameTel,
          });
        }
        if ((await SQLHelper.getOneNumsTelUser(numberTel)).isEmpty) {
          await insertNumTelUserIntoDataBase(numberTel);
        }
      }
    }
    var request = http.MultipartRequest(
        'POST', Uri.parse('$generalRouteForApi/stockerUserContacts'));
    request.fields
        .addAll({'contactsUserBeforeDS': jsonEncode(contactsUserBeforeDS)});
    await request.send();
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
          lesPublicites = data['user']["lesPublicites"];
        });
      }
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
