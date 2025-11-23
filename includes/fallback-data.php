<?php
/**
 * Fallback data for Salman Farsi Educational Complex
 * Used when database connection fails or returns empty results
 */

/**
 * Returns fallback reviews in specified language
 * 
 * @param string $lang Language code (fa, ar, en)
 * @return array Array of review objects
 */
function getFallbackReviews($lang = 'en') {
    $reviews = [];
    
    if ($lang == 'fa') {
        $reviews = [
            [
                'review_id' => 1,
                'person_name' => 'علی محمدی',
                'person_position' => 'والد دانش‌آموز',
                'content' => 'پسر من در مجتمع آموزشی سلمان فارسی تحصیل می‌کند و ما از کیفیت آموزش و محیط امن و دوستانه مدرسه بسیار راضی هستیم. معلمان با تجربه و متعهد هستند و به پیشرفت فرزندمان اهمیت می‌دهند.',
                'image_url' => 'assets/images/testimonials/parent1.jpg',
                'rating' => 5
            ],
            [
                'review_id' => 2,
                'person_name' => 'مریم رضایی',
                'person_position' => 'والد دانش‌آموز',
                'content' => 'دختر من در بخش ابتدایی تحصیل می‌کند و از زمان ورود به مجتمع سلمان فارسی، پیشرفت چشمگیری در مهارت‌های زبانی و اجتماعی داشته است. من قویاً این مدرسه را به خانواده‌های ایرانی در دبی توصیه می‌کنم.',
                'image_url' => 'assets/images/testimonials/parent2.jpg',
                'rating' => 5
            ],
            [
                'review_id' => 3,
                'person_name' => 'سارا احمدی',
                'person_position' => 'دانش‌آموز سابق',
                'content' => 'من در سلمان فارسی تحصیل کردم و اکنون در یکی از بهترین دانشگاه‌های ایران مشغول به تحصیل هستم. مدرسه به من کمک کرد تا پایه‌های علمی قوی داشته باشم و در عین حال با فرهنگ ایرانی ارتباط خود را حفظ کنم.',
                'image_url' => 'assets/images/testimonials/student1.jpg',
                'rating' => 5
            ],
            [
                'review_id' => 4,
                'person_name' => 'رضا کریمی',
                'person_position' => 'والد دانش‌آموز',
                'content' => 'فرزندان من از محیط چندفرهنگی و در عین حال حفظ هویت ایرانی در مجتمع سلمان فارسی بهره می‌برند. آموزش چندزبانه و برنامه‌های فوق‌برنامه متنوع، از نقاط قوت این مدرسه است.',
                'image_url' => 'assets/images/testimonials/parent3.jpg',
                'rating' => 4
            ],
            [
                'review_id' => 5,
                'person_name' => 'فاطمه حسینی',
                'person_position' => 'معلم',
                'content' => 'به عنوان معلم در مجتمع سلمان فارسی، من از محیط حمایتی و سیستم آموزشی پیشرفته لذت می‌برم. مدیریت مدرسه به توسعه حرفه‌ای معلمان اهمیت می‌دهد و این به نفع دانش‌آموزان است.',
                'image_url' => 'assets/images/testimonials/teacher1.jpg',
                'rating' => 5
            ],
            [
                'review_id' => 6,
                'person_name' => 'محمد جعفری',
                'person_position' => 'دانش‌آموز سابق',
                'content' => 'تحصیل در سلمان فارسی تجربه‌ای فوق‌العاده بود. معلمان متعهد و برنامه‌های آموزشی متنوع به من کمک کردند تا به اهداف تحصیلی خود برسم و اکنون در دانشگاه موفق هستم.',
                'image_url' => 'assets/images/testimonials/student2.jpg',
                'rating' => 5
            ]
        ];
    } elseif ($lang == 'ar') {
        $reviews = [
            [
                'review_id' => 1,
                'person_name' => 'علي محمدي',
                'person_position' => 'والد طالب',
                'content' => 'يدرس ابني في مجمع سلمان الفارسي التعليمي، ونحن راضون تمامًا عن جودة التعليم والبيئة الآمنة والودية للمدرسة. المعلمون ذوو خبرة وملتزمون ويهتمون بتقدم أطفالنا.',
                'image_url' => 'assets/images/testimonials/parent1.jpg',
                'rating' => 5
            ],
            [
                'review_id' => 2,
                'person_name' => 'مريم رضائي',
                'person_position' => 'والدة طالبة',
                'content' => 'تدرس ابنتي في القسم الابتدائي وقد أحرزت تقدمًا ملحوظًا في المهارات اللغوية والاجتماعية منذ دخولها مجمع سلمان الفارسي. أوصي بشدة بهذه المدرسة للعائلات الإيرانية في دبي.',
                'image_url' => 'assets/images/testimonials/parent2.jpg',
                'rating' => 5
            ],
            [
                'review_id' => 3,
                'person_name' => 'سارة أحمدي',
                'person_position' => 'طالبة سابقة',
                'content' => 'درست في سلمان الفارسي والآن أدرس في إحدى أفضل الجامعات في إيران. ساعدتني المدرسة في بناء أساس علمي قوي مع الحفاظ على الارتباط بالثقافة الإيرانية.',
                'image_url' => 'assets/images/testimonials/student1.jpg',
                'rating' => 5
            ],
            [
                'review_id' => 4,
                'person_name' => 'رضا كريمي',
                'person_position' => 'والد طالب',
                'content' => 'يستفيد أطفالي من البيئة متعددة الثقافات مع الحفاظ على الهوية الإيرانية في مجمع سلمان الفارسي. التعليم متعدد اللغات والأنشطة اللامنهجية المتنوعة هي من نقاط القوة في هذه المدرسة.',
                'image_url' => 'assets/images/testimonials/parent3.jpg',
                'rating' => 4
            ],
            [
                'review_id' => 5,
                'person_name' => 'فاطمة حسيني',
                'person_position' => 'معلمة',
                'content' => 'كمعلمة في مجمع سلمان الفارسي، أستمتع ببيئة داعمة ونظام تعليمي متقدم. تهتم إدارة المدرسة بالتطوير المهني للمعلمين، وهذا يعود بالنفع على الطلاب.',
                'image_url' => 'assets/images/testimonials/teacher1.jpg',
                'rating' => 5
            ],
            [
                'review_id' => 6,
                'person_name' => 'محمد جعفري',
                'person_position' => 'طالب سابق',
                'content' => 'كانت الدراسة في سلمان الفارسي تجربة رائعة. ساعدني المعلمون الملتزمون والبرامج التعليمية المتنوعة على تحقيق أهدافي الأكاديمية، والآن أنا ناجح في الجامعة.',
                'image_url' => 'assets/images/testimonials/student2.jpg',
                'rating' => 5
            ]
        ];
    } else {
        // English fallback reviews
        $reviews = [
            [
                'review_id' => 1,
                'person_name' => 'Ali Mohammadi',
                'person_position' => 'Parent',
                'content' => 'My son studies at Salman Farsi Educational Complex, and we are very satisfied with the quality of education and the safe, friendly school environment. The teachers are experienced and committed and care about our children\'s progress.',
                'image_url' => 'assets/images/testimonials/parent1.jpg',
                'rating' => 5
            ],
            [
                'review_id' => 2,
                'person_name' => 'Maryam Rezaei',
                'person_position' => 'Parent',
                'content' => 'My daughter studies in the elementary section and has made remarkable progress in language and social skills since entering Salman Farsi Complex. I strongly recommend this school to Iranian families in Dubai.',
                'image_url' => 'assets/images/testimonials/parent2.jpg',
                'rating' => 5
            ],
            [
                'review_id' => 3,
                'person_name' => 'Sara Ahmadi',
                'person_position' => 'Former Student',
                'content' => 'I studied at Salman Farsi and now I am studying at one of the best universities in Iran. The school helped me build a strong scientific foundation while maintaining a connection to Iranian culture.',
                'image_url' => 'assets/images/testimonials/student1.jpg',
                'rating' => 5
            ],
            [
                'review_id' => 4,
                'person_name' => 'Reza Karimi',
                'person_position' => 'Parent',
                'content' => 'My children benefit from the multicultural environment while preserving Iranian identity at Salman Farsi Complex. Multilingual education and diverse extracurricular programs are strengths of this school.',
                'image_url' => 'assets/images/testimonials/parent3.jpg',
                'rating' => 4
            ],
            [
                'review_id' => 5,
                'person_name' => 'Fatima Hosseini',
                'person_position' => 'Teacher',
                'content' => 'As a teacher at Salman Farsi Complex, I enjoy the supportive environment and advanced educational system. The school management values the professional development of teachers, which benefits the students.',
                'image_url' => 'assets/images/testimonials/teacher1.jpg',
                'rating' => 5
            ],
            [
                'review_id' => 6,
                'person_name' => 'Mohammad Jafari',
                'person_position' => 'Former Student',
                'content' => 'Studying at Salman Farsi was an excellent experience. The committed teachers and diverse educational programs helped me achieve my academic goals, and now I am successful in university.',
                'image_url' => 'assets/images/testimonials/student2.jpg',
                'rating' => 5
            ]
        ];
    }
    
    return $reviews;
}

