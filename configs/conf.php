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

define("SESSION_LOGIN_ADMIN", lib_build_session_name("session_login_admin"));
define("SESSION_LOGIN_DEFAULT", lib_build_session_name("session_login_member"));
define("SESSION_LANGUAGE_ADMIN", lib_build_session_name("admin_language"));
define("SESSION_LANGUAGE_DEFAULT", lib_build_session_name("default_language"));
define("COOKIE_LOGIN_ID", "__CookieHodineId");
/* SET DEFAULT */
define('LAYOUT_DEFAULT', 'default.tpl');
define('LAYOUT_HOME', 'home.tpl');
define('LAYOUT_CUSTOM', 'custom.tpl');
define('LAYOUT_NONE', 'none.tpl');
define("NO_IMG", URL_UPLOAD . "generals/noimg.jpg");


function lib_build_session_name($name){
	$custom_domain = DOMAIN;
	$custom_domain = str_replace("/", "", $custom_domain);
	$custom_domain = str_replace(".", "", $custom_domain);
	$custom_domain = str_replace(":", "", $custom_domain);
	return strtolower($custom_domain) . "_" . $name;
}
?>
