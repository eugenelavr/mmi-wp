<?php
/**
 * Template part: Hero section
 *
 * Reads settings from ACF options page. Falls back to sensible defaults.
 *
 * @package MMI_Portal
 */

defined('ABSPATH') || exit;

$hero_image    = mmi_option('hero_image', []);
$hero_label    = mmi_option('hero_label', '');
$hero_title    = mmi_option('hero_title', get_bloginfo('name'));
$hero_subtitle = mmi_option('hero_subtitle', __('Механіко-машинобудівний інститут КПІ ім. Ігоря Сікорського', 'mmi-portal'));
$hero_cta_text = mmi_option('hero_cta_text', __('Дізнатись більше', 'mmi-portal'));
$hero_cta_url  = mmi_option('hero_cta_url', home_url('/about/'));

$hero_image_url = is_array($hero_image) && !empty($hero_image['url']) ? $hero_image['url'] : '';
$style_attr     = $hero_image_url ? ' style="background-image: url(' . esc_url($hero_image_url) . ')"' : '';
?>

<section class="hero<?php echo $hero_image_url ? ' hero--has-image' : ''; ?>"<?php echo $style_attr; ?>>
    <div class="hero__overlay" aria-hidden="true"></div>
    <div class="hero__content container">

        <?php if ($hero_label): ?>
            <span class="hero__label"><?php echo esc_html($hero_label); ?></span>
        <?php endif; ?>

        <h1 class="hero__title"><?php echo esc_html($hero_title); ?></h1>

        <?php if ($hero_subtitle): ?>
            <p class="hero__subtitle"><?php echo esc_html($hero_subtitle); ?></p>
        <?php endif; ?>

        <div class="hero__actions">
            <?php if ($hero_cta_url): ?>
                <a href="<?php echo esc_url($hero_cta_url); ?>" class="btn btn--primary">
                    <?php echo esc_html($hero_cta_text ?: __('Дізнатись більше', 'mmi-portal')); ?>
                </a>
            <?php endif; ?>
            <a href="<?php echo esc_url(home_url('/lecturers/')); ?>" class="btn btn--outline">
                <?php esc_html_e('Наші викладачі', 'mmi-portal'); ?>
            </a>
        </div>

    </div>
</section>
