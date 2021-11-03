<?php

/**
 * Display category image as a Hero on category archive
 */
add_action( 'woocommerce_archive_description', 'woocommerce_category_image', 2 );
function woocommerce_category_image() {
    if ( is_product_category() ){
	    global $wp_query;
	    $cat = $wp_query->get_queried_object();
	    $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
	    if ( $thumbnail_id ) {
		    echo wp_get_attachment_image( $thumbnail_id, $size = 'full');
		}
	}
}       

// Add map to the Cabins Product Category Page

add_action( 'woocommerce_after_main_content', 'add_map' );
function add_map() {
    if ( is_product_category('cabins') )        {
        $args = array(
            'post_type'             => 'product',
            'post_status'           => 'publish',
            'posts_per_page'        => -1,
            'tax_query'             => array(
                array(
                    'taxonomy'      => 'product_cat',
                    'field' => 'term_id', 
                    'terms'         => 24,
                    'operator'      => 'IN',
                ),
            )
        );
        $products = new WP_Query($args);

        echo "<div class='map-container'><div class='wrap'><div class='acf-map'>";

        while ( $products->have_posts() ) : $products->the_post();

            $location = get_field('single_cabin_location');
            $title = get_the_title(); // Get the title

                if( !empty($location) ) {
                ?>
                    <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
                                <h4><a href="<?php the_permalink(); ?>" rel="bookmark"> <?php the_title(); ?></a></h4>
                                <p class="address"><?php echo $location['address']; ?></p>
                    </div>
                <?php
                }
        endwhile;

        echo '</div></div></div>';
        wp_reset_postdata();
    }
}