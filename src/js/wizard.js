( function () {
	const { createElement, createRoot, useState, useEffect, useRef } = wp.element;
	const { previewUrl, stylesheet, messengerChannel } = memberliteWizard;

	const iframeSrc = previewUrl +
		( previewUrl.includes( '?' ) ? '&' : '?' ) +
		new URLSearchParams( {
			customize_theme: stylesheet,
			customize_messenger_channel: messengerChannel,
		} ).toString();

	function sendToPreview( iframeEl, type, payload ) {
		if ( ! iframeEl || ! iframeEl.contentWindow ) {
			return;
		}
		iframeEl.contentWindow.postMessage(
			JSON.stringify( { id: messengerChannel, data: { type, payload } } ),
			'*'
		);
	}

	function WizardApp() {
		const [ messages, setMessages ] = useState( [] );
		const [ iframeLoaded, setIframeLoaded ] = useState( false );
		const iframeRef = useRef( null );

		useEffect( () => {
			function onMessage( event ) {
				try {
					const parsed = JSON.parse( event.data );
					if ( parsed.id === messengerChannel ) {
						console.log( '[Wizard] Received from preview:', parsed );
						setMessages( prev => [ ...prev, parsed.data ] );
					}
				} catch ( e ) {}
			}
			window.addEventListener( 'message', onMessage );
			return () => window.removeEventListener( 'message', onMessage );
		}, [] );

		function handleIframeLoad() {
			setIframeLoaded( true );
			console.log( '[Wizard] iframe loaded, sending active signal' );
			sendToPreview( iframeRef.current, 'active', {} );
		}

		return createElement(
			'div',
			{ style: { display: 'flex', gap: '16px', height: '80vh' } },

			// Status panel
			createElement(
				'div',
				{ style: { width: '280px', flexShrink: 0, overflowY: 'auto' } },
				createElement( 'h2', { style: { marginTop: 0 } }, 'Ticket 3 — Preview iframe' ),
				createElement(
					'p',
					{ style: { color: iframeLoaded ? 'green' : 'darkorange' } },
					iframeLoaded ? '✓ iframe loaded' : '⏳ iframe loading…'
				),
				createElement( 'strong', null, 'Messages from preview:' ),
				messages.length === 0
					? createElement( 'p', { style: { color: '#666' } }, 'None yet — waiting for preview handshake.' )
					: messages.map( ( msg, i ) =>
						createElement(
							'pre',
							{ key: i, style: { fontSize: '11px', background: '#f0f0f0', padding: '6px', marginTop: '6px', whiteSpace: 'pre-wrap', wordBreak: 'break-all' } },
							JSON.stringify( msg, null, 2 )
						)
					)
			),

			// Preview iframe
			createElement( 'iframe', {
				ref: iframeRef,
				src: iframeSrc,
				onLoad: handleIframeLoad,
				style: { flex: 1, border: '1px solid #ccc', borderRadius: '4px' },
			} )
		);
	}

	const container = document.getElementById( 'memberlite-wizard-root' );
	if ( container ) {
		createRoot( container ).render( createElement( WizardApp ) );
	}
} )();
