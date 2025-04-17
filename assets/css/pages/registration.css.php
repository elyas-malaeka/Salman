<Style>
    /**
 * registration.css.php - Registration Page Styles
 * 
 * Contains styles specifically for registration forms, progress indicators,
 * and registration-specific components.
 */

/****************************
 * STRUCTURE & ORGANIZATION
 ****************************/
/* 1. Core Registration Components
   - Registration container
   - Progress bar & steps
   - Form layouts & cards
   - Navigation buttons
   - Summary/confirmation views
   
 * 2. Form-Specific Elements  
   - File upload system
   - Transportation options
   - Custom form elements
   
 * 3. Result Pages
   - Success page
   - Error page
   - Certificate styling
   
 * 4. Visual Effects (specific to registration)
   - Cosmic header
   - Registration-specific animations
   
 * 5. Print Styles
   
 * 6. Responsive Adaptations
*/

/****************************
 * 1. CORE REGISTRATION COMPONENTS
 ****************************/

/* Registration container */
.registration-section {
    padding: 0 0 80px;
}

.registration-container {
    background-color: #fff;
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow);
    padding: 40px;
    margin-bottom: 50px;
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
    position: relative;
    overflow: hidden;
}

.registration-container::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: var(--purple-gradient);
    z-index: 1;
}

/* Progress Bar & Steps */
.registration-progress {
    margin-bottom: 50px;
    position: relative;
    display: flex;
    justify-content: space-between;
    max-width: 950px;
    margin-left: auto;
    margin-right: auto;
}

.progress-line {
    position: absolute;
    top: 28px;
    left: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary), var(--primary-light));
    width: 0%;
    transition: width 0.5s ease;
    z-index: 1;
}

.progress-step {
    position: relative;
    z-index: 2;
    width: 18%;
    text-align: center;
    cursor: default;
}

.progress-step.clickable {
    cursor: pointer;
}

.progress-step-icon {
    width: 60px;
    height: 60px;
    margin: 0 auto 10px;
    background-color: #f5f5f5;
    border: 2px solid #ddd;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    font-weight: 600;
    color: #777;
    transition: all 0.3s ease;
}

.progress-step-text {
    font-size: 14px;
    color: #777;
    transition: color 0.3s ease;
    max-width: 120px;
    margin: 0 auto;
}

.progress-step.active .progress-step-icon {
    background-color: #fff;
    border-color: var(--primary);
    color: var(--primary);
    box-shadow: 0 0 15px rgba(108, 99, 255, 0.3);
    transform: scale(1.1);
}

.progress-step.active .progress-step-text {
    color: var(--primary);
    font-weight: 600;
}

.progress-step.complete .progress-step-icon {
    background-color: var(--primary);
    border-color: var(--primary);
    color: #fff;
}

.progress-step.complete .progress-step-text {
    color: var(--primary);
}

/* Form steps & layouts */
.registration-step {
    display: none;
    animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.registration-step.active {
    display: block;
}

.step-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--gray-900);
    margin-bottom: 10px;
}

.step-description {
    font-size: 1rem;
    color: var(--gray-600);
    margin-bottom: 30px;
}

.registration-card {
    background-color: var(--gray-50);
    border-radius: var(--border-radius);
    padding: 25px;
    margin-bottom: 30px;
    box-shadow: var(--shadow-sm);
    transition: all 0.3s ease;
    border: 1px solid var(--gray-200);
}

.registration-card:hover {
    box-shadow: var(--shadow);
    transform: translateY(-3px);
    border-color: var(--gray-300);
}

.card-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--gray-800);
    border-bottom: 1px solid var(--gray-200);
    padding-bottom: 15px;
    margin-bottom: 20px;
    position: relative;
}

.card-title::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 60px;
    height: 3px;
    background: linear-gradient(90deg, var(--primary), var(--primary-light));
    border-radius: 3px;
}

/* Form layout grid system */
.form-row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.form-group {
    position: relative;
    padding-right: 15px;
    padding-left: 15px;
    margin-bottom: 1.5rem;
    flex: 0 0 50%; /* Two columns on desktop */
    max-width: 50%;
}

