( function () {
	const { createElement, createRoot } = wp.element;

	const customizeAvailable = typeof wp !== 'undefined' && typeof wp.customize !== 'undefined';
	const previewer = customizeAvailable && typeof wp.customize.previewer !== 'undefined';

	console.log( '[Wizard] wp.customize:', customizeAvailable ? wp.customize : 'NOT DEFINED' );
	console.log( '[Wizard] wp.customize.previewer:', previewer ? wp.customize.previewer : 'NOT DEFINED' );

	function StatusRow( props ) {
		return createElement(
			'p',
			{ style: { color: props.ok ? 'green' : 'red', margin: '4px 0' } },
			( props.ok ? '✓ ' : '✗ ' ) + props.label
		);
	}

	function WizardApp() {
		return createElement(
			'div',
			{ style: { padding: '20px' } },
			createElement( 'h1', null, 'Memberlite Setup Wizard' ),
			createElement( 'h2', null, 'Ticket 2 — wp.customize bootstrap check' ),
			createElement( StatusRow, { ok: customizeAvailable, label: 'wp.customize is defined' } ),
			createElement( StatusRow, { ok: previewer, label: 'wp.customize.previewer is defined' } ),
			createElement( 'p', { style: { marginTop: '12px', color: '#666' } }, 'See browser console for full object inspection.' )
		);
	}

	const container = document.getElementById( 'memberlite-wizard-root' );
	if ( container ) {
		createRoot( container ).render( createElement( WizardApp ) );
	}
} )();
