<?php
/**
 * 基类model
 */

namespace Model;
use Think\Model;
//use Think\Page as Page;

class BaseModel extends Model {
    protected $tableName = '';
    
    public function setFieldVal($condition,$field = '',$type = 1,$step = 1)
    {
        
    }
}