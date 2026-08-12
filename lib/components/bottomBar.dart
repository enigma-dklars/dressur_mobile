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
import 'package:permission_handler/permission_handler.dart';
import 'package:animated_bottom_navigation_bar/animated_bottom_navigation_bar.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:dressur/6_login_register/connexion.dart';
import 'package:dressur/2_promo/services.dart';
import 'package:dressur/3_actu/actu.dart';
import 'package:dressur/5_autre/autre.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/contacts_pending_interrupt.dart';
import 'package:dressur/components/permission_manager.dart';
import 'package:dressur/components/sql_helper.dart';
import 'package:dressur/components/noti_sys.dart';

class _AccountBlockedPage extends StatelessWidget {
  const _AccountBlockedPage();

  @override
  Widget build(BuildContext context) {
    final isFrench = langUserPhone == "fr";
    return Scaffold(
      backgroundColor: primaryColor,
      body: SafeArea(
        child: Center(
          child: Padding(
            padding: const EdgeInsets.all(24),
            child: Column(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                const Icon(
                  Icons.block_outlined,
                  color: Colors.white,
                  size: 72,
                ),
                const SizedBox(height: 24),
                Text(
                  isFrench ? 'Compte bloqué' : 'Account blocked',
                  textAlign: TextAlign.center,
                  style: GoogleFonts.poppins(
                    color: Colors.white,
                    fontSize: 26,
                    fontWeight: FontWeight.bold,
                  ),
                ),
                const SizedBox(height: 16),
                Text(
                  isFrench
                      ? 'Votre compte est actuellement bloqué. Contactez l’assistance pour obtenir de l’aide.'
                      : 'Your account is currently blocked. Contact support for help.',
                  textAlign: TextAlign.center,
                  style: GoogleFonts.poppins(
                    color: Colors.white70,
                    fontSize: 15,
                    height: 1.5,
                  ),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}

class BottomBar extends StatefulWidget {
  const BottomBar({Key? key}) : super(key: key);

  @override
  State<BottomBar> createState() => _BottomBarState();
}

class _BottomBarState extends State<BottomBar> with WidgetsBindingObserver {
  static const _refreshTimeout = Duration(seconds: 12);

  // L'index 1 correspond à la page "Actu"
  int _selectedIndex = 1;
  int nombreNewContact = 0;
  bool _isInBackground = false;
  DateTime? _lastActualise;

  Timer? _timerNotif;
  Timer? _timerSync;

  /// Verrou pour éviter la race condition : deux appels concurrents à
  /// _maybeShowContactsInterrupt() (postFrameCallback + refresh data)
  /// pourraient tous deux passer le test du throttle et empiler deux modals.
  bool _interruptLock = false;
  bool _actualiseInProgress = false;
  bool _sessionRedirectStarted = false;

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

  // ── Enregistrement des contacts (miroir de actu.dart) ─────────────────────
  Future<void> _addTousLesContacts() async {
    await PermissionManager.instance.runWithPermissionRecovery(
      context,
      actionKey: 'bottom_bar:add_all_contacts',
      permission: Permission.contacts,
      isFrench: langUserPhone == "fr",
      action: () async {
        if (!mounted) return;
        try {
          var request = http.MultipartRequest(
              'POST',
              Uri.parse(
                  '$generalRouteForApi/addTousUserContact/$uidUser/${langUserPhone.toString()}'));
          request.fields.addAll({'uid': uidUser});
          http.StreamedResponse response = await request.send();
          if (response.statusCode == 200) {
            var data1 = await response.stream.bytesToString();
            var data = convert.jsonDecode(data1);
            if (data['error'] == false &&
                (data['contactsAdd'] as List).isNotEmpty) {
              for (var contactAdd in data['contactsAdd']) {
                if ((await SQLHelper.getOneNumsTelUser(contactAdd['tel']))
                    .isEmpty) {
                  final String tel = (contactAdd['tel'] as String);
                  final String telSansPlus = tel.replaceAll('+', '');
                  final List<Phone> phonesList = [Phone(tel)];
                  if (tel.startsWith('+229') &&
                      !tel.startsWith('+22901')) {
                    final String afterCode = tel.substring(4);
                    phonesList.add(Phone('+22901$afterCode'));
                  }
                  final String nom =
                      (contactAdd['nom'] ?? '').toString().trim();
                  final String pseudo = contactAdd['pseudo'] as String;
                  final List<String> nameParts = [
                    nom,
                    pseudo,
                    telSansPlus
                  ].where((s) => s.isNotEmpty).toList();
                  final newContact = Contact()
                    ..name.first = '${nameParts.join(' - ')} #DS'
                    ..phones = phonesList;
                  await newContact.insert();
                  await insertNumTelUserIntoDataBase(contactAdd['tel']);
                }
              }
              if (mounted) {
                setState(() {
                  nombreContactDispo =
                      (nombreContactDispo -
                              (data['contactsAdd'] as List).length)
                          .clamp(0, 9999);
                });
              }
            }
          }
        } catch (_) {}
      },
    );
  }

  // ── Interrupt au démarrage si contacts disponibles ────────────────────────
  Future<void> _maybeShowContactsInterrupt() async {
    // Verrou : si un appel concurrent est déjà en cours, on abandonne immédiatement
    // pour éviter d'empiler deux pages d'interrupt dans le navigator.
    if (_interruptLock) return;
    _interruptLock = true;

    try {
      // Respecter la préférence utilisateur : si addPageActu est false,
      // l'utilisateur ne veut pas de suggestions liées aux contacts disponibles.
      // Cette vérification doit se faire après initUserInformations().
      if (!addPageActu) return;
      if (nombreContactDispo <= 0) return;
      if (!mounted) return;

      final prefs = await SharedPreferences.getInstance();
      final lastShown = prefs.getInt('last_contacts_interrupt') ?? 0;
      final now = DateTime.now().millisecondsSinceEpoch;
      final elapsed = now - lastShown;

      // N'afficher que si > 4 heures depuis le dernier affichage
      if (elapsed < const Duration(hours: 4).inMilliseconds) return;

      await prefs.setInt('last_contacts_interrupt', now);

      if (!mounted) return;
      await Navigator.of(context).push(
        MaterialPageRoute(
          builder: (_) => ContactsPendingInterruptPage(
            nombreContacts: nombreContactDispo,
            onSaveNow: () => _addTousLesContacts(),
            onLater: () {
              // Navigue vers l'onglet Actu (index 1)
              _pageController.animateToPage(
                1,
                duration: const Duration(milliseconds: 300),
                curve: Curves.easeInOut,
              );
              setState(() => _selectedIndex = 1);
            },
          ),
        ),
      );
    } finally {
      // Libérer le verrou dans tous les cas (return anticipé ou push terminé)
      _interruptLock = false;
    }
  }

  /// Les traitements de contacts sont optionnels au démarrage.
  ///
  /// Une permission refusée ne doit ni interrompre la restauration de session
  /// ni produire une Future non gérée depuis initState ou le lifecycle.
  Future<void> _runOptionalContactStartupTask(
    Future<void> Function() task,
  ) async {
    try {
      final permission = await PermissionManager.instance
          .check(Permission.contacts)
          .timeout(const Duration(seconds: 3));
      if (!permission.canProceed) return;

      await task().timeout(_refreshTimeout);
    } catch (_) {
      // Les contacts ne doivent jamais empêcher l'utilisateur d'entrer dans
      // l'application. Les fonctionnalités concernées pourront réessayer
      // depuis leur écran dédié.
    }
  }

  @override
  void initState() {
    super.initState();
    unawaited(_runOptionalContactStartupTask(saveContactDsIfNotExiste));
    WidgetsBinding.instance.addObserver(this);

    // Charger les infos utilisateur depuis l'API au démarrage, puis vérifier
    // si des contacts sont disponibles. On passe par actualise() pour garantir
    // que initUserInformations() (et donc addPageActu) soit chargé AVANT
    // que _maybeShowContactsInterrupt() soit appelé.
    WidgetsBinding.instance.addPostFrameCallback((_) {
      actualise(false);
    });
    if (modeReconnaissanceContactArrierePlan == true) {
      unawaited(_runOptionalContactStartupTask(synchroAvanceFunction));
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
                : "Something new on your Dressur account.",
            context: context);
      }
    });

    _timerSync = Timer.periodic(const Duration(hours: 6), (timer) {
      if (!_isInBackground) {
        unawaited(_runOptionalContactStartupTask(saveContactDsIfNotExiste));
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
        unawaited(_runOptionalContactStartupTask(saveContactDsIfNotExiste));
      }
    } else if (state == AppLifecycleState.paused) {
      _isInBackground = true;
      // showNotificationTimeOutAfter("Cc $name_complete ...", "Dressur est passée à l'arrière-plan.", 300);
    }
  }

  Future<void> synchroAvanceFunction() async {
    final permission =
        await PermissionManager.instance.ensure(Permission.contacts);
    if (!permission.canProceed) return;

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

  Future<void> actualise(bool affMessage) async {
    if (_sessionRedirectStarted || _actualiseInProgress) return;
    _actualiseInProgress = true;

    if (affMessage && mounted) {
      _showRefreshMessage(
        (langUserPhone == "fr")
            ? 'Actualisation en cours…'
            : 'Update in progress…',
        Colors.red,
      );
    }

    try {
      final request = http.MultipartRequest(
        'POST',
        Uri.parse('$generalRouteForApi/getUserInfo'),
      )..fields.addAll({
          'uid': uidUser,
        });

      final response = await request.send().timeout(_refreshTimeout);
      final body = await response.stream
          .bytesToString()
          .timeout(_refreshTimeout);
      final data = _decodeRefreshResponse(body, response.statusCode);

      if (_isBlockedResponse(data)) {
        await _handleBlockedSession();
        return;
      }
      if (_isInvalidSessionResponse(data)) {
        await _handleInvalidSession();
        return;
      }

      if (data['error'] == false && data['user'] is Map<String, dynamic>) {
        await initUserInformations(data['user']);
        if (!mounted || _sessionRedirectStarted) return;
        setState(() {
          lesPublicites = data['user']["lesPublicites"];
        });
        await _maybeShowContactsInterrupt();
        if (affMessage && mounted) {
          _showRefreshMessage(
            (langUserPhone == "fr")
                ? 'Actualisation terminée.'
                : 'Refresh complete.',
            Colors.green,
          );
        }
        return;
      }

      if (affMessage && mounted) {
        _showRefreshMessage(
          (langUserPhone == "fr")
              ? 'Actualisation impossible pour le moment.'
              : 'Refresh is unavailable right now.',
          Colors.red,
        );
      }
    } on TimeoutException {
      _showRefreshErrorIfRequested(affMessage);
    } on SocketException {
      _showRefreshErrorIfRequested(affMessage);
    } on FormatException {
      _showRefreshErrorIfRequested(affMessage);
    } catch (_) {
      _showRefreshErrorIfRequested(affMessage);
    } finally {
      _actualiseInProgress = false;
    }
  }

  Map<String, dynamic> _decodeRefreshResponse(String body, int statusCode) {
    dynamic decoded;
    try {
      decoded = convert.jsonDecode(body);
    } catch (_) {
      return <String, dynamic>{'_statusCode': statusCode};
    }

    if (decoded is Map<String, dynamic>) {
      return <String, dynamic>{
        ...decoded,
        '_statusCode': statusCode,
      };
    }
    return <String, dynamic>{'_statusCode': statusCode};
  }

  bool _isBlockedResponse(Map<String, dynamic> data) {
    return data['blocked'] == true || data['code'] == 'account_blocked';
  }

  bool _isInvalidSessionResponse(Map<String, dynamic> data) {
    final statusCode = data['_statusCode'];
    if (statusCode == 401 || statusCode == 404) return true;
    if (data['deleted'] == true) return true;

    final code = data['code']?.toString().toLowerCase();
    const invalidSessionCodes = <String>{
      'session_missing',
      'session_invalid',
      'user_missing',
      'user_not_found',
      'account_not_found',
    };
    if (code != null && invalidSessionCodes.contains(code)) return true;

    if (data['user'] != null) return false;
    final responseText = _normalizeResponseText(
      '${data['titre'] ?? ''} ${data['message'] ?? ''}',
    );
    return responseText.contains('user not found') ||
        responseText.contains('utilisateur introuvable') ||
        responseText.contains('utilisateur non trouve') ||
        responseText.contains('account not found') ||
        responseText.contains('compte introuvable') ||
        responseText.contains('compte non trouve');
  }

  String _normalizeResponseText(String value) {
    return value
        .toLowerCase()
        .replaceAll('é', 'e')
        .replaceAll('è', 'e')
        .replaceAll('ê', 'e')
        .replaceAll('ë', 'e')
        .replaceAll('à', 'a')
        .replaceAll('â', 'a')
        .replaceAll('î', 'i')
        .replaceAll('ï', 'i')
        .replaceAll('ô', 'o')
        .replaceAll('ù', 'u')
        .replaceAll('û', 'u');
  }

  Future<void> _handleInvalidSession() async {
    if (_sessionRedirectStarted) return;
    _sessionRedirectStarted = true;
    _timerNotif?.cancel();
    _timerSync?.cancel();
    uidUser = null;
    try {
      await SQLHelper.clearCachedSession().timeout(const Duration(seconds: 3));
    } catch (_) {
      // Continue to the login page even if local cleanup fails.
    }
    if (!mounted) return;
    Navigator.of(context).pushAndRemoveUntil(
      MaterialPageRoute(builder: (_) => LoginPage()),
      (_) => false,
    );
  }

  Future<void> _handleBlockedSession() async {
    if (_sessionRedirectStarted) return;
    _sessionRedirectStarted = true;
    _timerNotif?.cancel();
    _timerSync?.cancel();
    uidUser = null;
    try {
      await SQLHelper.clearCachedSession().timeout(const Duration(seconds: 3));
    } catch (_) {
      // Continue to the blocked-account screen even if local cleanup fails.
    }
    if (!mounted) return;
    Navigator.of(context).pushAndRemoveUntil(
      MaterialPageRoute(builder: (_) => const _AccountBlockedPage()),
      (_) => false,
    );
  }

  void _showRefreshErrorIfRequested(bool affMessage) {
    if (!affMessage || !mounted || _sessionRedirectStarted) return;
    _showRefreshMessage(
      (langUserPhone == "fr")
          ? 'Impossible de joindre Dressur. Réessayez.'
          : 'Dressur could not be reached. Try again.',
      Colors.red,
    );
  }

  void _showRefreshMessage(String message, Color backgroundColor) {
    if (!mounted || _sessionRedirectStarted) return;
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(
        backgroundColor: backgroundColor,
        behavior: SnackBarBehavior.floating,
        content: Text(
          message,
          style: GoogleFonts.poppins(color: Colors.white),
        ),
      ),
    );
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
