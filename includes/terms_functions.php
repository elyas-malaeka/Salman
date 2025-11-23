<?php
/**
 * Registration Terms Functions
 * 
 * Functions to retrieve content for the Registration Terms page
 * from the new database structure using temp_terms_content and temp_terms_translations tables.
 */

/**
 * Get content for registration terms page
 * 
 * @param string $field_key Field key to retrieve
 * @param string $lang Language code (fa, en, ar)
 * @return string Content text
 */
function getTermsContent($field_key, $lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $field_key = mysqli_real_escape_string($db, $field_key);
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT tt.content_value 
              FROM temp_terms_content tc
              JOIN temp_terms_translations tt ON tc.content_id = tt.content_id
              WHERE tc.field_key = '{$field_key}' 
              AND tt.language_id = '{$lang}' 
              AND tc.is_repeatable = 0 
              LIMIT 1";
              
    $result = mysqli_query($db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['content_value'];
    }
    
    // Return default values if not found in database
    return getDefaultTermsContent($field_key, $lang);
}

/**
 * Get repeating items for registration terms page
 * 
 * @param string $field_key Field key to retrieve
 * @param string $lang Language code (fa, en, ar)
 * @return array Array of items
 */
function getTermsRepeatingItems($field_key, $lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    $field_key = mysqli_real_escape_string($db, $field_key);
    $lang = mysqli_real_escape_string($db, $lang);
    
    $query = "SELECT tt.content_value 
              FROM temp_terms_content tc
              JOIN temp_terms_translations tt ON tc.content_id = tt.content_id
              WHERE tc.field_key = '{$field_key}' 
              AND tt.language_id = '{$lang}' 
              AND tc.is_repeatable = 1 
              ORDER BY tc.sort_order ASC";
              
    $result = mysqli_query($db, $query);
    $items = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $items[] = $row['content_value'];
        }
    }
    
    // Return default values if not found in database
    if (empty($items)) {
        return getDefaultRepeatingItems($field_key, $lang);
    }
    
    return $items;
}

/**
 * Get bus routes from the database
 * 
 * @param string $lang Language code (fa, en, ar)
 * @return array Array of bus routes
 */
function getBusRoutes($lang = null) {
    global $db;
    
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    // تبدیل کد زبان به شناسه زبان در دیتابیس
    $langId = getLanguageIdNumber($lang);
    
    $query = "SELECT sbr.id as route_id, sbrt.route_name, sbrt.description 
              FROM service_bus_routes sbr
              JOIN service_bus_route_translations sbrt ON sbr.id = sbrt.route_id
              WHERE sbrt.language_id = {$langId} 
              ORDER BY sbr.id ASC";
              
    $result = mysqli_query($db, $query);
    $routes = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $routes[] = $row;
        }
        return $routes;
    }
    
    // اگر نتوانستیم داده‌ها را از دیتابیس بخوانیم، از مقادیر پیش‌فرض استفاده می‌کنیم
    return getDefaultBusRoutes($lang);
}

/**
 * Convert language code to language ID number used in database
 * 
 * @param string $lang Language code (fa, en, ar)
 * @return int Language ID number
 */
function getLanguageIdNumber($lang) {
    // بر اساس دیتابیس شما، شناسه زبان‌ها به صورت زیر است
    $langMap = [
        'fa' => 1, // فارسی
        'en' => 2, // انگلیسی
        'ar' => 3  // عربی
    ];
    
    return isset($langMap[$lang]) ? $langMap[$lang] : 1; // پیش‌فرض فارسی
}

/**
 * Get default bus routes if database query fails
 * 
 * @param string $lang Language code (fa, en, ar)
 * @return array Default bus routes
 */
