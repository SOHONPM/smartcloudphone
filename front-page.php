<?php
/**
*  Front Page
*
* Learn more: http://codex.wordpress.org/Template_Hierarchy
*
* @since   1.0.0
* @package themezero
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

<main class="page-wrapper">


<?php
  if( have_rows('modules') ):
      while ( have_rows('modules') ) : the_row();
          get_template_part('template-parts/modules/' . get_row_layout());
      endwhile;
  else :
      // no layouts found
  endif;
?>

  </div>
</main>



<?php get_footer(); ?>
