// ignore_for_file: use_build_context_synchronously

import 'dart:io';
import 'package:flutter/material.dart';
import 'package:flutter_local_notifications/flutter_local_notifications.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:permission_handler/permission_handler.dart';
import 'package:dressur/7_demarage/update_app_important.dart';
import 'package:dressur/7_demarage/presentation_ds.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/sql_helper.dart';
import 'package:dressur/components/noti.dart';
import 'package:dressur/components/bottomBar.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;

class WelcomePage extends StatelessWidget {
  const WelcomePage(this.notificationAppLaunchDetails, {Key? key})
      : super(key: key);
  static const String routeName = '/';
  final NotificationAppLaunchDetails? notificationAppLaunchDetails;
  bool get didNotificationLaunchApp =>
      notificationAppLaunchDetails?.didNotificationLaunchApp ?? false;

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
  Future<Future<Object?>> directConnect() async {
    setState(() {
      if (langUserPhone != "fr") {
        textChargementEvolution = "Loading ...";
      } else {
        textChargementEvolution = "Chargement ...";
      }
    });

    /**
     * verification de la version de l'application
     */
    var request = http.MultipartRequest(
        'POST', Uri.parse('$generalRouteForApi/getVersionApp'));
    request.fields.addAll({});
    http.StreamedResponse response = await request.send();
    if (response.statusCode == 200) {
      var data1 = await response.stream.bytesToString();
      var data = convert.jsonDecode(data1);
      if (data["error"] == false) {
        if (data["importantUpdate"] == true) {
          myDressurVersion = data["versionApp"];
          if (int.parse(versionApp.toString().replaceAll(".", "")) <
              int.parse(myDressurVersion.toString().replaceAll(".", ""))) {
            return Navigator.of(context).push(MaterialPageRoute(
                builder: (context) => const ImportantUpdate()));
          }
        }
      }
    }

    try {
      /**
       * voir si le user est deja dans la base de donné principal
       */
      try {
        var __yo_uidUser = (await SQLHelper.getUidUser())[0]['uid'];
        setState(() {
          if (__yo_uidUser.toString().isNotEmpty) {
            uidUser = __yo_uidUser;
          }
        });
      } catch (e) {
        /**
         * voir si le user est deja dans la base de donné ancienne
         */
        try {
          var __yo_uidUser = (await SQLHelper.getUidUserOld())[0]['uid'];

          setState(() {
            if (__yo_uidUser.toString().isNotEmpty) {
              uidUser = __yo_uidUser;
            }
          });
        } catch (e) {}
      }
    } on SocketException catch (_) {}

    if (uidUser != null && uidUser.toString().isNotEmpty) {
      setState(() {
        if (langUserPhone != "fr") {
          textChargementEvolution = "Login ...";
        } else {
          textChargementEvolution = "Connexion ...";
        }
      });

      await getUserInfo();

      setState(() {
        if (langUserPhone != "fr") {
          textChargementEvolution = "Initialization Finish";
        } else {
          textChargementEvolution = "Initialisation Terminer";
        }
      });
      final numsTelUser = await SQLHelper.getAll("numsTelUser");
      if (numsTelUser.isEmpty) {
        setState(() {
          modeReconnaissanceContactArrierePlan = true;
        });
        return Navigator.of(context)
            .push(MaterialPageRoute(builder: (context) => const BottomBar()));
      } else {
        return Navigator.of(context)
            .push(MaterialPageRoute(builder: (context) => const BottomBar()));
      }
    } else {
      _askPermissions();

      return Navigator.of(context)
          .push(MaterialPageRoute(builder: (context) => PresentationPage()));
    }
  }

