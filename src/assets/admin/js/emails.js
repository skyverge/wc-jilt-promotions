jQuery( document ).ready( function( $ ) {

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
