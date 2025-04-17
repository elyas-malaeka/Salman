<style>
    /**
 * Blog Page Styles
 * 
 * Styles for the Salman Educational Complex Blog Page
 * Including header, post cards, sidebar, and pagination
 * 
 * @version 2.0
 */

:root {
    --primary-color: #4361ee;
    --secondary-color: #6366f1;
    --text-color: #333;
    --text-light: #666;
    --bg-light: #f8f9fa;
    --white: #ffffff;
    --border-radius: 15px;
    --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    --animation-duration: 0.3s;
}

/* Global Styles */
body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--text-color);
    background-color: #f5f7fa;
    overflow-x: hidden;
}

[dir="rtl"] body {
    font-family: 'Vazirmatn', sans-serif;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

/* Blog Header */
.blog-header {
    background: linear-gradient(135deg, #4361ee 0%, #6366f1 100%);
    position: relative;
    overflow: hidden;
    color: var(--white);
    text-align: center;
    padding: 100px 0 80px;
    margin-bottom: 60px;
}

.blog-header::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    height: 100px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23f5f7fa' fill-opacity='1' d='M0,192L60,186.7C120,181,240,171,360,181.3C480,192,600,224,720,229.3C840,235,960,213,1080,181.3C1200,149,1320,107,1380,85.3L1440,64L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
    background-size: cover;
    background-position: center;
    z-index: 1;
}

.blog-header__bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.blog-header__shape {
    position: absolute;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.1);
}

.blog-header__shape-1 {
    width: 300px;
    height: 300px;
    top: -100px;
    right: -100px;
}

.blog-header__shape-2 {
    width: 200px;
    height: 200px;
    bottom: -50px;
    left: -50px;
}

.blog-header__shape-3 {
    width: 150px;
    height: 150px;
    top: 50%;
    left: 30%;
    transform: translateY(-50%);
}

.blog-header__content {
    position: relative;
    z-index: 10;
}

.blog-header__title {
    font-size: 42px;
    font-weight: 800;
    margin-bottom: 15px;
    color: var(--white);
    font-family:Vazir;
}

.blog-header__breadcrumb {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    font-size: 16px;
}

.blog-header__breadcrumb a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    transition: color var(--animation-duration) ease;
}

.blog-header__breadcrumb a:hover {
    color: var(--white);
}

.blog-header__breadcrumb i {
    font-size: 12px;
    color: rgba(255, 255, 255, 0.6);
}

.blog-header__breadcrumb span {
    color: var(--white);
}

/* Blog Section */
.blog-section {
    padding: 0 0 80px;
}

/* Featured Post */
.featured-post {
    background-color: var(--white);
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--card-shadow);
    margin-bottom: 40px;
    transition: transform var(--animation-duration) ease, box-shadow var(--animation-duration) ease;
}

.featured-post:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
}

.featured-post__image {
    position: relative;
    height: 400px;
    overflow: hidden;
}

.featured-post__image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform var(--animation-duration) ease;
}

.featured-post:hover .featured-post__image img {
    transform: scale(1.05);
}

.featured-post__link {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.featured-post__date {
    position: absolute;
    top: 20px;
    right: 20px;
    background-color: var(--primary-color);
    color: var(--white);
    padding: 10px 15px;
    border-radius: 8px;
    text-align: center;
    font-size: 14px;
    font-weight: 500;
    z-index: 2;
}

[dir="rtl"] .featured-post__date {
    right: auto;
    left: 20px;
}

.featured-post__date span {
    display: block;
    font-size: 22px;
    font-weight: 700;
    line-height: 1.2;
}

.featured-post__content {
    padding: 35px 30px 30px;
}

.featured-post__category {
    margin-bottom: 15px;
}

.featured-post__category a {
    display: inline-block;
    background-color: rgba(67, 97, 238, 0.1);
    color: var(--primary-color);
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 14px;
    text-decoration: none;
    transition: all var(--animation-duration) ease;
}

.featured-post__category a:hover {
    background-color: var(--primary-color);
    color: var(--white);
}

.featured-post__title {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 15px;
    line-height: 1.4;
}

.featured-post__title a {
    color: var(--text-color);
    text-decoration: none;
    transition: color var(--animation-duration) ease;
}

.featured-post__title a:hover {
    color: var(--primary-color);
}

.featured-post__text {
    color: var(--text-light);
    margin-bottom: 20px;
    line-height: 1.6;
}

.featured-post__more {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: var(--primary-color);
    font-weight: 600;
    text-decoration: none;
    transition: all var(--animation-duration) ease;
}

.featured-post__more:hover {
    color: var(--secondary-color);
    gap: 12px;
}

/* Blog Grid */
.blog-grid {
    margin-bottom: 50px;
}
/* Blog Card and Image Styles */
.blog-card {
    background-color: #ffffff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    height: 100%;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    margin-bottom: 30px;
}

.blog-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
}