.form-group.full-width {
    flex: 0 0 100%;
    max-width: 100%;
}

/* Form grid responsive system */
@media (max-width: 767px) {
    .form-group {
        flex: 0 0 100%;
        max-width: 100%;
    }
}

/* Navigation buttons */
.step-buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 30px;
}

.btn-prev {
    color: var(--gray-700);
    background-color: var(--gray-100);
    border: 1px solid var(--gray-300);
    padding: 10px 25px;
    border-radius: var(--border-radius-pill);
    font-size: 0.95rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.btn-prev i {
    margin-right: 8px;
    transition: transform 0.3s;
}

.btn-prev:hover {
    background-color: var(--gray-200);
    color: var(--gray-800);
    transform: translateY(-2px);
}

.btn-prev:hover i {
    transform: translateX(-3px);
}

.btn-next {
    color: white;
    background: var(--purple-gradient);
    border: none;
    padding: 10px 25px;
    border-radius: var(--border-radius-pill);
    font-size: 0.95rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: var(--purple-shadow);
    display: inline-flex;
    align-items: center;
}

.btn-next i {
    margin-left: 8px;
    transition: transform 0.3s;
}

.btn-next:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 15px rgba(108, 99, 255, 0.3);
}

.btn-next:hover i {
    transform: translateX(3px);
}

.btn-submit {
    color: white;
    background: var(--success-gradient);
    border: none;
    padding: 10px 25px;
    border-radius: var(--border-radius-pill);
    font-size: 0.95rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: var(--success-shadow);
    display: inline-flex;
    align-items: center;
}

.btn-submit i {
    margin-right: 8px;
    transition: transform 0.3s;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 15px rgba(76, 175, 80, 0.3);
}

/* Summary modal */
.summary-section {
    margin-bottom: 25px;
    border-bottom: 1px solid var(--gray-200);
    padding-bottom: 20px;
}

.summary-section:last-child {
    border-bottom: none;
    padding-bottom: 0;
    margin-bottom: 0;
}

.summary-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--primary);
    margin-bottom: 15px;
    position: relative;
    padding-left: 20px;
}

.summary-title::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 8px;
    height: 8px;
    background-color: var(--primary);
    border-radius: 50%;
}

.summary-items {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px 30px;
}

.summary-item {
    display: flex;
    flex-wrap: wrap;
    margin-bottom: 10px;
}

.summary-label {
    flex: 0 0 40%;
    font-weight: 500;
    color: var(--gray-700);
}

.summary-value {
    flex: 0 0 60%;
    color: var(--gray-800);
}

/* Loading spinner */
.spinner-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.8);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    visibility: hidden;
    opacity: 0;
    transition: opacity 0.3s, visibility 0.3s;
    backdrop-filter: blur(5px);
}

.spinner-container.show {
    visibility: visible;
    opacity: 1;
}

