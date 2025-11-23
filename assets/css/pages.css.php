<style>
/* ========================================
   PAGE SPECIFIC CSS - Salman Educational Complex
   استایل‌های اختصاصی هر صفحه
   ======================================== */

/* ==========================================================================
   TABLE OF CONTENTS
   ==========================================================================
   1.  Home PAGE
   2.  ABOUT PAGE
   3.  BLOG PAGE
   4.  Post PAGE
   5.  Library PAGES
   6.  Library Books PAGES
   7.  Library Book Detail PAGES
   8.  Library Authors PAGES
   9.  Library Author Detail PAGES
   10. Staff PAGE
   11. FAQ PAGE
   12. CONTACT PAGE
   13. FACILITIES PAGE
   14. EDUCATIONAL LEVELS PAGE
   15. EHSAN SOD PAGE
   16. Privacy Policy PAGE
   17. 404 ERROR PAGE
   18. Terms and Conditions for Registration PAGE
   19. REGISTRATION PAGE
      - Core Components
      - Progress System
      - Form Elements
      - File Upload
      - Transportation
      - Success/Error Pages
      - Responsive
 ========================================================================== */

 /* ==========================================================================
   1. Home PAGE
========================================================================== */



/* ==========================================================================
   2. ABOUT PAGE
========================================================================== */
 
    /* About Content */
    .about-section {
        padding: 100px 0;
        position: relative;
        overflow: hidden;
    }

    .about-section:nth-child(even) {
        background-color: var(--bg-light);
    }

    /* Section Divider */
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

    /* Video Container */
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
        margin-left: 5px;
    }

    .play-button:hover {
        transform: scale(1.1);
        background-color: var(--primary-dark);
    }

    .video-playing .video-overlay {
        opacity: 0;
        visibility: hidden;
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

    /* About Content Elements */
    .about-content {
        margin-bottom: 20px;
    }

    .about-content__text {
        margin-bottom: 30px;
    }

    .about-content__text p {
        margin-bottom: 18px;
        line-height: 1.8;
        text-align: justify;
        font-size: 16px;
    }

    .about-content__text p:last-child {
        margin-bottom: 0;
    }

    /* About Heading */
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

    .about-heading__title {
        font-size: 32px;
        font-weight: 800;
        color: #333;
        text-align: center;
        margin: 0 auto 30px;
        line-height: 1.3;
        max-width: 800px;
        hyphens: auto;
        -webkit-hyphens: auto;
        -ms-hyphens: auto;
    }

    [dir="rtl"] .about-heading__tagline,
    [dir="rtl"] .about-heading__title {
        text-align: center;
        letter-spacing: 0;
    }

    [dir="rtl"] .about-heading__title {
        font-family: 'Vazir', sans-serif;
    }

    /* About Highlights */
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

    [dir="rtl"] .about-highlight {
        text-align: right;
    }

    [dir="rtl"] .about-highlight i {
        margin-right: 0;
        margin-left: 12px;
    }

    [dir="rtl"] .about-highlight:hover {
        transform: translateX(-10px);
    }

    /* Campus Stats */
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

    /* Graduate Stats */
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

    /* Features Section */
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

    [dir="rtl"] .feature-item__title {
        font-family: 'Vazir', sans-serif;
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

    [dir="rtl"] .feature-item__text {
        font-family: 'Vazir', sans-serif;
    }

    /* Stats Section */
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

    [dir="rtl"] .stats-item__text {
        font-family: 'Vazir', sans-serif;
    }

    /* Counter Value */
    .counter-value {
        display: inline-block;
        position: relative;
    }

    /* Team Section */
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
        text-align: center;
        height: 100%;
    }

    .team-item:hover {
        transform: translateY(-15px);
        box-shadow: var(--card-shadow-hover);
    }

    .team-item__image {
        position: relative;
        overflow: hidden;
        height: 280px;
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

    [dir="rtl"] .team-item__title {
        font-family: 'Vazir', sans-serif;
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

    [dir="rtl"] .team-item__designation {
        font-family: 'Vazir', sans-serif;
    }

    /* CTA Section */
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

    [dir="rtl"] .cta-heading {
        font-family: 'Vazir', sans-serif;
    }

    .cta-subheading {
        font-size: 18px;
        margin-bottom: 0;
        opacity: 0.9;
    }

    [dir="rtl"] .cta-subheading {
        font-family: 'Vazir', sans-serif;
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

/* ==========================================================================
   3. BLOG PAGE
========================================================================== */

    /* Blog Header */
    .blog-header__bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .blog-header__shape {
        position: absolute;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.1);
    }

    .blog-header__shape-1 {
        width: 300px;
        height: 300px;
        top: -100px;
        right: -100px;
    }

    .blog-header__shape-2 {
        width: 200px;
        height: 200px;
        bottom: -50px;
        left: -50px;
    }

    .blog-header__shape-3 {
        width: 150px;
        height: 150px;
        top: 50%;
        left: 30%;
        transform: translateY(-50%);
    }

    .blog-header__content {
        position: relative;
        z-index: 10;
    }

    .blog-header__title {
        font-size: 42px;
        font-weight: 800;
        margin-bottom: 15px;
        color: var(--white);
    }

    [dir="rtl"] .blog-header__title {
        font-family: 'Vazir', sans-serif;
    }

    .blog-header__breadcrumb {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-size: 16px;
    }

    .blog-header__breadcrumb a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: color var(--animation-duration) ease;
    }

    .blog-header__breadcrumb a:hover {
        color: var(--white);
    }

    .blog-header__breadcrumb i {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.6);
    }

    .blog-header__breadcrumb span {
        color: var(--white);
    }

    /* Blog Section */
    .blog-section {
        padding: 0 0 80px;
    }

    /* Featured Post */
    .featured-post {
        background-color: var(--white);
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--card-shadow);
        margin-bottom: 40px;
        transition: transform var(--animation-duration) ease, box-shadow var(--animation-duration) ease;
    }

    .featured-post:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
    }

    .featured-post__image {
        position: relative;
        height: 400px;
        overflow: hidden;
    }

    .featured-post__image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform var(--animation-duration) ease;
    }

    .featured-post:hover .featured-post__image img {
        transform: scale(1.05);
    }

    .featured-post__link {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    .featured-post__date {
        position: absolute;
        top: 20px;
        right: 20px;
        background-color: var(--primary-color);
        color: var(--white);
        padding: 10px 15px;
        border-radius: 8px;
        text-align: center;
        font-size: 14px;
        font-weight: 500;
        z-index: 2;
    }

    [dir="rtl"] .featured-post__date {
        right: auto;
        left: 20px;
    }

    .featured-post__date span {
        display: block;
        font-size: 22px;
        font-weight: 700;
        line-height: 1.2;
    }

    .featured-post__content {
        padding: 35px 30px 30px;
    }

    .featured-post__category {
        margin-bottom: 15px;
    }

    .featured-post__category a {
        display: inline-block;
        background-color: rgba(67, 97, 238, 0.1);
        color: var(--primary-color);
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 14px;
        text-decoration: none;
        transition: all var(--animation-duration) ease;
    }

    .featured-post__category a:hover {
        background-color: var(--primary-color);
        color: var(--white);
    }

    .featured-post__title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 15px;
        line-height: 1.4;
    }

    [dir="rtl"] .featured-post__title {
        font-family: 'Vazir', sans-serif;
    }

    .featured-post__title a {
        color: var(--text-color);
        text-decoration: none;
        transition: color var(--animation-duration) ease;
    }

    .featured-post__title a:hover {
        color: var(--primary-color);
    }

    .featured-post__text {
        color: var(--text-light);
        margin-bottom: 20px;
        line-height: 1.6;
    }

    [dir="rtl"] .featured-post__text {
        font-family: 'Vazir', sans-serif;
    }

    .featured-post__more {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary-color);
        font-weight: 600;
        text-decoration: none;
        transition: all var(--animation-duration) ease;
    }

    .featured-post__more:hover {
        color: var(--secondary-color);
        gap: 12px;
    }

    /* Blog Grid */
    .blog-grid {
        margin-bottom: 50px;
    }

    /* Blog Card */
    .blog-card {
        background-color: #ffffff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        height: 100%;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 30px;
    }

    .blog-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
    }

    .blog-card__image {
        position: relative;
        height: 220px;
        overflow: hidden;
    }

    .blog-card__image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .blog-card:hover .blog-card__image img {
        transform: scale(1.05);
    }

    .blog-card__link {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    .blog-card__date {
        position: absolute;
        top: 15px;
        right: 15px;
        background-color: #4361ee;
        color: #ffffff;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        z-index: 2;
    }

    [dir="rtl"] .blog-card__date {
        right: auto;
        left: 15px;
    }

    .blog-card__content {
        padding: 25px 20px;
    }

    .blog-card__category {
        margin-bottom: 10px;
    }

    .blog-card__category a {
        color: var(--primary-color);
        text-decoration: none;
        font-size: 13px;
        transition: color var(--animation-duration) ease;
    }

    .blog-card__category a:hover {
        color: var(--secondary-color);
    }

    .blog-card__title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 12px;
        line-height: 1.4;
    }

    [dir="rtl"] .blog-card__title {
        font-family: 'Vazir', sans-serif;
    }

    .blog-card__title a {
        color: var(--text-color);
        text-decoration: none;
        transition: color var(--animation-duration) ease;
    }

    .blog-card__title a:hover {
        color: var(--primary-color);
    }

    .blog-card__text {
        color: var(--text-light);
        font-size: 14px;
        margin-bottom: 15px;
        line-height: 1.6;
    }

    [dir="rtl"] .blog-card__text {
        font-family: 'Vazir', sans-serif;
    }

    .blog-card__more {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: var(--primary-color);
        font-weight: 500;
        font-size: 14px;
        text-decoration: none;
        transition: all var(--animation-duration) ease;
    }

    .blog-card__more:hover {
        color: var(--secondary-color);
        gap: 10px;
    }

    /* Pagination */
    .blog-pagination {
        display: flex;
        justify-content: center;
        margin-top: 40px;
        gap: 10px;
        flex-wrap: wrap;
    }

    .blog-pagination__page,
    .blog-pagination__arrow {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background-color: var(--white);
        color: var(--text-color);
        text-decoration: none;
        transition: all var(--animation-duration) ease;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .blog-pagination__page:hover,
    .blog-pagination__arrow:hover {
        background-color: rgba(67, 97, 238, 0.1);
        color: var(--primary-color);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .blog-pagination__page.active {
        background-color: var(--primary-color);
        color: var(--white);
    }

    /* No Posts Message */
    .no-posts {
        background-color: var(--white);
        border-radius: var(--border-radius);
        padding: 50px 30px;
        text-align: center;
        box-shadow: var(--card-shadow);
    }

    .no-posts__icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color: rgba(67, 97, 238, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        color: var(--primary-color);
        margin: 0 auto 25px;
    }

    .no-posts__title {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 15px;
    }

    [dir="rtl"] .no-posts__title {
        font-family: 'Vazir', sans-serif;
    }

    .no-posts__text {
        color: var(--text-light);
        margin-bottom: 25px;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

    [dir="rtl"] .no-posts__text {
        font-family: 'Vazir', sans-serif;
    }

    .no-posts__button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: var(--primary-color);
        color: var(--white);
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: all var(--animation-duration) ease;
    }

    .no-posts__button:hover {
        background-color: var(--secondary-color);
        transform: translateY(-3px);
        box-shadow: 0 8px 15px rgba(67, 97, 238, 0.2);
    }

    /* Blog Sidebar */
    .blog-sidebar {
        position: sticky;
        top: 30px;
    }

    .blog-sidebar__widget {
        background-color: var(--white);
        border-radius: var(--border-radius);
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: var(--card-shadow);
    }

    .blog-sidebar__title {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 20px;
        position: relative;
        padding-bottom: 10px;
    }

    [dir="rtl"] .blog-sidebar__title {
        font-family: 'Vazir', sans-serif;
    }

    .blog-sidebar__title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 2px;
        background-color: var(--primary-color);
    }

    [dir="rtl"] .blog-sidebar__title::after {
        left: auto;
        right: 0;
    }

    /* Search Widget */
    .blog-sidebar__search-form {
        position: relative;
    }

    .blog-sidebar__search-form input {
        width: 100%;
        padding: 12px 45px 12px 15px;
        border: 1px solid #eee;
        border-radius: 8px;
        font-size: 14px;
        transition: all var(--animation-duration) ease;
    }

    [dir="rtl"] .blog-sidebar__search-form input {
        padding: 12px 15px 12px 45px;
    }

    .blog-sidebar__search-form input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }

    .blog-sidebar__search-form button {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--text-light);
        cursor: pointer;
        transition: color var(--animation-duration) ease;
    }

    [dir="rtl"] .blog-sidebar__search-form button {
        right: auto;
        left: 15px;
    }

    .blog-sidebar__search-form button:hover {
        color: var(--primary-color);
    }

    /* Latest Posts Widget */
    .blog-sidebar__post-list {
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .blog-sidebar__post-item {
        display: flex;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
    }

    .blog-sidebar__post-item:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .blog-sidebar__post-image {
        width: 80px;
        height: 80px;
        border-radius: 10px;
        overflow: hidden;
        margin-right: 15px;
        flex-shrink: 0;
    }

    [dir="rtl"] .blog-sidebar__post-image {
        margin-right: 0;
        margin-left: 15px;
    }

    .blog-sidebar__post-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform var(--animation-duration) ease;
    }

    .blog-sidebar__post-item:hover .blog-sidebar__post-image img {
        transform: scale(1.05);
    }

    .blog-sidebar__post-content {
        flex: 1;
    }

    .blog-sidebar__post-title {
        font-size: 15px;
        font-weight: 600;
        line-height: 1.4;
        margin: 0 0 8px;
    }

    [dir="rtl"] .blog-sidebar__post-title {
        font-family: 'Vazir', sans-serif;
    }

    .blog-sidebar__post-title a {
        color: var(--text-color);
        text-decoration: none;
        transition: color var(--animation-duration) ease;
    }

    .blog-sidebar__post-title a:hover {
        color: var(--primary-color);
    }

    .blog-sidebar__post-date {
        font-size: 13px;
        color: var(--text-light);
    }

    /* Categories Widget */
    .blog-sidebar__categories-list {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .blog-sidebar__category {
        display: inline-flex;
        align-items: center;
        justify-content: space-between;
        padding: 8px 15px;
        background-color: rgba(67, 97, 238, 0.1);
        color: var(--primary-color);
        border-radius: 8px;
        font-size: 14px;
        text-decoration: none;
        transition: all var(--animation-duration) ease;
    }

    [dir="rtl"] .blog-sidebar__category {
        font-family: 'Vazir', sans-serif;
    }

    .blog-sidebar__category span {
        display: inline-block;
        padding: 2px 8px;
        background-color: rgba(67, 97, 238, 0.2);
        border-radius: 10px;
        font-size: 12px;
        margin-left: 8px;
    }

    [dir="rtl"] .blog-sidebar__category span {
        margin-left: 0;
        margin-right: 8px;
    }

    .blog-sidebar__category:hover,
    .blog-sidebar__category.active {
        background-color: var(--primary-color);
        color: var(--white);
    }

    .blog-sidebar__category:hover span,
    .blog-sidebar__category.active span {
        background-color: rgba(255, 255, 255, 0.3);
    }

    /* Popular Articles Widget */
    .blog-sidebar__popular-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .blog-sidebar__popular-item {
        background-color: rgba(67, 97, 238, 0.05);
        border-radius: 10px;
        padding: 15px;
        transition: all var(--animation-duration) ease;
    }

    .blog-sidebar__popular-item:hover {
        background-color: rgba(67, 97, 238, 0.1);
        transform: translateY(-5px);
    }

    .blog-sidebar__popular-category {
        display: inline-block;
        padding: 4px 10px;
        background-color: var(--primary-color);
        color: var(--white);
        border-radius: 20px;
        font-size: 12px;
        margin-bottom: 10px;
    }

    .blog-sidebar__popular-title {
        font-size: 16px;
        font-weight: 600;
        margin: 0 0 10px;
        line-height: 1.4;
    }

    [dir="rtl"] .blog-sidebar__popular-title {
        font-family: 'Vazir', sans-serif;
    }

    .blog-sidebar__popular-title a {
        color: var(--text-color);
        text-decoration: none;
        transition: color var(--animation-duration) ease;
    }

    .blog-sidebar__popular-title a:hover {
        color: var(--primary-color);
    }

    .blog-sidebar__popular-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .blog-sidebar__popular-meta span {
        font-size: 13px;
        color: var(--text-light);
    }

    .blog-sidebar__popular-arrow {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        background-color: var(--white);
        color: var(--primary-color);
        border-radius: 50%;
        transition: all var(--animation-duration) ease;
    }

    .blog-sidebar__popular-arrow:hover {
        background-color: var(--primary-color);
        color: var(--white);
        transform: translateX(3px);
    }

    [dir="rtl"] .blog-sidebar__popular-arrow:hover {
        transform: translateX(-3px);
    }

/* ==========================================================================
   4. Post PAGE
========================================================================== */
/* Post Hero Section */
.post-hero {
    position: relative;
    height: 600px;
    overflow: hidden;
    display: flex;
    align-items: center;
}

.post-hero__bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    z-index: 1;
}

.post-hero__overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        to bottom,
        rgba(15, 23, 42, 0.6) 0%,
        rgba(30, 41, 59, 0.85) 100%
    );
    z-index: 2;
}

.post-hero__content {
    position: relative;
    z-index: 10;
    max-width: 900px;
    margin: 0 auto;
    text-align: center;
    color: var(--white);
    padding: 0 20px;
}

.post-hero__category {
    margin-bottom: 20px;
}

.post-hero__category a {
    display: inline-block;
    background-color: var(--accent-color);
    color: var(--white);
    padding: 8px 20px;
    border-radius: 30px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all var(--transition) ease;
}

.post-hero__category a:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(105, 65, 198, 0.3);
}

.post-hero__title {
    font-family: 'Vazir';
    color: #eee;
    font-size: 40px;
    font-weight: 800;
    margin-bottom: 25px;
    line-height: 1.3;
}

.post-hero__meta {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin-bottom: 30px;
}

.post-hero__date,
.post-hero__views,
.post-hero__reading-time {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 16px;
    opacity: 0.9;
}

.post-hero__breadcrumbs {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    opacity: 0.8;
}

.post-hero__breadcrumbs a {
    color: var(--white);
    text-decoration: none;
    transition: opacity var(--transition) ease;
}

.post-hero__breadcrumbs a:hover {
    opacity: 1;
}

.post-hero__breadcrumbs i {
    font-size: 12px;
}

/* Post Content */
.post-content {
    padding: 80px 0;
}

.post-content__main {
    background-color: var(--white);
    border-radius: var(--border-radius);
    padding: 40px;
    box-shadow: var(--card-shadow);
    margin-bottom: 50px;
}

.post-content__text {
    font-size: 18px;
    line-height: 1.8;
    color: var(--text-color);
    margin-bottom: 30px;
    text-align: justify;
    text-justify: inter-word;
    hyphens: auto;
    word-spacing: normal;
}

.post-content__text p {
    margin-bottom: 1.5rem;
}

