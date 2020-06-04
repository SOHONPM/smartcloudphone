<?php
/**
*  Themezero functions and definitions
*
*
* Learn more: https://codex.wordpress.org/Functions_File_Explained
*
* @since   1.0.0
* @package themezero
*/



/**
 * Theme setup and custom theme supports.
 */
require get_template_directory() . '/inc/setup.php';

/**
 * Theme scripts and styling
 */
require get_template_directory() . '/inc/enqueue.php';


/**
 * Theme filters
 */
require get_template_directory() . '/inc/filters.php';

/**
 * Theme widgets
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Theme secuity
 */
require get_template_directory() . '/inc/security.php';

/**
 * Customizer for this theme.
 */
require get_template_directory() .  '/inc/customizer.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() .  '/inc/template-tags.php';

/**
 * Bootstrap Nav
 */
require get_template_directory() . '/inc/bootstrap-wp-navwalker.php';

/**
 * Replace default styling on comment form.
 */
require get_template_directory() . '/inc/editor.php';

