<?php
/**
 * Created by PhpStorm.
 * User: 张丹
 * Date: 2016/10/30
 * Time: 17:32
 */
namespace App\Http\Controllers;
header("content-type:text/html;charset=utf-8");
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
header("content-type:text/html;charset=utf8");
class BookController extends Controller
{
    //登录接口
    public function login1(Request $request){
        $time2 = time();
         $name = $request->input('name');
        //echo $name;die;
         $pwd = $request->input('pwd');
         $time = $request->input('time');
         $sign = $request->input('sign');
         $sign1='name'."=".$name.'&pwd='.$pwd.'&time='.$time;
//echo $sign1;die;
        $sign2 = md5($sign1);
//        echo $sign;die;
        // 判断请求是否超时
        if(($time2-$time)>5*60){
            exit("请求超时");
        }
        //签名校验
        if($sign == $sign2 ){
            $arr = DB::table('user')->where('username',$name)->where('pwd',$pwd)->first();
            if($arr){
                $token='';
                $token =MD5( $name."dan");
                $l_id=$arr['id'];
                $token1=DB::table('user')->where(['id'=>$l_id])->update(['token'=>$token]);
//                print_r($token1);die;
                //var_dump($arr);
                return json_encode($arr);
            }else{
                return false;

            }
        }
    }
}