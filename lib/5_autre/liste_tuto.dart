// ignore_for_file: prefer_const_constructors

import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/5_autre/support_assistance.dart';
import 'package:dressur/components/constant.dart';
import 'package:http/http.dart' as http;
import 'package:url_launcher/url_launcher.dart';

class TutoDS {
  final int id;
  final String titre;
  final String description;
  final String? url;

  const TutoDS({
    required this.id,
    required this.titre,
    required this.description,
    this.url,
  });

  factory TutoDS.fromJson(Map<String, dynamic> json) {
    return TutoDS(
      id: json['id'] as int,
      titre: json['titre'] as String? ?? '',
      description: json['description'] as String? ?? '',
      url: json['url'] as String?,
    );
  }

  bool get hasUrl => url != null && url!.trim().isNotEmpty;
}

class ListeTuto extends StatefulWidget {
  const ListeTuto({Key? key}) : super(key: key);

  @override
  State<ListeTuto> createState() => _ListeTutoState();
}

class _ListeTutoState extends State<ListeTuto> {
  List<TutoDS> _tutos = [];
  bool _loading = true;
  bool _hasError = false;

  @override
  void initState() {
    super.initState();
    _fetchTutos();
  }

  Future<void> _fetchTutos() async {
    if (!mounted) return;
    setState(() {
      _loading = true;
      _hasError = false;
    });

    try {
      final url = Uri.parse('$generalRouteForApi/getTutos');
      final response = await http.post(
        url,
        body: {'uid': '$uidUser'},
      ).timeout(const Duration(seconds: 15));

      if (!mounted) return;
      final Map<String, dynamic> body = jsonDecode(response.body);

      if (body['error'] == false) {
        final List<dynamic> raw = body['tutos'] ?? [];
        setState(() {
          _tutos = raw.map((e) => TutoDS.fromJson(e)).toList();
          _loading = false;
        });
      } else {
        setState(() {
          _hasError = true;
          _loading = false;
        });
      }
    } catch (_) {
      if (!mounted) return;
      setState(() {
        _hasError = true;
        _loading = false;
      });
    }
  }

  Future<void> _openUrl(String rawUrl) async {
    final uri = Uri.tryParse(rawUrl);
    if (uri == null) return;
    if (await canLaunchUrl(uri)) {
      await launchUrl(uri, mode: LaunchMode.externalApplication);
    }
  }

  @override
  Widget build(BuildContext context) {
    final isDark = Theme.of(context).brightness == Brightness.dark;

    return Scaffold(
      appBar: AppBar(
        elevation: 0,
        backgroundColor: primaryColor,
        title: Text(
          (langUserPhone == 'fr') ? "Tutoriels" : "Tutorials",
          style: GoogleFonts.poppins(
            color: Colors.white,
            fontWeight: FontWeight.w400,
            fontSize: 18,
          ),
        ),
        leading: IconButton(
          onPressed: () => Navigator.pop(context),
          icon: const FaIcon(FontAwesomeIcons.chevronLeft, color: Colors.white),
        ),
        actions: [
          PopupMenuButton<int>(
            itemBuilder: (context) => [
              PopupMenuItem(
                value: 1,
                child: Text(
                  (langUserPhone == "fr") ? "Aide" : "Help",
                  style: GoogleFonts.poppins(
                      color: Colors.white, fontWeight: FontWeight.w600),
                ),
              ),
            ],
            offset: const Offset(0, 60),
            color: primaryColor,
            icon: const FaIcon(FontAwesomeIcons.bars,
                color: Colors.white, size: 20),
            elevation: 2,
            onSelected: (value) {
              if (value == 1) {
                Navigator.push(context,
                    MaterialPageRoute(builder: (_) => SupportPage()));
              }
            },
          ),
        ],
      ),
      body: _buildBody(isDark),
    );
  }

