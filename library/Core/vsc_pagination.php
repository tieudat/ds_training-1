<?php
/*
 * vsc_pagination Library
 * Creator: LucTV 19/05/2016
 */
class vsc_pagination{
    
    private $numbers;
    private $pagesize;
    private $maxpage;
    private $url;
    private $page;
    private $class_page;
    private $show_count;
    
    function __construct($numbers, $pagesize=20, $show_count=1, $class_page='pagination justify-content-center'){
        global $smarty;
        $this->numbers = $numbers;
        $this->pagesize = $pagesize;
        $this->page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $this->url = $this->get_url_page();
        $this->maxpage = $this->get_max_page();
        $this->class_page = $class_page;
        $this->show_count = $show_count;
        
        $paging = $this->build_paging();
        if($numbers<=$pagesize) $paging = null;
        $smarty->assign("paging", $paging);
        $smarty->assign("current_page", $this->page);
    }
    
    
    public function build_paging() {
        $class_item = "page-link";
        $getpage = explode("?", $this->url);
        $sour = (count($getpage)>1)?"&":"?";
        
        $str = "";
        if($this->show_count == 1)
            $str .= "<div class='d-flex justify-content-center py-2'>Trang $this->page/$this->maxpage. Tổng số $this->numbers mục&nbsp;</div>";
            $str .= "<ul class='".$this->class_page."'>";
            
            $str .= "<li><a class='$class_item' href='".$this->url.$sour."page=1'>Về đầu</a></li>";
            if($this->page >1){
                $PrevStart=$this->page-1;
                $str .= "<li><a class='$class_item' href='".$this->url.$sour."page=".$PrevStart."'>Trang trước</a></li>";
            }
            $currentPage = 0;
            $pf = $this->page - 3;
            $pt = $this->page + 3;
            if($pf < 1) $pf = 1;
            
            if($pt > $this->maxpage) $pt = $this->maxpage;
            if(empty($this->page)) $this->page = 1;
            if(empty($this->pagesize)) $this->pagesize = 1;
            
            for($currentPage=$pf;$currentPage<=$pt;$currentPage++){
                if($currentPage < $this->maxpage){
                    if($currentPage == $this->page){
                        if($currentPage % $this->pagesize){
                            $str.= "<li class='active'><a class='$class_item'>$currentPage</a></li>";
                        }else{
                            $str.= "<li class='active'><a class='$class_item'>$currentPage</a></li>";
                        }
                    }elseif($currentPage % $this->pagesize){
                        $str.= "<li><a class='$class_item' href='".$this->url.$sour."page=".$currentPage."'>$currentPage</a></li>";
                    }else{
                        $str.= "<li><a class='$class_item' href='".$this->url.$sour."page=".$currentPage."'>$currentPage</a></li>";
                    }
                }else{
                    if($this->page == $this->maxpage){
                        $str.= "<li class='active'><a class='$class_item'>$currentPage</a>";
                        break;
                    }else{
                        $str.="<li><a class='$class_item' href='".$this->url.$sour."page=".$currentPage."'>$currentPage</a></li>";
                        break;
                    }
                }
            }
            if($this->page < $this->maxpage){
                $NextPage=$this->page+1;
                $str.= "<li class=''><a class='$class_item' href='".$this->url.$sour."page=".$NextPage."'>Xem tiếp</a></li>";
            }
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