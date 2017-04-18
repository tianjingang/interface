<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<head>
<title>mtyrm</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
/* GitHub stylesheet for MarkdownPad (http://markdownpad.com) */
/* Author: Nicolas Hery - http://nicolashery.com */
/* Version: b13fe65ca28d2e568c6ed5d7f06581183df8f2ff */
/* Source: https://github.com/nicolahery/markdownpad-github */

/* RESET
=============================================================================*/

html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video {
  margin: 0;
  padding: 0;
  border: 0;
}

/* BODY
=============================================================================*/

body {
  font-family: Helvetica, arial, freesans, clean, sans-serif;
  font-size: 14px;
  line-height: 1.6;
  color: #333;
  background-color: #fff;
  padding: 20px;
  max-width: 960px;
  margin: 0 auto;
}

body>*:first-child {
  margin-top: 0 !important;
}

body>*:last-child {
  margin-bottom: 0 !important;
}

/* BLOCKS
=============================================================================*/

p, blockquote, ul, ol, dl, table, pre {
  margin: 15px 0;
}

/* HEADERS
=============================================================================*/

h1, h2, h3, h4, h5, h6 {
  margin: 20px 0 10px;
  padding: 0;
  font-weight: bold;
  -webkit-font-smoothing: antialiased;
}

h1 tt, h1 code, h2 tt, h2 code, h3 tt, h3 code, h4 tt, h4 code, h5 tt, h5 code, h6 tt, h6 code {
  font-size: inherit;
}

h1 {
  font-size: 28px;
  color: #000;
}

h2 {
  font-size: 24px;
  border-bottom: 1px solid #ccc;
  color: #000;
}

h3 {
  font-size: 18px;
}

h4 {
  font-size: 16px;
}

h5 {
  font-size: 14px;
}

h6 {
  color: #777;
  font-size: 14px;
}

body>h2:first-child, body>h1:first-child, body>h1:first-child+h2, body>h3:first-child, body>h4:first-child, body>h5:first-child, body>h6:first-child {
  margin-top: 0;
  padding-top: 0;
}

a:first-child h1, a:first-child h2, a:first-child h3, a:first-child h4, a:first-child h5, a:first-child h6 {
  margin-top: 0;
  padding-top: 0;
}

h1+p, h2+p, h3+p, h4+p, h5+p, h6+p {
  margin-top: 10px;
}

/* LINKS
=============================================================================*/

