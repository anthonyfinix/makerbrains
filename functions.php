<?php

add_action('wp_enqueue_scripts', 'estore_child_enqueue_main_styles');
function estore_child_enqueue_main_styles()
{
    $parenthandle = 'estore-style';
    $theme        = wp_get_theme();
    wp_enqueue_style(
        $parenthandle,
        get_template_directory_uri() . '/style.css',
        array(),  // If the parent theme code has a dependency, copy it to here.
        $theme->parent()->get('Version')
    );
    wp_enqueue_style(
        'child-style',
        get_stylesheet_uri(),
        array($parenthandle),
        $theme->get('Version') // This only works if you have Version defined in the style header.
    );
}

function estore_child_enqueue_main_search_scripts()
{
    wp_enqueue_script('ajax-search', get_stylesheet_directory_uri() . '/js/ajax-search.js', array('jquery'), '1.0', true);
    wp_localize_script('ajax-search', 'ajax_search_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}

add_action('wp_enqueue_scripts', 'estore_child_enqueue_main_search_scripts');

function ajax_search()
{
    $search = sanitize_text_field($_POST['search']);
    $args = array(
        'post_type' => 'product',        // Query WooCommerce products
        's' => $search,                  // Search for the provided term
        'posts_per_page' => -1,          // Display all matching products
        'orderby' => 'title',            // Order the results by title (you can change this if needed)
        'order' => 'ASC'                 // Sort in ascending order
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $product_id = get_the_ID();
            $product_title = get_the_title();
            $product_excerpt = get_the_excerpt();
            $product_thumbnail = get_the_post_thumbnail($product_id, 'thumbnail');
            // Output search results here
            echo '<div class="search-result mx-3 mb-4">';
            echo '<a class="search-result-thumbnail" href="' . get_permalink() . '">' . $product_thumbnail . '</a>';
            echo '<div class="search-result-details-wrapper">';
            echo '<a class="search-result-title" href="' . get_permalink() . '"><p class="mb-0">' . $product_title . '</p></a>';
            echo '<small class="search-result-excerpt">' . $product_excerpt . '</small>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo 'No results found.';
    }


    wp_die(); // This is essential to end the AJAX request properly.
}
add_action('wp_ajax_ajax_search', 'ajax_search');
add_action('wp_ajax_nopriv_ajax_search', 'ajax_search');
