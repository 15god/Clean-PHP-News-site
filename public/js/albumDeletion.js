$(".ajax").on("click", function () {
    var filename = $(this).attr("data-path");
    var parentDiv = $(this).closest('div.col');
    var _method = "delete";
    $.ajax({
        url: '/album',
        type: 'POST',
        data: filename, _method,
        success: function () {
            alert('deleted');
            parentDiv.remove();
        }
    });
});