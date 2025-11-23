<?php
/**
 * Salman Educational Complex - Design System Guide
 * 
 * A comprehensive visual guide to the design system components,
 * colors, typography, and other UI elements used throughout the website.
 * 
 * This file simply INCLUDES the existing CSS files and displays examples.
 */

// Detect RTL language
$isRtl = isset($_GET['rtl']) && $_GET['rtl'] === 'true';
$lang = $isRtl ? 'fa' : 'en';
$dir = $isRtl ? 'rtl' : 'ltr';
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" dir="<?php echo $dir; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $isRtl ? 'سلمان - راهنمای سیستم طراحی' : 'Salman - Design System Guide'; ?></title>
        <!-- Core CSS -->
    <?php include_once 'assets/css/typography.css.php'; ?>


    <!-- Include the existing CSS files - they contain all our design system styles -->
    <style>
       
        /* Additional styles only for this documentation page */
        .design-system-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .color-swatch {
            height: 100px;
            border-radius: var(--border-radius);
            margin-bottom: 1rem;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .color-swatch-label {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0,0,0,0.1);
            color: white;
            padding: 0.5rem;
            font-size: 0.875rem;
            display: flex;
            justify-content: space-between;
        }

        .color-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .component-demo {
            border: 1px solid var(--gray-200);
            border-radius: var(--border-radius);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .component-code {
            background-color: var(--gray-100);
            border-radius: var(--border-radius);
            padding: 1rem;
            margin-top: 1rem;
            font-family: monospace;
            font-size: 0.9rem;
            white-space: pre-wrap;
            color: var(--gray-800);
        }

        .spacing-example {
            display: flex;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .spacing-box {
            background-color: var(--light-purple);
            position: relative;
        }

        .spacing-box-label {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 0.75rem;
            font-weight: bold;
            color: var(--primary);
            white-space: nowrap;
        }

        .typography-example {
            margin-bottom: 2rem;
            border: 1px solid var(--gray-200);
            padding: 1.5rem;
            border-radius: var(--border-radius);
        }

        .design-system-nav {
            position: sticky;
            top: 0;
            background-color: var(--light-star);
            padding: 1rem 0;
            margin-bottom: 2rem;
            z-index: 100;
            border-bottom: 1px solid var(--gray-200);
        }

        .design-system-nav ul {
            display: flex;
            list-style: none;
            gap: 1.5rem;
            overflow-x: auto;
            padding-bottom: 0.5rem;
        }

        .design-system-nav a {
            text-decoration: none;
            color: var(--gray-600);
            font-weight: 500;
            transition: var(--transition-fast);
            white-space: nowrap;
        }

        .design-system-nav a:hover {
            color: var(--primary);
        }

        .radius-demo {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .radius-box {
            width: 100px;
            height: 100px;
            background-color: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .rtl-toggle {
            display: inline-block;
            margin: 1rem 0 2rem;
            padding: 0.5rem 1rem;
            background-color: var(--gray-100);
            border-radius: var(--border-radius-pill);
            text-decoration: none;
            color: var(--gray-700);
            font-weight: 500;
            transition: var(--transition-fast);
        }

        .rtl-toggle:hover {
            background-color: var(--gray-200);
        }

        .section-heading {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
        }

        .section-heading::after {
            content: '';
            flex: 1;
            height: 2px;
            background: var(--gray-200);
            margin-left: 1rem;
        }

        [dir="rtl"] .section-heading::after {
            margin-left: 0;
            margin-right: 1rem;
        }

        .shadow-demo {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .shadow-box {
            width: 150px;
            height: 150px;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--border-radius);
            text-align: center;
            font-size: 0.875rem;
        }
    </style>
</head>
<body style="font-family: 'Vazirmatn';">
    <header class="page-header">
        <div class="page-header__inner design-system-container">
            <h1 style="font-family: 'Vazirmatn';"><?php echo $isRtl ? 'سیستم طراحی سلمان' : 'Salman Design System'; ?></h1>
            <p><?php echo $isRtl ? 'راهنمای جامع اجزا، رنگ‌ها، تایپوگرافی و عناصر رابط کاربری' : 'A comprehensive guide to components, colors, typography and UI elements'; ?></p>
            <a href="?rtl=<?php echo $isRtl ? 'false' : 'true'; ?>" class="rtl-toggle">
                <?php echo $isRtl ? 'Switch to LTR' : 'تغییر به RTL'; ?>
            </a>
        </div>
    </header>

    <nav class="design-system-nav">
        <div class="design-system-container"style="font-family: 'Vazirmatn';">
            <ul>
                <li><a href="#colors"><?php echo $isRtl ? 'رنگ‌ها' : 'Colors'; ?></a></li>
                <li><a href="#typography"><?php echo $isRtl ? 'تایپوگرافی' : 'Typography'; ?></a></li>
                <li><a href="#spacing"><?php echo $isRtl ? 'فاصله‌گذاری' : 'Spacing'; ?></a></li>
                <li><a href="#borders"><?php echo $isRtl ? 'مرزها و گوشه‌ها' : 'Borders & Radius'; ?></a></li>
                <li><a href="#shadows"><?php echo $isRtl ? 'سایه‌ها' : 'Shadows'; ?></a></li>
                <li><a href="#buttons"><?php echo $isRtl ? 'دکمه‌ها' : 'Buttons'; ?></a></li>
                <li><a href="#forms"><?php echo $isRtl ? 'فرم‌ها' : 'Forms'; ?></a></li>
                <li><a href="#cards"><?php echo $isRtl ? 'کارت‌ها' : 'Cards'; ?></a></li>
                <li><a href="#alerts"><?php echo $isRtl ? 'هشدارها' : 'Alerts'; ?></a></li>
                <li><a href="#animations"><?php echo $isRtl ? 'انیمیشن‌ها' : 'Animations'; ?></a></li>
                <li><a href="#rtl"><?php echo $isRtl ? 'پشتیبانی RTL' : 'RTL Support'; ?></a></li>
            </ul>
        </div>
    </nav>

    <main class="design-system-container">
        <!-- COLORS SECTION -->
        <section id="colors">
            <h2 class="section-heading"><?php echo $isRtl ? 'پالت رنگی' : 'Color Palette'; ?></h2>
            
            <h3><?php echo $isRtl ? 'رنگ‌های اصلی' : 'Primary Colors'; ?></h3>
            <div class="color-grid">
                <div>
                    <div class="color-swatch" style="background-color: var(--primary);">
                        <div class="color-swatch-label">
                            <span>Primary</span>
                            <span>#6C63FF</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="color-swatch" style="background-color: var(--primary-light);">
                        <div class="color-swatch-label">
                            <span>Primary Light</span>
                            <span>#9471FF</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="color-swatch" style="background-color: var(--primary-dark);">
                        <div class="color-swatch-label">
                            <span>Primary Dark</span>
                            <span>#5451e6</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="color-swatch" style="background-color: var(--secondary);">
                        <div class="color-swatch-label">
                            <span>Secondary</span>
                            <span>#6C9EFF</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="color-swatch" style="background-color: var(--secondary-light);">
                        <div class="color-swatch-label">
                            <span>Secondary Light</span>
                            <span>#87CEFA</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="color-swatch" style="background-color: var(--secondary-dark);">
                        <div class="color-swatch-label">
                            <span>Secondary Dark</span>
                            <span>#4B83E8</span>
                        </div>
                    </div>
                </div>
            </div>

            <h3><?php echo $isRtl ? 'رنگ‌های تاکیدی' : 'Accent Colors'; ?></h3>
            <div class="color-grid">
                <div>
                    <div class="color-swatch" style="background-color: var(--accent-pink);">
                        <div class="color-swatch-label">
                            <span>Accent Pink</span>
                            <span>#FF6B8B</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="color-swatch" style="background-color: var(--accent-teal);">
                        <div class="color-swatch-label">
                            <span>Accent Teal</span>
                            <span>#36F1CD</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="color-swatch" style="background-color: var(--accent-yellow);">
                        <div class="color-swatch-label">
                            <span>Accent Yellow</span>
                            <span>#FFDE59</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="color-swatch" style="background-color: var(--accent-orange);">
                        <div class="color-swatch-label">
                            <span>Accent Orange</span>
                            <span>#FF8A65</span>
                        </div>
                    </div>
                </div>
            </div>

            <h3><?php echo $isRtl ? 'رنگ‌های وضعیت' : 'Status Colors'; ?></h3>
            <div class="color-grid">
                <div>
                    <div class="color-swatch" style="background-color: var(--success);">
                        <div class="color-swatch-label">
                            <span>Success</span>
                            <span>#4CAF50</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="color-swatch" style="background-color: var(--warning);">
                        <div class="color-swatch-label">
                            <span>Warning</span>
                            <span>#FF9800</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="color-swatch" style="background-color: var(--danger);">
                        <div class="color-swatch-label">
                            <span>Danger</span>
                            <span>#F44336</span>
                        </div>
                    </div>
                </div>
            </div>

            <h3><?php echo $isRtl ? 'گرادیان‌ها' : 'Gradients'; ?></h3>
            <div class="color-grid">
                <div>
                    <div class="color-swatch" style="background: var(--sky-gradient);">
                        <div class="color-swatch-label">
                            <span>Sky Gradient</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="color-swatch" style="background: var(--purple-gradient);">
                        <div class="color-swatch-label">
                            <span>Purple Gradient</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="color-swatch" style="background: var(--soft-gradient);">
                        <div class="color-swatch-label" style="color: var(--primary);">
                            <span>Soft Gradient</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="color-swatch" style="background: var(--sunset-gradient);">
                        <div class="color-swatch-label">
                            <span>Sunset Gradient</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="color-swatch" style="background: var(--cosmic-gradient);">
                        <div class="color-swatch-label">
                            <span>Cosmic Gradient</span>
                        </div>
                    </div>
                </div>
            </div>

            <h3><?php echo $isRtl ? 'رنگ‌های خنثی' : 'Neutral Colors'; ?></h3>
            <div class="color-grid">
                <div>
                    <div class="color-swatch" style="background-color: var(--gray-50);">
                        <div class="color-swatch-label" style="color: var(--gray-900);">
                            <span>Gray 50</span>
                            <span>#F9FAFB</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="color-swatch" style="background-color: var(--gray-100);">
                        <div class="color-swatch-label" style="color: var(--gray-900);">
                            <span>Gray 100</span>
                            <span>#F3F4F6</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="color-swatch" style="background-color: var(--gray-200);">
                        <div class="color-swatch-label" style="color: var(--gray-900);">
                            <span>Gray 200</span>
                            <span>#E5E7EB</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="color-swatch" style="background-color: var(--gray-300);">
                        <div class="color-swatch-label" style="color: var(--gray-900);">
                            <span>Gray 300</span>
                            <span>#D1D5DB</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="color-swatch" style="background-color: var(--gray-400);">
                        <div class="color-swatch-label" style="color: var(--gray-900);">
                            <span>Gray 400</span>
                            <span>#9CA3AF</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="color-swatch" style="background-color: var(--gray-500);">
                        <div class="color-swatch-label" style="color: white;">
                            <span>Gray 500</span>
                            <span>#6B7280</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="color-swatch" style="background-color: var(--gray-600);">
                        <div class="color-swatch-label" style="color: white;">
                            <span>Gray 600</span>
                            <span>#4B5563</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="color-swatch" style="background-color: var(--gray-700);">
                        <div class="color-swatch-label" style="color: white;">
                            <span>Gray 700</span>
                            <span>#374151</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="color-swatch" style="background-color: var(--gray-800);">
                        <div class="color-swatch-label" style="color: white;">
                            <span>Gray 800</span>
                            <span>#1F2937</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="color-swatch" style="background-color: var(--gray-900);">
                        <div class="color-swatch-label" style="color: white;">
                            <span>Gray 900</span>
                            <span>#111827</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- TYPOGRAPHY SECTION -->
        <section id="typography">
            <h2 class="section-heading"><?php echo $isRtl ? 'تایپوگرافی' : 'Typography'; ?></h2>
            
            <div class="typography-example">
                <h3><?php echo $isRtl ? 'عناوین' : 'Headings'; ?></h3>
                <h1>H1 Heading | عنوان H1</h1>
                <h2>H2 Heading | عنوان H2</h2>
                <h3>H3 Heading | عنوان H3</h3>
                <h4>H4 Heading | عنوان H4</h4>
                <h5>H5 Heading | عنوان H5</h5>
                <h6>H6 Heading | عنوان H6</h6>

                <div class="component-code">h1 { font-size: 3rem; line-height: 1.2; }
h2 { font-size: 2.5rem; line-height: 1.25; }
h3 { font-size: 2rem; line-height: 1.3; }
h4 { font-size: 1.5rem; line-height: 1.35; }
h5 { font-size: 1.25rem; line-height: 1.4; }
h6 { font-size: 1.1rem; line-height: 1.45; }</div>
            </div>

            <div class="typography-example">
                <h3><?php echo $isRtl ? 'متن بدنه' : 'Body Text'; ?></h3>
                <p>This is a standard paragraph with normal body text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <p><strong>This is bold text.</strong></p>
                <p><em>This is italic text.</em></p>
                <p><a href="#">This is a link.</a></p>
                <p><small>This is smaller text.</small></p>
                
                <div class="component-code">body {
  font-family: var(--body-font);
  font-size: 1rem;
  line-height: var(--base-line-height);
  color: var(--gray-700);
}</div>
            </div>

            <div class="typography-example">
                <h3><?php echo $isRtl ? 'کلاس‌های متنی' : 'Text Classes'; ?></h3>
                <p class="text-xs">Extra Small Text (.text-xs)</p>
                <p class="text-sm">Small Text (.text-sm)</p>
                <p class="text-md">Medium Text (.text-md)</p>
                <p class="text-lg">Large Text (.text-lg)</p>
                <p class="text-xl">Extra Large Text (.text-xl)</p>
                <p class="text-2xl">2XL Text (.text-2xl)</p>
                <p class="text-3xl">3XL Text (.text-3xl)</p>

                <div class="component-code">.text-xs { font-size: 0.75rem; }
.text-sm { font-size: 0.875rem; }
.text-md { font-size: 1rem; }
.text-lg { font-size: 1.125rem; }
.text-xl { font-size: 1.25rem; }
.text-2xl { font-size: 1.5rem; }
.text-3xl { font-size: 1.875rem; }</div>
            </div>

            <div class="typography-example">
                <h3><?php echo $isRtl ? 'وزن قلم' : 'Font Weights'; ?></h3>
                <p class="font-thin">Font weight: 100 (.font-thin)</p>
                <p class="font-extralight">Font weight: 200 (.font-extralight)</p>
                <p class="font-light">Font weight: 300 (.font-light)</p>
                <p class="font-normal">Font weight: 400 (.font-normal)</p>
                <p class="font-medium">Font weight: 500 (.font-medium)</p>
                <p class="font-semibold">Font weight: 600 (.font-semibold)</p>
                <p class="font-bold">Font weight: 700 (.font-bold)</p>
                <p class="font-extrabold">Font weight: 800 (.font-extrabold)</p>
                <p class="font-black">Font weight: 900 (.font-black)</p>
            </div>

            <div class="typography-example">
                <h3><?php echo $isRtl ? 'تراز متن' : 'Text Alignment'; ?></h3>
                <p class="text-left">Left aligned text (.text-left)</p>
                <p class="text-center">Center aligned text (.text-center)</p>
                <p class="text-right">Right aligned text (.text-right)</p>
                <p class="text-justify">Justified text (.text-justify) - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in metus vel dui fringilla lacinia. Nulla facilisi. Vivamus nec est dui. Proin tincidunt turpis a nisi condimentum, at finibus massa lobortis.</p>
            </div>
        </section>

        <!-- SPACING SECTION -->
        <section id="spacing">
            <h2 class="section-heading"><?php echo $isRtl ? 'فاصله‌گذاری' : 'Spacing'; ?></h2>
            
            <h3><?php echo $isRtl ? 'مقیاس فاصله‌گذاری' : 'Spacing Scale'; ?></h3>
            <div class="spacing-example">
                <div class="spacing-box" style="width: var(--spacing-1); height: var(--spacing-1);">
                    <div class="spacing-box-label">1</div>
                </div>
                <div class="spacing-box" style="width: var(--spacing-2); height: var(--spacing-2);">
                    <div class="spacing-box-label">2</div>
                </div>
                <div class="spacing-box" style="width: var(--spacing-3); height: var(--spacing-3);">
                    <div class="spacing-box-label">3</div>
                </div>
                <div class="spacing-box" style="width: var(--spacing-4); height: var(--spacing-4);">
                    <div class="spacing-box-label">4</div>
                </div>
                <div class="spacing-box" style="width: var(--spacing-5); height: var(--spacing-5);">
                    <div class="spacing-box-label">5</div>
                </div>
                <div class="spacing-box" style="width: var(--spacing-6); height: var(--spacing-6);">
                    <div class="spacing-box-label">6</div>
                </div>
                <div class="spacing-box" style="width: var(--spacing-8); height: var(--spacing-8);">
                    <div class="spacing-box-label">8</div>
                </div>
                <div class="spacing-box" style="width: var(--spacing-10); height: var(--spacing-10);">
                    <div class="spacing-box-label">10</div>
                </div>
                <div class="spacing-box" style="width: var(--spacing-12); height: var(--spacing-12);">
                    <div class="spacing-box-label">12</div>
                </div>
                <div class="spacing-box" style="width: var(--spacing-16); height: var(--spacing-16);">
                    <div class="spacing-box-label">16</div>
                </div>
                <div class="spacing-box" style="width: var(--spacing-20); height: var(--spacing-20);">
                    <div class="spacing-box-label">20</div>
                </div>
            </div>

            <div class="component-code">/* Spacing variables */
--spacing-1: 0.25rem;
--spacing-2: 0.5rem;
--spacing-3: 0.75rem;
--spacing-4: 1rem;
--spacing-5: 1.25rem;
--spacing-6: 1.5rem;
--spacing-8: 2rem;
--spacing-10: 2.5rem;
--spacing-12: 3rem;
--spacing-16: 4rem;
--spacing-20: 5rem;</div>
        </section>

        <!-- BORDERS & RADIUS SECTION -->
        <section id="borders">
            <h2 class="section-heading"><?php echo $isRtl ? 'مرزها و گوشه‌ها' : 'Borders & Radius'; ?></h2>
            
            <h3><?php echo $isRtl ? 'شعاع گوشه‌ها' : 'Border Radius'; ?></h3>
            <div class="radius-demo">
                <div>
                    <div class="radius-box" style="border-radius: var(--border-radius-xs);">XS</div>
                    <p class="text-center">--border-radius-xs</p>
                </div>
                <div>
                    <div class="radius-box" style="border-radius: var(--border-radius-sm);">SM</div>
                    <p class="text-center">--border-radius-sm</p>
                </div>
                <div>
                    <div class="radius-box" style="border-radius: var(--border-radius);">MD</div>
                    <p class="text-center">--border-radius</p>
                </div>
                <div>
                    <div class="radius-box" style="border-radius: var(--border-radius-lg);">LG</div>
                    <p class="text-center">--border-radius-lg</p>
                </div>
                <div>
                    <div class="radius-box" style="border-radius: var(--border-radius-xl);">XL</div>
                    <p class="text-center">--border-radius-xl</p>
                </div>
                <div>
                    <div class="radius-box" style="border-radius: var(--border-radius-pill); width: 200px;">Pill</div>
                    <p class="text-center">--border-radius-pill</p>
                </div>
                <div>
                    <div class="radius-box" style="border-radius: 50%;">Circle</div>
                    <p class="text-center">50%</p>
                </div>
            </div>

            <div class="component-code">/* Border radius variables */
--border-radius-xs: 0.375rem;     /* 6px */
--border-radius-sm: 0.625rem;     /* 10px */
--border-radius: 1rem;            /* 16px */
--border-radius-lg: 1.5rem;       /* 24px */
--border-radius-xl: 2rem;         /* 32px */
--border-radius-pill: 6.25rem;    /* 100px */
--border-radius-circle: 50%;</div>
        </section>

        <!-- SHADOWS SECTION -->
        <section id="shadows">
            <h2 class="section-heading"><?php echo $isRtl ? 'سایه‌ها' : 'Shadows'; ?></h2>
            
            <div class="shadow-demo">
                <div class="shadow-box" style="box-shadow: var(--shadow-sm);">
                    Shadow SM<br>
                    <small>--shadow-sm</small>
                </div>
                <div class="shadow-box" style="box-shadow: var(--shadow);">
                    Shadow<br>
                    <small>--shadow</small>
                </div>
                <div class="shadow-box" style="box-shadow: var(--shadow-lg);">
                    Shadow LG<br>
                    <small>--shadow-lg</small>
                </div>
                <div class="shadow-box" style="box-shadow: var(--shadow-xl);">
                    Shadow XL<br>
                    <small>--shadow-xl</small>
                </div>
                <div class="shadow-box" style="box-shadow: var(--glow-shadow);">
                    Glow Shadow<br>
                    <small>--glow-shadow</small>
                </div>
                <div class="shadow-box" style="box-shadow: var(--purple-shadow);">
                    Purple Shadow<br>
                    <small>--purple-shadow</small>
                </div>
                <div class="shadow-box" style="box-shadow: var(--blue-shadow);">
                    Blue Shadow<br>
                    <small>--blue-shadow</small>
                </div>
                <div class="shadow-box" style="box-shadow: var(--success-shadow);">
                    Success Shadow<br>
                    <small>--success-shadow</small>
                </div>
            </div>

            <div class="component-code">/* Shadow variables */
--shadow-sm: 0 4px 10px rgba(0, 0, 0, 0.05);
--shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
--shadow-lg: 0 20px 40px rgba(0, 0, 0, 0.15);
--shadow-xl: 0 25px 50px rgba(0, 0, 0, 0.2);
--glow-shadow: 0 0 20px rgba(108, 99, 255, 0.4);
--purple-shadow: 0 5px 15px rgba(108, 99, 255, 0.3);
--blue-shadow: 0 5px 15px rgba(108, 158, 255, 0.3);
--success-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
--inner-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.08);
--text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);</div>
        </section>
        
        <!-- BUTTONS SECTION -->
        <section id="buttons">
            <h2 class="section-heading"><?php echo $isRtl ? 'دکمه‌ها' : 'Buttons'; ?></h2>
            
            <div class="component-demo">
                <h3><?php echo $isRtl ? 'انواع دکمه' : 'Button Types'; ?></h3>
                <button class="btn btn-primary"><?php echo $isRtl ? 'دکمه اولیه' : 'Primary Button'; ?></button>
                <button class="btn btn-secondary"><?php echo $isRtl ? 'دکمه ثانویه' : 'Secondary Button'; ?></button>
                <button class="btn btn-success"><?php echo $isRtl ? 'دکمه موفقیت' : 'Success Button'; ?></button>
                <button class="btn btn-outline-primary"><?php echo $isRtl ? 'دکمه خطی' : 'Outline Button'; ?></button>
                <button class="btn btn-light"><?php echo $isRtl ? 'دکمه روشن' : 'Light Button'; ?></button>
                
                <div class="component-code">/* Primary button */
.btn-primary {
    background: var(--purple-gradient);
    color: #fff;
    box-shadow: var(--purple-shadow);
}

/* Secondary button */
.btn-secondary {
    background: var(--sky-gradient);
    color: #fff;
    box-shadow: var(--blue-shadow);
}

/* Success button */
.btn-success {
    background: var(--success-gradient);
    color: #fff;
    box-shadow: var(--success-shadow);
}

/* Outline button */
.btn-outline-primary {
    background-color: transparent;
    border: 2px solid var(--primary);
    color: var(--primary);
}

/* Light button */
.btn-light {
    background-color: #fff;
    color: var(--primary);
    box-shadow: var(--shadow);
}</div>
            </div>
            
            <div class="component-demo">
                <h3><?php echo $isRtl ? 'اندازه‌های دکمه' : 'Button Sizes'; ?></h3>
                <button class="btn btn-primary btn-lg"><?php echo $isRtl ? 'دکمه بزرگ' : 'Large Button'; ?></button>
                <button class="btn btn-primary"><?php echo $isRtl ? 'دکمه متوسط' : 'Medium Button'; ?></button>
                <button class="btn btn-primary btn-sm"><?php echo $isRtl ? 'دکمه کوچک' : 'Small Button'; ?></button>
                <button class="btn btn-primary btn-xs"><?php echo $isRtl ? 'دکمه خیلی کوچک' : 'Extra Small'; ?></button>
                
                <div class="component-code">/* Button sizes */
.btn-lg {
    padding: 15px 35px;
    font-size: 1.125rem;
}

.btn {
    padding: 12px 30px;
    font-size: 1rem;
}

.btn-sm {
    padding: 8px 20px;
    font-size: 0.875rem;
}

.btn-xs {
    padding: 6px 15px;
    font-size: 0.75rem;
}</div>
            </div>
            
            <div class="component-demo">
                <h3><?php echo $isRtl ? 'دکمه‌های آیکون‌دار' : 'Icon Buttons'; ?></h3>
                <button class="btn btn-primary btn-icon"><i class="fa fa-plus"></i></button>
                <button class="btn btn-secondary btn-icon"><i class="fa fa-search"></i></button>
                <button class="btn btn-success btn-icon"><i class="fa fa-check"></i></button>
                <button class="btn btn-primary"><?php echo $isRtl ? 'با آیکون' : 'With Icon'; ?> <i class="fa fa-arrow-right"></i></button>
                
                <div class="component-code">/* Icon button */
.btn-icon {
    width: 48px;
    height: 48px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}

.btn i, .btn svg {
    margin-right: 10px;
    font-size: 1.125rem;
    transition: transform var(--transition-fast);
}

.rtl .btn i, .rtl .btn svg {
    margin-right: 0;
    margin-left: 10px;
}</div>
            </div>
        </section>
        
        <!-- FORMS SECTION -->
        <section id="forms">
            <h2 class="section-heading"><?php echo $isRtl ? 'فرم‌ها' : 'Forms'; ?></h2>
            
            <div class="component-demo">
                <h3><?php echo $isRtl ? 'ورودی‌های متن' : 'Text Inputs'; ?></h3>
                <div class="form-group">
                    <label class="form-label"><?php echo $isRtl ? 'ورودی متن' : 'Text Input'; ?></label>
                    <input type="text" class="form-control" placeholder="<?php echo $isRtl ? 'ورودی متن را وارد کنید' : 'Enter text input'; ?>">
                </div>
                
                <div class="form-group">
                    <label class="form-label"><?php echo $isRtl ? 'ورودی ایمیل' : 'Email Input'; ?></label>
                    <input type="email" class="form-control" placeholder="<?php echo $isRtl ? 'ایمیل خود را وارد کنید' : 'Enter your email'; ?>">
                </div>
                
                <div class="form-group">
                    <label class="form-label"><?php echo $isRtl ? 'ورودی رمز عبور' : 'Password Input'; ?></label>
                    <input type="password" class="form-control" placeholder="<?php echo $isRtl ? 'رمز عبور را وارد کنید' : 'Enter password'; ?>">
                </div>
                
                <div class="form-group">
                    <label class="form-label"><?php echo $isRtl ? 'متن چند خطی' : 'Textarea'; ?></label>
                    <textarea class="form-control" rows="4" placeholder="<?php echo $isRtl ? 'متن خود را وارد کنید' : 'Enter your message'; ?>"></textarea>
                </div>
                
                <div class="component-code">.form-group {
    margin-bottom: 1.5rem;
}

.form-control {
    border: 2px solid #eeeeff;
    border-radius: var(--border-radius);
    padding: 0.85rem 1.2rem;
    font-size: 1rem;
    background-color: #fafbff;
    line-height: 1.5;
    width: 100%;
}

.form-control:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(108, 99, 255, 0.15);
    background-color: white;
    outline: none;
}

.form-label {
    font-weight: 600;
    margin-bottom: 0.6rem;
    color: #444;
    font-size: 0.95rem;
    display: block;
}</div>
            </div>
            
            <div class="component-demo">
                <h3><?php echo $isRtl ? 'منوهای کشویی و لیست‌ها' : 'Select Dropdowns & Lists'; ?></h3>
                <div class="form-group">
                    <label class="form-label"><?php echo $isRtl ? 'منوی کشویی تکی' : 'Single Select'; ?></label>
                    <select class="form-select form-control">
                        <option><?php echo $isRtl ? 'گزینه 1' : 'Option 1'; ?></option>
                        <option><?php echo $isRtl ? 'گزینه 2' : 'Option 2'; ?></option>
                        <option><?php echo $isRtl ? 'گزینه 3' : 'Option 3'; ?></option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label"><?php echo $isRtl ? 'منوی کشویی چندتایی' : 'Multiple Select'; ?></label>
                    <select multiple class="form-select form-control" size="4">
                        <option><?php echo $isRtl ? 'گزینه 1' : 'Option 1'; ?></option>
                        <option><?php echo $isRtl ? 'گزینه 2' : 'Option 2'; ?></option>
                        <option><?php echo $isRtl ? 'گزینه 3' : 'Option 3'; ?></option>
                        <option><?php echo $isRtl ? 'گزینه 4' : 'Option 4'; ?></option>
                    </select>
                </div>
            </div>
            
            <div class="component-demo">
                <h3><?php echo $isRtl ? 'گزینه‌های انتخابی' : 'Checkboxes & Radios'; ?></h3>
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="check1">
                        <label class="form-check-label" for="check1"><?php echo $isRtl ? 'گزینه چک‌باکس 1' : 'Checkbox option 1'; ?></label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="check2">
                        <label class="form-check-label" for="check2"><?php echo $isRtl ? 'گزینه چک‌باکس 2' : 'Checkbox option 2'; ?></label>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="radioGroup" id="radio1">
                        <label class="form-check-label" for="radio1"><?php echo $isRtl ? 'گزینه رادیویی 1' : 'Radio option 1'; ?></label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="radioGroup" id="radio2">
                        <label class="form-check-label" for="radio2"><?php echo $isRtl ? 'گزینه رادیویی 2' : 'Radio option 2'; ?></label>
                    </div>
                </div>
                
                <div class="component-code">/* Form check styles */
.form-check {
    position: relative;
    display: block;
    padding-left: 1.75rem;
    margin-bottom: 0.5rem;
}

.form-check-input {
    position: absolute;
    margin-top: 0.3rem;
    margin-left: -1.75rem;
}

.form-check-label {
    display: inline-block;
    margin-bottom: 0;
}

/* RTL form check styles */
[dir="rtl"] .form-check {
    padding-left: 0;
    padding-right: 1.75rem;
}

[dir="rtl"] .form-check-input {
    margin-left: 0;
    margin-right: -1.75rem;
}</div>
            </div>
        </section>
        
        <!-- CARDS SECTION -->
        <section id="cards">
            <h2 class="section-heading"><?php echo $isRtl ? 'کارت‌ها' : 'Cards'; ?></h2>
            
            <div class="component-demo">
                <h3><?php echo $isRtl ? 'کارت استاندارد' : 'Standard Card'; ?></h3>
                <div style="max-width: 350px;">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title"><?php echo $isRtl ? 'عنوان کارت' : 'Card Title'; ?></h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?php echo $isRtl ? 'این متن بدنه کارت است. کارت‌ها برای نمایش محتوا در قالب‌های مختلفی استفاده می‌شوند.' : 'This is the card body text. Cards can be used to display content in various formats.'; ?></p>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary"><?php echo $isRtl ? 'اقدام' : 'Action'; ?></button>
                        </div>
                    </div>
                </div>
                
                <div class="component-code">.card {
    background: #fff;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    transition: transform var(--transition-medium), box-shadow var(--transition-medium);
    border: 1px solid rgba(108, 99, 255, 0.1);
    overflow: hidden;
    height: 100%;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.card-header {
    border-bottom: 1px solid rgba(108, 99, 255, 0.1);
    padding: 1.25rem 1.5rem;
    background-color: rgba(108, 99, 255, 0.03);
}

.card-body {
    padding: 1.5rem;
}

.card-footer {
    border-top: 1px solid rgba(108, 99, 255, 0.1);
    padding: 1.25rem 1.5rem;
    background-color: rgba(108, 99, 255, 0.03);
}</div>
            </div>
            
            <div class="component-demo">
                <h3><?php echo $isRtl ? 'انواع کارت' : 'Card Variants'; ?></h3>
                <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                    <div style="width: 250px;">
                        <div class="card card-primary">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $isRtl ? 'کارت اولیه' : 'Primary Card'; ?></h5>
                                <p class="card-text"><?php echo $isRtl ? 'کارت با نوار اولیه' : 'Card with primary border'; ?></p>
                            </div>
                        </div>
                    </div>
                    <div style="width: 250px;">
                        <div class="card card-secondary">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $isRtl ? 'کارت ثانویه' : 'Secondary Card'; ?></h5>
                                <p class="card-text"><?php echo $isRtl ? 'کارت با نوار ثانویه' : 'Card with secondary border'; ?></p>
                            </div>
                        </div>
                    </div>
                    <div style="width: 250px;">
                        <div class="card card-success">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $isRtl ? 'کارت موفقیت' : 'Success Card'; ?></h5>
                                <p class="card-text"><?php echo $isRtl ? 'کارت با نوار موفقیت' : 'Card with success border'; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="component-code">/* Card Variations */
.card-primary {
    border-top: 4px solid var(--primary);
}

.card-secondary {
    border-top: 4px solid var(--secondary);
}

.card-success {
    border-top: 4px solid var(--success);
}

.card-gradient {
    background: linear-gradient(135deg, #fff 0%, #f8f9ff 100%);
}</div>
            </div>
        </section>
        
        <!-- ALERTS SECTION -->
        <section id="alerts">
            <h2 class="section-heading"><?php echo $isRtl ? 'هشدارها' : 'Alerts'; ?></h2>
            
            <div class="component-demo">
                <h3><?php echo $isRtl ? 'انواع هشدار' : 'Alert Types'; ?></h3>
                <div class="alert alert-primary">
                    <?php echo $isRtl ? 'این یک هشدار اولیه است. برای اطلاعات عمومی استفاده می‌شود.' : 'This is a primary alert. Used for general information.'; ?>
                </div>
                
                <div class="alert alert-secondary">
                    <?php echo $isRtl ? 'این یک هشدار ثانویه است. برای اطلاعات ثانویه استفاده می‌شود.' : 'This is a secondary alert. Used for secondary information.'; ?>
                </div>
                
                <div class="alert alert-success">
                    <?php echo $isRtl ? 'این یک هشدار موفقیت است. برای اطلاع‌رسانی تراکنش‌های موفق استفاده می‌شود.' : 'This is a success alert. Used for successful transactions.'; ?>
                </div>
                
                <div class="alert alert-danger">
                    <?php echo $isRtl ? 'این یک هشدار خطر است. برای موارد خطر و خطا استفاده می‌شود.' : 'This is a danger alert. Used for dangerous conditions or errors.'; ?>
                </div>
                
                <div class="alert alert-warning">
                    <?php echo $isRtl ? 'این یک هشدار هشداری است. برای هشدارها و نکات اخطاری استفاده می‌شود.' : 'This is a warning alert. Used for warning messages and cautions.'; ?>
                </div>
                
                <div class="component-code">.alert {
    position: relative;
    padding: 1.25rem 1.5rem;
    margin-bottom: 1.5rem;
    border: 1px solid transparent;
    border-radius: var(--border-radius);
    font-size: 0.95rem;
}

.alert-primary {
    color: var(--primary);
    background-color: rgba(108, 99, 255, 0.1);
    border-color: rgba(108, 99, 255, 0.2);
}

.alert-secondary {
    color: var(--secondary);
    background-color: rgba(108, 158, 255, 0.1);
    border-color: rgba(108, 158, 255, 0.2);
}

.alert-success {
    color: var(--success);
    background-color: rgba(76, 175, 80, 0.1);
    border-color: rgba(76, 175, 80, 0.2);
}

.alert-danger {
    color: var(--accent-pink);
    background-color: rgba(255, 107, 139, 0.1);
    border-color: rgba(255, 107, 139, 0.2);
}

.alert-warning {
    color: var(--accent-orange);
    background-color: rgba(255, 138, 101, 0.1);
    border-color: rgba(255, 138, 101, 0.2);
}</div>
            </div>
            
            <div class="component-demo">
                <h3><?php echo $isRtl ? 'هشدار با آیکون' : 'Alert with Icon'; ?></h3>
                
                <div class="alert alert-primary alert-icon">
                    <i class="fa fa-info-circle"></i>
                    <div>
                        <h4 class="alert-heading"><?php echo $isRtl ? 'عنوان هشدار' : 'Alert Heading'; ?></h4>
                        <?php echo $isRtl ? 'این هشدار دارای آیکون و عنوان است. برای پیام‌های مهم‌تر استفاده می‌شود.' : 'This alert has an icon and a heading. Used for more important messages.'; ?>
                    </div>
                </div>
                
                <div class="component-code">.alert-icon {
    display: flex;
    align-items: flex-start;
}

.alert-icon i, .alert-icon svg {
    margin-right: 1rem;
    font-size: 1.25rem;
    margin-top: 0.125rem;
}

.rtl .alert-icon i, .rtl .alert-icon svg {
    margin-right: 0;
    margin-left: 1rem;
}

.alert-heading {
    font-weight: 700;
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
}</div>
            </div>
        </section>
        
        <!-- ANIMATIONS SECTION -->
        <section id="animations">
            <h2 class="section-heading"><?php echo $isRtl ? 'انیمیشن‌ها' : 'Animations'; ?></h2>
            
            <div class="component-demo">
                <h3><?php echo $isRtl ? 'انیمیشن‌های پایه' : 'Basic Animations'; ?></h3>
                
                <div style="display: flex; flex-wrap: wrap; gap: 2rem; margin-bottom: 2rem;">
                    <div>
                        <div class="color-swatch floating" style="background-color: var(--primary); width: 100px; height: 100px;">
                            <div class="color-swatch-label">Floating</div>
                        </div>
                    </div>
                    <div>
                        <div class="color-swatch pulsing" style="background-color: var(--secondary); width: 100px; height: 100px;">
                            <div class="color-swatch-label">Pulsing</div>
                        </div>
                    </div>
                    <div>
                        <div class="color-swatch spinning" style="background-color: var(--accent-teal); width: 100px; height: 100px;">
                            <div class="color-swatch-label">Spinning</div>
                        </div>
                    </div>
                    <div>
                        <div class="color-swatch" style="background-color: var(--accent-pink); width: 100px; height: 100px; transition: var(--transition-medium);"
                             onmouseover="this.style.transform='scale(1.1)'" 
                             onmouseout="this.style.transform='scale(1)'">
                            <div class="color-swatch-label">Hover me</div>
                        </div>
                    </div>
                </div>
                
                <div class="component-code">/* Animation utility classes */
.floating {
    animation: float 6s ease-in-out infinite;
}

.floating-reverse {
    animation: float-reverse 7s ease-in-out infinite;
}

.pulsing {
    animation: pulse 2s ease-in-out infinite;
}

.spinning {
    animation: spin 15s linear infinite;
}

/* Animation keyframes */
@keyframes float {
    0% {
        transform: translateY(0) rotate(0deg);
    }
    50% {
        transform: translateY(-20px) rotate(2deg);
    }
    100% {
        transform: translateY(0) rotate(0deg);
    }
}

@keyframes pulse {
    0% {
        transform: scale(1);
        opacity: 0.8;
    }
    50% {
        transform: scale(1.05);
        opacity: 0.5;
    }
    100% {
        transform: scale(1);
        opacity: 0.8;
    }
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}</div>
            </div>
            
            <div class="component-demo">
                <h3><?php echo $isRtl ? 'زمان‌بندی‌های گذار' : 'Transition Timings'; ?></h3>
                
                <div class="component-code">/* Transitions */
--transition-fast: 0.25s cubic-bezier(0.25, 0.8, 0.25, 1);
--transition-medium: 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
--transition-slow: 0.7s cubic-bezier(0.25, 0.8, 0.25, 1);
--transition-bounce: 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);</div>
            </div>
        </section>
        
        <!-- RTL SUPPORT SECTION -->
        <section id="rtl">
            <h2 class="section-heading"><?php echo $isRtl ? 'پشتیبانی از زبان‌های راست به چپ' : 'RTL Language Support'; ?></h2>
            
            <div class="component-demo">
                <h3><?php echo $isRtl ? 'مقایسه LTR و RTL' : 'LTR vs RTL Comparison'; ?></h3>
                
                <div style="display: flex; flex-wrap: wrap; gap: 2rem;">
                    <div style="flex: 1; min-width: 300px;">
                        <h4>LTR (Left-to-Right)</h4>
                        <div dir="ltr" style="border: 1px solid var(--gray-200); padding: 1rem; border-radius: var(--border-radius); margin-bottom: 1rem;">
                            <h5>Form Example</h5>
                            <div class="form-group">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" placeholder="Enter username">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="Enter email">
                            </div>
                            <button class="btn btn-primary">Submit</button>
                        </div>
                        
                        <div dir="ltr" style="border: 1px solid var(--gray-200); padding: 1rem; border-radius: var(--border-radius);">
                            <h5>Alert Example</h5>
                            <div class="alert alert-primary alert-icon">
                                <i class="fa fa-info-circle"></i>
                                <div>
                                    This is an information message with an icon on the left side.
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div style="flex: 1; min-width: 300px;">
                        <h4>RTL (Right-to-Left)</h4>
                        <div dir="rtl" style="border: 1px solid var(--gray-200); padding: 1rem; border-radius: var(--border-radius); margin-bottom: 1rem;">
                            <h5>مثال فرم</h5>
                            <div class="form-group">
                                <label class="form-label">نام کاربری</label>
                                <input type="text" class="form-control" placeholder="نام کاربری را وارد کنید">
                            </div>
                            <div class="form-group">
                                <label class="form-label">ایمیل</label>
                                <input type="email" class="form-control" placeholder="ایمیل را وارد کنید">
                            </div>
                            <button class="btn btn-primary">ارسال</button>
                        </div>
                        
                        <div dir="rtl" style="border: 1px solid var(--gray-200); padding: 1rem; border-radius: var(--border-radius);">
                            <h5>مثال هشدار</h5>
                            <div class="alert alert-primary alert-icon">
                                <i class="fa fa-info-circle"></i>
                                <div>
                                    این یک پیام اطلاعاتی با آیکون در سمت راست است.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="component-code">/* RTL Base Styles */
[dir="rtl"] {
    direction: rtl;
    text-align: right;
}

/* Margin conversions */
[dir="rtl"] .ms-1 { margin-right: 0.25rem !important; margin-left: 0 !important; }
[dir="rtl"] .ms-2 { margin-right: 0.5rem !important; margin-left: 0 !important; }
[dir="rtl"] .ms-3 { margin-right: 1rem !important; margin-left: 0 !important; }
[dir="rtl"] .ms-4 { margin-right: 1.5rem !important; margin-left: 0 !important; }
[dir="rtl"] .ms-5 { margin-right: 3rem !important; margin-left: 0 !important; }

[dir="rtl"] .me-1 { margin-left: 0.25rem !important; margin-right: 0 !important; }
[dir="rtl"] .me-2 { margin-left: 0.5rem !important; margin-right: 0 !important; }
[dir="rtl"] .me-3 { margin-left: 1rem !important; margin-right: 0 !important; }
[dir="rtl"] .me-4 { margin-left: 1.5rem !important; margin-right: 0 !important; }
[dir="rtl"] .me-5 { margin-left: 3rem !important; margin-right: 0 !important; }

/* Form check conversion */
[dir="rtl"] .form-check {
    padding-right: 1.75rem;
    padding-left: 0;
}

[dir="rtl"] .form-check-input {
    float: right;
    margin-right: -1.75rem;
    margin-left: 0;
}</div>
            </div>
        </section>
    </main>

    <footer style="background-color: var(--gray-900); color: white; padding: 3rem 0; margin-top: 2rem; text-align: center;">
        <div class="design-system-container">
            <p><?php echo $isRtl ? 'سیستم طراحی سلمان - نسخه 1.0.0' : 'Salman Design System - Version 1.0.0'; ?></p>
        </div>
    </footer>

    <!-- Add a basic implementation of Font Awesome for icons in the examples -->
    <script>
        // This is a simplified implementation just for the demo
        // In a real application, use the actual Font Awesome library
        document.addEventListener('DOMContentLoaded', function() {
            // Replace icon placeholders with simple shapes for demo purposes
            const icons = document.querySelectorAll('.fa');
            icons.forEach(function(icon) {
                if (icon.classList.contains('fa-info-circle')) {
                    icon.innerHTML = '●';
                } else if (icon.classList.contains('fa-plus')) {
                    icon.innerHTML = '+';
                } else if (icon.classList.contains('fa-search')) {
                    icon.innerHTML = '🔍';
                } else if (icon.classList.contains('fa-check')) {
                    icon.innerHTML = '✓';
                } else if (icon.classList.contains('fa-arrow-right')) {
                    icon.innerHTML = '→';
                } else if (icon.classList.contains('fa-arrow-left')) {
                    icon.innerHTML = '←';
                }
            });
        });
    </script>
</body>
</html>