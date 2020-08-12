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

defined( 'ABSPATH' ) or exit;

/**
 * Handler for the notice shown when the merchant filters users by the Customer role.
 *
 * @since 1.1.0
 */
class Users extends Prompt {


	/** @var string the id associated with the message */
	private $customer_role_message_id = 'users-customers-role';

	/** @var string user page identifier */
	private $users_screen_id = 'users';

	/** @var string customer role to match with role parameter */
	private $customer_role = 'customer';

	/**
	 * {@inheritDoc}
	 */
	protected function add_prompt_hooks() { }

	/**
	 * {@inheritDoc}
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
