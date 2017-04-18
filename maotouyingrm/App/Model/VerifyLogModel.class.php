<?php
/**
 * 验证码日志类
 */

namespace Model;
use \Lib\RedisHandler as RedisHandler;

class VerifyLogModel extends BaseModel{
    
    /**
     * 查询手机号发送验证码次数
     * 
     * @param string $phone 手机号
     * @return int $nums 次数
     */
    public function getTimes($phone = '')
    {
        $reids_handle = RedisHandler::getInstance();
         $today = date('Y-m-d',time());
                $times = $reids_handle->get('send_sms_limit'.$phone.$today);
                $times = intval($times);
                $times++;
                $reids_handle->set('send_sms_limit'.$phone.$today,$times,86400);
                $remote_ip = $_SERVER["REMOTE_ADDR"];
                $remote_ip = str_replace('.', '_', $remote_ip);
                $iptimes = $reids_handle->get($remote_ip.$today);
                $iptimes = intval($iptimes);
                $iptimes++;
                $reids_handle->set($remote_ip.$today,$iptimes,86400);
                if($iptimes > 100)
                {
                    return $iptimes;
                }
                return $times;
    }
    
    public function checkVerify($phone = '',$code = '')
    {
        if(empty($phone) || empty($code))
        {
            return false;
        }
        $condition['phone'] = $phone;
        
        $result = $this->where($condition)->order('id desc')->find();
        
        if(empty($result))
        {
            return false;
        }
        else if($result['code'] != $code)
        {
            return false;
        }
        else
        {
            if(time()-$result['create_time'] > 600)
            {
                return false;
            }
        }
        return true;
    }
}