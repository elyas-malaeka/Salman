<?php
/**
 * Ultra Professional Footer for Salman Educational Complex - Enhanced Newsletter
 * 
 * Features:
 * - Advanced animations and micro-interactions
 * - Modern glassmorphism effects
 * - Dynamic gradient backgrounds
 * - Smooth parallax effects
 * - Enhanced accessibility
 * - Dark mode support
 * - Performance optimized
 * - Improved Newsletter Form
 * - Professional Modal System
 * 
 * @package Salman Educational Complex
 * @version 3.1
 */

// Include footer helper functions
require_once 'includes/footer_helpers.php';

// Get current language
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';
$isRtl = ($lang == 'fa' || $lang == 'ar');

// Get Instagram posts from database
$instagram_posts = getInstagramPosts($lang);
?>

<footer class="ultra-footer" data-theme="light">
    <!-- Animated Background Elements -->
    <div class="footer-bg-animation">
        <div class="gradient-orb orb-2"></div>
        <div class="gradient-orb orb-3"></div>
    </div>
    
    <div class="container">
        <!-- Footer Top Section with Glass Effect -->
        <div class="footer-glass-wrapper">
            <div class="footer-top">
                <!-- Logo and Description -->
                <div class="footer-brand" data-aos="fade-up">
                    <a href="index.php" class="footer-logo magnetic-effect">
                        <?php if($isRtl): ?>
                        <img src="<?php echo getFooterContent('logo_path_rtl', $lang); ?>" alt="<?php echo getFooterContent('site_name', $lang); ?>" class="logo-image">
                        <?php else: ?>
                        <img src="<?php echo getFooterContent('logo_path_ltr', $lang); ?>" alt="<?php echo getFooterContent('site_name', $lang); ?>" class="logo-image">
                        <?php endif; ?>
                        <div class="logo-glow"></div>
                    </a>
                    
                    <p class="footer-description">
                        <?php echo getFooterContent('school_description', $lang); ?>
                    </p>
                    
                    <!-- Simple & Clean Newsletter -->
                    <form action="includes/process-newsletter.php" method="post" class="newsletter-form" id="newsletterForm">
                        <div class="newsletter-wrapper">
                            <div class="newsletter-input-container">
                                <input 
                                    type="email" 
                                    name="EMAIL" 
                                    placeholder="<?php echo $isRtl ? 'آدرس ایمیل شما' : 'Your email address'; ?>" 
                                    required 
                                    class="newsletter-input"
                                    autocomplete="email"
                                >
                            </div>
                            <button type="submit" class="newsletter-btn">
                                <span class="btn-text"><?php echo $isRtl ? 'عضویت' : 'Subscribe'; ?></span>
                                <span class="btn-icon"><i class="fas fa-paper-plane"></i></span>
                                <span class="btn-loading"><i class="fas fa-spinner fa-spin"></i></span>
                                <span class="btn-success"><i class="fas fa-check"></i></span>
                            </button>
                        </div>
                        <p class="newsletter-note">
                            <?php echo $isRtl ? 'آخرین اخبار آموزشی را دریافت کنید' : 'Get the latest educational updates'; ?>
                        </p>
                    </form>
                </div>
                
                <!-- Quick Links with Hover Cards -->
                <div class="footer-links" data-aos="fade-up" data-aos-delay="100">
                    <h2 class="footer-widget__title">
                        <span class="title-text"><?php echo getFooterContent('quick_links_title', $lang); ?></span>
                        <span class="title-decoration"></span>
                    </h2>
                    <ul class="footer-menu">
                        <?php
                        $quickLinks = getFooterLinks('quick_links', $lang);
                        foreach($quickLinks as $index => $link):
                        ?>
                        <li class="menu-item" style="--item-index: <?php echo $index; ?>">
                            <a href="<?php echo $link['url']; ?>" class="menu-link">
                                <span class="link-icon">
                                    <i class="fas fa-chevron-<?php echo $isRtl ? 'left' : 'right'; ?>"></i>
                                </span>
                                <span class="link-text"><?php echo $link['title']; ?></span>
                                <span class="link-hover-bg"></span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Educational Levels with Cards -->
                <div class="footer-links" data-aos="fade-up" data-aos-delay="200">
                    <h2 class="footer-widget__title">
                        <span class="title-text"><?php echo getFooterContent('educational_levels_title', $lang); ?></span>
                        <span class="title-decoration"></span>
                    </h2>
                    <ul class="footer-menu">
                        <?php
                        $educationalLevelLinks = getFooterLinks('curriculum_links', $lang);
                        foreach($educationalLevelLinks as $index => $link):
                        ?>
                        <li class="menu-item" style="--item-index: <?php echo $index; ?>">
                            <a href="<?php echo $link['url']; ?>" class="menu-link">
                                <span class="link-icon">
                                    <i class="fas fa-chevron-<?php echo $isRtl ? 'left' : 'right'; ?>"></i>
                                </span>
                                <span class="link-text"><?php echo $link['title']; ?></span>
                                <span class="link-hover-bg"></span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                
                <!-- Modern Instagram Grid -->
                <div class="footer-links" data-aos="fade-up" data-aos-delay="300">
                    <h2 class="footer-widget__title">
                        <span class="title-text"><?php echo getFooterContent('instagram_title', $lang); ?></span>
                        <span class="title-decoration"></span>
                    </h2>
                    <div class="instagram-modern-grid">
                        <?php foreach($instagram_posts as $index => $post): ?>
                        <a href="<?php echo $post['link']; ?>" target="_blank" class="instagram-card" style="--ig-index: <?php echo $index; ?>">
                            <div class="ig-image-wrapper">
                                <img src="<?php echo $post['image']; ?>" alt="Instagram Post" loading="lazy">
                                <div class="ig-overlay">
                                    <div class="ig-stats">
                                        <span><i class="fas fa-heart"></i> <?php echo rand(50, 500); ?></span>
                                        <span><i class="fas fa-comment"></i> <?php echo rand(5, 50); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="ig-glow"></div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer Bottom with Floating Elements -->
        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <div class="copyright">
                    <p><?php echo getCopyrightText($lang); ?></p>
                    <p class="developed-by">
                        <?php echo $isRtl ? 'طراحی و توسعه با ' : 'Designed & Developed with '; ?>
                        <span class="heart">❤️</span>
                        <a href="https://github.com/elyas-malaeka">
                        <?php echo $isRtl ? 'توسط الیاس ملائکه' : 'by Elyas Malaeka'; ?></a>
                    </p>
                </div>
                
                <!-- Modern Social Links -->
                <div class="social-modern">
                    <?php
                    $socialLinks = getSocialLinks();
                    foreach($socialLinks as $index => $social):
                    ?>
                    <a href="<?php echo $social['url']; ?>" class="social-link" target="_blank" aria-label="<?php echo $social['name']; ?>" style="--social-index: <?php echo $index; ?>">
                        <span class="social-icon">
                            <i class="fab fa-<?php echo $social['icon']; ?>"></i>
                        </span>
                        <span class="social-tooltip"><?php echo $social['name']; ?></span>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Back to Top Button -->
    <button class="back-to-top" id="backToTop" aria-label="Back to top">
        <span class="btt-arrow">
            <i class="fas fa-arrow-up"></i>
        </span>
        <span class="btt-progress">
            <svg viewBox="0 0 36 36">
                <path class="btt-progress-circle" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
            </svg>
        </span>
    </button>
