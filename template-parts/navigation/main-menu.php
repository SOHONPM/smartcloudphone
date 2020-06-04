<?php 

/**
 * Display Navigation 
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @since   1.0.0
 * @package themezero
 */

?>

<?php if( has_nav_menu('top') ) : ?>

<nav itemscope itemtype="http://schema.org/SiteNavigationElement" class="navbar navbar-expand-md" role="navigation">
	<div class="navbar__mobile">
	    <a class="navbar-brand" href="#">Menu</a>
	    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon">
		    	<svg width="35.477" height="27.916" viewBox="0 0 35.477 27.916" id="burgerMenu">
				  <g id="Group_26" data-name="Group 26" transform="translate(-361 -79)">
				    <rect id="Rectangle_64" data-name="Rectangle 64" width="35.477" height="6.979" rx="3.49" transform="translate(361 79)" fill="#0e2357"/>
				    <rect id="Rectangle_65" data-name="Rectangle 65" width="35.477" height="6.979" rx="3.49" transform="translate(361 89.469)" fill="#0e2357"/>
				    <rect id="Rectangle_66" data-name="Rectangle 66" width="35.477" height="6.979" rx="3.49" transform="translate(361 99.937)" fill="#0e2357"/>
				  </g>
				</svg>
		    </span>
		</button>
	</div>

     <?php 

        wp_nav_menu( array(
		    'menu'           => 'Primary Menu', // Do not fall back to first non-empty menu.
		    'depth'	         => 2,
		    'theme_location' => 'top',
		    'menu_class' 	 => 'nav navbar-nav main-menu',
		    'container'       => 'div',
			'container_class' => 'collapse navbar-collapse',
			'container_id'    => 'navbarSupportedContent',
			'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
			'walker'          => new WP_Bootstrap_Navwalker(),
		)); 

     ?>
</nav>

<?php endif; ?>