<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
<title>微博系统--我的首页</title>
<script type="text/javascript" src="/Public/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="/Application/Home/View/js/jquery-ui.js"></script>
<script type="text/javascript" src="/Application/Home/View/js/base.js"></script>
<link rel="stylesheet" href="/Application/Home/View/css/jquery-ui.min.css">
<link rel="stylesheet" href="/Application/Home/View/css/base.css">

    <link rel="stylesheet" href="/Application/Home/View/css/space.css">


</head>
<body>
    <div id="header">
    <div class="header_main">
        <div class="logo">微博系统</div>
        <div class="nav">
            <ul>
                <li><a href="/index" class="selected">首页</a></li>
                <li><a href="#">广场</a></li>
                <li><a href="#">图片</a></li>
                <li><a href="#">私聊</a></li>
            </ul>
        </div>
        <div class="person">
            <ul>
                <li ><a href="#"><?php echo session("userInfo")['username'];?></a></li>
                <li class="app">消息
                    <dl class="list">
                        <dd><a href="#">@提到我的</a></dd>
                        <dd><a href="#">收到的评论</a></dd>
                        <dd><a href="#">发出的评论</a></dd>
                        <dd><a href="#">我的私信</a></dd>
                        <dd><a href="#">系统的消息</a></dd>
                        <dd><a href="#" class="line">发私信>></a></dd>
                    </dl>
                </li>
                <li class="app">账号
                    <dl class="list">
                        <dd><a href="<?php echo U('/seting/index');?>">个人设置</a></dd>
                        <dd><a href="#">排行榜</a></dd>
                        <dd><a href="#">申请认证</a></dd>
                        <dd><a href="<?php echo U('User/logout');?>" class="line">退出</a></dd>
                    </dl>
                </li>
            </ul>
        </div>
        <div class="search">
            <form>
                <input type="text" id="search" placeholder="微博关键字">
                <a href="javascript:void(0)"></a>
            </form>
        </div>
    </div>
</div>
    <div id="main">
    
    <div class="main_left">
        <div class="person_info">
            <dl>
                <dt><img src="<?php echo ($user["face"]); ?>"> </dt>
                <dd class="name"><?php echo ($user["username"]); ?></dd>
                <dd class="intro">个人简介：<?php echo ($user["userIntro"]); ?></dd>
            </dl>
        </div>
    </div>
    <div class="main_right">

    </div>

</div>
    <div id="loading">...</div>
<div id="footer">
    <div class="footer_left">
        &copy;2016 fazai All Rights Reseved.
    </div>
    <div class="footer_right">
        Powered By ThinkPHP.
    </div>
</div>
</body>
</html>