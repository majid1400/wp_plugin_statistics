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

    $where = " WHERE 1 ";
    if (isset($_GET['startDate']) and !empty($_GET['startDate'])
        and isset($_GET['endDate']) and !empty($_GET['endDate'])) {
        $startDate = convertTogregorian(esc_sql($_GET['startDate']));
        $endDate = convertTogregorian(esc_sql($_GET['endDate']));
        $where .= "AND Date between '{$startDate}' AND '{$endDate}'";
    }
    $visitChartData = $wpdb->get_results("SELECT `date`,total_visits,unique_visits 
                                                FROM {$table_prefix}wps_visits{$where}");

    $visitDate = [];
    $visittotal = [];
    $uniqvisit = [];
    foreach ($visitChartData as $item) {
        $visitDate[] = $item->date;
        $visittotal[] = $item->total_visits;
        $uniqvisit[] = $item->unique_visits;
    }

    array_walk($visitDate, 'convertToJalali');

    include WPS_TPL . 'admin_page_wps.php';
}
function wps_admin_menu_setting(){
    echo 'hello';
}
function wps_register_menu_page()
{
    add_menu_page(
        'آمار بازدید کنندگان',
        'آمار بازدید کنندگان',
        'manage_options',
        'wps-state.php',
        'wps_admin_menu',
        'dashicons-chart-area',
        6);

    add_submenu_page(
        'wps-state.php',
        'داشبورد',
        'داشبورد',
        'manage_options',
        'wps-state.php',
        'wps_admin_menu'
    );
    add_submenu_page(
        'wps-state.php',
        'تنظیمات',
        'تنظیمات',
        'manage_options',
        'wps-setting.php',
        'wps_admin_menu_setting'
    );

    wp_load_assets();
}

add_action('admin_menu', 'wps_register_menu_page');

function wp_load_assets()
{
    wp_register_script('Chart.min.js', WPS_JS . 'Chart.min.js', array('jquery'));
    wp_register_script('persian-date.min.js', WPS_JS . 'persian-date.min.js', array('jquery'));
    wp_register_script('persian-datepicker.min.js', WPS_JS . 'persian-datepicker.js', array('jquery', 'persian-date.min.js'));
    wp_register_script('wps.admin.js', WPS_JS . 'wps.admin.js', array('jquery', 'Chart.min.js', 'persian-date.min.js', 'persian-datepicker.min.js'));

    wp_enqueue_script('Chart.min.js');
    wp_enqueue_script('persian-date.min.js');
    wp_enqueue_script('persian-datepicker.min.js');
    wp_enqueue_script('wps.admin.js');

    wp_register_style('persian-datepicker.min.css', WPS_CSS . 'persian-datepicker.min.css');
    wp_enqueue_style('persian-datepicker.min.css');

}

function convertToJalali(&$date)
{

    if (is_null($date) || empty($date)) {
        return $date;
    }

    $dateExplode = explode('-', $date);
    !function_exists('gregorian_to_jalali') ? include WPS_INC . 'jdf.php' : null;
    $convertToShamsi = gregorian_to_jalali($dateExplode[0], $dateExplode[1], $dateExplode[2]);
    $date = implode('-', $convertToShamsi);
}

function convertTogregorian($data)
{
    $datePart = explode('-', $data);
    !function_exists('gregorian_to_jalali') ? include WPS_INC . 'jdf.php' : null;
    $newDate = jalali_to_gregorian($datePart[0], $datePart[1], $datePart[2]);
    return implode('-', $newDate);
}