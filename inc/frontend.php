<?php
/*
* wp_wps_user_visits * wp_wps_visits *
* -------------------*---------------*
* id                 * id            *
* ip                 * total_visits  * 
* date               * unique_visits * 
* -------------------* date          * 
*                    *---------------*  
*/

function wps_user_visit_callback(){

    global $wpdb,$table_prefix;

    $user_ip = ip2long($_SERVER['REMOTE_ADDR']);
    $date = date('Y-m-d H:i:s');

    # check submit from user visits ==> result: Null or id user
    $is_user_visit_site_today = $wpdb->get_var("SELECT id 
                                                FROM {$table_prefix}wps_user_visits
                                                WHERE ip         = {$user_ip} AND 
                                                      DATE(date) = DATE('{$date}') 
                                                LIMIT 1");
    # submit user in db wp_wps_user_visits                                          
    if (intval($is_user_visit_site_today)==0) {
        # add row in db
        $wpdb->insert($table_prefix.'wps_user_visits',array(
            'ip'    => $user_ip,
            'date'  => $date
        ),array(
            '%d',
            '%s'
        ));
    }

    # total_visits from wp_wps_visits
    $today_visit_exist = $wpdb->get_var("SELECT id
                                        FROM {$table_prefix}wps_visits
                                        WHERE date = DATE('{$date}')");
    
    if ($today_visit_exist) {
        # update
        $wpdb->query("UPDATE {$table_prefix}wps_visits 
                    SET total_visits = total_visits + 1 
                    WHERE id ={$today_visit_exist} ");
        if ($is_user_visit_site_today == 0) {
            $wpdb->query("UPDATE {$table_prefix}wps_visits 
            SET unique_visits = unique_visits + 1 
            WHERE id ={$today_visit_exist} ");
        }
    } else {
        # add
        $wpdb->insert($table_prefix.'wps_visits', array(
            'total_visits'  => 1,
            'unique_visits' => 1,
            'date'          => date('Y-m-d')
        ),array(
            '%d',
            '%d',
            '%s'
        ));

    }

    var_dump($today_visit_exist);
    var_dump($is_user_visit_site_today);
    var_dump($_SERVER['REMOTE_ADDR']);
    
}

add_action( 'wps_user_visit', 'wps_user_visit_callback' );