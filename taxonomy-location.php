<?php get_header(); ?>

<section id="content">
	<div class="container">
		<div class="row">
			<div id="main" class="col-md-9">
				<?php
				//$term = get_query_var( 'term' );
				$term = get_term_by( 'slug', get_query_var( 'term' ), 'location' );
				$args = array(
						'hide_empty' => false,
						'child_of' => $term->term_id,
					);
				$child_terms = get_terms( 'location', $args );

				if ( empty( $child_terms ) ) { ?>
					<div class="image-box style2 activities no-bottom-border blog-infinite">
						<?php while ( have_posts()): the_post(); ?>
							<article class="box">
								<?php if ( '' != get_the_post_thumbnail() ) : ?>
									<figure>
										<a href="<?php the_permalink(); ?>" class="hover-effect"><?php echo get_the_post_thumbnail(); ?></a>
									</figure>
								<?php endif; ?>
								<div class="details entry-content">
									<div class="details-header">
										<h4 class="box-title"><?php the_title(); ?></h4>
									</div>
									<p><?php the_content( '...' ); ?></p>
									<a class="button pull-right" title="" href="<?php the_permalink(); ?>"><?php echo __( 'MORE', 'trav' ) ?></a>
								</div>
							</article>
						<?php endwhile; ?>
					</div>
					<?php
						global $trav_options;
						if ( ! empty( $trav_options['ajax_pagination'] ) ) {
							next_posts_link( __( 'LOAD MORE POSTS', 'trav' ) );
						} else {
							echo paginate_links( array( 'type' => 'list' ) );
						}
					?>
				<?php } elseif ( ! empty( $child_terms ) && ! is_wp_error( $child_terms ) ) { echo do_shortcode( '[locations parent="' . $term->term_id . '" column="5" image_size="thumbnail"]' ); } ?>
			</div>
			<div class="sidebar col-md-3">
				<?php dynamic_sidebar('sidebar-ttd'); ?>
			</div>
		</div>
	</div>
</section>

<?php get_footer();