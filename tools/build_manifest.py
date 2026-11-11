"""Schreibt public/inc/images.php: Bildname -> Liste [breite, hoehe, datei] (dedupliziert)."""
import sys, re
from pathlib import Path
from PIL import Image
d = Path(sys.argv[1]); out = Path(sys.argv[2])
m = {}
for f in sorted(d.glob('*.webp')):
    name = re.sub(r'-\d+$', '', f.stem)
    w, h = Image.open(f).size
    m.setdefault(name, {})[w] = (w, h, f.name)
lines = ["<?php // automatisch erzeugt von tools/build_manifest.py", "return ["]
for k, v in m.items():
    items = ", ".join(f"[{w},{h},'{fn}']" for w, h, fn in sorted(v.values()))
    lines.append(f"  '{k}' => [{items}],")
lines.append("];")
out.write_text("\n".join(lines) + "\n", encoding="utf-8")
print(len(m), "Bilder")