a {
  color: #4183C4;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}

/* LISTS
=============================================================================*/

ul, ol {
  padding-left: 30px;
}

ul li > :first-child, 
ol li > :first-child, 
ul li ul:first-of-type, 
ol li ol:first-of-type, 
ul li ol:first-of-type, 
ol li ul:first-of-type {
  margin-top: 0px;
}

ul ul, ul ol, ol ol, ol ul {
  margin-bottom: 0;
}

dl {
  padding: 0;
}

dl dt {
  font-size: 14px;
  font-weight: bold;
  font-style: italic;
  padding: 0;
  margin: 15px 0 5px;
}

dl dt:first-child {
  padding: 0;
}

dl dt>:first-child {
  margin-top: 0px;
}

dl dt>:last-child {
  margin-bottom: 0px;
}

dl dd {
  margin: 0 0 15px;
  padding: 0 15px;
}

dl dd>:first-child {
  margin-top: 0px;
}

dl dd>:last-child {
  margin-bottom: 0px;
}

/* CODE
=============================================================================*/

pre, code, tt {
  font-size: 12px;
  font-family: Consolas, "Liberation Mono", Courier, monospace;
}

code, tt {
  margin: 0 0px;
  padding: 0px 0px;
  white-space: nowrap;
  border: 1px solid #eaeaea;
  background-color: #f8f8f8;
  border-radius: 3px;
}

pre>code {
  margin: 0;
  padding: 0;
  white-space: pre;
  border: none;
  background: transparent;
}

pre {
  background-color: #f8f8f8;
  border: 1px solid #ccc;
  font-size: 13px;
  line-height: 19px;
  overflow: auto;
  padding: 6px 10px;
  border-radius: 3px;
}

pre code, pre tt {
  background-color: transparent;
  border: none;
}

kbd {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background-color: #DDDDDD;
    background-image: linear-gradient(#F1F1F1, #DDDDDD);
    background-repeat: repeat-x;
    border-color: #DDDDDD #CCCCCC #CCCCCC #DDDDDD;
    border-image: none;
    border-radius: 2px 2px 2px 2px;
    border-style: solid;
    border-width: 1px;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    line-height: 10px;
    padding: 1px 4px;
}

/* QUOTES
=============================================================================*/

blockquote {
  border-left: 4px solid #DDD;
  padding: 0 15px;
  color: #777;
}

blockquote>:first-child {
  margin-top: 0px;
}

blockquote>:last-child {
  margin-bottom: 0px;
}

/* HORIZONTAL RULES
=============================================================================*/

hr {
  clear: both;
  margin: 15px 0;
  height: 0px;
  overflow: hidden;
  border: none;
  background: transparent;
  border-bottom: 4px solid #ddd;
  padding: 0;
}

/* TABLES
=============================================================================*/

table th {
  font-weight: bold;
}

table th, table td {
  border: 1px solid #ccc;
  padding: 6px 13px;
}

table tr {
  border-top: 1px solid #ccc;
  background-color: #fff;
}

table tr:nth-child(2n) {
  background-color: #f8f8f8;
}

/* IMAGES
=============================================================================*/

img {
  max-width: 100%
}
</style>
</head>
<body>
<h1>猫头鹰RM项目接口</h1>
<hr />
<ul>
<li>
<p><a href="#user">用户中心</a></p>
<ul>
<li><a href="#sendsms">发送验证码</a></li>
<li><a href="#register">注册</a></li>
<li><a href="#login">登录</a></li>
<li><a href="#logout">退出</a></li>
<li><a href="#updatePass">修改密码</a></li>
<li><a href="#resetPass">重置密码</a></li>
<li><a href="#saveinfo">完善用户资料</a></li>
<li><a href="#getuserinfo">获取用户详情</a></li>
<li><a href="#p2b">个人转企业</a></li>
<li><a href="#usersearchLog">历史查询</a></li>
</ul>
</li>
<li>
<p><a href="#addloan">业务监督</a></p>
<ul>
<li><a href="#addloan">添加监督业务</a></li>
<li><a href="#searchloan">债务查询</a></li>
<li><a href="#loanlist">监督业务目录</a></li>
<li><a href="#loandetail">监督详情</a></li>
<li><a href="#loandel">删除监督</a></li>
<li><a href="#loansave">编辑保存监督</a></li>
<li><a href="#debtorInfo">债务人信息</a></li>
</ul>
</li>
<li>
<p><a href="#company">公司相关</a></p>
<ul>
<li><a href="#company_add">添加员工</a></li>
<li><a href="#company_del">删除员工</a></li>
<li><a href="#company_list">员工列表</a></li>
</ul>
</li>
<li>
<p><a href="#b_list">商务合作</a></p>
<ul>
<li><a href="#b_list">商务列表</a></li>
<li><a href="#a_list">添加商务</a></li>
<li><a href="#d_list">删除商务</a></li>
<li><a href="#m_list">我发布</a></li>
<li><a href="#b_detail">合作详情</a></li>
</ul>
</li>
<li>
<p><a href="#add_comment">评论相关</a></p>
<ul>
<li><a href="#add_comment">添加评论</a></li>
<li><a href="#list_comment">评论列表</a></li>
<li><a href="#del_comment">删除评论</a></li>
</ul>
</li>
<li>
<p><a href="#sys_area">系统相关</a></p>
<ul>
<li><a href="#sys_area">地区列表</a></li>
<li><a href="#sys_data">首页数据</a></li>
<li><a href="#qiniutoken">获取七牛token</a></li>
<li><a href="#pushid">上传用户pushid</a></li>
<li><a href="#unread">消息通知</a></li>
<li><a href="#msglist">消息列表</a></li>
</ul>
</li>
</ul>
<hr />
<h2>返回数据格式（举例说明）</h2>
<pre><code>//status值为0000 是成功 其他都是失败 info是 失败的文案 data里是数据
{
    status: &quot;0001&quot;,
    info: &quot;手机号格式不正确&quot;,
    data: &quot;&quot;
}
</code></pre>

<h2>鉴权说明</h2>
<pre><code>注册成功和 登录后 会返回 一个authcode和id字段。 获取后放header里调用任何接口都要带着。参数是authcode 和 userid 
</code></pre>

<h2>特别说明</h2>
<pre><code>如果返回错误码是0022 意思就是用户未登录，或者过期。客户端要跳到登录界面
</code></pre>

<h2 id="sendsms">发送验证码</h2>
<pre><code>地址：https://zhengxin.appflint.com/Public/sendSMS
方式：post
参数： 
        phone 手机号
        type 1 注册 2 找回密码/个人转企业

返回：
    {
          &quot;status&quot;: &quot;0000&quot;,
          &quot;info&quot;: &quot;成功&quot;,
          &quot;data&quot;: null
        }
</code></pre>

<h2 id="register">注册接口</h2>
<pre><code>地址：https://zhengxin.appflint.com/Public/register
方式：post
参数： 
        roleid 角色 1 个人 2公司
        username 用户名
        phone 手机号
        password 密码（MD5后）
        code 验证码 
        idcard 身份证
        position 城市id
        reg_code 邀请码
        companyname 公司名
        avator 头像
        companyfile 公司营业执照
        jpush 极光pushid
返回：
    {
          &quot;status&quot;: &quot;0000&quot;,
          &quot;info&quot;: &quot;成功&quot;,
          &quot;data&quot;: {
            &quot;id&quot;: &quot;8&quot;,//用户id
            &quot;phone&quot;: &quot;158111864&quot;,//手机号
            &quot;username&quot;: &quot;&quot;,//用户名
            &quot;companyname&quot;: &quot;&quot;,//公司名
            &quot;roleid&quot;: &quot;1&quot;,//1 个人 2 公司
            &quot;avator&quot;: &quot;/2101/215/156431.jpg&quot;,//用户头像
            &quot;companyfile&quot;: &quot;/2101/215/156431.jpg&quot;,公司营业执照
            &quot;authcode&quot;: &quot;vW87eyrpRoMwjIZCh0pOroi20ooSGI0G&quot;,//秘钥
            &quot;my_invitecode&quot;:&quot;1R5AE&quot;,
          }
        }
</code></pre>

<h2 id="login">登录接口</h2>
<pre><code>地址：https://zhengxin.appflint.com/Public/login
方式：post
参数： 
        phone 手机号
        password 密码（MD5后）
        jpush 极光pushid

返回：
    {
      &quot;status&quot;: &quot;0000&quot;,
      &quot;info&quot;: &quot;成功&quot;,
      &quot;data&quot;: {
        &quot;id&quot;: &quot;9&quot;,
        &quot;phone&quot;: &quot;15811186563&quot;,手机号
        &quot;username&quot;: &quot;&quot;, 用户名
        &quot;companyname&quot;: &quot;&quot;, 公司名
        &quot;roleid&quot;: &quot;1&quot;, 角色id 1 个人 2 公司 3 都是
        &quot;avator&quot;: &quot;/2101/215/156431.jpg&quot;,个人头像
        &quot;companyfile&quot;: &quot;&quot;, 公司执照
        &quot;is_complete&quot;: &quot;1&quot;,//个人信息是否完整
        &quot;authcode&quot;: &quot;vW87eyrpRoMwjIZCh0pOroi20ooSGI0G&quot;,//秘钥
        &quot;my_invitecode&quot;:&quot;1R5AE&quot;,
      }
    }
</code></pre>

<h2 id="logout">退出接口</h2>
<pre><code>地址：https://zhengxin.appflint.com/Public/logout
方式：post【登录状态】

返回：
    {
      &quot;status&quot;: &quot;0000&quot;,
      &quot;info&quot;: &quot;成功&quot;,
      &quot;data&quot;: null
    }
</code></pre>

<h2 id="resetPass">重置密码</h2>
<pre><code>地址：https://zhengxin.appflint.com/Public/resetPass
方式：post
参数： 
        phone 手机号
        password 密码
        code 验证码

返回：
    {
      &quot;status&quot;: &quot;0000&quot;,
      &quot;info&quot;: &quot;成功&quot;,
      &quot;data&quot;: null
    }
</code></pre>

<h2 id="updatePass">修改密码</h2>
<pre><code>地址：https://zhengxin.appflint.com/Public/updatePass
方式：post【登录状态】
参数： 
        old_password 老密码(MD5后)
        new_password 新密码（MD5后）

返回：
    {
      &quot;status&quot;: &quot;0000&quot;,
      &quot;info&quot;: &quot;成功&quot;,
      &quot;data&quot;: null
    }
</code></pre>

<h2 id="addloan">添加业务监管</h2>
<pre><code>地址：https://zhengxin.appflint.com/Loan/add
方式：post
参数： 
        roleid 角色 1 个人 2公司
        username 用户名
        idcard 身份证
        status 债务状态 1 正常 2坏账 3完结
        loan 贷款金额
        pawn 抵押物 1 房产 2车辆 3 无抵押 4其他
        loan_date 借款日期
        xuxi_date 续息日
        loan_times 借款周期
        repay_date 还款日期
        extense_date 展期
        contract_file 借款合同

返回：
    {
          &quot;status&quot;: &quot;0000&quot;,
          &quot;info&quot;: &quot;成功&quot;,
          &quot;data&quot;: null
    }
</code></pre>

<h2 id="searchloan">债务查询</h2>
<pre><code>地址：https://zhengxin.appflint.com/Loan/search
方式：post【登录】
参数： 
        username 用户名
        idcard 身份证

返回：
    {
      &quot;status&quot;: &quot;0000&quot;,
      &quot;info&quot;: &quot;成功&quot;,
      &quot;data&quot;: {
        &quot;debtor_id&quot;: &quot;5&quot;,//债务人id
        &quot;username&quot;: &quot;三龙&quot;,//债务人姓名
        &quot;searchtimes&quot;: 4,//被搜素了几次
        &quot;searchlogs&quot;: [
          {
            &quot;sd&quot;: &quot;2017-02-17&quot;,//查询日期
            &quot;sv&quot;: 5//查询次数
          },
          {
            &quot;sd&quot;: &quot;2017-02-22&quot;,
            &quot;sv&quot;: 1
          }
        ],
        &quot;loantimes&quot;: 1,//贷款次数
        &quot;loanlogs&quot;: [
          {
            &quot;user_id&quot;: &quot;8&quot;,
            &quot;debtor_id&quot;: &quot;5&quot;,
            &quot;loan_date&quot;: &quot;2017-02-03&quot;,//贷款时间
            &quot;pawn&quot;: &quot;1&quot;,//抵押物 1 房产 2车辆 3 无抵押 4其他
            &quot;loan&quot;: &quot;0.01万&quot;,//贷款金额
            &quot;status&quot;: &quot;1&quot;,//债务状态 1 正常 2坏账 3完结
            &quot;creditor_phone&quot;: &quot;15811186564&quot;//债权人手机号
          }
        ]
      }
    }
</code></pre>

<h2 id="loanlist">监督业务目录</h2>
<pre><code>地址：https://zhengxin.appflint.com/Loan/loanList
方式：GET【登录状态】
参数： 
        status 债务状态 1 正常 2坏账 3完结
        review_status 审核状态 1 正在审核 2 审核不通过 3审核通过
        page 第几页

返回：
    {
      &quot;status&quot;: &quot;0000&quot;,
      &quot;info&quot;: &quot;成功&quot;,
      &quot;data&quot;: [
        {
          &quot;id&quot; : &quot;1&quot;,//监督业务id
          &quot;user_id&quot;: &quot;8&quot;,//当前登录用户id
          &quot;debtor_id&quot;: &quot;5&quot;,//债务人id
          &quot;loan_date&quot;: &quot;2017-02-03&quot;,
          &quot;pawn&quot;: &quot;1&quot;,//抵押物 1 房产 2车辆 3 无抵押 4其他
          &quot;loan&quot;: &quot;0.01万&quot;, //借款金额
          &quot;status&quot;: &quot;1&quot;,//债务状态 1 正常 2坏账 3完结
          &quot;review_status&quot;: &quot;1&quot;,//审核状态1 正在审核 2 审核不通过 3审核通过
          &quot;debtor_name&quot;: &quot;三龙&quot;//债务人姓名
        }
      ]
    }
</code></pre>

<h2 id="b_list">商务列表</h2>
<pre><code>地址：https://zhengxin.appflint.com/Business/getList
方式：GET
参数： 

        page 第几页

返回：
    {
      &quot;status&quot;: &quot;0000&quot;,
      &quot;info&quot;: &quot;成功&quot;,
      &quot;data&quot;: [
        {
          &quot;id&quot;: &quot;2&quot;,
          &quot;user_id&quot;: &quot;9&quot;,//用户id
          &quot;title&quot;: &quot;ddd&quot;,//标题
          &quot;create_date&quot;: &quot;2017-02-20&quot;,//发布时间
          &quot;content&quot;: &quot;dfsdf&quot;,//内容
          &quot;pic&quot;: &quot;/dfdf/d/df.jpg&quot;,//插图
          &quot;status&quot;: &quot;2&quot;,//1 正常 2 火
          &quot;username&quot;: &quot;ffff&quot;,//用户名
          &quot;avator&quot;: &quot;/2101/215/156431.jpg&quot;,//头像
          &quot;phone&quot;: &quot;15811186563&quot;//手机号
        }.....
      ]
    }
</code></pre>

<h2 id="a_list">添加商务</h2>
<pre><code>地址：https://zhengxin.appflint.com/Business/add
方式：POST【登录状态】
参数： 
        pic 配图
        title 标题
        content 内容

返回：
    {
      &quot;status&quot;: &quot;0000&quot;,
      &quot;info&quot;: &quot;成功&quot;,
      &quot;data&quot;: null
      ]
    }
</code></pre>

<h2 id="b_detail">商务合作详情</h2>
<pre><code>地址：https://zhengxin.appflint.com/Business/detail
方式：get
参数： 
     id 商务合作id

返回：
    {
      &quot;status&quot;: &quot;0000&quot;,
      &quot;info&quot;: &quot;成功&quot;,
      &quot;data&quot;: {
        &quot;id&quot;: &quot;3&quot;,//合作id
        &quot;user_id&quot;: &quot;9&quot;,//用户id
        &quot;title&quot;: &quot;1111&quot;,//标题
        &quot;create_date&quot;: &quot;2017-02-20&quot;,//发布日期
        &quot;content&quot;: &quot;11122&quot;,//内容
        &quot;pic&quot;: &quot;111.jpg&quot;,//图片链接
        &quot;status&quot;: &quot;1&quot;,
        &quot;username&quot;: &quot;ffff&quot;,//用户名
        &quot;avator&quot;: &quot;/2101/215/156431.jpg&quot;,//头像
        &quot;phone&quot;: &quot;15811186563&quot;,//手机号
        &quot;comment_nums&quot;: &quot;2&quot;,//父评论数
        &quot;comment_list&quot;: [
          {
            &quot;id&quot;: &quot;2&quot;,//评论id
            &quot;obj_id&quot;: &quot;3&quot;,//合作id
            &quot;create_time&quot;: &quot;2017-02-20 18:17:15&quot;,//发布时间
            &quot;content&quot;: &quot;22222&quot;,//评论内容
            &quot;user_id&quot;: &quot;9&quot;,//评论用户id
            &quot;parent_id&quot;: &quot;0&quot;,//评论父id
            &quot;username&quot;: &quot;ffff&quot;,//评论用户昵称
            &quot;avator&quot;: &quot;/2101/215/156431.jpg&quot;,//评论用户头像
            &quot;sonList&quot;: [回复评论集合
              {
                &quot;id&quot;: &quot;3&quot;,
                &quot;obj_id&quot;: &quot;3&quot;,
                &quot;create_time&quot;: &quot;2017-02-20 18:17:15&quot;,
                &quot;content&quot;: &quot;3333&quot;,
                &quot;user_id&quot;: &quot;9&quot;,
                &quot;parent_id&quot;: &quot;2&quot;,
                &quot;username&quot;: &quot;ffff&quot;,
                &quot;avator&quot;: &quot;/2101/215/156431.jpg&quot;
              }
            ]
          },
          {
            &quot;id&quot;: &quot;1&quot;,
            &quot;obj_id&quot;: &quot;3&quot;,
            &quot;create_time&quot;: &quot;2017-02-20 18:17:15&quot;,
            &quot;content&quot;: &quot;11111&quot;,
            &quot;user_id&quot;: &quot;9&quot;,
            &quot;parent_id&quot;: &quot;0&quot;,
            &quot;username&quot;: &quot;ffff&quot;,
            &quot;avator&quot;: &quot;/2101/215/156431.jpg&quot;,
            &quot;sonList&quot;: []
          }
        ]
      }
    }
</code></pre>

<h2 id="d_list">删除商务</h2>
<pre><code>地址：https://zhengxin.appflint.com/Business/del
方式：POST【登录状态】
参数： 
        id 商务合作id

返回：
    {
      &quot;status&quot;: &quot;0000&quot;,
      &quot;info&quot;: &quot;成功&quot;,
      &quot;data&quot;: null
      ]
    }
