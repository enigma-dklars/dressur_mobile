import 'dart:convert';

import 'package:dressur/components/constant.dart';
import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:http/http.dart' as http;
import 'package:url_launcher/url_launcher.dart';

class MesReseauxPage extends StatefulWidget {
  const MesReseauxPage({super.key});

  @override
  State<MesReseauxPage> createState() => _MesReseauxPageState();
}

class _MesReseauxPageState extends State<MesReseauxPage> {
  static const _requestTimeout = Duration(seconds: 15);
  static const _mobileUidHeader = 'X-Dressur-Uid';

  bool _isLoading = true;
  String? _errorMessage;
  String? _catalogError;
  bool _networksLoadedSuccessfully = false;
  bool _catalogLoadedSuccessfully = false;
  List<_UserNetwork> _networks = [];
  List<_NetworkCatalogItem> _catalog = [];
  String? _deletingNetworkType;
  String? _updatingNetworkType;

  String get _uid => uidUser?.toString().trim() ?? '';
  bool get _isFrench => langUserPhone == 'fr';
  bool get _isMutating =>
      _deletingNetworkType != null || _updatingNetworkType != null;
  bool get _canManageNetworks =>
      !_isLoading &&
      _networksLoadedSuccessfully &&
      _catalogLoadedSuccessfully &&
      _errorMessage == null &&
      _catalogError == null;

  @override
  void initState() {
    super.initState();
    _loadNetworks();
  }

  Future<void> _loadNetworks() async {
    if (!mounted) return;

    setState(() {
      _isLoading = true;
      _errorMessage = null;
      _catalogError = null;
      _networksLoadedSuccessfully = false;
      _catalogLoadedSuccessfully = false;
    });

    if (_uid.isEmpty) {
      setState(() {
        _isLoading = false;
        _errorMessage = _isFrench
            ? 'Votre session est invalide. Veuillez vous reconnecter.'
            : 'Your session is invalid. Please sign in again.';
      });
      return;
    }

    List<_UserNetwork>? loadedNetworks;
    List<_NetworkCatalogItem>? loadedCatalog;
    String? networksError;
    String? catalogError;

    try {
      final response = await _getWithUid(
        Uri.parse('$generalRouteForApi/user/social-networks'),
      );
      final payload = _readPayload(
        response,
        _isFrench
            ? 'Impossible de charger vos réseaux.'
            : 'Unable to load your networks.',
      );
      final rawNetworks = payload['networks'];
      if (rawNetworks is! List) {
        throw _NetworkApiException(
          _isFrench
              ? 'La réponse de vos réseaux est invalide.'
              : 'Your networks response is invalid.',
        );
      }

      loadedNetworks = rawNetworks
          .whereType<Map>()
          .map(_UserNetwork.fromJson)
          .where((network) => network.networkType.isNotEmpty)
          .toList();
    } catch (error) {
      networksError = _errorMessageFor(error);
    }

    try {
      final response = await http
          .get(Uri.parse('$generalRouteForApi/social-networks/catalog'))
          .timeout(_requestTimeout);
      final payload = _readPayload(
        response,
        _isFrench
            ? 'Impossible de charger les réseaux disponibles.'
            : 'Unable to load available networks.',
      );
      final rawCatalog = payload['networks'];
      if (rawCatalog is! List) {
        throw _NetworkApiException(
          _isFrench
              ? 'La réponse du catalogue est invalide.'
              : 'The catalog response is invalid.',
        );
      }

      loadedCatalog = rawCatalog
          .whereType<Map>()
          .map(_NetworkCatalogItem.fromJson)
          .where((network) => network.id.isNotEmpty)
          .toList();
    } catch (error) {
      catalogError = _errorMessageFor(error);
    }

    if (!mounted) return;
    setState(() {
      if (loadedNetworks != null) {
        _networks = loadedNetworks;
      }
      if (loadedCatalog != null) {
        _catalog = loadedCatalog;
      }
      _isLoading = false;
      _errorMessage = networksError;
      _catalogError = catalogError;
      _networksLoadedSuccessfully = loadedNetworks != null;
      _catalogLoadedSuccessfully = loadedCatalog != null;
    });
  }

  Future<http.Response> _getWithUid(Uri uri) async {
    final request = http.Request('GET', uri)
      ..headers.addAll(_authHeaders);
    final streamedResponse = await request.send().timeout(_requestTimeout);
    return http.Response.fromStream(streamedResponse);
  }

