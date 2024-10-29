<?php
/**
 * Single Announce view.
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2006-2018 Eoxia <dev@eoxia.com>
 * @license   AGPLv3 <https://spdx.org/licenses/AGPL-3.0-or-later.html>
 * @package   Annonces\view\Single
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
			<div class="wpeo-gridlayout grid-2">
				<figure class="annonce-thumbnail">
					<?php the_post_thumbnail(); ?>
				</figure>
				<div class="annonce-content">
					<h1 class="page-title"><?php the_title(); ?></h1>
					<?php the_content(); ?>

					<ul class="annonce-microdatas">
						<?php
						$email = get_field( 'email' );
						if ( ! empty( $email ) ) : ?>
							<li class="annonce-data"><i class="fas fa-envelope"></i> <strong><?php esc_html_e( 'Email', 'annonces' ); ?></strong> : <?php echo esc_html( $email ); ?></li> <?php
						endif; ?>

						<?php
						$telephone = get_field( 'telephone' );
						if ( ! empty( $telephone ) ) : ?>
						<li class="annonce-data"><i class="fas fa-mobile-alt"></i> <strong><?php esc_html_e( 'Phone number', 'annonces' ); ?></strong> : <?php echo esc_html( $telephone ); ?></li> <?php
						endif; ?>

						<?php
						$address = get_field( 'address' );
						if ( ! empty( $address ) ) : ?>
						<li class="annonce-data"><i class="fas fa-map-marker-alt"></i> <strong><?php esc_html_e( 'Address', 'annonces' ); ?></strong> : <?php echo esc_html( $address['address'] ); ?></li> <?php
						endif; ?>
					</ul>

					<?php
					$author_id        = get_the_author_meta( 'ID' );
					$author_name      = get_the_author_meta( 'display_name' );
					$author_permalink = get_author_posts_url( $author_id );
					$author_gravatar  = get_avatar( $author_id );
					?>
					<div class="annonce-author">
						<h2 class="author-title"><?php esc_html_e( 'Author', 'annonce' ); ?></h2>
						<a href="<?php echo esc_url( $author_permalink ); ?>">
							<?php echo $author_gravatar; ?>
							<?php echo esc_html( $author_name ); ?>
						</a>
					</div>

					<?php
					$labels = get_field( 'labels' );
					if ( ! empty( $labels ) && \eoxia\Config_Util::$init['annonces']->label->state ) : ?>
						<div class="annonce-label">
							<h2 class="label-title"><?php esc_html_e( 'Associated labels', 'annonces' ); ?></h2>
							<div class="label-list">
								<?php
								foreach ( $labels as $label ) :
									$thumbnail = get_the_post_thumbnail( $label->ID ); ?>

									<a href="<?php echo esc_url( get_permalink( $label->ID ) ); ?>">
										<?php
										if ( ! empty( $thumbnail ) ) :
											echo $thumbnail; // WPCS: XSS ok.
										else :
											echo esc_html( $label->post_title );
										endif;
										?>
									</a>
									<?php
								endforeach;
								?>
							</div>
						</div> <?php
					endif;
					?>
				</div>
			</div>

			<?php if ( ! empty( $address ) ) : ?>
				<div id="annonces-map-wrapper">
					<div id="annonces-google-map">
						<markers>
							<marker id="<?php the_ID(); ?>"
							lat="<?php echo esc_html( $address['lat'] ); ?>"
							lng="<?php echo esc_html( $address['lng'] ); ?>"></marker>
						</markers>
					</div>
				</div>
			<?php endif; ?>
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
