<?php
// Register Custom Post Type
function sections_post_type() {

	$labels = array(
		'name'                  => 'Sections',
		'singular_name'         => 'Section',
		'menu_name'             => 'Sections',
		'name_admin_bar'        => 'Section',
		'archives'              => 'Section Archives',
		'attributes'            => 'Section Attributes',
		'parent_item_colon'     => 'Parent section:',
		'all_items'             => 'All sections',
		'add_new_item'          => 'Add New Section',
		'add_new'               => 'New Section',
		'new_item'              => 'New Section',
		'edit_item'             => 'Edit section',
		'update_item'           => 'Update section',
		'view_item'             => 'View section',
		'view_items'            => 'View sections',
		'search_items'          => 'Search sections',
		'not_found'             => 'No sections found',
		'not_found_in_trash'    => 'No sections found in Trash',
		'featured_image'        => 'Featured Image',
		'set_featured_image'    => 'Set featured image',
		'remove_featured_image' => 'Remove featured image',
		'use_featured_image'    => 'Use as featured image',
		'insert_into_item'      => 'Insert into section',
		'uploaded_to_this_item' => 'Uploaded to this section',
		'items_list'            => 'Section list',
		'items_list_navigation' => 'Section list navigation',
		'filter_items_list'     => 'Filter items list',
	);
	$args = array(
		'label'                 => 'Section',
		'description'           => 'Individual sections for the front page, re-orderable',
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'custom-fields' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 4,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'section', $args );
}

add_action('init', 'sections_post_type');