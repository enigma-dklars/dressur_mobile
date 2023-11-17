import 'package:flutter/material.dart';
import 'package:whatsperson/components/constant.dart';

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
          foregroundColor: Colors.grey.shade600,
          padding: const EdgeInsets.all(10),
          shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(5)),
          side: const BorderSide(color: primaryColor),
        ),
        onPressed: press,
        child: Row(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: [
            Text(text),
            const Icon(
              Icons.arrow_right,
              color: secondaryColor,
            ),
          ],
        ),
      ),
    );
  }
}
