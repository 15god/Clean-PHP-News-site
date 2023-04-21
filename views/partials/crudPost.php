<div class="blog-post" style = "outline: 1px solid; padding: 3px; margin-bottom: 2px">
    <span class="blog-post-title" style = "font-size: 24px"><a href="news?id=<?= $post['id'] ?>"><?= $post['title'] ?></a></span>
    <span> by <?= $post['login'] ?>,</span>
    <span><?= $post['publication_date'] ?></span>
    <button type="button" class="btn btn-danger delete" data-id="<?= $post['id'] ?>" style="float: right" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
    <button type="button" class="btn btn-warning edit" style="float: right; margin-right: 5px;" data-bs-toggle="modal" data-bs-target="#updateModal">
        <i class="material-icons update" data-toggle="tooltip"
           data-id="<?= $post["id"]; ?>"
           data-category="<?= $post["category_id"]; ?>"
           data-author="<?= $post["login"]; ?>"
           data-title="<?= $post["title"]; ?>"
           data-content="<?= $post["content"]; ?>"
           data-img="<?= $post["img"]; ?>"
           data-final="<?= $post["is_final_ver"] ?>">
            Edit</i>
    </button>
</div><!-- blog-post -->