.post-content__text h2,
.post-content__text h3,
.post-content__text h4 {
    margin-top: 40px;
    margin-bottom: 20px;
    font-weight: 700;
}

.post-content__text h2 {
    font-size: 28px;
}

.post-content__text h3 {
    font-size: 24px;
}

.post-content__text h4 {
    font-size: 20px;
}

.post-content__text blockquote {
    border-left: 4px solid var(--primary-color);
    padding: 20px 30px;
    margin: 30px 0;
    background-color: var(--bg-light);
    font-style: italic;
    font-size: 20px;
    line-height: 1.6;
}

[dir="rtl"] .post-content__text blockquote {
    border-left: none;
    border-right: 4px solid var(--primary-color);
}

.post-content__text ul,
.post-content__text ol {
    margin: 20px 0 20px 40px;
}

[dir="rtl"] .post-content__text ul,
[dir="rtl"] .post-content__text ol {
    margin: 20px 40px 20px 0;
}

.post-content__text li {
    margin-bottom: 10px;
}

/* Post Images Styles */
.post-image-full {
    margin: 2rem 0;
    overflow: hidden;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    position: relative;
}

.post-image-full img {
    width: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.post-image-full:hover img {
    transform: scale(1.02);
}

.post-images-row {
    margin: 2rem 0;
}

.post-image-item {
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    margin-bottom: 1rem;
    height: 100%;
    position: relative;
}

.post-image-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.post-image-item:hover img {
    transform: scale(1.05);
}

/* Post Images Slider */
.post-images-slider {
    margin: 2rem 0;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    height: 450px;
    position: relative;
    background: #f8f8f8;
}

.post-images-slider .swiper-slide {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f8f8;
}

.post-images-slider img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

.post-images-slider .swiper-button-next,
.post-images-slider .swiper-button-prev {
    color: #fff;
    background: rgba(0, 0, 0, 0.3);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    transition: background 0.3s ease;
}

.post-images-slider .swiper-button-next:hover,
.post-images-slider .swiper-button-prev:hover {
    background: rgba(0, 0, 0, 0.5);
}

.post-images-slider .swiper-button-next:after,
.post-images-slider .swiper-button-prev:after {
    font-size: 18px;
}

.post-images-slider .swiper-pagination-bullet {
    background: #fff;
    opacity: 0.7;
}

.post-images-slider .swiper-pagination-bullet-active {
    background: #fff;
    opacity: 1;
}

/* Post Gallery */
.post-content__gallery {
    margin: 40px 0;
}

.post-content__gallery-item {
    margin-bottom: 30px;
    border-radius: var(--border-radius);
    overflow: hidden;
    position: relative;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
}

.post-content__gallery-img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    display: block;
    transition: transform var(--transition) ease;
}

.post-content__gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(67, 97, 238, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all var(--transition) ease;
}

.post-content__gallery-overlay i {
    color: var(--white);
    font-size: 24px;
}

.post-content__gallery-item:hover .post-content__gallery-img {
    transform: scale(1.05);
}

.post-content__gallery-item:hover .post-content__gallery-overlay {
    opacity: 1;
}

/* Post Footer */
.post-content__footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 40px;
    padding-top: 30px;
    border-top: 1px solid #eee;
}

.post-content__categories,
.post-content__share {
    display: flex;
    align-items: center;
    gap: 15px;
}

.post-content__categories-title,
.post-content__share-title {
    font-weight: 600;
    color: var(--text-color);
}

.post-content__category-link {
    display: inline-block;
    background-color: var(--bg-light);
    color: var(--primary-color);
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 14px;
    text-decoration: none;
    transition: all var(--transition) ease;
}

.post-content__category-link:hover {
    background-color: var(--primary-color);
    color: var(--white);
}

.post-content__share-buttons {
    display: flex;
    gap: 10px;
}

.post-content__share-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    color: var(--white);
    text-decoration: none;
    transition: all var(--transition) ease;
}

.post-content__share-link:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.post-content__share-link.facebook {
    background-color: #3b5998;
}

.post-content__share-link.twitter {
    background-color: #1da1f2;
}

.post-content__share-link.whatsapp {
    background-color: #25d366;
}

.post-content__share-link.telegram {
    background-color: #0088cc;
}

/* Post Related Section */
.post-related {
    background-color: var(--white);
    border-radius: var(--border-radius);
    padding: 40px;
    box-shadow: var(--card-shadow);
}

.post-related__title {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 30px;
    position: relative;
    padding-bottom: 15px;
}

.post-related__title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 3px;
    background-color: var(--primary-color);
}

[dir="rtl"] .post-related__title::after {
    left: auto;
    right: 0;
}

.post-related__item {
    margin-bottom: 30px;
    background-color: var(--bg-light);
    border-radius: 10px;
    overflow: hidden;
    transition: all var(--transition) ease;
}

.post-related__item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
}

.post-related__image {
    position: relative;
    height: 180px;
    overflow: hidden;
}

.post-related__image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform var(--transition) ease;
}

.post-related__item:hover .post-related__image img {
    transform: scale(1.05);
}

.post-related__link {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.post-related__content {
    padding: 20px;
}

.post-related__date {
    color: var(--text-light);
    font-size: 14px;
    margin-bottom: 10px;
}

.post-related__item-title {
    font-size: 16px;
    font-weight: 600;
    line-height: 1.4;
    margin: 0;
}

.post-related__item-title a {
    color: var(--text-color);
    text-decoration: none;
    transition: color var(--transition) ease;
}

.post-related__item-title a:hover {
    color: var(--primary-color);
}

/* Post Sidebar */
.post-sidebar {
    position: sticky;
    top: 30px;
}

.post-sidebar__widget {
    background-color: var(--white);
    border-radius: var(--border-radius);
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: var(--card-shadow);
}

.post-sidebar__title {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 25px;
    position: relative;
    padding-bottom: 10px;
}

.post-sidebar__title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 2px;
    background-color: var(--primary-color);
}

[dir="rtl"] .post-sidebar__title::after {
    left: auto;
    right: 0;
}

/* Author Widget */
.post-sidebar__author {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.post-sidebar__author-image {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    overflow: hidden;
    margin-bottom: 20px;
    border: 5px solid var(--bg-light);
}

.post-sidebar__author-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.post-sidebar__author-name {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 10px;
}

.post-sidebar__author-bio {
    color: var(--text-light);
    font-size: 14px;
    line-height: 1.6;
}

/* Search Widget */
.post-sidebar__search-form {
    position: relative;
}

.post-sidebar__search-form input {
    width: 100%;
    height: 50px;
    background-color: var(--bg-light);
    border: none;
    border-radius: 25px;
    padding: 0 60px 0 25px;
    font-size: 15px;
    transition: all var(--transition) ease;
}

[dir="rtl"] .post-sidebar__search-form input {
    padding: 0 25px 0 60px;
}

.post-sidebar__search-form input:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
}

.post-sidebar__search-form button {
    position: absolute;
    right: 5px;
    top: 5px;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: var(--primary-color);
    border: none;
    color: var(--white);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all var(--transition) ease;
}

[dir="rtl"] .post-sidebar__search-form button {
    right: auto;
    left: 5px;
}

.post-sidebar__search-form button:hover {
    background-color: var(--secondary-color);
}

/* Latest Posts Widget */
.post-sidebar__latest-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.post-sidebar__latest-item {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #eee;
}

.post-sidebar__latest-item:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}

.post-sidebar__latest-image {
    width: 80px;
    height: 80px;
    border-radius: 10px;
    overflow: hidden;
    flex-shrink: 0;
}

.post-sidebar__latest-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform var(--transition) ease;
}

.post-sidebar__latest-item:hover .post-sidebar__latest-image img {
    transform: scale(1.05);
}

.post-sidebar__latest-content {
    flex: 1;
}

.post-sidebar__latest-title {
    font-size: 16px;
    font-weight: 600;
    line-height: 1.4;
    margin: 0 0 8px;
}

.post-sidebar__latest-title a {
    color: var(--text-color);
    text-decoration: none;
    transition: color var(--transition) ease;
}

.post-sidebar__latest-title a:hover {
    color: var(--primary-color);
}

.post-sidebar__latest-date {
    color: var(--text-light);
    font-size: 14px;
}

/* Categories Widget */
.post-sidebar__categories-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.post-sidebar__category-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 15px;
    background-color: var(--bg-light);
    border-radius: 8px;
    color: var(--text-color);
    text-decoration: none;
    transition: all var(--transition) ease;
}

.post-sidebar__category-item span {
    display: inline-block;
    background-color: var(--white);
    color: var(--text-light);
    width: 24px;
    height: 24px;
    border-radius: 50%;
    text-align: center;
    line-height: 24px;
    font-size: 12px;
    transition: all var(--transition) ease;
}

.post-sidebar__category-item:hover,
.post-sidebar__category-item.active {
    background-color: var(--primary-color);
    color: var(--white);
}

.post-sidebar__category-item:hover span,
.post-sidebar__category-item.active span {
    background-color: rgba(255, 255, 255, 0.2);
    color: var(--white);
}

/* Back Button Styles */
.post-sidebar__back-btn .btn {
    padding: 15px 25px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 16px;
}

/* Post Audio Player */
.post-audio-container {
    margin: 2rem 0;
}

