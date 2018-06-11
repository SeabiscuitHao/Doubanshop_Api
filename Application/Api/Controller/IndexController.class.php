<?php
namespace Api\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function index () {
       
        $lists = D('Goods')->getList();
        $res = array(
            'error_no'  => 0,
            'msg'       => '',
            'data'      => array()
        );

        $token   = I('post.token','');

        $idres    = D('Token')->getList();
        foreach ($idres as $key => $value) {
            if ($value['token'] == $token) {
                $uid = $value['uid'];
            }
        }

        $info    = D('Cart')->getList();
        $num     = 0;
        foreach ($info as $key => $value) {
            if ($value['user_id'] == $uid) {
                $num += $value['goods_num'];
            }
        }
        $res['data']['cart_num'] = $num;


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
        $res['data']['goods'] = $lists;
		$banner = D('banner')->getBanner();
        if (empty($banner)) {
            $res['error_no'] = 1;
            $res['msg']      = "参数错误";
            echo json_encode($res);die();
        } else {
            $res['data']['banner'] = $banner;
        }
        echo json_encode($res);die();
	}
	
}