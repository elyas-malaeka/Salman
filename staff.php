<?php
/**
 * Staff Page - Enhanced Version
 * 
 * This file displays all staff members with modern UI and improved functionality
 * 
 * @package Salman Educational Complex
 * @version 8.4
 */

// Include configuration file
require_once 'includes/config.php';

// Get current language for localization
$lang = getCurrentLanguage();
$isRtl = in_array($lang, ['fa', 'ar']);

// Connect to database
$conn = connectDB();

// Get language ID for current language
$language_id = 1; // Default to Persian (ID=1)
$lang_code = 'fa'; // Default language code

$sql = "SELECT language_id, code FROM core_languages WHERE code = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $lang);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $language_id = $row['language_id'];
    $lang_code = $row['code'];
}
$stmt->close();

// Initialize page content array
$page_content = [];

// Get content from staff_content table with prepared statement
$sql = "SELECT c.field_key, t.content_value as content 
       FROM temp_staff_content c
       JOIN temp_staff_translations t ON c.content_id = t.content_id
       WHERE t.language_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $lang_code);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $page_content[$row['field_key']] = $row['content'];
    }
}
$stmt->close();

// Fallback function if database content is missing
function get_content($key, $default = '') {
    global $page_content;
    return isset($page_content[$key]) && !empty($page_content[$key]) ? $page_content[$key] : $default;
}

// Get default image based on category
function get_default_image($category) {
    switch ($category) {
        case 'management':
            return 'assets/images/Staff/default-management.jpg';
        case 'teaching':
            return 'assets/images/Staff/default-teaching.jpg';
        case 'support':
            return 'assets/images/Staff/default-support.jpg';
        default:
            return 'assets/images/Staff/default.jpg';
    }
}

// Get staff positions by category
function get_positions_by_category($category) {
    global $page_content;
    
    $key = '';
    switch ($category) {
        case 'management':
            $key = 'management_positions';
            break;
        case 'teaching':
            $key = 'teaching_positions';
            break;
        case 'support':
            $key = 'support_positions';
            break;
        case 'special':
            $key = 'special_positions';
            break;
    }
    
    if (empty($key) || !isset($page_content[$key])) {
        return [];
    }
    
    return explode(',', $page_content[$key]);
}

// Determine staff category based on position
function determine_staff_category($position) {
    if (empty($position)) return 'support';
    
    $position = mb_strtolower($position, 'UTF-8');
    
    // Check all categories
    $categories = ['management', 'teaching', 'support', 'special'];
    
    foreach ($categories as $category) {
        $positions = get_positions_by_category($category);
        foreach ($positions as $keyword) {
            $keyword = trim(mb_strtolower($keyword, 'UTF-8'));
            if (!empty($keyword) && mb_strpos($position, $keyword) !== false) {
                return $category;
            }
        }
    }
    
    return 'support'; // Default category
}

// Get staff member data
$staff_data = [];

// Retrieve all staff members with prepared statement
$sql = "SELECT s.id, s.photo_url, t.name, t.position, t.education 
        FROM service_staff s
        LEFT JOIN service_staff_translations t ON s.id = t.staff_id AND t.language_id = ?
        ORDER BY CASE WHEN s.id = 1 THEN 0 ELSE s.id END ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $language_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Determine category based on position
        $position = $row['position'] ?? '';
        $category = determine_staff_category($position);
        
        // Special handling for ID 1 (director) - always management
        if ($row['id'] == 1) {
            $category = 'management';
            $row['is_featured'] = 1;
        } else {
            // For demo purposes, mark first 3 staff members as featured
            $row['is_featured'] = ($row['id'] <= 3) ? 1 : 0;
        }
        
        // Add category to staff data
        $row['category'] = $category;
        
        // Add placeholder email if not exists
        if (empty($row['email'])) {
            $row['email'] = 'info@salmanfarsi.edu';
        }
        
        $staff_data[$row['id']] = $row;
    }
}
$stmt->close();

