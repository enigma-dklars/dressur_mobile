import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

class ProfileMenuReseauBlanc extends StatelessWidget {
  const ProfileMenuReseauBlanc({
    Key? key,
    required this.text,
    this.press,
  }) : super(key: key);

  final String text;
  final VoidCallback? press;

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 0, vertical: 0),
      child: TextButton(
        style: TextButton.styleFrom(
          foregroundColor: Colors.white,
          padding: const EdgeInsets.all(10),
          shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(5)),
          side: const BorderSide(color: Colors.white),
        ),
        onPressed: press,
        child: Row(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: [
            Text(
              text,
              style: GoogleFonts.poppins(
                color: Colors.white,
                fontSize: 12,
                fontWeight: FontWeight.w500,
              ),
            ),
            const Icon(
              Icons.arrow_right,
              color: Colors.white,
            ),
          ],
        ),
      ),
    );
  }
}
