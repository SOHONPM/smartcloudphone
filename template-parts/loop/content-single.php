<?php
/**
 * Single post partial template.
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @since   1.0.0
 * @package themezero
 */

?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		
	<?php the_content(); ?>

</article><!-- #post-## -->
