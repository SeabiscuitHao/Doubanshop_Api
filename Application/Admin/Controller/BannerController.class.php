<?php
namespace Admin\Controller;
use Admin\Controller;
class BannerController extends CommonController {

    public function lists () {

        $where = array();
        if (!empty($_GET['name'])) {
            $where['title'] = array('like',"%{$_GET['name']}%");
        } 
        if (!empty($_GET['status']) && $_GET['status'] != 'all') {
            $where['status'] = $_GET['status'];
        }
        $lists = D('Banner')->getList($where);
        $this->assign('lists', $lists);
        $this->display();
    }

    public function add() {
        $this->display();
    }

    public function doadd() {

        $image = uploadFile('image');
        $title = I('post.title', '');
        $url   = I('post.url', '');
        $data = array(
            'title' 	 => $title,
            'url' 		 => $url,
            'image' 	 => $image,
            'createtime' => date('Y-m-d H:i:s'),
            'updatetime' => date('Y-m-d H:i:s'),
            );
        $status = D('Banner')->add($data);
        if ($status) {
            $this->success('发布成功', 'lists');
        } else {
            $this->error('发布成功', 'lists');
        }
    }
    public function edit($id) {
        $info = D('Banner')->find($id);
        $this->assign(array(
            'res' => $info,
        ));
        $this->display();
    }

    public function doEdit() {
    	$id = I('post.id','');
        $info = D('Banner')->where(array('id'=>$id))->find();
        $image = I('post.image','');
        if (!$image) {
            $image = $info['image'];
        }
        $data = array(
            'id'            => I('post.id',''),
            'title'    		=> I('post.title',''),
            'url'         	=> I('post.url'),
            'image'         => $image,
        );
        $res = D('Banner')->where(array('id'=>$data['id']))->save($data);
        if ($res != false) {
            $this->success('修改成功',U('admin/banner/lists'));
        } else {
            $this->error('更新失败');
        }
    }


    public function del($id) {
        $res = D('Banner')->where(array('id'=>$id))->delete();
        if ($res != false) {
            $this->success('删除成功',U('admin/Banner/lists'));
        } else {
            $this->error('删除失败');
        }
    }
    public function online() {
        $id = I('get.id',0);
        if (!$id) {
            $this->error('参数错误', U('admin/Banner/lists'));
        }

        $data = array(
            'status' => 1,
            'updatetime' => date('Y-m-d H:i:s'),
            );
        $where = array(
            'id' => $id
            );
        $status = D('Banner')->seveData($where,$data);
        $this->success('上线成功', U('admin/Banner/lists'));
    }

    public function offline() {
        $id = I('get.id',0);
        if (!$id) {
            $this->error('参数错误', U('admin/Banner/lists'));
        }

        $data = array(
            'status' => 2,
            'updatetime' => date('Y-m-d H:i:s'),
            );
        $where = array(
            'id' => $id
            );
        $status = D('Banner')->seveData($where,$data);
        $this->success('下线成功', U('admin/Banner/lists'));
    }
}