<?php
/**
* The template for displaying search results pages.
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

		<main class="main-content" id="content" itemscope itemtype="http://schema.org/SearchResultsPage">	

			<div class="container">

				<div class="search-page mt-3 mb-3">

						<?php if ( have_posts() ) : ?>
						

							<header class="page-header">
								
									<h1 class="page-title"><?php printf(
									/* translators:*/
									 esc_html__( 'Search Results for: %s', 'themezero' ),
										'<span>' . get_search_query() . '</span>' ); ?></h1>

							</header><!-- .page-header -->


							<?php while ( have_posts() ) : the_post(); ?>

								<?php
								/**
								 * Run the loop for the search to output the results.
								 * If you want to overload this in a child theme then include a file
								 * called content-search.php and that will be used instead.
								 */
								get_template_part( 'template-parts/loop/content', 'search' );
								?>

							<?php endwhile; ?>

						<?php else : ?>

							<?php get_template_part( 'template-parts/loop/content', 'none' ); ?>
					
						<?php endif; ?>

				</div>

			</div>

		</main><!-- #main -->

			
			<?php themezero_pagination(); ?>


<?php get_footer(); ?>
