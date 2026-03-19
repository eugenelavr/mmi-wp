/**
 * MMI Portal - Main JavaScript
 * 
 * @package MMI_Portal
 * @version 1.0.0
 */

(function() {
    'use strict';
    
    // Mobile menu toggle (if needed)
    const initMobileMenu = () => {
        // Add mobile menu functionality here if needed
    };
    
    // Smooth scroll for anchor links
    const initSmoothScroll = () => {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#') {
                    const target = document.querySelector(href);
                    if (target) {
                        e.preventDefault();
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });
    };
    
    // Initialize when DOM is ready
    document.addEventListener('DOMContentLoaded', () => {
        initMobileMenu();
        initSmoothScroll();
    });
    
})();
