<?php
/**
 * Theme setup functions.
 *
 * @package ThinkUpThemes
 */


//----------------------------------------------------------------------------------
//	ADD CUSTOM HOOKS
//----------------------------------------------------------------------------------

// Used at top if header.php
function thinkup_hook_header() { 
	do_action('thinkup_hook_header');
}

// Used at top if header.php within the body tag
function thinkup_bodystyle() { 
	do_action('thinkup_bodystyle');
}


//----------------------------------------------------------------------------------
//	ADD THEME PLUGINS - CREDIT ATTRIBUTABLE TO http://tgmpluginactivation.com/
//----------------------------------------------------------------------------------

require_once( get_template_directory() . '/lib/plugins/theme-plugin-activation.php');
add_action( 'tgmpa_register', 'thinkup_theme_register_required_plugins' );

function thinkup_theme_register_required_plugins() {
 
    $plugins = array(
    );

    // Change this to your theme text domain, used for internationalising strings
    $theme_text_domain = 'afzaal-theme';
    $config = array(
        'domain'            => 'lan-thinkupthemes',           // Text domain - likely want to be the same as your theme.
        'default_path'      =>  '',                           // Default absolute path to pre-packaged plugins
        'parent_menu_slug'  => 'themes.php',         // Default parent menu slug
        'parent_url_slug'   => 'themes.php',         // Default parent URL slug
        'menu'              => 'install-required-plugins',   // Menu slug
        'has_notices'       => true,                         // Show admin notices or not
        'is_automatic'      => false,            // Automatically activate plugins after installation or not
        'message'           => '',               // Message to output right before the plugins table
        'strings'           => array(
            'page_title'                                => __( 'Install Required Plugins', 'lan-thinkupthemes' ),
            'menu_title'                                => __( 'Install Plugins', 'lan-thinkupthemes' ),
            'installing'                                => __( 'Installing Plugin: %s', 'lan-thinkupthemes' ), // %1$s = plugin name
            'oops'                                      => __( 'Something went wrong with the plugin API.', 'lan-thinkupthemes' ),
            'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
            'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
            'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
            'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            'return'                                    => __( 'Return to Required Plugins Installer', 'lan-thinkupthemes' ),
            'plugin_activated'                          => __( 'Plugin activated successfully.', 'lan-thinkupthemes' ),
            'complete'                                  => __( 'Plugin(s) installed and activated successfully. %s', 'lan-thinkupthemes' ) // %1$s = dashboard link
        )
    );
    tgmpa( $plugins, $config );
}


//----------------------------------------------------------------------------------
//	ADD FEATURES META BOX TO POST AREA - PREMIUM FEATURE
//----------------------------------------------------------------------------------


//----------------------------------------------------------------------------------
//	CORRECT Z-INDEX OF OEMBED OBJECTS
//----------------------------------------------------------------------------------
function thinkup_fix_oembed( $embed ) {
	if ( strpos( $embed, '<param' ) !== false ) {
   		$embed = str_replace( '<embed', '<embed wmode="transparent" ', $embed );
   		$embed = preg_replace( '/param>/', 'param><param name="wmode" value="transparent" />', $embed, 1);
	}
	return $embed;
}
add_filter( 'embed_oembed_html', 'thinkup_fix_oembed', 1 );


//----------------------------------------------------------------------------------
//	CHANGE TITLE AND DESCRIPTION OF PORTFOLIO EXTRACT BOX - PREMIUM FEATURE
//----------------------------------------------------------------------------------


//----------------------------------------------------------------------------------
//	ADD BREADCRUMBS FUNCTIONALITY
//----------------------------------------------------------------------------------

