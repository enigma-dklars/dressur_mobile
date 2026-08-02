// ignore_for_file: prefer_const_constructors, use_build_context_synchronously

import 'dart:async';
import 'dart:io';
import 'package:flutter/services.dart';
import 'dart:convert' as convert;
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:http/http.dart' as http;
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:flutter_contacts/flutter_contacts.dart';
import 'package:animated_bottom_navigation_bar/animated_bottom_navigation_bar.dart';
import 'package:dressur/2_promo/services.dart';
import 'package:dressur/3_actu/actu.dart';
import 'package:dressur/5_autre/autre.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/sql_helper.dart';
import 'package:dressur/components/noti_sys.dart';

class BottomBar extends StatefulWidget {
  const BottomBar({Key? key}) : super(key: key);

  @override
  State<BottomBar> createState() => _BottomBarState();
}

class _BottomBarState extends State<BottomBar> with WidgetsBindingObserver {
  // L'index 1 correspond à la page "Actu"
  int _selectedIndex = 1;
  int nombreNewContact = 0;
  bool _isInBackground = false;
  DateTime? _lastActualise;

  Timer? _timerNotif;
  Timer? _timerSync;

  final PageController _pageController = PageController(initialPage: 1);

  // --- Listes pour la barre de navigation ---
  // "ActuPage" est maintenant au centre de la liste des écrans
  final List<Widget> _screens = [
    BoostPage(),
    ActuPage(), // <--- PAGE "ACTU" INTÉGRÉE
    SettingPage(),
  ];

  // Icônes pour chaque onglet
  final List<IconData> _iconList = [
    FontAwesomeIcons.briefcase,
    FontAwesomeIcons.newspaper,
    FontAwesomeIcons.gear,
  ];

  // Labels pour chaque onglet
  List<String> get _labelList => [
    (langUserPhone == "fr") ? "Services" : "Services",
    (langUserPhone == "fr") ? "Actu" : "News",
    (langUserPhone == "fr") ? "Paramètres" : "Settings",
  ];

  @override
  void initState() {
    super.initState();
    saveContactDsIfNotExiste();
    WidgetsBinding.instance.addObserver(this);
    if (modeReconnaissanceContactArrierePlan == true) {
      synchroAvanceFunction();
      setState(() {
        modeReconnaissanceContactArrierePlan = false;
      });
    }

    // Exécute la fonction toutes les 6 heures
    _timerNotif = Timer.periodic(const Duration(hours: 6), (timer) {
      if (!_isInBackground) {
        showNotification(
            "Cc $name_complete ...",
            (langUserPhone == "fr")
                ? "Du nouveau sur votre compte Dressur."
                : "Something new on your Dressur account.");
      }
    });

    _timerSync = Timer.periodic(const Duration(hours: 6), (timer) {
      if (!_isInBackground) {
        saveContactDsIfNotExiste();
        actualise(false);
      }
    });
  }

  @override
  void dispose() {
    _timerNotif?.cancel();
    _timerSync?.cancel();
    _pageController.dispose();
    WidgetsBinding.instance.removeObserver(this);
    super.dispose();
  }

  @override
  void didChangeAppLifecycleState(AppLifecycleState state) {
    super.didChangeAppLifecycleState(state);
    if (state == AppLifecycleState.resumed) {
      _isInBackground = false;
      // showNotificationTimeOutAfter("Cc $name_complete ...", "Dressur est revenue au premier plan.", 300);
      final now = DateTime.now();
      if (_lastActualise == null ||
          now.difference(_lastActualise!) > const Duration(minutes: 5)) {
        _lastActualise = now;
        actualise(false);
        saveContactDsIfNotExiste();
      }
    } else if (state == AppLifecycleState.paused) {
      _isInBackground = true;
      // showNotificationTimeOutAfter("Cc $name_complete ...", "Dressur est passée à l'arrière-plan.", 300);
    }
  }

