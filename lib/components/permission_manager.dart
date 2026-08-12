import 'dart:async';

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