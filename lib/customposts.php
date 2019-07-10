<?php
// Register Custom Post Type
function jegaden_custom_post_types() {

	$labels = array(
		'name'                  => _x( 'Services', 'Post Type General Name', 'jegaden' ),
		'singular_name'         => _x( 'Service', 'Post Type Singular Name', 'jegaden' ),
		'menu_name'             => __( 'Services', 'jegaden' ),
		'name_admin_bar'        => __( 'Service', 'jegaden' ),
		'archives'              => __( 'Item Archives', 'jegaden' ),
		'attributes'            => __( 'Item Attributes', 'jegaden' ),
		'parent_item_colon'     => __( 'Parent Item:', 'jegaden' ),
		'all_items'             => __( 'All Services', 'jegaden' ),
		'add_new_item'          => __( 'Add New Service', 'jegaden' ),
		'add_new'               => __( 'Add New', 'jegaden' ),
		'new_item'              => __( 'New Item', 'jegaden' ),
		'edit_item'             => __( 'Edit Item', 'jegaden' ),
		'update_item'           => __( 'Update Item', 'jegaden' ),
		'view_item'             => __( 'View Item', 'jegaden' ),
		'view_items'            => __( 'View Items', 'jegaden' ),
		'search_items'          => __( 'Search Item', 'jegaden' ),
		'not_found'             => __( 'Not found', 'jegaden' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'jegaden' ),
		'featured_image'        => __( 'Featured Image', 'jegaden' ),
		'set_featured_image'    => __( 'Set featured image', 'jegaden' ),
		'remove_featured_image' => __( 'Remove featured image', 'jegaden' ),
		'use_featured_image'    => __( 'Use as featured image', 'jegaden' ),
		'insert_into_item'      => __( 'Insert into item', 'jegaden' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'jegaden' ),
		'items_list'            => __( 'Items list', 'jegaden' ),
		'items_list_navigation' => __( 'Items list navigation', 'jegaden' ),
		'filter_items_list'     => __( 'Filter items list', 'jegaden' ),
	);
	$args = array(
		'label'                 => __( 'Service', 'jegaden' ),
		'description'           => __( 'Custom post type for services', 'jegaden' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'taxonomies'            => array( 'servicecat' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
    register_post_type( 'service', $args );


    $labels = array(
		'name'                  => _x( 'Testimonials', 'Post Type General Name', 'jegaden' ),
		'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'jegaden' ),
		'menu_name'             => __( 'Testimonials', 'jegaden' ),
		'name_admin_bar'        => __( 'Testimonial', 'jegaden' ),
		'archives'              => __( 'Item Archives', 'jegaden' ),
		'attributes'            => __( 'Item Attributes', 'jegaden' ),
		'parent_item_colon'     => __( 'Parent Item:', 'jegaden' ),
		'all_items'             => __( 'All Testimonials', 'jegaden' ),
		'add_new_item'          => __( 'Add New Testimonial', 'jegaden' ),
		'add_new'               => __( 'Add New', 'jegaden' ),
		'new_item'              => __( 'New Item', 'jegaden' ),
		'edit_item'             => __( 'Edit Item', 'jegaden' ),
		'update_item'           => __( 'Update Item', 'jegaden' ),
		'view_item'             => __( 'View Item', 'jegaden' ),
		'view_items'            => __( 'View Items', 'jegaden' ),
		'search_items'          => __( 'Search Item', 'jegaden' ),
		'not_found'             => __( 'Not found', 'jegaden' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'jegaden' ),
		'featured_image'        => __( 'Featured Image', 'jegaden' ),
		'set_featured_image'    => __( 'Set featured image', 'jegaden' ),
		'remove_featured_image' => __( 'Remove featured image', 'jegaden' ),
		'use_featured_image'    => __( 'Use as featured image', 'jegaden' ),
		'insert_into_item'      => __( 'Insert into item', 'jegaden' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'jegaden' ),
		'items_list'            => __( 'Items list', 'jegaden' ),
		'items_list_navigation' => __( 'Items list navigation', 'jegaden' ),
		'filter_items_list'     => __( 'Filter items list', 'jegaden' ),
	);
	$args = array(
		'label'                 => __( 'Testimonial', 'jegaden' ),
		'description'           => __( 'Custom post type for Testimonials', 'jegaden' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'taxonomies'            => array( 'testimonialcat' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
    register_post_type( 'testimonial', $args );

    $labels = array(
		'name'                  => _x( 'Logos', 'Post Type General Name', 'jegaden' ),
		'singular_name'         => _x( 'Logo', 'Post Type Singular Name', 'jegaden' ),
		'menu_name'             => __( 'Logos', 'jegaden' ),
		'name_admin_bar'        => __( 'Logo', 'jegaden' ),
		'archives'              => __( 'Item Archives', 'jegaden' ),
		'attributes'            => __( 'Item Attributes', 'jegaden' ),
		'parent_item_colon'     => __( 'Parent Item:', 'jegaden' ),
		'all_items'             => __( 'All Logos', 'jegaden' ),
		'add_new_item'          => __( 'Add New Logo', 'jegaden' ),
		'add_new'               => __( 'Add New', 'jegaden' ),
		'new_item'              => __( 'New Item', 'jegaden' ),
		'edit_item'             => __( 'Edit Item', 'jegaden' ),
		'update_item'           => __( 'Update Item', 'jegaden' ),
		'view_item'             => __( 'View Item', 'jegaden' ),
		'view_items'            => __( 'View Items', 'jegaden' ),
		'search_items'          => __( 'Search Item', 'jegaden' ),
		'not_found'             => __( 'Not found', 'jegaden' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'jegaden' ),
		'featured_image'        => __( 'Featured Image', 'jegaden' ),
		'set_featured_image'    => __( 'Set featured image', 'jegaden' ),
		'remove_featured_image' => __( 'Remove featured image', 'jegaden' ),
		'use_featured_image'    => __( 'Use as featured image', 'jegaden' ),
		'insert_into_item'      => __( 'Insert into item', 'jegaden' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'jegaden' ),
		'items_list'            => __( 'Items list', 'jegaden' ),
		'items_list_navigation' => __( 'Items list navigation', 'jegaden' ),
		'filter_items_list'     => __( 'Filter items list', 'jegaden' ),
	);
	$args = array(
		'label'                 => __( 'Logo', 'jegaden' ),
		'description'           => __( 'Custom post type for Logos', 'jegaden' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail' ),
		'taxonomies'            => array(),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
    register_post_type( 'logo', $args );

    $labels = array(
		'name'                  => _x( 'Slides', 'Post Type General Name', 'jegaden' ),
		'singular_name'         => _x( 'Slide', 'Post Type Singular Name', 'jegaden' ),
		'menu_name'             => __( 'Slides', 'jegaden' ),
		'name_admin_bar'        => __( 'Slide', 'jegaden' ),
		'archives'              => __( 'Item Archives', 'jegaden' ),
		'attributes'            => __( 'Item Attributes', 'jegaden' ),
		'parent_item_colon'     => __( 'Parent Item:', 'jegaden' ),
		'all_items'             => __( 'All Slides', 'jegaden' ),
		'add_new_item'          => __( 'Add New Slide', 'jegaden' ),
		'add_new'               => __( 'Add New', 'jegaden' ),
		'new_item'              => __( 'New Item', 'jegaden' ),
		'edit_item'             => __( 'Edit Item', 'jegaden' ),
		'update_item'           => __( 'Update Item', 'jegaden' ),
		'view_item'             => __( 'View Item', 'jegaden' ),
		'view_items'            => __( 'View Items', 'jegaden' ),
		'search_items'          => __( 'Search Item', 'jegaden' ),
		'not_found'             => __( 'Not found', 'jegaden' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'jegaden' ),
		'featured_image'        => __( 'Featured Image', 'jegaden' ),
		'set_featured_image'    => __( 'Set featured image', 'jegaden' ),
		'remove_featured_image' => __( 'Remove featured image', 'jegaden' ),
		'use_featured_image'    => __( 'Use as featured image', 'jegaden' ),
		'insert_into_item'      => __( 'Insert into item', 'jegaden' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'jegaden' ),
		'items_list'            => __( 'Items list', 'jegaden' ),
		'items_list_navigation' => __( 'Items list navigation', 'jegaden' ),
		'filter_items_list'     => __( 'Filter items list', 'jegaden' ),
	);
	$args = array(
		'label'                 => __( 'Slide', 'jegaden' ),
		'description'           => __( 'Custom post type for Slides', 'jegaden' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail' ),
		'taxonomies'            => array(),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'slide', $args );


}
add_action( 'init', 'jegaden_custom_post_types', 0 );




// Register Custom Taxonomy
function jegaden_custom_taxes() {

    $labels = array(
        'name'                       => _x( 'Service Categories', 'Taxonomy General Name', 'jegaden' ),
        'singular_name'              => _x( 'Service Category', 'Taxonomy Singular Name', 'jegaden' ),
        'menu_name'                  => __( 'Service Categories', 'jegaden' ),
        'all_items'                  => __( 'All Items', 'jegaden' ),
        'parent_item'                => __( 'Parent Item', 'jegaden' ),
        'parent_item_colon'          => __( 'Parent Item:', 'jegaden' ),
        'new_item_name'              => __( 'New Item Name', 'jegaden' ),
        'add_new_item'               => __( 'Add New Item', 'jegaden' ),
        'edit_item'                  => __( 'Edit Item', 'jegaden' ),
        'update_item'                => __( 'Update Item', 'jegaden' ),
        'view_item'                  => __( 'View Item', 'jegaden' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'jegaden' ),
        'add_or_remove_items'        => __( 'Add or remove items', 'jegaden' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'jegaden' ),
        'popular_items'              => __( 'Popular Items', 'jegaden' ),
        'search_items'               => __( 'Search Items', 'jegaden' ),
        'not_found'                  => __( 'Not Found', 'jegaden' ),
        'no_terms'                   => __( 'No items', 'jegaden' ),
        'items_list'                 => __( 'Items list', 'jegaden' ),
        'items_list_navigation'      => __( 'Items list navigation', 'jegaden' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'servicecat', array( 'service' ), $args );

    $labels = array(
        'name'                       => _x( 'Testimonial Categories', 'Taxonomy General Name', 'jegaden' ),
        'singular_name'              => _x( 'Testimonial Category', 'Taxonomy Singular Name', 'jegaden' ),
        'menu_name'                  => __( 'Testimonial Categories', 'jegaden' ),
        'all_items'                  => __( 'All Items', 'jegaden' ),
        'parent_item'                => __( 'Parent Item', 'jegaden' ),
        'parent_item_colon'          => __( 'Parent Item:', 'jegaden' ),
        'new_item_name'              => __( 'New Item Name', 'jegaden' ),
        'add_new_item'               => __( 'Add New Item', 'jegaden' ),
        'edit_item'                  => __( 'Edit Item', 'jegaden' ),
        'update_item'                => __( 'Update Item', 'jegaden' ),
        'view_item'                  => __( 'View Item', 'jegaden' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'jegaden' ),
        'add_or_remove_items'        => __( 'Add or remove items', 'jegaden' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'jegaden' ),
        'popular_items'              => __( 'Popular Items', 'jegaden' ),
        'search_items'               => __( 'Search Items', 'jegaden' ),
        'not_found'                  => __( 'Not Found', 'jegaden' ),
        'no_terms'                   => __( 'No items', 'jegaden' ),
        'items_list'                 => __( 'Items list', 'jegaden' ),
        'items_list_navigation'      => __( 'Items list navigation', 'jegaden' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => false,
        'show_tagcloud'              => false
    );

    register_taxonomy( 'testimonialcat', array( 'testimonial' ), $args );



}
add_action( 'init', 'jegaden_custom_taxes', 0 );
