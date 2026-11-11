"""Erzeugt eine nahtlos kachelbare, transparente Marmor-Aderung als WebP.

Aufruf: python -I tools/build_marble.py public/img/marble.webp
Die Textur enthält nur die Adern (Alpha). Die Grundfarbe kommt aus dem CSS.
"""
import sys
import numpy as np
from PIL import Image

N = 1400
rng = np.random.default_rng(7)


def noise(power):
    """Periodisches 1/f-Rauschen über FFT, dadurch automatisch kachelbar."""
    f = np.fft.fftfreq(N)
    r = np.sqrt(f[:, None] ** 2 + f[None, :] ** 2)
    r[0, 0] = 1
    spec = (rng.normal(size=(N, N)) + 1j * rng.normal(size=(N, N))) / r ** power
    spec[0, 0] = 0
    n = np.real(np.fft.ifft2(spec))
    return (n - n.mean()) / n.std()


y, x = np.mgrid[0:N, 0:N] / N
turb = noise(2.6)
fine = noise(1.8)


def veins(k1, k2, amp, sharp, phase):
    v = np.sin(2 * np.pi * (k1 * x + k2 * y) + amp * turb + 0.12 * fine + phase)
    return (1 - np.abs(v)) ** sharp


# Ganzzahlige Frequenzen halten die Kachel nahtlos
a = 0.75 * veins(2, 1, 1.5, 34, 0.0)    # Hauptadern, diagonal
a += 0.22 * veins(2, 1, 1.5, 4, 0.0)    # weicher Schleier um die Hauptadern
a += 0.40 * veins(1, 2, 2.0, 50, 1.7)   # feine Nebenader
a += 0.18 * veins(3, 1, 2.4, 70, 0.6)   # Haarrisse
cloud = np.clip(noise(2.8) * 0.5 + 0.5, 0, 1)  # weiche Wolkigkeit
alpha = np.clip(a * 0.2 + cloud * 0.03, 0, 1)

rgba = np.zeros((N, N, 4), np.uint8)
rgba[..., 0], rgba[..., 1], rgba[..., 2] = 120, 110, 98  # warmes Graubraun
rgba[..., 3] = (alpha * 255).astype(np.uint8)
Image.fromarray(rgba, 'RGBA').save(sys.argv[1], 'WEBP', quality=80, method=6)
print('ok', sys.argv[1])
