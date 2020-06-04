<?php 
/**
* Template to display single page
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

get_header();

get_template_part( 'template-parts/loop/content', 'banner' );
?>

    <main class="main-content mt-4 mb-5" id="content">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-8">
					<?php while ( have_posts() ) : the_post(); ?>

						<?php the_breadcrumb() ?>
						<?php get_template_part( 'template-parts/loop/content', 'single' ); ?>

						<?php

							if ( is_singular( 'attachment' ) ) {
								// Parent post navigation.
								the_post_navigation(
									array(
										/* translators: %s: parent post link */
										'prev_text' => sprintf( __( '<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'twentynineteen' ), '%title' ),
									)
								);
							} elseif ( is_singular( 'post' ) ) {
								// Previous/next post navigation.
								the_post_navigation(
									array(
										'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next Post', 'themezero' ) . '</span> ' .
											'<span class="screen-reader-text">' . __( 'Next post:', 'themezero' ) . '</span> <br/>' .
											'<span class="post-title">%title</span>',
										'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous Post', 'themezero' ) . '</span> ' .
											'<span class="screen-reader-text">' . __( 'Previous post:', 'themezero' ) . '</span> <br/>' .
											'<span class="post-title">%title</span>',
									)
								);
							}
							//If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
						?>

					<?php endwhile; // end of the loop. ?>    				
    			</div>
    			<div class="col-md-4">
    					<?php get_sidebar() ?>
    			</div>
    		</div>
		</div>
	</main>		

<?php
get_footer(); ?>

