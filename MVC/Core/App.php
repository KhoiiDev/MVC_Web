<?php
class App
{
    protected $controller = "LoginController";
    protected $action = "main";
    protected $params = [];


    function __construct()
    {
        $url = $this->UrlProcess();
        if (isset($url)) {
            // Xu li controller
            if (file_exists("./MVC/Controllers/" . $url[0] . ".php")) {
                $this->controller = $url[0];
                require_once "./MVC/Controllers/" . $this->controller . ".php";
                unset($url[0]);
            }
            
            // Xu li Action
            if (isset($url[1])) {
                if (method_exists($this->controller, $url[1])) {
                    $this->action = $url[1];
                }
                unset($url[1]);
            }
            // Xu li Params
            $this->params = $url ? array_values($url) : [];
        }
        else{
            require_once "./MVC/Controllers/" . $this->controller . ".php";
        }
        $this->controller = new $this->controller;
        call_user_func_array([new $this->controller, $this->action], $this->params);
    }
    function UrlProcess()
    {
        if (isset($_GET['url'])) {
            return explode("/", filter_var(trim($_GET['url'], "/")));
        }
    }
}
