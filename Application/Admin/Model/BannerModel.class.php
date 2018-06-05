<?php
namespace Admin\Model;

use Admin\Model\BaseModel;
class BannerModel extends BaseModel {
    protected $tableName = 'banner';
    public function seveData($where,$data) {
        return $this->where($where)->save($data);
    }
}