  Future<http.Response> _deleteWithUid(Uri uri) async {
    final request = http.Request('DELETE', uri)
      ..headers.addAll(_authHeaders);
    final streamedResponse = await request.send().timeout(_requestTimeout);
    return http.Response.fromStream(streamedResponse);
  }

  Map<String, String> get _authHeaders => {
        'Accept': 'application/json',
        _mobileUidHeader: _uid,
      };

  Map<String, dynamic> _readPayload(http.Response response, String fallback) {
    dynamic decoded;
    try {
      decoded = jsonDecode(response.body);
    } catch (_) {
      throw _NetworkApiException(fallback);
    }

    if (decoded is! Map) {
      throw _NetworkApiException(fallback);
    }

    final payload = Map<String, dynamic>.from(decoded);
    final statusIsError =
        response.statusCode < 200 || response.statusCode >= 300;
    if (statusIsError || payload['error'] == true) {
      final message = payload['message'] ?? payload['titre'];
      throw _NetworkApiException(
        message is String && message.trim().isNotEmpty ? message : fallback,
      );
    }
    return payload;
  }

  String _errorMessageFor(Object error) {
    if (error is _NetworkApiException) return error.message;
    return _isFrench
        ? 'Une erreur réseau est survenue. Veuillez réessayer.'
        : 'A network error occurred. Please try again.';
  }

  List<_NetworkCatalogItem> get _availableNetworks {
    final existingTypes = _networks
        .map((network) => network.networkType)
        .toSet();
    return _catalog
        .where((network) => !existingTypes.contains(network.id))
        .toList();
  }

  String _networkLabel(String networkType) {
    for (final network in _catalog) {
      if (network.id == networkType) return network.label;
    }
    return networkType.isEmpty
        ? (_isFrench ? 'Réseau' : 'Network')
        : networkType;
  }

  Future<String?> _createNetwork(String networkType, String url) async {
    if (_uid.isEmpty) {
      return _isFrench
          ? 'Votre session est invalide. Veuillez vous reconnecter.'
          : 'Your session is invalid. Please sign in again.';
    }

    try {
      final response = await http
          .post(
            Uri.parse('$generalRouteForApi/user/social-networks'),
            headers: _authHeaders,
            body: {'networkType': networkType, 'url': url.trim()},
          )
          .timeout(_requestTimeout);
      final payload = _readPayload(
        response,
        _isFrench
            ? 'Impossible d’ajouter ce réseau.'
            : 'Unable to add this network.',
      );
      final rawNetwork = payload['network'];
      if (rawNetwork is! Map) {
        throw _NetworkApiException(
          _isFrench
              ? 'La réponse du serveur est invalide.'
              : 'The server response is invalid.',
        );
      }

      final network = _UserNetwork.fromJson(rawNetwork);
      if (!mounted) return null;
      setState(() => _networks = [..._networks, network]);
      return null;
    } catch (error) {
      return _errorMessageFor(error);
    }
  }

  Future<String?> _updateNetwork(_UserNetwork network, String url) async {
    if (_uid.isEmpty) {
      return _isFrench
          ? 'Votre session est invalide. Veuillez vous reconnecter.'
          : 'Your session is invalid. Please sign in again.';
    }

    try {
      final response = await http
          .put(
            Uri.parse(
              '$generalRouteForApi/user/social-networks/'
              '${Uri.encodeComponent(network.networkType)}',
            ),
            headers: _authHeaders,
            body: {'url': url.trim()},
          )
          .timeout(_requestTimeout);
      final payload = _readPayload(
        response,
        _isFrench
            ? 'Impossible de modifier ce réseau.'
            : 'Unable to update this network.',
      );
      final rawNetwork = payload['network'];
      if (rawNetwork is! Map) {
        throw _NetworkApiException(
          _isFrench
              ? 'La réponse du serveur est invalide.'
              : 'The server response is invalid.',
        );
      }

      final updatedNetwork = _UserNetwork.fromJson(rawNetwork);
      if (!mounted) return null;
      setState(() {
        _networks = _networks
            .map(
              (item) => item.networkType == updatedNetwork.networkType
                  ? updatedNetwork
                  : item,
            )
            .toList();
      });
      return null;
    } catch (error) {
      return _errorMessageFor(error);
    }
  }

