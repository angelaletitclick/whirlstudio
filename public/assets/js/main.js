/* WhirlStudio – Menü, Slider, Lightbox, Consent, Meta Pixel, Smoobu */
(() => {
  'use strict';
  const $ = (s, r = document) => r.querySelector(s);
  const $$ = (s, r = document) => [...r.querySelectorAll(s)];
  const body = document.body;

  /* ---------- Header: transparent über Hero, fest beim Scrollen ---------- */
  const header = $('[data-header]');
  const onScroll = () => header && header.classList.toggle('is-scrolled', window.scrollY > 40);
  onScroll();
  window.addEventListener('scroll', onScroll, { passive: true });

  const moveOk = !matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---------- Flippiges Einblenden (Nutzer 18.11.2026) ----------
     Elemente federn gekippt herein; Geschwister kommen nacheinander (--d). Nach dem Einblenden wird
     data-reveal entfernt, damit die Hover-Effekte wieder ihre eigenen, schnellen Übergänge haben. */
  if ('IntersectionObserver' in window && moveOk) {
    const els = $$('.shead, .card, .price, .step, .fact, .faq, .intro__text, .intro__media, .review, .usp, .pick, .features, .perk, .aud__media, .aud__text');
    els.forEach(el => {
      el.setAttribute('data-reveal', '');
      const sibs = [...el.parentElement.children].filter(c => els.includes(c));
      const i = sibs.indexOf(el);
      if (i > 0) el.style.setProperty('--d', Math.min(i, 6) * 0.11 + 's');
    });
    body.classList.add('js-reveal');
    const done = el => { el.removeAttribute('data-reveal'); el.style.removeProperty('--d'); };
    const ro = new IntersectionObserver(entries => entries.forEach(en => {
      if (!en.isIntersecting) return;
      const el = en.target;
      el.classList.add('is-in');
      ro.unobserve(el);
      const delay = parseFloat(el.style.getPropertyValue('--d')) || 0;
      setTimeout(() => done(el), (delay + 1) * 1000);
    }), { rootMargin: '0px 0px -8% 0px' });
    els.forEach(el => ro.observe(el));
  }

  /* ---------- Hero-Überschrift: Wörter (bei nur einem Wort: Buchstaben) einzeln einhüpfen lassen ----------
     Hervorgehobene Wörter (<mark class="hl">) bleiben als Ganzes zusammen. */
  const heroTitle = $('.hero .h1');
  if (heroTitle && moveOk) {
    const text = heroTitle.textContent.trim();
    const units = [];
    [...heroTitle.childNodes].forEach(n => {
      if (n.nodeType === 3) n.textContent.split(/\s+/).filter(Boolean).forEach(w => units.push(w));
      else units.push(n.cloneNode(true));
    });
    const single = units.length === 1 && typeof units[0] === 'string';
    const parts = single ? [...units[0]] : units;
    heroTitle.setAttribute('aria-label', text);
    heroTitle.textContent = '';
    parts.forEach((p, i) => {
      const s = document.createElement('span');
      s.className = 'w';
      s.setAttribute('aria-hidden', 'true');
      s.style.setProperty('--i', i);
      if (typeof p === 'string') s.textContent = p; else s.appendChild(p);
      heroTitle.appendChild(s);
      if (!single && i < parts.length - 1) heroTitle.appendChild(document.createTextNode(' '));
    });
  }

  /* ---------- Mobiles Menü ---------- */
  const burger = $('[data-burger]');
  if (burger) {
    const close = () => { body.classList.remove('nav-open'); burger.setAttribute('aria-expanded', 'false'); };
    burger.addEventListener('click', () => {
      const open = body.classList.toggle('nav-open');
      burger.setAttribute('aria-expanded', String(open));
    });
    $$('#nav a').forEach(a => a.addEventListener('click', close));
    document.addEventListener('keydown', e => e.key === 'Escape' && close());
  }

  /* ---------- Hero-Überschrift und -Untertitel: höchstens zwei Zeilen (Untertitel: Nutzer 18.11.2026) ----------
     CSS gibt genug Breite für zwei Zeilen; wo das nicht reicht (Handy, schmale Spalte), wird die Schrift
     schrittweise verkleinert, bis der Text in zwei Zeilen passt. */
  const lines = el => {
    // Einzelne Wörter (.w) sind während der Animation verschoben/gedreht: dann die Layout-Position zählen
    const ws = el.querySelectorAll('.w');
    let tops;
    if (ws.length) tops = [...ws].map(w => w.offsetTop);
    else {
      const r = document.createRange();
      r.selectNodeContents(el);
      tops = [...r.getClientRects()].filter(b => b.width > 0).map(b => b.top);
    }
    // Zeilen bündeln: Kästchen, die weniger als eine halbe Zeilenhöhe auseinander liegen, gehören zur selben Zeile
    const tol = parseFloat(getComputedStyle(el).fontSize) * 0.5;
    const rows = [];
    tops.sort((a, b) => a - b).forEach(t => { if (!rows.length || t - rows[rows.length - 1] > tol) rows.push(t); });
    return rows.length;
  };
  const fitTwo = [[$('.hero .h1'), 0.5], [$('.hero .hero__lead'), 0.8]].filter(([el]) => el);
  if (fitTwo.length) {
    const fit = () => fitTwo.forEach(([el, minFactor]) => {
      el.style.fontSize = '';
      let fs = parseFloat(getComputedStyle(el).fontSize);
      const min = fs * minFactor;
      while (lines(el) > 2 && fs > min) {
        fs *= 0.95;
        el.style.fontSize = fs + 'px';
      }
    });
    fit();
    if (document.fonts && document.fonts.ready) document.fonts.ready.then(fit);
    let t;
    window.addEventListener('resize', () => { clearTimeout(t); t = setTimeout(fit, 120); });
  }

  /* ---------- Mobile Buchungsleiste: erst nach dem Hero zeigen ---------- */
  const mbar = $('[data-mbar]');
  const hero = $('.hero');
  if (mbar) {
    if (hero && 'IntersectionObserver' in window) {
      new IntersectionObserver(([en]) => mbar.classList.toggle('is-on', !en.isIntersecting), { threshold: 0.15 }).observe(hero);
    } else {
      mbar.classList.add('is-on');
    }
    // Solange der Kalender sichtbar ist, verdeckt die Leiste sonst dessen Buttons
    const cal = $('#kalender');
    if (cal && 'IntersectionObserver' in window) {
      new IntersectionObserver(([en]) => mbar.classList.toggle('is-off', en.isIntersecting)).observe(cal);
    }
  }

  /* ---------- Lightbox ---------- */
  const lb = $('[data-lightbox]');
  if (lb) {
    const lbImg = $('[data-lb-img]', lb);
    const lbCap = $('[data-lb-cap]', lb);
    let list = [], idx = 0, lastFocus = null;
    const show = i => {
      idx = (i + list.length) % list.length;
      lbImg.src = list[idx].href;
      lbImg.alt = $('img', list[idx])?.alt || '';
      if (lbCap) lbCap.textContent = list[idx].dataset.caption || '';
    };
    const open = (links, i) => { list = links; lastFocus = document.activeElement; show(i); lb.hidden = false; body.classList.add('lb-open'); $('[data-lb-close]', lb).focus(); };
    const close = () => { lb.hidden = true; body.classList.remove('lb-open'); lastFocus && lastFocus.focus(); };
    $$('[data-gallery]').forEach(g => {
      const links = $$('[data-lb]', g);
      links.forEach((a, i) => a.addEventListener('click', e => { e.preventDefault(); open(links, i); }));
    });
    $('[data-lb-close]', lb).addEventListener('click', close);
    $('[data-lb-prev]', lb).addEventListener('click', () => show(idx - 1));
    $('[data-lb-next]', lb).addEventListener('click', () => show(idx + 1));
    lb.addEventListener('click', e => e.target === lb && close());
    document.addEventListener('keydown', e => {
      if (lb.hidden) return;
      if (e.key === 'Escape') close();
      if (e.key === 'ArrowLeft') show(idx - 1);
      if (e.key === 'ArrowRight') show(idx + 1);
    });
  }

  /* ---------- Galerie-Varianten (Test, inc/parts/gallery-alt.php) ---------- */
  // A: Filmstreifen – Pfeile scrollen um ca. eine Bildschirmbreite
  $$('[data-strip]').forEach(g => {
    const t = $('[data-strip-track]', g);
    const by = d => t.scrollBy({ left: d * t.clientWidth * .8, behavior: 'smooth' });
    $('[data-strip-prev]', g)?.addEventListener('click', () => by(-1));
    $('[data-strip-next]', g)?.addEventListener('click', () => by(1));
  });
  // C: „Alle Bilder ansehen“ öffnet die Lightbox beim ersten Bild
  $$('[data-lb-all]').forEach(b => b.addEventListener('click', () => $('[data-lb]', b.closest('[data-gallery]'))?.click()));
  // D: Bühne – Vorschaubild tauscht das große Bild, Klick aufs große Bild öffnet die Lightbox
  $$('[data-stage]').forEach(g => {
    const main = $('[data-stage-main]', g), img = $('img', main), cap = $('[data-stage-cap]', g);
    const thumbs = $$('[data-stage-thumb]', g), links = $$('[data-lb]', g);
    let cur = 0;
    thumbs.forEach(th => th.addEventListener('click', () => {
      cur = +th.dataset.stageThumb;
      img.removeAttribute('srcset');
      img.src = th.dataset.src; img.alt = th.dataset.alt; main.href = th.dataset.big;
      if (cap) cap.textContent = th.dataset.room;
      thumbs.forEach(x => x.classList.toggle('on', x === th));
    }));
    main.addEventListener('click', e => { e.preventDefault(); links[cur]?.click(); });
  });

  /* ---------- Bilder-Slider (Scroll-Snap + Pfeile) ---------- */
  $$('[data-slider]').forEach(sl => {
    const track = $('[data-slider-track]', sl);
    const slides = track ? $$('.slide', track) : [];
    const cur = $('[data-slider-cur]', sl);
    if (!slides.length) return;
    const index = () => Math.round(track.scrollLeft / track.clientWidth);
    const go = i => {
      const n = (i + slides.length) % slides.length;
      track.scrollTo({ left: n * track.clientWidth, behavior: matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth' });
    };
    $('[data-slider-prev]', sl)?.addEventListener('click', () => go(index() - 1));
    $('[data-slider-next]', sl)?.addEventListener('click', () => go(index() + 1));
    track.addEventListener('keydown', e => {
      if (e.key === 'ArrowLeft') { e.preventDefault(); go(index() - 1); }
      if (e.key === 'ArrowRight') { e.preventDefault(); go(index() + 1); }
    });
    let raf = 0;
    track.addEventListener('scroll', () => {
      cancelAnimationFrame(raf);
      raf = requestAnimationFrame(() => { if (cur) cur.textContent = String(Math.min(slides.length, index() + 1)); });
    }, { passive: true });
  });

  /* ---------- Consent ---------- */
  const KEY = 'ws_consent'; // "1" = Marketing erlaubt, "0" = nur notwendige
  const store = {
    get() { try { return localStorage.getItem(KEY); } catch { return null; } },
    set(v) { try { localStorage.setItem(KEY, v); } catch { /* privat */ } },
  };
  const banner = $('[data-consent]');
  const pixelId = body.dataset.pixel || '';
  let pixelOn = false;

  const loadPixel = () => {
    if (pixelOn || !pixelId) return;
    pixelOn = true;
    /* Offizielles Meta-Pixel-Snippet */
    !function (f, b, e, v, n, t, s) {
      if (f.fbq) return; n = f.fbq = function () { n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments); };
      if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0'; n.queue = [];
      t = b.createElement(e); t.async = !0; t.src = v; s = b.getElementsByTagName(e)[0]; s.parentNode.insertBefore(t, s);
    }(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
    window.fbq('init', pixelId);
    window.fbq('track', 'PageView');
    if (body.dataset.view) window.fbq('track', 'ViewContent', { content_name: body.dataset.view });
    saveUtm();
  };

  /* UTM/fbclid erst nach Einwilligung speichern (erste Quelle gewinnt) */
  const saveUtm = () => {
    try {
      const p = new URLSearchParams(location.search);
      const keys = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term', 'fbclid', 'anlass'];
      const found = Object.fromEntries(keys.filter(k => p.get(k)).map(k => [k, p.get(k)]));
      if (Object.keys(found).length && !localStorage.getItem('ws_src')) {
        localStorage.setItem('ws_src', JSON.stringify({ ...found, ts: Date.now(), page: location.pathname }));
      }
    } catch { /* ignore */ }
  };

  const setConsent = v => {
    store.set(v);
    banner.hidden = true;
    if (v === '1') loadPixel();
  };
  if (banner) {
    const c = store.get();
    if (c === '1') loadPixel();
    else if (c === null) banner.hidden = false;
    $$('[data-consent-set]', banner).forEach(b => b.addEventListener('click', () => setConsent(b.dataset.consentSet)));
    $$('[data-consent-open]').forEach(b => b.addEventListener('click', () => { banner.hidden = false; $('[data-consent-set]', banner).focus(); }));
  }

  /* ---------- Events ---------- */
  const track = (event, label) => {
    const params = { content_name: label, page: location.pathname };
    if (pixelOn && window.fbq) window.fbq('track', event, params);
    if (location.hostname === 'localhost' || body.classList.contains('debug')) console.info('[track]', event, params);
  };
  window.wsTrack = track;
  document.addEventListener('click', e => {
    const el = e.target.closest('[data-track]');
    if (el) track(el.dataset.track, el.dataset.label || el.textContent.trim());
  });

  /* ---------- Smoobu: lazy laden, Fallback nach 8 s ---------- */
  let scriptPromise = null;
  const loadScript = src => scriptPromise || (scriptPromise = new Promise((ok, fail) => {
    const s = document.createElement('script');
    s.src = src; s.async = true; s.onload = ok; s.onerror = fail;
    document.head.appendChild(s);
  }));

  const initSmoobu = box => {
    if (box.dataset.started) return;
    box.dataset.started = '1';
    const { script, base, url, target } = box.dataset;
    const loading = $('[data-smoobu-loading]', box);
    const fallback = $('[data-smoobu-fallback]', box);
    const fail = () => { loading.hidden = true; fallback.hidden = false; };
    const timer = setTimeout(() => { if (!$('iframe', box)) fail(); }, 8000);
    loadScript(script).then(() => {
      if (!window.BookingToolIframe) return fail();
      window.BookingToolIframe.initialize({ url, baseUrl: base, target: '#' + target });
      const watch = new MutationObserver(() => {
        if ($('iframe', box)) { loading.hidden = true; clearTimeout(timer); watch.disconnect(); }
      });
      watch.observe(box, { childList: true, subtree: true });
    }).catch(() => { clearTimeout(timer); fail(); });
  };

  const boxes = $$('[data-smoobu]');
  if (boxes.length) {
    if ('IntersectionObserver' in window) {
      const io = new IntersectionObserver(entries => entries.forEach(en => {
        if (en.isIntersecting) { initSmoobu(en.target); io.unobserve(en.target); }
      }), { rootMargin: '600px 0px' });
      const seen = new IntersectionObserver(entries => entries.forEach(en => {
        if (en.isIntersecting) { track('InitiateCheckout', 'Kalender sichtbar'); seen.unobserve(en.target); }
      }), { threshold: 0.25 });
      boxes.forEach(b => { io.observe(b); seen.observe(b); });
    } else {
      boxes.forEach(initSmoobu);
    }
    if (location.hash === '#kalender') boxes.forEach(initSmoobu);
  }
})();
