<?php
/**
 * Homepage functions.
 *
 * @package ThinkUpThemes
 */

//----------------------------------------------------------------------------------
//	ENABLE HOMEPAGE SLIDER
//----------------------------------------------------------------------------------

// Add Slider - Homepage
function thinkup_input_sliderhome() {
global $thinkup_homepage_sliderswitch;
global $thinkup_homepage_slidername;
global $thinkup_homepage_sliderpreset;
global $thinkup_homepage_sliderpresetwidth;

$thinkup_class_fullwidth = NULL;

	if ( is_front_page() ) {
		if ( empty( $thinkup_homepage_sliderswitch ) or $thinkup_homepage_sliderswitch == 'option1' ) {

			if ( empty( $thinkup_homepage_sliderpresetwidth ) or $thinkup_homepage_sliderpresetwidth == '1' ) {
				$thinkup_class_fullwidth = ' full-width';
			}
			echo '<div id="slider"><div id="slider-core">',
			     '<div class="rslides-container' . $thinkup_class_fullwidth . '"><div class="rslides-inner"><ul class="slides">';
				if ( ! isset( $thinkup_homepage_sliderpreset[0] ) or empty( $thinkup_homepage_sliderpreset[0]['slide_image_url'] ) ) {				 
					echo '<li><img src="' . get_template_directory_uri() . '/images/transparent.png" style="background: url(' . get_template_directory_uri() . '/images/slideshow/slide_demo1.png) no-repeat center; background-size: cover;" alt="Demo Image" /></li>';
					echo '<li><img src="' . get_template_directory_uri() . '/images/transparent.png" style="background: url(' . get_template_directory_uri() . '/images/slideshow/slide_demo2.png) no-repeat center; background-size: cover;" alt="Demo Image" /></li>';
					echo '<li><img src="' . get_template_directory_uri() . '/images/transparent.png" style="background: url(' . get_template_directory_uri() . '/images/slideshow/slide_demo3.png) no-repeat center; background-size: cover;" alt="Demo Image" /></li>';
				} else if (isset($thinkup_homepage_sliderpreset) && is_array($thinkup_homepage_sliderpreset)) {
					foreach ($thinkup_homepage_sliderpreset as $slide) {
						echo '<li>',
							 '<img src="' . get_template_directory_uri() . '/images/transparent.png" style="background: url(' . $slide['slide_image_url'] . ') no-repeat center; background-size: cover;" alt="' . $slide['slide_title']. '" />',
							 '<div class="rslides-content">',
 							 '<div class="wrap-safari">',
							 '<div class="rslides-content-inner">',
							 '<div class="featured">';
							 
								if ( ! empty( $slide['slide_title'] ) ) {
									echo '<div class="featured-title">',
										 '<span>' . $slide['slide_title'] . '</span>',
										 '</div>';
								}
								if ( ! empty( $slide['slide_description'] ) ) {
									$slide_description = str_replace( '<p>', '<p><span>', wpautop( $slide['slide_description'] ));
									$slide_description = str_replace( '</p>', '</span></p>', $slide_description );
									echo '<div class="featured-excerpt">',
										 $slide_description,
										 '</div>';
								}
								if ( ! empty( $slide['slide_url'] ) ) {
									echo '<div class="featured-link">',
										 '<a href="' . $slide['slide_url'] . '">Read More</a>',
										 '</div>';
								}

						 echo '</div>',
							  '</div>',
							  '</div>',
							  '</div>',
							  '</li>';
					}
				}
			echo '</ul></div></div>',
			     '</div></div>';
		} else if ( $thinkup_homepage_sliderswitch !== 'option2' or empty( $thinkup_homepage_slidername ) ) {
			echo '';
		} else {
			echo	'<div id="slider"><div id="slider-core">',
				do_shortcode( $thinkup_homepage_slidername ),
				'</div></div>';
		}
	}
}

