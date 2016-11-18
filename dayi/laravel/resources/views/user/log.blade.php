<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>操作日志</title>
</head>
<body>
	<h1 align="center">操作日志</h1>
	<p align="center">登录人：<font color="red">
	 <?php  session_start();
        echo $_SESSION['name'];
         ?></font></p>
         <p align="center"><a href="{{url('loginout')}}">退出</a></p>
         <p align="center"><a href="{{url('show')}}">展示页面</a></p>
		<table border="1" align="center">
			<tr>
				<td>操作昵称</td>
				<td>操作内容</td>
				<td>操作时间</td>
				
			</tr>
			@foreach($data as $k =>$v)
			<tr>
				<td>{{$v->cname}}</td>
				<td>{{$v->ctext}}</td>
				<td><?php
				 echo date("Y-m-d H:i:s",($v->time+60*60*8));
				 ?></td>
			</tr>
			@endforeach
		</table>
</body>
</html>