<?php

// Call to libraries
lib_use(LIB_CORE_DBO);
lib_use(LIB_DBO_HELP);
lib_use(LIB_CORE_STRING);
lib_use(LIB_CORE_PAGINATION);
lib_use(LIB_CORE_IMAGE);
lib_use(LIB_CORE_API);
lib_use(LIB_DBO_USER);
lib_use(LIB_DBO_POST);
lib_use(LIB_DBO_PRODUCT);
lib_use(LIB_DBO_MENU);
lib_use(LIB_DBO_PAGE);
lib_use(LIB_DBO_TAXONOMY);
lib_use(LIB_DBO_MEDIA);
lib_use(LIB_HELP_FACEBOOK);


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
        $this->api = new vsc_api();
        $this->img = new vsc_image();
        $this->help = new DboHelp();
        $this->user = new DboUser();
        $this->post = new DboPosts();
        $this->product = new DboProduct();
        $this->menu = new DboMenu();
        $this->page = new DboPage();
        $this->tax = new DboTaxonomy();
        $this->media = new DboMedia();
        $this->_get = $_get;
        
        $this->hcache = isset($_COOKIE['HodineCache'])?json_decode($_COOKIE['HodineCache'], true):[];
        if($login!=0 && !isset($this->hcache['user'])){
            $user = $this->pdo->fetch_one("SELECT id,name,avatar,phone,email,isadmin FROM users WHERE id=$login");
            $user['avatar'] = $this->img->get_image($this->user->get_folder_img($login), $user['avatar']);
            $this->hcache['user'] = $user;
            setcookie('HodineCache', json_encode($this->hcache), time() + (86400 * 30 * 30), "/");
        }elseif($login==0 && @$this->hcache['user']['id']!=0){
            $_SESSION[SESSION_LOGIN_DEFAULT] = intval(@$this->hcache['user']['id']);
            $login = intval(@$this->hcache['user']['id']);
        }
//         lib_dump($this->hcache);

        $client_id = '356627533944-f84pull2l3ipfiied3vuluqi15udap0p.apps.googleusercontent.com';
        if(check_is_localhost()) $client_id = '356627533944-gei9tqhav75602dbqgnh0u5a06olq7cn.apps.googleusercontent.com';
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
            'loginimg' => LOGIN_IMG_DEFAULT,
            'url_sourcing' => URL_SOURCING,
            'url_helpcenter' => URL_HELPCENTER,
            'logo' => $this->media->get_images(1),
            'background' => $this->media->get_images(5),
            'json_keyword' => DOMAIN.'constant/info/keywords.json',
            'isadmin' => isset($this->hcache['user']['isadmin'])?$this->hcache['user']['isadmin']:0,
            'client_id' => $client_id,
            'end_countdown' => date("Y/m/d", strtotime('monday next week'))
        );
        
        $this->get_seo_metadata();
        $this->cache_tax = $this->get_afjson_file(FILE_TAX);
        if(!is_array($this->cache_tax)||count($this->cache_tax)==0) $this->cache_tax = $this->set_tax();
        $this->smarty->assign('tax', $this->cache_tax);
        
        $a_filter_type = array('Products','Suppliers','Quotes');
        $a_filter = array(
            'type' => $this->help->get_select_from_array($a_filter_type, isset($_GET['t'])?$_GET['t']:0),
            'key' => isset($_GET['k'])?$_GET['k']:'',
            't' => isset($_GET['t'])?intval($_GET['t']):0,
            't_txt' => 'Tất cả'
        );
        if($a_filter['t']!=0){
            foreach ($this->cache_tax['category'] AS $v){
                if($v['id']==$a_filter['t']) $a_filter['t_txt'] = $v['name'];
            }
        }
