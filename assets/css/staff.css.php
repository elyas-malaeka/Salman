<style>
        :root {
            --primary-color: #1E40AF;
            --secondary-color: #6366F1;
            --accent-color: #4F46E5;
            --dark-color: #1E293B;
            --light-color: #F8FAFC;
            --white-color: #FFFFFF;
            --card-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            --hover-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            --cosmic-bg: linear-gradient(135deg,rgb(62, 35, 90) 0%, #1E293B 60%, #334155 100%);
            --cosmic-particle: #8B5CF6;
            --cosmic-star: #F8FAFC;
            --cosmic-accent: #A78BFA;
            --management-color: #2563EB;
            --teaching-color: #8B5CF6;
            --support-color: #10B981;
            --special-color: #F59E0B;
            --glass-bg: rgba(255, 255, 255, 0.9);
            --glass-hover-bg: rgba(30, 64, 175, 0.95);
            --transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            --border-radius: 16px;
            --gray-bg: #f8f9fa;
            --transition-time: 0.3s;
            --radius-lg: 12px;
            --radius-sm: 8px;
            --sky-gradient: linear-gradient(135deg, #87CEFA 0%, #6C9EFF 100%);
            --purple-gradient: linear-gradient(135deg, #9471FF 0%, #6C63FF 100%);
             --soft-gradient: linear-gradient(135deg, #E0E0FF 0%, #F5F3FF 100%);
        }

        /* Hero Header */
        .staff-header {
            background: var(--cosmic-bg);
            position: relative;
            overflow: hidden;
            color: var(--light-color);
            text-align: center;
            padding: 200px 0 80px;
            margin-top: 0;
            direction: <?php echo $isRtl ? 'rtl' : 'ltr'; ?>;
        }

        .staff-header:before {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 150px;
    
            z-index: 1;
        }
        .staff-header {
    padding: 180px 0 150px; /* افزایش پدینگ پایین */
    margin-bottom: 0;
    position: relative;
}

.staff-header:before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100px;
    background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.4));
    z-index: 1;
}


    /* =============== COSMIC HERO SECTION =============== */
        .cosmic-header {
            background: var(--cosmic-bg);
            position: relative;
            overflow: hidden;
            color: var(--light-color);
            text-align: center;
            padding: 200px 0 180px;
            margin-top: 0;
            direction: <?php echo $isRtl ? 'rtl' : 'ltr'; ?>;
        }
            
        .cosmic-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            opacity: 0.8;
        }

        .galaxy-effect {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(126, 90, 247, 0.3) 0%, rgba(63, 55, 201, 0.1) 35%, rgba(9, 9, 45, 0) 70%);
            opacity: 0.6;
            animation: pulse 8s infinite alternate;
        }

        @keyframes pulse {
            0% { transform: translate(-50%, -50%) scale(1); opacity: 0.5; }
            100% { transform: translate(-50%, -50%) scale(1.2); opacity: 0.7; }
        }
            
        .cosmic-star {
            position: absolute;
            background-color: #fff;
            border-radius: 50%;
            animation: twinkle 3s infinite alternate;
        }
            
        @keyframes twinkle {
            0% { opacity: 0.2; transform: scale(1); }
            50% { opacity: 0.7; transform: scale(1.1); }
            100% { opacity: 1; transform: scale(1); }
        }

        .shooting-star {
            position: absolute;
            width: 2px;
            height: 80px;
            background: linear-gradient(to bottom, rgba(255,255,255,0), rgba(255,255,255,0.8), rgba(255,255,255,0));
            transform: rotate(45deg);
            animation: shooting 5s linear infinite;
            opacity: 0;
        }
            
        @keyframes shooting {
            0% { 
                transform: rotate(45deg) translateX(0);
                opacity: 0;
            }
            15% {
                opacity: 1;
            }
            30% { 
                transform: rotate(45deg) translateX(400px);
                opacity: 0;
            }
            100% {
                opacity: 0;
            }
        }
            
        .cosmic-bg::before, 
        .cosmic-bg::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle, rgba(255,255,255,0.9) 1px, transparent 1px),
                radial-gradient(circle, rgba(255,255,255,0.7) 1px, transparent 1px),
                radial-gradient(circle, rgba(255,255,255,0.5) 1px, transparent 1px);
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
            
        .cosmic-planet {
            position: absolute;
            border-radius: 50%;
            opacity: 0.4;
            filter: blur(25px);
            box-shadow: 0 0 60px rgba(126, 90, 247, 0.7);
            animation: float 15s infinite alternate;
        }
            
        .cosmic-planet:nth-child(1) {
            top: -80px;
            left: -100px;
            width: 260px;
            height: 260px;
            background: radial-gradient(circle, #9E77ED, #6941C6);
            animation-delay: 0s;
        }
            
        .cosmic-planet:nth-child(2) {
            bottom: -100px;
            right: -120px;
            width: 320px;
            height: 320px;
            background: radial-gradient(circle, #7F56D9, #4E36B1);
            animation-delay: 5s;
        }

        .cosmic-planet:nth-child(3) {
            top: 70%;
            left: 10%;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, #A779F7, #6741D9);
            animation-delay: 2s;
        }
            
        .cosmic-header::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 150px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23f5f7fa' fill-opacity='1' d='M0,160L48,170.7C96,181,192,203,288,213.3C384,224,480,224,576,213.3C672,203,768,181,864,186.7C960,192,1056,224,1152,240C1248,256,1344,256,1392,256L1440,256L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
            background-size: cover;
            background-position: center bottom;
            z-index: 1;
        }
            
        .cosmic-header__content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            margin: 0 auto;
        }
            
        .cosmic-header__title {
            font-family: 'vazir', sans-serif;
            font-size: 48px;
            font-weight: 800;
            margin-bottom: 20px;
            color: white;
            letter-spacing: -0.5px;
            text-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 1s ease-out forwards;
        }
            
        .cosmic-header__subtitle {
            font-size: 20px;
            max-width: 700px;
            margin: 0 auto 40px;
            opacity: 0;
            color: #E2E8F0;
            line-height: 1.7;
            animation: fadeInUp 1s ease-out 0.2s forwards;
        }

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

        /* Advanced wave effect */
        .wave-container {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            z-index: 1;
        }

        .wave-container svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 130px;
        }

        .wave-container .shape-fill {
            fill: #F8FAFC;
        }


        .shooting-star {
            position: absolute;
            width: 150px;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--cosmic-star));
            animation: shooting 6s infinite linear;
            opacity: 0;
        }

        .shooting-star::before {
            content: '';
            position: absolute;
            right: 0;
            width: 10px;
            height: 1px;
            border-radius: 50%;
            background: var(--cosmic-star);
            box-shadow: 0 0 15px 5px rgba(255, 255, 255, 0.7);
        }

        @keyframes shooting {
            0% { transform: translateX(-100px) translateY(300px) rotate(-45deg); opacity: 1; }
            15% { opacity: 1; }
            20% { transform: translateX(300px) translateY(-100px) rotate(-45deg); opacity: 0; }
            100% { opacity: 0; }
        }

        .staff-header__content {
            position: relative;
            z-index: 5;
            max-width: 800px;
            margin: 0 auto;
            animation: fadeIn 1.5s ease-out;
        }

        .staff-header__title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            background:  var(--soft-gradient);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 1s ease-out;
        }

        .staff-header__subtitle {
            font-size: 1.4rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
            color: rgba(255, 255, 255, 0.95);
            animation: fadeInUp 1s ease-out 0.2s both;
        }

        .staff-header__description {
            font-size: 1.1rem;
            line-height: 1.8;
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 2rem;
            animation: fadeInUp 1s ease-out 0.4s both;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Staff Filter Section */
        .staff-filter-section {
            margin-top: -140px;
            margin-bottom: 60px;
            position: relative;
            z-index: 10;
        }

        .staff-filter-container {
            background: var(--white-color);
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            padding: 30px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-between;
            align-items: center;
            transition: var(--transition);
        }

        .staff-filter-container:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .staff-search {
            flex: 1;
            position: relative;
            min-width: 280px;
        }

        .staff-search-input {
            width: 100%;
            padding: 15px 55px 15px 25px;
            border-radius: 50px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            background-color: var(--light-color);
            font-size: 16px;
            transition: var(--transition);
        }

        .staff-search-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(30, 64, 175, 0.15);
        }

        .staff-search-btn {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            background: var(--primary-color);
            color: var(--white-color);
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .staff-search-btn:hover {
            background: var(--accent-color);
            transform: translateY(-50%) scale(1.05);
        }

        .staff-category-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .staff-filter-btn {
            padding: 12px 24px;
            border-radius: 50px;
            background-color: var(--light-color);
            color: var(--dark-color);
            border: none;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .staff-filter-btn:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 0;
            background: var(--primary-color);
            border-radius: 50px;
            transition: var(--transition);
            z-index: -1;
        }

        .staff-filter-btn:hover:after {
            height: 100%;
        }

        .staff-filter-btn:hover {
            color: var(--white-color);
            transform: translateY(-3px);
        }

        .staff-filter-btn.active {
            background: var(--primary-color);
            color: var(--white-color);
        }

        /* Staff Cards Section */
        .staff-cards-section {
            margin-top: -200px;
            margin-bottom: 0px;
        }

        .staff-card-container {
            margin-bottom: 30px;
        }

        .staff-card {
            position: relative;
            overflow: hidden;
            border-radius: var(--radius-lg);
            box-shadow: var(--card-shadow);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            height: 100%;
            background-color: var(--white-color);
            transform: translateY(0);
            cursor: pointer;
        }

        .staff-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--hover-shadow);
        }

        .staff-image-wrapper {
            position: relative;
            overflow: hidden;
            height: 280px;
        }

        .staff-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.7s ease;
        }

        .staff-card:hover .staff-image {
            transform: scale(1.08);
        }

        .staff-card:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0,0,0,0) 50%, rgba(0,0,0,0.8) 100%);
            opacity: 0;
            z-index: 1;
            transition: opacity 0.4s ease;
        }

        .staff-card:hover:before {
            opacity: 1;
        }

        .staff-info {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px; 
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border-radius: var(--radius-sm);
            padding: 15px;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            z-index: 2;
            border-left: 4px solid var(--primary-color);
        }

        .staff-card:hover .staff-info {
            background: var(--primary-color);
            color: white;
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        /* Category-specific color indicators */
        .staff-card.management .staff-info {
            border-left-color: var(--management-color);
        }

        .staff-card.management:hover .staff-info {
            background: var(--management-color);
        }

        .staff-card.teaching .staff-info {
            border-left-color: var(--teaching-color);
        }

        .staff-card.teaching:hover .staff-info {
            background: var(--teaching-color);
        }

        .staff-card.support .staff-info {
            border-left-color: var(--support-color);
        }

        .staff-card.support:hover .staff-info {
            background: var(--support-color);
        }

        .staff-name {
            font-size: 1.1rem;
            margin-bottom: 5px;
            font-weight: 700;
            color: var(--dark-color);
            transition: all 0.4s ease;
        }

        .staff-position {
            font-size: 0.85rem;
            margin-bottom: 0;
            opacity: 0.8;
            transition: all 0.4s ease;
            color: #555;
        }

        .staff-education {
            font-size: 0.75rem;
            height: 0;
            opacity: 0;
            overflow: hidden;
            transition: all 0.4s ease;
            color: #666;
            margin-top: 0;
            max-width: 100%;
            text-overflow: ellipsis;
        }

        .staff-card:hover .staff-education {
            opacity: 0.9;
            height: auto;
            margin-top: 8px;
            max-height: 40px;
            overflow: hidden;
        }

        .staff-education.visible {
            opacity: 0.9;
            height: auto;
            margin-top: 8px;
        }

        .staff-card:hover .staff-name,
        .staff-card:hover .staff-position,
        .staff-card:hover .staff-education {
            color: white;
        }

        /* Join Team Section */
        .join-team-section {
            padding: 100px 0;
            background: var(--light-color);
            position: relative;
        }

        .join-team-section:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('assets/images/patterns/pattern-light.svg');
            opacity: 0.05;
            pointer-events: none;
        }

        .join-team-container {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 50px;
        }

        .join-team-content {
            flex: 1;
            min-width: 300px;
        }

        .join-team-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--dark-color);
            position: relative;
            display: inline-block;
        }

        .join-team-title:before {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--primary-color);
            border-radius: 2px;
        }

        .join-team-subtitle {
            font-size: 1.2rem;
            color: var(--primary-color);
            margin-bottom: 20px;
            font-weight: 600;
        }

        .join-team-description {
            font-size: 1rem;
            line-height: 1.8;
            color: #64748B;
            margin-bottom: 30px;
        }

        .join-team-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 15px 30px;
            background: var(--primary-color);
            color: var(--white-color);
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .join-team-btn:before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0%;
            height: 0%;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s ease, height 0.6s ease;
        }

        .join-team-btn:hover:before {
            width: 300%;
            height: 300%;
        }

        .join-team-btn:hover {
            background: var(--accent-color);
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(30, 64, 175, 0.3);
            color: var(--white-color);
        }

        .join-team-image {
            flex: 1;
            min-width: 300px;
            text-align: center;
        }

        .join-team-image img {
            max-width: 100%;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            transition: var(--transition);
        }

        .join-team-image:hover img {
            transform: translateY(-10px) scale(1.02);
            box-shadow: var(--hover-shadow);
        }

        /* Profile Modal */
        .staff-profile-modal .modal-content {
            border-radius: var(--border-radius);
            overflow: hidden;
            border: none;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            background: var(--primary-color);
            color: var(--white-color);
            border: none;
            padding: 20px 30px;
        }

        .modal-title {
            font-weight: 700;
        }

        .modal-body {
            padding: 30px;
        }

        .profile-modal-content {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
        }

        .profile-modal-img {
            flex: 0 0 300px;
            height: 300px;
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        .profile-modal-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-modal-info {
            flex: 1;
            min-width: 300px;
        }

        .profile-modal-name {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--dark-color);
        }

        .profile-modal-position {
            font-size: 1.2rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .profile-modal-section {
            margin-bottom: 20px;
        }

        .profile-modal-section-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--dark-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile-modal-section-title i {
            color: var(--primary-color);
        }

        .profile-modal-text {
            font-size: 1rem;
            line-height: 1.8;
            color: #64748B;
        }

        /* No Results */
        .no-results-container {
            text-align: center;
            padding: 60px 0;
        }

        .no-results {
            max-width: 500px;
            margin: 0 auto;
            background: var(--white-color);
            border-radius: var(--border-radius);
            padding: 40px;
            box-shadow: var(--card-shadow);
        }

        .no-results-icon {
            font-size: 5rem;
            color: #CBD5E1;
            margin-bottom: 20px;
            opacity: 0.6;
        }

        .no-results h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--dark-color);
        }

        .no-results p {
            color: #64748B;
            margin-bottom: 30px;
        }

        .reset-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 25px;
            background: var(--primary-color);
            color: var(--white-color);
            border: none;
            border-radius: 50px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
        }

        .reset-btn:hover {
            background: var(--accent-color);
            transform: translateY(-3px);
        }

        /* RTL Support */
        [dir="rtl"] .staff-search-input {
            padding: 15px 25px 15px 55px;
        }

        [dir="rtl"] .staff-search-btn {
            right: auto;
            left: 8px;
        }

        [dir="rtl"] .staff-info {
            border-left: none;
            border-right: 4px solid var(--primary-color);
        }

        [dir="rtl"] .staff-card.management .staff-info {
            border-right-color: var(--management-color);
        }

        [dir="rtl"] .staff-card.teaching .staff-info {
            border-right-color: var(--teaching-color);
        }

        [dir="rtl"] .staff-card.support .staff-info {
            border-right-color: var(--support-color);
        }

        [dir="rtl"] .join-team-title:before {
            left: auto;
            right: 0;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        /* Media Queries */
        @media (max-width: 1199px) {
            .staff-header__title {
                font-size: 3rem;
            }
            
            .stats-title {
                font-size: 2.5rem;
            }
            
            .stat-item {
                min-width: 200px;
                padding: 30px 20px;
            }
            
            .stat-number {
                font-size: 3rem;
            }
        }

        @media (max-width: 991px) {
            .staff-header__title {
                font-size: 2.5rem;
            }
            
            .staff-filter-container {
                flex-direction: column;
                align-items: stretch;
            }
            
            .join-team-title {
                font-size: 2.2rem;
            }
            
            .stats-title {
                font-size: 2.2rem;
            }
        }

        @media (max-width: 767px) {
            .staff-cards-section {
            margin-top: -150px;
        }
            .staff-header {
                padding: 200px 0 80px;
            }
            
            .staff-header__title {
                font-size: 2rem;
            }
            
            .staff-header__subtitle {
                font-size: 1.1rem;
            }

            .stat-item {
                width: 100%;
                min-width: 100%;
            }

            .join-team-content, .join-team-image {
                width: 100%;
            }
            
            .join-team-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 576px) {
            .staff-header__title {
                font-size: 1.8rem;
                
            }
            .staff-cards-section {
            margin-top: -130px;
        }

            .staff-header__subtitle {
                font-size: 1rem;
            }
            
            .staff-header__description {
                font-size: 0.9rem;
            }

            .profile-modal-img {
                width: 100%;
                flex: 0 0 100%;
                height: 250px;
            }
            
            .stats-title {
                font-size: 1.8rem;
            }
            
            .stats-subtitle {
                font-size: 1rem;
            }
            
            .stat-number {
                font-size: 2.5rem;
            }
        }
        /* استایل فوق‌العاده مدرن برای بخش آمار */
:root {
    --stats-bg-dark: #0B1437;
    --stats-bg-light: #1E3A8A;
    --stats-text-primary: #FFFFFF;
    --stats-text-secondary: rgba(255, 255, 255, 0.8);
    --stats-accent-1: #6366F1;
    --stats-accent-2: #8B5CF6;
    --stats-accent-3: #EC4899;
    --card-bg: rgba(255, 255, 255, 0.05);
    --card-border: rgba(255, 255, 255, 0.1);
    --glass-blur: 10px;
    --animation-slow: 20s;
    --animation-medium: 12s;
    --animation-fast: 8s;
}

.stats-section-ultra {
    position: relative;
    padding: 150px 0 200px;
    margin-top: 50px;
    color: var(--stats-text-primary);
    overflow: hidden;
    background: linear-gradient(135deg, var(--stats-bg-dark) 0%, var(--stats-bg-light) 100%);
    z-index: 1;
}

/* پس‌زمینه پارالاکس با ستاره‌ها */
.parallax-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: -1;
}

