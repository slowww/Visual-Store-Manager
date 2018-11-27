<?php

$cdc = $_POST["cdc"];
$cdcpwd = $_POST["cdcPwd"];
$email = $_POST["email"];
$outpwd = $_POST["outPwd"];

if ($_SERVER["REQUEST_METHOD"] == "POST") //form sent
{

  if(!isset($cdc) && !isset($cdcpwd))//se dati cdc non impostati
  {
    if(!isset($email) && !isset($outpwd))//se dati esterni non impostati
    {

    }
  }


 ?>
