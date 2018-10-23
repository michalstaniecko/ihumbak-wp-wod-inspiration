<?php
/**
 *
 * Created by PhpStorm.
 * User: Michal Staniecko
 * Date: 29.09.18
 * Time: 14:37
 */


define('INC', get_stylesheet_directory().'/inc');
define('JS', get_stylesheet_directory_uri().'/js');
define('CSS', get_stylesheet_directory_uri().'/css');

add_filter('show_admin_bar', '__return_false');

add_action('wp_enqueue_scripts', 'wod_theme_scripts');

function wod_theme_scripts() {
	wp_deregister_script('jquery');
	wp_enqueue_style('style', get_stylesheet_directory_uri().'/style.css');
	wp_enqueue_style('main', CSS.'/main.css');
	wp_enqueue_script('vendors', JS.'/vendors.js', null,null);
	wp_enqueue_script('main', JS. '/main.js', array('vendors'),null, true);

}

include INC.'/render.class.php';
include INC.'/exercise.class.php';
include INC.'/wod.class.php';
include INC.'/shortcodes.php';
include INC.'/helper/forms.class.php';
