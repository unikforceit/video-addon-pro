<?php
/**
 * Plugin Name: Video Addon Pro
 * Description: A WordPress plugin for video-related functionality.
 * Version: 1.0
 * Author: UnikForce IT
 */

if (!defined('VIDEO_ADDON_PRO_PLUGIN_DIR')) {
    define('VIDEO_ADDON_PRO_PLUGIN_DIR', plugin_dir_path(__FILE__));
}

if (!defined('VIDEO_ADDON_PRO_PLUGIN_URL')) {
    define('VIDEO_ADDON_PRO_PLUGIN_URL', plugin_dir_url(__FILE__));
}

class Video_Addon_Pro
{

    public function __construct()
    {
        // Add hooks and actions here
        add_action('init', array($this, 'init'));
    }

    public function init()
    {
        // Register Elementor widget
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles_and_scripts'));
        add_action('elementor/widgets/register', array($this, 'register_elementor_widget'));
        add_action('elementor/elements/categories_registered', array($this, 'add_elementor_widget_categories'));
    }

    public function enqueue_styles_and_scripts() {
        // Enqueue your plugin's styles
        wp_enqueue_style('video-addon-pro-styles', VIDEO_ADDON_PRO_PLUGIN_URL . 'css/style.css', array(), '1.0.0');

        // Enqueue your plugin's scripts
        wp_enqueue_script('video-addon-pro-jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), '1.0.0', true);
        wp_enqueue_script('video-addon-pro-script', VIDEO_ADDON_PRO_PLUGIN_URL . 'js/script.js', array('jQuery'), '1.0.0', true);
    }

    public function register_elementor_widget()
    {
        if (class_exists('Elementor\Widget_Base')) {
            require_once(VIDEO_ADDON_PRO_PLUGIN_DIR . 'widget/video-widget.php');
        }
    }

    public function add_elementor_widget_categories($elements_manager)
    {
        $elements_manager->add_category(
            'akira',
            [
                'title' => esc_html__('Akira', 'video-addon-pro'),
                'icon' => 'eicon-code',
            ]
        );

    }

    public function activate()
    {
        // Activation code, if needed
    }

    public function deactivate()
    {
        // Deactivation code, if needed
    }
}

$video_addon_pro = new Video_Addon_Pro();

// Activation and deactivation hooks
register_activation_hook(__FILE__, array($video_addon_pro, 'activate'));
register_deactivation_hook(__FILE__, array($video_addon_pro, 'deactivate'));