  Future<void> _confirmAndDelete(_UserNetwork network) async {
    if (_isMutating) return;

    final shouldDelete = await showDialog<bool>(
      context: context,
      builder: (dialogContext) => AlertDialog(
        title: Text(
          _isFrench ? 'Supprimer ce réseau ?' : 'Delete this network?',
        ),
        content: Text(
          _isFrench
              ? 'Cette entrée sera retirée de votre profil.'
              : 'This entry will be removed from your profile.',
        ),
        actions: [
          TextButton(
            onPressed: () => Navigator.of(dialogContext).pop(false),
            child: Text(_isFrench ? 'Annuler' : 'Cancel'),
          ),
          ElevatedButton(
            onPressed: () => Navigator.of(dialogContext).pop(true),
            style: ElevatedButton.styleFrom(backgroundColor: Colors.red[700]),
            child: Text(_isFrench ? 'Supprimer' : 'Delete'),
          ),
        ],
      ),
    );

    if (shouldDelete != true || _isMutating) return;
    if (_uid.isEmpty) {
      _showSnackBar(
        _isFrench
            ? 'Votre session est invalide. Veuillez vous reconnecter.'
            : 'Your session is invalid. Please sign in again.',
        isError: true,
      );
      return;
    }

    setState(() => _deletingNetworkType = network.networkType);
    try {
      final response = await _deleteWithUid(
        Uri.parse(
          '$generalRouteForApi/user/social-networks/${Uri.encodeComponent(network.networkType)}',
        ),
      );
      _readPayload(
        response,
        _isFrench
            ? 'Impossible de supprimer ce réseau.'
            : 'Unable to delete this network.',
      );
      if (!mounted) return;
      setState(() {
        _networks = _networks
            .where((item) => item.networkType != network.networkType)
            .toList();
      });
      _showSnackBar(_isFrench ? 'Réseau supprimé.' : 'Network deleted.');
    } catch (error) {
      if (!mounted) return;
      _showSnackBar(_errorMessageFor(error), isError: true);
    } finally {
      if (mounted) setState(() => _deletingNetworkType = null);
    }
  }

  Future<void> _showAddNetworkDialog() async {
    if (_isMutating) return;

    if (!_canManageNetworks) {
      _showSnackBar(
        _errorMessage ??
            _catalogError ??
            (_isFrench
                ? 'Les données des réseaux ne sont pas disponibles. Réessayez.'
                : 'Network data is not available. Please try again.'),
        isError: true,
      );
      return;
    }

    final availableNetworks = _availableNetworks;
    if (availableNetworks.isEmpty) {
      _showSnackBar(
        _isFrench
            ? 'Tous les réseaux disponibles sont déjà ajoutés.'
            : 'All available networks have already been added.',
        isError: true,
      );
      return;
    }

    final wasAdded = await showDialog<bool>(
      context: context,
      builder: (_) => _NetworkFormDialog(
        isFrench: _isFrench,
        networks: availableNetworks,
        onSubmit: _createNetwork,
      ),
    );
    if (wasAdded == true && mounted) {
      _showSnackBar(_isFrench ? 'Réseau ajouté.' : 'Network added.');
    }
  }

  Future<void> _showEditNetworkDialog(_UserNetwork network) async {
    if (_isMutating) return;

    _NetworkCatalogItem? catalogNetwork;
    for (final item in _catalog) {
      if (item.id == network.networkType) {
        catalogNetwork = item;
        break;
      }
    }
    final selectedCatalogNetwork =
        catalogNetwork ??
        _NetworkCatalogItem(
          id: network.networkType,
          label: _networkLabel(network.networkType),
        );

    setState(() => _updatingNetworkType = network.networkType);
    final wasUpdated = await showDialog<bool>(
      context: context,
      builder: (_) => _NetworkFormDialog(
        isFrench: _isFrench,
        isEditing: true,
        networks: [selectedCatalogNetwork],
        initialNetworkType: network.networkType,
        initialUrl: network.url,
        onSubmit: (_, url) => _updateNetwork(network, url),
      ),
    );
    if (mounted) setState(() => _updatingNetworkType = null);
    if (wasUpdated == true && mounted) {
      _showSnackBar(_isFrench ? 'Réseau modifié.' : 'Network updated.');
    }
  }

