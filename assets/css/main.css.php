<style>
    /* ╔═══════════════════════════════════════════════════════════════════════════════════════╗
   ║                     SALMAN EDUCATIONAL COMPLEX - ULTRA PROFESSIONAL CSS                ║
   ║                              نسخه فوق حرفه‌ای و تخصصی سیستم طراحی                      ║
   ║                                        Version 3.0.0                                   ║
   ╚═══════════════════════════════════════════════════════════════════════════════════════╝ */

/* =============================================================================
   TABLE OF CONTENTS
   =============================================================================
   1.  CSS Architecture Setup
   2.  Modern CSS Features & Browser Support
   3.  Advanced Design Tokens
   4.  Typography System
   5.  Color System & Theming
   6.  Spacing & Layout System
   7.  Advanced Animation System
   8.  Component Architecture
   9.  Utility Classes Generator
   10. Interactive States
   11. Advanced Patterns
   12. Performance Optimizations
   13. Accessibility Features
   14. Print & Media Queries
   15. Experimental Features
   ============================================================================= */

/* =============================================================================
   1. CSS ARCHITECTURE SETUP - معماری پیشرفته CSS
   ============================================================================= */

/* CSS Layers for Cascade Control */
@layer reset, base, tokens, theme, layout, components, patterns, utilities, states, overrides;

/* Import Modern Font Stack */
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200..800&display=swap');

/* =============================================================================
   2. MODERN CSS FEATURES & BROWSER SUPPORT
   ============================================================================= */

/* Enable Modern CSS Features */
@supports (animation-timeline: scroll()) {
    :root {
        --has-scroll-animations: true;
    }
}

@supports (color: color(display-p3 1 1 1)) {
    :root {
        --has-p3-colors: true;
    }
}

@supports (contain: layout style paint) {
    :root {
        --has-containment: true;
    }
}

/* =============================================================================
   3. ADVANCED DESIGN TOKENS - توکن‌های طراحی پیشرفته
   ============================================================================= */

