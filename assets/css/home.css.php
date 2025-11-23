<style>
        /**
         * Space-Themed Creative Styling for Salman Farsi Educational Complex
         * A celestial-inspired design system with premium visual elements
         */
         
        /****************************
         * VARIABLES
         ****************************/
        :root {
            /* Primary Color Scheme - Celestial Theme */
            --sky-blue: #6C9EFF;
            --light-blue: #87CEFA;
            --purple: #9471FF;
            --deep-purple: #6C63FF;
            --light-purple: #A89BFF;
            --pink: #FF6B8B;
            --teal: #36F1CD;
            --yellow: #FFDE59;
            --orange: #FF8A65;
            
            /* Backgrounds */
            --light-sky: #E8F5FF;
            --light-star: #F8F9FE;
            --light-purple-bg: #F5F3FF;
            --medium-purple-bg: #E0E0FF;
            
            /* Gradients */
            --sky-gradient: linear-gradient(135deg, #87CEFA 0%, #6C9EFF 100%);
            --purple-gradient: linear-gradient(135deg, #9471FF 0%, #6C63FF 100%);
            --soft-gradient: linear-gradient(135deg, #E0E0FF 0%, #F5F3FF 100%);
            --sunset-gradient: linear-gradient(45deg, #6C63FF 0%, #FF6B8B 50%, #FFDE59 100%);
            --cosmic-gradient: linear-gradient(135deg, #1e0057 0%, #391e85 50%, #6C63FF 100%);
            
            /* Typography */
            --body-font: <?php echo $isRtl ? '"Vazirmatn", sans-serif' : '"Plus Jakarta Sans", sans-serif'; ?>;
            --heading-font: <?php echo $isRtl ? '"Vazirmatn", sans-serif' : '"Plus Jakarta Sans", sans-serif'; ?>;
            --base-font-size: 16px;
            --base-line-height: 1.7;
            --heading-weight: 700;
            
            /* Spacing */
            --section-spacing: 100px;
            --section-spacing-sm: 70px;
            --content-spacing: 50px;
            --element-spacing: 30px;
            --gap-spacing: 20px;
            
            /* Borders */
            --border-radius-xs: 6px;
            --border-radius-sm: 10px;
            --border-radius: 16px;
            --border-radius-lg: 24px;
            --border-radius-xl: 32px;
            --border-radius-pill: 100px;
            --border-radius-circle: 50%;
            
            /* Shadows */
            --shadow-sm: 0 4px 10px rgba(0, 0, 0, 0.05);
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 20px 40px rgba(0, 0, 0, 0.15);
            --glow-shadow: 0 0 20px rgba(108, 99, 255, 0.4);
            --purple-shadow: 0 5px 15px rgba(108, 99, 255, 0.3);
            --blue-shadow: 0 5px 15px rgba(108, 158, 255, 0.3);
            
            /* Transitions */
            --transition-fast: 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            --transition-medium: 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
            --transition-slow: 0.8s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        /**
        * Word-like Natural Justified Text
        * Optimized for both RTL and LTR
        */

        /* پایه برای همه متن‌ها */
        .text-natural-justify {
            text-align: justify;
            text-justify: inter-word;
            hyphens: auto;
            word-spacing: normal;
            /* جلوگیری از فاصله‌های بیش از حد */
            word-break: normal;
            overflow-wrap: break-word;
        }

        /* تنظیمات مخصوص برای متون فارسی/عربی */
        [dir="rtl"] .text-natural-justify {
            text-align-last: right; /* آخرین خط راست‌چین باشد */
            letter-spacing: -0.2px; /* کاهش بسیار جزئی فاصله حروف برای متون فارسی/عربی */
        }

        /* تنظیمات برای متون انگلیسی */
        [dir="ltr"] .text-natural-justify {
            text-align-last: left; /* آخرین خط چپ‌چین باشد */
            letter-spacing: 0.2px; /* افزایش بسیار جزئی فاصله حروف برای متون انگلیسی */
        }

        /* بهبود برای پاراگراف‌ها */
        p.text-natural-justify {
            line-height: 1.8;
            margin-bottom: 1rem;
        }

        /* تنظیمات برای عناصر خاص سایت */
        .hero-description,
        .about-text,
        .edu-path-text,
        .section-description,
        .testimonial-content p,
        .blog-excerpt,
        .faq-answer-content p {
            text-align: justify;
            text-justify: inter-word;
            hyphens: auto;
            word-spacing: normal;
            overflow-wrap: break-word;
            max-width: 100%;
        }

        /* تنظیم جهت آخرین خط براساس زبان */
        [dir="rtl"] .hero-description,
        [dir="rtl"] .about-text,
        [dir="rtl"] .edu-path-text,
        [dir="rtl"] .section-description,
        [dir="rtl"] .testimonial-content p,
        [dir="rtl"] .blog-excerpt,
        [dir="rtl"] .faq-answer-content p {
            text-align-last: right;
            letter-spacing: -0.2px;
        }

        [dir="ltr"] .hero-description,
        [dir="ltr"] .about-text,
        [dir="ltr"] .edu-path-text,
        [dir="ltr"] .section-description,
        [dir="ltr"] .testimonial-content p,
        [dir="ltr"] .blog-excerpt,
        [dir="ltr"] .faq-answer-content p {
            text-align-last: left;
            letter-spacing: 0.2px;
        }

        /* افزودن تنظیمات پیشرفته برای جاستیفای طبیعی‌تر */
        @supports (text-justify: newspaper) {
            .text-natural-justify,
            .hero-description,
            .about-text,
            .edu-path-text,
            .section-description,
            .testimonial-content p,
            .blog-excerpt,
            .faq-answer-content p {
                text-justify: newspaper;
            }
        }

        /* بهینه‌سازی فاصله بین کلمات */
        .text-natural-justify,
        .hero-description,
        .about-text,
        .edu-path-text,
        .section-description,
        .testimonial-content p,
        .blog-excerpt,
        .faq-answer-content p {
            /* این خاصیت برای کنترل حداکثر فاصله بین کلمات است */
            word-spacing-max: 0.25em;
        }

        /* تنظیمات برای عرض‌های مختلف */
        @media (max-width: 991px) {
            .text-natural-justify,
            .hero-description,
            .about-text,
            .edu-path-text,
            .section-description,
            .testimonial-content p,
            .blog-excerpt,
            .faq-answer-content p {
                /* در عرض‌های کمتر، justify را غیرفعال می‌کنیم تا خوانایی بهتر شود */
                text-align: inherit;
            }
            
            [dir="rtl"] .text-natural-justify,
            [dir="rtl"] .hero-description,
            [dir="rtl"] .about-text,
            [dir="rtl"] .edu-path-text,
            [dir="rtl"] .section-description,
            [dir="rtl"] .testimonial-content p,
            [dir="rtl"] .blog-excerpt,
            [dir="rtl"] .faq-answer-content p {
                text-align: right;
            }
            
            [dir="ltr"] .text-natural-justify,
            [dir="ltr"] .hero-description,
            [dir="ltr"] .about-text,
            [dir="ltr"] .edu-path-text,
            [dir="ltr"] .section-description,
            [dir="ltr"] .testimonial-content p,
            [dir="ltr"] .blog-excerpt,
            [dir="ltr"] .faq-answer-content p {
                text-align: left;
            }
        }

        /* تنظیمات برای نمایش justify شبیه به Word */
        /* این تکنیک با ایجاد یک لایه typography پیشرفته‌تر، نمایش justify را بهبود می‌بخشد */
        .word-like-typography {
            text-rendering: optimizeLegibility;
            font-kerning: normal;
            font-feature-settings: "kern" 1, "liga" 1, "calt" 1;
            font-variant-ligatures: common-ligatures contextual;
            font-variant-numeric: proportional-nums;
        }

        [dir="rtl"] .word-like-typography {
            /* تنظیمات مخصوص فونت‌های عربی/فارسی */
            font-feature-settings: "kern" 1, "medi" 1, "init" 1, "fina" 1;
        }

        /* کلاس اضافی برای تنظیم margin مناسب پاراگراف‌ها */
        .paragraph-spacing p {
            margin-bottom: 1.5em;
        }

        .paragraph-spacing p:last-child {
            margin-bottom: 0;
        }
        /****************************
         * BASE STYLES
         ****************************/
        html {
            font-size: var(--base-font-size);
            scroll-behavior: smooth;
        }
        
        body {
            font-family: var(--body-font);
            font-size: 1rem;
            line-height: var(--base-line-height);
            color: #555;
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
                radial-gradient(2px 2px at 15% 85%, rgba(150, 150, 255, 0.9) 0%, rgba(150, 150, 255, 0) 100%);
            background-size: 100% 100%;
            background-repeat: no-repeat;
            z-index: -2;
            opacity: 0.2;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: var(--heading-font);
            font-weight: var(--heading-weight);
            line-height: 1.3;
            color: #333;
            margin-bottom: 1rem;
        }
        
        p {
            margin-bottom: 1.5rem;
        }
        
        a {
            color: var(--deep-purple);
            text-decoration: none;
            transition: color var(--transition-fast);
        }
        
        a:hover {
            color: var(--purple);
        }
        
        img {
            max-width: 100%;
            height: auto;
        }
        
        section {
            position: relative;
            padding: var(--section-spacing) 0;
            overflow: hidden;
        }
        
        @media (max-width: 991px) {
            section {
                padding: var(--section-spacing-sm) 0;
            }
        }

        /****************************
         * UTILITY CLASSES
         ****************************/
        .bg-sky {
            background-color: var(--light-sky) !important;
        }
        
        .bg-soft-purple {
            background-color: var(--light-purple-bg) !important;
        }
        
        .bg-medium-purple {
            background-color: var(--medium-purple-bg) !important;
        }
        
        .bg-white {
            background-color: #fff !important;
        }
        
        .bg-gradient-sky {
            background: var(--sky-gradient) !important;
            color: #fff;
        }
        
        .bg-gradient-purple {
            background: var(--purple-gradient) !important;
            color: #fff;
        }
        
        .bg-gradient-sunset {
            background: var(--sunset-gradient) !important;
            color: #fff;
        }
        
        .text-gradient {
            background: var(--purple-gradient);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            color: var(--deep-purple);
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
        
        .text-sky {
            color: var(--sky-blue) !important;
        }
        
        .text-purple {
            color: var(--deep-purple) !important;
        }
        
        .text-pink {
            color: var(--pink) !important;
        }
        
        .text-white {
            color: #fff !important;
        }
        
        .rounded-sm {
            border-radius: var(--border-radius-sm) !important;
        }
        
        .rounded {
            border-radius: var(--border-radius) !important;
        }
        
        .rounded-lg {
            border-radius: var(--border-radius-lg) !important;
        }
        
        .rounded-pill {
            border-radius: var(--border-radius-pill) !important;
        }
        
        .shadow-effect {
            box-shadow: var(--shadow) !important;
        }
        
        .shadow-effect-lg {
            box-shadow: var(--shadow-lg) !important;
        }
        
        .shadow-purple {
            box-shadow: var(--purple-shadow) !important;
        }
        
        .shadow-blue {
            box-shadow: var(--blue-shadow) !important;
        }
        
        .has-shape {
            position: relative;
            z-index: 1;
        }

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
        
        .floating {
            animation: float 6s ease-in-out infinite;
        }
        
        .pulsing {
            animation: pulse 2s ease-in-out infinite;
        }
        
        .spinning {
            animation: spin 15s linear infinite;
        }

        /****************************
         * SHAPES
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
            background: var(--light-purple-bg);
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            opacity: 0.3;
            animation: float 15s ease-in-out infinite;
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
        
        .shape-meteor-2 {
            width: 150px;
            top: 40%;
            left: 70%;
            animation-delay: 3.5s;
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
        }
        
        .btn:after {
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
        
        .btn:hover:after {
            transform: translateY(0);
        }
        
        .btn i, .btn svg {
            margin-<?php echo $isRtl ? 'left' : 'right'; ?>: 10px;
            font-size: 1.125rem;
            transition: transform var(--transition-fast);
        }
        
        .btn:hover i, .btn:hover svg {
            transform: translateX(<?php echo $isRtl ? '-5px' : '5px'; ?>);
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
        
        .btn-outline {
            background-color: transparent;
            border: 2px solid var(--deep-purple);
            color: var(--deep-purple);
        }
        
        .btn-outline:hover {
            background-color: var(--deep-purple);
            color: #fff;
            transform: translateY(-5px);
        }
        
        .btn-light {
            background-color: #fff;
            color: var(--deep-purple);
            box-shadow: var(--shadow);
        }
        
        .btn-light:hover {
            background-color: #f8f9ff;
            box-shadow: var(--shadow-lg);
            transform: translateY(-5px);
        }
        
        .btn-lg {
            padding: 15px 35px;
            font-size: 1.125rem;
        }
        
        .btn-sm {
            padding: 8px 20px;
            font-size: 0.875rem;
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
            color: var(--deep-purple);
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
        
        @media (max-width: 991px) {
            .section-heading {
                font-size: 2.25rem;
            }
            
            .section-description {
                font-size: 1.0625rem;
            }
        }
        
        @media (max-width: 767px) {
            .section-heading {
                font-size: 2rem;
            }
            
            .section-subtitle {
                font-size: 0.75rem;
            }
            
            .section-description {
                font-size: 1rem;
            }
        }

        /****************************
         * PAGE LOADER
         ****************************/
        .page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--cosmic-gradient);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .loader-content {
            text-align: center;
        }
        
        .loader-spinner {
            position: relative;
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
        }
        
        .loader-spinner:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 3px solid rgba(255, 255, 255, 0.1);
            border-top-color: #fff;
            animation: loader-spin 1s infinite linear;
        }
        
        .loader-text {
            color: #fff;
            font-size: 1.2rem;
            font-weight: 500;
        }
        
        @keyframes loader-spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        /****************************
         * HERO SECTION
         ****************************/
        .hero-section {
            position: relative;
            padding: 160px 0 100px;
            background: linear-gradient(135deg, #f0f4ff 0%, #e8f5ff 100%);
            overflow: hidden;
            min-height: 85vh;
            display: flex;
            align-items: center;
        }
        
        .hero-section:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(1px 1px at 20% 30%, rgba(150, 150, 255, 0.9) 0%, rgba(150, 150, 255, 0) 100%),
                radial-gradient(1px 1px at 40% 70%, rgba(150, 150, 255, 0.8) 0%, rgba(150, 150, 255, 0) 100%),
                radial-gradient(2px 2px at 90% 15%, rgba(150, 150, 255, 0.9) 0%, rgba(150, 150, 255, 0) 100%),
                radial-gradient(1.5px 1.5px at 60% 90%, rgba(150, 150, 255, 0.8) 0%, rgba(150, 150, 255, 0) 100%);
            opacity: 0.6;
            z-index: 0;
        }
        
        .hero-shape-1 {
            position: absolute;
            top: -100px;
            right: -100px;
            width: 400px;
            height: 400px;
            background: var(--sky-gradient);
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            opacity: 0.2;
            animation: float 15s ease-in-out infinite;
            z-index: 0;
        }
        
        .hero-shape-2 {
            position: absolute;
            bottom: -150px;
            left: -100px;
            width: 500px;
            height: 500px;
            background: var(--purple-gradient);
            border-radius: 40% 60% 70% 30% / 40% 60% 30% 70%;
            opacity: 0.15;
            animation: float 20s ease-in-out infinite reverse;
            z-index: 0;
        }
        
        /* Add meteors to the hero section */
        .hero-meteor {
            position: absolute;
            width: 150px;
            height: 2px;
            background: linear-gradient(90deg, var(--deep-purple), transparent);
            opacity: 0.8;
            z-index: 1;
            animation: meteor 5s ease-in-out infinite;
        }
        
        .hero-meteor:before {
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
        
        .hero-meteor-1 {
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .hero-meteor-2 {
            top: 50%;
            right: 10%;
            animation-delay: 2.5s;
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
        }
        
        .hero-badge {
            position: relative;
            display: inline-flex;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 10px 25px;
            border-radius: var(--border-radius-pill);
            margin-bottom: 30px;
            border: 1px solid rgba(108, 99, 255, 0.2);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }
        
        .hero-badge:before {
            content: '';
            position: absolute;
            top: -10px;
            left: -10px;
            width: 40px;
            height: 40px;
            background: var(--primary-gradient);
            opacity: 0.1;
            border-radius: 50%;
            animation: pulse 3s infinite;
        }
        
        .hero-badge i {
            color: var(--yellow);
            margin-<?php echo $isRtl ? 'left' : 'right'; ?>: 12px;
            font-size: 1.25rem;
            animation: pulse 2s infinite;
        }
        
        .hero-title {
            font-size: 3.75rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 25px;
            color: #333;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }
        
        .hero-description {
            font-size: 1.35rem;
            line-height: 1.7;
            max-width: 600px;
            margin-bottom: 35px;
            color: #555;
        }
        
        .hero-buttons {
            display: flex;
            gap: 15px;
        }
        
        .hero-image-wrapper {
            position: relative;
            z-index: 1;
        }
        
        .hero-image {
            position: relative;
            animation: float 6s ease-in-out infinite;
        }
        
        .hero-image-main {
            border-radius: var(--border-radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            position: relative;
            border: 5px solid #fff;
        }
        
        .hero-image-main img {
            width: 100%;
            transition: transform 0.8s ease;
        }
        
        .hero-image:hover .hero-image-main img {
            transform: scale(1.05);
        }
        
        .hero-feature {
            position: absolute;
            z-index: 2;
            background-color: #fff;
            border-radius: var(--border-radius);
            padding: 15px 20px;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            border: 1px solid rgba(108, 99, 255, 0.1);
            transition: all var(--transition-fast);
        }
        
        .hero-feature:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }
        
        .hero-feature-1 {
            top: 15%;
            right: -10%;
        }
        
        .hero-feature-2 {
            bottom: 15%;
            left: -10%;
        }
        
        .hero-feature i {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--purple-gradient);
            color: #fff;
            border-radius: var(--border-radius-circle);
            font-size: 1.125rem;
            margin-<?php echo $isRtl ? 'left' : 'right'; ?>: 15px;
        }
        
        .hero-feature-content h4 {
            font-size: 1rem;
            margin-bottom: 3px;
            color: #333;
        }
        
        .hero-feature-content p {
            font-size: 0.875rem;
            margin-bottom: 0;
            color: #666;
        }
        
        @media (max-width: 1199px) {
            .hero-title {
                font-size: 3rem;
            }
            
            .hero-feature-1 {
                right: -5%;
            }
            
            .hero-feature-2 {
                left: -5%;
            }
        }
        
        @media (max-width: 991px) {
            .hero-section {
                padding: 120px 0 80px;
            }
            
            .hero-title {
                font-size: 2.75rem;
            }
            
            .hero-description {
                font-size: 1.125rem;
            }
            
            .hero-image-wrapper {
                margin-top: 50px;
            }
            
            .hero-feature-1 {
                top: 10%;
                right: 0;
            }
            
            .hero-feature-2 {
                bottom: 10%;
                left: 0;
            }
        }
        
        @media (max-width: 767px) {
            .hero-section {
                padding: 100px 0 70px;
                min-height: auto;
            }
            
            .hero-title {
                font-size: 2.25rem;
            }
            
            .hero-description {
                font-size: 1.0625rem;
            }
            
            .hero-buttons {
                flex-direction: column;
            }
            
            .hero-feature {
                padding: 12px 15px;
            }
            
            .hero-feature i {
                width: 35px;
                height: 35px;
                font-size: 0.9375rem;
            }
        }

        /****************************
         * EDUCATIONAL PATHS SECTION
         ****************************/
        .edu-path-section {
            position: relative;
            overflow: hidden;
            background-color: #fff;
        }
        
        .edu-path-section:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(ellipse at center, rgba(108, 99, 255, 0.05) 0%, rgba(108, 99, 255, 0) 70%);
            z-index: 0;
        }
        
        .edu-path-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            position: relative;
            z-index: 1;
        }
        
        .edu-path-card {
            position: relative;
            background-color: #fff;
            border-radius: var(--border-radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all var(--transition-medium);
            height: 100%;
            display: flex;
            flex-direction: column;
            padding: 35px 25px;
            text-align: center;
            border: 1px solid rgba(108, 99, 255, 0.1);
            z-index: 1;
        }
        
        .edu-path-card:after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: var(--purple-gradient);
            z-index: 1;
            transition: height var(--transition-fast);
            border-radius: 5px 5px 0 0;
        }
        
        .edu-path-card:hover {
            transform: translateY(-15px);
            box-shadow: var(--shadow-lg), var(--glow-shadow);
        }
        
        .edu-path-card:hover:after {
            height: 10px;
        }
        
        .edu-path-icon {
            position: relative;
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(108, 99, 255, 0.1) 0%, rgba(108, 158, 255, 0.1) 100%);
            border-radius: var(--border-radius-circle);
            transition: all var(--transition-medium);
            color: var(--deep-purple);
            font-size: 2.5rem;
            z-index: 1;
        }
        
        .edu-path-icon:before {
            content: '';
            position: absolute;
            top: -10px;
            left: -10px;
            width: 100px;
            height: 100px;
            background: rgba(108, 99, 255, 0.05);
            border-radius: 50%;
            z-index: -1;
            animation: pulse 3s infinite;
        }
        
        .edu-path-card:hover .edu-path-icon {
            background: var(--purple-gradient);
            color: #fff;
            box-shadow: var(--glow-shadow);
            transform: scale(1.1) rotateY(360deg);
        }
        
        .edu-path-title {
            font-size: 1.375rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: #333;
            transition: all var(--transition-fast);
        }
        
        .edu-path-card:hover .edu-path-title {
            color: var(--deep-purple);
        }
        
        .edu-path-text {
            color: #666;
            margin-bottom: 20px;
            flex-grow: 1;
        }
        
        .edu-path-link {
            display: inline-flex;
            align-items: center;
            color: var(--deep-purple);
            font-weight: 600;
            transition: all var(--transition-fast);
            margin-top: auto;
        }
        
        .edu-path-link:hover {
            color: var(--purple);
        }
        
        .edu-path-link i {
            margin-<?php echo $isRtl ? 'right' : 'left'; ?>: 8px;
            transition: transform var(--transition-fast);
        }
        
        .edu-path-link:hover i {
            transform: translateX(<?php echo $isRtl ? '-5px' : '5px'; ?>);
        }
        
        @media (max-width: 1199px) {
            .edu-path-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 767px) {
            .edu-path-grid {
                grid-template-columns: 1fr;
            }
        }

        /****************************
         * ABOUT SECTION
         ****************************/
        .about-section {
            position: relative;
            overflow: hidden;
            background-color: var(--light-sky);
        }
        
        .about-section:after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(ellipse at bottom right, rgba(108, 158, 255, 0.1) 0%, rgba(108, 158, 255, 0) 70%);
            z-index: 0;
        }
        
        .about-image-wrapper {
            position: relative;
            z-index: 1;
        }
        
        .about-image {
            position: relative;
            max-width: 90%;
            animation: float 8s ease-in-out infinite alternate;
        }
        
        .about-image-wrap {
            border-radius: var(--border-radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            position: relative;
            border: 5px solid #fff;
        }
        
        .about-image img {
            width: 100%;
            transition: transform var(--transition-medium);
        }
        
        .about-image:hover img {
            transform: scale(1.05);
        }
        
        .about-experience {
            position: absolute;
            bottom: -20px;
            right: -20px;
            background: var(--purple-gradient);
            color: #fff;
            padding: 20px;
            border-radius: var(--border-radius);
            box-shadow: var(--glow-shadow);
            z-index: 2;
            text-align: center;
            animation: pulse 4s infinite;
        }
        
        .about-experience-number {
            font-size: 3rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 5px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }
        
        .about-experience-text {
            font-size: 0.9375rem;
            font-weight: 500;
        }
        
        .about-content {
            position: relative;
            z-index: 1;
        }
        
        .about-text {
            font-size: 1.0625rem;
            line-height: 1.8;
            margin-bottom: 25px;
            color: #555;
        }
        
        .about-features {
            margin: 0 0 25px;
            padding: 0;
            list-style: none;
        }
        
        .about-feature {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
            font-size: 1rem;
            animation: fadeInRight 1s;
        }
        
        .about-feature i {
            color: #fff;
            margin-<?php echo $isRtl ? 'left' : 'right'; ?>: 15px;
            font-size: 0.875rem;
            background: var(--purple-gradient);
            width: 30px;
            height: 30px;
            min-width: 30px;
            border-radius: var(--border-radius-circle);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--purple-shadow);
            transition: all var(--transition-fast);
        }
        
        .about-feature:hover i {
            transform: scale(1.1);
            box-shadow: var(--glow-shadow);
        }
        
        @media (max-width: 991px) {
            .about-image {
                margin-bottom: 70px;
                max-width: 100%;
            }
            
            .about-experience {
                right: 20px;
            }
        }

        /****************************
         * STATS SECTION
         ****************************/
        .stats-section {
            position: relative;
            background: var(--purple-gradient);
            overflow: hidden;
            color: #fff;
            padding: 80px 0;
        }
        
        .stats-section:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(2px 2px at 40px 70px, rgba(255, 255, 255, 0.8) 0%, rgba(255, 255, 255, 0) 100%),
                radial-gradient(2px 2px at 90px 40px, rgba(255, 255, 255, 0.7) 0%, rgba(255, 255, 255, 0) 100%),
                radial-gradient(3px 3px at 160px 120px, rgba(255, 255, 255, 0.8) 0%, rgba(255, 255, 255, 0) 100%),
                radial-gradient(1.5px 1.5px at 230px 180px, rgba(255, 255, 255, 0.7) 0%, rgba(255, 255, 255, 0) 100%);
            background-repeat: repeat;
            background-size: 250px 250px;
            opacity: 0.2;
            z-index: 0;
        }
        
        .stats-container {
            position: relative;
            z-index: 1;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
        }
        
        .stat-card {
            position: relative;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: var(--border-radius);
            padding: 40px 20px;
            text-align: center;
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            transition: all var(--transition-medium);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .stat-card:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 100%);
            z-index: -1;
            opacity: 0;
            transition: opacity var(--transition-medium);
        }
        
        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.15);
        }
        
        .stat-card:hover:before {
            opacity: 1;
        }
        
        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #fff;
            opacity: 0.9;
        }
        
        .stat-card:hover .stat-icon {
            transform: scale(1.1);
            opacity: 1;
            animation: pulse 2s infinite;
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 10px;
            line-height: 1;
            color: #fff;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .stat-label {
            font-size: 1.125rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9);
        }
        
        @media (max-width: 1199px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .stat-card {
                padding: 30px 20px;
            }
            
            .stat-number {
                font-size: 2.5rem;
            }
        }
        
        @media (max-width: 767px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
        
        /****************************
         * TESTIMONIALS SECTION
         ****************************/
        .testimonials-section {
            position: relative;
            padding: 120px 0;
            background: linear-gradient(135deg, #f5f3ff 0%, #e8f5ff 100%);
            overflow: hidden;
        }
        
        .stars-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(1px 1px at 20% 30%, rgba(108, 99, 255, 0.7) 0%, rgba(0, 0, 0, 0) 100%),
                radial-gradient(1px 1px at 40% 70%, rgba(108, 99, 255, 0.5) 0%, rgba(0, 0, 0, 0) 100%),
                radial-gradient(1.5px 1.5px at 60% 20%, rgba(108, 99, 255, 0.7) 0%, rgba(0, 0, 0, 0) 100%),
                radial-gradient(1.5px 1.5px at 70% 90%, rgba(108, 99, 255, 0.5) 0%, rgba(0, 0, 0, 0) 100%),
                radial-gradient(2px 2px at 90% 15%, rgba(108, 99, 255, 0.7) 0%, rgba(0, 0, 0, 0) 100%);
            opacity: 0.3;
            z-index: 0;
        }
        
        .floating-shape {
            position: absolute;
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            z-index: 1;
        }
        
        .shape1 {
            top: 10%;
            left: 5%;
            width: 300px;
            height: 300px;
            background: linear-gradient(135deg, rgba(108, 99, 255, 0.1) 0%, rgba(108, 158, 255, 0.05) 100%);
            animation: float 15s ease-in-out infinite alternate;
        }
        
        .shape2 {
            bottom: 10%;
            right: 5%;
            width: 250px;
            height: 250px;
            background: linear-gradient(135deg, rgba(108, 158, 255, 0.08) 0%, rgba(108, 99, 255, 0.04) 100%);
            animation: float 12s ease-in-out infinite alternate-reverse;
        }
        
        .shape3 {
            top: 40%;
            right: 15%;
            width: 180px;
            height: 180px;
            background: linear-gradient(135deg, rgba(255, 107, 139, 0.08) 0%, rgba(108, 99, 255, 0.04) 100%);
            animation: float 10s ease-in-out infinite;
        }
        
        .testimonial-carousel-container {
            position: relative;
            margin-top: 60px;
        }
        
        .testimonial-card {
            padding: 15px;
        }
        
        .testimonial-card-inner {
            position: relative;
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px 30px;
            box-shadow: 0 15px 40px rgba(108, 99, 255, 0.08);
            transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
            border: 1px solid rgba(108, 99, 255, 0.1);
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .testimonial-card-inner:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(108, 99, 255, 0.15);
            border-color: rgba(108, 99, 255, 0.3);
        }
        
        .testimonial-card-inner:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #6C63FF, #87CEFA);
            transition: height 0.3s ease;
        }
        
        .testimonial-card-inner:hover:before {
            height: 8px;
        }
        
        .quote-icon {
            display: block;
            font-size: 3rem;
            color: rgba(108, 99, 255, 0.1);
            margin-bottom: 15px;
        }
        
        .testimonial-content {
            flex-grow: 1;
            margin-bottom: 25px;
        }
        
        .testimonial-content p {
            font-size: 1rem;
            line-height: 1.8;
            color: #555;
            position: relative;
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
            position: relative;
            padding-top: 20px;
        }
        
        .testimonial-author:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background: linear-gradient(90deg, #6C63FF, #87CEFA);
            border-radius: 3px;
        }
        
        .testimonial-author-image {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border: 3px solid #fff;
            margin-right: 15px;
        }
        
        [dir="rtl"] .testimonial-author-image {
            margin-right: 0;
            margin-left: 15px;
        }
        
        .testimonial-author-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .testimonial-card-inner:hover .testimonial-author-image img {
            transform: scale(1.1);
        }
        
        .testimonial-author-info h4 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 3px;
            color: #333;
        }
        
        .testimonial-author-info p {
            font-size: 0.9rem;
            color: #6C63FF;
            margin-bottom: 5px;
        }
        
        .testimonial-rating {
            display: flex;
        }
        
        .testimonial-rating i {
            color: #FFDE59;
            font-size: 0.9rem;
            margin-right: 2px;
        }
        
        [dir="rtl"] .testimonial-rating i {
            margin-right: 0;
            margin-left: 2px;
        }
        
        .testimonial-nav {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 40px;
        }
        
        .testimonial-prev,
        .testimonial-next {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6C63FF, #6C9EFF);
            color: white;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(108, 99, 255, 0.3);
        }
        
        .testimonial-prev:hover,
        .testimonial-next:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(108, 99, 255, 0.4);
        }
        
        .testimonial-prev:active,
        .testimonial-next:active {
            transform: translateY(0);
        }
        
        .testimonial-bg-circle {
            position: absolute;
            border-radius: 50%;
            z-index: 0;
            opacity: 0.05;
        }
        
        .testimonial-bg-circle-1 {
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(108, 99, 255, 0.8) 0%, rgba(108, 99, 255, 0) 70%);
            top: -250px;
            right: -100px;
        }
        
        .testimonial-bg-circle-2 {
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(108, 158, 255, 0.8) 0%, rgba(108, 158, 255, 0) 70%);
            bottom: -300px;
            left: -200px;
        }
        
        @media (max-width: 991px) {
            .testimonials-section {
                padding: 80px 0;
            }
            
            .testimonial-card-inner {
                padding: 30px 25px;
            }
        }
        
        @media (max-width: 767px) {
            .testimonials-section {
                padding: 60px 0;
            }
            
            .testimonial-card {
                padding: 10px;
            }
            
            .testimonial-card-inner {
                padding: 25px 20px;
            }
            
            .testimonial-content p {
                font-size: 0.95rem;
            }
            
            .testimonial-author-image {
                width: 50px;
                height: 50px;
            }
            
            .testimonial-author-info h4 {
                font-size: 1rem;
            }
        }

        /****************************
         * BLOG SECTION
         ****************************/
        .blog-section {
            position: relative;
            padding: 120px 0;
            background-color: #fff;
            overflow: hidden;
        }
        
        .blog-section-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(108, 99, 255, 0.03) 0%, rgba(108, 158, 255, 0.03) 100%);
            z-index: 0;
        }
        
        .blog-shape {
            position: absolute;
            border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
            z-index: 0;
        }
        
        .blog-shape-1 {
            top: -100px;
            right: -100px;
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, rgba(108, 99, 255, 0.05) 0%, rgba(108, 158, 255, 0.05) 100%);
            animation: blogFloat 20s ease-in-out infinite alternate;
        }
        
        .blog-shape-2 {
            bottom: -150px;
            left: -100px;
            width: 500px;
            height: 500px;
            background: linear-gradient(135deg, rgba(108, 158, 255, 0.05) 0%, rgba(108, 99, 255, 0.05) 100%);
            animation: blogFloat 25s ease-in-out infinite alternate-reverse;
        }
        
        .blog-shape-3 {
            top: 30%;
            left: 10%;
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, rgba(255, 107, 139, 0.05) 0%, rgba(108, 99, 255, 0.05) 100%);
            animation: blogFloat 15s ease-in-out infinite;
        }
        
        @keyframes blogFloat {
            0% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-30px) rotate(5deg);
            }
            100% {
                transform: translateY(0) rotate(0deg);
            }
        }
        
        /* Featured Blog Card */
        .blog-featured-card {
            position: relative;
            background-color: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(108, 99, 255, 0.1);
            transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
            border: 1px solid rgba(108, 99, 255, 0.1);
            height: 100%;
        }
        
        .blog-featured-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(108, 99, 255, 0.15);
            border-color: rgba(108, 99, 255, 0.2);
        }
        
        .blog-featured-image {
            position: relative;
            height: 100%;
            min-height: 300px;
            overflow: hidden;
        }
        
        .blog-featured-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
        }
        
        .blog-featured-card:hover .blog-featured-image img {
            transform: scale(1.05);
        }
        
        .blog-featured-content {
            padding: 40px;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        
        .blog-category {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 1;
        }
        
        [dir="rtl"] .blog-category {
            left: auto;
            right: 20px;
        }
        
        .blog-category span {
            display: inline-block;
            background: linear-gradient(135deg, #6C63FF 0%, #6C9EFF 100%);
            color: #fff;
            padding: 8px 18px;
            font-size: 0.9rem;
            font-weight: 600;
            border-radius: 50px;
            box-shadow: 0 5px 15px rgba(108, 99, 255, 0.3);
            transition: all 0.3s ease;
        }
        
        .blog-featured-card:hover .blog-category span,
        .blog-card:hover .blog-category span {
            box-shadow: 0 8px 20px rgba(108, 99, 255, 0.4);
            transform: translateY(-3px);
        }
        
        .blog-date {
            display: inline-flex;
            align-items: center;
            font-size: 0.95rem;
            color: #6C63FF;
            margin-bottom: 15px;
        }
        
        .blog-date i {
            margin-right: 8px;
        }
        
        [dir="rtl"] .blog-date i {
            margin-right: 0;
            margin-left: 8px;
        }
        
        .blog-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            line-height: 1.4;
        }
        
        .blog-title a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .blog-title a:hover {
            color: #6C63FF;
        }
        
        .blog-excerpt {
            font-size: 1rem;
            line-height: 1.7;
            color: #666;
            margin-bottom: 20px;
            flex-grow: 1;
        }
        
        .blog-read-more {
            display: inline-flex;
            align-items: center;
            color: #6C63FF;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-top: auto;
        }
        
        .blog-read-more i {
            margin-left: 8px;
            transition: transform 0.3s ease;
        }
        
        [dir="rtl"] .blog-read-more i {
            margin-left: 0;
            margin-right: 8px;
        }
        
        .blog-read-more:hover {
            color: #6C9EFF;
        }
        
        .blog-read-more:hover i {
            transform: translateX(5px);
        }
        
        [dir="rtl"] .blog-read-more:hover i {
            transform: translateX(-5px);
        }
        
        /* Regular Blog Cards */
        .blog-card {
            position: relative;
            background-color: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(108, 99, 255, 0.1);
            transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
            border: 1px solid rgba(108, 99, 255, 0.1);
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .blog-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(108, 99, 255, 0.15);
            border-color: rgba(108, 99, 255, 0.2);
        }
        
        .blog-image {
            position: relative;
            height: 220px;
            overflow: hidden;
        }
        
        .blog-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
        }
        
        .blog-card:hover .blog-image img {
            transform: scale(1.05);
        }
        
        .blog-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.3));
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .blog-card:hover .blog-overlay {
            opacity: 1;
        }
        
        .blog-content {
            padding: 30px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        .blog-card .blog-title {
            font-size: 1.25rem;
        }
        
        .blog-card .blog-excerpt {
            font-size: 0.95rem;
        }
        
        @media (max-width: 991px) {
            .blog-section {
                padding: 80px 0;
            }
            
            .blog-featured-content {
                padding: 30px;
            }
            
            .blog-featured-image {
                min-height: 250px;
            }
        }
        
        @media (max-width: 767px) {
            .blog-section {
                padding: 60px 0;
            }
            
            .blog-featured-content,
            .blog-content {
                padding: 25px 20px;
            }
            
            .blog-title {
                font-size: 1.35rem;
            }
            
            .blog-card .blog-title {
                font-size: 1.2rem;
            }
            
            .blog-excerpt {
                font-size: 0.95rem;
            }
            
            .blog-card .blog-excerpt {
                font-size: 0.9rem;
            }
        }

        /****************************
         * VIDEO TOUR SECTION
         ****************************/
        .video-tour-section {
            position: relative;
            overflow: hidden;
            padding: 0;
        }
        
        .video-tour-wrapper {
            position: relative;
            height: 600px;
            background-color: #1A1F2A;
            overflow: hidden;
        }
        
        .video-tour-wrapper:after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(26, 31, 42, 0.5), rgba(26, 31, 42, 0.8));
            z-index: 1;
        }
        
        .video-thumbnail {
            position: absolute;
            width: 100%;
            height: 100%;
        }
        
        .video-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 8s ease;
        }
        
        .video-tour-wrapper:hover .video-thumbnail img {
            transform: scale(1.05);
        }
        
        /* Particle Overlay */
        .particles-js {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 2;
            pointer-events: none;
        }
        
        /* Dark Gradient Overlay */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(13, 16, 45, 0.7), rgba(13, 16, 45, 0.9));
            z-index: 2;
        }
        
        .video-tour-content {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fff;
            padding: 4rem;
            z-index: 3;
        }
        
        .video-tour-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            color: rgba(255, 255, 255, 0.9);
            text-shadow: 0 3px 10px rgba(0, 0, 0, 0.3);
            animation: fadeInDown 1s ease-out;
        }
        
        .video-tour-description {
            font-size: 1.25rem;
            max-width: 800px;
            margin: 0 auto 2.5rem;
            color: rgba(255, 255, 255, 0.8);
            animation: fadeInUp 1s ease-out;
        }
        
        .video-play-container {
            position: relative;
            margin-bottom: 2rem;
            animation: zoomIn 1s ease-out;
        }
        
        .video-play-btn {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6C63FF, #6C9EFF);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            position: relative;
            z-index: 1;
            box-shadow: 0 5px 20px rgba(108, 99, 255, 0.5);
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .video-play-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 10px 30px rgba(108, 99, 255, 0.7);
        }
        
        /* Pulsing Circles */
        .pulse-circles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        
        .pulse-circle {
            border: 2px solid rgba(var(--bs-primary-rgb), 0.8);
            animation: pulse 2.5s infinite;
            opacity: 0;
        }
        
        .video-info-badge {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            animation: fadeInUp 1s ease-out 0.5s;
            animation-fill-mode: both;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
        
        .video-info-badge:hover {
            background-color: rgba(255, 255, 255, 0.15);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }
        
        .video-info-badge i {
            margin-right: 0.5rem;
            color: #6C63FF;
        }
        
        @media (max-width: 991px) {
            .video-tour-wrapper {
                height: 500px;
            }
            
            .video-tour-title {
                font-size: 2.75rem;
            }
            
            .video-tour-description {
                font-size: 1.125rem;
            }
            
            .video-play-btn {
                width: 80px;
                height: 80px;
                font-size: 1.75rem;
            }
        }
        
        @media (max-width: 767px) {
            .video-tour-wrapper {
                height: 450px;
            }
            
            .video-tour-title {
                font-size: 2.25rem;
            }
            
            .video-tour-description {
                font-size: 1rem;
            }
            
            .video-play-btn {
                width: 70px;
                height: 70px;
                font-size: 1.5rem;
            }
            
            .video-tour-content {
                padding: 2rem;
            }
        }

        /****************************
         * FAQ SECTION
         ****************************/
        .faq-section {
            position: relative;
            overflow: hidden;
            background-color: #fff;
        }
        
        .faq-section:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(ellipse at center, rgba(108, 99, 255, 0.05) 0%, rgba(108, 99, 255, 0) 70%);
            z-index: 0;
        }
        
        .faq-container {
            max-width: 900px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }
        
        .faq-item {
            border-radius: 15px;
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: all var(--transition-medium);
            margin-bottom: 20px;
            border: 1px solid rgba(108, 99, 255, 0.08);
            position: relative;
            background-color: #fff;
        }
        
        .faq-item:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 0;
            background: var(--purple-gradient);
            transition: height var(--transition-medium);
            border-radius: 5px 0 0 5px;
        }
        
        .faq-item:hover:before, .faq-item.active:before {
            height: 100%;
        }
        
        .faq-item:hover, .faq-item.active {
            transform: translateX(10px);
            box-shadow: var(--shadow-lg);
        }
        
        [dir="rtl"] .faq-item:hover, [dir="rtl"] .faq-item.active {
            transform: translateX(-10px);
        }
        
        .faq-question {
            padding: 20px 25px;
            font-weight: 600;
            color: #333;
            cursor: pointer;
            transition: all var(--transition-fast);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .faq-question i {
            width: 30px;
            height: 30px;
            background: rgba(108, 99, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all var(--transition-medium);
            color: var(--primary-color);
        }
        
        .faq-item.active .faq-question i {
            background: var(--purple-gradient);
            color: #fff;
            transform: rotate(180deg);
            box-shadow: var(--glow-shadow);
        }
        
        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height var(--transition-medium);
        }
        
        .faq-answer-content {
            padding: 0 25px 25px;
            color: #666;
        }
        
        .faq-item.active .faq-answer {
            max-height: 1000px;
        }
        
        .faq-more {
            text-align: center;
            margin-top: 40px;
        }
        
        /****************************
         * CTA SECTION
         ****************************/
        .cta-section {
            position: relative;
            overflow: hidden;
            background: var(--cosmic-gradient);
            border-radius: 0;
            z-index: 1;
        }
        
        .cta-section:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(2px 2px at 20% 30%, rgba(255, 255, 255, 0.8) 0%, rgba(255, 255, 255, 0) 100%),
                radial-gradient(2px 2px at 40% 70%, rgba(255, 255, 255, 0.7) 0%, rgba(255, 255, 255, 0) 100%),
                radial-gradient(3px 3px at 60% 15%, rgba(255, 255, 255, 0.8) 0%, rgba(255, 255, 255, 0) 100%),
                radial-gradient(2px 2px at 80% 60%, rgba(255, 255, 255, 0.7) 0%, rgba(255, 255, 255, 0) 100%);
            opacity: 0.2;
            z-index: -1;
        }
        
        /* Animated Shapes */
        .animated-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
        }
        
        /* Floating Circles */
        .shape-circle {
            position: absolute;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        
        /* Floating Blobs */
        .shape-blob {
            position: absolute;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
        }
        
        /* Star Pattern Overlay */
        .star-pattern {
            opacity: 0.15;
            transform: rotate(45deg);
        }
        
        .cta-meteor {
            position: absolute;
            width: 200px;
            height: 2px;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.8), transparent);
            opacity: 0.6;
            z-index: 0;
            animation: meteor 8s ease-in-out infinite;
        }
        
        .cta-meteor:before {
            content: '';
            position: absolute;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: #fff;
            box-shadow: 0 0 10px #fff;
            left: 0;
            top: -1px;
        }
        
        .cta-meteor-1 {
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .cta-meteor-2 {
            top: 60%;
            right: 10%;
            animation-delay: 3s;
        }
        
        .cta-content {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            z-index: 1;
        }
        
        .cta-badge {
            margin-bottom: 1.5rem;
        }
        
        .cta-badge .badge {
            font-size: 0.95rem;
            font-weight: 600;
            color: #6C63FF;
            background-color: #fff;
            border-radius: 50px;
            padding: 0.6rem 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transform: translateY(0);
            transition: all 0.3s ease;
        }
        
        .cta-badge .badge:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }
        
        .cta-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 25px;
            color: #fff;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .cta-text {
            font-size: 1.35rem;
            line-height: 1.7;
            margin-bottom: 40px;
            color: rgba(255, 255, 255, 0.9);
        }
        
        .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        
        .hover-scale {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .hover-scale:hover {
            transform: scale(1.05);
        }
        
        @media (max-width: 991px) {
            .cta-title {
                font-size: 2.75rem;
            }
            
            .cta-text {
                font-size: 1.25rem;
            }
        }
        
        @media (max-width: 767px) {
            .cta-title {
                font-size: 2.25rem;
            }
            
            .cta-text {
                font-size: 1.125rem;
            }
            
            .cta-buttons {
                flex-direction: column;
                align-items: center;
                gap: 15px;
            }
            
            .cta-buttons .btn {
                width: 100%;
                max-width: 280px;
            }
        }

        /****************************
         * BACK TO TOP BUTTON
         ****************************/
        #backToTop {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: var(--purple-gradient);
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px);
            transition: all var(--transition-fast);
            z-index: 99;
            box-shadow: 0 5px 15px rgba(108, 99, 255, 0.3);
        }
        
        #backToTop.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        #backToTop:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(108, 99, 255, 0.4);
        }
        
        [dir="rtl"] #backToTop {
            right: auto;
            left: 30px;
        }

        /****************************
         * VIDEO MODAL
         ****************************/
        .modal-content {
            background-color: #1A1F2A;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
        }
        
        .modal-header {
            background: var(--purple-gradient);
            color: #fff;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 15px 20px;
        }
        
        .modal-title {
            font-weight: 600;
            font-size: 1.25rem;
        }
        
        .modal-header .close {
            color: #fff;
            opacity: 0.8;
            text-shadow: none;
            transition: all var(--transition-fast);
        }
        
        .modal-header .close:hover {
            opacity: 1;
            transform: rotate(90deg);
        }
        
        .modal-body {
            padding: 0;
        }
        
        .embed-responsive {
            background-color: #000;
        }
        
        /****************************
         * PARTICLE STYLES
         ****************************/
        .particles-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            pointer-events: none;
        }
        /**
 * Space-Themed Creative Styling for Salman Farsi Educational Complex
 * RTL Optimization by Claude - April 2025
 */

