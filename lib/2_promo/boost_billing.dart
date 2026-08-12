class BoostBilling {
  const BoostBilling._();

  static const List<int> predefinedRewardBudgets = [500, 1000, 2000, 5000];

  static double calculateTotal({
    required int formulaAmount,
    required bool rewardEnabled,
    required int rewardBudget,
    required bool facebookEnabled,
    required int facebookAmount,
    bool publishOnDressurStatus = false,
    int formulaDays = 0,
  }) {
    var total = formulaAmount.toDouble();

    if (rewardEnabled) {
      total += rewardBudget;
    }
    if (publishOnDressurStatus) {
      total += (formulaDays * 5000) / 7;
    }
    if (facebookEnabled) {
      total += facebookAmount;
    }

    return total;
  }

  static String formatTotal({
    required int formulaAmount,
    required bool rewardEnabled,
    required int rewardBudget,
    required bool facebookEnabled,
    required int facebookAmount,
    bool publishOnDressurStatus = false,
    int formulaDays = 0,
  }) {
    return calculateTotal(
      formulaAmount: formulaAmount,
      rewardEnabled: rewardEnabled,
      rewardBudget: rewardBudget,
      facebookEnabled: facebookEnabled,
      facebookAmount: facebookAmount,
      publishOnDressurStatus: publishOnDressurStatus,
      formulaDays: formulaDays,
    ).toStringAsFixed(0);
  }

  static String? validateRewardBudget(
    String rawBudget, {
    required bool custom,
  }) {
    final value = rawBudget.trim();
    if (value.isEmpty) {
      return 'empty';
    }
    if (!RegExp(r'^\d+$').hasMatch(value)) {
      return 'integer';
    }

    final amount = int.tryParse(value);
    if (amount == null || amount <= 0) {
      return 'integer';
    }
    if (custom && amount <= 5000) {
      return 'minimum';
    }
    if (!custom &&
        amount <= 5000 &&
        !predefinedRewardBudgets.contains(amount)) {
      return 'selection';
    }

    return null;
  }

  static Map<String, String> buildOptionFields({
    required int formulaAmount,
    required bool rewardEnabled,
    required int rewardBudget,
    required bool customRewardBudget,
    required bool publishOnDressurStatus,
    required bool facebookEnabled,
    required String facebookAmount,
    required bool includeSource,
    String source = 'mobile',
    int formulaDays = 0,
  }) {
    final parsedFacebookAmount = int.tryParse(facebookAmount) ?? 0;
    return {
      'inProgrammeRecompense': rewardEnabled ? '1' : '0',
      'rewardBudget': rewardEnabled ? rewardBudget.toString() : '0',
      'rewardBudgetType': customRewardBudget ? 'custom' : 'predefined',
      'publishOnDressurStatus': publishOnDressurStatus ? '1' : '0',
      'boostFacebook': facebookEnabled ? '1' : '0',
      'montantBoostFacebook': facebookEnabled ? facebookAmount : '0',
      'totalAmount': formatTotal(
        formulaAmount: formulaAmount,
        rewardEnabled: rewardEnabled,
        rewardBudget: rewardBudget,
        facebookEnabled: facebookEnabled,
        facebookAmount: parsedFacebookAmount,
        publishOnDressurStatus: publishOnDressurStatus,
        formulaDays: formulaDays,
      ),
      if (includeSource) 'source': source,
    };
  }
}
