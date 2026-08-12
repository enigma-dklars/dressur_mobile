import 'dart:async';

import 'package:flutter/material.dart';
import 'package:permission_handler/permission_handler.dart';
import 'package:dressur/components/permission_recovery_dialog.dart';

/// États de permission exposés aux fonctionnalités de l'application.
enum AppPermissionStatus {
  granted,
  denied,
  permanentlyDenied,
  limited,
  temporary,
  restricted,
  unknown,
}

/// Résultat exploitable après une vérification ou une demande de permission.
class AppPermissionResult {
  const AppPermissionResult({required this.permission, required this.status});

  final Permission permission;
  final AppPermissionStatus status;

  bool get isGranted => status == AppPermissionStatus.granted;

  bool get isDenied => status == AppPermissionStatus.denied;

  bool get isPermanentlyDenied =>
      status == AppPermissionStatus.permanentlyDenied;

  bool get isLimited => status == AppPermissionStatus.limited;

  bool get isTemporary => status == AppPermissionStatus.temporary;

  bool get isRestricted => status == AppPermissionStatus.restricted;

  /// Les fonctionnalités peuvent choisir d'accepter un accès partiel ou
  /// temporaire selon leur besoin métier.
  bool get canProceed =>
      isGranted ||
      status == AppPermissionStatus.limited ||
      status == AppPermissionStatus.temporary;

  bool get needsSettings =>
      status == AppPermissionStatus.permanentlyDenied ||
      status == AppPermissionStatus.restricted;

  bool get wasDenied =>
      status == AppPermissionStatus.denied ||
      status == AppPermissionStatus.permanentlyDenied;
}

/// Point d'accès unique aux permissions mobiles.
///
/// Ce gestionnaire ne ferme jamais l'application et ne modifie aucune donnée
/// de session. Les demandes sont sérialisées afin qu'une seule boîte système
/// soit active à la fois. Deux demandes simultanées pour la même permission
/// partagent le même résultat.
class PermissionManager {
  PermissionManager._({
    Future<AppPermissionResult> Function(Permission)? ensureOverride,
    Future<AppPermissionResult> Function(Permission)? checkOverride,
    Future<AppPermissionResult> Function(Permission)? requestOverride,
    Future<PermissionRecoveryAction> Function()? recoveryActionOverride,
    Future<bool> Function()? openSettingsOverride,
  })  : _ensureOverride = ensureOverride,
        _checkOverride = checkOverride,
        _requestOverride = requestOverride,
        _recoveryActionOverride = recoveryActionOverride,
        _openSettingsOverride = openSettingsOverride;

  static final PermissionManager instance = PermissionManager._();

  /// Constructeur réservé aux tests du flux de reprise.
  PermissionManager.forTesting({
    Future<AppPermissionResult> Function(Permission)? ensurePermission,
    Future<AppPermissionResult> Function(Permission)? checkPermission,
    Future<AppPermissionResult> Function(Permission)? requestPermission,
    required Future<PermissionRecoveryAction> Function() recoveryAction,
    Future<bool> Function()? openSettings,
  }) : this._(
          ensureOverride: ensurePermission,
          checkOverride: checkPermission,
          requestOverride: requestPermission,
          recoveryActionOverride: recoveryAction,
          openSettingsOverride: openSettings,
        );

  final Future<AppPermissionResult> Function(Permission)? _ensureOverride;
  final Future<AppPermissionResult> Function(Permission)? _checkOverride;
  final Future<AppPermissionResult> Function(Permission)? _requestOverride;
  final Future<PermissionRecoveryAction> Function()? _recoveryActionOverride;
  final Future<bool> Function()? _openSettingsOverride;

  Future<void> _requestQueue = Future<void>.value();
  final Map<Permission, Future<AppPermissionResult>> _pendingRequests =
      <Permission, Future<AppPermissionResult>>{};
  final Map<String, _PendingPermissionAction> _pendingActions =
      <String, _PendingPermissionAction>{};

  Future<AppPermissionResult> check(Permission permission) async {
    final override = _checkOverride;
    if (override != null) return override(permission);

    try {
      final platformStatus = await permission.status;
      return _fromPlatformStatus(permission, platformStatus);
    } catch (_) {
      return AppPermissionResult(
        permission: permission,
        status: AppPermissionStatus.unknown,
      );
    }
  }

