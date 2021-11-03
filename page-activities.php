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
            the_title();

			if( function_exists( 'get_field' )) :
                // Hero banner from ACF
                $activities_hero = get_field( 'activities_hero' );
				if ( $activities_hero ) :
                    
                    echo wp_get_attachment_image( $activities_hero, 'full' );
                    
                endif;
                    
                // Activities Intro (head) Text from ACF
                $activities_text = get_field( 'activities_text' );
                if ( $activities_text ) :
                    ?>
                    <p id='activites-text'> <?php echo esc_html( $activities_text ); ?> </p>
                    <?php
                endif;
                ?>

                <!-- Style for tabs added to sass/components/navigation/_navigation.scss -->
                <div id="explore-experiences">
                    <ul id="nav-tab" class="nav-tab-ul">
                        <li class="active"><a href="#experiences">Experiences</a></li>
                        <li><a href="#explore">Explore</a></li>
                    </ul>

                    <div id="tab-content">
                        <section class='tab-pane active' id="experiences">
                            <?php
                            // Intro text for Experience section
                            $experiences_group = get_field( 'experience_group' );
                            if ( $experiences_group ) :
                                ?>
                                <p> <?php echo esc_html( $experiences_group['experience_intro'] ); ?> </p>
                                <?php
                            endif;

                            // Gift Card Button
                            ?>
                            <a href="#gift-card-content">Gift Cards</a>

                            <div class="testimonial-card">
                                <?php
                                get_template_part('template-parts/testimonials-random', get_post_type());
                                ?>
                            </div>

                            <?php 
                            // Single Experiences pulled into experiences tab
                            $args = array( 
                                'post_type'      => 'product', 
                                'posts_per_page' => '-1',
                                'product_cat'    => 'experiences', 
                                'orderby'        => 'title',
                            );

                            $query = new WP_Query( $args );
                            while ( $query->have_posts() ) : 
                                $query->the_post();
                                ?>
                                <div class="experience-card-content">
                                    <h3> <?php echo get_the_title(); ?> </h3>
                                    <?php                                
                                    the_post_thumbnail('large');  
                                    the_content();
                                    ?>
                                    <a href="<?php echo get_permalink() ?>" id='experience-book-btn'>Book Now</a>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata(); 
                            

                            $gift_args = array( 
                                'post_type'      => 'product', 
                                'posts_per_page' => '1',
                                'product_cat'    => 'gift-cards', 
                                'orderby'        => 'title',
                            );

                            $gift_query = new WP_Query( $gift_args );
                            while ( $gift_query->have_posts() ) : 
                                $gift_query->the_post();
                                ?>
                                <div id="gift-card-content">
                                    <h3> <?php echo get_the_title(); ?> </h3>
                                    <?php
                                    the_post_thumbnail('large');  
                                    the_content();
                                    ?>
                                    <a href="<?php echo get_permalink() ?>" id='gift-card-purchase'>Purchase</a>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        ?>
                        </section>

                        <section class='tab-pane' id="explore">
                            <?php 
                            $explore_group = get_field( 'explore_group' );
                            
                            if ( $explore_group ) :
                                ?>
                                <p> <?php echo esc_html( $explore_group['explore_intro'] ); ?> </p>

                                <h3> <?php echo esc_html( $explore_group['vendors_title'] ); ?> </h3>
                                
                                <?php
                                //Repeater for local vendors 
                                if ( have_rows( 'explore_group' ) ) :
                                    while ( have_rows( 'explore_group' ) ) :
                                        the_row();
                                        if ( have_rows( 'local_vendors' ) ) :
                                            while ( have_rows( 'local_vendors' ) ) : 
                                                the_row();
                                                ?>
                                                <article class="vendor-container">
                                                    <h4> <?php the_sub_field('vendor_name'); ?> </h4>

                                                    <a href="<?php echo esc_url( get_sub_field('vendor_url')); ?>">
                                                        <?php
                                                        echo wp_get_attachment_image( get_sub_field( 'vendor_logo' ), 'medium');
                                                        ?>
                                                    </a>

                                                    <p> <?php the_sub_field('vendor_description') ?> </p>
                                                </article>
                                                <?php
                                            endwhile;
                                        endif;
                                    endwhile;
                                endif;  
                                ?>

                                <h3><?php echo esc_html( $explore_group['tourism_title'] ); ?></h3>

                                 <?php
                                //Repeater for Tourism Group
                                if ( have_rows( 'explore_group' ) ) :
                                    while ( have_rows( 'explore_group' ) ) :
                                        the_row();
                                        if ( have_rows( 'tourism' ) ) :
                                            while ( have_rows( 'tourism' ) ) : 
                                                the_row();
                                                ?>
                                                <article class="tourism-container">
                                                    <h4> <?php esc_html( the_sub_field( 'tourism_name' ) ); ?> </h4>

                                                    <a href="<?php echo esc_url( get_sub_field('tourism_url')); ?>">
                                                        <?php
                                                        echo wp_get_attachment_image( get_sub_field( 'tourism_logo' ), 'medium');
                                                        ?>
                                                    </a>

                                                    <p> <?php esc_html( the_sub_field('tourism_description') ) ?> </p>
                                                </article>
                                                <?php
                                            endwhile;
                                        endif;
                                    endwhile;
                                endif; 

                            endif;
                            ?>
                        </section>
                    </div>
                </div>
                
                <?php 
            endif;
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