.parallax-star-field {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: 
        radial-gradient(2px 2px at 40px 70px, rgba(255, 255, 255, 0.9), rgba(0, 0, 0, 0)),
        radial-gradient(2px 2px at 90px 40px, rgba(255, 255, 255, 0.8), rgba(0, 0, 0, 0)),
        radial-gradient(2px 2px at 130px 80px, rgba(255, 255, 255, 0.7), rgba(0, 0, 0, 0)),
        radial-gradient(2px 2px at 160px 120px, rgb(255, 255, 255), rgba(0, 0, 0, 0));
    background-repeat: repeat;
    background-size: 200px 200px;
    animation: movingStars 150s linear infinite;
    opacity: 0.6;
}

@keyframes movingStars {
    0% {
        transform: translateY(0) translateX(0) rotate(0);
        background-position: 0 0;
    }
    100% {
        transform: translateY(-2000px) translateX(-1000px) rotate(180deg);
        background-position: 2000px 1000px;
    }
}

.cosmic-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
        radial-gradient(circle at 20% 30%, rgba(76, 29, 149, 0.4) 0%, rgba(76, 29, 149, 0) 70%),
        radial-gradient(circle at 70% 60%, rgba(124, 58, 237, 0.4) 0%, rgba(124, 58, 237, 0) 70%);
    filter: blur(30px);
    opacity: 0.8;
    z-index: -1;
    animation: cosmicPulse 15s ease-in-out infinite alternate;
}

