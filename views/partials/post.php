<div class="container">
    <div class="blog-post">
        <h2 class="blog-post-title"><a href="news?id=<?= $post['id']?>"><?= $post['title']?></a></h2>
        <p class="blog-post-meta"><?= $post['publication_date']?> by <a href="#"><?= $post['login']?></a></p>

        <p><?= $post['content']?></p>
        <img src="<?= $post['img']?>" alt="there was an image.....">
    </div><!-- /.blog-post -->
    <br>
</div>