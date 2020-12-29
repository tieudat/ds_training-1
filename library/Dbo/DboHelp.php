<?php
# ======================================== #
# Class DboHelp
# The libraries of System
# ======================================== #
class DboHelp{
	
	private $pdo;
	public $a_status;
	
	function __construct(){
		$this->pdo = new vsc_pdo();
		
		$this->a_status = array(
				0 => 'Chưa hoạt động',
				1 => 'Hoạt động',
				2 => 'Đang khóa'
		);
	}
	
	
	function get_select_location($active=0, $parent=0, $default='Lựa chọn') {
		$result = "";
		if($default != null) $result .= '<option value="0">' . $default . '</option>';
		$sql = "SELECT Id,Name,Prefix FROM locations a WHERE Status=1  AND Parent=$parent ORDER BY Featured DESC,Sort DESC,Name";
		$stmt = $this->pdo->conn->prepare($sql);
		$stmt->execute();
		while ($item = $stmt->fetch()) {
			if ($item['Id']==$active) $result .= '<option value="'.$item ['Id'].'" selected>';
			else $result .= '<option value="'.$item['Id'].'">';
			$result .= $item ['Name'];
			$result .= '</option>';
		}
		return $result;
	}

	
	function get_location($parent=0) {
	    $sql = "SELECT Id,Name,Prefix FROM locations a WHERE Status=1  AND Parent=$parent ORDER BY Featured DESC,Sort DESC,Name";
	    $db = $this->pdo->fetch_all($sql);
	    return $db;
	}
	
	
	function get_select_location_multi($active=null, $parent=0, $default='Lựa chọn') {
		$a_active = explode(",", $active);
		$result = "";
		if($default != null) $result .= '<option value="0">' . $default . '</option>';
		$sql = "SELECT Id,Name,Prefix FROM locations a WHERE Status=1  AND Parent=$parent ORDER BY Sort,Name";
		$stmt = $this->pdo->conn->prepare($sql);
		$stmt->execute();
		while ($item = $stmt->fetch()) {
			if (in_array($item['Id'], $a_active)) $result .= '<option value="'.$item ['Id'].'" selected>';
			else $result .= '<option value="'.$item['Id'].'">';
			$result .= $item ['Name'];
			$result .= '</option>';
		}
		return $result;
	}
	
	
	function get_select_from_table($table, $fieldid='Id', $fieldname='Name', $active=0, $default='Lựa chọn'){
		$result = "";
		if($default != null) $result .= '<option value="0">'.$default.'</option>';
		$sql = "SELECT $fieldid,$fieldname FROM $table";
		$stmt = $this->pdo->conn->prepare($sql);
		$stmt->execute();
		while ($item = $stmt->fetch()) {
			if ($item[$fieldid]==$active) $result .= '<option value="'.$item [$fieldid].'" selected>';
			else $result .= '<option value="'.$item[$fieldid].'">';
			$result .= $item [$fieldname];
			$result .= '</option>';
		}
		return $result;
	}
	
	
	function get_select_from_dbtable($table, $Key, $Name, $active=0, $prefix=null, $where=null, $sort=null){
		$result = null;
		if($prefix!==null) $result = "<option value=\"0\">".$prefix."</option>";
		$sql = "SELECT $Key,$Name FROM $table";
		if($where!=null && $where!='') $sql .= " WHERE $where";
		if($sort!=null && $sort!='') $sql .= " ORDER BY $sort";
		$stmt = $this->pdo->conn->prepare($sql);
		$stmt->execute();
		while ($item = $stmt->fetch()){
			if($item[$Key]===$active) $result .= '<option value="'.$item[$Key].'" selected>';
			else $result .= '<option value="'.$item[$Key].'">';
			$result .= $item[$Name];
			$result .= '</option>';
		}
		return $result;
	}
	
	
	function get_select_from_array(array $array, $active=0, $prefix=0){
		$df_value = isset($array[0])?-1:0;
		$result = "";
		if($prefix!==0) $result = "<option value='$df_value'>$prefix</option>";
	
		foreach ($array AS $k => $item){
			if($k == $active) $result .= "<option value='".$k."' selected>";
			else $result .= "<option value='".$k."'>";
			$result .= $item;
			$result .= "</option>";
		}
		return $result;
	}

	
	function get_checkbox_from_array(array $array, $active=null, $idname=null){
	    $idname = $idname==null?'defaultCheck':$idname;
		$result = "";
		foreach ($array AS $k => $item){
			$result .= "<div class=\"form-check\">";
			if(!in_array($k, explode(",", $active))) $result .= "<input class=\"form-check-input\" type=\"checkbox\" value=\"$k\" id=\"$idname$k\">";
			else $result .= "<input class=\"form-check-input\" type=\"checkbox\" value=\"$k\" id=\"$idname$k\" checked>";
			$result .= "<label class=\"form-check-label\" for=\"$idname$k\"> $item </label>";
			$result .= "</div>";
		}
		return $result;
	}
	
	
	function array_sort($array, $on, $order=SORT_ASC){
		$new_array = array();
		$sortable_array = array();
	
		if (count($array) > 0) {
			foreach ($array as $k => $v) {
				if (is_array($v)) {
					foreach ($v as $k2 => $v2) {
						if ($k2 == $on) $sortable_array[$k] = $v2;
					}
				} else $sortable_array[$k] = $v;
			}
	
			switch ($order) {
				case SORT_ASC:
					asort($sortable_array);
					break;
				case SORT_DESC:
					arsort($sortable_array);
					break;
			}
	
			foreach ($sortable_array as $k => $v) {
				$new_array[$k] = $array[$k];
			}
		}
	
		return $new_array;
	}
	
	
	function get_btn_status($status, $table, $id, $custom_js=null) {
	    $onclick = "onclick=\"$custom_js('$table', '$id');\"";
	    if($custom_js===null) $onclick = "onclick=\"activeItem('$table', '$id');\"";
	    elseif ($custom_js===0) $onclick = null;
	    
	    $result = NULL;
	    if($status==0){
	        $result .= "<button type=\"button\" class=\"btn btn-default btn-sm\" title=\"Đổi trạng thái\" $onclick>";
	        $result .= "<i class=\"fa fa-clock-o fa-fw\"></i>";
	        $result .= "</button>";
	    }elseif($status==1){
	        $result .= "<button type=\"button\" class=\"btn btn-success btn-sm\" title=\"Đổi trạng thái\" $onclick>";
	        $result .= "<i class=\"fa fa-check fa-fw\"></i>";
	        $result .= "</button>";
	    }else{
	        $result .= "<button type=\"button\" class=\"btn btn-danger btn-sm\" title=\"Chưa được kích hoạt\" $onclick>";
	        $result .= "<i class=\"fa fa-lock fa-fw\"></i>";
	        $result .= "</button>";
	    }
	    return $result;
	}
	
}