.blog-card__image {
    position: relative;
    height: 220px;
    overflow: hidden;
}

.blog-card__image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.blog-card:hover .blog-card__image img {
    transform: scale(1.05);
}

.blog-card__link {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}


.blog-card__date {
    position: absolute;
    top: 15px;
    right: 15px;
    background-color: #4361ee;
    color: #ffffff;
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 500;
    z-index: 2;
}

[dir="rtl"] .blog-card__date {
    right: auto;
    left: 15px;
}

.blog-card__content {
    padding: 25px 20px;
}

.blog-card__category {
    margin-bottom: 10px;
}

.blog-card__category a {
    color: var(--primary-color);
    text-decoration: none;
    font-size: 13px;
    transition: color var(--animation-duration) ease;
}

.blog-card__category a:hover {
    color: var(--secondary-color);
}

.blog-card__title {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 12px;
    line-height: 1.4;
}

.blog-card__title a {
    color: var(--text-color);
    text-decoration: none;
    transition: color var(--animation-duration) ease;
}

.blog-card__title a:hover {
    color: var(--primary-color);
}

.blog-card__text {
    color: var(--text-light);
    font-size: 14px;
    margin-bottom: 15px;
    line-height: 1.6;
}

.blog-card__more {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: var(--primary-color);
    font-weight: 500;
    font-size: 14px;
    text-decoration: none;
    transition: all var(--animation-duration) ease;
}

.blog-card__more:hover {
    color: var(--secondary-color);
    gap: 10px;
}

/* Pagination */
.blog-pagination {
    display: flex;
    justify-content: center;
    margin-top: 40px;
    gap: 10px;
    flex-wrap: wrap;
}

.blog-pagination__page,
.blog-pagination__arrow {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    background-color: var(--white);
    color: var(--text-color);
    text-decoration: none;
    transition: all var(--animation-duration) ease;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.blog-pagination__page:hover,
.blog-pagination__arrow:hover {
    background-color: rgba(67, 97, 238, 0.1);
    color: var(--primary-color);
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
}

.blog-pagination__page.active {
    background-color: var(--primary-color);
    color: var(--white);
}

/* No Posts Message */
.no-posts {
    background-color: var(--white);
    border-radius: var(--border-radius);
    padding: 50px 30px;
    text-align: center;
    box-shadow: var(--card-shadow);
}

.no-posts__icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background-color: rgba(67, 97, 238, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    color: var(--primary-color);
    margin: 0 auto 25px;
}

.no-posts__title {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 15px;
}

.no-posts__text {
    color: var(--text-light);
    margin-bottom: 25px;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}

.no-posts__button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background-color: var(--primary-color);
    color: var(--white);
    padding: 12px 25px;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    transition: all var(--animation-duration) ease;
}

.no-posts__button:hover {
    background-color: var(--secondary-color);
    transform: translateY(-3px);
    box-shadow: 0 8px 15px rgba(67, 97, 238, 0.2);
}

/* Blog Sidebar */
.blog-sidebar {
    position: sticky;
    top: 30px;
}

.blog-sidebar__widget {
    background-color: var(--white);
    border-radius: var(--border-radius);
    padding: 25px;
    margin-bottom: 30px;
    box-shadow: var(--card-shadow);
}

.blog-sidebar__title {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 20px;
    position: relative;
    padding-bottom: 10px;
}

.blog-sidebar__title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 2px;
    background-color: var(--primary-color);
}

[dir="rtl"] .blog-sidebar__title::after {
    left: auto;
    right: 0;
}

/* Search Widget */
.blog-sidebar__search-form {
    position: relative;
}

.blog-sidebar__search-form input {
    width: 100%;
    padding: 12px 45px 12px 15px;
    border: 1px solid #eee;
    border-radius: 8px;
    font-size: 14px;
    transition: all var(--animation-duration) ease;
}

[dir="rtl"] .blog-sidebar__search-form input {
    padding: 12px 15px 12px 45px;
}

.blog-sidebar__search-form input:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
}

.blog-sidebar__search-form button {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--text-light);
    cursor: pointer;
    transition: color var(--animation-duration) ease;
}

[dir="rtl"] .blog-sidebar__search-form button {
    right: auto;
    left: 15px;
}

.blog-sidebar__search-form button:hover {
    color: var(--primary-color);
}

