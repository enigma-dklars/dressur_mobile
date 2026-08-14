#!/usr/bin/env python3
"""Regression checks for Google Play's photo/video picker policy.

This test suite intentionally uses only Python's standard library so it can run
before Flutter is installed or before an Android release build is available.
When a merged Android manifest exists, it is checked as well as the source
manifest.
"""

from __future__ import annotations

import re
import unittest
import xml.etree.ElementTree as ET
from pathlib import Path


ROOT = Path(__file__).resolve().parents[1]
ANDROID_MANIFEST = ROOT / "android/app/src/main/AndroidManifest.xml"
PUBSPEC = ROOT / "pubspec.yaml"
PUBSPEC_LOCK = ROOT / "pubspec.lock"

ANDROID_NS = "{http://schemas.android.com/apk/res/android}"
TOOLS_NS = "{http://schemas.android.com/tools}"
FORBIDDEN_MEDIA_PERMISSIONS = {
    "android.permission.READ_MEDIA_IMAGES",
    "android.permission.READ_MEDIA_VIDEO",
    "android.permission.READ_MEDIA_VISUAL_USER_SELECTED",
}
PICKER_FILES = (
    ROOT / "lib/2_promo/new_promo_affaire.dart",
    ROOT / "lib/2_promo/edit_promo_affaire_produit_service.dart",
    ROOT / "lib/1_reception/recompense_dashboard.dart",
    ROOT / "lib/1_reception/historique_recompense_complet.dart",
)


def permission_nodes(manifest: Path) -> list[ET.Element]:
    root = ET.parse(manifest).getroot()
    return root.findall("uses-permission")


def effective_permissions(manifest: Path) -> set[str | None]:
    return {
        node.get(ANDROID_NS + "name")
        for node in permission_nodes(manifest)
        if node.get(TOOLS_NS + "node") != "remove"
    }


def merged_manifest_candidates() -> list[Path]:
    intermediates = ROOT / "android/app/build/intermediates"
    if not intermediates.exists():
        return []
    return sorted(
        path
        for path in intermediates.rglob("AndroidManifest.xml")
        if "merged" in str(path).lower()
    )


class PlayPhotoPickerRegressionTests(unittest.TestCase):
    def test_source_manifest_does_not_declare_broad_media_permissions(self) -> None:
        effective = effective_permissions(ANDROID_MANIFEST)
        self.assertTrue(
            FORBIDDEN_MEDIA_PERMISSIONS.isdisjoint(effective),
            f"broad media permissions are declared: {effective & FORBIDDEN_MEDIA_PERMISSIONS}",
        )

    def test_source_manifest_blocks_transitive_media_permissions(self) -> None:
        nodes = {
            node.get(ANDROID_NS + "name"): node
            for node in permission_nodes(ANDROID_MANIFEST)
        }
        for permission in FORBIDDEN_MEDIA_PERMISSIONS:
            self.assertIn(permission, nodes)
            self.assertEqual(
                nodes[permission].get(TOOLS_NS + "node"),
                "remove",
                f"{permission} must be removed from transitive manifests",
            )

    def test_legacy_storage_access_is_limited_to_android_12(self) -> None:
        for node in permission_nodes(ANDROID_MANIFEST):
            if node.get(ANDROID_NS + "name") == (
                "android.permission.READ_EXTERNAL_STORAGE"
            ):
                self.assertEqual(node.get(ANDROID_NS + "maxSdkVersion"), "32")

    def test_merged_manifests_do_not_contain_forbidden_permissions(self) -> None:
        candidates = merged_manifest_candidates()
        if not candidates:
            self.skipTest("No Android merged manifest exists yet; run a release build.")
        for manifest in candidates:
            effective = effective_permissions(manifest)
            self.assertTrue(
                FORBIDDEN_MEDIA_PERMISSIONS.isdisjoint(effective),
                f"{manifest} contains {effective & FORBIDDEN_MEDIA_PERMISSIONS}",
            )

    def test_image_picker_dependency_is_photo_picker_capable(self) -> None:
        pubspec = PUBSPEC.read_text(encoding="utf-8")
        self.assertRegex(pubspec, r"(?m)^  image_picker: \^1\.2\.0$")

        lock = PUBSPEC_LOCK.read_text(encoding="utf-8")
        image_picker_block = re.search(
            r"(?ms)^  image_picker:\n.*?(?=^  [a-zA-Z0-9_]+:|\Z)",
            lock,
        )
        self.assertIsNotNone(image_picker_block)
        self.assertIn('version: "1.2.0"', image_picker_block.group(0))

    def test_android_build_number_is_newer_than_rejected_version(self) -> None:
        pubspec = PUBSPEC.read_text(encoding="utf-8")
        match = re.search(r"(?m)^version:\s+\d+\.\d+\.\d+\+(\d+)\s*$", pubspec)
        self.assertIsNotNone(match)
        self.assertGreaterEqual(int(match.group(1)), 39)

    def test_gallery_flows_use_system_picker_without_storage_permission(self) -> None:
        for source_file in PICKER_FILES:
            source = source_file.read_text(encoding="utf-8")
            self.assertIn("ImageSource.gallery", source_file.read_text(encoding="utf-8"))
            self.assertNotIn("runWithPermissionRecovery", source)
            self.assertNotRegex(
                source,
                r"permission:\s*Permission\.(?:photos|storage)",
            )

    def test_application_has_no_gallery_permission_request_arguments(self) -> None:
        forbidden_request = re.compile(
            r"permission:\s*Permission\.(?:photos|storage)"
        )
        for source_file in (ROOT / "lib").rglob("*.dart"):
            source = source_file.read_text(encoding="utf-8")
            self.assertIsNone(
                forbidden_request.search(source),
                f"gallery permission request remains in {source_file.relative_to(ROOT)}",
            )


if __name__ == "__main__":
    unittest.main(verbosity=2)