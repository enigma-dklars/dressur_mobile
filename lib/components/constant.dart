// ignore_for_file: prefer_typing_uninitialized_variables, non_constant_identifier_names, prefer_const_constructors

import 'dart:async';
import 'dart:convert';
import 'dart:io';
import 'package:dressur/components/111_generaleApiDomaine.dart';
import 'package:dressur/components/noti_sys.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart' show ByteData, Uint8List, rootBundle;
import 'package:flutter_contacts/flutter_contacts.dart';
import 'package:dressur/components/sql_helper.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:path_provider/path_provider.dart';
import 'package:share_plus/share_plus.dart';
import 'package:url_launcher/url_launcher.dart';
import 'package:http/http.dart' as http;

const versionApp = '1.1.0';
const oldDatabaseName = 'onze_dressur.db';
const nowDataBaseName = 'douze_dressur.db';
bool modeReconnaissanceContactArrierePlan = false;
const generalRouteForApi = '$generalApiDomaine/api';
const generalRouteForPromotionImage = '$generalApiDomaine/promotion/';

const tiktokDS = "https://www.tiktok.com/@bluelife.tech";
const facebookDS = "https://www.facebook.com/dressurds";
const instagramDS =
    "https://www.instagram.com/bluelife.tech?igsh=Mjcyc2tpMmw4dXhu";
const chaineWhatsApp = "https://whatsapp.com/channel/0029Vag8B6cCBtxMRvCqaA3t";
const facebookBLT = "https://www.facebook.com/bluelife.tech";
const facebookELTCS = "https://www.facebook.com/eliticscore";
const tiktokBLT = "https://www.tiktok.com/@bluelife.tech";
const tiktokELTCS = "https://www.tiktok.com/@eliticscore1";
const instagramBLT = "https://www.instagram.com/bluelife.tech";
const instagramELTCS = "https://www.instagram.com/eliticscore";
const youtubeBLT = "https://www.youtube.com/@bluelife-tech";
const whatsappDSURL = "whatsapp://send?phone=22964044294";
const dressurConditionUtilisation =
    "https://www.bluelife.tech/realisations/dressur/condition";
const dressurPolitiqueConfidentialite =
    "https://www.bluelife.tech/realisations/dressur/politique";
const dressurUrlPlaystore =
    "https://play.google.com/store/apps/details?id=com.dressur.ds";

const primaryColor = Color(0xFF2a4b9a);
const secondaryColor = Colors.indigoAccent;
const String createUserInfosTable = """
    CREATE TABLE userInfos(
      idDS INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
      tableName TEXT,
      id INTEGER,
      uid TEXT,
      contactTel TEXT
    );
  """;
const String createDiscussionTable = """
    CREATE TABLE discussion(
      id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
      uid TEXT,
      nom TEXT,
      date INTEGER
    );
  """;
const String createMessageTable = """
    CREATE TABLE message(
      id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
      emetteur TEXT,
      recepteur TEXT,
      message TEXT,
      dateEnvoi TEXT,
      vue TEXT
    );
  """;

int nbrAffichageAvertissement = 0;
List<dynamic> userChatInfo = [];
List<dynamic> contactsUserBeforeDS = [];
List<dynamic> contactsEnregistrer = [];
String? langUserPhone = "en";
String preferencePaysText = "";
String preferenceCentreInteretLoisirText = "";
int commissionBonus = 200;
int nombreContacts = 0;
int nombreContactDispo = 0;
bool mailIsMaxxFire = false;
bool siParrain = false;
bool affUserName = false;
bool telIsVerified = false;
bool mailIsVerified = false;
bool ihaveConnexion = false;
bool admin = false;
bool permissionAdd = false;
bool boostEnCours = false;
bool isInscritProgrammeRecompense = false;
var modeMotDePasseOublier = false;
var mailConnexion = "";
var textChargementEvolution = "Chargement ...";
var addUserOnAutreProfilPage = "oui";
var myDressurVersion = '1.1.0';
var lesPublicites;
var uidAutreUser;
var uidUser;
var name_complete;
var pseudo;
var nom;
var mail;
var pays;
var tel;
var apropos;
var soldeBonus;
var codeBonus;
var createdAt;
var nombreFilleuls;
var messageErreurPermissionAdd;
var tiktok;
var instagram;
var facebook;
var youtube;
var totalImpressions;
var totalVues;
var totalImpressionsText;
var totalVuesText;
var soldeProgrammeRecompense;

