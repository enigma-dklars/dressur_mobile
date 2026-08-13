import 'dart:math' as math;

class PromotionCropOffset {
  const PromotionCropOffset({
    required this.dx,
    required this.dy,
  });

  final double dx;
  final double dy;
}

class PromotionCropSourceRect {
  const PromotionCropSourceRect({
    required this.x,
    required this.y,
    required this.width,
    required this.height,
  });

  final int x;
  final int y;
  final int width;
  final int height;

  double get aspectRatio => width / height;
}

class PromotionCropGeometry {
  const PromotionCropGeometry._();

  static double baseScale({
    required int imageWidth,
    required int imageHeight,
    required double frameWidth,
    required double frameHeight,
  }) {
    _validateImageSize(imageWidth, imageHeight);
    _validateFrameSize(frameWidth, frameHeight);

    return math
        .max(
          frameWidth / imageWidth,
          frameHeight / imageHeight,
        )
        .toDouble();
  }

  static PromotionCropOffset clampOffset({
    required int imageWidth,
    required int imageHeight,
    required double frameWidth,
    required double frameHeight,
    required double baseScale,
    required double zoom,
    required double offsetX,
    required double offsetY,
  }) {
    _validateImageSize(imageWidth, imageHeight);
    _validateFrameSize(frameWidth, frameHeight);
    _validateScale(baseScale, zoom);

    final renderedWidth = imageWidth * baseScale * zoom;
    final renderedHeight = imageHeight * baseScale * zoom;
    final maxX = math.max(0.0, (renderedWidth - frameWidth) / 2);
    final maxY = math.max(0.0, (renderedHeight - frameHeight) / 2);

    return PromotionCropOffset(
      dx: offsetX.clamp(-maxX, maxX).toDouble(),
      dy: offsetY.clamp(-maxY, maxY).toDouble(),
    );
  }

  static PromotionCropOffset zoomCompensation({
    required double focalX,
    required double focalY,
    required double frameWidth,
    required double frameHeight,
    required double previousZoom,
    required double nextZoom,
  }) {
    _validateFrameSize(frameWidth, frameHeight);
    _validateScale(previousZoom, nextZoom);

    final zoomRatio = nextZoom / previousZoom;
    final frameCenterX = frameWidth / 2;
    final frameCenterY = frameHeight / 2;

    return PromotionCropOffset(
      dx: (focalX - frameCenterX) * (1 - zoomRatio),
      dy: (focalY - frameCenterY) * (1 - zoomRatio),
    );
  }

  static PromotionCropSourceRect sourceRect({
    required int imageWidth,
    required int imageHeight,
    required double frameWidth,
    required double frameHeight,
    required double baseScale,
    required double zoom,
    required double offsetX,
    required double offsetY,
    required int aspectWidth,
    required int aspectHeight,
  }) {
    _validateImageSize(imageWidth, imageHeight);
    _validateFrameSize(frameWidth, frameHeight);
    _validateScale(baseScale, zoom);
    if (aspectWidth <= 0 || aspectHeight <= 0) {
      throw ArgumentError('Aspect ratio dimensions must be positive.');
    }

    final displayScale = baseScale * zoom;
    final sourceWidth = frameWidth / displayScale;
    final sourceHeight = frameHeight / displayScale;
    final cropSize = _integerCropSize(
      sourceWidth: sourceWidth,
      sourceHeight: sourceHeight,
      imageWidth: imageWidth,
      imageHeight: imageHeight,
      aspectWidth: aspectWidth,
      aspectHeight: aspectHeight,
    );

    final sourceX = ((imageWidth - sourceWidth) / 2) - offsetX / displayScale;
    final sourceY = ((imageHeight - sourceHeight) / 2) - offsetY / displayScale;

    final cropX = sourceX.round().clamp(0, imageWidth - cropSize.width).toInt();
    final cropY =
        sourceY.round().clamp(0, imageHeight - cropSize.height).toInt();

    return PromotionCropSourceRect(
      x: cropX,
      y: cropY,
      width: cropSize.width,
      height: cropSize.height,
    );
  }

  static _CropSize _integerCropSize({
    required double sourceWidth,
    required double sourceHeight,
    required int imageWidth,
    required int imageHeight,
    required int aspectWidth,
    required int aspectHeight,
  }) {
    final multiplier = math
        .min(
          math.min(sourceWidth / aspectWidth, sourceHeight / aspectHeight),
          math.min(imageWidth / aspectWidth, imageHeight / aspectHeight),
        )
        .floor();

    if (multiplier >= 1) {
      return _CropSize(
        width: aspectWidth * multiplier,
        height: aspectHeight * multiplier,
      );
    }

    // This only applies to unusually small images or an extreme zoom where
    // one exact ratio unit cannot fit in the source image. Keep the crop
    // inside the image rather than creating an invalid copyCrop rectangle.
    final width = math.max(1, math.min(imageWidth, sourceWidth.floor()));
    final height = math.max(1, math.min(imageHeight, sourceHeight.floor()));
    return _CropSize(width: width, height: height);
  }

  static void _validateImageSize(int width, int height) {
    if (width <= 0 || height <= 0) {
      throw ArgumentError('Image dimensions must be positive.');
    }
  }

  static void _validateFrameSize(double width, double height) {
    if (!width.isFinite || !height.isFinite || width <= 0 || height <= 0) {
      throw ArgumentError('Frame dimensions must be finite and positive.');
    }
  }

  static void _validateScale(double baseScale, double zoom) {
    if (!baseScale.isFinite || !zoom.isFinite || baseScale <= 0 || zoom < 1) {
      throw ArgumentError('Scale must be finite and baseScale > 0, zoom >= 1.');
    }
  }
}

class _CropSize {
  const _CropSize({
    required this.width,
    required this.height,
  });

  final int width;
  final int height;
}
