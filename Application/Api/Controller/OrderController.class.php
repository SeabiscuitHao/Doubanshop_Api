<?php
namespace Api\Controller;
use Think\Controller;
class OrderController extends Controller {
	
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
		$userId = I('post.id');
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


	public function confirm() {
		$res = array(
			'error_no' => 0,
			'msg'	   => '',
			'data'	   => array()
		);
		$oid  = I('get.oid','');
		$list = D('orderTmp')->getBasicInfo($oid);
		$orderInfo = json_decode($list['goods_info'],true);
		foreach ($orderInfo as $key => $value) {
			$goodsInfo = D('Goods')->getBasicInfo($orderInfo[$key]['goodsId']);
			$orderInfo[$key] = array_merge($orderInfo[$key],$goodsInfo);
			$tags = D('Tags')->where(array('id'=>$orderInfo[$key]['tag_id']))->find();
			$tag_name = $tags['tag'];
			$res['data']['goods_lists'][$key] = array(
				'id'	=> $orderInfo[$key]['goodsId'],
				'title' => $orderInfo[$key]['goods_name'],
				'image' => $orderInfo[$key]['image'],
				'desc'	=> $orderInfo[$key]['goods_info'],
				'price' => $orderInfo[$key]['price'],
				'tag'	=> $tag_name,
				'num'	=> $orderInfo[$key]['count']
			);
		}
		$id = session('id');
		$where = array('user_id'=>$id);
		$add = D('Address')->getList($where);
		$res['data']['address'] = $add;
		$res['data']['pay_type'] = array('id'=>1,'name'=>'余额支付','icon'=>'');
		echo json_encode($res);die();
	}


	public function create () {
		$oid = I('post.oid','');
		$aid = I('post.aid','');
		$pid = I('post.pid','');
		$uid = session('id');
		$res = array(
			'error_no' => 0,
			'msg'	   => '',
			'data'	   => array()
		);
		
		if (empty($uid) || empty($oid) || empty($aid) || empty($pid)) {
			$res['error_no'] = 1;
			$res['msg'] = "参数错误";
			echo json_encode($res);
			die();
		}
		$list = D('orderTmp')->getBasicInfo($oid);
		$orderInfo = json_decode($list['goods_info'],true);
		$money = 0;
		foreach ($orderInfo as $key => $value) {
			$goodsInfo = D('Goods')->getBasicInfo($orderInfo[$key]['goodsId']);
			$goodsInfo['orderMoney'] = $value['count'] * $goodsInfo['price'];
			$orderInfo[$key] = array_merge($orderInfo[$key],$goodsInfo);
			$money += $goodsInfo['orderMoney'];
		}
		$orderData = array(
			'user_id' => $uid,
			'money' => $money,
			'address_id' => $aid,
			'pay_type' => $pid,
			'createtime' => date('Y-m-d H:i:s'),
			);
		$orderId = D('order')->add($orderData);
		if ($orderId) {
			foreach ($orderInfo as $key => $value) {
				$goodsData = array(
					'order_id' 		=> $orderId,
					'goods_id' 		=> $value['goodsId'],
					'goods_price' 	=> $value['price'],
					'goods_num' 	=> $value['count'],
					'order_money' 	=> $value['orderMoney'],
					'createtime' 	=> date('Y-m-d H:i:s'),
					);
				D('OrderGoods')->add($goodsData);
			}
			$db = M();
            $db->startTrans();
			$accountStatus = D('user')->handleAccount($uid, $money, 2); 
			$orderStatus   = D('order')->where(array('id'=>$orderId))->save(array('pay_status'=>1,'status'=>1));

			if ($accountStatus && $orderStatus) {
				$db->commit();  
			} else {
				$db->rollback();  
				$res['error_no'] = 2;
				$res['msg'] = "余额不足";
				echo json_encode($res);
				die();
			}
			//
		} else {
			$res['error_no'] = 3;
			$res['msg'] = "下单失败";
			echo json_encode($res);
			die();
		}
		$res['data']['id'] = $orderId;
		echo json_encode($res);
		die();
	}

}