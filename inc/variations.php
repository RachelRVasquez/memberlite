<?php
/**
 * Helper functions for variations.
 *
 * @package Memberlite
 *
 * @since 7.0
 */

/**
 * Get the post_name of the memberlite_footer post to render for the current context.
 *
 * Checks context-specific theme_mods first (single post, page, archives),
 * then falls back to the global default footer setting.
 *
 * @since 7.0
 *
 * @return string post_name of the memberlite_footer post, or '0' if none is set.
 */
function memberlite_get_current_footer_post_name() {
	$post_name = '0';

	if ( is_singular( 'post' ) ) {
		$post_name = get_theme_mod( 'memberlite_post_footer_slug', '0' );
	} elseif ( is_page() ) {
		$post_name = get_theme_mod( 'memberlite_page_footer_slug', '0' );
	} elseif ( is_archive() || is_home() ) {
		$post_name = get_theme_mod( 'memberlite_archives_footer_slug', '0' );
	}

	// Fall back to the global default if the context-specific setting is unset.
	if ( empty( $post_name ) || '0' === $post_name ) {
		$post_name = get_theme_mod( 'memberlite_default_footer_slug', '0' );
	}

	return $post_name;
}

/**
 * Render a footer variation.
 *
 * Looks up the memberlite_footer CPT post by post_name (as stored in the
 * theme_mod) and renders its block content. Falls back to the registered
 * default theme pattern if no post is found or no post_name is given.
 *
 * @since TBD
 *
 * @param string $post_name The post_name of the memberlite_footer post to render.
 */
function memberlite_render_footer_variation( $post_name ) {
	if ( ! empty( $post_name ) && '0' !== $post_name ) {
		$footer_post = get_page_by_path( $post_name, OBJECT, 'memberlite_footer' );

		if ( $footer_post ) {
			echo do_blocks( $footer_post->post_content ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			return;
		}
	}

	// Fall back to the registered default theme pattern.
	echo do_blocks( '<!-- wp:pattern {"slug":"memberlite/footer-default"} /-->' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
