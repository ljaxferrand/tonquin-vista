<?php
/**
 * The template for displaying the home page
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Tonquin_Vista
 */

get_header();
?>

	<main id="primary" class="site-main">
        <?php
        while( have_posts() ) :
            the_post();
            ?>

            <section id="slider-container">
                <?php
                echo do_shortcode('[smartslider3 slider="2"]');
                ?>
            </section>

            <section id="tonquin-logo">
                <?php
                $home_logo = get_field('home_logo');
                echo wp_get_attachment_image($home_logo, 'medium');
                ?>
            </section>

            <section id="home-intro">
                <?php 
                $home_intro = get_field('home_intro_text');
                ?>
                <p> <?php echo esc_html($home_intro); ?> </p>
            </section>


            <section id="see-cabins">
                <?php 
                $cabins_group = get_field( 'see_cabins_group' );
                $see_cabins_btn = get_field( 'see_cabins_button' );
                ?>
                <h2> <?php echo esc_html( $cabins_group['see_cabins_header'] ); ?> </h2>
                <article id="see-cabin-card">
                    <?php
                    echo wp_get_attachment_image( $cabins_group['see_cabins_image'], 'large' );
                    ?>
                    <p> <?php echo esc_html( $cabins_group['see_cabins_text'] ); ?> </p>
                    <a href="<?php echo esc_url( get_term_link( $see_cabins_btn ) ); ?>">See Cabins</a>                   
                </article>
            </section>

            <section id="see-experiences">
                <?php 
                    $see_experiences = get_field('see_experiences_group');
                    ?>
                    <h2> <?php echo esc_html( $see_experiences['see_experiences_header'] ) ?> </h2>
                    <article id="see-experiences-card">
                        <?php
                        echo wp_get_attachment_image( $see_experiences['see_experiences_image'], 'large');
                        ?>
                        <p> <?php echo esc_html( $see_experiences['see_experiences_text'] ) ?> </p>
                        <a href="<?php echo esc_url( $see_experiences['see_experiences_btn'] ); ?>">See Experiences</a>
                    </article>
            </section>

            <section id="instagram-container">
                <?php echo do_shortcode( '[instagram-feed]' ); ?>
            </section>

            <!-- Add random testimonial template part -->
            <?php 
            get_template_part( 'template-parts/testimonials-random', get_post_type() );
            ?>
        
        <?php
        endwhile;
        ?>
	</main><!-- #main -->

<?php
get_footer();