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
  bool _etendreAuxNonDS = false;

  String _normalizeNumber(String tel) {
    final String n = tel.replaceAll(" ", "").replaceAll("-", "");
    if (n.startsWith("+22901") && n.length > 6) {
      return "+229${n.substring(6)}";
    }
    return n;
  }

  Set<String> _computeDuplicatesToDelete(List<Contact> contacts) {
    final Map<String, List<Contact>> grouped = {};
    for (final c in contacts) {
      for (final p in c.phones) {
        final String norm = _normalizeNumber(p.number);
        grouped.putIfAbsent(norm, () => []);
        if (!grouped[norm]!.any((x) => x.id == c.id)) {
          grouped[norm]!.add(c);
        }
      }
    }
    final Set<String> toDelete = {};
    for (final group in grouped.values) {
      if (group.length > 1) {
        group.sort((a, b) => b.phones.length.compareTo(a.phones.length));
        for (int i = 1; i < group.length; i++) {
          toDelete.add(group[i].id);
        }
      }
    }
    return toDelete;
  }

  Contact? _findDSContactByTel(List<Contact> dsContacts, String tel) {
    final String normTel = _normalizeNumber(tel);
    for (final c in dsContacts) {
      for (final p in c.phones) {
        final String normP = _normalizeNumber(p.number);
        if (normP == normTel) return c;
      }
    }
    return null;
  }

  Future<void> synchroAvanceFunction(bool etendreAuxNonDS) async {
    setState(() {
      _enCour = true;
      _progress = 0.0;
      textChargementEvolution = (langUserPhone == "fr")
          ? "Recherche de vos Contacts DS..."
          : "Finding your DS Contacts...";
    });

    try {
      final url = Uri.parse(
          '$generalRouteForApi/listContactDS/$uidUser/$langUserPhone');
      final response = await http.get(url);

      if (response.statusCode == 200) {
        final jsonData = jsonDecode(response.body) as List<dynamic>;

        if (jsonData.isNotEmpty) {
          final int totalDSContacts = jsonData.length;

          // ===== ÉTAPE 1 : FUSION DES DOUBLONS (0% -> 30%) =====
          setState(() {
            textChargementEvolution = (langUserPhone == "fr")
                ? "Détection des doublons${etendreAuxNonDS ? '' : ' DS'}..."
                : "Detecting${etendreAuxNonDS ? '' : ' DS'} duplicates...";
          });

          List<Contact> allContacts =
              await FlutterContacts.getContacts(withProperties: true);

          final List<Contact> dsContacts = allContacts
              .where((c) => c.name.first.endsWith("#DS"))
              .toList();

          // Collecter les doublons DS à supprimer
          final Set<String> dsToDeleteIds = _computeDuplicatesToDelete(dsContacts);

          // Collecter les doublons non-DS si option activée
          final Set<String> nonDSToDeleteIds = etendreAuxNonDS
              ? _computeDuplicatesToDelete(
                  allContacts.where((c) => !c.name.first.endsWith("#DS")).toList())
              : {};

          final List<String> toDeleteList =
              {...dsToDeleteIds, ...nonDSToDeleteIds}.toList();

          int deletedCount = 0;
          for (int i = 0; i < toDeleteList.length; i++) {
            final Contact? toDelete = allContacts
                .cast<Contact?>()
                .firstWhere((x) => x?.id == toDeleteList[i], orElse: () => null);
            if (toDelete != null) {
              await FlutterContacts.deleteContacts([toDelete]);
              deletedCount++;
            }
            setState(() {
              _progress = (i + 1) / toDeleteList.length * 0.3;
              final bool isDS = dsToDeleteIds.contains(toDeleteList[i]);
              textChargementEvolution = (langUserPhone == "fr")
                  ? "Fusion ${isDS ? 'DS' : 'contacts personnels'}... ($deletedCount supprimé(s))"
                  : "Merging ${isDS ? 'DS' : 'personal contacts'}... ($deletedCount removed)";
            });
          }

          setState(() {
            _progress = 0.3;
            if (toDeleteList.isEmpty) {
              textChargementEvolution = (langUserPhone == "fr")
                  ? "Aucun doublon détecté."
                  : "No duplicates found.";
            }
          });

          // ===== ÉTAPE 2 : ANALYSE DES CONTACTS LOCAUX (30% -> 60%) =====
          setState(() {
            textChargementEvolution = (langUserPhone == "fr")
                ? "Analyse de vos contacts locaux..."
                : "Analyzing your local contacts...";
          });

          await SQLHelper.viderLaBaseDeDonneeLocalTelUser();
          allContacts = await FlutterContacts.getContacts(withProperties: true);
          final int totalLocalContacts = allContacts.length;

          for (int i = 0; i < totalLocalContacts; i++) {
            final contact = allContacts[i];
            for (final phone in contact.phones) {
              final String numberTel =
                  phone.number.replaceAll(" ", "").replaceAll("-", "");
              if ((await SQLHelper.getOneNumsTelUser(numberTel)).isEmpty) {
                await insertNumTelUserIntoDataBase(numberTel);
              }
            }
            setState(() {
              _progress = 0.3 + (i + 1) / totalLocalContacts * 0.3;
              textChargementEvolution = (langUserPhone == "fr")
                  ? "Analyse des contacts locaux... (${i + 1} / $totalLocalContacts)"
                  : "Analyzing local contacts... (${i + 1} / $totalLocalContacts)";
            });
          }

          // ===== ÉTAPE 3 : ENREGISTREMENT ET MISE À JOUR DS (60% -> 100%) =====
          setState(() {
            textChargementEvolution = (langUserPhone == "fr")
                ? "Synchronisation des contacts DS..."
                : "Synchronizing DS contacts...";
          });

          final List<Contact> freshDSContacts = allContacts
              .where((c) => c.name.first.endsWith("#DS"))
              .toList();

          for (int i = 0; i < totalDSContacts; i++) {
            final contactData = jsonData[i];
            final String tel = (contactData["tel"] as String);
            final String telSansPlus = tel.replaceAll("+", "");
            final String nom = (contactData["nom"] ?? "").toString().trim();
            final String pseudo = contactData["pseudo"] as String;
            final List<String> nameParts =
                [nom, pseudo, telSansPlus].where((s) => s.isNotEmpty).toList();
            final String expectedName = "${nameParts.join(" - ")} #DS";

            final List<Phone> phonesList = [Phone(tel)];
            if (tel.startsWith("+229") && !tel.startsWith("+22901")) {
              final String afterCode = tel.substring(4);
              phonesList.add(Phone("+22901$afterCode"));
            }

            if ((await SQLHelper.getOneNumsTelUser(tel)).isEmpty) {
              // Contact absent → créer
              final newContact = Contact()
                ..name.first = expectedName
                ..phones = phonesList;
              await newContact.insert();
              await insertNumTelUserIntoDataBase(tel);
            } else {
              // Contact présent → mettre à jour le nom si nécessaire
              final Contact? existing =
                  _findDSContactByTel(freshDSContacts, tel);
              if (existing != null && existing.name.first != expectedName) {
                existing.name.first = expectedName;
                existing.phones = phonesList;
                await existing.update();
              }
            }

            setState(() {
              _progress = 0.6 + (i + 1) / totalDSContacts * 0.4;
              textChargementEvolution = (langUserPhone == "fr")
                  ? "Synchronisation DS... (${i + 1} / $totalDSContacts)"
                  : "DS sync... (${i + 1} / $totalDSContacts)";
            });
          }

          // --- FIN ---
          setState(() {
            _enCour = false;
            _progress = 1.0;
            textChargementEvolution = (langUserPhone == "fr")
                ? "Synchronisation terminée avec succès !"
                : "Synchronization completed successfully!";
          });
        } else {
          setState(() {
            _enCour = false;
            textChargementEvolution = (langUserPhone == "fr")
                ? "Vous n'avez aucun contact DS, la synchronisation n'est pas nécessaire."
                : "You don't have any DS contacts, synchronization is not needed.";
          });
        }
      } else {
        throw Exception("Erreur de l'API: ${response.statusCode}");
      }
    } catch (e) {
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
            SizedBox(height: 16),

            // --- OPTION ÉTENDUE ---
            FadeInUp(
              from: 20,
              duration: Duration(milliseconds: 500),
              delay: Duration(milliseconds: 500),
              child: Container(
                padding: EdgeInsets.symmetric(horizontal: 16, vertical: 12),
                decoration: BoxDecoration(
                  color: _etendreAuxNonDS
                      ? primaryColor.withOpacity(0.07)
                      : Colors.grey.withOpacity(0.07),
                  borderRadius: BorderRadius.circular(12),
                  border: Border.all(
                    color: _etendreAuxNonDS
                        ? primaryColor.withOpacity(0.3)
                        : Colors.grey.withOpacity(0.2),
                  ),
                ),
                child: Row(
                  children: [
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            (langUserPhone == "fr")
                                ? "Étendre aux contacts non-DS"
                                : "Extend to non-DS contacts",
                            style: GoogleFonts.poppins(
                              fontWeight: FontWeight.w600,
                              fontSize: 14,
                              color: _etendreAuxNonDS
                                  ? primaryColor
                                  : Colors.grey[700],
                            ),
                          ),
                          SizedBox(height: 3),
                          Text(
                            (langUserPhone == "fr")
                                ? "Fusionner aussi les doublons dans vos contacts personnels."
                                : "Also merge duplicates in your personal contacts.",
                            style: GoogleFonts.poppins(
                              fontSize: 12,
                              color: Colors.grey[500],
                            ),
                          ),
                        ],
                      ),
                    ),
                    Switch(
                      value: _etendreAuxNonDS,
                      onChanged: _enCour
                          ? null
                          : (val) => setState(() => _etendreAuxNonDS = val),
                      activeColor: primaryColor,
                    ),
                  ],
                ),
              ),
            ),
            SizedBox(height: 20),

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
                          await synchroAvanceFunction(_etendreAuxNonDS);
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
