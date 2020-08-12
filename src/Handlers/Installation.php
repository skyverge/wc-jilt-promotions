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
 * The installation handler.
 *
 * @since 1.1.0
 */
class Installation {


	/** @var string the option name storing where Jilt was installed from */
	const OPTION_INSTALLED_FROM_PROMPT = 'sv_wc_jilt_installed_from_prompt';

	/** @var string the AJAX action hook name to install Jilt */
	const AJAX_ACTION_INSTALL_JILT = 'sv_wc_jilt_install_jilt';


}