Future<bool> isConnectedToInternet() async {
  try {
    final result = await InternetAddress.lookup('google.com');
    if (result.isNotEmpty && result[0].rawAddress.isNotEmpty) {
      return true;
    }
  } catch (e) {
    return false;
  }
  return false;
}

Future<void> insertNumTelUserIntoDataBase(numberTel) async {
  SQLHelper.insert("userInfos", {
    'tableName': "numsTelUser",
    'contactTel': numberTel,
  });
}

Future<void> initUserInformations(userInfos) async {
  myDressurVersion = userInfos["myDressurVersion"];
  mailIsMaxxFire = userInfos["mailIsMaxxFire"];
  uidUser = userInfos["uid"];
  name_complete = userInfos["name_complete"];
  pseudo = userInfos["pseudo"];
  nom = userInfos["nom"];
  mail = userInfos["mail"];
  pays = userInfos["pays"];
  tel = userInfos["tel"];
  apropos = userInfos["apropos"];
  tiktok = userInfos["tiktok"];
  instagram = userInfos["instagram"];
  facebook = userInfos["facebook"];
  youtube = userInfos["youtube"];
  mailIsVerified = userInfos["mailIsVerified"];
  telIsVerified = userInfos["telIsVerified"];
  soldeBonus = userInfos["soldeBonus"];
  codeBonus = userInfos["codeBonus"];
  createdAt = userInfos["createdAt"];
  siParrain = userInfos["siParrain"];
  nombreFilleuls = userInfos["nombreFilleuls"];
  commissionBonus = userInfos["commissionBonus"];
  admin = userInfos["admin"];
  permissionAdd = userInfos["permissionAdd"];
  messageErreurPermissionAdd = userInfos["messageErreurPermissionAdd"];
  lesPublicites = userInfos["lesPublicites"];
  preferencePaysText = preferencePaysToText(userInfos["preferencePays"]);
  nombreContactDispo = userInfos["nombreContactDispo"];
  totalImpressions = userInfos["totalImpressions"];
  totalVues = userInfos["totalVues"];
  totalImpressionsText = userInfos["totalImpressionsText"];
  totalVuesText = userInfos["totalVuesText"];
  boostEnCours = userInfos["boostEnCours"];
  isInscritProgrammeRecompense =
      userInfos["isInscritProgrammeRecompense"] ?? false;
  soldeProgrammeRecompense = userInfos["soldeProgrammeRecompense"] ?? 0;
  SQLHelper.viderLaBaseDeDonneeLocal();

  SQLHelper.insert("userInfos", {
    'tableName': "user",
    'id': 0,
    'uid': userInfos["uid"],
  });
}

String preferencePaysToText(preferencePays) {
  preferencePaysText = "";
  countryCodes.entries.map((entry) {
    var dataIsselected = preferencePays.contains(entry.key) ? true : false;
    if (dataIsselected == true) {
      if (preferencePaysText.isEmpty) {
        preferencePaysText = entry.value;
      } else {
        preferencePaysText = "$preferencePaysText, ${entry.value}";
      }
    }
  }).toList();
  if (preferencePaysText.isEmpty) {
    preferencePaysText = (langUserPhone == 'fr') ? "Aucun Choix" : "No Choice";
  }
  return preferencePaysText;
}

void insertDressurContact() async {
  if ((await SQLHelper.getOneNumsTelUser("+22964044294")).isEmpty) {
    final newContact = Contact()
      ..isStarred = true
      ..name.first = "Dressur Assistance ✅"
      ..phones = [Phone("+22964044294")]
      ..emails = [Email("dressur@gmail.com")]
      ..websites = [
        Website(whatsappDSURL),
        Website(facebookDS),
        Website(facebookBLT),
        Website(tiktokBLT),
        Website(instagramBLT),
        Website(youtubeBLT),
        Website(facebookELTCS),
        Website(tiktokELTCS),
        Website(instagramELTCS),
      ];
    await newContact.insert();
    await insertNumTelUserIntoDataBase("+22964044294");
  }
}

