// ignore_for_file: use_build_context_synchronously

import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:http/http.dart' as http;
import 'package:dressur/components/constant.dart';

class AssistantPage extends StatefulWidget {
  const AssistantPage({Key? key}) : super(key: key);

  @override
  State<AssistantPage> createState() => _AssistantPageState();
}

class _AssistantPageState extends State<AssistantPage> {
  final List<_ChatMsg> _messages = [];
  final TextEditingController _controller = TextEditingController();
  final ScrollController _scrollController = ScrollController();
  bool _isLoading = false;

  @override
  void dispose() {
    _controller.dispose();
    _scrollController.dispose();
    super.dispose();
  }

  Future<void> _sendMessage() async {
    final text = _controller.text.trim();
    if (text.isEmpty || _isLoading) return;

    setState(() {
      _messages.add(_ChatMsg(role: 'user', content: text));
      _isLoading = true;
    });
    _controller.clear();
    _scrollToBottom();

    try {
      final request = http.MultipartRequest(
        'POST',
        Uri.parse('$generalRouteForApi/chat'),
      );
      request.fields['uid'] = uidUser ?? '';
      request.fields['message'] = text;

      final streamed = await request.send().timeout(const Duration(seconds: 20));
      final response = await http.Response.fromStream(streamed);
      final data = jsonDecode(response.body);

      if (!mounted) return;
      if (data['error'] == false && data['reply'] != null) {
        setState(() {
          _messages.add(_ChatMsg(role: 'assistant', content: data['reply']));
        });
      } else {
        _showError();
      }
    } catch (_) {
      if (!mounted) return;
      _showError();
    } finally {
      if (!mounted) return;
      setState(() => _isLoading = false);
      _scrollToBottom();
    }
  }

  void _showError() {
    setState(() {
      _messages.add(_ChatMsg(
        role: 'assistant',
        content: (langUserPhone == 'fr')
            ? 'Une erreur est survenue. Veuillez réessayer.'
            : 'An error occurred. Please try again.',
        isError: true,
      ));
    });
  }

  void _scrollToBottom() {
    WidgetsBinding.instance.addPostFrameCallback((_) {
      if (_scrollController.hasClients) {
        _scrollController.animateTo(
          _scrollController.position.maxScrollExtent,
          duration: const Duration(milliseconds: 300),
          curve: Curves.easeOut,
        );
      }
    });
  }

  @override
  Widget build(BuildContext context) {
    final isDark = Theme.of(context).brightness == Brightness.dark;

    return Scaffold(
      backgroundColor: isDark ? const Color(0xFF121212) : const Color(0xFFF8F9FA),
      appBar: AppBar(
        backgroundColor: primaryColor,
        elevation: 0,
        leading: IconButton(
          icon: const Icon(Icons.arrow_back, color: Colors.white),
          onPressed: () => Navigator.pop(context),
        ),
        title: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(
              (langUserPhone == 'fr') ? 'Assistant Dressur' : 'Dressur Assistant',
              style: GoogleFonts.poppins(
                color: Colors.white,
                fontWeight: FontWeight.w600,
                fontSize: 16,
              ),
            ),
            Text(
              (langUserPhone == 'fr') ? 'Powered by IA' : 'Powered by AI',
              style: GoogleFonts.poppins(
                color: Colors.white70,
                fontSize: 11,
              ),
            ),
          ],
        ),
      ),
      body: Column(
        children: [
          // Liste des messages
          Expanded(
            child: _messages.isEmpty
                ? _buildEmptyState(isDark)
                : ListView.builder(
                    controller: _scrollController,
                    padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 16),
                    itemCount: _messages.length,
                    itemBuilder: (context, index) {
                      return _buildBubble(_messages[index], isDark);
                    },
                  ),
          ),

          // Indicateur de chargement
          if (_isLoading)
            Padding(
              padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 4),
              child: Row(
                children: [
                  const SizedBox(
                    width: 20,
                    height: 20,
                    child: CircularProgressIndicator(strokeWidth: 2),
                  ),
                  const SizedBox(width: 10),
                  Text(
                    (langUserPhone == 'fr') ? 'Réponse en cours...' : 'Thinking...',
                    style: GoogleFonts.poppins(fontSize: 12, color: Colors.grey),
                  ),
                ],
              ),
            ),

