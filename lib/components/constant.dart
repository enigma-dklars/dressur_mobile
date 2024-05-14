import 'dart:async';
import 'package:dressur/components/111_generalApiDomaine.dart';
import 'package:flutter/material.dart';
import 'package:flutter_contacts/flutter_contacts.dart';
import 'package:dressur/components/sql_helper.dart';

const versionApp = '1.0.0';
const oldDatabaseName = 'un_dressur.db';
const nowDataBaseName = 'deux_dressur.db';
bool modeReconnaissanceContactArrierePlan = false;
// const generalApiDomaine = 'http://dressur.rf.gd/public';
const generalRouteForApi = '$generalApiDomaine/api';
const generalRouteForPromotionImage = '$generalApiDomaine/promotion/';

const facebookDS = "https://www.facebook.com/dressurds";
const facebookBLT = "https://www.facebook.com/bluelife.tech";
const facebookELTCS = "https://www.facebook.com/eliticscore";
const tiktokBLT = "https://www.tiktok.com/@bluelife.tech";
const tiktokELTCS = "https://www.tiktok.com/@eliticscore1";
const instagramBLT = "https://www.instagram.com/bluelife.tech";
const instagramELTCS = "https://www.instagram.com/eliticscore";
const youtubeBLT = "https://www.youtube.com/@bluelife-tech";
const whatsappDSURL = "https://wa.me/22964044294";
const dressurConditionUtilisation =
    "https://www.bluelife.tech/realisations/dressur/condition";
const dressurPolitiqueConfidentialite =
    "https://www.bluelife.tech/realisations/dressur/politique";
const dressurUrlPlaystore =
    "https://play.google.com/store/apps/details?id=com.ds.dressur";

const primaryColor = Color(0xFF2a4b9a);
const secondaryColor = Colors.indigoAccent;
const databaseSqlCode = """
  CREATE TABLE userInfos(
    idDS INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    tableName TEXT,
    id INTEGER,
    uid TEXT,
    contactTel TEXT,
    titreBonus TEXT,
    value TEXT,
    label TEXT,
    prix TEXT,
    jours TEXT,
    youHaveConnexion TEXT
  )
""";

List<dynamic> contactsUserBeforeDS = [];
List<dynamic> contactsEnregistrer = [];
String? langUserPhone = "en";
String preferencePaysText = "";
String preferenceCentreInteretLoisirText = "";
int commissionBonus = 200;
int nombreContacts = 0;
int nombreContactDispo = 0;
bool siParrain = false;
bool affUserName = false;
bool telIsVerified = false;
bool mailIsVerified = false;
bool ihaveConnexion = false;
bool admin = false;
bool permissionAdd = false;
bool havePublicites = false;
var modeMotDePasseOublier = false;
var mailConnexion = "";
var textChargementEvolution = "Chargement ...";
var addUserOnAutreProfilPage = "oui";
var uidAutreUser;
var uidUser;
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
// ignore: prefer_typing_uninitialized_variables
var lesPublicites;

void youHaveConnexion() async {
  SQLHelper.delete('youHaveConnexion');
  SQLHelper.insert({
    'tableName': "youHaveConnexion",
    'youHaveConnexion': "oui",
  });
  // try {
  //   final result = await InternetAddress.lookup("google.com");
  //   if (result.isNotEmpty && result[0].rawAddress.isNotEmpty) {
  //     // oui
  //     SQLHelper.delete('youHaveConnexion');
  //     SQLHelper.insert({
  //       'tableName': "youHaveConnexion",
  //       'youHaveConnexion': "oui",
  //     });
  //   } else {
  //     // non
  //     SQLHelper.delete('youHaveConnexion');
  //     SQLHelper.insert({
  //       'tableName': "youHaveConnexion",
  //       'youHaveConnexion': "non",
  //     });
  //   }
  // } on SocketException catch (_) {
  //   // non
  //   SQLHelper.delete('youHaveConnexion');
  //   SQLHelper.insert({
  //     'tableName': "youHaveConnexion",
  //     'youHaveConnexion': "non",
  //   });
  // }
}

Future<void> insertNumTelUserIntoDataBase(numberTel) async {
  SQLHelper.insert({
    'tableName': "numsTelUser",
    'contactTel': numberTel,
  });
}

Future<void> initUserInformations(userInfos) async {
  uidUser = userInfos["uid"];
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
  preferencePaysText = preferencePaysToText(userInfos["preferencePays"]);
  preferenceCentreInteretLoisirText = preferenceCentreInteretLoisirToText(
      userInfos["preferenceCentreInteretLoisir"]);
  nombreContactDispo = userInfos["nombreContactDispo"];
  lesPublicites = userInfos["lesPublicites"];
  havePublicites = userInfos["havePublicites"];

  SQLHelper.viderLaBaseDeDonneeLocal();

  SQLHelper.insert({
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

List<Map<String, dynamic>> listeMethodePaiement = [
  {
    'value': 'airtel_ne',
    'label': 'Airtel Niger',
  },
  {
    'value': 'sbin',
    'label': 'Celtis Cash',
  },
  {
    'value': 'free_sn',
    'label': 'Free Sénégal',
  },
  {
    'value': 'moov',
    'label': 'MOOV Flooz Bénin',
  },
  {
    'value': 'moov_bf',
    'label': 'MOOV Burkina Faso',
  },
  {
    'value': 'moov_ci',
    'label': "MOOV Côte d'Ivoire",
  },
  {
    'value': 'moov_tg',
    'label': 'MOOV Flooz Togo',
  },
  {
    'value': 'mtn',
    'label': 'MTN Mobile Money Bénin',
  },
  {
    'value': 'mtn_ci',
    'label': "MTN Mobile Money Côte d'Ivoire",
  },
  {
    'value': 'mtn_open_gn',
    'label': 'MTN Mobile Money Guinée',
  },
  {
    'value': 'orange_bf',
    'label': 'Orange Burkina Faso',
  },
  {
    'value': 'orange_ci',
    'label': "Orange Côte d'Ivoire",
  },
  {
    'value': 'orange_ml',
    'label': 'Orange Mali',
  },
  {
    'value': 'orange_sn',
    'label': 'Orange Sénégal',
  },
  {
    'value': 'togocel',
    'label': 'TOGOCEL T-Money',
  },
];

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
  // { 'value': "21", 'labelFr': "aaa", 'labelEn': "aaa", 'descpFr': "aaa", 'descpEn': "aaa", },
];

String getCurrentYear() {
  // Obtenez la date actuelle
  DateTime now = DateTime.now();

  // Obtenez l'année à partir de la date actuelle
  String currentYear = now.year.toString();

  return currentYear;
}