</code></pre>

<h2 id="m_list">我发布</h2>
<pre><code>地址：https://zhengxin.appflint.com/Business/myList
方式：GET【登录状态】
参数： 

        page 第几页

返回：
    {
      &quot;status&quot;: &quot;0000&quot;,
      &quot;info&quot;: &quot;成功&quot;,
      &quot;data&quot;: [
        {
          &quot;id&quot;: &quot;2&quot;,
          &quot;user_id&quot;: &quot;9&quot;,//用户id
          &quot;title&quot;: &quot;ddd&quot;,//标题
          &quot;create_date&quot;: &quot;2017-02-20&quot;,//发布时间
          &quot;content&quot;: &quot;dfsdf&quot;,//内容
          &quot;pic&quot;: &quot;/dfdf/d/df.jpg&quot;,//插图
          &quot;status&quot;: &quot;2&quot;,//1 正常 2 火
          &quot;username&quot;: &quot;ffff&quot;,//用户名
          &quot;avator&quot;: &quot;/2101/215/156431.jpg&quot;,//头像
          &quot;phone&quot;: &quot;15811186563&quot;//手机号
        }.....
      ]
    }
</code></pre>

<h2 id="add_comment">添加评论</h2>
<pre><code>地址：https://zhengxin.appflint.com/Comment/add
方式：post【登录】
参数： 
        content//评论内容
        obj_id//合作id
        parent_id //父评论id

