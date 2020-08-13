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
use SkyVerge\WooCommerce\Jilt_Promotions\Messages;
use WP_Post;

defined( 'ABSPATH' ) or exit;

/**
 * Handles the notices shown when new product is created and when sale price changes
 *
 * @since 1.1.0-dev.1
 */
class Product extends Prompt {

	/**
	 * @var string
	 */
	private $new_product_notice_message_id = 'new-product-notice';

	/**
	 * {@inheritDoc}
	 *
	 * @since 1.1.0-dev.1
	 */
	protected function add_prompt_hooks() {

		if ( ! Messages::is_message_enabled( $this->new_product_notice_message_id ) ) {

			add_action( 'wp_insert_post', [ $this, 'maybe_enable_new_product_notice' ], 10, 3 );

		}


	}

	/**
	 * Determine
	 *
	 * @since 1.1.0-dev.1
	 *
	 * @param int     $post_id
	 * @param WP_Post $post
	 * @param bool    $is_update
	 */
	public function maybe_enable_new_product_notice( $post_id, $post, $is_update ) {

		if ( $is_update && in_array( get_post_type( $post ), wc_get_product_types(), true ) ) {

			Messages::enable_message( $this->new_product_notice_message_id );

		}

	}

	/**
	 * {@inheritDoc}
	 *
	 * @since 1.1.0-dev.1
	 */
	protected function get_connection_redirect_args() {

		return [];
	}

}
