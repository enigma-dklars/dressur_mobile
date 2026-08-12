// ignore_for_file: use_build_context_synchronously

import 'dart:async';
import 'dart:io';
import 'package:dressur/6_login_register/connexion.dart';
import 'package:dressur/5_autre/support_assistance.dart';
import 'package:dressur/7_demarage/permissions_required_page.dart';
import 'package:flutter/material.dart';
import 'package:flutter_local_notifications/flutter_local_notifications.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/7_demarage/update_app_important.dart';
import 'package:dressur/7_demarage/presentation_ds.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/sql_helper.dart';
import 'package:dressur/components/bottomBar.dart';
import 'package:dressur/components/noti_sys.dart';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';
import 'dart:convert' as convert;

class WelcomePage extends StatelessWidget {
  const WelcomePage({this.notificationAppLaunchDetails, Key? key})
      : super(key: key);
  static const String routeName = '/';
  final NotificationAppLaunchDetails? notificationAppLaunchDetails;
  bool get didNotificationLaunchApp =>
      notificationAppLaunchDetails?.didNotificationLaunchApp ?? false;

  @override
  Widget build(BuildContext context) {
    return const Scaffold(
      backgroundColor: Colors.black,
      body: PageDepart(),
    );
  }
}

class PageDepart extends StatefulWidget {
  const PageDepart({Key? key}) : super(key: key);

  @override
  State<PageDepart> createState() => _PageDepartState();
}