function wp_bac_breadcrumb() {
$thinkup_general_breadcrumbdelimeter = thinkup_var ( 'thinkup_general_breadcrumbdelimeter' );


	if ( empty( $thinkup_general_breadcrumbdelimeter ) ) {
		$delimiter = '<span class="delimiter">/</span>';
	}
	else if ( ! empty( $thinkup_general_breadcrumbdelimeter ) ) {
		$delimiter = '<span class="delimiter"> ' . $thinkup_general_breadcrumbdelimeter . ' </span>';
	}

	$delimiter_inner   =   '<span class="delimiter_core"> &bull; </span>';
	$main              =   'Home';
	$maxLength         =   30;

	// Archive variables
	$arc_year       =   get_the_time('Y');
	$arc_month      =   get_the_time('F');
	$arc_day        =   get_the_time('d');
	$arc_day_full   =   get_the_time('l');  

	// URL variables
	$url_year    =   get_year_link($arc_year);
	$url_month   =   get_month_link($arc_year,$arc_month);

	// Display breadcumbs if NOT the home page
	if ( !is_front_page() ) {
		echo '<div id="breadcrumbs"><div id="breadcrumbs-core">';
		global $post, $cat;
		$homeLink = home_url( '/' );
		echo '<a href="' . $homeLink . '">' . $main . '</a>' . $delimiter;    

		// Display breadcrumbs for single post
		if ( is_single() ) {
			$category = get_the_category();
			$num_cat = count($category);
			if ($num_cat <=1) {
				echo ' ' . get_the_title();
			} else {
				echo the_category( $delimiter_inner, multiple);
				if (strlen(get_the_title()) >= $maxLength) {
					echo ' ' . $delimiter . trim(substr(get_the_title(), 0, $maxLength)) . ' ...';
				} else {
					echo ' ' . $delimiter . get_the_title();
				}
			}
		} elseif (is_category()) {
			_e( 'Archive Category: ', 'lan-thinkupthemes' ) . get_category_parents($cat, true,' ' . $delimiter . ' ') ;
		} elseif ( is_tag() ) {
			_e( 'Posts Tagged: ', 'lan-thinkupthemes' ) . single_tag_title("", false) . '"';
		} elseif ( is_day()) {
			echo '<a href="' . $url_year . '">' . $arc_year . '</a> ' . $delimiter . ' ';
			echo '<a href="' . $url_month . '">' . $arc_month . '</a> ' . $delimiter . $arc_day . ' (' . $arc_day_full . ')';
		} elseif ( is_month() ) {
			echo '<a href="' . $url_year . '">' . $arc_year . '</a> ' . $delimiter . $arc_month;
		} elseif ( is_year() ) {
			echo $arc_year;
		} elseif ( is_search() ) {
			_e( 'Search Results for: ', 'lan-thinkupthemes' ) . get_search_query() . '"';
		} elseif ( is_page() && !$post->post_parent ) {
			echo get_the_title();
		} elseif ( is_page() && $post->post_parent ) {
			$post_array = get_post_ancestors( $post );
			krsort( $post_array ); 
			foreach( $post_array as $key=>$postid ){
				$post_ids = get_post( $postid );
				$title = $post_ids->post_title;
				echo '<a href="' . get_permalink($post_ids) . '">' . $title . '</a>' . $delimiter;
			}
			the_title();
		} elseif ( is_author() ) {
			global $author;
			$user_info = get_userdata($author);
			_e( 'Archived Article(s) by Author: ', 'lan-thinkupthemes' ) . $user_info->display_name ;
		} elseif ( is_404() ) {
			_e( 'Error 404 - Not Found.', 'lan-thinkupthemes' );
		} elseif ( is_post_type_archive( $portfolio )	) {
			_e( 'Portfolio', 'lan-thinkupthemes' );
		}
       echo '</div></div>';
    }
}

