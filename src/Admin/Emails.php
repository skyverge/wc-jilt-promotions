<?php
/**
 * Jilt for WooCommerce Promotions
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file license.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@skyverge.com so we can send you a copy immediately.
 *
 * @author    SkyVerge
 * @copyright Copyright (c) 2020, SkyVerge, Inc. (info@skyverge.com)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

namespace SkyVerge\WooCommerce\Jilt_Promotions\Admin;

defined( 'ABSPATH' ) or exit;

use SkyVerge\WooCommerce\Jilt_Promotions\Package;

/**
 * The emails handler.
 */
final class Emails {


	/** @var string the "hide jilt prompt" meta key */
	const META_KEY_HIDE_PROMPT = 'sv_wc_jilt_hide_emails_prompt';

	/** @var string the AJAX action for installing Jilt */
	const AJAX_ACTION_INSTALL = 'sv_wc_jilt_install_jilt';

	/** @var string the AJAX action for hiding the Jilt install prompt */
	const AJAX_ACTION_HIDE_PROMPT = 'sv_wc_jilt_hide_emails_prompt';

	/** @var string the option name to flag whether Jilt was installed via a prompt */
	const OPTION_INSTALLED_FROM_PROMPT = 'sv_wc_jilt_installed_from_emails_prompt';

	/** @var string the campaign value for the connection arguments */
	const UTM_CAMPAIGN = 'wc-email-settings';

	/** @var string the content value for the connection arguments */
	const UTM_CONTENT = 'install-jilt-button';

	/** @var string the global term value for the connection arguments */
	const UTM_TERM_GLOBAL = 'global-email-settings';


	/**
	 * Emails constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		$this->add_hooks();
	}


	/**
	 * Adds the necessary action & filter hooks.
	 *
	 * @since 1.0.0
	 */
	private function add_hooks() {

		// add the Jilt install prompt hooks
		if ( $this->should_display_prompt() ) {

			// enqueue the assets
			$this->enqueue_assets();

			// render the Jilt install prompt setting HTML for the general Emails settings page
			add_action( 'woocommerce_admin_field_jilt_prompt', [ $this, 'render_general_setting_html'] );

			// render the Jilt install prompt setting HTML for the individual email settings page
			add_action( 'woocommerce_email_settings_after', [ $this, 'render_email_setting_html' ] );

			// add the Jilt install "setting" to the existing general emails settings
			add_filter( 'woocommerce_email_settings', [ $this, 'add_emails_setting' ] );

			// install Jilt via AJAX
			add_action( 'wp_ajax_' . self::AJAX_ACTION_INSTALL, [ $this, 'ajax_install_plugin' ] );

			// hide the Jilt install prompt via AJAX
			add_action( 'wp_ajax_' . self::AJAX_ACTION_HIDE_PROMPT, [ $this, 'ajax_hide_prompt' ] );

			// add the modal markup
			add_action( 'admin_footer', function() {
				include_once( Package::get_package_path() . '/views/admin/html-install-plugin-modal.php' );
			} );
		}

		// add the connection redirect args if the plugin was installed from this prompt
		add_filter( 'wc_jilt_app_connection_redirect_args', [ $this, 'add_connection_redirect_args' ] );
	}


	/**
	 * Adds the connection redirect args if the plugin was installed from this prompt.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args redirect args
	 * @return array
	 */
	public function add_connection_redirect_args( $args ) {

		if ( $email_id = get_option( self::OPTION_INSTALLED_FROM_PROMPT, false ) ) {

			$utm_term = str_replace( '_', '-', wc_clean( $email_id ) );

			$args['utm_campaign'] = self::UTM_CAMPAIGN;
			$args['utm_content']  = self::UTM_CONTENT;
			$args['utm_term']     = $utm_term;
			$args['partner']      = '1';
			$args['campaign']     = self::UTM_CAMPAIGN;
		}

		return $args;
	}


