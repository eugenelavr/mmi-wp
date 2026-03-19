<?php
/**
 * Template part: News card
 *
 * Expected variables (set before get_template_part via set_query_var or $args):
 *   $args['post']    WP_Post — the post object
 *   $args['variant'] string  — 'featured' | 'compact' | '' (default compact)
 *
 * @package MMI_Portal
 */

defined('ABSPATH') || exit;

$post_obj = $args['post'] ?? null;
$variant  = $args['variant'] ?? '';

if (!$post_obj instanceof WP_Post) {
    return;
}

$post_id    = $post_obj->ID;
$permalink  = get_permalink($post_id);
$title      = get_the_title($post_id);
$date_iso   = get_the_date('c', $post_id);
$date_label = get_the_date('', $post_id);
$categories = get_the_category($post_id);
$cat        = !empty($categories) ? $categories[0] : null;

$card_classes = 'news-card';
if ($variant) {
    $card_classes .= ' news-card--' . esc_attr($variant);
}

$thumb_size = ($variant === 'featured') ? 'news-featured' : 'news-card-thumb';

// Build data-categories attribute for JS tab filtering
$cat_slugs = array_map(fn(WP_Term $c): string => $c->slug, $categories);
$data_cats  = implode(',', $cat_slugs);
?>

<article class="<?php echo esc_attr($card_classes); ?>"
         data-categories="<?php echo esc_attr($data_cats); ?>">

    <?php if (has_post_thumbnail($post_id)): ?>
        <a href="<?php echo esc_url($permalink); ?>" class="news-card__image-wrap" tabindex="-1" aria-hidden="true">
            <div class="news-card__image">
                <?php echo get_the_post_thumbnail($post_id, $thumb_size, ['alt' => '']); ?>
            </div>
        </a>
    <?php endif; ?>

    <div class="news-card__body">
        <?php if ($cat): ?>
            <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"
               class="news-card__category">
                <?php echo esc_html($cat->name); ?>
            </a>
        <?php endif; ?>

        <h3 class="news-card__title">
            <a href="<?php echo esc_url($permalink); ?>">
                <?php echo esc_html($title); ?>
            </a>
        </h3>

        <?php if ($variant === 'featured'): ?>
            <p class="news-card__excerpt">
                <?php echo esc_html(wp_trim_words(get_the_excerpt($post_id), 25, '...')); ?>
            </p>
        <?php endif; ?>

        <time class="news-card__date" datetime="<?php echo esc_attr($date_iso); ?>">
            <?php echo esc_html($date_label); ?>
        </time>
    </div>

</article>
