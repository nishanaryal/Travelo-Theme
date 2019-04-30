<?php
/*
 * Functions for WooCommerce Integration
 */

if ( ! function_exists( 'trav_woo_init' ) ) {
	function trav_woo_init() {
		$trav_options = get_option('travelo');
		if ( ! empty( $trav_options['acc_pay_woocommerce'] ) ) {
			// create necessary product category terms
			$product_cats = array(
					'accommodation' => __('Accommodations', 'trav'),
					'tour' => __('Tours', 'trav'),
				);
			foreach ( $product_cats as $slug => $name ) {
				if ( ! term_exists( $slug , 'product_cat' ) ) {
					trav_woo_create_product_category( $slug, $name );
				}
			}

			add_action( 'trav_woo_add_acc_booking', 'trav_woo_add_acc_booking' );
			add_action( 'trav_woo_add_tour_booking', 'trav_woo_add_tour_booking' );
			$actions = array(	'woocommerce_order_status_pending_to_processing',
								'woocommerce_order_status_pending_to_completed',
								'woocommerce_order_status_pending_to_on-hold',
								'woocommerce_order_status_failed_to_processing',
								'woocommerce_order_status_failed_to_completed');
			foreach ( $actions as $action ) {
				add_action( $action, 'trav_woo_process_payment' ); // Add reservetions to Booking System after payment has been completed.
			}
			add_action( 'woocommerce_before_cart', 'trav_woo_before_cart' );
			add_action( 'woocommerce_after_cart', 'trav_woo_after_cart' );

			add_filter( 'trav_def_currency', 'trav_woo_get_def_currency' );
			add_filter( 'woocommerce_checkout_get_value', 'trav_woo_checkout_get_def_value', 20, 2 );
			add_filter( 'template_include', 'trav_woo_disable_template_access' );
			add_filter( 'post_type_link', 'trav_woo_update_product_link', 10, 4  );
			add_filter( 'woocommerce_return_to_shop_redirect', 'trav_woo_return_to_shop_redirect', 10, 4  );
		}
	}
}

/*
 * create woocommerce product category terms
 */
if ( ! function_exists( 'trav_woo_create_product_category' ) ) {
	function trav_woo_create_product_category( $term_slug, $term_name ) {
		wp_insert_term(
			$term_name,
			'product_cat', // the taxonomy
			array(
				// 'description'=> $term_description,
				'slug' => $term_slug,
			)
		);
	}
}

if ( ! function_exists( 'trav_woo_create_product' ) ) {
	function trav_woo_create_product( $product_data ) {

		$booking_product = array(
			'post_title' => $product_data['name'],
			'post_content' => $product_data['content'],
			'post_status' => 'publish',
			'post_type' => 'product',
			'comment_status' => 'closed'
		);
		$product_id = wp_insert_post($booking_product);

		$default_attributes = array();
		update_post_meta( $product_id, '_sku', $product_data['sku'] );
		update_post_meta( $product_id, '_stock_status', 'instock' );
		update_post_meta( $product_id, '_visibility', 'visible' );
		update_post_meta( $product_id, '_downloadable', 'no' );
		update_post_meta( $product_id, '_virtual', 'no' );
		update_post_meta( $product_id, '_featured', 'no' );
		update_post_meta( $product_id, '_sold_individually', 'yes' );
		update_post_meta( $product_id, '_default_attributes', $default_attributes );
		update_post_meta( $product_id, '_manage_stock', 'no' );
		update_post_meta( $product_id, '_backorders', 'no' );
		update_post_meta( $product_id, '_regular_price', $product_data['booking_price'] );
		update_post_meta( $product_id, '_price', $product_data['booking_price'] );
		update_post_meta( $product_id, '_trav_post_id', $product_data['post_id'] );

		wp_set_object_terms ($product_id, 'simple', 'product_type' );
		wp_set_object_terms ($product_id, $product_data['category_slug'], 'product_cat' );

		$product_attributes = array(
			'trav-booking-no'=> array(
				'name' => 'Travelo Booking Id',
				'value' => $product_data['booking_no'],
				'position' => '0',
				'is_visible' => '1',
				'is_variation' => '0',
				'is_taxonomy' => '0'
			),
			'trav-pin-code'=> array(
				'name' => 'Travelo Pin Code',
				'value' => $product_data['pin_code'],
				'position' => '0',
				'is_visible' => '1',
				'is_variation' => '0',
				'is_taxonomy' => '0'
			)
		);

		update_post_meta( $product_id, '_product_attributes', $product_attributes);
		return $product_id;
	}
}

