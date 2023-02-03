<?php
require "partials/head.php";
require "partials/nav.php";
?>

<div class="container">
    <button type="button" class="btn btn-success btn-lg" style="margin-bottom:10px" data-bs-toggle="modal" data-bs-target="#createModal">Add a new post</button>
    <?php
    foreach ($posts as $post) {
        ?>
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
                            data-final="<?= $post["is_final_ver"]; ?>">
                    </i>Edit</button>
                <p><?= $post['content'] ?></p>
                <img src="<?= $post['img'] ?>" alt="there was an image.....">
            </div><!-- blog-post -->
            <br>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade py-5" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-4 shadow">
                    <form>
                        <div class="modal-header border-bottom-0">
                            <h2 class="modal-title fs-5">Delete this post?</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body py-0">
                            <p>You will not be able to recover it</p>
                            <input type="hidden" id="id_d" name="id" class="form-control">
                        </div>
                        <div class="modal-footer flex-column border-top-0">
                            <button type="button" class="btn btn-lg btn-primary w-100 mx-0 mb-2" id="delete">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Create Modal -->
        <div class="modal fade py-5" id="createModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-4 shadow">
                    <form id="user_form">
                        <div class="modal-header border-bottom-0">
                            <h1 class="modal-title fs-5">Add a new post</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body py-0">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" id="title" name="title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Author</label>
                                <input type="text" id="author_id" name="author_id" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Category</label>
                                <input type="text" id="category_id" name="category_id" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Content</label>
                                <input type="text" id="content" name="content" class="form-control">
                            </div>         
                            <div class="form-group">
                                <label>Image Link</label>
                                <input type="url" id="img" name="img" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Final?</label>
                                <input type="checkbox" id="is_final_ver" name="is_final_ver">
                            </div>
                        </div>
                        <div class="modal-footer flex-column border-top-0">
                            <button type="button" class="btn btn-lg btn-primary w-100 mx-0 mb-2" id="btn-add">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Update Modal -->
        <div class="modal fade py-5" id="updateModal" tabindex="-1" aria-labelledby="updateModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-4 shadow">
                    <form id="update_form">
                        <div class="modal-header border-bottom-0">
                            <h2 class="modal-title fs-5">Edit</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body py-0">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" id="title_u" name="title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Author</label>
                                <input type="text" id="author_u" name="author_id" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Category</label>
                                <input type="text" id="category_u" name="category_id" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Content</label>
                                <input type="text" id="content_u" name="content" class="form-control">
                            </div>         
                            <div class="form-group">
                                <label>Image Link</label>
                                <input type="url" id="img_u" name="img" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Final?</label>
                                <input type="checkbox" id="is_final_ver_u" name="is_final_ver" required>
                            </div>
                        </div>
                        <div class="modal-footer flex-column border-top-0">
                            <input type="hidden" id="id_u" name="id" class="form-control">
                            <button type="button" class="btn btn-lg btn-primary w-100 mx-0 mb-2" id="update">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }
    echo "</div>";
    require "partials/footer.php";

    