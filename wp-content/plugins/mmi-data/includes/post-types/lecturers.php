<?php
/**
 * Register Lecturers Custom Post Type
 */

defined('ABSPATH') || exit;

register_post_type('lecturers', [
    'labels' => [
        'name'                  => __('Викладачі', 'mmi-portal'),
        'singular_name'         => __('Викладач', 'mmi-portal'),
        'menu_name'             => __('Викладачі', 'mmi-portal'),
        'add_new'               => __('Додати нового', 'mmi-portal'),
        'add_new_item'          => __('Додати викладача', 'mmi-portal'),
        'edit_item'             => __('Редагувати викладача', 'mmi-portal'),
        'new_item'              => __('Новий викладач', 'mmi-portal'),
        'view_item'             => __('Переглянути викладача', 'mmi-portal'),
        'search_items'          => __('Шукати викладачів', 'mmi-portal'),
        'not_found'             => __('Викладачів не знайдено', 'mmi-portal'),
        'not_found_in_trash'    => __('У кошику викладачів не знайдено', 'mmi-portal'),
        'all_items'             => __('Всі викладачі', 'mmi-portal'),
        'archives'              => __('Архів викладачів', 'mmi-portal'),
    ],
    'public'                => true,
    'publicly_queryable'    => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'show_in_rest'          => true,
    'query_var'             => true,
    'rewrite'               => ['slug' => 'lecturers'],
    'capability_type'       => 'post',
    'has_archive'           => true,
    'hierarchical'          => false,
    'menu_position'         => 20,
    'menu_icon'             => 'dashicons-welcome-learn-more',
    'supports'              => ['title', 'editor', 'thumbnail', 'excerpt'],
]);
