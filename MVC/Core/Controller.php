<?php
class Controller{
    public function model($model){
        require_once "./MVC/Models/".$model.".php";
        return new $model;
    }

    public function view($view, $data=[]){
        require_once "./MVC/Views/".$view.".php";
    }

    public function DataProcessing($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
