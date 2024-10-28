<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Ensure RTL stylesheet is loaded if needed
if (!function_exists('chld_thm_cfg_locale_css')):
    function chld_thm_cfg_locale_css($uri)
    {
        if (empty($uri) && is_rtl() && file_exists(get_template_directory() . '/rtl.css')) {
            $uri = get_template_directory_uri() . '/rtl.css';
        }
        return $uri;
    }
endif;
add_filter('locale_stylesheet_uri', 'chld_thm_cfg_locale_css');


if (!function_exists('child_theme_configurator_css')):
    function child_theme_configurator_css()
    {

        wp_enqueue_style('astra-parent-style', get_template_directory_uri() . '/style.css');


        wp_enqueue_style('chld_thm_cfg_child', get_stylesheet_directory_uri() . '/style.css', array('astra-parent-style'), wp_get_theme()->get('Version'));
    }
endif;
add_action('wp_enqueue_scripts', 'child_theme_configurator_css', 20);

function add_admin_link_to_menu($items, $args)
{
    if (is_user_logged_in()) {

        $admin_link = '<li><a href="' . get_admin_url() . '">Admin</a></li>';
        $items .= $admin_link;
    }
    return $items;
}

add_filter('wp_nav_menu_items', 'add_admin_link_to_menu', 10, 2);