@layer tokens {
    :root {
        /* ========== BRAND COLORS - رنگ‌های برند ========== */
        /* Primary Purple System */
        --primary-h: 243;
        --primary-s: 100%;
        --primary-l: 69%;
        --primary: hsl(var(--primary-h), var(--primary-s), var(--primary-l));
        --primary-rgb: 108, 99, 255;
        
        /* Extended Primary Palette */
        --primary-50: hsl(var(--primary-h), var(--primary-s), 97%);
        --primary-100: hsl(var(--primary-h), var(--primary-s), 94%);
        --primary-200: hsl(var(--primary-h), var(--primary-s), 89%);
        --primary-300: hsl(var(--primary-h), var(--primary-s), 82%);
        --primary-400: hsl(var(--primary-h), var(--primary-s), 74%);
        --primary-500: var(--primary); /* Base */
        --primary-600: hsl(var(--primary-h), var(--primary-s), 62%);
        --primary-700: hsl(var(--primary-h), var(--primary-s), 54%);
        --primary-800: hsl(var(--primary-h), var(--primary-s), 46%);
        --primary-900: hsl(var(--primary-h), var(--primary-s), 38%);
        --primary-950: hsl(var(--primary-h), var(--primary-s), 25%);
        
        /* Secondary Colors */
        --primary-color: #6941C6;
        --primary-light: #9E77ED;
        --primary-dark: #4E36B1;
        --secondary-color: #333333;
        --accent-color: #7F56D9;
        --accent-light: #9E77ED;
        --deep-purple: #6941C6;
        
        /* Vibrant Palette */
        --sky-blue: #6C9EFF;
        --light-blue: #87CEFA;
        --purple: #9471FF;
        --pink: #FF6B8B;
        --teal: #36F1CD;
        --yellow: #FFDE59;
        --orange: #FF7A1A
        
      
        /* ========== SEMANTIC COLORS ========== */
        --text-color: #333;
        --text-dark: #1E293B;
        --text-light: #666;
        --text-muted: #64748B;
        --text-white: #E2E8F0;
        --text-gray: #6B7280;
        --heading-color: #341897;
        
        /* State Colors with Alpha Variants */
        --success: #4CAF50;
        --success-rgb: 76, 175, 80;
        --success-light: rgba(var(--success-rgb), 0.1);
        --success-color: #10B981;
        
        --warning: #FFC107;
        --warning-rgb: 255, 193, 7;
        --warning-light: rgba(var(--warning-rgb), 0.1);
        --warning-color: #F59E0B;
        
        --danger: #F44336;
        --danger-rgb: 244, 67, 54;
        --danger-light: rgba(var(--danger-rgb), 0.1);
        --danger-color: #EF4444;
        
        --info-color: #17a2b8;
        --info-rgb: 23, 162, 184;
        
        /* ========== GRADIENTS - گرادیان‌های پیشرفته ========== */
        /* Core Gradients */
        --gradient-dark: linear-gradient(135deg, #0F172A 0%, #1E293B 60%, #334155 100%);
        --gradient-primary: linear-gradient(135deg, #4E36B1 0%, #6941C6 50%, #7F56D9 100%);
        --success-gradient: linear-gradient(135deg, #4CAF50 0%, #66BB6A 100%);
        --sky-gradient: linear-gradient(135deg, #87CEFA 0%, #6C9EFF 100%);
        --purple-gradient: linear-gradient(135deg, #9471FF 0%, #6C63FF 100%);
        --soft-gradient: linear-gradient(135deg, #E0E0FF 0%, #F5F3FF 100%);
        --sunset-gradient: linear-gradient(45deg, #6C63FF 0%, #FF6B8B 50%, #FFDE59 100%);
        
        /* Advanced Gradients */
        --cosmic-gradient: linear-gradient(135deg, #1e0057 0%, #391e85 50%, #6C63FF 100%);
        --cosmic-bg: linear-gradient(135deg, #0F172A 0%, #1E293B 60%, #334155 100%);
        
        /* Mesh Gradients */
        --gradient-mesh-purple: 
            radial-gradient(at 20% 30%, hsla(243, 100%, 69%, 0.3) 0px, transparent 50%),
            radial-gradient(at 80% 20%, hsla(254, 49%, 56%, 0.3) 0px, transparent 50%),
            radial-gradient(at 40% 80%, hsla(261, 53%, 60%, 0.3) 0px, transparent 50%),
            radial-gradient(at 90% 70%, hsla(243, 100%, 69%, 0.2) 0px, transparent 50%);
        
        /* Animated Gradients */
        --gradient-animated: linear-gradient(270deg, #6C63FF, #9471FF, #FF6B8B, #FFDE59, #36F1CD, #6C9EFF);
        --gradient-size: 600% 600%;
        
        /* ========== TYPOGRAPHY SYSTEM ========== */
        --font-system: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        --font-persian: 'Vazirmatn', 'Vazir', var(--font-system);
        --font-english: 'Plus Jakarta Sans', var(--font-system);
        --font-mono: 'Cascadia Code', 'Fira Code', 'Consolas', monospace;
        
        /* Font Stacks */
        --body-font: var(--font-english);
        --body-font-rtl: var(--font-persian);
        --heading-font: var(--font-english);
        --heading-font-rtl: var(--font-persian);
        
        /* Fluid Typography Scale */
        --font-size-xs: clamp(0.75rem, 0.7rem + 0.25vw, 0.875rem);
        --font-size-sm: clamp(0.875rem, 0.8rem + 0.375vw, 1rem);
        --font-size-base: clamp(1rem, 0.925rem + 0.375vw, 1.125rem);
        --font-size-md: clamp(1.125rem, 1rem + 0.625vw, 1.25rem);
        --font-size-lg: clamp(1.25rem, 1.125rem + 0.625vw, 1.5rem);
        --font-size-xl: clamp(1.5rem, 1.25rem + 1.25vw, 2rem);
        --font-size-2xl: clamp(1.875rem, 1.5rem + 1.875vw, 2.5rem);
        --font-size-3xl: clamp(2.25rem, 1.75rem + 2.5vw, 3rem);
        --font-size-4xl: clamp(3rem, 2rem + 5vw, 4rem);
        --font-size-5xl: clamp(3.75rem, 2.5rem + 6.25vw, 5rem);
        
        /* Font Weights */
        --font-weight-thin: 200;
        --font-weight-light: 300;
        --font-weight-regular: 400;
        --font-weight-medium: 500;
        --font-weight-semibold: 600;
        --font-weight-bold: 700;
        --font-weight-extrabold: 800;
        
        /* Line Heights */
        --line-height-none: 1;
        --line-height-tight: 1.25;
        --line-height-snug: 1.375;
        --line-height-normal: 1.5;
        --line-height-relaxed: 1.625;
        --line-height-loose: 1.75;
        --line-height-double: 2;
        
        /* Letter Spacing */
        --letter-spacing-tighter: -0.05em;
        --letter-spacing-tight: -0.025em;
        --letter-spacing-normal: 0;
        --letter-spacing-wide: 0.025em;
        --letter-spacing-wider: 0.05em;
        --letter-spacing-widest: 0.1em;
        
        /* ========== SPACING SYSTEM - سیستم فاصله‌گذاری ========== */
        --space-unit: 1rem;
        --space-scale: 1.5;
        
        /* Spacing Scale */
        --space-0: 0;
        --space-px: 1px;
        --space-0\.5: calc(var(--space-unit) * 0.125);
        --space-1: calc(var(--space-unit) * 0.25);
        --space-1\.5: calc(var(--space-unit) * 0.375);
        --space-2: calc(var(--space-unit) * 0.5);
        --space-2\.5: calc(var(--space-unit) * 0.625);
        --space-3: calc(var(--space-unit) * 0.75);
        --space-3\.5: calc(var(--space-unit) * 0.875);
        --space-4: calc(var(--space-unit) * 1);
        --space-5: calc(var(--space-unit) * 1.25);
        --space-6: calc(var(--space-unit) * 1.5);
        --space-7: calc(var(--space-unit) * 1.75);
        --space-8: calc(var(--space-unit) * 2);
        --space-9: calc(var(--space-unit) * 2.25);
        --space-10: calc(var(--space-unit) * 2.5);
        --space-11: calc(var(--space-unit) * 2.75);
        --space-12: calc(var(--space-unit) * 3);
        --space-14: calc(var(--space-unit) * 3.5);
        --space-16: calc(var(--space-unit) * 4);
        --space-20: calc(var(--space-unit) * 5);
        --space-24: calc(var(--space-unit) * 6);
        --space-28: calc(var(--space-unit) * 7);
        --space-32: calc(var(--space-unit) * 8);
        --space-36: calc(var(--space-unit) * 9);
        --space-40: calc(var(--space-unit) * 10);
        --space-44: calc(var(--space-unit) * 11);
        --space-48: calc(var(--space-unit) * 12);
        --space-52: calc(var(--space-unit) * 13);
        --space-56: calc(var(--space-unit) * 14);
        --space-60: calc(var(--space-unit) * 15);
        --space-64: calc(var(--space-unit) * 16);
        --space-72: calc(var(--space-unit) * 18);
        --space-80: calc(var(--space-unit) * 20);
        --space-96: calc(var(--space-unit) * 24);
        
        /* Fluid Spacing */
        --space-xs: clamp(var(--space-2), 2vw, var(--space-4));
        --space-sm: clamp(var(--space-3), 3vw, var(--space-6));
        --space-md: clamp(var(--space-4), 4vw, var(--space-8));
        --space-lg: clamp(var(--space-6), 5vw, var(--space-12));
        --space-xl: clamp(var(--space-8), 6vw, var(--space-16));
        --space-2xl: clamp(var(--space-12), 8vw, var(--space-24));
        --space-3xl: clamp(var(--space-16), 10vw, var(--space-32));
        --space-4xl: clamp(var(--space-24), 12vw, var(--space-48));
        --space-5xl: clamp(var(--space-32), 15vw, var(--space-64));
        
        /* Legacy Spacing (for compatibility) */
        --section-spacing: var(--space-5xl);
        --section-spacing-sm: var(--space-4xl);
        --content-spacing: var(--space-3xl);
        --element-spacing: var(--space-2xl);
        --gap-spacing: var(--space-lg);
        
        /* ========== LAYOUT SYSTEM ========== */
        /* Container Widths */
        --container-xs: 475px;
        --container-sm: 640px;
        --container-md: 768px;
        --container-lg: 1024px;
        --container-xl: 1280px;
        --container-2xl: 1536px;
        --container-max: 1200px;
        
        /* Grid System */
        --grid-columns: 12;
        --grid-gap: var(--space-6);
        --grid-margin: var(--space-4);
        
        /* ========== BORDER RADIUS SYSTEM ========== */
        --radius-none: 0;
        --radius-sm: 0.125rem;
        --radius-base: 0.25rem;
        --radius-md: 0.375rem;
        --radius-lg: 0.5rem;
        --radius-xl: 0.75rem;
        --radius-2xl: 1rem;
        --radius-3xl: 1.5rem;
        --radius-full: 9999px;
        
        /* Legacy Radius (for compatibility) */
        --border-radius-xs: var(--radius-sm);
        --border-radius-sm: var(--radius-md);
        --border-radius: var(--radius-2xl);
        --border-radius-lg: var(--radius-3xl);
        --border-radius-xl: 1.5rem;
        --border-radius-pill: var(--radius-full);
        --border-radius-circle: 50%;
        
        /* ========== SHADOW SYSTEM - سیستم سایه پیشرفته ========== */
        /* Shadow Colors */
        --shadow-color: 243deg 10% 50%;
        --shadow-color-primary: 243deg 100% 69%;
        
        /* Elevation Shadows */
        --shadow-xs: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
        --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        --shadow-inner: inset 0 2px 4px 0 rgba(0, 0, 0, 0.05);
        
        /* Realistic Shadows */
        --shadow-elevation-low:
            0.3px 0.5px 0.7px hsl(var(--shadow-color) / 0.1),
            0.4px 0.8px 1px -1.2px hsl(var(--shadow-color) / 0.1),
            1px 2px 2.5px -2.5px hsl(var(--shadow-color) / 0.1);
        
        --shadow-elevation-medium:
            0.3px 0.5px 0.7px hsl(var(--shadow-color) / 0.11),
            0.8px 1.6px 2px -0.8px hsl(var(--shadow-color) / 0.11),
            2.1px 4.1px 5.2px -1.7px hsl(var(--shadow-color) / 0.11),
            5px 10px 12.6px -2.5px hsl(var(--shadow-color) / 0.11);
        
        --shadow-elevation-high:
            0.3px 0.5px 0.7px hsl(var(--shadow-color) / 0.1),
            1.5px 2.9px 3.7px -0.4px hsl(var(--shadow-color) / 0.1),
            2.7px 5.4px 6.8px -0.7px hsl(var(--shadow-color) / 0.1),
            4.5px 8.9px 11.2px -1.1px hsl(var(--shadow-color) / 0.1),
            7.1px 14.3px 18px -1.4px hsl(var(--shadow-color) / 0.1),
            11.2px 22.3px 28.1px -1.8px hsl(var(--shadow-color) / 0.1),
            17px 33.9px 42.7px -2.1px hsl(var(--shadow-color) / 0.1),
            25px 50px 62.9px -2.5px hsl(var(--shadow-color) / 0.1);
        
        /* Colored Shadows */
        --shadow-primary: 0 10px 40px -10px rgba(var(--primary-rgb), 0.35);
        --shadow-primary-lg: 0 20px 50px -15px rgba(var(--primary-rgb), 0.45);
        --shadow-success: 0 10px 40px -10px rgba(var(--success-rgb), 0.35);
        --shadow-danger: 0 10px 40px -10px rgba(var(--danger-rgb), 0.35);
        
        /* Legacy Shadows (for compatibility) */
        --shadow: var(--shadow-md);
        --card-shadow: var(--shadow-elevation-low);
        --card-shadow-light: var(--shadow-sm);
        --card-shadow-hover: var(--shadow-elevation-medium);
        --card-shadow-strong: var(--shadow-elevation-high);
        --box-shadow: var(--shadow-lg);
        --box-shadow-light: var(--shadow-md);
        --box-shadow-strong: var(--shadow-xl);
        --purple-shadow: var(--shadow-primary);
        --blue-shadow: 0 5px 15px rgba(108, 158, 255, 0.2);
        --success-shadow: var(--shadow-success);
        
        /* ========== ANIMATION SYSTEM ========== */
        /* Durations */
        --duration-instant: 50ms;
        --duration-faster: 100ms;
        --duration-fast: 150ms;
        --duration-normal: 200ms;
        --duration-slow: 300ms;
        --duration-slower: 400ms;
        --duration-slowest: 500ms;
        
        /* Legacy Durations */
        --animation-duration: var(--duration-slow);
        --transition: all var(--duration-slow) ease;
        --transition-fast: all var(--duration-normal) ease;
        
        /* Timing Functions */
        --ease-linear: linear;
        --ease-in: cubic-bezier(0.4, 0, 1, 1);
        --ease-out: cubic-bezier(0, 0, 0.2, 1);
        --ease-in-out: cubic-bezier(0.4, 0, 0.2, 1);
        
        /* Advanced Easings */
        --ease-out-expo: cubic-bezier(0.16, 1, 0.3, 1);
        --ease-out-quint: cubic-bezier(0.22, 1, 0.36, 1);
        --ease-out-back: cubic-bezier(0.34, 1.56, 0.64, 1);
        --ease-in-out-back: cubic-bezier(0.68, -0.6, 0.32, 1.6);
        --ease-elastic: cubic-bezier(0.68, -0.55, 0.265, 1.55);
        --ease-bounce: cubic-bezier(0.87, -0.41, 0.19, 1.44);
        
        /* Spring Physics */
        --spring-1: cubic-bezier(0.175, 0.885, 0.32, 1.275);
        --spring-2: cubic-bezier(0.68, -0.55, 0.265, 1.55);
        --spring-3: cubic-bezier(0.155, 1.105, 0.295, 1.12);
        --spring-4: cubic-bezier(0.23, 1, 0.32, 1);
        --spring-5: cubic-bezier(0.39, 0.575, 0.565, 1);
        
        /* Legacy Timing */
        --transition-cubic: all var(--duration-slow) var(--ease-in-out);
        
        /* ========== Z-INDEX SYSTEM ========== */
        --z-min: -1;
        --z-1: 100;
        --z-2: 200;
        --z-3: 300;
        --z-4: 400;
        --z-5: 500;
        --z-10: 1000;
        --z-11: 1100;
        --z-20: 2000;
        --z-30: 3000;
        --z-40: 4000;
        --z-50: 5000;
        --z-max: 9999;
        
        /* Semantic Z-Index */
        --z-dropdown: var(--z-10);
        --z-sticky: var(--z-11);
        --z-fixed: var(--z-20);
        --z-modal-backdrop: var(--z-30);
        --z-modal: var(--z-40);
        --z-popover: var(--z-40);
        --z-tooltip: var(--z-50);
        
        /* ========== BACKGROUND SYSTEM ========== */
        --white: #ffffff;
        --black: #000000;
        --transparent: transparent;
        
        /* Background Colors */
        --bg-primary: #f9f9f9;
        --bg-light: #f8f9fa;
        --background-color: #F9FAFB;
        --light-sky: #E8F5FF;
        --light-star: #F8F9FE;
        --light-purple-bg: #F5F3FF;
        --medium-purple-bg: #E0E0FF;
        --dark-color: #0F172A;
        --dark-light: #334155;
        --light-color: #F8FAFC;
        --light-purple: rgba(108, 99, 255, 0.05);
        
        /* Gray Scale */
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
        --gray-950: #030712;
        
        /* ========== SPECIAL THEME COLORS ========== */
        --management-color: #2563EB;
        --teaching-color: #8B5CF6;
        --support-color: #10B981;
        --special-color: #F59E0B;
        
        /* ========== GLASS MORPHISM ========== */
        --glass-bg: rgba(255, 255, 255, 0.9);
        --glass-bg-dark: rgba(0, 0, 0, 0.9);
        --glass-border: rgba(255, 255, 255, 0.18);
        --glass-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        --glass-hover-bg: rgba(30, 64, 175, 0.95);
        --glass-blur: blur(10px);
        --glass-blur-heavy: blur(20px);
        
        /* ========== FILTERS & EFFECTS ========== */
        --blur-sm: blur(4px);
        --blur: blur(8px);
        --blur-md: blur(12px);
        --blur-lg: blur(16px);
        --blur-xl: blur(24px);
        --blur-2xl: blur(40px);
        --blur-3xl: blur(64px);
        
        --brightness-0: brightness(0);
        --brightness-50: brightness(0.5);
        --brightness-75: brightness(0.75);
        --brightness-90: brightness(0.9);
        --brightness-95: brightness(0.95);
        --brightness-100: brightness(1);
        --brightness-105: brightness(1.05);
        --brightness-110: brightness(1.1);
        --brightness-125: brightness(1.25);
        --brightness-150: brightness(1.5);
        --brightness-200: brightness(2);
     /* Display P3 Color Gamut (for supported displays) */
        @supports (color: color(display-p3 1 1 1)) {
            --primary-p3: color(display-p3 0.424 0.388 1);
            --sky-blue-p3: color(display-p3 0.424 0.62 1);
            --pink-p3: color(display-p3 1 0.42 0.545);
        }
        
    }
    
}

/* =============================================================================
   4. TYPOGRAPHY SYSTEM - سیستم تایپوگرافی پیشرفته
   ============================================================================= */

@layer base {
    /* Font Face Declarations */
    @font-face {
        font-family: 'Vazir';
        src: url('assets/fonts/Vazir.eot');
        src: url('assets/fonts/Vazir.eot?#iefix') format('embedded-opentype'),
             url('assets/fonts/Vazir.woff2') format('woff2'),
             url('assets/fonts/Vazir.woff') format('woff'),
             url('assets/fonts/Vazir.ttf') format('truetype');
        font-weight: normal;
        font-style: normal;
        font-display: swap;
        size-adjust: 98%;
    }
    
    @font-face {
        font-family: 'Vazir';
        src: url('assets/fonts/Vazir-Bold.eot');
        src: url('assets/fonts/Vazir-Bold.eot?#iefix') format('embedded-opentype'),
             url('assets/fonts/Vazir-Bold.woff2') format('woff2'),
             url('assets/fonts/Vazir-Bold.woff') format('woff'),
             url('assets/fonts/Vazir-Bold.ttf') format('truetype');
        font-weight: bold;
        font-style: normal;
        font-display: swap;
        size-adjust: 98%;
    }
    
    @font-face {
        font-family: 'Vazirmatn';
        src: url('assets/fonts/Vazirmatn-Regular.woff2') format('woff2');
        font-weight: 400;
        font-style: normal;
        font-display: swap;
        size-adjust: 98%;
    }
    
    /* Base Typography */
    * {
        min-height: 0;
        font-variant-ligatures: none;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-rendering: optimizeLegibility;
    }
    
    html {
        font-size: var(--base-font-size);
        line-height: var(--base-line-height);
        -webkit-text-size-adjust: 100%;
        text-size-adjust: 100%;
        scroll-behavior: smooth;
        scroll-padding-top: var(--space-20);
    }
    
    body {
        font-family: var(--body-font);
        font-size: var(--font-size-base);
        line-height: var(--line-height-relaxed);
        color: var(--text-gray);
        background-color: var(--white);
        font-feature-settings: "kern" 1, "liga" 1, "calt" 1;
        overflow-x: hidden;
        position: relative;
        margin: 0;
        padding: 0;
    }
    
    /* RTL Typography */
    [dir="rtl"] body {
        font-family: var(--body-font-rtl);
        letter-spacing: 0;
    }
    
    /* Headings Typography Scale */
    h1, h2, h3, h4, h5, h6 {
        font-family: var(--heading-font);
        font-weight: var(--font-weight-bold);
        line-height: var(--line-height-tight);
        color: var(--text-color);
        margin-top: 0;
        margin-bottom: var(--space-4);
        letter-spacing: var(--letter-spacing-tight);
    }
    
    [dir="rtl"] h1, [dir="rtl"] h2, [dir="rtl"] h3, 
    [dir="rtl"] h4, [dir="rtl"] h5, [dir="rtl"] h6 {
        font-family: var(--heading-font-rtl);
        letter-spacing: 0;
    }
    
    h1 { 
        font-size: var(--font-size-4xl);
        font-weight: var(--font-weight-extrabold);
        line-height: var(--line-height-none);
    }
    
    h2 { 
        font-size: var(--font-size-3xl);
        font-weight: var(--font-weight-bold);
    }
    
    h3 { 
        font-size: var(--font-size-2xl);
        font-weight: var(--font-weight-bold);
    }
    
    h4 { 
        font-size: var(--font-size-xl);
        font-weight: var(--font-weight-semibold);
    }
    
    h5 { 
        font-size: var(--font-size-lg);
        font-weight: var(--font-weight-semibold);
    }
    
    h6 { 
        font-size: var(--font-size-md);
        font-weight: var(--font-weight-medium);
    }
    
    /* Paragraph Styles */
    p {
        margin-top: 0;
        margin-bottom: var(--space-6);
        max-width: 65ch;
    }
    
    p:last-child {
        margin-bottom: 0;
    }
    
    /* Links */
    a {
        color: var(--deep-purple);
        text-decoration: none;
        text-underline-offset: 0.2em;
        transition: color var(--transition-fast);
    }
    
    a:hover {
        color: var(--purple);
        text-decoration: underline;
    }
    
    a:focus-visible {
        outline: 2px solid var(--deep-purple);
        outline-offset: 2px;
        border-radius: var(--radius-sm);
    }
    
    /* Lists */
    ul, ol {
        margin-top: 0;
        margin-bottom: var(--space-6);
        padding-left: var(--space-8);
    }
    
    [dir="rtl"] ul, [dir="rtl"] ol {
        padding-left: 0;
        padding-right: var(--space-8);
    }
    
    li {
        margin-bottom: var(--space-2);
    }
    
    /* Blockquote */
    blockquote {
        margin: var(--space-8) 0;
        padding: var(--space-6);
        border-left: 4px solid var(--deep-purple);
        background-color: var(--light-purple);
        font-style: italic;
        border-radius: var(--radius-lg);
    }
    
    [dir="rtl"] blockquote {
        border-left: none;
        border-right: 4px solid var(--deep-purple);
    }
    
    /* Code */
    code {
        font-family: var(--font-mono);
        font-size: 0.875em;
        background-color: var(--gray-100);
        padding: 0.125em 0.25em;
        border-radius: var(--radius-sm);
    }
    
    pre {
        font-family: var(--font-mono);
        font-size: 0.875em;
        background-color: var(--gray-900);
        color: var(--gray-100);
        padding: var(--space-6);
        border-radius: var(--radius-lg);
        overflow-x: auto;
        line-height: var(--line-height-relaxed);
    }
    
    pre code {
        background-color: transparent;
        padding: 0;
    }
    
    /* Selection */
    ::selection {
        background-color: rgba(var(--primary-rgb), 0.3);
        color: var(--text-color);
    }
    
    /* Placeholder */
    ::placeholder {
        color: var(--text-muted);
        opacity: 1;
    }
}

/* =============================================================================
   5. COLOR SYSTEM & THEMING - سیستم رنگ و تم
   ============================================================================= */

@layer theme {
    /* Dark Mode Variables */
    [data-theme="dark"] {
        --text-color: #E2E8F0;
        --text-dark: #F8FAFC;
        --text-light: #CBD5E1;
        --text-muted: #94A3B8;
        --text-gray: #E2E8F0;
        --heading-color: #E0E0FF;
        
        --white: #0F172A;
        --bg-primary: #0F172A;
        --bg-light: #1E293B;
        --background-color: #0F172A;
        --light-sky: #1E293B;
        --light-star: #1E293B;
        --light-purple-bg: rgba(108, 99, 255, 0.1);
        --medium-purple-bg: rgba(108, 99, 255, 0.2);
        
        --gray-50: #0F172A;
        --gray-100: #1E293B;
        --gray-200: #334155;
        --gray-300: #475569;
        --gray-400: #64748B;
        --gray-500: #94A3B8;
        --gray-600: #CBD5E1;
        --gray-700: #E2E8F0;
        --gray-800: #F1F5F9;
        --gray-900: #F8FAFC;
        
        --shadow-color: 0deg 0% 0%;
        --glass-bg: rgba(255, 255, 255, 0.05);
        --glass-border: rgba(255, 255, 255, 0.1);
    }
    
    /* High Contrast Mode */
    @media (prefers-contrast: high) {
        :root {
            --text-color: #000000;
            --text-dark: #000000;
            --heading-color: #000000;
            --white: #FFFFFF;
            --bg-primary: #FFFFFF;
        }
    }
    
    /* Reduced Motion */
    @media (prefers-reduced-motion: reduce) {
        * {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }
}

/* =============================================================================
   6. LAYOUT SYSTEM - سیستم چیدمان
   ============================================================================= */

@layer layout {
    /* Box Sizing */
    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }
    
    /* Container System */
    .container {
        width: 100%;
        margin-inline: auto;
        padding-inline: var(--space-4);
    }
    
    @media (min-width: 475px) {
        .container { max-width: var(--container-xs); }
    }
    
    @media (min-width: 640px) {
        .container { max-width: var(--container-sm); }
    }
    
    @media (min-width: 768px) {
        .container { max-width: var(--container-md); }
    }
    
    @media (min-width: 1024px) {
        .container { max-width: var(--container-lg); }
    }
    
    @media (min-width: 1280px) {
        .container { max-width: var(--container-xl); }
    }
    
    @media (min-width: 1536px) {
        .container { max-width: var(--container-2xl); }
    }
    
    /* Fluid Container */
    .container-fluid {
        width: 100%;
        padding-inline: var(--space-4);
    }
    
    /* Legacy Container */
    .container-legacy {
        max-width: var(--container-max);
        margin: 0 auto;
        padding: 0 15px;
    }
    
    /* Section Spacing */
    section {
        position: relative;
        padding-block: var(--section-spacing);
        overflow: hidden;
    }
    
    @media (max-width: 991px) {
        section {
            padding-block: var(--section-spacing-sm);
        }
    }
    
    /* Grid System */
    .grid {
        display: grid;
        gap: var(--grid-gap);
    }
    
    .grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)); }
    .grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    .grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
    .grid-cols-5 { grid-template-columns: repeat(5, minmax(0, 1fr)); }
    .grid-cols-6 { grid-template-columns: repeat(6, minmax(0, 1fr)); }
    .grid-cols-7 { grid-template-columns: repeat(7, minmax(0, 1fr)); }
    .grid-cols-8 { grid-template-columns: repeat(8, minmax(0, 1fr)); }
    .grid-cols-9 { grid-template-columns: repeat(9, minmax(0, 1fr)); }
    .grid-cols-10 { grid-template-columns: repeat(10, minmax(0, 1fr)); }
    .grid-cols-11 { grid-template-columns: repeat(11, minmax(0, 1fr)); }
    .grid-cols-12 { grid-template-columns: repeat(12, minmax(0, 1fr)); }
    
    /* Auto Grid */
    .grid-auto-fit {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }
    
    .grid-auto-fill {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    }
    
    /* Flexbox System */
    .flex { display: flex; }
    .inline-flex { display: inline-flex; }
    
    .flex-row { flex-direction: row; }
    .flex-row-reverse { flex-direction: row-reverse; }
    .flex-col { flex-direction: column; }
    .flex-col-reverse { flex-direction: column-reverse; }
    
    .flex-wrap { flex-wrap: wrap; }
    .flex-wrap-reverse { flex-wrap: wrap-reverse; }
    .flex-nowrap { flex-wrap: nowrap; }
    
    .items-start { align-items: flex-start; }
    .items-end { align-items: flex-end; }
    .items-center { align-items: center; }
    .items-baseline { align-items: baseline; }
    .items-stretch { align-items: stretch; }
    
    .justify-start { justify-content: flex-start; }
    .justify-end { justify-content: flex-end; }
    .justify-center { justify-content: center; }
    .justify-between { justify-content: space-between; }
    .justify-around { justify-content: space-around; }
    .justify-evenly { justify-content: space-evenly; }
    
    /* Gap Utilities */
    .gap-0 { gap: 0; }
    .gap-px { gap: 1px; }
    .gap-0\.5 { gap: var(--space-0\.5); }
    .gap-1 { gap: var(--space-1); }
    .gap-1\.5 { gap: var(--space-1\.5); }
    .gap-2 { gap: var(--space-2); }
    .gap-2\.5 { gap: var(--space-2\.5); }
    .gap-3 { gap: var(--space-3); }
    .gap-3\.5 { gap: var(--space-3\.5); }
    .gap-4 { gap: var(--space-4); }
    .gap-5 { gap: var(--space-5); }
    .gap-6 { gap: var(--space-6); }
    .gap-7 { gap: var(--space-7); }
    .gap-8 { gap: var(--space-8); }
    .gap-9 { gap: var(--space-9); }
    .gap-10 { gap: var(--space-10); }
    .gap-11 { gap: var(--space-11); }
    .gap-12 { gap: var(--space-12); }
    .gap-14 { gap: var(--space-14); }
    .gap-16 { gap: var(--space-16); }
    .gap-20 { gap: var(--space-20); }
    
    /* Position Utilities */
    .static { position: static; }
    .fixed { position: fixed; }
    .absolute { position: absolute; }
    .relative { position: relative; }
    .sticky { position: sticky; }
    
    /* Z-Index Utilities */
    .z-0 { z-index: 0; }
    .z-10 { z-index: 10; }
    .z-20 { z-index: 20; }
    .z-30 { z-index: 30; }
    .z-40 { z-index: 40; }
    .z-50 { z-index: 50; }
    .z-auto { z-index: auto; }
}

/* =============================================================================
   7. ADVANCED ANIMATION SYSTEM - سیستم انیمیشن پیشرفته
   ============================================================================= */

@layer components {
    /* Keyframe Animations */
    @keyframes fadeIn {
        from { 
            opacity: 0;
        }
        to { 
            opacity: 1;
        }
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes slideDown {
        from { 
            opacity: 0;
            transform: translateY(-20px);
        }
        to { 
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes slideUp {
        from { 
            opacity: 0;
            transform: translateY(20px);
        }
        to { 
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    @keyframes scaleOut {
        from {
            opacity: 1;
            transform: scale(1);
        }
        to {
            opacity: 0;
            transform: scale(0.9);
        }
    }
    
    @keyframes rotateIn {
        from {
            transform: rotate(-10deg);
            opacity: 0;
        }
        to {
            transform: rotate(0);
            opacity: 1;
        }
    }
    
    @keyframes float {
        0%, 100% { 
            transform: translateY(0); 
        }
        50% { 
            transform: translateY(-20px); 
        }
    }
    
    @keyframes floatEffect {
        0% { 
            transform: translateY(0px); 
        }
        50% { 
            transform: translateY(-10px); 
        }
        100% { 
            transform: translateY(0px); 
        }
    }
    
    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.05);
            opacity: 0.8;
        }
    }
    
    @keyframes ping {
        75%, 100% {
            transform: scale(2);
            opacity: 0;
        }
    }
    
    @keyframes spin {
        from { 
            transform: rotate(0deg); 
        }
        to { 
            transform: rotate(360deg); 
        }
    }
    
    @keyframes bounce {
        0%, 100% {
            transform: translateY(-25%);
            animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
        }
        50% {
            transform: translateY(0);
            animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
        }
    }
    
    @keyframes shake {
        0%, 100% {
            transform: translateX(0);
        }
        10%, 30%, 50%, 70%, 90% {
            transform: translateX(-10px);
        }
        20%, 40%, 60%, 80% {
            transform: translateX(10px);
        }
    }
    
    @keyframes twinkle {
        0% { 
            opacity: 0.2; 
            transform: scale(1); 
        }
        50% { 
            opacity: 0.7; 
            transform: scale(1.1); 
        }
        100% { 
            opacity: 1; 
            transform: scale(1); 
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
    
    @keyframes shooting {
        0% { 
            transform: translateX(-100px) translateY(300px) rotate(-45deg); 
            opacity: 1; 
        }
        15% { 
            opacity: 1; 
        }
        20% { 
            transform: translateX(300px) translateY(-100px) rotate(-45deg); 
            opacity: 0; 
        }
        100% { 
            opacity: 0; 
        }
    }
    
    @keyframes cosmic-rotate {
        from { 
            transform: rotate(0deg); 
        }
        to { 
            transform: rotate(360deg); 
        }
    }
    
    @keyframes gradient-shift {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }
    
    @keyframes morph {
        0% {
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
        }
        50% {
            border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%;
        }
        100% {
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
        }
    }
    
    @keyframes glow {
        0%, 100% {
            box-shadow: 0 0 5px var(--primary),
                        0 0 10px var(--primary),
                        0 0 15px var(--primary);
        }
        50% {
            box-shadow: 0 0 10px var(--primary),
                        0 0 20px var(--primary),
                        0 0 30px var(--primary);
        }
    }
    
    /* Scroll-triggered Animations */
    @supports (animation-timeline: scroll()) {
        @keyframes reveal-on-scroll {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .scroll-reveal {
            animation: reveal-on-scroll linear both;
            animation-timeline: view();
            animation-range: entry 0% cover 40%;
        }
    }
    
    /* Animation Classes */
    .animate-fadeIn {
        animation: fadeIn var(--duration-slow) var(--ease-out) both;
    }
    
    .animate-fadeInUp {
        animation: fadeInUp var(--duration-slow) var(--ease-out-back) both;
    }
    
    .animate-fadeInDown {
        animation: fadeInDown var(--duration-slow) var(--ease-out-back) both;
    }
    
    .animate-fadeInLeft {
        animation: fadeInLeft var(--duration-slow) var(--ease-out-back) both;
    }
    
    .animate-fadeInRight {
        animation: fadeInRight var(--duration-slow) var(--ease-out-back) both;
    }
    
    .animate-scaleIn {
        animation: scaleIn var(--duration-slow) var(--ease-out-back) both;
    }
    
    .animate-rotateIn {
        animation: rotateIn var(--duration-slow) var(--ease-out-back) both;
    }
    
    .animate-float {
        animation: float 6s var(--ease-in-out) infinite;
    }
    
    .animate-pulse {
        animation: pulse 2s var(--ease-in-out) infinite;
    }
    
    .animate-ping {
        animation: ping 1s cubic-bezier(0, 0, 0.2, 1) infinite;
    }
    
    .animate-spin {
        animation: spin 1s linear infinite;
    }
    
    .animate-bounce {
        animation: bounce 1s infinite;
    }
    
    .animate-gradient {
        background: var(--gradient-animated);
        background-size: var(--gradient-size);
        animation: gradient-shift 15s ease infinite;
    }
    
    /* Animation Delays */
    .delay-100 { animation-delay: 100ms; }
    .delay-200 { animation-delay: 200ms; }
    .delay-300 { animation-delay: 300ms; }
    .delay-400 { animation-delay: 400ms; }
    .delay-500 { animation-delay: 500ms; }
    .delay-600 { animation-delay: 600ms; }
    .delay-700 { animation-delay: 700ms; }
    .delay-800 { animation-delay: 800ms; }
    .delay-900 { animation-delay: 900ms; }
    .delay-1000 { animation-delay: 1000ms; }
    
    /* Legacy Animation Classes */
    .floating {
        animation: float 6s ease-in-out infinite;
    }
    
    .pulsing {
        animation: pulse 2s ease-in-out infinite;
    }
    
    .spinning {
        animation: spin 15s linear infinite;
    }
}

/* =============================================================================
   8. COMPONENT ARCHITECTURE - معماری کامپوننت‌ها
   ============================================================================= */

@layer components {
    /* ========== BUTTON SYSTEM ========== */
    .btn {
        --btn-padding-x: var(--space-6);
        --btn-padding-y: var(--space-3);
        --btn-font-size: var(--font-size-base);
        --btn-font-weight: var(--font-weight-semibold);
        --btn-line-height: var(--line-height-tight);
        --btn-border-radius: var(--radius-full);
        --btn-border-width: 2px;
        --btn-transition: all var(--duration-normal) var(--ease-out);
        
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: var(--space-2);
        padding: var(--btn-padding-y) var(--btn-padding-x);
        font-family: inherit;
        font-size: var(--btn-font-size);
        font-weight: var(--btn-font-weight);
        line-height: var(--btn-line-height);
        text-align: center;
        text-decoration: none;
        white-space: nowrap;
        vertical-align: middle;
        cursor: pointer;
        user-select: none;
        border: var(--btn-border-width) solid transparent;
        border-radius: var(--btn-border-radius);
        transition: var(--btn-transition);
        transform: translateZ(0);
        overflow: hidden;
        isolation: isolate;
        -webkit-tap-highlight-color: transparent;
    }
    
    .btn:focus-visible {
        outline: 2px solid var(--primary);
        outline-offset: 2px;
    }
    
    .btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        pointer-events: none;
    }
    
    /* Button Ripple Effect */
    .btn::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 70%);
        transform: scale(0);
        opacity: 0;
        transition: transform var(--duration-slow) var(--ease-out),
                    opacity var(--duration-slow) var(--ease-out);
        pointer-events: none;
    }
    
    .btn:active::before {
        transform: scale(2);
        opacity: 1;
        transition: 0s;
    }
    
    /* Button Variants */
    .btn-primary {
        background: var(--gradient-primary);
        color: var(--white);
        border-color: transparent;
        box-shadow: var(--shadow-primary);
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-primary-lg);
    }
    
    .btn-primary:active {
        transform: translateY(0);
    }
    
    .btn-secondary {
        background: var(--sky-gradient);
        color: var(--white);
        border-color: transparent;
        box-shadow: var(--blue-shadow);
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }
    
    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(108, 158, 255, 0.4);
    }
    
    .btn-secondary:active {
        transform: translateY(0);
    }
    
    .btn-outline {
        background-color: transparent;
        color: var(--deep-purple);
        border-color: var(--deep-purple);
        position: relative;
        overflow: hidden;
    }
    
    .btn-outline::after {
        content: '';
        position: absolute;
        inset: 0;
        background: var(--deep-purple);
        transform: scaleX(0);
        transform-origin: right;
        transition: transform var(--duration-slow) var(--ease-out-expo);
        z-index: -1;
    }
    
    .btn-outline:hover {
        color: var(--white);
        transform: translateY(-2px);
    }
    
    .btn-outline:hover::after {
        transform: scaleX(1);
        transform-origin: left;
    }
    
    .btn-ghost {
        background-color: transparent;
        color: var(--deep-purple);
        border-color: transparent;
    }
    
    .btn-ghost:hover {
        background-color: var(--light-purple);
    }
    
    .btn-light {
        background-color: var(--white);
        color: var(--deep-purple);
        border-color: transparent;
        box-shadow: var(--shadow-md);
    }
    
    .btn-light:hover {
        background-color: var(--gray-50);
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }
    
    /* Button Sizes */
    .btn-xs {
        --btn-padding-x: var(--space-3);
        --btn-padding-y: var(--space-1);
        --btn-font-size: var(--font-size-xs);
    }
    
    .btn-sm {
        --btn-padding-x: var(--space-4);
        --btn-padding-y: var(--space-2);
        --btn-font-size: var(--font-size-sm);
    }
    
    .btn-lg {
        --btn-padding-x: var(--space-8);
        --btn-padding-y: var(--space-4);
        --btn-font-size: var(--font-size-lg);
    }
    
    .btn-xl {
        --btn-padding-x: var(--space-10);
        --btn-padding-y: var(--space-5);
        --btn-font-size: var(--font-size-xl);
    }
    
    /* Button Icons */
    .btn i,
    .btn svg {
        font-size: 1.125em;
        transition: transform var(--transition-fast);
    }
    
    .btn:hover i,
    .btn:hover svg {
        transform: translateX(3px);
    }
    
    [dir="rtl"] .btn:hover i,
    [dir="rtl"] .btn:hover svg {
        transform: translateX(-3px);
    }
    
    /* ========== CARD SYSTEM ========== */
    .card {
        --card-padding: var(--space-6);
        --card-border-radius: var(--radius-2xl);
        --card-background: var(--white);
        --card-border: 1px solid var(--gray-200);
        --card-shadow: var(--shadow-elevation-low);
        
        position: relative;
        padding: var(--card-padding);
        background: var(--card-background);
        border: var(--card-border);
        border-radius: var(--card-border-radius);
        box-shadow: var(--card-shadow);
        transition: all var(--duration-normal) var(--ease-out);
        overflow: hidden;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-elevation-medium);
    }
    
    /* Card Variants */
    .card-elevated {
        --card-border: none;
        --card-shadow: var(--shadow-elevation-medium);
    }
    
    .card-outlined {
        --card-shadow: none;
        --card-border: 2px solid var(--gray-300);
    }
    
    .card-ghost {
        --card-background: transparent;
        --card-border: none;
        --card-shadow: none;
    }
    
    .card-gradient {
        --card-background: var(--gradient-soft);
        --card-border: none;
    }
    
    /* Glass Card */
    .card-glass {
        --card-background: var(--glass-bg);
        --card-border: 1px solid var(--glass-border);
        --card-shadow: var(--glass-shadow);
        
        backdrop-filter: var(--glass-blur);
        -webkit-backdrop-filter: var(--glass-blur);
    }
    
    /* Card Sizes */
    .card-sm {
        --card-padding: var(--space-4);
        --card-border-radius: var(--radius-lg);
    }
    
    .card-lg {
        --card-padding: var(--space-8);
        --card-border-radius: var(--radius-3xl);
    }
    
    /* Card Components */
    .card-header {
        margin: calc(var(--card-padding) * -1);
        margin-bottom: var(--card-padding);
        padding: var(--card-padding);
        border-bottom: 1px solid var(--gray-200);
    }
    
    .card-footer {
        margin: calc(var(--card-padding) * -1);
        margin-top: var(--card-padding);
        padding: var(--card-padding);
        border-top: 1px solid var(--gray-200);
        background-color: var(--gray-50);
    }
    
    .card-title {
        font-size: var(--font-size-xl);
        font-weight: var(--font-weight-bold);
        margin-bottom: var(--space-2);
    }
    
    .card-subtitle {
        font-size: var(--font-size-sm);
        color: var(--text-muted);
        margin-bottom: var(--space-4);
    }
    
    .card-body {
        color: var(--text-gray);
        line-height: var(--line-height-relaxed);
    }
    
    /* ========== BADGE SYSTEM ========== */
    .badge {
        --badge-padding-x: var(--space-3);
        --badge-padding-y: var(--space-1);
        --badge-font-size: var(--font-size-xs);
        --badge-font-weight: var(--font-weight-medium);
        --badge-border-radius: var(--radius-full);
        
        display: inline-flex;
        align-items: center;
        gap: var(--space-1);
        padding: var(--badge-padding-y) var(--badge-padding-x);
        font-size: var(--badge-font-size);
        font-weight: var(--badge-font-weight);
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: var(--badge-border-radius);
        transition: all var(--duration-fast) var(--ease-out);
    }
    
    /* Badge Variants */
    .badge-primary {
        background-color: var(--primary-100);
        color: var(--primary-700);
    }
    
    .badge-secondary {
        background-color: var(--gray-100);
        color: var(--gray-700);
    }
    
    .badge-success {
        background-color: var(--success-light);
        color: var(--success);
    }
    
    .badge-warning {
        background-color: var(--warning-light);
        color: var(--warning);
    }
    
    .badge-danger {
        background-color: var(--danger-light);
        color: var(--danger);
    }
    
    .badge-info {
        background-color: rgba(var(--info-rgb), 0.1);
        color: var(--info-color);
    }
    
    /* Badge Sizes */
    .badge-sm {
        --badge-padding-x: var(--space-2);
        --badge-padding-y: var(--space-0\.5);
        --badge-font-size: 0.75rem;
    }
    
    .badge-lg {
        --badge-padding-x: var(--space-4);
        --badge-padding-y: var(--space-1\.5);
        --badge-font-size: var(--font-size-sm);
    }
    
    /* ========== INPUT SYSTEM ========== */
    .form-control {
        --input-padding-x: var(--space-4);
        --input-padding-y: var(--space-3);
        --input-font-size: var(--font-size-base);
        --input-line-height: var(--line-height-normal);
        --input-border-radius: var(--radius-lg);
        --input-border-width: 2px;
        --input-border-color: var(--gray-300);
        --input-background: var(--white);
        --input-focus-border-color: var(--primary);
        --input-focus-shadow: 0 0 0 3px rgba(var(--primary-rgb), 0.1);
        
        display: block;
        width: 100%;
        padding: var(--input-padding-y) var(--input-padding-x);
        font-family: inherit;
        font-size: var(--input-font-size);
        font-weight: var(--font-weight-regular);
        line-height: var(--input-line-height);
        color: var(--text-color);
        background-color: var(--input-background);
        background-clip: padding-box;
        border: var(--input-border-width) solid var(--input-border-color);
        border-radius: var(--input-border-radius);
        transition: border-color var(--duration-fast) var(--ease-out),
                    box-shadow var(--duration-fast) var(--ease-out);
        appearance: none;
    }
    
    .form-control:focus {
        outline: 0;
        border-color: var(--input-focus-border-color);
        box-shadow: var(--input-focus-shadow);
    }
    
    .form-control::placeholder {
        color: var(--text-muted);
        opacity: 1;
    }
    
    .form-control:disabled {
        background-color: var(--gray-100);
        opacity: 0.65;
        cursor: not-allowed;
    }
    
    /* Input Sizes */
    .form-control-sm {
        --input-padding-x: var(--space-3);
        --input-padding-y: var(--space-2);
        --input-font-size: var(--font-size-sm);
        --input-border-radius: var(--radius-md);
    }
    
    .form-control-lg {
        --input-padding-x: var(--space-5);
        --input-padding-y: var(--space-4);
        --input-font-size: var(--font-size-lg);
        --input-border-radius: var(--radius-xl);
    }
    
    /* Form Label */
    .form-label {
        display: inline-block;
        margin-bottom: var(--space-2);
        font-size: var(--font-size-sm);
        font-weight: var(--font-weight-medium);
        color: var(--text-dark);
    }
    
    /* Form Group */
    .form-group {
        margin-bottom: var(--space-6);
    }
    
    /* ========== HEADER COMPONENT ========== */
            .cosmic-header {
            background: 
                radial-gradient(ellipse at 20% 10%, rgba(138, 43, 226, 0.8) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 90%, rgba(147, 51, 234, 0.6) 0%, transparent 50%),
                radial-gradient(ellipse at 50% 30%, rgba(139, 69, 19, 0.4) 0%, transparent 40%),
                linear-gradient(135deg, 
                    #0a0525 0%, 
                    #1a0b3d 20%, 
                    #2d1b69 40%, 
                    #4c1d95 60%, 
                    #6b21a8 80%, 
                    #7c3aed 100%);
            position: relative;
            overflow: hidden;
            color: var(--white);
            text-align: center;
            padding: 80px 0 140px;
            width: 100%;
            min-height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* پس‌زمینه کیهانی */
        .cosmic-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            opacity: 0.8;
            z-index: 1;
        }

        /* ستاره‌های متحرک */
        .cosmic-star {
            position: absolute;
            background-color: #fff;
            border-radius: 50%;
            animation: twinkle var(--animation-duration) infinite alternate;
        }

        /* ستاره‌های بهتر */
        .cosmic-star:nth-child(1) { top: 15%; left: 8%; width: 3px; height: 3px; animation-delay: 0s; }
        .cosmic-star:nth-child(2) { top: 25%; left: 18%; width: 1px; height: 1px; animation-delay: 0.5s; }
        .cosmic-star:nth-child(3) { top: 8%; left: 28%; width: 2px; height: 2px; animation-delay: 1s; }
        .cosmic-star:nth-child(4) { top: 35%; left: 35%; width: 1px; height: 1px; animation-delay: 1.5s; }
        .cosmic-star:nth-child(5) { top: 55%; left: 12%; width: 2px; height: 2px; animation-delay: 2s; }
        .cosmic-star:nth-child(6) { top: 12%; left: 55%; width: 3px; height: 3px; animation-delay: 0.3s; }
        .cosmic-star:nth-child(7) { top: 45%; left: 65%; width: 1px; height: 1px; animation-delay: 0.8s; }
        .cosmic-star:nth-child(8) { top: 75%; left: 22%; width: 2px; height: 2px; animation-delay: 1.3s; }
        .cosmic-star:nth-child(9) { top: 22%; left: 75%; width: 1px; height: 1px; animation-delay: 1.8s; }
        .cosmic-star:nth-child(10) { top: 65%; left: 85%; width: 3px; height: 3px; animation-delay: 2.3s; }
        .cosmic-star:nth-child(11) { top: 5%; left: 45%; width: 1px; height: 1px; animation-delay: 0.7s; }
        .cosmic-star:nth-child(12) { top: 85%; left: 5%; width: 2px; height: 2px; animation-delay: 1.7s; }

        /* دنباله‌دار زیبا */
        .comet {
            position: absolute;
            top: 5%;
            left: -50px;
            width: 4px;
            height: 4px;
            background: radial-gradient(circle, #ffffff 0%, #a855f7 50%, transparent 100%);
            border-radius: 50%;
            z-index: 4;
            animation: cometFly 20s linear infinite;
        }

        .comet::before {
            content: '';
            position: absolute;
            top: -1px;
            left: -60px;
            width: 60px;
            height: 6px;
            background: linear-gradient(90deg, 
                transparent 0%, 
                rgba(168, 85, 247, 0.3) 30%, 
                rgba(255, 255, 255, 0.8) 80%, 
                #ffffff 100%);
            border-radius: 3px;
            filter: blur(1px);
        }

        @keyframes cometFly {
            0% { 
                transform: translate(-50px, 0px); 
                opacity: 0; 
            }
            10% { 
                opacity: 1; 
            }
            90% { 
                opacity: 1; 
            }
            100% { 
                transform: translate(calc(100vw + 50px), 350px); 
                opacity: 0; 
            }
        }

        @keyframes twinkle {
            from { opacity: 0.3; transform: scale(1); }
            to { opacity: 1; transform: scale(1.2); }
        }

        /* ستاره‌های پس‌زمینه با pseudo-elements */
        .cosmic-bg::before, 
        .cosmic-bg::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle, rgba(255,255,255,0.8) 1px, transparent 1px),
                radial-gradient(circle, rgba(255,255,255,0.5) 1px, transparent 1px),
                radial-gradient(circle, rgba(255,255,255,0.3) 1px, transparent 1px);
            background-size: 
                100px 100px,
                150px 150px,
                200px 200px;
            animation: cosmic-rotate 100s linear infinite;
        }

        .cosmic-bg::after {
            background-size: 
                120px 120px,
                170px 170px,
                220px 220px;
            animation-duration: 150s;
            animation-direction: reverse;
        }

        @keyframes cosmic-rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* سیارات حرفه‌ای مشابه تصویر */
        .cosmic-planet {
            position: absolute;
            border-radius: 50%;
            opacity: 0.25;
            filter: blur(120px);
            z-index: 1;
        }

        .cosmic-planet:nth-child(1) {
            top: -80px;
            left: -120px;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle at 30% 30%, #ff0080, #8b5cf6, #3b82f6);
            animation: planetFloat 20s ease-in-out infinite;
        }

        .cosmic-planet:nth-child(2) {
            bottom: -100px;
            right: -100px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle at 40% 20%, #7c3aed, #a855f7, #ec4899);
            animation: planetFloat 25s ease-in-out infinite reverse;
        }

        .cosmic-planet:nth-child(3) {
            top: 10%;
            right: 15%;
            width: 250px;
            height: 250px;
            background: radial-gradient(circle at 50% 30%, #06b6d4, #8b5cf6, #d946ef);
            animation: planetFloat 22s ease-in-out infinite;
            opacity: 0.2;
        }

        .cosmic-planet:nth-child(4) {
            top: 60%;
            left: 10%;
            width: 180px;
            height: 180px;
            background: radial-gradient(circle at 60% 40%, #f59e0b, #ef4444, #8b5cf6);
            animation: planetFloat 18s ease-in-out infinite reverse;
            opacity: 0.15;
        }

        @keyframes planetFloat {
            0%, 100% { transform: translateY(0px) translateX(0px); }
            33% { transform: translateY(-20px) translateX(10px); }
            66% { transform: translateY(10px) translateX(-5px); }
        }

        /* اورلی برای کنتراست بهتر */
        .content-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(ellipse at center, transparent 30%, rgba(0, 0, 0, 0.3) 70%),
                linear-gradient(to bottom, 
                    rgba(0, 0, 0, 0.2) 0%,
                    rgba(0, 0, 0, 0.4) 100%);
            z-index: 2;
        }

        /* محتوای اصلی */
        .header-content {
            position: relative;
            z-index: 10;
            max-width: 1000px;
            width: 100%;
            padding: 0 2rem;
        }

        /* تایتل با کنتراست عالی */
        .header-title {
            font-size: 3.8rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            color: #ffffff;
            text-shadow: 
                0 2px 4px rgba(0, 0, 0, 0.8),
                0 4px 8px rgba(0, 0, 0, 0.6),
                0 8px 16px rgba(0, 0, 0, 0.4);
            letter-spacing: -0.02em;
            line-height: 1.1;
        }

        /* ساب‌تایتل خوانا */
        .header-subtitle {
            font-size: 1.5rem;
            max-width: 800px;
            margin: 0 auto 40px;
            opacity: 0.95;
            color: #ffffff;
            text-shadow: 
                0 1px 2px rgba(0, 0, 0, 0.8),
                0 2px 4px rgba(0, 0, 0, 0.6);
            line-height: 1.6;
            font-weight: 400;
        }





        /* محتوای نمونه */
        .demo-content {
            padding: 4rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
            background: #f8f9fa;
            color: #333;
        }

        .demo-content h2 {
            font-size: 2.5rem;
            margin-bottom: 2rem;
            color: #2c3e50;
            font-weight: 700;
        }

        .demo-content p {
            font-size: 1.125rem;
            line-height: 1.8;
            color: #666;
            max-width: 800px;
            margin: 0 auto;
        }

        /* ریسپانسیو */
        @media (max-width: 768px) {
            .cosmic-header {
                padding: 60px 0 100px;
                min-height: 60vh;
            }

            .header-content {
                padding: 0 1rem;
            }

            .header-title {
                font-size: 2.8rem;
            }

            .header-subtitle {
                font-size: 1.3rem;
            }

            .cosmic-planet:nth-child(1) {
                width: 250px;
                height: 250px;
            }

            .cosmic-planet:nth-child(2) {
                width: 300px;
                height: 300px;
            }

            .cosmic-planet:nth-child(3) {
                width: 180px;
                height: 180px;
            }

            .cosmic-planet:nth-child(4) {
                width: 130px;
                height: 130px;
            }
        }

        @media (max-width: 480px) {
            .cosmic-header {
                padding: 50px 0 80px;
            }

            .header-title {
                font-size: 2.2rem;
            }

            .header-subtitle {
                font-size: 1.1rem;
            }

            .header-cta {
                flex-direction: column;
                align-items: center;
            }
        }

        /* انیمیشن بارگذاری */
        .cosmic-header {
            animation: headerFadeIn 1.5s ease-out;
        }

        @keyframes headerFadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .mountain-header {
            position: relative;
            width: 100%; /* حالا این ۱۰۰٪ عرض کل صفحه است */
            height: 70vh;
            min-height: 500px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #1a1a2e;
        }
      .mountain-header lottie-player {
            pointer-events: none;
        }
        /* Cosmic Stars Background */    
        /* Option 2: Using Image Fallback */
        .image-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            object-fit: cover;
            object-position: top center;
        }
        
        /* Option 3: CSS Gradient Background */
        .gradient-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                to bottom,
                #1e3c72 0%,
                #2a5298 40%,
                #7e8ba3 70%,
                #e8ddc7 100%
            );
            z-index: 1;
        }
        
        /* Mountain Shapes with CSS */
        .mountain-shape {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60%;
            background: #2c3e50;
            clip-path: polygon(
                0% 100%,
                0% 60%,
                15% 40%,
                30% 55%,
                45% 20%,
                60% 45%,
                75% 35%,
                90% 50%,
                100% 40%,
                100% 100%
            );
            z-index: 2;
        }
        
        .mountain-shape-2 {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 50%;
            background: #34495e;
            clip-path: polygon(
                0% 100%,
                0% 70%,
                20% 50%,
                35% 65%,
                50% 30%,
                65% 55%,
                80% 45%,
                100% 60%,
                100% 100%
            );
            z-index: 3;
        }
        
        /* Overlay for better text contrast */
        .header-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to bottom,
                rgba(0, 0, 0, 0.5) 0%,
                rgba(0, 0, 0, 0.3) 50%,
                rgba(0, 0, 0, 0.2) 100%
            );
            z-index: 4;
        }
        
        /* Content Container */
        .header-content {
            position: relative;
            z-index: 5;
            text-align: center;
            max-width: 900px;
            width: 100%;
        }
        
        /* Glass Container */
             .glass-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 3rem 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }
        
        /* .glass-container {
            background: rgba(0, 0, 0, 0.30);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 3rem 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }*/
        /* Title */
        .header-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: #ffffff;
            margin: 0 0 1.5rem 0;
            text-shadow: 0 3px 6px rgba(0, 0, 0, 0.7);
            letter-spacing: -0.02em;
            line-height: 1.1;
        }
        
        /* Subtitle */
        .header-subtitle {
            font-size: 1.5rem;
            font-weight: 400;
            color: rgba(255, 255, 255, 0.9);
            max-width: 700px;
            margin: 0 auto 2rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
            line-height: 1.6;
        }
        
        /* CTA Buttons */
        .header-cta {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 2rem;
        }
        
        .cta-button {
            padding: 14px 32px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 50px;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .cta-button:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
        
        /* Demo Content */
        .content-section {
            padding: 4rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }
        
        .content-section h2 {
            font-size: 2.5rem;
            margin-bottom: 2rem;
            color: #333;
        }
        
        .content-section p {
            font-size: 1.125rem;
            line-height: 1.8;
            color: #666;
            max-width: 800px;
            margin: 0 auto;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .header-title {
                font-size: 2.5rem;
            }
            
            .header-subtitle {
                font-size: 1.25rem;
            }
            
            .glass-container {
                padding: 2rem 1.5rem;
            }
        }
    /* ========== FEATURE COMPONENTS ========== */
    .feature-item {
        display: flex;
        align-items: flex-start;
        gap: var(--space-5);
        margin-bottom: var(--space-6);
        transition: all var(--duration-normal) var(--ease-out);
    }
    
    .feature-item:hover {
        transform: translateX(5px);
    }
    
    [dir="rtl"] .feature-item:hover {
        transform: translateX(-5px);
    }
    
    .feature-icon {
        flex-shrink: 0;
        width: 50px;
        height: 50px;
        background: var(--gradient-primary);
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: var(--shadow-primary);
        transition: all var(--duration-normal) var(--ease-out);
    }
    
    .feature-item:hover .feature-icon {
        transform: scale(1.1) rotate(5deg);
    }
    
    .feature-icon i {
        color: var(--white);
        font-size: 22px;
    }
    
    .feature-content {
        flex: 1;
    }
    
    .feature-title {
        font-size: var(--font-size-lg);
        font-weight: var(--font-weight-semibold);
        margin-bottom: var(--space-2);
        color: var(--text-dark);
    }
    
    .feature-description {
        font-size: var(--font-size-base);
        color: var(--text-gray);
        line-height: var(--line-height-relaxed);
    }
    
    /* ========== SECTION COMPONENTS ========== */
    .section-subtitle {
        position: relative;
        display: inline-block;
        font-weight: var(--font-weight-semibold);
        font-size: var(--font-size-sm);
        text-transform: uppercase;
        letter-spacing: var(--letter-spacing-wider);
        color: var(--deep-purple);
        margin-bottom: var(--space-4);
        padding: var(--space-2) var(--space-5);
        background: linear-gradient(135deg, rgba(108, 99, 255, 0.1) 0%, rgba(108, 158, 255, 0.1) 100%);
        border-radius: var(--radius-full);
        z-index: 1;
    }
    
    .section-heading {
        position: relative;
        font-size: var(--font-size-3xl);
        font-weight: var(--font-weight-extrabold);
        margin-bottom: var(--space-6);
        line-height: var(--line-height-tight);
        z-index: 1;
    }
    
    .section-description {
        font-size: var(--font-size-lg);
        max-width: 800px;
        margin-bottom: var(--space-10);
        color: var(--text-gray);
        line-height: var(--line-height-relaxed);
    }
    
    .text-center .section-description {
        margin-left: auto;
        margin-right: auto;
    }
    
    /* ========== SHAPE ELEMENTS ========== */
    .shape {
        position: absolute;
        pointer-events: none;
        z-index: 0;
    }
    
    .shape-circle {
        width: 200px;
        height: 200px;
        border-radius: var(--radius-full);
        background: var(--soft-gradient);
        opacity: 0.5;
    }
    
    .shape-blob {
        width: 300px;
        height: 300px;
        background: var(--light-purple-bg);
        opacity: 0.3;
        animation: morph 8s ease-in-out infinite;
    }
    
    .shape-meteor {
        position: absolute;
        width: 100px;
        height: 2px;
        background: linear-gradient(90deg, var(--deep-purple), transparent);
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
        background: var(--deep-purple);
        box-shadow: 0 0 10px var(--deep-purple);
        left: 0;
        top: -1px;
    }
    
    /* ========== BACK TO TOP BUTTON ========== */
    #backToTop,
    .back-to-top {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        background: var(--gradient-primary);
        color: var(--white);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transform: translateY(20px);
        transition: all var(--duration-normal) var(--ease-out-back);
        z-index: var(--z-sticky);
        box-shadow: var(--shadow-primary);
    }
    
    #backToTop.active,
    #backToTop.visible,
    .back-to-top.visible {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    
    #backToTop:hover,
    .back-to-top:hover {
        transform: translateY(-5px) scale(1.1);
        box-shadow: var(--shadow-primary-lg);
    }
    
    [dir="rtl"] #backToTop,
    [dir="rtl"] .back-to-top {
        right: auto;
        left: 30px;
    }
}

/* =============================================================================
   9. UTILITY CLASSES GENERATOR - تولید کلاس‌های کاربردی
   ============================================================================= */

@layer utilities {
    /* ========== TEXT UTILITIES ========== */
    .text-center { text-align: center !important; }
    .text-left { text-align: left !important; }
    .text-right { text-align: right !important; }
    .text-justify { text-align: justify !important; }
    .text-start { text-align: start !important; }
    .text-end { text-align: end !important; }
    
    /* Text Natural Justify */
    .text-natural-justify {
        text-align: justify;
        text-justify: inter-word;
        hyphens: auto;
        word-spacing: normal;
        word-break: normal;
        overflow-wrap: break-word;
    }
    
    [dir="rtl"] .text-natural-justify {
        text-align-last: right;
        letter-spacing: -0.2px;
    }
    
    [dir="ltr"] .text-natural-justify {
        text-align-last: left;
        letter-spacing: 0.2px;
    }
    
    p.text-natural-justify {
        line-height: 1.8;
        margin-bottom: 1rem;
    }
    
    /* Text Transform */
    .uppercase { text-transform: uppercase !important; }
    .lowercase { text-transform: lowercase !important; }
    .capitalize { text-transform: capitalize !important; }
    .normal-case { text-transform: none !important; }
    
    /* Text Decoration */
    .underline { text-decoration: underline !important; }
    .line-through { text-decoration: line-through !important; }
    .no-underline { text-decoration: none !important; }
    
    /* Text Color */
    .text-primary { color: var(--primary) !important; }
    .text-secondary { color: var(--secondary-color) !important; }
    .text-success { color: var(--success) !important; }
    .text-danger { color: var(--danger) !important; }
    .text-warning { color: var(--warning) !important; }
    .text-info { color: var(--info-color) !important; }
    .text-light { color: var(--text-light) !important; }
    .text-dark { color: var(--text-dark) !important; }
    .text-muted { color: var(--text-muted) !important; }
    .text-white { color: var(--white) !important; }
    .text-gray { color: var(--text-gray) !important; }
    .text-purple { color: var(--deep-purple) !important; }
    .text-sky { color: var(--sky-blue) !important; }
    .text-pink { color: var(--pink) !important; }
    
    /* Text Gradient */
    .text-gradient {
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        color: var(--deep-purple);
        display: inline-block;
        position: relative;
    }
    
    .text-gradient-animated {
        background: var(--gradient-animated);
        background-size: var(--gradient-size);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: gradient-shift 10s ease infinite;
    }
    
    /* ========== BACKGROUND UTILITIES ========== */
    .bg-transparent { background-color: transparent !important; }
    .bg-white { background-color: var(--white) !important; }
    .bg-black { background-color: var(--black) !important; }
    .bg-primary { background-color: var(--primary) !important; }
    .bg-secondary { background-color: var(--secondary-color) !important; }
    .bg-success { background-color: var(--success) !important; }
    .bg-danger { background-color: var(--danger) !important; }
    .bg-warning { background-color: var(--warning) !important; }
    .bg-info { background-color: var(--info-color) !important; }
    .bg-light { background-color: var(--bg-light) !important; }
    .bg-dark { background-color: var(--dark-color) !important; }
    
    /* Special Backgrounds */
    .bg-sky { background-color: var(--light-sky) !important; }
    .bg-soft-purple { background-color: var(--light-purple-bg) !important; }
    .bg-medium-purple { background-color: var(--medium-purple-bg) !important; }
    
    /* Gradient Backgrounds */
    .bg-gradient-primary { background: var(--gradient-primary) !important; }
    .bg-gradient-success { background: var(--success-gradient) !important; }
    .bg-gradient-sky { background: var(--sky-gradient) !important; }
    .bg-gradient-purple { background: var(--purple-gradient) !important; }
    .bg-gradient-sunset { background: var(--sunset-gradient) !important; }
    .bg-gradient-cosmic { background: var(--cosmic-gradient) !important; }
    .bg-gradient-dark { background: var(--gradient-dark) !important; }
    .bg-gradient-soft { background: var(--soft-gradient) !important; }
    .bg-gradient-mesh { background: var(--gradient-mesh-purple) !important; }
    
    /* ========== BORDER UTILITIES ========== */
    .border { border: 1px solid var(--gray-300) !important; }
    .border-0 { border: 0 !important; }
    .border-top { border-top: 1px solid var(--gray-300) !important; }
    .border-right { border-right: 1px solid var(--gray-300) !important; }
    .border-bottom { border-bottom: 1px solid var(--gray-300) !important; }
    .border-left { border-left: 1px solid var(--gray-300) !important; }
    
    /* Border Color */
    .border-primary { border-color: var(--primary) !important; }
    .border-secondary { border-color: var(--secondary-color) !important; }
    .border-success { border-color: var(--success) !important; }
    .border-danger { border-color: var(--danger) !important; }
    .border-warning { border-color: var(--warning) !important; }
    .border-info { border-color: var(--info-color) !important; }
    .border-light { border-color: var(--gray-200) !important; }
    .border-dark { border-color: var(--dark-color) !important; }
    .border-white { border-color: var(--white) !important; }
    
    /* Border Width */
    .border-1 { border-width: 1px !important; }
    .border-2 { border-width: 2px !important; }
    .border-3 { border-width: 3px !important; }
    .border-4 { border-width: 4px !important; }
    .border-5 { border-width: 5px !important; }
    
    /* Border Radius */
    .rounded-none { border-radius: 0 !important; }
    .rounded-sm { border-radius: var(--radius-sm) !important; }
    .rounded { border-radius: var(--radius-md) !important; }
    .rounded-md { border-radius: var(--radius-lg) !important; }
    .rounded-lg { border-radius: var(--radius-xl) !important; }
    .rounded-xl { border-radius: var(--radius-2xl) !important; }
    .rounded-2xl { border-radius: var(--radius-3xl) !important; }
    .rounded-3xl { border-radius: var(--border-radius-lg) !important; }
    .rounded-full { border-radius: var(--radius-full) !important; }
    .rounded-pill { border-radius: var(--radius-full) !important; }
    .rounded-circle { border-radius: 50% !important; }
    
    /* ========== SHADOW UTILITIES ========== */
    .shadow-none { box-shadow: none !important; }
    .shadow-xs { box-shadow: var(--shadow-xs) !important; }
    .shadow-sm { box-shadow: var(--shadow-sm) !important; }
    .shadow { box-shadow: var(--shadow-md) !important; }
    .shadow-md { box-shadow: var(--shadow-md) !important; }
    .shadow-lg { box-shadow: var(--shadow-lg) !important; }
    .shadow-xl { box-shadow: var(--shadow-xl) !important; }
    .shadow-2xl { box-shadow: var(--shadow-2xl) !important; }
    .shadow-inner { box-shadow: var(--shadow-inner) !important; }
    
    /* Elevation Shadows */
    .shadow-low { box-shadow: var(--shadow-elevation-low) !important; }
    .shadow-medium { box-shadow: var(--shadow-elevation-medium) !important; }
    .shadow-high { box-shadow: var(--shadow-elevation-high) !important; }
    
    /* Colored Shadows */
    .shadow-primary { box-shadow: var(--shadow-primary) !important; }
    .shadow-success { box-shadow: var(--shadow-success) !important; }
    .shadow-danger { box-shadow: var(--shadow-danger) !important; }
    .shadow-purple { box-shadow: var(--purple-shadow) !important; }
    .shadow-blue { box-shadow: var(--blue-shadow) !important; }
    
    /* Legacy Shadow Classes */
    .shadow-effect { box-shadow: var(--shadow) !important; }
    .shadow-effect-lg { box-shadow: var(--shadow-lg) !important; }
    
    /* ========== SPACING UTILITIES ========== */
    /* Margin */
    .m-0 { margin: 0 !important; }
    .m-auto { margin: auto !important; }
    .mx-auto { margin-left: auto !important; margin-right: auto !important; }
    .my-auto { margin-top: auto !important; margin-bottom: auto !important; }
    
    /* Generate margin utilities */
    .m-1 { margin: var(--space-1) !important; }
    .m-2 { margin: var(--space-2) !important; }
    .m-3 { margin: var(--space-3) !important; }
    .m-4 { margin: var(--space-4) !important; }
    .m-5 { margin: var(--space-5) !important; }
    .m-6 { margin: var(--space-6) !important; }
    .m-8 { margin: var(--space-8) !important; }
    .m-10 { margin: var(--space-10) !important; }
    .m-12 { margin: var(--space-12) !important; }
    .m-16 { margin: var(--space-16) !important; }
    .m-20 { margin: var(--space-20) !important; }
    .m-24 { margin: var(--space-24) !important; }
    
    /* Margin Top */
    .mt-0 { margin-top: 0 !important; }
    .mt-1 { margin-top: var(--space-1) !important; }
    .mt-2 { margin-top: var(--space-2) !important; }
    .mt-3 { margin-top: var(--space-3) !important; }
    .mt-4 { margin-top: var(--space-4) !important; }
    .mt-5 { margin-top: var(--space-5) !important; }
    .mt-6 { margin-top: var(--space-6) !important; }
    .mt-8 { margin-top: var(--space-8) !important; }
    .mt-10 { margin-top: var(--space-10) !important; }
    .mt-12 { margin-top: var(--space-12) !important; }
    .mt-16 { margin-top: var(--space-16) !important; }
    .mt-20 { margin-top: var(--space-20) !important; }
    .mt-24 { margin-top: var(--space-24) !important; }
    
    /* Margin Bottom */
    .mb-0 { margin-bottom: 0 !important; }
    .mb-1 { margin-bottom: var(--space-1) !important; }
    .mb-2 { margin-bottom: var(--space-2) !important; }
    .mb-3 { margin-bottom: var(--space-3) !important; }
    .mb-4 { margin-bottom: var(--space-4) !important; }
    .mb-5 { margin-bottom: var(--space-5) !important; }
    .mb-6 { margin-bottom: var(--space-6) !important; }
    .mb-8 { margin-bottom: var(--space-8) !important; }
    .mb-10 { margin-bottom: var(--space-10) !important; }
    .mb-12 { margin-bottom: var(--space-12) !important; }
    .mb-16 { margin-bottom: var(--space-16) !important; }
    .mb-20 { margin-bottom: var(--space-20) !important; }
    .mb-24 { margin-bottom: var(--space-24) !important; }
    
    /* Margin Left */
    .ml-0 { margin-left: 0 !important; }
    .ml-1 { margin-left: var(--space-1) !important; }
    .ml-2 { margin-left: var(--space-2) !important; }
    .ml-3 { margin-left: var(--space-3) !important; }
    .ml-4 { margin-left: var(--space-4) !important; }
    .ml-5 { margin-left: var(--space-5) !important; }
    .ml-6 { margin-left: var(--space-6) !important; }
    .ml-8 { margin-left: var(--space-8) !important; }
    .ml-10 { margin-left: var(--space-10) !important; }
    .ml-12 { margin-left: var(--space-12) !important; }
    .ml-16 { margin-left: var(--space-16) !important; }
    .ml-20 { margin-left: var(--space-20) !important; }
    .ml-24 { margin-left: var(--space-24) !important; }
    
    /* Margin Right */
    .mr-0 { margin-right: 0 !important; }
    .mr-1 { margin-right: var(--space-1) !important; }
    .mr-2 { margin-right: var(--space-2) !important; }
    .mr-3 { margin-right: var(--space-3) !important; }
    .mr-4 { margin-right: var(--space-4) !important; }
    .mr-5 { margin-right: var(--space-5) !important; }
    .mr-6 { margin-right: var(--space-6) !important; }
    .mr-8 { margin-right: var(--space-8) !important; }
    .mr-10 { margin-right: var(--space-10) !important; }
    .mr-12 { margin-right: var(--space-12) !important; }
    .mr-16 { margin-right: var(--space-16) !important; }
    .mr-20 { margin-right: var(--space-20) !important; }
    .mr-24 { margin-right: var(--space-24) !important; }
    
    /* Margin X (horizontal) */
    .mx-0 { margin-left: 0 !important; margin-right: 0 !important; }
    .mx-1 { margin-left: var(--space-1) !important; margin-right: var(--space-1) !important; }
    .mx-2 { margin-left: var(--space-2) !important; margin-right: var(--space-2) !important; }
    .mx-3 { margin-left: var(--space-3) !important; margin-right: var(--space-3) !important; }
    .mx-4 { margin-left: var(--space-4) !important; margin-right: var(--space-4) !important; }
    .mx-5 { margin-left: var(--space-5) !important; margin-right: var(--space-5) !important; }
    .mx-6 { margin-left: var(--space-6) !important; margin-right: var(--space-6) !important; }
    .mx-8 { margin-left: var(--space-8) !important; margin-right: var(--space-8) !important; }
    .mx-10 { margin-left: var(--space-10) !important; margin-right: var(--space-10) !important; }
    .mx-12 { margin-left: var(--space-12) !important; margin-right: var(--space-12) !important; }
    .mx-16 { margin-left: var(--space-16) !important; margin-right: var(--space-16) !important; }
    .mx-20 { margin-left: var(--space-20) !important; margin-right: var(--space-20) !important; }
    .mx-24 { margin-left: var(--space-24) !important; margin-right: var(--space-24) !important; }
    
    /* Margin Y (vertical) */
    .my-0 { margin-top: 0 !important; margin-bottom: 0 !important; }
    .my-1 { margin-top: var(--space-1) !important; margin-bottom: var(--space-1) !important; }
    .my-2 { margin-top: var(--space-2) !important; margin-bottom: var(--space-2) !important; }
    .my-3 { margin-top: var(--space-3) !important; margin-bottom: var(--space-3) !important; }
    .my-4 { margin-top: var(--space-4) !important; margin-bottom: var(--space-4) !important; }
    .my-5 { margin-top: var(--space-5) !important; margin-bottom: var(--space-5) !important; }
    .my-6 { margin-top: var(--space-6) !important; margin-bottom: var(--space-6) !important; }
    .my-8 { margin-top: var(--space-8) !important; margin-bottom: var(--space-8) !important; }
    .my-10 { margin-top: var(--space-10) !important; margin-bottom: var(--space-10) !important; }
    .my-12 { margin-top: var(--space-12) !important; margin-bottom: var(--space-12) !important; }
    .my-16 { margin-top: var(--space-16) !important; margin-bottom: var(--space-16) !important; }
    .my-20 { margin-top: var(--space-20) !important; margin-bottom: var(--space-20) !important; }
    .my-24 { margin-top: var(--space-24) !important; margin-bottom: var(--space-24) !important; }
    
    /* Padding */
    .p-0 { padding: 0 !important; }
    .p-1 { padding: var(--space-1) !important; }
    .p-2 { padding: var(--space-2) !important; }
    .p-3 { padding: var(--space-3) !important; }
    .p-4 { padding: var(--space-4) !important; }
    .p-5 { padding: var(--space-5) !important; }
    .p-6 { padding: var(--space-6) !important; }
    .p-8 { padding: var(--space-8) !important; }
    .p-10 { padding: var(--space-10) !important; }
    .p-12 { padding: var(--space-12) !important; }
    .p-16 { padding: var(--space-16) !important; }
    .p-20 { padding: var(--space-20) !important; }
    .p-24 { padding: var(--space-24) !important; }
    
    /* Padding Top */
    .pt-0 { padding-top: 0 !important; }
    .pt-1 { padding-top: var(--space-1) !important; }
    .pt-2 { padding-top: var(--space-2) !important; }
    .pt-3 { padding-top: var(--space-3) !important; }
    .pt-4 { padding-top: var(--space-4) !important; }
    .pt-5 { padding-top: var(--space-5) !important; }
    .pt-6 { padding-top: var(--space-6) !important; }
    .pt-8 { padding-top: var(--space-8) !important; }
    .pt-10 { padding-top: var(--space-10) !important; }
    .pt-12 { padding-top: var(--space-12) !important; }
    .pt-16 { padding-top: var(--space-16) !important; }
    .pt-20 { padding-top: var(--space-20) !important; }
    .pt-24 { padding-top: var(--space-24) !important; }
    
    /* Padding Bottom */
    .pb-0 { padding-bottom: 0 !important; }
    .pb-1 { padding-bottom: var(--space-1) !important; }
    .pb-2 { padding-bottom: var(--space-2) !important; }
    .pb-3 { padding-bottom: var(--space-3) !important; }
    .pb-4 { padding-bottom: var(--space-4) !important; }
    .pb-5 { padding-bottom: var(--space-5) !important; }
    .pb-6 { padding-bottom: var(--space-6) !important; }
    .pb-8 { padding-bottom: var(--space-8) !important; }
    .pb-10 { padding-bottom: var(--space-10) !important; }
    .pb-12 { padding-bottom: var(--space-12) !important; }
    .pb-16 { padding-bottom: var(--space-16) !important; }
    .pb-20 { padding-bottom: var(--space-20) !important; }
    .pb-24 { padding-bottom: var(--space-24) !important; }
    
    /* Padding Left */
    .pl-0 { padding-left: 0 !important; }
    .pl-1 { padding-left: var(--space-1) !important; }
    .pl-2 { padding-left: var(--space-2) !important; }
    .pl-3 { padding-left: var(--space-3) !important; }
    .pl-4 { padding-left: var(--space-4) !important; }
    .pl-5 { padding-left: var(--space-5) !important; }
    .pl-6 { padding-left: var(--space-6) !important; }
    .pl-8 { padding-left: var(--space-8) !important; }
    .pl-10 { padding-left: var(--space-10) !important; }
    .pl-12 { padding-left: var(--space-12) !important; }
    .pl-16 { padding-left: var(--space-16) !important; }
    .pl-20 { padding-left: var(--space-20) !important; }
    .pl-24 { padding-left: var(--space-24) !important; }
    
    /* Padding Right */
    .pr-0 { padding-right: 0 !important; }
    .pr-1 { padding-right: var(--space-1) !important; }
    .pr-2 { padding-right: var(--space-2) !important; }
    .pr-3 { padding-right: var(--space-3) !important; }
    .pr-4 { padding-right: var(--space-4) !important; }
    .pr-5 { padding-right: var(--space-5) !important; }
    .pr-6 { padding-right: var(--space-6) !important; }
    .pr-8 { padding-right: var(--space-8) !important; }
    .pr-10 { padding-right: var(--space-10) !important; }
    .pr-12 { padding-right: var(--space-12) !important; }
    .pr-16 { padding-right: var(--space-16) !important; }
    .pr-20 { padding-right: var(--space-20) !important; }
    .pr-24 { padding-right: var(--space-24) !important; }
    
    /* Padding X (horizontal) */
    .px-0 { padding-left: 0 !important; padding-right: 0 !important; }
    .px-1 { padding-left: var(--space-1) !important; padding-right: var(--space-1) !important; }
    .px-2 { padding-left: var(--space-2) !important; padding-right: var(--space-2) !important; }
    .px-3 { padding-left: var(--space-3) !important; padding-right: var(--space-3) !important; }
    .px-4 { padding-left: var(--space-4) !important; padding-right: var(--space-4) !important; }
    .px-5 { padding-left: var(--space-5) !important; padding-right: var(--space-5) !important; }
    .px-6 { padding-left: var(--space-6) !important; padding-right: var(--space-6) !important; }
    .px-8 { padding-left: var(--space-8) !important; padding-right: var(--space-8) !important; }
    .px-10 { padding-left: var(--space-10) !important; padding-right: var(--space-10) !important; }
    .px-12 { padding-left: var(--space-12) !important; padding-right: var(--space-12) !important; }
    .px-16 { padding-left: var(--space-16) !important; padding-right: var(--space-16) !important; }
    .px-20 { padding-left: var(--space-20) !important; padding-right: var(--space-20) !important; }
    .px-24 { padding-left: var(--space-24) !important; padding-right: var(--space-24) !important; }
    
    /* Padding Y (vertical) */
    .py-0 { padding-top: 0 !important; padding-bottom: 0 !important; }
    .py-1 { padding-top: var(--space-1) !important; padding-bottom: var(--space-1) !important; }
    .py-2 { padding-top: var(--space-2) !important; padding-bottom: var(--space-2) !important; }
    .py-3 { padding-top: var(--space-3) !important; padding-bottom: var(--space-3) !important; }
    .py-4 { padding-top: var(--space-4) !important; padding-bottom: var(--space-4) !important; }
    .py-5 { padding-top: var(--space-5) !important; padding-bottom: var(--space-5) !important; }
    .py-6 { padding-top: var(--space-6) !important; padding-bottom: var(--space-6) !important; }
    .py-8 { padding-top: var(--space-8) !important; padding-bottom: var(--space-8) !important; }
    .py-10 { padding-top: var(--space-10) !important; padding-bottom: var(--space-10) !important; }
    .py-12 { padding-top: var(--space-12) !important; padding-bottom: var(--space-12) !important; }
    .py-16 { padding-top: var(--space-16) !important; padding-bottom: var(--space-16) !important; }
    .py-20 { padding-top: var(--space-20) !important; padding-bottom: var(--space-20) !important; }
    .py-24 { padding-top: var(--space-24) !important; padding-bottom: var(--space-24) !important; }
    
    /* Legacy Spacing Classes */
    .p-xs { padding: var(--space-xs) !important; }
    .p-sm { padding: var(--space-sm) !important; }
    .p-md { padding: var(--space-md) !important; }
    .p-lg { padding: var(--space-lg) !important; }
    .p-xl { padding: var(--space-xl) !important; }
    
    .m-xs { margin: var(--space-xs) !important; }
    .m-sm { margin: var(--space-sm) !important; }
    .m-md { margin: var(--space-md) !important; }
    .m-lg { margin: var(--space-lg) !important; }
    .m-xl { margin: var(--space-xl) !important; }
    
    /* ========== WIDTH & HEIGHT UTILITIES ========== */
    .w-auto { width: auto !important; }
    .w-full { width: 100% !important; }
    .w-screen { width: 100vw !important; }
    .w-min { width: min-content !important; }
    .w-max { width: max-content !important; }
    .w-fit { width: fit-content !important; }
    
    .h-auto { height: auto !important; }
    .h-full { height: 100% !important; }
    .h-screen { height: 100vh !important; }
    .h-min { height: min-content !important; }
    .h-max { height: max-content !important; }
    .h-fit { height: fit-content !important; }
    
    /* Min/Max Width */
    .min-w-0 { min-width: 0 !important; }
    .min-w-full { min-width: 100% !important; }
    .max-w-full { max-width: 100% !important; }
    .max-w-screen { max-width: 100vw !important; }
    
    /* Min/Max Height */
    .min-h-0 { min-height: 0 !important; }
    .min-h-full { min-height: 100% !important; }
    .min-h-screen { min-height: 100vh !important; }
    .max-h-full { max-height: 100% !important; }
    .max-h-screen { max-height: 100vh !important; }
    
    /* ========== DISPLAY UTILITIES ========== */
    .block { display: block !important; }
    .inline-block { display: inline-block !important; }
    .inline { display: inline !important; }
    .flex { display: flex !important; }
    .inline-flex { display: inline-flex !important; }
    .grid { display: grid !important; }
    .inline-grid { display: inline-grid !important; }
    .table { display: table !important; }
    .table-row { display: table-row !important; }
    .table-cell { display: table-cell !important; }
    .hidden { display: none !important; }
    .invisible { visibility: hidden !important; }
    .visible { visibility: visible !important; }
    
    /* ========== OVERFLOW UTILITIES ========== */
    .overflow-auto { overflow: auto !important; }
    .overflow-hidden { overflow: hidden !important; }
    .overflow-visible { overflow: visible !important; }
    .overflow-scroll { overflow: scroll !important; }
    .overflow-x-auto { overflow-x: auto !important; }
    .overflow-x-hidden { overflow-x: hidden !important; }
    .overflow-x-visible { overflow-x: visible !important; }
    .overflow-x-scroll { overflow-x: scroll !important; }
    .overflow-y-auto { overflow-y: auto !important; }
    .overflow-y-hidden { overflow-y: hidden !important; }
    .overflow-y-visible { overflow-y: visible !important; }
    .overflow-y-scroll { overflow-y: scroll !important; }
    
    /* ========== OPACITY UTILITIES ========== */
    .opacity-0 { opacity: 0 !important; }
    .opacity-5 { opacity: 0.05 !important; }
    .opacity-10 { opacity: 0.1 !important; }
    .opacity-20 { opacity: 0.2 !important; }
    .opacity-25 { opacity: 0.25 !important; }
    .opacity-30 { opacity: 0.3 !important; }
    .opacity-40 { opacity: 0.4 !important; }
    .opacity-50 { opacity: 0.5 !important; }
    .opacity-60 { opacity: 0.6 !important; }
    .opacity-70 { opacity: 0.7 !important; }
    .opacity-75 { opacity: 0.75 !important; }
    .opacity-80 { opacity: 0.8 !important; }
    .opacity-90 { opacity: 0.9 !important; }
    .opacity-95 { opacity: 0.95 !important; }
    .opacity-100 { opacity: 1 !important; }
    
    /* ========== CURSOR UTILITIES ========== */
    .cursor-auto { cursor: auto !important; }
    .cursor-default { cursor: default !important; }
    .cursor-pointer { cursor: pointer !important; }
    .cursor-wait { cursor: wait !important; }
    .cursor-text { cursor: text !important; }
    .cursor-move { cursor: move !important; }
    .cursor-help { cursor: help !important; }
    .cursor-not-allowed { cursor: not-allowed !important; }
    .cursor-none { cursor: none !important; }
    .cursor-context-menu { cursor: context-menu !important; }
    .cursor-progress { cursor: progress !important; }
    .cursor-cell { cursor: cell !important; }
    .cursor-crosshair { cursor: crosshair !important; }
    .cursor-vertical-text { cursor: vertical-text !important; }
    .cursor-alias { cursor: alias !important; }
    .cursor-copy { cursor: copy !important; }
    .cursor-no-drop { cursor: no-drop !important; }
    .cursor-grab { cursor: grab !important; }
    .cursor-grabbing { cursor: grabbing !important; }
    
    /* ========== FILTER UTILITIES ========== */
    .blur-sm { filter: var(--blur-sm) !important; }
    .blur { filter: var(--blur) !important; }
    .blur-md { filter: var(--blur-md) !important; }
    .blur-lg { filter: var(--blur-lg) !important; }
    .blur-xl { filter: var(--blur-xl) !important; }
    .blur-2xl { filter: var(--blur-2xl) !important; }
    .blur-3xl { filter: var(--blur-3xl) !important; }
    
    .brightness-0 { filter: var(--brightness-0) !important; }
    .brightness-50 { filter: var(--brightness-50) !important; }
    .brightness-75 { filter: var(--brightness-75) !important; }
    .brightness-90 { filter: var(--brightness-90) !important; }
    .brightness-95 { filter: var(--brightness-95) !important; }
    .brightness-100 { filter: var(--brightness-100) !important; }
    .brightness-105 { filter: var(--brightness-105) !important; }
    .brightness-110 { filter: var(--brightness-110) !important; }
    .brightness-125 { filter: var(--brightness-125) !important; }
    .brightness-150 { filter: var(--brightness-150) !important; }
    .brightness-200 { filter: var(--brightness-200) !important; }
    
    .contrast-0 { filter: contrast(0) !important; }
    .contrast-50 { filter: contrast(0.5) !important; }
    .contrast-75 { filter: contrast(0.75) !important; }
    .contrast-100 { filter: contrast(1) !important; }
    .contrast-125 { filter: contrast(1.25) !important; }
    .contrast-150 { filter: contrast(1.5) !important; }
    .contrast-200 { filter: contrast(2) !important; }
    
    .grayscale-0 { filter: grayscale(0) !important; }
    .grayscale { filter: grayscale(100%) !important; }
    
    .invert-0 { filter: invert(0) !important; }
    .invert { filter: invert(100%) !important; }
    
    .sepia-0 { filter: sepia(0) !important; }
    .sepia { filter: sepia(100%) !important; }
    
    .saturate-0 { filter: saturate(0) !important; }
    .saturate-50 { filter: saturate(0.5) !important; }
    .saturate-100 { filter: saturate(1) !important; }
    .saturate-150 { filter: saturate(1.5) !important; }
    .saturate-200 { filter: saturate(2) !important; }
    
    .hue-rotate-0 { filter: hue-rotate(0deg) !important; }
    .hue-rotate-15 { filter: hue-rotate(15deg) !important; }
    .hue-rotate-30 { filter: hue-rotate(30deg) !important; }
    .hue-rotate-60 { filter: hue-rotate(60deg) !important; }
    .hue-rotate-90 { filter: hue-rotate(90deg) !important; }
    .hue-rotate-180 { filter: hue-rotate(180deg) !important; }
    
    /* ========== TRANSFORM UTILITIES ========== */
    .scale-0 { transform: scale(0) !important; }
    .scale-50 { transform: scale(0.5) !important; }
    .scale-75 { transform: scale(0.75) !important; }
    .scale-90 { transform: scale(0.9) !important; }
    .scale-95 { transform: scale(0.95) !important; }
    .scale-100 { transform: scale(1) !important; }
    .scale-105 { transform: scale(1.05) !important; }
    .scale-110 { transform: scale(1.1) !important; }
    .scale-125 { transform: scale(1.25) !important; }
    .scale-150 { transform: scale(1.5) !important; }
    
    .rotate-0 { transform: rotate(0deg) !important; }
    .rotate-45 { transform: rotate(45deg) !important; }
    .rotate-90 { transform: rotate(90deg) !important; }
    .rotate-180 { transform: rotate(180deg) !important; }
    .-rotate-45 { transform: rotate(-45deg) !important; }
    .-rotate-90 { transform: rotate(-90deg) !important; }
    .-rotate-180 { transform: rotate(-180deg) !important; }
    
    .translate-x-0 { transform: translateX(0) !important; }
    .translate-x-1 { transform: translateX(var(--space-1)) !important; }
    .translate-x-2 { transform: translateX(var(--space-2)) !important; }
    .translate-x-4 { transform: translateX(var(--space-4)) !important; }
    .translate-x-8 { transform: translateX(var(--space-8)) !important; }
    .-translate-x-1 { transform: translateX(calc(var(--space-1) * -1)) !important; }
    .-translate-x-2 { transform: translateX(calc(var(--space-2) * -1)) !important; }
    .-translate-x-4 { transform: translateX(calc(var(--space-4) * -1)) !important; }
    .-translate-x-8 { transform: translateX(calc(var(--space-8) * -1)) !important; }
    
    .translate-y-0 { transform: translateY(0) !important; }
    .translate-y-1 { transform: translateY(var(--space-1)) !important; }
    .translate-y-2 { transform: translateY(var(--space-2)) !important; }
    .translate-y-4 { transform: translateY(var(--space-4)) !important; }
    .translate-y-8 { transform: translateY(var(--space-8)) !important; }
    .-translate-y-1 { transform: translateY(calc(var(--space-1) * -1)) !important; }
    .-translate-y-2 { transform: translateY(calc(var(--space-2) * -1)) !important; }
    .-translate-y-4 { transform: translateY(calc(var(--space-4) * -1)) !important; }
    .-translate-y-8 { transform: translateY(calc(var(--space-8) * -1)) !important; }
    
    .skew-x-0 { transform: skewX(0deg) !important; }
    .skew-x-3 { transform: skewX(3deg) !important; }
    .skew-x-6 { transform: skewX(6deg) !important; }
    .skew-x-12 { transform: skewX(12deg) !important; }
    .-skew-x-3 { transform: skewX(-3deg) !important; }
    .-skew-x-6 { transform: skewX(-6deg) !important; }
    .-skew-x-12 { transform: skewX(-12deg) !important; }
    
    .skew-y-0 { transform: skewY(0deg) !important; }
    .skew-y-3 { transform: skewY(3deg) !important; }
    .skew-y-6 { transform: skewY(6deg) !important; }
    .skew-y-12 { transform: skewY(12deg) !important; }
    .-skew-y-3 { transform: skewY(-3deg) !important; }
    .-skew-y-6 { transform: skewY(-6deg) !important; }
    .-skew-y-12 { transform: skewY(-12deg) !important; }
    
    /* Transform Origin */
    .origin-center { transform-origin: center !important; }
    .origin-top { transform-origin: top !important; }
    .origin-top-right { transform-origin: top right !important; }
    .origin-right { transform-origin: right !important; }
    .origin-bottom-right { transform-origin: bottom right !important; }
    .origin-bottom { transform-origin: bottom !important; }
    .origin-bottom-left { transform-origin: bottom left !important; }
    .origin-left { transform-origin: left !important; }
    .origin-top-left { transform-origin: top left !important; }
    
    /* ========== TRANSITION UTILITIES ========== */
    .transition-none { transition: none !important; }
    .transition-all { transition: all var(--duration-normal) var(--ease-out) !important; }
    .transition { transition: all var(--duration-normal) var(--ease-out) !important; }
    .transition-colors { transition: color var(--duration-normal) var(--ease-out), background-color var(--duration-normal) var(--ease-out), border-color var(--duration-normal) var(--ease-out), fill var(--duration-normal) var(--ease-out), stroke var(--duration-normal) var(--ease-out) !important; }
    .transition-opacity { transition: opacity var(--duration-normal) var(--ease-out) !important; }
    .transition-shadow { transition: box-shadow var(--duration-normal) var(--ease-out) !important; }
    .transition-transform { transition: transform var(--duration-normal) var(--ease-out) !important; }
    
    /* Transition Duration */
    .duration-75 { transition-duration: 75ms !important; }
    .duration-100 { transition-duration: 100ms !important; }
    .duration-150 { transition-duration: 150ms !important; }
    .duration-200 { transition-duration: 200ms !important; }
    .duration-300 { transition-duration: 300ms !important; }
    .duration-500 { transition-duration: 500ms !important; }
    .duration-700 { transition-duration: 700ms !important; }
    .duration-1000 { transition-duration: 1000ms !important; }
    
    /* Transition Timing */
    .ease-linear { transition-timing-function: linear !important; }
    .ease-in { transition-timing-function: var(--ease-in) !important; }
    .ease-out { transition-timing-function: var(--ease-out) !important; }
    .ease-in-out { transition-timing-function: var(--ease-in-out) !important; }
    
    /* ========== HOVER UTILITIES ========== */
    .hover-lift {
        transition: transform var(--duration-normal) var(--ease-out);
    }
    
    .hover-lift:hover {
        transform: translateY(-5px);
    }
    
    .hover-scale {
        transition: transform var(--duration-normal) var(--ease-out);
    }
    
    .hover-scale:hover {
        transform: scale(1.05);
    }
    
    .hover-rotate {
        transition: transform var(--duration-normal) var(--ease-out);
    }
    
    .hover-rotate:hover {
        transform: rotate(5deg);
    }
    
    .hover-glow:hover {
        box-shadow: 0 0 20px rgba(var(--primary-rgb), 0.5);
    }
    
    .hover-shadow-lg:hover {
        box-shadow: var(--shadow-lg) !important;
    }
    
    .hover-shadow-xl:hover {
        box-shadow: var(--shadow-xl) !important;
    }
    
    .hover-shadow-2xl:hover {
        box-shadow: var(--shadow-2xl) !important;
    }
    
    .hover-opacity-80:hover {
        opacity: 0.8 !important;
    }
    
    .hover-opacity-90:hover {
        opacity: 0.9 !important;
    }
    
    /* ========== GLASS MORPHISM UTILITIES ========== */
    .glass {
        background: var(--glass-bg);
        backdrop-filter: var(--glass-blur);
        -webkit-backdrop-filter: var(--glass-blur);
        border: 1px solid var(--glass-border);
    }
    
    .glass-dark {
        background: var(--glass-bg-dark);
        backdrop-filter: var(--glass-blur);
        -webkit-backdrop-filter: var(--glass-blur);
        border: 1px solid var(--glass-border);
    }
    
    .glass-heavy {
        background: var(--glass-bg);
        backdrop-filter: var(--glass-blur-heavy);
        -webkit-backdrop-filter: var(--glass-blur-heavy);
        border: 1px solid var(--glass-border);
        box-shadow: var(--glass-shadow);
    }
    
    /* ========== ACCESSIBILITY UTILITIES ========== */
    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border-width: 0;
    }
    
    .not-sr-only {
        position: static;
        width: auto;
        height: auto;
        padding: 0;
        margin: 0;
        overflow: visible;
        clip: auto;
        white-space: normal;
    }
    
    .focus-visible:focus {
        outline: 2px solid var(--primary);
        outline-offset: 2px;
    }
    
    .focus-within:focus-within {
        outline: 2px solid var(--primary);
        outline-offset: 2px;
    }
    
    /* ========== ASPECT RATIO UTILITIES ========== */
    .aspect-auto { aspect-ratio: auto !important; }
    .aspect-square { aspect-ratio: 1 / 1 !important; }
    .aspect-video { aspect-ratio: 16 / 9 !important; }
    .aspect-4-3 { aspect-ratio: 4 / 3 !important; }
    .aspect-21-9 { aspect-ratio: 21 / 9 !important; }
    
    /* ========== SCROLL UTILITIES ========== */
    .scroll-smooth { scroll-behavior: smooth !important; }
    .scroll-auto { scroll-behavior: auto !important; }
    
    .snap-x { scroll-snap-type: x mandatory !important; }
    .snap-y { scroll-snap-type: y mandatory !important; }
    .snap-both { scroll-snap-type: both mandatory !important; }
    .snap-none { scroll-snap-type: none !important; }
    
    .snap-start { scroll-snap-align: start !important; }
    .snap-end { scroll-snap-align: end !important; }
    .snap-center { scroll-snap-align: center !important; }
    
    .overscroll-auto { overscroll-behavior: auto !important; }
    .overscroll-contain { overscroll-behavior: contain !important; }
    .overscroll-none { overscroll-behavior: none !important; }
    
    /* ========== ISOLATION UTILITIES ========== */
    .isolate { isolation: isolate !important; }
    .isolation-auto { isolation: auto !important; }
    
    /* ========== MIX BLEND MODE UTILITIES ========== */
    .mix-blend-normal { mix-blend-mode: normal !important; }
    .mix-blend-multiply { mix-blend-mode: multiply !important; }
    .mix-blend-screen { mix-blend-mode: screen !important; }
    .mix-blend-overlay { mix-blend-mode: overlay !important; }
    .mix-blend-darken { mix-blend-mode: darken !important; }
    .mix-blend-lighten { mix-blend-mode: lighten !important; }
    .mix-blend-color-dodge { mix-blend-mode: color-dodge !important; }
    .mix-blend-color-burn { mix-blend-mode: color-burn !important; }
    .mix-blend-hard-light { mix-blend-mode: hard-light !important; }
    .mix-blend-soft-light { mix-blend-mode: soft-light !important; }
    .mix-blend-difference { mix-blend-mode: difference !important; }
    .mix-blend-exclusion { mix-blend-mode: exclusion !important; }
    .mix-blend-hue { mix-blend-mode: hue !important; }
    .mix-blend-saturation { mix-blend-mode: saturation !important; }
    .mix-blend-color { mix-blend-mode: color !important; }
    .mix-blend-luminosity { mix-blend-mode: luminosity !important; }
    
    /* ========== WILL CHANGE UTILITIES ========== */
    .will-change-auto { will-change: auto !important; }
    .will-change-transform { will-change: transform !important; }
    .will-change-opacity { will-change: opacity !important; }
    .will-change-scroll { will-change: scroll-position !important; }
    
    /* ========== CONTAINER QUERIES UTILITIES ========== */
    @container (min-width: 640px) {
        .container\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .container\:grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .container\:grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
    }
    
    @container (min-width: 768px) {
        .container\:md\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .container\:md\:grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .container\:md\:grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
    }
    
    /* ========== HAS SELECTOR UTILITIES ========== */
    @supports selector(:has(*)) {
        .has-shape {
            position: relative;
            z-index: 1;
        }
        
        /* Parent state based on child */
        .group:has(.group-hover\:visible:hover) {
            background-color: var(--light-purple);
        }
        
        /* Form validation states */
        .form-group:has(input:invalid) {
            border-color: var(--danger);
        }
        
        .form-group:has(input:valid) {
            border-color: var(--success);
        }
        
        .form-group:has(input:focus) {
            background-color: var(--light-purple);
        }
    }
}
/* =============================================================================
   10. INTERACTIVE STATES - حالت‌های تعاملی (Fixed Version)
   ============================================================================= */

@layer states {
    /* Focus States - فقط برای form elements و generic elements */
    input:focus,
    textarea:focus,
    select:focus,
    button:focus,
    [tabindex]:focus,
    .focusable:focus {
        outline: 2px solid var(--primary);
        outline-offset: 2px;
    }
    
    input:focus:not(:focus-visible),
    textarea:focus:not(:focus-visible),
    select:focus:not(:focus-visible),
    button:focus:not(:focus-visible),
    [tabindex]:focus:not(:focus-visible),
    .focusable:focus:not(:focus-visible) {
        outline: none;
    }
    
    input:focus-visible,
    textarea:focus-visible,
    select:focus-visible,
    button:focus-visible,
    [tabindex]:focus-visible,
    .focusable:focus-visible {
        outline: 2px solid var(--primary);
        outline-offset: 2px;
        border-radius: var(--radius-sm);
    }
    
    /* Active States - فقط برای مناسب elements، navigation رو exclude می‌کنه */
    button:active:not([id*="nav"]):not([class*="nav"]):not([class*="sn-"]):not([class*="menu"]),
    .btn:active:not([id*="nav"]):not([class*="nav"]):not([class*="sn-"]):not([class*="menu"]),
    input[type="submit"]:active,
    input[type="button"]:active,
    input[type="reset"]:active,
    .clickable:active:not([id*="nav"]):not([class*="nav"]):not([class*="sn-"]):not([class*="menu"]) {
        transform: translateY(1px);
    }
    
    /* Disabled States - فقط برای form elements */
    input:disabled,
    textarea:disabled,
    select:disabled,
    button:disabled,
    input[disabled],
    textarea[disabled],
    select[disabled],
    button[disabled],
    input[aria-disabled="true"],
    textarea[aria-disabled="true"],
    select[aria-disabled="true"],
    button[aria-disabled="true"],
    .btn[disabled],
    .btn[aria-disabled="true"] {
        opacity: 0.6;
        cursor: not-allowed;
        pointer-events: none;
    }
    
    /* Loading States */
    .is-loading {
        position: relative;
        color: transparent !important;
        pointer-events: none;
    }
    
    .is-loading::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        left: 50%;
        margin-left: -10px;
        margin-top: -10px;
        border: 2px solid var(--primary);
        border-radius: 50%;
        border-top-color: transparent;
        animation: spin 0.8s linear infinite;
    }
    
    /* Skeleton Loading - Fixed syntax */
    .skeleton {
        position: relative;
        overflow: hidden;
        background-color: var(--gray-200);
    }
    
    .skeleton::after {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        transform: translateX(-100%);
        background: linear-gradient(
            90deg,
            transparent,
            rgba(255, 255, 255, 0.2),
            transparent
        );
        animation: skeleton-loading 1.5s infinite;
        content: '';
    }
    
    @keyframes skeleton-loading {
        100% {
            transform: translateX(100%);
        }
    }
    
    /* Validation States - فقط برای form elements */
    input.is-valid,
    textarea.is-valid,
    select.is-valid,
    .form-control.is-valid {
        border-color: var(--success) !important;
    }
    
    input.is-invalid,
    textarea.is-invalid,
    select.is-invalid,
    .form-control.is-invalid {
        border-color: var(--danger) !important;
    }
    
    input.is-warning,
    textarea.is-warning,
    select.is-warning,
    .form-control.is-warning {
        border-color: var(--warning) !important;
    }
    
    /* Status Classes */
    .status-pending {
        background-color: var(--warning-light);
        color: var(--warning);
    }
    
    .status-approved {
        background-color: var(--success-light);
        color: var(--success);
    }
    
    .status-rejected {
        background-color: var(--danger-light);
        color: var(--danger);
    }
    
    /* Button specific states - navigation buttons excluded */
    .btn:hover:not([disabled]):not([aria-disabled="true"]) {
        transform: translateY(-2px);
    }
    
    .btn:active:not([disabled]):not([aria-disabled="true"]):not([id*="nav"]):not([class*="nav"]):not([class*="sn-"]) {
        transform: translateY(0);
    }
    
    /* Form specific interactions */
    .form-group:has(input:focus),
    .form-group:has(textarea:focus),
    .form-group:has(select:focus) {
        transform: translateY(-1px);
        transition: transform 0.3s ease;
    }
    
    /* Card hover states - navigation cards excluded */
    .card:hover:not([id*="nav"]):not([class*="nav"]):not([class*="sn-"]) {
        transform: translateY(-3px);
        box-shadow: var(--shadow-elevation-medium);
    }
    
    /* Interactive elements hover - navigation excluded */
    .interactive:hover:not([id*="nav"]):not([class*="nav"]):not([class*="sn-"]),
    .clickable:hover:not([id*="nav"]):not([class*="nav"]):not([class*="sn-"]) {
        transform: translateY(-1px);
        transition: transform 0.3s ease;
    }
    
    /* Table row hover */
    tr:hover td {
        background-color: var(--gray-50);
    }
    
    /* Image hover effects */
    img.hoverable:hover {
        transform: scale(1.02);
        transition: transform 0.3s ease;
    }
    
    /* Link hover states - navigation links excluded */
    a:hover:not([id*="nav"]):not([class*="nav"]):not([class*="sn-"]):not([class*="menu"]) {
        text-decoration: underline;
        transition: all 0.3s ease;
    }
    
    /* Smooth transitions for interactive elements */
    button:not([id*="nav"]):not([class*="nav"]):not([class*="sn-"]),
    .btn:not([id*="nav"]):not([class*="nav"]):not([class*="sn-"]),
    .card:not([id*="nav"]):not([class*="nav"]):not([class*="sn-"]),
    .interactive:not([id*="nav"]):not([class*="nav"]):not([class*="sn-"]),
    .clickable:not([id*="nav"]):not([class*="nav"]):not([class*="sn-"]) {
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    
    /* Focus ring for accessibility */
    .focus-ring:focus,
    .focus-ring:focus-visible {
        outline: 3px solid var(--primary);
        outline-offset: 2px;
        border-radius: var(--radius-md);
    }
    
    /* Ripple effect for buttons - navigation excluded */
    .btn-ripple:not([id*="nav"]):not([class*="nav"]):not([class*="sn-"]) {
        position: relative;
        overflow: hidden;
    }
    
    .btn-ripple:not([id*="nav"]):not([class*="nav"]):not([class*="sn-"])::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.3s ease, height 0.3s ease;
    }
    
    .btn-ripple:not([id*="nav"]):not([class*="nav"]):not([class*="sn-"]):active::before {
        width: 300px;
        height: 300px;
    }
    
    /* Custom checkbox/radio states */
    input[type="checkbox"]:checked + label,
    input[type="radio"]:checked + label {
        color: var(--primary);
        font-weight: 500;
    }
    
    /* Progress bar animations */
    .progress-bar {
        transition: width 0.6s ease;
    }
    
    .progress-bar.animated {
        animation: progress-fill 2s ease-in-out;
    }
    
    @keyframes progress-fill {
        from {
            width: 0%;
        }
        to {
            width: var(--progress-width, 100%);
        }
    }
    
    /* Accordion states */
    .accordion-toggle:active {
        transform: none; /* Override general active state */
    }
    
    .accordion-content {
        transition: max-height 0.3s ease, opacity 0.3s ease;
    }
    
    /* Modal and overlay states */
    .modal.show {
        animation: modal-show 0.3s ease;
    }
    
    .modal.hide {
        animation: modal-hide 0.3s ease;
    }
    
    @keyframes modal-show {
        from {
            opacity: 0;
            transform: scale(0.8);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    @keyframes modal-hide {
        from {
            opacity: 1;
            transform: scale(1);
        }
        to {
            opacity: 0;
            transform: scale(0.8);
        }
    }
    
    /* Tooltip states */
    .tooltip {
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }
    
    .tooltip.show {
        opacity: 1;
        visibility: visible;
    }
    
    /* Alert states */
    .alert {
        transition: all 0.3s ease;
    }
    
    .alert.dismissing {
        opacity: 0;
        transform: translateY(-10px);
    }
}
/* =============================================================================
   11. ADVANCED PATTERNS - الگوهای پیشرفته
   ============================================================================= */

@layer patterns {
    /* ========== HERO PATTERNS ========== */
    .hero-pattern {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    
    .hero-pattern::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: 
            radial-gradient(circle at 20% 80%, transparent 50%, rgba(120, 119, 198, 0.3) 50%),
            radial-gradient(circle at 80% 20%, transparent 50%, rgba(255, 107, 139, 0.3) 50%);
        z-index: -1;
    }
    
    /* ========== GRID PATTERNS ========== */
    .pattern-dots {
        background-image: radial-gradient(circle, var(--gray-400) 1px, transparent 1px);
        background-size: 20px 20px;
    }
    
    .pattern-grid {
        background-image: 
            linear-gradient(var(--gray-200) 1px, transparent 1px),
            linear-gradient(90deg, var(--gray-200) 1px, transparent 1px);
        background-size: 20px 20px;
    }
    
    .pattern-diagonal {
        background-image: repeating-linear-gradient(
            45deg,
            var(--gray-200),
            var(--gray-200) 10px,
            transparent 10px,
            transparent 20px
        );
    }
    
    /* ========== GRADIENT MESH PATTERN ========== */
    .gradient-mesh {
        position: relative;
        overflow: hidden;
    }
    
    .gradient-mesh::before {
        content: '';
        position: absolute;
        inset: -50%;
        background: var(--gradient-mesh-purple);
        filter: blur(40px);
        opacity: 0.7;
        animation: morph 20s ease-in-out infinite;
    }
    
    /* ========== GLASSMORPHISM CARDS ========== */
    .glass-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: var(--radius-2xl);
        border: 1px solid rgba(255, 255, 255, 0.18);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        padding: var(--space-8);
        position: relative;
        overflow: hidden;
    }
    
    .glass-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(
            135deg,
            rgba(255, 255, 255, 0.1) 0%,
            rgba(255, 255, 255, 0) 100%
        );
        pointer-events: none;
    }
    
    /* ========== NEUMORPHISM PATTERN ========== */
    .neumorphic {
        background: var(--bg-light);
        border-radius: var(--radius-xl);
        box-shadow: 
            20px 20px 60px #d3d3d3,
            -20px -20px 60px #ffffff;
    }
    
    .neumorphic-inset {
        background: var(--bg-light);
        border-radius: var(--radius-xl);
        box-shadow: 
            inset 20px 20px 60px #d3d3d3,
            inset -20px -20px 60px #ffffff;
    }
    
    /* ========== AURORA PATTERN ========== */
    .aurora {
        position: relative;
        overflow: hidden;
        background: var(--gradient-dark);
    }
    
    .aurora::before,
    .aurora::after {
        content: '';
        position: absolute;
        width: 200%;
        height: 200%;
        background: radial-gradient(
            ellipse at center,
            rgba(120, 119, 198, 0.3) 0%,
            transparent 70%
        );
    }
    
    .aurora::before {
        top: -50%;
        left: -50%;
        animation: aurora-1 15s ease-in-out infinite;
    }
    
    .aurora::after {
        bottom: -50%;
        right: -50%;
        animation: aurora-2 20s ease-in-out infinite;
    }
    
    @keyframes aurora-1 {
        0%, 100% {
            transform: translateX(0) translateY(0);
        }
        33% {
            transform: translateX(100px) translateY(100px);
        }
        66% {
            transform: translateX(-100px) translateY(100px);
        }
    }
    
    @keyframes aurora-2 {
        0%, 100% {
            transform: translateX(0) translateY(0);
        }
        33% {
            transform: translateX(-100px) translateY(-100px);
        }
        66% {
            transform: translateX(100px) translateY(-100px);
        }
    }
    
    /* ========== SPOTLIGHT PATTERN ========== */
    .spotlight {
        position: relative;
        overflow: hidden;
    }
    
    .spotlight::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background: radial-gradient(
            circle at var(--mouse-x, 50%) var(--mouse-y, 50%),
            rgba(var(--primary-rgb), 0.15) 0%,
            transparent 50%
        );
        pointer-events: none;
        transition: opacity 0.3s ease;
        opacity: 0;
    }
    
    .spotlight:hover::before {
        opacity: 1;
    }
    
    /* ========== PARTICLE EFFECT ========== */
    .particles {
        position: relative;
    }
    
    .particle {
        position: absolute;
        width: 4px;
        height: 4px;
        background: var(--primary);
        border-radius: 50%;
        pointer-events: none;
    }
    
    /* 
    The following SCSS loop was removed because CSS does not support @for.
    If you need multiple .particle elements with different positions/animations,
    generate the CSS for each manually or use JavaScript for dynamic effects.
    */
    
    @keyframes float-particle {
        from {
            transform: translateY(0) translateX(0);
        }
        to {
            transform: translateY(-100vh) translateX(-50px);
        }
    }
}

