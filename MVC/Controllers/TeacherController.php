<?php
class TeacherController extends Controller
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
            $this->view("Teacher/HeaderTeacherView", []);
            $this->data["url"] = "http://localhost/WebStudy/TeacherController";

    }

    public function main()
    {
        $this->checkLogin();
        $modelClass = $this->model("ClassModel");
        $this->data["dataClass"] = $modelClass->getClassUser($_SESSION["username"]);
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
        if (isset($_POST["submit"])) {
            $className = ucfirst($this->DataProcessing($_POST["className"]));
            $teacherName = ucfirst($this->DataProcessing($_POST["teacherName"]));
            $classroom = $this->DataProcessing($_POST["classroom"]);
            $group = $this->DataProcessing($_POST["groupName"]);
            $codeClass = $this->DataProcessing($_POST["codeClass"]);

            $modelClass = $this->model("ClassModel");
            $modelClass->updateClass($id, $className, $teacherName, $classroom, $group, $codeClass);
            $this->main();
        } else {
            $this->getFormEditClass($id);
        }
    }
    public function getFormEditClass($id)
    {
        $modelClass = $this->model("ClassModel");

        $row = mysqli_fetch_array($modelClass->getClass($id));

        $this->data["className"] = $row["className"];
        $this->data["teacherName"] = $row["teacherName"];
        $this->data["classroom"] = $row["classroom"];
        $this->data["groupName"] = $row["groupName"];
        $this->data["codeClass"] = $row["codeClass"];
        $this->data["url"] = "http://localhost/WebStudy/TeacherController/editClass/$id";

        $this->view("Class/FormClass", $this->data);
        $this->view("FooterView", []);
    }
    public function addNewClass()
    {
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
        $this->data["idClass"] = null;
        $this->data["className"] = null;
        $this->data["teacherName"] = null;
        $this->data["groupName"] = null;
        $this->data["classroom"] = null;
        $this->data["codeClass"] = null;
        $this->data["url"] = "http://localhost/WebStudy/TeacherController/addNewClass";
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

    
    public function getViewAddPost()
    {

        $this->data["title"] = "";
        $this->data["content"] = "";
        $this->data["url"] = "http://localhost/WebStudy/TeacherController/addPost";
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
        $this->data["url"] = "http://localhost/WebStudy/TeacherController/editPost/$postID";
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

    public function getViewAddAssignment()
    {
        $this->data["title"] = "";
        $this->data["content"] = "";
        $this->data["deadlines"] = "";
        $this->data["url"] = "http://localhost/WebStudy/TeacherController/addAssignments";
        $this->view("Assignment/FormAssignment", $this->data);
        $this->view("FooterView", []);
    }

    public function addAssignments(){
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

        $modelPost = $this->model("AssignmentModel");
        $row = mysqli_fetch_array($modelPost->getDetailAssignment($assignmentID));

        $this->data["title"] = $row["title"];
        $this->data["content"] = $row["content"];
        $this->data["deadlines"] = $row["deadlines"];


        $this->data["url"] = "http://localhost/WebStudy/TeacherController/editAssignment/$assignmentID";

        $this->view("Assignment/FormAssignment", $this->data);
        $this->view("FooterView", []);
    }

    public function editAssignment($assignmentID)
    {
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
        $modelAssingment = $this->model("AssignmentModel");
        $modelAssingment->deleteAssignment($assignmentID);
        $this->getClassView($_SESSION['idClass']);
    }

    public function getViewAddPeople()
    {
        $this->data["url"] = "http://localhost/WebStudy/TeacherController/addPeople";
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
        $modelAccount = $this->model("AccountModel");
        $modelAccount->deletePeople($username);
        $this->getClassView($_SESSION['idClass']);
    }


}