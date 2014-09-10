<?php
/**
 * The template for displaying content on the search results page.
 *
 * @package ThinkUpThemes
 */
?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('blog-style1'); ?>>

						<?php thinkup_input_blogformat(); ?>

						<?php think_input_blogtitle(); ?>
							
						<div class="entry-content">
							<?php the_excerpt(); ?>
							<?php thinkup_input_readmore(); ?>

							<div class="entry-meta">
								<?php thinkup_input_blogauthor(); ?>
								<?php thinkup_input_blogdate(); ?>
								<?php thinkup_input_blogcomment(); ?>
								<?php thinkup_input_blogcategory(); ?>
								<?php thinkup_input_blogtag(); ?>
							</div>
						</div>

					<div class="clearboth"></div>
					</article><!-- #post-<?php get_the_ID(); ?> -->	