<?php
/**
 * فایل کمکی برای چندزبانه سازی کتابخانه
 * شامل تمام ترجمه‌های مورد نیاز صفحات نویسندگان
 */

// دریافت زبان از URL یا session
if (isset($_GET['lang'])) {
    // تبدیل کد زبان به language_id
    $lang_codes = [
        'fa' => 1,
        'en' => 2,
        'ar' => 3
    ];
    
    if (isset($lang_codes[$_GET['lang']])) {
        $_SESSION['language_id'] = $lang_codes[$_GET['lang']];
    }
}

// دریافت زبان فعلی از session یا پیش‌فرض
if (!isset($_SESSION['language_id'])) {
    $_SESSION['language_id'] = 1; // فارسی به عنوان پیش‌فرض
}
$current_language_id = $_SESSION['language_id'];

// تعریف ترجمه‌ها
$translations = [
    // ================== بخش صفحه لیست نویسندگان ==================
    'authors_list' => [
        // عناوین صفحه
        'page_title' => [
            1 => 'نویسندگان و مترجمان',
            2 => 'Authors and Translators', 
            3 => 'المؤلفون والمترجمون'
        ],
        'total_authors_count' => [
            1 => 'تعداد کل نویسندگان',
            2 => 'Total Authors Count',
            3 => 'إجمالي عدد المؤلفين'
        ],
        'page_description' => [
            1 => 'فهرست کامل نویسندگان و مترجمان آثار موجود در کتابخانه آنلاین مجتمع آموزشی سلمان',
            2 => 'Complete list of authors and translators of works available in Salman Educational Complex online library',
            3 => 'قائمة كاملة بالمؤلفين والمترجمين للأعمال المتوفرة في مكتبة مجمع سلمان التعليمي الإلكترونية'
        ],
        
        // Breadcrumb
        'home' => [
            1 => 'صفحه اصلی',
            2 => 'Home',
            3 => 'الصفحة الرئيسية'
        ],
        'library' => [
            1 => 'کتابخانه',
            2 => 'Library',
            3 => 'المكتبة'
        ],
        'authors' => [
            1 => 'نویسندگان',
            2 => 'Authors',
            3 => 'المؤلفون'
        ],
        'breadcrumb' => [
            1 => 'مسیر صفحه',
            2 => 'Breadcrumb',
            3 => 'مسار الصفحة'
        ],
        
        // عناوین بخش‌ها
        'active_authors' => [
            1 => 'نویسنده و مترجم فعال در کتابخانه دیجیتال',
            2 => 'active authors and translators in digital library',
            3 => 'مؤلف ومترجم نشط في المكتبة الرقمية'
        ],
        'results_found' => [
            1 => 'نتیجه یافت شد',
            2 => 'results found',
            3 => 'نتيجة تم العثور عليها'
        ],
        
        // فیلترها
        'filters' => [
            1 => 'فیلترها',
            2 => 'Filters',
            3 => 'المرشحات'
        ],
        'search_author' => [
            1 => 'جستجوی نویسنده',
            2 => 'Search Author',
            3 => 'بحث عن مؤلف'
        ],
        'search_placeholder' => [
            1 => 'نام نویسنده یا مترجم...',
            2 => 'Author or translator name...',
            3 => 'اسم المؤلف أو المترجم...'
        ],
        'search_help' => [
            1 => 'می‌توانید بخشی از نام را جستجو کنید',
            2 => 'You can search part of the name',
            3 => 'يمكنك البحث عن جزء من الاسم'
        ],
        'sort_by' => [
            1 => 'مرتب‌سازی',
            2 => 'Sort by',
            3 => 'ترتيب حسب'
        ],
        'sort_name_asc' => [
            1 => 'نام (الف تا ی)',
            2 => 'Name (A to Z)',
            3 => 'الاسم (أ إلى ي)'
        ],
        'sort_name_desc' => [
            1 => 'نام (ی تا الف)',
            2 => 'Name (Z to A)',
            3 => 'الاسم (ي إلى أ)'
        ],
        'sort_books_desc' => [
            1 => 'تعداد کتاب (زیاد به کم)',
            2 => 'Number of books (High to Low)',
            3 => 'عدد الكتب (من الأكثر إلى الأقل)'
        ],
        'sort_books_asc' => [
            1 => 'تعداد کتاب (کم به زیاد)',
            2 => 'Number of books (Low to High)',
            3 => 'عدد الكتب (من الأقل إلى الأكثر)'
        ],
        'search_button' => [
            1 => 'جستجو',
            2 => 'Search',
            3 => 'بحث'
        ],
        
        // فیلتر کشور
        'filter_country' => [
            1 => 'فیلتر کشور',
            2 => 'Filter by Country',
            3 => 'تصفية حسب البلد'
        ],
        'all_countries' => [
            1 => 'همه کشورها',
            2 => 'All Countries',
            3 => 'جميع البلدان'
        ],
        'show_more' => [
            1 => 'مشاهده بیشتر',
            2 => 'Show More',
            3 => 'عرض المزيد'
        ],
        
        // فیلترهای فعال
        'active_filters' => [
            1 => 'فیلترهای فعال:',
            2 => 'Active Filters:',
            3 => 'المرشحات النشطة:'
        ],
        'search_filter' => [
            1 => 'جستجو:',
            2 => 'Search:',
            3 => 'بحث:'
        ],
        'country_filter' => [
            1 => 'کشور:',
            2 => 'Country:',
            3 => 'البلد:'
        ],
        'clear_all_filters' => [
            1 => 'حذف همه فیلترها',
            2 => 'Clear All Filters',
            3 => 'مسح جميع المرشحات'
        ],
        'remove_filter' => [
            1 => 'حذف فیلتر',
            2 => 'Remove filter',
            3 => 'إزالة المرشح'
        ],
        
        // کارت نویسنده
        'featured_author' => [
            1 => 'نویسنده برجسته',
            2 => 'Featured Author',
            3 => 'مؤلف مميز'
        ],
        'book' => [
            1 => 'اثر',
            2 => 'work',
            3 => 'عمل'
        ],
        'in_preparation' => [
            1 => 'در حال آماده‌سازی',
            2 => 'In Preparation',
            3 => 'قيد التحضير'
        ],
        'view_profile' => [
            1 => 'مشاهده پروفایل',
            2 => 'View Profile',
            3 => 'عرض الملف الشخصي'
        ],
        'default_image' => [
            1 => 'تصویر پیش‌فرض',
            2 => 'Default image',
            3 => 'الصورة الافتراضية'
        ],
        
        // صفحه‌بندی
        'pagination' => [
            1 => 'صفحه‌بندی',
            2 => 'Pagination',
            3 => 'ترقيم الصفحات'
        ],
        'showing' => [
            1 => 'نمایش',
            2 => 'Showing',
            3 => 'عرض'
        ],
        'to' => [
            1 => 'تا',
            2 => 'to',
            3 => 'إلى'
        ],
        'of' => [
            1 => 'از',
            2 => 'of',
            3 => 'من'
        ],
        'author' => [
            1 => 'نویسنده',
            2 => 'author',
            3 => 'مؤلف'
        ],
        'page' => [
            1 => 'صفحه',
            2 => 'Page',
            3 => 'صفحة'
        ],
        'previous' => [
            1 => 'قبلی',
            2 => 'Previous',
            3 => 'السابق'
        ],
        'next' => [
            1 => 'بعدی',
            2 => 'Next',
            3 => 'التالي'
        ],
        'previous_page' => [
            1 => 'صفحه قبلی',
            2 => 'Previous page',
            3 => 'الصفحة السابقة'
        ],
        'next_page' => [
            1 => 'صفحه بعدی',
            2 => 'Next page',
            3 => 'الصفحة التالية'
        ],
        
        // عدم وجود نتیجه
        'no_author_found' => [
            1 => 'نویسنده‌ای یافت نشد',
            2 => 'No Authors Found',
            3 => 'لم يتم العثور على مؤلفين'
        ],
        'no_results_for_search' => [
            1 => 'هیچ نویسنده‌ای با عبارت',
            2 => 'No authors found with the term',
            3 => 'لم يتم العثور على مؤلفين بالعبارة'
        ],
        'no_results_for_country' => [
            1 => 'هیچ نویسنده‌ای از کشور',
            2 => 'No authors from country',
            3 => 'لا يوجد مؤلفون من بلد'
        ],
        'not_found' => [
            1 => 'یافت نشد',
            2 => 'not found',
            3 => 'غير موجود'
        ],
        'not_available' => [
            1 => 'در کتابخانه موجود نیست.',
            2 => 'is not available in the library.',
            3 => 'غير متوفر في المكتبة.'
        ],
        'no_results_general' => [
            1 => 'متأسفانه نویسنده‌ای با معیارهای جستجوی شما یافت نشد.',
            2 => 'Unfortunately, no authors were found with your search criteria.',
            3 => 'للأسف، لم يتم العثور على مؤلفين بمعايير البحث الخاصة بك.'
        ],
        
        // پیشنهادات
        'suggestions' => [
            1 => 'پیشنهادات:',
            2 => 'Suggestions:',
            3 => 'اقتراحات:'
        ],
        'check_spelling' => [
            1 => 'از صحت املای کلمات اطمینان حاصل کنید',
            2 => 'Check the spelling of words',
            3 => 'تأكد من صحة تهجئة الكلمات'
        ],
        'use_different_keywords' => [
            1 => 'از کلمات کلیدی متفاوت استفاده کنید',
            2 => 'Use different keywords',
            3 => 'استخدم كلمات مفتاحية مختلفة'
        ],
        'shorten_search' => [
            1 => 'عبارت جستجو را کوتاه‌تر کنید',
            2 => 'Shorten the search term',
            3 => 'اختصر عبارة البحث'
        ],
        'view_all_authors' => [
            1 => 'مشاهده همه نویسندگان',
            2 => 'View All Authors',
            3 => 'عرض جميع المؤلفين'
        ],
        'search_books' => [
            1 => 'جستجو در کتاب‌ها',
            2 => 'Search in Books',
            3 => 'البحث في الكتب'
        ],
        'authors_list' => [
            1 => 'لیست نویسندگان',
            2 => 'Authors List',
            3 => 'قائمة المؤلفين'
        ],
        
        // Skip link
        'skip_to_content' => [
            1 => 'انتقال به محتوای اصلی',
            2 => 'Skip to main content',
            3 => 'تخطي إلى المحتوى الرئيسي'
        ],
    ],
    
    // ================== بخش صفحه جزئیات نویسنده ==================
    'author_detail' => [
        // نقش‌های نویسنده
        'role_author' => [
            1 => 'نویسنده',
            2 => 'Author',
            3 => 'مؤلف'
        ],
        'role_translator' => [
            1 => 'مترجم',
            2 => 'Translator',
            3 => 'مترجم'
        ],
        'role_editor' => [
            1 => 'ویراستار',
            2 => 'Editor',
            3 => 'محرر'
        ],
        'role_illustrator' => [
            1 => 'تصویرگر',
            2 => 'Illustrator',
            3 => 'رسام'
        ],
        
        // اطلاعات نویسنده
        'born' => [
            1 => 'متولد',
            2 => 'Born',
            3 => 'مولود'
        ],
        'years' => [
            1 => 'سال',
            2 => 'years',
            3 => 'سنة'
        ],
        'works_in_library' => [
            1 => 'اثر در کتابخانه',
            2 => 'works in library',
            3 => 'عمل في المكتبة'
        ],
        'featured_author' => [
            1 => 'نویسنده برجسته',
            2 => 'Featured Author',
            3 => 'مؤلف مميز'
        ],
        
        // دکمه‌ها
        'website' => [
            1 => 'وب‌سایت',
            2 => 'Website',
            3 => 'الموقع الإلكتروني'
        ],
        'copy_link' => [
            1 => 'کپی لینک',
            2 => 'Copy Link',
            3 => 'نسخ الرابط'
        ],
        'share' => [
            1 => 'اشتراک',
            2 => 'Share',
            3 => 'مشاركة'
        ],
        
        // بخش‌های صفحه
        'personal_info' => [
            1 => 'اطلاعات شخصی',
            2 => 'Personal Information',
            3 => 'المعلومات الشخصية'
        ],
        'birth_date' => [
            1 => 'تاریخ تولد:',
            2 => 'Birth Date:',
            3 => 'تاريخ الميلاد:'
        ],
        'death_date' => [
            1 => 'تاریخ وفات:',
            2 => 'Death Date:',
            3 => 'تاريخ الوفاة:'
        ],
        'age' => [
            1 => 'سن:',
            2 => 'Age:',
            3 => 'العمر:'
        ],
        'at_death' => [
            1 => '(در زمان فوت)',
            2 => '(at death)',
            3 => '(عند الوفاة)'
        ],
        'gender' => [
            1 => 'جنسیت:',
            2 => 'Gender:',
            3 => 'الجنس:'
        ],
        'male' => [
            1 => 'مرد',
            2 => 'Male',
            3 => 'ذكر'
        ],
        'female' => [
            1 => 'زن',
            2 => 'Female',
            3 => 'أنثى'
        ],
        
        // آمار
        'works_statistics' => [
            1 => 'آمار آثار',
            2 => 'Works Statistics',
            3 => 'إحصائيات الأعمال'
        ],
        'total_works' => [
            1 => 'مجموع آثار',
            2 => 'Total Works',
            3 => 'مجموع الأعمال'
        ],
        
        // دسترسی سریع
        'quick_access' => [
            1 => 'دسترسی سریع',
            2 => 'Quick Access',
            3 => 'الوصول السريع'
        ],
        'biography' => [
            1 => 'زندگی‌نامه',
            2 => 'Biography',
            3 => 'السيرة الذاتية'
        ],
        'quotes' => [
            1 => 'نقل قول‌ها',
            2 => 'Quotes',
            3 => 'اقتباسات'
        ],
        'available_works' => [
            1 => 'آثار موجود',
            2 => 'Available Works',
            3 => 'الأعمال المتاحة'
        ],
        'related_authors' => [
            1 => 'نویسندگان مرتبط',
            2 => 'Related Authors',
            3 => 'المؤلفون ذوو الصلة'
        ],
        
        // نقل قول‌ها
        'selected_quotes' => [
            1 => 'نقل‌قول‌های برگزیده',
            2 => 'Selected Quotes',
            3 => 'اقتباسات مختارة'
        ],
        'share_quote' => [
            1 => 'اشتراک‌گذاری نقل قول',
            2 => 'Share Quote',
            3 => 'مشاركة الاقتباس'
        ],
        'copy_quote' => [
            1 => 'کپی نقل قول',
            2 => 'Copy Quote',
            3 => 'نسخ الاقتباس'
        ],
        
        // آثار
        'book' => [
            1 => 'کتاب',
            2 => 'Book',
            3 => 'كتاب'
        ],
        'works_in_library' => [
            1 => 'آثار موجود در کتابخانه',
            2 => 'Works Available in Library',
            3 => 'الأعمال المتوفرة في المكتبة'
        ],
        'collection_of_works' => [
            1 => 'مجموعه آثار',
            2 => 'Collection of works by',
            3 => 'مجموعة أعمال'
        ],
        'available_in_digital_library' => [
            1 => 'که در کتابخانه دیجیتال ما موجود است',
            2 => 'available in our digital library',
            3 => 'المتوفرة في مكتبتنا الرقمية'
        ],
        'as_role' => [
            1 => 'به عنوان',
            2 => 'as',
            3 => 'بصفة'
        ],
        'view_details' => [
            1 => 'مشاهده جزئیات',
            2 => 'View Details',
            3 => 'عرض التفاصيل'
        ],
        'view_all_works' => [
            1 => 'مشاهده همه آثار این نویسنده',
            2 => 'View all works by this author',
            3 => 'عرض جميع أعمال هذا المؤلف'
        ],
        
        // عدم وجود کتاب
        'in_preparation' => [
            1 => 'در حال آماده‌سازی',
            2 => 'In Preparation',
            3 => 'قيد التحضير'
        ],
        'works_being_prepared' => [
            1 => 'آثار این نویسنده در حال آماده‌سازی و بارگذاری در کتابخانه دیجیتال است.',
            2 => 'Works by this author are being prepared and uploaded to the digital library.',
            3 => 'أعمال هذا المؤلف قيد التحضير والتحميل في المكتبة الرقمية.'
        ],
        'works_available_soon' => [
            1 => 'به زودی آثار',
            2 => 'Works by',
            3 => 'قريباً أعمال'
        ],
        'will_find_here' => [
            1 => 'را در اینجا خواهید یافت.',
            2 => 'will be available here soon.',
            3 => 'ستكون متاحة هنا.'
        ],
        'back_to_authors' => [
            1 => 'بازگشت به نویسندگان',
            2 => 'Back to Authors',
            3 => 'العودة إلى المؤلفين'
        ],
        'view_other_books' => [
            1 => 'مشاهده سایر کتاب‌ها',
            2 => 'View Other Books',
            3 => 'عرض الكتب الأخرى'
        ],
        'no_books_found' => [
            1 => 'کتابی یافت نشد',
            2 => 'No books found',
            3 => 'لم يتم العثور على كتب'
        ],
        'no_books_available' => [
            1 => 'هیچ کتابی در این بخش موجود نیست.',
            2 => 'No books are available in this section.',
            3 => 'لا توجد كتب متاحة في هذا القسم.'
        ],
        'no_books_in_library' => [
            1 => 'این نویسنده هیچ کتابی در کتابخانه دیجیتال ندارد.',
            2 => 'This author has no books in the digital library.',
            3 => 'هذا المؤلف ليس لديه أي كتب في المكتبة الرقمية.'
        ],
        'no_books_in_preparation' => [
            1 => 'این نویسنده هیچ کتابی در حال آماده‌سازی ندارد.',
            2 => 'This author has no books in preparation.',
            3 => 'هذا المؤلف ليس لديه أي كتب قيد التحضير.'
        ],
        
        // مودال اشتراک‌گذاری
        'share_profile' => [
            1 => 'اشتراک‌گذاری پروفایل',
            2 => 'Share Profile',
            3 => 'مشاركة الملف الشخصي'
        ],
        'share_profile_of' => [
            1 => 'پروفایل',
            2 => 'Share profile of',
            3 => 'شارك الملف الشخصي لـ'
        ],
        'with_others' => [
            1 => 'را با دیگران به اشتراک بگذارید:',
            2 => 'with others:',
            3 => 'مع الآخرين:'
        ],
        'close' => [
            1 => 'بستن',
            2 => 'Close',
            3 => 'إغلاق'
        ],
        'or_copy_link' => [
            1 => 'یا لینک را کپی کنید:',
            2 => 'Or copy the link:',
            3 => 'أو انسخ الرابط:'
        ],
        'copy' => [
            1 => 'کپی',
            2 => 'Copy',
            3 => 'نسخ'
        ],
        'page_link' => [
            1 => 'لینک صفحه',
            2 => 'Page link',
            3 => 'رابط الصفحة'
        ],
        
        // پیام‌های توست
        'link_copied' => [
            1 => 'لینک کپی شد!',
            2 => 'Link copied!',
            3 => 'تم نسخ الرابط!'
        ],
        'page_link_copied' => [
            1 => 'لینک صفحه کپی شد!',
            2 => 'Page link copied!',
            3 => 'تم نسخ رابط الصفحة!'
        ],
        'quote_copied' => [
            1 => 'نقل قول کپی شد!',
            2 => 'Quote copied!',
            3 => 'تم نسخ الاقتباس!'
        ],
        'error_copying' => [
            1 => 'خطا در کپی کردن',
            2 => 'Error copying',
            3 => 'خطأ في النسخ'
        ],
        
        // نویسندگان مرتبط
        'view_all_authors_from' => [
            1 => 'مشاهده همه نویسندگان',
            2 => 'View all authors from',
            3 => 'عرض جميع المؤلفين من'
        ],
        
        // مفردات
        'work' => [
            1 => 'اثر',
            2 => 'work',
            3 => 'عمل'
        ],
        'works' => [
            1 => 'اثر',
            2 => 'works',
            3 => 'عمل'
        ],
    ],
    
    // ================== ترجمه کشورها ==================
    'countries' => [
        'ایرانی' => [
            1 => 'ایرانی',
            2 => 'Iranian',
            3 => 'إيراني'
        ],
        'Russian' => [
            1 => 'روسی',
            2 => 'Russian',
            3 => 'روسي'
        ],
        'English' => [
            1 => 'انگلیسی',
            2 => 'English',
            3 => 'إنجليزي'
        ],
        'British' => [
            1 => 'بریتانیایی',
            2 => 'British',
            3 => 'بريطاني'
        ],
        'American' => [
            1 => 'آمریکایی',
            2 => 'American',
            3 => 'أمريكي'
        ],
        'Lebanese-American' => [
            1 => 'لبنانی-آمریکایی',
            2 => 'Lebanese-American',
            3 => 'لبناني-أمريكي'
        ],
        'French' => [
            1 => 'فرانسوی',
            2 => 'French',
            3 => 'فرنسي'
        ],
        'French-Algerian' => [
            1 => 'فرانسوی-الجزایری',
            2 => 'French-Algerian',
            3 => 'فرنسي-جزائري'
        ],
        'German' => [
            1 => 'آلمانی',
            2 => 'German',
            3 => 'ألماني'
        ],
        'Colombian' => [
            1 => 'کلمبیایی',
            2 => 'Colombian',
            3 => 'كولومبي'
        ]
    ]
];

