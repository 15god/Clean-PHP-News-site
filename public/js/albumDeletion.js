$(".ajax").on("click", function () {
    var filename = $(this).attr("data-path");
    var parentDiv = $(this).closest('div.col');
    $.ajax({
        url: '/album',
        type: 'POST',
        data: {
            filename: filename,
            _method: 'delete'
        },
        success: function () {
            alert('deleted');
            parentDiv.remove();
        }
    });
});