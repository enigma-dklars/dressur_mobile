import 'dart:convert';

import 'package:dressur/components/constant.dart';
import 'package:dressur/components/noti.dart';
import 'package:dressur/components/app_message_bottom_sheet.dart';
import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:http/http.dart' as http;
import 'package:url_launcher/url_launcher.dart';

class EspaceDeveloppeurPage extends StatefulWidget {
  const EspaceDeveloppeurPage({super.key});

  @override
  State<EspaceDeveloppeurPage> createState() => _EspaceDeveloppeurPageState();
}

class _EspaceDeveloppeurPageState extends State<EspaceDeveloppeurPage> {
  Map<String, dynamic>? _conditions;
  List<dynamic> _methods = [];
  List<dynamic> _keys = [];
  List<dynamic> _orders = [];
  bool _loading = true;
  bool _busy = false;
  dynamic _selectedMethod;
  final _amountController = TextEditingController();
  late final _telController = TextEditingController(text: '$tel');
  final _keyLabelController = TextEditingController();

  bool get _isFr => langUserPhone == 'fr';
  bool get _active => (_conditions?['active'] == true) || developpeur;

  @override
  void initState() {
    super.initState();
    _loadPage();
  }

  @override
  void dispose() {
    _amountController.dispose();
    _telController.dispose();
    _keyLabelController.dispose();
    super.dispose();
  }

  Future<Map<String, dynamic>> _jsonRequest(String method, String path,
      {Map<String, String>? fields}) async {
    final uri = Uri.parse('$generalRouteForApi$path');
    if (method == 'GET') {
      final response = await http.get(uri.replace(queryParameters: {'uid': '$uidUser'})).timeout(const Duration(seconds: 20));
      return (jsonDecode(response.body) as Map).cast<String, dynamic>();
    }
    final request = http.MultipartRequest(method, uri);
    request.fields['uid'] = '$uidUser';
    if (fields != null) request.fields.addAll(fields);
    final response = await request.send().timeout(const Duration(seconds: 25));
    final body = await response.stream.bytesToString();
    return (jsonDecode(body) as Map).cast<String, dynamic>();
  }

  Future<void> _loadPage() async {
    try {
      final results = await Future.wait([
        _jsonRequest('GET', '/developpeur/conditions'),
        _jsonRequest('POST', '/listeFormuleBoost', fields: {'typeBoost': 'date'}),
      ]);
      if (!mounted) return;
      final conditions = results[0];
      final methods = results[1];
      setState(() {
        _conditions = conditions;
        _methods = (methods['listeMethodePaiements'] as List?) ?? [];
        if (_methods.isNotEmpty) _selectedMethod = _methods.first['value'];
        _amountController.text = '${conditions['minimumRecharge'] ?? montantRechargeInitialeDeveloppeur}';
        _loading = false;
      });
      if (_active) await _loadActiveData();
    } catch (_) {
      if (!mounted) return;
      setState(() => _loading = false);
      dangerNoti(_isFr ? 'Erreur' : 'Error', _isFr ? 'Impossible de charger l’espace développeur.' : 'Developer space could not be loaded.', context);
    }
  }

  Future<void> _loadActiveData() async {
    try {
      final results = await Future.wait([
        _jsonRequest('GET', '/developpeur/cles'),
        _jsonRequest('GET', '/developpeur/historique'),
      ]);
      if (!mounted) return;
      setState(() {
        _keys = (results[0]['keys'] as List?) ?? [];
        _orders = (results[1]['orders'] as List?) ?? [];
      });
    } catch (_) {
      if (mounted) dangerNoti(_isFr ? 'Information' : 'Notice', _isFr ? 'Les données de vos commandes ne sont pas disponibles.' : 'Your order data is unavailable.', context);
    }
  }

