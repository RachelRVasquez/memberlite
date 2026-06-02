( function () {
	const { createElement, createRoot, useState, useEffect, useRef } = wp.element;
	const { previewUrl, stylesheet, messengerChannel, changesetUuid, nonce } = memberliteWizard;

	const iframeSrc = previewUrl +
		( previewUrl.includes( '?' ) ? '&' : '?' ) +
		new URLSearchParams( {
			wp_customize:                 'on',
			customize_theme:              stylesheet,
			customize_messenger_channel:  messengerChannel,
			customize_changeset_uuid:     changesetUuid,
			_customize_nonce:             nonce,
		} ).toString();

	function StatusRow( props ) {
		return createElement(
			'p',
			{ style: { color: props.ok ? 'green' : 'red', margin: '4px 0' } },
			( props.ok ? '✓ ' : '✗ ' ) + props.label
		);
	}

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
		const [ messages, setMessages ]     = useState( [] );
		const [ iframeLoaded, setIframeLoaded ] = useState( false );
		const [ iframeDiag, setIframeDiag ] = useState( null );
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

			const iwin = iframeRef.current.contentWindow;
			const settings = iwin._wpCustomizeSettings;
			const iframeChannel = settings && settings.channel;

			const diag = {
				wpCustomizeSettingsDefined: !! settings,
				iframeChannel: iframeChannel || null,
				ourChannel: messengerChannel,
				channelsMatch: iframeChannel === messengerChannel,
				wpCustomizeDefined: !! ( iwin.wp && iwin.wp.customize ),
			};

			console.log( '[Wizard] iframe diagnostics:', diag );
			console.log( '[Wizard] iframe _wpCustomizeSettings:', settings );
			setIframeDiag( diag );

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
					{ style: { color: iframeLoaded ? 'green' : 'darkorange', margin: '4px 0' } },
					iframeLoaded ? '✓ iframe loaded' : '⏳ iframe loading…'
				),

				iframeDiag && createElement(
					'div',
					{ style: { marginTop: '12px' } },
					createElement( 'strong', null, 'iframe diagnostics:' ),
					createElement( StatusRow, { ok: iframeDiag.wpCustomizeSettingsDefined, label: '_wpCustomizeSettings defined' } ),
					createElement( StatusRow, { ok: iframeDiag.wpCustomizeDefined,         label: 'iframe wp.customize defined' } ),
					createElement( StatusRow, { ok: iframeDiag.channelsMatch,               label: 'channels match' } ),
					createElement( 'pre', { style: { fontSize: '10px', background: '#f0f0f0', padding: '4px', marginTop: '6px', whiteSpace: 'pre-wrap', wordBreak: 'break-all' } },
						'ours:   ' + messengerChannel + '\niframe: ' + ( iframeDiag.iframeChannel || 'undefined' )
					)
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
