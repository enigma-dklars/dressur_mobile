// ignore_for_file: use_build_context_synchronously, unnecessary_const

import 'dart:async';
import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:http/http.dart' as http;
import 'package:dressur/components/constant.dart';

class Country {
  final String name;
  final String paysName;
  final bool isSelected;

  Country(
      {required this.name, required this.paysName, required this.isSelected});
}

class ChoixDesPays extends StatefulWidget {
  @override
  _ChoixDesPaysState createState() => _ChoixDesPaysState();
}

class _ChoixDesPaysState extends State<ChoixDesPays> {
  List<Country> _countries = [];
  String recherche = "";
  var paysChoisieJson;

  void updatePreferencePaysText(countryName) {
    if (preferencePaysText.isEmpty) {
      setState(() {
        preferencePaysText = countryName;
      });
    } else {
      setState(() {
        preferencePaysText = "$preferencePaysText ,$countryName";
      });
    }
  }

  String getPaysNameWhithIndicatif(countryCode) {
    return countryCodes[countryCode] ?? '';
  }

  Future<void> fetchCountries() async {
    final response = await http.get(Uri.parse(
        '$generalRouteForApi/listPaysChoisies/$uidUser/$langUserPhone'));

    if (response.statusCode == 200) {
      setState(() {
        paysChoisieJson = response.body;
      });
      final jsonData = jsonDecode(response.body) as List<dynamic>;

      final countries = jsonData.map((data) {
        return Country(
          name: data['name'],
          paysName: getPaysNameWhithIndicatif(data['name']),
          isSelected: data['isSelected'],
        );
      }).toList();

      setState(() {
        _countries = countries;
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

  void updateCountrySelection(Country country, bool isSelected) async {
    setState(() {
      preferencePaysText = "";
    });
    List<Map<String, dynamic>> json = [];
    final jsonData = jsonDecode(paysChoisieJson) as List<dynamic>;

    final countries = jsonData.map((data) {
      if (data['name'] == country.name) {
        if (isSelected == true) {
          updatePreferencePaysText(data['name']);
        }
        json.add({
          'name': data['name'],
          'isSelected': isSelected,
        });
        return Country(
          name: data['name'],
          paysName: getPaysNameWhithIndicatif(data['name']),
          isSelected: isSelected,
        );
      }
      if (data['isSelected'] == true) {
        updatePreferencePaysText(data['name']);
      }
      json.add({
        'name': data['name'],
        'isSelected': data['isSelected'],
      });
      return Country(
        name: data['name'],
        paysName: getPaysNameWhithIndicatif(data['name']),
        isSelected: data['isSelected'],
      );
    }).toList();
    setState(() {
      _countries = countries;
      paysChoisieJson = jsonEncode(json);
      searchCountries(recherche);
    });

    final response = await http.get(Uri.parse(
        '$generalRouteForApi/updateUserPaysChoisies/$uidUser/$langUserPhone/$paysChoisieJson'));

    if (response.statusCode == 200) {
      // Mise à jour réussie, mettez à jour l'état du pays dans la liste
    }
  }

  List<Country> _searchResults = [];

  void searchCountries(String query) {
    setState(() {
      recherche = query;
      if (query.isEmpty) {
        _searchResults = List.from(_countries);
      } else {
        final lowercaseQuery = query.toLowerCase();
        _searchResults = _countries.where((country) {
          final lowercaseName = country.name.toLowerCase();
          final lowercasePaysName = country.paysName.toLowerCase();
          return lowercaseName.contains(lowercaseQuery) ||
              lowercasePaysName.contains(lowercaseQuery);
        }).toList();
      }
    });
  }

  @override
  void initState() {
    super.initState();
    fetchCountries();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: primaryColor,
        title: Text(
          (langUserPhone == "fr") ? 'Choix des Pays' : 'Choice of Countries',
          style: GoogleFonts.poppins(fontWeight: FontWeight.w600),
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
                    ? 'Rechercher un pays avec son indicatif'
                    : 'Find a country with its area code',
                border: const OutlineInputBorder(),
              ),
            ),
          ),
          _countries.isEmpty
              ? const Center(
                  child: CircularProgressIndicator(),
                )
              : Expanded(
                  child: ListView.builder(
                    itemCount: _searchResults.length,
                    itemBuilder: (BuildContext context, int index) {
                      final country = _searchResults[index];
                      return ListTile(
                        title: Text("(${country.name}) ${country.paysName}"),
                        leading: Switch(
                          activeColor: Colors.green,
                          activeTrackColor: Colors.green,
                          inactiveThumbColor: Colors.red,
                          inactiveTrackColor: Colors.red,
                          value: country.isSelected,
                          onChanged: (bool? isSelected) {
                            if (isSelected != null) {
                              updateCountrySelection(country, isSelected);
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
