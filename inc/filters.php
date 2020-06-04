<?php

/** 
 * Theme filters
 *
 * Learn more: https://codex.wordpress.org/Plugin_API
 *
 * @since   1.0.0
 * @package themezero
 */



if (!function_exists('themezero_excerpt_more')) {
	/**
	 * Removes the ... from the excerpt read more link
	 *
	 * @param string $more The excerpt.
	 *
	 * @return string
	 */
	function themezero_excerpt_more($more)
	{
		return '';
	}
}


if (!function_exists('themezero_all_excerpts_get_more_link')) {
	/**
	 * Adds a custom read more link to all excerpts, manually or automatically generated
	 *
	 * @param string $post_excerpt Posts's excerpt.
	 *
	 * @return string
	 */
	function themezero_all_excerpts_get_more_link($post_excerpt)
	{

		return $post_excerpt . ' ...<p> <a href="' . get_permalink(get_the_ID()) . '">' . __(
			'Read More',
			'themezero'
		) . '</a></p>';
	}
}


/**
 *  Add class to body tags
 */
function themezero_body_classes($classes)
{


	if (is_front_page()) {

		$classes[] = 'front-page';
	} else {
		$classes[] = 'sub-page';
	}

	return $classes;
}

/**
 *  Add svg upload capability
 */
function themezero_mime_types($mimes)
{

	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}

add_filter('excerpt_more', 'themezero_excerpt_more');
add_filter('wp_trim_excerpt', 'themezero_all_excerpts_get_more_link');
add_filter('body_class', 'themezero_body_classes');
add_filter('upload_mimes', 'themezero_mime_types');
