<?php
/**
 * 系统消息
 */

namespace Model;
class SysmsgModel extends BaseModel{
    
    public function insertData($data)
    {
        $flag = $this->add($data);
        return $flag;
    }
    
    public function getUnreadMsg($user_id,$type)
    {
        $condition['user_id'] = $user_id;
        $condition['type'] = $type;
        $condition['status'] = 1;
        return $this->where($condition)->count();
    }
    /**
     * 获取分类消息列表
     * 
     * @param type $user_id
     * @param type $type
     * @param type $order
     * @param type $start
     * @param type $limit
     * @return type
     */
    public function getList($user_id,$type,$order = 'id desc',$start = 0,$limit = 10)
    {
        $condition['user_id'] = $user_id;
        $condition['type'] = $type;
        $result = $this->where($condition)->order($order)->limit($start,$limit)->select();
        $this->where(array('user_id'=>$user_id))->save(array('status'=>2));
        return $result;
    }
}