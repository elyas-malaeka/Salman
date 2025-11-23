/**
 * اسکریپت صفحه حریم خصوصی - مجتمع آموزشی سلمان فارسی
 * نسخه بازنویسی شده کامل با ساختاربندی مناسب
 * 
 * @version 4.1
 * @author Salman Farsi Educational Complex
 */

(function() {
    'use strict';
    
    // متغیرهای عمومی
    let lang = document.documentElement.getAttribute('lang') || 'fa';
    let rtl = document.documentElement.getAttribute('dir') === 'rtl';
    
    // شروع اجرا پس از بارگذاری کامل صفحه
    document.addEventListener('DOMContentLoaded', function() {
        console.log('🚀 Privacy Policy Script Initialized');
        
        // فراخوانی توابع اصلی
        createCosmicBackground();
        initTableOfContents();
        initBackToTop();
        initFAQAccordion();
        initCookieSettings();
        initAnimationOnScroll();
        makeTableResponsive();
        
        // گزارش موفقیت اجرا
        console.log('✅ All privacy page scripts loaded successfully');
    });
    
    /**
     * ایجاد پس‌زمینه کیهانی با ستاره‌ها
     */
    function createCosmicBackground() {
        const cosmicBg = document.querySelector('.cosmic-bg');
        if (!cosmicBg) return;
        
        console.log('🌠 Creating cosmic background');
        
        // افزودن ستاره‌های تصادفی به پس‌زمینه
        for (let i = 0; i < 100; i++) {
            const size = Math.random() * 3 + 1;
            const opacity = Math.random() * 0.8 + 0.2;
            const posX = Math.random() * 100;
            const posY = Math.random() * 100;
            const duration = Math.random() * 4 + 3;
            const delay = Math.random() * 5;
            
            const star = document.createElement('div');
            star.className = 'cosmic-star';
            star.style.width = `${size}px`;
            star.style.height = `${size}px`;
            star.style.opacity = opacity;
            star.style.top = `${posY}%`;
            star.style.left = `${posX}%`;
            star.style.animationDuration = `${duration}s`;
            star.style.animationDelay = `${delay}s`;
            
            cosmicBg.appendChild(star);
        }
        
        // افزودن ستاره‌های شهابی
        const shootingStar1 = document.createElement('div');
        shootingStar1.className = 'shooting-star';
        shootingStar1.style.top = '30%';
        shootingStar1.style.left = '-10%';
        shootingStar1.style.animationDelay = '2s';
        
        const shootingStar2 = document.createElement('div');
        shootingStar2.className = 'shooting-star';
        shootingStar2.style.top = '70%';
        shootingStar2.style.left = '-5%';
        shootingStar2.style.animationDelay = '5s';
        
        cosmicBg.appendChild(shootingStar1);
        cosmicBg.appendChild(shootingStar2);
        
        console.log('✨ Cosmic background created');
    }
    
    /**
     * مدیریت فهرست مطالب
     */
    function initTableOfContents() {
        const tocLinks = document.querySelectorAll('.privacy-toc__link');
        const sections = document.querySelectorAll('.privacy-block');
        
        if (!tocLinks.length || !sections.length) {
            console.warn('⚠️ TOC links or sections not found');
            return;
        }
        
        console.log('📚 Initializing table of contents');
        
        // مدیریت کلیک روی لینک‌های فهرست
        tocLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                const targetSection = document.querySelector(targetId);
                
                if (targetSection) {
                    const headerOffset = 100;
                    const sectionPosition = targetSection.getBoundingClientRect().top;
                    const offsetPosition = sectionPosition + window.pageYOffset - headerOffset;
                    
                    // اسکرول نرم به بخش هدف
                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                    
                    // به‌روزرسانی هش URL بدون اسکرول
                    if (history.pushState) {
                        history.pushState(null, null, targetId);
                    } else {
                        location.hash = targetId;
                    }
                    
                    // به‌روزرسانی حالت فعال در فهرست
                    tocLinks.forEach(link => link.classList.remove('active'));
                    this.classList.add('active');
                    
                    console.log('🔍 Scrolled to section:', targetId);
                }
            });
        });
        
        // به‌روزرسانی لینک فعال فهرست هنگام اسکرول
        window.addEventListener('scroll', function() {
            const scrollPosition = window.scrollY;
            
            // یافتن بخش قابل مشاهده فعلی
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 150;
                const sectionHeight = section.offsetHeight;
                const sectionBottom = sectionTop + sectionHeight;
                
                if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
                    const sectionId = section.getAttribute('id');
                    
                    // به‌روزرسانی حالت فعال در فهرست
                    tocLinks.forEach(link => {
                        link.classList.remove('active');
                        if (link.getAttribute('href') === `#${sectionId}`) {
                            link.classList.add('active');
                        }
                    });
                }
            });
        });
        
        console.log('✅ Table of contents initialized');
    }
    
    /**
     * دکمه بازگشت به بالا
     */
    function initBackToTop() {
        const backToTop = document.querySelector('.back-to-top');
        
        if (!backToTop) {
            console.warn('⚠️ Back to top button not found');
            return;
        }
        
        console.log('🔼 Initializing back to top button');
        
        // نمایش/مخفی کردن دکمه بر اساس موقعیت اسکرول
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        });
        
        // مدیریت کلیک روی دکمه
        backToTop.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
            console.log('🔝 Back to top clicked');
        });
        
        console.log('✅ Back to top button initialized');
    }
    
    /**
     * بخش سوالات متداول (FAQ)
     */
    function initFAQAccordion() {
        const faqItems = document.querySelectorAll('.privacy-faq-item');
        
        if (!faqItems.length) {
            console.warn('⚠️ No FAQ items found');
            return;
        }
        
        console.log('❓ Initializing FAQ accordion with', faqItems.length, 'items');
        
        // بازنویسی کامل رفتار FAQ برای جلوگیری از هرگونه تداخل
        faqItems.forEach((item, index) => {
            // پیدا کردن سوال و پاسخ در هر آیتم
            const question = item.querySelector('.privacy-faq-question');
            const answer = item.querySelector('.privacy-faq-answer');
            
            if (!question || !answer) {
                console.error('❌ FAQ item #' + (index + 1) + ' is missing question or answer element');
                return;
            }
            
            // اطمینان از مخفی بودن پاسخ‌ها
            answer.style.display = 'none';
            
            // افزودن شناسه منحصر به فرد
            const uniqueId = 'faq-' + (index + 1);
            question.setAttribute('data-faq-id', uniqueId);
            answer.setAttribute('data-faq-id', uniqueId);
            
            // حذف هرگونه رویداد کلیک قبلی
            question.onclick = null;
            
            // افزودن رویداد کلیک جدید
            question.addEventListener('click', function(e) {
                // جلوگیری از رفتار پیش‌فرض و حباب‌سازی
                e.preventDefault();
                e.stopPropagation();
                
                const isOpen = answer.style.display === 'block';
                
                // بستن تمام پاسخ‌ها
                document.querySelectorAll('.privacy-faq-answer').forEach(ans => {
                    ans.style.display = 'none';
                });
                
                // برداشتن کلاس active از تمام سوالات
                document.querySelectorAll('.privacy-faq-question').forEach(q => {
                    q.classList.remove('active');
                });
                
                // تغییر همه آیکون‌ها به حالت +
                document.querySelectorAll('.faq-icon i').forEach(icon => {
                    icon.className = 'fas fa-plus';
                });
                
                // اگر بسته است، باز کن
                if (!isOpen) {
                    answer.style.display = 'block';
                    question.classList.add('active');
                    
                    // تغییر آیکون به -
                    const icon = question.querySelector('.faq-icon i');
                    if (icon) {
                        icon.className = 'fas fa-minus';
                    }
                    
                    console.log('📖 Opened FAQ #' + (index + 1));
                }
            });
            
            // اطمینان از داشتن نشانگر دست
            question.style.cursor = 'pointer';
        });
        
        console.log('✅ FAQ accordion initialized');
    }
    
    /**
     * مدیریت تنظیمات کوکی
     */
    function initCookieSettings() {
        // مدیریت المان‌ها
        const essentialCookieCheckbox = document.getElementById('essential-cookies');
        const preferenceCookieCheckbox = document.getElementById('preference-cookies');
        const analyticsCookieCheckbox = document.getElementById('analytics-cookies');
        
        const saveSettingsBtn = document.getElementById('save-cookie-settings');
        const rejectAllBtn = document.getElementById('reject-all-cookies');
        const acceptAllBtn = document.getElementById('accept-all-cookies');
        
        // بررسی وجود المان‌ها برای اطمینان از عدم خطا
        if (!essentialCookieCheckbox || !preferenceCookieCheckbox || !analyticsCookieCheckbox) {
            console.warn('⚠️ Cookie checkboxes not found');
            return;
        }
        
        if (!saveSettingsBtn || !rejectAllBtn || !acceptAllBtn) {
            console.warn('⚠️ Cookie setting buttons not found');
            return;
        }
        
        console.log('🍪 Initializing cookie settings');
        
        // بارگذاری تنظیمات ذخیره شده در زمان بارگذاری صفحه
        loadCookieSettings();
        
        // تنظیم رویدادهای کلیک برای دکمه‌ها
        saveSettingsBtn.addEventListener('click', function() {
            saveCookieSettings();
            showToast(getLocalizedText('settings_saved'));
        });
        
        rejectAllBtn.addEventListener('click', function() {
            // تغییر تنظیمات
            preferenceCookieCheckbox.checked = false;
            analyticsCookieCheckbox.checked = false;
            
            saveCookieSettings();
            showToast(getLocalizedText('cookies_rejected'));
        });
        
        acceptAllBtn.addEventListener('click', function() {
            // تغییر تنظیمات
            preferenceCookieCheckbox.checked = true;
            analyticsCookieCheckbox.checked = true;
            
            saveCookieSettings();
            showToast(getLocalizedText('cookies_accepted'));
        });
        
        console.log('✅ Cookie settings initialized');
    }
    
    /**
     * ذخیره تنظیمات کوکی در localStorage
     */
    function saveCookieSettings() {
        try {
            const preferenceCookieCheckbox = document.getElementById('preference-cookies');
            const analyticsCookieCheckbox = document.getElementById('analytics-cookies');
            
            // کوکی‌های ضروری همیشه فعال هستند
            const cookieSettings = {
                essential: true,
                preference: preferenceCookieCheckbox.checked,
                analytics: analyticsCookieCheckbox.checked,
                timestamp: new Date().toISOString()
            };
            
            // ذخیره در localStorage
            localStorage.setItem('cookieSettings', JSON.stringify(cookieSettings));
            console.log('💾 Cookie settings saved:', cookieSettings);
            
            // اعمال واقعی تنظیمات کوکی
            applyCookieSettings(cookieSettings);
            
            return true;
        } catch (error) {
            console.error('❌ Error saving cookie settings:', error);
            return false;
        }
    }
    
    /**
     * بارگیری تنظیمات کوکی از localStorage
     */
    function loadCookieSettings() {
        try {
            const settings = localStorage.getItem('cookieSettings');
            const essentialCookieCheckbox = document.getElementById('essential-cookies');
            const preferenceCookieCheckbox = document.getElementById('preference-cookies');
            const analyticsCookieCheckbox = document.getElementById('analytics-cookies');
            
            // اگر تنظیمات وجود نداشت، حالت پیش‌فرض
            if (!settings) {
                console.log('ℹ️ No saved cookie settings found, using defaults');
                
                // حالت پیش‌فرض: فقط کوکی‌های ضروری
                preferenceCookieCheckbox.checked = false;
                analyticsCookieCheckbox.checked = false;
                
                // ذخیره تنظیمات پیش‌فرض
                saveCookieSettings();
                return false;
            }
            
            // تبدیل JSON به آبجکت
            const cookieSettings = JSON.parse(settings);
            console.log('📥 Loaded cookie settings:', cookieSettings);
            
            // اعمال تنظیمات به چک‌باکس‌ها
            essentialCookieCheckbox.checked = true; // همیشه فعال
            preferenceCookieCheckbox.checked = cookieSettings.preference === true;
            analyticsCookieCheckbox.checked = cookieSettings.analytics === true;
            
            // اعمال تنظیمات به کوکی‌ها
            applyCookieSettings(cookieSettings);
            
            return true;
        } catch (error) {
            console.error('❌ Error loading cookie settings:', error);
            return false;
        }
    }
    
    /**
     * اعمال تنظیمات کوکی‌ها (حذف کوکی‌های غیرمجاز)
     */
    function applyCookieSettings(settings) {
        try {
            // اگر کوکی‌های ترجیحات مجاز نیستند، آنها را حذف کنید
            if (!settings.preference) {
                deleteCookiesByPrefix('pref_');
                console.log('🗑️ Preference cookies removed');
            }
            
            // اگر کوکی‌های تحلیلی مجاز نیستند، آنها را حذف کنید
            if (!settings.analytics) {
                deleteCookiesByPrefix('_ga');
                deleteCookiesByPrefix('_gid');
                deleteCookiesByPrefix('_gat');
                console.log('🗑️ Analytics cookies removed');
            }
            
            console.log('✅ Cookie settings applied');
        } catch (error) {
            console.error('❌ Error applying cookie settings:', error);
        }
    }
    
    /**
     * حذف کوکی‌ها بر اساس پیشوند
     */
    function deleteCookiesByPrefix(prefix) {
        const cookies = document.cookie.split(';');
        
        for (let i = 0; i < cookies.length; i++) {
            const cookie = cookies[i].trim();
            const cookieName = cookie.split('=')[0].trim();
            
            if (cookieName.indexOf(prefix) === 0) {
                // حذف کوکی‌ها با تنظیم تاریخ انقضا در گذشته
                document.cookie = cookieName + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
                
                // برای دامنه‌های مختلف
                const domain = window.location.hostname;
                document.cookie = cookieName + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=' + domain + ';';
                document.cookie = cookieName + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=.' + domain + ';';
                
                console.log('🗑️ Cookie deleted:', cookieName);
            }
        }
    }
    
    /**
     * نمایش پیام toast
     */
    function showToast(message) {
        // ایجاد یا یافتن المان toast
        let toast = document.querySelector('.privacy-toast');
        
        if (!toast) {
            toast = document.createElement('div');
            toast.className = 'privacy-toast';
            document.body.appendChild(toast);
        }
        
        // تنظیم متن و نمایش
        toast.textContent = message;
        toast.classList.add('show');
        
        // مخفی کردن بعد از 3 ثانیه
        setTimeout(function() {
            toast.classList.remove('show');
        }, 3000);
        
        console.log('📢 Toast shown:', message);
    }
    
    /**
     * انیمیشن با اسکرول
     */
    function initAnimationOnScroll() {
        const animatedElements = document.querySelectorAll('.privacy-block, .privacy-header__content');
        
        if (!animatedElements.length) {
            console.warn('⚠️ No animated elements found');
            return;
        }
        
        console.log('🔄 Initializing animation on scroll');
        
        // تابع بررسی اینکه آیا المان در viewport است
        function isElementInViewport(element) {
            const rect = element.getBoundingClientRect();
            return (rect.top <= window.innerHeight - 100);
        }
        
        // بررسی تمام المان‌ها هنگام اسکرول
        function checkElements() {
            animatedElements.forEach(element => {
                if (isElementInViewport(element) && !element.classList.contains('animated')) {
                    element.classList.add('animated');
                }
            });
        }
        
        // بررسی اولیه در هنگام بارگذاری صفحه
        checkElements();
        
        // بررسی هنگام اسکرول
        window.addEventListener('scroll', checkElements);
        
        console.log('✅ Animation on scroll initialized');
    }
    
    /**
     * پاسخگو کردن جداول
     */
    function makeTableResponsive() {
        const tables = document.querySelectorAll('.privacy-cookies-table');
        
        if (!tables.length) {
            console.warn('⚠️ No tables found to make responsive');
            return;
        }
        
        console.log('📱 Making tables responsive');
        
        function applyResponsive() {
            tables.forEach(table => {
                if (window.innerWidth < 768 && !table.classList.contains('responsive-table')) {
                    table.classList.add('responsive-table');
                    
                    // یافتن متن هدرها
                    const headerCells = table.querySelectorAll('.privacy-cookies-header .privacy-cookies-cell');
                    const headerTexts = Array.from(headerCells).map(cell => cell.textContent);
                    
                    // افزودن data-title به سلول‌ها
                    const rows = table.querySelectorAll('.privacy-cookies-row:not(.privacy-cookies-header)');
                    rows.forEach(row => {
                        const cells = row.querySelectorAll('.privacy-cookies-cell');
                        cells.forEach((cell, index) => {
                            if (headerTexts[index]) {
                                cell.setAttribute('data-title', headerTexts[index]);
                            }
                        });
                    });
                    
                    console.log('📊 Table made responsive:', table);
                }
            });
        }
        
        // اعمال در ابتدا و هنگام تغییر اندازه
        applyResponsive();
        window.addEventListener('resize', applyResponsive);
        
        console.log('✅ Responsive tables initialized');
    }
    
    /**
     * متن‌های محلی‌سازی شده
     */
    function getLocalizedText(key) {
        const translations = {
            'settings_saved': {
                'fa': 'تنظیمات با موفقیت ذخیره شد',
                'en': 'Settings saved successfully',
                'ar': 'تم حفظ الإعدادات بنجاح'
            },
            'cookies_rejected': {
                'fa': 'کوکی‌های غیرضروری رد شدند',
                'en': 'Non-essential cookies rejected',
                'ar': 'تم رفض ملفات تعريف الارتباط غير الأساسية'
            },
            'cookies_accepted': {
                'fa': 'همه کوکی‌ها پذیرفته شدند',
                'en': 'All cookies accepted',
                'ar': 'تم قبول جميع ملفات تعريف الارتباط'
            }
        };
        
        return (translations[key] && translations[key][lang]) || translations[key]['en'];
    }
})();


