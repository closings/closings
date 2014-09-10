<?php
/**
 * The template for displaying front page content.
 *
 * This template will then load home.php or page.php depending on users front page display settings.
 *
 * @package ThinkUpThemes
 */

	if ( 'posts' == get_option( 'show_on_front' ) ) {
		include( get_home_template() );
	} else {
		include( get_page_template() );
	}

?>