返回：
    {
          &quot;status&quot;: &quot;0000&quot;,
          &quot;info&quot;: &quot;成功&quot;,
          &quot;data&quot;: null
    }
</code></pre>

<h2 id="list_comment">评论列表</h2>
<pre><code>地址：https://zhengxin.appflint.com/Comment/getList
方式：get
参数： 
        obj_id//合作id
        page // 第几页

返回：
    {
      &quot;status&quot;: &quot;0000&quot;,
      &quot;info&quot;: &quot;成功&quot;,
      &quot;data&quot;: &quot;comment_nums&quot;: &quot;2&quot;,//父评论数
        &quot;comment_list&quot;: [
          {
            &quot;id&quot;: &quot;2&quot;,//评论id
            &quot;obj_id&quot;: &quot;3&quot;,//合作id
            &quot;create_time&quot;: &quot;2017-02-20 18:17:15&quot;,//发布时间
            &quot;content&quot;: &quot;22222&quot;,//评论内容
            &quot;user_id&quot;: &quot;9&quot;,//评论用户id
            &quot;parent_id&quot;: &quot;0&quot;,//评论父id
            &quot;username&quot;: &quot;ffff&quot;,//评论用户昵称
            &quot;avator&quot;: &quot;/2101/215/156431.jpg&quot;,//评论用户头像
            &quot;sonList&quot;: [回复评论集合
              {
                &quot;id&quot;: &quot;3&quot;,
                &quot;obj_id&quot;: &quot;3&quot;,
                &quot;create_time&quot;: &quot;2017-02-20 18:17:15&quot;,
                &quot;content&quot;: &quot;3333&quot;,
                &quot;user_id&quot;: &quot;9&quot;,
                &quot;parent_id&quot;: &quot;2&quot;,
                &quot;username&quot;: &quot;ffff&quot;,
                &quot;avator&quot;: &quot;/2101/215/156431.jpg&quot;
              }
            ]
          },
          {
            &quot;id&quot;: &quot;1&quot;,
            &quot;obj_id&quot;: &quot;3&quot;,
            &quot;create_time&quot;: &quot;2017-02-20 18:17:15&quot;,
            &quot;content&quot;: &quot;11111&quot;,
            &quot;user_id&quot;: &quot;9&quot;,
            &quot;parent_id&quot;: &quot;0&quot;,
            &quot;username&quot;: &quot;ffff&quot;,
            &quot;avator&quot;: &quot;/2101/215/156431.jpg&quot;,
            &quot;sonList&quot;: []
          }
        ]
      }
      }