  void _showSnackBar(String message, {bool isError = false}) {
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(
        content: Text(message),
        backgroundColor: isError ? Colors.red[700] : Colors.green[700],
        behavior: SnackBarBehavior.floating,
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        elevation: 0,
        backgroundColor: primaryColor,
        leading: IconButton(
          onPressed: () => Navigator.pop(context),
          icon: const FaIcon(FontAwesomeIcons.chevronLeft, color: Colors.white),
        ),
        title: Text(
          _isFrench ? 'Mes réseaux' : 'My networks',
          style: GoogleFonts.poppins(
            color: Colors.white,
            fontWeight: FontWeight.w500,
            fontSize: 18,
          ),
        ),
        actions: [
          IconButton(
            onPressed: _canManageNetworks && !_isMutating
                ? _showAddNetworkDialog
                : null,
            tooltip: _isFrench ? 'Ajouter un réseau' : 'Add a network',
            icon: const FaIcon(FontAwesomeIcons.plus, color: Colors.white),
          ),
        ],
      ),
      body: _buildBody(),
    );
  }

  Widget _buildBody() {
    if (_isLoading) {
      return _buildScrollableState(
        Center(
          child: Column(
            mainAxisSize: MainAxisSize.min,
            children: [
              CircularProgressIndicator(color: primaryColor),
              const SizedBox(height: 14),
              Text(
                _isFrench
                    ? 'Chargement de vos réseaux…'
                    : 'Loading your networks…',
                style: GoogleFonts.poppins(color: Colors.grey[600]),
              ),
            ],
          ),
        ),
      );
    }

    if (_errorMessage != null) {
      return _buildScrollableState(
        _StateMessage(
          icon: FontAwesomeIcons.triangleExclamation,
          title: _isFrench
              ? 'Impossible de charger vos réseaux'
              : 'Unable to load your networks',
          message: _errorMessage!,
          actionLabel: _isFrench ? 'Réessayer' : 'Retry',
          onAction: _loadNetworks,
          isError: true,
        ),
      );
    }

    if (_networks.isEmpty) {
      return _buildScrollableState(
        _StateMessage(
          icon: FontAwesomeIcons.shareNodes,
          title: _isFrench ? 'Aucun réseau enregistré' : 'No networks saved',
          message: _isFrench
              ? 'Ajoutez vos réseaux publics pour permettre à vos contacts de vous retrouver facilement.'
              : 'Add your public networks so your contacts can find you easily.',
          actionLabel: _isFrench
              ? 'Ajouter mon premier réseau'
              : 'Add my first network',
          onAction: _showAddNetworkDialog,
        ),
      );
    }

    return RefreshIndicator(
      color: primaryColor,
      onRefresh: _loadNetworks,
      child: ListView(
        physics: const AlwaysScrollableScrollPhysics(),
        padding: const EdgeInsets.fromLTRB(12, 16, 12, 28),
        children: [
          Text(
            _isFrench
                ? 'Les liens publics de votre profil'
                : 'The public links on your profile',
            style: GoogleFonts.poppins(color: Colors.grey[600], fontSize: 13),
          ),
          const SizedBox(height: 12),
          ..._networks.map(_buildNetworkCard),
        ],
      ),
    );
  }

  Widget _buildScrollableState(Widget child) {
    return RefreshIndicator(
      color: primaryColor,
      onRefresh: _loadNetworks,
      child: ListView(
        physics: const AlwaysScrollableScrollPhysics(),
        padding: const EdgeInsets.all(24),
        children: [
          SizedBox(
            height: MediaQuery.of(context).size.height * 0.58,
            child: Center(child: child),
          ),
        ],
      ),
    );
  }

  Widget _buildNetworkCard(_UserNetwork network) {
    final isDeleting = _deletingNetworkType == network.networkType;
    final isUpdating = _updatingNetworkType == network.networkType;
    final isMutating = _isMutating;
    final uri = Uri.tryParse(network.url);
    final canOpen =
        uri != null && (uri.scheme == 'http' || uri.scheme == 'https');

    return Card(
      elevation: 0,
      margin: const EdgeInsets.only(bottom: 10),
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(15)),
      child: Padding(
        padding: const EdgeInsets.fromLTRB(14, 12, 8, 12),
        child: Row(
          children: [
            Container(
              width: 44,
              height: 44,
              decoration: BoxDecoration(
                color: primaryColor.withOpacity(0.1),
                borderRadius: BorderRadius.circular(13),
              ),
              child: const Center(
                child: FaIcon(
                  FontAwesomeIcons.shareNodes,
                  color: primaryColor,
                  size: 19,
                ),
              ),
            ),
            const SizedBox(width: 12),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    _networkLabel(network.networkType),
                    style: GoogleFonts.poppins(
                      fontWeight: FontWeight.w600,
                      fontSize: 14,
                    ),
                  ),
                  const SizedBox(height: 3),
                  InkWell(
                    onTap: canOpen
                        ? () => launchUrl(
                            Uri.parse(network.url),
                            mode: LaunchMode.externalApplication,
                          )
                        : null,
                    child: Text(
                      network.url,
                      maxLines: 2,
                      overflow: TextOverflow.ellipsis,
                      style: GoogleFonts.poppins(
                        color: canOpen ? primaryColor : Colors.grey[600],
                        fontSize: 12,
                        decoration: canOpen ? TextDecoration.underline : null,
                      ),
                    ),
                  ),
                ],
              ),
            ),
            IconButton(
              onPressed: isMutating
                  ? null
                  : () => _showEditNetworkDialog(network),
              tooltip: _isFrench ? 'Modifier' : 'Edit',
              icon: isUpdating
                  ? SizedBox(
                      width: 18,
                      height: 18,
                      child: CircularProgressIndicator(
                        strokeWidth: 2,
                        color: primaryColor,
                      ),
                    )
                  : const FaIcon(
                      FontAwesomeIcons.penToSquare,
                      color: primaryColor,
                      size: 17,
                    ),
            ),
            IconButton(
              onPressed: isMutating ? null : () => _confirmAndDelete(network),
              tooltip: _isFrench ? 'Supprimer' : 'Delete',
              icon: isDeleting
                  ? SizedBox(
                      width: 18,
                      height: 18,
                      child: CircularProgressIndicator(
                        strokeWidth: 2,
                        color: Colors.red[700],
                      ),
                    )
                  : FaIcon(
                      FontAwesomeIcons.trash,
                      color: Colors.red[700],
                      size: 17,
                    ),
            ),
          ],
        ),
      ),
    );
  }
}

