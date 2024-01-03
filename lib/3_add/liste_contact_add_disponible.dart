import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:flutter_contacts/flutter_contacts.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/components/constant.dart';
import 'package:http/http.dart' as http;
import 'package:dressur/components/sql_helper.dart';

class ContactsDispo {
  final int id;
  final String uid;
  final String pseudo;
  final String pays;
  final String tel;

  ContactsDispo({
    required this.id,
    required this.uid,
    required this.pseudo,
    required this.pays,
    required this.tel,
  });
}

class ListeContactAAddPage extends StatefulWidget {
  @override
  State<ListeContactAAddPage> createState() => _ListeContactAAddPageState();
}

class _ListeContactAAddPageState extends State<ListeContactAAddPage> {
  bool _loading = false;
  List<ContactsDispo> _contactsDispo = [];

  void _showMessagePasPermiAdd(message, context) async {
    showModalBottomSheet(
      context: context,
      shape: const RoundedRectangleBorder(
        borderRadius: BorderRadius.only(
          topLeft: Radius.circular(20.0),
          topRight: Radius.circular(20.0),
        ),
      ),
      elevation: 5,
      isScrollControlled: true,
      builder: (_) => Container(
        decoration: const BoxDecoration(
          gradient: LinearGradient(
            begin: Alignment.topCenter,
            end: Alignment.bottomCenter,
            colors: [
              Colors.red,
              Colors.redAccent,
            ],
          ),
        ),
        padding: EdgeInsets.only(
          top: 0,
          left: 0,
          right: 0,
          // this will prevent the soft keyboard from covering the text fields
          bottom: MediaQuery.of(context).viewInsets.bottom + 0,
        ),
        child: Container(
          padding: const EdgeInsets.fromLTRB(16, 16, 16, 16),
          child: Text(
            message,
            style: GoogleFonts.poppins(
              fontSize: 14,
              color: Colors.white,
            ),
            textAlign: TextAlign.justify,
          ),
        ),
      ),
    );
  }

  Future<void> fetchContactsDispos() async {
    setState(() {
      nombreContactDispo = 0;
    });
    final url = Uri.parse('$generalRouteForApi/getContactActuUser/$uidUser');

    final response = await http.get(url);

    if (response.statusCode == 200) {
      final jsonData = jsonDecode(response.body) as List<dynamic>;

      final contactsDispo = jsonData.map((data) {
        return ContactsDispo(
          id: data['id'],
          uid: data['uid'],
          pseudo: data['pseudo'],
          pays: data['pays'],
          tel: data['tel'],
        );
      }).toList();

      setState(() {
        _contactsDispo = contactsDispo;
        nombreContactDispo = contactsDispo.length;
      });
    }
  }

  void addUserContact(ContactsDispo contact, context) async {
    removeContact(contact);
    var request = http.MultipartRequest(
        'POST', Uri.parse('$generalRouteForApi/addUserContact'));
    request.fields.addAll({
      'uid': uidUser,
      'langUserPhone': langUserPhone.toString(),
      'tel': contact.tel
    });

    http.StreamedResponse response = await request.send();

    if (response.statusCode == 200) {
      var data1 = await response.stream.bytesToString();
      var data = jsonDecode(data1);
      if (data["error"] == true) {
        permissionAdd = data["permissionAdd"];
        if (permissionAdd == false) {
          setState(() {
            permissionAdd = false;
            messageErreurPermissionAdd = data["messageErreurPermissionAdd"];
          });
          // tu a deja depasser
          insertContactAtTop(contact);
          _showMessagePasPermiAdd(messageErreurPermissionAdd, context);
        }
      } else {
        insertContact(contact);
        ScaffoldMessenger.of(context).showSnackBar(SnackBar(
          content: Text((langUserPhone == "fr")
              ? 'ADD  ${contact.pseudo} avec succès.'
              : 'ADD  ${contact.pseudo} successfully.'),
          duration: const Duration(milliseconds: 500),
        ));
      }
    }
  }

  void insertContact(ContactsDispo contact) async {
    if ((await SQLHelper.getOneNumsTelUser(contact.tel)).isEmpty) {
      final newContact = Contact()
        ..name.first = "${contact.pseudo} #DS"
        ..phones = [Phone(contact.tel)];
      await newContact.insert();
      await insertNumTelUserIntoDataBase(contact.tel);
    }
  }

