<?php
$conn= new mysqli("localhost","root","","vsm_db");

//CREAZIONE OGGETTO PER CRIPTARE DATI DI ACCESSO DB?

if ($conn->connect_error) {
    die("Connessione col db non riuscita: " . $conn->connect_error);
}