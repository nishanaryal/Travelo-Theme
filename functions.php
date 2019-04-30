<?php
if ( ! session_id() ) {
session_start();
}
//constants
define( 'TRAV_VERSION', '1.7.1' );
define( 'TRAV_DB_VERSION', '1.5' );
define( 'TRAV_TEMPLATE_DIRECTORY_URI', get_template_directory_uri() );
define( 'TRAV_INC_DIR', get_template_directory() . '/inc' );
define( 'TRAV_IMAGE_URL', TRAV_TEMPLATE_DIRECTORY_URI . '/images' );
define( 'TRAV_TAX_META_DIR_URL', TRAV_TEMPLATE_DIRECTORY_URI . '/inc/lib/tax-meta-class/' );
define( 'RWMB_URL', TRAV_TEMPLATE_DIRECTORY_URI . '/inc/lib/meta-box/' );

global $wpdb;
define( 'TRAV_ACCOMMODATION_VACANCIES_TABLE', $wpdb->prefix . 'trav_accommodation_vacancies' );
define( 'TRAV_ACCOMMODATION_BOOKINGS_TABLE', $wpdb->prefix . 'trav_accommodation_bookings' );
define( 'TRAV_CURRENCIES_TABLE', $wpdb->prefix . 'trav_currencies' );
define( 'TRAV_REVIEWS_TABLE', $wpdb->prefix . 'trav_reviews' );
define( 'TRAV_MODE', 'product' );
define( 'TRAV_TOUR_SCHEDULES_TABLE', $wpdb->prefix . 'trav_tour_schedule' );
define( 'TRAV_TOUR_BOOKINGS_TABLE', $wpdb->prefix . 'trav_tour_bookings' );
// define( 'TRAV_MODE', 'dev' );

// require file to woocommerce integration
require_once( TRAV_INC_DIR . '/functions/woocommerce/woocommerce.php' );

// get option
// $trav_options = get_option( 'travelo' );
if ( ! class_exists( 'ReduxFramework' ) ) {
    require_once( dirname( __FILE__ ) . '/inc/lib/redux-framework/ReduxCore/framework.php' );
}
if ( ! isset( $redux_demo ) ) {
    require_once( dirname( __FILE__ ) . '/inc/lib/redux-framework/config.php' );
}

//require files
require_once( TRAV_INC_DIR . '/functions/main.php' );
require_once( TRAV_INC_DIR . '/functions/js_composer/init.php' );
require_once( TRAV_INC_DIR . '/admin/main.php');
require_once( TRAV_INC_DIR . '/frontend/accommodation/main.php');
require_once( TRAV_INC_DIR . '/frontend/tour/main.php');

// Content Width
if (!isset( $content_width )) $content_width = 1000;

// Translation
load_theme_textdomain('trav', get_stylesheet_directory() . '/languages');

//theme supports
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'woocommerce' );
add_image_size( 'list-thumb', 230, 160, true );
add_image_size( 'gallery-thumb', 270, 160, true );
add_image_size( 'biggallery-thumb', 500, 300, true );
add_image_size( 'widget-thumb', 64, 64, true );