/**
 * FAQ Page Functionality
 * 
 * Handles tabs, accordion, search functionality and cosmic animations
 * for the Salman Educational Complex FAQ page
 * 
 * @version 4.0
 */

document.addEventListener('DOMContentLoaded', function() {
    // Fix preloader issue - make sure it's removed after page load
    window.addEventListener('load', function() {
        setTimeout(function() {
            const preloader = document.querySelector('.preloader');
            if (preloader) {
                preloader.style.display = 'none';
            }
        }, 500);
    });
    
    // Initialize WOW.js animations
    new WOW().init();
    
    // Add cosmic stars dynamically
    createCosmicStars();
    
    // Elements
    const categoryTabs = document.querySelectorAll('.faq-nav__item');
    const categories = document.querySelectorAll('.faq-category');
    const faqItems = document.querySelectorAll('.faq-item');
    const searchInput = document.getElementById('faqSearch');
    const noResultsElement = document.getElementById('noResults');
    
    // Category Tab Switching
    categoryTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Reset search
            if (searchInput.value) {
                searchInput.value = '';
                resetSearchView();
            }
            
            // Update active tab
            categoryTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            // Show selected category
            const categoryId = this.getAttribute('data-category');
            categories.forEach(category => {
                category.classList.remove('active');
                if (category.id === categoryId) {
                    category.classList.add('active');
                }
            });
        });
    });
    
    // Accordion Functionality
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        
        question.addEventListener('click', function() {
            // Toggle the active class
            const isActive = item.classList.contains('active');
            
            // If we're not in search mode, close other items in the same category
            if (!searchInput.value) {
                const category = item.closest('.faq-category');
                category.querySelectorAll('.faq-item').forEach(faqItem => {
                    if (faqItem !== item) {
                        faqItem.classList.remove('active');
                    }
                });
            }
            
            // Toggle current item
            item.classList.toggle('active');
        });
    });
    
    // Search Functionality
    searchInput.addEventListener('input', debounce(function() {
        const searchTerm = this.value.trim().toLowerCase();
        
        if (searchTerm.length >= 2) {
            performSearch(searchTerm);
        } else {
            resetSearchView();
        }
    }, 300));
    
    // Function to perform search
    function performSearch(searchTerm) {
        // Show all categories for search
        categories.forEach(category => {
            category.style.display = 'block';
            // Hide category headers during search
            category.querySelector('.faq-category__header').style.display = 'none';
        });
        
        // Hide category tabs during search
        document.querySelector('.faq-nav').style.display = 'none';
        
        let matchFound = false;
        const allItems = document.querySelectorAll('.faq-item');
        
        // Search through all items
        allItems.forEach(item => {
            const question = item.querySelector('.faq-question').textContent.toLowerCase();
            const answer = item.querySelector('.faq-answer').textContent.toLowerCase();
            
            if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                item.style.display = 'block';
                item.classList.add('active'); // Expand matching items
                matchFound = true;
            } else {
                item.style.display = 'none';
            }
        });
        
        // Show/hide no results message
        if (!matchFound) {
            noResultsElement.style.display = 'block';
            categories.forEach(category => {
                category.style.display = 'none';
            });
        } else {
            noResultsElement.style.display = 'none';
        }
    }
    
    // Reset view after search
    function resetSearchView() {
        // Hide no results
        noResultsElement.style.display = 'none';
        
        // Show category tabs
        document.querySelector('.faq-nav').style.display = 'flex';
        
        // Reset categories and show headers
        categories.forEach(category => {
            category.querySelector('.faq-category__header').style.display = 'flex';
            
            if (category.classList.contains('active')) {
                category.style.display = 'block';
            } else {
                category.style.display = 'none';
            }
        });
        
        // Reset item visibility
        faqItems.forEach(item => {
            item.style.display = 'block';
        });
    }
    
    // Function to create cosmic stars
    function createCosmicStars() {
        const cosmicBg = document.querySelector('.cosmic-bg');
        if (!cosmicBg) return;
        
        const starsCount = 40; // Increased star count
        
        for (let i = 0; i < starsCount; i++) {
            const star = document.createElement('div');
            star.className = 'cosmic-star';
            
            // Random size between 1-3px
            const size = Math.random() * 2 + 1;
            star.style.width = `${size}px`;
            star.style.height = `${size}px`;
            
            // Random position
            star.style.left = `${Math.random() * 100}%`;
            star.style.top = `${Math.random() * 100}%`;
            
            // Random animation duration
            star.style.animationDuration = `${Math.random() * 2 + 1}s`;
            
            // Random animation delay
            star.style.animationDelay = `${Math.random() * 2}s`;
            
            cosmicBg.appendChild(star);
        }
    }
    
    // Debounce function for search input
    function debounce(func, wait) {
        let timeout;
        return function() {
            const context = this, args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                func.apply(context, args);
            }, wait);
        };
    }
});