</footer>

<!-- Simple Modal System -->
<div class="simple-modal" id="simpleModal">
    <div class="modal-backdrop" id="modalBackdrop"></div>
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-icon" id="modalIcon">
                <i class="fas fa-check"></i>
            </div>
            <button class="modal-close" id="modalClose">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <h3 id="modalTitle">عنوان پیام</h3>
            <p id="modalMessage">متن پیام اینجا نمایش داده می‌شود</p>
            <button class="modal-btn" id="modalBtn">
                <?php echo $isRtl ? 'بستن' : 'Close'; ?>
            </button>
        </div>
    </div>
</div>

<style>
/* Enhanced Font System */
@font-face {
    font-family: 'Vazir';
    src: url('assets/fonts/Vazir-Variable.woff2') format('woff2-variations'),
         url('assets/fonts/Vazir.woff2') format('woff2');
    font-weight: 100 900;
    font-display: swap;
}

/* CSS Variables for Ultimate Control */
:root {
    /* Primary Colors */
    --primary: #6941C6;
    --primary-dark: #4E36B1;
    --primary-light: #9E77ED;
    --primary-glow: #6941C633;
    
    /* Accent Colors */
    --accent: #7F56D9;
    --accent-light: #B692F6;
    --accent-glow: #7F56D94D;
    
    /* Status Colors */
    --success: #10B981;
    --success-light: #34D399;
    --error: #EF4444;
    --error-light: #F87171;
    --warning: #F59E0B;
    --warning-light: #FBBF24;
    --info: #3B82F6;
    --info-light: #60A5FA;
    
    /* Gradient Colors */
    --gradient-1: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --gradient-2: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    --gradient-3: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    --gradient-success: linear-gradient(135deg, #10B981 0%, #059669 100%);
    --gradient-error: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
    --gradient-warning: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
    --gradient-info: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
    
    /* Text Colors */
    --text-primary: #1a1a1a;
    --text-secondary: #4a5568;
    --text-muted: #718096;
    
    /* Background Colors */
    --bg-primary: #ffffff;
    --bg-secondary: #f3f4f6;
    --bg-glass: rgba(255, 255, 255, 0.7);
    
    /* Effects */
    --shadow-sm: 0 2px 4px rgba(0,0,0,0.05);
    --shadow-md: 0 4px 12px rgba(0,0,0,0.08);
    --shadow-lg: 0 10px 25px rgba(0,0,0,0.12);
    --shadow-xl: 0 20px 50px rgba(0,0,0,0.15);
    --shadow-glow: 0 0 30px var(--primary-glow);
    
    /* Animations */
    --ease-out-expo: cubic-bezier(0.19, 1, 0.22, 1);
    --ease-in-out-expo: cubic-bezier(0.87, 0, 0.13, 1);
    --ease-bounce: cubic-bezier(0.68, -0.55, 0.265, 1.55);
    
    /* Spacing */
    --space-unit: 1rem;
    --border-radius: 12px;
    --border-radius-lg: 16px;
    --border-radius-xl: 20px;
}

/* Dark Theme Variables */
[data-theme="dark"] {
    --text-primary: #f7fafc;
    --text-secondary: #e2e8f0;
    --text-muted: #a0aec0;
    --bg-primary: #1a202c;
    --bg-secondary: #2d3748;
    --bg-glass: rgba(45, 55, 72, 0.7);
    --shadow-sm: 0 2px 4px rgba(0,0,0,0.2);
    --shadow-md: 0 4px 12px rgba(0,0,0,0.3);
    --shadow-lg: 0 10px 25px rgba(0,0,0,0.4);
    --shadow-xl: 0 20px 50px rgba(0,0,0,0.5);
}

/* Global Styles */
* {
    box-sizing: border-box;
}

/* Ultra Modern Footer */
.ultra-footer {
    position: relative;
    background: var(--bg-secondary);
    color: var(--text-secondary);
    padding: 0px 0 40px;
    overflow: hidden;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

[dir="rtl"] .ultra-footer {
    font-family: 'Vazir', -apple-system, BlinkMacSystemFont, sans-serif;
}

/* Animated Background */
.footer-bg-animation {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: 0;
}

.gradient-orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    opacity: 0.3;
    animation: float 20s infinite ease-in-out;
}

.orb-1 {
    width: 600px;
    height: 600px;
    background: var(--gradient-1);
    top: -200px;
    left: -200px;
    animation-duration: 25s;
}

.orb-2 {
    width: 400px;
    height: 400px;
    background: var(--gradient-2);
    bottom: -100px;
    right: -100px;
    animation-duration: 30s;
    animation-delay: -5s;
}

.orb-3 {
    width: 300px;
    height: 300px;
    background: var(--gradient-3);
    top: 50%;
    left: 50%;
    animation-duration: 35s;
    animation-delay: -10s;
}

@keyframes float {
    0%, 100% { transform: translate(0, 0) scale(1); }
    25% { transform: translate(50px, -50px) scale(1.1); }
    50% { transform: translate(-50px, 50px) scale(0.9); }
    75% { transform: translate(30px, 30px) scale(1.05); }
}

/* Container */
.container {
    position: relative;
    z-index: 1;
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    padding-bottom: 75px;
}

/* Glass Wrapper */
.footer-glass-wrapper {
    background: var(--bg-glass);
    backdrop-filter: blur(10px);
    border-radius: 30px;
    padding: 60px;
    box-shadow: var(--shadow-lg);
    border: 1px solid rgba(255, 255, 255, 0.2);
    margin-bottom: 60px;
}

/* Footer Top Grid */
.footer-top {
    display: grid;
    grid-template-columns: 1.5fr 1fr 1fr 1fr;
    gap: 50px;
}

/* Logo Section */
.footer-logo {
    display: inline-block;
    position: relative;
    margin-bottom: 30px;
}

.logo-image {
    max-height: 50px;
    width: auto;
    position: relative;
    z-index: 2;
}

.logo-glow {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 120%;
    height: 120%;
    background: var(--primary-glow);
    filter: blur(20px);
    border-radius: 50%;
    opacity: 0;
    transition: opacity 0.4s ease;
}

.footer-logo:hover .logo-glow {
    opacity: 1;
}

/* Typewriter Effect for Description */
.footer-description {
    font-size: 16px;
    line-height: 1.8;
    color: var(--text-secondary);
    margin-bottom: 30px;
    text-align: justify;
    text-justify: inter-word;
}

/* =====================================================
   SIMPLE & CLEAN NEWSLETTER
   ===================================================== */

.newsletter-form {
    width: 100%;
    max-width: 400px;
}

.newsletter-wrapper {
    display: flex;
    gap: 8px;
    margin-bottom: 12px;
}

.newsletter-input-container {
    flex: 1;
    position: relative;
}

.newsletter-input {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid rgba(255, 255, 255, 0.2);
    background: rgba(255, 255, 255, 0.9);
    border-radius: 10px;
    font-size: 14px;
    color: var(--text-primary);
    outline: none;
    transition: all 0.3s ease;
    font-family: inherit;
}

.newsletter-input:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px var(--primary-glow);
    transform: translateY(-1px);
}

