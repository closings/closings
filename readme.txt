== Closings.com ==

- By IT Next Consultant, http://itnextconsultant.com/

Requires at least:	3.4.1
Tested up to:		4.1.0

Closings.com is a multi-purpose professional theme ideal for a business or blog website. The theme is responsive, HD retina ready and comes with 600+ Google Fonts which can easily be selected directly from the theme options panel.


-----------------------------------------------------------------------------
	Support
-----------------------------------------------------------------------------

- For setup and use instructions please refer to file "Closings.com - Documentation.pdf" in licensing folder.


-----------------------------------------------------------------------------
	Frequently Asked Questions
-----------------------------------------------------------------------------

- None Yet


-----------------------------------------------------------------------------
	Limitations
-----------------------------------------------------------------------------

- RTL support is yet to be added. This is planned for inclusion in v1.4.
- Multi-language support is yet to be added. This is planned for inclusion in v1.4.


-----------------------------------------------------------------------------
	Copyright, Sources, Credits & Licenses
-----------------------------------------------------------------------------

Closings.com WordPress Theme, Copyright 2014 IT Next Consultant LLC.
Closings.com is distributed under the terms of the GNU GPL

Demo images are licensed under CC0 1.0 Universal (CC0 1.0) and available from http://pixabay.com/
Image used in screenshot licensed under CC0 1.0 Universal (CC0 1.0) and available from http://pixabay.com/en/new-york-city-brooklyn-bridge-night-336475/

The following opensource projects, graphics, fonts, API's or other files as listed have been used in developing this theme. Thanks to the author for the creative work they made. All creative works are licensed as being GPL or GPL compatible.

    [1.01] Item:        Underscores (_s) starter theme - Copyright: Automattic, automattic.com
           Item URL:    http://underscores.me/
           Licence:     Licensed under GPLv2 or later
           Licence URL: http://www.gnu.org/licenses/gpl.html

    [1.02] Item:        Redux Framework
           Item URL:    https://github.com/ReduxFramework/ReduxFramework
           Licence:     GPLv3
           Licence URL: http://www.gnu.org/licenses/gpl.html

    [1.03] Item:        TGM Plugin Activation
           Item URL:    http://tgmpluginactivation.com/#license
           Licence:     GPLv3
           Licence URL: http://www.gnu.org/licenses/gpl.html

    [1.04] Item:        html5shiv (jQuery file)
           Item URL:    http://code.google.com/p/html5shiv/
           Licence:     MIT
           Licence MIT: http://opensource.org/licenses/mit-license.html

    [1.05] Item:        Retina js
           Item URL:    http://retinajs.com
           Licence:     MIT
           Licence URL: http://opensource.org/licenses/mit-license.html

    [1.06] Item:        ResponsiveSlides
           Item URL:    https://github.com/viljamis/ResponsiveSlides.js
           Licence:     MIT
           Licence URL: http://opensource.org/licenses/mit-license.html

    [1.07] Item:        Font Awesome
           Item URL:    http://fortawesome.github.io/Font-Awesome/#license
           Licence:     SIL Open Font &  MIT
           Licence OFL: http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&id=OFL
           Licence MIT: http://opensource.org/licenses/mit-license.html

    [1.08] Item:        Twitter Bootstrap
           Item URL:    https://github.com/twitter/bootstrap/wiki/License
           Licence:     Apache 2.0
           Licence URL: http://www.apache.org/licenses/LICENSE-2.0

    [1.09] Item:        Elegant Icons
           Item URL:    http://www.elegantthemes.com/blog/resources/elegant-themes-icon-pack-for-free
           Licence:     Dual GPL and MIT
           Licence URL: /licenses/license_(elegant_icons).txt

    [1.10] Item:        Elegant Media Icons
           Item URL:    https://www.iconfinder.com/search/?q=iconset:elegantmediaicons
           Licence:     GPL
           Licence URL: http://www.gnu.org/licenses/gpl.html

    [1.11] Item:        Engrave Lite
           Item URL:    http://www.thinkupthemes.com/free/engrave-lite/
           Licence:     GPL
           Licence URL: http://www.gnu.org/licenses/gpl.html


-----------------------------------------------------------------------------
	Changelog
-----------------------------------------------------------------------------

Version 1.5.6
- Removed: Recommended plugins removed due to plugin errors with WordPress4.0 update.

Version 1.5.5
- Fixed:   get_page_link changed to get_permalink to ensure links work correctly for call to action.
- Fixed:   get_page_link changed to get_permalink to ensure links work correctly for homepage featured content.
- Updated: Font Awesome v4.2.0 added.