List<Map<String, dynamic>> listeMethodePaiements = [];

// map de tous les pays du monde
Map<String, String> countryCodes = {
  '93': 'Afghanistan',
  '355': 'Albanie',
  '213': 'Algérie',
  '376': 'Andorre',
  '244': 'Angola',
  '1264': 'Anguilla',
  '1268': 'Antigua-et-Barbuda',
  '54': 'Argentine',
  '374': 'Arménie',
  '297': 'Aruba',
  '247': 'Ascension',
  '61': 'Australie',
  '43': 'Autriche',
  '994': 'Azerbaïdjan',
  '1242': 'Bahamas',
  '973': 'Bahreïn',
  '880': 'Bangladesh',
  '1246': 'Barbade',
  '375': 'Biélorussie',
  '32': 'Belgique',
  '501': 'Belize',
  '229': 'Bénin',
  '1441': 'Bermudes',
  '975': 'Bhoutan',
  '591': 'Bolivie',
  '387': 'Bosnie-Herzégovine',
  '267': 'Botswana',
  '55': 'Brésil',
  '246': 'Territoire britannique de l\'océan Indien',
  '1284': 'Îles Vierges britanniques',
  '673': 'Brunéi Darussalam',
  '359': 'Bulgarie',
  '226': 'Burkina Faso',
  '257': 'Burundi',
  '855': 'Cambodge',
  '237': 'Cameroun',
  '1': 'Canada',
  '238': 'Cap-Vert',
  '1345': 'Îles Caïmans',
  '236': 'République centrafricaine',
  '235': 'Tchad',
  '64': 'Nouvelle-Zélande',
  '56': 'Chili',
  '86': 'Chine',
  '57': 'Colombie',
  '269': 'Comores',
  '242': 'République du Congo',
  '243': 'République démocratique du Congo',
  '682': 'Îles Cook',
  '506': 'Costa Rica',
  '385': 'Croatie',
  '53': 'Cuba',
  '599': 'Curaçao',
  '357': 'Chypre',
  '420': 'République tchèque',
  '45': 'Danemark',
  '253': 'Djibouti',
  '1767': 'Dominique',
  '1809': 'République dominicaine',
  '1829': 'République dominicaine',
  '1849': 'République dominicaine',
  '593': 'Équateur',
  '20': 'Égypte',
  '503': 'El Salvador',
  '240': 'Guinée équatoriale',
  '291': 'Érythrée',
  '372': 'Estonie',
  '251': 'Éthiopie',
  '500': 'Îles Falkland',
  '298': 'Îles Féroé',
  '679': 'Fidji',
  '358': 'Finlande',
  '33': 'France',
  '594': 'Guyane française',
  '689': 'Polynésie française',
  '241': 'Gabon',
  '220': 'Gambie',
  '995': 'Géorgie',
  '49': 'Allemagne',
  '233': 'Ghana',
  '350': 'Gibraltar',
  '30': 'Grèce',
  '299': 'Groenland',
  '1473': 'Grenade',
  '590': 'Guadeloupe',
  '1671': 'Guam',
  '502': 'Guatemala',
  '44': 'Royaume-Uni',
  '224': 'Guinée',
  '245': 'Guinée-Bissau',
  '592': 'Guyana',
  '509': 'Haïti',
  '504': 'Honduras',
  '852': 'Hong Kong',
  '36': 'Hongrie',
  '354': 'Islande',
  '91': 'Inde',
  '62': 'Indonésie',
  '98': 'Iran',
  '964': 'Irak',
  '353': 'Irlande',
  '972': 'Israël',
  '39': 'Italie',
  '225': 'Côte d\'Ivoire',
  '1876': 'Jamaïque',
  '81': 'Japon',
  '962': 'Jordanie',
  '7': 'Kazakhstan',
  '254': 'Kenya',
  '686': 'Kiribati',
  '965': 'Koweït',
  '996': 'Kirghizistan',
  '856': 'Laos',
  '371': 'Lettonie',
  '961': 'Liban',
  '266': 'Lesotho',
  '231': 'Libéria',
  '218': 'Libye',
  '423': 'Liechtenstein',
  '370': 'Lituanie',
  '352': 'Luxembourg',
  '853': 'Macau',
  '389': 'Macédoine',
  '261': 'Madagascar',
  '265': 'Malawi',
  '60': 'Malaisie',
  '960': 'Maldives',
  '223': 'Mali',
  '356': 'Malte',
  '692': 'Îles Marshall',
  '596': 'Martinique',
  '222': 'Mauritanie',
  '230': 'Maurice',
  '262': 'Mayotte',
  '52': 'Mexique',
  '691': 'Micronésie',
  '373': 'Moldavie',
  '377': 'Monaco',
  '976': 'Mongolie',
  '382': 'Monténégro',
  '1664': 'Montserrat',
  '212': 'Maroc',
  '258': 'Mozambique',
  '95': 'Myanmar',
  '264': 'Namibie',
  '674': 'Nauru',
  '977': 'Népal',
  '31': 'Pays-Bas',
  '687': 'Nouvelle-Calédonie',
  '505': 'Nicaragua',
  '227': 'Niger',
  '234': 'Nigeria',
  '683': 'Niue',
  '672': 'Île Norfolk',
  '850': 'Corée du Nord',
  '1670': 'Îles Mariannes du Nord',
  '47': 'Norvège',
  '968': 'Oman',
  '92': 'Pakistan',
  '680': 'Palaos',
  '970': 'Palestine',
  '507': 'Panama',
  '675': 'Papouasie-Nouvelle-Guinée',
  '595': 'Paraguay',
  '51': 'Pérou',
  '63': 'Philippines',
  '48': 'Pologne',
  '351': 'Portugal',
  '1787': 'Porto Rico',
  '1939': 'Porto Rico',
  '974': 'Qatar',
  '40': 'Roumanie',
  '250': 'Rwanda',
  '290': 'Sainte-Hélène',
  '1869': 'Saint-Kitts-et-Nevis',
  '1758': 'Sainte-Lucie',
  '508': 'Saint-Pierre-et-Miquelon',
  '1784': 'Saint-Vincent-et-les-Grenadines',
  '685': 'Samoa',
  '378': 'Saint-Marin',
  '239': 'Sao Tomé-et-Principe',
  '966': 'Arabie saoudite',
  '221': 'Sénégal',
  '381': 'Serbie',
  '248': 'Seychelles',
  '232': 'Sierra Leone',
  '65': 'Singapour',
  '1721': 'Saint-Martin (partie néerlandaise)',
  '421': 'Slovaquie',
  '386': 'Slovénie',
  '677': 'Îles Salomon',
  '252': 'Somalie',
  '27': 'Afrique du Sud',
  '82': 'Corée du Sud',
  '211': 'Soudan du Sud',
  '34': 'Espagne',
  '94': 'Sri Lanka',
  '249': 'Soudan',
  '597': 'Suriname',
  '4779': 'Svalbard et Jan Mayen',
  '268': 'Swaziland',
  '46': 'Suède',
  '41': 'Suisse',
  '963': 'Syrie',
  '886': 'Taïwan',
  '992': 'Tadjikistan',
  '255': 'Tanzanie',
  '66': 'Thaïlande',
  '670': 'Timor oriental',
  '228': 'Togo',
  '690': 'Tokelau',
  '676': 'Tonga',
  '1868': 'Trinité-et-Tobago',
  '216': 'Tunisie',
  '90': 'Turquie',
  '993': 'Turkménistan',
  '1649': 'Îles Turques-et-Caïques',
  '688': 'Tuvalu',
  '1340': 'Îles Vierges américaines',
  '256': 'Ouganda',
  '380': 'Ukraine',
  '971': 'Émirats arabes unis',
  '598': 'Uruguay',
  '998': 'Ouzbékistan',
  '678': 'Vanuatu',
  '379': 'Cité du Vatican',
  '58': 'Venezuela',
  '84': 'Vietnam',
  '681': 'Wallis-et-Futuna',
  '967': 'Yémen',
  '260': 'Zambie',
  '263': 'Zimbabwe',
};

