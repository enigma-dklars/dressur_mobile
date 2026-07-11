// ignore_for_file: unnecessary_null_comparison, prefer_const_constructors

import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:flutter/rendering.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:dressur/5_autre/support_assistance.dart';
import 'package:dressur/components/constant.dart';
import 'package:http/http.dart' as http;

class NotificationDS {
  final int id;
  final String text;
  final DateTime createdAt;

  const NotificationDS({
    required this.id,
    required this.text,
    required this.createdAt,
  });

  factory NotificationDS.fromJson(Map<String, dynamic> json) {
    DateTime dt;
    try {
      dt = DateTime.parse(json['createdAt'] as String? ?? '');
    } catch (_) {
      dt = DateTime.now();
    }
    return NotificationDS(
      id: json['id'] as int,
      text: json['text'] as String? ?? '',
      createdAt: dt,
    );
  }
}

// ── Représente soit un header de groupe, soit une notification ───────────────
abstract class _ListItem {}

class _DateHeader extends _ListItem {
  final String label;
  _DateHeader(this.label);
}

class _NotifItem extends _ListItem {
  final NotificationDS notif;
  final String timeLabel;
  _NotifItem(this.notif, this.timeLabel);
}

// ── Helpers de formatage ─────────────────────────────────────────────────────
String _dayKey(DateTime dt) =>
    '${dt.year}-${dt.month.toString().padLeft(2, '0')}-${dt.day.toString().padLeft(2, '0')}';

String _headerLabel(DateTime dt) {
  final now = DateTime.now();
  final today = DateTime(now.year, now.month, now.day);
  final d = DateTime(dt.year, dt.month, dt.day);
  final diff = today.difference(d).inDays;

  if (diff == 0) return (langUserPhone == 'fr') ? "Aujourd'hui" : "Today";
  if (diff == 1) return (langUserPhone == 'fr') ? "Hier" : "Yesterday";

  // Nom du mois
  const monthsFr = [
    '', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
    'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
  ];
  const monthsEn = [
    '', 'January', 'February', 'March', 'April', 'May', 'June',
    'July', 'August', 'September', 'October', 'November', 'December'
  ];
  final months = (langUserPhone == 'fr') ? monthsFr : monthsEn;

  if (dt.year == now.year) {
    return '${dt.day} ${months[dt.month]}';
  }
  return '${dt.day} ${months[dt.month]} ${dt.year}';
}

String _timeLabel(DateTime dt) {
  final h = dt.hour.toString().padLeft(2, '0');
  final m = dt.minute.toString().padLeft(2, '0');
  return '$h:$m';
}

// ── Regroupement ─────────────────────────────────────────────────────────────
List<_ListItem> _buildItems(List<NotificationDS> notifications) {
  final items = <_ListItem>[];
  String? currentKey;

  for (final n in notifications) {
    final key = _dayKey(n.createdAt);
    if (key != currentKey) {
      items.add(_DateHeader(_headerLabel(n.createdAt)));
      currentKey = key;
    }
    items.add(_NotifItem(n, _timeLabel(n.createdAt)));
  }
  return items;
}

// ── Widget principal ─────────────────────────────────────────────────────────
class ListeNotification extends StatefulWidget {
  @override
  State<ListeNotification> createState() => _ListeNotificationState();
}

class _ListeNotificationState extends State<ListeNotification> {
  final ScrollController _scrollController = ScrollController();

  List<NotificationDS> _notifications = [];
  bool _loading = true;
  bool _hasError = false;

  @override
  void initState() {
    super.initState();
    _fetchNotifications();
  }

  @override
  void dispose() {
    _scrollController.dispose();
    super.dispose();
  }

