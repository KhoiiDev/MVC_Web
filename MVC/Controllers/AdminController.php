<?php
class AdminController extends Controller
{

    protected $data = array();

    public function checkLogin()
    {
        if( !isset($_SESSION["username"])){
            header("Location:http://localhost/WebStudy/LoginController/main");
            exit();
        }
    }

    public function __construct()
    {
        $this->checkLogin();
        $this->view("blb", []);
        $this->view("Admin/HeaderAdminView", []);
        $this->data["url"] = "http://localhost/WebStudy/AdminController";
    }

    public function main()
    {
        $this->checkLogin();
        $modelClass = $this->model("ClassModel");
        $this->data["dataClass"] = $modelClass->getAll();
        $this->view("Class/GridClassView", $this->data);
        $this->view("FooterView", []);
    }

    public function getClassView($id)
    {
        $this->checkLogin();
        $modelClass = $this->model("ClassModel");
        $modelStream = $this->model("PostModel");
        $modelAssignment = $this->model("AssignmentModel");

        
        $_SESSION["idClass"] = $id;
        
        $row = $modelClass->getClass($id);
        $row = mysqli_fetch_array($row);
        $_SESSION["className"] = $row["className"];
        $_SESSION["teacherName"] = $row["teacherName"];
        $_SESSION["classroom"] = $row["classroom"];
        $_SESSION["groupName"] = $row["groupName"];
        $_SESSION["codeClass"] = $row["codeClass"];
        
        $this->data["dataPeople"] = $modelClass->getPeople($id);

        $this->data["class"] = $modelClass->getClass($id);
        $this->data["post"] = $modelStream->getAllPost($id);
        $this->data["assignment"] = $modelAssignment->getAllAssignment($id);

        $this->view("Class/ClassView", $this->data);
        $this->view("FooterView", []);
    }

    public function editClass($id)
    {
        $this->checkLogin();
        if (isset($_POST["submit"])) {
            $className = ucfirst($this->DataProcessing($_POST["className"]));
            $teacherName = ucfirst($this->DataProcessing($_POST["teacherName"]));
            $classroom = $this->DataProcessing($_POST["classroom"]);
            $group = $this->DataProcessing($_POST["groupName"]);
            $codeClass = $this->DataProcessing($_POST["codeClass"]);

            $modelClass = $this->model("ClassModel");
            $modelClass->updateClass($id, $className, $teacherName, $classroom, $group, $codeClass);
            exit();
        } else {
            $this->getFormEditClass($id);
        }
    }
    public function getFormEditClass($id)
    {
        $this->checkLogin();
        $modelClass = $this->model("ClassModel");

        $row = mysqli_fetch_array($modelClass->getClass($id));

        $this->data["className"] = $row["className"];
        $this->data["teacherName"] = $row["teacherName"];
        $this->data["classroom"] = $row["classroom"];
        $this->data["groupName"] = $row["groupName"];
        $this->data["codeClass"] = $row["codeClass"];
        $this->data["url"] = "http://localhost/WebStudy/AdminController/editClass/$id";

        $this->view("Class/FormClass", $this->data);
        $this->view("FooterView", []);
    }
    public function addNewClass()
    {
        $this->checkLogin();
        if (isset($_POST["submit"])) {
            $className = ucfirst($this->DataProcessing($_POST["className"]));
            $teacherName = ucfirst($this->DataProcessing($_POST["teacherName"]));
            $classroom = $this->DataProcessing($_POST["groupName"]);
            $group = $this->DataProcessing($_POST["classroom"]);
            $codeClass = $this->DataProcessing($_POST["codeClass"]);

            $modelClass = $this->model("ClassModel");
            $modelClass->setClass($className, $teacherName, $classroom, $group, $codeClass, $_SESSION["username"]);


            $this->main();
        } else {
            $this->getFormAddClass();
        }
    }

    public function getFormAddClass()
    {
        $this->checkLogin();
        $this->data["idClass"] = null;
        $this->data["className"] = null;
        $this->data["teacherName"] = null;
        $this->data["groupName"] = null;
        $this->data["classroom"] = null;
        $this->data["codeClass"] = null;
        $this->data["url"] = "http://localhost/WebStudy/AdminController/addNewClass";
        $this->view("Class/FormClass", $this->data);
        $this->view("FooterView", []);
    }

    public function deleteClass($id)
    {
        $this->checkLogin();
        $modelClass = $this->model("ClassModel");
        $modelClass->deleteClassFormData($id);
        $this->main();
    }