/* =============================================================================
   12. PERFORMANCE OPTIMIZATIONS - بهینه‌سازی عملکرد
   ============================================================================= */

@layer components {
    /* Hardware Acceleration */
    .gpu {
        transform: translateZ(0);
        will-change: transform;
        backface-visibility: hidden;
        perspective: 1000px;
    }
    
    /* Content Visibility */
    .content-auto {
        content-visibility: auto;
        contain-intrinsic-size: 0 500px;
    }
    
    /* Contain */
    .contain-layout {
        contain: layout;
    }
    
    .contain-paint {
        contain: paint;
    }
    
    .contain-size {
        contain: size;
    }
    
    .contain-style {
        contain: style;
    }
    
    .contain-strict {
        contain: strict;
    }
    
    .contain-content {
        contain: content;
    }
    
    /* Performance Hints */
    @media (prefers-reduced-motion: no-preference) {
        .parallax {
            transform-style: preserve-3d;
            perspective: 100px;
        }
        
        .parallax-layer {
            position: absolute;
            inset: 0;
            transform: translateZ(var(--parallax-offset, 0)) scale(var(--parallax-scale, 1));
        }
    }
}

/* =============================================================================
   13. ACCESSIBILITY FEATURES - ویژگی‌های دسترسی‌پذیری
   ============================================================================= */

