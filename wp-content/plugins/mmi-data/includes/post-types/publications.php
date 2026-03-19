<?php
/**
 * Register Publications Custom Post Type
 */

defined('ABSPATH') || exit;

register_post_type('publications', [
    'labels' => [
        'name'                  => __('Публікації', 'mmi-portal'),
        'singular_name'         => __('Публікація', 'mmi-portal'),
        'menu_name'             => __('Публікації', 'mmi-portal'),
        'add_new'               => __('Додати нову', 'mmi-portal'),
        'add_new_item'          => __('Додати публікацію', 'mmi-portal'),
        'edit_item'             => __('Редагувати публікацію', 'mmi-portal'),
        'new_item'              => __('Нова публікація', 'mmi-portal'),
        'view_item'             => __('Переглянути публікацію', 'mmi-portal'),
        'search_items'          => __('Шукати публікації', 'mmi-portal'),
        'not_found'             => __('Публікацій не знайдено', 'mmi-portal'),
        'not_found_in_trash'    => __('У кошику публікацій не знайдено', 'mmi-portal'),
        'all_items'             => __('Всі публікації', 'mmi-portal'),
        'archives'              => __('Архів публікацій', 'mmi-portal'),
    ],
    'public'                => true,
    'publicly_queryable'    => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'show_in_rest'          => true,
    'query_var'             => true,
    'rewrite'               => ['slug' => 'publications'],
    'capability_type'       => 'post',
    'has_archive'           => true,
    'hierarchical'          => false,
    'menu_position'         => 22,
    'menu_icon'             => 'dashicons-media-document',
    'supports'              => ['title', 'editor'],
]);
