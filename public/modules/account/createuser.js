/**
 * Created by Son Minh on 11/14/2017.
 */

$( document ).ready(function() {
    Ladda.bind('.btn-ladda-progress', {
     timeout: 500
    });
    var $input = $('#password');
    var $output = $('#passwordoutput');

    $.passy.requirements.length.min = 4;

    var feedback = [
        { color: '#c00', text: 'Mật khẩu kém' },
        { color: '#c80', text: 'Mật khẩu Bình thường' },
        { color: '#3BA4CE', text: 'Mật khẩu Tốt' },
        { color: '#0c0', text: 'Mật khẩu bá đạo' }
    ];

    $input.passy(function(strength, valid) {
        $output.text(feedback[strength].text);
        $output.css('background-color', feedback[strength].color);

        if( valid ) $input.css(' border-color', 'green' );
        else $input.css( 'border-color', 'red' );
    });

    $('#generate').click(function() {
        $input.passy( 'generate', 12 );
    });
    $('.select-search').select2();
});
function addnewuser() {
    event.preventDefault();
    $.ajax({
        url: "/account/addnewuser",
        method: "POST",
        dataType: "json",
        data: {
            fullname: $("#fullname").val(),
            password: $("#password").val(),
            deptname: $("#deptname").val(),
        },
        cache: false,
        success: function (result) {
            if (result.Status == '200') {
                Ladda.stopAll();
                swal({
                    title: "Thông Báo!",
                    text: result.Message,
                    confirmButtonColor: "#66BB6A",
                    type: "success"
                },function () {
                    window.location.href ="/account/manageuser";
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

