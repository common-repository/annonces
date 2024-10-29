<?php
/**
 * Plugins required by module
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
 * Appelle la vue permettant d'afficher la navigation
 */
class Annonces_Util extends \eoxia\Singleton_Util {

	/**
	 * Le constructeur
	 *
	 * @since 2.0.0-alpha
	 * @version 2.0.0-alpha
	 */
	protected function construct() {}

	/**
	 * Donne le chemin de la vue à inclure dans le module
	 *
	 * @since 2.0.0
	 * @return void
	 */
	public function annonces_register_required_plugins() {
		/*
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(
			array(
				'name'     => 'Advanced Custom Fields',
				'slug'     => 'advanced-custom-fields',
				'required' => true,
			),
		);

		/*
		 * Array of configuration settings. Amend each line as needed.
		 *
		 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
		 * strings available, please help us make TGMPA even better by giving us access to these translations or by
		 * sending in a pull-request with .po file(s) with the translations.
		 *
		 * Only uncomment the strings in the config array if you want to customize the strings.
		 */
		$config = array(
			'id'           => 'annonces',          // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'parent_slug'  => 'plugins.php',            // Parent menu slug.
			'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
			'strings'      => array(
				'page_title'                      => __( 'Install Required Plugins', 'annonces' ),
				'menu_title'                      => __( 'Install Plugins', 'annonces' ),
				'installing'                      => __( 'Installing Plugin: %s', 'annonces' ), // %1$s = plugin name
				'oops'                            => __( 'Something went wrong with the plugin API.', 'annonces' ),
				'notice_can_install_required'     => _n_noop( 'This plugin requires the following plugin installed or update: %1$s.', 'This plugin requires the following plugins installed or updated: %1$s.', 'annonces' ), // %1$s = plugin name(s)
				'notice_can_install_recommended'  => _n_noop( 'This plugin recommends the following plugin installed or updated: %1$s.', 'This plugin recommends the following plugins installed or updated: %1$s.', 'annonces' ), // %1$s = plugin name(s)
				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'annonces' ), // %1$s = plugin name(s)
				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'annonces' ), // %1$s = plugin name(s)
				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'annonces' ), // %1$s = plugin name(s)
				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'annonces' ), // %1$s = plugin name(s)
				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this plugin: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this plugin: %1$s.', 'annonces' ), // %1$s = plugin name(s)
				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'annonces' ), // %1$s = plugin name(s)
				'install_link'                    => _n_noop( 'Go Install Plugin', 'Go Install Plugins', 'annonces' ),
				'activate_link'                   => _n_noop( 'Go Activate Plugin', 'Go Activate Plugins', 'annonces' ),
				'return'                          => __( 'Return to Required Plugins Installer', 'annonces' ),
				'plugin_activated'                => __( 'Plugin activated successfully.', 'annonces' ),
				'complete'                        => __( 'All plugins installed and activated successfully. %s', 'annonces' ), // %1$s = dashboard link
			),
		);

		tgmpa( $plugins, $config );
	}
}

Annonces_Util::g();
