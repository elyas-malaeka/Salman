<?php
/**
 * فایل هلپر ترجمه‌ها - چندزبانه (فارسی، انگلیسی، عربی)
 * 
 * @package Salman Educational Complex
 * @subpackage Library Translations
 * @version 2.0
 */

// تشخیص زبان از URL
if (!function_exists('detectLanguage')) {
    function detectLanguage() {
        $lang = isset($_GET['lang']) ? $_GET['lang'] : 'fa';
        
        // بررسی زبان‌های مجاز
        $allowed_langs = ['fa', 'en', 'ar'];
        if (!in_array($lang, $allowed_langs)) {
            $lang = 'fa';
        }
        
        return $lang;
    }
}

// دریافت زبان فعلی
$current_lang = detectLanguage();

// تعریف ترجمه‌ها
$translations = [
    // ================== بخش صفحه اصلی کتابخانه ==================
    'library_home' => [
        // عناوین اصلی
        'page_title' => [
            'fa' => 'کتابخانه آنلاین مجتمع آموزشی سلمان',
            'en' => 'Salman Educational Complex Online Library',
            'ar' => 'مكتبة مجمع سلمان التعليمي الإلكترونية'
        ],
        
        'hero_title' => [
            'fa' => 'کتابخانه آنلاین مجتمع آموزشی سلمان',
            'en' => 'Salman Educational Complex Online Library',
            'ar' => 'مكتبة مجمع سلمان التعليمي الإلكترونية'
        ],
        
        'hero_subtitle' => [
            'fa' => 'به فضای کیهانی دانش خوش آمدید! در اینجا می‌توانید به مجموعه‌ای از کتاب‌های متنوع دسترسی داشته باشید.',
            'en' => 'Welcome to the cosmic space of knowledge! Here you can access a diverse collection of books.',
            'ar' => 'مرحباً بكم في الفضاء الكوني للمعرفة! يمكنكم هنا الوصول إلى مجموعة متنوعة من الكتب.'
        ],
        
        'search_placeholder' => [
            'fa' => 'جستجو در کتاب‌ها، نویسندگان و موضوعات...',
            'en' => 'Search books, authors and topics...',
            'ar' => 'البحث في الكتب والمؤلفين والمواضيع...'
        ],
        
        'search_button' => [
            'fa' => 'جستجو',
            'en' => 'Search',
            'ar' => 'بحث'
        ],
        
        // بخش کتاب‌های برجسته
        'featured_books' => [
            'section_subtitle' => [
                'fa' => 'مجموعه منتخب',
                'en' => 'Featured Collection',
                'ar' => 'المجموعة المميزة'
            ],
            'section_title' => [
                'fa' => 'کتاب‌های برجسته',
                'en' => 'Featured Books',
                'ar' => 'الكتب المميزة'
            ],
            'section_description' => [
                'fa' => 'کتاب‌های منتخب و برجسته‌ای که توسط تیم کتابخانه برای مطالعه پیشنهاد می‌شوند.',
                'en' => 'Selected and outstanding books recommended by the library team for reading.',
                'ar' => 'كتب مختارة ومميزة يوصي بها فريق المكتبة للقراءة.'
            ],
            'see_details' => [
                'fa' => 'مشاهده جزئیات',
                'en' => 'View Details',
                'ar' => 'عرض التفاصيل'
            ],
            'view_all' => [
                'fa' => 'مشاهده همه کتاب‌ها',
                'en' => 'View All Books',
                'ar' => 'عرض جميع الكتب'
            ]
        ],
        
        // بخش دسته‌بندی‌ها
        'categories' => [
            'section_subtitle' => [
                'fa' => 'گروه‌بندی موضوعی',
                'en' => 'Thematic Classification',
                'ar' => 'التصنيف الموضوعي'
            ],
            'section_title' => [
                'fa' => 'دسته‌بندی کتاب‌ها',
                'en' => 'Book Categories',
                'ar' => 'فئات الكتب'
            ],
            'section_description' => [
                'fa' => 'کتاب‌ها در دسته‌بندی‌های مختلف برای دسترسی آسان‌تر دسته‌بندی شده‌اند.',
                'en' => 'Books are categorized into different classifications for easier access.',
                'ar' => 'تم تصنيف الكتب في فئات مختلفة لسهولة الوصول إليها.'
            ],
            'book_count' => [
                'fa' => 'کتاب',
                'en' => 'books',
                'ar' => 'كتاب'
            ],
            'view_books' => [
                'fa' => 'مشاهده کتاب‌ها',
                'en' => 'View Books',
                'ar' => 'عرض الكتب'
            ],
            'view_all_categories' => [
                'fa' => 'مشاهده همه دسته‌بندی‌ها',
                'en' => 'View All Categories',
                'ar' => 'عرض جميع الفئات'
            ]
        ],
        
        // بخش نویسندگان
        'authors' => [
            'section_subtitle' => [
                'fa' => 'نویسندگان',
                'en' => 'Authors',
                'ar' => 'المؤلفون'
            ],
            'section_title' => [
                'fa' => 'نویسندگان برجسته',
                'en' => 'Featured Authors',
                'ar' => 'المؤلفون المميزون'
            ],
            'section_description' => [
                'fa' => 'با نویسندگان برجسته و آثار ارزشمند آنها آشنا شوید.',
                'en' => 'Get acquainted with prominent authors and their valuable works.',
                'ar' => 'تعرفوا على المؤلفين البارزين وأعمالهم القيمة.'
            ],
            'view_works' => [
                'fa' => 'مشاهده آثار',
                'en' => 'View Works',
                'ar' => 'عرض الأعمال'
            ],
            'view_all_authors' => [
                'fa' => 'مشاهده همه نویسندگان',
                'en' => 'View All Authors',
                'ar' => 'عرض جميع المؤلفين'
            ]
        ],
        
        // بخش آمار
        'stats' => [
            'section_subtitle' => [
                'fa' => 'آمار کتابخانه',
                'en' => 'Library Statistics',
                'ar' => 'إحصائيات المكتبة'
            ],
            'section_title' => [
                'fa' => 'کتابخانه آنلاین در یک نگاه',
                'en' => 'Online Library at a Glance',
                'ar' => 'المكتبة الإلكترونية في لمحة'
            ],
            'section_description' => [
                'fa' => 'آماری از مجموعه غنی منابع کتابخانه آنلاین مجتمع آموزشی سلمان',
                'en' => 'Statistics of the rich collection of Salman Educational Complex online library resources',
                'ar' => 'إحصائيات من المجموعة الغنية لموارد مكتبة مجمع سلمان التعليمي الإلكترونية'
            ],
            'books' => [
                'fa' => 'کتاب',
                'en' => 'Books',
                'ar' => 'كتاب'
            ],
            'authors' => [
                'fa' => 'نویسنده',
                'en' => 'Authors',
                'ar' => 'مؤلف'
            ],
            'publishers' => [
                'fa' => 'ناشر',
                'en' => 'Publishers',
                'ar' => 'ناشر'
            ],
            'categories' => [
                'fa' => 'دسته‌بندی',
                'en' => 'Categories',
                'ar' => 'فئة'
            ]
        ],
        
        // متن‌های عمومی
        'general' => [
            'no_results' => [
                'fa' => 'نتیجه‌ای یافت نشد',
                'en' => 'No results found',
                'ar' => 'لم يتم العثور على نتائج'
            ],
            'loading' => [
                'fa' => 'در حال بارگذاری...',
                'en' => 'Loading...',
                'ar' => 'جار التحميل...'
            ],
            'search_error' => [
                'fa' => 'خطا در جستجو',
                'en' => 'Search error',
                'ar' => 'خطأ في البحث'
            ],
            'book' => [
                'fa' => 'کتاب',
                'en' => 'book',
                'ar' => 'كتاب'
            ],
            'books' => [
                'fa' => 'کتاب',
                'en' => 'books',
                'ar' => 'كتب'
            ]
        ]
    ],
    
    // ================== بخش منو و ناوبری ==================
    'navigation' => [
        'home' => [
            'fa' => 'خانه',
            'en' => 'Home',
            'ar' => 'الرئيسية'
        ],
        'library' => [
            'fa' => 'کتابخانه',
            'en' => 'Library',
            'ar' => 'المكتبة'
        ],
        'books' => [
            'fa' => 'کتاب‌ها',
            'en' => 'Books',
            'ar' => 'الكتب'
        ],
        'authors' => [
            'fa' => 'نویسندگان',
            'en' => 'Authors',
            'ar' => 'المؤلفون'
        ],
        'categories' => [
            'fa' => 'دسته‌بندی‌ها',
            'en' => 'Categories',
            'ar' => 'الفئات'
        ],
        'about' => [
            'fa' => 'درباره ما',
            'en' => 'About Us',
            'ar' => 'من نحن'
        ],
        'contact' => [
            'fa' => 'تماس با ما',
            'en' => 'Contact Us',
            'ar' => 'اتصل بنا'
        ]
    ],
    
    // ================== تنظیمات زبان ==================
    'language' => [
        'current' => $current_lang,
        'direction' => [
            'fa' => 'rtl',
            'en' => 'ltr', 
            'ar' => 'rtl'
        ],
        'name' => [
            'fa' => 'فارسی',
            'en' => 'English',
            'ar' => 'العربية'
        ],
        'code' => [
            'fa' => 'fa-IR',
            'en' => 'en-US',
            'ar' => 'ar-SA'
        ]
    ]
];

