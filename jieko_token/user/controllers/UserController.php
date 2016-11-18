<?php
/**
 * Created by PhpStorm.
 * User: 张丹
 * Date: 2016/10/30
 * Time: 16:55
 */
namespace app\controllers;
header("content-type:text/html;charset=utf-8");
use Yii;
use yii\web\Controller;
use app\models\User;
use App\Http\Requests;

class UserController extends Controller
{
  // $this->enableCsrfValidation = false;
    //显示登录页面
    public function actionLogin(){
       return $this->render('login');
    }
 //接值，调用接口
    public function actionLogin_pro(){
        $request = yii::$app->request;
        $time = time();
//        echo $time;
        $arr = $request->post();
        unset($arr['_csrf']);
       // 去空
        $arr1 = $this->qukong($arr);
       // 排序
        ksort($arr1);
        //拼接
      $sign='name'."=".$arr1['name'].'&pwd='.$arr1['pwd'].'&time='.$time;
        $sign1=md5($sign);
//        print_r($sign1);die;
        //调接口
        $name=yii::$app->request->post('name');
        $pwd=yii::$app->request->post('pwd');
        $url = "http://localhost/dashixun1/jieko_token/book/public/Book/login1?name=$name&pwd=$pwd&time=$time&sign=$sign1";
//        echo $url;die;
        $str = file_get_contents($url);
        $this->logResult($str);
        $arr = json_decode($str,true);
        $token = $arr['token'];
        if(isset($token)) {
            $session = Yii::$app->session;
            $session['token'] = $token;
            echo "登录成功";
        }
    }
    function logResult($word='') {
        $fp = fopen("css/log.txt","a");
        flock($fp, LOCK_EX) ;
        fwrite($fp,"执行日期：".strftime("%Y%m%d%H%M%S",time())."\n".$word."\n");
        flock($fp, LOCK_UN);
        fclose($fp);
    }

    public function actionLists(){
        echo "123";
    }
       //去空
    public function qukong($arr){
        foreach ($arr as $k => $v) {
            if($v==''){
                unset($arr[$k]);
            }
        }
        return $arr;
    }
    //排序
    public function ksort($arr){
        $arr = ksort($arr);
        return $arr;
    }
    //拼接
    public function pinjie($arr,$time){
        $array = "";
        foreach ($arr as $key => $val) {
            $array .=$key."=".$val."&";
        }
        //去掉最后一个&符号
        $array = substr($array,0,count($array)-2);
        return $array."&time=$time";
    }

}