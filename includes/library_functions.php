<?php
/**
 * توابع مورد نیاز کتابخانه آنلاین مجتمع آموزشی سلمان
 * نسخه چندزبانه
 * 
 * @package Salman Educational Complex
 * @subpackage Library
 * @version 2.0
 */

// جلوگیری از دسترسی مستقیم
if (!defined('BASEPATH')) {
    define('BASEPATH', true);
}

// اتصال به دیتابیس
if (!function_exists('getLibraryDatabaseConnection')) {
    function getLibraryDatabaseConnection() {
        global $db;
        return $db;
    }
}

/**
 * دریافت تنظیمات از جدول core_config
 * 
 * @param string $key کلید تنظیمات
 * @param string $default مقدار پیش‌فرض
 * @return string مقدار تنظیمات
 */
if (!function_exists('getConfig')) {
    function getConfig($key, $default = '') {
        $db = getLibraryDatabaseConnection();
        
        $sql = "SELECT config_value FROM core_config WHERE config_key = ? LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("s", $key);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $config = $result->fetch_assoc();
        
        return $config ? $config['config_value'] : $default;
    }
}

/**
 * دریافت نام مجتمع به زبان مورد نظر
 * 
 * @param int $language_id شناسه زبان
 * @return string نام مجتمع
 */
if (!function_exists('getComplexName')) {
    function getComplexName($language_id = 1) {
        // کلیدهای مربوط به هر زبان در جدول core_config
        $config_keys = [
            1 => 'site_name',      // فارسی
            2 => 'site_name_en',   // انگلیسی
            3 => 'site_name_ar'    // عربی
        ];
        
        $config_key = isset($config_keys[$language_id]) ? $config_keys[$language_id] : 'site_name';
        
        return getConfig($config_key, 'مجتمع آموزشی سلمان فارسی');
    }
}

/**
 * دریافت تنظیمات سایت
 * 
 * @return array آرایه تنظیمات
 */
if (!function_exists('getSiteSettings')) {
    function getSiteSettings() {
        $db = getLibraryDatabaseConnection();
        
        $sql = "SELECT config_key, config_value FROM core_config WHERE config_group IN ('site', 'general')";
        $result = $db->query($sql);
        
        $settings = [];
        while ($row = $result->fetch_assoc()) {
            $settings[$row['config_key']] = $row['config_value'];
        }
        
        return $settings;
    }
}

/**
 * دریافت دسته‌بندی‌های کتابخانه
 * 
 * @param int $parent_id شناسه دسته والد (پیش‌فرض: null برای دسته‌های اصلی)
 * @param int $limit تعداد نتایج (پیش‌فرض: 0 برای همه)
 * @param int $language_id شناسه زبان (پیش‌فرض: 1 برای فارسی)
 * @return array آرایه‌ای از دسته‌بندی‌ها
 */
