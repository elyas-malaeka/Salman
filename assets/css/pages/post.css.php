<style>
        /* استایل برای متن با حالت justify-low */
        .post-content__text {
            text-align: justify;
            text-justify: inter-word;
            hyphens: auto;
            word-spacing: normal;
            line-height: 1.8;
        }
        
        .post-content__text p {
            margin-bottom: 1.5rem;
        }
        
        /* استایل برای تصویر تکی تمام عرض */
        .post-image-full {
            margin: 2rem 0;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .post-image-full img {
            width: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .post-image-full:hover img {
            transform: scale(1.02);
        }

        /* استایل برای دو تصویر کنار هم */
        .post-images-row {
            margin: 2rem 0;
        }

        .post-image-item {
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 1rem;
            height: 100%;
            position: relative;
        }

        .post-image-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .post-image-item:hover img {
            transform: scale(1.05);
        }

        /* استایل برای اسلایدر تصاویر */
        .post-images-slider {
            margin: 2rem 0;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
            height: 450px;
            position: relative;
            background: #f8f8f8;
        }

        .post-images-slider .swiper-slide {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f8f8;
        }

        .post-images-slider img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .post-images-slider .swiper-button-next,
        .post-images-slider .swiper-button-prev {
            color: #fff;
            background: rgba(0, 0, 0, 0.3);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            transition: background 0.3s ease;
        }

        .post-images-slider .swiper-button-next:hover,
        .post-images-slider .swiper-button-prev:hover {
            background: rgba(0, 0, 0, 0.5);
        }

        .post-images-slider .swiper-button-next:after,
        .post-images-slider .swiper-button-prev:after {
            font-size: 18px;
        }

        .post-images-slider .swiper-pagination-bullet {
            background: #fff;
            opacity: 0.7;
        }

        .post-images-slider .swiper-pagination-bullet-active {
            background: #fff;
            opacity: 1;
        }

        /* MagnificPopup customizations */
        .mfp-bg {
            background: #000;
            opacity: 0.9;
        }

        .mfp-figure:after {
            box-shadow: none;
            background: transparent;
        }

        .mfp-figure img.mfp-img {
            padding: 0;
        }

        .mfp-counter {
            right: 10px;
            color: #fff;
        }

        .mfp-title {
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }

        .mfp-fade.mfp-bg {
            opacity: 0;
            transition: all 0.3s ease-out;
        }

        .mfp-fade.mfp-bg.mfp-ready {
            opacity: 0.9;
        }

        .mfp-fade.mfp-bg.mfp-removing {
            opacity: 0;
        }

        .mfp-fade.mfp-wrap .mfp-content {
            opacity: 0;
            transition: all 0.3s ease-out;
        }

        .mfp-fade.mfp-wrap.mfp-ready .mfp-content {
            opacity: 1;
        }

        .mfp-fade.mfp-wrap.mfp-removing .mfp-content {
            opacity: 0;
        }

        .mfp-with-zoom .mfp-container,
        .mfp-with-zoom.mfp-bg {
            opacity: 0;
            backface-visibility: hidden;
            transition: all 0.3s ease-out;
        }

        .mfp-with-zoom.mfp-ready .mfp-container {
            opacity: 1;
        }

        .mfp-with-zoom.mfp-ready.mfp-bg {
            opacity: 0.9;
        }

        .mfp-with-zoom.mfp-removing .mfp-container,
        .mfp-with-zoom.mfp-removing.mfp-bg {
            opacity: 0;
        }

        /* === استایل برای پلیر صوتی سبک === */
        .post-audio-container {
            margin: 2rem 0;
        }

        .lightweight-audio-player {
            background: linear-gradient(135deg, #2b3044 0%, #1e222e 100%);
            border-radius: 12px;
            overflow: hidden;
            color: #fff;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
        }

        .audio-player-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .audio-title {
            font-weight: 500;
            flex-grow: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-right: 1rem;
        }

        .audio-download-btn {
            color: #fff;
            font-size: 1rem;
            padding: 5px;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s ease;
            background: rgba(255, 255, 255, 0.1);
        }

        .audio-download-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .audio-player-body {
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .audio-play-controls {
            flex-shrink: 0;
        }

        .audio-play-button {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #007bff;
            color: #fff;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
        }

        .audio-play-button:hover {
            background: #0069d9;
            transform: scale(1.05);
        }

        .audio-play-button.playing .fa-play {
            display: none;
        }

        .audio-play-button:not(.playing) .fa-pause {
            display: none;
        }

        .audio-progress-container {
            flex-grow: 1;
            margin: 0 0.5rem;
        }

        .audio-progress-bar-container {
            position: relative;
            height: 6px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
            cursor: pointer;
            margin-bottom: 6px;
        }

        .audio-progress-bar {
            width: 100%;
            height: 100%;
            position: relative;
        }

        .audio-progress-bar-fill {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 0;
            background: #007bff;
            border-radius: 3px;
            transition: width 0.1s linear;
        }

        .audio-progress-handle {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: #fff;
            position: absolute;
            top: 50%;
            transform: translate(-50%, -50%);
            left: 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            display: none;
        }

        .audio-progress-bar-container:hover .audio-progress-handle,
        .audio-progress-bar-container.active .audio-progress-handle {
            display: block;
        }

        .audio-time-display {
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
            opacity: 0.8;
        }

        .audio-volume-controls {
            display: flex;
            align-items: center;
            position: relative;
        }

        .audio-volume-button {
            background: none;
            border: none;
            color: #fff;
            cursor: pointer;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            margin-right: 8px;
        }

        .audio-volume-slider-container {
            width: 60px;
        }

        .audio-volume-slider {
            -webkit-appearance: none;
            width: 100%;
            height: 4px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 2px;
            outline: none;
        }

        .audio-volume-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 10px;
            height: 10px;
            background: #fff;
            border-radius: 50%;
            cursor: pointer;
        }

        .audio-volume-slider::-moz-range-thumb {
            width: 10px;
            height: 10px;
            background: #fff;
            border-radius: 50%;
            cursor: pointer;
            border: none;
        }

        /* استایل برای پلیر ویدیویی سفارشی */
        .custom-player-wrapper {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            background: #000;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.18);
            margin: 2.5rem 0;
        }

        .plyr {
            --plyr-color-main: #007bff;
            --plyr-video-control-color: #fff;
            --plyr-video-control-background-hover: rgba(0, 123, 255, 0.5);
            --plyr-audio-control-background-hover: rgba(0, 123, 255, 0.5);
            --plyr-range-fill-background: #007bff;
            --plyr-range-thumb-background: #fff;
            --plyr-video-progress-buffered-background: rgba(255, 255, 255, 0.3);
            --plyr-audio-progress-buffered-background: rgba(255, 255, 255, 0.3);
            --plyr-range-thumb-height: 14px;
            --plyr-range-track-height: 6px;
            --plyr-control-icon-size: 18px;
            --plyr-control-spacing: 10px;
            --plyr-control-radius: 6px;
            height: 100%;
            width: 100%;
        }

        .plyr__control--overlaid {
            background: rgba(0, 123, 255, 0.8);
            padding: 20px;
        }

        .plyr__control--overlaid:hover {
            background: rgba(0, 123, 255, 1);
        }
        
        /* پاسخگویی */
        @media (max-width: 991px) {
            .post-images-slider {
                height: 400px;
            }
        }

        @media (max-width: 767px) {
            .post-images-slider {
                height: 350px;
            }
            
            .audio-player-body {
                flex-wrap: wrap;
            }
            
            .audio-progress-container {
                order: 3;
                width: 100%;
                margin-top: 10px;
            }
            
            .audio-volume-controls {
                margin-left: auto;
            }
        }

        @media (max-width: 575px) {
            .post-images-slider {
                height: 280px;
            }
            
            .audio-player-body {
                padding: 1rem;
            }
            
            .audio-volume-slider-container {
                width: 40px;
            }
        }
        /**
 * Post Page Styles
 * 
 * Styles for single post display with modern, responsive design
 * Supporting both RTL and LTR languages
 * 
 * @version 3.0
 */

 :root {
    --primary-color: #4361ee;
    --secondary-color: #6366f1;
    --accent-color: #6941C6;
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
    line-height: 1.7;
}

[dir="rtl"] body {
    font-family: 'Vazirmatn', sans-serif;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

/* Hero Header Section */
.post-hero {
    position: relative;
    height: 600px;
    overflow: hidden;
    display: flex;
    align-items: center;
}

.post-hero__bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    z-index: 1;
}

.post-hero__overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        to bottom,
        rgba(15, 23, 42, 0.6) 0%,
        rgba(30, 41, 59, 0.85) 100%
    );
    z-index: 2;
}

.post-hero__content {
    position: relative;
    z-index: 10;
    max-width: 900px;
    margin: 0 auto;
    text-align: center;
    color: var(--white);
    padding: 0 20px;
}

.post-hero__category {
    margin-bottom: 20px;
}

.post-hero__category a {
    display: inline-block;
    background-color: var(--accent-color);
    color: var(--white);
    padding: 8px 20px;
    border-radius: 30px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all var(--animation-duration) ease;
}

.post-hero__category a:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(105, 65, 198, 0.3);
}

