<?php require "partials/head.php" ?>
<?php require "partials/nav.php"; ?>

<div class="container">
    <form action="/crudEdit" method="post">
        <textarea id="mytextarea" name="content">
            <?php require "partials/crudEdit.php" ?>
        </textarea>
        <input type="hidden" name="id" value="<?= $record['id'] ?>">
        <input type="hidden" name="_method" value="patch">
        <button type="submit" name="submitbtn"></button>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/e3picudjiztgoeio0vf84yu5fy7v81vocjqmom7psqvhtck4/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea',
            icons: 'bootstrap',
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount', 'save'
            ],
            toolbar: 'undo redo | blocks | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat help save', 
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
        });
    </script>
</div>

<?php require "partials/footer.php"; ?>