//----------------------------------------------------------------------------------
//	ADD PAGINATION FUNCTIONALITY
//----------------------------------------------------------------------------------
function thinkup_input_pagination( $pages = "", $range = 2 ) {
global $paged;
global $wp_query;

	$showitems = ($range * 2)+1;  

	if(empty($paged)) $paged = 1;

	if($pages == "") {

		$pages = $wp_query->max_num_pages;
		if(!$pages) {
			$pages = 1;
		}
	}

	if(1 != $pages) {

		echo '<ul class="pag">';
		
			if($paged > 2 && $paged > $range+1 && $showitems < $pages) 
				echo '<li class="pag-first"><a href="' . get_pagenum_link(1). '">&laquo;</a></li>';
			if($paged > 1 && $showitems < $pages) 
				echo '<li class="pag-previous"><a href="' . get_pagenum_link($paged - 1). '">&lsaquo; ' . __( 'Prev', 'lan-thinkupthemes' ) . '</a></li>';
			for ($i=1; $i <= $pages; $i++) {
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
					echo ($paged == $i)? '<li class="current"><span>' . $i . '</span></li>':'<li><a href="' . get_pagenum_link($i) . '">'. $i . '</a></li>';
				}
			}

			if ($paged < $pages && $showitems < $pages) 
				echo '<li class="pag-next"><a href="' . get_pagenum_link($paged + 1) . '">' . __( 'Next', 'lan-thinkupthemes' ) . ' &rsaquo;</a></li>';
			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) 
				echo '<li class="pag-last" ><a href="' . get_pagenum_link($pages) . '">&raquo;</a></li>';
		echo '</ul>';
     }
}


//----------------------------------------------------------------------------------
//	REMOVE NON VALID REL CATEGORY TAGS
//----------------------------------------------------------------------------------

function add_nofollow_cat( $text ) { 
	$text = str_replace( 'rel="category"', "", $text );
	return $text; 
};
add_filter( 'the_category', 'add_nofollow_cat' );  


//----------------------------------------------------------------------------------
//	ADD CUSTOM FEATURED IMAGE SIZES
//----------------------------------------------------------------------------------

function thinkup_input_addimagesizes() {

	// 1 Column Layout
	add_image_size( 'column1-1/3', 1140, 380, true );
	add_image_size( 'column1-2/3', 1140, 760, true );
	add_image_size( 'column1-2/5', 1140, 456, true );

	// 2 Column Layout
	add_image_size( 'column2-1/2', 570, 285, true );
	add_image_size( 'column2-2/3', 570, 380, true );
	add_image_size( 'column2-2/5', 570, 228, true );
	add_image_size( 'column2-3/5', 570, 342, true );

	// 3 Column Layout
	add_image_size( 'column3-2/3', 380, 254, true );

	// 4 Column Layout
	add_image_size( 'column4-2/3', 285, 190, true );
}
add_action( 'init', 'thinkup_input_addimagesizes' );
 
function thinkup_input_showimagesizes($sizes) {

	// 1 Column Layout
	$sizes['column1-1/3'] = 'Full - 1:3';
	$sizes['column1-2/3'] = 'Full - 2:3';
	$sizes['column1-2/5'] = 'Full - 2:5';

	// 2 Column Layout
	$sizes['column2-1/2'] = 'Half - 1:2';
	$sizes['column2-2/3'] = 'Half - 2:3';
	$sizes['column2-2/5'] = 'Half - 2:5';
	$sizes['column2-3/5'] = 'Half - 3:5';

	// 3 Column Layout
	$sizes['column3-2/3'] = 'Third - 2:3';

	// 4 Column Layout
	$sizes['column4-2/3'] = 'Quarter - 2:3';

	return $sizes;
}
add_filter('image_size_names_choose', 'thinkup_input_showimagesizes');


//----------------------------------------------------------------------------------
//	ADD HOME: HOME TO CUSTOM MENU PAGE LIST
//----------------------------------------------------------------------------------

function home_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'home_page_menu_args' );


//----------------------------------------------------------------------------------
//	ADD CUSTOM 'get_comments_popup_link' FUNCTION - Credit to http://www.thescubageek.com/code/wordpress-code/add-get_comments_popup_link-to-wordpress/
//----------------------------------------------------------------------------------