// Add ThinkUpSlider Height - Homepage
function thinkup_input_sliderhomeheight() {
global $thinkup_homepage_sliderswitch;
global $thinkup_homepage_sliderpresetwidth;
global $thinkup_homepage_sliderpresetheight;

	if ( empty( $thinkup_homepage_sliderpresetheight ) ) $thinkup_homepage_sliderpresetheight = '350';

	if ( is_front_page() ) {
		if ( empty( $thinkup_homepage_sliderswitch ) or $thinkup_homepage_sliderswitch == 'option1' ) {
		echo 	"\n" .'<style type="text/css">' . "\n",
			'#slider .rslides, #slider .rslides li { height: ' . $thinkup_homepage_sliderpresetheight . 'px; max-height: ' . $thinkup_homepage_sliderpresetheight . 'px; }' . "\n",
			'#slider .rslides img { height: 100%; max-height: ' . $thinkup_homepage_sliderpresetheight . 'px; }' . "\n",
			'</style>' . "\n";
		}
	}
}
add_action( 'wp_head','thinkup_input_sliderhomeheight', '13' );


//----------------------------------------------------------------------------------
//	ENABLE HOMEPAGE CONTENT
//----------------------------------------------------------------------------------

function thinkup_input_homepagesection() {
global $thinkup_homepage_sectionswitch;
global $thinkup_homepage_section1_icon;
global $thinkup_homepage_section1_title;
global $thinkup_homepage_section1_desc;
global $thinkup_homepage_section1_link;
global $thinkup_homepage_section2_icon;
global $thinkup_homepage_section2_title;
global $thinkup_homepage_section2_desc;
global $thinkup_homepage_section2_link;
global $thinkup_homepage_section3_icon;
global $thinkup_homepage_section3_title;
global $thinkup_homepage_section3_desc;
global $thinkup_homepage_section3_link;

	// Set default values for icons
	if ( empty( $thinkup_homepage_section1_icon ) ) $thinkup_homepage_section1_icon = 'icon-ok';
	if ( empty( $thinkup_homepage_section2_icon ) ) $thinkup_homepage_section2_icon = 'icon-gift';
	if ( empty( $thinkup_homepage_section3_icon ) ) $thinkup_homepage_section3_icon = 'icon-star-empty';

	// Set default values for titles
	if ( empty( $thinkup_homepage_section1_title ) ) $thinkup_homepage_section1_title = 'Section 1';
	if ( empty( $thinkup_homepage_section2_title ) ) $thinkup_homepage_section2_title = 'Section 2';
	if ( empty( $thinkup_homepage_section3_title ) ) $thinkup_homepage_section3_title = 'Section 3';

	// Set default values for descriptions
	if ( empty( $thinkup_homepage_section1_desc ) ) 
	$thinkup_homepage_section1_desc = 'Easily change the content of this box using the Homepage section of the built-in theme options panel.';

	if ( empty( $thinkup_homepage_section2_desc ) ) 
	$thinkup_homepage_section2_desc = 'You can even change the icon at the top of this box. There&#39;s hundreds to choose from. Simply pick one.';

	if ( empty( $thinkup_homepage_section3_desc ) ) 
	$thinkup_homepage_section3_desc = 'Link this entire box to any page on your site. There&#39;s even a smooth color change when a user hovers this box.';

	// Get page names for links
	if ( !empty( $thinkup_homepage_section1_link ) ) $thinkup_homepage_section1_link = get_permalink( $thinkup_homepage_section1_link );
	if ( !empty( $thinkup_homepage_section2_link ) ) $thinkup_homepage_section2_link = get_permalink( $thinkup_homepage_section2_link );
	if ( !empty( $thinkup_homepage_section3_link ) ) $thinkup_homepage_section3_link = get_permalink( $thinkup_homepage_section3_link );


	if ( is_front_page() ) {
		if ( empty( $thinkup_homepage_sectionswitch ) or $thinkup_homepage_sectionswitch == '1' ) {

		echo '<div id="section-home"><div id="section-home-inner">';

			echo '<div class="section1 one_third">',
					'<a href="' . $thinkup_homepage_section1_link . '">',
					'<div class="entry-header">',
					'<span><i class="' . $thinkup_homepage_section1_icon . '"></i></span>',
					'</div>',
					'<div class="entry-content">',
					'<h3>' . $thinkup_homepage_section1_title . '</h3>' . wpautop( $thinkup_homepage_section1_desc ),
					'</div>',
					'</a>',
				'</div>';

			echo '<div class="section2 one_third">',
					'<a href="' . $thinkup_homepage_section2_link . '">',
					'<div class="entry-header">',
					'<span><i class="' . $thinkup_homepage_section2_icon . '"></i></span>',
					'</div>',
					'<div class="entry-content">',
					'<h3>' . $thinkup_homepage_section2_title . '</h3>' . wpautop( $thinkup_homepage_section2_desc ),
					'</div>',
					'</a>',
				'</div>';

			echo '<div class="section3 one_third last">',
					'<a href="' . $thinkup_homepage_section3_link . '">',
					'<div class="entry-header">',
					'<span><i class="' . $thinkup_homepage_section3_icon . '"></i></span>',
					'</div>',
					'<div class="entry-content">',
					'<h3>' . $thinkup_homepage_section3_title . '</h3>' . wpautop( $thinkup_homepage_section3_desc ),
					'</div>',
					'</a>',
				'</div>';

		echo '<div class="clearboth"></div></div></div>';

		}
	}
}