  Future<void> _activate() async {
    final amount = int.tryParse(_amountController.text.trim()) ?? 0;
    final minimum = (_conditions?['minimumRecharge'] as num?)?.toInt() ?? montantRechargeInitialeDeveloppeur;
    if (amount < minimum) {
      dangerNoti(_isFr ? 'Montant insuffisant' : 'Insufficient amount', _isFr ? 'Le minimum est de $minimum FCFA.' : 'The minimum is $minimum FCFA.', context);
      return;
    }
    if (_selectedMethod == null || _telController.text.trim().isEmpty) {
      dangerNoti(_isFr ? 'Informations requises' : 'Information required', _isFr ? 'Choisissez un moyen de paiement et renseignez votre numéro.' : 'Choose a payment method and enter your phone number.', context);
      return;
    }
    setState(() => _busy = true);
    try {
      final data = await _jsonRequest('POST', '/developpeur/activation', fields: {
        'montantRecharge': '$amount',
        'methodePaiementId': '$_selectedMethod',
        'tel': _telController.text.trim(),
        'conditionsAccepted': '1',
      });
      if (!mounted) return;
      if (data['error'] == true) {
        dangerNoti(data['titre'] ?? (_isFr ? 'Activation impossible' : 'Activation failed'), data['message'] ?? '', context);
      } else {
        successNoti(_isFr ? 'Paiement démarré' : 'Payment started', data['message'] ?? (_isFr ? 'Suivez les instructions de paiement.' : 'Follow the payment instructions.'), context);
        final redirect = data['url'] ?? data['redirect'];
        if (redirect is String && redirect.isNotEmpty && redirect != 'none') {
          await launchUrl(Uri.parse(redirect), mode: LaunchMode.externalApplication);
        }
      }
    } catch (_) {
      if (mounted) dangerNoti(_isFr ? 'Erreur' : 'Error', _isFr ? 'Une erreur réseau est survenue.' : 'A network error occurred.', context);
    } finally {
      if (mounted) setState(() => _busy = false);
    }
  }

  Future<void> _createKey() async {
    final label = _keyLabelController.text.trim();
    if (label.isEmpty) {
      dangerNoti(_isFr ? 'Libellé requis' : 'Label required', _isFr ? 'Donnez un nom à cette clé.' : 'Give this key a name.', context);
      return;
    }
    setState(() => _busy = true);
    try {
      final data = await _jsonRequest('POST', '/developpeur/cles', fields: {'label': label});
      if (!mounted) return;
      if (data['error'] == true) {
        dangerNoti(_isFr ? 'Création impossible' : 'Creation failed', data['message'] ?? '', context);
      } else {
        final token = data['token'] ?? '';
        await showAppMessageBottomSheet(context, type: AppMessageType.success, title: _isFr ? 'Clé créée' : 'Key created', message: '${_isFr ? 'Copiez maintenant ce token. Il ne sera plus affiché.' : 'Copy this token now. It will not be shown again.'}\n\n$token', closeLabel: _isFr ? 'Fermer' : 'Close');
        _keyLabelController.clear();
        await _loadActiveData();
      }
    } catch (_) {
      if (mounted) dangerNoti(_isFr ? 'Erreur' : 'Error', _isFr ? 'Impossible de créer la clé.' : 'Could not create the key.', context);
    } finally {
      if (mounted) setState(() => _busy = false);
    }
  }

  Future<void> _revokeKey(String keyId) async {
    final confirmed = await showAppMessageConfirmationBottomSheet(context, type: AppMessageType.question, title: _isFr ? 'Révoquer la clé ?' : 'Revoke key?', message: _isFr ? 'Cette action est définitive pour cette clé.' : 'This action is final for this key.', confirmLabel: _isFr ? 'Révoquer' : 'Revoke', cancelLabel: _isFr ? 'Annuler' : 'Cancel');
    if (confirmed != true) return;
    try {
      final data = await _jsonRequest('POST', '/developpeur/cles/${Uri.encodeComponent(keyId)}/revoquer');
      if (!mounted) return;
      if (data['error'] == true) {
        dangerNoti(_isFr ? 'Erreur' : 'Error', data['message'] ?? '', context);
      } else {
        successNoti(_isFr ? 'Clé révoquée' : 'Key revoked', data['message'] ?? '', context);
        await _loadActiveData();
      }
    } catch (_) {
      if (mounted) dangerNoti(_isFr ? 'Erreur' : 'Error', _isFr ? 'Impossible de révoquer la clé.' : 'Could not revoke the key.', context);
    }
  }