.newsletter-input::placeholder {
    color: var(--text-muted);
}

.newsletter-btn {
    padding: 12px 18px;
    background: var(--gradient-1);
    border: none;
    border-radius: 10px;
    color: white;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 6px;
    white-space: nowrap;
    min-width: 100px;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.newsletter-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(127, 86, 217, 0.3);
}

.newsletter-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

.btn-text, .btn-icon, .btn-loading, .btn-success {
    transition: all 0.3s ease;
}

.btn-loading, .btn-success {
    position: absolute;
    opacity: 0;
}

.newsletter-btn.loading .btn-text,
.newsletter-btn.loading .btn-icon {
    opacity: 0;
}

.newsletter-btn.loading .btn-loading {
    opacity: 1;
}

.newsletter-btn.success {
    background: var(--gradient-success);
}

.newsletter-btn.success .btn-text,
.newsletter-btn.success .btn-icon,
.newsletter-btn.success .btn-loading {
    opacity: 0;
}

.newsletter-btn.success .btn-success {
    opacity: 1;
}

.newsletter-note {
    font-size: 12px;
    color: var(--text-muted);
    text-align: center;
    margin: 0;
    opacity: 0.8;
}

/* RTL Support */
[dir="rtl"] .newsletter-input {
    text-align: right;
}

