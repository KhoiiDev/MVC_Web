<?php

class AssignmentModel extends DataBase
{
    public function getAllAssignment($idClass)
    {
        $sql = "SELECT * FROM assignment WHERE idClass like '$idClass' ORDER BY assignmentID DESC";
        return mysqli_query($this->con, $sql);
    }

    public function setAllAssignment($title , $content, $fileupload, $postingTime, $deadlines , $username, $idClass )
    {
        $sql = "INSERT INTO assignment(title , content, fileupload, postingTime, deadlines , username, idClass ) VALUES ( '$title' , '$content', '$fileupload', '$postingTime', '$deadlines' , '$username', '$idClass' )";
        mysqli_query($this->con, $sql);
    }

    public function getDetailAssignment($assignmentID)
    {
        $sql = "SELECT * FROM assignment WHERE assignmentID  like '$assignmentID' ";
        return mysqli_query($this->con, $sql);
    }
    
    public function updateAssignment($assignmentID, $title, $content, $fileupload, $deadlines, $postingTime)
    {
        $sql = "UPDATE assignment
                SET title = '$title', content = '$content', fileupload = '$fileupload', deadlines = '$deadlines', postingTime = '$postingTime'
                WHERE assignmentID  like '$assignmentID'";
        mysqli_query($this->con, $sql);
    }

    public function deleteAssignment($assignmentID)
    {
        $sql = " DELETE FROM assignment WHERE assignmentID = '$assignmentID' ";
        mysqli_query($this->con, $sql);
    }

    public function submitStudent($fileupload, $timeSubmit, $usSubmit, $assignmentID)
    {
        $sql = "INSERT INTO submit(fileupload, timeSubmit, usSubmit, assignmentID ) VALUES ('$fileupload', '$timeSubmit', '$usSubmit', '$assignmentID')";
        mysqli_query($this->con, $sql);
    }
}
