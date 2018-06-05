<?php
namespace Admin\Controller;
use Admin\Controller;
class GoodsController extends CommonController {

    public function lists () {

        $where = array();
        if (!empty($_GET['name'])) {
            $where['title'] = array('like',"%{$_GET['name']}%");
            //$where['title'] = array('like','%'.$_GET['name'].'%');
        } 
        if (!empty($_GET['status']) && $_GET['status'] != 'all') {
            $where['status'] = $_GET['status'];
        }
        $lists = D('Goods')->getList($where);

        foreach ($lists as $key => $value) {
            $tagInfo = '';
            $tags_id = $value['tag_id'];
            $arrTags = explode(',', $tags_id);
            foreach ($arrTags as $k => $v) {
                $tags = D('tags')->getBasicInfo($v);
                $tagInfo .= $tags['tag'] . ',';
            }
            $tagInfo = rtrim($tagInfo,',');
            $value['tag_id'] = $tagInfo;
            $lists[$key] = $value;
        } 
        // var_dump($_SERVER['HTTP_HOST']);die();
        $this->assign('lists', $lists);
        $this->display();
    }

    public function add() {
        $tags = D('Tags')->select();
        $this->assign('tags',$tags);
        $this->display();
    }

    public function doadd() {

        $image = uploadFile('image');
        $title = I('post.goods_name', '');
        $info  = I('post.goods_info', '');
        $price = I('post.price', 0);
        $price = $price * 100;
        $tags  = I('post.tag_id','');
        $tags  = implode(",", $tags);
        

        $data = array(
            'goods_name' => $title,
            'goods_info' => $info,
            'image' => $image,
            'price' => $price,
            'tag_id'  => $tags,
            'createtime' => date('Y-m-d H:i:s'),
            'updatetime' => date('Y-m-d H:i:s'),
            );
        $status = D('Goods')->add($data);
        if ($status) {
            $this->success('发布成功', 'lists');
        } else {
            $this->error('发布成功', 'lists');
        }
    }
    public function edit($id) {
        $tags = D('Tags')->select();
        $info = D('Goods')->find($id);
        $this->assign(array(
            'res' => $info,
            'tags' => $tags
        ));
        $this->display();
    }

    public function doEdit() {
        $info = D('Goods')->find($id);
        $image = I('post.image','');
        if (!$image) {
            $image = $info['image'];
        }
        $data = array(
            'id'            => I('post.id',''),
            'goods_name'    => I('post.goods_name',''),
            'goods_info'    => I('post.goods_info'),
            'price'         => I('post.price'),
            'tag_id'        => I('post.tag_id',''),
            'image'         => $image,
        );
        $res = D('Goods')->where(array('id'=>$data['id']))->save($data);
        if ($res != false) {
            $this->success('修改成功',U('admin/goods/lists'));
        } else {
            $this->error('更新失败');
        }
    }


    public function del($id) {
        $res = D('Goods')->where(array('id'=>$id))->delete();
        if ($res != false) {
            $this->success('删除成功',U('admin/goods/lists'));
        } else {
            $this->error('删除失败');
        }
    }
    public function online() {
        $id = I('get.id',0);
        if (!$id) {
            $this->error('参数错误', U('admin/goods/lists'));
        }

        $data = array(
            'status' => 1,
            'updatetime' => date('Y-m-d H:i:s'),
            );
        $where = array(
            'id' => $id
            );
        $status = D('goods')->seveData($where,$data);
        $this->success('上线成功', U('admin/goods/lists'));
    }

    public function offline() {
        $id = I('get.id',0);
        if (!$id) {
            $this->error('参数错误', U('admin/goods/lists'));
        }

        $data = array(
            'status' => 2,
            'updatetime' => date('Y-m-d H:i:s'),
            );
        $where = array(
            'id' => $id
            );
        $status = D('goods')->seveData($where,$data);
        $this->success('下线成功', U('admin/goods/lists'));
    }
}