<?php
/**
 * Single Label view.
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2018 Eoxia <dev@eoxia.com>
 * @license   AGPLv3 <https://spdx.org/licenses/AGPL-3.0-or-later.html>
 * @package   Annonces\label\view\Single
 * @since     2.0.0
 */

namespace annonces;

defined( 'ABSPATH' ) || exit; ?>

<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			?>
			<div class="wpeo-gridlayout grid-4">
				<figure class="label-thumbnail">
					<?php the_post_thumbnail(); ?>
				</figure>
				<div class="label-content gridw-3">
					<h1 class="page-title"><?php the_title(); ?></h1>
					<?php the_content(); ?>

					<ul class="label-metadatas">
						<?php
						$metadatas = get_field( 'organisation' );

						if ( ! empty( $metadatas['website'] ) ) : ?>
							<li class="annonce-data"><i class="fas fa-globe"></i> <strong><?php esc_html_e( 'Website', 'annonces' ); ?></strong> :
								<a href="<?php echo esc_url( $metadatas['website'] ); ?>" target="_blank"><?php echo esc_html( $metadatas['website'] ); ?></a>
							</li> <?php
						endif;

						if ( ! empty( $metadatas['email'] ) ) : ?>
							<li class="annonce-data"><i class="fas fa-envelope"></i> <strong><?php esc_html_e( 'Email', 'annonces' ); ?></strong> : <?php echo esc_html( $metadatas['email'] ); ?></li> <?php
						endif;

						if ( ! empty( $metadatas['telephone'] ) ) : ?>
							<li class="annonce-data"><i class="fas fa-mobile-alt"></i> <strong><?php esc_html_e( 'Phone number', 'annonces' ); ?></strong> : <?php echo esc_html( $metadatas['telephone'] ); ?></li> <?php
						endif;

						if ( ! empty( $metadatas['address'] ) ) : ?>
						<li class="annonce-data"><i class="fas fa-map-marker-alt"></i> <strong><?php esc_html_e( 'Address', 'annonces' ); ?></strong> : <?php echo esc_html( $metadatas['address']['address'] ); ?></li> <?php
						endif; ?>

					</ul>

					<?php
					$labels = get_posts(array(
						'post_type'  => 'announce',
						'meta_query' => array(
							array(
								'key'     => 'labels',
								'value'   => '"' . get_the_ID() . '"',
								'compare' => 'LIKE',
							),
						),
					));

					if ( $labels ) : ?>
						<div class="associated-announces">
							<h2 class="associated-title"><?php esc_html_e( 'Associated announces', 'annonces' ); ?></h2>
							<div class="associated-container wpeo-gridlayout grid-2">
								<?php foreach ( $labels as $label ) :
									$label_image = get_the_post_thumbnail( $label->ID );

									$taxonomies = wp_get_post_terms( $label->ID, 'announce_taxonomy', array() );
									$tax        = '';
									if ( ! empty( $taxonomies ) ) :
										foreach ( $taxonomies as $element ) :
											$tax .= $element->name . ',';
										endforeach;
									endif;
									$tax = substr( $tax, 0, -1 );
									?>
									<div class="associated-content wpeo-gridlayout grid-3 grid-gap-0">
										<?php if ( ! empty( $label_image ) ) : ?>
											<figure><a href="<?php echo esc_url( get_permalink( $label->ID ) ); ?>"><?php echo $label_image; ?></a></figure>
										<?php endif; ?>
										<div class="associated-element-content gridw-2">
											<h3 class="element-title"><a href="<?php echo esc_url( get_permalink( $label->ID ) ); ?>"><?php echo esc_html( $label->post_title ); ?></a></h3>
											<div class="element-tax"><?php echo esc_html( $tax ); ?></div>
										</div>
									</div>
								<?php endforeach; ?>
							</div><!-- .associated-container -->
						</div><!-- .label-associated --> <?php
					endif;
					?>

				</div>
			</div>
			<?php

			/** Comments */
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