.spinner {
    width: 50px;
    height: 50px;
    border: 5px solid #f3f3f3;
    border-top: 5px solid var(--primary);
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

/****************************
 * 2. FORM-SPECIFIC ELEMENTS
 ****************************/

/* File upload system */
.file-upload-container {
    position: relative;
    border: 2px dashed var(--gray-300);
    border-radius: var(--border-radius);
    padding: 15px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background-color: var(--gray-50);
    height: 170px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 100%;
    margin: 0;
}

.file-upload-container:hover, 
.file-upload-container.highlight {
    border-color: var(--primary);
    background-color: rgba(108, 99, 255, 0.05);
    transform: translateY(-2px);
}

.file-upload-icon {
    width: 50px;
    height: 50px;
    background: rgba(108, 99, 255, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 10px;
    color: var(--primary);
    font-size: 1.5rem;
    transition: all 0.3s ease;
}

.file-upload-container:hover .file-upload-icon {
    background: var(--primary);
    color: white;
    transform: scale(1.05);
    box-shadow: 0 5px 15px rgba(108, 99, 255, 0.2);
}

.file-upload-text {
    font-weight: 600;
    color: var(--gray-800);
    margin-bottom: 5px;
    font-size: 0.95rem;
}

.file-upload-hint {
    font-size: 0.75rem;
    color: var(--gray-500);
    max-width: 200px;
    margin: 0 auto;
}

.file-preview {
    background-color: white;
    border: 1px solid var(--gray-200);
    border-radius: var(--border-radius);
    padding: 15px;
    text-align: center;
    height: 170px;
    width: 100%;
    margin: 0;
    display: none; /* Hidden by default */
    position: relative;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.file-preview.active {
    display: flex;
}

.file-preview-image {
    max-width: 100%;
    max-height: 70px;
    border-radius: var(--border-radius-sm);
    object-fit: cover;
    margin-bottom: 5px;
    box-shadow: var(--shadow-sm);
    display: none;
}

.file-preview-icon {
    width: 40px;
    height: 40px;
    margin-bottom: 5px;
    background-color: var(--gray-100);
    border-radius: var(--border-radius-sm);
    display: none;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    color: var(--primary);
}

.file-preview-name {
    font-weight: 600;
    color: var(--gray-800);
    margin-bottom: 5px;
    font-size: 0.85rem;
    word-break: break-all;
    text-align: center;
    max-width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    line-clamp: 1;
    -webkit-box-orient: vertical;
}

.file-preview-size {
    font-size: 0.75rem;
    color: var(--gray-500);
    margin-bottom: 5px;
}

.file-preview-remove {
    position: absolute;
    bottom: 15px;
    left: 50%;
    transform: translateX(-50%);
    background-color: white;
    color: var(--danger);
    border: 1px solid var(--danger);
    padding: 5px 15px;
    border-radius: var(--border-radius-pill);
    font-size: 0.8rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    width: auto;
    z-index: 10;
    min-width: 90px;
}

.file-preview-remove:hover {
    background-color: var(--danger);
    color: white;
}

.file-preview-remove i {
    margin-right: 5px;
    font-size: 0.8rem;
}

.file-upload-container.has-file {
    display: none;
}

/* Document grid layout */
.document-form-row .form-group.file-field {
    margin-bottom: 15px;
}

@media (min-width: 992px) {
    .document-form-row .form-group.file-field {
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }
}

@media (min-width: 768px) and (max-width: 991px) {
    .document-form-row .form-group.file-field {
        flex: 0 0 50%;
        max-width: 50%;
    }
}

/* Transportation options */
.transportation-radio-group {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.transportation-option {
    min-width: 120px;
    padding: 12px 20px;
    border: 2px solid var(--gray-200);
    border-radius: var(--border-radius);
    transition: all 0.3s ease;
    cursor: pointer;
    flex: 1;
    display: flex;
    align-items: center;
}

.transportation-option:hover {
    background-color: var(--gray-100);
    transform: translateY(-2px);
    border-color: var(--gray-300);
}

.transportation-option .form-check-input {
    margin-right: 10px;
}

.transportation-option .form-check-label {
    margin-bottom: 0;
    transition: all 0.3s ease;
    font-weight: 500;
}

.transportation-option.selected {
    border-color: var(--primary);
    background-color: rgba(var(--primary-rgb), 0.05);
    box-shadow: 0 0 0 1px var(--primary);
}

.transportation-option.selected .form-check-label {
    font-weight: 600;
    color: var(--primary);
}

/* Route Description */
#routeDescription {
    background-color: var(--gray-50);
    border-left: 3px solid var(--primary);
    padding: 12px 15px;
    font-size: 0.95rem;
    margin-top: 10px;
    border-radius: 0 var(--border-radius-sm) var(--border-radius-sm) 0;
    color: var(--gray-700);
}

/* Route Stops */
.route-stops {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 10px;
}

.route-stop {
    display: inline-block;
    background-color: var(--gray-100);
    padding: 5px 10px;
    border-radius: var(--border-radius-xs);
    font-size: 0.9rem;
    color: var(--gray-700);
    border: 1px solid var(--gray-200);
}
/****************************
 * RESPONSIVE GRID LAYOUT
 ****************************/
/* استایل‌های گرید ریسپانسیو برای فرم */
.form-row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -10px;
    margin-left: -10px;
}

/* استایل‌های پایه برای گروه‌های فرم */
.form-group {
    position: relative;
    padding-right: 10px;
    padding-left: 10px;
    margin-bottom: 1.5rem;
    width: 100%;
}

/* گرید بندی ریسپانسیو */
/* موبایل: یک ستون (پیش‌فرض) */
.form-group {
    flex: 0 0 100%;
    max-width: 100%;
}

/* تبلت: دو ستون برای همه فیلدها */
@media (min-width: 768px) {
    .form-group {
        flex: 0 0 50%;
        max-width: 50%;
    }
    
    .form-group.full-width {
        flex: 0 0 100%;
        max-width: 100%;
    }
}

/* لپ‌تاپ و دسکتاپ: سه ستون برای فیلدهای فایل، دو ستون برای بقیه */
@media (min-width: 992px) {
    .form-group.file-field {
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }
}

/* کلاس‌های کمکی برای عرض */
.full-width {
    flex: 0 0 100% !important;
    max-width: 100% !important;
}
/****************************
 * FILE UPLOAD SYSTEM - COMPLETE CSS
 ****************************/

.file-upload-container:hover, 
.file-upload-container.highlight {
    border-color: var(--primary);
    background-color: rgba(108, 99, 255, 0.05);
}

.file-upload-icon {
    width: 50px;
    height: 50px;
    background: rgba(108, 99, 255, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 10px;
    color: var(--primary);
    font-size: 1.5rem;
    transition: all 0.3s ease;
}

.file-upload-container:hover .file-upload-icon {
    background: var(--primary);
    color: white;
}

.file-upload-text {
    font-weight: 600;
    color: var(--gray-800);
    margin-bottom: 5px;
    font-size: 0.95rem;
}

.file-upload-hint {
    font-size: 0.75rem;
    color: var(--gray-500);
    max-width: 200px;
    margin: 0 auto;
}

.file-upload-input {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    z-index: 2;
}

/* --------------------------
   FILE PREVIEW
   -------------------------- */
.file-preview-image {
    max-width: 80px;
    max-height: 60px;
    margin: 5px auto 10px;
    display: block;
    border-radius: 4px;
    object-fit: cover;
}

.file-preview-icon {
    width: 40px;
    height: 40px;
    margin: 5px auto 10px;
    background-color: var(--gray-100);
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    color: var(--primary);
}

.file-preview-name {
    font-weight: 600;
    color: var(--gray-800);
    font-size: 0.9rem;
    margin-bottom: 5px;
    word-break: break-word;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    line-clamp: 1;
    -webkit-box-orient: vertical;
    max-width: 180px;
    margin-left: auto;
    margin-right: auto;
}

.file-preview-size {
    font-size: 0.8rem;
    color: var(--gray-500);
    margin-bottom: 15px;
}
/* --------------------------
   GRID LAYOUT FOR FILES
   -------------------------- */
.form-group.file-field {
    padding: 10px;
    box-sizing: border-box;
    margin-bottom: 15px;
}

/* رسپانسیو */
@media (min-width: 992px) {
    .document-form-row .form-group.file-field {
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }
}

@media (min-width: 768px) and (max-width: 991px) {
    .document-form-row .form-group.file-field {
        flex: 0 0 50%;
        max-width: 50%;
    }
}

@media (max-width: 767px) {
    .document-form-row .form-group.file-field {
        flex: 0 0 100%;
        max-width: 100%;
    }
}

/* --------------------------
   VALIDATION FEEDBACK
   -------------------------- */
.invalid-feedback {
    display: none;
    color: var(--danger);
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.invalid-feedback.d-block {
    display: block;
}

/* --------------------------
   ANIMATION
   -------------------------- */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.file-preview.active {
    animation: fadeIn 0.3s ease-in-out;
}
.file-preview {
    position: relative !important; /* برای قرار دادن دکمه حذف */
    height: 170px !important;
}

.file-preview-remove {
    position: absolute !important;
    bottom: 15px !important;
    left: 50% !important;
    transform: translateX(-50%) !important;
    width: 100px !important; /* عرض ثابت */
    text-align: center !important;
    z-index: 10 !important;
    padding: 5px 10px !important;
    margin: 0 !important; /* حذف مارجین‌ها */
    transition: background-color 0.3s !important; /* فقط تغییر رنگ در هاور */
}

.file-preview-remove:hover {
    transform: translateX(-50%) !important; /* تغییر ندادن موقعیت در هاور */
}

/****************************
 * 3. RESULT PAGES
 ****************************/

/* Registration Success Page */
.success-container {
    background-color: #fff;
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-lg);
    overflow: hidden;
    max-width: 800px;
    margin: 0 auto 80px;
    position: relative;
}

.success-header {
    background: var(--purple-gradient);
    padding: 30px;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.success-header::before {
    content: '';
    position: absolute;
    width: 150%;
    height: 100px;
    background: rgba(255, 255, 255, 0.1);
    transform: rotate(-5deg);
    bottom: -50px;
    left: -25%;
}

.success-icon-wrap {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    margin: 0 auto 20px;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.success-icon-wrap::before {
    content: '';
    position: absolute;
    width: 140px;
    height: 140px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    z-index: 0;
}

.success-icon {
    width: 90px;
    height: 90px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 40px;
    color: var(--primary);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    position: relative;
    z-index: 1;
}

.success-title {
    font-size: 28px;
    font-weight: 700;
    color: white;
    margin-bottom: 10px;
    text-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.success-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 16px;
    max-width: 600px;
    margin: 0 auto;
}

.success-body {
    padding: 40px;
}

/* Tracking Number Display */
.tracking-card {
    background: linear-gradient(135deg, var(--light-purple) 0%, #ffffff 100%);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-sm);
    padding: 25px;
    margin-bottom: 30px;
    text-align: center;
    position: relative;
    border: 1px dashed rgba(var(--primary-rgb), 0.3);
}

.tracking-title {
    font-size: 16px;
    font-weight: 600;
    color: var(--gray-700);
    margin-bottom: 15px;
}

.tracking-number {
    background: white;
    padding: 12px 25px;
    border-radius: var(--border-radius-sm);
    font-size: 24px;
    font-weight: 700;
    color: var(--primary);
    display: inline-block;
    box-shadow: var(--shadow-sm);
    margin-bottom: 10px;
    border: 1px solid rgba(var(--primary-rgb), 0.1);
    min-width: 200px;
    position: relative;
    overflow: hidden;
}

.tracking-number::before {
    content: '';
    position: absolute;
    top: 0;
    left: -75%;
    width: 50%;
    height: 100%;
    background: linear-gradient(90deg, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.8) 50%, rgba(255, 255, 255, 0) 100%);
    transform: skewX(-25deg);
    animation: shine 3s infinite;
}

@keyframes shine {
    0% { left: -75%; }
    100% { left: 150%; }
}

.tracking-hint {
    font-size: 14px;
    color: var(--gray-500);
}

/* Info sections on success page */
.info-section {
    margin-bottom: 30px;
}

.info-heading {
    font-size: 18px;
    font-weight: 600;
    color: var(--gray-800);
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--gray-200);
    position: relative;
}

.info-heading::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 50px;
    height: 3px;
    background: var(--purple-gradient);
    border-radius: 3px;
}

.student-info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
    margin-bottom: 20px;
}

.info-item {
    background: var(--gray-50);
    border-radius: var(--border-radius-sm);
    padding: 12px 15px;
    border: 1px solid var(--gray-200);
}

.info-label {
    font-size: 13px;
    color: var(--gray-600);
    margin-bottom: 5px;
}

.info-value {
    font-size: 15px;
    font-weight: 500;
    color: var(--gray-800);
}

/* Status indicators */
.status-badge {
    display: inline-block;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 500;
}

.status-pending {
    background-color: var(--warning-light);
    color: var(--warning);
}

.status-approved {
    background-color: var(--success-light);
    color: var(--success);
}

.status-rejected {
    background-color: var(--danger-light);
    color: var(--danger);
}

/* Steps list */
.steps-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.step-item {
    display: flex;
    margin-bottom: 15px;
    position: relative;
    padding-left: 30px;
    align-items: flex-start;
}

.step-item::before {
    content: '';
    position: absolute;
    left: 0;
    top: 5px;
    width: 20px;
    height: 20px;
    background: var(--light-purple);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary);
    font-weight: 700;
    font-size: 12px;
    border: 2px solid var(--primary);
}

.step-item:nth-child(1)::before { content: '1'; }
.step-item:nth-child(2)::before { content: '2'; }
.step-item:nth-child(3)::before { content: '3'; }
.step-item:nth-child(4)::before { content: '4'; }
.step-item:nth-child(5)::before { content: '5'; }

.step-text {
    font-size: 15px;
    color: var(--gray-700);
    line-height: 1.5;
}

/* Contact information grid */
.contact-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
}

