import 'dart:io';
import 'dart:math' as math;
import 'dart:typed_data';

import 'package:dressur/2_promo/promotion_crop_geometry.dart';
import 'package:dressur/components/noti.dart';
import 'package:flutter/material.dart';
import 'package:image/image.dart' as img;
import 'package:path_provider/path_provider.dart';

class PromotionImageCropper extends StatefulWidget {
  const PromotionImageCropper({
    required this.imageFile,
    required this.isFrench,
  });

  final File imageFile;
  final bool isFrench;

  @override
  State<PromotionImageCropper> createState() => _PromotionImageCropperState();
}

class _PromotionImageCropperState extends State<PromotionImageCropper> {
  static const _ratios = <_PromotionCropRatio>[
    _PromotionCropRatio(label: '1:1', width: 1, height: 1),
    _PromotionCropRatio(label: '4:3', width: 4, height: 3),
    _PromotionCropRatio(label: '3:4', width: 3, height: 4),
  ];

  img.Image? _decodedImage;
  Uint8List? _imageBytes;
  _PromotionCropRatio _selectedRatio = _ratios.first;
  double _zoom = 1;
  Offset _offset = Offset.zero;
  double _gestureZoom = 1;
  Offset _gestureOffset = Offset.zero;
  Offset _gestureFocalPoint = Offset.zero;
  bool _isSaving = false;
  String? _errorMessage;

  @override
  void initState() {
    super.initState();
    _loadImage();
  }

  Future<void> _loadImage() async {
    try {
      final bytes = await widget.imageFile.readAsBytes();
      final decoded = img.decodeImage(bytes);
      if (decoded == null) {
        throw const FormatException('Unsupported image format');
      }
      final orientedImage = img.bakeOrientation(decoded);
      if (!mounted) return;
      setState(() {
        _imageBytes = Uint8List.fromList(img.encodePng(orientedImage));
        _decodedImage = orientedImage;
      });
    } catch (_) {
      if (!mounted) return;
      setState(() {
        _errorMessage = widget.isFrench
            ? "Cette image ne peut pas être recadrée."
            : "This image cannot be cropped.";
      });
    }
  }

  double _baseScale(Size frameSize) {
    final image = _decodedImage!;
    return PromotionCropGeometry.baseScale(
      imageWidth: image.width,
      imageHeight: image.height,
      frameWidth: frameSize.width,
      frameHeight: frameSize.height,
    );
  }

  Offset _clampOffset({
    required Offset offset,
    required Size frameSize,
    required double baseScale,
    required double zoom,
  }) {
    final image = _decodedImage!;
    final clamped = PromotionCropGeometry.clampOffset(
      imageWidth: image.width,
      imageHeight: image.height,
      frameWidth: frameSize.width,
      frameHeight: frameSize.height,
      baseScale: baseScale,
      zoom: zoom,
      offsetX: offset.dx,
      offsetY: offset.dy,
    );
    return Offset(clamped.dx, clamped.dy);
  }

  void _onScaleStart(ScaleStartDetails details) {
    _gestureZoom = _zoom;
    _gestureOffset = _offset;
    _gestureFocalPoint = details.localFocalPoint;
  }

  void _onScaleUpdate(
    ScaleUpdateDetails details,
    Size frameSize,
    double baseScale,
  ) {
    final nextZoom = (details.scale * _gestureZoom).clamp(1.0, 4.0).toDouble();
    final zoomOffset = PromotionCropGeometry.zoomCompensation(
      focalX: _gestureFocalPoint.dx,
      focalY: _gestureFocalPoint.dy,
      frameWidth: frameSize.width,
      frameHeight: frameSize.height,
      previousZoom: _gestureZoom,
      nextZoom: nextZoom,
    );
    final panOffset = details.localFocalPoint - _gestureFocalPoint;
    final nextOffset = _clampOffset(
      offset: _gestureOffset + Offset(zoomOffset.dx, zoomOffset.dy) + panOffset,
      frameSize: frameSize,
      baseScale: baseScale,
      zoom: nextZoom,
    );
    setState(() {
      _zoom = nextZoom;
      _offset = nextOffset;
    });
  }

