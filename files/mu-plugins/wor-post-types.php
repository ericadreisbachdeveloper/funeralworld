<?php


// Register new custom post types
add_action( 'init', 'wor_post_object' );

// Change dashboard Posts to Resources
function wor_post_object() {
    $get_post_type = get_post_type_object('post');
    $labels = $get_post_type->labels;
    $labels->name = 'Resources';
    $labels->singular_name = 'Resources';
    $labels->add_new = 'Add Resource';
    $labels->add_new_item = 'Add Resource';
    $labels->edit_item = 'Edit Resource';
    $labels->new_item = 'Resources';
    $labels->view_item = 'View Resources';
    $labels->search_items = 'Search Resources';
    $labels->not_found = 'No Resources found';
    $labels->not_found_in_trash = 'No Resources found in Trash';
    $labels->all_items = 'All Resources';
    $labels->menu_name = 'Resources';
    $labels->name_admin_bar = 'Resources';
}





add_action( 'init', 'wor_post_types_init' );

function wor_post_types_init() {

	$event_labels = array(
		'name'               => _x( 'Events', 'post type general name', 'aur' ),
		'singular_name'      => _x( 'Event', 'post type singular name', 'aur' ),
		'menu_name'          => _x( 'Events', 'admin menu', 'aur' ),
		'name_admin_bar'     => _x( 'Event', 'add new on admin bar', 'aur' ),
		'add_new'            => _x( 'Add New', 'industry', 'aur' ),
		'add_new_item'       => __( 'Add New Event', 'aur' ),
		'new_item'           => __( 'New Event', 'aur' ),
		'edit_item'          => __( 'Edit Event', 'aur' ),
		'view_item'          => __( 'View Event', 'aur' ),
		'all_items'          => __( 'All Events', 'aur' ),
		'search_items'       => __( 'Search Events', 'aur' ),
		'parent_item_colon'  => __( 'Parent Events:', 'aur' ),
		'not_found'          => __( 'No Events found.', 'aur' ),
		'not_found_in_trash' => __( 'No Events found in Trash.', 'aur' )
	);

	$event_args = array(
		'labels'             => $event_labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'event' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 10,
    'show_in_rest'       => true,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'revisions', 'page-attributes' )
	);

  register_post_type( 'events', $event_args );


  flush_rewrite_rules();

}







// Resources taxonomy
add_action( 'init', 'create_my_taxonomies', 0 );

function create_my_taxonomies() {

    // 1. Resource Type (Video, White Paper, &c.)
    register_taxonomy(

				// register_taxonomy( $taxonomy, $object_type, $args );
        'resource-type',
        'post',

        array(
            'labels' => array(
                'name' => 'Resource Types',
                'add_new_item' => 'Add New Resource Type',
                'new_item_name' => 'New Resource Type',
            ),
            //'rewrite' => array( 'slug' => 'events/category', 'with_front' => false ),

            'show_ui' => true,
						'show_tagcloud' => false,

            // hierarchical = true   -  checkboxes (like Wordpress default Categories)
            // hierarchical = false  -  type-in input (like Wordpress default Tags)
						'hierarchical' => true,
						'has_archive' => true,
						'ep_mask' => EP_PERMALINK,
						'show_admin_column' => true,

						// 'show_in_rest' enables Gutenberg blocks
						'show_in_rest'       => true,
        )
    );


    // 2. Topic (Green Funerals, &c.)
    register_taxonomy(

        // register_taxonomy( $taxonomy, $object_type, $args );
        'topic',
        'post',

        array(
            'labels' => array(
                'name' => 'Topic',
                'add_new_item' => 'Add New Topic',
                'new_item_name' => 'New Topic',
            ),
            //'rewrite' => array( 'slug' => 'events/category', 'with_front' => false ),

            'show_ui' => true,
            'show_tagcloud' => false,

            // hierarchical = true   -  checkboxes (like Wordpress default Categories)
            // hierarchical = false  -  type-in input (like Wordpress default Tags)
            'hierarchical' => true,
            'has_archive' => true,
            'ep_mask' => EP_PERMALINK,
            'show_admin_column' => true,

            // 'show_in_rest' enables Gutenberg blocks
            'show_in_rest'       => true,
        )
    );


    flush_rewrite_rules();

}
