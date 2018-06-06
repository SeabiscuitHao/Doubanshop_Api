<?php
namespace Home\Model;
use Think\Model;
class UserModel extends BaseModel {
	public function getUserInfoByPhone($phone) {
		$res = $this->where(array('phone'=>$phone))->find();
		// var_dump($res);die();
		if ($res) {
			return $res;
		} else {
			return false;
		}
	}
	public function handleAccount($uid, $money=0, $type=1) {
        if ($type == 1) {
            //加钱
            $status = $this->where(array('id'=>$uid))->setInc('account',$money); 
        } else {
            $userInfo = $this->getBasicInfo($uid);
            if ($userInfo['account'] < $money) {
                return false;
            }
            //减钱
            $status = $this->where(array('id'=>$uid))->setDec('account',$money); 
        }
        return $status;
    }
}