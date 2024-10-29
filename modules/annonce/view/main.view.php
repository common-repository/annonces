<?php
/**
 * Main view of Annonce module.
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2018 Eoxia <dev@eoxia.com>
 * @license   AGPLv3 <https://spdx.org/licenses/AGPL-3.0-or-later.html>
 * @package   Annonces\annonce\Actions
 * @since     2.0.0
 */

namespace annonces;

defined( 'ABSPATH' ) || exit; ?>

<div id="annonces-map-wrapper">
	<div id="annonces-google-map">
		<markers>
			<?php \eoxia\View_Util::exec( 'annonces', 'annonce', 'main-markers', array( 'annonces_map_query' => $annonces_map_query ) ); ?>
		</markers>
	</div>
	<?php \eoxia\View_Util::exec( 'annonces', 'annonce', 'main-taxonomies', array( 'taxonomies_datas'   => $taxonomies_datas ) ); ?>
</div>
