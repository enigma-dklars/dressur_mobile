// ignore_for_file: prefer_const_constructors, prefer_const_literals_to_create_immutables

import 'package:dressur/1_reception/recompense_dashboard.dart';
import 'package:dressur/components/noti.dart';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/components/constant.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;

class ProgrammeRecompensePage extends StatefulWidget {
  final dynamic optionPage;

  const ProgrammeRecompensePage({super.key, required this.optionPage});

  @override
  State<ProgrammeRecompensePage> createState() =>
      _ProgrammeRecompensePageState();
}

class _ProgrammeRecompensePageState extends State<ProgrammeRecompensePage> {
  var data;
  bool _desactive = false;

  void addToRecompenseProgramme() async {
    bool isConnected = await isConnectedToInternet();
    if (isConnected) {
      setState(() {
        _desactive = true;
      });

      var request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/addToRecompenseProgramme'));
      request.fields.addAll({
        'uid': uidUser,
        'langUserPhone': langUserPhone.toString(),
      });

      http.StreamedResponse response = await request.send();

      if (response.statusCode == 200) {
        var data1 = await response.stream.bytesToString();
        data = convert.jsonDecode(data1);
        if (data["error"] == true) {
          dangerNoti(data["titre"], data["message"], context);
          setState(() {
            _desactive = false;
          });
        } else {
          setState(() {
            _desactive = false;
            isInscritProgrammeRecompense = true;
          });
        }
      } else {
        setState(() {
          _desactive = false;
        });
        if (langUserPhone != "fr") {
          dangerNoti("Mistake!",
              "We encountered a problem, contact the administrators.", context);
        } else {
          dangerNoti(
              "Erreur!",
              "Nous avons rencontré un problème, contacter les administrateurs.",
              context);
        }
      }
    } else {
      setState(() {
        _desactive = false;
      });
      if (langUserPhone != "fr") {
        dangerNoti(
            "Mistake!", "You are not connected to the internet.", context);
      } else {
        dangerNoti("Erreur!", "Vous n'ètes pas connecté a internet.", context);
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    final theme = Theme.of(context);

    return Scaffold(
      backgroundColor: theme.scaffoldBackgroundColor,
      appBar: AppBar(
        backgroundColor: primaryColor,
        elevation: 0,
        centerTitle: true,
        title: Text(
          "Programme des récompenses",
          style: GoogleFonts.poppins(
            fontWeight: FontWeight.w600,
            color: Colors.white,
            fontSize: 18,
          ),
        ),
        leading: IconButton(
          icon: Icon(Icons.arrow_back_ios, color: Colors.white, size: 20),
          onPressed: () => Navigator.pop(context),
        ),
      ),
      body: widget.optionPage
          ? _pagePresentationProgramme(context)
          : isInscritProgrammeRecompense
              ? _pageInformationApresInscription(context)
              : _pagePresentationProgramme(context),
    );
  }

  // ---------------------------------------------------------------------------
  // PAGE DE PRÉSENTATION EXHAUSTIVE
  // ---------------------------------------------------------------------------
  Widget _pagePresentationProgramme(BuildContext context) {
    final theme = Theme.of(context);
    final isDark = theme.brightness == Brightness.dark;

    return SingleChildScrollView(
      physics: BouncingScrollPhysics(),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          // Header TikTok Style
          Container(
            width: double.infinity,
            padding: EdgeInsets.all(24),
            decoration: BoxDecoration(
              gradient: LinearGradient(
                colors: [primaryColor, primaryColor.withOpacity(0.8)],
                begin: Alignment.topLeft,
                end: Alignment.bottomRight,
              ),
            ),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Icon(Icons.stars, size: 48, color: Colors.white),
                SizedBox(height: 16),
                Text(
                  "Gagnez des récompenses avec Dressur",
                  style: GoogleFonts.poppins(
                    fontSize: 24,
                    fontWeight: FontWeight.bold,
                    color: Colors.white,
                  ),
                ),
                SizedBox(height: 8),
                Text(
                  "Partagez des promotions sur votre statut WhatsApp et soyez récompensé.",
                  style: GoogleFonts.poppins(
                    fontSize: 14,
                    color: Colors.white.withOpacity(0.9),
                  ),
                ),
              ],
            ),
          ),

          Padding(
            padding: const EdgeInsets.all(20),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                // 1. Présentation
                _sectionTitle(context, "Présentation"),
                _paragraph(context,
                    "Le Programme des récompenses Dressur est une opportunité de gain occasionnelle destinée aux utilisateurs qui partagent des promotions d’affaires (produits et services) directement depuis l’application Dressur sur WhatsApp Statut."),
                _paragraph(context,
                    "Ce programme permet aux annonceurs de faire connaître leurs offres et aux utilisateurs de recevoir une récompense après validation des preuves et selon le quota disponible."),

                _divider(context),

                // 2. Réseau concerné
                _sectionTitle(context, "Réseau concerné"),
                _bulletItem(context, Icons.check_circle,
                    "WhatsApp – Statut uniquement", Colors.green),
                _bulletItem(context, Icons.cancel,
                    "Autres réseaux non pris en charge", Colors.red),

                _divider(context),

                // 3. Principe de fonctionnement
                _sectionTitle(context, "Principe de fonctionnement"),
                _stepItem(context, "1",
                    "Identifiez une promotion éligible au programme."),
                _stepItem(context, "2",
                    "Partagez la promotion directement depuis l’application Dressur vers votre statut WhatsApp."),
                _stepItem(context, "3",
                    "Le contenu partagé (image + texte) est officiel et validé par Dressur."),
                _stepItem(context, "4",
                    "Aucune modification n’est autorisée (image, texte, description)."),
                _stepItem(context, "5",
                    "Après 20 heures, vous pouvez soumettre vos preuves."),
                _stepItem(context, "6", "Les preuves sont analysées."),
                _stepItem(context, "7",
                    "Si elles sont validées et que le quota n’est pas atteint, votre solde est crédité."),

                _divider(context),

                // 4. Niveaux de vues et récompenses
                _sectionTitle(context, "Niveaux de vues et récompenses"),
                _paragraph(context,
                    "Gagnez plus d'argent en atteignant des paliers de vues plus élevés sur votre statut."),
                _rewardRow(context, "250 vues", "100", Colors.green),
                _rewardRow(context, "500 vues", "200", Colors.blue),
                _rewardRow(context, "1 000 vues", "500", Colors.purple),
                _rewardRow(context, "2 000 vues", "1 000", Colors.orange),
                _rewardRow(context, "4 000 vues", "2 500", Colors.red),
                _infoText(context,
                    "👉 Vous êtes rémunéré au niveau correspondant au plus haut seuil atteint."),

                _divider(context),

                // 5. Règles essentielles
                _sectionTitle(context, "Règles essentielles"),
                _bulletItem(context, Icons.info_outline,
                    "Le partage doit être effectué uniquement depuis Dressur."),
                _bulletItem(context, Icons.timer_outlined,
                    "Le statut doit rester visible au moins 20 heures."),
                _bulletItem(context, Icons.edit_off_outlined,
                    "Toute modification du contenu annule automatiquement la récompense."),
                _bulletItem(context, Icons.verified_user_outlined,
                    "Les preuves doivent être authentiques, complètes et personnelles."),
                _bulletItem(context, Icons.people_outline,
                    "Seuls les premiers utilisateurs ayant fourni des preuves valides sont récompensés."),
                SizedBox(height: 8),
                _infoText(context,
                    "👉 Cliquer sur « Participer » vaut acceptation totale de ces règles."),

                _divider(context),

                // 6. Délais importants
                _sectionTitle(context, "Délais importants"),
                _bulletItem(context, Icons.hourglass_top,
                    "Délai minimum : 20 heures après le partage"),
                _bulletItem(context, Icons.hourglass_bottom,
                    "Délai maximum : avant 24 heures (expiration WhatsApp)"),
                _bulletItem(context, Icons.replay,
                    "En cas de preuve incomplète, une reprise peut être demandée dans la limite du délai"),

                _divider(context),

                // 7. Preuves à fournir
                _sectionTitle(context, "Preuves à fournir (obligatoires)"),
                _paragraph(context,
                    "Pour être éligible, vous devez fournir les trois preuves suivantes :"),
                SizedBox(height: 15),
                _proofCard(context, "1", "Capture – Liste des statuts",
                    "• Affiche la liste des statuts WhatsApp\n• Le statut de la promotion doit être visible"),
                _proofCard(context, "2", "Capture – Statut ouvert",
                    "• Image complète\n• Texte descriptif complet\n• Nombre de vues, date et heure visibles"),
                _proofCard(context, "3", "Vidéo – Preuve principale",
                    "La vidéo doit montrer : \n• l’ouverture de WhatsApp, \n• la liste des statuts, \n• l’ouverture du statut, \n• la lecture de la description, \n• le défilement des vues, \n• la date/heure et les paramètres WhatsApp (numéro)."),
                SizedBox(height: 10),
                _warningBox(context,
                    "Toute vidéo incomplète, modifiée ou incohérente sera rejetée."),

                _divider(context),

                // 8. Validation et quota
                _sectionTitle(context, "Validation et quota"),
                _bulletItem(context, Icons.analytics_outlined,
                    "Les preuves sont analysées par le système et/ou l’équipe Dressur."),
                _bulletItem(context, Icons.fact_check_outlined,
                    "La validation dépend de la conformité et du quota disponible."),
                _infoText(context,
                    "📌 Atteindre un seuil de vues ne garantit pas automatiquement le paiement."),

                _divider(context),

                // 9. Récompense et solde
                _sectionTitle(context, "Récompense et solde"),
                _bulletItem(context, Icons.account_balance_wallet_outlined,
                    "Ajoutée à votre solde Programme des récompenses"),
                _bulletItem(context, Icons.history,
                    "Enregistrée dans votre historique avec la promotion"),

                _divider(context),

                // 10. Retrait des gains
                _sectionTitle(context, "Retrait des gains"),
                _bulletItem(context, Icons.payments_outlined,
                    "Montant minimum : 1 000 FCFA"),
                _bulletItem(context, Icons.phone_android,
                    "Méthodes : Mobile Money (MTN, Moov, Orange, etc.)"),
                _bulletItem(context, Icons.security,
                    "Soumis aux contrôles de sécurité habituels."),

                _divider(context),

                // 11. Politique anti-fraude
                _sectionTitle(context, "Politique anti-fraude"),
                _paragraph(context, "Toute tentative de fraude entraîne :"),
                _bulletItem(context, Icons.block,
                    "Annulation immédiate des gains", Colors.red),
                _bulletItem(context, Icons.person_off,
                    "Suspension ou suppression du compte", Colors.red),
                _bulletItem(context, Icons.gavel,
                    "Interdiction définitive de participation", Colors.red),
                _paragraph(context,
                    "Dressur se réserve le droit de refuser toute preuve jugée douteuse."),

                _divider(context),

                // 12. Message important
                _sectionTitle(context, "Message important"),
                _paragraph(context,
                    "Le Programme des récompenses est une opportunité de gain complémentaire, non un revenu garanti. Il vise également à aider les utilisateurs à faire connaître des promotions utiles au-delà de la plateforme."),

                _divider(context),

                // 13. Action finale
                _sectionTitle(context, "Action"),
                _paragraph(context,
                    "En cliquant sur « Participer », vous confirmez avoir compris le fonctionnement, accepter les règles et être prêt à fournir les preuves demandées."),

                SizedBox(height: 20),
                if (isInscritProgrammeRecompense == false) ...[
                  SizedBox(
                    width: double.infinity,
                    height: 55,
                    child: ElevatedButton(
                      style: ElevatedButton.styleFrom(
                        backgroundColor: primaryColor,
                        elevation: 0,
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(15),
                        ),
                      ),
                      onPressed: () {
                        _desactive ? null : addToRecompenseProgramme();
                      },
                      child: _desactive
                          ? SizedBox(
                              width: 30,
                              height: 30,
                              child: CircularProgressIndicator.adaptive(
                                strokeWidth: 2.5,
                                valueColor:
                                    AlwaysStoppedAnimation(Colors.white),
                              ),
                            )
                          : Text(
                              "Participer au programme",
                              style: GoogleFonts.poppins(
                                fontSize: 16,
                                fontWeight: FontWeight.w600,
                                color: Colors.white,
                              ),
                            ),
                    ),
                  ),
                ] else ...[
                  Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      SizedBox(height: 10),

                      // Icône de succès stylisée
                      Container(
                        padding: EdgeInsets.all(20),
                        decoration: BoxDecoration(
                          color: Colors.green.withOpacity(0.1),
                          shape: BoxShape.circle,
                        ),
                        child: Icon(
                          Icons.verified,
                          size: 80,
                          color: Colors.green,
                        ),
                      ),

                      SizedBox(height: 24),

                      Text(
                        "Vous participez déjà au programme",
                        textAlign: TextAlign.center,
                        style: GoogleFonts.poppins(
                          fontSize: 22,
                          fontWeight: FontWeight.bold,
                          color: theme.textTheme.bodyLarge?.color,
                        ),
                      ),

                      SizedBox(height: 12),

                      Text(
                        "Votre compte est actif. Vous pouvez commencer à partager des promotions pour gagner des récompenses.",
                        textAlign: TextAlign.center,
                        style: GoogleFonts.poppins(
                          fontSize: 15,
                          color: isDark ? Colors.grey[400] : Colors.grey[600],
                        ),
                      ),

                      SizedBox(height: 40),

                      // Carte d'information pour quitter le programme
                      Container(
                        width: double.infinity,
                        padding: EdgeInsets.all(20),
                        decoration: BoxDecoration(
                          color: isDark
                              ? Colors.white.withOpacity(0.05)
                              : Colors.grey[50],
                          borderRadius: BorderRadius.circular(20),
                          border: Border.all(
                            color: theme.dividerColor.withOpacity(0.1),
                          ),
                        ),
                        child: Column(
                          children: [
                            Text(
                              "Besoin de quitter le programme ?",
                              textAlign: TextAlign.center,
                              style: GoogleFonts.poppins(
                                fontSize: 15,
                                fontWeight: FontWeight.w600,
                              ),
                            ),

                            SizedBox(height: 10),

                            Text(
                              "Pour vous désinscrire du programme des récompenses, veuillez contacter notre équipe d'assistance.",
                              textAlign: TextAlign.center,
                              style: GoogleFonts.poppins(
                                fontSize: 13,
                                color: isDark
                                    ? Colors.grey[400]
                                    : Colors.grey[600],
                              ),
                            ),

                            SizedBox(height: 20),

                            // Lien WhatsApp stylisé
                            InkWell(
                              onTap: () {
                                // TODO: ouvrir WhatsApp / support
                              },
                              borderRadius: BorderRadius.circular(12),
                              child: Container(
                                padding: EdgeInsets.symmetric(
                                  horizontal: 20,
                                  vertical: 12,
                                ),
                                decoration: BoxDecoration(
                                  color: Color(0xFF25D366).withOpacity(0.1),
                                  borderRadius: BorderRadius.circular(12),
                                  border: Border.all(
                                    color: Color(0xFF25D366).withOpacity(0.3),
                                  ),
                                ),
                                child: Row(
                                  mainAxisSize: MainAxisSize.min,
                                  children: [
                                    Icon(
                                      Icons.chat,
                                      color: Color(0xFF25D366),
                                      size: 20,
                                    ),
                                    SizedBox(width: 10),
                                    Text(
                                      "Contacter l'assistance",
                                      style: GoogleFonts.poppins(
                                        color: Color(0xFF25D366),
                                        fontWeight: FontWeight.bold,
                                        fontSize: 14,
                                      ),
                                    ),
                                  ],
                                ),
                              ),
                            ),
                          ],
                        ),
                      ),
                    ],
                  ),
                ],

