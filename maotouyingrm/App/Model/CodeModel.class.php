<?php
/**
 * 用户模型类
 */

namespace Model;
class CodeModel extends BaseModel{
    
    public function getCode($user_id = '')
    {
        if(empty($user_id))
        {
            return false;
        }
        $code = randCode(32);
        $data['user_id'] = $user_id;
        $data['code'] = $code;
        $flag = $this->add($data, array(), true);
        if($flag)
        {
            return $code;
        }
        return false;
    }
    
}