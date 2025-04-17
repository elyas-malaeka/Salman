<style>
    /**
 * main.css.php - Core Styles
 * 
 * Contains base styles, colors, typography, animations, utilities,
 * and shared components used throughout the Salman Educational Complex website.
 */

/****************************
 * VARIABLES
 ****************************/
:root {
    /* Primary Color Scheme - Celestial Theme */
    --primary: #6C63FF;
    --primary-light: #9471FF;
    --primary-dark: #5451e6;
    --primary-rgb: 108, 99, 255;
    
    --secondary: #6C9EFF;
    --secondary-light: #87CEFA;
    --secondary-dark: #4B83E8;
    --secondary-rgb: 108, 158, 255;
    
    /* Accent Colors */
    --accent-pink: #FF6B8B;
    --accent-teal: #36F1CD;
    --accent-yellow: #FFDE59;
    --accent-orange: #FF8A65;
    
    /* Success, Warning, Danger Colors */
    --success: #4CAF50;
    --success-light: #E8F5E9;
    --success-dark: #2E7D32;
    --success-rgb: 76, 175, 80;
    
    --warning: #FF9800;
    --warning-light: #FFF8E1;
    --warning-dark: #EF6C00;
    --warning-rgb: 255, 152, 0;
    
    --danger: #F44336;
    --danger-light: #FFEBEE;
    --danger-dark: #C62828;
    --danger-rgb: 244, 67, 54;
    
    /* Neutral Colors */
    --gray-50: #F9FAFB;
    --gray-100: #F3F4F6;
    --gray-200: #E5E7EB;
    --gray-300: #D1D5DB;
    --gray-400: #9CA3AF;
    --gray-500: #6B7280;
    --gray-600: #4B5563;
    --gray-700: #374151;
    --gray-800: #1F2937;
    --gray-900: #111827;
    
    /* Backgrounds */
    --light-sky: #E8F5FF;
    --light-star: #F8F9FE;
    --light-purple: #F5F3FF;
    --medium-purple: #E0E0FF;
    
    /* Gradients */
    --sky-gradient: linear-gradient(135deg, #87CEFA 0%, #6C9EFF 100%);
    --purple-gradient: linear-gradient(135deg, #9471FF 0%, #6C63FF 100%);
    --soft-gradient: linear-gradient(135deg, #E0E0FF 0%, #F5F3FF 100%);
    --sunset-gradient: linear-gradient(45deg, #6C63FF 0%, #FF6B8B 50%, #FFDE59 100%);
    --cosmic-gradient: linear-gradient(135deg, #1e0057 0%, #391e85 50%, #6C63FF 100%);
    --success-gradient: linear-gradient(135deg, #43A047 0%, #66BB6A 100%);
    --glass-gradient: linear-gradient(135deg, rgba(255, 255, 255, 0.5) 0%, rgba(255, 255, 255, 0.2) 100%);
    
    /* Typography */
    --body-font: <?php echo $isRtl ? '"Vazirmatn", sans-serif' : '"Plus Jakarta Sans", sans-serif'; ?>;
    --heading-font: <?php echo $isRtl ? '"Vazirmatn", sans-serif' : '"Plus Jakarta Sans", sans-serif'; ?>;
    --base-font-size: 16px;
    --base-line-height: 1.7;
    --heading-weight: 700;
    
    /* Spacing */
    --spacing-1: 0.25rem;
    --spacing-2: 0.5rem;
    --spacing-3: 0.75rem;
    --spacing-4: 1rem;
    --spacing-5: 1.25rem;
    --spacing-6: 1.5rem;
    --spacing-8: 2rem;
    --spacing-10: 2.5rem;
    --spacing-12: 3rem;
    --spacing-16: 4rem;
    --spacing-20: 5rem;
    
    --section-spacing: 6rem;
    --section-spacing-sm: 4rem;
    --content-spacing: 3rem;
    --element-spacing: 1.5rem;
    --gap-spacing: 1rem;
    
    /* Borders */
    --border-width: 1px;
    --border-width-md: 2px;
    --border-width-lg: 3px;
    --border-color: rgba(108, 99, 255, 0.1);
    --border-color-hover: rgba(108, 99, 255, 0.3);
    
    --border-radius-xs: 0.375rem;     /* 6px */
    --border-radius-sm: 0.625rem;     /* 10px */
    --border-radius: 1rem;            /* 16px */
    --border-radius-lg: 1.5rem;       /* 24px */
    --border-radius-xl: 2rem;         /* 32px */
    --border-radius-pill: 6.25rem;    /* 100px */
    --border-radius-circle: 50%;
    
    /* Shadows */
    --shadow-sm: 0 4px 10px rgba(0, 0, 0, 0.05);
    --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 20px 40px rgba(0, 0, 0, 0.15);
    --shadow-xl: 0 25px 50px rgba(0, 0, 0, 0.2);
    --glow-shadow: 0 0 20px rgba(108, 99, 255, 0.4);
    --purple-shadow: 0 5px 15px rgba(108, 99, 255, 0.3);
    --blue-shadow: 0 5px 15px rgba(108, 158, 255, 0.3);
    --success-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
    --inner-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.08);
    --text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    
    /* Transitions */
    --transition-fast: 0.25s cubic-bezier(0.25, 0.8, 0.25, 1);
    --transition-medium: 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
    --transition-slow: 0.7s cubic-bezier(0.25, 0.8, 0.25, 1);
    --transition-bounce: 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
    
    /* Z-indices */
    --z-negative: -1;
    --z-elevate: 1;
    --z-sticky: 100;
    --z-drawer: 200;
    --z-dropdown: 300;
    --z-modal: 400;
    --z-popover: 500;
    --z-tooltip: 600;
    --z-toast: 700;
    --z-overlay: 800;
}

/****************************
 * RESET & BASE STYLES
 ****************************/
*, *::before, *::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

html {
    font-size: var(--base-font-size);
    scroll-behavior: smooth;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

body {
    font-family: var(--body-font);
    font-size: 1rem;
    line-height: var(--base-line-height);
    color: var(--gray-700);
    background-color: #fff;
    overflow-x: hidden;
    position: relative;
}

/* Background stars effect */
body:before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    background-image: 
        radial-gradient(1px 1px at 20% 30%, rgba(150, 150, 255, 0.9) 0%, rgba(150, 150, 255, 0) 100%),
        radial-gradient(1px 1px at 40% 70%, rgba(150, 150, 255, 0.8) 0%, rgba(150, 150, 255, 0) 100%),
        radial-gradient(2px 2px at 90% 15%, rgba(150, 150, 255, 0.9) 0%, rgba(150, 150, 255, 0) 100%),
        radial-gradient(2px 2px at 15% 85%, rgba(150, 150, 255, 0.9) 0%, rgba(150, 150, 255, 0) 100%),
        radial-gradient(3px 3px at 60% 40%, rgba(150, 150, 255, 0.7) 0%, rgba(150, 150, 255, 0) 100%);
    background-size: 100% 100%;
    background-repeat: no-repeat;
    z-index: -2;
    opacity: 0.2;
}

h1, h2, h3, h4, h5, h6 {
    font-family: var(--heading-font);
    font-weight: var(--heading-weight);
    line-height: 1.3;
    color: var(--gray-900);
    margin-bottom: 1rem;
}

h1 {
    font-size: 3rem;
    line-height: 1.2;
}

h2 {
    font-size: 2.5rem;
    line-height: 1.25;
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

a {
    color: var(--primary);
    text-decoration: none;
    transition: color var(--transition-fast);
    position: relative;
}

a:hover {
    color: var(--primary-light);
}

a.underline-link {
    position: relative;
}

a.underline-link::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 2px;
    background: var(--purple-gradient);
    transition: width var(--transition-medium);
    border-radius: 1px;
}

a.underline-link:hover::after {
    width: 100%;
}

img {
    max-width: 100%;
    height: auto;
    vertical-align: middle;
}

/* Improved section spacing */
section {
    position: relative;
    padding: var(--section-spacing) 0;
    overflow: hidden;
}

/****************************
 * UTILITY CLASSES
 ****************************/
/* Background colors */
.bg-sky { background-color: var(--light-sky) !important; }
.bg-soft-purple { background-color: var(--light-purple) !important; }
.bg-medium-purple { background-color: var(--medium-purple) !important; }
.bg-white { background-color: #fff !important; }
.bg-success-light { background-color: var(--success-light) !important; }

/* Gradient backgrounds */
.bg-gradient-sky { background: var(--sky-gradient) !important; color: #fff; }
.bg-gradient-purple { background: var(--purple-gradient) !important; color: #fff; }
.bg-gradient-sunset { background: var(--sunset-gradient) !important; color: #fff; }
.bg-gradient-cosmic { background: var(--cosmic-gradient) !important; color: #fff; }
.bg-gradient-success { background: var(--success-gradient) !important; color: #fff; }

/* Glass morphism */
.glass-card {
    background: var(--glass-gradient);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
}

/* Text colors */
.text-gradient {
    background: var(--purple-gradient);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    color: var(--primary);
    display: inline-block;
    position: relative;
}

.text-gradient:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: linear-gradient(90deg, rgba(108, 99, 255, 0.2) 0%, rgba(108, 158, 255, 0.2) 100%);
    border-radius: 5px;
    z-index: -1;
}

.text-sky { color: var(--secondary) !important; }
.text-purple { color: var(--primary) !important; }
.text-pink { color: var(--accent-pink) !important; }
.text-white { color: #fff !important; }
.text-success { color: var(--success) !important; }

/* Border radius */
.rounded-xs { border-radius: var(--border-radius-xs) !important; }
.rounded-sm { border-radius: var(--border-radius-sm) !important; }
.rounded { border-radius: var(--border-radius) !important; }
.rounded-lg { border-radius: var(--border-radius-lg) !important; }
.rounded-xl { border-radius: var(--border-radius-xl) !important; }
.rounded-pill { border-radius: var(--border-radius-pill) !important; }
.rounded-circle { border-radius: var(--border-radius-circle) !important; }

/* Shadows */
.shadow-effect { box-shadow: var(--shadow) !important; }
.shadow-effect-lg { box-shadow: var(--shadow-lg) !important; }
.shadow-effect-xl { box-shadow: var(--shadow-xl) !important; }
.shadow-purple { box-shadow: var(--purple-shadow) !important; }
.shadow-blue { box-shadow: var(--blue-shadow) !important; }
.shadow-success { box-shadow: var(--success-shadow) !important; }
.shadow-inner { box-shadow: var(--inner-shadow) !important; }
.shadow-none { box-shadow: none !important; }

/* Z-index utilities */
.z-index-1 { z-index: 1; }
.z-index-2 { z-index: 2; }
.z-index-3 { z-index: 3; }
.z-index-n1 { z-index: -1; }

/* Position utilities */
.position-relative { position: relative; }
.position-absolute { position: absolute; }
.position-fixed { position: fixed; }

/* Enhanced spacing */
.mb-0-5 { margin-bottom: 0.5rem !important; }
.mb-1-5 { margin-bottom: 1.5rem !important; }
.mb-2-5 { margin-bottom: 2.5rem !important; }
.mt-0-5 { margin-top: 0.5rem !important; }
.mt-1-5 { margin-top: 1.5rem !important; }
.mt-2-5 { margin-top: 2.5rem !important; }

/* Width/Height utilities */
.min-h-100 { min-height: 100px; }
.min-h-200 { min-height: 200px; }
.min-h-300 { min-height: 300px; }
.min-h-400 { min-height: 400px; }
.min-h-500 { min-height: 500px; }

/****************************
 * ANIMATIONS
 ****************************/
@keyframes float {
    0% {
        transform: translateY(0) rotate(0deg);
    }
    50% {
        transform: translateY(-20px) rotate(2deg);
    }
    100% {
        transform: translateY(0) rotate(0deg);
    }
}

@keyframes float-reverse {
    0% {
        transform: translateY(0) rotate(0deg);
    }
    50% {
        transform: translateY(20px) rotate(-2deg);
    }
    100% {
        transform: translateY(0) rotate(0deg);
    }
}

@keyframes pulse {
    0% {
        transform: scale(1);
        opacity: 0.8;
    }
    50% {
        transform: scale(1.05);
        opacity: 0.5;
    }
    100% {
        transform: scale(1);
        opacity: 0.8;
    }
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

@keyframes meteor {
    0% {
        transform: translateX(300%) translateY(-300%) rotate(45deg);
        opacity: 1;
    }
    70% {
        opacity: 1;
    }
    100% {
        transform: translateX(-300%) translateY(300%) rotate(45deg);
        opacity: 0;
    }
}

@keyframes twinkle {
    0%, 100% { 
        opacity: 0.3; 
        transform: scale(1);
    }
    50% { 
        opacity: 1; 
        transform: scale(1.2);
    }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInLeft {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes fadeInRight {
    from {
        opacity: 0;
        transform: translateX(20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes zoomIn {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

/* Animation utility classes */
.floating {
    animation: float 6s ease-in-out infinite;
}

.floating-reverse {
    animation: float-reverse 7s ease-in-out infinite;
}

.pulsing {
    animation: pulse 2s ease-in-out infinite;
}

.spinning {
    animation: spin 15s linear infinite;
}

.rotating {
    transition: transform var(--transition-medium);
}

.rotating:hover {
    transform: rotate(15deg);
}

.fade-in-up {
    animation: fadeInUp 0.6s ease-out forwards;
}

.fade-in-down {
    animation: fadeInDown 0.6s ease-out forwards;
}

.fade-in-left {
    animation: fadeInLeft 0.6s ease-out forwards;
}

.fade-in-right {
    animation: fadeInRight 0.6s ease-out forwards;
}

.zoom-in {
    animation: zoomIn 0.6s ease-out forwards;
}

/* Animation delay utilities */
.delay-100 { animation-delay: 0.1s; }
.delay-200 { animation-delay: 0.2s; }
.delay-300 { animation-delay: 0.3s; }
.delay-400 { animation-delay: 0.4s; }
.delay-500 { animation-delay: 0.5s; }
.delay-600 { animation-delay: 0.6s; }
.delay-700 { animation-delay: 0.7s; }
.delay-800 { animation-delay: 0.8s; }
.delay-900 { animation-delay: 0.9s; }
.delay-1000 { animation-delay: 1s; }

/****************************
 * ENHANCED SHAPES
 ****************************/
.shape {
    position: absolute;
    pointer-events: none;
    z-index: 0;
}

.shape-circle {
    width: 200px;
    height: 200px;
    border-radius: var(--border-radius-circle);
    background: var(--soft-gradient);
    opacity: 0.5;
}

.shape-blob {
    width: 300px;
    height: 300px;
    background: var(--light-purple);
    border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
    opacity: 0.3;
    animation: float 15s ease-in-out infinite;
}

.shape-blob-small {
    width: 150px;
    height: 150px;
    background: var(--light-purple);
    border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
    opacity: 0.3;
    animation: float-reverse 12s ease-in-out infinite;
}

.shape-meteor {
    position: absolute;
    width: 100px;
    height: 2px;
    background: linear-gradient(90deg, var(--primary), transparent);
    opacity: 0.8;
    top: 20%;
    left: 10%;
    z-index: 0;
    animation: meteor 5s ease-in-out infinite;
    animation-delay: 2s;
}

.shape-meteor:before {
    content: '';
    position: absolute;
    width: 4px;
    height: 4px;
    border-radius: 50%;
    background: var(--primary);
    box-shadow: 0 0 10px var(--primary);
    left: 0;
    top: -1px;
}

.shape-meteor-2 {
    width: 150px;
    top: 40%;
    left: 70%;
    animation-delay: 3.5s;
}

.shape-meteor-3 {
    width: 120px;
    top: 60%;
    left: 30%;
    animation-delay: 5s;
}

/* Animated stars */
.star-field {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
}

.star {
    position: absolute;
    width: 2px;
    height: 2px;
    background-color: white;
    border-radius: 50%;
    animation: twinkle 2s infinite;
}

/****************************
 * BUTTONS
 ****************************/
.btn {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 12px 30px;
    font-weight: 600;
    font-size: 1rem;
    border-radius: var(--border-radius-pill);
    transition: all var(--transition-fast);
    border: none;
    cursor: pointer;
    overflow: hidden;
    z-index: 1;
    text-align: center;
    text-decoration: none;
}

.btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.1);
    z-index: -1;
    transform: translateY(100%);
    transition: transform var(--transition-fast);
}

.btn:hover::before {
    transform: translateY(0);
}

.btn i, .btn svg {
    margin-right: 10px;
    font-size: 1.125rem;
    transition: transform var(--transition-fast);
}

.rtl .btn i, .rtl .btn svg {
    margin-right: 0;
    margin-left: 10px;
}

.btn:hover i, .btn:hover svg {
    transform: translateX(5px);
}

.rtl .btn:hover i, .rtl .btn:hover svg {
    transform: translateX(-5px);
}

.btn-primary {
    background: var(--purple-gradient);
    color: #fff;
    box-shadow: var(--purple-shadow);
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}

.btn-primary:hover {
    color: #fff;
    box-shadow: 0 10px 20px rgba(108, 99, 255, 0.4);
    transform: translateY(-5px);
}

.btn-secondary {
    background: var(--sky-gradient);
    color: #fff;
    box-shadow: var(--blue-shadow);
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}

.btn-secondary:hover {
    color: #fff;
    box-shadow: 0 10px 20px rgba(108, 158, 255, 0.4);
    transform: translateY(-5px);
}

.btn-success {
    background: var(--success-gradient);
    color: #fff;
    box-shadow: var(--success-shadow);
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}

.btn-success:hover {
    color: #fff;
    box-shadow: 0 10px 20px rgba(76, 175, 80, 0.4);
    transform: translateY(-5px);
}

.btn-outline-primary {
    background-color: transparent;
    border: 2px solid var(--primary);
    color: var(--primary);
}

.btn-outline-primary:hover {
    background-color: var(--primary);
    color: #fff;
    transform: translateY(-5px);
}

.btn-outline-secondary {
    background-color: transparent;
    border: 2px solid var(--secondary);
    color: var(--secondary);
}

.btn-outline-secondary:hover {
    background-color: var(--secondary);
    color: #fff;
    transform: translateY(-5px);
}

.btn-light {
    background-color: #fff;
    color: var(--primary);
    box-shadow: var(--shadow);
}

.btn-light:hover {
    background-color: #f8f9ff;
    box-shadow: var(--shadow-lg);
    transform: translateY(-5px);
}

/* Button sizes */
.btn-lg {
    padding: 15px 35px;
    font-size: 1.125rem;
}

.btn-sm {
    padding: 8px 20px;
    font-size: 0.875rem;
}

.btn-xs {
    padding: 6px 15px;
    font-size: 0.75rem;
}

/* Button with icon */
.btn-icon {
    width: 48px;
    height: 48px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}

.btn-icon i, .btn-icon svg {
    margin: 0;
    font-size: 1.25rem;
}

.btn-icon.btn-sm {
    width: 36px;
    height: 36px;
}

.btn-icon.btn-lg {
    width: 60px;
    height: 60px;
}

/* Fixed action button */
.btn-fixed {
    position: fixed;
    right: 2rem;
    bottom: 2rem;
    z-index: 1000;
}

.rtl .btn-fixed {
    right: auto;
    left: 2rem;
}

/****************************
 * FORMS
 ****************************/
.form-group {
    margin-bottom: 1.5rem;
}

.form-control, .form-select {
    border: 2px solid #eeeeff;
    border-radius: var(--border-radius);
    padding: 0.85rem 1.2rem;
    transition: all var(--transition-fast);
    font-size: 1rem;
    background-color: #fafbff;
    line-height: 1.5;
    height: auto;
    color: #444;
    width: 100%;
}

.form-control:focus, .form-select:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(108, 99, 255, 0.15);
    background-color: white;
    outline: none;
}

.form-control::placeholder {
    color: #aab;
}

.form-control-lg, .form-select-lg {
    padding: 1rem 1.5rem;
    font-size: 1.125rem;
}

.form-control-sm, .form-select-sm {
    padding: 0.6rem 1rem;
    font-size: 0.875rem;
}

.form-label {
    font-weight: 600;
    margin-bottom: 0.6rem;
    color: #444;
    font-size: 0.95rem;
    display: block;
}

.form-text {
    font-size: 0.85rem;
    color: #778;
    margin-top: 0.5rem;
    display: block;
}

/* Required field indicator */
.required-field::after {
    content: '*';
    color: var(--accent-pink);
    margin-left: 4px;
    font-size: 1.1em;
}

.rtl .required-field::after {
    margin-left: 0;
    margin-right: 4px;
}

/* Form validation styles */
.is-invalid {
    border-color: var(--accent-pink) !important;
}

.is-valid {
    border-color: var(--success) !important;
}

.invalid-feedback {
    display: none;
    color: var(--accent-pink);
    font-size: 0.875rem;
    margin-top: 0.5rem;
}

.valid-feedback {
    display: none;
    color: var(--success);
    font-size: 0.875rem;
    margin-top: 0.5rem;
}

.was-validated .form-control:invalid, 
.form-control.is-invalid {
    border-color: var(--accent-pink);
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23dc3545' viewBox='0 0 12 12'%3E%3Ccircle cx='6' cy='6' r='4.5'/%3E%3Cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3E%3Ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right calc(0.375em + 0.1875rem) center;
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}

.rtl .was-validated .form-control:invalid, 
.rtl .form-control.is-invalid {
    background-position: left calc(0.375em + 0.1875rem) center;
}

.was-validated .form-control:valid, 
.form-control.is-valid {
    border-color: var(--success);
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8' viewBox='0 0 8 8'%3E%3Cpath fill='%2328a745' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right calc(0.375em + 0.1875rem) center;
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}

.rtl .was-validated .form-control:valid, 
.rtl .form-control.is-valid {
    background-position: left calc(0.375em + 0.1875rem) center;
}

.was-validated .form-check-input:invalid, 
.form-check-input.is-invalid {
    border-color: var(--accent-pink);
}

.was-validated .form-check-input:valid, 
.form-check-input.is-valid {
    border-color: var(--success);
}

/* Form check styles */
.form-check {
    position: relative;
    display: block;
    padding-left: 1.75rem;
    margin-bottom: 0.5rem;
}

.rtl .form-check {
    padding-left: 0;
    padding-right: 1.75rem;
}

.form-check-input {
    position: absolute;
    margin-top: 0.3rem;
    margin-left: -1.75rem;
}

.rtl .form-check-input {
    margin-left: 0;
    margin-right: -1.75rem;
}

.form-check-label {
    display: inline-block;
    margin-bottom: 0;
}

.form-check-inline {
    display: inline-flex;
    align-items: center;
    margin-right: 1rem;
}

.rtl .form-check-inline {
    margin-right: 0;
    margin-left: 1rem;
}

/* Custom checkbox & radio */
input[type="checkbox"], 
input[type="radio"] {
    --active-inner: #fff;
    --focus: 2px rgba(108, 99, 255, 0.3);
    --border: #bbc1e1;
    --border-hover: var(--primary);
    --background: #fff;
    --disabled: #f6f8ff;
    --disabled-inner: #e1e6f9;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    height: 21px;
    outline: none;
    display: inline-block;
    vertical-align: top;
    position: relative;
    margin: 0;
    cursor: pointer;
    border: 1px solid var(--border);
    background: var(--background);
    transition: background 0.3s, border-color 0.3s, box-shadow 0.2s;
}

input[type="checkbox"]:after, 
input[type="radio"]:after {
    content: "";
    display: block;
    left: 0;
    top: 0;
    position: absolute;
    transition: transform var(--transition-fast), opacity var(--transition-fast);
}

input[type="checkbox"]:checked, 
input[type="radio"]:checked {
    --border: var(--primary);
    --background: var(--primary);
}

input[type="checkbox"]:disabled, 
input[type="radio"]:disabled {
    --border: var(--disabled);
    cursor: not-allowed;
    opacity: 0.9;
}

input[type="checkbox"]:disabled:checked, 
input[type="radio"]:disabled:checked {
    --background: var(--disabled-inner);
    --border: var(--disabled);
}

input[type="checkbox"]:hover:not(:checked):not(:disabled), 
input[type="radio"]:hover:not(:checked):not(:disabled) {
    --border: var(--border-hover);
}

input[type="checkbox"] {
    width: 21px;
    border-radius: 4px;
}

input[type="checkbox"]:after {
    width: 5px;
    height: 9px;
    border: 2px solid var(--active-inner);
    border-top: 0;
    border-left: 0;
    left: 7px;
    top: 4px;
    transform: rotate(20deg);
    opacity: 0;
}

input[type="checkbox"]:checked:after {
    opacity: 1;
    transform: rotate(43deg);
}

input[type="radio"] {
    width: 21px;
    border-radius: 50%;
}

input[type="radio"]:after {
    width: 13px;
    height: 13px;
    border-radius: 50%;
    background: var(--active-inner);
    opacity: 0;
    transform: scale(0.7);
    left: 3px;
    top: 3px;
}

input[type="radio"]:checked:after {
    opacity: 1;
    transform: scale(1);
}

/****************************
 * CARDS
 ****************************/
.card {
    background: #fff;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    transition: transform var(--transition-medium), box-shadow var(--transition-medium);
    border: 1px solid rgba(108, 99, 255, 0.1);
    overflow: hidden;
    height: 100%;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.card-header {
    border-bottom: 1px solid rgba(108, 99, 255, 0.1);
    padding: 1.25rem 1.5rem;
    background-color: rgba(108, 99, 255, 0.03);
}

.card-body {
    padding: 1.5rem;
}

.card-footer {
    border-top: 1px solid rgba(108, 99, 255, 0.1);
    padding: 1.25rem 1.5rem;
    background-color: rgba(108, 99, 255, 0.03);
}

.card-title {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 0.75rem;
    color: #333;
}

.card-subtitle {
    font-size: 0.875rem;
    color: #666;
    margin-bottom: 0.75rem;
}

.card-text {
    color: #555;
    margin-bottom: 1rem;
}

.card-link {
    color: var(--primary);
}

.card-link:hover {
    color: var(--primary-light);
    text-decoration: underline;
}

.card-image-top {
    width: 100%;
    border-top-left-radius: var(--border-radius);
    border-top-right-radius: var(--border-radius);
}

.card-image-bottom {
    width: 100%;
    border-bottom-left-radius: var(--border-radius);
    border-bottom-right-radius: var(--border-radius);
}

/* Card Variations */
.card-primary {
    border-top: 4px solid var(--primary);
}

.card-secondary {
    border-top: 4px solid var(--secondary);
}

.card-success {
    border-top: 4px solid var(--success);
}

.card-gradient {
    background: linear-gradient(135deg, #fff 0%, #f8f9ff 100%);
}

/****************************
 * ALERTS
 ****************************/
.alert {
    position: relative;
    padding: 1.25rem 1.5rem;
    margin-bottom: 1.5rem;
    border: 1px solid transparent;
    border-radius: var(--border-radius);
    font-size: 0.95rem;
}

.alert-primary {
    color: var(--primary);
    background-color: rgba(108, 99, 255, 0.1);
    border-color: rgba(108, 99, 255, 0.2);
}

.alert-secondary {
    color: var(--secondary);
    background-color: rgba(108, 158, 255, 0.1);
    border-color: rgba(108, 158, 255, 0.2);
}

.alert-success {
    color: var(--success);
    background-color: rgba(76, 175, 80, 0.1);
    border-color: rgba(76, 175, 80, 0.2);
}

.alert-danger {
    color: var(--accent-pink);
    background-color: rgba(255, 107, 139, 0.1);
    border-color: rgba(255, 107, 139, 0.2);
}

.alert-warning {
    color: var(--accent-orange);
    background-color: rgba(255, 138, 101, 0.1);
    border-color: rgba(255, 138, 101, 0.2);
}

.alert-info {
    color: var(--accent-teal);
    background-color: rgba(54, 241, 205, 0.1);
    border-color: rgba(54, 241, 205, 0.2);
}

.alert-icon {
    display: flex;
    align-items: flex-start;
}

.alert-icon i, .alert-icon svg {
    margin-right: 1rem;
    font-size: 1.25rem;
    margin-top: 0.125rem;
}

.rtl .alert-icon i, .rtl .alert-icon svg {
    margin-right: 0;
    margin-left: 1rem;
}

.alert-heading {
    font-weight: 700;
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
}

.alert-dismissible {
    padding-right: 4rem;
}

.rtl .alert-dismissible {
    padding-right: 1.5rem;
    padding-left: 4rem;
}

.alert-dismissible .close {
    position: absolute;
    top: 0;
    right: 0;
    padding: 1.25rem 1.5rem;
    color: inherit;
    background: transparent;
    border: none;
    cursor: pointer;
    font-size: 1.5rem;
    line-height: 1;
}

.rtl .alert-dismissible .close {
    right: auto;
    left: 0;
}

/****************************
 * MODALS
 ****************************/
.modal-content {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-lg);
    overflow: hidden;
}

.modal-header {
    border-bottom: 1px solid rgba(108, 99, 255, 0.1);
    background: var(--purple-gradient);
    color: #fff;
    padding: 1.25rem 1.5rem;
}

.modal-title {
    font-weight: 700;
    font-size: 1.25rem;
    margin: 0;
}

.modal-body {
    padding: 1.5rem;
}

.modal-footer {
    border-top: 1px solid rgba(108, 99, 255, 0.1);
    padding: 1rem 1.5rem;
    background-color: rgba(108, 99, 255, 0.03);
}

.modal-backdrop {
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-dialog-centered {
    display: flex;
    align-items: center;
    min-height: calc(100% - 1rem);
}

.modal-dialog-scrollable {
    max-height: calc(100% - 1rem);
}

.modal-dialog-scrollable .modal-content {
    max-height: calc(100vh - 1rem);
}

.modal-dialog-scrollable .modal-body {
    overflow-y: auto;
}

.modal .close {
    color: #fff;
    opacity: 0.8;
    text-shadow: none;
    transition: all var(--transition-fast);
}

.modal .close:hover {
    opacity: 1;
    transform: rotate(90deg);
}

.modal .btn-close {
    opacity: 0.8;
    font-size: 1.5rem;
    transition: all var(--transition-fast);
}

.modal .btn-close:hover {
    opacity: 1;
    transform: rotate(90deg);
}

/****************************
 * SECTION STYLES
 ****************************/
.section-subtitle {
    position: relative;
    display: inline-block;
    font-weight: 600;
    font-size: 0.95rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: var(--primary);
    margin-bottom: 1rem;
    padding: 8px 20px;
    background: linear-gradient(135deg, rgba(108, 99, 255, 0.1) 0%, rgba(108, 158, 255, 0.1) 100%);
    border-radius: var(--border-radius-pill);
    z-index: 1;
}

.section-subtitle:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(108, 99, 255, 0.05) 0%, rgba(108, 158, 255, 0.05) 100%);
    border-radius: 50px;
    z-index: -1;
    animation: pulse 3s infinite;
}

.section-heading {
    position: relative;
    font-size: 2.75rem;
    font-weight: 800;
    margin-bottom: 1.5rem;
    line-height: 1.2;
    z-index: 1;
}

.section-heading span {
    position: relative;
    z-index: 1;
}

.section-heading span.text-underline {
    position: relative;
    z-index: 1;
}

.section-heading span.text-underline:after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 5px;
    width: 100%;
    height: 12px;
    background: linear-gradient(90deg, rgba(255, 222, 89, 0.5) 0%, rgba(255, 107, 139, 0.5) 100%);
    z-index: -1;
    transform: skewX(-5deg);
}

.section-description {
    font-size: 1.125rem;
    max-width: 800px;
    margin-bottom: 2.5rem;
}

.text-center .section-description {
    margin-left: auto;
    margin-right: auto;
}

.section-divider {
    position: relative;
    height: 4px;
    width: 80px;
    background: var(--purple-gradient);
    margin: 1.5rem 0;
    border-radius: var(--border-radius-pill);
}

.section-divider:before, .section-divider:after {
    content: '';
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    height: 4px;
    border-radius: 5px;
}

.section-divider:before {
    left: -40px;
    width: 30px;
    background: linear-gradient(90deg, rgba(108, 99, 255, 0) 0%, rgba(108, 99, 255, 0.5) 100%);
}

.section-divider:after {
    right: -40px;
    width: 30px;
    background: linear-gradient(90deg, rgba(108, 99, 255, 0.5) 0%, rgba(108, 99, 255, 0) 100%);
}

.text-center .section-divider {
    margin-left: auto;
    margin-right: auto;
}

/* Enhanced page header with layered effect */
.page-header {
    position: relative;
    padding: 150px 0 80px;
    text-align: center;
    overflow: hidden;
}

.page-header__bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    z-index: -1;
}

.page-header__bg::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: var(--cosmic-gradient);
    opacity: 0.85;
}

.page-header__inner {
    position: relative;
    z-index: 1;
    color: #fff;
}

.page-header h1 {
    color: #fff;
    font-size: 3.5rem;
    text-shadow: var(--text-shadow);
    margin-bottom: 1rem;
}

.page-header p {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1.2rem;
    max-width: 800px;
    margin: 0 auto;
}

/****************************
 * RESPONSIVE STYLES
 ****************************/
@media (max-width: 1199px) {
    :root {
        --section-spacing: 80px;
        --section-spacing-sm: 60px;
    }
    
    .section-heading {
        font-size: 2.5rem;
    }
}

@media (max-width: 991px) {
    :root {
        --section-spacing: 70px;
        --section-spacing-sm: 50px;
    }
    
    h1 {
        font-size: 2.75rem;
    }
    
    h2 {
        font-size: 2.25rem;
    }
    
    h3 {
        font-size: 1.75rem;
    }
    
    .section-heading {
        font-size: 2.25rem;
    }
    
    .section-description {
        font-size: 1.05rem;
    }
    
    .page-header h1 {
        font-size: 3rem;
    }
    
    .page-header p {
        font-size: 1.1rem;
    }
}

@media (max-width: 767px) {
    :root {
        --section-spacing: 60px;
        --section-spacing-sm: 40px;
    }
    
    h1 {
        font-size: 2.25rem;
    }
    
    h2 {
        font-size: 2rem;
    }
    
    h3 {
        font-size: 1.5rem;
    }
    
    .section-heading {
        font-size: 2rem;
    }
    
    .section-subtitle {
        font-size: 0.85rem;
    }
    
    .section-description {
        font-size: 1rem;
    }
    
    .page-header {
        padding: 120px 0 60px;
    }
    
    .page-header h1 {
        font-size: 2.5rem;
    }
    
    .page-header p {
        font-size: 1rem;
    }
}

@media (max-width: 575px) {
    :root {
        --section-spacing: 50px;
        --section-spacing-sm: 30px;
    }
    
    h1 {
        font-size: 2rem;
    }
    
    h2 {
        font-size: 1.75rem;
    }
    
    h3 {
        font-size: 1.5rem;
    }
    
    .section-heading {
        font-size: 1.75rem;
    }
    
    .page-header {
        padding: 100px 0 50px;
    }
    
    .page-header h1 {
        font-size: 2rem;
    }
    
    .page-header p {
        font-size: 0.95rem;
    }
}

/****************************
 * RTL SUPPORT
 ****************************/
/* Basic RTL fixes */
.rtl {
    direction: rtl;
    text-align: right;
}

.rtl .card-title::after {
    left: auto;
    right: 0;
}

.rtl .section-divider::before {
    left: auto;
    right: -40px;
    background: linear-gradient(90deg, rgba(108, 99, 255, 0.5) 0%, rgba(108, 99, 255, 0) 100%);
}

.rtl .section-divider::after {
    right: auto;
    left: -40px;
    background: linear-gradient(90deg, rgba(108, 99, 255, 0) 0%, rgba(108, 99, 255, 0.5) 100%);
}
/****************************
 * LOADING SPINNER
 ****************************/
.spinner-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    visibility: hidden;
    opacity: 0;
    transition: opacity 0.3s ease, visibility 0.3s ease;
    backdrop-filter: blur(5px);
}

.spinner-container.show {
    visibility: visible;
    opacity: 1;
}

.spinner {
    width: 50px;
    height: 50px;
    border: 5px solid #f3f3f3;
    border-top: 5px solid var(--primary);
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

/* Enhanced Loading Animation */
.loader {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
}

.loader div {
    position: absolute;
    top: 33px;
    width: 13px;
    height: 13px;
    border-radius: 50%;
    background: var(--primary);
    animation-timing-function: cubic-bezier(0, 1, 1, 0);
}

.loader div:nth-child(1) {
    left: 8px;
    animation: loader1 0.6s infinite;
}

.loader div:nth-child(2) {
    left: 8px;
    animation: loader2 0.6s infinite;
}

.loader div:nth-child(3) {
    left: 32px;
    animation: loader2 0.6s infinite;
}

.loader div:nth-child(4) {
    left: 56px;
    animation: loader3 0.6s infinite;
}

@keyframes loader1 {
    0% {
        transform: scale(0);
    }
    100% {
        transform: scale(1);
    }
}

@keyframes loader3 {
    0% {
        transform: scale(1);
    }
    100% {
        transform: scale(0);
    }
}

@keyframes loader2 {
    0% {
        transform: translate(0, 0);
    }
    100% {
        transform: translate(24px, 0);
    }
}
/* =========================
   PREMIUM FORM CONTROLS
   ========================= */

/* Base styles for form controls */
select, 
input[type="date"],
input[type="datetime-local"] {
    /* Core styling */
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    width: 100%;
    font-family: var(--body-font);
    font-size: 1rem;
    font-weight: 500;
    color: var(--gray-800);
    background-color: white;
    
    /* Borders and shape */
    border: 2px solid var(--gray-200);
    border-radius: var(--border-radius);
    padding: 0.85rem 1.2rem;
    height: 50px;
    
    /* Transitions for interactions */
    transition: all 0.2s ease-in-out;
    
    /* Box shadow for depth */
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}

/* Hover state */
select:hover, 
input[type="date"]:hover,
input[type="datetime-local"]:hover {
    border-color: var(--primary-light);
    background-color: #fafbff;
}

/* Focus state */
select:focus, 
input[type="date"]:focus,
input[type="datetime-local"]:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(var(--primary-rgb), 0.15);
    background-color: white;
}

/* Disabled state */
select:disabled, 
input[type="date"]:disabled,
input[type="datetime-local"]:disabled {
    background-color: var(--gray-100);
    border-color: var(--gray-200);
    color: var(--gray-500);
    cursor: not-allowed;
    opacity: 0.7;
}

/* ===== SELECT DROPDOWNS ===== */

/* Custom dropdown arrow */
select {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' stroke='%236C63FF' stroke-width='2' fill='none' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    background-size: 16px;
    padding-right: 42px;
}

/* RTL support for select arrows */
[dir="rtl"] select {
    background-position: left 14px center;
    padding-right: 1.2rem;
    padding-left: 42px;
    text-align: right;
}

/* Select focus state */
select:focus {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' stroke='%236C63FF' stroke-width='2' fill='none' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='18 15 12 9 6 15'%3E%3C/polyline%3E%3C/svg%3E");
}

/* Firefox specific select styling */
@-moz-document url-prefix() {
    select {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' stroke='%236C63FF' stroke-width='2' fill='none' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        text-overflow: ellipsis;
    }
    
    [dir="rtl"] select {
        background-position: 14px center;
    }
}

/* IE11 select fixes */
@media all and (-ms-high-contrast: none), (-ms-high-contrast: active) {
    select {
        background-image: none;
        padding-right: 1.2rem;
    }
    
    select::-ms-expand {
        display: none;
    }
}

/* ===== DATE PICKERS ===== */

/* Core date picker styling */
input[type="date"],
input[type="datetime-local"] {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' stroke='%236C63FF' stroke-width='2' fill='none' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='3' y='4' width='18' height='18' rx='2' ry='2'%3E%3C/rect%3E%3Cline x1='16' y1='2' x2='16' y2='6'%3E%3C/line%3E%3Cline x1='8' y1='2' x2='8' y2='6'%3E%3C/line%3E%3Cline x1='3' y1='10' x2='21' y2='10'%3E%3C/line%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    background-size: 16px;
    padding-right: 42px;
}

/* RTL support for date pickers */
[dir="rtl"] input[type="date"],
[dir="rtl"] input[type="datetime-local"] {
    background-position: left 14px center;
    padding-right: 1.2rem;
    padding-left: 42px;
    text-align: right;
}

/* Hide default calendar icon */
input::-webkit-calendar-picker-indicator {
    opacity: 0;
    width: 28px;
    height: 28px;
    cursor: pointer;
    position: absolute;
    right: 10px;
}

[dir="rtl"] input::-webkit-calendar-picker-indicator {
    right: auto;
    left: 10px;
}

/* Firefox specific date picker styling */
@-moz-document url-prefix() {
    input[type="date"],
    input[type="datetime-local"] {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' stroke='%236C63FF' stroke-width='2' fill='none' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='3' y='4' width='18' height='18' rx='2' ry='2'%3E%3C/rect%3E%3Cline x1='16' y1='2' x2='16' y2='6'%3E%3C/line%3E%3Cline x1='8' y1='2' x2='8' y2='6'%3E%3C/line%3E%3Cline x1='3' y1='10' x2='21' y2='10'%3E%3C/line%3E%3C/svg%3E");
    }
    
    [dir="rtl"] input[type="date"],
    [dir="rtl"] input[type="datetime-local"] {
        background-position: 14px center;
    }
}

/* Edge and IE fixes */
@supports (-ms-ime-align:auto) {
    input[type="date"],
    input[type="datetime-local"] {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' stroke='%236C63FF' stroke-width='2' fill='none' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='3' y='4' width='18' height='18' rx='2' ry='2'%3E%3C/rect%3E%3Cline x1='16' y1='2' x2='16' y2='6'%3E%3C/line%3E%3Cline x1='8' y1='2' x2='8' y2='6'%3E%3C/line%3E%3Cline x1='3' y1='10' x2='21' y2='10'%3E%3C/line%3E%3C/svg%3E");
    }
}

/* Webkit placeholder color */
select::-webkit-input-placeholder,
input[type="date"]::-webkit-input-placeholder {
    color: var(--gray-500);
}

/* Mozilla placeholder color */
select::-moz-placeholder,
input[type="date"]::-moz-placeholder {
    color: var(--gray-500);
}

/* ===== MULTI-SELECT STYLING ===== */
select[multiple] {
    height: auto;
    min-height: 120px;
    padding: 0.5rem;
    background-image: none;
}

select[multiple] option {
    padding: 0.5rem;
    border-radius: var(--border-radius-xs);
    margin-bottom: 2px;
    transition: background-color 0.2s;
}

select[multiple] option:checked {
    background-color: rgba(var(--primary-rgb), 0.1);
    color: var(--primary);
    font-weight: 500;
}

select[multiple] option:hover {
    background-color: var(--gray-100);
}

/* ===== PLACEHOLDER TEXT ===== */
select option[value=""][disabled] {
    color: var(--gray-500);
}

/* Special styling for empty date fields */
input[type="date"]:invalid::-webkit-datetime-edit,
input[type="datetime-local"]:invalid::-webkit-datetime-edit {
    color: var(--gray-500);
}

/* When date is selected, ensure text color is proper */
input[type="date"]:valid::-webkit-datetime-edit,
input[type="datetime-local"]:valid::-webkit-datetime-edit {
    color: var(--gray-800);
}

/* Responsive adjustments */
@media (max-width: 767px) {
    select,
    input[type="date"],
    input[type="datetime-local"] {
        font-size: 0.95rem;
        height: 48px;
        padding: 0.75rem 1rem;
    }
    
    select {
        padding-right: 36px;
        background-position: right 10px center;
        background-size: 14px;
    }
    
    [dir="rtl"] select {
        padding-left: 36px;
        padding-right: 1rem;
        background-position: left 10px center;
    }
    
    input[type="date"],
    input[type="datetime-local"] {
        padding-right: 36px;
        background-position: right 10px center;
        background-size: 14px;
    }
    
    [dir="rtl"] input[type="date"],
    [dir="rtl"] input[type="datetime-local"] {
        padding-left: 36px;
        padding-right: 1rem;
        background-position: left 10px center;
    }
}
</style>