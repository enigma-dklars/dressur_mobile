// ignore_for_file: use_build_context_synchronously

import 'dart:convert';

import 'package:dressur/components/noti.dart';
import 'package:dressur/components/profile_menu_reseau.dart';
import 'package:dressur/components/sql_helper.dart';
import 'package:flutter/material.dart';
import 'package:flutter_contacts/flutter_contacts.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/components/constant.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;

import 'package:url_launcher/url_launcher.dart';

class AutreProfilPage extends StatefulWidget {
  @override
  State<AutreProfilPage> createState() => _AutreProfilPageState();
}

class _AutreProfilPageState extends State<AutreProfilPage> {
  bool _loading = false;
  var autre_pseudo;
  var autre_nom;
  var autre_mail;
  var autre_pays;
  var autre_tel;
  var autre_apropos;
  var autre_tiktok;
  var autre_instagram;
  var autre_facebook;
  var autre_youtube;
  var autre_affUserName;

  Future<void> fetchAutreProfil() async {
    setState(() {
      _loading = true;
    });
    dynamic youHaveNetWork = "";
    youHaveConnexion();
    youHaveNetWork = await SQLHelper.getYouHaveConnexion();
    while (youHaveNetWork.length == 0) {
      youHaveNetWork = await SQLHelper.getYouHaveConnexion();
    }
    var request = http.MultipartRequest(
        'POST', Uri.parse('$generalRouteForApi/getUserInfo'));
    request.fields.addAll(
        {'uid': uidAutreUser, 'langUserPhone': langUserPhone.toString()});

    http.StreamedResponse response = await request.send();

    if (response.statusCode == 200) {
      var data1 = await response.stream.bytesToString();
      var data = convert.jsonDecode(data1);
      if (data["error"] == false) {
        setState(() {
          var userAutreInfos = data['user'];
          autre_pseudo = userAutreInfos["pseudo"];
          autre_nom = userAutreInfos["nom"];
          autre_mail = userAutreInfos["mail"];
          autre_pays = userAutreInfos["pays"];
          autre_tel = userAutreInfos["tel"];
          autre_apropos = userAutreInfos["apropos"];
          autre_tiktok = userAutreInfos["tiktok"];
          autre_instagram = userAutreInfos["instagram"];
          autre_facebook = userAutreInfos["facebook"];
          autre_youtube = userAutreInfos["youtube"];
          autre_affUserName = userAutreInfos["affUserName"];
          _loading = false;
          if (addUserOnAutreProfilPage == "oui") {
            addUserContact(autre_tel, autre_nom, context);
          }
          addUserOnAutreProfilPage = "oui";
        });
      } else {
        setState(() {
          _loading = false;
        });
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
    } else {
      setState(() {
        _loading = false;
      });
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

  void addUserContact(tel, pseudo, context) async {
    var request = http.MultipartRequest('POST',
        Uri.parse('$generalRouteForApi/addUserContactAfterScanneQRCode'));
    request.fields.addAll({
      'uid': uidUser,
      'langUserPhone': langUserPhone.toString(),
      'tel': tel
    });

    http.StreamedResponse response = await request.send();

    if (response.statusCode == 200) {
      var data1 = await response.stream.bytesToString();
      var data = jsonDecode(data1);
      if (data["error"] == true) {
        dangerNoti(data["titre"], data["message"], context);
      } else {
        insertContact(tel, pseudo);
        ScaffoldMessenger.of(context).showSnackBar(SnackBar(
      behavior: SnackBarBehavior.floating,
          backgroundColor: Colors.green,
          padding: const EdgeInsets.fromLTRB(5, 20, 5, 20),
          content: Text(
            (langUserPhone == "fr")
                ? 'ADD $pseudo avec succès.'
                : 'ADD $pseudo successfully.',
            style: GoogleFonts.poppins(
              fontWeight: FontWeight.w600,
              fontSize: 20,
              color: Colors.white,
            ),
            textAlign: TextAlign.center,
          ),
          duration: const Duration(milliseconds: 5000),
        ));
      }
    }
  }

  void insertContact(tel, pseudo) async {
    if ((await SQLHelper.getOneNumsTelUser(tel)).isEmpty) {
      final newContact = Contact()
        ..name.first = "$pseudo #DS"
        ..phones = [Phone(tel)];
      await newContact.insert();
      await insertNumTelUserIntoDataBase(tel);
    }
  }

  @override
  void initState() {
    super.initState();
    fetchAutreProfil(); // Loading the diary when the app starts
  }

  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        elevation: 0,
        backgroundColor: primaryColor,
        title: Text(
          (langUserPhone == "fr")
              ? "Informations Utilisateur"
              : "User Information",
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
            Icons.arrow_back,
            size: 30,
            color: Colors.white,
          ),
        ),
      ),
      body: _loading
          ? const Center(
              child: CircularProgressIndicator(),
            )
          : SingleChildScrollView(
              child: Padding(
                padding: const EdgeInsets.fromLTRB(15, 10, 15, 10),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    if (autre_pseudo != null) ...[
                      Text(
                        (langUserPhone == "fr") ? "Pseudo" : "Username",
                        style: GoogleFonts.poppins(
                          fontSize: 10,
                        ),
                      ),
                      Text(
                        autre_pseudo,
                        style: GoogleFonts.poppins(
                          fontSize: 20,
                        ),
                      ),
                      const SizedBox(height: 5),
                      const Divider(
                        height: 1,
                        thickness: 1,
                        color: Colors.grey,
                      ),
                      const SizedBox(height: 10),
                    ],
                    if (autre_nom != null) ...[
                      Text(
                        (langUserPhone == "fr")
                            ? "Nom et Prénom(s)"
                            : "Last name and first names",
                        style: GoogleFonts.poppins(
                          fontSize: 10,
                        ),
                      ),
                      Text(
                        autre_nom,
                        style: GoogleFonts.poppins(
                          fontSize: 20,
                        ),
                      ),
                      const SizedBox(height: 5),
                      const Divider(
                        height: 1,
                        thickness: 1,
                        color: Colors.grey,
                      ),
                      const SizedBox(height: 10),
                    ],
                    if (autre_mail != null) ...[
                      Text(
                        (langUserPhone == "fr") ? "E-Mail" : "E-Mail",
                        style: GoogleFonts.poppins(
                          fontSize: 10,
                        ),
                      ),
                      Text(
                        autre_mail,
                        style: GoogleFonts.poppins(
                          fontSize: 20,
                        ),
                      ),
                      const SizedBox(height: 5),
                      const Divider(
                        height: 1,
                        thickness: 1,
                        color: Colors.grey,
                      ),
                      const SizedBox(height: 10),
                    ],
                    if (autre_tel != null) ...[
                      Text(
                        (langUserPhone == "fr")
                            ? "Numéro de Téléphone"
                            : "Phone number",
                        style: GoogleFonts.poppins(
                          fontSize: 10,
                        ),
                      ),
                      Text(
                        autre_tel,
                        style: GoogleFonts.poppins(
                          fontSize: 20,
                        ),
                      ),
                      const SizedBox(height: 5),
                      const Divider(
                        height: 1,
                        thickness: 1,
                        color: Colors.grey,
                      ),
                      const SizedBox(height: 10),
                    ],
                    if (autre_tiktok != null) ...[
                      Text(
                        "TikTok",
                        style: GoogleFonts.poppins(
                          fontSize: 10,
                        ),
                      ),
                      ProfileMenuReseau(
                        text: "Tiktok",
                        press: () async {
                          final Uri _url = Uri.parse(autre_tiktok);
                          if (!await launchUrl(_url,
                              mode: LaunchMode.externalApplication)) {
                            throw 'Could not launch $_url';
                          }
                        },
                      ),
                      const SizedBox(height: 5),
                      const Divider(
                        height: 1,
                        thickness: 1,
                        color: Colors.grey,
                      ),
                    ],
                    if (autre_youtube != null) ...[
                      Text(
                        "Youtube",
                        style: GoogleFonts.poppins(
                          fontSize: 10,
                        ),
                      ),
                      ProfileMenuReseau(
                        text: "Youtube",
                        press: () async {
                          final Uri _url = Uri.parse(autre_youtube);
                          if (!await launchUrl(_url,
                              mode: LaunchMode.externalApplication)) {
                            throw 'Could not launch $_url';
                          }
                        },
                      ),
                      const SizedBox(height: 5),
                      const Divider(
                        height: 1,
                        thickness: 1,
                        color: Colors.grey,
                      ),
                    ],
                    if (autre_facebook != null) ...[
                      Text(
                        "Facebook",
                        style: GoogleFonts.poppins(
                          fontSize: 10,
                        ),
                      ),
                      ProfileMenuReseau(
                        text: "Facebook",
                        press: () async {
                          final Uri _url = Uri.parse(autre_facebook);
                          if (!await launchUrl(_url,
                              mode: LaunchMode.externalApplication)) {
                            throw 'Could not launch $_url';
                          }
                        },
                      ),
                      const SizedBox(height: 5),
                      const Divider(
                        height: 1,
                        thickness: 1,
                        color: Colors.grey,
                      ),
                    ],
                    if (autre_instagram != null) ...[
                      Text(
                        "Instagram",
                        style: GoogleFonts.poppins(
                          fontSize: 10,
                        ),
                      ),
                      ProfileMenuReseau(
                        text: "Instagram",
                        press: () async {
                          final Uri _url = Uri.parse(autre_instagram);
                          if (!await launchUrl(_url,
                              mode: LaunchMode.externalApplication)) {
                            throw 'Could not launch $_url';
                          }
                        },
                      ),
                      const SizedBox(height: 5),
                      const Divider(
                        height: 1,
                        thickness: 1,
                        color: Colors.grey,
                      ),
                    ],
                    if (autre_apropos != null) ...[
                      Text(
                        (langUserPhone == "fr") ? "À propos" : "About",
                        style: GoogleFonts.poppins(
                          fontSize: 10,
                        ),
                      ),
                      Text(
                        autre_apropos,
                        style: GoogleFonts.poppins(
                          fontSize: 20,
                        ),
                      ),
                      const SizedBox(height: 10),
                    ],
                  ],
                ),
              ),
            ),
    );
  }
}