.post-hero__title {
    font-family: 'Vazir';
    color: #eee;
    font-size: 40px;
    font-weight: 800;
    margin-bottom: 25px;
    line-height: 1.3;
}

.post-hero__meta {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin-bottom: 30px;
}

.post-hero__date,
.post-hero__views,
.post-hero__reading-time {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 16px;
    opacity: 0.9;
}

.post-hero__breadcrumbs {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    opacity: 0.8;
}

.post-hero__breadcrumbs a {
    color: var(--white);
    text-decoration: none;
    transition: opacity var(--animation-duration) ease;
}

.post-hero__breadcrumbs a:hover {
    opacity: 1;
}

.post-hero__breadcrumbs i {
    font-size: 12px;
}

/* Main Content Section */
.post-content {
    padding: 80px 0;
}

.post-content__main {
    background-color: var(--white);
    border-radius: var(--border-radius);
    padding: 40px;
    box-shadow: var(--card-shadow);
    margin-bottom: 50px;
}

.post-content__text {
    font-size: 18px;
    line-height: 1.8;
    color: var(--text-color);
    margin-bottom: 30px;
}

.post-content__text p {
    margin-bottom: 20px;
}

.post-content__text h2,
.post-content__text h3,
.post-content__text h4 {
    margin-top: 40px;
    margin-bottom: 20px;
    font-weight: 700;
}

