import 'package:dressur/components/permission_recovery_dialog.dart';
import 'package:flutter/material.dart';
import 'package:flutter_test/flutter_test.dart';

void main() {
  Future<void> pumpDialog(
    WidgetTester tester, {
    required bool showSettingsAction,
    required ValueChanged<PermissionRecoveryAction> onAction,
  }) async {
    await tester.pumpWidget(
      MaterialApp(
        home: Scaffold(
          body: PermissionRecoveryDialog(
            title: 'Accès aux photos requis',
            message: 'Dressur a besoin de vos photos pour choisir une image.',
            isFrench: true,
            showSettingsAction: showSettingsAction,
            onAction: onAction,
          ),
        ),
      ),
    );
  }

  testWidgets('simple denial offers retry and cancel only', (tester) async {
    final actions = <PermissionRecoveryAction>[];

    await pumpDialog(tester, showSettingsAction: false, onAction: actions.add);

    expect(find.text('Accès aux photos requis'), findsOneWidget);
    expect(
      find.text('Dressur a besoin de vos photos pour choisir une image.'),
      findsOneWidget,
    );
    expect(find.text('Réessayer'), findsOneWidget);
    expect(find.text('Annuler'), findsOneWidget);
    expect(find.text('Ouvrir les réglages'), findsNothing);

    await tester.tap(find.text('Réessayer'));
    expect(actions, [PermissionRecoveryAction.retry]);
  });

  testWidgets('permanent denial offers settings, retry and cancel', (
    tester,
  ) async {
    final actions = <PermissionRecoveryAction>[];

    await pumpDialog(tester, showSettingsAction: true, onAction: actions.add);

    expect(find.text('Réessayer'), findsOneWidget);
    expect(find.text('Annuler'), findsOneWidget);
    expect(find.text('Ouvrir les réglages'), findsOneWidget);

    await tester.tap(find.text('Ouvrir les réglages'));
    expect(actions, [PermissionRecoveryAction.openSettings]);
  });
}
