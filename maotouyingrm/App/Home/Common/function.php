<?php
function error_code(){
	return array(
		'0000' => '成功',
		'0001' => '手机号格式不正确',
		'0002' => '该手机号未注册',
		'0003' => '验证码添加失败',
		'0004' => '验证码发送失败',
		'0005' => '验证码不存在',
		'0006' => '验证码超时',
		'0007' => '验证码输入不正确或超时',
		'0008' => '今日发送次数已超过10次，24小时后再试',
                '0009' => '您输入的手机号或密码错误，请重新输入',
                '0010' => '该手机号已经注册',
                '0011' => 'code 为空',
                '0012' => '用户id为空，请登录后操作',
                '0013' => 'Token 为空',
                '0014' => '微信用户信息获取失败',
                '0015' => '用户不存在',
                '0016' => '第三方登录失败',
                '0017' => '操作失败',
                '0018' => '请求方式错误',
                '0019' => '必填项不能为空',
                '0020' => '添加失败',
                '0021' => '不存在或已经被删除',
                '0022' => '权限验证失败',
                '0023' => '秘钥插入失败',
                '0024' => '昵称限制字数为10个以内',
                '0025' => '资料不完善',
                '0026' => '请填写昵称',
                '0027' => '请输入8-20位密码',
                '0028' => '旧密码输入错误',
                '0029' => '新密码和旧密码一样',
                '0030' => '密码修改失败',
                '0031' => '网络不太通畅，请稍候重试',
                '0032' => '字数超限，最多150字',
                '0033' => '该评论不存在或无权删除',
                '0034' => '评论删除失败',
                '0035' => '收藏失败',
                '0036' => '举报失败',
                '0037' => '投票失败',
                '0038' => '操作失败',
                '0039' => '该昵称已经被人使用',
                '0040' => '一分钟内最多可以发1条帖子',
                '0041' => '昵称包含特殊字符',
                '0042' => '该账号禁止登陆',
                '0043' => '账号在另外一台设备登录，请重新登录',
                '0044' => '公司名已经存在',
                '0045' => '个人用户无法添加员工',
                '0046' => '已经该用户已经注册为公司',
                '0047' => '必须和注册手机号一致',
                '0048' => '关系错误',
                '0049' => '已经是公司员工',
                '0050' => '暂无此人信息',
                '0051' => '不允许添加自己为员工'
	);
}
function outPut($code,$data = '')
{
	$code_arr = error_code();
	
	$info = $code_arr[$code]?$code_arr[$code]:'';
	
	$data = empty($data)?null:$data;
	
	$result = array(
		'status' => $code,
		'info'   => $info,
		'data'   => $data
	);
    
    die(json_encode($result));
}

function outPutJsonp($code,$data = '')
{
    $callback = $_REQUEST['callback']?$_REQUEST['callback']:'jsonpCallback';
	$code_arr = error_code();
	
	$info = $code_arr[$code]?$code_arr[$code]:'';
	
	$data = empty($data)?null:$data;
	
	$result = array(
		'status' => $code,
		'info'   => $info,
		'data'   => $data
	);
    
    die($callback . "(" . json_encode($result). ")");
}

