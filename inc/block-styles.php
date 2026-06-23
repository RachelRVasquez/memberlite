<?php
/**
 * Register custom block styles for Memberlite
 *
 * @package Memberlite
 *
 * @since 7.1
 */

/**
 * Register block styles.
 *
 * @since 7.1
 * @return void
 */
function memberlite_register_block_styles(): void {
	register_block_style(
		'core/list',
		array(
			'name'         => 'plain',
			'label'        => __( 'Plain', 'memberlite' ),
			'inline_style' => '
				.wp-block-list.is-style-plain {
					list-style: none;
					padding-left: 0;
					margin-left: 0;
				}
			',
		)
	);
}
add_action( 'init', 'memberlite_register_block_styles' );

function memberlite_register_pmpro_block_styles(): void {
	if ( defined( 'PMPRO_VERSION' ) ) {
		$block_styles = array(
			'core/group' => array(
				array(
					'name'                => 'pmpro-card-variation-1',
					'label'               => __( 'Base Card', 'memberlite' ),
					'style_handle'        => 'pmpro-block-styles',
					'editor_style_handle' => 'pmpro-block-styles',
				),
				array(
					'name'  => 'pmpro-card-high-contrast',
					'label' => __( 'High Contrast Card', 'memberlite' ),
				)
			),
		);

		foreach ( $block_styles as $block_name => $styles ) {
			foreach ( $styles as $style ) {
				register_block_style( $block_name, $style );
			}
		}
	}
}
add_action( 'wp_loaded', 'memberlite_register_pmpro_block_styles' );
