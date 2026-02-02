<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if ( ! class_exists( 'Themescamp_Sidebars' ) ) {
class Themescamp_Sidebars {

    function __construct() {
        
        $this->post();
    }

    function post() { 
        
        $style = themescamp_settings( 'tcg_sidebar_layout' );
        include('sidebar-'.$style.'.php');
    }
}
}
?>