.lightweight-audio-player {
    background: linear-gradient(135deg, #2b3044 0%, #1e222e 100%);
    border-radius: 12px;
    overflow: hidden;
    color: #fff;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
}

.audio-player-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.audio-title {
    font-weight: 500;
    flex-grow: 1;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-right: 1rem;
}

.audio-download-btn {
    color: #fff;
    font-size: 1rem;
    padding: 5px;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.3s ease;
    background: rgba(255, 255, 255, 0.1);
}

.audio-download-btn:hover {
    background: rgba(255, 255, 255, 0.2);
    color: #fff;
}

.audio-player-body {
    padding: 1rem 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.audio-play-controls {
    flex-shrink: 0;
}

.audio-play-button {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #007bff;
    color: #fff;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 16px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
}

.audio-play-button:hover {
    background: #0069d9;
    transform: scale(1.05);
}

.audio-play-button.playing .fa-play {
    display: none;
}

.audio-play-button:not(.playing) .fa-pause {
    display: none;
}

.audio-progress-container {
    flex-grow: 1;
    margin: 0 0.5rem;
}

.audio-progress-bar-container {
    position: relative;
    height: 6px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 3px;
    cursor: pointer;
    margin-bottom: 6px;
}

.audio-progress-bar {
    width: 100%;
    height: 100%;
    position: relative;
}

.audio-progress-bar-fill {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 0;
    background: #007bff;
    border-radius: 3px;
    transition: width 0.1s linear;
}

.audio-progress-handle {
    width: 14px;
    height: 14px;
    border-radius: 50%;
    background: #fff;
    position: absolute;
    top: 50%;
    transform: translate(-50%, -50%);
    left: 0;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    display: none;
}

.audio-progress-bar-container:hover .audio-progress-handle,
.audio-progress-bar-container.active .audio-progress-handle {
    display: block;
}

.audio-time-display {
    display: flex;
    justify-content: space-between;
    font-size: 0.75rem;
    opacity: 0.8;
}

.audio-volume-controls {
    display: flex;
    align-items: center;
    position: relative;
}

.audio-volume-button {
    background: none;
    border: none;
    color: #fff;
    cursor: pointer;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    margin-right: 8px;
}

.audio-volume-slider-container {
    width: 60px;
}

.audio-volume-slider {
    -webkit-appearance: none;
    appearance: none;
    width: 100%;
    height: 4px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 2px;
    outline: none;
}

.audio-volume-slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 10px;
    height: 10px;
    background: #fff;
    border-radius: 50%;
    cursor: pointer;
}

.audio-volume-slider::-moz-range-thumb {
    width: 10px;
    height: 10px;
    background: #fff;
    border-radius: 50%;
    cursor: pointer;
    border: none;
}

/* Post Video Player */
.custom-player-wrapper {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    background: #000;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.18);
    margin: 2.5rem 0;
}

.plyr {
    --plyr-color-main: #007bff;
    --plyr-video-control-color: #fff;
    --plyr-video-control-background-hover: rgba(0, 123, 255, 0.5);
    --plyr-audio-control-background-hover: rgba(0, 123, 255, 0.5);
    --plyr-range-fill-background: #007bff;
    --plyr-range-thumb-background: #fff;
    --plyr-video-progress-buffered-background: rgba(255, 255, 255, 0.3);
    --plyr-audio-progress-buffered-background: rgba(255, 255, 255, 0.3);
    --plyr-range-thumb-height: 14px;
    --plyr-range-track-height: 6px;
    --plyr-control-icon-size: 18px;
    --plyr-control-spacing: 10px;
    --plyr-control-radius: 6px;
    height: 100%;
    width: 100%;
}

.plyr__control--overlaid {
    background: rgba(0, 123, 255, 0.8);
    padding: 20px;
}

.plyr__control--overlaid:hover {
    background: rgba(0, 123, 255, 1);
}

/* MagnificPopup customizations */
.mfp-bg {
    background: #000;
    opacity: 0.9;
}

.mfp-figure:after {
    box-shadow: none;
    background: transparent;
}

.mfp-figure img.mfp-img {
    padding: 0;
}

.mfp-counter {
    right: 10px;
    color: #fff;
}

.mfp-title {
    color: #fff;
    text-align: center;
    padding: 10px 0;
}

.mfp-fade.mfp-bg {
    opacity: 0;
    transition: all 0.3s ease-out;
}

.mfp-fade.mfp-bg.mfp-ready {
    opacity: 0.9;
}

.mfp-fade.mfp-bg.mfp-removing {
    opacity: 0;
}

.mfp-fade.mfp-wrap .mfp-content {
    opacity: 0;
    transition: all 0.3s ease-out;
}

.mfp-fade.mfp-wrap.mfp-ready .mfp-content {
    opacity: 1;
}

.mfp-fade.mfp-wrap.mfp-removing .mfp-content {
    opacity: 0;
}

.mfp-with-zoom .mfp-container,
.mfp-with-zoom.mfp-bg {
    opacity: 0;
    backface-visibility: hidden;
    transition: all 0.3s ease-out;
}

.mfp-with-zoom.mfp-ready .mfp-container {
    opacity: 1;
}

.mfp-with-zoom.mfp-ready.mfp-bg {
    opacity: 0.9;
}

.mfp-with-zoom.mfp-removing .mfp-container,
.mfp-with-zoom.mfp-removing.mfp-bg {
    opacity: 0;
}

/* Post Responsive */
@media (max-width: 1199px) {
    .post-hero {
        height: 500px;
    }
    
    .post-hero__title {
        font-size: 42px;
    }
    
    .post-content__text {
        font-size: 17px;
    }
}

@media (max-width: 991px) {
    .post-hero {
        height: 450px;
    }
    
    .post-hero__title {
        font-size: 36px;
    }
    
    .post-content {
        padding: 60px 0;
    }
    
    .post-content__main, 
    .post-related {
        padding: 30px;
    }
    
    .post-sidebar {
        position: static;
        margin-top: 50px;
    }
    
    .post-content__footer {
        flex-direction: column;
        gap: 20px;
        align-items: flex-start;
    }
    
    .post-content__gallery-img {
        height: 250px;
    }
    
    .post-images-slider {
        height: 400px;
    }
}

@media (max-width: 767px) {
    .post-hero {
        height: 400px;
    }
    
    .post-hero__title {
        font-size: 28px;
        margin-bottom: 15px;
    }
    
    .post-hero__meta {
        flex-wrap: wrap;
        gap: 15px;
        justify-content: center;
    }
    
    .post-content {
        padding: 40px 0;
    }
    
    .post-content__main,
    .post-related {
        padding: 25px;
    }
    
    .post-content__text {
        font-size: 16px;
    }
    
    .post-content__text h2 {
        font-size: 24px;
    }
    
    .post-content__text h3 {
        font-size: 20px;
    }
    
    .post-content__text h4 {
        font-size: 18px;
    }
    
    .post-content__text blockquote {
        padding: 15px 20px;
        font-size: 18px;
    }
    
    .post-related__item {
        margin-bottom: 20px;
    }
    
    .post-related__image {
        height: 150px;
    }
    
    .post-images-slider {
        height: 350px;
    }
    
    .audio-player-body {
        flex-wrap: wrap;
    }
    
    .audio-progress-container {
        order: 3;
        width: 100%;
        margin-top: 10px;
    }
    
    .audio-volume-controls {
        margin-left: auto;
    }
}

@media (max-width: 575px) {
    .post-hero {
        height: 350px;
    }
    
    .post-hero__title {
        font-size: 24px;
    }
    
    .post-hero__meta {
        flex-direction: column;
        gap: 10px;
    }
    
    .post-hero__breadcrumbs {
        flex-wrap: wrap;
    }
    
    .post-content__main,
    .post-related,
    .post-sidebar__widget {
        padding: 20px;
    }
    
    .post-content__gallery-img {
        height: 200px;
    }
    
    .post-related__title {
        font-size: 20px;
    }
    
    .post-related__item-title {
        font-size: 15px;
    }
    
    .post-images-slider {
        height: 280px;
    }
    
    .audio-player-body {
        padding: 1rem;
    }
    
    .audio-volume-slider-container {
        width: 40px;
    }
}


/* ==========================================================================
   5. Library PAGES
========================================================================== */


/* ==========================================================================
   6. Library Books PAGES
========================================================================== */


/* ==========================================================================
   7. Library Book Detail PAGES
========================================================================== */


/* ==========================================================================
   8. Library Authors PAGES
========================================================================== */

/* Main Section Container */
.hero-galaxy {
    position: relative;
    /* New, sophisticated midnight blue background */
    background-color: #0d122b; 
    background-image: linear-gradient(180deg, #111845 0%, #0d122b 100%);
    overflow: hidden;
    /* Increased top padding as requested for more space */
    padding-top: 180px;
    padding-bottom: 120px;
}

/* ===== DYNAMIC STARFIELD BACKGROUND ===== */
/* This creates a 3D parallax effect with 3 layers of stars moving at different speeds */
@keyframes move-stars {
    from { transform: translateY(0); }
    to { transform: translateY(-2000px); }
}

.stars {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    width: 100%;
    height: 100%;
    display: block;
    z-index: 0;
}
.stars-1 {
    background: transparent url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="2000" height="2000"><circle cx="100" cy="100" r="1.2" fill="rgba(255,255,255,0.4)"/><circle cx="500" cy="300" r="1" fill="rgba(255,255,255,0.4)"/><circle cx="900" cy="200" r="0.8" fill="rgba(255,255,255,0.4)"/><circle cx="1300" cy="400" r="1.1" fill="rgba(255,255,255,0.4)"/><circle cx="1700" cy="150" r="0.9" fill="rgba(255,255,255,0.4)"/></svg>') repeat;
    background-size: 2000px 2000px;
    animation: move-stars 200s linear infinite;
}
.stars-2 {
    background: transparent url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="2000" height="2000"><circle cx="250" cy="600" r="0.8" fill="rgba(255,255,255,0.3)"/><circle cx="750" cy="800" r="0.6" fill="rgba(255,255,255,0.3)"/><circle cx="1150" cy="900" r="0.9" fill="rgba(255,255,255,0.3)"/><circle cx="1550" cy="700" r="0.7" fill="rgba(255,255,255,0.3)"/></svg>') repeat;
    background-size: 2000px 2000px;
    animation: move-stars 150s linear infinite;
}
.stars-3 {
    background: transparent url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="2000" height="2000"><circle cx="400" cy="1200" r="0.5" fill="rgba(255,255,255,0.2)"/><circle cx="900" cy="1400" r="0.4" fill="rgba(255,255,255,0.2)"/><circle cx="1400" cy="1100" r="0.6" fill="rgba(255,255,255,0.2)"/></svg>') repeat;
    background-size: 2000px 2000px;
    animation: move-stars 100s linear infinite;
}

/* ===== Content Styling ===== */
.hero-content-container-v8 {
    position: relative;
    z-index: 1;
    text-align: center;
    animation: fadeIn 1.5s var(--ease-out-quint) both;
}

/* Breadcrumbs Styling */
.galaxy-breadcrumb {
    margin-bottom: var(--space-6);
    opacity: 0.7;
}
.galaxy-breadcrumb .breadcrumb-list {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: var(--space-4);
    list-style: none;
    padding: 0;
    margin: 0;
    color: var(--gray-400);
}
.galaxy-breadcrumb a {
    color: var(--gray-400);
    text-decoration: none;
    transition: color var(--duration-fast);
}
.galaxy-breadcrumb a:hover {
    color: var(--white);
}
.galaxy-breadcrumb li[aria-current="page"] span {
    color: var(--white);
    font-weight: var(--font-weight-medium);
}


/* Main Title Styling */
.galaxy-title {
    font-size: clamp(3.5rem, 7vw, 6rem);
    font-weight: var(--font-weight-extrabold);
    color: var(--white);
    letter-spacing: -0.03em;
    line-height: 1.1;
    margin: 0;
    /* Subtle glow effect for a premium look */
    text-shadow: 0 0 25px rgba(255, 255, 255, 0.1), 0 0 10px rgba(255, 255, 255, 0.15);
}

/* Subtitle Styling */
.galaxy-subtitle {
    font-size: var(--font-size-xl);
    color: var(--gray-300);
    margin: var(--space-5) 0 0 0;
    letter-spacing: 0.02em;
}
.galaxy-subtitle strong {
    color: var(--white);
    font-weight: var(--font-weight-bold);
    margin: 0 6px;
}

/* Reduced motion for accessibility */
@media (prefers-reduced-motion: reduce) {
    .stars {
        animation: none;
    }
}

.glass-card {
    background: var(--glass-bg);
    border: var(--glass-border);
    border-radius: 1.5rem;
    box-shadow: 0 6px 32px -8px rgba(0,0,0,0.16);
    backdrop-filter: blur(8px);
    padding: 2rem 1.25rem;
    margin-bottom: 2rem;
    transition: box-shadow 0.18s, border-color 0.18s;
}

.filters-section-modern {
    padding: 2.5rem 0 0.5rem 0;
}
.filters-modern-grid {
    display: grid;
    grid-template-columns: 2.2fr 1fr;
    gap: 2rem;
}
@media (max-width: 900px) {
    .filters-modern-grid {
        grid-template-columns: 1fr;
        gap: 1.25rem;
    }
}
.filters-modern-row {
    display: flex;
    gap: 1.2rem;
    flex-wrap: wrap;
    align-items: flex-end;
}
.filters-form-group {
    flex: 1 1 180px;
    display: flex;
    flex-direction: column;
    gap: 0.3rem;
}
.search-group { min-width: 180px; }
.sort-group { min-width: 140px; }
.submit-group { min-width: 110px; flex: none; }
.form-label-modern {
    font-size: 0.96rem;
    color: var(--gray-500);
    margin-bottom: 0.3rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.4em;
}
.modern-input {
    border: none;
    border-radius: 0.8rem;
    background: rgba(255,255,255,0.06);
    color: var(--gray-900);
    font-size: 1.03rem;
    padding: 0.7rem 1.1rem;
    outline: none;
    box-shadow: 0 2px 10px -5px rgba(108,99,255,0.07);
    transition: background 0.18s;
}
[data-theme="dark"] .modern-input {
    background: rgba(31,45,79,0.25);
    color: var(--gray-300);
}
.modern-input:focus {
    background: rgba(108,99,255,0.12);
}
.input-help {
    font-size: 0.83em;
    color: var(--gray-400);
    margin-top: 0.2em;
}

.btn-modern {
    font-size: 1.01rem;
    border-radius: 1.5rem;
    padding: 0.65em 1.5em;
    font-weight: 600;
    border: none;
    transition: background 0.18s, color 0.18s, box-shadow 0.18s;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.5em;
}
.btn-primary-glass {
    background: linear-gradient(90deg, var(--primary), var(--secondary));
    color: #fff;
    box-shadow: 0 2px 10px -4px var(--primary);
}
.btn-primary-glass:hover, .btn-primary-glass:focus {
    background: linear-gradient(90deg, var(--secondary), var(--primary));
    color: #fff;
}
.btn-outline-glass {
    background: transparent;
    color: var(--primary);
    border: 1.5px solid var(--primary);
}
.btn-outline-glass:hover, .btn-outline-glass:focus {
    background: var(--primary);
    color: #fff;
}

.filters-nationality-card .filter-title-modern {
    font-size: 1.15rem;
    color: var(--primary);
    margin-bottom: 1.1rem;
    font-weight: 700;
    letter-spacing: 0.01em;
    display: flex;
    gap: 0.5em;
    align-items: center;
}
.nationality-filter-modern {
    display: flex;
    flex-direction: column;
    gap: 0.3em;
    margin-bottom: 0.2em;
}
.nationality-modern-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 1.2em;
    padding: 0.55em 1em 0.55em 1.2em;
    font-size: 1.01em;
    color: var(--gray-600);
    background: transparent;
    border: none;
    transition: background 0.15s, color 0.15s;
    font-weight: 500;
    cursor: pointer;
    text-decoration: none;
    outline: none;
}
.nationality-modern-item.active,
.nationality-modern-item:hover,
.nationality-modern-item:focus {
    background: var(--primary);
    color: #fff;
}
.nationality-count {
    font-size: 0.95em;
    background: rgba(108,99,255,0.13);
    border-radius: 1em;
    padding: 0.15em 0.7em;
    font-weight: 700;
    margin-left: 0.7em;
    color: var(--primary);
}

.nationality-more-modern summary {
    cursor: pointer;
    font-weight: 600;
    color: var(--primary);
    display: flex;
    align-items: center;
    gap: 0.5em;
    outline: none;
}
.nationality-more-content-modern {
    margin-top: 0.5em;
    display: flex;
    flex-direction: column;
    gap: 0.15em;
}

.active-filters-modern {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1em 1.5em;
    margin-top: 1.2em;
    border-radius: 1.1em;
    background: var(--glass-bg);
    border: var(--glass-border);
    gap: 1em;
}
.active-filters__summary-modern {
    display: flex;
    align-items: center;
    gap: 0.6em;
    flex-wrap: wrap;
}
.filter-tag-modern {
    background: rgba(108,99,255,0.17);
    color: var(--primary);
    border-radius: 1em;
    padding: 0.2em 0.8em;
    margin-right: 0.5em;
    font-size: 0.97em;
    position: relative;
    display: inline-flex;
    align-items: center;
    gap: 0.4em;
}
.filter-tag__remove-modern {
    color: var(--primary);
    margin-left: 0.4em;
    font-size: 1.07em;
    cursor: pointer;
    border: none;
    background: none;
    outline: none;
}
.filter-tag__remove-modern:hover,
.filter-tag__remove-modern:focus {
    color: #fff;
    background: var(--primary);
    border-radius: 50%;
}

.authors-section-modern {
    padding: 2.5rem 0 1.5rem 0;
}
.results-summary-modern {
    margin-bottom: 1.7rem;
    text-align: left;
}
.results-count-modern {
    font-size: 1.13em;
    color: var(--primary);
    font-weight: 700;
}
.page-info-modern {
    color: var(--gray-400);
    font-size: 0.98em;
    margin-left: 1.1em;
}

.authors-grid-modern {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 2.2rem 1.4rem;
}

.author-card-modern {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    min-height: 325px;
    min-width: 0;
    position: relative;
    overflow: hidden;
    padding: 1.4em 1em 1.4em 1em;
    background: var(--glass-bg);
    border: var(--glass-border);
    border-radius: 1.25em;
    box-shadow: 0 8px 32px -16px var(--primary);
    transition: box-shadow 0.18s, transform 0.12s;
}
.author-card-modern:hover,
.author-card-modern:focus-within {
    box-shadow: 0 16px 48px -12px var(--primary);
    transform: translateY(-4px) scale(1.018);
}

.author-card__link-modern {
    color: inherit;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1em;
    width: 100%;
    height: 100%;
}
.author-card__image-modern {
    width: 92px;
    height: 92px;
    border-radius: 50%;
    overflow: hidden;
    background: rgba(108,99,255,0.09);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    margin-bottom: 0.7em;
    box-shadow: 0 2px 12px -5px var(--primary);
}
.author-card__image-modern img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}
.author-placeholder-modern {
    font-size: 2.8em;
    color: var(--gray-400);
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.author-badge-modern.featured {
    position: absolute;
    top: 4px; right: 4px;
    background: var(--accent);
    color: #fff;
    border-radius: 50%;
    padding: 0.3em 0.36em;
    font-size: 1.1em;
    box-shadow: 0 2px 9px -3px var(--accent);
}

.author-card__content-modern {
    width: 100%;
}
.author-card__name-modern {
    font-size: 1.22em;
    color: var(--gray-900);
    font-weight: 700;
    margin-bottom: 0.1em;
}
.author-card__nationality-modern {
    font-size: 0.98em;
    color: var(--gray-500);
    margin-bottom: 0.2em;
    display: flex;
    align-items: center;
    gap: 0.4em;
    justify-content: center;
}
.author-card__books-modern {
    font-size: 0.98em;
    color: var(--gray-600);
    display: flex;
    align-items: center;
    gap: 0.3em;
    justify-content: center;
}
.book-count-modern {
    font-weight: 700;
    color: var(--primary);
}
.no-books-label-modern {
    color: var(--gray-400);
    font-style: italic;
}
.author-card__cta-modern {
    margin-top: 0.85em;
    font-size: 1.01em;
    color: var(--primary);
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.5em;
    border-radius: 1em;
    padding: 0.3em 1em;
    background: rgba(108,99,255,0.11);
    transition: background 0.18s, color 0.18s;
}
.author-card__cta-modern:hover,
.author-card__cta-modern:focus {
    background: var(--primary);
    color: #fff;
}

.no-results-modern {
    margin: 2.5em 0;
    text-align: center;
}
.no-results__card-modern {
    padding: 2.5em 1.8em;
    border-radius: 1.5em;
    display: inline-block;
    min-width: 320px;
}
.no-results__icon-modern {
    font-size: 3.3em;
    color: var(--gray-300);
    margin-bottom: 0.7em;
}
.no-results__title-modern {
    font-size: 1.4em;
    color: var(--primary);
    margin-bottom: 0.5em;
}
.no-results__text-modern {
    color: var(--gray-500);
    font-size: 1.04em;
    margin-bottom: 1.2em;
}
.no-results__suggestions-modern h3 {
    font-size: 1.08em;
    font-weight: 600;
    color: var(--gray-400);
    margin-bottom: 0.4em;
}
.no-results__suggestions-modern ul {
    list-style: disc;
    margin: 0 0 1em 1.3em;
    padding: 0;
    color: var(--gray-400);
    font-size: 0.96em;
}
.no-results__actions-modern {
    display: flex;
    justify-content: center;
    gap: 0.7em;
    margin-top: 1.2em;
}

@media (max-width: 700px) {
    .filters-modern-row { flex-direction: column; gap: 0.6em; }
    .authors-grid-modern { grid-template-columns: 1fr 1fr; gap: 1.4rem 0.8rem; }
}
@media (max-width: 450px) {
    .authors-grid-modern { grid-template-columns: 1fr; }
}

.pagination-modern-wrapper {
    margin-top: 2.3em;
    display: flex;
    flex-direction: column;
    gap: 0.6em;
    align-items: flex-start;
}


/* ==========================================================================
   9. Library Author Detail PAGES
========================================================================== */
/* Main Hero Section Container */
.hero-section-v2 {
    position: relative;
    padding: var(--space-16) 0;
    background: linear-gradient(135deg, var(--primary-50) 0%, var(--gray-50) 100%);
    overflow: hidden;
}

[dir="rtl"] .hero-section-v2 {
    text-align: right;
}

/* Background Animated Shapes */
.hero-bg-shape {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    opacity: 0.5;
    pointer-events: none;
}
.hero-bg-shape.shape-1 {
    width: 400px;
    height: 400px;
    background-color: var(--primary-200);
    top: -100px;
    left: -100px;
    animation: float 15s ease-in-out infinite alternate;
}
.hero-bg-shape.shape-2 {
    width: 350px;
    height: 350px;
    background-color: var(--sky-blue);
    bottom: -150px;
    right: -100px;
    opacity: 0.3;
    animation: float 20s ease-in-out infinite alternate-reverse;
}

/* Hero Particles (re-styling from original) */
.hero-section-v2 .particle {
    background-color: var(--primary-400);
    animation: float 25s infinite linear;
    width: 3px;
    height: 3px;
    opacity: 0.7;
}

/* Breadcrumb Styling */
.hero-breadcrumb {
    margin-bottom: var(--space-8);
}
.hero-breadcrumb .breadcrumb-list {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    padding: 0;
    margin: 0;
    list-style: none;
    font-size: var(--font-size-sm);
}
.hero-breadcrumb a {
    color: var(--text-muted);
    transition: var(--transition-fast);
}
.hero-breadcrumb a:hover {
    color: var(--primary);
    text-decoration: none;
}
.hero-breadcrumb li[aria-current="page"] {
    color: var(--text-dark);
    font-weight: var(--font-weight-medium);
}
.hero-breadcrumb i {
    font-size: 0.7em;
    color: var(--gray-400);
}


/* Main Hero Layout (Grid) */
.hero-layout {
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: var(--space-12);
    align-items: center;
}

/* Image Column */
.hero-image-col {
    display: flex;
    justify-content: center;
    align-items: center;
}

.hero-image-wrapper {
    position: relative;
    padding: 10px;
    background: linear-gradient(135deg, rgba(255,255,255,0.8), rgba(255,255,255,0.2));
    border-radius: var(--radius-3xl);
    box-shadow: var(--shadow-xl);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    transition: var(--transition);
}
.hero-image-wrapper:hover {
    transform: scale(1.05);
    box-shadow: var(--shadow-2xl);
}
.hero-author-image, .hero-image-placeholder {
    width: 100%;
    height: auto;
    aspect-ratio: 1 / 1;
    object-fit: cover;
    border-radius: var(--radius-2xl);
}
.hero-image-placeholder {
    background: var(--gray-200);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 100px;
    color: var(--gray-400);
}


/* Content Column */
.hero-content-col {
    position: relative;
    z-index: 2;
}
.hero-title {
    font-size: var(--font-size-5xl);
    font-weight: var(--font-weight-extrabold);
    color: var(--text-dark);
    margin: 0 0 var(--space-3) 0;
    line-height: var(--line-height-tight);
}

.hero-subtitle {
    font-size: var(--font-size-lg);
    color: var(--text-muted);
    margin: 0 0 var(--space-6) 0;
    font-weight: var(--font-weight-regular);
}

.hero-meta-data {
    display: flex;
    flex-wrap: wrap;
    gap: var(--space-6);
    padding-top: var(--space-5);
    border-top: 1px solid var(--gray-200);
}

.meta-item {
    display: flex;
    align-items: center;
    gap: var(--space-3);
    font-size: var(--font-size-base);
    color: var(--text-gray);
    background-color: rgba(255, 255, 255, 0.7);
    padding: var(--space-2) var(--space-4);
    border-radius: var(--radius-full);
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
}
.meta-item i {
    color: var(--primary);
}
.meta-item.featured-author {
    color: var(--primary-dark);
    font-weight: var(--font-weight-semibold);
}
.meta-item.featured-author i {
    color: var(--yellow);
}

/* ===== Responsive Adjustments for Hero ===== */
@media (max-width: 991px) {
    .hero-layout {
        grid-template-columns: 220px 1fr;
        gap: var(--space-8);
    }
    .hero-title {
        font-size: var(--font-size-4xl);
    }
}

@media (max-width: 767px) {
    .hero-section-v2 {
        padding: var(--space-12) 0;
    }
    .hero-layout {
        grid-template-columns: 1fr;
        text-align: center;
        gap: var(--space-8);
    }
    .hero-image-col {
        order: 1; /* Image first */
    }
    .hero-content-col {
        order: 2; /* Content second */
    }
    .hero-image-wrapper {
        width: 180px;
        height: 180px;
        margin: 0 auto;
    }
    .hero-title {
        font-size: var(--font-size-3xl);
    }
    .hero-subtitle {
        font-size: var(--font-size-md);
    }
    .hero-meta-data {
        justify-content: center;
        border-top: 1px solid var(--gray-200);
        margin-top: var(--space-6);
        padding-top: var(--space-6);
    }
    .hero-breadcrumb {
        justify-content: center;
    }
    .hero-breadcrumb .breadcrumb-list {
        justify-content: center;
        flex-wrap: wrap;
    }
}
/* =============================================================================
   AUTHOR DETAIL PAGE - PROFESSIONAL MAIN LAYOUT - Version 3.0
   ============================================================================= */

/* Main Page Background & Layout */
.author-page-main {
    background-color: var(--gray-100);
    padding: var(--space-12) 0;
}

.author-layout {
    display: grid;
    grid-template-columns: 280px 1fr; /* Sidebar a bit leaner */
    gap: var(--space-10); /* Increased gap for more breathing room */
    align-items: flex-start;
}

/* ===== Sticky Sidebar (Final Version) ===== */
.author-sidebar .author-sidebar__sticky-content {
    position: sticky;
    top: var(--space-8); /* Adjust if your header is taller */
    display: flex;
    flex-direction: column;
    gap: var(--space-6);
}

/* The only card left in the sidebar */
.author-sidebar .info-card {
    background-color: var(--white);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-xl);
    padding: var(--space-6);
    box-shadow: var(--shadow-elevation-low);
}
.info-card__title {
    display: flex;
    align-items: center;
    gap: var(--space-3);
    font-size: var(--font-size-lg);
    font-weight: var(--font-weight-semibold);
    color: var(--text-dark);
    padding-bottom: var(--space-4);
    margin: 0 0 var(--space-4) 0;
    border-bottom: 1px solid var(--gray-200);
}
.info-card__title i {
    color: var(--primary);
}
.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--space-3) var(--space-2);
    font-size: var(--font-size-sm);
    border-radius: var(--radius-md);
    transition: background-color var(--duration-fast);
}
.info-item:not(:last-child) {
    margin-bottom: var(--space-2);
}
.info-item:hover {
    background-color: var(--primary-50);
}
.info-label {
    color: var(--text-muted);
}
.info-value {
    color: var(--text-dark);
    font-weight: var(--font-weight-medium);
}


