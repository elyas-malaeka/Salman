<!DOCTYPE html>
<html lang="fa" dir="rtl" class="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جزئیات کتاب - کتابخانه آنلاین مجتمع آموزشی سلمان</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* استفاده از Design Tokens */
        :root {
            --primary: hsl(243, 100%, 69%);
            --primary-rgb: 108, 99, 255;
            --primary-50: hsl(243, 100%, 97%);
            --primary-100: hsl(243, 100%, 94%);
            --primary-500: var(--primary);
            --primary-600: hsl(243, 100%, 62%);
            --primary-700: hsl(243, 100%, 54%);
            
            --secondary-color: #333333;
            --accent-color: #7F56D9;
            --deep-purple: #6941C6;
            
            --sky-blue: #6C9EFF;
            --purple: #9471FF;
            --pink: #FF6B8B;
            --teal: #36F1CD;
            --yellow: #FFDE59;
            --orange: #FF8A65;
            
            --text-color: #333;
            --text-dark: #1E293B;
            --text-light: #666;
            --text-muted: #64748B;
            --text-gray: #6B7280;
            
            --white: #ffffff;
            --bg-primary: #f9f9f9;
            --bg-light: #f8f9fa;
            --light-purple: rgba(108, 99, 255, 0.05);
            --light-sky: #E8F5FF;
            
            --gradient-primary: linear-gradient(135deg, #4E36B1 0%, #6941C6 50%, #7F56D9 100%);
            --gradient-cosmic: linear-gradient(135deg, #1e0057 0%, #391e85 50%, #6C63FF 100%);
            --gradient-soft: linear-gradient(135deg, #E0E0FF 0%, #F5F3FF 100%);
            --gradient-glass: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
            
            --space-1: 0.25rem;
            --space-2: 0.5rem;
            --space-3: 0.75rem;
            --space-4: 1rem;
            --space-5: 1.25rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            --space-10: 2.5rem;
            --space-12: 3rem;
            --space-16: 4rem;
            --space-20: 5rem;
            --space-24: 6rem;
            
            --radius-sm: 0.125rem;
            --radius-md: 0.375rem;
            --radius-lg: 0.5rem;
            --radius-xl: 0.75rem;
            --radius-2xl: 1rem;
            --radius-3xl: 1.5rem;
            --radius-full: 9999px;
            
            --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            --shadow-primary: 0 10px 40px -10px rgba(var(--primary-rgb), 0.35);
            --shadow-book: 0 20px 40px -10px rgba(0, 0, 0, 0.2);
            
            --font-size-xs: 0.75rem;
            --font-size-sm: 0.875rem;
            --font-size-base: 1rem;
            --font-size-lg: 1.125rem;
            --font-size-xl: 1.25rem;
            --font-size-2xl: 1.5rem;
            --font-size-3xl: 1.875rem;
            --font-size-4xl: 2.25rem;
            --font-size-5xl: 3rem;
            
            --duration-fast: 150ms;
            --duration-normal: 200ms;
            --duration-slow: 300ms;
            --ease-out: cubic-bezier(0, 0, 0.2, 1);
            --ease-bounce: cubic-bezier(0.87, -0.41, 0.19, 1.44);
            --ease-elastic: cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Vazirmatn', sans-serif;
            background: var(--bg-primary);
            color: var(--text-color);
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 var(--space-6);
        }
        
        /* ========== ENHANCED HERO HEADER ========== */
        .book-hero {
            position: relative;
            background: var(--gradient-cosmic);
            min-height: 60vh;
            display: flex;
            align-items: center;
            overflow: hidden;
        }
        
        .hero-bg-pattern {
            position: absolute;
            inset: 0;
            background: 
                radial-gradient(circle at 20% 30%, rgba(108, 99, 255, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(255, 107, 139, 0.2) 0%, transparent 50%);
            z-index: 1;
        }
        
        .hero-particles {
            position: absolute;
            inset: 0;
            z-index: 2;
        }
        
        .floating-particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            animation: float-up 8s infinite linear;
        }
        
        .floating-particle:nth-child(1) { left: 10%; animation-delay: 0s; }
        .floating-particle:nth-child(2) { left: 25%; animation-delay: 2s; }
        .floating-particle:nth-child(3) { left: 40%; animation-delay: 4s; }
        .floating-particle:nth-child(4) { left: 55%; animation-delay: 1s; }
        .floating-particle:nth-child(5) { left: 70%; animation-delay: 3s; }
        .floating-particle:nth-child(6) { left: 85%; animation-delay: 5s; }
        
        @keyframes float-up {
            0% {
                transform: translateY(100vh) scale(0);
                opacity: 0;
            }
            10% {
                opacity: 1;
                transform: scale(1);
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) scale(0);
                opacity: 0;
            }
        }
        
        .hero-content {
            position: relative;
            z-index: 3;
            width: 100%;
        }
        
        .breadcrumb {
            margin-bottom: var(--space-6);
        }
        
        .breadcrumb-list {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            list-style: none;
            color: rgba(255, 255, 255, 0.8);
            font-size: var(--font-size-sm);
        }
        
        .breadcrumb-item {
            display: flex;
            align-items: center;
            gap: var(--space-2);
        }
        
        .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color var(--duration-fast) var(--ease-out);
        }
        
        .breadcrumb-item a:hover {
            color: var(--yellow);
        }
        
        .breadcrumb-separator {
            color: rgba(255, 255, 255, 0.5);
        }
        
        .hero-layout {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: var(--space-12);
            align-items: center;
        }
        
        /* ========== 3D BOOK COVER ========== */
        .book-cover-3d {
            perspective: 1000px;
            position: relative;
        }
        
        .book-wrapper {
            position: relative;
            width: 280px;
            height: 400px;
            transform-style: preserve-3d;
            transition: transform var(--duration-slow) var(--ease-out);
            cursor: pointer;
        }
        
        .book-wrapper:hover {
            transform: rotateY(-15deg) rotateX(5deg);
        }
        
        .book-front {
            position: absolute;
            width: 100%;
            height: 100%;
            background: var(--gradient-soft);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-book);
            overflow: hidden;
            transform: translateZ(20px);
        }
        
        .book-front img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .book-spine {
            position: absolute;
            left: -20px;
            top: 0;
            width: 20px;
            height: 100%;
            background: linear-gradient(135deg, #2D1B69 0%, #1E0E4B 100%);
            transform: rotateY(-90deg);
            transform-origin: right;
            border-radius: var(--radius-sm) 0 0 var(--radius-sm);
        }
        
        .book-back {
            position: absolute;
            width: 100%;
            height: 100%;
            background: #1a1a1a;
            border-radius: var(--radius-xl);
            transform: translateZ(-20px);
        }
        
        .book-glow {
            position: absolute;
            inset: -20px;
            background: var(--gradient-primary);
            border-radius: var(--radius-2xl);
            opacity: 0.3;
            filter: blur(20px);
            z-index: -1;
        }
        
        .no-cover-placeholder {
            width: 100%;
            height: 100%;
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: var(--font-size-4xl);
            color: white;
            border-radius: var(--radius-xl);
        }
        
        /* ========== BOOK INFO ========== */
        .book-main-info {
            color: white;
        }
        
        .book-title {
            font-size: var(--font-size-4xl);
            font-weight: 800;
            margin-bottom: var(--space-4);
            line-height: 1.2;
            background: linear-gradient(135deg, #ffffff 0%, #e0e7ff 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .book-subtitle {
            font-size: var(--font-size-xl);
            margin-bottom: var(--space-6);
            opacity: 0.9;
        }
        
        .book-meta-tags {
            display: flex;
            flex-wrap: wrap;
            gap: var(--space-3);
            margin-bottom: var(--space-8);
        }
        
        .meta-tag {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--radius-full);
            padding: var(--space-2) var(--space-4);
            font-size: var(--font-size-sm);
            color: rgba(255, 255, 255, 0.9);
        }
        
        .action-buttons {
            display: flex;
            gap: var(--space-4);
        }
        
        .btn-primary {
            background: var(--gradient-primary);
            color: white;
            border: none;
            border-radius: var(--radius-xl);
            padding: var(--space-4) var(--space-8);
            font-size: var(--font-size-lg);
            font-weight: 600;
            cursor: pointer;
            transition: all var(--duration-normal) var(--ease-out);
            display: flex;
            align-items: center;
            gap: var(--space-2);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-primary);
        }
        
        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: var(--radius-xl);
            padding: var(--space-4) var(--space-8);
            font-size: var(--font-size-lg);
            font-weight: 600;
            cursor: pointer;
            transition: all var(--duration-normal) var(--ease-out);
            display: flex;
            align-items: center;
            gap: var(--space-2);
        }
        
        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }
        
        /* ========== CONTENT SECTIONS ========== */
        .main-content {
            padding: var(--space-20) 0;
        }
        
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: var(--space-12);
        }
        
        .content-section {
            background: white;
            border-radius: var(--radius-2xl);
            padding: var(--space-8);
            box-shadow: var(--shadow-lg);
            margin-bottom: var(--space-8);
            position: relative;
            overflow: hidden;
        }
        
        .content-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }
        
        .section-title {
            font-size: var(--font-size-2xl);
            font-weight: 700;
            margin-bottom: var(--space-6);
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: var(--space-3);
        }
        
        .section-icon {
            width: 40px;
            height: 40px;
            background: var(--gradient-primary);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: var(--font-size-lg);
        }
        
        .description-text {
            font-size: var(--font-size-lg);
            line-height: 1.8;
            color: var(--text-gray);
            text-align: justify;
        }
        
        .description-text p {
            margin-bottom: var(--space-6);
        }
        
        .description-text p:last-child {
            margin-bottom: 0;
        }
        
        /* ========== SIDEBAR INFO ========== */
        .sidebar-card {
            background: white;
            border-radius: var(--radius-2xl);
            padding: var(--space-6);
            box-shadow: var(--shadow-lg);
            margin-bottom: var(--space-6);
            position: relative;
            overflow: hidden;
        }
        
        .sidebar-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--gradient-primary);
        }
        
        .card-title {
            font-size: var(--font-size-xl);
            font-weight: 700;
            margin-bottom: var(--space-5);
            color: var(--text-dark);
        }
        
        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: var(--space-3) 0;
            border-bottom: 1px solid var(--light-purple);
        }
        
        .info-item:last-child {
            border-bottom: none;
        }
        
        .info-label {
            font-weight: 600;
            color: var(--text-muted);
        }
        
        .info-value {
            font-weight: 600;
            color: var(--text-dark);
        }
        
        /* ========== CONTRIBUTORS SECTION ========== */
        .contributors-grid {
            display: grid;
            gap: var(--space-4);
        }
        
        .contributor-card {
            display: flex;
            align-items: center;
            gap: var(--space-4);
            background: var(--light-purple);
            border-radius: var(--radius-xl);
            padding: var(--space-4);
            transition: all var(--duration-normal) var(--ease-out);
            cursor: pointer;
        }
        
        .contributor-card:hover {
            transform: translateX(10px);
            background: var(--primary-100);
        }
        
        .contributor-avatar {
            width: 60px;
            height: 60px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: var(--font-size-xl);
            flex-shrink: 0;
        }
        
        .contributor-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }
        
        .contributor-info {
            flex: 1;
        }
        
        .contributor-name {
            font-size: var(--font-size-lg);
            font-weight: 600;
            margin-bottom: var(--space-1);
            color: var(--text-dark);
        }
        
        .contributor-role {
            font-size: var(--font-size-sm);
            color: var(--primary);
            font-weight: 500;
        }
        
        /* ========== CATEGORIES TAGS ========== */
        .categories-list {
            display: flex;
            flex-wrap: wrap;
            gap: var(--space-2);
        }
        
        .category-tag {
            background: var(--gradient-soft);
            border: 1px solid var(--primary-100);
            border-radius: var(--radius-full);
            padding: var(--space-2) var(--space-4);
            font-size: var(--font-size-sm);
            font-weight: 500;
            color: var(--primary);
            text-decoration: none;
            transition: all var(--duration-fast) var(--ease-out);
        }
        
        .category-tag:hover {
            background: var(--primary);
            color: white;
            transform: scale(1.05);
        }
        
        /* ========== RELATED BOOKS ========== */
        .related-books {
            background: var(--light-sky);
            padding: var(--space-20) 0;
        }
        
        .related-header {
            text-align: center;
            margin-bottom: var(--space-16);
        }
        
        .related-title {
            font-size: var(--font-size-3xl);
            font-weight: 800;
            margin-bottom: var(--space-4);
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .related-subtitle {
            font-size: var(--font-size-lg);
            color: var(--text-muted);
        }
        
        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: var(--space-6);
        }
        
        .related-book-card {
            background: white;
            border-radius: var(--radius-2xl);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            transition: all var(--duration-slow) var(--ease-out);
            cursor: pointer;
        }
        
        .related-book-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: var(--shadow-2xl);
        }
        
        .related-cover {
            height: 200px;
            background: var(--gradient-soft);
            position: relative;
            overflow: hidden;
        }
        
        .related-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform var(--duration-slow) var(--ease-out);
        }
        
        .related-book-card:hover .related-cover img {
            transform: scale(1.1);
        }
        
        .related-cover-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--gradient-primary);
            color: white;
            font-size: var(--font-size-2xl);
        }
        
        .related-info {
            padding: var(--space-6);
        }
        
        .related-book-title {
            font-size: var(--font-size-lg);
            font-weight: 700;
            margin-bottom: var(--space-2);
            color: var(--text-dark);
            line-height: 1.4;
        }
        
        .related-author {
            color: var(--primary);
            font-weight: 500;
            font-size: var(--font-size-base);
        }
        
        /* ========== RESPONSIVE DESIGN ========== */
        @media (max-width: 1024px) {
            .hero-layout {
                grid-template-columns: 250px 1fr;
                gap: var(--space-8);
            }
            
            .content-grid {
                grid-template-columns: 1fr;
                gap: var(--space-8);
            }
        }
        
        @media (max-width: 768px) {
            .hero-layout {
                grid-template-columns: 1fr;
                gap: var(--space-8);
                text-align: center;
            }
            
            .book-cover-3d {
                justify-self: center;
            }
            
            .book-wrapper {
                width: 200px;
                height: 280px;
            }
            
            .book-title {
                font-size: var(--font-size-3xl);
            }
            
            .action-buttons {
                justify-content: center;
            }
            
            .content-section,
            .sidebar-card {
                padding: var(--space-6);
            }
            
            .section-title {
                font-size: var(--font-size-xl);
            }
            
            .related-grid {
                grid-template-columns: 1fr;
                max-width: 400px;
                margin: 0 auto;
            }
        }
        
        @media (max-width: 480px) {
            .container {
                padding: 0 var(--space-4);
            }
            
            .main-content {
                padding: var(--space-12) 0;
            }
            
            .related-books {
                padding: var(--space-12) 0;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .book-meta-tags {
                justify-content: center;
            }
        }
        
        /* ========== SCROLL ANIMATIONS ========== */
        .fade-in-up {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s var(--ease-out);
        }
        
        .fade-in-up.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* ========== LOADING STATES ========== */
        .loading-skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }
        
        @keyframes loading {
            0% {
                background-position: 200% 0;
            }
            100% {
                background-position: -200% 0;
            }
        }
    </style>