.contact-item {
    display: flex;
    align-items: center;
    padding: 12px 15px;
    background: var(--gray-50);
    border-radius: var(--border-radius-sm);
    border: 1px solid var(--gray-200);
}

.contact-icon {
    width: 40px;
    height: 40px;
    background: var(--light-purple);
    color: var(--primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    flex-shrink: 0;
}

.contact-text {
    flex-grow: 1;
}

.contact-label {
    font-size: 13px;
    color: var(--gray-600);
    margin-bottom: 2px;
}

.contact-value {
    font-size: 14px;
    color: var(--gray-800);
    font-weight: 500;
}

/* Action buttons */
.action-buttons {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 30px;
}

.btn-action {
    padding: 12px 25px;
    border-radius: var(--border-radius-pill);
    font-weight: 600;
    font-size: 15px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    cursor: pointer;
    text-decoration: none;
}

.btn-action i {
    margin-right: 8px;
}

.btn-print {
    background: var(--purple-gradient);
    color: white;
    box-shadow: var(--purple-shadow);
    border: none;
}

.btn-print:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(var(--primary-rgb), 0.4);
    color: white;
}

.btn-home {
    background: white;
    color: var(--primary);
    border: 2px solid var(--primary);
}

.btn-home:hover {
    background: var(--light-purple);
    transform: translateY(-3px);
}

