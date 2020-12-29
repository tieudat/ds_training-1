<?php
class DboMenu {
	
    private $pdo;
    
    public $type, $position, $folder;
    
    function __construct() {
        $this->pdo = new vsc_pdo();
        $this->img = new vsc_image();
        
        $this->type = array(
        		"module" => "Module chức năng",
        		"category" => "Danh mục bài viết",
        		"post" => "Bài viết",
       			"product_cate" => "Danh mục sản phẩm",
        		"custom" => "Nhập link"
        );
        
        
        $this->position = array(
	            'top' => 'Menu Top',
	            'main' => 'Menu Main',
	            'main_right' => 'Menu Sidebar',
	        	'foot' => 'Menu Footer',
        );
        $this->folder = 'media/category/';
    }
    
    
    function get_select_menu_parent($position, $active=0, $parent=0, $not=0, $prefix='Chọn menu cha') {
    	global $lang;
    	$result = "";
    	if ($prefix != null) $result = '<option value="0">' . $prefix . '</option>';
    
    	$sql = "SELECT id,name,level FROM taxonomy WHERE status=1 AND lang='$lang' AND position=$position AND parent=$parent";
    	if($not != 0 && count(explode(",", $not))>0) $sql .= " AND id NOT IN ($not)";
    	$sql .= " ORDER BY lft";
    	$stmt = $this->pdo->conn->prepare($sql);
    	$stmt->execute();
    	while ($item = $stmt->fetch()) {
    		if ($item ['id'] == $active) $result .= '<option value="' . $item ['id'] . '" selected>';
    		else $result .= '<option value="' . $item ['id'] . '">';
    
    		for ($i=0; $i<$item['level']; $i++) {
    			$result .= "&#8212; ";
    		}
    		$result .= $item ['name'];
    		$result .= '</option>';
    		if($this->pdo->check_exist("SELECT id FROM taxonomy WHERE parent=".$item['id']." LIMIT 1")){
    		    $result .= $this->get_select_menu_parent($position, $active, $item['id'], $not, null);
    		}
    	}
    	return $result;
    }
    
    function get_menu_arr($position, $parent=0){
    	global $lang;
    	$setting = is_file(FILE_INFO_SETTING) ? parse_ini_file(FILE_INFO_SETTING, true) : array();
    	$conf_position = isset($setting['menu_position']) ? $setting['menu_position'] : array();
    	$taxonomy_id = @$conf_position[$position];
    	
    	$sql = "SELECT id,name,description,keyword,alias,image,parent,(rgt-lft) AS is_sub
    			FROM taxonomy
    			WHERE type='menu' AND position=$taxonomy_id AND parent=$parent AND lang='$lang'
				ORDER BY lft";
		
    	$stmt = $this->pdo->conn->prepare($sql);
    	$stmt->execute();
    	$menu = array();
    	while ($item = $stmt->fetch()) {
    	    $item['image'] = $this->img->get_image($this->folder, $item['image']);
    		$item['url'] = $this->get_url_menu($item['description'], $item['keyword']);
    		$item['submenu'] = array();
    		if($item['is_sub'] > 1) $item['submenu'] = $this->get_menu_arr($position, $item['id']);
    		$menu[] = $item;
    	}
    	
    	return $menu;
    }

    
    function get_url_menu($type, $menu_object){
    	switch ($type) {
    		case "module":
    			$url = DOMAIN.$menu_object;
    			break;
    		case "post":
    		    $url = DOMAIN.URL_HELPCENTER.$menu_object;
    		    break;
    		case "custom":
    			$url = $menu_object;
    			break;
    		case "category":
    		    $url = DOMAIN.URL_HELPCENTER.$type."/".$menu_object;
    			break;
    		case "product":
    			$url = DOMAIN.ROUTER_PRODUCT_LIST.$menu_object;
    			break;
    		default:
    			$url = null;
    	}
    	return $url;
    }
    
}
