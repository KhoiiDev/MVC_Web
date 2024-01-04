<?php
class StudentController extends Controller
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
        $this->checkLogin();
        $this->view("blb", []);
        $this->data["firstName"] = $_SESSION['firstName'];
        $this->data["lastName"] = $_SESSION['lastName'];
        $this->view("Student/HeaderStudentView", $this->data);
        $this->data["url"] = "http://localhost/WebStudy/StudentController";
    }

    public function main()
    {
        $this->checkLogin();
        $modelClass = $this->model("ClassModel");
        $this->data["dataClass"] = $modelClass->getClassUser($_SESSION["username"]);
        $this->view("Student/StudentGridClassView", $this->data);
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

        $this->view("Student/StudentClassView", $this->data);
        $this->view("FooterView", []);
    }

    public function exitClass($id)
    {
        $modelAccount = $this->model("AccountModel");
        $modelAccount->outClassroom($id, $_SESSION['username']);
        $this->main();
    }

    
    public function getViewAddPost()
    {

        $this->data["title"] = "";
        $this->data["content"] = "";
        $this->data["url"] = "http://localhost/WebStudy/StudentController/addPost";
        $this->view("Post/FormPost", $this->data);
        $this->view("FooterView", []);
    }

    public function addPost()
    {
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
        $modelClass = $this->model("PostModel");
        $modelClass->deletePost($postID);
        $this->getClassView($_SESSION['idClass']);
    }

    public function getFormEditPost($postID)
    {
        $modelPost = $this->model("PostModel");
        $this->data["url"] = "http://localhost/WebStudy/StudentController/editPost/$postID";
        $row = mysqli_fetch_array($modelPost->getPost($postID));

        $this->data["title"] = $row["title"];
        $this->data["content"] = $row["content"];

        $this->view("Post/FormPost", $this->data);
        $this->view("FooterView", []);
    }

    public function editPost($postID)
    {
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

    // public function addComment($username,$postID)
    // {
    //     if (isset($_POST["comment"])) {
    //         $postingTime = date('Y-m-d H:i:s');
    //         $inputComment = $this->DataProcessing($_POST["inputComment"]);
    //         $modelPost = $this->model("PostModel");
    //         $modelPost -> addComment($username,$postingTime,$inputComment,$postID);
            
    //         $this->getClassView($_SESSION['idClass']);
    //     }

    // }

    public function response($assignmentID)
    {
        if (isset($_POST["submit"])) {
            $fileupload = $_FILES["uploadfile"]["name"];

            if (!isset($_FILES["uploadfile"])) {
                move_uploaded_file($_FILES["uploadfile"]["tmp_name"], "Data/Submit/" . $fileupload);
            }
            $postingTime = date('Y-m-d H:i:s');
            $AssignmentModel = $this->model("AssignmentModel");
            $AssignmentModel->submitStudent($fileupload, $postingTime, $_SESSION['username'], $assignmentID);

            $this->getClassView($_SESSION['idClass']);
        } 
        else {
            $this->getClassView($_SESSION['idClass']);
        }
    }

}