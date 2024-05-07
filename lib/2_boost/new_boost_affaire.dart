// ignore_for_file: use_build_context_synchronously

import 'dart:convert';
import 'dart:io';
import 'dart:async';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:image_picker/image_picker.dart';
import 'package:http/http.dart' as http;
import 'package:path_provider/path_provider.dart';
import 'package:image/image.dart' as img;
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/noti.dart';

class PromotionFormPage extends StatefulWidget {
  @override
  _PromotionFormPageState createState() => _PromotionFormPageState();
}

class _PromotionFormPageState extends State<PromotionFormPage> {
  File? _imageFile;
  TextEditingController _textEditingController = TextEditingController();
  bool _isSending = false;

  bool isImageSquare(File imageFile) {
    final image = img.decodeImage(File(imageFile.path).readAsBytesSync());
    if (image == null) {
      return false;
    }

    final width = image.width;
    final height = image.height;
    final aspectRatio = width / height;

    return aspectRatio >= 0.8 && aspectRatio <= 1.2;
  }

  Future<void> _selectImage() async {
    final picker = ImagePicker();
    final pickedImage = await picker.pickImage(source: ImageSource.gallery);

    if (pickedImage != null) {
      final imageFile = File(pickedImage.path);

      final fileSize = await imageFile.length();
      final fileSizeInMB = fileSize / (1024 * 1024);

      if (fileSizeInMB > 1) {
        showDialog(
          context: context,
          builder: (BuildContext context) {
            return AlertDialog(
              title: const Text('Erreur'),
              content: Text(
                (langUserPhone == "fr")
                    ? "La taille de l'image ne peut pas dépasser 1 Mo."
                    : "Image size cannot exceed 1 MB.",
              ),
              actions: <Widget>[
                TextButton(
                  child: const Text('OK'),
                  onPressed: () {
                    Navigator.of(context).pop();
                  },
                ),
              ],
            );
          },
        );
        return;
      }

      if (isImageSquare(imageFile)) {
        setState(() {
          _imageFile = imageFile;
        });
      } else {
        showDialog(
          context: context,
          builder: (BuildContext context) {
            return AlertDialog(
              title: const Text('Erreur'),
              content: Text(
                (langUserPhone == "fr")
                    ? "L'image doit être proche d'un carré."
                    : "The image should be close to a square.",
              ),
              actions: <Widget>[
                TextButton(
                  child: const Text('OK'),
                  onPressed: () {
                    Navigator.of(context).pop();
                  },
                ),
              ],
            );
          },
        );
      }
    }
  }