List<Map<String, dynamic>> listeTypePromoAffaire = [
  {
    'value': 'produit_service',
    'label': 'Produits, Services, Événements etc.',
  },
  {
    'value': 'dmd_emploi',
    'label': "Demandes d'emploi",
  },
  {
    'value': 'offre_emploi',
    'label': "Offres d'emploi",
  },
];

String getCurrentYear() {
  // Obtenez la date actuelle
  DateTime now = DateTime.now();

  // Obtenez l'année à partir de la date actuelle
  String currentYear = now.year.toString();

  return currentYear;
}

void launchPhoneCall(String phoneNumber) async {
  final Uri _url = Uri.parse('tel:$phoneNumber');
  if (!await launchUrl(_url, mode: LaunchMode.externalApplication)) {
    throw 'Could not launch $_url';
  }
}

void launchSMS(String phoneNumber) async {
  final Uri _url = Uri.parse('sms:$phoneNumber');
  if (!await launchUrl(_url, mode: LaunchMode.externalApplication)) {
    throw 'Could not launch $_url';
  }
}

void launchEmail(String emailAddress) async {
  final Uri _url = Uri.parse('mailto:$emailAddress');
  if (!await launchUrl(_url, mode: LaunchMode.externalApplication)) {
    throw 'Could not launch $_url';
  }
}

