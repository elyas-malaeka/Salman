<?php
/**
 * Minimal Enhanced Footer for Salman Educational Complex
 * 
 * Features:
 * - Database-driven content
 * - Multi-language support (FA, EN, AR)
 * - Subtle animations and improved aesthetics
 * - Original color scheme preserved
 * 
 * @package Salman Educational Complex
 * @version 1.5
 */

// Include footer helper functions
require_once 'includes/footer_helpers.php';

// Get current language
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';
$isRtl = ($lang == 'fa' || $lang == 'ar');

// Get Instagram posts from database
$instagram_posts = getInstagramPosts($lang);
?>

<footer class="brix-footer">
    <div class="container">
        <!-- Footer Top Section -->
        <div class="footer-top">
            <!-- Logo and Description -->
            <div class="footer-brand">
                <a href="index.php" class="footer-logo">
                    <!-- Different logo based on language -->
                    <?php if($isRtl): ?>
                    <img src="<?php echo getFooterContent('logo_path_rtl', $lang); ?>" alt="<?php echo getFooterContent('site_name', $lang); ?>" class="logo-image">
                    <?php else: ?>
                    <img src="<?php echo getFooterContent('logo_path_ltr', $lang); ?>" alt="<?php echo getFooterContent('site_name', $lang); ?>" class="logo-image">
                    <?php endif; ?>
                </a>
                <p class="footer-description">
                    <?php echo getFooterContent('school_description', $lang); ?>
                </p>
                
                <!-- Enhanced Newsletter Subscribe -->
                <form action="includes/process-newsletter.php" method="post" class="footer-form">
                    <div class="input-container">
                        <input type="email" name="EMAIL" placeholder="<?php echo getFooterContent('email_placeholder', $lang); ?>" required>
                        <button type="submit" class="subscribe-btn">
                            <span class="btn-text"><?php echo getFooterContent('subscribe_button', $lang); ?></span>
                            <span class="btn-icon"><i class="far fa-paper-plane"></i></span>
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Quick Links Column -->
            <div class="footer-links">
                <h2 class="footer-widget__title"><?php echo getFooterContent('quick_links_title', $lang); ?></h2>
                <ul class="list-unstyled footer-widget__links">
                    <?php
                    $quickLinks = getFooterLinks('quick_links', $lang);
                    foreach($quickLinks as $link):
                    ?>
                    <li>
                        <a href="<?php echo $link['url']; ?>">
                            <i class="fa fa-angle-<?php echo $isRtl ? 'left' : 'right'; ?>"></i>
                            <?php echo $link['title']; ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <!-- Curriculum Links Column -->
            <div class="footer-links">
                <h2 class="footer-widget__title"><?php echo getFooterContent('curriculum_title', $lang); ?></h2>
                <ul class="list-unstyled footer-widget__links">
                    <?php
                    $curriculumLinks = getFooterLinks('curriculum_links', $lang);
                    foreach($curriculumLinks as $link):
                    ?>
                    <li>
                        <a href="<?php echo $link['url']; ?>">
                            <i class="fa fa-angle-<?php echo $isRtl ? 'left' : 'right'; ?>"></i>
                            <?php echo $link['title']; ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <!-- Instagram Feed with Subtle Hover Effect -->
            <div class="footer-links">
                <h2 class="footer-widget__title"><?php echo getFooterContent('instagram_title', $lang); ?></h2>
                <div class="instagram-grid">
                    <?php foreach($instagram_posts as $post): ?>
                    <a href="<?php echo $post['link']; ?>" target="_blank" class="instagram-item">
                        <img src="<?php echo $post['image']; ?>" alt="Instagram Post" loading="lazy">
                        <div class="instagram-overlay">
                            <i class="fab fa-instagram"></i>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        
        <!-- Footer Divider -->
        <div class="footer-divider"></div>
        
        <!-- Footer Bottom Section -->
        <div class="footer-bottom">
            <p class="copyright">
                <?php echo getFooterContent('copyright_text', $lang); ?> &copy; <?php echo date('Y'); ?>
            </p>
            
            <!-- Social Icons with Subtle Animation -->
            <div class="social-icons">
                <?php
                $socialLinks = getSocialLinks($lang);
                foreach($socialLinks as $social):
                ?>
                <a href="<?php echo $social['url']; ?>" class="social-icon" target="_blank" aria-label="<?php echo $social['name']; ?>">
                    <i class="fab fa-<?php echo $social['icon']; ?>"></i>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</footer>

<!-- Newsletter Success Popup -->
<div class="newsletter-popup" id="newsletterPopup">
    <div class="popup-content">
        <div class="popup-icon" id="popupIcon">
            <i class="fas fa-check"></i>
        </div>
        <h3 class="popup-title" id="popupTitle"></h3>
        <p class="popup-message" id="popupMessage"></p>
        <button class="popup-close" id="popupClose"><?php echo getFooterContent('close_button', $lang); ?></button>
    </div>
