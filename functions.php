<?php
/**
 * gridpack functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package gridpack
 */

define( 'THEMEROOT', get_stylesheet_directory_uri() );
define( 'IMAGES', THEMEROOT . '/img' );

if ( ! function_exists( 'gridpack_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function gridpack_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on gridpack, use a find and replace
		 * to change 'gridpack' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'gridpack', get_template_directory() . '/languages' );

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
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'gridpack' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'gridpack_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'gridpack_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gridpack_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'gridpack_content_width', 1170 );
}
add_action( 'after_setup_theme', 'gridpack_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function gridpack_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'gridpack' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'gridpack' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'gridpack_widgets_init' );


/**
 * Enquues Google fonts on all pages
 */
function gridpack_add_google_fonts() {
    wp_enqueue_style( 'gridpack-google-fonts', 'https://fonts.googleapis.com/css?family=Roboto+Slab:400,700', false );
}

add_action( 'wp_enqueue_scripts', 'gridpack_add_google_fonts' );

/**
 * Enqueue scripts and styles.
 */
function gridpack_scripts() {
    wp_register_script( 'serviceworker', get_template_directory_uri() . '/serviceworker.js', array(), '0.0.1', true );

	wp_register_script( 'gridpack-home', get_template_directory_uri() . '/dist/home.bundle.js', array(), '0.0.1', true );
	wp_register_script( 'gridpack-single', get_template_directory_uri() . '/dist/single.bundle.js', array(), date("H:i:s"), true );
	wp_register_script( 'gridpack-page', get_template_directory_uri() . '/dist/page.bundle.js', array(), date("H:i:s"), true );
	wp_register_script( 'gridpack-default', get_template_directory_uri() . '/dist/default.bundle.js', array(), date("H:i:s"), true );
	wp_register_script( 'gridpack-common', get_template_directory_uri() . '/dist/common.bundle.js', array(), date("H:i:s"), true );



	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if(is_front_page()){
		wp_enqueue_style( 'gridpack-home-style', get_template_directory_uri() . '/dist/css/home.css', array(), date("H:i:s"));
		wp_enqueue_script('gridpack-home');
	} elseif(is_single()) {
		wp_enqueue_style( 'gridpack-single-style', get_template_directory_uri() . '/dist/css/single.css', array(), date("H:i:s"));
		wp_enqueue_script('gridpack-single');
	} elseif(is_page()) {
		wp_enqueue_style( 'gridpack-page-style', get_template_directory_uri() . '/dist/css/page.css', array(), date("H:i:s"));
		wp_enqueue_script('gridpack-page');
	} else {
		wp_enqueue_style( 'gridpack-style', get_template_directory_uri() . '/dist/css/default.css', array(), date("H:i:s"));
		wp_enqueue_script('gridpack-default');
	}
}
add_action( 'wp_enqueue_scripts', 'gridpack_scripts' );

/*add_filter( 'wp_enqueue_scripts', 'gridpack_remove_jquery', PHP_INT_MAX );

function gridpack_remove_jquery( ){
	wp_dequeue_script( 'jquery');
	wp_deregister_script( 'jquery');
}*/



function gridpack_register_serviceworker(){ ?>
    <script>
    if (navigator.serviceWorker) {
        navigator.serviceWorker.register( '/serviceworker.js')
            .then( function (registration) {
                console.log('success!', registration.scope);
            })
            .catch( function (error) {
                console.error('failure!', error);
            });
        console.log('All done.');
    }
        </script>”

<?php }

add_action('wp_head', 'gridpack_register_serviceworker');

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

