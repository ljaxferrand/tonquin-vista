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

			<?php 
					if( function_exists( 'get_field' )){

						$contact_img = get_field( 'contact_image' );
                		if ( $contact_img ) :
                    	?>
                        <img id="contact-img" src="<?php echo esc_url( $contact_img['url' ); ?>" alt="<?php echo esc_attr( $contact_img['alt'] ); ?>" />
						<?php endif; ?>

						if ( get_field('contact_header_text')) {
							echo '<h2>';
							the_field('contact_header_text');
							echo '</h2>'; 
						}
						if ( get_field('about_btn')) {
							echo '<button>';
							the_field('about_btn');
							echo '</button>'; 
						}
					}
				?>

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
