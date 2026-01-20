// ignore_for_file: prefer_const_constructors

import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/components/constant.dart';

class ProgrammeRecompensePage extends StatefulWidget {
  @override
  State<ProgrammeRecompensePage> createState() =>
      _ProgrammeRecompensePageState();
}

class _ProgrammeRecompensePageState extends State<ProgrammeRecompensePage> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: primaryColor,
        elevation: 0,
        title: Text(
          "Programme des récompenses",
          style: GoogleFonts.poppins(
            color: Colors.white,
            fontWeight: FontWeight.w400,
          ),
        ),
        leading: IconButton(
          icon: Icon(Icons.arrow_back, color: Colors.white),
          onPressed: () => Navigator.pop(context),
        ),
      ),
      body: isInscritProgrammeRecompense
          ? _pageInformationApresInscription()
          : _pagePresentationProgramme(),
    );
  }

  // ---------------------------------------------------------------------------
  // PAGE DE PRÉSENTATION (NON INSCRIT)
  // ---------------------------------------------------------------------------
  Widget _pagePresentationProgramme() {
    return Padding(
      padding: const EdgeInsets.all(16),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Icon(Icons.campaign, size: 60, color: primaryColor),
          SizedBox(height: 15),
          Text(
            "Promouvoir sur WhatsApp Statut",
            style: GoogleFonts.poppins(
              fontSize: 22,
              fontWeight: FontWeight.w600,
              color: primaryColor,
            ),
          ),
          SizedBox(height: 10),
          Text(
            "Gagnez de l'argent en partageant des promotions de produits, services ou événements sur votre statut WhatsApp.",
            style:
                GoogleFonts.poppins(fontSize: 14, fontWeight: FontWeight.w300),
          ),
          SizedBox(height: 25),
          _item(
            Icons.download,
            "Téléchargez une promotion",
            "Téléchargez la fiche officielle fournie par la plateforme.",
          ),
          _item(
            Icons.share,
            "Partagez sur votre statut WhatsApp",
            "Publiez la promotion sur votre statut WhatsApp pendant au moins 24h.",
          ),
          _item(
            Icons.visibility,
            "Atteignez des paliers de vues",
            "250, 500, 1 000, 2 000 ou 4 000 vues selon vos performances.",
          ),
          _item(
            Icons.verified,
            "Soumettez vos preuves",
            "Captures et vidéos sont exigées pour valider vos vues.",
          ),
          SizedBox(height: 10),
          Text(
            "⚠️ Le paiement dépend de la validation des preuves et du quota de vues disponible.",
            style: GoogleFonts.poppins(
              fontSize: 12,
              fontWeight: FontWeight.w300,
              color: Colors.grey[700],
            ),
          ),
          Spacer(),
          SizedBox(
            width: double.infinity,
            height: 50,
            child: ElevatedButton(
              style: ElevatedButton.styleFrom(
                backgroundColor: primaryColor,
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(8),
                ),
              ),
              onPressed: () {
                setState(() {
                  isInscritProgrammeRecompense = true;
                });
              },
              child: Text(
                "Participer au programme",
                style: GoogleFonts.poppins(
                  fontSize: 16,
                  fontWeight: FontWeight.w500,
                  color: Colors.white,
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }

  // ---------------------------------------------------------------------------
  // PAGE APRÈS INSCRIPTION
  // ---------------------------------------------------------------------------
  Widget _pageInformationApresInscription() {
    return Center(
      child: Padding(
        padding: const EdgeInsets.all(20),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Icon(Icons.check_circle, size: 80, color: Colors.green),
            SizedBox(height: 20),
            Text(
              "Inscription confirmée",
              style: GoogleFonts.poppins(
                fontSize: 22,
                fontWeight: FontWeight.w600,
                color: primaryColor,
              ),
            ),
            SizedBox(height: 10),
            Text(
              "Vous pouvez maintenant commencer à promouvoir des offres et soumettre vos preuves pour recevoir des récompenses.",
              textAlign: TextAlign.center,
              style: GoogleFonts.poppins(
                fontSize: 14,
                fontWeight: FontWeight.w300,
              ),
            ),
            SizedBox(height: 30),
            ElevatedButton(
              style: ElevatedButton.styleFrom(
                backgroundColor: primaryColor,
              ),
              onPressed: () {
                // navigation vers la liste des promotions (plus tard)
              },
              child: Text("Commencer"),
            ),
          ],
        ),
      ),
    );
  }

  // ---------------------------------------------------------------------------
  Widget _item(IconData icon, String title, String desc) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 15),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Icon(icon, color: primaryColor),
          SizedBox(width: 10),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(title,
                    style: GoogleFonts.poppins(
                        fontSize: 15, fontWeight: FontWeight.w500)),
                SizedBox(height: 3),
                Text(desc,
                    style: GoogleFonts.poppins(
                        fontSize: 13, fontWeight: FontWeight.w300)),
              ],
            ),
          ),
        ],
      ),
    );
  }
}
