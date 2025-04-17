/**
 * 404 Error Page JavaScript
 * Handles language switching and content display
 * 
 * @package Salman Educational Complex
 * @version 1.0
 */

document.addEventListener('DOMContentLoaded', function() {
    // Get language buttons and content containers
    const langButtons = document.querySelectorAll('.lang-btn');
    const enContent = document.getElementById('en-content');
    const faContent = document.getElementById('fa-content');
    const footerLogoEn = document.getElementById('footer-logo-en');
    const footerLogoFa = document.getElementById('footer-logo-fa');
    const footerLogoLink = document.getElementById('footer-logo-link');
    
    // Function to get URL parameters
    function getURLParameter(name) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }
    
    // Check for language parameter in URL
    let currentLang = getURLParameter('lang') || 'en';
    
    // Set initial language based on URL parameter or default
    setLanguage(currentLang);
    
    // Add click event listeners to language buttons
    langButtons.forEach(button => {
        button.addEventListener('click', function() {
            const lang = this.getAttribute('data-lang');
            setLanguage(lang);
        });
    });
    
    // Function to set language and update UI
    function setLanguage(lang) {
        currentLang = lang;
        
        // Update HTML dir attribute for RTL support
        document.documentElement.setAttribute('dir', lang === 'fa' ? 'rtl' : 'ltr');
        
        // Update language buttons active state
        langButtons.forEach(button => {
            if (button.getAttribute('data-lang') === lang) {
                button.classList.add('active');
            } else {
                button.classList.remove('active');
            }
        });
        
        // Show/hide content based on language
        if (lang === 'fa') {
            enContent.style.display = 'none';
            faContent.style.display = 'block';
            footerLogoEn.style.display = 'none';
            footerLogoFa.style.display = 'inline-block';
            footerLogoLink.href = 'index.php?lang=fa';
        } else {
            enContent.style.display = 'block';
            faContent.style.display = 'none';
            footerLogoEn.style.display = 'inline-block';
            footerLogoFa.style.display = 'none';
            footerLogoLink.href = 'index.php?lang=en';
        }
        
        // Update URL with new language parameter (without page reload)
        const url = new URL(window.location);
        url.searchParams.set('lang', lang);
        window.history.pushState({}, '', url);
        
        // Add animation class to content for smooth transition
        document.querySelector('.error-404-svg').classList.add('animate__animated', 'animate__pulse');
        setTimeout(() => {
            document.querySelector('.error-404-svg').classList.remove('animate__animated', 'animate__pulse');
        }, 1000);
    }
    
    // Add animation to the 404 image
    const errorImage = document.querySelector('.error-svg-image');
    if (errorImage) {
        // Init animation on page load
        setTimeout(() => {
            errorImage.style.opacity = 1;
            errorImage.style.transform = 'translateY(0)';
        }, 200);
    }
    
    // Set up cosmic background particles
    setupCosmicBackground();
});

// Function to create cosmic background (optional fancy effect)
function setupCosmicBackground() {
    const container = document.querySelector('.page-wrapper');
    
    // Create stars
    for (let i = 0; i < 50; i++) {
        const star = document.createElement('div');
        star.className = 'cosmic-star';
        star.style.left = `${Math.random() * 100}%`;
        star.style.top = `${Math.random() * 100}%`;
        star.style.animationDelay = `${Math.random() * 5}s`;
        star.style.width = `${Math.random() * 3 + 1}px`;
        star.style.height = star.style.width;
        container.appendChild(star);
    }
    
    // Append style for cosmic stars
    const style = document.createElement('style');
    style.textContent = `
        .cosmic-star {
            position: absolute;
            background-color: #fff;
            border-radius: 50%;
            opacity: 0.6;
            animation: twinkle 5s infinite ease-in-out;
            pointer-events: none;
            z-index: -1;
        }
        
        @keyframes twinkle {
            0%, 100% { opacity: 0.2; }
            50% { opacity: 0.8; }
        }
    `;
    document.head.appendChild(style);
}