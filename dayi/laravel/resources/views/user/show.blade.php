<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>展示</title>
</head>
<body>
	<h1 align="center">展示页面</h1>
	<p align="center">登录人：<font color="red">
	 <?php  session_start();
        echo $_SESSION['name'];
         ?></font></p>
         <p align="center"><a href="{{url('loginout')}}">退出</a></p>
         <p align="center"><a href="{{url('hui')}}">回收站</a></p>
         <p align="center"><a href="{{url('log')}}">操作日志</a></p>
		<table border="1" align="center">
			<tr>
				<td>名称</td>
				<td>简介</td>
				<td>作者</td>
				<td>价格</td>
				<td>操作</td>
			</tr>
			@foreach($data as $k =>$v)
			<tr>
				<td>{{$v->bname}}</td>
				<td>{{$v->content}}</td>
				<td>{{$v->author}}</td>
				<td>{{$v->price}}</td>
				<td><a href="{{url('del')}}?id={{$v->id}}">回收站</a></td>
			</tr>
			@endforeach
		</table>
</body>
</html>