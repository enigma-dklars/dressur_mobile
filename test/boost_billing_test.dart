import 'package:flutter_test/flutter_test.dart';
import 'package:dressur/2_promo/boost_billing.dart';

void main() {
  group('BoostBilling', () {
    final scenarios = <Map<String, dynamic>>[
      {
        'name': 'formula 100 only',
        'reward': false,
        'rewardBudget': 0,
        'facebook': false,
        'facebookAmount': 0,
        'expected': 100,
      },
      {
        'name': 'formula 100 + reward 500',
        'reward': true,
        'rewardBudget': 500,
        'facebook': false,
        'facebookAmount': 0,
        'expected': 600,
      },
      {
        'name': 'formula 100 + Facebook 700',
        'reward': false,
        'rewardBudget': 0,
        'facebook': true,
        'facebookAmount': 700,
        'expected': 800,
      },
      {
        'name': 'formula 100 + Facebook 700 + reward 500',
        'reward': true,
        'rewardBudget': 500,
        'facebook': true,
        'facebookAmount': 700,
        'expected': 1300,
      },
      {
        'name': 'formula 100 + reward 1000',
        'reward': true,
        'rewardBudget': 1000,
        'facebook': false,
        'facebookAmount': 0,
        'expected': 1100,
      },
      {
        'name': 'formula 100 + custom reward 5001',
        'reward': true,
        'rewardBudget': 5001,
        'facebook': false,
        'facebookAmount': 0,
        'expected': 5101,
      },
      {
        'name': 'disabled programme ignores reward budget',
        'reward': false,
        'rewardBudget': 500,
        'facebook': false,
        'facebookAmount': 0,
        'expected': 100,
      },
    ];

    for (final scenario in scenarios) {
      test(scenario['name'] as String, () {
        final amount = BoostBilling.calculateTotal(
          formulaAmount: 100,
          rewardEnabled: scenario['reward'] as bool,
          rewardBudget: scenario['rewardBudget'] as int,
          facebookEnabled: scenario['facebook'] as bool,
          facebookAmount: scenario['facebookAmount'] as int,
        );

        expect(amount, scenario['expected']);
      });
    }

    test('web and mobile reboost fields both produce 1300', () {
      for (final source in ['web', 'mobile']) {
        final fields = BoostBilling.buildOptionFields(
          formulaAmount: 100,
          rewardEnabled: true,
          rewardBudget: 500,
          customRewardBudget: false,
          publishOnDressurStatus: false,
          facebookEnabled: true,
          facebookAmount: '700',
          includeSource: true,
          source: source,
        );

        expect(fields['inProgrammeRecompense'], '1');
        expect(fields['rewardBudget'], '500');
        expect(fields['boostFacebook'], '1');
        expect(fields['montantBoostFacebook'], '700');
        expect(fields['totalAmount'], '1300');
        expect(fields['source'], source);
      }
    });

    test('falsified total amount does not alter displayed amount', () {
      final fields = BoostBilling.buildOptionFields(
        formulaAmount: 100,
        rewardEnabled: true,
        rewardBudget: 500,
        customRewardBudget: false,
        publishOnDressurStatus: false,
        facebookEnabled: true,
        facebookAmount: '700',
        includeSource: false,
      );

      expect(fields['totalAmount'], '1300');
      expect(fields['totalAmount'], isNot('99999'));
    });

    test('invalid reward budgets are rejected', () {
      expect(BoostBilling.validateRewardBudget('', custom: true), 'empty');
      expect(
        BoostBilling.validateRewardBudget('500.5', custom: true),
        'integer',
      );
      expect(
        BoostBilling.validateRewardBudget('-500', custom: true),
        'integer',
      );
      expect(
        BoostBilling.validateRewardBudget('text', custom: true),
        'integer',
      );
      expect(
        BoostBilling.validateRewardBudget('5000', custom: true),
        'minimum',
      );
    });
  });
}