class _PageDepartState extends State<PageDepart> {
  static const _requestTimeout = Duration(seconds: 12);
  static const _splashMinimum = Duration(milliseconds: 2500);
  bool _navigationStarted = false;

  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) => directConnect());
  }

  Future<Map<String, dynamic>> _requestJson(
    String path, {
    Map<String, String> fields = const {},
  }) async {
    final request = http.MultipartRequest(
      'POST',
      Uri.parse('$generalRouteForApi/$path'),
    )..fields.addAll(fields);
    final response = await request.send().timeout(_requestTimeout);
    final body = await response.stream.bytesToString().timeout(_requestTimeout);

    dynamic decoded;
    try {
      decoded = convert.jsonDecode(body);
    } catch (_) {
      if (response.statusCode == 401 || response.statusCode == 404) {
        return <String, dynamic>{
          'error': true,
          '_statusCode': response.statusCode,
        };
      }
      throw const FormatException('Invalid server response');
    }
    if (decoded is! Map<String, dynamic>) {
      if (response.statusCode == 401 || response.statusCode == 404) {
        return <String, dynamic>{
          'error': true,
          '_statusCode': response.statusCode,
        };
      }
      throw const FormatException('Invalid server response');
    }
    return <String, dynamic>{
      ...decoded,
      '_statusCode': response.statusCode,
    };
  }

  Future<String?> _loadStoredUid() async {
    try {
      final current = await SQLHelper.getUidUser();
      if (current.isNotEmpty) {
        final value = current.first['uid']?.toString().trim();
        if (value != null && value.isNotEmpty) return value;
      }
    } catch (_) {
      // Try the legacy database below.
    }

    try {
      final legacy = await SQLHelper.getUidUserOld();
      if (legacy.isNotEmpty) {
        final value = legacy.first['uid']?.toString().trim();
        if (value != null && value.isNotEmpty) return value;
      }
    } catch (_) {}
    return null;
  }

  Future<bool> _checkAppVersion() async {
    final data = await _requestJson('getVersionApp');
    if (data['error'] == false && data['importantUpdate'] == true) {
      myDressurVersion = data['versionApp'];
      final current = int.tryParse(versionApp.replaceAll('.', '')) ?? 0;
      final remote =
          int.tryParse(myDressurVersion.toString().replaceAll('.', '')) ?? 0;
      if (current < remote && mounted) {
        await Navigator.of(context).push(
          MaterialPageRoute(builder: (_) => ImportantUpdate()),
        );
        return true;
      }
    }
    return false;
  }

  Future<_SessionRestoreResult> _restoreSession(String storedUid) async {
    if (mounted) {
      setState(() {
        textChargementEvolution =
            langUserPhone != "fr" ? "Signing in ..." : "Connexion ...";
      });
    }

    final data = await _requestJson(
      'getUserInfo',
      fields: {'uid': storedUid},
    );

    if (data['error'] == false && data['user'] is Map<String, dynamic>) {
      uidUser = storedUid;
      await initUserInformations(data['user']);
      return _SessionRestoreResult.restored;
    }

    if (data['blocked'] == true || data['code'] == 'account_blocked') {
      return _SessionRestoreResult.blocked;
    }
    if (_isInvalidSessionResponse(data)) {
      return _SessionRestoreResult.invalid;
    }
    return _SessionRestoreResult.serverError;
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

  Future<void> _clearCachedSessionSafely() async {
    uidUser = null;
    try {
      await SQLHelper.clearCachedSession()
          .timeout(const Duration(seconds: 3));
    } catch (_) {
      // The recovery screen remains available even if local cleanup fails.
    }
  }

  Future<void> directConnect() async {
    if (_navigationStarted) return;
    final startedAt = DateTime.now();
    try {
      if (mounted) {
        setState(() {
          textChargementEvolution =
              langUserPhone != "fr" ? "Loading ..." : "Chargement ...";
        });
      }

      // The API may be unreachable. It must never own the splash forever.
      final updateShown = await _checkAppVersion();
      if (updateShown) return;

      final storedUid = await _loadStoredUid();
      if (storedUid == null) {
        await _waitForMinimumSplash(startedAt);
        if (!mounted) return;
        _openPresentation();
        return;
      }

      final result = await _restoreSession(storedUid);
      if (result == _SessionRestoreResult.invalid) {
        await _clearCachedSessionSafely();
        await _waitForMinimumSplash(startedAt);
        if (!mounted) return;
        _openStartupRecovery(_StartupFailure.sessionInvalid);
        return;
      }
      if (result == _SessionRestoreResult.blocked) {
        await _clearCachedSessionSafely();
        await _waitForMinimumSplash(startedAt);
        if (!mounted) return;
        _openStartupRecovery(_StartupFailure.accountBlocked);
        return;
      }
      if (result != _SessionRestoreResult.restored) {
        await _waitForMinimumSplash(startedAt);
        if (!mounted) return;
        _openStartupRecovery(_StartupFailure.serverUnavailable);
        return;
      }

      await _waitForMinimumSplash(startedAt);
      if (!mounted) return;
      textChargementEvolution = langUserPhone != "fr"
          ? "Initialization complete"
          : "Initialisation terminée";
      _openHome();
      unawaited(_runOptionalStartupReminder());
    } on TimeoutException {
      await _waitForMinimumSplash(startedAt);
      if (mounted) _openStartupRecovery(_StartupFailure.networkTimeout);
    } on SocketException {
      await _waitForMinimumSplash(startedAt);
      if (mounted) _openStartupRecovery(_StartupFailure.networkUnavailable);
    } on FormatException {
      await _waitForMinimumSplash(startedAt);
      if (mounted) _openStartupRecovery(_StartupFailure.serverUnavailable);
    } catch (_) {
      await _waitForMinimumSplash(startedAt);
      if (mounted) _openStartupRecovery(_StartupFailure.unknown);
    }
  }

  Future<void> _waitForMinimumSplash(DateTime startedAt) async {
    final elapsed = DateTime.now().difference(startedAt);
    final remaining = _splashMinimum - elapsed;
    if (remaining > Duration.zero) await Future<void>.delayed(remaining);
  }

  Future<void> _runOptionalStartupReminder() async {
    try {
      await _checkSynchroAvanceReminder();
    } catch (_) {
      // Notifications are optional and must never affect session restoration.
    }
  }

  void _openHome() {
    if (_navigationStarted || !mounted) return;
    _navigationStarted = true;
    Navigator.of(context).pushAndRemoveUntil(
      MaterialPageRoute(builder: (_) => const BottomBar()),
      (_) => false,
    );
  }

  void _openPresentation() {
    if (_navigationStarted || !mounted) return;
    _navigationStarted = true;
    Navigator.of(context).pushAndRemoveUntil(
      MaterialPageRoute(
        builder: (_) => PresentationPage(
          onOpenPermissions: _openPermissions,
        ),
      ),
      (_) => false,
    );
  }

  void _openPermissions(BuildContext presentationContext) {
    if (!presentationContext.mounted) return;
    Navigator.of(presentationContext).push(
      MaterialPageRoute(
        builder: (_) => PermissionsRequiredPage(
          onContinue: () {
            if (presentationContext.mounted) {
              Navigator.of(presentationContext).pop();
            }
          },
        ),
      ),
    );
  }

  void _openStartupRecovery(_StartupFailure failure) {
    if (_navigationStarted || !mounted) return;
    _navigationStarted = true;
    Navigator.of(context).pushAndRemoveUntil(
      MaterialPageRoute(
        builder: (_) => StartupRecoveryPage(
          failure: failure,
          onRetry: () {
            Navigator.of(context).pushAndRemoveUntil(
              MaterialPageRoute(builder: (_) => const WelcomePage()),
              (_) => false,
            );
          },
          onLogin: () {
            Navigator.of(context).pushAndRemoveUntil(
              MaterialPageRoute(builder: (_) => LoginPage()),
              (_) => false,
            );
          },
        ),
      ),
      (_) => false,
    );
  }

  Future<void> _checkSynchroAvanceReminder() async {
    final prefs = await SharedPreferences.getInstance();
    final String? lastDateStr = prefs.getString('lastSynchroAvanceDate');
    final bool shouldNotify = lastDateStr == null ||
        DateTime.now().difference(DateTime.parse(lastDateStr)).inDays >= 30;
    if (shouldNotify) {
      final bool isFr = langUserPhone == 'fr';
      await showNotification(
        isFr ? 'Synchronisation conseillée' : 'Sync recommended',
        isFr
            ? 'Mettez à jour vos contacts Dressur en lançant une Synchronisation Avancée.'
            : 'Update your Dressur contacts by running an Advanced Synchronization.',
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.transparent,
      body: Container(
        width: double.infinity,
        height: double.infinity,
        decoration: const BoxDecoration(
          gradient: RadialGradient(
            center: Alignment.center,
            radius: 0.9,
            colors: [Color(0xFF1A237E), Colors.black],
            stops: [0.0, 1.0],
          ),
        ),
        child: SafeArea(
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              const Spacer(flex: 2),
              const LogoAnimation(),
              const Spacer(flex: 2),
              // Texte de chargement discret en bas
              Padding(
                padding: const EdgeInsets.only(bottom: 48),
                child: Text(
                  textChargementEvolution,
                  style: GoogleFonts.poppins(
                    fontWeight: FontWeight.w300,
                    fontSize: 13,
                    color: Colors.white38,
                    letterSpacing: 1.5,
                  ),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}

enum _SessionRestoreResult {
  restored,
  invalid,
  blocked,
  serverError,
}

enum _StartupFailure {
  networkTimeout,
  networkUnavailable,
  serverUnavailable,
  sessionInvalid,
  accountBlocked,
  unknown,
}

class StartupRecoveryPage extends StatelessWidget {
  const StartupRecoveryPage({
    required this.failure,
    required this.onRetry,
    required this.onLogin,
    super.key,
  });

  final _StartupFailure failure;
  final VoidCallback onRetry;
  final VoidCallback onLogin;

  bool get _isFr => langUserPhone == 'fr';

  String get _title {
    switch (failure) {
      case _StartupFailure.sessionInvalid:
        return _isFr ? 'Session expirée' : 'Session expired';
      case _StartupFailure.accountBlocked:
        return _isFr ? 'Compte indisponible' : 'Account unavailable';
      case _StartupFailure.networkTimeout:
        return _isFr ? 'Connexion trop lente' : 'Connection timed out';
      case _StartupFailure.networkUnavailable:
        return _isFr ? 'Connexion impossible' : 'Unable to connect';
      default:
        return _isFr ? 'Dressur n’a pas pu démarrer' : 'Dressur could not start';
    }
  }

  String get _message {
    switch (failure) {
      case _StartupFailure.sessionInvalid:
        return _isFr
            ? 'Votre ancienne session n’est plus valide. Connectez-vous à nouveau pour retrouver votre compte.'
            : 'Your previous session is no longer valid. Sign in again to access your account.';
      case _StartupFailure.accountBlocked:
        return _isFr
            ? 'Cette session est liée à un compte bloqué. Contactez l’assistance si vous pensez qu’il s’agit d’une erreur.'
            : 'This session belongs to a blocked account. Contact support if you think this is a mistake.';
      case _StartupFailure.networkTimeout:
        return _isFr
            ? 'Le serveur met trop de temps à répondre. Vérifiez votre connexion puis réessayez.'
            : 'The server is taking too long to respond. Check your connection and try again.';
      case _StartupFailure.networkUnavailable:
        return _isFr
            ? 'Aucune connexion internet fiable n’a été détectée.'
            : 'A reliable internet connection was not detected.';
      default:
        return _isFr
            ? 'Une erreur temporaire a empêché le chargement de votre compte.'
            : 'A temporary error prevented your account from loading.';
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: primaryColor,
      body: SafeArea(
        child: Padding(
          padding: const EdgeInsets.all(24),
          child: Center(
            child: SingleChildScrollView(
              child: Column(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  Image.asset('images/dressur_logo.png', width: 110, height: 110),
                  const SizedBox(height: 28),
                  Text(
                    _title,
                    textAlign: TextAlign.center,
                    style: GoogleFonts.poppins(
                      color: Colors.white,
                      fontSize: 25,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  const SizedBox(height: 16),
                  Text(
                    _message,
                    textAlign: TextAlign.center,
                    style: GoogleFonts.poppins(
                      color: Colors.white70,
                      fontSize: 15,
                      height: 1.6,
                    ),
                  ),
                  const SizedBox(height: 30),
                  SizedBox(
                    width: double.infinity,
                    child: ElevatedButton.icon(
                      onPressed: onRetry,
                      icon: const Icon(Icons.refresh),
                      label: Text(_isFr ? 'Réessayer' : 'Try again'),
                      style: ElevatedButton.styleFrom(
                        backgroundColor: Colors.white,
                        foregroundColor: primaryColor,
                        padding: const EdgeInsets.symmetric(vertical: 15),
                      ),
                    ),
                  ),
                  const SizedBox(height: 12),
                  SizedBox(
                    width: double.infinity,
                    child: OutlinedButton(
                      onPressed: onLogin,
                      child: Text(
                        _isFr ? 'Se connecter' : 'Sign in',
                        style: const TextStyle(color: Colors.white),
                      ),
                      style: OutlinedButton.styleFrom(
                        side: const BorderSide(color: Colors.white54),
                        padding: const EdgeInsets.symmetric(vertical: 15),
                      ),
                    ),
                  ),
                  const SizedBox(height: 10),
                  TextButton.icon(
                    onPressed: () => Navigator.of(context).push(
                      MaterialPageRoute(builder: (_) => SupportPage()),
                    ),
                    icon: const Icon(Icons.support_agent, color: Colors.white70),
                    label: Text(
                      _isFr ? 'Contacter l’assistance' : 'Contact support',
                      style: const TextStyle(color: Colors.white70),
                    ),
                  ),
                ],
              ),
            ),
          ),
        ),
      ),
    );
  }
}

// ─── Peintre des anneaux radar ────────────────────────────────────────────────

class _RadarPainter extends CustomPainter {
  final double animValue;
  final Color color;

  _RadarPainter({required this.animValue, required this.color});

  @override
  void paint(Canvas canvas, Size size) {
    final center = Offset(size.width / 2, size.height / 2);
    final baseRadius = size.width * 0.38;
    final maxRadius = size.width * 0.95;

    for (int i = 0; i < 3; i++) {
      final phase = (animValue + i / 3) % 1.0;
      final radius = baseRadius + (maxRadius - baseRadius) * phase;
      final opacity = (1.0 - phase) * 0.35;

      if (opacity > 0.01) {
        final paint = Paint()
          ..style = PaintingStyle.stroke
          ..strokeWidth = 1.5
          ..color = color.withOpacity(opacity);
        canvas.drawCircle(center, radius, paint);
      }
    }
  }

  @override
  bool shouldRepaint(_RadarPainter old) => old.animValue != animValue;
}

// ─── Animation du logo ───────────────────────────────────────────────────────

class LogoAnimation extends StatefulWidget {
  const LogoAnimation({Key? key}) : super(key: key);

  @override
  _LogoAnimationState createState() => _LogoAnimationState();
}

class _LogoAnimationState extends State<LogoAnimation>
    with TickerProviderStateMixin {
  // Contrôleur d'entrée (joue une fois)
  late AnimationController _entryCtrl;
  // Contrôleur de pulse radar (boucle)
  late AnimationController _radarCtrl;

  late Animation<double> _logoFade;
  late Animation<double> _logoScale;
  late Animation<double> _nameFade;
  late Animation<Offset> _nameSlide;
  late Animation<double> _lineScale;
  late Animation<double> _taglineFade;

  @override
  void initState() {
    super.initState();

    _entryCtrl = AnimationController(
      vsync: this,
      duration: const Duration(milliseconds: 5500),
    )..forward();

    _radarCtrl = AnimationController(
      vsync: this,
      duration: const Duration(milliseconds: 3200),
    )..repeat();

    // Logo : fade + scale (0 → 55% du timeline)
    _logoFade = Tween(begin: 0.0, end: 1.0).animate(
      CurvedAnimation(
        parent: _entryCtrl,
        curve: const Interval(0.0, 0.5, curve: Curves.easeOut),
      ),
    );
    _logoScale = Tween(begin: 0.55, end: 1.0).animate(
      CurvedAnimation(
        parent: _entryCtrl,
        curve: const Interval(0.0, 0.6, curve: Curves.easeOutBack),
      ),
    );

    // Nom : slide vers le haut + fade (40% → 75%)
    _nameFade = Tween(begin: 0.0, end: 1.0).animate(
      CurvedAnimation(
        parent: _entryCtrl,
        curve: const Interval(0.4, 0.72, curve: Curves.easeOut),
      ),
    );
    _nameSlide = Tween(
      begin: const Offset(0, 0.6),
      end: Offset.zero,
    ).animate(
      CurvedAnimation(
        parent: _entryCtrl,
        curve: const Interval(0.4, 0.72, curve: Curves.easeOut),
      ),
    );

    // Ligne décorative (65% → 88%)
    _lineScale = Tween(begin: 0.0, end: 1.0).animate(
      CurvedAnimation(
        parent: _entryCtrl,
        curve: const Interval(0.65, 0.88, curve: Curves.easeOut),
      ),
    );

    // Tagline (75% → 100%)
    _taglineFade = Tween(begin: 0.0, end: 1.0).animate(
      CurvedAnimation(
        parent: _entryCtrl,
        curve: const Interval(0.75, 1.0, curve: Curves.easeOut),
      ),
    );
  }

  @override
  void dispose() {
    _entryCtrl.dispose();
    _radarCtrl.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return AnimatedBuilder(
      animation: Listenable.merge([_entryCtrl, _radarCtrl]),
      builder: (context, child) {
        return Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            // Zone logo + anneaux radar
            SizedBox(
              width: 240,
              height: 240,
              child: Stack(
                alignment: Alignment.center,
                children: [
                  // Anneaux radar en arrière-plan
                  CustomPaint(
                    size: const Size(240, 240),
                    painter: _RadarPainter(
                      animValue: _radarCtrl.value,
                      color: const Color(0xFF5B8DEF),
                    ),
                  ),

                  // Halo lumineux derrière le logo
                  Opacity(
                    opacity: _logoFade.value * 0.6,
                    child: Container(
                      width: 150,
                      height: 150,
                      decoration: BoxDecoration(
                        shape: BoxShape.circle,
                        boxShadow: [
                          BoxShadow(
                            color: const Color(0xFF2a4b9a).withOpacity(0.8),
                            blurRadius: 60,
                            spreadRadius: 20,
                          ),
                        ],
                      ),
                    ),
                  ),

                  // Logo avec fade + scale
                  Opacity(
                    opacity: _logoFade.value,
                    child: Transform.scale(
                      scale: _logoScale.value,
                      child: Image.asset(
                        'images/dressur_logo.png',
                        width: 170,
                        height: 170,
                      ),
                    ),
                  ),
                ],
              ),
            ),

            const SizedBox(height: 28),

            // Nom de l'app
            FadeTransition(
              opacity: _nameFade,
              child: SlideTransition(
                position: _nameSlide,
                child: Text(
                  'DRESSUR',
                  style: GoogleFonts.poppins(
                    fontSize: 30,
                    fontWeight: FontWeight.bold,
                    color: Colors.white,
                    letterSpacing: 10,
                  ),
                ),
              ),
            ),

            const SizedBox(height: 14),

            // Ligne décorative dégradée
            Transform.scale(
              scaleX: _lineScale.value,
              child: Container(
                width: 200,
                height: 2,
                decoration: BoxDecoration(
                  gradient: LinearGradient(
                    colors: [
                      Colors.transparent,
                      const Color(0xFF5B8DEF),
                      Colors.transparent,
                    ],
                  ),
                  borderRadius: BorderRadius.circular(1),
                ),
              ),
            ),

            const SizedBox(height: 12),

            // Tagline
            Opacity(
              opacity: _taglineFade.value,
              child: Text(
                langUserPhone == "fr"
                    ? 'Connecte · Booste · Grandit'
                    : 'Connect · Boost · Grow',
                style: GoogleFonts.poppins(
                  fontSize: 13,
                  color: Colors.white54,
                  letterSpacing: 2,
                  fontWeight: FontWeight.w300,
                ),
              ),
            ),
          ],
        );
      },
    );
  }
}
