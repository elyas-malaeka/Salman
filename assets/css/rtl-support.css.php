<style>
    /**
 * rtl-support.css.php - RTL Support Styles
 * 
 * Contains all styles necessary for proper right-to-left (RTL) language support
 * including Persian, Arabic and other RTL languages.
 */

/* RTL Base Styles */
[dir="rtl"] {
    direction: rtl;
    text-align: right;
}

/* =========================
   Text & Typography RTL Fixes
   ========================= */
[dir="rtl"] .text-left {
    text-align: right !important;
}

[dir="rtl"] .text-right {
    text-align: left !important;
}

/* =========================
   Layout & Alignment RTL Fixes
   ========================= */
/* Fix for floating elements in RTL */
[dir="rtl"] .float-start {
    float: right !important;
}

[dir="rtl"] .float-end {
    float: left !important;
}

/* Fix for flexbox order */
[dir="rtl"] .flex-row {
    flex-direction: row-reverse;
}

[dir="rtl"] .me-auto {
    margin-right: 0 !important;
    margin-left: auto !important;
}

[dir="rtl"] .ms-auto {
    margin-left: 0 !important;
    margin-right: auto !important;
}

/* Margins RTL conversion */
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

/* Padding RTL conversion */
[dir="rtl"] .ps-1 { padding-right: 0.25rem !important; padding-left: 0 !important; }
[dir="rtl"] .ps-2 { padding-right: 0.5rem !important; padding-left: 0 !important; }
[dir="rtl"] .ps-3 { padding-right: 1rem !important; padding-left: 0 !important; }
[dir="rtl"] .ps-4 { padding-right: 1.5rem !important; padding-left: 0 !important; }
[dir="rtl"] .ps-5 { padding-right: 3rem !important; padding-left: 0 !important; }

[dir="rtl"] .pe-1 { padding-left: 0.25rem !important; padding-right: 0 !important; }
[dir="rtl"] .pe-2 { padding-left: 0.5rem !important; padding-right: 0 !important; }
[dir="rtl"] .pe-3 { padding-left: 1rem !important; padding-right: 0 !important; }
[dir="rtl"] .pe-4 { padding-left: 1.5rem !important; padding-right: 0 !important; }
[dir="rtl"] .pe-5 { padding-left: 3rem !important; padding-right: 0 !important; }

/* =========================
   Form Elements RTL Fixes
   ========================= */
[dir="rtl"] .form-check {
    padding-right: 1.75rem;
    padding-left: 0;
}

[dir="rtl"] .form-check-input {
    float: right;
    margin-right: -1.75rem;
    margin-left: 0;
}

[dir="rtl"] .form-select {
    padding-right: 0.75rem;
    padding-left: 2rem;
    background-position: left 0.75rem center;
}

[dir="rtl"] .input-group > :not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
    margin-right: calc(var(--border-width) * -1);
    margin-left: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    border-top-left-radius: var(--border-radius);
    border-bottom-left-radius: var(--border-radius);
}

[dir="rtl"] .input-group > :not(:last-child):not(.dropdown-toggle):not(.dropdown-menu):not(.form-floating) {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    border-top-right-radius: var(--border-radius);
    border-bottom-right-radius: var(--border-radius);
}

[dir="rtl"] .input-group-text:first-child {
    border-right: var(--border-width) solid var(--border-color);
    border-left: 0;
}

/* Fix for validation icons */
[dir="rtl"] .was-validated .form-control:invalid,
[dir="rtl"] .form-control.is-invalid {
    padding-right: 0.75rem;
    padding-left: calc(1.5em + 0.75rem);
    background-position: left 0.75rem center;
}

[dir="rtl"] .was-validated .form-control:valid,
[dir="rtl"] .form-control.is-valid {
    padding-right: 0.75rem;
    padding-left: calc(1.5em + 0.75rem);
    background-position: left 0.75rem center;
}

