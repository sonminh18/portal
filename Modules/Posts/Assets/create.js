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
});
function themBaiViet(el,boxID) {
    var form = $("#" + boxID);
    var validator = $(form).kendoValidator().data("kendoValidator");
    var scope = angular.element($("#CreateController")).scope();
    var LoaiBV = scope.LoaiBaiViet.NodeResult.IDSelected;
    var tags = scope.Tags.Lst;
    if(!validator.validate()){
        new PNotify({
            title: 'Thông Báo...',
            text: 'Dữ liệu không đủ!',
            addclass: 'bg-warning'
        });
        return false;
    }
    if(LoaiBV.length == 0){
        new PNotify({
            title: 'Thông Báo...',
            text: 'Vui lòng chọn loại bài viết!',
            addclass: 'bg-warning'
        });
        return false;
    }
    var dataform = {};
    dataform.editor1 = CKEDITOR.instances['editor1'].getData();
    dataform.vHinhAnh=$("#vHinhAnh").val();
    dataform.vTieuDe=$("#vTieuDe").val();
    dataform.vMoTa=$("#vMoTa").val();
    dataform.vKeyword=$("#vKeyword").val();
    dataform.LoaiBaiViet=LoaiBV;
    dataform.iTrangThai=$("#iTrangThai").val();
    dataform.iBinhLuan=$("#iBinhLuan").is(":checked");
    dataform.vTags = "";
    for(i = 0; i <tags.length ; i++){
        if(i>0) dataform.vTags+=",";
        dataform.vTags+=tags[i].vMaTag;
    }
    waiting.Show();
    $.ajax({
        type: 'POST',
        url: "index.php?module=baiviet&action=save_baiviet",
        data: dataform,
        dataType: 'json',
        success: function (result) {
            if (result.Status == JsonStatus.Success) {
                swal({
                    title: "Thông Báo!",
                    text: result.Message,
                    confirmButtonColor: "#66BB6A",
                    type: "success"
                });
                setTimeout(function () {
                    window.location.href = "index.php?module=baiviet&action=index";
                }, 2000);
            } else {
                swal({
                    title: "Thông Báo!",
                    text: result.Message,
                    confirmButtonColor: "#EF5350",
                    type: "error"
                });
            }
            waiting.Hide();
        },
        error: function (xhr, status, error) {
            waiting.Hide();
            alert(xhr.responseText);
        }
    });
    return false;
}