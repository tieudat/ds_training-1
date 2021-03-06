<?php
define("FILE_INFO_ROUTER", "../../constant/info/router.ini");

define('ROUTER_PRODUCT', 'product/');
define('ROUTER_PRODUCT_LIST', 'products/');
define('ROUTER_PRODUCT_CATEGORY', 'categories/');
define('ROUTER_EVENT', 'event/');
define('ROUTER_NATION', 'nations/');
define('ROUTER_POST', 'post/');
define('ROUTER_POST_LIST', 'posts/');
define('ROUTER_ALBUM', 'album/');
define('ROUTER_POST_TAG', 'tag/');

// add router api
$domain = "daisan.vn";
if(is_localhost()){
    $domain = "/ds_training/";
    define("DOMAIN", "http://" . $_SERVER['HTTP_HOST'] . $domain);
}else{
    define("DOMAIN", "http://".$domain."/");
}
define('ROUTER_SEARCH', 'product');

$router = array();
$router['login'] = array('mod'=>'account', 'site'=>'login');
$router['supplier'] = array('mod'=>'page', 'site'=>'index');
$router['quote'] = array('mod'=>'home', 'site'=>'quote');

function router_rewrire_url(){
	global $domain, $router;
	$exp_domain = explode($domain, $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	$url = @$exp_domain[1];
	unset($exp_domain);
	
	if(strpos($url, 'mod=') && strpos($url, 'site=')){
		$result = router_get_value_url($url);
	}else{
		$exurl = explode("?", $url);
		$url = @$exurl[0];
		unset($exurl);
		if(isset($router[$url])){
			$result = $router[$url];
		}elseif(strpos($url, '/')){
			$exurl = explode("/", $url);
			foreach ($router AS $k=>$item){
				$exk = explode("/", $k);
				if(count($exurl)==count($exk) && $exurl[0]==$exk[0]){
				    $result = $item;
				    if($exk[1]=='(:val)') $result['id'] = $exurl[1];
				    break;
				}elseif($exurl[1]==$exk[0]){
				    $result = $item;
				    if($exk[1]=='(:val)') $result['id'] = $exurl[2];
				    break;
				}
			}
		}elseif(preg_match("/[_a-z0-9-]+(\.[_a-z0-9-]+)*.html$/i", $url)){
			$key = str_replace(".html", "", $url);
			$result = router_get_value_url("?mod=product&site=detail&id=$key");
		}else{
			$result = router_get_value_url("?mod=home&site=index");
		}
	}
	
	return @$result;
}


function router_get_value_url($url){
	$url = str_replace('?', '', $url);
	$split_parameters = explode('&', $url);
	
	$split_complete = [];
	for($i = 0; $i < count($split_parameters); $i++) {
		$final_split = explode('=', $split_parameters[$i]);
		$split_complete[$final_split[0]] = @$final_split[1];
	}
	
	return $split_complete;
}
