$(document).ready(function () {
    $('.sort').on('change', function () {
        alert($(location).attr('href').split('/'));
        field = $('.sort:checked').val();
        var href = $(location).attr('href') + "sort/" + field;
        $('#order').attr('href', href);
    });
});