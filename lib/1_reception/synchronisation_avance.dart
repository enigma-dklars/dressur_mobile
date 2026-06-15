import 'dart:convert';
import 'package:animate_do/animate_do.dart';
import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:permission_handler/permission_handler.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/sql_helper.dart';
import 'package:dressur/components/noti.dart';
import 'package:http/http.dart' as http;
import 'package:flutter_contacts/flutter_contacts.dart';

class SynchroAvance extends StatelessWidget {
  const SynchroAvance({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return const Scaffold(
      backgroundColor: Colors.white,
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
  bool _enCour = false;
  double _progress = 0.0;

  Future<void> synchroAvanceFunction() async {
    setState(() {
      _enCour = true;
      _progress = 0.0; // La progression commence à 0
      textChargementEvolution = (langUserPhone == "fr")
          ? "Recherche de vos Contacts DS..."
          : "Finding your DS Contacts...";
    });

    try {
      // C'est une bonne pratique d'envelopper les appels réseau dans un try-catch
      final url = Uri.parse(
          '$generalRouteForApi/listContactDS/$uidUser/$langUserPhone');
      final response = await http.get(url);

      if (response.statusCode == 200) {
        final jsonData = jsonDecode(response.body) as List<dynamic>;

        if (jsonData.isNotEmpty) {
          // --- ÉTAPE 1 : Reconnaissance des contacts existants (0% -> 50% de la progression) ---
          setState(() {
            textChargementEvolution = (langUserPhone == "fr")
                ? "Analyse de vos contacts locaux..."
                : "Analyzing your local contacts...";
          });

          await SQLHelper.viderLaBaseDeDonneeLocalTelUser();
          List<Contact> contacts =
              await FlutterContacts.getContacts(withProperties: true);
          int totalLocalContacts = contacts.length;

          for (int i = 0; i < totalLocalContacts; i++) {
            var contact = contacts[i];
            for (var phone in contact.phones) {
              var numberTel =
                  (phone.number).replaceAll(" ", "").replaceAll("-", "");
              if ((await SQLHelper.getOneNumsTelUser(numberTel)).isEmpty) {
                await insertNumTelUserIntoDataBase(numberTel);
              }
            }

            // --- MISE À JOUR DE LA PROGRESSION (Partie 1) ---
            setState(() {
              // On calcule la progression sur la première moitié (0.0 à 0.5)
              _progress = (i + 1) / totalLocalContacts * 0.5;
              textChargementEvolution = (langUserPhone == "fr")
                  ? "Analyse des contacts locaux... (${i + 1} / $totalLocalContacts)"
                  : "Analyzing local contacts... (${i + 1} / $totalLocalContacts)";
            });
          }

          // --- ÉTAPE 2 : Enregistrement des contacts DS manquants (50% -> 100% de la progression) ---
          setState(() {
            textChargementEvolution = (langUserPhone == "fr")
                ? "Enregistrement des contacts DS manquants..."
                : "Saving missing DS contacts...";
          });

          int totalDSContacts = jsonData.length;
          for (int i = 0; i < totalDSContacts; i++) {
            var contactData = jsonData[i];
            if ((await SQLHelper.getOneNumsTelUser(contactData['tel']))
                .isEmpty) {
              final String tel = (contactData["tel"] as String);
              final String telSansPlus = tel.replaceAll("+", "");
              final List<Phone> phonesList = [Phone(tel)];
              if (tel.startsWith("+229") && !tel.startsWith("+22901")) {
                final String afterCode = tel.substring(4);
                phonesList.add(Phone("+22901$afterCode"));
              }
              final String nom = (contactData["nom"] ?? "").toString().trim();
              final String pseudo = contactData["pseudo"] as String;
              final List<String> nameParts = [nom, pseudo, telSansPlus].where((s) => s.isNotEmpty).toList();
              final newContact = Contact()
                ..name.first = "${nameParts.join(" - ")} #DS"
                ..phones = phonesList;
              await newContact.insert();
              await insertNumTelUserIntoDataBase(contactData["tel"]);
            }

            // --- MISE À JOUR DE LA PROGRESSION (Partie 2) ---
            setState(() {
              // On part de 0.5 et on ajoute la progression de la deuxième moitié
              _progress = 0.5 + ((i + 1) / totalDSContacts * 0.5);
              textChargementEvolution = (langUserPhone == "fr")
                  ? "Enregistrement des contacts DS... (${i + 1} / $totalDSContacts)"
                  : "Saving DS contacts... (${i + 1} / $totalDSContacts)";
            });
          }

          // --- FIN ---
          setState(() {
            _enCour = false;
            _progress = 1.0; // On s'assure que la barre est pleine à la fin
            textChargementEvolution = (langUserPhone == "fr")
                ? "Synchronisation terminée avec succès !"
                : "Synchronization completed successfully!";
          });
        } else {
          // Cas où il n'y a aucun contact DS à synchroniser
          setState(() {
            _enCour = false;
            textChargementEvolution = (langUserPhone == "fr")
                ? "Vous n'avez aucun contact DS, la synchronisation n'est pas nécessaire."
                : "You don't have any DS contacts, synchronization is not needed.";
          });
        }
      } else {
        // Gérer les erreurs de l'appel API
        throw Exception("Erreur de l'API: ${response.statusCode}");
      }
    } catch (e) {
      // Gérer les erreurs générales (réseau, etc.)
      setState(() {
        _enCour = false;
        textChargementEvolution = "Une erreur est survenue: $e";
      });
    }
  }

  Future<void> _askPermissions([String? routeName]) async {
    PermissionStatus permissionStatus = await _getContactPermission();
    if (permissionStatus == PermissionStatus.granted) {
      insertDressurContact();
    } else {
      _handleInvalidPermissions(permissionStatus);
    }
  }

  Future<PermissionStatus> _getContactPermission() async {
    PermissionStatus permission = await Permission.contacts.status;
    // permission != PermissionStatus.granted && permission != PermissionStatus.permanentlyDenied
    if (permission != PermissionStatus.granted) {
      PermissionStatus permissionStatus = await Permission.contacts.request();
      return permissionStatus;
    } else {
      return permission;
    }
  }

  void _handleInvalidPermissions(PermissionStatus permissionStatus) {
    if (permissionStatus != PermissionStatus.granted) {
      if (langUserPhone != "fr") {
        warningNoti(
            "Attention !",
            "Please allow Dressur to automatically save contacts to your phone.\nThis authorization is necessary to take full advantage of our features.",
            context);
      } else {
        warningNoti(
            "Attention !",
            "Veuillez autoriser Dressur a enregistrer automatiquement les contacts dans votre téléphone.\nCette autorisation est nécéssaire pour profiter pleinement de nos fonctionnalités.",
            context);
      }
    }
  }

  @override
  void initState() {
    super.initState();
    _askPermissions();
    setState(() {
      textChargementEvolution = "";
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        elevation: 0,
        backgroundColor: primaryColor,
        title: Text(
          (langUserPhone == "fr")
              ? "Synchronisation avancé"
              : "Advanced synchronization",
          style: GoogleFonts.poppins(
            color: Colors.white,
            fontWeight: FontWeight.w400,
            fontSize: 18,
          ),
        ),
        leading: IconButton(
          onPressed: () {
            Navigator.pop(context);
          },
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
                FontAwesomeIcons.lock,
                size: 80,
                color: primaryColor,
              ),
            ),
            SizedBox(height: 20),

            // --- TITRE ---
            FadeInUp(
              from: 20,
              duration: Duration(milliseconds: 500),
              delay: Duration(milliseconds: 200),
              child: Text(
                (langUserPhone == "fr")
                    ? "Synchronisation Avancée"
                    : "Advanced Synchronization",
                textAlign: TextAlign.center,
                style: GoogleFonts.poppins(
                    fontSize: 26, fontWeight: FontWeight.bold),
              ),
            ),
            SizedBox(height: 15),

            // --- AVERTISSEMENTS IMPORTANTS ---
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
                          ? "L'opération peut être longue."
                          : "The operation may take a long time.",
                    ),
                    SizedBox(height: 10),
                    _buildWarningRow(
                      (langUserPhone == "fr")
                          ? "Ne quittez pas l'application."
                          : "Do not leave the application.",
                    ),
                  ],
                ),
              ),
            ),
            SizedBox(height: 30),

