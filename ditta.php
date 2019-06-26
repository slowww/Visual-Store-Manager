<?php
$rifconn = include_once('connection.php');
header('Content-Type: application/json');

/*$access=unserialize($_SESSION['access']);
$cdc=$access->getUsername();*/

switch($_SERVER['REQUEST_METHOD'])
{
    case "GET":
        getDitta($_GET);
        break;
    case "POST":
        insertDitta($_POST);
        break;

}


function getDitta($g)
{
    $conn= new mysqli("localhost","root","","vsm_db");
    //$conn= new mysqli("remotemysql.com:3306","6mDvq7h8FM","02RsSlTvzW","6mDvq7h8FM");

    if ($conn->connect_error) {
        die("Connessione col db non riuscita: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("select nome_ditta from ditta_esterna order by nome_ditta;");

    /*parte di codice che si ripete*/
    $stmt->execute();
    $result = $stmt->get_result();

    $msmError = (object)array('msg'=>'Errore nella ricerca');
    $msmAlert = (object)array('msg'=>'Nessun modulo che corrisponda ai parametri indicati.');
    if (!$result) echo json_encode($msmError);
    $return = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $return[] = $row;
    }
    if ($return == null) {
        echo json_encode($msmAlert);
    } else {
        $object = (object)($return);
        echo json_encode($object);

    }
    /*fino a qui*/

}