  Future<void> getUserInfo() async {
    setState(() {
      if (langUserPhone != "fr") {
        textChargementEvolution = "Initialization ...";
      } else {
        textChargementEvolution = "Initialisation ...";
      }
    });

    var request = http.MultipartRequest(
        'POST', Uri.parse('$generalRouteForApi/getUserInfo'));
    request.fields
        .addAll({'uid': uidUser, 'langUserPhone': langUserPhone.toString()});

    http.StreamedResponse response = await request.send();

    if (response.statusCode == 200) {
      var data1 = await response.stream.bytesToString();
      var data = convert.jsonDecode(data1);
      if (data["error"] == false) {
        await initUserInformations(data["user"]);
      } else {
        Navigator.of(context)
            .push(MaterialPageRoute(builder: (context) => PresentationPage()));
      }
    }
  }

  Future<void> _askPermissions([String? routeName]) async {
    // permission contact
    PermissionStatus permissionStatus = await _getContactPermission();
    if (permissionStatus == PermissionStatus.granted) {
      insertDressurContact();
    } else {
      _handleInvalidPermissions(permissionStatus);
    }

    // permission memoire stockage
    PermissionStatus permissionStatusStockageMemoire =
        await _getStockageMemoirePermission();
    if (permissionStatusStockageMemoire == PermissionStatus.granted) {
      // OK
    } else {
      _handleInvalidPermissionsStockageMemoire(permissionStatusStockageMemoire);
    }

    // permission camera
    PermissionStatus permissionStatusCamera = await _getCameraPermission();
    if (permissionStatusCamera == PermissionStatus.granted) {
      // OK
    } else {
      _handleInvalidPermissionsCamera(permissionStatusCamera);
    }

    // permission camera
    PermissionStatus permissionStatusAlarm = await _getAlarmPermission();
    if (permissionStatusAlarm == PermissionStatus.granted) {
      // OK
    } else {
      _handleInvalidPermissionsAlarm(permissionStatusAlarm);
    }
  }

  Future<PermissionStatus> _getContactPermission() async {
    PermissionStatus permission = await Permission.contacts.status;
    // permission != PermissionStatus.granted && permission != PermissionStatus.permanentlyDenied
    if (permission != PermissionStatus.granted) {
      PermissionStatus permissionStatus = await Permission.contacts.request();
      return permissionStatus;
    } else {
      return permission;
    }
  }

  Future<PermissionStatus> _getStockageMemoirePermission() async {
    PermissionStatus permission = await Permission.storage.status;
    // permission != PermissionStatus.granted && permission != PermissionStatus.permanentlyDenied
    if (permission != PermissionStatus.granted) {
      PermissionStatus permissionStatusStockageMemoire =
          await Permission.storage.request();
      return permissionStatusStockageMemoire;
    } else {
      return permission;
    }
  }

  Future<PermissionStatus> _getCameraPermission() async {
    PermissionStatus permission = await Permission.camera.status;
    // permission != PermissionStatus.granted && permission != PermissionStatus.permanentlyDenied
    if (permission != PermissionStatus.granted) {
      PermissionStatus permissionStatus = await Permission.camera.request();
      return permissionStatus;
    } else {
      return permission;
    }
  }

  Future<PermissionStatus> _getAlarmPermission() async {
    PermissionStatus permission = await Permission.camera.status;
    // permission != PermissionStatus.granted && permission != PermissionStatus.permanentlyDenied
    if (permission != PermissionStatus.granted) {
      PermissionStatus permissionStatus =
          await Permission.scheduleExactAlarm.request();
      return permissionStatus;
    } else {
      return permission;
    }
  }

  void _handleInvalidPermissions(PermissionStatus permissionStatus) {
    if (permissionStatus != PermissionStatus.granted) {
      if (langUserPhone != "fr") {
        warningNoti(
            "Attention !",
            "Please allow Dressur to automatically save contacts to your phone.\nThis authorization is necessary to take full advantage of our features.",
            context);
      } else {
        warningNoti(
            "Attention !",
            "Veuillez autoriser Dressur a enregistrer automatiquement les contacts dans votre téléphone.\nCette autorisation est nécéssaire pour profiter pleinement de nos fonctionnalités.",
            context);
      }
    }
  }