/**
 * تابع دریافت ترجمه - سازگار با تابع موجود در config.php
 * @param string $key کلید ترجمه
 * @param string $lang زبان (اختیاری)
 * @return string متن ترجمه شده
 */
if (!function_exists('getTranslatedText')) {
    function getTranslatedText($key, $lang = null) {
        global $translations, $current_lang;
        
        if ($lang === null) {
            $lang = $current_lang;
        }
        
        // تجزیه کلید به آرایه
        $keys = explode('.', $key);
        $value = $translations;
        
        foreach ($keys as $k) {
            if (isset($value[$k])) {
                $value = $value[$k];
            } else {
                return $key; // در صورت عدم وجود کلید، خود کلید را برگردان
            }
        }
        
        // اگر آرایه زبان باشد، زبان مورد نظر را برگردان
        if (is_array($value) && isset($value[$lang])) {
            return $value[$lang];
        }
        
        // اگر زبان فارسی موجود نباشد، اولین زبان موجود را برگردان
        if (is_array($value)) {
            return isset($value['fa']) ? $value['fa'] : array_values($value)[0];
        }
        
        return $value;
    }
}

/**
 * wrapper function برای سازگاری با تابع موجود t() در config.php
 */
if (!function_exists('translate')) {
    function translate($key, $lang = null) {
        return getTranslatedText($key, $lang);
    }
}

