/**
 * Created by Son Minh on 11/30/2017.
 */

$(document).ready(function () {
    var demoPalette = [
        ["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
        ["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
        ["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
        ["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
        ["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
        ["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
        ["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
        ["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
    ];
    $(".colorpicker-palette-toggle").spectrum({
        showPalette: true,
        showPaletteOnly: true,
        togglePaletteOnly: true,
        togglePaletteMoreText: 'More',
        togglePaletteLessText: 'Less',
        palette: demoPalette
    });
    $('.select-search').select2({
        dropdownCssClass: 'border-primary',
        containerCssClass: 'border-primary text-primary-700 select-xs',
        placeholder: "Không có",
    });
    $('#target').iconpicker({
        align: 'left', // Only in div tag
        arrowClass: 'btn-danger',
        arrowPrevIconClass: 'glyphicon glyphicon-chevron-left',
        arrowNextIconClass: 'glyphicon glyphicon-chevron-right',
        cols: 7,
        footer: true,
        header: true,
        icon: 'fa-bomb',
        iconset: 'fontawesome',
        labelHeader: '{0} - {1} Trang',
        labelFooter: '{0} - {1} tổng {2} icons',
        placement: 'bottom', // Only in button tag
        rows: 4,
        search: true,
        searchText: 'Search',
        selectedClass: 'btn-success',
        unselectedClass: ''
    });

});
$('#target').on('change', function(e) {
    console.log( e.icon );
});
$('#iShowAll').on('select2:select', function (e) {
    var data = e.params.data;
    if(data.id == 1){
        $('#iGroup').attr("disabled", true);
    }
    else {
        $('#iGroup').attr("disabled", false);
    }
});