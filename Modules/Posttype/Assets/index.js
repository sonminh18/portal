/**
 * Created by Son Minh on 11/27/2017.
 */
$(document).ready(function () {
    Ladda.bind('.btn-ladda-progress', {
        timeout: 500
    });
    $("#List_grid").kendoGrid({
        dataSource: {
            type: "json",
            transport: {
                read: {
                    url: "/posttype/ListJson",
                    type: "POST",
                    dataType: "json",
                    data: additionalData,
                    success: function (result) {
                        options.success(result);
                    }
                }
            },
            schema: {
                data: function(data){
                    $.each(data.Data,function(i,o){
                        // data.Data[i].LNgayTao = data.Data[i].LNgayTao *1000;
                        // data.Data[i].LNgayCapNhat = data.Data[i].LNgayCapNhat *1000;
                        data.Data[i].STT = (i+1);
                        if(data.Data[i].iTrangThai == '1'){
                            data.Data[i].sTrangThai = "<span class='label label-success'>Đã Đăng<span>";
                        }else{
                            data.Data[i].sTrangThai = "<span class='label label-danger'>Lưu Nháp<span>";
                        }
                        // if(data.Data[i].disabled == '0'){
                        //     data.Data[i].sdisabled = '<i class="icon-user-check text-primary"></i>';
                        //     data.Data[i].tacvu = '<span class="label label-danger heading-text" style="cursor:pointer" title="Khóa" onclick="disable(\''+data.Data[i].username+'\')"><i class="icon-lock2"></i></span>';
                        // }else{
                        //     data.Data[i].sdisabled = '<i class="icon-user-block text-danger"></i>';
                        //     data.Data[i].tacvu = '<span class="label label-primary heading-text" style="cursor:pointer" title="Mở khóa" onclick="enable(\''+data.Data[i].username+'\')"><i class="icon-unlocked2"></i></span> ';
                        //
                        // }
                    });
                    return data.Data;
                },
                total: "Total",
                errors: "Errors"
            },
            error: function (e) {

                this.cancelChanges();
            },
            parameterMap: function (options, type) {
                return JSON.stringify(options);
            },
            pageSize: 15,
            serverPaging: true
        },
        pageable: {
            refresh: true,
            pageSizes: [15, 40, 60],
            messages: {
                display: "Hiển thị {0} - {1} trong {2} dòng",
                empty: "Không có dữ liệu",
                itemsPerPage: "dòng trên trang. "
            }
        },
        sortable: true,
        filterable: false,
        editable: {
            confirmation: false,
            mode: "inline"
        },
        scrollable: true,
        columns: [{
            field: "STT",
            title: 'STT',
            headerAttributes: { style: "text-align:center;", "class": "myClass" },
            template: '<span style="text-align:center;display: block;">#=data.STT#<span>',
            width: 50,
        }, {
            field: "vTenLoaiBaiViet",
            title: 'Danh Mục Loại Post',
            headerAttributes: { style: "text-align:left;" },
            width: 320,
            encoded: false
        }, {
            title: 'Liên Kết',
            field: "vLienKet",
            headerAttributes: { style: "text-align:left;" },
            attributes: { style: "text-align:left; width:90px;", "class": "text-center nowrap" },
            width: 90,
            encoded: false,
        },{
            title: 'Ngày Tạo',
            field: "created_at",
            headerAttributes: { style: "text-align:center;" },
            attributes: { style: "text-align:center; width:90px;", "class": "text-center nowrap" },
            // template: '#=kendo.toString(new Date(data.LNgayTao), "dd/MM/yyyy hh:mm" )#',
            width: 90,
            encoded: false,
        },{
            title: 'Ngày Cập Nhật',
            field: "updated_at",
            headerAttributes: { style: "text-align:center;" },
            attributes: { style: "text-align:center; width:90px;", "class": "text-center nowrap" },
            // template: '#=kendo.toString(new Date(data.LNgayCapNhat), "dd/MM/yyyy hh:mm" )#',
            width: 90,
            encoded: false,
        },{
            title: 'Tác vụ',
            headerAttributes: { style: "text-align:center;" },
            attributes: { style: "text-align:center; width:90px;", "class": "text-center nowrap" },
            template: '<span class="label label-primary heading-text" style="cursor:pointer" title="Sửa thông tin" onclick="OnShowPoppupEdit(\'#=data.iMaLoaiBaiViet#\')"><i class="icon-pen6"></i></span>'+
            '<span class="label label-danger heading-text" style="cursor:pointer;margin-left: 8px" title="Xóa" onclick="OnDeletePost(\'#=data.iMaBaiViet#\')"><i class="icon-x"></i></span>',
            width: 90,
        }]
    });
    $("#txtSearchKey").keypress(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            $("#search").click();
        }
    });
});
function additionalData() {
    return {
        KeyCode: $("#txtSearchKey").val(),
    };
}
$("#search").click(function () {
    $("#List_grid").data("kendoGrid").dataSource.page(1);
});
function OnShowPoppupCreate() {

    $.ajax({
        url: "/posttype/create",
        method: "POST",
        dataType: "html",
        cache: false,
        success: function (data) {

            bootbox
                .dialog({
                    title: "Tạo loại mới",
                    message: data,
                    buttons: {
                        success: {
                            label: "Lưu thông tin",
                            className: "btn-success",
                            callback: function () {
                                OnSavePostType('formsave');
                            }
                        }
                    }
                })
                .on('shown.bs.modal', function (e) {
                    $('.select-border-color').select2({
                        dropdownCssClass: 'border-primary',
                        containerCssClass: 'bg-teal-400 select-xs',
                        placeholder: "Chọn danh mục cha nếu muốn",
                    });
                });
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
    return false;
}
function OnShowPoppupEdit(ID) {

    $.ajax({
        url: "/posttype/edit",
        method: "POST",
        dataType: "html",
        data: { iMaLoaiBaiViet: ID },
        cache: false,
        success: function (data) {

            bootbox
                .dialog({
                    title: "Chỉnh sửa thông tin",
                    message: data,
                    buttons: {
                        success: {
                            label: "Lưu thông tin",
                            className: "btn-success",
                            callback: function () {
                                OnSavePostType('formsave');
                            }
                        }
                    }
                })
                .on('shown.bs.modal', function (e) {
                    $('.select-border-color').select2({
                        dropdownCssClass: 'border-primary',
                        containerCssClass: 'border-primary text-primary-700 select-xs',
                        placeholder: "Không có",
                    });
                });
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
    return false;
}
function OnDeletePost(iMaBaiViet) {
    swal({
            title: "Bạn có chắc muốn xóa?",
            text: "OK để xác nhận!!",
            type: "info",
            confirmButtonColor: "#2196F3",
            showLoaderOnConfirm: true,
            showCancelButton: true,
            closeOnConfirm: false,
        },
        function() {
            $.ajax({
                url: "/posts/deletepost",
                method: "POST",
                dataType: "json",
                data: {
                    iMaBaiViet: iMaBaiViet,
                },
                cache: false,
                success: function (result) {
                    if (result.Status == '200') {
                        swal({
                            title: "Thông Báo!",
                            text: result.Message,
                            confirmButtonColor: "#66BB6A",
                            type: "success"
                        });
                        $("#List_grid").data("kendoGrid").dataSource.page(1);
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
        });
}
function OnSavePostType(boxID) {
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
    dataform.vTenLoaiBaiViet=$("#vTieuDe").val();
    dataform.iCapCha=$("#vMoTa").val();
    $.ajax({
        url: "/posttype/save",
        method: "POST",
        dataType: "json",
        data: dataform,
        cache: false,
        success: function (result) {
            if (result.Status == '200') {
                swal({
                    title: "Thông Báo!",
                    text: result.Message,
                    confirmButtonColor: "#66BB6A",
                    type: "success"
                });
                $("#List_grid").data("kendoGrid").dataSource.page(1);
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