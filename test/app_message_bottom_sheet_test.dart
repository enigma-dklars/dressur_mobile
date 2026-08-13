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
}