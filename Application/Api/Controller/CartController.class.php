<?php
namespace Api\Controller;

use Think\Controller;

class CartController extends Controller {

	public function addcart() {
		$res = array(
			'error_no'	=> 0,
			'msg'		=> '',
			'data'		=> array(),
		);
		if (!session('id')) {
			$res['error_no'] = 2;
			$res['msg']		 = "请先登录";
			echo json_encode($res);die();
		}
		$id = I('post.goods_id','');
		$price = I('post.price','');
		$count = I('post.count','');
		$data = array(
			'image'			=> I('post.image',''),
			'goods_id'		=> I('post.goods_id',''),
			'goods_name'	=> I('post.goods_name',''),
			'goods_price'	=> $price,
			'goods_num'		=> $count,
			'user_id'		=> session('id'),
			'createtime'	=> date("Y-m-d,H:i:s")
		);
		if (empty($id)) {
			$res['error_no'] = 1;
			$res['msg']      = '参数错误';
			echo json_encode($res);die();
		}

		$where = array(
			'user_id'		=> session('id'),
			'goods_id'		=> $id, 
		);
		$str = D('Cart')->getList($where);
		if (!empty($str)) {
			$data = array(
				'goods_num' => $str['0']['goods_num']+$count,
			);
			$cart = D('Cart')->where(array('id'=>$str['0']['id']))->save($data);
		} else {
			$cart = D('Cart')->add($data);
		}
		if ($cart) {
			$res['error_no'] = 0;
			$res['msg']      = '';
			$res['data']     = $data;
			echo json_encode($res);die();
		} else {
			$res['error_no'] = 3;
			$res['msg']      = '添加失败';
			echo json_encode($res);die();
		}
	}

	public function cartlist() {
		$res = array(
			'error_no'	=> 0,
			'msg'		=> 'success',
			'data'		=> array(),
		);
		$id = session('id');
		if (!session('id')) {
			$res['error_no'] = 2;
			$res['msg']		 = "请先登录";
			echo json_encode($res);die();
		}
		$cartList = D('Cart')->where(array('user_id'=>$id))->select();
		if (empty($cartList)) {
			$res['error_no'] = 1;
			$res['msg']		 = "参数错误";
			echo json_encode($res);die();
		} else {
			$res['data']['cart'] = $cartList;
			echo json_encode($res);
			die();
		}
	}


	public function edit() {
		$res = array(
			'error_no'	=> 0,
			'msg'		=> '',
			'data'		=> array()
		);
		$cid 	= I('post.id','');
		$is_add = I('post.is_add','');
		if(empty($cid)) {
			$res['error_no'] = 1;
			$res['msg']		 = '参数错误';
			echo json_encode($res);die();
		}
		$info = D('Cart')->where(array('id'=>$cid))->find();
		if ($is_add == 1) {
			$info['goods_num'] += 1;
			$save = D('Cart')->where(array('id'=>$cid))->save($info);
			if ($save) {
				echo json_encode($res);die();
			} else {
				$res['error_no'] = 2;
				$res['msg']		 = "参数错误";
				echo json_encode($res);die();
			}
		} else {
			$info['goods_num'] -= 1;
			$save = D('Cart')->where(array('id'=>$cid))->save($info);
			if ($save) {
				echo json_encode($res);die();
			} else {
				$res['error_no'] = 2;
				$res['msg']		 = "参数错误";
				echo json_encode($res);die();
			}
		}
	}

	public function del() {
		$res = array(
			'error_no'	=> 0,
			'msg'		=> 'success',
			'data'		=> array(),
		);
		$id = I('post.id','');
		if (empty($id)) {
			$res['error_no'] = 1;
			$res['msg']		 = "参数错误";
			echo json_encode($res);die();
		}
		$delCart = D('Cart')->where(array('id'=>$id))->delete();
		if (empty($delCart)) {
			$res['error_no'] = 2;
			$res['msg']		 = "删除失败";
			echo json_encode($res);die();
		}
		echo json_encode($res);die();
	}
}