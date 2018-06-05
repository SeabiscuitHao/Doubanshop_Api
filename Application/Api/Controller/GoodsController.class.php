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
        $lists = D('Goods')->getInfoById($id);
        if (empty($lists)) {
            $res['error_no'] = 1;
            $res['msg']      = "参数错误";
            echo json_encode($res);die();
        }
        $res['data']['info']['id']    = $lists['id'];
        $res['data']['info']['title'] = $lists['goods_name'];
        $res['data']['info']['price'] = $lists['price'];
        $res['data']['info']['desc']  = $lists['goods_info'];
        $res['data']['info']['image'] = $lists['image'];
        echo json_encode($res);die();
    }
	
}