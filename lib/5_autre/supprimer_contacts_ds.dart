import 'package:animate_do/animate_do.dart';
import 'package:flutter/material.dart';
import 'package:flutter_contacts/flutter_contacts.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:permission_handler/permission_handler.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/noti.dart';
import 'package:dressur/components/noti_sys.dart';

class SupprimerContactsDSPage extends StatefulWidget {
  const SupprimerContactsDSPage({Key? key}) : super(key: key);

  @override
  State<SupprimerContactsDSPage> createState() =>
      _SupprimerContactsDSPageState();
}

class _SupprimerContactsDSPageState extends State<SupprimerContactsDSPage> {
  bool _enCour = false;
  double _progress = 0.0;
  bool _showSummary = false;
  int _totalSupprime = 0;
  String _statusText = "";

  Future<void> _supprimerContactsDS() async {
    // --- Permission contacts ---
    PermissionStatus contactPerm = await Permission.contacts.status;
    if (contactPerm != PermissionStatus.granted) {
      contactPerm = await Permission.contacts.request();
    }
    if (contactPerm != PermissionStatus.granted) {
      if (mounted) {
        warningNoti(
          "Attention !",
          (langUserPhone == "fr")
              ? "Veuillez autoriser Dressur à accéder à vos contacts."
              : "Please allow Dressur to access your contacts.",
          context,
        );
      }
      return;
    }

    // --- Permission notifications (Android 13+) ---
    await Permission.notification.request();

    if (mounted) {
      setState(() {
        _enCour = true;
        _progress = 0.0;
        _showSummary = false;
        _totalSupprime = 0;
        _statusText = (langUserPhone == "fr")
            ? "Recherche des contacts DS…"
            : "Looking for DS contacts…";
      });
    }

    try {
      final List<Contact> tousLesContacts =
          await FlutterContacts.getContacts(withProperties: true);

      final List<Contact> dsContacts = tousLesContacts
          .where((c) => c.displayName.contains('#DS'))
          .toList();

      if (dsContacts.isEmpty) {
        await cancelDSDeletionNotification();
        if (mounted) {
          setState(() {
            _enCour = false;
            _progress = 1.0;
            _showSummary = true;
            _totalSupprime = 0;
            _statusText = (langUserPhone == "fr")
                ? "Aucun contact DS trouvé."
                : "No DS contacts found.";
          });
        }
        return;
      }

      final int total = dsContacts.length;

      // Notification initiale (0 / total)
      await showDSDeletionProgress(0, total);

      if (mounted) {
        setState(() {
          _statusText = (langUserPhone == "fr")
              ? "$total contact(s) DS détecté(s). Suppression en cours…"
              : "$total DS contact(s) detected. Deletion in progress…";
        });
      }

      int supprimes = 0;
      for (final contact in dsContacts) {
        await contact.delete();
        supprimes++;

        // Mise à jour de la notification
        await showDSDeletionProgress(supprimes, total);

        // Mise à jour de l'UI seulement si la page est encore visible
        if (mounted) {
          setState(() {
            _progress = supprimes / total;
            _statusText = (langUserPhone == "fr")
                ? "Suppression… ($supprimes / $total)"
                : "Deleting… ($supprimes / $total)";
          });
        }
      }

      // Notification de fin
      await showDSDeletionComplete(supprimes);

      if (mounted) {
        setState(() {
          _enCour = false;
          _progress = 1.0;
          _showSummary = true;
          _totalSupprime = supprimes;
          _statusText = (langUserPhone == "fr")
              ? "$supprimes contact(s) DS supprimé(s) avec succès."
              : "$supprimes DS contact(s) successfully deleted.";
        });
      }
    } catch (e) {
      await cancelDSDeletionNotification();
      if (mounted) {
        setState(() {
          _enCour = false;
          _statusText = (langUserPhone == "fr")
              ? "Une erreur est survenue : $e"
              : "An error occurred: $e";
        });
      }
    }
  }

