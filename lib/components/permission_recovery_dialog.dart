import 'package:flutter/material.dart';

enum PermissionRecoveryAction { retry, openSettings, cancel }

class PermissionRecoveryDialog extends StatelessWidget {
  const PermissionRecoveryDialog({
    required this.title,
    required this.message,
    required this.isFrench,
    required this.showSettingsAction,
    required this.onAction,
    super.key,
  });

  final String title;
  final String message;
  final bool isFrench;
  final bool showSettingsAction;
  final ValueChanged<PermissionRecoveryAction> onAction;

  @override
  Widget build(BuildContext context) {
    return AlertDialog(
      title: Text(title),
      content: SingleChildScrollView(child: Text(message)),
      actions: [
        TextButton(
          onPressed: () => onAction(PermissionRecoveryAction.cancel),
          child: Text(isFrench ? 'Annuler' : 'Cancel'),
        ),
        TextButton(
          onPressed: () => onAction(PermissionRecoveryAction.retry),
          child: Text(isFrench ? 'Réessayer' : 'Try again'),
        ),
        if (showSettingsAction)
          FilledButton(
            onPressed: () => onAction(PermissionRecoveryAction.openSettings),
            child: Text(isFrench ? 'Ouvrir les réglages' : 'Open Settings'),
          ),
      ],
    );
  }
}
