// undefined err
$(document).on('click', '#btn-add', function () {// create new post
    var data = $("#user_form").serialize();
    var _method = "put";
    $.ajax({
        data: data, _method,
        type: "POST",
        url: "/crud",
        success: function () {
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

$(document).on('click', '.update', function () {// fill in post edit form
    var id = $(this).attr("data-id");
    var category_id = $(this).attr("data-category");
    var author = $(this).attr("data-author");
    var title = $(this).attr("data-title");
    var content = $(this).attr("data-content");
    var img = $(this).attr("data-img");
    var is_final_ver = ($(this).attr("data-final") === '1' ? true : false);
    $('#id_u').val(id);
    $('#category_u').val(category_id);
    $('#author_u').val(author);
    $('#title_u').val(title);
    $('#content_u').val(content);
    $('#img_u').val(img);
    $('#img_crop').attr('src', img);
    $('#is_final_ver_u').prop('checked', is_final_ver);
    $("a[href='wyswig-edit?id=']").prop('href', 'wyswig-edit?id=' + id);
});

$(document).on('click', '#update', function () {//edit post
    var data = $("#update_form").serialize();
    var _method = "patch";
    $.ajax({
        data: data, _method,
        type: "POST",
        url: "/crud",
        success: function () {
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

$(document).on("click", ".delete", function () {// get id for deletion
    var id = $(this).attr("data-id");
    $('#id_d').val(id);

});

$(document).on("click", "#delete", function () {
    var _method = "delete";// delete post
    $.ajax({
        url: "/crud",
        type: "POST",
        cache: false,
        data: {
            type: 3,
            id: $("#id_d").val(),
            _method
        },
        success: function (dataResult) {
            location.reload();
            $('#deleteModal').modal('hide');
            $("#" + dataResult).remove();

        }
    });
});

/*..$('.btn-group-toggle').on('click', '.btn', function() {
  $(this).addClass('active').siblings().removeClass('active');
});
 * 
 */

$(document).on("click", ".sort", function () {// sort data
    var sort = $(this).attr('id');
    var order = $(this).data('order');
    var glyph = '';
    if(order == 'desc'){
        glyph = '&nbsp;<span class="glyphicon glyphicon-arrow-down"></span>>';
    }
    else{
        glyph = '&nbsp;<span class="glyphicon glyphicon-arrow-up"></span>>';
    }
});
