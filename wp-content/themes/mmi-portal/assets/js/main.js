/**
 * MMI Portal — Main JavaScript
 * Vanilla JS only. No jQuery.
 *
 * Modules:
 *  1. Sticky header (shrink on scroll)
 *  2. Mobile hamburger menu
 *  3. Search toggle
 *  4. News tab filtering
 *  5. Dropdown keyboard accessibility
 *  6. Smooth scroll
 *
 * @package MMI_Portal
 * @version 2.0.0
 */

(function () {
    'use strict';

    // =========================================================================
    // 1. Sticky Header — adds .is-scrolled class when user scrolls
    // =========================================================================

    const initStickyHeader = () => {
        const header = document.getElementById('site-header');
        if (!header) return;

        let lastScrollY = window.scrollY;

        const onScroll = () => {
            if (window.scrollY > 30) {
                header.classList.add('is-scrolled');
            } else {
                header.classList.remove('is-scrolled');
            }
            lastScrollY = window.scrollY;
        };

        // Throttle via requestAnimationFrame
        let ticking = false;
        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    onScroll();
                    ticking = false;
                });
                ticking = true;
            }
        }, { passive: true });

        // Run once on init
        onScroll();
    };

    // =========================================================================
    // 2. Mobile Menu (hamburger + slide-out nav + overlay)
    // =========================================================================

    const initMobileMenu = () => {
        const hamburger      = document.getElementById('hamburger');
        const mobileNav      = document.getElementById('mobile-nav');
        const mobileOverlay  = document.getElementById('mobile-nav-overlay');
        const closeBtn       = document.getElementById('mobile-nav-close');

        if (!hamburger || !mobileNav) return;

        const openMenu = () => {
            hamburger.classList.add('is-active');
            hamburger.setAttribute('aria-expanded', 'true');
            mobileNav.classList.add('is-open');
            mobileNav.setAttribute('aria-hidden', 'false');
            if (mobileOverlay) {
                mobileOverlay.classList.add('is-visible');
            }
            document.body.style.overflow = 'hidden';
            // Focus the close button for accessibility
            if (closeBtn) closeBtn.focus();
        };

        const closeMenu = () => {
            hamburger.classList.remove('is-active');
            hamburger.setAttribute('aria-expanded', 'false');
            mobileNav.classList.remove('is-open');
            mobileNav.setAttribute('aria-hidden', 'true');
            if (mobileOverlay) {
                mobileOverlay.classList.remove('is-visible');
            }
            document.body.style.overflow = '';
            hamburger.focus();
        };

        hamburger.addEventListener('click', () => {
            const isOpen = mobileNav.classList.contains('is-open');
            isOpen ? closeMenu() : openMenu();
        });

        if (closeBtn) {
            closeBtn.addEventListener('click', closeMenu);
        }

        if (mobileOverlay) {
            mobileOverlay.addEventListener('click', closeMenu);
        }

        // Close on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && mobileNav.classList.contains('is-open')) {
                closeMenu();
            }
        });

        // Expand/collapse sub-menus in mobile nav
        const mobileMenuItems = mobileNav.querySelectorAll('.mobile-menu .menu-item-has-children > a');
        mobileMenuItems.forEach((link) => {
            const subMenu = link.nextElementSibling;
            if (!subMenu || !subMenu.classList.contains('sub-menu')) return;

            // Initially collapse sub-menus
            subMenu.style.display = 'none';

            link.addEventListener('click', (e) => {
                e.preventDefault();
                const isVisible = subMenu.style.display !== 'none';
                subMenu.style.display = isVisible ? 'none' : 'block';
                link.setAttribute('aria-expanded', String(!isVisible));
            });
        });
    };

    // =========================================================================
    // 3. Search Toggle
    // =========================================================================

    const initSearchToggle = () => {
        const toggleBtn  = document.getElementById('search-toggle');
        const searchBar  = document.getElementById('search-bar');
        const searchInput = document.getElementById('search-bar-input');

        if (!toggleBtn || !searchBar) return;

        const openSearch = () => {
            searchBar.removeAttribute('hidden');
            toggleBtn.setAttribute('aria-expanded', 'true');
            if (searchInput) {
                searchInput.focus();
            }
        };

        const closeSearch = () => {
            searchBar.setAttribute('hidden', '');
            toggleBtn.setAttribute('aria-expanded', 'false');
        };

        toggleBtn.addEventListener('click', () => {
            const isOpen = !searchBar.hasAttribute('hidden');
            isOpen ? closeSearch() : openSearch();
        });

        // Close on Escape key
        searchBar.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeSearch();
            }
        });

        // Close when clicking outside
        document.addEventListener('click', (e) => {
            if (
                !searchBar.hasAttribute('hidden') &&
                !searchBar.contains(e.target) &&
                !toggleBtn.contains(e.target)
            ) {
                closeSearch();
            }
        });
    };

    // =========================================================================
    // 4. News Tab Filtering
    // =========================================================================

    const initNewsTabs = () => {
        const tabs    = document.querySelectorAll('.news-tab');
        const grid    = document.getElementById('news-grid');

        if (!tabs.length || !grid) return;

        // Gather all cards once (from both featured and secondary containers)
        const allCards = grid.querySelectorAll('.news-card');

        const filterCards = (category) => {
            // Rearrange visibility based on category
            allCards.forEach((card) => {
                if (category === 'all') {
                    card.classList.remove('is-hidden');
                    return;
                }

                const cardCats = (card.dataset.categories || '').split(',').map(s => s.trim());
                if (cardCats.includes(category)) {
                    card.classList.remove('is-hidden');
                } else {
                    card.classList.add('is-hidden');
                }
            });

            // If featured card gets hidden, show it anyway (first visible card becomes featured)
            const featuredWrap = grid.querySelector('.news-grid__featured');
            if (featuredWrap) {
                const featuredCard = featuredWrap.querySelector('.news-card');
                if (featuredCard && featuredCard.classList.contains('is-hidden')) {
                    featuredCard.classList.remove('is-hidden');
                }
            }
        };

        tabs.forEach((tab) => {
            tab.addEventListener('click', () => {
                // Update active state
                tabs.forEach(t => {
                    t.classList.remove('is-active');
                    t.setAttribute('aria-selected', 'false');
                });
                tab.classList.add('is-active');
                tab.setAttribute('aria-selected', 'true');

                filterCards(tab.dataset.category || 'all');
            });

            // Keyboard accessibility: arrow keys to navigate between tabs
            tab.addEventListener('keydown', (e) => {
                const tabArray = Array.from(tabs);
                const idx      = tabArray.indexOf(tab);

                if (e.key === 'ArrowRight' || e.key === 'ArrowDown') {
                    e.preventDefault();
                    const next = tabArray[idx + 1] || tabArray[0];
                    next.focus();
                    next.click();
                } else if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
                    e.preventDefault();
                    const prev = tabArray[idx - 1] || tabArray[tabArray.length - 1];
                    prev.focus();
                    prev.click();
                }
            });
        });
    };

    // =========================================================================
    // 5. Dropdown Keyboard Accessibility (desktop nav)
    // =========================================================================

    const initDropdowns = () => {
        const menuItems = document.querySelectorAll('.primary-menu > li.menu-item-has-children');

        menuItems.forEach((item) => {
            const link    = item.querySelector(':scope > a');
            const submenu = item.querySelector('.sub-menu');
            if (!link || !submenu) return;

            // Open on Enter/Space when focused
            link.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    const isOpen = item.classList.contains('dropdown-open');
                    if (isOpen) {
                        closeDropdown(item);
                    } else {
                        openDropdown(item);
                    }
                }
                if (e.key === 'Escape') {
                    closeDropdown(item);
                    link.focus();
                }
            });

            // Close all other dropdowns when a new one opens
            item.addEventListener('mouseenter', () => {
                menuItems.forEach(other => {
                    if (other !== item) closeDropdown(other);
                });
            });

            // Close on Escape from submenu items
            const subLinks = submenu.querySelectorAll('a');
            subLinks.forEach((sl, idx) => {
                sl.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') {
                        closeDropdown(item);
                        link.focus();
                    }
                    if (e.key === 'ArrowDown') {
                        e.preventDefault();
                        const next = subLinks[idx + 1];
                        if (next) next.focus();
                    }
                    if (e.key === 'ArrowUp') {
                        e.preventDefault();
                        if (idx === 0) {
                            link.focus();
                        } else {
                            const prev = subLinks[idx - 1];
                            if (prev) prev.focus();
                        }
                    }
                });
            });
        });

        // Close all dropdowns when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.primary-menu')) {
                menuItems.forEach(item => closeDropdown(item));
            }
        });

        const openDropdown = (item) => {
            item.classList.add('dropdown-open');
            const link = item.querySelector(':scope > a');
            if (link) link.setAttribute('aria-expanded', 'true');
        };

        const closeDropdown = (item) => {
            item.classList.remove('dropdown-open');
            const link = item.querySelector(':scope > a');
            if (link) link.setAttribute('aria-expanded', 'false');
        };
    };

    // =========================================================================
    // 6. Smooth Scroll for in-page anchor links
    // =========================================================================

    const initSmoothScroll = () => {
        document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
            anchor.addEventListener('click', (e) => {
                const href = anchor.getAttribute('href');
                if (!href || href === '#') return;

                const target = document.querySelector(href);
                if (!target) return;

                e.preventDefault();

                const headerHeight = document.getElementById('site-header')?.offsetHeight ?? 0;
                const targetTop    = target.getBoundingClientRect().top + window.scrollY - headerHeight - 16;

                window.scrollTo({ top: targetTop, behavior: 'smooth' });
                target.setAttribute('tabindex', '-1');
                target.focus({ preventScroll: true });
            });
        });
    };

    // =========================================================================
    // Init
    // =========================================================================

    document.addEventListener('DOMContentLoaded', () => {
        initStickyHeader();
        initMobileMenu();
        initSearchToggle();
        initNewsTabs();
        initDropdowns();
        initSmoothScroll();
    });

})();