/**
 * تابع دریافت ترجمه
 * 
 * @param string $section بخش ترجمه (authors_list یا author_detail)
 * @param string $key کلید ترجمه
 * @param int|null $language_id شناسه زبان (در صورت عدم تعیین از session استفاده می‌شود)
 * @return string متن ترجمه شده
 */
function getTranslation($section, $key, $language_id = null) {
    global $translations, $current_language_id;
    
    if ($language_id === null) {
        $language_id = $current_language_id;
    }
    
    if (isset($translations[$section][$key][$language_id])) {
        return $translations[$section][$key][$language_id];
    }
    
    // اگر ترجمه یافت نشد، به فارسی برگردان
    if (isset($translations[$section][$key][1])) {
        return $translations[$section][$key][1];
    }
    
    // اگر هیچ ترجمه‌ای یافت نشد
    return "[$section.$key]";
}

/**
 * تابع ترجمه نام کشورها
 * 
 * @param string $country نام کشور
 * @param int|null $language_id شناسه زبان
 * @return string نام کشور به زبان مورد نظر
 */
function translateCountry($country, $language_id = null) {
    global $translations, $current_language_id;
    
    if ($language_id === null) {
        $language_id = $current_language_id;
    }
    
    // اگر ترجمه وجود داشت
    if (isset($translations['countries'][$country][$language_id])) {
        return $translations['countries'][$country][$language_id];
    }
    
    // اگر ترجمه نداشت، همان نام اصلی را برگردان
    return $country;
}

