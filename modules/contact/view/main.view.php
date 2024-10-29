<?php
/**
 * Main view of Contact module.
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2018 Eoxia <dev@eoxia.com>
 * @license   AGPLv3 <https://spdx.org/licenses/AGPL-3.0-or-later.html>
 * @package   Annonces\contact\Actions
 * @since     2.0.0
 */

namespace annonces;

defined( 'ABSPATH' ) || exit; ?>

<?php if ( $announces ) : ?>

	<div class="associated-announces">
		<h2 class="associated-title"><?php esc_html_e( 'Associated announces', 'annonces' ); ?></h2>
		<div class="associated-container wpeo-gridlayout grid-2">
			<?php foreach ( $announces as $announce ) :
				$announce_image = get_the_post_thumbnail( $announce->ID );

				$taxonomies = wp_get_post_terms( $announce->ID, 'announce_taxonomy', array() );
				$tax        = '';
				if ( ! empty( $taxonomies ) ) :
					foreach ( $taxonomies as $element ) :
						$tax .= $element->name . ',';
					endforeach;
				endif;
				$tax = substr( $tax, 0, -1 );
				?>
				<div class="associated-content wpeo-gridlayout grid-3 grid-gap-0">
					<?php if ( ! empty( $announce_image ) ) : ?>
						<figure><a href="<?php echo esc_url( get_permalink( $announce->ID ) ); ?>"><?php echo $announce_image; ?></a></figure>
					<?php endif; ?>
					<div class="associated-element-content gridw-2">
						<h3 class="element-title"><a href="<?php echo esc_url( get_permalink( $announce->ID ) ); ?>"><?php echo esc_html( $announce->post_title ); ?></a></h3>
						<div class="element-tax"><?php echo esc_html( $tax ); ?></div>
					</div>
				</div>
			<?php endforeach; ?>
		</div><!-- .associated-container -->
	</div><!-- .label-associated -->

<?php endif; ?>
