<div class="container" style = "outline: 2px ridge;border-radius: 2rem; margin-bottom:10px;">
    <div class="blog-post">
        <h2 class="blog-post-title"><a href="news?id=<?= $post['id'] ?>"><?= $post['title'] ?></a></h2>
        <span class="blog-post-meta"><?= $post['publication_date'] ?> by <a href="#"><?= $post['author_id'] ?></a></span>
        <button type="button" class="btn btn-danger delete" data-id="<?= $post['id'] ?>" style="float: right" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
        <button type="button" class="btn btn-warning edit" style="float: right; margin-right: 5px;" data-bs-toggle="modal" data-bs-target="#updateModal">
            <i class="material-icons update" data-toggle="tooltip"
               data-id="<?= $post["id"]; ?>"
               data-category="<?= $post["category_id"]; ?>"
               data-author="<?= $post["author_id"]; ?>"
               data-title="<?= $post["title"]; ?>"
               data-content="<?= $post["content"]; ?>"
               data-img="<?= $post["img"]; ?>"
               data-final="<?= $post["is_final_ver"] ?>">
                Edit</i>
        </button>
        <p><?= $post['content'] ?></p>
        <img src="<?= $post['img'] ?>" alt="there was an image.....">
    </div><!-- blog-post -->
    <br>
</div>

