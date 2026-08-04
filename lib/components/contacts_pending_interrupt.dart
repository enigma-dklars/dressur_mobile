// ignore_for_file: use_build_context_synchronously
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/components/constant.dart';

class ContactsPendingInterruptPage extends StatefulWidget {
  final int nombreContacts;
  final VoidCallback onSaveNow;
  final VoidCallback onLater;

  const ContactsPendingInterruptPage({
    super.key,
    required this.nombreContacts,
    required this.onSaveNow,
    required this.onLater,
  });

  @override
  State<ContactsPendingInterruptPage> createState() =>
      _ContactsPendingInterruptPageState();
}

class _ContactsPendingInterruptPageState
    extends State<ContactsPendingInterruptPage>
    with SingleTickerProviderStateMixin {
  late AnimationController _animController;
  late Animation<double> _scaleAnim;

  @override
  void initState() {
    super.initState();
    _animController = AnimationController(
      vsync: this,
      duration: const Duration(milliseconds: 500),
    );
    _scaleAnim = CurvedAnimation(
      parent: _animController,
      curve: Curves.elasticOut,
    );
    _animController.forward();
  }

  @override
  void dispose() {
    _animController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    final bool isFr = langUserPhone == 'fr';

    return PopScope(
      canPop: false, // Bloque le retour arrière
      child: Scaffold(
        backgroundColor: Colors.white,
        body: SafeArea(
          child: Padding(
            padding: const EdgeInsets.symmetric(horizontal: 28, vertical: 32),
            child: Column(
              mainAxisAlignment: MainAxisAlignment.center,
              crossAxisAlignment: CrossAxisAlignment.center,
              children: [
                const Spacer(),

                // ── Icône animée ─────────────────────────────────────────────
                ScaleTransition(
                  scale: _scaleAnim,
                  child: Container(
                    width: 120,
                    height: 120,
                    decoration: BoxDecoration(
                      color: const Color(0xFF4CAF50).withOpacity(0.10),
                      shape: BoxShape.circle,
                    ),
                    child: const Icon(
                      Icons.people_alt_rounded,
                      size: 72,
                      color: Color(0xFF4CAF50),
                    ),
                  ),
                ),
                const SizedBox(height: 32),

                // ── Titre ────────────────────────────────────────────────────
                Text(
                  isFr
                      ? 'Vous avez ${widget.nombreContacts} contact(s) qui vous attendent !'
                      : 'You have ${widget.nombreContacts} contact(s) waiting for you!',
                  style: GoogleFonts.poppins(
                    fontSize: 22,
                    fontWeight: FontWeight.w700,
                    color: const Color(0xFF1A1A1A),
                    height: 1.3,
                  ),
                  textAlign: TextAlign.center,
                ),
                const SizedBox(height: 16),

                // ── Sous-titre ───────────────────────────────────────────────
                Text(
                  isFr
                      ? 'Enregistrez-les maintenant dans votre répertoire pour ne pas les perdre.'
                      : 'Save them to your contacts now so you don\'t miss them.',
                  style: GoogleFonts.poppins(
                    fontSize: 15,
                    color: Colors.grey[600],
                    height: 1.5,
                  ),
                  textAlign: TextAlign.center,
                ),

                const Spacer(),

                // ── Bouton principal ─────────────────────────────────────────
                SizedBox(
                  width: double.infinity,
                  child: ElevatedButton(
                    style: ElevatedButton.styleFrom(
                      backgroundColor: const Color(0xFF4CAF50),
                      foregroundColor: Colors.white,
                      padding: const EdgeInsets.symmetric(vertical: 16),
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(14),
                      ),
                      elevation: 2,
                    ),
                    onPressed: () {
                      widget.onSaveNow();
                      Navigator.of(context).pop();
                    },
                    child: Text(
                      isFr ? 'Enregistrer maintenant' : 'Save now',
                      style: GoogleFonts.poppins(
                        fontSize: 16,
                        fontWeight: FontWeight.w600,
                      ),
                    ),
                  ),
                ),
                const SizedBox(height: 16),

                // ── Bouton secondaire ────────────────────────────────────────
                TextButton(
                  onPressed: () {
                    Navigator.of(context).pop();
                    widget.onLater();
                  },
                  child: Text(
                    isFr
                        ? 'Plus tard (je le ferai depuis l\'onglet Actu)'
                        : 'Later (I\'ll do it from the News tab)',
                    style: GoogleFonts.poppins(
                      fontSize: 13,
                      color: Colors.grey[500],
                    ),
                    textAlign: TextAlign.center,
                  ),
                ),
                const SizedBox(height: 8),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
