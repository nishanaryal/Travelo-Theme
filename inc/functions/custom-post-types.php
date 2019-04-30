<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
 * register accommodation post type
 */
if ( ! function_exists( 'trav_register_accommodation_post_type' ) ) {
	function trav_register_accommodation_post_type() {
		$labels = array(
			'name'                => _x( 'Accommodations', 'Post Type General Name', 'trav' ),
			'singular_name'       => _x( 'Accommodation', 'Post Type Singular Name', 'trav' ),
			'menu_name'           => __( 'Accommodations', 'trav' ),
			'all_items'           => __( 'All Accommodations', 'trav' ),
			'view_item'           => __( 'View Accommodation', 'trav' ),
			'add_new_item'        => __( 'Add New Accommodation', 'trav' ),
			'add_new'             => __( 'New Accommodation', 'trav' ),
			'edit_item'           => __( 'Edit Accommodations', 'trav' ),
			'update_item'         => __( 'Update Accommodations', 'trav' ),
			'search_items'        => __( 'Search Accommodations', 'trav' ),
			'not_found'           => __( 'No Accommodations found', 'trav' ),
			'not_found_in_trash'  => __( 'No Accommodations found in Trash', 'trav' ),
		);
		$args = array(
			'label'               => __( 'accommodation', 'trav' ),
			'description'         => __( 'Accommodation information pages', 'trav' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'author' ),
			'taxonomies'          => array( ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'accommodation',
			'map_meta_cap'        => true,
		);
		register_post_type( 'accommodation', $args );
	}
}

/*
 * register room post type
 */
if ( ! function_exists( 'trav_register_room_type_post_type' ) ) {
	function trav_register_room_type_post_type() {
		$labels = array(
			'name'                => _x( 'Room Types', 'Post Type Name', 'trav' ),
			'singular_name'       => _x( 'Room Type', 'Post Type Singular Name', 'trav' ),
			'menu_name'           => __( 'Room Types', 'trav' ),
			'all_items'           => __( 'All Room Types', 'trav' ),
			'view_item'           => __( 'View Room Type', 'trav' ),
			'add_new_item'        => __( 'Add New Room', 'trav' ),
			'add_new'             => __( 'New Room Types', 'trav' ),
			'edit_item'           => __( 'Edit Room Types', 'trav' ),
			'update_item'         => __( 'Update Room Types', 'trav' ),
			'search_items'        => __( 'Search Room Types', 'trav' ),
			'not_found'           => __( 'No Room Types found', 'trav' ),
			'not_found_in_trash'  => __( 'No Room Types found in Trash', 'trav' ),
		);
		$args = array(
			'label'               => __( 'room types', 'trav' ),
			'description'         => __( 'Room Type information pages', 'trav' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'author' ),
			'taxonomies'          => array( ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			//'show_in_menu'        => 'edit.php?post_type=accommodation',
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'accommodation',
			'map_meta_cap'        => true,
			'rewrite' => array('slug' => 'room-type', 'with_front' => true)
		);
		if ( current_user_can( 'manage_options' ) ) {
			$args['show_in_menu'] = 'edit.php?post_type=accommodation';
		}
		register_post_type( 'room_type', $args );
	}
}

/*
 * register things_to_do post type
 */
if ( ! function_exists( 'trav_register_things_to_do_post_type' ) ) {
	function trav_register_things_to_do_post_type() {
			
		$labels = array(
			'name'                => _x( 'Things To Do', 'Post Type Name', 'trav' ),
			'singular_name'       => _x( 'Things To Do', 'Post Type Singular Name', 'trav' ),
			'menu_name'           => __( 'Things To Do', 'trav' ),
			'all_items'           => __( 'All Things To Do', 'trav' ),
			'view_item'           => __( 'View Things To Do', 'trav' ),
			'add_new_item'        => __( 'Add New Things To Do', 'trav' ),
			'add_new'             => __( 'New Things To Do', 'trav' ),
			'edit_item'           => __( 'Edit Things To Do', 'trav' ),
			'update_item'         => __( 'Update Things To Do', 'trav' ),
			'search_items'        => __( 'Search Things To Do', 'trav' ),
			'not_found'           => __( 'No Things To Do found', 'trav' ),
			'not_found_in_trash'  => __( 'No Things To Do found in Trash', 'trav' ),
		);
		$args = array(
			'label'               => __( 'Things To Do', 'trav' ),
			'description'         => __( 'Things To Do page', 'trav' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'author' ),
			'taxonomies'          => array( ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'accommodation',
			'map_meta_cap'        => true,
			'rewrite' => array('slug' => 'things-to-do', 'with_front' => true)
		);
		register_post_type( 'things_to_do', $args );
	}
}

/*
 * register things_to_do post type
 */
if ( ! function_exists( 'trav_register_travel_guide_post_type' ) ) {
	function trav_register_travel_guide_post_type() {
			
		$labels = array(
			'name'                => _x( 'Travel Guide', 'Post Type Name', 'trav' ),
			'singular_name'       => _x( 'Travel Guide', 'Post Type Singular Name', 'trav' ),
			'menu_name'           => __( 'Travel Guide', 'trav' ),
			'all_items'           => __( 'All Travel Guide', 'trav' ),
			'view_item'           => __( 'View Travel Guide', 'trav' ),
			'add_new_item'        => __( 'Add New Travel Guide', 'trav' ),
			'add_new'             => __( 'New Travel Guide', 'trav' ),
			'edit_item'           => __( 'Edit Travel Guide', 'trav' ),
			'update_item'         => __( 'Update Travel Guide', 'trav' ),
			'search_items'        => __( 'Search Travel Guide', 'trav' ),
			'not_found'           => __( 'No Travel Guide found', 'trav' ),
			'not_found_in_trash'  => __( 'No Travel Guide found in Trash', 'trav' ),
		);
		$args = array(
			'label'               => __( 'Travel Guide', 'trav' ),
			'description'         => __( 'Travel Guide page', 'trav' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'author' ),
			'taxonomies'          => array( ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'accommodation',
			'map_meta_cap'        => true,
			'rewrite' => array('slug' => 'travel-guide', 'with_front' => true)
		);
		register_post_type( 'travel_guide', $args );
	}
}

/*
 * register accommodation type taxonomy
 */
if ( ! function_exists( 'trav_register_accommodation_type_taxonomy' ) ) {
	function trav_register_accommodation_type_taxonomy(){
		$labels = array(
				'name'              => _x( 'Accommodation Types', 'taxonomy general name', 'trav' ),
				'singular_name'     => _x( 'Accommodation Type', 'taxonomy singular name', 'trav' ),
				'menu_name'         => __( 'Accommodation Types', 'trav' ),
				'all_items'         => __( 'All Accommodation Types', 'trav' ),
				'parent_item'                => null,
				'parent_item_colon'          => null,
				'new_item_name'     => __( 'New Accommodation Type', 'trav' ),
				'add_new_item'      => __( 'Add New Accommodation Type', 'trav' ),
				'edit_item'         => __( 'Edit Accommodation Type', 'trav' ),
				'update_item'       => __( 'Update Accommodation Type', 'trav' ),
				'separate_items_with_commas' => __( 'Separate accommodation types with commas', 'trav' ),
				'search_items'      => __( 'Search Accommodation Types', 'trav' ),
				'add_or_remove_items'        => __( 'Add or remove accommodation types', 'trav' ),
				'choose_from_most_used'      => __( 'Choose from the most used accommodation types', 'trav' ),
				'not_found'                  => __( 'No accommodation types found.', 'trav' ),
			);
		$args = array(
				'labels'            => $labels,
				'hierarchical'      => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'meta_box_cb'       => false
			);
		register_taxonomy( 'accommodation_type', array( 'accommodation' ), $args );
	}
}

/*
 * register location taxonomy
 */
if ( ! function_exists( 'trav_register_location_taxonomy' ) ) {
	function trav_register_location_taxonomy(){
		$labels = array(
				'name'              => _x( 'Locations', 'taxonomy general name', 'trav' ),
				'singular_name'     => _x( 'Location', 'taxonomy singular name', 'trav' ),
				'menu_name'         => __( 'Locations', 'trav' ),
				'all_items'         => __( 'All Locations', 'trav' ),
				'parent_item'                => null,
				'parent_item_colon'          => null,
				'new_item_name'     => __( 'New Location', 'trav' ),
				'add_new_item'      => __( 'Add Location', 'trav' ),
				'edit_item'         => __( 'Edit Location', 'trav' ),
				'update_item'       => __( 'Update Location', 'trav' ),
				'separate_items_with_commas' => __( 'Separate locations with commas', 'trav' ),
				'search_items'      => __( 'Search Locations', 'trav' ),
				'add_or_remove_items'        => __( 'Add or remove locations', 'trav' ),
				'choose_from_most_used'      => __( 'Choose from the most used locations', 'trav' ),
				'not_found'                  => __( 'No locations found.', 'trav' ),
			);
		$args = array(
				'labels'            => $labels,
				'hierarchical'      => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'meta_box_cb'       => false
			);
		register_taxonomy( 'location', array( 'accommodation', 'things_to_do', 'tour' ), $args );
	}
}

/*
 * remove posts column on amenity list panel
 */
if ( ! function_exists( 'trav_tax_location_columns' ) ) {
	function trav_tax_location_columns($columns) {
		unset( $columns['posts'] );
		return $columns;
	}
}

/*
 * register amenity taxonomy
 */
if ( ! function_exists( 'trav_register_amenity_taxonomy' ) ) {
	function trav_register_amenity_taxonomy(){
		$labels = array(
				'name'              => _x( 'Amenities', 'taxonomy general name', 'trav' ),
				'singular_name'     => _x( 'Amenity', 'taxonomy singular name', 'trav' ),
				'menu_name'         => __( 'Amenities', 'trav' ),
				'all_items'         => __( 'All Amenities', 'trav' ),
				'parent_item'                => null,
				'parent_item_colon'          => null,
				'new_item_name'     => __( 'New Amenity', 'trav' ),
				'add_new_item'      => __( 'Add New Amenity', 'trav' ),
				'edit_item'         => __( 'Edit Amenity', 'trav' ),
				'update_item'       => __( 'Update Amenity', 'trav' ),
				'separate_items_with_commas' => __( 'Separate amenities with commas', 'trav' ),
				'search_items'      => __( 'Search Amenities', 'trav' ),
				'add_or_remove_items'        => __( 'Add or remove amenities', 'trav' ),
				'choose_from_most_used'      => __( 'Choose from the most used amenities', 'trav' ),
				'not_found'                  => __( 'No amenities found.', 'trav' ),
			);
		$args = array(
				'labels'            => $labels,
				'hierarchical'      => false,
				'show_ui'           => true,
				'show_admin_column' => true,
				'meta_box_cb'       => false
			);
		register_taxonomy( 'amenity', array( 'room_type', 'accommodation' ), $args );
	}
}

// Post Types for Tour
/*
 * register tour post type
 */
if ( ! function_exists( 'trav_register_tour_post_type' ) ) {
	function trav_register_tour_post_type() {
		$labels = array(
			'name'                => _x( 'Tours', 'Post Type General Name', 'trav' ),
			'singular_name'       => _x( 'Tour', 'Post Type Singular Name', 'trav' ),
			'menu_name'           => __( 'Tours', 'trav' ),
			'all_items'           => __( 'All Tours', 'trav' ),
			'view_item'           => __( 'View Tour', 'trav' ),
			'add_new_item'        => __( 'Add New Tour', 'trav' ),
			'add_new'             => __( 'New Tour', 'trav' ),
			'edit_item'           => __( 'Edit Tours', 'trav' ),
			'update_item'         => __( 'Update Tours', 'trav' ),
			'search_items'        => __( 'Search Tours', 'trav' ),
			'not_found'           => __( 'No Tours found', 'trav' ),
			'not_found_in_trash'  => __( 'No Tours found in Trash', 'trav' ),
		);
		$args = array(
			'label'               => __( 'tour', 'trav' ),
			'description'         => __( 'Tour information pages', 'trav' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'author' ),
			'taxonomies'          => array( ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'accommodation',
			'map_meta_cap'        => true,
		);
		register_post_type( 'tour', $args );
	}
}

/*
 * register tour type taxonomy
 */
if ( ! function_exists( 'trav_register_tour_type_taxonomy' ) ) {
	function trav_register_tour_type_taxonomy(){
		$labels = array(
				'name'              => _x( 'Tour Types', 'taxonomy general name', 'trav' ),
				'singular_name'     => _x( 'Tour Type', 'taxonomy singular name', 'trav' ),
				'menu_name'         => __( 'Tour Types', 'trav' ),
				'all_items'         => __( 'All Tour Types', 'trav' ),
				'parent_item'                => null,
				'parent_item_colon'          => null,
				'new_item_name'     => __( 'New Tour Type', 'trav' ),
				'add_new_item'      => __( 'Add New Tour Type', 'trav' ),
				'edit_item'         => __( 'Edit Tour Type', 'trav' ),
				'update_item'       => __( 'Update Tour Type', 'trav' ),
				'separate_items_with_commas' => __( 'Separate tour types with commas', 'trav' ),
				'search_items'      => __( 'Search Tour Types', 'trav' ),
				'add_or_remove_items'        => __( 'Add or remove tour types', 'trav' ),
				'choose_from_most_used'      => __( 'Choose from the most used tour types', 'trav' ),
				'not_found'                  => __( 'No tour types found.', 'trav' ),
			);
		$args = array(
				'labels'            => $labels,
				'hierarchical'      => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'meta_box_cb'       => false,
				'rewrite' => array('slug' => 'tour-type', 'with_front' => true)
			);
		register_taxonomy( 'tour_type', array( 'tour' ), $args );
	}
}


/*
 * init custom post_types
 */
if ( ! function_exists( 'trav_init_custom_post_types' ) ) {
	function trav_init_custom_post_types(){
		global $trav_options;
		if ( empty( $trav_options['disable_acc'] ) ) {
			trav_register_accommodation_post_type();
			trav_register_accommodation_type_taxonomy();
			trav_register_amenity_taxonomy();
			trav_register_room_type_post_type();
		}
		trav_register_location_taxonomy();
		trav_register_things_to_do_post_type();
		trav_register_travel_guide_post_type();

		if ( empty( $trav_options['disable_tour'] ) ) {
			trav_register_tour_post_type();
			trav_register_tour_type_taxonomy();
		}
	}
}

/*
 * hide Add Accommodation Submenu on sidebar
 */
if ( ! function_exists( 'trav_hd_add_accommodation_box' ) ) {
	function trav_hd_add_accommodation_box() {
		if ( current_user_can( 'manage_options' ) ) {
			global $submenu;
			unset($submenu['edit.php?post_type=accommodation'][10]);
		}
	}
}

/*
 * hide Add Accommodation Submenu on sidebar
 */
if ( ! function_exists( 'trav_user_capablilities' ) ) {
	function trav_user_capablilities() {
		$admin_role = get_role( 'administrator' );
		$adminCaps = array(
			'edit_accommodation',
			'read_accommodation',
			'delete_accommodation',
			'edit_accommodations',
			'edit_others_accommodations',
			'publish_accommodations',
			'read_private_accommodations',
			'delete_accommodations',
			'delete_private_accommodations',
			'delete_published_accommodations',
			'delete_others_accommodations',
			'delete_accommodation',
			'edit_private_accommodations',
			'edit_published_accommodations',
		);
		foreach ($adminCaps as $cap) {
			$admin_role->add_cap( $cap );
		}

		$role = get_role( 'trav_busowner' );
		$caps = array(
			'edit_accommodation',
			'read_accommodation',
			'delete_accommodation',
			'edit_accommodations',
			'read_private_accommodations',
			'delete_accommodations',
			'delete_private_accommodations',
			'delete_published_accommodations',
			'edit_private_accommodations',
			'edit_published_accommodations',
		);
		foreach ($caps as $cap) {
			$role->add_cap( $cap );
		}
	}
}

add_action( 'init', 'trav_init_custom_post_types', 0 );
add_action('admin_menu', 'trav_hd_add_accommodation_box');
add_action('admin_init', 'trav_user_capablilities');

add_filter("manage_edit-location_columns", 'trav_tax_location_columns'); 
?>