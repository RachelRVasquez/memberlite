<?php
/**
 * Setup Wizard admin page for Memberlite Theme
 *
 * @package Memberlite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Renders the Memberlite Setup Wizard admin page.
 */
function memberlite_wizard_render() {
	?>
	<div class="wrap">
		<div id="memberlite-wizard-root"></div>
	</div>
	<?php
}

/**
 * Enqueues the wizard script on the wizard admin page only.
 *
 * @param string $hook Current admin page hook suffix.
 */
function memberlite_wizard_enqueue_scripts( $hook ) {
	global $memberlite_wizard_page_hook;
	if ( $hook !== $memberlite_wizard_page_hook ) {
		return;
	}

	wp_enqueue_script(
		'memberlite-wizard',
		get_template_directory_uri() . '/src/js/wizard.js',
		array( 'wp-element', 'customize-controls' ),
		MEMBERLITE_VERSION,
		true
	);

	$stylesheet = get_stylesheet();

	wp_localize_script(
		'memberlite-wizard',
		'memberliteWizard',
		array(
			'previewUrl'       => home_url( '/' ),
			'stylesheet'       => $stylesheet,
			'messengerChannel' => 'preview-' . substr( md5( uniqid( '', true ) ), 0, 8 ),
			'changesetUuid'    => wp_generate_uuid4(),
			'nonce'            => wp_create_nonce( 'preview-customize_' . $stylesheet ),
		)
	);
}
add_action( 'admin_enqueue_scripts', 'memberlite_wizard_enqueue_scripts' );