@layer components {
    /* Skip to Content */
    .skip-to-content {
        position: absolute;
        top: -40px;
        left: 0;
        background: var(--primary);
        color: var(--white);
        padding: var(--space-2) var(--space-4);
        border-radius: var(--radius-md);
        text-decoration: none;
        z-index: var(--z-tooltip);
        transition: top var(--duration-fast) var(--ease-out);
    }
    
    .skip-to-content:focus {
        top: var(--space-4);
    }
    
    /* Focus Trap */
    [data-focus-trap="true"] {
        position: relative;
    }
    
    [data-focus-trap="true"]:focus-within {
        outline: 2px dashed var(--primary);
        outline-offset: 4px;
    }
    
    /* Reduced Motion */
    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            animation-play-state: paused !important;
            transition: none !important;
            scroll-behavior: auto !important;
        }
    }
    
    /* High Contrast Mode */
    @media (prefers-contrast: high) {
        * {
            border-color: WindowText !important;
        }
        
        .btn {
            border: 2px solid WindowText !important;
        }
        
        a {
            text-decoration: underline !important;
        }
    }
    
    /* Color Scheme */
    @media (prefers-color-scheme: dark) {
        .auto-dark {
            --text-color: var(--gray-100);
            --bg-primary: var(--gray-900);
        }
    }
    
    /* Forced Colors Mode */
    @media (forced-colors: active) {
        .btn {
            border: 1px solid ButtonText;
        }
    }
    
    /* Touch Target Size */
    .touch-target {
        position: relative;
        min-width: 44px;
        min-height: 44px;
    }
    
    .touch-target::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 44px;
        height: 44px;
        min-width: 100%;
        min-height: 100%;
    }
}

