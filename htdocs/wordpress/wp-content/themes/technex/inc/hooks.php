<?php

//Global Constants
define('TCG_THEME_VERSION', '1.0.2');
define('TCG_THEME_NAME', 'technex');
define('TCG_THEME_DEMO_URL', 'technex.themescamp.com'); // used in core
define('TCG_THEME_ID', '54090698');
define('TCG_FRAMEWORK_VERSION', '2.2.4');
define('TCG_ELEMENTS_VERSION', '2.2.4');
define('TCG_THEME_KEY',false);
define('DARK_LIGHT_SUPPORT', false);
define('TCG_THEME_DEMO_CLOUD',true);
define('TCG_THEME_DEMO_WITH_INNER',true); //#10
define('TCG_THEME_ELEMENTS',false); //#11
define('TCG_THEME_DEV_MOD',false);                      // used in core  

add_filter( 'tcg_required_plugins', 'tcgs_required_plugins' );
function tcgs_required_plugins( $plugins ) {

    global $framework_source_url, $elements_source_url;

    $framework_source_url = 'https://docs.themescamp.com/plugins/pro/element-camp-pro-'.TCG_FRAMEWORK_VERSION.'.zip';
    $elements_source_url = 'https://docs.themescamp.com/plugins/pro/element-camp-'.TCG_ELEMENTS_VERSION.'.zip';


    // Modify the plugins array as needed
    $plugins = array(
        // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'      => esc_html__( 'Elementor Page Builder', 'technex' ),
            'slug'      => 'elementor',
            'required'  => true,
        ),
        array(
            'name'               => esc_html__( 'MetForm', 'technex' ),
            'slug'               => 'metform',
            'required'           => true,
        ), 
        array(
            'name'               => esc_html__( 'ElementCamp', 'technex' ),
            'slug'               => 'element-camp',
            'source'             => $elements_source_url,
            'version'            => TCG_ELEMENTS_VERSION, // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice
            'required'           => true,
            'force_activation'   => false,// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false,// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
        ),
        array(
            'name'               => esc_html__( 'ElementCamp Pro', 'technex' ),
            'slug'               => 'element-camp-pro',
            'source'             => $framework_source_url, 
            'version'            => TCG_FRAMEWORK_VERSION, // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice
            'required'           => true,
            'force_activation'   => false,// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false,// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
        ),
    );

    return $plugins;
}


function modify_link($url, $text, $text_domain) {
    // Replace the old URL with the new one
    echo '<a href="' . esc_url($url) . '" target="_blank">' . esc_html__($text, $text_domain) . '</a>';
}

add_action('tcg_docs_link', function() {
    modify_link('https://fw.themescamp.com/docs-wp/', __('Start Reading', 'technex'), 'technex');
});

add_action('tcg_portfolio_link', function() {
    modify_link('https://www.themescamp.com/portfolios/', __('More Themes', 'technex'), 'technex');
});

add_action('tcg_help_link', function() {
    modify_link('https://themescamp.ticksy.com/', __('Contact us', 'technex'), 'technex');
}); 

// Define the custom filter function to replace the footer text
function tcg_footer_text_replace($text) {
    return '<p>' . esc_html__(sprintf( esc_html__( 'Copyright %s by ThemesCamp All Rights Reserved.', 'technex' ), date('Y') ), 'technex') . '</p>';
}
// Hook into the 'tcg_footer_text' filter
add_filter('tcg_footer_text', 'tcg_footer_text_replace');

?>
