// ignore_for_file: use_build_context_synchronously

import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/components/delayed_animation.dart';
import 'package:dressur/components/constant.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;
import 'package:dressur/components/sql_helper.dart';
import 'package:flutter/services.dart';
import 'package:dressur/components/noti.dart';
import 'package:dressur/5_autre/support_assistance.dart';

class AddFriendPage extends StatefulWidget {
  AddFriendPage({Key? key}) : super(key: key);

  @override
  State<AddFriendPage> createState() => _AddFriendPageState();
}

class _AddFriendPageState extends State<AddFriendPage> {
  bool _loading = false;
  final codeParrainController = TextEditingController();
  var codePromoController = TextEditingController();

  void addPromo(String codePromo) async {
    dynamic youHaveNetWork = "";
    youHaveConnexion();
    youHaveNetWork = await SQLHelper.getYouHaveConnexion();
    while (youHaveNetWork.length == 0) {
      youHaveNetWork = await SQLHelper.getYouHaveConnexion();
    }
    if (youHaveNetWork[0]['youHaveConnexion'] == "oui") {
      setState(() {
        _loading = true;
      });
      var request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/addBonusPromo'));
      request.fields.addAll({
        'uid': uidUser,
        'langUserPhone': langUserPhone.toString(),
        'codePromo': codePromo
      });

      http.StreamedResponse response = await request.send();

      if (response.statusCode == 200) {
        var data1 = await response.stream.bytesToString();
        var data = convert.jsonDecode(data1);
        if (data["error"] == true) {
          dangerNoti(data["titre"], data["message"], context);
          setState(() {
            _loading = false;
          });
        } else {
          setState(() {
            codePromoController.text = "";
            soldeBonus = data["soldeBonus"];
            _loading = false;
            initUserInformations(data['user']);
            Navigator.of(context).pop();
            ScaffoldMessenger.of(context).showSnackBar(const SnackBar(
              content: Text('Code Promo Accepter'),
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
          _loading = false;
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
        _loading = false;
      });
    }
  }

  void _showFormBonus(context) async {
    showModalBottomSheet(
      context: context,
      elevation: 5,
      isScrollControlled: true,
      builder: (_) => Container(
        padding: EdgeInsets.only(
          top: 15,
          left: 15,
          right: 15,
          // this will prevent the soft keyboard from covering the text fields
          bottom: MediaQuery.of(context).viewInsets.bottom + 15,
        ),
        child: Column(
          mainAxisSize: MainAxisSize.min,
          crossAxisAlignment: CrossAxisAlignment.end,
          children: [
            const SizedBox(height: 20),
            Text(
              (langUserPhone == "fr")
                  ? 'Entrer le code promo'
                  : 'Enter promo code',
              style: GoogleFonts.poppins(
                fontWeight: FontWeight.w400,
                fontSize: 16,
              ),
            ),
            const SizedBox(height: 10),
            TextField(
              controller: codePromoController,
              decoration: InputDecoration(
                labelText:
                    (langUserPhone == "fr") ? 'Code Promo' : 'Promo code',
                border: const OutlineInputBorder(),
              ),
            ),
            const SizedBox(height: 10),
            ElevatedButton(
              style: ElevatedButton.styleFrom(
                backgroundColor: primaryColor,
                padding: const EdgeInsets.symmetric(
                  horizontal: 55,
                  vertical: 13,
                ),
              ),
              onPressed: () async {
                _loading ? null : addPromo(codePromoController.text);
              },
              child: Text(
                _loading
                    ? 'Wait...'
                    : (langUserPhone == "fr")
                        ? 'Ajouter'
                        : 'Add',
                style: GoogleFonts.poppins(
                  fontWeight: FontWeight.w400,
                  color: Colors.white,
                ),
              ),
            )
          ],
        ),
      ),
    );
  }

  void _showFormParrainage(context) async {
    showModalBottomSheet(
      context: context,
      elevation: 5,
      isScrollControlled: true,
      builder: (_) => Container(
        padding: EdgeInsets.only(
          top: 15,
          left: 15,
          right: 15,
          // this will prevent the soft keyboard from covering the text fields
          bottom: MediaQuery.of(context).viewInsets.bottom + 15,
        ),
        child: Column(
          mainAxisSize: MainAxisSize.min,
          crossAxisAlignment: CrossAxisAlignment.end,
          children: [
            const SizedBox(height: 20),
            Text(
              (langUserPhone == "fr")
                  ? 'Entrer le code reçu de votre parrain'
                  : 'Enter the code received from your sponsor',
              style: GoogleFonts.poppins(
                fontWeight: FontWeight.w400,
                fontSize: 16,
              ),
            ),
            const SizedBox(height: 10),
            TextField(
              controller: codeParrainController,
              decoration: InputDecoration(
                labelText: (langUserPhone == "fr")
                    ? 'Code de Parrainage'
                    : 'Referral Code',
                border: const OutlineInputBorder(),
              ),
            ),
            const SizedBox(height: 10),
            ElevatedButton(
              style: ElevatedButton.styleFrom(
                backgroundColor: primaryColor,
                padding: const EdgeInsets.symmetric(
                  horizontal: 55,
                  vertical: 13,
                ),
              ),
              onPressed: () async {
                _loading ? null : addParrain(codeParrainController.text);
              },
              child: Text(
                (langUserPhone == "fr") ? 'Ajouter' : 'Add',
                style: GoogleFonts.poppins(
                  fontWeight: FontWeight.w400,
                  color: Colors.white,
                ),
              ),
            )
          ],
        ),
      ),
    );
  }

  void addParrain(String codeBonus) async {
    dynamic youHaveNetWork = "";
    youHaveConnexion();
    youHaveNetWork = await SQLHelper.getYouHaveConnexion();
    while (youHaveNetWork.length == 0) {
      youHaveNetWork = await SQLHelper.getYouHaveConnexion();
    }
    if (youHaveNetWork[0]['youHaveConnexion'] == "oui") {
      setState(() {
        _loading = true;
      });

      var request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/addParrain'));
      request.fields.addAll({
        'uid': uidUser,
        'langUserPhone': langUserPhone.toString(),
        'codeBonus': codeBonus
      });

      http.StreamedResponse response = await request.send();

      if (response.statusCode == 200) {
        var data1 = await response.stream.bytesToString();
        var data = convert.jsonDecode(data1);
        if (data["error"] == true) {
          setState(() {
            _loading = false;
          });
          dangerNoti(data["titre"], data["message"], context);
        } else {
          setState(() {
            _loading = false;
            siParrain = true;
            initUserInformations(data['user']);
          });
          Navigator.of(context).pop();
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
          _loading = false;
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
        _loading = false;
      });
    }
  }

  void actualiseNombreInvite() async {
    ScaffoldMessenger.of(context).showSnackBar(SnackBar(
      behavior: SnackBarBehavior.floating,
      content: Text(
        (langUserPhone == "fr")
            ? 'Actualisation en cours…'
            : 'Update in progress…',
      ),
    ));
    dynamic youHaveNetWork = "";
    youHaveConnexion();
    youHaveNetWork = await SQLHelper.getYouHaveConnexion();
    while (youHaveNetWork.length == 0) {
      youHaveNetWork = await SQLHelper.getYouHaveConnexion();
    }
    if (youHaveNetWork[0]['youHaveConnexion'] == "oui") {
      setState(() {
        _loading = true;
      });
      var request = http.MultipartRequest(
          'POST',
          Uri.parse(
              '$generalRouteForApi/getUserInfo/$uidAutreUser/$langUserPhone'));
      request.fields
          .addAll({'uid': uidUser, 'langUserPhone': langUserPhone.toString()});

      http.StreamedResponse response = await request.send();

      if (response.statusCode == 200) {
        var data1 = await response.stream.bytesToString();
        var data = convert.jsonDecode(data1);
        if (data["error"] == false) {
          setState(() {
            initUserInformations(data['user']);
            _loading = false;
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
        _loading = false;
      });
    }
    ScaffoldMessenger.of(context).showSnackBar(SnackBar(
      behavior: SnackBarBehavior.floating,
      content: Text(
        (langUserPhone == "fr")
            ? 'Actualisation terminer.'
            : 'Refresh complete.',
      ),
    ));
  }

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
            (langUserPhone == "fr")
                ? "Invitez vos amis"
                : "Invite your friends",
            style: GoogleFonts.poppins(
              fontWeight: FontWeight.w400,
              color: Colors.white,
            ),
          ),
          actions: [
            PopupMenuButton<int>(
              itemBuilder: (context) => [
                PopupMenuItem(
                  value: 1,
                  onTap: () {
                    _loading ? '' : actualiseNombreInvite();
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
                PopupMenuItem(
                  value: 2,
                  child: Row(
                    children: [
                      Text(
                        (langUserPhone == "fr")
                            ? "Utiliser un code Promo"
                            : "Use Promo Code",
                        style: GoogleFonts.poppins(
                          color: Colors.white,
                          fontWeight: FontWeight.w600,
                        ),
                      ),
                    ],
                  ),
                ),
                if (siParrain == false)
                  PopupMenuItem(
                    value: 3,
                    enabled: !siParrain,
                    child: Row(
                      children: [
                        Text(
                          (langUserPhone == "fr")
                              ? "Utiliser un code Parainage"
                              : "Use a referral code",
                          style: GoogleFonts.poppins(
                            color: Colors.white,
                            fontWeight: FontWeight.w600,
                          ),
                        ),
                      ],
                    ),
                  ),
                PopupMenuItem(
                  value: 5,
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
                if (value == 2) {
                  _showFormBonus(context);
                } else if (value == 3) {
                  if (!telIsVerified) {
                    warningNoti(
                        "Configuration du compte",
                        "Patientez encore svp. Votre numéro WhatsApp n'a pas encore été confirmé par un administrateur. Il le sera dans les plus brefs délais.",
                        context);
                  } else if (!mailIsVerified) {
                    warningNoti(
                        "Configuration du compte",
                        "Veuillez d'abord confirmer votre adresse mail...\n\nVous trouverez sur notre chaine YouTube des vidéos qui peuvent vous aider...",
                        context);
                  } else {
                    _showFormParrainage(context);
                  }
                } else if (value == 5) {
                  Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) => SupportPage()),
                  );
                }
              },
            )
          ],
        ),
        body: SingleChildScrollView(
          padding: const EdgeInsets.symmetric(horizontal: 20),
          child: Column(
            children: [
              const SizedBox(height: 20),
              DelayedAnimation(
                delay: 0, // 500,
                child: SizedBox(
                  height: 200,
                  child: Image.asset("images/ds_img_9.png"),
                ),
              ),
              const SizedBox(height: 20),
              Container(
                width: MediaQuery.of(context).size.width * 1,
                decoration: BoxDecoration(
                  color: primaryColor,
                  borderRadius: BorderRadius.circular(12),
                ),
                child: Column(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    const SizedBox(height: 5),
                    RichText(
                      text: TextSpan(
                        text: (langUserPhone == "fr")
                            ? "Solde Bonus"
                            : "Bonus Balance",
                        style: GoogleFonts.poppins(
                            color: Colors.white,
                            fontSize: 12,
                            fontWeight: FontWeight.w600),
                      ),
                    ),
                    RichText(
                      text: TextSpan(
                        text: "$soldeBonus",
                        style: GoogleFonts.poppins(
                            color: Colors.white,
                            fontSize: 50,
                            fontWeight: FontWeight.w600),
                      ),
                    ),
                    RichText(
                      text: TextSpan(
                        text: "Point(s)",
                        style: GoogleFonts.poppins(
                            color: Colors.white,
                            fontSize: 12,
                            fontWeight: FontWeight.w600),
                      ),
                    ),
                    const SizedBox(height: 5),
                  ],
                ),
              ),
              const SizedBox(height: 40),
              DelayedAnimation(
                delay: 0, // 1000,
                child: Text(
                  (langUserPhone == "fr")
                      ? "Code de Parrainage"
                      : "Referral Code",
                  style: GoogleFonts.poppins(
                      color: primaryColor,
                      fontSize: 25,
                      fontWeight: FontWeight.w500),
                  textAlign: TextAlign.center,
                ),
              ),
              FormParrain()
            ],
          ),
        ));
  }
}

class FormParrain extends StatefulWidget {
  FormParrain({Key? key}) : super(key: key);