/* RTL Global Fixes */
[dir="rtl"] {
    /* Text alignment for RTL */
    text-align: right;
}

/* Fix for floating elements in RTL */
[dir="rtl"] .float-start {
    float: right !important;
}

[dir="rtl"] .float-end {
    float: left !important;
}

/* Fix for icons in RTL */
[dir="rtl"] .fa-arrow-right:before {
    content: "\f060"; /* fa-arrow-left unicode */
}

[dir="rtl"] .fa-arrow-left:before {
    content: "\f061"; /* fa-arrow-right unicode */
}

[dir="rtl"] .fa-chevron-right:before {
    content: "\f053"; /* fa-chevron-left unicode */
}

[dir="rtl"] .fa-chevron-left:before {
    content: "\f054"; /* fa-chevron-right unicode */
}

/* Button icon fixes */
[dir="rtl"] .btn i, 
[dir="rtl"] .btn svg {
    margin-right: 10px;
    margin-left: 0;
}

[dir="rtl"] .btn:hover i, 
[dir="rtl"] .btn:hover svg {
    transform: translateX(-5px);
}

/* Hero Section RTL Fixes */
[dir="rtl"] .hero-badge i {
    margin-right: 0;
    margin-left: 12px;
}

[dir="rtl"] .hero-feature-1 {
    right: auto;
    left: -10%;
}

