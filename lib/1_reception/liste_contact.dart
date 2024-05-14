// ignore_for_file: unnecessary_null_comparison, prefer_const_constructors

import 'dart:convert';
import 'package:dressur/5_autre/autre_profil.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/1_reception/synchronisation_avance.dart';
import 'package:dressur/5_autre/support_assistance.dart';
import 'package:dressur/components/constant.dart';
import 'package:http/http.dart' as http;

class ContactDS {
  final String id;
  final String pseudo;
  final String nom;
  final String mail;
  final String pays;
  final String tel;
  final String apropos;
  final String tiktok;
  final String instagram;
  final String facebook;
  final String youtube;

  ContactDS({
    required this.id,
    required this.pseudo,
    required this.nom,
    required this.mail,
    required this.pays,
    required this.tel,
    required this.apropos,
    required this.tiktok,
    required this.instagram,
    required this.facebook,
    required this.youtube,
  });
}

class ContactPage extends StatefulWidget {
  @override
  State<ContactPage> createState() => _ContactPageState();
}

class _ContactPageState extends State<ContactPage> {
  static const espaceEntreLesOptionsContact = 10.0;
  bool _loading = false;
  List<ContactDS> _contacts = [];
  List<ContactDS> _filteredContacts = [];
  String _searchText = '';

  Future<void> fetchContactDSs() async {
    setState(() {
      _loading = true;
      nombreContacts = 0;
    });
    final url =
        Uri.parse('$generalRouteForApi/listContactDS/$uidUser/$langUserPhone');

    final response = await http.get(url);

    if (response.statusCode == 200) {
      final jsonData = jsonDecode(response.body) as List<dynamic>;

      final contacts = jsonData.map((data) {
        return ContactDS(
          id: data['id'],
          pseudo: data['pseudo'],
          nom: data['nom'],
          mail: data['mail'],
          pays: data['pays'],
          tel: data['tel'],
          apropos: data['apropos'],
          tiktok: data['tiktok'],
          instagram: data['instagram'],
          facebook: data['facebook'],
          youtube: data['youtube'],
        );
      }).toList();

      setState(() {
        _loading = false;
        _contacts = contacts;
        nombreContacts = contacts.length;
        _filteredContacts =
            List.from(_contacts); // Initialiser avec tous les contacts
      });
    } else {
      showDialog(
        context: context,
        builder: (BuildContext context) {
          return AlertDialog(
            title: const Text('Erreur'),
            content: (langUserPhone == "fr")
                ? Text(
                    'Échec de récupération des contacts. Code d\'erreur: ${response.statusCode}')
                : Text(
                    'Failed to retrieve contacts. Error code: ${response.statusCode}'),
            actions: <Widget>[
              TextButton(
                child: const Text('OK'),
                onPressed: () {
                  Navigator.of(context).pop();
                },
              ),
            ],
          );
        },
      );
      setState(() {
        _loading = false;
      });
    }
  }

