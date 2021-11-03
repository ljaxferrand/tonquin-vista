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
			the_title();

			if ( function_exists( 'get_field' )) :

				$contact_img = get_field( 'contact_hero' );
				if ( $contact_img ) :
					echo wp_get_attachment_image($contact_img, 'full');
				endif; 

				if ( get_field('contact_header_text') ) :
					?>
					<h2> <?php the_field( 'contact_header_text' ); ?> </h2> 
					<?php 
				endif;

				if ( get_field('about_btn') ) :
					?>
					<a href="<?php the_field( 'about_btn' ); ?>">About Page</a>
					<?php 
				endif;
				?>
				<div class="contact-form-container">
					<?php
					echo do_shortcode( '[contact-form-7 id="22" title="Contact form 1"]' );
					?>
				</div>
				<?php

			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
