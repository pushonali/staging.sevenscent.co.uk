<?php
    define( 'TEMPPATH', get_bloginfo('stylesheet_directory'));
    define( 'IMAGES', TEMPPATH. "/images");
    
    function theme_styles(){
        wp_register_style('style', get_template_directory_uri() . '/style.css', array(), '1.0', 'all' );
        wp_register_style('css_reset', get_template_directory_uri() . '/reset.css', array(), '1.0', 'all' );
        
        wp_enqueue_style( 'css_reset' );
        wp_enqueue_style( 'style' );
    }
    
    add_action('wp_enqueue_scripts', 'theme_styles');
    
    
    add_theme_support('nav-menus');
    if(function_exists('register_nav_menus')){
        register_nav_menus(array(
            'main' => 'Mainmenu',
            'footernav' => 'Footernav'
        ));
    }
    
?>