<?php

namespace Models;

use Core\App;
use Core\Database;

class CRUD {

    public static function getRecordSingle() {
        
        $db = App::resolve(Database::class);
        $record = $db->query("SELECT id, title, content FROM news WHERE news.id =:id", [
            ':id' => $_GET['id']])->fetch();
        return $record;
    }

    public static function getRecordList() {

        $db = App::resolve(Database::class);
        $sql = "SELECT news.*, users.login, categories.category FROM news"
                . " INNER JOIN users ON author_id = users.id"
                . " INNER JOIN categories ON category_id = categories.id ";

        $sort = $_GET['sort'] ?? "id";
        $order = $_GET['order'] ?? 'asc';

        $keywords = $_GET['keywords'] ?? "";
        if ($keywords !== "") {// dodumat
            $keys = explode(",", $_GET['keywords']);
            $i = 0;
            foreach ($keys as $key) {
                $key = trim($key);
                if ($i == 0) {
                    $sql .= "WHERE title LIKE '%$key%' ";
                    $i++;
                } else {
                    $sql .= "OR title LIKE '%$key%' ";
                }
            }
        }
        $date1 = $_GET['start-date'] ?? "";
        $date2 = $_GET['end-date'] ?? "";
        if ($date1 !== "" && $date2 !== "") {
            if (str_contains($sql, 'WHERE')) {
                $sql .= "AND DATE(publication_date) >= '$date1' AND DATE(publication_date) <= '$date2'";
            } else {
                $sql .= "WHERE DATE(publication_date) >= '$date1' AND DATE(publication_date) <= '$date2'";
            }
        }

        $page = $_GET['page'] ?? 0;
        $count = 3; // новостей  на странице
        $offset = $page * $count;
        $sqlRows = substr_replace($sql, "SELECT COUNT(*)", 0, strlen("SELECT news.*, users.login, categories.category"));

        $sql .= "ORDER BY $sort $order LIMIT $count OFFSET $offset";
        // echo $sql;
        $totalRows = $db->query($sqlRows, [])->fetchColumn();
        $posts = $db->query($sql, [])->fetchAll();
        $categories = $db->query("SELECT category FROM categories", [])->fetchAll();

        return [
            "totalRows" => $totalRows,
            "posts" => $posts,
            "categories" => $categories,
            "count" => $count,
            "sort" => $sort,
            "order" => $order,
            "date1" => $date1,
            "date2" => $date2,
            "keywords" => $keywords
        ];
    }

    public static function storeRecord() {

        $db = App::resolve(Database::class);
        $is_final_ver = (isset($_POST['is_final_ver'])) ? 1 : 0;
        $sql = "INSERT INTO news
        (category_id, author_id, is_final_ver, title, content)
        VALUES(:category, (SELECT id from users WHERE users.login = :author),
        :is_final_ver, :title, :content)";
        $db->query($sql, [
            ':category' => $_POST['category'],
            ':author' => $_POST['author'],
            ':is_final_ver' => $is_final_ver,
            ':title' => $_POST['title'],
            ':content' => $_POST['content']
        ]);
        if ($db->queryStatus) {
            echo json_encode(array("statusCode" => 200));
        } else {
            echo "Error: " . $sql . "<br>";
        }
    }

    public static function editRecord() {

        $db = App::resolve(Database::class);
        $is_final_ver = (isset($_POST['is_final_ver'])) ? 1 : 0;
        $sql = "UPDATE news
        SET category_id = :category,
            author_id = (SELECT id from users WHERE users.login = :author),
            is_final_ver = :is_final_ver,
            title = :title,
            content = :content
        WHERE news.id = :id";
        $db->query($sql, [
            ':id' => $_POST['id'],
            ':category' => $_POST['category'],
            ':author' => $_POST['author'],
            ':is_final_ver' => $is_final_ver,
            ':title' => $_POST['title'],
            ':content' => $_POST['content']
        ]);
        if ($db->queryStatus) {
            echo json_encode(array("statusCode" => 200));
        } else {
            echo "Error: " . $sql . "<br>";
        }
    }

    public static function deleteRecordSingle() {

        $db = App::resolve(Database::class);
        $db->query("DELETE FROM news WHERE id =:id", [
            ':id' => $_POST['id']
        ]);
        if ($db->queryStatus) {
            echo json_encode(array("statusCode" => 200));
        } else {
            echo "Error";
        }
    }
    
    public static function editRecordContent() {
        
        $db = App::resolve(Database::class);
        $sql = "UPDATE news
        SET content = :content
        WHERE news.id = :id";
        $db->query($sql, [
            ':id' => $_POST['id'],
            ':content' => $_POST['content']
        ]);
    }

}