if ( ! function_exists( 'trav_woo_product_add_to_cart' ) ) {
	function trav_woo_product_add_to_cart( $product_id ) {
		global $woocommerce;
		$cart = $woocommerce->cart->get_cart();
		$in_cart = false;
		// check if product already in cart
		if ( count( $cart ) > 0 ) {
			foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
				$_product = $values['data'];
				if ( $_product->id == $product_id )
					$in_cart = true;
			}
			if ( ! $in_cart ) {
				$woocommerce->cart->add_to_cart( $product_id );
			}
		} else {
			$woocommerce->cart->add_to_cart( $product_id );
		}
		$cart = $woocommerce->cart->get_cart();
	}
}

/*
 * Handle accommodation woocommerce booking payment
 */
if ( ! function_exists( 'trav_woo_add_acc_booking' ) ) {
	function trav_woo_add_acc_booking( $booking_data ) {
		$sku = 'acc' . $booking_data['booking_id'];
		$date_from = trav_tophptime( $booking_data['date_from'] );
		$date_to = trav_tophptime( $booking_data['date_to'] );
		$product_name = __( 'Deposit for ', 'trav' );
		$product_name .= get_the_title( $booking_data['accommodation_id'] ) . ' ' . get_the_title( $booking_data['room_type_id'] ) . ' ' . $booking_data['rooms'] . __( 'rooms', 'trav' ) . ' ' . $date_from . ' - ' . $date_to;
		$product_content = __( 'From', 'trav' ) . ' ' . $date_from . ' ' . __( 'To', 'trav' ) . ' ' . $date_to . ' ' . get_the_title( $booking_data['accommodation_id'] ) . ' ' . get_the_title( $booking_data['room_type_id'] ) . ' ' . $booking_data['rooms'] . __( 'rooms', 'trav' );
		$booking_no = $booking_data['booking_no'];
		$pin_code = $booking_data['pin_code'];
		$booking_price = $booking_data['deposit_price'];
		$product_category_slug = 'accommodation';

		$product_data = array(
				'sku' => $sku,
				'name' => $product_name,
				'content' => $product_content,
				'booking_no' => $booking_no,
				'pin_code' => $pin_code,
				'booking_price' => $booking_price,
				'category_slug' => $product_category_slug,
				'post_id' => $booking_data['accommodation_id'],
			);
		$product_id = trav_woo_create_product( $product_data );
		trav_woo_product_add_to_cart( $product_id );
	}
}

/*
 * Handle tour woocommerce booking payment
 */
if ( ! function_exists( 'trav_woo_add_tour_booking' ) ) {
	function trav_woo_add_tour_booking( $booking_data ) {
		$sku = 'tour' . $booking_data['booking_id'];
		$tour_date = trav_tophptime( $booking_data['tour_date'] );
		$product_name = __( 'Deposit for ', 'trav' );
		$product_name .= get_the_title( $booking_data['tour_id'] ) . ' ' . trav_tour_get_schedule_type_title( $booking_data['tour_id'], $booking_data['st_id'] ) . ' ' . $tour_date;
		$product_content = __( 'Tour Date', 'trav' ) . ' ' . $tour_date . ' ' . get_the_title( $booking_data['tour_id'] ) . ' ' . trav_tour_get_schedule_type_title( $booking_data['tour_id'], $booking_data['st_id'] );
		$booking_no = $booking_data['booking_no'];
		$pin_code = $booking_data['pin_code'];
		$booking_price = $booking_data['deposit_price'];
		$product_category_slug = 'tour';

		$product_data = array(
				'sku' => $sku,
				'name' => $product_name,
				'content' => $product_content,
				'booking_no' => $booking_no,
				'pin_code' => $pin_code,
				'booking_price' => $booking_price,
				'category_slug' => $product_category_slug,
				'post_id' => $booking_data['tour_id'],
			);
		$product_id = trav_woo_create_product( $product_data );
		trav_woo_product_add_to_cart( $product_id );
	}
}

/*
 * get woocommerce currency
 */
if ( ! function_exists( 'trav_woo_get_def_currency' ) ) {
	function trav_woo_get_def_currency() {
		return get_woocommerce_currency();
	}
}

/*
 * get woocommerce cart page url
 */
