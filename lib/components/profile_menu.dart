// ignore_for_file: non_constant_identifier_names

import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

class ProfileMenu extends StatelessWidget {
  const ProfileMenu({
    Key? key,
    required this.text,
    required this.Myicon,
    this.press,
  }) : super(key: key);

  final String text;
  final Icon Myicon;
  final VoidCallback? press;

  @override
  Widget build(BuildContext context) {
    return ListTile(
      // dense: true,
      leading: Myicon,
      title: Text(
        text,
        style: GoogleFonts.poppins(
          fontSize: 15,
        ),
      ),
      onTap: press,
    );
  }
}
