<style>
        /* =============== 404 ERROR PAGE STYLES =============== */
        :root {
            --primary-color: #6941C6;
            --primary-light: #9E77ED;
            --primary-dark: #4E36B1;
            --accent-color: #7F56D9;
            --text-dark: #1E293B;
            --text-light: #F8FAFC;
            --background-color: #F9FAFB;
            --transition: all 0.3s ease;
        }

        body {
            background-color: var(--background-color);
            overflow-x: hidden;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        [dir="rtl"] body {
            font-family: <?php echo $lang == 'fa' ? "'Vazirmatn'" : "'Noto Sans Arabic'"; ?>, sans-serif;
        }

        /* Language Selector */
        .error-language-selector {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 10;
            display: flex;
            gap: 10px;
        }

        [dir="rtl"] .error-language-selector {
            right: auto;
            left: 20px;
        }

        .lang-btn {
            background: white;
            border: 1px solid rgba(105, 65, 198, 0.2);
            color: var(--primary-color);
            font-weight: 600;
            padding: 8px 14px;
            border-radius: 100px;
            cursor: pointer;
            transition: var(--transition);
            font-size: 14px;
        }

        .lang-btn:hover, .lang-btn.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
            box-shadow: 0 5px 15px rgba(105, 65, 198, 0.2);
        }

        [dir="rtl"] .lang-btn {
            font-family: <?php echo $lang == 'fa' ? "'Vazirmatn'" : "'Noto Sans Arabic'"; ?>, sans-serif;
        }

        /* Error Content */
        .error-404-center {
            padding: 100px 20px;
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            flex: 1;
        }

        @media (max-width: 767px) {
            .error-404-center {
                padding: 120px 20px 80px;
            }
        }

        .error-404-svg {
            max-width: 500px;
            margin: 0 auto 40px;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }

        .error-svg-image {
            width: 100%;
            height: auto;
        }

        .error-content {
            max-width: 600px;
            margin: 0 auto;
        }

        .error-404-title {
            font-size: 42px;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 15px;
            animation: fadeIn 1s ease;
        }

        [dir="rtl"] .error-404-title {
            font-family: <?php echo $lang == 'fa' ? "'Vazirmatn'" : "'Noto Sans Arabic'"; ?>, sans-serif;
        }

        .error-404-text {
            font-size: 18px;
            color: #64748B;
            line-height: 1.6;
            margin-bottom: 30px;
            animation: fadeIn 1s ease 0.2s both;
        }

        [dir="rtl"] .error-404-text {
            font-family: <?php echo $lang == 'fa' ? "'Vazirmatn'" : "'Noto Sans Arabic'"; ?>, sans-serif;
        }

        .error-404-btn {
            display: inline-block;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            font-weight: 600;
            padding: 15px 30px;
            border-radius: 100px;
            text-decoration: none;
            transition: var(--transition);
            animation: fadeIn 1s ease 0.4s both;
            box-shadow: 0 5px 15px rgba(105, 65, 198, 0.2);
        }

        .error-404-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(105, 65, 198, 0.3);
            color: white;
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-color));
        }

        [dir="rtl"] .error-404-btn {
            font-family: <?php echo $lang == 'fa' ? "'Vazirmatn'" : "'Noto Sans Arabic'"; ?>, sans-serif;
        }

        /* Footer */
        .error-footer {
            text-align: center;
            padding: 30px 0;
            margin-top: auto;
        }

        .error-footer-logo {
            max-width: 160px;
            transition: var(--transition);
        }

        .error-footer-logo:hover {
            transform: translateY(-5px);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Arabic specific styles */
        html[lang="ar"] .error-404-title,
        html[lang="ar"] .error-404-text,
        html[lang="ar"] .error-404-btn,
        html[lang="ar"] .lang-btn {
            font-family: 'Noto Sans Arabic', sans-serif;
        }
    </style>