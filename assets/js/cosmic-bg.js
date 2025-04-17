/**
 * Cosmic Background Effect
 * Creates dynamic star animation for header backgrounds
 * 
 * @package Salman Educational Complex
 * @version 1.0
 */

document.addEventListener('DOMContentLoaded', function() {
    // Create cosmic stars dynamically
    createCosmicStars();
    
    // Initialize WOW.js animations if available
    if (typeof WOW !== 'undefined') {
        new WOW().init();
    }
});

/**
 * Creates random stars in the cosmic background
 */
function createCosmicStars() {
    const cosmicBg = document.querySelector('.cosmic-bg');
    if (!cosmicBg) return;
    
    const starsCount = 80; // Higher count for better effect
    
    for (let i = 0; i < starsCount; i++) {
        const star = document.createElement('div');
        star.className = 'cosmic-star';
        
        // Random size between 1-3 pixels
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
    
    // Adding shooting stars
    addShootingStars(cosmicBg);
}

/**
 * Adds shooting stars to the cosmic background
 * 
 * @param {HTMLElement} container - The cosmic background container
 */
function addShootingStars(container) {
    const shootingStarsCount = 5;
    
    for (let i = 0; i < shootingStarsCount; i++) {
        const shootingStar = document.createElement('div');
        shootingStar.className = 'shooting-star';
        
        // Random starting position
        const startLeft = Math.random() * 100;
        const startTop = Math.random() * 100;
        
        // Random ending position (diagonal movement)
        const endLeft = startLeft + (Math.random() * 20 - 10);
        const endTop = startTop + (Math.random() * 20 - 10);
        
        shootingStar.style.cssText = `
            position: absolute;
            left: ${startLeft}%;
            top: ${startTop}%;
            width: 2px;
            height: 2px;
            background-color: white;
            border-radius: 50%;
            opacity: 0;
            box-shadow: 0 0 5px 1px white;
            transform: translate(0, 0);
            z-index: 10;
        `;
        
        // Random animation delay and duration
        const delay = Math.random() * 10 + 5;
        const duration = Math.random() * 3 + 2;
        
        // Apply animation using keyframes
        const shootingStarAnimation = document.createElement('style');
        shootingStarAnimation.innerHTML = `
            @keyframes shootingStar${i} {
                0% {
                    opacity: 0;
                    transform: translate(0, 0) scale(1);
                }
                10% {
                    opacity: 1;
                }
                80% {
                    opacity: 1;
                    transform: translate(${(endLeft - startLeft) * 5}px, ${(endTop - startTop) * 5}px) scale(1.5);
                }
                100% {
                    opacity: 0;
                    transform: translate(${(endLeft - startLeft) * 8}px, ${(endTop - startTop) * 8}px) scale(0.2);
                }
            }
        `;
        document.head.appendChild(shootingStarAnimation);
        
        shootingStar.style.animation = `shootingStar${i} ${duration}s ease-out ${delay}s infinite`;
        container.appendChild(shootingStar);
    }
}

/**
 * Add parallax effect to cosmic background
 */
window.addEventListener('mousemove', function(e) {
    const cosmicBg = document.querySelector('.cosmic-bg');
    if (!cosmicBg) return;
    
    const planets = cosmicBg.querySelectorAll('.cosmic-planet');
    if (planets.length === 0) return;
    
    const mouseX = e.clientX / window.innerWidth;
    const mouseY = e.clientY / window.innerHeight;
    
    planets.forEach((planet, index) => {
        const depth = (index + 1) * 10;
        const moveX = (mouseX - 0.5) * depth;
        const moveY = (mouseY - 0.5) * depth;
        
        planet.style.transform = `translate(${moveX}px, ${moveY}px)`;
    });
});