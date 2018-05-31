<?php
function wps_admin_menu()
{
    global $wpdb, $table_prefix;

    $statistics = $wpdb->get_row("SELECT SUM(total_visits) as total_visits, 
                                               SUM(unique_visits) as total_unique_visits 
                                        FROM {$table_prefix}wps_visits");

    include WPS_TPL . 'admin_page_wps.php';
}

function wps_register_menu_page()
{
    add_menu_page(
        'آمار بازدید کنندگان',
        'آمار بازدید کنندگان',
        'manage_options',
        'wps/wps-stat.php',
        'wps_admin_menu',
        'dashicons-chart-area',
        6);
}

add_action('admin_menu', 'wps_register_menu_page');