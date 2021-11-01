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

				if ( get_field('about_owners') ) :
					?>
					<p> <?php the_field( 'about_owners' ); ?> </p> 
					<?php 
				endif;

			
		
				// ACF Google Map Single Map Output
			
				
				$location = get_field('main_office_map');
				if( $location ): ?>

				<!-- ACF Styles per the Docs -->
				<style type="text/css">
				.acf-map {
					width: 100%;
					height: 400px;
					border: #ccc solid 1px;
					margin: 20px 0;
				}


				.acf-map img {
				max-width: inherit !important;
				}
				</style>

					<div class="acf-map" data-zoom="16">
						<div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
					</div>
				<?php 
				endif;
				

				$location = get_field('main_office_map');
					if( $location ) {

						// Loop over segments and construct HTML.
						$address = '';
						foreach( array('street_number', 'street_name', 'city', 'state', 'post_code', 'country') as $i => $k ) {
							if( isset( $location[ $k ] ) ) {
								$address .= sprintf( '<span class="segment-%s">%s</span>, ', $k, $location[ $k ] );
							}
						}

						// Trim trailing comma.
						$address = trim( $address, ', ' );

						// Display HTML.
						echo '<p>' . $address . '.</p>';
					}


			endif;
		endwhile; ?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();