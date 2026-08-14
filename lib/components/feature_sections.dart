import 'package:dressur/components/app_theme.dart';
import 'package:flutter/material.dart';

/// Reusable heading for a functional feature section.
class FeatureSectionTitle extends StatelessWidget {
  const FeatureSectionTitle({
    super.key,
    required this.title,
    this.subtitle,
    this.icon,
    this.color,
    this.padding = const EdgeInsets.only(
      top: AppSpacing.large,
      bottom: AppSpacing.medium,
    ),
  });

  final String title;
  final String? subtitle;
  final IconData? icon;
  final Color? color;
  final EdgeInsetsGeometry padding;

  @override
  Widget build(BuildContext context) {
    final theme = Theme.of(context);
    final accentColor = color ?? theme.colorScheme.primary;
    final titleContent = Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          title,
          style: theme.textTheme.titleLarge?.copyWith(
            color: accentColor,
            fontWeight: FontWeight.w700,
          ),
        ),
        if (subtitle != null) ...[
          const SizedBox(height: AppSpacing.xSmall),
          Text(
            subtitle!,
            style: theme.textTheme.bodySmall?.copyWith(
              color: theme.colorScheme.onSurfaceVariant,
            ),
          ),
        ],
      ],
    );

    return Padding(
      padding: padding,
      child: icon == null
          ? titleContent
          : Row(
              crossAxisAlignment: CrossAxisAlignment.center,
              children: [
                Container(
                  width: 36,
                  height: 36,
                  margin: const EdgeInsets.only(right: AppSpacing.medium),
                  decoration: BoxDecoration(
                    color: accentColor.withValues(alpha: 0.1),
                    borderRadius: BorderRadius.circular(AppRadii.medium),
                  ),
                  child: Icon(icon, color: accentColor, size: 18),
                ),
                Expanded(child: titleContent),
              ],
            ),
    );
  }
}

/// Surface container for explanatory or informational content.
class FeatureInfoCard extends StatelessWidget {
  const FeatureInfoCard({
    super.key,
    required this.child,
    this.title,
    this.icon,
    this.color,
    this.padding = const EdgeInsets.all(AppSpacing.large),
    this.margin = const EdgeInsets.only(bottom: AppSpacing.medium),
  });

  final Widget child;
  final String? title;
  final IconData? icon;
  final Color? color;
  final EdgeInsetsGeometry padding;
  final EdgeInsetsGeometry margin;

  @override
  Widget build(BuildContext context) {
    final theme = Theme.of(context);
    final accentColor = color ?? theme.colorScheme.primary;

    return Container(
      width: double.infinity,
      margin: margin,
      padding: padding,
      decoration: BoxDecoration(
        color: theme.cardColor,
        borderRadius: BorderRadius.circular(AppRadii.large),
        border: Border.all(color: theme.colorScheme.outlineVariant),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          if (title != null || icon != null) ...[
            Row(
              children: [
                if (icon != null) ...[
                  Icon(icon, color: accentColor, size: 20),
                  const SizedBox(width: AppSpacing.small),
                ],
                if (title != null)
                  Expanded(
                    child: Text(
                      title!,
                      style: theme.textTheme.titleMedium?.copyWith(
                        fontWeight: FontWeight.w700,
                      ),
                    ),
                  ),
              ],
            ),
            const SizedBox(height: AppSpacing.medium),
          ],
          child,
        ],
      ),
    );
  }
}

/// A compact line with a leading bullet or icon.
class FeatureBulletRow extends StatelessWidget {
  const FeatureBulletRow({
    super.key,
    required this.text,
    this.icon = Icons.circle,
    this.color,
    this.padding = const EdgeInsets.only(bottom: AppSpacing.small),
  });

  final String text;
  final IconData icon;
  final Color? color;
  final EdgeInsetsGeometry padding;

  @override
  Widget build(BuildContext context) {
    final theme = Theme.of(context);
    final bulletColor = color ?? theme.colorScheme.primary;

    return Padding(
      padding: padding,
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Padding(
            padding: const EdgeInsets.only(top: AppSpacing.xSmall),
            child: Icon(icon, color: bulletColor, size: 16),
          ),
          const SizedBox(width: AppSpacing.medium),
          Expanded(
            child: Text(
              text,
              style: theme.textTheme.bodyMedium?.copyWith(height: 1.4),
            ),
          ),
        ],
      ),
    );
  }
}