//         lib_dump($a_filter);
        
        
        $this->smarty->assign('a_main_category', $this->cache_tax['category']);
        $this->smarty->assign('hcache', $this->hcache);
        $this->smarty->assign('arg', $this->arg);
        $this->smarty->assign('js_arg', json_encode($this->arg));
        $this->smarty->assign('main_filter', $a_filter);
        $this->smarty->assign('a_menu_top', $this->cache_tax['menu_top']);
        $this->smarty->assign('a_menu_main', $this->cache_tax['menu_main']);
        $this->smarty->assign('a_menu_foot', $this->cache_tax['menu_foot']);
        $this->smarty->assign('is_mobile',isMobile());
        $this->smarty->assign('content', "../" . $mod . "/" . $site . ".tpl");
        
        $btn_fb_login = null;
        if($login===0){
            $fb = new Facebook\Facebook([
                'app_id' => '1152764341547099',
                'app_secret' => 'e03a834010b7270a134ed8a888077266',
                'default_graph_version' => 'v3.1',
            ]);
            $helper = $fb->getRedirectLoginHelper();
            $permissions = ['email']; // Optional permissions
            $loginUrl = $helper->getLoginUrl('https://daisan.vn/?mod=home&site=get_login_result', $permissions);
            $btn_fb_login = $loginUrl;
        }
        $this->smarty->assign('btn_fb_login', $btn_fb_login);
    }
    
    
    function set_tax(){
        $db = json_decode(@file_get_contents(FILE_TAX), true);
        if(!is_array($db)) $db = [];
        $db['category'] = $this->tax->get_taxonomy('product', 0, null, null, 1);
        $db['menu_top'] = $this->menu->get_menu_arr('top');
        $db['menu_main'] = $this->menu->get_menu_arr('main');
        $db['menu_foot'] = $this->menu->get_menu_arr('foot');
        $db['province'] = $this->pdo->fetch_all("SELECT Id,Name,Prefix FROM locations a WHERE Status=1 AND Parent=0 ORDER BY Featured DESC,Sort DESC,Name");
        file_put_contents(FILE_TAX, json_encode($db));
        return $db;
    }
    

    function set_cont_home(){
        $db = json_decode(@file_get_contents(FILE_CONT), true);
        if(!is_array($db)) $db = [];
        
        $a_home_category = $this->tax->get_taxonomy('product', 0, 'a.featured=1', 3);
        foreach ($a_home_category as $k => $item) {
            $a_home_category[$k]['sub'] = $this->tax->get_taxonomy('product', $item['id'], null, 4);
            $a_home_category[$k]['products'] = $this->product->get_list_bycate($item['id'], null, 3, 'b.featured DESC,a.featured DESC,a.views DESC');
            $a_home_category[$k]['banner'] = $this->media->get_images($item['id'],1,1,0,'banner');
        }
        $db['a_home_category'] = is_array($a_home_category)?$a_home_category:[];
        
//         $post_value = ['action'=>'load_all','limit'=>4,'where'=>'a.status=1','order'=>'a.id DESC'];
//         $a_product_new = $this->api->get_array('product#list', $post_value);
        $a_product_new = $this->product->get_list_simple('a.status=1', 4, 'b.featured DESC,a.id DESC');
        $db['a_product_new'] = is_array($a_product_new)?$a_product_new:[];
        
        $a_product_toprank = $this->product->get_list_simple('a.featured=1', 4, 'b.featured DESC,a.views DESC');
        $db['a_product_toprank'] = is_array($a_product_toprank)?$a_product_toprank:[];
        
        $a_product_readytoship = $this->product->get_list_simple('a.number>0', 3, 'b.featured DESC,a.views DESC');
        $db['a_product_readytoship'] = is_array($a_product_readytoship)?$a_product_readytoship:[];
        
        $a_product_promo = $this->product->get_list_promo(null,3,'a.featured DESC,a.views DESC');
        $db['a_product_promo'] = is_array($a_product_promo)?$a_product_promo:[];
        
        $a_product_page_oem = $this->product->get_list_of_page('a.is_oem=1', 3, 'b.featured,b.views DESC');
        $db['a_product_page_oem'] = is_array($a_product_page_oem)?$a_product_page_oem:[];
        
        $a_product_page_toprank = $this->product->get_list_of_page('a.featured=1', 3, 'a.featured DESC,a.id DESC');
        $db['a_product_page_toprank'] = is_array($a_product_page_toprank)?$a_product_page_toprank:[];
        
        file_put_contents(FILE_CONT, json_encode($db));
        return $db;
    }
    
    function get_afjson_file($file){
        $db = json_decode(@file_get_contents($file), true);
        if(!is_array($db)) $db = [];
        return $db;
    }
    
    function get_location() {
        $sql = "SELECT Id,Name,Prefix FROM locations a WHERE Status=1 AND Parent=0 ORDER BY Featured DESC,Sort DESC,Name";
        $stmt = $this->pdo->conn->prepare ( $sql );
        $stmt->execute ();
        $result = array ();
        while ( $item = $stmt->fetch () ) {
            $result [] = $item;
        }
        return $result;
    }
    function get_session_country_id(){
        $id = isset($_GET[country_id])?$_GET[country_id]:0;
        $result = $this->pdo->fetch_one("SELECT Id,Name FROM nations WHERE Id=$id");
        $_SESSION[SESSION_COUNTRY_ID] = $result['Id'];
        $url = "https://".strtolower($result['Name']).".daisan.vn";
        
        lib_redirect($url);
    }
    function get_seo_metadata($title = null, $keyword = null, $description = null, $image = null) {
        if($image == null) $image = URL_UPLOAD . "generals/metaimage.jpg";
        $this->option ['seo'] = $this->get_options ( 'seo' );
        $this->option ['contact'] = $this->get_options ( 'contact' );
        $this->option ['link'] = $this->get_options ( 'link' );
        $metadata = array ();
        $metadata ['title'] = $title;
        $metadata ['keyword'] = $keyword;
        $metadata ['description'] = $description;
        $metadata ['image'] = $image;
        if ($title == null || $title == '')
            $metadata ['title'] = @$this->option ['seo'] ['title'];
        if ($keyword == null || $title == '')
            $metadata ['keyword'] = @$this->option ['seo'] ['keyword'];
        if ($description == null || $title == '')
            $metadata ['description'] = @$this->option ['seo'] ['description'];
        $this->smarty->assign ( 'metadata', $metadata );
        return $metadata;
    }
    
     function get_menu_tree($id, $str=null){
        $taxonomy = $this->pdo->fetch_one("SELECT id,name,parent,type,level,alias FROM taxonomy WHERE id=$id");
        if($taxonomy){
            $taxonomy['url'] = $this->tax->get_url(null,'product', $taxonomy['id'],$taxonomy['alias'],$taxonomy['level']);
            $strli = "<li class=\"breadcrumb-item\"><a href=\"".$taxonomy['url']."\">".$taxonomy['name']."</a></li>";
            $str = $strli.$str;
        }
        if($taxonomy['parent']!=0){
            $str = self::get_menu_tree($taxonomy['parent'], $str);
        }
        return $str;
    }
    
    function get_breadcrumb($taxonomy_id){
        $str = null;
        $str .= "<li class=\"breadcrumb-item\"><a href=\"./\">Trang chủ</a></li>";
        $str .= $this->get_menu_tree($taxonomy_id);
        $this->smarty->assign('breadcrumb', $str);
    }
    
    function get_options($type = null, $use_lang = 1){
        global $lang;
        $options = array ();
        $sql = "SELECT name,value FROM options WHERE name IS NOT NULL";
        if($use_lang == 1) $sql .= " AND lang='$lang'";
        if($type != null) $sql .= " AND type='$type'";
        
        $stmt = $this->pdo->conn->prepare($sql);
        $stmt->execute ();
        while($item = $stmt->fetch()){
            $options[$item['name']] = $item['value'];
        }
        return $options;
    }
    function get_keywords($table, $where=null,$limit=8){
        $sql = "SELECT * FROM $table WHERE 1=1";
        if($where != null) $sql .=" AND $where";
        $sql .=" ORDER BY id DESC";
        $sql .= " LIMIT $limit";
        $result = $this->pdo->fetch_all($sql);
        return $result;
    }
    
    
    function accesslogs(){
        global $login;
        if(!$this->pdo->check_exist("SELECT 1 FROM accesslogs WHERE user_id=$login
            AND url='".THIS_LINK."' AND date_log='".date('Y-m-d')."' AND user_ip='".$this->str->get_client_ip()."'")){
            $data = array();
            $data['url'] = THIS_LINK;
            $data['user_id'] = $login;
            $data['date_log'] = date('Y-m-d');
            $data['updated'] = time();
            $data['user_ip'] = $this->str->get_client_ip();
            $data['ismobile'] = $this->isMobile();
            $details = json_decode(file_get_contents("http://ipinfo.io/".$this->str->get_client_ip()."/json"));
            if($details){
                $a_address = array();
                if(isset($details->region)) $a_address[] = $details->region;
                if(isset($details->city)) $a_address[] = $details->city;
                if(isset($details->country)) $a_address[] = $details->country;
                $data['location'] = implode(', ', $a_address);
                unset($a_address);
            }
            
            $this->pdo->insert('accesslogs', $data);
        }
    }
    function isMobile() {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", @$_SERVER["HTTP_USER_AGENT"]);
    }
}