<?php
/**
 * Staff Page - Final Fixed Version
 * 
 * This file displays all staff members and ensures that the Director (ID=1)
 * is always shown and categorized as management regardless of language.
 * 
 * @package Salman Educational Complex
 * @version 7.0
 */

// Include configuration file
require_once 'includes/config.php';

// Get current language for localization
$lang = getCurrentLanguage();
$isRtl = ($lang == 'fa');

// Connect to database
$conn = connectDB();

// Get language ID for current language
$language_id = 1; // Default to Persian (ID=1)
$sql = "SELECT language_id FROM languages WHERE code = '{$lang}' LIMIT 1";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $language_id = $row['language_id'];
}

// Get static content from database
$page_content = [];

// Query to get page content from staff_content table
$sql = "SELECT field_key, content FROM staff_content WHERE language_id = '{$language_id}'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $page_content[$row['field_key']] = $row['content'];
    }
}

// Default values in case database doesn't have entries yet
$defaults = [
    'fa' => [
        'page_title' => 'کارکنان مجتمع',
        'header_title' => 'کارکنان مجتمع',
        'header_subtitle' => 'آشنایی با اعضای هیئت علمی و کارکنان مجتمع آموزشی سلمان فارسی',
        'search_placeholder' => 'جستجوی نام یا سمت...',
        'filter_all' => 'همه',
        'filter_management' => 'مدیریت',
        'filter_teaching' => 'آموزشی',
        'filter_support' => 'پشتیبانی',
        'no_staff_found' => 'هیچ عضوی یافت نشد',
        'no_results_title' => 'نتیجه‌ای یافت نشد',
        'no_results_message' => 'هیچ اعضایی با معیارهای جستجوی شما یافت نشد. لطفاً معیارهای جستجو را تغییر دهید.',
        'reset_button' => 'بازنشانی',
        'management_positions' => 'مدیر,معاون,حسابدار,معاون اجرایی,معاون آموزشی,معاون پرورشی',
        'teaching_positions' => 'دبیر,آموزگار,مربی زبان,هنرآموز',
        'untranslated_name' => 'عضو هیئت علمی',
        'untranslated_position' => 'سمت نامشخص'
    ],
    'en' => [
        'page_title' => 'Our Team',
        'header_title' => 'Our Team',
        'header_subtitle' => 'Meet the academic staff and personnel of Salman Farsi Educational Complex',
        'search_placeholder' => 'Search by name or position...',
        'filter_all' => 'All',
        'filter_management' => 'Management',
        'filter_teaching' => 'Teaching',
        'filter_support' => 'Support',
        'no_staff_found' => 'No staff members found',
        'no_results_title' => 'No Results Found',
        'no_results_message' => 'No staff members match your search criteria. Please try different search terms.',
        'reset_button' => 'Reset',
        'management_positions' => 'Director,Manager,Management,Principal,Head,Deputy,Accountant,Deputy manager,Educational Assistant',
        'teaching_positions' => 'Teacher,language instructor,Instructor,Professor',
        'untranslated_name' => 'Staff Member',
        'untranslated_position' => 'Position not specified'
    ],
    'ar' => [
        'page_title' => 'فريقنا',
        'header_title' => 'فريقنا',
        'header_subtitle' => 'تعرف على الكادر الأكاديمي والموظفين بمجمع سلمان الفارسي التعليمي',
        'search_placeholder' => 'البحث عن طريق الاسم أو المنصب...',
        'filter_all' => 'الكل',
        'filter_management' => 'الإدارة',
        'filter_teaching' => 'التدريس',
        'filter_support' => 'الدعم',
        'no_staff_found' => 'لم يتم العثور على أعضاء',
        'no_results_title' => 'لم يتم العثور على نتائج',
        'no_results_message' => 'لا يوجد موظفين يطابقون معايير البحث الخاصة بك. يرجى تجربة عبارات بحث مختلفة.',
        'reset_button' => 'إعادة تعيين',
        'management_positions' => 'مدير,نائب,محاسب,نائب المدير,مساعد تعليمي',
        'teaching_positions' => 'معلم,مدرس لغة',
        'untranslated_name' => 'عضو هيئة التدريس',
        'untranslated_position' => 'المنصب غير محدد'
    ]
];

