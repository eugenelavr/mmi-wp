<?php
/**
 * Register Courses Custom Post Type
 */

defined('ABSPATH') || exit;

register_post_type('courses', [
    'labels' => [
        'name'                  => __('Курси', 'mmi-portal'),
        'singular_name'         => __('Курс', 'mmi-portal'),
        'menu_name'             => __('Курси', 'mmi-portal'),
        'add_new'               => __('Додати новий', 'mmi-portal'),
        'add_new_item'          => __('Додати курс', 'mmi-portal'),
        'edit_item'             => __('Редагувати курс', 'mmi-portal'),
        'new_item'              => __('Новий курс', 'mmi-portal'),
        'view_item'             => __('Переглянути курс', 'mmi-portal'),
        'search_items'          => __('Шукати курси', 'mmi-portal'),
        'not_found'             => __('Курсів не знайдено', 'mmi-portal'),
        'not_found_in_trash'    => __('У кошику курсів не знайдено', 'mmi-portal'),
        'all_items'             => __('Всі курси', 'mmi-portal'),
        'archives'              => __('Архів курсів', 'mmi-portal'),
    ],
    'public'                => true,
    'publicly_queryable'    => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'show_in_rest'          => true,
    'query_var'             => true,
    'rewrite'               => ['slug' => 'courses'],
    'capability_type'       => 'post',
    'has_archive'           => true,
    'hierarchical'          => false,
    'menu_position'         => 21,
    'menu_icon'             => 'dashicons-book',
    'supports'              => ['title', 'editor', 'thumbnail'],
]);
