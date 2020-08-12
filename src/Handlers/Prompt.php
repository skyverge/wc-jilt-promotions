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

use SkyVerge\WooCommerce\Jilt_Promotions\Admin\Emails;

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
	 * Constructor.
	 *
	 * @since 1.1.0-dev.1
	 */
	public function __construct() {

		$this->add_hooks();
	}


	/**
	 * Adds the necessary action & filter hooks.
	 *
	 * @since 1.1.0-dev.1
	 */
	private function add_hooks() {

		if ( is_admin() && $this->should_display_prompt() ) {
			$this->add_prompt_hooks();
		}
	}


	/**
	 * Adds the necessary action & filter hooks.
	 *
	 * Subclasses can use this method to setup hooks only when the prompt should be displayed.
	 *
	 * @since 1.1.0-dev.1
	 */
	abstract protected function add_prompt_hooks();


	/**
	 * Whether the Jilt install prompt should be displayed.
	 *
	 * @since 1.1.0-dev.1
	 *
	 * @return bool
	 */
	protected function should_display_prompt() {

		$display = current_user_can( 'install_plugins' ) && ! $this->is_jilt_plugin_installed();

		$display = $display && ! wc_string_to_bool( get_user_meta( get_current_user_id(), Emails::META_KEY_HIDE_PROMPT, true ) );

		/**
		 * Filters whether the Jilt install prompt should be displayed.
		 *
		 * @since 1.0.0
		 *
		 * @param bool $should_display whether the Jilt install prompt should be displayed
		 */
		return (bool) apply_filters( 'sv_wc_jilt_prompt_should_display', $display );
	}


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
