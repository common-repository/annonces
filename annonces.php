<?php
/**
 * Plugin Name: Annonces
 * Plugin URI:
 * Description: Add all type of announces you need to display in a large map.
 * Version: 2.1.1
 * Author: Eoxia <dev@eoxia.com>
 * Author URI: http://www.eoxia.com/
 * License: AGPL-3.0 or later
 * License URI: https://www.gnu.org/licenses/agpl-3.0.html
 * Text Domain: annonces
 * Domain Path: /language
 *
 * @package Annonces
 */

namespace annonces;

DEFINE( 'PLUGIN_ANNONCES_PATH', realpath( plugin_dir_path( __FILE__ ) ) . '/' );
DEFINE( 'PLUGIN_ANNONCES_URL', plugins_url( basename( __DIR__ ) ) . '/' );
DEFINE( 'PLUGIN_ANNONCES_DIR', basename( __DIR__ ) );

/**
 * Enable ACF 5 early access
 */
if ( ! defined( 'ACF_EARLY_ACCESS' ) ) {
	DEFINE( 'ACF_EARLY_ACCESS', '5' );
}

// Include EO_Framework.
require_once 'core/external/eo-framework/eo-framework.php';

/**
 * Regenerate permalinks
 *
 * @since 2.1.0
 * @return void
 */
function my_rewrite_flush() {
	Annonce_Action::g()->annonces_generate_post_type();
	Label_Action::g()->label_generate_post_type();

	flush_rewrite_rules();
}
register_activation_hook( __FILE__, '\annonces\my_rewrite_flush' );


// Boot your plugin.
\eoxia\Init_Util::g()->exec( PLUGIN_ANNONCES_PATH, basename( __FILE__, '.php' ) );
