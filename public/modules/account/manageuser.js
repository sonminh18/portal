/**
 * Created by Son Minh on 11/14/2017.
 */
$(document).ready(function () {
    $("#List_grid").kendoGrid({
        dataSource: {
            type: "json",
            transport: {
                read: {
                    url: "/account/ListJson",
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

                        if(data.Data[i].disabled == '0'){
                            data.Data[i].sdisabled = '<i class="icon-user-check text-primary"></i>';
                            data.Data[i].tacvu = '<span class="label label-danger heading-text" style="cursor:pointer" title="Khóa" onclick="disable(\''+data.Data[i].username+'\')"><i class="icon-lock2"></i></span>';
                        }else{
                            data.Data[i].sdisabled = '<i class="icon-user-block text-danger"></i>';
                            data.Data[i].tacvu = '<span class="label label-primary heading-text" style="cursor:pointer" title="Mở khóa" onclick="enable(\''+data.Data[i].username+'\')"><i class="icon-unlocked2"></i></span> ';

                        }
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
            field: "username",
            title: 'Tài khoản',
            headerAttributes: { style: "text-align:left;" },
            width: 320,
            encoded: false
        }, {
            field: "sdisabled",
            title: 'Trạng thái tài khoản',
            headerAttributes: { style: "text-align:center;" },
            attributes: { style: "text-align:center; width:90px;", "class": "text-center nowrap" },
            width: 90,
            encoded: false
        }, {
            title: 'Khóa/Mở Tài khoản',
            field: "tacvu",
            headerAttributes: { style: "text-align:center;" },
            attributes: { style: "text-align:center; width:90px;", "class": "text-center nowrap" },
            width: 90,
            encoded: false,
        },{
            title: 'Tác vụ',
            headerAttributes: { style: "text-align:center;" },
            attributes: { style: "text-align:center; width:90px;", "class": "text-center nowrap" },
            template: '<span class="label label-primary heading-text" style="cursor:pointer" title="Sửa thông tin" onclick="OnShowPoppupInfo(\'#=data.username#\')">Thông tin</span>',
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
function disable(username) {
    event.preventDefault();
    swal({
            title: "Bạn muốn khóa tài khoản \""+username+"\" ?",
            text: "OK để xác nhận!!",
            type: "info",
            confirmButtonColor: "#2196F3",
            showLoaderOnConfirm: true,
            showCancelButton: true,
            closeOnConfirm: false,
        },
        function() {
            $.ajax({
                method: "POST",
                url: "/account/disable",
                data: {
                    username: username,
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
        });
    return false;
}
function enable(username) {
    event.preventDefault();
    swal({
            title: "Bạn muốn mở khóa tài khoản \""+username+"\" ?",
            text: "OK để xác nhận!!",
            type: "info",
            confirmButtonColor: "#2196F3",
            showLoaderOnConfirm: true,
            showCancelButton: true,
            closeOnConfirm: false,
        },
        function() {
            $.ajax({
                method: "POST",
                url: "/account/enable",
                data: {
                    username: username,
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
        });
    return false;
}
function OnShowPoppupInfo(username) {

    $.ajax({
        url: "/account/getinfo",
        method: "POST",
        dataType: "html",
        data: { username: username },
        cache: false,
        success: function (data) {

            bootbox
                .dialog({
                    title: "Thông tin tài khoản \""+username+"\"",
                    message: data,
                    buttons: {
                        success: {
                            label: "Lưu thông tin",
                            className: "btn-success",
                            callback: function () {
                                OnChangeInfo();
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
function OnChangeInfo() {

    $.ajax({
        url: "/account/changeinfo",
        method: "POST",
        dataType: "json",
        data: {
            username: $("#fullname").val(),
            group: $("#group").val()
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