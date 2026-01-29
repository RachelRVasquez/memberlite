<?php
/**
 * Core color arrays for each scheme
 */

//Default color palette (inspired by legacy default 4.6)
function memberlite_get_colors(): array {
	return array(
		'contrast'      => '#222222',
		'base'          => '#FFFFFF',
		'masthead_bg'   => '#FFFFFF',
		'masthead_text' => '#011935',
		'primary'       => '#011935',
		'secondary'     => '#011935',
		'border'        => '#3C4B5A',
	);
}

//New Author Color Palette
function memberlite_get_news_colors(): array {
	return array(
		'contrast'      => '#222222',
		'base'          => '#FFFFFF',
		'masthead_bg'   => '#e8b500',
		'masthead_text' => '#FFFFFF',
		'primary'       => '#e8b500',
		'secondary'     => '#868787',
		'border'        => '#e6e6e6',
	);
}

//WP Tavern Color Palette
function memberlite_get_wptavern_colors(): array {
	return array(
		'contrast'      => '#000000',
		'base'          => '#FFFFFF',
		'masthead_bg'   => '#d33939',
		'masthead_text' => '#FFFFFF',
		'primary'       => '#d33939',
		'secondary'     => '#32373c',
		'border'        => '#cecece',
	);
}

/**
 * Legacy color array (16 colors - default 4.6) - for backward compatibility
 */
function memberlite_get_legacy_colors(): array {
	return array(
		'bgcolor_header' => '#011935',
		'background'     => '#FFFFFF',
		'masthead_bg'    => '#FFFFFF',
		'nav_bg'         => '#F9FAFB',
		'nav_text'       => '#444444',
		'body_text'      => '#222222',
		'primary'        => '#011935',
		'primary_hover'  => '#011935',
		'secondary'      => '#011935',
		'action'         => '#00A59D',
		'button'         => '#E87102',
		'border'         => '#3C4B5A',
		'masthead_text'  => '#011935',
		'footer_bg'      => '#FFFFFF',
		'footer_text'    => '#F9FAFB',
		'delimiter'      => '#444444',
	);
}

/**
 * Map new 7-color scheme to full Customizer settings
 * This is the key function that expands the simplified color scheme
 */
function memberlite_map_colors_to_settings( array $colors ): array {
	return array(
		// New simplified colors (7 core)
		'color_text'              => $colors['contrast'],
		'background_color'        => $colors['base'],
		'bgcolor_header'          => $colors['bgcolor_header'],
		'color_primary'           => $colors['primary'],
		'color_secondary'         => $colors['secondary'],
		'color_borders'           => $colors['border'],
		'color_heading'           => $colors['contrast'],
		'color_link'              => $colors['primary'],
		'color_meta_link'         => $colors['primary'],
		'color_button'            => $colors['primary'],
		'color_action'            => $colors['primary'],
		'bgcolor_page_masthead'   => $colors['masthead_bg'],
		'color_page_masthead'     => $colors['masthead_text'],
		'bgcolor_site_navigation' => $colors['base'],
		'color_site_navigation'   => $colors['contrast'],
		'bgcolor_footer_widgets'  => $colors['base'],
		'color_footer_widgets'    => $colors['contrast'],
		'delimiter'               => $colors['base'],
		'color_white'             => '#FFFFFF',
	);
}

/**
 * Map legacy 16-color scheme to full Customizer settings
 *
 * @param array $colors
 * @return array
 */
function memberlite_map_legacy_colors_to_settings( array $colors ): array {
	return array(
		'color_heading'           => $colors[5],  // use body_text for headings
		'background_color'        => $colors[1],  // site background
		'bgcolor_header'          => $colors[2],  // header background
		'bgcolor_site_navigation' => $colors[3],  // nav_bg
		'color_site_navigation'   => $colors[4],  // nav_text
		'color_text'              => $colors[5],  // body_text
		'color_link'              => $colors[6],  // primary
		'color_meta_link'         => $colors[6],  // primary (same as link)
		'color_primary'           => $colors[6],  // primary
		'color_secondary'         => $colors[8],  // secondary
		'color_action'            => $colors[9],  // action
		'color_button'            => $colors[10], // button
		'color_borders'           => $colors[11], // border
		'bgcolor_page_masthead'   => $colors[0],  // masthead background (same as site background)
		'color_page_masthead'     => $colors[1],  // masthead text
		'bgcolor_footer_widgets'  => $colors[13], // footer_bg
		'color_footer_widgets'    => $colors[14], // footer_text
		'delimiter'               => $colors[15], // delimiter
		'color_white'             => '#FFFFFF',
	);
}