  Widget _buildBody(bool isDark) {
    if (_loading) {
      return Center(child: CircularProgressIndicator(color: primaryColor));
    }

    if (_hasError) {
      return Center(
        child: Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            FaIcon(FontAwesomeIcons.circleExclamation,
                color: Colors.grey[400], size: 40),
            const SizedBox(height: 14),
            Text(
              (langUserPhone == 'fr')
                  ? "Impossible de charger les tutoriels."
                  : "Unable to load tutorials.",
              style:
                  GoogleFonts.poppins(color: Colors.grey[500], fontSize: 14),
              textAlign: TextAlign.center,
            ),
            const SizedBox(height: 16),
            TextButton.icon(
              onPressed: _fetchTutos,
              icon: const FaIcon(FontAwesomeIcons.arrowsRotate,
                  size: 14, color: Colors.white),
              label: Text(
                (langUserPhone == 'fr') ? "Réessayer" : "Retry",
                style: GoogleFonts.poppins(color: Colors.white),
              ),
              style: TextButton.styleFrom(backgroundColor: primaryColor),
            ),
          ],
        ),
      );
    }

    if (_tutos.isEmpty) {
      return Center(
        child: Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            FaIcon(FontAwesomeIcons.graduationCap,
                color: Colors.grey[300], size: 48),
            const SizedBox(height: 14),
            Text(
              (langUserPhone == 'fr')
                  ? "Aucun tutoriel disponible"
                  : "No tutorials available",
              style:
                  GoogleFonts.poppins(fontSize: 15, color: Colors.grey[500]),
            ),
          ],
        ),
      );
    }

    return RefreshIndicator(
      color: primaryColor,
      onRefresh: _fetchTutos,
      child: ListView.builder(
        padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 12),
        itemCount: _tutos.length,
        itemBuilder: (context, index) {
          return _TutoCard(
            tuto: _tutos[index],
            isDark: isDark,
            onOpenUrl: _openUrl,
          );
        },
      ),
    );
  }
}

class _TutoCard extends StatelessWidget {
  final TutoDS tuto;
  final bool isDark;
  final Future<void> Function(String) onOpenUrl;

  const _TutoCard({
    required this.tuto,
    required this.isDark,
    required this.onOpenUrl,
  });

  @override
  Widget build(BuildContext context) {
    return Container(
      margin: const EdgeInsets.only(bottom: 10),
      decoration: BoxDecoration(
        color: isDark ? const Color(0xFF1E1E1E) : Colors.white,
        borderRadius: BorderRadius.circular(14),
        border: Border.all(
          color: isDark ? Colors.grey[800]! : Colors.grey[200]!,
          width: 1,
        ),
        boxShadow: [
          BoxShadow(
            color: isDark
                ? Colors.black.withOpacity(0.12)
                : Colors.grey.withOpacity(0.07),
            blurRadius: 8,
            offset: const Offset(0, 3),
          ),
        ],
      ),
      child: Padding(
        padding: const EdgeInsets.symmetric(horizontal: 14, vertical: 14),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            // ── En-tête : icône + titre ──────────────────────────────────
            Row(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Container(
                  padding: const EdgeInsets.all(9),
                  decoration: BoxDecoration(
                    color: primaryColor.withOpacity(0.1),
                    borderRadius: BorderRadius.circular(10),
                  ),
                  child: FaIcon(FontAwesomeIcons.graduationCap,
                      color: primaryColor, size: 18),
                ),
                const SizedBox(width: 12),
                Expanded(
                  child: Text(
                    tuto.titre,
                    style: GoogleFonts.poppins(
                      fontSize: 15,
                      fontWeight: FontWeight.w600,
                      color: isDark ? Colors.white : Colors.black87,
                    ),
                  ),
                ),
              ],
            ),
            // ── Description ──────────────────────────────────────────────
            if (tuto.description.isNotEmpty) ...[
              const SizedBox(height: 10),
              Padding(
                padding: const EdgeInsets.only(left: 2),
                child: Text(
                  tuto.description,
                  style: GoogleFonts.poppins(
                    fontSize: 13,
                    color: isDark ? Colors.grey[400] : Colors.grey[600],
                    height: 1.5,
                  ),
                ),
              ),
            ],
            // ── Bouton lien ──────────────────────────────────────────────
            if (tuto.hasUrl) ...[
              const SizedBox(height: 12),
              SizedBox(
                width: double.infinity,
                child: OutlinedButton.icon(
                  onPressed: () => onOpenUrl(tuto.url!),
                  icon: FaIcon(
                    _urlIcon(tuto.url!),
                    size: 14,
                    color: primaryColor,
                  ),
                  label: Text(
                    (langUserPhone == 'fr') ? "Voir le tutoriel" : "Watch tutorial",
                    style: GoogleFonts.poppins(
                      fontSize: 13,
                      fontWeight: FontWeight.w600,
                      color: primaryColor,
                    ),
                  ),
                  style: OutlinedButton.styleFrom(
                    side: BorderSide(color: primaryColor.withOpacity(0.4)),
                    shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(10)),
                    padding: const EdgeInsets.symmetric(vertical: 10),
                  ),
                ),
              ),
            ],
          ],
        ),
      ),
    );
  }

  IconData _urlIcon(String url) {
    final lower = url.toLowerCase();
    if (lower.contains('youtube') || lower.contains('youtu.be')) {
      return FontAwesomeIcons.youtube;
    }
    return FontAwesomeIcons.arrowUpRightFromSquare;
  }
}