/* Certificate styling */
.certificate-container {
    background-color: #fff;
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-lg);
    margin: 2rem auto;
    padding: 0;
    position: relative;
    overflow: hidden;
    max-width: 210mm; /* A4 width */
}

.certificate-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 8px;
    background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
    z-index: 2;
}

.certificate-content {
    padding: 3rem;
    position: relative;
    background: #fff;
    z-index: 1;
}

.certificate-header {
    text-align: center;
    margin-bottom: 2.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid rgba(108, 99, 255, 0.1);
    position: relative;
}

.certificate-header::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 3px;
    background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
    border-radius: 3px;
}

.school-logo {
    max-width: 180px;
    margin: 0 auto 1.5rem;
    display: block;
}

.certificate-title {
    font-size: 2rem;
    font-weight: 700;
    color: var(--gray-900);
    margin-bottom: 1rem;
}

.certificate-message {
    font-size: 1.1rem;
    color: var(--gray-700);
    max-width: 700px;
    margin: 0 auto 1rem;
}

/* Print certificate */
.print-certificate {
    display: none;
}

/* Error page */
.error-section {
    padding: 60px 0;
}

.error-card {
    background-color: #fff;
    border-radius: var(--border-radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-lg);
    margin-bottom: 30px;
    max-width: 800px;
    margin: 0 auto;
    padding: 3rem;
    text-align: center;
}