  Future<void> _fetchNotifications() async {
    if (!mounted) return;
    setState(() {
      _loading = true;
      _hasError = false;
    });

    try {
      final url = Uri.parse('$generalRouteForApi/getNotifications');
      final response = await http.post(
        url,
        body: {'uid': '$uidUser'},
      ).timeout(const Duration(seconds: 15));

      if (!mounted) return;
      final Map<String, dynamic> body = jsonDecode(response.body);

      if (body['error'] == false) {
        final List<dynamic> raw = body['notifications'] ?? [];
        setState(() {
          _notifications =
              raw.map((e) => NotificationDS.fromJson(e)).toList();
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

  @override
  Widget build(BuildContext context) {
    final isDark = Theme.of(context).brightness == Brightness.dark;

    return Scaffold(
      appBar: AppBar(
        elevation: 0,
        backgroundColor: primaryColor,
        title: Text(
          "Notifications",
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
                value: 4,
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
              if (value == 4) {
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
                  ? "Impossible de charger les notifications."
                  : "Unable to load notifications.",
              style:
                  GoogleFonts.poppins(color: Colors.grey[500], fontSize: 14),
              textAlign: TextAlign.center,
            ),
            const SizedBox(height: 16),
            TextButton.icon(
              onPressed: _fetchNotifications,
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

    if (_notifications.isEmpty) {
      return Center(
        child: Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            FaIcon(FontAwesomeIcons.solidBell,
                color: Colors.grey[300], size: 48),
            const SizedBox(height: 14),
            Text(
              (langUserPhone == "fr")
                  ? "Aucune notification reçue"
                  : "No notifications received",
              style:
                  GoogleFonts.poppins(fontSize: 15, color: Colors.grey[500]),
            ),
          ],
        ),
      );
    }

    final items = _buildItems(_notifications);

    return RefreshIndicator(
      color: primaryColor,
      onRefresh: _fetchNotifications,
      child: ListView.builder(
        controller: _scrollController,
        padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 12),
        itemCount: items.length,
        itemBuilder: (context, index) {
          final item = items[index];
          if (item is _DateHeader) {
            return _DateSeparator(label: item.label, isDark: isDark);
          } else if (item is _NotifItem) {
            return _NotificationCard(
              notif: item.notif,
              isDark: isDark,
              timeLabel: item.timeLabel,
            );
          }
          return const SizedBox.shrink();
        },
      ),
    );
  }
}

// ── Séparateur de date ────────────────────────────────────────────────────────
class _DateSeparator extends StatelessWidget {
  final String label;
  final bool isDark;

  const _DateSeparator({required this.label, required this.isDark});

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.only(top: 18, bottom: 8),
      child: Row(
        children: [
          Expanded(
            child: Divider(
              color: isDark ? Colors.grey[700] : Colors.grey[300],
              thickness: 1,
              endIndent: 10,
            ),
          ),
          Container(
            padding:
                const EdgeInsets.symmetric(horizontal: 12, vertical: 4),
            decoration: BoxDecoration(
              color: primaryColor.withOpacity(0.1),
              borderRadius: BorderRadius.circular(20),
              border: Border.all(
                  color: primaryColor.withOpacity(0.25), width: 1),
            ),
            child: Text(
              label,
              style: GoogleFonts.poppins(
                fontSize: 12,
                fontWeight: FontWeight.w600,
                color: primaryColor,
              ),
            ),
          ),
          Expanded(
            child: Divider(
              color: isDark ? Colors.grey[700] : Colors.grey[300],
              thickness: 1,
              indent: 10,
            ),
          ),
        ],
      ),
    );
  }
}

// ── Carte notification ────────────────────────────────────────────────────────
class _NotificationCard extends StatelessWidget {
  final NotificationDS notif;
  final bool isDark;
  final String timeLabel;

  const _NotificationCard({
    required this.notif,
    required this.isDark,
    required this.timeLabel,
  });

  @override
  Widget build(BuildContext context) {
    return Container(
      margin: const EdgeInsets.only(bottom: 8),
      padding: const EdgeInsets.symmetric(horizontal: 14, vertical: 13),
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
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Container(
            padding: const EdgeInsets.all(9),
            decoration: BoxDecoration(
              color: primaryColor.withOpacity(0.1),
              borderRadius: BorderRadius.circular(10),
            ),
            child: FaIcon(FontAwesomeIcons.solidBell,
                color: primaryColor, size: 18),
          ),
          const SizedBox(width: 12),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  notif.text,
                  style: GoogleFonts.poppins(
                    fontSize: 14,
                    fontWeight: FontWeight.w500,
                    color: isDark ? Colors.white : Colors.black87,
                    height: 1.45,
                  ),
                ),
                const SizedBox(height: 5),
                Text(
                  timeLabel,
                  style: GoogleFonts.poppins(
                    fontSize: 11,
                    color: isDark ? Colors.grey[500] : Colors.grey[400],
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}
