$(".ajax").on("click", function () {
    var filename = $(this).attr("data-path");
    var parentDiv = $(this).closest('div.col');
    var delete_var = 'deletePhoto';
    $.ajax({
        url: 'albumController.php',
        type: 'POST',
        data: {'filename': filename, 'delete_var':delete_var},
        success: function () {
            alert('deleted');
            parentDiv.remove();
        }
    });
});