[dir="rtl"] .hero-feature-2 {
    left: auto;
    right: -10%;
}

@media (max-width: 991px) {
    [dir="rtl"] .hero-feature-1 {
        right: auto;
        left: 0;
    }
    
    [dir="rtl"] .hero-feature-2 {
        left: auto;
        right: 0;
    }
}

/* Fix for hero features in RTL */
[dir="rtl"] .hero-feature i {
    margin-right: 0;
    margin-left: 15px;
}

/* Educational Paths Section RTL Fixes */
[dir="rtl"] .edu-path-link i {
    margin-left: 0;
    margin-right: 8px;
    transform: scaleX(-1);
}

[dir="rtl"] .edu-path-link:hover i {
    transform: translateX(-5px) scaleX(-1);
}

/* About Section RTL Fixes */
[dir="rtl"] .about-feature i {
    margin-right: 0;
    margin-left: 15px;
}

[dir="rtl"] .about-experience {
    right: auto;
    left: -20px;
}

@media (max-width: 991px) {
    [dir="rtl"] .about-experience {
        left: 20px;
    }
}

/* Blog Section RTL Fixes */
[dir="rtl"] .blog-date i {
    margin-right: 0;
    margin-left: 8px;
}

/* Enhanced Testimonials Section - Fixed for RTL */
[dir="rtl"] .testimonial-author {
    text-align: right;
}

