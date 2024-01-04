<?php
class HomeController extends Controller
{

    protected $data = array();

    public function checkLogin()
    {
        if( !isset($_SESSION["username"])){
            header("http://localhost/WebStudy/LoginController/main");
            exit();
        }
    }

    public function __construct()
    {
        $this->view("blb", []);
    }

    public function main()
    {
        $this->checkLogin();
        $permissions = $_SESSION['permissions'];
        if ($permissions == 1) {
            header("location: http://localhost/WebStudy/StudentController/main");
        } else if ($permissions == 2) {
            header("location: http://localhost/WebStudy/TeacherController/main");
        } else if ($permissions == 3){
            header("location: http://localhost/WebStudy/AdminController/main");
        }
    }
    public function Lognout()
    {
        $this->checkLogin();
        unset($_SESSION['id']);
        session_destroy();
        header("location: http://localhost/WebStudy/LoginController/main");
    }


}