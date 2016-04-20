<?php
/**
 * AppStack Theme Customizer
 *
 * @package AppStack
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

/**
 * Class to create a custom post type control
 */

//function stack_sanitize_text( $input ) {
//    return wp_kses_post( force_balance_tags( $input ) );
//}

function appstack_customize_register( $wp_customize ) {
	
	$wp_customize->add_section( 'stack_logo', array(
	    'priority'       => 10,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => 'Logo',
	    'description'    => '',
	) );

	   //Logo Image
	   $wp_customize->add_setting( 'logo_image', array( 
	   	'sanitize_callback' => 'esc_url_raw',
	   ) );

	   $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_image', array(
	   	'label' => __( 'Logo Upload', 'appstack' ),
	   	'section' => 'stack_logo',
	   	'settings' => 'logo_image'
	
	   ) ) );
	
	
	   	//Highlight Color
	     $wp_customize->add_setting( 'highlight_color', array(
	   	'default' => '#f36',
	   	'sanitize_callback' => 'sanitize_hex_color',
	     ) );
	

	
	   	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'highlight_color', array(
	   		'label'   => __( 'Site Color', 'appstack' ),
	   		'section' => 'colors',
	   		'settings'   => 'highlight_color'
		
	   	) ) );
		
		
	     	//Menu Color
		     $wp_customize->add_setting( 'menu_color', array(
		   	'default' => '#fff',
		   	'sanitize_callback' => 'sanitize_hex_color',
		   	) );
	

	
		   	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_color', array(
		   		'label'   => __( 'Menu Background Color', 'appstack' ),
		   		'section' => 'colors',
		   		'settings'   => 'menu_color'
		
		   	) ) );
			
			   	//Text Color
			     $wp_customize->add_setting( 'text_color', array(
			   	'default' => '#232323',
			   	'sanitize_callback' => 'sanitize_hex_color',
			   	) );



			   	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'text_color', array(
			   		'label'   => __( 'Menu Text Color', 'appstack' ),
			   		'section' => 'colors',
			   		'settings'   => 'text_color'
	
			   	) ) );
			
			   	//Footer Color
			     $wp_customize->add_setting( 'footer_color', array(
			   	'default' => '#161b1f',
			   	'sanitize_callback' => 'sanitize_hex_color',
			   	) );
	

	
			   	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_color', array(
			   		'label'   => __( 'Footer Background Color', 'appstack' ),
			   		'section' => 'colors',
			   		'settings'   => 'footer_color'
		
			   	) ) );
					
					   	//Text Color Footer
					     $wp_customize->add_setting( 'text_color_footer', array(
					   	'default' => '#fff',
					   	'sanitize_callback' => 'sanitize_hex_color',
					   	) );
	

	
					   	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'text_color_footer', array(
					   		'label'   => __( 'Footer Text Color', 'appstack' ),
					   		'section' => 'colors',
					   		'settings'   => 'text_color_footer'
		
					   	) ) );
							
							
							$wp_customize->add_section( 'stack_footer_options', array(
							    'priority'       => 180,
							    'capability'     => 'edit_theme_options',
							    'theme_supports' => '',
							    'title'          => 'Footer',
							    'description'    => '',
							) );
	
							//Copyright
						  $wp_customize->add_setting( 'copyright', array(
							  'default' => 'All Rights Reserved.',
							  'sanitize_callback' => 'esc_attr',
							) );
	

	
							$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'copyright', array(
								'label'   => __( 'Copyright', 'appstack' ),
								'section' => 'stack_footer_options',
								'settings'   => 'copyright',
				
							    )));
				
				
								//Social Settings
								$wp_customize->add_section( 'stack_social_options', array(
								    'priority'       => 170,
								    'capability'     => 'edit_theme_options',
								    'theme_supports' => '',
								    'title'          => 'Social Links',
								    'description'    => '',
								) );
	
								$wp_customize->add_setting( 'twitter_text', array(
									'default' => '',
									'sanitize_callback' => 'sanitize_text_field',
									 'priority' => 1
								) );
	
								$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'twitter_text', array(
									'label'   => __( 'Twitter username', 'appstack' ),
									'section' => 'stack_social_options',
									'settings'   => 'twitter_text',
		
								) ) );
	
	
								$wp_customize->add_setting( 'facebook_text', array(
									'default' => '',
									'sanitize_callback' => 'sanitize_text_field',
									 'priority' => 2
								) );
	
								$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'facebook_text', array(
									'label'   => __( 'Facebook username', 'appstack' ),
									'section' => 'stack_social_options',
									'settings'   => 'facebook_text',
		
								) ) );
	
								$wp_customize->add_setting( 'pinterest_text', array(
									'default' => '',
									'sanitize_callback' => 'esc_url_raw',
									 'priority' => 3
								) );
	
								$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'pinterest_text', array(
									'label'   => __( 'Pinterest url', 'appstack' ),
									'section' => 'stack_social_options',
									'settings'   => 'pinterest_text',
		
								) ) );
	
								$wp_customize->add_setting( 'google1_text', array(
									'default' => '',
									'sanitize_callback' => 'esc_url_raw',
									 'priority' => 4
								) );
	
	
								$wp_customize->add_setting( 'dribbble_text', array(
									'default' => '',
									'sanitize_callback' => 'esc_url_raw',
									 'priority' => 5
								) );
	
								$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'dribbble_text', array(
									'label'   => __( 'Dribbble url', 'appstack' ),
									'section' => 'stack_social_options',
									'settings'   => 'dribbble_text',
		
								) ) );
	
								$wp_customize->add_setting( 'flickr_text', array(
									'default' => '',
									'sanitize_callback' => 'esc_url_raw',
									 'priority' => 6
								) );
	
								$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'flickr_text', array(
									'label'   => __( 'Flickr url', 'appstack' ),
									'section' => 'stack_social_options',
									'settings'   => 'flickr_text',
		
								) ) );
	
								$wp_customize->add_setting( 'youtube_text', array(
									'default' => '',
									'sanitize_callback' => 'esc_url_raw',
									 'priority' => 7
								) );
	
								$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'youtube_text', array(
									'label'   => __( 'YouTube url', 'appstack' ),
									'section' => 'stack_social_options',
									'settings'   => 'youtube_text',
		
								) ) );
	
								$wp_customize->add_setting( 'instagram_text', array(
									'default' => '',
									'sanitize_callback' => 'esc_url_raw',
									 'priority' => 8
								) );
	
								$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'instagram_text', array(
									'label'   => __( 'Instagram url', 'appstack' ),
									'section' => 'stack_social_options',
									'settings'   => 'instagram_text',
		
								) ) );
	
								$wp_customize->add_setting( 'vimeo_text', array(
									'default' => '',
									'sanitize_callback' => 'esc_url_raw',
									 'priority' => 9
								) );
	
								$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vimeo_text', array(
									'label'   => __( 'Vimeo url', 'appstack' ),
									'section' => 'stack_social_options',
									'settings'   => 'vimeo_text',
		
								) ) );
	
								$wp_customize->add_setting( 'behance_text', array(
									'default' => '',
									'sanitize_callback' => 'esc_url_raw',
									 'priority' => 10
								) );
	
								$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'behance_text', array(
									'label'   => __( 'Behance url', 'appstack' ),
									'section' => 'stack_social_options',
									'settings'   => 'behance_text',
		
								) ) );
	
								$wp_customize->add_setting( 'linkedin_text', array(
									'default' => '',
									'sanitize_callback' => 'esc_url_raw',
									 'priority' => 1
								) );
	
								$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'linkedin_text', array(
									'label'   => __( 'LinkedIn url', 'appstack' ),
									'section' => 'stack_social_options',
									'settings'   => 'linkedin_text',
		
								) ) );
	
	$wp_customize->add_setting( 'nav_button', array(
		'default' => '',
		'sanitize_callback' => 'esc_attr',
		'priority' => 9
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nav_button', array(
		'label'   => __( 'Menu Button Text (optional)', 'appstack' ),
		'section' => 'menu_locations',
		'type' => 'text',
		'settings'   => 'nav_button',
	    'description' => 'Enter text for menu button & select a form to link to below.',
	) ) );
	
	$wp_customize->add_setting( 'form_id', array(
		'default' => '',
		'sanitize_callback' => 'esc_attr',
		'priority' => 10
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'form_id', array(
		'label'   => __( 'Enter Form Name', 'appstack' ),
		'section' => 'menu_locations',
		'type' => 'text',
		'settings'   => 'form_id',
	    'description' => 'Enter the name of a CF7 form. (case sensitive)',
	) ) );
	

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->remove_control( 'header_textcolor');
	$wp_customize->remove_section( 'background_image');
	$wp_customize->remove_control( 'background_color');
}
add_action( 'customize_register', 'appstack_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function appstack_customize_preview_js() {
	wp_enqueue_script( 'appstack_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'appstack_customize_preview_js' );
