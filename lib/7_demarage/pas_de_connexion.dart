import 'dart:io';

import 'package:dressur/main.dart';
import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:flutter_local_notifications_platform_interface/src/types.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/delayed_animation.dart';
import 'package:dressur/7_demarage/welcome_page.dart';

class NoConnexionPage extends StatelessWidget {
  const NoConnexionPage({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return const Scaffold(
      backgroundColor: Colors.white,
      body: PageDepart(),
    );
  }
}

class PageDepart extends StatefulWidget {
  const PageDepart({Key? key}) : super(key: key);

  @override
  State<PageDepart> createState() => _PageDepartState();
}

class _PageDepartState extends State<PageDepart> {

NotificationAppLaunchDetails? notificationAppLaunchDetails;

  Future<bool> _onWillPop() async {
    return (await showDialog(
          context: context,
          builder: (context) => AlertDialog(
            title: (langUserPhone == "fr")
                ? const Text('Êtes-vous sûr?')
                : const Text('Are you sure?'),
            content: (langUserPhone == "fr")
                ? const Text("Voulez-vous quitter l'application ?")
                : const Text("Do you want to quit the application ?"),
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
  Widget build(BuildContext context) {
    return WillPopScope(
      onWillPop: _onWillPop,
      child: Scaffold(
        appBar: AppBar(
          automaticallyImplyLeading: false,
          elevation: 0,
          backgroundColor: Colors.white,
        ),
        body: SingleChildScrollView(
          child: Container(
            height: MediaQuery.of(context).size.height * 1,
            color: Colors.white,
            child: Column(
              children: [
                DelayedAnimation(
                  delay: 500,
                  child: SizedBox(
                    height: MediaQuery.of(context).size.height * 0.25,
                    child: Image.asset("images/giphy.gif"),
                  ),
                ),
                DelayedAnimation(
                  delay: 1000,
                  child: SizedBox(
                    height: MediaQuery.of(context).size.height * 0.25,
                    child: Image.asset("images/ds_img_11.png"),
                  ),
                ),
                const SizedBox(height: 20),
                DelayedAnimation(
                  delay: 1000,
                  child: SizedBox(
                    child: Text(
                      (langUserPhone == "fr")
                          ? "Vous n'ètes pas connecté à internet."
                          : "You are not connected to the internet.",
                      style: GoogleFonts.poppins(
                        fontWeight: FontWeight.w600,
                        color: Colors.black,
                      ),
                    ),
                  ),
                ),
                const SizedBox(height: 20),
                DelayedAnimation(
                    delay: 1000, // 2500,
                    child: SizedBox(
                      width: MediaQuery.of(context).size.width * 0.90,
                      child: ElevatedButton(
                        style: ElevatedButton.styleFrom(
                          backgroundColor: const Color.fromARGB(255, 199, 6, 6),
                          shape: const StadiumBorder(),
                          padding: const EdgeInsets.symmetric(
                            horizontal: 100,
                            vertical: 13,
                          ),
                          minimumSize: const Size.fromHeight(50),
                        ),
                        child: Text(
                          (langUserPhone == "fr")
                              ? "Réessayer..."
                              : "Try again...",
                          style: GoogleFonts.poppins(
                            color: Colors.white,
                            fontSize: 16,
                            fontWeight: FontWeight.w600,
                          ),
                        ),
                        onPressed: () {
                          Navigator.of(context).push(MaterialPageRoute(
                              builder: (context) => WelcomePage(notificationAppLaunchDetails)));
                        },
                      ),
                    )),
                DelayedAnimation(
                  delay: 1000,
                  child: Container(
                    margin: const EdgeInsets.all(20),
                  ),
                ),
                const SizedBox(height: 20),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
