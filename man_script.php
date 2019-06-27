<?php
session_start();
$rifconn = include_once('connection.php');
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS");

/*$access=unserialize($_SESSION['access']);
$cdc=$access->getUsername();*/

switch($_SERVER['REQUEST_METHOD'])
{
    case "GET":
        getMan($_GET);
        break;
    case "POST":
        insertMan($_POST);
        break;

}

function getMan($g)
{
    //$conn= new mysqli("localhost","root","","vsm_db");
    $conn= new mysqli("remotemysql.com:3306","xJdxb0ls5W","OSuER1hWdL","xJdxb0ls5W");

    if ($conn->connect_error) {
        die("Connessione col db non riuscita: " . $conn->connect_error);
    }
    if (isset($g['cdc']) && isset($g['mese']) && isset($g['anno'])) {

        $cdc = $g['cdc'];
        $mese = (int)$g['mese'];
        $anno = (int)$g['anno'];

        $stmt = $conn->prepare("select * from mod_man where cdc_fk like ? and YEAR(DATE(data_man))=? AND MONTH(DATE(data_man)) = ?;");
        $stmt->bind_param("sii", $cdc, $anno, $mese);

    } else if(isset($g['id_mod']))//per dettaglio modello
    {
        $id_mod = $g['id_mod'];
        $stmt = $conn->prepare("select * from dipendenti inner join mod_man on matr = matr_fk inner join ditta_esterna on p_iva_fk = p_iva where id_mod_man = ?");
        $stmt->bind_param("i",$id_mod);
    }
    else {
        $msmError = (object)array('Dati non impostati');
        echo json_encode($msmError);
    }

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
















function insertMan($p)
{
    //$conn= new mysqli("localhost","root","","vsm_db");
    $conn= new mysqli("remotemysql.com:3306","xJdxb0ls5W","OSuER1hWdL","xJdxb0ls5W");

    if ($conn->connect_error) {
        die("Connessione col db non riuscita: " . $conn->connect_error);
    }



    foreach ($p as $k => $v) {
        switch ($k) {

            case "ditta":
                $nome_ditta = $v;
                break;
            case "tipoman":
                $tipoman = $v;
                break;
            case "resp":
                $cogn_dip = $v;
                break;
            case "operazioni":
                $op = $v;
                break;
            case "attrezz":
                $attrezz = $v;
                break;
            case "durata":
                $durata = $v;
                break;
            case "noperai":
                $nop = $v;
            case "mat":
                $mat = $v;
                break;
            case "oss":
                $oss= $v;
                break;
            case "comment":
                if($v)
                {
                    $comment = $v;
                }else
                {
                    $comment=null;
                }

                break;
            case "id_dip":
                $id_dip = $v;
                break;
            case "pwd_dip":
                $pwd_dip = md5($v);
                break;
        }
    }





    //$pwd_dip = md5($pwd_dip);

    $stmt = $conn->prepare("SELECT cdc_fk FROM dipendenti WHERE id_dip like ? AND pwd_dip like ?;");
    $stmt->bind_param("ss", $id_dip, $pwd_dip);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows==1) {

        //se autenticazione ok
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $cdc_fk = $row['cdc_fk'];
        }


        //p_iva
        $stmt = $conn->prepare("SELECT p_iva FROM ditta_esterna WHERE nome_ditta LIKE ?;");
        $stmt->bind_param("s", $nome_ditta);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $p_iva_fk = $row['p_iva'];
            }
        }
        //matr
        $stmt = $conn->prepare("SELECT matr FROM dipendenti WHERE cogn_dip LIKE ?;");
        $stmt->bind_param("s", $cogn_dip);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $matr_fk = $row['matr'];
            }
        }

            $stmt = $conn->prepare("INSERT INTO `mod_man`(`cdc_fk`, `p_iva_fk`, `matr_fk`, `tipoman`, `operazioni`, `attrezz`, `durata`, `noper`, `mat`, `oss`, `comment`) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param("ssisssiisss", $cdc_fk, $p_iva_fk, $matr_fk, $tipoman, $op, $attrezz, $durata, $nop, $mat, $oss, $comment);
            $stmt->execute();

            if ($stmt->affected_rows == 1) {
                //$id_mod_io_fk = mysql_insert_id($stmt);
                //echo $id_mod_io_fk;
                //var_dump($stmt->affected_rows);
                $msg = (object)array('response_code' => '200');//inserimento ok
                echo json_encode($msg);
            } else {
                //var_dump($stmt->affected_rows);
                $msg = (object)array('response_code' => $conn->error . " " . $p_iva_fk);//inserimento no
                echo json_encode($msg);
            }
        }
        else {   //se autenticazione va male
                $msg = (object)array('response_code' => '400');
                echo json_encode($msg);
            }

            $stmt->close();
            $conn->close();


    }