// ignore_for_file: sort_child_properties_last, prefer_const_constructors

import 'dart:io';
import 'dart:async';
import 'package:dressur/1_reception/chat.dart';
import 'package:dressur/1_reception/liste_contact.dart';
import 'package:dressur/1_reception/liste_contact_message.dart';
import 'package:dressur/components/noti.dart';
import 'package:dressur/components/padding_and_divider.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/5_autre/support_assistance.dart';
import 'package:dressur/1_reception/liste_notification.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/sql_helper.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;

import 'package:intl/intl.dart';

class ReceptionChatPage extends StatefulWidget {
  @override
  State<ReceptionChatPage> createState() => _ReceptionChatPageState();
}

class _ReceptionChatPageState extends State<ReceptionChatPage>
    with SingleTickerProviderStateMixin {
  List<Map<String, dynamic>> _discussions = [];
  bool _desactive = false;
  late AnimationController _controller;

  Future<bool> _onWillPop() async {
    return (await showDialog(
          context: context,
          builder: (context) => AlertDialog(
            title: (langUserPhone == "fr")
                ? const Text('Êtes-vous sûr?')
                : const Text('Are you sure?'),
            content: (langUserPhone == "fr")
                ? const Text("Voulez-vous quitter l'application ?")
                : const Text("Do you want to quit the application?"),
            actions: <Widget>[
              TextButton(
                onPressed: () =>
                    Navigator.of(context).pop(false), //<-- SEE HERE
                child: (langUserPhone == "fr")
                    ? const Text('Non')
                    : const Text('No'),
              ),
              TextButton(
                onPressed: () {
                  if (Platform.isAndroid) {
                    SystemNavigator.pop();
                  } else if (Platform.isIOS) {
                    exit(0);
                  }
                }, // <-- SEE HERE
                child: (langUserPhone == "fr")
                    ? const Text('Oui')
                    : const Text('Yes'),
              ),
            ],
          ),
        )) ??
        false;
  }

  @override
  @override
  void initState() {
    super.initState();
    _loadDiscussions();
    Timer(Duration(seconds: 1), () {
      _loadDiscussions();
      Timer.periodic(const Duration(seconds: 1), (timer) {
        _loadDiscussions();
      });
    });
    _controller = AnimationController(
      duration: const Duration(seconds: 1),
      vsync: this,
    );
    getMessageEnAttente(false);
  }

  @override
  void dispose() {
    _controller.dispose();
    super.dispose();
  }

  void getMessageEnAttente(affMessage) async {
    if (affMessage == true) {
      ScaffoldMessenger.of(context).showSnackBar(SnackBar(
        backgroundColor: Colors.red,
        behavior: SnackBarBehavior.floating,
        content: Text(
          (langUserPhone == "fr")
              ? 'Actualisation en cours…'
              : 'Update in progress…',
          style: GoogleFonts.poppins(
            color: Colors.white,
          ),
        ),
      ));
    }
    bool isConnected = await isConnectedToInternet();
    if (isConnected) {
      setState(() {
        _desactive = true;
        _controller.repeat();
      });

      DateFormat formatter = DateFormat('dd/MM/yyyy HH:mm');

      var request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/getMessageEnAttente'));
      request.fields.addAll({
        'uidUser': uidUser.toString(),
        'langUserPhone': langUserPhone.toString(),
      });

      http.StreamedResponse response = await request.send();

      if (response.statusCode == 200) {
        var lastIdMessage = 0;
        var data1 = await response.stream.bytesToString();
        var data = convert.jsonDecode(data1);
        if (data["error"] == false) {
          data["lesMessages"].forEach((message) async {
            lastIdMessage = message["idMessage"];
            if ((await SQLHelper.getOneDiscussion(message["emetteur"]))
                .isEmpty) {
              SQLHelper.insert("discussion", {
                'uid': message["emetteur"],
                'nom': message["emetteurName"],
                'date': message["dateEnvoi"],
              });
            }
            SQLHelper.updateDiscussionDate(
                message["emetteur"], message["dateEnvoi"]);
            SQLHelper.insert("message", {
              'emetteur': message["emetteur"],
              'recepteur': message["recepteur"],
              'message': message["message"],
              'dateEnvoi': formatter.format(
                  DateTime.fromMillisecondsSinceEpoch(message["dateEnvoi"])),
              'vue': "non",
            });
          });

          var request = http.MultipartRequest(
              'POST',
              Uri.parse(
                  '$generalRouteForApi/deleteMessageEnAttente/$lastIdMessage/$uidUser'));
          request.fields.addAll({});
          http.StreamedResponse response = await request.send();
          if (response.statusCode == 200) {}

          setState(() {
            _desactive = false;
            _controller.stop();
          });
        }
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
        _controller.stop();
      });
    }
    if (affMessage == true) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          backgroundColor: Colors.green,
          behavior: SnackBarBehavior.floating,
          content: Text(
            (langUserPhone == "fr")
                ? 'Actualisation terminée.'
                : 'Refresh complete.',
            style: GoogleFonts.poppins(
              color: Colors.white,
            ),
          ),
        ),
      );
    }
  }

  Future<void> _loadDiscussions() async {
    final List<Map<String, dynamic>> discussions =
        await SQLHelper.getAllDiscussions();
    List<Map<String, dynamic>> updatedDiscussions = [];
    for (var discussion in discussions) {
      final String uid = discussion['uid'];
      final List<Map<String, dynamic>> messages =
          await SQLHelper.getLastMessageAndUnreadCount(uid, uidUser);
      if (messages.isNotEmpty) {
        final Map<String, dynamic> lastMessage = messages.first;
        final int unreadCount = messages.length - 1;
        // Ajouter le dernier message et le nombre de messages non lus à la discussion
        updatedDiscussions.add({
          ...discussion,
          'lastMessage': lastMessage,
          'unreadCount': unreadCount,
        });
      }
    }

    // Vérifier si le widget est toujours monté avant d'appeler setState
    if (mounted) {
      setState(() {
        _discussions = updatedDiscussions;
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return WillPopScope(
      onWillPop: _onWillPop,
      child: Scaffold(
        appBar: AppBar(
          automaticallyImplyLeading: false,
          elevation: 0,
          backgroundColor: primaryColor,
          title: Text(
            (langUserPhone == "fr") ? "Boîte de Réception" : "Inbox",
            style: GoogleFonts.poppins(
              color: Colors.white,
              fontWeight: FontWeight.w400,
              fontSize: 18,
            ),
          ),
          actions: [
            IconButton(
              icon: _desactive
                  ? RotationTransition(
                      turns: Tween(begin: 0.0, end: 1.0).animate(_controller),
                      child: const FaIcon(
                        FontAwesomeIcons.arrowsRotate,
                        color: Colors.white,
                      ),
                    )
                  : const FaIcon(FontAwesomeIcons.arrowsRotate),
              color: Colors.white,
              onPressed: () {
                _desactive ? null : getMessageEnAttente(true);
              },
            ),
            const Padding(
              padding: EdgeInsets.fromLTRB(0, 10, 0, 10),
              child: VerticalDivider(
                width: 0,
                color: Colors.white,
                thickness: 1,
              ),
            ),
            PopupMenuButton<dynamic>(
              itemBuilder: (context) => [
                PopupMenuItem(
                  value: 1,
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
                if (value == 1) {
                  Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) => SupportPage()),
                  );
                }
              },
            ),
          ],
        ),
        body: SingleChildScrollView(
          child: Column(
            children: [
              const SizedBox(height: 5),
              GestureDetector(
                onTap: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(
                      builder: (context) => ContactPage(),
                    ),
                  );
                },
                child: Card(
                  margin:
                      const EdgeInsets.symmetric(horizontal: 10, vertical: 5),
                  child: ListTile(
                    leading: const CircleAvatar(
                      child: FaIcon(
                        FontAwesomeIcons.solidAddressBook,
                        color: Colors.white,
                      ),
                      backgroundColor: primaryColor,
                    ),
                    title: Text(
                      "Contacts",
                      style: GoogleFonts.poppins(
                        color: primaryColor,
                        fontSize: 22,
                        fontWeight: FontWeight.w500,
                      ),
                    ),
                    subtitle: Text(
                      (langUserPhone == "fr")
                          ? "Contacts ajouter et scanner"
                          : "Contacts add and scan",
                      style: GoogleFonts.poppins(
                        fontSize: 13,
                        fontWeight: FontWeight.w300,
                      ),
                      maxLines: 1,
                      overflow: TextOverflow.ellipsis,
                    ),
                    trailing: const FaIcon(FontAwesomeIcons.chevronRight),
                  ),
                ),
              ),
              GestureDetector(
                onTap: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(
                      builder: (context) => ListeNotification(),
                    ),
                  );
                },
                child: Card(
                  margin:
                      const EdgeInsets.symmetric(horizontal: 10, vertical: 5),
                  child: ListTile(
                    leading: const CircleAvatar(
                      child: FaIcon(
                        FontAwesomeIcons.solidBell,
                        size: 20,
                        color: Colors.white,
                      ),
                      backgroundColor: primaryColor,
                    ),
                    title: Text(
                      "Notifications",
                      style: GoogleFonts.poppins(
                        color: primaryColor,
                        fontSize: 22,
                        fontWeight: FontWeight.w500,
                      ),
                    ),
                    subtitle: Text(
                      (langUserPhone == "fr")
                          ? "Cadeaux, Astuces, Recommandations, Informations, Avertissements, "
                          : "Gifts, Tips, Recommendations, Information, Warnings, ",
                      style: GoogleFonts.poppins(
                        fontSize: 13,
                        fontWeight: FontWeight.w300,
                      ),
                      maxLines: 1,
                      overflow: TextOverflow.ellipsis,
                    ),
                    trailing: const FaIcon(FontAwesomeIcons.chevronRight),
                  ),
                ),
              ),
              DressurDivider(),
              _discussions.isEmpty
                  ? Center(
                      child: Padding(
                        padding: EdgeInsets.fromLTRB(5, 50, 5, 5),
                        child: Text(
                          (langUserPhone == "fr")
                              ? "Aucune discussion trouvée."
                              : "No discussions found.",
                          style: GoogleFonts.poppins(fontSize: 16),
                        ),
                      ),
                    )
                  : ListView.builder(
                      shrinkWrap: true,
                      physics: NeverScrollableScrollPhysics(),
                      itemCount: _discussions.length,
                      itemBuilder: (context, index) {
                        final discussion = _discussions[index];
                        final lastMessage = discussion['lastMessage'];
                        final unreadCount = discussion['unreadCount'];

                        return GestureDetector(
                          onTap: () {
                            setState(() {
                              uidAutreUser = discussion['uid'];
                              userChatInfo = [
                                discussion['uid'],
                                discussion['nom'],
                                discussion['nom']
                              ];
                            });
                            Navigator.push(
                              context,
                              MaterialPageRoute(
                                builder: (context) => ChatPage(),
                              ),
                            );
                          },
                          child: Card(
                            margin: const EdgeInsets.symmetric(
                                horizontal: 10, vertical: 5),
                            child: ListTile(
                              leading: CircleAvatar(
                                child: FaIcon(
                                  FontAwesomeIcons.solidUser,
                                  color: Colors.white,
                                ),
                                backgroundColor: primaryColor,
                              ),
                              title: Row(
                                children: [
                                  Text(
                                    discussion['nom'],
                                    style: GoogleFonts.poppins(
                                      color: primaryColor,
                                      fontSize: 18,
                                      fontWeight: FontWeight.w400,
                                    ),
                                  ),
                                  if (unreadCount > 0)
                                    Container(
                                      padding: const EdgeInsets.all(4),
                                      margin: const EdgeInsets.only(left: 5),
                                      decoration: BoxDecoration(
                                        shape: BoxShape.circle,
                                        color: Colors.red,
                                      ),
                                      child: Text(
                                        '$unreadCount',
                                        style: GoogleFonts.poppins(
                                          color: Colors.white,
                                          fontSize: 12,
                                          fontWeight: FontWeight.bold,
                                        ),
                                      ),
                                    ),
                                ],
                              ),
                              subtitle: Text(
                                lastMessage['message'],
                                style: GoogleFonts.poppins(
                                  fontSize: 13,
                                  fontWeight: FontWeight.w300,
                                ),
                                maxLines: 1,
                                overflow: TextOverflow.ellipsis,
                              ),
                              trailing: FaIcon(FontAwesomeIcons.chevronRight),
                            ),
                          ),
                        );
                      },
                    ),
            ],
          ),
        ),
        floatingActionButton: FloatingActionButton(
          backgroundColor: primaryColor,
          tooltip: (langUserPhone == "fr")
              ? "Nouvelle discussion"
              : "New discussion",
          onPressed: () {
            Navigator.push(
              context,
              MaterialPageRoute(builder: (context) => ContactForMessagePage()),
            );
          },
          child: const FaIcon(
            FontAwesomeIcons.solidComment,
            color: Colors.white,
          ),
        ),
      ),
    );
  }
}