/* Latest Posts Widget */
.blog-sidebar__post-list {
    padding: 0;
    margin: 0;
    list-style: none;
}

.blog-sidebar__post-item {
    display: flex;
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #eee;
}

.blog-sidebar__post-item:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}

.blog-sidebar__post-image {
    width: 80px;
    height: 80px;
    border-radius: 10px;
    overflow: hidden;
    margin-right: 15px;
    flex-shrink: 0;
}

[dir="rtl"] .blog-sidebar__post-image {
    margin-right: 0;
    margin-left: 15px;
}

.blog-sidebar__post-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform var(--animation-duration) ease;
}

.blog-sidebar__post-item:hover .blog-sidebar__post-image img {
    transform: scale(1.05);
}

.blog-sidebar__post-content {
    flex: 1;
}

.blog-sidebar__post-title {
    font-size: 15px;
    font-weight: 600;
    line-height: 1.4;
    margin: 0 0 8px;
}

.blog-sidebar__post-title a {
    color: var(--text-color);
    text-decoration: none;
    transition: color var(--animation-duration) ease;
}

.blog-sidebar__post-title a:hover {
    color: var(--primary-color);
}

.blog-sidebar__post-date {
    font-size: 13px;
    color: var(--text-light);
}

/* Categories Widget */
.blog-sidebar__categories-list {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.blog-sidebar__category {
    display: inline-flex;
    align-items: center;
    justify-content: space-between;
    padding: 8px 15px;
    background-color: rgba(67, 97, 238, 0.1);
    color: var(--primary-color);
    border-radius: 8px;
    font-size: 14px;
    text-decoration: none;
    transition: all var(--animation-duration) ease;
}

.blog-sidebar__category span {
    display: inline-block;
    padding: 2px 8px;
    background-color: rgba(67, 97, 238, 0.2);
    border-radius: 10px;
    font-size: 12px;
    margin-left: 8px;
}

[dir="rtl"] .blog-sidebar__category span {
    margin-left: 0;
    margin-right: 8px;
}

.blog-sidebar__category:hover,
.blog-sidebar__category.active {
    background-color: var(--primary-color);
    color: var(--white);
}

.blog-sidebar__category:hover span,
.blog-sidebar__category.active span {
    background-color: rgba(255, 255, 255, 0.3);
}

/* Popular Articles Widget */
.blog-sidebar__popular-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.blog-sidebar__popular-item {
    background-color: rgba(67, 97, 238, 0.05);
    border-radius: 10px;
    padding: 15px;
    transition: all var(--animation-duration) ease;
}

.blog-sidebar__popular-item:hover {
    background-color: rgba(67, 97, 238, 0.1);
    transform: translateY(-5px);
}

.blog-sidebar__popular-category {
    display: inline-block;
    padding: 4px 10px;
    background-color: var(--primary-color);
    color: var(--white);
    border-radius: 20px;
    font-size: 12px;
    margin-bottom: 10px;
}

.blog-sidebar__popular-title {
    font-size: 16px;
    font-weight: 600;
    margin: 0 0 10px;
    line-height: 1.4;
}

.blog-sidebar__popular-title a {
    color: var(--text-color);
    text-decoration: none;
    transition: color var(--animation-duration) ease;
}

.blog-sidebar__popular-title a:hover {
    color: var(--primary-color);
}

.blog-sidebar__popular-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.blog-sidebar__popular-meta span {
    font-size: 13px;
    color: var(--text-light);
}

.blog-sidebar__popular-arrow {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    background-color: var(--white);
    color: var(--primary-color);
    border-radius: 50%;
    transition: all var(--animation-duration) ease;
}

.blog-sidebar__popular-arrow:hover {
    background-color: var(--primary-color);
    color: var(--white);
    transform: translateX(3px);
}

[dir="rtl"] .blog-sidebar__popular-arrow:hover {
    transform: translateX(-3px);
}

/* Responsive Adjustments */
@media (max-width: 1199px) {
    .blog-header__title {
        font-size: 36px;
    }
    
    .featured-post__image {
        height: 350px;
    }
    
    .featured-post__title {
        font-size: 24px;
    }
}

@media (max-width: 991px) {
    .blog-header {
        padding: 120px 0 70px;
        margin-bottom: 40px;
    }
    
    .blog-header__title {
        font-size: 30px;
    }
    
    .blog-sidebar {
        position: static;
        margin-top: 40px;
    }
    
    .featured-post__image {
        height: 300px;
    }
}

@media (max-width: 767px) {
    .blog-header {
        padding: 100px 0 60px;
    }
    
    .blog-header__title {
        font-size: 26px;
    }
    
    .featured-post__image {
        height: 250px;
    }
    
    .featured-post__title {
        font-size: 22px;
    }
    
    .featured-post__content {
        padding: 25px 20px;
    }
    
    .blog-card {
        margin-bottom: 20px;
    }
    
    .blog-card__image {
        height: 180px;
    }
}

@media (max-width: 575px) {
    .blog-header {
        padding: 90px 0 50px;
    }
    
    .blog-header__title {
        font-size: 22px;
    }
    
    .blog-section {
        padding: 0 0 50px;
    }
    
    .featured-post__image {
        height: 200px;
    }
    
    .featured-post__title {
        font-size: 20px;
    }
    
    .featured-post__content {
        padding: 20px 15px;
    }
    
    .blog-sidebar__widget {
        padding: 20px;
    }
    
    .blog-sidebar__post-image {
        width: 70px;
        height: 70px;
    }
}
/* Header Section Styles */
.terms-header {
    background: linear-gradient(135deg, #0F172A 0%, #1E293B 60%, #334155 100%);
    position: relative;
    overflow: hidden;
    color: var(--white);
    text-align: center;
    padding: 180px 0 140px;
    margin-top: 0;
}

/* Cosmic Background Effect */
.cosmic-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    opacity: 0.7;
}

.cosmic-star {
    position: absolute;
    background-color: #fff;
    border-radius: 50%;
    animation: twinkle var(--animation-duration) infinite alternate;
}

@keyframes twinkle {
    from { opacity: 0.2; }
    to { opacity: 1; }
}

/* Random Stars using Pseudo-elements */
.cosmic-bg::before, 
.cosmic-bg::after {
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    background-image: 
        radial-gradient(circle, rgba(255,255,255,0.8) 1px, transparent 1px),
        radial-gradient(circle, rgba(255,255,255,0.5) 1px, transparent 1px),
        radial-gradient(circle, rgba(255,255,255,0.3) 1px, transparent 1px);
    background-size: 
        100px 100px,
        150px 150px,
        200px 200px;
    animation: cosmic-rotate 100s linear infinite;
}

.cosmic-bg::after {
    background-size: 
        120px 120px,
        170px 170px,
        220px 220px;
    animation-duration: 150s;
    animation-direction: reverse;
}

@keyframes cosmic-rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Cosmic Planets */
.cosmic-planet {
    position: absolute;
    border-radius: 50%;
    opacity: 0.3;
    filter: blur(20px);
}

.cosmic-planet:nth-child(1) {
    top: -50px;
    left: -100px;
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, #7F56D9, #4E36B1);
}

.cosmic-planet:nth-child(2) {
    bottom: -80px;
    right: -80px;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, #9E77ED, #6941C6);
}

.terms-header::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    height: 150px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23f5f7fa' fill-opacity='1' d='M0,192L60,186.7C120,181,240,171,360,181.3C480,192,600,224,720,229.3C840,235,960,213,1080,181.3C1200,149,1320,107,1380,85.3L1440,64L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
    background-size: cover;
    background-position: center bottom;
    z-index: 1;
}

