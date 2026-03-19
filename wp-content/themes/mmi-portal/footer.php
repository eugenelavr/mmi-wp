<?php
/**
 * MMI Portal — Footer template
 *
 * @package MMI_Portal
 */

$telegram  = mmi_option('telegram_url', 'https://t.me/mmi_kpi');
$facebook  = mmi_option('facebook_url', '');
$address   = mmi_option('contact_address', 'пр. Берестейський, 37, корп. 35, Київ, 03056');
$email     = mmi_option('contact_email', 'mmi@kpi.ua');
$phone     = mmi_option('contact_phone', '');
$maps_url  = mmi_option('contact_maps_url', '');
?>

</div><!-- #content -->

<footer class="site-footer" id="site-footer" role="contentinfo">

    <div class="site-footer__main">
        <div class="container">
            <div class="site-footer__grid">

                <!-- Column 1: Identity -->
                <div class="site-footer__col site-footer__col--identity">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-footer__logo" rel="home">
                        <span class="site-footer__logo-abbr">ММІ</span>
                    </a>
                    <p class="site-footer__tagline">
                        <?php esc_html_e('Механіко-машинобудівний інститут', 'mmi-portal'); ?>
                    </p>
                    <a href="https://kpi.ua"
                       class="site-footer__kpi-link"
                       target="_blank"
                       rel="noopener noreferrer">
                        <?php esc_html_e('КПІ ім. Ігоря Сікорського', 'mmi-portal'); ?>
                    </a>
                </div>

                <!-- Column 2: Navigation -->
                <div class="site-footer__col">
                    <h3 class="site-footer__col-title">
                        <?php esc_html_e('Навігація', 'mmi-portal'); ?>
                    </h3>
                    <?php if (has_nav_menu('footer')): ?>
                        <?php wp_nav_menu([
                            'theme_location' => 'footer',
                            'menu_class'     => 'footer-menu',
                            'container'      => false,
                            'depth'          => 1,
                            'fallback_cb'    => false,
                        ]); ?>
                    <?php else: ?>
                        <ul class="footer-menu">
                            <li><a href="<?php echo esc_url(home_url('/lecturers/')); ?>"><?php esc_html_e('Викладачі', 'mmi-portal'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/courses/')); ?>"><?php esc_html_e('Курси', 'mmi-portal'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/publications/')); ?>"><?php esc_html_e('Публікації', 'mmi-portal'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/news/')); ?>"><?php esc_html_e('Новини', 'mmi-portal'); ?></a></li>
                        </ul>
                    <?php endif; ?>
                </div>

                <!-- Column 3: Contacts -->
                <div class="site-footer__col">
                    <h3 class="site-footer__col-title">
                        <?php esc_html_e('Контакти', 'mmi-portal'); ?>
                    </h3>
                    <address class="site-footer__address">
                        <?php if ($address): ?>
                            <p class="site-footer__address-line">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                <?php echo esc_html($address); ?>
                            </p>
                        <?php endif; ?>
                        <?php if ($email): ?>
                            <p class="site-footer__address-line">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                            </p>
                        <?php endif; ?>
                        <?php if ($phone): ?>
                            <p class="site-footer__address-line">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13 19.79 19.79 0 0 1 1.61 4.48 2 2 0 0 1 3.58 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.08 6.08l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a>
                            </p>
                        <?php endif; ?>
                        <?php if ($maps_url): ?>
                            <p class="site-footer__address-line">
                                <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener noreferrer">
                                    <?php esc_html_e('Показати на карті →', 'mmi-portal'); ?>
                                </a>
                            </p>
                        <?php endif; ?>
                    </address>
                </div>

                <!-- Column 4: Social + language -->
                <div class="site-footer__col">
                    <h3 class="site-footer__col-title">
                        <?php esc_html_e('Слідкуйте за нами', 'mmi-portal'); ?>
                    </h3>
                    <div class="site-footer__social">
                        <?php if ($telegram): ?>
                            <a href="<?php echo esc_url($telegram); ?>"
                               class="social-link social-link--telegram"
                               target="_blank"
                               rel="noopener noreferrer"
                               aria-label="Telegram">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 8.221-1.97 9.28c-.145.658-.537.818-1.084.508l-3-2.21-1.447 1.394c-.16.16-.295.295-.605.295l.213-3.053 5.56-5.023c.242-.213-.054-.333-.373-.12l-6.871 4.326-2.962-.924c-.643-.204-.657-.643.136-.953l11.57-4.461c.537-.194 1.006.131.833.941z"/>
                                </svg>
                            </a>
                        <?php endif; ?>
                        <?php if ($facebook): ?>
                            <a href="<?php echo esc_url($facebook); ?>"
                               class="social-link social-link--facebook"
                               target="_blank"
                               rel="noopener noreferrer"
                               aria-label="Facebook">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                        <?php endif; ?>
                        <a href="<?php echo esc_url(get_feed_link()); ?>"
                           class="social-link social-link--rss"
                           target="_blank"
                           rel="noopener noreferrer"
                           aria-label="RSS">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M6.18 15.64a2.18 2.18 0 0 1 2.18 2.18C8.36 19.01 7.38 20 6.18 20C4.98 20 4 19.01 4 17.82a2.18 2.18 0 0 1 2.18-2.18M4 4.44A15.56 15.56 0 0 1 19.56 20h-2.83A12.73 12.73 0 0 0 4 7.27V4.44m0 5.66a9.9 9.9 0 0 1 9.9 9.9h-2.83A7.07 7.07 0 0 0 4 12.93V10.1z"/>
                            </svg>
                        </a>
                    </div>

                    <?php if (function_exists('pll_the_languages')): ?>
                        <div class="lang-switcher lang-switcher--footer">
                            <p class="site-footer__col-label">
                                <?php esc_html_e('Мова:', 'mmi-portal'); ?>
                            </p>
                            <?php pll_the_languages([
                                'show_names'       => 1,
                                'display_names_as' => 'name',
                                'hide_if_empty'    => 0,
                            ]); ?>
                        </div>
                    <?php endif; ?>
                </div>

            </div><!-- .site-footer__grid -->
        </div><!-- .container -->
    </div><!-- .site-footer__main -->

    <!-- Bottom legal bar -->
    <div class="site-footer__bottom">
        <div class="container">
            <p class="site-footer__copyright">
                <?php
                printf(
                    /* translators: %s: year */
                    esc_html__('© %s Механіко-машинобудівний інститут КПІ ім. Ігоря Сікорського. Усі права захищено.', 'mmi-portal'),
                    esc_html(date_i18n('Y'))
                );
                ?>
            </p>
            <nav class="site-footer__legal-nav" aria-label="<?php esc_attr_e('Правова навігація', 'mmi-portal'); ?>">
                <a href="#"><?php esc_html_e('Конфіденційність', 'mmi-portal'); ?></a>
                <a href="#"><?php esc_html_e('Доступність', 'mmi-portal'); ?></a>
                <a href="https://kpi.ua" target="_blank" rel="noopener noreferrer">kpi.ua</a>
            </nav>
        </div>
    </div><!-- .site-footer__bottom -->

</footer><!-- .site-footer -->

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
