<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10.01.2019
 * Time: 20:46
 */

define('ESTATE', 'estate');
define('ESTATE_TYPE', 'estate_type');


/**
 * регистрация типа поста "Недвижемось" - estate
 */
add_action('init',  function()
{
	$labels = array(
		'name' => __('Estate', 'estate_understrap'),
		'singular_name' => __('Estate', 'estate_understrap'),
		'add_new' => __('Add Estate', 'estate_understrap'),
		'add_new_item' => __('Add New Estate', 'estate_understrap'),
		'edit_item' => __('Edit Estate', 'estate_understrap'),
		'new_item' => __('New Estate', 'estate_understrap'),
		'all_items' => __('All Estate', 'estate_understrap'),
		'view_item' => __('View Estate', 'estate_understrap'),
		'search_items' => __('Search Estate', 'estate_understrap'),
		'not_found' => __('Estate not found', 'estate_understrap'),
		'not_found_in_trash' => __('Estate Not found in trash', 'estate_understrap'),
		'menu_name' => __('Estate', 'estate_understrap')
	);

	$args = [
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'has_archive' => true,
		'menu_position' => 5,
		'taxonomies' => [ESTATE_TYPE],
		'capability_type' => 'post',
		'map_meta_cap' => true,
		'supports' => [
			'title',
			'editor',
			'custom-fields'
		],
	];
	register_post_type(ESTATE, $args);
});

/**
 * регистрация таксономии "тип недвижимости" - estate_type
 */
add_action('init', function()
{
	$labels = array(
		'name' => __('Estate types', 'estate_understrap'),
		'singular_name' => __('Estate types', 'estate_understrap'),
		'search_items' => __('Estate types', 'estate_understrap'),
		'all_items' => __('All Estate types', 'estate_understrap'),
		'parent_item' => __('Parent Estate types', 'estate_understrap'),
		'parent_item_colon' => __('Parent Estate types', 'estate_understrap'),
		'edit_item' => __('Edit Estate types', 'estate_understrap'),
		'update_item' => __('Update Estate types', 'estate_understrap'),
		'add_new_item' => __('Add Estate types', 'estate_understrap'),
		'new_item_name' => __('New Estate types', 'estate_understrap'),
		'menu_name' => __('Estate types', 'estate_understrap'),
	);


	$args = array(
		'hierarchical' => true,
		'public' => true,
		'show_ui' => true,
		'show_admin_column' => true,
		'_builtin' => true,
		'capabilities' => array(
			'manage_terms' => 'manage_categories',
			'edit_terms'   => 'edit_categories',
			'delete_terms' => 'delete_categories',
			'assign_terms' => 'assign_categories',
		),
		'label' => '',
		'labels' => $labels,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'update_count_callback' => '',
		'meta_box_cb' => false,
		'show_in_quick_edit' => null
	);

	register_taxonomy(ESTATE_TYPE, ESTATE, $args);
	//register_taxonomy_for_object_type( ESTATE_TYPE, ESTATE );
});


/**
 * установка длины цитаты для постов типа ESTATE
 */
add_filter('excerpt_length', function($length) {
    global $post;
    if ($post->post_type === ESTATE) {
        return 20;
    }
    return $length;
});