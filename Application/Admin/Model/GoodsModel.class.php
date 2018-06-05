<?php
namespace Admin\Model;

use Admin\Model\BaseModel;
class GoodsModel extends BaseModel {
    protected $tableName = 'goods';
    public function seveData($where,$data) {
        return $this->where($where)->save($data);
    }
}