Version 1.5.4
- New:     Font Awesome v4.1.0 added.
- Fixed:   Css added to correct image format issue in theme options panel.
- Updated: Slider image repaced with new image.
- Updated: Retina js script only output when HD logo set. Prevents image 404 errors on hd screens.
- Updated: http removed from credit links to ensure they work correctly on both http:// and https:// sites.
- Updated: current-theme class removed from promotion section in theme options panel to correct image sizing issue.
- Updated: get_stylesheet_directory_uri() changed to get_template_directory_uri() for theme info tab in theme options panel.
- Updated: Responsive layout class changed from fixed to layout-fixed. Allows more developer control with layout-responsive class.
- Removed: Delay autop code removed.
- Removed: Unneccesary commented text remoed from framework.php.
- Removed: Correct z-index of iframe code removed. No longer required since Wordpress v3.9 release.

Version 1.5.3
- New:     Custom background functionality added.
- New:     Custom header image functionality added.
- New:     thinkup_hook_header() moved to immediately after <head> html tag in header.php.
- Fixed:   Responsive jQuery fixed for iframes. Including Youtube videos etc...
- Updated: Image sizes updated to screen width of 1140px
- Updated: thinkup_hook_header() moved to immediately after <head> html tag.

Version 1.5.2
- Fixed:   Icons now display on tabs in theme options panelOffer updated to 10% off with value $31.
- Updated: Changes to "Enable Responsive Layout" description on theme options panel.

Version 1.5.1
- Updated: Offer updated to 10% off with value $31.

Version 1.5.0
- Fixed:   Responsive header menu now works on localhost correctly.
- Updated: Auto sizing of logo image added.
- Updated: Styling added for default WordPress widgets.
- Removed: All references to blog layout 2.
- Removed: All references to template family.

Version 1.4.91
- Fixed:   Slider checks adjusted - php error message fixed.

Version 1.4.9
- Updated: Core Masonry code now being used. Removed external file.
- Updated: is_thinkup() code replaced. Where required replaced with is_front_page().

Version 1.4.8
- New:     Responsive-layout and red theme tags added.
- Fixed:   Slider shows on default settings.
- Fixed:   Favicon is opt in and disabled by default.
- Fixed:   Intro width corrected to display properly on Safari.
- Fixed:   Pre-header menu Fixed to display properly on Safari.
- Fixed:   slider height corrected to display properly on Safari.
- Removed: Typography option removed.
- Removed: Footer credit cannot be removed.

Version 1.4.7
- Fixed:   Page links for homepage content boxes.

Version 1.4.6
- New:     Masonry JS script added.
- Fixed:   Main header menu stays at bottom even when a large logo is added.
- Fixed:   Responsive navigation menu displays when custom menu is not set.
- Updated: Screenshot - Shows 3 boxes on homepage.
- Updated: Blog layout changed to 2 column with masonry.
- Updated: ThinkUpSlider ratio when loaded on mobile devices.
- Updated: query_posts replaced with WP_Query in template-sitemap.php.

Version 1.4.5
- paginate_link() renamed to thinkup_input_nav().
- Attachment pagination styled to match post / page pagination.

Version 1.4.4
- Translation scripts updated

Version 1.4.3
- Built in slider added.
- SlideDeck2 Lite recommended install removed.

Version 1.4.2
- Logo css changed to prevent overlap with main header menu.
- Copyright added.

Version 1.4.1
- Default header styles added to match menus.
- Site title displayed upon activation.
- Footer widgets disabled upon activation.
- 'Walker_Nav_Menu_Responsive extends Walker_Nav_Menu' updated. 

Version 1.4.0
- Translation ready functionality added.
- Removed blog template (style2).
- Default showing of 'Think Up Themes Ltd' logo removed.

Version 1.3.3
- html5shiv added - licensed under MIT.

Version 1.3.2
- html5shiv removed.
- Redux framework license changed from GPLv2 to GPLv3. (Author allows the distributor flexibility on choice of GPL license version).

Version 1.3.1
- Theme URL changed.

Version 1.3
- Unlimited Sidebars removed.
- Twitter widget removed (php & css).
- PrettyPhoto removed (php & js).
- Social media icons replaced.

Version 1.2
- Page / Post pagination added.
- Util removed.

Version 1.1
- Removed SMOF framework.
- Added Redux framework.

Version 1.0
- Initial release.