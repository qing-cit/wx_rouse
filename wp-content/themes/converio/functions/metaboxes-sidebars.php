<?php
add_action( 'add_meta_boxes', 'converio_add_sidebar_metabox' );  
add_action( 'save_post', 'converio_save_sidebar_postdata' );  
  
/* Adds a box to the side column on the Post and Page edit screens */  
function converio_add_sidebar_metabox()  
{  
    add_meta_box(   
        'custom_sidebar',  
        esc_attr__( 'Custom Sidebar', 'converio' ),  
        'converio_custom_sidebar_callback',  
        'post',  
        'side'  
    );  
    add_meta_box(   
        'custom_sidebar',  
        esc_attr__( 'Custom Sidebar', 'converio' ),  
        'converio_custom_sidebar_callback',  
        'page',  
        'side'  
    );  
}  

function converio_custom_sidebar_callback( $post )  
{  
    global $wp_registered_sidebars;  
      
    $custom = get_post_custom($post->ID);  
      
    if(isset($custom['custom_sidebar']))  
        $val = $custom['custom_sidebar'][0];  
    else  
        $val = "default";  
  
    // Use nonce for verification  
    wp_nonce_field('converio_custom_sidebar_nonce', 'custom_sidebar_nonce' );  
  
    // The actual fields for data entry  
    $output = '<p><label for="myplugin_new_field">'.esc_attr__("Choose a sidebar to display", 'converio' ).'</label></p>';  
    $output .= "<select name='custom_sidebar'>";  
  
    // Add a default option  
    $output .= "<option";  
    if($val == "default")  
        $output .= " selected='selected'";  
    $output .= " value='default'>".esc_attr__('default', 'converio')."</option>";  
      
    // Fill the select element with all registered sidebars  
    foreach($wp_registered_sidebars as $sidebar_id => $sidebar)  
    {  
        $output .= "<option";  
        if($sidebar_id == $val)  
            $output .= " selected='selected'";  
        $output .= " value='".esc_attr($sidebar_id)."'>".esc_attr($sidebar['name'])."</option>";  
    }  

    // No sidebar
    $output .= '<option value="no"'; 
    if($val == 'no') $output .= " selected='selected'"; 
    $output .= '>'.__('No sidebar','converio').'</option>';
    
    $output .= "</select>";  
      
    echo $output;  
}  

function converio_save_sidebar_postdata( $post_id )  
{  
    // verify if this is an auto save routine.   
    // If it is our form has not been submitted, so we dont want to do anything  
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )   
      return;  
  
    // verify this came from our screen and with proper authorization,  
    // because save_post can be triggered at other times  
  
    if (!isset($_POST['custom_sidebar_nonce']) || !wp_verify_nonce( $_POST['custom_sidebar_nonce'], 'converio_custom_sidebar_nonce' ) )  
      return;  
  
    if ( !current_user_can( 'edit_page', $post_id ) )  
        return;  
  
    $data = $_POST['custom_sidebar'];  
  
    update_post_meta($post_id, "custom_sidebar", $data);  
}  