.error-icon {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
    font-size: 64px;
    color: var(--danger);
}

.error-title {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 15px;
    color: var(--gray-900);
}

.error-message {
    font-size: 18px;
    color: var(--gray-700);
    margin-bottom: 30px;
    line-height: 1.6;
}

.btn-registration {
    background-color: var(--primary);
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: var(--border-radius-pill);
    font-weight: 500;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    box-shadow: var(--purple-shadow);
}

.btn-registration:hover {
    background-color: var(--primary-dark);
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(108, 99, 255, 0.3);
    color: white;
}

.btn-registration i {
    margin-right: 10px;
}

/****************************
 * 4. VISUAL EFFECTS
 ****************************/

/* Cosmic header & background effects */
.cosmic-header {
    background: var(--cosmic-gradient);
    padding: 180px 0 80px;
    position: relative;
    overflow: hidden;
    margin-bottom: 50px;
    z-index: 1;
}

.cosmic-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgcGF0dGVyblRyYW5zZm9ybT0icm90YXRlKDQ1KSI+PGNpcmNsZSBpZD0iZG90IiBjeD0iMTYiIGN5PSIxNiIgcj0iMSIgZmlsbD0iI2ZmZiIgb3BhY2l0eT0iMC4zIi8+PC9wYXR0ZXJuPjwvZGVmcz48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSJ1cmwoI3BhdHRlcm4pIiAvPjwvc3ZnPg==');
    opacity: 0.3;
    z-index: 0;
}

