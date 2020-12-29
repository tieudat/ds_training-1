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
    
function lib_set_conn_to_conf($c_conn_content){
    $result = [];
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
        "database"   => "dbo_training",
    );
    $conn = lib_set_conn_to_conf($c_conn_main);
    return $conn;
}
?>
