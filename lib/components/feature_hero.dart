import 'package:dressur/components/app_theme.dart';
import 'package:flutter/material.dart';

/// Shared hero header for functional mobile feature pages.
class FeatureHero extends StatelessWidget {
  const FeatureHero({
    super.key,
    required this.icon,
    required this.title,
    required this.subtitle,
    this.gradientColors = const <Color>[
      AppColors.primary,
      Color(0xFF5E7EC9),
    ],
    this.height = 220,
    this.margin = const EdgeInsets.fromLTRB(
      AppSpacing.large,
      AppSpacing.medium,
      AppSpacing.large,
      AppSpacing.large,
    ),
  });

  final IconData icon;
  final String title;
  final String subtitle;
  final List<Color> gradientColors;
  final double height;
  final EdgeInsetsGeometry margin;

  @override
  Widget build(BuildContext context) {
    final textTheme = Theme.of(context).textTheme;

    return Container(
      width: double.infinity,
      height: height,
      margin: margin,
      padding: const EdgeInsets.all(AppSpacing.xxLarge),
      decoration: BoxDecoration(
        borderRadius: BorderRadius.circular(AppRadii.extraLarge),
        gradient: LinearGradient(
          begin: Alignment.topLeft,
          end: Alignment.bottomRight,
          colors: gradientColors,
        ),
      ),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Container(
            width: 64,
            height: 64,
            decoration: BoxDecoration(
              color: Colors.white.withValues(alpha: 0.16),
              shape: BoxShape.circle,
            ),
            child: Icon(icon, color: Colors.white, size: 30),
          ),
          const SizedBox(height: AppSpacing.large),
          Text(
            title,
            textAlign: TextAlign.center,
            style: textTheme.headlineSmall?.copyWith(
              color: Colors.white,
              fontWeight: FontWeight.w700,
            ),
          ),
          const SizedBox(height: AppSpacing.small),
          Text(
            subtitle,
            textAlign: TextAlign.center,
            style: textTheme.bodyMedium?.copyWith(
              color: Colors.white.withValues(alpha: 0.9),
              height: 1.4,
            ),
          ),
        ],
      ),
    );
  }
}