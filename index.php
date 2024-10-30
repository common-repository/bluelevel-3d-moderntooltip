<?php 
/*
Plugin Name: ModernToolTip
Plugin URI: http://www.bluelevel.in/plugins/SPIGallery
Description: Bored of the same ugly, old, slow-loading progress bars? Then try the BlueLevel 3D CSSProgress Bar! Only CSS means no lag! Only 3KB, Loads In a flash!
Author: Bluelevel 
Author URI: http://www.bluelevel.in
version: 1.0
*/

//Calling the files needed to get the Gallery working
function BL_MTTip_files(){
    
    wp_register_style('BL_MTTip', plugins_url('/css/BL-MTTip.min.css', __FILE__), true);
    wp_enqueue_style('BL_MTTip');
	
	wp_enqueue_script('jquery', true);
}
add_action('after_setup_theme', 'BL_MTTip_files');

//Adding the shortcode to display the Modal
function BL_MTTip_shortcode($atts){   
	extract( shortcode_atts(
            array(
                'title' => 'ToolTip Title',
                'content' => 'lorem ipsum dolor sit amet, consectetur amet.lorem ipsum dolor sit amet, consectetur amet.lorem ipsum dolor sit amet, consectetur amet.',
                'effect' => 'tooltip-effect-1',
            ), $atts )
        );
	
	
			return		'<span class="tooltip '.$effect.'"><span class="tooltip-item">'.$title.'</span><span class="tooltip-content clearfix"><span class="tooltip-text"><strong>'.$title.'</strong>, '.$content.'</span></span></span><script>(function($) {$(document).ready(function() {$(".tooltip-item").hover(function(){$("body").toggleClass("fade");});});})(jQuery);</script>';

}
add_shortcode('BL_MToolTip', 'BL_MTTip_shortcode');

add_action( 'admin_head', 'BL_MTTip_add_tinymce' );


function BL_MTTip_add_tinymce() {
    
    add_filter( 'mce_external_plugins', 'BL_MTTip_add_tinymce_plugin' );
    // Add to line 1 form WP TinyMCE
    add_filter( 'mce_buttons', 'BL_MTTip_add_tinymce_button' );
}

// Inlcude the JS for TinyMCE
function BL_MTTip_add_tinymce_plugin( $plugin_array ) {

    $plugin_array['BL_MTTip'] = plugins_url( '/tinymce/tinymce.min.js', __FILE__ );
    // Print all plugin JS path
    return $plugin_array;
}

// Add the button key for address via JS
function BL_MTTip_add_tinymce_button( $buttons ) {

    array_push( $buttons, 'BL_MTTip_button' );
    return $buttons;
}
?>