<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\UserModel;
class UserController extends Controller {
	public function login() {
		return $this->display();
	}

	public function logout() {
		session(null);
		$this->success('注销成功',U('Home/User/login'));
	}
	
	public function doLogin() {
		$phone 		= empty($_POST['phone']) ? '' : $_POST['phone'];
		$password 	= empty($_POST['password']) ? '' : $_POST['password'];
		if (empty($phone) || empty($password)) {
			return $this->error('不要填空');
		}
		$res = D('User')->getUserInfoByPhone($phone);
		if ($res !== false) {
			if ($res['password'] == $password) {
				session('id',$res['id']);
				$this->success('登陆成功',U('Index/index'));
			} else {
				$this->error('密码不正确');
			}
		} else {
			$this->error('用户不存在');
		}
	}
	
	public function reg() {
		return $this->display();
	}
	
	public function doReg() {
		$data = array(
			'phone' 		=> empty($_POST['phone']) ? '' : $_POST['phone'],
			'username'   	=> empty($_POST['username']) ? '' : $_POST['username'],
			'password' 		=> empty($_POST['password']) ? '' : $_POST['password'],
			'createtime'	=> date("Y-m-d,H:i:s")
		);
		if (empty($data['phone']) || empty($data['username']) || empty($data['password'])) {
			return $this->error('不要填空');
		}
		$res = D('User')->add($data);
		if ($res !== false) {
			$this->success('注册成功','login');
		} else {
			$this->error('注册失败');
		}
	}
	
	public function people() {
		$id = session('id');
		if (empty($id)) {
			$this->error('请先登录',U('Home/User/login'));
		}
		$userInfo = D('User')->where(array('id'=>$id))->find();
		$this->assign('userInfo',$userInfo);
		$this->display();
	}
}