.terms-header__content {
    position: relative;
    z-index: 2;
}

.terms-header__title {
    font-family: 'Vazir', sans-serif !important;
    font-size: 38px;
    font-weight: 800;
    margin-bottom: 15px;
    color: white;
    animation: slideDown 1s ease-out, floatEffect 4s ease-in-out infinite;
}

.terms-header__subtitle {
    font-family: 'Vazir', sans-serif;
    font-size: 18px;
    max-width: 700px;
    margin: 0 auto 40px;
    opacity: 0.9;
    color: white;
    animation: slideDown 1s ease-out 0.3s both, floatEffect 5s ease-in-out infinite;
}
/* Font Styles */
@font-face {
    font-family: 'Vazir';
    src: url('../fonts/Vazir.eot');
    src: url('../fonts/Vazir.eot?#iefix') format('embedded-opentype'),
         url('../fonts/Vazir.woff2') format('woff2'),
         url('../fonts/Vazir.woff') format('woff'),
         url('../fonts/Vazir.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;
}

@font-face {
    font-family: 'Vazir';
    src: url('../fonts/Vazir-Bold.eot');
    src: url('../fonts/Vazir-Bold.eot?#iefix') format('embedded-opentype'),
         url('../fonts/Vazir-Bold.woff2') format('woff2'),
         url('../fonts/Vazir-Bold.woff') format('woff'),
         url('../fonts/Vazir-Bold.ttf') format('truetype');
    font-weight: bold;
    font-style: normal;
}
</style>