// Close database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" dir="<?php echo $isRtl ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo get_content('page_title', 'کادر مجتمع آموزشی سلمان فارسی'); ?> | <?php echo SITE_NAME; ?></title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png">
    
    <!-- CSS -->
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/vendors/animate/animate.min.css">
    <link rel="stylesheet" href="assets/vendors/swiper/swiper-bundle.min.css">
    
     <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <!-- Core CSS -->
    <?php include_once 'assets/css/main.css.php'; ?>
    <?php include_once 'assets/css/staff.css.php'; ?>
    
    <style>
        /* استایل‌های اضافی برای تصاویر پیش‌فرض */
        .default-staff-icon {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f0f0f0;
        }
        
        .default-staff-icon i {
            font-size: 80px;
            opacity: 0.4;
        }
        
        .default-staff-icon.management {
            background-color: rgba(37, 99, 235, 0.1);
        }
        
        .default-staff-icon.management i {
            color: var(--management-color);
        }
        
        .default-staff-icon.teaching {
            background-color: rgba(139, 92, 246, 0.1);
        }
        
        .default-staff-icon.teaching i {
            color: var(--teaching-color);
        }
        
        .default-staff-icon.support {
            background-color: rgba(16, 185, 129, 0.1);
        }
        
        .default-staff-icon.support i {
            color: var(--support-color);
        }
        
        /* استایل‌های بهبود یافته */
        .staff-tooltip {
            position: relative;
            display: inline-block;
        }
        
        .staff-tooltip .tooltiptext {
            visibility: hidden;
            width: 200px;
            background-color: var(--dark-color);
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        .staff-tooltip:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }
        
        .profile-btn {
            margin-top: 15px;
            padding: 8px 15px;
            border-radius: 50px;
            background: var(--primary-color);
            color: white;
            border: none;
            transition: all 0.3s ease;
            display: inline-block;
            text-decoration: none;
            font-size: 14px;
        }
        
        .profile-btn:hover {
            background: var(--accent-color);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            color: white;
        }
    </style>
