<?php
function wps_admin_menu(){
    echo '<h1>آمار بازدیدکنندگان</h1>';
}

function wps_register_menu_page(){
    add_menu_page( 
        'آمار بازدید کنندگان',
        'آمار بازدید کنندگان',
        'manage_options',
        'wps/wps-stat.php',
        'wps_admin_menu',
        'dashicons-chart-area', 
        6 );
}

add_action( 'admin_menu', 'wps_register_menu_page');