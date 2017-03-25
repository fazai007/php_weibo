/**
 * Created by niu on 2017/2/15.
 */
$(function () {
    //账号和消息的下拉菜单
    $('.app').hover(function () {
        $(this).css({
            background : '#fff',
            color : '#333',
        }).find('.list').show();
    },function () {
        $(this).css({
            background : 'none',
            color : '#fff',
        }).find('.list').hide();
    });
    //隐藏loading加载框
    $("#loading").hide();
});
