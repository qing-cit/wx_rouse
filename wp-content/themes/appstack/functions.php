<?php
/**
 * AppStack functions and definitions
 *
 * @package AppStack
 */

if ( ! function_exists( 'appstack_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function appstack_setup() {
	add_image_size('stack-blog', 800, 500, true);
	add_image_size('stack-grid', 600, 400, true);
	add_image_size('stack-split', '', 600, true);
	add_image_size('stack-testimonial', '', 500, true);
	add_image_size('stack-phone', 160, 284, true);
	add_image_size('stack-tablet', 284, 412, true);
	add_image_size('stack-browser', 400, 640, true);
	add_image_size('stack-header', 1024, 678, true);
	add_image_size('stack-team', 400, 400, true);
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on AppStack, use a find and replace
	 * to change 'appstack' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'appstack', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'appstack' ),
		'secondary' => esc_html__( 'Footer Menu', 'appstack' ),
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

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'gallery',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'appstack_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // appstack_setup
add_action( 'after_setup_theme', 'appstack_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1140;
}

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function appstack_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'appstack' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'appstack_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function appstack_scripts() {
	wp_enqueue_style( 'appstack-style', get_stylesheet_uri() );
    wp_enqueue_style('appstack-font-awesome', get_template_directory_uri() . "/css/font-awesome.min.css", 'screen');
	wp_enqueue_script( 'appstack-modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array(), '20120206' );
	wp_enqueue_script( 'appstack-dynamics', get_template_directory_uri() . '/js/dynamics.min.js', array(), '20120206', true );
	wp_enqueue_script( 'appstack-main', get_template_directory_uri() . '/js/main.js', array('jquery'), '20150708', true );
	$site_parameters = array(
	    'site_url' => get_site_url(),
	    'theme_directory' => get_template_directory_uri()
	    );
	wp_localize_script( 'appstack-main', 'SiteParameters', $site_parameters );
 
	if ( is_home() ) {
	wp_enqueue_script( 'masonry' );
    }
	wp_enqueue_script( 'appstack-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	$query_args = array(
		'family' => 'Open+Sans:400italic,400,700,300,600',
		'subset' => 'latin,latin-ext',
	);
	wp_enqueue_style( 'appstack_google_fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
            
}

add_action( 'wp_enqueue_scripts', 'appstack_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Add Custom Fields
 */


$value= '';
require_once('inc/custom-fields.php');

/*--------------------------*
/* Page Builder Contact Form Select
/*--------------------------*/

function stack_acf_load_contact_field( $field )
{
	// Reset choices
	$field['choices'] = array();
 
	$post_type = 'wpcf7_contact_form';
	
	$args = array (
		'post_type' => $post_type,
		'posts_per_page' => -1,
		'orderby' => 'menu_order',
		'order' => 'ASC',
	);
	
	$contact_forms = get_posts($args);
	
	$choices = array();
	foreach( $contact_forms as $form) {
		$choices[$form->ID] = strip_tags($form->post_title);
	}
	// loop through array and add to field 'choices'
	if( is_array($choices) )
	{
		foreach( $choices as $choice )
		{
			$field['choices']['none'] = '-none-';
			$field['choices'][ $choice ] = $choice;
		}
	}
 
    // Important: return the field
    return $field;
}
 
// v4.0.0 and above
add_filter('acf/load_field/name=stack_contact', 'stack_acf_load_contact_field');
add_filter('acf/load_field/name=stack_form', 'stack_acf_load_contact_field');

if (class_exists('WP_Customize_Control')) {
    class WP_Customize_Category_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         *
         * @since 3.4.0
         */
        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select &mdash;','appstack' ),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                )
            );
 
            
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
 
            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $dropdown
            );
        }
    }
}

/*--------------------------*
/* Dynamic sidebars
/*--------------------------*/

function mer_load_sidebar( $field )
{
 // reset choices
 $field['choices'] = array();
 $field['choices']['none'] = 'Show Sidebar';
 $field['choices']['default'] = 'Fill Width';
 // load repeater from the options page

 
 $label = get_sub_field('sidebar_name');
 $value = str_replace(" ", "-", $label);
 $value = strtolower($value);
 
$field['choices'][ $value ] = $label;
 

 
 // Important: return the field
 return $field;
}
 
add_filter('acf/load_field/name=select_a_sidebar', 'mer_load_sidebar');

/*===================================================================================
 * Add Author Links
 * =================================================================================*/
function stack_author_profile( $contactmethods ) {
	
	$contactmethods['rss_url'] = 'RSS URL';
	$contactmethods['google_profile'] = 'Google Profile URL';
	$contactmethods['twitter_profile'] = 'Twitter Profile URL';
	$contactmethods['facebook_profile'] = 'Facebook Profile URL';
	$contactmethods['linkedin_profile'] = 'Linkedin Profile URL';
	
	return $contactmethods;
}
add_filter( 'user_contactmethods', 'stack_author_profile', 10, 1);
//function stack_load_scripts($hook) {
 
//	if( $hook != 'edit.php' && $hook != 'post.php' && $hook != 'post-new.php' ) 
//		return;
 
//	wp_enqueue_script( 'appstack-coord', get_template_directory_uri() . '/js/coord.js', array('jquery'), '20150718', true );
//}
//add_action('admin_enqueue_scripts', 'stack_load_scripts');
/*--------------------------*
/* Plugins
/*--------------------------*/
require_once( 'inc/plugins/plugin.php');
/*--------------------------*
/* Admin Styles
/*--------------------------*/
function stack_customizer_css()
{
	wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/css/custom-style.css' );
	
   require_once get_template_directory() . '/inc/custom-styles.php';


wp_add_inline_style( 'custom-style', $custom_inline_style );

}
	
add_action( 'wp_enqueue_scripts', 'stack_customizer_css');


function stack_admin_css()
{
	echo '<style>
	    .post-type-page #postdivrich .wp-editor-wrap {display:none}
	  </style>';
}
add_action('admin_head', 'stack_admin_css');
/*--------------------------*
/* Custom CSS
/*--------------------------*/

function stack_custom_css() {
	global $post;
   	if ( function_exists( 'get_field' ) ) {
	$postid = get_the_ID();
    $bg_color = get_sub_field('color', $postid); 
  ?>
	<style type="text/css">
	.container--ipad {background-color:<?php echo $bg_color; ?>;}
	</style>
	<?php }
}
add_action( 'wp_head', 'stack_custom_css');

/*--------------------------*
/* Excerpt Length
/*--------------------------*/

function stack_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'stack_excerpt_length', 999 );

/*add_filter( 'oembed_dataparse', function( $return, $data, $url )
{
    // Target only Vimeo:
    if(
            is_object( $data ) 
        &&  property_exists( $data, 'provider_name' )
        &&  'Vimeo' === $data->provider_name
    )
    {
        // Remove the unwanted attributes:
        $return = str_ireplace(
            array( 
                'frameborder="0"', 
                'webkitallowfullscreen', 
                'mozallowfullscreen' 
            ),
            '',
            $return
        );
    }
    return $return;
}, 10, 3 );*/