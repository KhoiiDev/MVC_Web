<?php
class SignupController extends Controller
{
    protected $views;
    protected $data = array();

    public function __construct()
    {
        $this->view("blb", []);
        $this->view("LoginSignup/HeaderLogninView", []);
    }

    public function getFormSignupView()
    {
        $this->view("LoginSignup/FormSignupView", $this->data);
        $this->view("FooterView", []);
    }
    public function Register()
    {
        if (isset($_POST["register"])) {
            $Permissions = $this->DataProcessing($_POST["permissions"]);
            $firstName = $this->DataProcessing($_POST["firstName"]);
            $lastName = $this->DataProcessing($_POST["lastName"]);
            $username = $this->DataProcessing($_POST["username"]);
            $email = $this->DataProcessing($_POST["email"]);
            $password_input1 = $this->DataProcessing($_POST["password1"]);
            $password_input2 = $this->DataProcessing($_POST["password2"]);

            if($Permissions == "student"){
                $Permissions = 1;
            }
            else{
                $Permissions = 2;
            }
            $modelSignup = $this->model("AccountModel");

            if ($modelSignup->check("email", $email)) {
                if ($modelSignup->check("username", $username)) {
                    $password = md5($password_input1);
                    $modelSignup->insert($username, $firstName, $lastName, $email, $password, $Permissions);
                    session_start();
                    $_SESSION['username'] = $username;
                    $_SESSION['firstName'] = $firstName;
                    $_SESSION['lastName'] = $lastName;
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    $_SESSION['permissions'] = $Permissions;
                    header("location: http://localhost/WebStudy/HomeController/main");
                }else{
                    $this->data["fail"] = "Username already exists";
                    $this->getFormSignupView();
                }
            }
            else{
                $this->data["fail"] = "Email already exists";
                $this->getFormSignupView();
            }
        } else {
            $this->getFormSignupView();
        }
    }

}