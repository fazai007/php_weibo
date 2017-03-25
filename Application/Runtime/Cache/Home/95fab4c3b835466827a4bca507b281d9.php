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

    <script type="text/javascript" src="/Public/uploadify/jquery.uploadify.min.js"></script>
    <link rel="stylesheet" href="/Public/uploadify/uploadify.css">
    <script style="text/javascr" src="/Application/Home/View/js/face.js"></script>
    <link rel="stylesheet" href="/Application/Home/View/css/seting.css">
    <script style="text/javascript" src="/Application/Home/View/js/jquery.Jcrop.js"></script>
    <link rel="stylesheet" href="/Application/Home/View/css/jquery.Jcrop.css">
    <style type="text/css">
        .main_right{
            position: relative;
        }
        .main_right .pic_size{
            font-size: 13px;
            color: #666;
            margin-top: 5px;
        }
        .set_content{
            display: none;
            margin:10px 0 0 0;
        }
        .main_right a.save,.main_right a.cancle{
            display: none;
            margin:10px 5px 0 0;
        }
        #preview-pane {
            width: 200px;
            height: 200px;
            display: block;
            border: 1px rgba(0,0,0,.4) solid;
            overflow: hidden;
            position: absolute;
            top: 80px;
            right: 20px;
            background-color: white;
        }
        #file{
            margin-top: 10px;
        }

    </style>


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
        <ul class="set_nav">
            <li><a href="<?php echo U('/seting/index');?>">个人信息</a></li>
            <li><a href="<?php echo U('/seting/face');?>" class="selected">头像设置</a></li>
            <li><a href="<?php echo U('/seting/domain');?>">个性域名</a></li>
            <li><a href="<?php echo U('/seting/refer');?>">@提及到我</a></li>
            <li><a href="<?php echo U('/seting/ident');?>">申请认证</a></li>
        </ul>
    </div>
    <div class="main_right">
        <h2>头像设置</h2>
        <p class="pic_size">请上传一张头像图片，尺寸大小不低于200px * 200px</p>
        <div class="set_content">
            <img src="">
        </div>
        <input type="file" id="file">
        <a href="javascript:void(0)" class="save">保存</a><a href="javascript:void(0)" class="cancle">取消</a>
        <div id="preview-pane">
            <?php if(empty($face)): ?><img src="/Application/Home/View/img/big.jpg" class="jcrop-preview" alt="Preview" />
            <?php else: ?>
                <img src="<?php echo ($face); ?>" class="jcrop-preview" alt="Preview" /><?php endif; ?>

        </div>
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