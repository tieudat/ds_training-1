<?php

class Home extends Main
{

    private $folder_rfq;

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $out = array();
        
        $this->smarty->assign("out", $out);
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