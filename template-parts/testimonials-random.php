<?php

/**
 * Template part for displaying testimonials
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Starter_Theme
 */


// Filter for cabin testimonials

if (has_term('Cabins', 'product_cat')) {
    $args = array(
        'post_type'      => 'tonquin-testimonials',
        'posts_per_page' => 1,
        'orderby'         => 'rand',
        'tax_query' => array(
            array(
                'taxonomy' => 'tonquin-testimonial-area',
                'field'    => 'name',
                'terms'    => 'Cabin',
            ),
        ),

    );

    $query = new WP_Query($args);



    if ($query->have_posts()) {
?>
        <h4 >Guest Testimonials</h4>
        <?php

        while ($query->have_posts()) {
            $query->the_post();

            if (get_field('quote_body')) {
        ?>
                <quote><?php the_field('quote_body'); ?> </quote>
                <cite><?php the_field('quote_author'); ?></cite>
        <?php };
        };
        wp_reset_postdata();
    };
} else if (has_term('Experiences', 'product_cat')) {    // filter for experience testimonials
    $args = array(
        'post_type'      => 'tonquin-testimonials',
        'posts_per_page' => 1,
        'orderby'         => 'rand',
        'tax_query' => array(
            array(
                'taxonomy' => 'tonquin-testimonial-area',
                'field'    => 'name',
                'terms'    => 'Experience',
            ),
        ),

    );

    $query = new WP_Query($args);



    if ($query->have_posts()) {
        ?>
        <h4>Guest Testimonials</h4>
        <?php

        while ($query->have_posts()) {
            $query->the_post();

            if (get_field('quote_body')) {
        ?>
                <quote><?php the_field('quote_body'); ?> </quote>
                <cite><?php the_field('quote_author'); ?></cite>
        <?php };
        };
        wp_reset_postdata();
    };
} else { // remaining is General only
    $args = array(
        'post_type'      => 'tonquin-testimonials',
        'posts_per_page' => 1,
        'orderby'         => 'rand',
        'tax_query' => array(
            array(
                'taxonomy' => 'tonquin-testimonial-area',
                'field'    => 'name',
                'terms'    => 'General',
            ),
        ),

    );

    $query = new WP_Query($args);



    if ($query->have_posts()) {
        ?>
        <h4>Guest Testimonials</h4>
        <?php

        while ($query->have_posts()) {
            $query->the_post();

            if (get_field('quote_body')) {
        ?>
                <quote><?php the_field('quote_body'); ?> </quote>
                <cite><?php the_field('quote_author'); ?></cite>
<?php };
        };
        wp_reset_postdata();
    };
}
