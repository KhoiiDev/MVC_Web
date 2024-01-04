<?php

class ClassModel extends DataBase
{

    public function getAll()
    {
        $sql = "SELECT * FROM class
        ORDER BY idClass DESC;";
        return mysqli_query($this->con, $sql);
    }

    public function deleteClassFormData($id)
    {
        $sql = "DELETE 
                FROM post
                WHERE EXISTS
                ( SELECT * FROM class INNER JOIN  post ON post.idClass  = class.idClass WHERE class.idClass like '$id')";
        mysqli_query($this->con, $sql);

        $sql = "DELETE 
                FROM assignment
                WHERE EXISTS
                ( SELECT * FROM class  INNER JOIN assignment ON assignment.idClass  = class.idClass WHERE class.idClass = '$id')";
        mysqli_query($this->con, $sql);

        $sql = "DELETE 
                FROM classaccount
                WHERE classaccount.idClass like '$id' ";
        mysqli_query($this->con, $sql);

        $sql = "DELETE FROM class WHERE class.idClass like '$id' ;";
        mysqli_query($this->con, $sql);
    }

    public function updateClass($id, $className, $teacherName, $classroom, $group, $codeClass)
    {
        $sql = "UPDATE class
                SET className = '$className', teacherName = '$teacherName', classroom = '$classroom', groupName = '$group', codeClass = '$codeClass'
                WHERE class.idClass = '$id'";
        mysqli_query($this->con, $sql);
    }

    public function getClass($id)
    {
        $sql = "SELECT * FROM class WHERE class.idClass = '$id';";
        return mysqli_query($this->con, $sql);
    }

    public function setClass($classname, $teachername, $roomname, $groupname, $classcode, $username)
    {
        $sql = "INSERT INTO class (className, teacherName, classroom, groupName, codeClass) VALUES ('$classname','$teachername',' $roomname','$groupname','$classcode')";
        mysqli_query($this->con, $sql);
        $idClass = mysqli_fetch_array(mysqli_query($this->con, "SELECT MAX(idClass) AS LargestID FROM class; "))["LargestID"];
        $sql = "INSERT INTO classaccount(username , idClass) value ('$username', '$idClass')";
        mysqli_query($this->con, $sql);
    }

    public function getPeople($idClass)
    {
        $sql = "SELECT *
                FROM account 
                INNER JOIN classaccount
                ON account.username = classaccount.username
                WHERE idClass like $idClass ";
        return mysqli_query($this->con, $sql);
    }

    public function getClassUser($username)
    {
        $sql = "SELECT *
                FROM class
                INNER JOIN classaccount
                ON class.idClass = classaccount.idClass 
                WHERE classaccount.username like '$username'";
        return mysqli_query($this->con, $sql);

    }

}
?>