function getDefaultBusRoutes($lang) {
    if ($lang == 'fa') {
        $routes = [
            ['route_id' => '1', 'route_name' => 'مسیر ۱', 'description' => 'قافیه - مدرسه شارجه - میدان اول التعاون - المتینه - بازار قدیم - بازار ایرانی - بانک صادرات - بانک ملی - خیابان شاه فیصل - المجاز - القصبا - الرولا - ام خنور - المجاز ۱ و ۲، شارجه'],
            ['route_id' => '2', 'route_name' => 'مسیر ۲', 'description' => 'خیابان اصلی منطقه صنعتی - الروضه ۱ و ۲ - الحمیدیه - المویهات - الجرف - جاده شیخ بن زاید - الیاسمین - خان صاحب'],
            ['route_id' => '3', 'route_name' => 'مسیر ۳', 'description' => 'عجمان، بیمارستان GMC - تقاطع کویت - النعیمیه ۲ و ۳ - بازارهای العین - کورنیش - الرشیدیه - بازار ماهی - برج‌های الخور - منطقه الکرامه - پارک مشیرف، عجمان'],
            ['route_id' => '4', 'route_name' => 'مسیر ۴', 'description' => 'الصفا - مردیف - الرشیدیه - ند الحمر - الورقاء - عود المتینه - محیصنه ۲ - القصیص - مردیف سیتی'],
            ['route_id' => '5', 'route_name' => 'مسیر ۵', 'description' => 'بر دبی - المنخول - مصلی نزدیک قبرستان - مینا بازار - بندر راشد - تقاطع جافلیه - جاده ستوه - تقاطع الوصل - القوز ۲ و ۴ - پشت اسپینیس، جمیرا'],
            ['route_id' => '6', 'route_name' => 'مسیر ۶', 'description' => 'پارک النهضه، شارجه - خیابان اصلی التعاون - انصار مال - النهضه شارجه ۲ - مرکز صحارا - پشت اتصالات النهضه - پشت انصار مال'],
            ['route_id' => '7', 'route_name' => 'مسیر ۷', 'description' => 'ابوهیل - هور العنز - المتینه - میدان ماهی - نایف - الکرامه - الحمریه - الراس - النهضه ۲، دبی']
        ];
    } else if ($lang == 'ar') {
        $routes = [
            ['route_id' => '1', 'route_name' => 'المسار ١', 'description' => 'القافية - مدرسة الشارقة - دوار التعاون الأول - المتينة - السوق القديم - البازار الإيراني - بنك التصدير - البنك الوطني - شارع الملك فيصل - المجاز - القصباء - الرولة - أم خنور - المجاز 1 و2، الشارقة'],
            ['route_id' => '2', 'route_name' => 'المسار ٢', 'description' => 'المنطقة الصناعية - الروضة 1 و2 - الحميدية - المويهات - الجرف - شارع الشيخ بن زايد - الياسمين - خانصاحب'],
            ['route_id' => '3', 'route_name' => 'المسار ٣', 'description' => 'عجمان - مستشفى GMC - تقاطع الكويت - النعيمية 2 و3 - أسواق العين - الكورنيش - الرشيدية - سوق السمك - أبراج الخور - منطقة الكرامة - حديقة مشيرف'],
            ['route_id' => '4', 'route_name' => 'المسار ٤', 'description' => 'الصفا - مردف - الرشيدية - ند الحمر - الورقاء - عود المتينة - محيصنة 2 - القصيص - مردف سيتي'],
            ['route_id' => '5', 'route_name' => 'المسار ٥', 'description' => 'بر دبي - المنخول - المصلى بجوار المقبرة - سوق المينا - ميناء راشد - تقاطع الجافلية - شارع السطوة - تقاطع الوصل - القوز 2 و4 - خلف سبينيس، جميرا'],
            ['route_id' => '6', 'route_name' => 'المسار ٦', 'description' => 'حديقة النهضة، الشارقة - شارع التعاون الرئيسي - أنصار مول - النهضة الشارقة 2 - مركز صحارى - خلف اتصالات النهضة - خلف أنصار مول'],
            ['route_id' => '7', 'route_name' => 'المسار ٧', 'description' => 'أبو هيل - هور العنز - المتينة - دوار السمك - نايف - الكرامة - الحمرية - الرأس - النهضة 2، دبي']
        ];
    } else { // English
        $routes = [
            ['route_id' => '1', 'route_name' => 'Route 1', 'description' => 'Qafiya - Sharjah School - First Al Taawun Roundabout - Al Muteena - Old Market - Iranian Bazaar - Export Bank - National Bank - King Faisal Road - Al Majaz - Al Qasba - Al Rolla - Umm Khanour - Al Majaz 1 & 2, Sharjah'],
            ['route_id' => '2', 'route_name' => 'Route 2', 'description' => 'Industrial Area Main Street - Al Rawda 1 & 2 - Al Hamidiya - Al Mowaihat - Al Jurf - Sheikh Bin Zayed Road - Al Yasmeen - Khansaheb'],
            ['route_id' => '3', 'route_name' => 'Route 3', 'description' => 'Ajman, GMC Hospital - Kuwait Junction - Al Nuaimiya 2 & 3 - Al Ain Markets - Al Corniche - Al Rashidiya - Fish Market - Al Khor Towers - Al Karama Area - Mushairif Park, Ajman'],
            ['route_id' => '4', 'route_name' => 'Route 4', 'description' => 'Al Safa - Mirdif - Al Rashidiya - Nad Al Hamar - Al Warqa - Oud Al Muteena - Muhaisnah 2 - Al Qusais - Mirdif City'],
            ['route_id' => '5', 'route_name' => 'Route 5', 'description' => 'Bur Dubai - Al Mankhool - Musalla near Cemetery - Meena Bazaar - Port Rashid - Jafliya Junction - Satwa Road - Al Wasl Junction - Al Quoz 2 & 4 - Behind Spinneys, Jumeirah'],
            ['route_id' => '6', 'route_name' => 'Route 6', 'description' => 'Al Nahda Park, Sharjah - Main Street Al Taawun - Ansar Mall - Al Nahda Sharjah 2 - Sahara Centre - Behind Etisalat Al Nahda - Behind Ansar Mall'],
            ['route_id' => '7', 'route_name' => 'Route 7', 'description' => 'Abu Hail - Hor Al Anz - Al Muteena - Fish Roundabout - Naif - Al Karama - Al Hamriya - Al Ras - Al Nahda 2, Dubai']
        ];
    }
    
    return $routes;
}

