<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">

<header class="site-header" id="site-header" role="banner">

    <!-- Top bar: KPI affiliation + resources + language -->
    <div class="site-header__topbar">
        <div class="container">
            <a href="https://kpi.ua" class="site-header__kpi-link" target="_blank" rel="noopener noreferrer">
                <?php esc_html_e('КПІ ім. Ігоря Сікорського', 'mmi-portal'); ?>
            </a>
            <div class="site-header__topbar-right">
                <?php if (has_nav_menu('header-resources')): ?>
                    <?php wp_nav_menu([
                        'theme_location' => 'header-resources',
                        'menu_class'     => 'topbar-menu',
                        'container'      => false,
                        'depth'          => 1,
                        'fallback_cb'    => false,
                    ]); ?>
                <?php endif; ?>

                <?php if (function_exists('pll_the_languages')): ?>
                    <div class="lang-switcher lang-switcher--topbar">
                        <?php pll_the_languages([
                            'show_names'       => 1,
                            'display_names_as' => 'slug',
                            'hide_if_empty'    => 0,
                        ]); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Main navigation bar -->
    <div class="site-header__main">
        <div class="container">

            <!-- Logo / department name -->
            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-header__logo" rel="home">
                <span class="site-header__logo-abbr">ММІ</span>
                <span class="site-header__logo-full">
                    <?php esc_html_e('Механіко-машинобудівний інститут', 'mmi-portal'); ?>
                </span>
            </a>

            <!-- Primary navigation -->
            <nav class="site-header__nav"
                 id="site-nav"
                 role="navigation"
                 aria-label="<?php esc_attr_e('Головна навігація', 'mmi-portal'); ?>">
                <?php wp_nav_menu([
                    'theme_location' => 'primary',
                    'menu_class'     => 'primary-menu',
                    'container'      => false,
                    'depth'          => 2,
                    'fallback_cb'    => false,
                    'walker'         => class_exists('MMI_Walker_Nav_Menu') ? new MMI_Walker_Nav_Menu() : null,
                ]); ?>
            </nav>

            <!-- Actions: search toggle + hamburger -->
            <div class="site-header__actions">
                <button class="search-toggle"
                        id="search-toggle"
                        aria-label="<?php esc_attr_e('Відкрити пошук', 'mmi-portal'); ?>"
                        aria-expanded="false"
                        aria-controls="search-bar">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <circle cx="11" cy="11" r="8"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                </button>

                <button class="hamburger"
                        id="hamburger"
                        aria-label="<?php esc_attr_e('Відкрити меню', 'mmi-portal'); ?>"
                        aria-expanded="false"
                        aria-controls="site-nav">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </button>
            </div>

        </div><!-- .container -->

        <!-- Expandable search bar -->
        <div class="search-bar" id="search-bar" hidden>
            <div class="container">
                <form role="search"
                      method="get"
                      action="<?php echo esc_url(home_url('/')); ?>"
                      class="search-bar__form">
                    <label class="screen-reader-text" for="search-bar-input">
                        <?php esc_html_e('Пошук', 'mmi-portal'); ?>
                    </label>
                    <input type="search"
                           id="search-bar-input"
                           class="search-bar__input"
                           placeholder="<?php esc_attr_e('Пошук по сайту...', 'mmi-portal'); ?>"
                           value="<?php echo get_search_query(); ?>"
                           name="s"
                           autocomplete="off">
                    <button type="submit"
                            class="search-bar__submit"
                            aria-label="<?php esc_attr_e('Шукати', 'mmi-portal'); ?>">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <circle cx="11" cy="11" r="8"/>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>

    </div><!-- .site-header__main -->

    <!-- Mobile slide-out nav overlay -->
    <div class="mobile-nav-overlay" id="mobile-nav-overlay" aria-hidden="true"></div>
    <nav class="mobile-nav"
         id="mobile-nav"
         aria-label="<?php esc_attr_e('Мобільна навігація', 'mmi-portal'); ?>"
         aria-hidden="true">
        <button class="mobile-nav__close"
                id="mobile-nav-close"
                aria-label="<?php esc_attr_e('Закрити меню', 'mmi-portal'); ?>">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <line x1="18" y1="6" x2="6" y2="18"/>
                <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>
        <?php wp_nav_menu([
            'theme_location' => 'primary',
            'menu_class'     => 'mobile-menu',
            'container'      => false,
            'depth'          => 2,
            'fallback_cb'    => false,
        ]); ?>
        <?php if (function_exists('pll_the_languages')): ?>
            <div class="lang-switcher lang-switcher--mobile">
                <?php pll_the_languages([
                    'show_names'       => 1,
                    'display_names_as' => 'name',
                    'hide_if_empty'    => 0,
                ]); ?>
            </div>
        <?php endif; ?>
    </nav>

</header><!-- .site-header -->

<div id="content" class="site-content">