</head>
<body class="custom-cursor">
    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>

    <div class="page-wrapper">
        <!-- Include Navigation Menu -->
        <?php include_once 'includes/menu.php'; ?>
        <!-- Mountain Header -->
        <header class="mountain-header">
            <lottie-player 
                src="assets/css/Animation.json"
                background="transparent"
                speed="1"
                style=" width: 100vw;
                height: 120vh;
                position: absolute;
                top:70%; /* به جای 50% - انیمیشن رو بالا می‌بره */
                left: 50%;
                transform: translate(-50%, -50%);
                z-index: 1;
                pointer-events: none;"
                loop
                autoplay>
            </lottie-player>

            <!-- Content -->
            <div class="header-content" style="padding-top: 200px;">
                <div class="glass-container">
                    <h1 class="header-title"
                    style=" font-size: 3.5rem;
                            font-weight: 800;
                            color: #ffffff;
                            margin: 0 0 1.5rem 0;
                            text-shadow: 0 3px 6px rgba(0, 0, 0, 0.7);
                            letter-spacing: -0.02em;
                            line-height: 1.1;" ><?php echo get_content('header_title', 'کادر حرفه‌ای مجتمع آموزشی سلمان فارسی'); ?>
                            </h1>
                    <p class="header-subtitle">
                      <?php echo get_content('header_subtitle', 'آشنایی با اعضای هیئت علمی و کارکنان متخصص'); ?>
                    </p>
                </div>
            </div>
        </header>

        <!-- Filter Section -->
        <section class="staff-filter-section">
            <div class="container">
                <div class="staff-filter-container">
                    <div class="staff-search staff-tooltip">
                        <input type="text" id="staff-search-input" class="staff-search-input" placeholder="<?php echo get_content('search_placeholder', 'جستجوی نام، تخصص یا سمت...'); ?>">
                        <span class="tooltiptext"><?php echo get_content('staff_search_tooltip', 'جستجو بر اساس نام، سمت یا تخصص استاد'); ?></span>
                        <button class="staff-search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    
                    <div class="staff-category-filters">
                        <button class="staff-filter-btn active" data-filter="all">
                            <?php echo get_content('filter_all', 'همه'); ?>
                        </button>
                        <button class="staff-filter-btn" data-filter="management">
                            <?php echo get_content('filter_management', 'مدیریت و اداری'); ?>
                        </button>
                        <button class="staff-filter-btn" data-filter="teaching">
                            <?php echo get_content('filter_teaching', 'اساتید و مشاوران'); ?>
                        </button>
                        <button class="staff-filter-btn" data-filter="support">
                            <?php echo get_content('filter_support', 'کادر پشتیبانی'); ?>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Staff Cards Section -->
        <section class="staff-cards-section">
            <div class="container">
                <div class="row" id="staff-cards-container">
                    <?php
                    // Generate staff cards
                    if (!empty($staff_data)) {
                        foreach ($staff_data as $staff) {
                            $category_class = strtolower($staff['category']);
                            ?>
                            <div class="col-lg-4 col-md-6 staff-card-container" data-category="<?php echo $category_class; ?>" data-name="<?php echo htmlspecialchars(strtolower($staff['name'])); ?>" data-position="<?php echo htmlspecialchars(strtolower($staff['position'])); ?>">
                                <div class="staff-card <?php echo $category_class; ?> wow fadeInUp" data-wow-duration="1200ms">
                                    <div class="staff-image-wrapper">
                                        <?php if (!empty($staff['photo_url']) && file_exists('assets/images/Staff/' . $staff['photo_url'])): ?>
                                            <img src="assets/images/Staff/<?php echo htmlspecialchars($staff['photo_url']); ?>" alt="<?php echo htmlspecialchars($staff['name']); ?>" class="staff-image">
                                        <?php else: ?>
                                            <div class="default-staff-icon <?php echo $category_class; ?>">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="staff-info">
                                        <h3 class="staff-name"><?php echo htmlspecialchars($staff['name']); ?></h3>
                                        <p class="staff-position"><?php echo htmlspecialchars($staff['position']); ?></p>
                                        <?php if (!empty($staff['education'])): ?>
                                        <div class="staff-education">
                                            <?php echo htmlspecialchars($staff['education']); ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        // If no staff found
                        echo '<div class="col-12 text-center"><p class="no-results">' . get_content('no_staff_found', 'هیچ عضوی یافت نشد') . '</p></div>';
                    }
                    ?>
                </div>
                
                <!-- No Results Message (Initially Hidden) -->
                <div id="no-results-message" class="no-results-container" style="display: none;">
                    <div class="no-results">
                        <i class="fas fa-user-slash no-results-icon"></i>
                        <h3><?php echo get_content('no_results_title', 'نتیجه‌ای یافت نشد'); ?></h3>
                        <p><?php echo get_content('no_results_message', 'هیچ عضوی با معیارهای جستجوی شما یافت نشد. لطفاً عبارت دیگری را جستجو کنید یا فیلترها را تغییر دهید.'); ?></p>
                        <button id="reset-search" class="reset-btn">
                            <i class="fas fa-sync-alt"></i> 
                            <?php echo get_content('reset_button', 'بازنشانی فیلترها'); ?>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section - Ultra Modern Design -->
        <section class="stats-section-ultra">
            <div class="parallax-bg">
                <div class="parallax-star-field"></div>
                <div class="cosmic-overlay"></div>
                <div class="floating-particles"></div>
            </div>
            
            <div class="container position-relative">
                <div class="stats-heading-container wow fadeIn" data-wow-duration="1.5s">
                    <div class="stats-decorative-line"></div>
                    <h2 class="stats-heading"><?php echo get_content('stats_title', 'افتخارات آموزشی ما'); ?></h2>
                    <div class="stats-decorative-line"></div>
                </div>
                
                <p class="stats-intro-text wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.3s">
                    <?php echo get_content('stats_subtitle', 'دستاوردهای برجسته مجتمع آموزشی سلمان فارسی در مسیر تعالی و پیشرفت'); ?>
                </p>
                
                <div class="stats-cards-container">
                    <!-- Years Stats Card -->
                    <div class="stats-card wow fadeInUp" data-wow-duration="1.2s" data-wow-delay="0.2s">
                        <div class="card-glass-effect"></div>
                        <div class="stats-card-inner">
                            <div class="stats-icon-container">
                                <div class="stats-icon-bg"></div>
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div class="stats-number-container">
                                <div class="stats-number-wrapper">
                                    <span class="stats-number" data-count="<?php echo get_content('stats_years_value', '25'); ?>">0</span>
                                    <span class="stats-plus">+</span>
                                </div>
                                <div class="stats-counter-bar"><div class="stats-counter-progress"></div></div>
                            </div>
                            <h3 class="stats-card-title"><?php echo get_content('stats_years_title', 'سال تجربه آموزشی'); ?></h3>
                            <p class="stats-card-description"><?php echo get_content('years_description', 'از سال ۱۳۷۷ در جهت تحقق آرمان‌های آموزشی'); ?></p>
                        </div>
                        <div class="stats-card-reflection"></div>
                        <div class="stats-card-glow"></div>
                    </div>
                    
                    <!-- Teachers Stats Card -->
                    <div class="stats-card wow fadeInUp" data-wow-duration="1.2s" data-wow-delay="0.4s">
                        <div class="card-glass-effect"></div>
                        <div class="stats-card-inner">
                            <div class="stats-icon-container">
                                <div class="stats-icon-bg"></div>
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div class="stats-number-container">
                                <div class="stats-number-wrapper">
                                    <span class="stats-number" data-count="<?php echo get_content('stats_teachers_value', '120'); ?>">0</span>
                                    <span class="stats-plus">+</span>
                                </div>
                                <div class="stats-counter-bar"><div class="stats-counter-progress"></div></div>
                            </div>
                            <h3 class="stats-card-title"><?php echo get_content('stats_teachers_title', 'کادر آموزشی متخصص'); ?></h3>
                            <p class="stats-card-description"><?php echo get_content('teachers_description', 'تیم آموزشی زبده با بالاترین کیفیت تدریس'); ?></p>
                        </div>
                        <div class="stats-card-reflection"></div>
                        <div class="stats-card-glow"></div>
                    </div>
                
                    
                    <!-- Awards Stats Card -->
                    <div class="stats-card wow fadeInUp" data-wow-duration="1.2s" data-wow-delay="0.8s">
                        <div class="card-glass-effect"></div>
                        <div class="stats-card-inner">
                            <div class="stats-icon-container">
                                <div class="stats-icon-bg"></div>
                                <i class="fas fa-trophy"></i>
                            </div>
                            <div class="stats-number-container">
                                <div class="stats-number-wrapper">
                                    <span class="stats-number" data-count="<?php echo get_content('stats_awards_value', '50'); ?>">0</span>
                                    <span class="stats-plus">+</span>
                                </div>
                                <div class="stats-counter-bar"><div class="stats-counter-progress"></div></div>
                            </div>
                            <h3 class="stats-card-title"><?php echo get_content('stats_awards_title', 'افتخارات ملی و بین‌المللی'); ?></h3>
                            <p class="stats-card-description"><?php echo get_content('awards_description', 'کسب جوایز برتر در مسابقات و المپیادها'); ?></p>
                        </div>
                        <div class="stats-card-reflection"></div>
                        <div class="stats-card-glow"></div>
                    </div>
                </div>
                
                <div class="stats-achievement-badges wow fadeInUp" data-wow-delay="1s">
                    <div class="achievement-badge">
                        <div class="badge-icon"><i class="fas fa-medal"></i></div>
                        <span><?php echo get_content('achievement_badge_1', 'رتبه اول کشوری'); ?></span>
                    </div>
                    <div class="achievement-badge">
                        <div class="badge-icon"><i class="fas fa-star"></i></div>
                        <span><?php echo get_content('achievement_badge_2', 'بالاترین کیفیت آموزشی'); ?></span>
                    </div>
                    <div class="achievement-badge">
                        <div class="badge-icon"><i class="fas fa-award"></i></div>
                        <span><?php echo get_content('achievement_badge_3', 'استاندارد بین‌المللی'); ?></span>
                    </div>
                </div>
            </div>
            
            <div class="cosmic-waves">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                    <path fill="#ffffff" fill-opacity="" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,208C672,213,768,203,864,208C960,213,1056,235,1152,218.7C1248,203,1344,149,1392,122.7L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                </svg>
            </div>
        </section>

        <!-- Join Our Team Section -->
        <section class="join-team-section">
            <div class="container">
                <div class="join-team-container">
                    <div class="join-team-content wow fadeInLeft">
                        <h2 class="join-team-title"><?php echo get_content('join_team_title', 'به تیم متخصصان ما بپیوندید'); ?></h2>
                        <p class="join-team-subtitle"><?php echo get_content('join_team_subtitle', 'فرصت‌های شغلی در مجتمع آموزشی سلمان فارسی'); ?></p>
                        <div class="join-team-description"><?php echo get_content('join_team_description', 'به دنبال پیوستن به یک محیط پویا و حرفه‌ای هستید؟ مجتمع آموزشی سلمان فارسی همواره از متخصصان پرشور و متعهد در زمینه آموزش استقبال می‌کند. برای آگاهی از فرصت‌های شغلی موجود با ما تماس بگیرید.'); ?></div>
                        <a href="contact.php" class="join-team-btn">
                            <i class="fas fa-phone-alt"></i>
                            <?php echo get_content('join_team_button', 'تماس با ما'); ?>
                        </a>
                    </div>
                    <div class="join-team-image wow fadeInRight">
                        <img src="assets/images/staff/staff.png" alt="<?php echo get_content('join_team_title', 'به تیم متخصصان ما بپیوندید'); ?>">
                    </div>
                </div>
            </div>
        </section>

        <!-- Profile Modal -->
        <div class="modal fade staff-profile-modal" id="profileModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo get_content('profile_modal_title', 'مشخصات استاد'); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php echo get_content('close_button', 'بستن'); ?>"></button>
                    </div>
                    <div class="modal-body">
                        <div id="profile-content">
                            <!-- Profile content will be loaded here via AJAX -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Include Footer -->
        <?php include_once 'includes/footer.php'; ?>
    </div>

    <!-- Scripts -->
    <script src="assets/vendors/jquery/jquery-3.7.0.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/wow/wow.js"></script>
    <script src="assets/vendors/swiper/swiper-bundle.min.js"></script>
    <script src="assets/js/salman.js"></script>
    
    <script>
        (function($) {
            "use strict";
            
            // Initialize WOW.js for animations
            if (typeof WOW !== 'undefined') {
                new WOW().init();
            }
            
            // Generate stars for cosmic background
            function generateStars() {
                const cosmicBg = document.querySelector('.cosmic-bg');
                if (!cosmicBg) return;
                
                const starCount = 200;
                
                for (let i = 0; i < starCount; i++) {
                    const star = document.createElement('div');
                    star.classList.add('cosmic-star');
                    
                    // Random size (1-4px)
                    const size = Math.random() * 3 + 1;
                    star.style.width = size + 'px';
                    star.style.height = size + 'px';
                    
                    // Random position
                    star.style.top = Math.random() * 100 + '%';
                    star.style.left = Math.random() * 100 + '%';
                    
                    // Random animation duration (2-7s)
                    const duration = Math.random() * 5 + 2;
                    star.style.animationDuration = duration + 's';
                    
                    // Random animation delay
                    star.style.animationDelay = Math.random() * 5 + 's';
                    
                    // Add star to cosmic background
                    cosmicBg.appendChild(star);
                }
            }
            
            // Improved search staff by name or position with debounce
            let searchTimeout;
            function searchStaff() {
                clearTimeout(searchTimeout);
                
                searchTimeout = setTimeout(function() {
                    const searchTerm = $('#staff-search-input').val().toLowerCase().trim();
                    let hasResults = false;
                    
                    // Hide all staff initially
                    $('.staff-card-container').hide();
                    
                    if (searchTerm.length > 0) {
                        $('.staff-card-container').each(function() {
                            const name = $(this).data('name') ? $(this).data('name').toLowerCase() : '';
                            const position = $(this).data('position') ? $(this).data('position').toLowerCase() : '';
                            const education = $(this).find('.staff-education').text().toLowerCase();
                            
                            if (name.includes(searchTerm) || position.includes(searchTerm) || education.includes(searchTerm)) {
                                $(this).fadeIn(400);
                                hasResults = true;
                            }
                        });
                    } else {
                        // If search is empty, apply current filter
                        const currentFilter = $('.staff-filter-btn.active').data('filter');
                        
                        if (currentFilter === 'all') {
                            $('.staff-card-container').fadeIn(400);
                            hasResults = $('.staff-card-container').length > 0;
                        } else {
                            $('.staff-card-container[data-category="' + currentFilter + '"]').fadeIn(400);
                            hasResults = $('.staff-card-container[data-category="' + currentFilter + '"]').length > 0;
                        }
                    }
                    
                    // Check if no results after animation completes
                    setTimeout(function() {
                        if (!hasResults) {
                            $('#no-results-message').fadeIn(400);
                        } else {
                            $('#no-results-message').hide();
                        }
                    }, 500);
                }, 300); // Debounce 300ms
            }
            
            // Filter staff by category with improved animation
            function filterStaff() {
                const filter = $(this).data('filter');
                
                // Update active button
                $('.staff-filter-btn').removeClass('active');
                $(this).addClass('active');
                
                // Clear search input when changing filters
                if ($('#staff-search-input').val() !== '') {
                    $('#staff-search-input').val('');
                }
                
                // Filter staff cards
                if (filter === 'all') {
                    $('.staff-card-container').fadeIn(400);
                } else {
                    $('.staff-card-container').hide();
                    $('.staff-card-container[data-category="' + filter + '"]').fadeIn(400);
                }
                
                // Check if no results
                setTimeout(function() {
                    checkNoResults();
                }, 500);
            }
            
            // Check if no results and show/hide message
            function checkNoResults() {
                if ($('.staff-card-container:visible').length === 0) {
                    $('#no-results-message').fadeIn(400);
                } else {
                    $('#no-results-message').hide();
                }
            }
            
            // Reset search and filters with animation
            function resetSearch() {
                $('#staff-search-input').val('');
                $('.staff-filter-btn[data-filter="all"]').addClass('active').siblings().removeClass('active');
                $('.staff-card-container').fadeIn(400);
                $('#no-results-message').hide();
            }
            
            // Load staff profile
            function loadProfile() {
                const staffId = $(this).data('staff-id');
                const profileContent = $('#profile-content');
                
                // Add loading spinner
                profileContent.html('<div class="text-center p-5"><div class="spinner-border text-primary" role="status"></div></div>');
                
                // Open modal
                $('#profileModal').modal('show');
                
                // Load profile data via AJAX
                $.ajax({
                    url: 'ajax/get_staff_profile.php',
                    type: 'GET',
                    data: { id: staffId },
                    success: function(response) {
                        profileContent.html(response);
                    },
                    error: function() {
                        profileContent.html('<div class="alert alert-danger">' + 
                            '<?php echo get_content("profile_error", "متأسفانه در بارگذاری اطلاعات پروفایل خطایی رخ داد. لطفاً مجدداً تلاش کنید."); ?>' + 
                            '</div>');
                    }
                });
            }
            
            // ایجاد ذرات شناور با جاوااسکریپت
            function createFloatingParticles() {
                const particlesContainer = $('.floating-particles');
                const particleCount = 10;
                
                for (let i = 0; i < particleCount; i++) {
                    const size = Math.random() * 200 + 50;
                    const x = Math.random() * 100;
                    const y = Math.random() * 100;
                    const duration = Math.random() * 15 + 15;
                    const delay = Math.random() * 5;
                    const opacity = Math.random() * 0.2 + 0.1;
                    const hue = Math.floor(Math.random() * 60) + 240; // رنگ‌های آبی تا بنفش
                    
                    const particle = $('<div class="floating-particle"></div>').css({
                        position: 'absolute',
                        width: size + 'px',
                        height: size + 'px',
                        borderRadius: '50%',
                        background: `hsla(${hue}, 70%, 60%, ${opacity})`,
                        filter: 'blur(60px)',
                        top: y + '%',
                        left: x + '%',
                        transform: 'translate(-50%, -50%)',
                        animation: `floatAnimation ${duration}s ease-in-out ${delay}s infinite alternate`
                    });
                    
                    particlesContainer.append(particle);
                }
                
                // تعریف انیمیشن CSS برای ذرات
                const styleSheet = document.createElement('style');
                styleSheet.textContent = `
                    @keyframes floatAnimation {
                        0% { transform: translate(-50%, -50%) scale(1) rotate(0deg); }
                        50% { transform: translate(-50%, -50%) scale(1.2) rotate(180deg); }
                        100% { transform: translate(-50%, -50%) scale(1) rotate(360deg); }
                    }
                `;
                document.head.appendChild(styleSheet);
            }
            
            // Animate stats counters with improved animation
            function animateStats() {
                $('.stats-number').each(function(index) {
                    const $this = $(this);
                    const finalValue = parseInt($this.data('count'));
                    const duration = 2500; // مدت زمان انیمیشن به میلی‌ثانیه
                    const delay = index * 300; // تاخیر شروع انیمیشن برای هر کارت
                    const $progressBar = $this.closest('.stats-number-container').find('.stats-counter-progress');
                    
                    setTimeout(function() {
                        // انیمیشن نوار پیشرفت
                        $progressBar.css('width', '100%');
                        
                        // انیمیشن شمارش با افکت‌های متنوع
                        $({ value: 0 }).animate({ value: finalValue }, {
                            duration: duration,
                            easing: 'easeOutExpo',
                            step: function(now) {
                                const current = Math.floor(now);
                                $this.text(current);
                                
                                // افکت لرزش در میانه‌های انیمیشن
                                if (now > finalValue * 0.7 && now < finalValue * 0.9) {
                                    $this.css('transform', `scale(${1 + Math.random() * 0.05}) translateY(${Math.random() * 2 - 1}px)`);
                                } else {
                                    $this.css('transform', 'scale(1) translateY(0)');
                                }
                            },
                            complete: function() {
                                $this.text(finalValue);
                                $this.css('transform', 'scale(1) translateY(0)');
                                
                                // افکت درخشش پس از تکمیل
                                $this.addClass('completed');
                                
                                // اضافه کردن کلاس به کارت بعد از تکمیل
                                $this.closest('.stats-card').addClass('counter-completed');
                            }
                        });
                    }, delay);
                });
            }
            
            // شروع انیمیشن شمارش وقتی بخش آمار در دید قرار می‌گیرد
            function initStatsAnimation() {
                const statsSection = document.querySelector('.stats-section-ultra');
                if (!statsSection) return;
                
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            animateStats();
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.2 });
                
                observer.observe(statsSection);
            }
            
            // Add easing function if not already defined
            if (typeof $.easing.easeOutExpo === 'undefined') {
                $.easing.easeOutExpo = function(x, t, b, c, d) {
                    return (t === d) ? b + c : c * (-Math.pow(2, -10 * t / d) + 1) + b;
                };
            }
            
            // افکت‌های کارت با حرکت موس
            function initCardEffects() {
                $('.stats-card').on('mousemove', function(e) {
                    const card = $(this);
                    const rect = card[0].getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    // محاسبه موقعیت نسبی موس روی کارت (0 تا 1)
                    const xPercent = x / rect.width;
                    const yPercent = y / rect.height;
                    
                    // محاسبه زاویه‌های چرخش بر اساس موقعیت موس
                    const rotateY = (xPercent - 0.5) * 10; // چرخش حداکثر 5 درجه
                    const rotateX = (0.5 - yPercent) * 10; // چرخش حداکثر 5 درجه
                    
                    // اعمال افکت سه‌بعدی به کارت
                    card.css('transform', `translateY(-10px) perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`);
                    
                    // حرکت افکت درخشش (گلو)
                    const glowX = (xPercent * 100) + '%';
                    const glowY = (yPercent * 100) + '%';
                    card.find('.stats-card-glow').css({
                        backgroundImage: `radial-gradient(circle at ${glowX} ${glowY}, rgba(139, 92, 246, 0.5) 0%, rgba(99, 102, 241, 0.2) 50%, transparent 100%)`,
                        opacity: 0.8
                    });
                });
                
                // بازگشت به حالت اولیه با خروج موس
                $('.stats-card').on('mouseleave', function() {
                    $(this).css('transform', 'translateY(-15px) scale(1.02)');
                    $(this).find('.stats-card-glow').css('opacity', '0');
                });
            }
            
            // افکت پارالاکس با حرکت اسکرول
            function initParallaxEffect() {
                $(window).on('scroll', function() {
                    const scrollPosition = $(window).scrollTop();
                    const windowHeight = $(window).height();
                    const statsSection = $('.stats-section-ultra');
                    const statsSectionTop = statsSection.offset().top;
                    const statsSectionHeight = statsSection.height();
                    
                    // محاسبه میزان اسکرول نسبی در بخش آمار
                    const relativeScroll = (scrollPosition - (statsSectionTop - windowHeight)) / (statsSectionHeight + windowHeight);
                    
                    if (relativeScroll > 0 && relativeScroll < 1) {
                        // حرکت عناصر پس‌زمینه با سرعت‌های مختلف برای ایجاد افکت پارالاکس
                        $('.parallax-star-field').css('transform', `translateY(${relativeScroll * -70}px)`);
                        $('.cosmic-overlay').css('transform', `translateY(${relativeScroll * -40}px)`);
                    }
                });
            }
            
            // افکت انعکاس نور با حرکت موس
            function initLightReflectionEffect() {
                $(document).on('mousemove', function(e) {
                    const mouseX = e.clientX;
                    const mouseY = e.clientY;
                    const width = $(window).width();
                    const height = $(window).height();
                    
                    // محاسبه درصد موقعیت موس
                    const xPercent = mouseX / width;
                    const yPercent = mouseY / height;
                    
                    // اعمال افکت به کل بخش
                    $('.stats-section-ultra').css({
                        'background-image': `
                            radial-gradient(
                                circle at ${xPercent * 100}% ${yPercent * 100}%, 
                                rgba(139, 92, 246, 0.1) 0%, 
                                transparent 50%
                            ),
                            linear-gradient(135deg, var(--stats-bg-dark) 0%, var(--stats-bg-light) 100%)
                        `
                    });
                });
            }
            
            // Initialize when document is ready
            $(document).ready(function() {
                // Generate cosmic stars
                generateStars();
                
                // Add event listeners
                $('.staff-filter-btn').on('click', filterStaff);
                $('#staff-search-input').on('keyup', searchStaff);
                $('#reset-search').on('click', resetSearch);
                
                // Initialize card effects
                initCardEffects();
                
                // Initialize parallax effects
                initParallaxEffect();
                
                // Initialize light reflection effect
                initLightReflectionEffect();
                
                // Make staff cards clickable to show more info
                $('.staff-card').on('click', function(e) {
                    // Skip if clicking on the profile button
                    if ($(e.target).hasClass('profile-btn') || $(e.target).closest('.profile-btn').length) {
                        return;
                    }
                    
                    // Toggle education visibility
                    $(this).find('.staff-education').toggleClass('visible');
                });
                
                // Bind profile view event
                $(document).on('click', '.view-profile-btn', loadProfile);
                
                // Initialize floating particles
                createFloatingParticles();
                
                // Initialize stats animation
                initStatsAnimation();
            });
            
        })(jQuery);
            document.addEventListener('DOMContentLoaded', function() {
                const lottiePlayer = document.querySelector('lottie-player');
                
                // Event listener برای خطایابی
                lottiePlayer.addEventListener('error', function() {
                    console.log('خطا در بارگذاری انیمیشن Lottie');
                    // نمایش پس‌زمینه CSS
                    document.querySelector('.gradient-background').style.display = 'block';
                });
            });
        </script>

</body>
</html>