</div>
<div class="popup-overlay" id="popupOverlay"></div>

<style>
/* ==================
   Font Imports
   ================== */
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

/* ==================
   Custom Properties
   ================== */
:root {
    --primary-color: #6941C6;
    --secondary-color: #4E36B1;
    --accent-color: #7F56D9;
    --accent-light: #9E77ED;
    --text-color: #333;
    --text-light: #666;
    --bg-light: #f8f9fa;
    --white: #ffffff;
    --yellow-light: #FEC84B;
    --yellow: #F79009;
    --transition-fast: 0.2s ease;
    --transition-normal: 0.3s ease;
    --shadow-sm: 0 1px 3px rgba(0,0,0,0.1);
    --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
}

/* ==================
   Enhanced Brix Footer with Minimalist Design
   ================== */

/* Base Styles */
.brix-footer {
    font-family: 'Arial', sans-serif;
    background-color: var(--bg-light);
    color: var(--text-light);
    padding: 80px 0 40px;
    position: relative;
}

[dir="rtl"] .brix-footer {
    font-family: 'Vazir', Arial, sans-serif; /* Use Vazir font for RTL */
}

.container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Footer Top Section */
.footer-top {
    display: grid;
    grid-template-columns: 1.5fr 1fr 1fr 1fr;
    gap: 40px;
}

/* Logo and Description with Subtle Animation */
.footer-brand {
    padding-right: 40px;
}

.footer-logo {
    display: inline-block;
    margin-bottom: 20px;
    transition: transform var(--transition-normal);
}

.footer-logo:hover {
    transform: translateY(-3px);
}

.logo-image {
    max-height: 40px;
    width: auto;
}

.footer-description {
    font-size: 16px;
    line-height: 1.6;
    color: var(--text-light);
    margin-bottom: 25px;
}

/* Enhanced Newsletter Form with Minimal Design */
.footer-form {
    position: relative;
    max-width: 400px;
    margin-bottom: 30px;
}

.input-container {
    position: relative;
    display: flex;
    align-items: center;
}

.footer-form input {
    width: 100%;
    height: 50px;
    padding: 0 110px 0 20px;
    background-color: var(--white);
    border: 1px solid #e2e8f0;
    border-radius: 25px;
    font-size: 14px;
    color: var(--text-color);
    transition: border-color var(--transition-fast), box-shadow var(--transition-fast);
}

[dir="rtl"] .footer-form input {
    padding: 0 20px 0 110px;
}

.footer-form input:focus {
    outline: none;
    border-color: var(--accent-color);
    box-shadow: 0 0 0 3px rgba(127, 86, 217, 0.2);
}

.subscribe-btn {
    position: absolute;
    right: 5px;
    top: 5px;
    height: 40px;
    padding: 0 20px;
    background-color: var(--accent-color);
    color: white;
    border: none;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color var(--transition-fast), transform var(--transition-fast);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

[dir="rtl"] .subscribe-btn {
    right: auto;
    left: 5px;
}

.subscribe-btn:hover {
    background-color: var(--accent-light);
    transform: translateY(-2px);
}

.btn-text {
    margin-right: 5px;
    transition: transform var(--transition-fast);
}

[dir="rtl"] .btn-text {
    margin-right: 0;
    margin-left: 5px;
}

.btn-icon {
    display: inline-flex;
    transition: transform var(--transition-normal);
}

.subscribe-btn:hover .btn-icon {
    transform: translateX(3px);
}

[dir="rtl"] .subscribe-btn:hover .btn-icon {
    transform: translateX(-3px) scaleX(-1);
}

/* Footer Titles with Animated Underline */
.footer-widget__title {
    font-size: 18px;
    font-weight: 600;
    color: var(--primary-color);
    margin-bottom: 20px;
    position: relative;
    padding-bottom: 10px;
}

.footer-widget__title:after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 50px;
    height: 2px;
    background-color: var(--accent-color);
    transition: width var(--transition-normal);
}

[dir="rtl"] .footer-widget__title:after {
    left: auto;
    right: 0;
}

.footer-links:hover .footer-widget__title:after {
    width: 70px;
}

/* Footer Links with Subtle Hover Effect */
.list-unstyled {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-widget__links li {
    margin-bottom: 12px;
    position: relative;
    transition: transform var(--transition-normal);
}

.footer-widget__links li a {
    color: var(--text-light);
    text-decoration: none;
    font-size: 14px;
    transition: color var(--transition-fast);
    display: flex;
    align-items: center;
}

.footer-widget__links li:hover {
    transform: translateX(5px);
}

[dir="rtl"] .footer-widget__links li:hover {
    transform: translateX(-5px);
}

.footer-widget__links li a:hover {
    color: var(--primary-color);
}

.footer-widget__links li a i {
    margin-right: 8px;
    font-size: 12px;
    color: var(--accent-color);
    transition: color var(--transition-fast);
}

[dir="rtl"] .footer-widget__links li a i {
    margin-right: 0;
    margin-left: 8px;
}

/* Enhanced Instagram Grid */
.instagram-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
}