  void synchroAvanceFunction() async {
    await SQLHelper.viderLaBaseDeDonneeLocalTelUser();
    await Future.delayed(const Duration(seconds: 3), () {});
    List<Contact> contacts = await FlutterContacts.getContacts(
        withProperties: true, withAccounts: true);
    for (var contact in contacts) {
      for (var phone in contact.phones) {
        var numberTel = (phone.number).replaceAll(" ", "").replaceAll("-", "");
        if ((await SQLHelper.getOneNumsTelUser(numberTel)).isEmpty) {
          await insertNumTelUserIntoDataBase(numberTel);
        }
      }
    }
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

    try {
      var request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/getUserInfo'));
      request.fields.addAll({
        'uid': uidUser,
      });

      http.StreamedResponse response = await request.send();

      if (response.statusCode == 200) {
        var data1 = await response.stream.bytesToString();
        if (!mounted) return;
        var data = convert.jsonDecode(data1);
        if (data["error"] == false) {
          setState(() {
            initUserInformations(data['user']);
            lesPublicites = data['user']["lesPublicites"];
          });
        }
      }
      if (!mounted) return;
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
    } catch (_) {
      // Erreur réseau silencieuse — l'UI reste dans son état précédent
    }
  }

  @override
  Widget build(BuildContext context) {
    return PopScope(
      // Quitter l'application, centralisé ici pour les 3 onglets racine.
      // iOS : pas de dialog (interdit par Apple, le bouton Home suffit).
      // Android : confirmation unique sur l'onglet actif.
      canPop: false,
      onPopInvoked: (bool didPop) async {
        if (didPop) return;
        if (Platform.isIOS) return;
        await showDialog<void>(
          context: context,
          builder: (context) => AlertDialog(
            title: Text(
              (langUserPhone == "fr") ? 'Êtes-vous sûr ?' : 'Are you sure?',
            ),
            content: Text(
              (langUserPhone == "fr")
                  ? "Voulez-vous quitter l'application ?"
                  : "Do you want to quit the application?",
            ),
            actions: [
              TextButton(
                onPressed: () => Navigator.of(context).pop(),
                child: Text((langUserPhone == "fr") ? 'Non' : 'No'),
              ),
              TextButton(
                onPressed: () {
                  Navigator.of(context).pop();
                  SystemNavigator.pop();
                },
                child: Text((langUserPhone == "fr") ? 'Oui' : 'Yes'),
              ),
            ],
          ),
        );
      },
      child: Scaffold(
        // Le corps utilise un PageView pour permettre le swipe
        body: PageView(
          controller: _pageController,
          physics: BouncingScrollPhysics(),
          onPageChanged: (index) {
            setState(() => _selectedIndex = index);
          },
          children: _screens,
        ),
        // La barre de navigation n'a plus de bouton flottant ni d'encoche
        // Alternative 1: Style "Indicateur Flottant"
        bottomNavigationBar: AnimatedBottomNavigationBar.builder(
          itemCount: _iconList.length,
          tabBuilder: (int index, bool isActive) {
            final color = isActive ? primaryColor : Colors.grey[500];

            return Column(
              mainAxisSize: MainAxisSize.min,
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                FaIcon(
                  _iconList[index],
                  size: isActive ? 22 : 18,
                  color: color,
                ),
                SizedBox(height: 4),
                Text(
                  _labelList[index],
                  style: GoogleFonts.poppins(
                    fontSize: 10,
                    fontWeight: isActive ? FontWeight.w600 : FontWeight.w400,
                    color: color,
                  ),
                ),
              ],
            );
          },
          activeIndex: _selectedIndex,
          gapLocation: GapLocation.none,
          notchSmoothness: NotchSmoothness.softEdge,
          backgroundColor: Theme.of(context).brightness == Brightness.dark
              ? Color(0xFF1C1C1E)
              : Colors.white,
          onTap: (index) {
            setState(() => _selectedIndex = index);
            _pageController.animateToPage(
              index,
              duration: Duration(milliseconds: 300),
              curve: Curves.easeInOut,
            );
          },
        ),
      ),
    );
  }
}
