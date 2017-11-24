/**
 * Created by Son Minh on 11/7/2017.
 */
$(document).ready(function() {

});
function dangnhap() {
    event.preventDefault();
    $.ajax({
        method: "POST",
        url: "/signin",
        data: {
            username: $("#username").val(),
            password: $("#password").val(),
        },
        dataType: 'json',
        success: function (result) {
            if (result.Status == '200') {
                // swal({
                //     title: "Thông Báo!",
                //     text: result.Message,
                //     confirmButtonColor: "#66BB6A",
                //     type: "success"
                // });

                window.location.href="/dashboard";
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