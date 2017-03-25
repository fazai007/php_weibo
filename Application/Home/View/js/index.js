/**
 * Created by niu on 2017/1/10.
 */
//常量定义
var Path = {
    'IMG':'/Application/Home/View/img',
    'UPLOADIFY' : '/Public/uploadify',
    'FILEUPLOAD' : 'File/fileUpload',
};
$(function () {
    //微博展示中图片居中调整
    function display_center() {
        if($('.weibo_content_data .img img').width() > 120){
            $('.weibo_content_data .img img').css('left',-($('.weibo_content_data .img img').width()-120)/2);
        }else{
            $('.weibo_content_data .img img').width(120);
        }
        if($('.weibo_content_data .img img').height() > 120){
            $('.weibo_content_data .img img').css('top',-($('.weibo_content_data .img img').height()-120)/2);
        }else{
            $('.weibo_content_data .img img').height(120);
        }
    }
    display_center();
    //单张图片单击图片查看大图
    /*$('.img img').click(function () {
        $(this).parent().hide();
        var $img_zoom = $(this).parent().next('.img_zoom');
        var $img = $img_zoom.find('img');
        $img.attr('src',$img.attr('data'));
        $img_zoom.show();
    });
    $('.img_zoom img,.img_zoom .in').click(function () {
        $('.img_zoom').hide();
        $('.img').show();
    });*/
    //多张图片的弹层显示
    $("#imgs").dialog({
        autoOpen : false,
        modal : true,
        closeOnEscape : false,
        resizable : false,
        draggable : false,
        width:600,
    }).parent().find('.ui-widget-header').hide();
    $('#imgs').dialog('widget').css({
        background : '#fafafa',
        border : '1px solid #ccc',
        position : 'fixed'
    });
    //多图查看
    function bigImgShow() {
        $('.img img').click(function () {
            var _this = this;
            imgLoadEvent(function (obj) {
                $('#imgs').dialog('open').dialog('option','height',obj["h"]+90);
                $("#imgs ol li a").attr('href',$(_this).attr('src-source'));
                $('#imgs img').attr('src',$(_this).attr('src-unfold'));
            },$(_this).attr('src-unfold'));

        });
        $("#imgs img").click(function () {
            $("#imgs").dialog('close');
        });
    }
    bigImgShow();
    //通过URL获取图片的长和高
    function imgLoadEvent(callback,url) {
        var img = new Image();
        img.onreadystatechange = function () {
            if(this.readyState == "complete"){
                callback({"w":img.width,"h":img.height});
            }
        }
        img.onload = function () {
            if(this.complete == true){
                callback({"w":img.width,"h":img.height});
            }
        }
        img.onerror = function () {
            callback({"w":0,"h":0});
        }
        img.src = url;
    }
    //微博发布的按钮
    //$('.weibo_button').button();
    //高度保持一致
    if($('.main_left').height() > 800){
        $('.main_right').height($('.main_left').height()+80);
        $('#main').height($('.main_left').height()+80);
    };
    function keepHeight() {
        $("#main").height($('.main_left').height());
        $('.main_right').height($('.main_left').height());
    }
    //输入框字数检测和数字提示
    $('.weibo_text').on('keyup',function (e) {
        var maxLen = 280;
        var len = $('.weibo_text').val().length;
        var content = $(this).val();
        var tmp = 0;
        var residue = 280;
        if(len > 0){
            for(var i=0;i<len;i++){
                if(content.charCodeAt(i) > 255){
                    tmp += 2;
                }else{
                    tmp++;
                }
            }
            residue = parseInt((maxLen-tmp)/2);
            $('.weibo_num strong').html(residue);
        }
        if(residue < 0){
            $('.weibo_num strong').css('color','red');
        }else{
            $('.weibo_num strong').css('color','#049');
        }
    });
    //发布按钮点击检测
    $('.weibo_button').button().click(function () {
        var pubCont = $('.weibo_text').val().length;
        var strongValue = parseInt($('.weibo_num strong').html());
        var imgPath = [];
        var imgs = $('input[name="imgUrl"]');
        var len = imgs.length;
        for(var i=0;i<len;i++){
            imgPath[i] = imgs.eq(i).val();
        }
        if(pubCont == 0 && len == 0){
            //loading加载框
            $('#loading').html('发布内容不能为空');
            $('#loading').dialog('open');
            setTimeout(function () {
                $('#loading').dialog('close');
            },1500);
        }else if(len > 0 && pubCont == 0){
            $(".weibo_text").val('图片分享');
        }else if(strongValue < 0){
            //loading加载框
            $('#loading').html('发布内容超出限制');
            $('#loading').dialog('open');
            setTimeout(function () {
                $('#loading').dialog('close');
            },1500);
        }else{
            $.ajax({
                url : '/Topic/publish',
                type : 'POST',
                data : {
                    'content' : $(".weibo_text").val(),
                    'imgs' : imgPath,
                },
                beforeSend : function () {
                    $("#loading").css('background','url('+Path['IMG']+'/loading.gif) no-repeat 20px center');
                    $('#loading').html('发布中...');
                    $('#loading').dialog('open');
                },
                success : function (response,status) {
                    $("#loading").css('background','url('+Path['IMG']+'/success_tag.jpg) no-repeat 20px center').html('发布成功');
                    setTimeout(function () {
                        $("#loading").dialog("close");
                    },500);
                    //静态展示发布内容
                    staticDisplay();
                    //清空页面加载，填充信息
                    $('.weibo_pic_content').remove();
                    $(".weibo_text").val('');
                    $(".weibo_pic_total").text(0);
                    $(".weibo_pic_limit").text(8);
                    window.uploadCount.clear();
                },
            });
        }
    });
    /**
     * 静态展示（无刷新）发布内容
     */
    function staticDisplay() {
        //获取信息模板
        var $html = $("#ajax_msg_model").html();
        $html = $html.replace(/message_block/g,$(".weibo_text").val());
        //制作插图块，插图替换
        var img_block = '';
        var $pic_content = $(".weibo_pic_content");
        var len = $pic_content.length;
        for(var i=0;i<len;i++){
            var thumb_url = $($pic_content[i]).find('img').attr('src');
            var source = thumb_url.replace('180_','');
            var unfold = thumb_url.replace('180_','550_');
            img_block += '<div class="img"><img src="'+thumb_url+'" src-unfold="'+unfold+'" src-source="'+source+'" ></div>';
        };
        $html = $html.replace('image_block',img_block);
        setTimeout(function () {
            $('.weibo_content ul').after($html);
            display_center();
            bigImgShow();
        },500);
    }
    //提示框初始化
    $("#loading").dialog({
        autoOpen : false,
        modal : true,
        closeOnEscape : false,
        resizable : false,
        draggable : false,
        width : 180,
        height : 40,
    }).prev("div").hide();
    //微博插图功能
    var lee_pic = {
        uploadTotal : 0,
        uploadLimit : 8,
        //允许上传图片数目限制
        reset : function () {
            uploadTotal = 0;
            uploadLimit = 8;
        },
        //上传图图片
        uploadify : function () {
            //uploadify插件调用
            $('#file').uploadify({
                swf : Path['UPLOADIFY'] + '/uploadify.swf',
                uploader : Path['FILEUPLOAD'],
                fileTypeDesc : '图片类型',
                buttonText : '上传图片',
                fileTypeExts : '*.jpeg; *.gif; *.jpg; *.png',
                fileSizeLimit   : '1MB',
                overrideEvents : ['onSelectError','onSelect','onDialogClose'],
                onUploadStart : function () {
                    if(lee_pic.uploadTotal == 8){
                        $("#file").uploadify('cancel');//删除上传队列应该在stop之前执行。
                        $("#file").uploadify('stop');
                        //loading框提示文件上传错误信息
                        $('#loading').html('文件数已达到上限').dialog('open');
                        setTimeout(function () {
                            $('#loading').dialog('close');
                        },1500);
                    }
                },
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
                onUploadSuccess : function (file,data,response) {
                    var img = $.parseJSON(data);
                    //$.parseJSON(data);把data的json解析为js的对象的,同时把图片的地址放在隐藏的input中，发送给后台。
                    $('.weibo_pic_list').append('<div class="weibo_pic_content"><span class="remove"><strong>删 除</strong></span><img class="weibo_pic_img" src="'+img['thumb']+'" /><input type="hidden" name="imgUrl" value=\''+data+'\'> </div>');
                    //应为lee_pic.imgModify()和上一条语句几乎同时执行，所以造成上面的元素还没生成，下面的语句查找不到未生成的元素。
                    setTimeout(function () {
                        lee_pic.imgModify();
                    },100);
                    lee_pic.hover();
                    lee_pic.uploadTotal++;
                    lee_pic.uploadLimit--;
                    $('.weibo_pic_total').text(lee_pic.uploadTotal);
                    $('.weibo_pic_limit').text(lee_pic.uploadLimit);
                }
            });
        },
        //图片缩略图的移位
        imgModify : function () {
            var $img = $('.weibo_pic_img');
            var len = $img.length;
            if($($img[len-1]).width() > 100){
                $($img[len-1]).css('left',-($($img[len-1]).width()-100)/2);
            }
            if($($img[len-1]).height() > 100){
                $($img[len-1]).css('top',-($($img[len-1]).height()-100)/2);
            }
        },
        //图片删除块的动态显示
        hover : function () {
            var $img = $('.weibo_pic_content');
            var len = $img.length;
            $($img[len-1]).hover(
                function () {
                    $(this).children('span').click(function () {
                        $(this).parent().remove();
                        lee_pic.uploadTotal--;
                        lee_pic.uploadLimit++;
                        $('.weibo_pic_total').text(lee_pic.uploadTotal);
                        $('.weibo_pic_limit').text(lee_pic.uploadLimit);
                    }).show();
                },
                function () {
                    $(this).children('span').hide();
                }
            );
        },
        init : function () {
            $('#pic_btn').on('click',function () {
                var w = $(this).position();
                $('#weibo_pic_box').css({top:w.top+30}).show();
                $('.pic_arrow_top').show();
                lee_pic.uploadify();
            })
            $(document).on('click',function (e) {
                var target = $(e.target);
                if(target.closest('#pic_btn').length == 1 || target.closest(".weibo_pic_content .remove").length == 1){
                    return ;
                }
                if(target.closest('#weibo_pic_box').length == 0){
                    $('#weibo_pic_box').hide();
                    $('.pic_arrow_top').hide();
                }
            })
        }
    };
    //开启一个对外接口使其他程序可以访问到到lee_pic对象的私有成员
    window.uploadCount = {
        clear : function () {
            lee_pic.uploadTotal = 0;
            lee_pic.uploadLimit = 8;
        }
    };
    lee_pic.init();
    $(".close").click(function () {
        $('#weibo_pic_box').hide();
        $('.pic_arrow_top').hide();
    });
    //页面底部，加载更多
    window.scrollFlag = true;
    var topicsNum = $("#topicsNum").val();
    window.count = Math.ceil(topicsNum/5);
    window.page = 1;
    $(window).scroll(function () {
        if(window.scrollFlag){
            if($(document).scrollTop() >= $('#loadmore').offset().top + $('#loadmore').outerHeight() - $(window).height() - 20){
                if(window.page<window.count){
                    setTimeout(function () {
                        $.ajax({
                            url : document.URL+'/partLoad',
                            type : 'POST',
                            data : {
                                page : window.page
                            },
                            success : function (data,response,status) {
                                $('#loadmore').before(data);
                                setTimeout(function () {
                                    display_center();
                                    bigImgShow();
                                    keepHeight();
                                },200);
                                window.page++;
                                send_comment();
                                touch_comment();
                            }
                        });
                        window.scrollFlag = true;
                    },500);    
                }else{
                    $('#loadmore').html('没有更多数据');
                    window.scrollFlag = false;
                }
                window.scrollFlag = false;
            }
        }
    });
    //触发评论框
    function touch_comment() {
        $(".do_comment").unbind();
        $(".do_comment").click(function () {
            $(this).parents(".content-footer").next(".comment").find(".comment_input").toggle(500);
        });
    }
    touch_comment();
    //评论按钮,发送评论
    function send_comment() {
        $(".com_button").unbind();
        $(".com_button").button().click(function () {
            var _this = $(this);
            $.ajax({
                url : "/index/comment",
                type : "post",
                data : {
                    "tid" : _this.prevAll("input").val(),
                    "com_content" : _this.prev("textarea").val(),
                },
                success : function (data,status,others) {
                    var comment_model = $("#comment_model").html();
                    comment_model = comment_model.replace(/comment_content/g,_this.prev("textarea").val());
                    if(_this.parent("div").next("ol").html().length > 0){
                        _this.parent("div").next("ol").prepend(comment_model);
                    }else{
                        _this.parent("div").next("ol").prepend(comment_model).show();
                    }
                    setTimeout(function () {
                        _this.parent("div").hide(400);
                        _this.prev("textarea").val("");
                    },100);
                }
            });
        });
    }
    send_comment();

    //定期轮询新增微博
    getWeibo();
    function getWeibo() {
        $.ajax({
            url : '/index/getCache',
            type : 'post',
            success : function (data,status,others) {
                if(data.length > 0){
                    $(".msg .msg_num").text(data.length);
                    $(".msg").show();
                }
            }
        });
        setTimeout(function () {
            getWeibo();
        },10000);
    }
    $(".msg").click(function () {
        window.location.href = "/index"
    })
});
