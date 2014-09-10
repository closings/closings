<?php
/**
 * Add Recent Comments Widget.
 *
 * @package ThinkUpThemes
 */


//----------------------------------------------------------------------------------
//	Recent Comments
//----------------------------------------------------------------------------------

class thinkup_widget_recentcomments extends WP_Widget {

	// Register widget description.
	function thinkup_widget_recentcomments() {
		$widget_ops = array('classname' => 'thinkup_widget_recentcomments', 'description' => 'Display your recent comments.' );
		$this->WP_Widget('thinkup_widget_recentcomments', 'ThinkUpThemes: Recent Comments', $widget_ops);
	}

	// Add widget structure to Admin area.
	function form($instance) {
		$default_entries = array( 'title' => '', 'commentcount' => '5', 'excerptlength' => '30','commentdate' => '' , 'imagesize_width' => '50', 'imagesize_height' => '50' );
		$instance = wp_parse_args( (array) $instance, $default_entries );

		$title         = $instance['title'];
		$commentcount  = $instance['commentcount'];
		$excerptlength = $instance['excerptlength'];
		$commentdate   = $instance['commentdate'];

		$commentdate_check = NULL;

		if ($commentdate == 'on') { $commentdate_check = 'checked=checked'; }
	
		echo '<p><label for="' . $this->get_field_id('title') . '">Title: <input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . esc_attr($title) . '" style="width: 80px;margin-left: 113px;" /></label></p>';

		echo '<p><label for="' . $this->get_field_id('commentcount') . '">Number of posts: <input class="widefat" id="' . $this->get_field_id('commentcount') . '" name="' . $this->get_field_name('commentcount') . '" type="text" value="' . $commentcount . '" style="width: 80px;margin-left: 45px;" /></label></p>';
	
		echo '<p><label for="' . $this->get_field_id('excerptlength') . '">Excerpt Length (letters)?<input class="widefat" id="' . $this->get_field_id('excerptlength') . '" name="' . $this->get_field_name('excerptlength') . '" type="text" value="' . $excerptlength . '" style="width: 80px;margin-left: 10px;" /></label></p>';	

		echo '<p><label for="' . $this->get_field_id('commentdate') . '">Show comment date?</label>&nbsp;<input id="' . $this->get_field_id('commentdate') . '" name="' . $this->get_field_name('commentdate') . '" type="checkbox" ' . $commentdate_check . ' style="margin-left: 86px;" /></p>';
	}

	// Assign variable values.
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title']         = $new_instance['title'];
		$instance['commentcount']  = $new_instance['commentcount'];
		$instance['excerptlength'] = $new_instance['excerptlength'];
		$instance['commentdate']   = $new_instance['commentdate'];
		return $instance;
	}

	// Output widget to front-end.
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$title = empty($instance['title']) ? __( 'Recent Comments', 'lan-thinkupthemes' ) : apply_filters('widget_title', $instance['title']);
		if (!empty($title))
			echo $before_title . $title . $after_title;;

		if ( is_numeric( $instance['commentcount'] ) and !empty( $instance['commentcount'] ) ) {
			$commentcount_input = $instance['commentcount'];
		} else {
			$commentcount_input = 5;
		}
		if ( is_numeric( $instance['excerptlength'] ) and !empty( $instance['excerptlength'] ) ) {
			$excerptlength_input = $instance['excerptlength'];
		} else {
			$excerptlength_input = 20;
		}
 
		global $wpdb;
		$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
		comment_post_ID, comment_author, comment_date_gmt, comment_approved,
		comment_type,comment_author_url,
		SUBSTRING(comment_content,1," . $excerptlength_input . ") AS com_excerpt
		FROM $wpdb->comments
		LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
		$wpdb->posts.ID)
		WHERE comment_approved = '1' AND comment_type = '' AND
		post_password = ''
		ORDER BY comment_date_gmt DESC
		LIMIT " . $commentcount_input . "";

		$comments = $wpdb->get_results($sql);

		foreach ($comments as $comment) {
			echo '<div class="recent-comments">';
			echo '<div class="image">';
				echo '<a href="' . get_permalink($comment->ID) . '#comment-' . $comment->comment_ID . '">';
				echo  get_avatar( $comment, "65" );
				echo '<div class="image-overlay"></div></a>';
			echo '</div>';

			echo '<div class="main">';
				echo '<a href="' . get_permalink($comment->ID) . '#comment-' . $comment->comment_ID . '" class="quote">';
				echo strip_tags($comment->com_excerpt) . '&hellip;';
				echo '</a>';

				echo '<a href="' . get_permalink($comment->ID) . '#comment-' . $comment->comment_ID . '" class="date">';
				if ( $instance['commentdate'] == 'on' ) {
					echo get_comment_date( 'M j, Y', $comment->comment_ID );
				}
				echo '</a>';
			echo '</div>';
			echo '</div>';
		}

		echo $after_widget;
	}

}
add_action( 'widgets_init', create_function('', 'return register_widget("thinkup_widget_recentcomments");') );


?>