/* =============================================================================
   14. PRINT & MEDIA QUERIES - چاپ و مدیا کوئری‌ها
   ============================================================================= */

/* Print Styles */
@media print {
    @page {
        size: A4 portrait;
        margin: 2cm;
    }
    
    *,
    *::before,
    *::after {
        background: transparent !important;
        color: #000 !important;
        box-shadow: none !important;
        text-shadow: none !important;
    }
    
    body {
        font-size: 12pt;
        line-height: 1.5;
    }
    
    a,
    a:visited {
        text-decoration: underline;
    }
    
    a[href^="http"]:after {
        content: " (" attr(href) ")";
        font-size: 90%;
    }
    
    a[href^="#"]:after,
    a[href^="javascript:"]:after {
        content: "";
    }
    
    abbr[title]:after {
        content: " (" attr(title) ")";
    }
    
    pre,
    blockquote {
        border: 1px solid #999;
        page-break-inside: avoid;
    }
    
    thead {
        display: table-header-group;
    }
    
    tr,
    img {
        page-break-inside: avoid;
    }
    
    img {
        max-width: 100% !important;
    }
    
    p,
    h2,
    h3 {
        orphans: 3;
        widows: 3;
    }
    
    h2,
    h3 {
        page-break-after: avoid;
    }
    
    /* Hide non-printable elements */
    .no-print,
    .cosmic-header,
    .back-to-top,
    nav,
    footer,
    .btn-print,
    .action-buttons,
    video,
    audio,
    iframe {
        display: none !important;
    }
    
    /* Print-specific styles */
    .print-break-before {
        page-break-before: always;
    }
    
    .print-break-after {
        page-break-after: always;
    }
    
    .print-break-inside-avoid {
        page-break-inside: avoid;
    }
    
    /* Status colors for print */
    .status-pending {
        border: 2px solid #000;
        padding: 2px 4px;
    }
    
    .status-pending::before {
        content: "[PENDING] ";
    }
    
    .status-approved::before {
        content: "[APPROVED] ";
    }
    
    .status-rejected::before {
        content: "[REJECTED] ";
    }
}

