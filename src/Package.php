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


	/** @var Package single instance of this package */
	private static $instance;


	/**
	 * Package constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		$this->includes();
	}


	/**
	 * Include the files.
	 *
	 * @since 1.0.0
	 */
	private function includes() {

		require_once( self::get_package_path() . '/Admin/Emails.php' );

		new Admin\Emails();
	}


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


	/**
	 * Gets the package path.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public static function get_package_path() {

		return untrailingslashit( __DIR__ );
	}


	/**
	 * Gets the one true instance of Package.
	 *
	 * @since 1.0.0
	 *
	 * @return Package
	 */
	public static function instance() {

		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}


}