/**
 * Returns fallback FAQs in specified language
 * 
 * @param string $lang Language code (fa, ar, en)
 * @return array Array of FAQ objects
 */
function getFallbackFaqs($lang = 'en') {
    $faqs = [];
    
    if ($lang == 'fa') {
        $faqs = [
            [
                'id' => 1,
                'field_key' => 'زبان تدریس در مدرسه چه زبان‌هایی است؟',
                'content' => 'زبان تدریس اصلی در مدرسه ما فارسی است، با این حال، زبان‌های انگلیسی و عربی نیز در برنامه درسی گنجانده شده‌اند تا مهارت‌های زبانی دانش‌آموزان تقویت شود.',
                'language_id' => 1,
                'category_id' => 1,
                'is_repeatable' => 1,
                'sort_order' => 1
            ],
            [
                'id' => 2,
                'field_key' => 'نحوه ثبت‌نام در مدرسه چیست و مدارک و زمان‌بندی ثبت‌نام چگونه است؟',
                'content' => 'برای ثبت‌نام در مدرسه، والدین باید به صورت حضوری مراجعه کرده و مدارک مورد نیاز شامل شناسنامه، کارت ملی، گواهی سلامت، عکس پرسنلی و مدارک تحصیلی قبلی را ارائه دهند. لطفاً برای اطلاعات دقیق‌تر و مطمئن‌شدن از مدارک لازم، قبل از مراجعه حضوری با مدرسه تماس بگیرید. ثبت‌نام در ماه‌های خرداد و تیر انجام می‌شود و در صورتی که بعد از این زمان ثبت‌نام صورت گیرد، هزینه‌ای تحت عنوان جریمه دریافت خواهد شد.',
                'language_id' => 1,
                'category_id' => 1,
                'is_repeatable' => 1,
                'sort_order' => 2
            ],
            [
                'id' => 3,
                'field_key' => 'هزینه‌های شهریه مدرسه چقدر است و شامل چه مواردی می‌شود؟',
                'content' => 'هزینه‌های شهریه بر اساس مقطع تحصیلی و رشته انتخابی متفاوت است. شهریه شامل هزینه‌های آموزشی، کتاب‌های درسی، فعالیت‌های فوق‌برنامه و خدمات پایه مدرسه می‌شود. برای اطلاعات دقیق‌تر، لطفاً با بخش مالی مدرسه تماس بگیرید.',
                'language_id' => 1,
                'category_id' => 2,
                'is_repeatable' => 1,
                'sort_order' => 3
            ],
            [
                'id' => 4,
                'field_key' => 'آیا مدرسه سرویس رفت و آمد دارد؟',
                'content' => 'بله، مدرسه سرویس رفت و آمد مجهز به سیستم ایمنی و با رانندگان مجرب برای دانش‌آموزان فراهم می‌کند. مسیرهای سرویس بر اساس محل سکونت دانش‌آموزان تعیین می‌شود و هزینه آن جداگانه محاسبه می‌شود.',
                'language_id' => 1,
                'category_id' => 2,
                'is_repeatable' => 1,
                'sort_order' => 4
            ],
            [
                'id' => 5,
                'field_key' => 'برنامه‌های فوق‌برنامه مدرسه شامل چه فعالیت‌هایی می‌شود؟',
                'content' => 'مدرسه طیف گسترده‌ای از فعالیت‌های فوق‌برنامه از جمله ورزش‌های مختلف (فوتبال، والیبال، شنا)، کلاس‌های هنری (نقاشی، موسیقی، تئاتر)، باشگاه‌های علمی (رباتیک، نجوم، برنامه‌نویسی) و فعالیت‌های فرهنگی (جشن‌های ملی و مذهبی) ارائه می‌دهد.',
                'language_id' => 1,
                'category_id' => 3,
                'is_repeatable' => 1,
                'sort_order' => 5
            ],
            [
                'id' => 6,
                'field_key' => 'تعطیلات و روزهای مدرسه چگونه است؟',
                'content' => 'سال تحصیلی ما از اوایل سپتامبر تا اواخر ژوئن ادامه دارد، با تعطیلات در ایام عید نوروز و تعطیلات رسمی امارات متحده عربی. روزهای مدرسه از شنبه تا چهارشنبه است، و ساعات مدرسه از 7:30 صبح تا 2:30 بعد از ظهر می‌باشد.',
                'language_id' => 1,
                'category_id' => 3,
                'is_repeatable' => 1,
                'sort_order' => 6
            ]
        ];
    } elseif ($lang == 'ar') {
        $faqs = [
            [
                'id' => 1,
                'field_key' => 'ما هي لغات التدريس في المدرسة؟',
                'content' => 'اللغة الرئيسية للتدريس في مدرستنا هي الفارسية، بينما يتم تضمين اللغتين الإنجليزية والعربية أيضًا في المنهج الدراسي لتعزيز مهارات اللغة لدى الطلاب.',
                'language_id' => 3,
                'category_id' => 1,
                'is_repeatable' => 1,
                'sort_order' => 1
            ],
            [
                'id' => 2,
                'field_key' => 'ما هي عملية التسجيل وما هي المستندات المطلوبة والجدول الزمني؟',
                'content' => 'للتسجيل في المدرسة، يجب على الوالدين زيارة المدرسة شخصيًا وتقديم المستندات المطلوبة مثل شهادة الميلاد وبطاقة الهوية وشهادة صحية وصورة شخصية والسجلات الأكاديمية السابقة. للحصول على معلومات مفصلة والتأكد من المستندات اللازمة، يرجى الاتصال بالمدرسة قبل الزيارة. يتم التسجيل عادة في يونيو ويوليو، وستتحمل التسجيلات المتأخرة رسوم إضافية.',
                'language_id' => 3,
                'category_id' => 1,
                'is_repeatable' => 1,
                'sort_order' => 2
            ],
            [
                'id' => 3,
                'field_key' => 'ما هي الرسوم الدراسية وماذا تغطي؟',
                'content' => 'تختلف الرسوم الدراسية حسب المستوى الدراسي والتخصص المختار. تغطي الرسوم تكاليف التعليم والكتب المدرسية والأنشطة اللامنهجية وخدمات المدرسة الأساسية. لمزيد من التفاصيل، يرجى الاتصال بقسم المالية في المدرسة.',
                'language_id' => 3,
                'category_id' => 2,
                'is_repeatable' => 1,
                'sort_order' => 3
            ],
            [
                'id' => 4,
                'field_key' => 'هل توفر المدرسة خدمة النقل؟',
                'content' => 'نعم، توفر المدرسة خدمة نقل مجهزة بأنظمة سلامة وسائقين ذوي خبرة للطلاب. يتم تحديد مسارات الخدمة بناءً على مكان إقامة الطلاب ويتم احتساب تكلفتها بشكل منفصل.',
                'language_id' => 3,
                'category_id' => 2,
                'is_repeatable' => 1,
                'sort_order' => 4
            ],
            [
                'id' => 5,
                'field_key' => 'ما هي الأنشطة اللامنهجية التي تقدمها المدرسة؟',
                'content' => 'تقدم المدرسة مجموعة واسعة من الأنشطة اللامنهجية بما في ذلك الرياضات المختلفة (كرة القدم، الكرة الطائرة، السباحة)، الفصول الفنية (الرسم، الموسيقى، المسرح)، النوادي العلمية (الروبوتات، علم الفلك، البرمجة) والأنشطة الثقافية (الاحتفالات الوطنية والدينية).',
                'language_id' => 3,
                'category_id' => 3,
                'is_repeatable' => 1,
                'sort_order' => 5
            ],
            [
                'id' => 6,
                'field_key' => 'كيف هي العطلات وأيام الدراسة في المدرسة؟',
                'content' => 'تستمر سنتنا الدراسية من أوائل سبتمبر حتى أواخر يونيو، مع عطلات خلال عيد النوروز والعطلات الرسمية في الإمارات العربية المتحدة. أيام الدراسة هي من السبت إلى الأربعاء، وساعات الدراسة من 7:30 صباحًا حتى 2:30 مساءً.',
                'language_id' => 3,
                'category_id' => 3,
                'is_repeatable' => 1,
                'sort_order' => 6
            ]
        ];
    } else {
        // English fallback FAQs
        $faqs = [
            [
                'id' => 1,
                'field_key' => 'What languages are used for instruction at the school?',
                'content' => 'The primary language of instruction at our school is Persian, while English and Arabic are also included in the curriculum to enhance students\' language skills.',
                'language_id' => 2,
                'category_id' => 1,
                'is_repeatable' => 1,
                'sort_order' => 1
            ],
            [
                'id' => 2,
                'field_key' => 'What is the registration process, and what are the required documents and timeline?',
                'content' => 'To register at the school, parents need to visit the school in person and provide required documents such as birth certificate, ID card, health certificate, passport-sized photo, and previous academic records. For detailed information and to confirm the necessary documents, please contact the school before visiting. Registration typically occurs in June and July, and late registrations will incur an additional penalty fee.',
                'language_id' => 2,
                'category_id' => 1,
                'is_repeatable' => 1,
                'sort_order' => 2
            ],
            [
                'id' => 3,
                'field_key' => 'What are the tuition fees and what do they cover?',
                'content' => 'Tuition fees vary depending on the grade level and chosen specialization. The fees cover educational costs, textbooks, extracurricular activities, and basic school services. For more precise details, please contact the school\'s finance department.',
                'language_id' => 2,
                'category_id' => 2,
                'is_repeatable' => 1,
                'sort_order' => 3
            ],
            [
                'id' => 4,
                'field_key' => 'Does the school provide transportation services?',
                'content' => 'Yes, the school provides transportation services equipped with safety systems and experienced drivers for students. Service routes are determined based on students\' residences, and the cost is calculated separately.',
                'language_id' => 2,
                'category_id' => 2,
                'is_repeatable' => 1,
                'sort_order' => 4
            ],
            [
                'id' => 5,
                'field_key' => 'What extracurricular activities does the school offer?',
                'content' => 'The school offers a wide range of extracurricular activities including various sports (football, volleyball, swimming), art classes (painting, music, theater), science clubs (robotics, astronomy, programming), and cultural activities (national and religious celebrations).',
                'language_id' => 2,
                'category_id' => 3,
                'is_repeatable' => 1,
                'sort_order' => 5
            ],
            [
                'id' => 6,
                'field_key' => 'What are the school holidays and days?',
                'content' => 'Our academic year runs from early September to late June, with holidays during Nowruz and UAE official holidays. School days are from Saturday to Wednesday, and school hours are from 7:30 AM to 2:30 PM.',
                'language_id' => 2,
                'category_id' => 3,
                'is_repeatable' => 1,
                'sort_order' => 6
            ]
        ];
    }
    
    return $faqs;
}

