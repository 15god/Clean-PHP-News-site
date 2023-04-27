<?php

use Models\News;

class NewsController {

    public function store() {
        
        News::storeNews();
    }

    public function edit() {
        
        News::editNews();
    }

    public function destroy() {
        
        News::deleteNewsSingle();
    }

    public function show() {
        
        $post = News::getNewsSingle();
        
        view("news.view.php", [
            "post" => $post,
            "siteTitle" => $post['title'],
        ]);
    }

    public function list() {
        
        $posts = News::getNewsList();
        
        view("index.view.php", [
            "siteTitle" => "Home",
            "posts" => $posts
        ]);
    }

}
