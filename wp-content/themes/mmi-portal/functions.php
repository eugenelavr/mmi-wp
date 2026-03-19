<?php
/**
 * MMI Portal Child Theme Functions
 * 
 * @package MMI_Portal
 * @since 1.0.0
 */

defined('ABSPATH') || exit;

/**
 * Enqueue parent and child theme styles
 */
function mmi_portal_enqueue_styles(): void {
    // Enqueue parent theme styles
    wp_enqueue_style(
        'generatepress-parent',
        get_template_directory_uri() . '/style.css',
        [],
        wp_get_theme()->parent()->get('Version')
    );
    
    // Enqueue child theme styles
    wp_enqueue_style(
        'mmi-portal-style',
        get_stylesheet_directory_uri() . '/assets/css/main.css',
        ['generatepress-parent'],
        wp_get_theme()->get('Version')
    );
    
    // Enqueue child theme scripts
    wp_enqueue_script(
        'mmi-portal-script',
        get_stylesheet_directory_uri() . '/assets/js/main.js',
        [],
        wp_get_theme()->get('Version'),
        true
    );
}
add_action('wp_enqueue_scripts', 'mmi_portal_enqueue_styles');

/**
 * Add theme support features
 */
function mmi_portal_setup(): void {
    // Add support for document title tag
    add_theme_support('title-tag');
    
    // Add support for post thumbnails
    add_theme_support('post-thumbnails');
    
    // Add custom image sizes
    add_image_size('lecturer-thumbnail', 300, 300, true);
    add_image_size('course-thumbnail', 400, 250, true);
    
    // Register navigation menus
    register_nav_menus([
        'primary' => __('Головне меню', 'mmi-portal'),
        'footer' => __('Меню підвалу', 'mmi-portal'),
    ]);
}
add_action('after_setup_theme', 'mmi_portal_setup');

/**
 * Register widget areas
 */
function mmi_portal_widgets_init(): void {
    register_sidebar([
        'name'          => __('Бічна панель', 'mmi-portal'),
        'id'            => 'sidebar-1',
        'description'   => __('Основна бічна панель', 'mmi-portal'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget__title">',
        'after_title'   => '</h3>',
    ]);
    
    register_sidebar([
        'name'          => __('Підвал 1', 'mmi-portal'),
        'id'            => 'footer-1',
        'description'   => __('Перша колонка підвалу', 'mmi-portal'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget__title">',
        'after_title'   => '</h4>',
    ]);
    
    register_sidebar([
        'name'          => __('Підвал 2', 'mmi-portal'),
        'id'            => 'footer-2',
        'description'   => __('Друга колонка підвалу', 'mmi-portal'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget__title">',
        'after_title'   => '</h4>',
    ]);
}
add_action('widgets_init', 'mmi_portal_widgets_init');

/**
 * Customize excerpt length
 */
function mmi_portal_excerpt_length(int $length): int {
    return 30;
}
add_filter('excerpt_length', 'mmi_portal_excerpt_length');

/**
 * Customize excerpt more string
 */
function mmi_portal_excerpt_more(string $more): string {
    return '...';
}
add_filter('excerpt_more', 'mmi_portal_excerpt_more');

/**
 * Add KPI branding to footer
 */
function mmi_portal_footer_credits(): void {
    ?>
    <div class="site-footer__credits">
        <p>
            <?php
            printf(
                /* translators: %s: Current year */
                esc_html__('© %s Кафедра математичних методів інформаційних технологій', 'mmi-portal'),
                date_i18n('Y')
            );
            ?>
        </p>
        <p>
            <a href="https://kpi.ua" target="_blank" rel="noopener">
                <?php esc_html_e('КПІ ім. Ігоря Сікорського', 'mmi-portal'); ?>
            </a>
        </p>
    </div>
    <?php
}
add_action('generate_after_footer_content', 'mmi_portal_footer_credits');

/**
 * Helper function to get lecturer courses
 */
function mmi_get_lecturer_courses(int $lecturer_id): array {
    $courses = get_field('lecturer_courses', $lecturer_id);
    return is_array($courses) ? $courses : [];
}

/**
 * Helper function to get lecturer publications
 */
function mmi_get_lecturer_publications(int $lecturer_id): array {
    $publications = get_field('lecturer_publications', $lecturer_id);
    return is_array($publications) ? $publications : [];
}

/**
 * Helper function to get course lecturer
 */
function mmi_get_course_lecturer(int $course_id): ?WP_Post {
    $lecturer = get_field('course_lecturer', $course_id);
    return is_array($lecturer) && !empty($lecturer) ? $lecturer[0] : null;
}
