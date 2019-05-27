<?php
$conn= new mysqli("localhost","root","","vsm_db");

if ($conn->connect_error) {
    die("Connessione col db non riuscita: " . $conn->connect_error);
}