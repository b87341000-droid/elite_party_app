/**
 * Elite Block Party — Animation Engine
 * GSAP ScrollTrigger + Canvas Paint Splashes + Tire Tracks
 */

import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

// ─────────────────────────────────────────────────────────────────────────────
// 1. GSAP ScrollTrigger scroll-reveal (replaces the old IntersectionObserver)
// ─────────────────────────────────────────────────────────────────────────────
export function initScrollReveals() {
    gsap.utils.toArray('[data-reveal]').forEach((el) => {
        const delay = parseFloat(el.dataset.delay || 0) / 1000;
        gsap.fromTo(
            el,
            { opacity: 0, y: 50 },
            {
                opacity: 1,
                y: 0,
                duration: 0.9,
                delay,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: el,
                    start: 'top 88%',
                    toggleActions: 'play none none none',
                },
            }
        );
    });
}

// ─────────────────────────────────────────────────────────────────────────────
// 2. TIRE TRACK — SVG path draw-on-scroll
// ─────────────────────────────────────────────────────────────────────────────
export function initTireTrack(svgId) {
    const svg = document.getElementById(svgId);
    if (!svg) return;

    const paths = svg.querySelectorAll('[data-tire-path]');

    paths.forEach((path) => {
        const len = path.getTotalLength();
        gsap.set(path, {
            strokeDasharray: len,
            strokeDashoffset: len,
        });

        gsap.to(path, {
            strokeDashoffset: 0,
            ease: 'none',
            scrollTrigger: {
                trigger: svg,
                start: 'top 80%',
                end: 'bottom 20%',
                scrub: 1.5,
            },
        });
    });
}

// ─────────────────────────────────────────────────────────────────────────────
// 3. CANVAS PAINT SPLASH — section divider bursts
// ─────────────────────────────────────────────────────────────────────────────
const COLORS = ['#D4AF37', '#F5C518', '#E11D2E', '#00E5FF', '#8B0F1C'];

function randomBetween(a, b) {
    return a + Math.random() * (b - a);
}

class PaintDrop {
    constructor(x, y, color, canvas) {
        this.x = x;
        this.y = y;
        this.color = color;
        this.radius = 0;
        this.maxRadius = randomBetween(30, 120);
        this.alpha = 0.9;
        this.vx = randomBetween(-6, 6);
        this.vy = randomBetween(-10, -2);
        this.gravity = 0.35;
        this.alive = true;
        this.drips = this.generateDrips();
        this.blobs = this.generateBlobs();
    }

    generateDrips() {
        return Array.from({ length: Math.floor(randomBetween(3, 9)) }, () => ({
            x: this.x + randomBetween(-60, 60),
            y: this.y,
            vy: randomBetween(1, 5),
            length: randomBetween(20, 80),
            width: randomBetween(2, 7),
            alpha: randomBetween(0.4, 0.8),
        }));
    }

    generateBlobs() {
        return Array.from({ length: Math.floor(randomBetween(4, 12)) }, () => ({
            x: this.x + randomBetween(-100, 100),
            y: this.y + randomBetween(-40, 40),
            r: randomBetween(4, 22),
            alpha: randomBetween(0.3, 0.7),
        }));
    }

    update() {
        if (this.radius < this.maxRadius) {
            this.radius += (this.maxRadius - this.radius) * 0.15;
        }
        this.x += this.vx;
        this.y += this.vy;
        this.vy += this.gravity;
        this.vx *= 0.92;
        this.alpha -= 0.008;
        if (this.alpha <= 0) this.alive = false;

        this.drips.forEach((d) => {
            d.y += d.vy;
            d.length += 1.5;
            d.vy += 0.1;
            d.alpha -= 0.006;
        });
    }

    draw(ctx) {
        if (!this.alive) return;
        ctx.save();
        ctx.globalAlpha = Math.max(0, this.alpha);

        // Main splash blob
        ctx.beginPath();
        const offsets = 8;
        for (let i = 0; i < offsets; i++) {
            const angle = (i / offsets) * Math.PI * 2;
            const wobble = this.radius * (0.7 + 0.3 * Math.sin(angle * 3 + this.radius));
            const px = this.x + Math.cos(angle) * wobble;
            const py = this.y + Math.sin(angle) * wobble;
            i === 0 ? ctx.moveTo(px, py) : ctx.lineTo(px, py);
        }
        ctx.closePath();
        ctx.fillStyle = this.color;
        ctx.fill();

        // Splatter blobs
        this.blobs.forEach((b) => {
            ctx.globalAlpha = Math.max(0, this.alpha * b.alpha);
            ctx.beginPath();
            ctx.ellipse(b.x, b.y, b.r, b.r * 0.6, Math.random() * Math.PI, 0, Math.PI * 2);
            ctx.fillStyle = this.color;
            ctx.fill();
        });

        // Drip streaks
        this.drips.forEach((d) => {
            if (d.alpha <= 0) return;
            ctx.globalAlpha = Math.max(0, this.alpha * d.alpha);
            ctx.beginPath();
            ctx.moveTo(d.x, d.y);
            ctx.lineTo(d.x, d.y + d.length);
            ctx.strokeStyle = this.color;
            ctx.lineWidth = d.width;
            ctx.lineCap = 'round';
            ctx.stroke();
        });

        ctx.restore();
    }
}