if ( ! function_exists( 'trav_woo_get_cart_page_url' ) ) {
	function trav_woo_get_cart_page_url() {
		$cart_page_url = false;
		if ( function_exists('wc_get_page_id') ) {
			$cart_page_id = wc_get_page_id( 'cart' );
			$cart_page_id = trav_post_clang_id( $cart_page_id );
			$cart_page_url = get_permalink($cart_page_id);
		}
		return $cart_page_url;
	}
}

/*
 * get checkout prefill value that user added in booking form.
 */
if ( ! function_exists( 'trav_woo_checkout_get_def_value' ) ) {
	function trav_woo_checkout_get_def_value( $value, $input ) {

		global $wpdb, $woocommerce;
		$billing_booking_fields = array( 
				'billing_first_name' => 'first_name',
				'billing_last_name' => 'last_name',
				'billing_address_1' => 'address',
				'billing_city' => 'city',
				'billing_phone' => 'phone',
				'billing_email' => 'email',
				'billing_postcode' => 'zip',
			);

		if ( array_key_exists( $input, $billing_booking_fields ) ) {
			$cart = $woocommerce->cart->get_cart();
			if ( count( $cart ) > 0) {
				$first_product = reset( $cart );
				$first_product_id = $first_product['product_id'];
				$first_product_data = $first_product['data'];
				$booking_data = array();

				$attributes = $first_product_data->get_attributes();
				if ( isset( $attributes['trav-booking-no'] ) && isset( $attributes['trav-pin-code'] ) ) {
					$booking_no = $attributes['trav-booking-no']['value'];
					$pin_code = $attributes['trav-pin-code']['value'];

					$term_tables = array(
							'accommodation' => TRAV_ACCOMMODATION_BOOKINGS_TABLE,
							'tour' => TRAV_TOUR_BOOKINGS_TABLE,
						);
					foreach ( $term_tables as $term_name => $booking_table_name ) {
						if ( has_term( $term_name, 'product_cat', $first_product_id ) ) {
							if ( $booking_data = $wpdb->get_row( 'SELECT * FROM ' . $booking_table_name . ' WHERE booking_no="' . esc_sql( $booking_no ) . '" AND pin_code="' . esc_sql( $pin_code ) . '"', ARRAY_A ) ) {
								break;
							}
						}
					}

					if ( ! empty( $booking_data ) && ! empty( $booking_data[$billing_booking_fields[$input]] ) ) {
						$value = $booking_data[$billing_booking_fields[$input]];
					}

				}
			}
		}

		return $value;
	}
}

/*
 * disable direct access to product page templates.
 */
if ( ! function_exists( 'trav_woo_disable_template_access' ) ) {
	function trav_woo_disable_template_access( $template ) {
		if ( ( is_single() && get_post_type() == 'product' ) // product detail page
				|| is_tax( 'product_cat' ) // product category archive page
				|| is_tax( 'product_tag' ) // product tag archive page
				|| is_post_type_archive( 'product' ) // product post type archive page
				|| ( function_exists( 'wc_get_page_id' ) && is_page( wc_get_page_id( 'shop' ) ) ) ) // shop page
		{
			return locate_template( '404.php' );
		}
		return $template;
	}
}

/*
 * after woocommerce payment perform remaining tasks such as sending email & update booking.
 */
if ( ! function_exists( 'trav_woo_process_payment' ) ) {
	function trav_woo_process_payment( $order_id ) {
		global $wpdb, $woocommerce;
		$order = new WC_Order( $order_id );
		$items = $order->get_items();
		$items_info = array();
		$term_tables = array(
					'accommodation' => TRAV_ACCOMMODATION_BOOKINGS_TABLE,
					'tour' => TRAV_TOUR_BOOKINGS_TABLE,
				);

		foreach ( $items as $item ) {
			$product_name = $item['name'];
			$product_id = $item['product_id'];
			$post_type = '';

			$_pf = new WC_Product_Factory();  
			$_product = $_pf->get_product($product_id);

			$attributes = $_product->get_attributes();
			if ( isset( $attributes['trav-booking-no'] ) && isset( $attributes['trav-pin-code'] ) ) {

				$booking_no = $attributes['trav-booking-no']['value'];
				$pin_code = $attributes['trav-pin-code']['value'];

				// check product_category of product ( post_type of property )
				foreach ( $term_tables as $term_name => $booking_table_name ) {
					if ( has_term( $term_name, 'product_cat', $product_id ) ) {
						$post_type = $term_name;
						break;
					}
				}

				if ( ! empty( $post_type ) ) {
					$new_data = array( 	'deposit_paid' => 1,
										'status' => 1,
										'woo_order_id' => $order_id );
					$update_status = $wpdb->update( $term_tables[ $post_type ], $new_data, array( 'booking_no' => $booking_no, 'pin_code' => $pin_code ) );
					if ( $update_status === false ) {
						do_action( 'trav_woo_update_booking_error', $booking_no, $pin_code );
					} elseif ( empty( $update_status ) ) {
						do_action( 'trav_woo_update_booking_no_row', $booking_no, $pin_code );
					} else {
						do_action( 'trav_woo_update_booking_success', $booking_no, $pin_code );
					}
					$items_info[] = array(
							'booking_no' => $booking_no,
							'pin_code' => $pin_code,
							'post_type' => $post_type,
						);
				}
			}
		}

		if ( ! empty( $items_info ) ) {
			do_action( 'trav_woo_payment_success', $items_info );
		}
	}
}