if (!function_exists('getLibraryCategories')) {
    function getLibraryCategories($parent_id = null, $limit = 0, $language_id = 1) {
        $db = getLibraryDatabaseConnection();
        
        $sql = "SELECT c.category_id, c.parent_id, c.icon, c.sort_order, ct.name, ct.description 
                FROM library_categories c
                LEFT JOIN library_category_translations ct ON c.category_id = ct.category_id 
                WHERE ct.language_id = ?";
        
        $params = [$language_id];
        $param_types = 'i';
        
        if ($parent_id !== null) {
            if ($parent_id === 0) {
                $sql .= " AND c.parent_id IS NULL";
            } else {
                $sql .= " AND c.parent_id = ?";
                $params[] = $parent_id;
                $param_types .= 'i';
            }
        }
        
        $sql .= " AND c.is_active = 1 ORDER BY c.sort_order ASC";
        
        if ($limit > 0) {
            $sql .= " LIMIT ?";
            $params[] = $limit;
            $param_types .= 'i';
        }
        
        $stmt = $db->prepare($sql);
        
        if (!empty($params)) {
            $bind_params = array(&$param_types);
            foreach ($params as $key => $value) {
                $bind_params[] = &$params[$key];
            }
            call_user_func_array(array($stmt, 'bind_param'), $bind_params);
        }
        
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

/**
 * دریافت اطلاعات یک دسته‌بندی با استفاده از شناسه
 * 
 * @param int $category_id شناسه دسته‌بندی
 * @param int $language_id شناسه زبان (پیش‌فرض: 1 برای فارسی)
 * @return array|null اطلاعات دسته‌بندی یا null در صورت عدم وجود
 */
if (!function_exists('getCategoryById')) {
    function getCategoryById($category_id, $language_id = 1) {
        $db = getLibraryDatabaseConnection();
        
        $sql = "SELECT c.category_id, c.parent_id, c.icon, c.sort_order, ct.name, ct.description 
                FROM library_categories c
                LEFT JOIN library_category_translations ct ON c.category_id = ct.category_id 
                WHERE c.category_id = ? AND ct.language_id = ? AND c.is_active = 1";
        
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ii", $category_id, $language_id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}

/**
 * دریافت کتاب‌های کتابخانه
 * 
 * @param array $filters آرایه‌ای از فیلترها (دسته، نویسنده، جستجو و...)
 * @param int $page شماره صفحه فعلی
 * @param int $per_page تعداد کتاب در هر صفحه
 * @param string $sort_by نوع مرتب‌سازی
 * @param int $language_id شناسه زبان (پیش‌فرض: 1 برای فارسی)
 * @return array آرایه‌ای از کتاب‌ها و اطلاعات صفحه‌بندی
 */
if (!function_exists('getLibraryBooks')) {
    function getLibraryBooks($filters = [], $page = 1, $per_page = 12, $sort_by = 'newest', $language_id = 1) {
        $db = getLibraryDatabaseConnection();
        
        // پارامترهای پیش‌فرض
        $params = [];
        $param_types = '';
        $where_clauses = ["b.is_available = 1"];
        
        // اعمال فیلتر دسته‌بندی
        if (!empty($filters['category_id'])) {
            $where_clauses[] = "EXISTS (
                SELECT 1 FROM library_book_categories bc 
                WHERE bc.book_id = b.book_id AND bc.category_id = ?
            )";
            $params[] = $filters['category_id'];
            $param_types .= 'i';
        }
        
        // اعمال فیلتر نویسنده
        if (!empty($filters['author_id'])) {
            $where_clauses[] = "EXISTS (
                SELECT 1 FROM library_book_authors ba 
                WHERE ba.book_id = b.book_id AND ba.author_id = ?
            )";
            $params[] = $filters['author_id'];
            $param_types .= 'i';
        }
        
        // اعمال فیلتر جستجو
        if (!empty($filters['search'])) {
            $search_term = "%{$filters['search']}%";
            $where_clauses[] = "(bt.title LIKE ? OR bt.subtitle LIKE ? OR bt.description LIKE ?)";
            $params[] = $search_term;
            $params[] = $search_term;
            $params[] = $search_term;
            $param_types .= 'sss';
        }
        
        // اعمال فیلتر نمایش کتاب‌های برجسته
        if (!empty($filters['featured'])) {
            $where_clauses[] = "b.is_featured = 1";
        }
        
        // ساخت شرط WHERE
        $where_clause = implode(' AND ', $where_clauses);
        
        // ساخت شرط ORDER BY
        switch ($sort_by) {
            case 'title_asc':
                $order_by = "bt.title ASC";
                break;
            case 'title_desc':
                $order_by = "bt.title DESC";
                break;
            case 'oldest':
                $order_by = "b.publication_date ASC";
                break;
            case 'newest':
            default:
                $order_by = "b.publication_date DESC, b.book_id DESC";
                break;
        }
        
        // محاسبه offset برای صفحه‌بندی
        $offset = ($page - 1) * $per_page;
        
        // کوئری اصلی برای دریافت کتاب‌ها
        $sql = "SELECT b.book_id, b.isbn, b.publication_date, b.pages, b.cover_image, b.file_path,
                       bt.title, bt.subtitle, bt.description, bt.excerpt,
                       p.publisher_id, pt.name as publisher_name
                FROM library_books b
                LEFT JOIN library_book_translations bt ON b.book_id = bt.book_id
                LEFT JOIN library_publishers p ON b.publisher_id = p.publisher_id
                LEFT JOIN library_publisher_translations pt ON p.publisher_id = pt.publisher_id
                WHERE $where_clause
                AND bt.language_id = ? 
                AND (pt.language_id = ? OR pt.language_id IS NULL)
                ORDER BY $order_by
                LIMIT ? OFFSET ?";
        
        // اضافه کردن language_id به پارامترها
        $params[] = $language_id;
        $params[] = $language_id;
        $param_types .= 'ii';
        
        // اضافه کردن پارامترهای limit و offset
        $params[] = $per_page;
        $params[] = $offset;
        $param_types .= 'ii';
        
        $stmt = $db->prepare($sql);
        
        if (!empty($params)) {
            $bind_params = array(&$param_types);
            foreach ($params as $key => $value) {
                $bind_params[] = &$params[$key];
            }
            call_user_func_array(array($stmt, 'bind_param'), $bind_params);
        }
        
        $stmt->execute();
        
        $result = $stmt->get_result();
        $books = $result->fetch_all(MYSQLI_ASSOC);
        
        // دریافت نویسندگان هر کتاب
        foreach ($books as &$book) {
            $book['authors'] = getBookAuthors($book['book_id'], $language_id);
            $book['categories'] = getBookCategories($book['book_id'], $language_id);
        }
        
        // شمارش کل کتاب‌ها برای صفحه‌بندی
        $count_params = array_slice($params, 0, -4); // حذف language_id, limit و offset
        $count_param_types = substr($param_types, 0, -4);
        
        $count_sql = "SELECT COUNT(*) as total FROM library_books b
                     LEFT JOIN library_book_translations bt ON b.book_id = bt.book_id
                     WHERE $where_clause AND bt.language_id = ?";
        
        // اضافه کردن language_id به پارامترهای شمارش
        $count_params[] = $language_id;
        $count_param_types .= 'i';
        
        $count_stmt = $db->prepare($count_sql);
        
        if (!empty($count_params)) {
            $bind_params = array(&$count_param_types);
            foreach ($count_params as $key => $value) {
                $bind_params[] = &$count_params[$key];
            }
            call_user_func_array(array($count_stmt, 'bind_param'), $bind_params);
        }
        
        $count_stmt->execute();
        $count_result = $count_stmt->get_result();
        $count_data = $count_result->fetch_assoc();
        $total_count = $count_data['total'];
        
        $total_pages = ceil($total_count / $per_page);
        
        return [
            'books' => $books,
            'pagination' => [
                'current_page' => $page,
                'per_page' => $per_page,
                'total_count' => $total_count,
                'total_pages' => $total_pages
            ]
        ];
    }
}

/**
 * دریافت اطلاعات یک کتاب خاص
 * 
 * @param int $book_id شناسه کتاب
 * @param int $language_id شناسه زبان (پیش‌فرض: 1 برای فارسی)
 * @return array|null اطلاعات کتاب یا null در صورت عدم وجود
 */
if (!function_exists('getBookDetails')) {
    function getBookDetails($book_id, $language_id = 1) {
        $db = getLibraryDatabaseConnection();
        
        $sql = "SELECT b.book_id, b.isbn, b.publication_date, b.pages, b.cover_image, b.file_path,
                       bt.title, bt.subtitle, bt.description, bt.excerpt, bt.table_of_contents,
                       p.publisher_id, pt.name as publisher_name, pt.description as publisher_description
                FROM library_books b
                LEFT JOIN library_book_translations bt ON b.book_id = bt.book_id
                LEFT JOIN library_publishers p ON b.publisher_id = p.publisher_id
                LEFT JOIN library_publisher_translations pt ON p.publisher_id = pt.publisher_id
                WHERE b.book_id = ?
                AND bt.language_id = ? 
                AND (pt.language_id = ? OR pt.language_id IS NULL)";
        
        $stmt = $db->prepare($sql);
        $stmt->bind_param("iii", $book_id, $language_id, $language_id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $book = $result->fetch_assoc();
        
        if ($book) {
            $book['authors'] = getBookAuthors($book_id, $language_id);
            $book['categories'] = getBookCategories($book_id, $language_id);
            $book['related_books'] = getRelatedBooks($book_id, 4, $language_id);
        }
        
        return $book;
    }
}

/**
 * دریافت نویسندگان یک کتاب
 * 
 * @param int $book_id شناسه کتاب
 * @param int $language_id شناسه زبان (پیش‌فرض: 1 برای فارسی)
 * @return array آرایه‌ای از نویسندگان کتاب
 */
if (!function_exists('getBookAuthors')) {
    function getBookAuthors($book_id, $language_id = 1) {
        $db = getLibraryDatabaseConnection();
        
        $sql = "SELECT a.author_id, at.name, ba.role
                FROM library_book_authors ba
                JOIN library_authors a ON ba.author_id = a.author_id
                JOIN library_author_translations at ON a.author_id = at.author_id
                WHERE ba.book_id = ?
                AND at.language_id = ?
                ORDER BY ba.role ASC, at.name ASC";
        
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ii", $book_id, $language_id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

/**
 * دریافت دسته‌بندی‌های یک کتاب
 * 
 * @param int $book_id شناسه کتاب
 * @param int $language_id شناسه زبان (پیش‌فرض: 1 برای فارسی)
 * @return array آرایه‌ای از دسته‌بندی‌های کتاب
 */
if (!function_exists('getBookCategories')) {
    function getBookCategories($book_id, $language_id = 1) {
        $db = getLibraryDatabaseConnection();
        
        $sql = "SELECT c.category_id, ct.name
                FROM library_book_categories bc
                JOIN library_categories c ON bc.category_id = c.category_id
                JOIN library_category_translations ct ON c.category_id = ct.category_id
                WHERE bc.book_id = ?
                AND ct.language_id = ?
                ORDER BY c.sort_order ASC";
        
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ii", $book_id, $language_id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

/**
 * دریافت کتاب‌های مرتبط با یک کتاب خاص
 * 
 * @param int $book_id شناسه کتاب
 * @param int $limit تعداد کتاب‌های مرتبط
 * @param int $language_id شناسه زبان (پیش‌فرض: 1 برای فارسی)
 * @return array آرایه‌ای از کتاب‌های مرتبط
 */
if (!function_exists('getRelatedBooks')) {
    function getRelatedBooks($book_id, $limit = 4, $language_id = 1) {
        $db = getLibraryDatabaseConnection();
        
        // پیدا کردن دسته‌بندی‌های کتاب فعلی
        $sql = "SELECT category_id FROM library_book_categories WHERE book_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row['category_id'];
        }
        
        if (empty($categories)) {
            return [];
        }
        
        // ساخت بخش IN برای SQL
        $placeholders = implode(',', array_fill(0, count($categories), '?'));
        
        // پیدا کردن کتاب‌های هم‌دسته
        $sql = "SELECT DISTINCT b.book_id, b.cover_image, bt.title
                FROM library_books b
                JOIN library_book_categories bc ON b.book_id = bc.book_id
                JOIN library_book_translations bt ON b.book_id = bt.book_id
                WHERE bc.category_id IN ($placeholders)
                AND b.book_id != ?
                AND bt.language_id = ?
                AND b.is_available = 1
                ORDER BY RAND()
                LIMIT $limit";
        
        $stmt = $db->prepare($sql);
        
        // همه پارامترها را با "i" علامت‌گذاری می‌کنیم زیرا همه عدد صحیح هستند
        $types = str_repeat('i', count($categories) + 2);
        
        // ساخت آرایه پارامترها برای bind
        $bind_params = [$types];
        foreach ($categories as $category_id) {
            $bind_params[] = $category_id;
        }
        $bind_params[] = $book_id;
        $bind_params[] = $language_id;
        
        // استفاده از روش bind_param با آرایه پویا
        $ref_params = [];
        foreach ($bind_params as $key => $value) {
            $ref_params[$key] = &$bind_params[$key];
        }
        
        call_user_func_array(array($stmt, 'bind_param'), $ref_params);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

/**
 * دریافت لیست نویسندگان
 * 
 * @param array $filters آرایه‌ای از فیلترها
 * @param int $page شماره صفحه فعلی
 * @param int $per_page تعداد نویسنده در هر صفحه
 * @param int $language_id شناسه زبان (پیش‌فرض: 1 برای فارسی)
 * @return array آرایه‌ای از نویسندگان و اطلاعات صفحه‌بندی
 */
if (!function_exists('getLibraryAuthors')) {
    function getLibraryAuthors($filters = [], $page = 1, $per_page = 20, $language_id = 1) {
        $db = getLibraryDatabaseConnection();
        
        // پارامترهای پیش‌فرض
        $params = [];
        $where_clauses = ["1=1"]; // همیشه true
        $param_types = '';
        
        // اعمال فیلتر حرف اول
        if (!empty($filters['first_letter'])) {
            $where_clauses[] = "at.name LIKE ?";
            $params[] = $filters['first_letter'] . '%';
            $param_types .= 's';
        }
        
        // اعمال فیلتر ملیت
        if (!empty($filters['nationality'])) {
            $where_clauses[] = "a.nationality = ?";
            $params[] = $filters['nationality'];
            $param_types .= 's';
        }
        
        // اعمال فیلتر جستجو
        if (!empty($filters['search'])) {
            $where_clauses[] = "(at.name LIKE ? OR at.biography LIKE ?)";
            $params[] = '%' . $filters['search'] . '%';
            $params[] = '%' . $filters['search'] . '%';
            $param_types .= 'ss';
        }
        
        // ساخت شرط WHERE
        $where_clause = implode(' AND ', $where_clauses);
        
        // محاسبه offset برای صفحه‌بندی
        $offset = ($page - 1) * $per_page;
        
        // کوئری اصلی برای دریافت نویسندگان
        $sql = "SELECT a.author_id, a.birth_date, a.death_date, a.nationality, a.gender, a.image, a.featured,
                       at.name, at.biography
                FROM library_authors a
                JOIN library_author_translations at ON a.author_id = at.author_id
                WHERE $where_clause
                AND at.language_id = ?
                ORDER BY at.name ASC
                LIMIT ? OFFSET ?";
        
        // اضافه کردن language_id و پارامترهای limit و offset
        $params[] = $language_id;
        $params[] = $per_page;
        $params[] = $offset;
        $param_types .= 'iii';
        
        $stmt = $db->prepare($sql);
        
        // bind کردن پارامترها در صورت وجود
        if (!empty($params)) {
            $bind_params = array(&$param_types);
            foreach ($params as $key => $value) {
                $bind_params[] = &$params[$key];
            }
            call_user_func_array(array($stmt, 'bind_param'), $bind_params);
        }
        
        $stmt->execute();
        
        $result = $stmt->get_result();
        $authors = $result->fetch_all(MYSQLI_ASSOC);
        
        // دریافت تعداد کتاب‌های هر نویسنده
        foreach ($authors as &$author) {
            $sql = "SELECT COUNT(*) as book_count 
                    FROM library_book_authors 
                    WHERE author_id = ?";
            
            $count_stmt = $db->prepare($sql);
            $count_stmt->bind_param("i", $author['author_id']);
            $count_stmt->execute();
            
            $count_result = $count_stmt->get_result();
            $count_data = $count_result->fetch_assoc();
            $author['book_count'] = $count_data['book_count'];
        }
        
        // شمارش کل نویسندگان برای صفحه‌بندی
        $count_params = array_slice($params, 0, -3); // حذف language_id, limit و offset
        $count_param_types = substr($param_types, 0, -3);
        
        $count_sql = "SELECT COUNT(*) as total 
                      FROM library_authors a
                      JOIN library_author_translations at ON a.author_id = at.author_id
                      WHERE $where_clause AND at.language_id = ?";
        
        // اضافه کردن language_id به پارامترهای شمارش
        $count_params[] = $language_id;
        $count_param_types .= 'i';
        
        $count_stmt = $db->prepare($count_sql);
        
        if (!empty($count_params)) {
            $bind_params = array(&$count_param_types);
            foreach ($count_params as $key => $value) {
                $bind_params[] = &$count_params[$key];
            }
            call_user_func_array(array($count_stmt, 'bind_param'), $bind_params);
        }
        
        $count_stmt->execute();
        $count_result = $count_stmt->get_result();
        $count_data = $count_result->fetch_assoc();
        $total_count = $count_data['total'];
        
        $total_pages = ceil($total_count / $per_page);
        
        return [
            'authors' => $authors,
            'pagination' => [
                'current_page' => $page,
                'per_page' => $per_page,
                'total_count' => $total_count,
                'total_pages' => $total_pages
            ]
        ];
    }
}

/**
 * دریافت اطلاعات یک نویسنده خاص
 * 
 * @param int $author_id شناسه نویسنده
 * @param int $language_id شناسه زبان (پیش‌فرض: 1 برای فارسی)
 * @return array|null اطلاعات نویسنده یا null در صورت عدم وجود
 */
if (!function_exists('getAuthorDetails')) {
    function getAuthorDetails($author_id, $language_id = 1) {
        $db = getLibraryDatabaseConnection();
        
        $sql = "SELECT a.author_id, a.birth_date, a.death_date, a.nationality, a.gender, 
                       a.image, a.website, a.featured,
                       at.name, at.biography, at.quotes
                FROM library_authors a
                JOIN library_author_translations at ON a.author_id = at.author_id
                WHERE a.author_id = ? AND at.language_id = ?";
        
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ii", $author_id, $language_id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $author = $result->fetch_assoc();
        
        if ($author) {
            // دریافت کتاب‌های نویسنده
            $sql = "SELECT b.book_id, b.cover_image, bt.title, bt.subtitle, ba.role
                    FROM library_book_authors ba
                    JOIN library_books b ON ba.book_id = b.book_id
                    JOIN library_book_translations bt ON b.book_id = bt.book_id
                    WHERE ba.author_id = ?
                    AND bt.language_id = ?
                    AND b.is_available = 1
                    ORDER BY b.publication_date DESC";
            
            $stmt = $db->prepare($sql);
            $stmt->bind_param("ii", $author_id, $language_id);
            $stmt->execute();
            
            $result = $stmt->get_result();
            $author['books'] = $result->fetch_all(MYSQLI_ASSOC);
            
            // تبدیل رشته JSON شبکه‌های اجتماعی به آرایه
            if (!empty($author['social_media'])) {
                $author['social_media'] = json_decode($author['social_media'], true);
            }
        }
        
        return $author;
    }
}

/**
 * دریافت نویسندگان مرتبط
 * 
 * @param int $author_id شناسه نویسنده فعلی
 * @param string|null $nationality ملیت نویسنده
 * @param int $limit تعداد نویسندگان
 * @param int $language_id شناسه زبان
 * @return array آرایه‌ای از نویسندگان مرتبط
 */
if (!function_exists('getRelatedAuthors')) {
    function getRelatedAuthors($author_id, $nationality = null, $limit = 4, $language_id = 1) {
        $db = getLibraryDatabaseConnection();
        
        $sql = "SELECT a.author_id, a.image, a.nationality, at.name,
                       COUNT(DISTINCT ba.book_id) as book_count
                FROM library_authors a
                JOIN library_author_translations at ON a.author_id = at.author_id
                LEFT JOIN library_book_authors ba ON a.author_id = ba.author_id
                WHERE a.author_id != ?
                AND at.language_id = ?";
        
        $params = [$author_id, $language_id];
        $param_types = 'ii';
        
        // اگر ملیت مشخص شده، نویسندگان هم‌ملیت را ترجیح بده
        if (!empty($nationality)) {
            $sql .= " AND a.nationality = ?";
            $params[] = $nationality;
            $param_types .= 's';
        }
        
        $sql .= " GROUP BY a.author_id
                  HAVING book_count > 0
                  ORDER BY ";
        
        // اگر ملیت مشخص شده، ابتدا هم‌ملیت‌ها را نمایش بده
        if (!empty($nationality)) {
            $sql .= "(a.nationality = ?) DESC, ";
            $params[] = $nationality;
            $param_types .= 's';
        }
        
        $sql .= "book_count DESC, RAND()
                 LIMIT ?";
        
        $params[] = $limit;
        $param_types .= 'i';
        
        $stmt = $db->prepare($sql);
        
        $bind_params = array(&$param_types);
        foreach ($params as $key => $value) {
            $bind_params[] = &$params[$key];
        }
        call_user_func_array(array($stmt, 'bind_param'), $bind_params);
        
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

/**
 * دریافت آمار کتابخانه برای نمایش در صفحه اصلی
 * 
 * @return array آماری از کتابخانه
 */
if (!function_exists('getLibraryStats')) {
    function getLibraryStats() {
        $db = getLibraryDatabaseConnection();
        
        // تعداد کل کتاب‌ها
        $sql = "SELECT COUNT(*) as total FROM library_books WHERE is_available = 1";
        $result = $db->query($sql);
        $total_books = $result->fetch_assoc()['total'];
        
        // تعداد کل نویسندگان
        $sql = "SELECT COUNT(*) as total FROM library_authors";
        $result = $db->query($sql);
        $total_authors = $result->fetch_assoc()['total'];
        
        // تعداد کل ناشران
        $sql = "SELECT COUNT(*) as total FROM library_publishers WHERE is_active = 1";
        $result = $db->query($sql);
        $total_publishers = $result->fetch_assoc()['total'];
        
        // تعداد کل دسته‌بندی‌ها
        $sql = "SELECT COUNT(*) as total FROM library_categories WHERE is_active = 1";
        $result = $db->query($sql);
        $total_categories = $result->fetch_assoc()['total'];
        
        return [
            'total_books' => $total_books,
            'total_authors' => $total_authors,
            'total_publishers' => $total_publishers,
            'total_categories' => $total_categories
        ];
    }
}

/**
 * ایجاد لینک صفحه‌بندی
 * 
 * @param string $base_url آدرس پایه
 * @param array $params پارامترهای URL
 * @param int $page شماره صفحه
 * @return string لینک کامل با پارامترهای صفحه‌بندی
 */
if (!function_exists('getPaginationUrl')) {
    function getPaginationUrl($base_url, $params, $page) {
        $params['page'] = $page;
        return $base_url . '?' . http_build_query($params);
    }
}

/**
 * تبدیل تاریخ میلادی به شمسی
 * 
 * @param string $date تاریخ میلادی (Y-m-d)
 * @return string تاریخ شمسی
 */
if (!function_exists('convertToJalali')) {
    function convertToJalali($date) {
        if (empty($date)) return '';
        
        $date_array = explode('-', $date);
        if (count($date_array) !== 3) return $date;
        
        if (!function_exists('gregorian_to_jalali')) {
            function gregorian_to_jalali($g_y, $g_m, $g_d) {
                $g_days_in_month = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
                $j_days_in_month = [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29];
                
                $gy = $g_y - 1600;
                $gm = $g_m - 1;
                $gd = $g_d - 1;
                
                $g_day_no = 365 * $gy + floor(($gy + 3) / 4) - floor(($gy + 99) / 100) + floor(($gy + 399) / 400);
                
                for ($i = 0; $i < $gm; ++$i) {
                    $g_day_no += $g_days_in_month[$i];
                }
                
                if ($gm > 1 && (($gy % 4 === 0 && $gy % 100 !== 0) || ($gy % 400 === 0))) {
                    $g_day_no++;
                }
                
                $g_day_no += $gd;
                
                $j_day_no = $g_day_no - 79;
                
                $j_np = floor($j_day_no / 12053);
                $j_day_no %= 12053;
                
                $jy = 979 + 33 * $j_np + 4 * floor($j_day_no / 1461);
                
                $j_day_no %= 1461;
                
                if ($j_day_no >= 366) {
                    $jy += floor(($j_day_no - 1) / 365);
                    $j_day_no = ($j_day_no - 1) % 365;
                }
                
                for ($i = 0; $i < 11 && $j_day_no >= $j_days_in_month[$i]; ++$i) {
                    $j_day_no -= $j_days_in_month[$i];
                }
                
                $jm = $i + 1;
                $jd = $j_day_no + 1;
                
                return [$jy, $jm, $jd];
            }
        }
        
        list($jy, $jm, $jd) = gregorian_to_jalali($date_array[0], $date_array[1], $date_array[2]);
        
        // نام ماه‌های شمسی
        $jalali_months = [
            1 => 'فروردین',
            2 => 'اردیبهشت',
            3 => 'خرداد',
            4 => 'تیر',
            5 => 'مرداد',
            6 => 'شهریور',
            7 => 'مهر',
            8 => 'آبان',
            9 => 'آذر',
            10 => 'دی',
            11 => 'بهمن',
            12 => 'اسفند'
        ];
        
        return "$jd {$jalali_months[$jm]} $jy";
    }
}

/**
 * تبدیل حروف انگلیسی به معادل فارسی در عدد
 * 
 * @param mixed $number عدد یا رشته عددی
 * @return string عدد با حروف فارسی
 */
if (!function_exists('persianizeNumbers')) {
    function persianizeNumbers($number) {
        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        
        return str_replace($english, $persian, $number);
    }
}
?>