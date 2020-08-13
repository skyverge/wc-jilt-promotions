jQuery( function( $ ) {


	/**
	 * Jilt Plugin Installation modal handler.
	 *
	 * @since 1.1.0-dev.1
	 */
	$.JiltPromotions = class InstallPluginModal {


		/**
		 * Constructor.
		 *
		 * @since 1.1.0-dev.1
		 *
		 * @param {object} options
		 */
		constructor( options ) {

			this.messageID = options.messageID || '';
			this.target    = options.target    || '';
			this.onClose   = options.onClose   || '';

			if ( '' === this.messageID ) {
				console.log( 'InstallPluginModal: missing messageID' )
				return;
			}

			if ( '' === this.target ) {
				this.target = 'tmpl-sv-wc-jilt-promotions-' + options.messageID + '-modal';
			}

			this.initialize();
			this.open();
		}


		/**
		 * Initializes modal.
		 *
		 * @since 1.1.0-dev.1
		 */
		initialize() {

			// ensures there are no other modals opened
			$( '#wc-backbone-modal-dialog .modal-close' ).trigger( 'click' );
		}


		/**
		 * Opens the modal.
		 *
		 * @since 1.1.0-dev.1
		 */
		open() {

		}


	}

} );