/*
 * disable generated product link and set it property link
 */
if ( ! function_exists( 'trav_woo_update_product_link' ) ) {
	function trav_woo_update_product_link( $post_link, $post ) {
		if ( $post->post_type === 'product' ) {
			$trav_post_id = get_post_meta( $post->ID, '_trav_post_id', true );
			if ( ! empty( $trav_post_id ) ) {
				$post_link = get_permalink( $trav_post_id );
			}
		}
		return $post_link;
	}
}

/*
 * woocommerce template before cart
 */
if ( ! function_exists( 'trav_woo_before_cart' ) ) {
	function trav_woo_before_cart() {
		echo '<div class="cart-wrapper">';
	}
}

/*
 * woocommerce template after cart
 */
if ( ! function_exists( 'trav_woo_after_cart' ) ) {
	function trav_woo_after_cart() {
		echo '</div>';
	}
}

/*
 * redirect to shop
 */
if ( ! function_exists( 'trav_woo_return_to_shop_redirect' ) ) {
	function trav_woo_return_to_shop_redirect() {
		return esc_url( home_url() );
	}
}

/*
 * update currency description in theme options panel
 */
if ( ! function_exists( 'trav_woo_options_def_currency_desc' ) ) {
	function trav_woo_options_def_currency_desc( $desc ) {
		$trav_options = get_option('travelo');
		if ( ! empty( $trav_options['acc_pay_woocommerce'] ) ) {
			$desc = 'You enabled woocommerce payment and so this field will be ignored. Please set default currency on <a href="' . admin_url( 'admin.php?page=wc-settings' ) . '">woocommerce settings panel</a>';
		}
		return $desc;
	}
}

/*
 * add woocommerce settings panel to theme options
 */
if ( ! function_exists( 'trav_woo_options_payment_addon_settings' ) ) {
	function trav_woo_options_payment_addon_settings( $options ) {
		$options[] = array(
				'title' => __('Enable Woocommerce Payment', 'trav'),
				'subtitle' => __('Enable payment by woocommerce plugin in booking.', 'trav'),
				'id' => 'acc_pay_woocommerce',
				'default' => false,
				'type' => 'switch');
		return $options;
	}
}

/*
 * check if woocommerce payment is enabled
 */
if ( ! function_exists( 'trav_woo_is_woo_enabled' ) ) {
	function trav_woo_is_woo_enabled() {
		$trav_options = get_option('travelo');

		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( ! empty( $trav_options['acc_pay_woocommerce'] ) && is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			return true;
		} else {
			return false;
		}
	}
}

/*
 * payment enabled status filter
 */
if ( ! function_exists( 'trav_woo_is_payment_enabled' ) ) {
	function trav_woo_is_payment_enabled( $status ) {
		return $status || trav_woo_is_woo_enabled();
	}
}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
	add_filter( 'trav_options_payment_addon_settings', 'trav_woo_options_payment_addon_settings' ); // add woo options panel to theme options
	add_filter( 'trav_is_payment_enabled', 'trav_woo_is_payment_enabled' ); // update payment_enabled 
	add_filter( 'trav_options_def_currency_desc', 'trav_woo_options_def_currency_desc' ); // update content in theme options panel

	add_action( 'init', 'trav_woo_init' );
	add_action( 'trav_woo_update_booking_success', 'trav_acc_send_confirmation_email', 10, 2);
	add_action( 'trav_woo_update_booking_success', 'trav_tour_send_confirmation_email', 10, 2);
}