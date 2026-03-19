<?php
/**
 * Register Events Custom Post Type
 *
 * @package MMI_Data
 */

defined('ABSPATH') || exit;

register_post_type('events', [
    'labels' => [
        'name'               => __('Події', 'mmi-portal'),
        'singular_name'      => __('Подія', 'mmi-portal'),
        'add_new'            => __('Додати подію', 'mmi-portal'),
        'add_new_item'       => __('Додати нову подію', 'mmi-portal'),
        'edit_item'          => __('Редагувати подію', 'mmi-portal'),
        'new_item'           => __('Нова подія', 'mmi-portal'),
        'view_item'          => __('Переглянути подію', 'mmi-portal'),
        'search_items'       => __('Шукати серед подій', 'mmi-portal'),
        'not_found'          => __('Подій не знайдено', 'mmi-portal'),
        'not_found_in_trash' => __('Подій у кошику не знайдено', 'mmi-portal'),
        'all_items'          => __('Всі події', 'mmi-portal'),
        'menu_name'          => __('Події', 'mmi-portal'),
    ],
    'public'            => true,
    'has_archive'       => false,
    'show_in_rest'      => true,
    'rewrite'           => ['slug' => 'events', 'with_front' => false],
    'menu_icon'         => 'dashicons-calendar-alt',
    'menu_position'     => 23,
    'supports'          => ['title', 'editor', 'thumbnail'],
    'show_in_nav_menus' => true,
]);
