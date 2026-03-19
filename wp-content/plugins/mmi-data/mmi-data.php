<?php
/**
 * Plugin Name: MMI Data Architecture
 * Plugin URI: https://mmi.kpi.ua
 * Description: Custom Post Types and ACF Field Groups for ММІ KPI portal (Lecturers, Courses, Publications, Events)
 * Version: 1.1.0
 * Author: MMI Development Team
 * Text Domain: mmi-portal
 * Domain Path: /languages
 * Requires PHP: 8.3
 */

defined('ABSPATH') || exit;

/**
 * Main plugin class
 */
class MMI_Data_Plugin {
    
    private static $instance = null;
    
    public static function instance(): self {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        add_action('init', [$this, 'register_post_types']);
        add_action('acf/init', [$this, 'register_acf_fields']);
    }
    
    /**
     * Register Custom Post Types
     */
    public function register_post_types(): void {
        require_once __DIR__ . '/includes/post-types/lecturers.php';
        require_once __DIR__ . '/includes/post-types/courses.php';
        require_once __DIR__ . '/includes/post-types/publications.php';
        require_once __DIR__ . '/includes/post-types/events.php';
    }
    
    /**
     * Register ACF Field Groups
     */
    public function register_acf_fields(): void {
        if (!function_exists('acf_add_local_field_group')) {
            return;
        }
        
        require_once __DIR__ . '/includes/acf/lecturers-fields.php';
        require_once __DIR__ . '/includes/acf/courses-fields.php';
        require_once __DIR__ . '/includes/acf/publications-fields.php';
        require_once __DIR__ . '/includes/acf/events-fields.php';
    }
}

MMI_Data_Plugin::instance();
