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
    <script type="text/javascript" src="/Application/Home/View/js/index.js"></script>
    <link rel="stylesheet" href="/Application/Home/View/css/index.css">


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
        <div class="weibo_form">
            <span class="left">和大家分享一些新鲜事吧！</span>
            <span class="right weibo_num">可以输入<strong>140</strong>个字</span>
            <textarea class="weibo_text"></textarea>
            <a href="javascript:void(0);" class="weibo_pic" id="pic_btn">图片<span class="pic_arrow_top"></span></a>
            <div id="weibo_pic_box" class="weibo_pic_box">
                <div class="weibo_pic_header">
                    <span class="weibo_pic_info">共<span class="weibo_pic_total">0</span>张，还可上传<span class="weibo_pic_limit">8</span>张（按ALT+多选）</span>
                    <a href="javascript:void(0)" class="close" >x</a>
                </div>
                <div class="weibo_pic_list"></div>
                <input type="file" name="file" id="file">
            </div>
            <input class="weibo_button" type="button" value="发布">
        </div>
        <div class="weibo_content">
            <ul>
                <li><a href="javascript:void(0)" class="selected">我关注的<i/></a></li>
                <li><a href="javascript:void(0)">互听的</a></li>
            </ul>
            <div class="msg">有<span class="msg_num">0</span>条新消息，请点击查看</div>
            <input id="topicsNum" value="<?php echo ($topicsNum); ?>" type="hidden">
            <?php if(is_array($topics)): $i = 0; $__LIST__ = $topics;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$obj): $mod = ($i % 2 );++$i;?><dl class="weibo_content_data">
                    <dt>
                        <a href="/space/index?id=<?php echo ($obj["uid"]); ?>" target="_blank"><img src="<?php echo ($obj["face"]); ?>"></a>
                    </dt>
                    <dd>
                        <h4><a href="/space/index?id=<?php echo ($obj["uid"]); ?>" target="_blank"><?php echo ($obj["username"]); ?></a> </h4>
                        <p><?php echo ($obj["content"]); echo ($obj["content_over"]); ?></p>
                        <?php $__FOR_START_459__=0;$__FOR_END_459__=$obj["imgCount"];for($i=$__FOR_START_459__;$i < $__FOR_END_459__;$i+=1){ ?><div class="img"><img src="<?php echo ($obj['topicImg'][$i]['thumb']); ?>" src-unfold="<?php echo ($obj['topicImg'][$i]['unfold']); ?>" src-source="<?php echo ($obj['topicImg'][$i]['source']); ?>" ></div>
                            <!--<div class="img_zoom">
                                <ol>
                                    <li class="in"><a href="javascript:void(0)">收起</a> </li>
                                    <li class="source"><a href="javascript:void(0)">查看原图</a> </li>
                                </ol>
                                <img data="<?php echo ($obj['topicImg'][$i]['unfold']); ?> ">
                            </div>--><?php } ?>
                        <div class="content-footer">
                            <span class="time"><?php echo ($obj["create"]); ?></span>
                            <span class="handler">赞(0) | <a class="do_comment" href="javascript:void(0)">评论</a> | 收藏</span>
                        </div>
                        <div class="comment">
                            <div class="comment_input">
                                <input type="hidden" name="tid" value="<?php echo ($obj["id"]); ?>">
                                <textarea class="send_content" name="send_content"></textarea>
                                <input type="button" value="评论" class="com_button">
                            </div>
                            <?php if(empty($obj["comment"])): ?><ol class="comment_list" style="display: none;"></ol><?php else: ?>
                                <ol class="comment_list">
                                    <?php if(is_array($obj["comment"])): $i = 0; $__LIST__ = $obj["comment"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$comment): $mod = ($i % 2 );++$i;?><li>
                                            <p><a target="_blank" href="/space/index?id=<?php echo ($comment["uid"]); ?>"><?php echo ($comment["username"]); ?></a>：<?php echo ($comment["content"]); ?></p>
                                            <p class="com_time" ><?php echo ($comment["creat"]); ?></p>
                                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                </ol><?php endif; ?>
                        </div>
                    </dd>
                </dl><?php endforeach; endif; else: echo "" ;endif; ?>
            <!--评论模板-->
            <ol id="comment_model" style="display: none;">
                <li><p><a target="_blank" href="/space/index?id=<?php echo session("userInfo")["id"];?>"><?php echo session("userInfo")["username"];?></a>：comment_content</p><p class="com_time" >刚刚</p></li>
            </ol>

            <!--无刷新发布微博，微博信息模板框-->
            <div id="ajax_msg_model" style="display: none">
                <dl class="weibo_content_data">
                    <dt>
                        <a href="javascript:void(0)"><img src="<?php echo ($face); ?>"></a>
                    </dt>
                    <dd>
                        <h4><a href="javascript:void(0)"><?php echo session('userInfo')['username'];?></a> </h4>
                        <p>message_block</p>
                        image_block
                        <div class="content-footer">
                            <span class="time">刚刚发布</span>
                            <span class="handler">赞(0) | 转播 | 评论 | 收藏</span>
                        </div>
                    </dd>
                </dl>
            </div>
            <div id="imgs">
                <ol>
                    <li class="source"><a href="javascript:void(0)" target="_blank">查看原图</a> </li>
                </ol>
                <img>
            </div>
            <div id="loadmore">更多加载<img src="/Application/Home/View/img/loadmore.gif"> </div>
        </div>

    </div>
    <div class="main_right">
        <div class="user_info">
            <img src="<?php echo session("userInfo")["face"];?>">
            <a href="javascript:void(0)"><?php echo session("userInfo")["username"];?></a>
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