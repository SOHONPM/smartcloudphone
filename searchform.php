<?php
/**
* The template to display the search form 
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
?>
<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search" class="form form__search">

	<label class="sr-only assistive-text" for="s"><?php esc_html_e( 'Search', 'themezero' ); ?></label>

	<div class="input-group">

		<input class="field form-control" id="s" name="s" type="text" placeholder="<?php esc_attr_e( 'Search &hellip;', 'themezero' ); ?>">

			<span class="input-group-btn">
				<input class="submit btn btn-primary" id="searchsubmit" name="submit" type="submit"
				value="<?php esc_attr_e( 'Search', 'themezero' ); ?>">
			</span>
	</div>
	
</form>
