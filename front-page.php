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
        <div id="slider-container">
		    <?php
		    echo do_shortcode('[smartslider3 slider="2"]');
            ?>
        </div>

        <div id="tonquin-logo">
            <?php
            $home_logo = get_field('home_logo');
            ?>
            <img id="activities-hero" src="<?php echo esc_url( $home_logo['url'] ); ?>" alt="<?php echo esc_attr( $home_logo['alt'] ); ?>" />
        </div>

        <div id="home-intro">
            <?php 
            $home_intro = get_field('home_intro_text');
            ?>
            <p> <?php echo esc_html($home_intro); ?> </p>
        </div>


        <section id="see-cabins">
            <?php 
            $cabins_group = get_field('see_cabins_group');
            ?>
            <h2> <?php echo esc_html($cabins_group['see_cabins_header']) ?> </h2>
            <div id="see-cabin-card">
                <img id="see-cabins-img" src="<?php echo esc_url( $cabins_group['see_cabins_image']['url'] ); ?>" alt="<?php echo esc_attr( $cabins_group['see_cabins_image']['alt'] ); ?>" />
                <p> <?php echo esc_html($cabins_group['see_cabins_text']) ?> </p>
                <button><a href="<?php $cabins_group['see_cabins_btn'] ?>">See Cabins</a></button>
            </div>
        </section>

        <section id="see-experiences">
            <?php 
                $see_experiences = get_field('see_experiences_group');
                ?>
                <h2> <?php echo esc_html($see_experiences['see_experiences_header']) ?> </h2>
                <div id="see-experiences-card">
                    <img id="see-experiences-img" src="<?php echo esc_url( $see_experiences['see_experiences_image']['url'] ); ?>" alt="<?php echo esc_attr( $see_experiences['see_experiences_image']['alt'] ); ?>" />
                    <p> <?php echo esc_html($see_experiences['see_experiences_text']) ?> </p>
                    <button><a href="<?php $see_experiences['see_experiences_btn'] ?>">See Experiences</a></button>
                </div>
        </section>

        <div id="instagram-container">
            <?php echo do_shortcode( '[instagram-feed]' ); ?>
        </div>

        <!-- Add random testimonial template part -->


	</main><!-- #main -->

<?php
get_footer();