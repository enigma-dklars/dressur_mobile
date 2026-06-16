import 'package:dressur/components/constant.dart';
import 'package:dressur/main.dart';
import 'package:flutter_local_notifications/flutter_local_notifications.dart';
import 'package:timezone/timezone.dart' as tz;

int id = 0;

const int _boostReminderNotifId = 99;

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

/// Planifie une notification de rappel 24h après l'inscription,
/// si l'utilisateur n'a pas encore effectué son premier boost contact.
/// Annule tout rappel existant avant de planifier le nouveau.
Future<void> scheduleBoostReminderNotification() async {
  await flutterLocalNotificationsPlugin.cancel(_boostReminderNotifId);

  final bool isFr = langUserPhone == 'fr';
  final String title = isFr ? 'Rappel Dressur 🚀' : 'Dressur Reminder 🚀';
  final String body = isFr
      ? "Tu n'as pas encore boosté ton contact ! 10 personnes attendent de te voir."
      : "You haven't boosted your contact yet! 10 people are waiting to see you.";

  const AndroidNotificationDetails androidDetails = AndroidNotificationDetails(
    'boost_reminder_channel',
    'Rappel Boost Contact',
    channelDescription:
        'Rappel pour effectuer votre premier boost contact 24h après inscription',
    importance: Importance.max,
    priority: Priority.high,
    ticker: 'Dressur',
  );
  const NotificationDetails notifDetails =
      NotificationDetails(android: androidDetails);

  await flutterLocalNotificationsPlugin.zonedSchedule(
    _boostReminderNotifId,
    title,
    body,
    tz.TZDateTime.now(tz.local).add(const Duration(hours: 24)),
    notifDetails,
    androidScheduleMode: AndroidScheduleMode.exactAllowWhileIdle,
    payload: 'boost_reminder',
  );
}

/// Annule le rappel boost si l'utilisateur vient de faire son premier boost.
Future<void> cancelBoostReminderNotification() async {
  await flutterLocalNotificationsPlugin.cancel(_boostReminderNotifId);
}
