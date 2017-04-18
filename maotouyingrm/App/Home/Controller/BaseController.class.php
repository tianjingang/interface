<?php

namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller {

    public $LOGIN_USER_ID = '';
    public $HUANXIN = '';
    protected function checkLogin()
    {
       
       $header = $this->getallheaders();
       
       $auth_code = $header['Authcode'];
       $user_id = $header['Userid'];
       $this->LOGIN_USER_ID = $user_id;
       if($auth_code)
       {
           $auth_info = M('code')->where(array('user_id'=>$user_id))->order('id desc')->find();
           if($auth_info && $auth_info['code'] == $auth_code)
           {
               $this->LOGIN_USER_ID = $user_id;
               return true;
           }
           else
           {
               outPut('0022');
           }
       }
       outPut('0022');
    }
   
   /**
    * Get all request headers
    * @return array
    */
   protected function getallheaders() {
       foreach ($_SERVER as $name => $value)
       {  
           if (substr($name, 0, 5) == 'HTTP_')   
           {  
               $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;  
           }  
       }
       return $headers;
   }
   protected function flushCache()
   {
       $redisHandle = \Lib\RedisHandler::getInstance();
       $redisHandle->rm(C('CACHE_EARTH_TIME'));
       $redisHandle->rm(C('CACHE_FIND_LIST'));
       $redisHandle->rm(C('CACHE_AGENTCY_LIST'));
   }
   
   //查看是否喜欢
   protected function checkUserLike(&$result)
    {
        $likeModel = model('Likes');
        $optionModel = M('feed_option');
        $header = $this->getallheaders();
        $user_id = $header['Userid'];
        foreach ($result as &$value)
        {
            if(empty($user_id))
            {
                $value['is_like'] = '0';
            }
            else {
                $feedInfo = $likeModel->checkIfLike($user_id,1,$value['id']);
                empty($feedInfo) && $value['is_like'] = '0';
                empty($feedInfo) || $value['is_like'] = '1';
            }
            //当用户登录 类型为议题时
            if($user_id && $value['type'] == 3)
            {
                $optionflag = $optionModel->where(array('feed_id'=>$value['id'],'user_id'=>$user_id))->find();
                if(!empty($optionflag))
                {
                    $value['option_log'] = $optionflag['type'];
                }
            }
            
        }
    }
    
    protected function getHuanxin()
   {
        if(empty($this->HUANXIN))
        {
            include HUANXIN_PATH.'Easemob.class.php';
            $options['client_id']=C('HUANXIN_CLIENT_ID');
            $options['client_secret']=C('HUANXIN_CLIENT_SECRET');
            $options['org_name']=C('HUANXIN_ORG_NAME');
            $options['app_name']=C('HUANXIN_APP_NAME');
    //        print_r($options);
            $this->HUANXIN=new \Easemob($options);
        }
       
   }
   
    //注册环信
    protected function huanxinAdd($phone,$username)
    {
        $this->getHuanxin();
        $this->HUANXIN->getToken();
        $back = $this->HUANXIN->createUser($phone,$username);
        if(!empty($back) && !empty($back['entities']))
        {
            if(!empty($username))
            {
                $this->HUANXIN->editNickname($phone,$username);
            }
            return true;
        }
        return false;
        
    }

    //修改环信用户信息
    protected function huanxinEdit($phone,$username)
    {
        $this->getHuanxin();
        $this->HUANXIN->getToken();
        $userInfo = $this->HUANXIN->getUser($phone);
//        var_dump($userInfo);exit;
        if(!empty($userInfo['entities'][0]['uuid']))
        {
            $this->HUANXIN->editNickname($phone,$username);
        }
        else
        {
            $this->huanxinAdd($phone, $username);
        }
        return true;
    }
    
    //修改环信用户信息
    protected function huanxinCheck($phone,$username)
    {
        $this->getHuanxin();
        $this->HUANXIN->getToken();
        $userInfo = $this->HUANXIN->getUser($phone);
        if(empty($userInfo['entities'][0]['uuid']))
        {
            $this->huanxinAdd($phone, $username);
        }
        return true;
    }
    
    //添加好友
    protected function huanxinAddFriend($phone,$friendPhone)
    {
        $this->getHuanxin();
        $this->HUANXIN->getToken();
        $this->HUANXIN->addFriend($phone,$friendPhone);
    }
    
    //添加好友
    protected function huanxinDelFriend($phone,$friendPhone)
    {
        $this->getHuanxin();
        $this->HUANXIN->getToken();
        $this->HUANXIN->deleteFriend($phone,$friendPhone);
    }
} 