import 'package:dressur/components/constant.dart';
import 'package:dressur/main.dart';
import 'package:flutter_local_notifications/flutter_local_notifications.dart';
import 'package:timezone/timezone.dart' as tz;

int id = 0;

const int _boostReminderNotifId = 99;
const int _boostReminder48hNotifId = 100;

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

/// Planifie deux notifications de rappel après l'inscription :
///   - 24h : rappel doux
///   - 48h : rappel urgent si toujours pas de boost
/// Annule tout rappel existant avant de planifier les nouveaux.
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

  // ── Rappel 24h ────────────────────────────────────────────────────────────
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

  // ── Rappel 48h (message plus incitatif) ───────────────────────────────────
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

/// Annule les deux rappels boost dès que l'utilisateur effectue son premier boost.
Future<void> cancelBoostReminderNotification() async {
  await flutterLocalNotificationsPlugin.cancel(_boostReminderNotifId);
  await flutterLocalNotificationsPlugin.cancel(_boostReminder48hNotifId);
}
