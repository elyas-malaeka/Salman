 <!-- Custom Styles for Registration Terms Page 
<style>
        /* 
    * Staff Page Styles
    * Salman Educational Complex
    * Version 2.0
    */

    /* Base Styles */
    :root {
        --primary-color: #6941C6;
        --secondary-color: #4E36B1;
        --accent-color: #7F56D9;
        --management-color: #2c3e50;
        --teaching-color: #3498db;
        --support-color: #7f8c8d;
        --text-color: #333;
        --text-light: #666;
        --bg-light: #f9f9f9;
        --white: #ffffff;
        --border-radius: 15px;
        --card-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        --card-hover-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
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

    /* Staff Header Section Styles */
    .staff-header {
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

    .staff-header::after {
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

    .staff-header__content {
        position: relative;
        z-index: 2;
    }

    .staff-header__title {
        font-family: 'Vazir', sans-serif !important;
        font-size: 38px;
        font-weight: 800;
        margin-bottom: 15px;
        color: white;
        animation: slideDown 1s ease-out, floatEffect 4s ease-in-out infinite;
    }

    .staff-header__subtitle {
        font-family: 'Vazir', sans-serif;
        font-size: 18px;
        max-width: 700px;
        margin: 0 auto 40px;
        opacity: 0.9;
        color: white;
        animation: slideDown 1s ease-out 0.3s both, floatEffect 5s ease-in-out infinite;
    }

    /* Filter and Search Section */
    .staff-filter-section {
        padding: 30px 0;
        background-color: var(--white);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        position: relative;
        z-index: 2;
    }

    .staff-filter-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .staff-search {
        position: relative;
        flex-grow: 1;
        max-width: 400px;
    }

    .staff-search-input {
        width: 100%;
        height: 50px;
        padding: 0 50px 0 20px;
        border-radius: 25px;
        border: 1px solid rgba(0, 0, 0, 0.1);
        background-color: #f8f9fa;
        color: var(--text-color);
        font-size: 15px;
        transition: var(--transition);
    }

    .staff-search-input:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(105, 65, 198, 0.15);
        border-color: var(--primary-color);
    }

    .staff-search-btn {
        position: absolute;
        right: 5px;
        top: 5px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: var(--white);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition);
    }

    .staff-search-btn:hover {
        transform: scale(1.05);
    }

    [dir="rtl"] .staff-search-input {
        padding: 0 20px 0 50px;
    }

    [dir="rtl"] .staff-search-btn {
        right: auto;
        left: 5px;
    }

    .staff-category-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .staff-filter-btn {
        padding: 10px 20px;
        border-radius: 25px;
        background-color: #f0f0f0;
        color: var(--text-color);
        border: none;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
    }

    .staff-filter-btn:hover {
        background-color: #e6e6e6;
    }

    .staff-filter-btn.active {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: var(--white);
    }

    /* Staff Cards Section */
    .staff-cards-section {
        padding: 60px 0;
        background-color: var(--bg-light);
    }

    .staff-card-container {
        padding: 15px;
        margin-bottom: 15px;
        transition: var(--transition);
    }

    .staff-card-container.hidden {
        display: none;
    }

    .staff-card {
        position: relative;
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--card-shadow);
        transition: var(--transition);
        height: 360px;
        background-color: var(--white);
    }

    .staff-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--card-hover-shadow);
    }

    .staff-image {
        width: 100%;
        height: 100%;
        position: relative;
    }

    .staff-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center 15%;
        transition: var(--transition);
    }

    .staff-card:hover .staff-image img {
        transform: scale(1.05);
    }

    .staff-info {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(255, 255, 255, 0.95);
        padding: 20px;
        border-radius: 16px 16px 0 0;
        box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: var(--transition);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .staff-card:hover .staff-info {
        padding-bottom: 25px;
    }

    .staff-name {
        margin: 0 0 5px;
        font-size: 18px;
        font-weight: 600;
        color: var(--text-color);
    }

    .staff-position {
        margin: 0 0 5px;
        font-size: 15px;
        color: var(--text-light);
        font-weight: 400;
    }

    .staff-education {
        margin: 8px 0 0;
        font-size: 13px;
        color: #777;
        padding-top: 8px;
        border-top: 1px solid #eee;
        line-height: 1.4;
        max-height: 0;
        overflow: hidden;
        transition: all 0.3s ease;
        opacity: 0;
    }

    .staff-card:hover .staff-education {
        max-height: 60px;
        opacity: 1;
    }

    /* Staff Social Links */
    .staff-social {
        position: absolute;
        top: 20px;
        right: 20px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        opacity: 0;
        transform: translateX(20px);
        transition: var(--transition);
    }

    [dir="rtl"] .staff-social {
        right: auto;
        left: 20px;
        transform: translateX(-20px);
    }

    .staff-card:hover .staff-social {
        opacity: 1;
        transform: translateX(0);
    }

    .staff-social-link {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.9);
        color: var(--primary-color);
        text-decoration: none;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        transition: var(--transition);
    }

    .staff-social-link:hover {
        background-color: var(--primary-color);
        color: var(--white);
        transform: translateY(-3px);
    }

    /* Category indicators - subtle color accents */
    .staff-card.management .staff-info {
        border-top: 3px solid var(--management-color);
    }

    .staff-card.teaching .staff-info {
        border-top: 3px solid var(--teaching-color);
    }

    .staff-card.support .staff-info {
        border-top: 3px solid var(--support-color);
    }

    /* No Results Message */
    .no-results-container {
        padding: 50px 0;
        text-align: center;
    }

    .no-results {
        max-width: 500px;
        margin: 0 auto;
        padding: 40px;
        background-color: var(--white);
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
    }

    .no-results-icon {
        font-size: 50px;
        color: #d1d5db;
        margin-bottom: 20px;
    }

    .no-results h3 {
        font-size: 22px;
        color: var(--text-color);
        margin-bottom: 10px;
    }

    .no-results p {
        color: var(--text-light);
        margin-bottom: 20px;
    }

    .reset-btn {
        padding: 10px 25px;
        border-radius: 25px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: var(--white);
        border: none;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .reset-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(105, 65, 198, 0.2);
    }

    /* Staff Overview Section */
    .staff-overview-section {
        padding: 60px 0;
        background-color: var(--white);
    }

    .staff-stat-card {
        display: flex;
        align-items: flex-start;
        padding: 30px;
        border-radius: var(--border-radius);
        background-color: var(--white);
        box-shadow: var(--card-shadow);
        transition: var(--transition);
        margin-bottom: 30px;
        height: 100%;
    }

    .staff-stat-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--card-hover-shadow);
    }

    .staff-stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
        font-size: 24px;
        flex-shrink: 0;
        position: relative;
        z-index: 1;
    }

    [dir="rtl"] .staff-stat-icon {
        margin-right: 0;
        margin-left: 20px;
    }

    .staff-stat-icon::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        z-index: -1;
        opacity: 0.2;
    }

    .management-icon {
        color: var(--management-color);
    }

    .management-icon::before {
        background-color: var(--management-color);
    }

    .teaching-icon {
        color: var(--teaching-color);
    }

    .teaching-icon::before {
        background-color: var(--teaching-color);
    }

    .support-icon {
        color: var(--support-color);
    }

    .support-icon::before {
        background-color: var(--support-color);
    }

    .staff-stat-info {
        flex: 1;
    }

    .staff-stat-title {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-color);
        margin-bottom: 10px;
    }

    .staff-stat-desc {
        color: var(--text-light);
        margin: 0;
        line-height: 1.6;
    }

    /* Join Team Section */
    .join-team-section {
        padding: 80px 0;
        background-color: var(--bg-light);
        position: relative;
        overflow: hidden;
    }

    .join-team-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%236941C6' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        opacity: 0.5;
    }

    .join-team-content {
        padding-right: 40px;
    }

    [dir="rtl"] .join-team-content {
        padding-right: 0;
        padding-left: 40px;
    }

    .join-team-title {
        font-size: 32px;
        font-weight: 700;
        color: var(--text-color);
        margin-bottom: 15px;
        position: relative;
        padding-bottom: 15px;
    }

    .join-team-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 3px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    }

    [dir="rtl"] .join-team-title::after {
        left: auto;
        right: 0;
    }

    .join-team-subtitle {
        font-size: 18px;
        color: var(--primary-color);
        margin-bottom: 20px;
    }

    .join-team-text {
        color: var(--text-light);
        margin-bottom: 30px;
        line-height: 1.8;
    }

    .join-team-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 15px 30px;
        border-radius: 30px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: var(--white);
        text-decoration: none;
        font-weight: 500;
        transition: var(--transition);
    }

    .join-team-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(105, 65, 198, 0.2);
        color: var(--white);
    }

    .join-team-image {
        text-align: center;
    }

    .join-team-image img {
        max-width: 100%;
        height: auto;
        animation: floatEffect 5s ease-in-out infinite;
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideDown {
        from { 
            opacity: 0;
            transform: translateY(-20px);
        }
        to { 
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes floatEffect {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }

    /* RTL Support */
    [dir="rtl"] {
        font-family: 'Vazirmatn', 'Vazir', sans-serif;
    }

    /* Responsive adjustments */
    @media (max-width: 991px) {
        .staff-header {
            padding: 150px 0 120px;
        }
        
        .staff-header__title {
            font-size: 32px;
        }
        
        .staff-filter-container {
            flex-direction: column;
            align-items: stretch;
        }
        
        .staff-search {
            max-width: 100%;
        }
        
        .staff-card {
            height: 340px;
        }
        
        .join-team-content {
            padding-right: 0;
            margin-bottom: 40px;
        }
        
        [dir="rtl"] .join-team-content {
            padding-left: 0;
        }
    }

    @media (max-width: 767px) {
        .staff-header {
            padding: 120px 0 100px;
        }
        
        .staff-header__title {
            font-size: 28px;
        }
        
        .staff-filter-btn {
            padding: 8px 15px;
            font-size: 13px;
        }
        
        .staff-card {
            height: 380px;
        }
        
        .staff-card-container {
            padding: 10px;
        }
        
        .join-team-section {
            padding: 60px 0;
        }
        
        .join-team-title {
            font-size: 28px;
        }
    }

    @media (max-width: 576px) {
        .staff-card {
            height: 330px;
        }
        
        .staff-stat-card {
            padding: 20px;
        }
        
        .staff-stat-icon {
            width: 50px;
            height: 50px;
            font-size: 20px;
        }
    }
</style>
-->
<style>
        /* Modern Staff Page Styles */
        :root {
            --primary-color: #1976D2;
            --secondary-color: #0D47A1;
            --accent-color: #2196F3;
            --light-color: #E3F2FD;
            --dark-color: #333;
            --white-color: #fff;
            --gray-bg: #f8f9fa;
            --card-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            --hover-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            --transition-time: 0.3s;
            --radius-lg: 12px;
            --radius-sm: 8px;
            --glass-bg: rgba(255, 255, 255, 0.8);
            --glass-hover-bg: rgba(25, 118, 210, 0.85);
        }

        /* Enhanced Cosmic header theme */
        .staff-header {
            background: linear-gradient(135deg, #04112c, #1a377a);
            padding: 180px 0 80px; /* Extra padding for menu */
            position: relative;
            overflow: hidden;
            margin-bottom: 60px;
        }

        .cosmic-bg {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            overflow: hidden;
            z-index: 1;
            background: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgogIDxkZWZzPgogICAgPHJhZGlhbEdyYWRpZW50IGlkPSJncmFkIiBjeD0iNTAlIiBjeT0iNTAlIiByPSI1MCUiPgogICAgICA8c3RvcCBvZmZzZXQ9IjAlIiBzdG9wLWNvbG9yPSIjMDQxMTJjIiBzdG9wLW9wYWNpdHk9IjAuMSIvPgogICAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiMwNDExMmMiIHN0b3Atb3BhY2l0eT0iMC43Ii8+CiAgICA8L3JhZGlhbEdyYWRpZW50PgogIDwvZGVmcz4KICA8cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSJ1cmwoI2dyYWQpIi8+Cjwvc3ZnPg==');
        }

        .cosmic-planet {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.1));
            box-shadow: 0 0 40px rgba(255, 255, 255, 0.3);
            animation: orbit 60s infinite linear;
        }

        .cosmic-planet:nth-child(1) {
            width: 300px;
            height: 300px;
            top: -80px;
            right: -80px;
            opacity: 0.6;
            animation-duration: 120s;
        }

        .cosmic-planet:nth-child(2) {
            width: 200px;
            height: 200px;
            bottom: -50px;
            left: -50px;
            opacity: 0.4;
            animation-duration: 90s;
            animation-direction: reverse;
        }

        .cosmic-planet:nth-child(3) {
            width: 150px;
            height: 150px;
            top: 40%;
            right: 20%;
            opacity: 0.3;
            animation-duration: 70s;
        }

        @keyframes orbit {
            from { transform: rotate(0deg) translateX(50px) rotate(0deg); }
            to { transform: rotate(360deg) translateX(50px) rotate(-360deg); }
        }

        .shooting-star {
            position: absolute;
            width: 120px;
            height: 1px;
            background: linear-gradient(90deg, rgba(255,255,255,0), rgba(255,255,255,1));
            animation: shooting 4s infinite linear;
            opacity: 0;
            transform: rotate(-45deg);
        }

        .shooting-star::before {
            content: '';
            position: absolute;
            width: 15px;
            height: 1px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            right: 0;
            box-shadow: 0 0 10px 4px rgba(255, 255, 255, 0.6);
        }

        @keyframes shooting {
            0% { transform: translateX(-100px) translateY(-100px) rotate(-45deg); opacity: 0; }
            5% { opacity: 1; }
            20% { transform: translateX(400px) translateY(400px) rotate(-45deg); opacity: 0; }
            100% { transform: translateX(400px) translateY(400px) rotate(-45deg); opacity: 0; }
        }

        .staff-header__content {
            position: relative;
            z-index: 5;
            color: var(--white-color);
            text-align: center;
        }

        .staff-header__title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 20px;
            text-shadow: 0 2px 20px rgba(0, 0, 0, 0.3);
            display: inline-block;
            background: linear-gradient(to right, #fff, #E3F2FD);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .staff-header__subtitle {
            font-size: 1.2rem;
            font-weight: 300;
            max-width: 800px;
            margin: 0 auto;
            opacity: 0.9;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
        }

        /* Filter section */
        .staff-filter-section {
            margin-bottom: 50px;
        }

        .staff-filter-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            padding: 20px 25px;
            background-color: var(--light-color);
            border-radius: var(--radius-lg);
            box-shadow: var(--card-shadow);
        }

        .staff-search {
            position: relative;
            flex: 1;
            max-width: 400px;
            margin-right: 20px;
        }

        .staff-search-input {
            width: 100%;
            padding: 12px 20px;
            padding-right: 50px;
            border: 1px solid #ddd;
            border-radius: 50px;
            font-size: 1rem;
            transition: all var(--transition-time);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.03);
        }

        .staff-search-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(25, 118, 210, 0.2);
        }

        .staff-search-btn {
            position: absolute;
            right: 5px;
            top: 5px;
            height: calc(100% - 10px);
            width: 42px;
            border: none;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            cursor: pointer;
            transition: all var(--transition-time);
        }

        .staff-search-btn:hover {
            background: var(--secondary-color);
        }

        .staff-category-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .staff-filter-btn {
            padding: 10px 20px;
            border: none;
            background: white;
            color: var(--dark-color);
            border-radius: 50px;
            cursor: pointer;
            transition: all var(--transition-time);
            font-weight: 500;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .staff-filter-btn:hover {
            background: var(--accent-color);
            color: white;
            transform: translateY(-2px);
        }

        .staff-filter-btn.active {
            background: var(--primary-color);
            color: white;
        }

        /* Ultra Modern card design with floating glass info */
        .staff-cards-section {
            margin-bottom: 70px;
        }

        .staff-card-container {
            margin-bottom: 30px;
        }

        .staff-card {
            position: relative;
            overflow: hidden;
            border-radius: var(--radius-lg);
            box-shadow: var(--card-shadow);
            transition: all var(--transition-time);
            height: 100%;
            background-color: var(--white-color);
        }

        .staff-card:hover {
            transform: translateY(-7px);
            box-shadow: var(--hover-shadow);
        }

        .staff-image-wrapper {
            position: relative;
            overflow: hidden;
            height: 250px; /* Smaller card height */
        }

        .staff-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .staff-card:hover .staff-image {
            transform: scale(1.05);
        }

        /* The floating glass info box */
        .staff-info {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px; 
            background: var(--glass-bg);
            backdrop-filter: blur(5px);
            border-radius: var(--radius-sm);
            padding: 12px; /* Smaller padding */
            transition: all var(--transition-time);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .staff-card:hover .staff-info {
            background: var(--glass-hover-bg);
            color: white;
        }

        .staff-name {
            font-size: 1rem; /* Smaller font */
            margin-bottom: 3px;
            font-weight: 600;
            color: var(--dark-color);
            transition: all var(--transition-time);
        }

        .staff-position {
            font-size: 0.8rem; /* Smaller font */
            margin-bottom: 0;
            opacity: 0.9;
            transition: all var(--transition-time);
            color: #555;
        }

        /* Education only visible on hover */
        .staff-education {
            font-size: 0.75rem;
            opacity: 0;
            height: 0;
            overflow: hidden;
            transition: all var(--transition-time);
            color: #666;
            margin-top: 0;
        }

        .staff-card:hover .staff-education {
            opacity: 0.9;
            height: auto;
            margin-top: 5px;
        }

        .staff-card:hover .staff-name,
        .staff-card:hover .staff-position,
        .staff-card:hover .staff-education {
            color: white;
        }

        /* Category indicators - subtle bottom border */
        .staff-card.management {
            border-bottom: 3px solid var(--primary-color);
        }
        
        .staff-card.teaching {
            border-bottom: 3px solid #4CAF50;
        }
        
        .staff-card.support {
            border-bottom: 3px solid #FF9800;
        }

        /* No Results Message */
        .no-results-container {
            padding: 50px 0;
            text-align: center;
        }

        .no-results {
            padding: 30px;
            background: #f8f9fa;
            border-radius: 10px;
            max-width: 500px;
            margin: 0 auto;
            box-shadow: var(--card-shadow);
        }

        .no-results-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .reset-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all var(--transition-time);
        }

        .reset-btn:hover {
            background: var(--secondary-color);
        }

        /* RTL specific styles */
        html[dir="rtl"] .staff-search {
            margin-right: 0;
            margin-left: 20px;
        }

        html[dir="rtl"] .staff-search-btn {
            right: auto;
            left: 5px;
        }

        /* Responsive adjustments */
        @media (max-width: 1199px) {
            .staff-header__title {
                font-size: 3rem;
            }
        }

        @media (max-width: 991px) {
            .staff-filter-container {
                flex-direction: column;
                align-items: stretch;
                gap: 20px;
            }

            .staff-search {
                max-width: 100%;
                margin-right: 0;
                margin-left: 0;
            }

            .staff-header__title {
                font-size: 2.5rem;
            }
            
            .staff-category-filters {
                justify-content: center;
            }
        }

        @media (max-width: 767px) {
            .staff-header {
                padding: 160px 0 70px;
            }
            
            .staff-header__title {
                font-size: 2.2rem;
            }
        }

        @media (max-width: 575px) {
            .staff-header {
                padding: 140px 0 60px;
            }
            
            .staff-header__title {
                font-size: 1.8rem;
            }
            
            .staff-filter-btn {
                font-size: 0.9rem;
                padding: 8px 16px;
            }

            .staff-image-wrapper {
                height: 220px;
            }
        }

        /* Star animation for cosmic background */
        .cosmic-star {
            position: absolute;
            width: 2px;
            height: 2px;
            background: white;
            border-radius: 50%;
            box-shadow: 0 0 4px 1px rgba(255, 255, 255, 0.7);
            animation: twinkle 3s infinite;
        }

        @keyframes twinkle {
            0%, 100% { opacity: 0.2; }
            50% { opacity: 1; }
        }
    </style>