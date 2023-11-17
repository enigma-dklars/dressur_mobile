import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:whatsperson/components/constant.dart';
import 'package:whatsperson/components/delayed_animation.dart';
import 'package:whatsperson/9_demarage/welcome_page.dart';

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
  Future<bool> _onWillPop() async {
    return false;
  }

  @override
  Widget build(BuildContext context) {
    return WillPopScope(
      onWillPop: _onWillPop,
      child: SingleChildScrollView(
        child: Container(
          margin: const EdgeInsets.only(top: 20, bottom: 0),
          child: Column(
            children: [
              SizedBox(
                height: MediaQuery.of(context).size.height * 0.10,
              ),
              DelayedAnimation(
                delay: 500,
                child: SizedBox(
                  height: MediaQuery.of(context).size.height * 0.25,
                  child: Image.asset("images/giphy.gif"),
                ),
              ),
              DelayedAnimation(
                delay: 3000,
                child: SizedBox(
                  height: MediaQuery.of(context).size.height * 0.25,
                  child: Image.asset("images/wp_img_11.png"),
                ),
              ),
              const SizedBox(height: 20),
              DelayedAnimation(
                delay: 3000,
                child: SizedBox(
                  child: Text(
                    (langUserPhone == "fr") ? "Vous n'ètes pas connecté à internet." : "You are not connected to the internet.",
                    style: GoogleFonts.poppins(fontWeight: FontWeight.w600),
                  ),
                ),
              ),
              const SizedBox(height: 20),
              DelayedAnimation(
                  delay: 5000, // 2500,
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
                        (langUserPhone == "fr") ? "Réessayer..." : "Try again...",
                        style: GoogleFonts.poppins(
                          fontSize: 16,
                          fontWeight: FontWeight.w600,
                        ),
                      ),
                      onPressed: () {
                        Navigator.of(context).push(MaterialPageRoute(
                            builder: (context) => const WelcomePage()));
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
    );
  }
}
