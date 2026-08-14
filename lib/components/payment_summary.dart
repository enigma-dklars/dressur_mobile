import 'package:flutter/material.dart';

/// A single detail line displayed in [PaymentSummary].
class PaymentSummaryLine {
  const PaymentSummaryLine({
    required this.labelFr,
    required this.labelEn,
    required this.amount,
  });

  final String labelFr;
  final String labelEn;
  final num amount;

  String labelFor(String languageCode) {
    return languageCode.toLowerCase().startsWith('fr') ? labelFr : labelEn;
  }
}

/// Displays payment details and a final total without performing any payment.
class PaymentSummary extends StatelessWidget {
  const PaymentSummary({
    super.key,
    required this.lines,
    required this.total,
    this.languageCode = 'fr',
    this.totalLabelFr = 'TOTAL',
    this.totalLabelEn = 'TOTAL',
    this.padding = const EdgeInsets.all(16),
  });

  final List<PaymentSummaryLine> lines;
  final num total;
  final String languageCode;
  final String totalLabelFr;
  final String totalLabelEn;
  final EdgeInsetsGeometry padding;

  bool get _isFrench => languageCode.toLowerCase().startsWith('fr');

  /// Formats a non-decimal FCFA amount consistently across the app.
  static String formatAmount(num amount) {
    return '${amount.round()} FCFA';
  }

  @override
  Widget build(BuildContext context) {
    final theme = Theme.of(context);
    final colors = theme.colorScheme;
    final textTheme = theme.textTheme;

    return Container(
      width: double.infinity,
      padding: padding,
      decoration: BoxDecoration(
        color: colors.surface,
        border: Border.all(color: colors.outlineVariant),
        borderRadius: BorderRadius.circular(12),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.stretch,
        children: [
          for (final line in lines) ...[
            _SummaryLine(
              label: line.labelFor(languageCode),
              amount: formatAmount(line.amount),
              textTheme: textTheme,
              colors: colors,
            ),
            const SizedBox(height: 8),
          ],
          if (lines.isNotEmpty) ...[
            const SizedBox(height: 4),
            Divider(height: 1, thickness: 1, color: colors.outlineVariant),
            const SizedBox(height: 12),
          ],
          Row(
            crossAxisAlignment: CrossAxisAlignment.center,
            children: [
              Expanded(
                child: Text(
                  _isFrench ? totalLabelFr : totalLabelEn,
                  style: textTheme.titleSmall?.copyWith(
                    fontWeight: FontWeight.bold,
                  ),
                ),
              ),
              const SizedBox(width: 12),
              Flexible(
                child: Text(
                  formatAmount(total),
                  textAlign: TextAlign.end,
                  maxLines: 1,
                  overflow: TextOverflow.ellipsis,
                  style: textTheme.titleMedium?.copyWith(
                    color: colors.primary,
                    fontWeight: FontWeight.bold,
                  ),
                ),
              ),
            ],
          ),
        ],
      ),
    );
  }
}

class _SummaryLine extends StatelessWidget {
  const _SummaryLine({
    required this.label,
    required this.amount,
    required this.textTheme,
    required this.colors,
  });

  final String label;
  final String amount;
  final TextTheme textTheme;
  final ColorScheme colors;

  @override
  Widget build(BuildContext context) {
    return Row(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Expanded(
          child: Text(label, softWrap: true, style: textTheme.bodyMedium),
        ),
        const SizedBox(width: 12),
        Flexible(
          child: Text(
            amount,
            textAlign: TextAlign.end,
            maxLines: 1,
            overflow: TextOverflow.ellipsis,
            style: textTheme.bodyMedium?.copyWith(
              color: colors.onSurfaceVariant,
            ),
          ),
        ),
      ],
    );
  }
}
