import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
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
    try {
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
        });
      } else {
        _showErrorDialog(
            'Failed to retrieve boosts. Error code: ${response.statusCode}');
      }
    } catch (e) {
      _showErrorDialog(
          'An error occurred while fetching boosts. Please try again.');
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

  @override
  void initState() {
    super.initState();
    fetchBoosts();
  }

  Widget _buildBoostCard(Boost boost) {
    return Card(
      margin: const EdgeInsets.symmetric(horizontal: 10, vertical: 5),
      child: Padding(
        padding: const EdgeInsets.all(15.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.stretch,
          children: [
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                _buildStatusLabel(boost.modeBoostFormule, isMode: true),
                _buildStatusLabel(boost.statutFormule),
              ],
            ),
            const SizedBox(height: 5),
            Text(
              "${boost.nomFormule} (${boost.prixFormule})",
              style: GoogleFonts.poppins(
                fontWeight: FontWeight.w600,
                fontSize: 18,
              ),
              maxLines: 1,
              overflow: TextOverflow.ellipsis,
            ),
            const SizedBox(height: 5),
            Text(
              boost.dateDebutFormule,
              style: GoogleFonts.poppins(fontSize: 12),
              maxLines: 1,
              overflow: TextOverflow.ellipsis,
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildStatusLabel(String status, {bool isMode = false}) {
    Color backgroundColor;
    if (isMode) {
      backgroundColor =
          (status == "Gratuit" || status == "Free") ? Colors.green : Colors.red;
    } else {
      backgroundColor = (status == "Completed" || status == "Terminé")
          ? Colors.green
          : (status == "In progress" || status == "En cours")
              ? Colors.orange
              : Colors.red;
    }
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 1),
      decoration: BoxDecoration(
        color: backgroundColor,
        borderRadius: BorderRadius.circular(10.0),
      ),
      child: Text(
        status,
        style: GoogleFonts.poppins(
          fontSize: 14,
          color: Colors.white,
          fontWeight: FontWeight.w800,
        ),
        textAlign: TextAlign.end,
      ),
    );
  }

  @override
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
            icon: const FaIcon(
              FontAwesomeIcons.bars,
              color: Colors.white,
              size: 20,
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
          ? const Center(child: CircularProgressIndicator(color: primaryColor))
          : _boosts.isEmpty
              ? Center(
                  child: Text(
                    (langUserPhone == "fr")
                        ? "Aucun boost contact trouvé."
                        : "No contact boost found.",
                    style: GoogleFonts.poppins(fontSize: 16),
                  ),
                )
              : RefreshIndicator(
                  onRefresh: fetchBoosts,
                  color: primaryColor,
                  child: ListView.builder(
                    itemCount: _boosts.length,
                    itemBuilder: (BuildContext context, int index) {
                      return _buildBoostCard(_boosts[index]);
                    },
                  ),
                ),
    );
  }
}
