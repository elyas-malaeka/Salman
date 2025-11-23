<?php
/**
 * پردازش درخواست‌های AJAX کتابخانه آنلاین
 * 
 * این فایل برای پاسخگویی به درخواست‌های AJAX مانند جستجوی پویا، فیلتر کردن
 * و بارگذاری محتوای بیشتر استفاده می‌شود.
 * 
 * @package Salman Educational Complex
 * @subpackage Library
 * @version 1.0
 */

// شامل‌سازی فایل‌های مورد نیاز
require_once 'config.php';
require_once 'library_functions.php';

// بررسی وجود درخواست AJAX
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
    header('HTTP/1.0 403 Forbidden');
    exit('دسترسی مستقیم به این فایل مجاز نیست.');
}

// دریافت نوع عملیات
$action = isset($_GET['action']) ? $_GET['action'] : '';

// پاسخ پیش‌فرض
$response = [
    'success' => false,
    'message' => 'عملیات نامشخص',
    'data' => null
];

// پردازش بر اساس نوع عملیات
switch ($action) {
    // جستجوی کتاب‌ها
    case 'search_books':
        $search_term = isset($_GET['term']) ? $_GET['term'] : '';
        $category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;
        
        $filters = [
            'search' => $search_term
        ];
        
        if ($category_id > 0) {
            $filters['category_id'] = $category_id;
        }
        
        $result = getLibraryBooks($filters, 1, 10);
        
        // ساخت HTML نتایج جستجو
        $html = '';
        foreach ($result['books'] as $book) {
            $authors_list = [];
            foreach ($book['authors'] as $author) {
                $authors_list[] = $author['name'];
            }
            $authors_text = implode('، ', $authors_list);
            
            $html .= '<div class="search-result-item">';
            $html .= '<a href="library_book_detail.php?id=' . $book['book_id'] . '">';
            $html .= '<div class="search-result-image">';
            if (!empty($book['cover_image'])) {
                $html .= '<img src="' . $book['cover_image'] . '" alt="' . $book['title'] . '">';
            } else {
                $html .= '<div class="no-cover"><i class="fas fa-book"></i></div>';
            }
            $html .= '</div>';
            $html .= '<div class="search-result-info">';
            $html .= '<h4>' . $book['title'] . '</h4>';
            $html .= '<p class="search-result-author">' . $authors_text . '</p>';
            $html .= '</div>';
            $html .= '</a>';
            $html .= '</div>';
        }
        
        if (empty($html)) {
            $html = '<div class="search-no-results">نتیجه‌ای یافت نشد</div>';
        }
        
        $response = [
            'success' => true,
            'message' => 'نتایج جستجو',
            'data' => [
                'html' => $html,
                'count' => $result['pagination']['total_count']
            ]
        ];
        break;
    
    // بارگذاری کتاب‌های بیشتر
    case 'load_more_books':
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;
        $author_id = isset($_GET['author_id']) ? (int)$_GET['author_id'] : 0;
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'newest';
        
        $filters = [];
        
        if ($category_id > 0) {
            $filters['category_id'] = $category_id;
        }
        
        if ($author_id > 0) {
            $filters['author_id'] = $author_id;
        }
        
        if (!empty($search)) {
            $filters['search'] = $search;
        }
        
        $result = getLibraryBooks($filters, $page, 12, $sort_by);
        
        // ساخت HTML کارت‌های کتاب
        $html = '';
        foreach ($result['books'] as $book) {
            $html .= getBookCardHtml($book);
        }
        
        $response = [
            'success' => true,
            'message' => 'کتاب‌های بیشتر بارگذاری شد',
            'data' => [
                'html' => $html,
                'pagination' => $result['pagination'],
                'has_more' => ($result['pagination']['current_page'] < $result['pagination']['total_pages'])
            ]
        ];
        break;
    
    // فیلتر کردن نویسندگان
    case 'filter_authors':
        $first_letter = isset($_GET['first_letter']) ? $_GET['first_letter'] : '';
        $nationality = isset($_GET['nationality']) ? $_GET['nationality'] : '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        
        $filters = [];
        
        if (!empty($first_letter)) {
            $filters['first_letter'] = $first_letter;
        }
        
        if (!empty($nationality)) {
            $filters['nationality'] = $nationality;
        }
        
        $result = getLibraryAuthors($filters, $page);
        
        // ساخت HTML کارت‌های نویسنده
        $html = '';
        foreach ($result['authors'] as $author) {
            $html .= getAuthorCardHtml($author);
        }
        
        $response = [
            'success' => true,
            'message' => 'نویسندگان فیلتر شدند',
            'data' => [
                'html' => $html,
                'pagination' => $result['pagination'],
                'has_more' => ($result['pagination']['current_page'] < $result['pagination']['total_pages'])
            ]
        ];
        break;
    
    // حالت پیش‌فرض
    default:
        $response = [
            'success' => false,
            'message' => 'عملیات نامعتبر',
            'data' => null
        ];
        break;
}