    public function addNewAdmin()
    {
        $this->checkLogin();
        if (isset($_POST["add"])) {
            $firstName = $this->DataProcessing($_POST["firstname"]);
            $lastName = $this->DataProcessing($_POST["lastname"]);
            $username = $this->DataProcessing($_POST["username"]);
            $email = $this->DataProcessing($_POST["email"]);
            $password_input1 = $this->DataProcessing($_POST["password1"]);
            $password_input2 = $this->DataProcessing($_POST["password2"]);

            if (empty($firstName)) {
                $this->data["respondFirstName"] = "Please enter your first name";
                $this->getViewAddNewAdmin();
            }
            if (empty($lastName)) {
                $this->data["respondLastName"] = "Please enter your last name";
                $this->getViewAddNewAdmin();
            }
            if (empty($lastName)) {
                $this->data["respondUsername"] = "Please enter your user name";
                $this->getViewAddNewAdmin();
            }
            if (empty($email)) {
                $this->data["respondEmail"] = "Please enter your email";
                $this->getViewAddNewAdmin();
            }
            if (empty($password_input1)) {
                $this->data["respondPassword_input1"] = "Please enter your password";
                $this->getViewAddNewAdmin();
            }
            if (empty($password_input2)) {
                $this->data["respondPassword_input2"] = "Please confirm your password";
                $this->getViewAddNewAdmin();
            }
            if (strlen($password_input1) < 6) {
                $this->data["respondPassword_input1"] = "Your password too short";
                $this->getViewAddNewAdmin();
            }
            $modelSignup = $this->model("AccountModel");

            if ($modelSignup->check("email", $email)) {
                if ($modelSignup->check("username", $username)) {
                    $password = md5($password_input1);
                    $modelSignup->insert($username, $firstName, $lastName, $email, $password, "3");
                    session_start();
                    $_SESSION['username'] = $username;
                    $_SESSION['firstName'] = $firstName;
                    $_SESSION['lastName'] = $lastName;
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    $_SESSION['permissions'] = "3";
                    header("location: http://localhost/WebStudy/HomeController/main");
                } else {
                    $this->data["fail"] = "Username already exists";
                    $this->getViewAddNewAdmin();
                }
            } else {
                $this->data["fail"] = "Email already exists";
                $this->getViewAddNewAdmin();
            }
        } else {
            $this->getViewAddNewAdmin();
        }
    }

    public function getViewAddNewAdmin()
    {
        $this->checkLogin();
        $this->view("Admin/FormSignupAdminView", $this->data);
        $this->view("FooterView", []);
    }

    public function getAllUserView()
    {
        $this->checkLogin();
        $modelAccount = $this->model("AccountModel");

        $this->data["dataAccount"] = $modelAccount->getAccount();
        $this->view("Admin/AccountView", $this->data);
        $this->view("FooterView", []);
    }

    public function deleteAccount($username)
    {
        $this->checkLogin();
        $modelAccount = $this->model("AccountModel");
        $modelAccount->deleteAccount($username);
        $this->getAllUserView();
    }

    public function getViewEditPermissions($username)
    {
        $this->checkLogin();
        $this->data['CurrentUsers'] = $username;
        $this->view("Admin/EditPermissionView", $this->data);
        $this->view("FooterView", []);
    }

    public function editPermissions($username)
    {
        $this->checkLogin();
        $modelAccount = $this->model("AccountModel");
        $permission = $_POST["permission"];
        if (isset($_POST["set"])) {
            $modelAccount->setDecentralization($username, $permission);
        }
        $this->getAllUserView();
    }

    public function getViewAddPost()
    {
        $this->checkLogin();

        $this->data["title"] = "";
        $this->data["content"] = "";
        $this->data["url"] = "http://localhost/WebStudy/AdminController/addPost";
        $this->view("Post/FormPost", $this->data);
        $this->view("FooterView", []);
    }

    public function addPost()
    {
        $this->checkLogin();
        if (isset($_POST["postup"])) {
            $title = ucfirst($this->DataProcessing($_POST["title"]));
            $content = $this->DataProcessing($_POST["content"]);
            $fileupload = $_FILES["upload_file"]["name"];

            if (!isset($_FILES["upload_file"])) {
                move_uploaded_file($_FILES["upload_file"]["tmp_name"], "Data/Posts/" . $fileupload);
            }
            $postingTime = date('Y-m-d H:i:s');
            $modelPost = $this->model("PostModel");
            $modelPost->setPost($title, $content, $fileupload, $postingTime, $_SESSION['username'], $_SESSION["idClass"]);

            $this->getClassView($_SESSION['idClass']);
        } else {
            $this->getClassView($_SESSION['idClass']);
        }
    }

    public function deletePost($postID)
    {
        $this->checkLogin();
        $modelClass = $this->model("PostModel");
        $modelClass->deletePost($postID);
        $this->getClassView($_SESSION['idClass']);
    }

    public function getFormEditPost($postID)
    {
        $this->checkLogin();
        $modelPost = $this->model("PostModel");
        $this->data["url"] = "http://localhost/WebStudy/AdminController/editPost/$postID";
        $row = mysqli_fetch_array($modelPost->getPost($postID));

        $this->data["title"] = $row["title"];
        $this->data["content"] = $row["content"];

        $this->view("Post/FormPost", $this->data);
        $this->view("FooterView", []);
    }

