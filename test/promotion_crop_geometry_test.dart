import 'package:dressur/2_promo/promotion_crop_geometry.dart';
import 'package:flutter_test/flutter_test.dart';

class _ImageCase {
  const _ImageCase({
    required this.label,
    required this.width,
    required this.height,
  });

  final String label;
  final int width;
  final int height;
}

class _CropRatioCase {
  const _CropRatioCase({
    required this.label,
    required this.width,
    required this.height,
  });

  final String label;
  final int width;
  final int height;

  double get value => width / height;
}

const _images = <_ImageCase>[
  _ImageCase(label: 'landscape', width: 1600, height: 900),
  _ImageCase(label: 'portrait', width: 900, height: 1600),
  _ImageCase(label: 'square', width: 1200, height: 1200),
];

const _ratios = <_CropRatioCase>[
  _CropRatioCase(label: '1:1', width: 1, height: 1),
  _CropRatioCase(label: '4:3', width: 4, height: 3),
  _CropRatioCase(label: '3:4', width: 3, height: 4),
];

void main() {
  for (final image in _images) {
    for (final ratio in _ratios) {
      test(
        '${image.label} image keeps ${ratio.label} crop geometry',
        () {
          const frameWidth = 400.0;
          final frameHeight = frameWidth / ratio.value;
          final baseScale = PromotionCropGeometry.baseScale(
            imageWidth: image.width,
            imageHeight: image.height,
            frameWidth: frameWidth,
            frameHeight: frameHeight,
          );

          final renderedWidth = image.width * baseScale;
          final renderedHeight = image.height * baseScale;
          expect(renderedWidth, greaterThanOrEqualTo(frameWidth));
          expect(renderedHeight, greaterThanOrEqualTo(frameHeight));

          final rect = PromotionCropGeometry.sourceRect(
            imageWidth: image.width,
            imageHeight: image.height,
            frameWidth: frameWidth,
            frameHeight: frameHeight,
            baseScale: baseScale,
            zoom: 1,
            offsetX: 0,
            offsetY: 0,
            aspectWidth: ratio.width,
            aspectHeight: ratio.height,
          );

          expect(rect.width * ratio.height, rect.height * ratio.width);
          expect(rect.x, inInclusiveRange(0, image.width - rect.width));
          expect(rect.y, inInclusiveRange(0, image.height - rect.height));
          expect(rect.width, greaterThan(0));
          expect(rect.height, greaterThan(0));
        },
      );
    }
  }

  test('horizontal and vertical movement stays inside the rendered image', () {
    const imageWidth = 1600;
    const imageHeight = 900;
    const frameWidth = 400.0;
    const frameHeight = 300.0;
    final baseScale = PromotionCropGeometry.baseScale(
      imageWidth: imageWidth,
      imageHeight: imageHeight,
      frameWidth: frameWidth,
      frameHeight: frameHeight,
    );
    const zoom = 2.5;
    final maxX = (imageWidth * baseScale * zoom - frameWidth) / 2;
    final maxY = (imageHeight * baseScale * zoom - frameHeight) / 2;

    final clamped = PromotionCropGeometry.clampOffset(
      imageWidth: imageWidth,
      imageHeight: imageHeight,
      frameWidth: frameWidth,
      frameHeight: frameHeight,
      baseScale: baseScale,
      zoom: zoom,
      offsetX: double.maxFinite,
      offsetY: -double.maxFinite,
    );

    expect(clamped.dx, closeTo(maxX, 0.000001));
    expect(clamped.dy, closeTo(-maxY, 0.000001));
  });

  test('zoom compensation scales the focal point from the previous zoom', () {
    final compensation = PromotionCropGeometry.zoomCompensation(
      focalX: 300,
      focalY: 150,
      frameWidth: 400,
      frameHeight: 300,
      previousZoom: 2,
      nextZoom: 3,
    );

    expect(compensation.dx, closeTo(-50, 0.000001));
    expect(compensation.dy, closeTo(0, 0.000001));
  });

  test('zoomed crop remains inside the source image at every supported ratio',
      () {
    const imageWidth = 1600;
    const imageHeight = 900;
    const frameWidth = 400.0;

    for (final ratio in _ratios) {
      final frameHeight = frameWidth / ratio.value;
      final baseScale = PromotionCropGeometry.baseScale(
        imageWidth: imageWidth,
        imageHeight: imageHeight,
        frameWidth: frameWidth,
        frameHeight: frameHeight,
      );
      final renderedWidth = imageWidth * baseScale * 4;
      final renderedHeight = imageHeight * baseScale * 4;
      final maxX = (renderedWidth - frameWidth) / 2;
      final maxY = (renderedHeight - frameHeight) / 2;
      final rect = PromotionCropGeometry.sourceRect(
        imageWidth: imageWidth,
        imageHeight: imageHeight,
        frameWidth: frameWidth,
        frameHeight: frameHeight,
        baseScale: baseScale,
        zoom: 4,
        offsetX: maxX,
        offsetY: maxY,
        aspectWidth: ratio.width,
        aspectHeight: ratio.height,
      );

      expect(rect.width * ratio.height, rect.height * ratio.width);
      expect(rect.x, inInclusiveRange(0, imageWidth - rect.width));
      expect(rect.y, inInclusiveRange(0, imageHeight - rect.height));
    }
  });
}
