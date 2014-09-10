<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package ThinkUpThemes
 */
?>

		<div id="sidebar">
		<div id="sidebar-core">

			<?php do_action( 'before_sidebar' ); ?>
			<?php if ( ! dynamic_sidebar( thinkup_input_sidebars() ) ) : ?>

				<aside id="search" class="widget widget_search">
					<h3 class="widget-title"><?php _e( 'Please Add Widgets', 'lan-thinkupthemes' ); ?></h3>
					<div class="widget-main"><div class="error-icon">
						<p><?php _e( 'Remove this message by adding widgets to the Sidebar from the Widgets section of the Wordpress admin area.', 'lan-thinkupthemes' ); ?></p>
						<a href="<?php echo admin_url( 'admin.php' ); ?>" title="No Widgets Selected"><?php _e( 'Click here to go to Widget area.', 'lan-thinkupthemes' ); ?></a>
					</div></div>
				</aside>

			<?php endif; ?>

		</div>
		</div><!-- #sidebar -->
				