/* Fix for required field indicator */
[dir="rtl"] .required-field::after {
    margin-right: 0.25rem;
    margin-left: 0;
}

/* =========================
   Button RTL Fixes
   ========================= */
[dir="rtl"] .btn i,
[dir="rtl"] .btn svg {
    margin-left: 0.5rem;
    margin-right: 0;
}

[dir="rtl"] .btn:hover i,
[dir="rtl"] .btn:hover svg {
    transform: translateX(-5px);
}
[dir="rtl"] .step-buttons {
    flex-direction: row-reverse;
}

[dir="rtl"] .btn-prev:hover i.fa-arrow-left {
    transform: translateX(3px);
}

[dir="rtl"] .btn-next:hover i.fa-arrow-right {
    transform: translateX(-3px);
}
/* =========================
   Alerts & Messages RTL Fixes
   ========================= */
[dir="rtl"] .alert-dismissible {
    padding-left: 4rem;
    padding-right: 1.25rem;
}

[dir="rtl"] .alert-dismissible .close {
    left: 0;
    right: auto;
}

[dir="rtl"] .alert-icon i,
[dir="rtl"] .alert-icon svg {
    margin-left: 1rem;
    margin-right: 0;
}


/* =========================
   Icons & Badge RTL Fixes
   ========================= */
/* Fix for specific fontawesome icons direction */
[dir="rtl"] .fa-arrow-right:before {
    content: "\f060"; /* fa-arrow-left unicode */
}

[dir="rtl"] .fa-arrow-left:before {
    content: "\f061"; /* fa-arrow-right unicode */
}

[dir="rtl"] .fa-chevron-right:before {
    content: "\f053"; /* fa-chevron-left unicode */
}

[dir="rtl"] .fa-chevron-left:before {
    content: "\f054"; /* fa-chevron-right unicode */
}

[dir="rtl"] .fa-long-arrow-right:before {
    content: "\f177"; /* fa-long-arrow-left unicode */
}

[dir="rtl"] .fa-long-arrow-left:before {
    content: "\f178"; /* fa-long-arrow-right unicode */
}

/* =========================
   Card & Panel RTL Fixes
   ========================= */
[dir="rtl"] .card-header-tabs {
    margin-right: -1.25rem;
    margin-left: -1.25rem;
    padding-right: 1.25rem;
    padding-left: 1.25rem;
}

[dir="rtl"] .list-group {
    padding-right: 0;
}

[dir="rtl"] .list-group-horizontal {
    flex-direction: row-reverse;
}

/* =========================
   Modal RTL Fixes
   ========================= */
[dir="rtl"] .modal-header .close {
    margin: -1rem auto -1rem -1rem;
}

[dir="rtl"] .modal-footer {
    justify-content: flex-start;
}

[dir="rtl"] .modal-footer > * {
    margin: 0 0 0 0.25rem;
}

/* =========================
   Dropdown RTL Fixes
   ========================= */
[dir="rtl"] .dropdown-menu {
    text-align: right;
}

[dir="rtl"] .dropdown-item {
    text-align: right;
}

[dir="rtl"] .dropdown-toggle::after {
    margin-right: 0.255em;
    margin-left: 0;
}

/* =========================
   Pagination RTL Fixes
   ========================= */
[dir="rtl"] .pagination {
    padding-right: 0;
}

[dir="rtl"] .page-item:first-child .page-link {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    border-top-right-radius: var(--border-radius);
    border-bottom-right-radius: var(--border-radius);
}

[dir="rtl"] .page-item:last-child .page-link {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    border-top-left-radius: var(--border-radius);
    border-bottom-left-radius: var(--border-radius);
}

/* =========================
   Navigation RTL Fixes
   ========================= */
[dir="rtl"] .nav {
    padding-right: 0;
}

[dir="rtl"] .navbar-nav {
    padding-right: 0;
}

