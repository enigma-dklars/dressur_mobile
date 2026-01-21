// import 'package:dressur/5_autre/scanner_code_qr.dart';
// import 'package:dressur/components/constant.dart';
// import 'package:flutter/material.dart';
// import 'package:google_fonts/google_fonts.dart';
// import 'package:pretty_qr_code/pretty_qr_code.dart';

// class CarteDeVisite extends StatelessWidget {
//   const CarteDeVisite({
//     super.key,
//   });

//   @override
//   Widget build(BuildContext context) {
//     return const PrettyQrHomePage();
//   }
// }

// class PrettyQrHomePage extends StatefulWidget {
//   const PrettyQrHomePage({
//     super.key,
//   });

//   @override
//   State<PrettyQrHomePage> createState() => _PrettyQrHomePageState();
// }

// class _PrettyQrHomePageState extends State<PrettyQrHomePage> {
//   @protected
//   late QrCode qrCode;

//   @protected
//   late QrImage qrImage;

//   @protected
//   late PrettyQrDecoration decoration;
//   bool _firstLoad = true;

//   @override
//   void initState() {
//     super.initState();
//   }

//   @override
//   Widget build(BuildContext context) {
//     if (_firstLoad) {
//       WidgetsBinding.instance.addPostFrameCallback((_) async {
//         String data = await shortenUrl("$dressurUrlPlaystore&appref=$uidUser");
//         QrCode qrCode = QrCode.fromData(
//           data: data,
//           errorCorrectLevel: QrErrorCorrectLevel.H,
//         );
//         qrImage = QrImage(qrCode);
//         const kDefaultPrettyQrDecorationImage = PrettyQrDecorationImage(
//           image: AssetImage('images/dressur_logo.png'),
//           position: PrettyQrDecorationImagePosition.embedded,
//         );
//         decoration = const PrettyQrDecoration(
//           shape: PrettyQrSmoothSymbol(
//             color: primaryColor,
//           ),
//           image: kDefaultPrettyQrDecorationImage,
//         );
//         setState(() {
//           _firstLoad = false;
//         });
//       });
//     }
//     return Scaffold(
//       appBar: AppBar(
//         elevation: 0,
//         backgroundColor: primaryColor,
//         leading: IconButton(
//           onPressed: () {
//             Navigator.pop(context);
//           },
//           icon: const Icon(
//             Icons.arrow_back_ios,
//             size: 30,
//             color: Colors.white,
//           ),
//         ),
//         title: Text(
//           (langUserPhone == "fr") ? "Carte de visite" : "Visit card",
//           style: GoogleFonts.poppins(
//             fontWeight: FontWeight.w400,
//             color: Colors.white,
//           ),
//         ),
//       ),
//       body: _firstLoad
//           ? const Center(
//               child: CircularProgressIndicator(),
//             )
//           : Align(
//               alignment: Alignment.topCenter,
//               child: SizedBox(
//                 width: MediaQuery.of(context).size.width * 0.80,
//                 child: ConstrainedBox(
//                   constraints: const BoxConstraints(
//                     maxWidth: 1024,
//                   ),
//                   child: LayoutBuilder(
//                     builder: (context, constraints) {
//                       final safePadding = MediaQuery.of(context).padding;
//                       return Column(
//                         mainAxisAlignment: MainAxisAlignment.center,
//                         crossAxisAlignment: CrossAxisAlignment.start,
//                         children: [
//                           Padding(
//                             padding: safePadding.copyWith(
//                               top: 0,
//                               bottom: 0,
//                             ),
//                             child: Container(
//                               decoration: BoxDecoration(
//                                 color: Colors.white,
//                                 borderRadius: BorderRadius.circular(12.0),
//                               ),
//                               child: _PrettyQrAnimatedView(
//                                 qrImage: qrImage,
//                                 decoration: decoration,
//                               ),
//                             ),
//                           ),
//                           const SizedBox(height: 10),
//                           Padding(
//                             padding: safePadding.copyWith(
//                               right: 10,
//                               left: 10,
//                             ),
//                             child: Text(
//                               (langUserPhone == "fr")
//                                   ? "Le code QR que vous avez généré est confidentiel. En le partageant avec une personne, elle pourra le scanner à l'aide de la caméra Dressur et vous ajoutera automatiquement à ses contacts."
//                                   : "The QR code you generated is confidential. By sharing it with someone, they will be able to scan it using the Dressur camera and will automatically add you to their contacts.",
//                               style: GoogleFonts.poppins(
//                                 fontSize: 12,
//                               ),
//                               textAlign: TextAlign.center,
//                             ),
//                           ),
//                           const SizedBox(height: 50),
//                           SizedBox(
//                             width: MediaQuery.of(context).size.width * 0.90,
//                             child: ElevatedButton(
//                               style: ElevatedButton.styleFrom(
//                                 backgroundColor: primaryColor,
//                                 shape: const StadiumBorder(),
//                                 padding: const EdgeInsets.symmetric(
//                                   vertical: 18,
//                                 ),
//                               ),
//                               child: Text(
//                                 (langUserPhone == "fr")
//                                     ? "Scanner un Code QR"
//                                     : "Scan a QR Code",
//                                 style: GoogleFonts.poppins(
//                                   fontSize: 18,
//                                   color: Colors.white,
//                                 ),
//                                 textAlign: TextAlign.center,
//                               ),
//                               onPressed: () {
//                                 Navigator.push(
//                                   context,
//                                   MaterialPageRoute(
//                                       builder: (context) =>
//                                           const ScannerCodeQR()),
//                                 );
//                               },
//                             ),
//                           ),
//                         ],
//                       );
//                     },
//                   ),
//                 ),
//               ),
//             ),
//     );
//   }
// }

// class _PrettyQrAnimatedView extends StatefulWidget {
//   @protected
//   final QrImage qrImage;

//   @protected
//   final PrettyQrDecoration decoration;

//   const _PrettyQrAnimatedView({
//     required this.qrImage,
//     required this.decoration,
//   });

//   @override
//   State<_PrettyQrAnimatedView> createState() => _PrettyQrAnimatedViewState();
// }

// class _PrettyQrAnimatedViewState extends State<_PrettyQrAnimatedView> {
//   @protected
//   late PrettyQrDecoration previosDecoration;

//   @override
//   void initState() {
//     super.initState();

//     previosDecoration = widget.decoration;
//   }

//   @override
//   void didUpdateWidget(
//     covariant _PrettyQrAnimatedView oldWidget,
//   ) {
//     super.didUpdateWidget(oldWidget);

//     if (widget.decoration != oldWidget.decoration) {
//       previosDecoration = oldWidget.decoration;
//     }
//   }

//   @override
//   Widget build(BuildContext context) {
//     return Padding(
//       padding: const EdgeInsets.all(16),
//       child: TweenAnimationBuilder<PrettyQrDecoration>(
//         tween: PrettyQrDecorationTween(
//           begin: previosDecoration,
//           end: widget.decoration,
//         ),
//         curve: Curves.ease,
//         duration: const Duration(
//           milliseconds: 240,
//         ),
//         builder: (context, decoration, child) {
//           return PrettyQrView(
//             qrImage: widget.qrImage,
//             decoration: decoration,
//           );
//         },
//       ),
//     );
//   }
// }
