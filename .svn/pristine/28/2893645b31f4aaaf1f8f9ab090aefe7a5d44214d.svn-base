/**
 * Created by niu on 2016/12/31.
 */
$(function () {
    var Path = {
        'IMG':'/Application/Home/View/img',
        'INDEX' : '/Index',
    };
    var num_img = Math.floor(Math.random()*4)+1;
    var img = Path['IMG']+'/bag_'+num_img+'.jpg';
    //更改背景图片
    $("body").css('background','url('+img+') no-repeat')
        .css('background-size','100%');
    $("input:submit").button();
    $("#register").dialog({
        width:430,
        height:358,
        modal:true,
        title:'注册用户',
        autoOpen:false,
        resizable:false,
        closeText:'关闭',
        buttons:[{
            text:'提交',
            click:function(e){
                $("#register form").submit();
            },
        }],
    });
    $("#login").validate({
        submitHandler : function (form) {
            $('#check_code').attr("checkfor",'login');
            $('#check_code').dialog("open");
        },
        rules : {
            user : {
                required : true,
                minlength : 2,
                maxlength : 50,
            },
            password : {
                required : true,
                minlength : 6,
                maxlength : 30,
            }
        },
        messages : {
            user : {
                required : '必填',
                minlength : '需大于2位',
                maxlength : '需小于50位',
            },
            password : {
                required : '必填',
                minlength : '需大于6位',
                maxlength : '需小于30位',
            }
        }
    });
    $("#register form").validate({
        submitHandler : function (form) {
            $('#check_code').attr("checkfor",'register');
            $('#check_code').dialog("open");
        },
        errorLabelContainer : 'ol.register_error',
        wrapper : 'li',
        showErrors : function (errorMap,errorList) {
            this.defaultShowErrors();
            var errors = this.numberOfInvalids();
            if(errors > 0){
                $("#register").dialog('option','height',errors*20+358);
            }else{
                $("#register").dialog('option','height',358);
            }
        },
        highlight : function (element,errorClass) {
            $(element).css('border','1px solid red');
            $(element).next('span').html("*").removeClass("succ");
        },
        unhighlight : function (element,errorClass) {
            $(element).css('border','1px solid #ccc');
            $(element).next('span').html("&nbsp").addClass("succ");
        },
        rules : {
            username : {
                required : true,
                minlength : 2,
                maxlength : 20,
                speChar : true,
                remote: {
                    url: "/Home/User/checkField",     //后台处理程序
                    type: "post",               //数据发送方式
                    data: {                     //要传递的数据
                        username : function() {
                            return $("#register input[name=username]").val();
                        },
                        type : 'username'
                    }
                }
            },
            password : {
                required : true,
                minlength : 6,
                maxlength : 30,
            },
            repassword : {
                required : true,
                equalTo : '#password',
            },
            email : {
                required : true,
                email : true,
                remote: {
                    url: "/Home/User/checkField",     //后台处理程序
                    type: "post",               //数据发送方式
                    data: {                     //要传递的数据
                        email : function() {
                            return $("#register input[name=email]").val();
                        },
                        type : 'email'
                    }
                }
            }
        },
        messages : {
            username : {
                required : '账号不得为空',
                minlength : $.format('用户名必须2-20个字符'),
                maxlength : $.format('用户名必须2-20个字符'),
                speChar : '账号不得包含@符号',
                remote : '账号已被使用'
            },
            password : {
                required : '密码不得为空',
                minlength : $.format('密码必须6-30个字符'),
                maxlength : $.format('密码必须6-30个字符'),
            },
            repassword : {
                required : '请输入确认密码',
                equalTo : '密码不一致',
            },
            email : {
                required : '邮箱不得为空',
                email : '邮箱格式不正确',
                remote : '邮箱已被使用',
            }
        },
    });
    //注册弹框样式调整
    $("#register").parent("div").css('background','#eee');
    $("#register").prev("div").css('background','limegreen');
    $("#register").next("div").css('background','#eee').css('text-align','center');
    $("#register").next("div").children("div").css({"float":"none"});
    $("#register").next("div").children("div").children("button").css({'background':'limegreen'});

    //自定义validate的验证方法
    $.validator.addMethod('speChar',function (value,element) {
        var regexChar = /^[^@]+$/i;
        return this.optional(element) || (regexChar.test(value));
    },'包含@字符');

    //loading加载框
    $("#loading").dialog({
        autoOpen : false,
        modal : true,
        closeOnEscape : false,
        resizable : false,
        draggable : false,
        width : 180,
        height : 40,
    }).prev("div").hide();

    //验证码框
    $("#check_code").dialog({
        width:300,
        height:300,
        modal:true,
        title:'验证码',
        autoOpen:false,
        resizable:false,
        closeText:'关闭',
        buttons:[{
            text:'提交',
            click:function(e){
                $(this).submit();
            },
        }],
    });
    $("#check_code").validate({
        submitHandler : function (form) {
            var checkfor = $("#check_code").attr('checkfor');
            if(checkfor == 'register'){
                $("#register form").ajaxSubmit({
                    url : '/Home/User/register',
                    type : 'POST',
                    beforeSubmit : function () {
                        $("#loading").dialog('open');
                    },
                    success : function (responseText,statusText) {
                        if(responseText){
                            $('#loading').css('background','url('+Path['IMG']+'/success_tag.jpg) no-repeat 20px center').html('注册成功');
                            setTimeout(function () {
                                $('#register form').resetForm();
                                $('#loading').dialog('close');
                                $('#register').dialog('close');
                                $('#check_code').dialog('close');
                                $('#register span.star').html("*").removeClass('succ');
                                $('#loading').html("数据加载中...").css('background','url('+Path['IMG']+'/loading.gif) no-repeat 20px center');
                            },1000);

                            //更换验证码
                            var src = $("#check_code .codeImg").attr('src');
                            if(src.indexOf("?") > 0){
                                $("#check_code .codeImg").attr('src',src+'&random='+Math.random());
                            }else{
                                $("#check_code .codeImg").attr('src',src+'?random='+Math.random());
                            }
                        }
                    }
                });
            }else if(checkfor == 'login'){
                $("#login").ajaxSubmit({
                    url : '/Home/User/login',
                    type : 'post',
                    beforeSubmit : function () {
                        $("#loading").dialog('open');
                    },
                    success : function (responseText,statusText) {
                        if(responseText == -9){
                            $('#check_code').dialog('close');
                            $('#loading').css('background','url('+Path['IMG']+'/error.png) no-repeat 20px center').html('密码错误');
                            setTimeout(function () {
                                $('#loading').dialog('close');
                                $('#loading').html("数据加载中...").css('background','url('+Path['IMG']+'/loading.gif) no-repeat 20px center');
                            },1000);
                        }else if(responseText == 0){
                            $('#check_code').dialog('close');
                            $('#loading').css('background','url('+Path['IMG']+'/error.png) no-repeat 20px center').html('用户名错误');
                            setTimeout(function () {
                                $('#loading').dialog('close');
                                $('#loading').html("数据加载中...").css('background','url('+Path['IMG']+'/loading.gif) no-repeat 20px center');
                            },1000);
                        }else if(responseText > 0){
                            $('#check_code').dialog('close');
                            $('#loading').css('background','url('+Path['IMG']+'/success_tag.jpg) no-repeat 20px center').html('登录成功');
                            setTimeout(function () {
                                $('#loading').dialog('close');
                                $('#loading').html("数据加载中...").css('background','url('+Path['IMG']+'/loading.gif) no-repeat 20px center');
                                location.href = Path['INDEX'];
                            },1000);
                        }

                        //更换验证码
                        var src = $("#check_code .codeImg").attr('src');
                        if(src.indexOf("?") > 0){
                            $("#check_code .codeImg").attr('src',src+'&random='+Math.random());
                        }else{
                            $("#check_code .codeImg").attr('src',src+'?random='+Math.random());
                        }
                    }
                });
            }

        },
        errorLabelContainer : 'div.verify_error',
        highlight : function (element,errorClass) {
            $(element).css('border','1px solid red');
        },
        unhighlight : function (element,errorClass) {
            $(element).css('border','1px solid #ccc');
        },
        rules : {
            verifyCode : {
                required : true,
                remote: {
                    url: "/Home/User/checkCode",     //后台处理程序
                    type: "post",               //数据发送方式
                }
            }
        },
        messages : {
            verifyCode : {
                required : '验证码不能为空',
                remote : '验证码错误',
            }
        }
    });
    //注册弹框样式调整
    $("#check_code").parent("div").css('background','#eee');
    $("#check_code").prev("div").css('background','limegreen');
    $("#check_code").next("div").css('background','#eee').css('text-align','center');
    $("#check_code").next("div").children("div").css({"float":"none"});
    $("#check_code").next("div").children("div").children("button").css({'background':'limegreen'});
    $("#check_code .changeCode").click(function () {
        var src = $("#check_code .codeImg").attr('src');
        if(src.indexOf("?") > 0){
            $("#check_code .codeImg").attr('src',src+'&random='+Math.random());
        }else{
            $("#check_code .codeImg").attr('src',src+'?random='+Math.random());
        }
    });

    $("#reg_link").click(function () {
        $("#register").dialog('open');
    });
});