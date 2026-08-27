// ignore_for_file: deprecated_member_use

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
    final iconsByType = <AppMessageType, IconData>{
      AppMessageType.danger: Icons.error_rounded,
      AppMessageType.warning: Icons.warning_rounded,
      AppMessageType.info: Icons.info_rounded,
      AppMessageType.success: Icons.check_circle_rounded,
      AppMessageType.question: Icons.help_rounded,
    };

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
      expect(find.byIcon(iconsByType[type]!), findsOneWidget);

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

  testWidgets('fits small, standard, and large screens', (tester) async {
    addTearDown(() => _resetTestWindow(tester));

    const viewports = [
      Size(320, 568),
      Size(390, 844),
      Size(768, 1024),
    ];

    for (final viewport in viewports) {
      _setTestWindow(tester, viewport);
      await _pumpOpenMessage(
        tester,
        type: AppMessageType.info,
        title: 'Information',
        message: 'Un message court qui doit rester lisible.',
      );

      expect(tester.takeException(), isNull);
      _expectCloseButtonVisible(tester, viewport);

      await tester.tap(find.text('Fermer'));
      await tester.pumpAndSettle();
      expect(find.byType(AppMessageBottomSheet), findsNothing);
    }
  });

  testWidgets(
    'keeps actions accessible with long content, multiline title, and large text',
    (tester) async {
      addTearDown(() => _resetTestWindow(tester));
      const viewport = Size(320, 568);
      const title =
          'Un titre très long qui doit naturellement passer sur plusieurs lignes';
      final message = List.filled(
        40,
        'Ce message est suffisamment long pour nécessiter un défilement.',
      ).join(' ');

      _setTestWindow(tester, viewport, textScaleFactor: 2.0);
      await _pumpOpenMessage(
        tester,
        type: AppMessageType.success,
        title: title,
        message: message,
      );

      expect(tester.takeException(), isNull);
      expect(find.byType(SingleChildScrollView), findsOneWidget);
      expect(tester.getSize(find.text(title)).height, greaterThan(40));
      _expectCloseButtonVisible(tester, viewport);

      await tester.drag(
        find.byType(SingleChildScrollView),
        const Offset(0, -200),
      );
      await tester.pump();
      expect(tester.takeException(), isNull);
      _expectCloseButtonVisible(tester, viewport);

      await tester.tap(find.text('Fermer'));
      await tester.pumpAndSettle();
      expect(find.byType(AppMessageBottomSheet), findsNothing);
    },
  );

  testWidgets('keeps the close action above the open keyboard', (tester) async {
    addTearDown(() => _resetTestWindow(tester));
    const viewport = Size(390, 844);
    const keyboardHeight = 320.0;

    _setTestWindow(
      tester,
      viewport,
      viewInsets: EdgeInsets.only(bottom: keyboardHeight),
    );
    await _pumpOpenMessage(
      tester,
      type: AppMessageType.danger,
      title: 'Erreur',
      message: 'Le clavier est ouvert pendant l’affichage du message.',
    );

    expect(tester.takeException(), isNull);
    _expectCloseButtonVisible(
      tester,
      viewport,
      maxBottom: viewport.height - keyboardHeight,
    );

    await tester.tap(find.text('Fermer'));
    await tester.pumpAndSettle();
    expect(find.byType(AppMessageBottomSheet), findsNothing);
  });

  testWidgets('the top X button closes the modal', (tester) async {
    addTearDown(() => _resetTestWindow(tester));
    const viewport = Size(390, 844);
    _setTestWindow(tester, viewport);

    await _pumpOpenMessage(
      tester,
      type: AppMessageType.warning,
      title: 'Attention',
      message: 'Fermez ce message avec le bouton X.',
    );

    expect(find.byTooltip('Fermer'), findsOneWidget);
    await tester.tap(find.byTooltip('Fermer'));
    await tester.pumpAndSettle();

    expect(find.byType(AppMessageBottomSheet), findsNothing);
    expect(tester.takeException(), isNull);
  });
}

Future<void> _pumpOpenMessage(
  WidgetTester tester, {
  required AppMessageType type,
  required String title,
  required String message,
}) async {
  await tester.pumpWidget(
    MaterialApp(
      home: Builder(
        builder: (context) {
          return Scaffold(
            body: Center(
              child: ElevatedButton(
                onPressed: () => showAppMessageBottomSheet(
                  context,
                  type: type,
                  title: title,
                  message: message,
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
  expect(find.byType(AppMessageBottomSheet), findsOneWidget);
}

void _setTestWindow(
  WidgetTester tester,
  Size size, {
  double textScaleFactor = 1.0,
  EdgeInsets viewInsets = EdgeInsets.zero,
}) {
  tester.view.physicalSize = size;
  tester.view.devicePixelRatio = 1.0;
  tester.binding.platformDispatcher.textScaleFactorTestValue = textScaleFactor;
  tester.view.viewInsets = FakeViewPadding(
    left: viewInsets.left,
    top: viewInsets.top,
    right: viewInsets.right,
    bottom: viewInsets.bottom,
  );
}

void _resetTestWindow(WidgetTester tester) {
  tester.view.resetPhysicalSize();
  tester.view.resetDevicePixelRatio();
  tester.binding.platformDispatcher.clearTextScaleFactorTestValue();
  tester.view.resetViewInsets();
}

void _expectCloseButtonVisible(
  WidgetTester tester,
  Size viewport, {
  double? maxBottom,
}) {
  final rect = tester.getRect(find.text('Fermer'));
  expect(rect.top, greaterThanOrEqualTo(0));
  expect(rect.bottom, lessThanOrEqualTo(maxBottom ?? viewport.height));
}