  Future<void> _openDocumentation() async {
    final uri = Uri.parse('https://dressur.site/documentation-api');
    if (!await launchUrl(uri, mode: LaunchMode.externalApplication) && mounted) {
      dangerNoti(_isFr ? 'Erreur' : 'Error', _isFr ? 'Impossible d’ouvrir la documentation.' : 'Could not open documentation.', context);
    }
  }

  @override
  Widget build(BuildContext context) {
    final isDark = Theme.of(context).brightness == Brightness.dark;
    return Scaffold(
      backgroundColor: isDark ? const Color(0xFF121212) : const Color(0xFFF8F9FA),
      appBar: AppBar(
        backgroundColor: primaryColor,
        elevation: 0,
        title: Text(_isFr ? 'Espace développeur' : 'Developer space', style: GoogleFonts.poppins(color: Colors.white, fontSize: 18)),
        leading: IconButton(onPressed: () => Navigator.pop(context), icon: const FaIcon(FontAwesomeIcons.chevronLeft, color: Colors.white)),
      ),
      body: _loading ? const Center(child: CircularProgressIndicator()) : RefreshIndicator(onRefresh: _loadPage, child: ListView(padding: const EdgeInsets.all(14), children: [
        _hero(isDark),
        const SizedBox(height: 12),
        _balanceCard(isDark),
        const SizedBox(height: 12),
        _documentationCard(isDark),
        const SizedBox(height: 12),
        if (!_active) ...[_eligibilityCard(isDark), const SizedBox(height: 12), _activationCard(isDark)] else ...[_keysCard(isDark), const SizedBox(height: 12), _ordersCard(isDark)],
      ])),
    );
  }

  Widget _hero(bool isDark) => Container(padding: const EdgeInsets.all(20), decoration: BoxDecoration(color: isDark ? const Color(0xFF20242A) : Colors.white, borderRadius: BorderRadius.circular(20)), child: Column(children: [const FaIcon(FontAwesomeIcons.code, size: 34, color: primaryColor), const SizedBox(height: 10), Text(_active ? (_isFr ? 'Votre accès API est actif' : 'Your API access is active') : (_isFr ? 'Connectez vos outils à Dressur' : 'Connect your tools to Dressur'), textAlign: TextAlign.center, style: GoogleFonts.poppins(fontSize: 20, fontWeight: FontWeight.w700, color: isDark ? Colors.white : Colors.black87)), const SizedBox(height: 6), Text(_isFr ? 'Promotions Réseaux Sociaux · HTTP/JSON' : 'Social Network Promotions · HTTP/JSON', style: GoogleFonts.poppins(color: isDark ? Colors.grey[300] : Colors.grey[700]))]));

  Widget _balanceCard(bool isDark) => _card(isDark, Column(crossAxisAlignment: CrossAxisAlignment.start, children: [Text(_isFr ? 'Solde Dressur' : 'Dressur balance', style: GoogleFonts.poppins(color: isDark ? Colors.grey[300] : Colors.grey[700])), const SizedBox(height: 4), Text('${soldeDressur ?? 0} FCFA', style: GoogleFonts.poppins(fontSize: 28, fontWeight: FontWeight.w700, color: isDark ? Colors.white : Colors.black87)), if (_active) _tag(_isFr ? 'Développeur actif' : 'Active developer', Colors.green)]));

  Widget _documentationCard(bool isDark) => _card(isDark, Row(children: [const FaIcon(FontAwesomeIcons.bookOpen, color: primaryColor), const SizedBox(width: 12), Expanded(child: Text(_isFr ? 'Consultez la documentation universelle HTTP/JSON.' : 'Read the universal HTTP/JSON documentation.', style: GoogleFonts.poppins(color: isDark ? Colors.white : Colors.black87))), IconButton(onPressed: _openDocumentation, icon: const Icon(Icons.open_in_new, color: primaryColor))]));

