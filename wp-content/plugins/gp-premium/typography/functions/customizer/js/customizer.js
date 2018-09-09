function gp_premium_typography_live_update( id, selector, property, unit, media, settings ) {
	settings = typeof settings !== 'undefined' ? settings : 'generate_settings';
	wp.customize( settings + '[' + id + ']', function( value ) {
		value.bind( function( newval ) {
			// Get our unit if applicable
			unit = typeof unit !== 'undefined' ? unit : '';
			
			// Check if media query
			media_query = typeof media !== 'undefined' ? 'media="' + media + '"' : '';
	
			if ( jQuery( 'style#' + id ).length ) {
				jQuery( 'style#' + id ).html( selector + '{' + property + ':' + newval + unit + ';}' );
			} else {
				jQuery( 'head' ).append( '<style id="' + id + '" ' + media_query + '>' + selector + '{' + property + ':' + newval + unit + ';}</style>' );
				setTimeout(function() {
					jQuery( 'style#' + id ).not( ':last' ).remove();
				}, 1000);
			}
			setTimeout("jQuery('body').trigger('generate_spacing_updated');", 1000);
		} );
	} );
}

/** 
 * Body font size, weight and transform
 */
gp_premium_typography_live_update( 'body_font_size', 'body, button, input, select, textarea', 'font-size', 'px' );
gp_premium_typography_live_update( 'body_line_height', 'body', 'line-height', '' );
gp_premium_typography_live_update( 'paragraph_margin', 'p', 'margin-bottom', 'em' );
gp_premium_typography_live_update( 'body_font_weight', 'body, button, input, select, textarea', 'font-weight' );
gp_premium_typography_live_update( 'body_font_transform', 'body, button, input, select, textarea', 'text-transform' );

/** 
 * Top bar font size, weight and transform
 */
gp_premium_typography_live_update( 'top_bar_font_size', '.top-bar', 'font-size', 'px' );
gp_premium_typography_live_update( 'top_bar_font_weight', '.top-bar', 'font-weight' );
gp_premium_typography_live_update( 'top_bar_font_transform', '.top-bar', 'text-transform' );

/** 
 * Site title font size, weight and transform
 */
gp_premium_typography_live_update( 'site_title_font_size', '.main-title', 'font-size', 'px', gp_typography.not_mobile );
gp_premium_typography_live_update( 'site_title_font_weight', '.main-title', 'font-weight' );
gp_premium_typography_live_update( 'site_title_font_transform', '.main-title', 'text-transform' );

/** 
 * Site description font size, weight and transform
 */
gp_premium_typography_live_update( 'site_tagline_font_size', '.site-description', 'font-size', 'px' );
gp_premium_typography_live_update( 'site_tagline_font_weight', '.site-description', 'font-weight' );
gp_premium_typography_live_update( 'site_tagline_font_transform', '.site-description', 'text-transform' );

/** 
 * Main navigation font size, weight and transform
 */
gp_premium_typography_live_update( 'navigation_font_size', '.main-navigation a, .menu-toggle', 'font-size', 'px' );
gp_premium_typography_live_update( 'navigation_font_weight', '.main-navigation a, .menu-toggle', 'font-weight' );
gp_premium_typography_live_update( 'navigation_font_transform', '.main-navigation a, .menu-toggle', 'text-transform' );

/** 
 * Secondary navigation font size, weight and transform
 */
gp_premium_typography_live_update( 'secondary_navigation_font_size', '.secondary-navigation .main-nav ul li a,.secondary-navigation .menu-toggle, .secondary-navigation .top-bar', 'font-size', 'px', '', 'generate_secondary_nav_settings' );
gp_premium_typography_live_update( 'secondary_navigation_font_weight', '.secondary-navigation .main-nav ul li a,.secondary-navigation .menu-toggle, .secondary-navigation .top-bar', 'font-weight', '', '', 'generate_secondary_nav_settings' );
gp_premium_typography_live_update( 'secondary_navigation_font_transform', '.secondary-navigation .main-nav ul li a,.secondary-navigation .menu-toggle, .secondary-navigation .top-bar', 'text-transform', '', '', 'generate_secondary_nav_settings' );

/** 
 * H1 font size, weight and transform
 */
gp_premium_typography_live_update( 'heading_1_font_size', 'h1', 'font-size', 'px', gp_typography.not_mobile );
gp_premium_typography_live_update( 'heading_1_weight', 'h1', 'font-weight' );
gp_premium_typography_live_update( 'heading_1_transform', 'h1', 'text-transform' );

/** 
 * H2 font size, weight and transform
 */
gp_premium_typography_live_update( 'heading_2_font_size', 'h2', 'font-size', 'px', gp_typography.not_mobile );
gp_premium_typography_live_update( 'heading_2_weight', 'h2', 'font-weight' );
gp_premium_typography_live_update( 'heading_2_transform', 'h2', 'text-transform' );

/** 
 * H3 font size, weight and transform
 */
gp_premium_typography_live_update( 'heading_3_font_size', 'h3', 'font-size', 'px' );
gp_premium_typography_live_update( 'heading_3_weight', 'h3', 'font-weight' );
gp_premium_typography_live_update( 'heading_3_transform', 'h3', 'text-transform' );

/** 
 * Widget title font size, weight and transform
 */
gp_premium_typography_live_update( 'widget_title_font_size', '.widget-title', 'font-size', 'px' );
gp_premium_typography_live_update( 'widget_title_font_weight', '.widget-title', 'font-weight' );
gp_premium_typography_live_update( 'widget_title_font_transform', '.widget-title', 'text-transform' );
gp_premium_typography_live_update( 'widget_content_font_size', '.sidebar .widget, .footer-widgets .widget', 'font-size', 'px' );

/** 
 * Footer font size
 */
gp_premium_typography_live_update( 'footer_font_size', '.site-info', 'font-size', 'px' );

/** 
 * Mobile font sizes
 */
gp_premium_typography_live_update( 'mobile_site_title_font_size', '.main-title', 'font-size', 'px', gp_typography.mobile );
gp_premium_typography_live_update( 'mobile_heading_1_font_size', 'h1', 'font-size', 'px', gp_typography.mobile );
gp_premium_typography_live_update( 'mobile_heading_2_font_size', 'h2', 'font-size', 'px', gp_typography.mobile );