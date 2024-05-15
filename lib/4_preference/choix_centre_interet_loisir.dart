// ignore_for_file: use_build_context_synchronously, unnecessary_const

import 'dart:async';
import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:http/http.dart' as http;
import 'package:dressur/components/constant.dart';

class CentreInteretLoisir {
  final String name;
  final String label;
  final String descp;
  final bool isSelected;

  CentreInteretLoisir({
    required this.name,
    required this.label,
    required this.descp,
    required this.isSelected,
  });
}

class ChoixDesCentreInteretLoisir extends StatefulWidget {
  @override
  _ChoixDesCentreInteretLoisirState createState() =>
      _ChoixDesCentreInteretLoisirState();
}

class _ChoixDesCentreInteretLoisirState
    extends State<ChoixDesCentreInteretLoisir> {
  List<CentreInteretLoisir> _centreInteretLoisirs = [];
  String recherche = "";
  var centreInteretLoisirJson;

  Future<void> fetchCentreInteretLoisirChoisies() async {
    final response = await http.get(Uri.parse(
        '$generalRouteForApi/listCentreInteretLoisirChoisies/$uidUser/$langUserPhone'));

    if (response.statusCode == 200) {
      setState(() {
        centreInteretLoisirJson = response.body;
      });
      final jsonData = jsonDecode(response.body) as List<dynamic>;

      final centreInteretLoisirs = centreInteretLoisir.map((entry) {
        return CentreInteretLoisir(
          name: entry['value'],
          label: (langUserPhone == 'fr') ? entry['labelFr'] : entry['labelEn'],
          descp: (langUserPhone == 'fr') ? entry['descpFr'] : entry['descpEn'],
          isSelected: jsonData.contains(entry['value']) ? true : false,
        );
      }).toList();

      // Tri des pays avec les pays sélectionnés en premier
      centreInteretLoisirs.sort((a, b) {
        if (a.isSelected && !b.isSelected) {
          return -1; // a vient avant b
        } else if (!a.isSelected && b.isSelected) {
          return 1; // b vient avant a
        } else {
          return 0; // Pas de changement d'ordre
        }
      });

      setState(() {
        _centreInteretLoisirs = centreInteretLoisirs;
        WidgetsBinding.instance.addPostFrameCallback((_) {
          searchCountries('');
        });
      });
    } else {
      showDialog(
        context: context,
        builder: (BuildContext context) {
          return AlertDialog(
            title: const Text('Erreur'),
            content: const Text('Erreur'),
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
  }

  void updateCentreInteretLoisirSelection(
      CentreInteretLoisir country, bool isSelected) async {
    setState(() {
      preferenceCentreInteretLoisirText = "";
    });

    List<dynamic> json = [];
    final jsonData = jsonDecode(centreInteretLoisirJson) as List<dynamic>;
    final centreInteretLoisirs = centreInteretLoisir.map((entry) {
      var dataIsselected = jsonData.contains(entry['value']) ? true : false;
      if (entry['value'] == country.name) {
        if (isSelected == true) {
          json.add(entry['value']);
        }
        return CentreInteretLoisir(
          name: entry['value'],
          label: (langUserPhone == 'fr') ? entry['labelFr'] : entry['labelEn'],
          descp: (langUserPhone == 'fr') ? entry['descpFr'] : entry['descpEn'],
          isSelected: isSelected,
        );
      }
      if (dataIsselected == true) {
        json.add(entry['value']);
      }
      return CentreInteretLoisir(
        name: entry['value'],
        label: (langUserPhone == 'fr') ? entry['labelFr'] : entry['labelEn'],
        descp: (langUserPhone == 'fr') ? entry['descpFr'] : entry['descpEn'],
        isSelected: dataIsselected,
      );
    }).toList();

    // Tri des pays avec les pays sélectionnés en premier
    centreInteretLoisirs.sort((a, b) {
      if (a.isSelected && !b.isSelected) {
        return -1; // a vient avant b
      } else if (!a.isSelected && b.isSelected) {
        return 1; // b vient avant a
      } else {
        return 0; // Pas de changement d'ordre
      }
    });

    setState(() {
      _centreInteretLoisirs = centreInteretLoisirs;
      centreInteretLoisirJson = jsonEncode(json);
      preferenceCentreInteretLoisirToText(centreInteretLoisirJson);
      searchCountries(recherche);
    });

    final response = await http.get(Uri.parse(
        '$generalRouteForApi/updateCentreInteretLoisirChoisies/$uidUser/$langUserPhone/$centreInteretLoisirJson'));

    if (response.statusCode == 200) {
      // Mise à jour réussie, mettez à jour l'état du pays dans la liste
    }
  }

  List<CentreInteretLoisir> _searchResults = [];

  void searchCountries(String query) {
    setState(() {
      recherche = query;
      if (query.isEmpty) {
        _searchResults = List.from(_centreInteretLoisirs);
      } else {
        final lowercaseQuery = query.toLowerCase();
        _searchResults = _centreInteretLoisirs.where((country) {
          final lowercaseName = country.descp.toLowerCase();
          final lowercasePaysName = country.label.toLowerCase();
          return lowercaseName.contains(lowercaseQuery) ||
              lowercasePaysName.contains(lowercaseQuery);
        }).toList();
      }
    });
  }

  @override
  void initState() {
    super.initState();
    fetchCentreInteretLoisirChoisies();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: primaryColor,
        title: Text(
          (langUserPhone == "fr")
              ? "Choix des centres d'intérêt, loisirs, etc."
              : 'Choice of interests, hobbies, etc.',
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
      ),
      body: Column(
        children: [
          Padding(
            padding: const EdgeInsets.all(8.0),
            child: TextField(
              onChanged: (value) {
                searchCountries(value);
              },
              decoration: InputDecoration(
                labelText: (langUserPhone == "fr")
                    ? "Rechercher un centre d'intérêt, loisirs, etc."
                    : 'Search for a center of interest, hobbies, etc.',
                prefixIcon: const Icon(Icons.search),
                border: const OutlineInputBorder(),
              ),
            ),
          ),
          _centreInteretLoisirs.isEmpty
              ? const Center(
                  child: CircularProgressIndicator(),
                )
              : Expanded(
                  child: ListView.builder(
                    itemCount: _searchResults.length,
                    itemBuilder: (BuildContext context, int index) {
                      final country = _searchResults[index];
                      return ListTile(
                        title: Text(
                          country.label,
                          style: GoogleFonts.poppins(
                            fontSize: 15,
                            fontWeight: FontWeight.w600,
                          ),
                        ),
                        subtitle: Text(country.descp),
                        leading: Switch(
                          trackOutlineColor: MaterialStateColor.resolveWith(
                              (states) => primaryColor),
                          activeColor: Colors.green,
                          activeTrackColor: primaryColor,
                          inactiveThumbColor: Colors.white,
                          inactiveTrackColor: primaryColor,
                          value: country.isSelected,
                          onChanged: (bool? isSelected) {
                            if (isSelected != null) {
                              updateCentreInteretLoisirSelection(
                                  country, isSelected);
                            } else {
                              // Null
                            }
                          },
                        ),
                      );
                    },
                  ),
                ),
        ],
      ),
    );
  }
}