jQuery(document).ready(function($) {
    
    // فقط در دسکتاپ اجرا شود (صفحه‌های بزرگتر از 991 پیکسل)
    if ($(window).width() > 991) {
        
        // عناصر مورد نیاز
        const $toc = $('.privacy-toc');
        const $content = $('.privacy-policy-content');
        const $footer = $('footer');
        
        // تنظیمات اولیه
        let tocHeight = $toc.outerHeight();
        let tocTopOffset = $toc.offset().top;
        let contentBottomOffset = $content.offset().top + $content.outerHeight();
        let footerTopOffset = $footer.length ? $footer.offset().top : $(document).height();
        let headerHeight = 100; // فاصله بالای صفحه که می‌خواهیم سایدبار از آن فاصله داشته باشد
        
        // آپدیت متغیرها در هنگام تغییر اندازه صفحه
        $(window).on('resize', function() {
            tocHeight = $toc.outerHeight();
            tocTopOffset = $toc.offset().top;
            contentBottomOffset = $content.offset().top + $content.outerHeight();
            footerTopOffset = $footer.length ? $footer.offset().top : $(document).height();
            
            // فقط در دسکتاپ اجرا شود
            if ($(window).width() <= 991) {
                $toc.css({
                    'position': 'relative',
                    'top': 'auto',
                    'width': 'auto'
                });
            }
        });
        
        // عرض اصلی سایدبار را ذخیره می‌کنیم
        const tocOriginalWidth = $toc.outerWidth();
        
        // سایدبار را به حالت ثابت تبدیل می‌کنیم تا از flow صفحه خارج شود
        $toc.css({
            'width': tocOriginalWidth + 'px'
        });
        
        // رویداد اسکرول
        $(window).on('scroll', function() {
            // اگر در حالت موبایل هستیم، کاری انجام نشود
            if ($(window).width() <= 991) {
                return;
            }
            
            const scrollTop = $(window).scrollTop();
            const windowHeight = $(window).height();
            
            // حالت 1: اگر هنوز به سایدبار نرسیده‌ایم، آن را در جای اصلی نگه داریم
            if (scrollTop < tocTopOffset - headerHeight) {
                $toc.css({
                    'position': 'relative',
                    'top': '0',
                });
            } 
            // حالت 2: اگر به انتهای محتوا نزدیک شده‌ایم، سایدبار را به انتهای محتوا ببریم
            else if (scrollTop + tocHeight + headerHeight > contentBottomOffset) {
                // محاسبه موقعیت جدید نسبت به بالای صفحه
                const newTop = contentBottomOffset - tocHeight - (tocTopOffset - headerHeight);
                
                $toc.css({
                    'position': 'relative',
                    'top': newTop + 'px',
                });
            } 
            // حالت 3: حالت عادی اسکرول - سایدبار باید همراه اسکرول حرکت کند
            else {
                $toc.css({
                    'position': 'fixed',
                    'top': headerHeight + 'px',
                });
            }
        });
        
        // بعد از بارگذاری کامل صفحه، یک بار اسکرول را شبیه‌سازی می‌کنیم
        $(window).trigger('scroll');
    }
    
    // تغییر کلاس active در منوی سایدبار هنگام اسکرول
    function updateActiveMenuItem() {
        const scrollTop = $(window).scrollTop();
        
        // پیدا کردن بخش فعلی
        $('.privacy-block').each(function() {
            const $section = $(this);
            const sectionTop = $section.offset().top - 150; // با در نظر گرفتن فاصله برای منوی ثابت
            const sectionBottom = sectionTop + $section.outerHeight();
            
            if (scrollTop >= sectionTop && scrollTop < sectionBottom) {
                const id = $section.attr('id');
                $('.privacy-toc__link').removeClass('active');
                $('.privacy-toc__link[href="#' + id + '"]').addClass('active');
                return false; // خروج از حلقه
            }
        });
    }
    
    // رویداد اسکرول برای آپدیت منوی فعال
    $(window).on('scroll', updateActiveMenuItem);
    
    // کلیک روی لینک‌های منو
    $('.privacy-toc__link').on('click', function(e) {
        e.preventDefault();
        
        const target = $(this).attr('href');
        const $targetSection = $(target);
        
        if ($targetSection.length) {
            const scrollPosition = $targetSection.offset().top - 120; // با در نظر گرفتن فاصله از بالا
            
            $('html, body').animate({
                scrollTop: scrollPosition
            }, 500);
            
            // فعال کردن لینک منو
            $('.privacy-toc__link').removeClass('active');
            $(this).addClass('active');
        }
    });
    
    // آپدیت اولیه منوی فعال
    updateActiveMenuItem();
});