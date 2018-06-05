<?php
namespace Home\Model;
use Think\Model;
class UserModel extends Model {
	public function getUserInfoByPhone($phone) {
		$res = $this->where(array('phone'=>$phone))->find();
		// var_dump($res);die();
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}
}