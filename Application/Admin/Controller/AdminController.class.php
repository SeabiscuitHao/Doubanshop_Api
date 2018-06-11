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
        $role = D('role')->getList();
        $this->assign('role',$role);
        $this->display();
    }
    public function doadd() {
        $name     = I('post.name','');
        $password = I('post.password','');
        $phone    = I('post.phone','');
        $role_id  = I('post.role_id','');
        if (empty($name) || empty($password) || empty($phone) || empty($role_id)) {
            $this->error('参数错误');
        }
        $data = array(
            'name'      => $name,
            'password'  => $password,
            'phone'     => $phone,
            'role_id'   => $role_id[0],
            'createtime'=> date('Y-m-d H:i:s')
        );
        var_dump($data);die();
        $res = D('Admin')->add($data);
        if ($res) {
            $this->success('添加成功',U('Admin/admin/lists'));
        } else {
            $this->error('添加失败');
        }
    }

}