//----------------------------------------------------------------------------------
//	CALL TO ACTION - INTRO
//----------------------------------------------------------------------------------

function thinkup_input_ctaintro() {
global $thinkup_homepage_introswitch;
global $thinkup_homepage_introaction;
global $thinkup_homepage_introactionteaser;
global $thinkup_homepage_introactionbutton;
global $thinkup_homepage_introactionlink;
global $thinkup_homepage_introactionpage;
global $thinkup_homepage_introactioncustom;

	if ( $thinkup_homepage_introswitch == '1' and is_front_page() and ! empty( $thinkup_homepage_introaction ) ) {
		echo '<div id="introaction"><div id="introaction-core">';
		if (empty( $thinkup_homepage_introactionbutton ) ) {
			if ( empty( $thinkup_homepage_introactionteaser ) ) {
				echo	'<div class="action-text">
						<h3>' . $thinkup_homepage_introaction . '</h3>
						</div>';
				} else {
				echo	'<div class="action-text action-teaser">
						<h3>' . $thinkup_homepage_introaction . '</h3>
						<p>' . $thinkup_homepage_introactionteaser . '</p>
						</div>';
				}
		} else if ( ! empty( $thinkup_homepage_introactionbutton ) ) {
			if ( empty( $thinkup_homepage_introactionteaser ) ) {
				echo	'<div class="action-text three_fourth">
						<h3>' . $thinkup_homepage_introaction . '</h3>
						</div>';
				} else {
				echo	'<div class="action-text three_fourth action-teaser">
						<h3>' . $thinkup_homepage_introaction . '</h3>
						<p>' . $thinkup_homepage_introactionteaser . '</p>
						</div>';
				}
			if ( $thinkup_homepage_introactionlink == 'option1' ) {
				echo '<div class="action-button one_fourth last"><a href="' . get_permalink( $thinkup_homepage_introactionpage ) . '"><h4 class="themebutton">';
				echo $thinkup_homepage_introactionbutton;
				echo '</h4></a></div>';
			} else if ( $thinkup_homepage_introactionlink == 'option2' ) {
				echo '<div class="action-button one_fourth last"><a href="' . $thinkup_homepage_introactioncustom . '"><h4 class="themebutton">';
				echo $thinkup_homepage_introactionbutton;
				echo '</h4></a></div>';
			} else if ( $thinkup_homepage_introactionlink == 'option3' or empty( $thinkup_homepage_introactionlink ) ) {
				echo '<div class="action-button one_fourth last"><h4 class="themebutton">';
				echo $thinkup_homepage_introactionbutton;
				echo '</h4></div>';
			}
		}
		echo '</div></div>';
	}
}


?>