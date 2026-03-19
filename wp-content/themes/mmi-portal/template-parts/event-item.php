<?php
/**
 * Template part: Event item
 *
 * UPenn-style event row with date badge on the left.
 *
 * Expected $args:
 *   $args['event'] WP_Post — the event post object
 *
 * @package MMI_Portal
 */

defined('ABSPATH') || exit;

$event = $args['event'] ?? null;

if (!$event instanceof WP_Post) {
    return;
}

$event_id       = $event->ID;
$event_date     = get_field('event_date', $event_id);       // Y-m-d
$event_time     = get_field('event_time', $event_id);       // H:i
$event_end_date = get_field('event_end_date', $event_id);   // Y-m-d
$event_location = get_field('event_location', $event_id);
$event_type     = get_field('event_type', $event_id);
$event_url      = get_field('event_url', $event_id);

$permalink = get_permalink($event_id);

// Format the date badge
if ($event_date) {
    $ts    = strtotime($event_date);
    $day   = date_i18n('d', $ts);
    $month = date_i18n('M', $ts);
    $year  = date_i18n('Y', $ts);
    $iso   = date('c', $ts);
} else {
    $day = $month = $year = $iso = '';
}

$type_labels = [
    'lecture'    => __('Лекція', 'mmi-portal'),
    'seminar'    => __('Семінар', 'mmi-portal'),
    'conference' => __('Конференція', 'mmi-portal'),
    'workshop'   => __('Воркшоп', 'mmi-portal'),
    'defense'    => __('Захист', 'mmi-portal'),
    'other'      => __('Інше', 'mmi-portal'),
];
$type_label = $event_type ? ($type_labels[$event_type] ?? esc_html($event_type)) : '';

$link_href = $event_url ?: $permalink;
?>

<article class="event-item">

    <?php if ($day): ?>
        <div class="event-item__date-badge" aria-hidden="true">
            <time datetime="<?php echo esc_attr($iso); ?>">
                <span class="event-item__day"><?php echo esc_html($day); ?></span>
                <span class="event-item__month"><?php echo esc_html($month); ?></span>
            </time>
        </div>
    <?php endif; ?>

    <div class="event-item__body">
        <?php if ($type_label): ?>
            <span class="event-item__type"><?php echo esc_html($type_label); ?></span>
        <?php endif; ?>

        <h3 class="event-item__title">
            <a href="<?php echo esc_url($link_href); ?>"
               <?php if ($event_url): ?>target="_blank" rel="noopener noreferrer"<?php endif; ?>>
                <?php echo esc_html($event->post_title); ?>
            </a>
        </h3>

        <div class="event-item__meta">
            <?php if ($event_time): ?>
                <span class="event-item__time">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    <?php echo esc_html($event_time); ?>
                    <?php if ($event_end_date && $event_end_date !== $event_date): ?>
                        &ndash;
                        <?php echo esc_html(date_i18n('d M', strtotime($event_end_date))); ?>
                    <?php endif; ?>
                </span>
            <?php endif; ?>
            <?php if ($event_location): ?>
                <span class="event-item__location">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    <?php echo esc_html($event_location); ?>
                </span>
            <?php endif; ?>
        </div>
    </div>

</article>
