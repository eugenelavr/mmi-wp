<?php
/**
 * ACF Field Group: Lecturers
 */

defined('ABSPATH') || exit;

acf_add_local_field_group([
    'key' => 'group_lecturers',
    'title' => __('Інформація про викладача', 'mmi-portal'),
    'fields' => [
        [
            'key' => 'field_lecturer_position',
            'label' => __('Посада', 'mmi-portal'),
            'name' => 'lecturer_position',
            'type' => 'text',
            'required' => 1,
            'placeholder' => __('Наприклад: Доцент ММІ КПІ ім. Ігоря Сікорського', 'mmi-portal'),
        ],
        [
            'key' => 'field_lecturer_degree',
            'label' => __('Науковий ступінь', 'mmi-portal'),
            'name' => 'lecturer_degree',
            'type' => 'text',
            'placeholder' => __('Наприклад: Кандидат фізико-математичних наук', 'mmi-portal'),
        ],
        [
            'key' => 'field_lecturer_email',
            'label' => __('Email', 'mmi-portal'),
            'name' => 'lecturer_email',
            'type' => 'email',
            'placeholder' => 'email@kpi.ua',
        ],
        [
            'key' => 'field_lecturer_phone',
            'label' => __('Телефон', 'mmi-portal'),
            'name' => 'lecturer_phone',
            'type' => 'text',
            'placeholder' => '+380 XX XXX XX XX',
        ],
        [
            'key' => 'field_lecturer_office',
            'label' => __('Кабінет', 'mmi-portal'),
            'name' => 'lecturer_office',
            'type' => 'text',
            'placeholder' => __('Наприклад: 305', 'mmi-portal'),
        ],
        [
            'key' => 'field_lecturer_google_scholar',
            'label' => __('Google Scholar', 'mmi-portal'),
            'name' => 'lecturer_google_scholar',
            'type' => 'url',
            'placeholder' => 'https://scholar.google.com/...',
        ],
        [
            'key' => 'field_lecturer_orcid',
            'label' => __('ORCID', 'mmi-portal'),
            'name' => 'lecturer_orcid',
            'type' => 'url',
            'placeholder' => 'https://orcid.org/...',
        ],
        [
            'key' => 'field_lecturer_scopus',
            'label' => __('Scopus Author ID', 'mmi-portal'),
            'name' => 'lecturer_scopus',
            'type' => 'url',
            'placeholder' => 'https://www.scopus.com/...',
        ],
        [
            'key' => 'field_lecturer_courses',
            'label' => __('Курси', 'mmi-portal'),
            'name' => 'lecturer_courses',
            'type' => 'relationship',
            'post_type' => ['courses'],
            'filters' => ['search'],
            'return_format' => 'object',
            'instructions' => __('Оберіть курси, які викладає цей викладач', 'mmi-portal'),
        ],
        [
            'key' => 'field_lecturer_publications',
            'label' => __('Публікації', 'mmi-portal'),
            'name' => 'lecturer_publications',
            'type' => 'relationship',
            'post_type' => ['publications'],
            'filters' => ['search'],
            'return_format' => 'object',
            'instructions' => __('Оберіть публікації цього викладача', 'mmi-portal'),
        ],
    ],
    'location' => [
        [
            [
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'lecturers',
            ],
        ],
    ],
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
]);
