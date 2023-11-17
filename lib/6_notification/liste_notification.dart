import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:url_launcher/url_launcher.dart';
import 'package:whatsperson/5_autre/support_assistance.dart';
import 'package:whatsperson/components/constant.dart';
import 'package:http/http.dart' as http;
import 'package:whatsperson/components/profile_menu_reseau.dart';

class ContactWP {
  final String id;
  final String pseudo;
  final String nom;
  final bool afficheNom;
  final String mail;
  final String pays;
  final String tel;
  final String apropos;
  final String tiktok;
  final String instagram;
  final String facebook;
  final String youtube;

  ContactWP({
    required this.id,
    required this.pseudo,
    required this.nom,
    required this.afficheNom,
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

class ListeNotification extends StatefulWidget {
  @override
  State<ListeNotification> createState() => _ListeNotificationState();
}

class _ListeNotificationState extends State<ListeNotification> {
  bool _loading = false;
  List<ContactWP> _contacts = [];

  Future<void> fetchContactWPs() async {
    setState(() {
      _loading = true;
      nombreContacts = 0;
    });
    final url =
        Uri.parse('$generalRouteForApi/listContactWP/$uidUser/$langUserPhone');

    final response = await http.get(url);

    if (response.statusCode == 200) {
      final jsonData = jsonDecode(response.body) as List<dynamic>;

      final contacts = jsonData.map((data) {
        return ContactWP(
          id: data['id'],
          pseudo: data['pseudo'],
          nom: data['nom'],
          afficheNom: data['afficheNom'],
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
      });
    } else {
      // ignore: use_build_context_synchronously
      showDialog(
        context: context,
        builder: (BuildContext context) {
          return AlertDialog(
            title: const Text('Erreur'),
            content: (langUserPhone == "fr")
                ? Text(
                    "Échec de récupération des contacts. Code d'erreur: ${response.statusCode}")
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
    // fetchContactWPs();
  }

  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        elevation: 0,
        backgroundColor: primaryColor,
        title: Text(
          "Notifications",
          style: GoogleFonts.poppins(fontWeight: FontWeight.w600),
        ),
        actions: [
          PopupMenuButton<int>(
            itemBuilder: (context) => [
              PopupMenuItem(
                value: 1,
                onTap: () {
                  _loading ? '' : fetchContactWPs();
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
              if (value == 4) {
                Navigator.push(
                  context,
                  MaterialPageRoute(
                    builder: (context) => SupportPage(),
                  ),
                );
              }
            },
          ),
        ],
      ),
      body: _loading
          ? const Center(
              child: CircularProgressIndicator(),
            )
          : ListView.builder(
              itemCount: _contacts.length,
              itemBuilder: (BuildContext context, int index) {
                final contact = _contacts[index];

                return Container(
                  margin: const EdgeInsets.only(
                      left: 10, top: 10, right: 10, bottom: 0),
                  child: Row(
                    children: [
                      Container(
                        height: 60,
                        width: 60,
                        decoration: BoxDecoration(
                          gradient: const LinearGradient(
                            begin: Alignment.topCenter,
                            end: Alignment.bottomCenter,
                            colors: [
                              Colors.white,
                              Colors.indigoAccent,
                              Colors.indigo,
                            ],
                          ),
                          borderRadius: BorderRadius.circular(10),
                        ),
                        child: Column(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: [
                            CircleAvatar(
                              backgroundImage:
                                  AssetImage("images-pays/${contact.pays}.png"),
                            ),
                            const SizedBox(height: 3),
                            Text(
                              contact.pays,
                              style: const TextStyle(
                                color: Colors.white,
                                fontSize: 8,
                              ),
                            ),
                          ],
                        ),
                      ),
                      const SizedBox(width: 5),
                      Expanded(
                        child: Container(
                          // width: 80,
                          height: 60,
                          decoration: BoxDecoration(
                            gradient: const LinearGradient(
                              begin: Alignment.topCenter,
                              end: Alignment.bottomRight,
                              colors: [
                                Colors.indigo,
                                Colors.indigoAccent,
                                Colors.white,
                                Colors.white,
                                Colors.white,
                              ],
                            ),
                            borderRadius: BorderRadius.circular(10),
                          ),
                          padding: const EdgeInsets.fromLTRB(15, 0, 15, 0),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              const SizedBox(height: 5),
                              Row(
                                mainAxisAlignment:
                                    MainAxisAlignment.spaceBetween,
                                children: [
                                  Text(
                                    contact.pseudo,
                                    style: const TextStyle(
                                      fontSize: 14,
                                      fontWeight: FontWeight.bold,
                                    ),
                                  ),
                                  ElevatedButton.icon(
                                    style: ElevatedButton.styleFrom(
                                      backgroundColor: primaryColor,
                                    ),
                                    label: Text(
                                      (langUserPhone == "fr")
                                          ? "Détails"
                                          : "Details",
                                      style: const TextStyle(
                                        fontSize: 13,
                                        fontWeight: FontWeight.bold,
                                      ),
                                    ),
                                    icon: const Icon(
                                      Icons.info,
                                      size: 13,
                                    ),
                                    onPressed: () {
                                      Navigator.push(
                                        context,
                                        MaterialPageRoute(
                                          builder: (context) =>
                                              ContactDetailPage(
                                            contact: contact,
                                          ),
                                        ),
                                      );
                                    },
                                  ),
                                ],
                              ),
                            ],
                          ),
                        ),
                      ),
                    ],
                  ),
                );
              },
            ),
    );
  }
}

class ContactDetailPage extends StatelessWidget {
  final ContactWP contact;

  ContactDetailPage({required this.contact});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
          (langUserPhone == "fr") ? "Contact Détails" : "Contact Details",
          style: GoogleFonts.poppins(fontWeight: FontWeight.w600),
        ),
        backgroundColor: primaryColor,
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(
              (langUserPhone == "fr")
                  ? "Pseudo : ${contact.pseudo}"
                  : "Pseudo : ${contact.pseudo}",
              style: GoogleFonts.poppins(
                fontSize: 20,
                fontWeight: FontWeight.w600,
              ),
              textAlign: TextAlign.center,
            ),
            const SizedBox(height: 10),
            if (contact.afficheNom == true)
              Text(
                (langUserPhone == "fr")
                    ? "Nom : ${contact.nom}"
                    : "Name : ${contact.nom}",
                style: GoogleFonts.poppins(
                  fontSize: 20,
                  fontWeight: FontWeight.w600,
                ),
              ),
            if (contact.afficheNom == true) const SizedBox(height: 10),
            Text(
              (langUserPhone == "fr")
                  ? "Pays : ${contact.pays}"
                  : "Country : ${contact.pays}",
              style: GoogleFonts.poppins(
                fontSize: 20,
                fontWeight: FontWeight.w600,
              ),
            ),
            const SizedBox(height: 10),
            ProfileMenuReseau(
              text: "E-mail",
              press: () async {
                final Uri _url = Uri.parse("mailto:${contact.mail}");
                if (!await launchUrl(_url,
                    mode: LaunchMode.externalApplication)) {
                  throw 'Could not launch $_url';
                }
              },
            ),
            const SizedBox(height: 5),
            ProfileMenuReseau(
              text: "WhatsApp",
              press: () async {
                final Uri _url = Uri.parse("https://wa.me/${contact.tel}");
                if (!await launchUrl(_url,
                    mode: LaunchMode.externalApplication)) {
                  throw 'Could not launch $_url';
                }
              },
            ),
            const SizedBox(height: 5),
            if (contact.tiktok != "")
              ProfileMenuReseau(
                text: "TikTok",
                press: () async {
                  final Uri _url = Uri.parse(contact.tiktok);
                  if (!await launchUrl(_url,
                      mode: LaunchMode.externalApplication)) {
                    throw 'Could not launch $_url';
                  }
                },
              ),
            if (contact.tiktok != "") const SizedBox(height: 5),
            if (contact.instagram != "")
              ProfileMenuReseau(
                text: "Instagram",
                press: () async {
                  final Uri _url = Uri.parse(contact.instagram);
                  if (!await launchUrl(_url,
                      mode: LaunchMode.externalApplication)) {
                    throw 'Could not launch $_url';
                  }
                },
              ),
            if (contact.instagram != "") const SizedBox(height: 5),
            if (contact.facebook != "")
              ProfileMenuReseau(
                text: "Facebook",
                press: () async {
                  final Uri _url = Uri.parse(contact.facebook);
                  if (!await launchUrl(_url,
                      mode: LaunchMode.externalApplication)) {
                    throw 'Could not launch $_url';
                  }
                },
              ),
            if (contact.facebook != "") const SizedBox(height: 5),
            if (contact.youtube != "")
              ProfileMenuReseau(
                text: "Youtube",
                press: () async {
                  final Uri _url = Uri.parse(contact.youtube);
                  if (!await launchUrl(_url,
                      mode: LaunchMode.externalApplication)) {
                    throw 'Could not launch $_url';
                  }
                },
              ),
            if (contact.youtube != "") const SizedBox(height: 5),
            const SizedBox(height: 20),
            if (contact.apropos != "")
              Text(
                (langUserPhone == "fr") ? "À propos :" : "About :",
                style: GoogleFonts.poppins(
                  fontSize: 20,
                  fontWeight: FontWeight.w600,
                ),
              ),
            const SizedBox(height: 5),
            Text(
              contact.apropos,
              style: GoogleFonts.poppins(
                fontSize: 14,
                fontWeight: FontWeight.w600,
              ),
            ),
            const SizedBox(height: 10),
          ],
        ),
      ),
    );
  }
}