void launchWhatsApp(String phoneNumber) async {
  final Uri _url = Uri.parse('https://wa.me/$phoneNumber');
  if (!await launchUrl(_url, mode: LaunchMode.externalApplication)) {
    throw 'Could not launch $_url';
  }
}

void launchPaiement(String urlPaiement) async {
  final Uri _url = Uri.parse(urlPaiement);
  if (!await launchUrl(_url, mode: LaunchMode.externalApplication)) {
    throw 'Could not launch $_url';
  }
}

Future<void> shareMessageWithImage(
    BuildContext context, String langUserPhone) async {
  var messageShare = (langUserPhone == "fr")
      ? "Utilise Dressur, une application simple, sûr et fiable pour avoir de la visibilité sur tes différents réseaux sociaux et surtout sur tes statuts WhatsApp.\nGrâce à Dressur, fait la promotion de tes produits et services qui seront visibles par des milliers d'utilisateurs en seulement 24H.\nElle te permet d'avoir plus facilement des contacts WhatsApp selon les pays de ton choix. De plus, ses contacts sont automatiquement enregistrés dans ton téléphone et ton contact dans les leurs, etc.\n\nA téléchargé gratuitement sur Play Store : https://play.google.com/store/apps/details?id=com.dressur.ds\n\nOu la version web si tu n'as pas d'Android : https://dressur.site/inscription"
      : "Use Dressur, a simple, safe and reliable application to have visibility on your different social networks and especially on your WhatsApp statuses.\nThanks to Dressur, promote your products and services that will be visible to thousands of users in just 24 hours.\nIt allows you to more easily have WhatsApp contacts according to the countries of your choice. In addition, its contacts are automatically saved in your phone and your contact in theirs, etc.\n\nDownloaded for free on Play Store: https://play.google.com/store/apps/details?id=com.dressur.ds\n\nOr the web version if you don't have an Android: https://dressur.site/inscription";

  // Load the image from assets
  final ByteData bytes = await rootBundle.load('images/flyers_dressur_fr.jpg');
  final Uint8List list = bytes.buffer.asUint8List();

  final ByteData bytes2 = await rootBundle.load('images/flyers_dressur_en.jpg');
  final Uint8List list2 = bytes2.buffer.asUint8List();

  // Get the temporary directory
  final tempDir = await getTemporaryDirectory();

  final file = await File('${tempDir.path}/flyers_dressur_fr.jpg').create();
  file.writeAsBytesSync(list);

  final file2 = await File('${tempDir.path}/flyers_dressur_en.jpg').create();
  file2.writeAsBytesSync(list2);

  // Share the image and the message
  await Share.shareXFiles([XFile(file.path), XFile(file2.path)],
      text: messageShare, subject: 'Partager Dressur!');
}