/* ===== Professional Main Content ===== */
.author-content-professional {
    display: flex;
    flex-direction: column;
    gap: var(--space-10);
}

/* Refined Content Card Styling */
.content-section.modern-card {
    background: var(--white);
    border: 1px solid var(--gray-100);
    border-radius: var(--radius-2xl);
    box-shadow: var(--shadow-elevation-low);
    padding: var(--space-8);
    transition: box-shadow var(--duration-normal), transform var(--duration-normal);
}
.content-section.modern-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-elevation-medium);
}

.content-section__title {
    display: flex;
    align-items: center;
    gap: var(--space-4);
    font-size: var(--font-size-2xl);
    font-weight: var(--font-weight-bold);
    color: var(--text-dark);
    margin: 0 0 var(--space-6) 0;
    padding-bottom: var(--space-4);
    border-bottom: 2px solid var(--primary-100);
}
.content-section__title i {
    color: var(--primary-light);
    font-size: 1.2em;
}

/* Biography Content */
.biography-content p {
    line-height: var(--line-height-loose);
    color: var(--text-gray);
    font-size: var(--font-size-base);
    max-width: 75ch; /* Optimal for reading */
}
.biography-content p:not(:last-child) {
    margin-bottom: var(--space-6);
}

/* Quotes Styling */
.quotes-container {
    columns: 2; /* A beautiful multi-column layout for quotes */
    column-gap: var(--space-6);
}
.quote-item {
    background: var(--gradient-soft);
    padding: var(--space-6);
    border-radius: var(--radius-lg);
    border-inline-start: 4px solid var(--primary);
    margin-bottom: var(--space-6);
    break-inside: avoid-column; /* Prevents quotes from breaking across columns */
}
.quote-text {
    font-size: var(--font-size-md);
    font-style: italic;
    color: var(--text-dark);
    margin: 0 0 var(--space-2) 0;
}
.quote-author {
    display: block;
    text-align: end;
    font-style: normal;
    font-weight: var(--font-weight-medium);
    color: var(--primary-dark);
}

/* Professional Books Section */
.books-role-section:not(:last-child) {
    margin-bottom: var(--space-8);
}
.role-title {
    display: inline-flex;
    align-items: center;
    gap: var(--space-3);
    font-size: var(--font-size-xl);
    color: var(--text-dark);
    margin-bottom: var(--space-6);
    background-color: var(--primary-50);
    padding: var(--space-2) var(--space-4);
    border-radius: var(--radius-full);
}
.role-title .role-count {
    font-size: var(--font-size-sm);
    color: var(--primary);
    font-weight: bold;
    background-color: white;
    padding: 2px 8px;
    border-radius: var(--radius-full);
}

.professional-books-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: var(--space-8);
}

/* Interactive Book Card */
.book-card-pro {
    position: relative;
}
.book-card-pro__link {
    text-decoration: none;
    color: inherit;
    display: block;
}
.book-card-pro__cover {
    position: relative;
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-xl);
    transition: transform var(--duration-normal) var(--ease-out-back), box-shadow var(--duration-normal);
}
.book-card-pro__cover img, .book-cover-placeholder {
    display: block;
    width: 100%;
    aspect-ratio: 2 / 3;
    object-fit: cover;
}
.book-card-pro__link:hover .book-card-pro__cover {
    transform: translateY(-10px) scale(1.05);
    box-shadow: var(--shadow-2xl);
}
.book-card-pro__overlay {
    position: absolute;
    inset: 0;
    background: rgba(var(--primary-rgb), 0.7);
    color: white;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: var(--space-2);
    opacity: 0;
    transition: opacity var(--duration-normal);
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
}
.book-card-pro__link:hover .book-card-pro__overlay {
    opacity: 1;
}
.book-card-pro__overlay i {
    font-size: 24px;
}
.book-card-pro__overlay span {
    font-size: var(--font-size-xs);
    font-weight: var(--font-weight-semibold);
}
.book-card-pro__body {
    padding-top: var(--space-4);
    text-align: center;
}
.book-card-pro__title {
    font-size: var(--font-size-base);
    font-weight: var(--font-weight-semibold);
    color: var(--text-dark);
    margin: 0;
}


/* ===== Responsive Adjustments for Final Layout ===== */
@media (max-width: 991px) {
    .author-layout {
        grid-template-columns: 240px 1fr;
    }
}
@media (max-width: 767px) {
    .author-layout {
        grid-template-columns: 1fr; /* Single column on mobile */
    }
    .author-sidebar .author-sidebar__sticky-content {
        position: static;
    }
    .quotes-container {
        columns: 1;
    }
}

/* ==========================================================================
   10. Staff PAGE
========================================================================== */


/* ==========================================================================
   11. FAQ PAGE
========================================================================== */

   .faq-header {
        background: linear-gradient(135deg, #0F172A 0%, #1E293B 60%, #334155 100%);
        position: relative;
        overflow: hidden;
        color: var(--white);
        text-align: center;
        padding: 180px 0 140px;
    }

    /* FAQ Search */
    .faq-search {
        position: relative;
        max-width: 600px;
        margin: 0 auto;
        z-index: 10;
    }

    .faq-search__input {
        width: 100%;
        height: 60px;
        background: var(--white);
        border: none;
        border-radius: 30px;
        padding: 0 60px 0 30px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        font-size: 16px;
        transition: all var(--animation-duration) ease;
    }

    .faq-search__input:focus {
        outline: none;
        box-shadow: 0 15px 30px rgba(79, 70, 229, 0.15);
    }

    .faq-search__btn {
        position: absolute;
        right: 10px;
        top: 10px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #6941C6 0%, #4E36B1 100%);
        border: none;
        color: var(--white);
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all var(--animation-duration) ease;
    }

    .faq-search__btn:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(79, 70, 229, 0.2);
    }

    [dir="rtl"] .faq-search__input {
        padding: 0 30px 0 60px;
    }

    [dir="rtl"] .faq-search__btn {
        right: auto;
        left: 10px;
    }

    /* Main FAQ Content */
    .faq-content {
        padding: 60px 0;
        position: relative;
        margin-top: -50px;
    }

    /* FAQ Sidebar */
    .faq-sidebar {
        background: linear-gradient(135deg, #7F56D9 0%, #6941C6 50%, #4E36B1 100%);
        border-radius: var(--border-radius);
        padding: 40px;
        height: 100%;
        color: var(--white);
        position: relative;
        overflow: hidden;
        box-shadow: var(--card-shadow);
    }

    .faq-sidebar__title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 20px;
        color: #ffffff;
    }

    [dir="rtl"] .faq-sidebar__title {
        font-family: 'Vazir', sans-serif;
    }

    .faq-sidebar__text {
        font-size: 16px;
        margin-bottom: 30px;
        opacity: 0.9;
    }

    [dir="rtl"] .faq-sidebar__text {
        font-family: 'Vazir', sans-serif;
    }

    .faq-sidebar__btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 25px;
        background-color: rgba(255, 255, 255, 0.2);
        color: var(--white);
        font-weight: 600;
        border-radius: 30px;
        text-decoration: none;
        transition: all var(--animation-duration) ease;
        border: 1px solid rgba(255, 255, 255, 0.3);
        margin-bottom: 20px;
    }

    [dir="rtl"] .faq-sidebar__btn {
        font-family: 'Vazir', sans-serif;
    }

    .faq-sidebar__btn:hover {
        background-color: var(--white);
        color: var(--primary-color);
        transform: translateY(-3px);
    }

    .faq-sidebar__divider {
        border-top: 1px solid rgba(255, 255, 255, 0.2);
        margin: 30px 0;
    }

    /* Shape decorations for sidebar */
    .faq-sidebar__shape {
        position: absolute;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.1);
    }

    .faq-sidebar__shape:nth-child(1) {
        top: -50px;
        right: -50px;
        width: 150px;
        height: 150px;
    }

    .faq-sidebar__shape:nth-child(2) {
        bottom: -30px;
        left: -30px;
        width: 100px;
        height: 100px;
    }

    /* Modern Tabs */
    .faq-main {
        background-color: var(--white);
        border-radius: var(--border-radius);
        padding: 30px;
        box-shadow: var(--card-shadow);
    }

    .faq-nav {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 30px;
    }

    .faq-nav__item {
        padding: 10px 20px;
        background-color: var(--bg-light);
        border-radius: 30px;
        color: var(--text-color);
        font-weight: 600;
        cursor: pointer;
        transition: all var(--animation-duration) ease;
        display: flex;
        align-items: center;
        gap: 8px;
        border: none;
    }

    [dir="rtl"] .faq-nav__item {
        font-family: 'Vazir', sans-serif;
    }

    .faq-nav__item:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .faq-nav__item.active {
        background: linear-gradient(135deg, #6941C6 0%, #4E36B1 100%);
        color: var(--white);
    }

    .faq-nav__icon {
        width: 24px;
        height: 24px;
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        transition: all var(--animation-duration) ease;
    }

    .faq-nav__item:not(.active) .faq-nav__icon {
        background-color: rgba(79, 70, 229, 0.1);
        color: var(--primary-color);
    }

    /* Category Section */
    .faq-category {
        display: none;
        animation: fadeIn 0.5s ease forwards;
    }

    .faq-category.active {
        display: block;
    }

    .faq-category__header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 30px;
    }

    .faq-category__icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        color: var(--white);
    }

    .faq-category__title {
        font-size: 22px;
        font-weight: 700;
        color: var(--text-color);
        margin: 0;
    }

    [dir="rtl"] .faq-category__title {
        font-family: 'Vazir', sans-serif;
    }

    /* Modern FAQ Items */
    .faq-items {
        margin-bottom: 40px;
    }

    .faq-item {
        border-radius: 10px;
        background-color: var(--white);
        margin-bottom: 15px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.03);
        transition: all var(--animation-duration) ease;
        border: 1px solid #eaeaea;
    }

    .faq-item.active {
        box-shadow: 0 10px 20px rgba(79, 70, 229, 0.08);
        border-color: rgba(79, 70, 229, 0.2);
    }

    .faq-question {
        padding: 20px 25px;
        position: relative;
        cursor: pointer;
        font-weight: 600;
        font-size: 16px;
        color: var(--text-color);
        background: none;
        border: none;
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        text-align: left;
        transition: all var(--animation-duration) ease;
    }

    [dir="rtl"] .faq-question {
        text-align: right;
        font-family: 'Vazir', sans-serif;
    }

    .faq-item.active .faq-question {
        color: var(--primary-color);
    }

    .faq-question:focus {
        outline: none;
    }

    .faq-icon {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background-color: rgba(79, 70, 229, 0.1);
        color: var(--primary-color);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        transition: all var(--animation-duration) ease;
        transform-origin: center;
        margin-left: 15px;
        flex-shrink: 0;
    }

    [dir="rtl"] .faq-icon {
        margin-left: 0;
        margin-right: 15px;
    }

    .faq-item.active .faq-icon {
        background-color: var(--primary-color);
        color: var(--white);
        transform: rotate(180deg);
    }

    .faq-answer {
        padding: 0 25px;
        height: 0;
        opacity: 0;
        overflow: hidden;
        transition: all var(--animation-duration) ease;
    }

    .faq-item.active .faq-answer {
        padding-bottom: 20px;
        height: auto;
        opacity: 1;
    }

    .faq-answer p {
        margin: 0;
        color: var(--text-light);
        line-height: 1.7;
    }

    [dir="rtl"] .faq-answer p {
        font-family: 'Vazir', sans-serif;
    }

    /* No Results */
    .no-results {
        display: none;
        text-align: center;
        padding: 40px 0;
    }

    .no-results__icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-color: rgba(79, 70, 229, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: var(--primary-color);
        margin: 0 auto 20px;
    }

    .no-results__title {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-color);
        margin-bottom: 10px;
    }

    [dir="rtl"] .no-results__title {
        font-family: 'Vazir', sans-serif;
    }

    .no-results__text {
        color: var(--text-light);
        margin-bottom: 25px;
    }

    [dir="rtl"] .no-results__text {
        font-family: 'Vazir', sans-serif;
    }

