<?php
/**
 * The template for displaying Archive pages.
 *
 * @package ThinkUpThemes
 */

get_header(); ?>

			<?php if( have_posts() ): ?>

				<div id="container" class="portfolio-wrapper">

				<?php while( have_posts() ): the_post(); ?>

					<div class="blog-grid element column-2">

					<article id="post-<?php the_ID(); ?>" <?php post_class('blog-style1'); ?>>

						<?php think_input_blogtitle(); ?>

						<header class="entry-header">

							<?php thinkup_input_blogimage(); ?>
							<?php thinkup_input_blogformat(); ?>

						</header>

						<div class="entry-content">

							<?php thinkup_input_blogtext(); ?>
							<?php thinkup_input_readmore(); ?>

						</div>

						<?php thinkup_input_blogmeta(); ?>

					</article><!-- #post-<?php get_the_ID(); ?> -->	

					</div>

				<?php endwhile; ?>

				</div><div class="clearboth"></div>

				<?php thinkup_input_pagination(); ?>

			<?php else: ?>

				<?php get_template_part( 'no-results', 'archive' ); ?>		

			<?php endif; wp_reset_query(); ?>

<?php get_footer() ?>