</code></pre>

<h2 id="del_comment">删除评论</h2>
<pre><code>地址：https://zhengxin.appflint.com/Comment/del
方式：post【登录】
参数： 
        comment_id //评论id

返回：
    {
          &quot;status&quot;: &quot;0000&quot;,
          &quot;info&quot;: &quot;成功&quot;,
          &quot;data&quot;: null
    }
</code></pre>

<h2 id="sys_area">地区列表</h2>
<pre><code>地址：https://zhengxin.appflint.com/Public/area
方式：get

返回：
    {
      &quot;status&quot;: &quot;0000&quot;,
      &quot;info&quot;: &quot;成功&quot;,
      &quot;data&quot;: [
        {
          &quot;areaid&quot;: &quot;1&quot;,
          &quot;areaname&quot;: &quot;北京&quot;,
          &quot;arrchildid&quot;: &quot;1&quot;,
          &quot;sonList&quot;: null
        },
        {
          &quot;areaid&quot;: &quot;2&quot;,
          &quot;areaname&quot;: &quot;上海&quot;,
          &quot;arrchildid&quot;: &quot;2&quot;,
          &quot;sonList&quot;: null
        },
        {
          &quot;areaid&quot;: &quot;3&quot;,
          &quot;areaname&quot;: &quot;天津&quot;,
          &quot;arrchildid&quot;: &quot;3&quot;,
          &quot;sonList&quot;: null
        },
        {
          &quot;areaid&quot;: &quot;4&quot;,
          &quot;areaname&quot;: &quot;重庆&quot;,
          &quot;arrchildid&quot;: &quot;4&quot;,
          &quot;sonList&quot;: null
        },
        {
          &quot;areaid&quot;: &quot;5&quot;,
          &quot;areaname&quot;: &quot;河北&quot;,
          &quot;arrchildid&quot;: &quot;5,35,36,37,38,39,40,41,42,43,44,45,392,393,394&quot;,
          &quot;sonList&quot;: [
            {
              &quot;areaid&quot;: &quot;35&quot;,
              &quot;areaname&quot;: &quot;石家庄市&quot;
            },
            {
              &quot;areaid&quot;: &quot;36&quot;,
              &quot;areaname&quot;: &quot;唐山市&quot;
            }....
          ]
        }...
        ]
    }
