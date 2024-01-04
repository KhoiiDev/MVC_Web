<?php

class PostModel extends DataBase
{
    public function getAllPost($idClass)
    {
        $sql = "SELECT * FROM post WHERE idClass  = '$idClass' ORDER BY postID DESC";
        return mysqli_query($this->con, $sql);
    }

    public function setPost($title, $content, $fileupload, $postingTime, $username, $idClass)
    {
        $sql = "INSERT INTO post (title, content , fileupload, postingTime, username, idClass) VALUES ( '$title', '$content', '$fileupload', '$postingTime', '$username', '$idClass')";
        mysqli_query($this->con, $sql);
    }

    public function getPost($postID)
    {
        $sql = "SELECT * FROM post WHERE postID = '$postID' ";
        return mysqli_query($this->con, $sql);
    }

    public function deletePost($postID)
    {
        
        $sql = "DELETE FROM post WHERE postID = '$postID' ";
        mysqli_query($this->con, $sql);
    }

    public function updatePost($postID, $title, $content, $fileupload, $postingTime)
    {
        $sql = "UPDATE post
                SET title = '$title', content = '$content', fileupload = '$fileupload', postingTime = '$postingTime'
                WHERE postID = '$postID'";
        mysqli_query($this->con, $sql);
    }
}
