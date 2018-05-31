<?php
/*
Plugin Name: پلاگین آمار بازدید کنندگان
Plugin URI: http://www.tarminet.com
Description: در این پلاگین آماز بازدیدکنندگان را خواهید داشت
Version: 1.0.0
Author: majid
Author URI: http://www.tarminet.com
Text Domain: tarminet.com
Domain Path: /languages
*/
defined('ABSPATH') || exit('no access');

// defind constans for wps
define('WPS_DIR', trailingslashit( plugin_dir_path( __FILE__ )));
define('WPS_URL', trailingslashit( plugin_dir_url( __FILE__ )));
define('WPS_INC', trailingslashit( WPS_DIR.'inc'));
define('WPS_CSS', trailingslashit( WPS_URL.'assets/css'));
define('WPS_JS', trailingslashit( WPS_URL.'assets/js'));
define('WPS_IMAGES', trailingslashit( WPS_URL.'assets/images'));

// write activation && deactivation hook callback
function wps_activate(){}
function wps_deactivate(){}
register_activation_hook( __FILE__, 'wps_activate' );
register_deactivation_hook( __FILE__, 'wps_deactivate' );

if (is_admin(  )) {
    include WPS_INC."backend.php";
}else{
    include WPS_INC."frontend.php";
}
