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
