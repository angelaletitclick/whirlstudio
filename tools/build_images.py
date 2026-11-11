"""Erzeugt WebP-Varianten aus den Original-Fotos.
Aufruf: python -I tools/build_images.py <quellordner> <zielordner>
"""
import sys, re
from pathlib import Path
from PIL import Image, ImageOps

src, dst = Path(sys.argv[1]), Path(sys.argv[2])
dst.mkdir(parents=True, exist_ok=True)
(dst / "thumbs").mkdir(exist_ok=True)
WIDTHS = [800, 1400, 2200]

def num(p):
    m = re.search(r"\((\d+)\)", p.name)
    return int(m.group(1)) if m else 0

for p in sorted(src.glob("*.jpg"), key=num):
    n = num(p)
    name = f"ws-{n:02d}"
    if (dst / f"{name}-2200.webp").exists():
        continue
    im = ImageOps.exif_transpose(Image.open(p)).convert("RGB")
    portrait = im.height > im.width
    for w in WIDTHS:
        # bei Hochformat Breite kleiner halten
        tw = int(w * 0.6) if portrait else w
        r = im.copy()
        r.thumbnail((tw, tw * 3))
        r.save(dst / f"{name}-{w}.webp", "WEBP", quality=80, method=6)
    t = im.copy(); t.thumbnail((360, 360))
    t.save(dst / "thumbs" / f"{name}.jpg", "JPEG", quality=75)
    print(name, im.width, im.height, "P" if portrait else "L", flush=True)
