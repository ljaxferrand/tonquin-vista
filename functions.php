<?php
/**
 * Tonquin Vista functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Tonquin_Vista
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'tonquin_vista_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function tonquin_vista_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Tonquin Vista, use a find and replace
		 * to change 'tonquin-vista' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'tonquin-vista', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'tonquin-vista' ),
				'footer' => esc_html__( 'Footer Menu Location', 'tonquin-vista' ),
				'social' => esc_html__( 'Social Menu Location', 'tonquin-vista' )
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'tonquin_vista_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'tonquin_vista_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function tonquin_vista_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'tonquin_vista_content_width', 640 );
}
add_action( 'after_setup_theme', 'tonquin_vista_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function tonquin_vista_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'tonquin-vista' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'tonquin-vista' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'tonquin_vista_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function tonquin_vista_scripts() {

	wp_enqueue_style(
		'tonquin-vista-googlefonts',
		'https://fonts.googleapis.com/css2?family=Megrim&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap',
		array(),
		null
	);

	wp_enqueue_style( 'tonquin-vista-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'tonquin-vista-style', 'rtl', 'replace' );

	wp_enqueue_script( 'tonquin-vista-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );


	if ( is_product() || is_page( 'about' ) || is_page( 'activities' ) ) :
		wp_enqueue_script( 'tonquin-vista-activities-tab-control', get_template_directory_uri() . '/js/activities-tab-control.js', array(), _S_VERSION, true );
	endif;

	if ( is_front_page() ) :
		// Font on Home slider
		wp_enqueue_style(
			'tonquin-vista-playfair',
			'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap',
			array(),
			null
		);

		// Styles and scripts for swiperJS
		wp_enqueue_style(
			'tonquin-vista-swiper',
			'https://unpkg.com/swiper@7/swiper-bundle.min.css',
			array(),
			null
		);

		wp_enqueue_script(
			'tonquin-vista-swiper-js',
			'https://unpkg.com/swiper@7/swiper-bundle.min.js',
			array(),
			_S_VERSION,
			true
		);

		wp_enqueue_script(
			'tonquin-vista-swiper-init',
			get_template_directory_uri() . '/js/swiper-init.js',
			array(
				'tonquin-vista-swiper-js',
			),
			_S_VERSION,
			true
		);

	endif;


	if (is_page( 'about' ) || is_product_category('cabins')) {
		wp_enqueue_script('map-js', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDrRC4kWAjqyK5toxfikbIg-ugY9WTcbco');

		wp_enqueue_script( 'tonquin-vista-map', get_template_directory_uri() . '/js/map.js', array(), _S_VERSION, true );
	}
	
	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tonquin_vista_scripts' );

// CUSTOM STYLING FOR LOGIN SCREEN
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/wp-login-logo.png);
		height:100px;
		width: auto;
		background-size: 100px 100px;
		background-repeat: no-repeat;
        	padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

// REMOVES ALL OF THE FOLLOWING DASHBOARD WIDGETS
// Create the function to use in the action hook
function wporg_remove_dashboard_widget() {
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'health_check_status', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'wc_admin_dashboard_setup', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal' );
	remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'normal' );
} 
// Hook into the 'wp_dashboard_setup' action to register our function
add_action( 'wp_dashboard_setup', 'wporg_remove_dashboard_widget' );

/**
 * DEFAULT CODE FOR ADDING a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */

// ADD WIDGETS STARTS HERE ----------------------------------------------- 
function wporg_add_dashboard_widgets() {
    wp_add_dashboard_widget(
        'wporg_dashboard_widget',                          // Widget slug.
        esc_html__( 'Responsive Accordion Tutorial', 'wporg' ), // Title.
        'wporg_dashboard_widget_render'                    // Display function.
    ); 
}
add_action( 'wp_dashboard_setup', 'wporg_add_dashboard_widgets' );
 
/** IF IT IS A TUTORIAL WIDGET
 * Create the function to output the content of our Dashboard Widget.
 */
function wporg_dashboard_widget_render() {
    // Display whatever you want to show.
    esc_html_e( "Learn how to add a new FAQ using the Responsive Accordion plugin", "wporg" );
	?>
	<div class="faq-tutorial">
		<br>
		<a href="<?php 
		echo get_template_directory_uri() . '/tutorials/faq-accordion-tutorial.pdf'
		?>" >
		Please click this link for the PDF tutorial.
		</a>
	</div>
	<?php
}
// ADD WIDGETS ENDS HERE --------------------------------------------------


// To change the link values so the logo links to your WordPress site
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Tonquin Vista';
}
add_filter( 'login_headertext', 'my_login_logo_url_title' );

function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/sass/components/content/_page-login.scss' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/** Requiring file that has custom post type functions */
require get_template_directory() . '/inc/cpt-taxonomy.php';

/** Requiring file that has custom ACF Google Map settings */
require get_template_directory() . '/inc/map-settings.php';



/** Requiring file that has custom Cabins Category Page hooks */
require get_template_directory() . '/inc/cabins-category-hooks.php';

