<?php
/**
 * Front page template — UPenn-inspired homepage
 *
 * Sections:
 *  1. Hero
 *  2. News grid with category tabs
 *  3. Quick-access priorities
 *  4. Feature story (full-width)
 *  5. Events
 *  6. About / department stats
 *  7. Contact CTA
 *
 * @package MMI_Portal
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main" class="site-main" role="main">

    <?php
    // =========================================================================
    // 1. HERO
    // =========================================================================
    get_template_part('template-parts/hero');
    ?>

    <?php
    // =========================================================================
    // 2. NEWS GRID WITH TABS
    // =========================================================================
    $news_query = new WP_Query([
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 7,
        'ignore_sticky_posts' => true,
    ]);

    if ($news_query->have_posts()):
        // Collect all category slugs present in the result set for tab generation
        $tab_cats = []; // [slug => name]
        $all_posts = $news_query->posts;
        foreach ($all_posts as $np) {
            foreach (get_the_category($np->ID) as $c) {
                $tab_cats[$c->slug] = $c->name;
            }
        }
        $featured_post  = $all_posts[0] ?? null;
        $secondary_posts = array_slice($all_posts, 1, 6);
    ?>

    <section class="news-section">
        <div class="container">

            <div class="news-section__header">
                <h2 class="news-section__title"><?php esc_html_e('Новини', 'mmi-portal'); ?></h2>

                <?php if (!empty($tab_cats)): ?>
                    <div class="news-tabs" role="tablist" aria-label="<?php esc_attr_e('Фільтр за категоріями', 'mmi-portal'); ?>">
                        <button class="news-tab is-active"
                                role="tab"
                                data-category="all"
                                aria-selected="true">
                            <?php esc_html_e('Всі', 'mmi-portal'); ?>
                        </button>
                        <?php foreach ($tab_cats as $slug => $name): ?>
                            <button class="news-tab"
                                    role="tab"
                                    data-category="<?php echo esc_attr($slug); ?>"
                                    aria-selected="false">
                                <?php echo esc_html($name); ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="news-grid" id="news-grid">

                <?php if ($featured_post): ?>
                    <div class="news-grid__featured">
                        <?php get_template_part('template-parts/news-card', null, ['post' => $featured_post, 'variant' => 'featured']); ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($secondary_posts)): ?>
                    <div class="news-grid__secondary">
                        <?php foreach ($secondary_posts as $sp): ?>
                            <?php get_template_part('template-parts/news-card', null, ['post' => $sp, 'variant' => 'compact']); ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            </div><!-- .news-grid -->

            <div class="news-section__footer">
                <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts')) ?: home_url('/news/')); ?>"
                   class="btn btn--secondary">
                    <?php esc_html_e('Всі новини', 'mmi-portal'); ?>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </div>

        </div>
    </section>

    <?php
        wp_reset_postdata();
    endif; // $news_query
    ?>

    <?php
    // =========================================================================
    // 3. QUICK ACCESS — PRIORITY CARDS
    // =========================================================================
    $priority_cards = mmi_option('priority_cards', []);

    // Default fallback cards
    $default_cards = [
        ['title' => __('Викладачі', 'mmi-portal'),          'desc' => __('Наш науково-педагогічний склад', 'mmi-portal'),        'url' => home_url('/lecturers/'),    'image' => '', 'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="36" height="36"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>'],
        ['title' => __('Навчальні курси', 'mmi-portal'),     'desc' => __('Бакалаврські та магістерські програми', 'mmi-portal'), 'url' => home_url('/courses/'),      'image' => '', 'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="36" height="36"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>'],
        ['title' => __('Публікації', 'mmi-portal'),          'desc' => __('Наукові праці та статті', 'mmi-portal'),               'url' => home_url('/publications/'), 'image' => '', 'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="36" height="36"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>'],
        ['title' => __('Вступникам', 'mmi-portal'),          'desc' => __('Умови та правила вступу', 'mmi-portal'),               'url' => home_url('/admissions/'),   'image' => '', 'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="36" height="36"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>'],
    ];

    // Merge ACF cards over defaults
    if (!empty($priority_cards) && is_array($priority_cards)) {
        foreach ($priority_cards as $i => $acf_card) {
            if (!empty($acf_card['title'])) {
                $default_cards[$i] = [
                    'title' => $acf_card['title'],
                    'desc'  => $acf_card['desc'] ?? '',
                    'url'   => $acf_card['url']   ?? '#',
                    'image' => $acf_card['image']  ?? '',
                    'icon'  => $default_cards[$i]['icon'] ?? '',
                ];
            }
        }
    }
    ?>

    <section class="priorities">
        <div class="priorities__grid">
            <?php foreach ($default_cards as $card): ?>
                <?php get_template_part('template-parts/priority-card', null, $card); ?>
            <?php endforeach; ?>
        </div>
    </section>

    <?php
    // =========================================================================
    // 4. FEATURE STORY
    // =========================================================================
    $feature_posts = mmi_option('feature_post', []);
    $feature_post  = is_array($feature_posts) ? ($feature_posts[0] ?? null) : $feature_posts;

    // Fall back to the most recent sticky post
    if (!$feature_post instanceof WP_Post) {
        $sticky_ids   = get_option('sticky_posts', []);
        $feature_post = !empty($sticky_ids) ? get_post($sticky_ids[0]) : null;
    }

    // Fall back to the second most recent post
    if (!$feature_post instanceof WP_Post) {
        $fallback = get_posts(['post_type' => 'post', 'posts_per_page' => 1, 'offset' => 1]);
        $feature_post = $fallback[0] ?? null;
    }

    if ($feature_post instanceof WP_Post):
        $feature_label = mmi_option('feature_label', '');
        if (!$feature_label) {
            $cats = get_the_category($feature_post->ID);
            $feature_label = !empty($cats) ? $cats[0]->name : '';
        }

        $feature_image = mmi_option('feature_image', []);
        if (!empty($feature_image['url'])) {
            $feature_img_url = $feature_image['url'];
        } elseif (has_post_thumbnail($feature_post->ID)) {
            $feature_img_url = get_the_post_thumbnail_url($feature_post->ID, 'hero');
        } else {
            $feature_img_url = '';
        }
        $feature_style = $feature_img_url ? ' style="background-image: url(' . esc_url($feature_img_url) . ')"' : '';
    ?>

    <section class="feature-story"<?php echo $feature_style; ?>>
        <div class="feature-story__overlay" aria-hidden="true"></div>
        <div class="feature-story__content container">
            <?php if ($feature_label): ?>
                <span class="feature-story__label"><?php echo esc_html($feature_label); ?></span>
            <?php endif; ?>
            <h2 class="feature-story__title">
                <?php echo esc_html(get_the_title($feature_post->ID)); ?>
            </h2>
            <p class="feature-story__excerpt">
                <?php echo esc_html(wp_trim_words(get_the_excerpt($feature_post->ID), 30, '...')); ?>
            </p>
            <a href="<?php echo esc_url(get_permalink($feature_post->ID)); ?>" class="btn btn--primary">
                <?php esc_html_e('Читати далі', 'mmi-portal'); ?>
            </a>
        </div>
    </section>

    <?php endif; // feature post ?>

    <?php
    // =========================================================================
    // 5. UPCOMING EVENTS
    // =========================================================================
    $today        = current_time('Y-m-d');
    $events_query = new WP_Query([
        'post_type'      => 'events',
        'post_status'    => 'publish',
        'posts_per_page' => 4,
        'meta_key'       => 'event_date',
        'orderby'        => 'meta_value',
        'order'          => 'ASC',
        'meta_query'     => [
            [
                'key'     => 'event_date',
                'value'   => $today,
                'compare' => '>=',
                'type'    => 'DATE',
            ],
        ],
    ]);

    if ($events_query->have_posts()):
    ?>

    <section class="events-section">
        <div class="container">
            <div class="events-section__header">
                <h2 class="events-section__title"><?php esc_html_e('Найближчі події', 'mmi-portal'); ?></h2>
            </div>
            <div class="events-list">
                <?php while ($events_query->have_posts()): $events_query->the_post(); ?>
                    <?php get_template_part('template-parts/event-item', null, ['event' => get_post()]); ?>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <?php
        wp_reset_postdata();
    endif; // events
    ?>

    <?php
    // =========================================================================
    // 6. ABOUT DEPARTMENT + STATS
    // =========================================================================
    $dept_desc       = mmi_option('dept_description', __('Механіко-машинобудівний інститут КПІ ім. Ігоря Сікорського — провідний освітньо-науковий підрозділ університету. Ми готуємо висококваліфікованих інженерів та науковців у галузі машинобудування, матеріалознавства та сучасних виробничих технологій.', 'mmi-portal'));
    $stat_lecturers  = mmi_option('dept_stat_lecturers', 20);
    $stat_courses    = mmi_option('dept_stat_courses', 30);
    $stat_year       = mmi_option('dept_stat_year', 1998);
    $years_active    = (int) date_i18n('Y') - (int) $stat_year;
    ?>

    <section class="about-section">
        <div class="container">

            <div class="about-section__content">
                <div class="about-section__text">
                    <span class="about-section__eyebrow"><?php esc_html_e('Про інститут', 'mmi-portal'); ?></span>
                    <h2 class="about-section__title">
                        <?php esc_html_e('Механіко-машинобудівний інститут', 'mmi-portal'); ?>
                    </h2>
                    <p class="about-section__desc"><?php echo esc_html($dept_desc); ?></p>
                    <a href="<?php echo esc_url(home_url('/about/')); ?>" class="btn btn--secondary">
                        <?php esc_html_e('Детальніше про інститут', 'mmi-portal'); ?>
                    </a>
                </div>

                <div class="about-section__stats">
                    <div class="stat-card">
                        <span class="stat-card__number"><?php echo esc_html($stat_lecturers); ?>+</span>
                        <span class="stat-card__label"><?php esc_html_e('Викладачів', 'mmi-portal'); ?></span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-card__number"><?php echo esc_html($stat_courses); ?>+</span>
                        <span class="stat-card__label"><?php esc_html_e('Навчальних курсів', 'mmi-portal'); ?></span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-card__number"><?php echo esc_html($years_active); ?></span>
                        <span class="stat-card__label"><?php esc_html_e('Років досвіду', 'mmi-portal'); ?></span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-card__number"><?php echo esc_html($stat_year); ?></span>
                        <span class="stat-card__label"><?php esc_html_e('Рік заснування', 'mmi-portal'); ?></span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <?php
    // =========================================================================
    // 7. CONTACT CTA
    // =========================================================================
    $contact_address  = mmi_option('contact_address', 'пр. Берестейський, 37, корп. 35, Київ, 03056');
    $contact_email    = mmi_option('contact_email', 'mmi@kpi.ua');
    $contact_phone    = mmi_option('contact_phone', '');
    $contact_maps_url = mmi_option('contact_maps_url', '');
    ?>

    <section class="cta-section">
        <div class="container">
            <div class="cta-section__inner">

                <div class="cta-section__text">
                    <h2 class="cta-section__title"><?php esc_html_e('Зв\'яжіться з нами', 'mmi-portal'); ?></h2>
                    <p class="cta-section__subtitle">
                        <?php esc_html_e('Ми завжди раді відповісти на ваші запитання.', 'mmi-portal'); ?>
                    </p>
                </div>

                <div class="cta-section__contacts">
                    <?php if ($contact_address): ?>
                        <div class="cta-item">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <span><?php echo esc_html($contact_address); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if ($contact_email): ?>
                        <div class="cta-item">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            <a href="mailto:<?php echo esc_attr($contact_email); ?>"><?php echo esc_html($contact_email); ?></a>
                        </div>
                    <?php endif; ?>
                    <?php if ($contact_phone): ?>
                        <div class="cta-item">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13 19.79 19.79 0 0 1 1.61 4.48 2 2 0 0 1 3.58 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.08 6.08l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $contact_phone)); ?>"><?php echo esc_html($contact_phone); ?></a>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="cta-section__actions">
                    <?php if ($contact_email): ?>
                        <a href="mailto:<?php echo esc_attr($contact_email); ?>" class="btn btn--primary btn--lg">
                            <?php esc_html_e('Написати нам', 'mmi-portal'); ?>
                        </a>
                    <?php endif; ?>
                    <?php if ($contact_maps_url): ?>
                        <a href="<?php echo esc_url($contact_maps_url); ?>"
                           class="btn btn--outline btn--lg"
                           target="_blank"
                           rel="noopener noreferrer">
                            <?php esc_html_e('На карті', 'mmi-portal'); ?>
                        </a>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
