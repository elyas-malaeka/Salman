<!DOCTYPE html>
<html lang="fa" dir="rtl" class="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>کتاب‌های کتابخانه - کتابخانه آنلاین مجتمع آموزشی سلمان</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* استفاده از Design Tokens */
        :root {
            --primary: hsl(243, 100%, 69%);
            --primary-rgb: 108, 99, 255;
            --primary-50: hsl(243, 100%, 97%);
            --primary-100: hsl(243, 100%, 94%);
            --primary-500: var(--primary);
            --primary-600: hsl(243, 100%, 62%);
            --primary-700: hsl(243, 100%, 54%);
            
            --secondary-color: #333333;
            --accent-color: #7F56D9;
            --deep-purple: #6941C6;
            
            --sky-blue: #6C9EFF;
            --purple: #9471FF;
            --pink: #FF6B8B;
            --teal: #36F1CD;
            --yellow: #FFDE59;
            --orange: #FF8A65;
            
            --text-color: #333;
            --text-dark: #1E293B;
            --text-light: #666;
            --text-muted: #64748B;
            --text-gray: #6B7280;
            
            --white: #ffffff;
            --bg-primary: #f9f9f9;
            --bg-light: #f8f9fa;
            --light-purple: rgba(108, 99, 255, 0.05);
            --light-sky: #E8F5FF;
            
            --gradient-primary: linear-gradient(135deg, #4E36B1 0%, #6941C6 50%, #7F56D9 100%);
            --gradient-cosmic: linear-gradient(135deg, #1e0057 0%, #391e85 50%, #6C63FF 100%);
            --gradient-soft: linear-gradient(135deg, #E0E0FF 0%, #F5F3FF 100%);
            --gradient-glass: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
            
            --space-1: 0.25rem;
            --space-2: 0.5rem;
            --space-3: 0.75rem;
            --space-4: 1rem;
            --space-5: 1.25rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            --space-10: 2.5rem;
            --space-12: 3rem;
            --space-16: 4rem;
            --space-20: 5rem;
            --space-24: 6rem;
            
            --radius-sm: 0.125rem;
            --radius-md: 0.375rem;
            --radius-lg: 0.5rem;
            --radius-xl: 0.75rem;
            --radius-2xl: 1rem;
            --radius-3xl: 1.5rem;
            --radius-full: 9999px;
            
            --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            --shadow-primary: 0 10px 40px -10px rgba(var(--primary-rgb), 0.35);
            
            --font-size-xs: 0.75rem;
            --font-size-sm: 0.875rem;
            --font-size-base: 1rem;
            --font-size-lg: 1.125rem;
            --font-size-xl: 1.25rem;
            --font-size-2xl: 1.5rem;
            --font-size-3xl: 1.875rem;
            --font-size-4xl: 2.25rem;
            --font-size-5xl: 3rem;
            
            --duration-fast: 150ms;
            --duration-normal: 200ms;
            --duration-slow: 300ms;
            --ease-out: cubic-bezier(0, 0, 0.2, 1);
            --ease-bounce: cubic-bezier(0.87, -0.41, 0.19, 1.44);
            --ease-elastic: cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Vazirmatn', sans-serif;
            background: var(--bg-primary);
            color: var(--text-color);
            line-height: 1.6;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 var(--space-6);
        }
        
        /* ========== MODERN HEADER ========== */
        .books-header {
            background: var(--gradient-cosmic);
            padding: var(--space-20) 0 var(--space-16);
            position: relative;
            overflow: hidden;
        }
        
        .header-bg-effects {
            position: absolute;
            inset: 0;
            background: 
                radial-gradient(ellipse at 25% 50%, rgba(108, 99, 255, 0.3) 0%, transparent 50%),
                radial-gradient(ellipse at 75% 50%, rgba(255, 107, 139, 0.2) 0%, transparent 50%);
            z-index: 1;
        }
        
        .header-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: white;
        }
        
        .header-badge {
            display: inline-flex;
            align-items: center;
            gap: var(--space-2);
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--radius-full);
            padding: var(--space-2) var(--space-5);
            font-size: var(--font-size-sm);
            margin-bottom: var(--space-6);
        }
        
        .header-title {
            font-size: var(--font-size-4xl);
            font-weight: 800;
            margin-bottom: var(--space-4);
            background: linear-gradient(135deg, #ffffff 0%, #e0e7ff 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .header-subtitle {
            font-size: var(--font-size-xl);
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto var(--space-10);
        }
        
        /* ========== ADVANCED SEARCH BAR ========== */
        .search-section {
            background: white;
            padding: var(--space-8) 0;
            border-bottom: 1px solid var(--light-purple);
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }
        
        .search-container {
            display: flex;
            gap: var(--space-4);
            align-items: center;
            flex-wrap: wrap;
        }
        
        .search-bar {
            flex: 1;
            min-width: 300px;
            position: relative;
        }
        
        .search-input {
            width: 100%;
            padding: var(--space-4) var(--space-6) var(--space-4) var(--space-12);
            border: 2px solid var(--primary-100);
            border-radius: var(--radius-2xl);
            font-size: var(--font-size-base);
            transition: all var(--duration-normal) var(--ease-out);
            background: white;
        }
        
        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(var(--primary-rgb), 0.1);
        }
        
        .search-icon {
            position: absolute;
            right: var(--space-4);
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: var(--font-size-lg);
        }
        
        .search-filters {
            display: flex;
            gap: var(--space-3);
            align-items: center;
        }
        
        .filter-dropdown {
            position: relative;
        }
        
        .filter-btn {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            background: var(--light-purple);
            border: 1px solid var(--primary-100);
            border-radius: var(--radius-xl);
            padding: var(--space-3) var(--space-5);
            cursor: pointer;
            transition: all var(--duration-fast) var(--ease-out);
            font-size: var(--font-size-sm);
            font-weight: 500;
            color: var(--primary);
        }
        
        .filter-btn:hover {
            background: var(--primary-100);
            border-color: var(--primary);
        }
        
        .view-toggle {
            display: flex;
            gap: var(--space-1);
            background: var(--light-purple);
            border-radius: var(--radius-xl);
            padding: var(--space-1);
        }
        
        .view-btn {
            background: transparent;
            border: none;
            border-radius: var(--radius-lg);
            padding: var(--space-2) var(--space-3);
            cursor: pointer;
            transition: all var(--duration-fast) var(--ease-out);
            color: var(--text-muted);
        }
        
        .view-btn.active {
            background: var(--primary);
            color: white;
            box-shadow: var(--shadow-primary);
        }
        
        /* ========== LAYOUT GRID ========== */
        .main-layout {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: var(--space-8);
            padding: var(--space-8) 0;
            min-height: 70vh;
        }
        
        /* ========== ADVANCED SIDEBAR FILTERS ========== */
        .sidebar {
            position: sticky;
            top: 140px;
            height: fit-content;
        }
        
        .filter-section {
            background: white;
            border-radius: var(--radius-2xl);
            padding: var(--space-6);
            margin-bottom: var(--space-6);
            box-shadow: var(--shadow-lg);
            position: relative;
            overflow: hidden;
        }
        
        .filter-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }
        
        .filter-title {
            font-size: var(--font-size-lg);
            font-weight: 700;
            margin-bottom: var(--space-5);
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: var(--space-3);
        }
        
        .filter-icon {
            width: 32px;
            height: 32px;
            background: var(--gradient-primary);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: var(--font-size-sm);
        }
        
        .filter-group {
            margin-bottom: var(--space-5);
        }
        
        .filter-group:last-child {
            margin-bottom: 0;
        }
        
        .filter-label {
            font-size: var(--font-size-sm);
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: var(--space-3);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .filter-options {
            display: flex;
            flex-direction: column;
            gap: var(--space-2);
        }
        
        .filter-option {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            padding: var(--space-2);
            border-radius: var(--radius-lg);
            transition: all var(--duration-fast) var(--ease-out);
            cursor: pointer;
        }
        
        .filter-option:hover {
            background: var(--light-purple);
        }
        
        .filter-checkbox {
            width: 18px;
            height: 18px;
            border: 2px solid var(--primary-100);
            border-radius: var(--radius-sm);
            position: relative;
            cursor: pointer;
            transition: all var(--duration-fast) var(--ease-out);
        }
        
        .filter-checkbox.checked {
            background: var(--primary);
            border-color: var(--primary);
        }
        
        .filter-checkbox.checked::after {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 10px;
        }
        
        .filter-text {
            font-size: var(--font-size-sm);
            color: var(--text-gray);
            flex: 1;
        }
        
        .filter-count {
            font-size: var(--font-size-xs);
            color: var(--text-muted);
            background: var(--light-purple);
            border-radius: var(--radius-full);
            padding: var(--space-1) var(--space-2);
        }
        
        /* Price Range Slider */
        .price-range {
            margin: var(--space-4) 0;
        }
        
        .range-slider {
            width: 100%;
            height: 6px;
            background: var(--light-purple);
            border-radius: var(--radius-full);
            position: relative;
            cursor: pointer;
        }
        
        .range-track {
            height: 100%;
            background: var(--gradient-primary);
            border-radius: var(--radius-full);
            position: relative;
        }
        
        .range-thumb {
            width: 20px;
            height: 20px;
            background: white;
            border: 3px solid var(--primary);
            border-radius: 50%;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            cursor: grab;
            box-shadow: var(--shadow-md);
        }
        
        .range-thumb:active {
            cursor: grabbing;
            transform: translateY(-50%) scale(1.1);
        }
        
        .price-labels {
            display: flex;
            justify-content: space-between;
            margin-top: var(--space-2);
            font-size: var(--font-size-xs);
            color: var(--text-muted);
        }
        
        /* ========== CONTENT AREA ========== */
        .content-area {
            min-height: 600px;
        }
        
        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--space-8);
            padding: var(--space-6);
            background: white;
            border-radius: var(--radius-2xl);
            box-shadow: var(--shadow-md);
        }
        
        .results-info {
            display: flex;
            align-items: center;
            gap: var(--space-4);
        }
        
        .results-count {
            font-size: var(--font-size-lg);
            font-weight: 600;
            color: var(--text-dark);
        }
        
        .results-total {
            font-size: var(--font-size-sm);
            color: var(--text-muted);
        }
        
        .sort-controls {
            display: flex;
            align-items: center;
            gap: var(--space-4);
        }
        
        .sort-label {
            font-size: var(--font-size-sm);
            color: var(--text-muted);
        }
        
        .sort-select {
            background: var(--light-purple);
            border: 1px solid var(--primary-100);
            border-radius: var(--radius-xl);
            padding: var(--space-2) var(--space-4);
            font-size: var(--font-size-sm);
            color: var(--text-dark);
            cursor: pointer;
            transition: all var(--duration-fast) var(--ease-out);
        }
        
        .sort-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(var(--primary-rgb), 0.1);
        }
        
        /* ========== BOOKS GRID VIEW ========== */
        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: var(--space-6);
            margin-bottom: var(--space-12);
        }
        
        .book-card {
            background: white;
            border-radius: var(--radius-2xl);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            transition: all var(--duration-slow) var(--ease-out);
            cursor: pointer;
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .book-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: var(--shadow-2xl);
        }
        
        .book-cover {
            position: relative;
            height: 300px;
            overflow: hidden;
            background: var(--gradient-soft);
        }
        
        .book-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform var(--duration-slow) var(--ease-out);
        }
        
        .book-card:hover .book-cover img {
            transform: scale(1.1);
        }
        
        .book-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.8) 100%);
            opacity: 0;
            transition: opacity var(--duration-normal) var(--ease-out);
            display: flex;
            align-items: flex-end;
            padding: var(--space-6);
        }
        
        .book-card:hover .book-overlay {
            opacity: 1;
        }
        
        .book-actions {
            display: flex;
            gap: var(--space-2);
        }
        
        .action-btn {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: var(--radius-lg);
            padding: var(--space-2);
            cursor: pointer;
            transition: all var(--duration-fast) var(--ease-out);
            color: var(--text-dark);
        }
        
        .action-btn:hover {
            background: white;
            transform: scale(1.1);
        }
        
        .no-cover-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--gradient-primary);
            color: white;
            font-size: var(--font-size-3xl);
        }
        
        .book-info {
            padding: var(--space-6);
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .book-title {
            font-size: var(--font-size-lg);
            font-weight: 700;
            margin-bottom: var(--space-2);
            color: var(--text-dark);
            line-height: 1.4;
            flex: 1;
        }
        
        .book-author {
            color: var(--primary);
            font-weight: 500;
            margin-bottom: var(--space-3);
            font-size: var(--font-size-base);
        }
        
        .book-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: var(--font-size-sm);
            color: var(--text-muted);
            margin-bottom: var(--space-4);
        }
        
        .book-categories {
            display: flex;
            flex-wrap: wrap;
            gap: var(--space-1);
        }
        
        .category-tag {
            background: var(--light-purple);
            color: var(--primary);
            border-radius: var(--radius-full);
            padding: var(--space-1) var(--space-2);
            font-size: var(--font-size-xs);
            font-weight: 500;
        }
        
        /* ========== BOOKS LIST VIEW ========== */
        .books-list {
            display: none;
            flex-direction: column;
            gap: var(--space-6);
            margin-bottom: var(--space-12);
        }
        
        .books-list.active {
            display: flex;
        }
        
        .book-list-item {
            background: white;
            border-radius: var(--radius-2xl);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            transition: all var(--duration-normal) var(--ease-out);
            cursor: pointer;
            display: flex;
        }
        
        .book-list-item:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-xl);
        }
        
        .list-cover {
            width: 200px;
            height: 150px;
            flex-shrink: 0;
            background: var(--gradient-soft);
            position: relative;
            overflow: hidden;
        }
        
        .list-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .list-info {
            padding: var(--space-6);
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        
        .list-title {
            font-size: var(--font-size-xl);
            font-weight: 700;
            margin-bottom: var(--space-2);
            color: var(--text-dark);
        }
        
        .list-description {
            color: var(--text-gray);
            line-height: 1.6;
            margin-bottom: var(--space-4);
            flex: 1;
        }
        
        .list-meta {
            display: flex;
            align-items: center;
            gap: var(--space-6);
            font-size: var(--font-size-sm);
            color: var(--text-muted);
        }
        
        /* ========== PAGINATION ========== */
        .pagination-section {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: var(--space-4);
            padding: var(--space-8);
            background: white;
            border-radius: var(--radius-2xl);
            box-shadow: var(--shadow-lg);
            margin-top: var(--space-8);
        }
        
        .pagination {
            display: flex;
            align-items: center;
            gap: var(--space-2);
        }
        
        .page-btn {
            background: transparent;
            border: 1px solid var(--primary-100);
            border-radius: var(--radius-lg);
            padding: var(--space-2) var(--space-4);
            cursor: pointer;
            transition: all var(--duration-fast) var(--ease-out);
            color: var(--text-gray);
            font-weight: 500;
            min-width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .page-btn:hover {
            background: var(--light-purple);
            border-color: var(--primary);
            color: var(--primary);
        }
        
        .page-btn.active {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
            box-shadow: var(--shadow-primary);
        }
        
        .page-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        
        .page-info {
            font-size: var(--font-size-sm);
            color: var(--text-muted);
            margin: 0 var(--space-4);
        }
        
        /* ========== MOBILE FILTERS ========== */
        .mobile-filter-toggle {
            display: none;
            position: fixed;
            bottom: var(--space-6);
            right: var(--space-6);
            background: var(--gradient-primary);
            color: white;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            font-size: var(--font-size-xl);
            cursor: pointer;
            box-shadow: var(--shadow-primary);
            z-index: 1000;
            transition: all var(--duration-normal) var(--ease-out);
        }
        
        .mobile-filter-toggle:hover {
            transform: scale(1.1);
        }
        
        .mobile-filter-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            z-index: 1001;
        }
        
        .mobile-filter-panel {
            position: fixed;
            top: 0;
            right: 0;
            width: 300px;
            height: 100vh;
            background: white;
            transform: translateX(100%);
            transition: transform var(--duration-slow) var(--ease-out);
            z-index: 1002;
            overflow-y: auto;
            padding: var(--space-6);
        }
        
        .mobile-filter-panel.active {
            transform: translateX(0);
        }
        
        .mobile-filter-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--space-6);
            padding-bottom: var(--space-4);
            border-bottom: 1px solid var(--light-purple);
        }
        
        .mobile-filter-title {
            font-size: var(--font-size-xl);
            font-weight: 700;
            color: var(--text-dark);
        }
        
        .mobile-filter-close {
            background: none;
            border: none;
            font-size: var(--font-size-xl);
            color: var(--text-muted);
            cursor: pointer;
        }
        
        /* ========== RESPONSIVE DESIGN ========== */
        @media (max-width: 1024px) {
            .main-layout {
                grid-template-columns: 250px 1fr;
                gap: var(--space-6);
            }
            
            .books-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 0 var(--space-4);
            }
            
            .main-layout {
                grid-template-columns: 1fr;
                gap: var(--space-6);
            }
            
            .sidebar {
                display: none;
            }
            
            .mobile-filter-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            .search-container {
                flex-direction: column;
                align-items: stretch;
            }
            
            .search-bar {
                min-width: auto;
            }
            
            .search-filters {
                justify-content: space-between;
            }
            
            .books-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: var(--space-4);
            }
            
            .book-list-item {
                flex-direction: column;
            }
            
            .list-cover {
                width: 100%;
                height: 200px;
            }
            
            .pagination {
                flex-wrap: wrap;
                justify-content: center;
            }
        }
        
        @media (max-width: 480px) {
            .books-grid {
                grid-template-columns: 1fr;
            }
            
            .header-title {
                font-size: var(--font-size-3xl);
            }
            
            .search-section {
                padding: var(--space-6) 0;
            }
            
            .main-layout {
                padding: var(--space-6) 0;
            }
        }
        
        /* ========== ANIMATIONS ========== */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in-up {
            animation: fadeInUp 0.6s var(--ease-out) forwards;
        }
        
        .stagger-1 { animation-delay: 0.1s; }
        .stagger-2 { animation-delay: 0.2s; }
        .stagger-3 { animation-delay: 0.3s; }
        .stagger-4 { animation-delay: 0.4s; }
        
        /* ========== LOADING STATES ========== */
        .loading-skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: var(--radius-lg);
        }
        
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        
        .book-skeleton {
            height: 400px;
            margin-bottom: var(--space-6);
        }
        
        /* ========== SCROLL TO TOP ========== */
        .scroll-to-top {
            position: fixed;
            bottom: var(--space-6);
            left: var(--space-6);
            background: var(--gradient-primary);
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: var(--font-size-lg);
            cursor: pointer;
            box-shadow: var(--shadow-primary);
            opacity: 0;
            visibility: hidden;
            transition: all var(--duration-normal) var(--ease-out);
            z-index: 999;
        }
        
        .scroll-to-top.visible {
            opacity: 1;
            visibility: visible;
        }
        
        .scroll-to-top:hover {
            transform: translateY(-3px) scale(1.1);
        }
    </style>
