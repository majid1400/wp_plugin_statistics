<?php
function wps_admin_menu()
{
    global $wpdb, $table_prefix;
    $today = date("Y-m-d");

    $totalStatistics = $wpdb->get_row("SELECT SUM(total_visits) as total_visits, 
                                               SUM(unique_visits) as total_unique_visits 
                                        FROM {$table_prefix}wps_visits");

    $todayStatistics = $wpdb->get_row("SELECT total_visits, unique_visits 
                                             FROM {$table_prefix}wps_visits
                                             WHERE date='{$today}' ");

    $yesterdayStatistics = $wpdb->get_row("SELECT total_visits, unique_visits 
                                             FROM {$table_prefix}wps_visits
                                             WHERE date >= DATE_SUB('{$today}', INTERVAL 1 DAY)");

    $monthStatistics = $wpdb->get_row("SELECT total_visits, unique_visits 
                                             FROM {$table_prefix}wps_visits
                                             WHERE date >= DATE_SUB('{$today}', INTERVAL DAYOFMONTH('{$today}')-1 DAY)");

    include WPS_TPL . 'admin_page_wps.php';
    wp_load_assets();
}

function wps_register_menu_page()
{
    add_menu_page(
        'آمار بازدید کنندگان',
        'آمار بازدید کنندگان',
        'manage_options',
        'wps-stat.php',
        'wps_admin_menu',
        'dashicons-chart-area',
        6);
}

add_action('admin_menu', 'wps_register_menu_page');

function wp_load_assets()
{
    wp_register_script('Chart.min.js', WPS_JS . 'Chart.min.js', array('jquery'));
    wp_enqueue_script('Chart.min.js');
}