jQuery( document ).ready( function ($) {


	let shouldDisplayModal = true;

	// open a promotional modal when the merchant clicks the Abandoned Carts button in the Orders page
	$( document ).on( 'click', '.orders-abandoned-carts-filter', function ( event ) {

		if ( shouldDisplayModal ) {

			// mark message as enabled so that we don't enqueue the scripts to show the modal again
			$.JiltPromotions.Messages.enableMessage( sv_wc_jilt_prompt_orders.abandoned_carts_id );

			let onCloseEventName = 'sv_wc_jilt_prompt_orders_modal_close';

			new $.JiltPromotions.InstallPluginModal( {
				messageID: sv_wc_jilt_prompt_orders.abandoned_carts_id,
				onClose: onCloseEventName
			} );

			$( document ).on( onCloseEventName, function() {

				$.JiltPromotions.Messages.dismissMessage( sv_wc_jilt_prompt_orders.abandoned_carts_id );
			} );

			shouldDisplayModal = false;
		}
	} );


} );
