<?php
/**
 * Add Popular Posts Widget.
 *
 * @package ThinkUpThemes
 */


//----------------------------------------------------------------------------------
//	Popular Posts
//----------------------------------------------------------------------------------

class thinkup_widget_popularposts extends WP_Widget {

	// Register widget description.
	function thinkup_widget_popularposts() {
		$widget_ops = array('classname' => 'thinkup_widget_popularposts', 'description' => 'Display your posts by comment count.' );
		$this->WP_Widget('thinkup_widget_popularposts', 'ThinkUpThemes: Popular Posts', $widget_ops);
	}

	// Add widget structure to Admin area.
	function form($instance) {
		$default_entries = array( 'title' => '', 'postcount' => '5', 'excerpt' => '', 'excerptlength' => '20' , 'comments' => '' );
		$instance = wp_parse_args( (array) $instance, $default_entries );

		$title         = $instance['title'];
		$postcount     = $instance['postcount'];
		$excerpt       = $instance['excerpt'];
		$excerptlength = $instance['excerptlength'];
		$comments      = $instance['comments'];

		$excerpt_check = NULL;
		$comments_check = NULL;
		
		if ($excerpt == 'on')  { $excerpt_check = 'checked=checked'; }
		if ($comments == 'on') { $comments_check = 'checked=checked'; }
	
		echo '<p><label for="' . $this->get_field_id('title') . '">Title: <input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . esc_attr($title) . '" style="width: 106px;margin-left: 88px;" /></label></p>';

		echo '<p><label for="' . $this->get_field_id('postcount') . '">Number of posts: <input class="widefat" id="' . $this->get_field_id('postcount') . '" name="' . $this->get_field_name('postcount') . '" type="text" value="' . $postcount . '" style="width: 106px;margin-left: 20px;" /></label></p>';
	
		echo '<p><label for="' . $this->get_field_id('excerpt') . '">Show excerpt?</label>&nbsp;<input id="' . $this->get_field_id('excerpt') . '" name="' . $this->get_field_name('excerpt') . '" type="checkbox" ' . $excerpt_check . ' style="margin-left: 125px;" /></p>';

		echo '<p><label for="' . $this->get_field_id('excerptlength') . '">Excerpt length: <input class="widefat" id="' . $this->get_field_id('excerptlength') . '" name="' . $this->get_field_name('excerptlength') . '" type="text" value="' . $excerptlength . '" style="width: 106px;margin-left: 35px;" /></label></p>';

		echo '<p><label for="' . $this->get_field_id('comments') . '">Show Comments?</label>&nbsp;<input id="' . $this->get_field_id('comments') . '" name="' . $this->get_field_name('comments') . '" type="checkbox" ' . $comments_check . ' style="margin-left: 104px;" /></p>';	

	}

	// Assign variable values.
	function update($new_instance, $old_instance) {
		$instance                  = $old_instance;
		$instance['title']         = $new_instance['title'];
		$instance['postcount']     = $new_instance['postcount'];
		$instance['excerpt']       = $new_instance['excerpt'];
		$instance['excerptlength'] = $new_instance['excerptlength'];
		$instance['comments']      = $new_instance['comments'];	
		return $instance;
	}

	// Output widget to front-end.
	function widget($args, $instance) {
	global $post;
	
	$excerpt = NULL;
	$comment_input = NULL;
						
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$title = empty($instance['title']) ? __( 'Popular Posts', 'lan-thinkupthemes' ) : apply_filters('widget_title', $instance['title']);
		if (!empty($title))
			echo $before_title . $title . $after_title;

		$posts = new WP_Query('orderby=comment_count&posts_per_page=' . $instance['postcount'] . '');
		while ($posts->have_posts()) : $posts->the_post();

			/* Insert excerpt if needed. */
			if ( $instance['excerpt'] == 'on' ) {
				if ( is_numeric ($instance['excerptlength'] ) ) {
					$excerpt_input = $instance['excerptlength'];
				} else {
					$excerpt_input = '45';
				}
				$excerpt = '<a class="excerpt" href="' . get_permalink() . '">' . substr(get_the_excerpt(), 0, $excerpt_input ) . '...</a>';
			}

			// Insert comments if needed.
			if ( $instance['comments'] == 'on' ) {
				$comment_input = get_comments_popup_link( __( 'No Comments', 'lan-thinkupthemes' ), __( '1 Comment', 'lan-thinkupthemes' ), __( '% Comments', 'lan-thinkupthemes' ), 'comment' );
			}

			// HTML output
			echo '<div class="popular-posts">';
				if ( has_post_thumbnail() ) {
				echo	'<div class="image">',
						'<a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_post_thumbnail( $post->ID, array(65,65) ) . '<div class="image-overlay"></div></a>',
						'</div>',
						'<div class="main">',
						'<a class="title" href="' . get_permalink() . '">' . get_the_title() . '</a>',
						$excerpt,
						$comment_input,
						'</div>';
				} else {
				echo	'<div class="main">',
						'<a class="title" href="' . get_permalink() . '">' . get_the_title() . '</a>',
						$excerpt,
						$comment_input,
						'</div>';
				}
			echo '</div>';
		endwhile; wp_reset_query();

		echo $after_widget;
	}

}
add_action( 'widgets_init', create_function('', 'return register_widget("thinkup_widget_popularposts");') );


?>