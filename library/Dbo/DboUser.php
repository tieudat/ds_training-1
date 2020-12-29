<?php

# ======================================== #
# Class DboUser
# The libraries of class User
# Build functions to support for module user
# ======================================== #

class DboUser{
	
	private $pdo;

	public $permision_type, $level, $position;
	public $admin_position;
	public $gender;
	public $dir_img = "users/";
	private $number_img_in_folder = 1000;
	
	function __construct(){
		$this->pdo = new vsc_pdo();
		
		$this->level = array(
				1 => "Level 1", 
				2 => "Level 2", 
				3 => "Level 3",
				4 => "Level 4",
				5 => "Level 5"
		);

		$this->position = array(
				1 => "Position 1",
				2 => "Position 2",
				3 => "Position 3",
				4 => "Position 4",
				5 => "Position 5",
				6 => "Position 6"
		);
		
		$this->permision_type = array(
				1 => "Phân quyền hệ thống",
				2 => "Phân quyền Quản lý",
				3 => "Phân quyền sử dụng",
		);
		
		$this->gender = array(0 => 'Nữ',1 => 'Nam',2 => 'Khác');
		
		$this->admin_position = array(
				0 => 'Quản trị viên',
				1 => 'Biên tập viên',
				2 => 'Người kiểm duyệt',
				3 => 'Nhà phân tích'
		);
		
	}
	
	function get_profile() {
		global $login;
		$sql = "SELECT * FROM useradmin WHERE Id=$login";
		$user = $this->pdo->fetch_one($sql);
		$user['short_name'] = @end(explode(" ", $user['user_name']));
		return $user;
	}
	

	function get_select_user_levels($level, $active=0, $prefix=0){
		$result = "";
		if($prefix==1)
			$result = "<option value=''>Chọn level</option>";
		
		foreach ($this->level AS $k => $item){
			if($k <= $level){
				if($k == $active)
					$result .= "<option value='".$k."' selected>";
				else
					$result .= "<option value='".$k."'>";
				$result .= $item;
				$result .= "</option>";
			}
		}
		return $result;
	}
	
	function get_select_birthday($birthday="1990-01-01"){
		$active['day'] = date("d", strtotime($birthday));
		$active['month'] = date("m", strtotime($birthday));
		$active['year'] = date("Y", strtotime($birthday));
		
		$result['day'] = "";
		for($i=1; $i<=31; $i++){
			if($i == $active['day'])
				$result['day'] .= "<option value='$i' selected>" . $i . "</option>";
			else 
				$result['day'] .= "<option value='$i'>" . $i . "</option>";
		}
		unset($i);
		
		$result['month'] = "";
		for($i=1; $i<=12; $i++){
			if($i == $active['month'])
				$result['month'] .= "<option value='$i' selected>" . $i . "</option>";
			else 
				$result['month'] .= "<option value='$i'>" . $i . "</option>";
		}
		unset($i);
		
		$result['year'] = "";
		for($i=2010; $i>=1950; $i--){
			if($i == $active['year'])
				$result['year'] .= "<option value='$i' selected>" . $i . "</option>";
			else 
				$result['year'] .= "<option value='$i'>" . $i . "</option>";
		}
		unset($i);
		
		return $result;
	}
	

	function get_select_users($active=0, $default='Select Users') {
	    $str = "";
	    if($default!=null) $str .= '<option value="0">'.$default.'</option>';
	    
	    $sql = "SELECT id,name,username FROM users WHERE status=1 ORDER BY username,name";
	    $rt = $this->pdo->fetch_all($sql);
	    foreach ($rt AS $item){
	        if($item['id']==$active) $str .= '<option value="'.$item['id'].'" selected>';
	        else $str .= '<option value="'.$item['id'].'">';
	        $str .= $item['name']." (".$item['username'].")";
	        $str .= '</option>';
	    }
	    return $str;
	}
	
	
	function get_select_useradmins($active=0, $type=null, $default='Select Users') {
	    $str = "";
	    if($default!=null) $str .= '<option value="0">'.$default.'</option>';
	    
	    $sql = "SELECT id,name,username FROM useradmin WHERE status=1";
	    if($type!=null)  $sql .= " AND type='$type'";
	    $sql .= "ORDER BY username,name";
	    $rt = $this->pdo->fetch_all($sql);
	    foreach ($rt AS $item){
	        if($item['id']==$active) $str .= '<option value="'.$item['id'].'" selected>';
	        else $str .= '<option value="'.$item['id'].'">';
	        $str .= $item['name']." (".$item['username'].")";
	        $str .= '</option>';
	    }
	    return $str;
	}
	
	function get_folder_img($id){
		$number = intval($id/$this->number_img_in_folder);
		$folder = ($number+1)*$this->number_img_in_folder;
		return $this->dir_img.$folder."/";
	}
	
	
	function get_folder_img_upload($id){
		return DIR_UPLOAD.$this->get_folder_img($id);
	}
	
}