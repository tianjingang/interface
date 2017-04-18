<?php
/**
 * 用户模型类
 */

namespace Model;
use \Lib\RedisHandler as RedisHandler;

class UserModel extends BaseModel{
    
    /**
     * 根据手机号获取用户信息
     * 
     * @param  string $phone 手机号
     * @return mix $result 结果集
     */
    public function getInfoByPhone($phone = '')
    {
        if(empty($phone))
        {
            return null;
        }
        $condition['phone'] = $phone;
        $result = $this->where($condition)->find();
        return $result;
    }
    
    /**
     * 根据用户id获取联系方式
     * 
     * @param  string $user_id 用户id
     * @return mix $result 结果集
     */
    public function getInfoByUserId($user_id = '')
    {
        if(empty($user_id))
        {
            return null;
        }
        $condition['id'] = $user_id;
        $result = $this->field('id,phone,password,passwordalt')->where($condition)->find();
        return $result;
    }
    
    /**
     * 根据身份证获取用户信息
     * 
     * @param  string $idcard 身份证
     * @return mix $result 结果集
     */
    public function getInfoByIdcard($idcard = '')
    {
        if(empty($idcard))
        {
            return null;
        }
        $condition['idcard'] = $idcard;
        $result = $this->where($condition)->find();
        return $result;
    }
    /**
     * 获取公司信息
     * 
     * @param  string $company 公司名
     * @return mix $result 结果集
     */
    public function getInfoByCompany($company = '')
    {
        if(empty($company))
        {
            return null;
        }
        $condition['companyname'] = $company;
        $result = $this->where($condition)->find();
        return $result;
    }
    
    public function getUserDetail($user_id)
    {
        if(empty($user_id))
        {
            return null;
        }
        $where['id'] = $user_id;
        $userDetail = $this->field('id,phone,username,companyname,roleid,avator,companyfile,location,my_invitecode,reg_invitecode,status')->where($where)->find();
        if(empty($userDetail))
        {
            return null;
        }
        if($userDetail['avator'])
        {
            $userDetail['avator'] = C('FILE_URL').$userDetail['avator'];
        }
        if($userDetail['companyfile'])
        {
            $userDetail['companyfile'] = C('FILE_URL').$userDetail['companyfile'];
        }
        if(!empty($userDetail['reg_invitecode']))
        {
            $invitInfo = $this->field('username')->where(array('my_invitecode'=>$userDetail['reg_invitecode']))->find();
            $userDetail['invit_username'] = $invitInfo['username'];
        }
        return $userDetail;
    }
    
    public function checkUserName($username = '')
    {
        $condition['username'] = $username;
        $flag = $this->where($condition)->find();
        if($flag)
        {
            return $flag;
        }
        return null;
    }
    
    /**
     * 保存信息
     * 
     * @param type $condition
     * @param type $data
     * @return boolean
     */
    public function saveData($condition,$data)
    {
        if(empty($condition) || empty($data))
        {
            return false;
        }
        return $this->where($condition)->save($data);
    }
    
    
}