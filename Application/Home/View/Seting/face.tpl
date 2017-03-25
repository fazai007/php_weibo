<extend name="Base/common" />
<block name="head">
    <script type="text/javascript" src="__UPLOADIFY__/jquery.uploadify.min.js"></script>
    <link rel="stylesheet" href="__UPLOADIFY__/uploadify.css">
    <script style="text/javascr" src="__HOME_JS__/face.js"></script>
    <link rel="stylesheet" href="__HOME_CSS__/seting.css">
    <script style="text/javascript" src="__HOME_JS__/jquery.Jcrop.js"></script>
    <link rel="stylesheet" href="__HOME_CSS__/jquery.Jcrop.css">
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
</block>
<block name="main">
    <div class="main_left">
        <ul class="set_nav">
            <li><a href="{:U('/seting/index')}">个人信息</a></li>
            <li><a href="{:U('/seting/face')}" class="selected">头像设置</a></li>
            <li><a href="{:U('/seting/domain')}">个性域名</a></li>
            <li><a href="{:U('/seting/refer')}">@提及到我</a></li>
            <li><a href="{:U('/seting/ident')}">申请认证</a></li>
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
            <empty name="face">
                <img src="__HOME_IMG__/big.jpg" class="jcrop-preview" alt="Preview" />
            <else />
                <img src="{$face}" class="jcrop-preview" alt="Preview" />
            </empty>

        </div>
    </div>
</block>