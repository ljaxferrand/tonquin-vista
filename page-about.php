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

			if( function_exists( 'get_field' )) :

				$about_img = get_field( 'about_hero' );
				$size = 'full'; // (thumbnail, medium, large, full or custom size)
			
					if ( $about_img ) :
						echo wp_get_attachment_image( $about_img, $size );
					endif; ?>
				
				<section class="owner-info"> 

					<?php
					$owner_img = get_field( 'owner_image' );
					$size = 'large'; // (thumbnail, medium, large, full or custom size)
					if ( $owner_img ) :
						echo wp_get_attachment_image( $owner_img, $size );
					endif; 
					
			
					if ( get_field('about_owners') ) :
						?>
						<p><?php the_field( 'about_owners' ); ?> </p> 
						<?php 
					endif; ?>

				</section>

				<!-- Info Tabs -->
				<div id="explore-experiences">
				<ul id="nav-tab" class="nav-tab-ul">
                        <li class="active"><a href="#gettinghere">Getting Here</a></li>
                        <li><a href="#contactinfo">Contact Info</a></li>
						<li><a href="#localweather">Local Weather</a></li>
                </ul>
			
					<div id="tab-content">
						<section class='tab-pane active' id="gettinghere">
							<?php
							$location = get_field('main_office_map');
							if( $location ): ?>
			
								<div class="acf-map" data-zoom="16">
									<div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
								</div>
							<?php 
							endif; ?>
						</section>

						<section class='tab-pane' id="contactinfo">
			
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
									<a href="<?php the_field( 'contact_page_link' ); ?>">Visit our Contact Page</a>
									<?php 
								endif; ?>
						</section>

						<section class='tab-pane' id="localweather">

							<?php
							// Weather Atlas Widget shortcode
							echo do_shortcode( '[shortcode-weather-atlas city_selector=325344 layout="horizontal" background_color="#637368" daily=5 unit_c_f="c"]' ); ?>
						</section>	
					</div>
				</div>	
				<?php
			endif;
		endwhile; ?>

</main><!-- #main -->

<?php
get_footer();