<?php
/**
 * 债务人模型类
 */

namespace Model;
class DebtorModel extends BaseModel{
    
    /**
     * 查询债务人信息
     * @param string $username 用户名
     * @param string $idcard 身份证
     * @return mix 
     */
    public function getInfo($username = '',$idcard = '')
    {
        $condition['idcard'] = $idcard;
        $condition['username'] = $username;
        $result = $this->where($condition)->find();
        if(!empty($result))
        {
            return $result;
        }
        return array();
    }
    /**
     * 查询债务人信息
     * @param string $user_id 用户id
     * @return mix 
     */
    public function getInfoById($id)
    {
        $condition['id'] = $id;
        $result = $this->where($condition)->find();
        if(!empty($result))
        {
            return $result;
        }
        return null;
    }
    
    /**
     * 检查记录是否存在 不存在添加
     * 
     * @param string $username 用户名
     * @param string $idcard 身份证
     * @return mix
     */
    public function checkIfHasOne($username = '',$idcard = '')
    {
        $condition['idcard'] = $idcard;
        $result = $this->where($condition)->find();
        if($result)
        {
            return $result['id'];
        }
        $data['username'] = $username;
        $data['idcard'] = $idcard;
        $insert_id = $this->add($data);
        if($insert_id)
        {
            return $insert_id;
        }
        return false;
    }
}