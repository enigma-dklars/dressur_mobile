import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:permission_handler/permission_handler.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/7_demarage/presentation_ds.dart';

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
  bool _checking = false;
  bool _navigationStarted = false;

  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addObserver(this);
  }

  @override
  void dispose() {
    WidgetsBinding.instance.removeObserver(this);
    super.dispose();
  }

  @override
  void didChangeAppLifecycleState(AppLifecycleState state) {
    if (state == AppLifecycleState.resumed) _checkPermissions();
  }

  Future<void> _checkPermissions() async {
    if (_checking) return;
    setState(() => _checking = true);
    try {
      final statuses = await Future.wait<PermissionStatus>([
        Permission.contacts.status,
        Permission.storage.status,
        Permission.scheduleExactAlarm.status,
      ]).timeout(const Duration(seconds: 8));
      if (!mounted) return;
      if (statuses.every((status) => status.isGranted) &&
          !_navigationStarted) {
        _navigationStarted = true;
        Navigator.of(context).pushAndRemoveUntil(
          MaterialPageRoute(builder: (_) => PresentationPage()),
          (_) => false,
        );
      }
    } catch (_) {
      // The page remains actionable; permissions can be checked on next resume.
    } finally {
      if (mounted) setState(() => _checking = false);
    }
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
                    ? "Autorisations requises"
                    : "Permissions Required",
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
                    ? "Pour que Dressur fonctionne correctement, vous devez autoriser :\n\n"
                        "• Accès aux contacts\n"
                        "• Notifications (alarmes exactes)\n"
                        "• Accès au stockage"
                    : "For Dressur to work properly, you must allow:\n\n"
                        "• Access to contacts\n"
                        "• Notifications (exact alarms)\n"
                        "• Storage access",
                style: GoogleFonts.poppins(
                  fontSize: 18,
                  color: Colors.white70,
                  height: 1.6,
                ),
                textAlign: TextAlign.center,
              ),
              const SizedBox(height: 40),
              ElevatedButton.icon(
                onPressed: _checking
                    ? null
                    : () async {
                        await openAppSettings();
                        if (mounted) await _checkPermissions();
                      },
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
                onPressed: widget.onContinue,
                child: Text(
                  langUserPhone == "fr"
                      ? "Continuer sans ces autorisations"
                      : "Continue without these permissions",
                  style: const TextStyle(color: Colors.white70),
                  textAlign: TextAlign.center,
                ),
              ),
              const SizedBox(height: 20),
              Text(
                langUserPhone == "fr"
                    ? "Après avoir accordé les autorisations,\nfermez et relancez l'application."
                    : "After granting permissions,\nclose and restart the app.",
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
