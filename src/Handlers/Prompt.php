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

namespace SkyVerge\WooCommerce\Jilt_Promotions\Handlers;

defined( 'ABSPATH' ) or exit;

/**
 * The base prompts handler.
 *
 * @since 1.1.0-dev.1
 */
abstract class Prompt {


	/** @var string the source value for the connection arguments */
	const UTM_SOURCE = 'jilt-for-woocommerce';

	/** @var string the medium value for the connection arguments */
	const UTM_MEDIUM = 'oauth';

	/** @var string the campaign value for the connection arguments */
	const UTM_CAMPAIGN = 'wc-plugin-promo';

	/** @var string the content value for the connection arguments */
	const UTM_CONTENT = 'install-jilt-button';




	/**
	 * Whether Jilt is already installed.
	 *
	 * @since 1.1.0-dev.1
	 *
	 * @return bool
	 */
	protected function is_jilt_plugin_installed() {

		return function_exists( 'wc_jilt' );
	}


}
