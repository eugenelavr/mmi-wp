<?php
/**
 * Single template for Publications
 * 
 * @package MMI_Portal
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main" class="site-main publication-single">
    <?php while (have_posts()): the_post(); ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class('publication'); ?>>
            
            <div class="container">
                
                <header class="publication__header">
                    
                    <?php
                    $year = get_field('publication_year');
                    $type = get_field('publication_type');
                    ?>
                    
                    <?php if ($year): ?>
                        <div class="publication__year"><?php echo esc_html($year); ?></div>
                    <?php endif; ?>
                    
                    <h1 class="publication__title"><?php the_title(); ?></h1>
                    
                    <?php if ($type): ?>
                        <div class="publication__type">
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
                        </div>
                    <?php endif; ?>
                    
                </header>
                
                <?php
                $authors = get_field('publication_authors');
                $journal = get_field('publication_journal');
                $volume = get_field('publication_volume');
                $pages = get_field('publication_pages');
                $doi = get_field('publication_doi');
                $url = get_field('publication_url');
                $pdf = get_field('publication_pdf');
                $indexed = get_field('publication_indexed');
                ?>
                
                <section class="publication__metadata">
                    
                    <?php if ($authors): ?>
                        <div class="publication__meta-item">
                            <strong><?php esc_html_e('Автори:', 'mmi-portal'); ?></strong>
                            <span><?php echo esc_html($authors); ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($journal): ?>
                        <div class="publication__meta-item">
                            <strong><?php esc_html_e('Видання:', 'mmi-portal'); ?></strong>
                            <em><?php echo esc_html($journal); ?></em>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($volume): ?>
                        <div class="publication__meta-item">
                            <strong><?php esc_html_e('Том/Випуск:', 'mmi-portal'); ?></strong>
                            <span><?php echo esc_html($volume); ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($pages): ?>
                        <div class="publication__meta-item">
                            <strong><?php esc_html_e('Сторінки:', 'mmi-portal'); ?></strong>
                            <span><?php echo esc_html($pages); ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($indexed && is_array($indexed)): ?>
                        <div class="publication__meta-item">
                            <strong><?php esc_html_e('Індексація:', 'mmi-portal'); ?></strong>
                            <div class="publication__indexed-badges">
                                <?php
                                $indexed_labels = [
                                    'scopus' => 'Scopus',
                                    'wos' => 'Web of Science',
                                    'google_scholar' => 'Google Scholar',
                                    'other' => __('Інше', 'mmi-portal'),
                                ];
                                foreach ($indexed as $index):
                                ?>
                                    <span class="publication__badge">
                                        <?php echo esc_html($indexed_labels[$index] ?? $index); ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                </section>
                
                <?php if (get_the_content()): ?>
                    <section class="publication__abstract">
                        <h2><?php esc_html_e('Анотація', 'mmi-portal'); ?></h2>
                        <div class="publication__content">
                            <?php the_content(); ?>
                        </div>
                    </section>
                <?php endif; ?>
                
                <?php if ($doi || $url || $pdf): ?>
                    <section class="publication__links">
                        <h2><?php esc_html_e('Посилання', 'mmi-portal'); ?></h2>
                        <div class="publication__links-list">
                            
                            <?php if ($doi): ?>
                                <a href="<?php echo esc_url($doi); ?>" 
                                   class="publication__link publication__link--doi"
                                   target="_blank" 
                                   rel="noopener">
                                    <span class="publication__link-icon">🔗</span>
                                    <span class="publication__link-text">DOI</span>
                                </a>
                            <?php endif; ?>
                            
                            <?php if ($url): ?>
                                <a href="<?php echo esc_url($url); ?>" 
                                   class="publication__link publication__link--url"
                                   target="_blank" 
                                   rel="noopener">
                                    <span class="publication__link-icon">🌐</span>
                                    <span class="publication__link-text">
                                        <?php esc_html_e('Веб-сторінка публікації', 'mmi-portal'); ?>
                                    </span>
                                </a>
                            <?php endif; ?>
                            
                            <?php if ($pdf): ?>
                                <a href="<?php echo esc_url($pdf['url']); ?>" 
                                   class="publication__link publication__link--pdf"
                                   download>
                                    <span class="publication__link-icon">📄</span>
                                    <span class="publication__link-text">
                                        <?php esc_html_e('Завантажити PDF', 'mmi-portal'); ?>
                                    </span>
                                </a>
                            <?php endif; ?>
                            
                        </div>
                    </section>
                <?php endif; ?>
                
            </div>
            
        </article>
        
    <?php endwhile; ?>
</main>

<?php
get_footer();
