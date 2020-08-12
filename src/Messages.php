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
 * @since 1.1.0
 */
class Messages {


	/** @var string user meta key name for storing enabled messages */
	const META_KEY_ENABLED_MESSAGES = '_sv_wc_jilt_enabled_messages';

	/** @var string user meta key name for storing dismissed messages */
	const META_KEY_DISMISSED_MESSAGES = '_sv_wc_jilt_dismissed_messages';

	/** @var string AJAX action hook name for enabling messages */
	const AJAX_ACTION_ENABLE_MESSAGE = 'sv_wc_jilt_enable_message';

	/** @var string AJAX action hook name for dismissing messages */
	const AJAX_ACTION_DISMISS_MESSAGE = 'sv_wc_jilt_dismiss_message';


	/**
	 * Messages constructor.
	 *
	 * @since 1.1.0
	 */
	public function __construct() {

		$this->add_hooks();
	}


	/**
	 * Adds hooks.
	 *
	 * @since 1.1.0
	 */
	private function add_hooks() {

	}


	/**
	 * Marks a message as enabled.
	 *
	 * @since 1.1.0
	 *
	 * @param string $message_id message identifier
	 */
	public static function enable_message( $message_id ) {

	}


	/**
	 * Marks a message as dismissed.
	 *
	 * @since 1.1.0
	 *
	 * @param string $message_id message identifier
	 */
	public static function dismiss_message( $message_id ) {

	}


}
