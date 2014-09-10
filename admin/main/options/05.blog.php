<?php
/**
 * Blog functions.
 *
 * @package ThinkUpThemes
 */


//----------------------------------------------------------------------------------
//	HIDE POST TITLE
//----------------------------------------------------------------------------------

function think_input_blogtitle() {
global $thinkup_blog_title;

	echo	'<h2 class="blog-title">',
		'<a href="' . get_permalink() . '" title="' . esc_attr( sprintf( __( 'Permalink to %s', 'lan-thinkupthemes' ), the_title_attribute( 'echo=0' ) ) ) . '">' . get_the_title() . '</a>',
		'</h2>';
}


//----------------------------------------------------------------------------------
//	BLOG CONTENT
//----------------------------------------------------------------------------------

// Input post thumbnail / featured media - Style 2
function thinkup_input_blogimage() {
global $post;

	echo '<div class="blog-thumb"><a href="'. get_permalink($post->ID) . '">' . get_the_post_thumbnail( $post->ID, 'column1-2/5' ) . '</a></div>';
}

// Input post excerpt / content to blog page
function thinkup_input_blogtext() {
global $more;
global $post;
global $thinkup_blog_postswitch;

	// Output post thumbnail / featured media
	if ( is_search() ) {
		the_excerpt();
	} else if ( ! is_search() ) {
		if ( $thinkup_blog_postswitch == 'option1' or empty( $thinkup_blog_postswitch ) ) {
			the_excerpt();
		} else if ( $thinkup_blog_postswitch == 'option2' ) {

			// Allow user to user <!--more--> HTML tag
			$more = 0;

			// Remove all HMTL from the_content - Only allow specified tags
			ob_start();
			the_content('');
			$old_content = ob_get_clean();
			$new_content = strip_tags($old_content, '<p><a><b><br/><br /><input><form><textarea><li><ol><ul><table><h1><h2><h3><h4><h5><h6>');
			echo $new_content;
		}
	}
}


//----------------------------------------------------------------------------------
//	BLOG META CONTENT & POST META CONTENT
//----------------------------------------------------------------------------------

// Input blog format
function thinkup_input_blogformat() {

	if ( get_post_format() == 'gallery' ) {
		echo '<div class="blog-icon gallery"><a href="' . get_permalink() . '"><i class="icon-picture icon-large"></i></a></div>';
	} else if ( get_post_format() == 'image' ) {
		echo '<div class="blog-icon image"><a href="' . get_permalink() . '"><i class="icon-picture icon-large"></i></a></div>';
	} else if ( get_post_format() == 'video' ) {
		echo '<div class="blog-icon video"><a href="' . get_permalink() . '"><i class="icon-film icon-large"></i></a></div>';
	} else if ( get_post_format() == 'audio' ) {
		echo '<div class="blog-icon audio"><a href="' . get_permalink() . '"><i class="icon-volume-up icon-large"></i></a></div>';
	} else if ( get_post_format() == 'status' ) {
		echo '<div class="blog-icon status"><a href="' . get_permalink() . '"><i class="icon-rss icon-large"></i></a></div>';
	} else if ( get_post_format() == 'quote' ) {
		echo '<div class="blog-icon quote"><a href="' . get_permalink() . '"><i class="icon-quote-left icon-large"></i></a></div>';
	} else if ( get_post_format() == 'link' ) {
		echo '<div class="blog-icon link"><a href="' . get_permalink() . '"><i class="icon-link icon-large"></i></a></div>';
	} else if ( get_post_format() == 'chat' ) {
		echo '<div class="blog-icon chat"><a href="' . get_permalink() . '"><i class="icon-comment-alt icon-large"></i></a></div>';
	}
}

// Input sticky post
function thinkup_input_sticky() {
	printf( '<span class="sticky"><i class="icon-pushpin"></i><a href="%1$s" title="%2$s">' . __( 'Sticky', 'lan-thinkupthemes' ) . '</a></span>',
		esc_url( get_permalink() ),
		esc_attr( get_the_title() )
	);
}

// Input blog date
function thinkup_input_blogdate() {
	printf( '<span class="date"><i class="fa fa-calendar-o"></i><a href="%1$s" title="%2$s"><time datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( get_the_title() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date( 'M j, Y' ) )
	);
}

// Input blog comments
function thinkup_input_blogcomment() {

	if ( '0' != get_comments_number() ) {
		echo	'<span class="comment"><i class="fa fa-comments"></i>';
			if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) {;
				comments_popup_link( __( '0 Comments', 'lan-thinkupthemes' ), __( '1 Comment', 'lan-thinkupthemes' ), __( '% Comments', 'lan-thinkupthemes' ) );
			};
		echo	'</span>';
	}
}