/* ==========================================================================
   12. CONTACT PAGE
========================================================================== */

    /* Contact Shapes */
    .contact-section {
        position: relative;
        padding: 100px 0;
        overflow: hidden;
        background-color: var(--light-color);
    }

    .contact-shapes {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        overflow: hidden;
        z-index: 0;
    }

    .contact-shape {
        position: absolute;
        opacity: 0.06;
        z-index: -1;
    }

    .contact-shape-1 {
        top: 10%;
        left: 5%;
        width: 350px;
        height: 350px;
        border-radius: 350px;
        background: var(--primary-light);
        animation: moveUpDown 15s ease-in-out infinite alternate;
    }

    .contact-shape-2 {
        top: 50%;
        right: -100px;
        width: 500px;
        height: 500px;
        border-radius: 50%;
        background: var(--primary-dark);
        animation: moveUpDown 20s ease-in-out 5s infinite alternate;
    }

    .contact-shape-3 {
        bottom: 10%;
        left: 15%;
        width: 200px;
        height: 200px;
        background: var(--accent-color);
        border-radius: 40px;
        transform: rotate(30deg);
        animation: rotateShape 30s linear infinite;
    }

    .contact-container {
        position: relative;
        z-index: 1;
    }

    /* Contact Card */
    .contact-card {
        background: white;
        border-radius: var(--border-radius-lg);
        overflow: hidden;
        box-shadow: var(--box-shadow-strong);
        transition: var(--transition);
        height: 100%;
        transform: translateY(0);
        position: relative;
        z-index: 2;
    }

    .contact-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        opacity: 0;
        transition: opacity 0.5s ease;
        z-index: -1;
        border-radius: var(--border-radius-lg);
    }

    .contact-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--box-shadow-strong), 0 20px 40px rgba(105, 65, 198, 0.2);
    }

    .contact-card:hover::before {
        opacity: 0.05;
    }

    .contact-form-card {
        background: white;
        border-radius: var(--border-radius-lg);
        overflow: hidden;
        box-shadow: var(--box-shadow-strong);
        transition: var(--transition);
        position: relative;
        z-index: 2;
    }

    .contact-form-card:hover {
        box-shadow: var(--box-shadow-strong), 0 25px 50px rgba(105, 65, 198, 0.15);
    }

    .contact-shape-accent {
        position: absolute;
        border-radius: 50%;
        z-index: 1;
    }

    .contact-shape-accent-1 {
        top: -50px;
        right: -50px;
        width: 150px;
        height: 150px;
        background: linear-gradient(135deg, rgba(126, 90, 247, 0.12), rgba(63, 55, 201, 0.06));
    }

    .contact-shape-accent-2 {
        bottom: -60px;
        left: -60px;
        width: 200px;
        height: 200px;
        background: linear-gradient(135deg, rgba(126, 90, 247, 0.08), rgba(63, 55, 201, 0.04));
    }

    .contact-card-header {
        position: relative;
        overflow: hidden;
        padding: 40px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
    }

    .contact-card-particle {
        position: absolute;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.1);
    }

    .particle-1 {
        width: 50px;
        height: 50px;
        top: 20px;
        right: 20px;
    }

    .particle-2 {
        width: 100px;
        height: 100px;
        bottom: -30px;
        left: -30px;
    }

    .particle-3 {
        width: 30px;
        height: 30px;
        top: 60%;
        right: 40%;
    }

    .contact-card-body {
        padding: 40px;
        position: relative;
    }

    .contact-card-title {
        font-size: 28px;
        margin-bottom: 20px;
        font-weight: 700;
        color: white;
        position: relative;
        z-index: 2;
    }

    [dir="rtl"] .contact-card-title {
        font-family: 'Vazir', sans-serif;
    }

    .contact-card-subtitle {
        font-size: 18px;
        opacity: 0.9;
        margin-bottom: 0;
        position: relative;
        z-index: 2;
        line-height: 1.6;
    }

    [dir="rtl"] .contact-card-subtitle {
        font-family: 'Vazir', sans-serif;
    }

    /* Contact Info Items */
    .contact-info-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 25px;
        transition: var(--transition);
        position: relative;
    }

    .contact-info-item::after {
        content: '';
        position: absolute;
        bottom: -12px;
        left: 0;
        width: 0;
        height: 1px;
        background: linear-gradient(to right, var(--primary-light), transparent);
        transition: var(--transition);
    }

    .contact-info-item:hover::after {
        width: 100%;
    }

    .contact-info-item:hover {
        transform: translateX(5px);
    }

    [dir="rtl"] .contact-info-item::after {
        left: auto;
        right: 0;
        background: linear-gradient(to left, var(--primary-light), transparent);
    }

    [dir="rtl"] .contact-info-item:hover {
        transform: translateX(-5px);
    }

    .contact-info-icon {
        width: 50px;
        height: 50px;
        border-radius: 15px;
        background: linear-gradient(135deg, rgba(158, 119, 237, 0.15), rgba(105, 65, 198, 0.05));
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
        margin-right: 20px;
        flex-shrink: 0;
        font-size: 20px;
        transition: var(--transition);
        position: relative;
        z-index: 1;
        overflow: hidden;
    }

    .contact-info-icon::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: -1;
    }

    .contact-info-item:hover .contact-info-icon {
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(105, 65, 198, 0.2);
    }

    .contact-info-item:hover .contact-info-icon::before {
        opacity: 1;
    }

    [dir="rtl"] .contact-info-icon {
        margin-right: 0;
        margin-left: 20px;
    }

    .contact-info-content {
        flex: 1;
    }

    .contact-info-label {
        font-weight: 700;
        color: var(--text-dark);
        font-size: 18px;
        margin-bottom: 6px;
    }

    [dir="rtl"] .contact-info-label {
        font-family: 'Vazir', sans-serif;
    }

    .contact-info-value {
        color: var(--text-muted);
        font-size: 16px;
        line-height: 1.6;
    }

    [dir="rtl"] .contact-info-value {
        font-family: 'Vazir', sans-serif;
    }

    .contact-info-value a {
        color: var(--primary-color);
        transition: var(--transition);
        position: relative;
        display: inline-block;
    }

    .contact-info-value a::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        transition: var(--transition);
    }

    .contact-info-value a:hover {
        color: var(--secondary-color);
    }

    .contact-info-value a:hover::after {
        width: 100%;
    }

    /* Social Links */
    .social-links {
        display: flex;
        gap: 15px;
        margin-top: 30px;
    }

    .social-link {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
        font-size: 18px;
        transition: var(--transition);
        position: relative;
        z-index: 1;
        overflow: hidden;
        box-shadow: var(--box-shadow-light);
    }

    .social-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        opacity: 0;
        transition: var(--transition);
        z-index: -1;
    }

    .social-link:hover {
        color: white;
        transform: translateY(-5px) scale(1.1);
        box-shadow: 0 15px 25px rgba(105, 65, 198, 0.2);
    }

    .social-link:hover::before {
        opacity: 1;
    }

    /* Contact Form */
    .contact-form {
        padding: 40px;
        position: relative;
    }

    .form-title {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 10px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        color: transparent;
        letter-spacing: -0.5px;
    }

    [dir="rtl"] .form-title {
        font-family: 'Vazir', sans-serif;
    }

    .form-subtitle {
        font-size: 18px;
        color: var(--text-muted);
        margin-bottom: 35px;
        line-height: 1.6;
    }

    [dir="rtl"] .form-subtitle {
        font-family: 'Vazir', sans-serif;
    }

    .input-group {
        margin-bottom: 25px;
        position: relative;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--text-dark);
        font-size: 16px;
        transition: var(--transition);
        padding-left: 10px;
    }

    [dir="rtl"] .form-label {
        padding-left: 0;
        padding-right: 10px;
        font-family: 'Vazir', sans-serif;
    }

    .form-control {
        width: 100%;
        border-radius: 25px !important;
        padding: 16px 24px !important;
        font-size: 16px !important;
        border: 2px solid #E2E8F0 !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        background-color: white !important;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.02);
    }

    [dir="rtl"] .form-control {
        font-family: 'Vazir', sans-serif;
    }

    textarea.form-control {
        border-radius: 25px !important;
        min-height: 150px !important;
        resize: vertical;
    }

    .form-control:focus {
        outline: none !important;
        border-color: var(--primary-color) !important;
        box-shadow: 0 5px 15px rgba(111, 76, 255, 0.1) !important;
        transform: translateY(-2px);
        background: linear-gradient(white, white) padding-box,
                    linear-gradient(135deg, rgba(126, 90, 247, 0.2), rgba(63, 55, 201, 0.1)) border-box;
        border: 2px solid transparent !important;
    }

    .form-control::placeholder {
        color: #A0AEC0;
        transition: var(--transition);
    }

    .form-control:focus::placeholder {
        opacity: 0.7;
        transform: translateX(5px);
    }

    .form-error {
        color: #EF4444;
        font-size: 14px;
        margin-top: 5px;
        display: none;
        padding-left: 24px;
    }

    [dir="rtl"] .form-error {
        padding-left: 0;
        padding-right: 24px;
    }

    .form-control.is-invalid {
        border-color: #EF4444 !important;
    }

    .form-control.is-invalid + .form-error {
        display: block;
    }

    .submit-button {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border: none;
        border-radius: 50px !important;
        padding: 16px 36px !important;
        font-size: 18px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        position: relative;
        overflow: hidden;
        z-index: 1;
        box-shadow: 0 8px 15px rgba(111, 76, 255, 0.2) !important;
    }

    [dir="rtl"] .submit-button {
        font-family: 'Vazir', sans-serif;
    }

    .submit-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
        opacity: 0;
        transition: var(--transition);
        z-index: -1;
    }

    .submit-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(79, 70, 229, 0.3);
    }

    .submit-button:hover::before {
        opacity: 1;
    }

    .submit-button:active {
        transform: translateY(0);
    }

    .submit-button i {
        transition: transform 0.3s ease;
    }

    .submit-button:hover i {
        transform: translateX(5px);
    }

    [dir="rtl"] .submit-button:hover i {
        transform: translateX(-5px);
    }

    /* Map Section */
    .map-section {
        position: relative;
        height: 500px;
        overflow: hidden;
        border-radius: var(--border-radius-lg);
        box-shadow: var(--box-shadow-strong);
        margin-top: 100px;
        z-index: 2;
    }

    .map-gradient-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to right, rgba(15, 23, 42, 0.05), transparent);
        pointer-events: none;
        z-index: 1;
    }

    .map-info-card {
        position: absolute;
        top: 40px;
        left: 40px;
        max-width: 380px;
        background: white;
        border-radius: var(--border-radius);
        padding: 30px;
        box-shadow: var(--box-shadow-strong);
        z-index: 2;
        transition: var(--transition);
        transform: translateY(0);
    }

    [dir="rtl"] .map-info-card {
        left: auto;
        right: 40px;
    }

    .map-info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 50px rgba(15, 23, 42, 0.1);
    }

    .map-info-title {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 15px;
        color: var(--primary-color);
        letter-spacing: -0.5px;
    }

    [dir="rtl"] .map-info-title {
        font-family: 'Vazir', sans-serif;
    }

    .map-info-text {
        font-size: 16px;
        color: var(--text-muted);
        margin-bottom: 25px;
        line-height: 1.6;
    }

    [dir="rtl"] .map-info-text {
        font-family: 'Vazir', sans-serif;
    }

    .map-direction-btn {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border: none;
        border-radius: var(--border-radius);
        padding: 12px 20px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    [dir="rtl"] .map-direction-btn {
        font-family: 'Vazir', sans-serif;
    }

    .map-direction-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
        opacity: 0;
        transition: var(--transition);
        z-index: -1;
    }

    .map-direction-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(79, 70, 229, 0.2);
    }

    .map-direction-btn:hover::before {
        opacity: 1;
    }

    .map-iframe {
        width: 100%;
        height: 100%;
        border: none;
    }

    /* Contact Modal */
    .contact-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .contact-modal.show {
        opacity: 1;
        visibility: visible;
    }

    .contact-modal-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(15, 23, 42, 0.8);
        backdrop-filter: blur(5px);
    }

    .contact-modal-container {
        position: relative;
        width: 90%;
        max-width: 500px;
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
        transform: translateY(20px);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 10;
        text-align: center;
        overflow: hidden;
    }

    .contact-modal.show .contact-modal-container {
        transform: translateY(0);
    }

    .contact-modal-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(158, 119, 237, 0.2), rgba(105, 65, 198, 0.1));
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }

    .contact-modal-icon i {
        font-size: 32px;
    }

    .contact-modal-icon.success {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(16, 185, 129, 0.1));
        color: #10B981;
    }

    .contact-modal-icon.error {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.2), rgba(239, 68, 68, 0.1));
        color: #EF4444;
    }

    .contact-modal-title {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 10px;
        color: var(--text-dark);
    }

    [dir="rtl"] .contact-modal-title {
        font-family: 'Vazir', sans-serif;
    }

    .contact-modal-message {
        font-size: 16px;
        color: var(--text-muted);
        margin-bottom: 25px;
        line-height: 1.6;
    }

    [dir="rtl"] .contact-modal-message {
        font-family: 'Vazir', sans-serif;
    }

    .contact-modal-btn {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border: none;
        border-radius: 50px;
        padding: 12px 30px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-block;
    }

    [dir="rtl"] .contact-modal-btn {
        font-family: 'Vazir', sans-serif;
    }

    .contact-modal-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(105, 65, 198, 0.2);
    }

    /* Loading indicator for form */
    .form-loading {
        position: relative;
        pointer-events: none;
    }

    .form-loading::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(2px);
        border-radius: var(--border-radius-lg);
        z-index: 10;
    }

    .form-loading::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 50px;
        height: 50px;
        border: 5px solid rgba(105, 65, 198, 0.2);
        border-top: 5px solid var(--primary-color);
        border-radius: 50%;
        animation: spin 1s linear infinite;
        z-index: 11;
    }

    /* Animation Classes */
    .fade-in {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeIn 1s cubic-bezier(0.5, 0, 0.1, 1) forwards;
    }

    .fade-in-delay-1 {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeIn 1s cubic-bezier(0.5, 0, 0.1, 1) 0.2s forwards;
    }

    .fade-in-delay-2 {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeIn 1s cubic-bezier(0.5, 0, 0.1, 1) 0.4s forwards;
    }

    .scale-in {
        opacity: 0;
        transform: scale(0.8);
        animation: scaleIn 0.6s cubic-bezier(0.5, 0, 0.1, 1) forwards;
    }

    /* Numbers LTR for RTL layout */
    .numbers-ltr {
        direction: ltr;
        display: inline-block;
    }

    /* Galaxy effect for header */
    .galaxy-effect {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 600px;
        height: 600px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(126, 90, 247, 0.3) 0%, rgba(63, 55, 201, 0.1) 35%, rgba(9, 9, 45, 0) 70%);
        opacity: 0.6;
        animation: pulse 8s infinite alternate;
    }

    .shooting-star {
        position: absolute;
        width: 2px;
        height: 80px;
        background: linear-gradient(to bottom, rgba(255,255,255,0), rgba(255,255,255,0.8), rgba(255,255,255,0));
        transform: rotate(45deg);
        animation: shooting 5s linear infinite;
        opacity: 0;
    }

    /* Wave container */
    .wave-container {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        overflow: hidden;
        line-height: 0;
        z-index: 1;
    }

    .wave-container svg {
        position: relative;
        display: block;
        width: calc(100% + 1.3px);
        height: 130px;
    }

    .wave-container .shape-fill {
        fill: #F8FAFC;
    }

/* ==========================================================================
   13. FACILITIES PAGE
========================================================================== */

    /* Facilities Styles */
    .facility-section {
        padding: 100px 0;
        position: relative;
    }

    .facility-section:nth-child(even) {
        background-color: var(--bg-light);
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

    [dir="rtl"] .facility-title {
        font-family: 'Vazir', sans-serif;
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

    [dir="rtl"] .facility-description {
        font-family: 'Vazir', sans-serif;
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
        font-family: 'Vazir', sans-serif;
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

    /* Key Focus Box */
    .key-focus-box {
        background-color: rgba(105, 65, 198, 0.05);
        border-left: 4px solid var(--primary-color);
        padding: 20px;
        margin-top: 20px;
        border-radius: 0 10px 10px 0;
    }

    [dir="rtl"] .key-focus-box {
        border-left: none;
        border-right: 4px solid var(--primary-color);
        border-radius: 10px 0 0 10px;
    }

    .key-focus-box h4 {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    [dir="rtl"] .key-focus-box h4 {
        font-family: 'Vazir', sans-serif;
    }

/* ==========================================================================
   14. EDUCATIONAL LEVELS PAGE
========================================================================== */
   /* Curriculum Section */
    .curriculum-section {
        padding: 100px 0;
        position: relative;
        overflow: hidden;
    }

    .curriculum-section:nth-child(even) {
        background-color: var(--bg-light);
    }

    /* Section Labels and Titles */
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
        color: #000000;
        margin-bottom: 25px;
        line-height: 1.3;
    }

    [dir="rtl"] .section-title {
        font-family: 'Vazir', sans-serif;
    }

    .section-description {
        color: var(--text-light);
        margin-bottom: 30px;
        font-size: 16px;
    }

    [dir="rtl"] .section-description {
        font-family: 'Vazir', sans-serif;
    }

    /* Feature Items */
    .feature-title {
        color: rgb(15, 12, 95);
        font-weight: 700;
        margin-bottom: 8px;
        font-size: 20px;
        color: var(--secondary-color);
    }

    [dir="rtl"] .feature-title {
        font-family: 'Vazir', sans-serif;
    }

    .feature-text {
        color: var(--text-light);
        font-size: 15px;
        margin-bottom: 0;
    }

    [dir="rtl"] .feature-text {
        font-family: 'Vazir', sans-serif;
    }

    /* Feature Box */
    .feature-box {
        background-color: var(--white);
        padding: 25px;
        border-radius: 15px;
        margin-bottom: 20px;
        height: 100%;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border: 1px solid rgba(105, 65, 198, 0.1);
    }

    .feature-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(105, 65, 198, 0.15);
    }

    .feature-box h4 {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 12px;
        color: var(--secondary-color);
    }

    [dir="rtl"] .feature-box h4 {
        font-family: 'Vazir', sans-serif;
    }

    .feature-box p {
        font-size: 15px;
        color: var(--text-light);
        margin-bottom: 0;
    }

    [dir="rtl"] .feature-box p {
        font-family: 'Vazir', sans-serif;
    }

    /* Section Image */
    .section-image {
        width: 100%;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .section-image:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(105, 65, 198, 0.2);
    }

    .section-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.5s ease;
    }

    .section-image:hover img {
        transform: scale(1.05);
    }

    /* Key Focus Box */
    .key-focus {
        border-left: 4px solid var(--primary-color);
        padding-left: 20px;
        margin-top: 40px;
        background-color: rgba(105, 65, 198, 0.05);
        padding: 25px 25px 25px 30px;
        border-radius: 0 15px 15px 0;
    }

    [dir="rtl"] .key-focus {
        border-left: none;
        border-right: 4px solid var(--primary-color);
        padding-left: 25px;
        padding-right: 30px;
        border-radius: 15px 0 0 15px;
    }

    .key-focus h4 {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 10px;
        color: var(--secondary-color);
    }

    [dir="rtl"] .key-focus h4 {
        font-family: 'Vazir', sans-serif;
    }

    .key-focus p {
        font-size: 15px;
        color: var(--text-light);
        margin-bottom: 0;
    }

    [dir="rtl"] .key-focus p {
        font-family: 'Vazir', sans-serif;
    }

    /* Video Play Button */
    .play-button-wrapper {
        position: relative;
        margin-bottom: 40px;
    }

    .play-button-wrapper .play-button {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80px;
        height: 80px;
        background-color: var(--white);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 2;
    }

    .play-button-wrapper .play-button::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background-color: var(--primary-color);
        opacity: 0.3;
        animation: pulse 2s infinite;
        z-index: -1;
    }

    .play-button-wrapper .play-button i {
        color: var(--primary-color);
        font-size: 30px;
        margin-left: 5px;
    }

    .play-button-wrapper .play-button:hover {
        transform: translate(-50%, -50%) scale(1.1);
        background-color: var(--primary-color);
    }

    .play-button-wrapper .play-button:hover i {
        color: var(--white);
    }

    /* CTA Button */
    .btn-read-more {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(105, 65, 198, 0.3);
        margin-top: 20px;
    }

    .btn-read-more i {
        margin-left: 8px;
    }

    [dir="rtl"] .btn-read-more i {
        margin-left: 0;
        margin-right: 8px;
    }

    [dir="rtl"] .btn-read-more {
        font-family: 'Vazir', sans-serif;
    }

    .btn-read-more:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(105, 65, 198, 0.4);
        color: white;
    }

    /* Special Needs Badge */
    .special-needs-badge {
        display: inline-block;
        background-color: rgba(105, 65, 198, 0.1);
        color: var(--primary-color);
        font-weight: 600;
        padding: 5px 15px;
        border-radius: 20px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    [dir="rtl"] .special-needs-badge {
        font-family: 'Vazir', sans-serif;
    }

/* ==========================================================================
   15. EHSAN SOD PAGE
========================================================================== */

    /* Ehsan Section */
    .ehsan-section {
        padding: 100px 0;
        position: relative;
    }

    .ehsan-section:nth-child(even) {
        background-color: var(--bg-light);
    }

    /* Section Image */
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

    /* Objective Box */
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
        color: rgb(15, 12, 95);
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

    /* Check List */
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

    /* CTA Box */
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

/* ==========================================================================
   16. Privacy Policy PAGE
========================================================================== */

/* Privacy Section */
.privacy-section,
.privacy-policy-section {
    position: relative;
    z-index: 2;
    padding-top: 100px;
    overflow: visible !important;
}

/* Privacy TOC */
.privacy-toc {
    background: linear-gradient(145deg, rgba(255, 255, 255, 0.9) 0%, rgba(248, 249, 250, 0.8) 100%);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
    border-radius: 20px;
    overflow: hidden;
    transition: all 0.4s ease;
    margin-bottom: 30px;
    z-index: 10;
}

.privacy-toc:hover {
    box-shadow: 0 20px 45px rgba(0, 0, 0, 0.12);
    transform: translateY(-5px);
}

.privacy-toc__header {
    position: relative;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    padding: 25px 20px;
    overflow: hidden;
}

.privacy-toc__header:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle at 30% 50%, rgba(126, 90, 247, 0.4) 0%, rgba(63, 55, 201, 0.1) 50%, transparent 70%);
    opacity: 0.6;
}

.privacy-toc__header:after {
    content: '';
    position: absolute;
    top: -50px;
    right: -50px;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
    opacity: 0.4;
}

.privacy-toc__title {
    position: relative;
    z-index: 2;
    font-size: 20px;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.privacy-toc__list {
    padding: 15px 10px;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.privacy-toc__item {
    margin-bottom: 0;
}

.privacy-toc__link {
    padding: 10px 15px;
    display: flex;
    align-items: center;
    color: var(--text-color);
    text-decoration: none;
    transition: all 0.3s ease;
    border-radius: 12px;
    border-right: 3px solid transparent;
    position: relative;
    overflow: hidden;
}

[dir="rtl"] .privacy-toc__link {
    border-right: none;
    border-left: 3px solid transparent;
}

.privacy-toc__link:hover {
    background-color: rgba(105, 65, 198, 0.08);
    color: var(--primary-color);
    transform: translateX(5px);
}

[dir="rtl"] .privacy-toc__link:hover {
    transform: translateX(-5px);
}

.privacy-toc__link.active {
    background-color: rgba(105, 65, 198, 0.12);
    color: var(--primary-color);
    border-right-color: var(--primary-color);
    font-weight: 600;
}

[dir="rtl"] .privacy-toc__link.active {
    border-right-color: transparent;
    border-left-color: var(--primary-color);
}

.privacy-toc__link.active:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, rgba(105, 65, 198, 0.05) 0%, rgba(105, 65, 198, 0.01) 100%);
    z-index: -1;
}

.privacy-toc__icon {
    width: 28px;
    height: 28px;
    min-width: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 10px;
    font-size: 13px;
    color: var(--primary-color);
    background: rgba(105, 65, 198, 0.1);
    border-radius: 10px;
    transition: all 0.3s ease;
}

[dir="rtl"] .privacy-toc__icon {
    margin-right: 0;
    margin-left: 10px;
}

.privacy-toc__link:hover .privacy-toc__icon,
.privacy-toc__link.active .privacy-toc__icon {
    background: linear-gradient(135deg, rgba(105, 65, 198, 0.2) 0%, rgba(78, 54, 177, 0.3) 100%);
    color: #fff;
    transform: scale(1.1);
    box-shadow: 0 4px 8px rgba(105, 65, 198, 0.2);
}

.privacy-toc__text {
    font-size: 14px;
    letter-spacing: 0;
}

/* Privacy Content */
.privacy-policy-content {
    padding: 40px;
    background-color: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--card-shadow);
}

.privacy-block {
    margin-bottom: 50px;
    scroll-margin-top: 100px;
}

.privacy-block:last-child {
    margin-bottom: 30px;
}

.privacy-block__header {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.privacy-block__icon {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, rgba(111, 65, 198, 0.1) 0%, rgba(78, 54, 177, 0.15) 100%);
    border-radius: 50%;
    margin-right: 15px;
    color: var(--primary-color);
    font-size: 22px;
    flex-shrink: 0;
}

[dir="rtl"] .privacy-block__icon {
    margin-right: 0;
    margin-left: 15px;
}

.privacy-block__title {
    font-size: 24px;
    font-weight: 700;
    color: var(--heading-color);
    margin: 0;
    flex: 1;
}

.privacy-block__content {
    color: var(--text-light);
}

.privacy-block__subtitle {
    font-size: 18px;
    font-weight: 600;
    color: var(--heading-color);
    margin: 25px 0 15px;
}

.privacy-block__text {
    font-size: 16px;
    line-height: 1.8;
    margin-bottom: 15px;
}

/* Privacy Lists */
.privacy-list {
    padding-left: 25px;
    margin-bottom: 20px;
}

[dir="rtl"] .privacy-list {
    padding-left: 0;
    padding-right: 25px;
}

.privacy-list li {
    color: var(--text-light);
    font-size: 16px;
    line-height: 1.8;
    margin-bottom: 10px;
    position: relative;
}

.privacy-list--structured li {
    margin-bottom: 20px;
}