class _NetworkFormDialog extends StatefulWidget {
  const _NetworkFormDialog({
    required this.isFrench,
    required this.networks,
    required this.onSubmit,
    this.isEditing = false,
    this.initialNetworkType,
    this.initialUrl = '',
  });

  final bool isFrench;
  final List<_NetworkCatalogItem> networks;
  final Future<String?> Function(String networkType, String url) onSubmit;
  final bool isEditing;
  final String? initialNetworkType;
  final String initialUrl;

  @override
  State<_NetworkFormDialog> createState() => _NetworkFormDialogState();
}

class _NetworkFormDialogState extends State<_NetworkFormDialog> {
  final _formKey = GlobalKey<FormState>();
  late final TextEditingController _urlController;
  String? _selectedNetworkType;
  String? _errorMessage;
  bool _isSubmitting = false;

  @override
  void initState() {
    super.initState();
    _selectedNetworkType = widget.initialNetworkType;
    _urlController = TextEditingController(text: widget.initialUrl);
  }

  @override
  void dispose() {
    _urlController.dispose();
    super.dispose();
  }

  Future<void> _submit() async {
    if (!_formKey.currentState!.validate() ||
        _selectedNetworkType == null ||
        _isSubmitting) {
      return;
    }

    setState(() {
      _isSubmitting = true;
      _errorMessage = null;
    });
    final error = await widget.onSubmit(
      _selectedNetworkType!,
      _urlController.text,
    );
    if (!mounted) return;

    if (error != null) {
      setState(() {
        _isSubmitting = false;
        _errorMessage = error;
      });
      return;
    }

    Navigator.of(context).pop(true);
  }

