<?php
/**
 * Taxonomies viex of main view
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2018 Eoxia <dev@eoxia.com>
 * @license   AGPLv3 <https://spdx.org/licenses/AGPL-3.0-or-later.html>
 * @package   Annonces\annonce\Actions
 * @since     2.0.0
 */

namespace annonces;

defined( 'ABSPATH' ) || exit; ?>

<div class="annonces-taxonomies">

	<div class="taxonomies-entete">
		<?php echo esc_html( $taxonomies_datas->taxonomies_title ); ?>
	</div>

	<div class="taxonomies-container">
		<?php foreach ( $taxonomies_datas->taxonomies_parent as $parent ) : ?>
			<div class="annonces-taxonomy">
				<img src="<?php echo esc_url( $parent->marker ); ?>" />
				<span class="taxonomy-label active" data-id="<?php echo esc_attr( $parent->list_tax_id ); ?>"><?php echo esc_html( $parent->name ); ?></span>

				<div class="taxonomies-child">
					<?php foreach ( $parent->taxonomies_child as $child ) : ?>
						<span class="taxonomy-label active" data-id="<?php echo esc_attr( $child->term_id ); ?>"><?php echo esc_html( $child->name ); ?></span>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
