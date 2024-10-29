<?php
/**
 * Functions available
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
 * Return true if acf exists
 *
 * @method is_acf
 */
function is_acf() {
	if ( class_exists( 'acf' ) ) :
		return true;
	endif;
}