@keyframes cosmicPulse {
    0% {
        opacity: 0.6;
        filter: blur(30px) hue-rotate(0deg);
    }
    100% {
        opacity: 0.9;
        filter: blur(40px) hue-rotate(45deg);
    }
}

.floating-particles {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.floating-particles::before,
.floating-particles::after {
    content: '';
    position: absolute;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background: rgba(124, 58, 237, 0.1);
    filter: blur(60px);
}

.floating-particles::before {
    top: 20%;
    left: 10%;
    animation: floatParticle1 25s infinite ease-in-out;
}

.floating-particles::after {
    bottom: 30%;
    right: 15%;
    width: 200px;
    height: 200px;
    background: rgba(99, 102, 241, 0.15);
    animation: floatParticle2 30s infinite ease-in-out;
}

@keyframes floatParticle1 {
    0%, 100% { transform: translate(0, 0); }
    25% { transform: translate(50px, 150px); }
    50% { transform: translate(100px, 30px); }
    75% { transform: translate(-50px, 100px); }
}

@keyframes floatParticle2 {
    0%, 100% { transform: translate(0, 0); }
    25% { transform: translate(-100px, -50px); }
    50% { transform: translate(-30px, -100px); }
    75% { transform: translate(80px, -30px); }
}

/* عنوان بخش */
.stats-heading-container {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 30px;
    gap: 20px;
}

.stats-decorative-line {
    height: 2px;
    width: 60px;
    background: linear-gradient(to right, transparent, var(--stats-accent-2), transparent);
}

.stats-heading {
    font-size: 3.5rem;
    font-weight: 800;
    text-align: center;
    margin: 0;
    background: var(--soft-gradient);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    position: relative;
    white-space: nowrap;
}

.stats-heading::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 4px;
    background: linear-gradient(to right, transparent, var(--stats-accent-2), var(--stats-accent-3), var(--stats-accent-2), transparent);
    border-radius: 2px;
}