/* =====================================================
   SIMPLE MODAL SYSTEM
   ===================================================== */

.simple-modal {
    position: fixed;
    inset: 0;
    z-index: 9999;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.simple-modal.active {
    opacity: 1;
    visibility: visible;
}

.modal-backdrop {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(8px);
}

.modal-content {
    position: relative;
    z-index: 2;
    background: var(--bg-primary);
    border-radius: 16px;
    box-shadow: var(--shadow-xl);
    width: 100%;
    max-width: 400px;
    transform: scale(0.9) translateY(20px);
    transition: all 0.3s ease;
}

.simple-modal.active .modal-content {
    transform: scale(1) translateY(0);
}

.modal-header {
    position: relative;
    padding: 30px 20px 20px;
    text-align: center;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.modal-icon {
    width: 60px;
    height: 60px;
    background: var(--gradient-1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
    margin: 0 auto 15px;
    transition: all 0.3s ease;
}

.modal-icon.success {
    background: var(--gradient-success);
}

.modal-icon.error {
    background: var(--gradient-error);
}

.modal-icon.warning {
    background: var(--gradient-warning);
}

.modal-icon.info {
    background: var(--gradient-info);
}

.modal-close {
    position: absolute;
    top: 15px;
    right: 15px;
    width: 30px;
    height: 30px;
    background: transparent;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-muted);
    transition: all 0.3s ease;
}

[dir="rtl"] .modal-close {
    right: auto;
    left: 15px;
}

.modal-close:hover {
    background: rgba(239, 68, 68, 0.1);
    color: var(--error);
}

.modal-body {
    padding: 0 20px 25px;
    text-align: center;
}

.modal-body h3 {
    font-size: 20px;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 10px;
}

.modal-body p {
    font-size: 14px;
    color: var(--text-secondary);
    line-height: 1.5;
    margin-bottom: 20px;
}

.modal-btn {
    width: 100%;
    padding: 12px 20px;
    background: var(--gradient-1);
    border: none;
    border-radius: 10px;
    color: white;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.modal-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(127, 86, 217, 0.3);
}

/* Responsive Modal */
@media (max-width: 576px) {
    .modal-system {
        padding: 16px;
    }
    
    .modal-container {
        max-width: 100%;
    }
    
    .modal-header {
        padding: 24px 20px 12px;
    }
    
    .modal-content {
        padding: 0 20px 20px;
    }
    
    .modal-footer {
        padding: 20px 20px 24px;
    }
    
    .modal-icon-container {
        width: 64px;
        height: 64px;
        margin-bottom: 16px;
    }
    
    .modal-icon {
        font-size: 24px;
    }
    
    .modal-title {
        font-size: 20px;
    }
    
    .modal-message {
        font-size: 15px;
    }
}

/* =====================================================
   REST OF THE ORIGINAL STYLES
   ===================================================== */

/* Modern Widget Titles */
.footer-widget__title {
    position: relative;
    font-size: 20px;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 30px;
    display: inline-block;
}

.title-text {
    position: relative;
    z-index: 2;
}

.title-decoration {
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 100%;
    height: 3px;
    background: var(--gradient-1);
    border-radius: 2px;
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.4s var(--ease-out-expo);
}

.footer-links:hover .title-decoration {
    transform: scaleX(1);
}

[dir="rtl"] .title-decoration {
    transform-origin: right;
}

/* Modern Menu Links */
.footer-menu {
    list-style: none;
    padding: 0;
    margin: 0;
}

.menu-item {
    margin-bottom: 15px;
    opacity: 0;
    animation: fadeInUp 0.6s var(--ease-out-expo) forwards;
    animation-delay: calc(var(--item-index) * 0.1s);
}

.menu-link {
    position: relative;
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 15px;
    color: var(--text-secondary);
    text-decoration: none;
    font-size: 15px;
    transition: all 0.3s ease;
    overflow: hidden;
    border-radius: 10px;
}

.link-icon {
    font-size: 12px;
    color: var(--primary);
    transition: transform 0.3s ease;
}

.link-hover-bg {
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: var(--gradient-1);
    opacity: 0.1;
    transition: left 0.4s var(--ease-out-expo);
}

.menu-link:hover {
    color: var(--primary);
    transform: translateX(5px);
}

[dir="rtl"] .menu-link:hover {
    transform: translateX(-5px);
}

.menu-link:hover .link-hover-bg {
    left: 0;
}

.menu-link:hover .link-icon {
    transform: translateX(3px);
}

[dir="rtl"] .menu-link:hover .link-icon {
    transform: translateX(-3px);
}

/* Modern Instagram Grid */
.instagram-modern-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
}

.instagram-card {
    position: relative;
    aspect-ratio: 1;
    border-radius: 15px;
    overflow: hidden;
    opacity: 0;
    animation: fadeInScale 0.6s var(--ease-out-expo) forwards;
    animation-delay: calc(var(--ig-index) * 0.1s);
}

.ig-image-wrapper {
    position: relative;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.ig-image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s var(--ease-out-expo);
}

.ig-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.7) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
    display: flex;
    align-items: flex-end;
    padding: 15px;
}