// Input blog categories
function thinkup_input_blogcategory() {
$categories_list = get_the_category_list( __( ', ', 'lan-thinkupthemes' ) );

	if ( $categories_list && thinkup_input_categorizedblog() ) {
		echo	'<span class="category"><i class="fa fa-folder-open-o"></i>';
		printf( __( '%1$s', 'lan-thinkupthemes' ), $categories_list );
		echo	'</span>';
	};
}

// Input blog tags
function thinkup_input_blogtag() {
$tags_list = get_the_tag_list( '', __( ', ', 'lan-thinkupthemes' ) );

	if ( $tags_list ) {
		echo	'<span class="tags"><i class="fa fa-tags"></i>';
		printf( __( '%1$s', 'lan-thinkupthemes' ), $tags_list );
		echo	'</span>';
	};
}

// Input blog author
function thinkup_input_blogauthor() {
	printf( __( '<span class="author"><i class="fa fa-pencil"></i><a href="%1$s" title="%2$s" rel="author">%3$s</a></span>', 'lan-thinkupthemes' ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'lan-thinkupthemes' ), get_the_author() ) ),
		get_the_author()
	);
}

// Input 'Read more' link
function thinkup_input_readmore() {
global $post;
	printf( '<p><a href="%1$s" class="more-link themebutton2">' . __( 'Read More', 'lan-thinkupthemes') . '</a></p>',
		get_permalink($post->ID)
	);
}


//----------------------------------------------------------------------------------
//	INPUT BLOG META CONTENT
//----------------------------------------------------------------------------------

function thinkup_input_blogmeta() {

	echo '<div class="entry-meta">';
		if ( is_sticky() && is_home() && ! is_paged() ) { thinkup_input_sticky(); }

		thinkup_input_blogauthor();
		thinkup_input_blogdate();
		thinkup_input_blogcomment();
		thinkup_input_blogcategory();
		thinkup_input_blogtag();
	echo '</div>';
}


//----------------------------------------------------------------------------------
//	INPUT POST META CONTENT
//----------------------------------------------------------------------------------

function thinkup_input_postmeta() {

	echo '<header class="entry-header entry-meta">';
		thinkup_input_blogdate();
		thinkup_input_blogauthor();
		thinkup_input_blogcomment();
		thinkup_input_blogcategory();
		thinkup_input_blogtag();
	echo '</header><!-- .entry-header -->';
}


//----------------------------------------------------------------------------------
//	SHOW AUTHOR BIO
//----------------------------------------------------------------------------------

// HTML for Author Bio
function thinkup_input_postauthorbiocode() {

	echo	'<div id="author-bio">',
			'<div id="author-title">',
			'<h3>About the Author: <a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '"/>' . get_the_author() . '</a></h3>',
			'<span class="sep"><span class="sep-core"></span></span>',
			'</div>',
			'<div id="author-image" class="one_sixth">',
			get_avatar( get_the_author_meta( 'email' ), '90' ),
			'</div>',
			'<div id="author-text" class="five_sixth last">',
			wpautop( get_the_author_meta( 'description' ) ),
			'</div>',
			'</div>';
}

// Output Author Bio
function thinkup_input_postauthorbio() {
global $thinkup_post_authorbio;

	thinkup_input_postauthorbiocode();
}


//----------------------------------------------------------------------------------
//	SHOW SOCIAL SHARING - PREMIUM FEATURE
//----------------------------------------------------------------------------------


//----------------------------------------------------------------------------------
//	TEMPLATE FOR COMMENTS AND PINGBACKS (PREVIOUSLY IN TEMPLATE-TAGS).
//----------------------------------------------------------------------------------

function thinkup_input_commenttemplate( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'lan-thinkupthemes'); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'lan-thinkupthemes' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
					<?php echo get_avatar( $comment, 60 ); ?>
			<footer>

				<span class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</span>

				<span class="comment-author">
					<?php printf( '%s', sprintf( '%s', get_comment_author_link() ) ); ?>
				</span>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'lan-thinkupthemes'); ?></em>
					<br />
				<?php endif; ?>

				<span class="comment-meta">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php comment_time( 'c' ); ?>">
					<?php
						// translators: 1: date, 2: time
						printf( '%1$s', get_comment_date() ); ?>
					</time></a>
					<?php edit_comment_link( __( 'Edit', 'lan-thinkupthemes' ), ' ' );
					?>
				</span>

			<div class="comment-content"><?php comment_text(); ?></div>
			</footer>
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}

// Add themebutton class to reply link
function replace_reply_link_class($class){
    $class = str_replace("class='comment-reply-link", "class='comment-reply-link themebutton3", $class);
    return $class;
}
add_filter('comment_reply_link', 'replace_reply_link_class');

// List comments in single page
function thinkup_input_comments() {
	$args = array( 
		'callback' => 'thinkup_input_commenttemplate', 
	);
	wp_list_comments( $args );
}


?>