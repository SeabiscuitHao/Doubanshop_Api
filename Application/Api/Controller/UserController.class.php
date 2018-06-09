<?php
namespace Api\Controller;
use Think\Controller;
use Api\Model\UserModel;
class UserController extends Controller {

	public function logout() {
		session(null);
		$this->success('注销成功',U('Home/User/login'));
	}
	
	public function doLogin() {
		$res = array(
			'error_no'	=> 0,
			'msg'		=> '',
			'data'		=> array(),
		);
		$phone 		= empty($_POST['phone']) ? '' : $_POST['phone'];
		$password 	= empty($_POST['password']) ? '' : $_POST['password'];
		if (empty($phone) || empty($password)) {
			$res['error_no'] = 1;
			$res['msg']		 = "参数错误";
			echo json_encode($res);die();
		}
		$resTmp = D('User')->getUserInfoByPhone($phone);
		if ($resTmp !== false) {
			if ($resTmp['password'] == $password) {
				
				$token = md5($resTmp['id'] . time() . 'abcdefg');
				$data = array(
					'token'	=> $token,
					'uid'	=> $resTmp['id'],
				);
				$add = D('Token')->add($data);
				
				$res['data']['info']['token'] = $token;
				$res['data']['info']['phone'] = $resTmp['phone'];
				$res['data']['info']['name'] = $resTmp['username']; 
				echo json_encode($res);die();
			} else {
				$res['error_no'] = 2;
				$res['msg']		 = "密码不正确";
				echo json_encode($res);die();
			}
		} else {
			$res['error_no'] = 3;
			$res['msg']		 = "用户不存在";
			echo json_encode($res);die();
		}
	}
	

	public function doReg() {
		$res = array(
			'error_no'	=> 0,
			'msg'		=> 'success',
			'data'		=> array(),
		);
		$data = array(
			'phone' 		=> empty($_POST['phone']) ? '' : $_POST['phone'],
			'username'   	=> empty($_POST['username']) ? '' : $_POST['username'],
			'password' 		=> empty($_POST['password']) ? '' : $_POST['password'],
			'createtime'	=> date("Y-m-d,H:i:s")
		);
		if (empty($data['phone']) || empty($data['username']) || empty($data['password'])) {
			$res['error_no'] = 1;
			$res['msg']		 = "参数错误";
			echo json_encode($res);;die();
		}
		$resTmp = D('User')->add($data);
		if ($resTmp !== false) {
			echo json_encode($res);die();
		} else {
			$res['error_no'] = 1;
			$res['msg']	     = "参数错误";
			echo json_encode($res);die();
		}
	}

}