<?php

// Some pre defined value for easy use
if ( ! defined( 'TCEK_VER' ) ) { define('TCEK_VER', '5.2.0');}
if ( ! defined( 'TCEK_TPL_DB_VER' ) ) { define('TCEK_TPL_DB_VER', '1.0.0');}
if ( ! defined( 'TCEK__FILE__' ) ) { define('TCEK__FILE__', __FILE__);}
if ( ! defined( 'TCEK_TITLE' ) ) { define('TCEK_TITLE', 'Element Kit');}
if ( ! defined( 'TCEK_PNAME' ) ) { define('TCEK_PNAME', basename(dirname(TCEK__FILE__)));}
if ( ! defined( 'TCEK_PBNAME' ) ) { define('TCEK_PBNAME', plugin_basename(TCEK__FILE__));}
if ( ! defined( 'TCEK_PATH' ) ) { define('TCEK_PATH', plugin_dir_path(TCEK__FILE__));}
if ( ! defined( 'TCEK_URL' ) ) { define('TCEK_URL', plugins_url('/', TCEK__FILE__));}
if ( ! defined( 'TCEK_INC_PATH' ) ) { define('TCEK_INC_PATH', TCEK_PATH . 'includes/');}

if ( ! function_exists( 'tcg_Element_Kit_load_plugin' ) ) {
function tcg_Element_Kit_load_plugin() {
	require_once(TCEK_PATH . 'loader.php');
}
add_action('plugins_loaded', 'tcg_Element_Kit_load_plugin', 9);
}




