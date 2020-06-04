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

get_header(); ?>

<main class="content" id="content" itemscope itemtype="http://schema.org/WebPageElement">
	<?php get_template_part( 'template-parts/loop/content', 'banner' );  ?>
	<!--- Main Content -->
	<div class="content__main">
		<div class="container">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/loop/content', 'page' ); ?>

				<?php
					
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile;
			?>
		</div>
	</div>
	<!-- .Main Content -->

</main>

<?php get_footer(); ?>