function dcurl($url, $par = '') {
	if(function_exists('curl_init')) {
		$cur = curl_init($url);
		if($par) {
			curl_setopt($cur, CURLOPT_POST, 1);
			curl_setopt($cur, CURLOPT_POSTFIELDS, $par);
		}
		curl_setopt($cur, CURLOPT_REFERER, DT_PATH);
		curl_setopt($cur, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		curl_setopt($cur, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($cur, CURLOPT_HEADER, 0);
		curl_setopt($cur, CURLOPT_TIMEOUT, 30);
		curl_setopt($cur, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($cur, CURLOPT_RETURNTRANSFER, 1);
		$rec = curl_exec($cur);
		curl_close($cur);
		return $rec;
	}
//	return file_get($par ? $url.'?'.$par : $url);
        return @file_get_contents($par ? $url.'?'.$par : $url);
}

//正则验证手机格式
function check_phone($phone){
	if(!preg_match('/^[1][134578][0-9]{9}$/',$phone) || empty($phone)) {
		return false;
	}else{
		return true;
	}
}

//根据生日计算年龄
function getAge($birthday){
        if(empty($birthday)){
            return '';
        }
        $age = date('Y', time()) - date('Y', strtotime($birthday)) - 1;  
        if (date('m', time()) == date('m', strtotime($birthday))){  
            if (date('d', time()) >= date('d', strtotime($birthday))){  
                $age++;  
            }  
        }elseif (date('m', time()) > date('m', strtotime($birthday))){  
            $age++;  
        }  
        return $age; 
    }
 //根据生日计算星座
function getStar($birthday){
        if(empty($birthday)){
            return '';
        }
        $month = date('m', strtotime($birthday));
        $day = date('d', strtotime($birthday));
        $signs = array(
            array('20'=>1), array('19'=>2),
            array('21'=>3), array('20'=>4),
            array('21'=>5), array('22'=>6),
            array('23'=>7), array('23'=>8),
            array('23'=>9), array('24'=>10),
            array('23'=>11), array('22'=>12)
        );
        $key = (int)$month - 1;
        list($startSign, $signName) = each($signs[$key]);
        if( $day < $startSign ){
            $key = $month - 2 < 0 ? $month = 11 : $month -= 2;
            list($startSign, $signName) = each($signs[$key]);
        }
        return $signName;
    }
    
    /**
    * Get all request headers
    * @return array
    */
   function getallheaders() {
       foreach ($_SERVER as $name => $value)
       {  
           if (substr($name, 0, 5) == 'HTTP_')   
           {  
               $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;  
           }  
       }
       return $headers;
   }
   /**
    * PHP获取字符串中英文混合长度 
    * @param $str string 字符串
    * @param $$charset string 编码
    * @return 返回长度，1中文=1位，2英文=1位
    */
    function strLength($str,$charset='utf-8'){
    if($charset=='utf-8') $str = iconv('utf-8','gb2312',$str);
    $num = strlen($str);
    $cnNum = 0;
    for($i=0;$i<$num;$i++){
    if(ord(substr($str,$i+1,1))>127){
    $cnNum++;
    $i++;
    }
    }
   
    if($cnNum == 0 && $num !=0)
    {
        
        $number = $num;
    }elseif ($cnNum != 0 && $num !=0) {
        $enNum = $num-($cnNum*2);
        $number = $enNum+$cnNum;
    }
    else
    {
        $enNum = $num-($cnNum*2);
        $number = ($enNum/2)+$cnNum;
    }
    return ceil($number);
    }
    
    function curlGet($url)
    {
        if(function_exists('file_get_contents'))
        {
            $file_contents = file_get_contents($url);
        }
        else
        {
            $ch = curl_init();
            $timeout = 5;
            curl_setopt ($ch, CURLOPT_URL, $url);
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $file_contents = curl_exec($ch);
            curl_close($ch);
        }
        return $file_contents;
    }
    
    function jpush($user_id,$extras,$content)
    {
        $userInfo = M('user')->field('jpush')->where(array('id'=>$user_id))->find();
        $jpushid = $userInfo['jpush'];
        if(!empty($jpushid))
        {
            $pushLogic = logic('Jpush');
            $receiver = array('registration_id'=>array($jpushid));
            $msg_type = 1;
            $title = $content;
            $message = $content;
            $res = $pushLogic->pushMessage($title,$message,$receiver,$msg_type,$extras,$m_time='86400',$platform='all');
            if($_GET['test'] == 1)
            var_dump($res);
        }
        
       

    }
    
     function make_coupon_card() {
            $code = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $rand = $code[rand(0,25)]
                .strtoupper(dechex(date('m')))
                .date('d').substr(time(),-5)
                .substr(microtime(),2,5)
                .sprintf('%02d',rand(0,99));
            for(
                $a = md5( $rand, true ),
                $s = '0123456789ABCDEFGHIJKLMNOPQRSTUV',
                $d = '',
                $f = 0;
                $f < 5;
                $g = ord( $a[ $f ] ),
                $d .= $s[ ( $g ^ ord( $a[ $f + 8 ] ) ) - $g & 0x1F ],
                $f++
            );
            return $d;
        }
        
        function auID($autoID)
        {
            $autoID = $autoID;
            $autoCharacter = array("1","2","3","4","5","6","7","8","9","A","B","C","D","E");
            $len = 7-((int)log10($autoID) + 1);
            $i=1;
            $numberID = mt_rand(1, 2).mt_rand(1, 4);
            for($i;$i<=$len-1;$i++)
            {
                $numberID .= $autoCharacter[mt_rand(1, 13)];
            }

            return base_convert($numberID."E".$autoID, 16, 10);
            //--->这里因为autoid永远不可能为E所以使用E来分割保证不会重复
        }