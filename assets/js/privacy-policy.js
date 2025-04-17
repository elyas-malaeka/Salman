/**
 * Privacy Policy Javascript
 * Functionality for the privacy policy page including scrolling, printing, and toc navigation
 * 
 * @package Salman Educational Complex
 * @version 1.0
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize table of contents navigation
    initializeTocNavigation();
    
    // Initialize back to top button
    initializeBackToTop();
    
    // Initialize print functionality
    initializePrintButton();
    
    // Scroll active TOC into view on page load
    scrollActiveTocIntoView();
});

/**
 * Initialize the table of contents navigation
 */
function initializeTocNavigation() {
    const tocLinks = document.querySelectorAll('.privacy-toc__link');
    const sections = document.querySelectorAll('.privacy-block');
    
    // Add click event to TOC links
    tocLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Get the target section
            const targetId = this.getAttribute('href').substring(1);
            const targetSection = document.getElementById(targetId);
            
            if (targetSection) {
                // Scroll to the section with smooth behavior
                targetSection.scrollIntoView({
                    behavior: 'smooth'
                });
                
                // Update active state
                tocLinks.forEach(link => link.classList.remove('active'));
                this.classList.add('active');
            }
        });
    });
    
    // Update active state on scroll
    window.addEventListener('scroll', function() {
        // Determine which section is currently in view
        let currentSection = '';
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            
            if (window.scrollY >= sectionTop - 150 && 
                window.scrollY < sectionTop + sectionHeight - 150) {
                currentSection = section.getAttribute('id');
            }
        });
        
        // Update TOC active state
        if (currentSection) {
            tocLinks.forEach(link => {
                link.classList.remove('active');
                
                const linkHref = link.getAttribute('href').substring(1);
                if (linkHref === currentSection) {
                    link.classList.add('active');
                }
            });
        }
    });
}

/**
 * Initialize back to top button
 */
function initializeBackToTop() {
    const backToTopBtn = document.getElementById('backToTop');
    
    if (!backToTopBtn) return;
    
    // Show/hide button based on scroll position
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            backToTopBtn.classList.add('visible');
        } else {
            backToTopBtn.classList.remove('visible');
        }
    });
    
    // Scroll to top when button is clicked
    backToTopBtn.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Scroll to top with smooth behavior
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

/**
 * Initialize print button
 */
function initializePrintButton() {
    const printBtn = document.getElementById('printPrivacy');
    
    if (!printBtn) return;
    
    printBtn.addEventListener('click', function() {
        window.print();
    });
}

/**
 * Scroll the active TOC item into view on page load
 */
function scrollActiveTocIntoView() {
    const activeTocItem = document.querySelector('.privacy-toc__link.active');
    const tocList = document.querySelector('.privacy-toc__list');
    
    if (activeTocItem && tocList) {
        // Scroll the active item into view
        setTimeout(() => {
            activeTocItem.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }, 500);
    }
}

/**
 * Smooth scroll to anchors when page loads with hash
 */
function smoothScrollToAnchor() {
    // Check if URL has a hash
    if (window.location.hash) {
        const targetId = window.location.hash.substring(1);
        const targetElement = document.getElementById(targetId);
        
        if (targetElement) {
            // Delay to ensure page is fully loaded
            setTimeout(() => {
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
                
                // Update TOC active state
                const tocLinks = document.querySelectorAll('.privacy-toc__link');
                tocLinks.forEach(link => {
                    link.classList.remove('active');
                    
                    const linkHref = link.getAttribute('href').substring(1);
                    if (linkHref === targetId) {
                        link.classList.add('active');
                    }
                });
            }, 300);
        }
    }
}

// Call smooth scroll on load
window.addEventListener('load', smoothScrollToAnchor);

/**
 * Add print-specific styles when printing
 */
window.addEventListener('beforeprint', function() {
    // Hide elements not needed in print
    const elementsToHide = [
        '.privacy-toc', 
        '.back-to-top',
        '.privacy-actions'
    ];
    
    // Create a style element for print styles
    const printStyles = document.createElement('style');
    printStyles.id = 'print-styles';
    
    // Add print-specific styles
    printStyles.innerHTML = `
        @media print {
            ${elementsToHide.join(', ')} {
                display: none !important;
            }
            
            .privacy-policy-content {
                box-shadow: none !important;
                padding: 0 !important;
            }
            
            .privacy-block {
                page-break-inside: avoid;
                margin-bottom: 30px !important;
            }
            
            .col-lg-9 {
                width: 100% !important;
                max-width: 100% !important;
                flex: 0 0 100% !important;
            }
            
            body {
                padding: 0 !important;
                margin: 0 !important;
            }
            
            .container {
                max-width: 100% !important;
                width: 100% !important;
                padding: 0 !important;
            }
            
            .privacy-policy-section {
                padding: 0 !important;
            }
        }
    `;
    
    // Add the print styles to the head
    document.head.appendChild(printStyles);
});

// Remove print styles after printing
window.addEventListener('afterprint', function() {
    const printStyles = document.getElementById('print-styles');
    if (printStyles) {
        printStyles.remove();
    }
});