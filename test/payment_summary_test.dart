import 'package:dressur/components/payment_summary.dart';
import 'package:flutter_test/flutter_test.dart';

void main() {
  test('formats a total as a rounded FCFA amount', () {
    expect(PaymentSummary.formatAmount(1250.4), '1250 FCFA');
  });
}
