<?php
/**
 * ACF Field Group: Publications
 */

defined('ABSPATH') || exit;

acf_add_local_field_group([
    'key' => 'group_publications',
    'title' => __('Інформація про публікацію', 'mmi-portal'),
    'fields' => [
        [
            'key' => 'field_publication_year',
            'label' => __('Рік публікації', 'mmi-portal'),
            'name' => 'publication_year',
            'type' => 'number',
            'required' => 1,
            'min' => 1990,
            'max' => 2050,
            'step' => 1,
            'placeholder' => date('Y'),
        ],
        [
            'key' => 'field_publication_type',
            'label' => __('Тип публікації', 'mmi-portal'),
            'name' => 'publication_type',
            'type' => 'select',
            'required' => 1,
            'choices' => [
                'journal_article' => __('Стаття у журналі', 'mmi-portal'),
                'conference_paper' => __('Доповідь на конференції', 'mmi-portal'),
                'book' => __('Книга', 'mmi-portal'),
                'book_chapter' => __('Розділ у книзі', 'mmi-portal'),
                'thesis' => __('Дисертація', 'mmi-portal'),
                'preprint' => __('Препринт', 'mmi-portal'),
            ],
            'default_value' => 'journal_article',
        ],
        [
            'key' => 'field_publication_authors',
            'label' => __('Автори', 'mmi-portal'),
            'name' => 'publication_authors',
            'type' => 'text',
            'required' => 1,
            'placeholder' => __('Іванов І.П., Петров П.К.', 'mmi-portal'),
            'instructions' => __('Перелічіть всіх авторів через кому', 'mmi-portal'),
        ],
        [
            'key' => 'field_publication_journal',
            'label' => __('Назва журналу/видання', 'mmi-portal'),
            'name' => 'publication_journal',
            'type' => 'text',
            'placeholder' => __('Наприклад: Вісник КПІ', 'mmi-portal'),
        ],
        [
            'key' => 'field_publication_volume',
            'label' => __('Том/Випуск', 'mmi-portal'),
            'name' => 'publication_volume',
            'type' => 'text',
            'placeholder' => __('Наприклад: Vol. 15, Issue 3', 'mmi-portal'),
        ],
        [
            'key' => 'field_publication_pages',
            'label' => __('Сторінки', 'mmi-portal'),
            'name' => 'publication_pages',
            'type' => 'text',
            'placeholder' => __('Наприклад: 123-145', 'mmi-portal'),
        ],
        [
            'key' => 'field_publication_doi',
            'label' => __('DOI', 'mmi-portal'),
            'name' => 'publication_doi',
            'type' => 'url',
            'placeholder' => 'https://doi.org/10.1234/example',
            'instructions' => __('Digital Object Identifier - постійне посилання на публікацію', 'mmi-portal'),
        ],
        [
            'key' => 'field_publication_url',
            'label' => __('Посилання на публікацію', 'mmi-portal'),
            'name' => 'publication_url',
            'type' => 'url',
            'placeholder' => 'https://...',
        ],
        [
            'key' => 'field_publication_pdf',
            'label' => __('PDF файл', 'mmi-portal'),
            'name' => 'publication_pdf',
            'type' => 'file',
            'return_format' => 'array',
            'mime_types' => 'pdf',
            'instructions' => __('Завантажте PDF версію публікації (якщо доступна)', 'mmi-portal'),
        ],
        [
            'key' => 'field_publication_indexed',
            'label' => __('Індексація', 'mmi-portal'),
            'name' => 'publication_indexed',
            'type' => 'checkbox',
            'choices' => [
                'scopus' => 'Scopus',
                'wos' => 'Web of Science',
                'google_scholar' => 'Google Scholar',
                'other' => __('Інше', 'mmi-portal'),
            ],
        ],
    ],
    'location' => [
        [
            [
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'publications',
            ],
        ],
    ],
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
]);
