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

  /* ---------- Sanftes Einblenden ---------- */
  if ('IntersectionObserver' in window && !matchMedia('(prefers-reduced-motion: reduce)').matches) {
    const els = $$('.shead, .card, .price, .step, .fact, .faq, .intro__text, .intro__media, .review, .usp, .pick, .features, .perk, .aud__media, .aud__text');
    els.forEach(el => el.setAttribute('data-reveal', ''));
    body.classList.add('js-reveal');
    const ro = new IntersectionObserver(entries => entries.forEach(en => {
      if (en.isIntersecting) { en.target.classList.add('is-in'); ro.unobserve(en.target); }
    }), { rootMargin: '0px 0px -8% 0px' });
    els.forEach(el => ro.observe(el));
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

  /* ---------- Mobile Buchungsleiste: erst nach dem Hero zeigen ---------- */
  const mbar = $('[data-mbar]');
  const hero = $('.hero');
  if (mbar) {
    if (hero && 'IntersectionObserver' in window) {
      new IntersectionObserver(([en]) => mbar.classList.toggle('is-on', !en.isIntersecting), { threshold: 0.15 }).observe(hero);
    } else {
      mbar.classList.add('is-on');
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
