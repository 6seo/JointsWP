<?php

function item_category(){

    global $post;

    $categories = get_the_category();

    // Set up our array to store our top level ID's
    $top_level_ids = [];

    // Set up our array to store our top level ID's
$top_level_ids = [];
// Loop for the sole purpose of figuring out the top_level_ids
foreach( $categories as $category ) {
    if( ! $category->parent ) {
        $top_level_ids[] = $category->term_id;
    }
}

    foreach( $categories as $category ) {
        if ( $category->parent == 1 ) { // ... if the category has no parent
            echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'jointswp' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>';
        };
    };
    
    // Now we can loop again, and ONLY output terms who's parent are in the top-level id's (aka, second-level categories)
    foreach( $categories as $category ) {
        // Only output if the parent_id is a TOP level id
        if( in_array( $category->parent_id, $top_level_ids )) {
            echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'jointswp' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>';
        }
    }
}

function item_author () {
    global $post;
    $categories = get_the_terms( $post->ID, 'creator' );
    // now you can view your category in array:
    // using var_dump( $categories );
    // or you can take all with foreach:
    foreach( $categories as $category ) {
        echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'jointswp' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>';
    }
}