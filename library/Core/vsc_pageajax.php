<?php
/*
 * Pagination Library
 * Creator: LucTV 19/05/2016
 */
class vsc_pageajax{
	
	private $numbers;
	private $pagesize;
	private $maxpage;
	private $url;
	private $page;
	private $show_count;
	private $action;
	
	function __construct($numbers, $pagesize=20, $page=1, $action=null, $show_count=1){
		$this->numbers = $numbers;
		$this->pagesize = $pagesize;
		$this->page = $page;
		$this->url = $this->get_url_page();
		$this->maxpage = $this->get_max_page();
		$this->show_count = $show_count;
		$this->action = $action;
	}
	
	
	public function building() {
	
		$getpage = explode("?", $this->url);
		$sour = "?";
		if(count($getpage) > 1)
			$sour = "&";
	
		$str = "";
		if($this->show_count == 1)
			$str .= "<span>Trang $this->page/$this->maxpage. Tổng số $this->numbers mục&nbsp;</span>";
		$str .= "<ul class='pagination'>";
		
		$first = "";
		$str .= "<li><a href='javascript:void(0);' onclick='".$this->action."(1);'>Đầu</a></li>";
		if($this->page >1){
			$PrevStart=$this->page-1;
			$str .= "<li><a href='javascript:void(0);' onclick='".$this->action."($PrevStart);'>&laquo;</a></li>";
		}
		$currentPage = 0;
		$pf = $this->page - 2;
		$pt = $this->page + 2;
		if ($pf < 1)
			$pf = 1;
	
		if ($pt > $this->maxpage)
			$pt = $this->maxpage;
		if (empty($this->page))
			$this->page = 1;
		if (empty($this->pagesize))
			$this->pagesize = 1;
		if (empty($recordcount))
			$recordcount = 1;
	
		for($currentPage=$pf;$currentPage<=$pt;$currentPage++){
			if($currentPage < $this->maxpage){
				if($currentPage == $this->page){
					if($currentPage % $this->pagesize){
						$str.= "<li class='active'><a>$currentPage</a></li>";
					}else{
						$str.= "<li class='active'><a>$currentPage</a></li>";
					}
				}elseif($currentPage % $this->pagesize){
					$str.= "<li><a href='javascript:void(0);' onclick='".$this->action."($currentPage);' class='link'>$currentPage</a></li>";
				}else{
					$str.= "<li><a href='javascript:void(0);' onclick='".$this->action."($currentPage);' class='link'>$currentPage</a></li>";
				}
			}else{
				if($this->page == $this->maxpage){
					$str.= "<li class='active'><a>$currentPage</a>";
					break;
				}else{
					$str.="<li><a href='javascript:void(0);' onclick='".$this->action."($currentPage);'>$currentPage</a></li>";
					break;
				}
			}
		}
		if($this->page < $this->maxpage){
			$NextPage=$this->page+1;
			$str.= "<li class=''><a href='javascript:void(0);' onclick='".$this->action."($NextPage);'>&raquo;</a></li>";
		}
		$str.= "<li><a href='javascript:void(0);' onclick='".$this->action."(" . $this->maxpage . ");'>Cuối</a></li>";
		$str .= "</ul>";
		return $str;
	}
	
	
	function get_max_page(){
		if ($this->numbers % $this->pagesize == 0) {
			$maxpage = $this->numbers / $this->pagesize;
		} else {
			$maxpage = ceil($this->numbers / $this->pagesize);
		}
		return $maxpage;
	}
	
	
	function get_url_page(){
		$url = THIS_LINK;
		if(strpos($url, "?page=") == true){
			$url = explode("?page=", $url);
		}
		else{
			$url = explode("&page=", $url);
		}
		$url = current($url);
		return $url;
	}
	
	
	function get_sql_limit($sql){
		$start = ($this->page - 1) * $this->pagesize;
		
		$sql .= " LIMIT $start,$this->pagesize";
		return $sql;
	}
	
	
	function get_page_limit(){
		$start = ($this->page - 1) * $this->pagesize;
		
		return "$start,$this->pagesize";
	}
	
}