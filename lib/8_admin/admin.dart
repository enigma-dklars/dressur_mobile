// ignore_for_file: unnecessary_brace_in_string_interps

import 'package:dressur/components/111_generaleApiDomaine.dart';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/components/constant.dart';
import 'package:http/http.dart' as http;
import 'package:url_launcher/url_launcher.dart';

class AdministrationPage extends StatefulWidget {
  AdministrationPage({Key? key}) : super(key: key);
  @override
  State<AdministrationPage> createState() => _AdministrationPageState();
}

class _AdministrationPageState extends State<AdministrationPage> {
  bool _desactive2 = false;

  Future<void> sauvegardeBDD() async {
    setState(() {
      _desactive2 = true;
    });
    try {
      final url = Uri.parse('$generalRouteForApi/export/database');
      final response = await http.get(url);

      if (response.statusCode == 200) {
        ScaffoldMessenger.of(context).showSnackBar(SnackBar(
          backgroundColor: Colors.green,
          behavior: SnackBarBehavior.floating,
          content: Text(
            "Sauvegarde Terminer",
            style: GoogleFonts.poppins(
              color: Colors.white,
            ),
          ),
        ));

        setState(() {
          _desactive2 = false;
        });
      } else {
        setState(() {
          _desactive2 = false;
        });
        ScaffoldMessenger.of(context).showSnackBar(SnackBar(
          backgroundColor: Colors.red,
          behavior: SnackBarBehavior.floating,
          content: Text(
            "Erreur de sauvegarde",
            style: GoogleFonts.poppins(
              color: Colors.white,
            ),
          ),
        ));
      }
    } catch (e) {
      setState(() {
        _desactive2 = false;
      });
    } finally {
      setState(() {
        _desactive2 = false;
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        elevation: 0,
        backgroundColor: Colors.red,
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
        title: Text(
          "Administration",
          style: GoogleFonts.poppins(
            color: Colors.white,
            fontWeight: FontWeight.w400,
          ),
        ),
      ),
      body: SingleChildScrollView(
        child: Container(
          padding: const EdgeInsets.fromLTRB(10, 0, 10, 5),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.stretch,
            children: [
              const SizedBox(height: 8),
              GestureDetector(
                child: ElevatedButton(
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.red,
                    shape: const StadiumBorder(),
                    padding: const EdgeInsets.symmetric(
                      vertical: 13,
                    ),
                  ),
                  child: Text(
                    "Les valeurs Env",
                    style: GoogleFonts.poppins(
                      color: Colors.white,
                      fontSize: 15,
                    ),
                  ),
                  onPressed: () async {
                    final Uri _url =
                        Uri.parse("$generalApiDomaine/admin/interface");
                    if (!await launchUrl(_url,
                        mode: LaunchMode.externalApplication)) {
                      throw 'Could not launch $_url';
                    }
                  },
                ),
              ),
              const SizedBox(height: 5),
              GestureDetector(
                child: ElevatedButton(
                  style: ElevatedButton.styleFrom(
                    backgroundColor: _desactive2 ? Colors.blue : Colors.red,
                    shape: const StadiumBorder(),
                    padding: const EdgeInsets.symmetric(
                      vertical: 13,
                    ),
                  ),
                  child: Text(
                    _desactive2 ? "Patientez" : "Sauvegarde de la BDD",
                    style: GoogleFonts.poppins(
                      color: Colors.white,
                      fontSize: 15,
                    ),
                  ),
                  onPressed: () {
                    _desactive2 ? null : sauvegardeBDD();
                  },
                ),
              ),
              const SizedBox(height: 5),
            ],
          ),
        ),
      ),
    );
  }
}
