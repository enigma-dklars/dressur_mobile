import 'dart:async';

import 'package:flutter/material.dart';
import 'package:permission_handler/permission_handler.dart';

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

enum PermissionRecoveryAction {
  retry,
  openSettings,
  cancel,
}

/// Résultat exploitable après une vérification ou une demande de permission.
class AppPermissionResult {
  const AppPermissionResult({
    required this.permission,
    required this.status,
  });

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
  PermissionManager._();

  static final PermissionManager instance = PermissionManager._();

  Future<void> _requestQueue = Future<void>.value();
  final Map<Permission, Future<AppPermissionResult>> _pendingRequests =
      <Permission, Future<AppPermissionResult>>{};

  Future<AppPermissionResult> check(Permission permission) async {
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

    unawaited(requestFuture.whenComplete(() {
      if (identical(_pendingRequests[permission], requestFuture)) {
        _pendingRequests.remove(permission);
      }
    }));

    return requestFuture;
  }

  /// Vérifie d'abord l'état courant, puis demande uniquement si nécessaire.
  ///
  /// Les accès limités et temporaires sont considérés comme suffisants par
  /// [AppPermissionResult.canProceed]. Les accès bloqués dans les réglages
  /// sont retournés tels quels afin que l'interface puisse proposer une
  /// récupération claire.
  Future<AppPermissionResult> ensure(Permission permission) async {
    final current = await check(permission);
    if (current.canProceed || current.needsSettings) {
      return current;
    }
    return request(permission);
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
        return false;
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
          builder: (dialogContext) => AlertDialog(
            title: Text(title),
            content: Text(message),
            actions: [
              TextButton(
                onPressed: () => Navigator.of(dialogContext)
                    .pop(PermissionRecoveryAction.cancel),
                child: Text(isFrench ? 'Plus tard' : 'Later'),
              ),
              TextButton(
                onPressed: () => Navigator.of(dialogContext)
                    .pop(PermissionRecoveryAction.retry),
                child: Text(isFrench ? 'Réessayer' : 'Try again'),
              ),
               if (needsSettings || result.isDenied)
                FilledButton(
                  onPressed: () => Navigator.of(dialogContext)
                      .pop(PermissionRecoveryAction.openSettings),
                  child: Text(isFrench ? 'Ouvrir les réglages' : 'Open settings'),
                ),
            ],
          ),
        ) ??
        PermissionRecoveryAction.cancel;
  }

  String _permissionLabel(
    Permission permission, {
    required bool isFrench,
  }) {
    if (permission == Permission.contacts) {
      return isFrench ? 'vos contacts' : 'your contacts';
    }
    if (permission == Permission.notification) {
      return isFrench ? 'les notifications' : 'notifications';
    }
    if (permission == Permission.scheduleExactAlarm) {
      return isFrench ? 'les alarmes exactes' : 'exact alarms';
    }
    if (permission == Permission.photos || permission == Permission.storage) {
      return isFrench ? 'vos photos' : 'your photos';
    }
    return isFrench ? 'cette autorisation' : 'this permission';
  }

  Future<AppPermissionResult> _requestPermission(
    Permission permission,
  ) async {
    final current = await check(permission);
    if (current.status != AppPermissionStatus.denied) {
      return current;
    }

    try {
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