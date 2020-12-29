<?php

class Help extends Main{

	function ajax_handle_cart(){
		if(isset($_POST['ajax']) && $_POST['ajax']=='load_cart_content'){
			echo json_encode($this->load_cart_content());
			exit();
		}elseif(isset($_POST['ajax']) && $_POST['ajax']=='remove_product_from_cart'){
			unset($_SESSION ["vsc_session_shop_cart"] [$_POST ["product_id"]]);
			echo json_encode($this->load_cart_content());
			exit();
		}elseif(isset($_POST['ajax']) && $_POST['ajax']=='update_number_product'){
			$total_item = 0;
			if(isset($_SESSION ["vsc_session_shop_cart"] [$_POST ["product_id"]])){
				$_SESSION ["vsc_session_shop_cart"] [$_POST ["product_id"]]['number'] = intval($_POST['number']);
				$total_item = $_SESSION ["vsc_session_shop_cart"] [$_POST ["product_id"]]['price'] * intval($_POST['number']);
			}
			$data = $this->load_cart_content();
			$data['total_item'] = number_format($total_item) . "đ";
			echo json_encode($data);
			exit();
		}elseif(isset($_POST['ajax']) && $_POST['ajax']=='delete_cart'){
			$_SESSION ["vsc_session_shop_cart"] = array();
			echo json_encode($this->load_cart_content());
			exit();
		}
	}
	
	
	function load_cart_content(){
	    $data = [];
		$data['total'] = 0;
		$data['number'] = 0;
		$data['str_cart_content'] = null;
		if(isset($_SESSION['vsc_session_shop_cart']) && count($_SESSION['vsc_session_shop_cart'])>0){
			foreach ($_SESSION['vsc_session_shop_cart'] AS $item){
				$data['number'] += 1;
				$data['total'] += $item['price'] * $item['number'];
				 
				$data['str_cart_content'] .= "<div class=\"item\">";
				$data['str_cart_content'] .= "<div class=\"row row-small\">";
				$data['str_cart_content'] .= "<div class=\"col-md-4\">";
				$data['str_cart_content'] .= "<img src=\"".$item['avatar']."\" width=\"100%\">";
				$data['str_cart_content'] .= "</div>";
				$data['str_cart_content'] .= "<div class=\"col-md-8\">";
				$data['str_cart_content'] .= "<h3>".$item['name']."</h3>";
				$data['str_cart_content'] .= "<p>".number_format($item['price'])."đ &nbsp;&nbsp; x ".$item['number']."</p>";
				$data['str_cart_content'] .= "</div>";
				$data['str_cart_content'] .= "</div>";
				$data['str_cart_content'] .= "</div>";
			}
		}else{
			$data['str_cart_content'] = "<div class=\"text-center\">Không có sản phẩm trong giỏ hàng.</div>";
		}
		 
		$data['total'] = number_format($data['total']) . "đ";
		return $data;
	}
	
	
	function ajax_set_language_used(){
		if(isset($_POST['lang'])){
			$_SESSION[SESSION_LANGUAGE_DEFAULT] = $_POST['lang'];
			exit();
		}
	}
	

	function ajax_load_location(){
		$Type = isset($_POST['Type']) ? trim($_POST['Type']) : null;
		$Value = isset($_POST['Value']) ? intval($_POST['Value']) : 0;
		$prefix = "Chọn quận huyện";
		if($Type=='wards') $prefix = "Chọn phường xã";
		$str = $this->help->get_select_location(0, $Value, $prefix);
		echo $str; exit();
	}
	
	
	function ajax_active_item() {
		if (isset($_POST['id'])) {
			$sql = "SHOW COLUMNS FROM ".$_POST['table'];
			$stmt = $this->pdo->conn->prepare($sql);
			$stmt->execute();
			$fieldid = $stmt->fetch(PDO::FETCH_COLUMN);
	
			$fieldstatus = "Status";
			if(!$this->pdo->check_exist("SELECT $fieldstatus FROM ".$_POST['table']." LIMIT 1")){
				$fieldstatus = "status";
			}
			$value = $this->pdo->fetch_one("SELECT $fieldstatus FROM ".$_POST['table']." WHERE $fieldid=".$_POST['id']);
			$status = 0;
			if(@$value[$fieldstatus]==0) $status = 1;
	
			$this->pdo->query("UPDATE ".$_POST['table']." SET $fieldstatus=$status WHERE $fieldid=".$_POST['id']);
			echo $this->get_status_btn($status, $_POST['table'], $_POST['id']);
			exit();
		}
		echo 0; exit();
	}

	
	function ajax_delete_item() {
	    $rt = [];
		$rt['code'] = 0;
		if (isset($_POST['id'])) {
			$sql = "SHOW COLUMNS FROM ".$_POST['table'];
			$stmt = $this->pdo->conn->prepare($sql);
			$stmt->execute();
			$fieldid = $stmt->fetch(PDO::FETCH_COLUMN);
			$this->pdo->query("DELETE FROM ".$_POST['table']." WHERE $fieldid=".$_POST['id']);
			$rt['code'] = 1;
		}
		echo json_encode($rt); exit();
	}
	
	function set_place(){
	    if(isset($_POST['action']) && $_POST['action']=='set_place'){
	        $this->hcache['place'] = [];
	        $this->hcache['place']['id'] = intval(@$_POST['id']);
	        $this->hcache['place']['name'] = trim(@$_POST['name']);
	        setcookie('HodineCache', json_encode($this->hcache), time() + (86400 * 30 * 30), "/");
	    }
	}
	
}