.stats-intro-text {
    max-width: 700px;
    margin: 0 auto 80px;
    text-align: center;
    font-size: 1.25rem;
    color: var(--stats-text-secondary);
    line-height: 1.8;
    letter-spacing: 0.01em;
}

/* کارت‌های آمار */
.stats-cards-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
    margin-bottom: 80px;
}

.stats-card {
    position: relative;
    background: var(--card-bg);
    border-radius: 20px;
    padding: 40px 30px;
    height: 100%;
    min-height: 320px;
    border: 1px solid var(--card-border);
    overflow: hidden;
    transform-style: preserve-3d;
    perspective: 1000px;
    transition: transform 0.6s cubic-bezier(0.19, 1, 0.22, 1);
    z-index: 1;
}

.card-glass-effect {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    backdrop-filter: blur(var(--glass-blur));
    -webkit-backdrop-filter: blur(var(--glass-blur));
    border-radius: 20px;
    z-index: -1;
}

.stats-card-inner {
    position: relative;
    z-index: 2;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.stats-card:hover {
    transform: translateY(-15px) scale(1.02);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
}

.stats-card-reflection {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 50%);
    border-radius: 20px;
    z-index: 1;
    pointer-events: none;
}

.stats-card-glow {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 20px;
    z-index: 0;
    opacity: 0;
    box-shadow: 
        0 0 30px 5px rgba(99, 102, 241, 0.3), 
        0 0 60px 10px rgba(139, 92, 246, 0.2);
    transition: opacity 0.6s ease;
    pointer-events: none;
}