          // Champ de saisie
          _buildInputBar(isDark),
        ],
      ),
    );
  }

  Widget _buildEmptyState(bool isDark) {
    return Center(
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Icon(Icons.smart_toy_outlined, size: 64, color: primaryColor.withOpacity(0.5)),
          const SizedBox(height: 16),
          Text(
            (langUserPhone == 'fr')
                ? 'Bonjour ${nom ?? ''} 👋\nComment puis-je vous aider ?'
                : 'Hello ${nom ?? ''} 👋\nHow can I help you?',
            textAlign: TextAlign.center,
            style: GoogleFonts.poppins(
              fontSize: 16,
              fontWeight: FontWeight.w500,
              color: isDark ? Colors.white70 : Colors.black54,
            ),
          ),
          const SizedBox(height: 8),
          Text(
            (langUserPhone == 'fr')
                ? 'Je réponds uniquement aux questions sur Dressur.'
                : 'I only answer questions about Dressur.',
            textAlign: TextAlign.center,
            style: GoogleFonts.poppins(
              fontSize: 12,
              color: Colors.grey,
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildBubble(_ChatMsg msg, bool isDark) {
    final isUser = msg.role == 'user';
    return Padding(
      padding: const EdgeInsets.only(bottom: 10),
      child: Row(
        mainAxisAlignment: isUser ? MainAxisAlignment.end : MainAxisAlignment.start,
        crossAxisAlignment: CrossAxisAlignment.end,
        children: [
          if (!isUser) ...[
            CircleAvatar(
              radius: 14,
              backgroundColor: primaryColor,
              child: const Icon(Icons.smart_toy, size: 16, color: Colors.white),
            ),
            const SizedBox(width: 6),
          ],
          Flexible(
            child: Container(
              padding: const EdgeInsets.symmetric(horizontal: 14, vertical: 10),
              decoration: BoxDecoration(
                color: isUser
                    ? primaryColor
                    : (msg.isError
                        ? Colors.red.shade50
                        : (isDark ? const Color(0xFF2A2A2A) : Colors.white)),
                borderRadius: BorderRadius.only(
                  topLeft: const Radius.circular(16),
                  topRight: const Radius.circular(16),
                  bottomLeft: Radius.circular(isUser ? 16 : 4),
                  bottomRight: Radius.circular(isUser ? 4 : 16),
                ),
                boxShadow: [
                  BoxShadow(
                    color: Colors.black.withOpacity(0.06),
                    blurRadius: 4,
                    offset: const Offset(0, 2),
                  ),
                ],
              ),
              child: Text(
                msg.content,
                style: GoogleFonts.poppins(
                  fontSize: 13,
                  color: isUser
                      ? Colors.white
                      : (msg.isError ? Colors.red : (isDark ? Colors.white : Colors.black87)),
                ),
              ),
            ),
          ),
          if (isUser) ...[
            const SizedBox(width: 6),
            CircleAvatar(
              radius: 14,
              backgroundColor: primaryColor.withOpacity(0.2),
              child: Text(
                ((nom != null && nom!.isNotEmpty) ? nom! : 'U').substring(0, 1).toUpperCase(),
                style: GoogleFonts.poppins(
                  fontSize: 12,
                  fontWeight: FontWeight.bold,
                  color: primaryColor,
                ),
              ),
            ),
          ],
        ],
      ),
    );
  }

  Widget _buildInputBar(bool isDark) {
    return Container(
      padding: const EdgeInsets.fromLTRB(12, 8, 12, 16),
      decoration: BoxDecoration(
        color: isDark ? const Color(0xFF1E1E1E) : Colors.white,
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(0.08),
            blurRadius: 8,
            offset: const Offset(0, -2),
          ),
        ],
      ),
      child: Row(
        children: [
          Expanded(
            child: TextField(
              controller: _controller,
              onSubmitted: (_) => _sendMessage(),
              maxLines: 3,
              minLines: 1,
              textCapitalization: TextCapitalization.sentences,
              style: GoogleFonts.poppins(fontSize: 13),
              decoration: InputDecoration(
                hintText: (langUserPhone == 'fr')
                    ? 'Posez votre question...'
                    : 'Ask your question...',
                hintStyle: GoogleFonts.poppins(fontSize: 13, color: Colors.grey),
                filled: true,
                fillColor: isDark ? const Color(0xFF2A2A2A) : const Color(0xFFF0F2F5),
                border: OutlineInputBorder(
                  borderRadius: BorderRadius.circular(24),
                  borderSide: BorderSide.none,
                ),
                contentPadding: const EdgeInsets.symmetric(horizontal: 16, vertical: 10),
              ),
            ),
          ),
          const SizedBox(width: 8),
          GestureDetector(
            onTap: _sendMessage,
            child: Container(
              width: 44,
              height: 44,
              decoration: BoxDecoration(
                color: primaryColor,
                shape: BoxShape.circle,
              ),
              child: const Icon(Icons.send_rounded, color: Colors.white, size: 20),
            ),
          ),
        ],
      ),
    );
  }
}

class _ChatMsg {
  final String role;
  final String content;
  final bool isError;
  const _ChatMsg({required this.role, required this.content, this.isError = false});
}
