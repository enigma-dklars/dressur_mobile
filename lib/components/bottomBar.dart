import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:flutter/material.dart';
import 'package:flutter_contacts/flutter_contacts.dart';
import 'package:whatsperson/1_contact/liste_contact.dart';
import 'package:whatsperson/2_boost/boost_contact_affaire.dart';
import 'package:whatsperson/3_add/add.dart';
import 'package:whatsperson/4_preference/preference.dart';
import 'package:whatsperson/5_autre/menu_autre_page.dart';
import 'package:whatsperson/components/constant.dart';
import 'package:whatsperson/components/sql_helper.dart';

class BottomBar extends StatefulWidget {
  const BottomBar({Key? key}) : super(key: key);

  @override
  State<BottomBar> createState() => _BottomBarState();
}

class _BottomBarState extends State<BottomBar> {
  int _selectedIndex = 2;
  bool lang_en = false;
  dynamic screens = [];
  Future<void> fetchContactWPs() async {
    setState(() {
      contactsEnregistrer = [];
    });
    final url =
        Uri.parse('$generalRouteForApi/listContactWP/$uidUser/$langUserPhone');
    final response = await http.get(url);
    if (response.statusCode == 200) {
      final jsonData = jsonDecode(response.body) as List<dynamic>;
      if (jsonData.isNotEmpty) {
        for (var contact in jsonData) {
          if (contact['tel'] != "+22960330478" &&
              contact['tel'] != "22960330478" &&
              contact['tel'] != "60330478" &&
              !contactsEnregistrer.contains(contact['tel'])) {
            contactsEnregistrer.add(contact['tel']);
          }
          if ((await SQLHelper.getOneNumsTelUser(contact['tel'])).isEmpty) {
            final newContact = Contact()
              ..name.first = contact["pseudo"] + " #WP"
              ..phones = [Phone(contact["tel"])];
            await newContact.insert();
            await insertNumTelUserIntoDataBase(contact["tel"]);
          }
        }
      }
    }
  }

  void initNavigationTitle() {
    screens = [
      ContactPage(),
      BoostPage(),
      ActuPage(),
      PreferencePage(),
      SettingPage(),
    ];
  }

  @override
  void initState() {
    super.initState();
    // SQLHelper.viderLaBaseDeDonneeLocalTelUser();
    initNavigationTitle();
    fetchContactWPs();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      bottomNavigationBar: buildBottomNavigationBar(),
      body: screens[_selectedIndex],
    );
  }

  buildBottomNavigationBar() {
    return (langUserPhone != "fr")
        ? ClipRRect(
            borderRadius: const BorderRadius.only(
              topLeft: Radius.circular(10),
              topRight: Radius.circular(10),
            ),
            child: BottomNavigationBar(
              type: BottomNavigationBarType.fixed,
              backgroundColor: primaryColor,
              unselectedItemColor: Colors.white70,
              selectedItemColor: Colors.white,
              selectedFontSize: 16,
              currentIndex: _selectedIndex,
              onTap: (value) {
                setState(() {
                  _selectedIndex = value;
                });
              },
              items: const [
                BottomNavigationBarItem(
                  icon: Icon(Icons.call),
                  label: "Contact",
                  backgroundColor: Colors.brown,
                ),
                BottomNavigationBarItem(
                  icon: Icon(Icons.move_up),
                  label: "B & P",
                  backgroundColor: primaryColor,
                ),
                BottomNavigationBarItem(
                  icon: Icon(Icons.person_add),
                  label: "Add",
                  backgroundColor: Colors.blue,
                ),
                BottomNavigationBarItem(
                  icon: Icon(Icons.hearing_outlined),
                  label: "Preferences",
                  backgroundColor: Colors.teal,
                ),
                BottomNavigationBarItem(
                  icon: Icon(Icons.settings),
                  label: "Other...",
                  backgroundColor: Colors.grey,
                ),
              ],
            ),
          )
        : ClipRRect(
            borderRadius: const BorderRadius.only(
              topLeft: Radius.circular(10),
              topRight: Radius.circular(10),
            ),
            child: BottomNavigationBar(
              type: BottomNavigationBarType.fixed,
              backgroundColor: primaryColor,
              unselectedItemColor: Colors.white70,
              selectedItemColor: Colors.white,
              selectedFontSize: 16,
              currentIndex: _selectedIndex,
              onTap: (value) {
                setState(() {
                  _selectedIndex = value;
                });
              },
              items: const [
                BottomNavigationBarItem(
                  icon: Icon(Icons.call),
                  label: "Contact",
                  backgroundColor: Colors.brown,
                ),
                BottomNavigationBarItem(
                  icon: Icon(Icons.move_up),
                  label: "B & P",
                  backgroundColor: primaryColor,
                ),
                BottomNavigationBarItem(
                  icon: Icon(Icons.person_add),
                  label: "Add",
                  backgroundColor: Colors.blue,
                ),
                BottomNavigationBarItem(
                  icon: Icon(Icons.hearing_outlined),
                  label: "Préférences",
                  backgroundColor: Colors.teal,
                ),
                BottomNavigationBarItem(
                  icon: Icon(Icons.settings),
                  label: "Autre...",
                  backgroundColor: Colors.grey,
                ),
              ],
            ),
          );
  }
}
