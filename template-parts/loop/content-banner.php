<?php 

/**
 * Display Content Banner
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @since   1.0.0
 * @package themezero
 */


?>
<!-- Banner -->
<div class="banner banner__sub" itemscope itemtype="http://schema.org/WebPageElement">
	<div class="container">
		<div class="banner__inner">
	       
	          <div class="banner__header">  
					
				 <?php if(  is_archive() ) : ?>	
					<h1 class="banner__title">
						<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
						?>
					</h1>
	             <?php else: ?>
	              	<h1 class="banner__title"><?php echo get_the_title() ?></h1>
				 <?php endif; ?>
				 
	          </div>  
	          
	     </div>
	</div>
</div>
<!-- ./banner -->