Future<void> sharePromotion(BuildContext context, String imageLink,
    String imageName, String messageShare) async {
  messageShare += "\n\n";
  messageShare +=
      (langUserPhone == "fr") ? "Depuis Dressur : " : "From Dressur : ";
  messageShare += dressurUrlPlaystore;

  // Télécharger l'image depuis le lien HTTP
  final http.Response response = await http.get(Uri.parse(imageLink));

  if (response.statusCode == 200) {
    // Obtenir le répertoire temporaire
    final tempDir = await getTemporaryDirectory();

    // Créer un fichier et écrire l'image téléchargée
    final file = await File('${tempDir.path}/$imageName').create();
    await file.writeAsBytes(response.bodyBytes);

    // Partager l'image et le message
    await Share.shareXFiles([XFile(file.path)],
        text: messageShare, subject: 'Partager Promotion!');
  } else {
    // Gérer les erreurs de téléchargement
    ScaffoldMessenger.of(context).showSnackBar(SnackBar(
        backgroundColor: Colors.red,
        behavior: SnackBarBehavior.floating,
        content: Text(
          'Erreur de téléchargement de l\'image',
          style: GoogleFonts.poppins(
            color: Colors.white,
          ),
        )));
  }
}

Future<String> shortenUrl(String longUrl) async {
  final url = 'https://tinyurl.com/api-create.php?url=$longUrl';
  final response = await http.get(Uri.parse(url));
  if (response.statusCode == 200) {
    return response.body;
  } else {
    // throw Exception('Failed to shorten URL: ${response.body}');
    return longUrl;
  }
}

Future<String> expandShortUrl(String shortUrl) async {
  final url = 'https://unshorten.me/s/$shortUrl';
  final response = await http.get(Uri.parse(url));
  if (response.statusCode == 200) {
    return response.body;
  } else {
    // throw Exception('Failed to expand short URL: ${response.body}');
    return shortUrl;
  }
}

// --- DÉBUT DU BLOC AMÉLIORÉ ---

void showConfNumeroWhatsapp(BuildContext context) {
  final theme = Theme.of(context);
  final isDark = theme.brightness == Brightness.dark;

  showModalBottomSheet(
    context: context,
    isScrollControlled: true,
    // Applique les coins arrondis standards des modales modernes
    shape: RoundedRectangleBorder(
      borderRadius: BorderRadius.vertical(top: Radius.circular(25)),
    ),
    backgroundColor: isDark ? Color(0xFF1E1E1E) : Colors.white,
    builder: (_) => Container(
      padding: EdgeInsets.only(
        top: 12,
        left: 20,
        right: 20,
        bottom: MediaQuery.of(context).viewInsets.bottom + 30,
      ),
      child: Column(
        mainAxisSize: MainAxisSize.min,
        children: [
          // --- Poignée de glissement (standard UX) ---
          Container(
            width: 40,
            height: 5,
            decoration: BoxDecoration(
              color: Colors.grey[300],
              borderRadius: BorderRadius.circular(10),
            ),
          ),
          SizedBox(height: 25),

          // --- Icône et Titre ---
          Icon(FontAwesomeIcons.whatsapp, color: Color(0xFF25D366), size: 50),
          SizedBox(height: 16),
          Text(
            (langUserPhone == "fr")
                ? "Confirmer votre numéro"
                : "Confirm Your Number",
            textAlign: TextAlign.center,
            style: GoogleFonts.poppins(
              fontSize: 22,
              fontWeight: FontWeight.bold,
              color: isDark ? Colors.white : Colors.black87,
            ),
          ),
          SizedBox(height: 10),
          Text(
            (langUserPhone == "fr")
                ? "C'est simple et rapide. Suivez les étapes ci-dessous."
                : "It's quick and easy. Follow the steps below.",
            textAlign: TextAlign.center,
            style: GoogleFonts.poppins(
              fontSize: 15,
              color: Colors.grey[600],
            ),
          ),
          SizedBox(height: 30),

          // --- Étapes claires ---
          _buildStep(
            icon: Icons.looks_one_outlined,
            title: (langUserPhone == "fr")
                ? "Cliquez sur le bouton"
                : "Click the button",
            subtitle: (langUserPhone == "fr")
                ? "Appuyez sur \"Contacter le Support\" ci-dessous."
                : "Press \"Contact Support\" below.",
          ),
          SizedBox(height: 20),
          _buildStep(
            icon: Icons.looks_two_outlined,
            title: (langUserPhone == "fr")
                ? "Envoyez le message"
                : "Send the message",
            subtitle: (langUserPhone == "fr")
                ? "Un message pré-rempli \"WhatsApp Confirmation\" sera prêt. Envoyez-le sans le modifier."
                : "A pre-filled message \"WhatsApp Confirmation\" will be ready. Send it without modification.",
          ),
          SizedBox(height: 20),
          _buildStep(
            icon: Icons.looks_3_outlined,
            title:
                (langUserPhone == "fr") ? "Patientez" : "Wait for confirmation",
            subtitle: (langUserPhone == "fr")
                ? "Notre équipe traitera votre demande rapidement. Vous serez notifié."
                : "Our team will process your request quickly. You will be notified.",
          ),
          SizedBox(height: 40),

          // --- Bouton d'action principal ---
          SizedBox(
            width: double.infinity,
            child: ElevatedButton.icon(
              onPressed: () async {
                final Uri _url =
                    Uri.parse("$whatsappDSURL&text=WhatsApp Confirmation");
                if (!await launchUrl(_url,
                    mode: LaunchMode.externalApplication)) {
                  // Gérer l'erreur si WhatsApp ne peut pas être ouvert
                  ScaffoldMessenger.of(context).showSnackBar(
                    SnackBar(
                        content: Text((langUserPhone == "fr")
                            ? "Impossible d'ouvrir WhatsApp."
                            : "Could not open WhatsApp.")),
                  );
                }
              },
              icon: Icon(FontAwesomeIcons.whatsapp, color: Colors.white),
              label: Text(
                (langUserPhone == "fr")
                    ? "Contacter le Support"
                    : "Contact Support",
                style: GoogleFonts.poppins(
                    fontWeight: FontWeight.bold, fontSize: 16),
              ),
              style: ElevatedButton.styleFrom(
                backgroundColor:
                    Color(0xFF25D366), // Couleur officielle de WhatsApp
                foregroundColor: Colors.white,
                padding: EdgeInsets.symmetric(vertical: 16),
                shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(15)),
              ),
            ),
          ),
        ],
      ),
    ),
  );
}