// Fill in any missing values with defaults
foreach ($defaults[$lang] as $key => $value) {
    if (!isset($page_content[$key])) {
        $page_content[$key] = $value;
    }
}
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" dir="<?php echo $isRtl ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $page_content['page_title']; ?> | <?php echo SITE_NAME_EN; ?></title>

    <!-- Favicon Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png" />
    <link rel="manifest" href="assets/images/favicons/site.webmanifest" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&amp;display=swap" rel="stylesheet">
    <?php if ($isRtl): ?>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <?php endif; ?>

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/vendors/bootstrap-select/bootstrap-select.min.css" />
    <link rel="stylesheet" href="assets/vendors/animate/animate.min.css" />
    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="assets/vendors/jarallax/jarallax.css" />
    <link rel="stylesheet" href="assets/vendors/jquery-magnific-popup/jquery.magnific-popup.css" />
    <link rel="stylesheet" href="assets/vendors/owl-carousel/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="assets/vendors/owl-carousel/css/owl.theme.default.min.css" />

    <!-- Custom Styles for Registration Terms Page -->
    <?php include_once 'assets/css/pages/staff.css.php'; ?>  
    

</head>

<body class="custom-cursor">
    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>

    <div class="page-wrapper">
        <!-- Include Navigation Menu -->
        <?php include_once 'includes/menu.php'; ?>

        <!-- Staff Hero Header Section with Enhanced Cosmic theme -->
        <section class="staff-header">
            <div class="cosmic-bg" id="cosmic-bg">
                <div class="cosmic-planet"></div>
                <div class="cosmic-planet"></div>
                <div class="cosmic-planet"></div>
                <div class="shooting-star" style="top: 20%; left: 10%; animation-delay: 0s;"></div>
                <div class="shooting-star" style="top: 40%; left: 30%; animation-delay: 2s;"></div>
                <div class="shooting-star" style="top: 60%; left: 50%; animation-delay: 5s;"></div>
                <!-- Stars will be added via JS -->
            </div>
            
            <div class="container">
                <div class="staff-header__content wow fadeIn" data-wow-delay="100ms">
                    <h1 class="staff-header__title">
                        <?php echo $page_content['header_title']; ?>
                    </h1>
                    <p class="staff-header__subtitle">
                        <?php echo $page_content['header_subtitle']; ?>
                    </p>
                </div>
            </div>
        </section>

        <!-- Filter and Search Section -->
        <section class="staff-filter-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="staff-filter-container">
                            <div class="staff-search">
                                <input type="text" id="staff-search-input" placeholder="<?php echo $page_content['search_placeholder']; ?>" class="staff-search-input">
                                <button class="staff-search-btn">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            
                            <div class="staff-category-filters">
                                <button class="staff-filter-btn active" data-filter="all">
                                    <?php echo $page_content['filter_all']; ?>
                                </button>
                                <button class="staff-filter-btn" data-filter="management">
                                    <?php echo $page_content['filter_management']; ?>
                                </button>
                                <button class="staff-filter-btn" data-filter="teaching">
                                    <?php echo $page_content['filter_teaching']; ?>
                                </button>
                                <button class="staff-filter-btn" data-filter="support">
                                    <?php echo $page_content['filter_support']; ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Staff Cards Section -->
        <section class="staff-cards-section">
            <div class="container">
                <div class="row" id="staff-cards-container" dir="<?php echo $isRtl ? 'rtl' : 'ltr'; ?>">
                <?php
                // ========================== SIMPLIFIED DIRECT APPROACH ==========================
                
                // 1. Get ALL staff IDs and photos first - we will display all staff members regardless of translations
                $staff_data = [];
                $sql_all_staff = "SELECT id, photo_url FROM staff ORDER BY id ASC";
                $result_all_staff = $conn->query($sql_all_staff);
                
                if ($result_all_staff && $result_all_staff->num_rows > 0) {
                    while($row = $result_all_staff->fetch_assoc()) {
                        $staff_id = $row['id'];
                        $staff_data[$staff_id] = [
                            'id' => $staff_id,
                            'photo_url' => $row['photo_url'],
                            'name' => $page_content['untranslated_name'],  // Default name
                            'position' => $page_content['untranslated_position'], // Default position
                            'education' => '',
                            'category' => 'support' // Default category
                        ];
                        
                        // IMPORTANT: DIRECT ASSIGNMENT - ID 1 is ALWAYS management
                        if ($staff_id == 1) {
                            $staff_data[$staff_id]['category'] = 'management';
                        }
                    }
                }
                
                // 2. Now get translations for this language
                $sql_translations = "SELECT staff_id, name, position, education 
                                    FROM staff_translations 
                                    WHERE language_id = {$language_id}";
                
                $result_translations = $conn->query($sql_translations);
                
                if ($result_translations && $result_translations->num_rows > 0) {
                    while($row = $result_translations->fetch_assoc()) {
                        $staff_id = $row['staff_id'];
                        if (isset($staff_data[$staff_id])) {
                            // Update with translated content
                            $staff_data[$staff_id]['name'] = $row['name'];
                            $staff_data[$staff_id]['position'] = $row['position'];
                            $staff_data[$staff_id]['education'] = $row['education'];
                        }
                    }
                }
                
                // 3. Categorize based on position (except ID 1 which is already set as management)
                $management_positions = explode(',', $page_content['management_positions']);
                $teaching_positions = explode(',', $page_content['teaching_positions']);
                
                foreach ($staff_data as $id => $staff) {
                    // Skip ID 1 as it's already categorized
                    if ($id == 1) continue;
                    
                    $position = strtolower($staff['position']);
                    
                    // Check if position matches management
                    foreach ($management_positions as $pos) {
                        $pos = trim(strtolower($pos));
                        if (!empty($pos) && strpos($position, $pos) !== false) {
                            $staff_data[$id]['category'] = 'management';
                            break;
                        }
                    }
                    
                    // If not management, check if it matches teaching
                    if ($staff_data[$id]['category'] === 'support') {
                        foreach ($teaching_positions as $pos) {
                            $pos = trim(strtolower($pos));
                            if (!empty($pos) && strpos($position, $pos) !== false) {
                                $staff_data[$id]['category'] = 'teaching';
                                break;
                            }
                        }
                    }
                }
                
                // 4. Sort by ID to ensure Director (ID=1) always appears first
                ksort($staff_data);
                
                // 5. Display staff in order by ID
                $counter = 0;
                
                foreach ($staff_data as $id => $staff) {
                    // Calculate delay for animation
                    $delay = ($counter % 4) * 100;
                    $counter++;
                    
                    // Check if photo exists, otherwise use default
                    $image_path = !empty($staff["photo_url"]) ? 
                                "assets/images/Staff/" . $staff["photo_url"] : 
                                "assets/images/Staff/vector.jpg";
                ?>
                    <div class="col-lg-4 col-md-6 staff-card-container" data-category="<?php echo $staff['category']; ?>" data-name="<?php echo strtolower($staff['name']); ?>" data-position="<?php echo strtolower($staff['position']); ?>">
                        <div class="staff-card <?php echo $staff['category']; ?> wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='<?php echo $delay; ?>ms'>
                            <div class="staff-image-wrapper">
                                <img src="<?php echo $image_path; ?>" alt="<?php echo $staff['name']; ?>" class="staff-image">
                                
                                <div class="staff-info">
                                    <h3 class="staff-name"><?php echo $staff['name']; ?></h3>
                                    <p class="staff-position"><?php echo $staff['position']; ?></p>
                                    
                                    <?php if (!empty($staff['education'])): ?>
                                    <div class="staff-education">
                                        <?php echo $staff['education']; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                
                // If no staff members found
                if (empty($staff_data)) {
                    echo "<div class='col-12 text-center'><p class='no-results'>{$page_content['no_staff_found']}</p></div>";
                }
                ?>
                </div>
                
                <!-- No Results Message (Initially Hidden) -->
                <div id="no-results-message" class="no-results-container" style="display: none;">
                    <div class="no-results">
                        <i class="fas fa-user-slash no-results-icon"></i>
                        <h3><?php echo $page_content['no_results_title']; ?></h3>
                        <p><?php echo $page_content['no_results_message']; ?></p>
                        <button id="reset-search" class="reset-btn">
                            <i class="fas fa-sync-alt"></i> 
                            <?php echo $page_content['reset_button']; ?>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Include Footer -->
        <?php include_once 'includes/footer.php'; ?>
    </div><!-- /.page-wrapper -->

    <!-- Scripts -->
    <script src="assets/vendors/jquery/jquery-3.7.0.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="assets/vendors/jarallax/jarallax.min.js"></script>
    <script src="assets/vendors/jquery-appear/jquery.appear.min.js"></script>
    <script src="assets/vendors/jquery-validate/jquery.validate.min.js"></script>
    <script src="assets/vendors/owl-carousel/js/owl.carousel.min.js"></script>
    <script src="assets/vendors/wow/wow.js"></script>
    
    <!-- Template JS -->
    <script src="assets/js/salman.js"></script>
    
    <!-- Staff Page JS -->
    <script>
    (function($) {
        "use strict";
        
        // Initialize WOW.js for animations
        new WOW().init();
        
        // Generate stars for the cosmic background
        function generateStars() {
            const cosmicBg = document.getElementById('cosmic-bg');
            const starCount = 150; // More stars for a beautiful sky
            
            for (let i = 0; i < starCount; i++) {
                const star = document.createElement('div');
                star.classList.add('cosmic-star');
                
                // Random size
                const size = Math.random() * 3 + 1;
                star.style.width = size + 'px';
                star.style.height = size + 'px';
                
                // Random position
                star.style.top = Math.random() * 100 + '%';
                star.style.left = Math.random() * 100 + '%';
                
                // Random animation delay
                star.style.animationDelay = Math.random() * 5 + 's';
                
                // Random opacity
                star.style.opacity = Math.random() * 0.7 + 0.3;
                
                cosmicBg.appendChild(star);
            }
        }
        
        // Filter staff by category
        function filterStaff() {
            const filter = $(this).data('filter');
            
            // Update active button
            $('.staff-filter-btn').removeClass('active');
            $(this).addClass('active');
            
            // Filter staff cards
            if (filter === 'all') {
                $('.staff-card-container').fadeIn();
            } else {
                $('.staff-card-container').hide();
                $('.staff-card-container[data-category="' + filter + '"]').fadeIn();
            }
            
            // Check if no results
            checkNoResults();
        }
        
        // Search staff by name or position
        function searchStaff() {
            const searchTerm = $('#staff-search-input').val().toLowerCase();
            
            if (searchTerm.length > 0) {
                $('.staff-card-container').each(function() {
                    const name = $(this).data('name') || '';
                    const position = $(this).data('position') || '';
                    
                    if (name.includes(searchTerm) || position.includes(searchTerm)) {
                        $(this).fadeIn();
                    } else {
                        $(this).hide();
                    }
                });
            } else {
                // If search is empty, apply current filter
                const currentFilter = $('.staff-filter-btn.active').data('filter');
                
                if (currentFilter === 'all') {
                    $('.staff-card-container').fadeIn();
                } else {
                    $('.staff-card-container').hide();
                    $('.staff-card-container[data-category="' + currentFilter + '"]').fadeIn();
                }
            }
            
            // Check if no results
            checkNoResults();
        }
        
        // Check if no results and show/hide message
        function checkNoResults() {
            if ($('.staff-card-container:visible').length === 0) {
                $('#no-results-message').fadeIn();
            } else {
                $('#no-results-message').hide();
            }
        }
        
        // Reset search and filters
        function resetSearch() {
            $('#staff-search-input').val('');
            $('.staff-filter-btn[data-filter="all"]').click();
            $('#no-results-message').hide();
        }
        
        // Document ready
        $(document).ready(function() {
            // Generate cosmic stars
            generateStars();
            
            // Event listeners
            $('.staff-filter-btn').on('click', filterStaff);
            $('#staff-search-input').on('keyup', searchStaff);
            $('#reset-search').on('click', resetSearch);
        });
        
    })(jQuery);
    </script>
</body>
</html>