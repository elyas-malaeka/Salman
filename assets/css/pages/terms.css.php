<style>/* 
 * Custom Styling for Registration Terms Page 
 * Salman Educational Complex
 * Version 2.0
 */

/* Base Styles */
:root {
    --primary-color: #6941C6;
    --secondary-color: #4E36B1;
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

/* Random Stars using Pseudo-elements */
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

/* Cosmic Planets */
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
.btn {
    padding: 12px 24px;
    border-radius: 50px;
    font-weight: 500;
    text-decoration: none;
    transition: var(--transition);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    color: var(--white);
    border: none;
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.btn-outline {
    background: transparent;
    color: var(--primary-color);
    border: 1px solid var(--primary-color);
}

.btn-outline:hover {
    background: var(--primary-color);
    color: var(--white);
}

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

/* RTL Support */
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

/* Animations */
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

/* Responsive adjustments */
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
}</style>