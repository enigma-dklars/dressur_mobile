// ignore_for_file: prefer_const_constructors

import 'dart:convert';
import 'package:dressur/components/noti.dart';
import 'package:dressur/components/sql_helper.dart';
import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter_contacts/flutter_contacts.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/components/constant.dart';
import 'package:http/http.dart' as http;
import 'package:url_launcher/url_launcher.dart';

class AutreProfilPage extends StatefulWidget {
  @override
  State<AutreProfilPage> createState() => _AutreProfilPageState();
}

class _AutreProfilPageState extends State<AutreProfilPage> {
  static const espaceEntreLesOptionsContact = 10.0;
  bool _loading = false;
  bool _firstLoad = true;
  var autre_name_complete;
  var autre_avatar;
  var autre_banniere;
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
  var autre_profilePic;
  var autre_bannerPic;

  Future<void> fetchAutreProfil() async {
    setState(() {
      _loading = true;
    });

    var request = http.MultipartRequest(
        'POST', Uri.parse('$generalRouteForApi/getUserInfo'));
    request.fields.addAll(
        {'uid': uidAutreUser, 'langUserPhone': langUserPhone.toString()});

    http.StreamedResponse response = await request.send();

    if (response.statusCode == 200) {
      var data1 = await response.stream.bytesToString();
      var data = jsonDecode(data1);
      if (data["error"] == false) {
        setState(() {
          var userAutreInfos = data['user'];
          autre_name_complete = userAutreInfos["name_complete"];
          autre_avatar = userAutreInfos["avatar"];
          autre_banniere = userAutreInfos["banniere"];
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
          // autre_profilePic = userAutreInfos["profilePic"];
          // autre_bannerPic = userAutreInfos["bannerPic"];
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
              content: Text('Erreur AFTER 200: ${response.statusCode}'),
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
          backgroundColor: Colors.green,
          behavior: SnackBarBehavior.floating,
          duration: const Duration(seconds: 5),
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
  }

  @override
  Widget build(BuildContext context) {

    if (_firstLoad) {
      WidgetsBinding.instance.addPostFrameCallback((_) async {
        fetchAutreProfil();
        setState(() {
          _firstLoad = false;
        });
      });
    }
    return Scaffold(
      body: Column(
        children: [
          SizedBox(
            height: 44,
            child: Container(
              color: primaryColor,
            ),
          ),
          Expanded(
            child: CustomScrollView(
              slivers: <Widget>[
                SliverList(
                  delegate: SliverChildBuilderDelegate(
                    (BuildContext context, int index) {
                      return _firstLoad
                          ? const Center(
                              child: CircularProgressIndicator(),
                            )
                          : _loading
                              ? const Center(
                                  child: CircularProgressIndicator(),
                                )
                              : SingleChildScrollView(
                                  child: Column(
                                    children: [
                                      Stack(
                                        alignment: Alignment.center,
                                        clipBehavior: Clip.none,
                                        children: [
                                          Image.asset(
                                            "images/$autre_banniere",
                                          ),
                                          Positioned(
                                            bottom: -60,
                                            child: CircleAvatar(
                                              backgroundImage: AssetImage(
                                                  "images/$autre_avatar"),
                                              backgroundColor: Colors.white,
                                              radius: 60,
                                              child: Container(
                                                decoration: BoxDecoration(
                                                  shape: BoxShape.circle,
                                                  border: Border.all(
                                                    color: primaryColor,
                                                    width: 2.5,
                                                  ),
                                                ),
                                              ),
                                            ),
                                          ),
                                          Positioned(
                                            top: 10,
                                            left: 10,
                                            child: GestureDetector(
                                              onTap: () {
                                                Navigator.of(context).pop();
                                              },
                                              child: Container(
                                                padding: EdgeInsets.fromLTRB(
                                                    5, 5, 5, 5),
                                                decoration: BoxDecoration(
                                                  color: primaryColor,
                                                  shape: BoxShape.circle,
                                                ),
                                                child: Icon(
                                                  Icons.arrow_back,
                                                  size: 25,
                                                  color: Colors.white,
                                                ),
                                              ),
                                            ),
                                          ),
                                        ],
                                      ),
                                      const SizedBox(height: 70),
                                      if (autre_nom != null) ...[
                                        Text(
                                          autre_nom,
                                          style: GoogleFonts.poppins(
                                            fontSize: 20,
                                            fontWeight: FontWeight.w600,
                                          ),
                                        ),
                                        const SizedBox(height: 1),
                                      ],
                                      if (autre_pseudo != null) ...[
                                        Text(
                                          "@$autre_pseudo",
                                          style:
                                              GoogleFonts.poppins(fontSize: 14),
                                        ),
                                        const SizedBox(height: 6),
                                      ],
                                      Row(
                                        mainAxisAlignment:
                                            MainAxisAlignment.center,
                                        children: [
                                          GestureDetector(
                                            onTap: () {
                                              launchPhoneCall(autre_tel);
                                            },
                                            child: Container(
                                              padding: EdgeInsets.fromLTRB(
                                                  5, 5, 5, 5),
                                              decoration: BoxDecoration(
                                                color: primaryColor,
                                                shape: BoxShape.circle,
                                              ),
                                              child: Icon(
                                                Icons.phone,
                                                size: 20,
                                                color: Colors.white,
                                              ),
                                            ),
                                          ),
                                          const SizedBox(
                                              width:
                                                  espaceEntreLesOptionsContact),
                                          GestureDetector(
                                            onTap: () {
                                              launchSMS(autre_tel);
                                            },
                                            child: Container(
                                              padding: EdgeInsets.fromLTRB(
                                                  5, 5, 5, 5),
                                              decoration: BoxDecoration(
                                                color: primaryColor,
                                                shape: BoxShape.circle,
                                              ),
                                              child: Icon(
                                                Icons.message,
                                                size: 20,
                                                color: Colors.white,
                                              ),
                                            ),
                                          ),
                                          const SizedBox(
                                              width:
                                                  espaceEntreLesOptionsContact),
                                          GestureDetector(
                                            onTap: () {
                                              launchEmail(autre_mail);
                                            },
                                            child: Container(
                                              padding: EdgeInsets.fromLTRB(
                                                  5, 5, 5, 5),
                                              decoration: BoxDecoration(
                                                color: primaryColor,
                                                shape: BoxShape.circle,
                                              ),
                                              child: Icon(
                                                Icons.mail,
                                                size: 20,
                                                color: Colors.white,
                                              ),
                                            ),
                                          ),
                                          const SizedBox(
                                              width:
                                                  espaceEntreLesOptionsContact),
                                          GestureDetector(
                                            onTap: () {
                                              launchWhatsApp(autre_tel);
                                            },
                                            child: Container(
                                              padding: EdgeInsets.fromLTRB(
                                                  5, 5, 5, 5),
                                              decoration: BoxDecoration(
                                                color: primaryColor,
                                                shape: BoxShape.circle,
                                              ),
                                              child: Image.asset(
                                                'images/logo_whatsapp.png',
                                                width: 20,
                                                height: 20,
                                              ),
                                            ),
                                          ),
                                          const SizedBox(
                                              width:
                                                  espaceEntreLesOptionsContact),
                                        ],
                                      ),
                                      Padding(
                                        padding: const EdgeInsets.all(10.0),
                                        child: Column(
                                          crossAxisAlignment:
                                              CrossAxisAlignment.start,
                                          children: [
                                            if (autre_mail != null)
                                              buildInfoCard(
                                                  "E-Mail", autre_mail),
                                            if (autre_tel != null)
                                              buildInfoCard(
                                                  (langUserPhone == "fr")
                                                      ? "Numéro de Téléphone"
                                                      : "Phone number",
                                                  autre_tel),
                                            if (autre_tiktok != null)
                                              buildSocialMediaCard(
                                                  "TikTok", autre_tiktok),
                                            if (autre_youtube != null)
                                              buildSocialMediaCard(
                                                  "Youtube", autre_youtube),
                                            if (autre_facebook != null)
                                              buildSocialMediaCard(
                                                  "Facebook", autre_facebook),
                                            if (autre_instagram != null)
                                              buildSocialMediaCard(
                                                  "Instagram", autre_instagram),
                                            if (autre_apropos != null)
                                              buildInfoCard(
                                                  (langUserPhone == "fr")
                                                      ? "À propos"
                                                      : "About",
                                                  autre_apropos),
                                          ],
                                        ),
                                      ),
                                    ],
                                  ),
                                );
                    },
                    childCount:
                        1, // Utilisez 1 pour un seul élément dans la liste
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }

  Widget buildInfoCard(String title, String content) {
    return SizedBox(
      width: double.infinity,
      child: Card(
        margin: EdgeInsets.only(bottom: 10),
        child: Padding(
          padding: const EdgeInsets.all(10.0),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(
                title,
                style: GoogleFonts.poppins(fontSize: 12, color: Colors.grey),
              ),
              Text(
                content,
                style: GoogleFonts.poppins(fontSize: 18),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget buildSocialMediaCard(String platform, String url) {
    return Card(
      margin: EdgeInsets.only(bottom: 10),
      child: ListTile(
        leading: getSocialMediaIcon(platform),
        title: Text(
          platform,
          style: GoogleFonts.poppins(fontSize: 18),
        ),
        onTap: () async {
          final Uri _url = Uri.parse(url);
          if (!await launchUrl(_url, mode: LaunchMode.externalApplication)) {
            throw 'Could not launch $_url';
          }
        },
      ),
    );
  }

  Icon getSocialMediaIcon(String platform) {
    switch (platform) {
      case "TikTok":
        return Icon(Icons.music_note);
      case "Youtube":
        return Icon(Icons.video_library, color: Colors.red);
      case "Facebook":
        return Icon(Icons.facebook, color: Colors.blue);
      case "Instagram":
        return Icon(Icons.camera_alt, color: Colors.purple);
      default:
        return Icon(Icons.link);
    }
  }
}