/**
 * Get default theme settings (6.6.1+ with new 7-color scheme)
 *
 * @return array
 */
function memberlite_get_defaults(): array {
	$colors         = memberlite_get_colors();
	$color_settings = memberlite_map_colors_to_settings( $colors );

	$defaults = array_merge(
		array(
			'memberlite_webfonts'               => 'Lato_Lato',
			'memberlite_header_font'            => 'Lato',
			'memberlite_body_font'              => 'Lato',
			'columns_ratio'                     => '8-4',
			'columns_ratio_header'              => '4-8',
			'sidebar_location'                  => 'sidebar-right',
			'sidebar_location_blog'             => 'sidebar-blog-right',
			'content_archives'                  => 'content',
			'memberlite_loop_images'            => 'show_none',
			'posts_entry_meta_before'           => __( 'Posted on {post_date} by {post_author_posts_link}', 'memberlite' ),
			'posts_entry_meta_after'            => __( 'This entry was posted in {post_categories} and tagged {post_tags}. Bookmark the {post_permalink}.', 'memberlite' ),
			'author_block'                      => false,
			'memberlite_footerwidgets'          => '4',
			'copyright_textbox'                 => '&copy; !!current_year!! !!site_title!!',
			'memberlite_back_to_top'            => true,
			'memberlite_variation_color_scheme' => 'default_2026',
			'memberlite_darkcss'                => false,
			'hover_brightness'                  => '1.1',
		),
		$color_settings
	);

	return apply_filters( 'memberlite_variation_defaults', $defaults );
}

/**
 * Get News Author theme variation settings (6.6.1+ with new 7-color scheme)
 *
 * @return array
 */
function memberlite_get_defaults_news(): array {
	$colors         = memberlite_get_news_colors();
	$color_settings = memberlite_map_colors_to_settings( $colors );

	$defaults = array_merge(
		array(
			'memberlite_webfonts'      => 'Roboto',
			'memberlite_header_font'   => 'Roboto',
			'memberlite_body_font'     => 'Roboto',
			'columns_ratio'            => '8-4',
			'columns_ratio_header'     => '4-8',
			'sidebar_location'         => 'sidebar-right',
			'sidebar_location_blog'    => 'sidebar-none',
			'content_archives'         => 'excerpt',
			'memberlite_loop_images'   => 'show_none',
			'posts_entry_meta_before'  => __( '{post_author_posts_link} &#13; {post_date}', 'memberlite' ),
			'posts_entry_meta_after'   => __( 'This entry was posted in {post_categories} and tagged {post_tags}. Bookmark the {post_permalink}.', 'memberlite' ),
			'author_block'             => false,
			'memberlite_footerwidgets' => '1',
			'copyright_textbox'        => '&copy; !!current_year!! !!site_title!!',
			'memberlite_back_to_top'   => true,
			'memberlite_color_scheme'  => 'news',
			'memberlite_darkcss'       => false,
			'hover_brightness'         => '1.1',
		),
		$color_settings
	);

	return apply_filters( 'memberlite_defaults_news', $defaults );
}

/**
 * Get WP Tavern theme variation settings (6.6.1+ with new 7-color scheme)
 *
 * @return array
 */
function memberlite_get_defaults_wptavern(): array {
	$colors         = memberlite_get_wptavern_colors();
	$color_settings = memberlite_map_colors_to_settings( $colors );

	$defaults = array_merge(
		array(
			'memberlite_webfonts'      => 'Times New Roman',
			'memberlite_header_font'   => 'Times New Roman',
			'memberlite_body_font'     => 'Lato',
			'columns_ratio'            => '8-4',
			'columns_ratio_header'     => '4-8',
			'sidebar_location'         => 'sidebar-right',
			'sidebar_location_blog'    => 'sidebar-none',
			'content_archives'         => 'excerpt',
			'memberlite_loop_images'   => 'show_none',
			'posts_entry_meta_before'  => __( '{post_date} by {post_author_posts_link}', 'memberlite' ),
			'posts_entry_meta_after'   => __( '{post_tags}', 'memberlite' ),
			'author_block'             => false,
			'memberlite_footerwidgets' => '1',
			'copyright_textbox'        => '&copy; All Rights Reserved. Powered by WordPress, hosted by Pressable.',
			'memberlite_back_to_top'   => true,
			'memberlite_color_scheme'  => 'wptavern',
			'memberlite_darkcss'       => false,
			'hover_brightness'         => '1.1',
		),
		$color_settings
	);

	return apply_filters( 'memberlite_defaults_wptavern', $defaults );
}

