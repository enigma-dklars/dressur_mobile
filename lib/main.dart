import 'package:flutter/material.dart';
import 'package:whatsperson/9_demarage/welcome_page.dart';
import 'package:whatsperson/components/constant.dart';

void main() async {
  WidgetsFlutterBinding.ensureInitialized();
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({Key? key}) : super(key: key);

  static final ValueNotifier<ThemeMode> themeNotifier =
      ValueNotifier(ThemeMode.system);

  @override
  Widget build(BuildContext context) {
    return ValueListenableBuilder<ThemeMode>(
      valueListenable: themeNotifier,
      builder: (_, ThemeMode currentMode, __) {
        return MaterialApp(
          debugShowCheckedModeBanner: false,
          title: 'WhatsPerson',
          darkTheme: ThemeData.dark(),
          themeMode: currentMode,
          home: const WelcomePage(),
          localeResolutionCallback: (deviceLocale, supportedLocales) {
            langUserPhone = deviceLocale?.languageCode;
            return null;
          },
        );
      },
    );
  }
}
