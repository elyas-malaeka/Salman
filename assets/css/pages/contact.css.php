<style>
        /* Base styles */
        :root {
            --primary-color: #6941C6;
            --primary-light: #9E77ED;
            --primary-dark: #4E36B1;
            --secondary-color: #4E36B1;
            --accent-color: #7F56D9;
            --dark-color: #0F172A;
            --dark-light: #334155;
            --light-color: #F8FAFC;
            --success-color: #10B981;
            --warning-color: #F59E0B;
            --danger-color: #EF4444;
            --text-dark: #1E293B;
            --text-muted: #64748B;
            --text-light: #E2E8F0;
            --border-radius-sm: 8px;
            --border-radius: 16px;
            --border-radius-lg: 24px;
            --box-shadow-light: 0 8px 20px rgba(0, 0, 0, 0.06);
            --box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
            --box-shadow-strong: 0 20px 40px rgba(0, 0, 0, 0.15);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Fonts for RTL layout */
        <?php if ($isRtl): ?>
        body, h1, h2, h3, h4, h5, h6, p, a, span, button, input, textarea {
            font-family: 'Vazirmatn', sans-serif !important;
        }
        <?php endif; ?>

        /* Preloader fix */
        .preloader {
            display: none !important;
        }

        /* Utilities */
        .text-gradient {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;
        }

        /* Main styles */
        body {
            background-color: var(--light-color);
            scroll-behavior: smooth;
        }

        /* =============== COSMIC HERO SECTION =============== */
        .cosmic-header {
            background: linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #334155 100%);
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
            font-size: 52px;
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

        /* =============== CONTACT SECTION STYLES =============== */
        .contact-section {
            position: relative;
            padding: 100px 0;
            overflow: hidden;
            background-color: var(--light-color);
        }

        .contact-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: 0;
        }

        .contact-shape {
            position: absolute;
            opacity: 0.06;
            z-index: -1;
        }

        .contact-shape-1 {
            top: 10%;
            left: 5%;
            width: 350px;
            height: 350px;
            border-radius: 350px;
            background: var(--primary-light);
            animation: moveUpDown 15s ease-in-out infinite alternate;
        }

        .contact-shape-2 {
            top: 50%;
            right: -100px;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: var(--primary-dark);
            animation: moveUpDown 20s ease-in-out 5s infinite alternate;
        }

        .contact-shape-3 {
            bottom: 10%;
            left: 15%;
            width: 200px;
            height: 200px;
            background: var(--accent-color);
            border-radius: 40px;
            transform: rotate(30deg);
            animation: rotateShape 30s linear infinite;
        }

        @keyframes moveUpDown {
            0% { transform: translateY(0) rotate(0); }
            50% { transform: translateY(-40px) rotate(5deg); }
            100% { transform: translateY(40px) rotate(-5deg); }
        }

        @keyframes rotateShape {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .contact-container {
            position: relative;
            z-index: 1;
        }

        /* Info Card */
        .contact-card {
            background: white;
            border-radius: var(--border-radius-lg);
            overflow: hidden;
            box-shadow: var(--box-shadow-strong);
            transition: var(--transition);
            height: 100%;
            transform: translateY(0);
            position: relative;
            z-index: 2;
        }

        .contact-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            opacity: 0;
            transition: opacity 0.5s ease;
            z-index: -1;
            border-radius: var(--border-radius-lg);
        }

        .contact-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--box-shadow-strong), 0 20px 40px rgba(105, 65, 198, 0.2);
        }

        .contact-card:hover::before {
            opacity: 0.05;
        }

        .contact-form-card {
            background: white;
            border-radius: var(--border-radius-lg);
            overflow: hidden;
            box-shadow: var(--box-shadow-strong);
            transition: var(--transition);
            position: relative;
            z-index: 2;
        }

        .contact-form-card:hover {
            box-shadow: var(--box-shadow-strong), 0 25px 50px rgba(105, 65, 198, 0.15);
        }

        .contact-shape-accent {
            position: absolute;
            border-radius: 50%;
            z-index: 1;
        }

        .contact-shape-accent-1 {
            top: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            background: linear-gradient(135deg, rgba(126, 90, 247, 0.12), rgba(63, 55, 201, 0.06));
        }

        .contact-shape-accent-2 {
            bottom: -60px;
            left: -60px;
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, rgba(126, 90, 247, 0.08), rgba(63, 55, 201, 0.04));
        }

        .contact-card-header {
            position: relative;
            overflow: hidden;
            padding: 40px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .contact-card-particle {
            position: absolute;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .particle-1 {
            width: 50px;
            height: 50px;
            top: 20px;
            right: 20px;
        }

        .particle-2 {
            width: 100px;
            height: 100px;
            bottom: -30px;
            left: -30px;
        }

        .particle-3 {
            width: 30px;
            height: 30px;
            top: 60%;
            right: 40%;
        }

        .contact-card-body {
            padding: 40px;
            position: relative;
        }

        .contact-card-title {
            font-size: 28px;
            margin-bottom: 20px;
            font-weight: 700;
            color: white;
            position: relative;
            z-index: 2;
        }

        .contact-card-subtitle {
            font-size: 18px;
            opacity: 0.9;
            margin-bottom: 0;
            position: relative;
            z-index: 2;
            line-height: 1.6;
        }

        .contact-info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 25px;
            transition: var(--transition);
            position: relative;
        }

        .contact-info-item::after {
            content: '';
            position: absolute;
            bottom: -12px;
            left: 0;
            width: 0;
            height: 1px;
            background: linear-gradient(to right, var(--primary-light), transparent);
            transition: var(--transition);
        }

        .contact-info-item:hover::after {
            width: 100%;
        }

        .contact-info-item:hover {
            transform: translateX(5px);
        }

        <?php if ($isRtl): ?>
        .contact-info-item::after {
            left: auto;
            right: 0;
            background: linear-gradient(to left, var(--primary-light), transparent);
        }

        .contact-info-item:hover {
            transform: translateX(-5px);
        }
        <?php endif; ?>

        .contact-info-icon {
            width: 50px;
            height: 50px;
            border-radius: 15px;
            background: linear-gradient(135deg, rgba(158, 119, 237, 0.15), rgba(105, 65, 198, 0.05));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            margin-right: 20px;
            flex-shrink: 0;
            font-size: 20px;
            transition: var(--transition);
            position: relative;
            z-index: 1;
            overflow: hidden;
        }

        .contact-info-icon::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }

        .contact-info-item:hover .contact-info-icon {
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(105, 65, 198, 0.2);
        }

        .contact-info-item:hover .contact-info-icon::before {
            opacity: 1;
        }

        <?php if ($isRtl): ?>
        .contact-info-icon {
            margin-right: 0;
            margin-left: 20px;
        }
        <?php endif; ?>

        .contact-info-content {
            flex: 1;
        }

        .contact-info-label {
            font-weight: 700;
            color: var(--text-dark);
            font-size: 18px;
            margin-bottom: 6px;
        }

        .contact-info-value {
            color: var(--text-muted);
            font-size: 16px;
            line-height: 1.6;
        }

        .contact-info-value a {
            color: var(--primary-color);
            transition: var(--transition);
            position: relative;
            display: inline-block;
        }

        .contact-info-value a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            transition: var(--transition);
        }

        .contact-info-value a:hover {
            color: var(--secondary-color);
        }

        .contact-info-value a:hover::after {
            width: 100%;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .social-link {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-size: 18px;
            transition: var(--transition);
            position: relative;
            z-index: 1;
            overflow: hidden;
            box-shadow: var(--box-shadow-light);
        }

        .social-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            opacity: 0;
            transition: var(--transition);
            z-index: -1;
        }

        .social-link:hover {
            color: white;
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 15px 25px rgba(105, 65, 198, 0.2);
        }

        .social-link:hover::before {
            opacity: 1;
        }

        /* Form Styles */
        .contact-form {
            padding: 40px;
            position: relative;
        }

        .form-title {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 10px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;
            letter-spacing: -0.5px;
        }

        .form-subtitle {
            font-size: 18px;
            color: var(--text-muted);
            margin-bottom: 35px;
            line-height: 1.6;
        }

        .input-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-dark);
            font-size: 16px;
            transition: var(--transition);
            padding-left: 10px;
        }

        .form-control {
            width: 100%;
            border-radius: 25px !important;
            padding: 16px 24px !important;
            font-size: 16px !important;
            border: 2px solid #E2E8F0 !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            background-color: white !important;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.02);
        }

        textarea.form-control {
            border-radius: 25px !important;
            min-height: 150px !important;
            resize: vertical;
        }

        .form-control:focus {
            outline: none !important;
            border-color: var(--primary-color) !important;
            box-shadow: 0 5px 15px rgba(111, 76, 255, 0.1) !important;
            transform: translateY(-2px);
            background: linear-gradient(white, white) padding-box,
                linear-gradient(135deg, rgba(126, 90, 247, 0.2), rgba(63, 55, 201, 0.1)) border-box;
            border: 2px solid transparent !important;
        }

        .form-control::placeholder {
            color: #A0AEC0;
            transition: var(--transition);
        }

        .form-control:focus::placeholder {
            opacity: 0.7;
            transform: translateX(5px);
        }

        .form-error {
            color: #EF4444;
            font-size: 14px;
            margin-top: 5px;
            display: none;
            padding-left: 24px;
        }

        .form-control.is-invalid {
            border-color: #EF4444 !important;
        }

        .form-control.is-invalid + .form-error {
            display: block;
        }

        .submit-button {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            border-radius: 50px !important;
            padding: 16px 36px !important;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            position: relative;
            overflow: hidden;
            z-index: 1;
            box-shadow: 0 8px 15px rgba(111, 76, 255, 0.2) !important;
        }

        .submit-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            opacity: 0;
            transition: var(--transition);
            z-index: -1;
        }

        .submit-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(79, 70, 229, 0.3);
        }

        .submit-button:hover::before {
            opacity: 1;
        }

        .submit-button:active {
            transform: translateY(0);
        }

        .submit-button i {
            transition: transform 0.3s ease;
        }

        .submit-button:hover i {
            transform: translateX(5px);
        }

        <?php if ($isRtl): ?>
        .submit-button:hover i {
            transform: translateX(-5px);
        }
        <?php endif; ?>

        /* Map section styles */
        .map-section {
            position: relative;
            height: 500px;
            overflow: hidden;
            border-radius: var(--border-radius-lg);
            box-shadow: var(--box-shadow-strong);
            margin-top: 100px;
            z-index: 2;
        }

        .map-gradient-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(15, 23, 42, 0.05), transparent);
            pointer-events: none;
            z-index: 1;
        }

        .map-info-card {
            position: absolute;
            top: 40px;
            <?php echo $isRtl ? 'right' : 'left'; ?>: 40px;
            max-width: 380px;
            background: white;
            border-radius: var(--border-radius);
            padding: 30px;
            box-shadow: var(--box-shadow-strong);
            z-index: 2;
            transition: var(--transition);
            transform: translateY(0);
        }

        .map-info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(15, 23, 42, 0.1);
        }

        .map-info-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--primary-color);
            letter-spacing: -0.5px;
        }

        .map-info-text {
            font-size: 16px;
            color: var(--text-muted);
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .map-direction-btn {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            border-radius: var(--border-radius);
            padding: 12px 20px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .map-direction-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            opacity: 0;
            transition: var(--transition);
            z-index: -1;
        }

        .map-direction-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.2);
        }

        .map-direction-btn:hover::before {
            opacity: 1;
        }

        .map-iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Modal Styles */
        .contact-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .contact-modal.show {
            opacity: 1;
            visibility: visible;
        }

        .contact-modal-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(5px);
        }

        .contact-modal-container {
            position: relative;
            width: 90%;
            max-width: 500px;
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
            transform: translateY(20px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 10;
            text-align: center;
            overflow: hidden;
        }

        .contact-modal.show .contact-modal-container {
            transform: translateY(0);
        }

        .contact-modal-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(158, 119, 237, 0.2), rgba(105, 65, 198, 0.1));
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .contact-modal-icon i {
            font-size: 32px;
        }

        .contact-modal-icon.success {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(16, 185, 129, 0.1));
            color: #10B981;
        }

        .contact-modal-icon.error {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.2), rgba(239, 68, 68, 0.1));
            color: #EF4444;
        }

        .contact-modal-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--text-dark);
        }

        .contact-modal-message {
            font-size: 16px;
            color: var(--text-muted);
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .contact-modal-btn {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .contact-modal-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(105, 65, 198, 0.2);
        }

        /* Loading indicator for form */
        .form-loading {
            position: relative;
            pointer-events: none;
        }

        .form-loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(2px);
            border-radius: var(--border-radius-lg);
            z-index: 10;
        }

        .form-loading::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 50px;
            height: 50px;
            border: 5px solid rgba(105, 65, 198, 0.2);
            border-top: 5px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            z-index: 11;
        }

        @keyframes spin {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        /* Animation classes */
        @keyframes float {
            0% { transform: translateY(0) rotate(0); }
            50% { transform: translateY(-20px) rotate(5deg); }
            100% { transform: translateY(0) rotate(0); }
        }

        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeIn 1s cubic-bezier(0.5, 0, 0.1, 1) forwards;
        }

        .fade-in-delay-1 {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeIn 1s cubic-bezier(0.5, 0, 0.1, 1) 0.2s forwards;
        }

        .fade-in-delay-2 {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeIn 1s cubic-bezier(0.5, 0, 0.1, 1) 0.4s forwards;
        }

        @keyframes fadeIn {
            from { 
                opacity: 0;
                transform: translateY(30px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }

        .scale-in {
            opacity: 0;
            transform: scale(0.8);
            animation: scaleIn 0.6s cubic-bezier(0.5, 0, 0.1, 1) forwards;
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Responsive styles */
        @media (max-width: 1199px) {
            .cosmic-header__title {
                font-size: 44px;
            }

            .contact-card-header,
            .contact-card-body,
            .contact-form {
                padding: 30px;
            }
        }

        @media (max-width: 991px) {
            .cosmic-header {
                padding: 160px 0 140px;
            }
            
            .cosmic-header__title {
                font-size: 38px;
            }
            
            .cosmic-header__subtitle {
                font-size: 18px;
            }

            .map-info-card {
                position: relative;
                top: 0;
                left: 0;
                right: 0;
                max-width: 100%;
                margin-bottom: 20px;
                border-radius: var(--border-radius-lg) var(--border-radius-lg) 0 0;
            }

            .map-section {
                height: auto;
                display: flex;
                flex-direction: column;
            }

            .map-iframe {
                height: 400px;
                border-radius: 0 0 var(--border-radius-lg) var(--border-radius-lg);
            }

            .contact-section .col-lg-4 {
                margin-bottom: 30px;
            }

            .contact-shape-1,
            .contact-shape-2,
            .contact-shape-3 {
                opacity: 0.03;
            }
        }
            
        @media (max-width: 767px) {
            .cosmic-header {
                padding: 130px 0 110px;
            }
            
            .cosmic-header__title {
                font-size: 32px;
            }
            
            .cosmic-header__subtitle {
                font-size: 16px;
            }
            
            .contact-section {
                padding: 60px 0;
            }

            .form-title {
                font-size: 28px;
            }

            .form-subtitle {
                font-size: 16px;
            }

            .map-iframe {
                height: 300px;
            }

            .contact-card-title {
                font-size: 24px;
            }

            .contact-info-icon {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }
        }

        /* Animation for numbers (RTL support) */
        .numbers-ltr {
            direction: ltr;
            display: inline-block;
        }
        
    </style>