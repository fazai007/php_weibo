<extend name="Base/common" />
<block name="head">
    <script type="text/javascript" src="__UPLOADIFY__/jquery.uploadify.min.js"></script>
    <link rel="stylesheet" href="__UPLOADIFY__/uploadify.css">
    <script type="text/javascript" src="__HOME_JS__/index.js"></script>
    <link rel="stylesheet" href="__HOME_CSS__/index.css">
</block>
<block name="main">
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
            <input id="topicsNum" value="{$topicsNum}" type="hidden">
            <volist name="topics" id="obj">
                <dl class="weibo_content_data">
                    <dt>
                        <a href="/space/index?id={$obj.uid}" target="_blank"><img src="{$obj.face}"></a>
                    </dt>
                    <dd>
                        <h4><a href="/space/index?id={$obj.uid}" target="_blank">{$obj.username}</a> </h4>
                        <p>{$obj.content}{$obj.content_over}</p>
                        <for start="0" end="$obj.imgCount">
                            <div class="img"><img src="{$obj['topicImg'][$i]['thumb']}" src-unfold="{$obj['topicImg'][$i]['unfold']}" src-source="{$obj['topicImg'][$i]['source']}" ></div>
                            <!--<div class="img_zoom">
                                <ol>
                                    <li class="in"><a href="javascript:void(0)">收起</a> </li>
                                    <li class="source"><a href="javascript:void(0)">查看原图</a> </li>
                                </ol>
                                <img data="{$obj['topicImg'][$i]['unfold']} ">
                            </div>-->
                        </for>
                        <div class="content-footer">
                            <span class="time">{$obj.create}</span>
                            <span class="handler">赞(0) | <a class="do_comment" href="javascript:void(0)">评论</a> | 收藏</span>
                        </div>
                        <div class="comment">
                            <div class="comment_input">
                                <input type="hidden" name="tid" value="{$obj.id }">
                                <textarea class="send_content" name="send_content"></textarea>
                                <input type="button" value="评论" class="com_button">
                            </div>
                            <empty name="obj.comment"><ol class="comment_list" style="display: none;"></ol><else/>
                                <ol class="comment_list">
                                    <volist name="obj.comment" id="comment">
                                        <li>
                                            <p><a target="_blank" href="/space/index?id={$comment.uid}">{$comment.username}</a>：{$comment.content}</p>
                                            <p class="com_time" >{$comment.creat}</p>
                                        </li>
                                    </volist>
                                </ol>
                            </empty>
                        </div>
                    </dd>
                </dl>
            </volist>
            <!--评论模板-->
            <ol id="comment_model" style="display: none;">
                <li><p><a target="_blank" href="/space/index?id={:session("userInfo")["id"]}">{:session("userInfo")["username"]}</a>：comment_content</p><p class="com_time" >刚刚</p></li>
            </ol>

            <!--无刷新发布微博，微博信息模板框-->
            <div id="ajax_msg_model" style="display: none">
                <dl class="weibo_content_data">
                    <dt>
                        <a href="javascript:void(0)"><img src="{$face}"></a>
                    </dt>
                    <dd>
                        <h4><a href="javascript:void(0)">{:session('userInfo')['username']}</a> </h4>
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
            <div id="loadmore">更多加载<img src="__HOME_IMG__/loadmore.gif"> </div>
        </div>

    </div>
    <div class="main_right">
        <div class="user_info">
            <img src="{:session("userInfo")["face"]}">
            <a href="javascript:void(0)">{:session("userInfo")["username"]}</a>
        </div>
    </div>
</block>