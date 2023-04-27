$(document).on('click', '#btn-add', function () {// create new post
    var data = $("#user_form").serialize() + "&_method=put";
    $.ajax({
        data: data,
        type: "POST",
        url: "/crud",
        success: function (dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode === 200) {
                $('#addEmployeeModal').modal('hide');
                alert('Data added successfully !');
                location.reload();
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
    var is_final_ver = $(this).attr("data-final") === '1' ? true : false;
    $('#id_u').val(id);
    $('#category_u').val(category_id);
    $('#author_u').val(author);
    $('#title_u').val(title);
    $('#content_u').val(content);
    $('#is_final_ver_u').prop('checked', is_final_ver);
    $("a[href='/crudEdit?id=']").prop('href', '/crudEdit?id=' + id);
});

$(document).on('click', '#update', function () {//edit post
    var data = $("#update_form").serialize() + "&_method=patch";
    $.ajax({
        data: data,
        type: "POST",
        url: "/crud",
        success: function (dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode === 200) {
                $('#editEmployeeModal').modal('hide');
                alert('Data updated successfully !');
                location.reload();
            }
        }
    });
});

$(document).on("click", ".delete", function () {// get id for deletion
    var id = $(this).attr("data-id");
    $('#id_d').val(id);

});

$(document).on("click", "#delete", function () {
    var id = $("#id_d").val();
    $.ajax({
        url: "/crud",
        data: {
            id: id,
            _method: "delete"
        },
        type: "POST",
        cache: false,
        success: function (dataResult) {
            location.reload();
            $('#deleteModal').modal('hide');
            $("#" + dataResult).remove();//delete dynamicly

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