/* Responsive Design System */
/* Mobile First Approach */

/* Small devices (landscape phones, 576px and up) */
@media (min-width: 576px) {
    .container {
        max-width: 540px;
    }
    
    .sm\:block { display: block !important; }
    .sm\:inline-block { display: inline-block !important; }
    .sm\:inline { display: inline !important; }
    .sm\:flex { display: flex !important; }
    .sm\:inline-flex { display: inline-flex !important; }
    .sm\:grid { display: grid !important; }
    .sm\:hidden { display: none !important; }
    
    .sm\:grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)); }
    .sm\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .sm\:grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    .sm\:grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
    
    .sm\:text-sm { font-size: var(--font-size-sm) !important; }
    .sm\:text-base { font-size: var(--font-size-base) !important; }
    .sm\:text-lg { font-size: var(--font-size-lg) !important; }
    .sm\:text-xl { font-size: var(--font-size-xl) !important; }
    .sm\:text-2xl { font-size: var(--font-size-2xl) !important; }
    .sm\:text-3xl { font-size: var(--font-size-3xl) !important; }
    .sm\:text-4xl { font-size: var(--font-size-4xl) !important; }
}

/* Medium devices (tablets, 768px and up) */
@media (min-width: 768px) {
    .container {
        max-width: 720px;
    }
    
    .md\:block { display: block !important; }
    .md\:inline-block { display: inline-block !important; }
    .md\:inline { display: inline !important; }
    .md\:flex { display: flex !important; }
    .md\:inline-flex { display: inline-flex !important; }
    .md\:grid { display: grid !important; }
    .md\:hidden { display: none !important; }
    
    .md\:grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)); }
    .md\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .md\:grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    .md\:grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
    .md\:grid-cols-5 { grid-template-columns: repeat(5, minmax(0, 1fr)); }
    .md\:grid-cols-6 { grid-template-columns: repeat(6, minmax(0, 1fr)); }
    
    .md\:text-sm { font-size: var(--font-size-sm) !important; }
    .md\:text-base { font-size: var(--font-size-base) !important; }
    .md\:text-lg { font-size: var(--font-size-lg) !important; }
    .md\:text-xl { font-size: var(--font-size-xl) !important; }
    .md\:text-2xl { font-size: var(--font-size-2xl) !important; }
    .md\:text-3xl { font-size: var(--font-size-3xl) !important; }
    .md\:text-4xl { font-size: var(--font-size-4xl) !important; }
    .md\:text-5xl { font-size: var(--font-size-5xl) !important; }
}

