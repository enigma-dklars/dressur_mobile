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
  preferenceCentreInteretLoisirText = preferenceCentreInteretLoisirToText(
      userInfos["preferenceCentreInteretLoisir"]);
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

String preferenceCentreInteretLoisirToText(preferenceCentreInteretLoisir) {
  preferenceCentreInteretLoisirText = "";
  centreInteretLoisir.map((entry) {
    var dataIsselected =
        preferenceCentreInteretLoisir.contains(entry['value']) ? true : false;
    var label = (langUserPhone == 'fr') ? entry['labelFr'] : entry['labelEn'];
    if (dataIsselected == true) {
      if (preferenceCentreInteretLoisirText.isEmpty) {
        preferenceCentreInteretLoisirText = label;
      } else {
        preferenceCentreInteretLoisirText =
            "$preferenceCentreInteretLoisirText, $label";
      }
    }
  }).toList();
  if (preferenceCentreInteretLoisirText.isEmpty) {
    preferenceCentreInteretLoisirText =
        (langUserPhone == 'fr') ? "Aucun Choix" : "No Choice";
  }
  return preferenceCentreInteretLoisirText;
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

List<Map<String, dynamic>> centreInteretLoisir = [
  {
    'value': '1',
    'labelFr': 'Lecture',
    'labelEn': 'Reading',
    'descpFr': 'Lecture de romans, de poésie ou de bandes dessinées.',
    'descpEn': 'Reading novels, poetry, or comic books.',
  },
  {
    'value': '2',
    'labelFr': 'Cuisine',
    'labelEn': 'Cooking',
    'descpFr':
        'Cuisiner des plats traditionnels ou expérimenter de nouvelles recettes.',
    'descpEn': 'Cooking traditional dishes or experimenting with new recipes.',
  },
  {
    'value': '3',
    'labelFr': 'Musique',
    'labelEn': 'Music',
    'descpFr':
        "Jouer d'un instrument de musique ou découvrir de nouveaux artistes.",
    'descpEn': 'Playing a musical instrument or discovering new artists.',
  },
  {
    'value': '4',
    'labelFr': 'Randonnée',
    'labelEn': 'Hiking',
    'descpFr': 'Explorer la nature à pied et découvrir de nouveaux sentiers.',
    'descpEn': 'Exploring nature on foot and discovering new trails.',
  },
  {
    'value': '5',
    'labelFr': 'Photographie',
    'labelEn': 'Photography',
    'descpFr':
        'Capturer des moments précieux et explorer différents styles photographiques.',
    'descpEn':
        'Capturing precious moments and exploring different photographic styles.',
  },
  {
    'value': '6',
    'labelFr': 'Artisanat',
    'labelEn': 'Crafting',
    'descpFr':
        'Fabriquer des objets à la main comme des bijoux, des vêtements ou de la poterie.',
    'descpEn': 'Making handmade items such as jewelry, clothing, or pottery.',
  },
  {
    'value': '7',
    'labelFr': 'Jardinage',
    'labelEn': 'Gardening',
    'descpFr':
        'Cultiver des plantes, des fleurs ou des légumes dans un jardin.',
    'descpEn': 'Growing plants, flowers, or vegetables in a garden.',
  },
  {
    'value': '8',
    'labelFr': 'Yoga',
    'labelEn': 'Yoga',
    'descpFr':
        'Pratiquer des postures et des exercices de respiration pour la relaxation et la santé.',
    'descpEn':
        'Practicing postures and breathing exercises for relaxation and health.',
  },
  {
    'value': '9',
    'labelFr': 'Langues étrangères',
    'labelEn': 'Foreign Languages',
    'descpFr':
        'Apprendre une nouvelle langue étrangère et explorer différentes cultures.',
    'descpEn':
        'Learning a new foreign language and exploring different cultures.',
  },
  {
    'value': '10',
    'labelFr': 'Jeux de société',
    'labelEn': 'Board Games',
    'descpFr': 'Jouer à des jeux de société avec des amis ou en famille.',
    'descpEn': 'Playing board games with friends or family.',
  },
  {
    'value': '11',
    'labelFr': 'Cinéma',
    'labelEn': 'Cinema',
    'descpFr':
        'Regarder des films classiques, des nouveautés ou explorer des genres cinématographiques variés.',
    'descpEn':
        'Watching classic films, new releases, or exploring various film genres.',
  },
  {
    'value': '12',
    'labelFr': 'Sports',
    'labelEn': 'Sports',
    'descpFr':
        'Pratiquer un sport comme le football, le tennis, ou le basketball.',
    'descpEn': 'Playing a sport such as soccer, tennis, or basketball.',
  },
  {
    'value': '13',
    'labelFr': 'Écriture créative',
    'labelEn': 'Creative Writing',
    'descpFr':
        'Écrire des histoires, des poèmes ou des articles pour exprimer sa créativité.',
    'descpEn': 'Writing stories, poems, or articles to express creativity.',
  },
  {
    'value': '14',
    'labelFr': 'Voyage',
    'labelEn': 'Travel',
    'descpFr':
        'Explorer de nouveaux pays, villes et cultures à travers le monde.',
    'descpEn':
        'Exploring new countries, cities, and cultures around the world.',
  },
  {
    'value': '15',
    'labelFr': 'Danse',
    'labelEn': 'Dancing',
    'descpFr':
        'Apprendre à danser différents styles comme la salsa, le hip-hop ou la danse contemporaine.',
    'descpEn':
        'Learning to dance different styles such as salsa, hip-hop, or contemporary dance.',
  },
  {
    'value': '16',
    'labelFr': 'Observation des étoiles',
    'labelEn': 'Stargazing',
    'descpFr':
        'Observer les étoiles, les planètes et les constellations dans le ciel nocturne.',
    'descpEn': 'Observing stars, planets, and constellations in the night sky.',
  },
  {
    'value': '17',
    'labelFr': 'Arts martiaux',
    'labelEn': 'Martial Arts',
    'descpFr':
        "Pratiquer des arts martiaux comme le karaté, le judo ou le taekwondo.",
    'descpEn': 'Practicing martial arts such as karate, judo, or taekwondo.',
  },
  {
    'value': '18',
    'labelFr': 'Photographie animalière',
    'labelEn': 'Wildlife Photography',
    'descpFr':
        'Photographier des animaux dans leur habitat naturel et capturer leur comportement.',
    'descpEn':
        'Photographing animals in their natural habitat and capturing their behavior.',
  },
  {
    'value': '19',
    'labelFr': 'Théâtre',
    'labelEn': 'Theater',
    'descpFr':
        'Jouer dans des pièces de théâtre ou assister à des représentations théâtrales.',
    'descpEn': 'Acting in plays or attending theatrical performances.',
  },
  {
    'value': '20',
    'labelFr': 'Volontariat',
    'labelEn': 'Volunteering',
    'descpFr':
        "Donner de son temps pour aider les autres ou s'impliquer dans des causes sociales.",
    'descpEn':
        'Volunteering time to help others or getting involved in social causes.',
  },
  {
    "value": "21",
    "labelFr": "Arts plastiques",
    "labelEn": "Visual Arts",
    "descpFr":
        "Exprimer sa créativité à travers la peinture, le dessin ou la sculpture.",
    "descpEn": "Expressing creativity through painting, drawing, or sculpture."
  },
  {
    "value": "22",
    "labelFr": "Échecs",
    "labelEn": "Chess",
    "descpFr":
        "Jouer à un jeu de stratégie qui demande réflexion et concentration.",
    "descpEn":
        "Playing a strategic game that requires thought and concentration."
  },
  {
    "value": "23",
    "labelFr": "Course à pied",
    "labelEn": "Running",
    "descpFr": "Courir pour la santé, le plaisir ou la compétition.",
    "descpEn": "Running for health, enjoyment, or competition."
  },
  {
    "value": "24",
    "labelFr": "Pêche",
    "labelEn": "Fishing",
    "descpFr":
        "Pratiquer la pêche en eau douce ou en mer pour se détendre et se reconnecter à la nature.",
    "descpEn":
        "Fishing in freshwater or saltwater to relax and reconnect with nature."
  },
  {
    "value": "25",
    "labelFr": "Équitation",
    "labelEn": "Horseback Riding",
    "descpFr":
        "Faire de l'équitation pour le plaisir, l'exercice physique et le lien avec les animaux.",
    "descpEn":
        "Riding horses for pleasure, physical exercise, and connection with animals."
  },
  {
    "value": "26",
    "labelFr": "Jardinage vertical",
    "labelEn": "Vertical Gardening",
    "descpFr":
        "Cultiver des plantes en hauteur sur des structures verticales comme des murs ou des treillis.",
    "descpEn":
        "Growing plants vertically on structures such as walls or trellises."
  },
  {
    "value": "27",
    "labelFr": "Méditation",
    "labelEn": "Meditation",
    "descpFr":
        "Pratiquer la méditation pour la relaxation, la clarté mentale et la gestion du stress.",
    "descpEn":
        "Practicing meditation for relaxation, mental clarity, and stress management."
  },
  {
    "value": "28",
    "labelFr": "Plongée sous-marine",
    "labelEn": "Scuba Diving",
    "descpFr":
        "Explorer les fonds marins et découvrir la vie aquatique en plongeant sous la surface de l'eau.",
    "descpEn":
        "Exploring underwater environments and discovering aquatic life by diving beneath the water's surface."
  },
  {
    "value": "29",
    "labelFr": "Jeu de rôle (RPG)",
    "labelEn": "Role-playing Games (RPG)",
    "descpFr":
        "Participer à des aventures imaginaires en incarnant des personnages dans des mondes fictifs.",
    "descpEn":
        "Engaging in imaginative adventures by portraying characters in fictional worlds."
  },
  {
    "value": "30",
    "labelFr": "Photographie urbaine",
    "labelEn": "Urban Photography",
    "descpFr":
        "Capturer la vie urbaine, l'architecture et l'atmosphère des villes à travers la photographie.",
    "descpEn":
        "Capturing urban life, architecture, and the atmosphere of cities through photography."
  },
  {
    "value": "31",
    "labelFr": "Escalade",
    "labelEn": "Rock Climbing",
    "descpFr":
        "Pratiquer l'escalade en salle ou en plein air pour tester sa force et sa concentration.",
    "descpEn":
        "Practicing climbing indoors or outdoors to test strength and concentration."
  },
  {
    "value": "32",
    "labelFr": "Couture",
    "labelEn": "Sewing",
    "descpFr":
        "Créer des vêtements, des accessoires ou des décorations en utilisant des techniques de couture.",
    "descpEn":
        "Creating clothing, accessories, or decorations using sewing techniques."
  },
  {
    "value": "33",
    "labelFr": "Course de drones",
    "labelEn": "Drone Racing",
    "descpFr":
        "Participer à des courses de drones télécommandés à grande vitesse.",
    "descpEn": "Participating in high-speed remote-controlled drone races."
  },
  {
    "value": "34",
    "labelFr": "Cuisine du monde",
    "labelEn": "World Cuisine",
    "descpFr":
        "Explorer et cuisiner des plats traditionnels de différentes cultures à travers le monde.",
    "descpEn":
        "Exploring and cooking traditional dishes from different cultures around the world."
  },
  {
    "value": "35",
    "labelFr": "Camping",
    "labelEn": "Camping",
    "descpFr":
        "S'installer en pleine nature pour camper, faire des feux de camp et explorer les environs.",
    "descpEn":
        "Setting up camp in nature to camp, make campfires, and explore the surroundings."
  },
  {
    "value": "36",
    "labelFr": "Astrophotographie",
    "labelEn": "Astrophotography",
    "descpFr":
        "Photographier les objets célestes tels que les étoiles, les planètes et les galaxies.",
    "descpEn":
        "Photographing celestial objects such as stars, planets, and galaxies."
  },
  {
    "value": "37",
    "labelFr": "Cueillette de champignons",
    "labelEn": "Mushroom Foraging",
    "descpFr":
        "Explorer la nature pour trouver et identifier des champignons comestibles.",
    "descpEn": "Exploring nature to find and identify edible mushrooms."
  },
  {
    "value": "38",
    "labelFr": "Yoga aérien",
    "labelEn": "Aerial Yoga",
    "descpFr":
        "Pratiquer le yoga en utilisant un hamac suspendu pour améliorer la flexibilité et la force.",
    "descpEn":
        "Practicing yoga using a suspended hammock to improve flexibility and strength."
  },
  {
    "value": "39",
    "labelFr": "Cuisine végétalienne",
    "labelEn": "Vegan Cooking",
    "descpFr":
        "Cuisiner des plats délicieux et sains sans aucun produit d'origine animale.",
    "descpEn":
        "Cooking delicious and healthy dishes without any animal products."
  },
  {
    "value": "40",
    "labelFr": "Astronomie amateur",
    "labelEn": "Amateur Astronomy",
    "descpFr":
        "Observer le ciel nocturne à l'aide d'un télescope pour découvrir les merveilles de l'univers.",
    "descpEn":
        "Observing the night sky using a telescope to discover the wonders of the universe."
  },
  {
    "value": "41",
    "labelFr": "Céramique",
    "labelEn": "Pottery",
    "descpFr":
        "Créer des objets en argile comme des pots, des vases ou des sculptures.",
    "descpEn": "Creating objects from clay such as pots, vases, or sculptures."
  },
  {
    "value": "42",
    "labelFr": "Jardinage aquatique",
    "labelEn": "Aquatic Gardening",
    "descpFr":
        "Aménager et entretenir un jardin aquatique avec des plantes aquatiques et des poissons.",
    "descpEn":
        "Designing and maintaining an aquatic garden with aquatic plants and fish."
  },
  {
    "value": "43",
    "labelFr": "Graffiti",
    "labelEn": "Graffiti Art",
    "descpFr":
        "Créer des œuvres d'art murales en utilisant des techniques de graffiti et de street art.",
    "descpEn":
        "Creating mural artworks using graffiti and street art techniques."
  },
  {
    "value": "44",
    "labelFr": "Escalade sur glace",
    "labelEn": "Ice Climbing",
    "descpFr":
        "Pratiquer l'escalade sur des formations de glace naturelles ou artificielles.",
    "descpEn": "Practicing climbing on natural or artificial ice formations."
  },
  {
    "value": "45",
    "labelFr": "Cueillette de fruits",
    "labelEn": "Fruit Picking",
    "descpFr":
        "Récolter des fruits frais directement des arbres dans les vergers.",
    "descpEn": "Harvesting fresh fruits directly from trees in orchards."
  },
  {
    "value": "46",
    "labelFr": "Tricot",
    "labelEn": "Knitting",
    "descpFr":
        "Créer des vêtements, des écharpes ou des couvertures en tricotant avec des aiguilles.",
    "descpEn":
        "Creating clothing, scarves, or blankets by knitting with needles."
  },
  {
    "value": "47",
    "labelFr": "Calligraphie",
    "labelEn": "Calligraphy",
    "descpFr":
        "Maîtriser l'art de l'écriture artistique en utilisant différentes techniques de calligraphie.",
    "descpEn":
        "Mastering the art of artistic writing using various calligraphy techniques."
  },
  {
    "value": "48",
    "labelFr": "Dessin animé",
    "labelEn": "Animation",
    "descpFr":
        "Créer des animations en dessinant des images qui sont ensuite assemblées pour créer des mouvements.",
    "descpEn":
        "Creating animations by drawing images that are then assembled to create motion."
  },
  {
    "value": "49",
    "labelFr": "Élevage d'animaux",
    "labelEn": "Animal Breeding",
    "descpFr":
        "Élever et prendre soin d'animaux domestiques ou d'élevage comme des chiens, des chats ou des poules.",
    "descpEn":
        "Raising and caring for domestic or farm animals such as dogs, cats, or chickens."
  },
  {
    "value": "50",
    "labelFr": "Géocaching",
    "labelEn": "Geocaching",
    "descpFr":
        "Participer à une chasse au trésor moderne en utilisant un GPS pour trouver des cachettes cachées dans la nature.",
    "descpEn":
        "Engaging in modern treasure hunting using GPS to find hidden caches in nature."
  },
  // { 'value': "21", 'labelFr': "aaa", 'labelEn': "aaa", 'descpFr': "aaa", 'descpEn': "aaa", },
];

List<Map<String, dynamic>> listeTypePromoAffaire = [
  {
    'value': 'produit_service',
    'label': 'Produits et Services',
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

Future<void> shareMessageWithImage(BuildContext context, String codeBonus,
    String commissionBonus, String langUserPhone) async {
  var messageShare = (langUserPhone == "fr")
      ? "Utilise Dressur, une application simple, sûr et fiable pour avoir de la visibilité sur tes différents réseaux sociaux et surtout sur tes statuts WhatsApp.\nGrâce à Dressur, fait la promotion de tes produits et services qui seront visibles par des milliers d'utilisateurs en seulement 24H.\nElle te permet d'avoir plus facilement des contacts WhatsApp selon les pays de ton choix. De plus, ses contacts sont automatiquement enregistrés dans ton téléphone et ton contact dans les leurs, etc.\n\nA téléchargé gratuitement sur Play Store : https://play.google.com/store/apps/details?id=com.dressur.ds\n\nOu la version web si tu n'as pas d'Android : https://dressur.site/inscription\n\nVoici mon code parrainage : $codeBonus\n\nIl te donnera $commissionBonus Points Bonus pour tester les services de l'application."
      : "Use Dressur, a simple, safe and reliable application to have visibility on your different social networks and especially on your WhatsApp statuses.\nThanks to Dressur, promote your products and services that will be visible to thousands of users in just 24 hours.\nIt allows you to more easily have WhatsApp contacts according to the countries of your choice. In addition, its contacts are automatically saved in your phone and your contact in theirs, etc.\n\nDownloaded for free on Play Store: https://play.google.com/store/apps/details?id=com.dressur.ds\n\nOr the web version if you don't have an Android: https://dressur.site/inscription\n\nHere is my referral code: $codeBonus\n\nIt will give you $commissionBonus Bonus Points to test the application's services.";

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
