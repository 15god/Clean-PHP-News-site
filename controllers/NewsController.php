<?php

class NewsController{
    
    public function create() {
        $config = require "dbconfig.php";
        $db = new Database($config);
        $is_final_ver = (isset($_POST['is_final_ver'])) ? 1 : 0;
        $sql = "INSERT INTO news
        (category_id, author_id, is_final_ver, title, content, img)
        VALUES(:category,
        (SELECT id from users WHERE users.login = :author),
        :is_final_ver, :title, :content, :img)";
        $db->query($sql, [
            ':category' => $_POST['category'],
            ':author' => $_POST['author'],
            ':is_final_ver' => $is_final_ver,
            ':title' => $_POST['title'],
            ':content' => $_POST['content'],
            ':img' => $_POST['img']
        ]);
        if ($db->queryStatus) {
            echo json_encode(array("statusCode"=>200));
        }
        else {
            echo "Error: " . $sql . "<br>";
        }
    }
    
    public function update() {
        $config = require "dbconfig.php";
        $db = new Database($config);
        $is_final_ver = (isset($_POST['is_final_ver'])) ? 1 : 0;
        $sql = "UPDATE news
        SET category_id = :category,
            author_id = (SELECT id from users WHERE users.login = :author),
            is_final_ver = :is_final_ver,
            title = :title,
            content = :content,
            img = :img
        WHERE news.id = :id";
        $db->query($sql, [
            ':id' => $_POST['id'],
            ':category' => $_POST['category'],
            ':author' => $_POST['author'],
            ':is_final_ver' => $is_final_ver,
            ':title' => $_POST['title'],
            ':content' => $_POST['content'],
            ':img' => $_POST['img']
        ]);
        if ($db->queryStatus) {
            echo json_encode(array("statusCode"=>200));
        }
        else {
            echo "Error: " . $sql . "<br>";
        }
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
        $post = $db->query("SELECT news.*, users.login FROM news"
        . " INNER JOIN users ON author_id = users.id WHERE news.id =:id", [':id' => $_GET['id']])->fetch();
        $siteTitle = $post['title'];
        require "views/news.view.php";
    }
    public function list() {
        session_start();
        $siteTitle = "Home";
        $config = require "dbconfig.php";
        $db = new Database($config);
        $posts = $db->query("SELECT news.*, users.login FROM news"
        . " INNER JOIN users ON author_id = users.id WHERE is_final_ver = 1")->fetchAll();
        require "views/index.view.php";
    }
}