                SizedBox(height: 40),
              ],
            ),
          ),
        ],
      ),
    );
  }

  // ---------------------------------------------------------------------------
  // PAGE APRÈS INSCRIPTION
  // ---------------------------------------------------------------------------
  Widget _pageInformationApresInscription(BuildContext context) {
    final theme = Theme.of(context);
    return Container(
      width: double.infinity,
      padding: const EdgeInsets.all(30),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Icon(Icons.check_circle, size: 80, color: Colors.green),
          SizedBox(height: 24),
          Text(
            "Inscription confirmée",
            style: GoogleFonts.poppins(
              fontSize: 22,
              fontWeight: FontWeight.bold,
              color: theme.textTheme.bodyLarge?.color,
            ),
          ),
          SizedBox(height: 12),
          Text(
            "Vous pouvez maintenant commencer à promouvoir des offres et soumettre vos preuves.",
            textAlign: TextAlign.center,
            style: GoogleFonts.poppins(fontSize: 14),
          ),
          SizedBox(height: 40),
          SizedBox(
            width: double.infinity,
            height: 55,
            child: ElevatedButton(
              style: ElevatedButton.styleFrom(
                backgroundColor: primaryColor,
                shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(15)),
              ),
              onPressed: () {
                Navigator.pushReplacement(
                  context,
                  MaterialPageRoute(
                    builder: (_) => ProgrammeRecompenseDashboard(),
                  ),
                );
              },
              child: Text("Commencer",
                  style: GoogleFonts.poppins(
                      color: Colors.white, fontWeight: FontWeight.w600)),
            ),
          ),
        ],
      ),
    );
  }

  // ---------------------------------------------------------------------------
  // COMPOSANTS DE DESIGN
  // ---------------------------------------------------------------------------

  Widget _sectionTitle(BuildContext context, String title) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 12, top: 8),
      child: Text(
        title,
        style: GoogleFonts.poppins(
          fontSize: 18,
          fontWeight: FontWeight.bold,
          color: primaryColor,
        ),
      ),
    );
  }

  Widget _paragraph(BuildContext context, String text) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 10),
      child: Text(
        text,
        style: GoogleFonts.poppins(
          fontSize: 14,
          height: 1.5,
          color: Theme.of(context).textTheme.bodyMedium?.color,
        ),
      ),
    );
  }

  Widget _bulletItem(BuildContext context, IconData icon, String text,
      [Color? iconColor]) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 8),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Icon(icon,
              size: 18, color: iconColor ?? primaryColor.withOpacity(0.7)),
          SizedBox(width: 10),
          Expanded(
            child: Text(
              text,
              style: GoogleFonts.poppins(fontSize: 14),
            ),
          ),
        ],
      ),
    );
  }

  Widget _stepItem(BuildContext context, String number, String text) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 12),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          CircleAvatar(
            radius: 12,
            backgroundColor: primaryColor,
            child: Text(number,
                style: TextStyle(
                    color: Colors.white,
                    fontSize: 12,
                    fontWeight: FontWeight.bold)),
          ),
          SizedBox(width: 12),
          Expanded(
            child: Text(text, style: GoogleFonts.poppins(fontSize: 14)),
          ),
        ],
      ),
    );
  }

  Widget _rewardRow(
      BuildContext context, String views, String amount, Color color) {
    final isDark = Theme.of(context).brightness == Brightness.dark;
    return Container(
      margin: EdgeInsets.only(bottom: 10),
      padding: EdgeInsets.symmetric(horizontal: 16, vertical: 12),
      decoration: BoxDecoration(
        color: color.withOpacity(0.1),
        borderRadius: BorderRadius.circular(15),
        border: Border.all(color: color.withOpacity(0.3)),
      ),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          Row(
            children: [
              Icon(Icons.visibility_outlined, color: color, size: 20),
              SizedBox(width: 12),
              Text(
                views,
                style: GoogleFonts.poppins(
                  fontWeight: FontWeight.w600,
                  fontSize: 15,
                  color: isDark ? Colors.white : Colors.black87,
                ),
              ),
            ],
          ),
          Container(
            padding: EdgeInsets.symmetric(horizontal: 12, vertical: 4),
            decoration: BoxDecoration(
              color: color,
              borderRadius: BorderRadius.circular(10),
            ),
            child: Text(
              "$amount FCFA",
              style: GoogleFonts.poppins(
                fontWeight: FontWeight.bold,
                fontSize: 14,
                color: Colors.white,
              ),
            ),
          ),
        ],
      ),
    );
  }

  Widget _infoText(BuildContext context, String text) {
    return Text(
      text,
      style: GoogleFonts.poppins(
        fontSize: 13,
        fontWeight: FontWeight.w500,
        fontStyle: FontStyle.italic,
        color: Theme.of(context).textTheme.bodySmall?.color,
      ),
    );
  }

  Widget _proofCard(
      BuildContext context, String number, String title, String content) {
    final isDark = Theme.of(context).brightness == Brightness.dark;
    return Container(
      width: double.infinity,
      margin: EdgeInsets.only(bottom: 12),
      padding: EdgeInsets.all(15),
      decoration: BoxDecoration(
        color: isDark ? Colors.white.withOpacity(0.05) : Colors.green[50],
        borderRadius: BorderRadius.circular(12),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              CircleAvatar(
                radius: 12,
                backgroundColor: primaryColor,
                child: Text(number,
                    style: TextStyle(
                        color: Colors.white,
                        fontSize: 12,
                        fontWeight: FontWeight.bold)),
              ),
              SizedBox(width: 10),
              Expanded(
                child: Text(
                  title,
                  style: GoogleFonts.poppins(
                      fontWeight: FontWeight.bold, fontSize: 14),
                ),
              ),
            ],
          ),
          SizedBox(height: 8),
          Padding(
            padding: const EdgeInsets.only(left: 30),
            child: Text(content,
                style: GoogleFonts.poppins(fontSize: 13, height: 1.4)),
          ),
        ],
      ),
    );
  }

  Widget _warningBox(BuildContext context, String text) {
    return Container(
      padding: EdgeInsets.all(12),
      decoration: BoxDecoration(
        color: Colors.red.withOpacity(0.1),
        borderRadius: BorderRadius.circular(8),
        border: Border.all(color: Colors.red.withOpacity(0.3)),
      ),
      child: Row(
        children: [
          Icon(Icons.warning_amber_rounded, color: Colors.red, size: 20),
          SizedBox(width: 10),
          Expanded(
            child: Text(text,
                style: GoogleFonts.poppins(
                    fontSize: 12,
                    color: Colors.red[700],
                    fontWeight: FontWeight.w500)),
          ),
        ],
      ),
    );
  }

  Widget _divider(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 15),
      child: Divider(
          thickness: 1, color: Theme.of(context).dividerColor.withOpacity(0.5)),
    );
  }
}