  void _handleInvalidPermissionsStockageMemoire(
      PermissionStatus permissionStatusStockageMemoire) {
    if (permissionStatusStockageMemoire != PermissionStatus.granted) {
      if (langUserPhone != "fr") {
        warningNoti(
            "Attention !",
            "Please allow Dressur has accessed your images from your phone for your future deal boosts.\nThis authorization is necessary to take full advantage of our features.",
            context);
      } else {
        warningNoti(
            "Attention !",
            "Veuillez autoriser Dressur a accédé à vos images de votre téléphone pour vos futurs boosts affaire.\nCette autorisation est nécéssaire pour profiter pleinement de nos fonctionnalités.",
            context);
      }
    }
  }

  void _handleInvalidPermissionsCamera(PermissionStatus permissionStatus) {
    if (permissionStatus != PermissionStatus.granted) {
      if (langUserPhone != "fr") {
        warningNoti(
            "Attention !",
            "Please authorize Dressur to access your camera for scanning QR codes and automatically saving contacts to your phone.\nThis authorization is necessary to take full advantage of our features.",
            context);
      } else {
        warningNoti(
            "Attention !",
            "Veuillez autoriser Dressur à accéder à votre caméra pour le scannage des codes QR et l'enregistrement automatiquement des contacts dans votre téléphone.\nCette autorisation est nécessaire pour profiter pleinement de nos fonctionnalités.",
            context);
      }
    }
  }

  void _handleInvalidPermissionsAlarm(PermissionStatus permissionStatus) {
    if (permissionStatus != PermissionStatus.granted) {
      if (langUserPhone != "fr") {
        warningNoti(
            "Attention !",
            "Veuillez autoriser Dressur à vous notifier les enregistrements automatiques de contact ainsi que votre messagerie.\nThis authorization is necessary to take full advantage of our features.",
            context);
      } else {
        warningNoti(
            "Attention !",
            "Veuillez autoriser Dressur à vous notifier les enregistrements automatiques de contact ainsi que votre messagerie.\nCette autorisation est nécessaire pour profiter pleinement de nos fonctionnalités.",
            context);
      }
    }
  }

  @override
  void initState() {
    super.initState();
    directConnect();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        automaticallyImplyLeading: false,
        elevation: 0,
        backgroundColor: primaryColor,
      ),
      backgroundColor: primaryColor,
      body: Align(
        alignment: Alignment.topCenter,
        child: SizedBox(
          width: MediaQuery.of(context).size.width * 0.80,
          child: ConstrainedBox(
            constraints: const BoxConstraints(
              maxWidth: 1024,
            ),
            child: LayoutBuilder(
              builder: (context, constraints) {
                return Column(
                  mainAxisAlignment: MainAxisAlignment.center,
                  crossAxisAlignment: CrossAxisAlignment.center,
                  children: [
                    LogoAnimation(),
                    Text(
                      textChargementEvolution,
                      style: GoogleFonts.poppins(
                        fontWeight: FontWeight.w300,
                        fontSize: 20,
                        color: Colors.white,
                      ),
                      textAlign: TextAlign.center,
                    ),
                  ],
                );
              },
            ),
          ),
        ),
      ),
    );
  }
}

class LogoAnimation extends StatefulWidget {
  @override
  _LogoAnimationState createState() => _LogoAnimationState();
}

class _LogoAnimationState extends State<LogoAnimation>
    with SingleTickerProviderStateMixin {
  late AnimationController _animationController;
  late Animation<double> _animation;

  @override
  void initState() {
    super.initState();
    _animationController = AnimationController(
      vsync: this,
      duration: const Duration(seconds: 3),
    );
    _animation = Tween<double>(begin: 0.3, end: 1.0).animate(
      CurvedAnimation(
        parent: _animationController,
        curve: Curves.easeInOut,
      ),
    );
    _animationController.repeat(reverse: true);
  }

  @override
  void dispose() {
    _animationController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Center(
      child: AnimatedBuilder(
        animation: _animationController,
        builder: (BuildContext context, Widget? child) {
          return Transform.scale(
            scale: _animation.value,
            child: Image.asset(
              'images/dressur_logo.png',
              width: 300,
              height: 300,
            ),
          );
        },
      ),
    );
  }
}