// Modifies WordPress's built-in comments_popup_link() function to return a string instead of echo comment results
function get_comments_popup_link( $zero = false, $one = false, $more = false, $css_class = '', $none = false ) {
    global $wpcommentspopupfile, $wpcommentsjavascript;
 
    $id = get_the_ID();
 
    if ( false === $zero ) $zero = __( 'No Comments','lan-thinkupthemes' );
    if ( false === $one ) $one = __( '1 Comment','lan-thinkupthemes' );
    if ( false === $more ) $more = __( '% Comments','lan-thinkupthemes' );
    if ( false === $none ) $none = __( 'Comments Off','lan-thinkupthemes' );
 
    $number = get_comments_number( $id );
 
    $str = '';
 
    if ( 0 == $number && !comments_open() && !pings_open() ) {
        $str = '<span' . ((!empty($css_class)) ? ' class="' . esc_attr( $css_class ) . '"' : '') . '>' . $none . '</span>';
        return $str;
    }
 
    if ( post_password_required() ) {
        $str = __('Enter your password to view comments.','lan-thinkupthemes');
        return $str;
    }
 
    $str = '<a href="';
    if ( $wpcommentsjavascript ) {
        if ( empty( $wpcommentspopupfile ) )
            $home = home_url();
        else
            $home = get_option('siteurl');
        $str .= $home . '/' . $wpcommentspopupfile . '?comments_popup=' . $id;
        $str .= '" onclick="wpopen(this.href); return false"';
    } else { // if comments_popup_script() is not in the template, display simple comment link
        if ( 0 == $number )
            $str .= get_permalink() . '#respond';
        else
            $str .= get_comments_link();
        $str .= '"';
    }
 
    if ( !empty( $css_class ) ) {
        $str .= ' class="'.$css_class.'" ';
    }
    $title = the_title_attribute( array('echo' => 0 ) );
 
    $str .= apply_filters( 'comments_popup_link_attributes', '' );
 
    $str .= ' title="' . esc_attr( sprintf( __('Comment on %s','lan-thinkupthemes'), $title ) ) . '">';
    $str .= get_comments_number_str( $zero, $one, $more );
    $str .= '</a>';
     
    return $str;
}
 
// Modifies WordPress's built-in comments_number() function to return string instead of echo
function get_comments_number_str( $zero = false, $one = false, $more = false, $deprecated = '' ) {
    if ( !empty( $deprecated ) )
        _deprecated_argument( __FUNCTION__, '1.3' );
 
    $number = get_comments_number();
 
    if ( $number > 1 )
        $output = str_replace('%', number_format_i18n($number), ( false === $more ) ? __( '% Comments', 'lan-thinkupthemes' ) : $more);
    elseif ( $number == 0 )
        $output = ( false === $zero ) ? __( 'No Comments', 'lan-thinkupthemes' ) : $zero;
    else // must be one
        $output = ( false === $one ) ? __( '1 Comment', 'lan-thinkupthemes' ) : $one;
 
    return apply_filters('comments_number', $output, $number);
}


//----------------------------------------------------------------------------------
//	CHANGE FALLBACK WP_PAGE_MENU CLASSES TO MATCH WP_NAV_MENU CLASSES
//----------------------------------------------------------------------------------

function add_menuclass( $ulclass ) {

	$ulclass = preg_replace( '/<ul>/', '<ul class="menu">', $ulclass, 1 );
	$ulclass = str_replace( 'children', 'sub-menu', $ulclass );

	return preg_replace('/<div (.*)>(.*)<\/div>/iU', '$2', $ulclass );
}
add_filter( 'wp_page_menu', 'add_menuclass' );


//----------------------------------------------------------------------------------
//	DETERMINE IF THE PAGE IS A BLOG - USEFUL FOR HOMEPAGE BLOG.
//----------------------------------------------------------------------------------

// Credit to: http://www.poseidonwebstudios.com/web-development/wordpress-is_blog-function/
function is_blog() {
 
    global $post;
 
    //Post type must be 'post'.
    $post_type = get_post_type($post);
 
    //Check all blog-related conditional tags, as well as the current post type,
    //to determine if we're viewing a blog page.
    return (
        ( is_home() || is_archive() || is_single() )
        && ($post_type == 'post')
    ) ? true : false ;
 
}


?>