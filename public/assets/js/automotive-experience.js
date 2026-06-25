/**
 * Automotive Experience — master scroll architecture
 * GSAP + ScrollTrigger + Lenis (smooth scroll)
 * Structure: init order = Lenis ↔ ST → section modules → global refresh
 */

(function () {
  'use strict';

  const root = document.getElementById('automotive-experience');
  if (!root || typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

  gsap.registerPlugin(ScrollTrigger);

  const prefersReduced =
    window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---------- Lenis: smooth scroll; drives ScrollTrigger on every frame ---------- */
  let lenis = null;
  if (!prefersReduced && typeof Lenis !== 'undefined') {
    lenis = new Lenis({
      duration: 1.15,
      easing: function (t) {
        return Math.min(1, 1.001 - Math.pow(2, -10 * t));
      },
      orientation: 'vertical',
      smoothWheel: true,
    });
    lenis.on('scroll', ScrollTrigger.update);
    gsap.ticker.add(function (time) {
      lenis.raf(time * 1000);
    });
    gsap.ticker.lagSmoothing(0);
  }

  /* ---------- Helpers: reusable part module pattern (add more with [data-aex-part] + data-ox/oy/oz) ---------- */
  function bindPartNodes(scope) {
    return gsap.utils.toArray(scope.querySelectorAll('[data-aex-part]'));
  }

  /* ===================== 1) Hero ===================== */
  function initHero() {
    const hero = document.getElementById('aex-hero');
    if (!hero) return;

    const bg = hero.querySelector('[data-aex-hero-bg]');
    const sil = hero.querySelector('[data-aex-silhouette]');
    const lines = gsap.utils.toArray(hero.querySelectorAll('[data-aex-line]'));
    const indicator = hero.querySelector('[data-aex-scroll-ind]');

    const tl = gsap.timeline({
      scrollTrigger: {
        trigger: hero,
        start: 'top top',
        end: 'bottom top',
        scrub: prefersReduced ? 0.2 : 1.2,
      },
    });

    if (bg) tl.to(bg, { yPercent: 28, scale: 1.06, ease: 'none' }, 0);
    if (sil) {
      tl.to(sil, { rotateY: 6, rotateX: -4, y: 40, ease: 'none' }, 0);
    }

    lines.forEach(function (line, i) {
      gsap.fromTo(
        line,
        { yPercent: 110, opacity: 0 },
        {
          yPercent: 0,
          opacity: 1,
          duration: prefersReduced ? 0.01 : 0.8,
          delay: i * 0.12,
          ease: 'power3.out',
          scrollTrigger: {
            trigger: hero,
            start: 'top 78%',
            toggleActions: 'play none none reverse',
          },
        }
      );
    });

    if (indicator && !prefersReduced) {
      gsap.to(indicator, {
        y: 6,
        repeat: -1,
        yoyo: true,
        duration: 1.4,
        ease: 'sine.inOut',
      });
    }
  }

  /* ===================== 2) Exterior — pinned scrub master timeline ===================== */
  function initExterior() {
    const wrap = document.getElementById('aex-exterior');
    if (!wrap) return;

    const stage = wrap.querySelector('[data-aex-stage]');
    const core = wrap.querySelector('[data-aex-vehicle-core]');
    const parts = bindPartNodes(wrap);
    const labels = gsap.utils.toArray(wrap.querySelectorAll('[data-aex-label]'));
    const svgLines = wrap.querySelectorAll('[data-aex-connect] path, [data-aex-connect] line');

    const pinTl = gsap.timeline({
      scrollTrigger: {
        trigger: wrap,
        start: 'top top',
        end: '+=450%',
        pin: true,
        scrub: prefersReduced ? 0.3 : 0.85,
        anticipatePin: 1,
        /* ~5 “chapters” while pinned — subtle step feel without fighting Lenis */
        snap: prefersReduced
          ? false
          : {
              snapTo: function (v) {
                return Math.round(v * 4) / 4;
              },
              duration: { min: 0.12, max: 0.28 },
              delay: 0.02,
              ease: 'power1.inOut',
            },
      },
    });

    /* Explode sequence: each label is a "stop" on the master timeline */
    const labelStops = [0, 0.22, 0.44, 0.66, 0.88];
    parts.forEach(function (el, i) {
      const ox = parseFloat(el.getAttribute('data-ox') || '0');
      const oy = parseFloat(el.getAttribute('data-oy') || '0');
      const oz = parseFloat(el.getAttribute('data-oz') || '0');
      const start = labelStops[i] || i * 0.2;
      pinTl.fromTo(
        el,
        { x: 0, y: 0, z: 0, rotateY: 0, scale: 1 },
        {
          x: ox,
          y: oy,
          z: oz,
          rotateY: 12,
          scale: 1.05,
          duration: 0.25,
          ease: 'power2.inOut',
        },
        start
      );
    });

    labels.forEach(function (lab, i) {
      const start = labelStops[i] || i * 0.2;
      pinTl.fromTo(
        lab,
        { autoAlpha: 0, x: 24 },
        { autoAlpha: 1, x: 0, duration: 0.12, ease: 'power2.out' },
        start + 0.02
      );
    });

    if (core) {
      pinTl.fromTo(core, { filter: 'brightness(1)' }, { filter: 'brightness(1.15)', duration: 0.4 }, 0);
    }

    svgLines.forEach(function (path, i) {
      var len = 200;
      try {
        if (typeof path.getTotalLength === 'function') len = path.getTotalLength();
        else if (path.tagName === 'line') {
          var x1 = parseFloat(path.getAttribute('x1') || 0);
          var y1 = parseFloat(path.getAttribute('y1') || 0);
          var x2 = parseFloat(path.getAttribute('x2') || 0);
          var y2 = parseFloat(path.getAttribute('y2') || 0);
          len = Math.hypot(x2 - x1, y2 - y1) || 200;
        }
      } catch (e) {
        len = 200;
      }
      path.style.strokeDasharray = String(len);
      path.style.strokeDashoffset = String(len);
      var at = labelStops[Math.min(i, labelStops.length - 1)] || 0.2 + i * 0.1;
      pinTl.to(path, { strokeDashoffset: 0, duration: 0.3, ease: 'power1.inOut' }, at);
    });
  }

  /* ===================== 3) Interior bridge + interior pin ===================== */
  function initInterior() {
    const bridge = document.getElementById('aex-interior-bridge');
    const section = document.getElementById('aex-interior');
    if (!bridge && !section) return;

    if (bridge) {
      const morphA = bridge.querySelector('[data-aex-morph-a]');
      const morphB = bridge.querySelector('[data-aex-morph-b]');
      gsap.timeline({
        scrollTrigger: {
          trigger: bridge,
          start: 'top 70%',
          end: 'bottom 30%',
          scrub: prefersReduced ? false : 1,
        },
      })
        .fromTo(morphA, { opacity: 1, scale: 1 }, { opacity: 0, scale: 1.05, ease: 'none' }, 0)
        .fromTo(morphB, { opacity: 0, scale: 0.98 }, { opacity: 1, scale: 1, ease: 'none' }, 0);
    }

    if (section) {
      const hotspots = gsap.utils.toArray(section.querySelectorAll('[data-aex-hotspot]'));
      const mod = gsap.utils.toArray(section.querySelectorAll('[data-aex-interior-mod]'));

      const stl = gsap.timeline({
        scrollTrigger: {
          trigger: section,
          start: 'top top',
          end: '+=320%',
          pin: true,
          scrub: prefersReduced ? false : 0.9,
        },
      });

      mod.forEach(function (m, i) {
        stl.fromTo(
          m,
          { y: 50, autoAlpha: 0, rotateX: 8 },
          { y: 0, autoAlpha: 1, rotateX: 0, duration: 0.2, ease: 'power2.out' },
          i * 0.22
        );
      });

      hotspots.forEach(function (hs, i) {
        stl.to(
          hs,
          { scale: 1.3, autoAlpha: 1, boxShadow: '0 0 0 2px rgba(62, 231, 199, 0.45)', duration: 0.1, ease: 'power2.inOut' },
          0.1 + i * 0.2
        );
      });
    }
  }

  /* ===================== 4) Horizontal story track ===================== */
  function initHorizontal() {
    const track = document.getElementById('aex-h-track');
    if (!track) return;
    const inner = track.querySelector('[data-aex-h-inner]');
    if (!inner) return;

    gsap.to(inner, {
      xPercent: -75,
      ease: 'none',
      scrollTrigger: {
        trigger: track,
        start: 'top top',
        end: '+=300%',
        pin: true,
        scrub: prefersReduced ? false : 0.7,
        anticipatePin: 1,
      },
    });
  }

  /* ===================== 5) Parallax depth strip ===================== */
  function initParallaxStrip() {
    const strip = document.getElementById('aex-parallax-strip');
    if (!strip) return;
    const layers = gsap.utils.toArray(strip.querySelectorAll('[data-aex-plax]'));
    layers.forEach(function (layer) {
      const d = parseFloat(layer.getAttribute('data-depth') || '20');
      gsap.to(layer, {
        y: d,
        ease: 'none',
        scrollTrigger: {
          trigger: strip,
          start: 'top bottom',
          end: 'bottom top',
          scrub: 1.2,
        },
      });
    });
  }

  /* ===================== 6) Product comparison (metal vs composite) ===================== */
  function initComparison() {
    const el = document.getElementById('aex-compare');
    if (!el) return;
    const cards = gsap.utils.toArray(el.querySelectorAll('[data-aex-compare-card]'));

    const tl = gsap.timeline({
      scrollTrigger: {
        trigger: el,
        start: 'top 80%',
        end: 'top 20%',
        scrub: prefersReduced ? false : 0.5,
      },
    });

    cards.forEach(function (c, i) {
      tl.fromTo(
        c,
        { y: 60, autoAlpha: 0, scale: 0.96 },
        { y: 0, autoAlpha: 1, scale: 1, duration: 0.35, ease: 'power2.out' },
        i * 0.2
      );
    });

    ScrollTrigger.create({
      trigger: el,
      start: 'top 60%',
      onEnter: function () {
        el.classList.add('aex-compare--active');
      },
      onLeaveBack: function () {
        el.classList.remove('aex-compare--active');
      },
    });
  }

  /* ===================== 7) Awards + counters ===================== */
  function initAwards() {
    const el = document.getElementById('aex-awards');
    if (!el) return;
    const cards = gsap.utils.toArray(el.querySelectorAll('[data-aex-award-card]'));
    const nums = gsap.utils.toArray(el.querySelectorAll('[data-aex-counter]'));

    gsap.from(cards, {
      y: 40,
      autoAlpha: 0,
      stagger: 0.1,
      duration: 0.6,
      ease: 'power2.out',
      scrollTrigger: { trigger: el, start: 'top 75%', toggleActions: 'play none none reverse' },
    });

    nums.forEach(function (node) {
      const target = parseInt(node.getAttribute('data-target') || '0', 10);
      const obj = { v: 0 };
      ScrollTrigger.create({
        trigger: node,
        start: 'top 88%',
        once: true,
        onEnter: function () {
          gsap.to(obj, {
            v: target,
            duration: 1.8,
            ease: 'power2.out',
            onUpdate: function () {
              node.textContent = Math.round(obj.v).toString();
            },
          });
        },
      });
    });
  }

  /* ===================== 8) Mask reveal section ===================== */
  function initMaskReveal() {
    const m = document.getElementById('aex-mask');
    if (!m) return;
    const cut = m.querySelector('[data-aex-mask-path]');
    if (!cut) return;

    gsap.fromTo(
      cut,
      { clipPath: 'inset(0 100% 0 0)' },
      {
        clipPath: 'inset(0 0% 0 0)',
        ease: 'none',
        scrollTrigger: { trigger: m, start: 'top 80%', end: 'bottom 40%', scrub: 1 },
      }
    );
  }

  /* Single boot — all ScrollTrigger instances; refresh on load/resize below */
  initHero();
  initExterior();
  initInterior();
  initHorizontal();
  initParallaxStrip();
  initComparison();
  initAwards();
  initMaskReveal();

  window.addEventListener(
    'load',
    function () {
      ScrollTrigger.refresh();
    },
    { once: true }
  );

  window.addEventListener('resize', function () {
    ScrollTrigger.refresh();
  });
})();
