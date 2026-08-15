import 'package:flutter/material.dart';

import 'package:dressur/7_demarage/presentation_ds.dart' as presentation;
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/sql_helper.dart';

typedef StartupSessionClearer = Future<void> Function();

/// Handles leaving the startup recovery screen for the unauthenticated flow.
///
/// The clearer is injectable so the ordering can be tested without opening a
/// platform SQLite database in a widget test.
class StartupSessionActions {
  StartupSessionActions({StartupSessionClearer? clearSession})
      : _clearSession = clearSession ?? SQLHelper.clearCachedSession;

  final StartupSessionClearer _clearSession;

  Future<void> clearAndOpenAuthChoices(NavigatorState navigator) async {
    resetUserInformationState();

    try {
      await _clearSession().timeout(const Duration(seconds: 6));
    } catch (_) {
      // The user can still choose login or registration if local cleanup fails.
    }

    if (!navigator.mounted) return;
    navigator.pushAndRemoveUntil(
      MaterialPageRoute(
        builder: (_) => presentation.WelcomePage(),
      ),
      (_) => false,
    );
  }
}