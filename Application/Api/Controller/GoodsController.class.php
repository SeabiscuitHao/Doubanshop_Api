<?php
namespace Api\Controller;
use Think\Controller;
class GoodsController extends Controller {

    public function info() {
        $res = array(
            'error_no'  => 0,
            'msg'       => '',
            'data'      => array(),
        );
        $id = $_GET['id'];
        $uid = session('id');
        $lists = D('Goods')->getInfoById($id);
        if (empty($lists)) {
            $res['error_no'] = 1;
            $res['msg']      = "参数错误";
            echo json_encode($res);die();
        }
        $where = array(
            'user_id'   => $uid
        );
        $cart = D('cart')->getList($where);
        $num = 0;
        foreach ($cart as $key => $value) {
            $num += $value['goods_num'];
        }
        $res['data']['info']['id']        = $lists['id'];
        $res['data']['info']['title']     = $lists['goods_name'];
        $res['data']['info']['price']     = $lists['price'];
        $res['data']['info']['desc']      = $lists['goods_info'];
        $res['data']['info']['image']     = $lists['image'];
        // $res['data']['info']['cart_num']  = $num;
        echo json_encode($res);die();
    }
	
}