/**
 * تابع دریافت جهت متن بر اساس زبان فعلی
 * @return string جهت متن (rtl یا ltr)
 */
if (!function_exists('getDirection')) {
    function getDirection() {
        global $current_lang;
        return ($current_lang === 'en') ? 'ltr' : 'rtl';
    }
}

/**
 * تابع دریافت کلاس‌های CSS بر اساس زبان
 * @return string کلاس‌های CSS
 */
if (!function_exists('getLanguageClasses')) {
    function getLanguageClasses() {
        global $current_lang;
        $direction = getDirection();
        return "lang-{$current_lang} dir-{$direction} {$direction}";
    }
}

/**
 * تابع ایجاد URL با زبان
 * @param string $lang کد زبان
 * @param string $path مسیر (اختیاری)
 * @return string URL کامل
 */
if (!function_exists('getLangUrl')) {
    function getLangUrl($lang, $path = '') {
        $base_url = rtrim(dirname($_SERVER['PHP_SELF']), '/') . '/';
        $current_path = $path ?: basename($_SERVER['PHP_SELF']);
        
        // حذف پارامترهای موجود زبان
        $query_params = $_GET;
        $query_params['lang'] = $lang;
        
        $query_string = http_build_query($query_params);
        
        return $base_url . $current_path . ($query_string ? '?' . $query_string : '');
    }
}

/**
 * تابع نمایش تبدیل‌کننده زبان
 * @return string HTML تبدیل‌کننده زبان
 */
if (!function_exists('renderLanguageSwitcher')) {
    function renderLanguageSwitcher() {
        global $current_lang;
        
        $languages = [
            'fa' => ['name' => 'فارسی', 'flag' => '🇮🇷'],
            'en' => ['name' => 'English', 'flag' => '🇺🇸'], 
            'ar' => ['name' => 'العربية', 'flag' => '🇸🇦']
        ];
        
        $html = '<div class="language-switcher">';
        $html .= '<button class="language-switcher__toggle" onclick="toggleLanguageMenu()">';
        $html .= '<span class="flag">' . $languages[$current_lang]['flag'] . '</span>';
        $html .= '<span class="name">' . $languages[$current_lang]['name'] . '</span>';
        $html .= '<i class="fas fa-chevron-down"></i>';
        $html .= '</button>';
        
        $html .= '<div class="language-switcher__menu" id="languageMenu">';
        foreach ($languages as $code => $lang) {
            $active_class = ($code === $current_lang) ? ' active' : '';
            $html .= '<a href="' . getLangUrl($code) . '" class="language-switcher__item' . $active_class . '">';
            $html .= '<span class="flag">' . $lang['flag'] . '</span>';
            $html .= '<span class="name">' . $lang['name'] . '</span>';
            $html .= '</a>';
        }
        $html .= '</div>';
        $html .= '</div>';
        
        return $html;
    }
}
?>