/**
 * Get legacy default settings (pre-6.6.1 with 16-color scheme)
 * Used when 'default_v4.6' legacy scheme is selected
 */
function memberlite_get_defaults_legacy(): array {
	$colors         = memberlite_get_legacy_colors();
	$color_settings = memberlite_map_legacy_colors_to_settings( $colors );

	$defaults = array_merge(
		array(
			'memberlite_webfonts'      => 'Lato_Lato',
			'memberlite_header_font'   => 'Lato',
			'memberlite_body_font'     => 'Lato',
			'columns_ratio'            => '8-4',
			'columns_ratio_header'     => '4-8',
			'sidebar_location'         => 'sidebar-right',
			'sidebar_location_blog'    => 'sidebar-blog-right',
			'content_archives'         => 'content',
			'memberlite_loop_images'   => 'show_none',
			'posts_entry_meta_before'  => __( 'Posted on {post_date} by {post_author_posts_link}', 'memberlite' ),
			'posts_entry_meta_after'   => __( 'This entry was posted in {post_categories} and tagged {post_tags}. Bookmark the {post_permalink}.', 'memberlite' ),
			'author_block'             => false,
			'memberlite_footerwidgets' => '4',
			'copyright_textbox'        => '&copy; !!current_year!! !!site_title!!',
			'memberlite_back_to_top'   => true,
			'memberlite_color_scheme'  => 'default_v4.6',
			'memberlite_darkcss'       => false,
			'hover_brightness'         => '1.1',
		),
		$color_settings
	);

	return apply_filters( 'memberlite_defaults', $defaults );
}

/**
 * New color schemes (6.6.1+) - 7 colors each
 */
function memberlite_get_color_schemes(): array {
	$schemes = array(
		'default_2026' => array(
			'label'  => __( 'Default', 'memberlite' ),
			'colors' => memberlite_get_colors(),
		),
		'news'         => array(
			'label'  => __( 'News Author', 'memberlite' ),
			'colors' => memberlite_get_news_colors(),
		),
		'wptavern'     => array(
			'label'  => __( 'WP Tavern', 'memberlite' ),
			'colors' => memberlite_get_wptavern_colors(),
		),
	);

	// Loop through and format colors as array for theme.json
	// IMPORTANT: Use reference (&$scheme) to modify the actual array
	foreach ( $schemes as &$scheme ) {
		$scheme['colors'] = memberlite_format_scheme_colors( $scheme['colors'] );
	}

	return apply_filters( 'memberlite_variation_color_schemes', $schemes );
}

/**
 * Format color schemes for theme.json
 *
 * @param array $color_defs
 *
 * @return array
 */
function memberlite_format_scheme_colors( array $color_defs ): array {
	return array(
		$color_defs['contrast'],
		$color_defs['base'],
		$color_defs['masthead_bg'],
		$color_defs['masthead_text'],
		$color_defs['primary'],
		$color_defs['secondary'],
		$color_defs['border'],
	);
}

/**
 * Color schemes from Memberlite versions up to 6.6.1 w/ 16 colors each for backward compatibility
 *
 * @return array<string, array<string, mixed>>
 */
