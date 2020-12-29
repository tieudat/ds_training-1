<?php
# --------------------------------- #
# Config connect to site
# Config database
# --------------------------------- #

/**
 * get database connect
 * @var unknown
 */

define("CONN_DEFAULT", db_get_connect());
//define("CONN_ADMIN", db_get_connect_admin());
    
function lib_set_conn_to_conf($c_conn_content){
    $result[] = $c_conn_content['server'];
    $result[] = $c_conn_content['username'];
    $result[] = $c_conn_content['password'];
    $result[] = $c_conn_content['database'];
    $result = implode(",", $result);
    return $result;
}

function db_get_connect(){
    $c_conn_main = array(
            "server"     => "localhost",
            "username"   => "root",
            "password"   => "",
            "database"   => "dbo_daisanvn",
        );
        $conn = lib_set_conn_to_conf($c_conn_main);
        return $conn;
}

// function db_get_connect(){
//     $c_conn_main = array(
//         "server"     => "103.63.215.51",
//         "username"   => "admin_daisanvn",
//         "password"   => "Xy5WhJWVjFv6",
//         "database"   => "admin_daisanvn",
//     );
//     $conn = lib_set_conn_to_conf($c_conn_main);
//     return $conn;
// }
// function db_get_connect_admin(){
//     $c_conn_main = array(
//         "server"     => "103.63.215.112",
//         "username"   => "admin_daisanvn",
//         "password"   => "Xy5WhJWVjFv6",
//         "database"   => "admin_daisanvn",
//     );
//     $conn = lib_set_conn_to_conf($c_conn_main);
//     return $conn;
// }
//define('TWEMCACHE_QUERY_EXPIRE', 300);
//$twemcache = memcache_connect("unix:///var/run/twemcache/twemcache.sock", 0, 1);
//$twemcache = false;

?>
