<?php

namespace Home\Controller;
use Home\Controller\BaseController;
use \Lib\RedisHandler as RedisHandler;
use Qiniu\Auth;
class PublicController extends BaseController {
    
    public function test( $length)
    {
        for($i = 0; $i<=$length;$i++)
        {
            yield $i;
        }
    }
    
    public function go()
    {
        echo auID(2);
//        foreach ($this->test(100) as $key=>$value) {
//            echo $key.'=>'.$value.PHP_EOL;
//        }
//        $guest = function($name)
//        {
//            return $name;
//        };
//        echo $guest('hello world');
    }
    
    public function testPush()
    {
//        jpush(8, array(), C('JIANDU_ADD_SUCESS'));
        echo make_coupon_card();
    }

    public function getQiNiuToken()
    {
        include  QINIU_PATH.'autoload.php';
        $accessKey = 'OG1vorZEhTuWLHI0YAsKWe3ePuGluBOBPoUwsjuu';
        $secretKey = 'tDF9MiNYGXQEgaVs3tvOIdg9Y66hejtFp2644YGA';
        $bucketName = 'flint';
        $auth = new Auth($accessKey, $secretKey);
        $token = $auth->uploadToken($bucketName);
        outPut('0000',$token);
    }


    public function sysData()
    {
        $result['weekData'] = '1221';
        $result['money'] = '123万';
        $result['users'] = '13万+';
        outPut('0000',$result);
    }

    //地区列表
    public function area()
    {
        $areaModel = M('area');
        $p_condition['parentid'] = 0;
        $list = $areaModel->field('areaid,areaname,arrchildid')->where($p_condition)->select();
//        print_r($list);exit;
        foreach ($list as $key=>$value) {
            
            $list[$key]['sonList'] = null;
            $arr_ex = explode(',', $value['arrchildid']);
            if(count($arr_ex) > 1)
            {
                array_shift($arr_ex);
                $s_condition['areaid'] = array('in',$arr_ex);
                $sonList = $areaModel->field('areaid,areaname')->where($s_condition)->select();
                $list[$key]['sonList'] = $sonList;
            }
        }
        outPut('0000',$list);
    }

        /**
     * 发送验证码
     */
    public function sendSMS()
    {
        
        $phone = I('post.phone');//手机号
        $type = I('post.type');//1 注册 2修改密码
        if(empty($phone) || empty($type) || ($type != 1 && $type != 2))
        {
            outPut('0019');
        }
        
        $verify_flag = check_phone($phone);
        
        if($verify_flag != true)
        {
            outPut('0001');
        }
        //查看该手机用户24小时内发验证码次数
        $verifyLogModel = model('VerifyLog');
        $userModel = model('User');
        $time = $verifyLogModel->getTimes($phone);
        if($time > 10)
        {
            outPut('0008');
        }
        //查看该手机号是否注册
        $userInfo = $userModel->getInfoByPhone($phone);
        if($type == 1 && !empty($userInfo))
        {
            outPut('0010');
        }
        if($type == 2 && empty($userInfo))
        {
            outPut('0002');
        }
        $rand_code = randCode(6, 1);
        $url='http://utf8.sms.webchinese.cn/?Uid=mingrenapp&Key=12f872e54d3e67ff83b6&smsMob='.$phone.'&smsText=验证码：'.$rand_code;
        $back = curlGet($url);
//        var_dump($back);
        if($back == 1)
        {
            $data['phone'] = $phone;
            $data['code'] = $rand_code;
            $data['create_time'] = time();
            $insert_id = M('VerifyLog')->add($data,array(),true);
            if($insert_id)
            {
                outPut('0000');
            }
        }
            
      
         
        outPut('0004');
    }


    /**
     * 验证验证码
     */
    public function checkVerify()
    {
        if(!IS_POST)
        {
            outPut('0018');
        }
        $phone = I('post.phone');//手机号
        $code = I('post.code');//验证码
        ////验证必填项是否为空
        if(empty($phone) || empty($code))
        {
            outPut('0019');
        }
        //检测验证码是否正确
        $verifyLogModel = model('VerifyLog');
        $verifyLog = $verifyLogModel->checkVerify($phone,$code);
        if($verifyLog == false)
        {
            outPut('0007');
        }
        outPut('0000');
    }

