/**
 * Created by Son Minh on 1/3/2018.
 */
$(document).ready(function () {
    $("#List_grid").kendoGrid({
        dataSource: {
            type: "json",
            transport: {
                read: {
                    url: "/admin/ListJsonModule",
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
                        data.Data[i].STT = (i+1);
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
            field: "vModName",
            title: 'Tên Module',
            headerAttributes: { style: "text-align:left;" },
            width: 90,
        }, {
            field: "vOU",
            title: 'Phòng Ban được phép',
            headerAttributes: { style: "text-align:left;" },
            width: 90,
        }, {
            title: 'Tác vụ',
            headerAttributes: { style: "text-align:center;" },
            attributes: { style: "text-align:center; width:90px;", "class": "text-center nowrap" },
            template: '<span class="label label-primary heading-text" style="cursor:pointer" title="Sửa thông tin" onclick="OnShowPoppupModule(\'#=data.iModID#\')"><i class="icon-pen6"></i></span>',
            // '<span class="label label-danger heading-text" style="cursor:pointer;margin-left: 8px" title="Xóa" onclick="OnDelete(\'#=data.iBookID#\')"><i class="icon-x"></i></span>',
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
function OnShowPoppupModule(id) {

    $.ajax({
        url: "/admin/popupmodule",
        method: "POST",
        dataType: "html",
        data: { ModuleID: id },
        cache: false,
        success: function (data) {

            bootbox
                .dialog({
                    title: "Phân quyền module",
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