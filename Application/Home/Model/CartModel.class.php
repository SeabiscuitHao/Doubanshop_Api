<?php
namespace Home\Model;
use Think\Model;
class CartModel extends BaseModel {

	public function getList($where) {
		$res = $this->where($where)->select();
		return $res;
	}

}