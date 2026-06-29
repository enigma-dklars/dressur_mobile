// ignore_for_file: prefer_const_constructors, use_build_context_synchronously

import 'dart:async';
import 'dart:io';
import 'package:flutter/services.dart';
import 'dart:convert';
import 'dart:convert' as convert;
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:http/http.dart' as http;
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:flutter_contacts/flutter_contacts.dart';
import 'package:animated_bottom_navigation_bar/animated_bottom_navigation_bar.dart';
import 'package:dressur/1_reception/reception.dart';
import 'package:dressur/2_promo/services.dart';
import 'package:dressur/3_actu/actu.dart';
import 'package:dressur/4_preference/preference.dart';
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
  // L'index 2 correspond maintenant à la page "Actu"
  int _selectedIndex = 2;
  int nombreNewContact = 0;
  dynamic screens = [];
  bool _swipeInProgress = false;
  final Duration _swipeCooldown = const Duration(milliseconds: 300);

  final PageController _pageController = PageController(initialPage: 2);

  // --- Listes pour la barre de navigation ---
  // "ActuPage" est maintenant au centre de la liste des écrans
  final List<Widget> _screens = [
    ReceptionPage(),
    BoostPage(),
    ActuPage(), // <--- PAGE "ACTU" INTÉGRÉE
    PreferencePage(),
    SettingPage(),
  ];

  // Icônes pour chaque onglet, y compris "Actu"
  final List<IconData> _iconList = [
    FontAwesomeIcons.inbox,
    FontAwesomeIcons.briefcase,
    FontAwesomeIcons.newspaper,
    FontAwesomeIcons.heart,
    FontAwesomeIcons.gear,
  ];

  final List<IconData> _iconListSelected = [
    FontAwesomeIcons.inbox,
    FontAwesomeIcons.briefcase,
    FontAwesomeIcons.newspaper,
    FontAwesomeIcons.solidHeart,
    FontAwesomeIcons.gear,
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

    // Exécute la fonction toutes les 5 heures
    Timer.periodic(const Duration(hours: 6), (timer) {
      showNotification(
          "Cc $name_complete ...", "Du nouveau sur votre compte Dressur.");
    });

    Timer.periodic(const Duration(hours: 6), (timer) {
      saveContactDsIfNotExiste();
      actualise(false);
    });
  }

  @override
  void dispose() {
    _pageController.dispose();
    WidgetsBinding.instance.removeObserver(this);
    super.dispose();
  }

  @override
  void didChangeAppLifecycleState(AppLifecycleState state) {
    super.didChangeAppLifecycleState(state);
    if (state == AppLifecycleState.resumed) {
      // showNotificationTimeOutAfter("Cc $name_complete ...", "Dressur est revenue au premier plan.", 300);
      actualise(false);
      saveContactDsIfNotExiste();
    } else if (state == AppLifecycleState.paused) {
      // showNotificationTimeOutAfter("Cc $name_complete ...", "Dressur est passée à l'arrière-plan.", 300);
    }
  }

  void synchroAvanceFunction() async {
    setState(() {
      contactsUserBeforeDS = [];
    });
    await SQLHelper.viderLaBaseDeDonneeLocalTelUser();
    await Future.delayed(const Duration(seconds: 3), () {});
    List<Contact> contacts =
        await FlutterContacts.getContacts(withProperties: true, withAccounts: true);
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
    try {
      var request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/stockerUserContacts'));
      request.fields
          .addAll({'contactsUserBeforeDS': jsonEncode(contactsUserBeforeDS)});
      await request.send();
    } catch (_) {}
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
          // Pour cette version, nous utilisons toujours les icônes "outlined"
          // pour un look plus épuré.
          final color = isActive ? primaryColor : Colors.grey[500];

          return Column(
            mainAxisSize: MainAxisSize.min,
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              // L'icône
              FaIcon(
                _iconList[index],
                size: isActive ? 24 : 18, // L'icône active est plus grande
                color: color,
              ),
              SizedBox(height: 4),
              // L'indicateur animé
              AnimatedContainer(
                duration: Duration(milliseconds: 200),
                height: 4,
                width: isActive ? 12 : 0, // L'indicateur apparaît si actif
                decoration: BoxDecoration(
                  color: primaryColor,
                  borderRadius: BorderRadius.circular(2),
                ),
              )
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

// --- WIDGETS HELPERS POUR LA BARRE DE NAVIGATION ---

  // Bouton normal pour les onglets standards
  Widget _buildNormalButton(int index, bool isActive) {
    return Column(
      mainAxisSize: MainAxisSize.min,
      mainAxisAlignment: MainAxisAlignment.center,
      children: [
        FaIcon(
          isActive ? _iconListSelected[index] : _iconList[index],
          size: 24,
          color: isActive ? primaryColor : Colors.grey[600],
        ),
        SizedBox(height: 4),
        Text(
          _getLabel(index),
          maxLines: 1,
          style: GoogleFonts.poppins(
            fontSize: 11,
            fontWeight: isActive ? FontWeight.bold : FontWeight.normal,
            color: isActive ? primaryColor : Colors.grey[600],
          ),
        )
      ],
    );
  }

  // Bouton spécial pour l'onglet central "Actu"
  Widget _buildCenterButton(bool isActive) {
    return Container(
        width: 60,
        height: 60,
        margin: EdgeInsets.only(bottom: 15), // Remonte le bouton
        decoration: BoxDecoration(
          shape: BoxShape.circle,
          color: primaryColor,
          boxShadow: [
            BoxShadow(
              color: primaryColor.withOpacity(0.4),
              blurRadius: 8,
              offset: Offset(0, 4),
            ),
          ],
        ),
        child: FaIcon(
          FontAwesomeIcons.rss,
          color: isActive ? Colors.white : Colors.white.withOpacity(0.5),
          size: 30,
        ));
  }

  // Helper pour obtenir le label en fonction de la langue
  String _getLabel(int index) {
    final bool isFrench = langUserPhone == "fr";
    switch (index) {
      case 0:
        return isFrench ? "Réception" : "Home";
      case 1:
        return isFrench ? "Services" : "Services";
      case 2:
        return isFrench ? "Actu" : "News"; // Label pour l'onglet central
      case 3:
        return isFrench ? "Préférences" : "Preferences";
      case 4:
        return isFrench ? "Autre" : "Other";
      default:
        return "";
    }
  }
}
