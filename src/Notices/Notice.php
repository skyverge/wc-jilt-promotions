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
 * The notice object.
 *
 * @since 1.0.0
 */
class Notice {


	/** @var string "button" notice action type */
	const ACTION_TYPE_BUTTON = 'button';

	/** @var string "link" notice action type */
	const ACTION_TYPE_LINK = 'link';


	/** @var string the notice message identifier */
	private $message_id = '';

	/** @var string the notice title */
	private $title = '';

	/** @var string the notice content */
	private $content = '';

	/** @var array the notice actions */
	private $actions = [];


	/**
	 * Sets the notice message ID.
	 *
	 * @since 1.1.0
	 *
	 * @param string $message_id message identifier
	 */
	public function set_message_id( $message_id ) {

		$this->message_id = $message_id;
	}


	/**
	 * Gets the notice message ID.
	 *
	 * @since 1.1.0
	 *
	 * @return string
	 */
	public function get_message_id() {

		return $this->message_id;
	}


	/**
	 * Sets the notice title.
	 *
	 * @since 1.1.0
	 *
	 * @param string $title the notice title
	 */
	public function set_title( $title ) {

		$this->title = $title;
	}


	/**
	 * Gets the notice title.
	 *
	 * @since 1.1.0
	 *
	 * @return string
	 */
	public function get_title() {

		return $this->title;
	}


	/**
	 * Sets the notice content.
	 *
	 * @since 1.1.0
	 *
	 * @param string $content the notice content
	 */
	public function set_content( $content ) {

		$this->content = $content;
	}


	/**
	 * Gets the notice content.
	 *
	 * @since 1.1.0
	 *
	 * @return string
	 */
	public function get_content() {

		return $this->content;
	}


	/**
	 * Parses a set of actions.
	 *
	 * @since 1.1.0
	 *
	 * @param array $actions actions to parse
	 * @return array
	 */
	private function parse_actions( array $actions ) {

		return wp_parse_args( $actions, [
			'label'   => '',
			'name'    => '',
			'url'     => '',
			'primary' => false,
			'type'    => self::ACTION_TYPE_LINK,
		] );
	}


	/**
	 * Sets the notice actions.
	 *
	 * @since 1.1.0
	 *
	 * @param array $actions the notice actions
	 */
	public function set_actions( array $actions ) {

		$this->actions = $this->parse_actions( $actions );
	}


	/**
	 * Gets the notice actions.
	 *
	 * @since 1.1.0
	 *
	 * @return array
	 */
	public function get_actions() {

		return $this->parse_actions( $this->actions );
	}


	/**
	 * Outputs the notice.
	 *
	 * @since 1.1.0
	 */
	public function render() {

	}


	/**
	 * Outputs the notice content.
	 *
	 * @since 1.1.0
	 */
	private function render_content() {

	}


	/**
	 * Outputs the notice actions.
	 *
	 * @since 1.1.0
	 */
	private function render_actions() {

	}


}
