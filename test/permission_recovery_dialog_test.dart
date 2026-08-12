import 'dart:async';

import 'package:dressur/components/permission_recovery_dialog.dart';
import 'package:dressur/components/permission_manager.dart';
import 'package:flutter/material.dart';
import 'package:flutter_test/flutter_test.dart';
import 'package:permission_handler/permission_handler.dart';

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

  testWidgets('pending action resumes once after permission is granted', (
    tester,
  ) async {
    late BuildContext context;
    await tester.pumpWidget(
      MaterialApp(
        home: Builder(
          builder: (builderContext) {
            context = builderContext;
            return const SizedBox.shrink();
          },
        ),
      ),
    );

    final statuses = <AppPermissionStatus>[
      AppPermissionStatus.denied,
      AppPermissionStatus.granted,
    ];
    final recoveryResponse = Completer<PermissionRecoveryAction>();
    final manager = PermissionManager.forTesting(
      ensurePermission: (permission) async => AppPermissionResult(
        permission: permission,
        status: statuses.removeAt(0),
      ),
      recoveryAction: () => recoveryResponse.future,
    );
    var actionCount = 0;

    final firstCall = manager.runWithPermissionRecovery(
      context,
      actionKey: 'contacts:add',
      permission: Permission.contacts,
      isFrench: true,
      action: () async {
        actionCount++;
      },
    );
    await tester.pump();
    expect(actionCount, 0);
    expect(manager.hasPendingAction('contacts:add'), isTrue);

    final duplicateCall = manager.runWithPermissionRecovery(
      context,
      actionKey: 'contacts:add',
      permission: Permission.contacts,
      isFrench: true,
      action: () async {
        actionCount++;
      },
    );

    recoveryResponse.complete(PermissionRecoveryAction.retry);
    await Future.wait<void>([firstCall, duplicateCall]);

    expect(actionCount, 1);
    expect(manager.hasPendingAction('contacts:add'), isFalse);
  });

  testWidgets('refused pending action is not executed and is cleared', (
    tester,
  ) async {
    late BuildContext context;
    await tester.pumpWidget(
      MaterialApp(
        home: Builder(
          builder: (builderContext) {
            context = builderContext;
            return const SizedBox.shrink();
          },
        ),
      ),
    );

    final manager = PermissionManager.forTesting(
      ensurePermission: (permission) async => AppPermissionResult(
        permission: permission,
        status: AppPermissionStatus.denied,
      ),
      recoveryAction: () async => PermissionRecoveryAction.cancel,
    );
    var actionCount = 0;

    await manager.runWithPermissionRecovery(
      context,
      actionKey: 'contacts:delete',
      permission: Permission.contacts,
      isFrench: true,
      action: () async {
        actionCount++;
      },
    );

    expect(actionCount, 0);
    expect(manager.hasPendingAction('contacts:delete'), isFalse);
  });

  testWidgets(
    'limited and temporary access remains usable without a new request',
    (tester) async {
      late BuildContext context;
      await tester.pumpWidget(
        MaterialApp(
          home: Builder(
            builder: (builderContext) {
              context = builderContext;
              return const SizedBox.shrink();
            },
          ),
        ),
      );

      var currentStatus = AppPermissionStatus.limited;
      var requestCount = 0;
      var actionCount = 0;

      final manager = PermissionManager.forTesting(
        checkPermission: (permission) async => AppPermissionResult(
          permission: permission,
          status: currentStatus,
        ),
        requestPermission: (permission) async {
          requestCount++;
          return AppPermissionResult(
            permission: permission,
            status: AppPermissionStatus.granted,
          );
        },
        recoveryAction: () async => PermissionRecoveryAction.cancel,
      );

      final limitedResult = await manager.ensure(Permission.photos);
      expect(limitedResult.isLimited, isTrue);
      expect(limitedResult.canProceed, isTrue);
      expect(requestCount, 0);

      currentStatus = AppPermissionStatus.temporary;
      final temporaryResult = await manager.ensure(Permission.notification);
      expect(temporaryResult.isTemporary, isTrue);
      expect(temporaryResult.canProceed, isTrue);
      expect(requestCount, 0);

      await manager.runWithPermissionRecovery(
        context,
        actionKey: 'photos:limited-action',
        permission: Permission.photos,
        isFrench: true,
        action: () async => actionCount++,
      );
      expect(actionCount, 1);
      expect(requestCount, 0);
    },
  );

  testWidgets(
    'permission unavailable on a later action is requested then recovered',
    (tester) async {
      late BuildContext context;
      await tester.pumpWidget(
        MaterialApp(
          home: Builder(
            builder: (builderContext) {
              context = builderContext;
              return const SizedBox.shrink();
            },
          ),
        ),
      );

      var currentStatus = AppPermissionStatus.temporary;
      var requestCount = 0;
      var actionCount = 0;

      final manager = PermissionManager.forTesting(
        checkPermission: (permission) async => AppPermissionResult(
          permission: permission,
          status: currentStatus,
        ),
        requestPermission: (permission) async {
          requestCount++;
          currentStatus = AppPermissionStatus.granted;
          return AppPermissionResult(
            permission: permission,
            status: AppPermissionStatus.granted,
          );
        },
        recoveryAction: () async => PermissionRecoveryAction.cancel,
      );

      await manager.runWithPermissionRecovery(
        context,
        actionKey: 'notification:temporary-action',
        permission: Permission.notification,
        isFrench: true,
        action: () async => actionCount++,
      );
      expect(actionCount, 1);
      expect(requestCount, 0);

      currentStatus = AppPermissionStatus.denied;
      final statusBeforeNewAction = await manager.check(Permission.notification);
      expect(statusBeforeNewAction.isDenied, isTrue);
      expect(requestCount, 0);

      await manager.runWithPermissionRecovery(
        context,
        actionKey: 'notification:renewed-action',
        permission: Permission.notification,
        isFrench: true,
        action: () async => actionCount++,
      );
      expect(actionCount, 2);
      expect(requestCount, 1);
    },
  );
}
