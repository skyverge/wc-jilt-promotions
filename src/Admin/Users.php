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

/**
 * Handler for the notice shown when the merchant filters users by the Customer role.
 *
 * @since 1.1.0
 */
class Users {


	/** @var string the id associated with the message */
	private $customer_role_message_id = 'users-customers-role';

	/** @var string user page identifier */
	private $users_screen_id = 'users';

	/** @var string customer role to match with role parameter */
	private $customer_role = 'customer';
}