.instagram-item {
    position: relative;
    display: block;
    border-radius: 8px;
    overflow: hidden;
    transition: transform var(--transition-normal);
}

.instagram-item img {
    width: 100%;
    height: 80px;
    object-fit: cover;
    display: block;
    transition: transform var(--transition-normal);
}

.instagram-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(105, 65, 198, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity var(--transition-normal);
}

.instagram-overlay i {
    color: white;
    font-size: 20px;
    transform: scale(0.8);
    transition: transform var(--transition-normal);
}

.instagram-item:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-md);
}

.instagram-item:hover img {
    transform: scale(1.1);
}

.instagram-item:hover .instagram-overlay {
    opacity: 1;
}

.instagram-item:hover .instagram-overlay i {
    transform: scale(1);
}

/* Footer Divider */
.footer-divider {
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--accent-light), transparent);
    margin: 40px 0;
    opacity: 0.5;
}

/* Footer Bottom */
.footer-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
}

.copyright {
    font-size: 14px;
    color: var(--text-light);
    margin: 0;
}

/* Social Icons with Subtle Hover Effect */
.social-icons {
    display: flex;
    gap: 15px;
}

.social-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    background-color: rgba(127, 86, 217, 0.1);
    border-radius: 50%;
    color: var(--primary-color);
    text-decoration: none;
    transition: all var(--transition-normal);
}

.social-icon:hover {
    background-color: var(--accent-color);
    color: white;
    transform: translateY(-3px);
    box-shadow: var(--shadow-md);
}

/* Enhanced Newsletter Popup */
.newsletter-popup {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0.95);
    background-color: white;
    width: 90%;
    max-width: 400px;
    border-radius: 10px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    z-index: 1001;
    overflow: hidden;
    display: none;
    opacity: 0;
    transition: all var(--transition-normal);
}

.popup-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(3px);
    z-index: 1000;
    display: none;
    opacity: 0;
    transition: opacity var(--transition-normal);
}

.popup-content {
    padding: 30px;
    text-align: center;
}

