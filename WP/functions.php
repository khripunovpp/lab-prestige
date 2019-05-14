<?php
add_theme_support('post-thumbnails');
add_theme_support( 'menus' );

add_action( 'wp_enqueue_scripts', 'my_scripts_method' );
function my_scripts_method(){
    wp_enqueue_style( 'style', get_stylesheet_uri(), array(), hash_file('crc32',  get_stylesheet_uri()));
    wp_enqueue_style( 'lightgallery', get_template_directory_uri() . '/css/lightgallery.min.css', array(), hash_file('crc32',  get_template_directory_uri() . '/css/lightgallery.min.css'));
	wp_enqueue_style( 'lightslider', get_template_directory_uri() . '/css/lightslider.min.css', array(), hash_file('crc32',  get_template_directory_uri() . '/css/lightslider.min.css'));
    wp_enqueue_script('lightgallery', get_template_directory_uri() . '/js/lightgallery.min.js', array(), '', true);
    wp_enqueue_script('lightslider', get_template_directory_uri() . '/js/lightslider.min.js', array(), '', true);
    wp_enqueue_script('common-main', get_template_directory_uri() . '/js/common.js', array(), hash_file('crc32', get_template_directory_uri() . '/js/common.js'), true);
    wp_enqueue_script('basket', get_template_directory_uri() . '/js/basket.js', array(), hash_file('crc32', get_template_directory_uri() . '/js/basket.js'), true);
	wp_deregister_script( 'jquery-core' );
	wp_register_script( 'jquery-core', '//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
	wp_enqueue_script( 'jquery' );
};

function get_the_user_ip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        //check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        //to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return apply_filters('wpb_get_ip', $ip);
}

//this creates the shortcode you can use in posts, pages and widgets
add_shortcode('show_user_ip', 'get_the_user_ip');


?>