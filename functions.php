<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10.01.2019
 * Time: 20:43
 */


require_once 'inc/cities.php';
require_once 'inc/estate.php';
require_once 'inc/fields.php';


/**
 * Переопределение функции родительской темы для замены пути к css
 */
function understrap_scripts() {
	// Get the theme data.
	$the_theme     = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );

	$css_version = $theme_version . '.' . filemtime( get_template_directory() . '/css/theme.min.css' );
	wp_enqueue_style( 'understrap-styles', get_template_directory_uri() . '/css/theme.min.css', array(), $css_version );

	wp_enqueue_script( 'jquery' );

	$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/theme.min.js' );
	wp_enqueue_script( 'understrap-scripts', get_template_directory_uri() . '/js/theme.min.js', array(), $js_version, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

    wp_enqueue_style( 'estate-understrap-styles', get_stylesheet_uri() );
}


add_action( 'after_setup_theme', function () {

    load_theme_textdomain( 'estate_understrap' );


    /*
     * размер миниатюр для типа estate
     */
    add_image_size( 'estate_thumbnail', 360, 240, true );
    add_image_size( 'estate_media_thumbnail', 240, 240, true );
});



/**
 * добавление класса form-control к полям ввода acf
 */
add_filter('acf/pre_render_fields', function ($fields) {
    if (is_admin()) return $fields;

    foreach( $fields as $key=>$field ) {
        $field['class'] = 'form-control';
        $fields[$key] = $field;
    }
    return $fields;
});


/**
 * вывод формы добавления недвижимости
 */
function the_acf_form() {
    $args = array(
        'post_id' => 'new_post',
        'post_content' => true,
        'thumbnail' => true,
        'return' => false,
        'field_el' => 'div',
        'instruction_placement' => 'label',
        'new_post' => array(
            'post_type' => ESTATE,
            'post_status' => 'publish',
        ),
        'uploader' 			 => 'wp',
        'post_title' => true,
        'submit_value' => 'Создать',
        'updated_message' => 'Ваша запись поставлена в очередь на модерацию',
        'label_placement' => 'top',
        'html_submit_button' => '<input type="submit" class="acf-button btn btn-primary btn-large" value="%s" />',
    );
    acf_form( $args );
}