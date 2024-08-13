<?php
/**
 * jobs-info functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package jobs-info
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function jobs_info_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on jobs-info, use a find and replace
		* to change 'jobs-info' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'jobs-info', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'jobs-info' ),
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
			'jobs_info_custom_background_args',
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
add_action( 'after_setup_theme', 'jobs_info_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function jobs_info_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'jobs_info_content_width', 640 );
}
add_action( 'after_setup_theme', 'jobs_info_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function jobs_info_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'jobs-info' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'jobs-info' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'jobs_info_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function jobs_info_scripts() {
	wp_enqueue_style( 'jobs-info-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'jobs-info-style', 'rtl', 'replace' );

	wp_enqueue_script( 'jobs-info-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'jobs_info_scripts' );

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

/** Job Functionalities */

function register_jobs_post_type() {
	// jobs-info
	$labels = array(
		'name' => _x('Jobs', 'jobs-info'),
		'singular_name' => _x('Job', 'jobs-info'),
		'menu_name' => _x('Jobs', 'jobs-info'),
		'name_admin_bar' => _x('Job', 'jobs-info'),
		'add_new' => _x('Add New', 'jobs-info'),
		'add_new_item' => __('Add New Job', 'jobs-info'),
		'new_item' => __('New Job', 'jobs-info'),
		'edit_item' => __('Edit Job', 'jobs-info'),
		'view_item' => __('View Job', 'jobs-info'),
		'all_items' => __('All Jobs', 'jobs-info'),
		'search_items' => __('Search Jobs', 'jobs-info'),
		'parent_item_colon' => __('Parent Jobs:', 'jobs-info'),
		'not_found' => __('No jobs found', 'jobs-info'),
		'not_found_in_trash' => __('No jobs found in Trash', 'jobs-info'),
	);

	$args = array (
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'jobs'),
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => 5,
		'supports' => array('title', 'editor', 'author', 'excerpt'),
		'menu_icon' => 'dashicons-businessman',
	);

	register_post_type('job', $args);
}

add_action('init', 'register_jobs_post_type');


/** Add custom meta boxes */

function jobs_add_meta_boxes() {
	add_meta_box(
		'jobs_meta_box',
		'Job Details',
		'jobs_meta_box_html',
		'job'
	);
}

add_action('add_meta_boxes', 'jobs_add_meta_boxes');

function jobs_meta_box_html($post) {
	$job_title = get_post_meta( $post->ID, '_job_title', true );
	$salary = get_post_meta( $post->ID, '_salary', true );
	$location = get_post_meta( $post->ID, '_location', true );
	?>
	<p>
		<label for="job_title">Job Title:</label>
		<input type="text" name="job_title" id="job_title" value="<?php echo esc_attr($job_title); ?>" />
	</p>
	<p>
		<label for="salary">Salary:</label>
		<input type="text" name="salary" id="salary" value="<?php echo esc_attr($salary); ?>" />
	</p>
	<p>
		<label for="location">Location:</label>
		<input type="text" name="location" id="location" value="<?php echo esc_attr($location); ?>" />
	</p>
	<?php
 }

 function save_jobs_meta_box_data($post_id) {
	if(array_key_exists('job_title', $_POST)) {
		update_post_meta( $post_id, '_job_title', sanitize_text_field( $_POST['job_title'] ));
	}
	if(array_key_exists('salary', $_POST)) {
		update_post_meta( $post_id, '_salary', sanitize_text_field( $_POST['salary'] ));
	}
	if(array_key_exists('location', $_POST)) {
		update_post_meta( $post_id, '_location', sanitize_text_field( $_POST['location'] ));
	}
 }

 add_action('save_post', 'save_jobs_meta_box_data');

 /** Frontend Functionality 
  * Displaying Job Listings
 */


