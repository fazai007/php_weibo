/**
 * Created by niu on 2017/2/26.
 */
$(function () {
    //路径配置
    var Path = {
        'IMG':'/Application/Home/View/img',
        'UPLOADIFY' : '/Public/uploadify',
        'FILEUPLOAD' : '/File/faceUpload',
    };

    //提示框初始化
    $("#loading").dialog({
        autoOpen : false,
        modal : true,
        closeOnEscape : false,
        resizable : false,
        draggable : false,
        width : 180,
        height : 40,
    }).css({
        background : '#fff',
    }).siblings().remove();

    //个人头像页面的头像裁剪
    var jcrop_api;
    function myJcrop() {
        var boundx,boundy,
            $pcnt = $('#preview-pane'),
            $pimg = $('#preview-pane img'),
            xsize = $pcnt.width(),
            ysize = $pcnt.height();
        $(".set_content img").Jcrop({
            onChange: updatePreview,
            onSelect: updatePreview,
            aspectRatio: xsize / ysize
        },function(){
            // Use the API to get the real image size
            var bounds = this.getBounds();
            boundx = bounds[0];
            boundy = bounds[1];
            // Store the API in the jcrop_api variable
            jcrop_api = this;
            jcrop_api.setSelect([0,0,200,200]);
        });
        //有鼠标选定的区域改变小框内的图像
        function updatePreview(c)
        {
            window.pic_x = c.x;
            window.pic_y = c.y;
            window.pic_w = c.w;
            window.pic_h = c.h;
            if (parseInt(c.w) > 0)
            {
                var rx = xsize / c.w;
                var ry = ysize / c.h;

                $pimg.css({
                    width: Math.round(rx * boundx) + 'px',
                    height: Math.round(ry * boundy) + 'px',
                    marginLeft: '-' + Math.round(rx * c.x) + 'px',
                    marginTop: '-' + Math.round(ry * c.y) + 'px'
                });
            }
        };
    }

    //头像上传函数
    //uploadify插件调用
    $("#file").uploadify({
        swf : Path['UPLOADIFY'] + '/uploadify.swf',
        uploader : Path['FILEUPLOAD'],
        fileTypeDesc : '图片类型',
        buttonText : '上传头像',
        fileTypeExts : '*.jpeg; *.gif; *.jpg; *.png',
        fileSizeLimit   : '1MB',
        overrideEvents : ['onSelectError','onSelect','onDialogClose'],
        //上传失败信息显示
        onSelectError : function (file,errorCode,errorMsg) {
            switch (errorCode){
                case -110 :
                    //loading框提示文件上传错误信息
                    $('#loading').html('文件超出1M...');
                    $('#loading').dialog('open');
                    setTimeout(function () {
                        $('#loading').dialog('close');
                    },1500);
                    break;
            }
        },
        onUploadStart : function () {
            $('#loading').html('头像上传中...');
            $('#loading').dialog('open');
        },
        onUploadSuccess : function (file,data,response) {
            $("#loading").css({background:"url(/Application/Home/View/img/success_tag.jpg) no-repeat 20px center"}).html("头像上传成功");
            setTimeout(function () {
                window.pic_path = data;
                $("#loading").dialog("close");
                //后台返回上传图片尺寸500宽的地址
                $(".set_content img").attr("src",data);
                $("#preview-pane img").attr("src",data);
                $(".set_content").show();
                $("#file").hide();
                $(".save,.cancle").show();
                myJcrop();
            },1000);
        }
    });
    //调用jQuery-UI按钮
    $(".save,.cancle").button();
    $(".save").click(function () {
        $.ajax({
            url : "/seting/face",
            type : "post",
            data : {
                'pic_path' : window.pic_path,
                'pic_x' : window.pic_x,
                'pic_y' : window.pic_y,
                'pic_w' : window.pic_w,
                'pic_h' : window.pic_h,
            },
            success : function (data,response,status) {
                if(data){
                    jcrop_api.destroy();
                    $("#loading").css({background:"url(/Application/Home/View/img/success_tag.jpg) no-repeat 20px center"}).html("头像保存成功");
                    $("#loading").dialog("open");
                    setTimeout(function () {
                        $('#loading').dialog('close');
                        $(".save,.cancle").hide();
                        $(".set_content").hide();
                        $("#file").show();
                    },500);
                };
            }
        });
    });
    $(".cancle").click(function () {
        jcrop_api.destroy();
        $(".save,.cancle").hide();
        $(".set_content").hide();
        $("#file").show();
        $("#preview-pane img").attr("src","/Application/Home/View/img/big.jpg").attr("style","");
    });
});
