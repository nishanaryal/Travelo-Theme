<?php $user_id = get_current_user_id(); ?>
<h2><?php echo __( 'Your Wish List', 'trav' ); ?></h2>
<div class="row image-box listing-style2 add-clearfix">
	<?php
	global $acc_list, $before_article, $after_article, $current_view;
	$acc_list = get_user_meta( $user_id, 'wishlist', true );
	if ( ! empty( $acc_list ) ) {
		$current_view = 'block';
		$before_article = '<div class="col-sm-6 col-md-4">';
		$after_article = '</div>';
		trav_get_template( 'accommodation-list.php', '/templates/accommodation/');
	} else {
		echo __( 'Your wishlist is empty.', 'trav' );
	}
	?>
</div>