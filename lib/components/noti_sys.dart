import 'package:dressur/main.dart';
import 'package:flutter_local_notifications/flutter_local_notifications.dart';

int id = 0;

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
    'your channel id', // Remplacez par votre ID de canal
    'your channel name', // Remplacez par le nom de votre canal
    channelDescription: 'your channel description', // Description du canal
    importance: Importance.max,
    priority: Priority.high,
    ticker: 'ticker',
    timeoutAfter:
        timeOut, // Temps après lequel la notification disparaît (en millisecondes)
  );

  NotificationDetails notificationDetails =
      NotificationDetails(android: androidNotificationDetails);

  await flutterLocalNotificationsPlugin.show(
    id++, // Incrémente l'ID pour chaque notification
    title,
    body,
    notificationDetails,
    payload: 'item x',
  );
}