  @override
  Widget build(BuildContext context) {
    return AlertDialog(
      title: Text(
        widget.isEditing
            ? (widget.isFrench ? 'Modifier un réseau' : 'Edit a network')
            : (widget.isFrench ? 'Ajouter un réseau' : 'Add a network'),
        style: GoogleFonts.poppins(fontWeight: FontWeight.w600),
      ),
      content: SingleChildScrollView(
        child: Form(
          key: _formKey,
          child: Column(
            mainAxisSize: MainAxisSize.min,
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              if (_errorMessage != null)
                Container(
                  width: double.infinity,
                  margin: const EdgeInsets.only(bottom: 12),
                  padding: const EdgeInsets.all(10),
                  decoration: BoxDecoration(
                    color: Colors.red.withOpacity(0.08),
                    borderRadius: BorderRadius.circular(10),
                  ),
                  child: Text(
                    _errorMessage!,
                    style: TextStyle(color: Colors.red[700], fontSize: 12),
                  ),
                ),
              DropdownButtonFormField<String>(
                value: _selectedNetworkType,
                decoration: InputDecoration(
                  labelText: widget.isFrench ? 'Réseau' : 'Network',
                  border: const OutlineInputBorder(),
                ),
                items: widget.networks
                    .map(
                      (network) => DropdownMenuItem<String>(
                        value: network.id,
                        child: Text(network.label),
                      ),
                    )
                    .toList(),
                onChanged: widget.isEditing || _isSubmitting
                    ? null
                    : (value) => setState(() => _selectedNetworkType = value),
                validator: (value) => value == null
                    ? (widget.isFrench
                          ? 'Sélectionnez un réseau.'
                          : 'Select a network.')
                    : null,
              ),
              const SizedBox(height: 14),
              TextFormField(
                controller: _urlController,
                enabled: !_isSubmitting,
                keyboardType: TextInputType.url,
                textInputAction: TextInputAction.done,
                autocorrect: false,
                maxLength: 512,
                decoration: InputDecoration(
                  labelText: widget.isFrench ? 'URL du profil' : 'Profile URL',
                  hintText: 'https://…',
                  border: const OutlineInputBorder(),
                ),
                validator: (value) {
                  final url = value?.trim() ?? '';
                  if (url.isEmpty) {
                    return widget.isFrench
                        ? 'L’URL est obligatoire.'
                        : 'The URL is required.';
                  }
                  if (url.length > 512) {
                    return widget.isFrench
                        ? '512 caractères maximum.'
                        : '512 characters maximum.';
                  }
                  return null;
                },
                onFieldSubmitted: (_) => _submit(),
              ),
            ],
          ),
        ),
      ),
      actions: [
        TextButton(
          onPressed: _isSubmitting ? null : () => Navigator.pop(context),
          child: Text(widget.isFrench ? 'Annuler' : 'Cancel'),
        ),
        ElevatedButton(
          onPressed: _isSubmitting ? null : _submit,
          child: _isSubmitting
              ? const SizedBox(
                  width: 18,
                  height: 18,
                  child: CircularProgressIndicator(
                    strokeWidth: 2,
                    color: Colors.white,
                  ),
                )
              : Text(widget.isFrench ? 'Enregistrer' : 'Save'),
        ),
      ],
    );
  }
}

class _UserNetwork {
  const _UserNetwork({required this.networkType, required this.url});

  final String networkType;
  final String url;

  factory _UserNetwork.fromJson(Map<dynamic, dynamic> json) {
    return _UserNetwork(
      networkType: json['networkType']?.toString() ?? '',
      url: json['url']?.toString() ?? '',
    );
  }
}

class _NetworkCatalogItem {
  const _NetworkCatalogItem({required this.id, required this.label});

  final String id;
  final String label;

  factory _NetworkCatalogItem.fromJson(Map<dynamic, dynamic> json) {
    final id = json['id']?.toString() ?? '';
    final label = json['label']?.toString() ?? id;
    return _NetworkCatalogItem(id: id, label: label);
  }
}

class _StateMessage extends StatelessWidget {
  const _StateMessage({
    required this.icon,
    required this.title,
    required this.message,
    required this.actionLabel,
    required this.onAction,
    this.isError = false,
  });

  final IconData icon;
  final String title;
  final String message;
  final String actionLabel;
  final Future<void> Function() onAction;
  final bool isError;

  @override
  Widget build(BuildContext context) {
    return Column(
      mainAxisSize: MainAxisSize.min,
      children: [
        Container(
          width: 64,
          height: 64,
          decoration: BoxDecoration(
            color: (isError ? Colors.red : primaryColor).withOpacity(0.1),
            borderRadius: BorderRadius.circular(18),
          ),
          child: Center(
            child: FaIcon(
              icon,
              color: isError ? Colors.red[700] : primaryColor,
              size: 27,
            ),
          ),
        ),
        const SizedBox(height: 16),
        Text(
          title,
          textAlign: TextAlign.center,
          style: GoogleFonts.poppins(fontSize: 17, fontWeight: FontWeight.w600),
        ),
        const SizedBox(height: 8),
        Text(
          message,
          textAlign: TextAlign.center,
          style: GoogleFonts.poppins(
            color: Colors.grey[600],
            fontSize: 13,
            height: 1.4,
          ),
        ),
        const SizedBox(height: 18),
        ElevatedButton.icon(
          onPressed: onAction,
          icon: FaIcon(
            isError ? FontAwesomeIcons.rotateRight : FontAwesomeIcons.plus,
            size: 14,
          ),
          label: Text(actionLabel),
          style: ElevatedButton.styleFrom(
            backgroundColor: primaryColor,
            foregroundColor: Colors.white,
          ),
        ),
      ],
    );
  }
}

class _NetworkApiException implements Exception {
  const _NetworkApiException(this.message);

  final String message;
}
