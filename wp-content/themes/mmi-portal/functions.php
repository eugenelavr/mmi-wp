<?php
/**
 * MMI Portal Child Theme Functions
 *
 * @package MMI_Portal
 * @since 1.0.0
 */

defined('ABSPATH') || exit;

/**
 * Enqueue parent and child theme styles + Google Fonts
 */
function mmi_portal_enqueue_styles(): void {
    wp_enqueue_style(
        'generatepress-parent',
        get_template_directory_uri() . '/style.css',
        [],
        wp_get_theme()->parent()->get('Version')
    );

    wp_enqueue_style(
        'mmi-portal-fonts',
        'https://fonts.googleapis.com/css2?family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;0,8..60,700;1,8..60,400&family=Inter:wght@400;500;600;700&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'mmi-portal-style',
        get_stylesheet_directory_uri() . '/assets/css/main.css',
        ['generatepress-parent', 'mmi-portal-fonts'],
        wp_get_theme()->get('Version')
    );

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
 * Theme setup: support features, menus, image sizes
 */
function mmi_portal_setup(): void {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);

    add_image_size('lecturer-thumbnail', 300, 300, true);
    add_image_size('course-thumbnail', 400, 250, true);
    add_image_size('hero', 1600, 700, true);
    add_image_size('news-featured', 800, 500, true);
    add_image_size('news-card-thumb', 400, 250, true);
    add_image_size('priority-card', 600, 400, true);

    register_nav_menus([
        'primary'          => __('Головне меню', 'mmi-portal'),
        'footer'           => __('Меню підвалу', 'mmi-portal'),
        'header-resources' => __('Верхня панель', 'mmi-portal'),
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
 * Register ACF options page for homepage/portal settings
 */
function mmi_portal_acf_options(): void {
    if (!function_exists('acf_add_options_page')) {
        return;
    }
    acf_add_options_page([
        'page_title' => __('Налаштування порталу', 'mmi-portal'),
        'menu_title' => __('Портал ММІ', 'mmi-portal'),
        'menu_slug'  => 'mmi-portal-settings',
        'capability' => 'manage_options',
        'icon_url'   => 'dashicons-admin-home',
        'position'   => 2,
    ]);
}
add_action('acf/init', 'mmi_portal_acf_options');

/**
 * Register ACF field groups for the options page
 */
function mmi_portal_acf_options_fields(): void {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    acf_add_local_field_group([
        'key'      => 'group_portal_settings',
        'title'    => __('Налаштування порталу ММІ', 'mmi-portal'),
        'location' => [
            [['param' => 'options_page', 'operator' => '==', 'value' => 'mmi-portal-settings']],
        ],
        'fields' => [
            // --- Hero tab ---
            ['key' => 'field_tab_hero', 'label' => __('Герой', 'mmi-portal'), 'name' => '', 'type' => 'tab', 'placement' => 'top'],
            ['key' => 'field_hero_image', 'label' => __('Фонове зображення', 'mmi-portal'), 'name' => 'hero_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'],
            ['key' => 'field_hero_label', 'label' => __('Мітка (категорія)', 'mmi-portal'), 'name' => 'hero_label', 'type' => 'text', 'placeholder' => __('Наприклад: Наука', 'mmi-portal')],
            ['key' => 'field_hero_title', 'label' => __('Заголовок', 'mmi-portal'), 'name' => 'hero_title', 'type' => 'text'],
            ['key' => 'field_hero_subtitle', 'label' => __('Підзаголовок', 'mmi-portal'), 'name' => 'hero_subtitle', 'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_hero_cta_text', 'label' => __('Текст кнопки', 'mmi-portal'), 'name' => 'hero_cta_text', 'type' => 'text', 'default_value' => __('Дізнатись більше', 'mmi-portal')],
            ['key' => 'field_hero_cta_url', 'label' => __('Посилання кнопки', 'mmi-portal'), 'name' => 'hero_cta_url', 'type' => 'url'],

            // --- Feature story tab ---
            ['key' => 'field_tab_feature', 'label' => __('Вибрана стаття', 'mmi-portal'), 'name' => '', 'type' => 'tab', 'placement' => 'top'],
            ['key' => 'field_feature_post', 'label' => __('Обрана стаття', 'mmi-portal'), 'name' => 'feature_post', 'type' => 'relationship', 'post_type' => ['post'], 'max' => 1, 'return_format' => 'object', 'instructions' => __('Якщо не обрано — буде показано останній закріплений пост.', 'mmi-portal')],
            ['key' => 'field_feature_label', 'label' => __('Мітка (override)', 'mmi-portal'), 'name' => 'feature_label', 'type' => 'text'],
            ['key' => 'field_feature_image', 'label' => __('Фонове зображення (override)', 'mmi-portal'), 'name' => 'feature_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'],

            // --- Priority cards tab ---
            ['key' => 'field_tab_priorities', 'label' => __('Швидкий доступ', 'mmi-portal'), 'name' => '', 'type' => 'tab', 'placement' => 'top'],
            [
                'key'        => 'field_priority_cards',
                'label'      => __('Картки швидкого доступу', 'mmi-portal'),
                'name'       => 'priority_cards',
                'type'       => 'repeater',
                'min'        => 0,
                'max'        => 4,
                'layout'     => 'row',
                'sub_fields' => [
                    ['key' => 'field_pc_title', 'label' => __('Назва', 'mmi-portal'), 'name' => 'title', 'type' => 'text'],
                    ['key' => 'field_pc_desc',  'label' => __('Короткий опис', 'mmi-portal'), 'name' => 'desc', 'type' => 'text'],
                    ['key' => 'field_pc_url',   'label' => __('Посилання', 'mmi-portal'), 'name' => 'url', 'type' => 'url'],
                    ['key' => 'field_pc_image', 'label' => __('Зображення', 'mmi-portal'), 'name' => 'image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium'],
                ],
            ],

            // --- About tab ---
            ['key' => 'field_tab_about', 'label' => __('Про інститут', 'mmi-portal'), 'name' => '', 'type' => 'tab', 'placement' => 'top'],
            ['key' => 'field_dept_description', 'label' => __('Опис інституту', 'mmi-portal'), 'name' => 'dept_description', 'type' => 'textarea', 'rows' => 4],
            ['key' => 'field_dept_stat_lecturers', 'label' => __('Кількість викладачів', 'mmi-portal'), 'name' => 'dept_stat_lecturers', 'type' => 'number', 'default_value' => 20],
            ['key' => 'field_dept_stat_courses',   'label' => __('Кількість курсів', 'mmi-portal'),    'name' => 'dept_stat_courses',   'type' => 'number', 'default_value' => 30],
            ['key' => 'field_dept_stat_year',      'label' => __('Рік заснування', 'mmi-portal'),      'name' => 'dept_stat_year',      'type' => 'number', 'default_value' => 1998],

            // --- Contacts tab ---
            ['key' => 'field_tab_contacts', 'label' => __('Контакти', 'mmi-portal'), 'name' => '', 'type' => 'tab', 'placement' => 'top'],
            ['key' => 'field_contact_address',  'label' => __('Адреса', 'mmi-portal'),          'name' => 'contact_address',  'type' => 'text', 'default_value' => 'пр. Берестейський, 37, корп. 35, Київ, 03056'],
            ['key' => 'field_contact_email',    'label' => __('Email', 'mmi-portal'),            'name' => 'contact_email',    'type' => 'email', 'default_value' => 'mmi@kpi.ua'],
            ['key' => 'field_contact_phone',    'label' => __('Телефон', 'mmi-portal'),          'name' => 'contact_phone',    'type' => 'text'],
            ['key' => 'field_contact_maps_url', 'label' => __('Посилання на карту', 'mmi-portal'), 'name' => 'contact_maps_url', 'type' => 'url'],
            ['key' => 'field_telegram_url',     'label' => 'Telegram URL',                       'name' => 'telegram_url',     'type' => 'url', 'default_value' => 'https://t.me/mmi_kpi'],
            ['key' => 'field_facebook_url',     'label' => 'Facebook URL',                       'name' => 'facebook_url',     'type' => 'url'],
        ],
    ]);
}
add_action('acf/init', 'mmi_portal_acf_options_fields');

/**
 * Excerpt filters
 */
function mmi_portal_excerpt_length(int $length): int {
    return 25;
}
add_filter('excerpt_length', 'mmi_portal_excerpt_length');

function mmi_portal_excerpt_more(string $more): string {
    return '...';
}
add_filter('excerpt_more', 'mmi_portal_excerpt_more');

// ---------------------------------------------------------------------------
// Helper functions
// ---------------------------------------------------------------------------

function mmi_get_lecturer_courses(int $lecturer_id): array {
    $courses = get_field('lecturer_courses', $lecturer_id);
    return is_array($courses) ? $courses : [];
}

function mmi_get_lecturer_publications(int $lecturer_id): array {
    $publications = get_field('lecturer_publications', $lecturer_id);
    return is_array($publications) ? $publications : [];
}

function mmi_get_course_lecturer(int $course_id): ?WP_Post {
    $lecturer = get_field('course_lecturer', $course_id);
    return is_array($lecturer) && !empty($lecturer) ? $lecturer[0] : null;
}

/**
 * Force GeneratePress to use a no-sidebar, full-width layout on all pages
 * managed by the child theme's custom templates (front page, archives, singles).
 * This removes the ~37% sidebar reservation that GeneratePress applies by default.
 */
add_filter('generate_sidebar_layout', function (): string {
    return 'no-sidebar';
});

/**
 * Translate a string using Polylang when available, otherwise fall back to gettext.
 * Use this instead of __() for strings whose translations are managed via
 * Languages → String Translations in the WP admin (pll_register_string / pll__).
 */
function mmi_t(string $string, string $domain = 'mmi-portal'): string {
    return function_exists('pll__') ? pll__($string) : __($string, $domain);
}

/**
 * Get ACF option value with a fallback default.
 */
function mmi_option(string $key, mixed $default = ''): mixed {
    if (!function_exists('get_field')) {
        return $default;
    }
    $val = get_field($key, 'option');
    return ($val !== null && $val !== false && $val !== '') ? $val : $default;
}
