<?php require "partials/head.php" ?>
<?php require "partials/nav.php"; ?>

<div class="container">
    <form method="post">
        <textarea id="mytextarea" name="textarea">
         Welcome to TinyMCE!
        </textarea>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/e3picudjiztgoeio0vf84yu5fy7v81vocjqmom7psqvhtck4/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea',
            icons: 'bootstrap',
            plugins: 'image',
            images_file_types: 'jpg,png,svg'
        });
    </script>
</div>

<?php require "partials/footer.php"; ?>