  Future<void> _confirmCrop(Size frameSize, double baseScale) async {
    if (_decodedImage == null || _isSaving) return;
    setState(() => _isSaving = true);

    try {
      final image = _decodedImage!;
      final cropRect = PromotionCropGeometry.sourceRect(
        imageWidth: image.width,
        imageHeight: image.height,
        frameWidth: frameSize.width,
        frameHeight: frameSize.height,
        baseScale: baseScale,
        zoom: _zoom,
        offsetX: _offset.dx,
        offsetY: _offset.dy,
        aspectWidth: _selectedRatio.width,
        aspectHeight: _selectedRatio.height,
      );
      final cropped = img.copyCrop(
        image,
        x: cropRect.x,
        y: cropRect.y,
        width: cropRect.width,
        height: cropRect.height,
      );

      // PNG keeps the crop lossless. The existing upload pipeline remains
      // unchanged and no additional compression is introduced here.
      final encodedCrop = img.encodePng(cropped);
      final tempDirectory = await getTemporaryDirectory();
      final outputFile = File(
        '${tempDirectory.path}/promotion_crop_${DateTime.now().microsecondsSinceEpoch}.png',
      );
      await outputFile.writeAsBytes(encodedCrop, flush: true);

      if (!mounted) return;
      Navigator.of(context).pop(outputFile);
    } catch (_) {
      if (!mounted) return;
      setState(() => _isSaving = false);
      dangerNoti(
        widget.isFrench ? "Attention !!!" : "Warning !!!",
        widget.isFrench
            ? "Impossible de recadrer cette image."
            : "Unable to crop this image.",
        context,
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Dialog(
      insetPadding: const EdgeInsets.symmetric(horizontal: 16, vertical: 24),
      backgroundColor: const Color(0xff101114),
      child: ConstrainedBox(
        constraints: BoxConstraints(
          maxWidth: 620,
          maxHeight: MediaQuery.sizeOf(context).height * 0.9,
        ),
        child: SafeArea(
          child: Padding(
            padding: const EdgeInsets.fromLTRB(16, 16, 16, 12),
            child: _buildContent(context),
          ),
        ),
      ),
    );
  }

  Widget _buildContent(BuildContext context) {
    if (_errorMessage != null) {
      return Column(
        mainAxisSize: MainAxisSize.min,
        children: [
          Text(
            _errorMessage!,
            style: const TextStyle(color: Colors.white),
            textAlign: TextAlign.center,
          ),
          const SizedBox(height: 16),
          TextButton(
            onPressed: () => Navigator.of(context).pop(),
            child: Text(widget.isFrench ? "Fermer" : "Close"),
          ),
        ],
      );
    }

    if (_decodedImage == null || _imageBytes == null) {
      return const SizedBox(
        height: 260,
        child: Center(child: CircularProgressIndicator(color: Colors.white)),
      );
    }

    return LayoutBuilder(
      builder: (context, constraints) {
        final ratio = _selectedRatio.value;
        final availableWidth = constraints.maxWidth;
        final availableHeight = math.max(180.0, constraints.maxHeight - 190);
        final frameWidth = math
            .min(availableWidth, availableHeight * ratio)
            .toDouble();
        final frameSize = Size(frameWidth, frameWidth / ratio);
        final baseScale = _baseScale(frameSize);
        final image = _decodedImage!;
        final renderedWidth = (image.width * baseScale).toDouble();
        final renderedHeight = (image.height * baseScale).toDouble();

        return Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            Row(
              children: [
                Expanded(
                  child: Text(
                    widget.isFrench ? "Recadrer l'image" : "Crop image",
                    style: const TextStyle(
                      color: Colors.white,
                      fontSize: 18,
                      fontWeight: FontWeight.w700,
                    ),
                  ),
                ),
                IconButton(
                  tooltip: widget.isFrench ? "Annuler" : "Cancel",
                  onPressed: _isSaving
                      ? null
                      : () => Navigator.of(context).pop(),
                  icon: const Icon(Icons.close, color: Colors.white),
                ),
              ],
            ),
            const SizedBox(height: 8),
            SizedBox(
              width: frameSize.width,
              height: frameSize.height,
              child: ClipRect(
                child: GestureDetector(
                  behavior: HitTestBehavior.opaque,
                  onScaleStart: _onScaleStart,
                  onScaleUpdate: (details) =>
                      _onScaleUpdate(details, frameSize, baseScale),
                  child: Stack(
                    fit: StackFit.expand,
                    children: [
                      Container(color: Colors.black),
                      Center(
                        child: Transform.translate(
                          offset: _offset,
                          child: Transform.scale(
                            scale: _zoom,
                            child: SizedBox(
                              width: renderedWidth,
                              height: renderedHeight,
                              child: Image.memory(
                                _imageBytes!,
                                fit: BoxFit.cover,
                                filterQuality: FilterQuality.high,
                              ),
                            ),
                          ),
                        ),
                      ),
                      IgnorePointer(
                        child: CustomPaint(
                          painter: _PromotionCropOverlayPainter(),
                        ),
                      ),
                    ],
                  ),
                ),
              ),
            ),
            const SizedBox(height: 12),
            Text(
              widget.isFrench
                  ? "Déplacez l'image et pincez pour zoomer"
                  : "Move the image and pinch to zoom",
              style: TextStyle(color: Colors.white.withOpacity(0.72)),
              textAlign: TextAlign.center,
            ),
            const SizedBox(height: 10),
            Wrap(
              alignment: WrapAlignment.center,
              spacing: 8,
              children: _ratios.map((ratioOption) {
                final selected = ratioOption == _selectedRatio;
                return ChoiceChip(
                  label: Text(ratioOption.label),
                  selected: selected,
                  onSelected: _isSaving
                      ? null
                      : (_) => setState(() {
                          _selectedRatio = ratioOption;
                          _zoom = 1;
                          _offset = Offset.zero;
                        }),
                  selectedColor: Colors.white,
                  backgroundColor: Colors.white.withOpacity(0.12),
                  labelStyle: TextStyle(
                    color: selected ? Colors.black : Colors.white,
                    fontWeight: FontWeight.w700,
                  ),
                );
              }).toList(),
            ),
            const SizedBox(height: 14),
            Row(
              children: [
                Expanded(
                  child: OutlinedButton(
                    onPressed: _isSaving
                        ? null
                        : () => Navigator.of(context).pop(),
                    style: OutlinedButton.styleFrom(
                      foregroundColor: Colors.white,
                      side: BorderSide(color: Colors.white.withOpacity(0.5)),
                    ),
                    child: Text(widget.isFrench ? "Annuler" : "Cancel"),
                  ),
                ),
                const SizedBox(width: 10),
                Expanded(
                  child: ElevatedButton(
                    onPressed: _isSaving
                        ? null
                        : () => _confirmCrop(frameSize, baseScale),
                    style: ElevatedButton.styleFrom(
                      backgroundColor: Colors.white,
                      foregroundColor: Colors.black,
                    ),
                    child: _isSaving
                        ? const SizedBox(
                            height: 18,
                            width: 18,
                            child: CircularProgressIndicator(
                              strokeWidth: 2,
                              color: Colors.black,
                            ),
                          )
                        : Text(
                            widget.isFrench ? "Utiliser l'image" : "Use image",
                          ),
                  ),
                ),
              ],
            ),
          ],
        );
      },
    );
  }
}

