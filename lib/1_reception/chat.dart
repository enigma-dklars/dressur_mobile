import 'package:dressur/5_autre/autre_profil.dart';
import 'package:dressur/components/constant.dart';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

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
  final List<String> _messages = [
    "Bonjour!",
    "Comment ça va?",
    "Ça va bien, merci!",
    "Que fais-tu?",
    "Vous cherchez des solutions informatiques innovantes? Vous êtes passionné par la technologie et le numérique? Ou peut-être êtes-vous à la recherche d'une opportunité pour développer vos compétences dans le domaine de l'informatique? Ne cherchez plus, BLUE LIFE TECH est là pour répondre à tous vos besoins!",
    "💼 Nos Services 💼\nConception de Sites Web 🌐\nDéveloppement d'Applications Mobiles 📱\nMaintenance Informatique 💻\nGénie Logiciel 🧠\nRéseaux Informatiques & Sécurité 🔒\nGraphisme & Communication 🎨\nÉlectricité & Énergie ⚡",
    "💼 Nos Services 💼\nConception de Sites Web 🌐\nDéveloppement d'Applications Mobiles 📱\nMaintenance Informatique 💻\nGénie Logiciel 🧠\nRéseaux Informatiques & Sécurité 🔒\nGraphisme & Communication 🎨\nÉlectricité & Énergie ⚡",
    "Vous cherchez des solutions informatiques innovantes? Vous êtes passionné par la technologie et le numérique? Ou peut-être êtes-vous à la recherche d'une opportunité pour développer vos compétences dans le domaine de l'informatique? Ne cherchez plus, BLUE LIFE TECH est là pour répondre à tous vos besoins!",
  ];
  final ScrollController _scrollController = ScrollController();

  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addObserver(this);
    WidgetsBinding.instance.addPostFrameCallback((_) => _scrollToBottom());
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

  void _sendMessage() {
    if (_messageController.text.isNotEmpty) {
      setState(() {
        _messages.add(_messageController.text);
        _messageController.clear();
      });
      _scrollToBottom();
    }
  }

  void _scrollToBottom() {
    _scrollController.animateTo(
      _scrollController.position.maxScrollExtent,
      duration: const Duration(milliseconds: 1),
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
            Icons.arrow_back,
            size: 30,
            color: Colors.white,
          ),
        ),
        title: Text(
          userChatInfo[2],
          style: GoogleFonts.poppins(
            fontWeight: FontWeight.w400,
            color: Colors.white,
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
              controller: _scrollController,
              padding: const EdgeInsets.all(8.0),
              itemCount: _messages.length,
              itemBuilder: (context, index) {
                return Align(
                  alignment: index % 2 == 0
                      ? Alignment.centerLeft
                      : Alignment.centerRight,
                  child: Container(
                    margin: const EdgeInsets.symmetric(vertical: 5.0),
                    padding: const EdgeInsets.all(10.0),
                    decoration: BoxDecoration(
                      color: index % 2 == 0
                          ? Colors.grey[200]
                          : Colors.indigoAccent[200],
                      borderRadius: BorderRadius.circular(10.0),
                    ),
                    constraints: BoxConstraints(
                      maxWidth: MediaQuery.of(context).size.width * 0.8,
                    ),
                    child: Text(
                      _messages[index],
                      style: GoogleFonts.poppins(
                        fontSize: 16.0,
                        color: index % 2 == 0 ? Colors.black : Colors.white,
                      ),
                    ),
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
