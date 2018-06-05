<?php
namespace Api\Controller;

use Think\Controller;

class AddressController extends Controller {

	public function add() {
		$res = array(
			'error_no'	=> 0,
			'msg'		=> '',
			'data'		=> array()
		);
		$data = array(
			'user_id'		=> session('id'),
			'username'		=> I('username',''),
			'phone'			=> I('phone',''),
			'province'		=> I('province',''),
			'city'			=> I('city',''),
			'area'			=> I('area',''),
			'info'			=> I('info',''), 
			'createtime'	=> date('Y-m-d,H:i:s'),
		);
		if (empty($data['user_id'])) {
			$res['error_no'] = 1;
			$res['msg']		 = "参数错误";
			echo json_encode($res);die();
		}
		$resTmp = D('Address')->add($data);
		if ($resTmp) {
			$res['data']['info'] = $data;
			echo json_encode($res);die();
		} else {
			$res['error_no'] = 2;
			$res['msg']	     = "添加失败";
			echo json_encode($res);die();
		}
	}

	public function edit($id) {
		$info = D('Address')->where(array('id'=>$id))->find();
		$this->assign('info',$info);
		$this->display();
	}

	public function del($id) {
		$del = D('Address')->where(array('id'=>$id))->delete();
		if ($del) {
			$this->success('删除成功');
		} else {
			$this->error('删除失败');
		}
	}
}