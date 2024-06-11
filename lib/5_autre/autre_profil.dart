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
import 'package:url_launcher/url_launcher.dart';

class AutreProfilPage extends StatefulWidget {
  @override
  State<AutreProfilPage> createState() => _AutreProfilPageState();
}

class _AutreProfilPageState extends State<AutreProfilPage> {
  final double coverHeight = 160;
  final double profileHeight = 130;

  bool _loading = false;
  bool _firstLoad = true;
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
      body: _firstLoad
          ? const Center(
              child: CircularProgressIndicator(),
            )
          : _loading
              ? const Center(
                  child: CircularProgressIndicator(),
                )
              : SingleChildScrollView(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.center,
                    children: [
                       Stack(
                        clipBehavior: Clip.none,
                        alignment: Alignment.center,
                        children: [
                          buildCoverImage(),
                          Positioned(
                            top: coverHeight - profileHeight / 2,
                            child: buildProfileImageWithBorder(),
                          ),

                          Positioned(
                            top: coverHeight - profileHeight / 2 + 155,
                            child: buildUserName(), // Ajouter cette ligne
                          ),

                        ],
                      ),
                      Padding(
                        padding: const EdgeInsets.fromLTRB(15, 200, 15, 10),
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            if (autre_tiktok != null) ...[
                              const SizedBox(height: 5),
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
                              const SizedBox(height: 5),
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
                              const SizedBox(height: 5),
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
                              const SizedBox(height: 5),
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
                    ],
                  ),
                ),
    );
  }

  Widget buildCoverImage() {
    return Container(
      height: coverHeight,
      decoration: BoxDecoration(
        image: DecorationImage(
          image: AssetImage('images/coverimgprofil.jpg'), // Chemin correct vers l'image locale
          fit: BoxFit.cover,
        ),
      ),
    );
  }

 Widget buildProfileImageWithBorder() {
    return Container(
      width: profileHeight + 8, // Adding extra space for the border
      height: profileHeight + 8,
      decoration: BoxDecoration(
        shape: BoxShape.circle,
        border: Border.all(
          color: Colors.white, // Border color
          width: 4.0, // Border width
        ),
      ),
      child: CircleAvatar(
        radius: profileHeight / 2,
        backgroundColor: primaryColor,
        backgroundImage: AssetImage('images/hommeavata1.png'), // Chemin correct vers l'image locale
      ),
    );
  }

Widget buildUserName() {
    return autre_nom != null
        ? Column(
            children: [
              Text(
                autre_nom,
                style: GoogleFonts.poppins(
                  fontSize: 20,
                  fontWeight: FontWeight.bold,
                  color: const Color.fromARGB(255, 0, 0, 0),
                ),
              ),
              if (autre_pseudo != null)
                Text(
                  "@$autre_pseudo",
                  style: GoogleFonts.poppins(
                    fontSize: 16,
                    color: Color.fromARGB(179, 0, 0, 0),
                  ),
                ),
              const SizedBox(height: 5),
              buildContactIcons(),
            ],
          )
        : Container();
  }

  Widget buildContactIcons() {
    return Row(
      mainAxisAlignment: MainAxisAlignment.center,
      children: [
        if (autre_tel != null)
          buildIconWithCircularBackground(
            icon: Icons.phone,
            onPressed: () async {
              final Uri _telUrl = Uri(scheme: 'tel', path: autre_tel);
              if (!await launchUrl(_telUrl)) {
                throw 'Could not launch $_telUrl';
              }
            },
          ),
        if (autre_tel != null)
          buildIconWithCircularBackground(
            iconPath: 'images/logo_whatsapp.png', // Chemin de votre icône WhatsApp
            onPressed: () async {
              final Uri _whatsappUrl = Uri(
                  scheme: 'https',
                  host: 'wa.me',
                  path: autre_tel.replaceAll(' ', ''));
              if (!await launchUrl(_whatsappUrl)) {
                throw 'Could not launch $_whatsappUrl';
              }
            },
          ),
        if (autre_mail != null)
          buildIconWithCircularBackground(
            icon: Icons.email,
            onPressed: () async {
              final Uri _mailUrl = Uri(
                  scheme: 'mailto',
                  path: autre_mail,
                  query: 'subject=Contact&body=Hello');
              if (!await launchUrl(_mailUrl)) {
                throw 'Could not launch $_mailUrl';
              }
            },
          ),
      ],
    );
  }

  Widget buildIconWithCircularBackground({IconData? icon, String? iconPath, required VoidCallback onPressed}) {
    return Container(
      margin: const EdgeInsets.symmetric(horizontal: 8.0),
      decoration: BoxDecoration(
        shape: BoxShape.circle,
        color: primaryColor,
      ),
      child: IconButton(
        icon: icon != null
            ? Icon(icon, color: Colors.white)
            : Image.asset(iconPath!, color: Colors.white, width: 24, height: 24),
        onPressed: onPressed,
      ),
    );
  }

}
