<?php
/**
 * The template for displaying the activities page.
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
                // Hero banner from ACF
                $activities_hero = get_field( 'activities_hero' );
				if ( $activities_hero ) :
				?>
				<img id="activities-hero" src="<?php echo esc_url( $activities_hero['url'] ); ?>" alt="<?php echo esc_attr( $activities_hero['alt'] ); ?>" />
                <?php
                
                // Activities Intro (head) Text from ACF
                $activities_text = get_field( 'activities_text' );
                if ( $activities_text ) :
                    ?>
                    <p id='activites-text'> <?php echo esc_html( $activities_text ); ?> </p>
                    <?php
                endif;
                ?>

                <div id="explore-experiences">
                    <ul id="nav-tab" class="nav-tab">
                        <li class="active"><a href="#experiences">Experiences</a></li>
                        <li><a href="#explore">Explore</a></li>
                    </ul>

                    <div id="tab-container">
                        <div class='tab-pane active' id="experiences-tab">
                            <?php
                            // Intro text for Experience section
                            $experiences_intro = get_field( 'experience_intro' );
                            if ( $experiences_intro ) :
                                ?>
                                <p> <?php echo esc_html( $experiences_intro ); ?> </p>
                                <?php
                            endif;
                            ?>
                        </div>

                        <div class='tab-pane' id="explore-tab">
                            <?php 
                                
                            ?>
                        </div>
                    </div>
                </div>
                
                <?php 
            endif;






            endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
