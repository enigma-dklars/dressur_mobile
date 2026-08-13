import 'dart:async';

import 'package:dressur/components/app_message_bottom_sheet.dart';

void voirPlusAdd(titre, text, context) {
  unawaited(
    showAppMessageBottomSheet(
      context,
      type: AppMessageType.info,
      title: titre,
      message: text,
    ),
  );
}

void dangerNoti(titre, text, context) {
  unawaited(
    showAppMessageBottomSheet(
      context,
      type: AppMessageType.danger,
      title: titre,
      message: text,
    ),
  );
}

void infoNoti(titre, text, context) {
  unawaited(
    showAppMessageBottomSheet(
      context,
      type: AppMessageType.info,
      title: titre,
      message: text,
    ),
  );
}

void questionNoti(titre, text, context) {
  unawaited(
    showAppMessageBottomSheet(
      context,
      type: AppMessageType.question,
      title: titre,
      message: text,
    ),
  );
}

void successNoti(titre, text, context) {
  unawaited(
    showAppMessageBottomSheet(
      context,
      type: AppMessageType.success,
      title: titre,
      message: text,
    ),
  );
}

void warningNoti(titre, text, context) {
  unawaited(
    showAppMessageBottomSheet(
      context,
      type: AppMessageType.warning,
      title: titre,
      message: text,
    ),
  );
}