.stats-card:hover .stats-card-glow {
    opacity: 1;
}

/* کانتینر آیکون */
.stats-icon-container {
    position: relative;
    width: 80px;
    height: 80px;
    border-radius: 50%;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    overflow: hidden;
    z-index: 1;
    transition: transform 0.4s ease, box-shadow 0.4s ease;
}

.stats-icon-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: conic-gradient(from 0deg, var(--stats-accent-1), var(--stats-accent-2), var(--stats-accent-3), var(--stats-accent-1));
    border-radius: 50%;
    z-index: -1;
    animation: rotateGradient 10s linear infinite;
}

.stats-card:hover .stats-icon-container {
    transform: scale(1.1);
    box-shadow: 0 0 30px rgba(139, 92, 246, 0.7);
}

@keyframes rotateGradient {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* کانتینر عدد */
.stats-number-container {
    margin-bottom: 20px;
    position: relative;
}

.stats-number-wrapper {
    display: flex;
    align-items: baseline;
    justify-content: center;
}

.stats-number {
    font-size: 4rem;
    font-weight: 800;
    background: var(--soft-gradient);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    display: inline-block;
    position: relative;
    margin-bottom: 10px;
}

.stats-plus {
    font-size: 2.5rem;
    margin-left: 5px;
    background: linear-gradient(to bottom, var(--stats-accent-2), var(--stats-accent-3));
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
}

.stats-counter-bar {
    width: 100px;
    height: 6px;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 3px;
    margin: 10px auto 0;
    overflow: hidden;
}

.stats-counter-progress {
    width: 0%;
    height: 100%;
    background: linear-gradient(to right, var(--stats-accent-1), var(--stats-accent-2));
    border-radius: 3px;
    transition: width 2.5s cubic-bezier(0.19, 1, 0.22, 1);
}

.stats-card-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 12px;
    color: var(--stats-text-primary);
    text-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
}

