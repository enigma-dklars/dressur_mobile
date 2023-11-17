import 'package:flutter/material.dart';
import 'package:whatsperson/components/constant.dart';

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
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 5),
      child: TextButton(
        style: TextButton.styleFrom(
          foregroundColor: Colors.grey.shade600,
          padding: const EdgeInsets.all(20),
          shape:
              RoundedRectangleBorder(borderRadius: BorderRadius.circular(15)),
          side: const BorderSide(color: primaryColor),
        ),
        onPressed: press,
        child: Row(
          children: [
            Myicon,
            const SizedBox(width: 20),
            Expanded(child: Text(text)),
            const Icon(Icons.arrow_forward_ios),
          ],
        ),
      ),
    );
  }
}