  @override
  State<FormParrain> createState() => _FormParrainState();
}

class _FormParrainState extends State<FormParrain> {
  final parrainageController = TextEditingController(text: codeBonus);
  @override
  Widget build(BuildContext context) {
    return Container(
      child: Column(
        children: [
          const SizedBox(height: 20),
          DelayedAnimation(
            delay: 0, // 2000,
            child: TextField(
              readOnly: true,
              controller: parrainageController,
              onTap: () {
                setState(() {
                  Clipboard.setData(ClipboardData(text: codeBonus));
                  ScaffoldMessenger.of(context).showSnackBar(SnackBar(
                    behavior: SnackBarBehavior.floating,
                    content: Text((langUserPhone == "fr")
                        ? 'Code de Parrainage Copier ...'
                        : 'Referral Code Copy...'),
                  ));
                });
              },
              decoration: InputDecoration(
                labelStyle: TextStyle(color: Colors.grey[400]),
                border: const OutlineInputBorder(),
                suffixIcon: IconButton(
                  icon: const Icon(
                    Icons.copy,
                  ),
                  onPressed: () {
                    setState(() {
                      Clipboard.setData(ClipboardData(text: codeBonus));
                      ScaffoldMessenger.of(context).showSnackBar(SnackBar(
                        behavior: SnackBarBehavior.floating,
                        content: Text((langUserPhone == "fr")
                            ? 'Code de Parrainage Copier ...'
                            : 'Referral Code Copy...'),
                      ));
                    });
                  },
                ),
              ),
            ),
          ),
          const SizedBox(height: 20),
          DelayedAnimation(
            delay: 0, // 1000,
            child: SizedBox(
              width: MediaQuery.of(context).size.width * 0.90,
              child: ElevatedButton.icon(
                style: ElevatedButton.styleFrom(
                  backgroundColor: primaryColor,
                  shape: const StadiumBorder(),
                  padding: const EdgeInsets.symmetric(
                    vertical: 13,
                  ),
                ),
                label: Text(
                  (langUserPhone == "fr") ? 'PARTAGER' : 'SHARE',
                  style: GoogleFonts.poppins(
                    fontWeight: FontWeight.w400,
                    color: Colors.white,
                  ),
                ),
                icon: const Icon(
                  Icons.share,
                  color: Colors.white,
                ),
                onPressed: () async {
                  shareMessageWithImage(
                      context, codeBonus, "$commissionBonus", "$langUserPhone");
                },
              ),
            ),
          ),
          const SizedBox(height: 40),
          DelayedAnimation(
            delay: 0, // 1500,
            child: Text(
              (langUserPhone == "fr")
                  ? "$nombreFilleuls invité(s)"
                  : "$nombreFilleuls referral(s)",
              style: GoogleFonts.poppins(
                  fontSize: 25, fontWeight: FontWeight.w600),
              textAlign: TextAlign.center,
            ),
          ),
          const SizedBox(height: 40),
          DelayedAnimation(
            delay: 0, // 1500,
            child: Text(
              (langUserPhone == "fr")
                  ? "RECEVEZ $commissionBonus Points PAR FILLEUL\n\nOFFREZ $commissionBonus Points A CHAQU'UN DE VOS FILLEULS"
                  : "RECEIVE $commissionBonus Points PER REFERRAL\n\nGIVE $commissionBonus Points TO EACH OF YOUR REFERRALS",
              style: GoogleFonts.poppins(
                  fontSize: 16, fontWeight: FontWeight.w600),
              textAlign: TextAlign.center,
            ),
          ),
          const SizedBox(height: 40),
        ],
      ),
    );
  }
}
