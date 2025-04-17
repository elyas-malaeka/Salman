/**
 * Blog Page Functionality
 * 
 * JavaScript for the Salman Educational Complex Blog Page
 * Handles animations, interactions, and responsive behavior
 * 
 * @version 2.0
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
    if (typeof WOW !== 'undefined') {
        new WOW().init();
    }
    
    // Add hover effects for blog cards
    const blogCards = document.querySelectorAll('.blog-card');
    blogCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px)';
            this.style.boxShadow = '0 15px 40px rgba(0, 0, 0, 0.12)';
            const img = this.querySelector('.blog-card__image img');
            if (img) img.style.transform = 'scale(1.05)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '';
            const img = this.querySelector('.blog-card__image img');
            if (img) img.style.transform = '';
        });
    });
    
    // Add hover effects for featured post
    const featuredPost = document.querySelector('.featured-post');
    if (featuredPost) {
        featuredPost.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px)';
            this.style.boxShadow = '0 15px 40px rgba(0, 0, 0, 0.12)';
            const img = this.querySelector('.featured-post__image img');
            if (img) img.style.transform = 'scale(1.05)';
        });
        
        featuredPost.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '';
            const img = this.querySelector('.featured-post__image img');
            if (img) img.style.transform = '';
        });
    }
    
    // Enhance sidebar post hover animations
    const sidebarPosts = document.querySelectorAll('.blog-sidebar__post-item');
    sidebarPosts.forEach(post => {
        post.addEventListener('mouseenter', function() {
            const img = this.querySelector('.blog-sidebar__post-image img');
            if (img) img.style.transform = 'scale(1.05)';
        });
        
        post.addEventListener('mouseleave', function() {
            const img = this.querySelector('.blog-sidebar__post-image img');
            if (img) img.style.transform = '';
        });
    });
    
    // Enhance sidebar category hover animations
    const categoryLinks = document.querySelectorAll('.blog-sidebar__category');
    categoryLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            if (!this.classList.contains('active')) {
                this.style.backgroundColor = 'rgba(67, 97, 238, 0.2)';
            }
        });
        
        link.addEventListener('mouseleave', function() {
            if (!this.classList.contains('active')) {
                this.style.backgroundColor = 'rgba(67, 97, 238, 0.1)';
            }
        });
    });
    
    // Pagination hover effects
    const paginationItems = document.querySelectorAll('.blog-pagination__page, .blog-pagination__arrow');
    paginationItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            if (!this.classList.contains('active')) {
                this.style.backgroundColor = 'rgba(67, 97, 238, 0.1)';
                this.style.transform = 'translateY(-3px)';
                this.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.08)';
            }
        });
        
        item.addEventListener('mouseleave', function() {
            if (!this.classList.contains('active')) {
                this.style.backgroundColor = '';
                this.style.transform = '';
                this.style.boxShadow = '';
            }
        });
    });
    
    // Make sidebar sticky on scroll for desktop
    function updateSidebarPosition() {
        const sidebar = document.querySelector('.blog-sidebar');
        if (sidebar && window.innerWidth >= 992) {
            const windowHeight = window.innerHeight;
            const sidebarHeight = sidebar.offsetHeight;
            
            // Only make sticky if sidebar is shorter than viewport
            if (sidebarHeight < windowHeight - 100) {
                sidebar.style.position = 'sticky';
                sidebar.style.top = '30px';
            } else {
                sidebar.style.position = 'static';
            }
        } else if (sidebar) {
            sidebar.style.position = 'static';
        }
    }
    
    // Update sidebar position on load and resize
    window.addEventListener('load', updateSidebarPosition);
    window.addEventListener('resize', updateSidebarPosition);
});