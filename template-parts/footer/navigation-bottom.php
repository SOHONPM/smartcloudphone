<?php

/**
* Display Footer Navigation
*
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @since   1.0.0
* @package themezero
*/
?>

<?php if(has_nav_menu('social')) : ?>
    <?php 

        wp_nav_menu( array( 
        'theme_location'    => 'social',
        'depth'             => 1,
        'container'         => false,
        'container_class'   => false,
        'container_id'      => false,
        'menu_class'        => 'social-links',
        ) );
    ?>
<?php endif; ?>