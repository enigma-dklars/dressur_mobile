// ignore_for_file: unnecessary_null_comparison, prefer_const_constructors

import 'dart:convert';
import 'package:dressur/5_autre/autre_profil.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
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
  bool _isLoading = true;
  List<ContactDS> _contacts = [];
  List<ContactDS> _filteredContacts = [];
  final TextEditingController _searchController = TextEditingController();

  Future<void> fetchContactDSs() async {
    setState(() {
      _isLoading = true;
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
        _isLoading = false;
        _contacts = contacts;
        nombreContacts = contacts.length;
        _filteredContacts = List.from(_contacts);
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
        _isLoading = false;
      });
    }
  }

  @override
  void initState() {
    super.initState();
    fetchContactDSs();
    _searchController.addListener(_filterContacts);
  }

  @override
  void dispose() {
    _searchController.dispose();
    super.dispose();
  }

  void _filterContacts() {
    final query = _searchController.text.toLowerCase();
    setState(() {
      _filteredContacts = _contacts.where((contact) {
        return contact.nom.toLowerCase().contains(query) ||
            contact.pseudo.toLowerCase().contains(query) ||
            contact.tel.toLowerCase().contains(query);
      }).toList();
    });
  }

  String _getInitials(ContactDS contact) {
    final String name = (contact.nom.isNotEmpty ? contact.nom : contact.pseudo).trim();
    final List<String> parts = name.split(" ").where((p) => p.isNotEmpty).toList();
    if (parts.isEmpty) return "?";
    if (parts.length == 1) return parts[0][0].toUpperCase();
    return (parts[0][0] + parts[1][0]).toUpperCase();
  }

  String _buildDisplayName(ContactDS contact) {
    final hasNom = contact.nom.isNotEmpty;
    final hasPseudo = contact.pseudo.isNotEmpty;
    if (hasNom && hasPseudo) return "${contact.nom} - ${contact.pseudo}";
    if (hasNom) return contact.nom;
    if (hasPseudo) return contact.pseudo;
    return "—";
  }

  static const List<Color> _avatarColors = [
    Color(0xFF1565C0), // bleu foncé
    Color(0xFF2E7D32), // vert foncé
    Color(0xFF6A1B9A), // violet
    Color(0xFFC62828), // rouge foncé
    Color(0xFF00838F), // cyan foncé
    Color(0xFFE65100), // orange foncé
    Color(0xFF4527A0), // indigo
    Color(0xFF00695C), // teal
    Color(0xFF558B2F), // vert olive
    Color(0xFF283593), // bleu marine
    Color(0xFF880E4F), // rose foncé
    Color(0xFF37474F), // gris ardoise
  ];

  Color _getAvatarColor(ContactDS contact) {
    final String key = (contact.nom.isNotEmpty ? contact.nom : contact.pseudo).toLowerCase();
    int hash = 0;
    for (final int c in key.codeUnits) {
      hash = (hash * 31 + c) & 0x7FFFFFFF;
    }
    return _avatarColors[hash % _avatarColors.length];
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
        actions: [
          PopupMenuButton<int>(
            itemBuilder: (context) => [
              PopupMenuItem(
                value: 1,
                onTap: () {
                  _isLoading ? '' : fetchContactDSs();
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
            icon: const FaIcon(
              FontAwesomeIcons.bars,
              color: Colors.white,
              size: 20,
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
          _buildSearchBar(),
          Expanded(
            child: _isLoading
                ? const Center(child: CircularProgressIndicator(color: primaryColor))
                : _filteredContacts.isEmpty
                    ? _buildEmptyState()
                    : _buildContactList(),
          ),
        ],
      ),
    );
  }

  Widget _buildSearchBar() {
    return Padding(
      padding: const EdgeInsets.fromLTRB(10, 10, 10, 6),
      child: TextField(
        controller: _searchController,
        style: GoogleFonts.poppins(),
        decoration: InputDecoration(
          hintText: (langUserPhone == "fr")
              ? "Rechercher par nom, pseudo..."
              : "Search by name, pseudo...",
          hintStyle: GoogleFonts.poppins(color: Colors.grey[500]),
          prefixIcon: Padding(
            padding: const EdgeInsets.only(left: 20, right: 13, top: 14),
            child: FaIcon(
              FontAwesomeIcons.magnifyingGlass,
              color: Colors.grey[500],
              size: 18,
            ),
          ),
          filled: true,
          fillColor: Theme.of(context).brightness == Brightness.dark
              ? Colors.grey[850]
              : Colors.white,
          border: OutlineInputBorder(
            borderRadius: BorderRadius.circular(15),
            borderSide: BorderSide.none,
          ),
          contentPadding: EdgeInsets.symmetric(vertical: 12),
        ),
      ),
    );
  }

  Widget _buildContactList() {
    return RefreshIndicator(
      onRefresh: fetchContactDSs,
      color: primaryColor,
      child: ListView.builder(
        physics: BouncingScrollPhysics(),
        padding: EdgeInsets.symmetric(horizontal: 10, vertical: 4),
        itemCount: _filteredContacts.length,
        itemBuilder: (context, index) {
          final contact = _filteredContacts[index];
          return _buildContactCard(contact);
        },
      ),
    );
  }

  Widget _buildContactCard(ContactDS contact) {
    return Card(
      elevation: 0.5,
      margin: EdgeInsets.only(bottom: 8),
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(13)),
      child: Padding(
        padding: const EdgeInsets.symmetric(horizontal: 10.0, vertical: 8.0),
        child: Column(
          children: [
            Row(
              children: [
                CircleAvatar(
                  radius: 22,
                  backgroundColor: _getAvatarColor(contact),
                  child: Text(
                    _getInitials(contact),
                    style: GoogleFonts.poppins(
                      fontSize: 16,
                      fontWeight: FontWeight.bold,
                      color: Colors.white,
                    ),
                  ),
                ),
                SizedBox(width: 10),
                Expanded(
                  child: Text(
                    _buildDisplayName(contact),
                    style: GoogleFonts.poppins(
                      fontSize: 14,
                      fontWeight: FontWeight.w600,
                    ),
                    maxLines: 1,
                    overflow: TextOverflow.ellipsis,
                  ),
                ),
                IconButton(
                  padding: EdgeInsets.zero,
                  constraints: BoxConstraints(),
                  icon: FaIcon(FontAwesomeIcons.circleInfo,
                      color: Colors.grey[400], size: 18),
                  onPressed: () {
                    uidAutreUser = contact.id;
                    addUserOnAutreProfilPage = "non";
                    Navigator.of(context).push(MaterialPageRoute(
                        builder: (context) => AutreProfilPage()));
                  },
                ),
              ],
            ),
            Divider(height: 12, thickness: 0.5),
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceAround,
              children: [
                _buildActionButton(
                    icon: FontAwesomeIcons.phone,
                    onTap: () => launchPhoneCall(contact.tel)),
                _buildActionButton(
                    icon: FontAwesomeIcons.solidMessage,
                    onTap: () => launchSMS(contact.tel)),
                _buildActionButton(
                    icon: FontAwesomeIcons.solidEnvelope,
                    onTap: () => launchEmail(contact.mail)),
                _buildActionButton(
                    icon: FontAwesomeIcons.whatsapp,
                    onTap: () => launchWhatsApp(contact.tel)),
              ],
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildActionButton(
      {required IconData icon, required VoidCallback onTap}) {
    return IconButton(
      onPressed: onTap,
      icon: FaIcon(icon, color: primaryColor, size: 18),
      splashRadius: 20,
      padding: EdgeInsets.symmetric(vertical: 4),
      constraints: BoxConstraints(),
    );
  }

  Widget _buildEmptyState() {
    return Center(
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          FaIcon(FontAwesomeIcons.magnifyingGlass,
              size: 60, color: Colors.grey[400]),
          SizedBox(height: 15),
          Text(
            _searchController.text.isEmpty
                ? ((langUserPhone == "fr")
                    ? "Votre liste de contacts est vide"
                    : "Your contact list is empty")
                : ((langUserPhone == "fr")
                    ? "Aucun contact trouvé"
                    : "No contact found"),
            style: GoogleFonts.poppins(fontSize: 16, color: Colors.grey[600]),
          ),
        ],
      ),
    );
  }
}
