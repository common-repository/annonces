<?php
/**
 * Action of Option Module.
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2018 Eoxia <dev@eoxia.com>
 * @license   AGPLv3 <https://spdx.org/licenses/AGPL-3.0-or-later.html>
 * @package   Annonces\option\Actions
 * @since     2.0.0
 */

namespace annonces;

defined( 'ABSPATH' ) || exit;

/**
 * Action of "Hello_World" module.
 */
class Option_Action {

	/**
	 * Constructor
	 *
	 * @since 2.0.0
	 * @version 2.0.0
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'callback_admin_menu' ) );
		add_action( 'wp_ajax_save_annonces_options', array( $this, 'callback_save_annonces_options' ) );
		add_action( 'admin_init', array( $this, 'add_permalink_setting' ) );
		add_action( 'load-options-permalink.php', array( $this, 'update_permalink_setting_value' ) );
	}


	/**
	 * Add submenu "Annonces" in WP Options.
	 *
	 * @since 2.0.0
	 */
	public function callback_admin_menu() {
		add_submenu_page( 'options-general.php', __( 'Announces', 'annonces' ), __( 'Announces', 'annonces' ), 'manage_options', 'announces-options', array( $this, 'callback_add_menu_page' ) );
	}

	/**
	 * Display view of the submenu "Announces Options".
	 *
	 * @since 2.0.0
	 * @version 2.0.0
	 */
	public function callback_add_menu_page() {
		$display_label_value = get_option( 'annonces_display_label', true );
		\eoxia\View_Util::exec( 'annonces', 'option', 'main', array( 'display_label_value' => $display_label_value ) );
	}

	/**
	 * Save google api key in wp options
	 *
	 * @since 2.0.0
	 * @return void
	 */
	public function callback_save_annonces_options() {
		check_ajax_referer( 'save_annonces_options' );
		$google_key    = ! empty( $_POST['annonces_google_key'] ) ? sanitize_text_field( $_POST['annonces_google_key'] ) : '';
		$display_label = ( isset( $_POST['display_label'] ) && $_POST['display_label'] == 'true' ) ? true : false;

		\eoxia\Module_Util::g()->set_state( 'annonces', 'label', $display_label );

		update_option( 'annonces_google_key', $google_key );
		update_option( 'annonces_display_label', $display_label );
		wp_send_json_success();
	}

	/**
	 * Save permalink option
	 *
	 * @since 2.0.0
	 * @return void
	 */
	public function add_permalink_setting() {
		add_settings_section(
			'permalink_session_annonce',
			__( 'Announces', 'annonces' ),
			null,
			'permalink'
		);

		add_settings_field(
			'permalink_annonce',
			__( 'Permalink Announce', 'annonces' ),
			array( $this, 'eg_setting_callback_function' ),
			'permalink',
			'permalink_session_annonce'
		);

		register_setting( 'permalink', 'permalink_annonce' );
	}

	/**
	 * Display permalink field view
	 *
	 * @since 2.0.0
	 * @return void
	 */
	public function eg_setting_callback_function() {
		\eoxia\View_Util::exec( 'annonces', 'option', 'permalink-field' );
	}

	/**
	 * Update manually permalink data
	 *
	 * @since 2.0.0
	 * @return void
	 */
	public function update_permalink_setting_value() {
		if ( isset( $_POST['permalink_annonce'] ) ) {
			$permalink_annonce = ! empty( $_POST['permalink_annonce'] ) ? sanitize_title( $_POST['permalink_annonce'] ) : '';
			update_option( 'permalink_annonce', $permalink_annonce );
		}
	}

}



new Option_Action();