</code></pre>

<h2 id="saveinfo">完善用户资料</h2>
<pre><code>地址：https://zhengxin.appflint.com/User/save
方式：post【登录】
参数： 
        username //用户名
        idcard //身份证
        position //城市id
        code //邀请码
        avator //头像

返回：
    {
          &quot;status&quot;: &quot;0000&quot;,
          &quot;info&quot;: &quot;成功&quot;,
          &quot;data&quot;: null
    }
</code></pre>

<h2 id="getuserinfo">获取用户详情</h2>
<pre><code>地址：https://zhengxin.appflint.com/User/getUserInfo
方式：get【登录】
参数： 

返回：
    {
      &quot;status&quot;: &quot;0000&quot;,
      &quot;info&quot;: &quot;成功&quot;,
      &quot;data&quot;: {
        &quot;id&quot;: &quot;9&quot;,//用户id
        &quot;username&quot;: &quot;11111&quot;,//用户名
        &quot;companyname&quot;: &quot;&quot;,//公司名
        &quot;roleid&quot;: &quot;1&quot;,//角色id 1 用户 2公司 3 全部
        &quot;avator&quot;: &quot;/sdfsd/ddd.jpg&quot;,//头像
        &quot;companyfile&quot;: &quot;&quot;,//公司执照
        &quot;location&quot;: &quot;35&quot;,//用户城市id
        &quot;city&quot;: &quot;石家庄市&quot;,//城市名
        &quot;arrparentid&quot;: &quot;5&quot;,//用户省级id
        &quot;provice&quot;: &quot;河北&quot;//用户省名
        &quot;my_invitecode&quot;:&quot;sdf&quot;//我的邀请码
        &quot;reg_invitecode&quot;:&quot;sss&quot;//注册时邀请码
        &quot;invit_username&quot;:&quot;我的邀请人&quot;
      }
    }
</code></pre>

<h2 id="sys_data">首页数据</h2>
<pre><code>地址：https://zhengxin.appflint.com/Public/sysData
方式：get
参数：

返回：
    {
      &quot;status&quot;: &quot;0000&quot;,
      &quot;info&quot;: &quot;成功&quot;,
      &quot;data&quot;: {
        &quot;weekData&quot;: &quot;1221&quot;,//本周查询数
        &quot;money&quot;: &quot;123万&quot;,//监管资金
        &quot;users&quot;: &quot;13万+&quot;//注册用户数
      }
    }
