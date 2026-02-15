import 'package:flutter/material.dart';
import 'package:dressur/components/constant.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';

class ProfileMenuReseau extends StatelessWidget {
  const ProfileMenuReseau({
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
          padding: const EdgeInsets.all(10),
          shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(5)),
          side: const BorderSide(color: primaryColor),
        ),
        onPressed: press,
        child: Row(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: [
            Text(text),
            const FaIcon(
              FontAwesomeIcons.arrowRight,
            ),
          ],
        ),
      ),
    );
  }
}
