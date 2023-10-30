<?php

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function wp_title_my_filter($title, $sep)
{
    global $paged, $page;

    if (is_feed())
        return $title;

    // Add the site name.
    $title .= get_bloginfo('name');

    // Add the site description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && (is_home() || is_front_page()))
        $title = "$title $sep $site_description";

    // Add a page number if necessary.
    if ($paged >= 2 || $page >= 2)
        $title = "$title $sep " . sprintf(__('Page %s', 'testt'), max($paged, $page));

    return $title;
}
add_filter('wp_title', 'wp_title_my_filter', 10, 2);

//add css


function custom_theme_css()
{
    wp_enqueue_style('style', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'custom_theme_css');

/* Add Featured Image Support To Your WordPress Theme */
function add_featured_image_support_to_your_wordpress_theme()
{
    add_theme_support('post-thumbnails');
    add_image_size('small-thumbnail', 100, 100, true);
    add_image_size('single-post-image', 250, 250, true);
}

add_action('after_setup_theme', 'add_featured_image_support_to_your_wordpress_theme');
