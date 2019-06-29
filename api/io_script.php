<?php
session_start();

include_once('connection.php');
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS");

/*$access=unserialize($_SESSION['access']);
$cdc=$access->getUsername();*/

switch($_SERVER['REQUEST_METHOD'])
{
    case "GET":
    getIo($_GET,$conn);
    break;
    case "POST":
    insertIo($_POST,$conn);
    break;

}

function getIo($g,$c)
{
    //$conn= new mysqli("localhost","root","","vsm_db");
    //$conn= new mysqli("remotemysql.com:3306","xJdxb0ls5W","OSuER1hWdL","xJdxb0ls5W");


    if ($c->connect_error) {
        die("Connessione col db non riuscita: " . $c->connect_error);
    }
    if (isset($g['cdc']) && isset($g['mese']) && isset($g['anno'])) {

        $cdc = $g['cdc'];
        $mese = (int)$g['mese'];
        $anno = (int)$g['anno'];

        $stmt = $c->prepare("select * from mod_io where cdc_fk like ? and YEAR(DATE(data_io))=? AND MONTH(DATE(data_io)) = ?;");
        $stmt->bind_param("sii", $cdc, $anno, $mese);

    } else if(isset($g['id_mod']))
    {
        $id_mod = $g['id_mod'];
        $stmt = $c->prepare("select * from mod_io where id_mod_io = ?;");
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

    $c->close();
    $stmt->close();

}
















function insertIo($p,$c)
{
    //$conn= new mysqli("localhost","root","","vsm_db");
    //$conn= new mysqli("remotemysql.com:3306","xJdxb0ls5W","OSuER1hWdL","xJdxb0ls5W");
    //$conn = include_once('connection.php');

    /*if ($c->connect_error) {
        $msg=(object) array("Connessione col db non riuscita: " => $c->connect_error);
        json_encode($msg);
    }*/

    $nrsett=date('W');
    $tiro=0;
    $eff=0;
    $rid=0;
    $fe=0;
    $pr=0;
    $tot=0;
    $mal=0;
    $mat=0;
    $varie=0;
    $org=0;
    $ent=0;
    $usc=0;
    $str=0;
    $inc=0;
    $resa=0;

    foreach ($p as $k => $v) {
        switch ($k) {

            case "tiro":
                if (!is_numeric($v)) {
                    $tiro = 0;
                } else {
                    $tiro = $v;
                }
                break;
            case "eff":
                $eff = $v;
                break;
            case "rid":
                if (!is_numeric($v)) {
                    $rid = 0;
                } else {
                    $rid = $v;
                }
                break;
            case "fe":
                if (!is_numeric($v)) {
                    $fe = 0;
                } else {
                    $fe = $v;
                }
                break;
            case "pr":
                if (!is_numeric($v)) {
                    $pr = 0;
                } else {
                    $pr = $v;
                }
                break;
            case "tot":
                $tot = $v;
                break;
            case "mal":
                if (!is_numeric($v)) {
                    $mal = $v;
                } else {
                    $mal = 0;
                }
                break;
            case "mat":
                if (!is_numeric($v)) {
                    $mat = 0;
                } else {
                    $mat = $v;
                }
                break;
            case "varie":
                if (!is_numeric($v)) {
                    $varie = 0;
                } else {
                    $varie = $v;
                }
                break;
            case "org":
                $org = $v;
                break;
            case "ent":
                if (!is_numeric($v)) {
                    $ent = 0;
                } else {
                    $ent = $v;
                }
                break;
            case "usc":
                if (!is_numeric($v)) {
                    $usc = 0;
                } else {
                    $usc = $v;
                }
                break;
            case "xtr":
                if (!is_numeric($v)) {
                    $str = 0;
                } else {
                    $str = $v;
                }
                break;
            case "inc":
                $inc = $v;
                break;
            case "resa":
                $resa = $v;
                break;
            case "id_dip":
                $id_dip = $v;
                break;
            case "pwd_dip":
                $pwd_dip = $v;
                break;
        }
    }


    $pwd_dip = md5($pwd_dip);

    $stmt = $c->prepare("SELECT cdc_fk FROM dipendenti WHERE id_dip like ? AND pwd_dip like ?;");

    $stmt->bind_param("ss", $id_dip, $pwd_dip);
    $stmt->execute();
    $result = $stmt->get_result();

 //implementare firma modulo!!!!!!!!!!!!!!!!!!!!!!!!

    if ($result->num_rows==1) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $neg = $row['cdc_fk'];


        }
        //se autenticazione ok
        $stmt = $c->prepare("INSERT INTO `mod_io` (`nr_sett`, `cdc_fk`, `tiro`, `eff`, `rid`, `ferie`, `pr`, `tot`, `mal`, `mat`, `varie`, `org`, `entr`, `usc`, `str`, `incasso`, `resa`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("isddddddddddddddd",$nrsett,$neg,$tiro,$eff,$rid,$fe,$pr,$tot,$mal,$mat,$varie,$org,$ent,$usc,$str,$inc,$resa);
        $stmt->execute();

        if ($stmt->affected_rows==1)
        {
            //$id_mod_io_fk = mysql_insert_id($stmt);
            //echo $id_mod_io_fk;
            //var_dump($stmt->affected_rows);
            $msg=(object) array('response_code'=>'200');
            echo json_encode($msg);
        }else
        {
            //var_dump($stmt->affected_rows);
            $msg=(object) array('response_code'=>'401');
            echo json_encode($msg);
        }

    }else
    {   //se autenticazione va male
        $msg=(object) array('response_code'=>'400');
        echo json_encode($msg);
    }

    $stmt->close();
    $c->close();
}

