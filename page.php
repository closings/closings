<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 *
 * @package ThinkUpThemes
 */

get_header(); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php thinkup_input_nav( 'nav-below' ); ?>

				<?php thinkup_input_allowcomments(); ?>

			<?php endwhile; wp_reset_query(); ?>

<?php get_footer(); ?>