function memberlite_get_legacy_color_schemes(): array {
	$schemes = array(
		'default_v4.6'   => array(
			'label'  => __( 'Default V4.6 (Legacy)', 'memberlite' ),
			'colors' => array(
				'#011935', // 0. Heading
				'#FFFFFF', // 1. Background
				'#FFFFFF', // 2. Masthead BG
				'#F9FAFB', // 3. Nav BG
				'#444444', // 4. Nav Text
				'#222222', // 5. Body Text
				'#011935', // 6. Primary
				'#011935', // 7. Primary Hover
				'#011935', // 8. Secondary
				'#00A59D', // 9. Action
				'#E87102', // 10. Button
				'#3C4B5A', // 11. Border
				'#011935', // 12. Masthead Text
				'#FFFFFF', // 13. Footer BG
				'#F9FAFB', // 14. Footer Text
				'#444444', // 15. Delimiter
			),
		),
		'default'        => array(
			'label'  => __( 'Default (Legacy)', 'memberlite' ),
			'colors' => array(
				'#2C3E50', // 0. Heading
				'#FFFFFF', // 1. Background
				'#FFFFFF', // 2. Masthead BG
				'#FAFAFA', // 3. Nav BG
				'#777777', // 4. Nav Text
				'#222222', // 5. Body Text
				'#2C3E50', // 6. Primary
				'#2C3E50', // 7. Primary Hover
				'#2C3E50', // 8. Secondary
				'#18BC9C', // 9. Action
				'#F39C12', // 10. Button
				'#798D8F', // 11. Border
				'#2C3E50', // 12. Masthead Text
				'#FFFFFF', // 13. Footer BG
				'#2C3E50', // 14. Footer Text
				'#FFFFFF', // 15. Delimiter
			),
		),
		'education'      => array(
			'label'  => __( 'Education (Legacy)', 'memberlite' ),
			'colors' => array(
				'#3A9AD9', // 0. Heading
				'#F4EFEA', // 1. Background
				'#F4EFEA', // 2. Masthead BG
				'#E2DED9', // 3. Nav BG
				'#354458', // 4. Nav Text
				'#222222', // 5. Body Text
				'#3A9AD9', // 6. Primary
				'#3A9AD9', // 7. Primary Hover
				'#354458', // 8. Secondary
				'#EB7260', // 9. Action
				'#29ABA4', // 10. Button
				'#798D8F', // 11. Border
				'#354458', // 12. Masthead Text
				'#FFFFFF', // 13. Footer BG
				'#354458', // 14. Footer Text
				'#FFFFFF', // 15. Delimiter
			),
		),
		'modern_teal'    => array(
			'label'  => __( 'Modern Teal (Legacy)', 'memberlite' ),
			'colors' => array(
				'#424242', // 0. Heading
				'#EFEFEF', // 1. Background
				'#EFEFEF', // 2. Masthead BG
				'#424242', // 3. Nav BG
				'#EFEFEF', // 4. Nav Text
				'#222222', // 5. Body Text
				'#00CCD6', // 6. Primary
				'#00CCD6', // 7. Primary Hover
				'#00CCD6', // 8. Secondary
				'#424242', // 9. Action
				'#FFD900', // 10. Button
				'#798D8F', // 11. Border
				'#00CCD6', // 12. Masthead Text
				'#FFFFFF', // 13. Footer BG
				'#00CCD6', // 14. Footer Text
				'#FFFFFF', // 15. Delimiter
			),
		),
		'mono_blue'      => array(
			'label'  => __( 'Mono Blue (Legacy)', 'memberlite' ),
			'colors' => array(
				'#00AEEF', // 0. Heading
				'#FFFFFF', // 1. Background
				'#FFFFFF', // 2. Masthead BG
				'#00AEEF', // 3. Nav BG
				'#FFFFFF', // 4. Nav Text
				'#222222', // 5. Body Text
				'#00AEEF', // 6. Primary
				'#00AEEF', // 7. Primary Hover
				'#333333', // 8. Secondary
				'#555555', // 9. Action
				'#00AEEF', // 10. Button
				'#798D8F', // 11. Border
				'#333333', // 12. Masthead Text
				'#FFFFFF', // 13. Footer BG
				'#333333', // 14. Footer Text
				'#FFFFFF', // 15. Delimiter
			),
		),
		'mono_green'     => array(
			'label'  => __( 'Mono Green (Legacy)', 'memberlite' ),
			'colors' => array(
				'#00A651', // 0. Heading
				'#FFFFFF', // 1. Background
				'#FFFFFF', // 2. Masthead BG
				'#00A651', // 3. Nav BG
				'#FFFFFF', // 4. Nav Text
				'#222222', // 5. Body Text
				'#00A651', // 6. Primary
				'#00A651', // 7. Primary Hover
				'#333333', // 8. Secondary
				'#555555', // 9. Action
				'#00A651', // 10. Button
				'#798D8F', // 11. Border
				'#333333', // 12. Masthead Text
				'#FFFFFF', // 13. Footer BG
				'#333333', // 14. Footer Text
				'#FFFFFF', // 15. Delimiter
			),
		),
		'mono_orange'    => array(
			'label'  => __( 'Mono Orange (Legacy)', 'memberlite' ),
			'colors' => array(
				'#F39C12', // 0. Heading
				'#FFFFFF', // 1. Background
				'#FFFFFF', // 2. Masthead BG
				'#F39C12', // 3. Nav BG
				'#FFFFFF', // 4. Nav Text
				'#222222', // 5. Body Text
				'#F39C12', // 6. Primary
				'#F39C12', // 7. Primary Hover
				'#333333', // 8. Secondary
				'#555555', // 9. Action
				'#F39C12', // 10. Button
				'#798D8F', // 11. Border
				'#333333', // 12. Masthead Text
				'#FFFFFF', // 13. Footer BG
				'#333333', // 14. Footer Text
				'#FFFFFF', // 15. Delimiter
			),
		),
		'mono_pink'      => array(
			'label'  => __( 'Mono Pink (Legacy)', 'memberlite' ),
			'colors' => array(
				'#ED0977', // 0. Heading
				'#FFFFFF', // 1. Background
				'#FFFFFF', // 2. Masthead BG
				'#ED0977', // 3. Nav BG
				'#FFFFFF', // 4. Nav Text
				'#222222', // 5. Body Text
				'#ED0977', // 6. Primary
				'#ED0977', // 7. Primary Hover
				'#333333', // 8. Secondary
				'#555555', // 9. Action
				'#ED0977', // 10. Button
				'#798D8F', // 11. Border
				'#333333', // 12. Masthead Text
				'#FFFFFF', // 13. Footer BG
				'#333333', // 14. Footer Text
				'#FFFFFF', // 15. Delimiter
			),
		),
		'pop'            => array(
			'label'  => __( 'Pop! (Legacy)', 'memberlite' ),
			'colors' => array(
				'#53BBF4', // 0. Heading
				'#FFFFFF', // 1. Background
				'#FFFFFF', // 2. Masthead BG
				'#B1EB00', // 3. Nav BG
				'#666666', // 4. Nav Text
				'#222222', // 5. Body Text
				'#B1EB00', // 6. Primary
				'#B1EB00', // 7. Primary Hover
				'#53BBF4', // 8. Secondary
				'#FFAC00', // 9. Action
				'#FF85CB', // 10. Button
				'#798D8F', // 11. Border
				'#53BBF4', // 12. Masthead Text
				'#FFFFFF', // 13. Footer BG
				'#53BBF4', // 14. Footer Text
				'#FFFFFF', // 15. Delimiter
			),
		),
		'primary'        => array(
			'label'  => __( 'Not So Primary (Legacy)', 'memberlite' ),
			'colors' => array(
				'#1352A2', // 0. Heading
				'#F0F1EE', // 1. Background
				'#F0F1EE', // 2. Masthead BG
				'#FFFFFF', // 3. Nav BG
				'#555555', // 4. Nav Text
				'#222222', // 5. Body Text
				'#FB6964', // 6. Primary
				'#FB6964', // 7. Primary Hover
				'#1352A2', // 8. Secondary
				'#FB6964', // 9. Action
				'#FFD464', // 10. Button
				'#798D8F', // 11. Border
				'#1352A2', // 12. Masthead Text
				'#FFFFFF', // 13. Footer BG
				'#1352A2', // 14. Footer Text
				'#FFFFFF', // 15. Delimiter
			),
		),
		'raspberry_lime' => array(
			'label'  => __( 'Raspberry Lime (Legacy)', 'memberlite' ),
			'colors' => array(
				'#AA2159', // 0. Heading
				'#FFFFFF', // 1. Background
				'#FFFFFF', // 2. Masthead BG
				'#700035', // 3. Nav BG
				'#EFEFEF', // 4. Nav Text
				'#222222', // 5. Body Text
				'#009D97', // 6. Primary
				'#AA2159', // 7. Primary Hover
				'#AA2159', // 8. Secondary
				'#009D97', // 9. Action
				'#BCC747', // 10. Button
				'#798D8F', // 11. Border
				'#AA2159', // 12. Masthead Text
				'#FFFFFF', // 13. Footer BG
				'#AA2159', // 14. Footer Text
				'#FFFFFF', // 15. Delimiter
			),
		),
		'slate_blue'     => array(
			'label'  => __( 'Slate Blue (Legacy)', 'memberlite' ),
			'colors' => array(
				'#6991AC', // 0. Heading
				'#F5F5F5', // 1. Background
				'#F5F5F5', // 2. Masthead BG
				'#FFFFFF', // 3. Nav BG
				'#67727A', // 4. Nav Text
				'#222222', // 5. Body Text
				'#6991AC', // 6. Primary
				'#6991AC', // 7. Primary Hover
				'#67727A', // 8. Secondary
				'#6991AC', // 9. Action
				'#D75C37', // 10. Button
				'#798D8F', // 11. Border
				'#67727A', // 12. Masthead Text
				'#FFFFFF', // 13. Footer BG
				'#67727A', // 14. Footer Text
				'#FFFFFF', // 15. Delimiter
			),
		),
		'watermelon'     => array(
			'label'  => __( 'Watermelon Seed (Legacy)', 'memberlite' ),
			'colors' => array(
				'#363635', // 0. Heading
				'#F9F9F7', // 1. Background
				'#F9F9F7', // 2. Masthead BG
				'#363635', // 3. Nav BG
				'#FFFFFF', // 4. Nav Text
				'#222222', // 5. Body Text
				'#83BF17', // 6. Primary
				'#83BF17', // 7. Primary Hover
				'#83BF17', // 8. Secondary
				'#363635', // 9. Action
				'#F15D58', // 10. Button
				'#798D8F', // 11. Border
				'#83BF17', // 12. Masthead Text
				'#FFFFFF', // 13. Footer BG
				'#83BF17', // 14. Footer Text
				'#FFFFFF', // 15. Delimiter
			),
		),
	);

	return apply_filters( 'memberlite_color_schemes', $schemes );
}