  @override
  void initState() {
    super.initState();
    fetchContactDSs();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        elevation: 0,
        backgroundColor: primaryColor,
        title: Text(
          "Contacts ( $nombreContacts )",
          style: GoogleFonts.poppins(
            color: Colors.white,
            fontWeight: FontWeight.w400,
          ),
        ),
        leading: IconButton(
          onPressed: () {
            Navigator.pop(context);
          },
          icon: const Icon(
            Icons.arrow_back,
            size: 30,
            color: Colors.white,
          ),
        ),
        actions: [
          PopupMenuButton<int>(
            itemBuilder: (context) => [
              PopupMenuItem(
                value: 1,
                onTap: () {
                  _loading ? '' : fetchContactDSs();
                },
                child: Row(
                  children: [
                    Text(
                      (langUserPhone == "fr") ? "Actualiser" : "Refresh",
                      style: GoogleFonts.poppins(
                        color: Colors.white,
                        fontWeight: FontWeight.w600,
                      ),
                    ),
                  ],
                ),
              ),
              PopupMenuItem(
                value: 3,
                child: Row(
                  children: [
                    Text(
                      (langUserPhone == "fr")
                          ? "Synchronisation avancé"
                          : "Advanced synchronization",
                      style: GoogleFonts.poppins(
                        color: Colors.white,
                        fontWeight: FontWeight.w600,
                      ),
                    ),
                  ],
                ),
              ),
              PopupMenuItem(
                value: 4,
                child: Row(
                  children: [
                    Text(
                      (langUserPhone == "fr") ? "Aide" : "Help",
                      style: GoogleFonts.poppins(
                        color: Colors.white,
                        fontWeight: FontWeight.w600,
                      ),
                    ),
                  ],
                ),
              ),
            ],
            offset: const Offset(0, 60),
            color: primaryColor,
            icon: const Icon(
              Icons.menu,
              color: Colors.white,
            ),
            elevation: 2,
            onSelected: (value) {
              if (value == 3) {
                Navigator.push(
                  context,
                  MaterialPageRoute(
                      builder: (context) => const SynchroAvance()),
                );
              }
              if (value == 4) {
                Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => SupportPage()),
                );
              }
            },
          ),
        ],
      ),
      body: Column(
        children: [
          Padding(
            padding: const EdgeInsets.all(8.0),
            child: TextField(
              onChanged: (value) {
                setState(() {
                  _searchText = value;
                  _filterContacts();
                });
              },
              decoration: InputDecoration(
                labelText: (langUserPhone == "fr")
                    ? "Rechercher ..."
                    : "To research ...",
                prefixIcon: const Icon(Icons.search),
                border: const OutlineInputBorder(),
              ),
            ),
          ),
          _loading
              ? const Center(
                  child: CircularProgressIndicator(),
                )
              : _filteredContacts.isEmpty
                  ? Center(
                      child: Text(
                        (langUserPhone == "fr")
                            ? "Aucun contact trouvé."
                            : "No contacts found.",
                        style: const TextStyle(fontSize: 16),
                      ),
                    )
                  : Expanded(
                      child: ListView.builder(
                        itemCount: _filteredContacts.length,
                        itemBuilder: (BuildContext context, int index) {
                          final contact = _filteredContacts[index];

                          return ListTile(
                            title: Text(
                              contact.nom,
                              style: const TextStyle(
                                fontSize: 16,
                                fontWeight: FontWeight.bold,
                              ),
                              maxLines: 1,
                              overflow: TextOverflow.ellipsis,
                            ),
                            subtitle: Row(
                              children: [
                                GestureDetector(
                                  onTap: () {
                                    launchPhoneCall(contact.tel);
                                  },
                                  child: Container(
                                    padding: EdgeInsets.fromLTRB(5, 5, 5, 5),
                                    decoration: BoxDecoration(
                                      color: primaryColor,
                                      shape: BoxShape.circle,
                                    ),
                                    child: Icon(
                                      Icons.phone,
                                      size: 20,
                                      color: Colors.white,
                                    ),
                                  ),
                                ),
                                const SizedBox(
                                    width: espaceEntreLesOptionsContact),
                                GestureDetector(
                                  onTap: () {
                                    launchSMS(contact.tel);
                                  },
                                  child: Container(
                                    padding: EdgeInsets.fromLTRB(5, 5, 5, 5),
                                    decoration: BoxDecoration(
                                      color: primaryColor,
                                      shape: BoxShape.circle,
                                    ),
                                    child: Icon(
                                      Icons.message,
                                      size: 20,
                                      color: Colors.white,
                                    ),
                                  ),
                                ),
                                const SizedBox(
                                    width: espaceEntreLesOptionsContact),
                                GestureDetector(
                                  onTap: () {
                                    launchEmail(contact.mail);
                                  },
                                  child: Container(
                                    padding: EdgeInsets.fromLTRB(5, 5, 5, 5),
                                    decoration: BoxDecoration(
                                      color: primaryColor,
                                      shape: BoxShape.circle,
                                    ),
                                    child: Icon(
                                      Icons.mail,
                                      size: 20,
                                      color: Colors.white,
                                    ),
                                  ),
                                ),
                                const SizedBox(
                                    width: espaceEntreLesOptionsContact),
                                GestureDetector(
                                  onTap: () {
                                    setState(() {
                                      uidAutreUser = contact.id;
                                      addUserOnAutreProfilPage = "non";
                                    });
                                    Navigator.of(context).push(
                                      MaterialPageRoute(
                                        builder: (context) => AutreProfilPage(),
                                      ),
                                    );
                                  },
                                  child: Container(
                                    decoration: BoxDecoration(
                                      shape: BoxShape.circle,
                                      color: primaryColor,
                                    ),
                                    padding: EdgeInsets.fromLTRB(5, 5, 5, 5),
                                    child: Icon(
                                      Icons.info,
                                      size: 20,
                                      color: Colors.white,
                                    ),
                                  ),
                                ),
                              ],
                            ),
                            leading: SizedBox(
                              height: 60,
                              width: 60,
                              child: Column(
                                mainAxisAlignment: MainAxisAlignment.center,
                                children: [
                                  CircleAvatar(
                                    backgroundImage: AssetImage(
                                        "images-pays/${contact.pays}.png"),
                                    backgroundColor: Colors.transparent,
                                    child: AssetImage(
                                                "images-pays/${contact.pays}.png") ==
                                            null
                                        ? Image.asset(
                                            "images-pays/no_pays.png",
                                          )
                                        : null,
                                  ),
                                  const SizedBox(height: 4),
                                  Text(
                                    contact.pays,
                                    style: const TextStyle(
                                      fontSize: 10,
                                    ),
                                  ),
                                ],
                              ),
                            ),
                          );
                        },
                      ),
                    ),
        ],
      ),
    );
  }

  void _filterContacts() {
    if (_searchText.isEmpty) {
      setState(() {
        _filteredContacts = List.from(_contacts);
      });
    } else {
      final filteredList = _contacts
          .where((contact) =>
              contact.pseudo.toLowerCase().contains(_searchText.toLowerCase()))
          .toList();

      setState(() {
        _filteredContacts = filteredList;
      });
    }
  }
}
