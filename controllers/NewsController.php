<?php

class NewsController{
    
    public function create() {
        $config = require "dbconfig.php";
        $db = new Database($config);
        $is_final_ver = (isset($_POST['is_final_ver'])) ? 1 : 0;
        $author_id = intval($_POST['author_id']);
        $category_id = intval($_POST['category_id']);
        $db->query("INSERT INTO news (category_id, author_id, is_final_ver, title, content, img)
        VALUES(:category_id, :author_id, :is_final_ver, :title, :content, :img)", [
            ':category_id' => $category_id,
            ':author_id' => $author_id,
            ':is_final_ver' => $is_final_ver,
            ':title' => $_POST['title'],
            ':content' => $_POST['content'],
            ':img' => $_POST['img']
        ]);

    }
    
    public function update() {
        $config = require "dbconfig.php";
        $db = new Database($config);
        $category = $_POST['category_id'] == 'on'? TRUE : FALSE;
        $db->query("UPDATE news SET category_id = :category_id, author_id = :author_id,
        is_final_ver = :is_final_ver, title = :title, content = :content, img = :img WHERE id = :id", [
            ':id' => $_POST['id'],
            ':category_id' => $category,
            ':author_id' => $_POST['author_id'],
            ':is_final_ver' => $_POST['is_final_ver'],
            ':title' => $_POST['title'],
            ':content' => $_POST['content'],
            ':img' => $_POST['img']
        ]);
    }
    
    public function delete() {
        $config = require "dbconfig.php";
        $db = new Database($config);
        $db->query("DELETE FROM news WHERE id =:id", [':id' => $_POST['id']]);
    }
    public function show() {
        session_start();
        $config = require "dbconfig.php";
        $db = new Database($config);
        $post = $db->query("SELECT * FROM news WHERE id =:id", [':id' => $_GET['id']])->fetch();
        $siteTitle = $post['title'];
        require "views/news.view.php";
    }
    public function list() {
        session_start();
        $siteTitle = "Home";
        $config = require "dbconfig.php";
        $db = new Database($config);
        $posts = $db->query("SELECT * FROM news")->fetchAll();
        require "views/index.view.php";
    }
}



