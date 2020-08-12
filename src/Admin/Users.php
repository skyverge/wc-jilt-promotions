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

use SkyVerge\WooCommerce\Jilt_Promotions\Handlers\Prompt;
use SkyVerge\WooCommerce\Jilt_Promotions\Messages;
use SkyVerge\WooCommerce\Jilt_Promotions\Notices\Notice;

defined( 'ABSPATH' ) or exit;

/**
 * Handler for the notice shown when the merchant filters users by the Customer role.
 *
 * @since 1.1.0-dev.1
 */
class Users extends Prompt {


	/** @var string the id associated with the message */
	private $customer_role_message_id = 'users-customers-role';

	/** @var string user page identifier */
	private $users_screen_id = 'users';

	/** @var string customer role to match with role parameter */
	private $customer_role = 'customer';


	/**
	 * Renders a Notice object if the users customer role message is enabled.
	 *
	 * @since 1.1.0-dev.1
	 */
	private function add_admin_notices() {

		$notice = new Notice();
		$notice->set_message_id( $this->customer_role_message_id );
		$notice->set_actions( [
			'label'   => __( 'Email my customers', 'sv-wc-jilt-promotions' ),
			'name'    => 'email-my-customers-cta',
			'url'     => 'https://www.skyverge.com/go/email-customers',
			'primary' => true,
			'type'    => 'link,'
		] );
		$notice->set_title( __( 'Show your customers you care by keeping in touch!', 'sv-wc-jilt-promotions' ) );
		$notice->set_content( __( 'Use Jilt to send welcome emails, thank customers for purchases, and encourage lapsed customers to shop again. Do you want to install Jilt for WooCommerce to start emailing customers? You’ll be able to connect with one click!', 'sv-wc-jilt-promotions' ) );

		$notice->render();
	}


	/**
	 * {@inheritDoc}
	 *
	 * @since 1.1.0-dev.1
	 */
	protected function add_prompt_hooks() {

		if ( ! Messages::is_message_dismissed( $this->customer_role_message_id ) ) {
			add_action( 'admin_notices', array( $this, 'add_admin_notices' ), 15 );
		}
	}


	/**
	 * {@inheritDoc}
	 *
	 * @since 1.1.0-dev.1
	 */
	protected function get_connection_redirect_args() {

		return [];
	}


	/**
	 * A callback for the admin_enqueue_scripts action.
	 *
	 * Enables the customer role message, if the ID of the current screen is the Users screen ID and the role parameter is set to customer.
	 *
	 * @since 1.1.0-dev.1
	 */
	public function maybe_enable_users_customer_role_message() {

	}


}