.post-content__text h2 {
    font-size: 28px;
}

.post-content__text h3 {
    font-size: 24px;
}

.post-content__text h4 {
    font-size: 20px;
}

.post-content__text blockquote {
    border-left: 4px solid var(--primary-color);
    padding: 20px 30px;
    margin: 30px 0;
    background-color: var(--bg-light);
    font-style: italic;
    font-size: 20px;
    line-height: 1.6;
}

[dir="rtl"] .post-content__text blockquote {
    border-left: none;
    border-right: 4px solid var(--primary-color);
}

.post-content__text ul,
.post-content__text ol {
    margin: 20px 0 20px 40px;
}

[dir="rtl"] .post-content__text ul,
[dir="rtl"] .post-content__text ol {
    margin: 20px 40px 20px 0;
}

.post-content__text li {
    margin-bottom: 10px;
}

/* Gallery Section */
.post-content__gallery {
    margin: 40px 0;
}

.post-content__gallery-item {
    margin-bottom: 30px;
    border-radius: var(--border-radius);
    overflow: hidden;
    position: relative;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
}

.post-content__gallery-img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    display: block;
    transition: transform var(--animation-duration) ease;
}

.post-content__gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(67, 97, 238, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all var(--animation-duration) ease;
}

.post-content__gallery-overlay i {
    color: var(--white);
    font-size: 24px;
}

.post-content__gallery-item:hover .post-content__gallery-img {
    transform: scale(1.05);
}

.post-content__gallery-item:hover .post-content__gallery-overlay {
    opacity: 1;
}

/* Post Footer */
.post-content__footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 40px;
    padding-top: 30px;
    border-top: 1px solid #eee;
}

.post-content__categories,
.post-content__share {
    display: flex;
    align-items: center;
    gap: 15px;
}

.post-content__categories-title,
.post-content__share-title {
    font-weight: 600;
    color: var(--text-color);
}

.post-content__category-link {
    display: inline-block;
    background-color: var(--bg-light);
    color: var(--primary-color);
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 14px;
    text-decoration: none;
    transition: all var(--animation-duration) ease;
}

