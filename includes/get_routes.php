<?php

/**
 * دریافت مسیرهای سرویس حمل و نقل
 * نسخه بهبود یافته با خطایابی بیشتر
 */

// تنظیم هدر برای اجازه دسترسی AJAX
header('Content-Type: application/json; charset=utf-8');

// بررسی درخواست AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // دریافت پارامترهای ارسالی
    $city = isset($_POST['city']) ? trim($_POST['city']) : '';
    $language = isset($_POST['lang']) ? trim($_POST['lang']) : 'fa';
    
    // لاگ اطلاعات ورودی برای دیباگ
    error_log("Route request received - City: {$city}, Language: {$language}");
    
    // اطمینان از وجود پارامترهای لازم
    if (!empty($city)) {
        try {
            // تبدیل کد زبان به شناسه زبان
            $langId = 1; // پیش‌فرض فارسی
            if ($language == 'en') {
                $langId = 2;
            } else if ($language == 'ar') {
                $langId = 3;
            }
            
            // داده‌های مختلف برای هر شهر
            $routes = [];
            switch ($city) {
                case 'dubai':
                    $routes = [
                        [
                            'id' => 4,
                            'name' => ($language == 'fa') ? 'مسیر الصفا - مردیف' : (($language == 'en') ? 'Al Safa - Mirdif Route' : 'مسار الصفا - مردف'),
                            'description' => ($language == 'fa') ? 'الصفا - مردیف - الرشیدیه - ند الحمر - الورقاء' : (($language == 'en') ? 'Al Safa - Mirdif - Al Rashidiya - Nad Al Hamar - Al Warqa' : 'الصفا - مردف - الرشيدية - ند الحمر - الورقاء')
                        ],
                        [
                            'id' => 5,
                            'name' => ($language == 'fa') ? 'مسیر بر دبی - المنخول' : (($language == 'en') ? 'Bur Dubai - Al Mankhool Route' : 'مسار بر دبي - المنخول'),
                            'description' => ($language == 'fa') ? 'بر دبی - المنخول - مصلی نزدیک قبرستان - مینا بازار' : (($language == 'en') ? 'Bur Dubai - Al Mankhool - Musalla near Cemetery - Meena Bazaar' : 'بر دبي - المنخول - المصلى بجوار المقبرة - سوق المينا')
                        ],
                        [
                            'id' => 7,
                            'name' => ($language == 'fa') ? 'مسیر ابوهیل - هور العنز' : (($language == 'en') ? 'Abu Hail - Hor Al Anz Route' : 'مسار أبو هيل - هور العنز'),
                            'description' => ($language == 'fa') ? 'ابوهیل - هور العنز - المتینه - میدان ماهی - نایف - الکرامه' : (($language == 'en') ? 'Abu Hail - Hor Al Anz - Al Muteena - Fish Roundabout - Naif - Al Karama' : 'أبو هيل - هور العنز - المتينة - دوار السمك - نايف - الكرامة')
                        ]
                    ];
                    break;
                    
                case 'sharjah':
                    $routes = [
                        [
                            'id' => 1,
                            'name' => ($language == 'fa') ? 'مسیر قافیه - مدرسه شارجه' : (($language == 'en') ? 'Qafiya - Sharjah School Route' : 'مسار القافية - مدرسة الشارقة'),
                            'description' => ($language == 'fa') ? 'قافیه - مدرسه شارجه - میدان اول التعاون - المتینه - بازار قدیم' : (($language == 'en') ? 'Qafiya - Sharjah School - First Al Taawun Roundabout - Al Muteena - Old Market' : 'القافية - مدرسة الشارقة - دوار التعاون الأول - المتينة - السوق القديم')
                        ],
                        [
                            'id' => 6,
                            'name' => ($language == 'fa') ? 'مسیر پارک النهضه - شارجه' : (($language == 'en') ? 'Al Nahda Park - Sharjah Route' : 'مسار حديقة النهضة - الشارقة'),
                            'description' => ($language == 'fa') ? 'پارک النهضه، شارجه - خیابان اصلی التعاون - انصار مال - النهضه شارجه' : (($language == 'en') ? 'Al Nahda Park, Sharjah - Main Street Al Taawun - Ansar Mall - Al Nahda Sharjah' : 'حديقة النهضة، الشارقة - شارع التعاون الرئيسي - أنصار مول - النهضة الشارقة')
                        ]
                    ];
                    break;
                    
                case 'ajman':
                    $routes = [
                        [
                            'id' => 2,
                            'name' => ($language == 'fa') ? 'مسیر خیابان اصلی منطقه صنعتی - الروضه' : (($language == 'en') ? 'Industrial Area Main Street - Al Rawda Route' : 'مسار المنطقة الصناعية - الروضة'),
                            'description' => ($language == 'fa') ? 'خیابان اصلی منطقه صنعتی - الروضه ۱ و ۲ - الحمیدیه - المویهات' : (($language == 'en') ? 'Industrial Area Main Street - Al Rawda 1 & 2 - Al Hamidiya - Al Mowaihat' : 'المنطقة الصناعية - الروضة 1 و2 - الحميدية - المويهات')
                        ],
                        [
                            'id' => 3,
                            'name' => ($language == 'fa') ? 'مسیر عجمان - بیمارستان GMC' : (($language == 'en') ? 'Ajman - GMC Hospital Route' : 'مسار عجمان - مستشفى GMC'),
                            'description' => ($language == 'fa') ? 'عجمان، بیمارستان GMC - تقاطع کویت - النعیمیه ۲ و ۳ - بازارهای العین' : (($language == 'en') ? 'Ajman, GMC Hospital - Kuwait Junction - Al Nuaimiya 2 & 3 - Al Ain Markets' : 'عجمان - مستشفى GMC - تقاطع الكويت - النعيمية 2 و3 - أسواق العين')
                        ]
                    ];
                    break;
                    
                default:
                    // در صورت ارسال شهر نامعتبر
                    error_log("Invalid city requested: {$city}");
                    echo json_encode([
                        'error' => 'شهر مورد نظر یافت نشد',
                        'requested_city' => $city
                    ]);
                    exit;
            }
            
            // برگرداندن مسیرها
            error_log("Routes found for city {$city}: " . count($routes));
            echo json_encode($routes);
            
        } catch (Exception $e) {
            error_log("Error in get_routes.php: " . $e->getMessage());
            echo json_encode([
                'error' => 'خطای سیستمی: ' . $e->getMessage(),
                'debug_info' => [
                    'city' => $city,
                    'language' => $language
                ]
            ]);
        }
    } else {
        // برگرداندن خطا برای پارامترهای ناقص
        error_log("Empty city parameter in request");
        echo json_encode([
            'error' => 'پارامتر شهر ارسال نشده است',
            'debug_info' => $_POST
        ]);
    }
} else {
    // برگرداندن خطای روش درخواست
    error_log("Invalid request method: " . $_SERVER['REQUEST_METHOD']);
    echo json_encode([
        'error' => 'روش درخواست نامعتبر است. فقط POST پشتیبانی می‌شود.',
        'method' => $_SERVER['REQUEST_METHOD']
    ]);
}
?>