.popup-icon {
    width: 70px;
    height: 70px;
    margin: 0 auto 20px;
    background-color: rgba(127, 86, 217, 0.1);
    color: var(--accent-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 30px;
}

.popup-icon.error {
    background-color: rgba(220, 38, 38, 0.1);
    color: #dc2626;
}

.popup-icon.info {
    background-color: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
}

.popup-title {
    font-size: 20px;
    font-weight: 600;
    color: var(--text-color);
    margin-bottom: 10px;
}

.popup-message {
    font-size: 16px;
    color: var(--text-light);
    margin-bottom: 20px;
    line-height: 1.5;
}

.popup-close {
    background-color: var(--accent-color);
    color: white;
    border: none;
    padding: 10px 25px;
    border-radius: 25px;
    font-size: 15px;
    font-weight: 500;
    cursor: pointer;
    transition: all var(--transition-normal);
}

.popup-close:hover {
    background-color: var(--accent-light);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

/* Animation Classes */
.fade-in {
    animation: fadeIn 0.3s forwards;
}

.slide-up {
    animation: slideUp 0.3s forwards;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideUp {
    from { 
        opacity: 0;
        transform: translate(-50%, -45%) scale(0.95);
    }
    to { 
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
    }
}

/* RTL Support */
[dir="rtl"] .footer-brand {
    padding-right: 0;
    padding-left: 40px;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .footer-top {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .footer-brand {
        grid-column: span 2;
        padding-right: 0;
    }
    
    [dir="rtl"] .footer-brand {
        padding-left: 0;
    }
}

@media (max-width: 768px) {
    .brix-footer {
        padding: 60px 0 30px;
    }
    
    .footer-top {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .footer-brand {
        grid-column: span 1;
    }
    
    .footer-bottom {
        flex-direction: column;
        text-align: center;
    }
}

@media (max-width: 576px) {
    .brix-footer {
        padding: 40px 0 20px;
    }
    
    .footer-form {
        margin-bottom: 40px;
    }
    
    .instagram-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .instagram-item img {
        height: 120px;
    }
}
</style>

<script>
// Newsletter form with AJAX submission and minimal animations
document.addEventListener('DOMContentLoaded', function() {
    const newsletterForm = document.querySelector('.footer-form');
    const popup = document.getElementById('newsletterPopup');
    const popupOverlay = document.getElementById('popupOverlay');
    const popupClose = document.getElementById('popupClose');
    const popupTitle = document.getElementById('popupTitle');
    const popupMessage = document.getElementById('popupMessage');
    const popupIcon = document.getElementById('popupIcon');
    
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = this.querySelector('input[name="EMAIL"]').value;
            const isRtl = document.dir === 'rtl';
            
            // Validate email
            if (!validateEmail(email)) {
                showPopup(
                    'error',
                    isRtl ? 'خطا در ایمیل' : 'Invalid Email',
                    isRtl ? 'لطفا یک آدرس ایمیل معتبر وارد کنید.' : 'Please enter a valid email address.'
                );
                return;
            }
            
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.querySelector('.btn-text').textContent;
            submitBtn.disabled = true;
            submitBtn.querySelector('.btn-text').textContent = isRtl ? 'در حال ارسال...' : 'Sending...';
            submitBtn.querySelector('.btn-icon').innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            
            // Prepare form data
            const formData = new FormData();
            formData.append('EMAIL', email);
            
            // Send AJAX request
            fetch('includes/process-newsletter.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Reset button state
                submitBtn.disabled = false;
                submitBtn.querySelector('.btn-text').textContent = originalBtnText;
                submitBtn.querySelector('.btn-icon').innerHTML = '<i class="far fa-paper-plane"></i>';
                
                // Check response and show appropriate message
                if (data.includes('success')) {
                    showPopup(
                        'success',
                        isRtl ? 'با موفقیت انجام شد!' : 'Success!',
                        isRtl ? 'شما با موفقیت در خبرنامه ما عضو شدید.' : 'You have successfully subscribed to our newsletter.'
                    );
                    newsletterForm.reset();
                } 
                else if (data.includes('already') || data.includes('exists')) {
                    showPopup(
                        'info',
                        isRtl ? 'اطلاع‌رسانی' : 'Notice',
                        isRtl ? 'این ایمیل قبلاً در خبرنامه ما ثبت شده است.' : 'This email is already subscribed to our newsletter.'
                    );
                }
                else {
                    showPopup(
                        'error',
                        isRtl ? 'خطا در ثبت‌نام' : 'Subscription Error',
                        isRtl ? 'متأسفانه مشکلی در ثبت‌نام شما پیش آمد. لطفاً بعداً دوباره تلاش کنید.' : 'There was a problem with your subscription. Please try again later.'
                    );
                    console.error('Server response:', data);
                }
            })
            .catch(error => {
                // Reset button state on error
                submitBtn.disabled = false;
                submitBtn.querySelector('.btn-text').textContent = originalBtnText;
                submitBtn.querySelector('.btn-icon').innerHTML = '<i class="far fa-paper-plane"></i>';
                
                // Show error message
                showPopup(
                    'error',
                    isRtl ? 'خطای ارتباط' : 'Connection Error',
                    isRtl ? 'ارتباط با سرور برقرار نشد. لطفاً اتصال اینترنت خود را بررسی کنید.' : 'Could not connect to the server. Please check your internet connection.'
                );
                console.error('Error:', error);
            });
        });
    }
    
    // Close popup with close button
    if (popupClose) {
        popupClose.addEventListener('click', closePopup);
    }
    
    // Close popup with overlay click
    if (popupOverlay) {
        popupOverlay.addEventListener('click', closePopup);
    }
    
    // Close popup with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && popup.style.display === 'block') {
            closePopup();
        }
    });
    
    /**
     * Show popup with subtle animation
     */
    function showPopup(type, title, message) {
        // Set icon and styles based on message type
        if (type === 'error') {
            popupIcon.innerHTML = '<i class="fas fa-times"></i>';
            popupIcon.className = 'popup-icon error';
        } else if (type === 'info') {
            popupIcon.innerHTML = '<i class="fas fa-info"></i>';
            popupIcon.className = 'popup-icon info';
        } else {
            popupIcon.innerHTML = '<i class="fas fa-check"></i>';
            popupIcon.className = 'popup-icon';
        }
        
        // Set title and message text
        popupTitle.textContent = title;
        popupMessage.textContent = message;
        
        // Show popup and overlay
        popupOverlay.style.display = 'block';
        popup.style.display = 'block';
        
        // Trigger animations
        setTimeout(() => {
            popupOverlay.style.opacity = '1';
            popup.style.opacity = '1';
            popup.style.transform = 'translate(-50%, -50%) scale(1)';
        }, 10);
    }
    
    /**
     * Close popup with subtle animation
     */
    function closePopup() {
        popupOverlay.style.opacity = '0';
        popup.style.opacity = '0';
        popup.style.transform = 'translate(-50%, -50%) scale(0.95)';
        
        setTimeout(() => {
            popup.style.display = 'none';
            popupOverlay.style.display = 'none';
        }, 300);
    }
    
    /**
     * Validate email format
     */
    function validateEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
});
</script>