// خروجی JSON
header('Content-Type: application/json');
echo json_encode($response);

/**
 * ایجاد HTML کارت کتاب
 * 
 * @param array $book اطلاعات کتاب
 * @return string HTML کارت کتاب
 */
function getBookCardHtml($book) {
    $authors_list = [];
    foreach ($book['authors'] as $author) {
        $authors_list[] = '<a href="library_author_detail.php?id=' . $author['author_id'] . '">' . $author['name'] . '</a>';
    }
    $authors_text = implode('، ', $authors_list);
    
    $html = '<div class="col-md-6 col-lg-4 col-xl-3">';
    $html .= '<div class="book-card">';
    $html .= '<div class="book-card-cover">';
    $html .= '<a href="library_book_detail.php?id=' . $book['book_id'] . '">';
    
    if (!empty($book['cover_image'])) {
        $html .= '<img src="' . $book['cover_image'] . '" alt="' . $book['title'] . '" class="img-fluid">';
    } else {
        $html .= '<div class="no-cover-img"><i class="fas fa-book"></i></div>';
    }
    
    $html .= '</a>';
    $html .= '</div>';
    $html .= '<div class="book-card-body">';
    $html .= '<h3 class="book-title"><a href="library_book_detail.php?id=' . $book['book_id'] . '">' . $book['title'] . '</a></h3>';
    $html .= '<p class="book-authors">' . $authors_text . '</p>';
    
    if (!empty($book['publication_date'])) {
        $html .= '<p class="book-date">' . convertToJalali($book['publication_date']) . '</p>';
    }
    
    $html .= '</div>';
    $html .= '<div class="book-card-footer">';
    $html .= '<a href="library_book_detail.php?id=' . $book['book_id'] . '" class="btn-see-details">مشاهده جزئیات</a>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    
    return $html;
}

/**
 * ایجاد HTML کارت نویسنده
 * 
 * @param array $author اطلاعات نویسنده
 * @return string HTML کارت نویسنده
 */
function getAuthorCardHtml($author) {
    $html = '<div class="col-md-6 col-lg-4 col-xl-3">';
    $html .= '<div class="author-card">';
    $html .= '<div class="author-card-image">';
    $html .= '<a href="library_author_detail.php?id=' . $author['author_id'] . '">';
    
    if (!empty($author['image'])) {
        $html .= '<img src="' . $author['image'] . '" alt="' . $author['name'] . '" class="img-fluid rounded-circle">';
    } else {
        $html .= '<div class="no-author-img"><i class="fas fa-user"></i></div>';
    }
    
    $html .= '</a>';
    $html .= '</div>';
    $html .= '<div class="author-card-body">';
    $html .= '<h3 class="author-name"><a href="library_author_detail.php?id=' . $author['author_id'] . '">' . $author['name'] . '</a></h3>';
    
    if (!empty($author['nationality'])) {
        $html .= '<p class="author-nationality">' . $author['nationality'] . '</p>';
    }
    
    $html .= '<p class="author-books">' . persianizeNumbers($author['book_count']) . ' کتاب</p>';
    $html .= '</div>';
    $html .= '<div class="author-card-footer">';
    $html .= '<a href="library_author_detail.php?id=' . $author['author_id'] . '" class="btn-see-details">مشاهده آثار</a>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    
    return $html;
}
?>