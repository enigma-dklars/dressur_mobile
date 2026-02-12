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
import 'package:shimmer/shimmer.dart';

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
          // --- BARRE DE RECHERCHE AMÉLIORÉE ---
          _buildSearchBar(),
          // --- AFFICHAGE CONDITIONNEL ---
          Expanded(
            child: _isLoading
                ? _buildShimmerList()
                : _filteredContacts.isEmpty
                    ? _buildEmptyState()
                    : _buildContactList(),
          ),
        ],
      ),
    );
  }

  // --- WIDGETS DE CONSTRUCTION ---

  Widget _buildSearchBar() {
    return Padding(
      padding: const EdgeInsets.fromLTRB(10, 10, 10, 10),
      child: TextField(
        controller: _searchController,
        style: GoogleFonts.poppins(),
        decoration: InputDecoration(
          hintText: (langUserPhone == "fr")
              ? "Rechercher par nom, pseudo..."
              : "Search by name, pseudo...",
          hintStyle: GoogleFonts.poppins(color: Colors.grey[500]),
          prefixIcon: Icon(Icons.search, color: Colors.grey[500], size: 22),
          filled: true,
          fillColor: Theme.of(context).brightness == Brightness.dark
              ? Colors.grey[850]
              : Colors.white,
          border: OutlineInputBorder(
              borderRadius: BorderRadius.circular(15),
              borderSide: BorderSide.none),
          contentPadding: EdgeInsets.symmetric(vertical: 14),
        ),
      ),
    );
  }

  Widget _buildContactList() {
    return ListView.builder(
      physics: BouncingScrollPhysics(),
      padding: EdgeInsets.symmetric(horizontal: 10, vertical: 5),
      itemCount: _filteredContacts.length,
      itemBuilder: (context, index) {
        final contact = _filteredContacts[index];
        return _buildContactCard(contact);
      },
    );
  }

  Widget _buildContactCard(ContactDS contact) {
    return Card(
      elevation: 0.5,
      margin: EdgeInsets.only(bottom: 12),
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(15)),
      child: Padding(
        padding: const EdgeInsets.all(12.0),
        child: Column(
          children: [
            // --- PARTIE HAUTE : AVATAR, NOM, PSEUDO ---
            Row(
              children: [
                CircleAvatar(
                  radius: 28,
                  backgroundImage:
                      AssetImage("images-pays/${contact.pays}.png"),
                  onBackgroundImageError: (e, s) => print("Erreur image"),
                  child: AssetImage("images-pays/${contact.pays}.png") == null
                      ? Image.asset("images-pays/no_pays.png")
                      : null,
                ),
                SizedBox(width: 12),
                Expanded(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(contact.nom,
                          style: GoogleFonts.poppins(
                              fontSize: 17, fontWeight: FontWeight.bold),
                          maxLines: 1,
                          overflow: TextOverflow.ellipsis),
                      if (contact.pseudo != null && contact.pseudo.isNotEmpty)
                        Text("@${contact.pseudo}",
                            style: GoogleFonts.poppins(
                                fontSize: 14, color: Colors.grey[600])),
                    ],
                  ),
                ),
                IconButton(
                  icon:
                      Icon(Icons.info_outline_rounded, color: Colors.grey[400]),
                  onPressed: () {
                    uidAutreUser = contact.id;
                    addUserOnAutreProfilPage = "non";
                    Navigator.of(context).push(MaterialPageRoute(
                        builder: (context) => AutreProfilPage()));
                  },
                ),
              ],
            ),
            Divider(height: 20, thickness: 0.5),
            // --- PARTIE BASSE : ACTIONS ---
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceAround,
              children: [
                _buildActionButton(
                    icon: Icons.phone_outlined,
                    onTap: () => launchPhoneCall(contact.tel)),
                _buildActionButton(
                    icon: Icons.sms_outlined,
                    onTap: () => launchSMS(contact.tel)),
                _buildActionButton(
                    icon: Icons.mail_outline_rounded,
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
      icon: Icon(icon, color: primaryColor, size: 22),
      splashRadius: 24,
    );
  }

  Widget _buildEmptyState() {
    return Center(
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Icon(Icons.search_off, size: 60, color: Colors.grey[400]),
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

  Widget _buildShimmerList() {
    return Shimmer.fromColors(
      baseColor: Colors.grey[300]!,
      highlightColor: Colors.grey[100]!,
      child: ListView.builder(
        padding: EdgeInsets.symmetric(horizontal: 15, vertical: 5),
        itemCount: 5, // Affiche 5 cartes squelettes
        itemBuilder: (context, index) => Card(
          margin: EdgeInsets.only(bottom: 12),
          shape:
              RoundedRectangleBorder(borderRadius: BorderRadius.circular(15)),
          child: Padding(
            padding: const EdgeInsets.all(12.0),
            child: Column(
              children: [
                Row(
                  children: [
                    CircleAvatar(radius: 28, backgroundColor: Colors.white),
                    SizedBox(width: 12),
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Container(
                              width: 150, height: 18, color: Colors.white),
                          SizedBox(height: 5),
                          Container(
                              width: 100, height: 14, color: Colors.white),
                        ],
                      ),
                    ),
                  ],
                ),
                Divider(height: 20),
                Row(
                  mainAxisAlignment: MainAxisAlignment.spaceAround,
                  children: List.generate(
                      4,
                      (_) => CircleAvatar(
                          radius: 18, backgroundColor: Colors.white)),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