/**
 * تابع دریافت جهت صفحه بر اساس زبان
 * 
 * @param int|null $language_id شناسه زبان
 * @return string جهت صفحه (rtl یا ltr)
 */
function getPageDirection($language_id = null) {
    global $current_language_id;
    
    if ($language_id === null) {
        $language_id = $current_language_id;
    }
    
    // فارسی و عربی راست به چپ هستند
    return ($language_id == 1 || $language_id == 3) ? 'rtl' : 'ltr';
}

/**
 * تابع دریافت کد زبان
 * 
 * @param int|null $language_id شناسه زبان
 * @return string کد زبان
 */
function getLanguageCode($language_id = null) {
    global $current_language_id;
    
    if ($language_id === null) {
        $language_id = $current_language_id;
    }
    
    $codes = [
        1 => 'fa',
        2 => 'en',
        3 => 'ar'
    ];
    
    return isset($codes[$language_id]) ? $codes[$language_id] : 'fa';
}

/**
 * تابع دریافت locale
 * 
 * @param int|null $language_id شناسه زبان
 * @return string locale
 */
function getLocale($language_id = null) {
    global $current_language_id;
    
    if ($language_id === null) {
        $language_id = $current_language_id;
    }
    
    $locales = [
        1 => 'fa_IR',
        2 => 'en_US',
        3 => 'ar_SA'
    ];
    
    return isset($locales[$language_id]) ? $locales[$language_id] : 'fa_IR';
}

