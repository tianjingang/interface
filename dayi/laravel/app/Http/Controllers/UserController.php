<?php

namespace App\Http\Controllers;
header("content-type:text/html;charset=utf-8");
use Session;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Symfony\Component\HttpFoundation\Request;
use DB;

class UserController extends Controller
{   
	/**
	 * 添加页面
	 * @return [type] [description]
	 */
    public function login(Request $request){
        $sname=$request->input('sname');
        $pwd=$request->input('spwd');
        $qingqiu=$request->input('qingqiu');
        //echo $pwd;
        $data = DB::table('user')->where('username',$sname)->first();
        //echo $data->pwd.",".$pwd;
         if(empty($data)){
            $time=time();
            $code="0";
            $message="对不起,用户名不存在!";
            $arr=array("code"=>$code,"message"=>$message,"fanhui"=>$time,"qingqiu"=>$qingqiu,"token"=>"");
        }else{
            if($data->pwd==$pwd){
                $time=time();
                $code="1";
                $message="登录成功!";
                $token=md5($sname.'1');
                file_put_contents('./'.md5($sname).'.txt',$token);
                $token1=file_get_contents('./'.md5($sname).'.txt');
               $arr=array("code"=>$code,"message"=>$message,"fanhui"=>$time,"qingqiu"=>$qingqiu,"token"=>$token1);
            }else{
                $time=time();
                $code="2";
                $message="密码错误!";
                $arr=array("code"=>$code,"message"=>$message,"fanhui"=>$time,"qingqiu"=>$qingqiu,"token"=>"");
            }
            
            
        }
        
    	return json_encode($arr);
    }
}
