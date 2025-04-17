<style>
            /* استایل‌های اختصاصی صفحه امکانات */
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
            --box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-color);
            line-height: 1.6;
            background-color: #fff;
        }
        
        [dir="rtl"] body {
            font-family: 'Vazir', sans-serif;
        }
        
        /* Hero Header Section */
        .facilities-header {
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
        
        .facilities-header::after {
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
        
        .facilities-header__content {
            position: relative;
            z-index: 2;
        }
        
        .facilities-header__title {
            font-size: 42px;
            font-weight: 800;
            margin-bottom: 20px;
            color: white;
            animation: slideDown 1s ease-out, floatEffect 4s ease-in-out infinite;
        }
        
        [dir="rtl"] .facilities-header__title {
            font-family: 'Vazir', sans-serif !important;
        }
        
        .facilities-header__subtitle {
            font-size: 18px;
            max-width: 700px;
            margin: 0 auto 40px;
            opacity: 0.9;
            color: white;
            animation: slideDown 1s ease-out 0.3s both, floatEffect 5s ease-in-out infinite;
        }
        
        [dir="rtl"] .facilities-header__subtitle {
            font-family: 'Vazir', sans-serif;
        }
        
        /* Introduction Section */
        .facility-section {
            padding: 100px 0;
            position: relative;
        }
        
        .facility-section:nth-child(even) {
            background-color: var(--bg-light);
        }
        
        .section-label {
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 1.5px;
            color: var(--primary-color);
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        [dir="rtl"] .section-label {
            font-family: 'Vazir', sans-serif;
        }
        
        .section-title {
            font-size: 32px;
            font-weight: 800;
            color: rgb(2, 2, 10);
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
        
        /* Facility Image */
        .facility-image {
            width: 100%;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            margin-bottom: 30px;
            position: relative;
            transition: var(--transition);
        }
        
        .facility-image:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(105, 65, 198, 0.15);
        }
        
        .facility-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }
        
        .facility-image:hover img {
            transform: scale(1.05);
        }
        
        /* Facilities Container */
        .facilities-container {
            padding: 60px 0;
        }
        
        /* Facility Block */
        .facility-block {
            margin-bottom: 60px;
        }
        
        .facility-block:nth-child(even) {
            background-color: var(--bg-light);
            padding: 40px 0;
        }
        
        .facility-content {
            padding: 20px 0;
        }
        
        .facility-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--secondary-color);
        }
        
        .facility-subtitle {
            color: var(--primary-color);
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
            display: block;
        }
        
        .facility-description {
            margin-bottom: 20px;
            line-height: 1.7;
        }
        
        /* لیست ویژگی‌ها */
        .facility-features, .feature-list {
            list-style: none;
            padding-left: 0;
            margin-bottom: 20px;
        }
        
        [dir="rtl"] .facility-features, [dir="rtl"] .feature-list {
            padding-right: 0;
        }
        
        .facility-features li, .feature-list li {
            position: relative;
            padding-left: 30px;
            margin-bottom: 10px;
        }
        
        [dir="rtl"] .facility-features li, [dir="rtl"] .feature-list li {
            padding-left: 0;
            padding-right: 30px;
        }
        
        .facility-features li:before, .feature-list li:before {
            content: '\f00c';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            color: var(--primary-color);
            position: absolute;
            left: 0;
            top: 2px;
        }
        
        [dir="rtl"] .facility-features li:before, [dir="rtl"] .feature-list li:before {
            left: auto;
            right: 0;
        }
        
        /* باکس تمرکز ویژه */
        .key-focus-box, .key-focus {
            background-color: rgba(105, 65, 198, 0.05);
            border-left: 4px solid var(--primary-color);
            padding: 20px;
            margin-top: 20px;
            border-radius: 0 10px 10px 0;
        }
        
        [dir="rtl"] .key-focus-box, [dir="rtl"] .key-focus {
            border-left: none;
            border-right: 4px solid var(--primary-color);
            border-radius: 10px 0 0 10px;
        }
        
        .key-focus-box h4, .key-focus h4 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
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
        
        /* تطبیق با صفحه نمایش‌های کوچک */
        @media (max-width: 767px) {
            .facility-image {
                margin-bottom: 20px;
                max-height: 200px;
            }
            
            .facility-block {
                margin-bottom: 40px;
            }
            
            .facility-content {
                padding: 10px 0;
            }
            
            .facilities-header {
                padding: 120px 0 100px;
            }
            
            .facilities-header__title {
                font-size: 30px;
            }
            
            .section-title {
                font-size: 24px;
            }
        }
</style>