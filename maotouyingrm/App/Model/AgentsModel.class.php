<?php
/**
 * 特工模型类
 */

namespace Model;
class AgentsModel extends BaseModel{
    
    public function getAllIds()
    {
        $ids = $this->select();
        $ids_arr = array_column($ids, 'user_id');
        return $ids_arr;
    }
    
    public function getList($type = 1)
    {
        $condition['type'] = $type;
        $order = 'mix asc,id asc';
        $result = $this->where($condition)->order($order)->select();
        if(empty($result))
        {
            return array();
        }
        $this->valueShow($result);
        return $result;
    }
    public function checkIfExist($user_id = '')
    {
        if(empty($user_id))
        {
            return false;
        }
        $result = $this->where(array('user_id'=>$user_id))->find();
        if(!empty($result))
        {
            return true;
        }
        return false;
    }

    private function valueShow(&$result)
    {
        $userModel = model('User');
        $img_cdn_url = C('IMG_CDN_URL');
        foreach ($result as &$value)
        {
            if($value['files'])
            {
                $files = json_decode($value['files']);
                foreach ($files as &$v) {
                    $v = $img_cdn_url.$v;
                }
                $value['files'] = $files;
            }
            $value['type'] == 1 && $agent_level = '初级特工';
            $value['type'] == 2 && $agent_level = '中级特工';
            $value['type'] == 3 && $agent_level = '高级特工';
            $value['agent_level'] = $agent_level;
            $userInfo = $userModel->getUserDetail($value['user_id'],0);
            $value['avator'] = $userInfo['avator'];
            $value['username'] = $userInfo['username'];
            $value['qr_code'] = $userInfo['qr_code'];
        }
    }
}