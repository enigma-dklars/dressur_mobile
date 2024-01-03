import 'dart:async';
import 'dart:io';
import 'package:flutter/material.dart';
import 'package:flutter_contacts/flutter_contacts.dart';
import 'package:dressur/components/sql_helper.dart';

const versionApp = '1.0.0';
const oldDatabaseName = 'un_dressur.db';
const nowDataBaseName = 'deux_dressur.db';
// const generalApiDomaine = 'http://dressur.rf.gd/public';
// const generalApiDomaine = 'http://192.168.100.14:8000';
const generalApiDomaine = 'http://192.168.100.14:8000';
const generalRouteForApi = '$generalApiDomaine/api';
const generalRouteForPromotionImage = '$generalApiDomaine/promotion/';

const facebookDS = "https://www.facebook.com/dressurDS";
const facebookBLT = "https://www.facebook.com/bluelife.tech";
const tiktokBLT = "https://www.tiktok.com/@bluelife.tech";
const instagramBLT = "https://www.instagram.com/bluelife.tech";
const youtubeBLT = "https://www.youtube.com/@bluelife-tech";
const whatsappDSURL = "https://wa.me/22960330478";
const dressurConditionUtilisation = "https://dressur.online/condition.html";
const dressurPolitiqueConfidentialite = "https://dressur.online/politique.html";
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
  affUserName = userInfos["affUserName"];
  permissionAdd = userInfos["permissionAdd"];
  messageErreurPermissionAdd = userInfos["messageErreurPermissionAdd"];
  preferencePaysText = userInfos["preferencePaysText"];
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

void insertDressurContact() async {
  if ((await SQLHelper.getOneNumsTelUser("+22960330478")).isEmpty) {
    final newContact = Contact()
      ..isStarred = true
      ..name.first = "Dressur Assistance ✅"
      ..phones = [Phone("+22960330478")]
      ..emails = [Email("dressur@gmail.com")]
      ..websites = [
        Website(facebookDS),
        Website(facebookBLT),
        Website(tiktokBLT),
        Website(instagramBLT),
        Website(youtubeBLT),
      ];
    await newContact.insert();
    await insertNumTelUserIntoDataBase("+22960330478");
  }
}

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

String getCurrentYear() {
  // Obtenez la date actuelle
  DateTime now = DateTime.now();

  // Obtenez l'année à partir de la date actuelle
  String currentYear = now.year.toString();

  return currentYear;
}