[dir="rtl"] .navbar-nav .dropdown-menu {
    right: 0;
    left: auto;
}

/* =========================
   Progress Bar RTL Fixes
   ========================= */
[dir="rtl"] .progress-bar {
    float: right;
}

/* =========================
   Fixed Elements RTL Fixes
   ========================= */
[dir="rtl"] .fixed-top,
[dir="rtl"] .sticky-top {
    right: 0;
    left: 0;
}

[dir="rtl"] .fixed-bottom {
    right: 0;
    left: 0;
}

[dir="rtl"] .fixed-left {
    left: auto;
    right: 0;
}

[dir="rtl"] .fixed-right {
    right: auto;
    left: 0;
}

[dir="rtl"] .breadcrumb-item + .breadcrumb-item {
    padding-right: 0.5rem;
    padding-left: 0;
}

[dir="rtl"] .breadcrumb-item + .breadcrumb-item::before {
    padding-left: 0.5rem;
    padding-right: 0;
}

/* =========================
   Registration-specific RTL Fixes
   ========================= */
[dir="rtl"] .progress-line {
    right: 0;
    left: auto;
}

[dir="rtl"] .progress-step-icon {
    margin-right: auto;
    margin-left: auto;
}

[dir="rtl"] .card-title::after {
    right: 0;
    left: auto;
}

[dir="rtl"] .file-preview-remove i {
    margin-left: 0.5rem;
    margin-right: 0;
}

[dir="rtl"] .step-buttons {
    flex-direction: row-reverse;
}

[dir="rtl"] .student-info-box::before {
    right: 0;
    left: auto;
    border-radius: 0 5px 5px 0;
}

[dir="rtl"] .step-item {
    padding-right: 2rem;
    padding-left: 0;
}

[dir="rtl"] .step-item::before {
    right: 0;
    left: auto;
}

[dir="rtl"] .step-number {
    margin-left: 0.5rem;
    margin-right: 0;
}

[dir="rtl"] .contact-icon {
    margin-left: 0.75rem;
    margin-right: 0;
}

[dir="rtl"] .section-divider::before {
    right: -40px;
    left: auto;
    background: linear-gradient(90deg, rgba(108, 99, 255, 0.5) 0%, rgba(108, 99, 255, 0) 100%);
}

[dir="rtl"] .section-divider::after {
    left: -40px;
    right: auto;
    background: linear-gradient(90deg, rgba(108, 99, 255, 0) 0%, rgba(108, 99, 255, 0.5) 100%);
}

/* =========================
   Animation Direction RTL Fixes
   ========================= */
@keyframes meteor-rtl {
    0% {
        transform: translateX(-300%) translateY(-300%) rotate(135deg);
        opacity: 1;
    }
    70% {
        opacity: 1;
    }
    100% {
        transform: translateX(300%) translateY(300%) rotate(135deg);
        opacity: 0;
    }
}

[dir="rtl"] .shape-meteor {
    animation-name: meteor-rtl;
}

/* Responsive RTL fixes */
@media (max-width: 767px) {
    [dir="rtl"] .step-buttons {
        flex-direction: column-reverse;
    }
    
    [dir="rtl"] .student-info-row {
        flex-direction: column;
    }
}

/* Print RTL fixes */
@media print {
    [dir="rtl"] {
        text-align: right;
    }
    
    [dir="rtl"] .watermark {
        right: auto;
        left: 20px;
        transform: rotate(15deg);
    }
}
/****************************
 * RTL ICONS FIX
 ****************************/
/* معکوس کردن آیکون‌های جهت‌دار در حالت RTL */
[dir="rtl"] .fa-arrow-left:before {
    content: "\f061"; /* کد یونیکد آیکون arrow-right */
}

[dir="rtl"] .fa-arrow-right:before {
    content: "\f060"; /* کد یونیکد آیکون arrow-left */
}

