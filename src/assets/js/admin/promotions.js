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

			options = {
				messageID : options.messageID || '',
				target    : options.target    || '',
				onClose   : options.onClose   || '',
			}

			if ( '' === options.messageID ) {
				console.log( 'missing messageID' )
				return;
			}

			if ( '' === options.target ) {
				options.target = 'tmpl-sv-wc-jilt-promotions-' + options.messageID + '-modal';
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
