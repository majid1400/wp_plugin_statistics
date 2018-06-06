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

    $visitChartData = $wpdb->get_results("SELECT `date`,total_visits,unique_visits 
                                                FROM {$table_prefix}wps_visits");

    $visitDate = [];
    $visittotal = [];
    $uniqvisit = [];
    foreach ($visitChartData as $item){
        $visitDate[] = $item->date;
        $visittotal[] = $item->total_visits;
        $uniqvisit[] = $item->unique_visits;
    }

    array_walk($visitDate,'convertToJalali');

    include WPS_TPL . 'admin_page_wps.php';
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
    wp_load_assets();
}

add_action('admin_menu', 'wps_register_menu_page');

function wp_load_assets()
{
    wp_register_script('Chart.min.js', WPS_JS . 'Chart.min.js', array('jquery'));
    wp_enqueue_script('Chart.min.js');
}

function convertToJalali(&$date){

    if (is_null($date) || empty($date)) {
        return $date;
    }
    
    $dateExplode = explode('-',$date);
    !function_exists('gregorian_to_jalali') ? include WPS_INC.'jdf.php' : null ;
    $convertToShamsi = gregorian_to_jalali($dateExplode[0],$dateExplode[1],$dateExplode[2]);
    $date = implode('-',$convertToShamsi);
}