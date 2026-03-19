<?php
/**
 * ACF Field Group: Events
 *
 * @package MMI_Data
 */

defined('ABSPATH') || exit;

acf_add_local_field_group([
    'key'      => 'group_events',
    'title'    => __('Дані події', 'mmi-portal'),
    'location' => [
        [['param' => 'post_type', 'operator' => '==', 'value' => 'events']],
    ],
    'menu_order'  => 0,
    'position'    => 'normal',
    'style'       => 'default',
    'label_placement' => 'top',
    'fields' => [
        [
            'key'           => 'field_event_date',
            'label'         => __('Дата', 'mmi-portal'),
            'name'          => 'event_date',
            'type'          => 'date_picker',
            'required'      => 1,
            'return_format' => 'Y-m-d',
            'display_format' => 'd.m.Y',
            'first_day'     => 1,
        ],
        [
            'key'            => 'field_event_time',
            'label'          => __('Час', 'mmi-portal'),
            'name'           => 'event_time',
            'type'           => 'time_picker',
            'display_format' => 'H:i',
            'return_format'  => 'H:i',
        ],
        [
            'key'          => 'field_event_end_date',
            'label'        => __('Дата завершення (якщо відрізняється)', 'mmi-portal'),
            'name'         => 'event_end_date',
            'type'         => 'date_picker',
            'return_format' => 'Y-m-d',
            'display_format' => 'd.m.Y',
            'first_day'    => 1,
        ],
        [
            'key'   => 'field_event_location',
            'label' => __('Місце проведення', 'mmi-portal'),
            'name'  => 'event_location',
            'type'  => 'text',
        ],
        [
            'key'     => 'field_event_type',
            'label'   => __('Тип події', 'mmi-portal'),
            'name'    => 'event_type',
            'type'    => 'select',
            'choices' => [
                'lecture'    => __('Лекція', 'mmi-portal'),
                'seminar'    => __('Семінар', 'mmi-portal'),
                'conference' => __('Конференція', 'mmi-portal'),
                'workshop'   => __('Воркшоп', 'mmi-portal'),
                'defense'    => __('Захист', 'mmi-portal'),
                'other'      => __('Інше', 'mmi-portal'),
            ],
            'allow_null'    => 1,
            'return_format' => 'value',
        ],
        [
            'key'   => 'field_event_url',
            'label' => __('Посилання (реєстрація / деталі)', 'mmi-portal'),
            'name'  => 'event_url',
            'type'  => 'url',
        ],
    ],
]);
