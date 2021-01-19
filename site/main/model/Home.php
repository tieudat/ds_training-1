<?php

class Home extends Main
{

    private $folder_rfq;

    function __construct()
    {
        parent::__construct();
    }

    function test(){

       $posts = $this->pdo->fetch_all('SELECT id,title from posts');
       $this->smarty->assign('posts',$posts);
       $this->smarty->display(LAYOUT_HOME);
    }
    function admin(){


        $admin = 'posts';
        $abc = $this->pdo->count_item($admin);


        $category = 'taxonomy';
        $bef = $this->pdo->count_item($category);

        $media = 'media';
        $adu = $this->pdo->count_item($media);

        $this->smarty->assign('abc',$abc);
        $this->smarty->assign('bef',$bef);
        $this->smarty->assign('adu',$adu);
        $this->smarty->display(LAYOUT_HOME);
    }

    function add_news(){
        $taxonomy_name = $this->pdo->fetch_all("SELECT id,name from taxonomy order by id ASC LIMIT 10"); 
        $taxonomy_id=-1;
        if (isset($_GET['taxonomy_id'])) {
           
            $taxonomy_id=$_GET['taxonomy_id'];
        }
        $result = $this->pdo->fetch_all("SELECT * FROM posts WHERE taxonomy_id=".$taxonomy_id);
       
       if(isset($_POST['title'])&&isset($_POST['alias'])&&isset($_POST['keyword'])&&isset($_POST['description'])&&isset($_POST['content'])){
            $posts = "posts";
            $title = $_POST['title'];
            $alias = $_POST['alias'];
            $keyword = $_POST['keyword'];
            $description = $_POST['description'];
            $content = $_POST['content'];
            $data = array(
                'title' =>$title,
                'alias' =>$alias,
                'keyword' =>$keyword,
                'description'=>$description,
                'content' =>$content
            );
            $insert = $this->pdo->insert($posts,$data);
            $this->smarty->assign('insert',$insert);
       }
            
        $this->smarty->assign('taxonomy_name',$taxonomy_name);
        $this->smarty->assign('result',$result);
        $this->smarty->display(LAYOUT_HOME);
       
    }


    function list_news(){

        $id_post = $this->pdo->fetch_all('SELECT id,title,keyword,taxonomy_id FROM posts order by id asc');
        $result = $this->pdo->fetch_all("SELECT * FROM taxonomy WHERE taxonomy.id= posts.taxonomy_id");

        $this->smarty->assign('result',$result);
        $this->smarty->assign('id_post',$id_post);
        $this->smarty->display(LAYOUT_HOME);


    }

    function delete_new(){
        $id = $_GET['id'];
        // var_dump($id);exit();
        $table = 'posts';
        $where = "posts.id=".$id;

        $delete_new = $this->pdo->delete($table,$where);

        if ($delete_new === TRUE ) {
            header('Location:?mod=home&site=list_news');
        }else{
            return 1;
        }
        $this->smarty->assign('delete_new',$delete_new);
    }

    function edit_news(){
        $_SESSION['id'] = $_GET['id'];
        $get_id = $_SESSION['id'];
        $edit_news = $this->pdo->fetch_all("SELECT *from posts where id =".$get_id);

        $taxonomy_name = $this->pdo->fetch_all("SELECT id,name from taxonomy order by id ASC LIMIT 10"); 
        $taxonomy_id=-1;
        if (isset($_GET['taxonomy_id'])) {
           
            $taxonomy_id=$_GET['taxonomy_id'];
        }

        $result = $this->pdo->fetch_all("SELECT * FROM posts WHERE taxonomy_id=".$taxonomy_id);

        if (isset($_POST['title'])&&isset($_POST['alias'])&&isset($_POST['keyword'])&&isset($_POST['description'])&&isset($_POST['content'])) {

            $where = "posts.id =".$get_id;
           
            $posts = "posts";
            $title = $_POST['title'];
            $alias = $_POST['alias'];
            $keyword = $_POST['keyword'];
            $description = $_POST['description'];
            $content = $_POST['content'];
            $data = array(
                'title' =>$title,
                'alias' =>$alias,
                'keyword' =>$keyword,
                'description'=>$description,
                'content' =>$content
            );
            $update = $this->pdo->update($posts,$data,$where);
            $this->smarty->assign('update',$update);
            # code...
        }

        $this->smarty->assign('edit_news',$edit_news);
        $this->smarty->assign('taxonomy_name',$taxonomy_name);
        $this->smarty->assign('result',$result);
        $this->smarty->display(LAYOUT_HOME);
    }


