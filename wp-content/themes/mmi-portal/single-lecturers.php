<?php
/**
 * Single template for Lecturers
 * 
 * @package MMI_Portal
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main" class="site-main lecturer-single">
    <?php while (have_posts()): the_post(); ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class('lecturer'); ?>>
            
            <div class="container">
                
                <header class="lecturer__header">
                    <div class="lecturer__header-content">
                        
                        <?php if (has_post_thumbnail()): ?>
                            <div class="lecturer__photo">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="lecturer__info">
                            <h1 class="lecturer__title"><?php the_title(); ?></h1>
                            
                            <?php
                            $position = get_field('lecturer_position');
                            $degree = get_field('lecturer_degree');
                            $email = get_field('lecturer_email');
                            $phone = get_field('lecturer_phone');
                            $office = get_field('lecturer_office');
                            ?>
                            
                            <?php if ($position): ?>
                                <p class="lecturer__position"><?php echo esc_html($position); ?></p>
                            <?php endif; ?>
                            
                            <?php if ($degree): ?>
                                <p class="lecturer__degree"><?php echo esc_html($degree); ?></p>
                            <?php endif; ?>
                            
                            <div class="lecturer__contacts">
                                <?php if ($email): ?>
                                    <p class="lecturer__email">
                                        <strong><?php esc_html_e('Email:', 'mmi-portal'); ?></strong>
                                        <a href="mailto:<?php echo esc_attr($email); ?>">
                                            <?php echo esc_html($email); ?>
                                        </a>
                                    </p>
                                <?php endif; ?>
                                
                                <?php if ($phone): ?>
                                    <p class="lecturer__phone">
                                        <strong><?php esc_html_e('Телефон:', 'mmi-portal'); ?></strong>
                                        <?php echo esc_html($phone); ?>
                                    </p>
                                <?php endif; ?>
                                
                                <?php if ($office): ?>
                                    <p class="lecturer__office">
                                        <strong><?php esc_html_e('Кабінет:', 'mmi-portal'); ?></strong>
                                        <?php echo esc_html($office); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                            
                            <?php
                            $google_scholar = get_field('lecturer_google_scholar');
                            $orcid = get_field('lecturer_orcid');
                            $scopus = get_field('lecturer_scopus');
                            
                            if ($google_scholar || $orcid || $scopus):
                            ?>
                                <div class="lecturer__scholar-links">
                                    <p><strong><?php esc_html_e('Наукові профілі:', 'mmi-portal'); ?></strong></p>
                                    <div class="lecturer__scholar-buttons">
                                        <?php if ($google_scholar): ?>
                                            <a href="<?php echo esc_url($google_scholar); ?>" 
                                               class="lecturer__scholar-link" 
                                               target="_blank" 
                                               rel="noopener">
                                                Google Scholar
                                            </a>
                                        <?php endif; ?>
                                        
                                        <?php if ($orcid): ?>
                                            <a href="<?php echo esc_url($orcid); ?>" 
                                               class="lecturer__scholar-link" 
                                               target="_blank" 
                                               rel="noopener">
                                                ORCID
                                            </a>
                                        <?php endif; ?>
                                        
                                        <?php if ($scopus): ?>
                                            <a href="<?php echo esc_url($scopus); ?>" 
                                               class="lecturer__scholar-link" 
                                               target="_blank" 
                                               rel="noopener">
                                                Scopus
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                        </div>
                        
                    </div>
                </header>
                
                <?php if (get_the_content()): ?>
                    <div class="lecturer__bio">
                        <h2><?php esc_html_e('Біографія', 'mmi-portal'); ?></h2>
                        <?php the_content(); ?>
                    </div>
                <?php endif; ?>
                
                <?php
                $courses = mmi_get_lecturer_courses(get_the_ID());
                if (!empty($courses)):
                ?>
                    <section class="lecturer__courses">
                        <h2><?php esc_html_e('Викладає курси', 'mmi-portal'); ?></h2>
                        <div class="courses-list courses-list--compact">
                            <?php foreach ($courses as $course): ?>
                                <article class="course-card course-card--compact">
                                    <h3 class="course-card__title">
                                        <a href="<?php echo esc_url(get_permalink($course)); ?>">
                                            <?php echo esc_html($course->post_title); ?>
                                        </a>
                                    </h3>
                                    <?php
                                    $credits = get_field('course_credits', $course->ID);
                                    $edu_level = get_field('course_edu_level', $course->ID);
                                    ?>
                                    <div class="course-card__meta">
                                        <?php if ($credits): ?>
                                            <span><?php echo esc_html($credits); ?> ECTS</span>
                                        <?php endif; ?>
                                        <?php if ($edu_level): ?>
                                            <span>
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
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>
                
                <?php
                $publications = mmi_get_lecturer_publications(get_the_ID());
                if (!empty($publications)):
                ?>
                    <section class="lecturer__publications">
                        <h2><?php esc_html_e('Публікації', 'mmi-portal'); ?></h2>
                        <div class="publications-list publications-list--compact">
                            <?php foreach ($publications as $publication): ?>
                                <article class="publication-card publication-card--compact">
                                    <?php
                                    $year = get_field('publication_year', $publication->ID);
                                    $authors = get_field('publication_authors', $publication->ID);
                                    $doi = get_field('publication_doi', $publication->ID);
                                    ?>
                                    
                                    <?php if ($year): ?>
                                        <span class="publication-card__year"><?php echo esc_html($year); ?></span>
                                    <?php endif; ?>
                                    
                                    <h3 class="publication-card__title">
                                        <a href="<?php echo esc_url(get_permalink($publication)); ?>">
                                            <?php echo esc_html($publication->post_title); ?>
                                        </a>
                                    </h3>
                                    
                                    <?php if ($authors): ?>
                                        <p class="publication-card__authors"><?php echo esc_html($authors); ?></p>
                                    <?php endif; ?>
                                    
                                    <?php if ($doi): ?>
                                        <a href="<?php echo esc_url($doi); ?>" 
                                           class="publication-card__doi" 
                                           target="_blank" 
                                           rel="noopener">
                                            DOI
                                        </a>
                                    <?php endif; ?>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>
                
            </div>
            
        </article>
        
    <?php endwhile; ?>
</main>

<?php
get_footer();