/**
 * Used to fetch active default colors based on the selected color scheme
 *
 * @return array
 */
function memberlite_get_active_colors() {
	global $memberlite_defaults;

	$variation_scheme = get_theme_mod( 'memberlite_variation_color_scheme', 'default_2026' );

	// Check if it's a legacy scheme
	$legacy_schemes = memberlite_get_legacy_color_schemes();
	if ( isset( $legacy_schemes[ $variation_scheme ] ) ) {
		// Use the mapping function for consistency
		$colors = $legacy_schemes[ $variation_scheme ]['colors'];

		return memberlite_map_legacy_colors_to_settings( $colors );
	}

	// Check if it's a new variation scheme
	$new_schemes = memberlite_get_color_schemes();
	if ( isset( $new_schemes[ $variation_scheme ] ) ) {
		// It's a new scheme - use new color mapping
		// Dynamically call the appropriate function
		if ( $variation_scheme === 'default_2026' ) {
			$color_array = memberlite_get_colors();
		} else {
			// Build function name: memberlite_get_{scheme}_colors()
			$function_name = 'memberlite_get_' . $variation_scheme . '_colors';
			if ( function_exists( $function_name ) ) {
				$color_array = call_user_func( $function_name );
			} else {
				// Fallback to default
				$color_array = memberlite_get_colors();
			}
		}

		return memberlite_map_colors_to_settings( $color_array );
	}

	// Custom mode - get individual saved colors
	$colors     = array();
	$color_keys = array(
		'background_color',
		'bgcolor_header',
		'bgcolor_site_navigation',
		'color_site_navigation',
		'color_text',
		'color_heading',
		'color_link',
		'color_meta_link',
		'color_primary',
		'color_secondary',
		'color_action',
		'color_button',
		'bgcolor_page_masthead',
		'color_page_masthead',
		'bgcolor_footer_widgets',
		'color_footer_widgets',
		'color_borders',
	);

	foreach ( $color_keys as $key ) {
		$value          = get_theme_mod( $key );
		$colors[ $key ] = ! empty( $value ) ? $value : ( isset( $memberlite_defaults[ $key ] ) ? $memberlite_defaults[ $key ] : '' );
	}

	return $colors;
}

// Globals
global $memberlite_defaults, $memberlite_color_schemes, $memberlite_legacy_color_schemes, $memberlite_defaults_news, $memberlite_defaults_wptavern, $memberlite_defaults_legacy;

$memberlite_defaults             = memberlite_get_defaults();
$memberlite_defaults_news        = memberlite_get_defaults_news();
$memberlite_defaults_wptavern    = memberlite_get_defaults_wptavern();
$memberlite_defaults_legacy      = memberlite_get_defaults_legacy();
$memberlite_color_schemes        = memberlite_get_color_schemes();
$memberlite_legacy_color_schemes = memberlite_get_legacy_color_schemes();
