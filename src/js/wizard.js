( function () {
	const { createElement, createRoot } = wp.element;

	function WizardApp() {
		return createElement(
			'div',
			{ style: { padding: '20px' } },
			createElement( 'h1', null, 'Memberlite Setup Wizard' ),
			createElement( 'p', null, 'Wizard scaffold — ticket 1 complete.' )
		);
	}

	const container = document.getElementById( 'memberlite-wizard-root' );
	if ( container ) {
		createRoot( container ).render( createElement( WizardApp ) );
	}
} )();
