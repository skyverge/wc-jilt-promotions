<?php

namespace SkyVerge\WooCommerce\Jilt_Promotions;

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
	 * Gets the package asserts URL.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public static function get_assets_url() {

		return untrailingslashit( plugins_url( '/assets', __FILE__ ) );
	}


}
