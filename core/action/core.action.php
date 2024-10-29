<?php
/**
 * Mains actions of module
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
class Core_Action {

	/**
	 * Constructor
	 *
	 * @since 2.0.0
	 * @version 2.0.0
	 */
	public function __construct() {
		// add_action( 'admin_enqueue_scripts', array( $this, 'callback_admin_enqueue_scripts' ), 11 );
		add_action( 'wp_enqueue_scripts', array( $this, 'callback_front_enqueue_scripts' ), 11 );
		add_action( 'tgmpa_register', array( Annonces_Util::g(), 'annonces_register_required_plugins' ), 11 );
		add_action( 'admin_notices', array( $this, 'acf_version_notice' ), 11 );

		add_action( 'init', array( $this, 'load_languages' ) );
	}

	/**
	 * Init style and script
	 *
	 * @since 2.0.0
	 * @version 2.0.0
	 *
	 * @return void nothing
	 */
	public function callback_admin_enqueue_scripts() {
	}

	/**
	 * Init style and script in frontend
	 *
	 * @since 2.0.0
	 * @version 2.0.0
	 *
	 * @return void nothing
	 */
	public function callback_front_enqueue_scripts() {
		wp_enqueue_style( 'annonces-frontend-style', PLUGIN_ANNONCES_URL . 'core/asset/css/style.css', array(), \eoxia\Config_Util::$init['annonces']->version );

		/** URl of module in javascipt */
		wp_register_script( 'annonces-frontend-script', PLUGIN_ANNONCES_URL . 'core/asset/js/backend.min.js', array(), \eoxia\Config_Util::$init['annonces']->version );
		wp_localize_script( 'annonces-frontend-script', 'annonces_data', array( 'url' => PLUGIN_ANNONCES_URL ) );
		wp_enqueue_script( 'annonces-frontend-script' );

		/** Aller chercher la clé entrée dans les options de configuration */
		$api_key = get_option( 'annonces_google_key' );
		wp_enqueue_script( 'annonces-google-map-api', 'https://maps.googleapis.com/maps/api/js?key=' . $api_key, array(), '', true );
	}

	/**
	 * Alert user to update ACF version
	 *
	 * @since 2.0.0
	 * @return void
	 */
	public function acf_version_notice() {
		if ( ! is_acf() ) return;
		if ( ! file_exists( PLUGIN_ANNONCES_PATH . '/../advanced-custom-fields/acf.php' ) ) return;

		$acf_datas = get_plugin_data( PLUGIN_ANNONCES_PATH . '/../advanced-custom-fields/acf.php' );
		if ( (int) substr( $acf_datas['Version'], 0, 1 ) < 5 ) {
			?>
			<div class="notice notice-error">
				<p><?php esc_html_e( 'Annonces plugin work with ACF version 5+. Please update !', 'annonces' ); ?></p>
			</div>
			<?php
		}
	}

	/**
	 * Initialise le fichier MO
	 *
	 * @since 0.1.0
	 * @version 0.1.0
	 */
	public function load_languages() {
		load_plugin_textdomain( 'annonces', false, PLUGIN_ANNONCES_DIR . '/core/asset/languages/' );
	}
}

new Core_Action();