	/**
	 * Enqueues the assets.
	 *
	 * @since 1.0.0
	 */
	private function enqueue_assets() {

		// only load on WooCommerce settings pages
		if ( empty( $_GET['page'] ) || 'wc-settings' !== $_GET['page'] ) {
			return;
		}

		// only load on the Emails settings pages
		if ( empty( $_GET['tab'] ) || 'email' !== $_GET['tab'] ) {
			return;
		}

		// admin styles
		add_action( 'admin_init', function() {

			wp_enqueue_style( 'sv-wc-jilt-prompt-email-styles', Package::get_assets_url() . '/admin/css/emails.css', [], Package::VERSION );

		} );

		// admin scripts
		add_action( 'admin_enqueue_scripts', function() {

			wp_enqueue_script( 'wc-backbone-modal', null, [ 'backbone' ] );

			wp_enqueue_script( 'sv-wc-jilt-prompt-email-scripts', Package::get_assets_url() . '/admin/js/emails.js', [ 'jquery', 'wc-backbone-modal' ], Package::VERSION );

			wp_localize_script( 'sv-wc-jilt-prompt-email-scripts', 'sv_wc_jilt_email_prompt', [
				'email_id' => ! empty( $_GET['section'] ) ? wc_clean( str_replace( '_', '-', $_GET['section'] ) ) : self::UTM_TERM_GLOBAL,
				'nonces'   => [
					'install_plugin' => wp_create_nonce( self::AJAX_ACTION_INSTALL ),
					'hide_prompt'    => wp_create_nonce( self::AJAX_ACTION_HIDE_PROMPT ),
				],
				'i18n' => [
					'install_error' => sprintf(
						/* translators: Placeholders: %1$s - <a> tag, %2$s - </a> tag */
						__( 'Whoops, looks like there was an error installing Jilt for WooCommerce - please install manually %1$sfrom the Plugins menu%2$s.', 'sv-wc-jilt-promotions' ),
						'<a href="' . esc_url( admin_url( 'plugin-install.php?s=jilt+for+woocommerce&tab=search&type=term' ) ) . '">', '</a>'
					),
				],
			] );

		} );
	}


	/**
	 * Installs Jilt via AJAX.
	 *
	 * @internal
	 *
	 * @since 1.0.0
	 */
	public function ajax_install_plugin() {

		check_ajax_referer( self::AJAX_ACTION_INSTALL, 'nonce' );

		try {

			// TODO: install Jilt

			$email_id = ! empty( $_POST['email_id'] ) ? $_POST['email_id'] : self::UTM_TERM_GLOBAL;

			// flag the Jilt install as generated by the prompt
			update_option( self::OPTION_INSTALLED_FROM_PROMPT, wc_clean( $email_id ) );

			wp_send_json_success( [
				'message'      => __( 'Jilt for WooCommerce successfully installed', 'woocommerce-plugin-framework' ),
				'redirect_url' => admin_url( 'admin.php?page=wc-jilt' ),
			] );

		} catch ( \Exception $exception ) {

			wp_send_json_error( [
				'message' => sprintf(
					/* translators: Placeholders: %s - install error message */
					__( 'Could not install Jilt for WooCommerce. %s', 'woocommerce-plugin-framework' ),
					$exception->getMessage()
				),
			] );
		}
	}


	/**
	 * Hides the Jilt install prompt via AJAX.
	 *
	 * @internal
	 *
	 * @since 1.0.0
	 */
	public function ajax_hide_prompt() {

		check_ajax_referer( self::AJAX_ACTION_HIDE_PROMPT, 'nonce' );

		update_user_meta( get_current_user_id(), self::META_KEY_HIDE_PROMPT, 'yes' );
	}


	/**
	 * Adds the Jilt install "setting" to the existing general emails settings.
	 *
	 * @since 1.0.0
	 *
	 * @param array $settings existing emails settings
	 * @return array
	 */
	public function add_emails_setting( $settings ) {

		$settings[] = [
			'type'  => 'title',
			'title' => __( 'Advanced emails', 'woocommerce-plugin-framework' ),
			'desc'  => sprintf(
				/* translators: Placeholders; %1$s - <a> tag, %2$s - </a> tag, %3$s - <a> tag, %4$s - </a> tag, %5$s - <a> tag, %6$s - </a> tag */
				__( 'Create beautiful automated, transactional, and marketing emails using a drag-and-drop editor with %1$sJilt%2$s. Learn more about free and paid plans in the %3$sdocumentation%4$s. Brought to you by %5$sSkyVerge%6$s.', 'woocommerce-plugin-framework' ),
				'<a href="' . esc_url( $this->get_jilt_details_url() ) . '" target="_blank">', '</a>',
				'<a href="' . esc_url( $this->get_documentation_url() ) . '" target="_blank">', '</a>',
				'<a href="' . esc_url( $this->get_skyverge_details_url() ) . '" target="_blank">', '</a>'
			),
		];

		$settings[] = [
			'type' => 'jilt_prompt',
		];

		$settings[] = [
			'type' => 'sectionend',
		];

		return $settings;
	}