[dir="rtl"] .fa-chevron-left:before {
    content: "\f054"; /* کد یونیکد آیکون chevron-right */
}

[dir="rtl"] .fa-chevron-right:before {
    content: "\f053"; /* کد یونیکد آیکون chevron-left */
}

[dir="rtl"] .fa-long-arrow-alt-left:before {
    content: "\f30b"; /* کد یونیکد آیکون long-arrow-alt-right */
}

[dir="rtl"] .fa-long-arrow-alt-right:before {
    content: "\f30a"; /* کد یونیکد آیکون long-arrow-alt-left */
}

/* روش جایگزین با معکوس کردن آیکون‌ها با CSS transform */
html[dir="rtl"] .btn-next i.fa-arrow-left,
html[dir="rtl"] .btn-prev i.fa-arrow-right,
.rtl .btn-next i.fa-arrow-left,
.rtl .btn-prev i.fa-arrow-right {
    display: inline-block;
    transform: scaleX(-1); /* معکوس کردن افقی آیکون */
}

/* تنظیم حاشیه‌ها در RTL */
html[dir="rtl"] .btn-prev i,
.rtl .btn-prev i {
    margin-right: 0;
    margin-left: 8px;
}

html[dir="rtl"] .btn-next i,
.rtl .btn-next i {
    margin-left: 0;
    margin-right: 8px;
}

/* تنظیم انیمیشن هاور در RTL */
html[dir="rtl"] .btn-prev:hover i,
.rtl .btn-prev:hover i {
    transform: translateX(3px) scaleX(-1);
}

html[dir="rtl"] .btn-next:hover i,
.rtl .btn-next:hover i {
    transform: translateX(-3px) scaleX(-1);
}
/* =========================
   REGISTRATION FORM RTL FIXES
   ========================= */

/* Registration progress */
[dir="rtl"] .progress-line {
    right: 0;
    left: auto;
}

/* Form steps direction management */
[dir="rtl"] .card-title::after {
    right: 0;
    left: auto;
}

/* Navigation buttons */
[dir="rtl"] .btn-prev i {
    margin-right: 0;
    margin-left: 8px;
    transform: scaleX(-1);
}

[dir="rtl"] .btn-prev:hover i {
    transform: translateX(3px) scaleX(-1);
}

[dir="rtl"] .btn-next i {
    margin-left: 0;
    margin-right: 8px;
    transform: scaleX(-1);
}

[dir="rtl"] .btn-next:hover i {
    transform: translateX(-3px) scaleX(-1);
}

[dir="rtl"] .btn-submit i {
    margin-right: 0;
    margin-left: 8px;
}

[dir="rtl"] .step-buttons {
    flex-direction: row-reverse;
}

/* File upload */
[dir="rtl"] .file-preview-remove i {
    margin-right: 0;
    margin-left: 5px;
}

/* Summary sections */
[dir="rtl"] .summary-title {
    padding-left: 0;
    padding-right: 20px;
}

[dir="rtl"] .summary-title::before {
    right: 0;
    left: auto;
}

/* Steps list */
[dir="rtl"] .step-item {
    padding-left: 0;
    padding-right: 30px;
}

[dir="rtl"] .step-item::before {
    right: 0;
    left: auto;
}

/* Contact icon */
[dir="rtl"] .contact-icon {
    margin-right: 0;
    margin-left: 15px;
}

/* Success page headings */
[dir="rtl"] .info-heading::after {
    right: 0;
    left: auto;
}

/* Action buttons */
[dir="rtl"] .btn-action i {
    margin-right: 0;
    margin-left: 8px;
}

/* Print adaptations for RTL */
@media print {
    [dir="rtl"] .certificate-watermark {
        transform: translate(-50%, -50%) rotate(45deg);
    }
}

/* Responsive adaptations */
@media (max-width: 767px) {
    [dir="rtl"] .step-buttons {
        flex-direction: column-reverse;
    }
}
</style>