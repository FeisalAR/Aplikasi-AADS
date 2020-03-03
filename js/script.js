$(document).ready(function () {
    $("#user-list-search").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".list-group-item").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $("#program-list-search").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".list-group-item").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});