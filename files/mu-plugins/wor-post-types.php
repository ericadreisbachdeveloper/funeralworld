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




// Event taxonomy
add_action( 'init', 'create_my_taxonomies', 0 );

function create_my_taxonomies() {
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
            // hierarchical = false  -  type-in input (like Wordpress defaul Tags)
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
