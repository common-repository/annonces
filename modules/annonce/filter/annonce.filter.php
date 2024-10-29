<?php
/**
 * Action of Annonce module.
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2018 Eoxia <dev@eoxia.com>
 * @license   AGPLv3 <https://spdx.org/licenses/AGPL-3.0-or-later.html>
 * @package   Annonces\annonce\Filters
 * @since     2.0.0
 */

namespace annonces;

defined( 'ABSPATH' ) || exit;

/**
 * Action of "Hello_World" module.
 */
class Annonce_Filters {

	/**
	 * Constructor
	 *
	 * @since 2.0.0
	 * @version 2.0.0
	 */
	public function __construct() {
		add_filter( 'acf/settings/load_json', array( $this, 'annonces_annonce_json_load' ) );
		add_filter( 'single_template', array( $this, 'get_custom_post_type_template' ), 11 );
	}

	/**
	 * Add a json acf directory
	 *
	 * @since  2.0.0
	 * @param  Array $paths Acf folders.
	 * @return Array $paths Acf folders
	 */
	public function annonces_annonce_json_load( $paths ) {
		$paths[] = PLUGIN_ANNONCES_PATH . 'modules/annonce/asset/json';
		return $paths;
	}

	/**
	 * Get template for single post type
	 *
	 * @since  2.0.0
	 * @param  string $single_template Template path.
	 * @return string $single_template Template path.
	 */
	public function get_custom_post_type_template( $single_template ) {
		global $post;

		if ( 'announce' === $post->post_type ) {
			/** Get theme template if exist */
			$path_to_theme = locate_template( 'single-announce.php' );

			if ( ! empty( $path_to_theme ) ) {
				$single_template = $path_to_theme;
			} else {
				$single_template = str_replace( '\\', '/', PLUGIN_ANNONCES_PATH . '\modules\annonce\view\single-announce.php' );
			}
		}

		return $single_template;
	}

}

new Annonce_Filters();
