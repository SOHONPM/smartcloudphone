<?php

/**
 * Theme Header
 *
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @since   1.0.0
 * @package themezero
 *
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js"></script>
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<!-- Preloader -->
	<div class="preloader">
		<div class="preloader-inner">
			<span class="fa fa-spinner fa-spin" aria-hidden="true"></span>
		</div>
	</div>
	<!-- ./Preloader -->
	<!-- Site-header -->
	<header id="masthead" class="site-header" itemscope itemtype="http://schema.org/WPHeader">
		<a class="callus_mobile" href="tel:<?php echo $header_info; ?>"><i class="fa fa-phone"></i></a>
		<div class="site-header__top">
			<div class="container">
				<div class="grid">
					<div class="col--left">
						<?php
						$header_info = get_theme_mod('header_info');

						if ($header_info) : ?>
							<span> CALL US <?php echo $header_info; ?></span>
						<?php endif; ?>
					</div>
					<div class="col--right">
						<span>
							<?php
							$header_info2 = get_theme_mod('header_info_2');

							if ($header_info2) : ?>
								<?php echo $header_info2; ?>
							<?php endif; ?>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="site-header__middle">
			<div class="container">

				<!-- Site-logo -->
				<div class="site-logo">
					<?php //themezero_get_logo() 
					?>
					<?php the_custom_logo() ?>

				</div>
				<!-- ./Site-logo -->

				<?php if (has_nav_menu('top')) : ?>
					<!-- Site Nav -->
					<div class="site-nav">
						<?php get_template_part('template-parts/navigation/main', 'menu'); ?>
						<?php if (get_theme_mod('header_button')) :
						?>
							<?php echo get_theme_mod('header_button')
							?>
						<?php endif;
						?>
					</div>

					<!-- . Site Nav -->
				<?php endif; ?>
			</div>
		</div>
	</header>
	<!-- ./Site-header -->
	<!-- Accessibility -->
	<div class="container screen-reader-text">
		<a href="#main"><?php __('Skip to main content', 'themezero') ?></a>
	</div>
	<!-- ./Accessibility -->