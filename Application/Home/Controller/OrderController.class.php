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
		// $user_add = $add['0'];
		$pay_type = array(
			array('id'=>1,'name'=>'余额支付'),
			array('id'=>2,'name'=>'微信支付'),
			array('id'=>3,'name'=>'支付宝支付')
		);
		$this->assign('pay_type',$pay_type);
		$this->assign('user',$add);
		$this->assign('orderInfo',$orderInfo);
		$this->display();
	}

	public function createorder () {
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