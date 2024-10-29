<?php
/**
 * Permalink field view in permalink option page.
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2018 Eoxia <dev@eoxia.com>
 * @license   AGPLv3 <https://spdx.org/licenses/AGPL-3.0-or-later.html>
 * @package   Annonces\option\View
 * @since     2.0.0
 */

namespace annonces;

defined( 'ABSPATH' ) || exit; ?>

<input type="text" name="permalink_annonce" id="permalink_annonce" value="<?php echo esc_attr( get_option( 'permalink_annonce', 'announce' ) ); ?>" class="code" />