            // --- BOUTON D'ACTION ---
            FadeInUp(
              from: 20,
              duration: Duration(milliseconds: 500),
              delay: Duration(milliseconds: 600),
              child: SizedBox(
                width: double.infinity,
                child: ElevatedButton.icon(
                  onPressed: _enCour
                      ? null
                      : () async {
                          // Note: Votre fonction synchroAvanceFunction devra maintenant
                          // mettre à jour `_progress` et `textChargementEvolution`
                          await synchroAvanceFunction();
                        },
                  icon: _enCour
                      ? Container()
                      : FaIcon(FontAwesomeIcons.solidCirclePlay),
                  label: _enCour
                      ? SizedBox(
                          height: 24,
                          width: 24,
                          child: CircularProgressIndicator(
                              color: Colors.white, strokeWidth: 2))
                      : Text((langUserPhone == "fr")
                          ? "Démarrer la Synchronisation"
                          : "Start Synchronization"),
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
            Spacer(),

            // --- FEEDBACK DE PROGRESSION ---
            if (_enCour)
              FadeIn(
                duration: Duration(milliseconds: 300),
                child: Padding(
                  padding: const EdgeInsets.only(bottom: 20.0),
                  child: Column(
                    children: [
                      // Barre de progression
                      ClipRRect(
                        borderRadius: BorderRadius.circular(10),
                        child: LinearProgressIndicator(
                          value: _progress, // Doit être entre 0.0 et 1.0
                          minHeight: 8,
                          backgroundColor: Colors.grey[200],
                          color: primaryColor,
                        ),
                      ),
                      SizedBox(height: 10),
                      // Texte de progression
                      Text(
                        textChargementEvolution,
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

  Widget _buildWarningRow(String text) {
    return Row(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        FaIcon(FontAwesomeIcons.triangleExclamation,
            color: Colors.red[700], size: 20),
        SizedBox(width: 12),
        Expanded(
          child: Text(
            text,
            style: GoogleFonts.poppins(
                color: Colors.red[800], fontWeight: FontWeight.w500),
          ),
        ),
      ],
    );
  }
}