</code></pre>

<h2 id="loandetail">监督详情</h2>
<pre><code>地址：https://zhengxin.appflint.com/Loan/detail
方式：get【登录】
参数：
        loan_id 监督业务id
返回：
    {
      &quot;status&quot;: &quot;0000&quot;,
      &quot;info&quot;: &quot;成功&quot;,
      &quot;data&quot;: 
        {
          &quot;id&quot;: &quot;1&quot;,
          &quot;user_id&quot;: &quot;8&quot;,//当前登录用户id
          &quot;debtor_id&quot;: &quot;5&quot;,//债务人id
          &quot;loan_date&quot;: &quot;2017-02-03&quot;,
          &quot;pawn&quot;: &quot;1&quot;,//抵押物 1 房产 2车辆 3 无抵押 4其他
          &quot;loan&quot;: &quot;0.01万&quot;, //借款金额
          &quot;status&quot;: &quot;1&quot;,//债务状态 1 正常 2坏账 3完结
          &quot;review_status&quot;: &quot;1&quot;,//审核状态1 正在审核 2 审核不通过 3审核通过
          &quot;contract_file&quot;: &quot;/sdf/sdf.jgp&quot;,//借款合同
          &quot;loan_times&quot;: &quot;7&quot;,//借款周期
          &quot;debtor_name&quot;: &quot;三龙&quot;//债务人姓名
          &quot;debtor_idcard” ：“”//债务人身份证
          “invit_username”：“”//我的邀请人
        }
    }
</code></pre>

<h2 id="loandel">删除监督</h2>
<pre><code>地址：https://zhengxin.appflint.com/Loan/del
方式：post【登录】
参数：
        loan_id 监督id
返回：
    {
      &quot;status&quot;: &quot;0000&quot;,
      &quot;info&quot;: &quot;成功&quot;,
      &quot;data&quot;: null
    }
</code></pre>

<h2 id="loansave">编辑保存监督</h2>
<pre><code>地址：https://zhengxin.appflint.com/Loan/save
方式：post【登录】
参数： 
        loan_id 监督业务id
        roleid 角色 1 个人 2公司
        username 用户名
        idcard 身份证
        status 债务状态 1 正常 2坏账 3完结
        loan 贷款金额
        pawn 抵押物 1 房产 2车辆 3 无抵押 4其他
        loan_date 借款日期
        xuxi_date 续息日
        loan_times 借款周期
        repay_date 还款日期
        extense_date 展期
        contract_file 借款合同

返回：
    {
          &quot;status&quot;: &quot;0000&quot;,
          &quot;info&quot;: &quot;成功&quot;,
          &quot;data&quot;: null
    }
</code></pre>

<h2 id="qiniutoken">获取七牛token</h2>
<pre><code>地址：https://zhengxin.appflint.com/Public/getQiNiuToken
方式：
参数： 


返回：
    {
    &quot;status&quot;: &quot;0000&quot;,
    &quot;info&quot;: &quot;成功&quot;,
    &quot;data&quot;: &quot;OG1vorZEhTuWLHI0YAsKWe3ePuGluBOBPoUwsjuu:xKuYJrnVlEO0qCrOHWO4n-ZI540=:eyJzY29wZSI6ImZsaW50IiwiZGVhZGxpbmUiOjIxMTg1NTM5NjAsInVwSG9zdHMiOlsiaHR0cDpcL1wvdXAucWluaXUuY29tIiwiaHR0cDpcL1wvdXBsb2FkLnFpbml1LmNvbSIsIi1IIHVwLnFpbml1LmNvbSBodHRwOlwvXC8xODMuMTM2LjEzOS4xNiJdfQ==&quot;
    }
</code></pre>

<h2 id="p2b">个人转企业</h2>
<pre><code>地址：https://zhengxin.appflint.com/User/userToCompany
方式：post【登录】
参数： 
        companyname 公司名
        companyfile 营业执照
        phone 手机号
        code 验证码

返回：
    {
          &quot;status&quot;: &quot;0000&quot;,
          &quot;info&quot;: &quot;成功&quot;,
          &quot;data&quot;: null
    }
</code></pre>

<h2 id="push">上传用户pushid</h2>
<pre><code>地址：https://zhengxin.appflint.com/Public/setJpush
方式：post【登录】
参数： 
        pushid

返回：
    {
          &quot;status&quot;: &quot;0000&quot;,
          &quot;info&quot;: &quot;成功&quot;,
          &quot;data&quot;: null
    }
</code></pre>

<h2 id="debtorInfo">债务人信息</h2>
<pre><code>地址：https://zhengxin.appflint.com/Loan/debtorInfo
方式：get【登录】
参数： 
        debtor_id 债务人id