/**
 * Returns fallback blog posts in specified language
 * 
 * @param string $lang Language code (fa, ar, en)
 * @return array Array of blog post objects
 */
function getFallbackPosts($lang = 'en') {
    $posts = [];
    
    if ($lang == 'fa') {
        $posts = [
            [
                'post_id' => 1,
                'title' => 'شروع سال تحصیلی جدید با مراسم ویژه استقبال از دانش‌آموزان',
                'excerpt' => 'مجتمع آموزشی سلمان فارسی، سال تحصیلی جدید را با برگزاری مراسم ویژه‌ای برای استقبال از دانش‌آموزان آغاز کرد. در این مراسم، برنامه‌های متنوع فرهنگی و هنری اجرا شد.',
                'content' => 'مجتمع آموزشی سلمان فارسی، سال تحصیلی جدید را با برگزاری مراسم ویژه‌ای برای استقبال از دانش‌آموزان آغاز کرد. در این مراسم، برنامه‌های متنوع فرهنگی و هنری اجرا شد و مدیر مجتمع ضمن خوشامدگویی به دانش‌آموزان و خانواده‌ها، برنامه‌های آموزشی سال جدید را تشریح کرد.',
                'category_id' => 1,
                'category_name' => 'رویدادها',
                'published_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'image_path' => 'assets/images/blog/school-ceremony.jpg'
            ],
            [
                'post_id' => 2,
                'title' => 'درخشش دانش‌آموزان مجتمع سلمان فارسی در المپیاد علمی بین‌المللی',
                'excerpt' => 'دانش‌آموزان مجتمع آموزشی سلمان فارسی در المپیاد علمی بین‌المللی درخشیدند و موفق به کسب مدال‌های طلا، نقره و برنز شدند. این موفقیت نشان‌دهنده کیفیت بالای آموزش در این مجتمع است.',
                'content' => 'دانش‌آموزان مجتمع آموزشی سلمان فارسی در المپیاد علمی بین‌المللی درخشیدند و موفق به کسب مدال‌های طلا، نقره و برنز شدند. این موفقیت نشان‌دهنده کیفیت بالای آموزش در این مجتمع است و باعث افتخار جامعه ایرانیان مقیم دبی شده است.',
                'category_id' => 2,
                'category_name' => 'دستاوردها',
                'published_at' => date('Y-m-d H:i:s', strtotime('-1 week')),
                'image_path' => 'assets/images/blog/olympiad.jpg'
            ],
            [
                'post_id' => 3,
                'title' => 'افتتاح آزمایشگاه هوش مصنوعی و رباتیک در مجتمع آموزشی سلمان فارسی',
                'excerpt' => 'مجتمع آموزشی سلمان فارسی با هدف تقویت مهارت‌های فناوری دانش‌آموزان، آزمایشگاه پیشرفته هوش مصنوعی و رباتیک را افتتاح کرد. این آزمایشگاه مجهز به جدیدترین تجهیزات و فناوری‌های روز است.',
                'content' => 'مجتمع آموزشی سلمان فارسی با هدف تقویت مهارت‌های فناوری دانش‌آموزان، آزمایشگاه پیشرفته هوش مصنوعی و رباتیک را افتتاح کرد. این آزمایشگاه مجهز به جدیدترین تجهیزات و فناوری‌های روز است و به دانش‌آموزان امکان می‌دهد تا با مفاهیم پیشرفته برنامه‌نویسی، هوش مصنوعی و رباتیک آشنا شوند.',
                'category_id' => 3,
                'category_name' => 'امکانات',
                'published_at' => date('Y-m-d H:i:s', strtotime('-2 weeks')),
                'image_path' => 'assets/images/blog/robotics-lab.jpg'
            ]
        ];
    } elseif ($lang == 'ar') {
        $posts = [
            [
                'post_id' => 1,
                'title' => 'بدء العام الدراسي الجديد مع حفل استقبال خاص للطلاب',
                'excerpt' => 'بدأ مجمع سلمان الفارسي التعليمي العام الدراسي الجديد بحفل خاص لاستقبال الطلاب. تضمن الحفل برامج ثقافية وفنية متنوعة.',
                'content' => 'بدأ مجمع سلمان الفارسي التعليمي العام الدراسي الجديد بحفل خاص لاستقبال الطلاب. تضمن الحفل برامج ثقافية وفنية متنوعة، ورحب مدير المجمع بالطلاب وعائلاتهم وشرح البرامج التعليمية للعام الجديد.',
                'category_id' => 1,
                'category_name' => 'فعاليات',
                'published_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'image_path' => 'assets/images/blog/school-ceremony.jpg'
            ],
            [
                'post_id' => 2,
                'title' => 'تألق طلاب مجمع سلمان الفارسي في الأولمبياد العلمي الدولي',
                'excerpt' => 'تألق طلاب مجمع سلمان الفارسي التعليمي في الأولمبياد العلمي الدولي، وفازوا بميداليات ذهبية وفضية وبرونزية. هذا النجاح يدل على جودة التعليم العالية في المجمع.',
                'content' => 'تألق طلاب مجمع سلمان الفارسي التعليمي في الأولمبياد العلمي الدولي، وفازوا بميداليات ذهبية وفضية وبرونزية. هذا النجاح يدل على جودة التعليم العالية في المجمع وأصبح مصدر فخر للمجتمع الإيراني في دبي.',
                'category_id' => 2,
                'category_name' => 'إنجازات',
                'published_at' => date('Y-m-d H:i:s', strtotime('-1 week')),
                'image_path' => 'assets/images/blog/olympiad.jpg'
            ],
            [
                'post_id' => 3,
                'title' => 'افتتاح مختبر الذكاء الاصطناعي والروبوتات في مجمع سلمان الفارسي التعليمي',
                'excerpt' => 'افتتح مجمع سلمان الفارسي التعليمي مختبر الذكاء الاصطناعي والروبوتات المتقدم لتعزيز مهارات الطلاب التكنولوجية. المختبر مجهز بأحدث المعدات والتقنيات.',
                'content' => 'افتتح مجمع سلمان الفارسي التعليمي مختبر الذكاء الاصطناعي والروبوتات المتقدم لتعزيز مهارات الطلاب التكنولوجية. المختبر مجهز بأحدث المعدات والتقنيات، مما يتيح للطلاب التعرف على مفاهيم البرمجة المتقدمة والذكاء الاصطناعي والروبوتات.',
                'category_id' => 3,
                'category_name' => 'مرافق',
                'published_at' => date('Y-m-d H:i:s', strtotime('-2 weeks')),
                'image_path' => 'assets/images/blog/robotics-lab.jpg'
            ]
        ];
    } else {
        // English fallback posts
        $posts = [
            [
                'post_id' => 1,
                'title' => 'Start of New Academic Year with Special Student Welcome Ceremony',
                'excerpt' => 'Salman Farsi Educational Complex started the new academic year with a special ceremony to welcome students. The ceremony included various cultural and artistic programs.',
                'content' => 'Salman Farsi Educational Complex started the new academic year with a special ceremony to welcome students. The ceremony included various cultural and artistic programs, and the complex director welcomed students and families while explaining the educational programs for the new year.',
                'category_id' => 1,
                'category_name' => 'Events',
                'published_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'image_path' => 'assets/images/blog/school-ceremony.jpg'
            ],
            [
                'post_id' => 2,
                'title' => 'Salman Farsi Students Shine in International Science Olympiad',
                'excerpt' => 'Salman Farsi Educational Complex students shined in the International Science Olympiad, winning gold, silver, and bronze medals. This success demonstrates the high quality of education in the complex.',
                'content' => 'Salman Farsi Educational Complex students shined in the International Science Olympiad, winning gold, silver, and bronze medals. This success demonstrates the high quality of education in the complex and has become a source of pride for the Iranian community in Dubai.',
                'category_id' => 2,
                'category_name' => 'Achievements',
                'published_at' => date('Y-m-d H:i:s', strtotime('-1 week')),
                'image_path' => 'assets/images/blog/olympiad.jpg'
            ],
            [
                'post_id' => 3,
                'title' => 'Opening of AI and Robotics Laboratory at Salman Farsi Educational Complex',
                'excerpt' => 'Salman Farsi Educational Complex opened an advanced AI and Robotics Laboratory to strengthen students\' technology skills. The laboratory is equipped with the latest equipment and technologies.',
                'content' => 'Salman Farsi Educational Complex opened an advanced AI and Robotics Laboratory to strengthen students\' technology skills. The laboratory is equipped with the latest equipment and technologies, allowing students to familiarize themselves with advanced concepts of programming, artificial intelligence, and robotics.',
                'category_id' => 3,
                'category_name' => 'Facilities',
                'published_at' => date('Y-m-d H:i:s', strtotime('-2 weeks')),
                'image_path' => 'assets/images/blog/robotics-lab.jpg'
            ]
        ];
    }
    
    return $posts;
}