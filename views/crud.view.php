<?php
require "partials/head.php";
require "partials/nav.php";
?>

<div class="container">
    <div class="row">
        <div class="col-md-8 blog-main">
            <button type="button" class="btn btn-success btn-lg" style="margin-bottom:10px" data-bs-toggle="modal" data-bs-target="#createModal">Add a new post</button>
            <?php
            $page = $_GET['page'] ?? 0;
            $count = 10;
            $page_count = ceil(count($posts) / $count);
            for ($i = $page * $count; $i < ($page + 1) * $count; $i++) {
                if (isset($posts[$i])) {
                    $post = $posts[$i];
                    require 'partials/crudPost.php';
                }
            }
            ?>
            <div class="page_list" align="center">
            <?php for ($i = 0; $i < $page_count; $i++): ?>
                <a href="/crud?page=<?= $i ?>"><button class="page_button"><?= $i + 1 ?></button></a>
            <?php endfor; ?>
        </div>
        </div>
        <aside class="col-md-4 blog-sidebar">
            <div class="p-3">
                <h4 class="font-italic">Сортировка</h4>
                <ol class="list-unstyled mb-0">
                    <li><a href="/crud?sort=id">ID</a></li>
                    <li><a href="/crud?sort=title">Заголовку</a></li>
                    <li><a href="/crud?sort=publication_date">Дате</a></li>
                </ol>
            </div>

            <div class="p-3">
                <h4 class="font-italic">Фильтр</h4>
                <ol class="list-unstyled">
                    <li><a href="#">Дата</a></li>
                    <li><a href="#">Ключевое слово</a></li>
                    <li><a href="#">**Здесь будет поле для выбора слова и календарь</a></li>
                </ol>
            </div>
        </aside><!-- /.blog-sidebar -->
    </div>
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
                        <input type="text" id="author_id" name="author" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <input type="text" id="category_id" name="category" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <input type="text" id="content" name="content" class="form-control">
                    </div>         
                    <div class="form-group">
                        <label>Image Link</label>
                        <!--<img src ="!?=getImage('profile', 'medium')?>" alt="CRUD_pic">-->
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
                        <input type="text" id="author_u" name="author" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <input type="text" id="category_u" name="category" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <input type="text" id="content_u" name="content" class="form-control">
                    </div>         
                    <div class="form-group">
                        <label>Image Link</label>
                        <!--<img src ="!?=getImage('profile', 'medium')?>" alt="CRUD_pic">-->
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
<?php require "partials/footer.php"; ?>