  Future<AppPermissionResult> request(Permission permission) {
    final pending = _pendingRequests[permission];
    if (pending != null) return pending;

    final requestFuture = _requestQueue.then<AppPermissionResult>(
      (_) => _requestPermission(permission),
    );
    _requestQueue = requestFuture.then<void>(
      (_) {},
      onError: (Object _, StackTrace __) {},
    );
    _pendingRequests[permission] = requestFuture;

    unawaited(
      requestFuture.whenComplete(() {
        if (identical(_pendingRequests[permission], requestFuture)) {
          _pendingRequests.remove(permission);
        }
      }),
    );

    return requestFuture;
  }

  /// Vérifie d'abord l'état courant, puis demande uniquement si nécessaire.
  ///
  /// Les accès limités et temporaires sont considérés comme suffisants par
  /// [AppPermissionResult.canProceed]. Les accès bloqués dans les réglages
  /// sont retournés tels quels afin que l'interface puisse proposer une
  /// récupération claire.
  Future<AppPermissionResult> ensure(Permission permission) async {
    final override = _ensureOverride;
    if (override != null) return override(permission);

    final current = await check(permission);
    if (current.canProceed || current.needsSettings) {
      return current;
    }
    return request(permission);
  }

  /// Exécute une action qui dépend d'une permission.
  ///
  /// L'appelant doit capturer ici les données nécessaires à l'action avant
  /// l'attente de permission. Tant que la permission n'est pas accordée,
  /// l'action reste en attente sans être exécutée. Deux appels simultanés avec
  /// la même [actionKey] partagent la même Future, ce qui empêche les doubles
  /// envois et doubles traitements.
  ///
  /// L'action est exécutée au maximum une fois. Après une annulation, un refus,
  /// une action terminée ou une erreur, l'entrée est supprimée du gestionnaire.
  Future<void> runWithPermissionRecovery(
    BuildContext context, {
    required String actionKey,
    required Permission permission,
    required bool isFrench,
    required Future<void> Function() action,
    String? titleFr,
    String? titleEn,
    String? messageFr,
    String? messageEn,
  }) {
    final existing = _pendingActions[actionKey];
    if (existing != null) return existing.future;

    final completer = Completer<void>();
    final pending = _PendingPermissionAction(completer);
    _pendingActions[actionKey] = pending;

    unawaited(
      _runPendingPermissionAction(
        context,
        pending,
        actionKey: actionKey,
        permission: permission,
        isFrench: isFrench,
        action: action,
        titleFr: titleFr,
        titleEn: titleEn,
        messageFr: messageFr,
        messageEn: messageEn,
      ),
    );

    return completer.future;
  }

  bool hasPendingAction(String actionKey) =>
      _pendingActions.containsKey(actionKey);

  Future<void> _runPendingPermissionAction(
    BuildContext context,
    _PendingPermissionAction pending, {
    required String actionKey,
    required Permission permission,
    required bool isFrench,
    required Future<void> Function() action,
    String? titleFr,
    String? titleEn,
    String? messageFr,
    String? messageEn,
  }) async {
    try {
      for (var attempt = 0; attempt < 2; attempt++) {
        final result = await ensure(permission);
        if (result.canProceed) {
          await action();
          pending.complete();
          return;
        }

        if (!context.mounted) return;

        final recoveryAction = await _showPermissionDialog(
          context,
          result,
          permission: permission,
          isFrench: isFrench,
          titleFr: titleFr,
          titleEn: titleEn,
          messageFr: messageFr,
          messageEn: messageEn,
        );

        if (recoveryAction == PermissionRecoveryAction.cancel) return;

        if (recoveryAction == PermissionRecoveryAction.openSettings) {
          await openSettings();
          final afterSettings = await check(permission);
          if (afterSettings.canProceed) {
            await action();
            pending.complete();
          }
          return;
        }
      }
    } catch (error, stackTrace) {
      pending.completeError(error, stackTrace);
    } finally {
      if (identical(_pendingActions[actionKey], pending)) {
        _pendingActions.remove(actionKey);
      }
      if (!pending.isCompleted) pending.complete();
    }
  }

  Future<AppPermissionResult> ensureGalleryAccess() {
    return ensure(Permission.photos);
  }