.privacy-list__title {
    display: block;
    font-weight: 600;
    color: var(--text-color);
    margin-bottom: 5px;
}

.privacy-list__text {
    display: block;
}

/* Privacy Callout */
.privacy-callout {
    display: flex;
    background-color: rgba(111, 65, 198, 0.05);
    border-radius: var(--border-radius-sm);
    padding: 20px;
    margin: 20px 0;
}

.privacy-callout--important {
    background-color: rgba(238, 82, 83, 0.05);
}

.privacy-callout__icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(111, 65, 198, 0.1);
    border-radius: 50%;
    margin-right: 15px;
    color: var(--primary-color);
    font-size: 16px;
    flex-shrink: 0;
}

.privacy-callout--important .privacy-callout__icon {
    background-color: rgba(238, 82, 83, 0.1);
    color: #ee5253;
}

[dir="rtl"] .privacy-callout__icon {
    margin-right: 0;
    margin-left: 15px;
}

.privacy-callout__content {
    flex: 1;
}

.privacy-callout__content p {
    margin: 0;
}

/* Privacy Measures */
.privacy-measures {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin: 30px 0;
}

.privacy-measure-item {
    display: flex;
    align-items: flex-start;
    background-color: rgba(248, 249, 250, 0.8);
    border-radius: var(--border-radius-sm);
    padding: 20px;
    transition: var(--transition);
}

.privacy-measure-item:hover {
    background-color: rgba(248, 249, 250, 1);
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}

.privacy-measure-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(111, 65, 198, 0.1);
    border-radius: 50%;
    margin-right: 15px;
    color: var(--primary-color);
    font-size: 16px;
    flex-shrink: 0;
}

[dir="rtl"] .privacy-measure-icon {
    margin-right: 0;
    margin-left: 15px;
}

.privacy-measure-text {
    font-size: 15px;
    color: var(--text-color);
}

/* Privacy Cookies Table */
.privacy-cookies-table {
    border-radius: var(--border-radius-sm);
    overflow: hidden;
    margin: 30px 0;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.privacy-cookies-row {
    display: flex;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.privacy-cookies-row:last-child {
    border-bottom: none;
}

.privacy-cookies-header {
    background-color: rgba(111, 65, 198, 0.1);
    font-weight: 600;
    color: var(--heading-color);
}

.privacy-cookies-cell {
    flex: 1;
    padding: 15px;
}

.privacy-cookies-cell:first-child {
    flex: 0 0 30%;
    border-right: 1px solid rgba(0, 0, 0, 0.05);
}

[dir="rtl"] .privacy-cookies-cell:first-child {
    border-right: none;
    border-left: 1px solid rgba(0, 0, 0, 0.05);
}

/* Privacy Cookie Settings */
.privacy-cookie-settings {
    background-color: rgba(248, 249, 250, 0.8);
    border-radius: var(--border-radius-sm);
    padding: 25px;
    margin: 30px 0;
}

.cookie-settings-controls {
    background-color: rgba(248, 249, 250, 0.5);
    border-radius: 8px;
    padding: 20px;
    border: 1px solid rgba(0,0,0,0.05);
    margin-top: 20px;
}

.cookie-setting-item {
    display: flex;
    align-items: center;
    padding: 15px;
    background-color: white;
    border-radius: 8px;
    margin-bottom: 10px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.02);
    transition: var(--transition);
}

.cookie-setting-item:hover {
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    transform: translateY(-2px);
}

.cookie-setting-item:last-child {
    margin-bottom: 0;
}

.cookie-setting-info {
    margin-left: 15px;
}

[dir="rtl"] .cookie-setting-info {
    margin-left: 0;
    margin-right: 15px;
}

.cookie-setting-name {
    display: block;
    font-weight: 500;
    color: var(--text-color);
}

.cookie-setting-desc {
    font-size: 13px;
    color: var(--text-light);
}

/* Switch */
.switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 24px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 34px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
}

input:checked + .slider {
    background-color: var(--primary-color);
}

input:disabled + .slider {
    opacity: 0.6;
    cursor: not-allowed;
}

input:focus + .slider {
    box-shadow: 0 0 1px var(--primary-color);
}

input:checked + .slider:before {
    transform: translateX(26px);
}

[dir="rtl"] input:checked + .slider:before {
    transform: translateX(-26px);
}

/* Privacy FAQ */
.privacy-faq-item {
    margin-bottom: 15px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    border-radius: 8px;
    overflow: hidden;
}

.privacy-faq-question {
    padding: 15px 20px;
    background-color: rgba(248, 249, 250, 0.8);
    cursor: pointer !important;
    user-select: none;
    display: flex;
    align-items: center;
    transition: background-color 0.3s ease;
}

.privacy-faq-question:hover {
    background-color: rgba(248, 249, 250, 1);
}

.privacy-faq-question.active {
    background-color: rgba(111, 65, 198, 0.08);
}

.privacy-faq-question .faq-icon {
    min-width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(111, 65, 198, 0.1);
    border-radius: 50%;
    margin-right: 15px;
    color: var(--primary-color);
    font-size: 14px;
    transition: all 0.3s ease;
}

[dir="rtl"] .privacy-faq-question .faq-icon {
    margin-right: 0;
    margin-left: 15px;
}

.privacy-faq-question.active .faq-icon i {
    transform: rotate(45deg);
}

.privacy-faq-answer {
    padding: 20px;
    background-color: white;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
}

.faq-text {
    flex: 1;
}

/* Privacy Rights Grid */
.privacy-rights-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin: 30px 0;
}

.privacy-right-item {
    background-color: rgba(248, 249, 250, 0.8);
    border-radius: var(--border-radius-sm);
    padding: 20px;
    transition: var(--transition);
    height: 100%;
}

.privacy-right-item:hover {
    background-color: rgba(248, 249, 250, 1);
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}

.privacy-right-icon {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(111, 65, 198, 0.1);
    border-radius: 50%;
    margin: 0 auto 15px;
    color: var(--primary-color);
    font-size: 20px;
}

.privacy-right-text {
    text-align: center;
    font-size: 15px;
    color: var(--text-color);
}

/* Contact Info */
.contact-info {
    background-color: rgba(248, 249, 250, 0.8);
    border-radius: var(--border-radius-sm);
    padding: 5px;
    margin-top: 20px;
}

.contact-info-row {
    display: flex;
    margin: 15px 0;
    padding: 10px;
    border-radius: var(--border-radius-sm);
    transition: var(--transition);
}

.contact-info-row:hover {
    background-color: rgba(248, 249, 250, 1);
}

.contact-info-label {
    flex: 0 0 30%;
    display: flex;
    align-items: center;
    color: var(--text-color);
    font-weight: 500;
}

.contact-info-label i {
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(111, 65, 198, 0.1);
    border-radius: 50%;
    margin-right: 10px;
    color: var(--primary-color);
    font-size: 14px;
}

[dir="rtl"] .contact-info-label i {
    margin-right: 0;
    margin-left: 10px;
}

.contact-info-value {
    flex: 1;
    color: var(--text-light);
}

.contact-info-value a {
    color: var(--primary-color);
    text-decoration: none;
    transition: var(--transition);
}

.contact-info-value a:hover {
    text-decoration: underline;
}

/* Privacy Quick Contact */
.privacy-quick-contact {
    margin-top: 40px;
    background: linear-gradient(135deg, rgba(111, 65, 198, 0.05) 0%, rgba(78, 54, 177, 0.1) 100%);
    border-radius: var(--border-radius);
    padding: 30px;
    text-align: center;
}

.privacy-quick-contact__header h3 {
    color: var(--heading-color);
    font-size: 20px;
    margin-bottom: 15px;
}

.privacy-quick-contact__content p {
    margin-bottom: 20px;
}

.privacy-contact-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    color: white;
    padding: 12px 25px;
    border-radius: var(--border-radius-sm);
    text-decoration: none;
    font-weight: 500;
    transition: var(--transition);
}

.privacy-contact-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    color: white;
}

/* Privacy Updated */
.privacy-updated {
    text-align: right;
    margin-top: 30px;
    color: #888;
    font-style: italic;
    font-size: 14px;
}

[dir="rtl"] .privacy-updated {
    text-align: left;
}

/* Back to top */
.back-to-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white);
    opacity: 0;
    visibility: hidden;
    transition: var(--transition);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    z-index: 100;
}

[dir="rtl"] .back-to-top {
    right: auto;
    left: 30px;
}

.back-to-top.visible {
    opacity: 1;
    visibility: visible;
}

.back-to-top:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    color: var(--white);
}

/* Cookie settings buttons */
.cookie-settings-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 20px;
}

.cookie-settings-btn {
    flex: 1;
    min-width: 120px;
    padding: 12px 18px;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    text-align: center;
}

.save-btn {
    background-color: var(--primary-color);
    color: white;
}

.save-btn:hover {
    background-color: var(--secondary-color);
    transform: translateY(-2px);
}

.reject-btn {
    background-color: #f0f0f0;
    color: var(--text-color);
}

.reject-btn:hover {
    background-color: #e0e0e0;
    transform: translateY(-2px);
}

.accept-btn {
    background-color: var(--success-color);
    color: white;
}

.accept-btn:hover {
    background-color: #218838;
    transform: translateY(-2px);
}

/* Privacy toast */
.privacy-toast {
    position: fixed;
    bottom: 25px;
    left: 50%;
    transform: translateX(-50%) translateY(100px);
    padding: 15px 30px;
    background-color: rgba(40, 167, 69, 0.95);
    color: white;
    border-radius: 8px;
    font-weight: 500;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    z-index: 9999;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.privacy-toast.show {
    opacity: 1;
    visibility: visible;
    transform: translateX(-50%) translateY(0);
}

/* Privacy Header Transition */
.cosmic-header, 
.privacy-header {
    padding: 150px 0 200px;
    margin-bottom: -100px;
    position: relative;
    z-index: 1;
}

.privacy-header:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23f8f9fa' fill-opacity='1' d='M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,202.7C672,203,768,181,864,186.7C960,192,1056,224,1152,218.7C1248,213,1344,171,1392,149.3L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
    background-size: cover;
    background-position: center;
    z-index: 2;
}

/* Privacy Responsive */
@media (max-width: 1199px) {
    .privacy-rights-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .privacy-toc__text {
        font-size: 14px;
    }
    
    .privacy-toc__link {
        padding: 10px 15px;
    }
}

@media (max-width: 991px) {
    .privacy-header {
        padding: 150px 0 120px;
    }
    
    .privacy-header__title {
        font-size: 32px;
    }
    
    .privacy-toc {
        position: relative !important;
        top: auto !important;
        width: auto !important;
        margin-bottom: 40px;
    }
    
    .privacy-policy-section {
        padding: 60px 0;
    }
    
    .privacy-policy-content {
        padding: 30px;
    }
    
    .privacy-measures {
        grid-template-columns: 1fr;
    }
    
    .cookie-settings-buttons {
        flex-direction: column;
    }
    
    .privacy-toc__list {
        padding: 15px 5px;
    }
    
    .privacy-toc__icon {
        width: 28px;
        height: 28px;
        min-width: 28px;
        font-size: 12px;
    }
}

@media (max-width: 767px) {
    .privacy-header {
        padding: 120px 0 100px;
    }
    
    .privacy-header__title {
        font-size: 28px;
    }
    
    .privacy-block__title {
        font-size: 22px;
    }
    
    .privacy-block__text, 
    .privacy-list li {
        font-size: 15px;
    }
    
    .privacy-cookies-table.responsive-table .privacy-cookies-row {
        display: block;
    }
    
    .privacy-cookies-table.responsive-table .privacy-cookies-header {
        display: none;
    }
    
    .privacy-cookies-table.responsive-table .privacy-cookies-cell {
        display: block;
        width: 100%;
        padding: 10px 15px;
    }
    
    .privacy-cookies-table.responsive-table .privacy-cookies-cell:first-child {
        flex: 1;
        border-right: none;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .privacy-cookies-table.responsive-table .privacy-cookies-cell:before {
        content: attr(data-title);
        display: block;
        font-weight: 600;
        margin-bottom: 5px;
        color: var(--heading-color);
    }
    
    [dir="rtl"] .privacy-cookies-table.responsive-table .privacy-cookies-cell:first-child {
        border-left: none;
    }
    
    .privacy-rights-grid {
        grid-template-columns: 1fr;
    }
    
    .contact-info-row {
        flex-direction: column;
    }
    
    .contact-info-label {
        margin-bottom: 10px;
    }
}

@media (max-width: 576px) {
    .privacy-policy-content {
        padding: 20px;
    }
    
    .privacy-block__header {
        flex-direction: column;
        text-align: center;
    }
    
    .privacy-block__icon {
        margin: 0 0 15px;
    }
    
    [dir="rtl"] .privacy-block__icon {
        margin: 0 0 15px;
    }
    
    .privacy-callout {
        flex-direction: column;
        text-align: center;
    }
    
    .privacy-callout__icon {
        margin: 0 auto 15px;
    }
    
    [dir="rtl"] .privacy-callout__icon {
        margin: 0 auto 15px;
    }
}

/* Privacy Print */
@media print {
    .privacy-header,
    .privacy-toc,
    .back-to-top,
    .privacy-cookie-settings,
    .privacy-actions,
    footer,
    header,
    .privacy-quick-contact {
        display: none !important;
    }
    
    .privacy-policy-content {
        box-shadow: none;
        padding: 0;
    }
    
    .container {
        width: 100%;
        max-width: 100%;
    }
    
    .privacy-block {
        break-inside: avoid;
        page-break-inside: avoid;
        margin-bottom: 20px;
    }
    
    .privacy-block__header {
        break-after: avoid;
        page-break-after: avoid;
    }
    
    .privacy-block__title {
        font-size: 18px;
    }
    
    .privacy-block__subtitle {
        font-size: 16px;
    }
    
    .privacy-block__text,
    .privacy-list li {
        font-size: 12px;
    }
    
    .privacy-updated {
        margin-top: 50px;
        text-align: center;
        font-size: 12px;
    }
    
    .privacy-cookies-table,
    .privacy-rights-grid,
    .privacy-measures {
        page-break-inside: avoid;
    }
}

/* ==========================================================================
   17. 404 ERROR PAGE
========================================================================== */

    /* Language Selector */
    .error-language-selector {
        position: absolute;
        top: 20px;
        right: 20px;
        z-index: 10;
        display: flex;
        gap: 10px;
    }

    [dir="rtl"] .error-language-selector {
        right: auto;
        left: 20px;
    }

    .lang-btn {
        background: white;
        border: 1px solid rgba(105, 65, 198, 0.2);
        color: var(--primary-color);
        font-weight: 600;
        padding: 8px 14px;
        border-radius: 100px;
        cursor: pointer;
        transition: var(--transition);
        font-size: 14px;
    }

    .lang-btn:hover, 
    .lang-btn.active {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
        box-shadow: 0 5px 15px rgba(105, 65, 198, 0.2);
    }

    [dir="rtl"] .lang-btn {
        font-family: 'Vazir', sans-serif;
    }

    /* Error Content */
    .error-404-center {
        padding: 100px 20px;
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        flex: 1;
    }

    .error-404-svg {
        max-width: 500px;
        margin: 0 auto 40px;
        animation: float 6s ease-in-out infinite;
    }

    .error-svg-image {
        width: 100%;
        height: auto;
    }

    .error-content {
        max-width: 600px;
        margin: 0 auto;
    }

    .error-404-title {
        font-size: 42px;
        font-weight: 800;
        color: var(--text-dark);
        margin-bottom: 15px;
        animation: fadeIn 1s ease;
    }

    [dir="rtl"] .error-404-title {
        font-family: 'Vazir', sans-serif;
    }

    .error-404-text {
        font-size: 18px;
        color: var(--text-light);
        line-height: 1.6;
        margin-bottom: 30px;
        animation: fadeIn 1s ease 0.2s both;
    }

    [dir="rtl"] .error-404-text {
        font-family: 'Vazir', sans-serif;
    }

    .error-404-btn {
        display: inline-block;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        font-weight: 600;
        padding: 15px 30px;
        border-radius: 100px;
        text-decoration: none;
        transition: var(--transition);
        animation: fadeIn 1s ease 0.4s both;
        box-shadow: 0 5px 15px rgba(105, 65, 198, 0.2);
    }

    .error-404-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(105, 65, 198, 0.3);
        color: white;
        background: linear-gradient(135deg, var(--primary-dark), var(--primary-color));
    }

    [dir="rtl"] .error-404-btn {
        font-family: 'Vazir', sans-serif;
    }

    /* Error Footer */
    .error-footer {
        text-align: center;
        padding: 30px 0;
        margin-top: auto;
    }

    .error-footer-logo {
        max-width: 160px;
        transition: var(--transition);
    }

    .error-footer-logo:hover {
        transform: translateY(-5px);
    }




 /* ==========================================================================
   18. Terms and Conditions for Registration PAGE
========================================================================== */

