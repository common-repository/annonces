<?php
/**
 * Filters of Contact module.
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2018 Eoxia <dev@eoxia.com>
 * @license   AGPLv3 <https://spdx.org/licenses/AGPL-3.0-or-later.html>
 * @package   Annonces\contact\Filters
 * @since     2.0.0
 */

namespace annonces;

defined( 'ABSPATH' ) || exit;

/**
 * Action of "Hello_World" module.
 */
class Contact_Filters {

	/**
	 * Constructor
	 *
	 * @since 2.0.0
	 * @version 2.0.0
	 */
	public function __construct() {
		add_filter( 'acf/settings/load_json', array( $this, 'annonces_annonce_json_load' ) );
		// add_filter( 'the_content', array( $this, 'contact_view' ) );
		add_filter( 'pre_get_posts', array( $this, 'display_associated_announces' ) );
	}

	/**
	 * Add a json acf directory
	 *
	 * @since  2.0.0
	 * @param  Array $paths Acf folders.
	 * @return Array $paths Acf folders
	 */
	public function annonces_annonce_json_load( $paths ) {
		if ( \eoxia\Config_Util::$init['annonces']->label->state ) {
			$paths[] = PLUGIN_ANNONCES_PATH . 'modules/label/asset/json';
		}
		return $paths;
	}

	/**
	 * View of single post author
	 *
	 * @param  string $content Content of page.
	 * @return string $content Content of page.
	 */
	public function contact_view( $content ) {
		if ( is_author() ) :
			/* Get associated announces */
			$announces_query = new \WP_Query( array(
				'post_type' => 'announce',
				'author'    => get_the_ID(),
			) );

			/* Get render */
			ob_start();
				\eoxia\View_Util::exec( 'annonces', 'contact', 'main', array(
					'content'   => $content,
					'announces' => $announces_query->posts,
				) );

			$content .= ob_get_clean();
		endif;

		return $content;
	}

	/**
	 * Display associated announces
	 *
	 * @since  2.1.0
	 * @param  array $query Query datas.
	 * @return void
	 */
	public function display_associated_announces( $query ) {
		if ( $query->is_author && $query->is_main_query() ) {
			$query->set( 'post_type', array( 'post', 'announce' ) );
		}
	}

}

new Contact_Filters();
