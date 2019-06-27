<?php
$conn= new mysqli("localhost","root","","vsm_db");
//$conn= new mysqli("remotemysql.com:3306","xJdxb0ls5W","OSuER1hWdL","xJdxb0ls5W");

if ($conn->connect_error) {
    die("Connessione col db non riuscita: " . $conn->connect_error);
}