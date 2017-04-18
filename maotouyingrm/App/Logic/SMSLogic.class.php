<?php
namespace Logic;
/**
* 短信通道
*/
class SMSLogic extends BaseLogic {
    public $url;
    public $sdkappid;
    public $appkey;
    
    // 全部参数使用字符串即可
    function sendQQSms($nationCode, $phoneNumber, $content) {
        $this->url = "https://yun.tim.qq.com/v3/tlssmssvr/sendsms";
        $this->sdkappid = '1400019647';
        $this->appkey = '5117977bd752dc402661aed0890f7b82';
        $randNum = rand(100000, 999999);
        $wholeUrl = $this->url."?sdkappid=".$this->sdkappid."&random=".$randNum;
//        echo $wholeUrl;
        $tel = new \stdClass();
        $tel->nationcode = $nationCode;
        $tel->phone = $phoneNumber;
        $jsondata = new \stdClass();
        $jsondata->tel = $tel;
        $jsondata->type = "0";
        $jsondata->msg = $content;
        $jsondata->sig = md5($this->appkey.$phoneNumber);
        $jsondata->extend = "";     // 根据需要添加，一般保持默认
        $jsondata->ext = "";        // 根据需要添加，一般保持默认
        $curlPost =json_encode($jsondata);
//        echo $curlPost;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $wholeUrl);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $ret = curl_exec($ch);
        if($ret === false) {
//            var_dump(curl_error($ch));
            return false;
        } else {
            $json = json_decode($ret);
            curl_close($ch);
            return $json;
//            if($json === false) {
////                var_dump($ret);
//            } else {
////                var_dump($json);
//                return true;
//            }
        }
        curl_close($ch);
        return;
    }
    // 全部参数使用字符串即可
    /**
     *  {
  ["result"]=>
  int(0)
  ["msg"]=>
  string(0) ""
  ["data"]=>
  object(stdClass)#9 (3) {
    ["id"]=>
    int(2271)
    ["text"]=>
    string(15) "火星情报局"
    ["status"]=>
    int(1)
  }
}
     * 
     */
    function addQQSig() {
        
        $this->url = "https://yun.tim.qq.com/v3/tlssmssvr/add_sign";
        $this->sdkappid = '1400019647';
        $this->appkey = '5117977bd752dc402661aed0890f7b82';
        $randNum = rand(100000, 999999).'';
        $wholeUrl = $this->url."?sdkappid=".$this->sdkappid."&random=".$randNum;
        echo $wholeUrl;
        $jsondata = new \stdClass();
        $jsondata->rand = $randNum;
        $jsondata->time = time();
        $jsondata->sig = hash("sha256", 'appkey='.$this->appkey.'&rand='.$randNum.'&time='.time());
        $jsondata->text = "火星情报局";     // 根据需要添加，一般保持默认
        $curlPost =json_encode($jsondata);
        echo $curlPost;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $wholeUrl);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $ret = curl_exec($ch);
        if($ret === false) {
            var_dump(curl_error($ch));
        } else {
            $json = json_decode($ret);
            if($json === false) {
                var_dump($ret);
            } else {
                var_dump($json);
            }
        }
        curl_close($ch);
        return;
    }
    /**
     * 
     * {
  ["result"]=>
  int(0)
  ["msg"]=>
  string(0) ""
  ["data"]=>
  object(stdClass)#9 (4) {
    ["id"]=>
    int(5794)
    ["text"]=>
    string(38) "验证码：{1}，10分钟内有效。"
    ["status"]=>
    int(1)
    ["type"]=>
    int(0)
  }
}
     */
    function addQQTpl() {
        
        $this->url = "https://yun.tim.qq.com/v3/tlssmssvr/add_template";
        $this->sdkappid = '1400019647';
        $this->appkey = '5117977bd752dc402661aed0890f7b82';
        $randNum = rand(100000, 999999).'';
        $wholeUrl = $this->url."?sdkappid=".$this->sdkappid."&random=".$randNum;
        echo $wholeUrl;
        $jsondata = new \stdClass();
        $jsondata->rand = $randNum;
        $jsondata->time = time();
        $jsondata->sig = hash("sha256", 'appkey='.$this->appkey.'&rand='.$randNum.'&time='.time());
        $jsondata->text = "验证码：{1}，10分钟内有效。";     // 根据需要添加，一般保持默认
        $jsondata->type = 0;
        $curlPost =json_encode($jsondata);
        echo $curlPost;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $wholeUrl);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $ret = curl_exec($ch);
        if($ret === false) {
            var_dump(curl_error($ch));
        } else {
            $json = json_decode($ret);
            if($json === false) {
                var_dump($ret);
            } else {
                var_dump($json);
            }
        }
        curl_close($ch);
        return;
    }
}
