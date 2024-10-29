<?php
/**
 * Action of Annonce module.
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2018 Eoxia <dev@eoxia.com>
 * @license   AGPLv3 <https://spdx.org/licenses/AGPL-3.0-or-later.html>
 * @package   Annonces\annonce\Actions
 * @since     2.0.0
 */

namespace annonces;

defined( 'ABSPATH' ) || exit;

/**
 * Action of "Hello_World" module.
 */
class Annonce_Action extends \eoxia\Singleton_Util {

	/**
	 * Constructor
	 *
	 * @since 2.0.0
	 */
	protected function construct() {
		add_action( 'admin_menu', array( $this, 'annonces_admin_menu' ) );
		add_action( 'admin_menu', array( $this, 'submenupage_annonces' ) );
		add_action( 'init', array( $this, 'annonces_generate_post_type' ) );
		add_action( 'init', array( $this, 'announce_taxonomy' ) );
		add_action( 'parent_file', array( $this, 'prefix_highlight_taxonomy_parent_menu' ) );
	}

	/**
	 * Adding a menu to contain the custom post types for Announce
	 *
	 * @since 2.0.0
	 * @return void
	 */
	public function annonces_admin_menu() {
		add_menu_page(
			__( 'Announces', 'annonces' ),
			__( 'Announces', 'annonces' ),
			'read',
			'annonces-menu',
			'',
			'dashicons-location',
			5
		);
	}

	/**
	 * Register Announces post type
	 *
	 * @since 2.0.0
	 * @return void
	 */
	public function annonces_generate_post_type() {

		$labels = array(
			'name'          => _x( 'Announces', 'Post Type General Name', 'annonces' ),
			'singular_name' => _x( 'Announce', 'Post Type Singular Name', 'annonces' ),
			'menu_name'     => __( 'Announces', 'annonces' ),
		);
		$args   = array(
			'label'               => __( 'Announce', 'annonces' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'author' ),
			'taxonomies'          => array( 'announce_taxonomy' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => 'annonces-menu',
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-location',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'rewrite'             => array(
				'slug' => get_option( 'permalink_annonce', 'announce' ),
			),
		);
		register_post_type( 'announce', $args );
		/** Regenerate permalinks */
		flush_rewrite_rules();
	}


	/**
	 * Adding a submenu to contain the custom taxonomies for Announce
	 *
	 * @since 2.0.0
	 * @return void
	 */
	public function submenupage_annonces() {
		add_submenu_page(
			'annonces-menu',
			esc_html__( 'Announce taxonomies', 'annonces' ),
			esc_html__( 'Announce taxonomies', 'annonces' ),
			'read',
			'edit-tags.php?taxonomy=announce_taxonomy'
		);
	}

	/**
	 * Register Announces taconomy
	 *
	 * @since 2.0.0
	 * @return void
	 */
	public function announce_taxonomy() {
		$labels = array(
			'name'          => _x( 'Announce taxonomies', 'Taxonomy General Name', 'annonces' ),
			'singular_name' => _x( 'Announce taxonomy', 'Taxonomy Singular Name', 'annonces' ),
			'menu_name'     => __( 'Announce taxonomy', 'annonces' ),
		);
		$args   = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_in_menu'      => 'annonces-menu',
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
		);
		register_taxonomy( 'announce_taxonomy', array( 'announce' ), $args );
	}

	/**
	 * Highlight the Announce Taxonomies submenupage
	 *
	 * @since 2.0.0
	 * @return $parent_file
	 */
	public function prefix_highlight_taxonomy_parent_menu( $parent_file ) {
		if ( 'announce_taxonomy' === get_current_screen()->taxonomy ) {
			$parent_file = 'annonces-menu';
		}
		return $parent_file;
	}
}

new Annonce_Action();