    public function editPost($postID)
    {
        $this->checkLogin();
        if (isset($_POST["postup"])) {
            $title = ucfirst($this->DataProcessing($_POST["title"]));
            $content = $this->DataProcessing($_POST["content"]);
            $fileupload = $_FILES["upload_file"]["name"];

            if (!isset($_FILES["upload_file"])) {
                move_uploaded_file($_FILES["upload_file"]["tmp_name"], "Data/Posts/" . $fileupload);
            }

            $postingTime = date('Y-m-d H:i:s');
            $modelPost = $this->model("PostModel");
            $modelPost->updatePost($postID, $title, $content, $fileupload, $postingTime);

            $this->getClassView($_SESSION['idClass']);
        } else {
            $this->getClassView($_SESSION['idClass']);
        }
    }

    public function getViewAddAssignment()
    {
        $this->checkLogin();
        $this->data["title"] = "";
        $this->data["content"] = "";
        $this->data["deadlines"] = "";
        $this->data["url"] = "http://localhost/WebStudy/AdminController/addAssignments";
        $this->view("Assignment/FormAssignment", $this->data);
        $this->view("FooterView", []);
    }

    public function addAssignments(){
        $this->checkLogin();
        if (isset($_POST["postup"])) {
            $title = ucfirst($this->DataProcessing($_POST["title"]));
            $deadlines = ucfirst($this->DataProcessing($_POST["deadlines"]));
            $content = $this->DataProcessing($_POST["content"]);
            $fileupload = $_FILES["upload_file"]["name"];

            if (!isset($_FILES["upload_file"])) {
                move_uploaded_file($_FILES["upload_file"]["tmp_name"], "Data/Assignment/" . $fileupload);
            }
            $postingTime = date('Y-m-d H:i:s');
            $ModelAssignment = $this->model("AssignmentModel");
            $ModelAssignment->setAllAssignment($title, $content, $fileupload, $postingTime, $deadlines, $_SESSION["username"], $_SESSION['idClass']);

            $this->getClassView($_SESSION['idClass']);
        } else {
            $this->getClassView($_SESSION['idClass']);
        }
    }

    public function getEditAssignmentView($assignmentID)
    {
        $this->checkLogin();
        $modelPost = $this->model("AssignmentModel");
        $row = mysqli_fetch_array($modelPost->getDetailAssignment($assignmentID));

        $this->data["title"] = $row["title"];
        $this->data["content"] = $row["content"];
        $this->data["deadlines"] = $row["deadlines"];


        $this->data["url"] = "http://localhost/WebStudy/AdminController/editAssignment/$assignmentID";

        $this->view("Assignment/FormAssignment", $this->data);
        $this->view("FooterView", []);
    }

    public function editAssignment($assignmentID)
    {
        $this->checkLogin();
        if (isset($_POST["postup"])) {
            $title = ucfirst($this->DataProcessing($_POST["title"]));
            $content = $this->DataProcessing($_POST["content"]);
            $deadlines = $this->DataProcessing($_POST["deadlines"]);
            $fileupload = $_FILES["upload_file"]["name"];

            if (!isset($_FILES["upload_file"])) {
                move_uploaded_file($_FILES["upload_file"]["tmp_name"], "Data/Posts/" . $fileupload);
            }

            $postingTime = date('Y-m-d H:i:s');
            $modelPost = $this->model("AssignmentModel");
            $modelPost->updateAssignment($assignmentID, $title, $content, $fileupload, $deadlines, $postingTime);

            $this->getClassView($_SESSION['idClass']);
        } else {
            $this->getClassView($_SESSION['idClass']);
        }
    }

    public function deleteAssignment($assignmentID)
    {
        $this->checkLogin();
        $modelAssingment = $this->model("AssignmentModel");
        $modelAssingment->deletePost($assignmentID);
        $this->getClassView($_SESSION['idClass']);
    }

    public function getViewAddPeople()
    {
        $this->checkLogin();
        $this->data["url"] = "http://localhost/WebStudy/AdminController/addPeople";
        $this->view("People/ViewAddPeople", $this->data);
        $this->view("FooterView", []);
    }

    public function addPeople()
    {
        if (isset($_POST["add"])) {
            $modelAccount=$this->model("AccountModel");
            $content = $this->DataProcessing($_POST["content"]);
            $content = explode(';',$content);
            foreach ($content as $email) {
                $email = trim($email);
                $modelAccount -> setPeople($email, $_SESSION['idClass']);
                
            }
            $this->getClassView($_SESSION['idClass']);
        } else {
            $this->getClassView($_SESSION['idClass']);
        }

    }

    public function deletePeopleOfClass($username)
    {
        $this->checkLogin();
        $modelAccount = $this->model("AccountModel");
        $modelAccount->deletePeople($username);
        $this->getClassView($_SESSION['idClass']);
    }
}