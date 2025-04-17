<style>
        /* Core Curriculum Page Styles */
/* Core Curriculum Page Styles */
:root {
    --primary-color: #6941C6;         /* Purple from your CSS */
    --secondary-color: #333333;        /* Dark gray/black for titles */
    --accent-color: #7F56D9;           /* Light purple accent from your CSS */
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
    src: url('../fonts/Vazir.eot');
    src: url('../fonts/Vazir.eot?#iefix') format('embedded-opentype'),
         url('../fonts/Vazir.woff2') format('woff2'),
         url('../fonts/Vazir.woff') format('woff'),
         url('../fonts/Vazir.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;
}

@font-face {
    font-family: 'Vazir';
    src: url('../fonts/Vazir-Bold.eot');
    src: url('../fonts/Vazir-Bold.eot?#iefix') format('embedded-opentype'),
         url('../fonts/Vazir-Bold.woff2') format('woff2'),
         url('../fonts/Vazir-Bold.woff') format('woff'),
         url('../fonts/Vazir-Bold.ttf') format('truetype');
    font-weight: bold;
    font-style: normal;
}

/* Base Styles */
body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--text-color);
    line-height: 1.6;
}

[dir="rtl"] body {
    font-family: 'Vazir', sans-serif;
}

/* Section Styling */
.curriculum-section {
    padding: 100px 0;
    position: relative;
    overflow: hidden;
}

.curriculum-section:nth-child(even) {
    background-color: var(--bg-light);
}

/* Cosmic Header Styling - Matching your provided CSS */
.curriculum-header {
    background: linear-gradient(135deg, #0F172A 0%, #1E293B 60%, #334155 100%);
    position: relative;
    overflow: hidden;
    color: var(--white);
    text-align: center;
    padding: 180px 0 140px;
    margin-top: 0;
}

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

.curriculum-header::after {
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

.curriculum-header__content {
    position: relative;
    z-index: 2;
}

.curriculum-header__title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 38px;
    font-weight: 800;
    margin-bottom: 15px;
    color: white;
    animation: slideDown 1s ease-out, floatEffect 4s ease-in-out infinite;
}

[dir="rtl"] .curriculum-header__title {
    font-family: 'Vazir', sans-serif !important;
}

.curriculum-header__subtitle {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 18px;
    max-width: 700px;
    margin: 0 auto 40px;
    opacity: 0.9;
    color: white;
    animation: slideDown 1s ease-out 0.3s both, floatEffect 5s ease-in-out infinite;
}

[dir="rtl"] .curriculum-header__subtitle {
    font-family: 'Vazir', sans-serif;
}

/* Content Sections Styling */
.section-label {
    text-transform: uppercase;
    font-size: 14px;
    letter-spacing: 1.5px;
    color: var(--primary-color);
    margin-bottom: 15px;
    font-weight: 600;
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
    color: var(--text-light);
    margin-bottom: 30px;
    font-size: 16px;
}

[dir="rtl"] .section-description {
    font-family: 'Vazir', sans-serif;
}

/* Features and Card Styling */
.feature-item {
    display: flex;
    margin-bottom: 25px;
}

.feature-icon {
    width: 50px;
    height: 50px;
    background-color: rgba(105, 65, 198, 0.1);  /* Light purple background */
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 20px;
    flex-shrink: 0;
}

[dir="rtl"] .feature-icon {
    margin-right: 0;
    margin-left: 20px;
}

.feature-icon i {
    color: var(--primary-color);
    font-size: 22px;
}

.feature-title {
    color: rgb(15, 12, 95);
    font-weight: 700;
    margin-bottom: 8px;
    font-size: 20px;
    color: var(--secondary-color);  /* Black color for title */
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
    color: var(--secondary-color);  /* Black color for title */
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

/* Section Image Styling */
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

.play-button {
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

.play-button::before {
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

@keyframes pulse {
    0% {
        transform: scale(0.95);
        opacity: 0.7;
    }
    70% {
        transform: scale(1.2);
        opacity: 0;
    }
    100% {
        transform: scale(0.95);
        opacity: 0;
    }
}

.play-button i {
    color: var(--primary-color);
    font-size: 30px;
    margin-left: 5px;
}

.play-button:hover {
    transform: translate(-50%, -50%) scale(1.1);
    background-color: var(--primary-color);
}

.play-button:hover i {
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

/* Special Needs Section Highlight */
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

/* Animation Keyframes */
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

@keyframes floatEffect {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0px); }
}

/* Responsive Adjustments */
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
    
    .play-button {
        width: 60px;
        height: 60px;
    }
    
    .play-button i {
        font-size: 24px;
    }
}
    </style>