/**
 * Get configuration value from core_config table
 * 
 * @param string $key Configuration key
 * @param mixed $default Default value if key not found
 * @return mixed Configuration value
 */
function getConfigValue($key, $default = null) {
    global $db;
    
    $key = mysqli_real_escape_string($db, $key);
    $query = "SELECT config_value FROM core_config WHERE config_key = '{$key}' LIMIT 1";
    $result = mysqli_query($db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['config_value'];
    }
    
    return $default;
}

/**
 * Get tuition fees from the database
 * 
 * @param string $lang Language code (fa, en, ar)
 * @return array Array of tuition fees
 */
function getTuitionFees($lang = null) {
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    // دریافت نام پایه‌ها از جدول ترجمه محتوا
    $fees = [
        ['grade_name' => getTermsContent('grades_1_5', $lang), 'fee_amount' => '4,587'],
        ['grade_name' => getTermsContent('grade_6', $lang), 'fee_amount' => '5,633'],
        ['grade_name' => getTermsContent('grades_7_8', $lang), 'fee_amount' => '5,285'],
        ['grade_name' => getTermsContent('grade_9', $lang), 'fee_amount' => '5,633'],
        ['grade_name' => getTermsContent('grades_10_12', $lang), 'fee_amount' => '6,720']
    ];
    
    return $fees;
}

/**
 * Get transportation fees from the database
 * 
 * @param string $lang Language code (fa, en, ar)
 * @return array Array of transportation fees
 */
