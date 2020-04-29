jQuery( document ).ready( function( $ ) {

	// handle the "install" CTA
	$( '#sv-wc-jilt-emails-install-prompt .sv-wc-jilt-prompt-install-cta' ).click( function( event ) {

		event.preventDefault();

		if ( confirm( 'Install Jilt?' ) ) { // TODO: replace with the real modal & message

			$.post(
				ajaxurl,
				{
					action: 'sv_wc_jilt_install_jilt',
					nonce:  sv_wc_jilt_email_prompt.nonces.install_plugin,
				}
			).then( function( response ) {

				if ( response.success && response.data.redirect_url ) {

					window.location = response.data.redirect_url;

				} else {

					console.error( response );

					alert( sv_wc_jilt_email_prompt.i18n.install_error );
				}

			} ).fail( function() {

				alert( sv_wc_jilt_email_prompt.i18n.install_error );

			} );
		}

	} );


	// handle the "hide" CTA
	$( '#sv-wc-jilt-emails-install-prompt .sv-wc-jilt-prompt-hide-cta' ).click( function( event ) {

		event.preventDefault();

		$( this ).parents( 'table' ).hide();

		// TODO: hide the Emails screen title & description

		$.post(
			ajaxurl,
			{
				action: 'sv_wc_jilt_hide_emails_prompt',
				nonce:  sv_wc_jilt_email_prompt.nonces.hide_prompt,
			}
		);

	} );

} );
