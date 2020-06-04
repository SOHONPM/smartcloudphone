<?php 

/**
*  404 Page
*
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

?>

	<main class="main-content" id="content">
		<?php get_template_part( 'template-parts/loop/content', 'banner' );  ?>
		<div class="container">
			
			<div class="error-404 not-found">
				<header class="page-header">
					<h1 class="title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'themezero' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( "The page you're looking for could not be found. It may have been removed, renamed, or maybe it didn't exist in the first place.", "themezero" ); ?></p>
				</div>

				<div class="page-footer">
					<a href="<?php echo esc_url( home_url() ); ?>" class="btn btn-primary"><?php _e( 'To the front page', 'themezero' ); ?></a>
				</div>
			</div><!-- .error-404 -->	

		</div>	
	</main>

<?php get_footer(); ?>