.ig-stats {
    display: flex;
    gap: 15px;
    color: white;
    font-size: 14px;
}

.ig-stats span {
    display: flex;
    align-items: center;
    gap: 5px;
}

.ig-glow {
    position: absolute;
    inset: -2px;
    background: var(--gradient-2);
    filter: blur(10px);
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: -1;
}

.instagram-card:hover .ig-image-wrapper img {
    transform: scale(1.1);
}

.instagram-card:hover .ig-overlay {
    opacity: 1;
}

.instagram-card:hover .ig-glow {
    opacity: 0.5;
}

/* Footer Bottom */
.footer-bottom {
    padding: 40px 0;
    padding-bottom: 10px;
}

.footer-bottom-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 30px;
}

.copyright {
    flex: 1;
}

.copyright p {
    margin: 0;
    color: var(--text-secondary);
    font-size: 0.95rem;
}

.developed-by {
    margin-top: var(--space-xs) !important;
    font-size: 0.875rem !important;
    color: var(--text-muted) !important;
}

.heart {
    color: #e53e3e;
    display: inline-block;
    animation: heartbeat 1.5s ease infinite;
}

@keyframes heartbeat {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

/* Modern Social Links */
.social-modern {
    display: flex;
    gap: 15px;
}

.social-link {
    position: relative;
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--bg-primary);
    border-radius: 12px;
    text-decoration: none;
    transition: all 0.3s ease;
    opacity: 0;
    animation: fadeInUp 0.6s var(--ease-out-expo) forwards;
    animation-delay: calc(var(--social-index) * 0.1s);
}

.social-icon {
    position: relative;
    z-index: 2;
    color: var(--text-secondary);
    font-size: 18px;
    transition: all 0.3s ease;
}