.post-content__category-link:hover {
    background-color: var(--primary-color);
    color: var(--white);
}

.post-content__share-buttons {
    display: flex;
    gap: 10px;
}

.post-content__share-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    color: var(--white);
    text-decoration: none;
    transition: all var(--animation-duration) ease;
}

.post-content__share-link:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.post-content__share-link.facebook {
    background-color: #3b5998;
}

.post-content__share-link.twitter {
    background-color: #1da1f2;
}

.post-content__share-link.whatsapp {
    background-color: #25d366;
}

.post-content__share-link.telegram {
    background-color: #0088cc;
}

/* Related Posts Section */
.post-related {
    background-color: var(--white);
    border-radius: var(--border-radius);
    padding: 40px;
    box-shadow: var(--card-shadow);
}

.post-related__title {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 30px;
    position: relative;
    padding-bottom: 15px;
}

.post-related__title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 3px;
    background-color: var(--primary-color);
}

[dir="rtl"] .post-related__title::after {
    left: auto;
    right: 0;
}

.post-related__item {
    margin-bottom: 30px;
    background-color: var(--bg-light);
    border-radius: 10px;
    overflow: hidden;
    transition: all var(--animation-duration) ease;
}

.post-related__item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
}

.post-related__image {
    position: relative;
    height: 180px;
    overflow: hidden;
}

.post-related__image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform var(--animation-duration) ease;
}

.post-related__item:hover .post-related__image img {
    transform: scale(1.05);
}

.post-related__link {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.post-related__content {
    padding: 20px;
}

.post-related__date {
    color: var(--text-light);
    font-size: 14px;
    margin-bottom: 10px;
}

.post-related__item-title {
    font-size: 16px;
    font-weight: 600;
    line-height: 1.4;
    margin: 0;
}

.post-related__item-title a {
    color: var(--text-color);
    text-decoration: none;
    transition: color var(--animation-duration) ease;
}

.post-related__item-title a:hover {
    color: var(--primary-color);
}

/* Sidebar Styles */
.post-sidebar {
    position: sticky;
    top: 30px;
}

.post-sidebar__widget {
    background-color: var(--white);
    border-radius: var(--border-radius);
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: var(--card-shadow);
}

.post-sidebar__title {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 25px;
    position: relative;
    padding-bottom: 10px;
}

.post-sidebar__title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 2px;
    background-color: var(--primary-color);
}

[dir="rtl"] .post-sidebar__title::after {
    left: auto;
    right: 0;
}

/* Author Widget */
.post-sidebar__author {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.post-sidebar__author-image {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    overflow: hidden;
    margin-bottom: 20px;
    border: 5px solid var(--bg-light);
}

.post-sidebar__author-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.post-sidebar__author-name {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 10px;
}

.post-sidebar__author-bio {
    color: var(--text-light);
    font-size: 14px;
    line-height: 1.6;
}

/* Search Widget */
.post-sidebar__search-form {
    position: relative;
}

.post-sidebar__search-form input {
    width: 100%;
    height: 50px;
    background-color: var(--bg-light);
    border: none;
    border-radius: 25px;
    padding: 0 60px 0 25px;
    font-size: 15px;
    transition: all var(--animation-duration) ease;
}

[dir="rtl"] .post-sidebar__search-form input {
    padding: 0 25px 0 60px;
}

.post-sidebar__search-form input:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
}

.post-sidebar__search-form button {
    position: absolute;
    right: 5px;
    top: 5px;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: var(--primary-color);
    border: none;
    color: var(--white);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all var(--animation-duration) ease;
}

[dir="rtl"] .post-sidebar__search-form button {
    right: auto;
    left: 5px;
}

.post-sidebar__search-form button:hover {
    background-color: var(--secondary-color);
}

/* Latest Posts Widget */
.post-sidebar__latest-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.post-sidebar__latest-item {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #eee;
}

.post-sidebar__latest-item:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}

.post-sidebar__latest-image {
    width: 80px;
    height: 80px;
    border-radius: 10px;
    overflow: hidden;
    flex-shrink: 0;
}

.post-sidebar__latest-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform var(--animation-duration) ease;
}

.post-sidebar__latest-item:hover .post-sidebar__latest-image img {
    transform: scale(1.05);
}

.post-sidebar__latest-content {
    flex: 1;
}