  /// Protège une action qui ouvre la galerie sans interrompre la session.
  ///
  /// Après un refus simple, l'utilisateur peut réessayer. Après un blocage
  /// définitif ou restreint, il peut ouvrir les réglages. L'action appelante
  /// ne doit démarrer que si cette méthode renvoie true.
  Future<bool> ensureGalleryAccessWithRecovery(
    BuildContext context, {
    required bool isFrench,
  }) async {
    return ensureWithRecovery(
      context,
      Permission.photos,
      isFrench: isFrench,
      titleFr: 'Accès aux photos requis',
      titleEn: 'Photo access required',
      messageFr:
          'Dressur a besoin d’un accès à votre galerie pour choisir une image. Vous pouvez réessayer sans quitter votre session.',
      messageEn:
          'Dressur needs access to your gallery to choose an image. You can try again without leaving your session.',
    );
  }

  Future<bool> ensureContactsAccessWithRecovery(
    BuildContext context, {
    required bool isFrench,
  }) {
    return ensureWithRecovery(
      context,
      Permission.contacts,
      isFrench: isFrench,
      titleFr: 'Accès aux contacts requis',
      titleEn: 'Contact access required',
      messageFr:
          'Dressur doit accéder à vos contacts pour effectuer cette action. Vous pouvez réessayer ou autoriser l’accès dans les réglages.',
      messageEn:
          'Dressur needs access to your contacts for this action. You can try again or allow access in Settings.',
    );
  }

  Future<bool> ensureNotificationAccessWithRecovery(
    BuildContext context, {
    required bool isFrench,
  }) {
    return ensureWithRecovery(
      context,
      Permission.notification,
      isFrench: isFrench,
      titleFr: 'Notifications désactivées',
      titleEn: 'Notifications are disabled',
      messageFr:
          'Dressur ne peut pas afficher cette notification sans autorisation. Réessayez ou ouvrez les réglages. Votre session reste active.',
      messageEn:
          'Dressur cannot show this notification without permission. Try again or open Settings. Your session will remain active.',
    );
  }

  Future<bool> ensureExactAlarmAccessWithRecovery(
    BuildContext context, {
    required bool isFrench,
  }) {
    return ensureWithRecovery(
      context,
      Permission.scheduleExactAlarm,
      isFrench: isFrench,
      titleFr: 'Alarmes exactes requises',
      titleEn: 'Exact alarms required',
      messageFr:
          'Dressur doit pouvoir planifier ce rappel à l’heure prévue. Réessayez ou ouvrez les réglages. Votre session reste active.',
      messageEn:
          'Dressur needs permission to schedule this reminder at the planned time. Try again or open Settings. Your session will remain active.',
    );
  }

  /// Vérifie une permission juste avant une action et fournit une voie de
  /// récupération explicite sans jamais quitter l'application.
  Future<bool> ensureWithRecovery(
    BuildContext context,
    Permission permission, {
    required bool isFrench,
    String? titleFr,
    String? titleEn,
    String? messageFr,
    String? messageEn,
  }) async {
    for (var attempt = 0; attempt < 2; attempt++) {
      final result = await ensure(permission);
      if (result.canProceed) return true;
      if (!context.mounted) return false;

      final action = await _showPermissionDialog(
        context,
        result,
        permission: permission,
        isFrench: isFrench,
        titleFr: titleFr,
        titleEn: titleEn,
        messageFr: messageFr,
        messageEn: messageEn,
      );
      if (action == PermissionRecoveryAction.openSettings) {
        await openSettings();
        return (await check(permission)).canProceed;
      }
      if (action != PermissionRecoveryAction.retry) return false;
    }
    return false;
  }

