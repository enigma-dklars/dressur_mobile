// ignore_for_file: use_build_context_synchronously

import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/components/delayed_animation.dart';
import 'package:dressur/components/constant.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;
import 'package:dressur/components/noti.dart';

class ProfilPage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        elevation: 0,
        backgroundColor: primaryColor,
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
          (langUserPhone == "fr") ? "Mon Profil" : "My profile",
          style: GoogleFonts.poppins(
            fontWeight: FontWeight.w400,
            color: Colors.white,
          ),
        ),
      ),
      body: SingleChildScrollView(
        child: Column(
          children: [
            const SizedBox(height: 10),
            Container(
              margin: const EdgeInsets.symmetric(vertical: 0, horizontal: 16),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.center,
                children: [
                  SizedBox(
                    height: 100,
                    child: Image.asset("images/profile.png"),
                  ),
                  const SizedBox(height: 10),
                  Text(
                    (langUserPhone == "fr")
                        ? "Modifiez et complétez vos informations."
                        : "Edit and complete your information.",
                    style: GoogleFonts.poppins(
                      fontSize: 16,
                    ),
                    textAlign: TextAlign.center,
                  ),
                  const SizedBox(height: 10),
                  // Formulaire
                  RegisterForm(),

                  const SizedBox(height: 10),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class RegisterForm extends StatefulWidget {
  @override
  State<RegisterForm> createState() => _RegisterFormState();
}

class _RegisterFormState extends State<RegisterForm> {
  bool _desactive = false;
  var data;
  final telController = TextEditingController(text: tel);
  final emailController = TextEditingController(text: mail);
  final nameController = TextEditingController(text: nom);
  final pseudoController = TextEditingController(text: pseudo);
  final aproposController = TextEditingController(text: apropos);
  final tiktokController = TextEditingController(text: tiktok);
  final instagramController = TextEditingController(text: instagram);
  final facebookController = TextEditingController(text: facebook);
  final youtubeController = TextEditingController(text: youtube);

  //HTTP REQUEST REGISTER
  void registerIn(
      String pseudo,
      String tel,
      String nom,
      String mail,
      String apropos,
      String tiktok,
      String instagram,
      String facebook,
      String youtube) async {
    bool isConnected = await isConnectedToInternet();
    if (isConnected) {
      setState(() {
        _desactive = true;
      });

      var request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/updateUserInfo'));
      request.fields.addAll({
        'uid': uidUser,
        'langUserPhone': langUserPhone.toString(),
        'tel': tel,
        'mail': mail,
        'nom': nom,
        'pseudo': pseudo,
        'apropos': apropos,
        'tiktok': tiktok,
        'instagram': instagram,
        'facebook': facebook,
        'youtube': youtube,
      });

      http.StreamedResponse response = await request.send();

      if (response.statusCode == 200) {
        var data1 = await response.stream.bytesToString();
        data = convert.jsonDecode(data1);
        if (data["error"] == true) {
          dangerNoti(data["titre"], data["message"], context);
          setState(() {
            _desactive = false;
          });
        } else {
          setState(() {
            _desactive = false;
            initUserInformations(data['user']);
            Navigator.pop(context);
            ScaffoldMessenger.of(context).showSnackBar(SnackBar(
              backgroundColor: Colors.green,
              behavior: SnackBarBehavior.floating,
              content: Text(
                (langUserPhone == "fr")
                    ? 'Profil mis à jour…'
                    : 'Profile updated…',
                style: GoogleFonts.poppins(
                  color: Colors.white,
                ),
              ),
            ));
          });
        }
      } else {
        if (langUserPhone != "fr") {
          dangerNoti("Mistake!",
              "We encountered a problem, contact the administrators.", context);
        } else {
          dangerNoti(
              "Erreur!",
              "Nous avons rencontré un problème, contacter les administrateurs.",
              context);
        }
        setState(() {
          _desactive = false;
        });
      }
    } else {
      if (langUserPhone != "fr") {
        dangerNoti(
            "Mistake!", "You are not connected to the internet.", context);
      } else {
        dangerNoti("Erreur!", "Vous n'ètes pas connecté a internet.", context);
      }
      setState(() {
        _desactive = false;
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Container(
      child: Column(
        children: [
          TextField(
            controller: pseudoController,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText: 'Pseudo',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          if (telIsVerified == false) ...[
            TextField(
              controller: telController,
              decoration: InputDecoration(
                labelStyle: TextStyle(color: Colors.grey[400]),
                labelText: (langUserPhone == "fr")
                    ? 'Numéro Whatsapp'
                    : 'WhatsApp number',
                border: const OutlineInputBorder(),
              ),
            ),
            const SizedBox(height: 10),
          ],
          TextField(
            controller: emailController,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText: 'E-mail',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: nameController,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText: (langUserPhone == "fr")
                  ? 'Nom & Prénom(s)'
                  : "Last name and First Name",
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: tiktokController,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText:
                  (langUserPhone == "fr") ? 'Lien TikTok' : 'TikTok Link',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: instagramController,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText:
                  (langUserPhone == "fr") ? 'Lien Instagram' : 'Instagram Link',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: facebookController,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText:
                  (langUserPhone == "fr") ? 'Lien FaceBook' : 'FaceBook Link',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            controller: youtubeController,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText:
                  (langUserPhone == "fr") ? 'Lien Youtube' : 'Youtube Link',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          TextField(
            maxLines: null,
            controller: aproposController,
            decoration: InputDecoration(
              labelStyle: TextStyle(color: Colors.grey[400]),
              labelText:
                  (langUserPhone == "fr") ? 'A propos de vous' : 'About you',
              border: const OutlineInputBorder(),
            ),
          ),
          const SizedBox(height: 10),
          DelayedAnimation(
            delay: 0, // 4000,
            child: SizedBox(
              width: MediaQuery.of(context).size.width * 0.90,
              child: ElevatedButton(
                style: ElevatedButton.styleFrom(
                  backgroundColor: primaryColor,
                  shape: const StadiumBorder(),
                  padding: const EdgeInsets.symmetric(
                    vertical: 16,
                  ),
                ),
                child: Text(
                  _desactive
                      ? (langUserPhone == "fr")
                          ? "Patientez..."
                          : "Wait..."
                      : (langUserPhone == "fr")
                          ? "ENREGISTRER"
                          : "SAVED",
                  style: GoogleFonts.poppins(
                    fontWeight: FontWeight.w400,
                    color: Colors.white,
                  ),
                ),
                onPressed: () {
                  _desactive
                      ? null
                      : registerIn(
                          pseudoController.text,
                          telController.text,
                          nameController.text,
                          emailController.text,
                          aproposController.text,
                          tiktokController.text,
                          instagramController.text,
                          facebookController.text,
                          youtubeController.text,
                        );
                },
              ),
            ),
          ),
        ],
      ),
    );
  }
}
