<?php

// Call to libraries
lib_use(LIB_CORE_DBO);
lib_use(LIB_DBO_HELP);
lib_use(LIB_CORE_STRING);
lib_use(LIB_CORE_PAGINATION);
lib_use(LIB_CORE_IMAGE);


class Main {
    
    public $pdo, $str, $img, $api;
    public $help, $post, $tax, $media, $menu, $page, $product, $user;
    public $smarty, $_get, $arg;
    public $lang, $translate;
    public $option, $file_tax, $file_cont, $hcache, $cache_tax;
    
    function __construct() {
        global $mod, $site, $smarty, $login, $lang, $_get;
        
        $this->smarty = $smarty;
        $this->pdo = new vsc_pdo();
        $this->str = new vsc_string();
        $this->img = new vsc_image();
        $this->help = new DboHelp();
        $this->_get = $_get;

        $this->arg = array(
            'stylesheet' => DOMAIN . "site/main/webroot/",
            'timenow' => time(),
            'domain' => DOMAIN,
            'thislink' => THIS_LINK,
            'mod' => $mod,
            'site' => $site,
            'lang' => $lang,
            'login' => $login,
            'noimg' => NO_IMG,
            'img_gen' => URL_UPLOAD . "generals/",
            'url_img' => URL_UPLOAD . "images/",
            'end_countdown' => date("Y/m/d", strtotime('monday next week'))
        );
        
        $this->smarty->assign('arg', $this->arg);
        $this->smarty->assign('js_arg', json_encode($this->arg));
        $this->smarty->assign('content', "../" . $mod . "/" . $site . ".tpl");
    }
    
    function get_breadcrumb($taxonomy_id){
        $str = null;
        $str .= "<li class=\"breadcrumb-item\"><a href=\"./\">Trang chủ</a></li>";
        $str .= $this->get_menu_tree($taxonomy_id);
        $this->smarty->assign('breadcrumb', $str);
    }
    
    function isMobile() {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", @$_SERVER["HTTP_USER_AGENT"]);
    }
}