	/**
	 * Renders the Jilt install prompt setting HTML for the individual email settings page.
	 *
	 * @internal
	 *
	 * @since 1.0.0
	 *
	 * @param \WC_Email $email email object
	 */
	public function render_email_setting_html( $email ) {

		if ( ! $email instanceof \WC_Email ) {
			return;
		}

		if ( ! $this->should_display_prompt_for_email( $email ) ) {
			return;
		}

		?>

		<table class="form-table">

			<?php $this->render_setting_html(
				__( 'Customize this email', 'woocommerce-plugin-framework' ),
				$this->get_prompt_description( $email->id )
			); ?>

		</table>

		<?php
	}


	/**
	 * Renders the Jilt install prompt setting HTML for the general Emails settings page.
	 *
	 * @internal
	 *
	 * @since 1.0.0
	 */
	public function render_general_setting_html() {

		$this->render_setting_html( __( 'Enhanced emails with Jilt', 'woocommerce-plugin-framework' ) );
	}


	/**
	 * Renders the Jilt install prompt settings HTML.
	 *
	 * @since 1.0.0
	 *
	 * @param string $title the setting title
	 * @param string $description description to display over the button, if any
	 */
	private function render_setting_html( $title, $description = '' ) {

		?>

		<tr id="sv-wc-jilt-emails-install-prompt" valign="top">

			<th scope="row" class="titledesc">
				<label>
					<?php echo esc_html( $title ); ?> <?php echo wc_help_tip( __( 'This setting is shown because you currently have a SkyVerge plugin active.', 'woocommerce-plugin-framework' ) ); ?>
				</label>
			</th>

			<td class="forminp">

				<?php if ( $description ) : ?>
					<p><?php echo wp_kses_post( $description ); ?></p>
				<?php endif; ?>

				<a href="#" class="sv-wc-jilt-prompt-install-cta button"><span class="dashicons dashicons-email"></span><?php esc_html_e( 'Install Jilt', 'woocommerce-plugin-framework' ); ?></a>
				<a href="#" class="sv-wc-jilt-prompt-hide-cta" ><?php esc_html_e( 'Hide this setting', 'woocommerce-plugin-framework' ); ?></a>

			</td>

		</tr>

		<?php
	}


	/** Conditional methods *******************************************************************************************/


	/**
	 * Whether the Jilt install prompt should be displayed.
	 *
	 * @since 1.0.0
	 *
	 * @param int|null WordPress user ID
	 * @return bool
	 */
	private function should_display_prompt( $user_id = null ) {

		$display = ! $this->is_plugin_installed();

		if ( ! $user_id ) {
			$user_id = get_current_user_id();
		}

		$display = $display && ! wc_string_to_bool( get_user_meta( $user_id, self::META_KEY_HIDE_PROMPT, true ) );

		/**
		 * Filters whether the Jilt install prompt should be displayed.
		 *
		 * @since 1.0.0
		 *
		 * @param bool $should_display whether the Jilt install prompt should be displayed
		 * @param int $user_id WordPress user ID
		 */
		return (bool) apply_filters( 'sv_wc_jilt_prompt_should_display', $display, $user_id );
	}


	/**
	 * Determines whether the Jilt install prompt should be shown in the given email's screen.
	 *
	 * @since 1.0.0
	 *
	 * @param \WC_Email $email email object to check
	 * @return bool
	 */
	private function should_display_prompt_for_email( \WC_Email $email ) {

		$email_ids = [
			'customer_on_hold_order',
			'customer_processing_order',
			'customer_completed_order',
			'customer_refunded_order',
		];

		/**
		 * Filters the email IDs that should have the Jilt install prompt.
		 *
		 * @since 1.0.0
		 *
		 * @param string[] $email_ids email IDs
		 */
		$email_ids = (array) apply_filters( 'sv_wc_jilt_prompt_email_ids', $email_ids );

		/**
		 * Filters whether the Jilt install prompt should be displayed for the given email.
		 *
		 * @since 1.0.0
		 *
		 * @param bool $should_display whether the Jilt install prompt should be displayed
		 * @param \WC_Email $email email object
		 */
		return (bool) apply_filters( 'sv_wc_jilt_prompt_should_display_for_email', in_array( $email->id, $email_ids, true ), $email );
	}


