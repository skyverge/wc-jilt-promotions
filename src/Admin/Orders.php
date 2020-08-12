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
 * Handles the modal shown when merchants select the Abandoned Carts filter view on the Orders page.
 *
 * @since 1.1.0-dev.1
 */
class Orders extends Prompt {


	/** @var string the id associated with the message */
	private $abandoned_carts_filter_message_id = 'orders-abandoned-carts-filter';


	/**
	 * Callback for the views_edit-shop_order filter.
	 *
	 * @since 1.1.0-dev.1
	 *
	 * @param array $views
	 */
	public function add_abandoned_carts_view( $views ) {

	}


	/**
	 * {@inheritDoc}
	 *
	 * @since 1.1.0-dev.1
	 */
	protected function add_prompt_hooks() {

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
	 * Retrieves the abandoned carts count and the recovered revenue to render the recover carts modal.
	 *
	 * @since 1.1.0-dev.1
	 */
	public function render_recover_carts_modal() {


	}


}
