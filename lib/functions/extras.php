<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * @package ThinkUpThemes
 */


/* Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link. */
function thinkup_input_pagemenuargs( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'thinkup_input_pagemenuargs' );


/* Adds custom classes to the array of body classes. */
function thinkup_input_bodyclasses( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'thinkup_input_bodyclasses' );


/* Filter in a link to a content ID attribute for the next/previous image links on image attachment pages. */
function thinkup_input_enhancedimagenav( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'thinkup_input_enhancedimagenav', 10, 2 );


/* Filters wp_title to print a neat <title> tag based on what is being viewed. */
function thinkup_input_wptitle( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( 'Page %s', max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'thinkup_input_wptitle', 10, 2 );