	/**
	 * Whether Jilt is already installed.
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	private function is_plugin_installed() {

		return function_exists( 'wc_jilt' ); // TODO: distinguish between installed and active
	}


	/** Getter methods ************************************************************************************************/


	/**
	 * Gets the Jilt install prompt description for the given email ID.
	 *
	 * Some email types should display descriptions specific to their purpose.
	 *
	 * @see Emails::get_default_prompt_description() for the default
	 *
	 * @since 1.0.0
	 *
	 * @param string $email_id desired email ID
	 *
	 * @return string
	 */
	private function get_prompt_description( $email_id = '' ) {

		switch ( $email_id ) {

			case 'customer_processing_order':

				$description = sprintf(
					/* translators: Placeholders: %1$s - <a> tag, %2$s - </a> tag */
					__( 'Personalize your receipts using a drag-and-drop editor with %1$sJilt%2$s. Send different versions of your receipt based on customer or order details (change it for international orders!), cross-sell other products, include a dynamic coupon for the next order, and more.', 'woocommerce-plugin-framework' ),
					'<a href="' . esc_url( $this->get_jilt_details_url() ) . '">', '</a>'
				);

			break;

			case 'customer_completed_order':

				$description = sprintf(
					/* translators: Placeholders: %1$s - <a> tag, %2$s - </a> tag */
					__( 'Personalize your shipment notifications using a drag-and-drop editor with %1$sJilt%2$s. Send beautiful transactional emails, change customer messaging, cross-sell other products, include a dynamic coupon for the next order, and more.', 'woocommerce-plugin-framework' ),
					'<a href="' . esc_url( $this->get_jilt_details_url() ) . '">', '</a>'
				);

			break;

			case 'customer_refunded_order':

				$description = sprintf(
					/* translators: Placeholders: %1$s - <a> tag, %2$s - </a> tag */
					__( 'Save the sale! Create beautiful, personalized transactional emails using a drag-and-drop editor with %1$sJilt%2$s. Show refund details, sell related products, or include a discount for the next order.', 'woocommerce-plugin-framework' ),
					'<a href="' . esc_url( $this->get_jilt_details_url() ) . '">', '</a>'
				);

			break;

			// TODO: handle all Subscriptions email IDs

			default:
				$description = $this->get_default_prompt_description();
		}

		/**
		 * Filters the Jilt install prompt description.
		 *
		 * @since 1.0.0
		 *
		 * @param string $description Jilt install prompt description
		 * @param string $email_id WooCommerce email ID
		 */
		return apply_filters( 'sv_wc_jilt_prompt_description', $description, $email_id );
	}


	/**
	 * Gets the default email setting description.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	private function get_default_prompt_description() {

		$description = sprintf(
			/* translators: Placeholders: %1$s - <a> tag, %2$s - </a> tag */
			__( 'Create beautiful automated and transactional emails using a drag-and-drop editor with %1$sJilt%2$s. Personalize email content with customer and order details — include cross-sells, remind customers to complete payment, or easily share vital order information.', 'woocommerce-plugin-framework' ),
			'<a href="' . esc_url( $this->get_jilt_details_url() ) . '">', '</a>'
		);

		/**
		 * Filters the Jilt install default prompt description.
		 *
		 * @since 1.0.0
		 *
		 * @param string $description Jilt install default prompt description
		 */
		return apply_filters( 'sv_wc_jilt_prompt_default_description', $description );
	}


	/**
	 * Gets the Jilt details URL.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	private function get_jilt_details_url() {

		return 'https://jilt.com/go/wc-email-settings';
	}


	/**
	 * Gets the SkyVerge details URL.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	private function get_skyverge_details_url() {

		return 'https://skyverge.com/go/wc-email-settings';
	}


	/**
	 * Gets the email documentation URL.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	private function get_documentation_url() {

		return 'https://jilt.com/go/wc-email-settings-docs';
	}


}
