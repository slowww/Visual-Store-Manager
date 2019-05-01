<?php


class User
{
    protected $username, $password;

    function __construct($username, $password){
        $this->username = $username;
        $this->password = $password;
    }

    function getUsername(){
        return $this->username;
    }
    function getPwd(){
        return $this->password;
    }

    function aut($username,$password){
        $conn= new mysqli("localhost","root","","vsm_db");
                if ($conn->connect_error) {
            die("Connessione col db non riuscita: " . $conn->connect_error);
        }
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $stmt = $conn->prepare("SELECT * FROM dipendenti WHERE id_dip=? AND pwd_dip=?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            return true;
        }else
        {
            return false;
        }


    }
}
?>