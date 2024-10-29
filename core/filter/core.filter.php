<?php
/**
 * Mains filters of module
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2018 Eoxia <dev@eoxia.com>
 * @license   AGPLv3 <https://spdx.org/licenses/AGPL-3.0-or-later.html>
 * @package   Annonces\Actions
 * @since     2.0.0
 */

namespace annonces;

defined( 'ABSPATH' ) || exit;

/**
 * Main actions of annonces
 */
class Core_Filter {

	/**
	 * Constructor
	 *
	 * @since 2.0.0
	 */
	public function __construct() {
		add_filter( 'acf/fields/google_map/api', array( $this, 'acf_filter_googlemap_api' ), 11 );
	}

	/**
	 * Change google map api key for ACF Map
	 *
	 * @since 2.0.0
	 *
	 * @param  string $api Google key.
	 *
	 * @return string $api Google key.
	 */
	public function acf_filter_googlemap_api( $api ) {
		$api_key    = get_option( 'annonces_google_key' );
		$api['key'] = ( ! empty( $api_key ) ) ? $api_key : '';
		return $api;
	}

}

new Core_Filter();