.social-tooltip {
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    padding: 8px 12px;
    background: var(--text-primary);
    color: var(--bg-primary);
    font-size: 12px;
    border-radius: 8px;
    white-space: nowrap;
    opacity: 0;
    pointer-events: none;
    transition: all 0.3s ease;
}

.social-tooltip::after {
    content: '';
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    border: 5px solid transparent;
    border-top-color: var(--text-primary);
}

.social-link:hover {
    transform: translateY(-5px);
    background: var(--gradient-1);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.social-link:hover .social-icon {
    color: white;
    transform: scale(1.1);
}

.social-link:hover .social-tooltip {
    opacity: 1;
    transform: translateX(-50%) translateY(-10px);
}

/* Back to Top Button */
.back-to-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 50px;
    height: 50px;
    background: var(--gradient-1);
    border: none;
    border-radius: 50%;
    cursor: pointer;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    z-index: 1000;
}

[dir="rtl"] .back-to-top {
    right: auto;
    left: 30px;
}

.back-to-top.visible {
    opacity: 1;
    visibility: visible;
}

.btt-arrow {
    position: relative;
    z-index: 2;
    color: white;
    font-size: 18px;
}

.btt-progress {
    position: absolute;
    inset: -3px;
}

.btt-progress svg {
    width: 100%;
    height: 100%;
    transform: rotate(-90deg);
}

