<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10.01.2019
 * Time: 20:51
 */

define('CITIES', 'cities');

/**
 * регистрация типа поста "Города" - Cities
 */
add_action('init',  function()
{
	$labels = array(
		'name' => __('Cities', 'estate_understrap'),
		'singular_name' => __('Cities', 'estate_understrap'),
		'add_new' => __('Add Cities', 'estate_understrap'),
		'add_new_item' => __('Add New Cities', 'estate_understrap'),
		'edit_item' => __('Edit Cities', 'estate_understrap'),
		'new_item' => __('New Cities', 'estate_understrap'),
		'all_items' => __('All Cities', 'estate_understrap'),
		'view_item' => __('View Cities', 'estate_understrap'),
		'search_items' => __('Search Cities', 'estate_understrap'),
		'not_found' => __('Cities not found', 'estate_understrap'),
		'not_found_in_trash' => __('Cities Not found in trash', 'estate_understrap'),
		'menu_name' => __('Cities', 'estate_understrap')
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'has_archive' => true,
		'menu_position' => 5,
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
		),
	);
	register_post_type(CITIES, $args);
});