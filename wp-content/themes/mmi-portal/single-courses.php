<?php
/**
 * Single template for Courses
 * 
 * @package MMI_Portal
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main" class="site-main course-single">
    <?php while (have_posts()): the_post(); ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class('course'); ?>>
            
            <div class="container">
                
                <header class="course__header">
                    <h1 class="course__title"><?php the_title(); ?></h1>
                    
                    <?php
                    $course_code = get_field('course_code');
                    $credits = get_field('course_credits');
                    $edu_level = get_field('course_edu_level');
                    $semester = get_field('course_semester');
                    ?>
                    
                    <div class="course__meta">
                        <?php if ($course_code): ?>
                            <span class="course__code">
                                <strong><?php esc_html_e('Код курсу:', 'mmi-portal'); ?></strong>
                                <?php echo esc_html($course_code); ?>
                            </span>
                        <?php endif; ?>
                        
                        <?php if ($credits): ?>
                            <span class="course__credits">
                                <strong><?php esc_html_e('Кредити:', 'mmi-portal'); ?></strong>
                                <?php echo esc_html($credits); ?> ECTS
                            </span>
                        <?php endif; ?>
                        
                        <?php if ($edu_level): ?>
                            <span class="course__level">
                                <strong><?php esc_html_e('Рівень:', 'mmi-portal'); ?></strong>
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
                        
                        <?php if ($semester): ?>
                            <span class="course__semester">
                                <strong><?php esc_html_e('Семестр:', 'mmi-portal'); ?></strong>
                                <?php
                                printf(
                                    /* translators: %s: Semester number */
                                    esc_html__('%s семестр', 'mmi-portal'),
                                    esc_html($semester)
                                );
                                ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </header>
                
                <?php
                $lecturer = mmi_get_course_lecturer(get_the_ID());
                if ($lecturer):
                ?>
                    <section class="course__lecturer">
                        <h2><?php esc_html_e('Викладач', 'mmi-portal'); ?></h2>
                        <div class="lecturer-card lecturer-card--inline">
                            <?php if (has_post_thumbnail($lecturer->ID)): ?>
                                <div class="lecturer-card__image">
                                    <a href="<?php echo esc_url(get_permalink($lecturer)); ?>">
                                        <?php echo get_the_post_thumbnail($lecturer->ID, 'lecturer-thumbnail'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="lecturer-card__content">
                                <h3 class="lecturer-card__title">
                                    <a href="<?php echo esc_url(get_permalink($lecturer)); ?>">
                                        <?php echo esc_html($lecturer->post_title); ?>
                                    </a>
                                </h3>
                                
                                <?php
                                $position = get_field('lecturer_position', $lecturer->ID);
                                $degree = get_field('lecturer_degree', $lecturer->ID);
                                $email = get_field('lecturer_email', $lecturer->ID);
                                ?>
                                
                                <?php if ($position): ?>
                                    <p class="lecturer-card__position"><?php echo esc_html($position); ?></p>
                                <?php endif; ?>
                                
                                <?php if ($degree): ?>
                                    <p class="lecturer-card__degree"><?php echo esc_html($degree); ?></p>
                                <?php endif; ?>
                                
                                <?php if ($email): ?>
                                    <p class="lecturer-card__email">
                                        <a href="mailto:<?php echo esc_attr($email); ?>">
                                            <?php echo esc_html($email); ?>
                                        </a>
                                    </p>
                                <?php endif; ?>
                                
                                <a href="<?php echo esc_url(get_permalink($lecturer)); ?>" 
                                   class="lecturer-card__link">
                                    <?php esc_html_e('Детальніше про викладача', 'mmi-portal'); ?>
                                    <span aria-hidden="true">→</span>
                                </a>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>
                
                <?php if (get_the_content()): ?>
                    <section class="course__description">
                        <h2><?php esc_html_e('Опис курсу', 'mmi-portal'); ?></h2>
                        <div class="course__content">
                            <?php the_content(); ?>
                        </div>
                    </section>
                <?php endif; ?>
                
                <?php
                $syllabus = get_field('course_syllabus');
                $moodle_link = get_field('course_moodle_link');
                
                if ($syllabus || $moodle_link):
                ?>
                    <section class="course__resources">
                        <h2><?php esc_html_e('Ресурси', 'mmi-portal'); ?></h2>
                        <div class="course__resources-list">
                            <?php if ($syllabus): ?>
                                <a href="<?php echo esc_url($syllabus['url']); ?>" 
                                   class="course__resource-link course__resource-link--pdf"
                                   download>
                                    <span class="course__resource-icon">📄</span>
                                    <span class="course__resource-text">
                                        <?php esc_html_e('Завантажити силабус (PDF)', 'mmi-portal'); ?>
                                    </span>
                                </a>
                            <?php endif; ?>
                            
                            <?php if ($moodle_link): ?>
                                <a href="<?php echo esc_url($moodle_link); ?>" 
                                   class="course__resource-link course__resource-link--moodle"
                                   target="_blank" 
                                   rel="noopener">
                                    <span class="course__resource-icon">🎓</span>
                                    <span class="course__resource-text">
                                        <?php esc_html_e('Курс на Moodle', 'mmi-portal'); ?>
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
