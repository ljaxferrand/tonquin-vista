<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Tonquin_Vista
 */

get_header();
?>

<main id="primary" class="site-main">


    <?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			if( function_exists( 'get_field' )) :

				$about_img = get_field( 'about_hero' );
				if ( $about_img ) :
				?>
  				  <img id="about-hero" src="<?php echo esc_url( $about_img['url'] ); ?>" alt="<?php echo esc_attr( $about_img['alt'] ); ?>" />

    			<?php 
				endif; 

				$owner_img = get_field( 'owner_image' );
				if ( $owner_img ) :
				?>
   				 <img id="owner-img" src="<?php echo esc_url( $owner_img['url'] ); ?>" alt="<?php echo esc_attr( $owner_img['alt'] ); ?>" />

  			    <?php 
				endif; 

			
				$location = get_field('main_office_map');
				if( $location ): ?>
					<div class="acf-map" data-zoom="16">
						<div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
					</div>
			<?php
			endif;
			endif;
			endwhile; ?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();