  Future<PermissionRecoveryAction> _showPermissionDialog(
    BuildContext context,
    AppPermissionResult result, {
    required Permission permission,
    required bool isFrench,
    String? titleFr,
    String? titleEn,
    String? messageFr,
    String? messageEn,
  }) async {
    final recoveryActionOverride = _recoveryActionOverride;
    if (recoveryActionOverride != null) return recoveryActionOverride();

    final needsSettings = result.needsSettings;
    final permissionLabel = _permissionLabel(permission, isFrench: isFrench);
    final title = isFrench
        ? (titleFr ?? '$permissionLabel requis')
        : (titleEn ?? '$permissionLabel required');
    final message = needsSettings
        ? (isFrench
              ? 'L’accès à $permissionLabel est désactivé. Autorisez-le dans les réglages, puis réessayez. Votre session reste active.'
              : 'Access to $permissionLabel is disabled. Allow it in Settings, then try again. Your session will remain active.')
        : (isFrench
              ? (messageFr ??
                    'Dressur a besoin de $permissionLabel pour continuer. Vous pouvez réessayer sans quitter votre session.')
              : (messageEn ??
                    'Dressur needs $permissionLabel to continue. You can try again without leaving your session.'));

    return await showDialog<PermissionRecoveryAction>(
          context: context,
          barrierDismissible: false,
          builder: (dialogContext) => PermissionRecoveryDialog(
            title: title,
            message: message,
            isFrench: isFrench,
            showSettingsAction: needsSettings,
            onAction: (action) => Navigator.of(
              dialogContext,
            ).pop<PermissionRecoveryAction>(action),
          ),
        ) ??
        PermissionRecoveryAction.cancel;
  }

  String _permissionLabel(Permission permission, {required bool isFrench}) {
    if (permission == Permission.contacts) {
      return isFrench ? 'vos contacts' : 'your contacts';
    }
    if (permission == Permission.notification) {
      return isFrench ? 'les notifications' : 'notifications';
    }
    if (permission == Permission.scheduleExactAlarm) {
      return isFrench ? 'les alarmes exactes' : 'exact alarms';
    }
    if (permission == Permission.photos) {
      return isFrench ? 'vos photos' : 'your photos';
    }
    if (permission == Permission.storage) {
      return isFrench ? 'le stockage de votre appareil' : 'your device storage';
    }
    if (permission == Permission.camera) {
      return isFrench ? 'votre appareil photo' : 'your camera';
    }
    if (permission == Permission.microphone) {
      return isFrench ? 'votre microphone' : 'your microphone';
    }
    if (permission == Permission.location ||
        permission == Permission.locationWhenInUse ||
        permission == Permission.locationAlways) {
      return isFrench ? 'votre position' : 'your location';
    }
    return isFrench ? 'cette autorisation' : 'this permission';
  }

  Future<AppPermissionResult> _requestPermission(Permission permission) async {
    final current = await check(permission);
    if (current.canProceed || current.needsSettings) {
      return current;
    }

    try {
      final override = _requestOverride;
      if (override != null) return override(permission);

      final platformStatus = await permission.request();
      return _fromPlatformStatus(permission, platformStatus);
    } catch (_) {
      return AppPermissionResult(
        permission: permission,
        status: AppPermissionStatus.unknown,
      );
    }
  }

  Future<bool> openSettings() async {
    final openSettingsOverride = _openSettingsOverride;
    if (openSettingsOverride != null) return openSettingsOverride();

    try {
      return await openAppSettings();
    } catch (_) {
      return false;
    }
  }

  AppPermissionResult _fromPlatformStatus(
    Permission permission,
    PermissionStatus platformStatus,
  ) {
    final AppPermissionStatus status;
    if (platformStatus.isGranted) {
      status = AppPermissionStatus.granted;
    } else if (platformStatus.isLimited) {
      status = AppPermissionStatus.limited;
    } else if (platformStatus.isProvisional) {
      status = AppPermissionStatus.temporary;
    } else if (platformStatus.isPermanentlyDenied) {
      status = AppPermissionStatus.permanentlyDenied;
    } else if (platformStatus.isRestricted) {
      status = AppPermissionStatus.restricted;
    } else if (platformStatus.isDenied) {
      status = AppPermissionStatus.denied;
    } else {
      status = AppPermissionStatus.unknown;
    }

    return AppPermissionResult(permission: permission, status: status);
  }
}

class _PendingPermissionAction {
  _PendingPermissionAction(this._completer);

  final Completer<void> _completer;

  bool get isCompleted => _completer.isCompleted;

  Future<void> get future => _completer.future;

  void complete() {
    if (!_completer.isCompleted) _completer.complete();
  }

  void completeError(Object error, StackTrace stackTrace) {
    if (!_completer.isCompleted) {
      _completer.completeError(error, stackTrace);
    }
  }
}