  Widget _eligibilityCard(bool isDark) {
    final eligibility = (_conditions?['eligibility'] as Map?)?.cast<String, dynamic>() ?? {};
    final labels = {'accountActive': _isFr ? 'Compte actif' : 'Active account', 'emailVerified': _isFr ? 'Adresse e-mail confirmée' : 'Verified email', 'phoneVerified': _isFr ? 'Numéro confirmé' : 'Verified phone', 'profileComplete': _isFr ? 'Profil complet' : 'Complete profile', 'conditionsAccepted': _isFr ? 'Conditions API acceptées' : 'API terms accepted'};
    return _card(isDark, Column(crossAxisAlignment: CrossAxisAlignment.start, children: [Text(_isFr ? 'Conditions d’accès' : 'Access conditions', style: GoogleFonts.poppins(fontSize: 17, fontWeight: FontWeight.w700, color: isDark ? Colors.white : Colors.black87)), const SizedBox(height: 8), ...labels.entries.map((entry) => Padding(padding: const EdgeInsets.symmetric(vertical: 3), child: Row(children: [Icon(eligibility[entry.key] == true ? Icons.check_circle : Icons.radio_button_unchecked, size: 18, color: eligibility[entry.key] == true ? Colors.green : Colors.orange), const SizedBox(width: 8), Expanded(child: Text(entry.value, style: GoogleFonts.poppins(color: isDark ? Colors.grey[200] : Colors.grey[800])))])))]));
  }

  Widget _activationCard(bool isDark) => _card(isDark, Column(crossAxisAlignment: CrossAxisAlignment.start, children: [Text(_conditions?['activationConfigured'] == true ? (_isFr ? 'Activer l’accès développeur' : 'Activate developer access') : (_isFr ? 'Activation indisponible' : 'Activation unavailable'), style: GoogleFonts.poppins(fontSize: 17, fontWeight: FontWeight.w700, color: isDark ? Colors.white : Colors.black87)), const SizedBox(height: 8), if (_conditions?['activationConfigured'] != true) Text(_isFr ? 'Le service est temporairement indisponible. Contactez l’assistance par WhatsApp.' : 'The service is temporarily unavailable. Contact WhatsApp support.', style: GoogleFonts.poppins(color: isDark ? Colors.grey[300] : Colors.grey[700])) else ...[_field(_isFr ? 'Montant minimum (FCFA)' : 'Minimum amount (FCFA)', _amountController, TextInputType.number, isDark), _field(_isFr ? 'Numéro de téléphone' : 'Phone number', _telController, TextInputType.phone, isDark), DropdownButtonFormField<dynamic>(value: _selectedMethod, decoration: _inputDecoration(_isFr ? 'Moyen de paiement' : 'Payment method', isDark), dropdownColor: isDark ? const Color(0xFF2A2A2A) : Colors.white, items: _methods.map((method) => DropdownMenuItem(value: method['value'], child: Text('${method['label'] ?? method['titre'] ?? method['value']}', style: TextStyle(color: isDark ? Colors.white : Colors.black87)))).toList(), onChanged: (value) => setState(() => _selectedMethod = value)), const SizedBox(height: 12), SizedBox(width: double.infinity, child: ElevatedButton(onPressed: _busy ? null : _activate, child: Text(_busy ? (_isFr ? 'Chargement…' : 'Loading…') : (_isFr ? 'Continuer vers le paiement' : 'Continue to payment'))))]]));

