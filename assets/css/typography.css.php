<?php if ($isRtl): ?>
<link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<?php endif; ?>
<style>
    /**
 * typography.css.php - Typography Styles
 * 
 * Contains all typography-related styles including fonts, text sizes, 
 * line heights, and text justification optimized for both LTR and RTL.
 */

/* =========================
   Font Definitions
   ========================= */
/* Define Vazirmatn Font for RTL languages */
/* Define Vazirmatn Font for RTL languages */
/* Define Vazirmatn Font for RTL languages */
/* Define Vazirmatn Font for RTL languages */
@font-face {
    font-family: 'Vazirmatn';
    src: url('/salman/assets/fonts/Vazirmatn/Vazir.ttf') format('truetype');
    font-weight: 400;
    font-style: normal;
    font-display: swap;
}

@font-face {
    font-family: 'Vazirmatn';
    src: url('/salman/assets/fonts/Vazirmatn/Vazir-Medium.ttf') format('truetype');
    font-weight: 500;
    font-style: normal;
    font-display: swap;
}

@font-face {
    font-family: 'Vazirmatn';
    src: url('/salman/assets/fonts/Vazirmatn/Vazir-Bold.ttf') format('truetype');
    font-weight: 700;
    font-style: normal;
    font-display: swap;
}

@font-face {
    font-family: 'Vazirmatn';
    src: url('/salman/assets/fonts/Vazirmatn/Vazir-Bold.ttf') format('truetype');
    font-weight: 800;
    font-style: normal;
    font-display: swap;
}
/* =========================
   Base Typography
   ========================= */
html {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-rendering: optimizeLegibility;
}

body {
    font-family: <?php echo $isRtl ? '"Vazirmatn", sans-serif' : '"Plus Jakarta Sans", sans-serif'; ?>;
    font-size: 1rem;
    line-height: 1.7;
    color: var(--gray-700);
}

h1, h2, h3, h4, h5, h6 {
    font-family: <?php echo $isRtl ? '"Vazirmatn", sans-serif' : '"Plus Jakarta Sans", sans-serif'; ?>;
    font-weight: 700;
    line-height: 1.3;
    color: var(--gray-900);
    margin-bottom: 1rem;
}

h1 {
    font-size: 3rem;
    line-height: 1.2;
    font-weight: 800;
}

h2 {
    font-size: 2.5rem;
    line-height: 1.25;
    font-weight: 800;
}

h3 {
    font-size: 2rem;
    line-height: 1.3;
}

h4 {
    font-size: 1.5rem;
    line-height: 1.35;
}

h5 {
    font-size: 1.25rem;
    line-height: 1.4;
}

h6 {
    font-size: 1.1rem;
    line-height: 1.45;
}

p {
    margin-bottom: 1.5rem;
}

small, .text-small {
    font-size: 0.875rem;
}

.text-xs {
    font-size: 0.75rem;
}

.text-sm {
    font-size: 0.875rem;
}

.text-md {
    font-size: 1rem;
}

.text-lg {
    font-size: 1.125rem;
}

.text-xl {
    font-size: 1.25rem;
}

.text-2xl {
    font-size: 1.5rem;
}

.text-3xl {
    font-size: 1.875rem;
}

.text-4xl {
    font-size: 2.25rem;
}

.text-5xl {
    font-size: 3rem;
}

.font-thin {
    font-weight: 100;
}

.font-extralight {
    font-weight: 200;
}

.font-light {
    font-weight: 300;
}

.font-normal {
    font-weight: 400;
}

.font-medium {
    font-weight: 500;
}

.font-semibold {
    font-weight: 600;
}

.font-bold {
    font-weight: 700;
}

.font-extrabold {
    font-weight: 800;
}

.font-black {
    font-weight: 900;
}

.italic {
    font-style: italic;
}

.uppercase {
    text-transform: uppercase;
}

.lowercase {
    text-transform: lowercase;
}

.capitalize {
    text-transform: capitalize;
}

.normal-case {
    text-transform: none;
}

.line-height-1 {
    line-height: 1;
}

.line-height-tight {
    line-height: 1.25;
}

.line-height-normal {
    line-height: 1.5;
}

.line-height-relaxed {
    line-height: 1.75;
}

.line-height-loose {
    line-height: 2;
}

.tracking-tighter {
    letter-spacing: -0.05em;
}

.tracking-tight {
    letter-spacing: -0.025em;
}

