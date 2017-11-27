/**
 * Created by Son Minh on 11/23/2017.
 */
$(document).ready(function () {
    CKEDITOR.replace('editor');

    $('.select-border-color').select2({
        dropdownCssClass: 'border-primary',
        containerCssClass: 'bg-indigo-400 select-xs',
        placeholder: "Chọn trạng thái bài viết",
    });
    $(".select-multiple-tags").select2({
        tags: true,
        dropdownCssClass: 'border-primary',
        containerCssClass: 'bg-primary-400 select-xs',
        placeholder: "Bạn có thể thêm tags mới hoặc chọn",
    });
});
function themBaiViet(el,boxID) {
    var form = $("#" + boxID);
    var validator = $(form).kendoValidator().data("kendoValidator");
    if(!validator.validate()){
        new PNotify({
            title: 'Thông Báo...',
            text: 'Dữ liệu không đủ!',
            addclass: 'bg-warning'
        });
        return false;
    }
    var dataform = {};
    dataform.vNoiDungChiTiet = CKEDITOR.instances['editor'].getData();
    dataform.vHinhAnh=$("#vHinhAnh").val();
    dataform.vTieuDe=$("#vTieuDe").val();
    dataform.vMoTa=$("#vMoTa").val();
    dataform.vKeyword=$("#vKeyword").val();
    dataform.iLoaiBaiViet=$("#loaibaiviet").val();
    dataform.iTrangThai=$("#iTrangThai").val();
    // dataform.iBinhLuan=$("#iBinhLuan").is(":checked");
    dataform.vTags = $("#vTags").val();;
    $.ajax({
        type: 'POST',
        url: "/posts/savepost",
        data: dataform,
        dataType: 'json',
        success: function (result) {
            if (result.Status == 200) {
                swal({
                    title: "Thông Báo!",
                    text: result.Message,
                    confirmButtonColor: "#66BB6A",
                    type: "success"
                });
                setTimeout(function () {
                    window.location.href = "/posts/";
                }, 2000);
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
            // waiting.Hide();
            alert(xhr.responseText);
        }
    });
    return false;
}