<?php get_header(); ?>

<section id="content">
	<div class="container">
		<div class="row">
			<div id="main" class="col-sm-8 col-md-9 entry-content">
				<div class="page">
					<div class="post-content">
						<div class="blog-infinite">
							<?php if ( have_posts() ) : ?>
								<?php while(have_posts()): the_post();
									trav_get_template( 'loop-blog.php', '/templates' );
								endwhile; ?>
							<?php endif; ?>
						</div>
						<?php
							global $ajax_paging;
							if ( ! empty( $ajax_paging ) ) {
								next_posts_link( __( 'LOAD MORE POSTS', 'trav' ) );
							} else {
								echo paginate_links( array( 'type' => 'list' ) );
							}
						?>
					</div>
				</div>
				<?php wp_link_pages('before=<div class="page-links">&after=</div>'); ?>
			</div>
			<div class="sidebar col-sm-4 col-md-3">
				<?php generated_dynamic_sidebar(); ?>
			</div>
		</div>
	</div>
</section>

<?php get_footer();