  void removeContact(ContactsDispo contact) {
    setState(() {
      _contactsDispo.remove(contact);
      nombreContactDispo = _contactsDispo.length;
    });
  }

  void insertContactAtTop(ContactsDispo contact) {
    setState(() {
      _contactsDispo.insert(0, contact);
      nombreContactDispo = _contactsDispo.length;
      print(nombreContactDispo);
    });
  }

  @override
  void initState() {
    super.initState();
    fetchContactsDispos();
  }

  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        elevation: 0,
        backgroundColor: primaryColor,
        title: Text(
          (langUserPhone == "fr")
              ? "Contact(s) Dispo ($nombreContactDispo)"
              : "Contact(s) Available ($nombreContactDispo)",
          style: GoogleFonts.poppins(
            fontWeight: FontWeight.w600,
          ),
        ),
        actions: [
          PopupMenuButton<int>(
            itemBuilder: (context) => [
              PopupMenuItem(
                value: 1,
                onTap: () {
                  _loading ? '' : fetchContactsDispos();
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
            ],
            offset: const Offset(0, 60),
            color: primaryColor,
            icon: const Icon(
              Icons.menu,
              color: Colors.white,
            ),
            elevation: 2,
            onSelected: (value) {
              // to execute code
            },
          ),
        ],
      ),
      body: _contactsDispo.isEmpty
          ? const Center(
              child: CircularProgressIndicator(),
            )
          : ListView.builder(
              itemCount: _contactsDispo.length,
              itemBuilder: (BuildContext context, int index) {
                final contact = _contactsDispo[index];

                return Container(
                  margin: const EdgeInsets.only(
                      left: 10, top: 10, right: 10, bottom: 0),
                  child: Row(
                    children: [
                      Container(
                        height: 60,
                        width: 60,
                        decoration: BoxDecoration(
                          gradient: const LinearGradient(
                            begin: Alignment.topCenter,
                            end: Alignment.bottomCenter,
                            colors: [
                              Colors.white,
                              Colors.indigoAccent,
                              Colors.indigo,
                            ],
                          ),
                          borderRadius: BorderRadius.circular(10),
                        ),
                        child: Column(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: [
                            CircleAvatar(
                              backgroundImage:
                                  AssetImage("images-pays/${contact.pays}.png"),
                            ),
                            const SizedBox(height: 3),
                            Text(
                              contact.pays,
                              style: const TextStyle(
                                color: Colors.white,
                                fontSize: 8,
                              ),
                            ),
                          ],
                        ),
                      ),
                      const SizedBox(width: 5),
                      Expanded(
                        child: Container(
                          // width: 80,
                          height: 60,
                          decoration: BoxDecoration(
                            gradient: const LinearGradient(
                              begin: Alignment.topCenter,
                              end: Alignment.bottomRight,
                              colors: [
                                Colors.indigo,
                                Colors.indigoAccent,
                                Colors.white,
                                Colors.white,
                                Colors.white,
                              ],
                            ),
                            borderRadius: BorderRadius.circular(10),
                          ),
                          padding: const EdgeInsets.fromLTRB(15, 0, 15, 0),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              const SizedBox(height: 5),
                              Row(
                                mainAxisAlignment:
                                    MainAxisAlignment.spaceBetween,
                                children: [
                                  Text(
                                    contact.pseudo,
                                    style: const TextStyle(
                                      fontSize: 14,
                                      fontWeight: FontWeight.bold,
                                    ),
                                  ),
                                  ElevatedButton.icon(
                                    style: ElevatedButton.styleFrom(
                                      backgroundColor: primaryColor,
                                    ),
                                    label: Text(
                                      (langUserPhone == "fr")
                                          ? 'Enregistrer'
                                          : 'Save',
                                      style: const TextStyle(
                                        fontSize: 13,
                                        fontWeight: FontWeight.bold,
                                      ),
                                    ),
                                    icon: const Icon(
                                      Icons.person_add,
                                      size: 13,
                                    ),
                                    onPressed: () {
                                      addUserContact(contact, context);
                                    },
                                  ),
                                ],
                              ),
                            ],
                          ),
                        ),
                      ),
                    ],
                  ),
                );
              },
            ),
    );
  }
}
