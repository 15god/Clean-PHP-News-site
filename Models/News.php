<?php

namespace Models;

use Core\App;
use Core\Database;

class News {

    public static function getNewsSingle() {

        $db = App::resolve(Database::class);
        $post = $db->query("SELECT news.*, users.login FROM news "
                        . "INNER JOIN users ON author_id = users.id WHERE news.id =:id", [
                    ':id' => $_GET['id']])->fetch();
        return $post;
    }

    public static function getNewsList() {

        $db = App::resolve(Database::class);
        $posts = $db->query("SELECT news.*, users.login FROM news"
                        . " INNER JOIN users ON author_id = users.id WHERE is_final_ver = 1")->fetchAll();
        return $posts;
    }
}
