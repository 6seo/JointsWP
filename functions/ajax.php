<?php

// filter ---------------------------------------------------------------

add_action( 'wp_ajax_nopriv_filter', 'filter_ajax' );
add_action( 'wp_ajax_filter', 'filter_ajax' );

function filter_ajax() {

    $item_title = $_POST['item-title'];
    $item_category = $_POST['item-category'];
    $item_keywords = $_POST['item-keywords'];
    $item_order = $_POST['item-order'];
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
        'offset' => $offset,
        'post_per_page' => 12, 
        'paged' => $paged,
        'order' => 'ASC',
    );

    // pentru cautare nume 

    if(!empty($item_title)) {
        $args['s'] = $item_title;
    }

    // pentru cautare categori

    if(!empty($item_category)) {
        $args['tax_query'] = array(
            array( 
              'taxonomy' => 'category',
              'field' => 'term_id',
              'terms' => array($item_category)            
            )
        );
    }

    // dupa order Alfabetica si vizualizari

    if(!empty($item_order)) {
        $order_param = '';
        
        if($item_order == 'Alphabetical') {
            $args['orderby'] = 'title';
            $args['order'] = 'ASC';

        } elseif($item_order == 'Popularity') {
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'item_rating';
            $args['order'] = 'DESC';
        }

        else {
            $args['orderby'] = 'date';
            $args['order'] = 'ASC';
        }
    }

    // pentru cautare keywords (tags)

    if(!empty($item_keywords)) {
        $args['tax_query'] = array(
            array(
            
                'taxonomy' => 'post_tag',
                'field' => $term_id,
                'terms' => $item_keywords
            ) 
        );
    }
    
    $query = new WP_Query($args);

// The Loop
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post(); 
        
        get_template_part( 'parts/loop', 'archive-grid-card' );
	}
} else {
	echo "<h3>not found</h3>";// no posts found
}

// Restore original Post Data
wp_reset_postdata();
 die();
}


// Load More posts --------------------------------------------------------------

function misha_loadmore_ajax_handler(){
 
	// prepare our arguments for the query
	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish';
 
	// it is always better to use WP_Query but not here
	//query_posts( $args );
 
    $query = new WP_Query($args);

	if( $query->have_posts() ) :
 
		// run the loop
		while( $query->have_posts() ): $query->the_post();
 
			// look into your theme code how the posts are inserted, but you can use your own HTML of course
			// do you remember? - my example is adapted for Twenty Seventeen theme
			get_template_part( 'parts/loop', 'archive-grid' );
			// for the test purposes comment the line above and uncomment the below one
			// the_title();
 
 
		endwhile;
        
	endif;
	die; // here we exit the script and even no wp_reset_query() required!
}
 
 
 
add_action('wp_ajax_loadmore', 'misha_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'misha_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}