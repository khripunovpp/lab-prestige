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

function onwp_search_results_per_page_func($query) {
 // запрос на странице поиска
 if (!is_admin() && $query->is_main_query() && $query->is_search()) {
 $query->set('posts_per_page', 50);
 }
return $query;
 }
add_action('pre_get_posts', 'onwp_search_results_per_page_func');


class sideMenuWalker extends Walker_Nav_Menu {
  function start_el(&$output, $item, $depth, $args) {
    // назначаем классы li-элементу и выводим его
    $class_names = join( ' ', $item->classes );
    $class_names = ' menu__item ' .esc_attr( $class_names ). '"';
    $output.= '<li id="menu-item-' . $item->ID . '" class="' .$class_names. '"">';

    // назначаем атрибуты a-элементу
    $attributes.= !empty( $item->url ) ? ' href="' .esc_attr($item->url). '"' : '';
    $item_output = $args->before;

    // проверяем, на какой странице мы находимся
    $current_url = (is_ssl()?'https://':'http://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $item_url = esc_attr( $item->url );
    if (empty($item_url)) {
        $item_output.= '<span'. $attributes .'>'.$item->title.'</span>';
    } else {
        if ( $item_url != $current_url ) $item_output.= '<a'. $attributes .'>'.$item->title.'</a>';
        else $item_output.= '<span>'.$item->title.'</span>';
    }
    

    // заканчиваем вывод элемента
    $item_output.= $args->after;
    $output.= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }
}

//this creates the shortcode you can use in posts, pages and widgets
add_shortcode('show_user_ip', 'get_the_user_ip');


?>