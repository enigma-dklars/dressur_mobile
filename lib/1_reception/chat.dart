import 'package:dressur/5_autre/autre_profil.dart';
import 'package:dressur/components/constant.dart';
import 'package:dressur/components/noti.dart';
import 'package:dressur/components/sql_helper.dart';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:intl/intl.dart';
import 'dart:convert' as convert;
import 'package:http/http.dart' as http;

class ChatPage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return ChatScreen();
  }
}

class ChatScreen extends StatefulWidget {
  @override
  _ChatScreenState createState() => _ChatScreenState();
}

class _ChatScreenState extends State<ChatScreen> with WidgetsBindingObserver {
  final TextEditingController _messageController = TextEditingController();
  final List<Map<String, dynamic>> _messages = [];
  final ScrollController _scrollController = ScrollController();
  bool isFirstUnreadMessage = true;

  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addObserver(this);
    WidgetsBinding.instance.addPostFrameCallback((_) => _scrollToBottom());
    _loadMessages();
    _markAllMessagesAsRead();
  }

  Future<void> _markAllMessagesAsRead() async {
    await SQLHelper.markAllMessagesAsRead(uidUser, userChatInfo[0]);
  }

  @override
  void dispose() {
    WidgetsBinding.instance.removeObserver(this);
    _messageController.dispose();
    _scrollController.dispose();
    super.dispose();
  }

  @override
  void didChangeMetrics() {
    WidgetsBinding.instance.addPostFrameCallback((_) => _scrollToBottom());
  }

  Future<void> _loadMessages() async {
    final List<Map<String, dynamic>> messages =
        await SQLHelper.getAllMessages(uidUser, userChatInfo[0]);
    setState(() {
      _messages.addAll(messages);
    });
    _scrollToBottom();
  }

  Future<void> _sendMessage() async {
    if (_messageController.text.isNotEmpty) {
      DateTime now = DateTime.now();
      DateFormat formatter = DateFormat('dd/MM/yyyy HH:mm');

      var request = http.MultipartRequest(
          'POST', Uri.parse('$generalRouteForApi/addMessage'));
      request.fields.addAll({
        'langUserPhone': langUserPhone.toString(),
        'emetteur': uidUser,
        'recepteur': userChatInfo[0],
        'message': _messageController.text,
        'dateEnvoi': now.millisecondsSinceEpoch.toString()
      });

      http.StreamedResponse response = await request.send();

      if (response.statusCode == 200) {
        var data1 = await response.stream.bytesToString();
        var data = convert.jsonDecode(data1);
        if (data["error"] == false) {
          if ((await SQLHelper.getOneDiscussion(userChatInfo[0])).isEmpty) {
            SQLHelper.insert("discussion", {
              'uid': userChatInfo[0],
              'nom': userChatInfo[2],
              'date': now.millisecondsSinceEpoch,
            });
          }
          SQLHelper.updateDiscussionDate(
              userChatInfo[0], now.millisecondsSinceEpoch);
          SQLHelper.insert("message", {
            'emetteur': uidUser,
            'recepteur': userChatInfo[0],
            'message': _messageController.text,
            'dateEnvoi': formatter.format(now),
            'vue': "oui",
          });
          setState(() {
            _messages.insert(0, {
              'emetteur': uidUser,
              'message': _messageController.text,
              'dateEnvoi': formatter.format(now),
            });
            _messageController.clear();
          });
          _scrollToBottom();
        } else {
          dangerNoti(
              "Error",
              (langUserPhone == "fr")
                  ? "Erreur lors de l'envoi du message..."
                  : "An error happened while sending the message...",
              context);
        }
      }
    }
  }

  void _scrollToBottom() {
    _scrollController.animateTo(
      _scrollController.position.minScrollExtent,
      duration: const Duration(milliseconds: 300),
      curve: Curves.easeOut,
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        automaticallyImplyLeading: false,
        elevation: 0,
        backgroundColor: primaryColor,
        leading: IconButton(
          onPressed: () {
            Navigator.pop(context);
          },
          icon: const Icon(
            Icons.arrow_back_ios,
            color: Colors.white,
          ),
        ),
        title: Text(
          userChatInfo[2],
          style: GoogleFonts.poppins(
            color: Colors.white,
            fontWeight: FontWeight.w400,
            fontSize: 18,
          ),
        ),
        actions: [
          IconButton(
            icon: const Icon(Icons.info),
            color: Colors.white,
            onPressed: () {
              setState(() {
                addUserOnAutreProfilPage = "non";
              });
              Navigator.of(context).push(
                MaterialPageRoute(
                  builder: (context) => AutreProfilPage(),
                ),
              );
            },
          ),
        ],
      ),
      body: Column(
        children: [
          Expanded(
            child: ListView.builder(
              reverse: true,
              controller: _scrollController,
              padding: const EdgeInsets.all(8.0),
              itemCount: _messages.length,
              itemBuilder: (context, index) {
                final message = _messages[index];
                final isCurrentUser = message['emetteur'] == uidUser;
                var isUnread = message['vue'] == 'non';
                return Align(
                  alignment: isCurrentUser
                      ? Alignment.centerRight
                      : Alignment.centerLeft,
                  child: Column(
                    children: [
                      Container(
                        margin: const EdgeInsets.symmetric(vertical: 5.0),
                        padding: const EdgeInsets.all(10.0),
                        decoration: BoxDecoration(
                          color: isUnread
                              ? Colors.green[400]
                              : isCurrentUser
                                  ? Colors.indigoAccent[200]
                                  : Colors.grey[200],
                          borderRadius: BorderRadius.circular(10.0),
                        ),
                        constraints: BoxConstraints(
                          maxWidth: MediaQuery.of(context).size.width * 0.8,
                        ),
                        child: Text(
                          message['message'],
                          style: GoogleFonts.poppins(
                            fontSize: 16.0,
                            color: message['emetteur'] == uidUser
                                ? Colors.white
                                : Colors.black,
                          ),
                        ),
                      ),
                    ],
                  ),
                );
              },
            ),
          ),
          Padding(
            padding: const EdgeInsets.all(8.0),
            child: Row(
              crossAxisAlignment: CrossAxisAlignment.end,
              children: [
                Expanded(
                  child: TextField(
                    minLines: 1,
                    maxLines: 3,
                    controller: _messageController,
                    decoration: InputDecoration(
                      hintText: (langUserPhone == "fr")
                          ? "Tapez votre message..."
                          : "Type your message...",
                      border: OutlineInputBorder(
                        borderRadius: BorderRadius.circular(10.0),
                      ),
                    ),
                    onChanged: (value) {
                      WidgetsBinding.instance
                          .addPostFrameCallback((_) => _scrollToBottom());
                    },
                    onTap: () {
                      WidgetsBinding.instance
                          .addPostFrameCallback((_) => _scrollToBottom());
                    },
                  ),
                ),
                const SizedBox(width: 8.0),
                FloatingActionButton(
                  backgroundColor: primaryColor,
                  tooltip: (langUserPhone == "fr") ? "Envoyer" : "Send",
                  onPressed: _sendMessage,
                  child: const Icon(
                    Icons.send,
                    color: Colors.white,
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
