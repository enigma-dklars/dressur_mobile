import 'package:flutter/material.dart';
import 'package:flutter_test/flutter_test.dart';

import 'package:dressur/7_demarage/presentation_ds.dart' as presentation;
import 'package:dressur/7_demarage/startup_session_actions.dart';
import 'package:dressur/components/constant.dart';

void main() {
  testWidgets(
    'clears the cached user state before opening login choices',
    (tester) async {
      uidUser = 'stale-user';
      name_complete = 'Stale User';
      admin = true;

      var clearCalls = 0;
      final navigatorKey = GlobalKey<NavigatorState>();
      final actions = StartupSessionActions(
        clearSession: () async {
          clearCalls++;
        },
      );

      await tester.pumpWidget(
        MaterialApp(
          navigatorKey: navigatorKey,
          home: const Scaffold(body: SizedBox.shrink()),
        ),
      );

      await actions.clearAndOpenAuthChoices(navigatorKey.currentState!);
      await tester.pumpAndSettle();

      expect(clearCalls, 1);
      expect(uidUser, isNull);
      expect(name_complete, isNull);
      expect(admin, isFalse);
      expect(find.byType(presentation.WelcomePage), findsOneWidget);
      expect(find.text('Connexion'), findsOneWidget);
      expect(find.text('Inscription'), findsOneWidget);
    },
  );
}