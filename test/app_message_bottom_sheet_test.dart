import 'package:dressur/components/app_message_bottom_sheet.dart';
import 'package:flutter/material.dart';
import 'package:flutter_test/flutter_test.dart';

void main() {
  testWidgets('shows an adaptive message with a visible close action', (
    tester,
  ) async {
    await tester.pumpWidget(
      MaterialApp(
        home: Builder(
          builder: (context) {
            return Scaffold(
              body: Center(
                child: ElevatedButton(
                  onPressed: () => showAppMessageBottomSheet(
                    context,
                    type: AppMessageType.info,
                    title: 'Information',
                    message: 'Le message affiché à l’utilisateur.',
                  ),
                  child: const Text('Ouvrir'),
                ),
              ),
            );
          },
        ),
      ),
    );

    await tester.tap(find.text('Ouvrir'));
    await tester.pumpAndSettle();

    expect(find.text('Information'), findsOneWidget);
    expect(find.text('Le message affiché à l’utilisateur.'), findsOneWidget);
    expect(find.byIcon(Icons.info_rounded), findsOneWidget);
    expect(find.byTooltip('Fermer'), findsOneWidget);
    expect(find.text('Fermer'), findsOneWidget);
    expect(find.bySemanticsLabel('Poignée du panneau inférieur'), findsOneWidget);

    await tester.tap(find.text('Fermer'));
    await tester.pumpAndSettle();

    expect(find.text('Information'), findsNothing);
  });

  testWidgets('supports every public message type', (tester) async {
    for (final type in AppMessageType.values) {
      final closed = <bool>[];

      await tester.pumpWidget(
        MaterialApp(
          home: Scaffold(
            body: AppMessageBottomSheet(
              type: type,
              title: 'Titre',
              message: 'Message',
              onClose: () => closed.add(true),
            ),
          ),
        ),
      );

      expect(find.text('Titre'), findsOneWidget);
      expect(find.text('Message'), findsOneWidget);

      await tester.tap(find.text('Fermer'));
      expect(closed, [true]);
    }
  });

  testWidgets('confirmation bottom sheet preserves the user decision', (
    tester,
  ) async {
    bool? result;

    await tester.pumpWidget(
      MaterialApp(
        home: Builder(
          builder: (context) {
            return Scaffold(
              body: ElevatedButton(
                onPressed: () async {
                  result = await showAppMessageConfirmationBottomSheet(
                    context,
                    type: AppMessageType.question,
                    title: 'Confirmer',
                    message: 'Voulez-vous continuer ?',
                    confirmLabel: 'Oui',
                    cancelLabel: 'Non',
                  );
                },
                child: const Text('Ouvrir'),
              ),
            );
          },
        ),
      ),
    );

    await tester.tap(find.text('Ouvrir'));
    await tester.pumpAndSettle();
    expect(find.text('Oui'), findsOneWidget);
    expect(find.text('Non'), findsOneWidget);

    await tester.tap(find.text('Non'));
    await tester.pumpAndSettle();
    expect(result, isFalse);

    await tester.tap(find.text('Ouvrir'));
    await tester.pumpAndSettle();
    await tester.tap(find.text('Oui'));
    await tester.pumpAndSettle();
    expect(result, isTrue);
  });
}