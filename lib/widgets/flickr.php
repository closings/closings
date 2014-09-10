<?php
/**
 * Add Flickr Widget.
 *
 * @package ThinkUpThemes
 */


//----------------------------------------------------------------------------------
//	Flickr
//----------------------------------------------------------------------------------

class thinkup_widget_flickr extends WP_Widget {

	// Register widget description.
	function thinkup_widget_flickr() {
		$widget_ops = array('classname' => 'thinkup_widget_flickr', 'description' => 'Import your Flickr photos for all to see!' );
		$this->WP_Widget('thinkup_widget_flickr', 'ThinkUpThemes: Flickr', $widget_ops);
	}

	// Add widget structure to Admin area.
	function form($instance) {
		$default_entries = array( 'title' => '', 'flickrid' => '' , 'photocount' => '', 'layout' => '' );
		$instance = wp_parse_args( (array) $instance, $default_entries );

		$title      = $instance['title'];
		$flickrid   = $instance['flickrid'];
		$photocount = $instance['photocount'];
		$layout     = $instance['layout'];

		echo '<p><label for="' . $this->get_field_id('title') . '">Title: <input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . esc_attr($title) . '" /></label></p>';

		echo '<p><label for="' . $this->get_field_id('flickrid') . '">Flickr ID:       (Find Id at <a href="http://idgettr.com/">idGettr</a>)<input class="widefat" id="' . $this->get_field_id('flickrid') . '" name="' . $this->get_field_name('flickrid') . '" type="text" value="' . esc_attr($flickrid) . '" /></label></p>';

		echo '<p><label for="' . $this->get_field_id('photocount') . '">Number of photos: <input class="widefat" id="' . $this->get_field_id('photocount') . '" name="' . $this->get_field_name('photocount') . '" type="text" value="' . esc_attr($photocount) . '" /></label></p>';

		echo '<p><label for="' . $this->get_field_id('layout') . '" >Layout:
			<select name="' . $this->get_field_name('layout') . '" id="' . $this->get_field_id('layout') . '" style="margin-left:13px;width: 75%;" >
			<option '; ?><?php if($layout == "column-2") { echo "selected"; } ?><?php echo ' value="column-2">2 Column</option>
			<option '; ?><?php if($layout == "column-3") { echo "selected"; } ?><?php echo ' value="column-3">3 Column</option>
			<option '; ?><?php if($layout == "column-4") { echo "selected"; } ?><?php echo ' value="column-4">4 Column</option>
			</select>
		</label></p>';
	}

	// Assign variable values.
	function update($new_instance, $old_instance) {
		$instance               = $old_instance;
		$instance['title']      = $new_instance['title'];
		$instance['flickrid']   = $new_instance['flickrid'];
		$instance['photocount'] = $new_instance['photocount'];
		$instance['layout']     = $new_instance['layout'];
		return $instance;
	  }

	// Output widget to front-end.
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
	 
		echo $before_widget;
		$title = empty($instance['title']) ? __( 'Flickr Feed', 'lan-thinkupthemes') : apply_filters('widget_title', $instance['title']);
		if (!empty($title))
		  echo $before_title . $title . $after_title;

		$flickrphoto = wp_remote_get('http://api.flickr.com/services/rest/?method=flickr.people.getPublicPhotos&api_key=66e5aec1e597a51e1453e58b41dc749a&user_id=' . $instance['flickrid'] . '&per_page=' . $instance['photocount'] . '&format=json');

		if ( !is_wp_error($flickrphoto) ) {
			$flickrphoto = json_decode( trim($flickrphoto['body'], 'jsonFlickrApi()') ); 
		}

		echo '<div class="flickr ' .  $instance['layout'] . '">';
			
		if($flickrphoto->photos->photo) {

			foreach($flickrphoto->photos->photo as $flickrphoto) { $flickrphoto = (array) $flickrphoto;
			$flickrphoto_url = 	'http://farm' . $flickrphoto['farm'] . '.static.flickr.com/' . $flickrphoto['server'] . '/' . $flickrphoto['id'] . '_' . $flickrphoto['secret'] . 'lan-thinkupthemes' . '.jpg';
			echo '<div class="flickr-photo">'.
			     '<a href="http://www.flickr.com/photos/' . $instance['flickrid'] . '/' . $flickrphoto['id'] . '">',
			     '<img src="' . $flickrphoto_url . '" alt="' . $flickrphoto['title'] . '" width="75" height="75" />',
			     '<div class="image-overlay"></div>',
			     '</a>',
			     '</div>';
			}
		} else {
			echo '<div class="error-icon">' . __( 'Oops! There&#39;s been an error!', 'lan-thinkupthemes') . '<br />' .  __( 'Check that the Flickr ID is correct at', 'lan-thinkupthemes') . '<a href="http://idgettr.com/">http://idgettr.com/</a>.</div>';
			}
			echo	'<div style="clear: both;"></div>';
			echo	'</div>';
	 
		echo $after_widget;
	}
	 
}
add_action( 'widgets_init', create_function('', 'return register_widget("thinkup_widget_flickr");') );


?>