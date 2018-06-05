<?php
namespace Home\Model;
use Think\Model;
class BannerModel extends BaseModel {
	public function getBanner() {
		$cache_key = "banner_lists";
		$result = cache_get($cache);
		if (empty($result)) {
			$result = $this->select();
			cache_set($cache_key,$result,300);
		}
		return $result;
	}
}