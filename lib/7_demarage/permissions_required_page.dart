import 'dart:async';

import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:permission_handler/permission_handler.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/7_demarage/presentation_ds.dart';
import 'package:dressur/components/permission_manager.dart';

class PermissionsRequiredPage extends StatefulWidget {
  const PermissionsRequiredPage({
    this.onContinue,
    Key? key,
  }) : super(key: key);

  final VoidCallback? onContinue;

  @override
  State<PermissionsRequiredPage> createState() => _PermissionsRequiredPageState();
}

class _PermissionsRequiredPageState extends State<PermissionsRequiredPage>
    with WidgetsBindingObserver {
  static const _permissionCheckTimeout = Duration(seconds: 8);
  static const _settingsTimeout = Duration(seconds: 3);

  bool _checking = false;
  bool _navigationStarted = false;
  String? _checkMessage;

  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addObserver(this);
    WidgetsBinding.instance.addPostFrameCallback((_) {
      _checkPermissions();
    });
  }

  @override
  void dispose() {
    WidgetsBinding.instance.removeObserver(this);
    super.dispose();
  }

  @override
  void didChangeAppLifecycleState(AppLifecycleState state) {
    if (state == AppLifecycleState.resumed) {
      _checkPermissions();
    }
  }

  Future<void> _checkPermissions() async {
    if (_checking || !mounted) return;
    setState(() => _checking = true);

    try {
      final statuses = await Future.wait<AppPermissionResult>([
        PermissionManager.instance.check(Permission.contacts),
        PermissionManager.instance.check(Permission.notification),
        PermissionManager.instance.check(Permission.scheduleExactAlarm),
      ]).timeout(_permissionCheckTimeout);

      if (!mounted) return;
      if (statuses.every((status) => status.canProceed) &&
          !_navigationStarted) {
        _continueWithoutPermissions();
      } else {
        setState(() => _checkMessage = null);
      }
    } on TimeoutException {
      if (mounted) {
        setState(() {
          _checkMessage = langUserPhone == "fr"
              ? "La vérification prend trop de temps. Vous pouvez réessayer ou continuer."
              : "The check is taking too long. You can retry or continue.";
        });
      }
    } catch (_) {
      if (mounted) {
        setState(() {
          _checkMessage = langUserPhone == "fr"
              ? "Les autorisations n'ont pas pu être vérifiées. Vous pouvez réessayer ou continuer."
              : "Permissions could not be checked. You can retry or continue.";
        });
      }
    } finally {
      if (mounted && _checking) {
        setState(() => _checking = false);
      }
    }
  }

  Future<void> _openSettings() async {
    if (_checking || !mounted) return;

    setState(() => _checkMessage = null);
    try {
      await PermissionManager.instance.openSettings().timeout(_settingsTimeout);
    } on TimeoutException {
      // Android may keep the settings screen open even when this call times out.
    } catch (_) {
      if (mounted) {
        setState(() {
          _checkMessage = langUserPhone == "fr"
              ? "Les paramètres n'ont pas pu être ouverts. Vous pouvez vérifier à nouveau ou continuer."
              : "Settings could not be opened. You can check again or continue.";
        });
      }
    }

    if (mounted) {
      await _checkPermissions();
    }
  }

  void _continueWithoutPermissions() {
    if (_navigationStarted || !mounted) return;
    _navigationStarted = true;

    if (widget.onContinue != null) {
      widget.onContinue!();
      return;
    }

    Navigator.of(context).pushAndRemoveUntil(
      MaterialPageRoute(builder: (_) => PresentationPage()),
      (_) => false,
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: primaryColor,
      body: SafeArea(
        child: Padding(
          padding: const EdgeInsets.all(24.0),
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              Image.asset(
                'images/dressur_logo.png',
                width: 120,
                height: 120,
              ),
              const SizedBox(height: 40),
              Text(
                langUserPhone == "fr"
                    ? "Autorisations pour certaines fonctions"
                    : "Permissions for some features",
                style: GoogleFonts.poppins(
                  fontSize: 28,
                  fontWeight: FontWeight.bold,
                  color: Colors.white,
                ),
                textAlign: TextAlign.center,
              ),
              const SizedBox(height: 20),
              Text(
                langUserPhone == "fr"
                    ? "Ces autorisations permettent d'utiliser certaines fonctions de Dressur. "
                        "Vous pouvez continuer à utiliser l'application sans les accorder.\n\n"
                        "• Accès aux contacts\n"
                        "• Notifications et alarmes exactes\n"
                        "Les photos sont sélectionnées uniquement lorsque vous choisissez une image."
                    : "These permissions enable some Dressur features. "
                        "You can continue using the app without granting them.\n\n"
                        "• Access to contacts\n"
                        "• Notifications and exact alarms\n"
                        "Photos are selected only when you choose an image.",
                style: GoogleFonts.poppins(
                  fontSize: 18,
                  color: Colors.white70,
                  height: 1.6,
                ),
                textAlign: TextAlign.center,
              ),
              const SizedBox(height: 40),
              ElevatedButton.icon(
                onPressed: _checking ? null : _openSettings,
                icon: const FaIcon(FontAwesomeIcons.gear, color: Colors.black),
                label: Text(
                  langUserPhone == "fr"
                      ? "Ouvrir les paramètres"
                      : "Open Settings",
                  style: GoogleFonts.poppins(
                      color: Colors.black, fontWeight: FontWeight.w600),
                ),
                style: ElevatedButton.styleFrom(
                  backgroundColor: Colors.white,
                  padding:
                      const EdgeInsets.symmetric(horizontal: 32, vertical: 16),
                  shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(30)),
                ),
              ),
              const SizedBox(height: 12),
              TextButton(
                onPressed: _checking ? null : _checkPermissions,
                child: Text(
                  langUserPhone == "fr"
                      ? "Vérifier à nouveau"
                      : "Check again",
                  style: const TextStyle(color: Colors.white),
                ),
              ),
              TextButton(
                onPressed: _continueWithoutPermissions,
                child: Text(
                  langUserPhone == "fr"
                      ? "Continuer sans ces autorisations"
                      : "Continue without these permissions",
                  style: const TextStyle(color: Colors.white70),
                  textAlign: TextAlign.center,
                ),
              ),
              const SizedBox(height: 20),
              if (_checking)
                Text(
                  langUserPhone == "fr"
                      ? "Vérification en cours…"
                      : "Checking permissions…",
                  style: GoogleFonts.poppins(
                    fontSize: 14,
                    color: Colors.white70,
                  ),
                  textAlign: TextAlign.center,
                )
              else if (_checkMessage != null)
                Text(
                  _checkMessage!,
                  style: GoogleFonts.poppins(
                    fontSize: 14,
                    color: Colors.white70,
                  ),
                  textAlign: TextAlign.center,
                ),
              if (_checking || _checkMessage != null)
                const SizedBox(height: 12),
              Text(
                langUserPhone == "fr"
                    ? "Après votre retour des paramètres, les autorisations seront vérifiées automatiquement."
                    : "When you return from Settings, permissions will be checked automatically.",
                style: GoogleFonts.poppins(
                  fontSize: 16,
                  color: Colors.white60,
                ),
                textAlign: TextAlign.center,
              ),
            ],
          ),
        ),
      ),
    );
  }
}