/* Header Section Styles */
.terms-header {
    background: linear-gradient(135deg, #0F172A 0%, #1E293B 60%, #334155 100%);
    position: relative;
    overflow: hidden;
    color: var(--white);
    text-align: center;
    padding: 180px 0 140px;
    margin-top: 0;
}

.terms-header::after {
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

.terms-header__content {
    position: relative;
    z-index: 2;
}

.terms-header__title {
    font-family: 'Vazir', sans-serif !important;
    font-size: 38px;
    font-weight: 800;
    margin-bottom: 15px;
    color: white;
    animation: slideDown 1s ease-out, floatEffect 4s ease-in-out infinite;
}

.terms-header__subtitle {
    font-family: 'Vazir', sans-serif;
    font-size: 18px;
    max-width: 700px;
    margin: 0 auto 40px;
    opacity: 0.9;
    color: white;
    animation: slideDown 1s ease-out 0.3s both, floatEffect 5s ease-in-out infinite;
}

/* Main Content Section */
.terms-registration-section {
    padding: 80px 0;
    background-color: var(--bg-primary);
    position: relative;
}

.registration-block {
    background-color: var(--white);
    border-radius: var(--border-radius);
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    margin-bottom: 30px;
    overflow: hidden;
    transition: var(--transition);
}

.registration-block:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.section-title {
    font-size: 24px;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 0;
    padding: 20px 30px;
    border-bottom: 1px solid #eee;
    background-color: var(--bg-light);
    display: flex;
    align-items: center;
}

.section-icon {
    color: var(--accent-color);
    margin-right: 15px;
    font-size: 20px;
}

[dir="rtl"] .section-icon {
    margin-right: 0;
    margin-left: 15px;
}

.registration-content {
    padding: 30px;
}

.registration-content h4 {
    font-size: 20px;
    font-weight: 600;
    color: #222;
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 1px dashed rgba(0, 0, 0, 0.1);
}

/* Check Lists & Account Lists */
.check-list, .account-list {
    list-style: none;
    padding: 0;
    margin: 0 0 20px;
}

.check-list li, .account-list li {
    position: relative;
    padding-left: 30px;
    margin-bottom: 12px;
    color: #444;
    transition: var(--transition);
}

.check-list li:hover, .account-list li:hover {
    transform: translateX(5px);
    color: var(--primary-color);
}

.check-list li .icon, .account-list li .icon {
    position: absolute;
    left: 0;
    top: 2px;
    color: var(--primary-color);
}

/* Content Styling */
.registration-content p {
    margin-bottom: 20px;
    color: #555;
    line-height: 1.7;
}

.registration-content strong {
    color: #222;
    font-weight: 600;
}

.highlight-phone {
    color: var(--primary-color);
    font-weight: 600;
    text-decoration: none;
    border-bottom: 1px dashed var(--primary-color);
    transition: var(--transition);
}

.highlight-phone:hover {
    color: var(--secondary-color);
}

/* Tables */
.table-responsive {
    margin-bottom: 30px;
    border-radius: 10px;
    overflow: hidden;
}

.route-table, .fees-table {
    width: 100%;
    margin-bottom: 0;
    border-collapse: collapse;
}

.route-table th, .fees-table th {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    color: var(--white);
    font-weight: 600;
    text-align: center;
    padding: 15px;
    border: none;
}

.route-table td, .fees-table td {
    padding: 15px;
    color: #444;
    vertical-align: middle;
    border-color: rgba(0, 0, 0, 0.05);
    transition: var(--transition);
}

.route-table tr:hover td, .fees-table tr:hover td {
    background-color: rgba(105, 65, 198, 0.05);
}

.route-table tr:nth-child(even), .fees-table tr:nth-child(even) {
    background-color: rgba(0, 0, 0, 0.02);
}

/* Lists Styling */
.numbered-list {
    padding-left: 20px;
    margin-bottom: 20px;
    counter-reset: item;
}

.numbered-list > li {
    margin-bottom: 20px;
    color: #444;
    position: relative;
    list-style-type: none;
    padding-left: 10px;
}

.numbered-list > li:before {
    content: counter(item) ".";
    counter-increment: item;
    color: var(--primary-color);
    font-weight: bold;
    position: absolute;
    left: -20px;
}

.inner-list {
    list-style: disc;
    padding-left: 20px;
    margin: 10px 0;
}

.inner-list li {
    margin-bottom: 10px;
    padding-left: 5px;
}

.sub-inner-list {
    list-style: circle;
    padding-left: 20px;
    margin: 10px 0;
}

.regulation-action {
    margin-top: 30px;
    text-align: center;
}

/* Buttons */
.terms-btn {
    min-width: 200px;
}

/* Sidebar Styling */
.registration-sidebar {
    position: sticky;
    top: 100px;
}

.sidebar-widget {
    background-color: var(--white);
    border-radius: var(--border-radius);
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    padding: 30px;
    margin-bottom: 30px;
    transition: var(--transition);
}

.sidebar-widget:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.sidebar-widget h3 {
    font-size: 22px;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 1px dashed rgba(0, 0, 0, 0.1);
}

/* CTA Widget */
.registration-cta {
    text-align: center;
    background: linear-gradient(135deg, rgba(111, 66, 193, 0.05) 0%, rgba(97, 47, 199, 0.1) 100%);
    border: 1px solid rgba(111, 66, 193, 0.1);
}

.registration-cta p {
    margin-bottom: 25px;
    font-size: 15px;
}

.btn-apply {
    background: linear-gradient(135deg, #FF7A1A 0%, #FF5630 100%);
    color: var(--white);
    border: none;
    width: 100%;
    font-weight: 600;
    padding: 15px;
    font-size: 16px;
}

.btn-apply:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(255, 86, 48, 0.2);
    color: var(--white);
}

/* Contact Widget */
.contact-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.contact-list li {
    display: flex;
    align-items: flex-start;
    margin-bottom: 20px;
    transition: var(--transition);
}

.contact-list li:hover {
    transform: translateX(5px);
}

.contact-list .icon {
    width: 40px;
    height: 40px;
    background-color: rgba(111, 66, 193, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    color: var(--primary-color);
    transition: var(--transition);
    flex-shrink: 0;
}

.contact-list li:hover .icon {
    background-color: var(--primary-color);
    color: var(--white);
}

.contact-list .text {
    flex: 1;
}

.contact-list .text h5 {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 5px;
    color: #222;
}

.contact-list .text a, .contact-list .text p {
    color: #555;
    margin: 0;
}

.contact-link {
    text-decoration: none;
    transition: var(--transition);
}

.contact-link:hover {
    color: var(--primary-color);
}

/* Dates List */
.dates-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.dates-list li {
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
    transition: var(--transition);
}

.dates-list li:hover {
    transform: translateX(5px);
}

.dates-list li:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.dates-list .date {
    display: block;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 5px;
}

.dates-list p {
    margin: 0;
    color: #555;
}

/* FAQ Widget */
.faq-link {
    text-align: center;
    background: linear-gradient(135deg, rgba(111, 66, 193, 0.05) 0%, rgba(97, 47, 199, 0.1) 100%);
    border: 1px solid rgba(111, 66, 193, 0.1);
}

.faq-link p {
    margin-bottom: 20px;
    font-size: 15px;
}

/* RTL Support Terms */
[dir="rtl"] {
    font-family: 'Vazirmatn', 'Vazir', sans-serif;
}

[dir="rtl"] .check-list li, 
[dir="rtl"] .account-list li {
    padding-left: 0;
    padding-right: 30px;
}

[dir="rtl"] .check-list li .icon, 
[dir="rtl"] .account-list li .icon {
    left: auto;
    right: 0;
}

[dir="rtl"] .contact-list .icon {
    margin-right: 0;
    margin-left: 15px;
}

[dir="rtl"] .numbered-list {
    padding-left: 0;
    padding-right: 20px;
}

[dir="rtl"] .numbered-list > li:before {
    left: auto;
    right: -20px;
}

[dir="rtl"] .numbered-list > li {
    padding-left: 0;
    padding-right: 10px;
}

[dir="rtl"] .inner-list,
[dir="rtl"] .sub-inner-list {
    padding-left: 0;
    padding-right: 20px;
}

[dir="rtl"] .check-list li:hover, 
[dir="rtl"] .account-list li:hover,
[dir="rtl"] .contact-list li:hover,
[dir="rtl"] .dates-list li:hover {
    transform: translateX(-5px);
}

/* Media Queries Terms */
@media (max-width: 991px) {
    .terms-header {
        padding: 150px 0 120px;
    }
    
    .terms-header__title {
        font-size: 32px;
    }
    
    .registration-sidebar {
        position: static;
        margin-top: 30px;
    }
}

@media (max-width: 767px) {
    .terms-header {
        padding: 120px 0 100px;
    }
    
    .terms-header__title {
        font-size: 28px;
    }
    
    .terms-registration-section {
        padding: 50px 0;
    }
    
    .section-title {
        font-size: 20px;
        padding: 15px 20px;
    }
    
    .registration-content {
        padding: 20px;
    }
    
    .registration-content h4 {
        font-size: 18px;
    }
    
    .sidebar-widget {
        padding: 20px;
    }
    
    .sidebar-widget h3 {
        font-size: 20px;
    }
}


/* ==========================================================================
   19. REGISTRATION PAGE
========================================================================== */
    
    /* Registration Container */
    .registration-section {
        padding: 0 0 80px;
    }

    .registration-container {
        background-color: #fff;
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow);
        padding: 40px;
        margin-bottom: 50px;
        max-width: 1200px;
        margin-left: auto;
        margin-right: auto;
        position: relative;
        overflow: hidden;
    }

    .registration-container::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: var(--purple-gradient);
        z-index: 1;
    }

    /* Progress Bar & Steps */
    .registration-progress {
        margin-bottom: 50px;
        position: relative;
        display: flex;
        justify-content: space-between;
        max-width: 950px;
        margin-left: auto;
        margin-right: auto;
    }

    .progress-line {
        position: absolute;
        top: 28px;
        left: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary), var(--primary-light));
        width: 0%;
        transition: width 0.5s ease;
        z-index: 1;
    }

    .progress-step {
        position: relative;
        z-index: 2;
        width: 18%;
        text-align: center;
        cursor: default;
    }

    .progress-step.clickable {
        cursor: pointer;
    }

    .progress-step-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 10px;
        background-color: #f5f5f5;
        border: 2px solid #ddd;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: 600;
        color: #777;
        transition: all 0.3s ease;
    }

    .progress-step-text {
        font-size: 14px;
        color: #777;
        transition: color 0.3s ease;
        max-width: 120px;
        margin: 0 auto;
    }

    [dir="rtl"] .progress-step-text {
        font-family: 'Vazir', sans-serif;
    }

    .progress-step.active .progress-step-icon {
        background-color: #fff;
        border-color: var(--primary);
        color: var(--primary);
        box-shadow: 0 0 15px rgba(108, 99, 255, 0.3);
        transform: scale(1.1);
    }

    .progress-step.active .progress-step-text {
        color: var(--primary);
        font-weight: 600;
    }

    .progress-step.complete .progress-step-icon {
        background-color: var(--primary);
        border-color: var(--primary);
        color: #fff;
    }

    .progress-step.complete .progress-step-text {
        color: var(--primary);
    }

    /* Form Steps */
    .registration-step {
        display: none;
        animation: fadeIn 0.5s ease;
    }

    .registration-step.active {
        display: block;
    }

    .step-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 10px;
    }

    [dir="rtl"] .step-title {
        font-family: 'Vazir', sans-serif;
    }

    .step-description {
        font-size: 1rem;
        color: var(--gray-600);
        margin-bottom: 30px;
    }

    [dir="rtl"] .step-description {
        font-family: 'Vazir', sans-serif;
    }

    .registration-card {
        background-color: var(--gray-50);
        border-radius: var(--border-radius);
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
        border: 1px solid var(--gray-200);
    }

    .registration-card:hover {
        box-shadow: var(--shadow);
        transform: translateY(-3px);
        border-color: var(--gray-300);
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--gray-800);
        border-bottom: 1px solid var(--gray-200);
        padding-bottom: 15px;
        margin-bottom: 20px;
        position: relative;
    }

    [dir="rtl"] .card-title {
        font-family: 'Vazir', sans-serif;
    }

    .card-title::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, var(--primary), var(--primary-light));
        border-radius: 3px;
    }

    [dir="rtl"] .card-title::after {
        left: auto;
        right: 0;
    }

    /* Form Layout */
    .form-row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -10px;
        margin-left: -10px;
    }

    .form-group {
        position: relative;
        padding-right: 10px;
        padding-left: 10px;
        margin-bottom: 1.5rem;
        width: 100%;
        flex: 0 0 100%;
        max-width: 100%;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: var(--gray-700);
    }

    [dir="rtl"] .form-group label {
        font-family: 'Vazir', sans-serif;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid var(--gray-300);
        border-radius: var(--border-radius-sm);
        font-size: 16px;
        transition: var(--transition);
    }

    [dir="rtl"] .form-group input,
    [dir="rtl"] .form-group select,
    [dir="rtl"] .form-group textarea {
        font-family: 'Vazir', sans-serif;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.1);
    }

    /* File Upload System */
    .file-upload-container {
        position: relative;
        border: 2px dashed var(--gray-300);
        border-radius: var(--border-radius);
        padding: 15px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background-color: var(--gray-50);
        height: 170px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100%;
        margin: 0;
    }

    .file-upload-container:hover, 
    .file-upload-container.highlight {
        border-color: var(--primary);
        background-color: rgba(108, 99, 255, 0.05);
        transform: translateY(-2px);
    }

    .file-upload-icon {
        width: 50px;
        height: 50px;
        background: rgba(108, 99, 255, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        color: var(--primary);
        font-size: 1.5rem;
        transition: all 0.3s ease;
    }

    .file-upload-container:hover .file-upload-icon {
        background: var(--primary);
        color: white;
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(108, 99, 255, 0.2);
    }

    .file-upload-text {
        font-weight: 600;
        color: var(--gray-800);
        margin-bottom: 5px;
        font-size: 0.95rem;
    }

    [dir="rtl"] .file-upload-text {
        font-family: 'Vazir', sans-serif;
    }

    .file-upload-hint {
        font-size: 0.75rem;
        color: var(--gray-500);
        max-width: 200px;
        margin: 0 auto;
    }

    [dir="rtl"] .file-upload-hint {
        font-family: 'Vazir', sans-serif;
    }

    .file-upload-input {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        z-index: 2;
    }

    .file-preview {
        background-color: white;
        border: 1px solid var(--gray-200);
        border-radius: var(--border-radius);
        padding: 15px;
        text-align: center;
        height: 170px;
        width: 100%;
        margin: 0;
        display: none;
        position: relative;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .file-preview.active {
        display: flex;
        animation: fadeIn 0.3s ease-in-out;
    }

    .file-preview-image {
        max-width: 80px;
        max-height: 60px;
        margin: 5px auto 10px;
        display: block;
        border-radius: 4px;
        object-fit: cover;
        box-shadow: var(--shadow-sm);
    }

    .file-preview-icon {
        width: 40px;
        height: 40px;
        margin: 5px auto 10px;
        background-color: var(--gray-100);
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        color: var(--primary);
    }

    .file-preview-name {
        font-weight: 600;
        color: var(--gray-800);
        font-size: 0.9rem;
        margin-bottom: 5px;
        word-break: break-word;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        line-clamp: 1;
        -webkit-box-orient: vertical;
        max-width: 180px;
        margin-left: auto;
        margin-right: auto;
    }

    [dir="rtl"] .file-preview-name {
        font-family: 'Vazir', sans-serif;
    }

    .file-preview-size {
        font-size: 0.8rem;
        color: var(--gray-500);
        margin-bottom: 15px;
    }

    .file-preview-remove {
        position: absolute !important;
        bottom: 15px !important;
        left: 50% !important;
        transform: translateX(-50%) !important;
        background-color: white;
        color: var(--danger);
        border: 1px solid var(--danger);
        padding: 5px 10px !important;
        border-radius: var(--border-radius-pill);
        font-size: 0.8rem;
        cursor: pointer;
        transition: background-color 0.3s !important;
        display: inline-flex;
        align-items: center;
        width: 100px !important;
        text-align: center !important;
        z-index: 10 !important;
        margin: 0 !important;
        justify-content: center;
    }

    [dir="rtl"] .file-preview-remove {
        font-family: 'Vazir', sans-serif;
    }

    .file-preview-remove:hover {
        background-color: var(--danger);
        color: white;
        transform: translateX(-50%) !important;
    }

    .file-preview-remove i {
        margin-right: 5px;
        font-size: 0.8rem;
    }

    [dir="rtl"] .file-preview-remove i {
        margin-right: 0;
        margin-left: 5px;
    }

    .file-upload-container.has-file {
        display: none;
    }

    /* Navigation Buttons */
    .step-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
    }

    .btn-prev {
        color: var(--gray-700);
        background-color: var(--gray-100);
        border: 1px solid var(--gray-300);
        padding: 10px 25px;
        border-radius: var(--border-radius-pill);
        font-size: 0.95rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
    }

    [dir="rtl"] .btn-prev {
        font-family: 'Vazir', sans-serif;
    }

    .btn-prev i {
        margin-right: 8px;
        transition: transform 0.3s;
    }

    [dir="rtl"] .btn-prev i {
        margin-right: 0;
        margin-left: 8px;
    }

    .btn-prev:hover {
        background-color: var(--gray-200);
        color: var(--gray-800);
        transform: translateY(-2px);
    }

    .btn-prev:hover i {
        transform: translateX(-3px);
    }

    [dir="rtl"] .btn-prev:hover i {
        transform: translateX(3px);
    }

    .btn-next {
        color: white;
        background: var(--purple-gradient);
        border: none;
        padding: 10px 25px;
        border-radius: var(--border-radius-pill);
        font-size: 0.95rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: var(--purple-shadow);
        display: inline-flex;
        align-items: center;
    }

    [dir="rtl"] .btn-next {
        font-family: 'Vazir', sans-serif;
    }

    .btn-next i {
        margin-left: 8px;
        transition: transform 0.3s;
    }

    [dir="rtl"] .btn-next i {
        margin-left: 0;
        margin-right: 8px;
    }

    .btn-next:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(108, 99, 255, 0.3);
    }

    .btn-next:hover i {
        transform: translateX(3px);
    }

    [dir="rtl"] .btn-next:hover i {
        transform: translateX(-3px);
    }

    .btn-submit {
        color: white;
        background: var(--success-gradient);
        border: none;
        padding: 10px 25px;
        border-radius: var(--border-radius-pill);
        font-size: 0.95rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: var(--success-shadow);
        display: inline-flex;
        align-items: center;
    }

    [dir="rtl"] .btn-submit {
        font-family: 'Vazir', sans-serif;
    }

    .btn-submit i {
        margin-right: 8px;
        transition: transform 0.3s;
    }

    [dir="rtl"] .btn-submit i {
        margin-right: 0;
        margin-left: 8px;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(76, 175, 80, 0.3);
    }

    /* Summary Section */
    .summary-section {
        margin-bottom: 25px;
        border-bottom: 1px solid var(--gray-200);
        padding-bottom: 20px;
    }

    .summary-section:last-child {
        border-bottom: none;
        padding-bottom: 0;
        margin-bottom: 0;
    }

    .summary-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 15px;
        position: relative;
        padding-left: 20px;
    }

    [dir="rtl"] .summary-title {
        font-family: 'Vazir', sans-serif;
        padding-left: 0;
        padding-right: 20px;
    }

    .summary-title::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 8px;
        height: 8px;
        background-color: var(--primary);
        border-radius: 50%;
    }

    [dir="rtl"] .summary-title::before {
        left: auto;
        right: 0;
    }

    .summary-items {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px 30px;
    }

    .summary-item {
        display: flex;
        flex-wrap: wrap;
        margin-bottom: 10px;
    }

    .summary-label {
        flex: 0 0 40%;
        font-weight: 500;
        color: var(--gray-700);
    }

    [dir="rtl"] .summary-label {
        font-family: 'Vazir', sans-serif;
    }

    .summary-value {
        flex: 0 0 60%;
        color: var(--gray-800);
    }

    [dir="rtl"] .summary-value {
        font-family: 'Vazir', sans-serif;
    }

    /* Transportation Options */
    .transportation-radio-group {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .transportation-option {
        min-width: 120px;
        padding: 12px 20px;
        border: 2px solid var(--gray-200);
        border-radius: var(--border-radius);
        transition: all 0.3s ease;
        cursor: pointer;
        flex: 1;
        display: flex;
        align-items: center;
    }

    .transportation-option:hover {
        background-color: var(--gray-100);
        transform: translateY(-2px);
        border-color: var(--gray-300);
    }

    .transportation-option .form-check-input {
        margin-right: 10px;
    }

    [dir="rtl"] .transportation-option .form-check-input {
        margin-right: 0;
        margin-left: 10px;
    }

    .transportation-option .form-check-label {
        margin-bottom: 0;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    [dir="rtl"] .transportation-option .form-check-label {
        font-family: 'Vazir', sans-serif;
    }

    .transportation-option.selected {
        border-color: var(--primary);
        background-color: rgba(var(--primary-rgb), 0.05);
        box-shadow: 0 0 0 1px var(--primary);
    }

    .transportation-option.selected .form-check-label {
        font-weight: 600;
        color: var(--primary);
    }

    /* Route Description */
    #routeDescription {
        background-color: var(--gray-50);
        border-left: 3px solid var(--primary);
        padding: 12px 15px;
        font-size: 0.95rem;
        margin-top: 10px;
        border-radius: 0 var(--border-radius-sm) var(--border-radius-sm) 0;
        color: var(--gray-700);
    }

    [dir="rtl"] #routeDescription {
        border-left: none;
        border-right: 3px solid var(--primary);
        border-radius: var(--border-radius-sm) 0 0 var(--border-radius-sm);
        font-family: 'Vazir', sans-serif;
    }

    /* Route Stops */
    .route-stops {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 10px;
    }

    .route-stop {
        display: inline-block;
        background-color: var(--gray-100);
        padding: 5px 10px;
        border-radius: var(--border-radius-xs);
        font-size: 0.9rem;
        color: var(--gray-700);
        border: 1px solid var(--gray-200);
    }

    [dir="rtl"] .route-stop {
        font-family: 'Vazir', sans-serif;
    }

    /* Loading Spinner */
    .spinner-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        visibility: hidden;
        opacity: 0;
        transition: opacity 0.3s, visibility 0.3s;
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

    /* Invalid Feedback */
    .invalid-feedback {
        display: none;
        color: var(--danger);
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    [dir="rtl"] .invalid-feedback {
        font-family: 'Vazir', sans-serif;
    }

    .invalid-feedback.d-block {
        display: block;
    }

    /* Registration Success Page */
    .success-container {
        background-color: #fff;
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow-lg);
        overflow: hidden;
        max-width: 800px;
        margin: 0 auto 80px;
        position: relative;
    }

    .success-header {
        background: var(--purple-gradient);
        padding: 30px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .success-header::before {
        content: '';
        position: absolute;
        width: 150%;
        height: 100px;
        background: rgba(255, 255, 255, 0.1);
        transform: rotate(-5deg);
        bottom: -50px;
        left: -25%;
    }

    .success-icon-wrap {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        margin: 0 auto 20px;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .success-icon-wrap::before {
        content: '';
        position: absolute;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        z-index: 0;
    }

    .success-icon {
        width: 90px;
        height: 90px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        color: var(--primary);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 1;
    }

    .success-title {
        font-size: 28px;
        font-weight: 700;
        color: white;
        margin-bottom: 10px;
        text-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    [dir="rtl"] .success-title {
        font-family: 'Vazir', sans-serif;
    }

    .success-subtitle {
        color: rgba(255, 255, 255, 0.9);
        font-size: 16px;
        max-width: 600px;
        margin: 0 auto;
    }

    [dir="rtl"] .success-subtitle {
        font-family: 'Vazir', sans-serif;
    }

    .success-body {
        padding: 40px;
    }

    /* Tracking Number Display */
    .tracking-card {
        background: linear-gradient(135deg, var(--light-purple) 0%, #ffffff 100%);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-sm);
        padding: 25px;
        margin-bottom: 30px;
        text-align: center;
        position: relative;
        border: 1px dashed rgba(var(--primary-rgb), 0.3);
    }

    .tracking-title {
        font-size: 16px;
        font-weight: 600;
        color: var(--gray-700);
        margin-bottom: 15px;
    }

    [dir="rtl"] .tracking-title {
        font-family: 'Vazir', sans-serif;
    }

    .tracking-number {
        background: white;
        padding: 12px 25px;
        border-radius: var(--border-radius-sm);
        font-size: 24px;
        font-weight: 700;
        color: var(--primary);
        display: inline-block;
        box-shadow: var(--shadow-sm);
        margin-bottom: 10px;
        border: 1px solid rgba(var(--primary-rgb), 0.1);
        min-width: 200px;
        position: relative;
        overflow: hidden;
    }

    .tracking-number::before {
        content: '';
        position: absolute;
        top: 0;
        left: -75%;
        width: 50%;
        height: 100%;
        background: linear-gradient(90deg, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.8) 50%, rgba(255, 255, 255, 0) 100%);
        transform: skewX(-25deg);
        animation: shine 3s infinite;
    }

    .tracking-hint {
        font-size: 14px;
        color: var(--gray-500);
    }

    [dir="rtl"] .tracking-hint {
        font-family: 'Vazir', sans-serif;
    }

    /* Info Sections on Success Page */
    .info-section {
        margin-bottom: 30px;
    }

    .info-heading {
        font-size: 18px;
        font-weight: 600;
        color: var(--gray-800);
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid var(--gray-200);
        position: relative;
    }

    [dir="rtl"] .info-heading {
        font-family: 'Vazir', sans-serif;
    }

    .info-heading::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 50px;
        height: 3px;
        background: var(--purple-gradient);
        border-radius: 3px;
    }

    [dir="rtl"] .info-heading::after {
        left: auto;
        right: 0;
    }

    .student-info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-bottom: 20px;
    }

    .info-item {
        background: var(--gray-50);
        border-radius: var(--border-radius-sm);
        padding: 12px 15px;
        border: 1px solid var(--gray-200);
    }

    .info-label {
        font-size: 13px;
        color: var(--gray-600);
        margin-bottom: 5px;
    }

    [dir="rtl"] .info-label {
        font-family: 'Vazir', sans-serif;
    }

    .info-value {
        font-size: 15px;
        font-weight: 500;
        color: var(--gray-800);
    }

    [dir="rtl"] .info-value {
        font-family: 'Vazir', sans-serif;
    }

    /* Status Indicators */
    .status-badge {
        display: inline-block;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 500;
    }

    [dir="rtl"] .status-badge {
        font-family: 'Vazir', sans-serif;
    }

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

    /* Steps List */
    .steps-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .step-item {
        display: flex;
        margin-bottom: 15px;
        position: relative;
        padding-left: 30px;
        align-items: flex-start;
    }

    [dir="rtl"] .step-item {
        padding-left: 0;
        padding-right: 30px;
    }

    .step-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 5px;
        width: 20px;
        height: 20px;
        background: var(--light-purple);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-weight: 700;
        font-size: 12px;
        border: 2px solid var(--primary);
    }

    [dir="rtl"] .step-item::before {
        left: auto;
        right: 0;
    }

    .step-item:nth-child(1)::before { content: '1'; }
    .step-item:nth-child(2)::before { content: '2'; }
    .step-item:nth-child(3)::before { content: '3'; }
    .step-item:nth-child(4)::before { content: '4'; }
    .step-item:nth-child(5)::before { content: '5'; }

    .step-text {
        font-size: 15px;
        color: var(--gray-700);
        line-height: 1.5;
    }

    [dir="rtl"] .step-text {
        font-family: 'Vazir', sans-serif;
    }

    /* Contact Information Grid */
    .contact-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    .contact-item {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        background: var(--gray-50);
        border-radius: var(--border-radius-sm);
        border: 1px solid var(--gray-200);
    }

    .contact-icon {
        width: 40px;
        height: 40px;
        background: var(--light-purple);
        color: var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        flex-shrink: 0;
    }

    [dir="rtl"] .contact-icon {
        margin-right: 0;
        margin-left: 15px;
    }

    .contact-text {
        flex-grow: 1;
    }

    .contact-label {
        font-size: 13px;
        color: var(--gray-600);
        margin-bottom: 2px;
    }

    [dir="rtl"] .contact-label {
        font-family: 'Vazir', sans-serif;
    }

    .contact-value {
        font-size: 14px;
        color: var(--gray-800);
        font-weight: 500;
    }

    [dir="rtl"] .contact-value {
        font-family: 'Vazir', sans-serif;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 30px;
    }

    .btn-action {
        padding: 12px 25px;
        border-radius: var(--border-radius-pill);
        font-weight: 600;
        font-size: 15px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
    }

    [dir="rtl"] .btn-action {
        font-family: 'Vazir', sans-serif;
    }

    .btn-action i {
        margin-right: 8px;
    }

    [dir="rtl"] .btn-action i {
        margin-right: 0;
        margin-left: 8px;
    }

    .btn-print {
        background: var(--purple-gradient);
        color: white;
        box-shadow: var(--purple-shadow);
        border: none;
    }

    .btn-print:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(var(--primary-rgb), 0.4);
        color: white;
    }

    .btn-home {
        background: white;
        color: var(--primary);
        border: 2px solid var(--primary);
    }

    .btn-home:hover {
        background: var(--light-purple);
        transform: translateY(-3px);
    }

    /* Certificate Styling */
    .certificate-container {
        background-color: #fff;
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow-lg);
        margin: 2rem auto;
        padding: 0;
        position: relative;
        overflow: hidden;
        max-width: 210mm; /* A4 width */
    }

    .certificate-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 8px;
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
        z-index: 2;
    }

    .certificate-content {
        padding: 3rem;
        position: relative;
        background: #fff;
        z-index: 1;
    }

    .certificate-header {
        text-align: center;
        margin-bottom: 2.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid rgba(108, 99, 255, 0.1);
        position: relative;
    }

    .certificate-header::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 3px;
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
        border-radius: 3px;
    }

    .school-logo {
        max-width: 180px;
        margin: 0 auto 1.5rem;
        display: block;
    }

    .certificate-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 1rem;
    }

    [dir="rtl"] .certificate-title {
        font-family: 'Vazir', sans-serif;
    }

    .certificate-message {
        font-size: 1.1rem;
        color: var(--gray-700);
        max-width: 700px;
        margin: 0 auto 1rem;
    }

    [dir="rtl"] .certificate-message {
        font-family: 'Vazir', sans-serif;
    }

    /* Print Certificate */
    .print-certificate {
        display: none;
    }

    /* Error Page */
    .error-section {
        padding: 60px 0;
    }

    .error-card {
        background-color: #fff;
        border-radius: var(--border-radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        margin-bottom: 30px;
        max-width: 800px;
        margin: 0 auto;
        padding: 3rem;
        text-align: center;
    }

    .error-icon {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
        font-size: 64px;
        color: var(--danger);
    }

    .error-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 15px;
        color: var(--gray-900);
    }

    [dir="rtl"] .error-title {
        font-family: 'Vazir', sans-serif;
    }

    .error-message {
        font-size: 18px;
        color: var(--gray-700);
        margin-bottom: 30px;
        line-height: 1.6;
    }

    [dir="rtl"] .error-message {
        font-family: 'Vazir', sans-serif;
    }

    .btn-registration {
        background-color: var(--primary);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: var(--border-radius-pill);
        font-weight: 500;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        box-shadow: var(--purple-shadow);
    }

    [dir="rtl"] .btn-registration {
        font-family: 'Vazir', sans-serif;
    }

    .btn-registration:hover {
        background-color: var(--primary-dark);
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(108, 99, 255, 0.3);
        color: white;
    }

    .btn-registration i {
        margin-right: 10px;
    }

    [dir="rtl"] .btn-registration i {
        margin-right: 0;
        margin-left: 10px;
    }

    /* Responsive Grid System */
    @media (min-width: 768px) {
        .form-group {
            flex: 0 0 50%;
            max-width: 50%;
        }
        
        .form-group.full-width {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }

    @media (min-width: 992px) {
        .form-group.file-field {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }
    }

    /* Registration Responsive */
    @media (max-width: 1199px) {
        .registration-container {
            padding: 30px;
        }
        
        .progress-step-icon {
            width: 50px;
            height: 50px;
            font-size: 20px;
        }
        
        .progress-line {
            top: 23px;
        }
    }

    @media (max-width: 991px) {
        .registration-container {
            padding: 25px;
        }
        
        .registration-card {
            padding: 20px;
        }
        
        .card-title {
            font-size: 1.2rem;
            margin-bottom: 15px;
        }
        
        .progress-step-text {
            font-size: 0.85rem;
        }
        
        .success-icon {
            width: 100px;
            height: 100px;
            font-size: 3rem;
        }
        
        .success-title {
            font-size: 2.25rem;
        }
        
        .tracking-number {
            font-size: 2rem;
        }
    }

    @media (max-width: 767px) {
        .registration-container {
            padding: 20px 15px;
        }
        
        .registration-progress {
            overflow-x: auto;
            justify-content: flex-start;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
        
        .progress-step {
            flex: 0 0 100px;
            min-width: 100px;
            margin-right: 5px;
        }
        
        .progress-step-icon {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }
        
        .progress-step-text {
            font-size: 0.8rem;
        }
        
        .progress-line {
            top: 18px;
        }
        
        .transportation-radio-group {
            flex-direction: column;
            gap: 10px;
        }
        
        .step-buttons {
            flex-direction: column;
            gap: 15px;
        }
        
        .btn-prev,
        .btn-next,
        .btn-submit {
            width: 100%;
            justify-content: center;
        }
        
        .summary-items {
            grid-template-columns: 1fr;
        }
        
        .action-buttons {
            flex-direction: column;
            gap: 1rem;
        }
        
        .btn-action {
            width: 100%;
        }
        
        .form-group.file-field {
            flex: 0 0 100%;
            max-width: 100%;
        }
        
        .student-info-grid,
        .contact-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 575px) {
        .registration-container {
            padding: 15px 10px;
        }
        
        .registration-card {
            padding: 15px;
            margin-bottom: 20px;
        }
        
        .card-title {
            font-size: 1.1rem;
            margin-bottom: 12px;
            padding-bottom: 10px;
        }
        
        .error-card {
            padding: 2rem 1.5rem;
        }
        
        .error-icon {
            font-size: 48px;
        }
        
        .error-title {
            font-size: 22px;
        }
        
        .error-message {
            font-size: 16px;
        }
    }

/* ==========================================================================
  GENERAL RESPONSIVE ADJUSTMENTS
========================================================================== */

    /* About Page Responsive */
    @media (max-width: 1199px) {
        .about-heading__title {
            font-size: 30px;
        }
    }

    @media (max-width: 991px) {
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

    /* Blog Page Responsive */
    @media (max-width: 1199px) {
        .blog-header__title {
            font-size: 36px;
        }
        
        .featured-post__image {
            height: 350px;
        }
        
        .featured-post__title {
            font-size: 24px;
        }
    }

    @media (max-width: 991px) {
        .blog-header {
            padding: 120px 0 70px;
            margin-bottom: 40px;
        }
        
        .blog-header__title {
            font-size: 30px;
        }
        
        .blog-sidebar {
            position: static;
            margin-top: 40px;
        }
        
        .featured-post__image {
            height: 300px;
        }
    }

    @media (max-width: 767px) {
        .blog-header {
            padding: 100px 0 60px;
        }
        
        .blog-header__title {
            font-size: 26px;
        }
        
        .featured-post__image {
            height: 250px;
        }
        
        .featured-post__title {
            font-size: 22px;
        }
        
        .featured-post__content {
            padding: 25px 20px;
        }
        
        .blog-card {
            margin-bottom: 20px;
        }
        
        .blog-card__image {
            height: 180px;
        }
    }

    @media (max-width: 575px) {
        .blog-header {
            padding: 90px 0 50px;
        }
        
        .blog-header__title {
            font-size: 22px;
        }
        
        .blog-section {
            padding: 0 0 50px;
        }
        
        .featured-post__image {
            height: 200px;
        }
        
        .featured-post__title {
            font-size: 20px;
        }
        
        .featured-post__content {
            padding: 20px 15px;
        }
        
        .blog-sidebar__widget {
            padding: 20px;
        }
        
        .blog-sidebar__post-image {
            width: 70px;
            height: 70px;
        }
    }

    /* Contact Page Responsive */
    @media (max-width: 991px) {
        .cosmic-header {
            padding: 160px 0 140px;
        }
        
        .cosmic-header__title {
            font-size: 38px;
        }
        
        .cosmic-header__subtitle {
            font-size: 18px;
        }
        
        .map-info-card {
            position: relative;
            top: 0;
            left: 0;
            right: 0;
            max-width: 100%;
            margin-bottom: 20px;
            border-radius: var(--border-radius-lg) var(--border-radius-lg) 0 0;
        }
        
        .map-section {
            height: auto;
            display: flex;
            flex-direction: column;
        }
        
        .map-iframe {
            height: 400px;
            border-radius: 0 0 var(--border-radius-lg) var(--border-radius-lg);
        }
        
        .contact-section .col-lg-4 {
            margin-bottom: 30px;
        }
        
        .contact-shape-1,
        .contact-shape-2,
        .contact-shape-3 {
            opacity: 0.03;
        }
    }

    @media (max-width: 767px) {
        .cosmic-header {
            padding: 130px 0 110px;
        }
        
        .cosmic-header__title {
            font-size: 32px;
        }
        
        .cosmic-header__subtitle {
            font-size: 16px;
        }
        
        .contact-section {
            padding: 60px 0;
        }
        
        .form-title {
            font-size: 28px;
        }
        
        .form-subtitle {
            font-size: 16px;
        }
        
        .map-iframe {
            height: 300px;
        }
        
        .contact-card-title {
            font-size: 24px;
        }
        
        .contact-info-icon {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }
    }

    /* Educational Levels Responsive */
    @media (max-width: 991px) {
        .curriculum-section {
            padding: 70px 0;
        }
        
        .curriculum-header {
            padding: 150px 0 120px;
        }
        
        .curriculum-header__title {
            font-size: 36px;
        }
        
        .section-title {
            font-size: 28px;
        }
    }

    @media (max-width: 767px) {
        .curriculum-section {
            padding: 50px 0;
        }
        
        .curriculum-header {
            padding: 120px 0 100px;
        }
        
        .curriculum-header__title {
            font-size: 30px;
        }
        
        .section-title {
            font-size: 24px;
        }
        
        .section-image {
            margin-bottom: 30px;
        }
        
        .feature-icon {
            width: 40px;
            height: 40px;
        }
        
        .feature-icon i {
            font-size: 18px;
        }
        
        .play-button-wrapper .play-button {
            width: 60px;
            height: 60px;
        }
        
        .play-button-wrapper .play-button i {
            font-size: 24px;
        }
    }

    /* Ehsan SOD Responsive */
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

    /* Facilities Page Responsive */
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

    /* FAQ Page Responsive */
    @media (max-width: 991px) {
        .faq-header {
            padding: 150px 0 120px;
        }
        
        .faq-header__title {
            font-size: 32px;
        }
        
        .faq-sidebar {
            margin-bottom: 30px;
            border-radius: var(--border-radius);
            overflow: hidden;
        }
        
        .faq-content {
            padding: 40px 0;
        }
    }

    @media (max-width: 767px) {
        .faq-header {
            padding: 120px 0 100px;
        }
        
        .faq-header__title {
            font-size: 28px;
        }
        
        .faq-search__input {
            height: 50px;
            font-size: 15px;
        }
        
        .faq-nav__item {
            padding: 8px 15px;
            font-size: 14px;
        }
        
        .faq-category__title {
            font-size: 18px;
        }
        
        .faq-sidebar__title {
            font-size: 24px;
        }
    }

    @media (max-width: 575px) {
        .faq-header__title {
            font-size: 24px;
        }
        
        .faq-search__input {
            font-size: 14px;
        }
        
        .faq-sidebar, .faq-main {
            padding: 20px;
        }
        
        .faq-question {
            padding: 15px 20px;
            font-size: 15px;
        }
        
        .faq-answer {
            padding: 0 20px;
        }
        
        .faq-sidebar {
            border-radius: var(--border-radius);
            padding: 25px;
        }
    }
/* ==========================================================================
   END OF PAGE SPECIFIC CSS
 ========================================================================== */
</style>