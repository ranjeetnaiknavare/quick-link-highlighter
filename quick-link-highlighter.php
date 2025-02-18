<?php
/*
Plugin Name: Quick Link Highlighter
Description: A lightweight plugin to highlight external links in posts, pages, and custom post types.
Version: 1.0
Author: Your Name
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Enqueue CSS for highlighting
function qlh_enqueue_styles() {
    wp_enqueue_style('qlh-styles', plugin_dir_url(__FILE__) . 'assets/css/styles.css');
}
add_action('wp_enqueue_scripts', 'qlh_enqueue_styles');

// Function to detect and modify external links
function qlh_highlight_external_links($content) {
    // Regex to find all <a> tags
    $pattern = '/<a(.*?)href="(.*?)"(.*?)>(.*?)<\/a>/i';

    // Callback function to process each link
    $content = preg_replace_callback($pattern, function($matches) {
        $link = $matches[0]; // Full link
        $url = $matches[2];  // URL part

        // Check if the link is external
        if (strpos($url, home_url()) === false && strpos($url, 'http') === 0) {
            // Add a class to the external link
            $link = str_replace('<a', '<a class="qlh-external-link"', $link);
        }

        return $link;
    }, $content);

    return $content;
}

// Apply the function to the content
add_filter('the_content', 'qlh_highlight_external_links');
function qlh_enqueue_scripts() {
    wp_enqueue_script('qlh-script', plugin_dir_url(__FILE__) . 'assets/js/script.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'qlh_enqueue_scripts');