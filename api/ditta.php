<?php
include_once('../config/connection.php');
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS");

/*$access=unserialize($_SESSION['access']);
$cdc=$access->getUsername();*/

switch($_SERVER['REQUEST_METHOD'])
{
    case "GET":
        getDitta($_GET,$conn);
        break;
    case "POST":
        insertDitta($_POST);
        break;

}


function getDitta($g,$c)
{


    if ($c->connect_error) {
        die("Connessione col db non riuscita: " . $c->connect_error);
    }

    $stmt = $c->prepare("select nome_ditta from ditta_esterna order by nome_ditta;");

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
