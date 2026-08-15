import 'package:flutter/material.dart';
import 'package:flutter_test/flutter_test.dart';

import 'package:dressur/5_autre/support_assistance.dart';
import 'package:dressur/7_demarage/welcome_page.dart';

void main() {
  Widget buildRecoveryPage({
    required VoidCallback onRetry,
    required VoidCallback onLogin,
  }) {
    return MaterialApp(
      home: StartupRecoveryPage(
        failure: StartupFailure.networkTimeout,
        onRetry: onRetry,
        onLogin: onLogin,
      ),
    );
  }

  testWidgets('shows a clear message when startup recovery times out',
      (tester) async {
    await tester.pumpWidget(
      buildRecoveryPage(
        onRetry: () {},
        onLogin: () {},
      ),
    );

    expect(find.text('Connexion trop lente'), findsOneWidget);
    expect(
      find.text(
        'Le serveur met trop de temps à répondre. Vérifiez votre connexion puis réessayez.',
      ),
      findsOneWidget,
    );
  });

  testWidgets('retry button invokes the retry action', (tester) async {
    var retryCalls = 0;
    await tester.pumpWidget(
      buildRecoveryPage(
        onRetry: () => retryCalls++,
        onLogin: () {},
      ),
    );

    await tester.tap(find.text('Réessayer'));
    expect(retryCalls, 1);
  });

  testWidgets('login button invokes the login action', (tester) async {
    var loginCalls = 0;
    await tester.pumpWidget(
      buildRecoveryPage(
        onRetry: () {},
        onLogin: () => loginCalls++,
      ),
    );

    await tester.tap(find.text('Se connecter'));
    expect(loginCalls, 1);
  });

  testWidgets('support button opens the assistance page', (tester) async {
    await tester.pumpWidget(
      buildRecoveryPage(
        onRetry: () {},
        onLogin: () {},
      ),
    );

    await tester.tap(find.text('Contacter l’assistance'));
    await tester.pumpAndSettle();

    expect(find.byType(SupportPage), findsOneWidget);
    expect(find.text('Support'), findsOneWidget);
  });
}