    /**
     * 用户注册
     */
    public function register()
    {
        if(!IS_POST)
        {
            outPut('0018');
        }
        $roleid = I('post.roleid',1);//1 个人 2 公司
        $phone = I('post.phone','');//手机号
        $password = I('post.password','');//密码
        $code = I('post.code','');//验证码
        $username = I('post.username','');//用户名
        $idcard = I('post.idcard','');//身份证
        $position = I('post.position',0);//地址
        $reg_invitecode = I('post.reg_code',0);//邀请码
        $companyname = I('post.companyname','');//公司名
        $avator = I('post.avator','');//头像
        $companyfile = I('post.companyfile','');//营业执照
        $jpush = I('post.jpush');//pushid
        //验证必填项是否为空
        if(empty($phone) || empty($password) || empty($code))
        {
            outPut('0019');
        }
//        if($password{20}!='' || $password{7}=='')
//        {
//            outPut('0027');
//        }
        //验证手机格式是否正确
        $flag = check_phone($phone);
        $flag == false && outPut('0001');
//        //检测验证码是否正确
        $verifyLogModel = model('VerifyLog');
        $verifyLog = $verifyLogModel->checkVerify($phone,$code);
        if($verifyLog == false)
        {
            outPut('0007');
        }
        //查看该手机是否已经注册
        $userModel = model('User');
        $user_info = $userModel->getInfoByPhone($phone);
        if(!empty($user_info))
        {
            outPut('0010');
        }
        if($idcard)
        {
            $user_info = $userModel->getInfoByIdcard($idcard);
            if(!empty($user_info))
            {
                outPut('0010');
            }
        }
        //如果角色为公司 判断公司名是否已经存在
        if($roleid == 2)
        {
            $company_info = $userModel->getInfoByCompany($companyname);
            if(!empty($company_info))
            {
                outPut('0044');
            }
            $data['companyname'] = $companyname;
            $data['companyfile'] = $companyfile;
        }
        $passsalt = randCode(5);
        $password = md5($password.$passsalt);
        $data['my_invitecode'] = make_coupon_card();
        $data['phone'] = $phone;
        $data['password'] = $password;
        $data['passwordalt'] = $passsalt;
        $data['username'] = $username;
        $data['idcard'] = $idcard;
        $data['position'] = $position;
        $data['reg_invitecode'] = $reg_invitecode;
        $data['avator'] = $avator;
        $data['create_time'] = time();
        $data['jpush'] = $jpush;
        $user_id = $userModel->add($data);
        if($user_id)
        {
             //获取authcode
            $codeModel = model('Code');
            $code_auth = $codeModel->getCode($user_id);
            $userDetail = $userModel->getUserDetail($user_id);
            if(!empty($userDetail))
            {
                $userDetail['authcode'] = $code_auth;
            }
            //注册到环信中
            $add_flag = $this->huanxinAdd($phone, $username);
            if(!$add_flag)
            {
                //记录到数据库中 以后同步
                $huanxin_data['user_id'] = $user_id;
                $huanxin_data['create_time'] = time();
                M('huanxin_log')->add($huanxin_data);
            }
            outPut('0000',$userDetail);
        }
        else
        {
            outPut('0017');
        }
    }
    /**
     * 登录
     */
    public function login()
    {
        if(!IS_POST)
        {
            outPut('0018');
        }
        $phone = I('post.phone');//手机号
        $password = I('post.password'); //密码
        $jpush = I('post.jpush');
        if(empty($phone) || empty($password))
        {
            outPut('0019');
        }
        $flag = check_phone($phone);
        $flag == false && outPut('0001');
        $user_model = model('User');
        $user_info = $user_model->getInfoByPhone($phone);
        if(empty($user_info))
        {
            outPut('0002');
        }
        if($user_info['status'] == 2)
        {
            outPut('0042');
        }
        $check_pass = md5($password.$user_info['passwordalt']);
        if($user_info['password'] != $check_pass)
        {
            outPut('0009');
        }
        //获取authcode
        $codeModel = model('Code');
        $code_auth = $codeModel->getCode($user_info['id']);
        if(empty($code_auth))
        {
            outPut('0023');
        }
        $userInfo = $user_model->getUserDetail($user_info['id'],1);
        if(empty($user_info['idcard']))
        {
            $userInfo['is_complete'] = '0';
        }
        else
        {
            $userInfo['is_complete'] = '1';
        }
        if(!empty($jpush))
        {
            $saveData['jpush'] = $jpush;
            $user_model->where(array('id'=>$user_info['id']))->save($saveData);
        }
        $this->huanxinCheck($phone, $userInfo['username']);
        $userInfo['authcode'] = $code_auth;
//        $result = $userInfo;
        outPut('0000',$userInfo);
    }
    