// Helper pour construire une étape
Widget _buildStep(
    {required IconData icon, required String title, required String subtitle}) {
  return Row(
    crossAxisAlignment: CrossAxisAlignment.start,
    children: [
      Icon(icon, color: primaryColor, size: 28),
      SizedBox(width: 16),
      Expanded(
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(
              title,
              style: GoogleFonts.poppins(
                  fontSize: 16, fontWeight: FontWeight.w600),
            ),
            SizedBox(height: 4),
            Text(
              subtitle,
              style: GoogleFonts.poppins(
                  color: Colors.grey[600], fontSize: 14, height: 1.4),
            ),
          ],
        ),
      ),
    ],
  );
}

// --- FIN DU BLOC AMÉLIORÉ ---
Future<void> saveContactDsIfNotExiste() async {
  int nombreNewContact = 0;
  nombreNewContact = 0;
  contactsEnregistrer = [];
  final url =
      Uri.parse('$generalRouteForApi/listContactDS/$uidUser/$langUserPhone');
  final response = await http.get(url);
  if (response.statusCode == 200) {
    final jsonData = jsonDecode(response.body) as List<dynamic>;
    if (jsonData.isNotEmpty) {
      for (var contact in jsonData) {
        if (contact['tel'] != "+22964044294" &&
            contact['tel'] != "22964044294" &&
            contact['tel'] != "64044294" &&
            !contactsEnregistrer.contains(contact['tel'])) {
          contactsEnregistrer.add(contact['tel']);
        }
        if ((await SQLHelper.getOneNumsTelUser(contact['tel'])).isEmpty) {
          final newContact = Contact()
            ..name.first = contact["nom"] + " #DS"
            ..phones = [Phone(contact["tel"])];
          await newContact.insert();
          await insertNumTelUserIntoDataBase(contact["tel"]);
          nombreNewContact++;
        }
      }
      if (nombreNewContact == 1) {
        showNotification(
          "ADD Conatcts Dressur",
          "$nombreNewContact nouveau contact enregistré par Dressur.",
        );
      } else if (nombreNewContact > 1) {
        showNotification(
          "ADD Conatcts Dressur",
          "$nombreNewContact nouveaux contacts enregistrés par Dressur.",
        );
      }
    }
  }
}

extension StringExtension on String {
  String capitalize() {
    if (isEmpty) return this;
    return this[0].toUpperCase() + substring(1).toLowerCase();
  }
}
