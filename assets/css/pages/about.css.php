<style>
        /**
         * About Page Styles - Enhanced Version
         * ============================================
         * Comprehensive styling for the About Us page with multilingual support
         */
        
        /* Base variables */
        :root {
            --primary-color: #6941C6;
            --secondary-color: #4E36B1;
            --accent-color: #7F56D9;
            --accent-light: #9E77ED;
            --text-color: #333;
            --text-light: #666;
            --bg-light: #f8f9fa;
            --white: #ffffff;
            --border-radius: 20px;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --card-shadow-hover: 0 15px 35px rgba(0, 0, 0, 0.15);
            --animation-duration: 0.3s;
            --gradient-dark: linear-gradient(135deg, #0F172A 0%, #1E293B 60%, #334155 100%);
            --gradient-primary: linear-gradient(135deg, #4E36B1 0%, #6941C6 50%, #7F56D9 100%);
        }
        
        /* Font declarations for Persian and Arabic language support */
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
        }

        /* Global text improvements */
        body {
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        /* بهبود استایل پاراگراف‌ها در بخش تاریخچه */
.about-content__text p {
    margin-bottom: 18px;
    line-height: 1.8;
    text-align: justify;
    font-size: 16px;
}

.about-content__text p:last-child {
    margin-bottom: 0;
}

/* افزودن فاصله بیشتر بین بخش‌ها */
.about-content {
    margin-bottom: 20px;
}

/* تنظیم فاصله برای محتوای متنی */
.about-content__text {
    margin-bottom: 30px;
}
/* تنظیم شکستن خط برای تایتل‌ها */
.about-heading__title {
    font-size: 32px;
    font-weight: 800;
    color: #333;
    text-align: center;
    margin: 0 auto 30px;
    line-height: 1.3;
    max-width: 800px; /* محدود کردن عرض */
    /* کنترل شکستن خط در نقاط مناسب */
    hyphens: auto;
    -webkit-hyphens: auto;
    -ms-hyphens: auto;
}

/* تنظیمات خاص برای انگلیسی */
html[lang="en"] .about-heading__title {
    font-size: 30px; /* کمی کوچکتر برای انگلیسی */
    line-height: 1.4;
}
        [dir="rtl"] body {
            font-family: <?php echo $fontFamily; ?>;
            letter-spacing: 0;
            <?php echo $arSpecificStyle; ?>
        }
        
        /* Language switcher in navbar */
        .language-switcher {
            display: inline-flex;
            align-items: center;
            margin-left: 15px;
        }
        
        .language-switcher .nav-link {
            color: var(--white);
            font-size: 14px;
            padding: 5px 10px;
            margin: 0 2px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }
        
        .language-switcher .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            font-weight: 600;
        }
        
        .language-switcher .nav-link:hover:not(.active) {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        /* ==================
           Header Section
           ================== */
        .about-header {
            background: var(--gradient-dark);
            position: relative;
            overflow: hidden;
            color: var(--white);
            text-align: center;
            padding: 180px 0 140px;
            margin-top: 0;
        }
        
        /* Cosmic background effects */
        .cosmic-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            opacity: 0.7;
            z-index: 1;
        }
        
        .cosmic-star {
            position: absolute;
            background-color: #fff;
            border-radius: 50%;
            animation: twinkle var(--animation-duration) infinite alternate;
        }
        
        @keyframes twinkle {
            from { opacity: 0.2; }
            to { opacity: 1; }
        }
        
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
        
        .cosmic-planet {
            position: absolute;
            border-radius: 50%;
            opacity: 0.3;
            filter: blur(20px);
        }
        
        .cosmic-planet:nth-child(1) {
            top: -50px;
            left: -100px;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, var(--accent-color), var(--secondary-color));
        }
        
        .cosmic-planet:nth-child(2) {
            bottom: -80px;
            right: -80px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, var(--accent-light), var(--primary-color));
        }
        
        /* Wave separator at the bottom of header */
        .about-header::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 150px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23f5f7fa' fill-opacity='1' d='M0,192L60,186.7C120,181,240,171,360,181.3C480,192,600,224,720,229.3C840,235,960,213,1080,181.3C1200,149,1320,107,1380,85.3L1440,64L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
            background-size: cover;
            background-position: center bottom;
            z-index: 2;
        }
        
        /* Header content elements */
        .about-header__content {
            position: relative;
            z-index: 3;
        }
        
        .about-header__title {
            font-family: <?php echo $fontFamily; ?>;
            font-size: 42px;
            font-weight: 800;
            margin-bottom: 20px;
            color: white;
            animation: slideDown 1s ease-out, floatEffect 4s ease-in-out infinite;
            <?php echo $arSpecificStyle; ?>
        }
        
        .about-header__subtitle {
            font-family: <?php echo $fontFamily; ?>;
            font-size: 20px;
            max-width: 800px;
            margin: 0 auto 40px;
            opacity: 0.9;
            color: white;
            animation: slideDown 1s ease-out 0.3s both, floatEffect 5s ease-in-out infinite;
            <?php echo $arSpecificStyle; ?>
        }
        
        /* ==================
           Animation Effects
           ================== */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
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
        
        @keyframes floatEffect {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
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
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        @keyframes countUp {
            from { content: "0"; }
            to { content: attr(data-count); }
        }

        /* Enhanced 3D rotation animation for cards */
        @keyframes card3DEffect {
            0% { transform: perspective(800px) rotateY(0); }
            50% { transform: perspective(800px) rotateY(15deg); }
            100% { transform: perspective(800px) rotateY(0); }
        }
        
        /* ==================
           Content Sections
           ================== */
        .about-section {
            padding: 100px 0;
            background-color: var(--white);
            position: relative;
            overflow: hidden;
        }
        
        .about-section.bg-light {
            background-color: var(--bg-light);
        }

        /* Enhanced section divider */
        .section-divider {
            position: relative;
            height: 100px;
            overflow: hidden;
            margin-top: -50px;
            z-index: 1;
        }

        .section-divider.wave-top {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23f8f9fa' fill-opacity='1' d='M0,64L48,80C96,96,192,128,288,144C384,160,480,160,576,144C672,128,768,96,864,90.7C960,85,1056,107,1152,117.3C1248,128,1344,128,1392,128L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
            background-size: cover;
            background-position: center top;
        }
        
        /* Video container styles */
        .about-video {
            position: relative;
            margin-bottom: 30px;
        }
        
        .video-container {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            position: relative;
            transform: translateY(0);
            transition: transform 0.5s ease, box-shadow 0.5s ease;
        }
        
        .video-container:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
        }
        
        .video-wrapper {
            position: relative;
            width: 100%;
            overflow: hidden;
            padding-top: 56.25%; /* 16:9 aspect ratio */
            border-radius: 15px 15px 0 0;
        }
        
        .school-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 15px 15px 0 0;
            cursor: pointer;
        }
        
        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            pointer-events: none;
            border-radius: 15px 15px 0 0;
        }
        
        .play-button {
            width: 90px;
            height: 90px;
            background-color: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.4);
            transition: all 0.3s ease;
            color: white;
            cursor: pointer;
            pointer-events: auto;
            animation: pulse 2s infinite;
        }
        
        .play-button i {
            font-size: 34px;
            margin-left: 5px; /* Adjusts for play icon */
        }
        
        .play-button:hover {
            transform: scale(1.1);
            background-color: var(--secondary-color);
            animation: none;
        }
        
        .video-caption {
            padding: 20px;
            background-color: var(--white);
            border-radius: 0 0 15px 15px;
            color: var(--text-color);
            font-weight: 500;
            font-size: 18px;
            text-align: center;
        }
        
        /* Hide overlay when video is playing */
        .video-playing .video-overlay {
            opacity: 0;
            visibility: hidden;
        }
        
        /* About content styles */
        /* Improved styling for tagline */
        .about-heading__tagline {
            font-size: 16px;
            font-weight: 600;
            color: var(--primary-color);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 10px;
            display: block;
            text-align: center;
            position: relative;
            padding-bottom: 15px;
        }

        .about-heading__tagline::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background-color: var(--primary-color);
        }

        /* Enhanced styling for title */
        .about-heading__title {
            font-size: 36px;
            font-weight: 800;
            color: #333;
            text-align: center;
            margin-top: 0;
            margin-bottom: 30px;
            line-height: 1.3;
            font-family: <?php echo $fontFamily; ?>;
            <?php echo $arSpecificStyle; ?>
        }

        /* RTL adjustments */
        [dir="rtl"] .about-heading__tagline,
        [dir="rtl"] .about-heading__title {
            text-align: center;
            letter-spacing: 0;
        }
        
        /* Content paragraph styling */
        .about-content__text p {
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 20px;
            color: var(--text-light);
        }
        
        /* Fix for RTL text alignment */
        [dir="rtl"] .about-content__text {
            text-align: right;
        }
        
        /* Highlight styles */
        .about-highlight {
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            animation: slideInRight 1s both;
            transition: all 0.3s ease;
        }
        
        .about-highlight:hover {
            transform: translateX(10px);
        }
        
        .about-highlight i {
            margin-right: 12px;
            color: var(--primary-color);
            font-size: 18px;
        }
        
        [dir="rtl"] .about-highlight i {
            margin-right: 0;
            margin-left: 12px;
        }

        [dir="rtl"] .about-highlight:hover {
            transform: translateX(-10px);
        }
        
        /* Campus stats */
        .campus-stat {
            transition: all 0.5s ease;
            animation: fadeIn 1.5s both;
            border-radius: 15px;
            padding: 30px 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .campus-stat::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(105, 65, 198, 0.1) 0%, rgba(105, 65, 198, 0.05) 100%);
            z-index: -1;
            transition: all 0.5s ease;
            opacity: 0;
        }
        
        .campus-stat:hover {
            transform: translateY(-15px);
            box-shadow: 0 20px 35px rgba(0,0,0,0.15);
        }
        
        .campus-stat:hover::before {
            opacity: 1;
        }
        
        .campus-stat h3 {
            font-size: 36px !important;
            font-weight: 800 !important;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }
        
        .campus-stat:hover h3 {
            transform: scale(1.1);
        }
        
        .campus-stat p {
            font-size: 16px;
            margin-bottom: 0;
            opacity: 0.8;
        }
        
        /* ==================
           Features Section
           ================== */
        .features-section {
            padding: 100px 0;
            background-color: var(--bg-light);
            position: relative;
            perspective: 1000px;
        }
        
        .features-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('assets/images/patterns/dot-pattern.png');
            opacity: 0.05;
            z-index: 0;
        }
        
        .feature-item {
            padding: 40px 30px;
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            margin-bottom: 30px;
            transition: all 0.5s ease;
            position: relative;
            z-index: 1;
            overflow: hidden;
            height: 100%;
            transform-style: preserve-3d;
            transform: perspective(1000px);
        }
        
        .feature-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, var(--primary-color), var(--accent-color));
            transition: height 0.5s ease;
            z-index: -1;
        }
        
        .feature-item:hover {
            transform: translateY(-15px) perspective(1000px) rotateY(5deg);
            box-shadow: var(--card-shadow-hover);
        }
        
        .feature-item:hover::before {
            height: 10px;
        }
        
        .feature-item__icon {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(105, 65, 198, 0.1);
            color: var(--primary-color);
            border-radius: 50%;
            font-size: 34px;
            margin-bottom: 25px;
            transition: all 0.5s ease;
            box-shadow: 0 10px 20px rgba(105, 65, 198, 0.2);
        }
        
        .feature-item:hover .feature-item__icon {
            background-color: var(--primary-color);
            color: var(--white);
            transform: rotateY(360deg);
            box-shadow: 0 15px 30px rgba(105, 65, 198, 0.4);
        }
        
        .feature-item__title {
            font-size: 22px;
            margin-bottom: 15px;
            color: var(--text-color);
            transition: all 0.3s ease;
            font-weight: 700;
        }
        
        .feature-item:hover .feature-item__title {
            color: var(--primary-color);
        }
        
        .feature-item__text {
            color: var(--text-light);
            margin-bottom: 0;
            line-height: 1.8;
            font-size: 16px;
        }
        
        /* ==================
           Stats Section
           ================== */
        .stats-section {
            padding: 100px 0;
            background: var(--gradient-primary);
            color: var(--white);
            position: relative;
            overflow: hidden;
        }
        
        .stats-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('assets/images/patterns/dot-pattern.png');
            opacity: 0.1;
            animation: fadeIn 2s ease;
        }
        
        .stats-item {
            text-align: center;
            padding: 30px 0;
            position: relative;
            z-index: 1;
        }
        
        .stats-item::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background-color: rgba(255, 255, 255, 0.3);
            transition: all 0.5s ease;
        }
        
        .stats-item:hover::after {
            width: 100px;
            background-color: rgba(255, 255, 255, 0.8);
        }
        
        .stats-item__icon {
            font-size: 48px;
            margin-bottom: 25px;
            display: inline-block;
            animation: rotateIn 1s both;
            text-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .stats-item__number {
            font-size: 44px;
            font-weight: 800;
            margin-bottom: 15px;
            line-height: 1;
            opacity: 0;
            animation: fadeIn 1s forwards;
            animation-delay: 0.5s;
            text-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }
        
        .stats-item__text {
            font-size: 18px;
            opacity: 0.95;
            animation: slideUp 1s both;
            animation-delay: 0.7s;
            font-weight: 500;
        }
        
        /* Counter animation */
        .counter-value {
            display: inline-block;
            position: relative;
        }
        
        /* ==================
           Graduates Section
           ================== */
        .graduate-stat {
            transition: all 0.5s ease;
            border: 2px solid transparent;
            border-radius: 15px;
            padding: 30px 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .graduate-stat:hover {
            border-color: var(--primary-color);
            background-color: white !important;
            transform: translateY(-15px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .graduate-stat h3 {
            font-size: 36px !important;
            font-weight: 800 !important;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }
        
        .graduate-stat:hover h3 {
            transform: scale(1.1);
            color: var(--primary-color);
        }

        .graduate-stat span {
            font-size: 36px !important;
            font-weight: 800 !important;
            color: var(--primary-color);
            transition: all 0.3s ease;
        }
        
        /* ==================
           Team Section
           ================== */
        .team-section {
            padding: 100px 0;
            background-color: var(--white);
            position: relative;
        }
        
        .team-section.bg-light {
            background-color: var(--bg-light);
        }
        
        .team-item {
            position: relative;
            overflow: hidden;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            margin-bottom: 30px;
            transition: all 0.5s ease;
            background-color: white;
            text-align: center; /* Center content */
            height: 100%;
        }
        
        .team-item:hover {
            transform: translateY(-15px);
            box-shadow: var(--card-shadow-hover);
        }
        
        .team-item__image {
            position: relative;
            overflow: hidden;
            height: 280px; /* Fixed height for consistency */
        }
        
        .team-item__image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.5s ease;
        }
        
        .team-item:hover .team-item__image img {
            transform: scale(1.1);
        }
        
        .team-item__content {
            padding: 30px 20px;
            text-align: center;
            background-color: var(--white);
            border-radius: 0 0 15px 15px;
            position: relative;
        }
        
        .team-item__content::before {
            content: '';
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 20px;
            background-color: white;
            rotate: 45deg;
            z-index: -1;
        }
        
        .team-item__title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        
        .team-item__title a {
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .team-item__title a:hover {
            color: var(--primary-color);
        }
        
        .team-item__designation {
            font-size: 16px;
            color: var(--primary-color);
            margin-bottom: 0;
            font-weight: 500;
        }
        
        /* CTA Button */
        .btn-primary {
            background: var(--gradient-primary);
            border-color: var(--primary-color);
            transition: all 0.3s ease;
            padding: 12px 30px;
            font-weight: 600;
            font-size: 18px;
            letter-spacing: 0.5px;
        }
        
        .btn-primary:hover {
            background: var(--primary-color);
            border-color: var(--secondary-color);
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(105, 65, 198, 0.4);
        }

        /* Enhanced Call to Action Section */
        .cta-section {
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('assets/images/patterns/dot-pattern.png');
            opacity: 0.07;
            z-index: 0;
        }

        .cta-heading {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 15px;
            color: #fff;
        }

        .cta-subheading {
            font-size: 18px;
            margin-bottom: 0;
            opacity: 0.9;
        }

        .cta-btn {
            box-shadow: 0 15px 30px rgba(255, 255, 255, 0.2);
            font-size: 18px;
            padding: 14px 32px;
            transition: all 0.5s ease;
        }

        .cta-btn:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 20px 40px rgba(255, 255, 255, 0.3);
        }
        
        /* ==================
           Responsive Styles
           ================== */
        @media (max-width: 1199px) {
            .play-button {
                width: 80px;
                height: 80px;
            }
            
            .play-button i {
                font-size: 30px;
            }

            .about-header__title {
                font-size: 38px;
            }

            .about-heading__title {
                font-size: 32px;
            }
        }
        
        @media (max-width: 991px) {
            .about-header {
                padding: 160px 0 130px;
            }
            
            .about-header__title {
                font-size: 34px;
            }

            .about-header__subtitle {
                font-size: 18px;
            }
            
            .about-section {
                padding: 80px 0;
            }
            
            .about-video {
                margin-bottom: 60px;
            }
            
            .campus-stat h3 {
                font-size: 30px !important;
            }
            
            .team-item__image {
                height: 260px;
            }

            .about-heading__title {
                font-size: 28px;
                margin-bottom: 25px;
            }

            .stats-item__number {
                font-size: 36px;
            }

            .stats-item__text {
                font-size: 16px;
            }
        }
        
        @media (max-width: 767px) {
            .about-header {
                padding: 130px 0 110px;
            }
            
            .about-header__title {
                font-size: 30px;
            }
            .about-header__subtitle {
                font-size: 16px;
                max-width: 95%;
            }
            
            .play-button {
                width: 70px;
                height: 70px;
            }
            
            .play-button i {
                font-size: 26px;
            }
            
            .feature-item {
                padding: 30px 25px;
            }
            
            .feature-item__icon {
                width: 70px;
                height: 70px;
                font-size: 28px;
                margin-bottom: 20px;
            }
            
            .feature-item__title {
                font-size: 20px;
            }
            
            .stats-item__number {
                font-size: 32px;
            }

            .about-section {
                padding: 70px 0;
            }
            
            .team-item__image {
                height: 240px;
            }

            .cta-heading {
                font-size: 28px;
            }

            .cta-subheading {
                font-size: 16px;
            }
        }
        
        @media (max-width: 575px) {
            .about-header {
                padding: 120px 0 100px;
            }
            
            .about-header__title {
                font-size: 26px;
            }
            
            .about-header__subtitle {
                font-size: 15px;
            }

            .about-heading__tagline {
                font-size: 14px;
                margin-bottom: 8px;
            }

            .about-heading__title {
                font-size: 24px;
                margin-bottom: 20px;
            }
            
            .feature-item__title {
                font-size: 18px;
            }
            
            .stats-item__icon {
                font-size: 32px;
            }
            
            .stats-item__number {
                font-size: 28px;
            }
            
            .team-item__image {
                height: 220px;
            }
            
            /* Improve text readability on small screens */
            .about-content__text p {
                font-size: 15px;
                line-height: 1.6;
            }
            
            .feature-item__text {
                font-size: 14px;
            }

            .about-section {
                padding: 60px 0;
            }

            .cta-heading {
                font-size: 24px;
            }

            .cta-subheading {
                font-size: 15px;
            }

            .cta-btn {
                font-size: 16px;
                padding: 12px 24px;
            }
        }
        
        /* Fix for RTL on mobile */
        @media (max-width: 767px) {
            [dir="rtl"] .col-md-6 {
                text-align: right;
            }
            
            [dir="rtl"] .about-highlight {
                justify-content: flex-start;
            }
        }

        /* Arabic specific adjustments */
        html[lang="ar"] .about-header__title,
        html[lang="ar"] .about-heading__title,
        html[lang="ar"] .feature-item__title,
        html[lang="ar"] .team-item__title,
        html[lang="ar"] .cta-heading {
            line-height: 1.4;
        }

        /* Improved language switcher for mobile */
        @media (max-width: 575px) {
            .language-switcher {
                margin-top: 10px;
                margin-left: 0;
                justify-content: center;
            }
        }
    </style>