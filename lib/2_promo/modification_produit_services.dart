import 'dart:convert';
import 'package:cached_network_image/cached_network_image.dart';
import 'package:dressur/2_promo/liste_boost_affaire.dart';
import 'package:http/http.dart' as http;
import 'dart:io';
import 'dart:async';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:image_picker/image_picker.dart';
import 'package:path_provider/path_provider.dart';
import 'package:image/image.dart' as img;
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/noti.dart';
import 'package:select_form_field/select_form_field.dart';

class ModificationProduitServicesPage extends StatefulWidget {
  final Promotion promotion;
  ModificationProduitServicesPage({required this.promotion});
  @override
  _ModificationProduitServicesPageState createState() =>
      _ModificationProduitServicesPageState();
}

class _ModificationProduitServicesPageState
    extends State<ModificationProduitServicesPage> {
  bool load = false;
  File? _imageFile;
  final TextEditingController _textEditingController = TextEditingController();
  bool _isSending = false;
  String _message = "";
  dynamic idFormulBoost = 1;
  dynamic valueMethodePaiement = "mtn";
  bool loadingFormuleGratuit = false;
  List<Map<String, dynamic>> listeDesFormules = [];
  int value = 0;
  String label = "";
  int prix = 0;
  int jours = 0;
  final TextEditingController telController = TextEditingController();

  @override
  void initState() {
    super.initState();
    _textEditingController.text = widget.promotion.description;
    listeFormulePromoAffaire();
  }

  bool isImageSquare(File imageFile) {
    final image = img.decodeImage(File(imageFile.path).readAsBytesSync());
    return image != null &&
        (image.width / image.height >= 0.8 &&
            image.width / image.height <= 1.2);
  }

  Future<void> _selectImage() async {
    final picker = ImagePicker();
    final pickedImage = await picker.pickImage(source: ImageSource.gallery);
    if (pickedImage == null) return;

    final imageFile = File(pickedImage.path);
    final fileSizeInMB = await imageFile.length() / (1024 * 1024);

    if (fileSizeInMB > 1) {
      dangerNoti(
          "Attention !!!",
          langUserPhone == "fr"
              ? "La taille de l'image ne peut pas dépasser 1 Mo."
              : "Image size cannot exceed 1 MB.",
          context);
      return;
    }

    if (isImageSquare(imageFile)) {
      setState(() {
        _imageFile = imageFile;
      });
    } else {
      dangerNoti(
          "Attention !!!",
          langUserPhone == "fr"
              ? "L'image doit être proche d'un carré."
              : "The image should be close to a square.",
          context);
    }
  }

  Future<void> _sendData() async {
    if (!telIsVerified) {
      showConfNumeroWhatsapp(context);
      return;
    }

    if (_textEditingController.text.isEmpty || _imageFile == null) {
      dangerNoti(
          "Attention !!!",
          langUserPhone == "fr"
              ? 'Veuillez entrer un texte et sélectionner une image.'
              : 'Please enter a text and select an image.',
          context);
      return;
    }

    setState(() {
      _isSending = true;
    });

    final url = Uri.parse('$generalRouteForApi/addProduitService');
    final request = http.MultipartRequest('POST', url);
    request.fields.addAll({
      'idFormulePromoAffaire': idFormulBoost.toString(),
      'text': _textEditingController.text,
      'uid': widget.promotion.id,
      'langUserPhone': langUserPhone.toString(),
      'mode': load ? "payant" : "gratuit",
      'paymentMethod': valueMethodePaiement,
      'tel': telController.text,
    });

    final tempDir = await getTemporaryDirectory();
    final filePath = '${tempDir.path}/temp_image.jpg';
    final image = img.decodeImage(_imageFile!.readAsBytesSync());
    final compressedImage = img.encodeJpg(image!, quality: 85);
    File(filePath).writeAsBytesSync(compressedImage);

    final imageStream =
        http.ByteStream(Stream.castFrom(File(filePath).openRead()));
    final imageLength = await File(filePath).length();

    final multipartFile = http.MultipartFile('image', imageStream, imageLength,
        filename: _imageFile!.path);
    request.files.add(multipartFile);

    final response = await request.send();

    if (response.statusCode == 200) {
      final data = jsonDecode(await response.stream.bytesToString());
      if (data["error"] == true) {
        dangerNoti(data["titre"], data["message"], context);
      } else {
        successNoti(
            "Good",
            langUserPhone == "fr"
                ? 'Votre demande de promotion a été enregistrée.'
                : 'Your promotion request has been saved.',
            context);
      }
      setState(() {
        _textEditingController.clear();
        _imageFile = null;
        _isSending = false;
      });
    } else {
      dangerNoti("Attention !!!", 'Erreur : ${response.statusCode}', context);
    }
  }

  void listeFormulePromoAffaire() async {
    final isConnected = await isConnectedToInternet();
    if (!isConnected) {
      dangerNoti(
          langUserPhone == "fr" ? "Erreur!" : "Mistake!",
          langUserPhone == "fr"
              ? "Vous n'ètes pas connecté a internet."
              : "You are not connected to the internet.",
          context);
      return;
    }

    setState(() {
      loadingFormuleGratuit = true;
    });

    final response = await http.MultipartRequest(
            'POST', Uri.parse('$generalRouteForApi/listeFormulePromoAffaire'))
        .send();

    if (response.statusCode == 200) {
      final data = jsonDecode(await response.stream.bytesToString());
      if (data["error"] == false) {
        setState(() {
          loadingFormuleGratuit = false;
          listeDesFormules =
              List<Map<String, dynamic>>.from(data["listeFormulBoost"]);
          _message = langUserPhone == "fr"
              ? "Veuillez choisir une formule."
              : "Please choose a plan.";
        });
      }
    } else {
      dangerNoti("Erreur", 'Erreur lors du chargement des formules', context);
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
            langUserPhone == "fr"
                ? 'Modification Promotion Affaire'
                : 'Change Promotion Deal',
            style: GoogleFonts.poppins(
                fontWeight: FontWeight.w400, color: Colors.white)),
        leading: IconButton(
            onPressed: () => Navigator.pop(context),
            icon: Icon(Icons.arrow_back, size: 30, color: Colors.white)),
        backgroundColor: primaryColor,
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(10),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.stretch,
          children: [
            Text(_message,
                style: GoogleFonts.poppins(fontSize: 16),
                textAlign: TextAlign.center),
            ElevatedButton(
              onPressed: _isSending ? null : _selectImage,
              style: ElevatedButton.styleFrom(
                  backgroundColor: Colors.green,
                  shape: StadiumBorder(),
                  padding: EdgeInsets.symmetric(vertical: 13)),
              child: Text(
                  langUserPhone == "fr"
                      ? 'Changer une image'
                      : 'Change an image',
                  style: GoogleFonts.poppins(
                      color: Colors.white, fontWeight: FontWeight.w600)),
            ),
            if (_imageFile != null)
              Container(
                  margin: const EdgeInsets.only(top: 16),
                  child: Image.file(_imageFile!, fit: BoxFit.contain)),
            if (_imageFile == null) ...[
              SizedBox(height: 10),
              ClipRRect(
                borderRadius: BorderRadius.circular(3),
                child: CachedNetworkImage(
                  imageUrl: widget.promotion.image,
                  placeholder: (context, url) =>
                      Image.asset('images/placeholder.png'),
                  errorWidget: (context, url, error) =>
                      Image.asset('images/error_image.png'),
                  fit: BoxFit.cover,
                ),
              ),
            ],
            const SizedBox(height: 16),
            TextField(
              controller: _textEditingController,
              maxLines: 10,
              decoration: InputDecoration(
                  labelText: langUserPhone == "fr"
                      ? 'Description de la promotion'
                      : 'Description of the promotion',
                  border: OutlineInputBorder()),
            ),
            const SizedBox(height: 16),
            if (load) ...[
              SelectFormField(
                decoration: InputDecoration(
                    labelText: langUserPhone == "fr"
                        ? 'Methode de paiement mobile'
                        : 'Mobile payment method',
                    border: OutlineInputBorder()),
                type: SelectFormFieldType.dropdown,
                initialValue: "mtn",
                items: [
                  {"value": "mtn", "label": "Mtn"},
                  {"value": "moov", "label": "Moov"},
                  {"value": "orange", "label": "Orange"}
                ],
                onChanged: (val) => setState(() => valueMethodePaiement = val),
              ),
              const SizedBox(height: 20),
              TextField(
                controller: telController,
                keyboardType: TextInputType.phone,
                decoration: InputDecoration(
                    labelText: langUserPhone == "fr"
                        ? "N° de téléphone"
                        : "Phone number",
                    border: OutlineInputBorder()),
              ),
            ],
            ElevatedButton(
              onPressed: _isSending ? null : _sendData,
              style: ElevatedButton.styleFrom(
                  backgroundColor: Colors.blue,
                  shape: StadiumBorder(),
                  padding: EdgeInsets.symmetric(vertical: 13)),
              child: Text(
                  langUserPhone == "fr" ? 'Envoyer la demande' : 'Send request',
                  style: GoogleFonts.poppins(
                      color: Colors.white, fontWeight: FontWeight.w600)),
            ),
          ],
        ),
      ),
    );
  }
}