function getTransportationFees($lang = null) {
    if (!$lang) {
        $lang = getCurrentLanguage();
    }
    
    // دریافت نام مناطق از جدول ترجمه محتوا
    $fees = [
        ['location_name' => getTermsContent('dubai', $lang), 'fee_amount' => '5,750'],
        ['location_name' => getTermsContent('sharjah', $lang), 'fee_amount' => '6,250'],
        ['location_name' => getTermsContent('ajman', $lang), 'fee_amount' => '6,750']
    ];
    
    return $fees;
}

/**
 * Get default content for registration terms page
 * Fallback if database content is not available
 * 
 * @param string $field_key Field key
 * @param string $lang Language code (fa, en, ar)
 * @return string Default content
 */
function getDefaultTermsContent($field_key, $lang) {
    $defaultContent = [
        'page_title' => [
            'fa' => 'شرایط و ضوابط ثبت‌نام',
            'en' => 'Terms and Conditions for Registration',
            'ar' => 'شروط وأحكام التسجيل'
        ],
        'header_title' => [
            'fa' => 'شرایط و ضوابط ثبت‌نام',
            'en' => 'Terms and Conditions for Registration',
            'ar' => 'شروط وأحكام التسجيل'
        ],
        'header_subtitle' => [
            'fa' => 'اطلاعات مهم درباره ثبت‌نام، مدارک مورد نیاز، هزینه‌ها و روش‌های پرداخت',
            'en' => 'Important information about registration, required documents, fees, and payment methods',
            'ar' => 'معلومات مهمة حول التسجيل، والوثائق المطلوبة، والرسوم، وطرق الدفع'
        ],
        'registration_instructions_title' => [
            'fa' => 'دستورالعمل‌های ثبت‌نام مدرسه سلمان فارسی',
            'en' => 'Salman Farsi School Registration Instructions',
            'ar' => 'تعليمات التسجيل في مدرسة سلمان الفارسي'
        ],
        'required_documents_title' => [
            'fa' => 'مدارک لازم برای ثبت‌نام',
            'en' => 'Required Documents for Registration',
            'ar' => 'الوثائق المطلوبة للتسجيل'
        ],
        'documents_ready_text' => [
            'fa' => 'قبل از شروع فرآیند ثبت‌نام آنلاین، اطمینان حاصل کنید که فایل‌های زیر را آماده دارید:',
            'en' => 'Before starting the online registration process, ensure you have the following files ready:',
            'ar' => 'قبل بدء عملية التسجيل عبر الإنترنت، تأكد من توفر الملفات التالية لديك:'
        ],
        'transportation_services_title' => [
            'fa' => 'خدمات حمل و نقل دانش‌آموزان',
            'en' => 'Student Transportation Services',
            'ar' => 'خدمات نقل الطلاب'
        ],
        'transportation_info_text' => [
            'fa' => 'مدرسه سلمان فارسی خدمات حمل و نقل روزانه برای بیش از ۱۷۰ دانش‌آموز در سراسر دبی، شارجه و عجمان ارائه می‌دهد. این خدمات توسط',
            'en' => 'Salman Farsi School provides daily transportation services for over 170 students across Dubai, Sharjah, and Ajman. The services are coordinated by',
            'ar' => 'تقدم مدرسة سلمان الفارسي خدمات النقل اليومية لأكثر من 170 طالبًا في جميع أنحاء دبي والشارقة وعجمان. يتم تنسيق الخدمات بواسطة'
        ],
        'coordinator_name' => [
            'fa' => 'آقای فرخی‌نژاد',
            'en' => 'Mr. Farrokhi-Nejad',
            'ar' => 'السيد فرخي نجاد'
        ],
        'contact_label' => [
            'fa' => 'تماس:',
            'en' => 'Contact:',
            'ar' => 'اتصال:'
        ],
        'coordinator_phone' => [
            'fa' => '+971507840067',
            'en' => '+971507840067',
            'ar' => '+971507840067'
        ],
        'transportation_regulations_text' => [
            'fa' => '، با رعایت مقررات RTA هماهنگ می‌شود.',
            'en' => ', ensuring compliance with RTA regulations.',
            'ar' => '، مع ضمان الامتثال للوائح هيئة الطرق والمواصلات.'
        ],
        'transportation_routes_title' => [
            'fa' => 'مسیرهای حمل و نقل:',
            'en' => 'Transportation Routes:',
            'ar' => 'مسارات النقل:'
        ],
        'route_label' => [
            'fa' => 'مسیر',
            'en' => 'Route',
            'ar' => 'المسار'
        ],
        'stops_label' => [
            'fa' => 'توقف‌ها',
            'en' => 'Stops',
            'ar' => 'المحطات'
        ],
        'tuition_fees_title' => [
            'fa' => 'شهریه برای سال تحصیلی ۲۰۲۴-۲۰۲۵',
            'en' => 'Tuition Fees for the Academic Year 2024-2025',
            'ar' => 'الرسوم الدراسية للعام الدراسي 2024-2025'
        ],
        'basic_tuition_fees_title' => [
            'fa' => 'شهریه اصلی:',
            'en' => 'Basic Tuition Fees:',
            'ar' => 'الرسوم الدراسية الأساسية:'
        ],
        'grade_label' => [
            'fa' => 'پایه',
            'en' => 'Grade',
            'ar' => 'الصف'
        ],
        'tuition_fee_label' => [
            'fa' => 'شهریه (درهم)',
            'en' => 'Tuition Fee (AED)',
            'ar' => 'الرسوم الدراسية (درهم)'
        ],
        'grades_1_5' => [
            'fa' => 'پایه‌های ۱ تا ۵',
            'en' => 'Grades 1 to 5',
            'ar' => 'الصفوف 1 إلى 5'
        ],
        'grade_6' => [
            'fa' => 'پایه ۶',
            'en' => 'Grade 6',
            'ar' => 'الصف 6'
        ],
        'grades_7_8' => [
            'fa' => 'پایه‌های ۷ و ۸',
            'en' => 'Grades 7 and 8',
            'ar' => 'الصفان 7 و 8'
        ],
        'grade_9' => [
            'fa' => 'پایه ۹',
            'en' => 'Grade 9',
            'ar' => 'الصف 9'
        ],
        'grades_10_12' => [
            'fa' => 'پایه‌های ۱۰ تا ۱۲',
            'en' => 'Grades 10 to 12',
            'ar' => 'الصفوف 10 إلى 12'
        ],
        'transportation_fees_title' => [
            'fa' => 'هزینه‌های حمل و نقل:',
            'en' => 'Transportation Fees:',
            'ar' => 'رسوم النقل:'
        ],
        'transportation_fee_label' => [
            'fa' => 'هزینه حمل و نقل (درهم)',
            'en' => 'Transportation Fee (AED)',
            'ar' => 'رسوم النقل (درهم)'
        ],
        'dubai' => [
            'fa' => 'دبی',
            'en' => 'Dubai',
            'ar' => 'دبي'
        ],
        'sharjah' => [
            'fa' => 'شارجه',
            'en' => 'Sharjah',
            'ar' => 'الشارقة'
        ],
        'ajman' => [
            'fa' => 'عجمان',
            'en' => 'Ajman',
            'ar' => 'عجمان'
        ],
        'payment_methods_title' => [
            'fa' => 'روش‌های پرداخت',
            'en' => 'Payment Methods',
            'ar' => 'طرق الدفع'
        ],
        'payment_methods_content' => [
            'fa' => '<ol class="numbered-list">
                        <li>پرداخت کامل نقدی.</li>
                        <li>
                            پرداخت در دو قسط:
                            <ul class="inner-list">
                                <li><strong>قسط اول:</strong> سررسید تا ۱۰/۱۲/۲۰۲۴.</li>
                                <li><strong>قسط دوم:</strong> سررسید تا ۱۵/۰۳/۲۰۲۵.</li>
                                <li>
                                    حداقل پرداخت پیش‌پرداخت شامل شهریه، کتاب‌ها، بیمه، خدمات بهداشتی و فعالیت‌های فوق برنامه:
                                    <ul class="sub-inner-list">
                                        <li><strong>مقطع ابتدایی:</strong> 2,500 AED</li>
                                        <li><strong>مقطع متوسطه اول:</strong> 3,000 AED</li>
                                        <li><strong>مقطع متوسطه دوم:</strong> 3,200 AED</li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ol>',
            'en' => '<ol class="numbered-list">
                        <li>Full cash payment.</li>
                        <li>
                            Payment in two installments:
                            <ul class="inner-list">
                                <li><strong>First Installment:</strong> Due by 10/12/2024.</li>
                                <li><strong>Second Installment:</strong> Due by 15/03/2025.</li>
                                <li>
                                    Minimum advance payment includes tuition, books, insurance, health services, and extracurricular activities:
                                    <ul class="sub-inner-list">
                                        <li><strong>Primary Level:</strong> 2,500 AED</li>
                                        <li><strong>Middle School:</strong> 3,000 AED</li>
                                        <li><strong>High School:</strong> 3,200 AED</li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ol>',
            'ar' => '<ol class="numbered-list">
                        <li>دفع نقدي كامل.</li>
                        <li>
                            الدفع على قسطين:
                            <ul class="inner-list">
                                <li><strong>القسط الأول:</strong> يستحق بحلول 10/12/2024.</li>
                                <li><strong>القسط الثاني:</strong> يستحق بحلول 15/03/2025.</li>
                                <li>
                                    يشمل الحد الأدنى للدفعة المقدمة الرسوم الدراسية والكتب والتأمين والخدمات الصحية والأنشطة اللاصفية:
                                    <ul class="sub-inner-list">
                                        <li><strong>المرحلة الابتدائية:</strong> 2,500 درهم</li>
                                        <li><strong>المرحلة المتوسطة:</strong> 3,000 درهم</li>
                                        <li><strong>المرحلة الثانوية:</strong> 3,200 درهم</li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ol>'
        ],
        'bank_accounts_title' => [
            'fa' => 'حساب‌های بانکی:',
            'en' => 'Bank Accounts:',
            'ar' => 'الحسابات المصرفية:'
        ],
        'approved_banks_title' => [
            'fa' => 'بانک‌های مورد تأیید:',
            'en' => 'Approved Banks:',
            'ar' => 'البنوك المعتمدة:'
        ],
        'approved_banks_list' => [
            'fa' => 'دبی اسلامی، بانک اسلامی شارجه، بانک RAK، بانک تجاری دبی، بانک اتحاد ابوظبی.',
            'en' => 'Dubai Islamic, Sharjah Islamic Bank, RAK Bank, Commercial Bank of Dubai, Abu Dhabi Union Bank.',
            'ar' => 'دبي الإسلامي، بنك الشارقة الإسلامي، بنك رأس الخيمة، بنك دبي التجاري، بنك الاتحاد أبوظبي.'
        ],
        'school_regulations_title' => [
            'fa' => 'مقررات مدرسه',
            'en' => 'School Regulations',
            'ar' => 'اللوائح المدرسية'
        ],
        'code_of_conduct_text' => [
            'fa' => 'قبل از ثبت‌نام، مطالعه و پذیرش <strong>آیین‌نامه انضباطی</strong> الزامی است. با ثبت‌نام در مدرسه سلمان فارسی، شما موافقت می‌کنید که از تمام سیاست‌های مدرسه پیروی کنید.',
            'en' => 'Prior to registration, it is mandatory to read and accept the <strong>Code of Conduct</strong>. By registering at Salman Farsi School, you agree to adhere to all school policies.',
            'ar' => 'قبل التسجيل، من الإلزامي قراءة وقبول <strong>مدونة السلوك</strong>. من خلال التسجيل في مدرسة سلمان الفارسي، فإنك توافق على الالتزام بجميع سياسات المدرسة.'
        ],
        'code_of_conduct_link' => [
            'fa' => '#',
            'en' => '#',
            'ar' => '#'
        ],
        'read_complete_code_button' => [
            'fa' => 'مطالعه کامل آیین‌نامه انضباطی',
            'en' => 'Read the Complete Code of Conduct',
            'ar' => 'قراءة مدونة السلوك الكاملة'
        ],
        'apply_today_title' => [
            'fa' => 'امروز ثبت‌نام کنید',
            'en' => 'Apply today',
            'ar' => 'سجّل اليوم'
        ],
        'apply_today_text' => [
            'fa' => 'برای ثبت‌نام در مدرسه سلمان فارسی، فرم آنلاین زیر را تکمیل کنید. فرصت‌های ثبت‌نام محدود است.',
            'en' => 'To register at Salman Farsi School, complete the online form below. Registration spots are limited.',
            'ar' => 'للتسجيل في مدرسة سلمان الفارسي، أكمل النموذج عبر الإنترنت أدناه. أماكن التسجيل محدودة.'
        ],
        'apply_now_button' => [
            'fa' => 'ثبت‌نام',
            'en' => 'Apply Now',
            'ar' => 'سجّل الآن'
        ],
        'need_help_title' => [
            'fa' => 'نیاز به کمک دارید؟',
            'en' => 'Need Help?',
            'ar' => 'بحاجة للمساعدة؟'
        ],
        'call_us_label' => [
            'fa' => 'با ما تماس بگیرید:',
            'en' => 'Call Us:',
            'ar' => 'اتصل بنا:'
        ],
        'school_phone' => [
            'fa' => '+97142824214',
            'en' => '+97142824214',
            'ar' => '+97142824214'
        ],
        'email_label' => [
            'fa' => 'ایمیل:',
            'en' => 'Email:',
            'ar' => 'البريد الإلكتروني:'
        ],
        'school_email' => [
            'fa' => 'info@salmanfarsi.ae',
            'en' => 'info@salmanfarsi.ae',
            'ar' => 'info@salmanfarsi.ae'
        ],
        'visit_us_label' => [
            'fa' => 'از ما بازدید کنید:',
            'en' => 'Visit Us:',
            'ar' => 'زرنا:'
        ],
        'school_address' => [
            'fa' => 'القصیص، دبی، امارات متحده عربی',
            'en' => 'Al Qusais, Dubai, United Arab Emirates',
            'ar' => 'القصيص، دبي، الإمارات العربية المتحدة'
        ],
        'important_dates_title' => [
            'fa' => 'تاریخ‌های مهم',
            'en' => 'Important Dates',
            'ar' => 'تواريخ مهمة'
        ],
        'faq_section_title' => [
            'fa' => 'سؤالات متداول',
            'en' => 'Frequently Asked Questions',
            'ar' => 'الأسئلة المتداولة'
        ],
        'faq_section_text' => [
            'fa' => 'پاسخ سؤالات رایج خود را در صفحه سؤالات متداول ما پیدا کنید.',
            'en' => 'Find answers to your common questions on our FAQ page.',
            'ar' => 'ابحث عن إجابات لأسئلتك الشائعة على صفحة الأسئلة المتداولة لدينا.'
        ],
        'view_faqs_button' => [
            'fa' => 'مشاهده سؤالات متداول',
            'en' => 'View FAQs',
            'ar' => 'عرض الأسئلة المتداولة'
        ]
    ];
    
    if (isset($defaultContent[$field_key][$lang])) {
        return $defaultContent[$field_key][$lang];
    }
    
    return $field_key;
}

