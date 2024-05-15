// ignore_for_file: unnecessary_null_comparison, prefer_const_constructors

import 'dart:async';

import 'package:flutter/material.dart';
import 'package:flutter/rendering.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/5_autre/support_assistance.dart';
import 'package:dressur/components/constant.dart';

class ListeNotification extends StatefulWidget {
  @override
  State<ListeNotification> createState() => _ListeNotificationState();
}

class _ListeNotificationState extends State<ListeNotification> {
  final ValueNotifier<bool> _showFabText = ValueNotifier(true);
  final ScrollController _scrollController = ScrollController();
  List<Map<String, dynamic>> historiqueContactsAdd = [];
  Timer? _timer;

  @override
  void initState() {
    super.initState();
  }

  Future<void> _refreshData() async {
    setState(() {
      // actualise();
    });
  }

  void dispose() {
    _scrollController.removeListener(_scrollListener);
    _scrollController.dispose();

    _showFabText.dispose();
    // Arrête le timer lors de la suppression du widget
    _stopTimer();
    super.dispose();
  }

  void _scrollListener() {
    if (_scrollController.position.userScrollDirection ==
        ScrollDirection.reverse) {
      _showFabText.value = false;
    } else if (_scrollController.position.atEdge &&
        _scrollController.position.pixels == 0) {
      _showFabText.value = true;
    }
  }

  void _startTimer() {
    // Crée un nouveau timer qui exécute la fonction everySecond toutes les secondes
    _timer = Timer.periodic(Duration(seconds: 1), (timer) {
      everySecond();
    });
  }

  void _stopTimer() {
    // Arrête et annule le timer
    _timer?.cancel();
    _timer = null;
  }

  void everySecond() {
    // Code à exécuter toutes les secondes
    setState(() {
      nombreContactDispo = nombreContactDispo;
    });
  }

  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        elevation: 0,
        backgroundColor: primaryColor,
        title: Text(
          "Notifications",
          style: GoogleFonts.poppins(
            fontWeight: FontWeight.w400,
            color: Colors.white,
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
        actions: [
          PopupMenuButton<int>(
            itemBuilder: (context) => [
              PopupMenuItem(
                value: 4,
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
            icon: const Icon(
              Icons.menu,
              color: Colors.white,
            ),
            elevation: 2,
            onSelected: (value) {
              if (value == 4) {
                Navigator.push(
                  context,
                  MaterialPageRoute(
                    builder: (context) => SupportPage(),
                  ),
                );
              }
            },
          ),
        ],
      ),
      body: Center(
        child: Text(
          (langUserPhone == "fr")
              ? "Aucune notification reçue"
              : "No notifications received",
          style: const TextStyle(fontSize: 16),
        ),
      ),
    );
  }
}
