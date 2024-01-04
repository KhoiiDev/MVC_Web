<?php
class LoginController extends Controller
{
    protected $views;
    protected $message = array();
    protected $url;

    public function __construct()
    {
        $this->view("blb", []);
        $this->view("LoginSignup/HeaderLogninView", []);
        $this->url = "http://localhost/WebStudy/HomeController/";
    }

    public function main(){

         $this->view("LoginSignup/LoginView", []);
         $this->view("FooterView", []);

    }
    public function getFormLoginView()
    {
         $this->view("LoginSignup/FormLoginView", $this->message);
         $this->view("FooterView", []);
    }

    public function Click()
    {
        if (isset($_POST["login"])) {
            $username = $this->DataProcessing($_POST["username"]);
            $password_input = $this->DataProcessing($_POST["password"]);
            $modelLogin = $this->model("AccountModel")->login($username);
            if (mysqli_num_rows($modelLogin)) {
                while ($row = mysqli_fetch_array($modelLogin)) {
                    $username = $row["username"];
                    $firstName = $row["firstname"];
                    $lastName = $row["lastname"];
                    $email = $row["email"];
                    $password = $row["password"];
                    $Permissions = $row["decentralization"];
                }
                if (md5($password_input) == $password) {
                    session_start();
                    $_SESSION['username'] = $username;
                    $_SESSION['firstName'] = $firstName;
                    $_SESSION['lastName'] = $lastName;
                    $_SESSION['email'] = $email;
                    $_SESSION['permissions'] = $Permissions;
                    header("location: http://localhost/WebStudy/HomeController/main");
                }
                else{
                    $this->message["fail"] = "Incorrect email or password";
                     $this->getFormLoginView();
                }
            }
            else{
                $this->message["fail"] = "Incorrect email or password";
                 $this->getFormLoginView();
            }
        } else {
             $this->getFormLoginView();
        }
    }
}
