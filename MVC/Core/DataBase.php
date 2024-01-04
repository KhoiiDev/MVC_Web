<?php
class DataBase{
    public $con;
    public $host = 'localhost';
    public $user = 'root';
    public $pass = '';
    public $db = 'dbstudy';

    function __construct()
    {
        $this->con = mysqli_connect($this->host, $this->user, $this->pass);
        mysqli_select_db($this->con, $this->db);
        mysqli_query($this->con, "SET NAMES 'utf8'");
        if ($this->con->connect_error) {
            die('Unable to connect to database: ' . $this->con->connect_error);
        }
    }
}
?>