.cosmic-header__title {
    color: white;
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 1rem;
    position: relative;
    z-index: 2;
    text-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
}

.cosmic-header__subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1.2rem;
    position: relative;
    z-index: 2;
    max-width: 800px;
    margin: 0 auto;
}

.cosmic-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: 1;
}

.cosmic-planet {
    position: absolute;
    border-radius: 50%;
    opacity: 0.4;
    filter: blur(40px);
    z-index: 0;
}

.cosmic-star {
    position: absolute;
    width: 2px;
    height: 2px;
    background-color: white;
    border-radius: 50%;
    z-index: 0;
}

.meteor {
    position: absolute;
    background: linear-gradient(45deg, #fff, transparent);
    width: 150px;
    height: 2px;
    transform: rotate(45deg);
    z-index: 1;
    opacity: 0;
    filter: blur(1px);
    animation: meteor 6s linear infinite;
}

@keyframes meteor {
    0% {
        transform: translateX(300%) translateY(-300%) rotate(45deg);
        opacity: 1;
    }
    70% {
        opacity: 1;
    }
    100% {
        transform: translateX(-300%) translateY(300%) rotate(45deg);
        opacity: 0;
    }
}

/****************************
 * 5. PRINT STYLES
 ****************************/
@media print {
    @page {
        size: A4 portrait;
        margin: 0;
    }
    
    html, body {
        width: 210mm;
        height: 297mm;
        margin: 0 !important;
        padding: 0 !important;
        background-color: white !important;
    }
    
    body {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
    
    /* Hide everything except certificate */
    body * {
        visibility: hidden;
    }
    
    .certificate-container, 
    .certificate-container * {
        visibility: visible !important;
    }
    
    /* Position the certificate */
    .certificate-container {
        position: absolute !important;
        left: 0 !important;
        top: 0 !important;
        width: 100% !important;
        height: auto !important;
        margin: 0 !important;
        padding: 0 !important;
        overflow: visible !important;
        box-shadow: none !important;
        border-radius: 0 !important;
    }
    
    .certificate-container::before {
        display: none !important;
    }
    
    .certificate-content {
        padding: 15mm !important;
    }
    
    /* Ensure backgrounds print properly */
    .student-info-box {
        background-color: #f9f9ff !important;
    }
    
    .registration-status.status-pending {
        background-color: rgba(255, 193, 7, 0.1) !important;
        color: var(--warning) !important;
    }
    
    .registration-status.status-approved {
        background-color: rgba(76, 175, 80, 0.1) !important;
        color: var(--success) !important;
    }
    
    .registration-status.status-rejected {
        background-color: rgba(244, 67, 54, 0.1) !important;
        color: var(--danger) !important;
    }
    
    /* Hide non-printable elements */
    .no-print,
    header,
    footer,
    nav,
    .cosmic-header,
    .online-message-card,
    .certificate-actions {
        display: none !important;
    }
    
    /* Prevent page breaks within important sections */
    .student-info-box,
    .next-steps-section,
    .contact-info-section {
        page-break-inside: avoid !important;
    }
    
    /* Print certificate */
    .print-certificate {
        display: block;
        padding: 20mm;
        position: relative;
    }
    
    .certificate-watermark {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(-45deg);
        font-size: 80px;
        color: rgba(0, 0, 0, 0.03);
        font-weight: 800;
        pointer-events: none;
        white-space: nowrap;
    }
}

/****************************
 * 6. RESPONSIVE ADAPTATIONS
 ****************************/
@media (max-width: 1199px) {
    .cosmic-header {
        padding: 150px 0 70px;
    }
    
    .cosmic-header__title {
        font-size: 2.75rem;
    }
    
    .registration-container {
        padding: 30px;
    }
    
    .progress-step-icon {
        width: 50px;
        height: 50px;
        font-size: 20px;
    }
    
    .progress-line {
        top: 23px;
    }
}

@media (max-width: 991px) {
    .cosmic-header {
        padding: 130px 0 60px;
    }
    
    .cosmic-header__title {
        font-size: 2.5rem;
    }
    
    .cosmic-header__subtitle {
        font-size: 1.1rem;
    }
    
    .registration-container {
        padding: 25px;
    }
    
    .registration-card {
        padding: 20px;
    }
    
    .card-title {
        font-size: 1.2rem;
        margin-bottom: 15px;
    }
    
    .progress-step-text {
        font-size: 0.85rem;
    }
    
    .success-icon {
        width: 100px;
        height: 100px;
        font-size: 3rem;
    }
    
    .success-title {
        font-size: 2.25rem;
    }
    
    .success-description {
        font-size: 1.1rem;
    }
    
    .tracking-number {
        font-size: 2rem;
    }
    
    .certificate-content {
        padding: 2rem;
    }
    
    .certificate-title {
        font-size: 1.75rem;
    }
    
    .contact-item {
        flex: 0 0 100%;
    }
}

@media (max-width: 767px) {
    .cosmic-header {
        padding: 120px 0 50px;
    }
    
    .cosmic-header__title {
        font-size: 2rem;
    }
    
    .cosmic-header__subtitle {
        font-size: 1rem;
    }
    
    .registration-container {
        padding: 20px 15px;
    }
    
    .registration-progress {
        overflow-x: auto;
        justify-content: flex-start;
        padding-bottom: 15px;
        margin-bottom: 30px;
    }
    
    .progress-step {
        flex: 0 0 100px;
        min-width: 100px;
        margin-right: 5px;
    }
    
    .progress-step-icon {
        width: 40px;
        height: 40px;
        font-size: 16px;
    }
    
    .progress-step-text {
        font-size: 0.8rem;
    }
    
    .progress-line {
        top: 18px;
    }
    
    .transportation-radio-group {
        flex-direction: column;
        gap: 10px;
    }
    
    .step-buttons {
        flex-direction: column;
        gap: 15px;
    }
    
    .btn-prev,
    .btn-next,
    .btn-submit {
        width: 100%;
        justify-content: center;
    }
    
    .student-info-grid,
    .contact-grid,
    .summary-items {
        grid-template-columns: 1fr;
    }
    
    .student-info-row {
        flex-direction: column;
    }
    
    .student-info-label,
    .student-info-value {
        flex: 0 0 100%;
    }
    
    .student-info-label {
        margin-bottom: 0.25rem;
    }
    
    .certificate-actions,
    .action-buttons {
        flex-direction: column;
        gap: 1rem;
    }
    
    .btn-action {
        width: 100%;
    }
}

@media (max-width: 575px) {
    .cosmic-header {
        padding: 100px 0 40px;
    }
    
    .cosmic-header__title {
        font-size: 1.75rem;
    }
    
    .cosmic-header__subtitle {
        font-size: 0.95rem;
    }
    
    .registration-container {
        padding: 15px 10px;
    }
    
    .registration-card {
        padding: 15px;
        margin-bottom: 20px;
    }
    
    .card-title {
        font-size: 1.1rem;
        margin-bottom: 12px;
        padding-bottom: 10px;
    }
    
    .error-card {
        padding: 2rem 1.5rem;
    }
    
    .error-icon {
        font-size: 48px;
    }
    
    .error-title {
        font-size: 22px;
    }
    
    .error-message {
        font-size: 16px;
    }
}
</Style>