    //退出
    public function logout()
    {
        $this->checkLogin();
        $user_id = $this->LOGIN_USER_ID;
        if(empty($user_id))
        {
            outPut('0022');
        }
        $codeModel = model('Code');
        $codeModel->where(array('user_id'=>$user_id))->delete();
        outPut('0000');
    }
    
    //修改密码
    public function updatePass()
    {
        $this->checkLogin();
        $user_id = $this->LOGIN_USER_ID;
        if(empty($user_id))
        {
            outPut('0022');
        }
        $old_password = I('post.old_password');//老密码
        $new_password = I('post.new_password');//新密码
         if(empty($old_password) || empty($new_password))
        {
            outPut('0019');
        }
//        if($new_password{20}!='' || $new_password{7}=='')
//        {
//            outPut('0027');
//        }
        if($old_password == $new_password)
        {
            outPut('0029');
        }
        //查看用户密码
        $userModel = model('User');
        
        $result = $userModel->getInfoByUserId($user_id);
        if($result['password'] != md5($old_password.$result['passwordalt']))
        {
            outPut('0028');
        }
        $new_password = md5($new_password.$result['passwordalt']);
        $data['password'] = $new_password;
        $condition['id'] = $user_id;
        $flag = $userModel->saveData($condition,$data);
        if($flag)
        {
            outPut('0000');
        }
        else
        {
            outPut('0030');
        }
    }
    //重置密码
    public function resetPass()
    {
        if(!IS_POST)
        {
            outPut('0018');
        }
        $phone = I('post.phone');//手机号
        $password = I('post.password');//新密码
        $code = I('post.code');//验证码
        //验证必填项是否为空
        if(empty($phone) || empty($password) || empty($code))
        {
            outPut('0019');
        }
        
        //验证手机格式是否正确
        $flag = check_phone($phone);
        $flag == false && outPut('0001');
        //检测验证码是否正确
        // $verifyLogModel = model('VerifyLog');
        // $verifyLog = $verifyLogModel->checkVerify($phone,$code);
        // if($verifyLog == false)
        // {
        //     outPut('0007');
        // }
        //查看该手机是否已经注册
        $userModel = model('User');
        $user_info = $userModel->getInfoByPhone($phone);
        if(empty($user_info))
        {
            outPut('0015');
        }
        $passsalt = randCode(5);
        $password = md5($password.$passsalt);
        $data['password'] = $password;
        $data['passwordalt'] = $passsalt;
        $save_condition['id'] = $user_info['id'];
        
        $usflag = $userModel->saveData($save_condition,$data);
        if($usflag)
        {
            outPut('0000');
        }
        else
        {
            outPut('0038');
        }
    }
    
    public function sysMsg() {
        $this->checkLogin();
        $user_id = $this->LOGIN_USER_ID;
        if(empty($user_id))
        {
            outPut('0022');
        }
        $sysModel = model('Sysmsg');
        $result['sysUnreadMsg'] = $sysModel->getUnreadMsg($user_id,1);
        $result['loanUnreadMsg'] = $sysModel->getUnreadMsg($user_id,2);
        $result['businessUnreadMsg'] = $sysModel->getUnreadMsg($user_id,3);
        outPut('0000',$result);
    }
    
    public function msgList()
    {
        $this->checkLogin();
        $user_id = $this->LOGIN_USER_ID;
        if(empty($user_id))
        {
            outPut('0022');
        }
        $page = I('get.page',1);//页数
        $type = I('get.type',2);//类型
        $limit = 20;
        $start = ($page - 1)*$limit;
        $order = 'id desc';
        $sysModel = model('Sysmsg');
        $result = $sysModel->getList($user_id,$type,$order,$start,$limit);
        foreach ($result as &$value) {
            $value['create_time'] = date('Y-m-d H:i:s',$value['create_time']);
            unset($value['type']);
            unset($value['status']);
            unset($value['obj_id']);
            unset($value['user_id']);
        }
        outPut('0000',$result);
    }
    
    public function setJpush()
    {
        $this->checkLogin();
        $user_id = $this->LOGIN_USER_ID;
        if(empty($user_id))
        {
            outPut('0022');
        }
        $userModel = model('User');
        $jpush = I('post.jpush');
        if(empty($jpush))
        {
            outPut('0000');
        }
        $condition['id'] = $user_id;
        $data['jpush'] = $jpush;
        $userModel->where($condition)->save($data);
        outPut('0000');
    }
}