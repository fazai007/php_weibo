/**
 * Created by niu on 2017/2/15.
 */
$(function () {
    //路径配置
    var Path = {
        'IMG':'/Application/Home/View/img',
        'UPLOADIFY' : '/Public/uploadify',
        'FILEUPLOAD' : '/File/faceUpload',
    };
    //个人信息修改页面的信息提交
    $(".submit").button().click(function () {
        $.ajax({
            url : '/seting/setUserInfo',
            type : 'POST',
            data : {
                'email' : $("input[name='email']").val(),
                'intro' : $("textarea[name='intro']").val(),
            },
            success : function (data,response,status) {
            },
        });
    });
    
});