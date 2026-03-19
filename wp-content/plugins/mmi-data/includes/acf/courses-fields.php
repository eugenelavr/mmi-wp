<?php
/**
 * ACF Field Group: Courses
 */

defined('ABSPATH') || exit;

acf_add_local_field_group([
    'key' => 'group_courses',
    'title' => __('Інформація про курс', 'mmi-portal'),
    'fields' => [
        [
            'key' => 'field_course_code',
            'label' => __('Код курсу', 'mmi-portal'),
            'name' => 'course_code',
            'type' => 'text',
            'placeholder' => __('Наприклад: МІ-301', 'mmi-portal'),
            'instructions' => __('Офіційний код курсу у навчальному плані', 'mmi-portal'),
        ],
        [
            'key' => 'field_course_edu_level',
            'label' => __('Освітній рівень', 'mmi-portal'),
            'name' => 'course_edu_level',
            'type' => 'select',
            'required' => 1,
            'choices' => [
                'bachelor' => __('Бакалавр', 'mmi-portal'),
                'master' => __('Магістр', 'mmi-portal'),
                'phd' => __('Аспірантура', 'mmi-portal'),
            ],
            'default_value' => 'bachelor',
        ],
        [
            'key' => 'field_course_credits',
            'label' => __('Кредити ECTS', 'mmi-portal'),
            'name' => 'course_credits',
            'type' => 'number',
            'required' => 1,
            'min' => 1,
            'max' => 12,
            'step' => 0.5,
            'placeholder' => '5',
        ],
        [
            'key' => 'field_course_semester',
            'label' => __('Семестр', 'mmi-portal'),
            'name' => 'course_semester',
            'type' => 'select',
            'choices' => [
                '1' => __('1 семестр', 'mmi-portal'),
                '2' => __('2 семестр', 'mmi-portal'),
                '3' => __('3 семестр', 'mmi-portal'),
                '4' => __('4 семестр', 'mmi-portal'),
                '5' => __('5 семестр', 'mmi-portal'),
                '6' => __('6 семестр', 'mmi-portal'),
                '7' => __('7 семестр', 'mmi-portal'),
                '8' => __('8 семестр', 'mmi-portal'),
            ],
        ],
        [
            'key' => 'field_course_syllabus',
            'label' => __('Силабус (PDF)', 'mmi-portal'),
            'name' => 'course_syllabus',
            'type' => 'file',
            'return_format' => 'array',
            'mime_types' => 'pdf',
            'instructions' => __('Завантажте робочу програму курсу у форматі PDF', 'mmi-portal'),
        ],
        [
            'key' => 'field_course_moodle_link',
            'label' => __('Посилання на Moodle', 'mmi-portal'),
            'name' => 'course_moodle_link',
            'type' => 'url',
            'placeholder' => 'https://moodle.kpi.ua/...',
        ],
        [
            'key' => 'field_course_lecturer',
            'label' => __('Викладач', 'mmi-portal'),
            'name' => 'course_lecturer',
            'type' => 'relationship',
            'post_type' => ['lecturers'],
            'filters' => ['search'],
            'return_format' => 'object',
            'max' => 1,
            'instructions' => __('Оберіть викладача, який веде цей курс', 'mmi-portal'),
        ],
    ],
    'location' => [
        [
            [
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'courses',
            ],
        ],
    ],
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
]);
