/**
 * Created by Son Minh on 11/23/2017.
 */
var modalTemplate = '<div class="modal-dialog modal-lg" role="document">\n' +
    '  <div class="modal-content">\n' +
    '    <div class="modal-header">\n' +
    '      <div class="kv-zoom-actions btn-group">{toggleheader}{fullscreen}{borderless}{close}</div>\n' +
    '      <h6 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h6>\n' +
    '    </div>\n' +
    '    <div class="modal-body">\n' +
    '      <div class="floating-buttons btn-group"></div>\n' +
    '      <div class="kv-zoom-body file-zoom-content"></div>\n' + '{prev} {next}\n' +
    '    </div>\n' +
    '  </div>\n' +
    '</div>\n';
// Buttons inside zoom modal
var previewZoomButtonClasses = {
    toggleheader: 'btn btn-default btn-icon btn-xs btn-header-toggle',
    fullscreen: 'btn btn-default btn-icon btn-xs',
    borderless: 'btn btn-default btn-icon btn-xs',
    close: 'btn btn-default btn-icon btn-xs'
};

// Icons inside zoom modal classes
var previewZoomButtonIcons = {
    prev: '<i class="icon-arrow-left32"></i>',
    next: '<i class="icon-arrow-right32"></i>',
    toggleheader: '<i class="icon-menu-open"></i>',
    fullscreen: '<i class="icon-screen-full"></i>',
    borderless: '<i class="icon-alignment-unalign"></i>',
    close: '<i class="icon-cross3"></i>'
};

// File actions
var fileActionSettings = {
    zoomClass: 'btn btn-link btn-xs btn-icon',
    zoomIcon: '<i class="icon-zoomin3"></i>',
    dragClass: 'btn btn-link btn-xs btn-icon',
    dragIcon: '<i class="icon-three-bars"></i>',
    removeClass: 'btn btn-link btn-icon btn-xs',
    removeIcon: '<i class="icon-trash"></i>',
    indicatorNew: '<i class="icon-file-plus text-slate"></i>',
    indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
    indicatorError: '<i class="icon-cross2 text-danger"></i>',
    indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>'
};
$(document).ready(function () {

});
var filesCount=0;
var avatar="";
var dataSource="";
function openUploadPopup(where) {
    $.ajax({
        url: "/uploadimage/uploadpopup",
        method: "GET",
        dataType: "html",
        cache: false,
        success: function (data) {

            bootbox.dialog({
                    size: "large",
                    title: "Thư viện hình ảnh",
                    message: data,
                    buttons: {
                        confirm: {
                            label: 'Chọn',
                            className: 'btn-success',
                            callback: function () {
                                if(where == 'editor'){
                                    var img = "<img src='"+avatar+"'/>";
                                    CKEDITOR.instances.editor.insertHtml(img);
                                }else {
                                    $("#img_show_avatar").attr("src",avatar);
                                    $("#vHinhAnh").val(avatar);
                                }
                            }
                        },
                        success: {
                            label: 'Xóa',
                            className: 'btn-danger',
                            callback: function () {
                                deleteImage(avatar);
                                return false;
                            }
                        }
                    }
                })
                .on('shown.bs.modal', function (e) {
                    onShowPopup();
                });
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
    return false;
}
function onChange() {
    var data = dataSource.view(),
        selected = $.map(this.select(), function(item) {
            return data[$(item).index()].vUrl;
        });
    avatar=selected.join(", ");
}
function onShowPopup() {
    $(".file-input-ajax").fileinput({
        uploadUrl: "/uploadimage/storeimage", // server upload action
        uploadAsync: true,
        maxFileCount: 5,
        initialPreview: [],
        fileActionSettings: {
            removeIcon: '<i class="icon-bin"></i>',
            removeClass: 'btn btn-link btn-xs btn-icon',
            uploadIcon: '<i class="icon-upload"></i>',
            uploadClass: 'btn btn-link btn-xs btn-icon',
            zoomIcon: '<i class="icon-zoomin3"></i>',
            zoomClass: 'btn btn-link btn-xs btn-icon',
            indicatorNew: '<i class="icon-file-plus text-slate"></i>',
            indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
            indicatorError: '<i class="icon-cross2 text-danger"></i>',
            indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>',
        },
        layoutTemplates: {
            icon: '<i class="icon-file-check"></i>',
            modal: modalTemplate
        },
        initialCaption: "No file selected",
        previewZoomButtonClasses: previewZoomButtonClasses,
        previewZoomButtonIcons: previewZoomButtonIcons
    });
    $('#imageposts').on('filebatchpreupload', function(event, data, previewId, index) {
        filesCount = $('#imageposts').fileinput('getFilesCount');
    });
    $('#imageposts').on('filebatchuploadcomplete', function(event, data, previewId, index) {
        $("#thuvienhinh").html("Thư Viện Hình <span class='label label-success position-left'>"+filesCount+"</span>");
        dataSource.read();
    });
    dataSource = new kendo.data.DataSource({
        transport: {
            read: {
                type: "POST",
                url: "/uploadimage/imagelist",
                processData: true,
                dataType: "json",
                cache: false
            }
        },
        pageSize: 9,
        schema : {
            type: "json",
            data: function(data){
                $.each(data.Data,function(i,o){
                    // data.Data[i].LNgayTao = data.Data[i].LNgayTao *1000;
                    // data.Data[i].LNgayCapNhat = data.Data[i].LNgayCapNhat *1000;
                });
                return data.Data;
            },
            total: "Total",
            errors: "Errors"
        }
    });

    $("#pager").kendoPager({
        dataSource: dataSource
    });

    $("#listView").kendoListView({
        dataSource: dataSource,
        pageable: true,
        selectable: "multiple",
        change: onChange,
        template: kendo.template($("#template").html())
    });
}
function deleteImage(vimage) {
    event.preventDefault();
    swal({
            title: "Bạn có chắc muốn xóa hình này ?",
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
                url: "/uploadimage/deleteimage",
                data: {
                    image: vimage,
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
                        dataSource.read();
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