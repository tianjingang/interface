<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
header("content-type:text/html;charset=utf-8");
class ShowController extends Controller
{
	public  $enableCsrfValidation=false;
    /**
     * 登录页面
     * @inheritdoc
     */
    public function actionIndex(){
        return $this->render('login'); 
    }

    /**
     * 登录接值
     * @return [type] [description]
     */
    public function actionLoginpro(){
          $request=\Yii::$app->request;
          $data = $request->post();
          $token=md5($data['username'].'1');
          //echo $token;die;
          $qingqiu=time();
          //print_r($data);die;
          //去空
          $data1=$this->paraFilter($data);
          //print_r($data1);die;
          //排序
          $data2=$this->argSort($data1);
          //print_r($data2);die;
          //拼接
          $url="http://localhost/dashixun1/dayi/laravel/public/?sname=".$data['username']."&spwd=".$data['pwd']."&qingqiu=".$qingqiu;
          $arr=file_get_contents($url);
          //echo $arr;die;
          $ar=json_decode($arr);
          //print_r($ar);die;
          if($ar->code==1){
	              if(($ar->fanhui-$ar->qingqiu)<=120){
			              	if($ar->token==$token){
			              		echo $ar->message."安全";

			              	}
			              	else{
			              		echo $ar->message."不安全";
			              	}
	              }else{
	              	    echo $ar->message."不安全";
	              }
          }else if($ar->code==0){
                 if(($ar->fanhui-$ar->qingqiu)<=120){
	                   echo $ar->message."安全";
	              }else{
	              	    echo $ar->message."不安全";
	              } 
          }else if($ar->code==2){
                  if(($ar->fanhui-$ar->qingqiu)<=120){
	                   echo $ar->message."安全";
	              }else{
	              	    echo $ar->message."不安全";
	              }
          }
          //echo $qingqiu;die;         
    }


    /**
	 * 除去数组中的空值和签名参数
	 * @param $para 签名参数组
	 * return 去掉空值与签名参数后的新签名参数组
	 */
	function paraFilter($para) {
		$para_filter = array();
		while (list ($key, $val) = each ($para)) {
			if($key == "sign" || $key == "sign_type" || $val == "")continue;
			else	$para_filter[$key] = $para[$key];
		}
		return $para_filter;
	}
	/**
	 * 对数组排序
	 * @param $para 排序前的数组
	 * return 排序后的数组
	 */
	function argSort($para) {
		ksort($para);
		reset($para);
		return $para;
	}

	/**
	 * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
	 * @param $para 需要拼接的数组
	 * return 拼接完成以后的字符串
	 */
	function createLinkstring($para) {
		$arg  = "";
		while (list ($key, $val) = each ($para)) {
			$arg.=$key."=".$val."&";
		}
		//去掉最后一个&字符
		$arg = substr($arg,0,count($arg)-2);
		
		//如果存在转义字符，那么去掉转义
		if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}
		
		return $arg;
	}



}
