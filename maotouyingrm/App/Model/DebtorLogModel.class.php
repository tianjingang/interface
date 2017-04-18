<?php
/**
 * 债务人历史模型类
 */

namespace Model;
class DebtorLogModel extends BaseModel{
    
    public function getList($debtor_id = '',$user_id)
    {
        $result = null;
        if(empty($debtor_id) || empty($user_id))
        {
            return $result;
        }
        $condition['debtor_id'] = $debtor_id;
        $result = $this->field('search_date')->where($condition)->select();
        $data['user_id'] = $user_id;
        $data['debtor_id'] = $debtor_id;
        $data['search_date'] = date('Y-m-d',time());
        $this->add($data);
        return $result;
    }
    
    public function getLog($user_id,$start,$limit)
    {
        $result = null;
        if(empty($user_id))
        {
            return $result;
        }
        $condition['user_id'] = $user_id;
        $result = $this->where($condition)->order('id desc')->limit($start,$limit)->select();
        return $result;
    }
}