<?php

require_once 'vendor/autoload.php';
require_once(dirname(__FILE__) . '/classes/controllers/PA_ACF_Child-settings.class.php');
require_once(dirname(__FILE__) . '/classes/controllers/PA_ACF_Leaders.class.php');
require_once(dirname(__FILE__) . '/classes/controllers/PA_ACF_Site-ministries.class.php');
require_once(dirname(__FILE__) . '/classes/controllers/PA_CPT_Projects.class.php');
require_once(dirname(__FILE__) . '/classes/controllers/PA_CPT_Leaders.class.php');
require_once(dirname(__FILE__) . '/classes/controllers/PA_CPT_SliderHome.class.php');
require_once(dirname(__FILE__) . '/classes/controllers/PA_Enqueue_Files.class.php');
require_once(dirname(__FILE__) . '/classes/controllers/PA_Page_Lideres.php');
require_once(dirname(__FILE__) . '/classes/controllers/PA_CPT_District.class.php');
require_once(dirname(__FILE__) . '/classes/controllers/PA_Theme_Helpers.php');
require_once(dirname(__FILE__) . '/classes/PA_Theme_Handler.php');

add_action('after_setup_theme', function () {
    load_theme_textdomain('iasd', get_stylesheet_directory() . '/language/');

    add_theme_support('custom-logo');
}, 9);

add_filter('iasd_global_menu', function($menu, $name) {
    if($name != 'global-footer')
        return $menu;

    $menu = array_filter($menu, function($item) {
        return $item->name == 'Sobre Nós';
    });

    return $menu;
}, 10, 2);

/**
 * Add fallback post image
 */
add_action('customize_register', function($wp_customize) {
    $wp_customize->add_setting('footer_logo', [
        'capability' => 'edit_theme_options',
    ]);

    $wp_customize->add_control(new \WP_Customize_Media_Control(
        $wp_customize,
        'footer_logo',
        array(
            'label'       => 'Logo do footer Desktop',
            'description' => 'Imagem a ser exibida como logo no footer (Desktop)',
            'mime_type'   => 'image',
            'section'     => 'title_tagline',
            'settings'    => 'footer_logo',
        )
    ));
});


/**
 * Add Logo Footer Mobile
 */
add_action('customize_register', function($wp_customize) {
    $wp_customize->add_setting('footer_logo_mobile', [
        'capability' => 'edit_theme_options',
    ]);

    $wp_customize->add_control(new \WP_Customize_Media_Control(
        $wp_customize,
        'footer_logo_mobile',
        array(
            'label'       => 'Logo do footer Mobile',
            'description' => 'Imagem a ser exibida como logo no footer (Mobile)',
            'mime_type'   => 'image',
            'section'     => 'title_tagline',
            'settings'    => 'footer_logo_mobile',
        )
    ));
});