[dir="rtl"] .testimonial-author:before {
    left: auto;
    right: 0;
}

/* Make cards equal height in both RTL and LTR */
.testimonial-card-inner {
    height: 100%;
    display: flex;
    flex-direction: column;
}

.testimonial-content {
    flex-grow: 1;
}

/* Fix for quote icon in RTL */
[dir="rtl"] .quote-icon {
    text-align: right;
}

/* Fix for rating stars in RTL */
[dir="rtl"] .testimonial-rating {
    direction: ltr; /* Keep stars direction LTR for visual consistency */
    justify-content: flex-end;
}

/* Carousel navigation RTL fix */
[dir="rtl"] .owl-carousel {
    direction: ltr; /* Keep carousel direction LTR for proper functioning */
}

[dir="rtl"] .owl-carousel .owl-item {
    direction: rtl; /* Keep content inside carousel RTL */
}

/* Fix for custom carousel navigation */
[dir="rtl"] .testimonial-prev i,
[dir="rtl"] .testimonial-next i {
    transform: scaleX(-1);
}

/* Video Tour Section Enhancements */
.video-tour-wrapper {
    position: relative;
    height: 650px; /* Increased height for better visual impact */
    overflow: hidden;
}

/* Create layered depth effect for video background */
.video-thumbnail img {
    transition: transform 10s ease-in-out;
    transform: scale(1.05);
}

