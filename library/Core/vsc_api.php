<?php
/*
 * Dbo Library
 * Support some function to handle for database
 * Creator: LucTV 23/06/2018
 */
class vsc_api{
    
    function __construct(){
        
    }
    
    function get_array($obj, array $post_value, $method=URL_API_MAIN){
        $a_obj = explode('#', $obj);
        $url = $method.'?mod='.$a_obj[0].'&site='.$a_obj[1];
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        if(is_array($post_value)) curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($post_value));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $result = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($result, true);
        if(!is_array($result)) $result = array();
        return $result;
    }
    
    function get_str($obj, array $post_value, $method=URL_API_MAIN){
        $a_obj = explode('#', $obj);
        $url = $method.'?mod='.$a_obj[0].'&site='.$a_obj[1];
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        if(is_array($post_value)) curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($post_value));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }
    
    function check_debug($obj, array $post_value, $method=URL_API_MAIN){
        $a_obj = explode('#', $obj);
        $url = $method.'?mod='.$a_obj[0].'&site='.$a_obj[1];
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        if(is_array($post_value)) curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($post_value));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $result = curl_exec($curl);
        curl_close($curl);
        var_dump($result);
    }
    
}