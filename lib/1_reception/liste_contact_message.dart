// ignore_for_file: unnecessary_null_comparison, prefer_const_constructors

import 'dart:convert';
import 'package:dressur/1_reception/chat.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:google_fonts/google_fonts.dart';
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

class ContactForMessagePage extends StatefulWidget {
  @override
  State<ContactForMessagePage> createState() => _ContactForMessagePageState();
}

class _ContactForMessagePageState extends State<ContactForMessagePage> {
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
            Icons.arrow_back_ios,
            color: Colors.white,
          ),
        ),
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
                            onTap: () {
                              setState(() {
                                uidAutreUser = contact.id;
                                userChatInfo = [
                                  contact.id,
                                  contact.pseudo,
                                  contact.nom
                                ];
                              });
                              Navigator.pop(context);
                              Navigator.push(
                                context,
                                MaterialPageRoute(
                                    builder: (context) => ChatPage()),
                              );
                            },
                            title: Text(
                              contact.nom,
                              style: const TextStyle(
                                fontSize: 16,
                                fontWeight: FontWeight.bold,
                              ),
                              maxLines: 1,
                              overflow: TextOverflow.ellipsis,
                            ),
                            subtitle: Text(
                              contact.apropos.isNotEmpty
                                  ? contact.apropos
                                  : (langUserPhone == "fr")
                                      ? "Écris-moi sur Dressur"
                                      : "Write to me on Dressur",
                              style: const TextStyle(
                                fontSize: 12,
                                fontWeight: FontWeight.w300,
                              ),
                              maxLines: 1,
                              overflow: TextOverflow.ellipsis,
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
              contact.pseudo
                  .toLowerCase()
                  .contains(_searchText.toLowerCase()) ||
              contact.nom.toLowerCase().contains(_searchText.toLowerCase()) ||
              contact.mail.toLowerCase().contains(_searchText.toLowerCase()) ||
              contact.pays.toLowerCase().contains(_searchText.toLowerCase()) ||
              contact.tel.toLowerCase().contains(_searchText.toLowerCase()))
          .toList();

      setState(() {
        _filteredContacts = filteredList;
      });
    }
  }
}