.tracking-normal {
    letter-spacing: 0;
}

.tracking-wide {
    letter-spacing: 0.025em;
}

.tracking-wider {
    letter-spacing: 0.05em;
}

.tracking-widest {
    letter-spacing: 0.1em;
}

/* =========================
   Text Alignment & Justification
   ========================= */
.text-left {
    text-align: left;
}

.text-center {
    text-align: center;
}

.text-right {
    text-align: right;
}

.text-justify {
    text-align: justify;
}

/**
 * Natural Justified Text
 * Optimized for both RTL and LTR
 */
.text-natural-justify {
    text-align: justify;
    text-justify: inter-word;
    hyphens: auto;
    word-spacing: normal;
    word-break: normal;
    overflow-wrap: break-word;
}

/* RTL-specific text justification */
[dir="rtl"] .text-natural-justify {
    text-align-last: right;
    letter-spacing: -0.2px;
}

/* LTR-specific text justification */
[dir="ltr"] .text-natural-justify {
    text-align-last: left;
    letter-spacing: 0.2px;
}

/* Paragraph with natural justification */
p.text-natural-justify {
    line-height: 1.8;
    margin-bottom: 1rem;
}

/* Apply natural justification to specific elements */
.section-description,
.about-text,
.testimonial-content p,
.faq-answer p {
    text-align: justify;
    text-justify: inter-word;
    hyphens: auto;
    word-spacing: normal;
    overflow-wrap: break-word;
}

/* RTL-specific alignment for justified text */
[dir="rtl"] .section-description,
[dir="rtl"] .about-text,
[dir="rtl"] .testimonial-content p,
[dir="rtl"] .faq-answer p {
    text-align-last: right;
    letter-spacing: -0.2px;
}

/* LTR-specific alignment for justified text */
[dir="ltr"] .section-description,
[dir="ltr"] .about-text,
[dir="ltr"] .testimonial-content p,
[dir="ltr"] .faq-answer p {
    text-align-last: left;
    letter-spacing: 0.2px;
}

/* Advanced text justification for browsers that support it */
@supports (text-justify: newspaper) {
    .text-natural-justify,
    .section-description,
    .about-text,
    .testimonial-content p,
    .faq-answer p {
        text-justify: newspaper;
    }
}

/* =========================
   Links & Text Decorations
   ========================= */
a {
    color: var(--primary);
    text-decoration: none;
    transition: color 0.3s ease;
}

a:hover {
    color: var(--primary-light);
}

.text-link {
    color: var(--primary);
    position: relative;
    display: inline-block;
}

.text-link::after {
    content: '';
    position: absolute;
    width: 100%;
    height: 1px;
    bottom: 0;
    left: 0;
    background-color: var(--primary);
    transform: scaleX(0);
    transform-origin: bottom right;
    transition: transform 0.3s ease;
}

.text-link:hover::after {
    transform: scaleX(1);
    transform-origin: bottom left;
}

/* RTL Link Underline Animation */
[dir="rtl"] .text-link::after {
    transform-origin: bottom left;
}

[dir="rtl"] .text-link:hover::after {
    transform-origin: bottom right;
}

.text-decoration-none {
    text-decoration: none !important;
}

.text-decoration-underline {
    text-decoration: underline !important;
}

.text-decoration-line-through {
    text-decoration: line-through !important;
}

/* =========================
   Text Colors
   ========================= */
.text-primary {
    color: var(--primary) !important;
}

.text-secondary {
    color: var(--secondary) !important;
}

.text-success {
    color: var(--success) !important;
}

.text-danger {
    color: var(--danger) !important;
}

.text-warning {
    color: var(--warning) !important;
}

.text-pink {
    color: var(--accent-pink) !important;
}

.text-teal {
    color: var(--accent-teal) !important;
}

.text-yellow {
    color: var(--accent-yellow) !important;
}

.text-gray-300 {
    color: var(--gray-300) !important;
}

.text-gray-400 {
    color: var(--gray-400) !important;
}

.text-gray-500 {
    color: var(--gray-500) !important;
}

.text-gray-600 {
    color: var(--gray-600) !important;
}

.text-gray-700 {
    color: var(--gray-700) !important;
}

.text-gray-800 {
    color: var(--gray-800) !important;
}

.text-gray-900 {
    color: var(--gray-900) !important;
}

.text-white {
    color: #fff !important;
}

.text-black {
    color: #000 !important;
}