/**
 * Get default repeating items for registration terms page
 * Fallback if database content is not available
 * 
 * @param string $field_key Field key
 * @param string $lang Language code (fa, en, ar)
 * @return array Default items
 */
function getDefaultRepeatingItems($field_key, $lang) {
    $defaultItems = [
        'required_document' => [
            'fa' => [
                'عکس پاسپورتی دانش‌آموز (با پس‌زمینه سفید)',
                'کپی کارت شناسایی امارات',
                'کپی صفحه اول پاسپورت',
                'کپی گواهی تولد',
                'کپی کارت ملی',
                'کپی ترجمه شده آخرین مدرک تحصیلی (برای دانش‌آموزان جدید)'
            ],
            'en' => [
                'Student\'s Passport Photo (white background)',
                'Copy of Emirates ID',
                'Copy of Passport\'s First Page',
                'Birth Certificate Copy',
                'National ID Copy',
                'Translated Copy of Latest Academic Certificate (for new students)'
            ],
            'ar' => [
                'صورة جواز سفر الطالب (خلفية بيضاء)',
                'نسخة من بطاقة الهوية الإماراتية',
                'نسخة من الصفحة الأولى لجواز السفر',
                'نسخة من شهادة الميلاد',
                'نسخة من بطاقة الهوية الوطنية',
                'نسخة مترجمة من أحدث شهادة أكاديمية (للطلاب الجدد)'
            ]
        ],
        'bank_account' => [
            'fa' => [
                '{"title":"پرداخت‌های شهریه:", "details":"شماره حساب 0101021161720، بانک ملی ایران، شعبه بردبی."}',
                '{"title":"پرداخت‌های حمل و نقل:", "details":"شماره حساب 0101021568820، بانک ملی ایران، شعبه بردبی."}'
            ],
            'en' => [
                '{"title":"Tuition Fee Payments:", "details":"Account No. 0101021161720, Bank Melli Iran, Bur Dubai Branch."}',
                '{"title":"Transportation Fee Payments:", "details":"Account No. 0101021568820, Bank Melli Iran, Bur Dubai Branch."}'
            ],
            'ar' => [
                '{"title":"مدفوعات الرسوم الدراسية:", "details":"رقم الحساب 0101021161720، بنك ملي إيران، فرع بر دبي."}',
                '{"title":"مدفوعات رسوم النقل:", "details":"رقم الحساب 0101021568820، بنك ملي إيران، فرع بر دبي."}'
            ]
        ],
           'important_date' => [
            'fa' => [
                '{"date":"۱۵ مرداد ۱۴۰۴", "description":"مهلت ثبت‌نام برای دانش‌آموزان جدید"}',
                '{"date":"۲۵ مرداد ۱۴۰۴", "description":"شروع سال تحصیلی"}',
                '{"date":"۱۰ آذر ۱۴۰۴", "description":"موعد سررسید قسط اول"}',
                '{"date":"۱۵ اسفند ۱۴۰۴", "description":"موعد سررسید قسط دوم"}'
            ],
            'en' => [
                '{"date":"Aug 15, 2024", "description":"Registration Deadline for New Students"}',
                '{"date":"Aug 25, 2024", "description":"Academic Year Begins"}',
                '{"date":"Dec 10, 2024", "description":"First Installment Due Date"}',
                '{"date":"Mar 15, 2025", "description":"Second Installment Due Date"}'
            ],
            'ar' => [
                '{"date":"15 أغسطس 2024", "description":"الموعد النهائي للتسجيل للطلاب الجدد"}',
                '{"date":"25 أغسطس 2024", "description":"بداية العام الدراسي"}',
                '{"date":"10 ديسمبر 2024", "description":"تاريخ استحقاق القسط الأول"}',
                '{"date":"15 مارس 2025", "description":"تاريخ استحقاق القسط الثاني"}'
            ]
        ]
    ];
    
    if (isset($defaultItems[$field_key][$lang])) {
        return $defaultItems[$field_key][$lang];
    }
    
    return [];
}



/**
 * Check if current language is RTL
 * 
 * @param string $lang Language code (fa, en, ar)
 * @return bool True if language is RTL
 */
function isRtlLanguage($lang) {
    return in_array($lang, ['fa', 'ar']);
}
?>