  Widget _keysCard(bool isDark) {
    return _card(
      isDark,
      Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              Expanded(
                child: Text(
                  _isFr ? 'Clés API privées' : 'Private API keys',
                  style: GoogleFonts.poppins(
                    fontSize: 17,
                    fontWeight: FontWeight.w700,
                    color: isDark ? Colors.white : Colors.black87,
                  ),
                ),
              ),
              IconButton(
                onPressed: _busy ? null : () => _showCreateKeyDialog(isDark),
                icon: const Icon(Icons.add_circle, color: primaryColor),
              ),
            ],
          ),
          Text(
            _isFr
                ? 'Le secret complet n’est affiché qu’une seule fois.'
                : 'The full secret is shown only once.',
            style: GoogleFonts.poppins(
              fontSize: 12,
              color: isDark ? Colors.grey[400] : Colors.grey[600],
            ),
          ),
          const SizedBox(height: 8),
          if (_keys.isEmpty)
            Text(
              _isFr ? 'Aucune clé créée.' : 'No keys created.',
              style: GoogleFonts.poppins(
                color: isDark ? Colors.grey[300] : Colors.grey[700],
              ),
            )
          else
            ..._keys.map(
              (key) => ListTile(
                contentPadding: EdgeInsets.zero,
                title: Text(
                  "${key['label']}",
                  style: TextStyle(
                    color: isDark ? Colors.white : Colors.black87,
                  ),
                ),
                subtitle: Text(
                  "${key['keyId']} · ${key['secretPrefix']}…",
                  style: TextStyle(
                    color: isDark ? Colors.grey[400] : Colors.grey[600],
                  ),
                ),
                trailing: key['revokedAt'] != null
                    ? _tag(_isFr ? 'Révoquée' : 'Revoked', Colors.grey)
                    : IconButton(
                        onPressed: () => _revokeKey(key['keyId']),
                        icon: const Icon(Icons.block, color: Colors.red),
                      ),
              ),
            ),
        ],
      ),
    );
  }

  Widget _ordersCard(bool isDark) {
    return _card(
      isDark,
      Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(
            _isFr ? 'Historique API' : 'API history',
            style: GoogleFonts.poppins(
              fontSize: 17,
              fontWeight: FontWeight.w700,
              color: isDark ? Colors.white : Colors.black87,
            ),
          ),
          const SizedBox(height: 8),
          if (_orders.isEmpty)
            Text(
              _isFr ? 'Aucune commande API.' : 'No API orders.',
              style: GoogleFonts.poppins(
                color: isDark ? Colors.grey[300] : Colors.grey[700],
              ),
            )
          else
            ..._orders.map(
              (order) => ListTile(
                contentPadding: EdgeInsets.zero,
                title: Text(
                  "${order['reference']}",
                  style: TextStyle(
                    color: isDark ? Colors.white : Colors.black87,
                  ),
                ),
                subtitle: Text(
                  "${order['quantity']} · ${order['amount']} FCFA",
                  style: TextStyle(
                    color: isDark ? Colors.grey[400] : Colors.grey[600],
                  ),
                ),
                trailing: Text(
                  _statusLabel(order['statusNumber']),
                  style: TextStyle(color: primaryColor, fontSize: 12),
                ),
              ),
            ),
        ],
      ),
    );
  }

  String _statusLabel(dynamic value) => {'0': 'invalid_url', '1': 'pending', '2': 'in_progress', '3': 'completed'}['$value'] ?? 'unknown';

  Widget _field(String label, TextEditingController controller, TextInputType type, bool isDark) => Padding(padding: const EdgeInsets.only(top: 10), child: TextField(controller: controller, keyboardType: type, style: TextStyle(color: isDark ? Colors.white : Colors.black87), decoration: _inputDecoration(label, isDark)));
  InputDecoration _inputDecoration(String label, bool isDark) => InputDecoration(labelText: label, labelStyle: TextStyle(color: isDark ? Colors.grey[300] : Colors.grey[700]), border: const OutlineInputBorder());
  Widget _card(bool isDark, Widget child) => Container(padding: const EdgeInsets.all(16), decoration: BoxDecoration(color: isDark ? const Color(0xFF1E1E1E) : Colors.white, borderRadius: BorderRadius.circular(16), border: Border.all(color: isDark ? Colors.grey[800]! : Colors.grey[200]!)), child: child);
  Widget _tag(String text, Color color) => Container(margin: const EdgeInsets.only(top: 8), padding: const EdgeInsets.symmetric(horizontal: 9, vertical: 4), decoration: BoxDecoration(color: color.withOpacity(.12), borderRadius: BorderRadius.circular(14)), child: Text(text, style: TextStyle(color: color, fontSize: 12, fontWeight: FontWeight.w600)));

  Future<void> _showCreateKeyDialog(bool isDark) async {
    await showDialog<void>(context: context, builder: (dialogContext) => AlertDialog(title: Text(_isFr ? 'Nouvelle clé API' : 'New API key'), content: TextField(controller: _keyLabelController, decoration: InputDecoration(labelText: _isFr ? 'Libellé' : 'Label')), actions: [TextButton(onPressed: () => Navigator.pop(dialogContext), child: Text(_isFr ? 'Annuler' : 'Cancel')), ElevatedButton(onPressed: () { Navigator.pop(dialogContext); _createKey(); }, child: Text(_isFr ? 'Créer' : 'Create'))]));
  }
}