/* =========================
   Text Effects
   ========================= */
/* Gradient Text */
.text-gradient {
    background: var(--purple-gradient);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    display: inline-block;
}

.text-gradient-sunset {
    background: var(--sunset-gradient);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    display: inline-block;
}

/* Text with shadow */
.text-shadow-sm {
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}

.text-shadow {
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.text-shadow-lg {
    text-shadow: 0 4px 8px rgba(0, 0, 0, 0.25);
}

.text-shadow-light {
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Truncate text */
.text-truncate {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Line Clamp (for multi-line truncation) */
.line-clamp-1,
.line-clamp-2,
.line-clamp-3 {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-1 {
    -webkit-line-clamp: 1;
    line-clamp: 1;

}

.line-clamp-2 {
    -webkit-line-clamp: 2;
    line-clamp: 2;

}

.line-clamp-3 {
    -webkit-line-clamp: 3;
    line-clamp: 3;
}

/* =========================
   Lists
   ========================= */
ul.clean-list,
ol.clean-list {
    list-style: none;
    padding-left: 0;
    margin-bottom: 1rem;
}

ul.spaced-list li,
ol.spaced-list li {
    margin-bottom: 0.75rem;
}

ul.styled-list,
ol.styled-list {
    padding-left: 1.5rem;
    margin-bottom: 1.5rem;
}

ul.styled-list li,
ol.styled-list li {
    margin-bottom: 0.75rem;
    position: relative;
}

ul.styled-list-check {
    list-style: none;
    padding-left: 1.75rem;
}

ul.styled-list-check li {
    position: relative;
    margin-bottom: 0.75rem;
}

ul.styled-list-check li::before {
    content: '✓';
    color: var(--success);
    position: absolute;
    left: -1.5rem;
    font-weight: bold;
}

[dir="rtl"] ul.styled-list,
[dir="rtl"] ol.styled-list {
    padding-right: 1.5rem;
    padding-left: 0;
}

[dir="rtl"] ul.styled-list-check {
    padding-right: 1.75rem;
    padding-left: 0;
}

[dir="rtl"] ul.styled-list-check li::before {
    right: -1.5rem;
    left: auto;
}

/* =========================
   Responsive Typography
   ========================= */
@media (max-width: 1200px) {
    h1 {
        font-size: 2.75rem;
    }
    
    h2 {
        font-size: 2.25rem;
    }
    
    h3 {
        font-size: 1.75rem;
    }
    
    h4 {
        font-size: 1.4rem;
    }
}

@media (max-width: 992px) {
    html {
        font-size: 15px;
    }
    
    h1 {
        font-size: 2.5rem;
    }
    
    h2 {
        font-size: 2rem;
    }
    
    h3 {
        font-size: 1.6rem;
    }
    
    h4 {
        font-size: 1.3rem;
    }
    
    .text-justify {
        text-align: inherit;
    }
    
    [dir="rtl"] .text-justify {
        text-align: right;
    }
    
    [dir="ltr"] .text-justify {
        text-align: left;
    }
}

@media (max-width: 768px) {
    html {
        font-size: 15px;
    }
    
    h1 {
        font-size: 2.25rem;
    }
    
    h2 {
        font-size: 1.75rem;
    }
    
    h3 {
        font-size: 1.5rem;
    }
    
    h4 {
        font-size: 1.25rem;
    }
    
    .text-natural-justify,
    .section-description,
    .about-text,
    .testimonial-content p,
    .faq-answer p {
        text-align: inherit;
        hyphens: none;
    }
    
    [dir="rtl"] .text-natural-justify,
    [dir="rtl"] .section-description,
    [dir="rtl"] .about-text,
    [dir="rtl"] .testimonial-content p,
    [dir="rtl"] .faq-answer p {
        text-align: right;
    }
    
    [dir="ltr"] .text-natural-justify,
    [dir="ltr"] .section-description,
    [dir="ltr"] .about-text,
    [dir="ltr"] .testimonial-content p,
    [dir="ltr"] .faq-answer p {
        text-align: left;
    }
}

@media (max-width: 576px) {
    html {
        font-size: 14px;
    }
    
    h1 {
        font-size: 2rem;
    }
    
    h2 {
        font-size: 1.6rem;
    }
    
    h3 {
        font-size: 1.4rem;
    }
    
    h4 {
        font-size: 1.2rem;
    }
    
    p {
        margin-bottom: 1.25rem;
    }
}
</style>