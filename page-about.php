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

			
				// For "Getting Here" info tab -----------------------------
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

					<h2>Getting Here</h2>
					<div class="acf-map" data-zoom="16">
						<div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
					</div>
				<?php 
				endif; ?>
				
					<!-- For "Contact Info" info tab -------------------------------- -->

					<h2>Contact Us</h2>

					<?php if( have_rows('address', 125) ): ?>
						<?php while( have_rows('address', 125) ): the_row(); 

							// Get sub field values.
							$addressline1 = get_sub_field('street_address');
							$addressline2 = get_sub_field('address_details');
							$phone = get_sub_field('phone_number');

							?>
								<div id="contact-address">
										<p><?php echo $addressline1 ?></p>
										<p><?php echo $addressline2 ?></p>
										<p><?php echo $phone ?></p>
								</div>
						<?php endwhile; ?>
					<?php endif;

					if ( get_field('contact_page_link') ) :
						?>
						<button><a href="<?php the_field( 'contact_page_link' ); ?>"> Visit our Contact Page</a></button>
						<?php 
					endif; ?>

					<!-- For "Local Weather" info tab------------------------------------------- -->

					<h2>Local Weather</h2>

					<?php
					// Weather Atlas Widget shortcode
					echo do_shortcode( '[shortcode-weather-atlas city_selector=325344 layout="horizontal" background_color="#637368" daily=5 unit_c_f="c"]' ); ?>

			<?php
			endif;
		endwhile; ?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();