/* Large devices (desktops, 992px and up) */
@media (min-width: 992px) {
    .container {
        max-width: 960px;
    }
    
    .lg\:block { display: block !important; }
    .lg\:inline-block { display: inline-block !important; }
    .lg\:inline { display: inline !important; }
    .lg\:flex { display: flex !important; }
    .lg\:inline-flex { display: inline-flex !important; }
    .lg\:grid { display: grid !important; }
    .lg\:hidden { display: none !important; }
    
    .lg\:grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)); }
    .lg\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .lg\:grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    .lg\:grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
    .lg\:grid-cols-5 { grid-template-columns: repeat(5, minmax(0, 1fr)); }
    .lg\:grid-cols-6 { grid-template-columns: repeat(6, minmax(0, 1fr)); }
    
    .cosmic-header {
        padding: 200px 0 160px;
    }
    
    .section-heading {
        font-size: var(--font-size-3xl);
    }
}

/* Extra large devices (large desktops, 1200px and up) */
@media (min-width: 1200px) {
    .container {
        max-width: 1140px;
    }
    
    .xl\:block { display: block !important; }
    .xl\:inline-block { display: inline-block !important; }
    .xl\:inline { display: inline !important; }
    .xl\:flex { display: flex !important; }
    .xl\:inline-flex { display: inline-flex !important; }
    .xl\:grid { display: grid !important; }
    .xl\:hidden { display: none !important; }
    
    .xl\:grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)); }
    .xl\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .xl\:grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    .xl\:grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
    .xl\:grid-cols-5 { grid-template-columns: repeat(5, minmax(0, 1fr)); }
    .xl\:grid-cols-6 { grid-template-columns: repeat(6, minmax(0, 1fr)); }
    .xl\:grid-cols-7 { grid-template-columns: repeat(7, minmax(0, 1fr)); }
    .xl\:grid-cols-8 { grid-template-columns: repeat(8, minmax(0, 1fr)); }
}

