<extend name="Base/common" />
<block name="head">
    <script style="text/javascript" src="__HOME_JS__/refer.js"></script>
    <link rel="stylesheet" href="__HOME_CSS__/seting.css">
    <style type="text/css">
        .main_right p{
            font-size: 14px;
            color: #555;
            margin-top: 10px;
        }
        .main_right p a{
            color: blue;
            text-decoration: none;
        }
    </style>
</block>
<block name="main">
    <div class="main_left">
        <ul class="set_nav">
            <li><a href="{:U('/seting/index')}">个人信息</a></li>
            <li><a href="{:U('/seting/face')}">头像设置</a></li>
            <li><a href="{:U('/seting/domain')}">个性域名</a></li>
            <li><a href="{:U('/seting/refer')}"class="selected">@提及到我</a></li>
            <li><a href="{:U('/seting/ident')}">申请认证</a></li>
        </ul>
    </div>
    <div class="main_right">
        <h2>@提及到我的</h2>
        <empty name="refers">
            <p>暂时没有微博提及到您</p>
        <else/>
            <volist name="refers" id="refer">
                <p>您被微博：<a href="javascript:void(0)" onclick="cleanRefer(this)" id="{$refer.id}">{$refer.content|mb_substr=0,10,utf8}</a> 提及到</p>
            </volist>
        </empty>
    </div>
</block>