<?php
/**
 * Archive template for Courses
 * 
 * @package MMI_Portal
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main" class="site-main courses-archive">
    <div class="container">
        
        <header class="archive-header">
            <h1 class="archive-header__title">
                <?php esc_html_e('Навчальні курси', 'mmi-portal'); ?>
            </h1>
            <?php if (get_the_archive_description()): ?>
                <div class="archive-header__description">
                    <?php the_archive_description(); ?>
                </div>
            <?php endif; ?>
        </header>

        <?php if (have_posts()): ?>
            
            <div class="courses-list">
                <?php while (have_posts()): the_post(); ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class('course-card'); ?>>
                        
                        <div class="course-card__content">
                            
                            <div class="course-card__header">
                                
                                <h2 class="course-card__title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>
                                
                                <?php
                                $course_code = get_field('course_code');
                                $credits = get_field('course_credits');
                                $edu_level = get_field('course_edu_level');
                                ?>
                                
                                <div class="course-card__meta">
                                    <?php if ($course_code): ?>
                                        <span class="course-card__code">
                                            <?php echo esc_html($course_code); ?>
                                        </span>
                                    <?php endif; ?>
                                    
                                    <?php if ($credits): ?>
                                        <span class="course-card__credits">
                                            <?php
                                            printf(
                                                /* translators: %s: Number of ECTS credits */
                                                esc_html__('%s кредитів ECTS', 'mmi-portal'),
                                                number_format_i18n($credits, 1)
                                            );
                                            ?>
                                        </span>
                                    <?php endif; ?>
                                    
                                    <?php if ($edu_level): ?>
                                        <span class="course-card__level">
                                            <?php
                                            $levels = [
                                                'bachelor' => __('Бакалавр', 'mmi-portal'),
                                                'master'   => __('Магістр', 'mmi-portal'),
                                                'phd'      => __('Аспірантура', 'mmi-portal'),
                                            ];
                                            echo esc_html($levels[$edu_level] ?? $edu_level);
                                            ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                
                            </div>
                            
                            <?php if (has_excerpt()): ?>
                                <div class="course-card__excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php
                            $lecturer = mmi_get_course_lecturer(get_the_ID());
                            if ($lecturer):
                            ?>
                                <div class="course-card__lecturer">
                                    <span class="course-card__lecturer-label">
                                        <?php esc_html_e('Викладач:', 'mmi-portal'); ?>
                                    </span>
                                    <a href="<?php echo esc_url(get_permalink($lecturer)); ?>">
                                        <?php echo esc_html($lecturer->post_title); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <a href="<?php the_permalink(); ?>" class="course-card__link">
                                <?php esc_html_e('Детальніше про курс', 'mmi-portal'); ?>
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
                <p><?php esc_html_e('Курсів не знайдено.', 'mmi-portal'); ?></p>
            </div>
            
        <?php endif; ?>
        
    </div>
</main>

<?php
get_footer();
