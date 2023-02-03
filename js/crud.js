$(document).on('click', '#btn-add', function (e) {
    var data = $("#user_form").serialize();
    $.ajax({
        data: data,
        type: "POST",
        url: "/crud-create",
        success: function (dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode === 200) {
                $('#addEmployeeModal').modal('hide');
                alert('Data added successfully !');
                location.reload();
            } else if (dataResult.statusCode === 201) {
                alert(dataResult);
            }
        }
    });
});

$(document).on('click', '.update', function (e) {
    var id = $(this).attr("data-id");
    var category = $(this).attr("data-category");
    var author = $(this).attr("data-author");
    var title = $(this).attr("data-title");
    var content = $(this).attr("data-content");
    var img = $(this).attr("data-img");
    var is_final_ver = $(this).attr("data-final");
    $('#id_u').val(id);
    $('#category').val(category);
    $('#author').val(author);
    $('#title').val(title);
    $('#content').val(content);
    $('#img').val(img);
    $('#is_final_ver').val(is_final_ver);
});

$(document).on('click', '#update', function (e) {
    var data = $("#update_form").serialize();
    $.ajax({
        data: data,
        type: "POST",
        url: "/crud-update",
        success: function (dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode === 200) {
                $('#editEmployeeModal').modal('hide');
                alert('Data updated successfully !');
                location.reload();
            } else if (dataResult.statusCode === 201) {
                alert(dataResult);
            }
        }
    });
});

$(document).on("click", ".delete", function () {
    var id = $(this).attr("data-id");
    $('#id_d').val(id);

});

$(document).on("click", "#delete", function () {
    $.ajax({
        url: "/crud-delete",
        type: "POST",
        cache: false,
        data: {
            type: 3,
            id: $("#id_d").val()
        },
        success: function (dataResult) {
            location.reload();
            $('#deleteModal').modal('hide');
            $("#" + dataResult).remove();

        }
    });
});