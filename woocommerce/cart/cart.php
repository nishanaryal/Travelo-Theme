<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<table class="shop_table cart" cellspacing="0">
	<thead>
		<tr>
			<th class="product-remove">&nbsp;</th>
			<th class="product-thumbnail">&nbsp;</th>
			<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
			<th class="product-order"><?php _e( 'Order Detail', 'woocommerce' ); ?></th>
			<th class="product-price"><?php _e( 'Price', 'woocommerce' ); ?></th>
			<th class="product-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
			<th class="product-subtotal"><?php _e( 'Total', 'woocommerce' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$attributes = $_product->get_attributes();
				$booking_data = array();
				if ( isset( $attributes['trav-booking-no'] ) && isset( $attributes['trav-pin-code'] ) ) {
					$booking_no = $attributes['trav-booking-no']['value'];
					$pin_code = $attributes['trav-pin-code']['value'];
					$property_type = '';
					if ( has_term( 'accommodation', 'product_cat', $product_id ) ) {
						$property_type = 'accommodation';
						$booking_data = trav_acc_get_booking_data( $booking_no, $pin_code );
					} elseif ( has_term( 'tour', 'product_cat', $product_id ) ) {
						$property_type = 'tour';
						$booking_data = trav_tour_get_booking_data( $booking_no, $pin_code );
					}
				}
				if ( ! empty( $booking_data ) ) {
				?>
					<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

						<td class="product-remove">
							<?php
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s">&times;</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ) ), $cart_item_key );
							?>
						</td>

						<td class="product-thumbnail">
							<?php if ( $property_type == 'accommodation' ) { ?>
								<a href="<?php echo get_permalink( $booking_data['accommodation_id'] ); ?>">
									<?php echo get_the_post_thumbnail( $booking_data['accommodation_id'], 'thumbnail' ); ?>
								</a>
							<?php } elseif ( $property_type == 'tour' ) { ?>
								<a href="<?php echo get_permalink( $booking_data['tour_id'] ); ?>">
									<?php echo get_the_post_thumbnail( $booking_data['tour_id'], 'thumbnail' ); ?>
								</a>
							<?php } ?>
						</td>

						<td class="product-name">
							<?php if ( $property_type == 'accommodation' ) { ?>
								<h5 class="product-title">
									<?php echo get_the_title( $booking_data['accommodation_id'] ); ?>
									<small><?php echo get_the_title( $booking_data['room_type_id'] ); ?></small>
									<?php // echo esc_html( trav_get_day_interval( $booking_data['date_from'], $booking_data['date_to'] ) . ' ' . __( 'Nights', 'trav' ) ); ?>
								</h5>
							<?php } elseif ( $property_type == 'tour' ) { ?>
								<h5 class="product-title">
									<?php echo get_the_title( $booking_data['tour_id'] ); ?>
									<small><?php echo esc_html( trav_tour_get_schedule_type_title( $booking_data['tour_id'], $booking_data['st_id'] ) ); ?></small>
								</h5>
							<?php }
								// Backorder notification
								if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
									echo '<p class="backorder_notification">' . __( 'Available on backorder', 'woocommerce' ) . '</p>';
							?>
						</td>

						<td class="product-order">
							<dl class="other-details">
								<?php
									if ( $property_type == 'accommodation' ) {
										$fields = array(
												'adults' => __( 'adults', 'trav'),
												'kids' => __( 'children', 'trav'),
												'rooms' => __( 'rooms', 'trav'),
												'date_from' => __( 'from', 'trav'),
												'date_to' => __( 'to', 'trav'),
											);
										foreach( $fields as $key => $value ) {
											if ( ! empty( $booking_data[ $key ] ) ) {
												echo '<dt class="feature">' . $value . ':</dt><dd class="value">' . esc_html( $booking_data[ $key ] ) . '</dd>';
											}
										}
									} elseif ( $property_type == 'tour' ) {
										$fields = array(
												'adults' => __( 'adults', 'trav'),
												'kids' => __( 'children', 'trav'),
												'tour_data' => __( 'tour data', 'trav'),
											);
										foreach( $fields as $key => $value ) {
											if ( ! empty( $booking_data[ $key ] ) ) {
												echo '<dt class="feature">' . $value . ':</dt><dd class="value">' . esc_html( $booking_data[ $key ] ) . '</dd>';
											}
										}
									}
								?>
							</dl>
						</td>

						<td class="product-price">
							<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							?>
						</td>


						<td class="product-quantity">
							<?php
								if ( $_product->is_sold_individually() ) {
									$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
								} else {
									$product_quantity = woocommerce_quantity_input( array(
										'input_name'  => "cart[{$cart_item_key}][qty]",
										'input_value' => $cart_item['quantity'],
										'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
										'min_value'   => '0'
									), $_product, false );
								}

								echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
							?>
						</td>

						<td class="product-subtotal">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
							?>
						</td>
					</tr>
				<?php
				}
			}
		}

		do_action( 'woocommerce_cart_contents' );
		?>
		<tr>
			<td colspan="7" class="actions">

				<?php if ( WC()->cart->coupons_enabled() ) { ?>
					<div class="coupon">

						<label for="coupon_code"><?php _e( 'Coupon', 'woocommerce' ); ?>:</label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php _e( 'Coupon code', 'woocommerce' ); ?>" /> <input type="submit" class="button" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'woocommerce' ); ?>" />

						<?php do_action( 'woocommerce_cart_coupon' ); ?>

					</div>
				<?php } ?>
				<button name="update_cart" class="icon-check" type="submit"><?php _e( 'Update Cart', 'woocommerce' ); ?></button>

				<?php do_action( 'woocommerce_cart_actions' ); ?>

				<?php wp_nonce_field( 'woocommerce-cart' ); ?>
			</td>
		</tr>

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</tbody>
</table>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>

<div class="cart-collaterals">
	<?php do_action( 'woocommerce_cart_collaterals' ); ?>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
