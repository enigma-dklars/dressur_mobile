import 'package:dressur/components/constant.dart';
import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;

class ListeBonus {
  final String titre;
  final String montant;
  final String date;

  ListeBonus({
    required this.titre,
    required this.montant,
    required this.date,
  });
}

class ListeBonusPage extends StatefulWidget {
  @override
  State<ListeBonusPage> createState() => _ListeBonusPageState();
}

class _ListeBonusPageState extends State<ListeBonusPage> {
  bool _loading = false;
  List<ListeBonus> _listeBonus = [];

  @override
  void initState() {
    super.initState();
    fetchListeBonus();
  }

  Future<void> fetchListeBonus() async {
    setState(() {
      _loading = true;
    });
    final url = buildApiUrl();

    final response = await http.get(url);

    if (response.statusCode == 200) {
      final jsonData = convert.jsonDecode(response.body) as List<dynamic>;

      final listeBonus = jsonData.map((data) {
        return ListeBonus(
          titre: data['titre'],
          montant: data['montant'],
          date: data['date'],
        );
      }).toList();

      setState(() {
        _listeBonus = listeBonus;
        _loading = false;
      });
    } else {
      showDialog(
        context: context,
        builder: (BuildContext context) {
          return AlertDialog(
            title: Text('Erreur'),
            content: Text('Erreur: ${response.statusCode}'),
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

  Uri buildApiUrl() {
    return Uri.parse('$generalRouteForApi/listBonus/$uidUser/$langUserPhone');
  }

  buildAppBar() {
    return AppBar(
      elevation: 0,
      backgroundColor: primaryColor,
      title: Text(
        (langUserPhone == "fr")
            ? "Liste des Bonus Reçu"
            : "List of Bonuses Received",
        style: GoogleFonts.poppins(
          color: Colors.white,
          fontWeight: FontWeight.w400,
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
    );
  }

  Widget buildLoadingIndicator() {
    return const Center(
      child: CircularProgressIndicator(),
    );
  }

  Widget buildEmptyListMessage() {
    return Center(
      child: Text(
        (langUserPhone == "fr") ? "Aucun Bonus Reçu." : "No Bonus Received.",
        style: GoogleFonts.poppins(fontSize: 16),
      ),
    );
  }

  Widget buildListItem(ListeBonus listeBonus) {
    return Card(
      margin: const EdgeInsets.only(left: 10, top: 10, right: 10, bottom: 0),
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
                      listeBonus.titre,
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
                      listeBonus.montant,
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
              listeBonus.date,
              style: GoogleFonts.poppins(
                fontSize: 12,
                color: Colors.white,
              ),
            ),
          ],
        ),
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: buildAppBar(),
      body: _loading
          ? buildLoadingIndicator()
          : _listeBonus.isEmpty
              ? buildEmptyListMessage()
              : ListView.separated(
                  itemCount: _listeBonus.length,
                  separatorBuilder: (context, index) =>
                      const SizedBox(height: 1),
                  itemBuilder: (BuildContext context, int index) {
                    return buildListItem(_listeBonus[index]);
                  },
                ),
    );
  }
}