class PaintSplashCanvas {
    constructor(canvas) {
        this.canvas = canvas;
        this.ctx = canvas.getContext('2d');
        this.drops = [];
        this.animId = null;
        this.resize();
        window.addEventListener('resize', () => this.resize(), { passive: true });
    }

    resize() {
        const rect = this.canvas.parentElement.getBoundingClientRect();
        this.canvas.width = rect.width;
        this.canvas.height = this.canvas.dataset.height ? parseInt(this.canvas.dataset.height) : 220;
    }

    burst(x, y, count = 18) {
        const color = COLORS[Math.floor(Math.random() * COLORS.length)];
        const accentColor = COLORS[Math.floor(Math.random() * COLORS.length)];
        for (let i = 0; i < count; i++) {
            const bx = x ?? randomBetween(this.canvas.width * 0.1, this.canvas.width * 0.9);
            const by = y ?? randomBetween(this.canvas.height * 0.2, this.canvas.height * 0.8);
            this.drops.push(new PaintDrop(bx, by, i % 4 === 0 ? accentColor : color, this.canvas));
        }
        if (!this.animId) this.animate();
    }

    animate() {
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        this.drops = this.drops.filter((d) => d.alive);
        this.drops.forEach((d) => {
            d.update();
            d.draw(this.ctx);
        });
        if (this.drops.length > 0) {
            this.animId = requestAnimationFrame(() => this.animate());
        } else {
            this.animId = null;
        }
    }
}

// ─────────────────────────────────────────────────────────────────────────────
// 4. TIRE MARKS — canvas rolling tread marks on scroll
// ─────────────────────────────────────────────────────────────────────────────
class TireMarkCanvas {
    constructor(canvas) {
        this.canvas = canvas;
        this.ctx = canvas.getContext('2d');
        this.progress = 0;
        this.resize();
        window.addEventListener('resize', () => this.resize(), { passive: true });
    }

    resize() {
        this.canvas.width = window.innerWidth;
        this.canvas.height = parseInt(this.canvas.dataset.height || 80);
    }

    draw(progress) {
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        const W = this.canvas.width;
        const H = this.canvas.height;
        const travelX = progress * W;

        // Draw two tire track lanes
        const lanes = [H * 0.3, H * 0.7];
        lanes.forEach((y, li) => {
            const offset = li * 15;
            // Tire tread pattern
            for (let i = 0; i < travelX; i += 40) {
                const alpha = Math.min(1, (travelX - i) / 80) * 0.55;
                this.ctx.save();
                this.ctx.globalAlpha = alpha;
                this.ctx.fillStyle = li === 0 ? '#D4AF37' : '#E11D2E';

                // Tread block
                this.ctx.beginPath();
                this.ctx.roundRect(i + offset * 0.5, y - 8, 26, 16, 3);
                this.ctx.fill();

                // Tread gaps
                this.ctx.fillStyle = '#050505';
                this.ctx.fillRect(i + offset * 0.5 + 8, y - 8, 3, 16);
                this.ctx.fillRect(i + offset * 0.5 + 17, y - 8, 3, 16);

                // Micro side treads
                this.ctx.fillStyle = li === 0 ? '#F5C518' : '#8B0F1C';
                this.ctx.fillRect(i + offset * 0.5, y - 11, 26, 3);
                this.ctx.fillRect(i + offset * 0.5, y + 8, 26, 3);
                this.ctx.restore();
            }
        });
    }

    animateToProgress(target) {
        const start = this.progress;
        const diff = target - start;
        const dur = 60;
        let frame = 0;
        const tick = () => {
            frame++;
            this.progress = start + diff * Math.min(frame / dur, 1);
            this.draw(this.progress);
            if (frame < dur) requestAnimationFrame(tick);
        };
        requestAnimationFrame(tick);
    }
}

// ─────────────────────────────────────────────────────────────────────────────
// 5. SECTION TRANSITION PAINT BURST (triggered at each section boundary)
// ─────────────────────────────────────────────────────────────────────────────
export function initSectionPaintBursts() {
    const canvases = document.querySelectorAll('[data-paint-canvas]');
    canvases.forEach((canvas) => {
        const splash = new PaintSplashCanvas(canvas);
        let triggered = false;

        ScrollTrigger.create({
            trigger: canvas.parentElement,
            start: 'top 75%',
            onEnter: () => {
                if (triggered) return;
                triggered = true;
                // Multiple wave bursts for drama
                splash.burst(null, null, 20);
                setTimeout(() => splash.burst(null, null, 15), 200);
                setTimeout(() => splash.burst(null, null, 12), 450);
                setTimeout(() => splash.burst(null, null, 10), 700);
            },
        });
    });
}

