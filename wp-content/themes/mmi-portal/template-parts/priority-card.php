<?php
/**
 * Template part: Priority / Quick-access card
 *
 * UPenn-style image card with dark overlay and white title.
 *
 * Expected $args:
 *   $args['title'] string — card heading (required)
 *   $args['url']   string — destination link
 *   $args['image'] string — image URL
 *   $args['desc']  string — short description (optional)
 *   $args['icon']  string — SVG icon string (optional)
 *
 * @package MMI_Portal
 */

defined('ABSPATH') || exit;

$title = $args['title'] ?? '';
$url   = $args['url']   ?? '#';
$image = $args['image'] ?? '';
$desc  = $args['desc']  ?? '';
$icon  = $args['icon']  ?? '';

if (empty($title)) {
    return;
}
?>

<a href="<?php echo esc_url($url); ?>" class="priority-card">

    <div class="priority-card__bg"
         <?php if ($image): ?>style="background-image: url(<?php echo esc_url($image); ?>)"<?php endif; ?>>
    </div>
    <div class="priority-card__overlay" aria-hidden="true"></div>

    <div class="priority-card__content">
        <?php if ($icon): ?>
            <div class="priority-card__icon" aria-hidden="true">
                <?php echo $icon; // already escaped SVG ?>
            </div>
        <?php endif; ?>

        <h3 class="priority-card__title"><?php echo esc_html($title); ?></h3>

        <?php if ($desc): ?>
            <p class="priority-card__desc"><?php echo esc_html($desc); ?></p>
        <?php endif; ?>

        <span class="priority-card__arrow" aria-hidden="true">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </span>
    </div>

</a>
