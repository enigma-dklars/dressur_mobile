// ignore_for_file: use_build_context_synchronously

import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/5_autre/support_assistance.dart';
import 'package:dressur/components/constant.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;

class Boost {
  final String id;
  final String modeBoostFormule;
  final String statutFormule;
  final String nomFormule;
  final String prixFormule;
  final String dateDebutFormule;

  Boost({
    required this.id,
    required this.modeBoostFormule,
    required this.statutFormule,
    required this.nomFormule,
    required this.prixFormule,
    required this.dateDebutFormule,
  });
}

class ListeBoostContactPage extends StatefulWidget {
  @override
  State<ListeBoostContactPage> createState() => _ListeBoostContactPageState();
}

class _ListeBoostContactPageState extends State<ListeBoostContactPage> {
  bool _loading = false;
  List<Boost> _boosts = [];

  Future<void> fetchBoosts() async {
    setState(() {
      _loading = true;
    });
    final url =
        Uri.parse('$generalRouteForApi/listBoost/$uidUser/$langUserPhone');

    final response = await http.get(url);

    if (response.statusCode == 200) {
      final jsonData = convert.jsonDecode(response.body) as List<dynamic>;

      final boosts = jsonData.map((data) {
        return Boost(
          id: data['id'],
          modeBoostFormule: data['modeBoostFormule'],
          statutFormule: data['statutFormule'],
          nomFormule: data['nomFormule'],
          prixFormule: data['prixFormule'],
          dateDebutFormule: data['dateDebutFormule'],
        );
      }).toList();

      setState(() {
        _boosts = boosts;
        _loading = false;
      });
    } else {
      showDialog(
        context: context,
        builder: (BuildContext context) {
          return AlertDialog(
            title: const Text('Erreur'),
            content: (langUserPhone == "fr")
                ? Text(
                    'Échec de récupération des boosts. Code d\'erreur: ${response.statusCode}')
                : Text(
                    'Failed to retrieve boosts. Error code: ${response.statusCode}'),
            actions: <Widget>[
              TextButton(
                child: Text('OK'),
                onPressed: () {
                  Navigator.of(context).pop();
                },
              ),
            ],
          );
        },
      );
    }
  }

  @override
  void initState() {
    super.initState();
    fetchBoosts(); // Loading the diary when the app starts
  }

  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        elevation: 0,
        backgroundColor: primaryColor,
        title: Text(
          (langUserPhone == "fr")
              ? "Liste Boost Contact"
              : "Boost List Contact",
          style: GoogleFonts.poppins(
            fontWeight: FontWeight.w400,
            color: Colors.white,
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
          PopupMenuButton<dynamic>(
            itemBuilder: (context) => [
              PopupMenuItem(
                value: 1,
                onTap: () {
                  fetchBoosts();
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
                value: 2,
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
              if (value == 2) {
                Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => SupportPage()),
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
          : _boosts.isEmpty
                  ? Center(
                      child: Text(
                        (langUserPhone == "fr")
                            ? "Aucun boost contact trouvé."
                            : "No contact boost found.",
                        style: const TextStyle(fontSize: 16),
                      ),
                    )
                  : Expanded(
                      child: ListView.builder(
              itemCount: _boosts.length,
              itemBuilder: (BuildContext context, int index) {
                final boost = _boosts[index];

                return Card(
                  margin: const EdgeInsets.only(
                      left: 10, top: 10, right: 10, bottom: 0),
                  child: Container(
                    width: MediaQuery.of(context).size.width * 0.95,
                    decoration: BoxDecoration(
                      gradient: const LinearGradient(
                        begin: Alignment.topCenter,
                        end: Alignment.bottomCenter,
                        colors: [
                          secondaryColor,
                          primaryColor,
                        ],
                      ),
                      borderRadius: BorderRadius.circular(5),
                    ),
                    padding: const EdgeInsets.fromLTRB(15, 10, 15, 10),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.stretch,
                      children: [
                        Row(
                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                          children: [
                            Column(
                              children: [
                                Text(
                                  boost.modeBoostFormule,
                                  style: GoogleFonts.poppins(
                                    fontSize: 14,
                                    color: Colors.white,
                                    fontWeight: FontWeight.w800,
                                  ),
                                  textAlign: TextAlign.end,
                                ),
                              ],
                            ),
                            Column(
                              children: [
                                Text(
                                  boost.statutFormule,
                                  style: GoogleFonts.poppins(
                                    fontSize: 14,
                                    color: Colors.white,
                                  ),
                                  textAlign: TextAlign.end,
                                ),
                              ],
                            )
                          ],
                        ),
                        const SizedBox(height: 5),
                        Text(
                          "${boost.nomFormule} (${boost.prixFormule})",
                          style: GoogleFonts.poppins(
                            fontWeight: FontWeight.w600,
                            fontSize: 18,
                            color: Colors.white,
                          ),
                        ),
                        const SizedBox(height: 5),
                        Text(
                          boost.dateDebutFormule,
                          style: const TextStyle(
                            fontSize: 12,
                            color: Colors.white,
                          ),
                        ),
                      ],
                    ),
                  ),
                );
              },
            ),
            ),
    );
  }
}
