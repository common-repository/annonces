<?php
/**
 * Action of Label module.
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2018 Eoxia <dev@eoxia.com>
 * @license   AGPLv3 <https://spdx.org/licenses/AGPL-3.0-or-later.html>
 * @package   Annonces\label\Actions
 * @since     2.0.0
 */

namespace annonces;

defined( 'ABSPATH' ) || exit;

/**
 * Action of "Hello_World" module.
 */
class Label_Action extends \eoxia\Singleton_Util {

	/**
	 * Constructor
	 *
	 * @since 2.0.0
	 */
	protected function construct() {
		add_action( 'init', array( $this, 'label_generate_post_type' ) );
	}

	/**
	 * Register Announces post type
	 *
	 * @since 2.0.0
	 * @return void
	 */
	public function label_generate_post_type() {

		$labels = array(
			'name'          => _x( 'Labels', 'Post Type General Name', 'annonces' ),
			'singular_name' => _x( 'Label', 'Post Type Singular Name', 'annonces' ),
			'menu_name'     => __( 'Labels', 'annonces' ),
		);
		$args   = array(
			'label'               => __( 'Label', 'annonces' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => 'annonces-menu',
			'menu_position'       => 25,
			'menu_icon'           => 'dashicons-tag',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		register_post_type( 'label', $args );

	}

}

new Label_Action();
