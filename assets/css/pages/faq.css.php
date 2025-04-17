<style>
    /**
 * Modern FAQ Page Styles
 * 
 * Styles for the Salman Educational Complex FAQ page
 * Including cosmic background, search functionality, and accordion
 * 
 * @version 4.0
 */

 :root {
    --primary-color: #6941C6;
    --secondary-color: #4E36B1;
    --accent-color: #7F56D9;
    --text-color: #333;
    --text-light: #666;
    --bg-light: #f8f9fa;
    --white: #ffffff;
    --border-radius: 20px;
    --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    --animation-duration: 0.3s;
}

/* Global Styles */
body {
    color: var(--text-color);
    font-family: 'Plus Jakarta Sans', sans-serif;
    background-color: #f5f7fa;
    overflow-x: hidden;
}

[dir="rtl"] body {
    font-family: 'Vazirmatn', sans-serif;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

/* Cosmic Header with Stars */
.faq-header {
    background: linear-gradient(135deg, #0F172A 0%, #1E293B 60%, #334155 100%);
    position: relative;
    overflow: hidden;
    color: var(--white);
    text-align: center;
    padding: 180px 0 140px;
}

/* Cosmic Background Effect */
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

/* Generate random stars using pseudo-elements */
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

/* Cosmic planets */
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

.faq-header::after {
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

.faq-header__content {
    position: relative;
    z-index: 2;
}

.faq-header__title {
    font-size: 38px;
    font-weight: 800;
    margin-bottom: 15px;
    color: white;
}

.faq-header__subtitle {
    font-size: 18px;
    max-width: 700px;
    margin: 0 auto 40px;
    opacity: 0.9;
    color: white;
}

/* Modern Search Bar */
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

/* Modern Card Layout */
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

.faq-sidebar__text {
    font-size: 16px;
    margin-bottom: 30px;
    opacity: 0.9;
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

.no-results__text {
    color: var(--text-light);
    margin-bottom: 25px;
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* Responsive Styles */
@media (max-width: 1199px) {
    .faq-sidebar, .faq-main {
        padding: 30px;
    }
}

@media (max-width: 991px) {
    .faq-header {
        padding: 150px 0 120px;
    }
    
    .faq-header__title {
        font-size: 32px;
    }
    
    .faq-sidebar {
        margin-bottom: 30px;
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
}
/* این بخش را به انتهای فایل CSS اضافه کنید یا بخش مربوطه را جایگزین کنید */

@media (max-width: 991px) {
    .faq-header {
        padding: 150px 0 120px;
    }
    
    .faq-header__title {
        font-size: 32px;
    }
    
    .faq-sidebar {
        margin-bottom: 30px;
        border-radius: var(--border-radius); /* اطمینان از حفظ border-radius در موبایل */
        overflow: hidden; /* برای جلوگیری از بیرون زدن محتوا */
    }
    
    .faq-content {
        padding: 40px 0;
    }
}

@media (max-width: 575px) {
    /* سایر کدها */
    
    .faq-sidebar {
        border-radius: var(--border-radius); /* تکرار برای اطمینان */
        padding: 25px; /* کمی padding کمتر در حالت موبایل */
    }
}
</style>