/**
 * تابع ایجاد URL با حفظ پارامتر زبان
 * 
 * @param string $url آدرس مورد نظر
 * @param array $params پارامترهای اضافی
 * @return string URL کامل با پارامتر زبان
 */
function createUrl($url, $params = []) {
    global $current_language_id;
    
    // دریافت کد زبان فعلی
    $lang_code = getLanguageCode($current_language_id);
    
    // اضافه کردن پارامتر زبان اگر غیر از فارسی است
    if ($current_language_id != 1) {
        $params['lang'] = $lang_code;
    }
    
    // ساخت query string
    if (!empty($params)) {
        $url .= (strpos($url, '?') === false ? '?' : '&') . http_build_query($params);
    }
    
    return $url;
}

/**
 * تابع بروزرسانی پارامترهای URL فعلی
 * 
 * @param array $new_params پارامترهای جدید برای اضافه/تغییر
 * @param array $remove_params پارامترهایی که باید حذف شوند
 * @return string Query string جدید
 */
function updateUrlParams($new_params = [], $remove_params = []) {
    $current_params = $_GET;
    
    // اضافه کردن/بروزرسانی پارامترها
    foreach ($new_params as $key => $value) {
        if ($value === '' || $value === null) {
            unset($current_params[$key]);
        } else {
            $current_params[$key] = $value;
        }
    }
    
    // حذف پارامترها
    foreach ($remove_params as $key) {
        unset($current_params[$key]);
    }
    
    return http_build_query($current_params);
}
?>