<?php
if (!defined('ABSPATH')) exit;

function magna_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array('search-form','comment-form','comment-list','gallery','caption','style','script'));
    register_nav_menus(array('primary' => __('Primary Menu', 'magna-tech')));
}
add_action('after_setup_theme', 'magna_theme_setup');

function magna_enqueue_assets() {
    wp_enqueue_style('magna-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap', array(), null);
    wp_enqueue_style('magna-style', get_stylesheet_uri(), array('magna-fonts'), '1.0.0');
    wp_enqueue_script('magna-script', get_template_directory_uri() . '/assets/main.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'magna_enqueue_assets');

function magna_theme_logo() {
    if (has_custom_logo()) {
        the_custom_logo();
        return;
    }
    echo '<a class="brand" href="' . esc_url(home_url('/')) . '" aria-label="MAGNA Tech home"><img src="' . esc_url(get_template_directory_uri() . '/assets/magna-header-logo.png') . '" alt="MAGNA Tech"></a>';
}

function magna_fallback_services() {
    return array(
        array('Website Design & Development','Purpose-built websites that bring strong design, clear content and dependable development together.'),
        array('Redesign & Modernization','A thoughtful reset for websites that no longer reflect the quality or direction of the business.'),
        array('Website Maintenance','Ongoing care, updates and technical support to keep your website secure, current and reliable.'),
        array('Digital Marketing','Focused digital campaigns designed around your audience, offer and wider business goals.'),
        array('Social Media Management','Consistent planning and content management for a credible, active social presence.'),
        array('Digital Growth Solutions','Connected improvements across your website and marketing that support sustainable online growth.'),
    );
}

function magna_fallback_projects() {
    return array(
        array('Launch something new','A complete website shaped from strategy and structure through design, development and launch.',array('Strategy','Design','Development')),
        array('Modernize what exists','A considered redesign that improves credibility, usability, performance and maintainability.',array('Audit','Redesign','Migration')),
        array('Build momentum','Ongoing maintenance and digital marketing aligned around steady improvement.',array('Support','Marketing','Growth')),
    );
}