.stats-card-description {
    font-size: 0.95rem;
    color: var(--stats-text-secondary);
    line-height: 1.7;
    flex-grow: 1;
}

/* نشان‌های دستاورد */
.stats-achievement-badges {
    display: flex;
    justify-content: center;
    gap: 30px;
    flex-wrap: wrap;
}

.achievement-badge {
    display: flex;
    align-items: center;
    gap: 15px;
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(var(--glass-blur));
    -webkit-backdrop-filter: blur(var(--glass-blur));
    border-radius: 50px;
    padding: 15px 30px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.4s ease;
}

.achievement-badge:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.2);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.badge-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, var(--stats-accent-2), var(--stats-accent-3));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    color: white;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.achievement-badge span {
    font-weight: 600;
    letter-spacing: 0.02em;
}

/* موج‌های انتهای بخش */
.cosmic-waves {
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    line-height: 0;
    direction: ltr;
    z-index: 2;
    pointer-events: none;
    
}

.cosmic-waves svg {
    width: calc(100% + 1.3px);
}

/* افزودن تغییرات واکنش‌گرا */
@media (max-width: 1200px) {
    .stats-heading {
        font-size: 3rem;
    }
    
    .stats-card {
        min-height: 300px;
    }
}

@media (max-width: 991px) {
    .stats-heading {
        font-size: 2.5rem;
    }
    
    .stats-intro-text {
        font-size: 1.1rem;
        margin-bottom: 60px;
    }
    
    .stats-cards-container {
        gap: 20px;
    }
    
    .stats-number {
        font-size: 3.5rem;
    }
}

@media (max-width: 767px) {
    .stats-section-ultra {
        padding: 100px 0 150px;
    }
    
    .stats-heading {
        font-size: 2rem;
    }
    
    .stats-decorative-line {
        width: 40px;
    }
    
    .stats-card {
        padding: 30px 20px;
    }
    
    .achievement-badge {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 576px) {
    .stats-heading-container {
        flex-direction: column;
        gap: 10px;
    }
    
    .stats-decorative-line {
        width: 100px;
    }
    
    .stats-heading {
        font-size: 1.75rem;
    }
    
    .stats-icon-container {
        width: 70px;
        height: 70px;
        font-size: 1.7rem;
    }
    
    .stats-number {
        font-size: 3rem;
    }
}
    </style>