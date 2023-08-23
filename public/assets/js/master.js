/**
 * pengajuan
 */

// show data input media
$(document).ready(function () {
    $('#jenisPengajuan').change(function (e) {
        e.preventDefault();
        var value = $(this).val();
        $("#inputData").load("/pengajuan/show/" + value);
    });
});


$(window).on('load', function() {
    $('#myModal').modal('show');
});