class _PromotionCropRatio {
  const _PromotionCropRatio({
    required this.label,
    required this.width,
    required this.height,
  });

  final String label;
  final int width;
  final int height;

  double get value => width / height;
}

class _PromotionCropOverlayPainter extends CustomPainter {
  @override
  void paint(Canvas canvas, Size size) {
    final borderPaint = Paint()
      ..color = Colors.white
      ..style = PaintingStyle.stroke
      ..strokeWidth = 2;
    final gridPaint = Paint()
      ..color = Colors.white.withOpacity(0.5)
      ..style = PaintingStyle.stroke
      ..strokeWidth = 1;

    canvas.drawRect(
      Rect.fromLTWH(1, 1, size.width - 2, size.height - 2),
      borderPaint,
    );
    final thirdWidth = size.width / 3;
    final thirdHeight = size.height / 3;
    for (var index = 1; index < 3; index++) {
      canvas.drawLine(
        Offset(thirdWidth * index, 0),
        Offset(thirdWidth * index, size.height),
        gridPaint,
      );
      canvas.drawLine(
        Offset(0, thirdHeight * index),
        Offset(size.width, thirdHeight * index),
        gridPaint,
      );
    }
  }

  @override
  bool shouldRepaint(covariant CustomPainter oldDelegate) => false;
}
