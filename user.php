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
}
?>