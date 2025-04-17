<style>
    /* 
 * Privacy Policy Page Styles
 * Salman Educational Complex
 * Version 2.0
 */

/* Base Styles */
:root {
    --primary-color: #6941C6;
    --secondary-color: #4E36B1;
    --accent-color: #7F56D9;
    --text-color: #333;
    --text-light: #6e7678;
    --heading-color: #341897;
    --bg-light: #f8f9fa;
    --white: #ffffff;
    --border-radius: 15px;
    --border-radius-sm: 8px;
    --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    --card-hover-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
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

/* Privacy Policy Header Section Styles */
.privacy-header {
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

.privacy-header::after {
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

.privacy-header__content {
    position: relative;
    z-index: 2;
}

.privacy-header__title {
    font-family: 'Vazir', sans-serif !important;
    font-size: 38px;
    font-weight: 800;
    margin-bottom: 15px;
    color: white;
    animation: slideDown 1s ease-out, floatEffect 4s ease-in-out infinite;
}

.privacy-header__subtitle {
    font-family: 'Vazir', sans-serif;
    font-size: 18px;
    max-width: 700px;
    margin: 0 auto 40px;
    opacity: 0.9;
    color: white;
    animation: slideDown 1s ease-out 0.3s both, floatEffect 5s ease-in-out infinite;
}

/* Main Content Section */
.privacy-policy-section {
    padding: 80px 0;
    background-color: var(--bg-light);
    position: relative;
}

/* Table of Contents */
.privacy-toc {
    position: sticky;
    top: 100px;
    background-color: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--card-shadow);
    overflow: hidden;
    transition: var(--transition);
}

.privacy-toc:hover {
    box-shadow: var(--card-hover-shadow);
}

.privacy-toc__header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    padding: 20px;
    color: var(--white);
}

.privacy-toc__title {
    font-size: 18px;
    font-weight: 600;
    margin: 0;
}

.privacy-toc__list {
    list-style: none;
    padding: 15px 0;
    margin: 0;
    max-height: 70vh;
    overflow-y: auto;
}

.privacy-toc__item {
    margin-bottom: 5px;
}

.privacy-toc__link {
    display: flex;
    align-items: center;
    padding: 10px 20px;
    color: var(--text-color);
    text-decoration: none;
    transition: var(--transition);
    border-left: 3px solid transparent;
}

[dir="rtl"] .privacy-toc__link {
    border-left: none;
    border-right: 3px solid transparent;
}

.privacy-toc__link:hover,
.privacy-toc__link.active {
    background-color: rgba(105, 65, 198, 0.1);
    color: var(--primary-color);
    border-left-color: var(--primary-color);
}

[dir="rtl"] .privacy-toc__link:hover,
[dir="rtl"] .privacy-toc__link.active {
    border-left-color: transparent;
    border-right-color: var(--primary-color);
}

.privacy-toc__icon {
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 10px;
    font-size: 14px;
    color: var(--primary-color);
    background-color: rgba(105, 65, 198, 0.1);
    border-radius: 50%;
}

[dir="rtl"] .privacy-toc__icon {
    margin-right: 0;
    margin-left: 10px;
}

.privacy-toc__text {
    font-size: 14px;
}

.privacy-actions {
    padding: 15px 20px;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
}

.privacy-print-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 12px;
    background-color: #f0f0f0;
    border: none;
    border-radius: 8px;
    color: var(--text-color);
    font-size: 14px;
    cursor: pointer;
    transition: var(--transition);
}

.privacy-print-btn:hover {
    background-color: #e0e0e0;
}

/* Privacy Policy Content */
.privacy-policy-content {
    padding: 40px;
    background-color: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--card-shadow);
}

.privacy-block {
    margin-bottom: 50px;
    scroll-margin-top: 100px; /* For smooth scrolling to anchors */
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

/* Lists */
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

/* Callouts */
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

/* Security Measures */
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

/* Cookies Table */
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

/* User Rights Grid */
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

/* Last Updated */
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

/* Back to Top Button */
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
@media (max-width: 1199px) {
    .privacy-rights-grid {
        grid-template-columns: repeat(2, 1fr);
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
        position: static;
        margin-bottom: 30px;
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
    
    .privacy-cookies-row {
        flex-direction: column;
    }
    
    .privacy-cookies-cell:first-child {
        flex: 1;
        border-right: none;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    [dir="rtl"] .privacy-cookies-cell:first-child {
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
</style>