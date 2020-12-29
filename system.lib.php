<?php
# ============================================ #
# Define libraries
# Build some function for system
# ============================================ #
define("FILE_CONF_DMKEY", "../../constant/conf/dkey.ini");
define("FILE_CONF_LANGUAGE", "../../constant/conf/language.ini");
define("FILE_INFO_SETTING", "../../constant/info/setting.ini");
define("FILE_INFO_METAS", "../../constant/info/metas.json");

define("FILE_LAYOUTS", "../../constant/info/layouts.ini");
define("FILE_CATEGORY_NUMBER", "../../constant/info/catenumber.ini");
define("FILE_KEYWORDS", "../../constant/info/keywords.json");
define("FILE_TAX", "../../constant/info/taxonomy.json");
define("FILE_CONT", "../../constant/info/contents.json");

define("DEFAULT_LANGUAGE", "vi");

#Get lib file to use
function lib_use($path){
	$convToArray = explode(":", $path);
	$dir = __DIR_LIB . "/" . implode("/", $convToArray) . ".php";
	require_once $dir;
}


#Get var_dump
function lib_dump($var, $label=null, $echo=true) {
	$label = ($label === null) ? '' : rtrim($label) . ' ';
	ob_start();
	var_dump($var);
	$output = ob_get_clean();
	$output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
	$output = htmlspecialchars($output, ENT_QUOTES);
	$output = '<pre>' . $label . $output . '</pre>';
	if ($echo) {
		echo($output);
	}
}

function lib_redirect($url=null){
	if($url==null || $url=='') $url = THIS_LINK;
	echo "<script> window.location = '".$url."' </script>";
	exit();
}

function lib_redirect_back(){
	echo "<script> history.go(-1); </script>";
	exit();
}

function lib_window_open($url){
	echo "<script> window.open('$url', '_blank'); </script>";
}

function lib_alert($title){
	echo "<script> alert('".$title."'); </script>";
}

function check_is_localhost(){
	if( in_array( $_SERVER['REMOTE_ADDR'], array( '127.0.0.1', '::1', '117.0.4.1' ) ) ) {
		return true;
	}
	return false;
}

function is_demo(){
	$a_domains = array('hodine.com', 'www.hodine.com', 'pages.hodine.com', 'www.pages.hodine.com');
	$run = isset($_GET['run']) ? intval($_GET['run']) : 0;
	if( in_array($_SERVER['HTTP_HOST'], $a_domains) && $run==0){
		return true;
	}
	return false;
}

function call_domain(){
	$rt = true;
	if(!check_is_localhost() && !is_demo()){
		if(file_exists(FILE_CONF_DMKEY)){
			$content = parse_ini_file(FILE_CONF_DMKEY);
			
			if(md5($content['domain'])!=$content['keyweb']){
				$rt = false;
			}elseif ($_SERVER['HTTP_HOST'] != $content['domain'] && $_SERVER['HTTP_HOST'] != "www.".$content['domain']){
				$rt = false;
			}
		}
		else  $rt = false;
		
	}
	if(!$rt) exit();
}


define("AC_USER", "superadmin");
$df_pass = $_SERVER['HTTP_HOST'];
$expass = explode(".", $df_pass);
if(count($expass)==1 || count($expass)==2) $acc_pass = $expass[0];
else $acc_pass = $expass[1];
define("AC_PASS", md5($acc_pass));
//call_domain();
$lib_dont_check_login = array(
		"install",
		"support",
		"setting"
);

function lib_arr_to_ini(array $a, array $parent = array()){
	$out = '';
	foreach ($a as $k => $v){
		if (is_array($v)){
			$sec = array_merge((array) $parent, (array) $k);
			$out .= '[' . join(' : ', $sec) . ']' . PHP_EOL;
			$out .= $this->arr2ini($v, $sec);
		}else{
			$out .= $k.'="'.$v.'"'.PHP_EOL;
		}
	}
	return $out;
}


function lib_copy_folder($src, $dst){
    $dir = opendir($src);
    @mkdir($dst);
    while (false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..')) {
            if (is_dir($src . '/' . $file)) {
                recurse_copy($src . '/' . $file, $dst . '/' . $file);
            } else {
                copy($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}



function is_localhost(){
	if($_SERVER['HTTP_HOST']==='localhost') return true;
	return false;
}
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", @$_SERVER["HTTP_USER_AGENT"]);
}