</head>
<body>
    <!-- MODERN HEADER -->
    <section class="books-header">
        <div class="header-bg-effects"></div>
        <div class="container">
            <div class="header-content">
                <div class="header-badge">
                    <i class="fas fa-books"></i>
                    <span>مجموعه کتاب‌ها</span>
                </div>
                <h1 class="header-title">کتاب‌های کتابخانه آنلاین</h1>
                <p class="header-subtitle">گنجینه‌ای از دانش و معرفت در قالب کتاب‌های متنوع و ارزشمند</p>
            </div>
        </div>
    </section>
    
    <!-- ADVANCED SEARCH SECTION -->
    <section class="search-section">
        <div class="container">
            <div class="search-container">
                <div class="search-bar">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="جستجو در عنوان، نویسنده، موضوع...">
                </div>
                
                <div class="search-filters">
                    <div class="filter-dropdown">
                        <button class="filter-btn">
                            <i class="fas fa-filter"></i>
                            <span>دسته‌بندی</span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </div>
                    
                    <div class="filter-dropdown">
                        <button class="filter-btn">
                            <i class="fas fa-user"></i>
                            <span>نویسنده</span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </div>
                    
                    <div class="view-toggle">
                        <button class="view-btn active" data-view="grid">
                            <i class="fas fa-th"></i>
                        </button>
                        <button class="view-btn" data-view="list">
                            <i class="fas fa-list"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- MAIN LAYOUT -->
    <div class="container">
        <div class="main-layout">
            <!-- ADVANCED SIDEBAR FILTERS -->
            <aside class="sidebar">
                <!-- Categories Filter -->
                <div class="filter-section fade-in-up">
                    <h3 class="filter-title">
                        <div class="filter-icon">
                            <i class="fas fa-folder"></i>
                        </div>
                        دسته‌بندی‌ها
                    </h3>
                    <div class="filter-options">
                        <div class="filter-option">
                            <div class="filter-checkbox checked"></div>
                            <span class="filter-text">ادبیات</span>
                            <span class="filter-count">۱۲۳</span>
                        </div>
                        <div class="filter-option">
                            <div class="filter-checkbox"></div>
                            <span class="filter-text">علوم</span>
                            <span class="filter-count">۸۹</span>
                        </div>
                        <div class="filter-option">
                            <div class="filter-checkbox"></div>
                            <span class="filter-text">تاریخ</span>
                            <span class="filter-count">۶۷</span>
                        </div>
                        <div class="filter-option">
                            <div class="filter-checkbox"></div>
                            <span class="filter-text">فلسفه</span>
                            <span class="filter-count">۴۵</span>
                        </div>
                        <div class="filter-option">
                            <div class="filter-checkbox"></div>
                            <span class="filter-text">هنر</span>
                            <span class="filter-count">۳۴</span>
                        </div>
                    </div>
                </div>
                
                <!-- Authors Filter -->
                <div class="filter-section fade-in-up stagger-1">
                    <h3 class="filter-title">
                        <div class="filter-icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        نویسندگان
                    </h3>
                    <div class="filter-options">
                        <div class="filter-option">
                            <div class="filter-checkbox"></div>
                            <span class="filter-text">احمد محمودی</span>
                            <span class="filter-count">۱۵</span>
                        </div>
                        <div class="filter-option">
                            <div class="filter-checkbox"></div>
                            <span class="filter-text">فاطمه کریمی</span>
                            <span class="filter-count">۱۲</span>
                        </div>
                        <div class="filter-option">
                            <div class="filter-checkbox"></div>
                            <span class="filter-text">علی احمدی</span>
                            <span class="filter-count">۸</span>
                        </div>
                    </div>
                </div>
                
                <!-- Publication Year Filter -->
                <div class="filter-section fade-in-up stagger-2">
                    <h3 class="filter-title">
                        <div class="filter-icon">
                            <i class="fas fa-calendar"></i>
                        </div>
                        سال انتشار
                    </h3>
                    <div class="filter-options">
                        <div class="filter-option">
                            <div class="filter-checkbox"></div>
                            <span class="filter-text">۱۴۰۳</span>
                            <span class="filter-count">۲۳</span>
                        </div>
                        <div class="filter-option">
                            <div class="filter-checkbox"></div>
                            <span class="filter-text">۱۴۰۲</span>
                            <span class="filter-count">۴۵</span>
                        </div>
                        <div class="filter-option">
                            <div class="filter-checkbox"></div>
                            <span class="filter-text">۱۴۰۱</span>
                            <span class="filter-count">۳۸</span>
                        </div>
                    </div>
                </div>
                
                <!-- Pages Range Filter -->
                <div class="filter-section fade-in-up stagger-3">
                    <h3 class="filter-title">
                        <div class="filter-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        تعداد صفحات
                    </h3>
                    <div class="price-range">
                        <div class="range-slider">
                            <div class="range-track" style="left: 20%; width: 60%;">
                                <div class="range-thumb" style="left: 0;"></div>
                                <div class="range-thumb" style="right: 0;"></div>
                            </div>
                        </div>
                        <div class="price-labels">
                            <span>۵۰ صفحه</span>
                            <span>۵۰۰ صفحه</span>
                        </div>
                    </div>
                </div>
            </aside>
            
            <!-- CONTENT AREA -->
            <main class="content-area">
                <!-- Content Header -->
                <div class="content-header fade-in-up">
                    <div class="results-info">
                        <div class="results-count">۱,۲۴۷ کتاب</div>
                        <div class="results-total">از مجموع ۱,۲۴۷ کتاب موجود</div>
                    </div>
                    <div class="sort-controls">
                        <span class="sort-label">مرتب‌سازی:</span>
                        <select class="sort-select">
                            <option>جدیدترین</option>
                            <option>قدیمی‌ترین</option>
                            <option>الفبایی (الف تا ی)</option>
                            <option>الفبایی (ی تا الف)</option>
                            <option>بیشترین بازدید</option>
                        </select>
                    </div>
                </div>
                
                <!-- Books Grid View -->
                <div class="books-grid" id="booksGrid">
                    <!-- Sample Book Cards -->
                    <div class="book-card fade-in-up">
                        <div class="book-cover">
                            <div class="no-cover-placeholder">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="book-overlay">
                                <div class="book-actions">
                                    <button class="action-btn">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                    <button class="action-btn">
                                        <i class="fas fa-share"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="book-info">
                            <h3 class="book-title">کتاب نمونه ۱</h3>
                            <p class="book-author">نویسنده نمونه</p>
                            <div class="book-meta">
                                <span>۱۴۰۲</span>
                                <span>۲۵۰ صفحه</span>
                            </div>
                            <div class="book-categories">
                                <span class="category-tag">ادبیات</span>
                                <span class="category-tag">رمان</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="book-card fade-in-up stagger-1">
                        <div class="book-cover">
                            <div class="no-cover-placeholder">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="book-overlay">
                                <div class="book-actions">
                                    <button class="action-btn">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                    <button class="action-btn">
                                        <i class="fas fa-share"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="book-info">
                            <h3 class="book-title">کتاب نمونه ۲</h3>
                            <p class="book-author">نویسنده نمونه</p>
                            <div class="book-meta">
                                <span>۱۴۰۱</span>
                                <span>۳۲۰ صفحه</span>
                            </div>
                            <div class="book-categories">
                                <span class="category-tag">علوم</span>
                                <span class="category-tag">فیزیک</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="book-card fade-in-up stagger-2">
                        <div class="book-cover">
                            <div class="no-cover-placeholder">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="book-overlay">
                                <div class="book-actions">
                                    <button class="action-btn">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                    <button class="action-btn">
                                        <i class="fas fa-share"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="book-info">
                            <h3 class="book-title">کتاب نمونه ۳</h3>
                            <p class="book-author">نویسنده نمونه</p>
                            <div class="book-meta">
                                <span>۱۴۰۳</span>
                                <span>۱۸۰ صفحه</span>
                            </div>
                            <div class="book-categories">
                                <span class="category-tag">تاریخ</span>
                                <span class="category-tag">ایران</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="book-card fade-in-up stagger-3">
                        <div class="book-cover">
                            <div class="no-cover-placeholder">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="book-overlay">
                                <div class="book-actions">
                                    <button class="action-btn">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                    <button class="action-btn">
                                        <i class="fas fa-share"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="book-info">
                            <h3 class="book-title">کتاب نمونه ۴</h3>
                            <p class="book-author">نویسنده نمونه</p>
                            <div class="book-meta">
                                <span>۱۴۰۰</span>
                                <span>۴۲۰ صفحه</span>
                            </div>
                            <div class="book-categories">
                                <span class="category-tag">فلسفه</span>
                                <span class="category-tag">اخلاق</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="book-card fade-in-up stagger-4">
                        <div class="book-cover">
                            <div class="no-cover-placeholder">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="book-overlay">
                                <div class="book-actions">
                                    <button class="action-btn">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                    <button class="action-btn">
                                        <i class="fas fa-share"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="book-info">
                            <h3 class="book-title">کتاب نمونه ۵</h3>
                            <p class="book-author">نویسنده نمونه</p>
                            <div class="book-meta">
                                <span>۱۳۹۹</span>
                                <span>۲۸۰ صفحه</span>
                            </div>
                            <div class="book-categories">
                                <span class="category-tag">هنر</span>
                                <span class="category-tag">موسیقی</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="book-card fade-in-up stagger-1">
                        <div class="book-cover">
                            <div class="no-cover-placeholder">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="book-overlay">
                                <div class="book-actions">
                                    <button class="action-btn">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                    <button class="action-btn">
                                        <i class="fas fa-share"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="book-info">
                            <h3 class="book-title">کتاب نمونه ۶</h3>
                            <p class="book-author">نویسنده نمونه</p>
                            <div class="book-meta">
                                <span>۱۴۰۲</span>
                                <span>۱۵۰ صفحه</span>
                            </div>
                            <div class="book-categories">
                                <span class="category-tag">ادبیات</span>
                                <span class="category-tag">شعر</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Books List View -->
                <div class="books-list" id="booksList">
                    <div class="book-list-item">
                        <div class="list-cover">
                            <div class="no-cover-placeholder">
                                <i class="fas fa-book"></i>
                            </div>
                        </div>
                        <div class="list-info">
                            <h3 class="list-title">کتاب نمونه در نمایش لیستی</h3>
                            <p class="list-description">توضیحی کوتاه درباره محتوای کتاب و موضوعاتی که در آن مطرح شده است. این متن می‌تواند خلاصه‌ای از کتاب باشد.</p>
                            <div class="list-meta">
                                <span><i class="fas fa-user"></i> نویسنده نمونه</span>
                                <span><i class="fas fa-calendar"></i> ۱۴۰۲</span>
                                <span><i class="fas fa-file-alt"></i> ۲۵۰ صفحه</span>
                                <span><i class="fas fa-building"></i> انتشارات نمونه</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Pagination -->
                <div class="pagination-section">
                    <div class="pagination">
                        <button class="page-btn" disabled>
                            <i class="fas fa-chevron-right"></i>
                        </button>
                        <button class="page-btn active">۱</button>
                        <button class="page-btn">۲</button>
                        <button class="page-btn">۳</button>
                        <button class="page-btn">۴</button>
                        <button class="page-btn">۵</button>
                        <span class="page-info">...</span>
                        <button class="page-btn">۲۵</button>
                        <button class="page-btn">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                    </div>
                    <div class="page-info">
                        صفحه ۱ از ۲۵ (۱,۲۴۷ کتاب)
                    </div>
                </div>
            </main>
        </div>
    </div>
    
    <!-- MOBILE FILTER TOGGLE -->
    <button class="mobile-filter-toggle">
        <i class="fas fa-filter"></i>
    </button>
    
    <!-- MOBILE FILTER OVERLAY -->
    <div class="mobile-filter-overlay"></div>
    
    <!-- MOBILE FILTER PANEL -->
    <div class="mobile-filter-panel">
        <div class="mobile-filter-header">
            <h3 class="mobile-filter-title">فیلترها</h3>
            <button class="mobile-filter-close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <!-- Mobile filters content (same as sidebar) -->
        <div class="filter-section">
            <h3 class="filter-title">
                <div class="filter-icon">
                    <i class="fas fa-folder"></i>
                </div>
                دسته‌بندی‌ها
            </h3>
            <div class="filter-options">
                <div class="filter-option">
                    <div class="filter-checkbox checked"></div>
                    <span class="filter-text">ادبیات</span>
                    <span class="filter-count">۱۲۳</span>
                </div>
                <div class="filter-option">
                    <div class="filter-checkbox"></div>
                    <span class="filter-text">علوم</span>
                    <span class="filter-count">۸۹</span>
                </div>
                <div class="filter-option">
                    <div class="filter-checkbox"></div>
                    <span class="filter-text">تاریخ</span>
                    <span class="filter-count">۶۷</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- SCROLL TO TOP BUTTON -->
    <button class="scroll-to-top">
        <i class="fas fa-chevron-up"></i>
    </button>
    
    <script>
        // View Toggle Functionality
        const viewButtons = document.querySelectorAll('.view-btn');
        const booksGrid = document.getElementById('booksGrid');
        const booksList = document.getElementById('booksList');
        
        viewButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                viewButtons.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                const view = this.dataset.view;
                if (view === 'grid') {
                    booksGrid.style.display = 'grid';
                    booksList.classList.remove('active');
                } else {
                    booksGrid.style.display = 'none';
                    booksList.classList.add('active');
                }
            });
        });
        
        // Filter Checkbox Functionality
        const filterCheckboxes = document.querySelectorAll('.filter-checkbox');
        filterCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('click', function() {
                this.classList.toggle('checked');
                
                // Here you would typically trigger a filter update
                console.log('Filter changed:', this.nextElementSibling.textContent);
            });
        });
        
        // Mobile Filter Functionality
        const mobileFilterToggle = document.querySelector('.mobile-filter-toggle');
        const mobileFilterOverlay = document.querySelector('.mobile-filter-overlay');
        const mobileFilterPanel = document.querySelector('.mobile-filter-panel');
        const mobileFilterClose = document.querySelector('.mobile-filter-close');
        
        function openMobileFilter() {
            mobileFilterOverlay.style.display = 'block';
            mobileFilterPanel.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        
        function closeMobileFilter() {
            mobileFilterOverlay.style.display = 'none';
            mobileFilterPanel.classList.remove('active');
            document.body.style.overflow = '';
        }
        
        mobileFilterToggle.addEventListener('click', openMobileFilter);
        mobileFilterClose.addEventListener('click', closeMobileFilter);
        mobileFilterOverlay.addEventListener('click', closeMobileFilter);
        
        // Search Functionality
        const searchInput = document.querySelector('.search-input');
        let searchTimeout;
        
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                const query = this.value.trim();
                if (query.length >= 2) {
                    console.log('Searching for:', query);
                    // Here you would implement the actual search
                }
            }, 500);
        });
        
        // Pagination
        const pageButtons = document.querySelectorAll('.page-btn');
        pageButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                if (!this.disabled && !this.classList.contains('active')) {
                    pageButtons.forEach(b => b.classList.remove('active'));
                    if (!this.querySelector('i')) { // Not an arrow button
                        this.classList.add('active');
                    }
                    console.log('Page changed to:', this.textContent);
                }
            });
        });
        
        // Scroll to Top
        const scrollToTopBtn = document.querySelector('.scroll-to-top');
        
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                scrollToTopBtn.classList.add('visible');
            } else {
                scrollToTopBtn.classList.remove('visible');
            }
        });
        
        scrollToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
        // Sort functionality
        const sortSelect = document.querySelector('.sort-select');
        sortSelect.addEventListener('change', function() {
            console.log('Sort changed to:', this.value);
            // Here you would implement the actual sorting
        });
        
        // Book card interactions
        document.querySelectorAll('.book-card, .book-list-item').forEach(card => {
            card.addEventListener('click', function(e) {
                if (!e.target.closest('.action-btn')) {
                    console.log('Book clicked:', this.querySelector('.book-title, .list-title').textContent);
                    // Navigate to book detail page
                }
            });
        });
        
        // Action button handlers
        document.querySelectorAll('.action-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const icon = this.querySelector('i');
                
                if (icon.classList.contains('fa-heart')) {
                    // Toggle favorite
                    if (icon.classList.contains('fas')) {
                        icon.classList.remove('fas');
                        icon.classList.add('far');
                        this.style.color = '#666';
                    } else {
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                        this.style.color = '#ff6b8b';
                    }
                } else if (icon.classList.contains('fa-share')) {
                    // Share functionality
                    if (navigator.share) {
                        navigator.share({
                            title: 'کتاب از کتابخانه سلمان',
                            text: 'این کتاب را در کتابخانه آنلاین مطالعه کنید',
                            url: window.location.href
                        });
                    } else {
                        // Fallback
                        console.log('Share functionality');
                    }
                }
            });
        });
        
        // Range slider functionality (simplified)
        const rangeSlider = document.querySelector('.range-slider');
        if (rangeSlider) {
            rangeSlider.addEventListener('click', function(e) {
                const rect = this.getBoundingClientRect();
                const offsetX = e.clientX - rect.left;
                const percentage = (offsetX / rect.width) * 100;
                console.log('Slider clicked at:', percentage);
            });
        }  
    </script>
</body>
        