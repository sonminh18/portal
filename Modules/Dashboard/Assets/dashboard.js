/**
 * Created by Son Minh on 11/7/2017.
 */
$(document).ready(function() {

});
function changepass() {
    event.preventDefault();
    $.ajax({
        method: "POST",
        url: "/changepass",
        data: {
            username: $("#username").val(),
            password: $("#password").val(),
            newpassword: $("#newpassword").val(),
            newpasswordrepeat: $("#newpasswordrepeat").val(),
        },
        dataType: 'json',
        success: function (result) {
            if (result.Status == '200') {
                swal({
                    title: "Thông Báo!",
                    text: result.Message,
                    confirmButtonColor: "#66BB6A",
                    type: "success"
                });

            } else {
                swal({
                    title: "Thông Báo!",
                    text: result.Message,
                    confirmButtonColor: "#EF5350",
                    type: "error"
                });
            }
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
    return false;
}
function updateinfo() {
    event.preventDefault();
    if(!checkPhoneNumber($("#phonenumber").val())){
        swal({
            title: "Thông Báo!",
            text: "Số điện thoại không đúng format. Vui lòng kiểm tra lại !!",
            confirmButtonColor: "#EF5350",
            type: "error"
        });
        return false;
    }
    if(!IsEmail($("#email").val())){
        swal({
            title: "Thông Báo!",
            text: "Email không đúng format. Vui lòng kiểm tra lại !!",
            confirmButtonColor: "#EF5350",
            type: "error"
        });
        return false;
    }
    var formData = new FormData($("#personalinfo")[0]);
    $.ajax({
        method: "POST",
        url: "/dashboard/updateinfo",
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        success: function (result) {
            if (result.Status == '200') {
                swal({
                    title: "Thông Báo!",
                    text: result.Message,
                    confirmButtonColor: "#66BB6A",
                    type: "success"
                },
                    function(){
                        location.reload();
                    });
                // setTimeout(function () {
                //     location.reload();
                // },2000);
            } else {
                swal({
                    title: "Thông Báo!",
                    text: result.Message,
                    confirmButtonColor: "#EF5350",
                    type: "error"
                });
            }
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
    return false;
}
function checkPhoneNumber(str) {
    var regexp = /^0([0-9])+$/;
    if (!(regexp.test(str))) {
        return false;
    } else {
        return true;
    }
}
function checkvalidate(obj){
    var parent = jQuery(obj).parent();
    if(jQuery(obj).val() == ''){
        jQuery(parent).removeClass("has-success").addClass("has-error");
    }else{
        jQuery(parent).removeClass("has-error").addClass("has-success");
    }
}
function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}