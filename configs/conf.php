<?php
# --------------------------------- #
# Config for website
# Get other config and parameter to site
# --------------------------------- #
require_once("router.php");
require_once("param.php");
require_once("conn.php");

$PHPSESSID = session_id();
$ext = ".html";


define("THIS_LINK", (isset($_SERVER['HTTPS'])?"https":"http")."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
define("URL_UPLOAD", DOMAIN . "site/upload/");
define("DIR_UPLOAD", "../upload/");
define("DIR_UPLOAD_S3", "upload/");

define("SESSION_LOGIN_ADMIN", lib_build_session_name("session_login_admin"));
define("SESSION_LOGIN_DEFAULT", lib_build_session_name("session_login_member"));
define("SESSION_PAGEID_MANAGER", lib_build_session_name("session_pageid_manager"));
define("SESSION_LOCATION_ID", lib_build_session_name("session_location_id"));
define("SESSION_LANGUAGE_ADMIN", lib_build_session_name("admin_language"));
define("SESSION_LANGUAGE_DEFAULT", lib_build_session_name("default_language"));
define("SESSION_PRODUCTCART", lib_build_session_name("session_hodine_product_cart"));
define("COOKIE_LOGIN_ID", "__CookieHodineId");
define("COOKIE_LOCATION_ID_MAIN","__CookieLocationIdMain");
define("COOKIE_LOCATION_URL_MAIN","__CookieLocationUrlMain");
/* SET DEFAULT */
define('LAYOUT_DEFAULT', 'default.tpl');
define('LAYOUT_DETAIL', 'detail.tpl');
define('LAYOUT_HOME', 'home.tpl');
define('LAYOUT_CUSTOM', 'custom.tpl');
define('LAYOUT_ACCOUNT', 'account.tpl');
define('LAYOUT_ABOUTUS','aboutus.tpl');
define('LAYOUT_NONE', 'none.tpl');
define("NO_IMG", URL_UPLOAD . "generals/noimg.jpg");
define("LOGIN_IMG_DEFAULT",URL_UPLOAD . "generals/login.png");


function lib_build_session_name($name){
	$custom_domain = DOMAIN;
	$custom_domain = str_replace("/", "", $custom_domain);
	$custom_domain = str_replace(".", "", $custom_domain);
	$custom_domain = str_replace(":", "", $custom_domain);
	return strtolower($custom_domain) . "_" . $name;
}
?>