.post-sidebar__latest-title {
    font-size: 16px;
    font-weight: 600;
    line-height: 1.4;
    margin: 0 0 8px;
}

.post-sidebar__latest-title a {
    color: var(--text-color);
    text-decoration: none;
    transition: color var(--animation-duration) ease;
}

.post-sidebar__latest-title a:hover {
    color: var(--primary-color);
}

.post-sidebar__latest-date {
    color: var(--text-light);
    font-size: 14px;
}

/* Categories Widget */
.post-sidebar__categories-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.post-sidebar__category-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 15px;
    background-color: var(--bg-light);
    border-radius: 8px;
    color: var(--text-color);
    text-decoration: none;
    transition: all var(--animation-duration) ease;
}

.post-sidebar__category-item span {
    display: inline-block;
    background-color: var(--white);
    color: var(--text-light);
    width: 24px;
    height: 24px;
    border-radius: 50%;
    text-align: center;
    line-height: 24px;
    font-size: 12px;
    transition: all var(--animation-duration) ease;
}

.post-sidebar__category-item:hover,
.post-sidebar__category-item.active {
    background-color: var(--primary-color);
    color: var(--white);
}

.post-sidebar__category-item:hover span,
.post-sidebar__category-item.active span {
    background-color: rgba(255, 255, 255, 0.2);
    color: var(--white);
}

/* Back Button Styles */
.post-sidebar__back-btn .btn {
    padding: 15px 25px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 16px;
}

/* Magnific Popup Override */
.mfp-bg {
    opacity: 0.9;
}

.mfp-figure:after {
    box-shadow: none;
    background: transparent;
}

.mfp-figure figure {
    margin: 0;
}

.mfp-bottom-bar {
    display: none;
}

.mfp-img {
    padding: 0;
}

.mfp-close {
    color: var(--white);
}

.mfp-zoom-out-cur, .mfp-zoom-out-cur .mfp-image-holder .mfp-close {
    cursor: pointer;
}

/* Responsive Styles */
@media (max-width: 1199px) {
    .post-hero {
        height: 500px;
    }
    
    .post-hero__title {
        font-size: 42px;
    }
    
    .post-content__text {
        font-size: 17px;
    }
}

@media (max-width: 991px) {
    .post-hero {
        height: 450px;
    }
    
    .post-hero__title {
        font-size: 36px;
    }
    
    .post-content {
        padding: 60px 0;
    }
    
    .post-content__main, 
    .post-related {
        padding: 30px;
    }
    
    .post-sidebar {
        position: static;
        margin-top: 50px;
    }
    
    .post-content__footer {
        flex-direction: column;
        gap: 20px;
        align-items: flex-start;
    }
    
    .post-content__gallery-img {
        height: 250px;
    }
}

@media (max-width: 767px) {
    .post-hero {
        height: 400px;
    }
    
    .post-hero__title {
        font-size: 28px;
        margin-bottom: 15px;
    }
    
    .post-hero__meta {
        flex-wrap: wrap;
        gap: 15px;
        justify-content: center;
    }
    
    .post-content {
        padding: 40px 0;
    }
    
    .post-content__main,
    .post-related {
        padding: 25px;
    }
    
    .post-content__text {
        font-size: 16px;
    }
    
    .post-content__text h2 {
        font-size: 24px;
    }
    
    .post-content__text h3 {
        font-size: 20px;
    }
    
    .post-content__text h4 {
        font-size: 18px;
    }
    
    .post-content__text blockquote {
        padding: 15px 20px;
        font-size: 18px;
    }
    
    .post-related__item {
        margin-bottom: 20px;
    }
    
    .post-related__image {
        height: 150px;
    }
}

@media (max-width: 575px) {
    .post-hero {
        height: 350px;
    }
    
    .post-hero__title {
        font-size: 24px;
    }
    
    .post-hero__meta {
        flex-direction: column;
        gap: 10px;
    }
    
    .post-hero__breadcrumbs {
        flex-wrap: wrap;
    }
    
    .post-content__main,
    .post-related,
    .post-sidebar__widget {
        padding: 20px;
    }
    
    .post-content__gallery-img {
        height: 200px;
    }
    
    .post-related__title {
        font-size: 20px;
    }
    
    .post-related__item-title {
        font-size: 15px;
    }
}
    </style>