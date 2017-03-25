/**
 * Created by niu on 2017/2/26.
 */
function cleanRefer(e){
    $.ajax({
        url : "/seting/cleanRefer",
        type : "post",
        data : {
            "id" : e.id,
        },
        success : function (data,status,others) {
            if(data) {
                window.location.href = "/index";
            }else{
                alert("阅读失败");
            }
        }
    });
}