.btt-progress-circle {
    fill: none;
    stroke: rgba(255, 255, 255, 0.3);
    stroke-width: 2;
    stroke-dasharray: 100;
    stroke-dashoffset: 100;
    transition: stroke-dashoffset 0.3s ease;
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInScale {
    from {
        opacity: 0;
        transform: scale(0.8);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

/* =====================================================
   RESPONSIVE DESIGN - ENHANCED
   ===================================================== */

@media (max-width: 1024px) {
    .footer-glass-wrapper {
        padding: 40px;
    }
    
    .footer-top {
        grid-template-columns: 1fr 1fr;
        gap: 40px;
    }
    
    .footer-brand {
        grid-column: span 2;
    }
    
    .newsletter-container {
        padding: 28px;
    }
}

@media (max-width: 768px) {
    .ultra-footer {
        padding: 80px 0 30px;
    }
    
    .footer-glass-wrapper {
        padding: 30px 20px;
    }
    
    .footer-top {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .footer-brand {
        grid-column: span 1;
    }
    
    .footer-bottom-content {
        flex-direction: column;
        text-align: center;
    }
    
    .newsletter-wrapper {
        flex-direction: column;
        gap: 10px;
    }
    
    .newsletter-btn {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 576px) {
    .instagram-modern-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }
    
    .back-to-top {
        bottom: 20px;
        right: 20px;
        width: 40px;
        height: 40px;
    }
    
    [dir="rtl"] .back-to-top {
        right: auto;
        left: 20px;
    }
    
    .newsletter-input {
        font-size: 16px; /* iOS zoom prevention */
        padding: 11px 14px;
    }
    
    .newsletter-btn {
        padding: 11px 16px;
        font-size: 13px;
        min-width: 90px;
    }
    
    .simple-modal {
        padding: 16px;
    }
    
    .modal-header {
        padding: 25px 16px 16px;
    }
    
    .modal-body {
        padding: 0 16px 20px;
    }
    
    .modal-icon {
        width: 50px;
        height: 50px;
        font-size: 20px;
        margin-bottom: 12px;
    }
    
    .modal-body h3 {
        font-size: 18px;
    }
    
    .modal-body p {
        font-size: 13px;
    }
}

@media (max-width: 576px) {
    .instagram-modern-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }
    
    .back-to-top {
        bottom: 20px;
        right: 20px;
        width: 40px;
        height: 40px;
    }
    
    [dir="rtl"] .back-to-top {
        right: auto;
        left: 20px;
    }
    
/* Print Styles */
@media print {
    .footer-bg-animation,
    .back-to-top,
    .instagram-modern-grid,
    .social-modern,
    .newsletter-form,
    .simple-modal {
        display: none;
    }
    
    .ultra-footer {
        background: white;
        color: black;
    }
}
</style>

<script>
    // Ultra Modern Footer JavaScript - Enhanced Version
    document.addEventListener('DOMContentLoaded', function() {
        // =====================================================
        // SIMPLE NEWSLETTER FUNCTIONALITY
        // =====================================================
        
        const newsletterForm = document.getElementById('newsletterForm');
        const newsletterInput = newsletterForm?.querySelector('.newsletter-input');
        const newsletterBtn = newsletterForm?.querySelector('.newsletter-btn');
        const simpleModal = document.getElementById('simpleModal');
        const modalBackdrop = document.getElementById('modalBackdrop');
        const modalTitle = document.getElementById('modalTitle');
        const modalMessage = document.getElementById('modalMessage');
        const modalIcon = document.getElementById('modalIcon');
        const modalClose = document.getElementById('modalClose');
        const modalBtn = document.getElementById('modalBtn');
        
        const isRtl = document.dir === 'rtl' || document.documentElement.getAttribute('dir') === 'rtl';
        
        // Simple email validation
        function validateEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        }
        
        // Simple modal system
        function showModal(type, title, message) {
            modalTitle.textContent = title;
            modalMessage.textContent = message;
            
            // Reset modal classes
            modalIcon.className = 'modal-icon';
            
            // Set icon and color based on type
            let iconHTML = '';
            switch(type) {
                case 'success':
                    iconHTML = '<i class="fas fa-check"></i>';
                    modalIcon.classList.add('success');
                    break;
                case 'error':
                    iconHTML = '<i class="fas fa-times"></i>';
                    modalIcon.classList.add('error');
                    break;
                case 'warning':
                    iconHTML = '<i class="fas fa-exclamation-triangle"></i>';
                    modalIcon.classList.add('warning');
                    break;
                case 'info':
                    iconHTML = '<i class="fas fa-info"></i>';
                    modalIcon.classList.add('info');
                    break;
                default:
                    iconHTML = '<i class="fas fa-check"></i>';
            }
            
            modalIcon.innerHTML = iconHTML;
            simpleModal.classList.add('active');
        }
        
        function closeModal() {
            simpleModal.classList.remove('active');
        }
        
        // Modal event listeners
        modalClose?.addEventListener('click', closeModal);
        modalBtn?.addEventListener('click', closeModal);
        modalBackdrop?.addEventListener('click', closeModal);
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && simpleModal?.classList.contains('active')) {
                closeModal();
            }
        });
        
        // Newsletter form submission
        if (newsletterForm) {
            newsletterForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                const email = newsletterInput.value.trim();
                const btnText = newsletterBtn.querySelector('.btn-text');
                const btnIcon = newsletterBtn.querySelector('.btn-icon');
                const btnLoading = newsletterBtn.querySelector('.btn-loading');
                const btnSuccess = newsletterBtn.querySelector('.btn-success');
                
                // Simple validation
                if (!email) {
                    showModal(
                        'warning',
                        isRtl ? 'فیلد خالی' : 'Empty Field',
                        isRtl ? 'لطفا آدرس ایمیل خود را وارد کنید.' : 'Please enter your email address.'
                    );
                    newsletterInput.focus();
                    return;
                }
                
                if (!validateEmail(email)) {
                    showModal(
                        'error',
                        isRtl ? 'ایمیل نامعتبر' : 'Invalid Email',
                        isRtl ? 'لطفا آدرس ایمیل معتبری وارد کنید.' : 'Please enter a valid email address.'
                    );
                    newsletterInput.focus();
                    return;
                }
                
                // Loading state
                newsletterBtn.disabled = true;
                newsletterBtn.classList.add('loading');
                btnText.textContent = isRtl ? 'در حال ارسال...' : 'Sending...';
                
                try {
                    const formData = new FormData();
                    formData.append('EMAIL', email);
                    
                    const response = await fetch('includes/process-newsletter.php', {
                        method: 'POST',
                        body: formData
                    });
                    
                    const responseText = await response.text();
                    
                    // Simulate processing time
                    await new Promise(resolve => setTimeout(resolve, 800));
                    
                    // Remove loading state
                    newsletterBtn.classList.remove('loading');
                    
                    if (responseText.includes('success') || response.ok) {
                        // Success state
                        newsletterBtn.classList.add('success');
                        btnText.textContent = isRtl ? 'موفق!' : 'Success!';
                        
                        showModal(
                            'success',
                            isRtl ? 'عضویت موفق!' : 'Successfully Subscribed!',
                            isRtl ? 'شما با موفقیت در خبرنامه ما عضو شدید.' 
                                : 'You have successfully subscribed to our newsletter.'
                        );
                        
                        // Reset form
                        newsletterForm.reset();
                        
                        // Reset button after delay
                        setTimeout(() => {
                            newsletterBtn.disabled = false;
                            newsletterBtn.classList.remove('success');
                            btnText.textContent = isRtl ? 'عضویت' : 'Subscribe';
                        }, 2000);
                        
                    } else if (responseText.includes('already') || responseText.includes('exists')) {
                        // Already subscribed
                        newsletterBtn.disabled = false;
                        btnText.textContent = isRtl ? 'عضویت' : 'Subscribe';
                        
                        showModal(
                            'info',
                            isRtl ? 'قبلاً عضو هستید' : 'Already Subscribed',
                            isRtl ? 'این آدرس ایمیل قبلاً در خبرنامه ما ثبت شده است.' 
                                : 'This email address is already subscribed.'
                        );
                        
                    } else {
                        throw new Error('Subscription failed');
                    }
                    
                } catch (error) {
                    console.error('Newsletter subscription error:', error);
                    
                    // Error state
                    newsletterBtn.disabled = false;
                    newsletterBtn.classList.remove('loading');
                    btnText.textContent = isRtl ? 'عضویت' : 'Subscribe';
                    
                    showModal(
                        'error',
                        isRtl ? 'خطا در اتصال' : 'Connection Error',
                        isRtl ? 'متأسفانه در ارسال درخواست مشکلی پیش آمد. لطفا دوباره تلاش کنید.' 
                            : 'Sorry, there was a problem. Please try again.'
                    );
                }
            });
        
        // =====================================================
        // ORIGINAL FUNCTIONALITY
        // =====================================================
        
        // Initialize AOS-like animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        
        // Observe all elements with data-aos
        document.querySelectorAll('[data-aos]').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'all 0.6s cubic-bezier(0.19, 1, 0.22, 1)';
            observer.observe(el);
        });
        
        // Magnetic Effect for Logo
        const magneticElements = document.querySelectorAll('.magnetic-effect');
        
        magneticElements.forEach(elem => {
            elem.addEventListener('mousemove', (e) => {
                const rect = elem.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;
                
                elem.style.transform = `translate(${x * 0.1}px, ${y * 0.1}px)`;
            });
            
            elem.addEventListener('mouseleave', () => {
                elem.style.transform = 'translate(0, 0)';
            });
        });
        
        // Enhanced Back to Top Button
        const backToTop = document.getElementById('backToTop');
        const progressCircle = document.querySelector('.btt-progress-circle');
        
        function updateScrollProgress() {
            const scrollTop = window.pageYOffset;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrollPercent = (scrollTop / docHeight) * 100;
            const dashOffset = 100 - scrollPercent;
            
            if (progressCircle) {
                progressCircle.style.strokeDashoffset = dashOffset;
            }
            
            // Show/hide button
            if (scrollTop > 300) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        }
        
        window.addEventListener('scroll', updateScrollProgress);
        window.addEventListener('resize', updateScrollProgress);
        
        if (backToTop) {
            backToTop.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }
        
        // Enhanced Parallax Effect for Background Orbs
        let ticking = false;
        function updateParallax() {
            if (!ticking) {
                requestAnimationFrame(() => {
                    const scrolled = window.pageYOffset;
                    const orbs = document.querySelectorAll('.gradient-orb');
                    
                    orbs.forEach((orb, index) => {
                        const speed = 0.5 + (index * 0.2);
                        orb.style.transform = `translateY(${scrolled * speed * 0.3}px)`;
                    });
                    
                    ticking = false;
                });
                ticking = true;
            }
        }
        
        window.addEventListener('scroll', updateParallax);
        
        // Enhanced ripple effects
        document.querySelectorAll('button, .newsletter-button, .modal-action-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                // Create ripple element
                const ripple = document.createElement('span');
                ripple.classList.add('ripple-effect');
                
                // Calculate ripple size and position
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                // Set ripple styles
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                
                // Add ripple to button
                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                
                // Remove ripple after animation
                setTimeout(() => {
                    if (ripple.parentNode) {
                        ripple.parentNode.removeChild(ripple);
                    }
                }, 600);
            });
        });
        
        // Add CSS for ripple effect
        const rippleCSS = `
            .ripple-effect {
                position: absolute;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.3);
                pointer-events: none;
                transform: scale(0);
                animation: rippleAnimation 0.6s ease-out;
                z-index: 1;
            }
            
            @keyframes rippleAnimation {
                0% {
                    transform: scale(0);
                    opacity: 1;
                }
                100% {
                    transform: scale(1);
                    opacity: 0;
                }
            }
        `;
        
        const rippleStyle = document.createElement('style');
        rippleStyle.textContent = rippleCSS;
        document.head.appendChild(rippleStyle);
        
        console.log('Enhanced Footer JavaScript loaded successfully!');
    });
</script>