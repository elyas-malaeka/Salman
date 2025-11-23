/**
 * Staff Page Javascript
 * Filtering, search functionality and animations for staff members
 * 
 * @package Salman Educational Complex
 * @version 1.0
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize staff cards filtering
    initializeStaffFilter();
    
    // Initialize staff search
    initializeStaffSearch();
});

/**
 * Initialize staff category filtering
 */
function initializeStaffFilter() {
    // Get all filter buttons and staff cards
    const filterBtns = document.querySelectorAll('.staff-filter-btn');
    const staffCards = document.querySelectorAll('.staff-card-container');
    
    // Add click event to each filter button
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            filterBtns.forEach(b => b.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            // Get the filter value
            const filter = this.getAttribute('data-filter');
            
            // Show/hide staff cards based on filter
            staffCards.forEach(card => {
                // If "all" is selected or card matches the filter, show it
                if (filter === 'all' || card.getAttribute('data-category') === filter) {
                    card.classList.remove('hidden');
                } else {
                    card.classList.add('hidden');
                }
            });
            
            // Check if no results are found
            checkNoResults();
        });
    });
}

/**
 * Initialize staff search functionality
 */
function initializeStaffSearch() {
    // Get search input, staff cards, and no results message
    const searchInput = document.getElementById('staff-search-input');
    const staffCards = document.querySelectorAll('.staff-card-container');
    const resetBtn = document.getElementById('reset-search');
    
    // Add input event to search input
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        
        // If search term is empty, show all cards
        if (searchTerm === '') {
            staffCards.forEach(card => {
                card.classList.remove('hidden');
            });
            
            // Reset filter buttons
            document.querySelector('.staff-filter-btn[data-filter="all"]').click();
            
            // Hide no results message
            document.getElementById('no-results-message').style.display = 'none';
            return;
        }
        
        // Filter cards based on search term
        staffCards.forEach(card => {
            const name = card.getAttribute('data-name');
            const position = card.getAttribute('data-position');
            
            // If card name or position contains search term, show it
            if (name.includes(searchTerm) || position.includes(searchTerm)) {
                card.classList.remove('hidden');
            } else {
                card.classList.add('hidden');
            }
        });
        
        // Check if no results are found
        checkNoResults();
    });
    
    // Add click event to reset button
    if (resetBtn) {
        resetBtn.addEventListener('click', function() {
            // Clear search input
            searchInput.value = '';
            
            // Show all cards
            staffCards.forEach(card => {
                card.classList.remove('hidden');
            });
            
            // Reset filter buttons
            document.querySelector('.staff-filter-btn[data-filter="all"]').click();
            
            // Hide no results message
            document.getElementById('no-results-message').style.display = 'none';
        });
    }
}

/**
 * Check if no results are found after filtering or searching
 */
function checkNoResults() {
    const staffCards = document.querySelectorAll('.staff-card-container');
    const visibleCards = document.querySelectorAll('.staff-card-container:not(.hidden)');
    const noResultsMessage = document.getElementById('no-results-message');
    
    // If no visible cards, show no results message
    if (visibleCards.length === 0) {
        noResultsMessage.style.display = 'block';
    } else {
        noResultsMessage.style.display = 'none';
    }
}

/**
 * Add hover effects for staff cards
 * (These are now handled by CSS, but we could add more complex effects here)
 */
function addStaffCardEffects() {
    const staffCards = document.querySelectorAll('.staff-card');
    
    staffCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            // Add any JavaScript-specific hover effects here if needed
        });
        
        card.addEventListener('mouseleave', function() {
            // Reset any JavaScript-specific hover effects here if needed
        });
    });
}

/**
 * Creates a simple parallax effect on staff overview icons
 */
function initializeParallaxEffect() {
    const statCards = document.querySelectorAll('.staff-stat-card');
    
    window.addEventListener('mousemove', function(e) {
        const mouseX = e.clientX / window.innerWidth;
        const mouseY = e.clientY / window.innerHeight;
        
        statCards.forEach(card => {
            const icon = card.querySelector('.staff-stat-icon');
            const moveX = (mouseX - 0.5) * 10;
            const moveY = (mouseY - 0.5) * 10;
            
            icon.style.transform = `translate(${moveX}px, ${moveY}px)`;
        });
    });
}

// Initialize parallax effect on larger screens only
if (window.innerWidth > 768) {
    initializeParallaxEffect();
}