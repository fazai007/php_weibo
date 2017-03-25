<extend name="Base/common" />
<block name="head">
    <script style="text/javascript" src="__HOME_JS__/seting.js"></script>
    <link rel="stylesheet" href="__HOME_CSS__/seting.css">
</block>
<block name="main">
    <div class="main_left">
        <ul class="set_nav">
            <li><a href="{:U('/seting/index')}" class="selected">个人信息</a></li>
            <li><a href="{:U('/seting/face')}">头像设置</a></li>
            <li><a href="{:U('/seting/domain')}">个性域名</a></li>
            <li><a href="{:U('/seting/refer')}">@提及到我</a></li>
            <li><a href="{:U('/seting/ident')}">申请认证</a></li>
        </ul>
    </div>
    <div class="main_right">
        <h2>个人信息</h2>
        <dl class="set_content">
            <dd>账号名称：{$userInfo.username}</dd>
            <dd>电子邮箱：<input type="text" name="email" value="{$userInfo.email}" class="text"><strong class="request">*</strong></dd>
            <dd><span class="abstract">个人简介：</span><textarea name="intro">{$userInfo['userIntro']['intro']}</textarea></dd>
            <dd><input type="submit" class="submit" value="修改"> </dd>
        </dl>
    </div>
</block>