</head>
<body>
    <!-- ENHANCED HERO SECTION -->
    <section class="book-hero">
        <div class="hero-bg-pattern"></div>
        <div class="hero-particles">
            <div class="floating-particle"></div>
            <div class="floating-particle"></div>
            <div class="floating-particle"></div>
            <div class="floating-particle"></div>
            <div class="floating-particle"></div>
            <div class="floating-particle"></div>
        </div>
        
        <div class="container">
            <div class="hero-content">
                <!-- BREADCRUMB -->
                <nav class="breadcrumb">
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item">
                            <a href="#"><i class="fas fa-home"></i> صفحه اصلی</a>
                            <span class="breadcrumb-separator"><i class="fas fa-chevron-left"></i></span>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">کتابخانه</a>
                            <span class="breadcrumb-separator"><i class="fas fa-chevron-left"></i></span>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">کتاب‌ها</a>
                            <span class="breadcrumb-separator"><i class="fas fa-chevron-left"></i></span>
                        </li>
                        <li class="breadcrumb-item">
                            <span>جزئیات کتاب</span>
                        </li>
                    </ul>
                </nav>
                
                <!-- HERO LAYOUT -->
                <div class="hero-layout">
                    <!-- 3D BOOK COVER -->
                    <div class="book-cover-3d">
                        <div class="book-wrapper">
                            <div class="book-glow"></div>
                            <div class="book-front">
                                <div class="no-cover-placeholder">
                                    <i class="fas fa-book"></i>
                                </div>
                            </div>
                            <div class="book-spine"></div>
                            <div class="book-back"></div>
                        </div>
                    </div>
                    
                    <!-- BOOK MAIN INFO -->
                    <div class="book-main-info">
                        <h1 class="book-title">عنوان کتاب نمونه</h1>
                        <p class="book-subtitle">زیرعنوان یا توضیح کوتاه کتاب</p>
                        
                        <div class="book-meta-tags">
                            <div class="meta-tag">
                                <i class="fas fa-user"></i>
                                <span>نویسنده نمونه</span>
                            </div>
                            <div class="meta-tag">
                                <i class="fas fa-calendar"></i>
                                <span>۱۴۰۲</span>
                            </div>
                            <div class="meta-tag">
                                <i class="fas fa-file-alt"></i>
                                <span>۲۵۰ صفحه</span>
                            </div>
                            <div class="meta-tag">
                                <i class="fas fa-building"></i>
                                <span>انتشارات نمونه</span>
                            </div>
                        </div>
                        
                        <div class="action-buttons">
                            <button class="btn-primary">
                                <i class="fas fa-eye"></i>
                                مشاهده کتاب
                            </button>
                            <button class="btn-secondary">
                                <i class="fas fa-share"></i>
                                اشتراک‌گذاری
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- MAIN CONTENT -->
    <section class="main-content">
        <div class="container">
            <div class="content-grid">
                <!-- LEFT COLUMN - MAIN CONTENT -->
                <div class="main-column">
                    <!-- DESCRIPTION SECTION -->
                    <div class="content-section fade-in-up">
                        <h2 class="section-title">
                            <div class="section-icon">
                                <i class="fas fa-book-open"></i>
                            </div>
                            درباره کتاب
                        </h2>
                        <div class="description-text">
                            <p>
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                            </p>
                            <p>
                                کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد.
                            </p>
                            <p>
                                در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.
                            </p>
                        </div>
                    </div>
                    
                    <!-- TABLE OF CONTENTS -->
                    <div class="content-section fade-in-up">
                        <h2 class="section-title">
                            <div class="section-icon">
                                <i class="fas fa-list"></i>
                            </div>
                            فهرست مطالب
                        </h2>
                        <div class="description-text">
                            <p>
                                فصل اول: مقدمه<br>
                                فصل دوم: مبانی نظری<br>
                                فصل سوم: روش‌شناسی<br>
                                فصل چهارم: یافته‌ها<br>
                                فصل پنجم: بحث و نتیجه‌گیری<br>
                                منابع و مراجع
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- RIGHT COLUMN - SIDEBAR -->
                <div class="sidebar-column">
                    <!-- BOOK DETAILS -->
                    <div class="sidebar-card fade-in-up">
                        <h3 class="card-title">اطلاعات کتاب</h3>
                        <div class="info-item">
                            <span class="info-label">شابک:</span>
                            <span class="info-value">۹۷۸-۹۶۴-۱۲۳-۴۵۶-۷</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">تاریخ انتشار:</span>
                            <span class="info-value">۱۴۰۲/۰۵/۱۵</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">ناشر:</span>
                            <span class="info-value">انتشارات نمونه</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">تعداد صفحات:</span>
                            <span class="info-value">۲۵۰ صفحه</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">زبان:</span>
                            <span class="info-value">فارسی</span>
                        </div>
                    </div>
                    
                    <!-- CONTRIBUTORS -->
                    <div class="sidebar-card fade-in-up">
                        <h3 class="card-title">مشارکت‌کنندگان</h3>
                        <div class="contributors-grid">
                            <div class="contributor-card">
                                <div class="contributor-avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="contributor-info">
                                    <div class="contributor-name">نویسنده اصلی</div>
                                    <div class="contributor-role">نویسنده</div>
                                </div>
                            </div>
                            <div class="contributor-card">
                                <div class="contributor-avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="contributor-info">
                                    <div class="contributor-name">مترجم نمونه</div>
                                    <div class="contributor-role">مترجم</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- CATEGORIES -->
                    <div class="sidebar-card fade-in-up">
                        <h3 class="card-title">دسته‌بندی‌ها</h3>
                        <div class="categories-list">
                            <a href="#" class="category-tag">ادبیات</a>
                            <a href="#" class="category-tag">رمان</a>
                            <a href="#" class="category-tag">داستان</a>
                            <a href="#" class="category-tag">معاصر</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- RELATED BOOKS -->
    <section class="related-books">
        <div class="container">
            <div class="related-header fade-in-up">
                <h2 class="related-title">کتاب‌های مرتبط</h2>
                <p class="related-subtitle">کتاب‌هایی که ممکن است به شما علاقه‌مند باشید</p>
            </div>
            
            <div class="related-grid">
                <div class="related-book-card fade-in-up">
                    <div class="related-cover">
                        <div class="related-cover-placeholder">
                            <i class="fas fa-book"></i>
                        </div>
                    </div>
                    <div class="related-info">
                        <h3 class="related-book-title">کتاب مرتبط ۱</h3>
                        <p class="related-author">نویسنده نمونه</p>
                    </div>
                </div>
                
                <div class="related-book-card fade-in-up">
                    <div class="related-cover">
                        <div class="related-cover-placeholder">
                            <i class="fas fa-book"></i>
                        </div>
                    </div>
                    <div class="related-info">
                        <h3 class="related-book-title">کتاب مرتبط ۲</h3>
                        <p class="related-author">نویسنده نمونه</p>
                    </div>
                </div>
                
                <div class="related-book-card fade-in-up">
                    <div class="related-cover">
                        <div class="related-cover-placeholder">
                            <i class="fas fa-book"></i>
                        </div>
                    </div>
                    <div class="related-info">
                        <h3 class="related-book-title">کتاب مرتبط ۳</h3>
                        <p class="related-author">نویسنده نمونه</p>
                    </div>
                </div>
                
                <div class="related-book-card fade-in-up">
                    <div class="related-cover">
                        <div class="related-cover-placeholder">
                            <i class="fas fa-book"></i>
                        </div>
                    </div>
                    <div class="related-info">
                        <h3 class="related-book-title">کتاب مرتبط ۴</h3>
                        <p class="related-author">نویسنده نمونه</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script>
        // Intersection Observer for scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);
        
        // Observe all fade-in-up elements
        document.querySelectorAll('.fade-in-up').forEach(element => {
            observer.observe(element);
        });
        
        // 3D Book hover effect enhancement
        const bookWrapper = document.querySelector('.book-wrapper');
        if (bookWrapper) {
            bookWrapper.addEventListener('mousemove', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                const rotateX = (y - centerY) / 10;
                const rotateY = (centerX - x) / 10;
                
                this.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
            });
            
            bookWrapper.addEventListener('mouseleave', function() {
                this.style.transform = 'rotateX(0) rotateY(0)';
            });
        }
        
        // Share functionality
        document.querySelector('.btn-secondary').addEventListener('click', function() {
            if (navigator.share) {
                navigator.share({
                    title: 'عنوان کتاب نمونه',
                    text: 'این کتاب را در کتابخانه آنلاین مجتمع سلمان مطالعه کنید',
                    url: window.location.href
                }).catch(console.error);
            } else {
                // Fallback for browsers without Web Share API
                const url = window.location.href;
                const text = encodeURIComponent('این کتاب را در کتابخانه آنلاین مجتمع سلمان مطالعه کنید');
                const shareUrl = `https://t.me/share/url?url=${encodeURIComponent(url)}&text=${text}`;
                window.open(shareUrl, '_blank');
            }
        });
        
        // Add click effects to interactive elements
        document.querySelectorAll('.related-book-card, .contributor-card, .category-tag').forEach(element => {
            element.addEventListener('click', function() {
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });
        
        // Smooth scroll for internal links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>