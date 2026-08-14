import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

/// Shared visual tokens for the Dressur mobile application.
abstract final class AppColors {
  static const Color primary = Color(0xFF2A4B9A);

  static const Color backgroundLight = Color(0xFFF8F9FA);
  static const Color backgroundDark = Color(0xFF121212);

  static const Color cardLight = Colors.white;
  static const Color cardDark = Color(0xFF1E1E1E);
}

abstract final class AppRadii {
  static const double small = 10;
  static const double medium = 12;
  static const double large = 15;
  static const double extraLarge = 25;
  static const double pill = 50;
}

abstract final class AppSpacing {
  static const double xSmall = 4;
  static const double small = 8;
  static const double medium = 12;
  static const double large = 16;
  static const double xLarge = 20;
  static const double xxLarge = 24;
  static const double section = 32;
}

abstract final class AppTextStyles {
  static final TextTheme light = GoogleFonts.poppinsTextTheme(
    ThemeData.light().textTheme,
  ).apply(
    bodyColor: Colors.black87,
    displayColor: Colors.black87,
  );

  static final TextTheme dark = GoogleFonts.poppinsTextTheme(
    ThemeData.dark().textTheme,
  ).apply(
    bodyColor: Colors.white,
    displayColor: Colors.white,
  );
}

abstract final class AppTheme {
  static ThemeData get light => ThemeData(
        brightness: Brightness.light,
        primaryColor: AppColors.primary,
        scaffoldBackgroundColor: AppColors.backgroundLight,
        cardColor: AppColors.cardLight,
        colorScheme: ColorScheme.fromSeed(
          seedColor: AppColors.primary,
          brightness: Brightness.light,
        ).copyWith(
          surface: AppColors.backgroundLight,
        ),
        textTheme: AppTextStyles.light,
      );

  static ThemeData get dark => ThemeData(
        brightness: Brightness.dark,
        primaryColor: AppColors.primary,
        scaffoldBackgroundColor: AppColors.backgroundDark,
        cardColor: AppColors.cardDark,
        colorScheme: ColorScheme.fromSeed(
          seedColor: AppColors.primary,
          brightness: Brightness.dark,
        ).copyWith(
          surface: AppColors.backgroundDark,
        ),
        textTheme: AppTextStyles.dark,
      );
}