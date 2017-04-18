<?php

namespace Home\Controller;
use Home\Controller\BaseController;
class UserController extends BaseController {
    
    //完善资料
   public function save()
   {
       if(!IS_POST)
        {
            outPut('0018');
        }
        $this->checkLogin();
        $user_id = $this->LOGIN_USER_ID;
        $username = I('post.username');//用户名称
        $idcard = I('post.idcard');//身份证
        $position = I('post.position');//位置
        $reg_invitecode = I('post.code');//邀请码
        $avator = I('post.avator');//头像
        if(!empty($username))
        {
            $data['username'] = $username;
        }
        if(!empty($idcard))
        {
            $data['idcard'] = $idcard;
        }
        if(!empty($position))
        {
            $data['position'] = $position;
        }
        if(!empty($reg_invitecode))
        {
            $data['reg_invitecode'] = $reg_invitecode;
        }
        if(!empty($avator))
        {
            $data['avator'] = $avator;
        }
        if(empty($data) || empty($user_id))
        {
            outPut('0019');
        }
        
        $userModel = model('User');
        //查看是否有该用户
        $condition['id'] = $user_id;
        $userDetail = $userModel->getInfoByUserId($user_id);
        if(empty($userDetail))
        {
            outPut('0038');
        }
        $flag = $userModel->saveData($condition,$data);
        if($flag)
        {
            $this->huanxinEdit($userDetail['phone'], $username);
            outPut('0000');
        }
        outPut('0038');
   }
   
   //获取用户详情
   public function getUserInfo()
   {
       if(!IS_GET)
        {
            outPut('0018');
        }
        $this->checkLogin();
        $user_id = $this->LOGIN_USER_ID;
        $userModel = model('User');
        $userInfo = $userModel->getUserDetail($user_id);
        unset($userInfo['phone']);
        $areaModel = M('area');
        if($userInfo['location'])
        {
            $p_condition['areaid'] = $userInfo['location'];
            $areaInfo = $areaModel->where($p_condition)->find();
            $userInfo['city'] = $areaInfo['areaname'];
            $p_exp = explode(',', $areaInfo['arrparentid']);
            if(count($p_exp) > 1)
            {
                $exp =  $p_exp[1];
                $p_condition['areaid'] = $exp;
                $pareaInfo = $areaModel->where($p_condition)->find();
                $userInfo['arrparentid'] = $exp;
                $userInfo['provice'] = $pareaInfo['areaname'];
            }
//            $userInfo['provice'] = $areaInfo['areaname'];
           
        }
        outPut('0000',$userInfo);
   }
   
   //个人转企业
   public function userToCompany()
   {
       if(!IS_POST)
        {
            outPut('0018');
        }
        $this->checkLogin();
        $user_id = $this->LOGIN_USER_ID;
        $companyname = I('post.companyname');//公司名
        $phone = I('post.phone','');//手机号
        $code = I('post.code','');//验证码
        $companyfile = I('post.companyfile','');//营业执照
        //获取用户详情
        $userModel = model('User');
        $userDetail = $userModel->getUserDetail($user_id);
        if($userDetail['roleid'] != 1)
        {
            outPut('0046');
        }
         //验证手机格式是否正确
        $flag = check_phone($phone);
        $flag == false && outPut('0001');
        if($phone != $userDetail['phone'])
        {
            outPut('0047');
        }
//        //检测验证码是否正确
        $verifyLogModel = model('VerifyLog');
//        $verifyLog = $verifyLogModel->checkVerify($phone,$code);
//        if($verifyLog == false)
//        {
//            outPut('0007');
//        }
        $data['companyname'] = $companyname;
        $data['companyfile'] = $companyfile;
        $data['roleid'] = 3;
        $condition['id'] = $user_id;
        $flag = $userModel->where($condition)->save($data);
        if($flag)
        {
            outPut('0000');
        }
        outPut('0038');
   }
   
   //历史查询
   public function searchLog()
   {
      
        $this->checkLogin();
        $user_id = $this->LOGIN_USER_ID;
        $page = I('get.page',1);//第几页
        $limit = 20;
        $start = ($page - 1)*$limit;
        
         //被查询历史记录
        $debtorLogModel = model('DebtorLog');
        $result = $debtorLogModel->getLog($user_id,$start,$limit);
        if(empty($result))
        {
            outPut('0000');
        }
        $debtorModel = model('Debtor');
        foreach ($result as &$value) {
            $debtorInfo = $debtorModel->getInfoById($value['debtor_id']);
            $value['debtor_name'] = $debtorInfo['username'];
            $value['is_read'] = '1';
            
        }
        
        outPut('0000',$result);
   }
}