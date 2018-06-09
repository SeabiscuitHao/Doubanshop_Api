<?php
namespace Admin\Controller;
use Admin\Controller;
class AdminController extends CommonController {

    public function lists() {
        $lists = D('Admin')->getList();
        $this->assign('lists', $lists);
        $this->display();
    }

    public function add() {
        $nodes = D('node')->getList();
        var_dump($nodes);die();
        $this->display();
    }

    public function doadd() {

    }

}