.video-tour-wrapper:hover .video-thumbnail img {
    transform: scale(1.15);
}

/* Enhance video play button with pulse effect */
.video-play-btn {
    transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.video-play-btn:hover {
    transform: scale(1.15);
    box-shadow: 0 15px 35px rgba(108, 99, 255, 0.8);
}

.pulse-circle {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background-color: rgba(108, 99, 255, 0.3);
    opacity: 0;
    animation: video-pulse 2s infinite cubic-bezier(0.66, 0, 0, 1);
}

.pulse-circle:nth-child(2) {
    animation-delay: 0.5s;
}

@keyframes video-pulse {
    0% {
        transform: scale(0.9);
        opacity: 0.7;
    }
    70% {
        transform: scale(1.7);
        opacity: 0;
    }
    100% {
        transform: scale(0.9);
        opacity: 0;
    }
}

/* Improved video section content */
.video-tour-title {
    font-size: 4rem;
    margin-bottom: 2rem;
    text-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
    background: linear-gradient(to right, #fff, #d0d8ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.video-tour-description {
    font-size: 1.35rem;
    max-width: 800px;
    margin: 0 auto 3rem;
    line-height: 1.8;
}

/* Enhanced Education Path Cards */
.edu-path-card {
    position: relative;
    transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
    overflow: hidden;
    z-index: 1;
}

.edu-path-card:before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(108, 99, 255, 0.1) 0%, rgba(108, 158, 255, 0.05) 100%);
    z-index: -1;
    opacity: 0;
    transition: opacity 0.5s ease;
    border-radius: var(--border-radius-lg);
}

