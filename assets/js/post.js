/**
 * Post Page Script
 * 
 * JavaScript functionalities for single post page
 * Including gallery popup, sticky sidebar, and interactive elements
 * 
 * @version 3.0
 */

document.addEventListener('DOMContentLoaded', function() {
    // Fix preloader issue
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
    
    // Initialize Magnific Popup for image gallery
    if (jQuery.fn.magnificPopup) {
        $('.post-content__gallery-link').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1]
            },
            image: {
                titleSrc: function(item) {
                    return item.el.attr('title');
                }
            },
            zoom: {
                enabled: true,
                duration: 300,
                easing: 'ease-in-out'
            }
        });
    }
    
    // Smooth scroll for anchor links
    $('a[href^="#"]').on('click', function(e) {
        const target = $(this.getAttribute('href'));
        if (target.length) {
            e.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 100
            }, 800);
        }
    });
    
    // Make sidebar sticky on desktop
    function updateSidebarPosition() {
        const sidebar = document.querySelector('.post-sidebar');
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
    
    // Add hover effects to related posts
    const relatedPosts = document.querySelectorAll('.post-related__item');
    relatedPosts.forEach(post => {
        post.addEventListener('mouseenter', function() {
            const img = this.querySelector('.post-related__image img');
            if (img) img.style.transform = 'scale(1.05)';
        });
        
        post.addEventListener('mouseleave', function() {
            const img = this.querySelector('.post-related__image img');
            if (img) img.style.transform = '';
        });
    });
    
    // Add hover effects to latest posts in sidebar
    const latestPosts = document.querySelectorAll('.post-sidebar__latest-item');
    latestPosts.forEach(post => {
        post.addEventListener('mouseenter', function() {
            const img = this.querySelector('.post-sidebar__latest-image img');
            if (img) img.style.transform = 'scale(1.05)';
        });
        
        post.addEventListener('mouseleave', function() {
            const img = this.querySelector('.post-sidebar__latest-image img');
            if (img) img.style.transform = '';
        });
    });
    
    // Calculate reading progress
    const progressBar = document.createElement('div');
    progressBar.className = 'reading-progress';
    progressBar.style.position = 'fixed';
    progressBar.style.top = '0';
    progressBar.style.left = '0';
    progressBar.style.height = '4px';
    progressBar.style.backgroundColor = '#4361ee';
    progressBar.style.width = '0%';
    progressBar.style.zIndex = '9999';
    progressBar.style.transition = 'width 0.1s ease';
    document.body.appendChild(progressBar);
    
    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const contentHeight = document.querySelector('.post-content').offsetHeight;
        const windowHeight = window.innerHeight;
        const scrollHeight = Math.max(
            document.body.scrollHeight,
            document.body.offsetHeight,
            document.documentElement.clientHeight,
            document.documentElement.scrollHeight,
            document.documentElement.offsetHeight
        ) - windowHeight;
        
        const progress = scrollTop / scrollHeight * 100;
        progressBar.style.width = progress + '%';
    });
});