/// A numbered step with an optional supporting description.
class FeatureNumberedStep extends StatelessWidget {
  const FeatureNumberedStep({
    super.key,
    required this.number,
    required this.title,
    this.description,
    this.isActive = true,
    this.margin = const EdgeInsets.only(bottom: AppSpacing.medium),
  });

  final int number;
  final String title;
  final String? description;
  final bool isActive;
  final EdgeInsetsGeometry margin;

  @override
  Widget build(BuildContext context) {
    final theme = Theme.of(context);
    final accentColor = theme.colorScheme.primary;
    final numberColor =
        isActive ? accentColor : theme.colorScheme.onSurfaceVariant;

    return Padding(
      padding: margin,
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Container(
            width: 28,
            height: 28,
            alignment: Alignment.center,
            decoration: BoxDecoration(
              color: isActive
                  ? accentColor
                  : theme.colorScheme.surfaceContainerHighest,
              shape: BoxShape.circle,
            ),
            child: Text(
              '$number',
              style: theme.textTheme.labelMedium?.copyWith(
                color: isActive ? theme.colorScheme.onPrimary : numberColor,
                fontWeight: FontWeight.w700,
              ),
            ),
          ),
          const SizedBox(width: AppSpacing.medium),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  title,
                  style: theme.textTheme.bodyLarge?.copyWith(
                    fontWeight: FontWeight.w600,
                  ),
                ),
                if (description != null) ...[
                  const SizedBox(height: AppSpacing.xSmall),
                  Text(
                    description!,
                    style: theme.textTheme.bodyMedium?.copyWith(
                      color: theme.colorScheme.onSurfaceVariant,
                      height: 1.4,
                    ),
                  ),
                ],
              ],
            ),
          ),
        ],
      ),
    );
  }
}

/// Displays whether a feature requirement has been fulfilled.
class FeatureCondition extends StatelessWidget {
  const FeatureCondition({
    super.key,
    required this.label,
    required this.isValid,
    this.description,
    this.padding = const EdgeInsets.symmetric(
      horizontal: AppSpacing.large,
      vertical: AppSpacing.medium,
    ),
  });

  final String label;
  final bool isValid;
  final String? description;
  final EdgeInsetsGeometry padding;

  @override
  Widget build(BuildContext context) {
    final theme = Theme.of(context);
    final stateColor =
        isValid ? Colors.green.shade600 : theme.colorScheme.error;

    return Padding(
      padding: padding,
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Icon(
            isValid ? Icons.check_circle : Icons.cancel,
            color: stateColor,
            size: 20,
          ),
          const SizedBox(width: AppSpacing.medium),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  label,
                  style: theme.textTheme.bodyMedium?.copyWith(
                    fontWeight: FontWeight.w600,
                  ),
                ),
                if (description != null) ...[
                  const SizedBox(height: AppSpacing.xSmall),
                  Text(
                    description!,
                    style: theme.textTheme.bodySmall?.copyWith(
                      color: theme.colorScheme.onSurfaceVariant,
                    ),
                  ),
                ],
              ],
            ),
          ),
          Icon(
            isValid ? Icons.check : Icons.close,
            color: stateColor,
            size: 18,
          ),
        ],
      ),
    );
  }
}

/// Primary action button with a consistent visual treatment.
class FeaturePrimaryButton extends StatelessWidget {
  const FeaturePrimaryButton({
    super.key,
    required this.label,
    required this.onPressed,
    this.icon,
    this.isLoading = false,
    this.height = 52,
  });

  final String label;
  final VoidCallback? onPressed;
  final IconData? icon;
  final bool isLoading;
  final double height;

  @override
  Widget build(BuildContext context) {
    return SizedBox(
      width: double.infinity,
      height: height,
      child: ElevatedButton(
        onPressed: isLoading ? null : onPressed,
        style: ElevatedButton.styleFrom(
          backgroundColor: AppColors.primary,
          disabledBackgroundColor:
              Theme.of(context).colorScheme.surfaceContainerHighest,
          foregroundColor: Colors.white,
          elevation: 0,
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(AppRadii.large),
          ),
        ),
        child: isLoading
            ? const SizedBox(
                width: 22,
                height: 22,
                child: CircularProgressIndicator(
                  strokeWidth: 2.5,
                  color: Colors.white,
                ),
              )
            : Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  if (icon != null) ...[
                    Icon(icon, size: 18),
                    const SizedBox(width: AppSpacing.small),
                  ],
                  Text(
                    label,
                    style: Theme.of(context).textTheme.labelLarge?.copyWith(
                          color: Colors.white,
                          fontWeight: FontWeight.w600,
                        ),
                  ),
                ],
              ),
      ),
    );
  }
}