.edu-path-card:hover {
    transform: translateY(-18px);
    box-shadow: 0 25px 50px rgba(108, 99, 255, 0.2);
}

.edu-path-card:hover:before {
    opacity: 1;
}

.edu-path-card:hover:after {
    height: 8px;
}

.edu-path-icon {
    transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.edu-path-card:hover .edu-path-icon {
    transform: scale(1.15) rotateY(360deg);
}

/* Equal-height cards fix for RTL and LTR */
.edu-path-card,
.blog-card,
.testimonial-card-inner {
    height: 100%;
    display: flex;
    flex-direction: column;
}

.edu-path-text,
.blog-excerpt,
.testimonial-content {
    flex-grow: 1;
}

/* Enhanced Mobile Responsiveness */
@media (max-width: 991px) {
    .edu-path-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    
    .video-tour-title {
        font-size: 3rem;
    }
    
    [dir="rtl"] .blog-category {
        left: auto;
        right: 20px;
    }
    
    [dir="rtl"] .blog-read-more i {
        transform: scaleX(-1);
    }
}

@media (max-width: 767px) {
    .edu-path-grid {
        grid-template-columns: 1fr;
    }
    
    .video-tour-title {
        font-size: 2.5rem;
    }
    
    [dir="rtl"] .cta-buttons {
        flex-direction: column;
    }
}

/* Fix for university logos marquee in RTL */
[dir="rtl"] .university-marquee-content {
    direction: rtl;
}

[dir="rtl"] @keyframes scrollLogos {
    from {
        transform: translateX(0);
    }
    to {
        transform: translateX(100%); /* Reverse direction for RTL */
    }
}

/* Quick fix for back to top button positioning in RTL */
[dir="rtl"] #backToTop {
    right: auto;
    left: 30px;
}

