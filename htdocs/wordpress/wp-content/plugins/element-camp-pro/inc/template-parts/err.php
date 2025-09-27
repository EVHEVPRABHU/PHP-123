<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if ( ! class_exists( 'Themescamp_Err' ) ) {
class Themescamp_Err {

    function __construct() {
        //fallback to the default page template
        do_action( "themescamp_404" );
    }
}
}

?>