/* XXL devices (larger desktops, 1400px and up) */
@media (min-width: 1400px) {
    .container {
        max-width: 1320px;
    }
    
    .xxl\:block { display: block !important; }
    .xxl\:inline-block { display: inline-block !important; }
    .xxl\:inline { display: inline !important; }
    .xxl\:flex { display: flex !important; }
    .xxl\:inline-flex { display: inline-flex !important; }
    .xxl\:grid { display: grid !important; }
    .xxl\:hidden { display: none !important; }
}

/* Mobile Specific */
@media (max-width: 767.98px) {
    :root {
        --section-spacing: var(--space-16);
        --section-spacing-sm: var(--space-12);
    }    
    /* Mobile Navigation */
    .mobile-menu {
        position: fixed;
        inset: 0;
        background: var(--bg-primary);
        z-index: var(--z-modal);
        transform: translateX(-100%);
        transition: transform var(--duration-normal) var(--ease-out);
    }
    
    .mobile-menu.active {
        transform: translateX(0);
    }
    
    [dir="rtl"] .mobile-menu {
        transform: translateX(100%);
    }
    
    [dir="rtl"] .mobile-menu.active {
        transform: translateX(0);
    }
}

/* Touch Device Optimizations */
@media (hover: none) and (pointer: coarse) {
    .btn {
        min-height: 44px;
        min-width: 44px;
    }
    
    .hover-lift:active {
        transform: translateY(-5px);
    }
    
    .hover-scale:active {
        transform: scale(1.05);
    }
}

/* =============================================================================
   15. EXPERIMENTAL FEATURES - ویژگی‌های آزمایشی
   ============================================================================= */

@layer components {
    /* CSS Houdini Paint API */
    @supports (background: paint(smooth-corners)) {
        .smooth-corners {
            --smooth-corners-radius: var(--radius-xl);
            background: paint(smooth-corners);
            border-radius: 0;
        }
    }
    
    /* Scroll Timeline */
    @supports (animation-timeline: scroll()) {
        .scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
            transform-origin: left;
            animation: scroll-progress linear;
            animation-timeline: scroll(root);
        }
        
        @keyframes scroll-progress {
            from {
                transform: scaleX(0);
            }
            to {
                transform: scaleX(1);
            }
        }
    }
    
    /* View Transitions API */
    @supports (view-transition-name: root) {
        ::view-transition-old(root),
        ::view-transition-new(root) {
            animation-duration: 0.25s;
            animation-timing-function: var(--ease-out);
        }
        
        .view-transition-fade {
            view-transition-name: fade;
        }
        
        .view-transition-slide {
            view-transition-name: slide;
        }
    }
    
    /* Container Style Queries */
    @supports (container-type: style) {
        @container style(--theme: dark) {
            .container-dark {
                background: var(--dark-color);
                color: var(--text-white);
            }
        }
    }
    
    /* Anchor Positioning */
    @supports (anchor-name: --anchor) {
        .anchor {
            anchor-name: --anchor;
        }
        
        .anchored {
            position: absolute;
            position-anchor: --anchor;
            inset-block-start: anchor(end);
            inset-inline-start: anchor(center);
        }
    }
    
    /* Cascade Layers for Themes */
    @layer theme.light {
        [data-theme="light"] {
            color-scheme: light;
        }
    }
    
    @layer theme.dark {
        [data-theme="dark"] {
            color-scheme: dark;
        }
    }
}

/* =============================================================================
   16. RTL SUPPORT SYSTEM - سیستم پشتیبانی از RTL
   ============================================================================= */

[dir="rtl"] {
    direction: rtl;
    text-align: right;
}

/* RTL Specific Adjustments */
[dir="rtl"] {
    /* Spacing */
    .ml-auto { margin-left: initial !important; margin-right: auto !important; }
    .mr-auto { margin-right: initial !important; margin-left: auto !important; }
    
    /* Text */
    .text-left { text-align: right !important; }
    .text-right { text-align: left !important; }
    
    /* Position */
    .left-0 { left: initial !important; right: 0 !important; }
    .right-0 { right: initial !important; left: 0 !important; }
    
    /* Transform */
    .translate-x-1 { transform: translateX(calc(var(--space-1) * -1)) !important; }
    .translate-x-2 { transform: translateX(calc(var(--space-2) * -1)) !important; }
    .-translate-x-1 { transform: translateX(var(--space-1)) !important; }
    .-translate-x-2 { transform: translateX(var(--space-2)) !important; }
    
    /* Border Radius */
    .rounded-l-none { border-top-left-radius: initial !important; border-bottom-left-radius: initial !important; border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; }
    .rounded-r-none { border-top-right-radius: initial !important; border-bottom-right-radius: initial !important; border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; }
    
    /* Float */
    .float-left { float: right !important; }
    .float-right { float: left !important; }
    
    /* Icons */
    .fa-arrow-right:before { content: "\f060"; }
    .fa-arrow-left:before { content: "\f061"; }
    .fa-chevron-right:before { content: "\f053"; }
    .fa-chevron-left:before { content: "\f054"; }
    .fa-angle-right:before { content: "\f104"; }
    .fa-angle-left:before { content: "\f105"; }
}

/* =============================================================================
   17. CUSTOM SCROLLBAR - اسکرول‌بار سفارشی
   ============================================================================= */

/* Webkit Browsers */
::-webkit-scrollbar {
    width: 12px;
    height: 12px;
}

::-webkit-scrollbar-track {
    background: var(--gray-100);
    border-radius: var(--radius-full);
}

::-webkit-scrollbar-thumb {
    background: var(--gradient-primary);
    border-radius: var(--radius-full);
    border: 2px solid var(--gray-100);
    transition: all var(--duration-fast) var(--ease-out);
}

::-webkit-scrollbar-thumb:hover {
    background: var(--gradient-purple);
    border-color: var(--gray-200);
}

::-webkit-scrollbar-corner {
    background: var(--gray-100);
}

/* Firefox */
* {
    scrollbar-width: thin;
    scrollbar-color: var(--primary) var(--gray-100);
}

/* =============================================================================
   18. CUSTOM PROPERTIES FOR JS INTEGRATION
   ============================================================================= */

:root {
    /* Mouse Position for Interactive Effects */
    --mouse-x: 50%;
    --mouse-y: 50%;
    
    /* Scroll Progress */
    --scroll-progress: 0;
    
    /* Theme Toggle */
    --theme-transition: color 200ms, background-color 200ms;
}

/* =============================================================================
   19. DEVELOPER UTILITIES - ابزارهای توسعه‌دهندگان
   ============================================================================= */

/* Debug Mode */
.debug * {
    outline: 1px solid rgba(255, 0, 0, 0.2);
}

.debug *:hover {
    outline: 2px solid rgba(255, 0, 0, 0.8);
    outline-offset: 2px;
}

/* Grid Overlay */
.debug-grid {
    position: relative;
}

.debug-grid::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: 
        repeating-linear-gradient(0deg, rgba(0, 255, 255, 0.1) 0px, transparent 1px, transparent 10px, rgba(0, 255, 255, 0.1) 11px),
        repeating-linear-gradient(90deg, rgba(0, 255, 255, 0.1) 0px, transparent 1px, transparent 10px, rgba(0, 255, 255, 0.1) 11px);
    pointer-events: none;
    z-index: var(--z-tooltip);
}

/* Performance Monitor */
.perf-monitor {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: rgba(0, 0, 0, 0.8);
    color: #0f0;
    font-family: var(--font-mono);
    font-size: 12px;
    padding: 10px;
    border-radius: var(--radius-md);
    z-index: var(--z-tooltip);
}

/* =============================================================================
   20. OVERRIDES & FINAL ADJUSTMENTS
   ============================================================================= */

@layer overrides {
    /* Force Styles */
    .important-primary { color: var(--primary) !important; }
    .important-white { color: var(--white) !important; }
    .important-center { text-align: center !important; }
    
    /* Compatibility Fixes */
    .clearfix::after {
        content: "";
        display: table;
        clear: both;
    }
    
    /* Legacy Support */
    .pull-left { float: left !important; }
    .pull-right { float: right !important; }
    .center-block { display: block !important; margin-left: auto !important; margin-right: auto !important; }
    
    /* Final Reset for Specific Elements */
    dialog {
        padding: 0;
        border: none;
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-elevation-high);
    }
    
    details > summary {
        cursor: pointer;
        list-style: none;
    }
    
    details > summary::-webkit-details-marker {
        display: none;
    }
}

/* ╔═══════════════════════════════════════════════════════════════════════════════════════╗
   ║                                    END OF MAIN CSS                                    ║
   ║                              پایان سیستم CSS فوق حرفه‌ای                              ║
   ╚═══════════════════════════════════════════════════════════════════════════════════════╝ */
</style>