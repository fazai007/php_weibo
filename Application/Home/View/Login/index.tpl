<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>微博系统--前台登录</title>
    <script type="text/javascript" src="__JS__/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="__JS__/jquery.form.js"></script>
    <script type="text/javascript" src="__JS__/jquery.validate.js"></script>
    <script type="text/javascript" src="__HOME_JS__/jquery-ui.js"></script>
    <script type="text/javascript" src="__HOME_JS__/login.js"></script>
    <link rel="stylesheet" href="__HOME_CSS__/jquery-ui.min.css">
    <link rel="stylesheet" href="__HOME_CSS__/login.css">
</head>
<body>
    <div id="header"></div>
    <div id="main">
        <form id="login" method="post">
            <div id="top">
                <span class="user">
                    <input type="text" name="user" placeholder="账号/邮箱">
                </span>
                <span class="password">
                    <input type="password" name="password" placeholder="密码">
                    <label class="auto" for="auto"><input type="checkbox" name="auto" id="auto">自动登录</label>
                </span>
                <input type="submit" name="submit" value="登录">
            </div>
        </form>
        <div class="reg_fg">
            <a href="javascript:void(0)" id="reg_link">注册新用户</a>
            <a href="javascript:void(0)">忘记密码？</a>
        </div>
        <div id="register">
            <form>
                <ol class="register_error"></ol>
                <p>
                    <label for="user">账号：</label>
                    <input type="text" name="username" class="text" placeholder="昵称，不小于两位">
                    <span class="star">*</span>
                </p>
                <p>
                    <label for="password">密码：</label>
                    <input type="password" name="password" id="password" class="text" placeholder="密码，不小于六位">
                    <span class="star">*</span>
                </p>
                <p>
                    <label for="repassword">确认：</label>
                    <input type="password" name="repassword" class="text" placeholder="密码保持一致">
                    <span class="star">*</span>
                </p>
                <p>
                    <label for="email">邮箱：</label>
                    <input type="text" name="email" class="text" placeholder="请输入真实邮箱">
                    <span class="star">*</span>
                </p>
            </form>
        </div>
        <div id="loading">数据加载中...</div>
        <form id="check_code" checkfor="" >
            <div class="verify_error"></div>
            <p>
                <label for="verifyCode">验证码：</label>
                <input type="text" name="verifyCode">
                <a class="changeCode" href="javascript:void(0)">换一张</a>
            </p>
            <p><img class="changeCode codeImg" src="{:U('checkCode')}"></p>
        </form>
    </div>
    <div id="footer"></div>
    <p class="footer-text">&copy;2016-2017 發仔原创 Powerd by thinkPHP.</p>
</body>
</html>