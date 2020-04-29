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

namespace SkyVerge\WooCommerce\Jilt_Promotions;

defined( 'ABSPATH' ) or exit;

/**
 * The base package class.
 *
 * @since 1.0.0
 */
class Package {

	/** @var string the package ID */
	const ID = 'sv-wc-jilt-promotions';

	/** @var string the package version */
	const VERSION = '1.0.0';


	/**
	 * Gets the package assets URL.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public static function get_assets_url() {

		return untrailingslashit( plugins_url( '/assets', __FILE__ ) );
	}


}
