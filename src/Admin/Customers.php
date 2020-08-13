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

use Automattic\WooCommerce\Admin\PageController;
use SkyVerge\WooCommerce\Jilt_Promotions\Handlers\Installation;
use SkyVerge\WooCommerce\Jilt_Promotions\Handlers\Prompt;
use SkyVerge\WooCommerce\Jilt_Promotions\Package;

/**
 * The prompt handler for the Customers page.
 *
 * @since 1.1.0
 */
final class Customers extends Prompt {


	/** @var string the ID of the customers download message */
	private $download_message_id = 'wc-customers-download';

	/** @var string the ID of the Customers page */
	private $customers_page_id = 'woocommerce-analytics-customers';


	/**
	 * Enqueues the assets.
	 *
	 * @internal
	 *
	 * @since 1.1.0
	 */
	public function enqueue_assets() {

		if ( $this->is_woocommerce_customers_page() ) {
			wp_enqueue_script( 'sv-wc-jilt-prompt-customers', Package::get_assets_url() . '/js/admin/customers.min.js', [ Installation::INSTALL_SCRIPT_HANDLE ], Package::VERSION, true );
		}
	}


	/**
	 * Determines whether the current page is the WooCommerce Customers admin page.
	 *
	 * @since 1.1.0
	 *
	 * @return bool
	 */
	private function is_woocommerce_customers_page() {

		$is_customers_page = false;

		if ( class_exists( PageController::class ) && is_callable( PageController::class, 'instance' ) && $page_controller = PageController::get_instance() ) {

			if ( is_callable( [ $page_controller, 'get_current_page' ] ) && $current_page = $page_controller->get_current_page() ) {
				$is_customers_page = isset( $current_page['id'] ) && $current_page['id'] === $this->customers_page_id;
			}
		}

		return $is_customers_page;
	}


}
