<?php 
//namespace ThemescampPlugin\TemplateParts;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if ( ! class_exists( 'Themescamp_Search' ) ) {
class Themescamp_Search {

    function __construct() {
        //fallback to the default page template
        do_action( "themescamp_search_" );
    }
}
}

?>
