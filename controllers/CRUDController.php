<?php

use Models\CRUD;

class CRUDController {

    public function show() {

        $record = CRUD::getRecordSingle();

        view("redact.view.php", [
            "siteTitle" => "Редактирование новости",
            "record" => $record
        ]);
        
    }

    public function list() {

        $data = CRUD::getRecordList();

        $data["siteTitle"] = "CRUD";

        view("crud.view.php", $data);
    }

    public function store() {

        CRUD::storeRecord();
    }

    public function edit() {

        CRUD::editRecord();
    }
    
    public function editContent() {
        //ajax nado
        CRUD::editRecordContent();
        
        header("Location: /crud");
        exit();
    }

    public function destroy() {

        CRUD::deleteRecordSingle();
    }

}