  Widget _buildWarningRow(String text) {
    return Row(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        FaIcon(FontAwesomeIcons.triangleExclamation,
            size: 13, color: Colors.red[600]),
        SizedBox(width: 8),
        Expanded(
          child: Text(
            text,
            style: GoogleFonts.poppins(
                fontSize: 13,
                color: Colors.red[700],
                fontWeight: FontWeight.w500),
          ),
        ),
      ],
    );
  }

  Widget _buildInfoRow(String text) {
    return Row(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        FaIcon(FontAwesomeIcons.circleCheck, size: 13, color: Colors.blue[600]),
        SizedBox(width: 8),
        Expanded(
          child: Text(
            text,
            style: GoogleFonts.poppins(fontSize: 12, color: Colors.grey[700]),
          ),
        ),
      ],
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        elevation: 0,
        backgroundColor: primaryColor,
        title: Text(
          (langUserPhone == "fr")
              ? "Suppression des contacts DS"
              : "Delete DS Contacts",
          style: GoogleFonts.poppins(
            color: Colors.white,
            fontWeight: FontWeight.w400,
            fontSize: 18,
          ),
        ),
        leading: IconButton(
          // Le back button reste toujours actif : l'utilisateur peut naviguer
          // librement pendant la suppression — la notification suit en arrière-plan.
          onPressed: () => Navigator.pop(context),
          icon: const FaIcon(
            FontAwesomeIcons.chevronLeft,
            color: Colors.white,
          ),
        ),
      ),
      body: Padding(
        padding: const EdgeInsets.symmetric(horizontal: 20.0, vertical: 30.0),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          crossAxisAlignment: CrossAxisAlignment.center,
          children: [
            Spacer(),

            // --- ICÔNE ANIMÉE ---
            FadeIn(
              duration: Duration(milliseconds: 500),
              child: FaIcon(
                _showSummary
                    ? FontAwesomeIcons.circleCheck
                    : FontAwesomeIcons.broom,
                size: 80,
                color: _showSummary ? Colors.green : Colors.orange[700],
              ),
            ),
            SizedBox(height: 20),

            // --- TITRE ---
            FadeInUp(
              from: 20,
              duration: Duration(milliseconds: 500),
              delay: Duration(milliseconds: 200),
              child: Text(
                _showSummary
                    ? (langUserPhone == "fr")
                        ? "Suppression terminée"
                        : "Deletion completed"
                    : (langUserPhone == "fr")
                        ? "Suppression des contacts DS"
                        : "Delete DS Contacts",
                textAlign: TextAlign.center,
                style: GoogleFonts.poppins(
                    fontSize: 26, fontWeight: FontWeight.bold),
              ),
            ),
            SizedBox(height: 15),

            // --- RÉSUMÉ APRÈS SUPPRESSION ---
            if (_showSummary) ...[
              FadeInUp(
                from: 20,
                duration: Duration(milliseconds: 400),
                child: Container(
                  width: double.infinity,
                  padding: EdgeInsets.all(16),
                  decoration: BoxDecoration(
                    color: Colors.green.withOpacity(0.07),
                    borderRadius: BorderRadius.circular(12),
                    border: Border.all(color: Colors.green.withOpacity(0.3)),
                  ),
                  child: Text(
                    _statusText,
                    textAlign: TextAlign.center,
                    style: GoogleFonts.poppins(
                      fontSize: 15,
                      fontWeight: FontWeight.w600,
                      color: Colors.green[700],
                    ),
                  ),
                ),
              ),
              SizedBox(height: 20),
              FadeInUp(
                from: 20,
                duration: Duration(milliseconds: 400),
                delay: Duration(milliseconds: 100),
                child: SizedBox(
                  width: double.infinity,
                  child: ElevatedButton.icon(
                    onPressed: () => Navigator.pop(context),
                    icon: FaIcon(FontAwesomeIcons.chevronLeft),
                    label: Text(
                        (langUserPhone == "fr") ? "Retour" : "Go back"),
                    style: ElevatedButton.styleFrom(
                      backgroundColor: primaryColor,
                      foregroundColor: Colors.white,
                      padding: EdgeInsets.symmetric(vertical: 16),
                      textStyle: GoogleFonts.poppins(
                          fontSize: 16, fontWeight: FontWeight.bold),
                      shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(12)),
                    ),
                  ),
                ),
              ),
            ],

            // --- VUE INITIALE (avant / pendant suppression) ---
            if (!_showSummary) ...[

              // Rappel notification pendant l'opération
              if (_enCour) ...[
                FadeIn(
                  duration: Duration(milliseconds: 300),
                  child: Container(
                    padding: EdgeInsets.symmetric(horizontal: 14, vertical: 10),
                    decoration: BoxDecoration(
                      color: Colors.blue.withOpacity(0.06),
                      borderRadius: BorderRadius.circular(12),
                      border: Border.all(color: Colors.blue.withOpacity(0.2)),
                    ),
                    child: Row(
                      children: [
                        FaIcon(FontAwesomeIcons.bell,
                            size: 13, color: Colors.blue[600]),
                        SizedBox(width: 8),
                        Expanded(
                          child: Text(
                            (langUserPhone == "fr")
                                ? "Suppression en cours — vous pouvez naviguer, la progression est visible dans vos notifications."
                                : "Deletion in progress — you can navigate freely, progress is shown in your notifications.",
                            style: GoogleFonts.poppins(
                                fontSize: 12, color: Colors.blue[700]),
                          ),
                        ),
                      ],
                    ),
                  ),
                ),
                SizedBox(height: 14),
              ],

              // Avertissements (masqués pendant la suppression)
              if (!_enCour) ...[
                FadeInUp(
                  from: 20,
                  duration: Duration(milliseconds: 500),
                  delay: Duration(milliseconds: 400),
                  child: Container(
                    padding: EdgeInsets.all(16),
                    decoration: BoxDecoration(
                      color: Colors.red.withOpacity(0.05),
                      borderRadius: BorderRadius.circular(12),
                      border: Border.all(color: Colors.red.withOpacity(0.2)),
                    ),
                    child: Column(
                      children: [
                        _buildWarningRow(
                          (langUserPhone == "fr")
                              ? "Cette action est irréversible."
                              : "This action is irreversible.",
                        ),
                        SizedBox(height: 10),
                        _buildWarningRow(
                          (langUserPhone == "fr")
                              ? "Ne fermez pas complètement l'application."
                              : "Do not fully close the application.",
                        ),
                      ],
                    ),
                  ),
                ),
                SizedBox(height: 16),

                // Info box
                FadeInUp(
                  from: 20,
                  duration: Duration(milliseconds: 500),
                  delay: Duration(milliseconds: 500),
                  child: Container(
                    width: double.infinity,
                    padding: EdgeInsets.all(14),
                    decoration: BoxDecoration(
                      color: Colors.blue.withOpacity(0.05),
                      borderRadius: BorderRadius.circular(12),
                      border: Border.all(color: Colors.blue.withOpacity(0.15)),
                    ),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Row(
                          children: [
                            FaIcon(FontAwesomeIcons.circleInfo,
                                size: 14, color: Colors.blue[600]),
                            SizedBox(width: 8),
                            Text(
                              (langUserPhone == "fr")
                                  ? "Ce que va faire cette opération :"
                                  : "What this operation will do:",
                              style: GoogleFonts.poppins(
                                fontSize: 12,
                                fontWeight: FontWeight.w600,
                                color: Colors.blue[700],
                              ),
                            ),
                          ],
                        ),
                        SizedBox(height: 8),
                        _buildInfoRow(
                          (langUserPhone == "fr")
                              ? "Détecter tous les contacts dont le nom contient « #DS »"
                              : "Detect all contacts whose name contains \"#DS\"",
                        ),
                        SizedBox(height: 4),
                        _buildInfoRow(
                          (langUserPhone == "fr")
                              ? "Les supprimer définitivement de votre répertoire téléphonique"
                              : "Permanently delete them from your phone contacts",
                        ),
                        SizedBox(height: 4),
                        _buildInfoRow(
                          (langUserPhone == "fr")
                              ? "Vos contacts personnels ne seront pas affectés"
                              : "Your personal contacts will not be affected",
                        ),
                        SizedBox(height: 4),
                        _buildInfoRow(
                          (langUserPhone == "fr")
                              ? "La progression sera affichée dans vos notifications"
                              : "Progress will be shown in your notifications",
                        ),
                      ],
                    ),
                  ),
                ),
                SizedBox(height: 16),
              ],

              // Bouton d'action
              FadeInUp(
                from: 20,
                duration: Duration(milliseconds: 500),
                delay: Duration(milliseconds: 600),
                child: SizedBox(
                  width: double.infinity,
                  child: ElevatedButton.icon(
                    onPressed: _enCour ? null : _supprimerContactsDS,
                    icon: _enCour
                        ? Container()
                        : FaIcon(FontAwesomeIcons.broom),
                    label: _enCour
                        ? SizedBox(
                            height: 24,
                            width: 24,
                            child: CircularProgressIndicator(
                                color: Colors.white, strokeWidth: 2))
                        : Text(
                            (langUserPhone == "fr")
                                ? "Démarrer la suppression"
                                : "Start deletion",
                          ),
                    style: ElevatedButton.styleFrom(
                      backgroundColor: Colors.orange[700],
                      foregroundColor: Colors.white,
                      padding: EdgeInsets.symmetric(vertical: 16),
                      textStyle: GoogleFonts.poppins(
                          fontSize: 16, fontWeight: FontWeight.bold),
                      shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(12)),
                    ),
                  ),
                ),
              ),
            ],

            Spacer(),

            // --- BARRE DE PROGRESSION EN BAS (visible pendant la suppression) ---
            if (_enCour)
              FadeIn(
                duration: Duration(milliseconds: 300),
                child: Padding(
                  padding: const EdgeInsets.only(bottom: 20.0),
                  child: Column(
                    children: [
                      ClipRRect(
                        borderRadius: BorderRadius.circular(10),
                        child: LinearProgressIndicator(
                          value: _progress,
                          minHeight: 8,
                          backgroundColor: Colors.grey[200],
                          color: Colors.orange[700],
                        ),
                      ),
                      SizedBox(height: 10),
                      Text(
                        _statusText,
                        style: GoogleFonts.poppins(
                            fontSize: 14, color: Colors.grey[600]),
                        textAlign: TextAlign.center,
                      ),
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
