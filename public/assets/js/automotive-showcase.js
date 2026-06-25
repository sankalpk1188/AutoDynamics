/**
 * Automotive Showcase — GSAP ScrollTrigger pinned scroll storytelling
 */
(function () {
    'use strict';

    var TRANSITION = 0.8;
    var STEP_VH = 100;

    function qs(sel, ctx) {
        return (ctx || document).querySelector(sel);
    }

    function qsa(sel, ctx) {
        return Array.prototype.slice.call((ctx || document).querySelectorAll(sel));
    }

    function clamp(n, min, max) {
        return Math.min(max, Math.max(min, n));
    }

    function prefersReducedMotion() {
        return window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    }

    function AutomotiveShowcase(root) {
        this.root = root;
        this.config = null;
        this.steps = [];
        this.categories = [];
        this.currentIndex = -1;
        this.isAnimating = false;
        this.scrollTrigger = null;
        this.hotspotTweens = [];
        this.reducedMotion = prefersReducedMotion();
        this.isMobile = window.matchMedia('(max-width: 991.98px)').matches;
    }

    AutomotiveShowcase.prototype.init = function () {
        var configEl = document.getElementById('as-showcase-config');
        var raw = configEl ? configEl.textContent : this.root.getAttribute('data-config');
        if (!raw) return;

        try {
            this.config = JSON.parse(raw);
        } catch (e) {
            console.error('AutomotiveShowcase: invalid config JSON', e);
            return;
        }

        this.steps = this.config.steps || [];
        this.categories = this.config.categories || [];

        if (!this.steps.length || typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
            return;
        }

        gsap.registerPlugin(ScrollTrigger);
        if (typeof ScrollToPlugin !== 'undefined') {
            gsap.registerPlugin(ScrollToPlugin);
        }

        this.cacheDom();
        this.loadSvgs().then(this.onSvgsReady.bind(this));
    };

    AutomotiveShowcase.prototype.cacheDom = function () {
        this.track = qs('[data-as-track]', this.root);
        this.pinned = qs('[data-as-pinned]', this.root);
        this.stage = qs('[data-as-stage]', this.root);
        this.splitVisual = qs('[data-as-split-visual]', this.root);
        this.svgHost = qs('[data-as-svg-host]', this.root);
        this.calloutSvg = qs('[data-as-callout-svg]', this.root);
        this.calloutLine = qs('[data-as-callout-line]', this.root);

        this.elCategory = qs('[data-as-category]', this.root);
        this.elName = qs('[data-as-name]', this.root);
        this.elPartNameBar = qs('[data-as-part-name-bar]', this.root);
        this.elVehicleBg = qs('[data-as-vehicle-bg]', this.root);
        this.vehicleImages = this.config.vehicleImages || {};
        this.elProgressFill = qs('[data-as-progress-fill]', this.root);
        this.elProgressCurrent = qs('[data-as-progress-current]', this.root);
        this.elProgressTotal = qs('[data-as-progress-total]', this.root);
        this.elStepCurrent = qs('[data-as-step-current]', this.root);
        this.elStepTotal = qs('[data-as-step-total]', this.root);

        this.btnPrev = qs('[data-as-prev]', this.root);
        this.btnNext = qs('[data-as-next]', this.root);
        this.categoryBtns = qsa('[data-as-cat]', this.root);
        this.mobileDotsHost = qs('[data-as-dots]', this.root);
        this.heroScrollHint = qs('[data-as-scroll-cta]', this.root);
        this.scrollIndicator = qs('[data-as-scroll-indicator]', this.root);

        if (this.elProgressTotal) this.elProgressTotal.textContent = String(this.steps.length);
        if (this.elStepTotal) this.elStepTotal.textContent = String(this.steps.length);

        this.buildMobileDots();
        this.bindNav();
        this.bindScrollHints();
    };

    AutomotiveShowcase.prototype.buildMobileDots = function () {
        if (!this.mobileDotsHost) return;
        var self = this;
        this.mobileDotsHost.innerHTML = '';
        this.steps.forEach(function (_, i) {
            var dot = document.createElement('button');
            dot.type = 'button';
            dot.className = 'as-mobile-dot' + (i === 0 ? ' is-active' : '');
            dot.setAttribute('aria-label', 'Go to step ' + (i + 1));
            dot.addEventListener('click', function () {
                self.scrollToStep(i);
            });
            self.mobileDotsHost.appendChild(dot);
        });
        this.mobileDots = qsa('.as-mobile-dot', this.mobileDotsHost);
    };

    AutomotiveShowcase.prototype.getStepsForCategory = function (category) {
        return this.steps.filter(function (s) { return s.category === category; });
    };

    AutomotiveShowcase.prototype.getStepIndexInCategory = function (globalIndex) {
        var step = this.steps[globalIndex];
        if (!step) return -1;
        var catSteps = this.getStepsForCategory(step.category);
        for (var i = 0; i < catSteps.length; i++) {
            if (catSteps[i].id === step.id) return i;
        }
        return -1;
    };

    AutomotiveShowcase.prototype.getGlobalIndexForCategoryStep = function (category, catIndex) {
        var catSteps = this.getStepsForCategory(category);
        var target = catSteps[catIndex];
        if (!target) return -1;
        return this.steps.findIndex(function (s) { return s.id === target.id; });
    };

    AutomotiveShowcase.prototype.bindNav = function () {
        var self = this;
        if (this.btnPrev) {
            this.btnPrev.addEventListener('click', function () {
                var step = self.steps[self.currentIndex];
                if (!step) return;
                var catIdx = self.getStepIndexInCategory(self.currentIndex);
                if (catIdx > 0) {
                    var prev = self.getGlobalIndexForCategoryStep(step.category, catIdx - 1);
                    if (prev >= 0) self.scrollToStep(prev);
                }
            });
        }
        if (this.btnNext) {
            this.btnNext.addEventListener('click', function () {
                var step = self.steps[self.currentIndex];
                if (!step) return;
                var catSteps = self.getStepsForCategory(step.category);
                var catIdx = self.getStepIndexInCategory(self.currentIndex);
                if (catIdx < catSteps.length - 1) {
                    var next = self.getGlobalIndexForCategoryStep(step.category, catIdx + 1);
                    if (next >= 0) self.scrollToStep(next);
                }
            });
        }
        this.categoryBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var cat = btn.getAttribute('data-as-cat');
                var idx = self.steps.findIndex(function (s) { return s.category === cat; });
                if (idx >= 0) self.scrollToStep(idx);
            });
        });
        this.setupSwipe();
    };

    AutomotiveShowcase.prototype.bindScrollHints = function () {
        var self = this;

        var scrollToShowcase = function () {
            if (self.scrollTrigger) {
                var y = self.scrollTrigger.start + 4;
                if (typeof ScrollToPlugin !== 'undefined') {
                    gsap.to(window, { scrollTo: { y: y }, duration: 0.85, ease: 'power2.inOut' });
                } else {
                    window.scrollTo({ top: y, behavior: 'smooth' });
                }
            } else if (self.track) {
                self.track.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        };

        if (this.heroScrollHint) {
            this.heroScrollHint.addEventListener('click', scrollToShowcase);
        }

        if (this.scrollIndicator) {
            this.scrollIndicator.addEventListener('click', function () {
                if (self.steps.length > 1) {
                    self.scrollToStep(Math.min(self.currentIndex + 1, self.steps.length - 1));
                } else {
                    scrollToShowcase();
                }
            });
        }
    };

    AutomotiveShowcase.prototype.updateScrollHints = function (index) {
        var hide = index > 0;
        if (this.scrollIndicator) {
            this.scrollIndicator.classList.toggle('is-hidden', hide);
        }
    };

    AutomotiveShowcase.prototype.setupSwipe = function () {
        var self = this;
        var startX = 0;
        var startY = 0;
        var panel = qs('[data-as-stage]', this.root) || qs('.as-content', this.root);
        if (!panel) return;

        panel.addEventListener('touchstart', function (e) {
            if (!self.isMobile) return;
            startX = e.changedTouches[0].screenX;
            startY = e.changedTouches[0].screenY;
        }, { passive: true });

        panel.addEventListener('touchend', function (e) {
            if (!self.isMobile) return;
            var dx = e.changedTouches[0].screenX - startX;
            var dy = e.changedTouches[0].screenY - startY;
            if (Math.abs(dx) < 50 || Math.abs(dy) > Math.abs(dx)) return;
            if (dx < 0) self.scrollToStep(self.currentIndex + 1);
            else self.scrollToStep(self.currentIndex - 1);
        }, { passive: true });
    };

    AutomotiveShowcase.prototype.loadSvgs = function () {
        var self = this;
        var views = (this.config && this.config.svgViews) ? this.config.svgViews : ['interior', 'exterior', 'underbody'];
        var prefix = (this.config && this.config.svgPrefix) ? this.config.svgPrefix : 'automotive';
        var base = this.root.getAttribute('data-svg-base') || '/assets/svg/';
        var assetVer = this.root.getAttribute('data-asset-version') || Date.now();
        var promises = views.map(function (view) {
            return fetch(base + prefix + '-' + view + '.svg?v=' + assetVer)
                .then(function (r) { return r.text(); })
                .then(function (svgText) {
                    var wrap = document.createElement('div');
                    wrap.className = 'as-svg-layer';
                    wrap.setAttribute('data-view', view);
                    wrap.innerHTML = svgText;
                    self.svgHost.appendChild(wrap);
                });
        });
        return Promise.all(promises);
    };

    AutomotiveShowcase.prototype.onSvgsReady = function () {
        this.svgLayers = qsa('.as-svg-layer', this.svgHost);
        this.prepareOutlinePaths();
        this.setTrackHeight();
        this.setupScrollTrigger();
        this.goToStep(0, false);
        window.addEventListener('resize', this.onResize.bind(this));
    };

    AutomotiveShowcase.prototype.prepareOutlinePaths = function () {
        var self = this;
        this.svgLayers.forEach(function (layer) {
            qsa('.as-outline', layer).forEach(function (path) {
                var len = path.getTotalLength ? path.getTotalLength() : 100;
                path.style.strokeDasharray = len;
                path.style.strokeDashoffset = len;
                path.dataset.pathLength = len;
            });
        });
    };

    AutomotiveShowcase.prototype.setTrackHeight = function () {
        var totalVh = this.steps.length * STEP_VH;
        this.track.style.height = totalVh + 'vh';
    };

    AutomotiveShowcase.prototype.setupScrollTrigger = function () {
        var self = this;
        var stepCount = this.steps.length;

        if (this.scrollTrigger) {
            this.scrollTrigger.kill();
        }

        this.scrollTrigger = ScrollTrigger.create({
            trigger: this.track,
            start: 'top top',
            end: 'bottom bottom',
            pin: this.pinned,
            pinSpacing: true,
            anticipatePin: 1,
            onUpdate: function (st) {
                var idx = clamp(Math.floor(st.progress * stepCount), 0, stepCount - 1);
                if (idx !== self.currentIndex) {
                    self.goToStep(idx, true);
                } else {
                    self.updateScrollHints(idx);
                }
            }
        });

        if (!this.reducedMotion && stepCount > 1) {
            ScrollTrigger.create({
                trigger: this.track,
                start: 'top top',
                end: 'bottom bottom',
                snap: {
                    snapTo: function (value) {
                        var step = 1 / (stepCount - 1);
                        return Math.round(value / step) * step;
                    },
                    duration: { min: 0.15, max: 0.45 },
                    ease: 'power2.inOut'
                }
            });
        }
    };

    AutomotiveShowcase.prototype.onResize = function () {
        this.isMobile = window.matchMedia('(max-width: 991.98px)').matches;
        this.setTrackHeight();
        ScrollTrigger.refresh();
        if (this.currentIndex >= 0 && this.steps[this.currentIndex]) {
            var step = this.steps[this.currentIndex];
            var layer = this.getActiveLayer(step.svg || step.category);
            this.updateCalloutLine(step, layer, step.highlights || [], false);
        }
    };

    AutomotiveShowcase.prototype.scrollToStep = function (index) {
        index = clamp(index, 0, this.steps.length - 1);
        if (index === this.currentIndex) return;

        var stepCount = this.steps.length;
        var progress = stepCount <= 1 ? 0 : index / (stepCount - 1);
        var scrollStart = this.scrollTrigger.start;
        var scrollEnd = this.scrollTrigger.end;
        var target = scrollStart + (scrollEnd - scrollStart) * progress;

        if (this.reducedMotion) {
            this.goToStep(index, false);
            window.scrollTo(0, target);
            return;
        }

        if (typeof ScrollToPlugin !== 'undefined') {
            gsap.to(window, {
                scrollTo: { y: target, autoKill: false },
                duration: 0.6,
                ease: 'power2.inOut',
                onComplete: function () {
                    ScrollTrigger.refresh();
                }
            });
        } else {
            window.scrollTo({ top: target, behavior: 'smooth' });
            setTimeout(function () { ScrollTrigger.refresh(); }, 650);
        }
    };

    AutomotiveShowcase.prototype.goToStep = function (index, animate) {
        index = clamp(index, 0, this.steps.length - 1);
        if (index === this.currentIndex && animate !== false) return;

        var step = this.steps[index];
        var prevStep = this.currentIndex >= 0 ? this.steps[this.currentIndex] : null;
        this.currentIndex = index;

        var duration = animate === false || this.reducedMotion ? 0 : TRANSITION;

        this.updatePartInfo(step, duration);
        this.updateRightVisuals(step, prevStep, duration);
        this.updateSvgState(step, prevStep, duration);
        this.updateProgress(index);
        this.updateNavState(index);
        this.updateCategoryButtons(step.category);
        this.updateMobileDots(index);
        this.updateScrollHints(index);
    };

    AutomotiveShowcase.prototype.updatePartInfo = function (step, duration) {
        var d = duration;
        var bar = this.elPartNameBar;

        if (!bar) return;

        bar.classList.add('is-visible');

        if (d === 0) {
            if (this.elCategory) this.elCategory.textContent = step.title || '';
            if (this.elName) this.elName.textContent = step.name || '';
            gsap.set(bar, { opacity: 1 });
            return;
        }

        gsap.to(bar, {
            opacity: 0,
            duration: d * 0.35,
            onComplete: function () {
                if (this.elCategory) this.elCategory.textContent = step.title || '';
                if (this.elName) this.elName.textContent = step.name || '';
                gsap.to(bar, { opacity: 1, duration: d * 0.65, ease: 'power2.out' });
            }.bind(this)
        });
    };

    AutomotiveShowcase.prototype.updateCalloutLine = function (step, layer, highlights, animate) {
        var stage = this.stage;
        var callout = this.elPartNameBar;
        var line = this.calloutLine;
        var d = animate ? TRANSITION : 0;

        if (!stage || !callout || !line) return;

        var self = this;

        var draw = function () {
            var stageRect = stage.getBoundingClientRect();
            if (stageRect.width < 1) return;

            if (self.calloutSvg) {
                self.calloutSvg.setAttribute('width', String(stageRect.width));
                self.calloutSvg.setAttribute('height', String(stageRect.height));
                self.calloutSvg.setAttribute('viewBox', '0 0 ' + stageRect.width + ' ' + stageRect.height);
            }

            if (!highlights || !highlights.length || !layer) {
                callout.classList.remove('has-line');
                callout.style.top = '50%';
                callout.style.transform = 'translateY(-50%)';
                line.classList.remove('is-visible');
                gsap.set(line, { opacity: 0 });
                return;
            }

            var comp = qs('[data-component="' + highlights[0] + '"]', layer) || qs('#' + highlights[0], layer);
            var hotspot = comp ? qs('.as-hotspot', comp) : null;

            if (!hotspot) {
                callout.classList.remove('has-line');
                callout.style.top = '50%';
                callout.style.transform = 'translateY(-50%)';
                line.classList.remove('is-visible');
                gsap.set(line, { opacity: 0 });
                return;
            }

            var hr = hotspot.getBoundingClientRect();
            var hx = hr.left + hr.width / 2 - stageRect.left;
            var hy = hr.top + hr.height / 2 - stageRect.top;

            callout.style.top = hy + 'px';
            callout.style.transform = 'translateY(-50%)';
            callout.classList.add('has-line');

            var cr = callout.getBoundingClientRect();
            var cx = cr.left - stageRect.left;
            var cy = hy;
            var len = Math.sqrt(Math.pow(cx - hx, 2) + Math.pow(cy - hy, 2));

            line.setAttribute('x1', String(hx));
            line.setAttribute('y1', String(hy));
            line.setAttribute('x2', String(cx));
            line.setAttribute('y2', String(cy));

            line.classList.add('is-visible');

            if (d === 0) {
                line.style.strokeDasharray = String(len);
                line.style.strokeDashoffset = '0';
                line.style.opacity = '0.85';
                return;
            }

            line.style.strokeDasharray = String(len);
            gsap.fromTo(line,
                { strokeDashoffset: len, opacity: 0 },
                { strokeDashoffset: 0, opacity: 0.85, duration: d, ease: 'power2.out' }
            );
        };

        if (d > 0) {
            requestAnimationFrame(function () {
                requestAnimationFrame(draw);
            });
        } else {
            draw();
        }
    };

    AutomotiveShowcase.prototype.updateRightVisuals = function (step, prevStep, duration) {
        var self = this;
        var d = duration;
        var viewKey = step.svg || step.category || 'interior';
        var vehicleUrl = this.vehicleImages[viewKey] || '';

        if (!this.elVehicleBg || !vehicleUrl) return;

        if (d === 0) {
            this.elVehicleBg.src = vehicleUrl;
            gsap.set(this.elVehicleBg, { opacity: 0.9 });
            return;
        }

        var bgChanged = !prevStep || (prevStep.svg || prevStep.category) !== viewKey;
        if (!bgChanged) return;

        gsap.to(this.elVehicleBg, {
            opacity: 0,
            duration: d * 0.35,
            onComplete: function () {
                self.elVehicleBg.src = vehicleUrl;
                gsap.to(self.elVehicleBg, { opacity: 0.9, duration: d * 0.65 });
            }
        });
    };

    AutomotiveShowcase.prototype.getActiveLayer = function (viewKey) {
        for (var i = 0; i < this.svgLayers.length; i++) {
            if (this.svgLayers[i].getAttribute('data-view') === viewKey) {
                return this.svgLayers[i];
            }
        }
        return null;
    };

    AutomotiveShowcase.prototype.updateSvgState = function (step, prevStep, duration) {
        var self = this;
        var viewKey = step.svg || 'interior';
        var d = duration;

        this.svgLayers.forEach(function (layer) {
            var isActive = layer.getAttribute('data-view') === viewKey;
            layer.classList.toggle('is-active', isActive);
            layer.classList.toggle('is-overview', isActive && step.type === 'overview');
        });

        var layer = this.getActiveLayer(viewKey);
        if (!layer) return;

        var highlights = step.highlights || [];
        var camera = step.camera || { scale: 1, x: 0, y: 0 };
        var visualCol = this.splitVisual;

        var finishCallout = function () {
            self.updateCalloutLine(step, layer, highlights, d > 0);
        };

        if (visualCol) {
            if (d === 0) {
                gsap.set(visualCol, {
                    scale: camera.scale,
                    x: camera.x + '%',
                    y: camera.y + '%',
                    transformOrigin: '50% 50%'
                });
            } else {
                gsap.to(visualCol, {
                    scale: camera.scale,
                    x: camera.x + '%',
                    y: camera.y + '%',
                    duration: d,
                    ease: 'power2.inOut',
                    transformOrigin: '50% 50%',
                    onComplete: finishCallout
                });
            }
        }
        var components = qsa('.as-component', layer);

        this.clearHotspotTweens();

        components.forEach(function (comp) {
            var id = comp.getAttribute('data-component') || comp.id;
            var isHighlighted = highlights.indexOf(id) >= 0;
            var isOverview = step.type === 'overview';

            comp.classList.remove('is-active', 'is-dimmed');

            if (isHighlighted) {
                comp.classList.add('is-active');
            } else if (!isOverview) {
                comp.classList.add('is-dimmed');
            }

            var outline = qs('.as-outline', comp);
            var connector = qs('.as-connector', comp);
            var hotspot = qs('.as-hotspot', comp);
            var hotspotRing = qs('.as-hotspot-ring', comp);
            var region = qs('.as-highlight-region', comp);

            if (outline) {
                var len = parseFloat(outline.dataset.pathLength) || 100;
                if (isHighlighted) {
                    gsap.fromTo(outline,
                        { strokeDashoffset: len, opacity: 0 },
                        { strokeDashoffset: 0, opacity: 1, duration: d, ease: 'power2.out' }
                    );
                } else {
                    gsap.to(outline, { opacity: 0, strokeDashoffset: len, duration: d * 0.5 });
                }
            }

            if (connector) {
                gsap.to(connector, {
                    opacity: isHighlighted ? 0.85 : 0,
                    duration: d
                });
            }

            if (region) {
                gsap.to(region, {
                    opacity: isHighlighted ? 0.7 : 0,
                    duration: d
                });
            }

            if (hotspot) {
                gsap.to(hotspot, {
                    opacity: isHighlighted ? 1 : 0,
                    scale: isHighlighted ? 1 : 0.5,
                    duration: d,
                    transformOrigin: 'center center',
                    onComplete: function () {
                        if (isHighlighted && !self.reducedMotion) {
                            self.startHotspotPulse(hotspot, hotspotRing);
                        }
                    }
                });
            }

            if (hotspotRing) {
                gsap.to(hotspotRing, {
                    opacity: isHighlighted ? 0.6 : 0,
                    scale: isHighlighted ? 1 : 0.5,
                    duration: d,
                    transformOrigin: 'center center'
                });
            }

            gsap.to(comp, {
                opacity: isHighlighted ? 1 : (isOverview ? 0.45 : 0.18),
                duration: d
            });
        });

        if (!visualCol || d === 0) {
            finishCallout();
        }
    };

    AutomotiveShowcase.prototype.startHotspotPulse = function (hotspot, ring) {
        var tween = gsap.to(hotspot, {
            scale: 1.35,
            transformOrigin: 'center center',
            duration: 1.1,
            repeat: -1,
            yoyo: true,
            ease: 'sine.inOut'
        });
        this.hotspotTweens.push(tween);
        if (ring) {
            var ringTween = gsap.to(ring, {
                scale: 1.5,
                opacity: 0,
                transformOrigin: 'center center',
                duration: 1.6,
                repeat: -1,
                ease: 'power1.out'
            });
            this.hotspotTweens.push(ringTween);
        }
    };

    AutomotiveShowcase.prototype.clearHotspotTweens = function () {
        this.hotspotTweens.forEach(function (t) { t.kill(); });
        this.hotspotTweens = [];
        qsa('.as-hotspot', this.root).forEach(function (h) {
            gsap.killTweensOf(h);
            gsap.set(h, { scale: 1 });
        });
    };

    AutomotiveShowcase.prototype.positionTooltip = function (layer, componentId, step) {
        if (!this.tooltip || !this.stage) return;

        var comp = qs('[data-component="' + componentId + '"]', layer) || qs('#' + componentId, layer);
        if (!comp) {
            this.hideTooltip();
            return;
        }

        var hotspot = qs('.as-hotspot', comp);
        if (!hotspot) {
            this.hideTooltip();
            return;
        }

        var cx = parseFloat(hotspot.getAttribute('cx')) || 400;
        var cy = parseFloat(hotspot.getAttribute('cy')) || 250;
        var svg = layer.querySelector('svg');
        var vb = svg && svg.viewBox && svg.viewBox.baseVal;
        var vbW = vb && vb.width ? vb.width : 800;
        var vbH = vb && vb.height ? vb.height : 500;

        this.tooltip.querySelector('[data-as-tooltip-title]').textContent = step.name || '';

        var leftPct = (cx / vbW) * 100;
        var topPct = (cy / vbH) * 100;
        this.tooltip.style.left = leftPct + '%';
        this.tooltip.style.top = topPct + '%';
        this.tooltip.style.transform = 'translate(-50%, -120%)';
        this.tooltip.classList.add('is-visible');

        gsap.fromTo(this.tooltip,
            { opacity: 0, y: 8 },
            { opacity: 1, y: 0, duration: TRANSITION * 0.6 }
        );
    };

    AutomotiveShowcase.prototype.hideTooltip = function () {
        if (!this.tooltip) return;
        this.tooltip.classList.remove('is-visible');
        gsap.set(this.tooltip, { opacity: 0 });
    };

    AutomotiveShowcase.prototype.updateProgress = function (index) {
        var step = this.steps[index];
        var catSteps = step ? this.getStepsForCategory(step.category) : this.steps;
        var catIdx = this.getStepIndexInCategory(index);
        var pct = catSteps.length ? ((catIdx + 1) / catSteps.length) * 100 : 0;
        if (this.elProgressFill) {
            if (this.reducedMotion) {
                this.elProgressFill.style.width = pct + '%';
            } else {
                gsap.to(this.elProgressFill, { width: pct + '%', duration: 0.4, ease: 'power2.out' });
            }
        }
        if (this.elProgressCurrent) this.elProgressCurrent.textContent = String(catIdx + 1);
        if (this.elStepCurrent) this.elStepCurrent.textContent = String(catIdx + 1);
        if (this.elStepTotal) this.elStepTotal.textContent = String(catSteps.length);
    };

    AutomotiveShowcase.prototype.updateNavState = function (index) {
        var step = this.steps[index];
        if (!step) return;
        var catSteps = this.getStepsForCategory(step.category);
        var catIdx = this.getStepIndexInCategory(index);
        if (this.btnPrev) this.btnPrev.disabled = catIdx <= 0;
        if (this.btnNext) this.btnNext.disabled = catIdx >= catSteps.length - 1;
    };

    AutomotiveShowcase.prototype.updateCategoryButtons = function (categoryId) {
        this.categoryBtns.forEach(function (btn) {
            btn.classList.toggle('is-active', btn.getAttribute('data-as-cat') === categoryId);
        });
    };

    AutomotiveShowcase.prototype.updateMobileDots = function (index) {
        if (!this.mobileDots) return;
        this.mobileDots.forEach(function (dot, i) {
            dot.classList.toggle('is-active', i === index);
        });
    };

    document.addEventListener('DOMContentLoaded', function () {
        qsa('[data-product-showcase]').forEach(function (root) {
            new AutomotiveShowcase(root).init();
        });
    });
})();
