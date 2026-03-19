<?php
/**
 * Archive template for Lecturers
 * 
 * @package MMI_Portal
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main" class="site-main lecturers-archive">
    <div class="container">
        
        <header class="archive-header">
            <h1 class="archive-header__title">
                <?php esc_html_e('Викладачі кафедри', 'mmi-portal'); ?>
            </h1>
            <?php if (get_the_archive_description()): ?>
                <div class="archive-header__description">
                    <?php the_archive_description(); ?>
                </div>
            <?php endif; ?>
        </header>

        <?php if (have_posts()): ?>
            
            <div class="lecturers-grid">
                <?php while (have_posts()): the_post(); ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class('lecturer-card'); ?>>
                        
                        <?php if (has_post_thumbnail()): ?>
                            <div class="lecturer-card__image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('lecturer-thumbnail'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="lecturer-card__content">
                            
                            <h2 class="lecturer-card__title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            
                            <?php
                            $position = get_field('lecturer_position');
                            $degree = get_field('lecturer_degree');
                            ?>
                            
                            <?php if ($position): ?>
                                <p class="lecturer-card__position">
                                    <?php echo esc_html($position); ?>
                                </p>
                            <?php endif; ?>
                            
                            <?php if ($degree): ?>
                                <p class="lecturer-card__degree">
                                    <?php echo esc_html($degree); ?>
                                </p>
                            <?php endif; ?>
                            
                            <?php if (has_excerpt()): ?>
                                <div class="lecturer-card__excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                            <?php endif; ?>
                            
                            <a href="<?php the_permalink(); ?>" class="lecturer-card__link">
                                <?php esc_html_e('Детальніше', 'mmi-portal'); ?>
                                <span aria-hidden="true">→</span>
                            </a>
                            
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
                <p><?php esc_html_e('Викладачів не знайдено.', 'mmi-portal'); ?></p>
            </div>
            
        <?php endif; ?>
        
    </div>
</main>

<?php
get_footer();
