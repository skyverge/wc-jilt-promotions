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

use SkyVerge\WooCommerce\Jilt_Promotions\Handlers\Installation;
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
	 * Returns the estimated number of abandoned carts for the last 30 days.
	 *
	 * @since 1.1.0-dev.1
	 *
	 * @retun float
	 */
	private function get_abandoned_carts_count() {

		$orders_count = $this->get_orders_count();

		// 70% of carts are abandoned
		$carts_abandoned_rate = 0.7;

		// 15% of carts are recovered
		$carts_recovered_rate = 0.15;

		return ( $orders_count / ( 1 - $carts_abandoned_rate ) ) * $carts_abandoned_rate * $carts_recovered_rate;
	}


	/**
	 * Gets the connection redirect args to attribute the plugin installation to this prompt.
	 *
	 * @since 1.1.0-dev.1
	 */
	protected function get_connection_redirect_args() {

		$redirect_args = [];

		if( Installation::get_jilt_installed_from() === $this->abandoned_carts_filter_message_id ) {
			$redirect_args['utm_term'] = $this->abandoned_carts_filter_message_id;
		}

		return $redirect_args;
	}


	/**
	 * Returns the number of orders placed in the last 30 days.
	 *
	 * @since 1.1.0-dev.1
	 *
	 * @return int
	 */
	private function get_orders_count() {

		return 0;
	}


	/**
	 * Returns the gross sales for the last 30 days.
	 *
	 * @since 1.1.0-dev.1
	 *
	 * @return float
	 */
	private function get_orders_revenue() {

		return 0.0;
	}


	/**
	 * Returns the estimated recovered revenue from abandoned carts fort the last 30 days.
	 *
	 * @since 1.1.0-dev.1
	 *
	 * @return float
	 */
	private function get_recovered_revenue() {

		return 0.0;
	}


	/**
	 * Returns the number of orders placed in the last 30 days and the gross sales for that period.
	 *
	 * @since 1.1.0-dev.1
	 *
	 * @return array
	 */
	private function get_sales_data() {

		return [
			'number_of_orders' => 0,
			'gross_sales'      => 0.0,
		];
	}


	/**
	 * Retrieves the abandoned carts count and the recovered revenue to render the recover carts modal.
	 *
	 * @since 1.1.0-dev.1
	 */
	public function render_recover_carts_modal() {


	}


}
