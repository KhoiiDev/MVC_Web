<?php
class AccountModel extends DataBase
{
    public function login($username)
    {
        $sql = "SELECT * FROM account WHERE username = '$username' ";
        return mysqli_query($this->con, $sql);
    }
    public function check($item, $value)
    {
        $sql = "SELECT * FROM account WHERE $item like '$value' ";
        $result = mysqli_query($this->con, $sql);
        if (mysqli_num_rows($result) >= 1) {
            return false;
        }
        return true;
    }
    public function insert($username, $firstName, $lastName, $email, $password, $decentralization)
    {
        $sql = "INSERT INTO account(username, firstName, lastName, email, password, decentralization) VALUES ( '$username','$firstName',' $lastName','$email','$password', '$decentralization')";
        mysqli_query($this->con, $sql);
    }

    public function getAccount()
    {
        $sql = "SELECT * FROM account";
        return mysqli_query($this->con, $sql);
    }

    public function deleteAccount($username)
    {
        $sql = "DELETE 
        FROM submit
        WHERE EXISTS
        ( SELECT * FROM submit INNER JOIN account ON submit.usSubmit  = account.username  WHERE account.username = '$username')";
        mysqli_query($this->con, $sql);

        $sql = "DELETE 
                FROM classaccount
                WHERE EXISTS
                ( SELECT * FROM classaccount INNER JOIN account ON classaccount.username   = account.username  WHERE account.username = '$username')";
        mysqli_query($this->con, $sql);

        $sql = "DELETE 
                FROM post
                WHERE EXISTS
                ( SELECT * FROM post INNER JOIN account ON post.username = account.username  WHERE account.username = '$username')";
        mysqli_query($this->con, $sql);

        $sql = "DELETE 
                FROM assignment
                WHERE EXISTS
                ( SELECT * FROM assignment INNER JOIN account ON assignment.username = account.username  WHERE account.username = '$username')";
        mysqli_query($this->con, $sql);


        $sql = "DELETE FROM account  WHERE account.username = '$username';";
        mysqli_query($this->con, $sql);
    }

    public function setDecentralization($username, $decentralization)
    {
        $sql = "UPDATE account
                SET decentralization = '$decentralization'
                WHERE account.username like '$username' ";
        mysqli_query($this->con, $sql);
    }

    public function setPeople($email, $idClass)
    {
        $username = mysqli_fetch_array(mysqli_query($this->con, "SELECT username FROM account WHERE email like '$email'; "))["username"];
        $sql = "INSERT INTO classaccount(username , idClass ) VALUES ('$username', '$idClass')";
        mysqli_query($this->con, $sql);
    }

    public function deletePeople($username)
    {
        $sql = "DELETE 
            FROM classaccount
            WHERE classaccount.username = '$username'";
        mysqli_query($this->con, $sql);
    }

    public function outClassroom($id, $username)
    {
        $sql = "DELETE 
        FROM classaccount
        WHERE classaccount.idClass like '$id' and classaccount.username like '$username' ";
        mysqli_query($this->con, $sql);
    }
}
