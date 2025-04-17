-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2025 at 08:34 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salman`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_content`
--

CREATE TABLE `about_content` (
  `id` int(11) NOT NULL,
  `field_key` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `language_id` varchar(5) NOT NULL,
  `is_repeatable` tinyint(1) NOT NULL DEFAULT 0,
  `section_id` varchar(50) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_content`
--

INSERT INTO `about_content` (`id`, `field_key`, `content`, `language_id`, `is_repeatable`, `section_id`, `sort_order`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 'page_title', 'درباره مجتمع آموزشی سلمان فارسی', 'fa', 0, 'header', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 19:04:46'),
(2, 'page_title', 'About Salman Farsi Educational Complex', 'en', 0, 'header', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(3, 'page_title', 'عن مجمع سلمان الفارسي التعليمي', 'ar', 0, 'header', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(4, 'header_subtitle', 'نمادی از تاریخ پرفراز و نشیب تعلیم و تربیت ایرانیان در امارات متحده عربی', 'fa', 0, 'header', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(5, 'header_subtitle', 'A symbol of Iranian education excellence in the United Arab Emirates', 'en', 0, 'header', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(6, 'header_subtitle', 'رمز للتميز التعليمي الإيراني في دولة الإمارات العربية المتحدة', 'ar', 0, 'header', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(7, 'history_tagline', 'تاریخچه ما', 'fa', 0, 'history', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(8, 'history_tagline', 'Our History', 'en', 0, 'history', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(9, 'history_tagline', 'تاريخنا', 'ar', 0, 'history', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(10, 'history_title', 'مجتمع آموزشی سلمان فارسی، نماد آموزش ایرانی در امارات', 'fa', 0, 'history', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(11, 'history_title', 'Salman Farsi Educational Complex: A Symbol of Iranian Education in UAE', 'en', 0, 'history', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(12, 'history_title', 'مجمع سلمان الفارسي التعليمي: رمز للتعليم الإيراني في الإمارات', 'ar', 0, 'history', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(13, 'history_paragraph_1', 'مجتمع آموزشی سلمان فارسی، نمادی از تاریخ پرفراز و نشیب تعلیم و تربیت ایرانیان در امارات متحده عربی، با افتخاراتی کم‌نظیر و میراثی ارزشمند، روایت‌گر مسیری است که با تلاش، تعهد و نوآوری همراه بوده است.', 'fa', 0, 'history', 1, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(14, 'history_paragraph_1', 'The Salman Farsi Educational Complex stands as a beacon of Iranian education in the United Arab Emirates, carrying a legacy of achievement and dedication. This institution narrates a rich history marked by tireless efforts, unwavering commitment, and innovative strides in the field of education.', 'en', 0, 'history', 1, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(15, 'history_paragraph_1', 'يقف مجمع سلمان الفارسي التعليمي كمنارة للتعليم الإيراني في دولة الإمارات العربية المتحدة، حاملاً إرثًا من الإنجازات والتفاني. تروي هذه المؤسسة تاريخًا غنيًا تميزه الجهود الدؤوبة والالتزام الثابت والخطوات المبتكرة في مجال التعليم.', 'ar', 0, 'history', 1, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(16, 'history_paragraph_2', 'آغاز فعالیت مجتمع به سال ۱۳۳۶ برمی‌گردد، زمانی که دبستان ایرانیان دبی به‌عنوان اولین مدرسه ایرانی در امارات، تحت نظارت اداره فرهنگ بنادر جنوب (بوشهر) تأسیس شد. این دبستان مختلط، تا سال تحصیلی ۵۹-۵۸ به همین صورت فعالیت داشت و پس از تفکیک جنسیتی، در سال ۶۰-۶۱ با نام \"دبستان شهید رجایی\" به مسیر خود ادامه داد.', 'fa', 0, 'history', 2, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(17, 'history_paragraph_2', 'The complex\'s journey began in 1957, with the establishment of the Iranian Elementary School of Dubai, the first Iranian school in the UAE, operating under the supervision of the Southern Ports Cultural Administration (Bushehr). Initially coeducational, the school transitioned to gender-segregated education in 1979-1980 under the name \"Shaheed Rajai Elementary School\".', 'en', 0, 'history', 2, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(18, 'history_paragraph_2', 'بدأت رحلة المجمع في عام 1957، مع تأسيس المدرسة الابتدائية الإيرانية في دبي، وهي أول مدرسة إيرانية في الإمارات، تعمل تحت إشراف إدارة الثقافة في الموانئ الجنوبية (بوشهر). في البداية كانت المدرسة مختلطة، ثم انتقلت إلى التعليم المنفصل بين الجنسين في 1979-1980 تحت اسم \"مدرسة الشهيد رجائي الابتدائية\".', 'ar', 0, 'history', 2, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(19, 'history_paragraph_3', 'در سال تحصیلی ۵۱-۵۰، مدرسه راهنمایی تحصیلی ابوعلی سینا تأسیس شد و دوره متوسطه مجتمع از سال ۱۳۴۲ آغاز شد. در ادامه، با توسعه مدارس ایرانی در سال تحصیلی ۷۵-۷۴، \"مجتمع آموزشی سلمان فارسی\" با مدیریت واحد و ساختاری مستقل شکل گرفت.', 'fa', 0, 'history', 3, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(20, 'history_paragraph_3', 'In the academic year 1971-1970, Abu Ali Sina Middle School was inaugurated, and the high school program commenced in 1963. With the expansion of Iranian schools, in the academic year 1995-1994, the \"Salman Farsi Educational Complex\" was formed with unified management and independent governance.', 'en', 0, 'history', 3, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(21, 'history_paragraph_3', 'في العام الدراسي 1971-1970، تم افتتاح مدرسة أبو علي سينا المتوسطة، وبدأ برنامج المدرسة الثانوية في عام 1963. ومع توسع المدارس الإيرانية، في العام الدراسي 1995-1994، تم تشكيل \"مجمع سلمان الفارسي التعليمي\" بإدارة موحدة وحكم مستقل.', 'ar', 0, 'history', 3, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(22, 'highlight_item', '{\"title\":\"آموزش با کیفیت بالا\"}', 'fa', 1, 'highlights', 1, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(23, 'highlight_item', '{\"title\":\"High-Quality Education\"}', 'en', 1, 'highlights', 1, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(24, 'highlight_item', '{\"title\":\"تعليم عالي الجودة\"}', 'ar', 1, 'highlights', 1, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(25, 'highlight_item', '{\"title\":\"محیطی امن و مطلوب\"}', 'fa', 1, 'highlights', 2, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(26, 'highlight_item', '{\"title\":\"Safe Learning Environment\"}', 'en', 1, 'highlights', 2, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(27, 'highlight_item', '{\"title\":\"بيئة تعليمية آمنة\"}', 'ar', 1, 'highlights', 2, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(28, 'highlight_item', '{\"title\":\"معلمان مجرب و متعهد\"}', 'fa', 1, 'highlights', 3, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(29, 'highlight_item', '{\"title\":\"Experienced Faculty\"}', 'en', 1, 'highlights', 3, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(30, 'highlight_item', '{\"title\":\"هيئة تدريس ذات خبرة\"}', 'ar', 1, 'highlights', 3, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(31, 'highlight_item', '{\"title\":\"امکانات آموزشی مدرن\"}', 'fa', 1, 'highlights', 4, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(32, 'highlight_item', '{\"title\":\"Modern Facilities\"}', 'en', 1, 'highlights', 4, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(33, 'highlight_item', '{\"title\":\"مرافق حديثة\"}', 'ar', 1, 'highlights', 4, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(34, 'campus_tagline', 'موقعیت مجتمع', 'fa', 0, 'campus', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(35, 'campus_tagline', 'Campus Location', 'en', 0, 'campus', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(36, 'campus_tagline', 'موقع الحرم الجامعي', 'ar', 0, 'campus', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(37, 'campus_title', 'فضایی ایده‌آل برای یادگیری و رشد', 'fa', 0, 'campus', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(38, 'campus_title', 'An Ideal Environment for Learning & Growth', 'en', 0, 'campus', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(39, 'campus_title', 'بيئة مثالية للتعلم والنمو', 'ar', 0, 'campus', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(40, 'campus_paragraph_1', 'زمین مجتمع از سوی شیخ محمد بن راشد آل مکتوم، امیر دبی، اهدا شد و هزینه احداث آن با کمک‌های مردمی و درآمدهای سرپرستی تأمین گردید. این مجتمع با زیربنای ۸۰۰۰ مترمربع و در زمینی به وسعت ۳۶۰۰۰ مترمربع احداث شده است.', 'fa', 0, 'campus', 1, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(41, 'campus_paragraph_1', 'The land for the complex was generously donated by Sheikh Mohammed bin Rashid Al Maktoum, the Ruler of Dubai, with construction costs funded through public donations and the Board of Trustees\' revenue. The complex spans 36,000 square meters with a built-up area of 8,000 square meters.', 'en', 0, 'campus', 1, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(42, 'campus_paragraph_1', 'تم التبرع بالأرض المخصصة للمجمع بسخاء من قبل الشيخ محمد بن راشد آل مكتوم، حاكم دبي، وتم تمويل تكاليف البناء من خلال التبرعات العامة وإيرادات مجلس الأمناء. يمتد المجمع على مساحة 36,000 متر مربع بمساحة مبنية قدرها 8,000 متر مربع.', 'ar', 0, 'campus', 1, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(43, 'campus_paragraph_2', 'عملیات ساخت از ۱۲ بهمن ۱۳۷۳ آغاز و در مهر ۱۳۷۴ فاز اول با حضور وزیر وقت آموزش و پرورش افتتاح شد.', 'fa', 0, 'campus', 2, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(44, 'campus_paragraph_2', 'Construction began on February 1, 1995, and the first phase was inaugurated in October 1995 in the presence of Iran\'s Minister of Education. The second phase was completed in 2009.', 'en', 0, 'campus', 2, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(45, 'campus_paragraph_2', 'بدأ البناء في 1 فبراير 1995، وتم افتتاح المرحلة الأولى في أكتوبر 1995 بحضور وزير التربية والتعليم الإيراني. واكتملت المرحلة الثانية في عام 2009.', 'ar', 0, 'campus', 2, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(46, 'campus_stat_1', '8000', 'fa', 0, 'campus_stats', 1, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(47, 'campus_stat_1', '8000', 'en', 0, 'campus_stats', 1, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(48, 'campus_stat_1', '8000', 'ar', 0, 'campus_stats', 1, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(49, 'campus_stat_1_label', 'متر مربع زیربنا', 'fa', 0, 'campus_stats', 1, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(50, 'campus_stat_1_label', 'Square Meters Built-up Area', 'en', 0, 'campus_stats', 1, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(51, 'campus_stat_1_label', 'متر مربع مساحة مبنية', 'ar', 0, 'campus_stats', 1, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(52, 'campus_stat_2', '36000', 'fa', 0, 'campus_stats', 2, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(53, 'campus_stat_2', '36000', 'en', 0, 'campus_stats', 2, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(54, 'campus_stat_2', '36000', 'ar', 0, 'campus_stats', 2, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(55, 'campus_stat_2_label', 'متر مربع مساحت زمین', 'fa', 0, 'campus_stats', 2, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(56, 'campus_stat_2_label', 'Square Meters of Land', 'en', 0, 'campus_stats', 2, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(57, 'campus_stat_2_label', 'متر مربع من الأرض', 'ar', 0, 'campus_stats', 2, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(58, 'features_tagline', 'ویژگی‌ها و امکانات مجتمع', 'fa', 0, 'features', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(59, 'features_tagline', 'Features and Facilities', 'en', 0, 'features', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(60, 'features_tagline', 'الميزات والمرافق', 'ar', 0, 'features', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(61, 'features_title', 'محیطی ایده‌آل برای یادگیری', 'fa', 0, 'features', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(62, 'features_title', 'An Ideal Learning Environment', 'en', 0, 'features', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(63, 'features_title', 'بيئة تعليمية مثالية', 'ar', 0, 'features', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(64, 'feature_item', '{\"icon\":\"fas fa-chalkboard-teacher\", \"title\":\"کلاس‌های مجهز\", \"description\":\"ساختمان دو طبقه مجتمع شامل ۲۶ کلاس درس مجهز به تخته‌های هوشمند، با محیطی مناسب برای یادگیری بهتر\"}', 'fa', 1, 'features', 1, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(65, 'feature_item', '{\"icon\":\"fas fa-chalkboard-teacher\", \"title\":\"Modern Classrooms\", \"description\":\"26 classrooms equipped with smartboards, creating an optimal environment for enhanced learning\"}', 'en', 1, 'features', 1, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(66, 'feature_item', '{\"icon\":\"fas fa-chalkboard-teacher\", \"title\":\"فصول دراسية حديثة\", \"description\":\"26 فصلاً دراسياً مجهزة بالسبورات الذكية، مما يخلق بيئة مثالية للتعلم المعزز\"}', 'ar', 1, 'features', 1, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(67, 'feature_item', '{\"icon\":\"fas fa-book-reader\", \"title\":\"کتابخانه مجهز\", \"description\":\"کتابخانه‌ای با ظرفیت ۴۵۰۰ جلد کتاب در زمینه‌های مختلف علمی، ادبی و هنری\"}', 'fa', 1, 'features', 2, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(68, 'feature_item', '{\"icon\":\"fas fa-book-reader\", \"title\":\"Well-stocked Library\", \"description\":\"A library with a collection of 4,500 books covering various scientific, literary, and artistic subjects\"}', 'en', 1, 'features', 2, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(69, 'feature_item', '{\"icon\":\"fas fa-book-reader\", \"title\":\"مكتبة مجهزة جيدًا\", \"description\":\"مكتبة تضم مجموعة من 4,500 كتاب تغطي مختلف المواضيع العلمية والأدبية والفنية\"}', 'ar', 1, 'features', 2, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(70, 'feature_item', '{\"icon\":\"fas fa-flask\", \"title\":\"آزمایشگاه‌های علمی\", \"description\":\"آزمایشگاه‌های مجهز علمی برای مقاطع ابتدایی، راهنمایی و دبیرستان\"}', 'fa', 1, 'features', 3, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(71, 'feature_item', '{\"icon\":\"fas fa-flask\", \"title\":\"Science Laboratories\", \"description\":\"State-of-the-art science laboratories for elementary, middle, and high school levels\"}', 'en', 1, 'features', 3, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(72, 'feature_item', '{\"icon\":\"fas fa-flask\", \"title\":\"المختبرات العلمية\", \"description\":\"مختبرات علمية متطورة للمراحل الابتدائية والمتوسطة والثانوية\"}', 'ar', 1, 'features', 3, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(73, 'feature_item', '{\"icon\":\"fas fa-laptop-code\", \"title\":\"کارگاه‌های رایانه\", \"description\":\"سه کارگاه رایانه با بیش از ۴۰ دستگاه مجهز برای آموزش مهارت‌های دیجیتال\"}', 'fa', 1, 'features', 4, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(74, 'feature_item', '{\"icon\":\"fas fa-laptop-code\", \"title\":\"Computer Labs\", \"description\":\"Three computer labs with over 40 computers, fully equipped for teaching digital skills\"}', 'en', 1, 'features', 4, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(75, 'feature_item', '{\"icon\":\"fas fa-laptop-code\", \"title\":\"معامل الكمبيوتر\", \"description\":\"ثلاثة معامل كمبيوتر تضم أكثر من 40 جهاز كمبيوتر، مجهزة بالكامل لتعليم المهارات الرقمية\"}', 'ar', 1, 'features', 4, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(76, 'feature_item', '{\"icon\":\"fas fa-futbol\", \"title\":\"امکانات ورزشی\", \"description\":\"زمین‌های ورزشی استاندارد شامل فوتبال، هندبال، والیبال و بسکتبال\"}', 'fa', 1, 'features', 5, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(77, 'feature_item', '{\"icon\":\"fas fa-futbol\", \"title\":\"Sports Facilities\", \"description\":\"Standard sports fields including football, handball, volleyball, and basketball courts\"}', 'en', 1, 'features', 5, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(78, 'feature_item', '{\"icon\":\"fas fa-futbol\", \"title\":\"المرافق الرياضية\", \"description\":\"ملاعب رياضية قياسية تشمل كرة القدم وكرة اليد والكرة الطائرة وملاعب كرة السلة\"}', 'ar', 1, 'features', 5, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(79, 'feature_item', '{\"icon\":\"fas fa-users\", \"title\":\"سالن چندمنظوره\", \"description\":\"سالن بزرگ برای نماز، اجتماعات و امتحانات با امکانات صوتی و تصویری پیشرفته\"}', 'fa', 1, 'features', 6, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(80, 'feature_item', '{\"icon\":\"fas fa-users\", \"title\":\"Multipurpose Hall\", \"description\":\"Large hall for prayers, assemblies, and examinations with advanced audio-visual equipment\"}', 'en', 1, 'features', 6, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(81, 'feature_item', '{\"icon\":\"fas fa-users\", \"title\":\"قاعة متعددة الأغراض\", \"description\":\"قاعة كبيرة للصلاة والتجمعات والامتحانات مع معدات سمعية وبصرية متطورة\"}', 'ar', 1, 'features', 6, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(82, 'stats_item', '{\"icon\":\"fas fa-user-graduate\", \"number\":\"5000\", \"text\":\"دانش‌آموختگان\"}', 'fa', 1, 'stats', 1, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(83, 'stats_item', '{\"icon\":\"fas fa-user-graduate\", \"number\":\"5000\", \"text\":\"Graduates\"}', 'en', 1, 'stats', 1, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(84, 'stats_item', '{\"icon\":\"fas fa-user-graduate\", \"number\":\"5000\", \"text\":\"الخريجين\"}', 'ar', 1, 'stats', 1, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(85, 'stats_item', '{\"icon\":\"fas fa-chalkboard-teacher\", \"number\":\"100\", \"text\":\"معلمان متخصص\"}', 'fa', 1, 'stats', 2, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(86, 'stats_item', '{\"icon\":\"fas fa-chalkboard-teacher\", \"number\":\"100\", \"text\":\"Expert Teachers\"}', 'en', 1, 'stats', 2, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(87, 'stats_item', '{\"icon\":\"fas fa-chalkboard-teacher\", \"number\":\"100\", \"text\":\"المعلمين الخبراء\"}', 'ar', 1, 'stats', 2, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(88, 'stats_item', '{\"icon\":\"fas fa-trophy\", \"number\":\"75\", \"text\":\"جوایز و افتخارات\"}', 'fa', 1, 'stats', 3, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(89, 'stats_item', '{\"icon\":\"fas fa-trophy\", \"number\":\"75\", \"text\":\"Awards\"}', 'en', 1, 'stats', 3, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(90, 'stats_item', '{\"icon\":\"fas fa-trophy\", \"number\":\"75\", \"text\":\"الجوائز\"}', 'ar', 1, 'stats', 3, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(91, 'stats_item', '{\"icon\":\"fas fa-calendar-check\", \"number\":\"65\", \"text\":\"سال‌های فعالیت\"}', 'fa', 1, 'stats', 4, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(92, 'stats_item', '{\"icon\":\"fas fa-calendar-check\", \"number\":\"65\", \"text\":\"Years of Experience\"}', 'en', 1, 'stats', 4, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(93, 'stats_item', '{\"icon\":\"fas fa-calendar-check\", \"number\":\"65\", \"text\":\"سنوات الخبرة\"}', 'ar', 1, 'stats', 4, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(94, 'graduates_tagline', 'فارغ‌التحصیلان ما', 'fa', 0, 'graduates', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(95, 'graduates_tagline', 'Our Graduates', 'en', 0, 'graduates', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(96, 'graduates_tagline', 'خريجينا', 'ar', 0, 'graduates', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(97, 'graduates_title', 'داستان‌های موفقیت دانش‌آموختگان ما', 'fa', 0, 'graduates', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(98, 'graduates_title', 'Success Stories of Our Alumni', 'en', 0, 'graduates', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(99, 'graduates_title', 'قصص نجاح الخريجين', 'ar', 0, 'graduates', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(100, 'graduates_paragraph_1', 'هر ساله بیش از ۹۰ درصد دانش‌آموزان پایه دوازدهم این مجتمع فارغ‌التحصیل شده و اکثر آن‌ها در دانشگاه‌های معتبر جهانی مشغول به تحصیل یا وارد بازار کار امارات می‌شوند.', 'fa', 0, 'graduates', 1, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(101, 'graduates_paragraph_1', 'Every year, over 90% of our 12th-grade students graduate, with most progressing to prestigious universities worldwide or entering the UAE workforce.', 'en', 0, 'graduates', 1, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(102, 'graduates_paragraph_1', 'في كل عام، يتخرج أكثر من 90٪ من طلاب الصف الثاني عشر لدينا، مع تقدم معظمهم إلى جامعات مرموقة في جميع أنحاء العالم أو دخول القوى العاملة في الإمارات.', 'ar', 0, 'graduates', 1, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(103, 'graduates_paragraph_2', 'فارغ‌التحصیلان ما در رشته‌های مختلف مانند پزشکی، مهندسی، هنر و تجارت موفق بوده‌اند و افتخارات بزرگی را برای جامعه ایرانی به ارمغان آورده‌اند.', 'fa', 0, 'graduates', 2, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(104, 'graduates_paragraph_2', 'Our alumni have excelled in various fields such as medicine, engineering, arts, and business, bringing great honor to the Iranian community. Their achievements reflect the educational excellence fostered at Salman Farsi Educational Complex.', 'en', 0, 'graduates', 2, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(105, 'graduates_paragraph_2', 'تفوق خريجونا في مختلف المجالات مثل الطب والهندسة والفنون والأعمال، مما جلب شرفًا كبيرًا للمجتمع الإيراني. تعكس إنجازاتهم التميز التعليمي الذي تم تعزيزه في مجمع سلمان الفارسي التعليمي.', 'ar', 0, 'graduates', 2, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(106, 'graduate_stat_1', '90', 'fa', 0, 'graduate_stats', 1, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(107, 'graduate_stat_1', '90', 'en', 0, 'graduate_stats', 1, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(108, 'graduate_stat_1', '90', 'ar', 0, 'graduate_stats', 1, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(109, 'graduate_stat_1_label', 'نرخ قبولی در دانشگاه', 'fa', 0, 'graduate_stats', 1, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(110, 'graduate_stat_1_label', 'University Acceptance Rate', 'en', 0, 'graduate_stats', 1, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(111, 'graduate_stat_1_label', 'معدل القبول الجامعي', 'ar', 0, 'graduate_stats', 1, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(112, 'graduate_stat_2', '75', 'fa', 0, 'graduate_stats', 2, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(113, 'graduate_stat_2', '75', 'en', 0, 'graduate_stats', 2, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(114, 'graduate_stat_2', '75', 'ar', 0, 'graduate_stats', 2, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(115, 'graduate_stat_2_label', 'اشتغال در مشاغل تخصصی', 'fa', 0, 'graduate_stats', 2, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(116, 'graduate_stat_2_label', 'Professional Employment', 'en', 0, 'graduate_stats', 2, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(117, 'graduate_stat_2_label', 'التوظيف المهني', 'ar', 0, 'graduate_stats', 2, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(118, 'team_tagline', 'تیم مدیریت', 'fa', 0, 'team', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(119, 'team_tagline', 'Leadership Team', 'en', 0, 'team', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(120, 'team_tagline', 'فريق القيادة', 'ar', 0, 'team', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(121, 'team_title', 'با مدیران ما آشنا شوید', 'fa', 0, 'team', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(122, 'team_title', 'Meet Our Leadership', 'en', 0, 'team', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(123, 'team_title', 'تعرف على قيادتنا', 'ar', 0, 'team', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(124, 'team_member', '{\"name\":\"دکتر مجید اخلاصی\", \"position\":\"مدیر مجتمع\"}', 'fa', 1, 'team', 1, 'assets/images/Staff/Akhlasi.png', '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(125, 'team_member', '{\"name\":\"Dr. Majid Akhlasi\", \"position\":\"Principal\"}', 'en', 1, 'team', 1, 'assets/images/Staff/Akhlasi.png', '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(126, 'team_member', '{\"name\":\"الدكتور ماجد اخلاصي\", \"position\":\"مدير المدرسة\"}', 'ar', 1, 'team', 1, 'assets/images/Staff/Akhlasi.png', '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(127, 'team_member', '{\"name\":\"خانم نصرت داشاب\", \"position\":\"معاون آموزشی\"}', 'fa', 1, 'team', 2, 'assets/images/Staff/Dashab.png', '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(128, 'team_member', '{\"name\":\"Ms. Nosrat Dashab\", \"position\":\"Educational Assistant\"}', 'en', 1, 'team', 2, 'assets/images/Staff/Dashab.png', '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(129, 'team_member', '{\"name\":\"السيدة نصرت داشاب\", \"position\":\"المساعد التعليمي\"}', 'ar', 1, 'team', 2, 'assets/images/Staff/Dashab.png', '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(130, 'team_member', '{\"name\":\"آقای محمد رضا محمدی\", \"position\":\"معاون متوسطه دوم\"}', 'fa', 1, 'team', 3, 'assets/images/Staff/Mohammadi.png', '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(131, 'team_member', '{\"name\":\"Mr. Mohammad Reza Mohammadi\", \"position\":\"Second secondary assistant\"}', 'en', 1, 'team', 3, 'assets/images/Staff/Mohammadi.png', '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(132, 'team_member', '{\"name\":\"السيد محمد رضا محمدي\", \"position\":\"مساعد الثانوية الثاني\"}', 'ar', 1, 'team', 3, 'assets/images/Staff/Mohammadi.png', '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(133, 'team_member', '{\"name\":\"خانم معصومه جعفری\", \"position\":\"معاون اجرایی\"}', 'fa', 1, 'team', 4, 'assets/images/Staff/Jafari.png', '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(134, 'team_member', '{\"name\":\"Ms. Masoomeh Jafari\", \"position\":\"Deputy Manager\"}', 'en', 1, 'team', 4, 'assets/images/Staff/Jafari.png', '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(135, 'team_member', '{\"name\":\"السيدة معصومة جعفري\", \"position\":\"نائب المدير\"}', 'ar', 1, 'team', 4, 'assets/images/Staff/Jafari.png', '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(136, 'cta_title', 'به خانواده مجتمع آموزشی سلمان فارسی بپیوندید', 'fa', 0, 'cta', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(137, 'cta_title', 'Join the Salman Farsi Educational Complex Family', 'en', 0, 'cta', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(138, 'cta_title', 'انضم إلى عائلة مجمع سلمان الفارسي التعليمي', 'ar', 0, 'cta', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(139, 'cta_subtitle', 'آینده فرزند خود را با آموزش باکیفیت، محیطی امن و فرهنگی غنی تضمین کنید', 'fa', 0, 'cta', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(140, 'cta_subtitle', 'Secure your child\'s future with quality education, a safe environment, and rich culture', 'en', 0, 'cta', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(141, 'cta_subtitle', 'ضمان مستقبل طفلك بتعليم جيد وبيئة آمنة وثقافة غنية', 'ar', 0, 'cta', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(142, 'cta_button_text', 'ثبت‌نام کنید', 'fa', 0, 'cta', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(143, 'cta_button_text', 'Apply Now', 'en', 0, 'cta', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(144, 'cta_button_text', 'سجل الآن', 'ar', 0, 'cta', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(145, 'video_path', 'assets/videos/school-intro.mp4', 'fa', 0, 'media', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(146, 'video_path', 'assets/videos/school-intro.mp4', 'en', 0, 'media', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(147, 'video_path', 'assets/videos/school-intro.mp4', 'ar', 0, 'media', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(148, 'video_thumbnail', 'assets/images/resources/video-thumbnail.jpg', 'fa', 0, 'media', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(149, 'video_thumbnail', 'assets/images/resources/video-thumbnail.jpg', 'en', 0, 'media', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(150, 'video_thumbnail', 'assets/images/resources/video-thumbnail.jpg', 'ar', 0, 'media', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(151, 'video_caption', 'مجتمع آموزشی سلمان فارسی - معرفی امکانات و فضای آموزشی', 'fa', 0, 'media', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(152, 'video_caption', 'Salman Farsi Educational Complex - Facilities and Campus Tour', 'en', 0, 'media', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(153, 'video_caption', 'مجمع سلمان الفارسي التعليمي - المرافق وجولة الحرم الجامعي', 'ar', 0, 'media', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(154, 'campus_image', 'assets/images/resources/campus-1.jpg', 'fa', 0, 'media', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(155, 'campus_image', 'assets/images/resources/campus-1.jpg', 'en', 0, 'media', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(156, 'campus_image', 'assets/images/resources/campus-1.jpg', 'ar', 0, 'media', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(157, 'graduates_image', 'assets/images/resources/graduates.jpg', 'fa', 0, 'media', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(158, 'graduates_image', 'assets/images/resources/graduates.jpg', 'en', 0, 'media', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(159, 'graduates_image', 'assets/images/resources/graduates.jpg', 'ar', 0, 'media', 0, NULL, '2025-03-28 18:54:52', '2025-03-28 18:54:52'),
(160, 'view_all_staff_button', 'مشاهده تمام کادر آموزشی', 'fa', 0, 'team', 0, NULL, '2025-03-28 19:03:04', '2025-03-28 19:03:04'),
(161, 'view_all_staff_button', 'View All Staff Members', 'en', 0, 'team', 0, NULL, '2025-03-28 19:03:04', '2025-03-28 19:03:04'),
(162, 'view_all_staff_button', 'عرض جميع أعضاء هيئة التدريس', 'ar', 0, 'team', 0, NULL, '2025-03-28 19:03:04', '2025-03-28 19:03:04'),
(163, 'view_all_staff_button', 'مشاهده تمام کادر آموزشی', 'fa', 0, 'team', 0, NULL, '2025-03-28 19:03:05', '2025-03-28 19:03:05'),
(164, 'view_all_staff_button', 'View All Staff Members', 'en', 0, 'team', 0, NULL, '2025-03-28 19:03:05', '2025-03-28 19:03:05'),
(165, 'view_all_staff_button', 'عرض جميع أعضاء هيئة التدريس', 'ar', 0, 'team', 0, NULL, '2025-03-28 19:03:05', '2025-03-28 19:03:05');

-- --------------------------------------------------------

--
-- Table structure for table `academic_grades`
--

CREATE TABLE `academic_grades` (
  `grade_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_grades`
--

INSERT INTO `academic_grades` (`grade_id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12);

-- --------------------------------------------------------

--
-- Table structure for table `academic_grade_translations`
--

CREATE TABLE `academic_grade_translations` (
  `grade_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `grade_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_grade_translations`
--

INSERT INTO `academic_grade_translations` (`grade_id`, `language_id`, `grade_name`) VALUES
(1, 1, 'پایه اول'),
(1, 2, 'Grade 1'),
(1, 3, 'الصف الأول'),
(2, 1, 'پایه دوم'),
(2, 2, 'Grade 2'),
(2, 3, 'الصف الثاني'),
(3, 1, 'پایه سوم'),
(3, 2, 'Grade 3'),
(3, 3, 'الصف الثالث'),
(4, 1, 'پایه چهارم'),
(4, 2, 'Grade 4'),
(4, 3, 'الصف الرابع'),
(5, 1, 'پایه پنجم'),
(5, 2, 'Grade 5'),
(5, 3, 'الصف الخامس'),
(6, 1, 'پایه ششم'),
(6, 2, 'Grade 6'),
(6, 3, 'الصف السادس'),
(7, 1, 'پایه هفتم'),
(7, 2, 'Grade 7'),
(7, 3, 'الصف السابع'),
(8, 1, 'پایه هشتم'),
(8, 2, 'Grade 8'),
(8, 3, 'الصف الثامن'),
(9, 1, 'پایه نهم'),
(9, 2, 'Grade 9'),
(9, 3, 'الصف التاسع'),
(10, 1, 'پایه دهم'),
(10, 2, 'Grade 10'),
(10, 3, 'الصف العاشر'),
(11, 1, 'پایه یازدهم'),
(11, 2, 'Grade 11'),
(11, 3, 'الصف الحادي عشر'),
(12, 1, 'پایه دوازدهم'),
(12, 2, 'Grade 12'),
(12, 3, 'الصف الثاني عشر');

-- --------------------------------------------------------

--
-- Table structure for table `blog_content`
--

CREATE TABLE `blog_content` (
  `id` int(11) NOT NULL,
  `field_key` varchar(255) NOT NULL COMMENT 'کلید شناسایی محتوا',
  `content` text DEFAULT NULL COMMENT 'محتوای اصلی',
  `language_id` varchar(5) NOT NULL COMMENT 'کد زبان (fa, en, ar)',
  `is_repeatable` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'آیا این محتوا تکرارشونده است؟',
  `section_id` varchar(50) DEFAULT NULL COMMENT 'شناسه بخش برای گروه‌بندی',
  `sort_order` int(11) NOT NULL DEFAULT 0 COMMENT 'ترتیب نمایش آیتم‌های تکرارشونده',
  `image_path` varchar(255) DEFAULT NULL COMMENT 'مسیر فایل تصویر',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_visible` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'نمایش یا عدم نمایش این بخش',
  `widget_type` varchar(50) DEFAULT NULL COMMENT 'نوع ویجت (مانند slider, card, list)',
  `widget_config` text DEFAULT NULL COMMENT 'تنظیمات ویجت به صورت JSON'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_content`
--

INSERT INTO `blog_content` (`id`, `field_key`, `content`, `language_id`, `is_repeatable`, `section_id`, `sort_order`, `image_path`, `created_at`, `updated_at`, `is_visible`, `widget_type`, `widget_config`) VALUES
(1, 'header_title', 'آخرین اخبار و مقالات ', 'fa', 0, 'header', 1, NULL, '2025-03-29 11:03:27', '2025-03-30 13:05:33', 1, NULL, NULL),
(2, 'header_subtitle', 'آخرین اخبار و مقالات مجتمع آموزشی سلمان فارسی', 'fa', 0, 'header', 2, NULL, '2025-03-29 11:03:27', '2025-03-29 11:03:27', 1, NULL, NULL),
(3, 'featured_section_title', 'مطلب ویژه', 'fa', 0, 'featured', 1, NULL, '2025-03-29 11:03:27', '2025-03-29 11:03:27', 1, NULL, NULL),
(4, 'latest_section_title', 'آخرین مطالب', 'fa', 0, 'latest', 1, NULL, '2025-03-29 11:03:27', '2025-03-29 11:03:27', 1, NULL, NULL),
(5, 'search_placeholder', 'جستجو در مطالب...', 'fa', 0, 'search', 1, NULL, '2025-03-29 11:03:27', '2025-03-29 11:03:27', 1, NULL, NULL),
(6, 'no_results_title', 'نتیجه‌ای یافت نشد', 'fa', 0, 'no_results', 1, NULL, '2025-03-29 11:03:27', '2025-03-29 11:03:27', 1, NULL, NULL),
(7, 'no_results_text', 'متأسفانه هیچ مطلبی با معیارهای جستجوی شما یافت نشد.', 'fa', 0, 'no_results', 2, NULL, '2025-03-29 11:03:27', '2025-03-29 11:03:27', 1, NULL, NULL),
(8, 'header_title', 'Latest News & Articles', 'en', 0, 'header', 1, NULL, '2025-03-29 11:03:27', '2025-03-29 11:03:27', 1, NULL, NULL),
(9, 'header_subtitle', 'Latest news and articles from Salman Farsi Educational Complex', 'en', 0, 'header', 2, NULL, '2025-03-29 11:03:27', '2025-03-29 11:03:27', 1, NULL, NULL),
(10, 'featured_section_title', 'Featured Article', 'en', 0, 'featured', 1, NULL, '2025-03-29 11:03:27', '2025-03-29 11:03:27', 1, NULL, NULL),
(11, 'latest_section_title', 'Latest Articles', 'en', 0, 'latest', 1, NULL, '2025-03-29 11:03:27', '2025-03-29 11:03:27', 1, NULL, NULL),
(12, 'search_placeholder', 'Search articles...', 'en', 0, 'search', 1, NULL, '2025-03-29 11:03:27', '2025-03-29 11:03:27', 1, NULL, NULL),
(13, 'no_results_title', 'No Results Found', 'en', 0, 'no_results', 1, NULL, '2025-03-29 11:03:27', '2025-03-29 11:03:27', 1, NULL, NULL),
(14, 'no_results_text', 'Sorry, no articles match your search criteria.', 'en', 0, 'no_results', 2, NULL, '2025-03-29 11:03:27', '2025-03-29 11:03:27', 1, NULL, NULL),
(15, 'header_title', 'أحدث الأخبار والمقالات', 'ar', 0, 'header', 1, NULL, '2025-03-29 11:03:27', '2025-03-29 11:03:27', 1, NULL, NULL),
(16, 'header_subtitle', 'أحدث الأخبار والمقالات من مجمع سلمان الفارسي التعليمي', 'ar', 0, 'header', 2, NULL, '2025-03-29 11:03:27', '2025-03-29 11:03:27', 1, NULL, NULL),
(17, 'featured_section_title', 'مقال مميز', 'ar', 0, 'featured', 1, NULL, '2025-03-29 11:03:27', '2025-03-29 11:03:27', 1, NULL, NULL),
(18, 'latest_section_title', 'أحدث المقالات', 'ar', 0, 'latest', 1, NULL, '2025-03-29 11:03:27', '2025-03-29 11:03:27', 1, NULL, NULL),
(19, 'search_placeholder', 'البحث في المقالات...', 'ar', 0, 'search', 1, NULL, '2025-03-29 11:03:27', '2025-03-29 11:03:27', 1, NULL, NULL),
(20, 'no_results_title', 'لم يتم العثور على نتائج', 'ar', 0, 'no_results', 1, NULL, '2025-03-29 11:03:27', '2025-03-29 11:03:27', 1, NULL, NULL),
(21, 'no_results_text', 'عذراً، لا توجد مقالات تطابق معايير البحث الخاصة بك.', 'ar', 0, 'no_results', 2, NULL, '2025-03-29 11:03:27', '2025-03-29 11:03:27', 1, NULL, NULL),
(22, 'search_visible', '0', 'fa', 0, 'widgets', 1, NULL, '2025-03-30 13:01:07', '2025-03-30 13:27:34', 1, NULL, NULL),
(23, 'latest_posts_visible', '0', 'fa', 0, 'widgets', 2, NULL, '2025-03-30 13:01:07', '2025-03-30 13:27:34', 1, NULL, NULL),
(24, 'categories_visible', '1', 'fa', 0, 'widgets', 3, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(25, 'popular_posts_visible', '1', 'fa', 0, 'widgets', 4, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(26, 'search_order', '1', 'fa', 0, 'widgets', 5, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(27, 'latest_posts_order', '2', 'fa', 0, 'widgets', 6, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(28, 'categories_order', '3', 'fa', 0, 'widgets', 7, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(29, 'popular_posts_order', '4', 'fa', 0, 'widgets', 8, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(30, 'read_more_text', 'ادامه مطلب', 'fa', 0, 'buttons', 1, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(31, 'search_button_text', 'جستجو', 'fa', 0, 'buttons', 2, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(32, 'view_all_button', 'مشاهده همه مطالب', 'fa', 0, 'buttons', 3, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(33, 'views_text', 'بازدید', 'fa', 0, 'meta', 1, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(34, 'read_more_text', 'Read More', 'en', 0, 'buttons', 1, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(35, 'search_button_text', 'Search', 'en', 0, 'buttons', 2, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(36, 'view_all_button', 'View All Posts', 'en', 0, 'buttons', 3, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(37, 'views_text', 'Views', 'en', 0, 'meta', 1, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(38, 'read_more_text', 'اقرأ المزيد', 'ar', 0, 'buttons', 1, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(39, 'search_button_text', 'بحث', 'ar', 0, 'buttons', 2, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(40, 'view_all_button', 'عرض جميع المقالات', 'ar', 0, 'buttons', 3, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(41, 'views_text', 'مشاهدات', 'ar', 0, 'meta', 1, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(42, 'sidebar_search_title', 'جستجو', 'fa', 0, 'widget_titles', 1, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(43, 'sidebar_latest_title', 'آخرین مطالب', 'fa', 0, 'widget_titles', 2, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(44, 'sidebar_categories_title', 'دسته‌بندی‌ها', 'fa', 0, 'widget_titles', 3, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(45, 'sidebar_popular_title', 'مطالب پربازدید', 'fa', 0, 'widget_titles', 4, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(46, 'uncategorized', 'دسته‌بندی نشده', 'fa', 0, 'categories', 1, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(47, 'sidebar_search_title', 'Search', 'en', 0, 'widget_titles', 1, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(48, 'sidebar_latest_title', 'Latest Posts', 'en', 0, 'widget_titles', 2, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(49, 'sidebar_categories_title', 'Categories', 'en', 0, 'widget_titles', 3, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(50, 'sidebar_popular_title', 'Popular Articles', 'en', 0, 'widget_titles', 4, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(51, 'uncategorized', 'Uncategorized', 'en', 0, 'categories', 1, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(52, 'sidebar_search_title', 'بحث', 'ar', 0, 'widget_titles', 1, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(53, 'sidebar_latest_title', 'أحدث المقالات', 'ar', 0, 'widget_titles', 2, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(54, 'sidebar_categories_title', 'التصنيفات', 'ar', 0, 'widget_titles', 3, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(55, 'sidebar_popular_title', 'المقالات الشائعة', 'ar', 0, 'widget_titles', 4, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(56, 'uncategorized', 'غير مصنف', 'ar', 0, 'categories', 1, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(57, 'category_posts', 'مطالب دسته‌بندی', 'fa', 0, 'search', 1, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(58, 'search_results', 'نتایج جستجو', 'fa', 0, 'search', 2, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(59, 'no_posts', 'مطلبی یافت نشد', 'fa', 0, 'search', 3, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(60, 'no_posts_yet', 'هنوز مطلبی در این بخش منتشر نشده است.', 'fa', 0, 'search', 4, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(61, 'no_search_results', 'متاسفانه هیچ نتیجه‌ای برای جستجوی شما یافت نشد:', 'fa', 0, 'search', 5, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(62, 'category_posts', 'Category Posts', 'en', 0, 'search', 1, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(63, 'search_results', 'Search Results', 'en', 0, 'search', 2, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(64, 'no_posts', 'No Posts Found', 'en', 0, 'search', 3, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(65, 'no_posts_yet', 'No posts have been published in this section yet.', 'en', 0, 'search', 4, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(66, 'no_search_results', 'Sorry, no results found for your search:', 'en', 0, 'search', 5, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(67, 'category_posts', 'منشورات التصنيف', 'ar', 0, 'search', 1, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(68, 'search_results', 'نتائج البحث', 'ar', 0, 'search', 2, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(69, 'no_posts', 'لم يتم العثور على منشورات', 'ar', 0, 'search', 3, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(70, 'no_posts_yet', 'لم يتم نشر أي منشورات في هذا القسم بعد.', 'ar', 0, 'search', 4, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL),
(71, 'no_search_results', 'عذراً، لم يتم العثور على نتائج لبحثك:', 'ar', 0, 'search', 5, NULL, '2025-03-30 13:01:07', '2025-03-30 13:01:07', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bus_routes`
--

CREATE TABLE `bus_routes` (
  `route_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus_routes`
--

INSERT INTO `bus_routes` (`route_id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7);

-- --------------------------------------------------------

--
-- Table structure for table `bus_route_translations`
--

CREATE TABLE `bus_route_translations` (
  `route_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `route_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus_route_translations`
--

INSERT INTO `bus_route_translations` (`route_id`, `language_id`, `route_name`, `description`) VALUES
(1, 1, 'مسیر ۱', 'قافیه - مدرسه شارجه - میدان اول التعاون - المتینه - بازار قدیم - بازار ایرانی - بانک صادرات - بانک ملی - خیابان شاه فیصل - المجاز - القصبا - الرولا - ام خنور - المجاز ۱ و ۲، شارجه'),
(1, 2, 'Route 1', 'Qafiya - Sharjah School - First Al Taawun Roundabout - Al Muteena - Old Market - Iranian Bazaar - Export Bank - National Bank - King Faisal Road - Al Majaz - Al Qasba - Al Rolla - Umm Khanour - Al Majaz 1 & 2, Sharjah'),
(1, 3, 'المسار ١', 'القافية - مدرسة الشارقة - دوار التعاون الأول - المتينة - السوق القديم - البازار الإيراني - بنك التصدير - البنك الوطني - شارع الملك فيصل - المجاز - القصباء - الرولة - أم خنور - المجاز 1 و2، الشارقة'),
(2, 1, 'مسیر ۲', 'خیابان اصلی منطقه صنعتی - الروضه ۱ و ۲ - الحمیدیه - المویهات - الجرف - جاده شیخ بن زاید - الیاسمین - خان صاحب'),
(2, 2, 'Route 2', 'Industrial Area Main Street - Al Rawda 1 & 2 - Al Hamidiya - Al Mowaihat - Al Jurf - Sheikh Bin Zayed Road - Al Yasmeen - Khansaheb'),
(2, 3, 'المسار ٢', 'المنطقة الصناعية - الروضة 1 و2 - الحميدية - المويهات - الجرف - شارع الشيخ بن زايد - الياسمين - خانصاحب'),
(3, 1, 'مسیر ۳', 'عجمان، بیمارستان GMC - تقاطع کویت - النعیمیه ۲ و ۳ - بازارهای العین - کورنیش - الرشیدیه - بازار ماهی - برج‌های الخور - منطقه الکرامه - پارک مشیرف، عجمان'),
(3, 2, 'Route 3', 'Ajman, GMC Hospital - Kuwait Junction - Al Nuaimiya 2 & 3 - Al Ain Markets - Al Corniche - Al Rashidiya - Fish Market - Al Khor Towers - Al Karama Area - Mushairif Park, Ajman'),
(3, 3, 'المسار ٣', 'عجمان - مستشفى GMC - تقاطع الكويت - النعيمية 2 و3 - أسواق العين - الكورنيش - الرشيدية - سوق السمك - أبراج الخور - منطقة الكرامة - حديقة مشيرف'),
(4, 1, 'مسیر ۴', 'الصفا - مردیف - الرشیدیه - ند الحمر - الورقاء - عود المتینه - محیصنه ۲ - القصیص - مردیف سیتی'),
(4, 2, 'Route 4', 'Al Safa - Mirdif - Al Rashidiya - Nad Al Hamar - Al Warqa - Oud Al Muteena - Muhaisnah 2 - Al Qusais - Mirdif City'),
(4, 3, 'المسار ٤', 'الصفا - مردف - الرشيدية - ند الحمر - الورقاء - عود المتينة - محيصنة 2 - القصيص - مردف سيتي'),
(5, 1, 'مسیر ۵', 'بر دبی - المنخول - مصلی نزدیک قبرستان - مینا بازار - بندر راشد - تقاطع جافلیه - جاده ستوه - تقاطع الوصل - القوز ۲ و ۴ - پشت اسپینیس، جمیرا'),
(5, 2, 'Route 5', 'Bur Dubai - Al Mankhool - Musalla near Cemetery - Meena Bazaar - Port Rashid - Jafliya Junction - Satwa Road - Al Wasl Junction - Al Quoz 2 & 4 - Behind Spinneys, Jumeirah'),
(5, 3, 'المسار ٥', 'بر دبي - المنخول - المصلى بجوار المقبرة - سوق المينا - ميناء راشد - تقاطع الجافلية - شارع السطوة - تقاطع الوصل - القوز 2 و4 - خلف سبينيس، جميرا'),
(6, 1, 'مسیر ۶', 'پارک النهضه، شارجه - خیابان اصلی التعاون - انصار مال - النهضه شارجه ۲ - مرکز صحارا - پشت اتصالات النهضه - پشت انصار مال'),
(6, 2, 'Route 6', 'Al Nahda Park, Sharjah - Main Street Al Taawun - Ansar Mall - Al Nahda Sharjah 2 - Sahara Centre - Behind Etisalat Al Nahda - Behind Ansar Mall'),
(6, 3, 'المسار ٦', 'حديقة النهضة، الشارقة - شارع التعاون الرئيسي - أنصار مول - النهضة الشارقة 2 - مركز صحارى - خلف اتصالات النهضة - خلف أنصار مول'),
(7, 1, 'مسیر ۷', 'ابوهیل - هور العنز - المتینه - میدان ماهی - نایف - الکرامه - الحمریه - الراس - النهضه ۲، دبی'),
(7, 2, 'Route 7', 'Abu Hail - Hor Al Anz - Al Muteena - Fish Roundabout - Naif - Al Karama - Al Hamriya - Al Ras - Al Nahda 2, Dubai'),
(7, 3, 'المسار ٧', 'أبو هيل - هور العنز - المتينة - دوار السمك - نايف - الكرامة - الحمرية - الرأس - النهضة 2، دبي');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `parent_id`) VALUES
(1, NULL),
(2, NULL),
(3, NULL),
(4, NULL),
(5, NULL),
(6, NULL),
(7, NULL),
(8, NULL),
(9, NULL),
(10, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_translations`
--

CREATE TABLE `category_translations` (
  `category_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('pending','published') DEFAULT 'published'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_translations`
--

INSERT INTO `category_translations` (`category_id`, `language_id`, `name`, `description`, `status`) VALUES
(1, 1, 'اخبار و اطلاعیه‌ها', 'جدیدترین اخبار مدرسه، اطلاعیه‌های مهم و تغییرات برنامه‌ها.', 'published'),
(1, 2, 'News and Announcements', 'Latest school news, important announcements, and schedule changes.', 'published'),
(1, 3, 'الأخبار والإعلانات', 'أحدث أخبار المدرسة، الإعلانات الهامة، وتغييرات الجداول.', 'published'),
(2, 1, 'فعالیت‌های آموزشی', 'اطلاعات درباره برنامه‌های آموزشی، کارگاه‌ها و فعالیت‌های کلاسی.', 'published'),
(2, 2, 'Educational Activities', 'Information about educational programs, workshops, and class activities.', 'published'),
(2, 3, 'الأنشطة التعليمية', 'معلومات عن البرامج التعليمية، ورش العمل، والأنشطة الصفية.', 'published'),
(3, 1, 'برنامه‌های فرهنگی', 'رویدادها، جشن‌ها و مناسبت‌های فرهنگی برگزار شده در مدرسه.', 'published'),
(3, 2, 'Cultural Programs', 'Events, celebrations, and cultural occasions held at school.', 'published'),
(3, 3, 'البرامج الثقافية', 'الفعاليات، الاحتفالات، والمناسبات الثقافية التي تقام في المدرسة.', 'published'),
(4, 1, 'برنامه‌های ورزشی', 'مسابقات، تمرین‌ها و برنامه‌های ورزشی دانش‌آموزان.', 'published'),
(4, 2, 'Sports Programs', 'Competitions, training, and students’ sports programs.', 'published'),
(4, 3, 'البرامج الرياضية', 'المسابقات، التمارين، وبرامج الطلاب الرياضية.', 'published'),
(5, 1, 'اردوها و بازدیدها', 'گزارش اردوهای علمی، فرهنگی و بازدیدهای آموزشی.', 'published'),
(5, 2, 'Field Trips and Visits', 'Reports on scientific, cultural, and educational trips.', 'published'),
(5, 3, 'الرحلات والزيارات', 'تقارير عن الرحلات العلمية والثقافية والزيارات التعليمية.', 'published'),
(6, 1, 'موفقیت‌های دانش‌آموزان', 'افتخارات، جوایز و موفقیت‌های علمی یا هنری دانش‌آموزان.', 'published'),
(6, 2, 'Student Achievements', 'Honors, awards, and academic or artistic achievements of students.', 'published'),
(6, 3, 'إنجازات الطلاب', 'الجوائز، التكريمات، والإنجازات الأكاديمية أو الفنية للطلاب.', 'published'),
(7, 1, 'خدمات درمانی و پزشکی', 'اطلاع‌رسانی درباره خدمات درمانی، واکسیناسیون و سلامت.', 'published'),
(7, 2, 'Medical and Health Services', 'Announcements about medical services, vaccinations, and health updates.', 'published'),
(7, 3, 'الخدمات الطبية والصحية', 'إعلانات عن الخدمات الطبية، التطعيمات، وتحديثات الصحة.', 'published'),
(8, 1, 'جشن فارغ‌التحصیلی', 'اطلاعات و تصاویر مربوط به جشن‌های فارغ‌التحصیلی.', 'published'),
(8, 2, 'Graduation Ceremony', 'Information and photos related to graduation ceremonies.', 'published'),
(8, 3, 'حفل التخرج', 'معلومات وصور متعلقة بحفلات التخرج.', 'published'),
(9, 1, 'خانواده و جامعه', 'برنامه‌ها و مقالات مرتبط با نقش والدین و جامعه در آموزش.', 'published'),
(9, 2, 'Family and Community', 'Programs and articles about the role of parents and community in education.', 'published'),
(9, 3, 'الأسرة والمجتمع', 'البرامج والمقالات حول دور الأسرة والمجتمع في التعليم.', 'published'),
(10, 1, 'گالری و رسانه', 'تصاویر، ویدیوها و محتوای رسانه‌ای فعالیت‌های مدرسه.', 'published'),
(10, 2, 'Gallery and Media', 'Photos, videos, and media content from school activities.', 'published'),
(10, 3, 'المعرض والوسائط', 'الصور، الفيديوهات، والمحتوى الإعلامي لأنشطة المدرسة.', 'published');

-- --------------------------------------------------------

--
-- Table structure for table `chatbot_messages`
--

CREATE TABLE `chatbot_messages` (
  `message_id` int(11) NOT NULL,
  `session_id` varchar(64) NOT NULL,
  `sender` enum('user','bot') NOT NULL,
  `message` text NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chatbot_messages`
--

INSERT INTO `chatbot_messages` (`message_id`, `session_id`, `sender`, `message`, `sent_at`) VALUES
(1, 'ABC123', 'user', 'سلام! چگونه ثبت‌نام کنم؟', '2025-03-27 12:27:04'),
(2, 'ABC123', 'bot', 'برای ثبت‌نام، لطفاً فرم مخصوص را تکمیل کنید.', '2025-03-27 12:27:04');

-- --------------------------------------------------------

--
-- Table structure for table `contact_content`
--

CREATE TABLE `contact_content` (
  `id` int(11) NOT NULL,
  `field_key` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `language_id` int(11) NOT NULL,
  `is_repeatable` tinyint(1) NOT NULL DEFAULT 0,
  `section_id` varchar(50) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_content`
--

INSERT INTO `contact_content` (`id`, `field_key`, `content`, `language_id`, `is_repeatable`, `section_id`, `sort_order`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 'page_title', 'تماس با ما', 1, 0, 'header', 0, NULL, '2025-03-28 19:16:10', '2025-03-29 14:39:38'),
(2, 'page_subtitle', 'ما مشتاقانه منتظر شنیدن صدای شما هستیم. با ما در ارتباط باشید.', 1, 0, 'header', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(3, 'form_title', 'پیام خود را بنویسید', 1, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(4, 'form_subtitle', 'با ما در تماس باشید. ما در اسرع وقت به شما پاسخ خواهیم داد.', 1, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(5, 'fullname_label', 'نام و نام خانوادگی', 1, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(6, 'fullname_placeholder', 'نام خود را وارد کنید', 1, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(7, 'email_label', 'ایمیل', 1, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(8, 'email_placeholder', 'ایمیل خود را وارد کنید', 1, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(9, 'phone_label', 'شماره تماس', 1, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(10, 'phone_placeholder', 'شماره تماس خود را وارد کنید', 1, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(11, 'subject_label', 'موضوع', 1, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(12, 'subject_placeholder', 'موضوع پیام خود را وارد کنید', 1, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(13, 'message_label', 'پیام شما', 1, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(14, 'message_placeholder', 'پیام خود را بنویسید...', 1, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(15, 'submit_button', 'ارسال پیام', 1, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(16, 'contact_info_title', 'اطلاعات تماس', 1, 0, 'info', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(17, 'contact_info_subtitle', 'راه‌های ارتباطی مجتمع آموزشی سلمان', 1, 0, 'info', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(18, 'address_label', 'آدرس ما', 1, 0, 'info', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(19, 'phone_info_label', 'تلفن تماس', 1, 0, 'info', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(20, 'email_info_label', 'ایمیل', 1, 0, 'info', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(21, 'hours_label', 'ساعات کاری', 1, 0, 'info', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(22, 'hours_value', 'دوشنبه تا پنج‌شنبه: ۷:۰۰ صبح تا ۲:۰۰ بعد از ظهر\nجمعه: ۷:۰۰ صبح تا ۱۲:۰۰ ظهر', 1, 0, 'info', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(23, 'map_title', 'مجتمع آموزشی سلمان فارسی', 1, 0, 'map', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(24, 'map_description', 'مجتمع آموزشی سلمان فارسی در منطقه القصیص دبی واقع شده است. ما مشتاقانه منتظر دیدار شما هستیم.', 1, 0, 'map', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(25, 'get_directions', 'دریافت مسیر', 1, 0, 'map', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(26, 'success_title', 'پیام با موفقیت ارسال شد', 1, 0, 'modal', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(27, 'success_message', 'پیام شما با موفقیت ارسال شد. به زودی با شما تماس خواهیم گرفت.', 1, 0, 'modal', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(28, 'error_title', 'خطا در ارسال پیام', 1, 0, 'modal', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(29, 'error_message', 'خطایی در ارسال پیام رخ داد. لطفا دوباره تلاش کنید.', 1, 0, 'modal', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(30, 'system_error_title', 'خطای سیستمی', 1, 0, 'modal', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(31, 'system_error_message', 'خطای سیستمی رخ داده است. لطفا بعدا دوباره تلاش کنید.', 1, 0, 'modal', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(32, 'connection_error_title', 'خطای اتصال', 1, 0, 'modal', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(33, 'connection_error_message', 'خطا در ارتباط با سرور. لطفا اتصال اینترنت خود را بررسی کنید و دوباره تلاش کنید.', 1, 0, 'modal', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(34, 'modal_button', 'متوجه شدم', 1, 0, 'modal', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(35, 'page_title', 'Contact Us', 2, 0, 'header', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(36, 'page_subtitle', 'We\'d love to hear from you. Get in touch with us.', 2, 0, 'header', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(37, 'form_title', 'Send Us a Message', 2, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(38, 'form_subtitle', 'Get in touch with us. We\'ll respond as soon as possible.', 2, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(39, 'fullname_label', 'Full Name', 2, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(40, 'fullname_placeholder', 'Enter your name', 2, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(41, 'email_label', 'Email Address', 2, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(42, 'email_placeholder', 'Enter your email', 2, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(43, 'phone_label', 'Phone Number', 2, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(44, 'phone_placeholder', 'Enter your phone number', 2, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(45, 'subject_label', 'Subject', 2, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(46, 'subject_placeholder', 'Enter message subject', 2, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(47, 'message_label', 'Your Message', 2, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(48, 'message_placeholder', 'Write your message here...', 2, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(49, 'submit_button', 'Send Message', 2, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(50, 'contact_info_title', 'Contact Information', 2, 0, 'info', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(51, 'contact_info_subtitle', 'Ways to reach Salman Educational Complex', 2, 0, 'info', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(52, 'address_label', 'Our Address', 2, 0, 'info', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(53, 'phone_info_label', 'Phone Number', 2, 0, 'info', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(54, 'email_info_label', 'Email Address', 2, 0, 'info', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(55, 'hours_label', 'Working Hours', 2, 0, 'info', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(56, 'hours_value', 'Monday to Thursday: 7:00 AM to 2:00 PM\nFriday: 7:00 AM to 12:00 PM', 2, 0, 'info', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(57, 'map_title', 'Salman Farsi Educational Complex', 2, 0, 'map', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(58, 'map_description', 'Salman Farsi Educational Complex is located in Al Qusais area of Dubai. We look forward to welcoming you.', 2, 0, 'map', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(59, 'get_directions', 'Get Directions', 2, 0, 'map', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(60, 'success_title', 'Message Sent Successfully', 2, 0, 'modal', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(61, 'success_message', 'Your message has been sent successfully. We will contact you soon.', 2, 0, 'modal', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(62, 'error_title', 'Message Sending Failed', 2, 0, 'modal', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(63, 'error_message', 'An error occurred while sending your message. Please try again.', 2, 0, 'modal', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(64, 'system_error_title', 'System Error', 2, 0, 'modal', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(65, 'system_error_message', 'A system error occurred. Please try again later.', 2, 0, 'modal', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(66, 'connection_error_title', 'Connection Error', 2, 0, 'modal', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(67, 'connection_error_message', 'Error connecting to server. Please check your internet connection and try again.', 2, 0, 'modal', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(68, 'modal_button', 'Got it', 2, 0, 'modal', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(69, 'page_title', 'اتصل بنا', 3, 0, 'header', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(70, 'page_subtitle', 'نود أن نسمع منك. تواصل معنا.', 3, 0, 'header', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(71, 'form_title', 'أرسل لنا رسالة', 3, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(72, 'form_subtitle', 'تواصل معنا. سنرد في أقرب وقت ممكن.', 3, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(73, 'fullname_label', 'الاسم الكامل', 3, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(74, 'fullname_placeholder', 'أدخل اسمك', 3, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(75, 'email_label', 'البريد الإلكتروني', 3, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(76, 'email_placeholder', 'أدخل بريدك الإلكتروني', 3, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(77, 'phone_label', 'رقم الهاتف', 3, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(78, 'phone_placeholder', 'أدخل رقم هاتفك', 3, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(79, 'subject_label', 'الموضوع', 3, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(80, 'subject_placeholder', 'أدخل موضوع الرسالة', 3, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(81, 'message_label', 'رسالتك', 3, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(82, 'message_placeholder', 'اكتب رسالتك هنا...', 3, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(83, 'submit_button', 'إرسال الرسالة', 3, 0, 'form', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(84, 'contact_info_title', 'معلومات الاتصال', 3, 0, 'info', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(85, 'contact_info_subtitle', 'طرق الوصول إلى مجمع سلمان التعليمي', 3, 0, 'info', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(86, 'address_label', 'عنواننا', 3, 0, 'info', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(87, 'phone_info_label', 'رقم الهاتف', 3, 0, 'info', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(88, 'email_info_label', 'البريد الإلكتروني', 3, 0, 'info', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(89, 'hours_label', 'ساعات العمل', 3, 0, 'info', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(90, 'hours_value', 'الاثنين إلى الخميس: 7:00 صباحًا إلى 2:00 مساءً\nالجمعة: 7:00 صباحًا إلى 12:00 ظهرًا', 3, 0, 'info', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(91, 'map_title', 'مجمع سلمان الفارسي التعليمي', 3, 0, 'map', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(92, 'map_description', 'يقع مجمع سلمان الفارسي التعليمي في منطقة القصيص بدبي. نتطلع إلى الترحيب بكم.', 3, 0, 'map', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(93, 'get_directions', 'الحصول على الاتجاهات', 3, 0, 'map', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(94, 'success_title', 'تم إرسال الرسالة بنجاح', 3, 0, 'modal', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(95, 'success_message', 'تم إرسال رسالتك بنجاح. سنتصل بك قريباً.', 3, 0, 'modal', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(96, 'error_title', 'فشل إرسال الرسالة', 3, 0, 'modal', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(97, 'error_message', 'حدث خطأ أثناء إرسال رسالتك. يرجى المحاولة مرة أخرى.', 3, 0, 'modal', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(98, 'system_error_title', 'خطأ في النظام', 3, 0, 'modal', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(99, 'system_error_message', 'حدث خطأ في النظام. يرجى المحاولة مرة أخرى لاحقاً.', 3, 0, 'modal', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(100, 'connection_error_title', 'خطأ في الاتصال', 3, 0, 'modal', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(101, 'connection_error_message', 'خطأ في الاتصال بالخادم. يرجى التحقق من اتصال الإنترنت والمحاولة مرة أخرى.', 3, 0, 'modal', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(102, 'modal_button', 'فهمت', 3, 0, 'modal', 0, NULL, '2025-03-28 19:16:10', '2025-03-28 19:16:10'),
(103, 'address', 'Al Qusais - Al Qusais 1 - Dubai', 2, 0, 'info', 0, NULL, '2025-04-01 21:31:56', '2025-04-01 21:31:56'),
(104, 'address', 'دبی - القصیص - القصیص ۱', 1, 0, 'info', 0, NULL, '2025-04-01 21:31:56', '2025-04-01 21:31:56'),
(105, 'address', 'دبي - القصيص - القصيص ١', 3, 0, 'info', 0, NULL, '2025-04-01 21:31:56', '2025-04-01 21:31:56');

-- --------------------------------------------------------

--
-- Table structure for table `contact_info`
--

CREATE TABLE `contact_info` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `value` varchar(255) NOT NULL,
  `icon_class` varchar(50) NOT NULL,
  `language_id` varchar(5) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_info`
--

INSERT INTO `contact_info` (`id`, `type`, `value`, `icon_class`, `language_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'email', 'info@ir-salmanfarsi.com', 'fas fa-envelope', 'en', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(2, 'phone', '+971 4 298 811 6', 'fas fa-phone-alt', 'en', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(3, 'email', 'info@ir-salmanfarsi.com', 'fas fa-envelope', 'fa', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(4, 'phone', '۹۷۱+ ۴ ۲۹۸ ۸۱۱ ۶', 'fas fa-phone-alt', 'fa', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(5, 'email', 'info@ir-salmanfarsi.com', 'fas fa-envelope', 'ar', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(6, 'phone', '+971 4 298 811 6', 'fas fa-phone-alt', 'ar', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `language` varchar(10) DEFAULT 'fa',
  `status` enum('new','read','replied','archived') DEFAULT 'new',
  `admin_notes` text DEFAULT NULL,
  `submit_date` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `phone`, `subject`, `message`, `ip_address`, `user_agent`, `language`, `status`, `admin_notes`, `submit_date`, `last_update`) VALUES
(1, 'Rajah Rose', 'tysawe@mailinator.com', '+1 (843) 262-2446', 'Ut tempora a minima', 'Dolor et qui et aliq', NULL, NULL, 'fa', 'new', NULL, '2025-03-28 20:59:44', '2025-03-28 19:59:44'),
(2, 'Kaitlin Schultz', 'miky@mailinator.com', '+1 (313) 492-8283', 'Commodo rerum quidem', 'Minus aute amet qui', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:136.0) Gecko/20100101 Firefox/136.0', 'fa', 'new', NULL, '2025-03-29 19:21:14', '2025-03-29 15:21:14'),
(3, 'Hammett Wilkins', 'pokakyqama@mailinator.com', '+1 (112) 648-8842', 'Ad laborum nihil ill', 'In sint ab magni eu', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:136.0) Gecko/20100101 Firefox/136.0', 'fa', 'new', NULL, '2025-03-29 19:21:23', '2025-03-29 15:21:23'),
(4, 'Axel Cherry', 'suse@mailinator.com', '+1 (268) 696-1645', 'A id qui qui minima', 'Ad esse pariatur Vo', NULL, NULL, 'fa', 'new', NULL, '2025-03-29 21:44:24', '2025-03-29 20:44:24'),
(5, 'Amity Dickerson', 'pehesa@mailinator.com', '+1 (234) 217-7106', 'Aut sed sunt quis ex', 'Vero officia sed acc', NULL, NULL, 'fa', 'new', NULL, '2025-03-29 21:47:28', '2025-03-29 20:47:28'),
(6, 'Cyrus Stewart', 'mygy@mailinator.com', '+1 (313) 258-6722', 'Assumenda id repelle', 'A est quisquam recu', NULL, NULL, 'fa', 'new', NULL, '2025-03-29 21:48:37', '2025-03-29 20:48:37'),
(7, 'Cheyenne Duffy', 'fexagivof@mailinator.com', '+1 (505) 296-6318', 'Fugiat elit est fug', 'Magni debitis dddaut', NULL, NULL, 'fa', 'new', NULL, '2025-03-29 21:48:51', '2025-03-29 20:48:51'),
(8, 'Amir Bray', 'kybipe@mailinator.com', '+1 (489) 168-1964', 'Quaerat sed et aut v', 'Nemo ipsa nobis mod', NULL, NULL, 'fa', 'new', NULL, '2025-04-01 23:18:24', '2025-04-01 21:18:24'),
(9, 'Carla Downs', 'javymeco@mailinator.com', '+1 (454) 264-1681', 'Veniam praesentium', 'Debitis qui eius et', NULL, NULL, 'fa', 'new', NULL, '2025-04-01 23:29:09', '2025-04-01 21:29:09');

-- --------------------------------------------------------

--
-- Table structure for table `curriculum_content`
--

CREATE TABLE `curriculum_content` (
  `id` int(11) NOT NULL,
  `field_key` varchar(255) NOT NULL COMMENT 'کلید شناسایی محتوا',
  `content` text DEFAULT NULL COMMENT 'محتوای اصلی',
  `language_id` varchar(5) NOT NULL COMMENT 'کد زبان (fa, en, ar)',
  `is_repeatable` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'آیا این محتوا تکرارشونده است؟',
  `section_id` varchar(50) DEFAULT NULL COMMENT 'شناسه بخش برای گروه‌بندی',
  `sort_order` int(11) NOT NULL DEFAULT 0 COMMENT 'ترتیب نمایش آیتم‌های تکرارشونده',
  `image_path` varchar(255) DEFAULT NULL COMMENT 'مسیر فایل تصویر',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `curriculum_content`
--

INSERT INTO `curriculum_content` (`id`, `field_key`, `content`, `language_id`, `is_repeatable`, `section_id`, `sort_order`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 'page_title', 'برنامه آموزشی مجتمع سلمان فارسی', 'fa', 0, 'header', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:20:00'),
(2, 'page_title', 'Salman Farsi Educational Curriculum', 'en', 0, 'header', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(3, 'page_title', 'منهج سلمان الفارسي التعليمي', 'ar', 0, 'header', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(4, 'page_subtitle', 'برنامه آموزشی جامع و پیشرفته، با تمرکز بر پرورش استعدادها و آماده‌سازی دانش‌آموزان برای آینده‌ای درخشان', 'fa', 0, 'header', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(5, 'page_subtitle', 'Comprehensive and advanced curriculum focused on nurturing talents and preparing students for a bright future', 'en', 0, 'header', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(6, 'page_subtitle', 'منهج شامل ومتقدم يركز على تنمية المواهب وإعداد الطلاب لمستقبل مشرق', 'ar', 0, 'header', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(7, 'ehsan_section_label', 'بخش احسان', 'fa', 0, 'ehsan', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(8, 'ehsan_section_label', 'EHSAN SECTION', 'en', 0, 'ehsan', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(9, 'ehsan_section_label', 'قسم إحسان', 'ar', 0, 'ehsan', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(10, 'ehsan_badge', 'برای دانش‌آموزان با نیازهای ویژه', 'fa', 0, 'ehsan', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(11, 'ehsan_badge', 'For Students with Special Needs', 'en', 0, 'ehsan', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(12, 'ehsan_badge', 'للطلاب ذوي الاحتياجات الخاصة', 'ar', 0, 'ehsan', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(13, 'ehsan_title', 'احسان؛ جایی که هر توانایی مسیر خود را پیدا می‌کند', 'fa', 0, 'ehsan', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(14, 'ehsan_title', 'Ehsan – Where Every Ability Finds Its Path', 'en', 0, 'ehsan', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(15, 'ehsan_title', 'إحسان - حيث تجد كل قدرة مسارها', 'ar', 0, 'ehsan', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(16, 'ehsan_description', 'از سال 2008، احسان در مجتمع آموزشی سلمان فارسی محیطی گرم و پذیرا برای دانش‌آموزان با نیازهای ویژه فراهم کرده است. با بهره‌گیری از حمایت تخصصی و رویکردی دلسوزانه، ما هر دانش‌آموز را توانمند می‌سازیم تا استعدادهای خود را شکوفا کند و آینده‌ای روشن‌تر بسازد.', 'fa', 0, 'ehsan', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(17, 'ehsan_description', 'Since 2008, Ehsan at the Salman Farsi Educational Complex has been a welcoming space for Students of Determination. Through expert support and a nurturing approach, we empower every student to unlock their potential and shape a brighter future.', 'en', 0, 'ehsan', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(18, 'ehsan_description', 'منذ عام 2008 ، كان إحسان في مجمع سلمان الفارسي التعليمي مساحة ترحيبية للطلاب ذوي العزيمة. من خلال الدعم الخبير والنهج الراعي ، نمكن كل طالب من إطلاق إمكاناته وتشكيل مستقبل أكثر إشراقًا.', 'ar', 0, 'ehsan', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(19, 'ehsan_feature1_title', 'معلمان متخصص', 'fa', 0, 'ehsan', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(20, 'ehsan_feature1_title', 'Expert Teachers', 'en', 0, 'ehsan', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(21, 'ehsan_feature1_title', 'معلمون خبراء', 'ar', 0, 'ehsan', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(22, 'ehsan_feature1_text', 'تیمی از کارشناسان آموزش و توانبخشی باکیفیت ارائه می‌دهند.', 'fa', 0, 'ehsan', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(23, 'ehsan_feature1_text', 'A team of specialists providing high-quality education and rehabilitation.', 'en', 0, 'ehsan', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(24, 'ehsan_feature1_text', 'فريق من المتخصصين يقدمون تعليمًا وإعادة تأهيل عالية الجودة.', 'ar', 0, 'ehsan', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(25, 'ehsan_feature2_title', 'حمایت جامع', 'fa', 0, 'ehsan', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(26, 'ehsan_feature2_title', 'Comprehensive Support', 'en', 0, 'ehsan', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(27, 'ehsan_feature2_title', 'دعم شامل', 'ar', 0, 'ehsan', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(28, 'ehsan_feature2_text', 'تضمین فرصت‌های برابر برای موفقیت هر دانش‌آموز.', 'fa', 0, 'ehsan', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(29, 'ehsan_feature2_text', 'Ensuring equal opportunities for every student to succeed.', 'en', 0, 'ehsan', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(30, 'ehsan_feature2_text', 'ضمان تكافؤ الفرص لكل طالب للنجاح.', 'ar', 0, 'ehsan', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(31, 'ehsan_button_text', 'بیشتر بخوانید', 'fa', 0, 'ehsan', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(32, 'ehsan_button_text', 'Read More', 'en', 0, 'ehsan', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(33, 'ehsan_button_text', 'اقرأ أكثر', 'ar', 0, 'ehsan', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(34, 'elementary_section_label', 'بخش ابتدایی', 'fa', 0, 'elementary', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(35, 'elementary_section_label', 'ELEMENTARY SECTION', 'en', 0, 'elementary', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(36, 'elementary_section_label', 'القسم الابتدائي', 'ar', 0, 'elementary', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(37, 'elementary_title', 'از پایه‌ای قوی تا موفقیتی درخشان', 'fa', 0, 'elementary', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(38, 'elementary_title', 'From Foundational Excellence To Future Success', 'en', 0, 'elementary', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(39, 'elementary_title', 'من التفوق التأسيسي إلى النجاح المستقبلي', 'ar', 0, 'elementary', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(40, 'elementary_subtitle', 'راهنمایی تخصصی و امکانات پیشرفته', 'fa', 0, 'elementary', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(41, 'elementary_subtitle', 'Expert Guidance and Advanced Facilities', 'en', 0, 'elementary', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(42, 'elementary_subtitle', 'التوجيه الخبير والمرافق المتقدمة', 'ar', 0, 'elementary', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(43, 'elementary_description', 'بخش آموزش ابتدایی (پایه‌های 1 تا 6) شامل دو کلاس در هر پایه است که بر آموزش قوی و برنامه‌های پیشرفته زبانی در عربی و انگلیسی، تدریس‌شده توسط کارشناسان بومی زبان تمرکز دارد. با معلمان باتجربه، روش‌های نوآورانه و کلاس‌های هوشمند، ما تجربه یادگیری جذاب و شخصی‌سازی‌شده‌ای را تضمین می‌کنیم.', 'fa', 0, 'elementary', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(44, 'elementary_description', 'The primary education section (Grades 1 to 6) offers two classes per grade, focusing on strong academics and advanced language programs in Arabic and English taught by native-speaking experts. With experienced teachers, innovative methods, and smart classrooms, we ensure an engaging and personalized learning experience.', 'en', 0, 'elementary', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(45, 'elementary_description', 'يقدم قسم التعليم الابتدائي (الصفوف من 1 إلى 6) فصلين دراسيين لكل صف، مع التركيز على الأكاديميين الأقوياء وبرامج اللغة المتقدمة في اللغتين العربية والإنجليزية التي يدرسها خبراء ناطقون باللغة الأم. مع المعلمين ذوي الخبرة والأساليب المبتكرة والفصول الدراسية الذكية، نضمن تجربة تعليمية جذابة ومخصصة.', 'ar', 0, 'elementary', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(46, 'middle_section_label', 'راهنمایی', 'fa', 0, 'middle', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(47, 'middle_section_label', 'MIDDLE SCHOOL', 'en', 0, 'middle', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(48, 'middle_section_label', 'المدرسة المتوسطة', 'ar', 0, 'middle', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(49, 'middle_title', 'مدرسان بااستعداد، امکانات مدرن و روش‌های پیشرفته', 'fa', 0, 'middle', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(50, 'middle_title', 'Talented Educators, Modern Facilities, And Advanced Methods', 'en', 0, 'middle', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(51, 'middle_title', 'المعلمين الموهوبين والمرافق الحديثة والأساليب المتقدمة', 'ar', 0, 'middle', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(52, 'middle_description1', 'دبیرستان (پایه‌های هفتم تا نهم) در مدرسه سلمان فارسی محیطی مدرن با کلاس‌های هوشمند و معلمان متخصص فراهم می‌آورد. هر پایه دو کلاس دارد که با روش‌های تدریس پیشرفته پشتیبانی می‌شود.', 'fa', 0, 'middle', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(53, 'middle_description1', 'Middle school (grades 7 to 9) at Salman Farsi School offers a modern learning environment with smart classrooms and expert teachers. Each grade has two classes, supported by advanced teaching methods.', 'en', 0, 'middle', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(54, 'middle_description1', 'توفر المدرسة المتوسطة (الصفوف من 7 إلى 9) في مدرسة سلمان الفارسي بيئة تعليمية حديثة مع فصول دراسية ذكية ومعلمين خبراء. كل صف يحتوي على فصلين دراسيين، مدعومين بأساليب تدريس متقدمة.', 'ar', 0, 'middle', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(55, 'middle_description2', 'مدرسه برنامه‌های فوق‌برنامه، آزمایشگاه‌های علمی، امکانات ورزشی و رفاهی ارائه می‌دهد تا دانش‌آموزان هم از نظر علمی و هم شخصی رشد کنند و برای چالش‌های آینده آماده شوند.', 'fa', 0, 'middle', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(56, 'middle_description2', 'The school provides extracurricular programs, science labs, sports facilities, and amenities, ensuring students grow academically and personally while preparing for future challenges.', 'en', 0, 'middle', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(57, 'middle_description2', 'توفر المدرسة برامج خارج المنهج ومختبرات علمية ومرافق رياضية ووسائل راحة، مما يضمن نمو الطلاب أكاديميًا وشخصيًا أثناء الاستعداد للتحديات المستقبلية.', 'ar', 0, 'middle', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(58, 'middle_focus_title', 'تمرکز اصلی: پایداری و برتری', 'fa', 0, 'middle', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(59, 'middle_focus_title', 'Key Focus: Consistency and Excellence', 'en', 0, 'middle', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(60, 'middle_focus_title', 'التركيز الرئيسي: الاتساق والتميز', 'ar', 0, 'middle', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(61, 'middle_focus_text', 'ما بر پایداری و پیشرفت به موقع برای موفقیت دانش‌آموزان تمرکز داریم.', 'fa', 0, 'middle', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(62, 'middle_focus_text', 'We focus on consistency and timely progress for student success.', 'en', 0, 'middle', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(63, 'middle_focus_text', 'نحن نركز على الاتساق والتقدم في الوقت المناسب لنجاح الطالب.', 'ar', 0, 'middle', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(64, 'high_section_label', 'دبیرستان', 'fa', 0, 'high', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(65, 'high_section_label', 'HIGH SCHOOL', 'en', 0, 'high', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(66, 'high_section_label', 'المدرسة الثانوية', 'ar', 0, 'high', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(67, 'high_title', 'معلمان باتجربه، امکانات تخصصی و برنامه‌های پیشرفته', 'fa', 0, 'high', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(68, 'high_title', 'Experienced Educators, Specialized Facilities, And Cutting-Edge Programs', 'en', 0, 'high', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(69, 'high_title', 'المعلمين ذوي الخبرة والمرافق المتخصصة والبرامج المتطورة', 'ar', 0, 'high', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(70, 'high_description', 'دبیرستان (پایه‌های 10 تا 12) در مدرسه سلمان فارسی توسط تیمی از معلمان باتجربه و استادان دانشگاه در رشته‌های علوم، علوم انسانی، ریاضیات، فیزیک و توسعه وب اداره می‌شود.', 'fa', 0, 'high', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(71, 'high_description', 'High school (grades 10 to 12) at Salman Farsi School is guided by a team of experienced educators, many of whom are university professors specializing in science, humanities, mathematics, physics, and web development.', 'en', 0, 'high', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(72, 'high_description', 'تدار المدرسة الثانوية (الصفوف من 10 إلى 12) في مدرسة سلمان الفارسي من قبل فريق من المعلمين ذوي الخبرة، وكثير منهم أساتذة جامعيون متخصصون في العلوم والإنسانيات والرياضيات والفيزياء وتطوير الويب.', 'ar', 0, 'high', 0, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(73, 'high_feature_title', 'آموزش پیشرفته علوم', 'fa', 1, 'high_features', 1, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(74, 'high_feature_title', 'Advanced Science Instruction', 'en', 1, 'high_features', 1, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(75, 'high_feature_title', 'تعليم العلوم المتقدمة', 'ar', 1, 'high_features', 1, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(76, 'high_feature_text', 'استادان با تخصص در ریاضیات، زیست‌شناسی، شیمی و فیزیک، راهنمایی‌های عمیق و کارآمدی برای موفقیت تحصیلی ارائه می‌دهند.', 'fa', 1, 'high_features', 1, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(77, 'high_feature_text', 'Professors provide expert guidance in biology, chemistry, and physics for academic success.', 'en', 1, 'high_features', 1, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(78, 'high_feature_text', 'يقدم الأساتذة توجيهات خبيرة في مجال الأحياء والكيمياء والفيزياء للنجاح الأكاديمي.', 'ar', 1, 'high_features', 1, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(79, 'high_feature_title', 'آزمایشگاه‌های پیشرفته علوم', 'fa', 1, 'high_features', 2, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(80, 'high_feature_title', 'State-of-the-Art Science Labs', 'en', 1, 'high_features', 2, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(81, 'high_feature_title', 'مختبرات علوم متطورة', 'ar', 1, 'high_features', 2, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(82, 'high_feature_text', 'آزمایشگاه‌های کاملاً مجهز فرصتی برای انجام آزمایش‌های علمی در رشته‌های مختلف فراهم می‌آورند.', 'fa', 1, 'high_features', 2, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(83, 'high_feature_text', 'Fully equipped labs enable practical experiments in core sciences.', 'en', 1, 'high_features', 2, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(84, 'high_feature_text', 'تتيح المختبرات المجهزة بالكامل إجراء تجارب عملية في العلوم الأساسية.', 'ar', 1, 'high_features', 2, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(85, 'high_feature_title', 'برتری در توسعه وب', 'fa', 1, 'high_features', 3, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(86, 'high_feature_title', 'Web Development Excellence', 'en', 1, 'high_features', 3, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(87, 'high_feature_title', 'التميز في تطوير الويب', 'ar', 1, 'high_features', 3, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(88, 'high_feature_text', 'دانش‌آموزان از طریق کارگاه‌های مدرن کامپیوتری، تجربه عملی در زمینه توسعه وب کسب می‌کنند.', 'fa', 1, 'high_features', 3, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(89, 'high_feature_text', 'Students gain hands-on experience in modern computer labs tailored for web development.', 'en', 1, 'high_features', 3, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(90, 'high_feature_text', 'يكتسب الطلاب خبرة عملية في مختبرات الكمبيوتر الحديثة المصممة خصيصًا لتطوير الويب.', 'ar', 1, 'high_features', 3, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(91, 'high_feature_title', 'برنامه‌های فوق‌برنامه تخصصی', 'fa', 1, 'high_features', 4, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(92, 'high_feature_title', 'Tailored Extracurricular Programs', 'en', 1, 'high_features', 4, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(93, 'high_feature_title', 'برامج خارج المنهج مخصصة', 'ar', 1, 'high_features', 4, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(94, 'high_feature_text', 'برنامه‌های متنوع فوق‌برنامه، دانش‌آموزان را در زمینه‌های علوم انسانی، ریاضی و فناوری تقویت می‌کند.', 'fa', 1, 'high_features', 4, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(95, 'high_feature_text', 'Diverse activities support students in humanities, mathematics, and technology.', 'en', 1, 'high_features', 4, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(96, 'high_feature_text', 'تدعم الأنشطة المتنوعة الطلاب في مجالات العلوم الإنسانية والرياضيات والتكنولوجيا.', 'ar', 1, 'high_features', 4, NULL, '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(97, 'ehsan_image', 'تصویر بخش احسان', 'fa', 0, 'ehsan', 0, 'assets/images/Curriculum/ehsan.jpg', '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(98, 'ehsan_image', 'Ehsan section image', 'en', 0, 'ehsan', 0, 'assets/images/Curriculum/ehsan.jpg', '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(99, 'ehsan_image', 'صورة قسم إحسان', 'ar', 0, 'ehsan', 0, 'assets/images/Curriculum/ehsan.jpg', '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(100, 'elementary_image', 'تصویر بخش ابتدایی', 'fa', 0, 'elementary', 0, 'assets/images/Curriculum/elementry-graduation.jpg', '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(101, 'elementary_image', 'Elementary section image', 'en', 0, 'elementary', 0, 'assets/images/Curriculum/elementry-graduation.jpg', '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(102, 'elementary_image', 'صورة القسم الابتدائي', 'ar', 0, 'elementary', 0, 'assets/images/Curriculum/elementry-graduation.jpg', '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(103, 'middle_image', 'تصویر بخش راهنمایی', 'fa', 0, 'middle', 0, 'assets/images/Curriculum/rahnmaii.jpg', '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(104, 'middle_image', 'Middle school section image', 'en', 0, 'middle', 0, 'assets/images/Curriculum/rahnmaii.jpg', '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(105, 'middle_image', 'صورة قسم المدرسة المتوسطة', 'ar', 0, 'middle', 0, 'assets/images/Curriculum/rahnmaii.jpg', '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(106, 'high_image', 'تصویر بخش دبیرستان', 'fa', 0, 'high', 0, 'assets/images/Curriculum/highschool.JPG', '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(107, 'high_image', 'High school section image', 'en', 0, 'high', 0, 'assets/images/Curriculum/highschool.JPG', '2025-03-28 18:16:43', '2025-03-28 18:16:43'),
(108, 'high_image', 'صورة قسم المدرسة الثانوية', 'ar', 0, 'high', 0, 'assets/images/Curriculum/highschool.JPG', '2025-03-28 18:16:43', '2025-03-28 18:16:43');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `document_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `document_type` enum('emirates_id','passport','academic_certificate') NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `upload_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`document_id`, `student_id`, `document_type`, `file_path`, `upload_date`) VALUES
(1, 1, 'emirates_id', 'assets/images/documents/67d32b341b74d_1741892404.jpg', '2025-03-13 19:00:04'),
(2, 1, 'passport', 'assets/images/documents/67d32b341c32e_1741892404.png', '2025-03-13 19:00:04'),
(3, 1, 'academic_certificate', 'assets/images/documents/67d32b341c7df_1741892404.jpg', '2025-03-13 19:00:04'),
(4, 2, 'emirates_id', 'assets/images/documents/67d3322a17340_1741894186.jpg', '2025-03-13 19:29:46'),
(5, 2, 'passport', 'assets/images/documents/67d3322a18439_1741894186.jpg', '2025-03-13 19:29:46'),
(6, 2, 'academic_certificate', 'assets/images/documents/67d3322a191a1_1741894186.jpg', '2025-03-13 19:29:46'),
(7, 8, 'emirates_id', 'uploads/documents/67ed454eca413_1743603022.jpg', '2025-04-02 18:10:22'),
(8, 8, 'passport', 'uploads/documents/67ed454ecb8e5_1743603022.jpg', '2025-04-02 18:10:22'),
(9, 9, 'emirates_id', 'uploads/documents/67ed4553ca9d3_1743603027.jpg', '2025-04-02 18:10:27'),
(10, 9, 'passport', 'uploads/documents/67ed4553cb687_1743603027.jpg', '2025-04-02 18:10:27'),
(11, 10, 'emirates_id', 'uploads/student_documents/10/emirates_id_1743840000_76a7c3ba62cb6691.jpg', '2025-04-05 12:00:00'),
(12, 10, 'passport', 'uploads/student_documents/10/passport_1743840000_f29ee26ce65ae9a9.png', '2025-04-05 12:00:00'),
(13, 10, '', 'uploads/student_documents/10/national_id_1743840000_e7f8a3c58db71d23.png', '2025-04-05 12:00:00'),
(14, 10, '', 'uploads/student_documents/10/birth_certificate_1743840000_bb21ee113c143e67.png', '2025-04-05 12:00:00'),
(15, 11, 'emirates_id', 'uploads/student_documents/11/emirates_id_1743871654_dbeaaffbd776ce03.png', '2025-04-05 20:47:34'),
(16, 11, 'passport', 'uploads/student_documents/11/passport_1743871654_bbec7cece4c2fe26.png', '2025-04-05 20:47:34'),
(17, 11, 'academic_certificate', 'uploads/student_documents/11/academic_certificate_1743871654_94db7ec9626fe3b9.png', '2025-04-05 20:47:34'),
(18, 12, '', 'uploads/student_documents/12/profile_photo_1743927566_9ff72b3ffbf19109.png', '2025-04-06 12:19:26'),
(19, 12, 'emirates_id', 'uploads/student_documents/12/emirates_id_1743927566_a8b13f2a2a3097fd.jpg', '2025-04-06 12:19:26'),
(20, 12, 'passport', 'uploads/student_documents/12/passport_1743927566_d4bf7261d6458c92.jpg', '2025-04-06 12:19:26'),
(21, 13, '', 'uploads/student_documents/13/profile_photo_1743938959_67877d543e78b138.png', '2025-04-06 15:29:19'),
(22, 13, 'emirates_id', 'uploads/student_documents/13/emirates_id_1743938959_7bd67c792bd9e692.jpg', '2025-04-06 15:29:19'),
(23, 13, 'passport', 'uploads/student_documents/13/passport_1743938959_e8d6d9158327b4fe.jpg', '2025-04-06 15:29:19'),
(24, 14, 'emirates_id', 'uploads/student_documents/14/emiratesId_1744658131_5d8ed79cf288a752.jpg', '2025-04-14 23:15:31'),
(25, 14, 'passport', 'uploads/student_documents/14/passportDoc_1744658131_98bfd75e452a4094.jpg', '2025-04-14 23:15:31'),
(28, 16, 'emirates_id', 'uploads/student_documents/16/emiratesId_1744659450_69b41c842b6e058c.jpg', '2025-04-14 23:37:30'),
(29, 16, 'passport', 'uploads/student_documents/16/passportDoc_1744659450_60e52687ffd55b5d.jpg', '2025-04-14 23:37:30'),
(30, 17, 'emirates_id', 'uploads/student_documents/17/emiratesId_1744801057_94f4727d27ed4ef0.jpg', '2025-04-16 14:57:37'),
(31, 17, 'passport', 'uploads/student_documents/17/passportDoc_1744801057_e926ccff49a6e6d2.jpg', '2025-04-16 14:57:37'),
(32, 18, 'emirates_id', 'uploads/student_documents/18/emiratesId_1744801551_b10da5c6a43436d6.jpg', '2025-04-16 15:05:51'),
(33, 18, 'passport', 'uploads/student_documents/18/passportDoc_1744801551_6953fb651578255b.jpg', '2025-04-16 15:05:51'),
(34, 19, 'emirates_id', 'uploads/student_documents/19/emiratesId_1744801945_d9f8e271c456f189.jpg', '2025-04-16 15:12:25'),
(35, 19, 'passport', 'uploads/student_documents/19/passportDoc_1744801945_c4599ed4162c969c.jpg', '2025-04-16 15:12:25');

-- --------------------------------------------------------

--
-- Table structure for table `ehsan_content`
--

CREATE TABLE `ehsan_content` (
  `id` int(11) NOT NULL,
  `field_key` varchar(255) NOT NULL COMMENT 'کلید یکتا برای شناسایی محتوا',
  `content` text NOT NULL COMMENT 'محتوای متنی یا JSON',
  `language_id` varchar(5) NOT NULL DEFAULT 'fa' COMMENT 'کد زبان (fa=1, en=2, ar=3)',
  `is_repeatable` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'آیا این محتوا تکرارشونده است',
  `section_id` varchar(50) DEFAULT NULL COMMENT 'شناسه بخش برای گروه‌بندی',
  `sort_order` int(11) DEFAULT NULL COMMENT 'ترتیب نمایش',
  `image_path` varchar(255) DEFAULT NULL COMMENT 'مسیر تصویر (اختیاری)',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ehsan_content`
--

INSERT INTO `ehsan_content` (`id`, `field_key`, `content`, `language_id`, `is_repeatable`, `section_id`, `sort_order`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 'page_title', 'بخش احسان - دانش‌آموزان با نیازهای ویژه', 'fa', 0, 'header', 1, NULL, '2025-03-28 17:50:16', '2025-03-28 17:51:53'),
(2, 'page_subtitle', 'حمایت، توانمندسازی و پرورش استعدادهای ویژه', 'fa', 0, 'header', 2, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(3, 'intro_title', 'معرفی بخش احسان', 'fa', 0, 'intro', 1, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(4, 'intro_description_1', 'مجتمع آموزشی سلمان فارسی با تعهدی راسخ، برای حمایت از دانش‌آموزان با نیازهای ویژه (Students of Determination) در مسیر رشد و پیشرفتشان فعالیت می‌کند. این مجموعه در سال 1995 فعالیت خود را آغاز کرد و طی سال‌ها پذیرای صدها دانش‌آموز بوده است. در سال 2008، اولین بخش تخصصی خود با نام «احسان» را به‌منظور ارائه خدمات آموزشی و توان‌بخشی به این دانش‌آموزان افتتاح کرد.', 'fa', 0, 'intro', 2, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(5, 'intro_description_2', 'هدف اصلی بخش احسان، شناسایی ظرفیت‌ها و توانمندی‌های همه دانش‌آموزان و فراهم‌کردن فرصت‌هایی برای رشد، یادگیری و مشارکت آن‌ها در فعالیت‌های متنوع آموزشی و غنی‌سازی است. ما به برابری و ایجاد فرصت‌های برابر برای همه اعتقاد داریم و تلاش می‌کنیم زمینه‌ای را فراهم آوریم تا دانش‌آموزان بتوانند آینده‌ای روشن برای خود بسازند.', 'fa', 0, 'intro', 3, 'assets/images/ehsan/ehsan-students.jpg', '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(6, 'objectives_title', 'اهداف بخش احسان', 'fa', 0, 'objectives', 1, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(7, 'objective_item', '{\"title\":\"ارائه تجارب آموزشی برای رشد توانایی‌ها\",\"description\":\"ارائه تجارب آموزشی که دانش‌آموزان را قادر سازد به تمام توانایی‌های خود دست یابند.\"}', 'fa', 1, 'objectives', 1, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(8, 'objective_item', '{\"title\":\"ایجاد محیط مثبت برای تقویت اعتماد‌به‌نفس\",\"description\":\"ایجاد محیطی مثبت که در آن دانش‌آموزان اعتمادبه‌نفس و عزت‌نفس خود را تقویت کنند.\"}', 'fa', 1, 'objectives', 2, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(9, 'objective_item', '{\"title\":\"ارزش‌گذاری به نیازها و دیدگاه‌ها\",\"description\":\"ارزش‌گذاری به نیازها و دیدگاه‌های دانش‌آموزان با نیازهای ویژه و پاسخ‌گویی به خواسته‌های آن‌ها.\"}', 'fa', 1, 'objectives', 3, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(10, 'objective_item', '{\"title\":\"فراهم‌کردن بستر ورود به جامعه\",\"description\":\"فراهم‌کردن بستری برای ورود دانش‌آموزان دارای نیازهای ویژه به جامعه با ارزش‌های اخلاقی و مهارت‌های شغلی مناسب.\"}', 'fa', 1, 'objectives', 4, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(11, 'objective_item', '{\"title\":\"تربیت دانش‌آموزان موفق در همه زمینه‌ها\",\"description\":\"تربیت دانش‌آموزانی که نه‌تنها در حوزه‌های علمی بلکه در ارزش‌های اخلاقی، اجتماعی و شهروندی موفق باشند.\"}', 'fa', 1, 'objectives', 5, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(12, 'speech_therapy_title', 'گفتاردرمانی ؛ یکی از خدمات توان‌بخشی بخش احسان', 'fa', 0, 'speech_therapy', 1, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(13, 'speech_therapy_description', 'واحد گفتاردرمانی بخش احسان به ارزیابی و درمان اختلالات گفتار و زبان دانش‌آموزان می‌پردازد. این خدمات نقش کلیدی در بهبود توانایی‌های ارتباطی دانش‌آموزان دارد، زیرا گفتار و زبان از مهم‌ترین ابزارهای برقراری ارتباط هستند.', 'fa', 0, 'speech_therapy', 2, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(14, 'speech_therapy_areas_title', 'حیطه‌های خدمات گفتاردرمانی', 'fa', 0, 'speech_therapy', 3, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(15, 'speech_therapy_image_1', '', 'fa', 0, 'speech_therapy', 4, 'assets/images/ehsan/speech-therapy.jpg', '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(16, 'speech_therapy_image_2', '', 'fa', 0, 'speech_therapy', 5, 'assets/images/ehsan/classroom.jpg', '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(17, 'speech_therapy_area', '{\"title\":\"تأخیر در رشد گفتار و زبان\",\"description\":\"شامل کودکانی که محیط مناسبی برای رشد گفتار و زبان نداشته یا دچار ناتوانی ذهنی هستند.\"}', 'fa', 1, 'speech_therapy', 1, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(18, 'speech_therapy_area', '{\"title\":\"مشکلات یادگیری\",\"description\":\"شامل اختلالات در خواندن و نوشتن.\"}', 'fa', 1, 'speech_therapy', 2, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(19, 'speech_therapy_area', '{\"title\":\"اختلال تولید\",\"description\":\"ناشی از عدم هماهنگی عضلات زبان، کم‌شنوایی یا ضعف حسی دهان.\"}', 'fa', 1, 'speech_therapy', 3, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(20, 'speech_therapy_area', '{\"title\":\"لکنت\",\"description\":\"گفتاری که همراه با تکرار، کشش، مکث یا گیر است و گاهی ناشی از فقر واژگان یا اختلالات عصبی است.\"}', 'fa', 1, 'speech_therapy', 4, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(21, 'services_title', 'خدمات ارائه‌شده در واحد گفتاردرمانی', 'fa', 0, 'services', 1, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(22, 'service_item', '{\"title\":\"ارزیابی اولیه و تعیین سطح\",\"description\":\"ارزیابی اولیه و تعیین سطح اختلال گفتار و زبان.\",\"icon\":\"fas fa-clipboard-check\"}', 'fa', 1, 'services', 1, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(23, 'service_item', '{\"title\":\"برنامه‌ریزی و اجرای دقیق درمان\",\"description\":\"برنامه‌ریزی و اجرای دقیق درمان.\",\"icon\":\"fas fa-tasks\"}', 'fa', 1, 'services', 2, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(24, 'service_item', '{\"title\":\"مشاوره و راهنمایی خانواده‌ها\",\"description\":\"مشاوره و راهنمایی خانواده‌ها.\",\"icon\":\"fas fa-users\"}', 'fa', 1, 'services', 3, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(25, 'service_item', '{\"title\":\"تقویت سیستم حسی-عصبی\",\"description\":\"تقویت سیستم حسی-عصبی و مهارت‌های پایه گفتاری مانند جویدن و بلع.\",\"icon\":\"fas fa-brain\"}', 'fa', 1, 'services', 4, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(26, 'service_item', '{\"title\":\"ارتقای مهارت‌های ارتباطی\",\"description\":\"ارتقای مهارت‌های ارتباطی دانش‌آموز با استفاده از روش‌های رفتاری، شناختی و زبانی.\",\"icon\":\"fas fa-comments\"}', 'fa', 1, 'services', 5, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(27, 'conclusion_title', 'مسیر موفقیت و توانمندی', 'fa', 0, 'conclusion', 1, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(28, 'conclusion_description', 'بخش احسان، با ترکیبی از تعهد و تخصص، به دانش‌آموزان با نیازهای ویژه کمک می‌کند تا مسیر موفقیت و توانمندی را با اطمینان طی کنند. ما با رویکردی مبتنی بر احترام و توجه به تفاوت‌های فردی، شرایطی را فراهم می‌آوریم که هر دانش‌آموز بتواند استعدادهای خود را به بهترین شکل شکوفا سازد.', 'fa', 0, 'conclusion', 2, 'assets/images/ehsan/ehsan-group.jpg', '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(29, 'cta_title', 'برای اطلاعات بیشتر با ما تماس بگیرید', 'fa', 0, 'conclusion', 3, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(30, 'cta_description', 'خانواده‌های محترم، برای کسب اطلاعات بیشتر درباره خدمات بخش احسان و شرایط ثبت‌نام، با ما در تماس باشید.', 'fa', 0, 'conclusion', 4, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(31, 'cta_button_text', 'تماس با ما', 'fa', 0, 'conclusion', 5, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(32, 'page_title', 'Ehsan Department - Students of Determination', 'en', 0, 'header', 1, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(33, 'page_subtitle', 'Supporting, Empowering, and Nurturing Special Talents', 'en', 0, 'header', 2, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(34, 'intro_title', 'Introduction to Ehsan', 'en', 0, 'intro', 1, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(35, 'intro_description_1', 'The Salman Farsi Educational Complex is committed to supporting Students of Determination (SOD) in their journey toward growth and development. Established in 1995, the complex has welcomed hundreds of students over the years. In 2008, it launched its first specialized department, named Ehsan, to provide educational and rehabilitation services to students with special needs.', 'en', 0, 'intro', 2, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(36, 'intro_description_2', 'The primary goal of Ehsan is to recognize the potential and capabilities of all students while creating opportunities for their enrichment and learning. We believe in equality and equal opportunities for everyone, striving to provide a supportive environment where students can shape a brighter future for themselves.', 'en', 0, 'intro', 3, 'assets/images/ehsan/ehsan-students.jpg', '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(37, 'objectives_title', 'Objectives of Ehsan', 'en', 0, 'objectives', 1, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(38, 'objective_item', '{\"title\":\"Provide Learning Experiences for Full Potential\",\"description\":\"To offer learning experiences that enable students to achieve their full potential.\"}', 'en', 1, 'objectives', 1, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(39, 'objective_item', '{\"title\":\"Create a Positive Environment for Confidence\",\"description\":\"To create a positive environment where students can build self-confidence and self-respect.\"}', 'en', 1, 'objectives', 2, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(40, 'objective_item', '{\"title\":\"Value Needs and Perspectives\",\"description\":\"To value the needs and perspectives of Students of Determination and address their aspirations.\"}', 'en', 1, 'objectives', 3, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(41, 'objective_item', '{\"title\":\"Prepare for Social Integration\",\"description\":\"To ensure that students with special needs can integrate into society with appropriate ethical values and vocational skills.\"}', 'en', 1, 'objectives', 4, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(42, 'objective_item', '{\"title\":\"Develop Well-Rounded Students\",\"description\":\"To develop students—not just those with special needs but all students—into responsible citizens equipped with proper social etiquette, ethics, and values to contribute to their future.\"}', 'en', 1, 'objectives', 5, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(43, 'speech_therapy_title', 'Speech Therapy -- A Key Rehabilitation Service', 'en', 0, 'speech_therapy', 1, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(44, 'speech_therapy_description', 'The speech therapy unit within Ehsan focuses on assessing and treating speech and language disorders in students. This service plays a crucial role in enhancing students\' communication skills, as speech and language are vital tools for interaction.', 'en', 0, 'speech_therapy', 2, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(45, 'speech_therapy_areas_title', 'Areas of Speech Therapy Services', 'en', 0, 'speech_therapy', 3, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(46, 'speech_therapy_image_1', '', 'en', 0, 'speech_therapy', 4, 'assets/images/ehsan/speech-therapy.jpg', '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(47, 'speech_therapy_image_2', '', 'en', 0, 'speech_therapy', 5, 'assets/images/ehsan/classroom.jpg', '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(48, 'speech_therapy_area', '{\"title\":\"Delayed Speech and Language Development\",\"description\":\"For children who lack an environment conducive to speech and language development or have intellectual disabilities.\"}', 'en', 1, 'speech_therapy', 1, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(49, 'speech_therapy_area', '{\"title\":\"Learning Disorders\",\"description\":\"Including challenges related to reading and writing.\"}', 'en', 1, 'speech_therapy', 2, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(50, 'speech_therapy_area', '{\"title\":\"Articulation Disorders\",\"description\":\"Arising from coordination issues in tongue muscles, hearing impairments, or sensory weaknesses in the oral region.\"}', 'en', 1, 'speech_therapy', 3, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(51, 'speech_therapy_area', '{\"title\":\"Stuttering\",\"description\":\"Speech characterized by repetition, prolongation, pauses, or blocks, sometimes caused by vocabulary deficiencies or neurological disorders.\"}', 'en', 1, 'speech_therapy', 4, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(52, 'services_title', 'Services Provided by the Speech Therapy Unit', 'en', 0, 'services', 1, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(53, 'service_item', '{\"title\":\"Initial Evaluation\",\"description\":\"Initial evaluation and determination of the severity of speech and language disorders.\",\"icon\":\"fas fa-clipboard-check\"}', 'en', 1, 'services', 1, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(54, 'service_item', '{\"title\":\"Treatment Planning\",\"description\":\"Planning and precise implementation of treatment programs.\",\"icon\":\"fas fa-tasks\"}', 'en', 1, 'services', 2, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(55, 'service_item', '{\"title\":\"Family Counseling\",\"description\":\"Counseling and guiding families.\",\"icon\":\"fas fa-users\"}', 'en', 1, 'services', 3, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(56, 'service_item', '{\"title\":\"Sensory-Motor Enhancement\",\"description\":\"Enhancing sensory-motor systems and foundational speech skills, including chewing and swallowing.\",\"icon\":\"fas fa-brain\"}', 'en', 1, 'services', 4, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(57, 'service_item', '{\"title\":\"Communication Skills Improvement\",\"description\":\"Improving students\' communication skills using behavioral, cognitive, and linguistic approaches.\",\"icon\":\"fas fa-comments\"}', 'en', 1, 'services', 5, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(58, 'conclusion_title', 'A Path to Success and Empowerment', 'en', 0, 'conclusion', 1, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(59, 'conclusion_description', 'With a combination of dedication and expertise, the Ehsan department supports students with special needs, helping them confidently navigate their path to success and empowerment. Through an approach based on respect and attention to individual differences, we create conditions where each student can develop their talents in the best possible way.', 'en', 0, 'conclusion', 2, 'assets/images/ehsan/ehsan-group.jpg', '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(60, 'cta_title', 'Contact Us for More Information', 'en', 0, 'conclusion', 3, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(61, 'cta_description', 'Respected families, for more information about Ehsan department services and registration conditions, please contact us.', 'en', 0, 'conclusion', 4, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(62, 'cta_button_text', 'Contact Us', 'en', 0, 'conclusion', 5, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(63, 'page_title', 'قسم إحسان - طلاب أصحاب الهمم', 'ar', 0, 'header', 1, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(64, 'page_subtitle', 'دعم وتمكين ورعاية المواهب الخاصة', 'ar', 0, 'header', 2, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(65, 'intro_title', 'مقدمة عن إحسان', 'ar', 0, 'intro', 1, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(66, 'intro_description_1', 'يلتزم مجمع سلمان الفارسي التعليمي بدعم الطلاب أصحاب الهمم في رحلتهم نحو النمو والتطور. تأسس المجمع عام 1995، واستقبل مئات الطلاب على مر السنين. في عام 2008، أطلق أول قسم متخصص، باسم إحسان، لتقديم الخدمات التعليمية والتأهيلية للطلاب ذوي الاحتياجات الخاصة.', 'ar', 0, 'intro', 2, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(67, 'intro_description_2', 'الهدف الأساسي لإحسان هو التعرف على إمكانات وقدرات جميع الطلاب مع خلق فرص لإثرائهم وتعلمهم. نحن نؤمن بالمساواة وتكافؤ الفرص للجميع، ونسعى جاهدين لتوفير بيئة داعمة حيث يمكن للطلاب تشكيل مستقبل أكثر إشراقًا لأنفسهم.', 'ar', 0, 'intro', 3, 'assets/images/ehsan/ehsan-students.jpg', '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(68, 'objectives_title', 'أهداف إحسان', 'ar', 0, 'objectives', 1, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(69, 'objective_item', '{\"title\":\"توفير تجارب تعليمية لكامل الإمكانات\",\"description\":\"لتقديم تجارب تعليمية تمكن الطلاب من تحقيق كامل إمكاناتهم.\"}', 'ar', 1, 'objectives', 1, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(70, 'objective_item', '{\"title\":\"خلق بيئة إيجابية للثقة\",\"description\":\"لخلق بيئة إيجابية حيث يمكن للطلاب بناء الثقة بالنفس واحترام الذات.\"}', 'ar', 1, 'objectives', 2, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(71, 'objective_item', '{\"title\":\"تقدير الاحتياجات والآراء\",\"description\":\"لتقدير احتياجات وآراء الطلاب أصحاب الهمم وتلبية تطلعاتهم.\"}', 'ar', 1, 'objectives', 3, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(72, 'objective_item', '{\"title\":\"التحضير للاندماج الاجتماعي\",\"description\":\"لضمان أن الطلاب ذوي الاحتياجات الخاصة يمكنهم الاندماج في المجتمع بقيم أخلاقية ومهارات مهنية مناسبة.\"}', 'ar', 1, 'objectives', 4, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(73, 'objective_item', '{\"title\":\"تطوير طلاب متكاملين\",\"description\":\"لتطوير الطلاب - ليس فقط أولئك ذوي الاحتياجات الخاصة ولكن جميع الطلاب - ليصبحوا مواطنين مسؤولين مجهزين بآداب اجتماعية وأخلاق وقيم مناسبة للمساهمة في مستقبلهم.\"}', 'ar', 1, 'objectives', 5, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(74, 'speech_therapy_title', 'علاج النطق -- خدمة تأهيل رئيسية', 'ar', 0, 'speech_therapy', 1, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(75, 'speech_therapy_description', 'تركز وحدة علاج النطق داخل إحسان على تقييم وعلاج اضطرابات النطق واللغة لدى الطلاب. تلعب هذه الخدمة دورًا حاسمًا في تعزيز مهارات التواصل لدى الطلاب، حيث أن النطق واللغة أدوات حيوية للتفاعل.', 'ar', 0, 'speech_therapy', 2, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(76, 'speech_therapy_areas_title', 'مجالات خدمات علاج النطق', 'ar', 0, 'speech_therapy', 3, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(77, 'speech_therapy_image_1', '', 'ar', 0, 'speech_therapy', 4, 'assets/images/ehsan/speech-therapy.jpg', '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(78, 'speech_therapy_image_2', '', 'ar', 0, 'speech_therapy', 5, 'assets/images/ehsan/classroom.jpg', '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(79, 'speech_therapy_area', '{\"title\":\"تأخر النطق وتطور اللغة\",\"description\":\"للأطفال الذين يفتقرون إلى بيئة مواتية لتطور النطق واللغة أو لديهم إعاقات ذهنية.\"}', 'ar', 1, 'speech_therapy', 1, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(80, 'speech_therapy_area', '{\"title\":\"اضطرابات التعلم\",\"description\":\"بما في ذلك التحديات المتعلقة بالقراءة والكتابة.\"}', 'ar', 1, 'speech_therapy', 2, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(81, 'speech_therapy_area', '{\"title\":\"اضطرابات النطق\",\"description\":\"الناشئة عن مشاكل في تناسق عضلات اللسان، أو ضعف السمع، أو الضعف الحسي في منطقة الفم.\"}', 'ar', 1, 'speech_therapy', 3, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(82, 'speech_therapy_area', '{\"title\":\"التأتأة\",\"description\":\"كلام يتميز بالتكرار، الإطالة، التوقفات، أو التوقف المفاجئ، وأحيانًا يكون سببه نقص في المفردات أو اضطرابات عصبية.\"}', 'ar', 1, 'speech_therapy', 4, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(83, 'services_title', 'الخدمات التي تقدمها وحدة علاج النطق', 'ar', 0, 'services', 1, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(84, 'service_item', '{\"title\":\"التقييم الأولي\",\"description\":\"التقييم الأولي وتحديد شدة اضطرابات النطق واللغة.\",\"icon\":\"fas fa-clipboard-check\"}', 'ar', 1, 'services', 1, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(85, 'service_item', '{\"title\":\"تخطيط العلاج\",\"description\":\"التخطيط والتنفيذ الدقيق لبرامج العلاج.\",\"icon\":\"fas fa-tasks\"}', 'ar', 1, 'services', 2, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(86, 'service_item', '{\"title\":\"استشارة الأسرة\",\"description\":\"تقديم المشورة وتوجيه الأسر.\",\"icon\":\"fas fa-users\"}', 'ar', 1, 'services', 3, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(87, 'service_item', '{\"title\":\"تعزيز الجهاز الحسي الحركي\",\"description\":\"تعزيز الأنظمة الحسية الحركية ومهارات النطق الأساسية، بما في ذلك المضغ والبلع.\",\"icon\":\"fas fa-brain\"}', 'ar', 1, 'services', 4, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(88, 'service_item', '{\"title\":\"تحسين مهارات التواصل\",\"description\":\"تحسين مهارات التواصل لدى الطلاب باستخدام أساليب سلوكية ومعرفية ولغوية.\",\"icon\":\"fas fa-comments\"}', 'ar', 1, 'services', 5, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(89, 'conclusion_title', 'طريق النجاح والتمكين', 'ar', 0, 'conclusion', 1, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(90, 'conclusion_description', 'من خلال مزيج من التفاني والخبرة، يدعم قسم إحسان الطلاب ذوي الاحتياجات الخاصة، ويساعدهم في الانتقال بثقة في طريقهم نحو النجاح والتمكين. من خلال نهج قائم على الاحترام والاهتمام بالاختلافات الفردية، نخلق ظروفًا يمكن لكل طالب من خلالها تطوير مواهبه بأفضل طريقة ممكنة.', 'ar', 0, 'conclusion', 2, 'assets/images/ehsan/ehsan-group.jpg', '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(91, 'cta_title', 'اتصل بنا لمزيد من المعلومات', 'ar', 0, 'conclusion', 3, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(92, 'cta_description', 'الأسر المحترمة، لمزيد من المعلومات حول خدمات قسم إحسان وشروط التسجيل، يرجى الاتصال بنا.', 'ar', 0, 'conclusion', 4, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16'),
(93, 'cta_button_text', 'اتصل بنا', 'ar', 0, 'conclusion', 5, NULL, '2025-03-28 17:50:16', '2025-03-28 17:50:16');

-- --------------------------------------------------------

--
-- Table structure for table `error_content`
--

CREATE TABLE `error_content` (
  `id` int(11) NOT NULL,
  `field_key` varchar(255) NOT NULL COMMENT 'کلید شناسایی محتوا',
  `content` text DEFAULT NULL COMMENT 'محتوای اصلی',
  `language_id` varchar(5) NOT NULL COMMENT 'کد زبان (fa, en, ar)',
  `is_repeatable` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'آیا این محتوا تکرارشونده است؟',
  `section_id` varchar(50) DEFAULT NULL COMMENT 'شناسه بخش برای گروه‌بندی',
  `sort_order` int(11) NOT NULL DEFAULT 0 COMMENT 'ترتیب نمایش آیتم‌های تکرارشونده',
  `image_path` varchar(255) DEFAULT NULL COMMENT 'مسیر فایل تصویر',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `error_content`
--

INSERT INTO `error_content` (`id`, `field_key`, `content`, `language_id`, `is_repeatable`, `section_id`, `sort_order`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 'page_title', 'خطای 404 | مجتمع آموزشی سلمان', 'fa', 0, 'header', 0, NULL, '2025-03-28 18:39:59', '2025-03-28 18:39:59'),
(2, 'page_title', '404 Error | Salman Educational Complex', 'en', 0, 'header', 0, NULL, '2025-03-28 18:39:59', '2025-03-28 18:39:59'),
(3, 'page_title', 'خطأ 404 | مجمع سلمان التعليمي', 'ar', 0, 'header', 0, NULL, '2025-03-28 18:39:59', '2025-03-28 18:39:59'),
(4, 'error_title', 'اوپس، صفحه‌ای یافت نشد!', 'fa', 0, 'error', 0, NULL, '2025-03-28 18:39:59', '2025-03-28 18:39:59'),
(5, 'error_title', 'Oops, page not found!', 'en', 0, 'error', 0, NULL, '2025-03-28 18:39:59', '2025-03-28 18:39:59'),
(6, 'error_title', 'عفوًا، الصفحة غير موجودة!', 'ar', 0, 'error', 0, NULL, '2025-03-28 18:39:59', '2025-03-28 18:39:59'),
(7, 'error_text', 'صفحه‌ای که به دنبال آن هستید ممکن است حذف شده، نام آن تغییر کرده یا موقتاً در دسترس نباشد.', 'fa', 0, 'error', 0, NULL, '2025-03-28 18:39:59', '2025-03-28 18:39:59'),
(8, 'error_text', 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'en', 0, 'error', 0, NULL, '2025-03-28 18:39:59', '2025-03-28 18:39:59'),
(9, 'error_text', 'من المحتمل أن تكون الصفحة التي تبحث عنها قد تمت إزالتها، أو تم تغيير اسمها، أو أنها غير متوفرة مؤقتًا.', 'ar', 0, 'error', 0, NULL, '2025-03-28 18:39:59', '2025-03-28 18:39:59'),
(10, 'button_text', 'بازگشت به صفحه اصلی', 'fa', 0, 'error', 0, NULL, '2025-03-28 18:39:59', '2025-03-28 18:39:59'),
(11, 'button_text', 'Back to Homepage', 'en', 0, 'error', 0, NULL, '2025-03-28 18:39:59', '2025-03-28 18:39:59'),
(12, 'button_text', 'العودة إلى الصفحة الرئيسية', 'ar', 0, 'error', 0, NULL, '2025-03-28 18:39:59', '2025-03-28 18:39:59'),
(13, 'logo_path_light', 'assets/images/farsi-logo.png', 'fa', 0, 'images', 0, NULL, '2025-03-28 18:39:59', '2025-03-28 18:39:59'),
(14, 'logo_path_light', 'assets/images/logo-dark.png', 'en', 0, 'images', 0, NULL, '2025-03-28 18:39:59', '2025-03-28 18:39:59'),
(15, 'logo_path_light', 'assets/images/logo-dark.png', 'ar', 0, 'images', 0, NULL, '2025-03-28 18:39:59', '2025-03-28 18:39:59'),
(16, 'logo_alt', 'مجتمع آموزشی سلمان', 'fa', 0, 'images', 0, NULL, '2025-03-28 18:39:59', '2025-03-28 18:39:59'),
(17, 'logo_alt', 'Salman Educational Complex', 'en', 0, 'images', 0, NULL, '2025-03-28 18:39:59', '2025-03-28 18:39:59'),
(18, 'logo_alt', 'مجمع سلمان التعليمي', 'ar', 0, 'images', 0, NULL, '2025-03-28 18:39:59', '2025-03-28 18:39:59'),
(19, 'lang_btn_fa', 'فارسی', 'fa', 0, 'language', 0, NULL, '2025-03-28 18:39:59', '2025-03-28 18:39:59'),
(20, 'lang_btn_fa', 'Persian', 'en', 0, 'language', 0, NULL, '2025-03-28 18:39:59', '2025-03-28 18:39:59'),
(21, 'lang_btn_fa', 'الفارسية', 'ar', 0, 'language', 0, NULL, '2025-03-28 18:39:59', '2025-03-28 18:39:59'),
(22, 'lang_btn_en', 'English', 'fa', 0, 'language', 0, NULL, '2025-03-28 18:39:59', '2025-03-28 18:39:59'),
(23, 'lang_btn_en', 'English', 'en', 0, 'language', 0, NULL, '2025-03-28 18:39:59', '2025-03-28 18:39:59'),
(24, 'lang_btn_en', 'الإنجليزية', 'ar', 0, 'language', 0, NULL, '2025-03-28 18:39:59', '2025-03-28 18:39:59'),
(25, 'lang_btn_ar', 'العربية', 'fa', 0, 'language', 0, NULL, '2025-03-28 18:39:59', '2025-03-28 18:39:59'),
(26, 'lang_btn_ar', 'Arabic', 'en', 0, 'language', 0, NULL, '2025-03-28 18:39:59', '2025-03-28 18:39:59'),
(27, 'lang_btn_ar', 'العربية', 'ar', 0, 'language', 0, NULL, '2025-03-28 18:39:59', '2025-03-28 18:39:59');

-- --------------------------------------------------------

--
-- Table structure for table `facilities_content`
--

CREATE TABLE `facilities_content` (
  `id` int(11) NOT NULL,
  `field_key` varchar(255) NOT NULL COMMENT 'کلید یکتا برای شناسایی محتوا (مثل header_title، smart_classroom، etc.)',
  `content` text NOT NULL COMMENT 'محتوای متنی یا JSON',
  `language_id` varchar(5) NOT NULL DEFAULT 'fa' COMMENT 'کد زبان (fa=1, en=2, ar=3)',
  `is_repeatable` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'آیا این محتوا تکرارشونده است',
  `section_id` varchar(50) DEFAULT NULL COMMENT 'شناسه بخش برای گروه‌بندی',
  `sort_order` int(11) DEFAULT NULL COMMENT 'ترتیب نمایش',
  `image_path` varchar(255) DEFAULT NULL COMMENT 'مسیر تصویر (اختیاری)',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `facilities_content`
--

INSERT INTO `facilities_content` (`id`, `field_key`, `content`, `language_id`, `is_repeatable`, `section_id`, `sort_order`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 'page_title', 'امکانات و خدمات', 'fa', 0, 'header', 1, NULL, '2025-03-28 17:21:05', '2025-03-28 17:42:47'),
(2, 'page_subtitle', 'محیطی پویا برای رشد و یادگیری', 'fa', 0, 'header', 2, NULL, '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(3, 'intro_title', 'محیطی پویا برای رشد و یادگیری', 'fa', 0, 'intro', 1, NULL, '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(4, 'intro_subtitle', 'مجتمع آموزشی سلمان فارسی', 'fa', 0, 'intro', 2, NULL, '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(5, 'intro_description', 'مجتمع آموزشی سلمان فارسی محیطی پویا را برای رشد جامع دانش‌آموزان در زمینه‌های علمی، ورزشی، فرهنگی و اجتماعی فراهم کرده است. با زیرساخت‌های مدرن و امکانات پیشرفته، این مجموعه به پرورش افرادی خلاق، متعهد و توانمند برای موفقیت در جنبه‌های مختلف زندگی اختصاص یافته است.', 'fa', 0, 'intro', 3, 'assets/images/facilities/school.jpeg', '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(6, 'page_title', 'Facilities & Services', 'en', 0, 'header', 1, NULL, '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(7, 'page_subtitle', 'A Thriving Environment for Growth and Learning', 'en', 0, 'header', 2, NULL, '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(8, 'intro_title', 'A Thriving Environment for Growth and Learning', 'en', 0, 'intro', 1, NULL, '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(9, 'intro_subtitle', 'Salman Farsi Educational Complex', 'en', 0, 'intro', 2, NULL, '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(10, 'intro_description', 'The Salman Farsi Educational Complex offers a dynamic setting designed to foster comprehensive student development in academic, athletic, cultural, and social spheres. Equipped with modern infrastructure and state-of-the-art facilities, the complex is dedicated to nurturing creative, committed, and capable individuals prepared to excel in various aspects of life.', 'en', 0, 'intro', 3, 'assets/images/facilities/school.jpeg', '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(11, 'page_title', 'المرافق والخدمات', 'ar', 0, 'header', 1, NULL, '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(12, 'page_subtitle', 'بيئة مزدهرة للنمو والتعلم', 'ar', 0, 'header', 2, NULL, '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(13, 'intro_title', 'بيئة مزدهرة للنمو والتعلم', 'ar', 0, 'intro', 1, NULL, '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(14, 'intro_subtitle', 'مجمع سلمان الفارسي التعليمي', 'ar', 0, 'intro', 2, NULL, '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(15, 'intro_description', 'يقدم مجمع سلمان الفارسي التعليمي بيئة ديناميكية مصممة لتعزيز التطوير الشامل للطلاب في المجالات الأكاديمية والرياضية والثقافية والاجتماعية. مجهز ببنية تحتية حديثة ومرافق متطورة، المجمع مكرس لرعاية أفراد مبدعين وملتزمين وقادرين مستعدين للتفوق في مختلف جوانب الحياة.', 'ar', 0, 'intro', 3, 'assets/images/facilities/school.jpeg', '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(16, 'facility_item', '{\"title\":\"کلاس‌های هوشمند و ابزارهای آموزشی مدرن\",\"subtitle\":\"امکانات و خدمات\",\"description\":\"هر کلاس درس مجهز به تخته‌های هوشمند، پروژکتورهای پیشرفته و سیستم‌های صوتی-تصویری است که امکان یادگیری تعاملی و جذاب را فراهم می‌کند. با ادغام فناوری‌های پیشرفته آموزشی، مجتمع کیفیت یادگیری را ارتقا داده و دانش‌آموزان را به طور فعال در فرآیند آموزشی درگیر می‌کند.\",\"features\":[]}', 'fa', 1, 'facilities', 1, 'assets/images/facilities/classes.png', '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(17, 'facility_item', '{\"title\":\"آزمایشگاه‌های علمی پیشرفته\",\"subtitle\":\"امکانات و خدمات\",\"description\":\"مجتمع دارای آزمایشگاه‌های کاملا مجهز شیمی و زیست‌شناسی است که محیطی عملی و محرک برای انجام آزمایش‌ها، پروژه‌های تحقیقاتی و ارتقای مهارت‌ها در علوم را فراهم می‌کند.\",\"features\":[]}', 'fa', 1, 'facilities', 2, 'assets/images/facilities/laboratoy.jpg', '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(18, 'facility_item', '{\"title\":\"کتابخانه جامع\",\"subtitle\":\"امکانات و خدمات\",\"description\":\"با هزاران کتاب چاپی، کتابخانه فضایی آرام و پر منبع برای مطالعه و تحقیق فراهم می‌کند. ابزارهای جستجوی دیجیتال و دسترسی به منابع علمی، دانش‌آموزان را در دستیابی به برتری تحصیلی و پژوهشی پشتیبانی می‌کند.\",\"features\":[]}', 'fa', 1, 'facilities', 3, 'assets/images/facilities/library.png', '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(19, 'facility_item', '{\"title\":\"امکانات ورزشی و فضاهای تفریحی\",\"subtitle\":\"امکانات و خدمات\",\"description\":\"مجتمع آموزشی سلمان فارسی دارای امکانات ورزشی متنوع برای تقویت سلامت جسمی و روحیه کار تیمی دانش‌آموزان است.\",\"features\":[\"چندین زمین چمن ورزشی\",\"سالن‌های ورزشی چندمنظوره داخلی\",\"امکانات برای فعالیت‌هایی مانند فوتبال، والیبال، بسکتبال و تنیس روی میز\"],\"additional_text\":\"این امکانات، همراه با برنامه‌های ورزشی سازمان‌یافته، سلامت جسمی و کار تیمی را تشویق می‌کنند.\"}', 'fa', 1, 'facilities', 4, 'assets/images/facilities/football feild.png', '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(20, 'facility_item', '{\"title\":\"فعالیت‌های فرهنگی و هنری\",\"subtitle\":\"امکانات و خدمات\",\"description\":\"مجتمع سلمان فارسی با ارائه برنامه‌های غنی فرهنگی و هنری، به پرورش استعدادهای چندبعدی دانش‌آموزان کمک می‌کند.\",\"features\":[\"جشن‌های ملی و مذهبی\",\"نمایشگاه‌های هنری و کارگاه‌های خلاقیت\",\"آموزش هنرهایی مانند نقاشی، موسیقی و تئاتر\"]}', 'fa', 1, 'facilities', 5, 'assets/images/facilities/arts.png', '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(21, 'facility_item', '{\"title\":\"نمازخانه و برنامه‌های مذهبی\",\"subtitle\":\"امکانات و خدمات\",\"description\":\"نمازخانه محیطی دلنشین برای نمازهای جماعت، جلسات قرآنی و بحث‌های اخلاقی فراهم می‌کند که به رشد معنوی و اخلاقی دانش‌آموزان کمک می‌کند.\",\"features\":[]}', 'fa', 1, 'facilities', 6, 'assets/images/facilities/prayerhall.jpg', '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(22, 'facility_item', '{\"title\":\"درمانگاه سلامت و خدمات تندرستی\",\"subtitle\":\"امکانات و خدمات\",\"description\":\"درمانگاه سلامت، تحت نظارت متخصصان پزشکی واجد شرایط، خدمات زیر را ارائه می‌دهد:\",\"features\":[\"معاینات پزشکی معمول\",\"برنامه‌های واکسیناسیون\",\"مشاوره تغذیه و روانشناسی\"],\"additional_text\":\"این خدمات با هدف حفظ و بهبود سلامت جسمی و روانی دانش‌آموزان ارائه می‌شود.\"}', 'fa', 1, 'facilities', 7, 'assets/images/facilities/clinic.png', '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(23, 'facility_item', '{\"title\":\"خدمات مشاوره و راهنمایی\",\"subtitle\":\"امکانات و خدمات\",\"description\":\"مشاوران حرفه‌ای به دانش‌آموزان در زمینه‌های تحصیلی، عاطفی و اجتماعی از طریق موارد زیر کمک می‌کنند:\",\"features\":[\"مشاوره فردی و گروهی\",\"کارگاه‌های مهارت‌های زندگی\",\"جلسات راهنمایی شغلی\"]}', 'fa', 1, 'facilities', 8, 'assets/images/facilities/counseling.jpg', '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(24, 'facility_item', '{\"title\":\"سالن غذاخوری بهداشتی با غذاهای مغذی\",\"subtitle\":\"امکانات و خدمات\",\"description\":\"سالن غذاخوری دسترسی به وعده‌های غذایی و میان‌وعده‌های سالم و مغذی را تضمین می‌کند و رژیم‌های غذایی متعادل را برای حفظ انرژی و سلامت کلی دانش‌آموزان ترویج می‌دهد.\",\"features\":[]}', 'fa', 1, 'facilities', 9, 'assets/images/facilities/cafeteria.jpg', '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(25, 'facility_item', '{\"title\":\"پشتیبانی از دانش‌آموزان با نیازهای ویژه\",\"subtitle\":\"امکانات و خدمات\",\"description\":\"خدمات تخصصی برای دانش‌آموزان با نیازهای ویژه، شامل موارد زیر است:\",\"features\":[\"گفتاردرمانی و توانبخشی\",\"مشاوره شخصی‌سازی شده\",\"برنامه‌های توسعه مهارت‌های اجتماعی\"]}', 'fa', 1, 'facilities', 10, 'assets/images/facilities/Primary Reception.png', '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(26, 'facility_item', '{\"title\":\"ایمنی و آمادگی بحران\",\"subtitle\":\"امکانات و خدمات\",\"description\":\"مجتمع از پروتکل‌های ایمنی سختگیرانه‌ای پیروی می‌کند و دوره‌هایی درباره مدیریت بحران، ایمنی آتش‌سوزی و آمادگی زلزله ارائه می‌دهد تا دانش‌آموزان را برای شرایط اضطراری آماده کند.\",\"features\":[],\"focus_title\":\"تمرکز ویژه: آموزش مدیریت بحران\",\"focus_text\":\"ما دانش‌آموزان را با دانش و مهارت‌های لازم برای مدیریت مؤثر شرایط اضطراری توانمند می‌کنیم و آنها را برای هر موقعیت غیرمنتظره آماده می‌کنیم.\"}', 'fa', 1, 'facilities', 11, 'assets/images/facilities/saftey.jpg', '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(27, 'facility_item', '{\"title\":\"Smart Classrooms and Modern Educational Tools\",\"subtitle\":\"Facilities and Services\",\"description\":\"Each classroom is outfitted with smart boards, advanced projectors, and audio-visual systems, enabling interactive and engaging learning experiences. By integrating cutting-edge educational technologies, the complex enhances learning quality and actively involves students in the educational process.\",\"features\":[]}', 'en', 1, 'facilities', 1, 'assets/images/facilities/classes.png', '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(28, 'facility_item', '{\"title\":\"Advanced Scientific Laboratories\",\"subtitle\":\"Facilities and Services\",\"description\":\"The complex features fully equipped laboratories for chemistry and biology, providing a practical and stimulating environment for experiments, research projects, and skill enhancement in the sciences.\",\"features\":[]}', 'en', 1, 'facilities', 2, 'assets/images/facilities/laboratoy.jpg', '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(29, 'facility_item', '{\"title\":\"Comprehensive Library\",\"subtitle\":\"Facilities and Services\",\"description\":\"With thousands of printed books, the library offers a quiet, resourceful space for study and research. Digital search tools and access to scientific resources further support students in achieving academic and research excellence.\",\"features\":[]}', 'en', 1, 'facilities', 3, 'assets/images/facilities/library.png', '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(30, 'facility_item', '{\"title\":\"Sports Facilities and Recreation Areas\",\"subtitle\":\"Facilities and Services\",\"description\":\"The Salman Farsi Educational Complex offers diverse sports facilities to enhance students\' physical health and teamwork spirit.\",\"features\":[\"Multiple grass sports fields\",\"Multifunctional indoor sports halls\",\"Facilities for activities such as football, volleyball, basketball, and table tennis\"],\"additional_text\":\"These amenities, coupled with organized sports programs, encourage physical health and teamwork.\"}', 'en', 1, 'facilities', 4, 'assets/images/facilities/football feild.png', '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(31, 'facility_item', '{\"title\":\"Cultural and Artistic Activities\",\"subtitle\":\"Facilities and Services\",\"description\":\"The Salman Farsi Complex helps develop students\' multidimensional talents through rich cultural and artistic programs.\",\"features\":[\"National and religious celebrations\",\"Art exhibitions and creativity workshops\",\"Training in arts such as painting, music, and theater\"]}', 'en', 1, 'facilities', 5, 'assets/images/facilities/arts.png', '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(32, 'facility_item', '{\"title\":\"Prayer Hall and Religious Programs\",\"subtitle\":\"Facilities and Services\",\"description\":\"The prayer hall provides a welcoming environment for congregational prayers, Quranic sessions, and ethical discussions, fostering students\' spiritual and moral growth.\",\"features\":[]}', 'en', 1, 'facilities', 6, 'assets/images/facilities/prayerhall.jpg', '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(33, 'facility_item', '{\"title\":\"Health Clinic and Wellness Services\",\"subtitle\":\"Facilities and Services\",\"description\":\"Supervised by qualified medical professionals, the health clinic offers:\",\"features\":[\"Routine medical check-ups\",\"Vaccination programs\",\"Nutritional and psychological counseling\"],\"additional_text\":\"These services aim to maintain and improve the physical and mental health of students.\"}', 'en', 1, 'facilities', 7, 'assets/images/facilities/clinic.png', '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(34, 'facility_item', '{\"title\":\"Counseling and Guidance Services\",\"subtitle\":\"Facilities and Services\",\"description\":\"Professional counselors support students academically, emotionally, and socially through:\",\"features\":[\"Individual and group counseling\",\"Life skills workshops\",\"Career guidance sessions\"]}', 'en', 1, 'facilities', 8, 'assets/images/facilities/counseling.jpg', '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(35, 'facility_item', '{\"title\":\"Hygienic Cafeteria with Nutritious Meals\",\"subtitle\":\"Facilities and Services\",\"description\":\"The cafeteria ensures access to healthy, nutritious meals and snacks, promoting balanced diets to sustain student energy and overall well-being.\",\"features\":[]}', 'en', 1, 'facilities', 9, 'assets/images/facilities/cafeteria.jpg', '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(36, 'facility_item', '{\"title\":\"Support for Students with Special Needs\",\"subtitle\":\"Facilities and Services\",\"description\":\"Specialized services cater to students with unique needs, including:\",\"features\":[\"Speech therapy and rehabilitation\",\"Personalized counseling\",\"Social skills development programs\"]}', 'en', 1, 'facilities', 10, 'assets/images/facilities/Primary Reception.png', '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(37, 'facility_item', '{\"title\":\"Safety and Crisis Preparedness\",\"subtitle\":\"Facilities and Services\",\"description\":\"The complex adheres to rigorous safety protocols, providing courses on crisis management, fire safety, and earthquake preparedness to equip students for emergencies.\",\"features\":[],\"focus_title\":\"Key Focus: Crisis Management Training\",\"focus_text\":\"We empower students with the knowledge and skills to handle emergencies effectively, preparing them for any unexpected situation.\"}', 'en', 1, 'facilities', 11, 'assets/images/facilities/saftey.jpg', '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(38, 'facility_item', '{\"title\":\"الفصول الدراسية الذكية وأدوات التعليم الحديثة\",\"subtitle\":\"المرافق والخدمات\",\"description\":\"تم تجهيز كل فصل دراسي بالسبورات الذكية وأجهزة العرض المتطورة وأنظمة الصوت والصورة، مما يتيح تجارب تعليمية تفاعلية وجذابة. من خلال دمج تقنيات التعليم المتطورة، يعزز المجمع جودة التعلم ويشرك الطلاب بنشاط في العملية التعليمية.\",\"features\":[]}', 'ar', 1, 'facilities', 1, 'assets/images/facilities/classes.png', '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(39, 'facility_item', '{\"title\":\"المختبرات العلمية المتقدمة\",\"subtitle\":\"المرافق والخدمات\",\"description\":\"يضم المجمع مختبرات مجهزة بالكامل للكيمياء والأحياء، مما يوفر بيئة عملية ومحفزة للتجارب ومشاريع البحث وتعزيز المهارات في العلوم.\",\"features\":[]}', 'ar', 1, 'facilities', 2, 'assets/images/facilities/laboratoy.jpg', '2025-03-28 17:21:05', '2025-03-28 17:21:05'),
(40, 'facility_item', '{\"title\":\"مكتبة شاملة\",\"subtitle\":\"المرافق والخدمات\",\"description\":\"مع آلاف الكتب المطبوعة، توفر المكتبة مساحة هادئة وغنية بالموارد للدراسة والبحث. تدعم أدوات البحث الرقمية والوصول إلى الموارد العلمية الطلاب في تحقيق التفوق الأكاديمي والبحثي.\",\"features\":[]}', 'ar', 1, 'facilities', 3, 'assets/images/facilities/library.png', '2025-03-28 17:21:05', '2025-03-28 17:21:05');

-- --------------------------------------------------------

--
-- Table structure for table `faq_content`
--

CREATE TABLE `faq_content` (
  `id` int(11) NOT NULL,
  `field_key` varchar(255) NOT NULL COMMENT 'کلید یکتا برای شناسایی محتوا',
  `content` text NOT NULL COMMENT 'محتوای متنی یا JSON',
  `language_id` varchar(5) NOT NULL DEFAULT 'fa' COMMENT 'کد زبان (fa=1, en=2, ar=3)',
  `is_repeatable` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'آیا این محتوا تکرارشونده است',
  `category_id` varchar(50) DEFAULT NULL COMMENT 'دسته‌بندی سوال (برای سوالات)',
  `sort_order` int(11) DEFAULT NULL COMMENT 'ترتیب نمایش',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq_content`
--

INSERT INTO `faq_content` (`id`, `field_key`, `content`, `language_id`, `is_repeatable`, `category_id`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'page_title', 'سوالات متداول', 'fa', 0, NULL, NULL, '2025-03-28 17:14:23', '2025-03-28 17:19:37'),
(2, 'page_subtitle', 'پاسخ سوالات رایج درباره مجتمع آموزشی سلمان را در اینجا بیابید', 'fa', 0, NULL, NULL, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(3, 'search_placeholder', 'جستجو در سوالات متداول...', 'fa', 0, NULL, NULL, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(4, 'no_results', 'نتیجه‌ای یافت نشد', 'fa', 0, NULL, NULL, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(5, 'try_again', 'لطفاً عبارت جستجوی دیگری را امتحان کنید یا برای اطلاعات بیشتر با ما تماس بگیرید', 'fa', 0, NULL, NULL, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(6, 'more_questions', 'هنوز سوالی دارید؟', 'fa', 0, NULL, NULL, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(7, 'contact_us_text', 'اگر پاسخ سوال خود را پیدا نکردید، لطفاً شرایط و ضوابط ثبت‌نام ما را بررسی کنید یا با تیم پشتیبانی ما تماس بگیرید. ما آماده کمک به شما هستیم.', 'fa', 0, NULL, NULL, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(8, 'register_sidebar_title', 'به دنبال ثبت‌نام هستید؟', 'fa', 0, NULL, NULL, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(9, 'register_sidebar_text', 'برای کسب اطلاعات بیشتر درباره شرایط و ضوابط ثبت‌نام و مدارک مورد نیاز، با ما تماس بگیرید.', 'fa', 0, NULL, NULL, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(10, 'register_button', 'شرایط و ضوابط ثبت‌نام', 'fa', 0, NULL, NULL, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(11, 'page_title', 'Frequently Asked Questions', 'en', 0, NULL, NULL, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(12, 'page_subtitle', 'Find answers to common questions about Salman Educational Complex', 'en', 0, NULL, NULL, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(13, 'search_placeholder', 'Search FAQs...', 'en', 0, NULL, NULL, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(14, 'no_results', 'No results found', 'en', 0, NULL, NULL, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(15, 'try_again', 'Please try different search terms or contact us for more information', 'en', 0, NULL, NULL, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(16, 'more_questions', 'Still Have Questions?', 'en', 0, NULL, NULL, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(17, 'contact_us_text', 'If you couldn\'t find the answer to your question, please check our registration terms or contact our support team. We\'re here to help you.', 'en', 0, NULL, NULL, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(18, 'register_sidebar_title', 'Looking to Register?', 'en', 0, NULL, NULL, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(19, 'register_sidebar_text', 'Contact us for more information about registration requirements.', 'en', 0, NULL, NULL, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(20, 'register_button', 'Registration Terms', 'en', 0, NULL, NULL, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(21, 'page_title', 'الأسئلة المتداولة', 'ar', 0, NULL, NULL, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(22, 'page_subtitle', 'ابحث عن إجابات للأسئلة الشائعة حول مجمع سلمان التعليمي', 'ar', 0, NULL, NULL, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(23, 'search_placeholder', 'بحث في الأسئلة المتداولة...', 'ar', 0, NULL, NULL, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(24, 'no_results', 'لم يتم العثور على نتائج', 'ar', 0, NULL, NULL, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(25, 'try_again', 'الرجاء تجربة مصطلحات بحث مختلفة أو الاتصال بنا للحصول على مزيد من المعلومات', 'ar', 0, NULL, NULL, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(26, 'more_questions', 'هل لا تزال لديك أسئلة؟', 'ar', 0, NULL, NULL, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(27, 'contact_us_text', 'إذا لم تتمكن من العثور على إجابة لسؤالك، يرجى التحقق من شروط التسجيل لدينا أو الاتصال بفريق الدعم لدينا. نحن هنا لمساعدتك.', 'ar', 0, NULL, NULL, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(28, 'register_sidebar_title', 'هل تبحث عن التسجيل؟', 'ar', 0, NULL, NULL, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(29, 'register_sidebar_text', 'اتصل بنا للحصول على مزيد من المعلومات حول متطلبات التسجيل.', 'ar', 0, NULL, NULL, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(30, 'register_button', 'شروط التسجيل', 'ar', 0, NULL, NULL, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(31, 'category', '{\"id\":\"general\",\"title\":\"اطلاعات عمومی\",\"icon\":\"fa-info-circle\",\"color\":\"#6941C6\"}', 'fa', 1, NULL, 1, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(32, 'category', '{\"id\":\"admissions\",\"title\":\"پذیرش و ثبت‌نام\",\"icon\":\"fa-user-plus\",\"color\":\"#9E77ED\"}', 'fa', 1, NULL, 2, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(33, 'category', '{\"id\":\"services\",\"title\":\"خدمات مدرسه\",\"icon\":\"fa-hands-helping\",\"color\":\"#7F56D9\"}', 'fa', 1, NULL, 3, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(34, 'category', '{\"id\":\"academics\",\"title\":\"اطلاعات تحصیلی\",\"icon\":\"fa-graduation-cap\",\"color\":\"#4E36B1\"}', 'fa', 1, NULL, 4, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(35, 'category', '{\"id\":\"general\",\"title\":\"General Information\",\"icon\":\"fa-info-circle\",\"color\":\"#6941C6\"}', 'en', 1, NULL, 1, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(36, 'category', '{\"id\":\"admissions\",\"title\":\"Admissions & Registration\",\"icon\":\"fa-user-plus\",\"color\":\"#9E77ED\"}', 'en', 1, NULL, 2, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(37, 'category', '{\"id\":\"services\",\"title\":\"School Services\",\"icon\":\"fa-hands-helping\",\"color\":\"#7F56D9\"}', 'en', 1, NULL, 3, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(38, 'category', '{\"id\":\"academics\",\"title\":\"Academic Information\",\"icon\":\"fa-graduation-cap\",\"color\":\"#4E36B1\"}', 'en', 1, NULL, 4, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(39, 'category', '{\"id\":\"general\",\"title\":\"معلومات عامة\",\"icon\":\"fa-info-circle\",\"color\":\"#6941C6\"}', 'ar', 1, NULL, 1, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(40, 'category', '{\"id\":\"admissions\",\"title\":\"القبول والتسجيل\",\"icon\":\"fa-user-plus\",\"color\":\"#9E77ED\"}', 'ar', 1, NULL, 2, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(41, 'category', '{\"id\":\"services\",\"title\":\"خدمات المدرسة\",\"icon\":\"fa-hands-helping\",\"color\":\"#7F56D9\"}', 'ar', 1, NULL, 3, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(42, 'category', '{\"id\":\"academics\",\"title\":\"المعلومات الأكاديمية\",\"icon\":\"fa-graduation-cap\",\"color\":\"#4E36B1\"}', 'ar', 1, NULL, 4, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(43, 'faq_item', '{\"question\":\"زبان تدریس در مدرسه چه زبان‌هایی است؟\",\"answer\":\"زبان تدریس اصلی در مدرسه ما فارسی است، با این حال، زبان‌های انگلیسی و عربی نیز در برنامه درسی گنجانده شده‌اند تا مهارت‌های زبانی دانش‌آموزان تقویت شود.\"}', 'fa', 1, 'general', 1, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(44, 'faq_item', '{\"question\":\"What languages are used for instruction at the school?\",\"answer\":\"The primary language of instruction at our school is Persian, while English and Arabic are also included in the curriculum to enhance students\' language skills.\"}', 'en', 1, 'general', 1, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(45, 'faq_item', '{\"question\":\"ما هي اللغات المستخدمة للتدريس في المدرسة؟\",\"answer\":\"اللغة الرئيسية للتدريس في مدرستنا هي الفارسية، بينما يتم أيضًا تضمين اللغتين الإنجليزية والعربية في المنهج لتعزيز المهارات اللغوية للطلاب.\"}', 'ar', 1, 'general', 1, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(46, 'faq_item', '{\"question\":\"ساعات کاری مدرسه و تعطیلات رسمی چگونه است؟\",\"answer\":\"ساعات کاری مدرسه از دوشنبه تا جمعه از ساعت ۷ صبح تا ۴ بعدازظهر است. شنبه‌ها تنها برای امور اداری مدرسه است. تعطیلات رسمی شامل تعطیلات تابستانی، تعطیلات نوروزی، تعطیلات ماه رمضان و تعطیلات ملی کشور است.\"}', 'fa', 1, 'general', 2, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(47, 'faq_item', '{\"question\":\"What are the school working hours and official holidays?\",\"answer\":\"The school operates from Monday to Friday, from 7 AM to 4 PM. Saturdays are reserved for administrative tasks. Official holidays include summer vacation, Nowruz break, Ramadan break, and national holidays.\"}', 'en', 1, 'general', 2, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(48, 'faq_item', '{\"question\":\"ما هي ساعات عمل المدرسة والعطلات الرسمية؟\",\"answer\":\"تعمل المدرسة من الاثنين إلى الجمعة، من الساعة 7 صباحًا حتى 4 مساءً. يتم تخصيص أيام السبت للمهام الإدارية. تشمل العطلات الرسمية إجازة الصيف، وعطلة النوروز، وعطلة شهر رمضان، والعطلات الوطنية.\"}', 'ar', 1, 'general', 2, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(49, 'faq_item', '{\"question\":\"مدرسه از چه برنامه درسی پیروی می‌کند؟\",\"answer\":\"مدرسه ما از برنامه درسی رسمی ایران که توسط وزارت آموزش و پرورش تأیید شده است، پیروی می‌کند و همچنین اجزای بین‌المللی اضافی را برای ارائه آموزش جامع در برنامه دارد. دانش‌آموزان از کتاب‌های درسی استاندارد ایرانی استفاده می‌کنند و همچنین از مواد آموزشی تکمیلی که تجربه یادگیری آنها را ارتقا می‌دهد، بهره‌مند می‌شوند.\"}', 'fa', 1, 'general', 3, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(50, 'faq_item', '{\"question\":\"What curriculum does the school follow?\",\"answer\":\"Our school follows the official Iranian curriculum approved by the Ministry of Education, with additional international components to provide a well-rounded education. Students follow the standard Iranian textbooks while also benefiting from complementary educational materials that enhance their learning experience.\"}', 'en', 1, 'general', 3, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(51, 'faq_item', '{\"question\":\"ما هو المنهج الذي تتبعه المدرسة؟\",\"answer\":\"تتبع مدرستنا المنهج الإيراني الرسمي المعتمد من وزارة التعليم، مع مكونات دولية إضافية لتوفير تعليم شامل. يتبع الطلاب الكتب المدرسية الإيرانية القياسية مع الاستفادة أيضًا من المواد التعليمية التكميلية التي تعزز تجربة التعلم لديهم.\"}', 'ar', 1, 'general', 3, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(52, 'faq_item', '{\"question\":\"چه فعالیت‌های فوق برنامه‌ای ارائه می‌شود؟\",\"answer\":\"ما طیف متنوعی از فعالیت‌های فوق برنامه از جمله ورزش (فوتبال، والیبال، بسکتبال، شنا)، هنر (موسیقی، نقاشی، خوشنویسی)، انجمن‌های فرهنگی، انجمن‌های علمی و فناوری و مسابقات آموزشی ارائه می‌دهیم. این فعالیت‌ها برای توسعه استعدادها، علایق و مهارت‌های اجتماعی دانش‌آموزان فراتر از یادگیری آکادمیک طراحی شده‌اند.\"}', 'fa', 1, 'general', 4, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(53, 'faq_item', '{\"question\":\"What extracurricular activities are offered?\",\"answer\":\"We offer a variety of extracurricular activities including sports (soccer, volleyball, basketball, swimming), arts (music, painting, calligraphy), cultural clubs, science and technology clubs, and educational competitions. These activities are designed to develop students\' talents, interests, and social skills beyond academic learning.\"}', 'en', 1, 'general', 4, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(54, 'faq_item', '{\"question\":\"ما هي الأنشطة اللامنهجية المقدمة؟\",\"answer\":\"نقدم مجموعة متنوعة من الأنشطة اللامنهجية بما في ذلك الرياضة (كرة القدم، الكرة الطائرة، كرة السلة، السباحة)، والفنون (الموسيقى، الرسم، الخط)، والنوادي الثقافية، ونوادي العلوم والتكنولوجيا، والمسابقات التعليمية. تم تصميم هذه الأنشطة لتطوير مواهب الطلاب واهتماماتهم ومهاراتهم الاجتماعية بما يتجاوز التعلم الأكاديمي.\"}', 'ar', 1, 'general', 4, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(55, 'faq_item', '{\"question\":\"نحوه ثبت‌نام در مدرسه چیست و مدارک و زمان‌بندی ثبت‌نام چگونه است؟\",\"answer\":\"برای ثبت‌نام در مدرسه، والدین باید به صورت حضوری مراجعه کرده و مدارک مورد نیاز شامل شناسنامه، کارت ملی، گواهی سلامت، عکس پرسنلی و مدارک تحصیلی قبلی را ارائه دهند. لطفاً برای اطلاعات دقیق‌تر و مطمئن‌شدن از مدارک لازم، قبل از مراجعه حضوری با مدرسه تماس بگیرید. ثبت‌نام در ماه‌های خرداد و تیر انجام می‌شود و در صورتی که بعد از این زمان ثبت‌نام صورت گیرد، هزینه‌ای تحت عنوان جریمه دریافت خواهد شد.\"}', 'fa', 1, 'admissions', 1, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(56, 'faq_item', '{\"question\":\"What is the registration process, and what are the required documents and timeline?\",\"answer\":\"To register at the school, parents need to visit the school in person and provide required documents such as birth certificate, ID card, health certificate, passport-sized photo, and previous academic records. For detailed information and to confirm the necessary documents, please contact the school before visiting. Registration typically occurs in June and July, and late registrations will incur an additional penalty fee.\"}', 'en', 1, 'admissions', 1, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(57, 'faq_item', '{\"question\":\"ما هي عملية التسجيل، وما هي المستندات المطلوبة والجدول الزمني؟\",\"answer\":\"للتسجيل في المدرسة، يحتاج الآباء إلى زيارة المدرسة شخصيًا وتقديم المستندات المطلوبة مثل شهادة الميلاد، وبطاقة الهوية، والشهادة الصحية، وصورة بحجم جواز السفر، والسجلات الأكاديمية السابقة. للحصول على معلومات مفصلة وللتأكد من المستندات الضرورية، يرجى الاتصال بالمدرسة قبل الزيارة. يتم التسجيل عادة في يونيو ويوليو، وستتحمل التسجيلات المتأخرة رسوم جزائية إضافية.\"}', 'ar', 1, 'admissions', 1, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(58, 'faq_item', '{\"question\":\"هزینه‌های شهریه مدرسه چقدر است و شامل چه مواردی می‌شود؟\",\"answer\":\"هزینه‌های شهریه بر اساس مقطع تحصیلی و رشته انتخابی متفاوت است. شهریه شامل هزینه‌های آموزشی، کتاب‌های درسی، فعالیت‌های فوق‌برنامه و خدمات پایه مدرسه می‌شود. برای اطلاعات دقیق‌تر، لطفاً با بخش مالی مدرسه تماس بگیرید.\"}', 'fa', 1, 'admissions', 2, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(59, 'faq_item', '{\"question\":\"What are the tuition fees and what do they cover?\",\"answer\":\"Tuition fees vary depending on the grade level and chosen specialization. The fees cover educational costs, textbooks, extracurricular activities, and basic school services. For more precise details, please contact the school\'s finance department.\"}', 'en', 1, 'admissions', 2, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(60, 'faq_item', '{\"question\":\"ما هي الرسوم الدراسية وماذا تغطي؟\",\"answer\":\"تختلف الرسوم الدراسية حسب المرحلة الدراسية والتخصص المختار. تغطي الرسوم التكاليف التعليمية، والكتب المدرسية، والأنشطة اللاصفية، والخدمات المدرسية الأساسية. للحصول على تفاصيل أكثر دقة، يرجى الاتصال بقسم المالية في المدرسة.\"}', 'ar', 1, 'admissions', 2, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(61, 'faq_item', '{\"question\":\"چه مدارکی برای ثبت‌نام دانش‌آموز لازم است؟\",\"answer\":\"مدارک مورد نیاز شامل: پاسپورت و کارت شناسایی امارات دانش‌آموز (اصل و کپی)، گواهی تولد، ۶ قطعه عکس پرسنلی با پس‌زمینه سفید، سوابق بهداشتی و واکسیناسیون، سوابق و کارنامه‌های تحصیلی قبلی، گواهی انتقال از مدرسه قبلی (در صورت وجود) و مدارک شناسایی والدین می‌باشد. دانش‌آموزان بین‌المللی ممکن است به مدارک اضافی طبق مقررات امارات متحده عربی نیاز داشته باشند.\"}', 'fa', 1, 'admissions', 3, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(62, 'faq_item', '{\"question\":\"What documents are required for student registration?\",\"answer\":\"Required documents include: student\'s passport and Emirates ID (original and copy), birth certificate, 6 passport-sized photos with white background, health and vaccination records, previous academic records and transcripts, transfer certificate from previous school (if applicable), and parents\' identification documents. International students may need additional documentation according to UAE regulations.\"}', 'en', 1, 'admissions', 3, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(63, 'faq_item', '{\"question\":\"ما هي المستندات المطلوبة لتسجيل الطالب؟\",\"answer\":\"تشمل المستندات المطلوبة: جواز سفر الطالب وبطاقة الهوية الإماراتية (الأصل والنسخة)، وشهادة الميلاد، و6 صور بحجم جواز السفر بخلفية بيضاء، وسجلات الصحة والتطعيم، والسجلات الأكاديمية السابقة والنصوص، وشهادة النقل من المدرسة السابقة (إن وجدت)، ووثائق تعريف الوالدين. قد يحتاج الطلاب الدوليون إلى وثائق إضافية وفقًا للوائح الإمارات العربية المتحدة.\"}', 'ar', 1, 'admissions', 3, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(64, 'faq_item', '{\"question\":\"شرایط سنی برای پذیرش چیست؟\",\"answer\":\"شرایط سنی بسته به مقطع تحصیلی متفاوت است. برای پیش‌دبستانی، دانش‌آموزان باید حداقل ۴ سال تا ۳۱ مرداد سال تحصیلی داشته باشند. برای کلاس اول، دانش‌آموزان باید حداقل ۶ سال سن داشته باشند. برای سایر مقاطع، پیشرفت سنی مناسب اعمال می‌شود. در موارد خاص، ممکن است از آزمون‌های تعیین سطح برای تعیین مقطع تحصیلی مناسب بر اساس توانایی‌های تحصیلی دانش‌آموز استفاده شود.\"}', 'fa', 1, 'admissions', 4, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(65, 'faq_item', '{\"question\":\"What are the age requirements for admission?\",\"answer\":\"Age requirements depend on the grade level. For kindergarten, students must be at least 4 years old by August 31st of the academic year. For first grade, students must be at least 6 years old. For other grades, appropriate age progression applies. In special cases, placement tests may be used to determine the suitable grade level based on the student\'s academic abilities.\"}', 'en', 1, 'admissions', 4, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(66, 'faq_item', '{\"question\":\"ما هي متطلبات العمر للقبول؟\",\"answer\":\"تعتمد متطلبات العمر على مستوى الصف. لرياض الأطفال، يجب أن يكون عمر الطلاب 4 سنوات على الأقل بحلول 31 أغسطس من العام الدراسي. للصف الأول، يجب أن يكون عمر الطلاب 6 سنوات على الأقل. بالنسبة للصفوف الأخرى، ينطبق التقدم العمري المناسب. في الحالات الخاصة، يمكن استخدام اختبارات تحديد المستوى لتحديد المستوى الصفي المناسب بناءً على القدرات الأكاديمية للطالب.\"}', 'ar', 1, 'admissions', 4, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(67, 'faq_item', '{\"question\":\"مدرسه چگونه به حمل و نقل و جابه‌جایی دانش‌آموزان رسیدگی می‌کند؟\",\"answer\":\"مدرسه خدمات حمل و نقل ایمن و قابل اعتماد را برای دانش‌آموزان فراهم می‌آورد. سرویس‌های مدرسه شامل اتوبوس‌های مجهز با رانندگان ماهر است و مسیرها تحت نظارت دقیق قرار دارند. برای اطلاعات بیشتر و ثبت‌نام در سرویس حمل و نقل، لطفاً با بخش حمل و نقل مدرسه تماس بگیرید.\"}', 'fa', 1, 'services', 1, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(68, 'faq_item', '{\"question\":\"How does the school handle student transportation?\",\"answer\":\"The school provides safe and reliable transportation services for students. The bus services include well-equipped buses with skilled drivers, and routes are closely monitored. For more information and to register for transportation, please contact the school\'s transportation department.\"}', 'en', 1, 'services', 1, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(69, 'faq_item', '{\"question\":\"كيف تتعامل المدرسة مع نقل الطلاب؟\",\"answer\":\"توفر المدرسة خدمات نقل آمنة وموثوقة للطلاب. تشمل خدمات الحافلات حافلات مجهزة جيدًا مع سائقين مهرة، ويتم مراقبة المسارات عن كثب. لمزيد من المعلومات والتسجيل في النقل، يرجى الاتصال بقسم النقل في المدرسة.\"}', 'ar', 1, 'services', 1, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(70, 'faq_item', '{\"question\":\"آیا مدرسه برنامه‌ای برای دانش‌آموزانی که نیاز به حمایت ویژه دارند دارد؟\",\"answer\":\"بله، مدرسه ما برنامه‌های ویژه‌ای برای حمایت از دانش‌آموزان با نیازهای خاص دارد. این برنامه‌ها شامل آموزش فردی و حمایت‌های روان‌شناختی و اجتماعی است تا به دانش‌آموزان کمک کند تا در محیط آموزشی به بهترین شکل ممکن پیشرفت کنند.\"}', 'fa', 1, 'services', 2, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(71, 'faq_item', '{\"question\":\"Does the school have a program for students who require special support?\",\"answer\":\"Yes, our school offers specialized programs to support students with special needs. These programs include individualized teaching and psychological and social support to help students succeed in the educational environment.\"}', 'en', 1, 'services', 2, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(72, 'faq_item', '{\"question\":\"هل لدى المدرسة برنامج للطلاب الذين يحتاجون إلى دعم خاص؟\",\"answer\":\"نعم، تقدم مدرستنا برامج متخصصة لدعم الطلاب ذوي الاحتياجات الخاصة. تشمل هذه البرامج التدريس الفردي والدعم النفسي والاجتماعي لمساعدة الطلاب على النجاح في البيئة التعليمية.\"}', 'ar', 1, 'services', 2, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(73, 'faq_item', '{\"question\":\"آیا مدرسه غذاخوری دارد و چه نوع غذایی سرو می‌شود؟\",\"answer\":\"بله، مدرسه ما دارای غذاخوری است که وعده‌های غذایی مغذی و متعادل ارائه می‌دهد. منوی غذا شامل انواع گزینه‌های سالم از جمله غذاهای محلی و بین‌المللی است، با توجه ویژه به محدودیت‌ها و ترجیحات غذایی. غذا هر روز تازه و تحت استانداردهای بهداشتی سختگیرانه تهیه می‌شود. والدین همچنین می‌توانند در صورت تمایل، برای فرزندان خود غذای بسته‌بندی شده بفرستند.\"}', 'fa', 1, 'services', 3, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(74, 'faq_item', '{\"question\":\"Does the school have a cafeteria and what type of food is served?\",\"answer\":\"Yes, our school has a cafeteria that serves nutritious and balanced meals. The menu includes a variety of healthy options including local and international cuisine, with special attention to dietary restrictions and preferences. The food is prepared fresh daily under strict hygiene standards. Parents can also opt to send packed lunches for their children if preferred.\"}', 'en', 1, 'services', 3, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(75, 'faq_item', '{\"question\":\"هل لدى المدرسة كافتيريا وما نوع الطعام الذي يتم تقديمه؟\",\"answer\":\"نعم، تحتوي مدرستنا على كافتيريا تقدم وجبات مغذية ومتوازنة. تشمل القائمة مجموعة متنوعة من الخيارات الصحية بما في ذلك المأكولات المحلية والعالمية، مع اهتمام خاص بالقيود والتفضيلات الغذائية. يتم تحضير الطعام طازجًا يوميًا وفق معايير صحية صارمة. يمكن للوالدين أيضًا اختيار إرسال وجبات غداء معبأة لأطفالهم إذا كانوا يفضلون ذلك.\"}', 'ar', 1, 'services', 3, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(76, 'faq_item', '{\"question\":\"چه خدمات بهداشتی در مدرسه در دسترس است؟\",\"answer\":\"مدرسه ما مجهز به یک کلینیک پزشکی با پرستاران واجد شرایط در ساعات مدرسه است. کلینیک خدمات کمک‌های اولیه، رسیدگی به جراحات و بیماری‌های جزئی و مدیریت چکاپ‌های معمول سلامت برای دانش‌آموزان را ارائه می‌دهد. در صورت بروز شرایط اضطراری، ما پروتکل‌هایی برای اطمینان از پاسخ سریع و ارتباط با والدین داریم. علاوه بر این، ما سوابق بهداشتی به‌روز برای تمام دانش‌آموزان از جمله سوابق واکسیناسیون و هرگونه شرایط خاص سلامتی را نگهداری می‌کنیم.\"}', 'fa', 1, 'services', 4, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(77, 'faq_item', '{\"question\":\"What healthcare services are available at school?\",\"answer\":\"Our school is equipped with a medical clinic staffed by qualified nurses during school hours. The clinic provides first aid, handles minor injuries and illnesses, and manages routine health check-ups for students. In case of emergencies, we have protocols in place to ensure rapid response and communication with parents. Additionally, we maintain updated health records for all students including vaccination histories and any specific health conditions.\"}', 'en', 1, 'services', 4, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(78, 'faq_item', '{\"question\":\"ما هي الخدمات الصحية المتاحة في المدرسة؟\",\"answer\":\"تم تجهيز مدرستنا بعيادة طبية يعمل بها ممرضات مؤهلات خلال ساعات الدراسة. تقدم العيادة الإسعافات الأولية، وتتعامل مع الإصابات والأمراض البسيطة، وتدير فحوصات صحية روتينية للطلاب. في حالة الطوارئ، لدينا بروتوكولات موضوعة لضمان الاستجابة السريعة والتواصل مع أولياء الأمور. بالإضافة إلى ذلك، نحتفظ بسجلات صحية محدثة لجميع الطلاب بما في ذلك تاريخ التطعيم وأي حالات صحية محددة.\"}', 'ar', 1, 'services', 4, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(79, 'faq_item', '{\"question\":\"دانش‌آموزان در طول سال چگونه ارزیابی می‌شوند؟\",\"answer\":\"دانش‌آموزان از طریق یک سیستم ارزیابی جامع شامل ارزیابی مستمر، امتحانات میان‌ترم و پایان‌ترم، پروژه‌ها و مشارکت کلاسی ارزیابی می‌شوند. ما از روش‌های ارزیابی تکوینی و تجمعی استفاده می‌کنیم تا اطمینان حاصل شود که پیشرفت دانش‌آموز به صورت همه‌جانبه ارزیابی می‌شود. کارنامه‌ها به صورت فصلی صادر می‌شوند و بازخورد دقیقی در مورد عملکرد تحصیلی و رشد شخصی ارائه می‌دهند.\"}', 'fa', 1, 'academics', 1, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(80, 'faq_item', '{\"question\":\"How are students assessed throughout the year?\",\"answer\":\"Students are assessed through a comprehensive evaluation system including continuous assessment, mid-term and final examinations, projects, and class participation. We use both formative and summative assessment methods to ensure a holistic evaluation of student progress. Report cards are issued quarterly, providing detailed feedback on academic performance and personal development.\"}', 'en', 1, 'academics', 1, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(81, 'faq_item', '{\"question\":\"كيف يتم تقييم الطلاب على مدار العام؟\",\"answer\":\"يتم تقييم الطلاب من خلال نظام تقييم شامل يتضمن التقييم المستمر، والامتحانات النصفية والنهائية، والمشاريع، والمشاركة الصفية. نستخدم طرق التقييم التكويني والتلخيصي لضمان تقييم شامل لتقدم الطالب. يتم إصدار بطاقات التقارير كل ثلاثة أشهر، مما يوفر تعليقات مفصلة حول الأداء الأكاديمي والتطور الشخصي.\"}', 'ar', 1, 'academics', 1, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(82, 'faq_item', '{\"question\":\"آیا مدرسه آمادگی برای آزمون‌های بین‌المللی ارائه می‌دهد؟\",\"answer\":\"بله، ما دوره‌های آمادگی برای چندین آزمون بین‌المللی از جمله تافل، آیلتس و SAT برای دانش‌آموزان بزرگتر ارائه می‌دهیم. این دوره‌های آمادگی به عنوان برنامه‌های اختیاری ارائه می‌شوند و برای کمک به دانش‌آموزان در رسیدن به استانداردهای آکادمیک بین‌المللی و آمادگی برای تحصیلات عالی در خارج از کشور طراحی شده‌اند. معلمان واجد شرایط ما از مواد تخصصی و استراتژی‌های متمرکز بر آزمون استفاده می‌کنند تا موفقیت دانش‌آموزان را در این آزمون‌ها به حداکثر برسانند.\"}', 'fa', 1, 'academics', 2, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(83, 'faq_item', '{\"question\":\"Does the school offer preparation for international examinations?\",\"answer\":\"Yes, we provide preparation courses for several international examinations including TOEFL, IELTS, and SAT for older students. These preparation courses are offered as optional programs and are designed to help students meet international academic standards and prepare for higher education abroad. Our qualified teachers use specialized materials and exam-focused strategies to maximize students\' success in these tests.\"}', 'en', 1, 'academics', 2, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(84, 'faq_item', '{\"question\":\"هل تقدم المدرسة تحضيرًا للامتحانات الدولية؟\",\"answer\":\"نعم، نقدم دورات تحضيرية للعديد من الامتحانات الدولية بما في ذلك التوفل والآيلتس و SAT للطلاب الأكبر سناً. يتم تقديم هذه الدورات التحضيرية كبرامج اختيارية وهي مصممة لمساعدة الطلاب على تلبية المعايير الأكاديمية الدولية والاستعداد للتعليم العالي في الخارج. يستخدم مدرسونا المؤهلون مواد متخصصة واستراتيجيات تركز على الامتحانات لتحقيق أقصى قدر من نجاح الطلاب في هذه الاختبارات.\"}', 'ar', 1, 'academics', 2, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(85, 'faq_item', '{\"question\":\"سیاست مدرسه در مورد تکالیف خانه چیست؟\",\"answer\":\"سیاست تکلیف خانه ما برای تقویت یادگیری کلاسی بدون ایجاد فشار بیش از حد بر دانش‌آموزان طراحی شده است. میزان تکالیف متناسب با سن است و با پیشرفت دانش‌آموزان در مقاطع تحصیلی به تدریج افزایش می‌یابد. تکالیف معمولاً شامل تمرین منظم در دروس اصلی، تکالیف خواندن و گاهی کار پروژه‌ای است. ما مشارکت والدین را در بررسی تکالیف تشویق می‌کنیم، اما تأکید داریم که کار باید عمدتاً توسط دانش‌آموزان انجام شود تا استقلال و مسئولیت‌پذیری آنها تقویت شود.\"}', 'fa', 1, 'academics', 3, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(86, 'faq_item', '{\"question\":\"What is the school\'s homework policy?\",\"answer\":\"Our homework policy is designed to reinforce classroom learning without overwhelming students. The amount of homework is age-appropriate and increases gradually as students advance in grades. Homework typically includes regular practice in core subjects, reading assignments, and occasional project work. We encourage parental involvement in reviewing homework but emphasize that the work should primarily be completed by students to develop their independence and responsibility.\"}', 'en', 1, 'academics', 3, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(87, 'faq_item', '{\"question\":\"ما هي سياسة المدرسة للواجبات المنزلية؟\",\"answer\":\"تم تصميم سياسة الواجبات المنزلية لدينا لتعزيز التعلم في الفصل دون إرهاق الطلاب. كمية الواجبات المنزلية مناسبة للعمر وتزداد تدريجياً مع تقدم الطلاب في الصفوف. تتضمن الواجبات المنزلية عادةً ممارسة منتظمة في المواد الأساسية، ومهام القراءة، والعمل في المشاريع من حين لآخر. نشجع مشاركة الوالدين في مراجعة الواجبات المنزلية ولكننا نؤكد أنه يجب أن يتم إكمال العمل بشكل أساسي من قبل الطلاب لتطوير استقلاليتهم ومسؤوليتهم.\"}', 'ar', 1, 'academics', 3, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(88, 'faq_item', '{\"question\":\"آیا مدرسه مشاوره تحصیلی و شغلی ارائه می‌دهد؟\",\"answer\":\"بله، ما یک بخش مشاوره اختصاصی داریم که راهنمایی‌های تحصیلی و شغلی ارائه می‌دهد. مشاوران ما با دانش‌آموزان همکاری می‌کنند تا به آنها در شناسایی نقاط قوت، علایق و اهداف خود کمک کنند. برای دانش‌آموزان دبیرستان، ما جلسات آشنایی با مشاغل، پشتیبانی درخواست دانشگاه و اطلاعات در مورد مسیرهای مختلف آموزشی ارائه می‌دهیم. تیم مشاوره همچنین منابع ارائه می‌دهد و کارگاه‌هایی درباره مهارت‌های مطالعه، مدیریت زمان و استراتژی‌های آمادگی آزمون برگزار می‌کند.\"}', 'fa', 1, 'academics', 4, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(89, 'faq_item', '{\"question\":\"Does the school provide academic and career counseling?\",\"answer\":\"Yes, we have a dedicated counseling department that provides both academic and career guidance. Our counselors work with students to help them identify their strengths, interests, and goals. For high school students, we offer career orientation sessions, university application support, and information about various educational paths. The counseling team also provides resources and organizes workshops on study skills, time management, and test preparation strategies.\"}', 'en', 1, 'academics', 4, '2025-03-28 17:14:23', '2025-03-28 17:14:23'),
(90, 'faq_item', '{\"question\":\"هل تقدم المدرسة الإرشاد الأكاديمي والمهني؟\",\"answer\":\"نعم، لدينا قسم استشاري مخصص يقدم التوجيه الأكاديمي والمهني. يعمل مستشارونا مع الطلاب لمساعدتهم على تحديد نقاط قوتهم واهتماماتهم وأهدافهم. بالنسبة لطلاب المدارس الثانوية، نقدم جلسات التوجيه المهني، ودعم طلبات الجامعة، ومعلومات حول مسارات تعليمية مختلفة. يوفر فريق الاستشارة أيضًا موارد وينظم ورش عمل حول مهارات الدراسة، وإدارة الوقت، واستراتيجيات التحضير للاختبار.\"}', 'ar', 1, 'academics', 4, '2025-03-28 17:14:23', '2025-03-28 17:14:23');

-- --------------------------------------------------------

--
-- Table structure for table `footer_content`
--

CREATE TABLE `footer_content` (
  `id` int(11) NOT NULL,
  `field_key` varchar(255) NOT NULL COMMENT 'Unique identifier for this content field',
  `content` text DEFAULT NULL COMMENT 'Content value, can be text or JSON',
  `language_id` varchar(5) NOT NULL COMMENT 'Language code (fa, en, ar)',
  `is_repeatable` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Is this field repeatable (like social links)',
  `section_id` varchar(50) DEFAULT NULL COMMENT 'Section identifier for grouping (e.g., quick_links)',
  `sort_order` int(11) DEFAULT 0 COMMENT 'Order for repeatable items',
  `image_path` varchar(255) DEFAULT NULL COMMENT 'Path to associated image if any',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footer_content`
--

INSERT INTO `footer_content` (`id`, `field_key`, `content`, `language_id`, `is_repeatable`, `section_id`, `sort_order`, `image_path`, `created_at`, `updated_at`) VALUES
(89, 'school_description', 'مجتمع آموزشی سلمان با هدف ارائه آموزش با کیفیت در محیطی امن و پویا، دانش‌آموزان را برای موفقیت در دنیای امروز و فردا آماده می‌کند.', 'fa', 0, 'intro', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(90, 'copyright_text', 'تمامی حقوق محفوظ است | مجتمع آموزشی سلمان', 'fa', 0, 'footer_bottom', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(91, 'subscribe_button', 'اشتراک', 'fa', 0, 'newsletter', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(92, 'email_placeholder', 'ایمیل خود را وارد کنید', 'fa', 0, 'newsletter', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(93, 'quick_links_title', 'لینک‌های سریع', 'fa', 0, 'quick_links', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(94, 'curriculum_title', 'برنامه درسی', 'fa', 0, 'curriculum', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(95, 'instagram_title', 'ما را در اینستاگرام دنبال کنید', 'fa', 0, 'instagram', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(96, 'back_to_top', 'بازگشت به بالا', 'fa', 0, 'back_to_top', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(97, 'close_button', 'بستن', 'fa', 0, 'popup', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(98, 'logo_path_ltr', 'assets/images/farsi-logo.png', 'fa', 0, 'logo', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(99, 'logo_path_rtl', 'assets/images/farsi-logo.png', 'fa', 0, 'logo', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(100, 'site_name', 'مجتمع آموزشی سلمان', 'fa', 0, 'metadata', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(101, 'school_description', 'Salman Educational Complex aims to provide quality education in a safe and dynamic environment, preparing students for success in today\'s and tomorrow\'s world.', 'en', 0, 'intro', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(102, 'copyright_text', 'All Rights Reserved | Salman Educational Complex', 'en', 0, 'footer_bottom', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(103, 'subscribe_button', 'Subscribe', 'en', 0, 'newsletter', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(104, 'email_placeholder', 'Enter your email', 'en', 0, 'newsletter', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(105, 'quick_links_title', 'Quick Links', 'en', 0, 'quick_links', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(106, 'curriculum_title', 'Curriculum', 'en', 0, 'curriculum', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(107, 'instagram_title', 'Follow on Instagram', 'en', 0, 'instagram', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(108, 'back_to_top', 'Back to top', 'en', 0, 'back_to_top', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(109, 'close_button', 'Close', 'en', 0, 'popup', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(110, 'logo_path_ltr', 'assets/images/logo-dark.png', 'en', 0, 'logo', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(111, 'logo_path_rtl', 'assets/images/logo-dark.png', 'en', 0, 'logo', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(112, 'site_name', 'Salman Educational Complex', 'en', 0, 'metadata', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(113, 'school_description', 'يهدف مجمع سلمان التعليمي إلى توفير تعليم عالي الجودة في بيئة آمنة وديناميكية، ويعد الطلاب للنجاح في عالم اليوم والغد.', 'ar', 0, 'intro', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(114, 'copyright_text', 'جميع الحقوق محفوظة | مجمع سلمان التعليمي', 'ar', 0, 'footer_bottom', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(115, 'subscribe_button', 'اشتراك', 'ar', 0, 'newsletter', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(116, 'email_placeholder', 'أدخل بريدك الإلكتروني', 'ar', 0, 'newsletter', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(117, 'quick_links_title', 'روابط سريعة', 'ar', 0, 'quick_links', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(118, 'curriculum_title', 'المناهج الدراسية', 'ar', 0, 'curriculum', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(119, 'instagram_title', 'تابعنا على انستغرام', 'ar', 0, 'instagram', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(120, 'back_to_top', 'العودة إلى الأعلى', 'ar', 0, 'back_to_top', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(121, 'close_button', 'إغلاق', 'ar', 0, 'popup', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(122, 'logo_path_ltr', 'assets/images/farsi-logo.png', 'ar', 0, 'logo', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(123, 'logo_path_rtl', 'assets/images/farsi-logo.png', 'ar', 0, 'logo', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(124, 'site_name', 'مجمع سلمان التعليمي', 'ar', 0, 'metadata', 0, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(130, 'quick_link_1', '{\"title\": \"Contact Us\", \"url\": \"contact.php\"}', 'en', 1, 'quick_links', 1, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(131, 'quick_link_2', '{\"title\": \"Blog & News\", \"url\": \"blog.php\"}', 'en', 1, 'quick_links', 2, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(132, 'quick_link_3', '{\"title\": \"Facilities\", \"url\": \"Facilities.php\"}', 'en', 1, 'quick_links', 3, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(133, 'quick_link_4', '{\"title\": \"FAQ\", \"url\": \"faq.php\"}', 'en', 1, 'quick_links', 4, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(134, 'quick_link_5', '{\"title\": \"Privacy Policy\", \"url\": \"Privacy Policy.php\"}', 'en', 1, 'quick_links', 5, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(135, 'quick_link_1', '{\"title\": \"اتصل بنا\", \"url\": \"contact.php\"}', 'ar', 1, 'quick_links', 1, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(136, 'quick_link_2', '{\"title\": \"المدونة والأخبار\", \"url\": \"blog.php\"}', 'ar', 1, 'quick_links', 2, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(137, 'quick_link_3', '{\"title\": \"المرافق\", \"url\": \"Facilities.php\"}', 'ar', 1, 'quick_links', 3, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(138, 'quick_link_4', '{\"title\": \"الأسئلة الشائعة\", \"url\": \"faq.php\"}', 'ar', 1, 'quick_links', 4, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(139, 'quick_link_5', '{\"title\": \"سياسة الخصوصية\", \"url\": \"Privacy Policy.php\"}', 'ar', 1, 'quick_links', 5, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(144, 'curriculum_link_1', '{\"title\": \"Ehsan Section\", \"url\": \"Curriculum.php#ehsan-section\"}', 'en', 1, 'curriculum_links', 1, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(145, 'curriculum_link_2', '{\"title\": \"Primary School\", \"url\": \"Curriculum.php#primary-school\"}', 'en', 1, 'curriculum_links', 2, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(146, 'curriculum_link_3', '{\"title\": \"Middle School\", \"url\": \"Curriculum.php#middle-school\"}', 'en', 1, 'curriculum_links', 3, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(147, 'curriculum_link_4', '{\"title\": \"High School\", \"url\": \"Curriculum.php#high-school\"}', 'en', 1, 'curriculum_links', 4, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(148, 'curriculum_link_1', '{\"title\": \"قسم إحسان\", \"url\": \"Curriculum.php#ehsan-section\"}', 'ar', 1, 'curriculum_links', 1, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(149, 'curriculum_link_2', '{\"title\": \"المدرسة الابتدائية\", \"url\": \"Curriculum.php#primary-school\"}', 'ar', 1, 'curriculum_links', 2, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(150, 'curriculum_link_3', '{\"title\": \"المدرسة المتوسطة\", \"url\": \"Curriculum.php#middle-school\"}', 'ar', 1, 'curriculum_links', 3, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(151, 'curriculum_link_4', '{\"title\": \"المدرسة الثانوية\", \"url\": \"Curriculum.php#high-school\"}', 'ar', 1, 'curriculum_links', 4, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(155, 'social_link_1', '{\"name\": \"Instagram\", \"icon\": \"instagram\", \"url\": \"https://www.instagram.com/ir.salmanfarsi/\"}', 'en', 1, 'social_links', 1, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(156, 'social_link_2', '{\"name\": \"YouTube\", \"icon\": \"youtube\", \"url\": \"https://www.youtube.com/@salmanfarsiiranianschool73/videos\"}', 'en', 1, 'social_links', 2, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(157, 'social_link_3', '{\"name\": \"WhatsApp\", \"icon\": \"whatsapp\", \"url\": \"https://wa.me/97142988116\"}', 'en', 1, 'social_links', 3, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(158, 'social_link_1', '{\"name\": \"Instagram\", \"icon\": \"instagram\", \"url\": \"https://www.instagram.com/ir.salmanfarsi/\"}', 'ar', 1, 'social_links', 1, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(159, 'social_link_2', '{\"name\": \"YouTube\", \"icon\": \"youtube\", \"url\": \"https://www.youtube.com/@salmanfarsiiranianschool73/videos\"}', 'ar', 1, 'social_links', 2, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(160, 'social_link_3', '{\"name\": \"WhatsApp\", \"icon\": \"whatsapp\", \"url\": \"https://wa.me/97142988116\"}', 'ar', 1, 'social_links', 3, NULL, '2025-03-29 13:05:01', '2025-03-29 13:05:01'),
(171, 'quick_links_link_1', '{\"title\":\"\\u062a\\u0645\\u0627\\u0633 \\u0628\\u0627 \\u0645\\u0627\",\"url\":\"contact.php\"}', 'fa', 1, 'quick_links', 1, NULL, '2025-03-29 13:23:17', '2025-03-29 13:23:17'),
(172, 'quick_links_link_2', '{\"title\":\"\\u0648\\u0628\\u0644\\u0627\\u06af \\u0648 \\u0627\\u062e\\u0628\\u0627\\u0631\",\"url\":\"blog.php\"}', 'fa', 1, 'quick_links', 2, NULL, '2025-03-29 13:23:17', '2025-03-29 13:23:17'),
(173, 'quick_links_link_3', '{\"title\":\"\\u0627\\u0645\\u06a9\\u0627\\u0646\\u0627\\u062a\",\"url\":\"Facilities.php\"}', 'fa', 1, 'quick_links', 3, NULL, '2025-03-29 13:23:17', '2025-03-29 13:23:17'),
(174, 'quick_links_link_4', '{\"title\":\"\\u0633\\u0648\\u0627\\u0644\\u0627\\u062a \\u0645\\u062a\\u062f\\u0627\\u0648\\u0644\",\"url\":\"faq.php\"}', 'fa', 1, 'quick_links', 4, NULL, '2025-03-29 13:23:17', '2025-03-29 13:23:17'),
(175, 'quick_links_link_5', '{\"title\":\"\\u062d\\u0631\\u06cc\\u0645 \\u062e\\u0635\\u0648\\u0635\\u06cc\",\"url\":\"Privacy Policy.php\"}', 'fa', 1, 'quick_links', 5, NULL, '2025-03-29 13:23:17', '2025-03-29 13:23:17'),
(181, 'curriculum_links_link_1', '{\"title\":\"\\u0628\\u062e\\u0634 \\u0627\\u062d\\u0633\\u0627\\u0646\",\"url\":\"Curriculum.php#ehsan-section\"}', 'fa', 1, 'curriculum_links', 1, NULL, '2025-03-29 13:23:36', '2025-03-29 13:23:36'),
(182, 'curriculum_links_link_2', '{\"title\":\"\\u062f\\u0628\\u0633\\u062a\\u0627\\u0646\",\"url\":\"Curriculum.php#primary-school\"}', 'fa', 1, 'curriculum_links', 2, NULL, '2025-03-29 13:23:36', '2025-03-29 13:23:36'),
(183, 'curriculum_links_link_3', '{\"title\":\"\\u0645\\u062a\\u0648\\u0633\\u0637\\u0647 \\u0627\\u0648\\u0644\",\"url\":\"Curriculum.php#middle-school\"}', 'fa', 1, 'curriculum_links', 3, NULL, '2025-03-29 13:23:36', '2025-03-29 13:23:36'),
(184, 'curriculum_links_link_4', '{\"title\":\"\\u0645\\u062a\\u0648\\u0633\\u0637\\u0647 \\u062f\\u0648\\u0645\",\"url\":\"Curriculum.php#high-school\"}', 'fa', 1, 'curriculum_links', 4, NULL, '2025-03-29 13:23:36', '2025-03-29 13:23:36'),
(189, 'social_link_1', '{\"name\":\"Instagram\",\"icon\":\"instagram\",\"url\":\"https:\\/\\/www.instagram.com\\/ir.salmanfarsi\\/\"}', 'fa', 1, 'social_links', 1, NULL, '2025-03-29 13:24:04', '2025-03-29 13:24:04'),
(190, 'social_link_2', '{\"name\":\"YouTube\",\"icon\":\"youtube\",\"url\":\"https:\\/\\/www.youtube.com\\/@salmanfarsiiranianschool73\\/videos\"}', 'fa', 1, 'social_links', 2, NULL, '2025-03-29 13:24:04', '2025-03-29 13:24:04'),
(191, 'social_link_3', '{\"name\":\"WhatsApp\",\"icon\":\"whatsapp\",\"url\":\"https:\\/\\/wa.me\\/97142988116\"}', 'fa', 1, 'social_links', 3, NULL, '2025-03-29 13:24:04', '2025-03-29 13:24:04'),
(201, 'instagram_post_1', '{\"image\":\"assets\\/images\\/instagram\\/post1.jpg\",\"link\":\"https:\\/\\/www.instagram.com\\/ir.salmanfarsi\\/reel\\/DG0vtmpvZgA\\/\"}', 'fa', 1, 'instagram_posts', 1, NULL, '2025-03-29 14:02:01', '2025-03-29 14:02:01'),
(202, 'instagram_post_2', '{\"image\":\"assets\\/images\\/instagram\\/post2.jpg\",\"link\":\"https:\\/\\/www.instagram.com\\/ir.salmanfarsi\\/reel\\/DG0vtmpvZgA\\/\"}', 'fa', 1, 'instagram_posts', 2, NULL, '2025-03-29 14:02:01', '2025-03-29 14:02:01'),
(203, 'instagram_post_3', '{\"image\":\"assets\\/images\\/instagram\\/post3.jpg\",\"link\":\"https:\\/\\/www.instagram.com\\/ir.salmanfarsi\\/reel\\/DGXmpk-yCs9\\/\"}', 'fa', 1, 'instagram_posts', 3, NULL, '2025-03-29 14:02:01', '2025-03-29 14:02:01'),
(204, 'instagram_post_4', '{\"image\":\"assets\\/images\\/instagram\\/post4.jpg\",\"link\":\"https:\\/\\/www.instagram.com\\/p\\/DGua6ipPWj7\\/\"}', 'fa', 1, 'instagram_posts', 4, NULL, '2025-03-29 14:02:01', '2025-03-29 14:02:01');

-- --------------------------------------------------------

--
-- Table structure for table `form_fields`
--

CREATE TABLE `form_fields` (
  `field_id` int(11) NOT NULL,
  `field_name` varchar(100) NOT NULL,
  `field_type` enum('text','textarea','select','radio','checkbox','file','date','email','tel','number','hidden') NOT NULL,
  `is_required` tinyint(1) NOT NULL DEFAULT 0,
  `validation_rules` varchar(255) DEFAULT NULL,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `section_id` int(11) DEFAULT NULL,
  `parent_field_id` int(11) DEFAULT NULL,
  `conditional_logic` text DEFAULT NULL,
  `allowed_file_types` varchar(255) DEFAULT NULL,
  `max_file_size` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_fields`
--

INSERT INTO `form_fields` (`field_id`, `field_name`, `field_type`, `is_required`, `validation_rules`, `display_order`, `section_id`, `parent_field_id`, `conditional_logic`, `allowed_file_types`, `max_file_size`, `created_at`, `updated_at`) VALUES
(1, 'profilePhoto', 'file', 0, NULL, 1001, 1, NULL, NULL, 'image/jpeg,image/png', 2097152, '2025-04-08 07:21:13', '2025-04-10 08:13:52'),
(2, 'firstName', 'text', 1, NULL, 1, 1, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-10 08:13:52'),
(3, 'lastName', 'text', 1, NULL, 2, 1, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-10 08:13:52'),
(4, 'fatherName', 'text', 1, NULL, 3, 1, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-10 08:13:52'),
(5, 'nationalId', 'text', 0, 'nationalid', 6, 1, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-10 08:13:52'),
(6, 'passportNumber', 'text', 0, NULL, 7, 1, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-10 08:13:52'),
(7, 'placeOfBirth', 'text', 1, NULL, 8, 1, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-10 08:13:52'),
(8, 'dateOfBirth', 'date', 1, NULL, 9, 1, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-10 08:13:52'),
(9, 'religion', 'select', 1, NULL, 12, 1, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-10 08:13:52'),
(10, 'nationality', 'select', 1, NULL, 5, 1, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-10 08:13:52'),
(11, 'academicGrade', 'select', 1, NULL, 10, 1, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-10 08:13:52'),
(12, 'major', 'select', 0, NULL, 11, 1, NULL, '{\"show_if\":{\"field\":\"academicGrade\",\"operator\":\">=\",\"value\":\"10\"}}', NULL, NULL, '2025-04-08 07:21:13', '2025-04-10 08:13:52'),
(13, 'residentialAddress', 'textarea', 1, NULL, 13, 1, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-10 08:13:52'),
(14, 'contactNumber', 'tel', 1, 'phone', 4, 1, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-10 08:13:52'),
(15, 'emergencyContactName', 'text', 1, NULL, 14, 1, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-10 08:13:52'),
(16, 'emergencyContactNumber', 'tel', 1, 'phone', 15, 1, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-10 08:13:52'),
(17, 'emiratesId', 'file', 0, NULL, 1, 2, NULL, '{\"show_if\":{\"field\":\"nationality\",\"operator\":\"==\",\"value\":\"AE\"}}', 'image/jpeg,image/png,application/pdf', 5242880, '2025-04-08 07:21:13', '2025-04-13 11:13:00'),
(18, 'passportDoc', 'file', 1, NULL, 2, 2, NULL, NULL, 'image/jpeg,image/png,application/pdf', 5242880, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(19, 'nationalIdDoc', 'file', 0, NULL, 3, 2, NULL, '{\"show_if\":{\"field\":\"nationality\",\"operator\":\"==\",\"value\":\"IR\"}}', 'image/jpeg,image/png,application/pdf', 5242880, '2025-04-08 07:21:13', '2025-04-13 11:13:00'),
(20, 'birthCertificate', 'file', 0, NULL, 4, 2, NULL, '{\"show_if\":{\"field\":\"nationality\",\"operator\":\"==\",\"value\":\"IR\"}}', 'image/jpeg,image/png,application/pdf', 5242880, '2025-04-08 07:21:13', '2025-04-13 11:13:00'),
(21, 'academicCertificate', 'file', 0, NULL, 5, 2, NULL, NULL, 'image/jpeg,image/png,application/pdf', 5242880, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(22, 'transportationCity', 'select', 0, NULL, 2, 2, NULL, '{\"show_if\":{\"field\":\"needTransportation\",\"operator\":\"==\",\"value\":\"Yes\"}}', NULL, NULL, '2025-04-08 07:21:13', '2025-04-13 12:55:25'),
(23, 'transportationRoute', 'select', 0, NULL, 3, 2, NULL, '{\"show_if\":{\"field\":\"needTransportation\",\"operator\":\"==\",\"value\":\"Yes\"}}', NULL, NULL, '2025-04-08 07:21:13', '2025-04-13 12:55:25'),
(24, 'transportationLocation', 'text', 0, NULL, 4, 2, NULL, '{\"show_if\":{\"field\":\"needTransportation\",\"operator\":\"==\",\"value\":\"Yes\"}}', NULL, NULL, '2025-04-08 07:21:13', '2025-04-13 12:55:25'),
(25, 'schoolPolicies', 'checkbox', 1, NULL, 9, 2, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(26, 'fatherFullName', 'text', 1, NULL, 1, 3, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(27, 'fatherNationality', 'select', 1, NULL, 2, 3, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(28, 'fatherDateOfBirth', 'date', 1, NULL, 3, 3, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(29, 'fatherNationalId', 'text', 0, 'nationalid', 4, 3, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(30, 'fatherPassportNumber', 'text', 0, NULL, 5, 3, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(31, 'fatherEducation', 'select', 1, NULL, 6, 3, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(32, 'fatherOccupation', 'text', 1, NULL, 7, 3, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(33, 'fatherLandline', 'tel', 0, 'phone', 8, 3, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(34, 'fatherMobile', 'tel', 1, 'phone', 9, 3, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(35, 'fatherWhatsapp', 'tel', 0, 'phone', 10, 3, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(36, 'fatherEmail', 'email', 1, 'email', 11, 3, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(37, 'fatherWorkAddress', 'textarea', 0, NULL, 12, 3, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(38, 'fatherEmployeeCode', 'text', 0, NULL, 13, 3, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(39, 'fatherMedicalCondition', 'radio', 1, NULL, 14, 3, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(40, 'fatherMedicalConditionDetails', 'textarea', 0, NULL, 15, 3, NULL, '{\"show_if\":{\"field\":\"fatherMedicalCondition\",\"operator\":\"==\",\"value\":\"Yes\"}}', NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(41, 'motherFullName', 'text', 1, NULL, 1, 4, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(42, 'motherNationality', 'select', 1, NULL, 2, 4, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(43, 'motherDateOfBirth', 'date', 1, NULL, 3, 4, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(44, 'motherNationalId', 'text', 0, 'nationalid', 4, 4, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(45, 'motherPassportNumber', 'text', 0, NULL, 5, 4, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(46, 'motherEducation', 'select', 1, NULL, 6, 4, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(47, 'motherOccupation', 'text', 1, NULL, 7, 4, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(48, 'motherLandline', 'tel', 0, 'phone', 8, 4, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(49, 'motherMobile', 'tel', 1, 'phone', 9, 4, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(50, 'motherWhatsapp', 'tel', 0, 'phone', 10, 4, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(51, 'motherEmail', 'email', 1, 'email', 11, 4, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(52, 'motherWorkAddress', 'textarea', 0, NULL, 12, 4, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(53, 'motherEmployeeCode', 'text', 0, NULL, 13, 4, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(54, 'motherMedicalCondition', 'radio', 1, NULL, 14, 4, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(55, 'motherMedicalConditionDetails', 'textarea', 0, NULL, 15, 4, NULL, '{\"show_if\":{\"field\":\"motherMedicalCondition\",\"operator\":\"==\",\"value\":\"Yes\"}}', NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(56, 'specialNotes', 'textarea', 0, NULL, 1, 5, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(57, 'disciplinaryRules', 'checkbox', 1, NULL, 2, 5, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(58, 'termsConditions', 'checkbox', 1, NULL, 3, 5, NULL, NULL, NULL, NULL, '2025-04-08 07:21:13', '2025-04-08 07:21:13'),
(59, 'needTransportation', 'radio', 1, NULL, 1, 2, NULL, NULL, NULL, NULL, '2025-04-13 12:55:24', '2025-04-13 12:55:24');

-- --------------------------------------------------------

--
-- Table structure for table `form_field_translations`
--

CREATE TABLE `form_field_translations` (
  `translation_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `field_label` varchar(255) NOT NULL,
  `field_placeholder` varchar(255) DEFAULT NULL,
  `field_help_text` text DEFAULT NULL,
  `field_error_message` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_field_translations`
--

INSERT INTO `form_field_translations` (`translation_id`, `field_id`, `language_id`, `field_label`, `field_placeholder`, `field_help_text`, `field_error_message`) VALUES
(175, 1, 1, 'عکس پرسنلی', NULL, 'JPEG/PNG، حداکثر حجم: ۲ مگابایت', 'لطفاً یک فایل JPEG یا PNG با حجم کمتر از ۲ مگابایت بارگذاری کنید.'),
(176, 2, 1, 'نام', 'نام را وارد کنید', NULL, 'نام الزامی است.'),
(177, 3, 1, 'نام خانوادگی', 'نام خانوادگی را وارد کنید', NULL, 'نام خانوادگی الزامی است.'),
(178, 4, 1, 'نام پدر', 'نام پدر را وارد کنید', NULL, 'نام پدر الزامی است.'),
(179, 5, 1, 'کد ملی', 'کد ملی را وارد کنید', NULL, 'لطفاً یک کد ملی معتبر وارد کنید.'),
(180, 6, 1, 'شماره پاسپورت', 'شماره پاسپورت را وارد کنید', NULL, 'لطفاً یک شماره پاسپورت معتبر وارد کنید.'),
(181, 7, 1, 'محل تولد', 'محل تولد را وارد کنید', NULL, 'محل تولد الزامی است.'),
(182, 8, 1, 'تاریخ تولد', NULL, NULL, 'تاریخ تولد الزامی است.'),
(183, 9, 1, 'دین', 'دین را انتخاب کنید', NULL, 'دین الزامی است.'),
(184, 10, 1, 'ملیت', 'ملیت را انتخاب کنید', NULL, 'ملیت الزامی است.'),
(185, 11, 1, 'پایه تحصیلی', 'پایه را انتخاب کنید', NULL, 'پایه تحصیلی الزامی است.'),
(186, 12, 1, 'رشته تحصیلی', 'رشته را انتخاب کنید', NULL, 'لطفاً یک رشته تحصیلی انتخاب کنید.'),
(187, 13, 1, 'آدرس محل سکونت', 'آدرس محل سکونت را وارد کنید', NULL, 'آدرس محل سکونت الزامی است.'),
(188, 14, 1, 'شماره تماس اصلی', 'شماره تماس را وارد کنید', NULL, 'شماره تماس اصلی الزامی است.'),
(189, 15, 1, 'نام تماس اضطراری', 'نام کامل را وارد کنید', NULL, 'نام تماس اضطراری الزامی است.'),
(190, 16, 1, 'شماره تماس اضطراری', 'شماره تلفن را وارد کنید', NULL, 'شماره تماس اضطراری الزامی است.'),
(191, 17, 1, 'شناسه امارات', NULL, 'JPEG/PNG/PDF، حداکثر حجم: ۵ مگابایت', 'شناسه امارات برای اتباع امارات الزامی است.'),
(192, 18, 1, 'صفحه اول پاسپورت', NULL, 'JPEG/PNG/PDF، حداکثر حجم: ۵ مگابایت', 'صفحه اول پاسپورت الزامی است.'),
(193, 19, 1, 'کارت ملی', NULL, 'JPEG/PNG/PDF، حداکثر حجم: ۵ مگابایت', 'کارت ملی برای اتباع ایران الزامی است.'),
(194, 20, 1, 'شناسنامه', NULL, 'JPEG/PNG/PDF، حداکثر حجم: ۵ مگابایت', 'شناسنامه برای اتباع ایران الزامی است.'),
(195, 21, 1, 'مدرک تحصیلی', NULL, 'JPEG/PNG/PDF، حداکثر حجم: ۵ مگابایت', NULL),
(196, 22, 1, 'شهر', 'شهر را انتخاب کنید', NULL, NULL),
(197, 23, 1, 'مسیر', 'مسیر را انتخاب کنید', NULL, NULL),
(198, 24, 1, 'محل سوار شدن', 'محل سوار شدن را وارد کنید', NULL, NULL),
(199, 25, 1, 'قوانین مدرسه در مورد ارسال مدارک را مطالعه کرده و می‌پذیرم', NULL, NULL, 'شما باید قوانین مدرسه در مورد ارسال مدارک را تأیید کنید.'),
(200, 26, 1, 'نام کامل', 'نام کامل پدر را وارد کنید', NULL, 'نام کامل پدر الزامی است.'),
(201, 27, 1, 'ملیت', 'ملیت را انتخاب کنید', NULL, 'ملیت الزامی است.'),
(202, 28, 1, 'تاریخ تولد', NULL, NULL, 'تاریخ تولد الزامی است.'),
(203, 29, 1, 'کد ملی', 'کد ملی را وارد کنید', NULL, 'لطفاً یک کد ملی معتبر وارد کنید.'),
(204, 30, 1, 'شماره پاسپورت', 'شماره پاسپورت را وارد کنید', NULL, 'لطفاً یک شماره پاسپورت معتبر وارد کنید.'),
(205, 31, 1, 'تحصیلات', 'تحصیلات را انتخاب کنید', NULL, 'تحصیلات الزامی است.'),
(206, 32, 1, 'شغل', 'شغل را وارد کنید', NULL, 'شغل الزامی است.'),
(207, 33, 1, 'تلفن ثابت', 'شماره تلفن ثابت را وارد کنید', NULL, 'لطفاً یک شماره تلفن معتبر وارد کنید.'),
(208, 34, 1, 'تلفن همراه', 'شماره تلفن همراه را وارد کنید', NULL, 'شماره تلفن همراه الزامی است.'),
(209, 35, 1, 'شماره واتساپ', 'شماره واتساپ را وارد کنید', NULL, 'لطفاً یک شماره تلفن معتبر وارد کنید.'),
(210, 36, 1, 'آدرس ایمیل', 'آدرس ایمیل را وارد کنید', NULL, 'لطفاً یک آدرس ایمیل معتبر وارد کنید.'),
(211, 37, 1, 'آدرس محل کار', 'آدرس محل کار را وارد کنید', NULL, NULL),
(212, 38, 1, 'کد کارمندی (اگر کارمند مدرسه هستید)', 'کد کارمندی را وارد کنید', NULL, NULL),
(213, 39, 1, 'آیا پدر دارای شرایط پزشکی خاصی است که مدرسه باید از آن مطلع باشد؟', NULL, NULL, NULL),
(214, 40, 1, 'لطفاً شرایط پزشکی را توضیح دهید', 'جزئیات شرایط پزشکی را وارد کنید', NULL, 'لطفاً جزئیات شرایط پزشکی را وارد کنید.'),
(215, 41, 1, 'نام کامل', 'نام کامل مادر را وارد کنید', NULL, 'نام کامل مادر الزامی است.'),
(216, 42, 1, 'ملیت', 'ملیت را انتخاب کنید', NULL, 'ملیت الزامی است.'),
(217, 43, 1, 'تاریخ تولد', NULL, NULL, 'تاریخ تولد الزامی است.'),
(218, 44, 1, 'کد ملی', 'کد ملی را وارد کنید', NULL, 'لطفاً یک کد ملی معتبر وارد کنید.'),
(219, 45, 1, 'شماره پاسپورت', 'شماره پاسپورت را وارد کنید', NULL, 'لطفاً یک شماره پاسپورت معتبر وارد کنید.'),
(220, 46, 1, 'تحصیلات', 'تحصیلات را انتخاب کنید', NULL, 'تحصیلات الزامی است.'),
(221, 47, 1, 'شغل', 'شغل را وارد کنید', NULL, 'شغل الزامی است.'),
(222, 48, 1, 'تلفن ثابت', 'شماره تلفن ثابت را وارد کنید', NULL, 'لطفاً یک شماره تلفن معتبر وارد کنید.'),
(223, 49, 1, 'تلفن همراه', 'شماره تلفن همراه را وارد کنید', NULL, 'شماره تلفن همراه الزامی است.'),
(224, 50, 1, 'شماره واتساپ', 'شماره واتساپ را وارد کنید', NULL, 'لطفاً یک شماره تلفن معتبر وارد کنید.'),
(225, 51, 1, 'آدرس ایمیل', 'آدرس ایمیل را وارد کنید', NULL, 'لطفاً یک آدرس ایمیل معتبر وارد کنید.'),
(226, 52, 1, 'آدرس محل کار', 'آدرس محل کار را وارد کنید', NULL, NULL),
(227, 53, 1, 'کد کارمندی (اگر کارمند مدرسه هستید)', 'کد کارمندی را وارد کنید', NULL, NULL),
(228, 54, 1, 'آیا مادر دارای شرایط پزشکی خاصی است که مدرسه باید از آن مطلع باشد؟', NULL, NULL, NULL),
(229, 55, 1, 'لطفاً شرایط پزشکی را توضیح دهید', 'جزئیات شرایط پزشکی را وارد کنید', NULL, 'لطفاً جزئیات شرایط پزشکی را وارد کنید.'),
(230, 56, 1, 'نکات ویژه / درخواست‌های اضافی (اختیاری)', 'هرگونه نکات ویژه یا درخواست‌های اضافی را وارد کنید', NULL, NULL),
(231, 57, 1, 'قوانین انضباطی مدرسه سلمان فارسی را با دقت مطالعه کرده و کاملاً متعهد به رعایت آنها هستم.', NULL, NULL, 'شما باید با قوانین انضباطی مدرسه موافقت کنید.'),
(232, 58, 1, 'شرایط و قوانین ثبت نام دانش‌آموز را می‌پذیرم.', NULL, NULL, 'شما باید شرایط و ضوابط را بپذیرید.'),
(233, 1, 2, 'Personal photo', NULL, 'JPEG/PNG, max size: 2MB', 'Please upload a JPEG or PNG file under 2MB.'),
(234, 2, 2, 'First Name', 'Enter first name', NULL, 'First name is required.'),
(235, 3, 2, 'Last Name', 'Enter last name', NULL, 'Last name is required.'),
(236, 4, 2, 'Father\'s Name', 'Enter father\'s name', NULL, 'Father\'s name is required.'),
(237, 5, 2, 'National ID', 'Enter national ID', NULL, 'Please enter a valid National ID.'),
(238, 6, 2, 'Passport Number', 'Enter passport number', NULL, 'Please enter a valid passport number.'),
(239, 7, 2, 'Place of Birth', 'Enter place of birth', NULL, 'Place of birth is required.'),
(240, 8, 2, 'Date of Birth', NULL, NULL, 'Date of birth is required.'),
(241, 9, 2, 'Religion', 'Select religion', NULL, 'Religion is required.'),
(242, 10, 2, 'Nationality', 'Select nationality', NULL, 'Nationality is required.'),
(243, 11, 2, 'Academic Grade', 'Select grade', NULL, 'Academic grade is required.'),
(244, 12, 2, 'Major', 'Select major', NULL, 'Please select a major.'),
(245, 13, 2, 'Residential Address', 'Enter residential address', NULL, 'Residential address is required.'),
(246, 14, 2, 'Primary Contact Number', 'Enter contact number', NULL, 'Primary contact number is required.'),
(247, 15, 2, 'Emergency Contact Name', 'Enter full name', NULL, 'Emergency contact name is required.'),
(248, 16, 2, 'Emergency Contact Number', 'Enter phone number', NULL, 'Emergency contact number is required.'),
(249, 17, 2, 'Emirates ID', NULL, 'JPEG/PNG/PDF, max size: 5MB', 'Emirates ID is required for UAE nationals.'),
(250, 18, 2, 'Passport Front Page', NULL, 'JPEG/PNG/PDF, max size: 5MB', 'Passport Front Page is required.'),
(251, 19, 2, 'National ID', NULL, 'JPEG/PNG/PDF, max size: 5MB', 'National ID is required for Iranian nationals.'),
(252, 20, 2, 'Birth Certificate', NULL, 'JPEG/PNG/PDF, max size: 5MB', 'Birth Certificate is required for Iranian nationals.'),
(253, 21, 2, 'Academic Certificate', NULL, 'JPEG/PNG/PDF, max size: 5MB', NULL),
(254, 22, 2, 'City', 'Select city', NULL, NULL),
(255, 23, 2, 'Route', 'Select route', NULL, NULL),
(256, 24, 2, 'Pickup Location', 'Enter pickup location', NULL, NULL),
(257, 25, 2, 'I acknowledge and agree to the school policies regarding document submissions', NULL, NULL, 'You must acknowledge and agree to the school policies.'),
(258, 26, 2, 'Full Name', 'Enter father\'s full name', NULL, 'Father\'s full name is required.'),
(259, 27, 2, 'Nationality', 'Select nationality', NULL, 'Nationality is required.'),
(260, 28, 2, 'Date of Birth', NULL, NULL, 'Date of birth is required.'),
(261, 29, 2, 'National ID', 'Enter national ID', NULL, 'Please enter a valid National ID.'),
(262, 30, 2, 'Passport Number', 'Enter passport number', NULL, 'Please enter a valid passport number.'),
(263, 31, 2, 'Educational Background', 'Select education', NULL, 'Educational background is required.'),
(264, 32, 2, 'Occupation', 'Enter occupation', NULL, 'Occupation is required.'),
(265, 33, 2, 'Landline Number', 'Enter landline number', NULL, 'Please enter a valid phone number.'),
(266, 34, 2, 'Mobile Number', 'Enter mobile number', NULL, 'Mobile number is required.'),
(267, 35, 2, 'WhatsApp Number', 'Enter WhatsApp number', NULL, 'Please enter a valid phone number.'),
(268, 36, 2, 'Email Address', 'Enter email address', NULL, 'Please enter a valid email address.'),
(269, 37, 2, 'Work Address', 'Enter work address', NULL, NULL),
(270, 38, 2, 'Employee Code (if applicable for school staff)', 'Enter employee code', NULL, NULL),
(271, 39, 2, 'Does the father have any medical conditions that the school should be aware of?', NULL, NULL, NULL),
(272, 40, 2, 'Please specify the medical condition', 'Enter medical condition details', NULL, 'Please provide details about the medical condition.'),
(273, 41, 2, 'Full Name', 'Enter mother\'s full name', NULL, 'Mother\'s full name is required.'),
(274, 42, 2, 'Nationality', 'Select nationality', NULL, 'Nationality is required.'),
(275, 43, 2, 'Date of Birth', NULL, NULL, 'Date of birth is required.'),
(276, 44, 2, 'National ID', 'Enter national ID', NULL, 'Please enter a valid National ID.'),
(277, 45, 2, 'Passport Number', 'Enter passport number', NULL, 'Please enter a valid passport number.'),
(278, 46, 2, 'Educational Background', 'Select education', NULL, 'Educational background is required.'),
(279, 47, 2, 'Occupation', 'Enter occupation', NULL, 'Occupation is required.'),
(280, 48, 2, 'Landline Number', 'Enter landline number', NULL, 'Please enter a valid phone number.'),
(281, 49, 2, 'Mobile Number', 'Enter mobile number', NULL, 'Mobile number is required.'),
(282, 50, 2, 'WhatsApp Number', 'Enter WhatsApp number', NULL, 'Please enter a valid phone number.'),
(283, 51, 2, 'Email Address', 'Enter email address', NULL, 'Please enter a valid email address.'),
(284, 52, 2, 'Work Address', 'Enter work address', NULL, NULL),
(285, 53, 2, 'Employee Code (if applicable for school staff)', 'Enter employee code', NULL, NULL),
(286, 54, 2, 'Does the mother have any medical conditions that the school should be aware of?', NULL, NULL, NULL),
(287, 55, 2, 'Please specify the medical condition', 'Enter medical condition details', NULL, 'Please provide details about the medical condition.'),
(288, 56, 2, 'Special Notes / Additional Requests (Optional)', 'Enter any special notes or additional requests', NULL, NULL),
(289, 57, 2, 'I have carefully read and fully agree to abide by the Salman Farsi School Disciplinary Rules.', NULL, NULL, 'You must agree to the Disciplinary Rules.'),
(290, 58, 2, 'I acknowledge and accept the Terms & Conditions of student registration.', NULL, NULL, 'You must accept the Terms & Conditions.'),
(291, 1, 3, 'صورة الشخصي', NULL, 'JPEG/PNG، الحجم الأقصى: 2 ميغابايت', 'يرجى تحميل ملف JPEG أو PNG بحجم أقل من 2 ميغابايت.'),
(292, 2, 3, 'الاسم الأول', 'أدخل الاسم الأول', NULL, 'الاسم الأول مطلوب.'),
(293, 3, 3, 'اللقب', 'أدخل اللقب', NULL, 'اللقب مطلوب.'),
(294, 4, 3, 'اسم الأب', 'أدخل اسم الأب', NULL, 'اسم الأب مطلوب.'),
(295, 5, 3, 'الهوية الوطنية', 'أدخل الهوية الوطنية', NULL, 'يرجى إدخال هوية وطنية صالحة.'),
(296, 6, 3, 'رقم جواز السفر', 'أدخل رقم جواز السفر', NULL, 'يرجى إدخال رقم جواز سفر صالح.'),
(297, 7, 3, 'مكان الولادة', 'أدخل مكان الولادة', NULL, 'مكان الولادة مطلوب.'),
(298, 8, 3, 'تاريخ الميلاد', NULL, NULL, 'تاريخ الميلاد مطلوب.'),
(299, 9, 3, 'الديانة', 'اختر الديانة', NULL, 'الديانة مطلوبة.'),
(300, 10, 3, 'الجنسية', 'اختر الجنسية', NULL, 'الجنسية مطلوبة.'),
(301, 11, 3, 'الصف الدراسي', 'اختر الصف', NULL, 'الصف الدراسي مطلوب.'),
(302, 12, 3, 'التخصص', 'اختر التخصص', NULL, 'يرجى اختيار تخصص.'),
(303, 13, 3, 'عنوان السكن', 'أدخل عنوان السكن', NULL, 'عنوان السكن مطلوب.'),
(304, 14, 3, 'رقم الاتصال الأساسي', 'أدخل رقم الاتصال', NULL, 'رقم الاتصال الأساسي مطلوب.'),
(305, 15, 3, 'اسم جهة الاتصال في حالات الطوارئ', 'أدخل الاسم الكامل', NULL, 'اسم جهة الاتصال في حالات الطوارئ مطلوب.'),
(306, 16, 3, 'رقم الاتصال في حالات الطوارئ', 'أدخل رقم الهاتف', NULL, 'رقم الاتصال في حالات الطوارئ مطلوب.'),
(307, 17, 3, 'الهوية الإماراتية', NULL, 'JPEG/PNG/PDF، الحجم الأقصى: 5 ميغابايت', 'الهوية الإماراتية مطلوبة للمواطنين الإماراتيين.'),
(308, 18, 3, 'الصفحة الأمامية لجواز السفر', NULL, 'JPEG/PNG/PDF، الحجم الأقصى: 5 ميغابايت', 'الصفحة الأمامية لجواز السفر مطلوبة.'),
(309, 19, 3, 'بطاقة الهوية الوطنية', NULL, 'JPEG/PNG/PDF، الحجم الأقصى: 5 ميغابايت', 'بطاقة الهوية الوطنية مطلوبة للمواطنين الإيرانيين.'),
(310, 20, 3, 'شهادة الميلاد', NULL, 'JPEG/PNG/PDF، الحجم الأقصى: 5 ميغابايت', 'شهادة الميلاد مطلوبة للمواطنين الإيرانيين.'),
(311, 21, 3, 'الشهادة الأكاديمية', NULL, 'JPEG/PNG/PDF، الحجم الأقصى: 5 ميغابايت', NULL),
(312, 22, 3, 'المدينة', 'اختر المدينة', NULL, NULL),
(313, 23, 3, 'المسار', 'اختر المسار', NULL, NULL),
(314, 24, 3, 'موقع الركوب', 'أدخل موقع الركوب', NULL, NULL),
(315, 25, 3, 'أقر وأوافق على سياسات المدرسة المتعلقة بتقديم المستندات', NULL, NULL, 'يجب عليك الإقرار والموافقة على سياسات المدرسة.'),
(316, 26, 3, 'الاسم الكامل', 'أدخل الاسم الكامل للأب', NULL, 'الاسم الكامل للأب مطلوب.'),
(317, 27, 3, 'الجنسية', 'اختر الجنسية', NULL, 'الجنسية مطلوبة.'),
(318, 28, 3, 'تاريخ الميلاد', NULL, NULL, 'تاريخ الميلاد مطلوب.'),
(319, 29, 3, 'الهوية الوطنية', 'أدخل الهوية الوطنية', NULL, 'يرجى إدخال هوية وطنية صالحة.'),
(320, 30, 3, 'رقم جواز السفر', 'أدخل رقم جواز السفر', NULL, 'يرجى إدخال رقم جواز سفر صالح.'),
(321, 31, 3, 'المؤهل التعليمي', 'اختر المؤهل التعليمي', NULL, 'المؤهل التعليمي مطلوب.'),
(322, 32, 3, 'المهنة', 'أدخل المهنة', NULL, 'المهنة مطلوبة.'),
(323, 33, 3, 'رقم الهاتف الأرضي', 'أدخل رقم الهاتف الأرضي', NULL, 'يرجى إدخال رقم هاتف صالح.'),
(324, 34, 3, 'رقم الهاتف المحمول', 'أدخل رقم الهاتف المحمول', NULL, 'رقم الهاتف المحمول مطلوب.'),
(325, 35, 3, 'رقم الواتساب', 'أدخل رقم الواتساب', NULL, 'يرجى إدخال رقم هاتف صالح.'),
(326, 36, 3, 'عنوان البريد الإلكتروني', 'أدخل عنوان البريد الإلكتروني', NULL, 'يرجى إدخال عنوان بريد إلكتروني صالح.'),
(327, 37, 3, 'عنوان العمل', 'أدخل عنوان العمل', NULL, NULL),
(328, 38, 3, 'رمز الموظف (إن كان ينطبق على موظفي المدرسة)', 'أدخل رمز الموظف', NULL, NULL),
(329, 39, 3, 'هل يعاني الأب من أي حالات طبية يجب أن تكون المدرسة على علم بها؟', NULL, NULL, NULL),
(330, 40, 3, 'يرجى تحديد الحالة الطبية', 'أدخل تفاصيل الحالة الطبية', NULL, 'يرجى تقديم تفاصيل عن الحالة الطبية.'),
(331, 41, 3, 'الاسم الكامل', 'أدخل الاسم الكامل للأم', NULL, 'الاسم الكامل للأم مطلوب.'),
(332, 42, 3, 'الجنسية', 'اختر الجنسية', NULL, 'الجنسية مطلوبة.'),
(333, 43, 3, 'تاريخ الميلاد', NULL, NULL, 'تاريخ الميلاد مطلوب.'),
(334, 44, 3, 'الهوية الوطنية', 'أدخل الهوية الوطنية', NULL, 'يرجى إدخال هوية وطنية صالحة.'),
(335, 45, 3, 'رقم جواز السفر', 'أدخل رقم جواز السفر', NULL, 'يرجى إدخال رقم جواز سفر صالح.'),
(336, 46, 3, 'المؤهل التعليمي', 'اختر المؤهل التعليمي', NULL, 'المؤهل التعليمي مطلوب.'),
(337, 47, 3, 'المهنة', 'أدخل المهنة', NULL, 'المهنة مطلوبة.'),
(338, 48, 3, 'رقم الهاتف الأرضي', 'أدخل رقم الهاتف الأرضي', NULL, 'يرجى إدخال رقم هاتف صالح.'),
(339, 49, 3, 'رقم الهاتف المحمول', 'أدخل رقم الهاتف المحمول', NULL, 'رقم الهاتف المحمول مطلوب.'),
(340, 50, 3, 'رقم الواتساب', 'أدخل رقم الواتساب', NULL, 'يرجى إدخال رقم هاتف صالح.'),
(341, 51, 3, 'عنوان البريد الإلكتروني', 'أدخل عنوان البريد الإلكتروني', NULL, 'يرجى إدخال عنوان بريد إلكتروني صالح.'),
(342, 52, 3, 'عنوان العمل', 'أدخل عنوان العمل', NULL, NULL),
(343, 53, 3, 'رمز الموظف (إن كان ينطبق على موظفي المدرسة)', 'أدخل رمز الموظف', NULL, NULL),
(344, 54, 3, 'هل تعاني الأم من أي حالات طبية يجب أن تكون المدرسة على علم بها؟', NULL, NULL, NULL),
(345, 55, 3, 'يرجى تحديد الحالة الطبية', 'أدخل تفاصيل الحالة الطبية', NULL, 'يرجى تقديم تفاصيل عن الحالة الطبية.'),
(346, 56, 3, 'ملاحظات خاصة / طلبات إضافية (اختياري)', 'أدخل أي ملاحظات خاصة أو طلبات إضافية', NULL, NULL),
(347, 57, 3, 'لقد قرأت بعناية وأوافق تماماً على الالتزام بقواعد الانضباط في مدرسة سلمان الفارسي.', NULL, NULL, 'يجب أن توافق على قواعد الانضباط.'),
(348, 58, 3, 'أقر وأقبل شروط وأحكام تسجيل الطلاب.', NULL, NULL, 'يجب أن تقبل الشروط والأحكام.'),
(349, 59, 1, 'آیا به سرویس مدرسه نیاز دارید؟', NULL, NULL, 'لطفاً این گزینه را انتخاب کنید'),
(350, 59, 2, 'Do you need school transportation?', NULL, NULL, 'Please select this option'),
(351, 59, 3, 'هل تحتاج إلى خدمة النقل المدرسي؟', NULL, NULL, 'الرجاء تحديد هذا الخيار');

-- --------------------------------------------------------

--
-- Table structure for table `form_options`
--

CREATE TABLE `form_options` (
  `option_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `option_value` varchar(100) NOT NULL,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `is_default` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_options`
--

INSERT INTO `form_options` (`option_id`, `field_id`, `option_value`, `display_order`, `is_default`) VALUES
(1, 9, 'islam_shia', 1, 1),
(2, 9, 'islam_sunni', 2, 0),
(3, 9, 'christianity', 3, 0),
(4, 9, 'judaism', 4, 0),
(5, 9, 'other', 5, 0),
(6, 31, 'high_school', 1, 0),
(7, 31, 'bachelors', 2, 1),
(8, 31, 'masters', 3, 0),
(9, 31, 'phd', 4, 0),
(10, 31, 'other', 5, 0),
(11, 46, 'high_school', 1, 0),
(12, 46, 'bachelors', 2, 1),
(13, 46, 'masters', 3, 0),
(14, 46, 'phd', 4, 0),
(15, 46, 'other', 5, 0),
(16, 39, 'No', 1, 1),
(17, 39, 'Yes', 2, 0),
(18, 54, 'No', 1, 1),
(19, 54, 'Yes', 2, 0),
(20, 10, 'IR', 1, 1),
(21, 10, 'AF', 2, 0),
(22, 10, 'PK', 3, 0),
(23, 10, 'TJ', 4, 0),
(24, 10, 'AE', 5, 0),
(25, 10, 'TR', 6, 0),
(26, 10, 'IQ', 7, 0),
(27, 10, 'KW', 8, 0),
(28, 10, 'OTHER', 9, 0),
(29, 10, 'IR', 1, 1),
(30, 10, 'AF', 2, 0),
(31, 10, 'PK', 3, 0),
(32, 10, 'TJ', 4, 0),
(33, 10, 'AE', 5, 0),
(34, 10, 'TR', 6, 0),
(35, 10, 'IQ', 7, 0),
(36, 10, 'KW', 8, 0),
(37, 10, 'OTHER', 9, 0),
(38, 59, 'Yes', 1, 0),
(39, 59, 'No', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `form_option_translations`
--

CREATE TABLE `form_option_translations` (
  `translation_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `option_label` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_option_translations`
--

INSERT INTO `form_option_translations` (`translation_id`, `option_id`, `language_id`, `option_label`) VALUES
(58, 1, 1, 'اسلام شیعه'),
(59, 2, 1, 'اسلام سنی'),
(60, 3, 1, 'مسیحیت'),
(61, 4, 1, 'یهودیت'),
(62, 5, 1, 'دیگر'),
(63, 1, 2, 'Shia Islam'),
(64, 2, 2, 'Sunni Islam'),
(65, 3, 2, 'Christianity'),
(66, 4, 2, 'Judaism'),
(67, 5, 2, 'Other'),
(68, 1, 3, 'الإسلام الشيعي'),
(69, 2, 3, 'الإسلام السني'),
(70, 3, 3, 'المسيحية'),
(71, 4, 3, 'اليهودية'),
(72, 5, 3, 'أخرى'),
(73, 6, 1, 'دیپلم'),
(74, 7, 1, 'کارشناسی'),
(75, 8, 1, 'کارشناسی ارشد'),
(76, 9, 1, 'دکتری'),
(77, 10, 1, 'سایر'),
(78, 6, 2, 'High School'),
(79, 7, 2, 'Bachelor\'s'),
(80, 8, 2, 'Master\'s'),
(81, 9, 2, 'PhD'),
(82, 10, 2, 'Other'),
(83, 6, 3, 'الثانوية العامة'),
(84, 7, 3, 'البكالوريوس'),
(85, 8, 3, 'الماجستير'),
(86, 9, 3, 'الدكتوراه'),
(87, 10, 3, 'أخرى'),
(88, 11, 1, 'دیپلم'),
(89, 12, 1, 'کارشناسی'),
(90, 13, 1, 'کارشناسی ارشد'),
(91, 14, 1, 'دکتری'),
(92, 15, 1, 'سایر'),
(93, 11, 2, 'High School'),
(94, 12, 2, 'Bachelor\'s'),
(95, 13, 2, 'Master\'s'),
(96, 14, 2, 'PhD'),
(97, 15, 2, 'Other'),
(98, 11, 3, 'الثانوية العامة'),
(99, 12, 3, 'البكالوريوس'),
(100, 13, 3, 'الماجستير'),
(101, 14, 3, 'الدكتوراه'),
(102, 15, 3, 'أخرى'),
(103, 16, 1, 'خیر'),
(104, 17, 1, 'بله'),
(105, 16, 2, 'No'),
(106, 17, 2, 'Yes'),
(107, 16, 3, 'لا'),
(108, 17, 3, 'نعم'),
(109, 18, 1, 'خیر'),
(110, 19, 1, 'بله'),
(111, 18, 2, 'No'),
(112, 19, 2, 'Yes'),
(113, 18, 3, 'لا'),
(114, 19, 3, 'نعم'),
(115, 29, 1, 'ایران'),
(116, 29, 2, 'Iran'),
(117, 29, 3, 'إيران'),
(118, 30, 1, 'افغانستان'),
(119, 30, 2, 'Afghanistan'),
(120, 30, 3, 'أفغانستان'),
(121, 31, 1, 'پاکستان'),
(122, 31, 2, 'Pakistan'),
(123, 31, 3, 'باكستان'),
(124, 32, 1, 'تاجیکستان'),
(125, 32, 2, 'Tajikistan'),
(126, 32, 3, 'طاجيكستان'),
(127, 33, 1, 'امارات متحده عربی'),
(128, 33, 2, 'United Arab Emirates'),
(129, 33, 3, 'الإمارات العربية المتحدة'),
(130, 34, 1, 'ترکیه'),
(131, 34, 2, 'Turkey'),
(132, 34, 3, 'تركيا'),
(133, 35, 1, 'عراق'),
(134, 35, 2, 'Iraq'),
(135, 35, 3, 'العراق'),
(136, 36, 1, 'کویت'),
(137, 36, 2, 'Kuwait'),
(138, 36, 3, 'الكويت'),
(139, 37, 1, 'سایر کشورها'),
(140, 37, 2, 'Other Countries'),
(141, 37, 3, 'دول أخرى'),
(142, 38, 1, 'بله'),
(143, 38, 2, 'Yes'),
(144, 38, 3, 'نعم'),
(145, 39, 1, 'خیر'),
(146, 39, 2, 'No'),
(147, 39, 3, 'لا');

-- --------------------------------------------------------

--
-- Table structure for table `form_sections`
--

CREATE TABLE `form_sections` (
  `section_id` int(11) NOT NULL,
  `section_key` varchar(50) NOT NULL,
  `parent_section_id` int(11) DEFAULT NULL,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_sections`
--

INSERT INTO `form_sections` (`section_id`, `section_key`, `parent_section_id`, `display_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'student_info', NULL, 1, 1, '2025-04-08 07:20:23', '2025-04-08 07:20:23'),
(2, 'document_uploads', NULL, 2, 1, '2025-04-08 07:20:23', '2025-04-08 07:20:23'),
(3, 'father_info', NULL, 3, 1, '2025-04-08 07:20:23', '2025-04-08 07:20:23'),
(4, 'mother_info', NULL, 4, 1, '2025-04-08 07:20:23', '2025-04-08 07:20:23'),
(5, 'confirmation', NULL, 5, 1, '2025-04-08 07:20:23', '2025-04-08 07:20:23');

-- --------------------------------------------------------

--
-- Table structure for table `form_section_translations`
--

CREATE TABLE `form_section_translations` (
  `translation_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `section_title` varchar(255) NOT NULL,
  `section_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_section_translations`
--

INSERT INTO `form_section_translations` (`translation_id`, `section_id`, `language_id`, `section_title`, `section_description`) VALUES
(1, 1, 1, 'اطلاعات دانش‌آموز', 'لطفا اطلاعات شخصی دانش‌آموز را وارد کنید'),
(2, 2, 1, 'بارگذاری مدارک', 'لطفا مدارک مورد نیاز را بارگذاری کنید'),
(3, 3, 1, 'اطلاعات پدر', 'لطفا اطلاعات پدر دانش‌آموز را وارد کنید'),
(4, 4, 1, 'اطلاعات مادر', 'لطفا اطلاعات مادر دانش‌آموز را وارد کنید'),
(5, 5, 1, 'تأیید نهایی', 'لطفا اطلاعات وارد شده را بررسی و تأیید نهایی کنید'),
(6, 1, 2, 'Student Information', 'Enter the student\'s personal details and contact information'),
(7, 2, 2, 'Document Uploads', 'Upload the required documents for registration'),
(8, 3, 2, 'Father\'s Information', 'Enter father\'s personal details and contact information'),
(9, 4, 2, 'Mother\'s Information', 'Enter mother\'s personal details and contact information'),
(10, 5, 2, 'Confirmation', 'Review and confirm your registration details'),
(11, 1, 3, 'معلومات الطالب', 'أدخل البيانات الشخصية ومعلومات الاتصال للطالب'),
(12, 2, 3, 'تحميل المستندات', 'قم بتحميل المستندات المطلوبة للتسجيل'),
(13, 3, 3, 'معلومات الأب', 'أدخل البيانات الشخصية ومعلومات الاتصال للأب'),
(14, 4, 3, 'معلومات الأم', 'أدخل البيانات الشخصية ومعلومات الاتصال للأم'),
(15, 5, 3, 'التأكيد النهائي', 'مراجعة وتأكيد بيانات التسجيل الخاصة بك');

-- --------------------------------------------------------

--
-- Table structure for table `home_content`
--

CREATE TABLE `home_content` (
  `id` int(11) NOT NULL,
  `field_key` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `language_id` varchar(5) NOT NULL DEFAULT 'fa',
  `is_repeatable` tinyint(1) NOT NULL DEFAULT 0,
  `section_id` varchar(50) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_content`
--

INSERT INTO `home_content` (`id`, `field_key`, `content`, `language_id`, `is_repeatable`, `section_id`, `sort_order`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 'hero_title', 'انتخابی برای <span class=\"text-gradient\">موفقیت</span>، مسیری برای <span class=\"text-gradient\">رشد</span>', '1', 0, 'hero', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(2, 'hero_description', 'آموزش با کیفیت بالا، مطابق با استانداردهای وزارت آموزش و پرورش ایران و با رویکرد بین‌المللی برای پرورش نسل آینده.', '1', 0, 'hero', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(3, 'hero_badge', 'مجتمع آموزشی سلمان فارسی', '1', 0, 'hero', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(4, 'hero_btn_primary', 'ثبت‌نام', '1', 0, 'hero', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(5, 'hero_btn_primary_url', 'Terms and Conditions for Registration.php', '1', 0, 'hero', 5, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(6, 'hero_btn_secondary', 'درباره ما', '1', 0, 'hero', 6, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(7, 'hero_btn_secondary_url', 'about.php', '1', 0, 'hero', 7, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(8, 'hero_feature1_title', 'آموزش با کیفیت', '1', 0, 'hero', 8, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(9, 'hero_feature1_text', 'استانداردهای آموزشی برتر', '1', 0, 'hero', 9, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(10, 'hero_feature2_title', '۶۷+ سال تجربه', '1', 0, 'hero', 10, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(11, 'hero_feature2_text', 'سابقه درخشان آموزشی', '1', 0, 'hero', 11, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(12, 'hero_image', 'assets/images/resources/graduates.jpg', '1', 0, 'hero', 12, 'assets/images/resources/graduates.jpg', '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(13, 'hero_title', '<span class=\"text-gradient\">Excellence</span> in Education, Path to <span class=\"text-gradient\">Success</span>', '2', 0, 'hero', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(14, 'hero_description', 'High-quality education following Iranian Ministry of Education standards with an international approach to nurture the next generation.', '2', 0, 'hero', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(15, 'hero_badge', 'Salman Farsi Educational Complex', '2', 0, 'hero', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(16, 'hero_btn_primary', 'Apply Now', '2', 0, 'hero', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(17, 'hero_btn_primary_url', 'Terms and Conditions for Registration.php', '2', 0, 'hero', 5, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(18, 'hero_btn_secondary', 'About Us', '2', 0, 'hero', 6, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(19, 'hero_btn_secondary_url', 'about.php', '2', 0, 'hero', 7, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(20, 'hero_feature1_title', 'Quality Education', '2', 0, 'hero', 8, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(21, 'hero_feature1_text', 'Top Educational Standards', '2', 0, 'hero', 9, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(22, 'hero_feature2_title', '67+ Years Experience', '2', 0, 'hero', 10, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(23, 'hero_feature2_text', 'Proven Educational Track Record', '2', 0, 'hero', 11, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(24, 'hero_image', 'assets/images/resources/graduates.jpg', '2', 0, 'hero', 12, 'assets/images/resources/graduates.jpg', '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(25, 'hero_title', 'اختيار <span class=\"text-gradient\">النجاح</span>، مسار <span class=\"text-gradient\">التنمية</span>', '3', 0, 'hero', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(26, 'hero_description', 'تعليم عالي الجودة وفقًا لمعايير وزارة التعليم الإيرانية مع نهج دولي لتنشئة الجيل القادم.', '3', 0, 'hero', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(27, 'hero_badge', 'مجمع سلمان الفارسي التعليمي', '3', 0, 'hero', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(28, 'hero_btn_primary', 'التسجيل الآن', '3', 0, 'hero', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(29, 'hero_btn_primary_url', 'Terms and Conditions for Registration.php', '3', 0, 'hero', 5, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(30, 'hero_btn_secondary', 'من نحن', '3', 0, 'hero', 6, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(31, 'hero_btn_secondary_url', 'about.php', '3', 0, 'hero', 7, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(32, 'hero_feature1_title', 'تعليم عالي الجودة', '3', 0, 'hero', 8, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(33, 'hero_feature1_text', 'معايير تعليمية متميزة', '3', 0, 'hero', 9, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(34, 'hero_feature2_title', '67+ سنة من الخبرة', '3', 0, 'hero', 10, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(35, 'hero_feature2_text', 'سجل تعليمي مثبت', '3', 0, 'hero', 11, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(36, 'hero_image', 'assets/images/resources/graduates.jpg', '3', 0, 'hero', 12, 'assets/images/resources/graduates.jpg', '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(37, 'edu_paths_subtitle', 'آشنایی با دوره‌های تحصیلی ما', '1', 0, 'edu_paths', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(38, 'edu_paths_title', 'دوره‌های تحصیلی ما، <span class=\"text-underline\">فرصتی</span> برای رشد و شکوفایی در هر مقطع', '1', 0, 'edu_paths', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(39, 'edu_paths_description', 'مجتمع آموزشی سلمان فارسی با ارائه دوره‌های آموزشی در مقاطع مختلف، پاسخگوی نیازهای آموزشی دانش‌آموزان از پیش‌دبستانی تا متوسطه دوم است.', '1', 0, 'edu_paths', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(40, 'edu_paths_subtitle', 'Our Educational Paths', '2', 0, 'edu_paths', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(41, 'edu_paths_title', 'Our Academic <span class=\"text-underline\">Programs</span> for Growth at Every Level', '2', 0, 'edu_paths', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(42, 'edu_paths_description', 'Salman Farsi Educational Complex offers educational programs at various levels, meeting the educational needs of students from kindergarten through high school.', '2', 0, 'edu_paths', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(43, 'edu_paths_subtitle', 'مساراتنا التعليمية', '3', 0, 'edu_paths', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(44, 'edu_paths_title', 'برامجنا الأكاديمية <span class=\"text-underline\">فرصة</span> للنمو في كل مستوى', '3', 0, 'edu_paths', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(45, 'edu_paths_description', 'يقدم مجمع سلمان الفارسي التعليمي برامج تعليمية على مختلف المستويات، لتلبية الاحتياجات التعليمية للطلاب من الروضة حتى المرحلة الثانوية.', '3', 0, 'edu_paths', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(46, 'path_title', 'بخش احسان', '1', 1, 'path_items', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(47, 'path_icon', 'fas fa-child', '1', 1, 'path_items', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(48, 'path_description', 'محیطی مملو از شادی و آرامش برای دانش‌آموزان، با تأکید بر موضوعات متنوع و تقویت استعدادهای فردی', '1', 1, 'path_items', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(49, 'path_link_text', 'اطلاعات بیشتر', '1', 1, 'path_items', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(50, 'path_link_url', 'Ehsan SOD page.php', '1', 1, 'path_items', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(51, 'path_title', 'دوره ابتدایی', '1', 1, 'path_items', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(52, 'path_icon', 'fas fa-book-reader', '1', 1, 'path_items', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(53, 'path_description', 'مرحله مهارت‌های اساسی، تمرکز بر خواندن و نوشتن، علوم، ریاضی و مهارت‌های اجتماعی در محیطی جذاب و امن', '1', 1, 'path_items', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(54, 'path_link_text', 'اطلاعات بیشتر', '1', 1, 'path_items', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(55, 'path_link_url', 'Curriculum.php#primary-school', '1', 1, 'path_items', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(56, 'path_title', 'دوره متوسطه اول', '1', 1, 'path_items', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(57, 'path_icon', 'fas fa-atom', '1', 1, 'path_items', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(58, 'path_description', 'آموزش پیشرفته در دروس تخصصی با تأکید بر موضوعات علمی و تقویت مهارت‌های حل مسئله برای آماده‌سازی دانش‌آموزان', '1', 1, 'path_items', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(59, 'path_link_text', 'اطلاعات بیشتر', '1', 1, 'path_items', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(60, 'path_link_url', 'Curriculum.php#middle-school', '1', 1, 'path_items', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(61, 'path_title', 'دوره متوسطه دوم', '1', 1, 'path_items', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(62, 'path_icon', 'fas fa-graduation-cap', '1', 1, 'path_items', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(63, 'path_description', 'آموزش تخصصی در رشته‌های علوم تجربی، علوم انسانی، علوم ریاضی، کامپیوتر، و آماده‌سازی دانش‌آموزان برای دانشگاه', '1', 1, 'path_items', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(64, 'path_link_text', 'اطلاعات بیشتر', '1', 1, 'path_items', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(65, 'path_link_url', 'Curriculum.php#high-school', '1', 1, 'path_items', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(66, 'path_title', 'EHSAN SECTION', '2', 1, 'path_items', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(67, 'path_icon', 'fas fa-child', '2', 1, 'path_items', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(68, 'path_description', 'A joyful and nurturing environment for young learners, focusing on diverse topics and developing individual talents', '2', 1, 'path_items', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(69, 'path_link_text', 'Learn More', '2', 1, 'path_items', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(70, 'path_link_url', 'Ehsan SOD page.php', '2', 1, 'path_items', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(71, 'path_title', 'Primary School', '2', 1, 'path_items', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(72, 'path_icon', 'fas fa-book-reader', '2', 1, 'path_items', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(73, 'path_description', 'The foundational skills phase, focusing on reading, writing, science, mathematics, and social skills in an engaging and safe environment', '2', 1, 'path_items', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(74, 'path_link_text', 'Learn More', '2', 1, 'path_items', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(75, 'path_link_url', 'Curriculum.php#primary-school', '2', 1, 'path_items', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(76, 'path_title', 'Middle School', '2', 1, 'path_items', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(77, 'path_icon', 'fas fa-atom', '2', 1, 'path_items', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(78, 'path_description', 'Advanced learning in specialized subjects with emphasis on scientific topics and strengthening problem-solving skills to prepare students', '2', 1, 'path_items', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(79, 'path_link_text', 'Learn More', '2', 1, 'path_items', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(80, 'path_link_url', 'Curriculum.php#middle-school', '2', 1, 'path_items', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(81, 'path_title', 'High School', '2', 1, 'path_items', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(82, 'path_icon', 'fas fa-graduation-cap', '2', 1, 'path_items', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(83, 'path_description', 'Specialized education in natural sciences, humanities, mathematics, computer science, and preparation of students for university entrance', '2', 1, 'path_items', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(84, 'path_link_text', 'Learn More', '2', 1, 'path_items', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(85, 'path_link_url', 'Curriculum.php#high-school', '2', 1, 'path_items', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(86, 'path_title', 'قسم إحسان', '3', 1, 'path_items', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(87, 'path_icon', 'fas fa-child', '3', 1, 'path_items', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(88, 'path_description', 'بيئة مليئة بالفرح والراحة للطلاب، مع التركيز على موضوعات متنوعة وتعزيز المواهب الفردية', '3', 1, 'path_items', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(89, 'path_link_text', 'المزيد من المعلومات', '3', 1, 'path_items', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(90, 'path_link_url', 'Ehsan SOD page.php', '3', 1, 'path_items', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(91, 'path_title', 'المرحلة الابتدائية', '3', 1, 'path_items', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(92, 'path_icon', 'fas fa-book-reader', '3', 1, 'path_items', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(93, 'path_description', 'مرحلة المهارات الأساسية، مع التركيز على القراءة والكتابة والعلوم والرياضيات والمهارات الاجتماعية في بيئة جذابة وآمنة', '3', 1, 'path_items', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(94, 'path_link_text', 'المزيد من المعلومات', '3', 1, 'path_items', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(95, 'path_link_url', 'Curriculum.php#primary-school', '3', 1, 'path_items', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(96, 'path_title', 'المرحلة المتوسطة', '3', 1, 'path_items', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(97, 'path_icon', 'fas fa-atom', '3', 1, 'path_items', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(98, 'path_description', 'تعليم متقدم في المواد المتخصصة مع التركيز على الموضوعات العلمية وتعزيز مهارات حل المشكلات لإعداد الطلاب', '3', 1, 'path_items', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(99, 'path_link_text', 'المزيد من المعلومات', '3', 1, 'path_items', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(100, 'path_link_url', 'Curriculum.php#middle-school', '3', 1, 'path_items', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(101, 'path_title', 'المرحلة الثانوية', '3', 1, 'path_items', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(102, 'path_icon', 'fas fa-graduation-cap', '3', 1, 'path_items', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(103, 'path_description', 'تعليم متخصص في العلوم الطبيعية والإنسانية والرياضيات وعلوم الكمبيوتر، وإعداد الطلاب لدخول الجامعة', '3', 1, 'path_items', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(104, 'path_link_text', 'المزيد من المعلومات', '3', 1, 'path_items', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(105, 'path_link_url', 'Curriculum.php#high-school', '3', 1, 'path_items', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(106, 'about_subtitle', 'درباره ما', '1', 0, 'about', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(107, 'about_title', 'مجتمع آموزشی <span class=\"text-underline\">سلمان</span> فارسی', '1', 0, 'about', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(108, 'about_text', 'آموزشی با کیفیت بالا، مطابق با استانداردهای وزارت آموزش و پرورش ایران، با تمرکز بر رشد شخصی و تقویت هویت فرهنگی دانش‌آموزان ایرانی در دبی. مسیر آموزشی ما شامل برنامه‌های تقویتی برای رشد شخص و توسعه شخصیت در یک محیط چندفرهنگی است.', '1', 0, 'about', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(109, 'about_image', 'assets/images/facilities/school.jpeg', '1', 0, 'about', 4, 'assets/images/facilities/school.jpeg', '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(110, 'about_experience_number', '67+', '1', 0, 'about', 5, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(111, 'about_experience_text', 'سال تجربه آموزشی', '1', 0, 'about', 6, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(112, 'about_button_text', 'بیشتر درباره ما', '1', 0, 'about', 7, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(113, 'about_button_url', 'about.php', '1', 0, 'about', 8, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(114, 'about_subtitle', 'About Us', '2', 0, 'about', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(115, 'about_title', 'Salman Farsi <span class=\"text-underline\">Educational</span> Complex', '2', 0, 'about', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(116, 'about_text', 'High-quality education following Iranian Ministry of Education standards, focusing on personal growth and strengthening the cultural identity of Iranian students in Dubai. Our educational path includes supportive programs for personal growth and character development in a multicultural environment.', '2', 0, 'about', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(117, 'about_image', 'assets/images/facilities/school.jpeg', '2', 0, 'about', 4, 'assets/images/facilities/school.jpeg', '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(118, 'about_experience_number', '67+', '2', 0, 'about', 5, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(119, 'about_experience_text', 'Years Experience', '2', 0, 'about', 6, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(120, 'about_button_text', 'More About Us', '2', 0, 'about', 7, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(121, 'about_button_url', 'about.php', '2', 0, 'about', 8, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(122, 'about_subtitle', 'من نحن', '3', 0, 'about', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(123, 'about_title', 'مجمع <span class=\"text-underline\">سلمان</span> الفارسي التعليمي', '3', 0, 'about', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(124, 'about_text', 'تعليم عالي الجودة وفقًا لمعايير وزارة التعليم الإيرانية، مع التركيز على النمو الشخصي وتعزيز الهوية الثقافية للطلاب الإيرانيين في دبي. يتضمن مسارنا التعليمي برامج داعمة للنمو الشخصي وتطوير الشخصية في بيئة متعددة الثقافات.', '3', 0, 'about', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(125, 'about_image', 'assets/images/facilities/school.jpeg', '3', 0, 'about', 4, 'assets/images/facilities/school.jpeg', '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(126, 'about_experience_number', '67+', '3', 0, 'about', 5, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(127, 'about_experience_text', 'سنة من الخبرة التعليمية', '3', 0, 'about', 6, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(128, 'about_button_text', 'المزيد عنا', '3', 0, 'about', 7, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(129, 'about_button_url', 'about.php', '3', 0, 'about', 8, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(130, 'feature_text', 'کادر آموزشی مجرب و متخصص', '1', 1, 'about_features', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(131, 'feature_text', 'محیط یادگیری امن و حمایت‌کننده', '1', 1, 'about_features', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(132, 'feature_text', 'برنامه‌های فوق‌برنامه متنوع و غنی‌کننده', '1', 1, 'about_features', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(133, 'feature_text', 'آموزش چندزبانه (فارسی، عربی، انگلیسی)', '1', 1, 'about_features', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(134, 'feature_text', 'Experienced and specialized teaching staff', '2', 1, 'about_features', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(135, 'feature_text', 'Safe and supportive learning environment', '2', 1, 'about_features', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(136, 'feature_text', 'Diverse and enriching extracurricular activities', '2', 1, 'about_features', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(137, 'feature_text', 'Multilingual education (Persian, Arabic, English)', '2', 1, 'about_features', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(138, 'feature_text', 'هيئة تدريس متخصصة وذات خبرة', '3', 1, 'about_features', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(139, 'feature_text', 'بيئة تعليمية آمنة وداعمة', '3', 1, 'about_features', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(140, 'feature_text', 'أنشطة لا منهجية متنوعة ومثرية', '3', 1, 'about_features', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(141, 'feature_text', 'تعليم متعدد اللغات (الفارسية والعربية والإنجليزية)', '3', 1, 'about_features', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(142, 'stat_icon', 'fas fa-user-graduate', '1', 1, 'stats', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(143, 'stat_number', '1700', '1', 1, 'stats', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(144, 'stat_label', 'فارغ التحصیلان موفق', '1', 1, 'stats', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(145, 'stat_icon', 'fas fa-calendar-alt', '1', 1, 'stats', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(146, 'stat_number', '67', '1', 1, 'stats', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(147, 'stat_label', 'سال‌های تجربه', '1', 1, 'stats', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(148, 'stat_icon', 'fas fa-users', '1', 1, 'stats', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(149, 'stat_number', '490', '1', 1, 'stats', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(150, 'stat_label', 'پذیرش سالانه دانش‌آموزان', '1', 1, 'stats', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(151, 'stat_icon', 'fas fa-trophy', '1', 1, 'stats', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(152, 'stat_number', '14', '1', 1, 'stats', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(153, 'stat_label', 'دانشگاه‌های همکار', '1', 1, 'stats', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(154, 'stat_icon', 'fas fa-user-graduate', '2', 1, 'stats', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(155, 'stat_number', '1700', '2', 1, 'stats', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(156, 'stat_label', 'Successful Graduates', '2', 1, 'stats', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(157, 'stat_icon', 'fas fa-calendar-alt', '2', 1, 'stats', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(158, 'stat_number', '67', '2', 1, 'stats', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(159, 'stat_label', 'Years of Experience', '2', 1, 'stats', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(160, 'stat_icon', 'fas fa-users', '2', 1, 'stats', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(161, 'stat_number', '490', '2', 1, 'stats', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(162, 'stat_label', 'Current Students', '2', 1, 'stats', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(163, 'stat_icon', 'fas fa-trophy', '2', 1, 'stats', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(164, 'stat_number', '14', '2', 1, 'stats', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(165, 'stat_label', 'University Partners', '2', 1, 'stats', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(166, 'stat_icon', 'fas fa-user-graduate', '3', 1, 'stats', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(167, 'stat_number', '1700', '3', 1, 'stats', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(168, 'stat_label', 'خريجين ناجحين', '3', 1, 'stats', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(169, 'stat_icon', 'fas fa-calendar-alt', '3', 1, 'stats', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(170, 'stat_number', '67', '3', 1, 'stats', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(171, 'stat_label', 'سنوات الخبرة', '3', 1, 'stats', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(172, 'stat_icon', 'fas fa-users', '3', 1, 'stats', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(173, 'stat_number', '490', '3', 1, 'stats', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(174, 'stat_label', 'طلاب حاليون', '3', 1, 'stats', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(175, 'stat_icon', 'fas fa-trophy', '3', 1, 'stats', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(176, 'stat_number', '14', '3', 1, 'stats', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(177, 'stat_label', 'شركاء من الجامعات', '3', 1, 'stats', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(178, 'university_subtitle', 'افتخار حضور در دانشگاه‌های برتر', '1', 0, 'universities', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(179, 'university_title', 'مقاصد <span class=\"text-underline\">دانشگاهی</span> فارغ‌التحصیلان ما', '1', 0, 'universities', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(180, 'university_description', 'فارغ‌التحصیلان مجتمع آموزشی سلمان فارسی در معتبرترین دانشگاه‌های ایران و جهان مشغول به تحصیل هستند', '1', 0, 'universities', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(181, 'university_subtitle', 'Proud Presence in Top Universities', '2', 0, 'universities', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(182, 'university_title', 'University <span class=\"text-underline\">Destinations</span> of Our Graduates', '2', 0, 'universities', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(183, 'university_description', 'Graduates of Salman Farsi Educational Complex are studying in the most prestigious universities in Iran and around the world', '2', 0, 'universities', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(184, 'university_subtitle', 'حضور فخري في أفضل الجامعات', '3', 0, 'universities', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(185, 'university_title', '<span class=\"text-underline\">وجهات</span> جامعية لخريجينا', '3', 0, 'universities', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(186, 'university_description', 'يدرس خريجو مجمع سلمان الفارسي التعليمي في أرقى الجامعات في إيران وحول العالم', '3', 0, 'universities', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(187, 'univ_name', 'دانشگاه عجمان', '1', 1, 'university_items', 1, 'assets/images/University_Logos/ajman-university8747-removebg-preview.png', '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(188, 'univ_name', 'دانشگاه آمریکایی دبی', '1', 1, 'university_items', 2, 'assets/images/University_Logos/b1b6c65f341b33f98c748d68aa8ed0e2.American_University_in_Dubai.png', '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(189, 'univ_name', 'دانشگاه آزاد اسلامی', '1', 1, 'university_items', 3, 'assets/images/University_Logos/iau-removebg-preview.png', '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(190, 'univ_name', 'دانشگاه تهران', '1', 1, 'university_items', 4, 'assets/images/University_Logos/images-removebg-preview.png', '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(191, 'univ_name', 'دانشگاه وولونگونگ دبی', '1', 1, 'university_items', 5, 'assets/images/University_Logos/UOWD_Secondary_CMYK_Dark Blue.png', '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(192, 'univ_name', 'دانشگاه صنعتی شریف', '1', 1, 'university_items', 6, 'assets/images/University_Logos/sharif.png', '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(193, 'univ_name', 'دانشگاه صنعتی امیرکبیر', '1', 1, 'university_items', 7, 'assets/images/University_Logos/amirkabir.png', '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(194, 'univ_name', 'Ajman University', '2', 1, 'university_items', 1, 'assets/images/University_Logos/ajman-university8747-removebg-preview.png', '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(195, 'univ_name', 'American University in Dubai', '2', 1, 'university_items', 2, 'assets/images/University_Logos/b1b6c65f341b33f98c748d68aa8ed0e2.American_University_in_Dubai.png', '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(196, 'univ_name', 'Islamic Azad University', '2', 1, 'university_items', 3, 'assets/images/University_Logos/iau-removebg-preview.png', '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(197, 'univ_name', 'University of Tehran', '2', 1, 'university_items', 4, 'assets/images/University_Logos/images-removebg-preview.png', '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(198, 'univ_name', 'University of Wollongong Dubai', '2', 1, 'university_items', 5, 'assets/images/University_Logos/UOWD_Secondary_CMYK_Dark Blue.png', '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(199, 'univ_name', 'Sharif University of Technology', '2', 1, 'university_items', 6, 'assets/images/University_Logos/sharif.png', '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(200, 'univ_name', 'Amirkabir University of Technology', '2', 1, 'university_items', 7, 'assets/images/University_Logos/amirkabir.png', '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(201, 'univ_name', 'جامعة عجمان', '3', 1, 'university_items', 1, 'assets/images/University_Logos/ajman-university8747-removebg-preview.png', '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(202, 'univ_name', 'الجامعة الأمريكية في دبي', '3', 1, 'university_items', 2, 'assets/images/University_Logos/b1b6c65f341b33f98c748d68aa8ed0e2.American_University_in_Dubai.png', '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(203, 'univ_name', 'جامعة آزاد الإسلامية', '3', 1, 'university_items', 3, 'assets/images/University_Logos/iau-removebg-preview.png', '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(204, 'univ_name', 'جامعة طهران', '3', 1, 'university_items', 4, 'assets/images/University_Logos/images-removebg-preview.png', '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(205, 'univ_name', 'جامعة ولونغونغ دبي', '3', 1, 'university_items', 5, 'assets/images/University_Logos/UOWD_Secondary_CMYK_Dark Blue.png', '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(206, 'univ_name', 'جامعة شريف للتكنولوجيا', '3', 1, 'university_items', 6, 'assets/images/University_Logos/sharif.png', '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(207, 'univ_name', 'جامعة أميركبير للتكنولوجيا', '3', 1, 'university_items', 7, 'assets/images/University_Logos/amirkabir.png', '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(208, 'video_title', 'بازدید مجازی سلمان فارسی', '1', 0, 'video', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(209, 'video_description', 'از فضای مدرسه، کلاس‌ها، آزمایشگاه‌ها و امکانات ورزشی بازدید کنید و با محیط آموزشی ما آشنا شوید.', '1', 0, 'video', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(210, 'video_duration', '۳ دقیقه و ۴۵ ثانیه', '1', 0, 'video', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(211, 'video_thumbnail', 'assets/images/resources/video-thumbnail.jpg', '1', 0, 'video', 4, 'assets/images/resources/video-thumbnail.jpg', '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(212, 'video_url', 'assets/videos/school-intro.mp4', '1', 0, 'video', 5, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(213, 'video_title', 'Salman Farsi Virtual Tour', '2', 0, 'video', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(214, 'video_description', 'Explore our school grounds, classrooms, laboratories, and sports facilities to get familiar with our educational environment.', '2', 0, 'video', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(215, 'video_duration', '3:45 minutes', '2', 0, 'video', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(216, 'video_thumbnail', 'assets/images/resources/video-thumbnail.jpg', '2', 0, 'video', 4, 'assets/images/resources/video-thumbnail.jpg', '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(217, 'video_url', 'assets/videos/school-intro.mp4', '2', 0, 'video', 5, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(218, 'video_title', 'جولة افتراضية في سلمان الفارسي', '3', 0, 'video', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(219, 'video_description', 'استكشف مرافق مدرستنا والفصول الدراسية والمختبرات والمرافق الرياضية للتعرف على بيئتنا التعليمية.', '3', 0, 'video', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(220, 'video_duration', '٣ دقائق و٤٥ ثانية', '3', 0, 'video', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(221, 'video_thumbnail', 'assets/images/resources/video-thumbnail.jpg', '3', 0, 'video', 4, 'assets/images/resources/video-thumbnail.jpg', '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(222, 'video_url', 'assets/videos/school-intro.mp4', '3', 0, 'video', 5, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(223, 'cta_badge', 'ثبت‌نام سال تحصیلی جدید', '1', 0, 'cta', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(224, 'cta_title', 'به خانواده سلمان فارسی بپیوندید', '1', 0, 'cta', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(225, 'cta_text', 'برای ثبت‌نام فرزندان خود در مجتمع آموزشی سلمان فارسی و بهره‌مندی از آموزش باکیفیت ایرانی در دبی، همین امروز اقدام کنید.', '1', 0, 'cta', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(226, 'cta_btn_primary', 'ثبت‌نام آنلاین', '1', 0, 'cta', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(227, 'cta_btn_primary_url', 'Terms and Conditions for Registration.php', '1', 0, 'cta', 5, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(228, 'cta_btn_secondary', 'تماس با ما', '1', 0, 'cta', 6, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(229, 'cta_btn_secondary_url', 'contact.php', '1', 0, 'cta', 7, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(230, 'cta_badge', 'Enrollment Open for New Academic Year', '2', 0, 'cta', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(231, 'cta_title', 'Join the Salman Farsi Family', '2', 0, 'cta', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(232, 'cta_text', 'To register your children at Salman Farsi Educational Complex and benefit from quality Iranian education in Dubai, take action today.', '2', 0, 'cta', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(233, 'cta_btn_primary', 'Online Registration', '2', 0, 'cta', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(234, 'cta_btn_primary_url', 'Terms and Conditions for Registration.php', '2', 0, 'cta', 5, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(235, 'cta_btn_secondary', 'Contact Us', '2', 0, 'cta', 6, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(236, 'cta_btn_secondary_url', 'contact.php', '2', 0, 'cta', 7, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(237, 'cta_badge', 'التسجيل مفتوح للعام الدراسي الجديد', '3', 0, 'cta', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(238, 'cta_title', 'انضم إلى عائلة سلمان الفارسي', '3', 0, 'cta', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(239, 'cta_text', 'لتسجيل أطفالك في مجمع سلمان الفارسي التعليمي والاستفادة من التعليم الإيراني عالي الجودة في دبي، بادر اليوم.', '3', 0, 'cta', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(240, 'cta_btn_primary', 'التسجيل عبر الإنترنت', '3', 0, 'cta', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(241, 'cta_btn_primary_url', 'Terms and Conditions for Registration.php', '3', 0, 'cta', 5, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(242, 'cta_btn_secondary', 'اتصل بنا', '3', 0, 'cta', 6, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(243, 'cta_btn_secondary_url', 'contact.php', '3', 0, 'cta', 7, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(244, 'faq_subtitle', 'سوالات متداول', '1', 0, 'faq', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(245, 'faq_title', 'پاسخ به <span class=\"text-underline\">سوالات</span> متداول شما', '1', 0, 'faq', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(246, 'faq_description', 'پاسخ سوالات شایع در مورد مدرسه از جمله پذیرش، شهریه و برنامه‌های آموزشی را اینجا بیابید.', '1', 0, 'faq', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(247, 'faq_button_text', 'مشاهده همه سوالات متداول', '1', 0, 'faq', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(248, 'faq_button_url', 'faq.php', '1', 0, 'faq', 5, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(249, 'faq_subtitle', 'Frequently Asked Questions', '2', 0, 'faq', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(250, 'faq_title', 'Answers to Your <span class=\"text-underline\">Common</span> Questions', '2', 0, 'faq', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(251, 'faq_description', 'Find answers to common questions about the school including admissions, tuition, and educational programs.', '2', 0, 'faq', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(252, 'faq_button_text', 'View All FAQs', '2', 0, 'faq', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(253, 'faq_button_url', 'faq.php', '2', 0, 'faq', 5, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(254, 'faq_subtitle', 'الأسئلة الشائعة', '3', 0, 'faq', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(255, 'faq_title', 'إجابات على <span class=\"text-underline\">أسئلتك</span> الشائعة', '3', 0, 'faq', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(256, 'faq_description', 'ابحث عن إجابات للأسئلة الشائعة حول المدرسة بما في ذلك القبول والرسوم الدراسية والبرامج التعليمية.', '3', 0, 'faq', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(257, 'faq_button_text', 'عرض جميع الأسئلة الشائعة', '3', 0, 'faq', 4, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(258, 'faq_button_url', 'faq.php', '3', 0, 'faq', 5, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(259, 'faq_question', 'زبان تدریس در مدرسه چه زبان‌هایی است؟', '1', 1, 'faq_items', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(260, 'faq_answer', 'زبان تدریس اصلی در مدرسه ما فارسی است، با این حال، زبان‌های انگلیسی و عربی نیز در برنامه درسی گنجانده شده‌اند تا مهارت‌های زبانی دانش‌آموزان تقویت شود.', '1', 1, 'faq_items', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(261, 'faq_question', 'نحوه ثبت‌نام در مدرسه چیست و مدارک و زمان‌بندی ثبت‌نام چگونه است؟', '1', 1, 'faq_items', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(262, 'faq_answer', 'برای ثبت‌نام در مدرسه، والدین باید به صورت حضوری مراجعه کرده و مدارک مورد نیاز شامل شناسنامه، کارت ملی، گواهی سلامت، عکس پرسنلی و مدارک تحصیلی قبلی را ارائه دهند. لطفاً برای اطلاعات دقیق‌تر و مطمئن‌شدن از مدارک لازم، قبل از مراجعه حضوری با مدرسه تماس بگیرید. ثبت‌نام در ماه‌های خرداد و تیر انجام می‌شود و در صورتی که بعد از این زمان ثبت‌نام صورت گیرد، هزینه‌ای تحت عنوان جریمه دریافت خواهد شد.', '1', 1, 'faq_items', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(263, 'faq_question', 'هزینه‌های شهریه مدرسه چقدر است و شامل چه مواردی می‌شود؟', '1', 1, 'faq_items', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(264, 'faq_answer', 'هزینه‌های شهریه بر اساس مقطع تحصیلی و رشته انتخابی متفاوت است. شهریه شامل هزینه‌های آموزشی، کتاب‌های درسی، فعالیت‌های فوق‌برنامه و خدمات پایه مدرسه می‌شود. برای اطلاعات دقیق‌تر، لطفاً با بخش مالی مدرسه تماس بگیرید.', '1', 1, 'faq_items', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(265, 'faq_question', 'What languages are used for instruction at the school?', '2', 1, 'faq_items', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(266, 'faq_answer', 'The primary language of instruction at our school is Persian, while English and Arabic are also included in the curriculum to enhance students\' language skills.', '2', 1, 'faq_items', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(267, 'faq_question', 'What is the registration process, and what are the required documents and timeline?', '2', 1, 'faq_items', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(268, 'faq_answer', 'To register at the school, parents need to visit the school in person and provide required documents such as birth certificate, ID card, health certificate, passport-sized photo, and previous academic records. For detailed information and to confirm the necessary documents, please contact the school before visiting. Registration typically occurs in June and July, and late registrations will incur an additional penalty fee.', '2', 1, 'faq_items', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(269, 'faq_question', 'What are the tuition fees and what do they cover?', '2', 1, 'faq_items', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(270, 'faq_answer', 'Tuition fees vary depending on the grade level and chosen specialization. The fees cover educational costs, textbooks, extracurricular activities, and basic school services. For more precise details, please contact the school\'s finance department.', '2', 1, 'faq_items', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(271, 'faq_question', 'ما هي اللغات المستخدمة للتدريس في المدرسة؟', '3', 1, 'faq_items', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(272, 'faq_answer', 'اللغة الرئيسية للتدريس في مدرستنا هي الفارسية، بينما يتم تضمين اللغتين الإنجليزية والعربية أيضًا في المنهج الدراسي لتعزيز المهارات اللغوية للطلاب.', '3', 1, 'faq_items', 1, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(273, 'faq_question', 'ما هي عملية التسجيل، وما هي المستندات المطلوبة والجدول الزمني؟', '3', 1, 'faq_items', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(274, 'faq_answer', 'للتسجيل في المدرسة، يحتاج الآباء إلى زيارة المدرسة شخصيًا وتقديم المستندات المطلوبة مثل شهادة الميلاد وبطاقة الهوية وشهادة الصحة وصورة بحجم جواز السفر والسجلات الأكاديمية السابقة. للحصول على معلومات مفصلة وللتأكد من المستندات اللازمة، يرجى الاتصال بالمدرسة قبل الزيارة. يتم التسجيل عادة في يونيو ويوليو، وستتكبد التسجيلات المتأخرة رسوم غرامة إضافية.', '3', 1, 'faq_items', 2, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(275, 'faq_question', 'ما هي الرسوم الدراسية وماذا تغطي؟', '3', 1, 'faq_items', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11'),
(276, 'faq_answer', 'تختلف الرسوم الدراسية حسب المرحلة الدراسية والتخصص المختار. تغطي الرسوم التكاليف التعليمية والكتب المدرسية والأنشطة اللامنهجية والخدمات المدرسية الأساسية. لمزيد من التفاصيل الدقيقة، يرجى الاتصال بقسم المالية بالمدرسة.', '3', 1, 'faq_items', 3, NULL, '2025-04-01 14:05:11', '2025-04-01 14:05:11');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `language_id` int(11) NOT NULL,
  `code` varchar(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `native_name` varchar(50) DEFAULT NULL,
  `is_rtl` tinyint(1) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `is_default` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`language_id`, `code`, `name`, `native_name`, `is_rtl`, `is_active`, `is_default`) VALUES
(0, 'globa', 'Global (No language)', NULL, 0, 1, 0),
(1, 'fa', 'Persian', 'فارسی', 1, 1, 1),
(2, 'en', 'English', 'English', 0, 1, 0),
(3, 'ar', 'Arabic', 'العربية', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `entity` varchar(100) DEFAULT NULL,
  `entity_id` int(11) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`log_id`, `user_id`, `action`, `entity`, `entity_id`, `ip_address`, `user_agent`, `created_at`) VALUES
(1, 2, 'login', 'admin_panel', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', '2025-03-29 13:56:54'),
(2, 1, 'login', 'admin_panel', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:136.0) Gecko/20100101 Firefox/136.0', '2025-03-29 14:10:14');

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `major_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`major_id`) VALUES
(1),
(2),
(3),
(4);

-- --------------------------------------------------------

--
-- Table structure for table `major_translations`
--

CREATE TABLE `major_translations` (
  `major_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `major_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `major_translations`
--

INSERT INTO `major_translations` (`major_id`, `language_id`, `major_name`) VALUES
(1, 1, 'کاردانش'),
(1, 2, 'Technical and Vocational'),
(1, 3, 'الفنية والتقنية'),
(2, 1, 'ریاضی و فیزیک'),
(2, 2, 'Mathematics and Physics'),
(2, 3, 'الرياضيات والفيزياء'),
(3, 1, 'علوم تجربی'),
(3, 2, 'Experimental Sciences'),
(3, 3, 'العلوم التجريبية'),
(4, 1, 'علوم انسانی'),
(4, 2, 'Humanities'),
(4, 3, 'العلوم الإنسانية');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `media_id` int(11) NOT NULL,
  `uploaded_by` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `file_size` int(11) DEFAULT 0,
  `file_path` varchar(255) NOT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `caption` text DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`media_id`, `uploaded_by`, `file_name`, `original_name`, `file_type`, `file_size`, `file_path`, `width`, `height`, `alt_text`, `caption`, `uploaded_at`) VALUES
(1, 1, 'Akhlasi.png', 'Akhlasi.png', 'image/png', 0, 'assets/images/Staff/Akhlasi.png', 320, 400, 'Majid Akhlasi', NULL, '2025-03-27 11:49:20'),
(2, 1, 'Mohammadi.png', 'Mohammadi.png', 'image/png', 0, 'assets/images/Staff/Mohammadi.png', 320, 400, 'Mohammad Reza Mohammadi', NULL, '2025-03-27 11:49:20'),
(3, 1, 'Dashab.png', 'Dashab.png', 'image/png', 0, 'assets/images/Staff/Dashab.png', 320, 400, 'Nosrat Dashab', NULL, '2025-03-27 11:49:20'),
(4, 1, 'Ranjbar.png', 'Ranjbar.png', 'image/png', 0, 'assets/images/Staff/Ranjbar.png', 320, 400, 'Hassan Ranjbar', NULL, '2025-03-27 11:49:20'),
(5, 1, 'Jafari.png', 'Jafari.png', 'image/png', 0, 'assets/images/Staff/Jafari.png', 320, 400, 'Masoomeh Jafari', NULL, '2025-03-27 11:49:20'),
(6, 1, 'Kazemi.png', 'Kazemi.png', 'image/png', 0, 'assets/images/Staff/Kazemi.png', 320, 400, 'Masoomeh Kazemi', NULL, '2025-03-27 11:49:20'),
(7, 1, 'Eslami.png', 'Eslami.png', 'image/png', 0, 'assets/images/Staff/Eslami.png', 320, 400, 'Fathieh Eslami', NULL, '2025-03-27 11:49:20'),
(8, 1, 'Rezaei.png', 'Rezaei.png', 'image/png', 0, 'assets/images/Staff/Rezaei.png', 320, 400, 'Nader Rezaei', NULL, '2025-03-27 11:49:20'),
(9, 1, 'Samadi_Vahdati.png', 'Samadi_Vahdati.png', 'image/png', 0, 'assets/images/Staff/Samadi_Vahdati.png', 320, 400, 'Farzad Samadi Vahdati', NULL, '2025-03-27 11:49:20'),
(10, 1, 'Kar.png', 'Kar.png', 'image/png', 0, 'assets/images/Staff/Kar.png', 320, 400, 'Amir Hossein Kar', NULL, '2025-03-27 11:49:20'),
(11, 1, 'Sarnezadeh.png', 'Sarnezadeh.png', 'image/png', 0, 'assets/images/Staff/Sarnezadeh.png', 320, 400, 'Majid Sarnezadeh', NULL, '2025-03-27 11:49:20'),
(12, 1, 'Khosroniya.png', 'Khosroniya.png', 'image/png', 0, 'assets/images/Staff/Khosroniya.png', 320, 400, 'Vahid Khosroniya', NULL, '2025-03-27 11:49:20'),
(13, 1, 'Amin_Gerefteh.png', 'Amin_Gerefteh.png', 'image/png', 0, 'assets/images/Staff/Amin_Gerefteh.png', 320, 400, 'Shapoor Amin Gerefteh', NULL, '2025-03-27 11:49:20'),
(14, 1, 'Salehi.png', 'Salehi.png', 'image/png', 0, 'assets/images/Staff/Salehi.png', 320, 400, 'Naser Salehi', NULL, '2025-03-27 11:49:20'),
(15, 1, 'Razaghian.png', 'Razaghian.png', 'image/png', 0, 'assets/images/Staff/Razaghian.png', 320, 400, 'Ali Asghar Razaghian', NULL, '2025-03-27 11:49:20'),
(16, 1, 'Dorfesheh.png', 'Dorfesheh.png', 'image/png', 0, 'assets/images/Staff/Dorfesheh.png', 320, 400, 'Aziz Dorfesheh', NULL, '2025-03-27 11:49:20'),
(17, 1, 'Davoodi.png', 'Davoodi.png', 'image/png', 0, 'assets/images/Staff/Davoodi.png', 320, 400, 'Abdolrahim Davoodi', NULL, '2025-03-27 11:49:20'),
(18, 1, 'Dadashpour.png', 'Dadashpour.png', 'image/png', 0, 'assets/images/Staff/Dadashpour.png', 320, 400, 'Parviz Dadashpour', NULL, '2025-03-27 11:49:20'),
(19, 1, 'Behzadi.png', 'Behzadi.png', 'image/png', 0, 'assets/images/Staff/Behzadi.png', 320, 400, 'Bijan Behzadi', NULL, '2025-03-27 11:49:20'),
(20, 1, 'Mirhosseini.png', 'Mirhosseini.png', 'image/png', 0, 'assets/images/Staff/Mirhosseini.png', 320, 400, 'Seyyed Amir Reza Mirhosseini', NULL, '2025-03-27 11:49:20'),
(21, 1, 'Balouchi.png', 'Balouchi.png', 'image/png', 0, 'assets/images/Staff/Balouchi.png', 320, 400, 'Mohammad Balouchi', NULL, '2025-03-27 11:49:20'),
(22, 1, 'mallah.png', 'mallah.png', 'image/png', 0, 'assets/images/Staff/mallah.png', 320, 400, 'Mehrshad Mallah', NULL, '2025-03-27 11:49:20'),
(23, 1, 'Mojri_Asli.png', 'Mojri_Asli.png', 'image/png', 0, 'assets/images/Staff/Mojri_Asli.png', 320, 400, 'Seyyed Mohammad Reza Mojri Asli', NULL, '2025-03-27 11:49:20'),
(24, 1, 'Zare.png', 'Zare.png', 'image/png', 0, 'assets/images/Staff/Zare.png', 320, 400, 'Zare', NULL, '2025-03-27 11:49:20'),
(25, 1, 'Shokouhi.png', 'Shokouhi.png', 'image/png', 0, 'assets/images/Staff/Shokouhi.png', 320, 400, 'Fatemeh Shokouhi', NULL, '2025-03-27 11:49:20'),
(26, 1, 'Mokhtari.png', 'Mokhtari.png', 'image/png', 0, 'assets/images/Staff/Mokhtari.png', 320, 400, 'Shahin Mokhtari', NULL, '2025-03-27 11:49:20'),
(27, 1, 'Hashemi.png', 'Hashemi.png', 'image/png', 0, 'assets/images/Staff/Hashemi.png', 320, 400, 'Bahareh Hashemi', NULL, '2025-03-27 11:49:20'),
(28, 1, 'Payamard.png', 'Payamard.png', 'image/png', 0, 'assets/images/Staff/Payamard.png', 320, 400, 'Fariba Payamard', NULL, '2025-03-27 11:49:20'),
(29, 1, 'Lamiya.png', 'Lamiya.png', 'image/png', 0, 'assets/images/Staff/Lamiya.png', 320, 400, 'Lamia', NULL, '2025-03-27 11:49:20'),
(30, 1, 'reisi.png', 'reisi.png', 'image/png', 0, 'assets/images/blog/reisi.png', 800, 500, 'Ayatollah Raisi', NULL, '2025-03-27 11:49:20'),
(31, 1, 'AyatollahRaisi1.jpg', 'AyatollahRaisi1.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/AyatollahRaisi1.jpg', 800, 500, 'Ayatollah Raisi 1', NULL, '2025-03-27 11:49:20'),
(32, 1, 'AyatollahRaisi2.jpg', 'AyatollahRaisi2.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/AyatollahRaisi2.jpg', 800, 500, 'Ayatollah Raisi 2', NULL, '2025-03-27 11:49:20'),
(33, 1, 'imam-khomeini.png', 'imam-khomeini.png', 'image/png', 0, 'assets/images/blog/imam-khomeini.png', 800, 500, 'Imam Khomeini', NULL, '2025-03-27 11:49:20'),
(34, 1, 'imam-khomeini1.jpg', 'imam-khomeini1.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/imam-khomeini1.jpg', 800, 500, 'Imam Khomeini 1', NULL, '2025-03-27 11:49:20'),
(35, 1, 'imam-khomeini2.jpg', 'imam-khomeini2.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/imam-khomeini2.jpg', 800, 500, 'Imam Khomeini 2', NULL, '2025-03-27 11:49:20'),
(36, 1, 'nowruz.png', 'nowruz.png', 'image/png', 0, 'assets/images/blog/nowruz.png', 800, 500, 'Nowruz', NULL, '2025-03-27 11:49:20'),
(37, 1, 'nowruz1.jpg', 'nowruz1.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/nowruz1.jpg', 800, 500, 'Nowruz Celebration 1', NULL, '2025-03-27 11:49:20'),
(38, 1, 'nowruz2.jpg', 'nowruz2.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/nowruz2.jpg', 800, 500, 'Nowruz Celebration 2', NULL, '2025-03-27 11:49:20'),
(39, 1, 'revolution.png', 'revolution.png', 'image/png', 0, 'assets/images/blog/revolution.png', 800, 500, 'Islamic Revolution', NULL, '2025-03-27 11:49:20'),
(40, 1, 'revolution1.jpg', 'revolution1.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/revolution1.jpg', 800, 500, 'Islamic Revolution 1', NULL, '2025-03-27 11:49:20'),
(41, 1, 'revolution2.jpg', 'revolution2.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/revolution2.jpg', 800, 500, 'Islamic Revolution 2', NULL, '2025-03-27 11:49:20'),
(42, 1, 'fajr-decade.png', 'fajr-decade.png', 'image/png', 0, 'assets/images/blog/fajr-decade.png', 800, 500, 'Fajr Decade', NULL, '2025-03-27 11:49:20'),
(43, 1, 'fajr-decade1.jpg', 'fajr-decade1.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/fajr-decade1.jpg', 800, 500, 'Fajr Decade 1', NULL, '2025-03-27 11:49:20'),
(44, 1, 'fajr-decade2.jpg', 'fajr-decade2.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/fajr-decade2.jpg', 800, 500, 'Fajr Decade 2', NULL, '2025-03-27 11:49:20'),
(45, 1, 'eid-fitr.png', 'eid-fitr.png', 'image/png', 0, 'assets/images/blog/eid-fitr.png', 800, 500, 'Eid al-Fitr', NULL, '2025-03-27 11:49:20'),
(46, 1, 'eid-fitr1.jpg', 'eid-fitr1.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/eid-fitr1.jpg', 800, 500, 'Eid al-Fitr 1', NULL, '2025-03-27 11:49:20'),
(47, 1, 'eid-fitr2.jpg', 'eid-fitr2.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/eid-fitr2.jpg', 800, 500, 'Eid al-Fitr 2', NULL, '2025-03-27 11:49:20'),
(48, 1, 'eid-ghadir.png', 'eid-ghadir.png', 'image/png', 0, 'assets/images/blog/eid-ghadir.png', 800, 500, 'Eid al-Ghadir', NULL, '2025-03-27 11:49:20'),
(49, 1, 'eid-ghadir1.jpg', 'eid-ghadir1.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/eid-ghadir1.jpg', 800, 500, 'Eid al-Ghadir 1', NULL, '2025-03-27 11:49:20'),
(50, 1, 'eid-ghadir2.jpg', 'eid-ghadir2.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/eid-ghadir2.jpg', 800, 500, 'Eid al-Ghadir 2', NULL, '2025-03-27 11:49:20'),
(51, 1, 'eid-qurban.png', 'eid-qurban.png', 'image/png', 0, 'assets/images/blog/eid-qurban.png', 800, 500, 'Eid al-Adha', NULL, '2025-03-27 11:49:20'),
(52, 1, 'teachers-day.png', 'teachers-day.png', 'image/png', 0, 'assets/images/blog/teachers-day.png', 800, 500, 'Teachers Day', NULL, '2025-03-27 11:49:20'),
(53, 1, 'teachers-day1.jpg', 'teachers-day1.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/teachers-day1.jpg', 800, 500, 'Teachers Day 1', NULL, '2025-03-27 11:49:20'),
(54, 1, 'teachers-day2.jpg', 'teachers-day2.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/teachers-day2.jpg', 800, 500, 'Teachers Day 2', NULL, '2025-03-27 11:49:20'),
(55, 1, 'new-year.png', 'new-year.png', 'image/png', 0, 'assets/images/blog/new-year.png', 800, 500, 'New Year', NULL, '2025-03-27 11:49:20'),
(56, 1, 'new-year1.jpg', 'new-year1.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/new-year1.jpg', 800, 500, 'New Year 1', NULL, '2025-03-27 11:49:20'),
(57, 1, 'new-year2.jpg', 'new-year2.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/new-year2.jpg', 800, 500, 'New Year 2', NULL, '2025-03-27 11:49:20'),
(58, 1, 'ramadan.png', 'ramadan.png', 'image/png', 0, 'assets/images/blog/ramadan.png', 800, 500, 'Ramadan', NULL, '2025-03-27 11:49:20'),
(59, 1, 'ramadan1.jpg', 'ramadan1.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/ramadan1.jpg', 800, 500, 'Ramadan 1', NULL, '2025-03-27 11:49:20'),
(60, 1, 'ramadan2.jpg', 'ramadan2.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/ramadan2.jpg', 800, 500, 'Ramadan 2', NULL, '2025-03-27 11:49:20'),
(61, 1, 'uae-national-day.png', 'uae-national-day.png', 'image/png', 0, 'assets/images/blog/uae-national-day.png', 800, 500, 'UAE National Day', NULL, '2025-03-27 11:49:20'),
(62, 1, 'uae-national-day1.jpg', 'uae-national-day1.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/uae-national-day1.jpg', 800, 500, 'UAE National Day 1', NULL, '2025-03-27 11:49:20'),
(63, 1, 'uae-national-day2.jpg', 'uae-national-day2.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/uae-national-day2.jpg', 800, 500, 'UAE National Day 2', NULL, '2025-03-27 11:49:20'),
(64, 1, 'sacred-defense-week.png', 'sacred-defense-week.png', 'image/png', 0, 'assets/images/blog/sacred-defense-week.png', 800, 500, 'Sacred Defense Week', NULL, '2025-03-27 11:49:20'),
(65, 1, 'sacred-defense-week1.jpg', 'sacred-defense-week1.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/sacred-defense-week1.jpg', 800, 500, 'Sacred Defense Week 1', NULL, '2025-03-27 11:49:20'),
(66, 1, 'sacred-defense-week2.jpg', 'sacred-defense-week2.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/sacred-defense-week2.jpg', 800, 500, 'Sacred Defense Week 2', NULL, '2025-03-27 11:49:20'),
(67, 1, 'muharram.png', 'muharram.png', 'image/png', 0, 'assets/images/blog/muharram.png', 800, 500, 'Muharram', NULL, '2025-03-27 11:49:20'),
(68, 1, 'muharram1.jpg', 'muharram1.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/muharram1.jpg', 800, 500, 'Muharram 1', NULL, '2025-03-27 11:49:20'),
(69, 1, 'muharram2.jpg', 'muharram2.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/muharram2.jpg', 800, 500, 'Muharram 2', NULL, '2025-03-27 11:49:20'),
(70, 1, 'shab_qadr.png', 'shab_qadr.png', 'image/png', 0, 'assets/images/blog/shab_qadr.png', 800, 500, 'Nights of Glory', NULL, '2025-03-27 11:49:20'),
(71, 1, 'ali_shohada.jpg', 'ali_shohada.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/ali_shohada.jpg', 800, 500, 'Ali Martyrdom', NULL, '2025-03-27 11:49:20'),
(72, 1, 'fazilat_shab_qadr.jpg', 'fazilat_shab_qadr.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/fazilat_shab_qadr.jpg', 800, 500, 'Virtue of Night of Glory', NULL, '2025-03-27 11:49:20'),
(73, 1, 'abtahi.png', 'abtahi.png', 'image/png', 0, 'assets/images/blog/abtahi.png', 800, 500, 'Mr. Abtahi', NULL, '2025-03-27 11:49:20'),
(74, 1, 'raju.png', 'raju.png', 'image/png', 0, 'assets/images/blog/raju.png', 800, 500, 'Mr. Raju', NULL, '2025-03-27 11:49:20'),
(75, 1, 'ajman_visit.png', 'ajman_visit.png', 'image/png', 0, 'assets/images/blog/ajman_visit.png', 800, 500, 'Ajman University Visit', NULL, '2025-03-27 11:49:20'),
(76, 1, 'ajman_visit2.jpg', 'ajman_visit2.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/ajman_visit2.jpg', 800, 500, 'Ajman University Visit 2', NULL, '2025-03-27 11:49:20'),
(77, 1, 'expo2020.png', 'expo2020.png', 'image/png', 0, 'assets/images/blog/expo2020.png', 800, 500, 'Expo 2020 Dubai', NULL, '2025-03-27 11:49:20'),
(78, 1, 'safari_park.png', 'safari_park.png', 'image/png', 0, 'assets/images/blog/safari_park.png', 800, 500, 'Dubai Safari Park', NULL, '2025-03-27 11:49:20'),
(79, 1, 'volleyball_championship.png', 'volleyball_championship.png', 'image/png', 0, 'assets/images/blog/volleyball_championship.png', 800, 500, 'Volleyball Championship', NULL, '2025-03-27 11:49:20'),
(80, 1, 'yalda_night.png', 'yalda_night.png', 'image/png', 0, 'assets/images/blog/yalda_night.png', 800, 500, 'Yalda Night', NULL, '2025-03-27 11:49:20'),
(81, 1, 'salman_anthem.png', 'salman_anthem.png', 'image/png', 0, 'assets/images/blog/salman_anthem.png', 800, 500, 'Salman Anthem', NULL, '2025-03-27 11:49:20'),
(82, 1, 'salman_anthem1.jpg', 'salman_anthem1.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/salman_anthem1.jpg', 800, 500, 'Salman Anthem 1', NULL, '2025-03-27 11:49:20'),
(83, 1, 'salman_anthem2.jpg', 'salman_anthem2.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/salman_anthem2.jpg', 800, 500, 'Salman Anthem 2', NULL, '2025-03-27 11:49:20'),
(84, 1, 'uae_flag_day.png', 'uae_flag_day.png', 'image/png', 0, 'assets/images/blog/uae_flag_day.png', 800, 500, 'UAE Flag Day', NULL, '2025-03-27 11:49:20'),
(85, 1, 'uae_flag_raising.jpg', 'uae_flag_raising.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/uae_flag_raising.jpg', 800, 500, 'UAE Flag Raising', NULL, '2025-03-27 11:49:20'),
(86, 1, 'uae_flag_celebrations.jpg', 'uae_flag_celebrations.jpg', 'image/jpeg', 0, 'assets/images/blog/Extra_Post_Images/uae_flag_celebrations.jpg', 800, 500, 'UAE Flag Celebrations', NULL, '2025-03-27 11:49:20'),
(87, 1, 'Fatemeh.jpg', 'Fatemeh.jpg', 'image/jpeg', 0, 'assets/images/avatar/Fatemeh.jpg', 300, 300, 'Dr. Somayeh Sadr Lahijani', NULL, '2025-03-27 11:49:20'),
(88, 1, 'Dashtban.jpg', 'Dashtban.jpg', 'image/jpeg', 0, 'assets/images/avatar/Dashtban.jpg', 300, 300, 'Engineer Ali Dashtban', NULL, '2025-03-27 11:49:20'),
(89, 1, 'Somayeh.png', 'Somayeh.png', 'image/png', 0, 'assets/images/avatar/Somayeh.png', 300, 300, 'Fatemeh Sedighi', NULL, '2025-03-27 11:49:20'),
(90, 1, '67d32b341ae6d_1741892404.jpg', '67d32b341ae6d_1741892404.jpg', 'image/jpeg', 0, 'assets/images/profile_photos/67d32b341ae6d_1741892404.jpg', 200, 200, 'Quemby Jefferson - Profile Photo', NULL, '2025-03-27 11:49:20'),
(91, 1, '67d3322a15705_1741894186.jpg', '67d3322a15705_1741894186.jpg', 'image/jpeg', 0, 'assets/images/profile_photos/67d3322a15705_1741894186.jpg', 200, 200, 'Sydney Patton - Profile Photo', NULL, '2025-03-27 11:49:20'),
(92, 1, '67d336f0ee448_1741895408.jpg', '67d336f0ee448_1741895408.jpg', 'image/jpeg', 0, 'assets/images/profile_photos/67d336f0ee448_1741895408.jpg', 200, 200, 'Adrienne Harding - Profile Photo', NULL, '2025-03-27 11:49:20'),
(93, 1, '67d32b341b74d_1741892404.jpg', '67d32b341b74d_1741892404.jpg', 'image/jpeg', 0, 'assets/images/documents/67d32b341b74d_1741892404.jpg', NULL, NULL, 'Quemby Jefferson - Emirates ID', NULL, '2025-03-27 11:49:20'),
(94, 1, '67d32b341c32e_1741892404.png', '67d32b341c32e_1741892404.png', 'image/png', 0, 'assets/images/documents/67d32b341c32e_1741892404.png', NULL, NULL, 'Quemby Jefferson - Passport', NULL, '2025-03-27 11:49:20'),
(95, 1, '67d32b341c7df_1741892404.jpg', '67d32b341c7df_1741892404.jpg', 'image/jpeg', 0, 'assets/images/documents/67d32b341c7df_1741892404.jpg', NULL, NULL, 'Quemby Jefferson - Academic Certificate', NULL, '2025-03-27 11:49:20'),
(96, 1, 'logo.png', 'logo.png', 'image/png', 0, 'assets/images/logo.png', 200, 100, 'Salman School Logo', NULL, '2025-03-27 11:49:20'),
(97, 1, 'favicon-32x32.png', 'favicon-32x32.png', 'image/png', 0, 'assets/images/favicons/favicon-32x32.png', 32, 32, 'Favicon', NULL, '2025-03-27 11:49:20'),
(99, 1, '67ed43acbac53_1743602604.png', 'دایی صطفی (2) 1.png', 'image/png', 326327, 'uploads/profile_photos/67ed43acbac53_1743602604.png', NULL, NULL, NULL, NULL, '2025-04-02 14:03:24'),
(101, 1, '67ed454ec26ad_1743603022.jpg', 'photo_4_2024-10-27_22-00-12_ins.jpg', 'image/jpeg', 23384, 'uploads/profile_photos/67ed454ec26ad_1743603022.jpg', NULL, NULL, NULL, NULL, '2025-04-02 14:10:22'),
(102, 1, '67ed4553c2c4c_1743603027.jpg', 'photo_4_2024-10-27_22-00-12_ins.jpg', 'image/jpeg', 23384, 'uploads/profile_photos/67ed4553c2c4c_1743603027.jpg', NULL, NULL, NULL, NULL, '2025-04-02 14:10:27');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `language_id` varchar(5) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `parent_id`, `title`, `url`, `order`, `language_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Home', 'index.php', 1, 'en', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(2, NULL, 'About', 'about.php', 2, 'en', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(3, NULL, 'Pages', '#', 3, 'en', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(4, NULL, 'News', 'blog.php', 4, 'en', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(5, NULL, 'Contact', 'contact.php', 5, 'en', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(6, 3, 'Staff', 'staff.php', 1, 'en', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(7, 3, 'Curriculum', 'Curriculum.php', 2, 'en', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(8, 3, 'Facilities', 'Facilities.php', 3, 'en', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(9, 3, 'FAQs', 'faq.php', 4, 'en', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(10, 7, 'Ehsan Section', 'Curriculum.php#ehsan-section', 1, 'en', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(11, 7, 'Primary School', 'Curriculum.php#primary-school', 2, 'en', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(12, 7, 'Middle School', 'Curriculum.php#middle-school', 3, 'en', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(13, 7, 'High School', 'Curriculum.php#high-school', 4, 'en', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(15, NULL, 'درباره ما', 'about.php', 1, 'fa', 1, '2025-03-29 11:49:06', '2025-03-30 10:29:16'),
(16, NULL, 'صفحات', '#', 2, 'fa', 1, '2025-03-29 11:49:06', '2025-03-30 10:28:58'),
(17, NULL, 'اخبار', 'blog.php', 3, 'fa', 1, '2025-03-29 11:49:06', '2025-03-30 10:28:58'),
(18, NULL, 'تماس با ما', 'contact.php', 4, 'fa', 1, '2025-03-29 11:49:06', '2025-03-30 10:28:58'),
(19, 16, 'کارکنان', 'staff.php', 0, 'fa', 1, '2025-03-29 11:49:06', '2025-03-30 10:28:58'),
(20, 16, 'برنامه درسی', 'Curriculum.php', 1, 'fa', 1, '2025-03-29 11:49:06', '2025-03-30 10:28:58'),
(21, 16, 'امکانات', 'Facilities.php', 2, 'fa', 1, '2025-03-29 11:49:06', '2025-03-30 10:28:58'),
(22, 16, 'سوالات متداول', 'faq.php', 3, 'fa', 1, '2025-03-29 11:49:06', '2025-03-30 10:28:58'),
(23, 20, 'بخش احسان', 'Curriculum.php#ehsan-section', 0, 'fa', 1, '2025-03-29 11:49:06', '2025-03-30 10:28:58'),
(24, 20, 'دوره ابتدایی', 'Curriculum.php#primary-school', 1, 'fa', 1, '2025-03-29 11:49:06', '2025-03-30 10:28:58'),
(25, 20, 'دوره متوسطه اول', 'Curriculum.php#middle-school', 2, 'fa', 1, '2025-03-29 11:49:06', '2025-03-30 10:28:58'),
(26, 20, 'دوره متوسطه دوم', 'Curriculum.php#high-school', 3, 'fa', 1, '2025-03-29 11:49:06', '2025-03-30 10:28:58'),
(27, NULL, 'الرئيسية', 'index.php', 1, 'ar', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(28, NULL, 'من نحن', 'about.php', 2, 'ar', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(29, NULL, 'الصفحات', '#', 3, 'ar', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(30, NULL, 'الأخبار', 'blog.php', 4, 'ar', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(31, NULL, 'اتصل بنا', 'contact.php', 5, 'ar', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(32, 29, 'الموظفين', 'staff.php', 1, 'ar', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(33, 29, 'المنهج الدراسي', 'Curriculum.php', 2, 'ar', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(34, 29, 'المرافق', 'Facilities.php', 3, 'ar', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(35, 29, 'الأسئلة الشائعة', 'faq.php', 4, 'ar', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(36, 33, 'قسم إحسان', 'Curriculum.php#ehsan-section', 1, 'ar', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(37, 33, 'المدرسة الابتدائية', 'Curriculum.php#primary-school', 2, 'ar', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(38, 33, 'المدرسة المتوسطة', 'Curriculum.php#middle-school', 3, 'ar', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(39, 33, 'المدرسة الثانوية', 'Curriculum.php#high-school', 4, 'ar', 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(41, NULL, 'صفحه اصلی ', 'index.php', 0, 'fa', 1, '2025-03-29 11:50:34', '2025-03-30 10:29:16');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscribers`
--

CREATE TABLE `newsletter_subscribers` (
  `subscriber_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subscribed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('active','unsubscribed') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newsletter_subscribers`
--

INSERT INTO `newsletter_subscribers` (`subscriber_id`, `email`, `subscribed_at`, `status`) VALUES
(1, 'student1@example.com', '2025-03-27 12:26:14', 'active'),
(2, 'parent2@example.com', '2025-03-27 12:26:14', 'unsubscribed'),
(3, 'elyasmalaeka@gmail.com', '2025-03-29 13:08:04', 'active'),
(4, 'molinyd@mailinator.com', '2025-03-29 13:08:20', 'active'),
(5, 'elyasmlaeka@gmail.com', '2025-03-29 13:08:34', 'active'),
(6, 'elyasmlasseka@gmail.com', '2025-03-29 13:17:11', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text DEFAULT NULL,
  `type` enum('system','submission','message','warning','info','danger') DEFAULT 'info',
  `is_read` tinyint(1) DEFAULT 0,
  `target_role_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `parent_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `relation` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`parent_id`, `first_name`, `last_name`, `phone`, `email`, `relation`) VALUES
(1, 'Joy', 'Gentry', '+1 (956) 471-6172', 'suhutirix@mailinator.com', 'father'),
(2, 'Craig', 'Hunt', '+1 (784) 594-3095', 'vyrafiv@mailinator.com', 'father'),
(3, 'Josiah', 'Blackwell', '+1 (864) 521-8629', 'byxa@mailinator.com', 'father'),
(4, 'Alvin', 'Glover', '+1 (536) 194-8594', 'sosato@mailinator.com', 'mother'),
(5, 'Kylie', 'Lamb', '+1 (136) 374-4215', 'melyxo@mailinator.com', 'mother'),
(6, 'Rinah', 'Hayden', '+1 (202) 784-4414', 'sivujalyk@mailinator.com', 'mother'),
(7, 'Lois', 'Burnett', '+1 (198) 345-7859', 'soma@mailinator.com', 'father'),
(8, 'Amity', 'Whitney', '+1 (717) 632-6531', 'xexa@mailinator.com', 'mother'),
(9, 'Lois', 'Burnett', '+1 (198) 345-7859', 'soma@mailinator.com', 'father'),
(10, 'Myles', 'Bennett', '+1 (101) 604-3719', 'bemo@mailinator.com', 'mother'),
(11, 'Lois', 'Burnett', '+1 (198) 345-7859', 'soma@mailinator.com', 'father'),
(12, 'Myles', 'Bennett', '+1 (101) 604-3719', 'bemo@mailinator.com', 'mother'),
(13, 'Aretha', 'Evans', '+1 (814) 296-5029', 'byre@mailinator.com', 'father'),
(14, 'Igor', 'Forbes', '+1 (677) 499-5794', 'pepi@mailinator.com', 'mother'),
(15, 'Dorian', 'Johnson', '+1 (922) 826-5326', 'muhul@mailinator.com', 'father'),
(16, 'Kieran', 'Potts', '+1 (431) 744-5195', 'taheb@mailinator.com', 'mother'),
(17, 'Carter', 'Nixon', '+1 (368) 799-9411', 'wuvi@mailinator.com', 'father'),
(18, 'Phyllis', 'Rogers', '+1 (158) 919-5209', 'qoxuvinul@mailinator.com', 'mother'),
(19, 'Hamilton', 'Levine', '+1 (266) 958-7956', 'tajidoweq@mailinator.com', 'father'),
(20, 'Quintessa', 'Greene', '+1 (563) 539-9571', 'xymiri@mailinator.com', 'mother'),
(21, 'George', 'Nixon', '+1 (109) 845-2827', 'hofujerubu@mailinator.com', 'father'),
(22, 'Norman', 'Blankenship', '+1 (292) 926-4289', 'fyjywelonu@mailinator.com', 'mother'),
(25, 'Kennedy', 'Delaney', '+1 (135) 563-2057', 'taryw@mailinator.com', 'father'),
(26, 'Ray', 'Campbell', '+1 (709) 209-9648', 'zyjojoku@mailinator.com', 'mother'),
(27, 'محمد', 'باقر طباطبایی', '+1 (333) 214-1606', 'sacaconebu@mailinator.com', 'father'),
(28, 'سیده', 'فاطمه خجسته', '+1 (848) 794-1897', 'sezusuxim@mailinator.com', 'mother'),
(29, 'Bradley', 'Kirk', '+1 (485) 568-5416', 'xyky@mailinator.com', 'father'),
(30, 'Louis', 'Henry', '+1 (337) 683-8226', 'nanugi@mailinator.com', 'mother'),
(31, 'Nichole', 'Murray', '+1 (843) 917-4647', 'tinopi@mailinator.com', 'father'),
(32, 'Eve', 'Kline', '+1 (455) 994-5347', 'sevyv@mailinator.com', 'mother');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `permission_id` int(11) NOT NULL,
  `permission_name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`permission_id`, `permission_name`, `description`) VALUES
(1, 'manage_posts', 'دسترسی به ایجاد، ویرایش و حذف پست‌ها'),
(2, 'manage_students', 'مدیریت اطلاعات دانش‌آموزان');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `main_media_id` int(11) DEFAULT NULL,
  `status` enum('draft','published','archived') DEFAULT 'draft',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `published_at` datetime DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `likes` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `category_id`, `author_id`, `main_media_id`, `status`, `created_at`, `updated_at`, `published_at`, `views`, `likes`) VALUES
(1, 3, 1, 30, 'published', '2024-05-19 04:59:20', '2025-03-30 12:22:27', '2024-05-19 08:59:20', 27, 0),
(2, 3, 1, 33, 'published', '2024-06-02 20:00:00', '2025-04-02 05:53:30', '2024-06-03 00:00:00', 99, 0),
(3, 1, 1, 36, 'published', '2024-03-19 20:00:00', '2025-03-31 11:21:31', '2024-03-20 00:00:00', 1, 0),
(4, 3, 1, 39, 'published', '2024-02-10 20:00:00', '2024-02-10 20:00:00', '2024-02-11 00:00:00', 0, 0),
(5, 1, 1, 42, 'published', '2024-02-01 05:00:00', '2024-02-01 05:00:00', '2024-02-01 09:00:00', 0, 0),
(6, 1, 1, 45, 'published', '2024-02-01 20:00:00', '2024-02-01 20:00:00', '2024-02-02 00:00:00', 0, 0),
(7, 1, 1, 48, 'published', '2023-07-27 08:00:00', '2023-07-27 08:00:00', '2023-07-27 12:00:00', 0, 0),
(8, 1, 1, 51, 'published', '2023-06-27 20:00:00', '2023-06-27 20:00:00', '2023-06-28 00:00:00', 0, 0),
(9, 1, 1, 52, 'published', '2024-05-01 06:00:00', '2024-05-01 06:00:00', '2024-05-01 10:00:00', 0, 0),
(10, 1, 1, 55, 'published', '2023-12-31 20:00:00', '2023-12-31 20:00:00', '2024-01-01 00:00:00', 0, 0),
(11, 1, 1, 58, 'published', '2023-03-05 18:24:12', '2023-03-05 18:24:12', '2023-03-05 22:24:12', 0, 0),
(12, 1, 1, 61, 'published', '2023-12-01 20:00:00', '2023-12-01 20:00:00', '2023-12-02 00:00:00', 0, 0),
(13, 1, 1, 64, 'published', '2023-09-20 20:00:00', '2023-09-20 20:00:00', '2023-09-21 00:00:00', 0, 0),
(14, 1, 1, 67, 'published', '2023-06-05 18:26:51', '2023-06-05 18:26:51', '2023-06-05 22:26:51', 0, 0),
(15, 1, 1, 70, 'published', '2024-04-01 04:59:20', '2025-04-01 21:12:51', '2024-04-01 08:59:20', 2, 0),
(16, 1, 1, 84, 'published', '2023-11-03 06:00:00', '2023-11-03 06:00:00', '2023-11-03 10:00:00', 0, 0),
(17, 3, 1, 73, 'published', '2024-05-26 20:00:00', '2024-05-26 20:00:00', '2024-05-27 00:00:00', 0, 0),
(18, 1, 1, 74, 'published', '2020-05-27 20:00:00', '2020-05-27 20:00:00', '2020-05-28 00:00:00', 0, 0),
(19, 3, 1, 81, 'published', '2020-05-24 20:00:00', '2020-05-24 20:00:00', '2020-05-25 00:00:00', 0, 0),
(20, 2, 1, 75, 'published', '2023-01-24 20:00:00', '2023-01-24 20:00:00', '2023-01-25 00:00:00', 0, 0),
(21, 2, 1, 77, 'published', '2022-02-13 20:00:00', '2022-02-13 20:00:00', '2022-02-14 00:00:00', 0, 0),
(22, 5, 1, 78, 'published', '2023-01-30 20:00:00', '2023-01-30 20:00:00', '2023-01-31 00:00:00', 0, 0),
(23, 4, 1, 79, 'published', '2022-02-11 20:00:00', '2022-02-11 20:00:00', '2022-02-12 00:00:00', 0, 0),
(24, 3, 1, 80, 'published', '2021-12-07 20:00:00', '2021-12-07 20:00:00', '2021-12-08 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `post_content`
--

CREATE TABLE `post_content` (
  `id` int(11) NOT NULL,
  `field_key` varchar(255) NOT NULL COMMENT 'کلید شناسایی محتوا',
  `content` text DEFAULT NULL COMMENT 'محتوای اصلی',
  `language_id` varchar(5) NOT NULL COMMENT 'کد زبان (fa, en, ar)',
  `is_repeatable` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'آیا این محتوا تکرارشونده است؟',
  `section_id` varchar(50) DEFAULT NULL COMMENT 'شناسه بخش برای گروه‌بندی',
  `sort_order` int(11) NOT NULL DEFAULT 0 COMMENT 'ترتیب نمایش آیتم‌های تکرارشونده',
  `is_visible` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'آیا این محتوا نمایش داده می‌شود؟',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_content`
--

INSERT INTO `post_content` (`id`, `field_key`, `content`, `language_id`, `is_repeatable`, `section_id`, `sort_order`, `is_visible`, `created_at`, `updated_at`) VALUES
(1, 'related_posts_title', 'مطالب مرتبط', 'fa', 0, 'related', 1, 1, '2025-03-30 13:49:48', '2025-03-30 14:52:34'),
(2, 'comments_title', 'نظرات', 'fa', 0, 'comments', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(3, 'author_info_title', 'درباره نویسنده', 'fa', 0, 'author', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(4, 'tags_title', 'برچسب‌ها', 'fa', 0, 'tags', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(5, 'share_title', 'اشتراک‌گذاری', 'fa', 0, 'share', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(6, 'previous_post', 'مطلب قبلی', 'fa', 0, 'navigation', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(7, 'next_post', 'مطلب بعدی', 'fa', 0, 'navigation', 2, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(8, 'post_date_text', 'تاریخ انتشار:', 'fa', 0, 'meta', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(9, 'post_views_text', 'بازدید:', 'fa', 0, 'meta', 2, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(10, 'post_category_text', 'دسته‌بندی:', 'fa', 0, 'meta', 3, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(11, 'read_more', 'ادامه مطلب', 'fa', 0, 'buttons', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(12, 'search_here', 'جستجو', 'fa', 0, 'search', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(13, 'search_button', 'جستجو', 'fa', 0, 'search', 2, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(14, 'back_to_blog', 'بازگشت به وبلاگ', 'fa', 0, 'buttons', 2, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(15, 'min_read', 'دقیقه مطالعه', 'fa', 0, 'reading', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(16, 'latest_posts', 'آخرین مطالب', 'fa', 0, 'sidebar', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(17, 'categories', 'دسته‌بندی‌ها', 'fa', 0, 'sidebar', 2, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(18, 'popular_articles', 'مطالب محبوب', 'fa', 0, 'sidebar', 3, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(19, 'views', 'بازدید', 'fa', 0, 'meta', 4, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(20, 'home', 'صفحه اصلی', 'fa', 0, 'breadcrumb', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(21, 'blog_title', 'وبلاگ', 'fa', 0, 'breadcrumb', 2, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(22, 'related_posts_title', 'Related Posts', 'en', 0, 'related', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(23, 'comments_title', 'Comments', 'en', 0, 'comments', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(24, 'author_info_title', 'About The Author', 'en', 0, 'author', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(25, 'tags_title', 'Tags', 'en', 0, 'tags', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(26, 'share_title', 'Share', 'en', 0, 'share', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(27, 'previous_post', 'Previous Post', 'en', 0, 'navigation', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(28, 'next_post', 'Next Post', 'en', 0, 'navigation', 2, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(29, 'post_date_text', 'Published on:', 'en', 0, 'meta', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(30, 'post_views_text', 'Views:', 'en', 0, 'meta', 2, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(31, 'post_category_text', 'Category:', 'en', 0, 'meta', 3, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(32, 'read_more', 'Read More', 'en', 0, 'buttons', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(33, 'search_here', 'Search Here', 'en', 0, 'search', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(34, 'search_button', 'Search', 'en', 0, 'search', 2, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(35, 'back_to_blog', 'Back to Blog', 'en', 0, 'buttons', 2, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(36, 'min_read', 'min read', 'en', 0, 'reading', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(37, 'latest_posts', 'Latest Posts', 'en', 0, 'sidebar', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(38, 'categories', 'Categories', 'en', 0, 'sidebar', 2, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(39, 'popular_articles', 'Popular Articles', 'en', 0, 'sidebar', 3, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(40, 'views', 'views', 'en', 0, 'meta', 4, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(41, 'home', 'Home', 'en', 0, 'breadcrumb', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(42, 'blog_title', 'Blog', 'en', 0, 'breadcrumb', 2, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(43, 'related_posts_title', 'المنشورات ذات الصلة', 'ar', 0, 'related', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(44, 'comments_title', 'التعليقات', 'ar', 0, 'comments', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(45, 'author_info_title', 'عن الكاتب', 'ar', 0, 'author', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(46, 'tags_title', 'الوسوم', 'ar', 0, 'tags', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(47, 'share_title', 'مشاركة', 'ar', 0, 'share', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(48, 'previous_post', 'المنشور السابق', 'ar', 0, 'navigation', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(49, 'next_post', 'المنشور التالي', 'ar', 0, 'navigation', 2, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(50, 'post_date_text', 'تاريخ النشر:', 'ar', 0, 'meta', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(51, 'post_views_text', 'المشاهدات:', 'ar', 0, 'meta', 2, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(52, 'post_category_text', 'التصنيف:', 'ar', 0, 'meta', 3, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(53, 'read_more', 'اقرأ المزيد', 'ar', 0, 'buttons', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(54, 'search_here', 'ابحث هنا', 'ar', 0, 'search', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(55, 'search_button', 'بحث', 'ar', 0, 'search', 2, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(56, 'back_to_blog', 'العودة إلى المدونة', 'ar', 0, 'buttons', 2, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(57, 'min_read', 'دقيقة للقراءة', 'ar', 0, 'reading', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(58, 'latest_posts', 'أحدث المقالات', 'ar', 0, 'sidebar', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(59, 'categories', 'التصنيفات', 'ar', 0, 'sidebar', 2, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(60, 'popular_articles', 'المقالات الشائعة', 'ar', 0, 'sidebar', 3, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(61, 'views', 'مشاهدات', 'ar', 0, 'meta', 4, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(62, 'home', 'الرئيسية', 'ar', 0, 'breadcrumb', 1, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48'),
(63, 'blog_title', 'المدونة', 'ar', 0, 'breadcrumb', 2, 1, '2025-03-30 13:49:48', '2025-03-30 13:49:48');

-- --------------------------------------------------------

--
-- Table structure for table `post_translations`
--

CREATE TABLE `post_translations` (
  `post_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `excerpt` text DEFAULT NULL,
  `status` enum('pending','published') DEFAULT 'pending',
  `translated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_translations`
--

INSERT INTO `post_translations` (`post_id`, `language_id`, `title`, `content`, `excerpt`, `status`, `translated_at`) VALUES
(1, 1, 'خادمین ملت در سفر آسمانی: جزئیات شهادت آیت الله رئیسی و همراهان', '<p>با نهایت تأسف و اندوه عمیق، مجتمع آموزشی سلمان به شهادت آیت الله سید ابراهیم رئیسی، هشتمین رئیس جمهور ایران و همراهان انقلابی ایشان، که در پی سانحه هوایی در منطقه ورزقان استان آذربایجان شرقی، به دیار باقی رفتند، تسلیت و همدردی عمیق خود را اعلام می‌دارد.</p>\n<p>رئیسی، شخصیتی که با ایده‌آل‌های انقلابی و ارزش‌های اسلامی، هدایت و رهبری کشور را به عهده داشت، در این سانحه تلخ و بی‌درنگ از میان ما رفت. وی با پایبندی به انقلاب و خدمت به ملت ایران، به عنوان یک رهبر مجاهد و پرتلاش، زندگی خود را پر کرده بود.</p>\n<div class=\"post-images\">\n  <img src=\"assets/images/blog/Extra_Post_Images/AyatollahRaisi1.jpg\" alt=\"آیت الله رئیسی\" class=\"img-fluid\">\n  <img src=\"assets/images/blog/Extra_Post_Images/AyatollahRaisi2.jpg\" alt=\"آیت الله رئیسی و همراهان\" class=\"img-fluid\">\n</div>\n<p>شهادت آیت الله رئیسی و همراهانش برای ما عمیقاً دل‌شکسته کننده است، اما این درسی است که ما را به پایبندی بیشتر به ارزش‌ها و اهداف انقلاب دعوت می‌کند.</p>', NULL, 'published', '2024-05-19 08:59:20'),
(1, 2, 'Servants of the Nation on a Heavenly Journey: Details of the Martyrdom of Ayatollah Raisi and Companions', '<p>With utmost sorrow and profound grief, the Salman Educational Complex announces its deepest condolences and sympathy for the martyrdom of Ayatollah Seyyed Ebrahim Raisi, the eighth President of Iran, and his revolutionary companions, who departed to the eternal abode following an air accident in the Varzaqan region of East Azerbaijan Province.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/AyatollahRaisi1.jpg\" alt=\"Ayatollah Raisi\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/AyatollahRaisi2.jpg\" alt=\"Ayatollah Raisi and companions\" class=\"img-fluid\">\r\n</div>\r\n<p>The martyrdom of Ayatollah Raisi and his companions deeply saddens us. Today, we take pride in knowing them and pray to God for their forgiveness and mercy.</p>', NULL, 'published', '2024-05-19 08:59:20'),
(1, 3, 'خدام الأمة في رحلة سماوية: تفاصيل استشهاد آية الله رئيسي ورفاقه', '<p>بمنتهى الأسف والحزن العميق، يعلن مجمع سلمان التعليمي عن خالص تعازيه ومواساته لاستشهاد آية الله السيد إبراهيم رئيسي، ثامن رئيس للجمهورية الإيرانية، ورفاقه الثوريين، الذين انتقلوا إلى المثوى الأبدي إثر حادث جوي في منطقة ورزقان بمحافظة أذربيجان الشرقية.</p>\n<div class=\"post-images\">\n  <img src=\"assets/images/blog/Extra_Post_Images/AyatollahRaisi1.jpg\" alt=\"آية الله رئيسي\" class=\"img-fluid\">\n  <img src=\"assets/images/blog/Extra_Post_Images/AyatollahRaisi2.jpg\" alt=\"آية الله رئيسي ورفاقه\" class=\"img-fluid\">\n</div>\n<p>لقد ارتقت الأرواح النبيلة للرئيس المجتهد ورفاقه إلى أعلى السماوات، وندعو الله تعالى بالسلام والمغفرة لهم.</p>', NULL, 'published', '2024-05-19 08:59:20'),
(2, 1, 'سالگرد رحلت امام خمینی (ره)؛ پدر انقلاب اسلامی', '<p>امروز سالگرد رحلت بنیانگذار کبیر انقلاب اسلامی و معمار نظام جمهوری اسلامی، حضرت امام خمینی (ره) است. امام خمینی با تأسیس نظام نوین اسلامی و رهبری انقلاب شکوهمند ایران، تحولی عظیم را در تاریخ معاصر جهان اسلام رقم زد و نام خود را در قلوب مستضعفان جهان جاودانه ساخت.</p>\n<p>ایشان با تکیه بر ارزش‌های اصیل اسلامی و آرمان‌های انقلاب، مسیر حرکت جامعه ایرانی را به سوی عدالت، آزادی و استقلال هدایت کردند و الگوی مقاومت و ایستادگی در برابر ظلم و استکبار را به جهانیان نشان دادند. امروز ملت ایران با گرامیداشت یاد و خاطره آن عالم ربانی و رهبر فرزانه، پیمان خود را با آرمان‌های انقلاب تجدید می‌کنند.</p>\n<div class=\"post-images\">\n  <img src=\"assets/images/blog/Extra_Post_Images/imam-khomeini1.jpg\" alt=\"امام خمینی (ره)\" class=\"img-fluid\">\n  <img src=\"assets/images/blog/Extra_Post_Images/imam-khomeini2.jpg\" alt=\"مراسم بزرگداشت امام خمینی\" class=\"img-fluid\">\n</div>\n<p>آری، راه امام خمینی (ره) همچنان روشن و پرفروغ است و ملت ایران با الهام از آرمان‌های واﻻی ایشان، به پیشرفت و ترقی در عرصه‌های مختلف ادامه خواهند داد. یاد و نام آن رهبر کبیر و شهید راه آزادی، همیشه در قلوب ما زنده و جاویدان خواهد ماند.</p>\n', NULL, 'published', '2024-06-03 00:00:00'),
(2, 2, 'Anniversary of Imam Khomeini Demise; Father of the Islamic Revolution', '<p>Today marks the anniversary of the demise of the great founder of the Islamic Revolution and the architect of the Islamic Republic system, Imam Khomeini (ra). Imam Khomeini, by establishing the new Islamic system and leading the glorious Iranian Revolution, brought about a monumental transformation in the contemporary history of the Islamic world and eternalized his name in the hearts of the oppressed around the globe.</p>\n<p>Relying on genuine Islamic values and the ideals of the revolution, he guided the Iranian society\'s path towards justice, freedom, and independence. He showcased a model of resistance and steadfastness against oppression and arrogance to the world. Today, the Iranian nation, by commemorating the memory of that divine scholar and wise leader, renews its covenant with the ideals of the revolution.</p>\n<div class=\"post-images\">\n  <img src=\"assets/images/blog/Extra_Post_Images/imam-khomeini1.jpg\" alt=\"Imam Khomeini\" class=\"img-fluid\">\n  <img src=\"assets/images/blog/Extra_Post_Images/imam-khomeini2.jpg\" alt=\"Imam Khomeini commemoration ceremony\" class=\"img-fluid\">\n</div>\n<p>Indeed, the path of Imam Khomeini (ra) remains bright and radiant, and the Iranian nation, inspired by his lofty ideals, will continue to progress and advance in various fields. The memory and name of that great leader and martyr of the path of freedom will forever live on in our hearts.</p>', NULL, 'published', '2024-06-03 00:00:00'),
(2, 3, 'ذكرى رحيل الإمام الخميني؛ أب الثورة الإسلامية', '<p>اليوم يصادف ذكرى رحيل المؤسس العظيم للثورة الإسلامية ومهندس نظام الجمهورية الإسلامية، الإمام الخميني (رض). لقد أحدث الإمام الخميني، من خلال تأسيس النظام الإسلامي الجديد وقيادة الثورة الإيرانية المجيدة، تحولاً هائلاً في التاريخ المعاصر للعالم الإسلامي وخلَّد اسمه في قلوب المستضعفين حول العالم.</p>\r\n<p>مستنداً إلى القيم الإسلامية الأصيلة ومُثُل الثورة، قاد مسار المجتمع الإيراني نحو العدالة والحرية والاستقلال. وأظهر للعالم نموذجاً للمقاومة والصمود ضد الظلم والاستكبار. اليوم، تجدد الأمة الإيرانية، من خلال إحياء ذكرى ذلك العالم الرباني والقائد الحكيم، عهدها مع مُثُل الثورة.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/imam-khomeini1.jpg\" alt=\"الإمام الخميني\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/imam-khomeini2.jpg\" alt=\"حفل إحياء ذكرى الإمام الخميني\" class=\"img-fluid\">\r\n</div>\r\n<p>حقاً، لا يزال طريق الإمام الخميني (رض) مشرقاً ومضيئاً، وستواصل الأمة الإيرانية، مستلهمة من مُثُله السامية، التقدم والرقي في مختلف المجالات. ستبقى ذكرى واسم ذلك القائد العظيم وشهيد درب الحرية حية وخالدة في قلوبنا إلى الأبد.</p>', NULL, 'published', '2024-06-03 00:00:00'),
(3, 1, 'نوروز باستانی، آغازی دوباره', '<p>فرارسیدن سال نو و آغاز بهار طبیعت، فرصتی است برای زدودن غبار غم از دل‌ها و تجدید روحیه امید و نشاط در کالبد جامعه. ایران باستان، ایران اسلامی و ایران معاصر، همگی شاهد جشن‌های رنگارنگ نوروزی بوده‌اند؛ جشنی که ریشه در فرهنگ غنی این سرزمین کهن دارد.</p>\r\n<p>نوروز، تجلی بازگشت حیات و سرسبزی به طبیعت است. این جشن کهن، نمادی از دوام، پایداری و ظرفیت بازآفرینی در وجود انسان و طبیعت است. آری، نوروز یادآور این حقیقت است که پس از هر سرمایی، بهاری خواهد آمد و زندگی را دوباره سرشار از امید و نشاط خواهد کرد.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/nowruz1.jpg\" alt=\"سفره هفت سین\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/nowruz2.jpg\" alt=\"جشن نوروز\" class=\"img-fluid\">\r\n</div>\r\n<p>مجتمع آموزشی سلمان، ضمن گرامیداشت این جشن باستانی و آرزوی سالی سرشار از موفقیت و پیروزی برای ملت شریف ایران، از همه هموطنان عزیز دعوت می‌کند تا با الهام از پیام نوروز، افق‌های جدیدی را در زندگی فردی و اجتماعی خود بگشایند و در مسیر کمال و ترقی گام بردارند.</p>', NULL, 'published', '2024-03-20 00:00:00'),
(3, 2, 'Ancient Nowruz, A New Beginning', '<p>The arrival of the new year and the beginning of spring is an opportunity to wipe away the dust of sorrow from our hearts and renew the spirit of hope and joy in the fabric of society. Ancient Iran, Islamic Iran, and contemporary Iran have all witnessed the colorful celebrations of Nowruz - a festivity rooted in the rich culture of this ancient land.</p>\r\n<p>Nowruz is the manifestation of life return and the revival of greenery in nature. This ancient celebration symbolizes endurance, resilience, and the capacity for rebirth within humans and nature. Indeed, Nowruz reminds us of the truth that after every winter, a spring will come, and life will be filled with hope and joy once again.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/nowruz1.jpg\" alt=\"Haft-sin table\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/nowruz2.jpg\" alt=\"Nowruz celebration\" class=\"img-fluid\">\r\n</div>\r\n<p>The Salman Educational Complex, while honoring this ancient celebration and wishing a year filled with success and victory for the noble Iranian nation, invites all dear compatriots to be inspired by the message of Nowruz, open new horizons in their personal and social lives, and take steps towards perfection and progress.</p>', NULL, 'published', '2024-03-20 00:00:00'),
(3, 3, 'النوروز القديم، بداية جديدة', '<p>إن قدوم العام الجديد وبداية الربيع فرصة لمسح غبار الحزن من قلوبنا وتجديد روح الأمل والفرح في نسيج المجتمع. لقد شهدت إيران القديمة وإيران الإسلامية وإيران المعاصرة جميعها احتفالات النوروز الملونة - وهو احتفال متجذر في الثقافة الغنية لهذه الأرض القديمة.</p>\r\n<p>النوروز هو تجلي عودة الحياة وإحياء الخضرة في الطبيعة. يرمز هذا الاحتفال القديم إلى التحمل والمرونة والقدرة على إعادة الولادة داخل البشر والطبيعة. حقًا، يذكرنا النوروز بالحقيقة أنه بعد كل شتاء، سيأتي ربيع، وستمتلئ الحياة بالأمل والفرح مرة أخرى.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/nowruz1.jpg\" alt=\"مائدة هفت سين\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/nowruz2.jpg\" alt=\"احتفال النوروز\" class=\"img-fluid\">\r\n</div>\r\n<p>يدعو مجمع سلمان التعليمي، أثناء تكريمه لهذا الاحتفال القديم وتمنياته بعام مليء بالنجاح والنصر للأمة الإيرانية النبيلة، جميع المواطنين الأعزاء للاستلهام من رسالة النوروز، وفتح آفاق جديدة في حياتهم الشخصية والاجتماعية، واتخاذ خطوات نحو الكمال والتقدم.</p>', NULL, 'published', '2024-03-20 00:00:00'),
(4, 1, 'چهل و پنجمین سالگرد پیروزی انقلاب اسلامی', '<p>در چهل و پنجمین بهار آزادی، یاد و خاطره رهبر کبیر انقلاب اسلامی، حضرت امام خمینی (ره) و شهدای گرانقدر را گرامی می‌داریم. 22 بهمن 1357، نقطه عطفی در تاریخ معاصر ایران بود که با پیروزی انقلاب اسلامی، ملت ایران توانست از یوغ استبداد و استعمار رهایی یابد.</p>\r\n<p>انقلاب اسلامی ایران با الهام از آموزه‌های اسلام ناب محمدی (ص)، افق‌های تازه‌ای را برای استقلال، آزادی و عدالت اجتماعی در برابر ملت ایران گشود. این انقلاب الهام‌بخش ملت‌های مسلمان و مستضعفان جهان شد تا در مقابل ظلم و استکبار ایستادگی کنند.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/revolution1.jpg\" alt=\"انقلاب اسلامی ایران\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/revolution2.jpg\" alt=\"پیروزی انقلاب اسلامی\" class=\"img-fluid\">\r\n</div>\r\n<p>امروز، ملت ایران با افتخار در مسیر انقلاب اسلامی گام برمی‌دارد و برای تحقق آرمان‌های والای آن تلاش می‌کند. پیروزی انقلاب اسلامی، نوید بخش آینده‌ای روشن برای ایران عزیز و کل جهان اسلام است. ما ضمن گرامیداشت یاد شهدا، پایبندی خود را به ارزش‌های انقلاب اسلامی تجدید می‌کنیم.</p>', NULL, 'published', '2024-02-11 00:00:00'),
(4, 2, '45th Anniversary of the Islamic Revolution\'s Victory', '<p>On the 45th spring of freedom, we honor the memory of the great leader of the Islamic Revolution, Imam Khomeini (ra), and the esteemed martyrs. The 22nd of Bahman, 1357 (February 11, 1979) was a turning point in contemporary Iranian history when the victory of the Islamic Revolution liberated the Iranian nation from the yoke of despotism and colonialism.</p>\r\n<p>The Iranian Islamic Revolution, inspired by the pure teachings of Islam brought by Prophet Muhammad (pbuh), opened new horizons for independence, freedom, and social justice for the Iranian people. This revolution inspired Muslim nations and the oppressed around the world to stand up against oppression and arrogance.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/revolution1.jpg\" alt=\"Iran\'s Islamic Revolution\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/revolution2.jpg\" alt=\"Victory of the Islamic Revolution\" class=\"img-fluid\">\r\n</div>\r\n<p>Today, the Iranian nation proudly treads the path of the Islamic Revolution and strives to realize its lofty ideals. The victory of the Islamic Revolution heralds a bright future for dear Iran and the entire Islamic world. As we honor the memory of the martyrs, we renew our commitment to the values of the Islamic Revolution.</p>', NULL, 'published', '2024-02-11 00:00:00'),
(4, 3, 'الذكرى الخامسة والأربعون لانتصار الثورة الإسلامية', '<p>في الربيع الخامس والأربعين للحرية، نُكرم ذكرى القائد العظيم للثورة الإسلامية، الإمام الخميني (رض)، والشهداء المبجلين. كان الثاني والعشرون من بهمن 1357 (11 فبراير 1979) نقطة تحول في التاريخ الإيراني المعاصر حيث حرر انتصار الثورة الإسلامية الأمة الإيرانية من نير الاستبداد والاستعمار.</p>\r\n<p>فتحت الثورة الإسلامية الإيرانية، المستوحاة من التعاليم النقية للإسلام التي جاء بها النبي محمد (ص)، آفاقاً جديدة للاستقلال والحرية والعدالة الاجتماعية للشعب الإيراني. ألهمت هذه الثورة الأمم الإسلامية والمستضعفين حول العالم للوقوف ضد الظلم والاستكبار.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/revolution1.jpg\" alt=\"الثورة الإسلامية الإيرانية\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/revolution2.jpg\" alt=\"انتصار الثورة الإسلامية\" class=\"img-fluid\">\r\n</div>\r\n<p>اليوم، تسير الأمة الإيرانية بفخر في طريق الثورة الإسلامية وتسعى لتحقيق مُثلها السامية. يُبشر انتصار الثورة الإسلامية بمستقبل مشرق لإيران العزيزة والعالم الإسلامي بأكمله. ونحن إذ نُكرم ذكرى الشهداء، نجدد التزامنا بقيم الثورة الإسلامية.</p>', NULL, 'published', '2024-02-11 00:00:00'),
(5, 1, 'دهه فجر انقلاب اسلامی، نماد مقاومت و پایداری', '<p>دهه فجر انقلاب اسلامی، یادآور روزهای پرافتخار و حماسه‌آفرین ملت ایران در پیروزی بر رژیم ستمشاهی پهلوی و استقرار نظام مقدس جمهوری اسلامی است. این دهه فرخنده، نمادی از اراده آهنین و ایستادگی ملت در برابر ظلم و استکبار جهانی است.</p>\r\n<p>در دهه فجر، ایرانیان از هر قوم و قبیله، متحد و یکصدا برای رهایی از چنگال استبداد و استعمار به پا خاستند و با رهبری امام خمینی (ره)، انقلابی شکوهمند را رقم زدند که جهان را متحیر ساخت. این انقلاب الهام‌بخش ملت‌های مسلمان و مستضعفان جهان شد تا در مقابل ظلم و استکبار بایستند.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/fajr-decade1.jpg\" alt=\"مراسم دهه فجر\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/fajr-decade2.jpg\" alt=\"جشن‌های دهه فجر\" class=\"img-fluid\">\r\n</div>\r\n<p>امروز، ملت ایران با افتخار در مسیر انقلاب اسلامی گام برمی‌دارد و برای تحقق آرمان‌های والای آن تلاش می‌کند. دهه فجر، یادآور این حقیقت است که هیچ قدرتی نمی‌تواند در برابر اراده ملتی آزاده و مؤمن ایستادگی کند. ما با گرامیداشت یاد شهدا و رهنمودهای امام راحل، پیمان خود را با آرمان‌های انقلاب اسلامی تجدید می‌کنیم.</p>', NULL, 'published', '2024-02-01 09:00:00'),
(5, 2, 'Decade of Revelation of the Islamic Revolution, Symbol of Resistance and Perseverance', '<p>The Decade of Revelation of the Islamic Revolution reminds us of the glorious and epic days when the Iranian nation triumphed over the oppressive Pahlavi monarchy and established the sacred system of the Islamic Republic. This auspicious decade symbolizes the iron will and steadfastness of the nation against global oppression and arrogance.</p>\r\n<p>During the Decade of Revelation, Iranians of all ethnicities and tribes united and rose in unison to liberate themselves from the clutches of despotism and colonialism, and under the leadership of Imam Khomeini (ra), they brought about a magnificent revolution that astonished the world. This revolution inspired Muslim nations and the oppressed around the globe to stand up against oppression and arrogance.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/fajr-decade1.jpg\" alt=\"Fajr Decade ceremony\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/fajr-decade2.jpg\" alt=\"Fajr Decade celebrations\" class=\"img-fluid\">\r\n</div>\r\n<p>Today, the Iranian nation proudly treads the path of the Islamic Revolution and strives to realize its lofty ideals. The Decade of Revelation reminds us of the truth that no power can withstand the will of a free and faithful nation. By honoring the memory of the martyrs and the guidance of the late Imam, we renew our covenant with the ideals of the Islamic Revolution.</p>', NULL, 'published', '2024-02-01 09:00:00'),
(5, 3, 'عشرة أيام فجر الثورة الإسلامية، رمز المقاومة والصمود', '<p>تذكرنا عشرة أيام فجر الثورة الإسلامية بالأيام المجيدة والملحمية عندما انتصرت الأمة الإيرانية على النظام الملكي البهلوي الظالم وأسست النظام المقدس للجمهورية الإسلامية. ترمز هذه الأيام المباركة إلى الإرادة الحديدية وصمود الأمة ضد الظلم والاستكبار العالمي.</p>\r\n<p>خلال عشرة أيام الفجر، توحد الإيرانيون من جميع الأعراق والقبائل وقاموا بصوت واحد لتحرير أنفسهم من قبضة الاستبداد والاستعمار، وتحت قيادة الإمام الخميني (رض)، أحدثوا ثورة رائعة أذهلت العالم. ألهمت هذه الثورة الأمم الإسلامية والمستضعفين حول العالم للوقوف ضد الظلم والاستكبار.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/fajr-decade1.jpg\" alt=\"احتفال عشرة أيام الفجر\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/fajr-decade2.jpg\" alt=\"احتفالات عشرة أيام الفجر\" class=\"img-fluid\">\r\n</div>\r\n<p>اليوم، تسير الأمة الإيرانية بفخر في طريق الثورة الإسلامية وتسعى لتحقيق مُثلها السامية. تذكرنا عشرة أيام الفجر بالحقيقة أنه لا توجد قوة يمكنها الصمود أمام إرادة أمة حرة ومؤمنة. من خلال تكريم ذكرى الشهداء وإرشادات الإمام الراحل، نجدد عهدنا مع مُثُل الثورة الإسلامية.</p>', NULL, 'published', '2024-02-01 09:00:00'),
(6, 1, 'عید سعید فطر، جشن پایان ماه رمضان', '<p>عید سعید فطر، پایان ماه مبارک رمضان و جشن روزه‌داران است. این عید بزرگ اسلامی، نمادی از پیروزی انسان بر نفس اماره و گامی در مسیر تزکیه و تقرب به خداوند متعال است. در این روز پرخیر و برکت، مسلمانان جهان با دل‌هایی پاک و روح‌هایی معنوی، شادی و سرور را جشن می‌گیرند.</p>\r\n<p>عید فطر، یادآور این حقیقت است که انسان با پرهیزگاری و خویشتن‌داری می‌تواند بر نفس اماره خود غلبه کند و به کمال معنوی دست یابد. این عید، فرصتی برای بازگشت به فطرت پاک انسانی و تجدید پیمان با آموزه‌های اخلاقی و معنوی دین مبین اسلام است.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/eid-fitr1.jpg\" alt=\"نماز عید فطر\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/eid-fitr2.jpg\" alt=\"جشن عید فطر\" class=\"img-fluid\">\r\n</div>\r\n<p>مجتمع آموزشی سلمان، ضمن تبریک این عید سعید به همه مسلمانان جهان، از خداوند متعال مسئلت دارد تا توفیق خدمت به خلق را به همگان عنایت فرماید. امید است در سایه الطاف الهی، جامعه اسلامی ما بیش از پیش در مسیر کمال و سعادت حرکت کند و پیام صلح، برادری و دوستی را به جهانیان منتقل سازد.</p>', NULL, 'published', '2024-02-02 00:00:00'),
(6, 2, 'Eid al-Fitr, Celebration of the End of Ramadan', '<p>Eid al-Fitr marks the end of the blessed month of Ramadan and is the celebration of those who have fasted. This great Islamic festival symbolizes the triumph of human beings over their carnal desires and is a step towards purification and nearness to Almighty God. On this blessed and auspicious day, Muslims around the world celebrate joy and delight with pure hearts and spiritual souls.</p>\r\n<p>Eid al-Fitr reminds us of the truth that through piety and self-restraint, human beings can overcome their carnal desires and attain spiritual perfection. This festival is an opportunity to return to the pure human nature and renew our covenant with the moral and spiritual teachings of the noble religion of Islam.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/eid-fitr1.jpg\" alt=\"Eid al-Fitr prayer\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/eid-fitr2.jpg\" alt=\"Eid al-Fitr celebration\" class=\"img-fluid\">\r\n</div>\r\n<p>The Salman Educational Complex, while extending its congratulations on this blessed Eid to all Muslims around the world, prays to Almighty God to grant everyone the opportunity to serve His creation. It is hoped that under the shadow of divine blessings, our Islamic society will further advance on the path of perfection and felicity, and convey the message of peace, brotherhood, and friendship to the world.</p>', NULL, 'published', '2024-02-02 00:00:00'),
(6, 3, 'عيد الفطر، احتفال بنهاية شهر رمضان', '<p>يمثل عيد الفطر نهاية شهر رمضان المبارك وهو احتفال للصائمين. يرمز هذا العيد الإسلامي العظيم إلى انتصار الإنسان على رغباته النفسية وهو خطوة نحو التزكية والتقرب إلى الله تعالى. في هذا اليوم المبارك والميمون، يحتفل المسلمون حول العالم بالفرح والبهجة بقلوب طاهرة وأرواح روحانية.</p>\r\n<p>يذكرنا عيد الفطر بالحقيقة أنه من خلال التقوى وضبط النفس، يمكن للإنسان أن يتغلب على رغباته النفسية ويحقق الكمال الروحي. هذا العيد فرصة للعودة إلى الفطرة الإنسانية النقية وتجديد عهدنا مع التعاليم الأخلاقية والروحية للدين الإسلامي النبيل.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/eid-fitr1.jpg\" alt=\"صلاة عيد الفطر\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/eid-fitr2.jpg\" alt=\"احتفال عيد الفطر\" class=\"img-fluid\">\r\n</div>\r\n<p>يتقدم مجمع سلمان التعليمي، إذ يقدم تهانيه بهذا العيد المبارك لجميع المسلمين في العالم، بالدعاء إلى الله تعالى أن يمنح الجميع فرصة خدمة خلقه. ويؤمل أنه في ظل البركات الإلهية، سيتقدم مجتمعنا الإسلامي أكثر في طريق الكمال والسعادة، وينقل رسالة السلام والأخوة والصداقة إلى العالم.</p>', NULL, 'published', '2024-02-02 00:00:00'),
(7, 1, 'عید غدیر، تجلی جاودانه ولایت و رهبری', '<p>عید سعید غدیر خم، یادآور واقعه تاریخی و ماندگار تعیین جانشین پیامبر اکرم (صلی الله علیه و آله و سلم) در روز هجدهم ذی الحجه سال دهم هجری است. در این روز خجسته، پیامبر گرامی اسلام (ص) امیرالمؤمنین علی (علیه السلام) را به عنوان جانشین و ولی امر مسلمانان معرفی کردند.</p>\r\n<p>غدیر خم، تجلی جاودانه مفهوم ولایت و رهبری در اسلام است. این واقعه تاریخی، خط بطلانی بر تمامی باورها و اندیشه‌های ضد ولایت و امامت کشید و مسیر هدایت و سعادت بشریت را برای همیشه روشن ساخت. امروز مسلمانان جهان، عید غدیر را گرامی می‌دارند تا زنده نگه‌دارنده میراث گرانبهای ولایت و پیوند ناگسستنی خود با سلسله پاک ائمه اطهار (علیهم السلام) باشند.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/eid-ghadir1.jpg\" alt=\"جشن عید غدیر\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/eid-ghadir2.jpg\" alt=\"مراسم عید غدیر\" class=\"img-fluid\">\r\n</div>\r\n<p>مجتمع آموزشی سلمان، ضمن گرامیداشت این عید سعید، از خداوند متعال مسئلت دارد تا توفیق پیروی از منویات و رهنمودهای ائمه معصومین (علیهم السلام) را به همگان عنایت فرماید. امید است در سایه الطاف الهی و با تأسی به سیره ائمه اطهار (علیهم السلام)، جامعه اسلامی ما در مسیر کمال و سعادت گام بردارد و پیام وحدت، یکپارچگی و پایبندی به ولایت را به جهانیان منتقل سازد.</p>', NULL, 'published', '2023-07-27 12:00:00'),
(7, 2, 'Eid al-Ghadir, The Eternal Manifestation of Guardianship and Leadership', '<p>Eid al-Ghadir commemorates the historical and enduring event of the appointment of the successor to the Holy Prophet (peace be upon him and his household) on the 18th of Dhu al-Hijjah in the 10th year after Hijrah. On this auspicious day, the noble Prophet of Islam (pbuh) introduced Amir al-Mu\'minin Ali (peace be upon him) as the successor and guardian of the Muslims.</p>\r\n<p>Ghadir Khumm is the eternal manifestation of the concept of guardianship and leadership in Islam. This historical event struck a line of invalidity through all beliefs and thoughts against guardianship and Imamate, and forever illuminated the path of guidance and felicity for humanity. Today, Muslims around the world honor Eid al-Ghadir to keep alive the precious legacy of guardianship and their inseparable bond with the pure progeny of the Imams (peace be upon them).</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/eid-ghadir1.jpg\" alt=\"Eid al-Ghadir celebration\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/eid-ghadir2.jpg\" alt=\"Eid al-Ghadir ceremony\" class=\"img-fluid\">\r\n</div>\r\n<p>The Salman Educational Complex, while commemorating this blessed Eid, prays to Almighty God to grant everyone the opportunity to follow the teachings and guidance of the infallible Imams (peace be upon them). It is hoped that under the shadow of divine blessings and by following the exemplary conduct of the pure Imams (peace be upon them), our Islamic society will advance on the path of perfection and felicity, and convey the message of unity, solidarity, and adherence to guardianship to the world.</p>', NULL, 'published', '2023-07-27 12:00:00'),
(7, 3, 'عيد الغدير، التجلي الأبدي للولاية والقيادة', '<p>يُحيي عيد الغدير ذكرى الحدث التاريخي والدائم لتعيين خليفة النبي الكريم (صلى الله عليه وآله وسلم) في اليوم الثامن عشر من ذي الحجة في السنة العاشرة للهجرة. في هذا اليوم المبارك، قدم النبي الكريم (ص) أمير المؤمنين علي (عليه السلام) كخليفة وولي للمسلمين.</p>\r\n<p>غدير خم هو التجلي الأبدي لمفهوم الولاية والقيادة في الإسلام. ضرب هذا الحدث التاريخي خطاً من البطلان على جميع المعتقدات والأفكار المناهضة للولاية والإمامة، وأنار إلى الأبد طريق الهداية والسعادة للبشرية. اليوم، يُكرم المسلمون حول العالم عيد الغدير للحفاظ على الإرث الثمين للولاية وعلاقتهم غير المنفصلة بسلالة الأئمة الطاهرين (عليهم السلام).</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/eid-ghadir1.jpg\" alt=\"احتفال عيد الغدير\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/eid-ghadir2.jpg\" alt=\"مراسم عيد الغدير\" class=\"img-fluid\">\r\n</div>\r\n<p>يدعو مجمع سلمان التعليمي، إذ يُحيي ذكرى هذا العيد المبارك، إلى الله تعالى أن يمنح الجميع فرصة اتباع تعاليم وإرشادات الأئمة المعصومين (عليهم السلام). ويؤمل أنه في ظل البركات الإلهية وباتباع السلوك المثالي للأئمة الأطهار (عليهم السلام)، سيتقدم مجتمعنا الإسلامي على طريق الكمال والسعادة، وينقل رسالة الوحدة والتضامن والالتزام بالولاية إلى العالم.</p>', NULL, 'published', '2023-07-27 12:00:00'),
(8, 1, 'عید قربان، نماد فداکاری در راه خدا', '<p>عید سعید قربان، یادآور حماسه جاودان حضرت ابراهیم خلیل (علیه السلام) است؛ حماسه‌ای که در آن، پیامبر بزرگ خدا با قربانی کردن فرزند دلبندش اسماعیل (علیه السلام)، اوج ایمان، اطاعت و فداکاری در راه خداوند متعال را به نمایش گذاشت. این واقعه تاریخی، درس بزرگی برای انسان‌ها دارد که باید در مسیر بندگی و عبودیت خداوند، از هیچ فداکاری دریغ نورزند.</p> <p>امروز، مسلمانان جهان با قربانی کردن گوسفندان، یاد این حماسه بزرگ را زنده نگه می‌دارند و پیام معنوی آن را به نسل‌های آینده منتقل می‌کنند. عید قربان، نمادی از پیروزی روح بر جسم و غلبه انسان بر نفس اماره است؛ فرصتی برای تقرب به خداوند و تجدید پیمان با آموزه‌های اخلاقی و معنوی دین مبین اسلام.</p> <div class=\"post-images\">   <img src=\"assets/images/blog/Extra_Post_Images/eid-qurban1.jpg\" alt=\"نماز عید قربان\" class=\"img-fluid\">   <img src=\"assets/images/blog/Extra_Post_Images/eid-qurban2.jpg\" alt=\"مراسم قربانی\" class=\"img-fluid\"> </div> <p>مجتمع آموزشی سلمان، ضمن تبریک این عید سعید به همه مسلمانان جهان، از خداوند متعال مسئلت دارد تا توفیق خدمت به خلق و پیروی از آموزه‌های دین مبین اسلام را به همگان عنایت فرماید. امید است در سایه الطاف الهی، جامعه اسلامی ما بیش از پیش در مسیر کمال و سعادت حرکت کند و پیام صلح، برادری، ایثارگری و فداکاری در راه خدا را به جهانیان منتقل سازد.</p>', NULL, 'published', '2023-06-28 00:00:00'),
(8, 2, 'Eid al-Adha, Symbol of Sacrifice in the Way of God', '<p>Eid al-Adha commemorates the eternal epic of Prophet Abraham (peace be upon him), where the great prophet of God demonstrated the pinnacle of faith, obedience, and sacrifice in the way of Almighty God by sacrificing his beloved son Ismail (peace be upon him). This historical event holds a great lesson for humanity – that one must not hesitate to make any sacrifice in the path of servitude and devotion to God.</p> <p>Today, Muslims around the world keep the memory of this great epic alive by sacrificing sheep and convey its spiritual message to future generations. Eid al-Adha symbolizes the triumph of the soul over the body and the human being\'s victory over carnal desires; it is an opportunity to draw closer to God and renew the covenant with the moral and spiritual teachings of the noble religion of Islam.</p> <div class=\"post-images\">   <img src=\"assets/images/blog/Extra_Post_Images/eid-qurban1.jpg\" alt=\"Eid al-Adha prayer\" class=\"img-fluid\">   <img src=\"assets/images/blog/Extra_Post_Images/eid-qurban2.jpg\" alt=\"Sacrifice ceremony\" class=\"img-fluid\"> </div> <p>The Salman Educational Complex, while extending its congratulations on this blessed Eid to all Muslims around the world, prays to Almighty God to grant everyone the opportunity to serve His creation and follow the teachings of the noble religion of Islam. It is hoped that under the shadow of divine blessings, our Islamic society will further advance on the path of perfection and felicity, and convey the message of peace, brotherhood, self-sacrifice, and devotion in the way of God to the world.</p>', NULL, 'published', '2023-06-28 00:00:00'),
(8, 3, 'عيد الأضحى، رمز التضحية في سبيل الله', '<p>يُحيي عيد الأضحى ذكرى الملحمة الخالدة للنبي إبراهيم (عليه السلام)، حيث أظهر نبي الله العظيم ذروة الإيمان والطاعة والتضحية في سبيل الله تعالى بالتضحية بابنه الحبيب إسماعيل (عليه السلام). يحمل هذا الحدث التاريخي درساً عظيماً للبشرية - أنه يجب ألا نتردد في تقديم أي تضحية في طريق العبودية والتفاني لله.</p> <p>اليوم، يُحيي المسلمون حول العالم ذكرى هذه الملحمة العظيمة بذبح الأضاحي وينقلون رسالتها الروحية إلى الأجيال القادمة. يرمز عيد الأضحى إلى انتصار الروح على الجسد وانتصار الإنسان على الرغبات النفسية؛ إنها فرصة للتقرب إلى الله وتجديد العهد مع التعاليم الأخلاقية والروحية للدين الإسلامي النبيل.</p> <div class=\"post-images\">   <img src=\"assets/images/blog/Extra_Post_Images/eid-qurban1.jpg\" alt=\"صلاة عيد الأضحى\" class=\"img-fluid\">   <img src=\"assets/images/blog/Extra_Post_Images/eid-qurban2.jpg\" alt=\"مراسم الذبح\" class=\"img-fluid\"> </div> <p>يتقدم مجمع سلمان التعليمي، إذ يقدم تهانيه بهذا العيد المبارك لجميع المسلمين في العالم، بالدعاء إلى الله تعالى أن يمنح الجميع فرصة خدمة خلقه واتباع تعاليم الدين الإسلامي النبيل. ويؤمل أنه في ظل البركات الإلهية، سيتقدم مجتمعنا الإسلامي أكثر في طريق الكمال والسعادة، وينقل رسالة السلام والأخوة والتضحية والتفاني في سبيل الله إلى العالم.</p>', NULL, 'published', '2023-06-28 00:00:00'),
(9, 1, 'روز معلم، گرامیداشت فرهیختگان و پرچمداران دانش', '<p>امروز، روز گرامیداشت معلمان و استادان فرهیخته و دانشمند است؛ کسانی که با تلاش و جانفشانی خود، نور علم و معرفت را در جامعه می‌درخشانند و راه را برای آیندگان روشن می‌سازند. معلمان، پرچمداران دانش و معرفت هستند که با صبر و استقامت، نسل‌های آینده را برای ساختن جامعه‌ای سالم و پویا آماده می‌کنند.</p> <p>معلمان، مروجان فرهنگ و ارزش‌های انسانی و اخلاقی در جامعه هستند. آنها با انتقال علم و دانش به دانش‌آموزان، زمینه‌ساز پیشرفت و ترقی جامعه می‌شوند. لذا، قدردانی و تکریم از این قشر فرهیخته و فداکار، وظیفه‌ای انسانی و ملی است که باید همواره مورد توجه قرار گیرد.</p> <div class=\"post-images\">   <img src=\"assets/images/blog/Extra_Post_Images/teachers-day1.jpg\" alt=\"روز معلم\" class=\"img-fluid\">   <img src=\"assets/images/blog/Extra_Post_Images/teachers-day2.jpg\" alt=\"تجلیل از معلمان\" class=\"img-fluid\"> </div> <p>مجتمع آموزشی سلمان، ضمن گرامیداشت روز معلم، از تلاش‌های خستگی‌ناپذیر این عزیزان قدردانی می‌کند و برای همه معلمان و استادان، آرزوی توفیق روزافزون در راه تربیت نسل‌های آینده‌ساز و پیشرفت جامعه دارد. امید است با همت و تلاش همگانی، جامعه ایرانی ما در مسیر کمال و ترقی گام بردارد و پیام صلح، دانش و فرهنگ را به جهانیان منتقل سازد.</p>', NULL, 'published', '2024-05-01 10:00:00'),
(9, 2, 'Teachers\' Day, Honoring the Enlightened and Standard-bearers of Knowledge', '<p>Today, we honor the enlightened and knowledgeable teachers and professors – those who, through their efforts and dedication, illuminate the light of knowledge and understanding in society and pave the way for future generations. Teachers are the standard-bearers of knowledge and wisdom, who, with patience and perseverance, prepare the generations to come for building a healthy and vibrant society.</p> <p>Teachers are the promoters of culture and human and moral values in society. Through imparting knowledge and wisdom to students, they lay the foundation for the progress and advancement of society. Therefore, expressing gratitude and honoring this enlightened and selfless community is a human and national duty that should always be a priority.</p> <div class=\"post-images\">   <img src=\"assets/images/blog/Extra_Post_Images/teachers-day1.jpg\" alt=\"Teachers\' Day\" class=\"img-fluid\">   <img src=\"assets/images/blog/Extra_Post_Images/teachers-day2.jpg\" alt=\"Honoring teachers\" class=\"img-fluid\"> </div> <p>The Salman Educational Complex, while commemorating Teachers\' Day, expresses its gratitude for the tireless efforts of these esteemed individuals and wishes all teachers and professors continued success in nurturing the future generations and contributing to the progress of society. It is hoped that through the collective efforts and dedication of all, our Iranian society will advance on the path of perfection and progress, and convey the message of peace, knowledge, and culture to the world.</p>', NULL, 'published', '2024-05-01 10:00:00'),
(9, 3, 'يوم المعلم، تكريم المستنيرين وحاملي راية المعرفة', '<p>اليوم، نُكرم المعلمين والأساتذة المستنيرين وأصحاب المعرفة - أولئك الذين، من خلال جهودهم وتفانيهم، ينيرون ضوء المعرفة والفهم في المجتمع ويمهدون الطريق للأجيال القادمة. المعلمون هم حاملو راية المعرفة والحكمة، الذين، بالصبر والمثابرة، يُعدون الأجيال القادمة لبناء مجتمع صحي ونابض بالحياة.</p> <p>المعلمون هم مروجو الثقافة والقيم الإنسانية والأخلاقية في المجتمع. من خلال نقل المعرفة والحكمة للطلاب، يضعون الأساس لتقدم ورقي المجتمع. لذلك، فإن التعبير عن الامتنان وتكريم هذا المجتمع المستنير والمتفاني هو واجب إنساني ووطني يجب أن يكون دائماً أولوية.</p> <div class=\"post-images\">   <img src=\"assets/images/blog/Extra_Post_Images/teachers-day1.jpg\" alt=\"يوم المعلم\" class=\"img-fluid\">   <img src=\"assets/images/blog/Extra_Post_Images/teachers-day2.jpg\" alt=\"تكريم المعلمين\" class=\"img-fluid\"> </div> <p>يعبر مجمع سلمان التعليمي، إذ يُحيي ذكرى يوم المعلم، عن امتنانه للجهود الدؤوبة لهؤلاء الأفراد المحترمين ويتمنى لجميع المعلمين والأساتذة النجاح المستمر في رعاية الأجيال المستقبلية والمساهمة في تقدم المجتمع. ويؤمل أنه من خلال الجهود الجماعية وتفاني الجميع، سيتقدم مجتمعنا الإيراني على طريق الكمال والتقدم، وينقل رسالة السلام والمعرفة والثقافة إلى العالم.</p>', NULL, 'published', '2024-05-01 10:00:00'),
(10, 1, 'آغاز سال نو میلادی، فرصتی برای تازگی و نوآوری', '<p>با گذر از آخرین روزهای سال میلادی و آغاز سال نو، فرصتی دیگر برای تازگی، نوآوری و بازنگری در زندگی فردی و اجتماعی ما فراهم می‌شود. سال نو میلادی، یادآور این حقیقت است که زندگی همواره در حال تحول و دگرگونی است و انسان‌ها باید خود را برای پذیرش تغییرات و چالش‌های جدید آماده کنند.</p>\r\n<p>در آستانه سال جدید، فرصتی مناسب برای ارزیابی دستاوردها و کاستی‌های گذشته و تدوین برنامه‌های جدید برای آینده پیش روی ماست. این روزها، زمانی برای بازنگری در اهداف و آرمان‌های خود، تقویت روحیه امید و نوآوری و گام برداشتن در مسیری نو برای پیشرفت و ترقی جامعه است.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/new-year1.jpg\" alt=\"سال نو میلادی\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/new-year2.jpg\" alt=\"جشن سال نو\" class=\"img-fluid\">\r\n</div>\r\n<p>مجتمع آموزشی سلمان، ضمن تبریک آغاز سال نو میلادی به همه عزیزان، از خداوند متعال مسئلت دارد تا سالی سرشار از موفقیت، پیشرفت و سعادت را برای ملت شریف ایران و جامعه جهانی رقم زند. امید است در سال جدید، با تلاش و همدلی همگانی، گامی دیگر در مسیر تعالی و کمال برداشته شود و پیام صلح، دوستی و همزیستی مسالمت‌آمیز به جهانیان منتقل گردد.</p>', NULL, 'published', '2024-01-01 00:00:00'),
(10, 2, 'The Start of the New Gregorian Year, an Opportunity for Renewal and Innovation', '<p>As we move past the final days of the Gregorian year and into the new year, another opportunity arises for renewal, innovation, and reflection in our personal and social lives. The new Gregorian year reminds us of the truth that life is constantly evolving and changing, and human beings must be prepared to embrace new transformations and challenges.</p>\r\n<p>On the eve of the new year, we have a suitable opportunity to evaluate our past achievements and shortcomings and develop new plans for the future ahead of us. These days are a time to revisit our goals and ideals, strengthen the spirit of hope and innovation, and take steps in a new direction towards societal progress and advancement.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/new-year1.jpg\" alt=\"New Gregorian Year\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/new-year2.jpg\" alt=\"New Year celebration\" class=\"img-fluid\">\r\n</div>\r\n<p>The Salman Educational Complex, while extending its congratulations on the start of the new Gregorian year to all, prays to Almighty God to bring a year filled with success, progress, and felicity for the noble Iranian nation and the global community. It is hoped that in the new year, through collective efforts and unity, another step will be taken towards sublimity and perfection, and the message of peace, friendship, and peaceful coexistence will be conveyed to the world.</p>', NULL, 'published', '2024-01-01 00:00:00'),
(10, 3, 'بداية العام الميلادي الجديد، فرصة للتجديد والابتكار', '<p>مع انتقالنا من الأيام الأخيرة من العام الميلادي إلى العام الجديد، تنشأ فرصة أخرى للتجديد والابتكار والتأمل في حياتنا الشخصية والاجتماعية. يُذكرنا العام الميلادي الجديد بحقيقة أن الحياة تتطور وتتغير باستمرار، وأن البشر يجب أن يكونوا مستعدين لاحتضان التحولات والتحديات الجديدة.</p>\r\n<p>عشية العام الجديد، لدينا فرصة مناسبة لتقييم إنجازاتنا وأوجه القصور في الماضي ووضع خطط جديدة للمستقبل الذي أمامنا. هذه الأيام هي وقت لإعادة النظر في أهدافنا ومُثلنا، وتعزيز روح الأمل والابتكار، واتخاذ خطوات في اتجاه جديد نحو التقدم والرقي المجتمعي.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/new-year1.jpg\" alt=\"العام الميلادي الجديد\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/new-year2.jpg\" alt=\"احتفال رأس السنة\" class=\"img-fluid\">\r\n</div>\r\n<p>يتقدم مجمع سلمان التعليمي، إذ يقدم تهانيه ببداية العام الميلادي الجديد للجميع، بالدعاء إلى الله تعالى أن يجلب عاماً مليئاً بالنجاح والتقدم والسعادة للأمة الإيرانية النبيلة والمجتمع العالمي. ويؤمل أنه في العام الجديد، من خلال الجهود الجماعية والوحدة، سيتم اتخاذ خطوة أخرى نحو السمو والكمال، وستُنقل رسالة السلام والصداقة والتعايش السلمي إلى العالم.</p>', NULL, 'published', '2024-01-01 00:00:00'),
(11, 1, 'رمضان، فرصت تقرب به درگاه الهی', '<p>با فرارسیدن ماه مبارک رمضان، لحظه‌های پرارزش انسان‌سازی و خودسازی فرا می‌رسد. در این ماه پرفضیلت، مسلمانان فرصت کسب قرب الهی و پرورش خود را در آیینه جلال و جمال الهی می‌یابند. روزه داشتن، بهانه‌ای برای آگاهی از لحظات گرانبها و امتحان صبر و استقامت در مسیر اطاعت خداوند است.</p>\r\n<p>این ماه، دریچه‌ای فراخ به درگاه خداوند متعال است و انسان به گرامی داشتن یاد شهدای گرانقدر میدان توحید، عزت و مقاومت در برابر شرک و کفر را می‌آموزد. امیدواریم در این ایام انسان‌ساز، بیش از پیش تابع مبادی اخلاقی و معنوی اسلام باشیم.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/ramadan1.jpg\" alt=\"ماه مبارک رمضان\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/ramadan2.jpg\" alt=\"افطار رمضان\" class=\"img-fluid\">\r\n</div>\r\n<p>مجتمع آموزشی سلمان، ضمن تبریک ایام پربرکت ماه مبارک رمضان، آمادگی خود را برای همراهی و کمک به خانواده‌های فرهنگی در این ایام اعلام می‌دارد. امید است در سایه الطاف الهی و استقامت در شریعت ناب اسلامی، همه مسلمانان جهان به سرمنزل مقصود رسیده و از شیرینی روزه‌داری و عبادت مستمر به خاطرات ماندگار روزهای جوانی خود تازه کنند.</p>', NULL, 'published', '2023-03-05 22:24:12'),
(11, 2, 'Ramadan, an Opportunity to Draw Closer to the Divine', '<p>With the arrival of the blessed month of Ramadan, the precious moments of observing the divine and resisting temptations are upon us. In this virtuous month, Muslims have the opportunity to draw closer to the Divine and nurture themselves in the mirror of divine majesty and beauty. Fasting provides an opportunity to be mindful of these precious moments and test one\'s patience and obedience in the way of God.</p>\r\n<p>This month is an open door to the presence of the Almighty, and we learn to honor the memory of the precious martyrs of the arena of monotheism and to resist polytheism and disbelief. Let us hope that in these human-nurturing days, we embrace the moral and spiritual principles of Islam more than ever before.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/ramadan1.jpg\" alt=\"The blessed month of Ramadan\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/ramadan2.jpg\" alt=\"Ramadan iftar\" class=\"img-fluid\">\r\n</div>\r\n<p>The Salman Educational Complex, while congratulating the blessed days of the holy month of Ramadan, announces its readiness to accompany and assist cultural families during these days. It is hoped that in the shadow of divine blessings and perseverance in the pure Islamic law, all Muslims around the world will reach their desired destination and revive the sweet memories of their youth through consistent fasting and worship.</p>', NULL, 'published', '2023-03-05 22:24:12'),
(11, 3, 'رمضان، فرصة للتقرب من الباري عز وجل', '<p>مع حلول شهر رمضان المبارك، تحل علينا لحظات ثمينة من مراقبة الذات ومقاومة الإغراءات. في هذا الشهر الفضيل، يتاح للمسلمين فرصة التقرب إلى الباري عز وجل وتغذية أنفسهم في مرآة الجلال والجمال الإلهي. يوفر الصيام فرصة للتنبه لهذه اللحظات الثمينة واختبار صبر المرء وطاعته في سبيل الله.</p>\r\n<p>هذا الشهر هو باب مفتوح إلى حضرة الله تعالى، ونتعلم تكريم ذكرى الشهداء الأعزاء في ساحة التوحيد ومقاومة الشرك والكفر. دعونا نأمل أنه في هذه الأيام التي تغذي الإنسان، نعتنق المبادئ الأخلاقية والروحية للإسلام أكثر من أي وقت مضى.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/ramadan1.jpg\" alt=\"شهر رمضان المبارك\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/ramadan2.jpg\" alt=\"إفطار رمضان\" class=\"img-fluid\">\r\n</div>\r\n<p>يعلن مجمع سلمان التعليمي، إذ يهنئ بالأيام المباركة لشهر رمضان الكريم، استعداده لمرافقة ومساعدة العائلات الثقافية خلال هذه الأيام. ويؤمل أنه في ظل البركات الإلهية والمثابرة في الشريعة الإسلامية النقية، سيصل جميع المسلمين حول العالم إلى وجهتهم المنشودة ويحيون الذكريات الحلوة لشبابهم من خلال الصيام المستمر والعبادة.</p>', NULL, 'published', '2023-03-05 22:24:12'),
(12, 1, 'روز ملی امارات؛ آرزوی پیشرفت و شکوفایی', '<p>امروز، سالگرد تأسیس امارات متحده عربی و روز ملی این کشور است. در این روز فرخنده، ضمن گرامیداشت مردم شریف امارات و دستاوردهای این کشور در عرصه‌های مختلف، آرزوی پیشرفت و شکوفایی روزافزون آن را داریم.</p>\r\n<p>امارات متحده عربی، کشوری جوان با ریشه‌های تاریخی کهن در منطقه خاورمیانه است که با اتکا به منابع انسانی و طبیعی خود، توانسته در مدت زمان کوتاهی، دستاوردهای چشمگیری در زمینه‌های اقتصادی، علمی و فناوری کسب کند. این کشور، نمونه‌ای از پیشرفت و توسعه در جهان اسلام است.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/uae-national-day1.jpg\" alt=\"روز ملی امارات\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/uae-national-day2.jpg\" alt=\"جشن روز ملی امارات\" class=\"img-fluid\">\r\n</div>\r\n<p>مجتمع آموزشی سلمان، ضمن تبریک این روز مهم به دولت و ملت امارات متحده عربی، آرزوی روابط دوستانه و گسترش همکاری‌های مثمرثمر میان دو کشور را دارد. امید است با تلاش و پشتکار، جوامع اسلامی در مسیر پیشرفت، توسعه و تعالی گام بردارند و پیام صلح، دوستی و همزیستی مسالمت‌آمیز را به جهانیان منتقل کنند.</p>', NULL, 'published', '2023-12-02 00:00:00'),
(12, 2, 'Anniversary of UAE National Day; Wishing Progress and Prosperity', '<p>Today marks the anniversary of the founding of the United Arab Emirates and its National Day. On this auspicious occasion, we honor the noble people of the UAE and their achievements in various fields, wishing for the country\'s continued progress and prosperity.</p>\r\n<p>The United Arab Emirates is a young nation with ancient historical roots in the Middle East region. By relying on its human and natural resources, it has been able to achieve remarkable accomplishments in the economic, scientific, and technological spheres in a short period. This country serves as an example of progress and development in the Islamic world.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/uae-national-day1.jpg\" alt=\"UAE National Day\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/uae-national-day2.jpg\" alt=\"UAE National Day celebration\" class=\"img-fluid\">\r\n</div>\r\n<p>The Salman Educational Complex, while congratulating this important occasion to the government and people of the United Arab Emirates, wishes for friendly relations and fruitful cooperation between the two countries. It is hoped that through diligence and perseverance, Islamic societies will advance on the path of progress, development, and sublimity, conveying the message of peace, friendship, and peaceful coexistence to the world.</p>', NULL, 'published', '2023-12-02 00:00:00'),
(12, 3, 'ذكرى اليوم الوطني للإمارات؛ متمنين التقدم والازدهار', '<p>يصادف اليوم ذكرى تأسيس دولة الإمارات العربية المتحدة ويومها الوطني. في هذه المناسبة الميمونة، نكرم الشعب النبيل للإمارات وإنجازاتهم في مختلف المجالات، متمنين للبلاد استمرار التقدم والازدهار.</p>\r\n<p>الإمارات العربية المتحدة دولة فتية ذات جذور تاريخية قديمة في منطقة الشرق الأوسط. بالاعتماد على مواردها البشرية والطبيعية، تمكنت من تحقيق إنجازات ملحوظة في المجالات الاقتصادية والعلمية والتكنولوجية في فترة قصيرة. تُعد هذه الدولة مثالاً للتقدم والتنمية في العالم الإسلامي.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/uae-national-day1.jpg\" alt=\"اليوم الوطني للإمارات\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/uae-national-day2.jpg\" alt=\"احتفال اليوم الوطني للإمارات\" class=\"img-fluid\">\r\n</div>\r\n<p>يتقدم مجمع سلمان التعليمي، إذ يهنئ بهذه المناسبة المهمة حكومة وشعب دولة الإمارات العربية المتحدة، بالتمني للعلاقات الودية والتعاون المثمر بين البلدين. ويؤمل أنه من خلال الاجتهاد والمثابرة، ستتقدم المجتمعات الإسلامية على طريق التقدم والتنمية والسمو، ناقلة رسالة السلام والصداقة والتعايش السلمي إلى العالم.</p>', NULL, 'published', '2023-12-02 00:00:00'),
(13, 1, 'هفته دفاع مقدس، یادآور رشادت‌ها و ایثارگری‌های ملت ایران', '<p>هفته دفاع مقدس، یادآور حماسه‌آفرینی‌ها و رشادت‌های ملت ایران در دوران جنگ تحمیلی است. در این ایام، خاطره شهیدان گرانقدر و ایثارگران راه آزادی را گرامی می‌داریم؛ کسانی که با نثار خون پاک خود، استقلال و تمامیت ارضی کشور عزیزمان را حفظ کردند.</p>\r\n<p>دفاع مقدس، نماد عزت، افتخار و پایداری ملت ایران در برابر متجاوزان است. امروز، با الهام از روحیه جهاد و مقاومت رزمندگان اسلام، بار دیگر پیمان خود را با آرمان‌های انقلاب اسلامی و دفاع از ارزش‌های واﻻی اسلامی تجدید می‌کنیم.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/sacred-defense-week1.jpg\" alt=\"هفته دفاع مقدس\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/sacred-defense-week2.jpg\" alt=\"یادمان شهدای دفاع مقدس\" class=\"img-fluid\">\r\n</div>\r\n<p>مجتمع آموزشی سلمان، ضمن گرامیداشت یاد و خاطره شهیدان واﻻمقام دفاع مقدس، از تلاش‌های خستگی‌ناپذیر رزمندگان و ایثارگران این نبرد حق علیه باطل قدردانی می‌کند. امید است با الهام از روحیه جهادی و ایثارگری شهدا، ملت ایران در مسیر عزت، پیشرفت و اعتلای نظام مقدس جمهوری اسلامی گام بردارد و پیام صلح، مقاومت و عدالت‌خواهی را به جهانیان منتقل سازد.</p>', NULL, 'published', '2023-09-21 00:00:00');
INSERT INTO `post_translations` (`post_id`, `language_id`, `title`, `content`, `excerpt`, `status`, `translated_at`) VALUES
(13, 2, 'Sacred Defense Week, Reminiscent of the Bravery and Sacrifices of the Iranian Nation', '<p>The Sacred Defense Week reminds us of the epic achievements and bravery of the Iranian nation during the Imposed War. During these days, we honor the memory of the esteemed martyrs and self-sacrificing individuals who defended freedom, preserving the independence and territorial integrity of our beloved country by sacrificing their pure blood.</p>\r\n<p>The Sacred Defense symbolizes the honor, glory, and perseverance of the Iranian nation against aggressors. Today, inspired by the spirit of jihad and resistance of the Islamic warriors, we renew our covenant with the ideals of the Islamic Revolution and the defense of the lofty Islamic values.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/sacred-defense-week1.jpg\" alt=\"Sacred Defense Week\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/sacred-defense-week2.jpg\" alt=\"Sacred Defense martyrs memorial\" class=\"img-fluid\">\r\n</div>\r\n<p>The Salman Educational Complex, while honoring the memory of the esteemed martyrs of the Sacred Defense, expresses its gratitude for the tireless efforts of the warriors and self-sacrificing individuals in this battle of truth against falsehood. It is hoped that inspired by the spirit of jihad and self-sacrifice of the martyrs, the Iranian nation will tread the path of honor, progress, and the exaltation of the sacred system of the Islamic Republic, conveying the message of peace, resistance, and justice to the world.</p>', NULL, 'published', '2023-09-21 00:00:00'),
(13, 3, 'أسبوع الدفاع المقدس، تذكير ببطولات وتضحيات الأمة الإيرانية', '<p>يذكرنا أسبوع الدفاع المقدس بالإنجازات الملحمية وشجاعة الأمة الإيرانية خلال الحرب المفروضة. خلال هذه الأيام، نُكرم ذكرى الشهداء المبجلين والأفراد المضحين الذين دافعوا عن الحرية، وحافظوا على استقلال وسلامة أراضي بلدنا الحبيب بالتضحية بدمائهم الطاهرة.</p>\r\n<p>يرمز الدفاع المقدس إلى شرف ومجد وصمود الأمة الإيرانية ضد المعتدين. اليوم، مستلهمين من روح الجهاد والمقاومة للمحاربين الإسلاميين، نجدد عهدنا مع مُثل الثورة الإسلامية والدفاع عن القيم الإسلامية السامية.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/sacred-defense-week1.jpg\" alt=\"أسبوع الدفاع المقدس\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/sacred-defense-week2.jpg\" alt=\"نصب تذكاري لشهداء الدفاع المقدس\" class=\"img-fluid\">\r\n</div>\r\n<p>يعبر مجمع سلمان التعليمي، إذ يُكرم ذكرى الشهداء المبجلين للدفاع المقدس، عن امتنانه للجهود الدؤوبة للمحاربين والأفراد المضحين في هذه المعركة بين الحق والباطل. ويؤمل أنه بإلهام من روح الجهاد والتضحية للشهداء، ستسير الأمة الإيرانية في طريق الشرف والتقدم وإعلاء النظام المقدس للجمهورية الإسلامية، ناقلة رسالة السلام والمقاومة والعدالة إلى العالم.</p>', NULL, 'published', '2023-09-21 00:00:00'),
(14, 1, 'محرم، نمادِ پایداری در مسیر حق', '<p>با آغاز ماه محرم، یاد و خاطره حماسه ماندگار و جاودانه کربلا را گرامی می‌داریم؛ حماسه‌ای که در آن، امام حسین (علیه السلام) و یاران با وفایش، با نثار خون پاک خود، پرچم توحید و عدالت را برافراشتند و درس پایداری و ایستادگی در برابر ظلم و استکبار را به جهانیان آموختند.</p>\r\n<p>شهادت امام حسین (علیه السلام) و یارانش، درسی بزرگ برای همه آزادگان جهان است که باید در مسیر حق و دفاع از ارزش‌های انسانی و الهی، از هیچ فداکاری دریغ نورزند. این واقعه تلخ، نمادی از مبارزه با ظلم و جهالت در طول تاریخ بشریت است.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/muharram1.jpg\" alt=\"عزاداری محرم\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/muharram2.jpg\" alt=\"مراسم سوگواری امام حسین (ع)\" class=\"img-fluid\">\r\n</div>\r\n<p>مجتمع آموزشی سلمان، ضمن گرامیداشت یاد و خاطره شهدای کربلا، از خداوند متعال مسئلت دارد تا توفیق پیروی از منویات و آرمان‌های واﻻی اهل بیت عصمت و طهارت (علیهم السلام) را به همگان عنایت فرماید. امید است با الهام از قیام عاشورا و رهنمودهای امام حسین (علیه السلام)، جامعه اسلامی ما در مسیر کمال و عدالت گام بردارد و پیام مقاومت، آزادگی و عزت را به جهانیان منتقل سازد.</p>', NULL, 'published', '2023-06-05 22:26:51'),
(14, 2, 'Muharram, the Symbol of Perseverance on the Path of Truth', '<p>With the beginning of the month of Muharram, we honor the memory of the enduring and eternal epic of Karbala; an epic in which Imam Hussain (peace be upon him) and his loyal companions raised the flag of monotheism and justice by sacrificing their pure blood, teaching the world a lesson in perseverance and steadfastness against oppression and arrogance.</p>\r\n<p>The martyrdom of Imam Hussain (peace be upon him) and his companions is a great lesson for all free people in the world – that one must not hesitate to make any sacrifice in the path of truth and in defense of human and divine values. This bitter event symbolizes the struggle against oppression and ignorance throughout human history.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/muharram1.jpg\" alt=\"Muharram mourning\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/muharram2.jpg\" alt=\"Imam Hussain mourning ceremony\" class=\"img-fluid\">\r\n</div>\r\n<p>The Salman Educational Complex, while honoring the memory of the martyrs of Karbala, prays to Almighty God to grant everyone the opportunity to follow the teachings and lofty ideals of the infallible Ahl al-Bayt (peace be upon them). It is hoped that inspired by the Ashura uprising and the guidance of Imam Hussain (peace be upon him), our Islamic society will advance on the path of perfection and justice, conveying the message of resistance, freedom, and honor to the world.</p>', NULL, 'published', '2023-06-05 22:26:51'),
(14, 3, 'محرّم، رمز الثبات على طريق الحق', '<p>مع بداية شهر محرم، نُكرم ذكرى الملحمة الخالدة والأبدية لكربلاء؛ ملحمة رفع فيها الإمام الحسين (عليه السلام) وأصحابه المخلصون راية التوحيد والعدالة بالتضحية بدمائهم الطاهرة، وعلّموا العالم درساً في الثبات والصمود ضد الظلم والاستكبار.</p>\r\n<p>إن استشهاد الإمام الحسين (عليه السلام) وأصحابه درس عظيم لجميع الأحرار في العالم - أنه يجب عدم التردد في تقديم أي تضحية في سبيل الحق والدفاع عن القيم الإنسانية والإلهية. يرمز هذا الحدث المرير إلى النضال ضد الظلم والجهل عبر التاريخ البشري.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/muharram1.jpg\" alt=\"حداد محرم\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/muharram2.jpg\" alt=\"مراسم حداد الإمام الحسين\" class=\"img-fluid\">\r\n</div>\r\n<p>يدعو مجمع سلمان التعليمي، إذ يُكرم ذكرى شهداء كربلاء، إلى الله تعالى أن يمنح الجميع فرصة اتباع تعاليم ومُثل أهل البيت المعصومين (عليهم السلام) السامية. ويؤمل أنه بإلهام من نهضة عاشوراء وإرشاد الإمام الحسين (عليه السلام)، سيتقدم مجتمعنا الإسلامي على طريق الكمال والعدالة، ناقلاً رسالة المقاومة والحرية والعزة إلى العالم.</p>', NULL, 'published', '2023-06-05 22:26:51'),
(15, 1, 'شب‌های قدر و شهادت امیرالمومنین (ع)؛ اوج عبودیت و فداکاری', '<p>در شبهای پرفیض و برکت قدر، که اوج تجلی عبودیت و بندگی خداوند متعال است، یاد و خاطره شهادت حضرت امیرالمؤمنان علی بن ابیطالب (ع) نیز گرامی داشته می‌شود. شهادت آن حضرت که در بیست و یکم ماه مبارک رمضان رخ داد، نمونه‌ای عالی از فداکاری در راه خداوند و دفاع از حریم اسلام و قرآن است.</p>\r\n<p>امام علی (ع) با جانفشانی در رکاب پیامبر اکرم (ص) و سپس هدایت امت اسلامی به مسیر پرهیزگاری و تقوا، پرچم اسلام ناب محمدی (ص) را برافراشته نگه داشت. شهادت ایشان به دست فرد منحرف و گمراه، ضربه‌ای سنگین بر پیکر امت اسلامی وارد کرد؛ اما خون پاک ایشان، نهال اسلام واقعی را همچنان سیراب و تازه نگه داشت.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/ali_shohada.jpg\" alt=\"شهادت امام علی\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/fazilat_shab_qadr.jpg\" alt=\"شب قدر\" class=\"img-fluid\">\r\n</div>\r\n<p>در این شب‌های گرانقدر که فضیلت عبادت در آن‌ها برابر با هزار ماه است، باید از عبرت‌های شهادت حضرت علی (ع) و راه پرافتخار ایشان، درس‌هایی برای تقویت ایمان، استقامت و فداکاری در مسیر حق بیاموزیم. یاد و خاطره آن شهید راه حقیقت، نوری فروزان بر دل‌های مؤمنان است که باید همواره زنده و جاری بماند.</p>', NULL, 'published', '2024-04-01 08:59:20'),
(15, 2, 'The Nights of Glory and the Martyrdom of the Commander of the Faithful; The Pinnacle of Servitude and Sacrifice', '<p>In the blessed and auspicious Nights of Glory, which represent the pinnacle of servitude and devotion to Almighty God, we also honor the memory of the martyrdom of the Commander of the Faithful, Ali ibn Abi Talib (peace be upon him). His martyrdom, which occurred on the 21st of the holy month of Ramadan, is a sublime example of sacrifice in the way of God and the defense of the sanctity of Islam and the Quran.</p>\r\n<p>Imam Ali (peace be upon him), through his selfless struggles alongside the Prophet Muhammad (peace be upon him and his progeny) and later guiding the Muslim nation towards piety and righteousness, upheld the banner of the pure Muhammadan Islam. His martyrdom at the hands of a deviant and misguided individual dealt a heavy blow to the body of the Muslim nation; however, his pure blood continued to nourish and revive the seedling of true Islam.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/ali_shohada.jpg\" alt=\"Martyrdom of Imam Ali\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/fazilat_shab_qadr.jpg\" alt=\"Night of Glory\" class=\"img-fluid\">\r\n</div>\r\n<p>In these precious nights, where the virtue of worship is equivalent to a thousand months, we must learn lessons from the martyrdom of Imam Ali (peace be upon him) and his honorable path to strengthen our faith, perseverance, and readiness for sacrifice in the way of truth. The memory of that martyr on the path of truth is a shining light in the hearts of believers, which must always remain alive and flowing.</p>', NULL, 'published', '2024-04-01 08:59:20'),
(15, 3, 'ليالي القدر واستشهاد أمير المؤمنين؛ ذروة العبودية والتضحية', '<p>في ليالي القدر المباركة والميمونة، التي تمثل ذروة العبودية والتفاني لله تعالى، نُكرم أيضاً ذكرى استشهاد أمير المؤمنين، علي بن أبي طالب (عليه السلام). استشهاده، الذي وقع في الحادي والعشرين من شهر رمضان المبارك، هو مثال سامٍ للتضحية في سبيل الله والدفاع عن حرمة الإسلام والقرآن.</p>\r\n<p>الإمام علي (عليه السلام)، من خلال نضالاته المتفانية إلى جانب النبي محمد (صلى الله عليه وآله وسلم) وتوجيهه لاحقاً للأمة الإسلامية نحو التقوى والصلاح، حمل راية الإسلام المحمدي النقي. أحدث استشهاده على يد فرد منحرف وضال ضربة قوية لجسد الأمة الإسلامية؛ ومع ذلك، استمر دمه الطاهر في تغذية وإحياء شتلة الإسلام الحقيقي.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/ali_shohada.jpg\" alt=\"استشهاد الإمام علي\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/fazilat_shab_qadr.jpg\" alt=\"ليلة القدر\" class=\"img-fluid\">\r\n</div>\r\n<p>في هذه الليالي الثمينة، حيث فضيلة العبادة تعادل ألف شهر، يجب علينا أن نتعلم دروساً من استشهاد الإمام علي (عليه السلام) وطريقه المشرف لتقوية إيماننا وصمودنا واستعدادنا للتضحية في سبيل الحق. ذكرى ذلك الشهيد على طريق الحق هي نور مشع في قلوب المؤمنين، يجب أن يظل حياً ومتدفقاً دائماً.</p>', NULL, 'published', '2024-04-01 08:59:20'),
(16, 1, 'جشن روز پرچم در امارات متحده عربی', '<p>در امارات متحده عربی، در سوم نوامبر از هر سال، جشن روز پرچم ملی برگزار می‌شود. این روز، روزی مهم است که وحدت ملی و تعلق به سرزمین مادری را نمایش می‌دهد. در این روز تاریخی، پرچم‌های کشور بر فراز ساختمان‌های دولتی، نهادها و خانه‌ها در سراسر کشور در اهتزاز است و نشان از غرور و وفاداری به سرزمین و مردم امارات دارد.</p>\r\n<p>این روز، جشن‌ها و رویدادهای متعددی در مناطق مختلف برگزار می‌شود که شهروندان و ساکنان هر دو در آن شرکت می‌کنند تا به این مناسبت گرامی احترام بگذارند. همچنین وزارت آموزش و پرورش و نهادهای مربوطه، فعالیت‌ها و برنامه‌های آموزشی برای دانش‌آموزان ترتیب می‌دهند تا مفاهیم ملی و تعلق به میهن را تقویت کنند.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/uae_flag_raising.jpg\" alt=\"برافراشتن پرچم امارات\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/uae_flag_celebrations.jpg\" alt=\"جشن روز پرچم امارات\" class=\"img-fluid\">\r\n</div>\r\n<p>پرچم امارات، نماد وحدت، حاکمیت و کرامت ملی است و آرزوهای مردم امارات برای پیشرفت و شکوفایی بیشتر را نمایان می‌سازد. بنابراین، جشن روز پرچم فرصتی است برای تأکید بر هویت ملی، همبستگی و وفاداری به رهبری خردمند و میهن. بیایید همگی این مناسبت عزیز را جشن بگیریم و پیمان خود را برای پیشروی به سوی افق‌های جدید توسعه و شکوفایی برای نسل‌های آینده تجدید کنیم.</p>', NULL, 'published', '2023-11-03 10:00:00'),
(16, 2, 'Celebrations of the National Flag Day in the United Arab Emirates', '<p>On the 3rd of November each year, the United Arab Emirates celebrates its National Flag Day, an important occasion that reflects national unity and belonging to the homeland. On this historic day, the flags of the nation fly proudly over government buildings, institutions, and homes across the country, expressing pride and loyalty to the Emirati land and people.</p>\r\n<p>Numerous celebrations and events are held in various regions on this day, with citizens and residents alike participating in the festivities of this cherished occasion. The Ministry of Education and relevant authorities also organize educational activities and programs for students to promote national concepts and a sense of belonging to the homeland.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/uae_flag_raising.jpg\" alt=\"UAE flag raising\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/uae_flag_celebrations.jpg\" alt=\"UAE Flag Day celebration\" class=\"img-fluid\">\r\n</div>\r\n<p>The Emirati flag is a symbol of unity, sovereignty, and national dignity, embodying the aspirations of the Emirati people towards further progress and prosperity. Therefore, the Flag Day celebrations represent an opportunity to reaffirm the national identity, solidarity, and loyalty to the wise leadership and the homeland. Let us all celebrate this cherished occasion and renew our commitment to move forward towards new horizons of development and prosperity for future generations.</p>', NULL, 'published', '2023-11-03 10:00:00'),
(16, 3, 'احتفالات يوم العلم الوطني في دولة الإمارات العربية المتحدة', '<p>في الثالث من نوفمبر من كل عام، تحتفل دولة الإمارات العربية المتحدة بيوم العلم الوطني، وهي مناسبة مهمة تعكس الوحدة الوطنية والانتماء للوطن. في هذا اليوم التاريخي، ترفرف أعلام الدولة بفخر فوق المباني الحكومية والمؤسسات والمنازل في جميع أنحاء البلاد، معبرة عن الفخر والولاء للأرض والشعب الإماراتي.</p>\r\n<p>تُقام احتفالات وفعاليات عديدة في مختلف المناطق في هذا اليوم، حيث يشارك المواطنون والمقيمون على حد سواء في احتفالات هذه المناسبة العزيزة. كما تنظم وزارة التربية والتعليم والجهات المعنية أنشطة وبرامج تعليمية للطلاب لتعزيز المفاهيم الوطنية والشعور بالانتماء للوطن.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/uae_flag_raising.jpg\" alt=\"رفع علم الإمارات\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/uae_flag_celebrations.jpg\" alt=\"احتفال يوم العلم الإماراتي\" class=\"img-fluid\">\r\n</div>\r\n<p>العلم الإماراتي هو رمز للوحدة والسيادة والكرامة الوطنية، يجسد تطلعات الشعب الإماراتي نحو مزيد من التقدم والازدهار. لذلك، تمثل احتفالات يوم العلم فرصة لتأكيد الهوية الوطنية والتضامن والولاء للقيادة الحكيمة والوطن. فلنحتفل جميعاً بهذه المناسبة العزيزة ونجدد التزامنا بالمضي قدماً نحو آفاق جديدة من التنمية والازدهار للأجيال القادمة.</p>', NULL, 'published', '2023-11-03 10:00:00'),
(17, 1, 'از دست دادن دبیر فرهیخته؛ درگذشت جناب سید عباس ابطحی', '<p>با کمال تأسف و تأثر، درگذشت آموزگار گرانقدر جناب آقای سید عباس ابطحی را به اطلاع می‌رسانیم. ایشان که سالیان دراز در مدرسه ما تدریس کردند، نقش بسزایی در تربیت نسل‌های دانش‌آموز و انتقال میراث گرانبهای علم و اخلاق داشتند. آثار ماندگار آن زنده‌یاد، همواره در قلب و ذهن شاگردان و همکاران ایشان باقی خواهد ماند.</p>\r\n<p>ضایعه از دست دادن این آموزگار فرهیخته، موجب اندوه عمیق در جامعه فرهنگی و آموزشی است. یاد و خاطره ابطحی همچون نوری درخشان، راهگشای نسل‌های آینده در مسیر کمال و تعالی علمی و اخلاقی خواهد بود. ما از درگاه ایزد متعال برای آن مرحوم، علو درجات و برای بازماندگان محترمشان، صبر و اجر مسئلت داریم.</p>', NULL, 'published', '2024-05-27 00:00:00'),
(17, 2, 'Loss of an Erudite Mentor; Passing of Mr. Seyyed Abbas Abtahi', '<p>With profound sorrow and grief, we announce the passing of the esteemed mentor and wise teacher, Mr. Seyyed Abbas Abtahi. Having taught for many years at our school, he played a pivotal role in educating generations of students and imparting the invaluable heritage of knowledge and ethics. The enduring legacy of this departed soul will forever remain in the hearts and minds of his students and colleagues.</p>\r\n<p>The loss of this erudite mentor is a cause of deep sadness for the educational and cultural community. The memory of Abtahi will shine like a guiding light for future generations on the path of intellectual and ethical perfection and growth. We implore the Almighty God to elevate the ranks of the departed and bestow patience and reward upon his esteemed family.</p>', NULL, 'published', '2024-05-27 00:00:00'),
(17, 3, 'فقدان معلم عالم؛ وفاة السيد عباس أبطحي', '<p>بحزن عميق وأسى بالغ، نعلن وفاة المعلم المحترم والمدرس الحكيم، السيد عباس أبطحي. بعد أن درّس لسنوات عديدة في مدرستنا، لعب دوراً محورياً في تعليم أجيال من الطلاب ونقل الإرث الثمين للمعرفة والأخلاق. سيبقى الإرث الدائم لهذه الروح الراحلة إلى الأبد في قلوب وعقول طلابه وزملائه.</p>\r\n<p>إن فقدان هذا المعلم العالم يسبب حزناً عميقاً للمجتمع التعليمي والثقافي. ستشع ذكرى أبطحي كنور إرشادي للأجيال القادمة على طريق الكمال والنمو الفكري والأخلاقي. نتضرع إلى الله تعالى أن يرفع درجات الفقيد ويمنح الصبر والثواب لعائلته المحترمة.</p>', NULL, 'published', '2024-05-27 00:00:00'),
(18, 1, 'از دست دادن یار دیرین؛ درگذشت آقای راجو، خدمتگزار مدرسه', '<p>با اندوه فراوان، خبر درگذشت همکار عزیز و خدمتگزار دیرین مدرسه، جناب آقای راجو را اعلام می‌نماییم. وی که سال‌ها در کنار ما بود، با تلاش صادقانه و وفاداری خستگی‌ناپذیر، به مدرسه و دانش‌آموزان خدمت کرد. حضور گرم و لبخند همیشگی آقای راجو، روح تازه‌ای به محیط مدرسه می‌بخشید.</p>\r\n<p>از دست دادن این همکار قدیمی و محبوب، ضایعه‌ای جبران‌ناپذیر برای خانواده بزرگ مدرسه ماست. یاد و خاطره پرتلاش و پرافتخار ایشان، الگویی برای همه ما در خدمت صادقانه و بی‌ریا خواهد بود. ما برای آن مرحوم آرامش ابدی و برای خانواده محترمشان صبر و شکیبایی آرزو می‌کنیم.</p>', NULL, 'published', '2020-05-28 00:00:00'),
(18, 2, 'Losing a Long-Standing Companion; The Passing of Mr. Raju, School Staff', '<p>With profound sadness, we announce the passing of our beloved colleague and the school\'s long-serving staff member, Mr. Raju. For years by our side, he served the school and its students with sincere dedication and unwavering loyalty. Mr. Raju\'s warm presence and ever-present smile brought a fresh spirit to the school environment.</p>\r\n<p>Losing this cherished longtime companion is an irreparable loss for our school\'s large family. The hardworking and honorable memory of Mr. Raju will serve as a model for all of us in rendering sincere and selfless service. We pray for eternal peace for the departed soul and patience and fortitude for his esteemed family.</p>', NULL, 'published', '2020-05-28 00:00:00'),
(18, 3, 'فقدان رفيق دائم؛ وفاة السيد راجو، موظف المدرسة', '<p>بحزن عميق، نعلن وفاة زميلنا العزيز وموظف المدرسة الذي خدم لفترة طويلة، السيد راجو. كان بجانبنا لسنوات، خدم المدرسة وطلابها بتفانٍ صادق وولاء لا يتزعزع. أضفى حضور السيد راجو الدافئ وابتسامته الدائمة روحاً منعشة في بيئة المدرسة.</p>\r\n<p>إن فقدان هذا الرفيق طويل الأمد العزيز هو خسارة لا تعوض لعائلة مدرستنا الكبيرة. ستظل ذكرى السيد راجو المجدة والمشرفة نموذجاً لنا جميعاً في تقديم الخدمة الصادقة والمتفانية. ندعو بالسلام الأبدي للروح الراحلة وبالصبر والقوة لعائلته المحترمة.</p>', NULL, 'published', '2020-05-28 00:00:00'),
(19, 1, 'سرود مجتمع سلمان فارسی', '<p>شعر زیبا و الهام بخش این سرود توسط یکی از استعدادهای درخشان مدرسه سلمان در یک ماه پیش سروده شده است. کلمات این شعر سرشار از عشق به دانش، ایمان، میهن و غرور تعلق به مدرسه سلمان است.</p>\r\n<p>ملودی دلنشین و تنظیم احساسی این سرود کار آقای علی محمدی، فرزند استاد محمدرضا محمدی، می باشد. ایشان طی 3 هفته با تلاش مستمر این اثر زیبا را آفریدند.</p>\r\n<p>به زودی، اجرای همخوانی کرال این سرود با صدای گرم دانش آموزان مدرسه سلمان انجام خواهد شد. در ساز بندی این سرود از سازهای مارش به صورت دیجیتال استفاده شده، اما به منظور حفظ شادابی و طراوت آن، از ریتم های جذاب و مورد علاقه دانش آموزان بهره گرفته شده است.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/salman_anthem1.jpg\" alt=\"اجرای سرود مدرسه سلمان\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/salman_anthem2.jpg\" alt=\"گروه سرود مدرسه سلمان\" class=\"img-fluid\">\r\n</div>\r\n<p>متن سرود:</p>\r\n<p>میبالم از دانستن - شور از دانایی خیزد<br>سرشارم از آگاهی - چون با ایمان آمیزد<br>رویایی در نزدیکی - فانوسی در تاریکی<br>شوری در جانی پنهان - یادی از مهرم ایران<br>آغوشی باز از دانش - دنیایی از آرامش<br>کوه از ایمانش گوید - سرو از دامانش روید<br>تکه ای از بهشت است - مدرسه ام! ای جانم!<br>افتخارم همین بس! - دانش آموز سلمانم</p>\r\n<p>این سرود فاخر می تواند در آینده به عنوان سرود رسمی و نماد افتخار مدرسه سلمان مورد استفاده قرار گیرد. اجرای این سرود در مراسم های مختلف توسط دانش آموزان و کادر، روح غرور، همدلی، ایمان و عشق به میهن را در فضای مدرسه زنده نگه خواهد داشت. به امید اینکه این ترانه ماندگار در قلب ها جاودانه شود.</p>', NULL, 'published', '2020-05-25 00:00:00'),
(19, 2, 'The Melodious Hymn of Salman Farsi School', '<p>The beautiful and inspiring lyrics of this anthem were composed a month ago by one of Salman School\'s shining talents. The words of this poem are filled with love for knowledge, faith, homeland, and pride in belonging to Salman School.</p>\r\n<p>The enchanting melody and emotional arrangement of this anthem are the work of Master Ali Mohammadi, son of the great music master Mohammad Reza Mohammadi. He created this beautiful piece through three weeks of diligent effort.</p>\r\n<p>Soon, a choral performance of this anthem will be given by the warm voices of Salman School students. The anthem instrumentation utilizes digital marching band instruments, but to maintain its vibrancy and freshness, engaging and appealing rhythms for students have been employed.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/salman_anthem1.jpg\" alt=\"Salman School anthem performance\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/salman_anthem2.jpg\" alt=\"Salman School choir group\" class=\"img-fluid\">\r\n</div>\r\n<p>Anthem lyrics:</p>\r\n<p>I take pride in learning - passion arises from knowledge<br>I am brimming with awareness - as it blends with faith<br>A dream in proximity - a lantern in darkness<br>A zeal hidden in a soul - a reminder of my love for Iran<br>An embrace of knowledge - a world of tranquility<br>The mountain speaks of its faith - the cypress grows from its hem<br>It is a piece of paradise - my school! O my soul!<br>This alone is my pride! - A Salman student</p>\r\n<p>This prestigious anthem may be adopted as the official anthem and symbol of pride for Salman School in the future. Performing this anthem at various events by students and staff will keep the spirit of pride, unity, faith, and love for the homeland alive within the school environment. May this enduring song become eternal in our hearts.</p>', NULL, 'published', '2020-05-25 00:00:00'),
(19, 3, 'النشيد اللحني لمدرسة سلمان الفارسي', '<p>تم تأليف الكلمات الجميلة والملهمة لهذا النشيد قبل شهر من قبل أحد المواهب المتألقة في مدرسة سلمان. كلمات هذه القصيدة مليئة بالحب للمعرفة والإيمان والوطن والفخر بالانتماء إلى مدرسة سلمان.</p>\r\n<p>اللحن الساحر والترتيب العاطفي لهذا النشيد هو عمل الأستاذ علي محمدي، ابن أستاذ الموسيقى العظيم محمد رضا محمدي. أبدع هذه القطعة الجميلة من خلال ثلاثة أسابيع من الجهد المستمر.</p>\r\n<p>قريباً، سيتم تقديم أداء جماعي لهذا النشيد بأصوات طلاب مدرسة سلمان الدافئة. تستخدم آلات النشيد آلات فرقة المسيرة الرقمية، ولكن للحفاظ على حيويتها ونضارتها، تم استخدام إيقاعات جذابة ومحببة للطلاب.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/salman_anthem1.jpg\" alt=\"أداء نشيد مدرسة سلمان\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/salman_anthem2.jpg\" alt=\"مجموعة كورال مدرسة سلمان\" class=\"img-fluid\">\r\n</div>\r\n<p>كلمات النشيد:</p>\r\n<p>أفتخر بالتعلم - الشغف ينبع من المعرفة<br>أنا مفعم بالوعي - حين يمتزج بالإيمان<br>حلم قريب - فانوس في الظلام<br>حماس مخبأ في روح - تذكير بحبي لإيران<br>حضن من المعرفة - عالم من الهدوء<br>الجبل يتحدث عن إيمانه - السرو ينمو من حافته<br>إنها قطعة من الجنة - مدرستي! يا روحي!<br>هذا وحده فخري! - أنا طالب سلمان</p>\r\n<p>قد يتم اعتماد هذا النشيد المرموق كنشيد رسمي ورمز فخر لمدرسة سلمان في المستقبل. أداء هذا النشيد في مختلف المناسبات من قبل الطلاب والموظفين سيحافظ على روح الفخر والوحدة والإيمان وحب الوطن حية داخل بيئة المدرسة. عسى أن تصبح هذه الأغنية الدائمة خالدة في قلوبنا.</p>', NULL, 'published', '2020-05-25 00:00:00'),
(20, 1, 'بازدید دانش آموزان پایه ۱۱ و ۱۲ از دانشگاه عجمان', '<p>در یک برنامه ویژه، دانش آموزان پایه ۱۱ و ۱۲ مدرسه سلمان فارسی از دانشگاه عجمان بازدید کردند. این بازدید که با هماهنگی مدرسه و دانشگاه انجام شد، به دانش آموزان فرصت داد تا با محیط دانشگاه و امکانات آموزشی آن آشنا شوند و از تجربیات استادان و دانشجویان بهره‌مند گردند.</p>\r\n<p>در این بازدید، دانش آموزان با بخش‌های مختلف دانشگاه از جمله کتابخانه، آزمایشگاه‌ها، و مراکز تحقیقاتی آشنا شدند و در جلسات مشاوره تحصیلی و حرفه‌ای شرکت کردند. این تجربه باعث افزایش انگیزه و اشتیاق دانش آموزان برای ادامه تحصیل در مقاطع بالاتر شد.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/ajman_visit2.jpg\" alt=\"بازدید از دانشگاه عجمان\" class=\"img-fluid\">\r\n</div>\r\n<p>در پایان بازدید، دانش آموزان ضمن تشکر از مسئولان دانشگاه و مدرسه، از تجربیات خود در این بازدید رضایت کامل داشتند و از اطلاعات و آگاهی‌های کسب شده برای برنامه‌ریزی تحصیلی و حرفه‌ای آینده‌شان بهره‌مند خواهند شد.</p>', NULL, 'published', '2023-01-25 00:00:00'),
(20, 2, 'Visit of 11th and 12th Grade Students to Ajman University', '<p>In a special program, 11th and 12th-grade students from Salman Farsi School visited Ajman University. This visit, coordinated by the school and university, gave the students an opportunity to familiarize themselves with the university environment and its educational facilities, and to benefit from the experiences of professors and students.</p>\r\n<p>During this visit, students were introduced to various university departments, including the library, laboratories, and research centers, and participated in academic and career counseling sessions. This experience enhanced the students\' motivation and enthusiasm to pursue higher education.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/ajman_visit2.jpg\" alt=\"Visit to Ajman University\" class=\"img-fluid\">\r\n</div>\r\n<p>At the end of the visit, the students expressed their gratitude to the university and school officials and were completely satisfied with their experiences. They will use the knowledge and insights gained from this visit for their future academic and career planning.</p>', NULL, 'published', '2023-01-25 00:00:00'),
(20, 3, 'زيارة طلاب الصفين الحادي عشر والثاني عشر لجامعة عجمان', '<p>في برنامج خاص، قام طلاب الصفين الحادي عشر والثاني عشر من مدرسة سلمان الفارسي بزيارة جامعة عجمان. أتاحت هذه الزيارة، التي نسقتها المدرسة والجامعة، فرصة للطلاب للتعرف على بيئة الجامعة ومرافقها التعليمية، والاستفادة من خبرات الأساتذة والطلاب.</p>\r\n<p>خلال هذه الزيارة، تم تعريف الطلاب بمختلف أقسام الجامعة، بما في ذلك المكتبة والمختبرات ومراكز البحث، وشاركوا في جلسات الإرشاد الأكاديمي والمهني. عززت هذه التجربة دافع الطلاب وحماسهم لمتابعة التعليم العالي.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/ajman_visit2.jpg\" alt=\"زيارة إلى جامعة عجمان\" class=\"img-fluid\">\r\n</div>\r\n<p>في نهاية الزيارة، أعرب الطلاب عن امتنانهم لمسؤولي الجامعة والمدرسة وكانوا راضين تماماً عن تجاربهم. سيستخدمون المعرفة والرؤى المكتسبة من هذه الزيارة للتخطيط الأكاديمي والمهني المستقبلي.</p>', NULL, 'published', '2023-01-25 00:00:00'),
(21, 1, 'بازدید مجتمع سلمان فارسی از اکسپو ۲۰۲۰ دبی', '<p>در یک رویداد خاص، دانش آموزان و کارکنان مجتمع سلمان فارسی از اکسپو ۲۰۲۰ دبی بازدید کردند. این بازدید فرصتی بود برای آشنایی با جدیدترین فناوری‌ها، دستاوردهای علمی و فرهنگی کشورها از سراسر جهان. همچنین، این رویداد فرصتی برای تبادل فرهنگی و آشنایی با فرهنگ‌ها و سنت‌های مختلف بود.</p>\r\n<p>در طول بازدید، دانش آموزان و کارکنان مجتمع با غرفه‌های مختلفی از جمله فناوری، نوآوری، پایداری و فرهنگ آشنا شدند. آنان همچنین در برنامه‌های آموزشی و کارگاه‌های مختلفی شرکت کردند که به افزایش آگاهی و دانش آنان کمک کرد. این تجربه بی‌نظیر، به دانش آموزان انگیزه بیشتری برای پیگیری اهداف علمی و حرفه‌ای‌شان داد.</p>\r\n<p>در پایان بازدید، اعضای مجتمع ضمن تشکر از مسئولان اکسپو و مدرسه، از تجربیات خود در این بازدید رضایت کامل داشتند و از اطلاعات و آگاهی‌های کسب شده برای برنامه‌ریزی تحصیلی و حرفه‌ای آینده‌شان بهره‌مند خواهند شد. این بازدید نشان داد که آشنایی با دستاوردها و فرهنگ‌های مختلف جهان می‌تواند تاثیر بسزایی در رشد و توسعه فردی و جمعی داشته باشد.</p>', NULL, 'published', '2022-02-14 00:00:00'),
(21, 2, 'Visit of Salman Farsi Complex to Expo 2020 Dubai', '<p>In a special event, students and staff of the Salman Farsi Complex visited Expo 2020 Dubai. This visit provided an opportunity to explore the latest technologies, scientific and cultural achievements of countries from around the world. Additionally, it was a chance for cultural exchange and understanding of various cultures and traditions.</p>\r\n<p>During the visit, the students and staff explored various pavilions including technology, innovation, sustainability, and culture. They also participated in educational programs and workshops, which enhanced their awareness and knowledge. This unique experience motivated the students to pursue their academic and professional goals with greater enthusiasm.</p>\r\n<p>At the end of the visit, the members of the complex expressed their gratitude to the Expo and school officials and were completely satisfied with their experiences. They will use the knowledge and insights gained from this visit for their future academic and career planning. This visit demonstrated that understanding the achievements and cultures of different countries can have a significant impact on individual and collective growth and development.</p>', NULL, 'published', '2022-02-14 00:00:00'),
(21, 3, 'زيارة مجمع سلمان الفارسي إلى إكسبو 2020 دبي', '<p>في حدث خاص، قام طلاب وموظفو مجمع سلمان الفارسي بزيارة إكسبو 2020 دبي. أتاحت هذه الزيارة فرصة لاستكشاف أحدث التقنيات والإنجازات العلمية والثقافية للدول من جميع أنحاء العالم. بالإضافة إلى ذلك، كانت فرصة للتبادل الثقافي وفهم الثقافات والتقاليد المختلفة.</p>\r\n<p>خلال الزيارة، استكشف الطلاب والموظفون مختلف الأجنحة بما في ذلك التكنولوجيا والابتكار والاستدامة والثقافة. كما شاركوا في البرامج التعليمية وورش العمل، مما عزز وعيهم ومعرفتهم. حفزت هذه التجربة الفريدة الطلاب على متابعة أهدافهم الأكاديمية والمهنية بحماس أكبر.</p>\r\n<p>في نهاية الزيارة، أعرب أعضاء المجمع عن امتنانهم لمسؤولي المعرض والمدرسة وكانوا راضين تماماً عن تجاربهم. سيستخدمون المعرفة والرؤى المكتسبة من هذه الزيارة للتخطيط الأكاديمي والمهني المستقبلي. أظهرت هذه الزيارة أن فهم إنجازات وثقافات الدول المختلفة يمكن أن يكون له تأثير كبير على النمو والتطور الفردي والجماعي.</p>', NULL, 'published', '2022-02-14 00:00:00'),
(22, 1, 'گردش تفریحی دانش آموزان در سافاری پارک دوبی', '<p>در یک روز شاد و پر انرژی، دانش آموزان مجتمع سلمان فارسی به سافاری پارک دوبی رفتند. این گردش تفریحی فرصتی برای دانش آموزان فراهم کرد تا از نزدیک با حیوانات مختلف آشنا شوند و درباره‌ی زیستگاه‌های طبیعی آن‌ها اطلاعات کسب کنند.</p>\r\n<p>دانش آموزان با مشاهده‌ی حیوانات و شرکت در برنامه‌های آموزشی سافاری پارک، نه تنها لذت بردند بلکه با اهمیت حفظ محیط زیست و حفاظت از گونه‌های در حال انقراض نیز آشنا شدند. این تجربه به دانش آموزان این امکان را داد تا در فضایی متفاوت، به یادگیری و تفریح بپردازند و روزی به یادماندنی را سپری کنند.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/safari_park1.jpg\" alt=\"دانش آموزان در سافاری پارک دوبی\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/safari_park2.jpg\" alt=\"فعالیت‌های آموزشی در سافاری پارک\" class=\"img-fluid\">\r\n</div>\r\n<p>در پایان روز، دانش آموزان از تجربه‌ی خود در سافاری پارک ابراز رضایت کردند و از مسئولان مدرسه و پارک برای فراهم کردن این فرصت تشکر کردند. این گردش تفریحی نه تنها به دانش آموزان لحظاتی خوش و فراموش نشدنی هدیه داد بلکه به آنان کمک کرد تا با دیدی وسیع‌تر به طبیعت و حفاظت از آن نگاه کنند.</p>', NULL, 'published', '2023-01-31 00:00:00'),
(22, 2, 'Recreational Trip of Students to Dubai Safari Park', '<p>On a joyful and energetic day, the students of Salman Farsi Complex visited Dubai Safari Park. This recreational trip provided an opportunity for students to get acquainted with various animals up close and learn about their natural habitats.</p>\r\n<p>By observing the animals and participating in the educational programs of the Safari Park, the students not only enjoyed themselves but also learned about the importance of environmental conservation and protecting endangered species. This experience allowed the students to learn and have fun in a different setting, making it a memorable day.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/safari_park1.jpg\" alt=\"Students at Dubai Safari Park\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/safari_park2.jpg\" alt=\"Educational activities at Safari Park\" class=\"img-fluid\">\r\n</div>\r\n<p>At the end of the day, the students expressed their satisfaction with their experience at the Safari Park and thanked the school and park officials for providing this opportunity. This recreational trip not only gave the students happy and unforgettable moments but also helped them to look at nature and its conservation with a broader perspective.</p>', NULL, 'published', '2023-01-31 00:00:00'),
(22, 3, 'رحلة ترفيهية للطلاب إلى حديقة سفاري دبي', '<p>في يوم مفعم بالفرح والطاقة، قام طلاب مجمع سلمان الفارسي بزيارة حديقة سفاري دبي. أتاحت هذه الرحلة الترفيهية فرصة للطلاب للتعرف على مختلف الحيوانات عن قرب والتعلم عن موائلها الطبيعية.</p>\r\n<p>من خلال مراقبة الحيوانات والمشاركة في البرامج التعليمية للحديقة، لم يستمتع الطلاب فحسب، بل تعلموا أيضًا عن أهمية الحفاظ على البيئة وحماية الأنواع المهددة بالانقراض. سمحت هذه التجربة للطلاب بالتعلم والاستمتاع في بيئة مختلفة، مما جعلها يومًا لا يُنسى.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/safari_park1.jpg\" alt=\"الطلاب في حديقة سفاري دبي\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/safari_park2.jpg\" alt=\"الأنشطة التعليمية في حديقة السفاري\" class=\"img-fluid\">\r\n</div>\r\n<p>في نهاية اليوم، عبر الطلاب عن رضاهم عن تجربتهم في حديقة السفاري وشكروا مسؤولي المدرسة والحديقة على توفير هذه الفرصة. لم تقدم هذه الرحلة الترفيهية للطلاب لحظات سعيدة ولا تُنسى فحسب، بل ساعدتهم أيضًا على النظر إلى الطبيعة والحفاظ عليها بمنظور أوسع.</p>', NULL, 'published', '2023-01-31 00:00:00'),
(23, 1, 'مجتمع سلمان فارسی قهرمان مسابقات والیبال سرپرستی', '<p>با افتخار، مجتمع سلمان فارسی موفق به کسب عنوان قهرمانی در مسابقات والیبال سرپرستی شد. این مسابقات که با حضور تیم‌های برتر مدارس منطقه برگزار شد، فرصت مناسبی برای نمایش توانمندی‌ها و مهارت‌های ورزشی دانش آموزان فراهم آورد.</p>\r\n<p>تیم والیبال مجتمع سلمان فارسی با بازی‌های فوق‌العاده و هماهنگی مثال‌زدنی، توانست حریفان را شکست دهد و به مقام قهرمانی دست یابد. این پیروزی نتیجه تلاش، تمرین و همبستگی دانش آموزان و مربیان بود که با انگیزه و پشتکار، لحظاتی به یادماندنی را رقم زدند.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/volleyball_championship1.jpg\" alt=\"تیم والیبال سلمان فارسی\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/volleyball_championship2.jpg\" alt=\"مراسم اهدای جام قهرمانی\" class=\"img-fluid\">\r\n</div>\r\n<p>این قهرمانی نه تنها نشان از توانمندی و استعدادهای ورزشی دانش آموزان دارد، بلکه نمادی از تعهد و پشتکار آن‌ها در دستیابی به اهدافشان است. مجتمع سلمان فارسی از تمامی اعضای تیم، مربیان و مسئولانی که در این مسیر نقش داشتند، تقدیر و تشکر می‌نماید و امیدوار است که این موفقیت‌ها ادامه‌دار باشد.</p>', NULL, 'published', '2022-02-12 00:00:00'),
(23, 2, 'Salman Farsi Complex Wins Supervisory Volleyball Tournament', '<p>With pride, Salman Farsi Complex succeeded in winning the championship title in the Supervisory Volleyball Tournament. This tournament, held with the participation of the top school teams in the region, provided a great opportunity to showcase the students\' sports skills and abilities.</p>\r\n<p>The volleyball team of Salman Farsi Complex, with outstanding plays and exemplary coordination, managed to defeat their opponents and secure the championship title. This victory was the result of the students\' and coaches\' efforts, training, and solidarity, creating memorable moments.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/volleyball_championship1.jpg\" alt=\"Salman Farsi volleyball team\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/volleyball_championship2.jpg\" alt=\"Championship trophy ceremony\" class=\"img-fluid\">\r\n</div>\r\n<p>This championship not only highlights the sports talents and abilities of the students but also symbolizes their commitment and perseverance in achieving their goals. Salman Farsi Complex extends its appreciation to all team members, coaches, and officials who played a role in this journey and hopes that such successes continue.</p>', NULL, 'published', '2022-02-12 00:00:00'),
(23, 3, 'مجمع سلمان الفارسي يفوز ببطولة الكرة الطائرة الإشرافية', '<p>بكل فخر، نجح مجمع سلمان الفارسي في الفوز بلقب البطولة في دورة الكرة الطائرة الإشرافية. وفرت هذه البطولة، التي أقيمت بمشاركة أفضل فرق المدارس في المنطقة، فرصة رائعة لإظهار المهارات والقدرات الرياضية للطلاب.</p>\r\n<p>تمكن فريق الكرة الطائرة بمجمع سلمان الفارسي، بأداء متميز وتنسيق مثالي، من هزيمة منافسيه وتأمين لقب البطولة. كان هذا النصر نتيجة جهود الطلاب والمدربين وتدريباتهم وتضامنهم، مما خلق لحظات لا تُنسى.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/volleyball_championship1.jpg\" alt=\"فريق سلمان الفارسي للكرة الطائرة\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/volleyball_championship2.jpg\" alt=\"حفل تسليم كأس البطولة\" class=\"img-fluid\">\r\n</div>\r\n<p>لا تسلط هذه البطولة الضوء على المواهب والقدرات الرياضية للطلاب فحسب، بل ترمز أيضًا إلى التزامهم ومثابرتهم في تحقيق أهدافهم. يتقدم مجمع سلمان الفارسي بالشكر والتقدير لجميع أعضاء الفريق والمدربين والمسؤولين الذين لعبوا دورًا في هذه الرحلة ويأمل أن تستمر هذه النجاحات.</p>', NULL, 'published', '2022-02-12 00:00:00'),
(24, 1, 'حضور تیم سرپرستی و همکاران در مراسم شب یلدا و نمایشگاه کارهای دستی دانش‌آموزان', '<p>در مراسمی نمادین به مناسبت شب یلدا، تیم محترم سرپرستی و سایر همکاران محترم حضور به هم رساندند و از نمایشگاه کارهای دستی و هنری دانش آموزان عزیز در بخش احسان بازدید کردند. این مراسم که با هدف گرامیداشت سنت‌های ایرانی و نمایش خلاقیت‌های دانش آموزان برگزار شد، فضایی گرم و صمیمی را به وجود آورد.</p>\r\n<p>حضور تیم سرپرستی و همکاران در این مراسم، نشان از توجه و حمایت آنان از فعالیت‌های فرهنگی و هنری دانش آموزان داشت. بازدید از نمایشگاه کارهای دستی که شامل آثار هنری متنوع و خلاقانه دانش آموزان بود، فرصتی برای قدردانی از زحمات و استعدادهای آنان فراهم آورد.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/yalda_night1.jpg\" alt=\"مراسم شب یلدا\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/yalda_night2.jpg\" alt=\"نمایشگاه کارهای دستی دانش آموزان\" class=\"img-fluid\">\r\n</div>\r\n<p>در پایان مراسم، تیم سرپرستی و همکاران محترم از تلاش‌ها و خلاقیت‌های دانش آموزان تقدیر کردند و بر اهمیت استمرار چنین فعالیت‌های فرهنگی و هنری تأکید نمودند. این گونه مراسم‌ها نه تنها باعث تقویت روحیه دانش آموزان می‌شود بلکه به رشد و شکوفایی استعدادهای آنان کمک می‌کند.</p>', NULL, 'published', '2021-12-08 00:00:00'),
(24, 2, 'Supervisory Team and Colleagues Attend Yalda Night Ceremony and Students\' Handicrafts Exhibition', '<p>In a symbolic ceremony on the occasion of Yalda Night, the esteemed supervisory team and other respected colleagues attended and visited the exhibition of students\' handicrafts and artworks in the Ehsan section. This ceremony, held to honor Iranian traditions and showcase students\' creativity, created a warm and friendly atmosphere.</p>\r\n<p>The presence of the supervisory team and colleagues at this ceremony demonstrated their attention and support for the cultural and artistic activities of the students. Visiting the handicrafts exhibition, which included a variety of creative artworks by the students, provided an opportunity to appreciate their efforts and talents.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/yalda_night1.jpg\" alt=\"Yalda Night ceremony\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/yalda_night2.jpg\" alt=\"Students\' handicrafts exhibition\" class=\"img-fluid\">\r\n</div>\r\n<p>At the end of the ceremony, the supervisory team and respected colleagues appreciated the students\' efforts and creativity and emphasized the importance of continuing such cultural and artistic activities. Such ceremonies not only boost students\' morale but also help in the growth and flourishing of their talents.</p>', NULL, 'published', '2021-12-08 00:00:00'),
(24, 3, 'فريق الإشراف والزملاء يحضرون احتفال ليلة يلدا ومعرض الأشغال اليدوية للطلاب', '<p>في احتفال رمزي بمناسبة ليلة يلدا، حضر فريق الإشراف المحترم والزملاء المحترمون الآخرون وزاروا معرض الأشغال اليدوية والأعمال الفنية للطلاب في قسم إحسان. خلق هذا الاحتفال، الذي أقيم لتكريم التقاليد الإيرانية وعرض إبداعات الطلاب، جوًا دافئًا وودودًا.</p>\r\n<p>أظهر حضور فريق الإشراف والزملاء في هذا الاحتفال اهتمامهم ودعمهم للأنشطة الثقافية والفنية للطلاب. وفرت زيارة معرض الأشغال اليدوية، الذي تضمن مجموعة متنوعة من الأعمال الفنية الإبداعية للطلاب، فرصة لتقدير جهودهم ومواهبهم.</p>\r\n<div class=\"post-images\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/yalda_night1.jpg\" alt=\"احتفال ليلة يلدا\" class=\"img-fluid\">\r\n  <img src=\"assets/images/blog/Extra_Post_Images/yalda_night2.jpg\" alt=\"معرض الأشغال اليدوية للطلاب\" class=\"img-fluid\">\r\n</div>\r\n<p>في نهاية الاحتفال، قدّر فريق الإشراف والزملاء المحترمون جهود الطلاب وإبداعهم وأكدوا على أهمية استمرار مثل هذه الأنشطة الثقافية والفنية. لا تعزز مثل هذه الاحتفالات معنويات الطلاب فحسب، بل تساعد أيضًا في نمو وازدهار مواهبهم.</p>', NULL, 'published', '2021-12-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `post_widgets`
--

CREATE TABLE `post_widgets` (
  `id` int(11) NOT NULL,
  `widget_key` varchar(50) NOT NULL COMMENT 'کلید شناسایی ویجت',
  `is_enabled` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'آیا ویجت فعال است؟',
  `position` varchar(50) NOT NULL DEFAULT 'sidebar' COMMENT 'موقعیت ویجت (sidebar, content)',
  `sort_order` int(11) NOT NULL DEFAULT 0 COMMENT 'ترتیب نمایش',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_widgets`
--

INSERT INTO `post_widgets` (`id`, `widget_key`, `is_enabled`, `position`, `sort_order`, `updated_at`) VALUES
(1, 'search', 1, 'sidebar', 1, '2025-03-30 13:49:48'),
(2, 'latest_posts', 1, 'sidebar', 2, '2025-03-30 13:49:48'),
(3, 'categories', 1, 'sidebar', 3, '2025-03-30 13:49:48'),
(4, 'popular_posts', 1, 'sidebar', 4, '2025-03-30 13:49:48'),
(5, 'related_posts', 1, 'content', 1, '2025-03-30 13:49:48'),
(6, 'author_info', 1, 'content', 2, '2025-03-30 13:49:48'),
(7, 'tags', 1, 'content', 3, '2025-03-30 13:49:48'),
(8, 'share', 1, 'content', 4, '2025-03-30 13:49:48');

-- --------------------------------------------------------

--
-- Table structure for table `privacy_content`
--

CREATE TABLE `privacy_content` (
  `id` int(11) NOT NULL,
  `field_key` varchar(255) NOT NULL COMMENT 'کلید شناسایی محتوا',
  `content` text DEFAULT NULL COMMENT 'محتوای اصلی',
  `language_id` varchar(5) NOT NULL COMMENT 'کد زبان (fa, en, ar)',
  `is_repeatable` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'آیا این محتوا تکرارشونده است؟',
  `section_id` varchar(50) DEFAULT NULL COMMENT 'شناسه بخش برای گروه‌بندی',
  `sort_order` int(11) NOT NULL DEFAULT 0 COMMENT 'ترتیب نمایش آیتم‌های تکرارشونده',
  `image_path` varchar(255) DEFAULT NULL COMMENT 'مسیر فایل تصویر',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `privacy_content`
--

INSERT INTO `privacy_content` (`id`, `field_key`, `content`, `language_id`, `is_repeatable`, `section_id`, `sort_order`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 'page_title', 'سیاست حفظ حریم خصوصی', 'fa', 0, 'header', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:35:39'),
(2, 'page_title', 'Privacy Policy', 'en', 0, 'header', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(3, 'page_title', 'سياسة الخصوصية', 'ar', 0, 'header', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(4, 'page_subtitle', 'اطلاعات مهم درباره نحوه مدیریت اطلاعات شخصی شما', 'fa', 0, 'header', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(5, 'page_subtitle', 'Important information about how we manage your personal data', 'en', 0, 'header', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(6, 'page_subtitle', 'معلومات مهمة حول كيفية إدارة بياناتك الشخصية', 'ar', 0, 'header', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(7, 'intro_title', 'مقدمه', 'fa', 0, 'introduction', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(8, 'intro_title', 'Introduction', 'en', 0, 'introduction', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(9, 'intro_title', 'مقدمة', 'ar', 0, 'introduction', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(10, 'intro_text_1', 'در مجتمع آموزشی سلمان فارسی، ما به حریم خصوصی شما احترام می‌گذاریم و متعهد به حفاظت از اطلاعات شخصی شما هستیم. این سیاست حریم خصوصی توضیح می‌دهد که چگونه اطلاعات شما را هنگام بازدید از وب‌سایت ما یا استفاده از خدمات ما جمع‌آوری، استفاده و محافظت می‌کنیم. لطفاً این سیاست را با دقت مطالعه کنید تا از شیوه‌های ما در مورد اطلاعات شخصی شما آگاه شوید.', 'fa', 0, 'introduction', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(11, 'intro_text_1', 'At Salman Educational Complex, we respect your privacy and are committed to protecting your personal data. This Privacy Policy explains how we collect, use, and safeguard your information when you visit our website or use our services. Please read this policy carefully to understand our practices regarding your personal data.', 'en', 0, 'introduction', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(12, 'intro_text_1', 'في مجمع سلمان التعليمي، نحترم خصوصيتك ونلتزم بحماية بياناتك الشخصية. توضح سياسة الخصوصية هذه كيفية جمع واستخدام وحماية معلوماتك عند زيارة موقعنا الإلكتروني أو استخدام خدماتنا. يرجى قراءة هذه السياسة بعناية لفهم ممارساتنا المتعلقة ببياناتك الشخصية.', 'ar', 0, 'introduction', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(13, 'intro_text_2', 'این سیاست در مورد تمام اطلاعاتی که از طریق وب‌سایت ما و همچنین هرگونه خدمات، فروش، بازاریابی یا رویدادهای مرتبط جمع‌آوری می‌شود، اعمال می‌شود. با دسترسی به وب‌سایت و خدمات ما، شما با شرایط مندرج در این سیاست موافقت می‌کنید.', 'fa', 0, 'introduction', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(14, 'intro_text_2', 'This policy applies to all information collected through our website, as well as any related services, sales, marketing, or events. By accessing our website and services, you agree to the terms outlined in this policy.', 'en', 0, 'introduction', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(15, 'intro_text_2', 'تنطبق هذه السياسة على جميع المعلومات التي يتم جمعها من خلال موقعنا على الويب، وكذلك أي خدمات أو مبيعات أو تسويق أو أحداث ذات صلة. من خلال الوصول إلى موقعنا وخدماتنا، فإنك توافق على الشروط الموضحة في هذه السياسة.', 'ar', 0, 'introduction', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(16, 'intro_callout', 'این سیاست حریم خصوصی در مورد تمام اطلاعات جمع‌آوری شده توسط مجتمع آموزشی سلمان فارسی صدق می‌کند.', 'fa', 0, 'introduction', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(17, 'intro_callout', 'This Privacy Policy applies to all information collected by Salman Farsi Educational Complex.', 'en', 0, 'introduction', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(18, 'intro_callout', 'تنطبق سياسة الخصوصية هذه على جميع المعلومات التي يجمعها مجمع سلمان الفارسي التعليمي.', 'ar', 0, 'introduction', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(19, 'collection_title', 'اطلاعاتی که جمع‌آوری می‌کنیم', 'fa', 0, 'collection', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(20, 'collection_title', 'Information We Collect', 'en', 0, 'collection', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(21, 'collection_title', 'المعلومات التي نجمعها', 'ar', 0, 'collection', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(22, 'collection_text_1', 'ما اطلاعات شخصی را که داوطلبانه هنگام ثبت‌نام در وب‌سایت ما، ابراز علاقه به کسب اطلاعات درباره ما یا محصولات و خدمات ما، شرکت در فعالیت‌های وب‌سایت، یا تماس با ما ارائه می‌دهید، جمع‌آوری می‌کنیم.', 'fa', 0, 'collection', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(23, 'collection_text_1', 'We collect personal information that you voluntarily provide to us when you register on our website, express interest in obtaining information about us or our products and services, participate in activities on the website, or otherwise contact us.', 'en', 0, 'collection', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(24, 'collection_text_1', 'نقوم بجمع المعلومات الشخصية التي تقدمها لنا طواعية عند التسجيل في موقعنا، أو التعبير عن اهتمامك بالحصول على معلومات عنا أو عن منتجاتنا وخدماتنا، أو المشاركة في الأنشطة على الموقع، أو الاتصال بنا.', 'ar', 0, 'collection', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(25, 'collection_text_2', 'اطلاعات شخصی که ما جمع‌آوری می‌کنیم ممکن است شامل موارد زیر باشد:', 'fa', 0, 'collection', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(26, 'collection_text_2', 'The personal information we collect may include:', 'en', 0, 'collection', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(27, 'collection_text_2', 'قد تشمل المعلومات الشخصية التي نجمعها ما يلي:', 'ar', 0, 'collection', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(28, 'collection_subtitle_1', 'اطلاعات دانش‌آموزان و والدین', 'fa', 0, 'collection', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(29, 'collection_subtitle_1', 'Student and Parent Information', 'en', 0, 'collection', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(30, 'collection_subtitle_1', 'معلومات الطلاب وأولياء الأمور', 'ar', 0, 'collection', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(31, 'collection_subtitle_2', 'اطلاعات آنلاین و وب‌سایت', 'fa', 0, 'collection', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(32, 'collection_subtitle_2', 'Online and Website Information', 'en', 0, 'collection', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(33, 'collection_subtitle_2', 'معلومات الإنترنت والموقع الإلكتروني', 'ar', 0, 'collection', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(34, 'collection_text_3', 'ما همچنین هنگام بازدید شما از وب‌سایت ما، اطلاعات خاصی را به طور خودکار جمع‌آوری می‌کنیم، از جمله:', 'fa', 0, 'collection', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(35, 'collection_text_3', 'We also automatically collect certain information when you visit our website, including:', 'en', 0, 'collection', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(36, 'collection_text_3', 'نقوم أيضًا بجمع معلومات معينة تلقائيًا عند زيارتك لموقعنا، بما في ذلك:', 'ar', 0, 'collection', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(37, 'collection_item_1', 'نام، آدرس ایمیل، شماره تلفن و اطلاعات تماس تجاری', 'fa', 1, 'collection_items_1', 1, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(38, 'collection_item_1', 'Names, email addresses, phone numbers, and business contact details', 'en', 1, 'collection_items_1', 1, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(39, 'collection_item_1', 'الأسماء وعناوين البريد الإلكتروني وأرقام الهواتف وتفاصيل الاتصال التجارية', 'ar', 1, 'collection_items_1', 1, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(40, 'collection_item_2', 'اطلاعات صورتحساب و پرداخت', 'fa', 1, 'collection_items_1', 2, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(41, 'collection_item_2', 'Billing and payment information', 'en', 1, 'collection_items_1', 2, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(42, 'collection_item_2', 'معلومات الفواتير والدفع', 'ar', 1, 'collection_items_1', 2, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(43, 'collection_item_3', 'اعتبارنامه‌های کاربر (نام کاربری، رمز عبور)', 'fa', 1, 'collection_items_1', 3, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(44, 'collection_item_3', 'User credentials (usernames, passwords)', 'en', 1, 'collection_items_1', 3, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(45, 'collection_item_3', 'بيانات اعتماد المستخدم (أسماء المستخدمين وكلمات المرور)', 'ar', 1, 'collection_items_1', 3, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(46, 'collection_item_4', 'اطلاعات پروفایل و ترجیحات', 'fa', 1, 'collection_items_1', 4, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(47, 'collection_item_4', 'Profile information and preferences', 'en', 1, 'collection_items_1', 4, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(48, 'collection_item_4', 'معلومات الملف الشخصي والتفضيلات', 'ar', 1, 'collection_items_1', 4, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(49, 'collection_item_5', 'بازخورد، پاسخ‌های نظرسنجی و گواهی‌نامه‌ها', 'fa', 1, 'collection_items_1', 5, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(50, 'collection_item_5', 'Feedback, survey responses, and testimonials', 'en', 1, 'collection_items_1', 5, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(51, 'collection_item_5', 'التعليقات واستجابات الاستطلاع والشهادات', 'ar', 1, 'collection_items_1', 5, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(52, 'collection_item_6', 'آدرس‌های IP و اطلاعات دستگاه', 'fa', 1, 'collection_items_2', 1, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(53, 'collection_item_6', 'IP addresses and device information', 'en', 1, 'collection_items_2', 1, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(54, 'collection_item_6', 'عناوين IP ومعلومات الجهاز', 'ar', 1, 'collection_items_2', 1, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(55, 'collection_item_7', 'نوع مرورگر و تنظیمات', 'fa', 1, 'collection_items_2', 2, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(56, 'collection_item_7', 'Browser type and settings', 'en', 1, 'collection_items_2', 2, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(57, 'collection_item_7', 'نوع المتصفح والإعدادات', 'ar', 1, 'collection_items_2', 2, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(58, 'collection_item_8', 'داده‌های استفاده و تاریخچه مرور در وب‌سایت ما', 'fa', 1, 'collection_items_2', 3, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(59, 'collection_item_8', 'Usage data and browsing history on our website', 'en', 1, 'collection_items_2', 3, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(60, 'collection_item_8', 'بيانات الاستخدام وتاريخ التصفح على موقعنا', 'ar', 1, 'collection_items_2', 3, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(61, 'collection_item_9', 'کوکی‌ها و فناوری‌های ردیابی مشابه', 'fa', 1, 'collection_items_2', 4, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(62, 'collection_item_9', 'Cookies and similar tracking technologies', 'en', 1, 'collection_items_2', 4, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(63, 'collection_item_9', 'ملفات تعريف الارتباط وتقنيات التتبع المماثلة', 'ar', 1, 'collection_items_2', 4, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(64, 'usage_title', 'چگونه از اطلاعات شما استفاده می‌کنیم', 'fa', 0, 'usage', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(65, 'usage_title', 'How We Use Your Information', 'en', 0, 'usage', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(66, 'usage_title', 'كيف نستخدم معلوماتك', 'ar', 0, 'usage', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(67, 'usage_text', 'ما از اطلاعاتی که جمع‌آوری می‌کنیم برای اهداف تجاری مختلف استفاده می‌کنیم، از جمله:', 'fa', 0, 'usage', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(68, 'usage_text', 'We use the information we collect for various business purposes, including:', 'en', 0, 'usage', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(69, 'usage_text', 'نستخدم المعلومات التي نجمعها لأغراض تجارية مختلفة، بما في ذلك:', 'ar', 0, 'usage', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(70, 'usage_item_1', 'ارائه، بهره‌برداری و نگهداری وب‌سایت و خدمات ما', 'fa', 1, 'usage_items', 1, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(71, 'usage_item_1', 'Providing, operating, and maintaining our website and services', 'en', 1, 'usage_items', 1, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(72, 'usage_item_1', 'توفير وتشغيل وصيانة موقعنا وخدماتنا', 'ar', 1, 'usage_items', 1, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(73, 'usage_item_2', 'بهبود، شخصی‌سازی و گسترش خدمات ما', 'fa', 1, 'usage_items', 2, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(74, 'usage_item_2', 'Improving, personalizing, and expanding our offerings', 'en', 1, 'usage_items', 2, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(75, 'usage_item_2', 'تحسين وتخصيص وتوسيع عروضنا', 'ar', 1, 'usage_items', 2, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(76, 'usage_item_3', 'درک چگونگی تعامل شما با وب‌سایت ما', 'fa', 1, 'usage_items', 3, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(77, 'usage_item_3', 'Understanding how you interact with our website', 'en', 1, 'usage_items', 3, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(78, 'usage_item_3', 'فهم كيفية تفاعلك مع موقعنا', 'ar', 1, 'usage_items', 3, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(79, 'usage_item_4', 'توسعه محصولات، خدمات و ویژگی‌های جدید', 'fa', 1, 'usage_items', 4, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(80, 'usage_item_4', 'Developing new products, services, and features', 'en', 1, 'usage_items', 4, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(81, 'usage_item_4', 'تطوير منتجات وخدمات وميزات جديدة', 'ar', 1, 'usage_items', 4, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(82, 'usage_item_5', 'ارتباط با شما در مورد به‌روزرسانی‌ها، هشدارهای امنیتی و پشتیبانی', 'fa', 1, 'usage_items', 5, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(83, 'usage_item_5', 'Communicating with you about updates, security alerts, and support', 'en', 1, 'usage_items', 5, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(84, 'usage_item_5', 'التواصل معك بشأن التحديثات وتنبيهات الأمان والدعم', 'ar', 1, 'usage_items', 5, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(85, 'usage_item_6', 'ارسال ارتباطات بازاریابی و تبلیغاتی (با رضایت شما)', 'fa', 1, 'usage_items', 6, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(86, 'usage_item_6', 'Sending marketing and promotional communications (with your consent)', 'en', 1, 'usage_items', 6, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(87, 'usage_item_6', 'إرسال اتصالات تسويقية وترويجية (بموافقتك)', 'ar', 1, 'usage_items', 6, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(88, 'usage_item_7', 'محافظت در برابر فعالیت‌های تقلبی، غیرمجاز یا غیرقانونی', 'fa', 1, 'usage_items', 7, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(89, 'usage_item_7', 'Protecting against fraudulent, unauthorized, or illegal activity', 'en', 1, 'usage_items', 7, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(90, 'usage_item_7', 'الحماية من الأنشطة الاحتيالية أو غير المصرح بها أو غير القانونية', 'ar', 1, 'usage_items', 7, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(91, 'sharing_title', 'اشتراک‌گذاری اطلاعات', 'fa', 0, 'sharing', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(92, 'sharing_title', 'Information Sharing', 'en', 0, 'sharing', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(93, 'sharing_title', 'مشاركة المعلومات', 'ar', 0, 'sharing', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(94, 'sharing_text', 'ما اطلاعات شخصی شما را فقط در موارد زیر به اشتراک می‌گذاریم:', 'fa', 0, 'sharing', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(95, 'sharing_text', 'We only share your personal information in the following situations:', 'en', 0, 'sharing', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(96, 'sharing_text', 'نشارك معلوماتك الشخصية فقط في الحالات التالية:', 'ar', 0, 'sharing', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(97, 'sharing_item_1_title', 'با ارائه‌دهندگان خدمات:', 'fa', 1, 'sharing_items', 1, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(98, 'sharing_item_1_title', 'With Service Providers:', 'en', 1, 'sharing_items', 1, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(99, 'sharing_item_1_title', 'مع مقدمي الخدمات:', 'ar', 1, 'sharing_items', 1, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(100, 'sharing_item_1_text', 'ما ممکن است اطلاعات شما را با فروشندگان و ارائه‌دهندگان خدمات شخص ثالثی که خدماتی مانند پردازش پرداخت، تجزیه و تحلیل داده، تحویل ایمیل، میزبانی و خدمات مشتری را برای ما انجام می‌دهند، به اشتراک بگذاریم.', 'fa', 1, 'sharing_items', 1, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(101, 'sharing_item_1_text', 'We may share your information with third-party vendors and service providers who perform services for us, such as payment processing, data analysis, email delivery, hosting, and customer service.', 'en', 1, 'sharing_items', 1, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(102, 'sharing_item_1_text', 'قد نشارك معلوماتك مع البائعين ومقدمي الخدمات من جهات خارجية الذين يؤدون خدمات لنا، مثل معالجة الدفع، وتحليل البيانات، وتسليم البريد الإلكتروني، والاستضافة، وخدمة العملاء.', 'ar', 1, 'sharing_items', 1, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(103, 'sharing_item_2_title', 'انتقال‌های تجاری:', 'fa', 1, 'sharing_items', 2, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(104, 'sharing_item_2_title', 'Business Transfers:', 'en', 1, 'sharing_items', 2, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(105, 'sharing_item_2_title', 'عمليات نقل الأعمال:', 'ar', 1, 'sharing_items', 2, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(106, 'sharing_item_2_text', 'ما ممکن است اطلاعات شما را در ارتباط با ادغام، تملک، سازماندهی مجدد یا فروش تمام یا بخشی از دارایی‌های شرکت خود به اشتراک بگذاریم یا منتقل کنیم.', 'fa', 1, 'sharing_items', 2, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(107, 'sharing_item_2_text', 'We may share or transfer your information in connection with a merger, acquisition, reorganization, or sale of all or a portion of our company assets.', 'en', 1, 'sharing_items', 2, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(108, 'sharing_item_2_text', 'قد نشارك أو ننقل معلوماتك فيما يتعلق بالاندماج أو الاستحواذ أو إعادة التنظيم أو بيع كل أو جزء من أصول شركتنا.', 'ar', 1, 'sharing_items', 2, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(109, 'sharing_item_3_title', 'تعهدات قانونی:', 'fa', 1, 'sharing_items', 3, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(110, 'sharing_item_3_title', 'Legal Obligations:', 'en', 1, 'sharing_items', 3, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(111, 'sharing_item_3_title', 'الالتزامات القانونية:', 'ar', 1, 'sharing_items', 3, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(112, 'sharing_item_3_text', 'ما ممکن است اطلاعات شما را در جایی که قانون الزام می‌کند یا اگر معتقد باشیم که افشای اطلاعات برای محافظت از حقوق ما یا رعایت یک رسیدگی قضایی، دستور دادگاه یا فرآیند قانونی ضروری است، افشا کنیم.', 'fa', 1, 'sharing_items', 3, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(113, 'sharing_item_3_text', 'We may disclose your information where required by law or if we believe disclosure is necessary to protect our rights or comply with a judicial proceeding, court order, or legal process.', 'en', 1, 'sharing_items', 3, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(114, 'sharing_item_3_text', 'قد نكشف عن معلوماتك حيث يقتضي القانون ذلك أو إذا كنا نعتقد أن الإفصاح ضروري لحماية حقوقنا أو الامتثال لإجراء قضائي أو أمر محكمة أو عملية قانونية.', 'ar', 1, 'sharing_items', 3, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(115, 'sharing_item_4_title', 'با رضایت شما:', 'fa', 1, 'sharing_items', 4, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(116, 'sharing_item_4_title', 'With Your Consent:', 'en', 1, 'sharing_items', 4, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(117, 'sharing_item_4_title', 'بموافقتك:', 'ar', 1, 'sharing_items', 4, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(118, 'sharing_item_4_text', 'ما ممکن است اطلاعات شخصی شما را با اشخاص ثالث به اشتراک بگذاریم، هنگامی که شما رضایت خود را به ما داده‌اید.', 'fa', 1, 'sharing_items', 4, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(119, 'sharing_item_4_text', 'We may share your personal information with third parties when you have given us consent to do so.', 'en', 1, 'sharing_items', 4, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(120, 'sharing_item_4_text', 'قد نشارك معلوماتك الشخصية مع أطراف ثالثة عندما تعطينا موافقتك على القيام بذلك.', 'ar', 1, 'sharing_items', 4, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(121, 'security_title', 'امنیت داده‌ها', 'fa', 0, 'security', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(122, 'security_title', 'Data Security', 'en', 0, 'security', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(123, 'security_title', 'أمن البيانات', 'ar', 0, 'security', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(124, 'security_text_1', 'ما اقدامات امنیتی فنی و سازمانی مناسبی را برای محافظت از امنیت اطلاعات شخصی شما اجرا می‌کنیم. با این حال، لطفاً توجه داشته باشید که هیچ روش انتقال از طریق اینترنت یا روش ذخیره‌سازی الکترونیکی ۱۰۰٪ ایمن نیست. در حالی که ما تلاش می‌کنیم از روش‌های قابل قبول تجاری برای محافظت از اطلاعات شخصی شما استفاده کنیم، نمی‌توانیم امنیت مطلق آن را تضمین کنیم.', 'fa', 0, 'security', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(125, 'security_text_1', 'We implement appropriate technical and organizational security measures to protect the security of your personal information. However, please be aware that no method of transmission over the Internet or method of electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your personal information, we cannot guarantee its absolute security.', 'en', 0, 'security', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(126, 'security_text_1', 'نقوم بتنفيذ تدابير أمنية تقنية وتنظيمية مناسبة لحماية أمن معلوماتك الشخصية. ومع ذلك، يرجى العلم أنه لا توجد طريقة للإرسال عبر الإنترنت أو طريقة للتخزين الإلكتروني آمنة بنسبة 100%. بينما نسعى جاهدين لاستخدام وسائل مقبولة تجاريًا لحماية معلوماتك الشخصية، لا يمكننا ضمان أمنها المطلق.', 'ar', 0, 'security', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(127, 'security_text_2', 'ما اقدامات امنیتی زیر را حفظ می‌کنیم:', 'fa', 0, 'security', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(128, 'security_text_2', 'We maintain security measures including:', 'en', 0, 'security', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(129, 'security_text_2', 'نحافظ على تدابير أمنية تشمل:', 'ar', 0, 'security', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(130, 'security_item_1', 'رمزگذاری داده‌های حساس', 'fa', 1, 'security_items', 1, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(131, 'security_item_1', 'Encryption of sensitive data', 'en', 1, 'security_items', 1, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(132, 'security_item_1', 'تشفير البيانات الحساسة', 'ar', 1, 'security_items', 1, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(133, 'security_item_2', 'شبکه‌های امن و کنترل‌های دسترسی', 'fa', 1, 'security_items', 2, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(134, 'security_item_2', 'Secure networks and access controls', 'en', 1, 'security_items', 2, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(135, 'security_item_2', 'الشبكات الآمنة وضوابط الوصول', 'ar', 1, 'security_items', 2, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(136, 'security_item_3', 'ارزیابی‌های امنیتی منظم', 'fa', 1, 'security_items', 3, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(137, 'security_item_3', 'Regular security assessments', 'en', 1, 'security_items', 3, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(138, 'security_item_3', 'تقييمات أمنية منتظمة', 'ar', 1, 'security_items', 3, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(139, 'security_item_4', 'آموزش کارکنان در مورد حفاظت از داده‌ها', 'fa', 1, 'security_items', 4, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(140, 'security_item_4', 'Staff training on data protection', 'en', 1, 'security_items', 4, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(141, 'security_item_4', 'تدريب الموظفين على حماية البيانات', 'ar', 1, 'security_items', 4, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(142, 'cookies_title', 'کوکی‌ها و فناوری‌های ردیابی', 'fa', 0, 'cookies', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(143, 'cookies_title', 'Cookies and Tracking Technologies', 'en', 0, 'cookies', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(144, 'cookies_title', 'ملفات تعريف الارتباط وتقنيات التتبع', 'ar', 0, 'cookies', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(145, 'cookies_text_1', 'ما از کوکی‌ها و فناوری‌های ردیابی مشابه برای پیگیری فعالیت در وب‌سایت خود و ذخیره برخی اطلاعات استفاده می‌کنیم. کوکی‌ها فایل‌هایی با مقدار کمی داده هستند که ممکن است شامل یک شناسه منحصر به فرد ناشناس باشند. آنها از یک وب‌سایت به مرورگر شما ارسال می‌شوند و روی دستگاه شما ذخیره می‌شوند.', 'fa', 0, 'cookies', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(146, 'cookies_text_1', 'We use cookies and similar tracking technologies to track activity on our website and store certain information. Cookies are files with a small amount of data which may include an anonymous unique identifier. They are sent to your browser from a website and stored on your device.', 'en', 0, 'cookies', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(147, 'cookies_text_1', 'نستخدم ملفات تعريف الارتباط وتقنيات التتبع المماثلة لتتبع النشاط على موقعنا وتخزين معلومات معينة. ملفات تعريف الارتباط هي ملفات تحتوي على كمية صغيرة من البيانات التي قد تتضمن معرّفًا فريدًا مجهولاً. يتم إرسالها إلى متصفحك من موقع ويب ويتم تخزينها على جهازك.', 'ar', 0, 'cookies', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(148, 'cookies_text_2', 'شما می‌توانید به مرورگر خود دستور دهید تا همه کوکی‌ها را رد کند یا زمانی که یک کوکی ارسال می‌شود را نشان دهد. با این حال، اگر کوکی‌ها را نپذیرید، ممکن است نتوانید از برخی بخش‌های وب‌سایت ما استفاده کنید.', 'fa', 0, 'cookies', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(149, 'cookies_text_2', 'You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of our website.', 'en', 0, 'cookies', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(150, 'cookies_text_2', 'يمكنك توجيه متصفحك لرفض جميع ملفات تعريف الارتباط أو للإشارة عند إرسال ملف تعريف ارتباط. ومع ذلك، إذا كنت لا تقبل ملفات تعريف الارتباط، فقد لا تتمكن من استخدام بعض أجزاء من موقعنا.', 'ar', 0, 'cookies', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(151, 'cookies_text_3', 'ما از انواع کوکی‌های زیر استفاده می‌کنیم:', 'fa', 0, 'cookies', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(152, 'cookies_text_3', 'We use the following types of cookies:', 'en', 0, 'cookies', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(153, 'cookies_text_3', 'نستخدم الأنواع التالية من ملفات تعريف الارتباط:', 'ar', 0, 'cookies', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(154, 'cookies_item_1_title', 'کوکی‌های ضروری:', 'fa', 1, 'cookies_items', 1, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(155, 'cookies_item_1_title', 'Essential Cookies:', 'en', 1, 'cookies_items', 1, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(156, 'cookies_item_1_title', 'ملفات تعريف الارتباط الأساسية:', 'ar', 1, 'cookies_items', 1, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(157, 'cookies_item_1_text', 'برای عملکرد صحیح وب‌سایت ضروری هستند', 'fa', 1, 'cookies_items', 1, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(158, 'cookies_item_1_text', 'Necessary for the website to function properly', 'en', 1, 'cookies_items', 1, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(159, 'cookies_item_1_text', 'ضرورية لعمل الموقع بشكل صحيح', 'ar', 1, 'cookies_items', 1, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(160, 'cookies_item_2_title', 'کوکی‌های عملکردی:', 'fa', 1, 'cookies_items', 2, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(161, 'cookies_item_2_title', 'Functionality Cookies:', 'en', 1, 'cookies_items', 2, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(162, 'cookies_item_2_title', 'ملفات تعريف ارتباط الوظائف:', 'ar', 1, 'cookies_items', 2, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(163, 'cookies_item_2_text', 'ترجیحات و تنظیمات شما را به خاطر می‌سپارند', 'fa', 1, 'cookies_items', 2, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(164, 'cookies_item_2_text', 'Remember your preferences and settings', 'en', 1, 'cookies_items', 2, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(165, 'cookies_item_2_text', 'تتذكر تفضيلاتك وإعداداتك', 'ar', 1, 'cookies_items', 2, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(166, 'cookies_item_3_title', 'کوکی‌های تجزیه و تحلیل:', 'fa', 1, 'cookies_items', 3, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(167, 'cookies_item_3_title', 'Analytics Cookies:', 'en', 1, 'cookies_items', 3, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(168, 'cookies_item_3_title', 'ملفات تعريف ارتباط التحليلات:', 'ar', 1, 'cookies_items', 3, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(169, 'cookies_item_3_text', 'به ما کمک می‌کنند تا نحوه تعامل بازدیدکنندگان با وب‌سایت ما را درک کنیم', 'fa', 1, 'cookies_items', 3, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(170, 'cookies_item_3_text', 'Help us understand how visitors interact with our website', 'en', 1, 'cookies_items', 3, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(171, 'cookies_item_3_text', 'تساعدنا على فهم كيفية تفاعل الزوار مع موقعنا', 'ar', 1, 'cookies_items', 3, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(172, 'cookies_item_4_title', 'کوکی‌های بازاریابی:', 'fa', 1, 'cookies_items', 4, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(173, 'cookies_item_4_title', 'Marketing Cookies:', 'en', 1, 'cookies_items', 4, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(174, 'cookies_item_4_title', 'ملفات تعريف ارتباط التسويق:', 'ar', 1, 'cookies_items', 4, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(175, 'cookies_item_4_text', 'عادات مرور شما را برای ارائه تبلیغات هدفمند پیگیری می‌کنند', 'fa', 1, 'cookies_items', 4, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(176, 'cookies_item_4_text', 'Track your browsing habits to deliver targeted advertising', 'en', 1, 'cookies_items', 4, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(177, 'cookies_item_4_text', 'تتبع عادات التصفح لديك لتقديم إعلانات مستهدفة', 'ar', 1, 'cookies_items', 4, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(178, 'rights_title', 'حقوق حریم خصوصی شما', 'fa', 0, 'rights', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(179, 'rights_title', 'Your Privacy Rights', 'en', 0, 'rights', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(180, 'rights_title', 'حقوق الخصوصية الخاصة بك', 'ar', 0, 'rights', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(181, 'rights_text', 'بسته به موقعیت شما، ممکن است حقوق خاصی در مورد اطلاعات شخصی خود داشته باشید، که ممکن است شامل موارد زیر باشد:', 'fa', 0, 'rights', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(182, 'rights_text', 'Depending on your location, you may have certain rights regarding your personal information, which may include:', 'en', 0, 'rights', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(183, 'rights_text', 'اعتمادًا على موقعك، قد تتمتع بحقوق معينة فيما يتعلق بمعلوماتك الشخصية، والتي قد تشمل:', 'ar', 0, 'rights', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(184, 'rights_contact', 'برای اعمال هر یک از این حقوق، لطفاً با استفاده از اطلاعات ارائه شده در بخش \"تماس با ما\" با ما تماس بگیرید.', 'fa', 0, 'rights', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(185, 'rights_contact', 'To exercise any of these rights, please contact us using the details provided in the \"Contact Us\" section.', 'en', 0, 'rights', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(186, 'rights_contact', 'لممارسة أي من هذه الحقوق، يرجى الاتصال بنا باستخدام التفاصيل المقدمة في قسم \"اتصل بنا\".', 'ar', 0, 'rights', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(187, 'rights_item_1', 'حق دسترسی به اطلاعات شخصی که ما درباره شما نگهداری می‌کنیم', 'fa', 1, 'rights_items', 1, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(188, 'rights_item_1', 'Right to access the personal information we hold about you', 'en', 1, 'rights_items', 1, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(189, 'rights_item_1', 'الحق في الوصول إلى المعلومات الشخصية التي نحتفظ بها عنك', 'ar', 1, 'rights_items', 1, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(190, 'rights_item_2', 'حق درخواست اصلاح داده‌های نادرست', 'fa', 1, 'rights_items', 2, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(191, 'rights_item_2', 'Right to request correction of inaccurate data', 'en', 1, 'rights_items', 2, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(192, 'rights_item_2', 'الحق في طلب تصحيح البيانات غير الدقيقة', 'ar', 1, 'rights_items', 2, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(193, 'rights_item_3', 'حق درخواست حذف داده‌های شخصی شما', 'fa', 1, 'rights_items', 3, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(194, 'rights_item_3', 'Right to request deletion of your personal data', 'en', 1, 'rights_items', 3, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(195, 'rights_item_3', 'الحق في طلب حذف بياناتك الشخصية', 'ar', 1, 'rights_items', 3, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(196, 'rights_item_4', 'حق اعتراض به پردازش داده‌های شما', 'fa', 1, 'rights_items', 4, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(197, 'rights_item_4', 'Right to object to processing of your data', 'en', 1, 'rights_items', 4, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(198, 'rights_item_4', 'الحق في الاعتراض على معالجة بياناتك', 'ar', 1, 'rights_items', 4, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(199, 'rights_item_5', 'حق قابلیت حمل داده‌ها', 'fa', 1, 'rights_items', 5, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(200, 'rights_item_5', 'Right to data portability', 'en', 1, 'rights_items', 5, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(201, 'rights_item_5', 'الحق في نقل البيانات', 'ar', 1, 'rights_items', 5, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(202, 'rights_item_6', 'حق لغو رضایت در جایی که پردازش بر اساس رضایت باشد', 'fa', 1, 'rights_items', 6, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(203, 'rights_item_6', 'Right to withdraw consent where processing is based on consent', 'en', 1, 'rights_items', 6, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(204, 'rights_item_6', 'الحق في سحب الموافقة حيث تعتمد المعالجة على الموافقة', 'ar', 1, 'rights_items', 6, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(205, 'children_title', 'حریم خصوصی کودکان', 'fa', 0, 'children', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(206, 'children_title', 'Children\'s Privacy', 'en', 0, 'children', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(207, 'children_title', 'خصوصية الأطفال', 'ar', 0, 'children', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(208, 'children_text', 'وب‌سایت و خدمات ما برای افراد زیر ۱۶ سال در نظر گرفته نشده است. ما آگاهانه اطلاعات شخصی از کودکان جمع‌آوری نمی‌کنیم. اگر شما والدین یا سرپرست هستید و معتقدید که فرزند شما اطلاعات شخصی را برای ما ارائه کرده است، لطفاً با ما تماس بگیرید تا بتوانیم اقدامات لازم را انجام دهیم.', 'fa', 0, 'children', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(209, 'children_text', 'Our website and services are not intended for individuals under the age of 16. We do not knowingly collect personal information from children. If you are a parent or guardian and believe that your child has provided us with personal information, please contact us so that we can take necessary actions.', 'en', 0, 'children', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(210, 'children_text', 'موقعنا وخدماتنا ليست مخصصة للأفراد دون سن 16 عامًا. نحن لا نجمع عن علم معلومات شخصية من الأطفال. إذا كنت أحد الوالدين أو الوصي وتعتقد أن طفلك قد زودنا بمعلومات شخصية، فيرجى الاتصال بنا حتى نتمكن من اتخاذ الإجراءات اللازمة.', 'ar', 0, 'children', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(211, 'children_callout', 'ما از مسئولیت خود در قبال حفاظت از اطلاعات کودکان آگاه هستیم و تمام قوانین مربوطه را در این زمینه رعایت می‌کنیم.', 'fa', 0, 'children', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(212, 'children_callout', 'We are aware of our responsibility to protect children\'s information and comply with all relevant laws in this regard.', 'en', 0, 'children', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(213, 'children_callout', 'نحن ندرك مسؤوليتنا في حماية معلومات الأطفال ونمتثل لجميع القوانين ذات الصلة في هذا الصدد.', 'ar', 0, 'children', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(214, 'changes_title', 'تغییرات در این سیاست حریم خصوصی', 'fa', 0, 'changes', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(215, 'changes_title', 'Changes to This Privacy Policy', 'en', 0, 'changes', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(216, 'changes_title', 'التغييرات على سياسة الخصوصية هذه', 'ar', 0, 'changes', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(217, 'changes_text_1', 'ما ممکن است سیاست حریم خصوصی خود را هر از گاهی به‌روزرسانی کنیم. ما شما را از هرگونه تغییر با انتشار سیاست حریم خصوصی جدید در این صفحه و به‌روزرسانی تاریخ \"آخرین به‌روزرسانی\" مطلع خواهیم کرد. به شما توصیه می‌شود این سیاست حریم خصوصی را برای هرگونه تغییر به طور دوره‌ای بررسی کنید.', 'fa', 0, 'changes', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(218, 'changes_text_1', 'We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page and updating the \"Last Updated\" date. You are advised to review this Privacy Policy periodically for any changes.', 'en', 0, 'changes', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(219, 'changes_text_1', 'قد نقوم بتحديث سياسة الخصوصية الخاصة بنا من وقت لآخر. سنخطرك بأي تغييرات من خلال نشر سياسة الخصوصية الجديدة على هذه الصفحة وتحديث تاريخ \"آخر تحديث\". ننصحك بمراجعة سياسة الخصوصية هذه بشكل دوري لأي تغييرات.', 'ar', 0, 'changes', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(220, 'changes_text_2', 'تغییرات مهم از طریق یک اعلان برجسته در وب‌سایت ما یا از طریق ارتباط مستقیم در صورتی که اطلاعات تماس شما را داشته باشیم، به شما اطلاع داده خواهد شد.', 'fa', 0, 'changes', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(221, 'changes_text_2', 'Significant changes will be communicated to you through a prominent notice on our website or by direct communication if we have your contact details.', 'en', 0, 'changes', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(222, 'changes_text_2', 'سيتم إبلاغك بالتغييرات المهمة من خلال إشعار بارز على موقعنا الإلكتروني أو عن طريق الاتصال المباشر إذا كانت لدينا تفاصيل الاتصال الخاصة بك.', 'ar', 0, 'changes', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(223, 'contact_title', 'تماس با ما', 'fa', 0, 'contact', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(224, 'contact_title', 'Contact Us', 'en', 0, 'contact', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(225, 'contact_title', 'اتصل بنا', 'ar', 0, 'contact', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(226, 'contact_text', 'اگر سوال یا نگرانی در مورد این سیاست حریم خصوصی یا شیوه‌های داده‌ای ما دارید، لطفاً با ما تماس بگیرید:', 'fa', 0, 'contact', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(227, 'contact_text', 'If you have any questions or concerns about this Privacy Policy or our data practices, please contact us at:', 'en', 0, 'contact', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(228, 'contact_text', 'إذا كانت لديك أي أسئلة أو مخاوف بشأن سياسة الخصوصية هذه أو ممارسات البيانات لدينا، فيرجى الاتصال بنا على:', 'ar', 0, 'contact', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(229, 'privacy_email', 'privacy@salmanschool.ae', 'fa', 0, 'contact', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(230, 'privacy_email', 'privacy@salmanschool.ae', 'en', 0, 'contact', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(231, 'privacy_email', 'privacy@salmanschool.ae', 'ar', 0, 'contact', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(232, 'last_updated', 'آخرین به‌روزرسانی:', 'fa', 0, 'contact', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(233, 'last_updated', 'Last Updated:', 'en', 0, 'contact', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(234, 'last_updated', 'آخر تحديث:', 'ar', 0, 'contact', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(235, 'update_date', '2024-03-01', 'fa', 0, 'contact', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(236, 'update_date', '2024-03-01', 'en', 0, 'contact', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42'),
(237, 'update_date', '2024-03-01', 'ar', 0, 'contact', 0, NULL, '2025-03-28 18:34:42', '2025-03-28 18:34:42');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `registration_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `special_notes` text DEFAULT NULL,
  `disciplinary_rules_agreement` tinyint(1) NOT NULL DEFAULT 0,
  `terms_conditions_agreement` tinyint(1) NOT NULL DEFAULT 0,
  `registration_date` datetime DEFAULT current_timestamp(),
  `registration_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`registration_id`, `student_id`, `special_notes`, `disciplinary_rules_agreement`, `terms_conditions_agreement`, `registration_date`, `registration_status`) VALUES
(1, 1, '', 1, 1, '2025-03-13 19:00:04', 'pending'),
(2, 2, '', 1, 1, '2025-03-13 19:29:46', 'pending'),
(3, 3, '', 1, 1, '2025-03-13 19:50:08', 'pending'),
(4, 5, NULL, 1, 1, '2025-04-02 18:03:24', 'pending'),
(5, 8, '', 1, 1, '2025-04-02 18:10:22', 'pending'),
(6, 9, '', 1, 1, '2025-04-02 18:10:27', 'pending'),
(7, 10, '', 1, 1, '2025-04-05 12:00:00', 'pending'),
(8, 11, '', 1, 1, '2025-04-05 20:47:34', 'pending'),
(9, 12, '', 1, 1, '2025-04-06 12:19:26', 'pending'),
(10, 13, '', 1, 1, '2025-04-06 15:29:19', 'pending'),
(11, 14, 'Delectus incididunt', 1, 1, '2025-04-14 23:15:31', 'pending'),
(13, 16, '', 1, 1, '2025-04-14 23:37:30', 'pending'),
(14, 17, '', 1, 1, '2025-04-16 14:57:37', 'pending'),
(15, 18, '', 1, 1, '2025-04-16 15:05:51', 'pending'),
(16, 19, '', 1, 1, '2025-04-16 15:12:25', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `registration_success_content`
--

CREATE TABLE `registration_success_content` (
  `content_id` int(11) NOT NULL,
  `content_key` varchar(100) NOT NULL COMMENT 'کلید محتوا',
  `is_active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'وضعیت فعال بودن',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration_success_content`
--

INSERT INTO `registration_success_content` (`content_id`, `content_key`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'page_title', 1, '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(2, 'header_title', 1, '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(3, 'header_subtitle', 1, '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(4, 'success_message', 1, '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(5, 'congratulations', 1, '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(6, 'tracking_number_label', 1, '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(7, 'next_steps_label', 1, '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(8, 'contact_info_label', 1, '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(9, 'print_button_label', 1, '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(10, 'return_button_label', 1, '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(11, 'registration_confirmation', 1, '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(12, 'confirmation_message', 1, '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(13, 'student_name_label', 1, '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(14, 'registration_date_label', 1, '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(15, 'registration_status_label', 1, '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(16, 'status_pending', 1, '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(17, 'status_approved', 1, '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(18, 'status_rejected', 1, '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(19, 'next_step_1', 1, '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(20, 'next_step_2', 1, '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(21, 'next_step_3', 1, '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(22, 'next_step_4', 1, '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(23, 'contact_phone', 1, '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(24, 'contact_phone_title', 1, '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(25, 'contact_email', 1, '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(26, 'contact_email_title', 1, '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(27, 'contact_address', 1, '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(28, 'contact_address_title', 1, '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(29, 'contact_hours', 1, '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(30, 'contact_hours_title', 1, '2025-04-07 17:04:00', '2025-04-07 17:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `registration_success_translations`
--

CREATE TABLE `registration_success_translations` (
  `translation_id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL COMMENT 'شناسه محتوا از جدول اصلی',
  `language_id` int(11) NOT NULL COMMENT 'شناسه زبان',
  `content_value` text NOT NULL COMMENT 'متن محتوا',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration_success_translations`
--

INSERT INTO `registration_success_translations` (`translation_id`, `content_id`, `language_id`, `content_value`, `created_at`, `updated_at`) VALUES
(1, 12, 1, 'بدینوسیله گواهی می‌شود دانش‌آموز زیر در مدرسه سلمان فارسی ثبت‌نام کرده است.', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(2, 5, 1, 'تبریک می‌گوییم!', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(3, 27, 1, 'تهران، خیابان ولیعصر، خیابان سلمان فارسی، پلاک 123', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(4, 28, 1, 'آدرس', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(5, 25, 1, 'info@salmanschool.ir', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(6, 26, 1, 'ایمیل', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(7, 29, 1, 'شنبه تا چهارشنبه از ساعت 8 الی 16', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(8, 30, 1, 'ساعات کاری', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(9, 8, 1, 'اطلاعات تماس:', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(10, 23, 1, '021-12345678', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(11, 24, 1, 'تلفن دفتر ثبت‌نام', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(12, 3, 1, 'اطلاعات شما با موفقیت در سیستم ثبت شد.', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(13, 2, 1, 'ثبت‌نام با موفقیت انجام شد!', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(14, 7, 1, 'مراحل بعدی:', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(15, 19, 1, 'فرم‌های تکمیلی را که برای شما ایمیل می‌شود پر کرده و به دفتر مدرسه تحویل دهید.', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(16, 20, 1, 'مدارک مورد نیاز شامل کپی شناسنامه، کارنامه سال قبل و عکس پرسنلی را آماده کنید.', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(17, 21, 1, 'برای مصاحبه حضوری در تاریخ مشخص شده به مدرسه مراجعه کنید.', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(18, 22, 1, 'پس از تأیید نهایی، شهریه را طبق برنامه اعلام شده پرداخت نمایید.', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(19, 1, 1, 'ثبت‌نام موفقیت‌آمیز', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(20, 9, 1, 'چاپ تأییدیه', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(21, 11, 1, 'تأییدیه ثبت‌نام', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(22, 14, 1, 'تاریخ ثبت‌نام:', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(23, 15, 1, 'وضعیت:', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(24, 10, 1, 'بازگشت به صفحه اصلی', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(25, 17, 1, 'تأیید شده', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(26, 16, 1, 'در انتظار بررسی', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(27, 18, 1, 'رد شده', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(28, 13, 1, 'نام و نام خانوادگی:', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(29, 4, 1, 'ثبت‌نام شما با موفقیت انجام شد. در مرحله بعدی، کارشناسان ما اطلاعات شما را بررسی خواهند کرد.', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(30, 6, 1, 'شماره پیگیری:', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(32, 12, 2, 'This is to certify that the student below has been registered at Salman Farsi School.', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(33, 5, 2, 'Congratulations!', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(34, 27, 2, 'No. 123, Salman Farsi St., Valiasr Ave., Tehran, Iran', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(35, 28, 2, 'Address', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(36, 25, 2, 'info@salmanschool.ir', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(37, 26, 2, 'Email', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(38, 29, 2, 'Saturday to Wednesday, 8 AM to 4 PM', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(39, 30, 2, 'Working Hours', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(40, 8, 2, 'Contact Information:', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(41, 23, 2, '+98-21-12345678', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(42, 24, 2, 'Registration Office Phone', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(43, 3, 2, 'Your information has been successfully registered in our system.', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(44, 2, 2, 'Registration Completed Successfully!', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(45, 7, 2, 'Next Steps:', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(46, 19, 2, 'Fill out the additional forms that will be emailed to you and submit them to the school office.', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(47, 20, 2, 'Prepare the required documents including a copy of ID, last year\'s report card, and passport photos.', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(48, 21, 2, 'Visit the school for an in-person interview on the specified date.', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(49, 22, 2, 'After final approval, pay the tuition according to the announced schedule.', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(50, 1, 2, 'Registration Successful', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(51, 9, 2, 'Print Certificate', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(52, 11, 2, 'Registration Certificate', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(53, 14, 2, 'Registration Date:', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(54, 15, 2, 'Status:', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(55, 10, 2, 'Return to Home Page', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(56, 17, 2, 'Approved', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(57, 16, 2, 'Pending Review', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(58, 18, 2, 'Rejected', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(59, 13, 2, 'Full Name:', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(60, 4, 2, 'Your registration was successful. In the next step, our experts will review your information.', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(61, 6, 2, 'Tracking Number:', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(63, 12, 3, 'نشهد بموجب هذا أن الطالب المذكور أدناه قد تم تسجيله في مدرسة سلمان الفارسي.', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(64, 5, 3, 'تهانينا!', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(65, 27, 3, 'طهران، شارع ولي عصر، شارع سلمان الفارسي، رقم 123', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(66, 28, 3, 'العنوان', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(67, 25, 3, 'info@salmanschool.ir', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(68, 26, 3, 'البريد الإلكتروني', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(69, 29, 3, 'من السبت إلى الأربعاء، من الساعة 8 صباحاً إلى 4 مساءً', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(70, 30, 3, 'ساعات العمل', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(71, 8, 3, 'معلومات الاتصال:', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(72, 23, 3, '021-12345678', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(73, 24, 3, 'هاتف مكتب التسجيل', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(74, 3, 3, 'تم تسجيل معلوماتك بنجاح في نظامنا.', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(75, 2, 3, 'تم التسجيل بنجاح!', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(76, 7, 3, 'الخطوات التالية:', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(77, 19, 3, 'ملء النماذج الإضافية التي سيتم إرسالها إليك عبر البريد الإلكتروني وتقديمها إلى مكتب المدرسة.', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(78, 20, 3, 'تجهيز المستندات المطلوبة بما في ذلك نسخة من الهوية وشهادة العام الماضي والصور الشخصية.', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(79, 21, 3, 'زيارة المدرسة لإجراء مقابلة شخصية في التاريخ المحدد.', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(80, 22, 3, 'بعد الموافقة النهائية، ادفع الرسوم الدراسية وفقًا للجدول المعلن.', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(81, 1, 3, 'تسجيل ناجح', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(82, 9, 3, 'طباعة الشهادة', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(83, 11, 3, 'شهادة التسجيل', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(84, 14, 3, 'تاريخ التسجيل:', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(85, 15, 3, 'الحالة:', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(86, 10, 3, 'العودة إلى الصفحة الرئيسية', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(87, 17, 3, 'تمت الموافقة', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(88, 16, 3, 'قيد المراجعة', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(89, 18, 3, 'مرفوض', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(90, 13, 3, 'الاسم الكامل:', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(91, 4, 3, 'تم التسجيل بنجاح. في الخطوة التالية، سيقوم خبراؤنا بمراجعة معلوماتك.', '2025-04-07 17:04:00', '2025-04-07 17:04:00'),
(92, 6, 3, 'رقم التتبع:', '2025-04-07 17:04:00', '2025-04-07 17:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `registration_terms_content`
--

CREATE TABLE `registration_terms_content` (
  `id` int(11) NOT NULL,
  `field_key` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `language_id` varchar(5) NOT NULL,
  `is_repeatable` tinyint(1) NOT NULL DEFAULT 0,
  `section_id` varchar(50) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration_terms_content`
--

INSERT INTO `registration_terms_content` (`id`, `field_key`, `content`, `language_id`, `is_repeatable`, `section_id`, `sort_order`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 'page_title', 'ثبت‌نام آنلاین دانش‌آموز', 'fa', 0, 'header', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(2, 'header_title', 'ثبت‌نام در مجتمع آموزشی سلمان فارسی', 'fa', 0, 'header', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(3, 'header_subtitle', 'لطفاً فرم را با دقت تکمیل نمایید. تمامی فیلدهای علامت‌گذاری شده با * الزامی هستند.', 'fa', 0, 'header', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(4, 'step1_title', 'اطلاعات دانش‌آموز', 'fa', 0, 'steps', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(5, 'step1_description', 'لطفاً اطلاعات شخصی دانش‌آموز را وارد کنید.', 'fa', 0, 'steps', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(6, 'step2_title', 'بارگذاری مدارک', 'fa', 0, 'steps', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(7, 'step2_description', 'لطفاً مدارک مورد نیاز را بارگذاری کنید.', 'fa', 0, 'steps', 4, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(8, 'step3_title', 'اطلاعات پدر', 'fa', 0, 'steps', 5, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(9, 'step3_description', 'لطفاً اطلاعات پدر دانش‌آموز را وارد کنید.', 'fa', 0, 'steps', 6, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(10, 'step4_title', 'اطلاعات مادر', 'fa', 0, 'steps', 7, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(11, 'step4_description', 'لطفاً اطلاعات مادر دانش‌آموز را وارد کنید.', 'fa', 0, 'steps', 8, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(12, 'step5_title', 'تأیید نهایی', 'fa', 0, 'steps', 9, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(13, 'step5_description', 'لطفاً اطلاعات وارد شده را بررسی و تأیید نهایی کنید.', 'fa', 0, 'steps', 10, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(14, 'prev_button', 'قبلی', 'fa', 0, 'buttons', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(15, 'next_button', 'بعدی', 'fa', 0, 'buttons', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(16, 'submit_button', 'ارسال درخواست', 'fa', 0, 'buttons', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(17, 'review_button', 'بررسی اطلاعات', 'fa', 0, 'buttons', 4, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(18, 'confirm_button', 'تأیید و ادامه', 'fa', 0, 'buttons', 5, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(19, 'edit_button', 'ویرایش اطلاعات', 'fa', 0, 'buttons', 6, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(20, 'required_field', 'پر کردن این فیلد الزامی است', 'fa', 0, 'form_messages', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(21, 'optional_field', 'اختیاری', 'fa', 0, 'form_messages', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(22, 'student_photo_title', 'عکس پرسنلی', 'fa', 0, 'card_titles', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(23, 'personal_info_title', 'اطلاعات شخصی', 'fa', 0, 'card_titles', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(24, 'emergency_contact_title', 'اطلاعات تماس اضطراری', 'fa', 0, 'card_titles', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(25, 'required_documents_title', 'مدارک مورد نیاز', 'fa', 0, 'card_titles', 4, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(26, 'transportation_title', 'اطلاعات سرویس مدرسه', 'fa', 0, 'card_titles', 5, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(27, 'agreement_title', 'قوانین و توافق‌نامه‌ها', 'fa', 0, 'card_titles', 6, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(28, 'father_personal_info_title', 'اطلاعات شخصی پدر', 'fa', 0, 'card_titles', 7, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(29, 'father_contact_info_title', 'اطلاعات تماس پدر', 'fa', 0, 'card_titles', 8, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(30, 'medical_info_title', 'اطلاعات پزشکی', 'fa', 0, 'card_titles', 9, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(31, 'mother_personal_info_title', 'اطلاعات شخصی مادر', 'fa', 0, 'card_titles', 10, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(32, 'mother_contact_info_title', 'اطلاعات تماس مادر', 'fa', 0, 'card_titles', 11, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(33, 'additional_notes_title', 'یادداشت‌های اضافی', 'fa', 0, 'card_titles', 12, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(34, 'file_upload_text', 'برای بارگذاری فایل کلیک کنید یا فایل را اینجا بکشید و رها کنید', 'fa', 0, 'file_uploads', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(35, 'file_type_text', 'فرمت‌های مجاز: JPEG، PNG، PDF', 'fa', 0, 'file_uploads', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(36, 'file_size_text', 'حداکثر حجم فایل:', 'fa', 0, 'file_uploads', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(37, 'file_remove_text', 'حذف فایل', 'fa', 0, 'file_uploads', 4, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(38, 'file_type_error', 'فرمت فایل مجاز نیست. لطفاً فایل JPEG، PNG یا PDF بارگذاری کنید.', 'fa', 0, 'file_uploads', 5, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(39, 'file_size_error', 'حجم فایل بیش از حد مجاز است.', 'fa', 0, 'file_uploads', 6, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(40, 'national_id_label', 'کد ملی', 'fa', 0, 'identification', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(41, 'passport_number_label', 'شماره پاسپورت', 'fa', 0, 'identification', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(42, 'identification_label', 'سیستم شناسایی', 'fa', 0, 'identification', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(43, 'error_summary', 'لطفاً خطاهای زیر را برطرف کنید:', 'fa', 0, 'validation', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(44, 'invalid_national_id', 'کد ملی باید 10 رقم باشد.', 'fa', 0, 'validation', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(45, 'invalid_email', 'فرمت ایمیل صحیح نیست.', 'fa', 0, 'validation', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(46, 'invalid_phone', 'فرمت شماره تلفن صحیح نیست.', 'fa', 0, 'validation', 4, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(47, 'transportation_hint', 'اگر نیاز به استفاده از سرویس مدرسه دارید، اطلاعات زیر را تکمیل کنید', 'fa', 0, 'transportation', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(48, 'loading_routes', 'در حال بارگذاری مسیرها...', 'fa', 0, 'transportation', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(49, 'select_route', 'مسیر را انتخاب کنید', 'fa', 0, 'transportation', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(50, 'select_city_first', 'ابتدا شهر را انتخاب کنید', 'fa', 0, 'transportation', 4, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(51, 'error_loading_routes', 'خطا در بارگذاری مسیرها', 'fa', 0, 'transportation', 5, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(52, 'select_placeholder', 'انتخاب کنید', 'fa', 0, 'form_labels', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(53, 'yes_label', 'بله', 'fa', 0, 'form_labels', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(54, 'no_label', 'خیر', 'fa', 0, 'form_labels', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(55, 'academic_certificate_hint', 'برای دانش‌آموزان جدید الزامی است', 'fa', 0, 'form_labels', 4, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(56, 'policy_agreement_label', 'سیاست‌های مدرسه را مطالعه کرده و می‌پذیرم', 'fa', 0, 'form_labels', 5, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(57, 'disciplinary_rules_label', 'قوانین انضباطی مدرسه را مطالعه کرده و می‌پذیرم', 'fa', 0, 'form_labels', 6, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(58, 'terms_agreement_label', 'شرایط و قوانین ثبت‌نام را مطالعه کرده و می‌پذیرم', 'fa', 0, 'form_labels', 7, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(59, 'dubai', 'دبی', 'fa', 0, 'transportation_cities', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(60, 'sharjah', 'شارجه', 'fa', 0, 'transportation_cities', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(61, 'ajman', 'عجمان', 'fa', 0, 'transportation_cities', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(62, 'summary_title', 'خلاصه اطلاعات ثبت‌نام', 'fa', 0, 'summary', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(63, 'student_info_summary', 'اطلاعات دانش‌آموز', 'fa', 0, 'summary', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(64, 'father_info_summary', 'اطلاعات پدر', 'fa', 0, 'summary', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(65, 'mother_info_summary', 'اطلاعات مادر', 'fa', 0, 'summary', 4, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(66, 'additional_info_summary', 'اطلاعات تکمیلی', 'fa', 0, 'summary', 5, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(67, 'submitting_text', 'در حال ارسال...', 'fa', 0, 'summary', 6, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(68, 'server_error', 'خطا در ارتباط با سرور. لطفاً دوباره تلاش کنید.', 'fa', 0, 'summary', 7, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(69, 'not_filled', 'تکمیل نشده', 'fa', 0, 'summary', 8, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(70, 'page_title', 'Student Online Registration', 'en', 0, 'header', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(71, 'header_title', 'Register at Salman Farsi Educational Complex', 'en', 0, 'header', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(72, 'header_subtitle', 'Please fill out the form carefully. All fields marked with * are required.', 'en', 0, 'header', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(73, 'step1_title', 'Student Information', 'en', 0, 'steps', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(74, 'step1_description', 'Please enter the student\'s personal information.', 'en', 0, 'steps', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(75, 'step2_title', 'Document Upload', 'en', 0, 'steps', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(76, 'step2_description', 'Please upload the required documents.', 'en', 0, 'steps', 4, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(77, 'step3_title', 'Father\'s Information', 'en', 0, 'steps', 5, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(78, 'step3_description', 'Please enter the father\'s information.', 'en', 0, 'steps', 6, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(79, 'step4_title', 'Mother\'s Information', 'en', 0, 'steps', 7, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(80, 'step4_description', 'Please enter the mother\'s information.', 'en', 0, 'steps', 8, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(81, 'step5_title', 'Final Confirmation', 'en', 0, 'steps', 9, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(82, 'step5_description', 'Please review and confirm your information.', 'en', 0, 'steps', 10, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(83, 'prev_button', 'Previous', 'en', 0, 'buttons', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(84, 'next_button', 'Next', 'en', 0, 'buttons', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(85, 'submit_button', 'Submit Application', 'en', 0, 'buttons', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(86, 'review_button', 'Review Information', 'en', 0, 'buttons', 4, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(87, 'confirm_button', 'Confirm and Continue', 'en', 0, 'buttons', 5, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(88, 'edit_button', 'Edit Information', 'en', 0, 'buttons', 6, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(89, 'required_field', 'This field is required', 'en', 0, 'form_messages', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(90, 'optional_field', 'Optional', 'en', 0, 'form_messages', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(91, 'student_photo_title', 'Profile Photo', 'en', 0, 'card_titles', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(92, 'personal_info_title', 'Personal Information', 'en', 0, 'card_titles', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(93, 'emergency_contact_title', 'Emergency Contact Information', 'en', 0, 'card_titles', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(94, 'required_documents_title', 'Required Documents', 'en', 0, 'card_titles', 4, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(95, 'transportation_title', 'School Transportation Information', 'en', 0, 'card_titles', 5, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(96, 'agreement_title', 'Rules and Agreements', 'en', 0, 'card_titles', 6, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(97, 'father_personal_info_title', 'Father\'s Personal Information', 'en', 0, 'card_titles', 7, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(98, 'father_contact_info_title', 'Father\'s Contact Information', 'en', 0, 'card_titles', 8, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(99, 'medical_info_title', 'Medical Information', 'en', 0, 'card_titles', 9, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(100, 'mother_personal_info_title', 'Mother\'s Personal Information', 'en', 0, 'card_titles', 10, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(101, 'mother_contact_info_title', 'Mother\'s Contact Information', 'en', 0, 'card_titles', 11, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(102, 'additional_notes_title', 'Additional Notes', 'en', 0, 'card_titles', 12, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(103, 'file_upload_text', 'Click to upload or drag and drop file here', 'en', 0, 'file_uploads', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(104, 'file_type_text', 'Allowed formats: JPEG, PNG, PDF', 'en', 0, 'file_uploads', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(105, 'file_size_text', 'Maximum file size:', 'en', 0, 'file_uploads', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(106, 'file_remove_text', 'Remove file', 'en', 0, 'file_uploads', 4, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(107, 'file_type_error', 'File format not allowed. Please upload a JPEG, PNG, or PDF file.', 'en', 0, 'file_uploads', 5, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(108, 'file_size_error', 'File size exceeds the allowed limit.', 'en', 0, 'file_uploads', 6, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(109, 'national_id_label', 'National ID', 'en', 0, 'identification', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(110, 'passport_number_label', 'Passport Number', 'en', 0, 'identification', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(111, 'identification_label', 'Identification System', 'en', 0, 'identification', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(112, 'error_summary', 'Please fix the following errors:', 'en', 0, 'validation', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(113, 'invalid_national_id', 'National ID must be 10 digits.', 'en', 0, 'validation', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(114, 'invalid_email', 'Invalid email format.', 'en', 0, 'validation', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(115, 'invalid_phone', 'Invalid phone number format.', 'en', 0, 'validation', 4, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(116, 'transportation_hint', 'If you need school transportation, please complete the information below', 'en', 0, 'transportation', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(117, 'loading_routes', 'Loading routes...', 'en', 0, 'transportation', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(118, 'select_route', 'Select a route', 'en', 0, 'transportation', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(119, 'select_city_first', 'Please select a city first', 'en', 0, 'transportation', 4, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(120, 'error_loading_routes', 'Error loading routes', 'en', 0, 'transportation', 5, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(121, 'select_placeholder', 'Select', 'en', 0, 'form_labels', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(122, 'yes_label', 'Yes', 'en', 0, 'form_labels', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(123, 'no_label', 'No', 'en', 0, 'form_labels', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(124, 'academic_certificate_hint', 'Required for new students', 'en', 0, 'form_labels', 4, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(125, 'policy_agreement_label', 'I have read and agree to the school policies', 'en', 0, 'form_labels', 5, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(126, 'disciplinary_rules_label', 'I have read and agree to abide by the School Disciplinary Rules', 'en', 0, 'form_labels', 6, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(127, 'terms_agreement_label', 'I acknowledge and accept the Terms & Conditions of student registration', 'en', 0, 'form_labels', 7, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(128, 'dubai', 'Dubai', 'en', 0, 'transportation_cities', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(129, 'sharjah', 'Sharjah', 'en', 0, 'transportation_cities', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(130, 'ajman', 'Ajman', 'en', 0, 'transportation_cities', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(131, 'summary_title', 'Registration Summary', 'en', 0, 'summary', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(132, 'student_info_summary', 'Student Information', 'en', 0, 'summary', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(133, 'father_info_summary', 'Father\'s Information', 'en', 0, 'summary', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(134, 'mother_info_summary', 'Mother\'s Information', 'en', 0, 'summary', 4, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(135, 'additional_info_summary', 'Additional Information', 'en', 0, 'summary', 5, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(136, 'submitting_text', 'Submitting...', 'en', 0, 'summary', 6, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(137, 'server_error', 'Server connection error. Please try again.', 'en', 0, 'summary', 7, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(138, 'not_filled', 'Not filled', 'en', 0, 'summary', 8, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(139, 'page_title', 'التسجيل الإلكتروني للطلاب', 'ar', 0, 'header', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(140, 'header_title', 'التسجيل في مجمع سلمان الفارسي التعليمي', 'ar', 0, 'header', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(141, 'header_subtitle', 'يرجى ملء النموذج بعناية. جميع الحقول المميزة بعلامة * مطلوبة.', 'ar', 0, 'header', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(142, 'step1_title', 'معلومات الطالب', 'ar', 0, 'steps', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(143, 'step1_description', 'يرجى إدخال المعلومات الشخصية للطالب.', 'ar', 0, 'steps', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(144, 'step2_title', 'تحميل المستندات', 'ar', 0, 'steps', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(145, 'step2_description', 'يرجى تحميل المستندات المطلوبة.', 'ar', 0, 'steps', 4, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(146, 'step3_title', 'معلومات الأب', 'ar', 0, 'steps', 5, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(147, 'step3_description', 'يرجى إدخال معلومات الأب.', 'ar', 0, 'steps', 6, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(148, 'step4_title', 'معلومات الأم', 'ar', 0, 'steps', 7, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(149, 'step4_description', 'يرجى إدخال معلومات الأم.', 'ar', 0, 'steps', 8, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(150, 'step5_title', 'التأكيد النهائي', 'ar', 0, 'steps', 9, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(151, 'step5_description', 'يرجى مراجعة وتأكيد المعلومات الخاصة بك.', 'ar', 0, 'steps', 10, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(152, 'prev_button', 'السابق', 'ar', 0, 'buttons', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(153, 'next_button', 'التالي', 'ar', 0, 'buttons', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(154, 'submit_button', 'إرسال الطلب', 'ar', 0, 'buttons', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(155, 'review_button', 'مراجعة المعلومات', 'ar', 0, 'buttons', 4, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(156, 'confirm_button', 'تأكيد ومتابعة', 'ar', 0, 'buttons', 5, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(157, 'edit_button', 'تعديل المعلومات', 'ar', 0, 'buttons', 6, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(158, 'required_field', 'هذا الحقل مطلوب', 'ar', 0, 'form_messages', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(159, 'optional_field', 'اختياري', 'ar', 0, 'form_messages', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(160, 'student_photo_title', 'الصورة الشخصية', 'ar', 0, 'card_titles', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(161, 'personal_info_title', 'المعلومات الشخصية', 'ar', 0, 'card_titles', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(162, 'emergency_contact_title', 'معلومات الاتصال في حالات الطوارئ', 'ar', 0, 'card_titles', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(163, 'required_documents_title', 'المستندات المطلوبة', 'ar', 0, 'card_titles', 4, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(164, 'transportation_title', 'معلومات النقل المدرسي', 'ar', 0, 'card_titles', 5, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(165, 'agreement_title', 'القواعد والاتفاقيات', 'ar', 0, 'card_titles', 6, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(166, 'father_personal_info_title', 'المعلومات الشخصية للأب', 'ar', 0, 'card_titles', 7, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(167, 'father_contact_info_title', 'معلومات الاتصال بالأب', 'ar', 0, 'card_titles', 8, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(168, 'medical_info_title', 'المعلومات الطبية', 'ar', 0, 'card_titles', 9, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(169, 'mother_personal_info_title', 'المعلومات الشخصية للأم', 'ar', 0, 'card_titles', 10, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(170, 'mother_contact_info_title', 'معلومات الاتصال بالأم', 'ar', 0, 'card_titles', 11, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(171, 'additional_notes_title', 'ملاحظات إضافية', 'ar', 0, 'card_titles', 12, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(172, 'file_upload_text', 'انقر للتحميل أو اسحب وأفلت الملف هنا', 'ar', 0, 'file_uploads', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(173, 'file_type_text', 'الصيغ المسموح بها: JPEG، PNG، PDF', 'ar', 0, 'file_uploads', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(174, 'file_size_text', 'الحد الأقصى لحجم الملف:', 'ar', 0, 'file_uploads', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(175, 'file_remove_text', 'إزالة الملف', 'ar', 0, 'file_uploads', 4, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(176, 'file_type_error', 'صيغة الملف غير مسموح بها. يرجى تحميل ملف JPEG أو PNG أو PDF.', 'ar', 0, 'file_uploads', 5, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(177, 'file_size_error', 'حجم الملف يتجاوز الحد المسموح به.', 'ar', 0, 'file_uploads', 6, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(178, 'national_id_label', 'الهوية الوطنية', 'ar', 0, 'identification', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(179, 'passport_number_label', 'رقم جواز السفر', 'ar', 0, 'identification', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(180, 'identification_label', 'نظام التعريف', 'ar', 0, 'identification', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(181, 'error_summary', 'يرجى إصلاح الأخطاء التالية:', 'ar', 0, 'validation', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(182, 'invalid_national_id', 'يجب أن تكون الهوية الوطنية 10 أرقام.', 'ar', 0, 'validation', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(183, 'invalid_email', 'صيغة البريد الإلكتروني غير صالحة.', 'ar', 0, 'validation', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(184, 'invalid_phone', 'صيغة رقم الهاتف غير صالحة.', 'ar', 0, 'validation', 4, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(185, 'transportation_hint', 'إذا كنت بحاجة إلى وسيلة نقل مدرسية، يرجى إكمال المعلومات أدناه', 'ar', 0, 'transportation', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(186, 'loading_routes', 'جاري تحميل المسارات...', 'ar', 0, 'transportation', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(187, 'select_route', 'اختر مسار', 'ar', 0, 'transportation', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(188, 'select_city_first', 'يرجى اختيار مدينة أولاً', 'ar', 0, 'transportation', 4, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(189, 'error_loading_routes', 'خطأ في تحميل المسارات', 'ar', 0, 'transportation', 5, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(190, 'select_placeholder', 'اختر', 'ar', 0, 'form_labels', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(191, 'yes_label', 'نعم', 'ar', 0, 'form_labels', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(192, 'no_label', 'لا', 'ar', 0, 'form_labels', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(193, 'academic_certificate_hint', 'مطلوب للطلاب الجدد', 'ar', 0, 'form_labels', 4, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(194, 'policy_agreement_label', 'لقد قرأت وأوافق على سياسات المدرسة', 'ar', 0, 'form_labels', 5, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(195, 'disciplinary_rules_label', 'لقد قرأت وأوافق على الالتزام بقواعد الانضباط المدرسية', 'ar', 0, 'form_labels', 6, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(196, 'terms_agreement_label', 'أقر وأقبل شروط وأحكام تسجيل الطلاب', 'ar', 0, 'form_labels', 7, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(197, 'dubai', 'دبي', 'ar', 0, 'transportation_cities', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(198, 'sharjah', 'الشارقة', 'ar', 0, 'transportation_cities', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(199, 'ajman', 'عجمان', 'ar', 0, 'transportation_cities', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(200, 'summary_title', 'ملخص التسجيل', 'ar', 0, 'summary', 1, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(201, 'student_info_summary', 'معلومات الطالب', 'ar', 0, 'summary', 2, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(202, 'father_info_summary', 'معلومات الأب', 'ar', 0, 'summary', 3, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(203, 'mother_info_summary', 'معلومات الأم', 'ar', 0, 'summary', 4, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(204, 'additional_info_summary', 'معلومات إضافية', 'ar', 0, 'summary', 5, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(205, 'submitting_text', 'جاري الإرسال...', 'ar', 0, 'summary', 6, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(206, 'server_error', 'خطأ في الاتصال بالخادم. يرجى المحاولة مرة أخرى.', 'ar', 0, 'summary', 7, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(207, 'not_filled', 'غير معبأ', 'ar', 0, 'summary', 8, NULL, '2025-04-08 07:17:22', '2025-04-08 07:17:22'),
(208, 'need_transportation', 'آیا به سرویس مدرسه نیاز دارید؟', 'fa', 0, 'transportation', 0, NULL, '2025-04-13 13:00:03', '2025-04-13 13:00:03'),
(209, 'need_transportation', 'Do you need school transportation?', 'en', 0, 'transportation', 0, NULL, '2025-04-13 13:00:03', '2025-04-13 13:00:03'),
(210, 'need_transportation', 'هل تحتاج إلى خدمة النقل المدرسي؟', 'ar', 0, 'transportation', 0, NULL, '2025-04-13 13:00:03', '2025-04-13 13:00:03'),
(211, 'yes_option', 'بله', 'fa', 0, 'form_labels', 10, NULL, '2025-04-13 13:00:03', '2025-04-13 13:00:03'),
(212, 'yes_option', 'Yes', 'en', 0, 'form_labels', 10, NULL, '2025-04-13 13:00:03', '2025-04-13 13:00:03'),
(213, 'yes_option', 'نعم', 'ar', 0, 'form_labels', 10, NULL, '2025-04-13 13:00:03', '2025-04-13 13:00:03'),
(214, 'no_option', 'خیر', 'fa', 0, 'form_labels', 11, NULL, '2025-04-13 13:00:03', '2025-04-13 13:00:03'),
(215, 'no_option', 'No', 'en', 0, 'form_labels', 11, NULL, '2025-04-13 13:00:03', '2025-04-13 13:00:03'),
(216, 'no_option', 'لا', 'ar', 0, 'form_labels', 11, NULL, '2025-04-13 13:00:03', '2025-04-13 13:00:03'),
(217, 'no_transportation_needed', 'بدون نیاز به سرویس', 'fa', 0, 'transportation', 6, NULL, '2025-04-13 13:00:03', '2025-04-13 13:00:03'),
(218, 'no_transportation_needed', 'No transportation needed', 'en', 0, 'transportation', 6, NULL, '2025-04-13 13:00:03', '2025-04-13 13:00:03'),
(219, 'no_transportation_needed', 'لا حاجة للنقل', 'ar', 0, 'transportation', 6, NULL, '2025-04-13 13:00:03', '2025-04-13 13:00:03'),
(220, 'file_upload_placeholder', 'برای بارگذاری فایل کلیک کنید یا فایل را اینجا بکشید و رها کنید', 'fa', 0, 'file_uploads', 7, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(221, 'file_type_hint', 'فرمت‌های مجاز: JPEG، PNG، PDF - حداکثر حجم فایل: ', 'fa', 0, 'file_uploads', 8, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(222, 'first_name', 'نام', 'fa', 0, 'form_labels', 20, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(223, 'last_name', 'نام خانوادگی', 'fa', 0, 'form_labels', 21, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(224, 'father_name', 'نام پدر', 'fa', 0, 'form_labels', 22, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(225, 'birth_place', 'محل تولد', 'fa', 0, 'form_labels', 23, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(226, 'birth_date', 'تاریخ تولد', 'fa', 0, 'form_labels', 24, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(227, 'main_phone', 'شماره تماس اصلی', 'fa', 0, 'form_labels', 25, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(228, 'emergency_contact', 'نام تماس اضطراری', 'fa', 0, 'form_labels', 26, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(229, 'emergency_phone', 'شماره تماس اضطراری', 'fa', 0, 'form_labels', 27, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(230, 'passport_doc', 'صفحه اول پاسپورت', 'fa', 0, 'form_labels', 28, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(231, 'national_id_doc', 'کارت ملی', 'fa', 0, 'form_labels', 29, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(232, 'profile_photo', 'عکس پرسنلی', 'fa', 0, 'form_labels', 30, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(233, 'birth_certificate', 'شناسنامه', 'fa', 0, 'form_labels', 31, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(234, 'academic_certificate', 'مدرک تحصیلی', 'fa', 0, 'form_labels', 32, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(235, 'father_full_name', 'نام کامل پدر', 'fa', 0, 'form_labels', 33, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(236, 'father_nationality', 'ملیت پدر', 'fa', 0, 'form_labels', 34, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(237, 'father_birth_date', 'تاریخ تولد پدر', 'fa', 0, 'form_labels', 35, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(238, 'father_national_id', 'کد ملی پدر', 'fa', 0, 'form_labels', 36, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(239, 'father_passport_number', 'شماره پاسپورت پدر', 'fa', 0, 'form_labels', 37, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(240, 'father_education', 'تحصیلات پدر', 'fa', 0, 'form_labels', 38, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(241, 'father_occupation', 'شغل پدر', 'fa', 0, 'form_labels', 39, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(242, 'father_landline', 'تلفن ثابت پدر', 'fa', 0, 'form_labels', 40, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(243, 'father_mobile', 'تلفن همراه پدر', 'fa', 0, 'form_labels', 41, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(244, 'father_whatsapp', 'شماره واتساپ پدر', 'fa', 0, 'form_labels', 42, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(245, 'father_email', 'ایمیل پدر', 'fa', 0, 'form_labels', 43, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(246, 'father_work_address', 'آدرس محل کار پدر', 'fa', 0, 'form_labels', 44, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(247, 'father_employee_code', 'کد کارمندی پدر', 'fa', 0, 'form_labels', 45, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(248, 'father_medical_condition', 'آیا پدر دارای شرایط پزشکی خاصی است که مدرسه باید از آن مطلع باشد؟', 'fa', 0, 'form_labels', 46, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(249, 'father_medical_details', 'لطفاً شرایط پزشکی را توضیح دهید', 'fa', 0, 'form_labels', 47, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(250, 'mother_full_name', 'نام کامل مادر', 'fa', 0, 'form_labels', 48, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(251, 'mother_nationality', 'ملیت مادر', 'fa', 0, 'form_labels', 49, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(252, 'mother_birth_date', 'تاریخ تولد مادر', 'fa', 0, 'form_labels', 50, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(253, 'mother_national_id', 'کد ملی مادر', 'fa', 0, 'form_labels', 51, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(254, 'mother_passport_number', 'شماره پاسپورت مادر', 'fa', 0, 'form_labels', 52, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(255, 'mother_education', 'تحصیلات مادر', 'fa', 0, 'form_labels', 53, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(256, 'mother_occupation', 'شغل مادر', 'fa', 0, 'form_labels', 54, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(257, 'mother_landline', 'تلفن ثابت مادر', 'fa', 0, 'form_labels', 55, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(258, 'mother_mobile', 'تلفن همراه مادر', 'fa', 0, 'form_labels', 56, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(259, 'mother_whatsapp', 'شماره واتساپ مادر', 'fa', 0, 'form_labels', 57, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(260, 'mother_email', 'ایمیل مادر', 'fa', 0, 'form_labels', 58, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(261, 'mother_work_address', 'آدرس محل کار مادر', 'fa', 0, 'form_labels', 59, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(262, 'mother_employee_code', 'کد کارمندی مادر', 'fa', 0, 'form_labels', 60, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(263, 'mother_medical_condition', 'آیا مادر دارای شرایط پزشکی خاصی است که مدرسه باید از آن مطلع باشد؟', 'fa', 0, 'form_labels', 61, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(264, 'mother_medical_details', 'لطفاً شرایط پزشکی را توضیح دهید', 'fa', 0, 'form_labels', 62, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(265, 'special_notes', 'نکات ویژه / درخواست‌های اضافی', 'fa', 0, 'form_labels', 63, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(266, 'agreements', 'توافق‌نامه‌ها', 'fa', 0, 'form_labels', 64, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(267, 'agreed', 'پذیرفته شده', 'fa', 0, 'form_labels', 65, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(268, 'not_agreed', 'پذیرفته نشده', 'fa', 0, 'form_labels', 66, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(269, 'transportation_city', 'شهر', 'fa', 0, 'transportation', 7, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(270, 'transportation_route', 'مسیر', 'fa', 0, 'transportation', 8, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(271, 'transportation_stop', 'محل سوار شدن', 'fa', 0, 'transportation', 9, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(272, 'route_description', 'توضیحات مسیر:', 'fa', 0, 'transportation', 10, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(273, 'has_medical_condition', 'دارای شرایط پزشکی خاص', 'fa', 0, 'medical', 1, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(274, 'medical_condition_explanation', 'توضیح شرایط پزشکی:', 'fa', 0, 'medical', 2, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(275, 'summary_view', 'نمایش خلاصه اطلاعات', 'fa', 0, 'buttons', 7, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(276, 'modal_close', 'بستن', 'fa', 0, 'buttons', 8, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(277, 'form_heading', 'فرم ثبت‌نام دانش‌آموز', 'fa', 0, 'headings', 1, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(278, 'processing_form', 'در حال پردازش...', 'fa', 0, 'form_messages', 3, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(279, 'document_uploaded', 'فایل آپلود شده است', 'fa', 0, 'form_messages', 4, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(280, 'validation_required', 'این فیلد الزامی است', 'fa', 0, 'validation', 5, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(281, 'validation_unique', 'این مقدار قبلاً استفاده شده است', 'fa', 0, 'validation', 6, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(282, 'validation_max_length', 'حداکثر طول مجاز: {0} کاراکتر', 'fa', 0, 'validation', 7, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(283, 'validation_min_length', 'حداقل طول مجاز: {0} کاراکتر', 'fa', 0, 'validation', 8, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(284, 'file_uploading', 'در حال آپلود فایل...', 'fa', 0, 'file_uploads', 9, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(285, 'file_upload_success', 'فایل با موفقیت آپلود شد', 'fa', 0, 'file_uploads', 10, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(286, 'file_delete_confirm', 'آیا از حذف این فایل اطمینان دارید؟', 'fa', 0, 'file_uploads', 11, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(287, 'confirm_yes', 'بله', 'fa', 0, 'form_messages', 5, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(288, 'confirm_no', 'خیر', 'fa', 0, 'form_messages', 6, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(289, 'error_heading', 'خطا', 'fa', 0, 'form_messages', 7, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(290, 'step_validation_failed', 'لطفاً اطلاعات این مرحله را به درستی تکمیل کنید.', 'fa', 0, 'form_messages', 8, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(291, 'file_upload_placeholder', 'Click to upload or drag and drop a file here', 'en', 0, 'file_uploads', 7, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(292, 'file_type_hint', 'Allowed formats: JPEG, PNG, PDF - Maximum file size: ', 'en', 0, 'file_uploads', 8, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(293, 'first_name', 'First Name', 'en', 0, 'form_labels', 20, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(294, 'last_name', 'Last Name', 'en', 0, 'form_labels', 21, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(295, 'father_name', 'Father\'s Name', 'en', 0, 'form_labels', 22, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(296, 'birth_place', 'Place of Birth', 'en', 0, 'form_labels', 23, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(297, 'birth_date', 'Date of Birth', 'en', 0, 'form_labels', 24, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(298, 'main_phone', 'Primary Contact Number', 'en', 0, 'form_labels', 25, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(299, 'emergency_contact', 'Emergency Contact Name', 'en', 0, 'form_labels', 26, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(300, 'emergency_phone', 'Emergency Contact Number', 'en', 0, 'form_labels', 27, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(301, 'passport_doc', 'Passport Front Page', 'en', 0, 'form_labels', 28, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(302, 'national_id_doc', 'National ID Card', 'en', 0, 'form_labels', 29, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(303, 'profile_photo', 'Profile Photo', 'en', 0, 'form_labels', 30, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(304, 'birth_certificate', 'Birth Certificate', 'en', 0, 'form_labels', 31, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(305, 'academic_certificate', 'Academic Certificate', 'en', 0, 'form_labels', 32, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(306, 'father_full_name', 'Father\'s Full Name', 'en', 0, 'form_labels', 33, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(307, 'father_nationality', 'Father\'s Nationality', 'en', 0, 'form_labels', 34, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(308, 'father_birth_date', 'Father\'s Date of Birth', 'en', 0, 'form_labels', 35, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(309, 'father_national_id', 'Father\'s National ID', 'en', 0, 'form_labels', 36, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(310, 'father_passport_number', 'Father\'s Passport Number', 'en', 0, 'form_labels', 37, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(311, 'father_education', 'Father\'s Education', 'en', 0, 'form_labels', 38, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(312, 'father_occupation', 'Father\'s Occupation', 'en', 0, 'form_labels', 39, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(313, 'father_landline', 'Father\'s Landline', 'en', 0, 'form_labels', 40, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(314, 'father_mobile', 'Father\'s Mobile', 'en', 0, 'form_labels', 41, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(315, 'father_whatsapp', 'Father\'s WhatsApp', 'en', 0, 'form_labels', 42, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(316, 'father_email', 'Father\'s Email', 'en', 0, 'form_labels', 43, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(317, 'father_work_address', 'Father\'s Work Address', 'en', 0, 'form_labels', 44, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(318, 'father_employee_code', 'Father\'s Employee Code', 'en', 0, 'form_labels', 45, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(319, 'father_medical_condition', 'Does the father have any medical conditions that the school should be aware of?', 'en', 0, 'form_labels', 46, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(320, 'father_medical_details', 'Please specify the medical condition', 'en', 0, 'form_labels', 47, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(321, 'mother_full_name', 'Mother\'s Full Name', 'en', 0, 'form_labels', 48, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(322, 'mother_nationality', 'Mother\'s Nationality', 'en', 0, 'form_labels', 49, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(323, 'mother_birth_date', 'Mother\'s Date of Birth', 'en', 0, 'form_labels', 50, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(324, 'mother_national_id', 'Mother\'s National ID', 'en', 0, 'form_labels', 51, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(325, 'mother_passport_number', 'Mother\'s Passport Number', 'en', 0, 'form_labels', 52, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(326, 'mother_education', 'Mother\'s Education', 'en', 0, 'form_labels', 53, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(327, 'mother_occupation', 'Mother\'s Occupation', 'en', 0, 'form_labels', 54, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(328, 'mother_landline', 'Mother\'s Landline', 'en', 0, 'form_labels', 55, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(329, 'mother_mobile', 'Mother\'s Mobile', 'en', 0, 'form_labels', 56, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(330, 'mother_whatsapp', 'Mother\'s WhatsApp', 'en', 0, 'form_labels', 57, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(331, 'mother_email', 'Mother\'s Email', 'en', 0, 'form_labels', 58, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(332, 'mother_work_address', 'Mother\'s Work Address', 'en', 0, 'form_labels', 59, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(333, 'mother_employee_code', 'Mother\'s Employee Code', 'en', 0, 'form_labels', 60, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(334, 'mother_medical_condition', 'Does the mother have any medical conditions that the school should be aware of?', 'en', 0, 'form_labels', 61, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(335, 'mother_medical_details', 'Please specify the medical condition', 'en', 0, 'form_labels', 62, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(336, 'special_notes', 'Special Notes / Additional Requests', 'en', 0, 'form_labels', 63, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(337, 'agreements', 'Agreements', 'en', 0, 'form_labels', 64, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(338, 'agreed', 'Agreed', 'en', 0, 'form_labels', 65, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(339, 'not_agreed', 'Not Agreed', 'en', 0, 'form_labels', 66, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(340, 'transportation_city', 'City', 'en', 0, 'transportation', 7, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(341, 'transportation_route', 'Route', 'en', 0, 'transportation', 8, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(342, 'transportation_stop', 'Pickup Location', 'en', 0, 'transportation', 9, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(343, 'route_description', 'Route Description:', 'en', 0, 'transportation', 10, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(344, 'has_medical_condition', 'Has Medical Condition', 'en', 0, 'medical', 1, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(345, 'medical_condition_explanation', 'Medical Condition Details:', 'en', 0, 'medical', 2, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(346, 'summary_view', 'View Summary', 'en', 0, 'buttons', 7, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(347, 'modal_close', 'Close', 'en', 0, 'buttons', 8, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(348, 'form_heading', 'Student Registration Form', 'en', 0, 'headings', 1, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(349, 'processing_form', 'Processing...', 'en', 0, 'form_messages', 3, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(350, 'document_uploaded', 'File Uploaded', 'en', 0, 'form_messages', 4, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(351, 'validation_required', 'This field is required', 'en', 0, 'validation', 5, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(352, 'validation_unique', 'This value is already in use', 'en', 0, 'validation', 6, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(353, 'validation_max_length', 'Maximum length: {0} characters', 'en', 0, 'validation', 7, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(354, 'validation_min_length', 'Minimum length: {0} characters', 'en', 0, 'validation', 8, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(355, 'file_uploading', 'Uploading file...', 'en', 0, 'file_uploads', 9, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(356, 'file_upload_success', 'File uploaded successfully', 'en', 0, 'file_uploads', 10, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(357, 'file_delete_confirm', 'Are you sure you want to delete this file?', 'en', 0, 'file_uploads', 11, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(358, 'confirm_yes', 'Yes', 'en', 0, 'form_messages', 5, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(359, 'confirm_no', 'No', 'en', 0, 'form_messages', 6, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(360, 'error_heading', 'Error', 'en', 0, 'form_messages', 7, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(361, 'step_validation_failed', 'Please fill in all required fields correctly.', 'en', 0, 'form_messages', 8, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(362, 'file_upload_placeholder', 'انقر للتحميل أو اسحب وأفلت الملف هنا', 'ar', 0, 'file_uploads', 7, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(363, 'file_type_hint', 'الصيغ المسموح بها: JPEG، PNG، PDF - الحجم الأقصى للملف: ', 'ar', 0, 'file_uploads', 8, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(364, 'first_name', 'الاسم الأول', 'ar', 0, 'form_labels', 20, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(365, 'last_name', 'اللقب', 'ar', 0, 'form_labels', 21, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(366, 'father_name', 'اسم الأب', 'ar', 0, 'form_labels', 22, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(367, 'birth_place', 'مكان الولادة', 'ar', 0, 'form_labels', 23, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(368, 'birth_date', 'تاريخ الميلاد', 'ar', 0, 'form_labels', 24, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(369, 'main_phone', 'رقم الاتصال الأساسي', 'ar', 0, 'form_labels', 25, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(370, 'emergency_contact', 'اسم جهة الاتصال في حالات الطوارئ', 'ar', 0, 'form_labels', 26, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(371, 'emergency_phone', 'رقم الاتصال في حالات الطوارئ', 'ar', 0, 'form_labels', 27, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(372, 'passport_doc', 'الصفحة الأمامية لجواز السفر', 'ar', 0, 'form_labels', 28, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(373, 'national_id_doc', 'بطاقة الهوية الوطنية', 'ar', 0, 'form_labels', 29, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(374, 'profile_photo', 'الصورة الشخصية', 'ar', 0, 'form_labels', 30, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(375, 'birth_certificate', 'شهادة الميلاد', 'ar', 0, 'form_labels', 31, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(376, 'academic_certificate', 'الشهادة الأكاديمية', 'ar', 0, 'form_labels', 32, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(377, 'father_full_name', 'الاسم الكامل للأب', 'ar', 0, 'form_labels', 33, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(378, 'father_nationality', 'جنسية الأب', 'ar', 0, 'form_labels', 34, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(379, 'father_birth_date', 'تاريخ ميلاد الأب', 'ar', 0, 'form_labels', 35, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(380, 'father_national_id', 'الهوية الوطنية للأب', 'ar', 0, 'form_labels', 36, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(381, 'father_passport_number', 'رقم جواز سفر الأب', 'ar', 0, 'form_labels', 37, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(382, 'father_education', 'تعليم الأب', 'ar', 0, 'form_labels', 38, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(383, 'father_occupation', 'مهنة الأب', 'ar', 0, 'form_labels', 39, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(384, 'father_landline', 'هاتف الأب الثابت', 'ar', 0, 'form_labels', 40, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(385, 'father_mobile', 'هاتف الأب المحمول', 'ar', 0, 'form_labels', 41, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(386, 'father_whatsapp', 'واتساب الأب', 'ar', 0, 'form_labels', 42, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(387, 'father_email', 'البريد الإلكتروني للأب', 'ar', 0, 'form_labels', 43, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50');
INSERT INTO `registration_terms_content` (`id`, `field_key`, `content`, `language_id`, `is_repeatable`, `section_id`, `sort_order`, `image_path`, `created_at`, `updated_at`) VALUES
(388, 'father_work_address', 'عنوان عمل الأب', 'ar', 0, 'form_labels', 44, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(389, 'father_employee_code', 'رمز الموظف للأب', 'ar', 0, 'form_labels', 45, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(390, 'father_medical_condition', 'هل يعاني الأب من أي حالات طبية يجب أن تكون المدرسة على علم بها؟', 'ar', 0, 'form_labels', 46, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(391, 'father_medical_details', 'يرجى تحديد الحالة الطبية', 'ar', 0, 'form_labels', 47, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(392, 'mother_full_name', 'الاسم الكامل للأم', 'ar', 0, 'form_labels', 48, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(393, 'mother_nationality', 'جنسية الأم', 'ar', 0, 'form_labels', 49, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(394, 'mother_birth_date', 'تاريخ ميلاد الأم', 'ar', 0, 'form_labels', 50, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(395, 'mother_national_id', 'الهوية الوطنية للأم', 'ar', 0, 'form_labels', 51, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(396, 'mother_passport_number', 'رقم جواز سفر الأم', 'ar', 0, 'form_labels', 52, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(397, 'mother_education', 'تعليم الأم', 'ar', 0, 'form_labels', 53, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(398, 'mother_occupation', 'مهنة الأم', 'ar', 0, 'form_labels', 54, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(399, 'mother_landline', 'هاتف الأم الثابت', 'ar', 0, 'form_labels', 55, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(400, 'mother_mobile', 'هاتف الأم المحمول', 'ar', 0, 'form_labels', 56, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(401, 'mother_whatsapp', 'واتساب الأم', 'ar', 0, 'form_labels', 57, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(402, 'mother_email', 'البريد الإلكتروني للأم', 'ar', 0, 'form_labels', 58, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(403, 'mother_work_address', 'عنوان عمل الأم', 'ar', 0, 'form_labels', 59, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(404, 'mother_employee_code', 'رمز الموظف للأم', 'ar', 0, 'form_labels', 60, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(405, 'mother_medical_condition', 'هل تعاني الأم من أي حالات طبية يجب أن تكون المدرسة على علم بها؟', 'ar', 0, 'form_labels', 61, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(406, 'mother_medical_details', 'يرجى تحديد الحالة الطبية', 'ar', 0, 'form_labels', 62, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(407, 'special_notes', 'ملاحظات خاصة / طلبات إضافية', 'ar', 0, 'form_labels', 63, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(408, 'agreements', 'الاتفاقيات', 'ar', 0, 'form_labels', 64, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(409, 'agreed', 'موافق', 'ar', 0, 'form_labels', 65, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(410, 'not_agreed', 'غير موافق', 'ar', 0, 'form_labels', 66, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(411, 'transportation_city', 'المدينة', 'ar', 0, 'transportation', 7, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(412, 'transportation_route', 'المسار', 'ar', 0, 'transportation', 8, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(413, 'transportation_stop', 'موقع الركوب', 'ar', 0, 'transportation', 9, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(414, 'route_description', 'وصف المسار:', 'ar', 0, 'transportation', 10, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(415, 'has_medical_condition', 'يعاني من حالة طبية', 'ar', 0, 'medical', 1, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(416, 'medical_condition_explanation', 'تفاصيل الحالة الطبية:', 'ar', 0, 'medical', 2, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(417, 'summary_view', 'عرض الملخص', 'ar', 0, 'buttons', 7, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(418, 'modal_close', 'إغلاق', 'ar', 0, 'buttons', 8, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(419, 'form_heading', 'استمارة تسجيل الطالب', 'ar', 0, 'headings', 1, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(420, 'processing_form', 'جاري المعالجة...', 'ar', 0, 'form_messages', 3, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(421, 'document_uploaded', 'تم تحميل الملف', 'ar', 0, 'form_messages', 4, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(422, 'validation_required', 'هذا الحقل مطلوب', 'ar', 0, 'validation', 5, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(423, 'validation_unique', 'هذه القيمة مستخدمة بالفعل', 'ar', 0, 'validation', 6, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(424, 'validation_max_length', 'الحد الأقصى للطول: {0} حرف', 'ar', 0, 'validation', 7, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(425, 'validation_min_length', 'الحد الأدنى للطول: {0} حرف', 'ar', 0, 'validation', 8, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(426, 'file_uploading', 'جاري تحميل الملف...', 'ar', 0, 'file_uploads', 9, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(427, 'file_upload_success', 'تم تحميل الملف بنجاح', 'ar', 0, 'file_uploads', 10, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(428, 'file_delete_confirm', 'هل أنت متأكد من أنك تريد حذف هذا الملف؟', 'ar', 0, 'file_uploads', 11, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(429, 'confirm_yes', 'نعم', 'ar', 0, 'form_messages', 5, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(430, 'confirm_no', 'لا', 'ar', 0, 'form_messages', 6, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(431, 'error_heading', 'خطأ', 'ar', 0, 'form_messages', 7, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(432, 'step_validation_failed', 'يرجى ملء جميع الحقول المطلوبة بشكل صحيح.', 'ar', 0, 'form_messages', 8, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(433, 'delete_file', 'حذف فایل', 'fa', 0, 'file_uploads', 12, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(434, 'delete_file', 'Delete File', 'en', 0, 'file_uploads', 12, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(435, 'delete_file', 'حذف الملف', 'ar', 0, 'file_uploads', 12, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(436, 'initializing_form', 'در حال آماده‌سازی فرم...', 'fa', 0, 'form_messages', 9, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(437, 'initializing_form', 'Initializing form...', 'en', 0, 'form_messages', 9, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(438, 'initializing_form', 'جاري تهيئة النموذج...', 'ar', 0, 'form_messages', 9, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(439, 'step_invalid', 'شماره مرحله نامعتبر است.', 'fa', 0, 'form_messages', 10, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(440, 'step_invalid', 'Invalid step number.', 'en', 0, 'form_messages', 10, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(441, 'step_invalid', 'رقم الخطوة غير صالح.', 'ar', 0, 'form_messages', 10, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(442, 'element_not_found', 'المان مورد نظر یافت نشد:', 'fa', 0, 'form_messages', 11, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(443, 'element_not_found', 'Element not found:', 'en', 0, 'form_messages', 11, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(444, 'element_not_found', 'العنصر غير موجود:', 'ar', 0, 'form_messages', 11, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(445, 'file_preview', 'پیش‌نمایش فایل', 'fa', 0, 'file_uploads', 13, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(446, 'file_preview', 'File Preview', 'en', 0, 'file_uploads', 13, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(447, 'file_preview', 'معاينة الملف', 'ar', 0, 'file_uploads', 13, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(448, 'no_file_selected', 'فایلی انتخاب نشده است', 'fa', 0, 'file_uploads', 14, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(449, 'no_file_selected', 'No file selected', 'en', 0, 'file_uploads', 14, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(450, 'no_file_selected', 'لم يتم اختيار ملف', 'ar', 0, 'file_uploads', 14, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(451, 'summary_generated', 'خلاصه اطلاعات تولید شد', 'fa', 0, 'summary', 9, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(452, 'summary_generated', 'Summary generated', 'en', 0, 'summary', 9, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(453, 'summary_generated', 'تم إنشاء الملخص', 'ar', 0, 'summary', 9, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(454, 'data_saved_localstorage', 'اطلاعات فرم در مرورگر ذخیره شد', 'fa', 0, 'form_messages', 12, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(455, 'data_saved_localstorage', 'Form data saved in browser', 'en', 0, 'form_messages', 12, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(456, 'data_saved_localstorage', 'تم حفظ بيانات النموذج في المتصفح', 'ar', 0, 'form_messages', 12, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(457, 'no_saved_data', 'اطلاعات ذخیره شده‌ای یافت نشد', 'fa', 0, 'form_messages', 13, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(458, 'no_saved_data', 'No saved data found', 'en', 0, 'form_messages', 13, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(459, 'no_saved_data', 'لم يتم العثور على بيانات محفوظة', 'ar', 0, 'form_messages', 13, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(460, 'validation_email', 'لطفاً یک آدرس ایمیل معتبر وارد کنید', 'fa', 0, 'validation', 9, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(461, 'validation_email', 'Please enter a valid email address', 'en', 0, 'validation', 9, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(462, 'validation_email', 'الرجاء إدخال عنوان بريد إلكتروني صالح', 'ar', 0, 'validation', 9, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(463, 'validation_phone', 'لطفاً یک شماره تلفن معتبر وارد کنید', 'fa', 0, 'validation', 10, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(464, 'validation_phone', 'Please enter a valid phone number', 'en', 0, 'validation', 10, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50'),
(465, 'validation_phone', 'الرجاء إدخال رقم هاتف صالح', 'ar', 0, 'validation', 10, NULL, '2025-04-13 16:09:50', '2025-04-13 16:09:50');

-- --------------------------------------------------------

--
-- Table structure for table `registration_tokens`
--

CREATE TABLE `registration_tokens` (
  `token_id` varchar(64) NOT NULL,
  `registration_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `expires_at` timestamp NOT NULL DEFAULT '2029-12-31 20:00:00',
  `ip_address` varchar(45) DEFAULT NULL,
  `is_used` tinyint(1) NOT NULL DEFAULT 0,
  `last_used_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration_tokens`
--

INSERT INTO `registration_tokens` (`token_id`, `registration_id`, `created_at`, `expires_at`, `ip_address`, `is_used`, `last_used_at`) VALUES
('2136715447cbc4a1a9cbc87c5823ef65e2be01e7fd6b11cfaf40ea6c166926a4', 15, '2025-04-16 11:05:51', '2025-04-17 11:05:51', '::1', 1, '2025-04-16 11:07:19'),
('597eb6eafb36b253cc8c7a080e377136337db0275c1d5fe3bf384ad21225f4ff', 13, '2025-04-14 19:37:30', '2025-04-15 19:37:30', '127.0.0.1', 1, '2025-04-15 17:04:32'),
('7cbddbd4cf6623ba63bbc78e8d99b5204c4e4ee593f74f5250cb470b0e696151', 14, '2025-04-16 10:57:37', '2025-04-17 10:57:37', '::1', 1, '2025-04-16 11:04:51'),
('aa0aae206ea00fceef21d1eb7cac5a91f529414270b9c2a8b8aedcb247e08d15', 16, '2025-04-16 11:12:25', '2025-04-17 11:12:25', '::1', 1, '2025-04-16 11:12:25');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `media_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `media_id`, `created_at`) VALUES
(1, 87, '2025-03-27 11:53:36'),
(2, 88, '2025-03-27 11:53:36'),
(3, 89, '2025-03-27 11:53:36');

-- --------------------------------------------------------

--
-- Table structure for table `review_translations`
--

CREATE TABLE `review_translations` (
  `review_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `person_name` varchar(100) NOT NULL,
  `person_position` varchar(100) NOT NULL,
  `content` longtext NOT NULL,
  `status` enum('pending','published') DEFAULT 'published',
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review_translations`
--

INSERT INTO `review_translations` (`review_id`, `language_id`, `person_name`, `person_position`, `content`, `status`, `last_updated`) VALUES
(1, 1, 'دکتر سمیه صدر لاهیجانی', 'استاد ادبیات فارسی', 'مدرسه سلمان فارسی محیطی علمی و فرهنگی کم‌نظیر است که با برنامه‌ریزی دقیق، مدیریت مدبرانه و تأکید بر ارزش‌های ایرانی-اسلامی، بستری ایده‌آل برای پرورش نسل آینده فراهم کرده است.', 'published', '2025-03-27 11:53:36'),
(1, 2, 'Dr. Somayeh Sadr Lahijani', 'Professor of Persian Literature', 'Salman Farsi School is a unique academic and cultural environment that, with meticulous planning, wise management, and emphasis on Iranian-Islamic values, provides an ideal foundation for nurturing the next generation.', 'published', '2025-03-27 11:53:36'),
(1, 3, 'د. سميّة صدر لاهيجاني', 'أستاذة الأدب الفارسي', 'مدرسة سلمان الفارسي هي بيئة أكاديمية وثقافية فريدة من نوعها، من خلال التخطيط الدقيق، والإدارة الحكيمة، والتركيز على القيم الإيرانية الإسلامية، توفر أساساً مثالياً لتربية الجيل القادم.', 'published', '2025-03-27 11:53:36'),
(2, 1, 'مهندس علی دشتبان', 'فارغ‌التحصیل کارشناسی ارشد مهندسی عمران', 'این مجموعه با بهره‌گیری از امکانات به‌روز، اساتید توانمند و مدیریت کارآمد، نقش بسزایی در ارتقاء سطح علمی و اخلاقی دانش‌آموزان ایفا می‌کند.', 'published', '2025-03-27 11:53:36'),
(2, 2, 'Engineer Ali Dashtban', 'MSc Graduate in Civil Engineering', 'This institution, utilizing up-to-date facilities, skilled instructors, and efficient management, plays a vital role in enhancing both the academic and ethical levels of its students.', 'published', '2025-03-27 11:53:36'),
(2, 3, 'م. علي دشتبان', 'خريج ماجستير في الهندسة المدنية', 'تلعب هذه المؤسسة، باستخدام المرافق الحديثة والمعلمين المهرة والإدارة الفعالة، دوراً حيوياً في رفع المستويين الأكاديمي والأخلاقي للطلاب.', 'published', '2025-03-27 11:53:36'),
(3, 1, 'فاطمه صدیقی', 'دانشجوی کارشناسی روانشناسی', 'مدرسه سلمان فارسی محیطی پرانرژی و انگیزشی برای یادگیری است که با تمرکز ویژه بر تربیت شخصیت و تقویت مهارت‌های اجتماعی، آینده‌ای روشن و موفقیت‌آمیز برای دانش‌آموزان رقم می‌زند.', 'published', '2025-03-27 11:53:36'),
(3, 2, 'Fatemeh Sedighi', 'Bachelor\'s Student in Psychology', 'Salman Farsi School is an energetic and motivational learning environment that, with its special focus on character development and social skills, creates a bright and successful future for its students.', 'published', '2025-03-27 11:53:36'),
(3, 3, 'فاطمة صديقي', 'طالبة بكالوريوس في علم النفس', 'مدرسة سلمان الفارسي هي بيئة تعليمية نشطة ومحفزة، مع تركيزها الخاص على تنمية الشخصية والمهارات الاجتماعية، تخلق مستقبلاً مشرقاً وناجحاً للطلاب.', 'published', '2025-03-27 11:53:36');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `access_level` int(11) NOT NULL DEFAULT 1,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `access_level`, `description`) VALUES
(1, 'Super Admin', 100, 'دسترسی کامل به تمام بخش‌های سیستم'),
(2, 'Content Manager', 50, 'مدیریت محتوا شامل مطالب، صفحات و دسته‌بندی‌ها'),
(3, 'Student Manager', 30, 'مدیریت دانش‌آموزان و اطلاعات مرتبط');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `type`, `created_at`, `updated_at`) VALUES
(1, 'logo_path', 'assets/images/logo-dark.png', 'image', '2025-03-29 09:16:18', '2025-03-29 09:16:18'),
(2, 'logo_mobile_path', 'assets/images/logo-light.png', 'image', '2025-03-29 09:16:18', '2025-03-29 09:16:18'),
(3, 'site_name', 'Salman Farsi Educational Complex', 'text', '2025-03-29 09:16:18', '2025-03-29 09:16:18'),
(4, 'site_description', 'Salman Farsi Iranian School Dubai', 'text', '2025-03-29 09:16:18', '2025-03-29 09:16:18'),
(5, 'primary_color', '#6461FC', 'color', '2025-03-29 09:16:18', '2025-03-29 09:16:18'),
(6, 'secondary_color', '#FF7A1A', 'color', '2025-03-29 09:16:18', '2025-03-29 09:16:18'),
(7, 'accent_color', '#7854f7', 'color', '2025-03-29 09:16:18', '2025-03-29 09:16:18'),
(8, 'logo_path', 'assets/images/logo-dark.png', 'image', '2025-03-29 09:16:56', '2025-03-29 09:16:56'),
(9, 'logo_mobile_path', 'assets/images/logo-light.png', 'image', '2025-03-29 09:16:56', '2025-03-29 09:16:56'),
(10, 'site_name', 'Salman Farsi Educational Complex', 'text', '2025-03-29 09:16:56', '2025-03-29 09:16:56'),
(11, 'site_description', 'Salman Farsi Iranian School Dubai', 'text', '2025-03-29 09:16:56', '2025-03-29 09:16:56'),
(12, 'primary_color', '#6461FC', 'color', '2025-03-29 09:16:56', '2025-03-29 09:16:56'),
(13, 'secondary_color', '#FF7A1A', 'color', '2025-03-29 09:16:56', '2025-03-29 09:16:56'),
(14, 'accent_color', '#7854f7', 'color', '2025-03-29 09:16:56', '2025-03-29 09:16:56'),
(15, 'apply_now', 'Terms and Conditions for Registration.php', 'button_url', '2025-03-29 09:16:56', '2025-03-29 09:16:56');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL,
  `key` varchar(100) NOT NULL,
  `value` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_name_en', 'Salman Farsi Educational Complex', '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(2, 'site_name_fa', 'مجتمع آموزشی سلمان فارسی', '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(3, 'site_name_ar', 'مجمع سلمان الفارسي التعليمي', '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(4, 'logo_dark_path', 'assets/images/logo-dark.png', '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(5, 'logo_light_path', 'assets/images/logo-light.png', '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(6, 'apply_now_text_en', 'Apply Now', '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(7, 'apply_now_text_fa', 'ثبت‌نام', '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(8, 'apply_now_text_ar', 'سجل الآن', '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(9, 'apply_now_url', 'Terms-and-Conditions-for-Registration.php', '2025-03-29 11:49:06', '2025-04-14 20:08:24');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` int(11) NOT NULL,
  `platform` varchar(50) NOT NULL,
  `icon_class` varchar(50) NOT NULL,
  `url` varchar(255) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `platform`, `icon_class`, `url`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'whatsapp', 'fab fa-whatsapp', 'https://wa.me/97142988116', 1, 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(2, 'youtube', 'fab fa-youtube', 'https://www.youtube.com/@salmanfarsiiranianschool73/videos', 2, 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06'),
(3, 'instagram', 'fab fa-instagram', 'https://www.instagram.com/ir.salmanfarsi/', 3, 1, '2025-03-29 11:49:06', '2025-03-29 11:49:06');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `photo_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `photo_url`) VALUES
(1, 'Akhlasi.png'),
(2, 'Mohammadi.png'),
(3, 'Dashab.png'),
(4, 'Ranjbar.png'),
(5, NULL),
(6, 'Jafari.png'),
(7, NULL),
(8, 'Kazemi.png'),
(9, 'Eslami.png'),
(10, 'Rezaei.png'),
(11, 'Samadi_Vahdati.png'),
(12, 'Kar.png'),
(13, 'Sarnezadeh.png'),
(14, 'Khosroniya.png'),
(15, 'Amin_Gerefteh.png'),
(16, 'Salehi.png'),
(17, 'Razaghian.png'),
(18, 'Dorfesheh.png'),
(19, 'Davoodi.png'),
(20, NULL),
(21, 'Dadashpour.png'),
(22, 'Behzadi.png'),
(23, 'Mirhosseini.png'),
(24, 'Balouchi.png'),
(25, 'mallah.png'),
(26, 'Mojri_Asli.png'),
(27, 'Zare.png'),
(28, NULL),
(29, 'Shokouhi.png'),
(30, NULL),
(31, NULL),
(32, 'Mokhtari.png'),
(33, 'Hashemi.png'),
(34, NULL),
(35, NULL),
(36, 'Payamard.png'),
(37, 'Lamiya.png'),
(38, NULL),
(39, NULL),
(40, NULL),
(41, NULL),
(42, NULL),
(43, NULL),
(44, NULL),
(45, NULL),
(46, NULL),
(47, NULL),
(48, NULL),
(49, NULL),
(50, NULL),
(51, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff_content`
--

CREATE TABLE `staff_content` (
  `id` int(11) NOT NULL,
  `field_key` varchar(255) NOT NULL COMMENT 'Unique identifier for content',
  `content` text NOT NULL COMMENT 'Content text or JSON',
  `language_id` int(11) NOT NULL COMMENT 'Language ID',
  `is_repeatable` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Is this content repeatable',
  `section_id` varchar(50) DEFAULT NULL COMMENT 'Section identifier for grouping',
  `sort_order` int(11) DEFAULT 0 COMMENT 'Display order for repeatable items',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff_content`
--

INSERT INTO `staff_content` (`id`, `field_key`, `content`, `language_id`, `is_repeatable`, `section_id`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'page_title', 'کارکنان مجتمع', 1, 0, 'meta', 0, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(2, 'header_title', 'کارکنان مجتمع', 1, 0, 'header', 0, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(3, 'header_subtitle', 'آشنایی با اعضای هیئت علمی و کارکنان مجتمع آموزشی سلمان فارسی', 1, 0, 'header', 1, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(4, 'search_placeholder', 'جستجوی نام یا سمت...', 1, 0, 'search', 0, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(5, 'filter_all', 'همه', 1, 0, 'filter', 0, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(6, 'filter_management', 'مدیریت', 1, 0, 'filter', 1, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(7, 'filter_teaching', 'آموزشی', 1, 0, 'filter', 2, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(8, 'filter_support', 'پشتیبانی', 1, 0, 'filter', 3, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(9, 'no_staff_found', 'هیچ عضوی یافت نشد', 1, 0, 'messages', 0, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(10, 'no_results_title', 'نتیجه‌ای یافت نشد', 1, 0, 'messages', 1, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(11, 'no_results_message', 'هیچ اعضایی با معیارهای جستجوی شما یافت نشد. لطفاً معیارهای جستجو را تغییر دهید.', 1, 0, 'messages', 2, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(12, 'reset_button', 'بازنشانی', 1, 0, 'buttons', 0, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(13, 'email_title', 'ایمیل', 1, 0, 'labels', 0, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(14, 'profile_title', 'مشاهده پروفایل', 1, 0, 'labels', 1, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(15, 'management_title', 'کادر مدیریتی', 1, 0, 'overview', 0, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(16, 'management_desc', 'مدیران مجتمع با تجربه و دانش کافی در زمینه مدیریت آموزشی', 1, 0, 'overview', 1, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(17, 'teaching_title', 'کادر آموزشی', 1, 0, 'overview', 2, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(18, 'teaching_desc', 'معلمان متخصص با تجربه تدریس در زمینه‌های مختلف آموزشی', 1, 0, 'overview', 3, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(19, 'support_title', 'کادر پشتیبانی', 1, 0, 'overview', 4, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(20, 'support_desc', 'همکاران پشتیبانی که در ارائه خدمات آموزشی با کیفیت به دانش‌آموزان یاری می‌رسانند', 1, 0, 'overview', 5, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(21, 'profile_modal_title', 'اطلاعات کامل', 1, 0, 'modal', 0, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(22, 'close_button', 'بستن', 1, 0, 'buttons', 1, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(23, 'profile_error', 'خطا در بارگذاری اطلاعات', 1, 0, 'messages', 3, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(24, 'management_positions', 'مدیر,معاون,حسابدار,معاون اجرایی,معاون آموزشی,معاون پرورشی', 1, 0, 'categories', 0, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(25, 'teaching_positions', 'دبیر,آموزگار,مربی زبان,هنرآموز', 1, 0, 'categories', 1, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(26, 'page_title', 'Our Team', 2, 0, 'meta', 0, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(27, 'header_title', 'Our Team', 2, 0, 'header', 0, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(28, 'header_subtitle', 'Meet the academic staff and personnel of Salman Farsi Educational Complex', 2, 0, 'header', 1, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(29, 'search_placeholder', 'Search by name or position...', 2, 0, 'search', 0, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(30, 'filter_all', 'All', 2, 0, 'filter', 0, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(31, 'filter_management', 'Management', 2, 0, 'filter', 1, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(32, 'filter_teaching', 'Teaching', 2, 0, 'filter', 2, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(33, 'filter_support', 'Support', 2, 0, 'filter', 3, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(34, 'no_staff_found', 'No staff members found', 2, 0, 'messages', 0, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(35, 'no_results_title', 'No Results Found', 2, 0, 'messages', 1, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(36, 'no_results_message', 'No staff members match your search criteria. Please try different search terms.', 2, 0, 'messages', 2, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(37, 'reset_button', 'Reset', 2, 0, 'buttons', 0, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(38, 'email_title', 'Email', 2, 0, 'labels', 0, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(39, 'profile_title', 'View Profile', 2, 0, 'labels', 1, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(40, 'management_title', 'Management Team', 2, 0, 'overview', 0, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(41, 'management_desc', 'Experienced managers with expertise in educational administration', 2, 0, 'overview', 1, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(42, 'teaching_title', 'Teaching Staff', 2, 0, 'overview', 2, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(43, 'teaching_desc', 'Qualified teachers with extensive experience in various educational fields', 2, 0, 'overview', 3, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(44, 'support_title', 'Support Staff', 2, 0, 'overview', 4, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(45, 'support_desc', 'Support personnel assisting in providing quality educational services to students', 2, 0, 'overview', 5, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(46, 'profile_modal_title', 'Staff Profile', 2, 0, 'modal', 0, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(47, 'close_button', 'Close', 2, 0, 'buttons', 1, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(48, 'profile_error', 'Error loading profile data', 2, 0, 'messages', 3, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(49, 'management_positions', 'Management,Deputy,Accountant,Deputy manager,Educational Assistant', 2, 0, 'categories', 0, '2025-03-29 21:00:44', '2025-03-29 21:00:44'),
(50, 'teaching_positions', 'Teacher,language instructor', 2, 0, 'categories', 1, '2025-03-29 21:00:44', '2025-03-29 21:00:44');

-- --------------------------------------------------------

--
-- Table structure for table `staff_translations`
--

CREATE TABLE `staff_translations` (
  `staff_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `education` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_translations`
--

INSERT INTO `staff_translations` (`staff_id`, `language_id`, `name`, `position`, `education`, `bio`) VALUES
(1, 1, 'مجید اخلاصی', 'مدیر', 'فوق لیسانس زیست شناسی', 'مدیر با تجربه و متعهد مجتمع آموزشی سلمان با سال‌ها سابقه در زمینه مدیریت آموزشی'),
(1, 2, 'Majid Akhlasi', 'Principal', 'Master of Biology', 'Experienced and committed principal of Salman Educational Complex with years of experience in educational management'),
(1, 3, 'مجيد إخلاصي', 'المدير', 'ماجستير في علم الأحياء', 'مدير ذو خبرة وملتزم لمجمع سلمان التعليمي مع سنوات من الخبرة في الإدارة التعليمية'),
(2, 1, 'محمد رضا محمدی', 'معاون متوسطه دوم', 'فوق لیسانس روانشناسی', 'معاون با تجربه متوسطه دوم با تخصص در روانشناسی آموزشی و تربیتی'),
(2, 2, 'Mohammad Reza Mohammadi', 'High School Vice Principal', 'Master of Psychology', 'Experienced high school vice principal specializing in educational and developmental psychology'),
(2, 3, 'محمد رضا محمدي', 'نائب مدير المدرسة الثانوية', 'ماجستير في علم النفس', 'نائب مدير المدرسة الثانوية ذو خبرة متخصص في علم النفس التربوي والتنموي'),
(3, 1, 'نصرت داشاب', 'معاون آموزشی', 'لیسانس کودکان استثنایی', 'معاون آموزشی مجرب با تخصص در زمینه آموزش کودکان با نیازهای ویژه'),
(3, 2, 'Nosrat Dashab', 'Educational Deputy', 'Bachelor of Special Education', 'Experienced educational deputy specializing in education for children with special needs'),
(3, 3, 'نصرت داشاب', 'نائب التعليم', 'بكالوريوس في التربية الخاصة', 'نائب تعليمي ذو خبرة متخصص في تعليم الأطفال ذوي الاحتياجات الخاصة'),
(4, 1, 'حسن رنجبر', 'معاون پرورشی', 'فوق لیسانس تاریخ', 'معاون پرورشی فعال در زمینه فعالیت‌های فرهنگی و اجتماعی'),
(4, 2, 'Hassan Ranjbar', 'Cultural Affairs Deputy', 'Master of History', 'Active cultural affairs deputy in the field of cultural and social activities'),
(4, 3, 'حسن رنجبر', 'نائب الشؤون الثقافية', 'ماجستير في التاريخ', 'نائب نشط للشؤون الثقافية في مجال الأنشطة الثقافية والاجتماعية'),
(5, 1, 'مرتضی حسینیان', 'حسابدار', 'دیپلم کامپیوتر', 'حسابدار با تجربه و دقیق مجتمع آموزشی'),
(5, 2, 'Morteza Hosseinian', 'Accountant', 'Computer Science Diploma', 'Experienced and accurate accountant for the educational complex'),
(5, 3, 'مرتضى حسينيان', 'محاسب', 'دبلوم في علوم الكمبيوتر', 'محاسب دقيق وذو خبرة للمجمع التعليمي'),
(6, 1, 'معصومه جعفری', 'معاون اجرایی', '', 'معاون اجرایی توانمند در مدیریت امور اداری مجتمع'),
(6, 2, 'Masoomeh Jafari', 'Executive Deputy', '', 'Capable executive deputy in managing administrative affairs of the complex'),
(6, 3, 'معصومة جعفري', 'النائب التنفيذي', '', 'نائب تنفيذي قادر على إدارة الشؤون الإدارية للمجمع'),
(7, 1, 'سکینه پیره', 'رابط عربی', 'دیپلم علوم تجربی', 'رابط و مترجم زبان عربی مجتمع آموزشی'),
(7, 2, 'Sakineh Pireh', 'Arabic Liaison', 'Experimental Sciences Diploma', 'Arabic language liaison and translator for the educational complex'),
(7, 3, 'سكينة بيره', 'منسق اللغة العربية', 'دبلوم في العلوم التجريبية', 'منسق ومترجم اللغة العربية للمجمع التعليمي'),
(8, 1, 'معصومه کاظمی', 'پرستار', 'لیسانس پرستاری', 'پرستار با تجربه و متخصص در امور بهداشتی و مراقبت‌های پزشکی'),
(8, 2, 'Masoomeh Kazemi', 'Nurse', 'Bachelor of Nursing', 'Experienced and specialized nurse in health affairs and medical care'),
(8, 3, 'معصومة كاظمي', 'ممرضة', 'بكالوريوس في التمريض', 'ممرضة ذات خبرة ومتخصصة في الشؤون الصحية والرعاية الطبية'),
(9, 1, 'فتحیه اسلامی', 'پرورشی ابتدایی', 'لیسانس مدیریت بازرگانی', 'مسئول امور پرورشی و تربیتی مقطع ابتدایی'),
(9, 2, 'Fathieh Eslami', 'Elementary Cultural Affairs', 'Bachelor of Business Administration', 'Responsible for cultural and educational affairs in the elementary section'),
(9, 3, 'فتحية إسلامي', 'مسؤولة الشؤون الثقافية الابتدائية', 'بكالوريوس في إدارة الأعمال', 'مسؤولة عن الشؤون الثقافية والتربوية في القسم الابتدائي'),
(10, 1, 'نادر رضایی', 'دبیر', 'فوق لیسانس جغرافیای طبیعی', 'دبیر با تجربه و متخصص جغرافیا'),
(10, 2, 'Nader Rezaei', 'Teacher', 'Master of Physical Geography', 'Experienced and specialized geography teacher'),
(10, 3, 'نادر رضائي', 'مدرس', 'ماجستير في الجغرافيا الطبيعية', 'مدرس جغرافيا ذو خبرة ومتخصص'),
(11, 1, 'فرزاد صمدی وحدتی', 'دبیر', 'لیسانس مهندسی هوا و فضا', 'دبیر علاقه‌مند به علوم پایه و مهندسی'),
(11, 2, 'Farzad Samadi Vahdati', 'Teacher', 'Bachelor of Aerospace Engineering', 'Teacher interested in basic sciences and engineering'),
(11, 3, 'فرزاد صمدي وحدتي', 'مدرس', 'بكالوريوس في هندسة الطيران والفضاء', 'مدرس مهتم بالعلوم الأساسية والهندسة'),
(12, 1, 'امیر حسین کر', 'دبیر', 'فوق لیسانس مدیریت آموزشی', 'دبیر متخصص با سابقه طولانی در آموزش'),
(12, 2, 'Amir Hossein Kar', 'Teacher', 'Master of Educational Management', 'Specialized teacher with long experience in education'),
(12, 3, 'أمير حسين كر', 'مدرس', 'ماجستير في الإدارة التعليمية', 'مدرس متخصص ذو خبرة طويلة في التعليم'),
(13, 1, 'مجید سرنی زاده', 'دبیر', 'فوق لیسانس ریاضی', 'دبیر ریاضی با تجربه و علاقه‌مند به تدریس مفاهیم ریاضی'),
(13, 2, 'Majid Sarnezadeh', 'Teacher', 'Master of Mathematics', 'Experienced mathematics teacher interested in teaching mathematical concepts'),
(13, 3, 'مجيد سرني زاده', 'مدرس', 'ماجستير في الرياضيات', 'مدرس رياضيات ذو خبرة ومهتم بتدريس المفاهيم الرياضية'),
(14, 1, 'وحید خسرونیا', 'دبیر', 'لیسانس مدیریت بازرگانی', 'دبیر خلاق و نوآور در زمینه تدریس'),
(14, 2, 'Vahid Khosroniya', 'Teacher', 'Bachelor of Business Administration', 'Creative and innovative teacher in teaching methods'),
(14, 3, 'وحيد خسرونيا', 'مدرس', 'بكالوريوس في إدارة الأعمال', 'مدرس مبدع ومبتكر في أساليب التدريس'),
(15, 1, 'شاپور امین گرفته', 'دبیر', 'لیسانس زبان انگلیسی', 'دبیر زبان انگلیسی با مهارت بالا در زمینه آموزش زبان'),
(15, 2, 'Shapoor Amin Gerefteh', 'Teacher', 'Bachelor of English Language', 'English language teacher with high skills in language teaching'),
(15, 3, 'شابور أمين گرفته', 'مدرس', 'بكالوريوس في اللغة الإنجليزية', 'مدرس لغة إنجليزية ذو مهارات عالية في تدريس اللغة'),
(16, 1, 'ناصر صالحی', 'دبیر', 'فوق لیسانس زبان', 'متخصص زبان‌شناسی و آموزش زبان‌های خارجی'),
(16, 2, 'Naser Salehi', 'Teacher', 'Master of Language', 'Specialist in linguistics and foreign language teaching'),
(16, 3, 'ناصر صالحي', 'مدرس', 'ماجستير في اللغة', 'متخصص في اللغويات وتدريس اللغات الأجنبية'),
(17, 1, 'علی اصغر رازقیان', 'دبیر', 'لیسانس ادبیات فارسی', 'دبیر ادبیات فارسی با عشق به ادبیات کلاسیک و معاصر'),
(17, 2, 'Ali Asghar Razaghian', 'Teacher', 'Bachelor of Persian Literature', 'Persian literature teacher with a love for classical and contemporary literature'),
(17, 3, 'علي أصغر رازقيان', 'مدرس', 'بكالوريوس في الأدب الفارسي', 'مدرس أدب فارسي يحب الأدب الكلاسيكي والمعاصر'),
(18, 1, 'عزیز درفشه', 'دبیر', 'فوق دیپلم ادبیات', 'دبیر با تجربه در زمینه ادبیات و هنر'),
(18, 2, 'Aziz Dorfesheh', 'Teacher', 'Associate Degree in Literature', 'Experienced teacher in literature and arts'),
(18, 3, 'عزيز درفشه', 'مدرس', 'درجة معهد في الأدب', 'مدرس ذو خبرة في الأدب والفنون'),
(19, 1, 'عبدالرحیم داودی', 'دبیر', 'لیسانس الهیات و معارف', 'دبیر دروس دینی و قرآن با تسلط کامل بر مفاهیم دینی'),
(19, 2, 'Abdolrahim Davoodi', 'Teacher', 'Bachelor of Theology and Spirituality', 'Teacher of religious courses and Quran with complete mastery of religious concepts'),
(19, 3, 'عبد الرحيم داودي', 'مدرس', 'بكالوريوس في اللاهوت والمعارف', 'مدرس للدروس الدينية والقرآن مع إتقان كامل للمفاهيم الدينية'),
(20, 1, 'علیرضا کریمی', 'دبیر', 'فوق لیسانس', 'دبیر توانمند و مسلط به روش‌های نوین تدریس'),
(20, 2, 'Alireza Karimi', 'Teacher', 'Master Degree', 'Capable teacher skilled in modern teaching methods'),
(20, 3, 'علي رضا كريمي', 'مدرس', 'درجة الماجستير', 'مدرس قادر ماهر في أساليب التدريس الحديثة'),
(21, 1, 'پرویز داداش پور', 'دبیر', '', 'دبیر با تجربه و محبوب دانش‌آموزان'),
(21, 2, 'Parviz Dadashpour', 'Teacher', '', 'Experienced teacher beloved by students'),
(21, 3, 'برويز داداش بور', 'مدرس', '', 'مدرس ذو خبرة ومحبوب من قبل الطلاب'),
(22, 1, 'بیژن بهزادی', 'دبیر', '', 'دبیر خلاق و مبتکر در روش‌های آموزشی'),
(22, 2, 'Bijan Behzadi', 'Teacher', '', 'Creative and innovative teacher in educational methods'),
(22, 3, 'بيجان بهزادي', 'مدرس', '', 'مدرس مبدع ومبتكر في الأساليب التعليمية'),
(23, 1, 'سید امیرضا میرحسینی', 'دبیر', '', 'دبیر با سابقه و متخصص در رشته تحصیلی خود'),
(23, 2, 'Seyyed Amir Reza Mirhosseini', 'Teacher', '', 'Experienced teacher specializing in his field of study'),
(23, 3, 'سيد أمير رضا ميرحسيني', 'مدرس', '', 'مدرس ذو خبرة متخصص في مجال دراسته'),
(24, 1, 'محمد بلوچی', 'دبیر', '', 'دبیر علاقه‌مند به پژوهش و تحقیق'),
(24, 2, 'Mohammad Balouchi', 'Teacher', '', 'Teacher interested in research and investigation'),
(24, 3, 'محمد بلوشي', 'مدرس', '', 'مدرس مهتم بالبحث والاستقصاء'),
(25, 1, 'مهرشاد ملاح', 'معاون متوسطه اول', '', 'معاون متوسطه اول با تجربه در مدیریت آموزشی'),
(25, 2, 'Mehrshad Mallah', 'Middle School Vice Principal', '', 'Middle school vice principal experienced in educational management'),
(25, 3, 'مهرشاد ملاح', 'نائب مدير المدرسة المتوسطة', '', 'نائب مدير المدرسة المتوسطة ذو خبرة في الإدارة التعليمية'),
(26, 1, 'سید محمد رضا مجری اصلی', 'دبیر', 'فوق لیسانس حقوق', 'دبیر متخصص در زمینه علوم اجتماعی و حقوق'),
(26, 2, 'Seyyed Mohammad Reza Mojri Asli', 'Teacher', 'Master of Law', 'Teacher specializing in social sciences and law'),
(26, 3, 'سيد محمد رضا مجري أصلي', 'مدرس', 'ماجستير في القانون', 'مدرس متخصص في العلوم الاجتماعية والقانون'),
(27, 1, 'زارع', 'کتابدار', '', 'کتابدار با تجربه و علاقه‌مند به ترویج کتابخوانی'),
(27, 2, 'Zare', 'Librarian', '', 'Experienced librarian interested in promoting reading'),
(27, 3, 'زارع', 'أمين المكتبة', '', 'أمين مكتبة ذو خبرة مهتم بتعزيز القراءة'),
(28, 1, 'افسانه پوربیاد', 'معاون ابتدایی', 'لیسانس آموزش ابتدایی', 'معاون ابتدایی با سال‌ها تجربه در آموزش کودکان'),
(28, 2, 'Afsaneh Poorbeyad', 'Elementary Vice Principal', 'Bachelor of Elementary Education', 'Elementary vice principal with years of experience in child education'),
(28, 3, 'أفسانه بوربياد', 'نائب مدير المدرسة الابتدائية', 'بكالوريوس في التعليم الابتدائي', 'نائب مدير المدرسة الابتدائية مع سنوات من الخبرة في تعليم الأطفال'),
(29, 1, 'فاطمه شکوهی', 'آموزگار', 'لیسانس روانشناسی', 'آموزگار خلاق و با انگیزه در آموزش به کودکان'),
(29, 2, 'Fatemeh Shokouhi', 'Teacher', 'Bachelor of Psychology', 'Creative and motivated teacher in educating children'),
(29, 3, 'فاطمة شكوهي', 'معلمة', 'بكالوريوس في علم النفس', 'معلمة مبدعة ومتحمسة في تعليم الأطفال'),
(30, 1, 'ملیحه سلیمانی', 'آموزگار', 'دیپلم علوم تجربی', 'آموزگار با تجربه و توانمند در آموزش ابتدایی'),
(30, 2, 'Maliheh Soleimani', 'Teacher', 'Experimental Sciences Diploma', 'Experienced and capable teacher in elementary education'),
(30, 3, 'مليحة سليماني', 'معلمة', 'دبلوم في العلوم التجريبية', 'معلمة ذات خبرة وقدرة في التعليم الابتدائي'),
(31, 1, 'فاطمه ایشه', 'آموزگار', 'لیسانس', 'آموزگار متعهد به امر تعلیم و تربیت دانش‌آموزان'),
(31, 2, 'Fatemeh Eyshah', 'Teacher', 'Bachelor Degree', 'Teacher committed to educating and nurturing students'),
(31, 3, 'فاطمة إيشه', 'معلمة', 'درجة البكالوريوس', 'معلمة ملتزمة بتعليم وتربية الطلاب'),
(32, 1, 'شهین محتاری', 'آموزگار', 'فوق دیپلم شیمی کاربردی', 'آموزگار علاقه‌مند به تدریس علوم پایه'),
(32, 2, 'Shahin Mokhtari', 'Teacher', 'Associate Degree in Applied Chemistry', 'Teacher interested in teaching basic sciences'),
(32, 3, 'شهين مختاري', 'معلمة', 'درجة معهد في الكيمياء التطبيقية', 'معلمة مهتمة بتدريس العلوم الأساسية'),
(33, 1, 'بهاره هاشمی', 'مربی زبان', 'فوق لیسانس زبان انگلیسی', 'مربی زبان انگلیسی با تسلط کامل به روش‌های نوین آموزش زبان'),
(33, 2, 'Bahareh Hashemi', 'Language Instructor', 'Master of English Language', 'English language instructor with complete mastery of modern language teaching methods'),
(33, 3, 'بهاره هاشمي', 'مدرسة لغة', 'ماجستير في اللغة الإنجليزية', 'مدرسة لغة إنجليزية مع إتقان كامل لأساليب تدريس اللغة الحديثة'),
(34, 1, 'سکینه پاینده', 'آموزگار', 'فوق دیپلم آموزش ابتدایی', 'آموزگار با تجربه طولانی در آموزش ابتدایی'),
(34, 2, 'Sakineh Payandeh', 'Teacher', 'Associate Degree in Elementary Education', 'Teacher with long experience in elementary education'),
(34, 3, 'سكينة باينده', 'معلمة', 'درجة معهد في التعليم الابتدائي', 'معلمة ذات خبرة طويلة في التعليم الابتدائي'),
(35, 1, 'فاطمه پوردرویشی', 'آموزگار', 'فوق لیسانس زنتیک', 'آموزگار متخصص در زمینه علوم زیستی و ژنتیک'),
(35, 2, 'Fatemeh Poordarvishi', 'Teacher', 'Master of Genetics', 'Teacher specializing in biological sciences and genetics'),
(35, 3, 'فاطمة بوردرويشي', 'معلمة', 'ماجستير في علم الوراثة', 'معلمة متخصصة في العلوم البيولوجية وعلم الوراثة'),
(36, 1, 'فریبا پایمرد', 'آموزگار', 'لیسانس علوم تربیتی', 'آموزگار با سابقه و مسلط به اصول تعلیم و تربیت'),
(36, 2, 'Fariba Payamard', 'Teacher', 'Bachelor of Educational Sciences', 'Experienced teacher proficient in education principles'),
(36, 3, 'فريبا بايمرد', 'معلمة', 'بكالوريوس في العلوم التربوية', 'معلمة ذات خبرة ومتمكنة من مبادئ التعليم'),
(37, 1, 'لامیا', 'مربی زبان', 'لیسانس زبان و ادبیات عرب', 'مربی زبان عربی با تسلط کامل به زبان عربی'),
(37, 2, 'Lamia', 'Language Instructor', 'Bachelor of Arabic Language and Literature', 'Arabic language instructor with complete mastery of Arabic language'),
(37, 3, 'لامياء', 'مدرسة لغة', 'بكالوريوس في اللغة والأدب العربي', 'مدرسة لغة عربية مع إتقان كامل للغة العربية'),
(38, 1, 'زهرا راهدار', 'مربی زبان', 'لیسانس زبان انگلیسی', 'مربی زبان انگلیسی با روش‌های نوین آموزش'),
(38, 2, 'Zahra Rahdar', 'Language Instructor', 'Bachelor of English Language', 'English language instructor with modern teaching methods'),
(38, 3, 'زهراء راهدار', 'مدرسة لغة', 'بكالوريوس في اللغة الإنجليزية', 'مدرسة لغة إنجليزية مع أساليب تدريس حديثة'),
(39, 1, 'خاطره اکبری', 'معاون آموزشی استثنایی', 'فوق لیسانس', 'معاون آموزشی استثنایی با تجربه در آموزش کودکان با نیازهای خاص'),
(39, 2, 'Khatereh Akbari', 'Special Education Deputy', 'Master Degree', 'Special education deputy with experience in educating children with special needs'),
(39, 3, 'خاطرة أكبري', 'نائب التعليم الخاص', 'درجة الماجستير', 'نائب التعليم الخاص ذات خبرة في تعليم الأطفال ذوي الاحتياجات الخاصة'),
(40, 1, 'طاهره پولادیان', 'آموزگار', 'لیسانس مدیریت آموزشی', 'آموزگار توانمند در مدیریت کلاس درس'),
(40, 2, 'Tahereh Pooladian', 'Teacher', 'Bachelor of Educational Management', 'Capable teacher in classroom management'),
(40, 3, 'طاهرة بولاديان', 'معلمة', 'بكالوريوس في الإدارة التعليمية', 'معلمة قادرة في إدارة الفصل الدراسي'),
(41, 1, 'طاهره پیره', 'آموزگار', 'لیسانس روانشناسی', 'آموزگار با درک عمیق از روانشناسی کودک'),
(41, 2, 'Tahereh Pireh', 'Teacher', 'Bachelor of Psychology', 'Teacher with deep understanding of child psychology'),
(41, 3, 'طاهرة بيره', 'معلمة', 'بكالوريوس في علم النفس', 'معلمة ذات فهم عميق لعلم نفس الطفل'),
(42, 1, 'نادیا رزم آهنگ', 'هنرآموز', 'دیپلم ادبیات و علوم انسانی', 'هنرآموز خلاق و مبتکر در آموزش هنر'),
(42, 2, 'Nadia Razm Ahang', 'Art Teacher', 'High School Diploma in Literature and Humanities', 'Creative and innovative art teacher'),
(42, 3, 'ناديا رزم آهنگ', 'معلمة فنون', 'دبلوم الثانوية في الأدب والعلوم الإنسانية', 'معلمة فنون مبدعة ومبتكرة'),
(43, 1, 'حبیبه شعبانی', 'کمک حسابدار', 'لیسانس روانشناسی', 'کمک حسابدار دقیق و متعهد به امور مالی'),
(43, 2, 'Habibeh Shabani', 'Assistant Accountant', 'Bachelor of Psychology', 'Accurate and committed assistant accountant in financial affairs'),
(43, 3, 'حبيبة شعباني', 'مساعدة محاسب', 'بكالوريوس في علم النفس', 'مساعدة محاسب دقيقة وملتزمة في الشؤون المالية'),
(44, 1, 'عباس رییسی', 'راننده', 'سیکل', 'راننده با تجربه و مسئولیت‌پذیر'),
(44, 2, 'Abbas Raeisi', 'Driver', 'Middle School Education', 'Experienced and responsible driver'),
(44, 3, 'عباس رئيسي', 'سائق', 'تعليم متوسط', 'سائق ذو خبرة ومسؤول'),
(45, 1, 'امامعلی فرخی نژاد', 'راننده', 'سیکل', 'راننده با سابقه و آشنا به مسیرهای مدرسه'),
(45, 2, 'Emamali Farokhi Nejad', 'Driver', 'Middle School Education', 'Experienced driver familiar with school routes'),
(45, 3, 'إمام علي فرخي نجاد', 'سائق', 'تعليم متوسط', 'سائق ذو خبرة يعرف طرق المدرسة'),
(46, 1, 'سید جواد مجری اصل', 'راننده', 'دیپلم', 'راننده متعهد به ایمنی دانش‌آموزان'),
(46, 2, 'Seyyed Javad Mojri Asl', 'Driver', 'High School Diploma', 'Driver committed to student safety'),
(46, 3, 'سيد جواد مجري أصل', 'سائق', 'شهادة الثانوية العامة', 'سائق ملتزم بسلامة الطلاب'),
(47, 1, 'علی صیادی', 'راننده', 'ابتدایی', 'راننده وظیفه‌شناس و مسئولیت‌پذیر'),
(47, 2, 'Ali Sayadi', 'Driver', 'Elementary Education', 'Dutiful and responsible driver'),
(47, 3, 'علي صيادي', 'سائق', 'تعليم ابتدائي', 'سائق ملتزم بالواجب والمسؤولية'),
(48, 1, 'محمد سالاری', 'راننده', 'سیکل', 'راننده با سابقه و آشنا به قوانین رانندگی'),
(48, 2, 'Mohammad Salari', 'Driver', 'Middle School Education', 'Experienced driver familiar with driving regulations'),
(48, 3, 'محمد سالاري', 'سائق', 'تعليم متوسط', 'سائق ذو خبرة يعرف أنظمة القيادة'),
(49, 1, 'مصطفی ذاکری', 'راننده', 'ابتدایی', 'راننده دقیق و منظم در انجام وظایف'),
(49, 2, 'Mostafa Zakeri', 'Driver', 'Elementary Education', 'Accurate and orderly driver in performing duties'),
(49, 3, 'مصطفى ذاكري', 'سائق', 'تعليم ابتدائي', 'سائق دقيق ومنظم في أداء الواجبات'),
(50, 1, 'غلامعباس عباسی', 'راننده', 'سیکل', 'راننده با تجربه و آشنا به مسیرهای مدرسه'),
(50, 2, 'Gholamabbas Abbasi', 'Driver', 'Middle School Education', 'Experienced driver familiar with school routes'),
(50, 3, 'غلام عباس عباسي', 'سائق', 'تعليم متوسط', 'سائق ذو خبرة يعرف طرق المدرسة'),
(51, 1, 'تاج محمد درویش', 'سرایدار', 'بیسواد', 'سرایدار متعهد و مسئولیت‌پذیر در نگهداری از فضای مدرسه'),
(51, 2, 'Taj Mohammad Darvish', 'Janitor', 'Illiterate', 'Committed and responsible janitor in maintaining school facilities'),
(51, 3, 'تاج محمد درويش', 'بواب', 'أمي', 'بواب ملتزم ومسؤول في صيانة مرافق المدرسة');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `birth_date` date NOT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `national_id` varchar(20) DEFAULT NULL,
  `passport_number` varchar(20) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `academic_grade_id` int(11) NOT NULL,
  `major_id` int(11) DEFAULT NULL,
  `bus_route_id` int(11) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `emergency_contact_name` varchar(100) DEFAULT NULL,
  `emergency_contact_phone` varchar(20) DEFAULT NULL,
  `photo_media_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `first_name`, `last_name`, `birth_date`, `gender`, `national_id`, `passport_number`, `nationality`, `religion`, `academic_grade_id`, `major_id`, `bus_route_id`, `address`, `phone`, `emergency_contact_name`, `emergency_contact_phone`, `photo_media_id`, `created_at`, `updated_at`) VALUES
(1, 'Quemby', 'Jefferson', '1974-04-07', 'female', NULL, '353', 'Mongolia', 'Shia Islam', 9, NULL, 1, 'Enim et illum quisq', '+1 (582) 746-5693', 'Levi Curtis', '+1 (973) 139-3435', 90, '2025-03-13 15:00:04', '2025-03-13 15:00:04'),
(2, 'Sydney', 'Patton', '1995-08-30', 'female', NULL, '377', 'Ghana', 'Judaism', 10, 3, 2, 'Mollit rerum quasi v', '+1 (412) 642-9518', 'Deacon Ramirez', '+1 (493) 965-7669', 91, '2025-03-13 15:29:46', '2025-03-13 15:29:46'),
(3, 'Adrienne', 'Harding', '2003-03-25', 'female', NULL, '434', 'Germany', 'Judaism', 11, 4, 3, 'Laborum doloremque l', '+1 (815) 785-7325', 'Amela Solis', '+1 (403) 707-4555', 92, '2025-03-13 15:50:08', '2025-03-13 15:50:08'),
(5, 'Norman', 'Morin', '2002-05-04', 'male', '', '746', 'Pakistan', 'Sunni Islam', 7, NULL, NULL, 'Saepe consequatur a', '+1 (543) 846-6839', 'Arsenio Herring', '+1 (692) 943-8296', 99, '2025-04-02 14:03:24', '2025-04-02 14:03:24'),
(8, 'Courtney', 'Perez', '2009-06-26', 'male', NULL, '327', 'UAE', 'Judaism', 8, NULL, NULL, 'Ut aut id et ullam a', '+1 (771) 517-1866', 'Jerry Dyer', '+1 (494) 306-8875', 101, '2025-04-02 14:10:22', '2025-04-02 14:10:22'),
(9, 'Courtney', 'Perez', '2009-06-26', 'male', NULL, '327', 'UAE', 'Judaism', 8, NULL, NULL, 'Ut aut id et ullam a', '+1 (771) 517-1866', 'Jerry Dyer', '+1 (494) 306-8875', 102, '2025-04-02 14:10:27', '2025-04-02 14:10:27'),
(10, 'Aubrey', 'Larsen', '2014-03-12', 'female', 'Doloremque rerum aut', '371', 'IR', 'other', 8, 1, NULL, 'Qui aut eius vitae e', '+1 (278) 702-4568', 'Delectus corporis m', '+1 (209) 728-1624', NULL, '2025-04-05 08:00:00', '2025-04-05 08:00:00'),
(11, 'September', 'Gibson', '1984-07-23', 'male', 'Labore cul', '50', 'AE', 'christianity', 9, NULL, NULL, 'Molestiae repellendu', '+1 (474) 659-7975', 'Rerum voluptate inve', '+1 (342) 529-6072', NULL, '2025-04-05 16:47:34', '2025-04-05 16:47:34'),
(12, 'Joy', 'Lawson', '2001-07-01', 'male', 'Necessitat', '555s', 'AE', 'judaism', 2, NULL, NULL, 'Incididunt nulla ani', '+1 (839) 273-7984', 'Voluptas molestiae p', '+1 (887) 958-8326', NULL, '2025-04-06 08:19:26', '2025-04-06 08:19:26'),
(13, 'September', 'Cabrera', '2017-04-03', 'male', 'Quasi volu', '133', 'OTHER', 'judaism', 7, 3, NULL, 'Reprehenderit lorem ', '+1 (743) 683-7457', 'Sint perspiciatis a', '+1 (141) 876-3935', NULL, '2025-04-06 11:29:19', '2025-04-06 11:29:19'),
(14, 'Madonna', 'Ayers', '1976-09-19', 'male', NULL, '825', 'TJ', 'judaism', 7, NULL, NULL, 'Debitis et similique', '+1 (308) 105-9277', 'Dane Fitzgerald', '+1 (587) 761-2013', NULL, '2025-04-14 19:15:31', '2025-04-14 19:15:31'),
(16, 'Uma', 'Sheppard', '1986-03-20', 'male', NULL, '3', 'KW', 'christianity', 8, NULL, NULL, 'Molestiae et tempore', '+1 (833) 878-5469', 'Coby Mcfadden', '+1 (159) 304-3117', NULL, '2025-04-14 19:37:30', '2025-04-14 19:37:30'),
(17, 'محمد حسین', 'طباطبایی', '1986-01-19', 'male', '0123654778', '12364', 'IR', 'islam_shia', 10, 4, NULL, 'Quidem iste numquam ', '0509158035', 'Regina White', '+1 (577) 565-4297', NULL, '2025-04-16 10:57:37', '2025-04-16 10:57:37'),
(18, 'Aimee', 'Juarez', '2022-02-26', 'male', NULL, '312', 'TR', 'islam_sunni', 1, NULL, NULL, 'Fugiat quibusdam aut', '+1 (894) 867-7273', 'Micah Hayes', '+1 (925) 458-6486', NULL, '2025-04-16 11:05:51', '2025-04-16 11:05:51'),
(19, 'Yasir', 'Maxwell', '2013-10-25', 'male', NULL, '6', 'TR', 'christianity', 12, 1, NULL, 'Rem sit occaecat cu', '+1 (832) 366-5681', 'Tad Jacobson', '+1 (533) 321-8996', NULL, '2025-04-16 11:12:25', '2025-04-16 11:12:25');

-- --------------------------------------------------------

--
-- Table structure for table `student_parents`
--

CREATE TABLE `student_parents` (
  `student_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `relationship` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_parents`
--

INSERT INTO `student_parents` (`student_id`, `parent_id`, `relationship`) VALUES
(1, 1, 'father'),
(1, 4, 'mother'),
(2, 2, 'father'),
(2, 5, 'mother'),
(3, 3, 'father'),
(3, 6, 'mother'),
(5, 7, 'father'),
(5, 8, 'mother'),
(8, 9, 'father'),
(8, 10, 'mother'),
(9, 11, 'father'),
(9, 12, 'mother'),
(10, 13, 'father'),
(10, 14, 'mother'),
(11, 15, 'father'),
(11, 16, 'mother'),
(12, 17, 'father'),
(12, 18, 'mother'),
(13, 19, 'father'),
(13, 20, 'mother'),
(14, 21, 'father'),
(14, 22, 'mother'),
(16, 25, 'father'),
(16, 26, 'mother'),
(17, 27, 'father'),
(17, 28, 'mother'),
(18, 29, 'father'),
(18, 30, 'mother'),
(19, 31, 'father'),
(19, 32, 'mother');

-- --------------------------------------------------------

--
-- Table structure for table `system_logs`
--

CREATE TABLE `system_logs` (
  `log_id` int(11) NOT NULL,
  `log_type` enum('error','info','warning','security') NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_logs`
--

INSERT INTO `system_logs` (`log_id`, `log_type`, `message`, `created_at`) VALUES
(1, 'info', 'سایت با موفقیت راه‌اندازی شد.', '2025-03-27 12:27:53'),
(2, 'security', 'ورود ناموفق به حساب مدیریت.', '2025-03-27 12:27:53'),
(3, 'info', 'student_registration: Student registration completed: Norman Morin | IP: 127.0.0.1 | User: 5', '2025-04-02 14:03:24'),
(4, 'info', 'student_registration: Student registration completed: Courtney Perez | IP: 127.0.0.1 | User: 8', '2025-04-02 14:10:22'),
(5, 'info', 'student_registration: Student registration completed: Courtney Perez | IP: 127.0.0.1 | User: 9', '2025-04-02 14:10:27');

-- --------------------------------------------------------

--
-- Table structure for table `theme_settings`
--

CREATE TABLE `theme_settings` (
  `setting_id` int(11) NOT NULL,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `theme_settings`
--

INSERT INTO `theme_settings` (`setting_id`, `setting_key`, `setting_value`, `updated_at`) VALUES
(1, 'primary_color', '#004080', '2025-03-27 12:27:21'),
(2, 'secondary_color', '#f2f2f2', '2025-03-27 12:27:21'),
(3, 'font_family', 'Vazir', '2025-03-27 12:27:21');

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

CREATE TABLE `translations` (
  `id` int(11) NOT NULL,
  `language_id` varchar(5) NOT NULL,
  `type` varchar(50) NOT NULL,
  `key_name` varchar(100) NOT NULL,
  `value` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `translations`
--

INSERT INTO `translations` (`id`, `language_id`, `type`, `key_name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'fa', 'button', 'apply_now', 'ثبت‌نام', '2025-03-29 09:16:56', '2025-03-29 09:16:56'),
(2, 'en', 'button', 'apply_now', 'Apply Now', '2025-03-29 09:16:56', '2025-03-29 09:16:56'),
(3, 'ar', 'button', 'apply_now', 'سجل الآن', '2025-03-29 09:16:56', '2025-03-29 09:16:56'),
(4, 'fa', 'general', 'select_language', 'انتخاب زبان:', '2025-03-29 09:16:56', '2025-03-29 09:16:56'),
(5, 'en', 'general', 'select_language', 'Select Language:', '2025-03-29 09:16:56', '2025-03-29 09:16:56'),
(6, 'ar', 'general', 'select_language', 'اختر اللغة:', '2025-03-29 09:16:56', '2025-03-29 09:16:56'),
(7, 'fa', 'general', 'search_placeholder', 'جستجو کنید...', '2025-03-29 09:16:56', '2025-03-29 09:16:56'),
(8, 'en', 'general', 'search_placeholder', 'Search Here...', '2025-03-29 09:16:56', '2025-03-29 09:16:56'),
(9, 'ar', 'general', 'search_placeholder', 'ابحث هنا...', '2025-03-29 09:16:56', '2025-03-29 09:16:56'),
(10, 'fa', 'general', 'home', 'خانه', '2025-03-29 09:16:56', '2025-03-29 09:16:56'),
(11, 'en', 'general', 'home', 'Home', '2025-03-29 09:16:56', '2025-03-29 09:16:56'),
(12, 'ar', 'general', 'home', 'الرئيسية', '2025-03-29 09:16:56', '2025-03-29 09:16:56'),
(13, 'fa', 'general', 'search', 'جستجو', '2025-03-29 09:16:56', '2025-03-29 09:16:56'),
(14, 'en', 'general', 'search', 'Search', '2025-03-29 09:16:56', '2025-03-29 09:16:56'),
(15, 'ar', 'general', 'search', 'بحث', '2025-03-29 09:16:56', '2025-03-29 09:16:56'),
(16, 'fa', 'general', 'language', 'زبان', '2025-03-29 09:16:56', '2025-03-29 09:16:56'),
(17, 'en', 'general', 'language', 'Language', '2025-03-29 09:16:56', '2025-03-29 09:16:56'),
(18, 'ar', 'general', 'language', 'اللغة', '2025-03-29 09:16:56', '2025-03-29 09:16:56'),
(19, 'fa', 'general', 'menu', 'منو', '2025-03-29 09:16:56', '2025-03-29 09:16:56'),
(20, 'en', 'general', 'menu', 'Menu', '2025-03-29 09:16:56', '2025-03-29 09:16:56'),
(21, 'ar', 'general', 'menu', 'القائمة', '2025-03-29 09:16:56', '2025-03-29 09:16:56');

-- --------------------------------------------------------

--
-- Table structure for table `translation_logs`
--

CREATE TABLE `translation_logs` (
  `log_id` int(11) NOT NULL,
  `queue_id` int(11) DEFAULT NULL,
  `engine` varchar(100) DEFAULT NULL,
  `response_time` float DEFAULT NULL,
  `error_message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `translation_queue`
--

CREATE TABLE `translation_queue` (
  `queue_id` int(11) NOT NULL,
  `source_table` varchar(50) DEFAULT NULL,
  `source_id` int(11) DEFAULT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `source_language_id` int(11) DEFAULT NULL,
  `target_language_id` int(11) DEFAULT NULL,
  `status` enum('pending','processing','done','failed') DEFAULT 'pending',
  `result` text DEFAULT NULL,
  `requested_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `processed_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password_hash`, `full_name`, `email`, `role_id`, `status`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2b$12$j78sGrUuWcDisdZI.yt/bOxYvydGxf1r8Rw.KXxgy.w0NL649oJB6', 'مدیر سیستم', 'admin@salman-school.edu', 1, 'active', NULL, '2025-03-14 16:52:24', '2025-03-14 16:52:24'),
(2, 'elyas_malaeka', '$2b$12$Fvj6wTFkE4yQcHo9zL9tMOOjq8TufUgz81GrkOgA35wZArouzHWDS', 'الیاس ملائکه', 'elyasmalaeka@gmail.com', 1, 'active', '2025-03-15 03:49:39', '2025-03-14 23:49:16', '2025-03-14 23:49:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_content`
--
ALTER TABLE `about_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `academic_grades`
--
ALTER TABLE `academic_grades`
  ADD PRIMARY KEY (`grade_id`);

--
-- Indexes for table `academic_grade_translations`
--
ALTER TABLE `academic_grade_translations`
  ADD PRIMARY KEY (`grade_id`,`language_id`),
  ADD KEY `language_id` (`language_id`);

--
-- Indexes for table `blog_content`
--
ALTER TABLE `blog_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `field_key_language` (`field_key`,`language_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `bus_routes`
--
ALTER TABLE `bus_routes`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `bus_route_translations`
--
ALTER TABLE `bus_route_translations`
  ADD PRIMARY KEY (`route_id`,`language_id`),
  ADD KEY `language_id` (`language_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `category_translations`
--
ALTER TABLE `category_translations`
  ADD PRIMARY KEY (`category_id`,`language_id`),
  ADD KEY `language_id` (`language_id`);

--
-- Indexes for table `chatbot_messages`
--
ALTER TABLE `chatbot_messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `contact_content`
--
ALTER TABLE `contact_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `language_id` (`language_id`);

--
-- Indexes for table `contact_info`
--
ALTER TABLE `contact_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `submit_date` (`submit_date`);

--
-- Indexes for table `curriculum_content`
--
ALTER TABLE `curriculum_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `field_key_language` (`field_key`,`language_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`document_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `ehsan_content`
--
ALTER TABLE `ehsan_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `field_key_language` (`field_key`,`language_id`),
  ADD KEY `section_sort` (`section_id`,`sort_order`);

--
-- Indexes for table `error_content`
--
ALTER TABLE `error_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `field_key_language` (`field_key`,`language_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `facilities_content`
--
ALTER TABLE `facilities_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `field_key_language` (`field_key`,`language_id`),
  ADD KEY `section_sort` (`section_id`,`sort_order`);

--
-- Indexes for table `faq_content`
--
ALTER TABLE `faq_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `field_key_language` (`field_key`,`language_id`),
  ADD KEY `category_sort` (`category_id`,`sort_order`);

--
-- Indexes for table `footer_content`
--
ALTER TABLE `footer_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `field_key_lang_idx` (`field_key`,`language_id`),
  ADD KEY `section_idx` (`section_id`);

--
-- Indexes for table `form_fields`
--
ALTER TABLE `form_fields`
  ADD PRIMARY KEY (`field_id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `parent_field_id` (`parent_field_id`);

--
-- Indexes for table `form_field_translations`
--
ALTER TABLE `form_field_translations`
  ADD PRIMARY KEY (`translation_id`),
  ADD UNIQUE KEY `field_language` (`field_id`,`language_id`),
  ADD KEY `language_id` (`language_id`);

--
-- Indexes for table `form_options`
--
ALTER TABLE `form_options`
  ADD PRIMARY KEY (`option_id`),
  ADD KEY `field_id` (`field_id`);

--
-- Indexes for table `form_option_translations`
--
ALTER TABLE `form_option_translations`
  ADD PRIMARY KEY (`translation_id`),
  ADD UNIQUE KEY `option_language` (`option_id`,`language_id`),
  ADD KEY `language_id` (`language_id`);

--
-- Indexes for table `form_sections`
--
ALTER TABLE `form_sections`
  ADD PRIMARY KEY (`section_id`),
  ADD UNIQUE KEY `section_key` (`section_key`),
  ADD KEY `parent_section_id` (`parent_section_id`);

--
-- Indexes for table `form_section_translations`
--
ALTER TABLE `form_section_translations`
  ADD PRIMARY KEY (`translation_id`),
  ADD UNIQUE KEY `section_language` (`section_id`,`language_id`),
  ADD KEY `language_id` (`language_id`);

--
-- Indexes for table `home_content`
--
ALTER TABLE `home_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_field_lang` (`section_id`,`field_key`,`language_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`language_id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`major_id`);

--
-- Indexes for table `major_translations`
--
ALTER TABLE `major_translations`
  ADD PRIMARY KEY (`major_id`,`language_id`),
  ADD KEY `language_id` (`language_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`media_id`),
  ADD KEY `uploaded_by` (`uploaded_by`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  ADD PRIMARY KEY (`subscriber_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `target_role_id` (`target_role_id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`parent_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permission_id`),
  ADD UNIQUE KEY `permission_name` (`permission_name`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `main_media_id` (`main_media_id`);

--
-- Indexes for table `post_content`
--
ALTER TABLE `post_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `field_key_language` (`field_key`,`language_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `post_translations`
--
ALTER TABLE `post_translations`
  ADD PRIMARY KEY (`post_id`,`language_id`),
  ADD KEY `language_id` (`language_id`);

--
-- Indexes for table `post_widgets`
--
ALTER TABLE `post_widgets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `widget_key` (`widget_key`);

--
-- Indexes for table `privacy_content`
--
ALTER TABLE `privacy_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `field_key_language` (`field_key`,`language_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`registration_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `registration_success_content`
--
ALTER TABLE `registration_success_content`
  ADD PRIMARY KEY (`content_id`),
  ADD UNIQUE KEY `content_key` (`content_key`);

--
-- Indexes for table `registration_success_translations`
--
ALTER TABLE `registration_success_translations`
  ADD PRIMARY KEY (`translation_id`),
  ADD UNIQUE KEY `content_language` (`content_id`,`language_id`),
  ADD KEY `reg_success_lang_fk` (`language_id`);

--
-- Indexes for table `registration_terms_content`
--
ALTER TABLE `registration_terms_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `field_key` (`field_key`),
  ADD KEY `language_id` (`language_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `registration_tokens`
--
ALTER TABLE `registration_tokens`
  ADD PRIMARY KEY (`token_id`),
  ADD KEY `registration_id` (`registration_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `media_id` (`media_id`);

--
-- Indexes for table `review_translations`
--
ALTER TABLE `review_translations`
  ADD PRIMARY KEY (`review_id`,`language_id`),
  ADD KEY `language_id` (`language_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `permission_id` (`permission_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_content`
--
ALTER TABLE `staff_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `field_key_language` (`field_key`,`language_id`),
  ADD KEY `language_id` (`language_id`);

--
-- Indexes for table `staff_translations`
--
ALTER TABLE `staff_translations`
  ADD PRIMARY KEY (`staff_id`,`language_id`),
  ADD KEY `language_id` (`language_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `uniq_national_id` (`national_id`),
  ADD KEY `academic_grade_id` (`academic_grade_id`),
  ADD KEY `major_id` (`major_id`),
  ADD KEY `bus_route_id` (`bus_route_id`);

--
-- Indexes for table `student_parents`
--
ALTER TABLE `student_parents`
  ADD PRIMARY KEY (`student_id`,`parent_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `system_logs`
--
ALTER TABLE `system_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `theme_settings`
--
ALTER TABLE `theme_settings`
  ADD PRIMARY KEY (`setting_id`),
  ADD UNIQUE KEY `setting_key` (`setting_key`);

--
-- Indexes for table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `translation_logs`
--
ALTER TABLE `translation_logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `queue_id` (`queue_id`);

--
-- Indexes for table `translation_queue`
--
ALTER TABLE `translation_queue`
  ADD PRIMARY KEY (`queue_id`),
  ADD KEY `source_language_id` (`source_language_id`),
  ADD KEY `target_language_id` (`target_language_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_content`
--
ALTER TABLE `about_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `academic_grades`
--
ALTER TABLE `academic_grades`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `blog_content`
--
ALTER TABLE `blog_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `bus_routes`
--
ALTER TABLE `bus_routes`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `chatbot_messages`
--
ALTER TABLE `chatbot_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_content`
--
ALTER TABLE `contact_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `contact_info`
--
ALTER TABLE `contact_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `curriculum_content`
--
ALTER TABLE `curriculum_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `ehsan_content`
--
ALTER TABLE `ehsan_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `error_content`
--
ALTER TABLE `error_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `facilities_content`
--
ALTER TABLE `facilities_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `faq_content`
--
ALTER TABLE `faq_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `footer_content`
--
ALTER TABLE `footer_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `form_fields`
--
ALTER TABLE `form_fields`
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `form_field_translations`
--
ALTER TABLE `form_field_translations`
  MODIFY `translation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=352;

--
-- AUTO_INCREMENT for table `form_options`
--
ALTER TABLE `form_options`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `form_option_translations`
--
ALTER TABLE `form_option_translations`
  MODIFY `translation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `form_sections`
--
ALTER TABLE `form_sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `form_section_translations`
--
ALTER TABLE `form_section_translations`
  MODIFY `translation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `home_content`
--
ALTER TABLE `home_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `language_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `major_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  MODIFY `subscriber_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `post_content`
--
ALTER TABLE `post_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `post_widgets`
--
ALTER TABLE `post_widgets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `privacy_content`
--
ALTER TABLE `privacy_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `registration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `registration_success_content`
--
ALTER TABLE `registration_success_content`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `registration_success_translations`
--
ALTER TABLE `registration_success_translations`
  MODIFY `translation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `registration_terms_content`
--
ALTER TABLE `registration_terms_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=466;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `staff_content`
--
ALTER TABLE `staff_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `system_logs`
--
ALTER TABLE `system_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `theme_settings`
--
ALTER TABLE `theme_settings`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `translations`
--
ALTER TABLE `translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `translation_logs`
--
ALTER TABLE `translation_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `translation_queue`
--
ALTER TABLE `translation_queue`
  MODIFY `queue_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academic_grade_translations`
--
ALTER TABLE `academic_grade_translations`
  ADD CONSTRAINT `academic_grade_translations_ibfk_1` FOREIGN KEY (`grade_id`) REFERENCES `academic_grades` (`grade_id`),
  ADD CONSTRAINT `academic_grade_translations_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`language_id`);

--
-- Constraints for table `bus_route_translations`
--
ALTER TABLE `bus_route_translations`
  ADD CONSTRAINT `bus_route_translations_ibfk_1` FOREIGN KEY (`route_id`) REFERENCES `bus_routes` (`route_id`),
  ADD CONSTRAINT `bus_route_translations_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`language_id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `category_translations`
--
ALTER TABLE `category_translations`
  ADD CONSTRAINT `category_translations_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `category_translations_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`language_id`);

--
-- Constraints for table `contact_content`
--
ALTER TABLE `contact_content`
  ADD CONSTRAINT `contact_content_ibfk_1` FOREIGN KEY (`language_id`) REFERENCES `languages` (`language_id`);

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `form_fields`
--
ALTER TABLE `form_fields`
  ADD CONSTRAINT `form_fields_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `form_sections` (`section_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `form_fields_ibfk_2` FOREIGN KEY (`parent_field_id`) REFERENCES `form_fields` (`field_id`) ON DELETE CASCADE;

--
-- Constraints for table `form_field_translations`
--
ALTER TABLE `form_field_translations`
  ADD CONSTRAINT `form_field_translations_ibfk_1` FOREIGN KEY (`field_id`) REFERENCES `form_fields` (`field_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `form_field_translations_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`language_id`) ON DELETE CASCADE;

--
-- Constraints for table `form_options`
--
ALTER TABLE `form_options`
  ADD CONSTRAINT `form_options_ibfk_1` FOREIGN KEY (`field_id`) REFERENCES `form_fields` (`field_id`) ON DELETE CASCADE;

--
-- Constraints for table `form_option_translations`
--
ALTER TABLE `form_option_translations`
  ADD CONSTRAINT `form_option_translations_ibfk_1` FOREIGN KEY (`option_id`) REFERENCES `form_options` (`option_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `form_option_translations_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`language_id`) ON DELETE CASCADE;

--
-- Constraints for table `form_sections`
--
ALTER TABLE `form_sections`
  ADD CONSTRAINT `form_sections_ibfk_1` FOREIGN KEY (`parent_section_id`) REFERENCES `form_sections` (`section_id`) ON DELETE SET NULL;

--
-- Constraints for table `form_section_translations`
--
ALTER TABLE `form_section_translations`
  ADD CONSTRAINT `form_section_translations_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `form_sections` (`section_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `form_section_translations_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`language_id`) ON DELETE CASCADE;

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `major_translations`
--
ALTER TABLE `major_translations`
  ADD CONSTRAINT `major_translations_ibfk_1` FOREIGN KEY (`major_id`) REFERENCES `majors` (`major_id`),
  ADD CONSTRAINT `major_translations_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`language_id`);

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`target_role_id`) REFERENCES `roles` (`role_id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `posts_ibfk_3` FOREIGN KEY (`main_media_id`) REFERENCES `media` (`media_id`) ON DELETE SET NULL;

--
-- Constraints for table `post_translations`
--
ALTER TABLE `post_translations`
  ADD CONSTRAINT `post_translations_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_translations_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`language_id`);

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `registrations_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `registration_success_translations`
--
ALTER TABLE `registration_success_translations`
  ADD CONSTRAINT `reg_success_content_fk` FOREIGN KEY (`content_id`) REFERENCES `registration_success_content` (`content_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reg_success_lang_fk` FOREIGN KEY (`language_id`) REFERENCES `languages` (`language_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `registration_tokens`
--
ALTER TABLE `registration_tokens`
  ADD CONSTRAINT `registration_tokens_ibfk_1` FOREIGN KEY (`registration_id`) REFERENCES `registrations` (`registration_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`media_id`) REFERENCES `media` (`media_id`) ON DELETE SET NULL;

--
-- Constraints for table `review_translations`
--
ALTER TABLE `review_translations`
  ADD CONSTRAINT `review_translations_ibfk_1` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`review_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `review_translations_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`language_id`);

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permissions_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`permission_id`) ON DELETE CASCADE;

--
-- Constraints for table `staff_translations`
--
ALTER TABLE `staff_translations`
  ADD CONSTRAINT `staff_translations_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`),
  ADD CONSTRAINT `staff_translations_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`language_id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`academic_grade_id`) REFERENCES `academic_grades` (`grade_id`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`major_id`) REFERENCES `majors` (`major_id`),
  ADD CONSTRAINT `students_ibfk_3` FOREIGN KEY (`bus_route_id`) REFERENCES `bus_routes` (`route_id`);

--
-- Constraints for table `student_parents`
--
ALTER TABLE `student_parents`
  ADD CONSTRAINT `student_parents_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_parents_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`parent_id`) ON DELETE CASCADE;

--
-- Constraints for table `translation_logs`
--
ALTER TABLE `translation_logs`
  ADD CONSTRAINT `translation_logs_ibfk_1` FOREIGN KEY (`queue_id`) REFERENCES `translation_queue` (`queue_id`);

--
-- Constraints for table `translation_queue`
--
ALTER TABLE `translation_queue`
  ADD CONSTRAINT `translation_queue_ibfk_1` FOREIGN KEY (`source_language_id`) REFERENCES `languages` (`language_id`),
  ADD CONSTRAINT `translation_queue_ibfk_2` FOREIGN KEY (`target_language_id`) REFERENCES `languages` (`language_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
