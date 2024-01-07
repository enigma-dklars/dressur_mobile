import 'dart:developer';
import 'dart:io';

import 'package:dressur/components/constant.dart';
import 'package:dressur/components/noti.dart';
import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:qr_code_scanner/qr_code_scanner.dart';

class ScannerCodeQR extends StatelessWidget {
  const ScannerCodeQR({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return const QRViewExample();
  }
}

class QRViewExample extends StatefulWidget {
  const QRViewExample({Key? key}) : super(key: key);

  @override
  State<StatefulWidget> createState() => _QRViewExampleState();
}

class _QRViewExampleState extends State<QRViewExample> {
  Barcode? result;
  QRViewController? controller;
  final GlobalKey qrKey = GlobalKey(debugLabel: 'QR');

  // In order to get hot reload to work we need to pause the camera if the platform
  // is android, or resume the camera if the platform is iOS.
  @override
  void reassemble() {
    super.reassemble();
    if (Platform.isAndroid) {
      controller!.pauseCamera();
    }
    controller!.resumeCamera();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Column(
        children: <Widget>[
          Expanded(flex: 9, child: _buildQrView(context)),
          Expanded(
            flex: 1,
            child: FittedBox(
              fit: BoxFit.contain,
              child: Column(
                mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                children: <Widget>[
                  // if (result != null)
                  //   Text(
                  //       'Barcode Type: ${describeEnum(result!.format)}   Data: ${result!.code}')
                  // else
                  //   const Text('Scan a code'),
                  Row(
                    mainAxisAlignment: MainAxisAlignment.center,
                    crossAxisAlignment: CrossAxisAlignment.center,
                    children: <Widget>[
                      Container(
                          margin: const EdgeInsets.all(8),
                          child: ElevatedButton(
                            onPressed: () async {
                              await controller?.toggleFlash();
                              setState(() {});
                            },
                            child: FutureBuilder(
                              future: controller?.getFlashStatus(),
                              builder: (context, snapshot) {
                                if (snapshot.data == true) {
                                  return const Icon(
                                      Icons.flash_on); // Flash allumé
                                } else {
                                  return const Icon(
                                      Icons.flash_off); // Flash éteint
                                }
                              },
                            ),
                          )),
                    ],
                  ),
                ],
              ),
            ),
          )
        ],
      ),
    );
  }

  Widget _buildQrView(BuildContext context) {
    // For this example we check how width or tall the device is and change the scanArea and overlay accordingly.
    var scanArea = (MediaQuery.of(context).size.width < 400 ||
            MediaQuery.of(context).size.height < 400)
        ? 300.0
        : 600.0;
    // To ensure the Scanner view is properly sizes after rotation
    // we need to listen for Flutter SizeChanged notification and update controller
    return QRView(
      key: qrKey,
      onQRViewCreated: _onQRViewCreated,
      overlay: QrScannerOverlayShape(
        borderColor: primaryColor,
        borderRadius: 5,
        borderLength: 40,
        borderWidth: 5,
        cutOutSize: scanArea,
      ),
      onPermissionSet: (ctrl, p) => _onPermissionSet(context, ctrl, p),
    );
  }

  void _onQRViewCreated(QRViewController controller) {
    setState(() {
      this.controller = controller;
    });
    controller.scannedDataStream.listen((scanData) async {
      // Vous pouvez accéder aux données du code QR scanné ici
      print('QR Code Data: ${scanData.code}');

      // Vérifiez la provenance et récupérez l'ID utilisateur si nécessaire
      List<String> qrData = scanData.code!.split(',');
      if (qrData.length == 2 && qrData[0] == 'dressur') {
        String idUser = qrData[1];

        // Navigator.push(
        //   context,
        //   MaterialPageRoute(builder: (context) => UserDetailsPage(idUser)),
        // );

        setState(() {
          result = scanData;

          successNoti(
              (langUserPhone == "fr") ? "Code QR" : "QR Code", idUser, context);
        });
        await controller.pauseCamera();
      } else {
        warningNoti(
            (langUserPhone == "fr") ? "Code QR" : "QR Code",
            (langUserPhone == "fr") ? "Code QR Invalide" : "Invalid QR Code",
            context);
        await controller.pauseCamera();
      }

      // 'Barcode Type: ${describeEnum(result!.format)}   Data: ${result!.code}'
    });
  }

  void _onPermissionSet(BuildContext context, QRViewController ctrl, bool p) {
    log('${DateTime.now().toIso8601String()}_onPermissionSet $p');
    if (!p) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('no Permission')),
      );
    }
  }

  @override
  void dispose() {
    controller?.dispose();
    super.dispose();
  }
}
