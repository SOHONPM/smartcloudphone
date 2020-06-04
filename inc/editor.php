<?php
/** 
* Theme Backend Editor
*
* Learn more: https://codex.wordpress.org/Functions_File_Explained
*
* @since   1.0.0
* @package starter
*/



/**
 * Registers an editor stylesheet for the admin
 */
function themezero_add_editor_styles() {

  add_editor_style( 'assets/css/custom-editor-style.css' );

}



/**
 * Add style format on Tiny MCE
 */
function themezero_tiny_mce_style_formats( $styles ) {

    array_unshift( $styles, 'styleselect' );
    return $styles;
}






/**
 * Add style format before Tiny MCE Init
 */
function themezero_tiny_mce_before_init( $settings ) {

  $style_formats = array(
      array(
          'title' => 'Lead Paragraph',
          'selector' => 'p',
          'classes' => 'lead',
          'wrapper' => true
          ),
      array(
          'title' => 'Small',
          'inline' => 'small'
      ),
      array(
          'title' => 'Blockquote',
          'block' => 'blockquote',
          'classes' => 'blockquote',
          'wrapper' => true
      ),
			array(
          'title' => 'Blockquote Footer',
          'block' => 'footer',
          'classes' => 'blockquote-footer',
          'wrapper' => true
      ),
			array(
          'title' => 'Cite',
          'inline' => 'cite'
      )
  );
  
    if ( isset( $settings['style_formats'] ) ) {
      $orig_style_formats = json_decode($settings['style_formats'],true);
      $style_formats = array_merge($orig_style_formats,$style_formats);
    }

    $settings['style_formats'] = json_encode( $style_formats );
    return $settings;
}


add_action( 'admin_init', 'themezero_add_editor_styles' );
add_filter( 'mce_buttons_2', 'themezero_tiny_mce_style_formats' );
add_filter( 'tiny_mce_before_init', 'themezero_tiny_mce_before_init' );