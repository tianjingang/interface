<?php
/**
 * Created by PhpStorm.
 * User: 张丹
 * Date: 2016/10/30
 * Time: 16:57
 */?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
</head>
<body>
<center>
    <form action="?r=user/login_pro" method="post">
        <table>
            <input type="hidden" id="_csrf" name="_csrf" value="<?php echo yii::$app->request->csrfToken?>"/>
            <tr>
                <td>用户名：</td>
                <td><input type="text" name="name"/></td>
            </tr>
            <tr>
                <td>密码：</td>
                <td><input type="password" name="pwd"/></td>
            </tr>
            <tr>
                <td><input type="submit"/></td>
                <td></td>
            </tr>

        </table>
    </form>
</center>
</body>
</html>