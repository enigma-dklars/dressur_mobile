import 'package:dressur/components/constant.dart';
import 'package:dressur/main.dart';
import 'package:flutter_local_notifications/flutter_local_notifications.dart';
import 'package:timezone/timezone.dart' as tz;

int id = 0;

// ── IDs réservés ──────────────────────────────────────────────────────────────
const int _boostReminderNotifId   = 99;
const int _boostReminder48hNotifId = 100;
const int _promoReminderNotifId   = 101;
const int _promoReminder48hNotifId = 102;

// ── Notifications immédiates ───────────────────────────────────────────────────

Future<void> showNotification(title, body) async {
  const AndroidNotificationDetails androidNotificationDetails =
      AndroidNotificationDetails('your channel id', 'your channel name',
          channelDescription: 'your channel description',
          importance: Importance.max,
          priority: Priority.high,
          ticker: 'ticker');
  const NotificationDetails notificationDetails =
      NotificationDetails(android: androidNotificationDetails);
  await flutterLocalNotificationsPlugin
      .show(id++, title, body, notificationDetails, payload: 'item x');
}

Future<void> showNotificationTimeOutAfter(
    String title, String body, int timeOut) async {
  AndroidNotificationDetails androidNotificationDetails =
      AndroidNotificationDetails(
    'your channel id',
    'your channel name',
    channelDescription: 'your channel description',
    importance: Importance.max,
    priority: Priority.high,
    ticker: 'ticker',
    timeoutAfter: timeOut,
  );
  NotificationDetails notificationDetails =
      NotificationDetails(android: androidNotificationDetails);
  await flutterLocalNotificationsPlugin.show(
    id++,
    title,
    body,
    notificationDetails,
    payload: 'item x',
  );
}

// ── Rappels Boost Contact ──────────────────────────────────────────────────────

/// Planifie deux notifications de rappel après l'inscription :
///   - 24h : rappel doux si pas de boost
///   - 48h : rappel urgent si toujours pas de boost
Future<void> scheduleBoostReminderNotification() async {
  await flutterLocalNotificationsPlugin.cancel(_boostReminderNotifId);
  await flutterLocalNotificationsPlugin.cancel(_boostReminder48hNotifId);

  final bool isFr = langUserPhone == 'fr';

  const AndroidNotificationDetails androidDetails = AndroidNotificationDetails(
    'boost_reminder_channel',
    'Rappel Boost Contact',
    channelDescription:
        'Rappels pour effectuer votre premier boost contact après inscription',
    importance: Importance.max,
    priority: Priority.high,
    ticker: 'Dressur',
  );
  const NotificationDetails notifDetails =
      NotificationDetails(android: androidDetails);

  // 24h
  await flutterLocalNotificationsPlugin.zonedSchedule(
    _boostReminderNotifId,
    isFr ? 'Rappel Dressur 🚀' : 'Dressur Reminder 🚀',
    isFr
        ? "Tu n'as pas encore boosté ton contact ! 10 personnes attendent de te voir."
        : "You haven't boosted your contact yet! 10 people are waiting to see you.",
    tz.TZDateTime.now(tz.local).add(const Duration(hours: 24)),
    notifDetails,
    androidScheduleMode: AndroidScheduleMode.exactAllowWhileIdle,
    uiLocalNotificationDateInterpretation:
        UILocalNotificationDateInterpretation.absoluteTime,
    payload: 'boost_reminder_24h',
  );

  // 48h
  await flutterLocalNotificationsPlugin.zonedSchedule(
    _boostReminder48hNotifId,
    isFr ? '⏰ Tu passes à côté !' : '⏰ You\'re missing out!',
    isFr
        ? "Ça fait 2 jours ! Des dizaines de personnes attendent de te découvrir. Lance ton premier boost maintenant 👇"
        : "It's been 2 days! Dozens of people are waiting to discover you. Start your first boost now 👇",
    tz.TZDateTime.now(tz.local).add(const Duration(hours: 48)),
    notifDetails,
    androidScheduleMode: AndroidScheduleMode.exactAllowWhileIdle,
    uiLocalNotificationDateInterpretation:
        UILocalNotificationDateInterpretation.absoluteTime,
    payload: 'boost_reminder_48h',
  );
}

/// Annule les rappels boost dès que l'utilisateur effectue son premier boost.
Future<void> cancelBoostReminderNotification() async {
  await flutterLocalNotificationsPlugin.cancel(_boostReminderNotifId);
  await flutterLocalNotificationsPlugin.cancel(_boostReminder48hNotifId);
}

// ── Rappels Promo Affaire ──────────────────────────────────────────────────────

/// Planifie deux notifications de rappel pour inciter à créer une première promo :
///   - 24h : rappel doux
///   - 48h : rappel plus incitatif
Future<void> schedulePromoReminderNotification() async {
  await flutterLocalNotificationsPlugin.cancel(_promoReminderNotifId);
  await flutterLocalNotificationsPlugin.cancel(_promoReminder48hNotifId);

  final bool isFr = langUserPhone == 'fr';

  const AndroidNotificationDetails androidDetails = AndroidNotificationDetails(
    'promo_reminder_channel',
    'Rappel Promotion',
    channelDescription:
        'Rappels pour créer votre première promotion après inscription',
    importance: Importance.max,
    priority: Priority.high,
    ticker: 'Dressur',
  );
  const NotificationDetails notifDetails =
      NotificationDetails(android: androidDetails);

  // 24h
  await flutterLocalNotificationsPlugin.zonedSchedule(
    _promoReminderNotifId,
    isFr ? '📣 Ta business n\'est pas encore visible !' : '📣 Your business isn\'t visible yet!',
    isFr
        ? "Tu n'as pas encore créé de promotion ! Des milliers d'utilisateurs pourraient découvrir ta business dès aujourd'hui."
        : "You haven't created a promotion yet! Thousands of users could discover your business today.",
    tz.TZDateTime.now(tz.local).add(const Duration(hours: 24)),
    notifDetails,
    androidScheduleMode: AndroidScheduleMode.exactAllowWhileIdle,
    uiLocalNotificationDateInterpretation:
        UILocalNotificationDateInterpretation.absoluteTime,
    payload: 'promo_reminder_24h',
  );

  // 48h
  await flutterLocalNotificationsPlugin.zonedSchedule(
    _promoReminder48hNotifId,
    isFr ? '🔥 2 jours sans promo, c\'est trop long !' : '🔥 2 days without a promo is too long!',
    isFr
        ? "Des milliers d'utilisateurs ne te voient pas encore. Crée ta première promotion maintenant et booste ta visibilité 👇"
        : "Thousands of users still can't see you. Create your first promotion now and boost your visibility 👇",
    tz.TZDateTime.now(tz.local).add(const Duration(hours: 48)),
    notifDetails,
    androidScheduleMode: AndroidScheduleMode.exactAllowWhileIdle,
    uiLocalNotificationDateInterpretation:
        UILocalNotificationDateInterpretation.absoluteTime,
    payload: 'promo_reminder_48h',
  );
}

/// Annule les rappels promo dès que l'utilisateur crée sa première promotion.
Future<void> cancelPromoReminderNotification() async {
  await flutterLocalNotificationsPlugin.cancel(_promoReminderNotifId);
  await flutterLocalNotificationsPlugin.cancel(_promoReminder48hNotifId);
}
