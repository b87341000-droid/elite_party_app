import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                elite: {
                    black:       '#050505',
                    coal:        '#0A0A0A',
                    charcoal:    '#141414',
                    graphite:    '#1A1A1A',
                    steel:       '#262626',
                    ash:         '#3A3A3A',
                    smoke:       '#6B6B6B',
                    bone:        '#F5F5F0',
                    gold:        '#D4AF37',
                    goldBright:  '#F5C518',
                    goldDim:     '#8B7223',
                    crimson:     '#E11D2E',
                    crimsonDeep: '#8B0F1C',
                    cyan:        '#00E5FF',
                },
            },
            fontFamily: {
                display: ['Anton', 'sans-serif'],
                bebas:   ['"Bebas Neue"', 'sans-serif'],
                sans:    ['Inter', ...defaultTheme.fontFamily.sans],
                mono:    ['"JetBrains Mono"', 'monospace'],
            },
            letterSpacing: {
                tightest: '-0.05em',
                ultra:    '0.3em',
            },
            backgroundImage: {
                'gold-gradient':   'linear-gradient(135deg, #D4AF37 0%, #F5C518 50%, #D4AF37 100%)',
                'crimson-gradient':'linear-gradient(135deg, #E11D2E 0%, #8B0F1C 100%)',
                'dark-gradient':   'linear-gradient(180deg, #0A0A0A 0%, #050505 100%)',
                'radial-gold':     'radial-gradient(circle at center, rgba(212,175,55,0.15) 0%, transparent 70%)',
                'carbon':          "url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='40'%3E%3Cdefs%3E%3Cpattern id='c' width='10' height='10' patternUnits='userSpaceOnUse'%3E%3Cpath d='M0 0 L10 10 M10 0 L0 10' stroke='%23181818' stroke-width='0.5'/%3E%3C/pattern%3E%3C/defs%3E%3Crect width='40' height='40' fill='%230A0A0A'/%3E%3Crect width='40' height='40' fill='url(%23c)' opacity='0.4'/%3E%3C/svg%3E\")",
            },
            boxShadow: {
                'gold-glow':    '0 0 40px rgba(212,175,55,0.35), 0 0 80px rgba(212,175,55,0.15)',
                'crimson-glow': '0 0 40px rgba(225,29,46,0.35)',
                'inset-gold':   'inset 0 1px 0 rgba(212,175,55,0.3)',
            },
            animation: {
                'marquee':      'marquee 30s linear infinite',
                'shimmer':      'shimmer 2.5s linear infinite',
                'pulse-gold':   'pulseGold 2s ease-in-out infinite',
                'float':        'float 6s ease-in-out infinite',
                'scan-line':    'scanLine 4s linear infinite',
                'flicker':      'flicker 5s linear infinite',
                'spin-slow':    'spin 20s linear infinite',
                'expand-x':     'expandX 1s ease-out forwards',
            },
            keyframes: {
                marquee: {
                    '0%':   { transform: 'translateX(0)' },
                    '100%': { transform: 'translateX(-50%)' },
                },
                shimmer: {
                    '0%':   { backgroundPosition: '-200% 0' },
                    '100%': { backgroundPosition: '200% 0' },
                },
                pulseGold: {
                    '0%, 100%': { boxShadow: '0 0 20px rgba(212,175,55,0.3)' },
                    '50%':      { boxShadow: '0 0 60px rgba(212,175,55,0.7)' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%':      { transform: 'translateY(-10px)' },
                },
                scanLine: {
                    '0%':   { transform: 'translateY(-100%)' },
                    '100%': { transform: 'translateY(100vh)' },
                },
                flicker: {
                    '0%, 19%, 21%, 23%, 25%, 54%, 56%, 100%': { opacity: '1' },
                    '20%, 24%, 55%': { opacity: '0.4' },
                },
                expandX: {
                    '0%':   { transform: 'scaleX(0)', transformOrigin: 'left' },
                    '100%': { transform: 'scaleX(1)', transformOrigin: 'left' },
                },
            },
        },
    },
    plugins: [
        forms,
        function ({ addUtilities, theme }) {
            addUtilities({
                '.clip-corner': {
                    clipPath: 'polygon(0 0, calc(100% - 20px) 0, 100% 20px, 100% 100%, 20px 100%, 0 calc(100% - 20px))',
                },
                '.clip-corner-lg': {
                    clipPath: 'polygon(0 0, calc(100% - 40px) 0, 100% 40px, 100% 100%, 40px 100%, 0 calc(100% - 40px))',
                },
                '.clip-notch': {
                    clipPath: 'polygon(0 0, 100% 0, 100% calc(100% - 30px), calc(100% - 30px) 100%, 0 100%)',
                },
                '.clip-diagonal': {
                    clipPath: 'polygon(0 0, 100% 0, 100% 90%, 0 100%)',
                },
                '.clip-slash-left': {
                    clipPath: 'polygon(8% 0, 100% 0, 100% 100%, 0 100%)',
                },
                '.clip-slash-right': {
                    clipPath: 'polygon(0 0, 100% 0, 92% 100%, 0 100%)',
                },
                '.text-gold-gradient': {
                    background: 'linear-gradient(135deg, #D4AF37 0%, #F5C518 50%, #D4AF37 100%)',
                    '-webkit-background-clip': 'text',
                    '-webkit-text-fill-color': 'transparent',
                    'background-clip': 'text',
                },
                '.text-chrome': {
                    background: 'linear-gradient(180deg, #FFFFFF 0%, #A0A0A0 45%, #FFFFFF 55%, #6B6B6B 100%)',
                    '-webkit-background-clip': 'text',
                    '-webkit-text-fill-color': 'transparent',
                    'background-clip': 'text',
                },
                '.text-crimson-gradient': {
                    background: 'linear-gradient(135deg, #E11D2E 0%, #FF4D5E 50%, #E11D2E 100%)',
                    '-webkit-background-clip': 'text',
                    '-webkit-text-fill-color': 'transparent',
                    'background-clip': 'text',
                },
                '.shimmer-btn': {
                    backgroundImage: 'linear-gradient(110deg, transparent 30%, rgba(255,255,255,0.35) 50%, transparent 70%)',
                    backgroundSize: '200% 100%',
                    animation: 'shimmer 2.5s linear infinite',
                },
                '.writing-vertical': {
                    writingMode: 'vertical-rl',
                    textOrientation: 'mixed',
                    transform: 'rotate(180deg)',
                },
            });
        },
    ],
};
