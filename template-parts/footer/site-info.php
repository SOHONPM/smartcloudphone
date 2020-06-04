<?php

/**
* Display Site Info
*
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @since   1.0.0
* @package themezero
*/
?>


<?php if( get_theme_mod( 'footer_option' ) ) : ?>
      	<p class="copyright">© <?php echo date('Y') . ' ' . get_theme_mod( 'footer_info' ) ?></p>
 <?php endif; ?>	