  Future<void> _sendData() async {
    if (_textEditingController.text.isEmpty || _imageFile == null) {
      showDialog(
        context: context,
        builder: (BuildContext context) {
          return AlertDialog(
            title: const Text('Erreur'),
            content: Text(
              (langUserPhone == "fr")
                  ? 'Veuillez entrer un texte et sélectionner une image.'
                  : 'Please enter a text and select an image.',
            ),
            actions: <Widget>[
              TextButton(
                child: const Text('OK'),
                onPressed: () {
                  Navigator.of(context).pop();
                },
              ),
            ],
          );
        },
      );
      return;
    }

    setState(() {
      _isSending = true;
    });

    final url = Uri.parse('$generalRouteForApi/newPromotion');

    final request = http.MultipartRequest('POST', url);
    request.fields['text'] = _textEditingController.text;
    request.fields['uid'] = uidUser;
    request.fields['langUserPhone'] = langUserPhone.toString();

    final tempDir = await getTemporaryDirectory();
    final filePath = '${tempDir.path}/temp_image.jpg';
    final image = img.decodeImage(_imageFile!.readAsBytesSync());
    final compressedImage = img.encodeJpg(image!, quality: 85);
    File(filePath).writeAsBytesSync(compressedImage);

    final imageStream =
        http.ByteStream(Stream.castFrom(File(filePath).openRead()));
    final imageLength = await File(filePath).length();

    final multipartFile = http.MultipartFile(
      'image',
      imageStream,
      imageLength,
      filename: _imageFile!.path,
    );

    request.files.add(multipartFile);

    final response = await request.send();

    if (response.statusCode == 200) {
      var data1 = await response.stream.bytesToString();
      var data = jsonDecode(data1);
      if (data["error"] == true) {
        dangerNoti(data["titre"], data["message"], context);
      } else {
        showDialog(
          context: context,
          builder: (BuildContext context) {
            return AlertDialog(
              title: const Text('Succès'),
              content: Text((langUserPhone == "fr")
                  ? 'Votre demande de promotion a été enregistrée, vous passerez au paiement si elle est acceptée.'
                  : 'Your promotion request has been registered, you will proceed to payment if it is accepted.'),
              actions: <Widget>[
                TextButton(
                  child: const Text('OK'),
                  onPressed: () {
                    Navigator.of(context).pop();
                  },
                ),
              ],
            );
          },
        );
      }
      setState(() {
        _textEditingController.clear();
        _imageFile = null;
        _isSending = false;
      });
    } else {
      showDialog(
        context: context,
        builder: (BuildContext context) {
          return AlertDialog(
            title: const Text('Erreur'),
            content: Text('Erreur : ${response.statusCode}'),
            actions: <Widget>[
              TextButton(
                child: const Text('OK'),
                onPressed: () {
                  Navigator.of(context).pop();
                },
              ),
            ],
          );
        },
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
          (langUserPhone == "fr")
              ? 'Nouvelle Promotion Affaire'
              : 'New Business Promotion',
          style: GoogleFonts.poppins(
            fontWeight: FontWeight.w600,
            color: Colors.white,
          ),
        ),
        leading: IconButton(
          onPressed: () {
            Navigator.pop(context);
          },
          icon: const Icon(
            Icons.arrow_back,
            size: 30,
            color: Colors.white,
          ),
        ),
        backgroundColor: primaryColor,
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.only(left: 10, top: 5, right: 10, bottom: 5),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.stretch,
          children: [
            const SizedBox(height: 5),
            Card(
              margin:
                  const EdgeInsets.only(left: 0, top: 0, right: 0, bottom: 5),
              child: Container(
                decoration: BoxDecoration(
                  borderRadius: BorderRadius.circular(5),
                  gradient: const LinearGradient(
                    begin: Alignment.topCenter,
                    end: Alignment.bottomCenter,
                    colors: [
                      Colors.red,
                      Color.fromARGB(255, 85, 3, 3),
                    ],
                  ),
                ),
                padding: const EdgeInsets.fromLTRB(10, 0, 10, 0),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.stretch,
                  children: [
                    const SizedBox(height: 10),
                    Text(
                      (langUserPhone == "fr")
                          ? "NB: Après avoir rempli et envoyer votre promotion, elle sera analyser par les administrateurs de Dressur.\nSi votre promotion est acceptée, vous passerez au paiement et ainsi votre promotion sera visible par des milliers d'utilisateurs correspondants à vos préférences pays."
                          : "NB: After completing and sending your promotion, it will be analyzed by the Dressur administrators.\nIf your promotion is accepted, you will proceed to payment and your promotion will thus be visible to thousands of users corresponding to your country preferences.",
                      style: GoogleFonts.poppins(
                        fontWeight: FontWeight.w600,
                        color: Colors.white,
                        fontSize: 10,
                      ),
                      textAlign: TextAlign.justify,
                    ),
                    const SizedBox(height: 15),
                  ],
                ),
              ),
            ),
            const SizedBox(height: 15),
            Text(
              (langUserPhone == "fr") ? "Nouvelle Promotion" : "New Promotion",
              style: GoogleFonts.poppins(
                fontSize: 25,
                fontWeight: FontWeight.w600,
              ),
              textAlign: TextAlign.center,
            ),
            const SizedBox(height: 15),
            ElevatedButton(
              onPressed: _isSending ? null : _selectImage,
              style: ElevatedButton.styleFrom(
                backgroundColor: primaryColor,
                shape: const StadiumBorder(),
                padding: const EdgeInsets.symmetric(
                  vertical: 13,
                ),
              ),
              child: Text(
                (langUserPhone == "fr")
                    ? 'Sélectionner une image'
                    : 'Select an image',
                style: GoogleFonts.poppins(
                  color: Colors.white,
                  fontWeight: FontWeight.w600,
                ),
              ),
            ),
            if (_imageFile != null)
              Container(
                margin: const EdgeInsets.only(top: 16.0),
                child: Image.file(
                  _imageFile!,
                  fit: BoxFit.contain,
                ),
              ),
            const SizedBox(height: 16.0),
            TextField(
              controller: _textEditingController,
              maxLines: null,
              decoration: InputDecoration(
                labelText: (langUserPhone == "fr")
                    ? 'Description de la promotion'
                    : 'Description of the promotion',
                border: const OutlineInputBorder(),
              ),
            ),
            const SizedBox(height: 16.0),
            ElevatedButton(
              onPressed: _isSending ? null : _sendData,
              style: ElevatedButton.styleFrom(
                backgroundColor: primaryColor,
                shape: const StadiumBorder(),
                padding: const EdgeInsets.symmetric(
                  vertical: 13,
                ),
              ),
              child: _isSending
                  ? const Text('Wait ...')
                  : Text(
                      (langUserPhone == "fr") ? 'Envoyer' : 'Send',
                      style: GoogleFonts.poppins(
                        color: Colors.white,
                      ),
                    ),
            ),
          ],
        ),
      ),
    );
  }
}
