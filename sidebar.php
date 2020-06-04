<?php
/**
* The sidebar containing the main widget area.
*
* Learn more: http://codex.wordpress.org/Template_Hierarchy
*
* @since   1.0.0
* @package themezero
*/

?>


<aside class="sidebar" id="sidebar" itemscope itemtype="http://schema.org/WPSideBar">

		<?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>
		 
		     <?php dynamic_sidebar( 'right-sidebar' ); ?>
		
		<?php endif; ?>

</aside>