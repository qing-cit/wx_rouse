<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package AppStack
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="animsition">
<div id="page" class="hfeed site stack-container">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'appstack' ); ?></a>

	

<header class="header-banner-top">

  <div class="main-navigation <?php if ( is_user_logged_in() && is_admin_bar_showing() ) { echo 'logged-in'; } ?>">
	<div class="logo">
		 <?php $stack_logo  = get_theme_mod('logo_image'); 
          if(!empty($stack_logo)) { ?>
 	       <a href="<?php echo esc_attr(home_url()); ?>"> <img class="a" src="<?php echo esc_attr($stack_logo);?>" alt=""> </a>
 	       <?php }
 	   		 else { ?>
		<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		<?php } ?>
	</div>
	 <?php $stack_btn = esc_attr(get_theme_mod('nav_button'));
	       $stack_form = esc_attr(get_theme_mod('form_id'));
		   
	  
		   if (!empty($stack_btn)) {?> 
		
	  <span class="login"><a href="" data-modal="#stack-modal" class="modal__trigger"><?php echo esc_attr($stack_btn); ?></a></span>
	  
  	<div id="stack-modal" class="modal stackmod modal__bg" role="dialog" aria-hidden="true">
  		<div class="modal__dialog">
  			<div class="modal__content">
			    <div class="form">
					<?php echo esc_attr($stack_form); ?>
			              <?php echo do_shortcode( '[contact-form-7 title="'.$stack_form.'"]' ); ?>
			             </div>
  				<!-- modal close button -->
  				<a href="" class="modal__close stack-close">
  					<svg class="stack-mod" viewBox="0 0 24 24"><path d="M19 6.41l-1.41-1.41-5.59 5.59-5.59-5.59-1.41 1.41 5.59 5.59-5.59 5.59 1.41 1.41 5.59-5.59 5.59 5.59 1.41-1.41-5.59-5.59z"/><path d="M0 0h24v24h-24z" fill="none"/></svg>
  				</a>
  			</div>
  		</div>
  	</div>
	<?php }  ?>
    <input type="checkbox" name="mobile-menu-toggle" id="mobile-menu-toggle" class="mobile-menu-box" />
    <nav class="horizontal-nav">
      <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
	 
    </nav>
	
    <label for="mobile-menu-toggle" class="mobile-menu-label"></label>
	
  </div>
  
 



