<?php
/**
 * Archive template for Publications
 * 
 * @package MMI_Portal
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main" class="site-main publications-archive">
    <div class="container">
        
        <header class="archive-header">
            <h1 class="archive-header__title">
                <?php esc_html_e('Наукові публікації', 'mmi-portal'); ?>
            </h1>
            <?php if (get_the_archive_description()): ?>
                <div class="archive-header__description">
                    <?php the_archive_description(); ?>
                </div>
            <?php endif; ?>
        </header>

        <?php if (have_posts()): ?>
            
            <div class="publications-list">
                <?php while (have_posts()): the_post(); ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class('publication-card'); ?>>
                        
                        <?php
                        $year = get_field('publication_year');
                        $type = get_field('publication_type');
                        $authors = get_field('publication_authors');
                        $journal = get_field('publication_journal');
                        $doi = get_field('publication_doi');
                        $url = get_field('publication_url');
                        $indexed = get_field('publication_indexed');
                        ?>
                        
                        <div class="publication-card__content">
                            
                            <?php if ($year): ?>
                                <div class="publication-card__year">
                                    <?php echo esc_html($year); ?>
                                </div>
                            <?php endif; ?>
                            
                            <h2 class="publication-card__title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            
                            <?php if ($authors): ?>
                                <p class="publication-card__authors">
                                    <?php echo esc_html($authors); ?>
                                </p>
                            <?php endif; ?>
                            
                            <?php if ($journal): ?>
                                <p class="publication-card__journal">
                                    <em><?php echo esc_html($journal); ?></em>
                                </p>
                            <?php endif; ?>
                            
                            <div class="publication-card__meta">
                                <?php if ($type): ?>
                                    <span class="publication-card__type">
                                        <?php
                                        $types = [
                                            'journal_article' => __('Стаття у журналі', 'mmi-portal'),
                                            'conference_paper' => __('Доповідь на конференції', 'mmi-portal'),
                                            'book' => __('Книга', 'mmi-portal'),
                                            'book_chapter' => __('Розділ у книзі', 'mmi-portal'),
                                            'thesis' => __('Дисертація', 'mmi-portal'),
                                            'preprint' => __('Препринт', 'mmi-portal'),
                                        ];
                                        echo esc_html($types[$type] ?? $type);
                                        ?>
                                    </span>
                                <?php endif; ?>
                                
                                <?php if ($indexed && is_array($indexed)): ?>
                                    <span class="publication-card__indexed">
                                        <?php
                                        $indexed_labels = [
                                            'scopus' => 'Scopus',
                                            'wos' => 'Web of Science',
                                            'google_scholar' => 'Google Scholar',
                                            'other' => __('Інше', 'mmi-portal'),
                                        ];
                                        $indexed_names = array_map(function($key) use ($indexed_labels) {
                                            return $indexed_labels[$key] ?? $key;
                                        }, $indexed);
                                        echo esc_html(implode(', ', $indexed_names));
                                        ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            
                            <div class="publication-card__links">
                                <?php if ($doi): ?>
                                    <a href="<?php echo esc_url($doi); ?>" 
                                       class="publication-card__link publication-card__link--doi"
                                       target="_blank" 
                                       rel="noopener">
                                        DOI
                                    </a>
                                <?php endif; ?>
                                
                                <?php if ($url): ?>
                                    <a href="<?php echo esc_url($url); ?>" 
                                       class="publication-card__link publication-card__link--url"
                                       target="_blank" 
                                       rel="noopener">
                                        <?php esc_html_e('Посилання', 'mmi-portal'); ?>
                                    </a>
                                <?php endif; ?>
                                
                                <a href="<?php the_permalink(); ?>" 
                                   class="publication-card__link publication-card__link--details">
                                    <?php esc_html_e('Детальніше', 'mmi-portal'); ?>
                                    <span aria-hidden="true">→</span>
                                </a>
                            </div>
                            
                        </div>
                        
                    </article>
                    
                <?php endwhile; ?>
            </div>

            <?php
            the_posts_pagination([
                'mid_size'  => 2,
                'prev_text' => __('← Попередня', 'mmi-portal'),
                'next_text' => __('Наступна →', 'mmi-portal'),
            ]);
            ?>

        <?php else: ?>
            
            <div class="no-results">
                <p><?php esc_html_e('Публікацій не знайдено.', 'mmi-portal'); ?></p>
            </div>
            
        <?php endif; ?>
        
    </div>
</main>

<?php
get_footer();