返回：
    {
      &quot;status&quot;: &quot;0000&quot;,
      &quot;info&quot;: &quot;成功&quot;,
      &quot;data&quot;: {
        &quot;debtor_id&quot;: &quot;5&quot;,//债务人id
        &quot;username&quot;: &quot;三龙&quot;,//债务人姓名
        &quot;searchtimes&quot;: 7,//总查询次数
        &quot;searchlogs&quot;: [
          {
            &quot;sd&quot;: &quot;2017-02-17&quot;,//查询日期
            &quot;sv&quot;: 5 //查询次数
          },
          {
            &quot;sd&quot;: &quot;2017-02-22&quot;,//查询日期
            &quot;sv&quot;: 2
          }
        ],
        &quot;loantimes&quot;: 3,
        &quot;loanlogs&quot;: [
          {
            &quot;user_id&quot;: &quot;8&quot;,
            &quot;debtor_id&quot;: &quot;5&quot;,
            &quot;loan_date&quot;: &quot;2017-02-03&quot;,//贷款时间
            &quot;pawn&quot;: &quot;1&quot;,//抵押物 1 房产 2车辆 3 无抵押 4其他
            &quot;loan&quot;: &quot;0.01万&quot;,//贷款金额
            &quot;status&quot;: &quot;1&quot;,//债务状态 1 正常 2坏账 3完结
            &quot;creditor_phone&quot;: &quot;15811186564&quot;//债权人手机号
          },
          ........
        ]
      }
    }
</code></pre>

<h2 id="usersearchLog">历史查询</h2>
<pre><code>地址：https://zhengxin.appflint.com/User/searchLog
方式：get【登录】
参数： 
        page 第几页

返回：
    {
      &quot;status&quot;: &quot;0000&quot;,
      &quot;info&quot;: &quot;成功&quot;,
      &quot;data&quot;: [
        {
          &quot;id&quot;: &quot;27&quot;,
          &quot;user_id&quot;: &quot;8&quot;,//登录用户id
          &quot;debtor_id&quot;: &quot;5&quot;,//债务人id
          &quot;search_date&quot;: &quot;2017-03-01&quot;,//查看时间
          &quot;debtor_name&quot;: &quot;三龙&quot;,//债务人姓名
          &quot;is_read&quot;: &quot;2&quot;// 1 未读 2已读
        }......
      ]
    }
</code></pre>

<h2 id="company_add">添加员工</h2>
<pre><code>地址：https://zhengxin.appflint.com/Company/addEmployee
方式：post【登录】
参数： 
        username 员工用户名
        password 员工密码(md5后)
        avator 员工头像
        phone 员工手机号

返回：
    {
      &quot;status&quot;: &quot;0000&quot;,
      &quot;info&quot;: &quot;成功&quot;,
      &quot;data&quot;: null
      ]
    }
</code></pre>

<h2 id="company_del">删除员工</h2>
<pre><code>地址：https://zhengxin.appflint.com/Company/delEmployee
方式：post【登录】
参数： 
        employee_user_id 员工用户id
返回：
    {
      &quot;status&quot;: &quot;0000&quot;,
      &quot;info&quot;: &quot;成功&quot;,
      &quot;data&quot;: null
      ]
    }
</code></pre>

<h2 id="company_list">员工列表</h2>
<pre><code>地址：https://zhengxin.appflint.com/Company/empList
方式：get【登录】
参数： 

返回：
    {
      &quot;status&quot;: &quot;0000&quot;,
      &quot;info&quot;: &quot;成功&quot;,
      &quot;data&quot;: [
        {
          &quot;id&quot;: &quot;23&quot;,//员工用户id
          &quot;username&quot;: &quot;员工1&quot;,//员工名称
          &quot;avator&quot;: &quot;http://img.appflint.com/sdfsdf/sdfdsf.jpg&quot;//员工头像
        }
      ]
    }
</code></pre>

<h2 id="unread">消息通知</h2>
<pre><code>地址：https://zhengxin.appflint.com/Public/sysMsg
方式：get【登录】
参数： 

返回：
    {
      &quot;status&quot;: &quot;0000&quot;,
      &quot;info&quot;: &quot;成功&quot;,
      &quot;data&quot;: {
        &quot;sysUnreadMsg&quot;: &quot;0&quot;,//未读系统消息数
        &quot;loanUnreadMsg&quot;: &quot;6&quot;,//未读监督业务消息数
        &quot;businessUnreadMsg&quot;: &quot;0&quot;//未读合作消息数
      }
    }
</code></pre>

<h2 id="msglist">消息列表</h2>
<pre><code>地址：https://zhengxin.appflint.com/Public/msgList
方式：get【登录】
参数： 
        page 第几页
        type 1 系统消息 2 监督业务 3 商务合作
返回：
    {
  &quot;status&quot;: &quot;0000&quot;,
  &quot;info&quot;: &quot;成功&quot;,
  &quot;data&quot;: [
    {
      &quot;id&quot;: &quot;10&quot;,
      &quot;create_time&quot;: &quot;2017-03-01 23:22:22&quot;,
      &quot;content&quot;: &quot;监督信息添加成功，请等待审核&quot;
    }.....
  ]
}
</code></pre>


</body>
</html>
<!-- This document was created with MarkdownPad, the Markdown editor for Windows (http://markdownpad.com) -->