/* Fix for FAQ accordion icons in RTL */
[dir="rtl"] .faq-question {
    text-align: right;
}

[dir="rtl"] .faq-item:before {
    left: auto;
    right: 0;
    border-radius: 0 5px 5px 0;
}

[dir="rtl"] .faq-item:hover, 
[dir="rtl"] .faq-item.active {
    transform: translateX(-10px);
}

/* Improved meteor animation for both LTR and RTL */
@keyframes meteor-rtl {
    0% {
        transform: translateX(-300%) translateY(-300%) rotate(135deg);
        opacity: 1;
    }
    70% {
        opacity: 1;
    }
    100% {
        transform: translateX(300%) translateY(300%) rotate(135deg);
        opacity: 0;
    }
}

[dir="rtl"] .hero-meteor,
[dir="rtl"] .cta-meteor {
    animation-name: meteor-rtl;
}

/* Fix footer menu alignment in RTL */
[dir="rtl"] .footer-menu {
    text-align: right;
}

[dir="rtl"] .footer-menu li {
    margin-right: 0;
    margin-left: 20px;
}

/* Extra Style Enhancements */

/* Improved focus for links & buttons (accessibility) */
a:focus, button:focus, .btn:focus {
    outline: 3px solid rgba(108, 99, 255, 0.3);
    outline-offset: 2px;
}

/* Better hover effects for cards */
.edu-path-card:hover,
.blog-card:hover,
.testimonial-card-inner:hover {
    box-shadow: 0 30px 60px rgba(108, 99, 255, 0.25);
}
    </style>