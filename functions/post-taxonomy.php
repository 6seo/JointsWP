<?php

function custom_taxonomy() {
    /* $label contains parameters determining the Taxonomy’s display name
    */
    $labels = array(
        'name' => 'Creator',
        'singular' => 'Creator',
        'menu_name' => 'Creators'
    );

    /* $args declares various parameters in the custom taxonomy
    */
    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'public' => true,
        'show_admin_column' => true, 
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'creator' ),
    );

    /* register_taxonomy() to register taxonomy
    */
    register_taxonomy('creator', 'post', $args);
}

// Hook into the 'init' action
add_action( 'init', 'custom_taxonomy', 0 );