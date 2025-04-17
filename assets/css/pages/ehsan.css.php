<style>
        /* Custom styles for Ehsan SOD page */
        :root {
            --primary-color: #6941C6;
            --secondary-color: #333333;
            --accent-color: #7F56D9;
            --text-color: #333;
            --text-light: #666;
            --bg-light: #f8f9fa;
            --bg-primary: #f9f9f9;
            --white: #ffffff;
            --border-radius: 15px;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --animation-duration: 0.3s;
            --transition: all 0.3s ease;
        }
        
        /* Font Styles */
        @font-face {
            font-family: 'Vazir';
            src: url('assets/fonts/Vazir.eot');
            src: url('assets/fonts/Vazir.eot?#iefix') format('embedded-opentype'),
                 url('assets/fonts/Vazir.woff2') format('woff2'),
                 url('assets/fonts/Vazir.woff') format('woff'),
                 url('assets/fonts/Vazir.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
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
        }
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-color);
            line-height: 1.6;
        }
        
        [dir="rtl"] body {
            font-family: 'Vazir', sans-serif;
        }
        
        /* Ehsan Header */
        .ehsan-header {
            background: linear-gradient(135deg, #0F172A 0%, #1E293B 60%, #334155 100%);
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
            background: radial-gradient(circle, #7F56D9, #4E36B1);
        }
        
        .cosmic-planet:nth-child(2) {
            bottom: -80px;
            right: -80px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, #9E77ED, #6941C6);
        }
        
        .ehsan-header::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 150px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23f5f7fa' fill-opacity='1' d='M0,192L60,186.7C120,181,240,171,360,181.3C480,192,600,224,720,229.3C840,235,960,213,1080,181.3C1200,149,1320,107,1380,85.3L1440,64L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
            background-size: cover;
            background-position: center bottom;
            z-index: 1;
        }
        
        .ehsan-header__content {
            position: relative;
            z-index: 2;
        }
        
        .ehsan-header__title {
            font-size: 42px;
            font-weight: 800;
            margin-bottom: 20px;
            color: white;
            animation: slideDown 1s ease-out, floatEffect 4s ease-in-out infinite;
        }
        
        [dir="rtl"] .ehsan-header__title {
            font-family: 'Vazir', sans-serif !important;
        }
        
        .ehsan-header__subtitle {
            font-size: 18px;
            max-width: 700px;
            margin: 0 auto 40px;
            opacity: 0.9;
            color: white;
            animation: slideDown 1s ease-out 0.3s both, floatEffect 5s ease-in-out infinite;
        }
        
        [dir="rtl"] .ehsan-header__subtitle {
            font-family: 'Vazir', sans-serif;
        }
        
        /* Content Styling */
        .ehsan-section {
            padding: 100px 0;
            position: relative;
        }
        
        .ehsan-section:nth-child(even) {
            background-color: var(--bg-light);
        }
        
        .section-title {
            font-size: 32px;
            font-weight: 800;  /* Heavy weight for titles */
            color: #00000;  /* Black color as requested */
            margin-bottom: 25px;
            line-height: 1.3;
        }
        
        [dir="rtl"] .section-title {
            font-family: 'Vazir', sans-serif;
        }
        
        .section-description {
            color: var(--text-color);
            font-size: 16px;
            margin-bottom: 30px;
            line-height: 1.8;
        }
        
        [dir="rtl"] .section-description {
            font-family: 'Vazir', sans-serif;
        }
        
        /* Feature Box */
        .objective-box {
            padding: 25px;
            border-radius: var(--border-radius);
            background-color: var(--white);
            box-shadow: var(--card-shadow);
            margin-bottom: 25px;
            border-left: 4px solid var(--primary-color);
            transition: var(--transition);
            
        }
        
        [dir="rtl"] .objective-box {
            border-left: none;
            border-right: 4px solid var(--primary-color);
        }
        
        .objective-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(105, 65, 198, 0.15);
        }
        
        .objective-box h4 {
            color: var(--secondary-color);
            font-weight: 700;
            margin-bottom: 15px;
            font-size: 18px;
        }
        
        [dir="rtl"] .objective-box h4 {
            font-family: 'Vazir', sans-serif;
        }
        
        .objective-box p {
            color: var(--text-light);
            margin-bottom: 0;
            font-size: 15px;
        }
        
        [dir="rtl"] .objective-box p {
            font-family: 'Vazir', sans-serif;
        }
        
        /* Service Cards */
        .service-card {
            position: relative;
            background-color: var(--white);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            margin-bottom: 30px;
            transition: var(--transition);
        }
        
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(105, 65, 198, 0.2);
        }
        
        .service-card__icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 70px;
            height: 70px;
            margin: 0 auto 20px;
            background-color: rgba(105, 65, 198, 0.1);
            border-radius: 50%;
            color: var(--primary-color);
            font-size: 28px;
        }
        
        .service-card__content {
            padding: 30px;
        }
        
        .service-card__title {
            color:rgb(15, 12, 95);
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 15px;
        }
        
        [dir="rtl"] .service-card__title {
            font-family: 'Vazir', sans-serif;
        }
        
        .service-card__text {
            color: var(--text-light);
            font-size: 15px;
            margin-bottom: 0;
            line-height: 1.8;
        }
        
        [dir="rtl"] .service-card__text {
            font-family: 'Vazir', sans-serif;
        }
        
        /* Image Styling */
        .ehsan-image {
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            margin-bottom: 30px;
            position: relative;
        }
        
        .ehsan-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }
        
        .ehsan-image:hover img {
            transform: scale(1.05);
        }
        
        /* List Styling */
        .check-list {
            list-style: none;
            padding-left: 0;
            margin-bottom: 30px;
        }
        
        [dir="rtl"] .check-list {
            padding-right: 0;
        }
        
        .check-list li {
            position: relative;
            padding-left: 30px;
            margin-bottom: 10px;
            color: var(--text-color);
            font-size: 16px;
        }
        
        [dir="rtl"] .check-list li {
            padding-left: 0;
            padding-right: 30px;
            font-family: 'Vazir', sans-serif;
        }
        
        .check-list li:before {
            content: '\f00c';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            color: var(--primary-color);
            position: absolute;
            left: 0;
            top: 2px;
        }
        
        [dir="rtl"] .check-list li:before {
            left: auto;
            right: 0;
        }
        
        /* Call to Action */
        .cta-box {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            padding: 50px;
            border-radius: var(--border-radius);
            color: var(--white);
            text-align: center;
            margin-top: 50px;
        }
        
        .cta-box h3 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--white);
        }
        
        [dir="rtl"] .cta-box h3 {
            font-family: 'Vazir', sans-serif;
        }
        
        .cta-box p {
            font-size: 16px;
            margin-bottom: 30px;
            opacity: 0.9;
        }
        
        [dir="rtl"] .cta-box p {
            font-family: 'Vazir', sans-serif;
        }
        
        .btn-cta {
            background-color: var(--white);
            color: var(--primary-color);
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            transition: var(--transition);
            text-decoration: none;
        }
        
        [dir="rtl"] .btn-cta {
            font-family: 'Vazir', sans-serif;
        }
        
        .btn-cta i {
            margin-left: 8px;
        }
        
        [dir="rtl"] .btn-cta i {
            margin-left: 0;
            margin-right: 8px;
        }
        
        .btn-cta:hover {
            background-color: rgba(255, 255, 255, 0.9);
            color: var(--primary-color);
            transform: translateY(-3px);
        }
        
        /* Animation Keyframes */
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
        
        @keyframes floatEffect {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        /* Responsive Adjustments */
        @media (max-width: 991px) {
            .ehsan-section {
                padding: 70px 0;
            }
            
            .ehsan-header {
                padding: 150px 0 120px;
            }
            
            .ehsan-header__title {
                font-size: 36px;
            }
            
            .section-title {
                font-size: 28px;
            }
            
            .cta-box {
                padding: 40px 30px;
            }
        }
        
        @media (max-width: 767px) {
            .ehsan-section {
                padding: 50px 0;
            }
            
            .ehsan-header {
                padding: 120px 0 100px;
            }
            
            .ehsan-header__title {
                font-size: 30px;
            }
            
            .section-title {
                font-size: 24px;
            }
            
            .service-card__content {
                padding: 20px;
            }
            
            .objective-box {
                padding: 20px;
            }
            
            .cta-box {
                padding: 30px 20px;
            }
        }
    </style>