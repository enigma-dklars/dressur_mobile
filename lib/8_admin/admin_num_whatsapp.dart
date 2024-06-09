import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:http/http.dart' as http;
import 'package:dressur/5_autre/support_assistance.dart';
import 'package:dressur/components/constant.dart';

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

class AdminNumWhatsApp extends StatefulWidget {
  @override
  _AdminNumWhatsAppState createState() => _AdminNumWhatsAppState();
}

class _AdminNumWhatsAppState extends State<AdminNumWhatsApp> {
  bool _loading = false;
  List<ContactDS> _contacts = [];

  Future<void> accepter(String id) async {
    setState(() {
      _loading = true;
    });
    final url = Uri.parse('$generalRouteForApi/adminNumWhatsApp/accepter/$id');

    try {
      final response = await http.get(url);
      if (response.statusCode == 200) {
        setState(() {
          _contacts.removeWhere((contact) => contact.id == id);
          _loading = false;
        });
      } else {
        showErrorDialog(response.statusCode);
      }
    } catch (e) {
      showErrorDialog(-1); // Handle network errors
    }
  }

  void showErrorDialog(int statusCode) {
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          title: Text('Erreur'),
          content: Text(
            (langUserPhone == "fr")
                ? "Échec de récupération des contacts. Code d'erreur: $statusCode"
                : "Failed to retrieve contacts. Error code: $statusCode",
          ),
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
  }

  Future<void> fetchContacts() async {
    setState(() {
      _loading = true;
    });
    try {
      final url = Uri.parse('$generalRouteForApi/adminNumWhatsApp');
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
          _contacts = contacts;
        });
      } else {
        _showErrorDialog(
            'Failed to retrieve contacts. Error code: ${response.statusCode}');
      }
    } catch (e) {
      _showErrorDialog(
          'An error occurred while fetching contacts. Please try again.');
    } finally {
      setState(() {
        _loading = false;
      });
    }
  }

  void _showErrorDialog(String message) {
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          title: const Text('Erreur'),
          content: Text(message),
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
  }

  @override
  void initState() {
    super.initState();
    fetchContacts();
  }

  Widget _buildContactCard(ContactDS Contact) {
    return Card(
      margin: const EdgeInsets.symmetric(horizontal: 10, vertical: 5),
      child: Padding(
        padding: const EdgeInsets.all(15.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(
              Contact.pseudo,
              style: GoogleFonts.poppins(fontSize: 14),
              maxLines: 3,
              overflow: TextOverflow.ellipsis,
            ),
            const SizedBox(height: 5),
            Text(
              Contact.nom,
              style: GoogleFonts.poppins(fontSize: 14),
              maxLines: 3,
              overflow: TextOverflow.ellipsis,
            ),
            const SizedBox(height: 5),
            Text(
              Contact.tel,
              style: GoogleFonts.poppins(fontSize: 14),
              maxLines: 3,
              overflow: TextOverflow.ellipsis,
            ),
            const SizedBox(height: 5),
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                SizedBox(
                  width: MediaQuery.of(context).size.width * 0.42,
                  child: ElevatedButton.icon(
                    style: ElevatedButton.styleFrom(
                      backgroundColor: secondaryColor,
                      padding: const EdgeInsets.symmetric(
                          vertical: 0, horizontal: 15),
                    ),
                    label: Text(
                      "Accepter",
                      style: GoogleFonts.poppins(
                        color: Colors.white,
                        fontWeight: FontWeight.w400,
                        fontSize: 13,
                      ),
                    ),
                    icon: const Icon(
                      Icons.check,
                      color: Colors.white,
                      size: 13,
                    ),
                    onPressed: () {
                      accepter(Contact.id);
                    },
                  ),
                ),
                SizedBox(
                  width: MediaQuery.of(context).size.width * 0.42,
                  child: ElevatedButton.icon(
                    style: ElevatedButton.styleFrom(
                      backgroundColor: Colors.green,
                      padding: const EdgeInsets.symmetric(
                          vertical: 0, horizontal: 15),
                    ),
                    label: Text(
                      "Tester",
                      style: GoogleFonts.poppins(
                        color: Colors.white,
                        fontWeight: FontWeight.w400,
                        fontSize: 13,
                      ),
                    ),
                    icon: const Icon(
                      Icons.ads_click,
                      color: Colors.white,
                      size: 13,
                    ),
                    onPressed: () {
                      launchWhatsApp(Contact.tel);
                    },
                  ),
                ),
              ],
            ),
          ],
        ),
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Colors.red,
        title: Text(
          "Admin Conf. Num. WhatsApp",
          style: GoogleFonts.poppins(
              fontWeight: FontWeight.w400, color: Colors.white),
        ),
        leading: IconButton(
          onPressed: () {
            Navigator.pop(context);
          },
          icon: const Icon(Icons.arrow_back, size: 30, color: Colors.white),
        ),
        actions: [
          PopupMenuButton<dynamic>(
            itemBuilder: (context) => [
              PopupMenuItem(
                value: 1,
                child: Text(
                  (langUserPhone == "fr") ? "Actualiser" : "Refresh",
                  style: GoogleFonts.poppins(
                      color: Colors.white, fontWeight: FontWeight.w600),
                ),
              ),
              PopupMenuItem(
                value: 2,
                child: Text(
                  (langUserPhone == "fr") ? "Aide" : "Help",
                  style: GoogleFonts.poppins(
                      color: Colors.white, fontWeight: FontWeight.w600),
                ),
              ),
            ],
            offset: const Offset(0, 60),
            color: primaryColor,
            icon: const Icon(Icons.menu, color: Colors.white),
            elevation: 2,
            onSelected: (value) {
              if (value == 1) {
                fetchContacts();
              } else if (value == 2) {
                Navigator.push(context,
                    MaterialPageRoute(builder: (context) => SupportPage()));
              }
            },
          ),
        ],
      ),
      body: _loading
          ? const Center(child: CircularProgressIndicator())
          : _contacts.isEmpty
              ? Center(
                  child: Text(
                    (langUserPhone == "fr")
                        ? "Aucune Contact affaire trouvée."
                        : "No deal contacts found.",
                    style: const TextStyle(fontSize: 16),
                  ),
                )
              : ListView.builder(
                  itemCount: _contacts.length,
                  itemBuilder: (BuildContext context, int index) {
                    return _buildContactCard(_contacts[index]);
                  },
                ),
    );
  }
}
