<?php
namespace Home\Controller;
use Think\Controller;
class OrderController extends Controller {
	public function lists() {
		$id = session('id');
		if (empty($id)) {
			$this->error('请先登录',U('Home/User/login'));
		}
		$lists = D('Order')->where(array('user_id'=>$id))->select();
		$res = array();
		foreach ($lists as $key => $value) {
			$res[$value['order_num']][] = $value;
		}
		$this->assign(array(
			'res'		=>	$res,
		));
		$this->display();
	}

	public function orderTmp() {
		$res = array(
			'error_no' => 0,
			'msg'	   => '',
			'data'	   => array()
		);
		$goodsId  = I('post.goods_id','');
		$count 	  = I('post.count','');
		$goodsInfo = array();
		$cart = I('post.cart','');
		if (!empty($cart)) {
			if (!is_array($cart)) {
				$cart = json_decode($cart,true);
			}
			foreach ($cart as $key => $value) {
				$resTmp = D('Cart')->getBasicInfo($value);
				$tmp = array(
					'goodsId'	=> $resTmp['goods_id'],
					'count'		=> $resTmp['goods_num'],
				);
				$goodsInfo[] = $tmp;
			}
		} else {
			$goodsInfo[] = array(
				'goodsId'	=> $goodsId,
				'count'		=> $count,
			);
		}
		$userId = session('id');
		$goodsInfo = json_encode($goodsInfo);
		$data = array(
			'goods_info'	=> $goodsInfo,
			'user_id'		=> $userId
		);
		$status = D('orderTmp')->add($data);
		$res['data']['oid'] = $status;
		if ($status) {
			$res['error_no'] = 0;
			$res['msg']		 = '';
			echo json_encode($res);die();
		} else {
			$res['error_no'] = 1;
			$res['msg']		 = '参数错误';
			echo json_encode($res);die();
		}
	}


	public function confirmOrder() {
		$oid  = I('get.oid','');
		$list = D('orderTmp')->getBasicInfo($oid);
		$orderInfo = json_decode($list['goods_info'],true);
		foreach ($orderInfo as $key => $value) {
			$goodsInfo = D('Goods')->getBasicInfo($orderInfo[$key]['goodsId']);
			$orderInfo[$key] = array_merge($orderInfo[$key],$goodsInfo);
		}
		$id = session('id');
		$where = array('user_id'=>$id);
		$add = D('Address')->getList($where);
		$user_add = $add['0'];
		$this->assign('user',$user_add);
		$this->assign('orderInfo',$orderInfo);
		$this->display();
	}
}