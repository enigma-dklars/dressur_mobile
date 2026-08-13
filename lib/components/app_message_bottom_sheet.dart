import 'package:flutter/material.dart';

/// The semantic kind of message displayed by [AppMessageBottomSheet].
enum AppMessageType {
  danger,
  warning,
  info,
  success,
  question,
}

/// Displays an adaptive message bottom sheet.
///
/// The sheet keeps its close action visible while allowing the message itself
/// to scroll. It is safe to use with large text settings, small screens, and
/// an on-screen keyboard.
Future<void?> showAppMessageBottomSheet(
  BuildContext context, {
  required AppMessageType type,
  required String title,
  required String message,
  String closeLabel = 'Fermer',
  bool isDismissible = true,
  bool enableDrag = true,
}) {
  return showModalBottomSheet<void>(
    context: context,
    isScrollControlled: true,
    isDismissible: isDismissible,
    enableDrag: enableDrag,
    backgroundColor: Colors.transparent,
    builder: (sheetContext) {
      return AppMessageBottomSheet(
        type: type,
        title: title,
        message: message,
        closeLabel: closeLabel,
        onClose: () => Navigator.of(sheetContext).pop(),
      );
    },
  );
}

/// The reusable content shown inside an application message bottom sheet.
///
/// When used directly, [onClose] can be supplied to control the close action.
/// Otherwise, the nearest route is popped when the user closes the sheet.
class AppMessageBottomSheet extends StatelessWidget {
  const AppMessageBottomSheet({
    required this.type,
    required this.title,
    required this.message,
    this.closeLabel = 'Fermer',
    this.onClose,
    super.key,
  });

  final AppMessageType type;
  final String title;
  final String message;
  final String closeLabel;
  final VoidCallback? onClose;

  void _handleClose(BuildContext context) {
    if (onClose != null) {
      onClose!();
      return;
    }

    Navigator.of(context).maybePop();
  }

  @override
  Widget build(BuildContext context) {
    final mediaQuery = MediaQuery.of(context);
    final theme = Theme.of(context);
    final visuals = _MessageVisuals.fromType(type, theme.colorScheme);
    final availableHeight =
        mediaQuery.size.height - mediaQuery.padding.top - mediaQuery.viewInsets.bottom;
    final maxSheetHeight =
        (availableHeight * 0.92).clamp(0.0, mediaQuery.size.height).toDouble();

    return SafeArea(
      top: false,
      child: AnimatedPadding(
        duration: const Duration(milliseconds: 180),
        curve: Curves.easeOut,
        padding: EdgeInsets.only(bottom: mediaQuery.viewInsets.bottom),
        child: Align(
          alignment: Alignment.bottomCenter,
          child: ConstrainedBox(
            constraints: BoxConstraints(maxHeight: maxSheetHeight),
            child: Material(
              color: theme.colorScheme.surface,
              elevation: 8,
              borderRadius: const BorderRadius.vertical(
                top: Radius.circular(24),
              ),
              clipBehavior: Clip.antiAlias,
              child: Padding(
                padding: const EdgeInsets.fromLTRB(20, 8, 20, 16),
                child: Column(
                  mainAxisSize: MainAxisSize.min,
                  children: [
                    Semantics(
                      label: 'Poignée du panneau inférieur',
                      child: Container(
                        width: 44,
                        height: 4,
                        decoration: BoxDecoration(
                          color: theme.colorScheme.outlineVariant,
                          borderRadius: BorderRadius.circular(2),
                        ),
                      ),
                    ),
                    Align(
                      alignment: Alignment.topRight,
                      child: IconButton(
                        onPressed: () => _handleClose(context),
                        tooltip: closeLabel,
                        icon: const Icon(Icons.close),
                      ),
                    ),
                    Row(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        _MessageIcon(
                          visuals: visuals,
                        ),
                        const SizedBox(width: 16),
                        Expanded(
                          child: Padding(
                            padding: const EdgeInsets.only(top: 6),
                            child: Text(
                              title,
                              style: theme.textTheme.titleLarge?.copyWith(
                                fontWeight: FontWeight.w700,
                                color: visuals.accent,
                              ),
                            ),
                          ),
                        ),
                      ],
                    ),
                    const SizedBox(height: 16),
                    Flexible(
                      fit: FlexFit.loose,
                      child: SingleChildScrollView(
                        padding: const EdgeInsets.only(bottom: 4),
                        child: Align(
                          alignment: Alignment.centerLeft,
                          child: Text(
                            message,
                            style: theme.textTheme.bodyLarge,
                          ),
                        ),
                      ),
                    ),
                    const SizedBox(height: 16),
                    SizedBox(
                      width: double.infinity,
                      child: FilledButton(
                        onPressed: () => _handleClose(context),
                        child: Text(closeLabel),
                      ),
                    ),
                  ],
                ),
              ),
            ),
          ),
        ),
      ),
    );
  }
}

class _MessageIcon extends StatelessWidget {
  const _MessageIcon({required this.visuals});

  final _MessageVisuals visuals;

  @override
  Widget build(BuildContext context) {
    return Semantics(
      label: visuals.accessibilityLabel,
      image: true,
      child: DecoratedBox(
        decoration: BoxDecoration(
          color: visuals.background,
          shape: BoxShape.circle,
        ),
        child: Padding(
          padding: const EdgeInsets.all(12),
          child: Icon(
            visuals.icon,
            color: visuals.accent,
            size: 28,
          ),
        ),
      ),
    );
  }
}

class _MessageVisuals {
  const _MessageVisuals({
    required this.icon,
    required this.accent,
    required this.background,
    required this.accessibilityLabel,
  });

  final IconData icon;
  final Color accent;
  final Color background;
  final String accessibilityLabel;

  factory _MessageVisuals.fromType(
    AppMessageType type,
    ColorScheme colorScheme,
  ) {
    switch (type) {
      case AppMessageType.danger:
        return _MessageVisuals(
          icon: Icons.error_rounded,
          accent: colorScheme.error,
          background: colorScheme.errorContainer,
          accessibilityLabel: 'Danger',
        );
      case AppMessageType.warning:
        return _MessageVisuals(
          icon: Icons.warning_rounded,
          accent: Colors.orange.shade800,
          background: Colors.orange.shade100,
          accessibilityLabel: 'Avertissement',
        );
      case AppMessageType.info:
        return _MessageVisuals(
          icon: Icons.info_rounded,
          accent: colorScheme.primary,
          background: colorScheme.primaryContainer,
          accessibilityLabel: 'Information',
        );
      case AppMessageType.success:
        return _MessageVisuals(
          icon: Icons.check_circle_rounded,
          accent: Colors.green.shade700,
          background: Colors.green.shade100,
          accessibilityLabel: 'Succès',
        );
      case AppMessageType.question:
        return _MessageVisuals(
          icon: Icons.help_rounded,
          accent: colorScheme.secondary,
          background: colorScheme.secondaryContainer,
          accessibilityLabel: 'Question',
        );
    }
  }
}