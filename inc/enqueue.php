<?php

/**
 * Theme Enqueue
 *
 * Learn more: https://developer.wordpress.org/reference/functions/wp_enqueue_script/
 *
 * @since   1.0.0
 * @package starter
 */

/**
 *
 * Scripts: Frontend with no conditions, Add Custom Scripts to wp_head
 *
 * @since  1.0.0
 *
 */
function themezero_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {


        wp_register_script('starter_vendorsJs', get_template_directory_uri() . '/assets/js/vendor.min.js', array(), false, true);
        wp_register_script('starter_customJs', get_template_directory_uri() . '/assets/js/custom.min.js', array(), false, true);

        wp_enqueue_script('jquery');
        wp_enqueue_script('starter_vendorsJs');
        wp_enqueue_script('popper', get_template_directory_uri() . '/assets/js/popper.min.js', array(), false, true);
        wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), array(), false, true);
        wp_enqueue_script('starter_customJs');
    }
}

/**
 *
 * Styles: Frontend with no conditions, Add Custom styles to wp_head
 *
 * @since  1.0
 *
 */
function themezero_styles()
{

    /**
     *
     * Minified and Concatenated styles
     *  
     */
    //wp_register_style('sero_style', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');

    //wp_enqueue_style('starter_googlefonts', 'https://fonts.googleapis.com/css?family=Dosis:300,400,500,600,700', array(), '1.0', 'all');
    wp_register_style('starter_main_style', get_template_directory_uri() . '/assets/css/main.min.css', array(), '1.0', 'all');
    // wp_register_style('starter_fontawesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '1.0', 'all');

    wp_enqueue_style('starter_fontawesome');
    wp_enqueue_style('starter_main_style');
}


/**
 *
 * Styles: Comments 
 *
 * @since  1.0
 *
 */
function themezero_enqueue_comments_reply()
{
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}


add_action('wp_enqueue_scripts', 'themezero_scripts');
add_action('wp_enqueue_scripts', 'themezero_styles');
add_action('wp_enqueue_scripts', 'themezero_enqueue_comments_reply');