    function add_list_catagory(){

         if(isset($_POST['title'])&&isset($_POST['alias'])&&isset($_POST['keyword'])&&isset($_POST['description'])&&isset($_POST['content'])){
            $posts = "posts";
            $title = $_POST['title'];
            $alias = $_POST['alias'];
            $keyword = $_POST['keyword'];
            $description = $_POST['description'];
            $content = $_POST['content'];
            $data = array(
                'title' =>$title,
                'alias' =>$alias,
                'keyword' =>$keyword,
                'description'=>$description,
                'content' =>$content
            );

            $insert = $this->pdo->insert($posts,$data);
            $this->smarty->assign('insert',$insert);
        }
        $this->smarty->display(LAYOUT_HOME);
    }
    function list_catagory(){
        $taxonomy_name = $this->pdo->fetch_all("SELECT * FROM taxonomy order by id ASC");

        $this->smarty->assign('taxonomy_name',$taxonomy_name);

        $this->smarty->display(LAYOUT_HOME);
    }

    function edit_catagory(){

        $get_id = $_GET['id'];
        $edit_catagory = $this->pdo->fetch_all("SELECT *from taxonomy where id =".$get_id);
        $this->smarty->assign('edit_catagory',$edit_catagory);

        $this->smarty->display(LAYOUT_HOME);
    }


    function media(){

        // $image ='media';

        // $get_image = $this->media->get_image_post($image);

        $get_image = $this->pdo->fetch_all(("SELECT *FROM media order by id ASC LIMIT 20"));
        $this->smarty->assign('get_image',$get_image);
        $this->smarty->display(LAYOUT_HOME);
    }

     function index(){

        $out = array();
        
        $this->smarty->assign("out", $out);
        $this->smarty->display(LAYOUT_HOME);
    }
   
    function taxonomy(){
        $taxonomy_name = $this->pdo->fetch_all("SELECT id,name from taxonomy order by id ASC"); 
        $taxonomy_id=-1;
        if (isset($_GET['taxonomy_id'])) {
           
            $taxonomy_id=$_GET['taxonomy_id'];
        }
        $result = $this->pdo->fetch_all("SELECT * FROM posts WHERE taxonomy_id=".$taxonomy_id);

        $this->smarty->assign('taxonomy_name',$taxonomy_name);
        $this->smarty->assign('result',$result);
        $this->smarty->display(LAYOUT_HOME);
    }

    function errorpage()
    {
        $this->smarty->display(LAYOUT_DEFAULT);

    }

    function ajax_handle()
    {
        global $login;
        $data = $rt = array();
        if (isset($_POST['ajax_action']) && $_POST['ajax_action'] == 'save_rfq') {
            $rt['code'] = 0;
            if ($login == 0)
                $rt['msg'] = "Vui lòng đăng nhập trước khi thực hiện chức năng.";
            elseif (! is_numeric($_POST['number']))
                $rt['msg'] = 'Vui lòng nhập số lượng chính xác.';
            else {
                $data['user_id'] = $login;
                $data['title'] = trim($_POST['title']);
                $data['number'] = trim($_POST['number']);
                $data['unit_id'] = intval($_POST['unit']);
                $data['created'] = time();
                $data['status'] = 1;
                $this->pdo->insert('rfq', $data);
                $rt['code'] = 1;
                $rt['msg'] = 'Gửi yêu cầu của bạn thành công.';
            }
            echo json_encode($rt);
            exit();
        }elseif (isset($_POST['ajax_action']) && $_POST['ajax_action'] == 'save_keyhistory') {
        }else if (isset($_POST['ajax_action']) && $_POST['ajax_action'] == 'send_phone_contact') {
        }
    }
}
    function get_posts($category=NULL, $position=null, $limit=NULL, $where=NULL, $orderby=NULL, $type='post', $fields=null){
            global $lang;
            $sql = "SELECT a.id,a.title,a.alias,a.media_id,a.description,a.content,a.featured,a.position,a.updated";
            if($fields!=null) $sql .= ",$fields";
            $sql .= " FROM posts a WHERE a.type='$type' AND a.status=1 AND a.lang='$lang'";
            if($position!==0 && $position!==null) $sql .= " AND a.position='$position'";
            if($category != NULL && $category != '' && $type=='post') $sql .= " AND a.id IN (SELECT post_id FROM taxonomyrls WHERE taxonomy_id IN ($category))";
            if($category != NULL && $category != '' && $type!='post') $sql .= " AND a.taxonomy_id IN($category)";
            if($where!=NULL && $where!='') $sql .= " AND $where";
            if($orderby != NULL) $sql .= " ORDER BY $orderby";
            else $sql .= " ORDER BY a.sort, a.featured DESC, a.id DESC";
            if($limit != 0 && $limit != NULL) $sql .= " LIMIT $limit";
            $stmt = $this->pdo->conn->prepare($sql);
            $stmt->execute();
            $posts = array();
            while ($item = $stmt->fetch()){
               // $item['url'] = $this->get_url($item['id'], $item['alias'], $type);
                //$item['avatar'] = $this->img->get_image($item['image']);
                $item['avatar'] = $this->media->get_image_byid($item['media_id']);
                $item['image'] = $this->media->get_image_byid($item['media_id'],1);
                $posts[] = $item;
            }
            return $posts;
        }