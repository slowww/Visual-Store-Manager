<?php
//$conn= new mysqli("localhost","root","","vsm_db");
$conn= new mysqli("remotemysql.com:3306","6mDvq7h8FM","02RsSlTvzW","6mDvq7h8FM");

if ($conn->connect_error) {
    die("Connessione col db non riuscita: " . $conn->connect_error);
}