// ─────────────────────────────────────────────────────────────────────────────
// 6. TIRE TRACK SCROLL BARS (horizontal, scroll-scrubbed)
// ─────────────────────────────────────────────────────────────────────────────
export function initTireMarkBars() {
    const bars = document.querySelectorAll('[data-tire-bar]');
    bars.forEach((canvas) => {
        const tm = new TireMarkCanvas(canvas);
        tm.draw(0);

        ScrollTrigger.create({
            trigger: canvas.parentElement,
            start: 'top 90%',
            end: 'top 20%',
            scrub: 2,
            onUpdate: (self) => {
                tm.draw(self.progress);
            },
        });
    });
}

// ─────────────────────────────────────────────────────────────────────────────
// 7. HERO PARALLAX layers
// ─────────────────────────────────────────────────────────────────────────────
export function initHeroParallax() {
    // Parallax the hero title on scroll
    gsap.to('#hero-title-elite', {
        yPercent: -20,
        ease: 'none',
        scrollTrigger: {
            trigger: '#home',
            start: 'top top',
            end: 'bottom top',
            scrub: true,
        },
    });

    gsap.to('#hero-ambient-blobs', {
        yPercent: 30,
        ease: 'none',
        scrollTrigger: {
            trigger: '#home',
            start: 'top top',
            end: 'bottom top',
            scrub: true,
        },
    });
}

// ─────────────────────────────────────────────────────────────────────────────
// 8. COUNTER ANIMATION (stats bar numbers)
// ─────────────────────────────────────────────────────────────────────────────
export function initCounterAnimations() {
    document.querySelectorAll('[data-count-to]').forEach((el) => {
        const target = parseFloat(el.dataset.countTo);
        const suffix = el.dataset.countSuffix || '';
        let obj = { val: 0 };

        ScrollTrigger.create({
            trigger: el,
            start: 'top 80%',
            onEnter: () => {
                gsap.to(obj, {
                    val: target,
                    duration: 2,
                    ease: 'power2.out',
                    onUpdate: () => {
                        el.textContent = Math.floor(obj.val) + suffix;
                    },
                });
            },
            once: true,
        });
    });
}

// ─────────────────────────────────────────────────────────────────────────────
// 9. MAGNETIC BUTTONS
// ─────────────────────────────────────────────────────────────────────────────
export function initMagneticButtons() {
    document.querySelectorAll('.btn-gold, .btn-outline-gold, .btn-crimson').forEach((btn) => {
        btn.addEventListener('mousemove', (e) => {
            const rect = btn.getBoundingClientRect();
            const cx = rect.left + rect.width / 2;
            const cy = rect.top + rect.height / 2;
            const dx = (e.clientX - cx) * 0.25;
            const dy = (e.clientY - cy) * 0.25;
            gsap.to(btn, { x: dx, y: dy, duration: 0.3, ease: 'power2.out' });
        });
        btn.addEventListener('mouseleave', () => {
            gsap.to(btn, { x: 0, y: 0, duration: 0.5, ease: 'elastic.out(1, 0.4)' });
        });
    });
}

// ─────────────────────────────────────────────────────────────────────────────
// 10. SECTION HEADING STAGGER (letters fly in)
// ─────────────────────────────────────────────────────────────────────────────
export function initHeadingAnimations() {
    document.querySelectorAll('[data-split-heading]').forEach((el) => {
        const text = el.textContent;
        el.innerHTML = text
            .split('')
            .map((ch) => `<span class="inline-block">${ch === ' ' ? '&nbsp;' : ch}</span>`)
            .join('');

        const chars = el.querySelectorAll('span');
        gsap.set(chars, { opacity: 0, y: 80, rotateX: -90 });

        ScrollTrigger.create({
            trigger: el,
            start: 'top 80%',
            onEnter: () => {
                gsap.to(chars, {
                    opacity: 1,
                    y: 0,
                    rotateX: 0,
                    duration: 0.6,
                    stagger: 0.04,
                    ease: 'back.out(2)',
                });
            },
            once: true,
        });
    });
}

// ─────────────────────────────────────────────────────────────────────────────
// BOOT — init all on DOMContentLoaded
// ─────────────────────────────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    initScrollReveals();
    initSectionPaintBursts();
    initTireMarkBars();
    initHeroParallax();
    initCounterAnimations();
    initMagneticButtons();
    initHeadingAnimations();

    // Refresh ScrollTrigger after fonts load (prevents miscalculated positions)
    document.fonts.ready.then(() => ScrollTrigger.refresh());
});
